set -x
#!/bin/bash

CARPETA_FUENTE=/tmp/fuente

while true ; do	
	cd $CARPETA_FUENTE
	CANT=`ls -1 | wc -l`			
	
	#si es mayor cero quiere decir que hay archios en la carpeta para imprimir
	if [$CANT -eq 0]
	then
		cd /dev
		DBS=`ls ttyUSB*`		
		
		for b in $DBS ;
		do
			echo $b
			spooler -p$b -l -c "*" 
		done
	fi		
	sleep 220
	RETVAL=$?
done
exit $RETVAL
