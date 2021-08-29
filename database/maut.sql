/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.14-MariaDB : Database - maut
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`maut` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `maut`;

/*Table structure for table `kriteria` */

DROP TABLE IF EXISTS `kriteria`;

CREATE TABLE `kriteria` (
  `id_kriteria` char(5) NOT NULL,
  `nama_kriteria` varchar(50) DEFAULT NULL,
  `bobot_kriteria` double DEFAULT NULL,
  `min_kriteria` double DEFAULT NULL,
  `max_kriteria` double DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `kriteria` */

insert  into `kriteria`(`id_kriteria`,`nama_kriteria`,`bobot_kriteria`,`min_kriteria`,`max_kriteria`) values 
('K-001','Suhu',0.2,4,4),
('K-002','Tekanan Udara',0.5,NULL,NULL),
('K-003','asd',3,3,3);

/*Table structure for table `nilai_bobot` */

DROP TABLE IF EXISTS `nilai_bobot`;

CREATE TABLE `nilai_bobot` (
  `id_bobot` char(5) NOT NULL,
  `kriteria_bobot` char(5) DEFAULT NULL,
  `nama_bobot` varchar(50) DEFAULT NULL,
  `nilai_bobot` double DEFAULT NULL,
  PRIMARY KEY (`id_bobot`),
  KEY `kriteria_bobot` (`kriteria_bobot`),
  CONSTRAINT `nilai_bobot_ibfk_1` FOREIGN KEY (`kriteria_bobot`) REFERENCES `kriteria` (`id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `nilai_bobot` */

insert  into `nilai_bobot`(`id_bobot`,`kriteria_bobot`,`nama_bobot`,`nilai_bobot`) values 
('NB001','K-001','SD',1);

/*Table structure for table `penilaian` */

DROP TABLE IF EXISTS `penilaian`;

CREATE TABLE `penilaian` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `tanaman_nilai` char(5) DEFAULT NULL,
  `kriteria_nilai` char(5) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `tanaman_nilai` (`tanaman_nilai`),
  KEY `kriteria_nilai` (`kriteria_nilai`),
  CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`tanaman_nilai`) REFERENCES `tanaman` (`id_tanaman`),
  CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`kriteria_nilai`) REFERENCES `kriteria` (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `penilaian` */

insert  into `penilaian`(`id_nilai`,`tanaman_nilai`,`kriteria_nilai`,`nilai`) values 
(1,'TA-01','K-001',1),
(2,'TA-01','K-002',2),
(3,'TA-01','K-003',3),
(4,'TA-02','K-001',4),
(5,'TA-02','K-002',5),
(6,'TA-02','K-003',6);

/*Table structure for table `tanaman` */

DROP TABLE IF EXISTS `tanaman`;

CREATE TABLE `tanaman` (
  `id_tanaman` char(5) NOT NULL,
  `nama_tanaman` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_tanaman`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tanaman` */

insert  into `tanaman`(`id_tanaman`,`nama_tanaman`) values 
('TA-01','Padi'),
('TA-02','Jagung');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level_user` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`password`,`level_user`) values 
(1,'admin','admin',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
