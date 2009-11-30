#!/bin/bash

CARPETA_FUENTE=/tmp/fuente
CARPETA_DESTINO=/tmp/dest

while true ; do	
	cd /dev
	DBS=`ls ttyUSB*`			
		
	for b in $DBS ;
	do
		#echo $b
		#cd /var/www/ristorantino/app/vendors/spooler
	       	spooler -p$b -s /tmp/fuente -a /tmp/dest -l -d /tmp/spooler.log -b /tmp
	done
	
	sleep 5
	RETVAL=$?
done
exit $RETVAL
