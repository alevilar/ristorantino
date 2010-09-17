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
			#/etc/init.d/spooler_srv stop
			echo "se freno el spooler_srv"
                        #/etc/init.d/spooler_srv start
			echo "se reinicio el spooler_srv"
                        cd /
		fi		
	fi
	sleep 200

	RETVAL=$?
done
exit $RETVAL

