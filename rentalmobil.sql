/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.25-MariaDB : Database - rentalmobil
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rentalmobil` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `rentalmobil`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `m_mobil` */

DROP TABLE IF EXISTS `m_mobil`;

CREATE TABLE `m_mobil` (
  `id_mobil` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_mobil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_pol` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warna` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `th_mobil` date NOT NULL,
  `merk_mobil` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_mobil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_sewa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `denda_sewa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_mobil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `m_mobil` */

insert  into `m_mobil`(`id_mobil`,`nama_mobil`,`no_pol`,`warna`,`th_mobil`,`merk_mobil`,`img_mobil`,`harga_sewa`,`denda_sewa`,`status`,`created_at`,`updated_at`) values 
('2303120001','AVANZA','BA 1234 MT','Hitam','2020-07-10','Toyota','38v19T8twK67zAraO2euKNzMF4R7AQZJlie9NDbY.jpg','250000','250000',2,'2023-03-12 14:45:48','2023-03-21 16:13:51'),
('2303140001','RUSH TRD','BA 111 IQ','Putih Ss','2021-02-10','Toyota','1JTaakam5si8BxFsvgBkHY5YB8nLyjfkJHXlJzWy.png','250000','250000',2,'2023-03-14 03:25:27','2023-03-21 16:11:18'),
('2303210001','YARIS','BA 5023 PH','KUNING','2023-02-07','TOYOTA','mFaHgPKWMr0TzeDvAcPdPckscXeO0WiF0TwKVj4u.png','300000','50000',1,'2023-03-21 18:02:39','2023-03-21 18:02:39');

/*Table structure for table `m_rekening` */

DROP TABLE IF EXISTS `m_rekening`;

CREATE TABLE `m_rekening` (
  `id_rek` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_rek` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rek` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_bank` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_rek`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `m_rekening` */

insert  into `m_rekening`(`id_rek`,`nama_rek`,`no_rek`,`jenis_bank`,`created_at`,`updated_at`) values 
('2302070001','RENTAL MOBIL','12345678','BNI',NULL,NULL);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_100000_create_password_reset_tokens_table',1),
(2,'2019_08_19_000000_create_failed_jobs_table',1),
(3,'2019_12_14_000001_create_personal_access_tokens_table',1),
(4,'2023_03_12_135542_create_t_user_table',2),
(5,'2023_03_12_130454_create_m_mobil_table',3),
(6,'2023_03_12_135545_create_t_rental_table',3),
(7,'2023_03_13_000000_create_users_table',3),
(8,'2023_03_16_032254_create_m_rekening_table',4),
(9,'2023_03_16_034255_create_t_pembayaran_table',5),
(10,'2023_03_16_040010_create_m_rekening_table',6),
(11,'2023_03_16_040049_create_t_pembayaran_table',7);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `t_pembayaran` */

DROP TABLE IF EXISTS `t_pembayaran`;

CREATE TABLE `t_pembayaran` (
  `id_pembayaran` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tuser` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_rental` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_rek` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `bukti_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `t_pembayaran_id_tuser_foreign` (`id_tuser`),
  KEY `t_pembayaran_id_rental_foreign` (`id_rental`),
  KEY `t_pembayaran_id_rek_foreign` (`id_rek`),
  CONSTRAINT `t_pembayaran_id_rek_foreign` FOREIGN KEY (`id_rek`) REFERENCES `m_rekening` (`id_rek`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_pembayaran_id_rental_foreign` FOREIGN KEY (`id_rental`) REFERENCES `t_rental` (`id_rental`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_pembayaran_id_tuser_foreign` FOREIGN KEY (`id_tuser`) REFERENCES `t_user` (`id_tuser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `t_pembayaran` */

insert  into `t_pembayaran`(`id_pembayaran`,`id_tuser`,`id_rental`,`id_rek`,`tgl_pembayaran`,`bukti_transaksi`,`created_at`,`updated_at`) values 
('2303210001','00000002','2303210001','2302070001','2023-03-21','th47tzi4AeRWfNLZU444GZMEhByO407fsY5wsOfI.jpg','2023-03-21 17:54:23','2023-03-21 17:54:23');

/*Table structure for table `t_rental` */

DROP TABLE IF EXISTS `t_rental`;

CREATE TABLE `t_rental` (
  `id_rental` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tuser` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mobil` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_rental` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `total_biaya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cara_bayar` int(11) NOT NULL,
  `status_rental` int(11) DEFAULT 1 COMMENT '1=sdg_rental, 2=kembali',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_rental`),
  KEY `t_rental_id_tuser_foreign` (`id_tuser`),
  KEY `t_rental_id_mobil_foreign` (`id_mobil`),
  CONSTRAINT `t_rental_id_mobil_foreign` FOREIGN KEY (`id_mobil`) REFERENCES `m_mobil` (`id_mobil`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_rental_id_tuser_foreign` FOREIGN KEY (`id_tuser`) REFERENCES `t_user` (`id_tuser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `t_rental` */

insert  into `t_rental`(`id_rental`,`id_tuser`,`id_mobil`,`tgl_rental`,`tgl_kembali`,`total_biaya`,`cara_bayar`,`status_rental`,`created_at`,`updated_at`) values 
('2303210001','00000002','2303120001','2023-03-22','2023-03-23','250000',1,1,'2023-03-21 17:50:05','2023-03-21 17:50:05');

/*Table structure for table `t_rental_kembali` */

DROP TABLE IF EXISTS `t_rental_kembali`;

CREATE TABLE `t_rental_kembali` (
  `id_ren_kemb` char(10) NOT NULL,
  `id_rental` char(10) DEFAULT NULL,
  `tgl_diterima` date DEFAULT NULL,
  `kondisi_mobil` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_ren_kemb`),
  KEY `t_rental_kembali_id_rental_foreign` (`id_rental`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_rental_kembali` */

insert  into `t_rental_kembali`(`id_ren_kemb`,`id_rental`,`tgl_diterima`,`kondisi_mobil`,`created_at`,`updated_at`) values 
('2303160001','2303160001','2023-03-16','Oke',NULL,NULL),
('2303160002','2303160002',NULL,'oke','2023-03-16 12:30:57','2023-03-16 12:30:57'),
('2303160003','2303160001',NULL,'oke','2023-03-16 12:34:18','2023-03-16 12:34:18'),
('2303210001','2303160003',NULL,'oke','2023-03-21 15:38:25','2023-03-21 15:38:25'),
('2303210002','2303210001',NULL,'oke','2023-03-21 16:04:16','2023-03-21 16:04:16'),
('2303210003','2303210002',NULL,'oke','2023-03-21 17:37:14','2023-03-21 17:37:14');

/*Table structure for table `t_user` */

DROP TABLE IF EXISTS `t_user`;

CREATE TABLE `t_user` (
  `id_tuser` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `j_kel` int(11) NOT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tuser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `t_user` */

insert  into `t_user`(`id_tuser`,`nik`,`nama`,`tgl_lahir`,`j_kel`,`no_hp`,`pekerjaan`,`alamat`,`created_at`,`updated_at`) values 
('00000001','1307050407010003','Afri Eka Putra','1995-05-22',1,'082117875570','Swasta','Kota Padang','2023-03-12 14:44:38','2023-03-12 14:44:38'),
('00000002','13210213213213','Rivaldi Muchni','2000-05-01',1,'08211213232','Swasta','Kota Padang','2023-03-14 05:32:44','2023-03-14 05:32:44');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_tuser` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_tuser_foreign` (`id_tuser`),
  CONSTRAINT `users_id_tuser_foreign` FOREIGN KEY (`id_tuser`) REFERENCES `t_user` (`id_tuser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`id_tuser`,`email`,`email_verified_at`,`password`,`roles`,`remember_token`,`created_at`,`updated_at`) values 
(1,'00000001','afri@gmail.com',NULL,'$2y$10$DO.LXb3iVBqYmY2tl3Ka1.mn9IdnPccUn1mOgJa5opvC737BRpYdK',1,NULL,'2023-03-12 14:44:38','2023-03-12 14:44:38'),
(3,'00000002','valdi@gmail.com',NULL,'$2y$10$DO.LXb3iVBqYmY2tl3Ka1.mn9IdnPccUn1mOgJa5opvC737BRpYdK',2,NULL,'2023-03-14 05:32:45','2023-03-14 05:32:45');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
