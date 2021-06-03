Commands to run:
composer install //Install composer
Symfony serve -d //Start local server
php bin/console doctrine:database:create //Create Database
php bin/console make:migration
php bin/console doctrine:migrations:migrate

Add Database to .env file
DATABASE_URL="mysql://root:password@127.0.0.1:3306/main?serverVersion=5.7" //Connect Database
