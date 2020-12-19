<?php

/**
 * 
 */
class DataPembayaranUjian_Model extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('tbl_pembayaran')->result();
    }
}
