/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.5.9 : Database - mvc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`mvc` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mvc`;

/*Table structure for table `t_cms_cmt` */

DROP TABLE IF EXISTS `t_cms_cmt`;

CREATE TABLE `t_cms_cmt` (
  `PK_CMT` int(11) NOT NULL AUTO_INCREMENT,
  `FK_PERSON` int(11) DEFAULT NULL,
  `FK_NEWS` int(11) DEFAULT NULL,
  `C_CONTENT` text,
  `C_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`PK_CMT`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `t_cms_cmt` */

insert  into `t_cms_cmt`(`PK_CMT`,`FK_PERSON`,`FK_NEWS`,`C_CONTENT`,`C_DATE`) values (1,1,1,'qeqw',NULL),(2,1,1,'sfsdf',NULL),(3,1,1,'arwerq',NULL),(4,1,1,'srfqsf',NULL);

/*Table structure for table `t_cms_news` */

DROP TABLE IF EXISTS `t_cms_news`;

CREATE TABLE `t_cms_news` (
  `PK_NEWS` int(11) NOT NULL AUTO_INCREMENT,
  `C_TITLE` varchar(255) DEFAULT NULL,
  `C_CONTENT` text,
  `C_IMG` varchar(255) DEFAULT NULL,
  `C_DATE` datetime DEFAULT NULL,
  `FK_PERSON` int(11) DEFAULT NULL,
  PRIMARY KEY (`PK_NEWS`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `t_cms_news` */

insert  into `t_cms_news`(`PK_NEWS`,`C_TITLE`,`C_CONTENT`,`C_IMG`,`C_DATE`,`FK_PERSON`) values (1,'asdf','',NULL,'2014-03-02 00:00:00',1);

/*Table structure for table `t_cms_person` */

DROP TABLE IF EXISTS `t_cms_person`;

CREATE TABLE `t_cms_person` (
  `PK_PERSON` int(11) NOT NULL AUTO_INCREMENT,
  `C_NAME` varchar(255) DEFAULT NULL,
  `C_BIRTH` datetime DEFAULT NULL,
  `C_PASS` varchar(255) DEFAULT NULL,
  `C_EMAIL` varchar(255) DEFAULT NULL,
  `C_PHONE` varchar(255) DEFAULT NULL,
  `C_GENDER` int(11) DEFAULT NULL,
  `C_ADDRESS` varchar(255) DEFAULT NULL,
  `C_ROLE` int(11) DEFAULT NULL,
  PRIMARY KEY (`PK_PERSON`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `t_cms_person` */

insert  into `t_cms_person`(`PK_PERSON`,`C_NAME`,`C_BIRTH`,`C_PASS`,`C_EMAIL`,`C_PHONE`,`C_GENDER`,`C_ADDRESS`,`C_ROLE`) values (1,'tuyen',NULL,'1','tuyen@gmail.com','123',1,'sdf',1),(2,'bao hoang anh tuyen','2014-02-03 00:00:00','1','admin@gmail.com','',1,'Nam Dinh',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
