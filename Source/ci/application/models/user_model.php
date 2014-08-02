<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function get_all_users(){
		$query=$this->db->get('users');
		$arr= $query->result_array();
		return $arr;
	}
	public function process_create_user($data) {
		if ($this->db->insert('users', $data)) {
			return true;
		} else {
			return false;
		}
	}
}