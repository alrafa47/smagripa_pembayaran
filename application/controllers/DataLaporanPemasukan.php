
<?php

/**
 * 
 */
class DataLaporanPemasukan extends CI_Controller
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
        $this->load->model('TahunAjaran_Model');
        $this->load->model('DataPembayaranDPP_Model');
        $this->load->model('DataPembayaranSPP_Model');
        $this->load->model('DataPembayaranUjian_Model');

        $this->load->library('form_validation');
    }

    public function getLaporanPemasukan($start = null, $end = null)
    {
        $dataPemasukanDPP = $this->DataPembayaranDPP_Model->laporanPemasukanDPP($start, $end);
        $data = [];
        $total = 0;

        foreach ($dataPemasukanDPP as $value) {
            $data[] = [
                "nisn" => $value->nisn,
                "nama_siswa" => $value->nama_siswa,
                "kelas" => $value->kelas,
                "tanggal" => $value->tanggal,
                "jenis_pembayaran" => 'DPP',
                "keterangan_pembayaran" => 'angsuran ke-' . $value->angsuran,
                "nominal" => $value->nominal_bayar
            ];
            $total += $value->nominal_bayar;
        }
        $dataPemasukanSPP = $this->DataPembayaranSPP_Model->laporanPemasukanSPP($start, $end);
        foreach ($dataPemasukanSPP as $value) {
            $data[] = [
                "nisn" => $value->nisn,
                "nama_siswa" => $value->nama_siswa,
                "kelas" => $value->kode_kelas,
                "tanggal" => $value->tanggal,
                "jenis_pembayaran" => 'SPP',
                "keterangan_pembayaran" => 'bulan ke-' . $value->bulan,
                "nominal" => $value->nominal
            ];
            $total += $value->nominal;
        }
        $dataPemasukanUjian = $this->DataPembayaranUjian_Model->laporanPemasukanUjian($start, $end);
        foreach ($dataPemasukanUjian as $value) {
            $data[] = [
                "nisn" => $value->nisn,
                "nama_siswa" => $value->nama_siswa,
                "kelas" => $value->kode_kelas,
                "tanggal" => $value->tanggal,
                "jenis_pembayaran" => $value->nama_pembayaran,
                "keterangan_pembayaran" => "$value->nama_pembayaran ke $value->keterangan",
                "nominal" =>  $value->nominal
            ];
            $total += $value->nominal;
        }
        return ['laporan' => $data, 'nominal' => $total];
    }


    function index()
    {
        $data['pemasukan'] = [];
        $data['total']  = 0;
        if ($this->input->get('tanggal_awal') !== null && $this->input->get('tanggal_akhir') !== null) {
            $result = $this->getLaporanPemasukan($this->input->get('tanggal_awal'), $this->input->get('tanggal_akhir'));
            $data['pemasukan'] = $result['laporan'];
            $data['total'] =  $result['nominal'];
            function compareByTimeStamp($time1, $time2)
            {
                if (strtotime($time1['tanggal']) < strtotime($time2['tanggal']))
                    return -1;
                else if (strtotime($time1['tanggal']) > strtotime($time2['tanggal']))
                    return 1;
                else
                    return 0;
            }
            usort($data['pemasukan'], "compareByTimeStamp");
        }
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pemasukan/index', $data);
        $this->load->view('templates/footer');
    }
    public function export($start = null, $end = null)
    {

        $data['pemasukan'] = [];
        $data['total']  = 0;
        if ($start !== null && $end !== null) {
            $result = $this->getLaporanPemasukan($start, $end);
            $data['pemasukan'] = $result['laporan'];
            $data['total'] =  $result['nominal'];
            function compareByTimeStamp($time1, $time2)
            {
                if (strtotime($time1['tanggal']) < strtotime($time2['tanggal']))
                    return -1;
                else if (strtotime($time1['tanggal']) > strtotime($time2['tanggal']))
                    return 1;
                else
                    return 0;
            }
            usort($data['pemasukan'], "compareByTimeStamp");
        }
        $this->load->view('pemasukan/export', $data);
    }
}
