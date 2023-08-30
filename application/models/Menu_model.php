<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	public $id_menu;
	public $parent_id;
	public $menu;
	public $menu_order;
	public $isi_menu;
	public $link;
	public $status;

	public function get_all()
	{
		$query = $this->db->get('menu');
		return $query->result();
	}

	public function insert()
	{
		$this->db->set('parent_id',$this->parent_id);
		$this->db->set('menu',$this->menu);
		$this->db->set('menu_order',$this->menu_order);
		$this->db->set('link',$this->link);
		$this->db->set('isi_menu',$this->isi_menu);
		$this->db->insert('menu');
	}
	public function update()
	{
		$this->db->where('id_menu',$this->id_menu);
		$this->db->set('parent_id',$this->parent_id);
		$this->db->set('menu',$this->menu);
		$this->db->set('menu_order',$this->menu_order);
		$this->db->set('link',$this->link);
		$this->db->set('isi_menu',$this->isi_menu);
		$this->db->update('menu');
	}
	public function delete()
	{
		$this->db->where('id_menu',$this->id_menu);
		$this->db->delete('menu');
	}
	public function set()
	{
		$this->db->where('id_menu',$this->id_menu);
		$query= $this->db->get('menu');
		foreach ($query->result() as $row) {
			$this->id_menu = $row->id_menu;
			$this->parent_id = $row->parent_id;
			$this->menu = $row->menu;
			$this->menu_order = $row->menu_order;
			$this->isi_menu = $row->isi_menu;
			$this->link = $row->link;
		}
	}
	public function set_target($target)
	{
		$this->db->where('link','link/detail/'.$target);
		$query= $this->db->get('menu');
		foreach ($query->result() as $row) {
			$this->id_menu = $row->id_menu;
			$this->parent_id = $row->parent_id;
			$this->menu = $row->menu;
			$this->menu_order = $row->menu_order;
			$this->isi_menu = $row->isi_menu;
			$this->link = $row->link;
		}
	}
}
?>