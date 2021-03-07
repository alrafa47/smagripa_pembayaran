-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Feb 2021 pada 17.27
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
  `kelas` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nominal_bayar` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `angsuran` int(5) NOT NULL
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

--
-- Dumping data untuk tabel `tbl_dpp_siswa`
--

INSERT INTO `tbl_dpp_siswa` (`nisn`, `nominal_dpp`, `jumlah_angsuran`, `nominal_angsuran`, `status`) VALUES
('1', 100, 2, 50, '0');

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
(4, 'UTS', 100, 1, 2),
(5, 'UAS', 2, 1, 2),
(6, 'UNBK', 24, 1, 12);

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
(13, 10, '1');

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
('ak', 'Akuntansi');

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
('X_ak_A', 'X', 'ak', 'A');

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
(1, '1', 'X_ak_A', '2021-02-08', '7', 2, 13, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembayaran_ujian`
--

CREATE TABLE `tbl_pembayaran_ujian` (
  `no_transaksi` int(10) NOT NULL,
  `nisn` varchar(20) CHARACTER SET latin1 NOT NULL,
  `kode_kelas` varchar(20) CHARACTER SET latin1 NOT NULL,
  `tanggal` date NOT NULL,
  `kode_jenispembayaran` int(20) NOT NULL,
  `nominal` int(20) NOT NULL,
  `kode_ta` int(15) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('1', 'q', '1', 'laki-laki', 'q', '2020-01-07', 'q', '1', 2, NULL, 'ak', 'X_ak_A', NULL, NULL, 13);

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
(1, 5, 4, 6),
(2, 5, 4, 6);

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
(2, '2018/2019', 'aktif');

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
  ADD KEY `nisn` (`nisn`),
  ADD KEY `kelas` (`kelas`);

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
  ADD KEY `kode_jenispembayaran` (`kode_jenispembayaran`),
  ADD KEY `kode_ta` (`kode_ta`),
  ADD KEY `kode_kelas` (`kode_kelas`),
  ADD KEY `nisn` (`nisn`);

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
  ADD KEY `kelas_3` (`kelas_3`),
  ADD KEY `tahun_keluar` (`tahun_keluar`);

--
-- Indeks untuk tabel `tbl_tagihan_ujian`
--
ALTER TABLE `tbl_tagihan_ujian`
  ADD PRIMARY KEY (`kode_ta`),
  ADD KEY `UAS` (`UAS`),
  ADD KEY `UTS` (`UTS`),
  ADD KEY `UNBK` (`UNBK`);

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
  MODIFY `no_transaksi` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_jenis_pembayaran`
--
ALTER TABLE `tbl_jenis_pembayaran`
  MODIFY `kode_jenispembayaran` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_jenis_spp`
--
ALTER TABLE `tbl_jenis_spp`
  MODIFY `kode_jenisspp` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembayaran_spp`
--
ALTER TABLE `tbl_pembayaran_spp`
  MODIFY `no_transaksi` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembayaran_ujian`
--
ALTER TABLE `tbl_pembayaran_ujian`
  MODIFY `no_transaksi` int(10) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `tbl_angsuran_dpp_ibfk_2` FOREIGN KEY (`kelas`) REFERENCES `tbl_kelas` (`kode_kelas`),
  ADD CONSTRAINT `tbl_angsuran_dpp_ibfk_3` FOREIGN KEY (`nisn`) REFERENCES `tbl_siswa` (`nisn`);

--
-- Ketidakleluasaan untuk tabel `tbl_jenis_pembayaran`
--
ALTER TABLE `tbl_jenis_pembayaran`
  ADD CONSTRAINT `tbl_jenis_pembayaran_ibfk_1` FOREIGN KEY (`kode_ta`) REFERENCES `tbl_tahun_ajaran` (`kode_ta`);

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
  ADD CONSTRAINT `tbl_pembayaran_ujian_ibfk_1` FOREIGN KEY (`kode_ta`) REFERENCES `tbl_tahun_ajaran` (`kode_ta`),
  ADD CONSTRAINT `tbl_pembayaran_ujian_ibfk_2` FOREIGN KEY (`kode_jenispembayaran`) REFERENCES `tbl_jenis_pembayaran` (`kode_jenispembayaran`),
  ADD CONSTRAINT `tbl_pembayaran_ujian_ibfk_3` FOREIGN KEY (`kode_kelas`) REFERENCES `tbl_kelas` (`kode_kelas`),
  ADD CONSTRAINT `tbl_pembayaran_ujian_ibfk_4` FOREIGN KEY (`nisn`) REFERENCES `tbl_siswa` (`nisn`);

--
-- Ketidakleluasaan untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `tbl_siswa_ibfk_1` FOREIGN KEY (`kode_jurusan`) REFERENCES `tbl_jurusan` (`kode_jurusan`),
  ADD CONSTRAINT `tbl_siswa_ibfk_2` FOREIGN KEY (`kode_ta`) REFERENCES `tbl_tahun_ajaran` (`kode_ta`),
  ADD CONSTRAINT `tbl_siswa_ibfk_3` FOREIGN KEY (`kode_jenisspp`) REFERENCES `tbl_jenis_spp` (`kode_jenisspp`),
  ADD CONSTRAINT `tbl_siswa_ibfk_4` FOREIGN KEY (`kelas_1`) REFERENCES `tbl_kelas` (`kode_kelas`),
  ADD CONSTRAINT `tbl_siswa_ibfk_5` FOREIGN KEY (`kelas_2`) REFERENCES `tbl_kelas` (`kode_kelas`),
  ADD CONSTRAINT `tbl_siswa_ibfk_6` FOREIGN KEY (`kelas_3`) REFERENCES `tbl_kelas` (`kode_kelas`),
  ADD CONSTRAINT `tbl_siswa_ibfk_7` FOREIGN KEY (`tahun_keluar`) REFERENCES `tbl_tahun_ajaran` (`kode_ta`);

--
-- Ketidakleluasaan untuk tabel `tbl_tagihan_ujian`
--
ALTER TABLE `tbl_tagihan_ujian`
  ADD CONSTRAINT `tbl_tagihan_ujian_ibfk_1` FOREIGN KEY (`UAS`) REFERENCES `tbl_jenis_pembayaran` (`kode_jenispembayaran`),
  ADD CONSTRAINT `tbl_tagihan_ujian_ibfk_2` FOREIGN KEY (`UTS`) REFERENCES `tbl_jenis_pembayaran` (`kode_jenispembayaran`),
  ADD CONSTRAINT `tbl_tagihan_ujian_ibfk_3` FOREIGN KEY (`UNBK`) REFERENCES `tbl_jenis_pembayaran` (`kode_jenispembayaran`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
