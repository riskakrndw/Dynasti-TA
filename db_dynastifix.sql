-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19 Sep 2017 pada 07.45
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
(1, 'susu bubuk', 6000, 1.3299999237060547, 'ml', 50, '2017-08-30 10:06:36', '2017-09-19 05:17:20'),
(2, 'air', 9000, 85, 'ml', 10, '2017-08-30 11:23:06', '2017-08-30 11:27:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_pembelian` int(5) NOT NULL,
  `id_bahan` int(3) NOT NULL,
  `jumlah` int(7) NOT NULL,
  `subtotal` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `id_pembelian`, `id_bahan`, `jumlah`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, 24000, '2017-08-30 10:07:20', '2017-08-30 10:07:20'),
(2, 2, 1, 6, 36000, '2017-08-30 10:14:09', '2017-08-30 10:14:09'),
(3, 3, 1, 10, 60000, '2017-08-30 10:17:34', '2017-08-30 10:17:34'),
(4, 4, 1, 10, 60000, '2017-08-30 10:19:02', '2017-08-30 10:19:02'),
(5, 5, 2, 5, 45000, '2017-08-30 11:26:43', '2017-08-30 11:26:43');

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
(1, 1, 1, 8, 24000, 'siap', '2017-09-02 17:28:00', '2017-09-02 17:29:09', NULL);

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
(1, 3, 1, 1, '2017-08-30 12:03:29', '2017-08-30 12:03:29'),
(2, 4, 2, 0, '2017-08-30 12:12:25', '2017-08-30 12:12:25'),
(3, 4, 1, 1, '2017-08-30 12:12:25', '2017-08-30 12:12:25'),
(4, 5, 1, 30, '2017-09-02 17:29:00', '2017-09-02 17:29:00'),
(5, 5, 2, 22, '2017-09-02 17:29:00', '2017-09-02 17:29:00'),
(6, 6, 2, 0, '2017-09-19 05:16:51', '2017-09-19 05:16:51'),
(7, 6, 1, 7, '2017-09-19 05:16:51', '2017-09-19 05:16:51'),
(8, 7, 2, 0, '2017-09-19 05:17:20', '2017-09-19 05:17:20'),
(9, 7, 1, 4, '2017-09-19 05:17:20', '2017-09-19 05:17:20');

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
(1, 1, 1, 8, '2017-08-30 10:07:03', '2017-08-30 10:07:03');

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
(1, 11, 1, 'Ice Cream stik aaaa', 42, 30, 4, '2017-08-30 10:07:03', '2017-09-19 05:17:20', NULL),
(2, 12, 1, 'Ice Cream cup aaaa', 22, 50, 3, '2017-08-30 12:11:58', '2017-09-19 05:12:04', NULL);

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
(11, 'stik', 3000, '2017-08-30 01:26:54', '2017-08-30 01:26:54', NULL),
(12, 'cup', 2000, '2017-08-30 12:04:23', '2017-08-30 12:04:23', NULL),
(13, 'ember', 40000, '2017-08-30 12:04:31', '2017-08-30 12:04:31', NULL);

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
  `id` int(5) NOT NULL,
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
(1, 6, 'BL/2017-8-4/1', 24000, 'menunggu', '2017-08-04', '2017-08-30 10:07:20', '2017-08-30 10:12:14'),
(2, 6, 'BL/2017-8-11/2', 36000, 'menunggu', '2017-08-11', '2017-08-30 10:14:09', '2017-08-30 11:25:20'),
(3, 6, 'BL/2017-8-3/3', 60000, 'menunggu', '2017-08-03', '2017-08-30 10:17:33', '2017-08-30 11:25:30'),
(4, 6, 'BL/2017-8-4/4', 60000, 'gagal', '2017-08-04', '2017-08-30 10:19:02', '2017-08-30 11:27:13'),
(5, 6, 'BL/2017-8-16/5', 45000, 'gagal', '2017-08-16', '2017-08-30 11:26:43', '2017-08-30 11:27:17');

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
(1, 5, 'PSN/2017-8-31/1', 'hh', 'hhhh', '888', '2017-08-31', 24000, 'selesai', '2017-09-02 17:28:00', '2017-09-19 05:24:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(5) NOT NULL,
  `id_users` int(3) NOT NULL,
  `kode_penjualan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `total` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `kode_produksi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id`, `id_users`, `kode_produksi`, `tgl`, `created_at`, `updated_at`) VALUES
(3, 5, 'PRO/2017-8-2/3', '2017-08-02', '2017-08-30 12:03:28', '2017-08-30 12:03:28'),
(4, 5, 'PRO/2017-8-2/4', '2017-08-02', '2017-08-30 12:12:24', '2017-08-30 12:12:24'),
(5, 5, 'PRO/2017-9-13/5', '2017-09-13', '2017-09-02 17:29:00', '2017-09-02 17:29:00'),
(6, 8, 'PRO/2017-9-13/6', '2017-09-13', '2017-09-19 05:16:50', '2017-09-19 05:16:50'),
(7, 8, 'PRO/2017-9-19/7', '2017-09-19', '2017-09-19 05:17:20', '2017-09-19 05:17:20');

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
(1, 'aaaa', '2017-08-30 10:07:03', '2017-08-30 12:06:40', NULL);

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
(5, 'maulana rizki', 'manager', 'manager', '$2y$10$yn0O9MHvhOW5TpZXJHRsoeOBAokFDuB/tYavYWS.mLjyRzTO.i4ly', 'ycpAL1V97mt7mQOlmnRInkmhlAF7oiqm5WHZKa2IBRvDlqcGMQxVhXmMUtR2', '2017-06-20 04:21:13', '2017-06-21 22:59:23'),
(6, 'aaaaa', 'pengadaan', 'pengadaan', '$2y$10$IMIp3i9ZT4XFJcUaPAgCTeGdrZ4QdJ2phrGRgK0fuuHmLpIb7zA2K', 'Eyl5a8lqJ66orjpVdtotj8T2sO3hidB37Q8jNp4BlRZQy23nio3mueaDxARP', '2017-08-30 10:03:43', '2017-08-30 10:03:43'),
(7, 'wwwww', 'keuangan', 'keuangan', '$2y$10$nA1WxzlMZXfj4huR4vCrFurX1hgx0.y4BimXqUZNg6f6M2k2TMKYG', '0fiSKAhZcwj7D5JOy0q9fcLZ69Uwme8Rq7HhKnQhZyB8P2XWfXdcUgSO2N6e', '2017-08-30 10:03:54', '2017-08-30 10:03:54'),
(8, 'wwww', 'produksi', 'produksi', '$2y$10$sFcpvgLAu3F07sKtr34EQ.l9fLtKLRAN7d/uHvzAy8aMiaSvNQDK.', 'ZhI5tVtEwA1xiplSA8QuLPvCdwIz1wN2bU2I4AA7Io422Pplbi1WRI9iu21l', '2017-09-19 05:15:19', '2017-09-19 05:15:19');

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
  ADD UNIQUE KEY `id_es` (`id_es`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_produksi`
--
ALTER TABLE `detail_produksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `detail_rasa`
--
ALTER TABLE `detail_rasa`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ice_cream`
--
ALTER TABLE `ice_cream`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `rasa`
--
ALTER TABLE `rasa`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
