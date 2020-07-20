\
# Server Requirements

- MySQL or Mariadb
- PHP >= 7.3
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Composer
- npm

# Database
- Create a database in your database server

CREATE DATABASE \`thehub\` /*!40100 COLLATE 'utf8mb4_unicode_ci' */;

# Cloud Storage
- Create BlockBlobStorage storage accounts in Azure
https://portal.azure.com, other storage should be supported but require some extra packages (https://laravel.com/docs/7.x/filesystem)

# Application installation & Configuration
- Setting Permissions for different folders

`chmod -R 775 storage/ bootstrap/cache/ vendor/`

- Installing Composer dependency

`composer install`

## Application configuration
- `cp .env.example .env`
- `chmod 777 .env`

### Edit .env file

- local, staging, or production

`APP_ENV=production`



- true or false

`APP_DEBUG=false`


- Admin URL

`APP_URL=https://admin.example.com`


- Users portal url (the hub)

`USER_URL=https://my.example.com`


- Database type

`DB_CONNECTION=mysql`


- Database server host name or ip

`DB_HOST=1.136.66.332`


- Database server port

`DB_PORT=3306`


- Database name (thehub)

`DB_DATABASE=thehub`


- Database user name

`DB_USERNAME=thehub`


- Database user password

`DB_PASSWORD="password"`


- Storage name (thehubstorage)

`AZURE_STORAGE_NAME=thehubstorage`


- Storage key (example: cb+gorRUWgARXtyD0nw/gorRUWgARXtyD0nw==)

`AZURE_STORAGE_KEY=cb+gorRUWgARXtyD0nw/gorRUWgARXtyD0nw==`


- Storage Container name

`AZURE_STORAGE_CONTAINER=thehub`


- Database SSL certificate

From https://docs.microsoft.com/en-us/azure/mysql/howto-configure-ssl

1- Obtain SSL certificate from https://www.digicert.com/CACerts/BaltimoreCyberTrustRoot.crt.pem

2- Copy BaltimoreCyberTrustRoot.crt.pem to database/ folder

3- Write the full path in MYSQL_ATTR_SSL_CA

`MYSQL_ATTR_SSL_CA=/home/site/wwwroot/database/BaltimoreCyberTrustRoot.crt.pem`


### Generate app key

`php artisan key:generate`

### Create database tables

`php artisan migrate:fresh`

### Create default database data

`php artisan db:seed`

### Setup admin email and password 

`php artisan thehub:install-admin`

### Running NPM install

`npm install`

### Run NPM packaging 

`npm run prod`
