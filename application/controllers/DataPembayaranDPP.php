<?php
class DataPembayaranDPP extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("DataPembayaranDPP_Model");
        $this->load->model("DPPSiswa_Model");
        $this->load->library("session");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['pembayaranDPP'] = $this->DataPembayaranDPP_Model->getAllData();
        $data['dataDPP'] = $this->DPPSiswa_Model->getAllDataJoinDataSiswa();
        $data['siswaBelumLunas'] = $this->DPPSiswa_Model->getDataSiswaBelumLunas();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('DataPembayaranDPP/index', $data);
        $this->load->view('templates/footer');
    }

    /* 
        *menampilkan halaman ubah data berdasarkan nisn
    */
    public function tampilUbah($nisn)
    {
        $data['dataDPP'] = $this->DPPSiswa_Model->getDataJoinDataSiswaByNisn($nisn);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('DataPembayaranDPP/ubah', $data);
        $this->load->view('templates/footer');
    }

    public function ubahData()
    {
        $this->form_validation->set_rules("nmnl_dpp", "Nominal", "required");
        $this->form_validation->set_rules("jmlh_angsuran", "Jumlah Angsuran", "required");
        $this->form_validation->set_rules("nmnl_angsuran", "Nominal Angsuran", "required");
        $this->form_validation->set_rules("stts", "Status", "required");
        if ($this->form_validation->run() == FALSE) {
            $this->tampilUbah($this->input->post('Nisn'));
        } else {
            $this->DPPSiswa_Model->ubah_data();
            $this->session->set_flashdata('flash_dataPembayaranDPP', 'Diubah');
            redirect('DataPembayaranDPP');
        }
    }



    public function insertData()
    {
        $nisn = $this->input->post('nisnSiswa');
        $angsuran = $this->input->post('angsuran');
        $nominal = $this->input->post('nominalAngsuran');
        if (count($angsuran) > 0) {
            $this->DataPembayaranDPP_Model->insertData($nisn, $nominal, date('Y/m/d'), $angsuran);
            $this->CheckingLunas($nisn);
            $this->session->set_flashdata('flash_dataPembayaranDPP', 'berhasil');
            redirect('DataPembayaranDPP');
        } else {
            redirect('DataPembayaranDPP');
        }
    }

    /* 
       menampilkan data detail angsuran dpp
    */
    public function detailTransaksi($nisn)
    {
        $data['jumlahAngsuran'] = $this->DPPSiswa_Model->detail_data($nisn)->jumlah_angsuran;
        $data['detailAngsuran'] = $this->DataPembayaranDPP_Model->getDataAngsuranBynisn($nisn);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('DataPembayaranDPP/detailTransaksi', $data);
        $this->load->view('templates/footer');
    }
    /* 
    hapus data detail angsuran dpp
    */
    public function hapusDetailTransaksi($nisn, $noTransaksi)
    {
        $this->DataPembayaranDPP_Model->hapusAngsuran($noTransaksi);
        $this->CheckingLunas($nisn);
        redirect('DataPembayaranDPP');
    }

    public function CheckingLunas($nisn)
    {
        $dataDPP = $this->DPPSiswa_Model->detail_data($nisn);
        $dataAngsuran = $this->DataPembayaranDPP_Model->getDataBynisn($nisn);
        $totalUangAngsuran = 0;
        $totalAngsuran = 0;
        foreach ($dataAngsuran as $value) {
            $totalUangAngsuran += $value->nominal_bayar;
            $totalAngsuran++;
        }
        $checkDataUang = $dataDPP->nominal_dpp - $totalUangAngsuran;
        $checkDataAngsuran = $dataDPP->jumlah_angsuran - $totalAngsuran;
        if ($checkDataAngsuran == 0 && $checkDataUang == 0) {
            $this->DPPSiswa_Model->pelunasanDPP($nisn, 1);
        } else {
            $this->DPPSiswa_Model->pelunasanDPP($nisn, 0);
        }
    }

    public function detail_siswa($fromAjax = false)
    {
        $detailSiswa = $this->DPPSiswa_Model->get_detail_siswa($this->input->post('nisn'));
        $dataTransaksi = $this->DataPembayaranDPP_Model->getDataBynisn($this->input->post('nisn'));
        if (is_array($dataTransaksi)) {
            foreach ($dataTransaksi as $value) {
                $dataAngsuran[] = $value->angsuran;
            }
        } else {
            $dataAngsuran = false;
        }
        if ($fromAjax) {
            $data['nisn'] = $detailSiswa->nisn;
            $data['nama_siswa'] = $detailSiswa->nama_siswa;
            $data['nama_jurusan'] = $detailSiswa->nama_jurusan;
            $data['jumlah_angsuran'] = $detailSiswa->jumlah_angsuran;
            $data['nominal_dpp'] = $detailSiswa->nominal_dpp;
            $data['angsuran'] = $dataAngsuran;
            echo json_encode($data);
        }
    }

    public function bayar()
    {
        $data['siswa'] = $this->Siswa_Model->getAllData();
        // $data['ThnAjar'] = $this->TahunAjaran_Model->getAllData();
        $data['kelas'] = $this->Kelas_Model->getAllData();
        $data['JenisSpp'] = $this->Jenis_Spp_Model->getAllData();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('DataPembayaranSPP/bayar', $data);
        $this->load->view('templates/footer');
    }
}
