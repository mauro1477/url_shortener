Commands to run:

composer install //Install composer
Symfony serve -d //Start local server
DATABASE_URL="mysql://root:password@127.0.0.1:3306/main?serverVersion=5.7" //Connect Database
php bin/console doctrine:database:create //Create Database
php bin/console make:migration
