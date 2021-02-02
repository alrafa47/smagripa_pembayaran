<?php

/**
 * 
 */
class DataTagihanUjian_Model extends CI_Model
{
    public function getData($kode_ta = null)
    {
        if ($kode_ta != null) {
            $this->db->where('kode_ta', $kode_ta);
        }
        return $this->db->get('tbl_tagihan_ujian')->row();
    }

    public function insertData($data)
    {
        $this->db->insert('tbl_tagihan_ujian', $data);
    }

    public function update($data, $where)
    {
        $this->db->update('tbl_tagihan_ujian', $data, $where);
    }

    public function lastDataKonfigUjian()
    {
        $this->db->order_by('kode_ta', 'DESC');
        return $this->db->get('tbl_tagihan_ujian')->row();
    }

    public function hapus_data($kode_ta)
    {
        $this->db->delete('tbl_tagihan_ujian', ['kode_ta' => $kode_ta]);
    }
}
