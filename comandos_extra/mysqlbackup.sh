#!/bin/bash
### MySQL Server Login Info ###
MUSER="root"
MPASS="8a4a23rv3R"
MHOST="localhost"
MYSQL="$(which mysql)"
MYSQLDUMP="$(which mysqldump)"
BAK="/backups/db"
GZIP="$(which gzip)"


 FILE=$BAK/ristorantino_$(date +%Y-%m-%d-%T).gz
 $MYSQLDUMP -u $MUSER -h $MHOST -p$MPASS ristorantino | $GZIP -9 > $FILE

 echo | mutt -a $FILE -s "backup ristorantino" alevilar@gmail.com

 FILE=$BAK/drupal.$NOW-$(date +%Y-%m-%d-%T).gz
 $MYSQLDUMP -u $MUSER -h $MHOST -p$MPASS drupal | $GZIP -9 > $FILE

