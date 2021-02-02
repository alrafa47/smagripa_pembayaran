<?php

/**
 * 
 */
class DataPembayaranUjian_Model extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('tbl_pembayaran_ujian')->result();
    }

    public function pembayaranSiswa($nisn)
    {
        $this->db->select('no_transaksi, nisn, kode_kelas, tanggal, tbl_pembayaran_ujian.kode_jenispembayaran, tbl_pembayaran_ujian.nominal, tbl_pembayaran_ujian.kode_ta as tahunBayar, tbl_jenis_pembayaran.kode_ta as kode_ta, keterangan, nama_pembayaran, jumlah_pembayaran');
        $this->db->join('tbl_jenis_pembayaran', 'tbl_pembayaran_ujian.kode_jenispembayaran = tbl_jenis_pembayaran.kode_jenispembayaran');
        return $this->db->get_where('tbl_pembayaran_ujian', ['nisn' => $nisn])->result();
    }

    public function getpembayaranSiswa($nisn, $ta, $jenisPembayaran)
    {
        $this->db->select('no_transaksi, nisn, kode_kelas, tanggal, tbl_pembayaran_ujian.kode_jenispembayaran, tbl_pembayaran_ujian.nominal, tbl_pembayaran_ujian.kode_ta as tahunBayar, tbl_jenis_pembayaran.kode_ta as kode_ta, keterangan, nama_pembayaran, jumlah_pembayaran, tbl_tahun_ajaran.tahun_ajaran');
        $this->db->join('tbl_jenis_pembayaran', 'tbl_pembayaran_ujian.kode_jenispembayaran = tbl_jenis_pembayaran.kode_jenispembayaran');
        $this->db->join('tbl_tahun_ajaran', 'tbl_jenis_pembayaran.kode_ta = tbl_tahun_ajaran.kode_ta');
        $this->db->where('nisn', $nisn);
        $this->db->where('tbl_jenis_pembayaran.nama_pembayaran', $jenisPembayaran);
        $this->db->where('tbl_pembayaran_ujian.kode_ta', $ta);
        return $this->db->get('tbl_pembayaran_ujian')->row();
    }

    public function detailpembayaranSiswa($nisn, $jenisPembayaran, $keterangan)
    {
        return $this->db->get_where('tbl_pembayaran_ujian', ['nisn' => $nisn, 'kode_jenispembayaran' => $jenisPembayaran, 'keterangan' => $keterangan])->result();
    }

    public function cekTagihanUjian($nisn = null, $jenisPembayaran = null, $kelas = null,  $keterangan = null)
    {
        $this->db->join('tbl_jenis_pembayaran', 'tbl_jenis_pembayaran.kode_jenispembayaran = tbl_pembayaran_ujian.kode_jenispembayaran');
        if ($nisn != null) {
            $this->db->where('nisn', $nisn);
        }
        if ($jenisPembayaran != null) {
            // $this->db->where('tbl_pembayaran_ujian.kode_jenispembayaran', $jenisPembayaran);
            $this->db->where('tbl_jenis_pembayaran.nama_pembayaran', $jenisPembayaran);
        }
        if ($kelas != null) {
            $this->db->where('kode_kelas', $kelas);
        }
        if ($keterangan != null) {
            $this->db->where('keterangan', $keterangan);
        }
        return $this->db->get('tbl_pembayaran_ujian')->result();
    }

    public function tambahData($data)
    {
        foreach ($data['keterangan'] as $value) {
            $data['keterangan'] = $value;
            $this->db->insert('tbl_pembayaran_ujian', $data);
        }
    }

    public function hapusTransaksi($no_transaksi)
    {
        $this->db->delete('tbl_pembayaran_ujian', ['no_transaksi' => $no_transaksi]);
    }

    public function getDataPembayaranSiswa($ta, $kode_kelas)
    {
        $this->db->select('no_transaksi, nisn, kode_kelas, tanggal, tbl_pembayaran_ujian.kode_jenispembayaran, tbl_pembayaran_ujian.nominal, tbl_pembayaran_ujian.kode_ta as tahunBayar, tbl_jenis_pembayaran.kode_ta as kode_ta, keterangan, nama_pembayaran, jumlah_pembayaran');
        $this->db->join('tbl_jenis_pembayaran', 'tbl_pembayaran_ujian.kode_jenispembayaran = tbl_jenis_pembayaran.kode_jenispembayaran');
        $this->db->where('kode_kelas', $kode_kelas);
        $this->db->where('tbl_pembayaran_ujian.kode_ta', $ta);
        return $this->db->get('tbl_pembayaran_ujian')->result();
    }

    public function laporanPemasukanUjian($start = null, $end = null)
    {
        $this->db->select('*, tbl_siswa.nama_siswa, tbl_jenis_pembayaran.nama_pembayaran');
        $this->db->from('tbl_pembayaran_ujian');
        $this->db->join('tbl_siswa', 'tbl_pembayaran_ujian.nisn = tbl_siswa.nisn');
        $this->db->join('tbl_jenis_pembayaran', 'tbl_jenis_pembayaran.kode_jenispembayaran = tbl_pembayaran_ujian.kode_jenispembayaran');
        if ($start != null) {
            $this->db->where('tanggal >=', $start);
        }
        if ($end != null) {
            $this->db->where('tanggal <=', $end);
        }
        return $this->db->get()->result();
    }

    public function cekPembayaranUjian($nisn, $kelas)
    {
        $this->db->join('tbl_jenis_pembayaran', 'tbl_jenis_pembayaran.kode_jenispembayaran = tbl_pembayaran_ujian.kode_jenispembayaran');
        $this->db->where('nisn', $nisn);
        $this->db->where('kode_kelas', $kelas);
        return $this->db->get('tbl_pembayaran_ujian')->row();
    }
}
