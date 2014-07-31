<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

class Login extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        session_start();
        
        //*** Initializing facebook app
        FacebookSession::setDefaultApplication('695082060564419', '093b0b371673a8b831dcc87d62fee7b0');//Will be set in constant
        
        //*** Check if user has logged
        if ($this->session->userdata('user_token')) {
            redirect('home');
        }
    }
    
    public function index() {
        $helper = new FacebookRedirectLoginHelper('http://localhost/timchoi/index.php/login/');
        try {
            $session = $helper->getSessionFromRedirect();
        } catch(FacebookRequestException $ex) {
            // When Facebook returns an error
        } catch(\Exception $ex) {
            // When validation fails or other local issues
        }
        
        if (isset($session)) { // Login successful
            
            //*** Set session for user
            $this->session->set_userdata('user_token',$session->getToken());
            //redirect('home');
            
        } else { // Not logged
            
            $data['loginUrl'] = $helper->getLoginUrl();
            $this->load->view('login', $data);            
        }
    }
    
    /*
     * @Return: bool
     */    
    private function check_user_exist($session)
    {
        
    }
    
    /*
     * @Return: bool
     */
    private function register_user()
    {
        
    }
    
    /*
     * Call api to get user info
     * @Return: object
     */
    private function get_user_info($session)
    {
        if ($session) {
            try {
                //*** Get user profile
                $user_profile = (new FacebookRequest($session, 'GET', '/me'))
                        ->execute()
                        ->getGraphObject(GraphUser::className());
                return $user_profile;
            } catch (FacebookRequestException  $e) {
                echo "Exception occured, code: " . $e->getCode();
                echo " with message: " . $e->getMessage();           
            }
        }
        return false;
    }
}