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
) ENGINE=InnoDB AUTO_INCREMENT=278 DEFAULT CHARSET=cp1251 COLLATE=cp1251_ukrainian_ci;

/*Data for the table `notetbl` */

/*Table structure for table `usertbl` */

DROP TABLE IF EXISTS `usertbl`;

CREATE TABLE `usertbl` (
  `ID_User` int(255) NOT NULL AUTO_INCREMENT,
  `Login_User` char(22) COLLATE cp1251_ukrainian_ci NOT NULL,
  `Pass_User` char(50) COLLATE cp1251_ukrainian_ci NOT NULL,
  `Hash_User` varchar(64) COLLATE cp1251_ukrainian_ci NOT NULL,
  PRIMARY KEY (`ID_User`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=cp1251 COLLATE=cp1251_ukrainian_ci;

/*Data for the table `usertbl` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
