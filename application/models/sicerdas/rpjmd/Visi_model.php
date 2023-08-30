<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Visi_model extends CI_Model
{
   public function get()
   {
       return $this->db->get("sc_rpjmd_visi")->row();
   }
}