/*
SQLyog Community v8.4 Beta1
MySQL - 5.0.27-community-nt : Database - books_cart
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`books_cart` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `books_cart`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `username` char(16) NOT NULL,
  `PASSWORD` char(40) NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`username`,`PASSWORD`) values ('admin','d033e22ae348aeb5660fc2140aec35850c4da997');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `cat_id` int(10) unsigned NOT NULL auto_increment,
  `catname` char(60) NOT NULL,
  PRIMARY KEY  (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `categories` */

insert  into `categories`(`cat_id`,`catname`) values (1,'Printers');

/*Table structure for table `order_items` */

DROP TABLE IF EXISTS `order_items`;

CREATE TABLE `order_items` (
  `orderid` int(10) unsigned NOT NULL,
  `item_id` varchar(13) NOT NULL,
  `item_price` float(4,2) NOT NULL,
  `quantity` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY  (`orderid`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `order_items` */

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `orderid` int(10) unsigned NOT NULL auto_increment,
  `customerid` int(10) unsigned NOT NULL,
  `amount` float(6,2) default NULL,
  `DATE` date NOT NULL,
  `order_status` char(10) default NULL,
  `ship_name` char(60) NOT NULL,
  `ship_address` char(80) NOT NULL,
  `ship_city` char(30) NOT NULL,
  `ship_state` char(20) default NULL,
  `ship_zip` char(10) default NULL,
  `ship_country` char(20) NOT NULL,
  PRIMARY KEY  (`orderid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `orders` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` varchar(64) NOT NULL,
  `name` varchar(256) default NULL,
  `cat_id` int(32) default NULL,
  `vendor` varchar(128) default NULL,
  `price` double default NULL,
  `quantity` int(32) default NULL,
  `img_fname` text,
  `description` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`id`,`name`,`cat_id`,`vendor`,`price`,`quantity`,`img_fname`,`description`) values ('1','nkfjw',1,'kbfwk',35,0,NULL,'            nfklw2n'),('1000','deskjet',1,'hp',556,0,NULL,'            conwnlcw'),('266','grthe',1,'agrw',13,0,'','            fwgwgw'),('467','pou92u',1,'iyrewi',367,0,'817536eeb692bebfd7c98a38f72f3f72991b0fd4.jpg','            thatoe'),('68','ugj',1,'ogbkj',67,0,'','            tgvuj');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(64) NOT NULL auto_increment,
  `username` varchar(128) default NULL,
  `password` text,
  `email` text,
  `phone` varchar(64) default NULL,
  `level` int(4) NOT NULL default '2',
  `address` varchar(128) default NULL,
  `city` varchar(128) default NULL,
  `state` varbinary(128) default NULL,
  `zip` varchar(128) default NULL,
  `country` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`email`,`phone`,`level`,`address`,`city`,`state`,`zip`,`country`) values (1,'user1','7c4a8d09ca3762af61e59520943dc26494f8941b','fneknfk',NULL,2,NULL,NULL,NULL,NULL,NULL),(2,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','admin@shop.com','31784',4,NULL,NULL,NULL,NULL,NULL),(1412528138,'user12','7c4a8d09ca3762af61e59520943dc26494f8941b','k@k.ocm','123456',2,NULL,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
