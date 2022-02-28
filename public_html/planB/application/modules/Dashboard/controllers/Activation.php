<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
        $this->exceptionCase = '';
    }

    public function index($epin ='') {
        if (is_logged_in()) {
            // die('here');
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('package_id', 'Package', 'trim|required');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                    $activation = true;
                    if($activation == true){
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
                                            'capping' => $package['capping'],
                                            'upgrade_id' => $data['package_id'],
                                            'upgrade_amount' => $package['price'],
                                        );
                                        $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                        $this->User_model->update('tbl_sponser_count',['downline_id' => $user_id],['paid_status' => 1,'amount' => $package['price']]);
                                        $this->User_model->update_directs($user['sponser_id']);

                                        // $creditCoin = [
                                        //     'user_id' => $user_id,
                                        //     'coin' => 2000,
                                        //     'type' => 'coin_income',
                                        //     'description' => 'Coin credit from Activation',
                                        // ];
                                        // $this->User_model->add('tbl_coin_wallet',$creditCoin);

                                        // $creditCoin2 = [
                                        //     'user_id' => $user['sponser_id'],
                                        //     'coin' => 3000,
                                        //     'type' => 'coin_income',
                                        //     'description' => 'Coin credit from direct paid',
                                        // ];
                                        // $this->User_model->add('tbl_coin_wallet',$creditCoin2);

                                        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,paid_status,directs,package_amount');
                                        
                                        // if($sponser['paid_status'] == 1 && $sponser['package_amount'] >= $package['price']){
                                        //     $DirectIncome = array(
                                        //         'user_id' => $user['sponser_id'],
                                        //         'amount' => $package['price']*0.15,
                                        //         'type' => 'level_income',
                                        //         'description' => 'Level Income from Activation of Member ' . $user_id . ' At level 1',
                                        //     );
                                        //     $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                        // }
                                        if($sponser['paid_status'] == 1){
                                            $DirectIncome = array(
                                                'user_id' => $user['sponser_id'],
                                                'amount' => $package['direct_income'],
                                                'type' => 'direct_income',
                                                'description' => 'Direct Income from Activate of Member ' . $user_id . ' At level 1',
                                            );
                                            $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                        }

                                        $this->level_income($sponser['sponser_id'], $user['user_id'], $package['level_income']);
                                        $this->ROI($user['sponser_id']);

                                        //$this->royaltyAchiever($user['sponser_id']);
                                        // $this->level_income($sponser['sponser_id'], $user['user_id'], $package['price']);
                                        // $this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['price'], $type = 'topup');
                                        if($sponser['directs'] == 2){
                                            $checkPool = $this->User_model->get_single_record($package['products'],['user_id' => $user['sponser_id']],'*');
                                            if(empty($checkPool['user_id'])){
                                                $this->individualPoolEntry($user['sponser_id'],$package['products'],1);
                                                //$this->globlePoolEntry($user['sponser_id'],$package['products'],1);
                                                // $debit = [
                                                //     'user_id' => $user['sponser_id'],
                                                //     'amount' => -10,
                                                //     'type' => 'club_upgradation',
                                                //     'description' => 'Club Upgrdation Deduction',
                                                // ];
                                                // $this->User_model->add('tbl_income_wallet',$debit);
                                            }
                                        }
                                        $this->session->set_flashdata('message', '<h3 class="text-success">Account Activated Successfully </h3>');
                                        redirect('Dashboard/Activation');
                                } else {
                                    $this->session->set_flashdata('message', '<h3 class="text-danger">This Account Already Acitvated </h3>');
                                }
                            } else {
                                $this->session->set_flashdata('message', '<h3 class="text-danger">Insuffcient Balance </h3>');
                            }
                        } else {
                            $this->session->set_flashdata('message', '<h3 class="text-danger">Invalid User ID </h3>');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<h3 class="text-danger">Comming soon </h3>');
                    }
                }else{
                        $this->session->set_flashdata('message', validation_errors());

                }
            }
           // $response['epin'] = $epin;
            //$response['epin_wallet'] = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'],'status' => 0), 'count(epin) as wallet_balance');
            //$response['epins'] = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'],'status' => 0), '*');
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            //$response['packages1'] = $this->User_model->get_records('tbl_package',['price' => $response['epins']['amount']], '*');
            $response['packages'] = $this->User_model->get_records('tbl_package',['id' => 1], '*');
            $this->load->view('activate_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    private function ROI($sponser_id){
        // die;
        if(is_logged_in()){
            $roiArr = [
                1 => ['directs' => 2,'amount' => 1, 'days' => 60 ],
                2 => ['directs' => 4,'amount' => 2, 'days' => 60 ],
                3 => ['directs' => 8,'amount' => 6, 'days' => 60 ],
                4 => ['directs' => 16,'amount' => 12, 'days' => 60 ],
                5 => ['directs' => 32,'amount' => 24, 'days' => 60 ],
                6 => ['directs' => 64,'amount' => 48, 'days' => 60 ],
                7 => ['directs' => 100,'amount' => 100, 'days' => 60 ],
            ];
            foreach ($roiArr as $key => $rArr) {
               $checkDirect = $this->User_model->get_single_record('tbl_users',['user_id' => $sponser_id],'directs,user_id');
               if($checkDirect['directs'] == $rArr['directs']){
                    $arrRoi = [
                        'user_id' => $checkDirect['user_id'],
                        'roi_amount' => $rArr['amount'],
                        'days' => $rArr['days'],
                    ];
                    // pr($arrRoi);
                    $this->User_model->add('tbl_roi', $arrRoi);
               }
            }
        }else{
            redirect('Dashboard/User/login');
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
        $incomes = explode(',', $package_income);
        // $incomes = array(0.07,0.05,0.04,0.04,0.03,0.03,0.03,0.03,0.03);
        foreach ($incomes as $key => $income) {
            // $direct = $key+1;
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status,package_amount,directs');
            if (!empty($sponser)) {
                // if($sponser['package_amount'] >= $package_income){
                //     $level_income = $package_income*$income;
                    if ($sponser['paid_status'] == 1) {
                        // if($sponser['directs'] >= $direct){
                            $LevelIncome = array(
                                'user_id' => $sponser['user_id'],
                                'amount' => $income,
                                'type' => 'level_income',
                                'description' => 'Level Income from Activation of Member ' . $activated_id . ' At level ' . ($key + 2),
                            );
                            $this->User_model->add('tbl_income_wallet', $LevelIncome);
                        // }
                    }
                // }
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

    // public function test(){
    //     $this->individualPoolEntry('MCP23331','tbl_pool',1);
    // }

    protected function individualPoolEntry($user_id,$table,$org){
        $sponsorID = $this->User_model->get_single_record('tbl_users',['user_id' => $user_id],'sponser_id');
        $pool_upline = $this->User_model->get_single_record($table, array('user_id' => $sponsorID['sponser_id'],'down_count <' => 2,'org' => $org), 'user_id');
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
            'org' => $org,
        ];
        //pr($poolArr,true);
        $this->User_model->add($table, $poolArr);
        $this->User_model->update($table, array('user_id' => $uplineID),['down_count' => ($userinfo['down_count'] + 1)]);
        $this->updateTeam($user_id,$table,$org);
        $this->update_pool_downline($uplineID,$user_id,$level = 1,$table,$org);
        $this->poolIncome2($table,$user_id,$user_id,$org);
    }

    // protected function updateTeam($user_id,$table,$org,$pool_id){
    //     $uplineID = $this->User_model->get_single_record($table,array('user_id' => $user_id,'pool_id' => $pool_id,'org' => $org),'upline_id');
    //     if(!empty($uplineID['upline_id'])){
    //         $team = $this->User_model->get_single_record($table,array('user_id' => $uplineID['upline_id'],'org' => $org,'id' => $pool_id),'id,pool_id,team');
    //         $newTeam = $team['team'] + 1;
    //         $this->User_model->update($table, array('user_id' => $uplineID['upline_id'],'org' => $org,'id' => $pool_id),array('team' => $newTeam));
    //         $this->updateTeam($uplineID['upline_id'],$table,$org,$team['pool_id']);
    //     }
    // }

     protected function updateTeam($user_id,$table,$org){
        $uplineID = $this->User_model->get_single_record($table,array('user_id' => $user_id,'org' => $org),'upline_id');
        if(!empty($uplineID['upline_id'])){
            $team = $this->User_model->get_single_record($table,array('user_id' => $uplineID['upline_id'],'org' => $org),'team');
            $newTeam = $team['team'] + 1;
            $this->User_model->update($table, array('user_id' => $uplineID['upline_id'],'org' => $org),array('team' => $newTeam));
            $this->updateTeam($uplineID['upline_id'],$table,$org);
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

    protected function globlePoolEntry($user_id,$table,$org){
        $pool_upline = $this->User_model->get_single_record($table, array('down_count <' => 2,'org' => $org), 'id,user_id,pool_id,down_count');
        $totalMember = $this->User_model->get_single_record($table,['org' => $org],'count(id) as record');
        $position = $totalMember['record']+1;
        if(!empty($pool_upline)){
            $poolArr =  array(
                // 'pool_id' => $pool_upline['id'],
                'user_id' => $user_id,
                'upline_id' => $pool_upline['user_id'],
                'org' => $org,
                'position' => $position,
            );
            $this->User_model->add($table, $poolArr);
            $this->User_model->update($table, array('id' => $pool_upline['id']),array('down_count' => $pool_upline['down_count'] + 1));
            // $this->updateTeam($user_id,$table,$org,$poolArr['pool_id']);
            // $this->poolIncome2($table,$user_id,$user_id,$org,$poolArr['pool_id']);
            $this->updateTeam($user_id,$table,$org);
            $this->poolIncome2($table,$user_id,$user_id,$org);
        }else{
            $poolArr =  array(
                // 'pool_id' => '',
                'user_id' => $user_id,
                'upline_id' => '',
                'org' => $org,
                'position' => $position,
            );
            $this->User_model->add($table, $poolArr);
            // $this->updateTeam($user_id,$table,$org,$poolArr['pool_id']);
            // $this->poolIncome2($table,$user_id,$user_id,$org,$poolArr['pool_id']);
            $this->updateTeam($user_id,$table,$org);
            $this->poolIncome2($table,$user_id,$user_id,$org);
        }
    }

    private function poolIncome2($table,$user_id,$linkedID,$org)
    {
        $incomeArr = [
            1 => ['team' => 4, 'amount' => 600,'table' => 'tbl_pool2'],
            2 => ['team' => 4, 'amount' => 3600,'table' => 'tbl_pool3'],
            3 => ['team' => 4, 'amount' => 21600,'table' => ''],
        ];
        $upline = $this->User_model->get_single_record($table,['user_id' => $user_id],'upline_id');
        if(!empty($upline['upline_id'])){
            $checkTeam1 = $this->User_model->get_single_record($table,['user_id' => $upline['upline_id']],'upline_id');
            if(!empty($checkTeam1['upline_id'])){
                $checkTeam = $this->User_model->get_single_record('tbl_pool_downline',['user_id' => $checkTeam1['upline_id'],'level' => 2,'org' => $org],'count(id) as team');
                if($checkTeam['team'] == $incomeArr[$org]['team']){
                    $creditIncome = [
                        'user_id' => $checkTeam1['upline_id'],
                        'amount' => $incomeArr[$org]['amount'],
                        'type' => 'pool_income',
                        'description' => 'Pool Income',
                    ];
                    $this->User_model->add('tbl_income_wallet',$creditIncome);
                    if($org <= 2){
                        // $debitIncome = [
                        //     'user_id' => $checkTeam1['upline_id'],
                        //     'amount' => -$incomeArr[$org]['amount'],
                        //     'type' => 'upgrade_deduction',
                        //     'description' => 'Pool Upgrade Deduction',
                        // ];
                        // $this->User_model->add('tbl_income_wallet',$debitIncome);

                        $table = $incomeArr[$org]['table'];
                        $org = $org + 1;
                        $this->individualPoolEntry($checkTeam1['upline_id'],$table,$org);
                    }
                }
            }
         }
    }

    private function regenerateID($user_id,$table){
        $this->globlePoolEntry($user_id,$table,1);
    }

    private function secondLevelIncome($user_id,$linkedID,$amount){
        $incomes = array(0.3,0.14,0.1,0.08,0.08,0.06,0.06,0.06,0.06,0.06);
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
                                'type' => 'pool_level_income',
                                'description' => 'Level Income from upgradation of Member ' . $linkedID . ' At level ' . ($key + 2),
                            );
                            $this->User_model->add('tbl_income_wallet', $LevelIncome);
                        //}
                    }
                //}
                $user_id = $sponser['user_id'];
            }
        }
    }

    // public function test()
    // {
    //     $data = $this->poolChart('tbl_pool5');
    //     pr($data);
    // }

    private function poolChart($table){
        $poolArr = [
            'tbl_pool' => [
                1 => ['income' => 30,'deduction' => 20,'org' => '2','table' => 'tbl_pool','levelIncome' => '','package' => '','package_id' => ''],
                2 => ['income' => 60,'deduction' => 40,'org' => '3','table' => 'tbl_pool','levelIncome' => '','package' => '','package_id' => ''],
                3 => ['income' => 120,'deduction' => 50,'org' => '4','table' => 'tbl_pool2','levelIncome' => '10','package' => '50','package_id' => '2'],
            ],
            'tbl_pool2' => [
                1 => ['income' => 75,'deduction' => 50,'org' => '2','table' => 'tbl_pool2','levelIncome' => '','package' => '','package_id' => ''],
                2 => ['income' => 150,'deduction' => 100,'org' => '3','table' => 'tbl_pool2','levelIncome' => '','package' => '','package_id' => ''],
                3 => ['income' => 300,'deduction' => 125,'org' => '4','table' => 'tbl_pool3','levelIncome' => '25','package' => '120','package_id' => '3'],
            ],
            'tbl_pool3' => [
                1 => ['income' => 180,'deduction' => 120,'org' => '2','table' => 'tbl_pool3','levelIncome' => '','package' => '','package_id' => ''],
                2 => ['income' => 360,'deduction' => 240,'org' => '3','table' => 'tbl_pool3','levelIncome' => '','package' => '','package_id' => ''],
                3 => ['income' => 720,'deduction' => 300,'org' => '4','table' => 'tbl_pool4','levelIncome' => '60','package' => '240','package_id' => '4'],
            ],
            'tbl_pool4' => [
                1 => ['income' => 360,'deduction' => 240,'org' => '2','table' => 'tbl_pool4','levelIncome' => '','package' => '','package_id' => ''],
                2 => ['income' => 720,'deduction' => 480,'org' => '3','table' => 'tbl_pool4','levelIncome' => '','package' => '','package_id' => ''],
                3 => ['income' => 1440,'deduction' => 600,'org' => '4','table' => 'tbl_pool5','levelIncome' => '120','package' => '460','package_id' => '5'],
            ],
            'tbl_pool5' => [
                1 => ['income' => 690,'deduction' => 460,'org' => '2','table' => 'tbl_pool5','levelIncome' => '','package' => '','package_id' => ''],
                2 => ['income' => 1380,'deduction' => 920,'org' => '3','table' => 'tbl_pool5','levelIncome' => '','package' => '','package_id' => ''],
                3 => ['income' => 2760,'deduction' => 1150,'org' => '4','table' => 'tbl_pool6','levelIncome' => '230','package' => '1100','package_id' => '6'],
            ],
            'tbl_pool6' => [
                1 => ['income' => 1650,'deduction' => 1100,'org' => '2','table' => 'tbl_pool6','levelIncome' => '','package' => '','package_id' => ''],
                2 => ['income' => 3300,'deduction' => 2200,'org' => '3','table' => 'tbl_pool6','levelIncome' => '','package' => '','package_id' => ''],
                3 => ['income' => 6600,'deduction' => 2750,'org' => '4','table' => 'tbl_pool7','levelIncome' => '550','package' => '2500','package_id' => '7'],
            ],
            'tbl_pool7' => [
                1 => ['income' => 3750,'deduction' => 2500,'org' => '2','table' => 'tbl_pool7','levelIncome' => '','package' => '','package_id' => ''],
                2 => ['income' => 7500,'deduction' => 5000,'org' => '3','table' => 'tbl_pool7','levelIncome' => '','package' => '','package_id' => ''],
                3 => ['income' => 15000,'deduction' => 6200,'org' => '4','table' => 'tbl_pool8','levelIncome' => '1225','package' => '4800','package_id' => '8'],
            ],
            'tbl_pool8' => [
                1 => ['income' => 7200,'deduction' => 4800,'org' => '2','table' => 'tbl_pool8','levelIncome' => '','package' => '','package_id' => ''],
                2 => ['income' => 14400,'deduction' => 9600,'org' => '3','table' => 'tbl_pool8','levelIncome' => '','package' => '','package_id' => ''],
                3 => ['income' => 28800,'deduction' => 12000,'org' => '4','table' => 'tbl_pool9','levelIncome' => '2400','package' => '7500','package_id' => '9'],
            ],
            'tbl_pool9' => [
                1 => ['income' => 11250,'deduction' => 7500,'org' => '2','table' => 'tbl_pool9','levelIncome' => '','package' => '','package_id' => ''],
                2 => ['income' => 22500,'deduction' => 15000,'org' => '3','table' => 'tbl_pool9','levelIncome' => '','package' => '','package_id' => ''],
                3 => ['income' => 45000,'deduction' => 18750,'org' => '4','table' => 'tbl_pool10','levelIncome' => '3750','package' => '10000','package_id' => '10'],
            ],
            'tbl_pool10' => [
                1 => ['income' => 15000,'deduction' => 10000,'org' => '2','table' => 'tbl_pool10','levelIncome' => '','package' => '','package_id' => ''],
                2 => ['income' => 30000,'deduction' => 20000,'org' => '3','table' => 'tbl_pool10','levelIncome' => '','package' => '','package_id' => ''],
                3 => ['income' => 60000,'deduction' => 25000,'org' => '4','table' => '','levelIncome' => '5000','package' => '','package_id' => ''],
            ],
        ];

        return $poolArr[$table];
    }

    private function getSponsor($user_id,$table){
        $users = $this->User_model->get_records('tbl_sponser_count',"downline_id = '".$user_id."' and user_id != 'none' ORDER BY level ASC",'user_id');
        foreach($users as $user){
            $check = $this->User_model->get_single_record($table,['user_id' => $user['user_id']],'user_id');
            if(!empty($check['user_id'])){
                $check2 = $this->User_model->get_single_record($table,['user_id' => $user['user_id'],'down_count <' => 2],'user_id');
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
                $check = $this->User_model->get_single_record($table,['user_id' => $user['downline_id'],'down_count <' => 2],'user_id');
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
            //$response['packages'] = $this->config->item('packages');

            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                //$amount = $response['packages'][$data['package']];
                $this->form_validation->set_rules('package_id','packages','required');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $this->session->userdata['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                    $lastPackage = $this->User_model->get_single_record('tbl_users',['user_id' => $this->session->userdata['user_id']],'upgrade_id');
                    $nextPackage = $lastPackage['upgrade_id']+1;
                    $nextPackagePrice = $this->User_model->get_single_record('tbl_package',['id' => $nextPackage],'*');
                    $activation = true;
                    if($activation == true){
                        if (!empty($user)) {
                            if ($wallet['wallet_balance'] >= $package['price']) {
                                if($nextPackage == $package['id']) {
                                        if($user['directs'] >= $package['total_directs']){
                                                $sendWallet = array(
                                                    'user_id' => $this->session->userdata['user_id'],
                                                    'amount' => -$package['price'],
                                                    'type' => 'account_activation',
                                                    'remark' => 'Account Upgrade Deduction for ' . $user_id,
                                                );
                                                $this->User_model->add('tbl_wallet', $sendWallet);
                                                
                                                // $oldTopupdata = [];
                                                // if(!empty($user['upgradeDetails'])){
                                                //     $oldTopupdata = json_decode($user['upgradeDetails'],true);
                                                // }
                                                $topupData = array(
                                                    'package_id' => $package['id'],
                                                    'package_amount' => $package['price'],
                                                    'upgrade_id' => $package['id'],
                                                    'upgrade_amount' => $package['price'],
                                                );
                                                $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                                $this->individualPoolEntry($user['user_id'],$package['products'],$package['id']);
                                                //$this->globlePoolEntry($user['user_id'],$package['products'],$package['id']);

                                                // $this->User_model->update_directs($user['sponser_id']);
                                                $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs,paid_status');
                                                if($sponser['paid_status'] == 1){
                                                    $DirectIncome = array(
                                                        'user_id' => $user['sponser_id'],
                                                        'amount' => $package['direct_income'],
                                                        'type' => 'direct_income',
                                                        'description' => 'Direct Income from upgrade of Member ' . $user_id . ' At level 1',
                                                    );
                                                    $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                                }
                                                // $this->level_income($sponser['sponser_id'], $user['user_id'], $package['price']);
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
                                                $this->session->set_flashdata('message', '<h3 class="text-success">Account upgraded Successfully</h5>');
                                                redirect('Dashboard/Activation/UpgradeAccount');
                                        } else {
                                            $this->session->set_flashdata('message', '<h3 class="text-danger">Total '.$package['total_directs'].' Directs Required for upgrade!</h5>');
                                        }
                                } else {
                                    $this->session->set_flashdata('message', '<h3 class="text-danger">You can upgrade to only amount $'.$nextPackagePrice['price'].'</h5>');
                                }
                            } else {
                                $this->session->set_flashdata('message', '<h3 class="text-danger">Insuffcient Balance</h5>');
                            }
                        }else{
                            $this->session->set_flashdata('message', '<h3 class="text-danger">Invalid User ID</h3>');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<h3 class="text-danger">Comming soon </h3>');
                    }
                }else{
                    $this->session->set_flashdata('message','<h3 class="text-danger">'.validation_errors().'</h5>');
                }
            }
            //redirect('Dashboard/Activation');
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package',"price > '".$response['user']['upgrade_amount']."' order by id ASC LIMIT 1", '*');
            //pr($response,true);
            $this->load->view('upgrade_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

}
?>