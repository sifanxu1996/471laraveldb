-- php artisan db:seed

DROP DATABASE IF EXISTS Transit;
CREATE DATABASE Transit;

CREATE TABLE Users (
	id bigInt(20) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	email varchar(255) NOT NULL UNIQUE,
	role varchar(255) NOT NULL DEFAULT 'client',
	email_verified_at timestamp,
	password varchar(255) NOT NULL,
	remember_token varchar(100),
	create_at timestamp,
	updated_at timestamp,
	PRIMARY KEY (id)
);

CREATE TABLE Clients (
	user_id bigInt(20) NOT NULL,
	account_balance int(11) DEFAULT 0,
	FOREIGN KEY (user_id) REFERENCES Users(id)
);

CREATE TABLE Employees (
	user_id bigInt(20) NOT NULL,
	ssn int(11) NOT NULL,
	emp_type varchar(255) NOT NULL,
	FOREIGN KEY (user_id) REFERENCES Users(id)
);

CREATE TABLE Vehicles (
	id bigInt(20) NOT NULL AUTO_INCREMENT,
	license varchar(255) NOT NULL,
	capacity int(11) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE Routes (
	id bigInt(20) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	start_stop_id int(11) NOT NULL,
	end_stop_id int(11) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE Route_legs (
	id bigInt(20) NOT NULL AUTO_INCREMENT,
	route_id bigInt(20) NOT NULL,
	start_stop_id int(11) NOT NULL,
	end_stop_id int(11) NOT NULL,
	duration int(11) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (route_id) REFERENCES Routes(id)
);

CREATE TABLE Runs (
	id bigInt(20) NOT NULL AUTO_INCREMENT,
	route_id bigInt(20) NOT NULL,
	start_time time NOT NULL,
	admin_id bigInt(20) NOT NULL,
	operator_id bigInt(20) NOT NULL,
	vehicle_id bigInt(20) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (route_id) REFERENCES Routes(id)
);

CREATE TABLE Stops (
	id bigInt(20) NOT NULL AUTO_INCREMENT,
	address varchar(255) NOT NULL UNIQUE,
	PRIMARY KEY (id)
);

ALTER TABLE stops AUTO_INCREMENT = 1000;


INSERT INTO Users (id, name, email, role, password) VALUES
(1, 'Abe', 'abe@uc.ca', 'client', 'password'),
(2, 'Bob', 'bob@uc.ca', 'admin', 'password'),
(3, 'Carl', 'carl@uc.ca', 'operator', 'password'),
(4, 'Dave', 'dave@uc.ca', 'operator', 'password'),
(5, 'Eli', 'eli@uc.ca', 'operator', 'password');

INSERT INTO Clients (user_id, account_balance) VALUES
(1, 100);

INSERT INTO Employees (user_id, ssn, emp_type) VALUES
(2, 222222222, 'admin'),
(3, 333333333, 'operator'),
(4, 444444444, 'operator'),
(5, 555555555, 'operator');

INSERT INTO Vehicles (id, license, capacity) VALUES
(1, 'DD8-392A', 40),
(2, 'DD8-392B', 40),
(3, 'DD8-392C', 40),
(4, 'DD8-392D', 60),
(5, 'DD8-392E', 60),
(6, 'DD8-392F', 60);

INSERT INTO Stops (id, address) VALUES
(1000, '0th Ave 1000'),
(1010, '1st Ave 1010'),
(1020, '2nd Ave 1020'),
(1030, '3rd Ave 1030'),
(1040, '4th Ave 1040'),
(1050, '5th Ave 1050'),
(1060, '6th Ave 1060');

INSERT INTO Routes (id, name, start_stop_id, end_stop_id) VALUES
(1, 'Elbow Drive', 1000, 1020),
(2, 'Fish Creek', 1020, 1040),
(3, 'Bridlewood', 1040, 1060);

INSERT INTO Runs (route_id, start_time, admin_id, operator_id, vehicle_id) VALUES
(1, '6:00', 2, 3, 1),
(1, '7:00', 2, 4, 2),
(1, '8:00', 2, 3, 3),
(2, '12:00', 2, 4, 4),
(3, '12:00', 2, 5, 5);

INSERT INTO Route_legs (route_id, start_stop_id, end_stop_id, duration) VALUES
(1, 1000, 1010, 5),
(1, 1010, 1020, 5),
(2, 1020, 1030, 5),
(2, 1030, 1040, 5),
(3, 1040, 1050, 5),
(3, 1050, 1060, 5);

