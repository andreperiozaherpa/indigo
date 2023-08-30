<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_pensiun extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('pegawai_model');
		$this->load->model('pengajuan_model');
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
			$data['title']		= "Pengajuan pensiun - Admin ";
			$data['content']	= "pengajuan_pensiun/index" ;
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
			$result = $this->pengajuan_model->get_pensiun(null,$status,$nip,$nama,$limit,$offset);
			$data['all_result'] = $this->pengajuan_model->get_pensiun(null,$status,$nip,$nama);
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
				
				$cpns_tmt = $result[$i]->cpns_tmt;
				$sekarang = date('Y-m-d');
				if ($cpns_tmt!="0000-00-00" && $cpns_tmt <= $sekarang){
					$arr_masa_kerja = $this->pengajuan_model->get_masa_kerja($cpns_tmt,$sekarang);
				}
				else{$arr_masa_kerja=false;}
				$masa_kerja = $arr_masa_kerja==false? "" : $arr_masa_kerja['tahun'] ." Tahun " . $arr_masa_kerja['bulan'] ." Bulan";
				$result[$i]->masa_kerja = $masa_kerja;
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
			$data['title']		= "Pengajuan pensiun - Admin ";
			$data['content']	= "pengajuan_pensiun/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "pengajuan_pensiun";
			$data = array_merge($data,$this->default_data);
			$this->load->model('skpd_model');
			$data['skpd'] = $this->skpd_model->get_all();
			$data['arr_skpd'] = $data['skpd'];
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
						'createdby' => $this->user_id,
						'updatedby' => $this->user_id
					);
					$data_insert = array_merge($data_insert,$_POST);
					$this->pengajuan_model->insert("pengajuan_pensiun",$data_insert);
					$data['message'] = "Pengajuan pensiun berhasil ditambahkan";
				}
			}
			
			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}
	public function get_riwayat($id_pegawai=0,$flag=null)
	{
		if ($this->user_id && !empty($id_pegawai) && $id_pegawai>0){
			
			$pegawai= $this->pegawai_model->get($id_pegawai);
			if (empty($pegawai)) die ("pegawai tidak ditemukan");
			$cpns_tmt = $pegawai[0]['cpns_tmt'];
			$sekarang = date('Y-m-d');
			if ($cpns_tmt!="0000-00-00" && $cpns_tmt <= $sekarang){
				$arr_masa_kerja = $this->pengajuan_model->get_masa_kerja($cpns_tmt,$sekarang);
			}
			else{$arr_masa_kerja=false;}
			$masa_kerja = $arr_masa_kerja==false? "" : $arr_masa_kerja['tahun'] ." Tahun " . $arr_masa_kerja['bulan'] ." Bulan";
			$riwayat_pangkat = $this->pegawai_model->get_riwayat_pangkat($id_pegawai,1);
			$riwayat_jabatan = $this->pegawai_model->get_riwayat_jabatan($id_pegawai,1);
			$riwayat_unit_kerja = $this->pegawai_model->get_riwayat_unit_kerja($id_pegawai,1);
			
			
			$html = 				"<h4>Masa Kerja : $masa_kerja</h4> 
                                       <hr>
                                       <h4> Riwayat Jabatan </h4>
                                          <table class='data table table-striped no-margin'>
                                            <thead>
                                              <tr>
                                                <th>#</th>
                                                <th>Jabatan</th>
                                                <th>Tangal Mulai</th>
                                                 <th>Tanggal Akhir</th>
                                                 <th>Gol. Ruang</th>
                                                 <th>Gaji Pokok</th>
                                                <th>Nama Pejabat</th>
                                                <th>No.SK</th>
                                                <th>Tgl SK</th>
                                               </tr>
                                            </thead>";
									if (!empty($riwayat_jabatan)){
										$no=1;
										foreach ($riwayat_jabatan as $row){
											$tgl_akhir = $row->tgl_akhir=="9999-12-31" ? "Sekarang" : date("d M Y",strtotime($row->tgl_akhir));
											$html .= "
                                             <tr>
                                                <td>$no</td>
                                                <td>$row->nama_jabatan</td>
                                                <td>".date("d M Y",strtotime($row->tgl_mulai))."</td>
                                                <td>$tgl_akhir</td>
                                                <td>$row->pangkat</td>
                                                <td>".number_format($row->gaji_pokok)."</td>
                                                <td>$row->nama_pejabat</td>
                                                <td>$row->no_sk</td>
                                                <td>".date("d M Y",strtotime($row->tgl_sk))."</td>
                                             </tr>
											";
											$no++;
										}
									}
									else{
										$html .= "<tr><td colspan=9 align=center>- Tidak ada data -</td></tr>";
									}
											
            $html .= 					"</table>

										<br><br>
                                           <h4> Riwayat Kepangkatan </h4>
											<hr>
                                   
                                           <table class='data table table-striped no-margin'>
                                          <thead>
                                            <tr>
                                              <th>#</th>
                                              <th>Golongan Ruang</th>
                                              <th>Pangkat</th>
                                               <th>Berlaku TMT</th>
                                               <th>Gaji Pokok</th>
                                              <th>Nama Pejabat</th>
                                              <th>No.SK</th>
                                              <th>Tgl SK</th>
                                              
                                            </tr>
                                          </thead>";
									if (!empty($riwayat_pangkat)){
										$no=1;
										foreach ($riwayat_pangkat as $row){
											$html .= "
                                             <tr>
                                                <td>$no</td>
                                                <td>$row->golongan</td>
												<td>$row->pangkat</td>
                                                <td>".date("d M Y",strtotime($row->tmt_berlaku))."</td>
                                                <td>".number_format($row->gaji_pokok)."</td>
                                                <td>$row->nama_pejabat</td>
                                                <td>$row->no_sk</td>
                                                <td>".date("d M Y",strtotime($row->tgl_sk))."</td>
                                             </tr>
											";
											$no++;
										}
									}
									else{
										$html .= "<tr><td colspan=8 align=center>- Tidak ada data -</td></tr>";
									}
                                       
                $html .=                 "</table>
										<br><br>
                                         <h4> Riwayat Unit Kerja </h4>
                                         <hr>
                                         <!-- start s -->
                                        <table class='data table table-striped no-margin'>
                                          <thead>
                                            <tr>
                                              <th>#</th>
                                              <th>Unit Kerja</th>
                                              <th>TMT Awal</th>
                                               <th>TMT Akhir</th>
                                              <th>No.SK Awal</th>
                                              <th>No. SK Akhir</th>
                                              
                                            </tr>
                                          </thead>";
									if (!empty($riwayat_unit_kerja)){
										$no=1;
										foreach ($riwayat_unit_kerja as $row){
											$html .= "
                                             <tr>
                                                <td>$no</td>
                                                <td>$row->nama_skpd</td>
												<td>".date("d M Y",strtotime($row->tmt_awal))."</td>
                                                <td>".date("d M Y",strtotime($row->tmt_akhir))."</td>
                                                <td>$row->no_sk_awal</td>
                                                <td>$row->no_sk_akhir</td>
                                             </tr>
											";
											$no++;
										}
									}
									else{
										$html .= "<tr><td colspan=6 align=center>- Tidak ada data -</td></tr>";
									}
						$html .=		"</table>";
			if ($flag==null)
				die ($html);
			else if ($flag=="ctrl")
				return $html;
				
		}
		else{
			die ("request error");
		}
	}

	public function edit($id){
		if ($this->user_id && !empty($id) && $id>0)
		{
			$data['title']		= "Pengajuan pensiun - Admin ";
			$data['content']	= "pengajuan_pensiun/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data = array_merge($data,$this->default_data);
			$this->load->model('skpd_model');
			$data['skpd'] = $this->skpd_model->get_all();
			$data['arr_skpd'] = $data['skpd'];
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
					$data_pengajuan = $this->pengajuan_model->get_pensiun_by_id($id);
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
					$this->pengajuan_model->update("pengajuan_pensiun",$data_update,$id_);
					$data['message'] = "Pengajuan pensiun berhasil diubah";
				}
			}
			$data_pengajuan = $this->pengajuan_model->get_pensiun_by_id($id);
			$nip_baru = $data_pengajuan[0]->nip_baru;
			$data_pegawai = $this->pegawai_model->get_pegawai_for_pengajuan($nip_baru);
			$data['data_pengajuan'] = $data_pengajuan[0];
			$data['data_pegawai'] = $data_pegawai[0];
			
			if ($data_pengajuan[0]->status!=0)  redirect("/pengajuan_pensiun");
			$data['data_riwayat'] = $this->get_riwayat($data_pegawai[0]->id_pegawai,"ctrl");
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
			
			$data['title']		= "Pengajuan pensiun - Admin ";
			$data['content']	= "pengajuan_pensiun/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			
			$data_pengajuan = $this->pengajuan_model->get_pensiun_by_id($id);
			if (empty($data_pengajuan)) redirect("admin");
			$id_pegawai = $data_pengajuan[0]->id_pegawai;
			$data['pangkat_last'] = $this->pegawai_model->get_riwayat_pangkat($id_pegawai,1);
			$data['unit_kerja_last'] = $this->pegawai_model->get_riwayat_unit_kerja($id_pegawai,1);
			$data['data_pengajuan'] = $data_pengajuan[0];
			
			$data['riwayat_pangkat'] = $this->pegawai_model->get_riwayat_pangkat($id_pegawai,1);
			$data['riwayat_jabatan'] = $this->pegawai_model->get_riwayat_jabatan($id_pegawai,1);
			
			$data['arrStatusPengajuan'] = $this->arrStatusPengajuan;
			
			$cpns_tmt = $data_pengajuan[0]->cpns_tmt;
				$sekarang = date('Y-m-d');
				if ($cpns_tmt!="0000-00-00" && $cpns_tmt <= $sekarang){
					$arr_masa_kerja = $this->pengajuan_model->get_masa_kerja($cpns_tmt,$sekarang);
				}
				else{$arr_masa_kerja=false;}
				$masa_kerja = $arr_masa_kerja==false? "" : $arr_masa_kerja['tahun'] ." Tahun " . $arr_masa_kerja['bulan'] ." Bulan";
				$data['masa_kerja'] = $masa_kerja;
				
				
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
			
			$this->load->view('admin/pengajuan_pensiun/cetak');
			
		}
		
		
	}
	
	
	public function ubah_status($id,$status)
	{
			$this->pengajuan_model->ubah_status("pengajuan_pensiun",$status,$id);
			redirect('pengajuan_pensiun/view/'.$id);
		
	}
	public function delete($id,$berkas)
	{
		if ($this->user_id)
		{
			$this->pengajuan_model->delete("pengajuan_pensiun",$id,$berkas);
			redirect('pengajuan_pensiun');
		}
		else
		{
			redirect('admin');
		}
	}
}
?>