<?php
include_once(APPPATH."third_party/Common/Autoloader.php");
include_once(APPPATH."third_party/PhpWord/Autoloader.php");
//include_once(APPPATH."core/Front_end.php");

use PhpOffice\Common\Autoloader AS CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;
Autoloader::register();
CAutoloader::register();
Settings::loadConfig();
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_pensiun extends CI_Controller {
	public $user_id;
	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('usulan_pensiun_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('pegawai_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->level_id	= $this->user_model->level_id;
		$this->perihal = array('janda_duda'=>'Janda / Duda','aps'=>'Atas Permintaan Sendiri (APS)','bup'=>'Batas Usia Pensiun (BUP)','uzur'=>'Uzur');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Laporan Hasil Usulan Pensiun - Admin ";
			$data['content']	= "laporan_pensiun/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu']		= 'laporan_pensiun';

			$hal = 20;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->usulan_pensiun_model->get_all());
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$nama = $_POST['nama_lengkap'];
				$skpd = $_POST['id_skpd'];
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
				$data['nama_lengkap'] = $_POST['nama_lengkap'];
				$data['id_skpd'] = $_POST['id_skpd'];
			}else{
				$filter = '';
				$nama = '';
				$skpd = '';
				$data['filter'] = false;
			}
			$data['list'] = $this->usulan_pensiun_model->get_page($mulai,$hal,$nama,$skpd);
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['perihal'] = $this->perihal;
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function export($id_skpd=''){
		include APPPATH.'third_party/PHPExcel.php';

    // Panggil class PHPExcel nya
		$excel = new PHPExcel();
    // Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
		->setLastModifiedBy('My Notes Code')
		->setTitle("Data Laporan")
		->setSubject("Pensiun")
		->setDescription("Laporan Semua Data Pensiun")
		->setKeywords("Data Pensiun");
    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    )
  );
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ),
			'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    )
		);
    $excel->setActiveSheetIndex(0)->setCellValue('A1', "NO"); // Set kolom A3 dengan tulisan "NO"
    $excel->setActiveSheetIndex(0)->setCellValue('B1', "NIP"); // Set kolom B3 dengan tulisan "NIS"
    $excel->setActiveSheetIndex(0)->setCellValue('C1', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
    $excel->setActiveSheetIndex(0)->setCellValue('D1', "JABATAN"); // Set kolom C3 dengan tulisan "NAMA"
    $excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);

    $usulan = $this->usulan_pensiun_model->get_diterima($id_skpd);
    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($usulan as $data){ // Lakukan looping pada variabel siswa
    	$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
    	$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, "'".$data->nip);
    	$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nama_lengkap);
    	$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->jabatan);

      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
    	$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
    	$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
    	$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
    	$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);

      $no++; // Tambah 1 setiap kali looping
      $numrow++; // Tambah 1 setiap kali looping
  }

    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(50); // Set width kolom C
    
    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan Pensiun Diterima");
    $excel->setActiveSheetIndex(0);
    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Laporan Pensiun Diterima.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');

}



}
?>
