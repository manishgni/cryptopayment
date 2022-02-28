<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Network extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        if(is_logged_in() === false){
            redirect('Dashboard/User/logout');
            exit;
        }
    }

    public function index(){
        $org = $this->input->get('org');
        if(empty($org) || $org == 1){
            $table='tbl_pool';
            $org = 1;
        }else{
            $table='tbl_pool'.$org;
        }
        $rank = [
            '1' => 'Dreamer',
            '2' => 'Iron',
            '3' => 'Bronze',
            '4' => 'Silver',
            '5' => 'Gold',
            '6' => 'Diamond',
            '7' => 'Platinum',
            '8' => 'Challanger',
            '9' => 'Matser',
            '10' => 'Grand Master',
        ];
        $response['poolName'] = $rank[$org];
        $response['users'] = $this->User_model->get_records($table,['user_id' => $this->session->userdata['user_id']],'*');
        $response['totalUsers1'] = $this->User_model->get_single_record($table,['org' => 1],'count(id) as record');
        $response['totalUsers2'] = $this->User_model->get_single_record($table,['org' => 2],'count(id) as record');
        $response['totalUsers3'] = $this->User_model->get_single_record($table,['org' => 3],'count(id) as record');
        //pr($response,true);
        $this->load->view('orgCheck',$response);
    }

    // public function updatePosition(){
    //     $users = $this->User_model->get_records('tbl_pool2',"org = '3' order by id asc",'*');
    //     foreach($users as $user){
    //         $totalMember = $this->User_model->get_single_record('tbl_pool2',['org' => 3,'id <' => $user['id']],'count(id) as record');
    //         $position = $totalMember['record']+1;
    //         pr($user['user_id']);
    //         $this->User_model->update('tbl_pool2',['id' => $user['id']],['position' => $position]);
    //     }
    // }
}
?>