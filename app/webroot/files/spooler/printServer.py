#!/usr/bin/env python 
""" 
Servidor de impresion a archivos
Necesita tener instalado el paquete python-daemon

para agregar la impresora a cups hacer:
sudo lpadmin -p [NOMBRE] -E -v socket://localhost:[PUERTO] -m raw

para que CUPS imprima rapido via sockets hay que settear lo siguiente (waiteof=false):
socket://uri:port?waiteof=false

(el puerto debe coincidir con alguno de la configuracion de puerto-archivo que esta mas abajo)

la carpeta, en este caso /tmp/fuente, es la que el spooler estara leyendo
"""

from multiprocessing import Process
import glob, re, os, subprocess, socket, select, daemon, shutil, time
from tempfile import NamedTemporaryFile

#CONFIGURACION DE PUERTOS-ARCHIVOS
opts = [	
	{"port":12001, "suffix":".txt", "prefix":"fiscal_", "dir":"/tmp/fuente/"}
]
sockets = {}


CARPETA_FUENTE = '/tmp/fuente'
CARPETA_DESTINO = '/tmp/dest'
LOG_FILE = '/tmp/spooler.log'
CARPETA_TEMP = '/tmp'


def find_usb_tty(vendor_id = None, product_id = None) :
    tty_devs    = []

    for dn in glob.glob('/sys/bus/usb/devices/*') :
        try     :
            vid = int(open(os.path.join(dn, "idVendor" )).read().strip(), 16)
            pid = int(open(os.path.join(dn, "idProduct")).read().strip(), 16)
            if  ((vendor_id is None) or (vid == vendor_id)) and ((product_id is None) or (pid == product_id)) :
                dns = glob.glob(os.path.join(dn, os.path.basename(dn) + "*"))
                for sdn in dns :
                    for fn in glob.glob(os.path.join(sdn, "*")) :
                        if  re.search(r"\/ttyUSB[0-9]+$", fn) :
                            #tty_devs.append("/dev" + os.path.basename(fn))
                            tty_devs.append(os.path.join("/dev", os.path.basename(fn)))
                        pass
                    pass
                pass
            pass
        except ( ValueError, TypeError, AttributeError, OSError, IOError ) :
            pass
        pass
    if len(tty_devs):
        return tty_devs
    else:
        return ''


def run_spooler():
        ''' ejecuta el spooler '''
        print "adentro del SPOOLER"
        ttyUSB = find_usb_tty()
        print "el ttyUSB es el: "+ttyUSB
        while 1:
            if ttyUSB:        
                    print "iniciando el spooler\n"
                    subprocess.call(['/usr/bin/spooler', '-p'+TTY, '-s ' + CARPETA_FUENTE, '-a '+CARPETA_DESTINO, '-l', '-d '+LOG_FILE, '-b '+CARPETA_TEMP ])
                    return True
            else:
                print "no existe impresora fiscal conectada.. esperando"
                time.sleep(5)
        return False


def daemon_main():
        print "adentro del SERVICIO"
	while 1:
		inputready,outputready,exceptready = select.select(sockets.keys(),[],[])
		for s in inputready:
			conn, addr = s.accept()
			f = NamedTemporaryFile(suffix=sockets[s]["suffix"], prefix=sockets[s]["prefix"], delete=False)
			name = f.name
			
			while 1:
				data = conn.recv(1024)
				if not data: 
					break
				f.write(data)
			conn.close()
			f.close()
                        os.chmod(name, 0o777)
			shutil.move(name, sockets[s]["dir"])

def main():
        print "iniciando"
	for opt in opts:
		if not os.path.exists(opt["dir"]):	
			os.makedirs(opt["dir"])
			os.chmod(opt["dir"], 0o777)
		s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		s.bind(('', opt["port"]))
		s.listen(1)
		sockets[s] = opt

        Process(target=run_spooler).start()       
	files = [s.fileno() for s in sockets.keys()]
	context = daemon.DaemonContext(files_preserve = files)
	print files
	with context:
		daemon_main()

if __name__ == "__main__":
	main()