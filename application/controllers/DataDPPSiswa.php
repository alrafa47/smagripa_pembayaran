
<?php

/**
 * 
 */
class DataDPPSiswa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('DPPSiswa_Model');
		$this->load->model('Siswa_Model');
		$this->load->model('Jenis_Spp_Model');
		$this->load->model('Jurusan_Model');
		$this->load->model('TahunAjaran_Model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data['dppsiswa'] = $this->DPPSiswa_Model->getAllData();
		$data['jenis_spp'] = $this->Jenis_Spp_Model->getAllData();
		$data['jurusan'] = $this->Jurusan_Model->getAllData();
		$data['tahunajaran'] = $this->TahunAjaran_Model->getAllData();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dppsiswa/index', $data);
		$this->load->view('templates/footer');
	}

	public function detail_siswa($fromAjax = false)
	{
		$detailSiswa = $this->DPPSiswa_Model->get_detail_siswa($this->input->post('nisn'));
		if ($fromAjax) {
			echo json_encode($detailSiswa);
		}
	}

	public function validation_form()
	{
		$this->form_validation->set_rules("Nisn", "nisn", "required|is_unique[tbl_dpp_siswa.nisn]|max_length[20]");
		$this->form_validation->set_rules("nmnl_dpp", "Nominal DPP", "required");
		$this->form_validation->set_rules("jmlh_angsuran", "Jumlah Angsuran", "required");
		$this->form_validation->set_rules("nmnl_angsuran", "Nominal Angsuran", "required");
		$this->form_validation->set_rules("stts", "Status", "callback_check_select_stts");
		$this->form_validation->set_rules("nm_siswa", "Nama", "required");
		$this->form_validation->set_rules("jk_siswa", "Jenis Kelamin", "callback_check_select_jk_siswa");
		$this->form_validation->set_rules("tmpt_lahir", "Tempat Lahir", "required");
		$this->form_validation->set_rules("tgl_lahir", "Tanggal Lahir", "required");
		$this->form_validation->set_rules("almat", "Alamat", "required");
		$this->form_validation->set_rules("telp_siswa", "Telp Siswa", "required");
		$this->form_validation->set_rules("kd_ta", "Kode TA", "callback_check_select_kode_ta");
		// $this->form_validation->set_rules("tahun_keluar", "Tahun keluar", "required");

		$this->form_validation->set_rules("jurusan", "Jurusan", "callback_check_select_jurusan");
		$this->form_validation->set_rules("jenis_spp", "Jenis SPP", "callback_check_select_jenis_spp");

		// $jk = ($this->input->post('jk_siswa')=="--Pilih Jenis kelamin--") ? FALSE : true ;
		// $stts = ($this->input->post('stts')=="--Pilih Status--") ? FALSE : true ;
		// $kd_ta = ($this->input->post('kd_ta')=="
		// 	<option>--Pilih Tahun Masuk--") ? FALSE : true ;
		// $jurusan = ($this->input->post('jurusan')=="--Pilih Jurusan--") ? FALSE : true ;
		// $jenis_spp = ($this->input->post('jenis_spp')=="--Pilih Jenis SPP--") ? FALSE : true ;

		// if (!$this->form_validation->run()||!$jk||!$stts||!$kd_ta||!$jurusan||!$jenis_spp) {
		// 	$this->index();
		if (!$this->form_validation->run()) {
			$this->index();
		} else {
			$this->Siswa_Model->tambah_data();
			$this->DPPSiswa_Model->tambah_data();
			$this->session->set_flashdata('flash_dppsiswa', 'Disimpan');
			redirect('DataDPPSiswa');
		}
	}

	public function check_select_jk_siswa()
	{
		if ($this->input->post('jk_siswa') == '--Pilih Jenis kelamin--') {
			$this->form_validation->set_message('check_select_jk_siswa', 'pilih jenis kelamin yang benar');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function check_select_stts()
	{
		if ($this->input->post('stts') == '--Pilih Status--') {
			$this->form_validation->set_message('check_select_stts', 'pilih status yang benar');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function check_select_kode_ta()
	{
		if ($this->input->post('kode_ta') == '--Pilih Tahun Masuk--') {
			$this->form_validation->set_message('check_select_kode_ta', 'pilih tahun ajaran yang benar');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function check_select_jurusan()
	{
		if ($this->input->post('jurusan') == '--Pilih Jurusan--') {
			$this->form_validation->set_message('check_select_jurusan', 'pilih jurusan yang benar');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function check_select_jenis_spp()
	{
		if ($this->input->post('jenis_spp') == '--Pilih Jenis SPP--') {
			$this->form_validation->set_message('check_select_jenis_spp', 'pilih jenis spp yang benar');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function hapus($kd)
	{
		$this->DPPSiswa_Model->hapus_data($kd);
		$this->session->set_flashdata('flash_dppsiswa', 'Dihapus');
		redirect('DataDPPSiswa');
	}

	public function ubah($kd)
	{
		$this->form_validation->set_rules("Nisn", "nisn", "required|max_length[5]");
		$this->form_validation->set_rules("nmnl_dpp", "Nominal", "required");
		$this->form_validation->set_rules("jmlh_angsuran", "Jumlah Angsuran", "required");
		$this->form_validation->set_rules("nmnl_angsuran", "Nominal Angsuran", "required");
		$this->form_validation->set_rules("stts", "Status", "required");
		$this->form_validation->set_rules("nm_siswa", "Nama", "required");
		$this->form_validation->set_rules("jk_siswa", "Jenis Kelamin", "required");
		$this->form_validation->set_rules("tmpt_lahir", "Tempat Lahir", "required");
		$this->form_validation->set_rules("tgl_lahir", "Tanggal Lahir", "required");
		$this->form_validation->set_rules("almat", "Alamat", "required");
		$this->form_validation->set_rules("telp_siswa", "Telp Siswa", "required");
		$this->form_validation->set_rules("kode_ta", "Kode TA", "required");
		// $this->form_validation->set_rules("tahun_keluar", "Tahun keluar", "required");
		// $this->form_validation->set_rules("jurusan", "Jurusan", "required");
		// $this->form_validation->set_rules("jenis_spp", "Jenis SPP", "required");


		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->DPPSiswa_Model->detail_data($kd);
			$data['tahunajaran'] = $this->TahunAjaran_Model->getAllData();
			$data['jurusan'] = $this->Jurusan_Model->getAllData();
			$data['jenis_spp'] = $this->Jenis_Spp_Model->getAllData();
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('dppsiswa/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->DPPSiswa_Model->ubah_data();
			$this->session->set_flashdata('flash_dppsiswa', 'DiUbah');
			redirect('DataDPPSiswa');
		}
	}
}
