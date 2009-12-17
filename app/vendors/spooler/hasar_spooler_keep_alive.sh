#set -x
#!/bin/bash

CARPETA_FUENTE=/tmp/fuente

while true ; do
	if [ -d "$CARPETA_FUENTE" ]; then
		cd $CARPETA_FUENTE
		CANT=`ls -1 | wc -l`	

		#si es mayor cero quiere decir que hay archios en la carpeta para imprimir
		if [ $CANT -eq 0 ]
		then
			cd /dev
			DBS=`ls ttyUSB*`		
			
			for b in $DBS ;
			do
				echo "Conectado en dispositivo $b"
				spooler -p$b -l -c "*" 
				echo "se envio el comando"
			done
		fi		
	fi
	sleep 200

	RETVAL=$?
done
exit $RETVAL
