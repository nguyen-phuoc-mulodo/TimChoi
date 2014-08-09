<?php
require(APPPATH. 'libraries/REST_Controller.php');

class Location extends REST_Controller
{
    function loca_get()
    {
        //*** Load model
        $this->load->model('Location_model'); //Load model
        $locations = $this->Location_model->get_locations(); //Get all locations
        
        //*** Get data
        $locations_json =  json_encode($locations); //Create json from array
        
        //*** Return data
        $this->response($locations_json);
    }
}


