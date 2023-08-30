<?php
// Load plugin PHPExcel nya
include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
include_once(APPPATH . "third_party/PHPExcel/PHPExcel.php");
include_once(APPPATH . "third_party/Common/Autoloader.php");
include_once(APPPATH . "third_party/PhpWord/Autoloader.php");
//include_once(APPPATH."core/Front_end.php");

use PhpOffice\Common\Autoloader as CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;

Autoloader::register();
CAutoloader::register();
Settings::loadConfig();
defined('BASEPATH') or exit('No direct script access allowed');

class Sipekat_handler extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('user_model');
        $this->user_model->user_id = $this->user_id;
        $this->user_model->set_user_by_user_id();
        $this->user_picture = $this->user_model->user_picture;
        $this->full_name    = $this->user_model->full_name;
        $this->user_level    = $this->user_model->level;
        if ($this->user_level == "Admin Web");

        // $this->load->model('agenda_harian_model','agenda_harian_m');
    }

    function tes()
    {
        echo $file = "2cac6b90b9d374b76942100c6e629419.xlsx";
        var_dump(file_put_contents('data/sipekat/tmp/' . $file, file_get_contents('https://sipekat.sumedangkab.go.id/data/template_dokumen/tmp/' . $file)));
    }

    function tes_get()
    {
//        $file = file_get_contents('https://sipekat.sumedangkab.go.id/data/template_dokumen/tmp/test.txt');
        $file = file_get_contents('https://simpeg.sumedangkab.go.id/');
        //$file = file_get_contents('https://youtube.co.id/');
        echo $file;
//        var_dump(file_put_contents('data/sipekat/tmp/test123.txt', $file));
    }

    function ref_satuan()
    {
        $satuan = array('Ls','Ikat','Ltr','Pcs','Jam','Drum','M2','Lembar','M3','M','Roll','Pasang','Pack','Batang','Box','Lbr','Meter','Hari / M2','Tube','Zak','Liter','Botol','Per Bungkus','Sachet','Kit','Bungkus','vial','Dus','Gram','Per Sampel','Ampul','labu','Pekerjaan','Pohon','gr','rol','Cm','Per Batang Pohon','Polybag','Stek','Plc','Rumpun','Batang Pohon','Log','Amplop','Biji','okulasi','anakan','Stup','butir','Tabung','blok','Lusin','Rim','Fls','Per Keping','Per Buku','Boks','Pak','galon','Gulung','Per Orang','Tablet','Fles','Bh','Syringe','Suppo','Kapsul','Pot','Blister','test','Kemasan','Strip','Nampan/ piring','Nampan','Orang / Paket','Porsi','Jerigen','Kaleng','Karung','Btg','Dosis','Lsn','2 Unit','Keping');
        echo count($satuan);
        // foreach ($satuan as $row) {
        //     $this->db->set('satuan', $row);
        //     $this->db->set('jenis', NULL);
        //     $this->db->set('keterangan', NULL);
        //     $this->db->set('status', 'aktif');
        //     $this->db->insert('ref_satuan');
        // }
    }

    public function console_iframe($file = '')
    {
        // print_r($_SERVER['HTTP_HOST']);
        // print_r($_SERVER['REQUEST_URI']);
        // @apache_setenv('no-gzip', 1);

        @set_time_limit(0);
        @ob_end_clean();
        @ob_end_flush();
        @ini_set('output_buffering', 'off');
        @ini_set('zlib.output_compression', false);
        while (@ob_end_flush());
        @ini_set('implicit_flush', true);
        @ob_implicit_flush(true);

        ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^ PHP_OUTPUT_HANDLER_REMOVABLE);
        echo "<style>body{background-color:#222222;color:#FFFFFF;font-family: Consolas, Menlo, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace, serif;}</style>";
        echo "<body>";
        echo '<script>
        var scroller = setInterval(function() {  
            window.scrollTo(0,document.body.scrollHeight);
        }, 10); // update every 10 ms, change at will
        </script>';
        echo str_pad('', 4096);
        ob_flush();
        flush();
        sleep(1);


        if ($file) {
            $this->import_excel($file);
            echo $file;
            echo str_pad('', 4096);
            ob_flush();
            flush();
        } else {
            echo 'Select File to Upload..';
            // phpinfo();
        }
        sleep(1);
        echo "</body>";
        echo '<script>
		window.scrollTo(0,document.body.scrollHeight);
        clearInterval(scroller); // stop updating so that you can scroll up 
        </script>';
        echo str_pad('', 4096);
        ob_flush();
        flush();
        // ob_end_flush();
    }

    public function import_excel($file)
    {
        file_put_contents('data/sipekat/tmp/' . $file, file_get_contents('https://sipekat.sumedangkab.go.id/data/template_dokumen/tmp/' . $file));

        $data_upload = $file;

        $excelreader     = new PHPExcel_Reader_Excel2007();
        $loadexcel         = $excelreader->load('data/sipekat/tmp/' . $data_upload); // Load file yang telah diupload ke folder excel
        $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

        $data = array();

        $numrow = 1;
        echo "-------------------- STARTING IMPORT DATA --------------------<br/><br/>";
        echo str_pad('', 4096);
        ob_flush();
        flush();
        sleep(1);
		$count_update['urusan'] = $count_update['sub_urusan'] = $count_update['unit'] = $count_update['sub_unit'] = $count_update['program'] = $count_update['kegiatan'] = $count_update['sub_kegiatan'] = $count_update['peruntukan'] = $count_update['kode_rekening'] = $count_update['update_pagu'] = $count_update['insert_pagu'] = $count_update['failed'] = 0;
        foreach ($sheet as $row) {
			$row['A'] = trim($row['A']);
			$row['B'] = trim($row['B']);
			$row['C'] = trim($row['C']);
			$row['D'] = trim($row['D']);
			$row['E'] = trim($row['E']);
			$row['F'] = trim($row['F']);
			$row['G'] = trim($row['G']);
			$row['H'] = trim($row['H']);
			$row['I'] = trim($row['I']);
			$row['J'] = trim($row['J']);
			$row['K'] = trim($row['K']);
			$row['L'] = trim($row['L']);
			$row['M'] = trim($row['M']);
			$row['N'] = trim($row['N']);
			$row['O'] = trim($row['O']);
			$row['P'] = trim($row['P']);
			$row['Q'] = trim($row['Q']);
			$row['R'] = trim($row['R']);
			$row['S'] = trim($row['S']);
			$row['T'] = trim($row['T']);
			$row['U'] = trim($row['U']);
			$row['V'] = trim($row['V']);
			$row['W'] = trim($row['W']);
			$row['X'] = trim($row['X']);
			$row['Y'] = trim($row['Y']);
			$row['Z'] = trim($row['Z']);
			$row['AA'] = trim($row['AA']);
			$row['AB'] = trim($row['AB']);
			$row['AC'] = trim($row['AC']);
			$row['AD'] = trim($row['AD']);
			$row['AE'] = trim($row['AE']);
			$row['AF'] = trim($row['AF']);

            if ($numrow > 1) {
                $kode_rekening = trim($row['I'] . '.' . $row['O'] . '.' . $row['Q']);
                if (strlen($kode_rekening) >= 54) {
					// continue;
                    echo "#{$numrow} -> {$kode_rekening}<br/>";

                    echo "-> checking kode rekening..<br/>";
                    echo str_pad('', 4096);
                    ob_flush();
                    flush();
                    $check1 = $this->db->get_where('sipd_master_kodering', ['kode_kodering' => $kode_rekening])->num_rows();
                    if ($check1 == 0) {
                        echo "-> checking kode urusan..<br/>";
                        echo "-> [{$row['C']}]<br/>";
                        echo str_pad('', 4096);
                        ob_flush();
                        flush();
                        $check11 = $this->db->get_where('sipd_ref_urusan', ['kode_urusan' => $row['C']])->num_rows();
                        if ($check11 == 0) {
                            echo "-> updating kode urusan..<br/>";
                        	echo "-> {$row['D']}<br/>";
                            echo str_pad('', 4096);
                            ob_flush();
                            flush();
							$this->db->insert('sipd_ref_urusan',['kode_urusan' => $row['C'], 'nama_urusan' => $row['D']]);
							$count_update['urusan']++;
                        }

                        echo "-> checking kode sub urusan..<br/>";
                        echo "-> [{$row['E']}]<br/>";
                        echo str_pad('', 4096);
                        ob_flush();
                        flush();
                        $check12 = $this->db->get_where('sipd_ref_sub_urusan', ['kode_sub_urusan' => $row['E']])->num_rows();
                        if ($check12 == 0) {
                            echo "-> updating kode sub urusan..<br/>";
                        	echo "-> {$row['F']}<br/>";
                            echo str_pad('', 4096);
                            ob_flush();
                            flush();
							$this->db->insert('sipd_ref_sub_urusan',['kode_sub_urusan' => $row['E'], 'nama_sub_urusan' => $row['F']]);
							$count_update['sub_urusan']++;
                        }

                        echo "-> checking kode unit..<br/>";
                        echo "-> [{$row['G']}]<br/>";
                        echo str_pad('', 4096);
                        ob_flush();
                        flush();
                        $check13 = $this->db->get_where('sipd_ref_unit', ['kode_unit' => $row['G']])->num_rows();
                        if ($check13 == 0) {
                            echo "-> updating kode unit..<br/>";
                        	echo "-> {$row['H']}<br/>";
                            echo str_pad('', 4096);
                            ob_flush();
                            flush();
							$this->db->insert('sipd_ref_unit',['kode_unit' => $row['G'], 'nama_unit' => $row['H']]);
							$count_update['unit']++;
                        }

                        echo "-> checking kode sub unit..<br/>";
                        echo "-> [{$row['I']}]<br/>";
                        echo str_pad('', 4096);
                        ob_flush();
                        flush();
                        $check14 = $this->db->get_where('sipd_ref_sub_unit', ['kode_sub_unit' => $row['I']])->num_rows();
                        if ($check14 == 0) {
                            echo "-> updating kode sub unit..<br/>";
                        	echo "-> {$row['J']}<br/>";
                            echo str_pad('', 4096);
                            ob_flush();
                            flush();
							$this->db->insert('sipd_ref_sub_unit',['kode_sub_unit' => $row['I'], 'nama_sub_unit' => $row['J']]);
							$count_update['sub_unit']++;
                        }

                        echo "-> checking kode program..<br/>";
                        echo "-> [{$row['K']}]<br/>";
                        echo str_pad('', 4096);
                        ob_flush();
                        flush();
                        $check15 = $this->db->get_where('sipd_ref_program', ['kode_program' => $row['K']])->num_rows();
                        if ($check15 == 0) {
                            echo "-> updating kode program..<br/>";
                        	echo "-> {$row['L']}<br/>";
                            echo str_pad('', 4096);
                            ob_flush();
                            flush();
							$this->db->insert('sipd_ref_program',['kode_program' => $row['K'], 'nama_program' => $row['L']]);
							$count_update['program']++;
                        }

                        echo "-> checking kode kegiatan..<br/>";
                        echo "-> [{$row['M']}]<br/>";
                        echo str_pad('', 4096);
                        ob_flush();
                        flush();
                        $check16 = $this->db->get_where('sipd_ref_kegiatan', ['kode_kegiatan' => $row['M']])->num_rows();
                        if ($check16 == 0) {
                            echo "-> updating kode kegiatan..<br/>";
                        	echo "-> {$row['N']}<br/>";
                            echo str_pad('', 4096);
                            ob_flush();
                            flush();
							$this->db->insert('sipd_ref_kegiatan',['kode_kegiatan' => $row['M'], 'nama_kegiatan' => $row['N']]);
							$count_update['kegiatan']++;
                        }

                        echo "-> checking kode sub kegiatan..<br/>";
                        echo "-> [{$row['O']}]<br/>";
                        echo str_pad('', 4096);
                        ob_flush();
                        flush();
                        $check17 = $this->db->get_where('sipd_ref_sub_kegiatan', ['kode_sub_kegiatan' => $row['O']])->num_rows();
                        if ($check17 == 0) {
                            echo "-> updating kode sub kegiatan..<br/>";
                        	echo "-> {$row['P']}<br/>";
                            echo str_pad('', 4096);
                            ob_flush();
                            flush();
							$this->db->insert('sipd_ref_sub_kegiatan',['kode_sub_kegiatan' => $row['O'], 'nama_sub_kegiatan' => $row['P']]);
							$count_update['sub_kegiatan']++;
                        }

                        echo "-> checking kode peruntukan..<br/>";
                        echo "-> [{$row['Q']}]<br/>";
                        echo str_pad('', 4096);
                        ob_flush();
                        flush();
                        $check18 = $this->db->get_where('sipd_ref_peruntukan', ['kode_peruntukan' => $row['Q']])->num_rows();
                        if ($check18 == 0) {
                            echo "-> updating kode peruntukan..<br/>";
                        	echo "-> {$row['R']}<br/>";
                            echo str_pad('', 4096);
                            ob_flush();
                            flush();
							$this->db->insert('sipd_ref_peruntukan',['kode_peruntukan' => $row['Q'], 'nama_peruntukan' => $row['R']]);
							$count_update['peruntukan']++;
                        }

						echo "-> updating kode rekening..<br/>";
						echo "-> {$kode_rekening}<br/>";
						echo str_pad('', 4096);
						ob_flush();
						flush();
						$this->db->insert('sipd_master_kodering',['kode_kodering' => $kode_rekening, 'nama_kodering' => $row['R']]);
						$count_update['kode_rekening']++;
                    }

                    echo "-> checking existing pagu..<br/>";
                    echo str_pad('', 4096);
                    ob_flush();
                    flush();
                    $check2 = $this->db->get_where('sipd_master_pagu', ['kode_kodering' => $kode_rekening, 'tahun_pagu' => $row['A']])->num_rows();
					$data_pagu = array(
						'kode_kodering' => $kode_rekening,
						'tahun_pagu' => $row['A'],
						'jumlah_pagu' => $row['T'],
						'pagu_1' => $row['U'],
						'pagu_2' => $row['V'],
						'pagu_3' => $row['W'],
						'pagu_4' => $row['X'],
						'pagu_5' => $row['Y'],
						'pagu_6' => $row['Z'],
						'pagu_7' => $row['AA'],
						'pagu_8' => $row['AB'],
						'pagu_9' => $row['AC'],
						'pagu_10' => $row['AD'],
						'pagu_11' => $row['AE'],
						'pagu_12' => $row['AF'],
					);
                    if ($check2 > 0) {
                        echo "-> updating pagu..<br/>";
                        echo str_pad('', 4096);
                        ob_flush();
                        flush();
						$this->db->update('sipd_master_pagu', $data_pagu, ['kode_kodering' => $kode_rekening, 'tahun_pagu' => $row['A']]);
						$count_update['update_pagu']++;
                    } else {
                        echo "-> inserting pagu..<br/>";
                        echo str_pad('', 4096);
                        ob_flush();
                        flush();
						$this->db->insert('sipd_master_pagu', $data_pagu);
						$count_update['insert_pagu']++;
                    }

                    array_push($data, array(
                        'tahun' => $row['A'],
                    ));
                } else {
					$gagal_update[] = array('kode' => $kode_rekening, 'nama' => $row['R']);
					$count_update['failed']++;
				}
            }

            $numrow++;


            echo str_pad('', 4096);
            ob_flush();
            flush();
        }
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();
        // $this->db->insert_batch('rekap_zonasi_rt', $data);
        //delete file from server
        unlink(realpath('data/sipekat/tmp/' . $data_upload));
        sleep(1);
        echo "<br/>------------------- SUCCESS IMPORTING DATA -------------------<br/><br/>";
        echo str_pad('', 4096);
        ob_flush();
        flush();
        sleep(1);
		$updated_pagu = $count_update['update_pagu'] + $count_update['insert_pagu'];
        echo "Kode Rekening Baru      -> {$count_update['kode_rekening']}<br/>";
        echo "Pagu Berhasil Update    -> {$updated_pagu}<br/>";
        echo "+Referensi Urusan       -> {$count_update['urusan']}<br/>";
        echo "+Referensi Sub Urusan   -> {$count_update['sub_urusan']}<br/>";
        echo "+Referensi Unit         -> {$count_update['unit']}<br/>";
        echo "+Referensi Sub Unit     -> {$count_update['sub_unit']}<br/>";
        echo "+Referensi Program      -> {$count_update['program']}<br/>";
        echo "+Referensi Kegiatan     -> {$count_update['kegiatan']}<br/>";
        echo "+Referensi Sub Kegiatan -> {$count_update['sub_kegiatan']}<br/>";
        echo "+Referensi Peruntukan   -> {$count_update['peruntukan']}<br/>";
        echo "-GAGAL UPDATE           -> {$count_update['failed']}<br/>";
		echo "<pre>";
		print_r($gagal_update);
		echo "</pre>";
        echo str_pad('', 4096);
        ob_flush();
        flush();

        //upload success
        $this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');
        //redirect halaman
        // redirect('import/');
        // return $data;
    }
}
