#!/bin/bash

CARPETA_FUENTE=/tmp/fuente
CARPETA_DESTINO=/tmp/dest

while true ; do
	cd /dev
	DBS=`ls ttyUSB*`
	CANT=`ls ttyUSB* | wc -w`

	if [ $CANT -gt 1]; then
		for b in $DBS ;
		do	
		       	sudo rm /dev/$b
		done
	fi

	if [ -d "$CARPETA_FUENTE" ]; then
		cd $CARPETA_FUENTE
			for b in $DBS ;
			do	
				echo "arranco el spooler"
				#cd /var/www/ristorantino/app/vendors/spooler
			       	spooler -p$b -s /tmp/fuente -a /tmp/dest -l -d /tmp/spooler.log -b /tmp
				echo "se corto el spooler"
			done
	fi
	sleep 2
	RETVAL=$?
done
exit $RETVAL
