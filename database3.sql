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

/*Table structure for table `t_cms_adv` */

DROP TABLE IF EXISTS `t_cms_adv`;

CREATE TABLE `t_cms_adv` (
  `PK_ADV` int(11) NOT NULL AUTO_INCREMENT,
  `C_TITLE` varchar(222) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `C_DATE` date DEFAULT NULL,
  `C_LINK` varchar(222) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `C_ACTIVE` int(11) DEFAULT NULL,
  `C_POS` int(11) DEFAULT NULL,
  `C_IMG` varchar(222) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`PK_ADV`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `t_cms_adv` */

LOCK TABLES `t_cms_adv` WRITE;

insert  into `t_cms_adv`(`PK_ADV`,`C_TITLE`,`C_DATE`,`C_LINK`,`C_ACTIVE`,`C_POS`,`C_IMG`) values (5,' Liên quan đến vụ sập cầu','2014-03-09','áda',1,2,'WP_000046.jpg'),(8,'ádf','2014-03-09','http://google.com',1,2,'rihht2.PNG'),(9,'dsf','2014-03-09','dsfs',1,1,'quangcao1.jpg'),(10,' Liên quan đến vụ sập cầu','2014-03-09','sdas',1,1,'quangcao2.gif');

UNLOCK TABLES;

/*Table structure for table `t_cms_cate` */

DROP TABLE IF EXISTS `t_cms_cate`;

CREATE TABLE `t_cms_cate` (
  `PK_CATE` int(11) NOT NULL AUTO_INCREMENT,
  `C_NAME` varchar(222) CHARACTER SET utf8 DEFAULT NULL,
  `C_NAME_EN` varchar(222) DEFAULT NULL,
  `C_PARENT` int(11) DEFAULT NULL,
  `C_ACTIVE_CATE` int(11) DEFAULT NULL,
  `C_DATE_CATE` date DEFAULT NULL,
  `C_ORDER` int(11) DEFAULT NULL,
  PRIMARY KEY (`PK_CATE`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `t_cms_cate` */

LOCK TABLES `t_cms_cate` WRITE;

insert  into `t_cms_cate`(`PK_CATE`,`C_NAME`,`C_NAME_EN`,`C_PARENT`,`C_ACTIVE_CATE`,`C_DATE_CATE`,`C_ORDER`) values (1,'Pháp luật',NULL,0,1,'2014-04-05',2),(2,'Kinh tế',NULL,0,1,'2014-04-05',3),(3,'giai tri','Entertainment',0,1,'2014-03-08',NULL),(4,'cong nghe','Techonogise',0,1,'2014-04-05',4),(5,'Dien thoai123',NULL,2,1,'2014-03-08',NULL),(6,'Máy tính xách tay','Laptop',4,1,'2014-03-08',NULL),(7,'anh ninh thu do',NULL,1,1,'2014-03-09',NULL),(8,'an ninh quốc phòng',NULL,1,1,'2014-04-05',1);

UNLOCK TABLES;

/*Table structure for table `t_cms_cate_news` */

DROP TABLE IF EXISTS `t_cms_cate_news`;

CREATE TABLE `t_cms_cate_news` (
  `PK_CATE_NEWS` int(11) NOT NULL AUTO_INCREMENT,
  `FK_CATE` int(11) DEFAULT NULL,
  `FK_NEWS` int(11) DEFAULT NULL,
  PRIMARY KEY (`PK_CATE_NEWS`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `t_cms_cate_news` */

LOCK TABLES `t_cms_cate_news` WRITE;

insert  into `t_cms_cate_news`(`PK_CATE_NEWS`,`FK_CATE`,`FK_NEWS`) values (20,7,42),(21,1,42),(22,5,43),(23,2,43),(24,6,44),(25,4,44),(26,0,45),(27,5,46),(28,2,46);

UNLOCK TABLES;

/*Table structure for table `t_cms_cmt` */

DROP TABLE IF EXISTS `t_cms_cmt`;

CREATE TABLE `t_cms_cmt` (
  `PK_CMT` int(11) NOT NULL AUTO_INCREMENT,
  `FK_PERSON` int(11) DEFAULT NULL,
  `FK_NEWS` int(11) DEFAULT NULL,
  `C_CONTENT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `C_DATE` datetime DEFAULT NULL,
  `C_NAME_PERSON` varchar(222) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`PK_CMT`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `t_cms_cmt` */

LOCK TABLES `t_cms_cmt` WRITE;

insert  into `t_cms_cmt`(`PK_CMT`,`FK_PERSON`,`FK_NEWS`,`C_CONTENT`,`C_DATE`,`C_NAME_PERSON`) values (1,1,1,'qeqw',NULL,NULL),(2,1,1,'sfsdf',NULL,NULL),(3,1,1,'arwerq',NULL,NULL),(4,1,1,'srfqsf',NULL,NULL),(5,1,1,'Ã¡dasd',NULL,NULL),(6,1,1,'qáº»qwe',NULL,NULL),(7,2,1,'Ã¡da',NULL,NULL),(8,2,1,'Ã¡da',NULL,NULL),(9,2,1,'sada',NULL,NULL),(10,2,1,'tá»‘t',NULL,NULL),(11,2,1,'Ä‘Æ°á»£c cá»§a nÃ³ Ä‘áº¥y',NULL,'dsd'),(12,NULL,1,'hay day',NULL,NULL),(13,NULL,1,'sdfddd',NULL,NULL),(14,NULL,1,'sdfddd',NULL,NULL),(15,NULL,1,'asdas',NULL,NULL),(16,NULL,1,'xc',NULL,NULL),(17,NULL,2,'asda',NULL,NULL),(18,NULL,2,'asda',NULL,NULL),(19,NULL,16,'sds',NULL,NULL),(20,NULL,16,'ád',NULL,'ád'),(21,NULL,16,'sss',NULL,'sdfas'),(22,NULL,16,'ádas',NULL,'bao tuyên'),(23,NULL,18,'SDFs',NULL,'bao tuyên'),(24,NULL,18,'hay quas',NULL,'hong van'),(25,NULL,16,'bai nay hay the',NULL,'hong van 2'),(26,NULL,18,'ád',NULL,'sdas'),(27,NULL,28,'áda',NULL,'sd'),(28,NULL,28,'dfs',NULL,'f'),(29,NULL,44,'ưewe',NULL,'tuyeen'),(30,NULL,44,'hay thế',NULL,'hoang anh bảo tuyên'),(31,NULL,42,'s12312',NULL,'ssss');

UNLOCK TABLES;

/*Table structure for table `t_cms_news` */

DROP TABLE IF EXISTS `t_cms_news`;

CREATE TABLE `t_cms_news` (
  `PK_NEWS` int(11) NOT NULL AUTO_INCREMENT,
  `C_TITLE` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `C_SHORT_CONTENT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `C_CONTENT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `C_IMG` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `C_DATE` date DEFAULT NULL,
  `FK_PERSON` int(11) DEFAULT NULL,
  `C_ACTIVE` int(11) DEFAULT NULL,
  `FK_TYPE` int(11) DEFAULT NULL,
  `C_VIEWS` int(11) DEFAULT NULL,
  `C_LANG` enum('en','vi') DEFAULT 'vi',
  PRIMARY KEY (`PK_NEWS`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

/*Data for the table `t_cms_news` */

LOCK TABLES `t_cms_news` WRITE;

insert  into `t_cms_news`(`PK_NEWS`,`C_TITLE`,`C_SHORT_CONTENT`,`C_CONTENT`,`C_IMG`,`C_DATE`,`FK_PERSON`,`C_ACTIVE`,`FK_TYPE`,`C_VIEWS`,`C_LANG`) values (42,'Ngắm nhan sắc nõn nà của Miss Teen 2012','(TinVietOnline) - Sở hữu vẻ đẹp đáng yêu, trong sáng của lứa tuổi học trò, Nguyễn Thị Thu Trang đã đăng quang ngôi vị Miss Teen 2012.\r\n','<p><span style=\"color: rgb(0, 0, 0); font-family: arial, tahoma, sans-serif; font-size: 12px; line-height: normal;\">Trước c&acirc;u hỏi của ca sỹ Trung Dũng: &ldquo;Liệu khi trở th&agrave;nh ca sỹ nổi tiếng, Trang c&oacute; chắc chắn m&igrave;nh sẽ kh&ocirc;ng bị c&aacute;m dỗ?&ldquo; th&igrave; c&ocirc; chia sẻ: Chỉ cần nghĩ đến mẹ, đến gia đ&igrave;nh th&igrave; Trang sẽ kh&ocirc;ng bao giờ l&agrave;m điều g&igrave; đ&oacute; tr&aacute;i với lương t&acirc;m, đạo đức khiến mọi người phải thất vọng về m&igrave;nh</span></p>\r\n','IMG_3992.JPG','2014-04-27',2,1,3,24,'en'),(43,'ATM dịp Tết Nguyên đán: Nỗi lo đến hẹn lại lên','<p>dfffffffffffffffffffffffffffff</p>\r\n','<p>đffffffffffffffffffffffffffffffffffffff</p>\r\n','1560487_341404195999094_638133395_n.jpg','2014-04-13',2,1,2,2,'vi'),(44,'Những căn nhà “kì dị” tại Sài Gòn: Bắc thang, chui hầm để vào nhà!','<p>&aacute;dfffffffffffffffffff</p>\r\n','<p>ffffffffffffffffffffffffffffffffffffffff</p>\r\n','WP_000042.jpg','2014-04-13',2,1,1,16,'vi'),(45,'anh vui choi','<p><img alt=\"\" src=\"/mvc4/public/img.newsimages/1560487_341404195999094_638133395_n.jpg\" style=\"width: 704px; height: 960px;\" /></p>\r\n\r\n<p><img alt=\"\" src=\"/mvc4/public/img.newsimages/1560588_341404229332424_933749302_n.jpg\" style=\"width: 704px; height: 960px;\" /></p>\r\n','','WP_000045.jpg','2014-04-13',2,1,4,3,'vi'),(46,'anh vui choi','rtasgasargggggggggggggggg\r\n','','WP_000036.jpg','2014-04-27',2,1,4,3,'en');

UNLOCK TABLES;

/*Table structure for table `t_cms_person` */

DROP TABLE IF EXISTS `t_cms_person`;

CREATE TABLE `t_cms_person` (
  `PK_PERSON` int(11) NOT NULL AUTO_INCREMENT,
  `C_NAME` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `C_BIRTH` date DEFAULT NULL,
  `C_PASS` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `C_EMAIL` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `C_PHONE` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `C_GENDER` int(11) DEFAULT NULL,
  `C_ADDRESS` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `C_ROLE` int(11) DEFAULT NULL,
  `C_ACTIVE_PERSON` int(11) DEFAULT NULL,
  PRIMARY KEY (`PK_PERSON`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `t_cms_person` */

LOCK TABLES `t_cms_person` WRITE;

insert  into `t_cms_person`(`PK_PERSON`,`C_NAME`,`C_BIRTH`,`C_PASS`,`C_EMAIL`,`C_PHONE`,`C_GENDER`,`C_ADDRESS`,`C_ROLE`,`C_ACTIVE_PERSON`) values (1,'tuyen',NULL,'1234','tuyen@gmail.com','123',1,'sdf',2,1),(2,'Admin','2014-02-03','123','admin@gmail.com','',1,'Nam Dinh',1,1),(5,'bao hoang anh tuyen',NULL,'12','hongvan@gmail.com',NULL,NULL,NULL,NULL,1),(6,'bao hoang anh tuyen',NULL,'12','hongvan@gmail.com',NULL,NULL,NULL,2,NULL),(7,'bao tuyen',NULL,'1234','tenten@gmail.com',NULL,NULL,NULL,2,NULL),(8,'ten ten',NULL,'123','tenten@gmail.com',NULL,NULL,NULL,2,NULL),(9,'ten ten',NULL,'123','tenten@gmail.com',NULL,NULL,NULL,2,NULL);

UNLOCK TABLES;

/*Table structure for table `t_cms_type` */

DROP TABLE IF EXISTS `t_cms_type`;

CREATE TABLE `t_cms_type` (
  `PK_TYPE` int(11) NOT NULL AUTO_INCREMENT,
  `C_TYPE_NAME` varchar(222) DEFAULT NULL,
  `C_TYPE_ACTIVE` int(11) DEFAULT '1',
  PRIMARY KEY (`PK_TYPE`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `t_cms_type` */

LOCK TABLES `t_cms_type` WRITE;

insert  into `t_cms_type`(`PK_TYPE`,`C_TYPE_NAME`,`C_TYPE_ACTIVE`) values (1,'Tieu diem',1),(2,'tin noi bat',1),(3,'Tin thuong',1),(4,'Tin anh',1);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
