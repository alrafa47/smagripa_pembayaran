-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Mar 2020 pada 10.53
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smagripa_pembayaran`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_pembayaran`
--

CREATE TABLE `tbl_detail_pembayaran` (
  `kode_jenispembayaran` varchar(20) NOT NULL,
  `no_transaksi` int(20) NOT NULL,
  `sub_total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_pembayaran`
--

CREATE TABLE `tbl_jenis_pembayaran` (
  `kode_jenispembayaran` varchar(20) NOT NULL,
  `nama_pembayaran` varchar(20) NOT NULL,
  `nominal` int(20) NOT NULL,
  `tahun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_spp`
--

CREATE TABLE `tbl_jenis_spp` (
  `kode_jenisspp` varchar(20) NOT NULL,
  `nominal_jenis` int(20) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `tahun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('mm', 'multimedia'),
('ss', 'siiii');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `no_transaksi` int(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembayaran_spp`
--

CREATE TABLE `tbl_pembayaran_spp` (
  `no_transaksi` int(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `kode_kelas` varchar(20) NOT NULL,
  `kode_jenisspp` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `nominal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `nisn` varchar(20) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `jk` varchar(12) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_telfon` varchar(13) NOT NULL,
  `kode_jurusan` varchar(20) NOT NULL,
  `kode_jenisspp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indeks untuk tabel `tbl_detail_pembayaran`
--
ALTER TABLE `tbl_detail_pembayaran`
  ADD KEY `kode_jenispembayaran` (`kode_jenispembayaran`),
  ADD KEY `no_transaksi` (`no_transaksi`);

--
-- Indeks untuk tabel `tbl_dpp_siswa`
--
ALTER TABLE `tbl_dpp_siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indeks untuk tabel `tbl_jenis_pembayaran`
--
ALTER TABLE `tbl_jenis_pembayaran`
  ADD PRIMARY KEY (`kode_jenispembayaran`);

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
-- Indeks untuk tabel `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `nisn` (`nisn`);

--
-- Indeks untuk tabel `tbl_pembayaran_spp`
--
ALTER TABLE `tbl_pembayaran_spp`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `kode_kelas` (`kode_kelas`),
  ADD KEY `kode_jenisspp` (`kode_jenisspp`);

--
-- Indeks untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `kode_jenis` (`kode_jenisspp`),
  ADD KEY `kode_jurusan` (`kode_jurusan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_angsuran_dpp`
--
ALTER TABLE `tbl_angsuran_dpp`
  MODIFY `no_transaksi` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `no_transaksi` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembayaran_spp`
--
ALTER TABLE `tbl_pembayaran_spp`
  MODIFY `no_transaksi` int(20) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_angsuran_dpp`
--
ALTER TABLE `tbl_angsuran_dpp`
  ADD CONSTRAINT `tbl_angsuran_dpp_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `tbl_dpp_siswa` (`nisn`);

--
-- Ketidakleluasaan untuk tabel `tbl_detail_pembayaran`
--
ALTER TABLE `tbl_detail_pembayaran`
  ADD CONSTRAINT `tbl_detail_pembayaran_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `tbl_pembayaran` (`no_transaksi`),
  ADD CONSTRAINT `tbl_detail_pembayaran_ibfk_2` FOREIGN KEY (`kode_jenispembayaran`) REFERENCES `tbl_jenis_pembayaran` (`kode_jenispembayaran`);

--
-- Ketidakleluasaan untuk tabel `tbl_dpp_siswa`
--
ALTER TABLE `tbl_dpp_siswa`
  ADD CONSTRAINT `tbl_dpp_siswa_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `tbl_siswa` (`nisn`);

--
-- Ketidakleluasaan untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD CONSTRAINT `tbl_kelas_ibfk_1` FOREIGN KEY (`kode_jurusan`) REFERENCES `tbl_jurusan` (`kode_jurusan`);

--
-- Ketidakleluasaan untuk tabel `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD CONSTRAINT `tbl_pembayaran_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `tbl_siswa` (`nisn`);

--
-- Ketidakleluasaan untuk tabel `tbl_pembayaran_spp`
--
ALTER TABLE `tbl_pembayaran_spp`
  ADD CONSTRAINT `tbl_pembayaran_spp_ibfk_1` FOREIGN KEY (`kode_kelas`) REFERENCES `tbl_kelas` (`kode_kelas`),
  ADD CONSTRAINT `tbl_pembayaran_spp_ibfk_2` FOREIGN KEY (`nisn`) REFERENCES `tbl_siswa` (`nisn`),
  ADD CONSTRAINT `tbl_pembayaran_spp_ibfk_3` FOREIGN KEY (`kode_jenisspp`) REFERENCES `tbl_jenis_spp` (`kode_jenisspp`);

--
-- Ketidakleluasaan untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `tbl_siswa_ibfk_1` FOREIGN KEY (`kode_jurusan`) REFERENCES `tbl_jurusan` (`kode_jurusan`),
  ADD CONSTRAINT `tbl_siswa_ibfk_2` FOREIGN KEY (`kode_jenisspp`) REFERENCES `tbl_jenis_spp` (`kode_jenisspp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
