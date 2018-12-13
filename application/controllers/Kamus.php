<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kamus extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        $id = $this->get('id');
        $judul = $this->get('judul');
        if ($id == '') {
            $data = $this->db->get('content')->result();
        } else {
            $this->db->where('id', $id);
            $data = $this->db->get('content')->result();
        }
        if ($judul != ''){
            $this->db->like('judul', $judul, 'after');
            $data = $this->db->get('content')->result();
        }

        $this->response($data, 200);
    }


}
?>