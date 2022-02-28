<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        date_default_timezone_set('Asia/Kolkata');
        $this->public_key = public_key;
        $this->private_key = private_key;
    }

    public function index() {
        // $arr['users'] = [];
        // $users = $this->Main_model->get_records('tbl_sponser_count',"user_id != '' group by user_id",'user_id');
        // $i = 0;
        // foreach($users as $key => $user){
        //     $i = 0;
        //     $userinfo = $this->Main_model->get_single_record('tbl_users',['sponser_id' => $user['user_id'],'paid_status' => 1],'count(id) as direct');
        //     $users2 = $this->Main_model->get_records('tbl_sponser_count',['user_id' => $user['user_id'],'level' => 1],'user_id,downline_id,level');
        //     $getPaidTeam = $this->Main_model->getPaidTeam($user['user_id'],1,3);
        //     foreach($users2 as $key2 => $user2){
        //         $users3 = $this->Main_model->get_single_record('tbl_users',['sponser_id' => $user2['downline_id'],'paid_status' => 1],'count(id) as direct');
        //         if($users3['direct'] >= 4 && $getPaidTeam >= 64 && $userinfo['direct'] >= 4 && $user['user_id'] != '11111'){
                    
        //             $i++;
        //             //echo $user['user_id'].'<br>';
        //             //echo $i.' User ID <b style="color:red">'.$user['user_id'].'</b> Downline ID '.$user2['downline_id'].'<b style="color:red"> directs '.$users3['direct'].'</b> level '.$user2['level'].'<br>';
        //             $arr['users'][$key] = [
        //                 'user_id' => $user['user_id'],
        //                 'self_direct' => $userinfo['direct'],
        //                 'level' => 1,
        //                 'level 2 direct' => $users3['direct'],
        //                 'level3' => $getPaidTeam,
        //             ]; 
        //         }
        //     }
        // }
        // echo '<br>';
        // pr($arr);
        
    }


    public function leadershipAchivers()
    {

        $users = $this->Main_model->get_records('tbl_sponser_count',"user_id != '' group by user_id",'user_id');
        $i = 0;
        foreach($users as $key => $user){
            $i = 0;
            $userinfo = $this->Main_model->get_single_record('tbl_users',['sponser_id' => $user['user_id'],'paid_status' => 1],'count(id) as direct');
            $users2 = $this->Main_model->get_records('tbl_sponser_count',['user_id' => $user['user_id'],'level' => 1],'user_id,downline_id,level');
            $getPaidTeam = $this->Main_model->getPaidTeam($user['user_id'],1,3);
            foreach($users2 as $key2 => $user2){
                $users3 = $this->Main_model->get_single_record('tbl_users',['sponser_id' => $user2['downline_id'],'paid_status' => 1],'count(id) as direct');
                if($users3['direct'] >= 4 && $getPaidTeam >= 64 && $userinfo['direct'] >= 4 && $user['user_id'] != '11111'){
                    
                    $i++;
                    //echo $user['user_id'].'<br>';
                    //echo $i.' User ID <b style="color:red">'.$user['user_id'].'</b> Downline ID '.$user2['downline_id'].'<b style="color:red"> directs '.$users3['direct'].'</b> level '.$user2['level'].'<br>';
                    $arr['users'][$key] = [
                        'user_id' => $user['user_id'],
                        'self_direct' => $userinfo['direct'],
                        'level' => 1,
                        'level 2 direct' => $users3['direct'],
                        'level3' => $getPaidTeam,
                    ]; 
                    $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], ['leadership_status' => 1]);
                }
            }
        }
        echo '<br>';
        pr($arr);
        // $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0],'*');
        // foreach ($users as $key => $user) {
        //     $data = $this->Main_model->count_level_directss($user['user_id']);
        //     if(!empty($data) && $user['leadership_status'] == 0 && $data[0]['level_count'] >= 64 && $user['directs'] >= 4){
        //         $totalDirect = $this->Main_model->get_single_record('tbl_users', ['sponser_id' => $user['user_id'], 'paid_status >' => 0], 'count(id) as totalDirect');
        //         if($totalDirect['totalDirect'] >= 4){
        //             $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], ['leadership_status' => 1]);
        //             pr($data);
        //         }
        //     }
        // }
    }


    public function leadership_income()
    {
        $todayIds = $this->Main_model->get_single_record('tbl_users', 'paid_status > "0" AND date(topup_date) = date(NOW())-1','count(id) as todayIds');
        $totalBusiness = ($todayIds['todayIds']*32.5);
        $users = $this->Main_model->get_records('tbl_users', ['leadership_status >' => 0, 'directs >=' => 4, 'user_id !=' => '11111'],'id,user_id,leadership_status');
        $per_user = $totalBusiness/count($users);
        foreach ($users as $key => $user) {
            $totalDirect = $this->Main_model->get_single_record('tbl_users', ['sponser_id' => $user['user_id'], 'paid_status >' => 0], 'count(id) as totalDirect');
            if($totalDirect['totalDirect'] >= 4){
                $userData = [
                    'user_id' => $user['user_id'],
                    'amount' => $per_user,
                    'type' => 'leadership_income',
                    'description' => 'Daily Leadership Income',
                ];
                pr($userData);
                $this->Main_model->add('tbl_income_wallet',$userData);
            }
        }
    }


    public function royaltyIncome(){
        $date = date('Y-m-d',strtotime(date('Y-m-d').' - 1 days'));
        $royaltyUsers = $this->Main_model->get_records('tbl_sponser_count',"paid_status = '1' group by user_id having teamBusiness >= 500000",'ifnull(sum(amount),0) as teamBusiness,user_id');
        if(!empty($royaltyUsers)){
            $todayBusiness = $this->Main_model->get_single_record('tbl_users',['paid_status' => 1,'date(topup_date)' => $date],'ifnull(sum(package_amount),0) as business');
            if($todayBusiness['business'] > 0){
                $perUserIncome = ($todayBusiness['business']*0.01)/count($royaltyUsers);
                foreach($royaltyUsers as $key => $ru){
                    $userData = [
                        'user_id' => $ru['user_id'],
                        'amount' => $perUserIncome,
                        'type' => 'royalty_income',
                        'description' => 'Royalty Income',
                    ];
                    pr($userData);
                    $this->Main_model->add('tbl_income_wallet',$userData);
                }
            }else{
                echo 'Today buisness is Rs.0';
            }
        }else{
            echo 'No royalty users';
        }
    }



    public function roiCron(){
      //die;
      if(date('D') == 'Sun'){
          die('its weekend');
      }
      //first 4 day make 2.5 multiply
        $roi_users = $this->Main_model->get_records('tbl_roi', array('amount >' => 0 , 'type !=' => 'salary','days >' => 0), '*');
        foreach($roi_users as $key => $user){
            $userinfo = $this->Main_model->get_single_record('tbl_users',['user_id'=>$user['user_id']],'topup_date');
            $date1 = date('Y-m-d');
            $date2 = date('Y-m-d',strtotime($userinfo['topup_date'].'+ 2 days'));
            $diff = strtotime($date1) - strtotime($date2);
            //if($diff > 0){
                $new_day = $user['days'] - 1;
                $incomeArr = array(
                    'user_id' => $user['user_id'],
                    'amount' => $user['roi_amount'],
                    'type' => 'daily_roi_income',
                    'description' => 'Daily Trading Points at '.$new_day . ' Day',
                );
                pr($user);
                if($user['days'] > 50){
                    $incomeArr['amount'] = $incomeArr['amount'] * 3.3333333333;
                }
                $this->Main_model->add('tbl_income_wallet', $incomeArr);
                $this->Main_model->update('tbl_roi', array('id' => $user['id']), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount'])));
                $sponser = $this->Main_model->get_single_record('tbl_users',['user_id' => $user['user_id']],'user_id,sponser_id,directs');
                //$this->roi_level_income($sponser['sponser_id'], $down_id = $user['user_id']);
           // }
        }
    }
    public function roi_level_income($user_id = '', $down_id = ''){
      die;
      // if(date('D') == 'Sun' || date('D') == 'Sat'){
      //     die('its weekend');
      // }
      //die;
        // $cron = $this->Main_model->get_single_record('tbl_cron','  date(created_at) = date(now()) and cron_name = "roi_level_cron"' ,'*');
        // if(empty($cron)){
        //     $users = $this->Main_model->get_records('tbl_users',['paid_status' => 1],'user_id,sponser_id');
        //     foreach($users as $key => $user){
        //         $down_id = $user['user_id'];
        //         $user_id = $user['sponser_id'];
                $incomes = [
                    1 => ['income' => 0.02 , 'directs' => 1],
                    2 => ['income' => 0.03 , 'directs' => 2],
                    3 => ['income' => 0.04 , 'directs' => 3],
                    4 => ['income' => 0.03 , 'directs' => 4],
                    5 => ['income' => 0.02 , 'directs' => 5],
                    6 => ['income' => 0.02 , 'directs' => 6],
                    7 => ['income' => 0.01 , 'directs' => 7],

                ];
                foreach($incomes as $key => $income){
                    $user = $this->Main_model->get_single_record('tbl_users',['user_id' => $user_id],'user_id,sponser_id,directs');
                    if(!empty($user)){
                        pr($user);
                        if($user['directs'] >= $income['directs']){
                            $income = array(
                                'user_id' => $user['user_id'],
                                'amount' => $income['income'],
                                'type' => 'roi_level_income',
                                'description' => 'ROI Level income At Level '.$key . ' from '.$down_id,
                            );
                            $this->Main_model->add('tbl_income_wallet', $income);
                        }
                        $user_id = $user['sponser_id'];
                    }
                }
            // }
        //     $this->Main_model->add('tbl_cron', array('cron_name' => 'roi_level_cron'));
        // }else{
        //     echo'today cron already run';
        // }
    }

    public function WithdrawCron(){
        if(date('d') == '07' || date('d') == '14' || date('d') == '21' || date('d') == '28'){
            $users = $this->Main_model->withdraw_users(500);
            pr($users);
            foreach($users as $key => $user){
                $DirectIncome = array(
                    'user_id' => $user['user_id'],
                    'amount' => - $user['total_amount'] ,
                    'type' => 'withdraw_request',
                    'description' => 'Withdraw Request',
                );
                $this->Main_model->add('tbl_income_wallet', $DirectIncome);
                $withdrawArr = array(
                    'user_id' => $user['user_id'],
                    'amount' => $user['total_amount'] ,
                    'type' => 'withdraw_request',
                    'tds' => $user['total_amount']* 5 /100,
                    'admin_charges' => $user['total_amount']  * 5 /100,
                    'fund_conversion' => 0,
                    'payable_amount' => $user['total_amount'] * 90 /100
                );
                $this->Main_model->add('tbl_withdraw', $withdrawArr);
            }
        }else{
            echo 'Withdraw date is 7,14,21,28 of every month';
        }
    }
    public function rewardsCron(){
        // $awardsArr = [
        //     '1' => ['pair' => '10','designation' => 'Star','reward' => '4000'],
        //     '2' => ['pair' => '20','designation' => 'Silver Star','reward' => '8000'],
        //     '3' => ['pair' => '50','designation' => 'Pearl Star','reward' => '20000'],
        //     '4' => ['pair' => '100','designation' => 'Gold Star','reward' => '70000'],
        //     '5' => ['pair' => '250','designation' => 'Emrald Star','reward' => '200000'],
        //     '6' => ['pair' => '1000','designation' => 'Platinum Star','reward' => '625000'],
        //     '7' => ['pair' => '3000','designation' => 'Diamond Star','reward' => '1400000'],
        //     '8' => ['pair' => '7500','designation' => 'Royal Diamond Star','reward' => '2500000'],
        //     '9' => ['pair' => '15000','designation' => 'Crown Diamond Star','reward' => '4000000'],
        //     '10' => ['pair' => '35000','designation' => 'Crown Ambassador Star','reward' => '10000000'],
        //     '11' => ['pair' => '75000','designation' => 'Double Crown Ambassador Star','reward' => '25000000'],
        //     '12' => ['pair' => '150000','designation' => 'Kohinoor Star','reward' => '50000000'],
        // ];
        $awardsArr = [
            '1' => ['pair' => '10','designation' => 'Star','reward' => '4000'],
            '2' => ['pair' => '30','designation' => 'Silver Star','reward' => '8000'],
            '3' => ['pair' => '80','designation' => 'Pearl Star','reward' => '20000'],
            '4' => ['pair' => '150','designation' => 'Gold Star','reward' => '70000'],
            '5' => ['pair' => '430','designation' => 'Emrald Star','reward' => '200000'],
            '6' => ['pair' => '1430','designation' => 'Platinum Star','reward' => '625000'],
            '7' => ['pair' => '4430','designation' => 'Diamond Star','reward' => '1400000'],
            '8' => ['pair' => '11930','designation' => 'Royal Diamond Star','reward' => '2500000'],
            '9' => ['pair' => '26930','designation' => 'Crown Diamond Star','reward' => '4000000'],
            '10' => ['pair' => '61930','designation' => 'Crown Ambassador Star','reward' => '10000000'],
            '11' => ['pair' => '136930','designation' => 'Double Crown Ambassador Star','reward' => '25000000'],
            '12' => ['pair' => '151930','designation' => 'Kohinoor Star','reward' => '50000000'],
        ];
        foreach ($awardsArr as $key => $award){
            $users = $this->Main_model->get_records('tbl_users', ['leftPower >=' => $award['pair'],'rightPower >=' => $award['pair']], 'user_id,leftPower,rightPower');
            foreach($users as $key2 => $u){
                $check = $this->Main_model->get_single_record('tbl_rewards',['award_id' => $key,'user_id' => $u['user_id']],'*');
                if(empty($check)){
                    $rewardData = [
                        'user_id' => $u['user_id'],
                        'amount' => $award['reward'],
                        'award_id' => $key,
                    ];
                    $this->Main_model->add('tbl_rewards',$rewardData);
                    pr($rewardData);
                    // $IncomeData = [
                    //     'user_id' => $u['user_id'],
                    //     'amount' => $award['reward'],
                    //     'type' => 'royalty_income',
                    //     'description' => 'Reward Income',
                    // ];
                    // pr($IncomeData);
                    // $this->Main_model->add('tbl_income_wallet',$IncomeData);
                }
            }
        }
    }



    public function credit_salary_income(){
        $roi_users = $this->Main_model->get_records('tbl_roi', array('amount >' => 0 , 'type' => 'salary'), '*');
        foreach($roi_users as $key => $user){
            $this_month_roi = $this->Main_model->get_single_record_desc('tbl_income_wallet', array('type' => 'salary_income' , 'user_id' => $user['user_id'],'month(created_at)' => date('m')), '*');
            if(empty($this_month_roi)){

                $new_day = $user['days'] - 1;
                $incomeArr = array(
                    'user_id' => $user['user_id'],
                    'amount' => $user['roi_amount'],
                    'type' => 'salary_income',
                    'description' => 'salary Income at '.$new_day . ' Month',
                );
                pr($user);
                $this->Main_model->add('tbl_income_wallet', $incomeArr);
                $this->Main_model->update('tbl_roi', array('id' => $user['id']), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount'])));
            }
        }
    }

    public function point_match_cron() {
        $response['users'] = $this->Main_model->get_records('tbl_users', '(leftPower >= 2 and rightPower >= 1 )', 'id,user_id,sponser_id,leftPower,rightPower,package_amount,capping');
        foreach ($response['users'] as $user) {
            pr($user);
            $position_directs = $this->Main_model->count_position_directs($user['user_id']);
            if(!empty($position_directs) && count($position_directs) == 2){
                // $user_package = $this->Main_model->get_single_record_desc('tbl_package', array('id' => $user['package']), '*');
                $user_match = $this->Main_model->get_single_record_desc('tbl_point_matching_income', array('user_id' => $user['user_id']), '*');
                if (!empty($user_match)) {
                    if ($user['leftPower'] > $user['rightPower']) {
                        $old_income = $user['rightPower'];
                    } else {
                        $old_income = $user['leftPower'];
                    }
                    if ($user_match['left_bv'] > $user_match['right_bv']) {
                        $new_income = $user_match['right_bv'];
                    } else {
                        $new_income = $user_match['left_bv'];
                    }
                    $income = ($old_income - $new_income);
                    $user_income = $income * 350;
                    if ($user_income > 0) {
                        if($user_income > $user['capping']){
                            $user_income = $user['capping'];
                        }
                        $matchArr = array(
                            'user_id' => $user['user_id'],
                            'left_bv' => $user['leftPower'],
                            'right_bv' => $user['rightPower'],
                            'amount' => $user_income,
                        );
                        $this->Main_model->add('tbl_point_matching_income', $matchArr);
                        $incomeArr = array(
                            'user_id' => $user['user_id'],
                            'amount' => $user_income,
                            'type' => 'matching_bonus',
                            'description' => 'Point Matching Bonus'
                        );
                        $this->Main_model->add('tbl_income_wallet', $incomeArr);
                        //$this->generation_income($user['sponser_id'] , $user_income , $user['user_id'],'salary_income');
                        pr($matchArr);
                    }
                } else {
                    if ($user['leftPower'] > $user['rightPower']) {
                        $income = $user['rightPower'];
                    } else {
                        $income = $user['leftPower'];
                    }
                    $user_income = $income * 350;
                    //                echo $user_income;
                    if($user_income > $user['capping']){
                        $user_income = $user['capping'];
                    }
                    $matchArr = array(
                        'user_id' => $user['user_id'],
                        'left_bv' => $user['leftPower'],
                        'right_bv' => $user['rightPower'],
                        'amount' => $user_income,
                    );
                    $this->Main_model->add('tbl_point_matching_income', $matchArr);
                    $incomeArr = array(
                        'user_id' => $user['user_id'],
                        'amount' => $user_income,
                        'type' => 'matching_bonus',
                        'description' => 'Point Matching Bonus'
                    );
                    $this->Main_model->add('tbl_income_wallet', $incomeArr);
                    //$this->generation_income($user['sponser_id'] , $user_income , $user['user_id'],'direct_sponser_income');
                    pr($matchArr);
                }

            }
        }
        pr($response);
        die('code executed Successfully');
    }

    // public function testing(){
    //     $users = $this->Main_model->get_records('tbl_users',[],'*');
    //     foreach($users as $u){
    //         $this->Main_model->update('tbl_users',['user_id' => $u['user_id']],['leftBusiness' => $u['leftPower'],'rightBusiness' => $u['rightPower']]);
    //     }
    //     echo 'done';
    // }


    public function universalPrivilege(){
        $total = $this->Main_model->get_single_record('tbl_universal_income',['status' => 0],'ifnull(sum(amount),0) as total');
        $distribute = $total['total']/4;
        $package =[
                1 => ['amount' => 2500,'type' => 'Platinum '],
                2 => ['amount' => 4800,'type' => 'Challanger'],
                3 => ['amount' => 7500,'type' => 'Master'],
                4 => ['amount' => 10000,'type' => 'Grand Master'],

        ];
        foreach ($package as $key => $pk) {
            $user = $this->Main_model->get_records('tbl_users',['package_amount >=' => $pk['amount']],'user_id');
            $alluser = count($user);
            if($alluser > 0){
                $perID = $distribute/$alluser;
            }
                foreach ($user as $key => $val) {
                    $incomeArr = [
                    'user_id' => $val['user_id'],
                    'amount' =>  $perID ,
                    'type' => 'stacking_income',
                    'description'=>'Stacking Income From '.$pk['type'].' Club',
                ];
                pr($incomeArr);
               $this->Main_model->add('tbl_income_wallet',$incomeArr);
                }
               $this->Main_model->update('tbl_universal_income',['status' => 0],['status' =>1]);
        }
     }  

     public function curlCron(){
        ini_set('max_execution_time', 0);
        $allRecord = $this->Main_model->get_records('tbl_users',"wallet_address ='' order by id asc limit 349",'*');
        // $allRecord = $this->Main_model->get_records('tbl_users',['id' => 1],'*');

        foreach ($allRecord as $key => $value) {
            // if($value['wallet_address'] && $value['private_key'])

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://176.58.124.217:3000/generate_trx_address',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;
            // echo $response['address'];

            $jsonD = json_decode($response,true);
            // pr($jsonD);
            // echo $jsonD['account']['address'].'<br>';
            // echo $jsonD['account']['private_key'];
            
                $updateArr = [
                        'wallet_address' => $jsonD['account']['address'],
                        'private_key' => $jsonD['account']['private_key'],
                ];
                $this->Main_model->update('tbl_users',['user_id' => $value['user_id']],$updateArr); 
                echo 'address Updated.'.$key.'<br>';           
        }
        // count($allRecord['id']).'<br>';
        echo 'done';

     }

     public function coinPaymentChecknew(){
        $cmd = 'get_tx_ids';
        $public_key = $this->public_key;
        $private_key = $this->private_key;
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['key'] = $public_key;
        $req['format'] = 'json';
        $post_data = http_build_query($req, '', '&');
        $hmac = hash_hmac('sha512', $post_data, $private_key);
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($ch);
        $data = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
        pr($data);
        foreach($data['result'] as $d){
            $b_transaction = $this->Main_model->get_single_record('BTC_TRANSACTION', array('transaction_id' => $d), '*');
            // if(empty($b_transaction)){
            //     $this->getinfo22('get_tx_info', $d);
            // }else{
                $this->getinfo33('get_tx_info', $d);
            //}
        }
    }

    private function getinfo22($cmd = 'get_tx_info', $tax_id ='CPDI1TBAPSGQYM0DBRRDHSMTA0') {
        $public_key = $this->public_key;
        $private_key = $this->private_key;
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['txid'] = $tax_id;
        $req['full'] = TRUE;
        $req['key'] = $public_key;
        $req['format'] = 'json'; //supported values are json and xml
        $post_data = http_build_query($req, '', '&');
        $hmac = hash_hmac('sha512', $post_data, $private_key);
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($ch);
        $data2 = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);

        //pr($data2);
        $send['transaction_id'] = $tax_id;
        $send['created_time'] = $data2['result']['time_created'];
        $send['time_expires'] = $data2['result']['time_expires'];
        $send['status'] = $data2['result']['status'];
        $send['status_text'] = $data2['result']['status_text'];
        $send['type'] = $data2['result']['type'];
        $send['coin'] = $data2['result']['coin'];
        $send['amount'] = $data2['result']['checkout']['amountf'];
        $send['amountf'] = $data2['result']['amountf'];
        $send['received'] = $data2['result']['received'];
        $send['receivedf'] = $data2['result']['receivedf'];
        $send['recv_confirms'] = $data2['result']['recv_confirms'];
        $send['payment_address'] = $data2['result']['payment_address'];
        $send['invoice'] = $data2['result']['checkout']['invoice'];
        $send['user_id'] = $data2['result']['checkout']['custom'];
        //$send['package'] = $data2['result']['checkout']['item_name'];
        $send['first_name'] = $data2['result']['checkout']['item_name'];
        $this->Main_model->add('BTC_TRANSACTION',$send);
        // if($send['status'] == 100){
        //     $amountArr = array('user_id' => $send['first_name'] ,'amount' => $send['amountf'],'transaction_id' => $send['transaction_id']);
        //     $this->Main_model->add('tbl_wallet', $amountArr);
        // }
    }

    public function checkPayment(){
        $users = $this->Main_model->get_records('BTC_TRANSACTION', array('status!=' => 100), '*');
        $date1 = date('Y-m-d H:i:s');
        $date2 = date('Y-m-d H:i:s',strtotime($user['created_at'].' + 30 minutes'));
        $diff = strtotime($date2) - strtotime($date1);
        if($diff > 0){
            foreach($users as $user){
                $this->getinfo33('get_tx_info', $users['transaction_id']);
            }
        }
    }

    private function getinfo33($cmd = 'get_tx_info', $tax_id ='CPDI1TBAPSGQYM0DBRRDHSMTA0') {
        $public_key = $this->public_key;
        $private_key = $this->private_key;
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['txid'] = $tax_id;
        $req['full'] = TRUE;
        $req['key'] = $public_key;
        $req['format'] = 'json'; //supported values are json and xml
        $post_data = http_build_query($req, '', '&');
        $hmac = hash_hmac('sha512', $post_data, $private_key);
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($ch);
        $data2 = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
        pr($data2);
        $send['created_time'] = $data2['result']['time_created'];
        $send['time_expires'] = $data2['result']['time_expires'];
        $send['status'] = $data2['result']['status'];
        $send['status_text'] = $data2['result']['status_text'];
        $send['type'] = $data2['result']['type'];
        $send['coin'] = $data2['result']['coin'];
        $send['amount'] = $data2['result']['checkout']['amountf'];
        $send['amountf'] = $data2['result']['amountf'];
        $send['received'] = $data2['result']['received'];
        $send['receivedf'] = $data2['result']['receivedf'];
        $send['recv_confirms'] = $data2['result']['recv_confirms'];
        $send['payment_address'] = $data2['result']['payment_address'];
        $send['invoice'] = $data2['result']['checkout']['invoice'];
        $send['user_id'] = $data2['result']['checkout']['custom'];
        //$send['package'] = $data2['result']['checkout']['item_name'];
        $send['first_name'] = $data2['result']['checkout']['item_name'];
        pr($send);
        $check = $this->Main_model->get_single_record('BTC_TRANSACTION',['transaction_id' => $tax_id],'*');
        if($check['status'] != 100){
            $this->Main_model->update('BTC_TRANSACTION',['transaction_id' => $tax_id],$send);
        }
        if($check['status'] == 100 && $check['walletStatus'] == 0){
            $amountArr = array('user_id' => $send['first_name'] ,'amount' => $send['amount'],'remark' => 'Transaction ID '.$tax_id,'transaction_id' => $tax_id);
            $this->Main_model->add('tbl_wallet', $amountArr);
            $this->Main_model->update('BTC_TRANSACTION',['transaction_id' => $tax_id],['walletStatus' => 1]);
        }
    }

}
