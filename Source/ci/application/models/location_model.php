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
		this->db->select("lat,long");
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
		//check if exist in location
		if( $this->check_exist()==false){
			$this->db->insert('location',$data);
				return true;
		}
		return false;
	}
}