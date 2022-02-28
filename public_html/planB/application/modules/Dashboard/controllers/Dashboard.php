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

    public function coupans() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('coupons-amazing', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function mydoublez() {
        $this->load->view('mydoublez');
    }

    public function fix_deposit() {
        if (is_logged_in()) {
            $response = array();
            $response['deposits'] = $this->User_model->get_records('tbl_fix_deposit', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('fix_deposit_list', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    /*     * Token Wallet Activation */

    // public function ActivateAccount() {
    //     if (is_logged_in()) {
    //         $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
    //         if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //             $data = $this->security->xss_clean($this->input->post());
    //             $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
    //             if ($this->form_validation->run() != FALSE) {
    //                 $user_id = $data['user_id'];
    //                 $topup_amount = $data['amount'];
    //                 $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
    //                 $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
    //                 $fund_available_status = 0;
    //                 if(!empty($data['token_wallet'])){
    //                     $token_wallet = $this->User_model->get_single_record('tbl_token_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as token_balance');
    //                     if($wallet['wallet_balance'] >= ($data['amount']*75/100)){
    //                         if( $token_wallet['token_balance'] >= ($data['amount']*25/100)){
    //                             $fund_available_status = 1;
    //                             $fund_deduction = $data['amount']*75/100;
    //                             $this->session->set_flashdata('message', 'Activate with 75%25% fund');
    //                         }else{
    //                             $this->session->set_flashdata('message', 'Insufficient Balance in Token Wallet');
    //                         }
    //                     }else{
    //                         $this->session->set_flashdata('message', 'Insufficient Balance in Wallet');
    //                     }
    //                 }else{
    //                     if($wallet['wallet_balance'] >= $data['amount']){
    //                         $fund_available_status = 1;
    //                         $fund_deduction = $data['amount'];
    //                         $this->session->set_flashdata('message', 'Activate with 100% fund');
    //                     }else{
    //                         $this->session->set_flashdata('message', 'Insufficient Balance in Wallet');
    //                     }
    //                 }
    //                 if (!empty($user)) {
    //                     if ($fund_available_status == 1) {
    //                         if ($user['paid_status'] == 0) {
    //                             $sendWallet = array(
    //                                 'user_id' => $this->session->userdata['user_id'],
    //                                 'amount' => - $fund_deduction,
    //                                 'type' => 'account_activation',
    //                                 'remark' => 'Account Activation Deduction for ' . $user_id,
    //                             );
    //                             $this->User_model->add('tbl_wallet', $sendWallet);
    //                             $topupData = array(
    //                                 'paid_status' => 1,
    //                                 'package_amount' => $data['amount'],
    //                                 'topup_date' => date('Y-m-d h:i:s'),
    //                                 // 'package_id' => $data['package_id'],
    //                                 // 'capping' => $package['capping'],
    //                             );
    //                             if(!empty($data['token_wallet'])){
    //                                 $sendWallet = array(
    //                                     'user_id' => $this->session->userdata['user_id'],
    //                                     'amount' => - $data['amount'] * 25 /100,
    //                                     'type' => 'account_activation',
    //                                     'remark' => 'Account Activation Deduction for ' . $user_id,
    //                                 );
    //                                 $this->User_model->add('tbl_token_wallet', $sendWallet);
    //                             }
    //                             $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
    //                             $this->User_model->update_directs($user['sponser_id']);
    //                             $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs');
    //                             $DirectIncome = array(
    //                                 'user_id' => $user['sponser_id'],
    //                                 'amount' => $data['amount'] * 5 / 100,
    //                                 'type' => 'direct_income',
    //                                 'description' => 'Direct Income from Activation of Member ' . $user_id,
    //                             );
    //                             $this->User_model->add('tbl_income_wallet', $DirectIncome);
    //                             $this->update_business($user['user_id'], $user['user_id'], $level = 1, $data['amount'], $type = 'topup');
    //                             // $roiArr = array(
    //                             //     'user_id' => $user['user_id'],
    //                             //     'amount' => ($package['price'] * 2),
    //                             //     'roi_amount' => $package['commision'],
    //                             // );
    //                             // $this->User_model->add('tbl_roi', $roiArr);
    //                             $this->session->set_flashdata('message', 'Account Activated Successfully');
    //                         } else {
    //                             $this->session->set_flashdata('message', 'This Account Already Acitvated');
    //                         }
    //                     } else {
    //                         // $this->session->set_flashdata('message', 'Insuffcient Balance');
    //                     }
    //                 } else {
    //                     $this->session->set_flashdata('message', 'Invalid User ID');
    //                 }
    //             }
    //         }
    //         $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
    //         $response['token_wallet'] = $this->User_model->get_single_record('tbl_token_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
    //         $response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
    //         $this->load->view('activate_account', $response);
    //     } else {
    //         redirect('Dashboard/User/login');
    //     }
    // }
    public function bank_transfer_summary() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Bank Transfer Summary';
            $response['transactions'] = $this->User_model->get_records('tbl_money_transfer', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('bank_transfer_summary', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function ActivateAccount() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    die('here');
                    $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    //$package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                    if (!empty($user)) {
                        die('here');
                        if ($wallet['wallet_balance'] >= $data['amount']) {
                            if($data['amount'] >= 1000){
                                if($data['amount']%1000 == 0){
                                    if ($user['paid_status'] == 0) {
                                        $sendWallet = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => -$data['amount'],
                                            'type' => 'account_activation',
                                            'remark' => 'Account Activation Deduction for ' . $user_id,
                                        );
                                        $this->User_model->add('tbl_wallet', $sendWallet);
                                        $topupData = array(
                                            'paid_status' => 1,
                                            'package_id' => 1,
                                            'package_amount' => $data['amount'],
                                            'topup_date' => date('Y-m-d H:i:s'),
                                            //'capping' => $package['capping']
                                        );
                                        $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);

                                        $roiData = [
                                            'user_id' => $user['user_id'],
                                            'amount' => $data['amount'] * 2,
                                            'days' => 55,
                                            'roi_amount' => $data['amount']*0.03,
                                            'creditDate' => date('Y-m-d'),
                                        ];
                                        $this->User_model->add('tbl_roi', $roiData);
                                        $this->User_model->update_directs($user['sponser_id']);
                                        $this->User_model->update('tbl_sponser_count',['downline_id' => $user['user_id'],'user_id' => $user['sponser_id']],['paid_status' => 1,'amount' => $data['amount']]);
                                        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,paid_status,package_amount,package_id,directs');
                                        // if($sponser['package_amount'] >= $package['price']){
                                        //     $direct_income = $package['direct_income'];
                                        // }else{
                                        //     $sponser_package = $this->User_model->get_single_record('tbl_package', array('id' => $sponser['package_id']), '*');
                                        //     $direct_income = $sponser_package['direct_income'];
                                        // }
                                        // if ($sponser['paid_status'] >= 1) {
                                        //     $DirectIncome = array(
                                        //         'user_id' => $user['sponser_id'],
                                        //         'amount' => $direct_income,
                                        //         'type' => 'direct_income',
                                        //         'description' => 'Super Direct Income from Activation of Member ' . $user_id,
                                        //     );
                                        //     //$this->User_model->add('tbl_income_wallet', $DirectIncome);
                                        // }
                                        if($sponser['paid_status'] == 1){
                                            $DirectIncome = array(
                                                'user_id' => $user['sponser_id'],
                                                'amount' => $data['amount']*0.05,
                                                'type' => 'direct_income',
                                                'description' => 'Refferal Points from Activation of Member ' . $user_id,
                                            );
                                            $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                        }
                                        $this->level_income($sponser['sponser_id'], $user['user_id'], $data['amount']);
                                        //$this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'], $type = 'topup');
                                        //$this->update_units($user['user_id'] , $user['sponser_id'], $package['commision']);
                                        $sms_text = 'Dear ' .$user_id. ', Your Account Successfully Activated By User ID ' . $this->session->userdata['user_id']. '.' . base_url();
                                        //notify_user($user_id , $sms_text);
                                        $this->session->set_flashdata('message', 'Account Activated Successfully');
                                    } else {
                                        $this->session->set_flashdata('message', 'This Account Already Acitvated');
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'Multiple of Rs. 500 allowed');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Minimum activation amount is Rs. 500');
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

    private function level_income($sponser_id, $activated_id, $package_income) {
        //$incomes = explode(',', $package_income);
        $incomes = array(0.04,0.03,0.02,0.01);
        foreach ($incomes as $key => $income) {
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status');
            if (!empty($sponser)) {
                if ($sponser['paid_status'] == 1) {
                    $LevelIncome = array(
                        'user_id' => $sponser['user_id'],
                        'amount' => $income*$package_income,
                        'type' => 'level_income',
                        'description' => 'Level Income from Activation of Member ' . $activated_id . ' At level ' . ($key + 1),
                    );
                    $this->User_model->add('tbl_income_wallet', $LevelIncome);
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }

    private function update_units($user_id , $sponser_id , $units){
        $sponser = $this->User_model->get_single_record('tbl_users',['user_id' => $sponser_id],'user_id, units');
        if(!empty($sponser)){
            $unitArr=[
                'user_id' => $sponser_id,
                'down_id' => $user_id,
                'units' => $units,
            ];
            $this->User_model->add('tbl_user_units', $unitArr);
            $this->User_model->update('tbl_users', array('user_id' => $sponser_id), ['units' => $sponser['units'] + $units]);
        }
    }
    public function FixDeposit() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                // pr($data);
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
                $this->form_validation->set_rules('duration', 'Duration', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_token_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    if (!empty($user)) {
                        if ($wallet['wallet_balance'] >= $data['amount']) {
                            // if ($user['paid_status'] == 0) {
                            $sendWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => - $data['amount'],
                                'type' => 'fix_deposit',
                                'remark' => 'Fix Deposit Deduction for ' . $user_id,
                            );
                            $this->User_model->add('tbl_token_wallet', $sendWallet);

                            $depositArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => $data['amount'],
                                'duration' => $data['duration'],
                            );
                            $this->User_model->add('tbl_fix_deposit', $depositArr);

                            $this->session->set_flashdata('message', 'Account Activated Successfully');
                            // } else {
                            //     $this->session->set_flashdata('message', 'This Account Already Acitvated');
                            // }
                        } else {
                            $this->session->set_flashdata('message', 'Insuffcient Balance');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid User ID');
                    }
                } else {
                    $this->session->set_flashdata('message', validation_errors());
                }
            }
            $response['token_wallet'] = $this->User_model->get_single_record('tbl_token_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
            $this->load->view('fix_deposit', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function pool_entry($user_id, $pool_level = 1, $pool_amount = 10) {
        $pool_upline = $this->User_model->get_single_record('tbl_pool', array('level1 <' => 3, 'pool_level' => $pool_level), 'id,user_id,level1');
        if (!empty($pool_upline)) {
            $poolArr = array(
                'user_id' => $user_id,
                'upline_id' => $pool_upline['user_id'],
                'pool_level' => $pool_level,
                'pool_amount' => $pool_amount
            );
            $this->User_model->add('tbl_pool', $poolArr);
            $this->level_income($pool_upline['user_id'], $user_id, ($pool_level * 10), $pool_level);
        } else {
            $poolArr = array(
                'user_id' => $user_id,
                'upline_id' => 'none',
                'pool_level' => $pool_level,
                'pool_amount' => $pool_amount
            );
            $this->User_model->add('tbl_pool', $poolArr);
        }
    }

    public function update_pool_count($upline_id, $pool, $level) {
        if ($level < 5) {
            $upline = $this->User_model->get_single_record('tbl_pool', array('user_id' => $upline_id, 'pool_level' => $pool_level), 'id,user_id,upline_id');
            if (!empty($upline)) {
                $this->User_model->update('tbl_pool', array('id' => $upline['id']), array('level' . $level => $pool_upline['level' . $level] + 1));
                $this->update_pool_count($upline_id, $pool, $level + 1);
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
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    //$package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                    if (!empty($user)) {
                        // pr($user,true);
                        if ($wallet['wallet_balance'] >= $data['amount']) {
                            if ($user['package_amount'] < $data['amount']) {
                                if($data['amount']%500 == 0){
                                    $sendWallet = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => -$data['amount'],
                                        'type' => 'account_activation',
                                        'remark' => 'Account Activation Deduction for ' . $user_id,
                                    );
                                    $this->User_model->add('tbl_wallet', $sendWallet);
                                    $topupData = array(
                                        'paid_status' => 1,
                                        'package_id' => 1, //$data['package_id'],
                                        'package_amount' => $user['package_amount'] + $data['amount'],
                                        'topup_date' => date('Y-m-d H:i:s'),
                                        //'capping' => $package['capping'],
                                    );
                                    $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                    // $this->User_model->update_directs($user['sponser_id']);
                                    $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs,paid_status');
                                    if($sponser['paid_status'] == 1){
                                        $DirectIncome = array(
                                            'user_id' => $user['sponser_id'],
                                            'amount' => $data['amount']*0.10,
                                            'type' => 'direct_income',
                                            'description' => 'Refferal Points from Activation of Member ' . $user_id,
                                        );
                                        $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                    }
                                    $this->level_income($sponser['sponser_id'], $user['user_id'], $data['amount']);
                                    // $DirectIncome = array(
                                    //     'user_id' => $user['sponser_id'],
                                    //     'amount' => $package['direct_income'],
                                    //     'type' => 'direct_income',
                                    //     'description' => 'Direct Income from Retopup of Member ' . $user_id,
                                    // );
                                    // $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                    //$this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'], $type = 'topup');
                                    $roiData = [
                                        'user_id' => $user['user_id'],
                                        'amount' => $data['amount'] * 2,
                                        'days' => 44,
                                        'roi_amount' => $data['amount']*0.04,
                                        'creditDate' => date('Y-m-d'),
                                    ];
                                    $this->User_model->add('tbl_roi', $roiData);
                                    // $roiArr = array(
                                    //     'user_id' => $user['user_id'],
                                    //     'amount' => ($package['price'] * $package['days']),
                                    //     'roi_amount' => $package['commision'],
                                    // );
                                    // $this->User_model->add('tbl_roi', $roiArr);
                                    $this->session->set_flashdata('message', 'Account upgraded Successfully');
                                }else{
                                    $this->session->set_flashdata('message', 'Only Multiple of 500 allowed');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'This Account Already Upgrade to this Amount');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Insuffcient Balance');
                        }
                        // }else{
                        //     $this->session->set_flashdata('message', 'Invalid User ID');
                        // }
                    }
                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            //$response['packages'] = $this->User_model->get_records('tbl_package', array('price > ' => $response['user']['package_amount']), '*');
            $this->load->view('upgrade_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function update_activate_users_business(){
        die;
        $users = $this->User_model->get_records('tbl_users',['paid_status' => 1],'user_id,package_id');
        foreach($users as $k => $user){
            $package =  $this->User_model->get_single_record('tbl_package', array('id' => $user['package_id']), '*');
            $this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'], $type = 'topup');
        }
    }
    function update_business($user_name = 'A915813', $downline_id = 'A915813', $level = 1, $business = '40', $type = 'topup') {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $c = 'leftPower';
                $c1 = 'leftBusiness';
            } else if ($user['position'] == 'R') {
                $c = 'rightPower';
                $c1 = 'rightBusiness';
            } else {
                return;
            }
            $this->User_model->update_business($c, $user['upline_id'], $business);
            $this->User_model->update_business($c1, $user['upline_id'], $business);
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

            if ($user['upline_id'] != '') {
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
                    if ($withdraw_amount >= 5) {
                        if ($balance['balance'] >= $withdraw_amount) {
                            // if($user['master_key'] == $master_key){
                            $DirectIncome = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => - $withdraw_amount,
                                'type' => 'income_transfer',
                                'description' => 'Sent ' . $withdraw_amount . ' to ' . $user_id,
                            );
                            $this->User_model->add('tbl_income_wallet', $DirectIncome);
                            $DirectIncome = array(
                                'user_id' => $user_id,
                                'amount' => $withdraw_amount*95/100,
                                'type' => 'income_transfer',
                                'description' => 'Got ' . $withdraw_amount . ' from ' . $this->session->userdata['user_id'],
                            );
                            $this->User_model->add('tbl_income_wallet', $DirectIncome);

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
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('income_transfer', $response);
        } else {

        }
    }

    public function eWalletTransfer() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Tnx Pin', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    $user_id = $this->input->post('user_id');
                    $transfer_user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
                    $directs = $this->User_model->get_single_record('tbl_users', ' sponser_id = "' . $this->session->userdata['user_id'] . '" AND paid_status > 0', 'count(id) as ids');
                    if ($withdraw_amount >= 100) {
                        if($directs['ids'] >= 4){
                        if ($balance['balance'] >= $withdraw_amount) {
                            if($user['master_key'] == $data['master_key']){
                            $DirectIncome = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => - $withdraw_amount,
                                'type' => 'income_transfer',
                                'description' => 'Transfer Income E-wallet',
                            );
                            $this->User_model->add('tbl_income_wallet', $DirectIncome);
                            $DirectIncome = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => $withdraw_amount*90/100,
                                'type' => 'income_transfer',
                                'remark' => 'Got ' . $withdraw_amount . ' from ' .'Wallet',
                            );
                            $this->User_model->add('tbl_wallet', $DirectIncome);

                            $this->session->set_flashdata('message', 'Income Transferred Successfully');
                            }else{
                                $this->session->set_flashdata('message', 'Invalid Master Key');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Insuffcient Balance');
                        }
                        } else {
                                $this->session->set_flashdata('message', 'Withdraw Four directs required!');
                            }
                    } else {
                        $this->session->set_flashdata('message', 'Minimum Transfer Amount is Rs. 100');
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['eWallet'] = 1;
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('income_transfer', $response);
        } else {

        }
    }

    public function eWalletTransfer2() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('otp', 'OTP', 'trim|required|numeric|xss_clean');

                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->input->post('user_id');
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' =>  $user_id), '*');
                    // $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                   // $transfer_user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $balance = $this->User_model->get_single_record('tbl_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
                    if(!empty($user)){
                       if(!empty($_SESSION['verification_otp'])){
                            if($data['otp'] == $_SESSION['verification_otp']){
                                if ($withdraw_amount >= 5) {
                                    if ($balance['balance'] >= $withdraw_amount) {

                                        if($data['user_id'] != $this->session->userdata['user_id']){
                                            $DirectIncome = array(
                                                'user_id' => $this->session->userdata['user_id'],
                                                'amount' => - $withdraw_amount,
                                                'type' => 'fund_transfer',
                                                'remark' => 'Sent ' . $withdraw_amount . ' to ' . $user_id,
                                            );
                                            $this->User_model->add('tbl_wallet', $DirectIncome);
                                            $DirectIncome = array(
                                                'user_id' => $user_id,
                                                'amount' => $withdraw_amount,
                                                'type' => 'fund_transfer',
                                                'remark' => 'Got ' . $withdraw_amount . ' from ' . $this->session->userdata['user_id'],
                                            );
                                            $this->User_model->add('tbl_wallet', $DirectIncome);

                                            $this->session->set_flashdata('message', '<span class="text-success">E-Wallet Transferred Successfully</span>');
                                            // }else{
                                            //     $this->session->set_flashdata('message', 'Invalid Master Key');
                                            // }
                                        }else{
                                            $this->session->set_flashdata('message', 'Only another user transfer');
                                        }    
                                    } else {
                                        $this->session->set_flashdata('message', 'Insuffcient Balance');
                                    }

                                } else {
                                    $this->session->set_flashdata('message', 'Minimum Transfer Amount is $5');
                                }
                        }else{
                            $this->session->set_flashdata('message', 'Invalid OTP!');
                          
                        }
                    }else{
                        $this->session->set_flashdata('message', 'OTP Expire!');
                        
                    }

                    }else{
                        $this->session->set_flashdata('message', 'Invalid User ID');
                    }    
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['eWallet'] = 1;
            $response['balance'] = $this->User_model->get_single_record('tbl_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('income_transfer2', $response);
        } else {

        }
    }

    public function DirectIncomeWithdraw() {
        if (is_logged_in()) {
            $response['title'] = "Direct Withdraw";
            $response['des'] = "Minimum Transfer Amount $200";
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['bank'] = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // die('this page is accessable');
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('credit_type', 'Credit in', 'trim|required|xss_clean');
                $this->form_validation->set_rules('trust_wallet_address', 'Address', 'trim|required|xss_clean');
                $this->form_validation->set_rules('otp', 'OTP', 'trim|required|numeric|xss_clean');
                if ($this->form_validation->run() != FALSE) {

                    // $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    // $winto_user_id = $this->input->post('user_id');
                    $master_key = $this->input->post('master_key');
                     $todayWithdraw = $this->User_model->get_single_record('tbl_withdraw', 'user_id = "' . $this->session->userdata['user_id'] . '" and date(created_at) = date(now())', '*');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
                    $perWithraw = $balance['balance']*20/100;
                    if(!empty($_SESSION['verification_otp'])){
                        if($data['otp'] == $_SESSION['verification_otp']){
                            if(empty($todayWithdraw) && $user['withdraw_status'] == 0){
        	                    if ($withdraw_amount >= 200) {
                                    // if($response['user']['directs'] >= 4){
        	                    	// if ($withdraw_amount <= $perWithraw) {
        	                        // if ($withdraw_amount % 100 == 0) {
        	                            if ($balance['balance'] >= $withdraw_amount) {
        	                                if ($user['master_key'] == $master_key) {
        	                                    // if($kyc_status['kyc_status'] == 2){
        	                                    $DirectIncome = array(
        	                                        'user_id' => $this->session->userdata['user_id'],
        	                                        'amount' => - $withdraw_amount,
        	                                        'type' => 'direct_income_withdraw',
        	                                        'description' => 'Withdrawal Amount ',
        	                                    );
        	                                    $this->User_model->add('tbl_income_wallet', $DirectIncome);
        	                                    if ($data['pin_transfer'] == 0) {
        	                                        $withdrawArr = array(
        	                                            'user_id' => $this->session->userdata['user_id'],
        	                                            'amount' => $withdraw_amount,
        	                                            'type' => 'direct_income',
        	                                            'description' => 'Direct Income Withdraw',
        	                                            'tds' => $withdraw_amount * 0 / 100,
        	                                            'admin_charges' => $withdraw_amount * 10 / 100,
        	                                            'fund_conversion' => 0,
        	                                            'payable_amount' => $withdraw_amount - ($withdraw_amount * 10 / 100),
        	                                            'trx' => $kyc_status['tron'],
        	                                            'credit_type' => '',//$data['credit_type'],
        	                                            'trust_wallet_address' => $data['trust_wallet_address'],
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
        	                                            'amount' => $withdraw_amount * 90 / 100,
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
        	                            } else {
        	                                $this->session->set_flashdata('message', 'Insuffcient Balance');
        	                            }
        	                        // } else {
        	                        //     $this->session->set_flashdata('message', 'Withdraw Amount is multiple of $ 100');
        	                        // }
        	                    // } else {
        	                    //     $this->session->set_flashdata('message', 'You can withdraw only 20% of your avaliable income!');
        	                    // }
                                    // // } else {
                                    // //     $this->session->set_flashdata('message', 'Total 4 Directs required for withdraw!');
                                    // }
        	                    } else {
        	                        $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is $200');
        	                    }
                        	} else {
                                $this->session->set_flashdata('message', 'Withdraw Amount Once a day, Please try tomorrow');
                            }
                        }else{
                            $this->session->set_flashdata('message', 'Invalid OTP!');
                          
                        }
                    }else{
                        $this->session->set_flashdata('message', 'OTP Expire!');
                        
                    }

                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('direct_income_withdraw', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function DirectAirdropIncomeWithdraw() {
        //die('this page is accessable');
        if (is_logged_in()) {
            $response['title'] = "Airdrop Withdrawal";
            $response['des'] = "Minimum Transfer Airdrop 700";
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                $this->form_validation->set_rules('trust_wallet', 'Trust Wallet Address', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    // $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    // $winto_user_id = $this->input->post('user_id');
                    $master_key = $this->input->post('master_key');
                    $balance = $this->User_model->get_single_record('tbl_coin_withdrawable', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(coin),0) as balance');
                    if ($withdraw_amount >= 700) {
                    //     if ($withdraw_amount % 10 == 0) {
                            if ($balance['balance'] >= $withdraw_amount) {
                                if ($user['master_key'] == $master_key) {
                                    if ($user['paid_status'] > 0){
                                    // if($kyc_status['kyc_status'] == 2){
                                    $DirectIncome = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'coin' => - $withdraw_amount,
                                        'type' => 'direct_income_withdraw',
                                        'description' => 'Withdrawal Amount ',
                                    );
                                    $this->User_model->add('tbl_coin_withdrawable', $DirectIncome);
                                    // if ($data['pin_transfer'] == 0) {
                                        $withdrawArr = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => $withdraw_amount,
                                            'type' => 'direct_income',
                                            'description' => 'Airdrop Income Withdraw',
                                            'tds' => $withdraw_amount * 0 / 100,
                                            'admin_charges' => $withdraw_amount * 10 / 100,
                                            'fund_conversion' => 0,
                                            'payable_amount' => $withdraw_amount - ($withdraw_amount * 10 / 100),
                                            'trx' => $kyc_status['tron'],
                                            'credit_type' => 'Trust Wallet',
                                            'trust_wallet_address' => $data['trust_wallet'],
                                        );
                                        $this->User_model->add('tbl_withdrawAirDrop', $withdrawArr);
                                    // } else {
                                    //     // $fund_converstion = $withdraw_amount * 45 /100;
                                    //     // $withdrawArr['user_id'] = $this->session->userdata['user_id'];
                                    //     // $withdrawArr['type'] = 'direct_income' ;
                                    //     // $withdrawArr['amount'] = $withdraw_amount;
                                    //     // $withdrawArr['admin_charges'] = $withdraw_amount * 10 /100;
                                    //     // $withdrawArr['fund_conversion'] = $withdraw_amount * 45 /100;
                                    //     // $withdrawArr['tds'] = $withdrawArr['fund_conversion'] * 5 /100;
                                    //     // $withdrawArr['payable_amount'] = $withdrawArr['fund_conversion'] - $withdrawArr['tds'];
                                    //     // $this->User_model->add('tbl_withdraw', $withdrawArr);
                                    //     $walletArr = array(
                                    //         'user_id' => $this->session->userdata['user_id'],
                                    //         'amount' => $withdraw_amount * 90 / 100,
                                    //         'type' => 'direct_income_withdraw',
                                    //         'remark' => 'fund generated from direct income withdraw',
                                    //         'sender_id' => $this->session->userdata['user_id'],
                                    //     );
                                    //     $this->User_model->add('tbl_wallet', $walletArr);
                                    // }
                                    $this->session->set_flashdata('message', 'Withdraw Requested     Successfully');
                                    // }else{
                                    //     $this->session->set_flashdata('message', 'Please Complete your Kyc before withdrawal amount');
                                    // }
                                    } else {
                                        $this->session->set_flashdata('message', 'Please Activate Account!');
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'Invalid Master Key');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Insuffcient Balance');
                            }
                    //     } else {
                    //         $this->session->set_flashdata('message', 'Withdraw Amount is multiple of 10');
                    //     }
                    } else {
                        $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is 700');
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_coin_withdrawable', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(coin),0) as balance');

            $this->load->view('DirectAirdropIncomeWithdraw', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }



    public function generateOtp()
    {
        if (is_logged_in()) {
            if ($this->input->is_ajax_request()) {
                if ($this->input->server('REQUEST_METHOD') == 'GET') {
                    $user = $this->User_model->get_single_record('tbl_users', ['user_id' => $this->session->userdata['user_id']], '*');
                    $_SESSION['verification_otp'] = rand(100000, 999999);
                    $this->session->mark_as_temp('verification_otp', 300);
                    $message = 'You OTP is '.$this->session->userdata['verification_otp'].' (One Time Password), this otp expire in 2 mintues!';
                    $sms_text = 'Dear User, Your OTP is 206880 Never share this OTP with anyone, this OTP expire in two minutes. More Info: https://mycrowdpay.com/ From mlmsig';
                        notify_sms($user['user_id'], $sms_text, $entity_id ='1201161518339990262', $temp_id ='1207161730102098562');


                    $data['info']['title'] = 'Withdrawal Verification OTP';
                    $data['info']['name'] = $user['name'];
                    $data['info']['email'] = $user['email'];
                    // $data['info']['description'] = 'Please never share this OTP (one time password) With Anyone!';
                    // $data['info']['message'] = $message;
                   
                    // $curlResponse = mail_from_sendgrid($data);
                    // if($message && $curlResponse === true || $sms['success']){
                    if($message){
                        $response['success'] = 1;
                        $response['message'] = 'OTP send on registered mobile no.';
                    }else{
                        $response['success'] = 0;
                        $response['message'] = 'Please try again later!';
                    }
                }
            }else{
                $response['status'] = 0;
            }

            echo json_encode($response);
        } else {
            redirect('Dashboard/User/login');
        }
    }



    public function matchingWithdraw() {
        //die('this page is accessable');
        if (is_logged_in()) {
            $response['title'] = "Matching Withdraw";
            $response['des'] = "Minimum Transfer Amount $200";
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                $this->form_validation->set_rules('credit_type', 'Credit in', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    // $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    // $winto_user_id = $this->input->post('user_id');
                    $master_key = $this->input->post('master_key');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" AND (type = "matching_bonus" OR type = "direct_sponsor_income" OR type ="matching_withdraw")', 'ifnull(sum(amount),0) as balance');
                    if ($withdraw_amount >= 200) {
                        if ($withdraw_amount % 10 == 0) {
                            if ($balance['balance'] >= $withdraw_amount) {
                                if ($user['master_key'] == $master_key) {
                                    // if($kyc_status['kyc_status'] == 2){
                                    $DirectIncome = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => - $withdraw_amount,
                                        'type' => 'matching_withdraw',
                                        'description' => 'Withdrawal Amount ',
                                    );
                                    $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                    if ($data['pin_transfer'] == 0) {
                                        $withdrawArr = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => $withdraw_amount,
                                            'type' => 'matching_withdraw',
                                            'tds' => $withdraw_amount * 0 / 100,
                                            'admin_charges' => $withdraw_amount * 10 / 100,
                                            'fund_conversion' => 0,
                                            'payable_amount' => $withdraw_amount - ($withdraw_amount * 10 / 100),
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
                                            'amount' => $withdraw_amount * 90 / 100,
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
                            } else {
                                $this->session->set_flashdata('message', 'Insuffcient Balance');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Withdraw Amount is multiple of $10');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is $200');
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" AND (type = "matching_bonus" OR type = "direct_sponsor_income" OR type ="matching_withdraw")', 'ifnull(sum(amount),0) as balance');
            $this->load->view('direct_income_withdraw', $response);
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

    public function forgot_password() {
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $user = $this->User_model->get_single_record('tbl_users', ' user_id = "' . trim(addslashes($data['user_id'])) . '" or email = "' . trim(addslashes($data['user_id'])) . '"', 'name,user_id,email,password,master_key,phone');
            if (!empty($user)) {
                $message = "Dear " . $user['name'] . ' your User ID ' . $user['user_id'] . '  password for Your Accountt is ' . $user['password'].' Transaction Password '.$user['master_key'];
                $response['message'] = 'Account Detail Sent on Your Email Please check';
               // $this->send_email($user['email'], 'Security Alert', $message);
                $this->sendEmail($user['name'], $user['email'], $message);
                // notify_user($user['user_id'] , $message);
                $this->session->set_flashdata('message', 'Password Sent On Your Registered Mail');
            } else {
                $this->session->set_flashdata('message', 'Invalid User ID');
            }
        }
        $this->load->view('forgot_password', $response);
    }


    private function sendEmail($name = '', $email='', $msg = '')
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.mailjet.com/v3.1/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "Messages":[
                        {
                                "From": {
                                        "Email": "info@artisticuniversal.com",
                                        "Name": "Artistic Universal"
                                },
                                "To": [
                                        {
                                                "Email": "'.$email.'",
                                                "Name": "'.$name.'"
                                        }
                                ],
                                "Subject": "Security Alert",
                                "TextPart": "",
                                "HTMLPart": "<center><img src=\'https://artisticuniversal.com/uploads/logo.png\' style=\'width:200px;\'><br><br>'.$msg.' <br><br> https://artisticuniversal.com <br><br>Never share your login Credential with anyone.</center>"
                        }
                ]

        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic ZGM0ZmEzMjU5NTVjZDQ5MTg2NWJkNzkyODZjYWY2NDY6MDhlYjk3YmVkMTNhNDFmMWU1MDA0OGNkNWI2Yzg2ZDU='
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }

    public function send_email($email, $subject, $message) {
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('email');
        $this->email->from('info@artisticuniversal.com');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }


    public function generateOtp_()
    {
        if (is_logged_in()) {
            if ($this->input->is_ajax_request()) {
                if ($this->input->server('REQUEST_METHOD') == 'GET') {
                    $user = $this->User_model->get_single_record('tbl_users', ['user_id' => $this->session->userdata['user_id']], '*');
                    $_SESSION['withdraw_otp'] = rand(100000, 999999);
                    $this->session->mark_as_temp('withdraw_otp', 300);
                    $message = 'You OTP is '.$this->session->userdata['withdraw_otp'].' (One Time Password), this otp expire in 2 mintues!';
                    $data['info']['title'] = 'Withdraw Verification OTP';
                    $data['info']['name'] = $user['name'];
                    $data['info']['email'] = $user['email'];
                    $data['info']['description'] = 'Please never share this OTP (one time password) With Anyone!';
                    $data['info']['message'] = $message;
                    $curlResponse = send_email($data);
                    if($message && $curlResponse['status'] == 'success'){
                        $response['success'] = 1;
                        $response['message'] = 'OTP send on registered email id!';
                        // $response['otp'] = $_SESSION['verification_otp'];
                        
                    }else{
                        $response['success'] = 0;
                        $response['message'] = 'Please try again later!';
                    }
                }
            }else{
                $response['status'] = 0;
            }

            echo json_encode($response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    // public function trx_history(){
    //     if(is_logged_in()){
    //         $response['records'] = $this->User_model->get_records('tbl_block_address',['user_id' => $this->session
    //             ->userdata['user_id']],'*');
    //         $this->load->view('trx_history',$response);

    //     }
            // else{
        //     redirect('Dashboard/User/login);
        // }
    // }

}
