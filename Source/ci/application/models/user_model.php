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
        
	public function process_create_user($user) {
            $data = array(
                'fb_id'         => $user->getId(),
                'lastname'      => $user->getLastName(),
                'firstname'     => $user->getFirstName(),
                'name'          => $user->getName(),
            );
            
            if ($this->db->insert('users', $data)) {
                return true;
            } else {
                    return false;
            }
	}
        
        public function check_exist($fb_id) {
            $query = $this->db->get_where('users', array('fb_id' => $fb_id))->result();
            if (empty($query)) {
                return FALSE;
            }
            return TRUE;
        }
}