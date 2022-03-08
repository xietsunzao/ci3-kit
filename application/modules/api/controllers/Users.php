<?php


defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Users extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
    }

    public function getData_get()
    {
        $getWebsite = $this->Users_model->getDataUsers()->result();
        $this->response($getWebsite, 200);
        // $response = [
        //     'status' => 200,
        //     'msg' => 'hello'
        // ];
        // $this->response($response);
    }
}

/* End of file Users.php */
