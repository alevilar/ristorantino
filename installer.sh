
PATHNAME=ristorantino

cp -R ./ /var/www/$PATHNAME
chmod 755 -R /var/www/$PATHNAME
chmod 777 -R /var/www/$PATHNAME/app/tmp
rm -R /var/www/$PATHNAME/app/tmp/cache/models
rm -R /var/www/$PATHNAME/app/tmp/cache/persistent
rm -R /var/www/$PATHNAME/app/tmp/cache/views


cp /var/www/$PATHNAME/app/vendors/spooler/spooler /usr/bin
cp /var/www/$PATHNAME/app/vendors/spooler/hasar_spooler /usr/bin
cp /var/www/$PATHNAME/app/vendors/spooler/spooler_srv /etc/init.d
chmod 777 /etc/init.d/spooler_srv
chmod 755 /usr/bin/spooler
chmod 755 /usr/bin/spooler_srv
update-rc.d -f spooler_srv defaults






