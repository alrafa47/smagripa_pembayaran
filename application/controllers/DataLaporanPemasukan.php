
<?php

/**
 * 
 */
class DataLaporanPemasukan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->has_userdata('id_user')) {
            redirect('Login');
        }
        if ($this->session->userdata('level') != 'admin') {
            show_404();
        }

        $this->load->model('Siswa_Model');
        $this->load->model('Kelas_Model');
        $this->load->model('TahunAjaran_Model');
        $this->load->model('DataPembayaranDPP_Model');
        $this->load->model('DataPembayaranSPP_Model');
        $this->load->model('DataPembayaranUjian_Model');

        $this->load->library('form_validation');
    }
    function index()
    {


        $data = [

            'datasiswa' => $this->Siswa_Model->getAllData(),
            'tahunajaran' => $this->TahunAjaran_Model->getAllData(),
            'kelas' => $this->Kelas_Model->getAllDatabyKelas(),
            'dpp' => $this->DataPembayaranDPP_Model->getAllData(),
            'spp' => $this->DataPembayaranSPP_Model->getAllData(),
            'ujian' => $this->DataPembayaranUjian_Model->getAllData(),


        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pemasukan/index', $data);
        $this->load->view('templates/footer');
    }
}
