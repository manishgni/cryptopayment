<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Coin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('pagination'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
    }

    public function index(){
        if(is_logged_in()){
            $response['total'] = $this->User_model->get_single_record('tbl_coin_wallet',['user_id' => $this->session->userdata['user_id']],'ifnull(sum(coin),0) as total');
            $response['records'] = $this->User_model->get_records('tbl_coin_wallet',['user_id' => $this->session->userdata['user_id']],'*');
            $this->load->view('coinHistory',$response);
        }else{
            redirect('Dashboard/User/login');
        }
    }

    public function universalRecord(){
        if(is_logged_in()){
            $response['records'] = $this->User_model->get_records('tbl_universal_income',['user_id' => $this->session->userdata['user_id']],'*');
            $this->load->view('universalprivilege',$response);

        }else{
            redirect('Dashboard/User/login');
        }
   }


} 