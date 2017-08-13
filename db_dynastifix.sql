-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Agu 2017 pada 14.51
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
  `stok_min` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bahan_baku`
--

INSERT INTO `bahan_baku` (`id`, `nama`, `harga`, `stok`, `satuan`, `stok_min`, `created_at`, `updated_at`) VALUES
(1, 'air', 5000, 83.85, 'ml', 20, '2017-07-19 23:33:49', '2017-07-26 20:53:58'),
(2, 'garam', 9000, 64.89, 'gr', 50, '2017-07-19 23:34:20', '2017-07-24 10:57:40'),
(3, 'susu cair', 8000, 97.34, 'ml', 50, '2017-07-20 05:05:57', '2017-07-26 20:53:58'),
(4, 'susu bubuk', 250, 10, 'gr', 20, '2017-07-25 08:26:29', '2017-07-25 09:04:09');

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
-- Dumping data untuk tabel `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `id_pembelian`, `id_bahan`, `jumlah`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 20, 1, 4, 20000, '2017-07-21 03:36:34', '2017-07-21 03:36:34'),
(2, 20, 2, 4, 36000, '2017-07-21 03:36:34', '2017-07-21 03:36:34'),
(5, 21, 1, 8, 40000, '2017-07-24 08:09:08', '2017-07-24 08:09:08'),
(6, 21, 3, 5, 40000, '2017-07-24 08:09:08', '2017-07-24 08:09:08'),
(7, 21, 2, 5, 45000, '2017-07-24 08:09:08', '2017-07-24 08:09:08'),
(9, 22, 1, 5, 25000, '2017-07-25 10:33:27', '2017-07-25 10:33:27'),
(10, 22, 3, 4, 32000, '2017-07-25 10:33:27', '2017-07-25 10:33:27'),
(11, 23, 1, 4, 20000, '2017-07-25 11:31:03', '2017-07-25 11:31:03'),
(12, 24, 1, 4, 20000, '2017-08-08 09:57:17', '2017-08-08 09:57:17');

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
  `status` enum('menunggu','siap') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id`, `id_pemesanan`, `id_es`, `jumlah`, `subtotal`, `status`, `created_at`, `updated_at`) VALUES
(19, '29', 43, 6, 12000, 'siap', '2017-07-30 23:29:24', '2017-08-09 06:57:15'),
(20, '30', 44, 4, 16000, 'menunggu', '2017-07-30 23:30:29', '2017-07-30 23:30:29');

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
(15, '19', 44, 6, 24000, '2017-07-22 07:49:14', '2017-07-22 07:49:14'),
(17, '20', 56, 5, 20000, '2017-07-24 08:10:43', '2017-07-24 08:10:43'),
(18, '20', 43, 4, 8000, '2017-07-24 08:10:43', '2017-07-24 08:10:43'),
(19, '21', 43, 9, 18000, '2017-07-24 08:13:47', '2017-07-24 08:13:47'),
(21, '22', 43, 5, 10000, '2017-07-25 10:55:36', '2017-07-25 10:55:36'),
(22, '22', 44, 2, 8000, '2017-07-25 10:55:36', '2017-07-25 10:55:36');

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
-- Struktur dari tabel `detail_produksi`
--

CREATE TABLE `detail_produksi` (
  `id` int(5) NOT NULL,
  `id_produksi` int(10) NOT NULL,
  `id_es` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_produksi`
--

INSERT INTO `detail_produksi` (`id`, `id_produksi`, `id_es`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 5, 44, 1, '2017-07-21 02:37:54', '2017-07-21 02:37:54'),
(2, 5, 45, 1, '2017-07-21 02:37:54', '2017-07-21 02:37:54'),
(3, 6, 44, 1, '2017-07-21 02:40:17', '2017-07-21 02:40:17'),
(4, 6, 45, 1, '2017-07-21 02:40:17', '2017-07-21 02:40:17'),
(5, 7, 44, 1, '2017-07-21 02:42:10', '2017-07-21 02:42:10'),
(6, 7, 45, 1, '2017-07-21 02:42:11', '2017-07-21 02:42:11'),
(7, 8, 44, 1, '2017-07-21 02:43:42', '2017-07-21 02:43:42'),
(8, 8, 45, 1, '2017-07-21 02:43:42', '2017-07-21 02:43:42'),
(9, 9, 44, 1, '2017-07-21 02:45:01', '2017-07-21 02:45:01'),
(10, 9, 45, 1, '2017-07-21 02:45:01', '2017-07-21 02:45:01'),
(11, 10, 57, 1, '2017-07-24 10:57:40', '2017-07-24 10:57:40'),
(12, 11, 43, 3, '2017-07-25 12:17:15', '2017-07-25 12:17:15'),
(13, 12, 43, 12, '2017-07-26 20:53:58', '2017-07-26 20:53:58');

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
(41, 40, 3, 10, '2017-07-20 05:26:30', '2017-07-20 05:26:30'),
(42, 40, 1, 5, '2017-07-20 05:26:30', '2017-07-20 05:26:30'),
(56, 44, 1, 4, '2017-07-24 07:47:07', '2017-07-24 07:47:07'),
(58, 44, 2, 8, '2017-07-24 08:31:59', '2017-07-24 08:31:59'),
(59, 45, 1, 5, '2017-07-24 20:06:50', '2017-07-24 20:06:50'),
(60, 45, 3, 5, '2017-07-24 20:07:22', '2017-07-24 20:07:22');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ice_cream`
--

INSERT INTO `ice_cream` (`id`, `id_jenis`, `id_rasa`, `nama`, `stok`, `jumlah_produksi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(43, 1, 40, 'Ice Cream cup kecil matcha', 100, 100, '2017-07-20 05:26:30', '2017-07-26 20:53:58', NULL),
(44, 3, 41, 'Ice Cream cup besar vanila', -1, 150, '2017-07-20 21:33:07', '2017-07-21 02:45:01', NULL),
(45, 1, 41, 'Ice Cream cup kecil vanila', 7, 100, '2017-07-20 21:33:07', '2017-07-21 02:45:01', NULL),
(46, 1, 42, 'Ice Cream cup kecil pisang', 0, 100, '2017-07-24 03:17:57', '2017-07-24 03:17:57', NULL),
(47, 2, 42, 'Ice Cream stik pisang', 10, 150, '2017-07-24 03:17:57', '2017-07-24 22:33:57', NULL),
(56, 3, 44, 'Ice Cream cup besar strawberry', 90, 800, '2017-07-24 07:50:54', '2017-07-24 22:34:10', NULL),
(57, 2, 44, 'Ice Cream stik strawberry', 1, 70, '2017-07-24 07:50:54', '2017-07-24 10:57:40', NULL),
(58, 1, 44, 'Ice Cream cup kecil strawberry', 0, 80, '2017-07-24 08:31:59', '2017-07-24 08:38:57', '2017-07-24 08:38:57'),
(59, 2, 45, 'Ice Cream stik vanila', 0, 100, '2017-07-24 20:06:50', '2017-07-24 20:06:50', NULL),
(60, 3, 45, 'Ice Cream cup besar vanila', 30, 80, '2017-07-24 20:06:50', '2017-07-25 09:19:10', NULL),
(61, 1, 45, 'Ice Cream cup kecil vanila', 0, 90, '2017-07-24 20:06:51', '2017-07-24 20:07:23', '2017-07-24 20:07:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id` int(3) NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id`, `nama`, `harga`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'cup kecil', 2000, '2017-07-19 23:30:43', '2017-07-24 00:52:35', NULL),
(2, 'stik', 9000, '2017-07-20 01:04:14', '2017-07-20 01:04:14', NULL),
(3, 'cup besar', 4000, '2017-07-20 05:03:03', '2017-07-24 09:15:32', NULL);

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
(20, 5, 'sdas', 56000, 'berhasil', '2017-07-11', '2017-07-21 03:36:34', '2017-07-21 03:36:34'),
(21, 5, 'popopopo', 125000, 'berhasil', '2017-07-19', '2017-07-24 08:08:38', '2017-07-24 08:09:07'),
(22, 9, 'dari keu1', 57000, 'berhasil', '2017-07-27', '2017-07-25 10:30:45', '2017-07-25 10:33:26'),
(23, 8, 'dari u', 20000, 'berhasil', '2017-07-13', '2017-07-25 11:31:02', '2017-07-25 11:32:09'),
(24, 8, 'asasasaas', 20000, 'menunggu', '2017-08-08', '2017-08-08 09:57:17', '2017-08-08 09:57:17');

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
  `tanggal` date NOT NULL,
  `total` int(10) NOT NULL,
  `status` enum('menunggu','siap','selesai','batal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `id_users`, `kode_pemesanan`, `nama`, `alamat`, `telepon`, `tanggal`, `total`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(29, 5, 'qqq', 'aaa', 'sda', '222', '2017-07-13', 12000, 'selesai', '2017-07-30 23:29:23', '2017-08-09 06:57:56', NULL),
(30, 5, 'dss', 'dss', 'asa', '33', '2017-07-08', 16000, 'menunggu', '2017-07-30 23:30:28', '2017-07-30 23:30:28', NULL);

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
(19, 5, 'baru', '2017-07-19', 24000, '2017-07-22 07:49:13', '2017-07-22 07:49:13'),
(20, 5, 'popoopo', '2017-07-11', 28000, '2017-07-24 08:10:12', '2017-07-24 08:10:42'),
(21, 5, 'hjhj', '2017-07-11', 18000, '2017-07-24 08:13:47', '2017-07-24 08:13:47'),
(22, 9, 'dari keu1', '2017-07-28', 18000, '2017-07-25 10:54:43', '2017-07-25 10:55:35');

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
  `id` int(10) NOT NULL,
  `id_users` int(3) NOT NULL,
  `kode_produksi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id`, `id_users`, `kode_produksi`, `tgl`, `created_at`, `updated_at`) VALUES
(5, 5, 'qqqq', '2017-07-26', '2017-07-21 02:37:53', '2017-08-13 05:39:54'),
(6, 5, 'aas', '2017-07-25', '2017-07-21 02:40:16', '2017-07-21 02:40:16'),
(7, 5, 'sssa', '2017-07-26', '2017-07-21 02:42:10', '2017-07-21 02:42:10'),
(8, 5, 'baru', '2017-07-11', '2017-07-21 02:43:41', '2017-07-21 02:43:41'),
(9, 5, 'aasa', '2017-07-12', '2017-07-21 02:45:00', '2017-07-21 02:45:00'),
(10, 5, 'awww', '2017-07-31', '2017-07-24 10:57:39', '2017-07-24 22:30:10'),
(11, 10, 'dari keu1', '2017-07-28', '2017-07-25 12:17:14', '2017-07-25 12:17:44'),
(12, 5, 'iuj', '2017-07-04', '2017-07-26 20:53:58', '2017-07-26 20:53:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rasa`
--

CREATE TABLE `rasa` (
  `id` int(3) NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rasa`
--

INSERT INTO `rasa` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(40, 'matcha', '2017-07-20 05:26:30', '2017-07-20 05:26:30', NULL),
(41, 'vanila1', '2017-07-20 21:33:06', '2017-07-24 20:05:47', '2017-07-24 20:05:47'),
(42, 'pisang11', '2017-07-24 03:17:55', '2017-07-24 20:05:56', '2017-07-24 20:05:56'),
(43, 'pisang', '2017-07-24 03:17:59', '2017-07-24 20:06:03', '2017-07-24 20:06:03'),
(44, 'strawberry', '2017-07-24 06:27:58', '2017-07-24 07:50:54', NULL),
(45, 'vanila', '2017-07-24 20:06:49', '2017-07-24 20:06:49', NULL);

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
(5, 'maulana rizki', 'manager', 'riskim', '$2y$10$yn0O9MHvhOW5TpZXJHRsoeOBAokFDuB/tYavYWS.mLjyRzTO.i4ly', 'habGHIKUtR4sTP6aUlXbvUTHamzA0uJbt86z5yT8ilXPJ36Bmj7c7ltyDoSD', '2017-06-20 04:21:13', '2017-06-21 22:59:23'),
(6, 'Riska kurnia', 'keuangan', 'keuangan1', '$2y$10$B9tEVI9yS6Y4t5/y397xiOpFQYiWO8r3Pt.5tcggPacjKF6JoooBa', 'oOzd8uKagMsNRNbR9iDzrQobFDPPf3ewpXS00x6Qutf2JKNwFUghB30ojthW', '2017-06-29 03:14:50', '2017-07-25 09:45:08'),
(8, 'wawawa', 'pengadaan', 'pengadaan1', '$2y$10$XxJJZnWQGxd4QnnGCalO.O1yCvGLNmSOAw1YhjkZAxuksVG2grE0u', '7iJWLwhpPlZzhdNTVfKAnSjjQSG0ejxKGqVbzWTXL1BIddB7TlBMVuyacRqZ', '2017-07-06 02:59:30', '2017-07-25 09:45:22'),
(9, 'wewewewe', 'keuangan', 'keuangan', '$2y$10$dEWNqJ.8RoVMTP0bqxx7aumEUDEY/N/AvoQ.ckc4n4WMdFfK4F8PW', 'CYO3wrx6cVZPFceJtEFMf9x98oQ7vgYi3UWL8MLbqC97XIasUpr3N2XX3JoD', '2017-07-07 02:57:09', '2017-07-07 02:57:09'),
(10, 'qqq', 'produksi', 'produksi', '$2y$10$0k/.aEMtLDremkbXA7CfCOgLjNxe9YP4nttjmQ0/p9mvX/VG7Zp22', NULL, '2017-07-25 11:40:12', '2017-07-25 11:40:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
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
-- Indexes for table `detail_produksi`
--
ALTER TABLE `detail_produksi`
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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `detail_produksi`
--
ALTER TABLE `detail_produksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `detail_rasa`
--
ALTER TABLE `detail_rasa`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `ice_cream`
--
ALTER TABLE `ice_cream`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `rasa`
--
ALTER TABLE `rasa`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
