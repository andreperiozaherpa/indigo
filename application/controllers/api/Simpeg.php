<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Simpeg extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function update_jabatan_post()
    {
        $status = false;
        $message = '';
        $data = array();

        if (isset($_POST['nip']) && isset($_POST['nama_jabatan']) && isset($_POST['nama_skpd']) && isset($_POST['tpp']) && isset($_POST['grade'])) {
            $nip = $_POST['nip'];
            $nama_skpd = $_POST['nama_skpd'];
            $nama_jabatan = $_POST['nama_jabatan'];
            $tpp = $_POST['tpp'];
            $grade = $_POST['grade'];
        }

        $response = ['status' => $status, 'message' => $message, 'data' => $data];
        $this->response($response);
    }
}
