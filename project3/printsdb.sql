-- Script: printsdb.sql - Create the printsdb database
--
CREATE DATABASE printsdb;
-- If working on the class server comment out the line above and
-- put the tables in your pesonal database rather than printsdb
USE printsdb;
--
-- Table structure for table `artists`
--
DROP TABLE IF EXISTS `artists`;
CREATE TABLE `artists` (
  `artist_id` int(6) unsigned NOT NULL auto_increment,
  `first_name` varchar(40) default NULL,
  `last_name` varchar(40) NOT NULL,
  PRIMARY KEY  (`artist_id`),
  KEY `full_name` (`last_name`,`first_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artists`
--
INSERT INTO `artists`
  VALUES (1,'Erik','Jefferson'),
         (2,'staff','NASA')
;
--
-- Table structure for table `customers`
--
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `customer_id` int(6) unsigned NOT NULL auto_increment,
  `first_name` varchar(40) default NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) default NULL,
  `address` varchar(40) default NULL,
  `city` varchar(30) NOT NULL,
  `state` char(2) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `card_type` char(1) NOT NULL default 'V',
  `card_number` tinyblob,
  `registration_date` datetime,
  PRIMARY KEY  (`customer_id`),
  KEY `username` (`username`),
  KEY `full_name` (`last_name`,`first_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `orders`
--
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(10) unsigned NOT NULL auto_increment,
  `customer_id` int(6) unsigned NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `approved` char(1) NOT NULL default 'N',
  `cart` varchar(75) NOT NULL,
  PRIMARY KEY  (`order_id`),
  KEY `customer_id` (`customer_id`),
  KEY `order_date` (`order_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `prints`
--
DROP TABLE IF EXISTS `prints`;
CREATE TABLE `prints` (
  `print_id` int(6) unsigned NOT NULL auto_increment,
  `artist_id` int(6) unsigned NOT NULL,
  `print_name` varchar(60) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `size` varchar(60) default NULL,
  `description` varchar(255) default NULL,
  `image_name` varchar(40) default NULL,
  PRIMARY KEY  (`print_id`),
  KEY `artist_id` (`artist_id`),
  KEY `print_name` (`print_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prints`
--
INSERT INTO `prints`
  VALUES (1,1,'Dragon','11.00','988 x 922 pixels','Drawing of a dragon on green chalkboard.','dragon_print.jpg'),
         (2,1,'PHP Mammal','10.95','642x540 pixels','Drawing of a mammal representing PHP, destroying the eggs of dinosaurs representing Java and .NET.','php_mammal_print.gif'),
         (3,2,'NASA Mission','2.50','1024x768 pixels','NASA Mission superimposed on two jets, an F-16XL and an SR-71, in flight.','jets_print.jpg'),
         (4,2,'Earth Rise','2.50','631x477 pixels','Earth rising over the icy horizon of another world.','earth_print.jpg'),
         (5,2,'Orion','2.50','648x700 pixels','The Orion Nebula','orion_print.jpg'),
         (6,2,'The Helios Prototype','2.50','1024x768 pixels','The Helios Prototype in flight, with the NASA Mission superimposed.','helios_print.jpg')
;

COMMIT;
GRANT ALL ON printsdb.* TO 'printsdb'@'localhost' IDENTIFIED BY PASSWORD 'project4';
