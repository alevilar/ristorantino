#!/bin/bash

CARPETA_FUENTE=/tmp/fuente
CARPETA_DESTINO=/tmp/dest
LOG_FILE=/tmp/spooler.log
CARPETA_TEMP=/tmp



encontrar_ultimo_dispositivo_creado(){
	cd /dev
	DBS=`ls ttyUSB*`
	CANT=`ls ttyUSB* | wc -w`

	for b in $DBS ;	 do	
	   if [ "$CANT" -gt "1" ]; then
	      # borro las anteriores, porque por lo general son archivos zombies
	      # que se generan cuando la impresora se conecta y desconecta
	      sudo rm /dev/$b
	      CANT=`expr $CANT - 1`
	   else
	      echo $b
	   fi
	done
}


arrancar_spooler(){
	if [ -d "$CARPETA_FUENTE" ]; then
		echo "leyendo $DEVICE_NAME"
		if [ -c /dev/$DEVICE_NAME ]; then
			cd $CARPETA_FUENTE	
			echo "arranco el spooler en $DEVICE_NAME"
			spooler -p$DEVICE_NAME -s $CARPETA_FUENTE -a $CARPETA_DESTINO -l -d $LOG_FILE -b $CARPETA_TEMP
			echo "se corto el spooler"
		else
			echo "el dispositivo $DEVICE_NAME no existe"
			exit
		fi
	else
		mkdir $CARPETA_FUENTE
		chmod 777 $CARPETA_FUENTE
	fi
}



##############################################################################
#
#
#	MAIN
#
#
#

while true ; do
	DEVICE_NAME=''

	#si no se paso como argumento el nombre del dispositivo (Ej: ttyUSB2) hay que buscarlo
	if [ -z "$1" ];	then
		encontrar_ultimo_dispositivo_creado
		DEVICE_NAME=$(encontrar_ultimo_dispositivo_creado)
	else
	# si se paso como parametro entonces utilizar ese dispositivo
		DEVICE_NAME="$1"
	fi
	
	arrancar_spooler
	
	sleep 2
	RETVAL=$?
done
exit $RETVAL






