
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
        if ($this->session->userdata('level') == 'siswa') {
            show_404();
        }

        $this->load->model('DPPSiswa_Model');
        $this->load->model('Jurusan_Model');
        $this->load->model('Kelas_Model');
        $this->load->model('DataPembayaranDPP_Model');
        $this->load->model('TahunAjaran_Model');
        $this->load->library('form_validation');
    }
    function index()
    {
        $kelas = $this->input->get('kelas');
        $kelas = ($this->input->get('kelas') == 'lihat_semua') ? null : $kelas;
        $tahun_awal = $this->input->get('tahun_awal');
        // $tahun_akhir = $this->input->get('tahun_akhir');


        $data = [
            'dataSiswa' => $this->DPPSiswa_Model->getAllDataJoinDataSiswa_Kelas($kelas, $tahun_awal),
            'dataTahunAjaran' => $this->TahunAjaran_Model->getAllData(),
            'dataAngsuran' => $this->DataPembayaranDPP_Model->getAllData(),
            'kelas' => $this->Kelas_Model->getAllData()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporandpp/index', $data);
        $this->load->view('templates/footer');
    }

    public function export($kelas = null, $tahun_awal = null)
    {
        $kelas = ($kelas == 'lihat_semua') ? null : $kelas;
        $data = [
            'dataSiswa' => $this->DPPSiswa_Model->getAllDataJoinDataSiswa_Kelas($kelas, $tahun_awal),
            'dataAngsuran' => $this->DataPembayaranDPP_Model->getAllData(),
            'tahun_awal' => $this->TahunAjaran_Model->detail_data($tahun_awal)['tahun_ajaran'],
            // 'tahun_akhir' => $this->TahunAjaran_Model->detail_data($tahun_akhir)['tahun_ajaran'],
            'kelas' => $this->Kelas_Model->detail_data($kelas)['kode_kelas'],
        ];
        $this->load->view('laporandpp/export', $data);
    }
}
