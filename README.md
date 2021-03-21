## About Knowledge Center
A knowledge center where articles can be published, read and
rated by users (identified by IP address). Articles can be given categories. And engagement
can be measured by its ratings and views.

## System Requirements to Run the app (Make sure you install the following)
1. PHP >=7.4 (https://www.php.net/downloads.php)
2. Composer (and is globally available in your system or you know the path to it ) https://getcomposer.org/download/
3. MysQL >= 8.0 (https://www.mysql.com/downloads/)
4. Postman (https://www.postman.com/downloads/)
5. Install Xdebug (https://xdebug.org/docs/install#pecl): `pecl install xdebug`
6. Install Redis: `brew install redis`
7. For caching, increase the memory of your php run time in you `php.ini` file. Run `php --ini` to find locate it, and edit the file by adding this line: `memory_limit = 2048M` to the bottom.

### How to Setup

1. After cloning, CD into root of project and run `composer install`
2. Log into mysql `mysql -u root -p` and provide the password if it asks for and create database `trengo_db`
3. Save `.env.example` as `.env` (make sure your database details for `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
4. in the root of project run `php artisan migrate`
5. in the root of project run `php artisan db:seed`
6. in the root of project run `php artisan serve` and take not of the port and url is running on. Copy the URL
7. Clone APIs documentation using postman URL: `https://www.getpostman.com/collections/35792eda26ef196cb587` and import them into postman. (Check the file menu to see the import option for your postman app)
8. Copy the URL you see at point 6, and put it as the `INITIAL VALUE` and `CURRENT VALUE` for the environment variable `API_BASE_URL` for the postman collection you imported at the point 7.

#### Caching
1. This is using Redis Cache. With the composer package `predis/predis`
2. Start redis after installation `brew services start redis`

#### Useful Tips
1. Make sure to run `php artisan queue:work` to have all your jobs processed
2. Visit Horizon on: `{BASE_URL}/horizon/dashboard`

#### Run Test
1. Run test `vendor/bin/phpunit`
2. Generate test coverage report: `vendor/bin/phpunit --coverage-html reports/`
