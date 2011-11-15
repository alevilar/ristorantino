#!/usr/bin/env python 
""" 
Servidor de impresion a archivos
Necesita tener instalado el paquete python-daemon

para agregar la impresora a cups hacer:
sudo lpadmin -p [NOMBRE] -E -v socket://localhost:[PUERTO] -m raw

(el puerto debe coincidir con alguno de la configuracion de puerto-archivo que esta mas abajo)

""" 
import os, socket, select, daemon
from tempfile import NamedTemporaryFile

#CONFIGURACION DE PUERTOS-ARCHIVOS
opts = [
	{"port":12000, "suffix":".txt", "prefix":"comanda_", "dir":"/tmp/comandas/"},
	{"port":12001, "suffix":".txt", "prefix":"fiscal_", "dir":"/tmp/fiscal/"}
]
sockets = {}

def daemon_main():
	while 1:
		inputready,outputready,exceptready = select.select(sockets.keys(),[],[])
		for s in inputready:
			conn, addr = s.accept()
			with NamedTemporaryFile(suffix=sockets[s]["suffix"], prefix=sockets[s]["prefix"], dir=sockets[s]["dir"], delete=False) as f:
                                os.chmod(sockets[s]["dir"]+f.name, 0o000)
				while 1:
					data = conn.recv(1024)
					if not data: 
						break
                                        f.write(data)
				conn.close()

def main():
	for opt in opts:
		if not os.path.exists(opt["dir"]):	
			os.makedirs(opt["dir"])
                        os.chmod(opt["dir"], 0o777)
		s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		s.bind(('', opt["port"]))
		s.listen(1)
		sockets[s] = opt
	files = [s.fileno() for s in sockets.keys()]
	context = daemon.DaemonContext(files_preserve = files)
	print files
	with context:
		daemon_main()

if __name__ == "__main__":
	main()