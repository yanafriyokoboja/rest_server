<?php
header('Content-Type: application/json');
require APPPATH . '/libraries/REST_Controller.php';
class Krs extends REST_Controller{
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    function index_get() {
        $nim = $this->get('nim');
        if ($nim == '') {
            $this->db->select('*');    
            $this->db->from('krs');
            $this->db->join('mahasiswa', 'mahasiswa.nim = krs.nim');
            $this->db->join('mata_kuliah', 'mata_kuliah.kode_mk = krs.kode_mk');
            $this->db->join('jurusan', 'jurusan.kode_jurusan = krs.kode_jurusan');
            $this->db->join('dosen', 'dosen.nip = krs.nip');
            $krs = $this->db->get()->result();
        } else {
            $this->db->where('nim', $nim);
            $krs = $this->db->get('krs')->result();
        }
        $this->response($krs, 200);
    }
    // insert new data to mahasiswa
    function index_post() {
        $data = array(
                    'nim' => $this->post('nim'),
                    'kode_jurusan' => $this->post('kode_jurusan'),
                    'kode_mk' => $this->post('kode_mk'));
        $insert = $this->db->insert('krs', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    // //update
    // function index_put() {
    //     $nim = $this->put('nim');
    //     $data = array(
    //                 'nim'       => $this->put('nim'),
    //                 'kode_jurusan'=> $this->put('kode_jurusan'),
    //                 'kode_mk'    => $this->put('kode_mk'));
    //     $this->db->where('nim', $nim);
    //     $update = $this->db->update('krs', $data);
    //     if ($update) {
    //         $this->response($data, 200);
    //     } else {
    //         $this->response(array('status' => 'fail', 502));
    //     }
    // }

        // delete mahasiswa
        function index_delete() {
            $nim = $this->delete('nim');
            $this->db->where('nim', $nim);
            $delete = $this->db->delete('krs');
            if ($delete) {
                $this->response(array('status' => 'success'), 201);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }

}