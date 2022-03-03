/*
SQLyog Ultimate v11.25 (64 bit)
MySQL - 5.7.26 : Database - tp51
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(12) DEFAULT NULL,
  `user_phone` varchar(11) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `user_password` varchar(12) DEFAULT NULL,
  `sex` enum('1','2','3') DEFAULT NULL,
  `head_img` varchar(250) DEFAULT NULL,
  `create_time` varchar(11) DEFAULT NULL,
  `update_time` varchar(11) DEFAULT NULL,
  `token` varchar(250) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `last_time` varchar(11) DEFAULT NULL,
  `code` enum('0','1','2','3') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `admin` */

insert  into `admin`(`id`,`user_name`,`user_phone`,`email`,`user_password`,`sex`,`head_img`,`create_time`,`update_time`,`token`,`ip`,`last_time`,`code`) values (1,'json','12312312312','lc1114123@163.coms','123123','1','/tp51t/public/static/adminheadimgs/20210907/202109078168.jpg',NULL,'1630983500','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJKb3V6ZXl1IiwidWlkIjoiaWQiLCJpYXQiOjE2MzA5ODM0NzIsIm5iZiI6MTYzMDk4MzQ3NSwiZXhwIjoxNjMwOTgzNTAyfQ.XzW9K_6UyZkAQIWEOUjrFmHhipNqwkAsD5yrVBaF19U',NULL,'1630983500','0'),(2,NULL,'123',NULL,'123',NULL,NULL,NULL,'1630980433','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJKb3V6ZXl1IiwidWlkIjoiaWQiLCJpYXQiOjE2MzA5ODA0MTksIm5iZiI6MTYzMDk4MDQyMiwiZXhwIjoxNjMwOTgwNDQ5fQ.rLnGmfki7Up8dJ4zVF5i8ZjnwL8CsYIgqvsA5dlvfxM',NULL,'1630980433','0'),(3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0'),(4,NULL,NULL,NULL,NULL,NULL,NULL,'1630718560','1630718560',NULL,NULL,NULL,'0'),(5,NULL,NULL,NULL,NULL,NULL,NULL,'1630718674','1630718674',NULL,NULL,NULL,'0'),(6,NULL,NULL,NULL,NULL,NULL,NULL,'1630726962','1630726962',NULL,NULL,NULL,'0');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
