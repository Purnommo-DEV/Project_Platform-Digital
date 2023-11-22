-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Nov 2023 pada 05.13
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_paltform_digital`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE `provinsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `provinsi`
--

INSERT INTO `provinsi` (`id`, `provinsi`, `created_at`, `updated_at`) VALUES
(1, 'Bali', '2023-08-21 20:06:19', '2023-08-21 20:06:19'),
(2, 'Bangka Belitung', '2023-08-21 20:06:20', '2023-08-21 20:06:20'),
(3, 'Banten', '2023-08-21 20:06:21', '2023-08-21 20:06:21'),
(4, 'Bengkulu', '2023-08-21 20:06:22', '2023-08-21 20:06:22'),
(5, 'DI Yogyakarta', '2023-08-21 20:06:23', '2023-08-21 20:06:23'),
(6, 'DKI Jakarta', '2023-08-21 20:06:24', '2023-08-21 20:06:24'),
(7, 'Gorontalo', '2023-08-21 20:06:26', '2023-08-21 20:06:26'),
(8, 'Jambi', '2023-08-21 20:06:27', '2023-08-21 20:06:27'),
(9, 'Jawa Barat', '2023-08-21 20:06:28', '2023-08-21 20:06:28'),
(10, 'Jawa Tengah', '2023-08-21 20:06:29', '2023-08-21 20:06:29'),
(11, 'Jawa Timur', '2023-08-21 20:06:30', '2023-08-21 20:06:30'),
(12, 'Kalimantan Barat', '2023-08-21 20:06:32', '2023-08-21 20:06:32'),
(13, 'Kalimantan Selatan', '2023-08-21 20:06:33', '2023-08-21 20:06:33'),
(14, 'Kalimantan Tengah', '2023-08-21 20:06:34', '2023-08-21 20:06:34'),
(15, 'Kalimantan Timur', '2023-08-21 20:06:35', '2023-08-21 20:06:35'),
(16, 'Kalimantan Utara', '2023-08-21 20:06:36', '2023-08-21 20:06:36'),
(17, 'Kepulauan Riau', '2023-08-21 20:06:38', '2023-08-21 20:06:38'),
(18, 'Lampung', '2023-08-21 20:06:39', '2023-08-21 20:06:39'),
(19, 'Maluku', '2023-08-21 20:06:40', '2023-08-21 20:06:40'),
(20, 'Maluku Utara', '2023-08-21 20:06:41', '2023-08-21 20:06:41'),
(21, 'Nanggroe Aceh Darussalam (NAD)', '2023-08-21 20:06:42', '2023-08-21 20:06:42'),
(22, 'Nusa Tenggara Barat (NTB)', '2023-08-21 20:06:44', '2023-08-21 20:06:44'),
(23, 'Nusa Tenggara Timur (NTT)', '2023-08-21 20:06:45', '2023-08-21 20:06:45'),
(24, 'Papua', '2023-08-21 20:06:47', '2023-08-21 20:06:47'),
(25, 'Papua Barat', '2023-08-21 20:06:48', '2023-08-21 20:06:48'),
(26, 'Riau', '2023-08-21 20:06:49', '2023-08-21 20:06:49'),
(27, 'Sulawesi Barat', '2023-08-21 20:06:50', '2023-08-21 20:06:50'),
(28, 'Sulawesi Selatan', '2023-08-21 20:06:51', '2023-08-21 20:06:51'),
(29, 'Sulawesi Tengah', '2023-08-21 20:06:53', '2023-08-21 20:06:53'),
(30, 'Sulawesi Tenggara', '2023-08-21 20:06:54', '2023-08-21 20:06:54'),
(31, 'Sulawesi Utara', '2023-08-21 20:06:55', '2023-08-21 20:06:55'),
(32, 'Sumatera Barat', '2023-08-21 20:06:56', '2023-08-21 20:06:56'),
(33, 'Sumatera Selatan', '2023-08-21 20:06:57', '2023-08-21 20:06:57'),
(34, 'Sumatera Utara', '2023-08-21 20:06:58', '2023-08-21 20:06:58');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
