<?php

class Hello extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        //echo 'Hello world';
        $this->load->helper('form');
        $this->load->model('user');
    }

    public function index() {
        $this->load->view('form');
        
    }
    public function save() {
        $this->user->insert_fid(13456);
    }
    public function demso ($i) {
        echo $i;
    }
    
    public function cong($a, $b = 2) {
        echo $a + $b;
    }
}
