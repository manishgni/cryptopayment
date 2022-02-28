<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PoolActivation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
        $this->exceptionCase = '';
    }

     public function index() {
        if (is_logged_in()) {
            // die('here');
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                        // die('here');
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
                                        'topup_date' => date('Y-m-d H:i:s'),
                                        'capping' => $package['capping']
                                    );
                                    $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                    $this->User_model->update_directs($user['sponser_id']);
                                    $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,paid_status,directs');
                                    
                                    if($sponser['paid_status'] == 1){
                                        $DirectIncome = array(
                                            'user_id' => $user['sponser_id'],
                                            'amount' => $package['price']*0.15,
                                            'type' => 'direct_income',
                                            'description' => 'Direct Income from Activation of Member ' . $user_id,
                                        );
                                        $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                    }

                                    //$this->royaltyAchiever($user['sponser_id']);
                                    $this->level_income($sponser['sponser_id'], $user['user_id'], $package['price']);
                                    // $this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['price'], $type = 'topup');
                                    //if($sponser['directs'] >= 3){
                                        // $checkPool = $this->User_model->get_single_record($package['products'],['user_id' => $user['user_id']],'*');
                                        // if(empty($checkPool['user_id'])){
                                            //$this->individualPoolEntry($user['user_id'],'tbl_pool1');
                                            $this->globlePoolEntry($user['user_id'],$package['products'],1);
                                            // $debit = [
                                            //     'user_id' => $user['sponser_id'],
                                            //     'amount' => -10,
                                            //     'type' => 'club_upgradation',
                                            //     'description' => 'Club Upgrdation Deduction',
                                            // ];
                                            // $this->User_model->add('tbl_income_wallet',$debit);
                                        //}
                                    //}
                                    $this->session->set_flashdata('message', '<h3 class="text-success">Account Activated Successfully </h3>');
                            } else {
                                $this->session->set_flashdata('message', '<h3 class="text-danger">This Account Already Acitvated </h3>');
                            }
                        } else {
                            $this->session->set_flashdata('message', '<h3 class="text-danger">Insuffcient Balance </h3>');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<h3 class="text-danger">Invalid User ID </h3>');
                    }
                }else{
                        $this->session->set_flashdata('message', validation_errors());

                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package',"id != '' order by id asc limit 1", '*');
            $this->load->view('activate_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function activationCron(){
        die('activation cron');
        $users = $this->User_model->get_records('tbl_users',['paid_status' => 0],'user_id');
        $package = $this->User_model->get_single_record('tbl_package', array('id' => 1), '*');
        foreach($users as $key => $user){
            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), '*');
            $topupData = array(
                'paid_status' => 1,
                'package_id' => $package['id'],
                'package_amount' => $package['price'],
                'topup_date' => date('Y-m-d H:i:s'),
                'capping' => $package['capping']
            );
            $this->User_model->update('tbl_users', array('user_id' => $user['user_id']), $topupData);
            $this->User_model->update_directs($user['sponser_id']);
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,paid_status,directs');
            
            if($sponser['paid_status'] == 1){
                $DirectIncome = array(
                    'user_id' => $user['sponser_id'],
                    'amount' => $package['price']*0.15,
                    'type' => 'direct_income',
                    'description' => 'Direct Income from Activation of Member ' . $user['user_id'],
                );
                $this->User_model->add('tbl_income_wallet', $DirectIncome);
            }
            $this->level_income($sponser['sponser_id'], $user['user_id'], $package['price']);
            $this->globlePoolEntry($user['user_id'],$package['products'],1);
        }
    }

    private function royaltyAchiever($user_id = ''){
        if (is_logged_in()) {
            $userDetail = $this->User_model->get_single_record('tbl_users',['user_id' => $user_id],'directs,topup_date,royalty_status');
            $date1 = date('Y-m-d H:i:s');
            $date2 = date('Y-m-d H:i:s',strtotime($userDetail['topup_date'].'+10 days'));
            $diff1 = strtotime($date2) - strtotime($date1); 
            if($diff1 > 0){
                if($userDetail['directs'] >= 15 && $userDetail['royalty_status'] == 0){
                    $this->User_model->update('tbl_users',['user_id' => $user_id],['royalty_status' => 1]);
                }
            }
        }
    }

    private function level_income($sponser_id, $activated_id, $package_income) {
        //$incomes = explode(',', $package_income);
        $incomes = array(0.07,0.05,0.04,0.04,0.03,0.03,0.03,0.03,0.03);
        foreach ($incomes as $key => $income) {
            $direct = $key+1;
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status,package_amount,directs');
            if (!empty($sponser)) {
                if($sponser['package_amount'] >= $package_income){
                    $level_income = $package_income*$income;
                    if ($sponser['paid_status'] == 1) {
                        if($sponser['directs'] >= $direct){
                            $LevelIncome = array(
                                'user_id' => $sponser['user_id'],
                                'amount' => $level_income,
                                'type' => 'level_income',
                                'description' => 'Level Income from Activation of Member ' . $activated_id . ' At level ' . ($key + 1),
                            );
                            $this->User_model->add('tbl_income_wallet', $LevelIncome);
                        }
                    }
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }

    private function update_business($user_name = 'A915813', $downline_id = 'A915813', $level = 1, $business = '40', $type = 'topup') {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $c = 'leftPower';
            } else if ($user['position'] == 'R') {
                $c = 'rightPower';
            } else {
                return;
            }
            $this->User_model->update_business($c, $user['upline_id'], $business);
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

    protected function individualPoolEntry($user_id,$table){
        if($table == 'tbl_pool1'){ $org = 1; $amount = 100;}
        elseif($table == 'tbl_pool2'){ $org = 2; $amount = 200;}
        elseif($table == 'tbl_pool3'){ $org = 3; $amount = 400;}
        elseif($table == 'tbl_pool4'){ $org = 4; $amount = 800;}
        elseif($table == 'tbl_pool5'){ $org = 5; $amount = 1600;}
        elseif($table == 'tbl_pool6'){ $org = 6; $amount = 3200;}
        elseif($table == 'tbl_pool7'){ $org = 7; $amount = 6400;}
        elseif($table == 'tbl_pool8'){ $org = 7; $amount = 12800;}
        elseif($table == 'tbl_pool9'){ $org = 7; $amount = 25600;}
        elseif($table == 'tbl_pool10'){ $org = 7; $amount = 51200;}
        $sponsorID = $this->User_model->get_single_record('tbl_users',['user_id' => $user_id],'sponser_id');
        $pool_upline = $this->User_model->get_single_record($table, array('user_id' => $sponsorID['sponser_id'],'down_count <' => 3), 'user_id');
        //pr($pool_upline,true);
        if($pool_upline['user_id'] == ''){
            $uplineID = $this->get_pool_upline($sponsorID['sponser_id'],$table,$org);
        }else{
            $uplineID = $pool_upline['user_id'];
        }
        $userinfo = $this->User_model->get_single_record($table,['user_id' => $uplineID],'down_count');
        $poolArr = [
            'user_id' => $user_id,
            'upline_id' => $uplineID,
        ];
        //pr($poolArr,true);
        $this->User_model->add($table, $poolArr);
        $this->User_model->update($table, array('user_id' => $uplineID),['down_count' => ($userinfo['down_count'] + 1)]);
        $this->updateTeam($user_id,$table);
        $this->update_pool_downline($uplineID,$user_id,$level = 1,$table,$org);
        $this->poolIncome($table,$user_id,$user_id,$org,3,1,$amount);
    }

    protected function updateTeam($user_id,$table,$org,$pool_id){
        $uplineID = $this->User_model->get_single_record($table,array('user_id' => $user_id,'pool_id' => $pool_id,'org' => $org),'upline_id');
        if(!empty($uplineID['upline_id'])){
            $team = $this->User_model->get_single_record($table,array('user_id' => $uplineID['upline_id'],'org' => $org,'id' => $pool_id),'id,pool_id,team');
            $newTeam = $team['team'] + 1;
            $this->User_model->update($table, array('user_id' => $uplineID['upline_id'],'org' => $org,'id' => $pool_id),array('team' => $newTeam));
            $this->updateTeam($uplineID['upline_id'],$table,$org,$team['pool_id']);
        }
    }

    public function update_pool_downline($upline_id,$user_id,$level,$table,$org){
        $user = $this->User_model->get_single_record($table, array('user_id' => $upline_id), $select = 'user_id,upline_id');
        if(!empty($user['user_id'])){
            $pool_downArr = [
                'user_id' => $user['user_id'],
                'downline_id' => $user_id,
                'level' => $level,
                'org' => $org,
            ];
            $this->User_model->add('tbl_pool_downline', $pool_downArr);
            $this->update_pool_downline($user['upline_id'],$user_id,$level + 1,$table,$org);
        }
    }

    private function poolIncome($table,$user_id,$linkedID,$org,$team,$level,$amount){
        $upline = $this->User_model->get_single_record($table,['user_id' => $user_id],['upline_id']);

        if(!empty($upline['upline_id'])){
            $checkTeam = $this->User_model->get_single_record('tbl_pool_downline',['user_id' => $upline['upline_id'],'level' => $level,'org' => $org],'count(id) as team');
            if($checkTeam['team'] == $team){
                $creditSIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => $amount,
                    'type' => 'working_pool',
                    'description' => 'Working Pool Income from User '.$linkedID,
                ];
                $this->User_model->add('tbl_income_wallet',$creditSIncome);

                $debitIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => -$amount,
                    'type' => 'upgradation_deduction',
                    'description' => 'Working Pool Income from User '.$linkedID,
                ];
                $this->User_model->add('tbl_income_wallet',$debitIncome);
                
            }else{
                $creditIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => $amount,
                    'type' => 'working_pool',
                    'description' => 'Working Pool upgradation deduction',
                ];
                $this->User_model->add('tbl_income_wallet',$creditIncome);
            }
            $level += 1;
            $team *= 3;
            $this->poolIncome($table,$upline['upline_id'],$linkedID,$org,$team,$level,$amount);
        }  
    }

    // public function test(){
    //    $this->globlePoolEntry('11111','tbl_pool2',1); 
    // }

    protected function globlePoolEntry($user_id,$table,$org){
        $pool_upline = $this->User_model->get_single_record($table, array('down_count <' => 3,'org' => $org), 'id,user_id,pool_id,down_count');
        if(!empty($pool_upline)){
            $poolArr =  array(
                'pool_id' => $pool_upline['id'],
                'user_id' => $user_id,
                'upline_id' => $pool_upline['user_id'],
                'org' => $org,
            );
            $this->User_model->add($table, $poolArr);
            $this->User_model->update($table, array('id' => $pool_upline['id']),array('down_count' => $pool_upline['down_count'] + 1));
            $this->updateTeam($user_id,$table,$org,$poolArr['pool_id']);
            $this->poolIncome2($table,$user_id,$user_id,$org,$poolArr['pool_id']);
        }else{
            $poolArr =  array(
                'pool_id' => '',
                'user_id' => $user_id,
                'upline_id' => '',
                'org' => $org,
            );
            $this->User_model->add($table, $poolArr);
            $this->updateTeam($user_id,$table,$org,$poolArr['pool_id']);
            $this->poolIncome2($table,$user_id,$user_id,$org,$poolArr['pool_id']);
        }
    }

    private function poolIncome2($table,$user_id,$linkedID,$org,$pool_id){
        $pool = $this->poolChart($table);
        $poolData = $pool[$org];
        $upline = $this->User_model->get_single_record($table,['user_id' => $user_id,'org' => $org,'pool_id' => $pool_id],['upline_id']);
        if(!empty($upline['upline_id'])){
            $checkTeam = $this->User_model->get_single_record($table,['user_id' => $upline['upline_id'],'id' => $pool_id],'id,team');
            if($checkTeam['team'] == 3):
                $creditIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => $poolData['income'],
                    'type' => 'pool_income',
                    'description' => 'Pool Income From Level '.$org,
                ];
                $this->User_model->add('tbl_income_wallet',$creditIncome);
                $debitIncome = [
                    'user_id' => $upline['upline_id'],
                    'amount' => -$poolData['deduction'],
                    'type' => 'upgrade_deduction',
                    'description' => 'Pool Upgrade Deduction For level '.$poolData['org'],
                ];
                $this->User_model->add('tbl_income_wallet',$debitIncome);
                if($poolData['org'] < 4 && $poolData['table'] != ' ' && $poolData['table'] == $table){
                    $this->globlePoolEntry($upline['upline_id'],$poolData['table'],$poolData['org']);
                    
                }
                if($poolData['org'] == 4 && $poolData['table'] != ' ' && $poolData['table'] != $table){
                    $this->globlePoolEntry($upline['upline_id'],$poolData['table'],1);
                    $this->secondLevelIncome($upline['upline_id'],$upline['upline_id'],$poolData['levelIncome']);
                    $creditUniversal = [
                        'user_id' => $upline['upline_id'],
                        'amount' => $poolData['levelIncome'],
                        'type' => 'universal_pool_income',
                        'description' => 'Universal Pool Income From Pool '.$poolData['table'].' at level '.$poolData['org'],
                    ];
                    $this->User_model->add('tbl_universal_income',$creditUniversal);
                    for($i=1;$i<=3;$i++){
                        $this->regenerateID($upline['upline_id'],$table);
                    }
                }
            endif;
        } 
    }

    private function regenerateID($user_id,$table){
        $this->globlePoolEntry($user_id,$table,1);
    }

    private function secondLevelIncome($user_id,$linkedID,$amount){
        $incomes = array(0.14,0.1,0.08,0.08,0.06,0.06,0.06,0.06,0.06);
        foreach ($incomes as $key => $income) {
            //$direct = $key+1;
            $sponser_id = $this->User_model->get_single_record('tbl_users',['user_id' => $user_id],'sponser_id');
            if (!empty($sponser_id['sponser_id'])) {
                $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id['sponser_id']), 'id,user_id,sponser_id,paid_status,package_amount,directs');
                //if($sponser['package_amount'] >= $package_income){
                    $level_income = $amount*$income;
                    if ($sponser['paid_status'] == 1) {
                        //if($sponser['directs'] >= $direct){
                            $LevelIncome = array(
                                'user_id' => $sponser['user_id'],
                                'amount' => $level_income,
                                'type' => 'level_income',
                                'description' => 'Level Income from Activation of Member ' . $activated_id . ' At level ' . ($key + 1),
                            );
                            $this->User_model->add('tbl_income_wallet', $LevelIncome);
                        //}
                    }
                //}
                $sponser_id = $sponser['user_id'];
            }
        }
    }

    private function poolChart($table){
        $poolArr = [
            'tbl_pool' => [
                1 => ['income' => 30,'deduction' => 20,'org' => '2','table' => 'tbl_pool','levelIncome' => ''],
                2 => ['income' => 60,'deduction' => 40,'org' => '3','table' => 'tbl_pool','levelIncome' => ''],
                3 => ['income' => 120,'deduction' => 50,'org' => '4','table' => 'tbl_pool2','levelIncome' => '10'],
            ],
            'tbl_pool2' => [
                1 => ['income' => 75,'deduction' => 50,'org' => '2','table' => 'tbl_pool2','levelIncome' => ''],
                2 => ['income' => 150,'deduction' => 100,'org' => '3','table' => 'tbl_pool2','levelIncome' => ''],
                3 => ['income' => 300,'deduction' => 125,'org' => '4','table' => 'tbl_pool3','levelIncome' => '25'],
            ],
            'tbl_pool3' => [
                1 => ['income' => 180,'deduction' => 120,'org' => '2','table' => 'tbl_pool3','levelIncome' => ''],
                2 => ['income' => 360,'deduction' => 240,'org' => '3','table' => 'tbl_pool3','levelIncome' => ''],
                3 => ['income' => 720,'deduction' => 300,'org' => '4','table' => 'tbl_pool4','levelIncome' => '60'],
            ],
            'tbl_pool4' => [
                1 => ['income' => 360,'deduction' => 240,'org' => '2','table' => 'tbl_pool4','levelIncome' => ''],
                2 => ['income' => 720,'deduction' => 480,'org' => '3','table' => 'tbl_pool4','levelIncome' => ''],
                3 => ['income' => 1440,'deduction' => 600,'org' => '4','table' => 'tbl_pool5','levelIncome' => '120'],
            ],'
            tbl_pool5' => [
                1 => ['income' => 690,'deduction' => 460,'org' => '2','table' => 'tbl_pool5','levelIncome' => ''],
                2 => ['income' => 1380,'deduction' => 920,'org' => '3','table' => 'tbl_pool5','levelIncome' => ''],
                3 => ['income' => 2760,'deduction' => 1150,'org' => '4','table' => 'tbl_pool6','levelIncome' => '230'],
            ],
            'tbl_pool6' => [
                1 => ['income' => 180,'deduction' => 120,'org' => '2','table' => 'tbl_pool6','levelIncome' => ''],
                2 => ['income' => 360,'deduction' => 240,'org' => '3','table' => 'tbl_pool6','levelIncome' => ''],
                3 => ['income' => 720,'deduction' => 300,'org' => '4','table' => 'tbl_pool7','levelIncome' => '550'],
            ],
            'tbl_pool7' => [
                1 => ['income' => 1650,'deduction' => 1150,'org' => '2','table' => 'tbl_pool7','levelIncome' => ''],
                2 => ['income' => 3300,'deduction' => 2200,'org' => '3','table' => 'tbl_pool7','levelIncome' => ''],
                3 => ['income' => 6600,'deduction' => 2750,'org' => '4','table' => 'tbl_pool8','levelIncome' => '1225'],
            ],
            'tbl_pool8' => [
                1 => ['income' => 3750,'deduction' => 2500,'org' => '2','table' => 'tbl_pool8','levelIncome' => ''],
                2 => ['income' => 7500,'deduction' => 5000,'org' => '3','table' => 'tbl_pool8','levelIncome' => ''],
                3 => ['income' => 15000,'deduction' => 6200,'org' => '4','table' => 'tbl_pool9','levelIncome' => '2400'],
            ],
            'tbl_pool9' => [
                1 => ['income' => 7200,'deduction' => 4800,'org' => '2','table' => 'tbl_pool9','levelIncome' => ''],
                2 => ['income' => 14400,'deduction' => 9600,'org' => '3','table' => 'tbl_pool9','levelIncome' => ''],
                3 => ['income' => 28800,'deduction' => 12000,'org' => '4','table' => 'tbl_pool10','levelIncome' => '3750'],
            ],
            'tbl_pool10' => [
                1 => ['income' => 11250,'deduction' => 7500,'org' => '2','table' => 'tbl_pool10','levelIncome' => ''],
                2 => ['income' => 22500,'deduction' => 15000,'org' => '3','table' => 'tbl_pool10','levelIncome' => ''],
                3 => ['income' => 45000,'deduction' => 18750,'org' => '4','table' => '','levelIncome' => '5000'],
            ],
        ];

        return $poolArr[$table];
    }

    private function getSponsor($user_id,$table){
        $users = $this->User_model->get_records('tbl_sponser_count',"downline_id = '".$user_id."' and user_id != 'none' ORDER BY level ASC",'user_id');
        foreach($users as $user){
            $check = $this->User_model->get_single_record($table,['user_id' => $user['user_id']],'user_id');
            if(!empty($check['user_id'])){
                $check2 = $this->User_model->get_single_record($table,['user_id' => $user['user_id'],'down_count <' => 3],'user_id');
                $this->exceptionCase = $check2['user_id'];
                if(!empty($check2['user_id'])){
                    return $check2['user_id'];
                    break;
                }
            }
        }
    }

    private function get_pool_upline($sponser_id,$table,$org){
        $users = $this->User_model->get_records('tbl_pool_downline',"user_id = '".$sponser_id."' and org = '".$org."' ORDER BY level,created_at ASC",'downline_id');
        if(!empty($users)){
            foreach($users as $key => $user){
                $check = $this->User_model->get_single_record($table,['user_id' => $user['downline_id'],'down_count <' => 3],'user_id');
                if(!empty($check['user_id'])){
                    return $check['user_id'];
                    break;
                }
            }
        }else{
            $sponsorID = $this->getSponsor($sponser_id,$table);
            if(!empty($sponsorID)){
                return $sponsorID;
            }else{
                return $this->get_pool_upline($this->exceptionCase,$table,$org);
            }
        }
    }

    public function UpgradeAccount() {
        if (is_logged_in()) {
            $response['packages'] = $this->config->item('packages');

            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $amount = $response['packages'][$data['package']];
                $this->form_validation->set_rules('package','packages','required');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    //$package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                    $poolID = $this->User_model->get_single_record($amount['product'],['user_id' => $this->session->userdata['user_id']],'user_id');
                    if (!empty($user)) {
                        if ($wallet['wallet_balance'] >= $amount['packageAmount']) {
                            if (empty($poolID['user_id'])) {
                                    $sendWallet = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => -$amount['packageAmount'],
                                        'type' => 'account_activation',
                                        'remark' => 'Account Upgrade Deduction for ' . $user_id,
                                    );
                                   // $this->User_model->add('tbl_wallet', $sendWallet);
                                    
                                    $oldTopupdata = [];
                                    if(!empty($user['upgradeDetails'])){
                                        $oldTopupdata = json_decode($user['upgradeDetails'],true);
                                    }
                                    $topupData = array(
                                        'upgrade_id' => $amount['packageId'],
                                        'upgrade_amount' => $amount['packageAmount'],
                                    );
                                    $josnData = array(
                                        count($oldTopupdata) => ['upgrade_id' => $amount['packageId'],'upgrade_amount' => $amount['packageAmount']],
                                    );
                                    $newData = array_merge($oldTopupdata,$josnData);
                                    $topupData['upgradeDetails'] =  json_encode($newData);
                                    // pr($topupData);
                                    // die;
                                    $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                    $this->individualPoolEntry($user['user_id'],$amount['product']);
                                    // $this->User_model->update_directs($user['sponser_id']);
                                    // $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs,paid_status');
                                    // if($sponser['paid_status'] == 1){
                                    //     $DirectIncome = array(
                                    //         'user_id' => $user['sponser_id'],
                                    //         'amount' => $data['amount']*0.10,
                                    //         'type' => 'direct_income',
                                    //         'description' => 'Refferal Points from Activation of Member ' . $user_id,
                                    //     );
                                    //     $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                    // }
                                    // $this->level_income($sponser['sponser_id'], $user['user_id'], $data['amount']);
                                    // $DirectIncome = array(
                                    //     'user_id' => $user['sponser_id'],
                                    //     'amount' => $package['direct_income'],
                                    //     'type' => 'direct_income',
                                    //     'description' => 'Direct Income from Retopup of Member ' . $user_id,
                                    // );
                                    // $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                    //$this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'], $type = 'topup');
                                    // $roiData = [
                                    //     'user_id' => $user['user_id'],
                                    //     'amount' => $data['amount'] * 2,
                                    //     'days' => 44,
                                    //     'roi_amount' => $data['amount']*0.04,
                                    //     'creditDate' => date('Y-m-d'),
                                    // ];
                                    // $this->User_model->add('tbl_roi', $roiData);
                                    // $roiArr = array(
                                    //     'user_id' => $user['user_id'],
                                    //     'amount' => ($package['price'] * $package['days']),
                                    //     'roi_amount' => $package['commision'],
                                    // );
                                    // $this->User_model->add('tbl_roi', $roiArr);
                                    $this->session->set_flashdata('message', 'Account upgraded Successfully');
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
                }else{
                    $this->session->set_flashdata('message',validation_errors());
                }
            }
            $upgradeDetails = $this->User_model->get_single_record('tbl_users',['user_id' => $this->session->userdata['user_id']],'upgradeDetails');
            $josnDecode = json_decode($upgradeDetails['upgradeDetails'],true);
            $packages = $this->config->item('packages');
            $i = 0;
            foreach($packages as $key => $pack){
                if ($josnDecode[$i]['upgrade_amount'] == $pack['packageAmount']) {
                    $j = count($josnDecode) - 1;
                    if($i < $j){
                        $i++;
                    }
                    unset($response['packages'][$key]);
                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            //$response['packages'] = $this->User_model->get_records('tbl_package', array('price > ' => $response['user']['package_amount']), '*');
            $this->load->view('upgrade_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

}
?>