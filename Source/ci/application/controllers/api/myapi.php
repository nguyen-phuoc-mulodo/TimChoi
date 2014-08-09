<?php

require(APPPATH. 'libraries/REST_Controller.php');

class Myapi extends REST_Controller
{
    //Use the link http://localhost/timchoi/index.php/api/myapi/user.json to call api
    // http://localhost/timchoi/index.php/api/myapi/user also be ok.
    function user_get()
    {
        //respond with one user
        $data = array(
            array('name' => 'Nguyen Huu Phuoc','age' => '22'),
        );
        $this->response($data);
    }
}