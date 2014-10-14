<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
 * Class Facebook used in Codeigniter
 * @Author: EchPay
 * @Version: 1.0
 * 
 */

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;


class Facebook
{
    public $session = null;
    public $helper = null;
    
    public function __construct() {
        
        FacebookSession::setDefaultApplication('703356373080439', 'dbd71535084d3208e66ec3528093a863' );
        $this->helper = new FacebookRedirectLoginHelper('http://localhost/timchoi/index.php/login');
    }
    
    /*
     * @Return: string
     */
    public function get_login_url() {
        return $this->helper->getLoginUrl();
    }
    
    /*
     * @Param: 
     * - access_token: string
     * @Return: string | bool
     */    
    public function exchange_long_lived_token($access_token) {
        $session = new FacebookSession($access_token);
        
        // Check validate token
        if ($session->validate()) {
            $long_lived_session = $session->getLongLivedSession();
            return $long_lived_session->getToken();
        }
        
        return false;
    }
    
    /*
     * @Param: 
     * - access_token: string
     * @Return: Object
     */
    public function get_user_information($access_token) {
        
        $session = $this->get_session_from_token($access_token);
        if (!$session->validate()) return false;
        
        //*** Call api
        $request = new FacebookRequest($session, 'GET', '/me');
        $response = $request->execute();
        return $response->getGraphObject(GraphUser::className());    
        
    }
    
    /*
     * @Param:
     * @Return: array: 
     * - name
     * - fanpage_id
     * - long_lived_access_token
     */
    public function get_page_information($fanpage_id, $access_token) {
        
        //*** Call api
        $pages = $this->get_user_pages($access_token);
        foreach ($pages as $item) {
            $item = $item->asArray(); //Convert oject to array
            if ($fanpage_id == $item['id']) {
                $result = array(
                    'name' => $item['name'],
                    'fanpage_id' => $item['id'],
                    'long_lived_access_token' => $this->exchange_long_lived_token($item['access_token']),
                    'cover' => $this->get_cover_url($item['id'], $access_token)
                );
                return $result;
            }
        }
        return null;        
    }
    
    
    /*
     * @Param
     * @Return: array
     */
    
    public function get_user_pages($access_token) {
        $session = $this->get_session_from_token($access_token);
        if (!$session->validate()) return false;
        
        $request = (new FacebookRequest($session, 'GET', '/me/accounts'))->execute();
        $response = $request->getGraphObject();

        //*** Get array of Page objects
        return $response->getPropertyAsArray('data');
    }
    
    /*
     * @Param: Page_id,
     * @Return: url string | bool
     */
    public function get_cover_url($page_id, $access_token) {
        
        $session = $this->get_session_from_token($access_token);
        if (!$session->validate()) return false;
        
        $request = (new FacebookRequest($session, 'GET', '/'. $page_id))->execute();
        $response = $request->getGraphObject()->asArray();

        if (isset($response['cover'])) {
            return $response['cover']->source;
        }else {
            return '';
        }
    }
    
    /*
     * @Param: string
     * @Return: string
     */
    public function get_user_avatar($access_token) {
        
        $session = $this->get_session_from_token($access_token);
        $session->validate();
        
        $request = new FacebookRequest(
            $session,
            'GET',
            '/me/picture',
            array(
                'redirect' => false,//Must have
                'width' => 100,
                'height' => 100,
            )
        );
        $response = $request->execute();
        $graphObject = $response->getGraphObject()->asArray();
        
        return $graphObject['url'];
        
    }

    /**************************************************************************/
    /*
     * @Param: 
     * - access_token: string
     * @Return: string | bool
     */
    public function get_session_from_token($access_token) {
        
        return new FacebookSession($access_token);
        
    }
}

