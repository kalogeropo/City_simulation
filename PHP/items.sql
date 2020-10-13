CREATE DATABASE IF NOT EXISTS cities;
USE cities;

CREATE TABLE IF NOT EXISTS demand(
		
		D_id int UNIQUE AUTO_INCREMENT,
		D_time int(3),
		D_center float(5),
		D_residence float(5),
		D_rural float(5),
		PRIMARY KEY (D_id)
		

)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (0,0.75,0.69,0.18);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (1,0.55,0.71,0.17);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (2,0.46,0.73,0.21);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (3,0.19,0.68,0.25);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (4,0.2,0.68,0.22);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (5,0.2,0.7,0.17);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (6,0.39,0.67,0.16);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (7,0.55,0.55,0.39);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (8,0.67,0.49,0.54);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (9,0.8,0.43,0.77);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (10,0.95,0.34,0.78);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (11,0.9,0.45,0.83);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (12,0.95,0.48,0.78);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (13,0.9,0.53,0.78);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (14,0.88,0.5,0.8);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (15,0.83,0.56,0.8);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (16,0.7,0.73,0.78);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (17,0.64,0.41,0.79);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (18,0.74,0.42,0.84);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (19,0.8,0.48,0.57);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (20,0.8,0.54,0.38);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (21,0.95,0.6,0.24);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (22,0.92,0.72,0.19);
INSERT into demand(D_time,D_center,D_residence,D_rural) VALUES (23,0.76,0.66,0.23);
