<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Friend_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	// @ check friend
	//check table friend
    public function check_friend($id_user1,$id_user2){
    	$array1=array('user1'=>$id_user1,'user2'=>$id_user2);
    	$this->db->where($array1);
    	$array2=array('user1'=>$id_user2,'user2'=>$id_user1);
    	$this->db->or_where($array2);
    	$query=$this->db->get('friend');
    	if($query->num_rows>0){
    		return true;
    	} else{
    		return false;
    	}

    }
    function check_friend_is($id_user1,$id_user2){
    	$array1=array('user1'=>$id_user1,'user2'=>$id_user2);
    	$this->db->where($array1);
    	$array2=array('user1'=>$id_user2,'user2'=>$id_user1);
    	$this->db->or_where($array2);
    	$query=$this->db->get('friend');
    	
    	return $query->row_array();
    }
    // @ add friend
    // insert table add_friend
    public function add_friend($id_user1,$id_user2){
    	if(check_friend($id_user1,$id_user2)==true){
    		return false; // also friend
    	} else {
    		$array= array('id_add_friend' => null, 'user_add_friend'=>$id_user1,'user_be_added'=>$id_user2);
    		if($this->db->insert($array))
    			return true;
    		else
    			return false;
    	}
    }
    // @ accept friend
    // insert table friend
    // delete table add_friend
    public function accept_friend($id_user1,$id_user2){
    	if(count(check_friend_is($id_user1,$id_user2))==1){
    		$array=check_friend_is($id_user1,$id_user2);
    		//deleta friend
    		$this->db->delete($array);
    		//insert add_friend
    		$result = array('id_add_friend' =>'null','user_add_friend'=>$array['user1'],'user_be_added'=>$array['user2'] );
    		$this->db->insert();
    	}
    }
    // @ function unfriend
    // delete table add_friend
    public function unfriend($id_user1,$id_user2){
    	$array1=array('user1'=>$id_user1,'user2'=>$id_user2);
    	$this->db->where($array1);
    	$array2=array('user1'=>$id_user2,'user2'=>$id_user1);
    	$this->db->or_where($array2);
    	if($this->db->delete('friend')){
    		return true;
    	} else{
    		return false;
    	}
    }
    // @ view all friend
    // @return array: info user
    public function view_all_friend($id_user){
        $sql="select u.* from friend f, users u where u.id=f.user1 and u.id=?";
        $query=$this->db->query($sql,array($id_user));
        return $query->result_array();
    }
    // @View suggest friend
    public function view_suggest_friend($id){
        $sql="select * from users u where u.id not in( 
                                                        select f.user2 
                                                        from friend f 
                                                        where f.user1=?) and u.id!=?";
        $query=$this->db->query($sql,array($id,$id));
        return $query->result_array();
        
    }
}