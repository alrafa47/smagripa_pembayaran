
<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
        // $dataPembayaran = [];
        $dataSiswa = [];
        if ($this->input->get('ta') != 'lihat_semua' && $this->input->get('kelas') != 'lihat_semua') {
            $ta = $this->input->get('ta');
            $kelas = $this->input->get('kelas');
            if ($this->input->get('ta') != null && $this->input->get('kelas') != null) {
                // $dataPembayaran = $this->DataPembayaranUjian_Model->getDataPembayaranSiswa($ta, $kelas);
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
            'datasiswa' => $dataSiswa,
            // 'datasiswa' => $this->Siswa_Model->getAllData(),
            'tahunajaran' => $this->TahunAjaran_Model->getAllData(),
            'kelas' => $this->Kelas_Model->getAllDatabyKelas()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('naikkelas/index', $data);
        $this->load->view('templates/footer');
    }

    public function naikTingkat()
    {
        $ta = $this->TahunAjaran_Model->tahunAjaranAktif;
        $id = $this->input->post('id');
        print_r($id);
        if (!empty($this->input->post('kelas_1'))) {
            $kelas_1 =  $this->input->post('kelas_1');
            print_r($kelas_1);
            foreach ($kelas_1 as $value1) {
                if ($value1 != '') {
                    $explode1 = explode('+', $value1);
                    $data = ['kelas_1' => $explode1[1]];
                    $this->Siswa_Model->naikTingkat($explode1[0], $data);
                }
            }
        }
        if (!empty($this->input->post('kelas_2'))) {
            $kelas_2 =  $this->input->post('kelas_2');
            print_r($kelas_2);
            foreach ($kelas_2 as $value2) {
                if ($value2 != '') {
                    $explode2 = explode('+', $value2);
                    $data = ['kelas_2' => $explode2[1]];
                    $this->Siswa_Model->naikTingkat($explode2[0], $data);
                }
            }
        }
        if (!empty($this->input->post('kelas_3'))) {
            $kelas_3 =  $this->input->post('kelas_3');
            print_r($kelas_3);
            foreach ($kelas_3 as $value3) {
                if ($value3 != '') {
                    $explode3 = explode('+', $value3);
                    $data = ['kelas_3' => $explode3[1]];
                    $this->Siswa_Model->naikTingkat($explode3[0], $data);
                }
            }
        }
        if (!empty($this->input->post('kelulusan'))) {
            $kelulusan =  $this->input->post('kelulusan');
            print_r($kelulusan);
            foreach ($kelulusan as $nisn) {
                $data = ['tahun_keluar' => $ta];
                $this->Siswa_Model->naikTingkat($nisn, $data);
            }
        }
        $kelas = "DataNaikKelas?ta=" . $this->uri->segment(3) . "&kelas=" . $this->uri->segment(4);
        redirect($kelas);
    }
}
