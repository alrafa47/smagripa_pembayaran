<?php

/**
 * 
 */
class TahunAjaran_Model extends CI_Model
{
	public $tahunAjaranAktif  = '';
	public function __construct()
	{
		$taAktif = $this->statusAktif();
		if (!empty($taAktif)) {
			$this->tahunAjaranAktif = $taAktif->kode_ta;
		}
	}

	public function statusAktif()
	{
		return $this->db->get_where('tbl_tahun_ajaran', ['status' => 'aktif'])->row();
	}

	public function getAllData()
	{
		return $this->db->get('tbl_tahun_ajaran')->result();
	}

	public function getTagihan($start, $end = 0)
	{
		$this->db->select('kode_ta, tahun_ajaran');
		$this->db->from('tbl_tahun_ajaran');
		$this->db->where('kode_ta >=', $start);
		if ($end != null) {
			$this->db->where('kode_ta <=', $end);
		} else {
			$this->db->where('kode_ta <=', $this->tahunAjaranAktif);
		}
		return $this->db->get()->result();
	}

	public function tambah_data()
	{
		$query = $this->db->query('select *from tbl_tahun_ajaran order by kode_ta desc');
		if ($query->num_rows() == 0) {
			$id = 1;
		} else {
			$id = $query->row('kode_ta') + 1;
		}
		$data = array(
			'kode_ta' => $id,
			'tahun_ajaran' => $this->input->post('thn_ajaran'),
			'status' => $this->input->post('stts')
			// 'semester' => $this->input->post('smt')
		);

		$this->db->insert('tbl_tahun_ajaran', $data);
	}

	public function ubah_data()
	{
		$data = array(
			'tahun_ajaran' => $this->input->post('thn_ajaran', true),
			'status' => $this->input->post('stts', true)
			// 'semester' => $this->input->post('smt', true)
		);

		$this->db->where('kode_ta', $this->input->post('kd_ta', true));
		$this->db->update('tbl_tahun_ajaran', $data);
	}

	public function hapus_data($kode)
	{
		$this->db->delete('tbl_tahun_ajaran', ['kode_ta' => $kode]);
	}

	public function detail_data($kode)
	{
		return $this->db->get_where('tbl_tahun_ajaran', ['kode_ta' => $kode])->row_array();
	}

	public function lastDataTahunAjaran()
	{
		$this->db->order_by('kode_ta', 'DESC');
		return $this->db->get('tbl_tahun_ajaran')->row();
	}
	public function checkForeign($id)
	{
		$where = ['kode_ta' => $id];
		$where2 = ['tahun_keluar' => $id];
		$query1 = $this->db->get_where('tbl_jenis_pembayaran', $where);
		$query2 = $this->db->get_where('tbl_pembayaran_spp', $where);
		$query3 = $this->db->get_where('tbl_pembayaran_ujian', $where);
		$query4 = $this->db->get_where('tbl_siswa', $where);
		$query5 = $this->db->get_where('tbl_siswa', $where2);
		if ($query1->num_rows() >= 1 || $query2->num_rows() >= 1 || $query3->num_rows() >= 1 || $query4->num_rows() >= 1 || $query5->num_rows() >= 1) {
			return true;
		}
		return false;
	}
}
