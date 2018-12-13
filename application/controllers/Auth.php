<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        $id = $this->get('id');
        $judul = $this->get('username');
        if ($id == '') {
            $data = $this->db->get('auth')->result();
        } else {
            $this->db->where('id', $id);
            $data = $this->db->get('auth')->result();
        }
        if ($judul != ''){
            $this->db->where('username', $judul);
            $data = $this->db->get('auth')->result();
        }

        $this->response($data, 200);
    }


}
?>