
<?php

/**
 * 
 */
class DataLaporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->has_userdata('id_user')) {
            redirect('Login');
        }

        $this->load->model('DPPSiswa_Model');
        $this->load->model('Jurusan_Model');
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
            'dataSiswa' => $this->DPPSiswa_Model->getAllDataJoinDataSiswa($jurusan, $tahun_awal, $tahun_akhir),
            'dataTahunAjaran' => $this->TahunAjaran_Model->getAllData(),
            'dataAngsuran' => $this->DataPembayaranDPP_Model->getAllData(),
            'jurusan' => $this->Jurusan_Model->getAllData()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporandpp/index', $data);
        $this->load->view('templates/footer');
    }

    public function export($jurusan = null, $tahun_awal = null, $tahun_akhir = null)
    {
        $jurusan = ($jurusan == 'lihat_semua') ? null : $jurusan;
        $data = [
            'dataSiswa' => $this->DPPSiswa_Model->getAllDataJoinDataSiswa($jurusan, $tahun_awal, $tahun_akhir),
            'dataAngsuran' => $this->DataPembayaranDPP_Model->getAllData(),
            'tahun_awal' => $this->TahunAjaran_Model->detail_data($tahun_awal)['tahun_ajaran'],
            'tahun_akhir' => $this->TahunAjaran_Model->detail_data($tahun_akhir)['tahun_ajaran'],
            'jurusan' => $this->Jurusan_Model->detail_data($jurusan)['nama_jurusan'],
        ];
        $this->load->view('laporandpp/export', $data);
    }
}
