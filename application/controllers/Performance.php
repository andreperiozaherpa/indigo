<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Performance extends CI_Controller {
	public $user_id;
	public $BULAN;
	public $id_provinsi;
	public $id_kabupaten;
	public $id_kecamatan;
	public $id_desa;
	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		
		$this->load->model('laporan_model');
		$this->bulan = array(
										1 => 'Januari',
										2 => 'Februari',
										3 => 'Maret',
										4 => 'April',
										5 => 'Mei',
										6 => 'Juni',
										7 => 'Juli',
										8 => 'Agustus',
										9 => 'September',
										10 => 'Oktober',
										11 => 'Nopember',
										12 => 'Desember',
									);
		$this->level_id	= $this->user_model->level_id;

		if (!$this->user_id OR ($this->session->userdata('user_level') != 1 && !in_array('laporan', $this->user_privileges))) {
			redirect('admin/login');
		}
	}

	public function get_izin($parent_id){
		$obj = '<option value="">Pilih</option>';
		$this->load->model('ref_get_bidangizin_model');
		$id = explode("-",$parent_id);
		$data = $this->ref_get_bidangizin_model->get_izin(null,$id[0]);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_jenis_izin."-".$row->nama_jenisizin."'>$row->nama_jenisizin</option>";
		}
		die ($obj);
	}
	

	public function get_provinsi($parent_id){
		$obj = '<option value="">Pilih</option>';
		$this->load->model('ref_wilayah_model');
		$id = explode("-",$parent_id);
		$data = $this->ref_wilayah_model->get_provinsi(null,$id[0]);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_provinsi."-".$row->provinsi."'>$row->provinsi</option>";
		}
		die ($obj);
	} 


	public function get_kabupaten($parent_id){
		$obj = '<option value="">Pilih</option>';
		$this->load->model('ref_wilayah_model');
		$id = explode("-",$parent_id);
		$data = $this->ref_wilayah_model->get_kabupaten(null,$id[0]);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_kabupaten."-".$row->kabupaten."'>$row->kabupaten</option>";
		}
		die ($obj);
	}
	public function get_kecamatan($parent_id){
		$obj = '<option value="">Pilih</option>';
		$this->load->model('ref_wilayah_model');
		$id = explode("-",$parent_id);
		$data = $this->ref_wilayah_model->get_kecamatan(null,$id[0]);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_kecamatan."-".$row->kecamatan."'>$row->kecamatan</option>";
		}
		die ($obj);
	}
	public function get_desa($parent_id){
		$obj = '<option value="">Pilih</option>';
		$this->load->model('ref_wilayah_model');
		$id = explode("-",$parent_id);
		$data = $this->ref_wilayah_model->get_desa(null,$id[0]);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_desa."-".$row->desa."'>$row->desa</option>";
		}
		die ($obj);
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Rekap Data- Admin ";
			$data['content']	= "performance/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "rekapinvestasi";
			$data['bulan'] = $this->bulan;
			$data['tahun_minimal'] = $this->laporan_model->tahun_minimal;
			
			$this->load->model('ref_wilayah_model');
			$data['provinsi'] = $this->ref_wilayah_model->get_provinsi();

			//$this->load->model('ref_wilayah_model');
			$data['kabupaten'] = $this->ref_wilayah_model->get_kabupaten();

			//$this->load->model('ref_wilayah_model');
			$data['kecamatan'] = $this->ref_wilayah_model->get_kecamatan();

			//$this->load->model('ref_wilayah_model');
			$data['desa'] = $this->ref_wilayah_model->get_desa();

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}


	public function laporan()
	{
		if ($this->user_id)
		{
			$data['title']		= "Rekap Data- Admin ";
			$data['content']	= "performance/laporan" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "rekapinvestasi";
			$data['bulan'] = $this->bulan;
			$data['tahun_minimal'] = $this->laporan_model->tahun_minimal;
			
			$this->load->model('ref_wilayah_model');
			$data['provinsi'] = $this->ref_wilayah_model->get_provinsi();

			//$this->load->model('ref_wilayah_model');
			$data['kabupaten'] = $this->ref_wilayah_model->get_kabupaten();

			//$this->load->model('ref_wilayah_model');
			$data['kecamatan'] = $this->ref_wilayah_model->get_kecamatan();

			//$this->load->model('ref_wilayah_model');
			$data['desa'] = $this->ref_wilayah_model->get_desa();

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function detail()
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Performance - Admin ";
			$data['content']	= "performance/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "rekapinvestasi";

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}


	
	private function getData($tahun){
		if ($this->id_kabupaten!=""){
			$kab = explode("-", $this->id_kabupaten);
			$this->id_kabupaten = $kab[0];
		}
		if ($this->id_kecamatan!=""){
			$kec = explode("-", $this->id_kecamatan);
			$this->id_kecamatan = $kec[0];
		}
		if ($this->id_desa!=""){
			$desa = explode("-", $this->id_desa);
			$this->id_desa = $desa[0];
		}
		// var_dump($this->id_provinsi);
		// var_dump($this->id_kabupaten);
		// var_dump($this->id_kecamatan);
		// var_dump($this->id_desa);
		$bidang = $this->laporan_model->get_bidang();
		$total_by_bidang = $this->laporan_model->get_total_by_bidang($tahun,$this->id_provinsi,$this->id_kabupaten,$this->id_kecamatan,$this->id_desa);
		$total_by_jenis_izin = $this->laporan_model->get_total_by_jenis_izin($tahun,$this->id_provinsi,$this->id_kabupaten,$this->id_kecamatan,$this->id_desa);
		$total_by_sub_jenis_izin = $this->laporan_model->get_total_by_sub_jenis_izin($tahun,$this->id_provinsi,$this->id_kabupaten,$this->id_kecamatan,$this->id_desa);
		//var_dump($this->BULAN);
		$total_bidang = array();
		foreach($total_by_bidang as $row)
		{
			$total_bidang[$row->id_bidang_izin][$row->bulan] = $row->total;
		}
		
		$total_jenis_izin = array();
		foreach($total_by_jenis_izin as $row)
		{
			$total_jenis_izin[$row->id_jenis_izin][$row->bulan] = $row->total;
		}
		
		$total_sub_jenis_izin = array();
		foreach($total_by_sub_jenis_izin as $row)
		{
			$total_sub_jenis_izin[$row->id_sub_jenis_izin][$row->bulan] = $row->total;
		}
		//var_dump($total_bidang[2][1]);die;
		$data = "";
		$total[1] = $total[2] = $total[3] = $total[4] =$total[5] = $total[6] =$total[7] = $total[8] =$total[9] = $total[10] = $total[1] = $total[2] =$total[11] = $total[12] = 0;
		foreach ($bidang as $row)
		{
			$jenis_izin = $this->laporan_model->get_jenis_izin($row->id_bidang);
			$data .= "
				<tr>
					<td>$row->nama_bidang</td><td></td><td></td>";
					
						$jml = 0;
						for ($i=1;$i <= count($this->bulan);$i++){
							if (($this->BULAN=="") || ($this->BULAN!="" && $this->BULAN == $i )){
								//$value = $this->laporan_model->get_total_by_bidang($tahun,$i,$row->id_bidang); // get from query
								$value = !empty($total_bidang[$row->id_bidang][$i]) ? $total_bidang[$row->id_bidang][$i] : 0;
								$data .="<td>$value</td>";
								$jml += $value;
								$total[$i] += $value; 
							}
						}
						if ($this->BULAN=="")  $data .= "<td>$jml</td>";
					
						$data .= "</tr><tr>";
						foreach ($jenis_izin as $row2)
						{
							$sub_jenis_izin = $this->laporan_model->get_sub_jenis_izin($row2->id_jenis_izin);
							$data .= "<td></td><td>$row2->nama_jenisizin</td><td></td>";
							
								$jml = 0;
								
								for ($i=1;$i <= count($this->bulan);$i++){
									if (($this->BULAN=="") || ($this->BULAN!="" && $this->BULAN == $i )){
										//$value = $this->laporan_model->get_total_by_jenis_izin($tahun,$i,$row2->id_jenis_izin); // get from query
										$value = !empty($total_jenis_izin[$row2->id_jenis_izin][$i]) ? $total_jenis_izin[$row2->id_jenis_izin][$i] : 0;
										$data .="<td>$value</td>";
										$jml += $value;
									}
								}
								
								if ($this->BULAN=="")  $data .= "<td>$jml</td>";
							
								$data .= "</tr><tr>";
								foreach($sub_jenis_izin as $row3)
								{
									$data .= "<td></td><td></td><td>$row3->nama_sub_jenisizin</td>";
									$jml = 0;
									for ($i=1;$i <= count($this->bulan);$i++){
										if (($this->BULAN=="") || ($this->BULAN!="" && $this->BULAN == $i )){
											//$value = $this->laporan_model->get_total_by_sub_jenis_izin($tahun,$i,$row3->id_sub_jenis_izin); // get from query
											$value = !empty($total_sub_jenis_izin[$row3->id_sub_jenis_izin][$i]) ? $total_sub_jenis_izin[$row3->id_sub_jenis_izin][$i] : 0;
											$data .="<td>$value</td>";
											$jml += $value;
										}
									}
									if ($this->BULAN=="") $data .= "<td>$jml</td>";
									$data .= "</tr>";
								}
								
						}
					
			
			
		}
		$data .= "<tr>
			<td>Jumlah / Bulan</td><td></td><td></td>";
			$grand_total = 0;
			for($i=1;$i <= count($this->bulan) ; $i++)
			{
				if (($this->BULAN=="") || ($this->BULAN!="" && $this->BULAN == $i )){
					$data .= "<td class='verticalTableHeader'>$total[$i]</td>";
					$grand_total += $total[$i];
				}
			}
		if ($this->BULAN=="") $data .="<td class='verticalTableHeader'>$grand_total</td>";
			
			$data .="</tr>";
		return $data;
	}
	
	private function getDataSIUP($tipe){
		if ($this->id_kabupaten!=""){
			$kab = explode("-", $this->id_kabupaten);
			$this->id_kabupaten = $kab[0];
		}
		if ($this->id_kecamatan!=""){
			$kec = explode("-", $this->id_kecamatan);
			$this->id_kecamatan = $kec[0];
		}
		if ($this->id_desa!=""){
			$desa = explode("-", $this->id_desa);
			$this->id_desa = $desa[0];
		}
		// var_dump($this->id_provinsi);
		// var_dump($this->id_kabupaten);
		// var_dump($this->id_kecamatan);
		// var_dump($this->id_desa);
		$this->laporan_model->id_jenis_izin = 104; // id SIUP
		$query = $this->laporan_model->get_data_izin($tipe,$this->id_provinsi,$this->id_kabupaten,$this->id_kecamatan,$this->id_desa);
		
		$data = "";
		$no = 1;
		$nilai_investasi = 0;
		$jumlah_tki = 0;
		$jumlah_tka = 0;
		foreach ($query as $row)
		{
			//$jenis_izin = $this->laporan_model->get_jenis_izin($row->id_bidang);
			$data .= "
				<tr>
					<td>$no</td>
					<td>$row->nama_perusahaan</td>
					<td>$row->nama_bentuk_perusahaan</td>
					<td>$row->alamat_perusahaan / $row->no_telpon_perusahaan</td>
					<td>$row->nomer_sk</td>
					<td>$row->tanggal_sk</td>
					<td>$row->npwp_pemohon</td>
					<td>$row->nama_pemohon</td>
					<td>$row->nama_sektor; $row->nama_sektor2; $row->nama_sektor3;</td>
					<td>$row->nama_kedudukan</td>
					<td>$row->nama_kbli</td>
					<td>$row->kegiatan_usaha_pokok</td>
					<td>$row->modal_dasar</td>
					<td>$row->jumlah_tki</td>
					<td>$row->jumlah_tka</td>
				</tr>";
						
			$nilai_investasi += $row->modal_dasar;
			$jumlah_tki += $row->jumlah_tki;
			$jumlah_tka += $row->jumlah_tka;
			$no++;
			
		}
		$data .= "<tr>
					<th colspan='12' style='text-align:center;'>JUMLAH</th>
					<td><b>$nilai_investasi</b></td>
					<td><b>$jumlah_tki</b></td>
					<td><b>$jumlah_tka</b></td>
				  </tr>";
		return $data;
	
	}
	
}
?>