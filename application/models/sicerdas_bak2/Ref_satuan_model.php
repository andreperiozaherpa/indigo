<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ref_satuan_model extends CI_Model
{
   public function get()
   {
       return $this->db->get("ref_satuan")->result();
   }
}