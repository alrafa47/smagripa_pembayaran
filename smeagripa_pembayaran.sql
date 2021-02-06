-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Feb 2021 pada 10.12
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smeagripa_pembayaran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_angsuran_dpp`
--

CREATE TABLE `tbl_angsuran_dpp` (
  `no_transaksi` int(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nominal_bayar` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `angsuran` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_angsuran_dpp`
--

INSERT INTO `tbl_angsuran_dpp` (`no_transaksi`, `nisn`, `nominal_bayar`, `tanggal`, `angsuran`) VALUES
(1, '1', 200000, '2021-01-28', 1),
(2, '1', 200000, '2021-01-28', 2),
(3, '1', 200000, '2021-01-28', 3),
(4, '1', 200000, '2021-01-28', 4),
(6, '2', 400000, '2021-01-28', 1),
(7, '2', 400000, '2021-01-28', 2),
(8, '4', 500000, '2021-01-28', 1),
(9, '4', 500000, '2021-01-28', 2),
(10, '4', 500000, '2021-01-28', 3),
(11, '2', 400000, '2021-02-01', 3),
(12, '2', 400000, '2021-02-01', 4),
(13, '2', 400000, '2021-02-01', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_dpp_siswa`
--

CREATE TABLE `tbl_dpp_siswa` (
  `nisn` varchar(20) NOT NULL,
  `nominal_dpp` int(10) NOT NULL,
  `jumlah_angsuran` int(10) NOT NULL,
  `nominal_angsuran` int(10) NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_dpp_siswa`
--

INSERT INTO `tbl_dpp_siswa` (`nisn`, `nominal_dpp`, `jumlah_angsuran`, `nominal_angsuran`, `status`) VALUES
('1', 1000000, 5, 200000, '0'),
('2', 2000000, 5, 400000, '1'),
('3', 3000000, 5, 600000, '0'),
('4', 1500000, 3, 500000, '1'),
('5', 500000, 5, 100000, '0'),
('6', 700000, 7, 100000, '0'),
('7', 2000000, 2, 1000000, '0'),
('8', 2000000, 4, 500000, '0'),
('9', 9000000, 9, 1000000, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_pembayaran`
--

CREATE TABLE `tbl_jenis_pembayaran` (
  `kode_jenispembayaran` int(20) NOT NULL,
  `nama_pembayaran` varchar(20) NOT NULL,
  `nominal` int(20) NOT NULL,
  `kode_ta` int(10) NOT NULL,
  `jumlah_pembayaran` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jenis_pembayaran`
--

INSERT INTO `tbl_jenis_pembayaran` (`kode_jenispembayaran`, `nama_pembayaran`, `nominal`, `kode_ta`, `jumlah_pembayaran`) VALUES
(1, 'UAS', 100000, 1, 2),
(2, 'UNBK', 1500000, 1, 12),
(3, 'UTS', 200000, 1, 2),
(5, 'UAS', 150000, 2, 2),
(6, 'UTS', 300000, 2, 2),
(7, 'UNBK', 500000, 2, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_spp`
--

CREATE TABLE `tbl_jenis_spp` (
  `kode_jenisspp` int(20) NOT NULL,
  `nominal_jenis` int(20) NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jenis_spp`
--

INSERT INTO `tbl_jenis_spp` (`kode_jenisspp`, `nominal_jenis`, `kategori`) VALUES
(8, 20000, '1'),
(9, 30000, '2'),
(11, 40000, '3'),
(12, 55000, '4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `kode_jurusan` varchar(20) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`kode_jurusan`, `nama_jurusan`) VALUES
('ak', 'Akuntansi'),
('tkj', 'teknik komputer dan jaringann');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `kode_kelas` varchar(20) NOT NULL,
  `kelas` varchar(5) NOT NULL,
  `kode_jurusan` varchar(20) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`kode_kelas`, `kelas`, `kode_jurusan`, `nama_kelas`) VALUES
('XII_ak_A', 'XII', 'ak', 'A'),
('XII_ak_B', 'XII', 'ak', 'B'),
('XII_tkj_A', 'XII', 'tkj', 'A'),
('XII_tkj_B', 'XII', 'tkj', 'B'),
('XI_ak_A', 'XI', 'ak', 'A'),
('XI_ak_B', 'XI', 'ak', 'B'),
('XI_tkj_A', 'XI', 'tkj', 'A'),
('XI_tkj_B', 'XI', 'tkj', 'B'),
('X_ak_A', 'X', 'ak', 'A'),
('X_ak_B', 'X', 'ak', 'B'),
('X_ak_D', 'X', 'ak', 'D'),
('X_tkj_A', 'X', 'tkj', 'A'),
('X_tkj_B', 'X', 'tkj', 'B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembayaran_spp`
--

CREATE TABLE `tbl_pembayaran_spp` (
  `no_transaksi` int(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `kode_ta` int(15) NOT NULL,
  `kode_jenisspp` int(20) NOT NULL,
  `nominal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pembayaran_spp`
--

INSERT INTO `tbl_pembayaran_spp` (`no_transaksi`, `nisn`, `kode_kelas`, `tanggal`, `bulan`, `kode_ta`, `kode_jenisspp`, `nominal`) VALUES
(1, '1', 'X_ak_A', '2021-01-28', '7', 1, 8, 20000),
(2, '1', 'X_ak_A', '2021-01-28', '8', 1, 8, 20000),
(3, '1', 'X_ak_A', '2021-01-28', '9', 1, 8, 20000),
(4, '1', 'X_ak_A', '2021-01-28', '11', 1, 8, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembayaran_ujian`
--

CREATE TABLE `tbl_pembayaran_ujian` (
  `no_transaksi` int(10) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_jenispembayaran` varchar(20) NOT NULL,
  `nominal` int(20) NOT NULL,
  `kode_ta` int(15) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pembayaran_ujian`
--

INSERT INTO `tbl_pembayaran_ujian` (`no_transaksi`, `nisn`, `kode_kelas`, `tanggal`, `kode_jenispembayaran`, `nominal`, `kode_ta`, `keterangan`) VALUES
(30, '1', 'X_ak_A', '2021-02-01', '5', 150000, 1, '1'),
(31, '1', 'X_ak_A', '2021-02-01', '5', 150000, 1, '2'),
(39, '2', 'XII_ak_A', '2021-02-01', '2', 125000, 3, '1'),
(40, '2', 'XII_ak_A', '2021-02-01', '2', 125000, 3, '2'),
(41, '2', 'XII_ak_A', '2021-02-01', '2', 125000, 3, '3'),
(42, '2', 'XII_ak_A', '2021-02-01', '2', 125000, 3, '4'),
(43, '2', 'XII_ak_A', '2021-02-01', '2', 125000, 3, '5'),
(44, '2', 'XII_ak_A', '2021-02-01', '2', 125000, 3, '6'),
(45, '2', 'XII_ak_A', '2021-02-01', '3', 200000, 3, '1'),
(46, '2', 'XII_ak_A', '2021-02-01', '3', 200000, 3, '2'),
(47, '2', 'XII_ak_A', '2021-02-01', '2', 125000, 3, '7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `nisn` varchar(20) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `jk` varchar(12) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_telfon` varchar(13) NOT NULL,
  `kode_ta` int(10) NOT NULL,
  `tahun_keluar` int(10) DEFAULT NULL,
  `kode_jurusan` varchar(20) NOT NULL,
  `kelas_1` varchar(20) DEFAULT NULL,
  `kelas_2` varchar(20) DEFAULT NULL,
  `kelas_3` varchar(20) DEFAULT NULL,
  `kode_jenisspp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`nisn`, `nama_siswa`, `password`, `jk`, `tempat_lahir`, `tgl_lahir`, `alamat`, `no_telfon`, `kode_ta`, `tahun_keluar`, `kode_jurusan`, `kelas_1`, `kelas_2`, `kelas_3`, `kode_jenisspp`) VALUES
('1', 'Ulva Dwi Mariyani', 'ulvadwi', 'perempuan', 'Malang', '2020-12-23', 'Malang', '098', 1, NULL, 'ak', 'X_ak_A', 'XI_ak_A', 'XII_ak_A', 9),
('2', 'Alfrizal Rhama', 'ulva', 'laki-laki', 'Malang', '2020-12-25', 'Kalimantan', '12345', 1, NULL, 'ak', 'X_ak_A', 'XI_ak_A', 'XII_ak_A', 9),
('3', 'Aqlan', 'aqlan', 'laki-laki', 'Malang', '2020-12-26', 'Malanag', '09876', 1, NULL, 'tkj', 'X_tkj_A', 'XI_tkj_A', NULL, 9),
('4', 'Aqila', 'aqila', 'perempuan', 'Malang', '2020-12-26', 'Malang', '0876543456', 2, NULL, 'tkj', 'X_tkj_A', NULL, NULL, 9),
('5', 'Jerome Polin', 'jerome', 'laki-laki', 'Malang', '2020-12-26', 'Surabaya', '987654', 2, NULL, 'tkj', 'X_tkj_B', NULL, NULL, 9),
('6', 'Aldebaran', 'aldebaran', 'laki-laki', 'Malang', '2020-12-26', 'Malang', '09865', 2, NULL, 'ak', 'X_ak_A', NULL, NULL, 8),
('7', 'Nabila', 'nabila', 'perempuan', 'Malang', '2020-12-26', 'Malang', '0766', 3, NULL, 'ak', 'X_ak_B', NULL, NULL, 9),
('8', 'Zahra', 'zahra', 'perempuan', 'Malang', '2020-12-26', 'Malang', '09876578', 3, NULL, 'tkj', 'X_tkj_A', NULL, NULL, 9),
('9', 'Jessica', 'jessica', 'perempuan', 'Malang', '2020-12-26', 'Malang', '0765478', 3, NULL, 'ak', 'X_ak_B', NULL, NULL, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tagihan_ujian`
--

CREATE TABLE `tbl_tagihan_ujian` (
  `kode_ta` int(15) NOT NULL,
  `UAS` int(20) NOT NULL,
  `UTS` int(20) NOT NULL,
  `UNBK` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_tagihan_ujian`
--

INSERT INTO `tbl_tagihan_ujian` (`kode_ta`, `UAS`, `UTS`, `UNBK`) VALUES
(1, 5, 6, 7),
(2, 5, 6, 7),
(3, 5, 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tahun_ajaran`
--

CREATE TABLE `tbl_tahun_ajaran` (
  `kode_ta` int(15) NOT NULL,
  `tahun_ajaran` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_tahun_ajaran`
--

INSERT INTO `tbl_tahun_ajaran` (`kode_ta`, `tahun_ajaran`, `status`) VALUES
(1, '2017/2018', 'tidak aktif'),
(2, '2018/2019', 'tidak aktif'),
(3, '2019/2020', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'petugas', 'petugas', 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_angsuran_dpp`
--
ALTER TABLE `tbl_angsuran_dpp`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `nisn` (`nisn`);

--
-- Indeks untuk tabel `tbl_dpp_siswa`
--
ALTER TABLE `tbl_dpp_siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indeks untuk tabel `tbl_jenis_pembayaran`
--
ALTER TABLE `tbl_jenis_pembayaran`
  ADD PRIMARY KEY (`kode_jenispembayaran`),
  ADD KEY `tahun` (`kode_ta`);

--
-- Indeks untuk tabel `tbl_jenis_spp`
--
ALTER TABLE `tbl_jenis_spp`
  ADD PRIMARY KEY (`kode_jenisspp`);

--
-- Indeks untuk tabel `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`kode_jurusan`);

--
-- Indeks untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`kode_kelas`),
  ADD KEY `kode_jurusan` (`kode_jurusan`);

--
-- Indeks untuk tabel `tbl_pembayaran_spp`
--
ALTER TABLE `tbl_pembayaran_spp`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `kode_kelas` (`kode_kelas`),
  ADD KEY `kode_jenisspp` (`kode_jenisspp`),
  ADD KEY `kode_ta` (`kode_ta`);

--
-- Indeks untuk tabel `tbl_pembayaran_ujian`
--
ALTER TABLE `tbl_pembayaran_ujian`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `kode_jenispembayaran` (`kode_jenispembayaran`),
  ADD KEY `kode_ta` (`kode_ta`),
  ADD KEY `kode_kelas` (`kode_kelas`);

--
-- Indeks untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `kode_jenis` (`kode_jenisspp`),
  ADD KEY `kode_jurusan` (`kode_jurusan`),
  ADD KEY `kode_ta` (`kode_ta`),
  ADD KEY `kelas_1` (`kelas_1`),
  ADD KEY `kelas_2` (`kelas_2`),
  ADD KEY `kelas_3` (`kelas_3`);

--
-- Indeks untuk tabel `tbl_tagihan_ujian`
--
ALTER TABLE `tbl_tagihan_ujian`
  ADD PRIMARY KEY (`kode_ta`);

--
-- Indeks untuk tabel `tbl_tahun_ajaran`
--
ALTER TABLE `tbl_tahun_ajaran`
  ADD PRIMARY KEY (`kode_ta`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_angsuran_dpp`
--
ALTER TABLE `tbl_angsuran_dpp`
  MODIFY `no_transaksi` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_jenis_pembayaran`
--
ALTER TABLE `tbl_jenis_pembayaran`
  MODIFY `kode_jenispembayaran` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_jenis_spp`
--
ALTER TABLE `tbl_jenis_spp`
  MODIFY `kode_jenisspp` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembayaran_spp`
--
ALTER TABLE `tbl_pembayaran_spp`
  MODIFY `no_transaksi` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembayaran_ujian`
--
ALTER TABLE `tbl_pembayaran_ujian`
  MODIFY `no_transaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_angsuran_dpp`
--
ALTER TABLE `tbl_angsuran_dpp`
  ADD CONSTRAINT `tbl_angsuran_dpp_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `tbl_dpp_siswa` (`nisn`);

--
-- Ketidakleluasaan untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD CONSTRAINT `tbl_kelas_ibfk_1` FOREIGN KEY (`kode_jurusan`) REFERENCES `tbl_jurusan` (`kode_jurusan`);

--
-- Ketidakleluasaan untuk tabel `tbl_pembayaran_spp`
--
ALTER TABLE `tbl_pembayaran_spp`
  ADD CONSTRAINT `tbl_pembayaran_spp_ibfk_1` FOREIGN KEY (`kode_jenisspp`) REFERENCES `tbl_jenis_spp` (`kode_jenisspp`),
  ADD CONSTRAINT `tbl_pembayaran_spp_ibfk_3` FOREIGN KEY (`kode_kelas`) REFERENCES `tbl_kelas` (`kode_kelas`),
  ADD CONSTRAINT `tbl_pembayaran_spp_ibfk_4` FOREIGN KEY (`kode_ta`) REFERENCES `tbl_tahun_ajaran` (`kode_ta`),
  ADD CONSTRAINT `tbl_pembayaran_spp_ibfk_5` FOREIGN KEY (`nisn`) REFERENCES `tbl_siswa` (`nisn`);

--
-- Ketidakleluasaan untuk tabel `tbl_pembayaran_ujian`
--
ALTER TABLE `tbl_pembayaran_ujian`
  ADD CONSTRAINT `tbl_pembayaran_ujian_ibfk_1` FOREIGN KEY (`kode_ta`) REFERENCES `tbl_tahun_ajaran` (`kode_ta`);

--
-- Ketidakleluasaan untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `tbl_siswa_ibfk_1` FOREIGN KEY (`kode_jurusan`) REFERENCES `tbl_jurusan` (`kode_jurusan`),
  ADD CONSTRAINT `tbl_siswa_ibfk_2` FOREIGN KEY (`kode_ta`) REFERENCES `tbl_tahun_ajaran` (`kode_ta`),
  ADD CONSTRAINT `tbl_siswa_ibfk_3` FOREIGN KEY (`kode_jenisspp`) REFERENCES `tbl_jenis_spp` (`kode_jenisspp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
