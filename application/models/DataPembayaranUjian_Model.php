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
        return $this->db->get_where('tbl_pembayaran_ujian', ['nisn' => $nisn])->result();
    }

    public function detailpembayaranSiswa($nisn, $jenisPembayaran, $keterangan)
    {
        return $this->db->get_where('tbl_pembayaran_ujian', ['nisn' => $nisn, 'kode_jenispembayaran' => $jenisPembayaran, 'keterangan' => $keterangan])->result();
    }

    public function cekTagihanUjian($nisn = null, $jenisPembayaran = null, $kelas = null,  $keterangan = null)
    {
        if ($nisn != null) {
            $this->db->where('nisn', $nisn);
        }
        if ($jenisPembayaran != null) {
            $this->db->where('kode_jenispembayaran', $jenisPembayaran);
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
        $this->db->where('kode_kelas', $kode_kelas);
        $this->db->where('kode_ta', $ta);
        return $this->db->get('tbl_pembayaran_ujian')->result();
    }
}
