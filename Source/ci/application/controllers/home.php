<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

class Home extends GB_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
    	//User_id
    	//thong tin nguoig su dung,
    	//daffafaf
        $this->load->view('home');
    }
}

/*
Table places
- Tendiadiem nvarchar
- Mota nvarchar
- Toado: lat & long.
	+ lat : double
	+ long: double
- id user int
*/