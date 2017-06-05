-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06 Jun 2017 pada 01.31
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bahan_baku`
--

INSERT INTO `bahan_baku` (`id`, `nama`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
(24, 'vanilla', 8000, 75, '2017-06-05 14:48:32', '2017-06-05 14:48:32');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(59, 18, 24, 5, 40000, '2017-06-05 14:54:36', '2017-06-05 14:54:36');

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `id_penjualan`, `id_es`, `jumlah`, `subtotal`, `created_at`, `updated_at`) VALUES
(5, '4', 92, 4, 16000, '2017-06-05 15:48:50', '2017-06-05 15:48:50');

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
  `id` int(20) NOT NULL,
  `id_produksi` int(20) NOT NULL,
  `id_es` int(5) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `jumlah_produksi` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ice_cream`
--

INSERT INTO `ice_cream` (`id`, `id_jenis`, `id_rasa`, `nama`, `harga`, `stok`, `jumlah_produksi`, `created_at`, `updated_at`) VALUES
(92, 38, 17, 'es fafafa', 4000, 86, 50, '2017-06-04 09:27:55', '2017-06-04 09:27:55');

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
(39, 'ember', '2017-06-02 14:28:42', '2017-06-02 14:28:42');

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
  `kode_pembelian` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(10) NOT NULL,
  `tgl` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `kode_pembelian`, `total`, `tgl`, `created_at`, `updated_at`) VALUES
(18, 'sada', 75000, '2017-06-14', '2017-06-05 14:54:36', '2017-06-05 14:54:36');

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
  `id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(10) NOT NULL,
  `kode_penjualan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `total` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `kode_penjualan`, `tgl`, `total`, `created_at`, `updated_at`) VALUES
(4, 'dada', '2017-05-29', 16000, '2017-06-05 15:48:50', '2017-06-05 15:48:50');

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
  `tgl` datetime NOT NULL,
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
(17, 'cokelat', '2017-06-02 01:55:43', '2017-06-02 01:55:43'),
(18, 'pisang', '2017-06-02 01:55:47', '2017-06-02 01:55:47'),
(19, 'vanilla', '2017-06-02 01:56:10', '2017-06-02 01:56:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'riska', 'riska@gmail.com', '$2y$10$dGd3oAbgIvbOFY6kLaogz.YBG/KbiWx8U4pBOn44fCq8nNKLXZKNa', 'DzxAW7eHPPOIaTWX4OCBOp8iDEmu3XXkj5f9NJPGJ1vgIfh0tJT8GO6E4ERV', '2017-05-14 22:27:46', '2017-05-14 22:27:46');

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
-- Indexes for table `detail_produksi`
--
ALTER TABLE `detail_produksi`
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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `detail_bahan`
--
ALTER TABLE `detail_bahan`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `detail_produksi`
--
ALTER TABLE `detail_produksi`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ice_cream`
--
ALTER TABLE `ice_cream`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rasa`
--
ALTER TABLE `rasa`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
