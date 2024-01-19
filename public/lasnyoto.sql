-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for lasnyoto
CREATE DATABASE IF NOT EXISTS `lasnyoto` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lasnyoto`;

-- Dumping structure for table lasnyoto.bag_dapur
CREATE TABLE IF NOT EXISTS `bag_dapur` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_kehadiran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bag_dapur_id_user_foreign` (`id_user`),
  CONSTRAINT `bag_dapur_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.bag_dapur: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.bahanbaku_produk_detail
CREATE TABLE IF NOT EXISTS `bahanbaku_produk_detail` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_produk` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_bahan_baku` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.bahanbaku_produk_detail: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.bahan_baku
CREATE TABLE IF NOT EXISTS `bahan_baku` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` double(8,2) NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.bahan_baku: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.kurir
CREATE TABLE IF NOT EXISTS `kurir` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kurir_id_user_foreign` (`id_user`),
  CONSTRAINT `kurir_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.kurir: ~2 rows (approximately)
INSERT INTO `kurir` (`id`, `id_user`, `no_hp`, `jk`, `created_at`, `updated_at`, `deleted_at`) VALUES
	('837aa6b6-a6bc-44aa-bba8-55c459b6b0f4', '1fd27c9f-3801-44ed-9ccf-7f00d8837569', '0878282826876', 'Laki-Laki', '2024-01-18 20:54:19', '2024-01-18 20:54:19', NULL),
	('f10e21b7-0d9d-4ddb-bac4-e344a672e231', 'da93654b-a97b-490d-8adf-c7a4e3b06ad4', '0878282826870', 'Laki-Laki', '2024-01-18 20:54:28', '2024-01-18 20:54:28', NULL);

-- Dumping structure for table lasnyoto.meja
CREATE TABLE IF NOT EXISTS `meja` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.meja: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.menu: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_06_21_032821_create_permission_tables', 1),
	(6, '2023_06_29_081637_create_bag_dapur_table', 1),
	(7, '2023_06_29_081707_create_bahan_baku_table', 1),
	(8, '2023_07_02_153855_create_produk_table', 1),
	(9, '2023_07_03_170507_create_transaction_bahanbaku_table', 1),
	(10, '2023_07_20_022722_create_pelayan_table', 1),
	(11, '2023_07_20_022830_create_meja_table', 1),
	(12, '2023_07_20_022905_create_transaksi_table', 1),
	(13, '2023_07_20_023007_create_transaksi_detail_table', 1),
	(14, '2023_12_22_143421_create_table_suplier', 1),
	(15, '2023_12_22_144936_create_table_menu', 1),
	(16, '2023_12_25_154638_create_transaksi_suplier', 1),
	(17, '2023_12_25_155131_create_transaksi_suplier_detail', 1),
	(18, '2023_12_26_031336_create_bahanbaku_produk_detail', 1),
	(19, '2023_12_26_040020_create_kurir', 1);

-- Dumping structure for table lasnyoto.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.model_has_roles: ~4 rows (approximately)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(3, 'App\\Models\\User', '1fd27c9f-3801-44ed-9ccf-7f00d8837569'),
	(1, 'App\\Models\\User', '64493dbb-759a-4363-88c0-16fda63525ff'),
	(3, 'App\\Models\\User', 'da93654b-a97b-490d-8adf-c7a4e3b06ad4'),
	(2, 'App\\Models\\User', 'e5800cde-a8f5-42d9-a7bb-299cc6ea05b8');

-- Dumping structure for table lasnyoto.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.pelayan
CREATE TABLE IF NOT EXISTS `pelayan` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_kehadiran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pelayan_id_user_foreign` (`id_user`),
  CONSTRAINT `pelayan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.pelayan: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.permissions: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
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

-- Dumping data for table lasnyoto.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.produk: ~1 rows (approximately)
INSERT INTO `produk` (`id`, `kode_produk`, `nama`, `jenis`, `deskripsi`, `foto`, `foto_url`, `harga`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	('ecccdec4-3c02-4223-842f-9a83a86f539c', 'RD01', 'Railing Deck', 'Besi', 'abc', 'Railing Deck-1705594868.jpg', 'http://localhost:8000/foto/Railing Deck-1705594868.jpg', 300000, 'tersedia', '2024-01-18 20:49:20', '2024-01-18 20:49:20', NULL);

-- Dumping structure for table lasnyoto.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.roles: ~3 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'superadmin', 'web', '2024-01-18 20:49:19', '2024-01-18 20:49:19'),
	(2, 'konsumen', 'web', '2024-01-18 20:49:19', '2024-01-18 20:49:19'),
	(3, 'kurir', 'web', '2024-01-18 20:49:19', '2024-01-18 20:49:19');

-- Dumping structure for table lasnyoto.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.role_has_permissions: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.suplier
CREATE TABLE IF NOT EXISTS `suplier` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.suplier: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.transaction_bahanbaku
CREATE TABLE IF NOT EXISTS `transaction_bahanbaku` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_bahanbaku` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_awal` double(8,2) NOT NULL,
  `stok_terpakai` double(8,2) NOT NULL,
  `sisa` double(8,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_bahanbaku_id_bahanbaku_foreign` (`id_bahanbaku`),
  CONSTRAINT `transaction_bahanbaku_id_bahanbaku_foreign` FOREIGN KEY (`id_bahanbaku`) REFERENCES `bahan_baku` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.transaction_bahanbaku: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_konsumen` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kurir` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_id_konsumen_foreign` (`id_konsumen`),
  KEY `transaksi_id_kurir_foreign` (`id_kurir`),
  CONSTRAINT `transaksi_id_konsumen_foreign` FOREIGN KEY (`id_konsumen`) REFERENCES `users` (`id`),
  CONSTRAINT `transaksi_id_kurir_foreign` FOREIGN KEY (`id_kurir`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.transaksi: ~1 rows (approximately)
INSERT INTO `transaksi` (`id`, `kode`, `id_konsumen`, `id_kurir`, `tgl_transaksi`, `nama`, `no_hp`, `alamat`, `total`, `status`, `status_bayar`, `created_at`, `updated_at`, `deleted_at`) VALUES
	('531f947e-325d-4547-89ed-acf2614ec50c', 'INV202401191', 'e5800cde-a8f5-42d9-a7bb-299cc6ea05b8', 'da93654b-a97b-490d-8adf-c7a4e3b06ad4', '2024-01-19', 'abc', '0878282826878', 'aba', 300000, '3', '1', '2024-01-18 20:55:35', '2024-01-18 23:33:13', NULL);

-- Dumping structure for table lasnyoto.transaksi_detail
CREATE TABLE IF NOT EXISTS `transaksi_detail` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_produk` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_transaksi` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `harga` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_detail_id_produk_foreign` (`id_produk`),
  KEY `transaksi_detail_id_transaksi_foreign` (`id_transaksi`),
  CONSTRAINT `transaksi_detail_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`),
  CONSTRAINT `transaksi_detail_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.transaksi_detail: ~1 rows (approximately)
INSERT INTO `transaksi_detail` (`id`, `id_produk`, `id_transaksi`, `qty`, `harga`, `subtotal`, `created_at`, `updated_at`) VALUES
	('98e94f40-7ced-49b4-85ab-b7196fd98964', 'ecccdec4-3c02-4223-842f-9a83a86f539c', '531f947e-325d-4547-89ed-acf2614ec50c', 1, 300000, 300000, '2024-01-18 20:55:35', '2024-01-18 20:55:35');

-- Dumping structure for table lasnyoto.transaksi_suplier
CREATE TABLE IF NOT EXISTS `transaksi_suplier` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_suplier` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `total` double(8,2) NOT NULL,
  `status_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.transaksi_suplier: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.transaksi_suplier_detail
CREATE TABLE IF NOT EXISTS `transaksi_suplier_detail` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_transaksi` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_bahanbaku` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `harga` double(8,2) NOT NULL,
  `subtotal` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.transaksi_suplier_detail: ~0 rows (approximately)

-- Dumping structure for table lasnyoto.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lasnyoto.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	('1fd27c9f-3801-44ed-9ccf-7f00d8837569', 'jajang', 'jajang@gmail.com', NULL, '$2y$10$rCZUv/CW47sQkkd3JbLqhe31FuO1CJJvRaaPrjGW7oyldhqcDjLOG', 'kurir', NULL, '2024-01-18 20:54:06', '2024-01-18 20:54:06', NULL),
	('64493dbb-759a-4363-88c0-16fda63525ff', 'admin', 'admin@gmail.com', NULL, '$2y$10$LxVwihG1g1NOb44FmxdHCOl6UzGeCr4EjZePwHH4WqY/GVAsr7aVG', NULL, NULL, '2024-01-18 20:49:21', '2024-01-18 20:49:21', NULL),
	('da93654b-a97b-490d-8adf-c7a4e3b06ad4', 'kurir', 'kurir@gmail.com', NULL, '$2y$10$7dTJJTXx5TGq5MJbGeIQre8wIpNQz9ySfPD3cAVbbzuKBC7WLJkpm', NULL, NULL, '2024-01-18 20:49:21', '2024-01-18 20:49:21', NULL),
	('e5800cde-a8f5-42d9-a7bb-299cc6ea05b8', 'konsumen', 'konsumen@gmail.com', NULL, '$2y$10$Isn4lyxV4d2fjAwRrQ/71.OHo0JAbRoNAnDXFA8O72eJbQvVXZrPu', NULL, NULL, '2024-01-18 20:49:21', '2024-01-18 20:49:21', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
