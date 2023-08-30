<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes_360 extends CI_Controller {
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

		$this->load->model('talenta/peringkat_talent_model');

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

	public function rekap()
	{
		if (!$this->user_id)
		{
			redirect("admin/login");
		}



		$get_api = curlSimpeg('talenta2');
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

		$this->db->select('pegawai.id_pegawai, pegawai.nip, eselon, jabatan, nama_skpd');
		$this->db->where_in('username',$nip);
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd', 'left');
		$this->db->join('user','user.user_id = pegawai.id_user', 'left');
		$get_pegawai = $this->db->get('pegawai')->result();

		foreach ($get_pegawai as $row) {
			// $id_pegawai[] = $row->id_pegawai;
			$pegawai_office[$row->nip] = $row;
		}

		// print_r($absen_ket_result); die();

		$date_now=date_create(date('Y-m-d'));

		foreach ($pegawai as $key => $value) {
			//sumbu Y

			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$this->db_simpeg->join('ref_tingkatpendidikan','ref_tingkatpendidikan.kode_tingkatpendidikan = riwayat_pendidikan.kode_tingkatpendidikan','left');
			$this->db_simpeg->order_by('tahun_lulus','DESC');
			$pendidikan[$key] = $this->db_simpeg->get('riwayat_pendidikan')->row();
			$pendidikan[$key] = (@$pendidikan[$key]->tahun_lulus >= @$get_api->pendidikan[$key]->tahun_lulus) ? @$pendidikan[$key] : @$get_api->pendidikan[$key];
			
			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$this->db_simpeg->order_by('tmt_pangkat','DESC');
			$this->db_simpeg->join('ref_golongan', 'ref_golongan.kode_golongan = riwayat_pangkat.kode_golongan', 'left');
			$masa_kerja[$key]['golongan'] = $this->db_simpeg->get('riwayat_pangkat')->row();
			$masa_kerja[$key]['golongan'] = (@$masa_kerja[$key]['golongan']->tmt_pangkat >= @$get_api->masa_kerja[$key]->golongan->tmt_pangkat) ? @$masa_kerja[$key]['golongan'] : @$get_api->masa_kerja[$key]->golongan;
					
			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$this->db_simpeg->where('id_ref_eselon >',0);
			$this->db_simpeg->order_by('id_ref_eselon','ASC');
			$this->db_simpeg->order_by('tmt_berlaku','DESC');
			$jabatan[$key]['data'] = $this->db_simpeg->get('riwayat_jabatan')->row();
			$jabatan[$key]['data'] = (@$jabatan[$key]['data']->id_ref_eselon > 0 AND (@$jabatan[$key]['data']->id_ref_eselon <= @$get_api->jabatan[$key]->data->id_ref_eselon OR @$jabatan[$key]['data']->tmt_berlaku >= @$get_api->jabatan[$key]->data->tmt_berlaku)) ? @$jabatan[$key]['data'] : @$get_api->jabatan[$key]->data;

			if ($jabatan[$key]['data'] ) {
			$date_berlaku=date_create($jabatan[$key]['data']->tmt_berlaku);
			$diff = date_diff($date_berlaku,$date_now);
			$jabatan[$key]['mm'] = (($diff->format('%y') * 12) + $diff->format('%m'));		
					
			$this->db_simpeg->where('id_eselon',$jabatan[$key]['data']->id_ref_eselon);
			$jabatan[$key]['eselon'] = $this->db_simpeg->get('ref_eselon')->row();

			if ($jabatan[$key]['data']->id_ref_jabatan > 0) {
				$this->db_simpeg->where('id_jabatan',$jabatan[$key]['data']->id_ref_jabatan);
				$jabatan[$key]['jabatan'] = $this->db_simpeg->get('ref_jabatan')->row()->nama_jabatan;
			} else {
				$jabatan[$key]['jabatan'] = $jabatan[$key]['data']->ref_jabatan_lainnya;
			}

			if ($jabatan[$key]['data']->id_skpd > 0) {
				$this->db_simpeg->where('id_skpd',$jabatan[$key]['data']->id_skpd);
				$jabatan[$key]['skpd'] = $this->db_simpeg->get('ref_skpd')->row()->nama_skpd;
			} else {
				$jabatan[$key]['skpd'] = $jabatan[$key]['data']->skpd_lainnya;
			}

			} else {
			$jabatan[$key]['mm'] = 0;
			$jabatan[$key]['eselon'] = 0;
			$jabatan[$key]['jabatan'] = "";
			$jabatan[$key]['skpd'] = "";
			}	


			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$pelatihan['diklat'][$key] = $this->db_simpeg->get('riwayat_diklat')->num_rows();
			$pelatihan['diklat'][$key] = @$pelatihan['diklat'][$key] + @$get_api->pelatihan->diklat[$key];


		}
		

		$data['pegawai'] = $pegawai;
		$data['date_now'] = $date_now;
		$data['pendidikan'] = $pendidikan;
		$data['masa_kerja'] = $masa_kerja;
		$data['jabatan'] = $jabatan;
		$data['pelatihan'] = $pelatihan;

		// $data['eselon'] = $eselon;
		$data['pegawai_office'] = $pegawai_office;

		$this->load->view('tes2',$data);


	}

	public function index()
	{
		if (!$this->user_id)
		{
			redirect("admin/login");
		}

		$get_api = curlSimpeg('talenta?nip=197011111991021001');
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

		$pegawai = (@$get_api->pegawai) ? $get_api->pegawai : array();

		$indikator = $pendidikan = $masa_kerja = $jabatan = $pelatihan = $prestasi = $penugasan = $peer = $tpp =  array();

		// foreach ($pegawai as $row) {
		// 	$nip[] = $row->nip_baru;
		// }

		// $this->db->select('id_pegawai');
		// $this->db->where_in('nip',$nip);
		// $get_pegawai = $this->db->get('pegawai')->result();

		// foreach ($get_pegawai as $row) {
		// 	$id_pegawai[] = $row->id_pegawai;
		// }

		// print_r($absen_ket_result); die();

		$date_now=date_create(date('Y-m-d'));

		foreach ($pegawai as $key => $value) {
			$id_pegawai = $this->db->select('id_pegawai')->where('nip',$value->nip_baru)->get('pegawai')->row()->id_pegawai;
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
					
			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$this->db_simpeg->order_by('tmt_pangkat','DESC');
			$this->db_simpeg->join('ref_golongan', 'ref_golongan.kode_golongan = riwayat_pangkat.kode_golongan', 'left');
			$masa_kerja[$key]['golongan'] = $this->db_simpeg->get('riwayat_pangkat')->row();
			$masa_kerja[$key]['golongan'] = (@$masa_kerja[$key]['golongan']->tmt_pangkat >= @$get_api->masa_kerja[$key]->golongan->tmt_pangkat) ? @$masa_kerja[$key]['golongan'] : @$get_api->masa_kerja[$key]->golongan;

			$date_cpns=date_create($value->tmt_cpns);
			$date_golongan=date_create($masa_kerja[$key]['golongan']->tmt_pangkat);
			$diff = date_diff($date_golongan,$date_now);
			$masa_kerja[$key]['mk'] = (($diff->format('%y') * 12) + $diff->format('%m'));	
					
			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
			$this->db_simpeg->where('id_ref_eselon >',0);
			$this->db_simpeg->where('plt !=','Y');
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
            $this->db_simpeg->where('tahun >=',date('Y', strtotime('-1 year')));
			$this->db_simpeg->order_by('tahun','DESC');
			$prestasi[$key] = $this->db_simpeg->get('riwayat_prestasi')->result();
			$prestasi[$key] =  (object) array_merge((array) @$prestasi[$key], (array) @$get_api->prestasi[$key]);

			$this->db_simpeg->where('id_pegawai',$value->id_pegawai);
            $this->db_simpeg->where('tahun >=',date('Y'));
			$this->db_simpeg->join('ref_penugasan', 'ref_penugasan.kode_penugasan = riwayat_penugasan.kode_penugasan', 'left');
			$this->db_simpeg->order_by('tahun','DESC');
			$penugasan[$key] = $this->db_simpeg->get('riwayat_penugasan')->result();
			$penugasan[$key] =  (object) array_merge((array) @$penugasan[$key], (array) @$get_api->penugasan[$key]);


			$peer[$key] = $this->peringkat_talent_model->get_k_peer($value->nip_baru);

			$tpp[$key] = $this->peringkat_talent_model->get_k_tpp($id_pegawai);

		}

		// print_r($tpp); die();
		

		$data['pegawai'] = $pegawai;
		$data['date_now'] = $date_now;

		$data['indikator'] = $indikator;
		$data['pendidikan'] = $pendidikan;
		$data['masa_kerja'] = $masa_kerja;
		$data['jabatan'] = $jabatan;
		$data['pelatihan'] = $pelatihan;

		$data['prestasi'] = $prestasi;
		$data['penugasan'] = $penugasan;
		$data['peer'] = $peer;
		$data['tpp'] = $tpp;


		$this->load->view('tes',$data);


	}

	public function index_asli()
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

		$this->load->view('tes',$data);


	}

	public function get_talent()
	{
		$this->db->select("nip,id_pegawai");
		$this->db->like("eselon","II.", 'both');
		$this->db->where('pensiun !=',1);
		// $this->db->where('nip','197903102008011005');
		// $this->db->where('nip','197502021995011001');
		$this->db->group_by('nip');
		// $this->db->limit(50,0);
		$query =$this->db->get("pegawai");
		$get = $query->result();
		foreach ($get as $key => $value) {
			$no = $key+1;
			$nip[] = $value->nip;
			echo "INPUT DATA NO.".$no." -> NIP :".$value->nip;
			echo " : ";
			echo $this->peringkat_talent_model->get_k_rating($value->id_pegawai);
			echo "<br>";
			// $this->generate($value->nip,$value->id_pegawai);
			// echo "$value->nip <br>";
		}
		$this->db->select("nip,id_pegawai");
		$this->db->like("eselon","III.", 'after');
		$this->db->where('pensiun !=',1);
		$this->db->limit(100,100)->group_by('nip');
		$query =$this->db->get("pegawai");
		$get = $query->result();
		foreach ($get as $key => $value) {
			$no = $key+1;
			// $nip[] = $value->nip;
			// echo "INPUT DATA NO.".$no." -> NIP :".$value->nip;
			// echo "<br>";
			// $this->generate($value->nip,$value->id_pegawai);
		}
		// echo count($nip);
		$unique = array_unique($nip);
		print_r(count($unique));
	}

	public function generate($nip="",$id="")
	{
		if (!$this->user_id)
		{
			// redirect("admin/login");
		}

		$get_api = curlSimpeg('talenta?nip='.$nip);
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

		$pegawai = (@$get_api->pegawai) ? $get_api->pegawai : array();

		$indikator = $pendidikan = $masa_kerja = $jabatan = $pelatihan = $prestasi = $penugasan = $peer = $tpp =  array();

		// foreach ($pegawai as $row) {
		// 	$nip[] = $row->nip_baru;
		// }

		// $this->db->select('id_pegawai');
		// $this->db->where_in('nip',$nip);
		// $get_pegawai = $this->db->get('pegawai')->result();

		// foreach ($get_pegawai as $row) {
		// 	$id_pegawai[] = $row->id_pegawai;
		// }

		// print_r($absen_ket_result); die();

		$date_now=date_create(date('Y-m-d'));

		foreach ($pegawai as $key => $value) {
			$id_pegawai = $this->db->select('id_pegawai')->where('nip',$value->nip_baru)->get('pegawai')->row()->id_pegawai;
			//sumbu Y
			$indikator[$key]['assestment'] = (@$indikator[$key]['assestment']) ? @$indikator[$key]['assestment'] : @$get_api->indikator[$key]->assestment;

			$pendidikan[$key] = (@$pendidikan[$key]->tahun_lulus >= @$get_api->pendidikan[$key]->tahun_lulus) ? @$pendidikan[$key] : @$get_api->pendidikan[$key];
					
			$masa_kerja[$key]['golongan'] = (@$masa_kerja[$key]['golongan']->tmt_pangkat >= @$get_api->masa_kerja[$key]->golongan->tmt_pangkat) ? @$masa_kerja[$key]['golongan'] : @$get_api->masa_kerja[$key]->golongan;

			$date_cpns=date_create($value->tmt_cpns);
			$date_golongan=date_create($masa_kerja[$key]['golongan']->tmt_pangkat);
			$diff = date_diff($date_golongan,$date_now);
			$masa_kerja[$key]['mk'] = (($diff->format('%y') * 12) + $diff->format('%m'));	
					
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

			$pelatihan['diklat'][$key] = @$pelatihan['diklat'][$key] + @$get_api->pelatihan->diklat[$key];

			@$pelatihan['kursus'][$key]['pelatihan']->jumlah_jam = @$pelatihan['kursus'][$key]['pelatihan']->jumlah_jam + @$get_api->pelatihan->kursus[$key]->pelatihan->jumlah_jam;

			@$pelatihan['kursus'][$key]['workshop']->jumlah_jam = @$pelatihan['kursus'][$key]['workshop']->jumlah_jam + @$get_api->pelatihan->kursus[$key]->workshop->jumlah_jam;



			//sumbu X
			$indikator[$key]['ppk_pns'] = (@$indikator[$key]['ppk_pns']) ? @$indikator[$key]['ppk_pns'] : @$get_api->indikator[$key]->ppk_pns;

			$prestasi[$key] =  (object) array_merge((array) @$prestasi[$key], (array) @$get_api->prestasi[$key]);

			$penugasan[$key] =  (object) array_merge((array) @$penugasan[$key], (array) @$get_api->penugasan[$key]);


			$peer[$key] = $this->peringkat_talent_model->get_k_peer($value->nip_baru);

			$tpp[$key] = $this->peringkat_talent_model->get_k_tpp($id_pegawai);

		}

		// print_r($tpp); die();
		

		$data['pegawai'] = $pegawai;
		$data['date_now'] = $date_now;
		
		$data['indikator'] = $indikator;
		$data['pendidikan'] = $pendidikan;
		$data['masa_kerja'] = $masa_kerja;
		$data['jabatan'] = $jabatan;
		$data['pelatihan'] = $pelatihan;

		$data['prestasi'] = $prestasi;
		$data['penugasan'] = $penugasan;
		$data['peer'] = $peer;
		$data['tpp'] = $tpp;

		$this->operate($data,$id);

		// $this->load->view('tes',$data);


	}	

	function operate($data,$id)
	{
		$pegawai = $data['pegawai'];
		$date_now = $data['date_now'];

		$indikator = $data['indikator'];
		$pendidikan = $data['pendidikan'];
		$masa_kerja = $data['masa_kerja'];
		$jabatan = $data['jabatan'];
		$pelatihan = $data['pelatihan'];

		$prestasi = $data['prestasi'];
		$penugasan = $data['penugasan'];
		$peer = $data['peer'];
		$tpp = $data['tpp'];

		foreach ($pegawai as $key => $value){
			$skor_assestment = $skor_pendidikan = $skor_masa_kerja = $skor_jabatan = $skor_pelatihan = 0;
			$skor_ppk_pns = $skor_prestasi = $skor_penugasan = $skor_peer = $skor_tpp = $skor_lkh = 0;

			$bobot_assestment 			= 25;
			$bobot_pendidikan 			= 20;
			$bobot_masa_kerja 			= 20;
			$bobot_jabatan 				= 20;
			$bobot_pelatihan 			= 15;

			$bobot_ppk_pns 				= 20;
			$bobot_prestasi				= 20;
			$bobot_penugasan 			= 25;
			$bobot_peer 				= 15;
			$bobot_tpp	 				= 5;
			$bobot_lkh	 				= 15;

			$skor_assestment = (@$indikator[$key]['assestment']->assestment_potensi > 0) ? $indikator[$key]['assestment']->assestment_potensi : $skor_assestment;
			$skor_assestment = (@$indikator[$key]['assestment']->assestment_kompetensi > 0) ? $indikator[$key]['assestment']->assestment_kompetensi : $skor_assestment;

			//HAPUS INI
			$pendidikan[$key]->nilai_ipk = ($pendidikan[$key]->nilai_ipk > 0) ? $pendidikan[$key]->nilai_ipk : rand(300,400)/100;
			$skor_pendidikan = skor_pendidikan(@$pendidikan[$key]->kode_tingkatpendidikan,@$pendidikan[$key]->akreditasi,@$pendidikan[$key]->nilai_ipk);

			$bobot_golongan = array(0,0,0,0,0,0,0,0,0,0,0,0,40,70,100,100,110,120);
			$level_golongan = $masa_kerja[$key]['golongan']->level;
			$skor_masa_kerja = (@$bobot_golongan[$level_golongan] * 0.80) + (@$masa_kerja[$key]['mk'] * 0.20);

			// if (@empty($jabatan[$key]['eselon']->nama_eselon) OR @$jabatan[$key]['eselon']->level < 3) {
			// 	@$jabatan[$key]['eselon']->level = 3;
			// 	@$jabatan[$key]['eselon']->nama_eselon = 'III.b';
			// 	@$jabatan[$key]['mm'] = floor($jabatan[$key]['mm'] / 2);
			// }
			$bobot_eselon = array(0,0,0,50,100,100,100,100,100,100);
			$level_eselon = @$jabatan[$key]['eselon']->level;
			$skor_jabatan = (@$bobot_eselon[$level_eselon] * 0.80) + (@$jabatan[$key]['mm'] * 0.20);

			$skor_pelatihan = skor_pelatihan(@$pelatihan['diklat'][$key],@$pelatihan['kursus'][$key]['pelatihan']->jumlah_jam,@$pelatihan['kursus'][$key]['workshop']->jumlah_jam);

			if ($prestasi[$key]) {
				$hitung_prestasi = skor_prestasi($prestasi[$key]);
				$skor_prestasi = $hitung_prestasi;
			}

			if ($penugasan[$key]) {
				$hitung_penugasan = skor_penugasan($penugasan[$key]);
				$skor_penugasan = $hitung_penugasan['skor'];
			}
			
			$skor_peer = (@$peer[$key]->total_pertanyaan > 0) ? round($peer[$key]->total_nilai/$peer[$key]->total_pertanyaan,2) : 0;
			//HAPUS INI
			$skor_peer = ($skor_peer > 0) ? $skor_peer : rand(400,500)/100;

			$skor_tpp = $tpp[$key];

			$skor_lkh = 5;

			$nilai_assestment = $skor_assestment*($bobot_assestment/100);
			$nilai_pendidikan = $skor_pendidikan*($bobot_pendidikan/100);
			$nilai_masa_kerja = $skor_masa_kerja*($bobot_masa_kerja/100);
			$nilai_jabatan = $skor_jabatan*($bobot_jabatan/100);
			$nilai_pelatihan = $skor_pelatihan*($bobot_pelatihan/100);

			$nilai_potensi = $nilai_assestment + $nilai_pendidikan + $nilai_masa_kerja + $nilai_jabatan + $nilai_pelatihan;

			$skor_ppk_pns = @$indikator[$key]['ppk_pns']->nilai_ppk_pns;

			$nilai_ppk_pns = $skor_ppk_pns*($bobot_ppk_pns/100);
			$nilai_prestasi = $skor_prestasi*($bobot_prestasi/100);
			$nilai_penugasan = $skor_penugasan*($bobot_penugasan/100);
			$nilai_peer = $skor_peer*20*($bobot_peer/100);
			$nilai_tpp = $skor_tpp*($bobot_tpp/100);
			$nilai_lkh = $skor_lkh*20*($bobot_lkh/100);

			$nilai_prestasi = ($nilai_prestasi > $bobot_prestasi) ? $bobot_prestasi : $nilai_prestasi;
			$nilai_penugasan = ($nilai_penugasan > $bobot_penugasan) ? $bobot_penugasan : $nilai_penugasan;

			$nilai_kompetensi = $nilai_ppk_pns + $nilai_prestasi + $nilai_penugasan + $nilai_peer + $nilai_tpp + $nilai_lkh;

			$nilai_talent = ($nilai_potensi + $nilai_kompetensi) / 2;
			$posisi_box = ($nilai_talent) ? floor($nilai_talent / 10) : 0;

			$eselon = $this->db->select("eselon")->where("id_pegawai",$id)->get("pegawai")->row()->eselon;

			$list_prestasi_meraih = $list_prestasi_nominator = $list_penugasan = "";
			foreach ($prestasi[$key] as $row) {
				if ($row->medali == "Meraih") {
					$list_prestasi_meraih .= "<li>{$row->kelas_prestasi}:{$row->medali} ({$row->tahun})</li>";
				}
			}
			foreach ($prestasi[$key] as $row) {
				if ($row->medali == "Nominator") {
					$list_prestasi_nominator .= "<li>{$row->kelas_prestasi}:{$row->medali} ({$row->tahun})</li>";
				}
			}
			foreach ($penugasan[$key] as $row) {
				if ($row->jenis_penugasan) {
					$list_penugasan .= "<li>{$row->nama_penugasan}:{$row->jenis_penugasan} ({$row->tahun})</li>";
				}
			}

			// print_r($list_prestasi_meraih);die();
			$data = array(
				"tahun" => date("Y"),
				"id_pegawai" => $id,
				"id_pegawai_simpeg" => $value->id_pegawai,
				"eselon" => $eselon,
				"nama_lengkap" => $value->nama_lengkap,
				"nip" => $value->nip_baru,
				"assestment_kompetensi" => @number_format($indikator[$key]['assestment']->assestment_kompetensi,2),
				"assestment_potensi" => @number_format($indikator[$key]['assestment']->assestment_potensi,2),
				"skor_assestment" => number_format($skor_assestment,2),
				"nilai_assestment" => number_format($nilai_assestment,2),
				"nama_instansi" => @$pendidikan[$key]->nama_instansi,
				"nama_tingkatpendidikan" => @$pendidikan[$key]->nama_tingkatpendidikan,
				"akreditasi" => @$pendidikan[$key]->akreditasi,
				"nilai_ipk" => @number_format($pendidikan[$key]->nilai_ipk,2),
				"skor_pendidikan" => number_format($skor_pendidikan,2),
				"nilai_pendidikan" => number_format($nilai_pendidikan,2),
				"pangkat_golongan" => @$masa_kerja[$key]['golongan']->pangkat_golongan,
				"masa_kerja" => @number_format($masa_kerja[$key]['mk'],2),
				"skor_masa_kerja" => number_format($skor_masa_kerja,2),
				"nilai_masa_kerja" => number_format($nilai_masa_kerja,2),
				"nama_eselon" => @$jabatan[$key]['eselon']->nama_eselon,
				"masa_jabatan" => @number_format($jabatan[$key]['mm'],2),
				"skor_jabatan" => number_format($skor_jabatan,2),
				"nilai_jabatan" => number_format($nilai_jabatan,2),
				"diklat" => @($pelatihan['diklat'][$key]>0)?'Ya':'Tidak',
				"pelatihan" => @number_format($pelatihan['kursus'][$key]['pelatihan']->jumlah_jam,2),
				"workshop" => @number_format($pelatihan['kursus'][$key]['workshop']->jumlah_jam,2),
				"skor_pelatihan" => number_format($skor_pelatihan,2),
				"nilai_pelatihan" => number_format($nilai_pelatihan,2),
				"nilai_potensi" => number_format($nilai_potensi,2),
				"skor_ppk_pns" => @number_format($skor_ppk_pns,2),
				"nilai_ppk_pns" => number_format($nilai_ppk_pns,2),
				"prestasi_meraih" => $list_prestasi_meraih,
				"prestasi_nominator" => $list_prestasi_nominator,
				"skor_prestasi" => number_format($skor_prestasi,2),
				"nilai_prestasi" => number_format($nilai_prestasi,2),
				"penugasan" => $list_penugasan,
				"skor_penugasan" => number_format($skor_penugasan,2),
				"nilai_penugasan" =>number_format($nilai_penugasan,2),
				"skor_peer" => number_format($skor_peer,2),
				"nilai_peer" => number_format($nilai_peer,2),
				"skor_tpp" => number_format($skor_tpp,2),
				"nilai_tpp" => number_format($nilai_tpp,2),
				"skor_lkh" => number_format($skor_lkh,2),
				"nilai_lkh" => number_format($nilai_lkh,2),
				"nilai_kompetensi" => number_format($nilai_kompetensi,2),
				"nilai_talent" => number_format($nilai_talent,2),
				"posisi_box" => $posisi_box,
			);
			// $this->db->insert('pegawai_talent_simpeg',$data);
		}
	}

	public function get_rating($nip='197903102008011005')
	{
		$this->db->select('rating');
		$this->db->where('laporan_kerja_harian.id_pegawai','1906');
		$this->db->join('laporan_kerja_harian', 'laporan_kerja_harian.id_laporan_kerja_harian = laporan_kerja_harian_rating.id_laporan_kerja_harian', 'left');
		// $this->db->group_by('id_pegawai');
		$get = $this->db->get('laporan_kerja_harian_rating')->result();
		print_r($get);
	}
}
