#!/bin/bash

echo "🔧 Iniciando instalação Laravel..."

read -p "➡️  Nome do banco de dados: " DB_NAME
read -p "➡️  Usuário MySQL: " DB_USER
read -s -p "➡️  Senha do usuário MySQL: " DB_PASS
echo
read -s -p "➡️  Senha do root MySQL (para criar o banco): " MYSQL_ROOT_PASS
echo
read -p "➡️  Nome do administrador: " ADMIN_NAME
read -p "➡️  E-mail do administrador: " ADMIN_EMAIL
read -s -p "➡️  Senha do administrador: " ADMIN_PASSWORD
echo

# Criar banco e usuário
echo "📦 Criando banco de dados..."
mysql -u root -p$MYSQL_ROOT_PASS -e "CREATE DATABASE $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p$MYSQL_ROOT_PASS -e "CREATE USER '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';"
mysql -u root -p$MYSQL_ROOT_PASS -e "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';"
mysql -u root -p$MYSQL_ROOT_PASS -e "FLUSH PRIVILEGES;"

# Copiar e configurar .env
cp .env.example .env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USER/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASS/" .env

# Instalar dependências
composer install --no-interaction
php artisan key:generate

# Rodar migrations
php artisan migrate

# Criar administrador
php artisan tinker --execute "\App\Models\Administrador::create(['nome' => '$ADMIN_NAME', 'email' => '$ADMIN_EMAIL', 'password' => bcrypt('$ADMIN_PASSWORD')]);"

echo "✅ Instalação concluída!"
