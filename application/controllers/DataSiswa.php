<?php

/**
 * 
 */
class DataSiswa extends CI_Controller
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
		$this->load->library('form_validation');
	}

	function index()
	{
		$data['dppsiswa'] = $this->DPPSiswa_Model->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dppsiswa/index', $data);
		$this->load->view('templates/footer');
	}

	public function validation_form()
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->form_validation->set_rules("Nisn", "nisn", "required|is_unique[tbl_dpp_siswa.nisn]|max_length[5]");
		$this->form_validation->set_rules("nmnl_dpp", "Nominal DPP", "required");
		$this->form_validation->set_rules("jmlh_angsuran", "Jumlah Angsuran", "required");
		$this->form_validation->set_rules("nmnl_angsuran", "Nominal Angsuran", "required");
		$this->form_validation->set_rules("stts", "Status", "required");
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->DPPSiswa_Model->tambah_data();
			$this->session->set_flashdata('flash_dppsiswa', 'Disimpan');
			redirect('DataDPPSiswa');
		}
	}

	public function hapus($kd)
	{
		if ($this->session->userdata('level') != 'admin') {
			show_404();
		}
		$this->DPPSiswa_Model->hapus_data($kd);
		$this->session->set_flashdata('flash_dppsiswa', 'Dihapus');
		redirect('DataDPPSiswa');
	}

	public function tampildata()
	{
		$nisn = $this->input->post('nisn');
		$result = $this->Siswa_Model->getDataSiswaJoinSPPjurusanByNIS($nisn);
		$data['nisn'] = $result->nisn;
		$data['nama_siswa'] = $result->nama_siswa;
		$data['password'] = $result->password;
		$data['jk'] = $result->jk;
		$data['tempat_lahir'] = $result->tempat_lahir;
		$data['tgl_lahir'] = $result->tgl_lahir;
		$data['alamat'] = $result->alamat;
		$data['no_telfon'] = $result->no_telfon;
		$data['tahun_ajaran'] = $result->tahun_ajaran;
		$data['jurusan'] = $result->nama_jurusan;
		$data['kelas_1'] = $result->kelas_1;
		$data['kelas_2'] = $result->kelas_2;
		$data['kelas_3'] = $result->kelas_3;
		$data['jenis_spp'] = "$result->nominal_jenis-$result->kategori";
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
		$this->form_validation->set_rules("nmnl_angsuran", "Nominal Angsuran", "required");
		$this->form_validation->set_rules("stts", "Status", "required");

		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->DPPSiswa_Model->detail_data($kd);
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
