-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Mar 2025 pada 06.33
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengarsipan_surat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi`
--

CREATE TABLE `disposisi` (
  `no_disposisi` varchar(255) NOT NULL,
  `no_suratmasuk` varchar(255) NOT NULL,
  `tgl_diterima` date NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `tujuan_surat` varchar(255) NOT NULL,
  `kode_sifat` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `lampiran_pdf` varchar(255) DEFAULT NULL,
  `lampiran_gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kades`
--

CREATE TABLE `kades` (
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kades`
--

INSERT INTO `kades` (`nip`, `nama`, `tgl_lahir`, `jabatan`, `alamat`, `no_telp`, `id_users`, `created_at`, `updated_at`) VALUES
('00123', 'Kades', '1970-01-01', 'Kepala Desa', 'Yogyakarta', '09887876864', 3, '2025-03-03 23:35:05', '2025-03-03 23:35:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `klasifikasi_arsip`
--

CREATE TABLE `klasifikasi_arsip` (
  `kode_arsip` varchar(255) NOT NULL,
  `nama_arsip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `klasifikasi_arsip`
--

INSERT INTO `klasifikasi_arsip` (`kode_arsip`, `nama_arsip`, `created_at`, `updated_at`) VALUES
('000.1', 'Umum', '2025-03-08 22:07:51', '2025-03-08 22:07:51'),
('000.2', 'Organisasi dan Tatalaksana', '2025-03-08 22:08:06', '2025-03-08 22:08:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_28_055750_create_petugas_table', 1),
(5, '2025_02_28_055816_create_kades_table', 1),
(6, '2025_02_28_055929_create_klasifikasi_arsip_table', 1),
(7, '2025_02_28_055948_create_sifat_arsip_table', 1),
(8, '2025_02_28_060027_create_surat_masuk_table', 1),
(9, '2025_02_28_060034_create_surat_keluar_table', 1),
(10, '2025_02_28_060042_create_disposisi_table', 1),
(11, '2025_03_03_020629_add_lampiran_to_surat_masuk', 1),
(12, '2025_03_03_020752_add_lampiran_to_surat_keluar', 1),
(13, '2025_03_03_081939_add_lampiran_to_disposisi', 1),
(14, '2025_03_12_052138_add_profile_picture_to_users_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`nip`, `nama`, `tgl_lahir`, `jabatan`, `alamat`, `no_telp`, `id_users`, `created_at`, `updated_at`) VALUES
('0000.1', 'Petugas-1', '1990-01-01', 'Ketua Tata Laksana', 'Yogyakarta', '0988875672', 1, '2025-03-03 23:35:05', '2025-03-03 23:36:51'),
('00012', 'Petugas-2', '1980-01-01', 'Sekretaris Desa', 'Yogyakarta', '09887876864', 2, '2025-03-03 23:35:05', '2025-03-03 23:38:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sifat_arsip`
--

CREATE TABLE `sifat_arsip` (
  `kode_sifat` varchar(255) NOT NULL,
  `nama_sifat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sifat_arsip`
--

INSERT INTO `sifat_arsip` (`kode_sifat`, `nama_sifat`, `created_at`, `updated_at`) VALUES
('01', 'Segera', '2025-03-03 23:35:05', '2025-03-03 23:35:05'),
('02', 'Sangat Segera', '2025-03-03 23:35:05', '2025-03-03 23:35:05'),
('03', 'Rahasia', '2025-03-03 23:35:05', '2025-03-03 23:35:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `no_suratkeluar` varchar(255) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `kode_arsip` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `lampiran_pdf` varchar(255) DEFAULT NULL,
  `lampiran_gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_keluar`
--

INSERT INTO `surat_keluar` (`no_suratkeluar`, `tgl_surat`, `tujuan`, `perihal`, `kode_arsip`, `nip`, `lampiran_pdf`, `lampiran_gambar`, `created_at`, `updated_at`) VALUES
('UK-8ew985r', '2025-03-09', 'Kepala Desa', 'sandi negara', '000.2', '00012', NULL, 'lampiran/gambar/mooxqYlaEIojvBir4m6f8sfgYUiTCh1CtBV7JKBj.png', '2025-03-08 22:34:29', '2025-03-08 22:34:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `no_suratmasuk` varchar(255) NOT NULL,
  `asal_surat` varchar(255) NOT NULL,
  `tgl_surat` date NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `kode_arsip` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `lampiran_pdf` varchar(255) DEFAULT NULL,
  `lampiran_gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`no_suratmasuk`, `asal_surat`, `tgl_surat`, `perihal`, `kode_arsip`, `nip`, `lampiran_pdf`, `lampiran_gambar`, `created_at`, `updated_at`) VALUES
('ot238r', 'Tatalaksana', '2025-03-09', 'Pembangunan perpustakaan', '000.2', '0000.1', NULL, 'lampiran/gambar/cn53rKyuQswfV8VUh57S2O2MLR7avU6vn0lOsueV.png', '2025-03-08 22:08:54', '2025-03-08 22:08:54'),
('PsR-90ur2', 'Tatalaksana', '2025-02-13', 'sandi negara', '000.1', '00012', NULL, 'lampiran/gambar/3lxdGVSMNSDDalREir0ILAgxzB7iM5nmqUP5qIE4.png', '2025-03-08 22:28:17', '2025-03-08 22:28:17'),
('u-w43209u', 'Tatalaksana', '2024-12-09', 'Perkumpulan', '000.1', '00012', NULL, 'lampiran/gambar/RbolLvOeRr6pE2W00M58yKqy87m446rRW1DIIzU4.png', '2025-03-08 22:26:17', '2025-03-08 22:26:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level_user` enum('petugas','kades') NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level_user`, `profile_picture`, `created_at`, `updated_at`) VALUES
(1, 'Petugas 1', '$2y$12$0CLoXzh7JBOkuvxItrcHwO4TLjurB6LfmAGPEze0kCKz.FXb3ky6.', 'petugas', '', '2025-03-03 23:35:03', '2025-03-11 22:25:45'),
(2, 'Petguas 2', '$2y$12$vY1HL0RD1fvg9Ykm1T36oOrZ.wE5.SYYMThNi0BDxM..v9TDOYPTK', 'petugas', NULL, '2025-03-03 23:35:04', '2025-03-03 23:35:04'),
(3, 'Kades', '$2y$12$UBDeAobUAJ5WiRFYzgtis.Qq1gytZJhd50HJB81DyuAAh1ykGmzf2', 'kades', NULL, '2025-03-03 23:35:05', '2025-03-03 23:35:05');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`no_disposisi`),
  ADD KEY `disposisi_no_suratmasuk_foreign` (`no_suratmasuk`),
  ADD KEY `disposisi_nip_foreign` (`nip`),
  ADD KEY `disposisi_kode_sifat_foreign` (`kode_sifat`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kades`
--
ALTER TABLE `kades`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `kades_id_users_foreign` (`id_users`);

--
-- Indeks untuk tabel `klasifikasi_arsip`
--
ALTER TABLE `klasifikasi_arsip`
  ADD PRIMARY KEY (`kode_arsip`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `petugas_id_users_foreign` (`id_users`);

--
-- Indeks untuk tabel `sifat_arsip`
--
ALTER TABLE `sifat_arsip`
  ADD PRIMARY KEY (`kode_sifat`);

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`no_suratkeluar`),
  ADD KEY `surat_keluar_kode_arsip_foreign` (`kode_arsip`),
  ADD KEY `surat_keluar_nip_foreign` (`nip`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`no_suratmasuk`),
  ADD KEY `surat_masuk_kode_arsip_foreign` (`kode_arsip`),
  ADD KEY `surat_masuk_nip_foreign` (`nip`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  ADD CONSTRAINT `disposisi_kode_sifat_foreign` FOREIGN KEY (`kode_sifat`) REFERENCES `sifat_arsip` (`kode_sifat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disposisi_nip_foreign` FOREIGN KEY (`nip`) REFERENCES `petugas` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disposisi_no_suratmasuk_foreign` FOREIGN KEY (`no_suratmasuk`) REFERENCES `surat_masuk` (`no_suratmasuk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kades`
--
ALTER TABLE `kades`
  ADD CONSTRAINT `kades_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD CONSTRAINT `surat_keluar_kode_arsip_foreign` FOREIGN KEY (`kode_arsip`) REFERENCES `klasifikasi_arsip` (`kode_arsip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_keluar_nip_foreign` FOREIGN KEY (`nip`) REFERENCES `petugas` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `surat_masuk_kode_arsip_foreign` FOREIGN KEY (`kode_arsip`) REFERENCES `klasifikasi_arsip` (`kode_arsip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_masuk_nip_foreign` FOREIGN KEY (`nip`) REFERENCES `petugas` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
