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

    /* 
        *@description mengambil data pada tbl angsuran dpp
    */
    public function getDataAngsuranBynisn($nisn)
    {
        return $this->db->get_where('tbl_angsuran_dpp', ['nisn' => $nisn])->result();
    }

    public function jumlahAngsuran($nisn)
    {
        $this->db->select_sum('nominal_bayar');
        return $this->db->get_where('tbl_angsuran_dpp', ['nisn' => $nisn])->row();
    }

    /*  
        hapus angsuran by no_transaksi
    */
    public function hapusAngsuran($no_transaksi)
    {
        return $this->db->delete('tbl_angsuran_dpp', ['no_transaksi' => $no_transaksi]);
    }

    public function insertData($nisn, $nominal, $kelas, $tanggal, $angsuran)
    {
        foreach ($angsuran as $value) {
            $data = [
                'nisn' => $nisn,
                'kelas' => $kelas,
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

    public function laporanPemasukanDPP($start = null, $end = null)
    {
        $this->db->select('*, tbl_siswa.nama_siswa');
        $this->db->from('tbl_angsuran_dpp');
        $this->db->join('tbl_siswa', 'tbl_angsuran_dpp.nisn = tbl_siswa.nisn');
        if ($start != null) {
            $this->db->where('tanggal >=', $start);
        }
        if ($end != null) {
            $this->db->where('tanggal <=', $end);
        }
        return $this->db->get()->result();
    }
}
