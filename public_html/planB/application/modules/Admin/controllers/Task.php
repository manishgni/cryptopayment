<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $response = array();
            $response['tasks'] = $this->Main_model->get_records('tbl_task_links', array(), '*');
            $this->load->view('task_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function Create() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('link', 'Link', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $tasks = $this->Main_model->get_single_record('tbl_task_links', array(), 'ifnull(count(id),0)  as total_links');
                    if($tasks['total_links'] < 15){
                        $TaskData = array(
                            'link' => $data['link'],
                        );
                        $this->Main_model->add('tbl_task_links', $TaskData);
                        $this->session->set_flashdata('message', 'Task Created Successfully');
                    }else{
                        $this->session->set_flashdata('message', '15 Tasks Already Created');
                    }
                }
            }
            $this->load->view('create_task', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function Edit($task_id) {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('link', 'Link', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $updtask =  $updres = $this->Main_model->update('tbl_task_links', array('id' => $task_id), array('link' => $data['link']));
                    if ($updres == true) {
                        $this->session->set_flashdata('message', 'Task Updated Successfully');
                    }else{
                        $this->session->set_flashdata('message', 'Error while Updating Task');
                    }
                }
            }
            $response['task'] = $this->Main_model->get_single_record('tbl_task_links', array('id' => $task_id), '*');
            $this->load->view('edit_task', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    // public function silverClub(){
    //     if(is_admin()){
    //         $response['header'] = 'Silver Club';
    //         $response['headerMenu'] = '#,User ID,Left Power,Right Power';
    //         $response['users'] = $this->Main_model->get_records('tbl_users',['paid_status >' => 0,'leftPower >=' => '2500','rightPower >=' => '2500'],'user_id,leftPower,rightPower');
    //         $this->load->view('clubReport', $response);
    //     } else {
    //         redirect('Admin/Management/login');
    //     }
    // }
    public function silverClub(){
        if(is_admin()){
            $response['header'] = 'Silver Club';
            $response['headerMenu'] = '#,User ID,Left Power,Right Power';
            $get = $this->Main_model->get_records('tbl_users',['directs >=' => 10],'user_id');
            foreach ($get as $key => $value) {
                $left = $this->Main_model->get_single_record('tbl_users', array('sponser_id' => $value['user_id'], 'position' => "L", 'paid_status >' => 0), 'count(id) as ids');
                if($left['ids'] >= 5){
                    $right = $this->Main_model->get_single_record('tbl_users', array('sponser_id' => $value['user_id'], 'position' => "R", 'paid_status >' => 0), 'count(id) as ids');
                    if($right['ids'] >= 5){
                       $data[] = $this->Main_model->get_single_record('tbl_users','user_id = "'.$value['user_id'].'"','user_id,leftPower,rightPower');
                    }
                }
            }
           if(!empty($data)){
                $response['users'] = $data;
            }
            
           $this->load->view('clubReport', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    // public function GoldClub(){
    //     if(is_admin()){
    //         $response['header'] = 'Gold Club';
    //         $response['headerMenu'] = '#,User ID,Left Power,Right Power';
    //         $response['users'] = $this->Main_model->get_records('tbl_users',['paid_status >' => 0,'leftPower >=' => '5000','rightPower >=' => '5000'],'user_id,leftPower,rightPower');
    //         $this->load->view('clubReport', $response);
    //     } else {
    //         redirect('Admin/Management/login');
    //     }
    // }

    public function GoldClub(){
        if(is_admin()){
            $response['header'] = 'Gold Club';
            $response['headerMenu'] = '#,User ID,Left Power,Right Power';
            $get = $this->Main_model->get_records('tbl_users',['directs >=' => 20],'user_id');
            foreach ($get as $key => $value) {
                $left = $this->Main_model->get_single_record('tbl_users', array('sponser_id' => $value['user_id'], 'position' => "L", 'paid_status >' => 0), 'count(id) as ids');
                if($left['ids'] >= 10){
                    $right = $this->Main_model->get_single_record('tbl_users', array('sponser_id' => $value['user_id'], 'position' => "R", 'paid_status >' => 0), 'count(id) as ids');
                    if($right['ids'] >= 10){
                       $data[] = $this->Main_model->get_single_record('tbl_users','user_id = "'.$value['user_id'].'"','user_id,leftPower,rightPower');
                    }
                }
            }
            if(!empty($data)){
                $response['users'] = $data;
            }
            
           $this->load->view('clubReport', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function rewards(){
        if(is_admin()){
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('id','ID','trim|required');
                $this->form_validation->set_rules('status','Status','trim|required');
                if($this->form_validation->run() != false){
                    $check = $this->Main_model->get_single_record('tbl_rewards',['id' => $data['id']],'*');
                    if($check['status'] == 0){
                        $res = $this->Main_model->update('tbl_rewards',['id' => $data['id']],['status' => $data['status']]);
                        if($data['status'] == 1){
                            $msg = 'approved';
                            $IncomeData = [
                                'user_id' => $check['user_id'],
                                'amount' => $check['amount'],
                                'type' => 'royalty_income',
                                'description' => 'Reward Income',
                            ];
                            //pr($IncomeData);
                            $this->Main_model->add('tbl_income_wallet',$IncomeData);
                        }else{
                            $msg = 'rejected';
                        }
                        if($res){
                            $this->session->set_flashdata('message','Reward '.$msg.' successfully');
                            redirect('Admin/Task/rewards');
                        }else{
                            $this->session->set_flashdata('message','Network error,Please try later');
                        }
                    }else{
                        $this->session->set_flashdata('message','This reward request is already processed');
                    }
                }
            }
            $response['rewards'] = $this->Main_model->get_records('tbl_rewards',['status' => 0],'*');
            foreach ($response['rewards'] as $key => $value) {
                $response['rewards'][$key]['userInfo'] = $this->Main_model->get_single_record('tbl_users',['user_id' => $value['user_id']],'name');
            }
            $this->load->view('rewardList',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function approvedrewards(){
        if(is_admin()){
            $response['rewards'] = $this->Main_model->get_records('tbl_rewards',['status' => 1],'*');
            foreach ($response['rewards'] as $key => $value) {
                $response['rewards'][$key]['userInfo'] = $this->Main_model->get_single_record('tbl_users',['user_id' => $value['user_id']],'name');
            }
            $this->load->view('rewardList',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function rejectedrewards(){
        if(is_admin()){
            $response['rewards'] = $this->Main_model->get_records('tbl_rewards',['status' => 2],'*');
            $this->load->view('rewardList',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }


}