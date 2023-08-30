<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Predikat extends CI_Model
{
    public $predikat = array(
       'ST' => 'Sangat Tinggi',
       'T'  => 'Tinggi',
       'S'  => 'Sedang',
       'R'  => 'Rendah',
       'SR' => 'Sangat Rendah'
    );

   
    public function getPredikat($nilai)
    {
      $predikat = "";
      if($nilai > 90)
      {
        $predikat = "ST";
      }
      else if($nilai > 75)
      {
        $predikat = "T";
      }
      else if($nilai > 65)
      {
        $predikat = "S";
      }
      else if($nilai > 50)
      {
        $predikat = "R";
      }
      else if($nilai > 0){
        $predikat = "SR";
      }
      return $predikat;
    }
}