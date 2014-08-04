<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	// check location if exist 
	// @return bool

	public function check_exist(){
		$this->db->select("*");
		$this->db->from("location");
		$arr=array('lat'=>$data['lat'],
					'long'=>$data['long']);

		$this->db->where($arr);
		$query=$this->db->get();
		if($query->num_rows==1){
			return true;
		}
		else{
			return false;
		}
	}
	// insert location
	// @return bool
	public function add($data){
		if($this->db->insert('location',$data)){
			return true;
		} else
			return false;
	}

	// select location
	// @return array
	public function get_locations() {
		$query = $this->db->get("location");
		$res = $query->result();

		return $res;
	}
}