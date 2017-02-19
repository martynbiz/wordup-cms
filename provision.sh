#!/usr/bin/env bash

sudo apt-get update

# ========================================
# install apache

sudo apt-get install -y apache2

sudo a2enmod rewrite
sudo service apache2 restart


# ========================================
# install mysql

MYSQL_ROOT_PASSWORD="vagrant1"

# prevent the prompt screen from showing
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $MYSQL_ROOT_PASSWORD"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $MYSQL_ROOT_PASSWORD"

# install mysql server
sudo apt-get install -y mysql-server


# # ========================================
# # install redis
#
# sudo apt-get install -y redis-server


# ========================================
# install php

sudo apt-get install -y php libapache2-mod-php php-mcrypt php-mysql php-curl php-mbstring php-xml #php-redis


# ========================================
# setup virtual host

# dashboard site
sudo bash -c 'cat <<EOT >>/etc/apache2/sites-available/wordup.conf
<VirtualHost *:80>
    ServerName wordup.vagrant
    DocumentRoot /var/www/wordup/public

    SetEnv APPLICATION_ENV "development"

    <Directory /var/www/wordup/public>
        Options FollowSymLinks
        AllowOverride All
    </Directory>

    # Logging
    ErrorLog /var/log/apache2/wordup-error.log
    LogLevel notice
    CustomLog /var/log/apache2/wordup-access.log combined
</VirtualHost>
EOT
'

sudo a2ensite wordup.conf

# published site
sudo bash -c 'cat <<EOT >>/etc/apache2/sites-available/wordup-live.conf
<VirtualHost *:80>
    ServerName wordup-live.vagrant
    DocumentRoot /var/www/wordup-live

    SetEnv APPLICATION_ENV "development"

    <Directory /var/www/wordup-live>
        Options FollowSymLinks
        AllowOverride All
    </Directory>

    # Logging
    ErrorLog /var/log/apache2/wordup-live-error.log
    LogLevel notice
    CustomLog /var/log/apache2/wordup-live-access.log combined
</VirtualHost>
EOT
'

sudo a2ensite wordup-live.conf

sudo service apache2 reload

sudo mkdir /var/www/wordup-live
sudo chown www-data:www-data /var/www/wordup-live

# create databases
echo "create database wordup_dev" | mysql -u root -p$MYSQL_ROOT_PASSWORD
echo "create database wordup_test" | mysql -u root -p$MYSQL_ROOT_PASSWORD

# run migrations
cd /var/www/wordup
vendor/bin/phinx migrate --environment development
vendor/bin/phinx migrate --environment testing
vendor/bin/phinx seed:run
