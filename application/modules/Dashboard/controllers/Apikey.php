<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Apikey extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user','security'));
    }

    public function index(){
       if(is_logged_in()){
        $response['header'] = 'API Key';
         $response['records'] = $this->User_model->get_records('api_key',['user_id' => $this->session->userdata['user_id']],'*');
         $this->load->view('api_key',$response);
       }else{
        redirect('Dashboard/User/login');
       }
    }

    public function generateKey(){
        if(is_logged_in()){
            $public_key = md5(rand(10000,99999));
            $secret_key = md5(rand(10000,99999));
            $check = $this->User_model->get_single_record('api_key',['api_key' => $public_key,'secret_key' => $secret_key],'*');
            if(empty($check)){
                $addKey = [
                    'user_id' => $this->session->userdata['user_id'],
                    'api_key' => $public_key,
                    'secret_key' => $secret_key,
                ];
                $this->User_model->add('api_key',$addKey);
                redirect('Dashboard/Apikey/index');
            }else{
                return generateKey();
            }
        }else{
            redirect('Dashboard/User/login');
        }
    }
 }   