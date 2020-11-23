<<<<<<< HEAD
<?php 
=======
<?php
>>>>>>> second commit

/**
 * 
 */
class Siswa_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('tbl_siswa')->result();
	}
<<<<<<< HEAD
	public function tambah_data( )
=======
	public function tambah_data()
>>>>>>> second commit
	{
		$data = array(
			'nisn' => $this->input->post('Nisn'),
			'nama_siswa' => $this->input->post('nm_siswa'),
			'jk' => $this->input->post('jk_siswa'),
			'tempat_lahir' => $this->input->post('tmpt_lahir'),
<<<<<<< HEAD
			'tgl_lahir' => $this->input->post('tgl_lahir', true),
			'alamat' => $this->input->post('almat', true),
			'no_telfon' => $this->input->post('telp_siswa', true),
			'kode_jurusan' => $this->input->post('jurusan', true),
			'kode_jenisspp' => $this->input->post('jenis_spp', true)
=======
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'alamat' => $this->input->post('almat'),
			'no_telfon' => $this->input->post('telp_siswa',),
			'kode_ta' => $this->input->post('kd_ta'),
			'tahun_keluar' => $this->input->post('thn_keluar'),
			'kode_jurusan' => $this->input->post('jurusan'),
			'kode_jenisspp' => $this->input->post('jenis_spp')
>>>>>>> second commit
		);

		$this->db->insert('tbl_siswa', $data);
	}

<<<<<<< HEAD
	public function ubah_data( )
=======
	public function ubah_data()
>>>>>>> second commit
	{
		$data = array(
			'nama_siswa' => $this->input->post('nm_siswa'),
			'jk' => $this->input->post('jk_siswa'),
			'tempat_lahir' => $this->input->post('tmpt_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir', true),
			'alamat' => $this->input->post('almat', true),
			'no_telfon' => $this->input->post('telp_siswa', true),
<<<<<<< HEAD
=======
			'kode_ta' => $this->input->post('kd_ta', true),
			'tahun_keluar' => $this->input->post('thn_keluar', true),
>>>>>>> second commit
			'kode_jurusan' => $this->input->post('jurusan', true),
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
<<<<<<< HEAD
		return $this->db->get_where('tbl_siswa', ['nisn' => $kode]) ->row_array(); 
	}
}
?>
 ?>
=======
		return $this->db->get_where('tbl_siswa', ['nisn' => $kode])->row_array();
	}
}
>>>>>>> second commit
