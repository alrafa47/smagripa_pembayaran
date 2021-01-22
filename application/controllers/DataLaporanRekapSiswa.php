
<?php

/**
 * 
 */
class DataLaporanRekapSiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->has_userdata('id_user')) {
            redirect('Login');
        }

        $this->load->model('Siswa_Model');
        $this->load->model('Jurusan_Model');
        $this->load->model('DataPembayaranUjian_Model');
        $this->load->model('DataPembayaranSPP_Model');
        $this->load->model('DataPembayaranDPP_Model');
        $this->load->model('TahunAjaran_Model');
        $this->load->library('form_validation');
    }
    function index()
    {
        $jurusan = $this->input->get('jurusan');
        $jurusan = ($this->input->get('jurusan') == 'lihat_semua') ? null : $jurusan;
        $tahun_awal = $this->input->get('tahun_awal');
        $tahun_akhir = $this->input->get('tahun_akhir');


        $data = [
            'dataSiswa' => $this->Siswa_Model->getAllData(),
            'dataTahunAjaran' => $this->TahunAjaran_Model->getAllData(),
            'jurusan' => $this->Jurusan_Model->getAllData()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporanrekapan/index', $data);
        $this->load->view('templates/footer');
    }
    function detail()
    {
        $jurusan = $this->input->get('jurusan');
        $jurusan = ($this->input->get('jurusan') == 'lihat_semua') ? null : $jurusan;
        $tahun_awal = $this->input->get('tahun_awal');
        $tahun_akhir = $this->input->get('tahun_akhir');


        $data = [
            'dataSiswa' => $this->Siswa_Model->getAllData(),
            'dataTahunAjaran' => $this->TahunAjaran_Model->getAllData(),
            'jurusan' => $this->Jurusan_Model->getAllData()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporanrekapan/detail', $data);
        $this->load->view('templates/footer');
    }

    public function export($jurusan = null)
    {
        $jurusan = $this->input->get('jurusan');
        $jurusan = ($this->input->get('jurusan') == 'lihat_semua') ? null : $jurusan;
        $tahun_awal = $this->input->get('tahun_awal');
        $tahun_akhir = $this->input->get('tahun_akhir');


        $data = [
            'dataSiswa' => $this->Siswa_Model->getAllData(),
            'dataTahunAjaran' => $this->TahunAjaran_Model->getAllData(),
            'jurusan' => $this->Jurusan_Model->getAllData()
        ];
        $this->load->view('laporanrekapan/export', $data);
    }
}
