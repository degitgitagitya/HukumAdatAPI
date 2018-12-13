<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Content extends REST_Controller {

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
            $this->db->like('judul', $judul);
            $data = $this->db->get('content')->result();
        }

        $this->response($data, 200);
    }

    function index_post() {
        $data = array(
            'judul'      => $this->post('judul'),
            'isi'        => $this->post('isi'),
            'gambar'     => $this->post('gambar'));
        $insert = $this->db->insert('content', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('content');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


}
?>