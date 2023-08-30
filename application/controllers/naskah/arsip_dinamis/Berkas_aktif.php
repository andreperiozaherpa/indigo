<?php

class Berkas_aktif extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('user_model');
        $this->load->model('ref_skpd_model');
        $this->load->model('naskah/surat_klasifikasi_model', 'klasifikasi');
        $this->load->model('naskah/surat_berkas_model', 'surat_berkas');
        $this->load->model('naskah/surat_berkas_detail_model', 'surat_berkas_detail');
        $this->user_model->user_id = $this->user_id;
        $this->user_model->set_user_by_user_id();
        $this->user_picture = $this->user_model->user_picture;
        $this->full_name = $this->user_model->full_name;
        $this->user_level = $this->user_model->level;
        $this->id_pegawai = $this->user_model->id_pegawai;
        $this->level_id = $this->user_model->level_id;
        // if ($this->level_id > 2) redirect("admin");
        $this->load->library('socketio', array('host' => "e-office.sumedangkab.go.id", 'port' => 3000));

        if (!$this->user_id) {
            redirect('admin');
        }
    }

    // VIEW PAGE //
    public function index()
    {
        $data['title'] = "Berkas Aktif";
        $data['user_picture'] = $this->user_picture;
        $data['full_name'] = $this->full_name;
        $data['user_level'] = $this->user_level;
        $data['active_menu'] = "berkas_aktif";
        $data['files'] = $this->surat_berkas->get_all_where(array('status_berkas' => 'aktif', 'id_skpd' => $this->session->userdata('id_skpd')));
        $data['content'] = "naskah/arsip_dinamis/berkas_aktif/index";
        $data['totalFiles'] = $this->surat_berkas->get_total();
        $data['totalFilesProcess'] = null;
        $data['totalFilesClosed'] = null;
        $data['totalFilesExpired'] = null;

        if (!empty($this->session->flashdata('status'))) {
            $data['status'] = $this->session->flashdata('status');
            $data['message'] = $this->session->flashdata('message');
        }

        $this->load->view('admin/index', $data);
    }

    public function berkas_baru()
    {
        $data['title'] = "Tambah Berkas Baru";
        $data['user_picture'] = $this->user_picture;
        $data['full_name'] = $this->full_name;
        $data['user_level'] = $this->user_level;
        $data['active_menu'] = "arsip_dinami/berkas_aktif/berkas_baru";
        $data['content'] = "naskah/arsip_dinamis/berkas_aktif/berkas_baru";

        $this->load->view('admin/index', $data);
    }

    public function save()
    {
        if (!empty($_POST)) {
            $save = $this->surat_berkas->insert_entry();

            if ($save > 0) {
                $status = 200;
                $message = "Berkas baru berhasil disimpan dan dapat diisikan daftar naskah.";
            } else {
                $status = 500;
                $message = "Berkas baru gagal disimpan! Silahkan coba lagi.";
            }

            $this->session->set_flashdata('status', $status);
            $this->session->set_flashdata('message', $message);
        } else {
            $status = 502;
            $message = "Silahkan isi berkas baru sesuai form yang telah disediakan";
        }

        redirect('naskah/arsip_dinamis/berkas_aktif');
    }

    public function view()
    {
        if (!empty($this->input->get('x_slug'))) {
            $data['x_slug'] = $this->input->get('x_slug');
            $data['user_picture'] = $this->user_picture;
            $data['full_name'] = $this->full_name;
            $data['user_level'] = $this->user_level;
            $data['active_menu'] = "berkas_aktif";

            if ($this->session->userdata('level') == 'Administrator') {
                $data['skpd'] = $this->ref_skpd_model->get_all();
            }

            $data['file'] = $this->surat_berkas->get_single_where(array('slug' => $data['x_slug'], 'id_skpd' => $this->session->userdata('id_skpd')));

            if ($this->input->get('for') == "details") {
                $details_out = $this->surat_berkas_detail->get_all_where(array('id_surat_berkas' => $data['file']->id_surat_berkas), 'surat_berkas_keluar');
                $details_in = $this->surat_berkas_detail->get_all_where(array('id_surat_berkas' => $data['file']->id_surat_berkas), 'surat_berkas_masuk');
                $data['details'] = array_merge($details_in, $details_out);
                $data['title'] = "Detail Berkas";
                $data['content'] = 'naskah/arsip_dinamis/berkas_aktif/detail';
            } else {
                $data['details'] = $this->surat_berkas->get_single_where(array('slug' => $data['x_slug']));
                $data['title'] = "Ubah Berkas";
                $data['content'] = 'naskah/arsip_dinamis/berkas_aktif/edit';
            }

            print_r($data['details']);
            die;
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function add_naskah()
    {
        if (!empty($_POST['x_slug'])) {
            $data['user_picture'] = $this->user_picture;
            $data['full_name'] = $this->full_name;
            $data['user_level'] = $this->user_level;
            $data['active_menu'] = "berkas_aktif";
            $data['file'] = $this->surat_berkas->get_single_where(array('slug' => $this->input->post('x_slug')));
            $data['title'] = "Tambah Naskah pada Berkas " . $data['file']->nama_berkas;
            $data['content'] = "naskah/arsip_dinamis/berkas_aktif/add_naskah";

            if ($this->session->userdata('level') == 'Administrator') {
                $data['skpd'] = $this->ref_skpd_model->get_all();
            }

            $this->load->view('admin/index', $data);
        } else {
            redirect('naskah/arsip_dinamis/berkas_aktif');
        }
    }

    public function save_naskah()
    {
        $jenisSurat = $this->input->post('jenis_surat');
        $where = array('slug' => $this->input->post('berkas'));
        $berkas = $this->surat_berkas->get_single_where($where);

        if (!empty($berkas)) {
            $letters = $this->input->post('letters');

            foreach ($letters as $letter) {
                if ($jenisSurat == "keluar") {
                    $save = $this->surat_berkas->insert_detail_keluar_entry($berkas->id_surat_berkas, $letter);
                } else {
                    $save = $this->surat_berkas->insert_detail_masuk_entry($berkas->id_surat_berkas, $letter);
                }
            }

            print_r($save);
            die;
            if ($save) {
                $status = 200;
                $message = 'Berhasil disimpan';
            } else {
                $status = 502;
                $message = 'Gagal disimpan';
            }

            $this->session->set_flashdata('status', $status);
            $this->session->set_flashdata('message', $message);
        }

        redirect('naskah/arsip_dinamis/berkas_aktif/view?x_slug=' . $this->input->post('berkas') . '&for=details');

    }

    public function delete_berkas()
    {
        if (!empty($this->input->post('berkas'))) {
            $result = $this->surat_berkas->get_single_where(array('slug' => $this->input->post('berkas')));

            $delete = $this->surat_berkas->delete_entry($result->id_surat_berkas);

            if ($delete > 0) {
                $status = 200;
            } else {
                $status = 500;
            }
        } else {
            $status = 404;
        }

        $data['status'] = $status;

        echo json_encode($data);
    }

    // JSON OUTPUT //
    public function get_classifications()
    {
        $search = (!empty($this->input->get('search'))) ? $this->input->get('search') : null;
        // $page       = $this->input->get('page');
        $this->db->or_like('kode_gabungan', $search);
        $this->db->or_like('nama_klasifikasi', $search);
        $results = $this->db->get('surat_klasifikasi')->result();

        $list = array();
        foreach ($results as $k => $j) {
            $list[$k]['id'] = $j->id_surat_klasifikasi;
            $list[$k]['text'] = $j->kode_gabungan . ' - ' . $j->nama_klasifikasi;
        }
        echo json_encode($list);
    }

    public function get_classification()
    {
        $results = $this->klasifikasi->get_single_json($this->input->get('suratKlasifikasi'));
        echo json_encode($results);
    }

    public function get_retention()
    {
        $id = $this->input->get('classification');
        $data['number_file'] = $this->surat_berkas->get_last_number_file_active($id);

        echo json_encode($data);
    }

    public function get_surat_keluar_json()
    {
        $this->load->model('surat_keluar_model', 'surat_keluar');

        $search = (!empty($this->input->get('search'))) ? $this->input->get('search') : null;
        $page = $this->input->get('page');

        $isi_berkas = $this->surat_berkas->get_surat_added("surat_keluar");
        foreach ($isi_berkas as $ib) {
            $new_arr[] = $ib['id_surat_keluar'];
        }
        $results = $this->surat_keluar->get_all_wheres($search, $this->input->get('year'), $this->input->get('skpd'), $page, $new_arr);

        if ($results) {
            $data['results'] = $results;
            $data['totalRows'] = $this->surat_keluar->get_total_rows($search, $this->input->get('year'), $this->input->get('skpd'));
            $data['pagination'] = true;
        } else {
            $data['results'] = null;
            $data['totalRows'] = 0;
            $data['pagination'] = false;
        }

        echo json_encode($data);
    }

    public function getSuratKeluar()
    {
        $this->load->model('naskah/surat_keluar_model', 'surat_keluar');

        $search = (!empty($this->input->get('search'))) ? $this->input->get('search') : null;
        $page = $this->input->get('page');

        $isi_berkas = $this->surat_berkas->get_surat_added("surat_keluar");
        foreach ($isi_berkas as $ib) {
            $new_arr[] = $ib['id_surat_keluar'];
        }
        $results = $this->surat_keluar->get_all_wheres($search, $this->input->get('year'), $this->input->get('skpd'), $page, $new_arr);

        $list = array();
        foreach ($results as $k => $j) {
            $list[$k]['id'] = $j->id_surat_keluar;
            $list[$k]['text'] = $j->nomer_surat . ' - ' . $j->perihal;
        }
        echo json_encode($list);
    }

    public function get_surat_masuk_json()
    {
        $this->load->model('surat_masuk_model', 'surat_masuk');

        $search = (!empty($this->input->get('search'))) ? $this->input->get('search') : null;
        $page = $this->input->get('page');

        $isi_berkas = $this->surat_berkas->get_surat_added("surat_masuk");
        foreach ($isi_berkas as $ib) {
            $new_arr[] = $ib['id_surat_masuk'];
        }

        $results = $this->surat_masuk->get_all_where($search, $this->input->get('year'), $this->input->get('skpd'), $page, $new_arr);

        if ($results) {
            $data['results'] = $results;
            $data['totalRows'] = $this->surat_masuk->get_total_rows($search, $this->input->get('year'), $this->input->get('skpd'));
            $data['pagination'] = true;
        } else {
            $data['results'] = null;
            $data['totalRows'] = 0;
            $data['pagination'] = false;
        }

        echo json_encode($data);
    }
    public function getSuratMasuk()
    {
        // show error
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        $this->load->model('naskah/surat_masuk_model', 'surat_masuk');

        $search = (!empty($this->input->get('search'))) ? $this->input->get('search') : null;
        $page = $this->input->get('page');

        $isi_berkas = $this->surat_berkas->get_surat_added("surat_masuk");
        foreach ($isi_berkas as $ib) {
            $new_arr[] = $ib['id_surat_masuk'];
        }

        $results = $this->surat_masuk->get_all_where($search, $this->input->get('year'), $this->input->get('skpd'), $page, $new_arr);

        // print_r($results);
        $list = array();
        foreach ($results as $k => $j) {
            $list[$k]['id'] = $j->id_surat_masuk;
            $list[$k]['text'] = $j->nomer_surat . ' - ' . $j->perihal;
        }
        echo json_encode($list);

    }

    public function get_detail_naskah()
    {
        $uriSegment = $this->input->post('params');
        $jenis = null;
        $tipe = null;

        switch ($uriSegment) {
            case "keluar":
                $tipe = "keluar";
                break;
            case "masuk":
                $tipe = "masuk";
                break;
        }

        $where = array(
            'skpd' => $this->session->userdata('id_skpd'),
            'tipe_surat' => $tipe,
            'temp' => 'N',
            'nomor_urut !=' => 'NULL'
        );

        $columns = array(
            0 => 'no',
            1 => 'tanggal_buat',
            2 => 'nomer_surat',
            3 => 'klasifikasi',
            4 => 'perihal',
            5 => 'isi_ringkasan',
            6 => 'pengirim',
            7 => 'id'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = (!empty($columns[$this->input->post('order')])) ? $columns[$this->input->post('order')[0]['column']] : "";
        $dir = (!empty($this->input->post('order'))) ? $this->input->post('order')[0]['dir'] : "";

        $totalData = $this->kartu_kendali->get_count(null, $where);

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->kartu_kendali->get_all_search_where($where, $limit, $start, null, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts = $this->kartu_kendali->get_all_search_where($where, $limit, $start, $search, $order, $dir);
            $totalFiltered = $this->kartu_kendali->get_count($search, $where);
        }

        $data = array();
        if (!empty($posts)) {
            $receiver = null;
            foreach ($posts as $post) {
                if ($post->jenis_surat == "eksternal") {

                } else {

                }

                $nestedData['no'] = $post->nomor_urut;
                $nestedData['tanggal_buat'] = tanggal_hari($post->tgl_buat);
                $nestedData['nomer_surat'] = $post->nomer_surat;
                $nestedData['klasifikasi'] = $post->surat_klasifikasi->kode_gabungan . " - " . $post->surat_klasifikasi->nama_klasifikasi;
                $nestedData['perihal'] = $post->perihal;
                $nestedData['isi_ringkasan'] = $post->isi_ringkasan;
                $nestedData['pengirim'] = $post->id_pegawai_input->nama_lengkap . " - " . $post->id_pegawai_input->jabatan;
                $nestedData['id'] = $post->id;

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }

}