#!/bin/bash

apt update && apt upgrade -y

apt install -y php8.0 php8.0-cli php8.0-fpm php8.0-mysql php8.0-xml php8.0-mbstring php8.0-curl php8.0-zip php8.0-bcmath php8.0-gd

apt install -y mysql-server

apt install -y nginx

cd ~
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
rm composer-setup.php

apt install -y git

systemctl restart php8.0-fpm
systemctl restart nginx
systemctl restart mysql

systemctl enable php8.0-fpm
systemctl enable nginx
systemctl enable mysql

if command -v ufw >/dev/null 2>&1; then
    ufw allow 80
fi

echo ""
echo "✅ Servidor configurado com sucesso!"
