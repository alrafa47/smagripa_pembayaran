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
}
