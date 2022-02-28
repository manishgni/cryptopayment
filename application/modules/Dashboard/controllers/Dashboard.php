<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        if (is_logged_in()) {
            redirect('Dashboard/User/');
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function addBeneficiary(){
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,name,phone,netbanking,email');
            $beneficiaryCount = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id']), 'count(id) as ids');
            // if($beneficiaryCount['ids'] <= 1){
            //     $response['status'] = 0;
                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('beneficiary_account_no', 'Beneficiary Account Number', 'trim|required|numeric|xss_clean');
                    $this->form_validation->set_rules('beneficiary_ifsc', 'IFSC Code', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_name', 'Beneficiary Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_bank_name', 'Beneficiary Bank Name', 'trim|required|xss_clean');
                    // $this->form_validation->set_rules('beneficiary_bank', 'Beneficiary Bank Name', 'trim|required|xss_clean');
                    // $this->form_validation->set_rules('beneficiary_branch', 'Beneficiary Bank Branch', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                            $beneficiary_account_no = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id'], 'beneficiary_account_no' => $data['beneficiary_account_no']), 'beneficiary_account_no');
                            //if(empty($beneficiary_account_no['beneficiary_account_no'])){
                                $add_beneficiary = array('user_id' => $this->session->userdata['user_id'], 'beneficiary_name' => $data['beneficiary_name'], 'beneficiary_account_no' => $data['beneficiary_account_no'], 'beneficiary_ifsc' => $data['beneficiary_ifsc'],'beneficiary_bank' => $data['beneficiary_bank_name']);
                                $run = $this->User_model->add('tbl_add_beneficiary', $add_beneficiary);
                                if($run){
                                    $this->session->set_flashdata('message', 'Beneficiary Added Successfully!');
                                }else{
                                    $this->session->set_flashdata('message', 'ERROR:: While addeding Beneficiary!');
                                }
                            // }else{
                            //     $this->session->set_flashdata('message', 'ERROR:: This beneficiary is already added!');
                            // }

                    }else{
                        $this->session->set_flashdata('message', validation_errors());
                    }
                }
            // }else{
            //     $response['status'] = 1;
            // }
            $this->load->view('addBeneficiary', $response);
        } else {
            redirect('Dashboard/User/Mainlogin');
        }
    }

    public function beneficiaryList(){
        if (is_logged_in()) {
            $response['beneficiary'] = $this->User_model->get_records('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('beneficiaryList', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }







    public function coupans() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('coupons-amazing', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    // public function autoTopup($user_id){
    //     $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
    //     if (!empty($user)) {
    //         $this->pool_entry($user['user_id']);
            
    //         echo 'Account Activated Successfully';
                
    //     } else {
    //         echo 'Invalid User ID';
    //     }
    // }

    public function ActivateAccount() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                    if (!empty($user)) {
                        if ($wallet['wallet_balance'] >= $package['price']) {
                            if ($user['paid_status'] == 0) {
                                $sendWallet = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$package['price'],
                                    'type' => 'account_activation',
                                    'remark' => 'Account Activation Deduction for ' . $user_id,
                                );
                                $this->User_model->add('tbl_wallet', $sendWallet);
                                $topupData = array(
                                    'paid_status' => 1,
                                    'package_id' => $data['package_id'],
                                    'package_amount' => $package['price'],
                                    'topup_date' => date('Y-m-d h:i:s'),
                                    'capping' => $package['capping'],
                                );
                                $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                $this->User_model->update_directs($user['sponser_id']);
                                //$sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs');
                                // $DirectIncome = array(
                                //     'user_id' => $user['sponser_id'],
                                //     'amount' => $package['direct_income'],
                                //     'type' => 'direct_income',
                                //     'description' => 'Direct Income from Activation of Member ' . $user_id,
                                // );
                                // $this->User_model->add('tbl_income_wallet', $DirectIncome);
                               
                                $roiArr = array(
                                    'user_id' => $user['user_id'],
                                    'amount' => ($package['price'] * 2),
                                    'roi_amount' => $package['commision'],
                                    'days' => $package['capping'],
                                    'creditDate' => date('Y-m-d'),
                                    'type' => 'roi_first',
                                );
                                $this->User_model->add('tbl_roi', $roiArr);
                                $this->pool_entry($user['user_id']);
                                $this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'], $type = 'topup');
                                // if($sponser['directs'] >= 2){
                                //     $this->next_pool_entry($sponser['user_id'],'tbl_pool2');
                                // }
                                $this->level_income($user['user_id'],$user['user_id'],$package['level_income']);
                                $this->session->set_flashdata('message', 'Account Activated Successfully');
                                redirect('Dashboard/ActivateAccount');
                            } else {
                                $this->session->set_flashdata('message', 'This Account Already Acitvated');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Insuffcient Balance');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid User ID');
                    }
                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
            $this->load->view('activate_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function addPoolCount($uplineID,$user_id,$level){
        $result = $this->User_model->get_single_record('tbl_pool', array('user_id' => $uplineID), 'id,user_id,upline_id');
        if(!empty($result['user_id'])){
            $userData = [
                'user_id' => $result['user_id'],
                'downline_id' => $user_id,
                'level' => $level,
            ];
            $this->User_model->add('tbl_downline_count',$userData);
            $uplineID = $result['upline_id'];
            $level += 1;
            if($result['user_id'] != 'admin'){
                $this->addPoolCount($uplineID,$user_id,$level);
            }
        }
    }

    // public function test($sponsorID){
    //     $result = $this->User_model->get_records_ordered('tbl_downline_count', array('user_id' => $sponsorID), 'downline_id','level');
    //     foreach($result as $u){
    //         $pool_upline = $this->User_model->get_single_record('tbl_pool', array('user_id' => $u['downline_id']), 'id,user_id,down_node');
    //         if($pool_upline['down_node'] < 2){
    //             echo '<pre>';
    //             print_r($pool_upline);
    //             //return ($pool_upline);
    //             break;
    //         }
    //     }
    // }

    public function getUplineID($sponsorID){
        $result = $this->User_model->get_records_ordered('tbl_downline_count', array('user_id' => $sponsorID), 'downline_id','level');
        foreach($result as $u){
            $pool_upline = $this->User_model->get_single_record('tbl_pool', array('user_id' => $u['downline_id']), 'id,user_id,down_node');
            if($pool_upline['down_node'] < 2){
                return ($pool_upline);
                break;
            }
        }
    }

    public function pool_entry($user_id){
        $sponsorID = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,sponser_id');
        $pool_upline = $this->User_model->get_single_record('tbl_pool', array('down_node <' => 2,'user_id' => $sponsorID['sponser_id']), 'id,user_id,down_node');
        //$pool_upline = $this->User_model->get_single_record('tbl_pool', array('down_node <' => 2), 'id,user_id,down_node');
        if(!empty($pool_upline)){
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => $pool_upline['user_id'],
            );
            if($pool_upline['down_node'] == 0)
                $poolArr['position'] = 'L';
            else
                $poolArr['position'] = 'R';
            $this->User_model->add('tbl_pool', $poolArr);
            $this->User_model->update('tbl_pool', array('id' => $pool_upline['id']),array('down_node' => $pool_upline['down_node'] + 1));
            $this->update_pool_counts($poolArr['user_id'],1);
            $this->addPoolCount($pool_upline['user_id'],$user_id,1);
            $this->poolIncomeUser($poolArr['user_id']);
        }else{
            $uplineID = $this->getUplineID($sponsorID['sponser_id']);
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => $uplineID['user_id'],
            );
            if($uplineID['down_node'] == 0)
                $poolArr['position'] = 'L';
            else
                $poolArr['position'] = 'R';
            $this->User_model->add('tbl_pool', $poolArr);
            $this->User_model->update('tbl_pool', array('id' => $uplineID['id']),array('down_node' => $uplineID['down_node'] + 1));
            $this->update_pool_counts($poolArr['user_id'],1);
            $this->addPoolCount($uplineID['user_id'],$user_id,1);
            $this->poolIncomeUser($poolArr['user_id']);
            // $poolArr =  array(
            //     'user_id' => $user_id,
            //     'upline_id' => 'none',
            // );
            // $this->User_model->add('tbl_pool', $poolArr);
        }
    }
    public function update_pool_counts($user_id,$level){
        $pool = $this->User_model->get_single_record('tbl_pool', array('user_id' => $user_id), 'id,user_id,upline_id,position,left_count,team,right_count');
        if(!empty($pool) && $pool['upline_id'] != 'none'){
            if($pool['position'] == 'L'){
                $updArr['left_count'] = $pool['left_count'] + 1;
                $c = 'left_count';
            }else{                
                $updArr['right_count'] = $pool['right_count'] + 1;
                $c = 'right_count';
            }
            $this->User_model->update_bv($c, $pool['upline_id']);
            $this->updateLevelUser($pool['upline_id'],$level);
            $level = $level + 1;
            $this->update_pool_counts($pool['upline_id'],$level);
        }
    }

    public function poolIncomeUser($user_id){
        $uplineID = $this->User_model->get_single_record('tbl_pool',array('user_id' => $user_id),'*');
        if(!empty($uplineID['upline_id'])){
            $uplineDetail = $this->User_model->get_single_record('tbl_pool',array('user_id' => $uplineID['upline_id']),'*');
            $this->poolIncome($uplineID['upline_id'],1,$uplineDetail);
            // if(!empty($uplineDetail['upline_id'])){
            //     $uplineDetail1 = $this->User_model->get_single_record('tbl_pool',array('user_id' => $uplineDetail['upline_id']),'upline_id');
            //     $uplineDetail2 = $this->User_model->get_single_record('tbl_pool',array('user_id' => $uplineDetail1['upline_id']),'*');
            //     if(!empty($uplineDetail2['upline_id'])){
            //         $this->poolIncome($uplineDetail2['upline_id'],2,$uplineDetail2);
            //         $this->poolIncomeUser2($uplineDetail2['upline_id'],3);
            //     }
            // }
        }
    }

    // public function poolIncomeUser2($user_id,$l){
    //     $uplineID = $this->User_model->get_single_record('tbl_pool',array('user_id' => $user_id),'*');
    //     if(!empty($uplineID['upline_id'])){
    //         $uplineDetail = $this->User_model->get_single_record('tbl_pool',array('user_id' => $uplineID['upline_id']),'*');
    //         $this->poolIncome($uplineID['upline_id'],$l,$uplineDetail);
    //         $l = $l + 1;
    //         $this->poolIncomeUser2($uplineID['upline_id'],$l);
    //     }
    // }

    public function poolIncome($user_id,$l,$level){
        if($l == 1){
            $income1 = 15;
            if($level['level1'] > 1){
                $income2 = -15;
            }
        }
        if(!empty($income1)){
            $userData = [
                'user_id' => $user_id,
                'amount' => $income1,
                'type' => 'pool_income',
                'description' => 'Pool Income at level '.$l,
                'level' => $l,
            ];
            $this->User_model->add('tbl_income_wallet',$userData);
            if(!empty($income2)){
                $userData2 = [
                    'user_id' => $user_id,
                    'amount' => $income2,
                    'type' => 'pool_income',
                    'description' => 'Upgrade deduction at level '.$l,
                    'level' => $l,
                ];
                $this->User_model->add('tbl_income_wallet',$userData2);
                if($l == 1){
                    $upline = $this->User_model->get_single_record('tbl_pool',array('user_id' => $user_id),'upline_id');
                    if(!empty($upline['upline_id'])){
                        $upline2 = $this->User_model->get_single_record('tbl_pool',array('user_id' => $upline['upline_id']),'upline_id');
                        if(!empty($upline2['upline_id'])){
                            $balance = $this->User_model->get_single_record('tbl_income_wallet',array('user_id' => $upline2['upline_id'],'level' => '2','amount >' => '0'),'ifnull(sum(amount),0) as balance'); 
                            $userData3 = [
                                'user_id' => $upline2['upline_id'],
                                'amount' => abs($income2),
                                'type' => 'pool_income',
                                'description' => 'Pool Income at level 2',
                                'level' => '2',
                            ];
                            $this->User_model->add('tbl_income_wallet',$userData3);
                            if($balance['balance'] >= 30){
                                $userData3 = [
                                    'user_id' => $upline2['upline_id'],
                                    'amount' => $income2,
                                    'type' => 'pool_income',
                                    'description' => 'Upgrade deduction at level 2',
                                    'level' => '2',
                                ];
                                $this->User_model->add('tbl_income_wallet',$userData3);
                                $balance1 = $this->User_model->get_single_record('tbl_income_wallet',array('user_id' => $upline2['upline_id'],'level' => '2','amount < ' => '0'),'ifnull(sum(amount),0) as balance');
                                if(abs($balance1['balance']) == 30){
                                    $upline3 = $this->User_model->get_single_record('tbl_pool',array('user_id' => $upline2['upline_id']),'upline_id');
                                    if(!empty($upline3['upline_id'])){
                                        $balance3 = $this->User_model->get_single_record('tbl_income_wallet',array('user_id' => $upline3['upline_id'],'level' => '3','amount > ' => '0'),'ifnull(sum(amount),0) as balance');
                                        $userData4 = [
                                            'user_id' => $upline3['upline_id'],
                                            'amount' => 30,
                                            'type' => 'pool_income',
                                            'description' => 'Pool Income at level 3',
                                            'level' => '3',
                                        ];
                                        $this->User_model->add('tbl_income_wallet',$userData4);
                                        if($balance3['balance'] >= 120){
                                            $userData4 = [
                                                'user_id' => $upline3['upline_id'],
                                                'amount' => -30,
                                                'type' => 'pool_income',
                                                'description' => 'Upgrade deduction at level 3',
                                                'level' => '3',
                                            ];
                                            $this->User_model->add('tbl_income_wallet',$userData4);
                                            if($balance3['balance'] == '120'){
                                                $this->crowdPay($upline3['upline_id'],'20','3');
                                            }
                                            $balance4 = $this->User_model->get_single_record('tbl_income_wallet',array('user_id' => $upline3['upline_id'],'level' => '3','amount < ' => '0'),'ifnull(sum(amount),0) as balance');
                                            if(abs($balance4['balance'] == 140)){
                                                $upline4 = $this->User_model->get_single_record('tbl_pool',array('user_id' => $upline3['upline_id']),'upline_id');
                                                if(!empty($upline4['upline_id'])){
                                                    $balance5 = $this->User_model->get_single_record('tbl_income_wallet',array('user_id' => $upline4['upline_id'],'level' => '4','amount > ' => '0'),'ifnull(sum(amount),0) as balance');
                                                    $userData5 = [
                                                        'user_id' => $upline4['upline_id'],
                                                        'amount' => 120,
                                                        'type' => 'pool_income',
                                                        'description' => 'Pool Income at level 4',
                                                        'level' => '4',
                                                    ];
                                                    $this->User_model->add('tbl_income_wallet',$userData5);
                                                    if($balance5['balance'] >= '960'){
                                                        $userData6 = [
                                                            'user_id' => $upline4['upline_id'],
                                                            'amount' => -120,
                                                            'type' => 'pool_income',
                                                            'description' => 'Upgrade deduction at level 4',
                                                            'level' => '4',
                                                        ]; 
                                                        $this->User_model->add('tbl_income_wallet',$userData6);
                                                        if($balance3['balance'] == '960'){
                                                            $this->crowdPay($upline4['upline_id'],'60','4');
                                                        }
                                                        $balance6 = $this->User_model->get_single_record('tbl_income_wallet',array('user_id' => $upline4['upline_id'],'level' => '4','amount < ' => '0'),'ifnull(sum(amount),0) as balance');
                                                        if(abs($balance6['balance'] == 1020)){
                                                            $upline5 = $this->User_model->get_single_record('tbl_pool',array('user_id' => $upline4['upline_id']),'upline_id');
                                                            if(!empty($upline5['upline_id'])){
                                                                $balance7 = $this->User_model->get_single_record('tbl_income_wallet',array('user_id' => $upline5['upline_id'],'level' => '5','amount > ' => '0'),'ifnull(sum(amount),0) as balance');
                                                                $userData6 = [
                                                                    'user_id' => $upline5['upline_id'],
                                                                    'amount' => 960,
                                                                    'type' => 'pool_income',
                                                                    'description' => 'Pool Income at level 5',
                                                                    'level' => '5',
                                                                ];
                                                                $this->User_model->add('tbl_income_wallet',$userData6);
                                                                if($balance7['balance'] >= '15360'){
                                                                    $userData7 = [
                                                                        'user_id' => $upline5['upline_id'],
                                                                        'amount' => -960,
                                                                        'type' => 'pool_income',
                                                                        'description' => 'Upgrade deduction at level 5',
                                                                        'level' => '5',
                                                                    ]; 
                                                                    $this->User_model->add('tbl_income_wallet',$userData7);
                                                                    if($balance7['balance'] == '15360'){
                                                                        $this->crowdPay($upline5['upline_id'],'360','5');
                                                                    }
                                                                    $balance8 = $this->User_model->get_single_record('tbl_income_wallet',array('user_id' => $upline5['upline_id'],'level' => '5','amount < ' => '0'),'ifnull(sum(amount),0) as balance');
                                                                    if(abs($balance8['balance'] == 15720)){
                                                                        $upline6 = $this->User_model->get_single_record('tbl_pool',array('user_id' => $upline5['upline_id']),'upline_id');
                                                                        if(!empty($upline6['upline_id'])){
                                                                            $balance9 = $this->User_model->get_single_record('tbl_income_wallet',array('user_id' => $upline6['upline_id'],'level' => '6','amount > ' => '0'),'ifnull(sum(amount),0) as balance');
                                                                            $userData8 = [
                                                                                'user_id' => $upline6['upline_id'],
                                                                                'amount' => 15360,
                                                                                'type' => 'pool_income',
                                                                                'description' => 'Pool Income at level 6',
                                                                                'level' => '6',
                                                                            ];
                                                                            $this->User_model->add('tbl_income_wallet',$userData8);
                                                                            if($balance9['balance'] >= '491520'){
                                                                                if($balance9['balance'] <= '798720')
                                                                                $this->crowdPay($upline6['upline_id'],'4152','6');
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } 
                            }
                        }
                    }
                }
            }
        }
    }

    public function crowdPay($user_id,$amount,$level){
        $userData = [
            'user_id' => $user_id,
            'amount' => -$amount,
            'type' => 'pool_income',
            'description' => 'Crowd Pay deduction at level '.$level,
            'level' => $level,
        ];
        $this->User_model->add('tbl_income_wallet',$userData);
        $userData2 = [
            'user_id' => 'admin',
            'amount' => $amount,
            'type' => 'pool_income',
            'description' => 'Crowd Pay Income at level '.$level.' From '.$user_id,
            'level' => $level,
        ];
        $this->User_model->add('tbl_income_wallet',$userData2);
    }

    public function updateLevelUser($user_id,$level){
        $pool = $this->User_model->get_single_record('tbl_pool', array('user_id' => $user_id), '*');
        if($level == 1 && $pool['level1'] < 2){
            $newLevel = $pool['level1'] + 1;
            $this->User_model->update('tbl_pool',array('user_id' => $user_id),array('level1' => $newLevel));
            //$this->poolIncome($user_id,$level,$pool['level1']);
        }elseif($level == 2 && $pool['level2'] < 4){
            $newLevel = $pool['level2'] + 1;
            $this->User_model->update('tbl_pool',array('user_id' => $user_id),array('level2' => $newLevel));
            //$this->poolIncome($user_id,$level,$pool['level2']);
        }elseif($level == 3 && $pool['level3'] < 8){
            $newLevel = $pool['level3'] + 1;
            $this->User_model->update('tbl_pool',array('user_id' => $user_id),array('level3' => $newLevel));
            //$this->poolIncome($user_id,$level,$pool['level3']);
        }elseif($level == 4 && $pool['level4'] < 16){
            $newLevel = $pool['level4'] + 1;
            $this->User_model->update('tbl_pool',array('user_id' => $user_id),array('level4' => $newLevel));
            //$this->poolIncome($user_id,$level,$pool['level4']);
        }elseif($level == 5 && $pool['level5'] < 32){
            $newLevel = $pool['level5'] + 1;
            $this->User_model->update('tbl_pool',array('user_id' => $user_id),array('level5' => $newLevel));
            //$this->poolIncome($user_id,$level,$pool['level5']);
        }elseif($level == 6 && $pool['level6'] < 64){
            $newLevel = $pool['level6'] + 1;
            $this->User_model->update('tbl_pool',array('user_id' => $user_id),array('level6' => $newLevel));
            //$this->poolIncome($user_id,$level,$pool['level6']);
        }
    }

    public function next_pool_entry($user_id,$table){
        $pool_upline = $this->User_model->get_single_record($table, array('down_node <' => 2), 'id,user_id,down_node');
        if(!empty($pool_upline)){
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => $pool_upline['user_id'],
            );
            if($pool_upline['down_node'] == 0)
                $poolArr['position'] = 'L';
            else
                $poolArr['position'] = 'R';
            $this->User_model->add($table, $poolArr);
            $this->User_model->update($table, array('id' => $pool_upline['id']),array('down_node' => $pool_upline['down_node'] + 1));
            $this->update_pool2_counts($poolArr['user_id'],$table);
        }else{
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => 'none',
            );
            $this->User_model->add($table, $poolArr);
        }
    }
    public function update_pool2_counts($user_id,$table){
        $pool = $this->User_model->get_single_record($table, array('user_id' => $user_id), 'id,user_id,upline_id,position,left_count,team,right_count');
        if(!empty($pool)){
            if($pool['position'] == 'L'){
                $updArr['left_count'] = $pool['left_count'] + 1;
                $c = 'left_count';
            }else{                
                $updArr['right_count'] = $pool['right_count'] + 1;
                $c = 'right_count';
            }
            // pr($pool);
            // pr($updArr);
            $this->User_model->update_bv2($c, $pool['upline_id'],$table);
            // $this->User_model->update('tbl_pool', array('user_id' => $pool['upline_id']),$updArr);
            $this->update_pool2_counts($pool['upline_id'],$table);
        }
    }

    function level_income($user_id,$linkedID,$levelIncome) {
        $incomes = explode(',',$levelIncome);
        foreach ($incomes as $key => $income) {
            $sponsor = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id),'sponser_id');
            $direct = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponsor['sponser_id']),'directs');
            if (!empty($sponsor['sponser_id']) && $sponsor['sponser_id'] != 'none'){
                if($direct['directs'] > 2){
                    $LevelIncome = array(
                        'user_id' => $sponsor['sponser_id'],
                        'amount' => $income,
                        'type' => 'level_income',
                        'description' => 'Level Income from User ID '.$linkedID.' At level '.($key + 1),
                    );
                    $this->User_model->add('tbl_income_wallet', $LevelIncome);
                }
                $user_id = $sponsor['sponser_id'];
            }
        }
    }

    public function check_pool_stats() {
        $achievers = $this->User_model->get_records('tbl_pool', array('next_level' => 0, 'level1' => 5), '*');
        foreach ($achievers as $key => $achiever) {
            $RankIncome = array(
                'user_id' => $achiever['user_id'],
                'amount' => $achiever['pool_amount'] * 80 / 100,
                'type' => 'pool_income',
                'description' => 'Pool Bonus From level ' . $achiever['pool_level'],
            );
            $this->User_model->add('tbl_income_wallet', $RankIncome);
            $this->repurchase_income($achiever['user_id'], ($achiever['pool_amount'] * 20 / 100), 'pool_income', 'Pool Bonus From level ' . $achiever['pool_level']);
            $this->User_model->update('tbl_pool', array('id' => $achiever['id']), array('next_level' => 1));
            $this->pool_entry($achiever['user_id'], ($achiever['pool_level'] + 1), ($achiever['pool_amount'] * 2));
            $company_ids = $achiever['pool_amount'] / 500;
            for ($i = 1; $i <= $company_ids; $i++) {
                $this->pool_entry('admin', 1, 500);
            }
        }
    }

    public function UpgradeAccount() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                // $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                // if ($this->form_validation->run() != FALSE) {
                $user_id = $this->session->userdata['user_id'];
                $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                if (!empty($user)) {
                    // pr($user,true);
                    if ($wallet['wallet_balance'] >= $package['price']) {
                        if ($package['price'] > $user['package_amount']) {
                            $sendWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$package['price'],
                                'type' => 'account_activation',
                                'remark' => 'Account upgrade Deduction for ' . $user_id,
                            );
                            $this->User_model->add('tbl_wallet', $sendWallet);
                            $topupData = array(
                                'paid_status' => 1,
                                'package_id' => $data['package_id'],
                                'package_amount' => $package['price'],
                                'topup_date' => date('Y-m-d H:i:s'),
                                'capping' => $package['capping'],
                            );
                            $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                            //$this->User_model->update_directs($user['sponser_id']);
                            $roiArr = array(
                                'user_id' => $user['user_id'],
                                'amount' => ($package['price'] * 2),
                                'roi_amount' => $package['commision'],
                                'days' => $package['capping'],
                                'creditDate' => date('Y-m-d'),
                                'type' => 'roi_first',
                            );
                            $this->User_model->add('tbl_roi', $roiArr);
                            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs');
                            $DirectIncome = array(
                                'user_id' => $user['sponser_id'],
                                'amount' => $package['direct_income'],
                                'type' => 'direct_income',
                                'description' => 'Direct Income from Retopup of Member ' . $user_id,
                            );
                            $this->User_model->add('tbl_income_wallet', $DirectIncome);
                            $this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'], $type = 'topup');
                            $this->level_income($user['user_id'],$user['user_id'],$package['level_income']);
                            $this->session->set_flashdata('message', 'Account Retopup Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'This Account Already Acitvated');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Insuffcient Balance');
                    }
                    // }else{
                    //     $this->session->set_flashdata('message', 'Invalid User ID');
                    // }
                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package', array('price >= ' => $response['user']['package_amount']), '*');
            $this->load->view('upgrade_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    // function update_business($user_name = 'A915813', $downline_id = 'A915813', $level = 1, $business = '40', $type = 'topup') {
    //     $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
    //     if (!empty($user)) {
    //         if ($user['position'] == 'L') {
    //             $c = 'leftPower';
    //         } else if ($user['position'] == 'R') {
    //             $c = 'rightPower';
    //         } else {
    //             return;
    //         }
    //         $this->User_model->update_business($c, $user['upline_id'], $business);
    //         $downlineArray = array(
    //             'user_id' => $user['upline_id'],
    //             'downline_id' => $downline_id,
    //             'position' => $user['position'],
    //             'business' => $business,
    //             'type' => $type,
    //             'created_at' => date('Y-m-d h:i:s'),
    //             'level' => $level,
    //         );
    //         $this->User_model->add('tbl_downline_business', $downlineArray);
    //         $user_name = $user['upline_id'];

    //         if ($user['upline_id'] != '') {
    //             $this->update_business($user_name, $downline_id, $level + 1, $business, $type);
    //         }
    //     }
    // }

    // function test(){
    //     $user = $this->User_model->get_records('tbl_pool',array('user_id !=' => 'admin'),'*');
    //     foreach($user as $u){
    //         $this->update_businesstest($u['user_id'], $u['user_id'], $level = 1,'100' , 'topup');
    //     }
    // }

    function update_business($user_name, $downline_id, $level = 1, $business, $type) {
        $user = $this->User_model->get_single_record('tbl_pool', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $c = 'leftPower';
            } else if ($user['position'] == 'R') {
                $c = 'rightPower';
            } else {
                return;
            }
            //$this->User_model->update_business($c, $user['upline_id'], $business);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'business' => $business,
                'type' => $type,
                'created_at' => date('Y-m-d h:i:s'),
                'level' => $level,
            );
            
            $this->User_model->add('tbl_downline_business', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != 'none') {
                $this->update_business($user_name, $downline_id, $level + 1, $business, $type);
            }
        }
    }

    public function getUserIdForRegister($country_code = '') {
        $sponser = $this->User_model->get_single_record('tbl_users', array(), 'ifnull(max(id_number),0) + 1 as next_id');
        if ($sponser['next_id'] == 1) {
            $user_id = '10001';
        } else {
            $user_id = $sponser['next_id'];
        }
        return $user_id;
    }

    public function generateUserId() {
        $user_id = rand(10000, 99999);
    }

//    public function magic_income_use() {
//        $magic_users = $this->User_model->magic_users();
//        pr($magic_users);
//        foreach ($magic_users as $user) {
//            $this->register_magic_user($user['user_id']);
//        }
//    }
//    public function register_magic_user($user_id) {
//        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
//        $id_number = $this->getUserIdForRegister();
//        $userData['user_id'] = 'WIN' . $id_number;
//        $userData['id_number'] = $id_number;
//        $userData['sponser_id'] = $user['sponser_id'];
//        $userData['name'] = $user['name'];
//        $userData['phone'] = $user['phone'];
//        $userData['password'] = $user['password'];
//        $userData['user_type'] = 'magic';
//        $this->User_model->add('tbl_users', $userData);
//        $this->User_model->add('tbl_bank_details', array('user_id' => $userData['user_id']));
//        $this->repurchase_income($user_id, -3600, 'magic_user_registration', 'New Magic User Registered with ID ' . $userData['user_id']);
//        $this->topup_magic_user($userData['user_id']);
//    }
//
//    public function topup_magic_user($user_id) {
//        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
//        $package = $this->User_model->get_single_record('tbl_package', array('id' => 1), '*');
//        $this->User_model->update('tbl_users', array('user_id' => $user_id), array('paid_status' => 1, 'package_id' => $package['id'], 'package_amount' => $package['price'], 'topup_date' => date('Y-m-d h:i:s')));
//        $this->User_model->update_directs($user['sponser_id']);
//        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs');
//        $DirectIncome = array(
//            'user_id' => $user['sponser_id'],
//            'amount' => $package['direct_income'] * 80 / 100,
//            'type' => 'direct_income',
//            'description' => 'Direct Income from Activation of Member ' . $user_id,
//        );
//        $this->User_model->add('tbl_income_wallet', $DirectIncome);
//        $this->repurchase_income($user['sponser_id'], ($package['direct_income'] * 20 / 100), 'direct_income', 'Direct Income from Activation of Member ' . $user_id);
//        $this->level_income($sponser['sponser_id'], $user['user_id'], $package['level_income']);
//        $this->pool_entry($user['user_id'], 1, 500);
//        if ($package['price'] == 3600)
//            $this->rank_bonus($user['user_id'], 200, $user['user_id'], 0, $package['price']);
//        else
//            $this->rank_bonus($user['user_id'], 105, $user['user_id'], 0, $package['price']);
//        //$this->rank_bonus($user['user_id'], 200,$user['user_id'],0 , $package['price']);
//    }
//    public function differance_income_distribution() {
//        $rank_incomes = array(
//            5 => 50,
//            10 => 75,
//            15 => 100,
//            20 => 125,
//            25 => 150,
//            50 => 175,
//            100 => 200,
//        );
//    }
//    public function rank_bonus($user_id = 'AMAZING6388', $amount = '200', $sender_id = 'AMAZING5177', $total_distribution = 0, $package_amount = 3600, $last_rank = 0) {
//        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,sponser_id,paid_status,package_id,directs');
//        if ($amount > 0) {
//            if (!empty($sponser)) {
//                $sponser['last_distribution'] = $total_distribution;
//                if ($package_amount == 3600) {
//                    if ($sponser['directs'] >= 100) {
//                        $income = 200;
//                        $winner_rank = 7;
//                    } elseif ($sponser['directs'] >= 50) {
//                        $income = 175;
//                        $winner_rank = 6;
//                    } elseif ($sponser['directs'] >= 25) {
//                        $income = 150;
//                        $winner_rank = 5;
//                    } elseif ($sponser['directs'] >= 20) {
//                        $income = 125;
//                        $winner_rank = 4;
//                    } elseif ($sponser['directs'] >= 15) {
//                        $income = 100;
//                        $winner_rank = 3;
//                    } elseif ($sponser['directs'] >= 10) {
//                        $income = 75;
//                        $winner_rank = 2;
//                    } elseif ($sponser['directs'] >= 5) {
//                        $income = 50;
//                        $winner_rank = 1;
//                    } elseif ($sponser['directs'] >= 0) {
//                        $winner_rank = 0;
//                        $income = 0;
//                    }
//                } else {
//                    if ($sponser['directs'] >= 100) {
//                        $income = 105;
//                        $winner_rank = 7;
//                    } elseif ($sponser['directs'] >= 50) {
//                        $income = 90;
//                        $winner_rank = 6;
//                    } elseif ($sponser['directs'] >= 25) {
//                        $income = 75;
//                        $winner_rank = 5;
//                    } elseif ($sponser['directs'] >= 20) {
//                        $income = 60;
//                        $winner_rank = 4;
//                    } elseif ($sponser['directs'] >= 15) {
//                        $income = 45;
//                        $winner_rank = 3;
//                    } elseif ($sponser['directs'] >= 10) {
//                        $income = 30;
//                        $winner_rank = 2;
//                    } elseif ($sponser['directs'] >= 5) {
//                        $income = 15;
//                        $winner_rank = 1;
//                    } elseif ($sponser['directs'] >= 0) {
//                        $income = 0;
//                        $winner_rank = 0;
//                    }
//                }
//                $main_income = $income - $total_distribution;
//                $total_distribution = $total_distribution + $main_income;
//                if ($main_income > $amount) {
//                    $main_income = $amount;
//                }
//                $amount = $amount - $main_income;
//                $user_rank = calculate_rank($sponser['directs']);
//                $RankIncome = array(
//                    'user_id' => $sponser['user_id'],
//                    'amount' => $main_income * 80 / 100,
//                    'type' => 'rank_bonus',
//                    'description' => 'Rank Bonus From ' . $sender_id . ' At ' . $user_rank,
//                );
//                // $RankIncome['total_distribution'] = $total_distribution;
//                // $RankIncome['income'] = $main_income;
//                if ($main_income > 0) {
//                    if ($winner_rank > $last_rank) {
//                        $this->User_model->add('tbl_income_wallet', $RankIncome);
//                        $this->repurchase_income($sponser['user_id'], ($main_income * 20 / 100), 'rank_bonus', 'Rank Bonus From ' . $sender_id);
//                        $last_rank = $winner_rank;
//                    }
//                }
//
//                $this->rank_bonus($sponser['sponser_id'], $amount, $sender_id, $total_distribution, $package_amount, $last_rank);
//            }
//        }
//    }
    // public function rank_bonus($user_id = 'WIN10024', $amount ='200', $sender_id  = 'WIN10024', $last_distribution = 0){
    //     $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,sponser_id,paid_status,package_id,directs');
    //     if(!empty($sponser)){
    //         $sponser['rank'] = calculate_rank($sponser['directs']);
    //         $bonus_amount = calculate_rank_bonus($sponser['directs'],$sponser['package_id']);
    //         if($bonus_amount > 0){
    //             // $bonus_amount = $bonus_amount - $last_distribution;
    //             // if($amount > $bonus_amount)
    //             //     $income = $bonus_amount;
    //             // else
    //             //     $income = $amount;
    //                 $income = $bonus_amount;
    //             if($income > 0){
    //                 $RankIncome = array(
    //                     'user_id' => $sponser['user_id'],
    //                     'amount' => $income * 100 / 100 ,
    //                     'type' => 'rank_bonus',
    //                     'description' => 'Rank Bonus From '.$sender_id,
    //                 );
    //                 $sponser['income'] = $income;
    //                 $sponser['last_distribution'] = $last_distribution;
    //                 $sponser['status'] = '--------------------------';
    //                 // $this->User_model->add('tbl_income_wallet', $RankIncome);
    //                 $this->repurchase_income($sponser['user_id'],($income * 20 / 100),'rank_bonus' ,'Rank Bonus From '.$sender_id);
    //             }
    //             pr($sponser);
    //             $last_distribution =  $last_distribution - $income;
    //             if($amount > 0){
    //                 $this->rank_bonus($sponser['sponser_id'] , $amount , $sender_id , abs($last_distribution));
    //                 echo'case1';
    //             }
    //         }else{
    //             $this->rank_bonus($sponser['sponser_id'] , $amount , $sender_id, $last_distribution);
    //             echo'case2';
    //         }
    //     }
    // }

    public function payment_response($message) {
        if ($message == 'success') {
            $response['message'] = 'Payment Completed Succesfully';
        } else {
            $response['message'] = 'Error in Payment Process';
        }

        $this->load->view('payment_response', $response);
    }

    public function repurchase_income($user_id, $amount, $type, $description) {
        $RepurchaseIncome = array(
            'user_id' => $user_id,
            'amount' => $amount,
            'type' => $type,
            'description' => $description,
        );
        $this->User_model->add('tbl_repurchase_income', $RepurchaseIncome);
    }

    public function IncomeTransfer() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    $user_id = $this->input->post('user_id');
                    $transfer_user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
                    if(!empty($transfer_user)){
                        if($user['directs'] >= 3){
                        if ($withdraw_amount >= 25) {
                            if ($balance['balance'] >= $withdraw_amount) {
                                // if($user['master_key'] == $master_key){
                                $debitAmount = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => - $withdraw_amount,
                                    'type' => 'income_transfer',
                                    'description' => 'Sent ' . $withdraw_amount . ' to ' . $user_id,
                                );
                                $this->User_model->add('tbl_income_wallet', $debitAmount);
                                $creditAmount = array(
                                    'user_id' => $user_id,
                                    'amount' => $withdraw_amount*0.9,
                                    'type' => 'income_transfer',
                                    'description' => 'Got ' . $withdraw_amount . ' from ' . $this->session->userdata['user_id'],
                                );
                                $this->User_model->add('tbl_income_wallet', $creditAmount);

                                $this->session->set_flashdata('message', 'Income Transferred Successfully');
                                // }else{
                                //     $this->session->set_flashdata('message', 'Invalid Master Key');
                                // }
                            } else {
                                $this->session->set_flashdata('message', 'Insuffcient Balance');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Minimum Transfer Amount is $25');
                        }
                        } else {
                        $this->session->set_flashdata('message', '2 direct compulsory for wallet transfer');
                    }
                    } else {
                        $this->session->set_flashdata('message', 'Please enter valid User ID');
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('income_transfer', $response);
        } else {

        }
    }

    public function eiTransfer() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                //$this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    $user_id = $this->session->userdata['user_id']; //$this->input->post('user_id');
                    $transfer_user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
                    if(!empty($transfer_user)){
                        //if($user['directs'] >= 2){
                        if ($withdraw_amount >= 5) {
                            if ($balance['balance'] >= $withdraw_amount) {
                                // if($user['master_key'] == $master_key){
                                $debitAmount = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => - $withdraw_amount,
                                    'type' => 'income_transfer',
                                    'description' => 'Sent ' . $withdraw_amount . ' to ' . $user_id,
                                );
                                $this->User_model->add('tbl_income_wallet', $debitAmount);
                                $creditAmount = array(
                                    'user_id' => $user_id,
                                    'amount' => $withdraw_amount*0.9,
                                    'type' => 'income_transfer',
                                    'remark' => 'Got ' . $withdraw_amount . ' from ' . $this->session->userdata['user_id'],
                                );
                                $this->User_model->add('tbl_wallet', $creditAmount);

                                $this->session->set_flashdata('message', 'Income Transferred Successfully');
                                // }else{
                                //     $this->session->set_flashdata('message', 'Invalid Master Key');
                                // }
                            } else {
                                $this->session->set_flashdata('message', 'Insuffcient Balance');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Minimum Transfer Amount is $5');
                        }
                    //     } else {
                    //     $this->session->set_flashdata('message', '2 direct compulsory for wallet transfer');
                    // }
                    } else {
                        $this->session->set_flashdata('message', 'Please enter valid User ID');
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('income_wallet_transfer', $response);
        } else {

        }
    }

    // public function DirectIncomeWithdraw($id='') {
    //     //die('this page is accessable');
    //     if (is_logged_in()) {
    // $id = trim(addslashes($id));
    //         $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
    //         $check = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id'], 'id' => $id), '*');
    //         if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //             $data = $this->security->xss_clean($this->input->post());
    //             $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
    //             $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
    //             if ($this->form_validation->run() != FALSE) {
    //                 // $user_id = $data['user_id'];
    //                 $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
    //                 $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
    //                 $withdraw_amount = $this->input->post('amount');
    //                 // $winto_user_id = $this->input->post('user_id');
    //                 $master_key = $this->input->post('master_key');
    //                 $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
    //              if(!empty($check)){
    //                     if ($withdraw_amount >= 20) {
    //                         if ($withdraw_amount % 10 == 0) {
    //                             if ($balance['balance'] >= $withdraw_amount) {
    //                                 if ($user['master_key'] == $master_key) {
    //                                     if($user['directs'] > 1){
    //                                     // if($kyc_status['kyc_status'] == 2){
    //                                         $DirectIncome = array(
    //                                             'user_id' => $this->session->userdata['user_id'],
    //                                             'amount' => - $withdraw_amount,
    //                                             'type' => 'direct_income_withdraw',
    //                                             'description' => 'Direct income Withdraw ',
    //                                         );
    //                                         $this->User_model->add('tbl_income_wallet', $DirectIncome);
    //                                         if ($data['pin_transfer'] == 0) {
    //                                             $withdrawArr = array(
    //                                                 'user_id' => $this->session->userdata['user_id'],
    //                                                 'amount' => $withdraw_amount,
    //                                                 'type' => 'direct_income',
    //                                                 'tds' => 0,
    //                                                 'admin_charges' => $withdraw_amount * 10 / 100,
    //                                                 'fund_conversion' => 0,
    //                                                 'payable_amount' => $withdraw_amount - ($withdraw_amount * 10 / 100)
    //                                             );
    //                                             $this->User_model->add('tbl_withdraw', $withdrawArr);
    //                                         } else {
    //                                             // $fund_converstion = $withdraw_amount * 45 /100;
    //                                             // $withdrawArr['user_id'] = $this->session->userdata['user_id'];
    //                                             // $withdrawArr['type'] = 'direct_income' ;
    //                                             // $withdrawArr['amount'] = $withdraw_amount;
    //                                             // $withdrawArr['admin_charges'] = $withdraw_amount * 10 /100;
    //                                             // $withdrawArr['fund_conversion'] = $withdraw_amount * 45 /100;
    //                                             // $withdrawArr['tds'] = $withdrawArr['fund_conversion'] * 5 /100;
    //                                             // $withdrawArr['payable_amount'] = $withdrawArr['fund_conversion'] - $withdrawArr['tds'];
    //                                             // $this->User_model->add('tbl_withdraw', $withdrawArr);
    //                                             $walletArr = array(
    //                                                 'user_id' => $this->session->userdata['user_id'],
    //                                                 'amount' => $withdraw_amount * 100 / 100,
    //                                                 'type' => 'direct_income_withdraw',
    //                                                 'remark' => 'fund generated from direct income withdraw',
    //                                                 'sender_id' => $this->session->userdata['user_id'],
    //                                             );
    //                                             $this->User_model->add('tbl_wallet', $walletArr);
    //                                         }
    //                                         $this->session->set_flashdata('message', 'Withdraw Requested Successfully');
    //                                         // }else{
    //                                         //     $this->session->set_flashdata('message', 'Please Complete your Kyc before withdrawal amount');
    //                                         // }
    //                                     }else{
    //                                         $this->session->set_flashdata('message', '2 Paid direct required for withdrawal');
    //                                     }
    //                                 } else {
    //                                     $this->session->set_flashdata('message', 'Invalid Master Key');
    //                                 }
    //                             } else {
    //                                 $this->session->set_flashdata('message', 'Insuffcient Balance');
    //                             }
    //                         } else {
    //                             $this->session->set_flashdata('message', 'Withdraw Amount is multiple of $10');
    //                         }
    //                     } else {
    //                         $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is $20');
    //                     }
    //                 } else {
    //                     $this->session->set_flashdata('message', 'Beneficiary Details Not Found!');
    //                 }    
    //             } else {
    //                 $this->session->set_flashdata('message', 'erorrrrr');
    //             }
    //         }
    //         $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
    //         $this->load->view('direct_income_withdraw', $response);
    //     } else {
    //         redirect('Dashboard/User/login');
    //     }
    // }

     public function DirectIncomeWithdraw($id='') {
        //die('this page is accessable');
        if (is_logged_in()) {
            $id = trim(addslashes($id));
            $response['title'] = "Direct Withdraw";
            $response['des'] = "Minimum Withdrawal Amount $10";
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $check = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id'], 'id' => $id), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                $this->form_validation->set_rules('credit_type', 'Credit in', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    // $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $today_withdraw = $this->User_model->get_single_record('tbl_withdraw', array('user_id' => $this->session->userdata['user_id'],'date(created_at)' => date('Y-m-d')), '*');
                    $withdraw_amount = $this->input->post('amount');
                    // $winto_user_id = $this->input->post('user_id');
                    $master_key = $this->input->post('master_key');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
                    if($data['otp'] == $_SESSION['verification_otp'] && !empty($_SESSION['verification_otp'])){
                        if(!empty($check)){
                            if($user['directs'] > 2){
                                if ($withdraw_amount >= 10) {
                                    if ($withdraw_amount % 10 == 0) {
                                        if ($balance['balance'] >= $withdraw_amount) {
                                            if(empty($today_withdraw )){
                                                if ($user['master_key'] == $master_key) {
                                                    // if($kyc_status['kyc_status'] == 2){
                                                    if($data['credit_type'] == 'INR'){
                                                        $tds = 0;
                                                        $admin = 10;
                                                        $charges = 10;
                                                    }else{
                                                        $tds = 0;
                                                        $admin = 5;
                                                        $charges = 5;
                                                    }
                                                    if($withdraw_amount > 30){
                                                        $tds = 0;
                                                    }else{
                                                        $tds = 20;
                                                        $charges = 20;
                                                    }
                                                    $DirectIncome = array(
                                                        'user_id' => $this->session->userdata['user_id'],
                                                        'amount' => - $withdraw_amount,
                                                        'type' => 'withdraw_request',
                                                        'description' => 'Withdrawal Amount ',
                                                    );
                                                    $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                                    if ($data['pin_transfer'] == 0) {
                                                        $withdrawArr = array(
                                                            'beneficary_id' => $id,
                                                            'user_id' => $this->session->userdata['user_id'],
                                                            'amount' => $withdraw_amount,
                                                            'type' => 'withdraw_request',
                                                            'tds' => $withdraw_amount * $tds / 100,
                                                            'admin_charges' => $withdraw_amount * $admin / 100,
                                                            'fund_conversion' => 0,
                                                            'payable_amount' => $withdraw_amount - ($withdraw_amount * $charges / 100),
                                                            'credit_type' => $data['credit_type'],
                                                        );
                                                        $this->User_model->add('tbl_withdraw', $withdrawArr);
                                                    } else {
                                                        // $fund_converstion = $withdraw_amount * 45 /100;
                                                        // $withdrawArr['user_id'] = $this->session->userdata['user_id'];
                                                        // $withdrawArr['type'] = 'direct_income' ;
                                                        // $withdrawArr['amount'] = $withdraw_amount;
                                                        // $withdrawArr['admin_charges'] = $withdraw_amount * 10 /100;
                                                        // $withdrawArr['fund_conversion'] = $withdraw_amount * 45 /100;
                                                        // $withdrawArr['tds'] = $withdrawArr['fund_conversion'] * 5 /100;
                                                        // $withdrawArr['payable_amount'] = $withdrawArr['fund_conversion'] - $withdrawArr['tds'];
                                                        // $this->User_model->add('tbl_withdraw', $withdrawArr);
                                                        $walletArr = array(
                                                            'user_id' => $this->session->userdata['user_id'],
                                                            'amount' => $withdraw_amount * 85 / 100,
                                                            'type' => 'direct_income_withdraw',
                                                            'remark' => 'fund generated from direct income withdraw',
                                                            'sender_id' => $this->session->userdata['user_id'],
                                                        );
                                                        $this->User_model->add('tbl_wallet', $walletArr);
                                                    }
                                                    $this->session->set_flashdata('message', 'Withdraw Requested     Successfully');
                                                    // }else{
                                                    //     $this->session->set_flashdata('message', 'Please Complete your Kyc before withdrawal amount');
                                                    // }
                                                } else {
                                                    $this->session->set_flashdata('message', 'Invalid Master Key');
                                                }
                                            }else{
                                                $this->session->set_flashdata('message', 'You have Already Submitted an withdraw Request');
                                            }
                                            
                                        } else {
                                            $this->session->set_flashdata('message', 'Insuffcient Balance');
                                        }
                                    } else {
                                        $this->session->set_flashdata('message', 'Withdraw Amount is multiple of $10');
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is $10');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Minimum  3 Directs For Withdrawal Amount');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Beneficiary Details Not Found!');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'ERROR:: OTP not matched!');
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
            $response['withdraw_button'] = $this->User_model->get_single_record('tbl_site_content',['id' => 1],'withdraw_button');

            $this->load->view('direct_income_withdraw2', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function app_fund_transfer($me_id, $amount, $sender_id) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://winto.in/MobileApp/Money_transfer/receiveMoneyFromSite",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('me_id' => $me_id, 'amount' => $amount, 'sender_id' => $sender_id),
            CURLOPT_HTTPHEADER => array(),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function get_app_user($user_id) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://winto.in/MobileApp/Money_transfer/validate_user",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('user_id' => $user_id),
            CURLOPT_HTTPHEADER => array(),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function TaskIncomeWithdraw() {
        die('this page is accessable');
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    // $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    // $winto_user_id = $this->input->post('user_id');
                    $master_key = $this->input->post('master_key');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" and (type = "task_income" or  type = "task_income_withdraw" or type = "task_level_income")', 'ifnull(sum(amount),0) as balance');
                    if ($withdraw_amount >= 200) {
                        if ($balance['balance'] >= $withdraw_amount) {
                            if ($user['master_key'] == $master_key) {
                                $DirectIncome = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => - $withdraw_amount,
                                    'type' => 'task_income_withdraw',
                                    'description' => 'Task income Withdraw ',
                                );
                                $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                if ($data['pin_transfer'] == 0) {
                                    $withdrawArr = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => $withdraw_amount,
                                        'type' => 'task_income',
                                        'tds' => $withdraw_amount * 5 / 100,
                                        'admin_charges' => $withdraw_amount * 10 / 100,
                                        'fund_conversion' => 0,
                                        'payable_amount' => $withdraw_amount - ($withdraw_amount * 15 / 100)
                                    );
                                    $this->User_model->add('tbl_withdraw', $withdrawArr);
                                } else {
                                    $fund_converstion = $withdraw_amount * 45 / 100;
                                    $withdrawArr['user_id'] = $this->session->userdata['user_id'];
                                    $withdrawArr['type'] = 'task_income';
                                    $withdrawArr['amount'] = $withdraw_amount;
                                    $withdrawArr['admin_charges'] = $withdraw_amount * 10 / 100;
                                    $withdrawArr['fund_conversion'] = $withdraw_amount * 45 / 100;
                                    $withdrawArr['tds'] = $withdrawArr['fund_conversion'] * 5 / 100;


                                    $withdrawArr['payable_amount'] = $withdrawArr['fund_conversion'] - $withdrawArr['tds'];

                                    $this->User_model->add('tbl_withdraw', $withdrawArr);
                                    $walletArr = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => $withdraw_amount * 45 / 100,
                                        'type' => 'task_income_withdraw',
                                        'remark' => 'fund generated from direct income withdraw',
                                        'sender_id' => $this->session->userdata['user_id'],
                                    );
                                    $this->User_model->add('tbl_wallet', $walletArr);
                                }
                                $this->session->set_flashdata('message', 'Withdraw Requested     Successfully');
                                // $app_response = $this->app_fund_transfer($winto_user_id , ($withdraw_amount * 90 / 100) , $user['user_id']);
                                // $app_response = json_decode($app_response,true);
                                // if($app_response['success'] == 1){
                                //     $DirectIncome = array(
                                //         'user_id' => $this->session->userdata['user_id'],
                                //         'amount' => - $withdraw_amount ,
                                //         'type' => 'direct_income_withdraw',
                                //         'description' => 'Amount WIthdraw in Winto Account for User'.$winto_user_id,
                                //     );
                                //     $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                //     $this->session->set_flashdata('message', 'Amount Withdrawal Successfully');
                                // }else{
                                //     $this->session->set_flashdata('message', $app_response['message']);
                                // }
                            } else {
                                $this->session->set_flashdata('message', 'Invalid Master Key');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Insuffcient Balance');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is Rs 200');
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" and (type = "task_income" or type = "task_income_withdraw" or type = "task_level_income")', 'ifnull(sum(amount),0) as balance');
            $this->load->view('task_income_withdraw', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function CookieBasedTracking() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->count_cookies($this->session->userdata['user_id']);
            $this->load->view('cookie_based_tracking', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function withdraw_history() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Withdraw Summary';
            $response['transactions'] = $this->User_model->get_records('tbl_withdraw', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('transaction_history', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function tds_charges() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'TDS Charges';
            $response['transactions'] = $this->User_model->get_records('tbl_withdraw', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('tds_charges', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function sendEmail($email,$subject,$message){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => '176.58.124.217:3000/send_email',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'to='.$email.'&subject='.$subject.'&message='.$message,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        // echo $response;
    }

    public function forgot_password() {
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $user = $this->User_model->get_single_record('tbl_users', ' user_id = "' . $data['user_id'] . '" or email = "' . $data['user_id'] . '"', 'first_name,name,user_id,email,password');
            if (!empty($user)) {
                $message = "Dear " . $user['name'] .',  password for Your Account is ' . $user['password'];
                $response['message'] = 'One Time Password Sent on Your Email Please check';
                // notify_user($user['user_id'] , $message);
                $this->sendEmail($user['email'], 'Security Alert', $message);
                $this->session->set_flashdata('message', 'Password Sent On Your Email.');
            } else {
                $this->session->set_flashdata('message', 'Invalid User ID');
            }
        }
        $this->load->view('forgot_password', $response);
    }

    public function send_email($email = '349kuldeep@gmail.com', $subject = "Security Alert", $message = 'hello i am here') {
        date_default_timezone_set('Asia/Singapore');
        $this->load->library('email');
        $this->email->from('info@dway.com', 'DwaySwotfish');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send();
    }

}
