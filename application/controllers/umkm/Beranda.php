<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller{
    public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

		if (!$this->user_id) {
            redirect('admin');
        }

		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$this->id_skpd	= $this->user_model->id_skpd;
		$array_privileges = explode(';', $this->user_privileges);

		if ($this->user_level == "Administrator" OR in_array('umkm', $array_privileges)) {	}
		else{show_404();}

		// $this->load->model("sigesit/Globalvar");
		// $this->load->model("sigesit/Aktivitas_model");
	}

    public function index()
    {
        if ($this->user_id)
		{
			$data['title']		= "UMKM - E-OFFICE ";
			$data['content']	= "umkm/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "umkm";
        
            $data['kecamatan'] = $this->curl_get('https://e-officedesa.sumedangkab.go.id/api_bungadesa_umkm/kecamatan',$_GET);
            $data['desa'] = $this->curl_get('https://e-officedesa.sumedangkab.go.id/api_bungadesa_umkm/desa_skpd',$_GET);
            $data['umkm'] = $this->curl_get('https://e-officedesa.sumedangkab.go.id/api_bungadesa_umkm/eoffice',$_GET);
			// $data['item'] = $this->agenda_harian_m->get_all();
			$this->load->view('admin/index',$data);

		}
		    else
		{
			redirect('admin');
		}
    }
    public function view($slug)
    {
        if ($this->user_id)
		{
			$data['title']		= "UMKM DETAIL - E-OFFICE ";
			$data['content']	= "umkm/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "umkm";
        
            $detail = $this->curl_get('https://e-officedesa.sumedangkab.go.id/api_bungadesa_umkm/detail',['slug' => $slug]);
            $data['detail'] = $detail->data;
            $data['katalog'] = $detail->katalog;
            $data['foto'] = $detail->foto;

            $data['kategori_kbli_arr'] = array();

			if ($data['detail']->kategori_kbli) {
				$arr_kategori_kbli = explode(";", $data['detail']->kategori_kbli);
				$data['kategori_kbli_arr'] = $this->curl_get('https://e-officedesa.sumedangkab.go.id/api_bungadesa_umkm/kbli_arr',$arr_kategori_kbli);
			}

            $data['provinsi_all'] = $this->curl_get('https://e-officedesa.sumedangkab.go.id/api_bungadesa_umkm/provinsi_office',null);
            $data['kabupaten_all'] = $this->curl_get('https://e-officedesa.sumedangkab.go.id/api_bungadesa_umkm/kabupaten_office',['id_provinsi' => $data['detail']->id_provinsi_pemilik]);
            $data['kecamatan_all'] = $this->curl_get('https://e-officedesa.sumedangkab.go.id/api_bungadesa_umkm/kecamatan_office',['id_kabupaten' => $data['detail']->id_kabupaten_pemilik]);
            $data['desa_all'] = $this->curl_get('https://e-officedesa.sumedangkab.go.id/api_bungadesa_umkm/desa_office',['id_kecamatan' => $data['detail']->id_kecamatan_pemilik]);
            $data['desa'] = $this->curl_get('https://e-officedesa.sumedangkab.go.id/api_bungadesa_umkm/desa_kabupaten',['id_kabupaten' => 3211]);
			// $data['item'] = $this->agenda_harian_m->get_all();
			$this->load->view('admin/index',$data);

		}
		    else
		{
			redirect('admin');
		}
    }

    public function verifikasi_umkm($id,$slug)
    {
        if($this->user_id)
        {
            $data = [
                'id_umkm' => $id,
                'status' => 'Terverifikasi',
                'jenis_verifikator' => 'dinas',
                'verifikator' => $this->user_id
            ];

            $do_update = $this->curl_post('https://e-officedesa.sumedangkab.go.id/api_bungadesa_umkm/verifikasi_umkm',$data);

            if($do_update){
                return redirect('umkm/beranda/view/'.$slug);
            }
            
        }else{
            return redirect('/');
        }
    }

    public function curl_get($url,$params)
    {
        $ch = curl_init();
        $dataArray = $params;
        $data = '';
        if($dataArray){
            $data = http_build_query($dataArray);
        }
        $getUrl = $url."?".$data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        
        return $data = json_decode(curl_exec($ch));
    }
    
    public function curl_post($url,$data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        return $data = json_decode(curl_exec($ch));
    }
} 

