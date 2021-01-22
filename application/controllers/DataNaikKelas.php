
<?php

/**
 * 
 */
class DataNaikKelas extends CI_Controller
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
        $this->load->library('form_validation');
    }
    function index()
    {


        $data = [

            'datasiswa' => $this->Siswa_Model->getAllData(),
            'tahunajaran' => $this->TahunAjaran_Model->getAllData(),
            'kelas' => $this->Kelas_Model->getAllDatabyKelas()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('naikkelas/index', $data);
        $this->load->view('templates/footer');
    }
}
