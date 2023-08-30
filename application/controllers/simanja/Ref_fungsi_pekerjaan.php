<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_fungsi_pekerjaan extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('simanja/ref_fungsi_pekerjaan_model', 'refFungsiJabatan');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->load->library(array('excel','session'));
		if ($this->user_level=="Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Ref. Fungsi Jabatan - Sistem Informasi Anjab ABK dan Evaluasi Jabatan ";
			$data['content']	= "simanja/ref_fungsi_pekerjaan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']	= $this->full_name;
			$data['user_level']	= $this->user_level;
			$data['active_menu'] = "simanja/ref_fungsi_pekerjaan";

			$data['list'] = $this->refFungsiJabatan->get_all_ref();
		
			if (isset($_FILES["fileExcel"]["name"])) {
				$path = $_FILES["fileExcel"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();	
					for($row=2; $row<=$highestRow; $row++)
					{
						$kode = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$keterangan = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
						$temp_data[] = array(
							'kode'	=> $kode,
							'keterangan'	=> $keterangan,
						); 	
					}
				}
				$insert = $this->refFungsiJabatan->insert_excel($temp_data);
				if($insert){
					$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import ke Database');
					redirect(base_url('simanja/ref_fungsi_pekerjaan'));
				}else{
					$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
					redirect(base_url('simanja/ref_fungsi_pekerjaan'));
				}
			}


			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function fetch_ref($id){
		$misi = $this->refFungsiJabatan->select_by_id_ref($id);
		echo json_encode($misi);
	}

	public function p_update_ref(){
		$id_ref = $_POST['id_ref'];
		unset($_POST['id_ref']);
		unset($_POST['_wysihtml5_mode']);
		$this->refFungsiJabatan->update_ref($_POST,$id_ref);
		echo json_encode(array('status'=>true));
	}

	public function p_add_ref()
	{
		unset($_POST['_wysihtml5_mode']);
		$this->refFungsiJabatan->insert_ref($_POST);
		echo json_encode(array('status'=>true));
	}

	public function delete_ref($id){
		
		$this->refFungsiJabatan->delete_ref($id);
		echo json_encode(array('status'=>true));
		
	}

}
?>
