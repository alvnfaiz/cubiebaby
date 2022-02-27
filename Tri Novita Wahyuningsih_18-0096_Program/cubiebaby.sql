/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` (`id`, `image`, `status`, `alt`) VALUES
	(1, 'banners/WVAccAIv0GwxWVtspQWKa0HB7jILGv1MJc9R6vA3.png', 'inactive', 'Produk Terbaru/Terdiskon dll'),
	(2, 'banners/w3pZBM3kjJgawYse3e4KUmb8WTcSvwTkeSNXncRF.png', 'active', 'banner2'),
	(5, 'banners/s9VxZrLQdQafEPhu2OgBVGnoVki736HDk3ddfVXs.png', 'active', 'banner1');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `bot_chats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `bot_chats` DISABLE KEYS */;
INSERT INTO `bot_chats` (`id`, `message`, `reply`, `status`) VALUES
	(2, 'Status pengiriman barang saya bagaimana', '<p>hallo, agar kami dapat langsung mengirimkan pesanan anda pastikan terlebih dahulu bahwa anda sudah melakukan pembayaran terkait produk yang anda pesan.&nbsp;</p>', 'active'),
	(3, 'hai siang', '<p>ada yang bisa kami bantu</p>', 'inactive'),
	(4, 'malam', '<p>hallo selamat malam</p>', 'active'),
	(5, 'hallo selamat malam', 'silahkan sampaikan kendala anda', 'active');
/*!40000 ALTER TABLE `bot_chats` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `broadcasts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `send_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `broadcasts` DISABLE KEYS */;
INSERT INTO `broadcasts` (`id`, `value`, `image`, `created_at`, `send_at`) VALUES
	(1, '<p>hallo member, kami punya barang baru nih untuk kamu lihat. Semoga tertarik yaa</p>', 'bc/XkXRvSOt3yoirFVb5zMG7DG1Xjejy8YHS6ckcBN7.jpg', '2022-02-06 17:53:46', '2022-02-06 17:53:46'),
	(2, '<p>kami mempunyai tipe kutek terbaru loh ..</p>', 'bc/vkWSADkA4VcD5HsfiSkPMX8WttUvz3bL0emKb9vs.jpg', '2022-02-06 22:21:07', '2022-02-06 22:21:07'),
	(3, '<p>hi</p>', 'bc/i5TNMvFo3PAr4ceYJhmrhLg7xrGipFkTXRmASDWE.jpg', '2022-02-06 22:21:46', '2022-02-06 22:21:46'),
	(4, '<p>ayok order produk terbaru kami</p>', 'bc/lI5JfKEBNOqX53lk24d00gJggavfmz88gzNL1uOD.jpg', '2022-02-06 22:44:00', '2022-02-06 22:44:00'),
	(5, '<p>cek produk baru kami</p>', 'bc/3ZwtcHetUj1PZyCrwPEhybWlSoXWK7AAi6dCY24s.jpg', '2022-02-08 17:50:25', '2022-02-08 17:50:25'),
	(6, '<p>cek produk baru kami</p>', 'bc/Dq68vKZE50TkLtdNPllZ4zlL5dDs7eIDZnRfg9AB.jpg', '2022-02-08 17:50:52', '2022-02-08 17:50:52'),
	(7, 'selamat berbelanja pada toko kami..', 'bc/nedu8GJEZGDwAaZpeYZtIQ0FYeKS9iOdtVVsbs9Y.png', '2022-02-08 19:45:23', '2022-02-08 19:45:23'),
	(8, '<p>lihat hijab motif terbaru kami</p>', 'bc/qKRIsJkPsWqrG4TsDbpQ74tqHkJQofGAXq4jz5Uq.jpg', '2022-02-08 20:08:09', '2022-02-08 20:08:09'),
	(9, '<p>hallo</p>', 'bc/nj3BBlcE4OnC4KrYl3O5pgfz9DwCSMBsqmsNq74d.jpg', '2022-02-09 16:53:55', '2022-02-09 16:53:55'),
	(10, '<p>hallo</p>', 'bc/EYxxXZt9r3RIpGzXBo7GTD7tFLosMpduvro0qRUz.jpg', '2022-02-09 16:54:41', '2022-02-09 16:54:41');
/*!40000 ALTER TABLE `broadcasts` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `broadcast_recipients` (
  `broadcast_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  KEY `broadcast_recipients_broadcast_id_foreign` (`broadcast_id`),
  KEY `broadcast_recipients_user_id_foreign` (`user_id`),
  CONSTRAINT `broadcast_recipients_broadcast_id_foreign` FOREIGN KEY (`broadcast_id`) REFERENCES `broadcasts` (`id`),
  CONSTRAINT `broadcast_recipients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `broadcast_recipients` DISABLE KEYS */;
INSERT INTO `broadcast_recipients` (`broadcast_id`, `user_id`) VALUES
	(1, 3),
	(3, 3),
	(4, 3),
	(4, 5),
	(6, 17),
	(6, 18),
	(8, 26);
/*!40000 ALTER TABLE `broadcast_recipients` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `total_product` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_product_id_foreign` (`product_id`),
  KEY `carts_user_id_foreign` (`user_id`),
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`, `slug`) VALUES
	(1, 'Mainan', 'mainan'),
	(2, 'Boneka', 'boneka'),
	(3, 'Dompet', 'dompet'),
	(4, 'Hijab Motif', 'hijab-motif'),
	(5, 'Kutek', 'kutek'),
	(6, 'Masker', 'masker'),
	(7, 'Sarung Tangan Wol', 'sarung-tangan-wol'),
	(8, 'SheetMask', 'sheetmask'),
	(9, 'Strap Masker', 'strap-masker');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `destinations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `destinations` DISABLE KEYS */;
INSERT INTO `destinations` (`id`, `name`, `phone`, `address`) VALUES
	(1, 'rina', '+6283180465257', 'Pagaruyung'),
	(2, 'lili', '+6283180465257', 'mandiangin'),
	(3, 'ningsih', '+6283180465257', 'payakumbuh'),
	(4, 'ningsih', '+6283180465257', 'Batusangkar'),
	(5, 'ningsih new', '+6283180465257', 'Padang'),
	(6, 'tri', '+6283180465257', 'pagaruyung'),
	(7, 'novita', '+6283180465257', 'lubeg'),
	(8, 'vita', '+6283180465257', 'Pagaruyung'),
	(9, 'lita', '+6283180465257', 'Padang'),
	(10, 'Alvin Faiz', '+6283180465257', 'Padang'),
	(11, 'Kue Nastar', '01231313212', 'Bukittinggi'),
	(12, 'Coba', '083180138013', 'Bukittinggi'),
	(13, 'Kue Nastar', '01231313212', 'Bukittinggi'),
	(14, 'trinovita', '083180138013', 'Bukittinggi'),
	(15, 'novita', '083180138013', 'Bukittinggi'),
	(16, 'novita ningsih', '083180138013', 'Bukittinggi'),
	(17, 'ningsiih', '083180138013', 'Bukittinggi'),
	(18, 'ningsiih', '083180138013', 'Bukittinggi'),
	(19, 'rika', '083180138013', 'Bukittinggi'),
	(20, 'ika', '083180138013', 'Bukittinggi'),
	(21, 'ningsih', '083180138013', 'Bukittinggi'),
	(22, 'member23', '08136458584', 'padang'),
	(23, 'cubie', '083180138013', 'padang'),
	(24, 'Novita', '081391319', 'Batusangkar, sumnbar'),
	(25, 'novitaa', '081365406483', 'Mandiangin, Koto Selayan Kota Bukittinggi');
/*!40000 ALTER TABLE `destinations` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `messages_user_id_foreign` (`user_id`),
  CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `user_id`, `image`, `message`, `read`, `admin`, `created_at`) VALUES
	(1, 3, 'bc/XkXRvSOt3yoirFVb5zMG7DG1Xjejy8YHS6ckcBN7.jpg', '<p>hallo member, kami punya barang baru nih untuk kamu lihat. Semoga tertarik yaa</p>', 1, 1, '2022-02-06 17:53:46'),
	(2, 3, NULL, 'hallo', 1, 0, '2022-02-06 17:54:35'),
	(3, 3, NULL, '<p>Hallo ada yang bisa kami bantu, silahkan sampaikan semua saran dan kepentingan anda</p>', 1, 1, '2022-02-06 17:54:35'),
	(4, 3, NULL, 'Hallo', 1, 0, '2022-02-06 17:54:51'),
	(5, 3, NULL, '<p>Hallo ada yang bisa kami bantu, silahkan sampaikan semua saran dan kepentingan anda</p>', 1, 1, '2022-02-06 17:54:51'),
	(6, 3, NULL, 'Pagi', 1, 0, '2022-02-06 17:55:08'),
	(10, 3, NULL, 'p', 1, 0, '2022-02-06 20:57:06'),
	(11, 3, NULL, '<p>hallo, agar kami dapat langsung mengirimkan pesanan anda pastikan terlebih dahulu bahwa anda sudah melakukan pembayaran terkait produk yang anda pesan.&nbsp;</p>', 1, 1, '2022-02-06 20:57:06'),
	(12, 3, NULL, 'hallo', 1, 0, '2022-02-06 20:57:19'),
	(13, 3, NULL, '<p>Hallo ada yang bisa kami bantu, silahkan sampaikan semua saran dan kepentingan anda</p>', 1, 1, '2022-02-06 20:57:19'),
	(14, 3, NULL, 'h', 1, 0, '2022-02-06 20:57:27'),
	(15, 3, NULL, '<p>Hallo ada yang bisa kami bantu, silahkan sampaikan semua saran dan kepentingan anda</p>', 1, 1, '2022-02-06 20:57:27'),
	(16, 3, NULL, 'i', 1, 0, '2022-02-06 20:57:40'),
	(17, 3, NULL, '<p>hallo, agar kami dapat langsung mengirimkan pesanan anda pastikan terlebih dahulu bahwa anda sudah melakukan pembayaran terkait produk yang anda pesan.&nbsp;</p>', 1, 1, '2022-02-06 20:57:40'),
	(18, 3, NULL, 'hj', 1, 0, '2022-02-06 20:57:59'),
	(19, 3, NULL, 'i', 1, 0, '2022-02-06 20:58:12'),
	(20, 3, NULL, '<p>hallo, agar kami dapat langsung mengirimkan pesanan anda pastikan terlebih dahulu bahwa anda sudah melakukan pembayaran terkait produk yang anda pesan.&nbsp;</p>', 1, 1, '2022-02-06 20:58:12'),
	(21, 3, NULL, 'yup', 1, 0, '2022-02-06 20:58:26'),
	(22, 3, NULL, 'siang', 1, 0, '2022-02-06 20:58:37'),
	(23, 3, NULL, 'i', 1, 0, '2022-02-06 20:58:57'),
	(24, 3, NULL, '<p>hallo, agar kami dapat langsung mengirimkan pesanan anda pastikan terlebih dahulu bahwa anda sudah melakukan pembayaran terkait produk yang anda pesan.&nbsp;</p>', 1, 1, '2022-02-06 20:58:57'),
	(25, 3, NULL, 'i', 1, 0, '2022-02-06 21:03:29'),
	(26, 3, NULL, 'Hallo', 1, 0, '2022-02-06 21:03:42'),
	(27, 3, NULL, '<p>Hallo ada yang bisa kami bantu, silahkan sampaikan semua saran dan kepentingan anda</p>', 1, 1, '2022-02-06 21:03:42'),
	(28, 3, NULL, 'i', 1, 0, '2022-02-06 21:03:57'),
	(33, 10, NULL, 'malam', 1, 0, '2022-02-06 21:43:59'),
	(34, 10, 'products/9RK8CwAQ30x0NTGtHYHcfKRlJ4Rn3aSqBgYl5iCc.jpg', 'barang rusak', 1, 0, '2022-02-06 21:44:22'),
	(35, 10, NULL, 'Hallo', 1, 0, '2022-02-06 21:44:35'),
	(36, 10, NULL, '<p>Hallo ada yang bisa kami bantu, silahkan sampaikan semua saran dan kepentingan anda</p>', 1, 1, '2022-02-06 21:44:35'),
	(37, 11, NULL, 'malam', 1, 0, '2022-02-06 21:54:06'),
	(38, 11, 'products/M6EJlMrPq5kPUpIZCUmcndZzFtGOMsk6z0SHldcS.jpg', 'barang rusak', 1, 0, '2022-02-06 21:54:34'),
	(39, 11, NULL, 'Hallo', 1, 0, '2022-02-06 21:54:52'),
	(40, 11, NULL, '<p>Hallo ada yang bisa kami bantu, silahkan sampaikan semua saran dan kepentingan anda</p>', 1, 1, '2022-02-06 21:54:52'),
	(41, 12, NULL, 'malam', 1, 0, '2022-02-06 22:03:16'),
	(42, 12, 'products/rHdAdY9BncY4Yj9j3LFdRZHWjfVXwOjDBVPg9dPX.jpg', 'barang rusak', 1, 0, '2022-02-06 22:03:32'),
	(43, 12, NULL, 'Hallo', 1, 0, '2022-02-06 22:03:53'),
	(44, 12, NULL, '<p>Hallo ada yang bisa kami bantu, silahkan sampaikan semua saran dan kepentingan anda</p>', 1, 1, '2022-02-06 22:03:53'),
	(45, 13, NULL, 'malam', 0, 0, '2022-02-06 22:14:33'),
	(46, 13, NULL, 'Hallo', 0, 0, '2022-02-06 22:14:46'),
	(47, 13, NULL, '<p>Hallo ada yang bisa kami bantu, silahkan sampaikan semua saran dan kepentingan anda</p>', 1, 1, '2022-02-06 22:14:46'),
	(48, 13, 'products/f490fIoSlpNtThhg9On5ecsiS942iaaGKVh68wca.jpg', 'barang rusak', 0, 0, '2022-02-06 22:15:20'),
	(49, 3, 'bc/i5TNMvFo3PAr4ceYJhmrhLg7xrGipFkTXRmASDWE.jpg', '<p>hi</p>', 1, 1, '2022-02-06 22:21:46'),
	(50, 14, NULL, 'malam', 0, 0, '2022-02-06 22:25:34'),
	(51, 14, 'products/q0vA1t8I4hcAlZ5wzvTAZv6oe04gH75MH9KTSWgr.jpg', 'barang rusak', 0, 0, '2022-02-06 22:25:54'),
	(52, 14, NULL, 'Hallo', 0, 0, '2022-02-06 22:26:18'),
	(53, 14, NULL, '<p>Hallo ada yang bisa kami bantu, silahkan sampaikan semua saran dan kepentingan anda</p>', 1, 1, '2022-02-06 22:26:18'),
	(54, 8, NULL, 'malam', 1, 0, '2022-02-06 22:37:38'),
	(55, 8, NULL, 'Hallo', 1, 0, '2022-02-06 22:38:04'),
	(56, 8, NULL, '<p>Hallo ada yang bisa kami bantu, silahkan sampaikan semua saran dan kepentingan anda</p>', 1, 1, '2022-02-06 22:38:04'),
	(57, 8, 'products/aTb37O0YrtNqJiUMNX9QlM8xKIjIYKStmvQe9jDE.jpg', 'barang rusak', 1, 0, '2022-02-06 22:38:32'),
	(59, 3, NULL, 'malam', 1, 1, '2022-02-06 22:42:46'),
	(60, 3, 'bc/lI5JfKEBNOqX53lk24d00gJggavfmz88gzNL1uOD.jpg', '<p>ayok order produk terbaru kami</p>', 1, 1, '2022-02-06 22:44:00'),
	(61, 5, 'bc/lI5JfKEBNOqX53lk24d00gJggavfmz88gzNL1uOD.jpg', '<p>ayok order produk terbaru kami</p>', 1, 1, '2022-02-06 22:44:00'),
	(62, 5, NULL, 'malam', 1, 0, '2022-02-06 22:45:10'),
	(63, 5, NULL, '<p>hallo selamat malam</p>', 1, 1, '2022-02-06 22:45:10'),
	(64, 1, 'products/chW0hLLHElDvbGEYkC6e61eNgd1nlORnMThUbp6H.jpg', 'Silahkan dilihat produk terbaru kami', 1, 0, '2022-02-08 12:38:08'),
	(65, 1, 'products/XoufJZP3EmbsufLklQawjCCHBKZKAtPZAdx4BbN4.jpg', 'order yuk', 1, 0, '2022-02-08 12:41:01'),
	(66, 1, NULL, 'order yuk', 1, 0, '2022-02-08 12:44:33'),
	(67, 1, 'products/jVQZtyi509lDqIXWo7b6V4QtAfO9rGuFXuqRiLr8.jpg', 'dompet terbaru', 1, 0, '2022-02-08 12:44:45'),
	(68, 17, NULL, 'siang', 0, 0, '2022-02-08 17:41:06'),
	(69, 17, NULL, 'Status pengiriman barang saya bagaimana', 0, 0, '2022-02-08 17:41:33'),
	(70, 17, NULL, 'status pengiriman barang saya bagaimana', 0, 0, '2022-02-08 17:41:53'),
	(71, 17, NULL, 'hai siang', 0, 0, '2022-02-08 17:42:02'),
	(72, 17, NULL, '<p>ada yang bisa kami bantu</p>', 1, 1, '2022-02-08 17:42:02'),
	(73, 18, NULL, 'siang', 0, 0, '2022-02-08 17:46:58'),
	(74, 18, NULL, 'Status pengiriman barang saya bagaimana', 0, 0, '2022-02-08 17:47:19'),
	(75, 18, NULL, '<p>hallo, agar kami dapat langsung mengirimkan pesanan anda pastikan terlebih dahulu bahwa anda sudah melakukan pembayaran terkait produk yang anda pesan.&nbsp;</p>', 1, 1, '2022-02-08 17:47:19'),
	(76, 18, NULL, 'hai siang', 0, 0, '2022-02-08 17:47:29'),
	(77, 18, NULL, '<p>ada yang bisa kami bantu</p>', 1, 1, '2022-02-08 17:47:29'),
	(78, 18, 'products/4VYVM5goUinYNZEUtK2ieIf18KkPIM0CTZbgwe4c.jpg', 'Barang yang diterima rusak', 0, 0, '2022-02-08 17:48:04'),
	(79, 18, 'products/LZUddCKmgrzsuvSZHhZm0VREr8hfuhlm4hrbd39q.jpg', 'hai', 0, 0, '2022-02-08 17:49:08'),
	(80, 18, 'products/VqHXkTuTQ4sTpJRnniSDmsT0uj5e6qQYUeKLCpTL.jpg', '.', 0, 0, '2022-02-08 17:49:22'),
	(81, 17, 'bc/Dq68vKZE50TkLtdNPllZ4zlL5dDs7eIDZnRfg9AB.jpg', '<p>cek produk baru kami</p>', 0, 1, '2022-02-08 17:50:52'),
	(82, 18, 'bc/Dq68vKZE50TkLtdNPllZ4zlL5dDs7eIDZnRfg9AB.jpg', '<p>cek produk baru kami</p>', 0, 1, '2022-02-08 17:50:52'),
	(83, 19, NULL, 'sore', 0, 0, '2022-02-08 17:55:24'),
	(84, 19, NULL, 'Status pengiriman barang saya bagaimana', 0, 0, '2022-02-08 17:55:49'),
	(85, 19, NULL, '<p>hallo, agar kami dapat langsung mengirimkan pesanan anda pastikan terlebih dahulu bahwa anda sudah melakukan pembayaran terkait produk yang anda pesan.&nbsp;</p>', 1, 1, '2022-02-08 17:55:49'),
	(86, 19, NULL, 'hai siang', 0, 0, '2022-02-08 17:56:00'),
	(87, 19, NULL, '<p>ada yang bisa kami bantu</p>', 1, 1, '2022-02-08 17:56:00'),
	(88, 19, 'products/EPXluV7gaoBwzYy4Co68tdZ2CqBwxpfB6Ki9iynb.jpg', 'Barang yang diterima rusak', 0, 0, '2022-02-08 17:56:33'),
	(89, 19, 'products/OGvMCcLGDTZMo1OtUpSxib03K5J5bHvWqOOuzanu.webp', 'barang rusak', 0, 0, '2022-02-08 17:56:50'),
	(90, 19, 'products/xDXisih74zuBjz1mwvlL4W36OQ4HQgtxYR7hGuk8.jpg', 'barang yang diterima rusak', 0, 0, '2022-02-08 17:57:05'),
	(91, 21, NULL, 'haii', 0, 0, '2022-02-08 18:03:59'),
	(92, 21, 'products/khf4r2rftqbZ1llz7S8rrUqAAV1w4wosmUrNX4wh.jpg', 'Barang yang diterima rusak', 0, 0, '2022-02-08 18:04:31'),
	(93, 21, NULL, 'Status pengiriman barang saya bagaimana', 0, 0, '2022-02-08 18:05:05'),
	(94, 21, NULL, '<p>hallo, agar kami dapat langsung mengirimkan pesanan anda pastikan terlebih dahulu bahwa anda sudah melakukan pembayaran terkait produk yang anda pesan.&nbsp;</p>', 1, 1, '2022-02-08 18:05:05'),
	(95, 21, NULL, 'hai siang', 0, 0, '2022-02-08 18:05:17'),
	(96, 21, NULL, '<p>ada yang bisa kami bantu</p>', 1, 1, '2022-02-08 18:05:17'),
	(97, 22, NULL, 'hai', 0, 0, '2022-02-08 19:17:32'),
	(98, 22, NULL, 'Status pengiriman barang saya bagaimana', 0, 0, '2022-02-08 19:17:53'),
	(99, 22, NULL, '<p>hallo, agar kami dapat langsung mengirimkan pesanan anda pastikan terlebih dahulu bahwa anda sudah melakukan pembayaran terkait produk yang anda pesan.&nbsp;</p>', 1, 1, '2022-02-08 19:17:53'),
	(100, 22, NULL, 'hai siang', 0, 0, '2022-02-08 19:18:05'),
	(101, 22, NULL, '<p>ada yang bisa kami bantu</p>', 1, 1, '2022-02-08 19:18:05'),
	(102, 22, 'products/kcQVAqZSHJjZm9daUtDMoQM7D39dB7obijVnWjho.jpg', 'barang yang diterima rusak', 0, 0, '2022-02-08 19:18:36'),
	(103, 23, NULL, 'hai', 1, 0, '2022-02-08 19:24:42'),
	(104, 23, NULL, 'Status pengiriman barang saya bagaimana', 1, 0, '2022-02-08 19:25:03'),
	(105, 23, NULL, '<p>hallo, agar kami dapat langsung mengirimkan pesanan anda pastikan terlebih dahulu bahwa anda sudah melakukan pembayaran terkait produk yang anda pesan.&nbsp;</p>', 1, 1, '2022-02-08 19:25:03'),
	(106, 23, NULL, 'hai siang', 1, 0, '2022-02-08 19:25:12'),
	(107, 23, NULL, '<p>ada yang bisa kami bantu</p>', 1, 1, '2022-02-08 19:25:12'),
	(108, 23, 'products/c9Dy3BeBrdPj7zLUQklwsxpfjX5Rk2czmQ1tOSpe.jpg', 'barang yang diterima rusak', 1, 0, '2022-02-08 19:25:44'),
	(109, 24, NULL, 'hai', 1, 0, '2022-02-08 19:35:20'),
	(110, 24, NULL, 'Status pengiriman barang saya bagaimana', 1, 0, '2022-02-08 19:35:40'),
	(111, 24, NULL, '<p>hallo, agar kami dapat langsung mengirimkan pesanan anda pastikan terlebih dahulu bahwa anda sudah melakukan pembayaran terkait produk yang anda pesan.&nbsp;</p>', 1, 1, '2022-02-08 19:35:40'),
	(112, 24, NULL, 'hai siang', 1, 0, '2022-02-08 19:35:49'),
	(113, 24, NULL, '<p>ada yang bisa kami bantu</p>', 1, 1, '2022-02-08 19:35:49'),
	(114, 24, 'products/VPTmRmexQix5vM30HqmScqleuOSqbvfSgf262X8W.jpg', 'barang rusak', 1, 0, '2022-02-08 19:36:13'),
	(115, 24, NULL, 'hai siang', 1, 0, '2022-02-08 19:43:35'),
	(116, 24, NULL, 'hallo selamat malam', 1, 0, '2022-02-08 19:44:18'),
	(117, 24, NULL, 'silahkan sampaikan kendala anda', 1, 1, '2022-02-08 19:44:18'),
	(118, 26, NULL, 'hai', 1, 0, '2022-02-08 19:59:01'),
	(119, 26, NULL, 'Status pengiriman barang saya bagaimana', 1, 0, '2022-02-08 19:59:23'),
	(120, 26, NULL, '<p>hallo, agar kami dapat langsung mengirimkan pesanan anda pastikan terlebih dahulu bahwa anda sudah melakukan pembayaran terkait produk yang anda pesan.&nbsp;</p>', 1, 1, '2022-02-08 19:59:23'),
	(121, 26, 'products/D0x0ja2urmRkVzyTm9DZusb1q0rOSryJpdlMOhUV.jpg', 'barang rusak', 1, 0, '2022-02-08 19:59:47'),
	(122, 26, 'bc/qKRIsJkPsWqrG4TsDbpQ74tqHkJQofGAXq4jz5Uq.jpg', '<p>lihat hijab motif terbaru kami</p>', 1, 1, '2022-02-08 20:08:09'),
	(123, 26, NULL, 'sore', 1, 0, '2022-02-08 20:09:32'),
	(124, 26, NULL, '<p>hallo</p>', 1, 1, '2022-02-08 20:09:32'),
	(125, 26, NULL, 'malam', 1, 0, '2022-02-08 20:09:42'),
	(126, 10, NULL, 'hallo', 0, 0, '2022-02-09 16:51:46'),
	(127, 10, NULL, 'Hallo', 0, 0, '2022-02-09 16:51:56'),
	(128, 10, NULL, 'malam', 0, 0, '2022-02-09 16:52:14'),
	(129, 10, NULL, 'sore', 0, 0, '2022-02-09 16:52:31'),
	(130, 10, NULL, '<p>hallo</p>', 1, 1, '2022-02-09 16:52:31'),
	(131, 27, NULL, 'sore', 0, 0, '2022-02-09 17:30:55'),
	(132, 27, NULL, 'Status pengiriman barang saya bagaimana', 0, 0, '2022-02-09 17:31:09'),
	(133, 27, NULL, '<p>hallo, agar kami dapat langsung mengirimkan pesanan anda pastikan terlebih dahulu bahwa anda sudah melakukan pembayaran terkait produk yang anda pesan.&nbsp;</p>', 1, 1, '2022-02-09 17:31:09'),
	(134, 27, 'products/cHIsEBCChEamSygSCMAPMEWd7EjhPNjnQtgFBLjx.jpg', 'Barang yang diterima rusak', 0, 0, '2022-02-09 17:31:35');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_01_03_011548_create_shippings_table', 1),
	(6, '2022_01_03_011647_create_destinations_table', 1),
	(7, '2022_02_01_153800_category', 1),
	(8, '2022_02_01_153900_products', 1),
	(9, '2022_02_01_153929_cart', 1),
	(10, '2022_02_01_154436_message', 1),
	(11, '2022_02_01_154706_order', 1),
	(12, '2022_02_01_154720_order_detail', 1),
	(13, '2022_02_01_154755_banners', 1),
	(14, '2022_02_02_201324_create_user_activities_table', 1),
	(15, '2022_02_02_202331_create_broadcasts_table', 1),
	(16, '2022_02_03_011606_create_reports_table', 1),
	(17, '2022_02_03_011622_create_report_replies_table', 1),
	(18, '2022_02_03_011707_create_bot_chats_table', 1),
	(19, '2022_02_03_031354_create_broadcast_recipients_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `total_price` double NOT NULL,
  `status_payment` enum('Lunas','Belum Lunas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum Lunas',
  `shipping_status` enum('Diproses','Dikirim','Selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Diproses',
  `resi_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` enum('Proses','Expired','Cancel','Selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Proses',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_id` bigint(20) unsigned NOT NULL,
  `destination_id` bigint(20) unsigned NOT NULL,
  `expired_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_shipping_id_foreign` (`shipping_id`),
  KEY `orders_destination_id_foreign` (`destination_id`),
  CONSTRAINT `orders_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`),
  CONSTRAINT `orders_shipping_id_foreign` FOREIGN KEY (`shipping_id`) REFERENCES `shippings` (`id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status_payment`, `shipping_status`, `resi_number`, `order_status`, `image`, `shipping_id`, `destination_id`, `expired_at`, `created_at`, `updated_at`) VALUES
	(1, 3, 60000, 'Lunas', 'Selesai', NULL, 'Selesai', 'bp/ioHkK8g64RfeUxmALp9ke6BRi6Kr42tlOM5Inikf.jpg', 1, 1, '2022-02-09', '2022-02-06 20:23:04', '2022-02-06 20:33:48'),
	(2, 3, 65000, 'Lunas', 'Selesai', NULL, 'Selesai', 'bp/snQcDRdXCWEOhWNZKwOqRV7mTM7nXbzNrPuk7uIL.jpg', 2, 2, '2022-02-09', '2022-02-06 20:35:33', '2022-02-08 16:31:31'),
	(3, 5, 65000, 'Lunas', 'Dikirim', NULL, 'Selesai', '', 3, 3, '2022-02-09', '2022-02-06 20:42:58', '2022-02-08 19:40:26'),
	(4, 10, 200000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/XbxTibKLk6yt2sqA0BBTWYN6bn2YTJlAhut6Tbku.jpg', 1, 4, '2022-02-09', '2022-02-06 21:45:28', '2022-02-06 21:45:45'),
	(5, 11, 80000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/9Q1obsrMWPWcqwBfyLCHDyQH7la2Owieu08yv910.jpg', 4, 5, '2022-02-09', '2022-02-06 21:53:28', '2022-02-06 21:53:45'),
	(6, 12, 85000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/9ZTcuzQd7JYYV5fKhUCaQdkbqxMT52WEe5pEXecw.jpg', 1, 6, '2022-02-09', '2022-02-06 22:02:29', '2022-02-06 22:02:45'),
	(7, 13, 80000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/9RAwEfKscxU9YWeuDiII06DIddX3RBhkLygNZfRT.jpg', 4, 7, '2022-02-09', '2022-02-06 22:13:47', '2022-02-06 22:13:59'),
	(8, 14, 100000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/SDqYp84TapQlyjbL4UezkvXCqBFudCHarRIFTpmZ.jpg', 1, 8, '2022-02-09', '2022-02-06 22:24:43', '2022-02-06 22:24:57'),
	(9, 8, 165000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/k4YZopzJlAM6c0UW7hR0Zsa6cZYrEE3MmwFz6I2W.jpg', 4, 9, '2022-02-09', '2022-02-06 22:36:51', '2022-02-06 22:37:13'),
	(10, 1, 100000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/YTawCZPpGyu3acHyDql0yqe6l49SXRtB1ZAh009s.jpg', 1, 10, '2022-02-11', '2022-02-08 13:48:41', '2022-02-08 13:50:17'),
	(11, 3, 35000, 'Belum Lunas', 'Diproses', '', 'Proses', '', 2, 13, '2022-02-11', '2022-02-08 14:20:39', '2022-02-08 14:20:39'),
	(12, 17, 85000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/D5qr1EJIXuQw7cQxX2lSrHog51EsFawA07QvgNLS.png', 2, 14, '2022-02-11', '2022-02-08 17:40:10', '2022-02-08 17:40:27'),
	(13, 18, 65000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/wrnJFwTfRtYvvF83Uwdcr5zXGAVgv8GXDKS4qJQt.png', 2, 15, '2022-02-11', '2022-02-08 17:46:12', '2022-02-08 17:46:30'),
	(14, 19, 160000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/aon5YXxcyQ1KeDYpH3WOU9tjdwHUt9owCwA94zJ4.jpg', 2, 16, '2022-02-11', '2022-02-08 17:54:33', '2022-02-08 17:54:57'),
	(15, 19, 230000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/UtpL4faB40Ru0ZxmFYxyHN0NOchuHwQWk3dZLYmj.jpg', 2, 17, '2022-02-11', '2022-02-08 18:00:51', '2022-02-08 18:01:09'),
	(16, 21, 90000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/sEYkfNJd4dvE8dStu9gQmNJSPryma2ltBeNG4p6c.jpg', 2, 18, '2022-02-11', '2022-02-08 18:05:46', '2022-02-08 18:06:02'),
	(17, 22, 105000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/PWUc2mOdMu3kFXPDh8oA4hOAplWFp7AHif1yEdw1.jpg', 2, 19, '2022-02-11', '2022-02-08 19:19:06', '2022-02-08 19:19:22'),
	(18, 23, 225000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/RVs3M2V5AGF4R1mrRgTrCPbW1DZ5vI49gOQf2wSH.jpg', 2, 20, '2022-02-11', '2022-02-08 19:26:17', '2022-02-08 19:26:38'),
	(19, 24, 80000, 'Belum Lunas', 'Diproses', '', 'Proses', 'bp/97DKVj2I4xSpZIxV2KvKDTGyZzgvinzEVbslHHUY.jpg', 2, 21, '2022-02-11', '2022-02-08 19:36:50', '2022-02-08 19:37:04'),
	(20, 25, 50000, 'Lunas', 'Dikirim', NULL, 'Selesai', 'bp/Hmo6LdA1mFPihKtbPm0elzULrArv0mW1p7Ny5Zew.jpg', 4, 22, '2022-02-11', '2022-02-08 19:55:02', '2022-02-09 16:48:52'),
	(21, 26, 125000, 'Lunas', 'Dikirim', NULL, 'Proses', 'bp/8FBsqEn0mSeGmbAI16UepDyx9Vywf3Fz8s8TUCfO.jpg', 4, 23, '2022-02-11', '2022-02-08 20:00:16', '2022-02-08 20:04:12'),
	(22, 10, 25000, 'Lunas', 'Dikirim', '123141414', 'Proses', 'bp/RDJbhkcIIpZ5cCJczL7IWc2GaJtWlqBewTTXkEyv.jpg', 1, 24, '2022-02-12', '2022-02-09 16:45:24', '2022-02-09 16:50:43'),
	(23, 27, 110000, 'Lunas', 'Dikirim', 'JNAP-0061460488', 'Selesai', 'bp/oXINhLMdry08X49cJETguUO9NsZSbczSg2pdzp16.jpg', 2, 25, '2022-02-12', '2022-02-09 17:26:11', '2022-02-09 17:57:11');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `total` int(11) NOT NULL,
  `price` double NOT NULL,
  KEY `order_detail_order_id_foreign` (`order_id`),
  KEY `order_detail_product_id_foreign` (`product_id`),
  CONSTRAINT `order_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `order_detail` DISABLE KEYS */;
INSERT INTO `order_detail` (`order_id`, `product_id`, `total`, `price`) VALUES
	(1, 6, 2, 25000),
	(2, 6, 2, 25000),
	(3, 5, 2, 25000),
	(4, 1, 2, 95000),
	(5, 6, 2, 25000),
	(6, 6, 3, 25000),
	(7, 6, 2, 25000),
	(8, 3, 2, 45000),
	(9, 2, 2, 55000),
	(9, 6, 1, 25000),
	(10, 6, 2, 25000),
	(10, 7, 2, 20000),
	(11, 7, 1, 20000),
	(12, 3, 1, 45000),
	(12, 5, 1, 25000),
	(13, 4, 1, 25000),
	(13, 5, 1, 25000),
	(14, 6, 2, 25000),
	(14, 1, 1, 95000),
	(15, 6, 1, 25000),
	(15, 1, 2, 95000),
	(16, 6, 1, 25000),
	(16, 4, 2, 25000),
	(17, 7, 2, 20000),
	(17, 5, 2, 25000),
	(18, 7, 1, 20000),
	(18, 1, 2, 95000),
	(19, 7, 2, 20000),
	(19, 4, 1, 25000),
	(20, 7, 1, 20000),
	(21, 3, 1, 45000),
	(21, 6, 2, 25000),
	(22, 9, 1, 20000),
	(23, 7, 2, 20000),
	(23, 2, 1, 55000);
/*!40000 ALTER TABLE `order_detail` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_category` bigint(20) unsigned NOT NULL,
  `price` double NOT NULL,
  `capital` double NOT NULL,
  `status` enum('Available','Unavailable') COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_id_category_foreign` (`id_category`),
  CONSTRAINT `products_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `deskripsi`, `image`, `id_category`, `price`, `capital`, `status`, `stock`, `created_at`, `updated_at`) VALUES
	(1, 'Boneka Boba', 'Boneka Boba Viral', 'products/L2VsmqTFn0zc7XD2Z2Eo7rLkne8g3uTPOQZHNATt.webp', 1, 95000, 75000, 'Unavailable', 55, '2022-02-06 17:36:28', '2022-02-09 17:15:00'),
	(2, 'Dompet Wanita', 'Dompet wanita bahan bagus', 'products/c5GlVLZSTLjugzzhCDaYGVrIbvKfZwfGLOnqLhfl.jpg', 3, 55000, 35000, 'Available', 150, '2022-02-06 17:37:24', '2022-02-06 17:37:24'),
	(3, 'Hijab Motif', 'Hijab motif, nyaman dipakai', 'products/EMSsJ4ndTfJfPlceDvOR884KxI62KZABmwwx8qiY.jpg', 4, 45000, 30000, 'Available', 45, '2022-02-06 17:38:10', '2022-02-06 17:38:10'),
	(4, 'Nail Polish', 'kutek yang bisa di lepas, ketika ingin shalat tinggal dilepas dan pasang ulang', 'products/k75HF2rk2vfRgDbV5PLXslPagTH1HwuEZaBTu1xA.jpg', 5, 25000, 14000, 'Available', 24, '2022-02-06 17:39:10', '2022-02-06 17:39:10'),
	(5, 'Masker KN 95', 'Masker KN 95 ORIGINAL', 'products/qv3bx9FBqo0IXjMTVK43hQxFRAKaYtbwWOnXwvdB.jpg', 6, 25000, 13000, 'Available', 44, '2022-02-06 17:40:00', '2022-02-06 17:40:00'),
	(6, 'Sarung Tangan Wol', 'Sarung tangan bahan wol, aman dan nyaman dipakai ketika cuaca dingin dan ketika membawa kendaraan', 'products/jyI3saROhsLt1rcWx2NHef1gjwh5mGg5ZuYm47GO.jpg', 7, 25000, 12000, 'Available', 66, '2022-02-06 17:41:01', '2022-02-06 17:41:01'),
	(7, 'Masker Terbaru', 'Masker berkualitas terbaru', 'products/nzGRNVwJr5sSUPYNUqdOLGHjwb8c5jbnNj39ISN0.jpg', 6, 20000, 17000, 'Available', 100, '2022-02-08 13:44:57', '2022-02-08 13:44:57'),
	(8, 'sheetmask', 'sheetmask kecantikan', 'products/Luk1Y6k9kr7hnOBifE6kNMA8riTarxXkstlTGqKB.jpg', 8, 20000, 15000, 'Unavailable', 100, '2022-02-08 19:39:22', '2022-02-09 17:18:11'),
	(9, 'kutek', 'kutek kopel', 'products/1bpG5h4SqrxMkjAR3jzQZhbJUXgvXFRMpK5FRFVC.jpg', 5, 20000, 12000, 'Available', 100, '2022-02-08 20:02:45', '2022-02-08 20:02:45');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('open','close') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reports_user_id_foreign` (`user_id`),
  CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `report_replies` (
  `report_id` bigint(20) unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('inbox','outbox') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inbox',
  KEY `report_replies_report_id_foreign` (`report_id`),
  CONSTRAINT `report_replies_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `report_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_replies` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `shippings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `shippings` DISABLE KEYS */;
INSERT INTO `shippings` (`id`, `city`, `cost`) VALUES
	(1, 'Batusangkar', 5000),
	(2, 'Bukittinggi', 15000),
	(3, 'Payakumbuh', 10000),
	(4, 'Padang', 30000),
	(5, 'Padang Panjang', 20000),
	(6, 'Solok', 20000),
	(7, 'pekanbaru', 50000),
	(8, 'Jakarta', 55000),
	(9, 'Sawah Lunto', 25000);
/*!40000 ALTER TABLE `shippings` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','Pegawai','Member') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Member',
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Pria','Wanita') COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL DEFAULT '2000-01-01',
  `address` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `phone_number`, `gender`, `birth_date`, `address`, `created_at`, `updated_at`, `remember_token`) VALUES
	(1, 'Admin', '$2y$10$C32oPJc3wIXBMOBpSrlvYeD7hPpZjiI6dWXDXkFMfagfwaBAiXf3W', 'admin@gmail.com', 'Admin', '08123456789', 'Wanita', '1999-01-01', 'Jln Raya Bukittinggi, No 123, Kota Bukittinggi', '2022-02-06 17:27:38', '2022-02-06 17:27:38', NULL),
	(2, 'pegawai', '$2y$10$6ADft4ILDdIl5kZ9rplY0O4FV665UWOMnCoSgvOUBJ9ZHKGzoYphC', 'pegawai@gmail.com', 'Pegawai', '08123456789', 'Wanita', '1999-01-01', 'Jln Raya Mayarakat, No 123, Kota Bukittinggi', '2022-02-06 17:27:38', '2022-02-06 17:27:38', NULL),
	(3, 'member1', '$2y$10$bqBQ3KRKWRBvc6FupzWtsOkZCzYAIXEWaEEt.Gp8OQ3vgxbXnb7Fu', 'member1@gmail.com', 'Member', '08123456789', 'Wanita', '1999-01-01', 'Jln Raya Padang, No 123, Kota Bukittinggi', '2022-02-06 17:27:38', '2022-02-08 15:01:50', NULL),
	(5, 'member5', '$2y$10$XyDcM60WbIABs9OZWkgUm.1t8QaxY7JXTZmpXA/Ug4bAf2BrVdNRC', 'member5@gmail.com', 'Member', '08136547586', 'Wanita', '2022-02-06', 'Bukittinggi', '2022-02-06 20:42:02', '2022-02-06 20:42:02', NULL),
	(8, 'member01', '$2y$10$.XY0DXSMyvMX5QxYd00xNeJk/5FVwochd87mzncKQ9djGARYDldAS', 'member01@gmail.com', 'Member', '083180465257', 'Wanita', '2022-02-06', 'padang', '2022-02-06 21:32:51', '2022-02-06 21:32:51', NULL),
	(10, 'member11', '$2y$10$DycjOE7tRDoSsWZVr3fqYOpUJa2mzd3fuegbKG/g/bEbERAOhOD2a', 'member11@gmail.com', 'Member', '+6283180465257', 'Wanita', '2022-02-06', 'Padang', '2022-02-06 21:43:24', '2022-02-06 21:43:24', NULL),
	(11, 'member', '$2y$10$Qo8ea5NpYM1VQCcEGu/Oquk5ZcBrGrBC0qCjZyb3XEsrjZCdgbkVW', 'member@gmail.com', 'Member', '+6283180465257', 'Wanita', '2022-02-11', 'Padang', '2022-02-06 21:52:39', '2022-02-06 21:52:39', NULL),
	(12, 'member13', '$2y$10$RC8OXHGXcu8Gz2OPh8UaJ.wT9hSD8IzszGaEVzXGlTKkyx.PuNpsW', 'member13@gmail.com', 'Member', '+6283180465257', 'Wanita', '2022-02-06', 'Padang', '2022-02-06 22:01:29', '2022-02-06 22:01:29', NULL),
	(13, 'member14', '$2y$10$hNvMOLRTfh2TBiklKUyS3OwxRoZC1X8kZPIVe/DWMWPk.htJKwJzK', 'member14@gmail.com', 'Member', '+6283180465257', 'Wanita', '2022-02-11', 'Padang', '2022-02-06 22:12:57', '2022-02-06 22:12:57', NULL),
	(14, 'member15', '$2y$10$83HPBbSeQXzy8uzxnN3f0.1Xakz8QIbnBASH5V.p1//yjLCLZbPN6', 'member15@gmail.com', 'Member', '+6283180465257', 'Wanita', '2022-02-06', 'Padang', '2022-02-06 22:23:50', '2022-02-06 22:23:50', NULL),
	(17, 'trinovita', '$2y$10$NxluSu/eJJ5VEHXA2mfMaOw0QvPzw2OfApiLkf5hWm1fwbD8SqxXi', 'trinovita@gmail.com', 'Member', '081365406483', 'Wanita', '2022-02-11', 'Bukittinggi', '2022-02-08 17:39:09', '2022-02-08 17:39:09', NULL),
	(18, 'novita', '$2y$10$e05FNYyEB1jvw21aDekeVOwlqDcUe3qAqQLJSMM7tl.fvBlS7tHYa', 'novita@gmail.com', 'Member', '081365406483', 'Wanita', '2022-02-10', 'Bukittinggi', '2022-02-08 17:45:17', '2022-02-08 17:45:17', NULL),
	(19, 'novita ningsih', '$2y$10$JvAmc4yGMX27GG3EUNx.DuMtohajyKbBd82yhPLjfYTiuqxgEj/G2', 'novitaningsih@gmail.com', 'Member', '081365406483', 'Wanita', '2022-02-08', 'Bukittinggi', '2022-02-08 17:53:42', '2022-02-08 17:53:42', NULL),
	(21, 'nvtningsiih', '$2y$10$1SPw0BisohoYUhyX0a/pw.ghSyslppHaZIVmR8p0heHkKR.VpzCKK', 'nvtningsiih@gmail.com', 'Member', '081365406483', 'Wanita', '2022-02-03', 'Bukittinggi', '2022-02-08 18:03:31', '2022-02-08 18:03:31', NULL),
	(22, 'rika123', '$2y$10$5.BVGinBksnD8bmSrmyQFueBfv8YGB079Iueze/xTInf.A/xdsVpm', 'rika@gmail.com', 'Member', '081365406483', 'Wanita', '2022-03-03', 'Bukittinggi', '2022-02-08 19:17:02', '2022-02-08 19:17:02', NULL),
	(23, 'ika123', '$2y$10$1Nky3RDVS735L3KFjIiN4evekMzzT.4Ghh8oqCpsXQ1.jPDi2H1Ha', 'ika@gmail.com', 'Member', '081365408575', 'Wanita', '2022-02-04', 'Bukittinggi', '2022-02-08 19:24:13', '2022-02-08 19:24:13', NULL),
	(24, 'ningsih12', '$2y$10$UeuJ5NKJzJqXHswcm1EGEu8W.KUV6kQ5gZ7OW.j7eu6nrRGj2fyWO', 'ningsih12@gmail.com', 'Member', '08136548595', 'Wanita', '2022-03-01', 'Bukittinggi', '2022-02-08 19:34:48', '2022-02-08 19:34:48', NULL),
	(25, 'member22', '$2y$10$syXcdP74bDjHHoFhDCh2w.fXcujisled5Vu6x7qx9.IB49Ktxh4wi', 'member22@gmail.com', 'Member', '092838335556', 'Pria', '2022-02-10', 'padang', '2022-02-08 19:54:35', '2022-02-08 19:54:35', NULL),
	(26, 'cubie1234', '$2y$10$WvwzdPlJOHlyTJhAdM5sLuW7x/eA.Yo/b8h/Q9iI8zyAcJQKMG6ee', 'cubie@gmail.com', 'Member', '0813654789506', 'Wanita', '2022-02-11', 'padang', '2022-02-08 19:58:31', '2022-02-09 16:28:02', NULL),
	(27, 'novitaaa', '$2y$10$y4lPFLjD1JEBmZuBbqtNNumPQ7L2hG1cZOOy46j47558dcE5Oj5dO', 'novitaa@gmail.com', 'Member', '081365406483', 'Wanita', '2022-02-11', 'Bukittinggi', '2022-02-09 17:22:49', '2022-02-09 17:22:49', NULL),
	(28, 'iciiih', '$2y$10$fNsSdf88mb272qJQTXLvU.07cB33TXPIaEp.8tzdPun7RqX0nJI/a', 'icih@gmail.com', 'Member', '081365406483', 'Wanita', '2022-02-09', 'Padang', '2022-02-09 17:49:09', '2022-02-09 17:49:09', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `user_activities` (
  `user_id` bigint(20) unsigned NOT NULL,
  `last_login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_count` int(11) NOT NULL,
  `order_count` int(11) NOT NULL,
  KEY `user_activities_user_id_foreign` (`user_id`),
  CONSTRAINT `user_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `user_activities` DISABLE KEYS */;
INSERT INTO `user_activities` (`user_id`, `last_login`, `login_count`, `order_count`) VALUES
	(1, '2022-02-09 17:56:25', 41, 0),
	(2, '2022-02-09 17:51:29', 14, 0),
	(3, '2022-02-08 15:02:06', 12, 0),
	(5, '2022-02-06 22:44:59', 2, 0),
	(8, '2022-02-06 22:36:08', 2, 0),
	(10, '2022-02-09 16:44:58', 2, 0),
	(11, '2022-02-06 21:52:48', 1, 0),
	(12, '2022-02-06 22:01:39', 1, 0),
	(13, '2022-02-06 22:13:06', 1, 0),
	(14, '2022-02-06 22:24:00', 1, 0),
	(17, '2022-02-08 17:39:21', 1, 0),
	(18, '2022-02-08 17:45:24', 1, 0),
	(19, '2022-02-08 18:00:12', 2, 0),
	(21, '2022-02-08 18:03:41', 1, 0),
	(22, '2022-02-08 19:17:14', 1, 0),
	(23, '2022-02-08 19:24:19', 1, 0),
	(24, '2022-02-08 19:35:00', 1, 0),
	(25, '2022-02-08 19:54:42', 1, 0),
	(26, '2022-02-09 16:18:54', 3, 0),
	(27, '2022-02-09 17:57:27', 2, 0);
/*!40000 ALTER TABLE `user_activities` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
