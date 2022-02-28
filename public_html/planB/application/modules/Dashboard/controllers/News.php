<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation','pagination','security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        if(is_logged_in() == false){
            redirect('Dashboard/User/login');
            die;
        }
    }

    public function index(){
        $response['news'] = $this->User_model->get_records('tbl_news',array(),'*');
        $this->load->view('news',$response);
    }
}
?>