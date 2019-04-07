CREATE TABLE Clients (
	user_id bigint(20) UNSIGNED NOT NULL,
	account_balance int(11) DEFAULT 0,
	FOREIGN KEY(user_id) REFERENCES Users(id)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE Employees (
	user_id bigint(20) UNSIGNED NOT NULL,
	ssn int(11) NOT NULL,
	emp_type varchar(255) NOT NULL,
	FOREIGN KEY (user_id) REFERENCES Users(id)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE Vehicles (
	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	license varchar(255) NOT NULL,
	capacity int(11) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE Routes (
	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	start_stop_id int(11) NOT NULL,
	end_stop_id int(11) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE Route_legs (
	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	route_id bigint(20) UNSIGNED NOT NULL,
	start_stop_id int(11) NOT NULL,
	end_stop_id int(11) NOT NULL,
	duration int(11) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (route_id) REFERENCES Routes(id)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE Runs (
	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	route_id bigint(20) UNSIGNED NOT NULL,
	start_time time NOT NULL,
	admin_id bigint(20) UNSIGNED NOT NULL,
	operator_id bigint(20) UNSIGNED NOT NULL,
	vehicle_id bigint(20) UNSIGNED NOT NULL,
	max_ridership bigint(20) UNSIGNED NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (route_id) REFERENCES Routes(id)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE Stops (
	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	address varchar(255) NOT NULL UNIQUE,
	PRIMARY KEY (id)
);

ALTER TABLE stops AUTO_INCREMENT = 1000;

INSERT INTO Clients (user_id, account_balance) VALUES
(1, 100);

INSERT INTO Employees (user_id, ssn, emp_type) VALUES
(2, 222222222, 'admin'),
(3, 333333333, 'operator'),
(4, 444444444, 'operator'),
(5, 555555555, 'operator'),
(6, 666666666, 'analyst');

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

INSERT INTO Runs (route_id, start_time, admin_id, operator_id, vehicle_id, max_ridership) VALUES
(1, '6:00', 2, 3, 1, 17),
(1, '7:00', 2, 4, 2, 30),
(1, '8:00', 2, 3, 3, 40),
(2, '12:00', 2, 4, 4, 22),
(3, '12:00', 2, 5, 5, 25);

INSERT INTO Route_legs (route_id, start_stop_id, end_stop_id, duration) VALUES
(1, 1000, 1010, 5),
(1, 1010, 1020, 5),
(2, 1020, 1030, 5),
(2, 1030, 1040, 5),
(3, 1040, 1050, 5),
(3, 1050, 1060, 5);

