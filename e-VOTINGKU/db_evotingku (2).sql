-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jul 2025 pada 06.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_evotingku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon`
--

CREATE TABLE `calon` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `suara` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `calon`
--

INSERT INTO `calon` (`id`, `nama`, `visi`, `misi`, `foto`, `suara`) VALUES
(2, 'yo', 'yoyo', NULL, NULL, 2),
(3, 'iyan', 'damai', NULL, NULL, 1),
(4, 'anis', 'juara', NULL, NULL, 3),
(5, 'prabowo', 'makan gratis', NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilih`
--

CREATE TABLE `pemilih` (
  `id` int(11) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `sudah_memilih` tinyint(1) DEFAULT 0,
  `nisn` varchar(20) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemilih`
--

INSERT INTO `pemilih` (`id`, `nik`, `nama`, `sudah_memilih`, `nisn`, `status`, `id_user`) VALUES
(2, NULL, 'asep', 1, '0085562782', 'nganggur', 3),
(4, NULL, 'Janjan', 1, '008787372', 'pengangguran', 5),
(5, NULL, 'Sandra', 1, '0877566777', 'PT(Pengangguran Tetap)', 4),
(6, NULL, 'Epul', 1, '1234562121', 'Duda', 6),
(7, NULL, 'Rival', 1, '1234565323', 'Guru', 8),
(8, NULL, 'rey', 1, '1234567890', 'Pelajar', 9),
(9, NULL, 'dika', 1, '123456331', 'Ketua', 10),
(10, NULL, 'Andika Sulaiman madu', 1, '0887235642', 'Aktif', 12),
(11, NULL, 'Reyrivan Sambas', 1, '1156273637', 'pelajar', 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilihan`
--

CREATE TABLE `pemilihan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_calon` int(11) NOT NULL,
  `waktu_pilih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suara`
--

CREATE TABLE `suara` (
  `id` int(11) NOT NULL,
  `id_pemilih` int(11) DEFAULT NULL,
  `id_calon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('admin','pemilih') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, '123', '123', 'admin'),
(3, '1234', '1234', 'pemilih'),
(4, '111', '111', 'pemilih'),
(5, '121', '121', 'pemilih'),
(6, '55', '55', 'pemilih'),
(8, '41', '41', 'pemilih'),
(9, 'rey', 'rey', 'pemilih'),
(10, 'dika', 'dika', 'pemilih'),
(11, 'admin', 'admin', 'admin'),
(12, '0887235642', '0887235642', 'pemilih'),
(13, '1156273637', '1156273637', 'pemilih');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemilihan`
--
ALTER TABLE `pemilihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_calon` (`id_calon`);

--
-- Indeks untuk tabel `suara`
--
ALTER TABLE `suara`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemilih` (`id_pemilih`),
  ADD KEY `id_calon` (`id_calon`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `calon`
--
ALTER TABLE `calon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pemilih`
--
ALTER TABLE `pemilih`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pemilihan`
--
ALTER TABLE `pemilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `suara`
--
ALTER TABLE `suara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemilihan`
--
ALTER TABLE `pemilihan`
  ADD CONSTRAINT `pemilihan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemilihan_ibfk_2` FOREIGN KEY (`id_calon`) REFERENCES `calon` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `suara`
--
ALTER TABLE `suara`
  ADD CONSTRAINT `suara_ibfk_1` FOREIGN KEY (`id_pemilih`) REFERENCES `pemilih` (`id`),
  ADD CONSTRAINT `suara_ibfk_2` FOREIGN KEY (`id_calon`) REFERENCES `calon` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
