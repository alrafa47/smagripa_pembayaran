<?php

/**
 * 
 */
class DataPembayaranSPP_Model extends CI_Model
{
    public function getDataSIswaJoinJenisSPP()
    {
        $this->db->select('tbl_siswa.*, tbl_jenis_spp.nominal_jenis, tbl_jenis_spp.kategori');
        $this->db->from('tbl_siswa');
        $this->db->join('tbl_jenis_spp', 'tbl_siswa.kode_jenisspp = tbl_jenis_spp.kode_jenisspp');
        return $this->db->get()->result();
    }
    public function getDataSIswaJoinJenisSPPByNISN($nisn)
    {
        $this->db->select('tbl_siswa.*, tbl_jenis_spp.nominal_jenis, tbl_jenis_spp.kategori');
        $this->db->from('tbl_siswa');
        $this->db->join('tbl_jenis_spp', 'tbl_siswa.kode_jenisspp = tbl_jenis_spp.kode_jenisspp');
        $this->db->where('tbl_siswa.nisn', $nisn);
        return $this->db->get()->row();
    }

    public function getTagihanSPP($start, $end = 0)
    {
        $this->db->select('kode_ta, tahun_ajaran');
        $this->db->from('tbl_tahun_ajaran');
        $this->db->where('status', 'aktif');
        $this->db->where('kode_ta >=', $start);
        if ($end != 0) {
            $this->db->where('kode_ta <=', $end);
        }
        return $this->db->get()->result();
    }

    public function getDataPembayaranSPP($nisn)
    {
        $query = $this->db->get_where('tbl_pembayaran_spp', ['nisn', $nisn]);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $value) {
                $data[$value->kode_ta][] = $value->bulan;
            }
            return $data;
        } else {
            return false;
        }
    }

    /* 
        note : 
        bulan ke :
        semester ganjil : 7, 8, 9, 10, 11, 12 
        semester genap : 1, 2, 3, 4, 5, 6
    */
}
