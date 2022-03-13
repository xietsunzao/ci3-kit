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
        $secretKey = sodium_crypto_secretbox_keygen();
        $message = 'Sensitive information';

        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $encryptedMessage = sodium_crypto_secretbox($message, $nonce, $secretKey);

        echo json_encode(
            ['message' => $message, 'original' => $encryptedMessage],
            JSON_PRETTY_PRINT
        );

        // $response = [
        //     'status' => 200,
        //     'msg' => $encryptedMessage
        // ];
        // $this->response($response);
    }


    public function sendMessage_post()
    {

        header('Content-Type: application/json');

        $key = sodium_hex2bin('e9897cea109576c2f8088c277125d553e4f83afbc0abbb92cfb1f7b776b4fee0');

        $encrypted = $_POST['message'] ?? null;
        if (!$encrypted) {
            echo json_encode(
                ['message' => null, 'error' => 'no message provided'],
                JSON_PRETTY_PRINT
            );
            exit(1);
        }

        $nonce = sodium_hex2bin(substr($encrypted, 0, 48));
        $ciphertext = sodium_hex2bin(substr($encrypted, 48));
        $plaintext = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);

        echo json_encode(
            ['message' => $plaintext, 'original' => $encrypted],
            JSON_PRETTY_PRINT
        );
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
