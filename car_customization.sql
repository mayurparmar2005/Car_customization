-- car_customization SQL
CREATE DATABASE IF NOT EXISTS car_customization;
USE car_customization;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(150) UNIQUE,
  password VARCHAR(150)
);

CREATE TABLE cars (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150),
  base_price INT,
  image VARCHAR(255)
);

CREATE TABLE car_colors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  car_id INT,
  name VARCHAR(100),
  file VARCHAR(255),
  price INT,
  FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE
);

-- sample users
INSERT INTO users (email,password) VALUES ('test@gmail.com','1234');

-- sample cars
INSERT INTO cars (name,base_price,image) VALUES ('Toyota Fortuner',33000000,'fortuner_white.jpg');
INSERT INTO cars (name,base_price,image) VALUES ('MG Hector',2100000,'hector_red.jpg');
INSERT INTO cars (name,base_price,image) VALUES ('Tata Harrier',2600000,'harrier_blue.jpg');
INSERT INTO cars (name,base_price,image) VALUES ('Lord Alto',5000000,'alto.jpg');
INSERT INTO cars (name,base_price,image) VALUES ('Tata Nano',5000000,'nano.jpg');
INSERT INTO cars (name,base_price,image) VALUES ('Omni',5000000,'omni.jpg');

-- Fortuner
INSERT INTO car_colors (car_id,name,file,price) VALUES (1,'White','fortuner_white.jpg',0);
INSERT INTO car_colors (car_id,name,file,price) VALUES (1,'Black','fortuner_black.jpg',20000);

-- Hector
INSERT INTO car_colors (car_id,name,file,price) VALUES (2,'Red','hector_red.jpg',0);
INSERT INTO car_colors (car_id,name,file,price) VALUES (2,'Silver','hector_silver.jpg',15000);

-- Harrier
INSERT INTO car_colors (car_id,name,file,price) VALUES (3,'Blue','harrier_blue.jpg',0);
INSERT INTO car_colors (car_id,name,file,price) VALUES (3,'Grey','harrier_grey.jpg',18000);

-- Alto
INSERT INTO car_colors (car_id,name,file,price) VALUES (4,'White','alto.jpg',0);
INSERT INTO car_colors (car_id,name,file,price) VALUES (4,'Black','alto_black.jpg',50000);

-- Nano
INSERT INTO car_colors (car_id,name,file,price) VALUES (5,'White','nano.jpg',0);
INSERT INTO car_colors (car_id,name,file,price) VALUES (5,'Black','nano_black.jpg',40000);

-- Omni
INSERT INTO car_colors (car_id,name,file,price) VALUES (6,'White','omni.jpg',0);
INSERT INTO car_colors (car_id,name,file,price) VALUES (6,'Black','omni_black.jpg',30000);
