<?php

require APPPATH . '/libraries/REST_Controller.php';
class kode_jurusan extends REST_Controller{
    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $kode_jurusan = $this->get('kode_jurusan');

        if ($kode_jurusan == '') {
            $jurusan = $this->db->get('jurusan')->result();
        } else {
            $this->db->where('kode_jurusan', $kode_jurusan);
            $jurusan = $this->db->get('jurusan')->result();
        }
        $this->response($jurusan, 200);
    }
}?>