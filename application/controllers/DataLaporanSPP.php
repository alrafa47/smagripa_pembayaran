
<?php

/**
 * 
 */
class DataLaporanSPP extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kelas_Model');
        $this->load->model('DataPembayaranSPP_Model');
        $this->load->model('TahunAjaran_Model');
        $this->load->library('form_validation');
    }
    function index()
    {
        $kelas = ($this->input->get('kelas') == 'lihat_semua') ? null : $this->input->get('kelas');
        $ta = ($this->input->get('ta') == 'lihat_semua') ? null : $this->input->get('ta');
        $data = [
            'bulan' => [7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember', 1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni'],
            'datasiswa' => $this->DataPembayaranSPP_Model->getDataPembayaranSiswa($ta, $kelas),
            'tahunajaran' => $this->TahunAjaran_Model->getAllData(),
            // 'kelas' => $this->Kelas_Model->getAllDatabyKelas($kelas)
            'kelas' => $this->Kelas_Model->getAllDatabyKelas()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporanspp/index', $data);
        $this->load->view('templates/footer');
    }

    public function export($ta = null)
    {

        $data = [
            'dataSiswa' => $this->DPPSiswa_Model->getAllData(),
            'dataBayar' => $this->DataPembayaranSPP_Model->getDataSIswaJoinJenisSPP()
        ];
        $this->load->view('laporandpp/export', $data);
    }
}
