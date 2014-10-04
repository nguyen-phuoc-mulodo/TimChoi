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
    //@ remove 1 location
    public function remove_location(){
        $this->load->helper('url');
        $this->load->helper('form');
        // find id
        if($this->input->post()){
            $id=$this->input->post('id');
        } else {
            $id=$this->uri->segment(3);
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('id','id location','required');

        $this->load->model('Location_model');
        if($this->Location_model->remove($id)){
            redirect('user/view_all_location');
        } else {
            echo " whoop! error delete location";
        }
    }
    //@ show all location
    public function view_all_location(){
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Location_model');
        $data['data']=$this->Location_model->view_locations();
        $this->load->view('view_all_locations',$data);
    }
    // @ check friend
    public function check_friend(){
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('User_model');

        //load support assets
        $this->load->library("form_validation");
        $this->form_validation->set_error_delimiters('<div class="error">','</div>');

        // set validation rules
        $this->form_validation->set_rules('user1','Username 1','required|integer');
        $this->form_validation->set_rules('user2', 'Username 2', 'required|integer');
        //begin validation
        if($this->form_validation->run()==FALSE){
            //first load, or problem with form
            $data['user1'] = array('name' => 'user1', 
                                    'id' => 'user1', 
                                    'value' => set_value('user1', ''), 
                                    'maxlength' => '100', 
                                    'size' => '40');
            $data['user2'] = array('name' => 'user2', 
                                        'id' => 'user2', 
                                        'value' => set_value('user2', ''), 
                                        'maxlength' => '100', 
                                        'size' => '40');
            $this->load->view('add_friend',$data);

        }else{ //validation passed, add to database
            $this->load->model('Friend_model');
            $user1=$this->input->post('user1');
            $user2=$this->input->post('user2');
            if($this->Friend_model->check_friend($user1,$user2)==true){
                echo "Đã là bạn của nhau, xin đừng unfriend";
            } else{
                echo "add friend e nhe";
            }
        }   
    }
    // @ add friend
    public function add_friend(){
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('User_model');

        //load support assets
        $this->load->library("form_validation");
        $this->form_validation->set_error_delimiters('<div class="error">','</div>');

        // set validation rules
        $this->form_validation->set_rules('user1','Username 1','required|integer');
        $this->form_validation->set_rules('user2', 'Username 2', 'required|integer');
        //begin validation
        if($this->form_validation->run()==FALSE){
            //first load, or problem with form
            $data['user1'] = array('name' => 'user1', 
                                    'id' => 'user1', 
                                    'value' => set_value('user1', ''), 
                                    'maxlength' => '100', 
                                    'size' => '40');
            $data['user2'] = array('name' => 'user2', 
                                        'id' => 'user2', 
                                        'value' => set_value('user2', ''), 
                                        'maxlength' => '100', 
                                        'size' => '40');
            $this->load->view('add_friend',$data);

        }else{ //validation passed, add to database
            $this->load->model('Friend_model');
            $user1=$this->input->post('user1');
            $user2=$this->input->post('user2');
            if($this->Friend_model->add_friend($user1,$user2)){
                echo"Add friend thành công";
            } else{
                echo "add friend thất bại";
            }
        }   
    }
    // @ accept friend
    public function accept_friend(){

    }
    // @ function unfriend
    public function unfriend(){

    }
    // @ view all friend
    public function view_all_friend(){
        // friend to unfriend
        // list accept friend

    }
    // @upload image
    public function upload(){
        $this->load->view('upload/upload_image',array("error"=>" "));
    }
    // @ do upload image
    function do_upload(){
        $config['upload_path']='C:\wamp\www\timchoi\uploads';
        $config['allowed_types']='gif|jpg|png';
        $config['max_size']='10000';
        $config['max_height']='1024';
        $config['max_width']='768';

        $this->load->library('upload',$config);

        if($this->upload->do_upload()==false){
            $error=array('error'=>$this->upload->display_errors());
            $this->load->view('upload/upload_image',$error);
        } else{
            $data=array('upload_data'=>$this->upload->data());
            echo "<pre>";
            var_dump($data);
            echo "</pre>";
        }
    }
}