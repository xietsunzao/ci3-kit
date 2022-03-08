<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Global_model extends CI_Model
{
    public function getData($table)
    {
        return $this->db->get($table);
    }

    public function getId($id, $val, $table)
    {
        return $this->db->where($id, $val)->get($table);
    }

    public function insertData($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function updateData($id, $val, $table, $data)
    {
        return $this->db->where($id, $val)->update($table, $data);
    }

    public function deleteData($id, $val, $table)
    {
        return $this->db->where($id, $val)->delete($table);
    }
}

/* End of file Global_model.php */
