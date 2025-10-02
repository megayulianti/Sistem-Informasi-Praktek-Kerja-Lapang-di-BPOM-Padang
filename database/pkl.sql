-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2025 pada 06.13
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
-- Database: `pkl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpha') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_mahasiswa`, `nama_lengkap`, `nim`, `tanggal`, `jam`, `status`) VALUES
(1, 2, 'ary', '35345', '2025-05-22', '14:07:45', 'Hadir'),
(2, 2, 'ary', '22', '2024-05-01', '12:09:02', 'Izin'),
(5, 2, 'ary', '234356', '2025-05-26', '11:25:17', 'Sakit'),
(6, 2, 'ary', '234356', '2025-06-24', '08:19:13', 'Hadir'),
(8, 2, 'ary', '234356', '2025-06-25', '23:26:55', 'Izin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `gmail` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `kampus` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama_lengkap`, `nim`, `gmail`, `password`, `foto`, `alamat`, `jenis_kelamin`, `no_hp`, `kampus`, `jurusan`) VALUES
(2, 'ary', '234356', 'ar@gmail.com', '$2y$10$miRH8mPgjl8GHtZLtE6HWO1HOodVXv8wqRqDDTh9ye9.vmW1tm1N.', 'argmailcom_1748507334.png', 'padang', 'Perempuan', '087675', 'Universitas Metamedia', 'Sistem Informasi'),
(3, 'resti', '2132434', 'resti@gmail.com', '$2y$10$xRR1VHEUKrZJTVxsVYf/yueOIG5j4YQVa7OgygzW6dBfUEZ15a2.q', 'logo pantoefol.png', 'padang', 'Perempuan', '0876755', 'Universitas Metamedia', 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilihan_bagian_tempat`
--

CREATE TABLE `pemilihan_bagian_tempat` (
  `id_bagian` int(11) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `nama_pkl` varchar(100) NOT NULL,
  `bidang_bagian` enum('bidang pengujian','bidang pemeriksaan','bidang penindakan','bidang infonkom','bidang tata usaha') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemilihan_bagian_tempat`
--

INSERT INTO `pemilihan_bagian_tempat` (`id_bagian`, `id_mahasiswa`, `nama_pkl`, `bidang_bagian`) VALUES
(2, 2, 'yani', 'bidang pemeriksaan'),
(3, 3, 'mira', 'bidang pengujian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran_magang`
--

CREATE TABLE `pendaftaran_magang` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `tempat_magang` varchar(255) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `surat_pkl` varchar(255) DEFAULT NULL,
  `status` enum('pending','disetujui','ditolak') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pendaftaran_magang`
--

INSERT INTO `pendaftaran_magang` (`id`, `id_mahasiswa`, `tempat_magang`, `tanggal_mulai`, `tanggal_selesai`, `surat_pkl`, `status`, `created_at`) VALUES
(9, 2, 'padangg', '2025-06-09', '2025-07-19', 'surat_6864977a61fce.pdf', 'disetujui', '2025-07-02 02:20:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `tanggal_pelaksanaan` date DEFAULT NULL,
  `nama_supervisor` varchar(100) DEFAULT NULL,
  `jabatan_supervisor` varchar(100) DEFAULT NULL,
  `aspek` text DEFAULT NULL,
  `total_skor` int(11) DEFAULT NULL,
  `nilai_supervisor` float DEFAULT NULL,
  `tanggal` date DEFAULT curdate(),
  `file_surat_nilai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id`, `id_mahasiswa`, `tanggal_pelaksanaan`, `nama_supervisor`, `jabatan_supervisor`, `aspek`, `total_skor`, `nilai_supervisor`, `tanggal`, `file_surat_nilai`) VALUES
(4, 3, '2025-06-27', 'abdul', 'menager', 'Kedisiplinan: 60\nKejujuran: 75\nKemampuan bersosialisasi: 75\nKomunikasi (lisan & tulisan): 75\nKemampuan manajerial: 75\nKerjasama dalam tim: 75\nAplikasi ilmu komputer: 75\nIlmu penunjang: 75\nKualitas hasil kerja: 75\nMotivasi mempelajari hal baru: 75\n', 735, 73.5, '2025-06-27', 'surat_nilai_1751035404.pdf'),
(5, 2, '2025-07-02', 'arya,skom', 'manager', 'Kedisiplinan: 50\nKejujuran: 50\nKemampuan bersosialisasi: 90\nKomunikasi (lisan & tulisan): 90\nKemampuan manajerial: 90\nKerjasama dalam tim: 90\nAplikasi ilmu komputer: 90\nIlmu penunjang: 90\nKualitas hasil kerja: 90\nMotivasi mempelajari hal baru: 90\n', 820, 82, '2025-07-02', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikat_pkl`
--

CREATE TABLE `sertifikat_pkl` (
  `id_sertifikat` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `nama_supervisor` varchar(100) NOT NULL,
  `file_sertifikat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sertifikat_pkl`
--

INSERT INTO `sertifikat_pkl` (`id_sertifikat`, `id_mahasiswa`, `tanggal_mulai`, `tanggal_berakhir`, `nama_supervisor`, `file_sertifikat`) VALUES
(1, 2, '2025-05-12', '2025-05-31', 'budi sukiman, sk.kom', NULL),
(2, 3, '2024-06-04', '2024-07-25', 'malik', 'sertifikat_1750873895.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_balasan`
--

CREATE TABLE `surat_balasan` (
  `id_surat_balasan` int(11) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `nomor_surat` varchar(100) DEFAULT NULL,
  `lampiran` varchar(100) DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `kepala_kampus` varchar(100) DEFAULT NULL,
  `tujuan_kampus` varchar(100) DEFAULT NULL,
  `tanggal_masuk_surat` date DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_berakhir` date DEFAULT NULL,
  `file_surat` varchar(255) DEFAULT NULL,
  `status` enum('pending','diterima','ditolak','') NOT NULL,
  `nama_1` varchar(100) DEFAULT NULL,
  `nim_1` varchar(50) DEFAULT NULL,
  `jurusan_1` varchar(100) DEFAULT NULL,
  `nama_2` varchar(100) DEFAULT NULL,
  `nim_2` varchar(50) DEFAULT NULL,
  `jurusan_2` varchar(100) DEFAULT NULL,
  `nama_3` varchar(100) DEFAULT NULL,
  `nim_3` varchar(50) DEFAULT NULL,
  `jurusan_3` varchar(100) DEFAULT NULL,
  `nama_4` varchar(100) DEFAULT NULL,
  `nim_4` varchar(50) DEFAULT NULL,
  `jurusan_4` varchar(100) DEFAULT NULL,
  `nama_5` varchar(100) DEFAULT NULL,
  `nim_5` varchar(50) DEFAULT NULL,
  `jurusan_5` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_balasan`
--

INSERT INTO `surat_balasan` (`id_surat_balasan`, `id_mahasiswa`, `nomor_surat`, `lampiran`, `perihal`, `kepala_kampus`, `tujuan_kampus`, `tanggal_masuk_surat`, `tanggal_mulai`, `tanggal_berakhir`, `file_surat`, `status`, `nama_1`, `nim_1`, `jurusan_1`, `nama_2`, `nim_2`, `jurusan_2`, `nama_3`, `nim_3`, `jurusan_3`, `nama_4`, `nim_4`, `jurusan_4`, `nama_5`, `nim_5`, `jurusan_5`) VALUES
(8, 2, 'lu/65/er/96', 'surat masuk', 'surat pkl', 'kampus universitas', 'untuk mahasisswa pkl', '2025-07-01', '2025-07-07', '2025-08-04', 'surat_1751423961.pdf', 'pending', 'budi', '210678', 'sistem informasi', 'yani', '210654', 'sistem informasi', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` enum('admin','kepala_dinas','','') NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `level`, `foto`) VALUES
(4, 'admin', 'admin', 'admin', 'admin', 'IMG_6694.JPG'),
(6, 'ktu', '12345', 'kepala TU', 'kepala_dinas', '133761608204091960.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `gmail` (`gmail`);

--
-- Indeks untuk tabel `pemilihan_bagian_tempat`
--
ALTER TABLE `pemilihan_bagian_tempat`
  ADD PRIMARY KEY (`id_bagian`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indeks untuk tabel `pendaftaran_magang`
--
ALTER TABLE `pendaftaran_magang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indeks untuk tabel `sertifikat_pkl`
--
ALTER TABLE `sertifikat_pkl`
  ADD PRIMARY KEY (`id_sertifikat`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indeks untuk tabel `surat_balasan`
--
ALTER TABLE `surat_balasan`
  ADD PRIMARY KEY (`id_surat_balasan`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pemilihan_bagian_tempat`
--
ALTER TABLE `pemilihan_bagian_tempat`
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran_magang`
--
ALTER TABLE `pendaftaran_magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sertifikat_pkl`
--
ALTER TABLE `sertifikat_pkl`
  MODIFY `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `surat_balasan`
--
ALTER TABLE `surat_balasan`
  MODIFY `id_surat_balasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`);

--
-- Ketidakleluasaan untuk tabel `pemilihan_bagian_tempat`
--
ALTER TABLE `pemilihan_bagian_tempat`
  ADD CONSTRAINT `pemilihan_bagian_tempat_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pendaftaran_magang`
--
ALTER TABLE `pendaftaran_magang`
  ADD CONSTRAINT `pendaftaran_magang_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sertifikat_pkl`
--
ALTER TABLE `sertifikat_pkl`
  ADD CONSTRAINT `sertifikat_pkl_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`);

--
-- Ketidakleluasaan untuk tabel `surat_balasan`
--
ALTER TABLE `surat_balasan`
  ADD CONSTRAINT `surat_balasan_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
