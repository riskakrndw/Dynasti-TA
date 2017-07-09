-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09 Jul 2017 pada 11.17
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dynasti`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id` int(5) NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(10) NOT NULL,
  `stok` int(10) NOT NULL,
  `satuan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bahan_baku`
--

INSERT INTO `bahan_baku` (`id`, `nama`, `harga`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES
(28, 'es batu', 8000, 32136, 'unita', '2017-06-09 08:12:26', '2017-06-20 05:47:15'),
(29, 'adada', 3000, 3044, 'aada', '2017-06-12 05:31:33', '2017-06-12 05:31:33'),
(30, 'sasasfa', 454545, 57, 'fafa', '2017-06-19 13:30:22', '2017-06-19 13:30:22'),
(31, 'adsada', 5455454, 58, 'dadaa', '2017-06-19 13:32:18', '2017-06-19 13:32:18'),
(32, 'afasfafa', 45454, 53, 'afasfa', '2017-06-19 13:32:27', '2017-06-19 13:32:27'),
(33, 'garam', 800, 65, 'gr', '2017-06-28 09:48:06', '2017-06-28 09:48:18');

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
-- Struktur dari tabel `detail_bahan`
--

CREATE TABLE `detail_bahan` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_bahan` int(5) NOT NULL,
  `id_es` int(5) NOT NULL,
  `takaran` double NOT NULL,
  `satuan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_bahan`
--

INSERT INTO `detail_bahan` (`id`, `id_bahan`, `id_es`, `takaran`, `satuan`, `created_at`, `updated_at`) VALUES
(34, 33, 170, 4, 'gr', '2017-06-28 10:40:37', '2017-06-28 10:40:37'),
(35, 29, 170, 5, 'aada', '2017-06-28 10:40:37', '2017-06-28 10:40:37'),
(39, 30, 193, 5, 'fafa', '2017-07-08 08:53:54', '2017-07-08 08:53:54'),
(40, 28, 193, 10, 'unita', '2017-07-08 08:53:55', '2017-07-08 08:53:55');

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
(11, 2, 29, 4, 12000, '2017-06-29 02:35:43', '2017-06-29 02:35:43'),
(12, 2, 30, 3, 1363635, '2017-06-29 02:35:44', '2017-06-29 02:35:44'),
(13, 2, 32, 5, 227270, '2017-06-29 02:35:44', '2017-06-29 02:35:44'),
(14, 2, 33, 5, 4000, '2017-06-29 02:35:44', '2017-06-29 02:35:44'),
(16, 4, 29, 3, 9000, '2017-07-02 09:16:54', '2017-07-02 09:16:54'),
(17, 5, 32, 3, 136362, '2017-07-02 09:45:15', '2017-07-02 09:45:15'),
(19, 6, 28, 4, 32000, '2017-07-05 21:50:59', '2017-07-05 21:50:59'),
(20, 6, 31, 4, 21821816, '2017-07-05 21:51:00', '2017-07-05 21:51:00'),
(21, 7, 30, 5, 2272725, '2017-07-05 22:08:41', '2017-07-05 22:08:41'),
(22, 8, 28, 5, 40000, '2017-07-05 23:07:00', '2017-07-05 23:07:00'),
(23, 9, 28, 8000, 4, '2017-07-06 02:39:30', '2017-07-06 02:39:30'),
(24, 9, 29, 3000, 4, '2017-07-06 02:39:30', '2017-07-06 02:39:30'),
(25, 3, 28, 8000, 9, '2017-07-06 02:44:34', '2017-07-06 02:44:34'),
(26, 10, 28, 8000, 4, '2017-07-06 02:47:54', '2017-07-06 02:47:54'),
(27, 11, 28, 8000, 10, '2017-07-06 02:49:45', '2017-07-06 02:49:45'),
(28, 12, 29, 4, 12000, '2017-07-06 02:50:56', '2017-07-06 02:50:56'),
(29, 12, 28, 4, 32000, '2017-07-06 02:50:56', '2017-07-06 02:50:56'),
(30, 13, 28, 4, 32000, '2017-07-06 02:51:27', '2017-07-06 02:51:27'),
(31, 14, 28, 5, 40000, '2017-07-06 02:54:02', '2017-07-06 02:54:02'),
(32, 15, 28, 4, 32000, '2017-07-06 04:28:08', '2017-07-06 04:28:08'),
(34, 16, 28, 8, 64000, '2017-07-06 05:03:30', '2017-07-06 05:03:30'),
(36, 17, 28, 4, 32000, '2017-07-06 21:01:09', '2017-07-06 21:01:09'),
(37, 17, 30, 4, 1818180, '2017-07-06 21:01:09', '2017-07-06 21:01:09'),
(38, 18, 28, 4, 32000, '2017-07-07 03:00:11', '2017-07-07 03:00:11'),
(39, 19, 28, 4, 32000, '2017-07-07 03:46:17', '2017-07-07 03:46:17');

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
-- Struktur dari tabel `ice_cream`
--

CREATE TABLE `ice_cream` (
  `id` int(5) NOT NULL,
  `id_jenis` int(3) DEFAULT NULL,
  `id_rasa` int(3) DEFAULT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(10) NOT NULL,
  `stok` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ice_cream`
--

INSERT INTO `ice_cream` (`id`, `id_jenis`, `id_rasa`, `nama`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
(170, 40, 18, 'Ice Cream cup kecil pisang', 9000, 54, '2017-06-28 10:40:13', '2017-06-28 10:40:13'),
(193, 40, 18, 'Ice Cream cup kecil pisang', 54, 5, '2017-07-08 02:45:58', '2017-07-08 08:53:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id` int(3) NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(38, 'stik', '2017-06-02 14:28:36', '2017-06-02 14:28:36'),
(40, 'cup kecil', '2017-06-28 09:19:49', '2017-06-28 09:20:05');

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
  `tgl` datetime NOT NULL,
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
(17, 'cokelat', '2017-06-02 01:55:43', '2017-06-28 09:44:37'),
(18, 'pisang', '2017-06-02 01:55:47', '2017-06-02 01:55:47'),
(19, 'vanilla', '2017-06-02 01:56:10', '2017-06-02 01:56:10'),
(20, 'strawberry', '2017-06-28 09:21:11', '2017-06-28 09:21:11'),
(21, 'baru', '2017-06-28 09:44:26', '2017-06-28 09:44:26');

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
-- Indexes for table `detail_bahan`
--
ALTER TABLE `detail_bahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_es` (`id_es`);

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `detail_bahan`
--
ALTER TABLE `detail_bahan`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
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
-- AUTO_INCREMENT for table `ice_cream`
--
ALTER TABLE `ice_cream`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;
--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
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
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_bahan`
--
ALTER TABLE `detail_bahan`
  ADD CONSTRAINT `bahanes` FOREIGN KEY (`id_es`) REFERENCES `ice_cream` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
