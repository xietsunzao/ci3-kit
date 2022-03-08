<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function getDataUsers()
    {
        return $this->db->get('website');
    }

    public function insertData($data)
    {
        return $this->db->insert('website', $data);
    }

    public function deleteData($id)
    {
        return $this->db->where('id', $id)->delete('website');
    }
}

/* End of file Users_model.php */
