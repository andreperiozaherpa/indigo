<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persyaratan_model extends CI_Model
{
    public function get($param=null,$keyword=null)
    {
        if($param!=null)
        {
            foreach($param as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        if($keyword!=null)
        {
            $this->db->like("persyaratan",$keyword);
        }
        $this->db->order_by("eselon","ASC");
        $query = $this->db->get("mt_persyaratan");
        return $query->result();
    }

    public function insert($data)
    {
        $this->db->insert("mt_persyaratan",$data);
    }

    public function update($data,$id_persyaratan)
    {
        $this->db->where("id_persyaratan",$id_persyaratan);
        $this->db->update("mt_persyaratan",$data);
    }

    public function delete($id_persyaratan)
    {
        $this->db->where("id_persyaratan",$id_persyaratan);
        $this->db->delete("mt_persyaratan_kebutuhan");

        $this->db->where("id_persyaratan",$id_persyaratan);
        $status = $this->db->delete("mt_persyaratan");
        return $status;
    }

    
}
?>