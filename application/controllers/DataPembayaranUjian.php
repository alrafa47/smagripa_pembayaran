<?php

/**
 * 
 */
class DataPembayaranUjian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->has_userdata('id_user')) {
            redirect('Login');
        }
        if ($this->session->userdata('level') == 'siswa') {
            show_404();
        }
        $this->load->model("DataPembayaranUjian_Model");
        $this->load->model("TahunAjaran_Model");
        $this->load->model("Siswa_Model");
        $this->load->model("Kelas_Model");
        $this->load->model("Jenis_Pembayaran_Model");
        $this->load->model("DataPembayaranSPP_Model");
        $this->load->model("DataTagihanUjian_Model");
        $this->load->library("form_validation");
    }

    public function index()
    {
        $data['siswa'] = $this->Siswa_Model->getAllData();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('DataPembayaranUjian/index', $data);
        $this->load->view('templates/footer');
    }

    public function bayar($nisn)
    {
        $siswa = $this->Siswa_Model->detail_data($nisn);
        if ($siswa['tahun_keluar'] === null) {
            $tahunAjaran = $this->TahunAjaran_Model->getTagihan($siswa['kode_ta']);
        } else {
            $tahunAjaran = $this->TahunAjaran_Model->getTagihan($siswa['kode_ta'], $siswa['tahun_keluar']);
        }
        $data = [
            'kelas' => $this->Kelas_Model->getAllData($siswa['kode_jurusan']),
            'siswa' => $siswa,
            'tahunAjaran' => $tahunAjaran,
            'jenisPembayaran' => $this->Jenis_Pembayaran_Model->getAllData()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('DataPembayaranUjian/bayar', $data);
        $this->load->view('templates/footer');
    }

    public function tambahData($nisn)
    {
        $jenisPembayaran = $this->input->post('id_pembayaran');
        $data = explode('-', $this->input->post('tahunAjaran'));
        $dataPembayaran = [
            'nisn' => $nisn,
            'kode_kelas' => $data[1],
            'tanggal' => date('Y/m/d'),
            'kode_jenispembayaran' => $jenisPembayaran,
            'nominal' => $this->input->post('nominal'),
            'kode_ta' => $data[0],
            'keterangan' => $this->input->post('pembayaran')
        ];
        $this->DataPembayaranUjian_Model->tambahData($dataPembayaran);
        $this->session->set_flashdata('flash_ujian', 'Disimpan');
        redirect('DataPembayaranUjian/bayar/' . $nisn);
    }

    public function JumlahPembayaran()
    {
        $jenisPembayaran = $this->input->post('pembayaran');
        $nisn = $this->input->post('nisn');
        $ta = $this->input->post('ta');
        $idPembayaran = $this->DataTagihanUjian_Model->getData($ta)->$jenisPembayaran;
        $html = '';
        if ($ta != '-') {
            $pembayaranSiswa = $this->DataPembayaranUjian_Model->pembayaranSiswa($nisn);
            $jenisPembayaran = $this->Jenis_Pembayaran_Model->detail_data($idPembayaran);
            $nominal = $jenisPembayaran['nominal'];
            $row = 12 / $jenisPembayaran['jumlah_pembayaran'];
            $html .= "<h5> Pembayaran " . $jenisPembayaran['nama_pembayaran'] . "</h5>";
            $html .= "<div class='row'>";
            for ($i = 1; $i <=  $jenisPembayaran['jumlah_pembayaran']; $i++) {
                $pembayaranSiswa = $this->DataPembayaranUjian_Model->detailpembayaranSiswa($nisn, $idPembayaran, $i);
                if (empty($pembayaranSiswa)) {
                    $html .= "<div class='col-" . $row . "'>";
                    $html .= "<div class='form-check'>";
                    $html .= "<input class='form-check-input' type='checkbox' value='$i' name='pembayaran[]'>";
                    $html .= "<label class='form-check-label'>ke-$i</label>";
                    $html .= "</div>";
                    $html .= "</div>";
                } else {
                    $html .= "<div class='col-" . $row . "'>";
                    $html .= "<div class='form-check'>";
                    $html .= "<input class='form-check-input' type='checkbox' checked disabled>";
                    $html .= "<label class='form-check-label'>ke-$i</label>";
                    $html .= "</div>";
                    $html .= "</div>";
                }
            }
            $html .= "</div>";
        }
        $data = [
            'html' => $html,
            'nominal' => $nominal,
            'id_pembayaran' => $idPembayaran
        ];
        echo json_encode($data);
    }

    public function detailTransaksi($nisn)
    {
        $result = $this->DataPembayaranSPP_Model->getDataSIswaJoinJenisSPPByNISN($nisn);
        $data = [
            'nisn' => $nisn,
            'dataSiswa' => $this->Siswa_Model->detail_data($nisn),
            'nama_siswa' => $result->nama_siswa,
            'tahunAjaran' => $this->DataPembayaranSPP_Model->getTagihanSPP($result->kode_ta, $result->tahun_keluar),
            'pembayaranUjian' => $this->DataPembayaranUjian_Model->pembayaranSiswa($nisn)
        ];

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('DataPembayaranUjian/detailTransaksi', $data);
        $this->load->view('templates/footer');
    }

    public function hapusDetailTransaksi($noTransaksi, $nisn)
    {
        $this->DataPembayaranUjian_Model->hapusTransaksi($noTransaksi);
        $this->session->set_flashdata('flash_dataPembayaranUjian', 'dihapus');
        redirect("DataPembayaranUjian/detailTransaksi/$nisn");
    }

    public function getDataTahunAjaran()
    {
        $data['nominal'] = '';
        echo json_encode('data');
    }
}
