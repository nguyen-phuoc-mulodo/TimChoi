<?php

class user extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function checkid($f_id){
    $_test='SELECT f_id FROM users';
    $query = $this->db->query($_test);
    if($query!=NULL)
        return TRUE;
    else {
        return FALSE;   
    }
}
function insert_fid($f_id)
{
 
    if($this->checkid($f_id))
    {
        echo 'user ton tai';
    }
    else
    {
    $data = array(
        'f_id' => $f_id,
    );
    
    $this->db->insert('users', $data);}
    
}

}
