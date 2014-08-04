<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;

	class Map extends GB_Controller {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$this->load->model('Location_model'); //Load model
			$locations = $this->Location_model->get_locations(); //Get all locations

			$locations_json =  json_encode($locations); //Create json from array

			$data['locations_json'] = $locations_json; //Initializing view data
			$data['locations'] = $locations;

			$this->load->view('map', $data);
		}
	}
?>