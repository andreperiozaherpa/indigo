<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sc_urusan_model extends CI_Model
{
    

    public function get_page($mulai, $hal, $filter = '')
    {
        if ($filter != '') {
            foreach ($filter as $key => $value) {
                $this->db->like($key, $value);
            }
        } else {
            $this->db->limit($hal, $mulai);
        }

        $this->db->select('*');
        $query = $this->db->get('sc_ref_urusan');
        return $query->result();
    }

    public function get_all()
    {
        $query = $this->db->get('sc_ref_urusan');
        return $query->result();   
    }
}

