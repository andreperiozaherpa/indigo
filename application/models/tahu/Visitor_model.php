<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->db_tahu = $this->load->database('tahu', TRUE);
	}
	
	public function cek_visitor($where = null)
	{
		$this->db_tahu->where('ip_address',$this->get_ip());
		$this->db_tahu->where("DATE_FORMAT(date,'%Y-%m-%d')",date('Y-m-d'));
		$query = $this->db_tahu->get('visitor');
		if ($query->num_rows() == 0){
			$this->insert_visitor($where);
		}
		
	}
	public function get_ip()
	{
		$the_ip="";
		//Just get the headers if we can or else use the SERVER global
		if ( function_exists( 'apache_request_headers' ) ) {
			$headers = apache_request_headers();
		} else {
			$headers = $_SERVER;
		}
		//Get the forwarded IP if it exists
		if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
			$the_ip = $headers['X-Forwarded-For'];
		} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
		) {
			$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
		} else {
			
			$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
		}
		return $the_ip;
	}
	public function insert_visitor($where)
	{
		$this->db_tahu->set('ip_address',$this->get_ip());
		$this->db_tahu->set('date',date('Y-m-d H:i:s'));
		if (!empty($where)) {
			$this->db_tahu->set($where);
		}
		$this->db_tahu->insert('visitor');
	}
	public function get_all($where = null)
	{
		if (!empty($where)) {
			$this->db_tahu->where($where);
		}
		return $this->db_tahu->get('visitor')->result();
	}

	public function get_total($where = null)
	{
		if (!empty($where)) {
			$this->db_tahu->where($where);
		}
		return $this->db_tahu->get('visitor')->num_rows();
	}
}
?>