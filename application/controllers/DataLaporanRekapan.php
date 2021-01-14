
<?php

/**
 * 
 */
class DataLaporanRekapan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_Model');
        $this->load->model('Jurusan_Model');
        $this->load->model('Kelas_Model');
        $this->load->model('DataPembayaranUjian_Model');
        $this->load->model('Jenis_Pembayaran_Model');
        $this->load->model('DataPembayaranSPP_Model');
        $this->load->model('DPPSiswa_Model');
        $this->load->model('DataPembayaranDPP_Model');
        $this->load->model('TahunAjaran_Model');
        $this->load->library('form_validation');
    }

    public function sisaAngsuranDPP($nisn)
    {
        $dataPembayaranDPP = $this->DPPSiswa_Model->detail_data($nisn);
        $jumlahAngsuran = $this->DataPembayaranDPP_Model->jumlahAngsuran($nisn);
        $sisaPembayaran = $dataPembayaranDPP['nominal_dpp'] - $jumlahAngsuran->nominal_bayar;
        return ($sisaPembayaran == 0) ? 0 : $sisaPembayaran;
    }

    public function sisaPembayaranSPP($nisn, $kode_kelas)
    {
        $getDataSIswaJoinJenisSPP = $this->DataPembayaranSPP_Model->getDataSIswaJoinJenisSPP($nisn);
        $jumlahAngsuran = $this->DataPembayaranSPP_Model->getJumlahPembayaran($nisn, $kode_kelas);
        $kuranganPembayaran = 12 - $jumlahAngsuran;
        $Pembayaran = $getDataSIswaJoinJenisSPP->nominal_jenis * $kuranganPembayaran;
        return ($Pembayaran == 0) ? 0 : $Pembayaran;
    }

    public function cekTagihanUjian($nisn, $jenis, $kode_kelas, $keterangan = null)
    {
        $nominalPembayaranUjian = $this->Jenis_Pembayaran_Model->detail_data($jenis)['nominal'];
        $getDataSIswaJoinJenisSPP = $this->DataPembayaranUjian_Model->cekTagihanUjian($nisn, $jenis, $kode_kelas, $keterangan);
        if ($jenis == 'unbk') {
            $nominalAngsuran = $nominalPembayaranUjian / 12;
            $Pembayaran = $nominalAngsuran * count($getDataSIswaJoinJenisSPP);
            return ($Pembayaran == $nominalPembayaranUjian) ? 0 : $nominalPembayaranUjian - $Pembayaran;
            return $Pembayaran;
        }
        return (count($getDataSIswaJoinJenisSPP) == 1) ? 0 : $nominalPembayaranUjian;
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
                        break;
                    case 'XI':
                        $data = [
                            'kode_ta' => $ta - 1,
                            'kelas_2' => $kelas
                        ];
                        $dataSiswa = $this->Siswa_Model->getDataLaporanUjianSiswa($data);
                        break;
                    case 'XII':
                        $data = [
                            'kode_ta' => $ta - 2,
                            'kelas_3' => $kelas
                        ];
                        $dataSiswa = $this->Siswa_Model->getDataLaporanUjianSiswa($data);
                        break;
                }
            }
        }
        foreach ($dataSiswa as $key => $value) {
            $value->dpp = $this->sisaAngsuranDPP($value->nisn);
            for ($i = 1; $i <= 3; $i++) {
                $kls = 'kelas_' . $i;
                // cek apakah ada kelas yang kosong
                if ($value->$kls != null) {
                    // masukan id kelas 
                    $kode_kelas = $value->$kls;
                    // perbarui array kelas
                    $value->$kls = [
                        'kode_kelas' => $kode_kelas,
                        'spp' => $this->sisaPembayaranSPP($value->nisn, $kode_kelas),
                        'uts1' => $this->cekTagihanUjian($value->nisn, 'uts', $kode_kelas, 1),
                        'uas1' => $this->cekTagihanUjian($value->nisn, 'uas', $kode_kelas, 1),
                        'uts2' => $this->cekTagihanUjian($value->nisn, 'uts', $kode_kelas, 2),
                        'uas2' => $this->cekTagihanUjian($value->nisn, 'uas', $kode_kelas, 2)
                    ];
                    if ($i == 3) {
                        if ($value->kelas_3 != null) {
                            $value->unbk = $this->cekTagihanUjian($value->nisn, 'unbk', $kode_kelas);
                        }
                    }
                }
            }
        }
        $data = [
            'dataSiswa' => $dataSiswa,
            'dataPembayaran' => $dataPembayaran,
            'dataTahunAjaran' => $this->TahunAjaran_Model->getAllData(),
            'tahunajaran' => $this->TahunAjaran_Model->getAllData(),
            'jenisPembayaran' => $this->Jenis_Pembayaran_Model->getAllData(),
            'kelas' => $this->Kelas_Model->getAllDatabyKelas()
        ];
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporanrekapan/index', $data);
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

    public function detail($nisn)
    {
        $dataPembayaran = [];
        $dataSiswa = $this->Siswa_Model->detail_data($nisn);
        // foreach ($dataSiswa as $key => $value) {
        $dataSiswa['dpp'] = $this->sisaAngsuranDPP($dataSiswa['nisn']);
        for ($i = 1; $i <= 3; $i++) {
            $kls = 'kelas_' . $i;
            // cek apakah ada kelas yang kosong
            if ($dataSiswa[$kls] != null) {
                // masukan id kelas 
                $kode_kelas = $dataSiswa[$kls];
                // perbarui array kelas
                $dataSiswa[$kls] = [
                    'kode_kelas' => $kode_kelas,
                    'spp' => $this->sisaPembayaranSPP($dataSiswa['nisn'], $kode_kelas),
                    'uts1' => $this->cekTagihanUjian($dataSiswa['nisn'], 'uts', $kode_kelas, 1),
                    'uas1' => $this->cekTagihanUjian($dataSiswa['nisn'], 'uas', $kode_kelas, 1),
                    'uts2' => $this->cekTagihanUjian($dataSiswa['nisn'], 'uts', $kode_kelas, 2),
                    'uas2' => $this->cekTagihanUjian($dataSiswa['nisn'], 'uas', $kode_kelas, 2)
                ];
                if ($i == 3) {
                    if ($dataSiswa['kelas_3'] != null) {
                        $dataSiswa['unbk'] = $this->cekTagihanUjian($dataSiswa['nisn'], 'unbk', $kode_kelas);
                    }
                }
            }
        }
        // }
        $data = [
            'dataSiswa' => $dataSiswa,
            'dataPembayaran' => $dataPembayaran,
            'dataTahunAjaran' => $this->TahunAjaran_Model->getAllData(),
            'tahunajaran' => $this->TahunAjaran_Model->getAllData(),
            'jenisPembayaran' => $this->Jenis_Pembayaran_Model->getAllData(),
            'kelas' => $this->Kelas_Model->getAllDatabyKelas()
        ];

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporanrekapan/detail', $data);
        $this->load->view('templates/footer');
    }
}
