CREATE TABLE Stops (
	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	address varchar(255) NOT NULL UNIQUE,
	PRIMARY KEY (id)
);

CREATE TABLE Vehicles (
	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	license varchar(255) NOT NULL,
	capacity int(11) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE Clients (
	user_id bigint(20) UNSIGNED NOT NULL,
	account_balance int(11) DEFAULT 0,
	FOREIGN KEY(user_id) REFERENCES Users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Employees (
	user_id bigint(20) UNSIGNED NOT NULL,
	ssn int(11) NOT NULL,
	FOREIGN KEY (user_id) REFERENCES Users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Routes (
	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	start_stop_id bigint(20) UNSIGNED NOT NULL,
	end_stop_id bigint(20) UNSIGNED NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (start_stop_id) REFERENCES Stops(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (end_stop_id) REFERENCES Stops(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Route_legs (
	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	route_id bigint(20) UNSIGNED NOT NULL,
	start_stop_id bigint(20) UNSIGNED NOT NULL,
	end_stop_id bigint(20) UNSIGNED NOT NULL,
	duration int(11) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (route_id) REFERENCES Routes(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (start_stop_id) REFERENCES Stops(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (end_stop_id) REFERENCES Stops(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Runs (
	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	route_id bigint(20) UNSIGNED NOT NULL,
	start_time time NOT NULL,
	admin_id bigint(20) UNSIGNED NOT NULL,
	operator_id bigint(20) UNSIGNED NOT NULL,
	vehicle_id bigint(20) UNSIGNED NOT NULL,
	max_ridership bigint(20) UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (id),
	FOREIGN KEY (route_id) REFERENCES Routes(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (admin_id) REFERENCES Employees(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (operator_id) REFERENCES Employees(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (vehicle_id) REFERENCES Vehicles(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Requests (
	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	req_message text NOT NULL,
	analyst_id bigint(20) UNSIGNED NOT NULL,
	route_id bigint(20) UNSIGNED NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (analyst_id) REFERENCES Employees(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (route_id) REFERENCES Routes(id) ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE stops AUTO_INCREMENT = 1000;

INSERT INTO Clients (user_id, account_balance) VALUES
(1, 0);

INSERT INTO Employees (user_id, ssn) VALUES
(2, 222222222),
(3, 333333333),
(4, 444444444),
(5, 555555555),
(6, 666666666);

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

INSERT INTO Requests (id, req_message, analyst_id, route_id) VALUES
(1, 'TEST REQUEST: RUN 3 reaches maximum capacity. Needs another run shortly before or shortly after RUN 3.', 6, 1);