<?php

/**
 * 
 */
class DataTahunAjaran extends CI_Controller
{
	public $ujian = ['UTS', 'UAS', 'UNBK'];

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('id_user')) {
			redirect('Login');
		}
		if ($this->session->userdata('level') == 'siswa') {
			show_404();
		}


		$this->load->model('TahunAjaran_Model');
		$this->load->model('Jenis_Pembayaran_Model');
		$this->load->model('DataTagihanUjian_Model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data['tahunajaran'] = $this->TahunAjaran_Model->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('tahunajaran/index', $data);
		$this->load->view('templates/footer');
	}

	public function validation_form()
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		// $this->form_validation->set_rules("kd_ta", "Kode Tahun Ajaran", "required|is_unique[tbl_tahun_ajaran.kode_ta]|max_length[5]");
		$this->form_validation->set_rules("thn_ajaran", "Tahun Ajaran", "required|is_unique[tbl_tahun_ajaran.tahun_ajaran]");
		// $this->form_validation->set_rules("smt", "Semester", "callback_check_select_semester");
		$this->form_validation->set_rules("stts", "Status", "callback_check_select_status");

		if (!$this->form_validation->run()) {
			$this->index();
		} else {
			if ($this->input->post('stts') == 'aktif') {
				if (empty($this->TahunAjaran_Model->statusAktif())) {
					$this->TahunAjaran_Model->tambah_data();
					$lastIdTahunAjar = $this->TahunAjaran_Model->lastDataTahunAjaran()->kode_ta;
					$lastDataKonfigUjian = $this->DataTagihanUjian_Model->lastDataKonfigUjian();
					$dataKonfigUjian = [
						'kode_ta' => $lastIdTahunAjar,
						'UTS' => $lastDataKonfigUjian->UTS,
						'UAS' => $lastDataKonfigUjian->UAS,
						'UNBK' => $lastDataKonfigUjian->UNBK,
					];
					$this->insertKonfigUjian($dataKonfigUjian);
					$this->session->set_flashdata('flash_tahunajaran', 'Disimpan');
				} else {
					$this->session->set_flashdata('flash_tahunajaran', 'Gagal Disimpan');
				}
			} else {
				$this->TahunAjaran_Model->tambah_data();
				$lastIdTahunAjar = $this->TahunAjaran_Model->lastDataTahunAjaran()->kode_ta;
				$lastDataKonfigUjian = $this->DataTagihanUjian_Model->lastDataKonfigUjian();
				$dataKonfigUjian = [
					'kode_ta' => $lastIdTahunAjar,
					'UTS' => $lastDataKonfigUjian->UTS,
					'UAS' => $lastDataKonfigUjian->UAS,
					'UNBK' => $lastDataKonfigUjian->UNBK,
				];
				$this->insertKonfigUjian($dataKonfigUjian);
				$this->session->set_flashdata('flash_tahunajaran', 'Disimpan');
			}
			redirect('DataTahunAjaran');
		}
	}

	public function check_select_semester()
	{
		if ($this->input->post('smt') == '--Pilih Semester--') {
			$this->form_validation->set_message('check_select_semester', 'pilih SEMESTER yang benar!!!!!!');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function check_select_status()
	{
		if ($this->input->post('stts') == '--Pilih Status--') {
			$this->form_validation->set_message('check_select_status', 'pilih STATUS yang benar!!!!!!');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function hapus($kd)
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->TahunAjaran_Model->hapus_data($kd);
		$this->DataTagihanUjian_Model->hapus_data($kd);
		$this->session->set_flashdata('flash_tahunajaran', 'Dihapus');
		redirect('DataTahunAjaran');
	}

	public function ubah($kd)
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		// $this->form_validation->set_rules("kd_ta", "Kode Tahun Ajaran", "required|max_length[5]");
		$this->form_validation->set_rules("thn_ajaran", "Tahun Ajaran", "required");
		// $this->form_validation->set_rules("smt", "Semester", "required");
		$this->form_validation->set_rules("stts", "Status", "required");
		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->TahunAjaran_Model->detail_data($kd);
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('tahunajaran/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			if ($this->input->post('stts') == 'aktif') {
				if (empty($this->TahunAjaran_Model->statusAktif())) {
					$this->TahunAjaran_Model->ubah_data();
					$this->session->set_flashdata('flash_tahunajaran', 'DiUbah');
				} else {
					$this->session->set_flashdata('flash_tahunajaran', 'Gagal DiUbah');
				}
			} else {
				$this->TahunAjaran_Model->ubah_data();
				$this->session->set_flashdata('flash_tahunajaran', 'DiUbah');
			}
			redirect('DataTahunAjaran');
		}
	}

	public function konfigurasiUjian($kode_ta)
	{
		// if ($this->session->userdata('level') != 'admin') {
		// 	show_404();
		// }
		$disabled = '';
		$tagihan = $this->DataTagihanUjian_Model->getData($kode_ta);
		$data = [
			'ujian' => $this->ujian,
			'tahunAjaran' => $this->TahunAjaran_Model->detail_data($kode_ta),
			'jenisPembayaran' => $this->Jenis_Pembayaran_Model->getAllData(),
			'disabled' => $disabled
		];
		if (!empty($tagihan)) {
			$data['tagihan'] = $tagihan;
			$data['disabled'] = 'disabled';
		}
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('tahunajaran/konfigurasi_tagihan', $data);
		$this->load->view('templates/footer');
	}


	public function insertKonfigUjian($dataKonfigUjian = null)
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		if ($dataKonfigUjian == null) {
			$kode_ta = $this->input->post('kd_ta');
			$tagihan = $this->DataTagihanUjian_Model->getData($kode_ta);
			if (empty($tagihan)) {
				$data['kode_ta'] = $kode_ta;
				foreach ($this->ujian as $valueUjian) {
					$data[$valueUjian] = $this->input->post($valueUjian);
				}
				$this->DataTagihanUjian_Model->insertData($data);
			} else {
				foreach ($this->ujian as $valueUjian) {
					$dataUpdate[$valueUjian] = $this->input->post($valueUjian);
				}
				$this->DataTagihanUjian_Model->update($dataUpdate, ['kode_ta' => $kode_ta]);
			}
		} else {
			$this->DataTagihanUjian_Model->insertData($dataKonfigUjian);
		}
		redirect('DataTahunAjaran');
	}
}
