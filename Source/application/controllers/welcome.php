<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
session_start();
 
require_once( APPPATH . 'libraries/facebook/Facebook/GraphObject.php' );
require_once( APPPATH . 'libraries/facebook/Facebook/GraphSessionInfo.php' );
require_once( APPPATH . 'libraries/facebook/Facebook/FacebookSession.php' );
require_once( APPPATH . 'libraries/facebook/Facebook/HttpClients/FacebookCurl.php' );
require_once( APPPATH . 'libraries/facebook/Facebook/HttpClients/FacebookHttpable.php' );
require_once( APPPATH . 'libraries/facebook/Facebook/HttpClients/FacebookCurlHttpClient.php' );
require_once( APPPATH . 'libraries/facebook/Facebook/FacebookResponse.php' );
require_once( APPPATH . 'libraries/facebook/Facebook/FacebookSDKException.php' );
require_once( APPPATH . 'libraries/facebook/Facebook/FacebookRequestException.php' );
require_once( APPPATH . 'libraries/facebook/Facebook/FacebookAuthorizationException.php' );
require_once( APPPATH . 'libraries/facebook/Facebook/FacebookRequest.php' );
require_once( APPPATH . 'libraries/facebook/Facebook/FacebookRedirectLoginHelper.php' );
 
use Facebook\GraphSessionInfo;
use Facebook\FacebookSession;
use Facebook\FacebookCurl;
use Facebook\FacebookHttpable;
use Facebook\FacebookCurlHttpClient;
use Facebook\FacebookResponse;
use Facebook\FacebookAuthorizationException;
use Facebook\FacebookRequestException;
use Facebook\FacebookRequest;
use Facebook\FacebookSDKException;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphObject;
 
 
class Welcome extends CI_Controller {
 
    //Configuramos facebook api y secret
    private $fb_api = '1434077473539594';
    private $fb_secret = '611a295e11aa82b1a47a9705858ecf40';
     
    //Configuramos la url de redirect que redireccionara al metodo logueado de esta clase
    private $fb_redirect = 'index.php/login/logueado';
     
    //Creamos helper
    private $fb_helper;
     
    //Configuramos permisos
    private $fb_scopes = 'publish_actions, email';
     
    public function __construct(){
        //Siempre ejecutamos el constructor del padre
        parent::__construct();
         
        //Cargamos helper URL
        $this->load->helper('url');
         
        //Configuramos la url de redirect para que use la base_url
        $this->fb_redirect = base_url($this->fb_redirect);
         
        //Inizializamos facebook app
        FacebookSession::setDefaultApplication($this->fb_api, $this->fb_secret);
         
        //Configuramos helper y permisos
        $this->fb_helper = new FacebookRedirectLoginHelper($this->fb_redirect);   
        $this->fb_scopes = array($this->fb_scopes);   
    }
     
    public function index()
    {
        //Redireccionamos a redirect url
        $loginUrl = $this->fb_helper->getLoginUrl($this->fb_scopes);       
        redirect($loginUrl);
    }
     
    public function logueado()
    {       
        try {
            $session = $this->fb_helper->getSessionFromRedirect();
        } catch(FacebookRequestException $ex) {
        } catch(\Exception $ex) {
        }
        if ($session) {
            try {
 
                $user_profile = (new FacebookRequest(
                  $session, 'GET', '/me'
                ))->execute()->getGraphObject(GraphUser::className());
             
                $aTemplate = array(
                    'nombre' => $user_profile->getName(),
                    'id'     => $user_profile->getProperty('id')
                );
             
              } catch(FacebookRequestException $e) {
             
                echo "Exception occured, code: " . $e->getCode();
                echo " with message: " . $e->getMessage();
             
              }   
 
        } else {
            redirect(base_url());
        }
         
        $this->load->view('welcome_message.php', $aTemplate);
    }   
}