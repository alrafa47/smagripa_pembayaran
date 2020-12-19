
<?php

/**
 * 
 */
class DataLaporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DPPSiswa_Model');
        $this->load->model('Jurusan_Model');
        $this->load->model('DataPembayaranDPP_Model');
        $this->load->library('form_validation');
    }
    function index()
    {
        $jurusan = $this->input->get('jurusan');
        $jurusan = ($this->input->get('jurusan') == 'lihat_semua') ? null : $jurusan;
        $data = [
            'dataSiswa' => $this->DPPSiswa_Model->getAllDataJoinDataSiswa($jurusan),
            'dataAngsuran' => $this->DataPembayaranDPP_Model->getAllData(),
            'jurusan' => $this->Jurusan_Model->getAllData()
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
