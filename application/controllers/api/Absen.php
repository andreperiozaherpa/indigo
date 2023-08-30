<?php
defined('BASEPATH') or exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Absen extends REST_Controller
{
    public function __construct()
	{
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("absen_model");
    }

    /*
    versi 1 sudah tidak digunakan
    public function inquiry_get()
    {
        $headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);


		if ($api_key != null && $cekApi) {
      if(date("Y-m-d") < '2020-09-11'){
            $id_pegawai = $cekApi->id_pegawai;

            $jenis = "";
            $error = false;
            $message = "";
            $tempat = "rumah";

            $today = date('Y-m-d');

                if(!$this->absen_model->isHoliday($today)){

                    $param['where']['absen_log.id_pegawai'] = $id_pegawai;
                    $param['where']['absen_log.tanggal'] = date('Y-m-d');

                    $absen_log = $this->absen_model->get_log($param);

                    if($absen_log->num_rows()==0)
                    {
                        $jenis = "masuk";
                    }
                    else{
                        $absen = $absen_log->row();
                        if($absen->jam_masuk==null)
                        {
                            $jenis = "masuk";
                        }
                        elseif($absen->jam_pulang==null){
                            $jenis = "pulang";
                        }
                        else{
                            $error = true;
                            $message = "Anda sudah absen hari ini.";
                        }
                    }
                }
                else{
                    $error = true;
                    $message = "Hari ini libur.";
                }

            $response = [
                'error'	        => $error,
                'message'       => $message,
                'jenis'         => $jenis,
                'tempat'        => $tempat,
            ];

          }
          else{
            $response = [
      				'error'	=> true,
      				'message' => 'Skema shift belum diatur. Silahkan update aplikasi anda.',
      			];
          }
        }
        else{
            $response = [
      				'error'	=> true,
      				'message' => 'Invalid credential',
      			];
        }

        $this->response($response);
    }

    */

    public function insert_log_post()
    {
        $headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);

        $tempat = $this->input->post("tempat");
        $jenis = $this->input->post("jenis");
        $latitude = $this->input->post("latitude");
        $longitude = $this->input->post("longitude");
        $foto = $this->input->post("foto");



		if ($api_key != null && $cekApi) {
            $id_pegawai = $cekApi->id_pegawai;

            if($jenis && $latitude && $longitude && $tempat && $foto && $latitude!="null" && $longitude!="null"){

                $file = $cekApi->username."_".uniqid().".png";
                $ImagePath = "./data/absen/foto/".$file;
                file_put_contents($ImagePath,base64_decode($foto));

                $log = array();
                $log['tempat'] = $tempat;
                $message = "";
                if($jenis=="masuk"){
                    $log['latitude_masuk'] = $latitude;
                    $log['longitude_masuk'] = $longitude;
                    $log['jam_masuk'] = date('H:i:s');
                    $log['foto_masuk'] = $file;
                    $message = "Absen masuk berhasil";
                }
                else if($jenis=="pulang"){
                    $log['latitude_pulang'] = $latitude;
                    $log['longitude_pulang'] = $longitude;
                    $log['jam_pulang'] = date('H:i:s');
                    $log['foto_pulang'] = $file;
                    $message = "Absen pulang berhasil";
                }




                $param['where']['absen_log.id_pegawai'] = $id_pegawai;
                $param['where']['absen_log.tanggal'] = date('Y-m-d');

                $absen_log = $this->absen_model->get_log($param);

                if($absen_log->num_rows()==0)
                {
                    $log['id_pegawai'] = $id_pegawai;
                    $log['tanggal'] = date('Y-m-d');
                    $log['masuk_telat'] = $this->absen_model->get_masuk_telat($id_pegawai,$log['jam_masuk']);
                    $this->db->insert("absen_log",$log);
                }
                else{
                    $absen = $absen_log->row();
                    $log['pulang_cepat'] = $this->absen_model->get_pulang_cepat($id_pegawai,$log['jam_pulang']);
                    $log['waktu_kerja'] = $this->absen_model->get_waktu_kerja($id_pegawai,$absen->jam_masuk ,$log['jam_pulang']);
                    $this->db->where("id_log",$absen->id_log);
                    $this->db->update("absen_log",$log);
                }
                $response = [
                    'error'	=> false,
                    'message' => $message,
                ];
            }
            else{
                $response = [
                    'error'	=> true,
                    'message' => 'Invalid data',
                ];
            }

        }
        else{
            $response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
        }

        $this->response($response);
    }

    public function inquiry_v2_get()
    {
        $headers = $this->input->request_headers();
    		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
    		$cekApi = $this->user_model->checkApiKey($api_key);


    		if ($api_key != null && $cekApi) {
            $id_pegawai = $cekApi->id_pegawai;
            $inquiry = $this->absen_model->inquiry($id_pegawai);
            $response = [
                'error'	        => $inquiry['error'],
                'message'       => $inquiry['message'],
                'jenis'         => $inquiry['jenis'],
                'tempat'        => $inquiry['tempat'],
            ];

        }
        else{
            $response = [
      				'error'	=> true,
      				'message' => 'Invalid credential',
      			];
        }

        $this->response($response);
    }

    public function inquiry_v3_post()
    {
        $headers = $this->input->request_headers();
    	$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
    	$cekApi = $this->user_model->checkApiKey($api_key);

        $authorization = (!empty($headers['app_key'])) ? $headers['app_key'] : null;
		$authorization = (!empty($headers['App-Key'])) ? $headers['App-Key'] : $authorization;

        if ($authorization == $this->config->item('authorization'))
        {

            if ($api_key != null && $cekApi) {
                $latitude = $this->input->post("latitude");
                $longitude = $this->input->post("longitude");
                $dinas_dalam = $this->input->post("dinas_dalam");
                if($latitude && $longitude){
                    $id_pegawai = $cekApi->id_pegawai;
                    $param = array(
                        'radius'  => true,
                        'latitude' => $latitude,
                        'longitude' => $longitude
                    );
                    if($dinas_dalam)
                    {
                        $param['dinas_dalam'] = true;
                    }
                    $inquiry = $this->absen_model->inquiry($id_pegawai,$param);
                    $response = [
                        'error'	        => $inquiry['error'],
                        'message'       => $inquiry['message'],
                        'jenis'         => $inquiry['jenis'],
                        'tempat'        => $inquiry['tempat'],
                    ];
                }
                else{
                    $response = [
                            'error'	=> true,
                            'message' => 'Invalid data',
                        ];
                }

            }
            else{
                $response = [
                        'error'	=> true,
                        'message' => 'Invalid credential',
                    ];
            }
        }
        else{
            $response = [
                'error'	=> true,
                'message' => 'Invalid Token. Silahkan update aplikasi ke versi terbaru.',
            ];
        }

        $this->response($response);
    }

    public function insert_log_v2_post()
    {
        $headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);

        $tempat = $this->input->post("tempat");
        $jenis = $this->input->post("jenis");
        $latitude = $this->input->post("latitude");
        $longitude = $this->input->post("longitude");
        $foto = $this->input->post("foto");


        $authorization = (!empty($headers['app_key'])) ? $headers['app_key'] : null;
		$authorization = (!empty($headers['App-Key'])) ? $headers['App-Key'] : $authorization;

        if ($authorization == $this->config->item('authorization'))
        {

            if ($api_key != null && $cekApi) {
                $id_pegawai = $cekApi->id_pegawai;

                if($jenis && $latitude && $longitude  && $foto && $latitude!="null" && $longitude!="null" ){

                    $file = $cekApi->username."_".uniqid().".png";
                    $ImagePath = "./data/absen/foto/".$file;
                    file_put_contents($ImagePath,base64_decode($foto));

                    $log = array();
                    $log['tempat'] = $tempat;
                    $message = "";

                    $param_shift_setting['where']['absen_shift_setting.id_pegawai'] = $id_pegawai;
                    $shift_setting = $this->absen_model->get_shift_setting($param_shift_setting)->row();

                    $param_shift['where']['absen_shift.id_shift'] = $shift_setting->aktif_shift;
                    $shift = $this->absen_model->get_shift($param_shift)->row();

                    $param['where']['absen_log.id_pegawai'] = $id_pegawai;
                    $param['where']['absen_log.tanggal'] = date('Y-m-d');

                    if($jenis=="masuk"){
                        $log['latitude_masuk'] = $latitude;
                        $log['longitude_masuk'] = $longitude;
                        $log['jam_masuk'] = date('H:i:s');
                        $log['foto_masuk'] = $file;
                        $log['id_shift'] = $shift_setting->aktif_shift;
                        $message = "Absen masuk berhasil";
                    }
                    else if($jenis=="pulang"){
                        $log['latitude_pulang'] = $latitude;
                        $log['longitude_pulang'] = $longitude;
                        $log['jam_pulang'] = date('H:i:s');
                        $log['foto_pulang'] = $file;

                        $message = "Absen pulang berhasil";

                        if($shift->flag=="beda_hari")
                        {
                        $param['where']['absen_log.tanggal'] = date("Y-m-d",strtotime(date("Y-m-d")." -1 days"));
                        }
                    }


                    $absen_log = $this->absen_model->get_log($param);

                    if($absen_log->num_rows()==0)
                    {
                        $log['id_pegawai'] = $id_pegawai;
                        $log['tanggal'] = date('Y-m-d');
                        $log['masuk_telat'] = $this->absen_model->get_masuk_telat($id_pegawai,$log['jam_masuk']);
                        $this->db->insert("absen_log",$log);
                    }
                    else{
                        $absen = $absen_log->row();
                        $log['pulang_cepat'] = $this->absen_model->get_pulang_cepat($id_pegawai,$log['jam_pulang']);
                        $log['waktu_kerja'] = $this->absen_model->get_waktu_kerja($id_pegawai,$absen->jam_masuk ,$log['jam_pulang']);
                        $this->db->where("id_log",$absen->id_log);
                        $this->db->update("absen_log",$log);
                    }
                    $response = [
                        'error'	=> false,
                        'message' => $message,
                    ];
                }
                else{
                    $response = [
                        'error'	=> true,
                        'message' => 'Invalid data',
                    ];
                }

            }
            else{
                $response = [
                    'error'	=> true,
                    'message' => 'Invalid credential',
                ];
            }
        }
        else{
            $response = [
                'error'	=> true,
                'message' => 'Invalid Token. Silahkan update aplikasi ke versi terbaru.',
            ];
        }

        $this->response($response);
    }

    public function shift_get()
    {
        $headers = $this->input->request_headers();
    		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
    		$cekApi = $this->user_model->checkApiKey($api_key);


    		if ($api_key != null && $cekApi) {
            $id_pegawai = $cekApi->id_pegawai;
            $shift = $this->absen_model->get_shift()->result();
            $param['where']['absen_shift_setting.id_pegawai'] = $id_pegawai;
            $shift_setting = $this->absen_model->get_shift_setting($param)->row();

            if(!$shift_setting)
            {
              $shift_setting = new stdClass();
              $shift_setting->aktif_shift = "";
              $shift_setting->id_shift = "";
            }

            $response = [
                'error'	     => false,
                'shift'       => $shift,
                'setting'   => $shift_setting,
            ];

        }
        else{
            $response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
        }

        $this->response($response);
    }


    public function change_shift_post()
    {
        $headers = $this->input->request_headers();
    		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
    		$cekApi = $this->user_model->checkApiKey($api_key);

        $id_shift = $this->input->post("id_shift");

    		if ($api_key != null && $cekApi) {
          if($id_shift){
            $id_pegawai = $cekApi->id_pegawai;
            $this->absen_model->change_shift($id_pegawai,$id_shift);

            $response = [
                'error'	     => false,
                'message'    => "Skema shift telah diubah",
            ];
          }
          else{
            $response = [
      				'error'	=> true,
      				'message' => 'Invalid data',
  			     ];
          }

        }
        else{
            $response = [
    				'error'	=> true,
    				'message' => 'Invalid credential',
			     ];
        }

        $this->response($response);
    }


}
