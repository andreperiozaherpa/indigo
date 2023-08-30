<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_pribadi_model extends CI_Model
{

 public function get_list($table, $id_pegawai, $where = FALSE)
 {
  if ($where) {
   $this->db->where($where);
  }
  $this->db->where('id_pegawai', $id_pegawai);
  return $this->db->get($table)->result();
 }

 public function insert($table, $param)
 {
  $this->db->insert($table, $param);
  return $this->db->insert_id();
 }

 public function update($table, $set, $where)
 {
  $this->db->where($where);
  $this->db->update($table, $set);
  return $this->db->affected_rows();
 }

 public function delete($table, $where)
 {
  $this->db->where($where);
  $this->db->delete($table);
  return $this->db->affected_rows();
 }

}
