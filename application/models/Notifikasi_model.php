<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class notifikasi_model extends CI_Model
{
	public function add($data)
	{
		$this->db->insert('notifikasi',$data);
	}

	public function get($data)
	{
		$this->db->where('notifikasi.user_id !=',$data['user_id']);

		if (isset($data['tipe'])) {
			switch ($data['tipe']) {
				case 'new':
					$this->db->where('NOT FIND_IN_SET("'.$data['user_id'].'", read_notifikasi)');
					break;
				
				default:
					# code...
					break;
			}
		}

		if ($data['is_admin'] == false) {
			$this->db->group_start();
			if (isset($data['user_id'])) $this->db->where('target_notifikasi',"user-".$data['user_id']);
			if (isset($data['unit_kerja_id'])) $this->db->or_where('target_notifikasi',"unit_kerja-".$data['unit_kerja_id']);
			$this->db->group_end();
		}

		$this->db->where('NOT FIND_IN_SET("'.$data['user_id'].'", spam_notifikasi)');

		if (isset($data['limit']) AND isset($data['offset'])) $this->db->limit($data['limit'],$data['offset']);
		$this->db->order_by('tanggal_notifikasi', 'DESC');

		$this->db->join("user", "user.user_id = notifikasi.user_id", "left");
		$this->db->join("ref_unit_kerja", "ref_unit_kerja.id_unit_kerja = user.unit_kerja_id", "left");
		return $this->db->get('notifikasi')->result();
	}

	public function read($data)
	{
		$this->db->select('id_notifikasi, read_notifikasi');
		$this->db->where('notifikasi.user_id !=',$data['user_id']);
		$this->db->where('link_notifikasi',$data['current_uri']);
		$this->db->where('NOT FIND_IN_SET("'.$data['user_id'].'", read_notifikasi)');

		if ($data['is_admin'] == false AND (isset($data['user_id']) OR isset($data['unit_kerja_id']))) {
			$this->db->group_start();
			if (isset($data['user_id'])) $this->db->where('target_notifikasi',"user-".$data['user_id']);
			if (isset($data['unit_kerja_id'])) $this->db->or_where('target_notifikasi',"unit_kerja-".$data['unit_kerja_id']);
			$this->db->group_end();
		}

		$get = $this->db->get('notifikasi')->result();

		foreach ($get as $row) {
			$raw 	= explode(',', $row->read_notifikasi); array_push($raw, $data['user_id']);
			$raw	= array_unique($raw);
			$raw 	= array_filter($raw, 'strlen');
			$read 	= implode(',', $raw);

			$this->db->set('read_notifikasi',$read);
			$this->db->where('id_notifikasi',$row->id_notifikasi);
			$this->db->update('notifikasi');
		}
	}

	public function spam($data)
	{
		$this->db->select('id_notifikasi, spam_notifikasi');
		$this->db->where('notifikasi.user_id !=',$data['user_id']);
		if ($data['id_notifikasi'] != "all") {
			$this->db->where('id_notifikasi',$data['id_notifikasi']);
		}
		$this->db->where('NOT FIND_IN_SET("'.$data['user_id'].'", spam_notifikasi)');

		if ($data['is_admin'] == false AND (isset($data['user_id']) OR isset($data['unit_kerja_id']))) {
			$this->db->group_start();
			if (isset($data['user_id'])) $this->db->where('target_notifikasi',"user-".$data['user_id']);
			if (isset($data['unit_kerja_id'])) $this->db->or_where('target_notifikasi',"unit_kerja-".$data['unit_kerja_id']);
			$this->db->group_end();
		}

		$get = $this->db->get('notifikasi')->result();

		foreach ($get as $row) {
			$raw 	= explode(',', $row->spam_notifikasi); array_push($raw, $data['user_id']);
			$raw	= array_unique($raw);
			$raw 	= array_filter($raw, 'strlen');
			$read 	= implode(',', $raw);

			$this->db->set('spam_notifikasi',$read);
			$this->db->where('id_notifikasi',$row->id_notifikasi);
			$this->db->update('notifikasi');
		}
	}
}
?>