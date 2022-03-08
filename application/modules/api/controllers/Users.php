<?php


defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Users extends RestController
{
    public function getData_get()
    {
        $response = [
            'status' => 200,
            'msg' => 'hello'
        ];
        $this->response($response);
    }
}

/* End of file Users.php */
