<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation','pagination','security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {

        $response = array();
        $sponser_id = $this->input->get('sponser_id');
        if($sponser_id == ''){
            $sponser_id = '';
        }

        // $epin = $this->input->get('epin');
        // if($epin == ''){
        //     $epin = '';
        // }
        // $response['epin'] = $epin;
        $response['countries'] = $this->User_model->get_records('countries', array(), '*');
        $response['sponser_id'] = $sponser_id;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('sponser_id', 'Sponser ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('epin', 'Epin', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('phonecode', 'Phone Code', 'readonly');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                $this->load->view('register', $response);
            }else{
                $sponser_id = $this->input->post('sponser_id');
                $phone = $this->input->post('phone');
                $response['sponser_id'] = $sponser_id;
                $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id,'paid_status' => 1), '*');
                // $epinCheck = $this->User_model->get_single_record('tbl_epins', array('epin' => $this->input->post('epin'),'status' => 0),'id,epin,amount');
                // $package = $this->User_model->get_single_record('tbl_package', array('price' => $epinCheck['amount']),'*');
                ///if(!empty($epinCheck['epin'])){
                    if(!empty($sponser)){
                        $id_number = $this->getUserIdForRegister();
                        $userData['user_id'] =  $id_number;
                        $userData['sponser_id'] = $sponser_id;
                        $userData['name'] = $this->input->post('name');
                        $userData['phone'] = $this->input->post('phone');
                        $userData['password'] = rand(100000,999999);//$this->input->post('password');
                        // $userData['position'] = $this->input->post('position');
                        // $userData['last_left'] = $userData['user_id'];
                        // $userData['last_right'] = $userData['user_id'];
                        //$userData['country_code'] = $this->input->post('country');
                        //$userData['email'] = $this->input->post('email');
                        //$userData['country'] = $this->input->post('country');
                        $userData['master_key'] = rand(100000,999999);
                        //$userData['epin'] = $this->input->post('epin');
                        //$userData['package_id'] = $package['id'];
                        //$userData['package_amount'] = $package['price'];
                       // $userData['paid_status'] = 1;
                        //$userData['topup_date'] = date('Y-m-d H:i:s');
                        // if($userData['position'] == 'L'){
                        //     $userData['upline_id'] = $sponser['last_left'];
                        // }else{
                        //     $userData['upline_id'] = $sponser['last_right'];
                        // }
                        $res = $this->User_model->add('tbl_users', $userData);
                        $res = $this->User_model->add('tbl_bank_details',array('user_id' => $userData['user_id'] ));
                        if ($res) {
                            // if ($userData['position'] == 'R') {
                            //     $this->User_model->update('tbl_users', array('last_right' => $userData['upline_id']), array('last_right' => $userData['user_id']));
                            //     $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('right_node' => $userData['user_id']));
                            // } elseif ($userData['position'] == 'L') {
                            //     $this->User_model->update('tbl_users', array('last_left' => $userData['upline_id']), array('last_left' => $userData['user_id']));
                            //     $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('left_node' => $userData['user_id']));
                            // }
                            //$this->add_counts($userData['user_id'], $userData['user_id'], 1);
                            //$this->User_model->update_directs($sponser['user_id']);
                            // $this->User_model->update('tbl_epins',['id' => $epinCheck['id'],'epin' => $epinCheck['epin']],['status' => 1,'used_for' => $userData['user_id']]);
                            // $DirectIncome = array(
                            //     'user_id' => $sponser['user_id'],
                            //     'amount' => $package['direct_income'],
                            //     'type' => 'direct_income',
                            //     'description' => 'Refferal Income from Registration of Member ' . $userData['user_id'].' at level 1',
                            // );
                            // $this->User_model->add('tbl_income_wallet', $DirectIncome);
                            // $this->level_income($sponser['sponser_id'], $userData['user_id'], $package['level_income']);
                            // $roiData = [
                            //     'user_id' => $userData['user_id'],
                            //     'amount' => $package['commision'] * $package['days'],
                            //     'days' => $package['days'],
                            //     'roi_amount' => $package['commision'],
                            //     'creditDate' => date('Y-m-d'),
                            // ];
                            // $this->User_model->add('tbl_roi', $roiData);
                            $this->add_sponser_counts($userData['user_id'],$userData['user_id'], $level = 1);
                            //$this->User_model->update('tbl_sponser_count',['downline_id' => $userData['user_id'],'user_id' => $sponser['user_id']],['paid_status' => 1]);
                            $sms_text = 'Dear ' .$userData['name']. ', Your Account Successfully created. User ID :  ' . $userData['user_id'] . ' Password :' . $userData['password'] . ' Transaction Password:' .$userData['master_key'] . base_url();
                            if(!empty($userData['email'])){
                                $mailData = [
                                    'name' => $userData['name'],
                                    'user_id' => $userData['user_id'],
                                    'password' => $userData['password'],
                                    'master_key' => $userData['master_key'],
                                ];
                                sendMail2($userData['email'],'Registration Alert',$mailData);
                            }
                            $sms_text1 = 'Dear ' . $userData['name'] . '. Your Account Successfully created. User ID : ' . $userData['user_id'] . '. Password :' . $userData['password'] . '. Transaction Password:' . $userData['master_key'] . '. ' . base_url().'';
                            notify_sms($userData['user_id'], $sms_text1, $entity_id ='1201161518339990262', $temp_id ='1207161730102098562');
                            //notify_user($userData['user_id'] , $sms_text);
                            //notify_mail($userData['email'] , $sms_text);
                            $response['message'] = 'Dear ' .$userData['name']. ', Your Account Successfully created. <br>User ID :  ' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' .$userData['master_key'];
                            $this->load->view('success', $response);
                        }
                        else {
                            $this->session->set_flashdata('error', 'Error while Registraion please try Again');
                            $response['message'] = 'Error while Registraion please try Again';
                            $this->load->view('register', $response);
                        }
                    }else{
                        $this->session->set_flashdata('error', "Please enter valid Sponsor ID.");
                        $this->load->view('register', $response);
                    }
                // }else{
                //     $this->session->set_flashdata('error', 'Invalid Epin');
                //     $this->load->view('register', $response);
                // }
            }
        }else{
            $this->load->view('register', $response);
        }
    }

    // public function smscheck(){
    //     $userData['name'] = 'manish';
    //     $userData['user_id'] = 'manish';
    //     $userData['password'] = '123';
    //     $userData['master_key'] = '852';
    //      $sms_text = 'Dear ' . $userData['name'] . '. Your Account Successfully created. User ID : ' . $userData['user_id'] . '. Password :' . $userData['password'] . '. Transaction Password:' . $userData['master_key'] . '. ' . base_url().'';
    //     notify_sms($userData['user_id'], $sms_text, $entity_id ='1201161518339990262', $temp_id ='1207161730102098562');
    // }

    public function registerCron($sponser_id) {
        for($i=1;$i<=10;$i++){
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
            if(!empty($sponser)){
                $id_number = $this->getUserIdForRegister();
                $userData['user_id'] =  $id_number;
                $userData['sponser_id'] = $sponser['user_id'];
                $userData['name'] = title.''.$i;
                $userData['phone'] = '';
                $userData['password'] = rand(100000,999999);//$this->input->post('password');
                // $userData['position'] = $this->input->post('position');
                // $userData['last_left'] = $userData['user_id'];
                // $userData['last_right'] = $userData['user_id'];
                $userData['country_code'] = '';
                $userData['email'] = '';
                $userData['country'] = '';
                $userData['master_key'] = rand(100000,999999);
                //$userData['epin'] = $this->input->post('epin');
                //$userData['package_id'] = $package['id'];
                //$userData['package_amount'] = $package['price'];
                // $userData['paid_status'] = 1;
                //$userData['topup_date'] = date('Y-m-d H:i:s');
                // if($userData['position'] == 'L'){
                //     $userData['upline_id'] = $sponser['last_left'];
                // }else{
                //     $userData['upline_id'] = $sponser['last_right'];
                // }
                $res = $this->User_model->add('tbl_users', $userData);
                $res = $this->User_model->add('tbl_bank_details',array('user_id' => $userData['user_id'] ));
                if ($res) {
                    // if ($userData['position'] == 'R') {
                    //     $this->User_model->update('tbl_users', array('last_right' => $userData['upline_id']), array('last_right' => $userData['user_id']));
                    //     $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('right_node' => $userData['user_id']));
                    // } elseif ($userData['position'] == 'L') {
                    //     $this->User_model->update('tbl_users', array('last_left' => $userData['upline_id']), array('last_left' => $userData['user_id']));
                    //     $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('left_node' => $userData['user_id']));
                    // }
                    //$this->add_counts($userData['user_id'], $userData['user_id'], 1);
                    $this->add_sponser_counts($userData['user_id'],$userData['user_id'], $level = 1);
                    //$this->User_model->update('tbl_sponser_count',['downline_id' => $userData['user_id'],'user_id' => $sponser['user_id']],['paid_status' => 1]);
                    $response['message'] = 'Dear ' .$userData['name']. ', Your Account Successfully created. <br>User ID :  ' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' .$userData['master_key'];
                }
            }else{
                echo 'Invalid Sponsor';
            }
        }
    }

    private function getUserIdForRegister() {
        $user_id = 'MCP' . rand(10000, 99999);
        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,name');
        if (!empty($sponser)) {
            return $this->getUserIdForRegister();
        } else {
            return $user_id;
        }
    }

    private function add_sponser_counts($user_name, $downline_id , $level) {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '') {
            $downlineArray = array(
                'user_id' => $user['sponser_id'],
                'downline_id' => $downline_id,
                'position' => '',
                'level' => $level,
            );
            $this->User_model->add('tbl_sponser_count', $downlineArray);
            $user_name = $user['sponser_id'];
            $this->add_sponser_counts($user_name, $downline_id, $level + 1);
        }
    }

    private function add_counts($user_name , $downline_id , $level) {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $count = array('left_count' => ' left_count + 1');
                $c = 'left_count';
            } else if ($user['position'] == 'R') {
                $c = 'right_count';
                $count = array('right_count' => ' right_count + 1');
            } else {
                return;
            }
            $this->User_model->update_count($c, $user['upline_id']);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'created_at' => date('Y-m-d h:i:s'),
                'level' => $level,
            );
            $this->User_model->add('tbl_downline_count', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->add_counts($user_name, $downline_id, $level + 1);
            }
        }
    }
}
?>