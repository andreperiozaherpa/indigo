<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WordPdf {
	protected $CI;

	public function __construct($config='')
	{
		$this->CI =& get_instance();
	}
    function convert($srcFile){
                $url = 'https://psg4-word-view.officeapps.live.com/wv/WordViewer/request.pdf?WOPIsrc=http%3A%2F%2Fpsg4%2Dview%2Dwopi%2Ewopi%2Eonline%2Eoffice%2Enet%3A808%2Foh%2Fwopi%2Ffiles%2F%40%2FwFileId%3FwFileId%3D'.urlencode(base_url($srcFile)).'&access_token=1&access_token_ttl=0&type=downloadpdf';
                try {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $data = curl_exec($ch);
                    curl_close($ch);
                    $data = base64_encode($data);
                    return $data;
                } catch (Exception $e) {
                    return false;
                }
    }
}