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

	public function getAllDataJoinDataSiswa($jurusan = null, $tahun_awal = null, $tahun_akhir = null)
	{
		$this->db->select('tbl_siswa.nisn, nama_siswa, jk, tempat_lahir, tgl_lahir, alamat, no_telfon, tbl_jurusan.nama_jurusan, tbl_dpp_siswa.nominal_dpp, tbl_dpp_siswa.jumlah_angsuran, tbl_dpp_siswa.nominal_angsuran, status');
		$this->db->from('tbl_siswa');
		$this->db->join('tbl_jurusan', 'tbl_siswa.kode_jurusan = tbl_jurusan.kode_jurusan');
		$this->db->join('tbl_dpp_siswa', 'tbl_siswa.nisn = tbl_dpp_siswa.nisn');
		if ($jurusan != null) {
			$this->db->where('tbl_siswa.kode_jurusan', $jurusan);
		}
		if ($tahun_awal != null && $tahun_akhir != null) {
			$this->db->where('tbl_siswa.kode_ta >=', $tahun_awal);
			$this->db->where('tbl_siswa.kode_ta <=', $tahun_akhir);
		}
		return $this->db->get()->result();
	}

	public function getAllDataJoinDataSiswa_Kelas($kelas = null, $tahun_awal = null, $tahun_akhir = null)
	{
		$this->db->select('tbl_siswa.nisn, nama_siswa, jk, tempat_lahir, tgl_lahir, alamat, no_telfon, tbl_jurusan.nama_jurusan, tbl_dpp_siswa.nominal_dpp, tbl_dpp_siswa.jumlah_angsuran, tbl_dpp_siswa.nominal_angsuran, status');
		$this->db->from('tbl_siswa');
		$this->db->join('tbl_jurusan', 'tbl_siswa.kode_jurusan = tbl_jurusan.kode_jurusan');
		$this->db->join('tbl_dpp_siswa', 'tbl_siswa.nisn = tbl_dpp_siswa.nisn');
		if ($kelas != null) {
			$dataKelas = explode('_', $kelas);
			switch ($dataKelas[0]) {
				case 'X':
					$urutanKelas = 1;
					break;
				case 'XI':
					$urutanKelas = 2;
					break;
				case 'XII':
					$urutanKelas = 3;
					break;
			}
			$this->db->where('tbl_siswa.kelas_' . $urutanKelas, $kelas);
		}
		if ($tahun_awal != null) {
			$this->db->where('tbl_siswa.kode_ta', ($tahun_awal - $urutanKelas) + 1);
			// $this->db->where('tbl_siswa.kode_ta <=', $tahun_akhir);
		}
		return $this->db->get()->result();
	}

	public function getDataJoinDataSiswaByNisn($nisn)
	{
		$this->db->select('tbl_siswa.nisn, nama_siswa, jk, tempat_lahir, tgl_lahir, alamat, no_telfon, tbl_jurusan.nama_jurusan, tbl_dpp_siswa.nominal_dpp, tbl_dpp_siswa.jumlah_angsuran, tbl_dpp_siswa.nominal_angsuran, status');
		$this->db->from('tbl_siswa');
		$this->db->join('tbl_jurusan', 'tbl_siswa.kode_jurusan = tbl_jurusan.kode_jurusan');
		$this->db->join('tbl_dpp_siswa', 'tbl_siswa.nisn = tbl_dpp_siswa.nisn');
		$this->db->where('tbl_dpp_siswa.nisn', $nisn);
		return $this->db->get()->row();
	}

	public function tambah_data($nominal_angsuran)
	{
		$data = array(
			'nisn' => $this->input->post('Nisn'),
			'nominal_dpp' => $this->input->post('nmnl_dpp'),
			'jumlah_angsuran' => $this->input->post('jmlh_angsuran'),
			'nominal_angsuran' => $nominal_angsuran,
			'status' => $this->input->post('stts', true)
		);

		$this->db->insert('tbl_dpp_siswa', $data);
	}

	public function ubah_data($nominal_angsuran)
	{
		$data = array(
			'nominal_dpp' => $this->input->post('nmnl_dpp', true),
			'jumlah_angsuran' => $this->input->post('jmlh_angsuran', true),
			'nominal_angsuran' => $nominal_angsuran,
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
		$this->db->select('tbl_siswa.nisn, nama_siswa, jk, tempat_lahir, tgl_lahir, alamat, no_telfon, tbl_jurusan.nama_jurusan, tbl_dpp_siswa.nominal_dpp, tbl_dpp_siswa.jumlah_angsuran, tbl_dpp_siswa.nominal_angsuran, kelas_1, kelas_2, kelas_3');
		$this->db->from('tbl_siswa');
		$this->db->join('tbl_jurusan', 'tbl_siswa.kode_jurusan = tbl_jurusan.kode_jurusan');
		$this->db->join('tbl_dpp_siswa', 'tbl_siswa.nisn = tbl_dpp_siswa.nisn');
		$this->db->where('tbl_siswa.nisn', $id);
		return $this->db->get()->row();
	}

	/* 
	* function perngganti status lunas dan belum
	* 1 = lunas, 0 = belum
	 */
	public function pelunasanDPP($nisn, $status)
	{
		$this->db->set('status', $status);
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
	//Menampilkan modal dpp
	public function getDPP($nisn)
	{
		$this->db->select("*");
		$this->db->from("tbl_dpp_siswa");
		$this->db->where("nisn", $nisn);
		return $this->db->get()->row();
	}
}
