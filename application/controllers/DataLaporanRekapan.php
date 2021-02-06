
<?php

/**
 * 
 */

defined('BASEPATH') or exit('No direct script access allowed');

require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DataLaporanRekapan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->has_userdata('id_user')) {
            redirect('Login');
        }
        // if ($this->session->userdata('level') == 'siswa') {
        //     show_404();
        // }
        $this->load->model('Siswa_Model');
        $this->load->model('Jurusan_Model');
        $this->load->model('Kelas_Model');
        $this->load->model('DataPembayaranUjian_Model');
        $this->load->model('Jenis_Pembayaran_Model');
        $this->load->model('DataPembayaranSPP_Model');
        $this->load->model('DPPSiswa_Model');
        $this->load->model('DataPembayaranDPP_Model');
        $this->load->model('TahunAjaran_Model');
        $this->load->model('DataTagihanUjian_Model');
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

    public function cekTagihanUjian($nisn, $jenis, $kode_kelas, $keterangan = null, $kode_ta)
    {
        $id_pembayaran = $this->DataTagihanUjian_Model->getData($kode_ta)->$jenis;
        $nominalPembayaranUjian = $this->Jenis_Pembayaran_Model->detail_data($id_pembayaran)['nominal'];

        $getDataSIswaJoinJenisSPP = $this->DataPembayaranUjian_Model->cekTagihanUjian($nisn, $jenis, $kode_kelas, $keterangan);
        if ($jenis == 'UNBK') {
            $nominalAngsuran = $nominalPembayaranUjian / 12;
            $Pembayaran = $nominalAngsuran * count($getDataSIswaJoinJenisSPP);
            return ($Pembayaran == $nominalPembayaranUjian) ? 0 : $nominalPembayaranUjian - $Pembayaran;
        }
        return (count($getDataSIswaJoinJenisSPP) == 1) ? 0 : $nominalPembayaranUjian;
    }


    function index()
    {
        if ($this->session->userdata('level') == 'siswa') {
            show_404();
        }
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
            $kode_ta = $value->kode_ta;
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
                        'uts1' => $this->cekTagihanUjian($value->nisn, 'UTS', $kode_kelas, 1, $kode_ta),
                        'uas1' => $this->cekTagihanUjian($value->nisn, 'UAS', $kode_kelas, 1, $kode_ta),
                        'uts2' => $this->cekTagihanUjian($value->nisn, 'UTS', $kode_kelas, 2, $kode_ta),
                        'uas2' => $this->cekTagihanUjian($value->nisn, 'UAS', $kode_kelas, 2, $kode_ta)
                    ];
                    if ($i == 3) {
                        if ($value->kelas_3 != null) {
                            $value->unbk = $this->cekTagihanUjian($value->nisn, 'UNBK', $kode_kelas, null, $kode_ta);
                        }
                    }
                }
                $kode_ta++;
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

        foreach ($dataSiswa as $key => $value) {
            $value->dpp = $this->sisaAngsuranDPP($value->nisn);
            $kode_ta = $value->kode_ta;
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
                        'uts1' => $this->cekTagihanUjian($value->nisn, 'UTS', $kode_kelas, 1, $kode_ta),
                        'uas1' => $this->cekTagihanUjian($value->nisn, 'UAS', $kode_kelas, 1, $kode_ta),
                        'uts2' => $this->cekTagihanUjian($value->nisn, 'UTS', $kode_kelas, 2, $kode_ta),
                        'uas2' => $this->cekTagihanUjian($value->nisn, 'UAS', $kode_kelas, 2, $kode_ta)
                    ];
                    if ($i == 3) {
                        if ($value->kelas_3 != null) {
                            $value->unbk = $this->cekTagihanUjian($value->nisn, 'UNBK', $kode_kelas, null, $kode_ta);
                        }
                    }
                }
                $kode_ta++;
            }
        }
        $data = [
            'dataSiswa' => $dataSiswa,
            'dataPembayaran' => $dataPembayaran,
            'dataTahunAjaran' => $this->TahunAjaran_Model->getAllData(),
            'tahunajaran' => $this->TahunAjaran_Model->getAllData(),
            'jenisPembayaran' => $this->Jenis_Pembayaran_Model->getAllData(),
            'kelas' => $this->Kelas_Model->getAllDatabyKelas(),
            'ta' => $this->TahunAjaran_Model->detail_data($ta)['tahun_ajaran'],
            'kelass' => $kelas
        ];

        $this->load->view('laporanrekapan/export', $data);
    }

    public function detail($nisn)
    {
        if ($this->session->userdata('level') == 'siswa') {
            if ($this->session->userdata('id_user') != $nisn) {
                show_404();
            }
        }
        $dataPembayaran = [];
        $dataSiswa = $this->Siswa_Model->detail_data($nisn);
        // foreach ($dataSiswa as $key => $value) {
        $dataSiswa['dpp'] = $this->sisaAngsuranDPP($dataSiswa['nisn']);
        $kode_ta = $dataSiswa['kode_ta'];
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
                    'uts1' => $this->cekTagihanUjian($dataSiswa['nisn'], 'UTS', $kode_kelas, 1, $kode_ta),
                    'uas1' => $this->cekTagihanUjian($dataSiswa['nisn'], 'UAS', $kode_kelas, 1, $kode_ta),
                    'uts2' => $this->cekTagihanUjian($dataSiswa['nisn'], 'UTS', $kode_kelas, 2, $kode_ta),
                    'uas2' => $this->cekTagihanUjian($dataSiswa['nisn'], 'UAS', $kode_kelas, 2, $kode_ta)
                ];
                if ($i == 3) {
                    if ($dataSiswa['kelas_3'] != null) {
                        $dataSiswa['unbk'] = $this->cekTagihanUjian($dataSiswa['nisn'], 'UNBK', $kode_kelas, null, $kode_ta);
                    }
                }
            }
            $kode_ta++;
        }
        // }
        $data = [
            'dataSiswa' => $dataSiswa,
            'dataPembayaran' => $dataPembayaran,
            'dataTahunAjaran' => $this->TahunAjaran_Model->getAllData(),
            'tahunajaran' => $this->TahunAjaran_Model->getAllData(),
            'jenisPembayaran' => $this->Jenis_Pembayaran_Model->getAllData(),
            'kelas' => $this->Kelas_Model->getAllDatabyKelas(),

        ];

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporanrekapan/detail', $data);
        $this->load->view('templates/footer');
    }

    public function exportsiswa($nisn)
    {
        $dataPembayaran = [];
        $dataSiswa = $this->Siswa_Model->detail_data($nisn);
        // foreach ($dataSiswa as $key => $value) {
        $dataSiswa['dpp'] = $this->sisaAngsuranDPP($dataSiswa['nisn']);
        $kode_ta = $dataSiswa['kode_ta'];
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
                    'uts1' => $this->cekTagihanUjian($dataSiswa['nisn'], 'UTS', $kode_kelas, 1, $kode_ta),
                    'uas1' => $this->cekTagihanUjian($dataSiswa['nisn'], 'UAS', $kode_kelas, 1, $kode_ta),
                    'uts2' => $this->cekTagihanUjian($dataSiswa['nisn'], 'UTS', $kode_kelas, 2, $kode_ta),
                    'uas2' => $this->cekTagihanUjian($dataSiswa['nisn'], 'UAS', $kode_kelas, 2, $kode_ta)
                ];
                if ($i == 3) {
                    if ($dataSiswa['kelas_3'] != null) {
                        $dataSiswa['unbk'] = $this->cekTagihanUjian($dataSiswa['nisn'], 'UNBK', $kode_kelas, null, $kode_ta);
                    }
                }
            }
            $kode_ta++;
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

        $this->load->view('laporanrekapan/exportsiswa', $data);
    }

    public function exportExcel($nisn, $ta)
    {
        $dataPembayaran = [];
        $dataSiswa = $this->Siswa_Model->detail_data($nisn);
        // foreach ($dataSiswa as $key => $value) {
        $dataSiswa['dpp'] = $this->sisaAngsuranDPP($dataSiswa['nisn']);
        $kode_ta = $dataSiswa['kode_ta'];
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
                    'uts1' => $this->cekTagihanUjian($dataSiswa['nisn'], 'UTS', $kode_kelas, 1, $kode_ta),
                    'uas1' => $this->cekTagihanUjian($dataSiswa['nisn'], 'UAS', $kode_kelas, 1, $kode_ta),
                    'uts2' => $this->cekTagihanUjian($dataSiswa['nisn'], 'UTS', $kode_kelas, 2, $kode_ta),
                    'uas2' => $this->cekTagihanUjian($dataSiswa['nisn'], 'UAS', $kode_kelas, 2, $kode_ta)
                ];
                if ($i == 3) {
                    if ($dataSiswa['kelas_3'] != null) {
                        $dataSiswa['unbk'] = $this->cekTagihanUjian($dataSiswa['nisn'], 'UNBK', $kode_kelas, null, $kode_ta);
                    }
                }
            }
            $kode_ta++;
        }
        // }
        $dataSiswa = $dataSiswa;
        $dataPembayaran = $dataPembayaran;
        $tahunajaran = $this->TahunAjaran_Model->detail_data($ta)['tahun_ajaran'];
        $jenisPembayaran = $this->Jenis_Pembayaran_Model->getAllData();
        $kelas = $this->Kelas_Model->getAllDatabyKelas();

        $this->load->helper('download');
        $spreadsheet = new Spreadsheet();

        // Create a new worksheet called "My Data"
        // for ($i = 0; $i < 2; $i++) {
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Data Pembayaran ' . $nisn);

        // header of excel
        $sheet = $spreadsheet->addSheet($myWorkSheet, 0);
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(30);
        $sheet->setCellValue('A1', 'RINCIAN KEKURANGAN ADMINISTRASI KEUANGAN');
        $spreadsheet->getActiveSheet(0)->mergeCells('A1:B1');
        $sheet->setCellValue('A2', 'TAHUN PELAJARAN' . " " . $tahunajaran);
        $spreadsheet->getActiveSheet(0)->mergeCells('A2:B2');

        $kelasSiswa = '-';
        for ($k = 3; $k >= 1; $k--) {
            if (!empty($dataSiswa['kelas_' . $k])) {
                $kelasSiswa =  $dataSiswa['kelas_' . $k]['kode_kelas'];
                break;
            }
        }

        $sheet->setCellValue('A5', 'Data Siswa');
        $spreadsheet->getActiveSheet(0)->mergeCells('A5:B5');

        // biodata
        $dataHeader = [
            ['NIS',  $dataSiswa['nisn']],
            ['Nama',   $dataSiswa['nama_siswa']],
            ['Kelas',   $kelasSiswa]
        ];

        $spreadsheet->getActiveSheet(0)
            ->fromArray(
                $dataHeader,
                NULL,
                'A6'
            );

        // end of header

        // body 
        // DPP
        $sheet->setCellValue('A9', 'DPP ');
        $dataDPP = ($dataSiswa['dpp'] == 0) ? '0,-' : $dataSiswa['dpp'];
        $sheet->setCellValue('B9', $dataDPP);
        $spreadsheet->getActiveSheet(0)->getStyle('B9')->getNumberFormat()->setFormatCode('#,##0.-');

        // tanggungan per kelas
        $alphabet = ['10', '11', '12'];
        $numRows = 11;
        for ($urutanKelas = 1; $urutanKelas <= 3; $urutanKelas++) {
            if (!empty($dataSiswa['kelas_' . $urutanKelas]['kode_kelas'])) {
                $sheet->setCellValue('A' . $numRows, 'Kelas ' . $alphabet[$urutanKelas - 1]);
                $spreadsheet->getActiveSheet(0)->mergeCells('A' . $numRows . ':' . 'B' . $numRows);

                $total[$urutanKelas] = $dataSiswa['kelas_' . $urutanKelas]['spp'] + $dataSiswa['kelas_' . $urutanKelas]['uts1'] + $dataSiswa['kelas_' . $urutanKelas]['uas1'] + $dataSiswa['kelas_' . $urutanKelas]['uts2'] + $dataSiswa['kelas_' . $urutanKelas]['uas2'];

                $spp = ($dataSiswa['kelas_' . $urutanKelas]['spp'] == 0) ? '0,-' : $dataSiswa['kelas_' . $urutanKelas]['spp'];
                $uts1 = ($dataSiswa['kelas_' . $urutanKelas]['uts1'] == 0) ? '0,-' : $dataSiswa['kelas_' . $urutanKelas]['uts1'];
                $uas1 = ($dataSiswa['kelas_' . $urutanKelas]['uas1'] == 0) ? '0,-' : $dataSiswa['kelas_' . $urutanKelas]['uas1'];
                $uts2 = ($dataSiswa['kelas_' . $urutanKelas]['uts2'] == 0) ? '0,-' : $dataSiswa['kelas_' . $urutanKelas]['uts2'];
                $uas2 = ($dataSiswa['kelas_' . $urutanKelas]['uas2'] == 0) ? '0,-' : $dataSiswa['kelas_' . $urutanKelas]['uas2'];
                $unbk = ($dataSiswa['unbk'] == 0) ? '0,-' : $dataSiswa['unbk'];

                if ($urutanKelas == 3) {
                    $total[$urutanKelas] += $dataSiswa['unbk'];
                }
                $arrayData = [
                    ['Kelas', $dataSiswa['kelas_' . $urutanKelas]['kode_kelas']],
                    ['Biaya SPP', $spp],
                    ['UTS Ganjil',  $uts1],
                    ['UAS Ganjil',  $uas1],
                    ['UTS Genap', $uts2],
                    ['UAS Genap',  $uas2],
                    ['Total Tanggungan Biaya Kelas ' . $alphabet[$urutanKelas - 1], $total[$urutanKelas]]
                ];

                if ($urutanKelas == 3) {
                    $arrayData = [
                        ['Kelas', $dataSiswa['kelas_' . $urutanKelas]['kode_kelas']],
                        ['Biaya SPP', $spp],
                        ['UTS Ganjil',  $uts1],
                        ['UAS Ganjil',  $uas1],
                        ['UTS Genap', $uts2],
                        ['UAS Genap',  $uas2],
                        ['UNBK',  $unbk],
                        ['Total Tanggungan Biaya Kelas ' . $alphabet[$urutanKelas - 1], $total[$urutanKelas]],
                    ];
                    $spreadsheet->getActiveSheet(0)->getStyle('B' . $numRows . ':' . 'B' . ($numRows + 8))->getNumberFormat()->setFormatCode('#,##0.-');
                }
                $spreadsheet->getActiveSheet(0)->getStyle('B' . $numRows . ':' . 'B' . ($numRows + 7))->getNumberFormat()->setFormatCode('#,##0.-');

                $dataBiayaKelas = $numRows + 1;
                $spreadsheet->getActiveSheet(0)
                    ->fromArray(
                        $arrayData,
                        NULL,
                        "A$dataBiayaKelas"
                    );
                $numRows = $numRows + 9;
            }
        }
        // total tanggungan
        $numRows += 1;
        $sheet->setCellValue('A' . $numRows, 'Total Tanggungan');
        $spreadsheet->getActiveSheet(0)->mergeCells('A' . $numRows . ':' . 'B' . $numRows);

        $numRows += 1;
        $sheet->setCellValue('A' . $numRows, 'DPP');
        $sheet->setCellValue('B' . $numRows, $dataDPP);
        $numRows += 1;
        $totalTanggungan = $dataDPP;
        for ($urutanKelas = 1; $urutanKelas <= 3; $urutanKelas++) {
            if (!empty($dataSiswa['kelas_' . $urutanKelas]['kode_kelas'])) {
                $spreadsheet->getActiveSheet(0)->getStyle('B' . $numRows)->getNumberFormat()
                    ->setFormatCode('#,##0.-');
                $sheet->setCellValue('A' . $numRows, 'Total Tanggungan kelas ' . $alphabet[$urutanKelas - 1]);
                $sheet->setCellValue('B' . $numRows, $total[$urutanKelas]);
                $numRows = $numRows + 1;
                $totalTanggungan += $total[$urutanKelas];
            }
        }
        $spreadsheet->getActiveSheet(0)->getStyle('B' . $numRows)->getNumberFormat()
            ->setFormatCode('#,##0.-');
        $sheet->setCellValue('A' . $numRows, 'total Tanggungan Biaya');
        $sheet->setCellValue('B' . $numRows, $totalTanggungan);
        // end of body

        // }

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->getStyle('A1:B' . $numRows)->applyFromArray($styleArray);
        $sheet->getStyle('B3:B' . $numRows)
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);


        $writer = new Xlsx($spreadsheet);
        $path = FCPATH . '/uploads/' . 'Tagihan Siswa ' . $dataSiswa['nama_siswa'] . '.xlsx';
        $writer->save($path);
        force_download($path, NULL);
        unlink('./uploads/Tagihan Siswa ' . $dataSiswa['nama_siswa'] . '.xlsx');
    }

    public function exportAllExcel($ta, $kelas)
    {
        $dataSiswa = [];
        if ($ta != 'lihat_semua' && $kelas != 'lihat_semua') {
            $ta = $ta;
            $kelas = $kelas;
            if ($ta != null && $kelas != null) {
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
            $kode_ta = $value->kode_ta;
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
                        'uts1' => $this->cekTagihanUjian($value->nisn, 'UTS', $kode_kelas, 1, $kode_ta),
                        'uas1' => $this->cekTagihanUjian($value->nisn, 'UAS', $kode_kelas, 1, $kode_ta),
                        'uts2' => $this->cekTagihanUjian($value->nisn, 'UTS', $kode_kelas, 2, $kode_ta),
                        'uas2' => $this->cekTagihanUjian($value->nisn, 'UAS', $kode_kelas, 2, $kode_ta)
                    ];
                    if ($i == 3) {
                        if ($value->kelas_3 != null) {
                            $value->unbk = $this->cekTagihanUjian($value->nisn, 'UNBK', $kode_kelas, null, $kode_ta);
                        } else {
                            $value->unbk = 0;
                        }
                    }
                }
                $kode_ta++;
            }
        }


        $dataTahunAjaran = $this->TahunAjaran_Model->detail_data($ta)['tahun_ajaran'];
        $kelas = $this->Kelas_Model->getAllDatabyKelas();

        $this->load->helper('download');
        $spreadsheet = new Spreadsheet();

        // Create a new worksheet called "My Data"
        $i = 0;
        foreach ($dataSiswa as $valueDataSiswa) {
            $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Data ' . $valueDataSiswa->nisn);

            // header of excel
            $sheet = $spreadsheet->addSheet($myWorkSheet, 0);
            $spreadsheet->setActiveSheetIndex(0);
            $spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(30);
            $sheet->setCellValue('A1', 'RINCIAN KEKURANGAN ADMINISTRASI KEUANGAN');
            $spreadsheet->getActiveSheet(0)->mergeCells('A1:B1');
            $sheet->setCellValue('A2', 'TAHUN PELAJARAN' . "  " . $dataTahunAjaran);
            // $sheet->setCellValue('B3', $dataTahunAjaran);
            $spreadsheet->getActiveSheet(0)->mergeCells('A2:B2');
            $sheet->setCellValue('A5', 'Data Siswa');
            $spreadsheet->getActiveSheet(0)->mergeCells('A5:B5');

            $kelasSiswa = '-';

            for ($k = 3; $k >= 1; $k--) {
                $kelas = 'kelas_' . $k;
                if (!empty($valueDataSiswa->$kelas)) {
                    $kelasSiswa =  $valueDataSiswa->$kelas['kode_kelas'];
                    break;
                }
            }

            // biodata
            $dataHeader = [
                ['NIS',  $valueDataSiswa->nisn],
                ['Nama',   $valueDataSiswa->nama_siswa],
                ['Kelas',   $kelasSiswa]
            ];

            $spreadsheet->getActiveSheet(0)
                ->fromArray(
                    $dataHeader,
                    NULL,
                    'A6'
                );

            // end of header

            // body 
            // DPP
            $sheet->setCellValue('A9', 'DPP ');
            $dataDPP = ($valueDataSiswa->dpp == 0) ? '0,-' : $valueDataSiswa->dpp;
            $sheet->setCellValue('B9', $dataDPP);
            $spreadsheet->getActiveSheet(0)->getStyle('B9')->getNumberFormat()->setFormatCode('#,##0.-');


            // tanggungan per kelas
            $alphabet = ['10', '11', '12'];
            $numRows = 11;
            $total = [];
            for ($urutanKelas = 1; $urutanKelas <= 3; $urutanKelas++) {
                $kelas = 'kelas_' . $urutanKelas;
                if (!empty($valueDataSiswa->$kelas['kode_kelas'])) {
                    $sheet->setCellValue('A' . $numRows, 'Kelas ' . $alphabet[$urutanKelas - 1]);
                    $spreadsheet->getActiveSheet(0)->mergeCells('A' . $numRows . ':' . 'B' . $numRows);
                    $total[$urutanKelas] = $valueDataSiswa->$kelas['spp'] + $valueDataSiswa->$kelas['uts1'] + $valueDataSiswa->$kelas['uas1'] + $valueDataSiswa->$kelas['uts2'] + $valueDataSiswa->$kelas['uas2'];
                    $spp = ($valueDataSiswa->$kelas['spp'] == 0) ? '0,-' : $valueDataSiswa->$kelas['spp'];
                    $uts1 = ($valueDataSiswa->$kelas['uts1'] == 0) ? '0,-' : $valueDataSiswa->$kelas['uts1'];
                    $uas1 = ($valueDataSiswa->$kelas['uas1'] == 0) ? '0,-' : $valueDataSiswa->$kelas['uas1'];
                    $uts2 = ($valueDataSiswa->$kelas['uts2'] == 0) ? '0,-' : $valueDataSiswa->$kelas['uts2'];
                    $uas2 = ($valueDataSiswa->$kelas['uas2'] == 0) ? '0,-' : $valueDataSiswa->$kelas['uas2'];

                    if ($urutanKelas == 3) {
                        $unbk = ($valueDataSiswa->unbk == 0) ? '0,-' : $valueDataSiswa->unbk;
                        $total[$urutanKelas] += $valueDataSiswa->unbk;
                    }
                    $arrayData = [
                        ['Kelas', $valueDataSiswa->$kelas['kode_kelas']],
                        ['Biaya SPP', $spp],
                        ['UTS Ganjil',  $uts1],
                        ['UAS Ganjil',  $uas1],
                        ['UTS Genap', $uts2],
                        ['UAS Genap',  $uas2],
                        ['Total Tanggungan Biaya Kelas ' . $alphabet[$urutanKelas - 1], $total[$urutanKelas]],
                    ];
                    if ($urutanKelas == 3) {
                        $arrayData = [
                            ['Kelas', $valueDataSiswa->$kelas['kode_kelas']],
                            ['Biaya SPP', $spp],
                            ['UTS Ganjil',  $uts1],
                            ['UAS Ganjil',  $uas1],
                            ['UTS Genap', $uts2],
                            ['UAS Genap',  $uas2],
                            ['UNBK',  $unbk],
                            ['Total Tanggungan Biaya Kelas ' . $alphabet[$urutanKelas - 1], $total[$urutanKelas]],
                        ];
                        $spreadsheet->getActiveSheet(0)->getStyle('B' . $numRows . ':' . 'B' . ($numRows + 8))->getNumberFormat()->setFormatCode('#,##0.-');
                    }
                    $spreadsheet->getActiveSheet(0)->getStyle('B' . $numRows . ':' . 'B' . ($numRows + 7))->getNumberFormat()->setFormatCode('#,##0.-');

                    $dataBiayaKelas = $numRows + 1;
                    $spreadsheet->getActiveSheet(0)
                        ->fromArray(
                            $arrayData,
                            NULL,
                            "A$dataBiayaKelas"
                        );
                    $numRows = $numRows + 9;
                }
            }

            // total tanggungan
            $numRows = $numRows + 1;
            $sheet->setCellValue('A' . $numRows, 'Total Tanggungan');
            $numRows = $numRows + 1;
            $sheet->setCellValue('A' . $numRows, 'DPP');
            $sheet->setCellValue('B' . $numRows, $dataDPP);
            $spreadsheet->getActiveSheet(0)->getStyle('B' . $numRows)->getNumberFormat()->setFormatCode('#,##0.-');

            $numRows = $numRows + 1;
            $totalTanggungan = $valueDataSiswa->dpp;

            for ($urutanKelas = 1; $urutanKelas <= 3; $urutanKelas++) {
                $kelas = 'kelas_' . $urutanKelas;
                if (!empty($valueDataSiswa->$kelas['kode_kelas'])) {
                    $sheet->setCellValue('A' . $numRows, 'Total Tanggungan kelas ' . $alphabet[$urutanKelas - 1]);
                    $sheet->setCellValue('B' . $numRows, $total[$urutanKelas]);
                    $spreadsheet->getActiveSheet(0)->getStyle('B' . $numRows)->getNumberFormat()->setFormatCode('#,##0.-');
                    $numRows = $numRows + 1;
                    $totalTanggungan += $total[$urutanKelas];
                }
            }


            $sheet->setCellValue('A' . $numRows, 'total Tanggugan Biaya');
            $sheet->setCellValue('B' . $numRows, $totalTanggungan);
            $spreadsheet->getActiveSheet(0)->getStyle('B' . $numRows)->getNumberFormat()
                ->setFormatCode('#,##0.-');
            // end of body

            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];


            $spreadsheet->getActiveSheet(0)->getStyle('A1:B' . $numRows)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet(0)->getStyle('B3:B' . $numRows)
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $i++;
        }
        $writer = new Xlsx($spreadsheet);
        $path = FCPATH . '/uploads/' . 'Report Data Siswa .xlsx';
        $writer->save($path);
        force_download($path, NULL);
        unlink('./uploads/Report Data Siswa.xlsx');
    }
}
