
<?php

/**
 * 
 */
class DataLaporanUjian extends CI_Controller
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

        $this->load->model('Siswa_Model');
        $this->load->model('Kelas_Model');
        $this->load->model('Jenis_Pembayaran_Model');
        $this->load->model('DataPembayaranUjian_Model');
        $this->load->model('DataTagihanUjian_Model');
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
                $dataPembayaran = $this->DataPembayaranUjian_Model->getDataPembayaranSiswa($ta, $kelas);
                $kelasSiswa = explode('_', $kelas);
                switch ($kelasSiswa[0]) {
                    case 'X':
                        $data = [
                            'kode_ta' => $ta,
                            'kelas_1' => $kelas
                        ];
                        $dataSiswa = $this->Siswa_Model->getDataLaporanUjianSiswa($data);
                        // print_r($data);
                        break;
                    case 'XI':
                        $data = [
                            'kode_ta' => $ta - 1,
                            'kelas_2' => $kelas
                        ];
                        $dataSiswa = $this->Siswa_Model->getDataLaporanUjianSiswa($data);
                        // print_r($data);
                        break;
                    case 'XII':
                        $data = [
                            'kode_ta' => $ta - 2,
                            'kelas_3' => $kelas
                        ];
                        $dataSiswa = $this->Siswa_Model->getDataLaporanUjianSiswa($data);
                        // print_r($data);
                        break;
                }
            }
        }

        $data = [
            'dataSiswa' => $dataSiswa,
            'dataPembayaran' => $dataPembayaran,
            'dataTahunAjaran' => $this->TahunAjaran_Model->getAllData(),
            'tahunajaran' => $this->TahunAjaran_Model->getAllData(),
            'jenisPembayaran' => $this->Jenis_Pembayaran_Model->getAllData(),
            'kelas' => $this->Kelas_Model->getAllDatabyKelas(),
            'konfigTagihanUjian' => $this->DataTagihanUjian_Model->getData($this->input->get('ta'))
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporanujian/index', $data);
        $this->load->view('templates/footer');
    }

    public function export($ta = null, $kelas = null)
    {
        $dataPembayaran = [];
        $dataSiswa = [];

        $dataPembayaran = $this->DataPembayaranUjian_Model->getDataPembayaranSiswa($ta, $kelas);
        $kelasSiswa = explode('_', $kelas);
        switch ($kelasSiswa[0]) {
            case 'X':
                $data = [
                    'kode_ta' => $ta,
                    'kelas_1' => $kelas
                ];
                $dataSiswa = $this->Siswa_Model->getDataLaporanUjianSiswa($data);
                // print_r($data);
                break;
            case 'XI':
                $data = [
                    'kode_ta' => $ta - 1,
                    'kelas_2' => $kelas
                ];
                $dataSiswa = $this->Siswa_Model->getDataLaporanUjianSiswa($data);
                // print_r($data);
                break;
            case 'XII':
                $data = [
                    'kode_ta' => $ta - 2,
                    'kelas_3' => $kelas
                ];
                $dataSiswa = $this->Siswa_Model->getDataLaporanUjianSiswa($data);
                // print_r($data);
                break;
        }

        $data = [
            'dataSiswa' => $dataSiswa,
            'dataPembayaran' => $dataPembayaran,
            'dataTahunAjaran' => $this->TahunAjaran_Model->getAllData(),
            'tahunajaran' => $this->TahunAjaran_Model->getAllData(),
            'jenisPembayaran' => $this->Jenis_Pembayaran_Model->getAllData(),
            'kelas' => $this->Kelas_Model->getAllDatabyKelas(),
            'ta' => $this->TahunAjaran_Model->detail_data($ta)['tahun_ajaran'],
            'kelass' => $kelas,
            'konfigTagihanUjian' => $this->DataTagihanUjian_Model->getData($this->input->get('ta'))

        ];
        $this->load->view('laporanujian/export', $data);
    }
}
