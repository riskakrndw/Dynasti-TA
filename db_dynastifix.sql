-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20 Jul 2017 pada 13.59
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dynastifix`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id` int(5) NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(10) NOT NULL,
  `stok` float NOT NULL,
  `satuan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bahan_baku`
--

INSERT INTO `bahan_baku` (`id`, `nama`, `harga`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 'air', 5000, 60, 'ml', '2017-07-19 23:33:49', '2017-07-19 23:33:49'),
(2, 'garam', 9000, 56, 'gr', '2017-07-19 23:34:20', '2017-07-19 23:34:20');

--
-- Trigger `bahan_baku`
--
DELIMITER $$
CREATE TRIGGER `Ice_hapusDetailEs` AFTER DELETE ON `bahan_baku` FOR EACH ROW DELETE FROM detail_bahan
WHERE detail_bahan.id_bahan = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_es`
--

CREATE TABLE `detail_es` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_bahan` int(5) NOT NULL,
  `id_es` int(5) NOT NULL,
  `takaran` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_es`
--

INSERT INTO `detail_es` (`id`, `id_bahan`, `id_es`, `takaran`, `created_at`, `updated_at`) VALUES
(1, 1, 29, 0.8333333333333334, '2017-07-20 00:39:07', '2017-07-20 00:39:07'),
(2, 1, 30, 0.13333333333333333, '2017-07-20 00:39:52', '2017-07-20 00:39:52'),
(3, 2, 31, 0.8571428571428571, '2017-07-20 00:43:19', '2017-07-20 00:43:19'),
(4, 1, 33, 0.06, '2017-07-20 01:04:53', '2017-07-20 01:04:53'),
(5, 1, 32, 0.09, '2017-07-20 01:04:53', '2017-07-20 01:04:53'),
(6, 2, 32, 0.09, '2017-07-20 01:04:53', '2017-07-20 01:04:53'),
(7, 2, 33, 0.06, '2017-07-20 01:04:53', '2017-07-20 01:04:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_pembelian` int(10) NOT NULL,
  `id_bahan` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `subtotal` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Trigger `detail_pembelian`
--
DELIMITER $$
CREATE TRIGGER `Pembelian_kurangStokBahan` BEFORE DELETE ON `detail_pembelian` FOR EACH ROW UPDATE bahan_baku SET stok = stok - old.jumlah
WHERE id = old.id_bahan
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Pembelian_tambahStokBahan` AFTER INSERT ON `detail_pembelian` FOR EACH ROW UPDATE bahan_baku SET stok = stok + NEW.jumlah
WHERE id = NEW.id_bahan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_pemesanan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_es` int(5) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `subtotal` int(10) NOT NULL,
  `status` enum('selesai','belum selesai','','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(5) NOT NULL,
  `id_penjualan` varchar(20) NOT NULL,
  `id_es` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `subtotal` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `id_penjualan`, `id_es`, `jumlah`, `subtotal`, `created_at`, `updated_at`) VALUES
(8, '15', 170, 8, 72000, '2017-06-29 10:45:50', '2017-06-29 10:45:50'),
(10, '16', 170, 10, 90000, '2017-07-05 22:12:57', '2017-07-05 22:12:57'),
(12, '17', 170, 8, 72000, '2017-07-05 23:33:30', '2017-07-05 23:33:30'),
(13, '12', 170, 15, 135000, '2017-07-06 21:04:33', '2017-07-06 21:04:33'),
(14, '18', 170, 4, 36000, '2017-07-06 21:05:03', '2017-07-06 21:05:03');

--
-- Trigger `detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `Penjualan_kurangStokEs` AFTER INSERT ON `detail_penjualan` FOR EACH ROW UPDATE ice_cream SET stok = stok - NEW.jumlah
WHERE id = NEW.id_es
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Penjualan_tambahStokEs` AFTER DELETE ON `detail_penjualan` FOR EACH ROW UPDATE ice_cream SET stok = stok + old.jumlah
WHERE id = old.id_es
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_rasa`
--

CREATE TABLE `detail_rasa` (
  `id` int(5) NOT NULL,
  `id_rasa` int(3) NOT NULL,
  `id_bahan` int(5) NOT NULL,
  `takaran` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_rasa`
--

INSERT INTO `detail_rasa` (`id`, `id_rasa`, `id_bahan`, `takaran`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 0, '2017-07-19 23:36:50', '2017-07-19 23:36:50'),
(2, 3, 1, 0, '2017-07-19 23:38:17', '2017-07-19 23:38:17'),
(3, 4, 1, 0, '2017-07-19 23:40:26', '2017-07-19 23:40:26'),
(4, 5, 1, 0, '2017-07-19 23:43:00', '2017-07-19 23:43:00'),
(5, 6, 1, 0, '2017-07-19 23:43:41', '2017-07-19 23:43:41'),
(6, 7, 1, 0, '2017-07-19 23:45:06', '2017-07-19 23:45:06'),
(7, 8, 1, 0, '2017-07-19 23:46:30', '2017-07-19 23:46:30'),
(8, 9, 2, 0, '2017-07-19 23:47:14', '2017-07-19 23:47:14'),
(9, 10, 1, 0, '2017-07-19 23:47:52', '2017-07-19 23:47:52'),
(10, 11, 1, 0, '2017-07-19 23:48:42', '2017-07-19 23:48:42'),
(11, 12, 1, 0, '2017-07-19 23:49:43', '2017-07-19 23:49:43'),
(12, 13, 1, 0, '2017-07-19 23:51:15', '2017-07-19 23:51:15'),
(13, 14, 2, 0, '2017-07-19 23:55:22', '2017-07-19 23:55:22'),
(14, 15, 1, 0, '2017-07-19 23:56:20', '2017-07-19 23:56:20'),
(15, 16, 1, 0, '2017-07-19 23:57:11', '2017-07-19 23:57:11'),
(16, 17, 1, 0, '2017-07-19 23:58:46', '2017-07-19 23:58:46'),
(17, 18, 1, 0, '2017-07-20 00:00:15', '2017-07-20 00:00:15'),
(18, 19, 2, 0, '2017-07-20 00:01:10', '2017-07-20 00:01:10'),
(19, 20, 1, 0, '2017-07-20 00:02:31', '2017-07-20 00:02:31'),
(20, 21, 1, 0, '2017-07-20 00:03:07', '2017-07-20 00:03:07'),
(21, 22, 1, 0, '2017-07-20 00:03:52', '2017-07-20 00:03:52'),
(22, 23, 1, 0, '2017-07-20 00:05:15', '2017-07-20 00:05:15'),
(23, 24, 1, 0, '2017-07-20 00:06:03', '2017-07-20 00:06:03'),
(24, 25, 1, 0, '2017-07-20 00:06:38', '2017-07-20 00:06:38'),
(25, 25, 2, 0, '2017-07-20 00:06:38', '2017-07-20 00:06:38'),
(26, 26, 1, 0, '2017-07-20 00:34:08', '2017-07-20 00:34:08'),
(27, 27, 1, 0, '2017-07-20 00:34:37', '2017-07-20 00:34:37'),
(28, 28, 1, 0, '2017-07-20 00:35:56', '2017-07-20 00:35:56'),
(29, 29, 1, 0, '2017-07-20 00:37:00', '2017-07-20 00:37:00'),
(30, 30, 1, 0, '2017-07-20 00:39:06', '2017-07-20 00:39:06'),
(31, 31, 1, 0, '2017-07-20 00:39:52', '2017-07-20 00:39:52'),
(32, 32, 2, 0, '2017-07-20 00:43:19', '2017-07-20 00:43:19'),
(33, 33, 1, 0, '2017-07-20 01:04:53', '2017-07-20 01:04:53'),
(34, 33, 2, 0, '2017-07-20 01:04:53', '2017-07-20 01:04:53'),
(35, 37, 1, 6, '2017-07-20 01:21:23', '2017-07-20 01:21:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ice_cream`
--

CREATE TABLE `ice_cream` (
  `id` int(5) NOT NULL,
  `id_jenis` int(3) DEFAULT NULL,
  `id_rasa` int(3) DEFAULT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(10) DEFAULT '0',
  `jumlah_produksi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ice_cream`
--

INSERT INTO `ice_cream` (`id`, `id_jenis`, `id_rasa`, `nama`, `stok`, `jumlah_produksi`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Ice Cream cup strawberry', NULL, 0, '2017-07-19 23:36:50', '2017-07-19 23:36:50'),
(2, 1, NULL, 'Ice Cream cup strawberry', NULL, 0, '2017-07-19 23:38:17', '2017-07-19 23:38:17'),
(3, 1, NULL, 'Ice Cream cup strawberry', NULL, 0, '2017-07-19 23:40:26', '2017-07-19 23:40:26'),
(4, 1, NULL, 'Ice Cream cup strawberry', NULL, 0, '2017-07-19 23:43:00', '2017-07-19 23:43:00'),
(5, 1, NULL, 'Ice Cream cup strawberry', NULL, 0, '2017-07-19 23:43:41', '2017-07-19 23:43:41'),
(6, 1, NULL, 'Ice Cream cup sasasa', NULL, 0, '2017-07-19 23:45:06', '2017-07-19 23:45:06'),
(7, 1, NULL, 'Ice Cream cup sasassa', NULL, 0, '2017-07-19 23:46:30', '2017-07-19 23:46:30'),
(8, 1, NULL, 'Ice Cream cup sddssd', NULL, 0, '2017-07-19 23:47:14', '2017-07-19 23:47:14'),
(9, 1, NULL, 'Ice Cream cup dasadas', NULL, 0, '2017-07-19 23:47:52', '2017-07-19 23:47:52'),
(10, 1, NULL, 'Ice Cream cup dssd', NULL, 0, '2017-07-19 23:48:42', '2017-07-19 23:48:42'),
(11, 1, NULL, 'Ice Cream cup vvbvbv', NULL, 0, '2017-07-19 23:49:43', '2017-07-19 23:49:43'),
(12, 1, NULL, 'Ice Cream cup strawberry', NULL, 0, '2017-07-19 23:51:15', '2017-07-19 23:51:15'),
(13, 1, NULL, 'Ice Cream cup cokelatt', NULL, 0, '2017-07-19 23:55:22', '2017-07-19 23:55:22'),
(14, 1, NULL, 'Ice Cream cup strawberry', NULL, 0, '2017-07-19 23:56:20', '2017-07-19 23:56:20'),
(15, 1, NULL, 'Ice Cream cup sasasasa', NULL, 0, '2017-07-19 23:57:11', '2017-07-19 23:57:11'),
(16, 1, NULL, 'Ice Cream cup sasasasa', NULL, 0, '2017-07-19 23:58:46', '2017-07-19 23:58:46'),
(17, 1, NULL, 'Ice Cream cup aasasa', NULL, 0, '2017-07-20 00:00:15', '2017-07-20 00:00:15'),
(18, 1, NULL, 'Ice Cream cup vcvcv', NULL, 0, '2017-07-20 00:01:10', '2017-07-20 00:01:10'),
(19, 1, NULL, 'Ice Cream cup sasasasa', NULL, 0, '2017-07-20 00:02:31', '2017-07-20 00:02:31'),
(20, 1, NULL, 'Ice Cream cup sasasa', NULL, 0, '2017-07-20 00:03:07', '2017-07-20 00:03:07'),
(21, 1, NULL, 'Ice Cream cup sasasaa', NULL, 0, '2017-07-20 00:03:52', '2017-07-20 00:03:52'),
(22, 1, NULL, 'Ice Cream cup sfsfs', NULL, 0, '2017-07-20 00:05:15', '2017-07-20 00:05:15'),
(23, 1, NULL, 'Ice Cream cup dadadaa', NULL, 0, '2017-07-20 00:06:03', '2017-07-20 00:06:03'),
(24, 1, NULL, 'Ice Cream cup strawberry', NULL, 0, '2017-07-20 00:06:38', '2017-07-20 00:06:38'),
(25, 1, 26, 'Ice Cream cup xzxzxz', NULL, 0, '2017-07-20 00:34:08', '2017-07-20 00:34:08'),
(26, 1, 27, 'Ice Cream cup saaas', NULL, 0, '2017-07-20 00:34:37', '2017-07-20 00:34:37'),
(27, 1, 28, 'Ice Cream cup sasasa', NULL, 0, '2017-07-20 00:35:56', '2017-07-20 00:35:56'),
(28, 1, 29, 'Ice Cream cup sasasa', NULL, 0, '2017-07-20 00:37:00', '2017-07-20 00:37:00'),
(29, 1, 30, 'Ice Cream cup sasa', NULL, 0, '2017-07-20 00:39:06', '2017-07-20 00:39:06'),
(30, 1, 31, 'Ice Cream cup baru', NULL, 0, '2017-07-20 00:39:52', '2017-07-20 00:39:52'),
(31, 1, 32, 'Ice Cream cup ddsds', 0, 0, '2017-07-20 00:43:19', '2017-07-20 00:43:19'),
(32, 1, 33, 'Ice Cream cup pisang', 0, 0, '2017-07-20 01:04:53', '2017-07-20 01:04:53'),
(33, 2, 33, 'Ice Cream stik pisang', 0, 0, '2017-07-20 01:04:53', '2017-07-20 01:04:53'),
(34, 1, 34, 'Ice Cream cup qaqa', 0, 50, '2017-07-20 01:16:36', '2017-07-20 01:16:36'),
(35, 2, 34, 'Ice Cream stik qaqa', 0, 50, '2017-07-20 01:16:36', '2017-07-20 01:16:36'),
(36, 1, 35, 'Ice Cream cup fdfdfd', 0, 6, '2017-07-20 01:18:07', '2017-07-20 01:18:07'),
(37, 1, 36, 'Ice Cream cup ffdfd', 0, 7, '2017-07-20 01:19:21', '2017-07-20 01:19:21'),
(38, 1, 37, 'Ice Cream cup gfggff', 0, 7, '2017-07-20 01:21:23', '2017-07-20 01:21:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id` int(3) NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id`, `nama`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'cup', 3000, '2017-07-19 23:30:43', '2017-07-19 23:30:43'),
(2, 'stik', 9000, '2017-07-20 01:04:14', '2017-07-20 01:04:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_05_12_071822_create_jenis_table', 1),
(4, '2017_05_12_093451_create_rasa_table', 1),
(5, '2017_05_12_093507_create_bahan_baku_table', 2),
(6, '2017_05_12_093524_create_detail_bahan_table', 3),
(7, '2017_05_12_093539_create_ice_cream_table', 4),
(8, '2017_05_12_093552_create_pembelian_table', 4),
(9, '2017_05_12_093603_create_detail_pembelian_table', 5),
(10, '2017_05_12_093615_create_penjualan_table', 6),
(11, '2017_05_12_093628_create_pemesanan_table', 6),
(12, '2017_05_12_093639_create_detail_pemesanan_table', 7),
(13, '2017_05_12_093707_create_produksi_table', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(10) NOT NULL,
  `id_users` int(3) NOT NULL,
  `kode_pembelian` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(10) NOT NULL,
  `status` enum('berhasil','menunggu','gagal','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `id_users`, `kode_pembelian`, `total`, `status`, `tgl`, `created_at`, `updated_at`) VALUES
(2, 5, 'saassscs', 1606905, 'berhasil', '2017-06-01', '2017-06-29 02:11:42', '2017-06-29 02:35:43'),
(3, 5, 'dadsad', 72000, 'berhasil', '2017-06-13', '2017-06-29 11:18:16', '2017-07-06 02:44:34'),
(4, 5, 'qqq', 9000, 'berhasil', '2017-07-11', '2017-07-02 09:16:54', '2017-07-02 09:16:54'),
(5, 5, 'xaxaax', 136362, 'berhasil', '2017-07-26', '2017-07-02 09:45:15', '2017-07-02 09:45:15'),
(6, 5, 'mandnda', 21853816, 'berhasil', '2017-07-11', '2017-07-05 21:50:36', '2017-07-05 21:50:59'),
(7, 6, 'keu', 2272725, 'berhasil', '2017-07-04', '2017-07-05 22:08:41', '2017-07-05 22:08:41'),
(8, 5, 'wawaw', 40000, 'berhasil', '2017-07-03', '2017-07-05 23:07:00', '2017-07-05 23:07:00'),
(9, 5, 'asa', 44000, 'berhasil', '2017-07-18', '2017-07-06 02:39:30', '2017-07-06 02:39:30'),
(10, 5, 'barubgt', 32000, 'berhasil', '2017-07-19', '2017-07-06 02:47:54', '2017-07-06 02:47:54'),
(11, 5, 'AAAAAAA', 80000, 'berhasil', '2017-07-04', '2017-07-06 02:49:44', '2017-07-06 02:49:44'),
(12, 5, 'BBBBBB', 44000, 'berhasil', '2017-07-04', '2017-07-06 02:50:55', '2017-07-06 02:50:55'),
(13, 5, 'CCCCCCCCCCC', 32000, 'berhasil', '2017-07-08', '2017-07-06 02:51:26', '2017-07-06 02:51:26'),
(14, 5, 'DDDDDDDDDDD', 40000, 'berhasil', '2017-07-12', '2017-07-06 02:54:01', '2017-07-06 02:54:01'),
(15, 5, 'wawa', 32000, 'berhasil', '2017-07-05', '2017-07-06 04:28:08', '2017-07-06 04:28:08'),
(16, 8, 'wrw', 64000, 'berhasil', '2017-07-11', '2017-07-06 04:48:13', '2017-07-07 02:45:16'),
(17, 5, 'ZZZZ', 1850180, 'berhasil', '2017-07-05', '2017-07-06 21:00:31', '2017-07-06 21:01:08'),
(18, 9, 'keuangan', 32000, 'berhasil', '2017-07-04', '2017-07-07 03:00:11', '2017-07-07 03:00:11'),
(19, 8, 'wwewaae', 32000, 'gagal', '2017-07-11', '2017-07-07 03:46:16', '2017-07-07 07:51:37');

--
-- Trigger `pembelian`
--
DELIMITER $$
CREATE TRIGGER `Pembelian_hapusDetailBahan` AFTER DELETE ON `pembelian` FOR EACH ROW DELETE FROM detail_pembelian
WHERE detail_pembelian.id_pembelian = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(10) NOT NULL,
  `id_users` int(3) NOT NULL,
  `kode_pemesanan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `total` int(10) NOT NULL,
  `status` enum('selesai','belum selesai','','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(10) NOT NULL,
  `id_users` int(3) NOT NULL,
  `kode_penjualan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `total` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `id_users`, `kode_penjualan`, `tgl`, `total`, `created_at`, `updated_at`) VALUES
(12, 5, 'axaxe', '2017-06-07', 135000, '2017-06-28 11:03:45', '2017-07-06 21:04:32'),
(15, 6, 'qqqss', '2017-06-07', 72000, '2017-06-29 10:40:51', '2017-06-29 10:45:49'),
(16, 6, 'keu', '2017-07-11', 90000, '2017-07-05 22:12:43', '2017-07-05 22:12:56'),
(17, 6, 'dddd', '2017-07-04', 72000, '2017-07-05 23:33:13', '2017-07-05 23:33:30'),
(18, 5, 'wwawa', '2017-07-03', 36000, '2017-07-06 21:05:02', '2017-07-06 21:05:02');

--
-- Trigger `penjualan`
--
DELIMITER $$
CREATE TRIGGER `Penjualan_hapusDetailEs` AFTER DELETE ON `penjualan` FOR EACH ROW DELETE FROM detail_penjualan
WHERE detail_penjualan.id_penjualan = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi`
--

CREATE TABLE `produksi` (
  `id` int(20) NOT NULL,
  `id_es` int(5) NOT NULL,
  `id_users` int(3) NOT NULL,
  `kode_produksi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` int(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rasa`
--

CREATE TABLE `rasa` (
  `id` int(3) NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rasa`
--

INSERT INTO `rasa` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(26, 'xzxzxz', '2017-07-20 00:34:08', '2017-07-20 00:34:08'),
(27, 'saaas', '2017-07-20 00:34:37', '2017-07-20 00:34:37'),
(28, 'sasasa', '2017-07-20 00:35:56', '2017-07-20 00:35:56'),
(29, 'sasasa', '2017-07-20 00:36:59', '2017-07-20 00:36:59'),
(30, 'sasa', '2017-07-20 00:39:06', '2017-07-20 00:39:06'),
(31, 'baru', '2017-07-20 00:39:51', '2017-07-20 00:39:51'),
(32, 'ddsds', '2017-07-20 00:43:18', '2017-07-20 00:43:18'),
(33, 'pisang', '2017-07-20 01:04:52', '2017-07-20 01:04:52'),
(34, 'qaqa', '2017-07-20 01:16:36', '2017-07-20 01:16:36'),
(35, 'fdfdfd', '2017-07-20 01:18:07', '2017-07-20 01:18:07'),
(36, 'ffdfd', '2017-07-20 01:19:20', '2017-07-20 01:19:20'),
(37, 'gfggff', '2017-07-20 01:21:23', '2017-07-20 01:21:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('manager','produksi','keuangan','pengadaan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `level`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'maulana rizki', 'manager', 'riskim', '$2y$10$yn0O9MHvhOW5TpZXJHRsoeOBAokFDuB/tYavYWS.mLjyRzTO.i4ly', 'zvf1MPNalIfqMgUcsNFifuP89Iwop2kitsNDpmgF8uUfp95mw2AgOntInEDw', '2017-06-20 04:21:13', '2017-06-21 22:59:23'),
(6, 'Riska kurnia', 'keuangan', 'riskakrndw', '$2y$10$B9tEVI9yS6Y4t5/y397xiOpFQYiWO8r3Pt.5tcggPacjKF6JoooBa', '8x1VPb52qMRBrob4A5GCVioBzjRfuZucV7uRmwFoDiPn43ds4mAyABuJOfmg', '2017-06-29 03:14:50', '2017-06-29 03:14:50'),
(8, 'wawawa', 'pengadaan', 'pengadaan', '$2y$10$XxJJZnWQGxd4QnnGCalO.O1yCvGLNmSOAw1YhjkZAxuksVG2grE0u', 'CveXvUNc2naLi0gl4GdDIeozBBp4o7ovR2Fg3sE98W5UecPs4VlY8Has7PRk', '2017-07-06 02:59:30', '2017-07-06 02:59:30'),
(9, 'wewewewe', 'keuangan', 'keuangan', '$2y$10$dEWNqJ.8RoVMTP0bqxx7aumEUDEY/N/AvoQ.ckc4n4WMdFfK4F8PW', 'RnHHGnHILNtKi6JlzI6yNTcDoIjKssxvri5LjdDu7jDhTNDMBhehheCIBq2D', '2017-07-07 02:57:09', '2017-07-07 02:57:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_es`
--
ALTER TABLE `detail_es`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pembelian` (`id_pembelian`),
  ADD KEY `id_bahan` (`id_bahan`),
  ADD KEY `id_pembelian_2` (`id_pembelian`),
  ADD KEY `id_bahan_2` (`id_bahan`);

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_rasa`
--
ALTER TABLE `detail_rasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ice_cream`
--
ALTER TABLE `ice_cream`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `id_rasa` (`id_rasa`),
  ADD KEY `id_jenis_2` (`id_jenis`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rasa`
--
ALTER TABLE `rasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `detail_es`
--
ALTER TABLE `detail_es`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `detail_rasa`
--
ALTER TABLE `detail_rasa`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `ice_cream`
--
ALTER TABLE `ice_cream`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rasa`
--
ALTER TABLE `rasa`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `pembelianbahan` FOREIGN KEY (`id_bahan`) REFERENCES `bahan_baku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ice_cream`
--
ALTER TABLE `ice_cream`
  ADD CONSTRAINT `jenises` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `rasaes` FOREIGN KEY (`id_rasa`) REFERENCES `rasa` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;