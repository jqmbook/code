-- Adminer 3.5.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `webapp_restaurant`;
CREATE DATABASE `webapp_restaurant` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `webapp_restaurant`;

DROP TABLE IF EXISTS `Bill`;
CREATE TABLE Bill(
  bill_id int(6) AUTO_INCREMENT,
  total int(11),
  table_id int(6),
  payment_type varchar(20),
  datetime datetime,
  
  PRIMARY KEY (bill_id),
  FOREIGN KEY (table_id) REFERENCES DinningTable(table_id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `Bill_Detail`;
CREATE TABLE Bill_Detail(
  bill_id int(6),
  menu_id int(6),
  price int(11),
  quantity int(3),
  amount int(11),
  
  PRIMARY KEY (bill_id, menu_id),
  FOREIGN KEY (menu_id) REFERENCES Menu(menu_id),
  FOREIGN KEY (bill_id) REFERENCES Bill(bill_id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `Category`;
CREATE TABLE Category(
  category_id int(6) AUTO_INCREMENT,
  category_name varchar(100),
  category_picture varchar(255),
  
  PRIMARY KEY(category_id)
) ENGINE=InnoDB;

INSERT INTO Category VALUES
(1,	'อาหาร',	'menupics/food.jpg'),
(2,	'เครื่องดื่ม',	'menupics/drink.jpg');

DROP TABLE IF EXISTS `DinningTable`;
CREATE TABLE DinningTable(
  table_id int(6) AUTO_INCREMENT,
  table_number varchar(32),
  table_status varchar(32),
  
  PRIMARY KEY(table_id),
  UNIQUE(table_number)
) ENGINE=InnoDB;

INSERT INTO DinningTable VALUES
(1,	'1A',	'ว่าง'),
(2,	'2A',	'ว่าง'),
(3,	'3A',	'ว่าง'),
(4,	'4A',	'ว่าง'),
(5,	'5A',	'ว่าง'),
(6,	'6A',	'ว่าง'),
(7,	'7A',	'ว่าง'),
(8,	'8A',	'ว่าง'),
(9,	'9A',	'ว่าง');

DROP TABLE IF EXISTS `Menu`;
CREATE TABLE Menu(
  menu_id int(6) AUTO_INCREMENT,
  menu_name varchar(100),
  menu_price int(11),
  menu_picture varchar(255),
  category_id int(6),
  
  PRIMARY KEY(menu_id),
  FOREIGN KEY(category_id) REFERENCES Category(category_id)
) ENGINE=InnoDB;

INSERT INTO Menu VALUES
(1,	'ข้าวหมูแดง',	35,	'menupics/red_pork_with_rice.jpg',	1),
(2,	'ข้าวหน้าเป็ด',	40,	'menupics/roast_duck_over_rice.jpg',	1),
(3,	'ข้าวกะเพราไก่',	40,	'menupics/fried_chicken_with_basil.jpg',	1),
(4,	'น้ำเปล่า',	5,	'menupics/drinking_water.jpg',	2),
(5,	'น้ำเก็กฮวย',	10,	'menupics/chrysanthemum_tea.jpg',	2),
(6,	'คาปูชิโน่เย็น',	45,	'menupics/capuchino.jpg',	2);

DROP TABLE IF EXISTS `Temp_Orders`;
CREATE TABLE Temp_Orders(
  temp_id int(6) AUTO_INCREMENT,
  table_id int(6),
  menu_id int(6),
  quantity int(3),
  datetime datetime,
  status varchar(30),
  ip varchar(15),
  chef_message varchar(100),
  
  PRIMARY KEY(temp_id),
  FOREIGN KEY(table_id) REFERENCES DinningTable(table_id),
  FOREIGN KEY(menu_id) REFERENCES Menu(menu_id)
) ENGINE=InnoDB;

