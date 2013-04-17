#!/bin/bash
### MySQL Server Login Info ###
MUSER="user"
MPASS="supersecret"
MHOST="localhost"
MYSQL="$(which mysql)"
MYSQLDUMP="$(which mysqldump)"
BAK="/tmp"
GZIP="$(which gzip)"
NOMBREDDBB="ristorantino"
EMAIL="mail@mail.com"


 FILE=$BAK/$NOMBREDDBB_$(date +%Y-%m-%d-%T).gz
 $MYSQLDUMP -u $MUSER -h $MHOST -p$MPASS $NOMBREDDBB | $GZIP -9 > $FILE

 echo | mutt -s "backup $NOMBREDDBB" -a $FILE -- $EMAIL

