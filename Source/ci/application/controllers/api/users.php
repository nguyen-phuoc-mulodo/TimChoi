<?php
require(APPPATH. 'libraries/REST_Controller.php');

class Users extends REST_Controller {
    
    function __construct() {
        parent::__construct();
        
        //*** Load models
    }
    
    function check_friend_get($user_a, $user_b) {
        
        $this->response(array('123', '456'));
    }
    
    
    
}

