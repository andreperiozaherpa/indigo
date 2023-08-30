<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_hukumandisiplin extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('pegawai_model');
		$this->load->model('pengajuan_model');
		$this->load->model('ref_jenishukuman_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->level_id	= $this->user_model->level_id;
		$this->kd_skpd	= $this->user_model->kd_skpd;
		$this->default_data = array(
					'nip_lama' =>'',
					'nip_baru' =>'',
					'karpeg' =>'',
					'id_gelardepan' =>'',
					'nama_lengkap' =>'',
					'id_gelarbelakang' =>'',
					'tgl_lahir' =>'',
					'tempat_lahir' =>'',
					'id_agama' =>'',
					'jenis_kelamin' =>'1',
					'bayar_gaji' =>'Kas Daerah Sumedang',
					'kedudukan_pegawai' =>'',
					'status_pegawai' =>'1',
					'alamat' =>'',
					'RT' =>'',
					'RW' =>'',
					'id_desa' =>'',
					'id_kecamatan' =>'',
					'id_kabupaten' =>'',
					'id_provinsi' =>'',
					'kode_pos' =>'',
					'telepon' =>'',
					'kartu_askes' =>'',
					'kartu_taspen' =>'',
					'karis_karsu' =>'',
					'npwp' =>'',
					'id_statusmenikah' =>'',
					'jml_tanggungan_anak' =>'',
					'jml_seluruh_anak' =>'',
					'kabupaten' => '',
					'kecamatan' => '',
					'desa' => '',
					'kd_skpd' => $this->kd_skpd
				);
		$this->arrStatusPengajuan = array(
			0 => "Belum diverifikasi",
			1 => "Proses diverifikasi",
			2 => "Sudah diverifikasi",
			3 => "Ditolak"
		);
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Pengajuan hukumandisiplin - Admin ";
			$data['content']	= "pengajuan_hukumandisiplin/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$nip = $nama = $status = null;
			if (!empty($_POST)){
				$nip = $_POST['nip'];
				$nama= $_POST['nama'];
				$status = $_POST['status'];
				
				$data = array_merge($data,$_POST);
			}
			
			$offset = 0;
			$limit = $data['per_page']	= 15;
			if (!empty($_GET['per_page'])) $offset = $_GET['per_page'] ;
			$result = $this->pengajuan_model->get_hukuman(null,$status,$nip,$nama,$limit,$offset);
			$data['all_result'] = $this->pengajuan_model->get_hukuman(null,$status,$nip,$nama);
			for ($i=0; $i< (count($result)); $i++){
				$last_pangkat = $this->last_pangkat($result[$i]->id_pegawai);
				$last_unit_kerja = $this->last_unit_kerja($result[$i]->id_pegawai);
				//var_dump($last_pangkat);die;
				if ($last_pangkat){
					$result[$i]->golongan = $last_pangkat->golongan;
				}
				else{
					$result[$i]->golongan = "";
				}
				if ($last_unit_kerja){
					$result[$i]->nama_skpd = $last_unit_kerja->nama_skpd;
				}
				else{
					$result[$i]->nama_skpd = "";
				}
				
				
			}
			$data['result'] = $result;
			$data['total_rows']	= count($data['all_result']);
			$data['offset']	= $offset;
			
			$data['arrStatusPengajuan'] = $this->arrStatusPengajuan;
			
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}
	
	function last_pangkat($id_pegawai){
		$data = $this->pegawai_model->get_riwayat_pangkat($id_pegawai,1);
		if (!empty($data)){
			return $data[0];
		}
		else{return false;}
	}
	function last_unit_kerja($id_pegawai){
		$data = $this->pegawai_model->get_riwayat_unit_kerja($id_pegawai,1);
		if (!empty($data)){
			return $data[0];
		}
		else{return false;}
	}
	public function add(){
		if ($this->user_id)
		{
			$data['title']		= "Pengajuan hukumandisiplin - Admin ";
			$data['content']	= "pengajuan_hukumandisiplin/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pengajuan_hukumandisiplin";
			$data = array_merge($data,$this->default_data);
			$data['jenishukuman'] = $this->ref_jenishukuman_model->get_all("Y");
			
			$data['max_size']             = 2000;
			if (!empty($_POST)){
				unset($_POST['nip_master']);
				$config['upload_path']          = './data/upload_berkas/';
			    $config['allowed_types']        = 'zip|rar';
			    $config['max_size']             = $data['max_size'];
				$this->load->library('upload', $config);
				
			    if ( ! $this->upload->do_upload())
		        {
		            $_POST['berkas'] 	= "";
		            $data['error'] = true;
					$data['message'] 	= "Tambah data gagal.<br>Error berkas : ". $this->upload->display_errors();
		        }
		        else
				{
					$_POST['berkas'] = $this->upload->data('file_name');
		        }
				if (empty($data['error'])){
					unset($_POST['userfile']);
					$data_insert = array(
						'status' => 0,
						'created' => date('Y-m-d h:i:s'),
						'updated' => date('Y-m-d h:i:s'),
						'tgl_pengajuan' => date('Y-m-d'),
						'createdby' => $this->user_id,
						'updatedby' => $this->user_id
					);
					$data_insert = array_merge($data_insert,$_POST);
					$this->pengajuan_model->insert("pengajuan_hukuman",$data_insert);
					$data['message'] = "Pengajuan hukuman berhasil ditambahkan";
				}
			}
			
			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}
	

	public function edit($id){
		if ($this->user_id && !empty($id) && $id>0)
		{
			$data['title']		= "Pengajuan hukumandisiplin - Admin ";
			$data['content']	= "pengajuan_hukumandisiplin/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data = array_merge($data,$this->default_data);
			$data['jenishukuman'] = $this->ref_jenishukuman_model->get_all("Y");
			$data['max_size']             = 2000;
			if (!empty($_POST)){
				unset($_POST['nip_master']);
				$config['upload_path']          = './data/upload_berkas/';
			    $config['allowed_types']        = 'zip|rar';
			    $config['max_size']             = $data['max_size'];
				$this->load->library('upload', $config);
				
			    if ( ! $this->upload->do_upload())
		        {
		            unset($_POST['berkas']);
		            $tmp_name				= $_FILES['userfile']['tmp_name'];
		            if ($tmp_name!="")
		            {
		                $data['error'] = true;
						$data['message'] 	= "Tambah data gagal.<br>Error berkas : ". $this->upload->display_errors();
		            }
		        }
		        else
				{
					$data_pengajuan = $this->pengajuan_model->get_hukuman_by_id($id);
					$berkas = $data_pengajuan[0]->berkas;
					if ($berkas!="") unlink($config['upload_path'].$berkas);
					$_POST['berkas'] = $this->upload->data('file_name');
		        }
				if (empty($data['error'])){
					unset($_POST['userfile']);
					$id_ = $_POST['id'];
					unset($_POST['id']);
					$data_update = array(
						'updated' => date('Y-m-d h:i:s'),
						'updatedby' => $this->user_id
					);
					$data_update = array_merge($data_update,$_POST);
					$this->pengajuan_model->update("pengajuan_hukuman",$data_update,$id_);
					$data['message'] = "Pengajuan hukuman berhasil diubah";
				}
			}
			$data_pengajuan = $this->pengajuan_model->get_hukuman_by_id($id);
			$nip_baru = $data_pengajuan[0]->nip_baru;
			$data_pegawai = $this->pegawai_model->get_pegawai_for_pengajuan($nip_baru);
			$data['data_pengajuan'] = $data_pengajuan[0];
			$data['data_pegawai'] = $data_pegawai[0];
			
			if ($data_pengajuan[0]->status!=0)  redirect("/pengajuan_hukumandisiplin");
			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}
	public function view($id)
	{
		if ($this->user_id && !empty($id) && $id>0)
		{
			
			$data['title']		= "Pengajuan hukumandisiplin - Admin ";
			$data['content']	= "pengajuan_hukumandisiplin/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data_pengajuan = $this->pengajuan_model->get_hukuman_by_id($id);
			if (empty($data_pengajuan)) redirect("admin");
			$id_pegawai = $data_pengajuan[0]->id_pegawai;
			$data['pangkat_last'] = $this->pegawai_model->get_riwayat_pangkat($id_pegawai,1);
			$data['unit_kerja_last'] = $this->pegawai_model->get_riwayat_unit_kerja($id_pegawai,1);
			$data['data_pengajuan'] = $data_pengajuan[0];
			
			$data['riwayat_pangkat'] = $this->pegawai_model->get_riwayat_pangkat($id_pegawai,1);
			$data['riwayat_jabatan'] = $this->pegawai_model->get_riwayat_jabatan($id_pegawai,1);
			
			$data['arrStatusPengajuan'] = $this->arrStatusPengajuan;
			
			
				
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function cetak(){
		if ($this->user_id)
		{
			
			$this->load->view('admin/pengajuan_hukumandisiplin/cetak');
			
		}
		
		
	}
	
	
	public function ubah_status($id,$status)
	{
			$this->pengajuan_model->ubah_status("pengajuan_hukuman",$status,$id);
			redirect('pengajuan_hukumandisiplin/view/'.$id);
		
	}
	public function delete($id,$berkas)
	{
		if ($this->user_id)
		{
			$this->pengajuan_model->delete("pengajuan_hukuman",$id,$berkas);
			redirect('pengajuan_hukumandisiplin');
		}
		else
		{
			redirect('admin');
		}
	}
}
?>