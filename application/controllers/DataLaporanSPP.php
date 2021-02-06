
<?php

/**
 * 
 */
class DataLaporanSPP extends CI_Controller
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
        $this->load->model('Kelas_Model');
        $this->load->model('Siswa_Model');
        $this->load->model('DataPembayaranSPP_Model');
        $this->load->model('TahunAjaran_Model');
        $this->load->library('form_validation');
    }
    function index()
    {
        $dataPembayaran = [];
        $dataSiswa = [];
        if ($this->input->get('ta') != 'lihat_semua' && $this->input->get('kelas') != 'lihat_semua') {
            $ta = $this->input->get('ta');
            $kelas = $this->input->get('kelas');
            if ($this->input->get('ta') != null && $this->input->get('kelas') != null) {
                $dataPembayaran = $this->DataPembayaranSPP_Model->getDataPembayaranSiswa($ta, $kelas);
                $kelasSiswa = explode('_', $kelas);
                switch ($kelasSiswa[0]) {
                    case 'X':
                        $data = [
                            'kode_ta' => $ta,
                            'kelas_1' => $kelas
                        ];
                        $dataSiswa = $this->Siswa_Model->getDataLaporanSPPSiswa($data);
                        // print_r($data);
                        break;
                    case 'XI':
                        $data = [
                            'kode_ta' => $ta - 1,
                            'kelas_2' => $kelas
                        ];
                        $dataSiswa = $this->Siswa_Model->getDataLaporanSPPSiswa($data);
                        // print_r($data);
                        break;
                    case 'XII':
                        $data = [
                            'kode_ta' => $ta - 2,
                            'kelas_3' => $kelas
                        ];
                        $dataSiswa = $this->Siswa_Model->getDataLaporanSPPSiswa($data);
                        // print_r($data);
                        break;
                }
            }
        }
        // print_r($dataSiswa);
        $data = [
            'bulan' => [7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember', 1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni'],
            'dataSiswa' => $dataSiswa,
            'dataPembayaran' => $dataPembayaran,
            'tahunajaran' => $this->TahunAjaran_Model->getAllData(),
            'kelas' => $this->Kelas_Model->getAllDatabyKelas()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporanspp/index', $data);
        $this->load->view('templates/footer');
    }

    public function export($ta = null, $kelas = null)
    {
        $dataPembayaran = [];
        $dataSiswa = [];

        $dataPembayaran = $this->DataPembayaranSPP_Model->getDataPembayaranSiswa($ta, $kelas);
        $kelasSiswa = explode('_', $kelas);
        switch ($kelasSiswa[0]) {
            case 'X':
                $data = [
                    'kode_ta' => $ta,
                    'kelas_1' => $kelas
                ];
                $dataSiswa = $this->Siswa_Model->getDataLaporanSPPSiswa($data);
                // print_r($data);
                break;
            case 'XI':
                $data = [
                    'kode_ta' => $ta - 1,
                    'kelas_2' => $kelas
                ];
                $dataSiswa = $this->Siswa_Model->getDataLaporanSPPSiswa($data);
                // print_r($data);
                break;
            case 'XII':
                $data = [
                    'kode_ta' => $ta - 2,
                    'kelas_3' => $kelas
                ];
                $dataSiswa = $this->Siswa_Model->getDataLaporanSPPSiswa($data);
                // print_r($data);
                break;
        }

        $data = [
            'bulan' => [7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember', 1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni'],
            'dataSiswa' => $dataSiswa,
            'dataPembayaran' => $dataPembayaran,
            'tahunajaran' => $this->TahunAjaran_Model->getAllData(),
            'kelas' => $this->Kelas_Model->getAllDatabyKelas(),
            'ta' => $this->TahunAjaran_Model->detail_data($ta)['tahun_ajaran'],
            'kelass' => $kelas
        ];
        $this->load->view('laporanspp/export', $data);
    }
}
