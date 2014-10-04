<?php
require(APPPATH. 'libraries/REST_Controller.php');

class Location extends REST_Controller
{
    function __construct() {
        parent::__construct();
        
        //*** Load model
        $this->load->model('Location_model'); //Load model
    }
    function loca_get()
    {
        $locations = $this->Location_model->get_locations(); //Get all locations
    
        //*** Get data
//        $locations_json =  json_encode($locations); //Create json from array
        
        //*** Return data
//        $this->response($locations_json);
        $this->response($locations);
    }
    
    function user_loca_get($user_id) {
        
        //*** Get data
        $locations = $this->Location_model->get_locations($user_id); //Get all locations
        $locations_json =  json_encode($locations); //Create json from array
        
        //*** Return data
        $this->response($locations_json);        
    }
}


