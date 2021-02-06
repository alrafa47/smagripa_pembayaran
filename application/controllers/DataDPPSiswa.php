<?php
class DataDPPSiswa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('id_user')) {
			redirect('Login');
		}
		// if ($this->session->userdata('level') == 'siswa') {
		// 	show_404();
		// }


		$this->load->model('DPPSiswa_Model');
		$this->load->model('Siswa_Model');
		$this->load->model('Jenis_Spp_Model');
		$this->load->model('Jurusan_Model');
		$this->load->model('TahunAjaran_Model');
		$this->load->model('Kelas_Model');
		$this->load->library('form_validation');
	}

	public function cariKelas()
	{
		$nisn = $this->input->post('kode_jurusan');
		$kelas = $this->Kelas_Model->getAllData($nisn);
		$html = '';
		foreach ($kelas as $key => $row) {
			$html .= "<option value='$row->kode_kelas'>$row->kode_kelas</option>";
		}
		echo json_encode($html);
	}

	function index()
	{
		if ($this->session->userdata('level') == 'siswa') {
			show_404();
		}
		$data['dppsiswa'] = $this->DPPSiswa_Model->getAllData();
		$data['dppsiswa1'] = $this->Siswa_Model->getAllData();
		$data['jenis_spp'] = $this->Jenis_Spp_Model->getAllData();
		$data['jurusan'] = $this->Jurusan_Model->getAllData();
		$data['tahunajaran'] = $this->TahunAjaran_Model->getAllData();
		$data['kelas'] = $this->Kelas_Model->getAllData();

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
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->form_validation->set_rules("Nisn", "nisn", "required|is_unique[tbl_dpp_siswa.nisn]|max_length[20]");
		$this->form_validation->set_rules("nmnl_dpp", "Nominal DPP", "required");
		$this->form_validation->set_rules("jmlh_angsuran", "Jumlah Angsuran", "required");
		$this->form_validation->set_rules("password", "Password", "required");
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


		if (!$this->form_validation->run()) {
			$this->index();
		} else {
			$nominal = $this->input->post('nmnl_dpp');
			$jumlah = $this->input->post('jmlh_angsuran');
			$nominal_angsuran =  $nominal / $jumlah;


			$this->Siswa_Model->tambah_data();
			$this->DPPSiswa_Model->tambah_data($nominal_angsuran);
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
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->DPPSiswa_Model->hapus_data($kd);
		$this->Siswa_Model->hapus_data($kd);
		$this->session->set_flashdata('flash_dppsiswa', 'Dihapus');
		redirect('DataDPPSiswa');
	}
	public function tampildata()
	{
		$nisn = $this->input->post('nisn');
		$result = $this->DPPSiswa_Model->getDPP($nisn);
		$data['nisn'] = $result->nisn;
		$data['nominal_dpp'] = $result->nominal_dpp;
		$data['jumlah_angsuran'] = $result->jumlah_angsuran;
		$data['nominal_angsuran'] = $result->nominal_angsuran;
		$data['status'] = $result->status;
		echo json_encode($data);
	}

	public function ubah($kd)
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->form_validation->set_rules("Nisn", "nisn", "required|max_length[5]");
		$this->form_validation->set_rules("nmnl_dpp", "Nominal", "required");
		$this->form_validation->set_rules("jmlh_angsuran", "Jumlah Angsuran", "required");
		$this->form_validation->set_rules("password", "Password", "required");
		$this->form_validation->set_rules("stts", "Status", "required");
		$this->form_validation->set_rules("nm_siswa", "Nama", "required");
		$this->form_validation->set_rules("jk_siswa", "Jenis Kelamin");
		$this->form_validation->set_rules("tmpt_lahir", "Tempat Lahir");
		$this->form_validation->set_rules("tgl_lahir", "Tanggal Lahir");
		$this->form_validation->set_rules("almat", "Alamat");
		$this->form_validation->set_rules("telp_siswa", "Telp Siswa");
		$this->form_validation->set_rules("kd_ta", "Kode TA");
		$this->form_validation->set_rules("jurusan", "Jurusan");
		$this->form_validation->set_rules("jenis_spp", "Jenis SPP");


		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->DPPSiswa_Model->detail_data($kd);
			$data['ubah1'] = $this->Siswa_Model->detail_data($kd);
			$data['tahunajaran'] = $this->TahunAjaran_Model->getAllData();
			$data['jurusan'] = $this->Jurusan_Model->getAllData();
			$data['jenis_spp'] = $this->Jenis_Spp_Model->getAllData();
			$data['kelas'] = $this->Kelas_Model->getAllData();
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('dppsiswa/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$nominal = $this->input->post('nmnl_dpp');
			$jumlah = $this->input->post('jmlh_angsuran');
			$nominal_angsuran =  $nominal / $jumlah;
			$this->DPPSiswa_Model->ubah_data($nominal_angsuran);
			$this->Siswa_Model->ubah_data();
			$this->session->set_flashdata('flash_dppsiswa', 'DiUbah');
			redirect('DataDPPSiswa');
		}
	}
	public function ubahsiswa($kd)
	{
		if ($this->session->userdata('level') == 'siswa') {
			if ($this->session->userdata('id_user') != $kd) {
				show_404();
			}
		}

		$this->form_validation->set_rules("Nisn", "nisn", "required|max_length[5]");
		$this->form_validation->set_rules("password", "Password", "required");
		$this->form_validation->set_rules("nm_siswa", "Nama", "required");
		$this->form_validation->set_rules("jk_siswa", "Jenis Kelamin");
		$this->form_validation->set_rules("tmpt_lahir", "Tempat Lahir");
		$this->form_validation->set_rules("tgl_lahir", "Tanggal Lahir");
		$this->form_validation->set_rules("almat", "Alamat");
		$this->form_validation->set_rules("telp_siswa", "Telp Siswa");
		$this->form_validation->set_rules("kd_ta", "Kode TA");
		// $this->form_validation->set_rules("tahun_keluar", "Tahun keluar", "required");
		$this->form_validation->set_rules("jurusan", "Jurusan");
		$this->form_validation->set_rules("jenis_spp", "Jenis SPP");



		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->DPPSiswa_Model->detail_data($kd);
			$data['ubah1'] = $this->Siswa_Model->detail_data($kd);
			$data['tahunajaran'] = $this->TahunAjaran_Model->getAllData();
			$data['jurusan'] = $this->Jurusan_Model->getAllData();
			$data['jenis_spp'] = $this->Jenis_Spp_Model->getAllData();
			$data['kelas'] = $this->Kelas_Model->getAllData();

			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('dppsiswa/ubahsiswa', $data);
			$this->load->view('templates/footer');
		} else {

			$this->Siswa_Model->ubah_data();
			$this->session->set_flashdata('flash_dppsiswa', 'DiUbah');
			redirect('Welcome');
		}
	}
}
