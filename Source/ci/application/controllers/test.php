<?php

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

class Test extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        session_start();
        
        //*** Initializing facebook app
        FacebookSession::setDefaultApplication('695082060564419', '093b0b371673a8b831dcc87d62fee7b0');//Will be set in constant                
    }
    public function index ()
    {
        $helper = new FacebookRedirectLoginHelper('http://localhost/timchoi/index.php/test');
        
        $session = null;
        try {
            $session = $helper->getSessionFromRedirect();
        } catch(FacebookRequestException $ex) {
            // When Facebook returns an error
        } catch(\Exception $ex) {
            // When validation fails or other local issues
        }
        if ($session) {
            // Logged in
            //*** Create a session for user
            $this->session->set_userdata('user_token',$session->getAccessToken());
            $_SESSION['user_token'] = $session->getAccessToken();
            redirect('hello');
        }
        
    }
}
