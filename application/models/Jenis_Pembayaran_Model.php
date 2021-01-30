<?php

/**
 * 
 */
class Jenis_Pembayaran_Model extends CI_Model
{
	public function getAllData($where = null)
	{
		if ($where == null) {
			$this->db->join('tbl_tahun_ajaran', 'tbl_jenis_pembayaran.kode_ta = tbl_tahun_ajaran.kode_ta');
			return $this->db->get('tbl_jenis_pembayaran')->result();
		} else {
			$this->db->join('tbl_tahun_ajaran', 'tbl_jenis_pembayaran.kode_ta = tbl_tahun_ajaran.kode_ta');
			return $this->db->get_where('tbl_jenis_pembayaran', $where)->result();
		}
	}
	public function getAllDataTahun($kode_ta = null)
	{
		$this->db->select('kode_jenispembayaran, nama_pembayaran, tbl_tahun_ajaran.tahun_ajaran, nominal,jumlah_pembayaran, tbl_jenis_pembayaran.kode_ta');
		$this->db->from('tbl_jenis_pembayaran');
		$this->db->join('tbl_tahun_ajaran', 'tbl_tahun_ajaran.kode_ta = tbl_jenis_pembayaran.kode_ta');
		if ($kode_ta != null) {
			$this->db->where('tbl_jenis_pembayaran.tahun', $kode_ta);
		}
		return $this->db->get()->result();
	}


	public function tambah_data()
	{
		$data = array(
			'kode_jenispembayaran' => $this->input->post('kode_jenispembayaran', true),
			'nama_pembayaran' => $this->input->post('nama_pembayaran', true),
			'nominal' => $this->input->post('nominal', true),
			'kode_ta' => $this->input->post('kd_ta', true),
			'jumlah_pembayaran' => $this->input->post('jumlah_pembayaran', true)
		);

		$this->db->insert('tbl_jenis_pembayaran', $data);
	}

	public function ubah_data()
	{
		$data = array(
			'nama_pembayaran' => $this->input->post('nama_pembayaran', true),
			'nominal' => $this->input->post('nominal', true),
			'kode_ta' => $this->input->post('kd_ta', true),
			'jumlah_pembayaran' => $this->input->post('jumlah_pembayaran', true)
		);
		$this->db->where('kode_jenispembayaran', $this->input->post('kode_jenispembayaran', true));
		$this->db->update('tbl_jenis_pembayaran', $data);
	}

	public function hapus_data($kode)
	{
		$this->db->delete('tbl_jenis_pembayaran', ['kode_jenispembayaran' => $kode]);
	}

	public function detail_data($kode)
	{
		return $this->db->get_where('tbl_jenis_pembayaran', ['kode_jenispembayaran' => $kode])->row_array();
	}
}
