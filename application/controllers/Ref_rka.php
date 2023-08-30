<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_rka extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct(); 
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('ref_rka_model');
		$this->load->model('ref_unit_kerja_model');
        // $this->load->model('ref_satuan_model');
        // $this->load->model('ref_renstra_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name    = $this->user_model->full_name;
		$this->user_level   = $this->user_model->level;
		if ($this->user_level=="Admin Web"); 

        //$this->load->model('Ref_renstra','ref_rka_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']      = "Rencana Kerja Anggaran - Admin ";
			$data['content']    = "ref_rka/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']      = $this->full_name;
			$data['user_level']     = $this->user_level;
			$data['active_menu'] = "ref_rka";

            // $data['tahun'] = $this->ref_rka_model->get_tahun();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			if($this->user_level=='Administrator'){
				if(!empty($_POST)){
                // $this->ref_rka_model->tahun_rkt = $_POST['tahun_rkt'];
					$this->ref_rka_model->id_unit_kerja = $_POST['id_unit_kerja'];
				}
			}else{
				$this->ref_rka_model->id_unit_kerja = $this->session->userdata('unit_kerja_id');
			}
			if($this->user_level=='Administrator'){
				$item1 = $this->ref_rka_model->get_all_master();
				$item2 = $this->ref_rka_model->get_all();
				$res = array_merge($item1,$item2); 
				$data['item'] = $res;
				$data['item_master'] = $item1;
				$data['item_user'] = $item2;
			}else{
				$data['item'] = $this->ref_rka_model->get_all();
			}
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function import_excel(){
		include APPPATH.'third_party/PHPExcel.php';
		include APPPATH.'third_party/PHPExcel/IOFactory.php';
		$fileName = time().$_FILES['file']['name'];

		$config['upload_path'] = './asset/import_excel/'; 
		$config['file_name'] = $fileName;
		$config['allowed_types'] = 'xls|xlsx|csv';
		$config['max_size'] = 10000;

		$this->load->library('upload');
		$this->upload->initialize($config);

		if(! $this->upload->do_upload('file') )
			$this->upload->display_errors();

		$media = $this->upload->data();
		$inputFileName = './asset/import_excel/'.$media['file_name'];
		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();

		for ($row = 2; $row <= $highestRow; $row++){     
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE);

			$data = array(
				"id_unit_kerja"=>0,
				"kode_rka"=> trim($rowData[0][0]),
				"kegiatan_rka"=> trim(str_replace('_x000D_', '', $rowData[0][1])),
          // "uraian_rka"=> str_replace('_x000D_', '', $rowData[0][1]),
				"vol"=> trim($rowData[0][2]),
				"sat"=> trim($rowData[0][3]),
				"harga_satuan"=> trim($rowData[0][4]),
				"pagu_rka"=> trim($rowData[0][5]),
				"tahun"=>trim($_POST['tahun'])
			);

			$insert = $this->ref_rka_model->insert_master($data);

		}
		$this->session->set_flashdata('sukses',1);
		// redirect('ref_rka');
	}


	public function view()
	{
		if ($this->user_id)
		{
			$data['title']        = "Rencana Kerja Anggaran - Admin ";
			$data['content']  = "ref_rka/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']        = $this->full_name;
			$data['user_level']       = $this->user_level;
			$data['active_menu'] = "ref_rka";

            //if(!empty($_POST)){
            //  $this->ref_rka_m->nama_lokasi = $_POST['nama_lokasi'];
            //  $this->ref_rka_m->kode_kegiatan = $_POST['kode_kegiatan'];
            //}
            //$data['item'] = $this->ref_rka_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function tambah()
	{
		if ($this->user_id)
		{
			$data['title']        = "Rencana Kerja Anggaran - Admin ";
			$data['content']  = "ref_rka/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']        = $this->full_name;
			$data['user_level']       = $this->user_level;
			$data['active_menu'] = "ref_rka";

			if(!empty($_POST)){
				if(isset($_POST['id_rka'])){
					foreach($_POST['id_rka'] as $r){
						$rka = $this->ref_rka_model->select_by_id_master($r);
						$rka->id_unit_kerja = $_POST['id_unit_kerja'];
						unset($rka->tahun);
						unset($rka->id_rka);
						$insert = $this->ref_rka_model->insert($rka);
					}
				}
				$data['message_type'] = "success";
				$data['message']       = "RKA berhasil ditambahakan.";
			}
            // $data['renstra'] = $this->ref_renstra_model->get_all_data();
            // $data['satuan'] = $this->ref_satuan_model->get_all();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			$data['master'] = $this->ref_rka_model->get_all_master($this->session->userdata('level_unit_kerja'));
                // echo "<pre>";
                // print_r($data['master']);die;
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function get_master($tahun=''){
		if(!empty($tahun)){
			$master = $this->ref_rka_model->get_all_master($this->session->userdata('level_unit_kerja'),$tahun);
			// print_r($master);die;
			$no=1;
			if(!empty($master)){
				foreach($master as $m){
					if($this->user_level=='Administrator'){
						echo'
						<tr>
						<td style="text-align: center">'.$m->kode_rka.'</td>
						<td style="text-align: center">'.rupiah($m->pagu_rka).'</td>
						<td style="text-align: ">'.($m->kegiatan_rka).'</td>
						<td style="text-align: center">
						<div class="checkbox checkbox-primary">
						<input id="checkbox" type="checkbox" onclick="toggleAll()" name="id_rka[]" value="'.$m->id_rka.'">
						<label for="checkbox2"></label>
						</div>
						</td>
						</tr>';

						$no++; 
					}else{
						if($m->view_by==$this->session->userdata('level_unit_kerja')){
							echo'
							<tr>
							<td style="text-align: center">'.$m->kode_rka.'</td>
							<td style="text-align: center">'.rupiah($m->pagu_rka).'</td>
							<td style="text-align: ">'.($m->kegiatan_rka).'</td>
							<td style="text-align: center">
							<div class="checkbox checkbox-primary">
							<input id="checkbox" onclick="toggleAll()" type="checkbox" class="check" name="id_rka[]" value="'.$m->id_rka.'">
							<label for="checkbox2"></label>
							</div>
							</td>
							</tr>';
							$no++; 
						}
					}
				} 
			}else{
				echo '
				<tr>
				<td colspan="4"><center>Tidak ada data</center> </td>
				</tr>';
			}
		}else{
			echo '
			<tr>
			<td colspan="4"><center>Tidak ada data</center> </td>
			</tr>';
		}
	}



	public function detail()
	{
		if ($this->user_id)
		{
			$data['title']        = "Rencana Kerja Anggaran - Admin ";
			$data['content']  = "ref_rka/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']        = $this->full_name;
			$data['user_level']       = $this->user_level;
			$data['active_menu'] = "ref_rka";

			$id = $this->uri->segment(3);
			$type = $this->uri->segment(4);
			if(empty($id)){
				redirect(base_url('ref_rka'));
			}

			$data['item'] = $this->ref_rka_model->select_by_id($id);
			if(isset($type)){
				if($type=='master'){
					$data['item'] = $this->ref_rka_model->select_by_id_master($id);
				}
			}

			if(empty($data['item'])){
				redirect(base_url('ref_rka'));
			}

            // $data['renstra'] = $this->ref_renstra_model->get_all_data();
            // $data['satuan'] = $this->ref_satuan_model->get_all();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}



	public function edit()
	{
		if ($this->user_id)
			{$data['title']       = "Rencana Kerja Anggaran - Admin ";
		$data['content']  = "ref_rka/edit" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']        = $this->full_name;
		$data['user_level']       = $this->user_level;
		$data['active_menu'] = "ref_rka";

		$id = $this->uri->segment(3);
		$type = $this->uri->segment(4);
		if(empty($id)){
			redirect(base_url('ref_rka'));
		}

		if(!empty($_POST)){
			if(isset($type)){
				if($type=='master'){
					$_POST['id_unit_kerja'] = 0;
					$in = $this->ref_rka_model->update_master($_POST,$id);
				}
			}else{
				$in = $this->ref_rka_model->update($_POST,$id);
			}
			$data['message_type'] = "success";
			$data['message']      = "RKA berhasil disimpan.";
            // redirect('ref_rka');
		}

		$data['item'] = $this->ref_rka_model->select_by_id($id);
		if(isset($type)){
			if($type=='master'){
				$data['item'] = $this->ref_rka_model->select_by_id_master($id);
			}
		}

		if(empty($data['item'])){
			redirect(base_url('ref_rka'));
		}

        // $data['renstra'] = $this->ref_renstra_model->get_all_data();
        // $data['satuan'] = $this->ref_satuan_model->get_all();
		$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();


		$this->load->view('admin/index',$data);

	}
	else
	{
		redirect('admin');
	}
}


public function delete($id,$type='')
{
	if ($this->user_id)
	{
		if($type=='master'){
			$this->ref_rka_model->delete_master($id);
		}else{
			$this->ref_rka_model->delete($id);
		}
	}
	else
	{
		redirect('home');
	}
}

public function download_format_import(){
	$file = './asset/files/Format_Import_RKA.xlsx';
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($file));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	ob_clean();
	flush();
	readfile($file);
}

}
?>