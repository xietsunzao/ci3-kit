<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $this->template->load('template/web/template', 'home/home_v');
    }
}

/* End of file Home.php */
