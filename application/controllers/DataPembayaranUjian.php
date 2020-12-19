<?php

/**
 * 
 */
class DataPembayaranUjian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("DataPembayaranUjian_Model");
        $this->load->model("TahunAjaran_Model");
        $this->load->model("Siswa_Model");
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
            'siswa' => $siswa,
            'tahunAjaran' => $tahunAjaran
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('DataPembayaranUjian/bayar', $data);
        $this->load->view('templates/footer');
    }
}
