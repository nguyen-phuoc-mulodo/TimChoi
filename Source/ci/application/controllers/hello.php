<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

class Hello extends GB_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        echo __CLASS__.'->'.__FUNCTION__;
    }
}