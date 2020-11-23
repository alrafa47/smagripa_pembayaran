<?php

/**
 * 
 */
class DataPembayaranDPP_Model extends CI_Model
{
    public function getAllData()
    {
        return $this->db->get('tbl_angsuran_dpp')->result();
    }

    public function getDataBynisn($nisn)
    {
        $query = $this->db->query('select angsuran, nominal_bayar from tbl_angsuran_dpp where nisn= "' . $nisn . '"');
        return ($query->num_rows()) ? $query->result() : false;
    }

    public function insertData($nisn, $nominal, $tanggal, $angsuran)
    {
        foreach ($angsuran as $value) {
            $data = [
                'nisn' => $nisn,
                'nominal_bayar' => $nominal,
                'tanggal' => $tanggal,
                'angsuran' => $value,
            ];
            $this->db->insert('tbl_angsuran_dpp', $data);
        }
    }



    public function deleteData($no_transaksi)
    {
        $this->db->query('SELECT * from tbl_angsuran_dpp where no_transaksi = "' . $no_transaksi . '"');
    }
}
