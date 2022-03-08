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

    public function saveData_post()
    {
        $website_title = $this->post('title');
        $website_url = $this->post('url');
        $data = [
            'title' => $website_title,
            'url' => $website_url
        ];
        $result = $this->Users_model->insertData($data);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }

    public function deleteUsers_delete($id = NULL)
    {
        $delete = $this->Users_model->deleteData($id);
        if ($delete === FALSE) {
            $this->response(['status' => 'failed']);
        } else {
            $this->response(['status' => 'success']);
        }
    }
}

/* End of file Users.php */
