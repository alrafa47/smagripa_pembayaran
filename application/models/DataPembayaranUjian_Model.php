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

    public function tambahData($data)
    {
        foreach ($data['keterangan'] as $value) {
            $data['keterangan'] = $value;
            $this->db->insert('tbl_pembayaran_ujian', $data);
        }
    }
}
