
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
        $ta = $this->input->get('ta');
        $ta = ($this->input->get('ta') == 'lihat_semua') ? null : $ta;
        $data = [
            
            'dataspp' => $this->DataPembayaranSPP_Model->getDataSIswaJoinJenisSPP(),
            'tahunajaran' => $this->TahunAjaran_Model->getAllData()
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
