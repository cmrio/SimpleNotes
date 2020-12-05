/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.11-MariaDB : Database - notes_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`notes_db` /*!40100 DEFAULT CHARACTER SET cp1251 COLLATE cp1251_ukrainian_ci */;

USE `notes_db`;

/*Table structure for table `notetbl` */

DROP TABLE IF EXISTS `notetbl`;

CREATE TABLE `notetbl` (
  `ID_Note` int(255) NOT NULL AUTO_INCREMENT,
  `Text_Note` longtext COLLATE cp1251_ukrainian_ci NOT NULL,
  `Usr_ID` int(255) NOT NULL,
  `Date_Note` date NOT NULL,
  PRIMARY KEY (`ID_Note`),
  KEY `Usr_ID` (`Usr_ID`),
  CONSTRAINT `notetbl_ibfk_1` FOREIGN KEY (`Usr_ID`) REFERENCES `usertbl` (`ID_User`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=275 DEFAULT CHARSET=cp1251 COLLATE=cp1251_ukrainian_ci;

/*Data for the table `notetbl` */

insert  into `notetbl`(`ID_Note`,`Text_Note`,`Usr_ID`,`Date_Note`) values 
(274,'note0',15,'2020-12-05');

/*Table structure for table `usertbl` */

DROP TABLE IF EXISTS `usertbl`;

CREATE TABLE `usertbl` (
  `ID_User` int(255) NOT NULL AUTO_INCREMENT,
  `Login_User` char(22) COLLATE cp1251_ukrainian_ci NOT NULL,
  `Pass_User` char(22) COLLATE cp1251_ukrainian_ci NOT NULL,
  `Hash_User` varchar(32) COLLATE cp1251_ukrainian_ci NOT NULL,
  PRIMARY KEY (`ID_User`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=cp1251 COLLATE=cp1251_ukrainian_ci;

/*Data for the table `usertbl` */

insert  into `usertbl`(`ID_User`,`Login_User`,`Pass_User`,`Hash_User`) values 
(15,'user1','d9b1d7db4cd6e70935368a','1df4a6f4cd5936c1a2d3148a329125a0'),
(16,'user2','d9b1d7db4cd6e70935368a','8423506e44bcea6ee8b22563e5864b30'),
(17,'user3','d9b1d7db4cd6e70935368a','eed48e467a57bcf2566230e1e7610d31'),
(18,'123','d9b1d7db4cd6e70935368a','787a5c7ceb52d929f82a8dc99aabbb2f'),
(19,'uwe','897c8fde25c5cc5270cda6',''),
(20,'qwe','e3778feb69ed8fff43387d',''),
(21,'eqw','7739d58e9605892a77f4e2',''),
(22,'qwty1','f1fa328c5b7458cfd0e1a8',''),
(23,'user4','b348d68ea9ad5be2195c0d',''),
(24,'user5','b552ee81b40807cd6f4e92',''),
(25,'user6','b552ee81b40807cd6f4e92','7f5deeeab211cdd704e3ed98eece7f2d'),
(26,'qwerty1','ae534e4e5ebc114a51bd1f','75c8c49c4c2adab52c498536b66d11b3'),
(27,'qwerty','f1fa328c5b7458cfd0e1a8','9771d3d1c6615c56de6a142082a59ffa'),
(28,'usergtr','bcd36afe8812f55c33857f','fe724cebdc7556139233f852abd13b0e');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
