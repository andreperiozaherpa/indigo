<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Misi_model extends CI_Model
{
   public function get()
   {
       return $this->db->get("sc_rpjmd_misi")->result();
   }
   public function insert($data)
   {
       $this->db->insert("sc_rpjmd_misi",$data);
   }
   public function update($data,$id)
   {
       $this->db->where("id_misi",$id);
       $this->db->update("sc_rpjmd_misi",$data);
   }
   public function delete($id)
   {
       $this->db->where("id_misi",$id)->delete("sc_rpjmd_misi");
       return true;
   }
}