-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04 Sep 2017 pada 07.31
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
(3, 'susu bubuk', 20000, 197.84, 'gr', 100, '2017-09-04 01:04:03', '2017-09-04 05:31:08'),
(4, 'garam', 3000, 0.4, 'ml', 20, '2017-09-04 01:04:53', '2017-09-04 05:31:08');

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
(9, 8, 4, 3, 9000, '2017-09-04 02:20:58', '2017-09-04 02:20:58'),
(10, 9, 4, 3, 9000, '2017-09-04 02:21:31', '2017-09-04 02:21:31'),
(11, 10, 4, 3, 9000, '2017-09-04 02:22:53', '2017-09-04 02:22:53'),
(12, 7, 4, 7, 21000, '2017-09-04 02:59:37', '2017-09-04 02:59:37'),
(13, 11, 4, 5, 15000, '2017-09-04 04:16:54', '2017-09-04 04:16:54');

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
  `id_pemesanan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_es` int(5) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `subtotal` int(10) NOT NULL,
  `status` enum('menunggu','siap') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id`, `id_pemesanan`, `id_es`, `jumlah`, `subtotal`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, '7', 2, 4, 12000, 'menunggu', '2017-09-04 05:09:46', '2017-09-04 05:09:46', NULL),
(14, '7', 2, 8, 24000, 'siap', '2017-09-04 05:10:50', '2017-09-04 05:22:55', NULL),
(15, '8', 1, 9, 36000, 'siap', '2017-09-04 05:20:54', '2017-09-04 05:21:10', NULL);

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
(3, '1', 1, 17, 68000, '2017-09-04 03:04:48', '2017-09-04 03:04:48'),
(4, '2', 1, 7, 28000, '2017-09-04 03:05:24', '2017-09-04 03:05:24'),
(5, '3', 1, 4, 16000, '2017-09-04 03:49:42', '2017-09-04 03:49:42'),
(6, '4', 1, 10, 40000, '2017-09-04 03:54:43', '2017-09-04 03:54:43'),
(7, '5', 2, 500, 1500000, '2017-09-04 03:55:57', '2017-09-04 03:55:57'),
(8, '6', 1, 5, 20000, '2017-09-04 04:06:56', '2017-09-04 04:06:56'),
(9, '7', 2, 6, 18000, '2017-09-04 04:09:09', '2017-09-04 04:09:09'),
(10, '8', 1, 5, 20000, '2017-09-04 04:09:49', '2017-09-04 04:09:49');

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
(1, 1, 2, 5, '2017-09-04 05:24:34', '2017-09-04 05:24:34'),
(2, 1, 1, 4, '2017-09-04 05:24:34', '2017-09-04 05:24:34'),
(3, 2, 1, 0, '2017-09-04 05:25:42', '2017-09-04 05:25:42'),
(4, 2, 2, 0, '2017-09-04 05:25:42', '2017-09-04 05:25:42'),
(5, 3, 2, 0, '2017-09-04 05:31:08', '2017-09-04 05:31:08'),
(6, 3, 1, 9, '2017-09-04 05:31:08', '2017-09-04 05:31:08');

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
(1, 2, 3, 6, '2017-09-04 01:40:24', '2017-09-04 01:40:24'),
(2, 2, 4, 110, '2017-09-04 01:40:24', '2017-09-04 01:40:24');

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
(1, 15, 2, 'Ice Cream cup kecill vanilla', 23, 50, '2017-09-04 01:40:24', '2017-09-04 05:31:08', NULL),
(2, 14, 2, 'Ice Cream stik vanilla', 19499, 50, '2017-09-04 01:40:24', '2017-09-04 05:24:34', NULL);

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
(14, 'stik', 3000, '2017-09-04 00:59:59', '2017-09-04 01:01:16', NULL),
(15, 'cup kecill', 4000, '2017-09-04 01:00:15', '2017-09-04 01:00:15', NULL),
(16, 'cup besar', 5000, '2017-09-04 01:00:59', '2017-09-04 01:00:59', NULL),
(17, 'nnn', 4, '2017-09-04 01:29:52', '2017-09-04 01:29:55', '2017-09-04 01:29:55');

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
  `status` enum('menunggu','disetujui','ditolak','diterima','gagal','dibeli') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `id_users`, `kode_pembelian`, `total`, `status`, `tgl`, `created_at`, `updated_at`) VALUES
(7, 5, 'BL/2017-9-6/7', 21000, 'diterima', '2017-09-06', '2017-09-04 02:15:50', '2017-09-04 02:59:36'),
(8, 8, 'BL/2017-9-15/8', 9000, 'ditolak', '2017-09-15', '2017-09-04 02:20:57', '2017-09-04 02:21:17'),
(9, 8, 'BL/2017-9-16/9', 9000, 'gagal', '2017-09-16', '2017-09-04 02:21:31', '2017-09-04 02:22:15'),
(10, 5, 'BL/2017-9-8/10', 9000, 'diterima', '2017-09-08', '2017-09-04 02:22:53', '2017-09-04 02:22:53'),
(11, 8, 'BL/2017-8-16/11', 15000, 'menunggu', '2017-08-16', '2017-09-04 04:16:54', '2017-09-04 04:16:54');

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
(7, 5, 'PSN/2017-9-7/7', 'fsdfs', 'sfsfs', '44', '2017-09-07', 24000, 'menunggu', '2017-09-04 05:09:45', '2017-09-04 05:10:50', NULL),
(8, 5, 'PSN/2017-9-20/8', 'sdsad', 'asda', '4545', '2017-09-20', 36000, 'siap', '2017-09-04 05:20:54', '2017-09-04 05:21:10', NULL);

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
(1, 9, 'JL/2017-9-1/1', '2017-09-01', 68000, '2017-09-04 03:00:22', '2017-09-04 03:04:48'),
(2, 9, 'JL/2017-9-14/2', '2017-09-14', 28000, '2017-09-04 03:05:24', '2017-09-04 03:05:24'),
(3, 5, 'JL/2017-9-20/3', '2017-09-20', 16000, '2017-09-04 03:49:42', '2017-09-04 03:49:42'),
(4, 5, 'JL/2017-9-4/4', '2017-09-04', 40000, '2017-09-04 03:54:43', '2017-09-04 03:54:43'),
(5, 5, 'JL/2017-9-3/5', '2017-09-03', 1500000, '2017-09-04 03:55:56', '2017-09-04 03:55:57'),
(6, 5, 'JL/2018-4-24/6', '2018-04-24', 20000, '2017-09-04 04:06:56', '2017-09-04 04:06:56'),
(7, 5, 'JL/2017-7-10/7', '2017-07-10', 18000, '2017-09-04 04:09:08', '2017-09-04 04:09:08'),
(8, 5, 'JL/2017-2-23/8', '2017-02-23', 20000, '2017-09-04 04:09:49', '2017-09-04 04:09:49');

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
(1, 5, 'PRO/2017-9-14/1', '2017-09-14', '2017-09-04 05:24:33', '2017-09-04 05:24:33'),
(2, 10, 'PRO/2017-9-1/2', '2017-09-01', '2017-09-04 05:25:42', '2017-09-04 05:25:42'),
(3, 10, 'PRO/2017-9-6/3', '2017-09-06', '2017-09-04 05:31:07', '2017-09-04 05:31:07');

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
(2, 'vanilla', '2017-09-04 01:40:23', '2017-09-04 01:40:23', NULL);

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
(5, 'maulana rizki s', 'manager', 'manager', '$2y$10$yn0O9MHvhOW5TpZXJHRsoeOBAokFDuB/tYavYWS.mLjyRzTO.i4ly', 'hfdRRcg3jJHW07kuyjGiuij9xDB5BlKVIxftGaPC2xk13lWD6FEYhRO7dXGd', '2017-06-20 04:21:13', '2017-09-04 03:14:49'),
(8, 'riska kurnia dewi', 'pengadaan', 'pengadaan', '$2y$10$SjVXFiVt3v6ntCBxmGX3uuJH5JmruTLKNZWShEEQakvyc4yznPmy6', '6KRnripABBYD8HfvqT3GZOKWYhH7VZrkVQ6xIop3YSFdK1AOqwhRE450vPRR', '2017-09-04 00:57:26', '2017-09-04 03:15:08'),
(9, 'Dewi Kurnia', 'keuangan', 'keuangan', '$2y$10$GH62flhlbj7cpa7X8mlTE.J0nPAifql2XwsEKVz8kL7AqKUvuqb6y', 'd0ro2rrwrePW3tSMZnYUocGWURKJNly9604k1xvNnETM5HifuEiCYjNA7Da1', '2017-09-04 00:58:04', '2017-09-04 03:15:00'),
(10, 'putri', 'produksi', 'produksi', '$2y$10$dtbq2j0X/0MFLoy9lK1Sl.uYxSA477bcmMBI31O16o5DGNAglLMcm', NULL, '2017-09-04 00:58:23', '2017-09-04 00:58:23');

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `detail_produksi`
--
ALTER TABLE `detail_produksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `detail_rasa`
--
ALTER TABLE `detail_rasa`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ice_cream`
--
ALTER TABLE `ice_cream`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rasa`
--
ALTER TABLE `rasa`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
