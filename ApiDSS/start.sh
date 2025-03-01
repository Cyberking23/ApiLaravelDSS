#!/bin/bash

apt update -y && apt upgrade -y
apt install mariadb-server -y

service mariadb start

mysql -u root -e "CREATE USER IF NOT EXISTS 'www-data'@'%' IDENTIFIED BY 'root'; GRANT ALL PRIVILEGES ON *.* TO 'www-data'@'%' WITH GRANT OPTION; FLUSH PRIVILEGES;"

mysql -u root -e "CREATE DATABASE IF NOT EXISTS \`apidss\`;"

chown -R root:www-data /var/run/mysqld
chmod -R 775 /var/run/mysqld

php artisan optimize:clear
php artisan migrate 

apache2-foreground