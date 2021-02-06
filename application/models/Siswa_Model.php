<?php

/**
 * 
 */
class Siswa_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('tbl_siswa')->result();
	}
	public function tambah_data()
	{
		$kelas = explode('_', $this->input->post('kode_kelas'));

		$data = array(
			'nisn' => $this->input->post('Nisn'),
			'nama_siswa' => $this->input->post('nm_siswa'),
			'password' => $this->input->post('password'),
			'jk' => $this->input->post('jk_siswa'),
			'tempat_lahir' => $this->input->post('tmpt_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'alamat' => $this->input->post('almat'),
			'no_telfon' => $this->input->post('telp_siswa',),
			'kode_ta' => $this->input->post('kd_ta'),
			'tahun_keluar' => $this->input->post('thn_keluar'),
			'kode_jurusan' => $this->input->post('jurusan'),
			'kode_jenisspp' => $this->input->post('jenis_spp')
		);
		switch ($kelas[0]) {
			case 'X':
				$data['kelas_1'] = $this->input->post('kode_kelas');
				break;
			case 'XI':
				$data['kelas_2'] = $this->input->post('kode_kelas');
				break;
			case 'XII':
				$data['kelas_3'] = $this->input->post('kode_kelas');

				break;
		}

		$this->db->insert('tbl_siswa', $data);
	}

	public function ubah_data()
	{
		$kelas_1 =  ($this->input->post('kelas_1', true) == '') ? null : $this->input->post('kelas_1', true);;
		$kelas_2 =  ($this->input->post('kelas_2', true) == '') ? null : $this->input->post('kelas_2', true);;
		$kelas_3 =  ($this->input->post('kelas_3', true) == '') ? null : $this->input->post('kelas_3', true);;
		$data = array(
			'nama_siswa' => $this->input->post('nm_siswa'),
			'password' => $this->input->post('password'),
			'jk' => $this->input->post('jk_siswa'),
			'tempat_lahir' => $this->input->post('tmpt_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir', true),
			'alamat' => $this->input->post('almat', true),
			'no_telfon' => $this->input->post('telp_siswa', true),
			'kode_ta' => $this->input->post('kd_ta', true),
			'tahun_keluar' => $this->input->post('thn_keluar', true),
			'kode_jurusan' => $this->input->post('jurusan', true),
			'kelas_1' => $kelas_1,
			'kelas_2' => $kelas_2,
			'kelas_3' => $kelas_3,
			'kode_jenisspp' => $this->input->post('jenis_spp', true)
		);

		$this->db->where('nisn', $this->input->post('Nisn', true));
		$this->db->update('tbl_siswa', $data);
	}

	public function hapus_data($kode)
	{
		$this->db->delete('tbl_siswa', ['nisn' => $kode]);
	}

	public function detail_data($kode)
	{
		return $this->db->get_where('tbl_siswa', ['nisn' => $kode])->row_array();
	}

	// menampilkan data siswa join data spp dan data jurusan berdasarakan nis
	public function getDataSiswaJoinSPPjurusanByNIS($nisn)
	{
		$this->db->select("*");
		$this->db->from("tbl_siswa");
		$this->db->join("tbl_jenis_spp", "tbl_siswa.kode_jenisspp = tbl_jenis_spp.kode_jenisspp");
		$this->db->join("tbl_jurusan", "tbl_siswa.kode_jurusan = tbl_jurusan.kode_jurusan");
		$this->db->join("tbl_tahun_ajaran", "tbl_siswa.kode_ta = tbl_tahun_ajaran.kode_ta");
		$this->db->where("tbl_siswa.nisn", $nisn);
		return $this->db->get()->row();
	}

	public function getDataLaporanSPPSiswa($where)
	{
		$this->db->join("tbl_jenis_spp", "tbl_siswa.kode_jenisspp = tbl_jenis_spp.kode_jenisspp");
		return $this->db->get_where('tbl_siswa', $where)->result();
	}

	public function getDataLaporanUjianSiswa($where)
	{
		// $this->db->join("tbl_jenis_spp", "tbl_siswa.kode_jenisspp = tbl_jenis_spp.kode_jenisspp");

		return $this->db->get_where('tbl_siswa', $where)->result();
	}

	public function naikTingkat($nisn, $data)
	{
		$this->db->where('nisn', $nisn);
		$this->db->update('tbl_siswa', $data);
	}

	public function validation($username, $pass)
	{
		$this->db->where('nisn', $username);
		$this->db->where('password', $pass);
		$query = $this->db->get('tbl_siswa');
		if ($query->num_rows() >= 1) {
			return $query->row();
		}
		return false;
	}
}
