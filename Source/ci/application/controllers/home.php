<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

class Home extends GB_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->view('home');
    }
}