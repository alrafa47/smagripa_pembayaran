<?php

/**
 * 
 */
class DataJurusan extends CI_Controller
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
		$this->load->model('Jurusan_Model');
		$this->load->library('form_validation');
	}

	function index()
	{

		$data['jurusan'] = $this->Jurusan_Model->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('jurusan/index', $data);
		$this->load->view('templates/footer');
	}

	public function validation_form()
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->form_validation->set_rules("kd_jur", "Kode Jurusan", "required|is_unique[tbl_jurusan.kode_jurusan]|max_length[20]");
		$this->form_validation->set_rules("nm_jur", "Nama Jurusan", "required|is_unique[tbl_jurusan.nama_jurusan]");
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->Jurusan_Model->tambah_data();
			$this->session->set_flashdata('flash_jurusan', 'Disimpan');
			redirect('DataJurusan');
		}
	}

	public function hapus($kd)
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->Jurusan_Model->hapus_data($kd);
		$this->session->set_flashdata('flash_jurusan', 'Dihapus');
		redirect('DataJurusan');
	}

	public function ubah($kd)
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->form_validation->set_rules("kd_jur", "Kode Jurusan", "required|max_length[20]");
		$this->form_validation->set_rules("nm_jur", "Nama Jurusan", "required");
		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->Jurusan_Model->detail_data($kd);
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('jurusan/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Jurusan_Model->ubah_data();
			$this->session->set_flashdata('flash_jurusan', 'DiUbah');
			redirect('DataJurusan');
		}
	}
}
