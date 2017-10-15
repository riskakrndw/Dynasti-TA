-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15 Okt 2017 pada 14.37
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 7.0.8

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
  `stok` double NOT NULL,
  `satuan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_min` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bahan_baku`
--

INSERT INTO `bahan_baku` (`id`, `nama`, `harga`, `stok`, `satuan`, `stok_min`, `created_at`, `updated_at`) VALUES
(7, 'cream', 15000, 35, 'liter', 20, '2017-10-11 00:10:31', '2017-10-11 00:10:31'),
(9, 'air', 5000, 7930, 'ml', 5000, '2017-10-11 16:09:47', '2017-10-15 12:18:31'),
(10, 'susu bubuk', 5000, 5000, 'gram', 500, '2017-10-12 03:13:39', '2017-10-12 03:13:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_pembelian` int(3) NOT NULL,
  `id_bahan` int(3) NOT NULL,
  `jumlah` int(7) NOT NULL,
  `subtotal` int(10) NOT NULL,
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_pemesanan` int(5) NOT NULL,
  `id_es` int(3) NOT NULL,
  `jumlah` int(7) NOT NULL,
  `subtotal` int(10) NOT NULL,
  `status` enum('menunggu','siap','batal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id`, `id_pemesanan`, `id_es`, `jumlah`, `subtotal`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, 15, 13, 10, 40000, 'siap', '2017-10-12 01:32:36', '2017-10-12 01:32:43', NULL),
(17, 16, 13, 100, 400000, 'siap', '2017-10-12 03:16:52', '2017-10-12 03:17:04', NULL),
(18, 17, 13, 5, 20000, 'siap', '2017-10-12 03:45:33', '2017-10-12 03:49:08', NULL),
(19, 17, 14, 5, 25000, 'siap', '2017-10-12 03:45:33', '2017-10-12 03:49:12', NULL),
(20, 18, 14, 5, 25000, 'siap', '2017-10-12 03:49:55', '2017-10-12 03:50:44', NULL),
(21, 18, 13, 50, 200000, 'siap', '2017-10-12 03:49:55', '2017-10-12 03:50:49', NULL),
(22, 19, 17, 100, 400000, 'menunggu', '2017-10-12 04:29:19', '2017-10-12 04:29:19', NULL),
(23, 19, 18, 100, 500000, 'menunggu', '2017-10-12 04:29:19', '2017-10-12 04:29:19', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(5) NOT NULL,
  `id_penjualan` int(5) NOT NULL,
  `id_es` int(5) NOT NULL,
  `jumlah` int(7) NOT NULL,
  `subtotal` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `id_penjualan`, `id_es`, `jumlah`, `subtotal`, `created_at`, `updated_at`) VALUES
(8, 5, 14, 5, 25000, '2017-10-12 01:31:10', '2017-10-12 01:31:10'),
(9, 6, 13, 5, 20000, '2017-10-12 01:31:24', '2017-10-12 01:31:24'),
(10, 7, 13, 10, 40000, '2017-10-12 01:31:47', '2017-10-12 01:31:47'),
(11, 8, 13, 10, 40000, '2017-10-12 01:32:06', '2017-10-12 01:32:06'),
(13, 9, 13, 20, 80000, '2017-10-12 01:36:28', '2017-10-12 01:36:28'),
(15, 11, 17, 10, 40000, '2017-10-12 03:31:37', '2017-10-12 03:31:37'),
(16, 12, 13, 3, 12000, '2017-10-13 14:13:16', '2017-10-13 14:13:16'),
(17, 13, 16, 3, 12000, '2017-10-13 14:27:18', '2017-10-13 14:27:18'),
(18, 10, 13, 33, 132000, '2017-10-13 14:34:26', '2017-10-13 14:34:26'),
(19, 10, 14, 100, 500000, '2017-10-13 14:34:26', '2017-10-13 14:34:26'),
(20, 14, 14, 3, 15000, '2017-10-15 11:27:57', '2017-10-15 11:27:57'),
(21, 15, 16, 2, 8000, '2017-10-15 11:28:10', '2017-10-15 11:28:10'),
(23, 16, 14, 2, 10000, '2017-10-15 12:28:27', '2017-10-15 12:28:27');

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
  `id_produksi` int(5) NOT NULL,
  `id_es` int(5) NOT NULL,
  `jumlah` int(7) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_produksi`
--

INSERT INTO `detail_produksi` (`id`, `id_produksi`, `id_es`, `jumlah`, `created_at`, `updated_at`) VALUES
(15, 11, 13, 3, '2017-10-15 12:18:31', '2017-10-15 12:18:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_rasa`
--

CREATE TABLE `detail_rasa` (
  `id` int(5) NOT NULL,
  `id_rasa` int(3) NOT NULL,
  `id_bahan` int(3) NOT NULL,
  `takaran` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_rasa`
--

INSERT INTO `detail_rasa` (`id`, `id_rasa`, `id_bahan`, `takaran`, `created_at`, `updated_at`) VALUES
(10, 9, 9, 1000, '2017-10-12 01:26:16', '2017-10-12 01:26:16');

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
  `stok_min` int(10) DEFAULT '0',
  `jumlah_produksi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ice_cream`
--

INSERT INTO `ice_cream` (`id`, `id_jenis`, `id_rasa`, `nama`, `stok`, `stok_min`, `jumlah_produksi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 22, 9, 'Ice Cream cup kecil vanila', 461, 600, 100, '2017-10-12 01:26:16', '2017-10-15 12:18:31', NULL),
(14, 23, 10, 'Ice Cream cup besar strawberry', 5, 100, 50, '2017-10-12 01:27:16', '2017-10-12 03:50:44', NULL),
(16, 22, 12, 'Ice Cream cup kecil matcha', 98, 100, 100, '2017-10-12 03:14:20', '2017-10-13 14:32:18', NULL),
(17, 22, 13, 'Ice Cream cup kecil cokelat', 240, 50, 100, '2017-10-12 03:22:19', '2017-10-12 04:32:22', NULL),
(18, 23, 13, 'Ice Cream cup besar cokelat', 200, 50, 100, '2017-10-12 03:42:47', '2017-10-12 04:32:22', NULL),
(19, 27, 12, 'Ice Cream stik matcha', 3, 100, 100, '2017-10-12 03:43:29', '2017-10-13 14:32:18', NULL);

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
(21, 'stik', 4000, '2017-10-10 18:41:33', '2017-10-10 18:54:28', '2017-10-10 18:54:28'),
(22, 'cup kecil', 4000, '2017-10-10 18:56:07', '2017-10-11 00:11:41', NULL),
(23, 'cup besar', 5000, '2017-10-10 18:56:26', '2017-10-11 00:11:48', NULL),
(24, 'soft', 3000, '2017-10-11 00:12:36', '2017-10-12 01:20:51', '2017-10-12 01:20:51'),
(25, 'stik', 3000, '2017-10-11 15:32:52', '2017-10-12 01:20:57', '2017-10-12 01:20:57'),
(26, 'ember', 140000, '2017-10-11 16:08:59', '2017-10-12 01:20:46', '2017-10-12 01:20:46'),
(27, 'stik', 4000, '2017-10-12 03:13:16', '2017-10-12 03:13:16', NULL),
(28, 'aaaa', 333, '2017-10-14 12:58:39', '2017-10-14 12:58:39', NULL);

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
  `id` int(3) NOT NULL,
  `id_users` int(3) NOT NULL,
  `total` int(10) NOT NULL,
  `status` enum('menunggu','disetujui','ditolak','diterima','gagal','dibeli') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tgl_permintaan` timestamp NULL DEFAULT NULL,
  `tgl_pembelian` timestamp NULL DEFAULT NULL,
  `tgl_penerimaan` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `id_users`, `total`, `status`, `tgl`, `tgl_permintaan`, `tgl_pembelian`, `tgl_penerimaan`, `created_at`, `updated_at`) VALUES
(1, 5, 90000, 'diterima', '2017-10-04 10:56:00', '2017-10-15 11:26:56', '2017-10-15 11:26:56', '2017-10-15 11:26:56', '2017-10-15 11:26:56', '2017-10-15 11:52:48');

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
  `id` int(5) NOT NULL,
  `id_users` int(3) NOT NULL,
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

INSERT INTO `pemesanan` (`id`, `id_users`, `nama`, `alamat`, `telepon`, `tanggal`, `total`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, 5, 'dewi', 'sendowo', '122121', '2017-10-13', 40000, 'selesai', '2017-10-12 01:32:36', '2017-10-12 01:32:50', NULL),
(16, 5, 'nia', 'sendowo', '44444', '2017-10-19', 400000, 'selesai', '2017-10-12 03:16:52', '2017-10-12 03:17:18', NULL),
(17, 5, 'aaa', 'sendowo', '444', '2017-10-17', 45000, 'siap', '2017-10-12 03:45:33', '2017-10-12 03:49:12', NULL),
(18, 5, 'sss', 'sss', '333', '2017-10-19', 225000, 'siap', '2017-10-12 03:49:55', '2017-10-12 03:50:49', NULL),
(19, 5, 'aaa', 'aaa', '222', '2017-10-13', 900000, 'menunggu', '2017-10-12 04:29:19', '2017-10-12 04:29:19', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(5) NOT NULL,
  `id_users` int(3) NOT NULL,
  `tgl` date NOT NULL,
  `total` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `id_users`, `tgl`, `total`, `created_at`, `updated_at`) VALUES
(5, 5, '2017-10-03', 25000, '2017-10-12 01:31:10', '2017-10-12 01:31:10'),
(6, 5, '2017-09-14', 20000, '2017-10-12 01:31:23', '2017-10-12 01:31:23'),
(7, 5, '2017-08-08', 40000, '2017-10-12 01:31:47', '2017-10-12 01:31:47'),
(8, 5, '2017-06-12', 40000, '2017-10-12 01:32:06', '2017-10-12 01:32:06'),
(9, 5, '2017-07-04', 80000, '2017-10-12 01:35:50', '2017-10-12 01:36:27'),
(10, 5, '2017-10-12', 632000, '2017-10-12 03:16:18', '2017-10-13 14:34:25'),
(11, 7, '2017-10-12', 40000, '2017-10-12 03:31:37', '2017-10-12 03:31:37'),
(12, 5, '2017-10-13', 12000, '2017-10-13 14:13:15', '2017-10-13 14:13:15'),
(13, 7, '2017-10-13', 12000, '2017-10-13 14:27:18', '2017-10-13 14:27:18'),
(14, 5, '2017-10-15', 15000, '2017-10-15 11:27:56', '2017-10-15 11:27:57'),
(15, 5, '2017-10-15', 8000, '2017-10-15 11:28:09', '2017-10-15 11:28:09'),
(16, 5, '2017-10-05', 10000, '2017-10-15 12:28:02', '2017-10-15 12:28:27');

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
  `id` int(5) NOT NULL,
  `id_users` int(3) NOT NULL,
  `tgl` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id`, `id_users`, `tgl`, `created_at`, `updated_at`) VALUES
(11, 8, '2017-10-15', '2017-10-15 12:18:31', '2017-10-15 12:18:31');

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
(9, 'vanila', '2017-10-12 01:26:16', '2017-10-12 01:26:16', NULL),
(10, 'strawberry', '2017-10-12 01:27:15', '2017-10-12 01:27:15', NULL),
(11, 'pp', '2017-10-12 01:28:09', '2017-10-12 01:28:20', '2017-10-12 01:28:20'),
(12, 'matcha', '2017-10-12 03:14:20', '2017-10-12 03:14:20', NULL),
(13, 'cokelat', '2017-10-12 03:22:19', '2017-10-12 03:22:19', NULL);

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
(5, 'maulana rizki', 'manager', 'manager', '$2y$10$F55HzC19vIxMdhDpt.4ZeuYL37xAWZQAfAVbarwkzJMuA597BD3yG', 'suirqn8bDTJWW57IqjHxcoTCsngvfPLQvkhWD8RmwpusYJk2KN8R4Y9mgETM', '2017-06-20 04:21:13', '2017-10-11 23:35:06'),
(6, 'aaaaa', 'pengadaan', 'pengadaan', '$2y$10$5VIMZdfvp9uDRISqkIL6/O0TI.VY0v/5xYIALKSkU7/jjX1qx0PRm', 'km3MKYEKSgF4TV7OLI8Cqvx4yIoRCtJo6NJv0ZQEImLPrwOZJnHFpYE5QJ20', '2017-08-30 10:03:43', '2017-10-12 02:36:07'),
(7, 'baru', 'keuangan', 'keuangan', '$2y$10$yn0O9MHvhOW5TpZXJHRsoeOBAokFDuB/tYavYWS.mLjyRzTO.i4ly', 'PKd6XgqTdSOEjaoehYOU1n50sUEDVN5nFrFeclBhGzjLJah3fbBaKRqvZf1V', '2017-08-30 10:03:54', '2017-09-28 04:05:48'),
(8, 'wwww', 'produksi', 'produksi', '$2y$10$sFcpvgLAu3F07sKtr34EQ.l9fLtKLRAN7d/uHvzAy8aMiaSvNQDK.', '60ETMyR9E4LwX8KVczqIIH2tLDNls859Ujr6z3invqZineXhtlnzBD92ygeW', '2017-09-19 05:15:19', '2017-09-19 05:15:19'),
(9, 'kartika', 'pengadaan', 'produksi1', '$2y$10$80r8.9CrKmeS9mmvwLXSx.L7HXWcKNvNt21aRPbCzVeaFGCtEi6he', NULL, '2017-10-11 15:45:35', '2017-10-11 15:45:35'),
(10, 'putri', 'pengadaan', 'pppp', '$2y$10$8nRJ3wb/6P2ZFzZHfmtVS.G9B6eymMkYpyPUYrCOp4FFQbeIHMjyS', NULL, '2017-10-12 03:18:36', '2017-10-12 03:18:36');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_es` (`id_es`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_es` (`id_es`);

--
-- Indexes for table `detail_produksi`
--
ALTER TABLE `detail_produksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produksi` (`id_produksi`),
  ADD KEY `id_es` (`id_es`);

--
-- Indexes for table `detail_rasa`
--
ALTER TABLE `detail_rasa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rasa` (`id_rasa`),
  ADD KEY `id_bahan` (`id_bahan`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `detail_produksi`
--
ALTER TABLE `detail_produksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `detail_rasa`
--
ALTER TABLE `detail_rasa`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ice_cream`
--
ALTER TABLE `ice_cream`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `rasa`
--
ALTER TABLE `rasa`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
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
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id`),
  ADD CONSTRAINT `pembelianbahan` FOREIGN KEY (`id_bahan`) REFERENCES `bahan_baku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pemesanan_ibfk_2` FOREIGN KEY (`id_es`) REFERENCES `ice_cream` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`id_es`) REFERENCES `ice_cream` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_produksi`
--
ALTER TABLE `detail_produksi`
  ADD CONSTRAINT `detail_produksi_ibfk_1` FOREIGN KEY (`id_produksi`) REFERENCES `produksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_produksi_ibfk_2` FOREIGN KEY (`id_es`) REFERENCES `ice_cream` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_rasa`
--
ALTER TABLE `detail_rasa`
  ADD CONSTRAINT `detail_rasa_ibfk_1` FOREIGN KEY (`id_bahan`) REFERENCES `bahan_baku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_rasa_ibfk_2` FOREIGN KEY (`id_rasa`) REFERENCES `rasa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ice_cream`
--
ALTER TABLE `ice_cream`
  ADD CONSTRAINT `jenises` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `rasaes` FOREIGN KEY (`id_rasa`) REFERENCES `rasa` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD CONSTRAINT `produksi_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
