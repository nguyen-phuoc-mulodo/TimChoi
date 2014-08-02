<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

class Home extends GB_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
       redirect("Home/add");
    }
    public function add(){
        $this->load->model('Location_model');
        $data= array('id' =>'null',
                    'name'=>'sang',
                    'description'=>'mo ta',
                    'lat'=>100,
                    'long'=>200,
                    'user_id'=>1
                    );
        $this->Location_model->add($data);
    }
}