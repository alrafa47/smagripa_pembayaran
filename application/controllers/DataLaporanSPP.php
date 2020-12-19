
<?php

/**
 * 
 */
class DataLaporanSPP extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_Model');
        $this->load->model('Kelas_Model');
        $this->load->model('DataPembayarannSPP_Model');
        $this->load->library('form_validation');
    }
    function index()
    {
        $kelas = $this->input->get('kelas');
        $kelas = ($this->input->get('kelas') == 'lihat_semua') ? null : $kelas;
        $data = [
            'dataSiswa' => $this->Siswa_Model->getAllData(),
            'dataAngsuran' => $this->DataPembayaranSPP_Model->getAllData(),
            'kelas' => $this->Kelas_Model->getAllData()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporandpp/index', $data);
        $this->load->view('templates/footer');
    }

    public function export($jurusan = null)
    {
        $jurusan = ($jurusan == 'lihat_semua') ? null : $jurusan;
        $data = [
            'dataSiswa' => $this->DPPSiswa_Model->getAllDataJoinDataSiswa($jurusan),
            'dataAngsuran' => $this->DataPembayaranDPP_Model->getAllData()
        ];
        $this->load->view('laporandpp/export', $data);
    }
}
