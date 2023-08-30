<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Socketio {

	protected $CI;
	protected $host;
	protected $port;

	public function __construct($config='')
	{
		$this->host = 'http://localhost';
		$this->port = "3000";
		if($config!=''){
			if(isset($config['host'])){
				$this->host = 'https://'.$config['host'];
			}
			if(isset($config['port'])){
				$this->port = $config['port'];
			}

		}
		$this->CI =& get_instance();
	}

	public function send($method_name,$data='',$javascript_mode=false)
	{
		$this->CI->load->helper('url');
		if($data==''){
			$data_list = '';
		}else{
			$data_list = ',{';
			foreach($data as $key => $value){
				$data_list .= $key.":'".$value."'";
				end($data);
				$last_key = key($data);
				if($key!==$last_key){
					$data_list .= ", ";
				}
			}
			$data_list .= "}";
		}
		if($javascript_mode==false){
			echo "
			<script src=\""."https://e-office.sumedangkab.go.id"."/socket/node_modules/socket.io-client/dist/socket.io.js\"></script>
			<script>
			var socket = io.connect( '".$this->host.":".$this->port."' );
			socket.emit('{$method_name}'".$data_list.");
			</script>";
		}else{
			echo "
			var socket = io.connect( '".$this->host.":".$this->port."' );
			socket.emit('{$method_name}'".$data_list.");";
		}
	}
}