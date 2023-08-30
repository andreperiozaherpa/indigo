<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessment extends CI_Controller
{
	public $user_id;
	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('master_pegawai_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('dashboard_model', 'dm');
		$this->load->model('kegiatan_model', 'km');
		$this->load->model('kegiatan_personal_model', 'kpm');
		$this->load->model('realisasi_kegiatan_model', 'rkm');
		$this->load->model('pegawai_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->id_pegawai	= $this->user_model->id_pegawai;
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->foto_pegawai = $this->user_model->foto_pegawai;
		$this->level_id	= $this->user_model->level_id;
	}
	public function index()
	{
		if ($this->user_id) {
			$this->load->model('ref_unit_kerja_model');
			$this->load->model('ref_skpd_model');
			$data['title']		= "Data Assesment - Admin ";
			$data['content']	= "talenta/assessment/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu']		= 'talenta/assessment';
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			$this->db->not_like('nama_jabatan', 'guru', false);
			$data['jabatan'] = $this->db->get('ref_jabatan_new')->result();

            $data['rumpun'] = array('Administrasi','Ekonomi','Hukum','KePU-AN','Kesehatan','Kesejahteraan','Lingkungan Hidup','Pemerintahan','Pertanian');
            $data['pangkat'] = array('Juru Muda','Juru Muda Tk. 1','Juru','Juru Tk. 1','Pengatur Muda','Pengatur Muda Tk. 1','Pengatur','Pengatur Tk. 1','Penata Muda','Penata Muda Tk. 1','Penata','Penata Tk. 1','Pembina','Pembina Tk. 1','Pembina Utama Muda','Pembina Utama Madya','Pembina Utama');
            $data['golongan'] = array('I/a','I/b','I/c','I/d','II/a','II/b','II/c','II/d','III/a','III/b','III/c','III/d','IV/a','IV/b','IV/c','IV/d','IV/e');
            $data['pendidikan'] = array('SD / Sederajat','SMP / Sederajat','SMA / Sederajat','D1','D2','D3','S1','S2','S3');
            $data['eselon'] = array('I.a','I.b','II.a','II.b','III.a','III.b','IV.a','IV.b');
            $data['hasil_asesmen'] = array('perlu_pengembangan','perlu_pengembangan_lebih_lanjut','sesuai','sesuai_dengan_pengembangan');
            $data['diklat_pim'] = array('I','II','III','IV');
            $data['masa_kerja'] = array('< 3'=>'Kurang dari 3 tahun','3 s.d 5'=>'3 sampai 5 tahun','> 5'=>'Lebih dari 5 tahun');

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function get_jabatan_baru()
	{
		$search = $_GET['search'];
		$this->db->like('nama_jabatan', $search);
		$jabatan = $this->db->get('ref_jabatan_new')->result();
		$list = array();
		foreach ($jabatan as $k => $j) {
			$list[$k]['id'] = $j->id_jabatan;
			$list[$k]['text'] = $j->nama_jabatan;
		}
		echo json_encode($list);
	}

	public function fetch_pegawai($id_pegawai = '')
	{
		if ($id_pegawai !== '') {
			echo json_encode($this->db->get_where('pegawai', array('id_pegawai' => $id_pegawai))->row());
		}
	}

	public function update_data()
	{
		if (!empty($_POST)) {
            $data_update = $_POST;
            unset($data_update['id_pegawai']);
			$update = $this->db->update('pegawai',$data_update,array('id_pegawai' => $_POST['id_pegawai']));
			if($update){
				$res = array('result'=>1);
			}else{
				$res = array('result'=>0);
			}
			echo json_encode($res);
		}
	}

	public function list_pegawai()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
		$dir = "";
		if (!empty($order)) {
			foreach ($order as $o) {
				$col = $o['column'];
				$dir = $o['dir'];
			}
		}

		if ($dir != "asc" && $dir != "desc") {
			$dir = "desc";
		}
		$valid_columns = array(
			0 => 'nip',
			1 => 'nama_lengkap',
			2 => 'ref_skpd.nama_skpd',
			3 => 'ref_unit_kerja.nama_unit_kerja',
			4 => 'jabatan'
		);
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		} else {
			$this->db->order_by('id', 'desc');
		}

		if (!empty($search)) {
			$x = 0;
			foreach ($valid_columns as $sterm) {
				if ($x == 0) {
					$this->db->like($sterm, $search);
				} else {
					$this->db->or_like($sterm, $search);
				}
				$x++;
			}
		}
		$this->db->limit($length, $start);
		$this->db->select('*');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd', 'left');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$pegawai = $this->db->get("pegawai");
		$data = array();
		$no = 1+$start;
		foreach ($pegawai->result() as $rows) {

			$data[] = array(
				$no,
				$rows->nip,
				$rows->nama_lengkap,
				$rows->nama_skpd,
				$rows->nama_unit_kerja,
				$rows->jabatan,
				'
                <a href="javascript:void(0)" onclick="mutasi(' . $rows->id_pegawai . ')" class="btn btn-primary btn-rounded">Update Data</a>
           '
			);
			$no++;
		}
		$total_pegawai = $this->totalPegawai();
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_pegawai,
			"recordsFiltered" => $total_pegawai,
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}
	public function totalPegawai()
	{
		$query = $this->db->select("COUNT(*) as num")->get("pegawai");
		$result = $query->row();
		if (isset($result)) return $result->num;
		return 0;
	}
}
