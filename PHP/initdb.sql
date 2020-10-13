/*drop database IF EXISTS cities;
copy paste sto mysql console to :
source C:\Users\REST_OF_THE_PATH\initdb.sql
*/
CREATE DATABASE IF NOT EXISTS cities;

USE cities;
ALTER DATABASE cities CHARACTER SET utf8 COLLATE utf8_unicode_ci; 


CREATE TABLE IF NOT EXISTS polygon(
		
		P_placemark_id int UNIQUE AUTO_INCREMENT,
		P_linear_coords varchar(20000),
		P_longtitude varchar(400),
		P_latitude varchar(400),
		P_population INT(8),
		PRIMARY KEY (P_placemark_id)
		

)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;


CREATE TABLE IF NOT EXISTS Admins(
		
		A_id int UNIQUE AUTO_INCREMENT,
		A_FullName varchar(50),
		A_username varchar(20),
		Password varchar(20),
		
		PRIMARY KEY(A_id)
		

)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

/*
SHOW TABLES;

SHOW COLUMNS FROM city;
SHOW COLUMNS FROM polygon;
SHOW COLUMNS FROM Admins;

SELECT * FROM city;
SELECT * FROM polygon;
SELECT * FROM Admins;



insert into city(C_name,C_latitude,C_longtitude)
values ("ελληνικά", 0.001,  3.14);

select * from city;
*/
