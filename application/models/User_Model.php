<?php
class User_Model extends CI_Model
{
    /* 
    * mengambil semua data rumusan
    * param : hari(null), id kelas(null)
    */
    public function getData()
    {
        return $this->db->get('user')->result();
    }

    public function validation($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query =  $this->db->get('user');
        if ($query->num_rows() >= 1) {
            return $query->row();
        }
    }
    /* 
    * delete semua data rumusan
    */
    public function deleteData($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('rumusan');
    }
    /* 
    * tambah data
    */
    public function tambah_data($data)
    {
        $this->db->insert('user', $data);
    }

    public function detail_data($id)
    {
        return $this->db->get_where('user', ['id_user' => $id])->row_array();
    }

    public function ubah_data($id, $data)
    {
        $this->db->update('user', $data, ['id_user' => $id]);
    }
}
