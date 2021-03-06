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
        
	public function process_create_user($user, $token) {
            $data = array(
                'fb_id'         => $user->getId(),
                'lastname'      => $user->getLastName(),
                'firstname'     => $user->getFirstName(),
                'name'          => $user->getName(),
                'email'         => $user->getEmail(),
//                'birthday'      => (string)$user->getBirthday(),
//                'begin_date'    => (string)date('Y/m/d'),
                'access_token'  => $token,
                'avatar'        => $this->facebook->get_user_avatar($this->session->userdata('user_token')),
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
    
    public function test() { 
        return $this->facebook->get_user_avatar($this->session->userdata('user_token'));
    }
    public function upload_avatar($id,$string){
        $this->db->where('id',$id);
        $array= array('avatar'=>$string);
        if($this->db->update('users',$array)){
            return true;
        } else{
            return false;
        }
    }
    
}