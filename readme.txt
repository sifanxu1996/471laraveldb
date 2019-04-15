Due to how our database needs to be set up,
it is not possible to create a script file to automatically set it up.
In lieu of a script file, this README will explain exactly how to set it up.

INSTRUCTIONS TO RUN THE PROJECT APPLICATION:

1) ensure APACHE and MySQL are installed on your device

2) ensure Laravel and Composer are installed on your device
	https://laravel.com/docs/5.8/installation

3) 	in /transit/config/database.php, make sure that line 18 specifies:

		'default' => env('DB_CONNECTION', 'mysql'),
	
	in /transit/.env, specify your login credentials for MySQL:
	
		DB_PORT=
		DB_USERNAME=
		DB_PASSWORD=

4) in MyPHPAdmin and import the .sql file:
	transit.sql

5) Open command line in /transit and execute commands:
	php artisan serve

6) Open web browser and navigate to the following url:
	http://localhost:8000/

7) login using any of the following credentials:

**password is 'password'**

CLIENT:		abe@gmail.com
ADMIN:		bob@gmail.com
OPERATOR:	carl@gmail.com
OPERATOR:	dave@gmail.com
OPERATOR:	eli@gmail.com
ANALYST:	fin@gmail.com

**if you encounter any issues running this application please contact me:
	sifan.xu@ucalgary.ca
	
Thank-you :)