<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

class User extends GB_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
       echo "welcome to user controller";
    }
    public function add(){
        //load support assets
        $this->load->library("form_validation");
        $this->form_validation->set_error_delimiters('<div class="error">','</div>');

        // set validation rules
        $this->form_validation->set_rules('name_location','Name Location','required|min_length[6]|maxlength[125]');
        $this->form_validation->set_rules('description', 'Description', 'required|min_length[10]|max_length[125]');
        $this->form_validation->set_rules('lat', 'Lat', 'required');
        $this->form_validation->set_rules('long', 'Long', 'required');
        $this->form_validation->set_rules('user_id', 'User Id', 'required');

        //begin validation
        if($this->form_validation->run()==FALSE){
            //first load, or problem with form
            $data['name_location'] = array('name' => 'name_location', 
                                    'id' => 'name_location', 
                                    'value' => set_value('name_location', ''), 
                                    'maxlength' => '100', 
                                    'size' => '40');
            $data['description'] = array('name' => 'description', 
                                        'id' => 'description', 
                                        'value' => set_value('description', ''), 
                                        'maxlength' => '100', 
                                        'size' => '40');
            $data['lat'] = array('name' => 'lat', 
                                    'id' => 'lat', 
                                    'value' => set_value('lat', 0),
                                     'maxlength' => '100', 
                                     'size' => '40');
           $data['long'] = array('name' => 'long', 
                                    'id' => 'long', 
                                    'value' => set_value('long', 0),
                                     'maxlength' => '100', 
                                     'size' => '40');
           $data['user_id'] = array('name' => 'user_id', 
                                    'id' => 'user_id', 
                                    'value' => set_value('lat', 0),
                                     'maxlength' => '100', 
                                     'size' => '40');
            $this->load->view('add_location',$data);

        }else{ //validation passed, add to database
            $this->load->model('Location_model');
            $data= array('id' =>'null',
                        'name'=>$this->input->post('name_location'),
                        'description'=>$this->input->post('description'),
                        'lat'=>$this->input->post('lat'),
                        'long'=>$this->input->post('long'),
                        'user_id'=>$this->input->post('user_id')
                        );
            if($this->Location_model->add($data))
                redirect('user/index');
        }
        
    }
}