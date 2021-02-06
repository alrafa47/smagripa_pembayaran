<?php

/**
 * 
 */
class DataPembayaranSPP extends CI_Controller
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
		$this->load->model("DataPembayaranSPP_Model");
		$this->load->model("Siswa_Model");
		$this->load->model("Kelas_Model");
		$this->load->model("Jenis_Spp_Model");
		$this->load->library("form_validation");
	}

	public function index()
	{
		$data['dataSiswa'] = $this->DataPembayaranSPP_Model->getDataSIswaJoinJenisSPP();
		$data['kelas'] = $this->Kelas_Model->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('DataPembayaranSPP/index', $data);
		$this->load->view('templates/footer');
	}

	// search data siswa For Modal
	public function searchSiswa()
	{
		$nisn = $this->input->post('nisn');
		$result = $this->DataPembayaranSPP_Model->getDataSIswaJoinJenisSPPByNISN($nisn);
		$data['nisn'] = $result->nisn;
		$data['nama_siswa'] = $result->nama_siswa;
		$data['kode_jurusan'] = $result->kode_jurusan;
		$data['kategori'] = $result->kategori;
		$data['nominal_jenis'] = $result->nominal_jenis;
		$data['kode_jenis'] = $result->kode_jenisspp;
		$data['listPembayaran']  = $this->DataPembayaranSPP_Model->getDataPembayaranSPP($nisn);
		$data['list_tagihan'] = $this->listTagihan($nisn, $result->kode_ta, $result->tahun_keluar, $data['listPembayaran']);
		echo json_encode($data);
	}
	/* 
	* membuat form untuk list tagihan bulan apa saja yg sudah dan belum di bayar
	*/
	public function listTagihan($nisn, $start, $end, $listPembayaran)
	{
		$dataKelasSiswa = $this->Siswa_Model->detail_data($nisn);
		$semesterGanjil = [7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
		$semesterGenap = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni'];
		$listTagihan  = $this->DataPembayaranSPP_Model->getTagihanSPP($start, $end);
		$html = "<form id='formSPP' method='POST' action='" . base_url() . "DataPembayaranSPP/bayarSPP/$nisn'>";
		$html = '<div class="col-12">';
		$no = 1;

		foreach ($listTagihan as $rowTagihan) {
			if ($dataKelasSiswa['kelas_' . $no] !== null || $dataKelasSiswa['kelas_' . $no] != '') {
				# code...
				$html .= '<table class="table table-bordered">';
				$html .= '<tr>';
				$html .= '<td colspan="6">tahun Ajaran : ' . $rowTagihan->tahun_ajaran . ' , Kelas : ' . $dataKelasSiswa['kelas_' . $no] . '</td>';
				$html .= '</tr>';
				$html .= '<tr>';
				$html .= '<tr>';
				$html .= '<td colspan="6">Semester Ganjil</td>';
				$html .= '</tr>';

				foreach ($semesterGanjil as $key => $value) {
					if (isset($listPembayaran[$rowTagihan->kode_ta])) {
						if (in_array($key, $listPembayaran[$rowTagihan->kode_ta])) {
							$html .= '<td >';
							$html .= '<div class="form-group form-check"><input type="checkbox" class="form-check-input" checked disabled><label class="form-check-label">' . $value . '</label></div>';
							$html .= '</td>';
						} else {
							$html .= '<td >';
							$html .= '<div class="form-group form-check"><input type="checkbox" class="form-check-input" name="chkBulan[]" value="' . $rowTagihan->kode_ta . '-' . $dataKelasSiswa['kelas_' . $no] . '-' . $key . '"><label class="form-check-label">' . $value . '</label></div>';
							$html .= '</td>';
						}
					} else {
						$html .= '<td >';
						$html .= '<div class="form-group form-check"><input type="checkbox" class="form-check-input" name="chkBulan[]" value="' . $rowTagihan->kode_ta . '-' . $dataKelasSiswa['kelas_' . $no] . '-' . $key . '"><label class="form-check-label">' . $value . '</label></div>';
						$html .= '</td>';
					}
				}
				$html .= '</tr>';
				$html .= '<tr>';
				$html .= '<td colspan="6">Semester Genap</td>';
				$html .= '</tr>';
				$html .= '<tr>';
				foreach ($semesterGenap as $key => $value) {
					if (isset($listPembayaran[$rowTagihan->kode_ta])) {
						if (in_array($key, $listPembayaran[$rowTagihan->kode_ta])) {
							$html .= '<td >';
							$html .= '<div class="form-group form-check"><input type="checkbox" class="form-check-input" checked disabled><label class="form-check-label">' . $value . '</label></div>';
							$html .= '</td>';
						} else {
							$html .= '<td >';
							$html .= '<div class="form-group form-check"><input type="checkbox" class="form-check-input" name="chkBulan[]" value="' . $rowTagihan->kode_ta . '-' . $dataKelasSiswa['kelas_' . $no] . '-' . $key . '"><label class="form-check-label">' . $value . '</label></div>';
							$html .= '</td>';
						}
					} else {
						$html .= '<td >';
						$html .= '<div class="form-group form-check"><input type="checkbox" class="form-check-input" name="chkBulan[]" value="' . $rowTagihan->kode_ta . '-' . $dataKelasSiswa['kelas_' . $no] . '-' . $key . '"><label class="form-check-label">' . $value . '</label></div>';
						$html .= '</td>';
					}
				}
				$html .= '</tr>';
				$html .= '</table>';
				$no++;
			}
		}
		$html .= '</div>';
		$html .= '</form>';
		return $html;
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

	public function insertData()
	{
		$dataNISN = $this->input->post('dataNISN');
		$bulan = $this->input->post('chkBulan');
		$nominal = $this->input->post('nominal');
		$jenisspp = $this->input->post('jenisspp');
		if (count($bulan) > 0) {
			foreach ($bulan as $value) {
				$data = explode('-', $value);
				$this->DataPembayaranSPP_Model->insertData($dataNISN, $data[1], date('Y/m/d'), $data[2], $data[0], $jenisspp, $nominal);
			}
			$this->session->set_flashdata('flash_dataPembayaranSPP', 'berhasil');
		}
		redirect('DataPembayaranSPP');
	}

	public function detailTransaksi($nisn)
	{
		$result = $this->DataPembayaranSPP_Model->getDataSIswaJoinJenisSPPByNISN($nisn);
		$data = [
			'nisn' => $nisn,
			'nama_siswa' => $result->nama_siswa,
			'dataSiswa' => $this->Siswa_Model->detail_data($nisn),
			'ganjil' => [7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'],
			'genap' => [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni'],
			'tahunAjaran' => $this->DataPembayaranSPP_Model->getTagihanSPP($result->kode_ta, $result->tahun_keluar),
			'pembayaran' => $this->DataPembayaranSPP_Model->DetailDataPembayaranSPP($nisn)
		];

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('DataPembayaranSPP/detailTransaksi', $data);
		$this->load->view('templates/footer');
	}

	public function hapusDetailTransaksi($noTransaksi, $nisn)
	{
		$this->DataPembayaranSPP_Model->hapusTransaksi($noTransaksi);
		$this->session->set_flashdata('flash_dataPembayaranSPP', 'dihapus');
		redirect("DataPembayaranSPP/detailTransaksi/$nisn");
	}
}
