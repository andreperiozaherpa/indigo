<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_skor extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('session');
		$this->load->model('tank_auth/users');

		$this->load->helper('text');
		$this->load->helper('typography');
        $this->load->helper('file');

        $this->load->helper('talenta_helper');
        $this->db_simpeg = $this->load->database('simpeg', TRUE);

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


		if ($this->tank_auth->is_logged_in()) {
			redirect ('welcome');
		}


		//echo $this->session->userdata('employee_id');exit();

	}

	public function index()
	{
		if (!$this->user_id)
		{
			redirect("admin/login");
		}

		$get_api = curlSimpeg('talenta');
		$get_api = json_decode($get_api);
		// print_r($get_api->pegawai); die();

		// $this->db_simpeg->group_start();
		// $this->db_simpeg->or_where('master_pegawai.id_skpd',24);
		// $this->db_simpeg->or_where('master_pegawai.id_skpd',1);
		// $this->db_simpeg->group_end();
		// // $this->db_simpeg->where('master_pegawai.id_pegawai',2746);
		// // $this->db_simpeg->limit(100,0);
		// $this->db_simpeg->order_by('master_pegawai.last_update','DESC');
		// $this->db_simpeg->join('master_orang','master_orang.id_orang = master_pegawai.id_orang','LEFT');
		// $pegawai = $this->db_simpeg->get('master_pegawai')->result();

		$pegawai = $get_api->pegawai;

		foreach ($pegawai as $row) {
			$nip[] = $row->nip_baru;
		}

		// $this->db->select('id_pegawai');
		// $this->db->where_in('nip',$nip);
		// $get_pegawai = $this->db->get('pegawai')->result();

		// foreach ($get_pegawai as $row) {
		// 	$id_pegawai[] = $row->id_pegawai;
		// }

		$this->db->select('nip');
		$this->db->select_sum('masuk_telat');
		$this->db->select_sum('pulang_cepat');
		$this->db->where('tanggal >=','2021-01-01');
		$this->db->where('pegawai.pensiun','0');
		$this->db->where_in('pegawai.nip',$nip);
		$this->db->group_by('absen_log.id_pegawai');
		$this->db->join('pegawai','pegawai.id_pegawai = absen_log.id_pegawai', 'left');
		$absen_result = $this->db->get('absen_log')->result_array();

		$this->db->select('nip');
		$this->db->select_sum('jumlah');
		$this->db->where('tanggal_awal >=','2021-01-01');
		$this->db->where('id_ket_absen','A2');
		$this->db->where('pegawai.pensiun','0');
		$this->db->where_in('pegawai.nip',$nip);
		$this->db->group_by('absen_ket_log.id_pegawai');
		$this->db->join('pegawai','pegawai.id_pegawai = absen_ket_log.id_pegawai', 'left');
		$absen_ket_result = $this->db->get('absen_ket_log')->result_array();

		// print_r($absen_ket_result); die();

		$date_now=date_create(date('Y-m-d'));

		foreach ($pegawai as $key => $value) {
			//sumbu Y
            $this->db_simpeg->where('id_pegawai',$value->id_pegawai);
            $this->db_simpeg->group_start();
            $this->db_simpeg->or_where('assestment_kompetensi >',0);
            $this->db_simpeg->or_where('assestment_potensi >',0);
            $this->db_simpeg->group_end();
            $this->db_simpeg->order_by('tahun','DESC');
            $indikator[$key]['assestment'] = $this->db_simpeg->get('riwayat_indikator')->row();
			$indikator[$key]['assestment'] = (@$indikator[$key]['assestment']) ? @$indikator[$key]['assestment'] : @$get_api->indikator[$key]->assestment;

			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$this->db_simpeg->join('ref_tingkatpendidikan','ref_tingkatpendidikan.kode_tingkatpendidikan = riwayat_pendidikan.kode_tingkatpendidikan','left');
			$this->db_simpeg->order_by('tahun_lulus','DESC');
			$pendidikan[$key] = $this->db_simpeg->get('riwayat_pendidikan')->row();
			$pendidikan[$key] = (@$pendidikan[$key]->tahun_lulus >= @$get_api->pendidikan[$key]->tahun_lulus) ? @$pendidikan[$key] : @$get_api->pendidikan[$key];

			$date_cpns=date_create($value->tmt_cpns);
			$diff = date_diff($date_cpns,$date_now);
			$masa_kerja[$key]['mk'] = (($diff->format('%y') * 12) + $diff->format('%m'));	
					
			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$this->db_simpeg->order_by('tmt_pangkat','DESC');
			$this->db_simpeg->join('ref_golongan', 'ref_golongan.kode_golongan = riwayat_pangkat.kode_golongan', 'left');
			$masa_kerja[$key]['golongan'] = $this->db_simpeg->get('riwayat_pangkat')->row();
			$masa_kerja[$key]['golongan'] = (@$masa_kerja[$key]['golongan']->tmt_pangkat >= @$get_api->masa_kerja[$key]->golongan->tmt_pangkat) ? @$masa_kerja[$key]['golongan'] : @$get_api->masa_kerja[$key]->golongan;
					
			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$this->db_simpeg->where('id_ref_eselon >',0);
			$this->db_simpeg->order_by('id_ref_eselon','ASC');
			$this->db_simpeg->order_by('tmt_berlaku','ASC');
			$jabatan[$key]['data'] = $this->db_simpeg->get('riwayat_jabatan')->row();
			$jabatan[$key]['data'] = (@$jabatan[$key]['data']->id_ref_eselon > 0 AND (@$jabatan[$key]['data']->id_ref_eselon <= @$get_api->jabatan[$key]->data->id_ref_eselon AND @$jabatan[$key]['data']->tmt_berlaku <= @$get_api->jabatan[$key]->data->tmt_berlaku)) ? @$jabatan[$key]['data'] : @$get_api->jabatan[$key]->data;

			if ($jabatan[$key]['data'] ) {
			$date_berlaku=date_create($jabatan[$key]['data']->tmt_berlaku);
			$diff = date_diff($date_berlaku,$date_now);
			$jabatan[$key]['mm'] = (($diff->format('%y') * 12) + $diff->format('%m'));		
					
			$this->db_simpeg->where('id_eselon',$jabatan[$key]['data']->id_ref_eselon);
			$jabatan[$key]['eselon'] = $this->db_simpeg->get('ref_eselon')->row();
			} else {
			$jabatan[$key]['mm'] = 0;
			$jabatan[$key]['eselon'] = 0;
			}

			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$pelatihan['diklat'][$key] = $this->db_simpeg->get('riwayat_diklat')->num_rows();
			$pelatihan['diklat'][$key] = @$pelatihan['diklat'][$key] + @$get_api->pelatihan->diklat[$key];

			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$this->db_simpeg->where('tmt_berakhir >=', date('Y-m-d', strtotime('-2 years')));
			$this->db_simpeg->where('jeniskursus !=','SW');
			$this->db_simpeg->select('SUM(jumlah_jam) as jumlah_jam');
			$pelatihan['kursus'][$key]['pelatihan'] = $this->db_simpeg->get('riwayat_kursus')->row();
			$pelatihan['kursus'][$key]['pelatihan']->jumlah_jam = @$pelatihan['kursus'][$key]['pelatihan']->jumlah_jam + @$get_api->pelatihan->kursus[$key]->pelatihan->jumlah_jam;

			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$this->db_simpeg->where('tmt_berakhir >=', date('Y-m-d', strtotime('-2 years')));
			$this->db_simpeg->where('jeniskursus','SW');
			$this->db_simpeg->select('SUM(jumlah_jam) as jumlah_jam');
			$pelatihan['kursus'][$key]['workshop'] = $this->db_simpeg->get('riwayat_kursus')->row();
			$pelatihan['kursus'][$key]['workshop']->jumlah_jam = @$pelatihan['kursus'][$key]['workshop']->jumlah_jam + @$get_api->pelatihan->kursus[$key]->workshop->jumlah_jam;



			//sumbu X
            $this->db_simpeg->where('id_pegawai',$value->id_pegawai);
            $this->db_simpeg->where('nilai_ppk_pns >',0);
            $this->db_simpeg->order_by('tahun','DESC');
            $indikator[$key]['ppk_pns'] = $this->db_simpeg->get('riwayat_indikator')->row();
			$indikator[$key]['ppk_pns'] = (@$indikator[$key]['ppk_pns']) ? @$indikator[$key]['ppk_pns'] : @$get_api->indikator[$key]->ppk_pns;

			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$this->db_simpeg->order_by('tahun','DESC');
			$prestasi[$key] = $this->db_simpeg->get('riwayat_prestasi')->result();
			$prestasi[$key] =  (object) array_merge((array) @$prestasi[$key], (array) @$get_api->prestasi[$key]);

			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$this->db_simpeg->join('ref_penugasan', 'ref_penugasan.kode_penugasan = riwayat_penugasan.kode_penugasan', 'left');
			$this->db_simpeg->order_by('tahun','DESC');
			$penugasan[$key] = $this->db_simpeg->get('riwayat_penugasan')->result();
			$penugasan[$key] =  (object) array_merge((array) @$penugasan[$key], (array) @$get_api->penugasan[$key]);

			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$this->db_simpeg->where('sk_tanggal >=', date('Y-m-d', strtotime('-1 years')));
			$this->db_simpeg->join('ref_jenishukuman', 'ref_jenishukuman.kode_jenishukuman = riwayat_hukuman.kode_jenishukuman', 'left');
			$this->db_simpeg->order_by('riwayat_hukuman.kode_jenishukuman','DESC');
			$hukuman[$key] = $this->db_simpeg->get('riwayat_hukuman')->row();
			$hukuman[$key] = (@$hukuman[$key]->kode_jenishukuman >= @$get_api->hukuman[$key]->kode_jenishukuman) ? @$hukuman[$key] : @$get_api->hukuman[$key];

			$absen_key = array_search($value->nip_baru, array_column($absen_result, 'nip'));
			$absen['terlambat'][$key] = ($absen_key) ? $absen_result[$absen_key]['masuk_telat'] + $absen_result[$absen_key]['pulang_cepat'] : 0;

			$absen_ket_key = array_search($value->nip_baru, array_column($absen_ket_result, 'nip'));
			$absen['absen'][$key] = ($absen_ket_key) ? @$absen_ket_result[$absen_ket_key]['jumlah'] : 0;

		}
		

		$data['pegawai'] = $pegawai;
		$data['date_now'] = $date_now;
		$data['indikator'] = $indikator;
		$data['pendidikan'] = $pendidikan;
		$data['masa_kerja'] = $masa_kerja;
		$data['jabatan'] = $jabatan;
		$data['pelatihan'] = $pelatihan;

		$data['prestasi'] = $prestasi;
		$data['penugasan'] = $penugasan;
		$data['hukuman'] = $hukuman;
		$data['absen'] = $absen;

		print_r($data);

		// $this->load->view('tes',$data);


	}
}
