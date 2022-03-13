<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{
    public function index()
    {
        $this->load->view('chat_v');
    }
}

/* End of file Chat.php */
