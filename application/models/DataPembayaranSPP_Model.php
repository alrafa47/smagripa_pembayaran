<?php
/* 
        note : 
        bulan ke :
        semester ganjil : 7, 8, 9, 10, 11, 12 
        semester genap : 1, 2, 3, 4, 5, 6
    */

/**
 * 
 */
class DataPembayaranSPP_Model extends CI_Model
{
    public function getAllData($kode_ta = null, $kode_kelas = null)
    {
        if ($kode_ta != null && $kode_kelas != null) {
            $this->db->where('kode_ta', $kode_ta);
            $this->db->where('kode_kelas', $kode_kelas);
        }
        return $this->db->get('tbl_pembayaran_spp')->result();
    }

    public function getDataSIswaJoinJenisSPP($id = null)
    {
        $this->db->select('tbl_siswa.*, tbl_jenis_spp.nominal_jenis, tbl_jenis_spp.kategori');
        $this->db->from('tbl_siswa');
        $this->db->join('tbl_jenis_spp', 'tbl_siswa.kode_jenisspp = tbl_jenis_spp.kode_jenisspp');
        if ($id != null) {
            $this->db->where('tbl_siswa.nisn', $id);
            return $this->db->get()->row();
        }
        return $this->db->get()->result();
    }

    public function getDataPembayaranSiswa($kode_ta = null, $kode_kelas = null)
    {
        $this->db->select('tbl_siswa.*, tbl_jenis_spp.nominal_jenis, tbl_jenis_spp.kategori, tbl_pembayaran_spp.bulan, tbl_pembayaran_spp.kode_ta as ta_bayar');
        $this->db->from('tbl_siswa');
        $this->db->join('tbl_jenis_spp', 'tbl_siswa.kode_jenisspp = tbl_jenis_spp.kode_jenisspp');
        $this->db->join('tbl_pembayaran_spp', 'tbl_siswa.nisn = tbl_pembayaran_spp.nisn', 'left');
        if ($kode_ta != null && $kode_kelas != null) {
            $this->db->where('tbl_pembayaran_spp.kode_kelas', $kode_kelas);
            $this->db->where('tbl_pembayaran_spp.kode_ta', $kode_ta);
        }
        $this->db->order_by('tbl_siswa.nisn', 'ASC');
        return $this->db->get()->result();
    }

    public function getJumlahPembayaran($nisn, $kelas)
    {
        $this->db->where('nisn', $nisn);
        $this->db->where('kode_kelas', $kelas);
        return $this->db->count_all_results('tbl_pembayaran_spp');
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
        $this->db->where('kode_ta >=', $start);
        if ($end != null) {
            $this->db->where('kode_ta <=', $end);
        }
        return $this->db->get()->result();
    }

    public function getDataPembayaranSPP($nisn)
    {
        $query = $this->db->get_where('tbl_pembayaran_spp', ['nisn' => $nisn]);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $value) {
                $data[$value->kode_ta][] = $value->bulan;
            }
            return $data;
        } else {
            return false;
        }
    }

    public function insertData($nisn, $kelas, $tanggal, $bulan, $kode_ta, $jenisspp, $nominal)
    {
        $data = [
            'nisn' => $nisn,
            'kode_kelas' => $kelas,
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'kode_ta' => $kode_ta,
            'kode_jenisspp' => $jenisspp,
            'nominal' => $nominal,
        ];
        $this->db->insert('tbl_pembayaran_spp', $data);
    }

    public function DetailDataPembayaranSPP($nisn)
    {
        return $this->db->get_where('tbl_pembayaran_spp', ['nisn' => $nisn])->result();
    }

    public function hapusTransaksi($no_transaksi)
    {
        $this->db->delete('tbl_pembayaran_spp', ['no_transaksi' => $no_transaksi]);
    }

    /* 
    * untuk mendapatkan laporan pemasukan dari spp
    */

    public function laporanPemasukanSPP($start = null, $end = null)
    {
        $this->db->select('*, tbl_siswa.nama_siswa');
        $this->db->from('tbl_pembayaran_spp');
        $this->db->join('tbl_siswa', 'tbl_pembayaran_spp.nisn = tbl_siswa.nisn');
        if ($start != null) {
            $this->db->where('tanggal >=', $start);
        }
        if ($end != null) {
            $this->db->where('tanggal <=', $end);
        }
        return $this->db->get()->result();
    }
}
