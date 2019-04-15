INSTRUCTIONS TO RUN THE PROJECT APPLICATION:

1) ensure APACHE and MySQL are installed on your device

2) ensure Laravel and Composer are installed on your device
	https://laravel.com/docs/5.8/installation

3) open MyPHPAdmin and import the file: createdb.sql

5) Open command line in /transit and execute commands:
	php artisan migrate
	php artisan db:seed

6) open MyPHPAdmin, select the database 'transit' and import the file: seeddb.sql

7) Open command line in /transit and execute commands:
	php artisan serve

8) Open web browser and navigate to the following url:
	http://localhost:8000/