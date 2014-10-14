<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

class Login extends CI_Controller {
    public $long_lived_token = '';
    public function __construct() {
        parent::__construct();
        $this->load->library('facebook');
        //*** Load model
        $this->load->model('user_model');
        
        session_start();
        
        //*** Initializing facebook app
        FacebookSession::setDefaultApplication($this->config->item('appid'), $this->config->item('appsecret'));//Will be set in constant
        
        //*** Check if user has logged
        if ($this->session->userdata('user_token')) {
            redirect('map');
        }
    }
    
    public function index() {
        $helper = new FacebookRedirectLoginHelper($this->config->item('loginurl'));
        try {
            $session = $helper->getSessionFromRedirect();
        } catch(FacebookRequestException $ex) {
            // When Facebook returns an error
        } catch(\Exception $ex) {
            // When validation fails or other local issues
        }
        
        if (isset($session) && $session->validate()) { // Login successful
            
            //*** Exchange to longlive access token
            $long_lived_session = $session->getLongLivedSession();
            $this->long_lived_token = $long_lived_session->getToken();
            
            //*** Set session for user
            $this->session->set_userdata('user_token',$session->getToken());
            
            //*** Call api to get user info
            $request = new FacebookRequest($session, 'GET', '/me');
            $response = $request->execute();
            $user = $response->getGraphObject(GraphUser::className());
            
            if ( !$this->check_user_exist($user->getId())) {
                // Register user
                if ($this->register_user($user)) {
                    // Register susseccfully
                }
            }
            //*** Redirect to home
            redirect('map');
            
        } else { // Not logged
            // *** Please define the permission in config/facebook.php
            $data['loginUrl'] = $helper->getLoginUrl($this->config->item('scope'));
            $this->load->view('login', $data);            
        }
    }
    /*
     * @Return: bool
     */    
    private function check_user_exist($fb_id)
    {
        //*** check exist in DB
        return $this->user_model->check_exist($fb_id);
    }
    
    /*
     * @Param: 
     *  -user : GraphUser
     * @Return: bool
     */
    private function register_user($user)
    {
        return $this->user_model->process_create_user($user, $this->long_lived_token);
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