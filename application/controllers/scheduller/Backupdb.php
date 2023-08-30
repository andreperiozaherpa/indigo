<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backupdb extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function v1($app_token=null)
	{
		if($app_token && ($app_token == $this->config->item("app_token")))
		{
            $tables = array('pegawai','ref_jabatan_baru','ref_skpd','ref_unit_kerja');

            foreach($tables as $table)
            {
                $cmd = 'mysqldump -u e-office -pc0c0d0t93 eoffice '.$table.' > /var/www/im/data/simpeg/proyeksi/'.$table.'.sql';
                exec($cmd);    
            }

            
        }

    }
}