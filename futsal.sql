/*
SQLyog Ultimate v12.5.1 (32 bit)
MySQL - 5.7.33 : Database - futsal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`futsal` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `futsal`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `m_booking` */

DROP TABLE IF EXISTS `m_booking`;

CREATE TABLE `m_booking` (
  `id_booking` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tuser` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_lapangan` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_booking` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_berakhir` time NOT NULL,
  `status` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_biaya` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_booking`),
  KEY `m_booking_id_lapangan_foreign` (`id_lapangan`),
  KEY `m_booking_id_tuser_foreign` (`id_tuser`),
  CONSTRAINT `m_booking_id_lapangan_foreign` FOREIGN KEY (`id_lapangan`) REFERENCES `m_lapangan` (`id_lapangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `m_booking_id_tuser_foreign` FOREIGN KEY (`id_tuser`) REFERENCES `t_user` (`id_tuser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `m_booking` */

insert  into `m_booking`(`id_booking`,`id_tuser`,`id_lapangan`,`tgl_booking`,`jam_mulai`,`jam_berakhir`,`status`,`total_biaya`,`created_at`,`updated_at`) values 
('2302100001','FA000004','2302080001','2023-02-10','05:00:00','06:00:00','1','130000','2023-02-10 09:39:00','2023-02-10 09:39:00'),
('2302100002','FA000004','2302080001','2023-02-10','07:00:00','09:00:00','1','260000',NULL,NULL);

/*Table structure for table `m_lapangan` */

DROP TABLE IF EXISTS `m_lapangan`;

CREATE TABLE `m_lapangan` (
  `id_lapangan` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_lapangan` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dsc_lapangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_lapangan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL,
  `status_lapangan` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_lapangan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_lapangan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `m_lapangan` */

insert  into `m_lapangan`(`id_lapangan`,`kode_lapangan`,`dsc_lapangan`,`tipe_lapangan`,`jam_buka`,`jam_tutup`,`status_lapangan`,`harga_lapangan`,`created_at`,`updated_at`) values 
('2302080001','LAP001','LAPANGAN 1','Sintetis','08:00:00','00:00:00','1','130000','2023-02-08 23:28:24','2023-02-08 23:32:43'),
('2302140001','LAP002','LAPANGAN 2','Sintetis','08:00:00','00:00:00','1','130000','2023-02-14 13:42:51','2023-02-14 13:42:51');

/*Table structure for table `m_transaksi` */

DROP TABLE IF EXISTS `m_transaksi`;

CREATE TABLE `m_transaksi` (
  `id_mtransaksi` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_rek` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rek` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_bank` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_mtransaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `m_transaksi` */

insert  into `m_transaksi`(`id_mtransaksi`,`nama_rek`,`no_rek`,`jenis_bank`,`created_at`,`updated_at`) values 
('2302070001','MULYADI RIZKI PUTRA','123456','BNI','2023-02-07 15:03:26','2023-02-07 15:03:26');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(5,'2023_02_05_214731_create_t_user_table',2),
(6,'2023_02_05_215242_create_t_user_table',3),
(7,'2023_02_05_224626_create_t_user_table',4),
(84,'2023_02_06_091104_create_m_booking_table',5),
(85,'2014_10_12_100000_create_password_resets_table',6),
(86,'2019_08_19_000000_create_failed_jobs_table',6),
(87,'2019_12_14_000001_create_personal_access_tokens_table',6),
(88,'2023_02_05_231138_create_t_user_table',6),
(89,'2023_02_05_233905_create_m_transaksi_table',6),
(90,'2023_02_06_000000_create_users_table',6),
(91,'2023_02_06_085238_create_m_lapangan_table',6),
(92,'2023_02_06_085735_create_t_fasilitas_table',6),
(93,'2023_02_06_092414_create_m_booking_table',6),
(94,'2023_02_06_092746_create_t_transaksi_table',6),
(95,'2023_02_06_093017_create_t_history_table',6);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `t_fasilitas` */

DROP TABLE IF EXISTS `t_fasilitas`;

CREATE TABLE `t_fasilitas` (
  `id_fasilitas` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_lapangan` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dsc_fasilitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_fasilitas`),
  KEY `t_fasilitas_id_lapangan_foreign` (`id_lapangan`),
  CONSTRAINT `t_fasilitas_id_lapangan_foreign` FOREIGN KEY (`id_lapangan`) REFERENCES `m_lapangan` (`id_lapangan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `t_fasilitas` */

insert  into `t_fasilitas`(`id_fasilitas`,`id_lapangan`,`dsc_fasilitas`,`created_at`,`updated_at`) values 
('FA001','2302080001','Wc, Bola','2023-02-08 23:28:24','2023-02-08 23:28:24'),
('FA002','2302140001','Toilet, Rompi Bola','2023-02-14 13:42:51','2023-02-14 13:42:51');

/*Table structure for table `t_history` */

DROP TABLE IF EXISTS `t_history`;

CREATE TABLE `t_history` (
  `id_history` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_transaksi` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_history`),
  KEY `t_history_id_transaksi_foreign` (`id_transaksi`),
  CONSTRAINT `t_history_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `t_transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `t_history` */

/*Table structure for table `t_transaksi` */

DROP TABLE IF EXISTS `t_transaksi`;

CREATE TABLE `t_transaksi` (
  `id_transaksi` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tuser` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_booking` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mtransaksi` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `bukti_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `t_transaksi_id_tuser_foreign` (`id_tuser`),
  KEY `t_transaksi_id_mtransaksi_foreign` (`id_mtransaksi`),
  KEY `t_transaksi_id_booking_foreign` (`id_booking`),
  CONSTRAINT `t_transaksi_id_booking_foreign` FOREIGN KEY (`id_booking`) REFERENCES `m_booking` (`id_booking`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_transaksi_id_mtransaksi_foreign` FOREIGN KEY (`id_mtransaksi`) REFERENCES `m_transaksi` (`id_mtransaksi`),
  CONSTRAINT `t_transaksi_id_tuser_foreign` FOREIGN KEY (`id_tuser`) REFERENCES `t_user` (`id_tuser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `t_transaksi` */

/*Table structure for table `t_user` */

DROP TABLE IF EXISTS `t_user`;

CREATE TABLE `t_user` (
  `id_tuser` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `j_kel` int(11) NOT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tuser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `t_user` */

insert  into `t_user`(`id_tuser`,`nama`,`tgl_lahir`,`j_kel`,`no_hp`,`email`,`alamat`,`created_at`,`updated_at`) values 
('00000001','MULYADI RIZKI PUTRA','2001-07-04',1,'082117875570','mulyadirizkiputra10@gmail.com','Kota Padang','2023-02-06 12:30:08','2023-02-06 12:30:08'),
('FA000002','PEMILIK FUTSAL','2001-07-04',1,'082117875570','owner@@gmail.com','Kota Padang','2023-02-07 22:26:51','2023-02-07 22:26:51'),
('FA000003','REZA ANDESTA','2001-05-21',1,'08985897901','rezaandesta29@gmail.com','Kota Padang','2023-02-07 22:33:23','2023-02-07 22:33:23'),
('FA000004','RICAL CANDRA','2023-02-08',1,'082117875570','rical@gmail.com','Padang','2023-02-08 12:03:50','2023-02-08 12:03:50');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` int(11) NOT NULL,
  `id_tuser` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id_tuser_foreign` (`id_tuser`),
  CONSTRAINT `users_id_tuser_foreign` FOREIGN KEY (`id_tuser`) REFERENCES `t_user` (`id_tuser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`roles`,`id_tuser`,`remember_token`,`created_at`,`updated_at`) values 
(3,'mulyadirizki','$2y$10$1xNo6xQHw2Wqr3SYIsXiFu4Qav7lmdpXBRefeBio12UjuwGaT4zd6',2,'00000001',NULL,'2023-02-06 12:30:08','2023-02-06 12:30:08'),
(4,'pemilik','$2y$10$98.obYIgw2KfwnMSBQZEbOuUbkhGTKDAYccfM06BXuKoIZPzAPr0u',1,'FA000002',NULL,'2023-02-07 22:26:52','2023-02-07 22:26:52'),
(5,'reza','$2y$10$519UBJAptMG9BkmaXmJcXecYxVlDN3q7j/jLLWEYPnMzY2IloM0BW',3,'FA000003',NULL,'2023-02-07 22:33:23','2023-02-07 22:33:23'),
(6,'rical','$2y$10$CPmLQ9mEovOYrQguoZwNqeDmIgM/TuFod0M5ggdagx.y4rO87S7vG',3,'FA000004',NULL,'2023-02-08 12:03:50','2023-02-08 12:03:50');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
