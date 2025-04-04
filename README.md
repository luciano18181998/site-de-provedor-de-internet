# Site de Provedor de Internet

Este é um projeto Laravel para um site de provedor de internet.

## Requisitos

- Servidor VPS rodando Ubuntu 20.04 ou superior
- Acesso root ao servidor
- Domínio apontado para o servidor (opcional, mas recomendado)

## Etapas de Instalação

### 1. Acesse sua VPS

Conecte-se ao seu servidor via SSH:

```bash
ssh root@IP_DA_SUA_VPS


✅ Etapas completas para instalar seu site Laravel na VPS:
🟩 ETAPA 1: Acesse sua VPS

Use SSH:
ssh root@IP_DA_SUA_VPS

🟩 ETAPA 2: Prepare o ambiente da VPS
Você precisa instalar tudo o que o Laravel precisa: PHP, MySQL, Nginx, Composer...

Baixe e execute o script:
wget https://SEU-LINK/setup-server.sh
chmod +x setup-server.sh
./setup-server.sh

Esse script:

Atualiza os pacotes

Instala PHP 8.0 + extensões

Instala MySQL Server

Instala Nginx

Instala Composer e Git

🟩 ETAPA 3: Clone seu projeto Laravel
Depois que o ambiente estiver pronto, baixe o projeto:

cd /var/www
git clone https://github.com/luciano18181998/site-de-provedor-de-internet.git
cd site-de-provedor-de-internet

🟩 ETAPA 4: Execute o instalador Laravel
Esse script vai:

Criar banco no MySQL

Criar usuário e senha do banco

Preencher o .env

Instalar dependências

Rodar php artisan migrate

Criar o administrador

Rode:

wget https://SEU-LINK/install.sh
chmod +x install.sh
./install.sh

Durante o processo, ele vai perguntar:

Nome do banco de dados

Nome do usuário MySQL

Senha do usuário

Senha do MySQL root (para criar o banco)

Informações do administrador do sistema

🟩 ETAPA 5: Configure o Nginx
Crie um arquivo em /etc/nginx/sites-available/laravel com este conteúdo:

server {
    listen 80;
    server_name SEU_DOMINIO.com;

    root /var/www/site-de-provedor-de-internet/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.0-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }
}

Depois, ative o site:

ln -s /etc/nginx/sites-available/laravel /etc/nginx/sites-enabled/
nginx -t
systemctl reload nginx

🟩 ETAPA 6: Permissões finais
cd /var/www/site-de-provedor-de-internet
chown -R www-data:www-data .
chmod -R 775 storage
chmod -R 775 bootstrap/cache

🟩 ETAPA 7 (opcional): Configurar HTTPS com Certbot
Se o domínio já estiver no ar e apontado pra VPS:

apt install certbot python3-certbot-nginx -y
certbot --nginx -d seu-dominio.com

✅ Pronto!
Seu projeto Laravel estará:

Com MySQL funcionando

.env configurado

Admin cadastrado no banco

Rodando no Nginx

Com dependências instaladas


