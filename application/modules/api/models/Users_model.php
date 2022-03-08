<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function getDataUsers()
    {
        return $this->db->get('website');
    }
}

/* End of file Users_model.php */
