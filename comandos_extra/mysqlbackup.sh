#!/bin/bash
### MySQL Server Login Info ###
MUSER="xxxx"
MPASS="xxxxxx"
MHOST="localhost"
MYSQL="$(which mysql)"
MYSQLDUMP="$(which mysqldump)"
BAK="/backups/db"
GZIP="$(which gzip)"
NOMBREDDBB="nombreDDBB"
EMAIL="mail@mail.com"


 FILE=$BAK/$NOMBREDDBB_$(date +%Y-%m-%d-%T).gz
 $MYSQLDUMP -u $MUSER -h $MHOST -p$MPASS $NOMBREDDBB | $GZIP -9 > $FILE

 echo | mutt -a $FILE -s "backup $NOMBREDDBB" $EMAIL

 FILE=$BAK/drupal.$NOW-$(date +%Y-%m-%d-%T).gz
 $MYSQLDUMP -u $MUSER -h $MHOST -p$MPASS drupal | $GZIP -9 > $FILE

