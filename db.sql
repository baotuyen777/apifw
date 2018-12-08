/*
SQLyog Ultimate v12.09 (32 bit)
MySQL - 10.1.33-MariaDB : Database - wordpress
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `date` */

DROP TABLE IF EXISTS `date`;

CREATE TABLE `date` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `date` */

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `status` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `orders` */

insert  into `orders`(`id`,`user_id`,`date`,`note`,`total`,`status`) values (1,0,'2018-12-14',NULL,0,1),(4,1,'0000-00-00','sdfs',1212111,3),(5,1,'0000-00-00','sdfs',1212111,1),(7,1,'0000-00-00','asdsa',1111,1),(8,1,'0000-00-00','asdsa',1111,1),(9,1,'0000-00-00','asdsa',1111,1),(10,1,'0000-00-00','dfsss',1111,1),(11,1,'0000-00-00','dfsss',1111,1),(12,1,'0000-00-00','dfsss',1111,1),(13,1,'0000-00-00','dfsss',1111,1),(14,1,'0000-00-00','dfsss',1111,1),(15,1,'0000-00-00','dfsss',1111,1),(16,1,'0000-00-00','dfsss',1111,1),(17,1,'0000-00-00','sdas',1212111,1),(18,1,'0000-00-00','dss',1111,1),(19,1,'0000-00-00','dss',1111,1);

/*Table structure for table `orders_detail` */

DROP TABLE IF EXISTS `orders_detail`;

CREATE TABLE `orders_detail` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) unsigned NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `orders_detail` */

insert  into `orders_detail`(`id`,`order_id`,`product_id`,`quantity`) values (1,3,10,1),(2,4,12,1),(3,5,12,1),(4,6,10,1),(5,7,10,1),(6,8,10,1),(7,9,10,1),(8,10,10,1),(9,11,10,1),(10,12,10,1),(11,13,10,1),(12,14,10,1),(13,15,10,1),(14,16,10,1),(15,17,12,1),(16,18,10,1),(17,19,10,1),(18,20,10,1),(19,21,10,1);

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `slug` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`id`,`name`,`slug`,`price`,`category`,`description`,`image`,`status`) values (10,'1231231','23123',1111,0,'',NULL,1),(12,'BÃ¡nh má»³','bm',1212111,0,'11',NULL,1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `activation_key` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `birthday` date DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT '1',
  `role` tinyint(4) DEFAULT '1',
  `wallet` float DEFAULT '0',
  `status` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`activation_key`,`name`,`birthday`,`avatar`,`gender`,`role`,`wallet`,`status`) values (1,'baotuyen111@gmail.com','202cb962ac59075b964b07152d234b70',NULL,'tuyen',NULL,NULL,1,2,0,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
