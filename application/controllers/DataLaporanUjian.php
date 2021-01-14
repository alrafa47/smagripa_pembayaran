
<?php

/**
 * 
 */
class DataLaporanUjian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_Model');
        $this->load->model('Jurusan_Model');
        $this->load->model('DataPembayaranUjian_Model');
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
        $this->load->view('laporanujian/index', $data);
        $this->load->view('templates/footer');
    }

    public function export($jurusan = null, $tahun_awal, $tahun_akhir)
    {
        $jurusan = ($jurusan == 'lihat_semua') ? null : $jurusan;
        $data = [
            'dataSiswa' => $this->DPPSiswa_Model->getAllDataJoinDataSiswa($jurusan, $tahun_awal, $tahun_akhir),
            'dataAngsuran' => $this->DataPembayaranDPP_Model->getAllData()
        ];
        $this->load->view('laporandpp/export', $data);
    }
}
