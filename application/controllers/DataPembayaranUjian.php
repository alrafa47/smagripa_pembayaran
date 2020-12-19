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


    /* 
    CREATE TABLE `tbl_tahun_ajaran` (
  `kode_ta` int(15) NOT NULL,
  `tahun_ajaran` varchar(15) NOT NULL,
  `semester` varchar(10) DEFAULT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tbl_detail_pembayaran` (
  `kode_jenispembayaran` varchar(20) NOT NULL,
  `jumlah_ke` int(5) NOT NULL,
  `no_transaksi` int(20) NOT NULL,
  `sub_total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tbl_pembayaran` (
  `no_transaksi` int(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `kode_ta` varchar(10) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tbl_jenis_pembayaran` (
  `kode_jenispembayaran` varchar(20) NOT NULL,
  `nama_pembayaran` varchar(20) NOT NULL,
  `nominal` int(20) NOT NULL,
  `tahun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


    field :
    id_pembayaran ujian
    nisn
    tanggal
    jenis pembayaran
    nominal
    tahun ajaran
    keterangan (semester : 1/2 : unbk : bulan ?)
    */
    public function tambahData($nisn)
    {

        $this->input->post('uts');
        $this->input->post('uas');
        $this->input->post('unbk');
        $tanggal = date('Y/m/d');
        // $this->
    }
}
