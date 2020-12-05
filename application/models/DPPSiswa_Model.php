<?php

/**
 * 
 */
class DPPSiswa_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('tbl_dpp_siswa')->result();
	}

	public function getAllDataJoinDataSiswa()
	{
		$this->db->select('tbl_siswa.nisn, nama_siswa, jk, tempat_lahir, tgl_lahir, alamat, no_telfon, tbl_jurusan.nama_jurusan, tbl_dpp_siswa.nominal_dpp, tbl_dpp_siswa.jumlah_angsuran, tbl_dpp_siswa.nominal_angsuran, status');
		$this->db->from('tbl_siswa');
		$this->db->join('tbl_jurusan', 'tbl_siswa.kode_jurusan = tbl_jurusan.kode_jurusan');
		$this->db->join('tbl_dpp_siswa', 'tbl_siswa.nisn = tbl_dpp_siswa.nisn');
		return $this->db->get()->result();
	}

	public function tambah_data()
	{
		$data = array(
			'nisn' => $this->input->post('Nisn'),
			'nominal_dpp' => $this->input->post('nmnl_dpp'),
			'jumlah_angsuran' => $this->input->post('jmlh_angsuran'),
			'nominal_angsuran' => $this->input->post('nmnl_angsuran'),
			'status' => $this->input->post('stts', true)
		);

		$this->db->insert('tbl_dpp_siswa', $data);
	}

	public function ubah_data()
	{
		$data = array(
			'nominal_dpp' => $this->input->post('nmnl_dpp', true),
			'jumlah_angsuran' => $this->input->post('jmlh_angsuran', true),
			'nominal_angsuran' => $this->input->post('nmnl_angsuran', true),
			'status' => $this->input->post('stts', true)
		);
		$this->db->where('nisn', $this->input->post('Nisn', true));
		$this->db->update('tbl_dpp_siswa', $data);
	}

	public function hapus_data($kode)
	{
		$this->db->delete('tbl_dpp_siswa', ['nisn' => $kode]);
	}

	public function detail_data($kode)
	{
		return $this->db->get_where('tbl_dpp_siswa', ['nisn' => $kode])->row_array();
	}

	public function get_detail_siswa($id)
	{
		$this->db->select('tbl_siswa.nisn, nama_siswa, jk, tempat_lahir, tgl_lahir, alamat, no_telfon, tbl_jurusan.nama_jurusan, tbl_dpp_siswa.nominal_dpp, tbl_dpp_siswa.jumlah_angsuran, tbl_dpp_siswa.nominal_angsuran');
		$this->db->from('tbl_siswa');
		$this->db->join('tbl_jurusan', 'tbl_siswa.kode_jurusan = tbl_jurusan.kode_jurusan');
		$this->db->join('tbl_dpp_siswa', 'tbl_siswa.nisn = tbl_dpp_siswa.nisn');
		$this->db->where('tbl_siswa.nisn', $id);
		return $this->db->get()->row();
	}

	public function pelunasanDPP($nisn)
	{
		$this->db->set('status', 1);
		$this->db->where('nisn', $nisn);
		$this->db->update('tbl_dpp_siswa');
	}

	public function getDataSiswaBelumLunas()
	{
		$this->db->select('tbl_siswa.nisn, nama_siswa, nominal_dpp, jumlah_angsuran, nominal_angsuran');
		$this->db->from('tbl_dpp_siswa');
		$this->db->join('tbl_siswa', 'tbl_siswa.nisn = tbl_dpp_siswa.nisn');
		$this->db->where('status', '0');
		return $this->db->get()->result();
	}
}
