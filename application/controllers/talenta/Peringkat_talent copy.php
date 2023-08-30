<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peringkat_talent extends CI_Controller
{
	public $user_id;
	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('master_pegawai_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('talenta/peringkat_talent_model');
		$this->load->model('dashboard_model', 'dm');
		$this->load->model('kegiatan_model', 'km');
		$this->load->model('kegiatan_personal_model', 'kpm');
		$this->load->model('realisasi_kegiatan_model', 'rkm');
		$this->load->model('pegawai_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->id_pegawai = $this->user_model->id_pegawai;
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name = $this->user_model->full_name;
		$this->user_level = $this->user_model->level;
		$this->foto_pegawai = $this->user_model->foto_pegawai;
		$this->level_id = @$this->user_model->level_id;

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
	}
	public function index()
	{
		if ($this->user_id) {
			$data['title'] = "Peringkat Talent Struktural - Admin ";
			$data['content'] = "talenta/peringkat_talent/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = 'talenta/peringkat_talent/index';

			$data['rumpun'] = array('Administrasi', 'Ekonomi', 'Hukum', 'KePU-AN', 'Kesehatan', 'Kesejahteraan', 'Lingkungan Hidup', 'Pemerintahan', 'Pertanian');
			$data['pangkat'] = array('Juru Muda', 'Juru Muda Tk. 1', 'Juru', 'Juru Tk. 1', 'Pengatur Muda', 'Pengatur Muda Tk. 1', 'Pengatur', 'Pengatur Tk. 1', 'Penata Muda', 'Penata Muda Tk. 1', 'Penata', 'Penata Tk. 1', 'Pembina', 'Pembina Tk. 1', 'Pembina Utama Muda', 'Pembina Utama Madya', 'Pembina Utama');
			$data['golongan'] = array('I/a', 'I/b', 'I/c', 'I/d', 'II/a', 'II/b', 'II/c', 'II/d', 'III/a', 'III/b', 'III/c', 'III/d', 'IV/a', 'IV/b', 'IV/c', 'IV/d', 'IV/e');
			$data['pendidikan'] = array('SD / Sederajat', 'SMP / Sederajat', 'SMA / Sederajat', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3');
			$data['eselon'] = array('I.a', 'I.b', 'II.a', 'II.b', 'III.a', 'III.b', 'IV.a', 'IV.b');
			$data['hasil_asesmen'] = array('perlu_pengembangan', 'perlu_pengembangan_lebih_lanjut', 'sesuai', 'sesuai_dengan_pengembangan');
			$data['diklat_pim'] = array('I', 'II', 'III', 'IV');
			$data['masa_kerja'] = array('< 3' => 'Kurang dari 3 tahun', '3 s.d 5' => '3 sampai 5 tahun', '> 5' => 'Lebih dari 5 tahun');
			$rumpun = isset($_GET['rumpun']) ? $_GET['rumpun'] : '';
			$eselon = isset($_GET['eselon']) ? $_GET['eselon'] : '';
			$fkuadran = isset($_GET['kuadran']) ? $_GET['kuadran'] : '';
			$list = $this->peringkat_talent_model->get_all($rumpun, $eselon);
			if (!empty($list)) {
				foreach ($list as $key => $l) {
					$list[$key]->jumlah_nilai = $l->nilai_kompetensi + $l->nilai_kinerja;
					$list[$key]->kuadran = get_kuadran($l->kategori_kompetensi, $l->kategori_kinerja);
					$jumlah_nilai[$key] = $list[$key]->jumlah_nilai;
					$kuadran[$key] = $list[$key]->kuadran;
					if (!empty($fkuadran)) {
						// echo $list[$key]->kuadran."-".$fkuadran."<br>";
						if (trim($list[$key]->kuadran) !== trim($fkuadran)) {
							unset($list[$key]);
							unset($jumlah_nilai[$key]);
							unset($kuadran[$key]);
						} else {
							// echo "asd";die;
							$jumlah_nilai[$key] = $list[$key]->jumlah_nilai;
							$kuadran[$key] = $list[$key]->kuadran;
						}
					} else {
						$jumlah_nilai[$key] = $list[$key]->jumlah_nilai;
						$kuadran[$key] = $list[$key]->kuadran;
					}
				}
				// die;
				$data['selected_rumpun'] = $rumpun;
				$data['selected_eselon'] = $eselon;
				array_multisort($kuadran, SORT_DESC, $jumlah_nilai, SORT_DESC, $list);
			}

			$data['count_kuadran'] = array();
			foreach ($list as $l) {
				if (isset($data['count_kuadran'][$l->kuadran])) {
					$data['count_kuadran'][$l->kuadran]++;
				} else {
					$data['count_kuadran'][$l->kuadran] = 1;
				}
			}

			$data['list'] = $list;
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function ranking()
	{
		if ($this->user_id) {
			$data['title'] = "Peringkat Talent Struktural - Admin ";
			$data['content'] = "talenta/peringkat_talent/simpeg";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = 'talenta/peringkat_talent/simpeg';

			$data['rumpun'] = array('Administrasi', 'Ekonomi', 'Hukum', 'KePU-AN', 'Kesehatan', 'Kesejahteraan', 'Lingkungan Hidup', 'Pemerintahan', 'Pertanian');
			$data['pangkat'] = array('Juru Muda', 'Juru Muda Tk. 1', 'Juru', 'Juru Tk. 1', 'Pengatur Muda', 'Pengatur Muda Tk. 1', 'Pengatur', 'Pengatur Tk. 1', 'Penata Muda', 'Penata Muda Tk. 1', 'Penata', 'Penata Tk. 1', 'Pembina', 'Pembina Tk. 1', 'Pembina Utama Muda', 'Pembina Utama Madya', 'Pembina Utama');
			$data['golongan'] = array('I/a', 'I/b', 'I/c', 'I/d', 'II/a', 'II/b', 'II/c', 'II/d', 'III/a', 'III/b', 'III/c', 'III/d', 'IV/a', 'IV/b', 'IV/c', 'IV/d', 'IV/e');
			$data['pendidikan'] = array('SD / Sederajat', 'SMP / Sederajat', 'SMA / Sederajat', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3');
			$data['eselon'] = array('I.a', 'I.b', 'II.a', 'II.b', 'III.a', 'III.b', 'IV.a', 'IV.b');
			$data['hasil_asesmen'] = array('perlu_pengembangan', 'perlu_pengembangan_lebih_lanjut', 'sesuai', 'sesuai_dengan_pengembangan');
			$data['diklat_pim'] = array('I', 'II', 'III', 'IV');
			$data['masa_kerja'] = array('< 3' => 'Kurang dari 3 tahun', '3 s.d 5' => '3 sampai 5 tahun', '> 5' => 'Lebih dari 5 tahun');
			$rumpun = isset($_GET['rumpun']) ? $_GET['rumpun'] : '';
			$eselon = isset($_GET['eselon']) ? $_GET['eselon'] : '';
			$fkuadran = isset($_GET['kuadran']) ? $_GET['kuadran'] : '';
			$list = $this->peringkat_talent_model->get_all_talent($rumpun, $eselon);
			$list_all = $this->peringkat_talent_model->get_all_talent($rumpun, $eselon);
			$data['nilai_kuadran'] = get_nilai_kuadran($eselon);
			if (!empty($list)) {
				foreach ($list as $key => $l) {
					$list[$key]->jumlah_nilai = $l->nilai_talent;
					// $list[$key]->kuadran = get_kuadran_nilai($l->nilai_potensi,$l->nilai_kompetensi);
					$list[$key]->kuadran = $l->posisi_box;
					$jumlah_nilai[$key] = $list[$key]->jumlah_nilai;
					$kuadran[$key] = $list[$key]->kuadran;
					if (!empty($fkuadran)) {
						// echo $list[$key]->kuadran."-".$fkuadran."<br>";
						if (trim($list[$key]->kuadran) !== trim($fkuadran)) {
							unset($list[$key]);
							unset($jumlah_nilai[$key]);
							unset($kuadran[$key]);
						} else {
							// echo "asd";die;
							$jumlah_nilai[$key] = $list[$key]->jumlah_nilai;
							$kuadran[$key] = $list[$key]->kuadran;
						}
					} else {
						$jumlah_nilai[$key] = $list[$key]->jumlah_nilai;
						$kuadran[$key] = $list[$key]->kuadran;
					}
				}
				// die;
				$data['selected_rumpun'] = $rumpun;
				$data['selected_eselon'] = $eselon;
				array_multisort($kuadran, SORT_DESC, $jumlah_nilai, SORT_DESC, $list);
			}

			$data['count_kuadran'] = array();
			foreach ($list_all as $l) {
				// $l->kuadran = get_kuadran_nilai($l->nilai_potensi,$l->nilai_kompetensi);
				$l->kuadran = $l->posisi_box;
				if (isset($data['count_kuadran'][$l->kuadran])) {
					$data['count_kuadran'][$l->kuadran]++;
				} else {
					$data['count_kuadran'][$l->kuadran] = 1;
				}
			}

			$data['list'] = $list;
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function fungsional()
	{
		if ($this->user_id) {
			$data['title'] = "Peringkat Talent Fungsional - Admin ";
			$data['content'] = "talenta/peringkat_talent/fungsional";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = 'talenta/peringkat_talent/fungsional';
			$jabatan = isset($_GET['jabatan']) ? $_GET['jabatan'] : '';
			$list = $this->peringkat_talent_model->get_all2('fungsional', $jabatan);
			if (!empty($list)) {
				foreach ($list as $key => $l) {
					$list[$key]->jumlah_nilai = $l->nilai_kompetensi + $l->nilai_kinerja;
					$list[$key]->kuadran = get_kuadran($l->kategori_kompetensi, $l->kategori_kinerja);
					$jumlah_nilai[$key] = $list[$key]->jumlah_nilai;
					$kuadran[$key] = $list[$key]->kuadran;
				}
				$data['selected_jabatan'] = $jabatan;
				array_multisort($kuadran, SORT_DESC, $jumlah_nilai, SORT_DESC, $list);
			}

			$data['count_kuadran'] = array();
			foreach ($list as $l) {
				if (isset($data['count_kuadran'][$l->kuadran])) {
					$data['count_kuadran'][$l->kuadran]++;
				} else {
					$data['count_kuadran'][$l->kuadran] = 1;
				}
			}

			// print_r($data['count_kuadran']);die;

			$data['jabatan'] = $this->peringkat_talent_model->get_jabatan('fungsional');

			$data['list'] = $list;
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}
	public function pelaksana()
	{
		if ($this->user_id) {
			$data['title'] = "Peringkat Talent Pelaksana - Admin ";
			$data['content'] = "talenta/peringkat_talent/pelaksana";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = 'talenta/peringkat_talent/pelaksana';
			$rumpun = isset($_GET['rumpun']) ? $_GET['rumpun'] : '';
			$list = $this->peringkat_talent_model->get_all2('pelaksana', '', $rumpun);
			if (!empty($list)) {
				foreach ($list as $key => $l) {
					$list[$key]->jumlah_nilai = $l->nilai_kompetensi + $l->nilai_kinerja;
					$list[$key]->kuadran = get_kuadran($l->kategori_kompetensi, $l->kategori_kinerja);
					$jumlah_nilai[$key] = $list[$key]->jumlah_nilai;
					$kuadran[$key] = $list[$key]->kuadran;
				}
				$data['selected_rumpun'] = $rumpun;
				array_multisort($kuadran, SORT_DESC, $jumlah_nilai, SORT_DESC, $list);
			}

			$data['count_kuadran'] = array();
			foreach ($list as $l) {
				if (isset($data['count_kuadran'][$l->kuadran])) {
					$data['count_kuadran'][$l->kuadran]++;
				} else {
					$data['count_kuadran'][$l->kuadran] = 1;
				}
			}

			// print_r($data['count_kuadran']);die;

			$data['rumpun'] = $this->peringkat_talent_model->get_rumpun('pelaksana');

			$data['list'] = $list;
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function get_talent($nip = null)
	{
		echo "GENERATE: " . date('Y-m-d H:i:s') . "\n\n";
		if ($nip != null and strlen($nip) == 18) {
			$this->db->select("nip,id_pegawai");
			$this->db->where('nip', $nip);
			// $this->db->group_start();
			// $this->db->or_like("eselon", "II.", 'both');
			// $this->db->group_end();
			$this->db->where('pensiun !=', 1);
			$this->db->where('id_skpd !=', 0);
			$this->db->group_by('nip');
			$query = $this->db->get("pegawai");
			$get = $query->row();
			echo "INPUT DATA -> NIP :" . $get->nip;
			echo "\n";
			$this->generate($get->nip, $get->id_pegawai);
		} else {
			$nip_guru = array('197403171993031002', '197008101994032006', '197105151993072001', '196802101988032002', '196708011988031005', '196808071993071001', '197509302005011003', '196604101994031008', '196804021988032003', '196709011988031005', '196610101993031009', '197301161993032005', '196606111994121002', '196704061993071001', '197206261999031008', '196702241989032006', '196801121989022001', '196604161986032008', '196706041994032005', '197101011995081001', '196702152005012001', '197006041998022004', '196609181994032009', '196705181991031004', '196609031992122002', '197403031996032002', '197106281997022003', '196705101991032006', '197001012005012020', '196708131986101002', '196704051996031003', '197311151996032003', '196806142003121002', '196605081986032010', '196704072007012010', '196706151988031006', '197603242005011005', '196707151988031007', '198105212005011007', '196610011993071001', '196603021994032003', '196906261992012001', '197111221993072001', '196808181988032010', '196610261997032003');

			$this->db->select("nip,id_pegawai");

			// $this->db->where('nip','196808031988031004'); #Tarik 1 nip saja
			// $this->db->or_where('nip','197012111997021001'); #Tarik 1 nip saja

			$this->db->group_start();
			$this->db->or_like("eselon", "II.", 'both');
			$this->db->or_like("eselon", "IV.", 'after');
			$this->db->or_where("eselon", "Fungsional Tertentu");
			$this->db->or_where_in('nip', $nip_guru);
			$this->db->group_end();

			$this->db->where('pensiun !=', 1);
			$this->db->group_by('nip');
			// $this->db->limit(50,0);
			$query = $this->db->get("pegawai");
			$get = $query->result();
			echo "TOTAL DATA = " . count($get) . "\n";
			foreach ($get as $key => $value) {
				$no = $key + 1;
				$nip[] = $value->nip;
				echo "INPUT DATA NO." . $no . " -> NIP :" . $value->nip;
				echo "\n";
				$this->generate($value->nip, $value->id_pegawai);
				// echo "$value->nip <br>";
			}
			// $this->db->select("nip,id_pegawai");
			// $this->db->like("eselon", "III.", 'after');
			// $this->db->where('pensiun !=', 1);
			// $this->db->limit(100, 100)->group_by('nip');
			// $query = $this->db->get("pegawai");
			// $get = $query->result();
			// foreach ($get as $key => $value) {
			// 	$no = $key + 1;
			// 	// $nip[] = $value->nip;
			// 	// echo "INPUT DATA NO.".$no." -> NIP :".$value->nip;
			// 	// echo "<br>";
			// 	// $this->generate($value->nip,$value->id_pegawai);
			// }
		}
		// echo count($nip);
		$this->update_posisi_box();
		$unique = array_unique($nip);
		print_r(count($unique));
	}

	public function generate($nip = "", $id = "")
	{
		if (!$this->user_id) {
			// redirect("admin/login");
		}

		$get_api = curlSimpeg('talenta?nip=' . $nip);
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

		$indikator = $pendidikan = $masa_kerja = $jabatan = $pelatihan = $prestasi = $penugasan = $peer = $tpp = array();

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

		$date_now = date_create(date('Y-m-d'));

		foreach ($pegawai as $key => $value) {
			$id_pegawai = $this->db->select('id_pegawai')->where('nip', $value->nip_baru)->where('id_skpd !=', 0)->get('pegawai')->row()->id_pegawai;
			//sumbu Y
			$indikator[$key]['assestment'] = (@$indikator[$key]['assestment']) ? @$indikator[$key]['assestment'] : @$get_api->indikator[$key]->assestment;

			$pendidikan[$key] = (@$pendidikan[$key]->tahun_lulus >= @$get_api->pendidikan[$key]->tahun_lulus) ? @$pendidikan[$key] : @$get_api->pendidikan[$key];

			$masa_kerja[$key]['golongan'] = (@$masa_kerja[$key]['golongan']->tmt_pangkat >= @$get_api->masa_kerja[$key]->golongan->tmt_pangkat) ? @$masa_kerja[$key]['golongan'] : @$get_api->masa_kerja[$key]->golongan;

			$date_cpns = date_create($value->tmt_cpns);
			$date_golongan = date_create($masa_kerja[$key]['golongan']->tmt_pangkat);
			$diff = date_diff($date_golongan, $date_now);
			$masa_kerja[$key]['mk'] = (($diff->format('%y') * 12) + $diff->format('%m'));

			$jabatan[$key]['data'] = (@$jabatan[$key]['data']->id_ref_eselon > 0 and (@$jabatan[$key]['data']->id_ref_eselon <= @$get_api->jabatan[$key]->data->id_ref_eselon and @$jabatan[$key]['data']->tmt_berlaku <= @$get_api->jabatan[$key]->data->tmt_berlaku)) ? @$jabatan[$key]['data'] : @$get_api->jabatan[$key]->data;

			if ($jabatan[$key]['data']) {
				$date_berlaku = date_create($jabatan[$key]['data']->tmt_berlaku);
				$diff = date_diff($date_berlaku, $date_now);
				$jabatan[$key]['mm'] = (($diff->format('%y') * 12) + $diff->format('%m'));

				$this->db_simpeg->where('id_eselon', $jabatan[$key]['data']->id_ref_eselon);
				$jabatan[$key]['eselon'] = $this->db_simpeg->get('ref_eselon')->row();
			} else {
				$jabatan[$key]['mm'] = 0;
				$jabatan[$key]['eselon'] = 0;
			}

			$pelatihan['diklat'][$key] = (@$get_api->pelatihan->diklat[$key]) ? @$get_api->pelatihan->diklat[$key] : @$pelatihan['diklat'][$key];

			@$pelatihan['kursus'][$key]['pelatihan']->jumlah_jam = @$pelatihan['kursus'][$key]['pelatihan']->jumlah_jam + @$get_api->pelatihan->kursus[$key]->pelatihan->jumlah_jam;

			@$pelatihan['kursus'][$key]['workshop']->jumlah_jam = @$pelatihan['kursus'][$key]['workshop']->jumlah_jam + @$get_api->pelatihan->kursus[$key]->workshop->jumlah_jam;

			$indikator[$key]['wawancara'] = (@$indikator[$key]['wawancara']) ? @$indikator[$key]['wawancara'] : @$get_api->indikator[$key]->wawancara;


			//sumbu X
			$indikator[$key]['ppk_pns'] = (@$indikator[$key]['ppk_pns']) ? @$indikator[$key]['ppk_pns'] : @$get_api->indikator[$key]->ppk_pns;

			$prestasi[$key] = (object) array_merge((array) @$prestasi[$key], (array) @$get_api->prestasi[$key]);

			$penugasan[$key] = (object) array_merge((array) @$penugasan[$key], (array) @$get_api->penugasan[$key]);


			$peer[$key] = $this->peringkat_talent_model->get_k_peer_maksiti($value->nip_baru);

			$tpp[$key] = $this->peringkat_talent_model->get_k_tpp($id_pegawai);

			$rating[$key] = $this->peringkat_talent_model->get_k_rating($id_pegawai);
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
		$data['rating'] = $rating;

		$this->operate($data, $id);

		// $this->load->view('tes',$data);


	}

	function tpp($id_pegawai)
	{
		echo "<pre>";
		print_r($this->peringkat_talent_model->get_k_tpp($id_pegawai));
		echo "</pre>";
	}

	function operate($data, $id)
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
		$rating = $data['rating'];

		foreach ($pegawai as $key => $value) {
			$skor_assestment = $skor_pendidikan = $skor_masa_kerja = $skor_jabatan = $skor_pelatihan = 0;
			$skor_ppk_pns = $skor_prestasi = $skor_penugasan = $skor_peer = $skor_tpp = $skor_lkh = 0;

			$bobot_assestment = 19; //15;
			$bobot_pendidikan = 19; //15;
			$bobot_masa_kerja = 19; //15;
			$bobot_jabatan = 24; //20;
			$bobot_pelatihan = 19; //15;
			$bobot_wawancara = 0; //20;

			$bobot_ppk_pns = 20;
			$bobot_prestasi = 15;
			$bobot_penugasan = 25;
			$bobot_peer = 15;
			$bobot_tpp = 10;
			$bobot_lkh = 15;

			// $skor_assestment = (@$indikator[$key]['assestment']->assestment_potensi > 0) ? $indikator[$key]['assestment']->assestment_potensi : $skor_assestment;
			$skor_assestment = (@$indikator[$key]['assestment']->assestment_kompetensi > 0) ? $indikator[$key]['assestment']->assestment_kompetensi : $skor_assestment;

			//HAPUS INI
			// $pendidikan[$key]->nilai_ipk = ($pendidikan[$key]->nilai_ipk > 0) ? $pendidikan[$key]->nilai_ipk : rand(300,400)/100;
			$skor_pendidikan = skor_pendidikan(@$pendidikan[$key]->kode_tingkatpendidikan, @$pendidikan[$key]->akreditasi, @$pendidikan[$key]->nilai_ipk);

			$bobot_golongan = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 10, 20, 40, 70, 100, 100, 110, 120);
			$level_golongan = $masa_kerja[$key]['golongan']->level;
			$skor_masakerja = (@$masa_kerja[$key]['mk'] > 100) ? 100 : @$masa_kerja[$key]['mk'];
			$skor_masa_kerja = (@$bobot_golongan[$level_golongan] * 0.80) + ($skor_masakerja * 0.20);

			// if (@empty($jabatan[$key]['eselon']->nama_eselon) OR @$jabatan[$key]['eselon']->level < 3) {
			// 	@$jabatan[$key]['eselon']->level = 3;
			// 	@$jabatan[$key]['eselon']->nama_eselon = 'III.b';
			// 	@$jabatan[$key]['mm'] = floor($jabatan[$key]['mm'] / 2);
			// }
			$bobot_eselon = array(0, 25, 50, 50, 100, 90, 100, 100, 105, 110);
			$level_eselon = @$jabatan[$key]['eselon']->level;
			$skor_masajabatan = (@$jabatan[$key]['mm'] > 100) ? 100 : @$jabatan[$key]['mm'];
			$skor_jabatan = (@$bobot_eselon[$level_eselon] * 0.80) + ($skor_masajabatan * 0.20);

			$skor_wawancara = @$indikator[$key]['wawancara']->wawancara;

			$skor_ppk_pns = @$indikator[$key]['ppk_pns']->nilai_ppk_pns;

			$skor_pelatihan = skor_pelatihan(@$jabatan[$key]['eselon']->kode_eselon, @$pelatihan['diklat'][$key], @$pelatihan['kursus'][$key]['pelatihan']->jumlah_jam, @$pelatihan['kursus'][$key]['workshop']->jumlah_jam);

			if ($prestasi[$key]) {
				$hitung_prestasi = skor_prestasi($prestasi[$key]);
				$skor_prestasi = $hitung_prestasi;
			}

			if ($penugasan[$key]) {
				$hitung_penugasan = skor_penugasan($penugasan[$key]);
				$skor_penugasan = $hitung_penugasan['skor'];
			}

			$skor_peer = (@$peer[$key]->total_pertanyaan > 0) ? round($peer[$key]->total_nilai / $peer[$key]->total_pertanyaan, 2) : 0;
			//HAPUS INI
			// $skor_peer = ($skor_peer > 0) ? $skor_peer : rand(400,500)/100;

			$skor_tpp = $tpp[$key];

			$skor_lkh = $rating[$key];

			$nilai_assestment = $skor_assestment * ($bobot_assestment / 100);
			$nilai_pendidikan = $skor_pendidikan * ($bobot_pendidikan / 100);
			$nilai_masa_kerja = $skor_masa_kerja * ($bobot_masa_kerja / 100);
			$nilai_jabatan = $skor_jabatan * ($bobot_jabatan / 100);
			$nilai_pelatihan = $skor_pelatihan * ($bobot_pelatihan / 100);
			$nilai_wawancara = $skor_wawancara * ($bobot_wawancara / 100);

			$nilai_potensi = $nilai_assestment + $nilai_pendidikan + $nilai_masa_kerja + $nilai_jabatan + $nilai_pelatihan + $nilai_wawancara;

			$nilai_ppk_pns = $skor_ppk_pns * ($bobot_ppk_pns / 100);
			$nilai_prestasi = $skor_prestasi * ($bobot_prestasi / 100);
			$nilai_penugasan = $skor_penugasan * ($bobot_penugasan / 100);
			$nilai_peer = $skor_peer * 20 * ($bobot_peer / 100);
			$nilai_tpp = $skor_tpp * ($bobot_tpp / 100);
			$nilai_lkh = $skor_lkh * 20 * ($bobot_lkh / 100);

			$nilai_prestasi = ($nilai_prestasi > $bobot_prestasi) ? $bobot_prestasi : $nilai_prestasi;
			$nilai_penugasan = ($nilai_penugasan > $bobot_penugasan) ? $bobot_penugasan : $nilai_penugasan;

			$nilai_kompetensi = $nilai_ppk_pns + $nilai_prestasi + $nilai_penugasan + $nilai_peer + $nilai_tpp + $nilai_lkh;

			$nilai_talent = ($nilai_potensi + $nilai_kompetensi) / 2;
			$posisi_box = 0 /* get_kuadran_nilai($nilai_potensi,$nilai_kompetensi) */;

			$eselon = $this->db->select("eselon")->where("id_pegawai", $id)->get("pegawai")->row()->eselon;

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
				"assestment_kompetensi" => @number_format($indikator[$key]['assestment']->assestment_kompetensi, 2),
				"assestment_potensi" => @number_format($indikator[$key]['assestment']->assestment_potensi, 2),
				"skor_assestment" => number_format($skor_assestment, 2),
				"nilai_assestment" => number_format($nilai_assestment, 2),
				"nama_instansi" => @$pendidikan[$key]->nama_instansi,
				"nama_tingkatpendidikan" => @$pendidikan[$key]->nama_tingkatpendidikan,
				"akreditasi" => @$pendidikan[$key]->akreditasi,
				"nilai_ipk" => @number_format($pendidikan[$key]->nilai_ipk, 2),
				"skor_pendidikan" => number_format($skor_pendidikan, 2),
				"nilai_pendidikan" => number_format($nilai_pendidikan, 2),
				"pangkat_golongan" => @$masa_kerja[$key]['golongan']->pangkat_golongan,
				"masa_kerja" => @number_format($masa_kerja[$key]['mk'], 2),
				"skor_masa_kerja" => number_format($skor_masa_kerja, 2),
				"nilai_masa_kerja" => number_format($nilai_masa_kerja, 2),
				"nama_eselon" => @$jabatan[$key]['eselon']->nama_eselon,
				"masa_jabatan" => @number_format($jabatan[$key]['mm'], 2),
				"skor_jabatan" => number_format($skor_jabatan, 2),
				"nilai_jabatan" => number_format($nilai_jabatan, 2),
				"diklat" => @($pelatihan['diklat'][$key] > 0) ? 'Ya' : 'Tidak',
				"pelatihan" => @number_format($pelatihan['kursus'][$key]['pelatihan']->jumlah_jam, 2),
				"workshop" => @number_format($pelatihan['kursus'][$key]['workshop']->jumlah_jam, 2),
				"skor_pelatihan" => number_format($skor_pelatihan, 2),
				"nilai_pelatihan" => number_format($nilai_pelatihan, 2),
				"nilai_potensi" => number_format($nilai_potensi, 2),
				"skor_wawancara" => @number_format($skor_wawancara, 2),
				"nilai_wawancara" => number_format($nilai_wawancara, 2),
				"skor_ppk_pns" => @number_format($skor_ppk_pns, 2),
				"nilai_ppk_pns" => number_format($nilai_ppk_pns, 2),
				"prestasi_meraih" => $list_prestasi_meraih,
				"prestasi_nominator" => $list_prestasi_nominator,
				"skor_prestasi" => number_format($skor_prestasi, 2),
				"nilai_prestasi" => number_format($nilai_prestasi, 2),
				"penugasan" => $list_penugasan,
				"skor_penugasan" => number_format($skor_penugasan, 2),
				"nilai_penugasan" => number_format($nilai_penugasan, 2),
				"skor_peer" => number_format($skor_peer, 2),
				"nilai_peer" => number_format($nilai_peer, 2),
				"skor_tpp" => number_format($skor_tpp, 2),
				"nilai_tpp" => number_format($nilai_tpp, 2),
				"skor_lkh" => number_format($skor_lkh, 2),
				"nilai_lkh" => number_format($nilai_lkh, 2),
				"nilai_kompetensi" => number_format($nilai_kompetensi, 2),
				"nilai_talent" => number_format($nilai_talent, 2),
				"posisi_box" => $posisi_box,
			);

			$get_data = @$this->db->select('id_pegawai_talent,tahun')->where('nip', $value->nip_baru)->where('tahun', date('Y'))->get('pegawai_talent_simpeg')->row();

			if (@$get_data->id_pegawai_talent and @$get_data->tahun == date('Y')) {
				$this->db->update('pegawai_talent_simpeg', $data, array('id_pegawai_talent' => $get_data->id_pegawai_talent));
				echo "UPDATING..\n";
			} else {
				$this->db->insert('pegawai_talent_simpeg', $data);
				echo "INSERTING...\n";
			}
		}
	}

	function update_posisi_box($nip = null)
	{
		if (!empty($nip)) {
			// $data_potensi = $this->db->select('nilai_potensi')->where('tahun', date('Y'))->where('eselon', $eselon)->get('pegawai_talent_simpeg')->result_array();
			// $data_potensi = array_map('current', $data_potensi);

			// $data_kompetensi = $this->db->select('nilai_kompetensi')->where('tahun', date('Y'))->where('eselon', $eselon)->get('pegawai_talent_simpeg')->result_array();
			// $data_kompetensi = array_map('current', $data_kompetensi);

			// $pegawai_talent = $this->db->select('id_pegawai_talent, nilai_potensi, nilai_kompetensi')->where('tahun', date('Y'))->where('nip', $nip)->get('pegawai_talent_simpeg')->result();

			// foreach ($pegawai_talent as $row) {
			// 	$posisi_box = get_kuadran_nilai_var($row->nilai_potensi, $row->nilai_kompetensi, $data_potensi, $data_kompetensi);

			// 	$this->db->update('pegawai_talent_simpeg', array('posisi_box' => $posisi_box), array('id_pegawai_talent' => $row->id_pegawai_talent));
			// 	echo "UPDATING BOX {$posisi_box}..\n";
			// }
		} else {

			$nip_guru = array('197403171993031002', '197008101994032006', '197105151993072001', '196802101988032002', '196708011988031005', '196808071993071001', '197509302005011003', '196604101994031008', '196804021988032003', '196709011988031005', '196610101993031009', '197301161993032005', '196606111994121002', '196704061993071001', '197206261999031008', '196702241989032006', '196801121989022001', '196604161986032008', '196706041994032005', '197101011995081001', '196702152005012001', '197006041998022004', '196609181994032009', '196705181991031004', '196609031992122002', '197403031996032002', '197106281997022003', '196705101991032006', '197001012005012020', '196708131986101002', '196704051996031003', '197311151996032003', '196806142003121002', '196605081986032010', '196704072007012010', '196706151988031006', '197603242005011005', '196707151988031007', '198105212005011007', '196610011993071001', '196603021994032003', '196906261992012001', '197111221993072001', '196808181988032010', '196610261997032003');

			$data_potensi = $this->db->select('nilai_potensi')->where('tahun', date('Y'))->like('eselon', 'II.', 'after')->where_not_in('nip', $nip_guru)->get('pegawai_talent_simpeg')->result_array();
			$data_potensi = array_map('current', $data_potensi);

			$data_kompetensi = $this->db->select('nilai_kompetensi')->where('tahun', date('Y'))->like('eselon', 'II.', 'after')->where_not_in('nip', $nip_guru)->get('pegawai_talent_simpeg')->result_array();
			$data_kompetensi = array_map('current', $data_kompetensi);

			$pegawai_talent = $this->db->select('id_pegawai_talent, nilai_potensi, nilai_kompetensi')->where('tahun', date('Y'))->like('eselon', 'II.', 'after')->where_not_in('nip', $nip_guru)->get('pegawai_talent_simpeg')->result();

			foreach ($pegawai_talent as $row) {
				$posisi_box = get_kuadran_nilai_var($row->nilai_potensi, $row->nilai_kompetensi, $data_potensi, $data_kompetensi);

				$this->db->update('pegawai_talent_simpeg', array('posisi_box' => $posisi_box), array('id_pegawai_talent' => $row->id_pegawai_talent));
				echo "UPDATING BOX {$posisi_box}..\n";
			}

			$data_potensi = $this->db->select('nilai_potensi')->where('tahun', date('Y'))->group_start()->like('eselon', 'III.', 'after')->or_where_in('nip', $nip_guru)->group_end()->get('pegawai_talent_simpeg')->result_array();
			$data_potensi = array_map('current', $data_potensi);

			$data_kompetensi = $this->db->select('nilai_kompetensi')->where('tahun', date('Y'))->group_start()->like('eselon', 'III.', 'after')->or_where_in('nip', $nip_guru)->group_end()->get('pegawai_talent_simpeg')->result_array();
			$data_kompetensi = array_map('current', $data_kompetensi);

			$pegawai_talent = $this->db->select('id_pegawai_talent, nilai_potensi, nilai_kompetensi')->where('tahun', date('Y'))->group_start()->like('eselon', 'III.', 'after')->or_where_in('nip', $nip_guru)->group_end()->get('pegawai_talent_simpeg')->result();

			foreach ($pegawai_talent as $row) {
				$posisi_box = get_kuadran_nilai_var($row->nilai_potensi, $row->nilai_kompetensi, $data_potensi, $data_kompetensi);

				$this->db->update('pegawai_talent_simpeg', array('posisi_box' => $posisi_box), array('id_pegawai_talent' => $row->id_pegawai_talent));
				echo "UPDATING BOX {$posisi_box}..\n";
			}

			$data_potensi = $this->db->select('nilai_potensi')->where('tahun', date('Y'))->group_start()->or_not_like('eselon', 'II.', 'both')->or_where('eselon', null)->group_end()->where_not_in('nip', $nip_guru)->get('pegawai_talent_simpeg')->result_array();
			$data_potensi = array_map('current', $data_potensi);

			$data_kompetensi = $this->db->select('nilai_kompetensi')->where('tahun', date('Y'))->group_start()->or_not_like('eselon', 'II.', 'both')->or_where('eselon', null)->group_end()->where_not_in('nip', $nip_guru)->get('pegawai_talent_simpeg')->result_array();
			$data_kompetensi = array_map('current', $data_kompetensi);

			$pegawai_talent = $this->db->select('id_pegawai_talent, nilai_potensi, nilai_kompetensi')->where('tahun', date('Y'))->group_start()->or_not_like('eselon', 'II.', 'both')->or_where('eselon', null)->group_end()->where_not_in('nip', $nip_guru)->get('pegawai_talent_simpeg')->result();

			foreach ($pegawai_talent as $row) {
				$posisi_box = get_kuadran_nilai_var($row->nilai_potensi, $row->nilai_kompetensi, $data_potensi, $data_kompetensi);

				$this->db->update('pegawai_talent_simpeg', array('posisi_box' => $posisi_box), array('id_pegawai_talent' => $row->id_pegawai_talent));
				echo "UPDATING BOX {$posisi_box}..\n";
			}
		}
	}

	function get_perilaku($nip)
	{
		$rating = $this->peringkat_talent_model->get_k_peer($nip);
		echo "<pre>";
		print_r($rating);
		echo "</pre>";

		$rating = $this->peringkat_talent_model->get_k_peer_maksiti($nip);
		echo "<pre>";
		print_r($rating);
		echo "</pre>";
	}

	function cek_skor_talenta($nip = '197011111991021001')
	{
		$get_api = curlSimpeg('talenta?nip=' . $nip);
		$get_api = json_decode($get_api);
		// print_r($get_api);

		$pegawai = (@$get_api->pegawai) ? $get_api->pegawai : array();

		$indikator = $pendidikan = $masa_kerja = $jabatan = $pelatihan = $prestasi = $penugasan = $peer = $tpp = array();

		$date_now = date_create(date('Y-m-d'));

		foreach ($pegawai as $key => $value) {
			$id_pegawai = $this->db->select('id_pegawai')->where('nip', $value->nip_baru)->where('id_skpd !=', 0)->get('pegawai')->row()->id_pegawai;
			//sumbu Y
			$indikator[$key]['assestment'] = (@$indikator[$key]['assestment']) ? @$indikator[$key]['assestment'] : @$get_api->indikator[$key]->assestment;

			$pendidikan[$key] = (@$pendidikan[$key]->tahun_lulus >= @$get_api->pendidikan[$key]->tahun_lulus) ? @$pendidikan[$key] : @$get_api->pendidikan[$key];

			$masa_kerja[$key]['golongan'] = (@$masa_kerja[$key]['golongan']->tmt_pangkat >= @$get_api->masa_kerja[$key]->golongan->tmt_pangkat) ? @$masa_kerja[$key]['golongan'] : @$get_api->masa_kerja[$key]->golongan;

			$date_cpns = date_create($value->tmt_cpns);
			$date_golongan = date_create($masa_kerja[$key]['golongan']->tmt_pangkat);
			$diff = date_diff($date_golongan, $date_now);
			$masa_kerja[$key]['mk'] = (($diff->format('%y') * 12) + $diff->format('%m'));

			$jabatan[$key]['data'] = (@$jabatan[$key]['data']->id_ref_eselon > 0 and (@$jabatan[$key]['data']->id_ref_eselon <= @$get_api->jabatan[$key]->data->id_ref_eselon and @$jabatan[$key]['data']->tmt_berlaku <= @$get_api->jabatan[$key]->data->tmt_berlaku)) ? @$jabatan[$key]['data'] : @$get_api->jabatan[$key]->data;

			if ($jabatan[$key]['data']) {
				$date_berlaku = date_create($jabatan[$key]['data']->tmt_berlaku);
				$diff = date_diff($date_berlaku, $date_now);
				$jabatan[$key]['mm'] = (($diff->format('%y') * 12) + $diff->format('%m'));

				$this->db_simpeg->where('id_eselon', $jabatan[$key]['data']->id_ref_eselon);
				$jabatan[$key]['eselon'] = $this->db_simpeg->get('ref_eselon')->row();
			} else {
				$jabatan[$key]['mm'] = 0;
				$jabatan[$key]['eselon'] = 0;
			}

			$pelatihan['diklat'][$key] = (@$get_api->pelatihan->diklat[$key]) ? @$get_api->pelatihan->diklat[$key] : @$pelatihan['diklat'][$key];

			@$pelatihan['kursus'][$key]['pelatihan']->jumlah_jam = @$pelatihan['kursus'][$key]['pelatihan']->jumlah_jam + @$get_api->pelatihan->kursus[$key]->pelatihan->jumlah_jam;

			@$pelatihan['kursus'][$key]['workshop']->jumlah_jam = @$pelatihan['kursus'][$key]['workshop']->jumlah_jam + @$get_api->pelatihan->kursus[$key]->workshop->jumlah_jam;

			$indikator[$key]['wawancara'] = (@$indikator[$key]['wawancara']) ? @$indikator[$key]['wawancara'] : @$get_api->indikator[$key]->wawancara;


			//sumbu X
			$indikator[$key]['ppk_pns'] = (@$indikator[$key]['ppk_pns']) ? @$indikator[$key]['ppk_pns'] : @$get_api->indikator[$key]->ppk_pns;

			$prestasi[$key] = (object) array_merge((array) @$prestasi[$key], (array) @$get_api->prestasi[$key]);

			$penugasan[$key] = (object) array_merge((array) @$penugasan[$key], (array) @$get_api->penugasan[$key]);


			$peer[$key] = $this->peringkat_talent_model->get_k_peer_maksiti($value->nip_baru);

			$tpp[$key] = $this->peringkat_talent_model->get_k_tpp($id_pegawai);

			$rating[$key] = $this->peringkat_talent_model->get_k_rating($id_pegawai);
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
		$data['rating'] = $rating;
		// print_r($data);
		echo "<pre>";
		print_r($data['peer']);
		$skor_peer = (@$peer[$key]->total_pertanyaan > 0) ? round($peer[$key]->total_nilai / $peer[$key]->total_pertanyaan, 2) : 0;
		echo "<br/>PEER : " . $skor_peer;
		// print_r($pelatihan['diklat'][$key]);
		// echo "<br/>ESELON : " . $jabatan[$key]['eselon']->kode_eselon;
		// // echo "<br/>DIKPIM : ".print_r($pelatihan['diklat'][$key]);
		// echo "<br/>PELATIHAN : " . $pelatihan['kursus'][$key]['pelatihan']->jumlah_jam;
		// echo "<br/>WORKSHOP : " . $pelatihan['kursus'][$key]['workshop']->jumlah_jam;

		// $skor_pelatihan = skor_pelatihan(@$jabatan[$key]['eselon']->kode_eselon, @$pelatihan['diklat'][$key], @$pelatihan['kursus'][$key]['pelatihan']->jumlah_jam, @$pelatihan['kursus'][$key]['workshop']->jumlah_jam);
		// echo "<br/>SKOR : " . $skor_pelatihan;
	}

	public function tes()
	{
		echo "works..";
	}
}