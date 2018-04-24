<?php
require APPPATH . '/libraries/REST_Controller.php';

class Dosen extends REST_Controller{
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    //menampilkan
    function index_get() {
        $nip = $this->get('nip');
        if ($nip == '') {
            $dosen = $this->db->get('dosen')->result();
        } else {
            $this->db->where('nip', $nip);
            $dosen = $this->db->get('dosen')->result();
        }
        $this->response($dosen, 200);
    }
    //insert dosen
    function index_post() {
        $data = array(
                    'nip'           => $this->post('nip'),
                    'nama_dosen'          => $this->post('nama_dosen'),
                    'alamat'        => $this->post('alamat'));
        $insert = $this->db->insert('dosen', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    //edit data mahasiswa
    function index_put() {
        $nip = $this->put('nip');
        $data = array(
                    'nip'       => $this->put('nip'),
                    'nama_dosen'      => $this->put('nama_dosen'),
                    'alamat'    => $this->put('alamat'));
        $this->db->where('nip', $nip);
        $update = $this->db->update('dosen', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $nip = $this->delete('nip');
        $this->db->where('nip', $nip);
        $delete = $this->db->delete('dosen');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
}