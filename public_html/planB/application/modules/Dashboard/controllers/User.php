<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation','pagination','security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        if (is_logged_in()) {
            $response['totalMemebers'] = $this->User_model->get_single_record('tbl_users', array(), 'count(id)as ids');
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['selfPosition'] = $this->User_model->get_single_record('tbl_users', array('id <=' => $response['user']['id']), 'count(id)as selfPosition');
            $response['coinWallet'] = $this->User_model->get_single_record('tbl_coin_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(coin),0) as total');

            $response['token_value'] = $this->User_model->get_single_record('tbl_token_value', [], '*');
            $response['today_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and date(created_at) = date(now()) and amount > 0 AND type != "bank_transfer"', 'ifnull(sum(amount),0) as today_income');
            $response['today_matching_bonus'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "matching_bonus" and date(created_at) = date(now())', 'ifnull(sum(amount),0) as today_matching_bonus');
            /*incomes */
            $response['leadership_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "leadership_income"', 'ifnull(sum(amount),0) as leadership_income');
            $response['level_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "level_income"', 'ifnull(sum(amount),0) as level_income');
            $response['royalty_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "royalty_income"', 'ifnull(sum(amount),0) as royalty_income');
            $response['direct_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "direct_income"', 'ifnull(sum(amount),0) as direct_income');
            $response['senior_support_bonus'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "senior_support_bonus"', 'ifnull(sum(amount),0) as senior_support_bonus');
            $response['poolIncome'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and (type = "pool_income" OR type ="upgrade_deduction")', 'ifnull(sum(amount),0) as pool_income');
            $response['turnover_rewards'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "turnover_rewards"', 'ifnull(sum(amount),0) as turnover_rewards');
            $response['fix_deposit'] = $this->User_model->get_single_record('tbl_fix_deposit', 'user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as fix_deposit');
            /*incomes */
            // $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" AND (type != "direct_income_withdraw" OR type != "direct_income")', 'ifnull(sum(amount),0) as total_income');

            $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" AND (type != "direct_income_withdraw" AND type != "bank_transfer") and amount > "0"', 'ifnull(sum(amount),0) as total_income');

            $response['income_balance'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as income_balance');
            $response['total_repurchase_income'] = $this->User_model->get_single_record('tbl_repurchase_income', 'user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as total_repurchase_income');
            $response['team'] = $this->User_model->get_single_record('tbl_downline_count', 'user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(count(id),0) as team');
            $response['paid_directs'] = $this->User_model->get_single_record('tbl_users', 'sponser_id = "'.$this->session->userdata['user_id'].'" and paid_status = 1', 'ifnull(count(id),0) as paid_directs');
            $response['free_directs'] = $this->User_model->get_single_record('tbl_users', 'sponser_id = "'.$this->session->userdata['user_id'].'"  and paid_status = 0', 'ifnull(count(id),0) as free_directs');
            $response['requested_fund'] = $this->User_model->get_single_record('tbl_payment_request', 'user_id = "'.$this->session->userdata['user_id'].'" ', 'ifnull(sum(amount),0) as requested_fund');
            $response['wallet_balance'] = $this->User_model->get_single_record('tbl_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" ', 'ifnull(sum(amount),0) as wallet_balance');

            $response['usedEpin'] = $this->User_model->get_single_record('tbl_epins',['user_id' => $this->session->userdata['user_id'] , 'status' => 1], 'ifnull(count(id),0) as ids');
            $response['unusedEpin'] = $this->User_model->get_single_record('tbl_epins', ['user_id' => $this->session->userdata['user_id'] , 'status' => 0], 'ifnull(count(id),0) as ids');
            $response['transferEpins'] = $this->User_model->get_single_record('tbl_epins',['user_id' => $this->session->userdata['user_id'] , 'status' => 2] , 'ifnull(count(id),0) as ids');

            //$response['token_wallet'] = $this->User_model->get_single_record('tbl_token_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" ', 'ifnull(sum(amount),0) as token_wallet');
            //$response['shopping_wallet'] = $this->User_model->get_single_record('tbl_shopping_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" ', 'ifnull(sum(amount),0) as shopping_wallet');
            $response['released_fund'] = $this->User_model->get_single_record('tbl_payment_request', 'user_id = "'.$this->session->userdata['user_id'].'" and status = 1', 'ifnull(sum(amount),0) as released_fund');
          //  $response['total_withdrawal'] = $this->User_model->get_single_record('tbl_withdraw', 'user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as total_withdrawal');
            $response['total_withdrawal'] = $this->User_model->get_single_record('tbl_money_transfer', "user_id = '".$this->session->userdata['user_id']."' and (status = 'SUCCESS' || status = 'ACCEPTED')", 'ifnull(sum(payable_amount),0) as total_withdrawal');
            $response['team_business'] = $this->User_model->get_single_record('tbl_downline_business', 'user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(business),0) as team_business');
            $response['package'] = $this->User_model->get_single_record('tbl_package', 'id = "'.$response['user']['package_id'].'"', '*');
            $response['directs'] = $this->User_model->get_records('tbl_users', 'sponser_id = "'.$response['user']['user_id'].'"', 'id,user_id,name,first_name,last_name,phone,paid_status,created_at');
            $response['news'] = $this->User_model->get_records('tbl_news',array(),'*');
            $response['roi_records'] = $this->User_model->get_limit_records('tbl_income_wallet', 'user_id = "'.$this->session->userdata['user_id'].'" and type = "roi_bonus"', '*',5,0);
           // pr($response,true);
            $response['team_unpaid'] = $this->User_model->calculate_team($this->session->userdata['user_id'],0);
            $response['team_paid'] = $this->User_model->calculate_team($this->session->userdata['user_id'],1);
            $response['popup'] = $this->User_model->get_single_record1('tbl_user_popup', '*');
            $response['reward'] = $this->User_model->get_records('tbl_rewards',['user_id' => $this->session->userdata['user_id']],'*');
            $response['leaders'] = $this->User_model->get_records('tbl_users',['leadership_status >' => 0, 'directs >= ' => 4, 'user_id !=' => '11111'],'id,user_id,name');
            //$response['coins'] = $this->get_coin_prices();
           
            $response['pool1'] = $this->User_model->get_single_record('tbl_pool',['user_id' => $this->session->userdata['user_id']],'team');
            $response['pool2'] = $this->User_model->get_single_record('tbl_pool2',['user_id' => $this->session->userdata['user_id']],'team');
            $response['pool3'] = $this->User_model->get_single_record('tbl_pool3',['user_id' => $this->session->userdata['user_id']],'team');
            $this->load->view('header', $response);
            $this->load->view('index', $response);
            // $this->load->view('footer', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    

    public function Referral() {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['today_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = '.$this->session->userdata['user_id'].' and date(created_at) = date(now()', 'ifnull(sum(amount),0) as today_income');
            $response['task_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = '.$this->session->userdata['user_id'].' and type = "task_income"', 'ifnull(sum(amount),0) as task_income');
            $response['direct_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'user_id = '.$this->session->userdata['user_id'].' and type = "direct_income"', 'ifnull(sum(amount),0) as direct_income');
            $this->load->view('header', $response);
            $this->load->view('refferal', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function sample() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('header', $response);
            $this->load->view('index', $response);
            $this->load->view('footer', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function login() {

        redirect('Dashboard/User/MainLogin');
    }
    public function MainLogin() {
        $response['message'] = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id'], 'password' => $data['password']), 'id,user_id,role,name,email,paid_status,disabled,email_verify');
            if (!empty($user)) {
                if ($user['disabled'] == 0) {
                    //if($user['email_verify'] == 1){
                      if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
                        $secretKey = '6Lch4JoeAAAAAO8qEA1Uhtw0rItnYk6PPwQ-58wx';
                        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']);
                        $responseData = json_decode($verifyResponse);
                        if($responseData){
                            $this->session->set_userdata('user_id', $user['user_id']);
                            $this->session->set_userdata('role', $user['role']);
                            redirect('Dashboard/User/');
                        }else{
                            $response['success'] = 0;
                            $response['message'] = 'Robot verification failed, please try again.';
                        }
                    }else{
                            $response['success'] = 0;
                            $response['message'] = 'Please check on the reCAPTCHA box.';
                    }    
                    // }else{
                    //     redirect('Dashboard/User/email_verify');
                    // }  
                } else {
                    $response['message'] = 'This Account Is Blocked Please Contact to Administrator';
                }
            } else {
                $response['message'] = 'Invalid Credentials';
            }
        }
        $this->load->view('main_login', $response);
    }


    public function  email_verify(){
        if($this->input->server("REQUEST_METHOD") == "POST"){
            $data = $this->security->xss_clean($this->input->post());
            $email  = $this->User_model->get_single_record('tbl_users',['email' =>$data['email']],'email,email_verify,user_id');
            if(!empty($email) && $data['email'] == $email['email']){
                $this->session->set_userdata('user_id', $email['user_id']);
                $this->User_model->update('tbl_users',['email' => $email['email']],['email_verify' => 1]);
                redirect('Dashboard/User/');
            }else{
                $this->session->set_flashdata('message','<span class="text-danger">Your Email Address does not matched!</span>');
                redirect('Dashboard/User/email_verify');
            }
        }
        $this->load->view('verify_mail');
    }

    public function Success() {
        $response['message'] = ' Now You Can Login with <br>User ID :kkk <br> Password :`1234';
        $this->load->view('success', $response);
    }

    public function universalpool() {
        if(is_logged_in()){
            $response['total'] = $this->User_model->get_single_record('tbl_universal_income',[],'ifnull(sum(amount),0) as total');
            $response['platinum'] = $this->User_model->get_single_record('tbl_users',['package_amount >=' =>2500],'ifnull(count(id),0) as ids');
            $response['Challanger'] = $this->User_model->get_single_record('tbl_users',['package_amount >=' =>4800],'ifnull(count(id),0) as ids');
            $response['Mastersx'] = $this->User_model->get_single_record('tbl_users',['package_amount >=' =>7500],'count(id) as ids');
            $response['GrandMaster'] = $this->User_model->get_single_record('tbl_users',['package_amount >=' =>10000],'ifnull(count(id),0) as ids');

            // $response['platinumAmount'] = $this->User_model->get_single_record('tbl_universal_income',['amount' =>2500],'ifnull(sum(amount),0) as total');
            // $response['ChallangerAmount'] = $this->User_model->get_single_record('tbl_universal_income',['amount' =>4800],'ifnull(sum(amount),0) as total');
            // $response['MasterAmount'] = $this->User_model->get_single_record('tbl_universal_income',['amount' =>7500],'ifnull(count(amount),0) as total');
            // $response['GrandMasterAmount'] = $this->User_model->get_single_record('tbl_universal_income',['amount' =>10000],'ifnull(sum(amount),0) as total');

            $response['distribute'] =  $response['total']['total']/4;
            // pr($response,true);
            $this->load->view('universalpool',$response);
        }else{
            redirect('Dashboard/User/login');
        }
        
    }

    public function emailtest(){
        $email = 'sksanjay.kumar@yahoo.in';
        $sms_text = 'Testing';
        sendMail($sms_text,$email);
    }
    
    public function sendEmail21($value='')
    {
        sendMail21('sunilgni123@gmail.com','Registration Alert',$mailData = 'test');
    }

    public function generateOtp()
    {

        if ($this->input->is_ajax_request()) {
                if ($this->input->server('REQUEST_METHOD') == 'GET') {
                    $email = trim(addslashes($_GET['email']));
                    $_SESSION['register_otp'] = rand(100000, 999999);
                    $this->session->mark_as_temp('register_otp', 300);
                    $message = 'You OTP is '.$this->session->userdata['register_otp'].' (One Time Password), this otp expire in 2 mintues!';
                    $data['info']['title'] = 'Email Verification OTP';
                    $data['info']['name'] = 'Register Email';
                    $data['info']['email'] = $email;
                    $data['info']['description'] = 'Please never share this OTP (one time password) With Anyone!';
                    $data['info']['message'] = $message;

                    $curlResponse = send_email($data);
                    pr($curlResponse);
                    if($message && $curlResponse['status'] == 'success'){
                        $response['success'] = 1;
                        $response['message'] = 'OTP send on Entred email id!';
                        
                    }else{
                        $response['success'] = 0;
                        $response['message'] = 'Please try again later!';
                    }
                }
            }else{
                $response['status'] = 0;
            }

            echo json_encode($response);
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
                                        "Email": "artisticuniversal@gmail.com",
                                        "Name": "Artistic Universal"
                                },
                                "To": [
                                        {
                                                "Email": "'.$email.'",
                                                "Name": "'.$name.'"
                                        }
                                ],
                                "Subject": "Registration Mail",
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

    private function level_income($sponser_id, $activated_id, $package_income) {
        $incomes = explode(',', $package_income);
        // $incomes = array(70,35,30,25,20,15,10,5,5);
        foreach ($incomes as $key => $income) {
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status');
            if (!empty($sponser)) {
                if ($sponser['paid_status'] == 1) {
                    $LevelIncome = array(
                        'user_id' => $sponser['user_id'],
                        'amount' => $income,
                        'type' => 'level_income',
                        'description' => 'Level Income from registration of Member ' . $activated_id . ' At level ' . ($key + 2),
                    );
                    $this->User_model->add('tbl_income_wallet', $LevelIncome);
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }

    function add_counts($user_name = 'DW56497', $downline_id = 'DW56497', $level) {
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
    public function user_downline(){
        $users = $this->User_model->get_records('tbl_users',[],'id,user_id,upline_id,sponser_id');
        foreach($users as $key => $user){

            $this->update_count($user['user_id'], $user['user_id'], 1);
        }
    }
    public function update_count($user_name, $downline_id, $level){
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
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
                $this->update_count($user_name, $downline_id, $level + 1);
            }
        }
    }


    public function logout() {
        $this->session->unset_userdata(array('user_id', 'role'));
        redirect('Dashboard/User/login');
    }

    public function Profile() {
        if (is_logged_in()) {
            $response = array();
            // $response['active_tab'] = 'profile';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['csrfName'] = $this->security->get_csrf_token_name();
                $response['csrfHash'] = $this->security->get_csrf_hash();
                $response['success'] = 0;
                $data = $this->security->xss_clean($this->input->post());
                $userDetail = $this->User_model->get_single_record('tbl_users',['user_id' => $this->session->userdata['user_id']],'paid_status');
                if($userDetail['paid_status'] == 0){
                    // $Userdata['name'] = $data['name'];
                    // $Userdata['last_name'] = $data['last_name'];
                    // $Userdata['address'] = $data['address'];
                    // $Userdata['postal_code'] = $data['postal_code'];
                    //$Userdata['phone'] = $data['phone'];
                    $get = $this->User_model->get_single_record('tbl_users',['user_id' => $this->session->userdata['user_id']],'city, email');
                    if(empty($get['city'])){
                        $Userdata['city'] = $data['city'];
                        $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), $Userdata);
                    }
                    if(empty($get['email'])){
                        $Userdata['email'] = $data['email'];
                        $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), $Userdata);
                    }

                    if (!empty($updres)) {
                        $this->session->set_flashdata('message','Details Updated Successfully');
                        $response['message'] = 'Details Updated Successfully';
                        $response['success'] = 1;
                    } else {
                        $this->session->set_flashdata('message','Please contact to the admin for more changes.');
                        $response['message'] = 'Please contact to the admin for more changes.';
                        // redirect('Dashboard/User/Profile');
                    }
                }else{
                    $this->session->set_flashdata('message','For Profile Update Please contact Admin');
                    $response['message'] = 'For Profile Update Please contact Admin';
                }
                echo json_encode($response);
                exit();
            }
            $userinfo = userinfo();
            $countries = $this->User_model->get_records('countries', array(), '*');
            $response['upline'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $userinfo->upline_id), 'name,first_name,last_name,phone,email');
            $response['user_bank'] = (object) $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
            // $response['stateArr'] = $this->User_model->get_records('states', array('country_id' => $userinfo->country), '*');
            // if (empty($userinfo->state)) {
            //     $state_id = $response['stateArr'][0]['id'];
            // } else {
            //     $state_id = $userinfo->state;
            // }
//            pr($userinfo, true);
            // $response['cityArr'] = $this->User_model->get_records('cities', array('state_id' => $state_id), '*');
            // $countryN = array();
            // $response['message'] = '';
            // foreach ($countries as $key => $country)
            //     $countryN[$country['id']] = $country['name'];
            // $response['countries'] = $countryN;
//            pr($response);
            $this->load->view('profile_update', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function bankProfile() {
        if (is_logged_in()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                //pr($data);
                $Userdata['btc'] = $data['btc'];
                $Userdata['tron'] = $data['tron'];
                $Userdata['ethereum'] = $data['ethereum'];
                $Userdata['litecoin'] = $data['litecoin'];
                $userInfo = $this->User_model->get_single_record('tbl_users',['user_id' => $this->session->userdata['user_id']],'paid_status');
                if($userInfo['paid_status'] == 0){
                    // $Userdata = [
                    //     'bank_name' => $data['bank_name'],
                    //     'account_holder_name' => $data['account_holder_name'],
                    //     'bank_account_number' => $data['bank_account_number'],
                    //     'ifsc_code' => $data['ifsc_code'],
                    //     'aadhar' => $data['aadhar'],
                    //     'pan' => $data['pan'],
                    // ];
                    $updres = $this->User_model->update('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), $Userdata);
                    if ($updres == true) {
                        $this->session->set_flashdata('message','Details Updated Successfully');
                        redirect('Dashboard/User/Profile');
                    } else {
                        $this->session->set_flashdata('message','There is an error while updating profile details Please try Again ..');
                        redirect('Dashboard/User/Profile');
                    }
                }else{
                    $response['message'] = 'For Profile Update Please contact Admin';
                }
            }
            redirect('Dashboard/User/Profile');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function password_reset(){
        if (is_logged_in()) {
            $response = array();
            $response['csrfName'] = $this->security->get_csrf_token_name();
            $response['csrfHash'] = $this->security->get_csrf_hash();
            $response['success'] = 0;
            $data = $this->security->xss_clean($this->input->post());
            $cpassword = $data['cpassword'];
            $npassword = $data['npassword'];
            $vpassword = $data['vpassword'];
            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,password');
            if ($npassword !== $vpassword) {
                $response['message'] = 'Verify Password Doed Not Match';
            } elseif ($cpassword !== $user['password']) {
                $response['message'] = 'Wrong Current Password';
            } else {
                $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), array('password' => $vpassword));
                if ($updres == true) {
                    $response['message'] = 'Password Updated Successfully';
                    $response['success'] = 1;
                } else {
                    $response['message'] = 'There is an error while Changing Password Please Try Again';
                }
            }
            echo json_encode($response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function btc_update(){
        if (is_logged_in()) {
            $response = array();
            $response['csrfName'] = $this->security->get_csrf_token_name();
            $response['csrfHash'] = $this->security->get_csrf_hash();
            $response['success'] = 0;
            $data = $this->security->xss_clean($this->input->post());
            $btc = $data['btc'];
            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,password');
            // if ($npassword !== $vpassword) {
            //     $response['message'] = 'Verify Password Doed Not Match';
            // } elseif ($cpassword !== $user['password']) {
            //     $response['message'] = 'Wrong Current Password';
            // } else {
                $updres = $this->User_model->update('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), array('btc' => $btc));
                if ($updres == true) {
                    $response['message'] = 'BTC Address Updated Successfully';
                    $response['success'] = 1;
                } else {
                    $response['message'] = 'There is an error while Updating BTC Address Please Try Again';
                }
            // }
            echo json_encode($response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function trans_password(){
        if (is_logged_in()) {
            $response = array();
            $response['csrfName'] = $this->security->get_csrf_token_name();
            $response['csrfHash'] = $this->security->get_csrf_hash();
            $response['success'] = 0;
            $data = $this->security->xss_clean($this->input->post());
            $cpassword = $data['cpassword'];
            $npassword = $data['npassword'];
            $vpassword = $data['vpassword'];
            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,master_key');
            if ($npassword !== $vpassword) {
                $response['message'] = 'Verify Password Doed Not Match';
            } elseif ($cpassword !== $user['master_key']) {
                $response['message'] = 'Wrong Current Password';
            } else {
                $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), array('master_key' => $vpassword));
                if ($updres == true) {
                    $response['message'] = 'Password Updated Successfully';
                    $response['success'] = 1;
                } else {
                    $response['message'] = 'There is an error while Changing Password Please Try Again';
                }
            }
            echo json_encode($response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function id_card(){
        if (is_logged_in()) {
            $response = array();
            $this->load->view('id_card', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function BankDetails() {
        if (is_logged_in()) {
            $response = array();
            $response = array();
            $response['csrfName'] = $this->security->get_csrf_token_name();
            $response['csrfHash'] = $this->security->get_csrf_hash();
            $response['success'] = 0;
            // if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $data = html_escape($data);
            $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('bank_account_number', 'Bank Account Number', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('ifsc_code', 'Ifsc Code', 'trim|required|xss_clean');
            if ($this->form_validation->run() != FALSE) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
                $config['max_size'] = 100000;
                $config['file_name'] = 'payment_slip1'.time();
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('userfile')) {
                    // $this->session->set_flashdata('error', $this->upload->display_errors());
                    $response['message'] = $this->upload->display_errors();
                } else {
                    $fileData = array('upload_data' => $this->upload->data());
                    $userData['passbook_image'] = $fileData['upload_data']['file_name'];
                    $userData['account_type'] = $data['account_type'];
                    $userData['bank_account_number'] = $data['bank_account_number'];
                    $userData['bank_name'] = $data['bank_name'];
                    $userData['account_holder_name'] = $data['account_holder_name'];
                    $userData['ifsc_code'] = $data['ifsc_code'];
                    $userData['pan'] = $data['pan'];
                    $userData['kyc_status'] = 1;
                    $updres = $this->User_model->update('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), $userData);
                    if ($updres == true) {
                        // $this->session->set_flashdata('error', 'Details Updated Successfully');
                        $response['message'] = 'Details Updated Successfully';
                        $response['success'] = 1;
                    } else {
                        // $this->session->set_flashdata('error', 'There is an error while updating Bank details Please try Again ..');
                        $response['message'] = 'Validation Failed 2';
                    }
                }
            }else{
                // $this->session->set_flashdata('error', 'Validation Failed');
                $response['message'] = 'Validation Failed';
            }
            // }
            echo json_encode($response);
            // $response['user_bank'] = (object) $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
            // $this->load->view('bank_details', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function UploadProof(){
        if (is_logged_in()) {
            $response = array();
            $response['csrfName'] = $this->security->get_csrf_token_name();
            $response['csrfHash'] = $this->security->get_csrf_hash();

            if (!empty($_FILES['userfile'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
                $config['max_size'] = 100000;
                $config['file_name'] = 'id_proof'.time();
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('userfile')) {
                    $response['message'] = $this->upload->display_errors();
                    // $this->session->set_flashdata('error', $this->upload->display_errors());
                    $response['success'] = '0';
                } else {
                    $type = $this->input->post('proof_type');
                    $fileData = array('upload_data' => $this->upload->data());
                    $userData[$type] = $fileData['upload_data']['file_name'];
                    $updres = $this->User_model->update('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), $userData);
                    if ($updres == true) {
                        $response['success'] = '1';
                        $response['image'] = base_url('uploads/').$fileData['upload_data']['file_name'];
                        $response['message'] = 'Proof Uploaded Successfully';
                    } else {
                        $response['success'] = '0';
                        $response['message'] = 'There is an error while updating Bank details Please try Again ..';
                    }
                }
            }else{
                $response['message'] = 'There is an error while updating Bank details Proof Please try Again ..';
                $response['success'] = '0';
            }
            echo json_encode($response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function PlaceParticipants() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Place Participants';
            $response['users'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $this->session->userdata['user_id'], 'is_placed' => 0), 'id,user_id,sponser_id,role,name,email,phone,upline_id,created_at');
            $this->load->view('place_participants', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function Directs() {
        if (is_logged_in()) {
            $export = $this->input->get('export');
            $where = ['sponser_id' => $this->session->userdata['user_id']];
            $response = array();
            $response['header'] = 'Direct Participants';
            $config['total_rows'] = $this->User_model->get_sum('tbl_users', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Dashboard/User/Directs';
            $config['suffix'] = '?'.http_build_query($_GET);
            $config ['uri_segment'] = 4;
            $config['per_page'] = 10;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['segment'] = $segment;
    
            $response['users'] = $this->User_model->get_limit_records('tbl_users', $where, 'id,user_id,sponser_id,role,name,last_name,email,paid_status,phone,upline_id,created_at,topup_date,package_amount,position,country_code',$config['per_page'], $segment);
            foreach ($response['users'] as $key => $user) {
                // $response['users'][$key]['bonus'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $user['user_id'] , 'amount > ' => 0 ), 'ifnull(sum(amount),0) as sum');
                $response['users'][$key]['directs'] = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $user['user_id'] , 'paid_status' => 1 ), 'ifnull(count(id),0) as directs')['directs'];
            }
            if($export){
                $records = '';
                $application_type = 'application/'.$export;
                $header = ['#','User ID', 'Name', 'Email', 'Phone','Position','Activation Date'];
                $users = $this->User_model->get_records('tbl_users',$where,'id,user_id,sponser_id,role,name,last_name,email,paid_status,phone,upline_id,created_at,topup_date,package_amount,position');
                $pakcage = [
                    '0' => 'No Position',
                    '20' => 'Dreamer',
                    '50' => 'Iron',
                    '120' => 'Bronze',
                    '240' => 'Silver',
                    '460' => 'Gold',
                    '1100' => 'Diamond',
                    '2500' => 'Platinum',
                    '4800' => 'Challanger',
                    '7500' => 'Matser',
                    '1000' => 'Grand Master',
                ];

                foreach ($users as $key => $record) {
                    
                   $records[$key]['i'] = ($key+1);
                   $records[$key]['user_id'] = $record['user_id'];
                   $records[$key]['name'] = $record['name'];
                   $records[$key]['email'] = $record['email'];
                   $records[$key]['phone'] = $record['phone'];
                   $records[$key]['position'] = $pakcage[$record['package_amount']];
                   $records[$key]['topup_date'] = $record['topup_date'];
                }
                $this->finalExport($export,$application_type,$header,$records);
            }

            $this->load->view('directs', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    // public function Downline($position = '') {
    //     if (is_logged_in()) {
    //         $response = array();
    //         $where['user_id'] = $this->session->userdata['user_id'];
    //         if($position != ''){
    //             $where['position'] = $position;
    //             if($position == 'L')
    //                 $response['header'] = 'Left Downline Participants';
    //             else
    //                 $response['header'] = 'Right Downline Participants';
    //         }else{
    //             $response['header'] = 'Downline Participants';
    //         }

    //         $response['users'] = $this->User_model->get_records('tbl_downline_count', $where, 'id,downline_id,level');
    //         foreach ($response['users'] as $key => $user) {
    //             $response['users'][$key]['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['downline_id']), 'id,user_id,sponser_id,role,name,email,phone,position,package_amount,paid_status,upline_id,created_at,topup_date');
    //         }
    //         $this->load->view('downline', $response);
    //     } else {
    //         redirect('Dashboard/User/login');
    //     }
    // }

    public function DownlineCount() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Partners';
            $response['levels'] = $this->User_model->count_level_directs($this->session->userdata['user_id']);
            foreach($response['levels'] as $key => $level){
                $response['levels'][$key]['active_team'] = $this->User_model->get_single_record('tbl_sponser_count', array('user_id' => $this->session->userdata['user_id'] , 'level' => $level['level'],'paid_status' => 1), 'ifnull(count(id),0) as active_team');
            }
            // pr($response,true);
            $this->load->view('downline_count', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

     public function Downline($level) {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Downline Participants';
            $response['users'] = $this->User_model->get_records('tbl_sponser_count', array('user_id' => $this->session->userdata['user_id'] , 'level' => $level), 'id,downline_id,level');
            foreach ($response['users'] as $key => $user) {
                $response['users'][$key]['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['downline_id']), 'id,user_id,sponser_id,role,name,email,phone,paid_status,upline_id,created_at,topup_date,package_amount');
                $response['users'][$key]['task'] = $this->User_model->get_single_record('tbl_task', 'user_id = "'.$user['downline_id'].'" AND date(created_at) = date(now())', 'tasks');
            }
            $this->load->view('downline', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function poolTeam() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Downline Participants';
            $response['users'] = $this->User_model->get_records('tbl_pool'," upline_id='".$this->session->userdata['user_id']."' || upline_id ='' group by org", '*,count(id) as level');
            $this->load->view('poolteam', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function poolview($level) {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Downline Participants';
            $response['users'] = $this->User_model->get_records('tbl_pool', array('upline_id' => $this->session->userdata['user_id'],'org' => $level), 'user_id');
            foreach ($response['users'] as $key => $user) {
                $response['users'][$key]['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), 'user_id,name,paid_status,sponser_id');
            }
            $this->load->view('poolteamview', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    // public function Downline() {
    //     if (is_logged_in()) {
    //         $response = array();
    //         $position = $this->input->get('position');
    //         $where['user_id'] = $this->session->userdata['user_id'];
    //         if($position != ''){
    //             $segment = 4;
    //             $where['position'] = $position;
    //             if($position == 'L')
    //                 $response['header'] = 'Left Downline Participants';

    //             else
    //                 $response['header'] = 'Right Downline Participants';
    //         }else{
    //             $response['header'] = 'Downline Participants';
    //             $segment = 4;
    //         }
    //         $config['total_rows'] = $this->User_model->get_sum('tbl_downline_count', $where, 'ifnull(count(id),0) as sum');
    //         $config['base_url'] = base_url() . 'Dashboard/User/Downline/';
    //         $config['suffix'] = '?'.http_build_query($_GET);
    //         $config ['uri_segment'] = $segment;
    //         $config['per_page'] = 20;
    //         $config['attributes'] = array('class' => 'page-link');
    //         $config['full_tag_open'] = "<ul class='pagination'>";
    //         $config['full_tag_close'] = '</ul>';
    //         $config['num_tag_open'] = '<li class="paginate_button page-item ">';
    //         $config['num_tag_close'] = '</li>';
    //         $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
    //         $config['cur_tag_close'] = '</a></li>';
    //         $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
    //         $config['prev_tag_close'] = '</li>';
    //         $config['first_tag_open'] = '<li class="paginate_button page-item">';
    //         $config['first_tag_close'] = '</li>';
    //         $config['last_tag_open'] = '<li class="paginate_button page-item next">';
    //         $config['last_tag_close'] = '</li>';
    //         $config['prev_link'] = 'Previous';
    //         $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
    //         $config['prev_tag_close'] = '</li>';
    //         $config['next_link'] = 'Next';
    //         $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
    //         $config['next_tag_close'] = '</li>';
    //         $this->pagination->initialize($config);
    //         $segment = $this->uri->segment($segment);
    //         //$response['total_income'] = $this->User_model->get_single_record('tbl_downline_count',$where, 'ifnull(sum(amount),0) as total_income');
    //         //$response['start'] = $start;
    //        // $response['end'] = $end;
    //         $response['segment'] = $segment;
    //         $response['path'] = 'Dashboard/User/Downline/'.$position;
    //         $response['users'] = $this->User_model->get_limit_records('tbl_downline_count', $where, '*', $config['per_page'], $segment);

    //         //$response['users'] = $this->User_model->get_records('tbl_downline_count', $where, 'id,downline_id,level');
    //         foreach ($response['users'] as $key => $user) {
    //             $response['users'][$key]['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['downline_id']), 'id,user_id,sponser_id,role,name,email,phone,position,package_amount,paid_status,upline_id,created_at,topup_date');
    //         }
    //         $this->load->view('downline', $response);
    //     } else {
    //         redirect('Dashboard/User/login');
    //     }
    // }




    // public function rightParticipants() {
    //     if (is_logged_in()) {
    //         $response = array();
    //         $response['header'] = 'Left Participants';
    //         $response['users'] = $this->User_model->get_records('tbl_user_positions', array('sponser_id' => $this->session->userdata['user_id'], 'position' => 'R'), 'id,user_id,sponser_id,upline_id,position');
    //         foreach ($response['users'] as $key => $user) {
    //             $response['users'][$key]['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), 'id,user_id,sponser_id,role,first_name,last_name,email,phone,upline_id,created_at');
    //         }
    //         $this->load->view('directs', $response);
    //     } else {
    //         redirect('Dashboard/User/login');
    //     }
    // }

    public function Income($type) {
        if (is_logged_in()) {
            $start = $this->input->get('start');
            $end = $this->input->get('end');
            $export = $this->input->get('export');
            $where = [
                'user_id' => $this->session->userdata['user_id'],
                'type' => $type,
            ];
            if(!empty($start)){
                $where['date(created_at) >='] = $start;
                $where['date(created_at) <='] = $end;
            }
            // if($type == 'level_income2'){
            //     $where['description like'] = '%Level Income from upgradation%';
            //     $where['type'] = 'level_income';
            // }
            // if($type == 'level_income'){
            //     $where['description like'] = '%Level Income from Activation%';
            // }
            $response['header'] = get_income_name($type);//ucwords(str_replace('_', ' ', $type));
            $config['total_rows'] = $this->User_model->get_sum('tbl_income_wallet', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Dashboard/User/Income/'.$type;
            $config['suffix'] = '?'.http_build_query($_GET);
            $config ['uri_segment'] = 5;
            $config['per_page'] = 10;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(5);
            $response['segment'] = $segment;
            $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet',$where, 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_limit_records('tbl_income_wallet', $where, '*', $config['per_page'], $segment);
            $response['start'] = $start;
            $response['end'] = $end;
            $response['path'] = 'Dashboard/User/Income/'.$type;
            // if($export){
            //     $records = '';
            //     $application_type = 'application/'.$export;
            //     $header = ['#','User ID', 'Amount', 'Description', 'Credit Date'];
            //     $users = $this->User_model->get_records('tbl_income_wallet',$where,'user_id,amount,type,description,created_at');

            //     foreach ($users as $key => $record) {
                    
            //        $records[$key]['i'] = ($key+1);
            //        $records[$key]['user_id'] = $record['user_id'];
            //        $records[$key]['amount'] = $record['amount'];
            //     //    $records[$key]['type'] = $record['type'];
            //        $records[$key]['description'] = $record['description'];
            //        $records[$key]['created_at'] = $record['created_at'];
            //     }
            //     $this->finalExport($export,$application_type,$header,$records);
            // }


            //$response['user_incomes'] = $this->User_model->get_records('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => $type), 'id,user_id,amount,type,description,created_at');
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function income_ledgar() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Income Ledgar';
            $start = $this->input->get('start');
            $end = $this->input->get('end');
            $export = $this->input->get('export');
            $where = ['user_id' => $this->session->userdata['user_id']];
            if(!empty($start)){
                $where['date(created_at) >='] = $start;
                $where['date(created_at) <='] = $end;
            }
            $config['total_rows'] = $this->User_model->get_sum('tbl_income_wallet', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Dashboard/User/income_ledgar/';
            $config['suffix'] = '?'.http_build_query($_GET);
            $config ['uri_segment'] = 4;
            $config['per_page'] = 10;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet',$where, 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_limit_records('tbl_income_wallet', $where, '*', $config['per_page'], $segment);
            if($export){
                $application_type = 'application/'.$export;
                $header = ['#','User ID', 'Amount', 'Type', 'Description', 'Date'];
                $users = $this->User_model->get_records('tbl_income_wallet',$where,'user_id,amount,type,description,created_at');
                foreach ($users as $key => $record) {
                    $records[$key]['i'] = ($key+1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['amount'] = $record['amount'];
                    $records[$key]['type'] = ucwords(str_replace('_',' ',$record['type']));
                    $records[$key]['description'] = $record['description'];
                    $records[$key]['created_at'] = $record['created_at'];
                }
                $this->finalExport($export, $application_type, $header,$records);
            }
            $response['start'] = $start;
            $response['end'] = $end;
            $response['path'] = 'Dashboard/User/income_ledgar/';
            // $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
            // $response['user_incomes'] = $this->User_model->get_records('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,amount,type,description,created_at');
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function RewardsStatus() {
        if (is_logged_in()) {
            $response = array();
            $rewards = array(
                1=> array('matching' => '2000' , 'bonus' => '100' , 'rank' => '' , 'status' => 1),
                2 => array('matching' => '6000' , 'bonus' => '200' , 'rank' => '' , 'status' => 1),
                3 => array('matching' => '16000' , 'bonus' => '500' , 'rank' => '' , 'status' => 1),
                4 => array('matching' => '36000' , 'bonus' => '1000' , 'rank' => '' , 'status' => 1),
                5 => array('matching' => '86000' , 'bonus' => '2000' , 'rank' => '' , 'status' => 1),
                6 => array('matching' => '186000' , 'bonus' => '6000' , 'rank' => '' , 'status' => 1),
                7 => array('matching' => '386000' , 'bonus' => '20000' , 'rank' => '' , 'status' => 1),
            );
            $response['rewards_income'] = $this->User_model->get_records('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'rewards_income'), '*');
            $response['rewards'] = $rewards;
            $this->load->view('rewards_status', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function Magicincome($type) {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Magic '.ucwords(str_replace('_', ' ', $type));
            $response['user_incomes'] = $this->User_model->get_records('tbl_repurchase_income', array('user_id' => $this->session->userdata['user_id'], 'type' => $type), 'id,user_id,amount,type,description,created_at');
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function Magicincome_ledgar() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Magic Income Ledgar';
            $response['total_income'] = $this->User_model->get_single_record('tbl_repurchase_income', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_records('tbl_repurchase_income', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,amount,type,description,created_at');
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function purchase_history() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Shopping History';
            $response['orders'] = $this->User_model->get_records('tbl_orders', array('user_id' => $this->session->userdata['user_id']), '*');
            $i = 0;
            $this->load->view('purchase_history', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Tree($user_id) {
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            $response['users'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            foreach($response['users'] as $key => $directs){
                $response['users'][$key]['sub_directs'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
            }
            $this->load->view('tree', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function GenelogyTree($user_id = '') {
        if (is_logged_in()) {
            $validate_user = 0;
            $response = array();
            if($user_id == ''){
                $user_id = $this->input->get('user_id');
            }
            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id');
            if(!empty($user)){
                if ($user_id == $this->session->userdata['user_id']) {
                    $validate_user = 1;
                } else {
                    $down_user = $this->User_model->get_single_record('tbl_downline_count', array('user_id' => $this->session->userdata['user_id'], 'downline_id' => $user_id), '*');
                    if (!empty($down_user)) {
                        $validate_user = 1;
                    }
                }
            }else{
                $validate_user = 0;
            }

            if ($validate_user == 1) {
                $response['validate_user'] = 1;
                $response['level1'] = $this->User_model->get_tree_user($user_id);
                if (!empty($response['level1'])) {
                    $response['level2'][1] = $this->User_model->get_tree_user($response['level1']->left_node);
                    $response['level2'][2] = $this->User_model->get_tree_user($response['level1']->right_node);
                    if (!empty($response['level2'][1]->left_node)) {
                        $response['level3'][1] = $this->User_model->get_tree_user($response['level2'][1]->left_node);
                        if (!empty($response['level3'][1]->left_node)) {
                            $response['level4'][1] = $this->User_model->get_tree_user($response['level3'][1]->left_node);
                        } else {
                            $response['level4'][1] = array();
                        }
                        if (!empty($response['level3'][1]->right_node)) {
                            $response['level4'][2] = $this->User_model->get_tree_user($response['level3'][1]->right_node);
                        } else {
                            $response['level4'][2] = array();
                        }
                    } else {
                        $response['level3'][1] = array();
                        $response['level4'][1] = array();
                        $response['level4'][2] = array();
                    }
                    if (!empty($response['level2'][1]->right_node)) {
                        $response['level3'][2] = $this->User_model->get_tree_user($response['level2'][1]->right_node);
                        if (!empty($response['level3'][2]->left_node)) {
                            $response['level4'][3] = $this->User_model->get_tree_user($response['level3'][2]->left_node);
                        } else {
                            $response['level4'][3] = array();
                        }
                        if (!empty($response['level3'][2]->right_node)) {
                            $response['level4'][4] = $this->User_model->get_tree_user($response['level3'][2]->right_node);
                        } else {
                            $response['level4'][4] = array();
                        }
                    } else {
                        $response['level3'][2] = array();
                        $response['level4'][3] = array();
                        $response['level4'][4] = array();
                    }
                    if (!empty($response['level2'][2]->left_node)) {
                        $response['level3'][3] = $this->User_model->get_tree_user($response['level2'][2]->left_node);
                        if (!empty($response['level3'][3]->left_node)) {
                            $response['level4'][5] = $this->User_model->get_tree_user($response['level3'][3]->left_node);
                        } else {
                            $response['level4'][5] = array();
                        }
                        if (!empty($response['level3'][3]->right_node)) {
                            $response['level4'][6] = $this->User_model->get_tree_user($response['level3'][3]->right_node);
                        } else {
                            $response['level4'][6] = array();
                        }
                    } else {
                        $response['level3'][3] = array();
                        $response['level4'][5] = array();
                        $response['level4'][6] = array();
                    }
                    if (!empty($response['level2'][2]->right_node)) {
                        $response['level3'][4] = $this->User_model->get_tree_user($response['level2'][2]->right_node);
                        if (!empty($response['level3'][4]->left_node)) {
                            $response['level4'][7] = $this->User_model->get_tree_user($response['level3'][4]->left_node);
                        } else {
                            $response['level4'][7] = array();
                        }
                        if (!empty($response['level3'][4]->right_node)) {
                            $response['level4'][8] = $this->User_model->get_tree_user($response['level3'][4]->right_node);
                        } else {
                            $response['level4'][8] = array();
                        }
                    } else {
                        $response['level3'][4] = array();
                        $response['level4'][7] = array();
                        $response['level4'][8] = array();
                    }
                } else {
                    $response['level1'] = [];
                }
                // $response['level2'][1]['placement'] = 0;
                // $response['level2'][2]['placement'] = 0;
                // $response['level3'][1]['placement'] = 0;
                // $response['level3'][4]['placement'] = 0;
                // $response['level4'][1]['placement'] = 0;
                // $response['level4'][8]['placement'] = 0;
                if (!empty($response['level2'][1])) {
                    if (!empty($response['level3'][1])) {
                        if (empty($response['level4'][1])) {
                            $response['level4'][1]['placement'] = 1;
                        }
                    } else {
                        $response['level3'][1]['placement'] = 1;
                    }
                } else {
                    $response['level2'][1]['placement'] = 1;
                }
                if (!empty($response['level2'][2])) {
                    if (!empty($response['level3'][4])) {
                        if (empty($response['level4'][8])) {
                            $response['level4'][8]['placement'] = 1;
                        }
                    } else {
                        $response['level3'][4]['placement'] = 1;
                    }
                } else {
                    $response['level2'][2]['placement'] = 1;
                }
            } else {
                $response['validate_user'] = 0;
            }

            // pr($response,true);
            $this->load->view('gonology-tree', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function Pool($user_id,$pool_id) {
        if (is_logged_in()) {
            $response = array();
            $response['pool_id'] = $pool_id;
            $response['user'] = $this->User_model->get_single_record('tbl_pool', array('user_id' => $user_id , 'pool_level' => $pool_id), '*');
            $response['users'] = $this->User_model->get_records('tbl_pool', array('upline_id' => $user_id, 'pool_level' => $pool_id), '*');
            foreach($response['users'] as $key => $directs){
                $response['users'][$key]['user_info'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
                $response['users'][$key]['level_2'] = $this->User_model->get_records('tbl_pool', array('upline_id' => $directs['user_id'], 'pool_level' => $pool_id), '*');
            }
//            pr($response,true);
            $this->load->view('pool', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Pool1($user_id) {
        if (is_logged_in()) {
            $response = array();
            // $response['pool_id'] = $pool_id;
            $response['user'] = $this->User_model->get_single_record('tbl_pool', array('user_id' => $user_id ), '*');
            $response['users'] = $this->User_model->get_records('tbl_pool', array('upline_id' => $user_id), '*');
            foreach($response['users'] as $key => $directs){
                $response['users'][$key]['user_info'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
                $response['users'][$key]['level_2'] = $this->User_model->get_records('tbl_pool', array('upline_id' => $directs['user_id']), '*');
            }
            $response['url'] = 'pool1';
//            pr($response,true);
            $this->load->view('pool1', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Pool2($user_id) {
        if (is_logged_in()) {
            $response = array();
            // $response['pool_id'] = $pool_id;
            $response['user'] = $this->User_model->get_single_record('tbl_pool2', array('user_id' => $user_id ), '*');
            $response['users'] = $this->User_model->get_records('tbl_pool2', array('upline_id' => $user_id), '*');
            foreach($response['users'] as $key => $directs){
                $response['users'][$key]['user_info'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
                $response['users'][$key]['level_2'] = $this->User_model->get_records('tbl_pool2', array('upline_id' => $directs['user_id']), '*');
            }
//            pr($response,true);
            $response['url'] = 'pool2';

            $this->load->view('pool1', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Pool3($user_id) {
        if (is_logged_in()) {
            $response = array();
            // $response['pool_id'] = $pool_id;
            $response['user'] = $this->User_model->get_single_record('tbl_pool3', array('user_id' => $user_id ), '*');
            $response['users'] = $this->User_model->get_records('tbl_pool3', array('upline_id' => $user_id), '*');
            foreach($response['users'] as $key => $directs){
                $response['users'][$key]['user_info'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $directs['user_id']), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
                $response['users'][$key]['level_2'] = $this->User_model->get_records('tbl_pool3', array('upline_id' => $directs['user_id']), '*');
            }
//            pr($response,true);
            $response['url'] = 'pool3';
            $this->load->view('pool1', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function Genelogy() {
        if (is_logged_in()) {
            $response = array();
            //$response['directs'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $this->session->userdata['user_id']), 'id,user_id,name,sponser_id');
            $response['directs'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $this->session->userdata['user_id']), 'id,user_id,name,sponser_id');
            $this->load->view('genelogy', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function genelogy_users($user_id) {
        if (is_logged_in()) {
            $response = array();
            $response['directs'] = $this->User_model->get_records('tbl_users', array('sponser_id' => $user_id), 'id,user_id,name,sponser_id');
            echo json_encode($response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function image_upload() {
        if (is_logged_in()) {
            $response = array();
            $data = $_POST['image'];
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);
            $imageName = time() . '.png';
            file_put_contents(APPPATH . '../uploads/' . $imageName, $data);
            $updres = $this->User_model->update('tbl_users', array('user_id' => $this->session->userdata['user_id']), array('image' => $imageName));
            $response['message'] = 'Image uploaed Succesffully';
            echo json_encode($response);
            exit();
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function get_states($country_id) {
        $countries = $this->User_model->get_records('states', array('country_id' => $country_id), '*');
        echo json_encode($countries);
    }

    public function get_city($state_id) {
        $countries = $this->User_model->get_records('cities', array('state_id' => $state_id), '*');
        echo json_encode($countries);
    }

    public function get_user($user_id) {
        $response = array();
        $response['success'] = 0;
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,sponser_id,role,name,first_name,last_name,email,phone,paid_status,created_at');
        if(!empty($user)){
            echo $user['name'];
        }else{
            echo 'User Not Found';
        }
    }

    public function test_rollup() {
        $this->rollup_personal_business($sponser_id = 'SG10008', $amount = '897', $share = 4, $sender_id = 'SG10015', 24);
    }

    public function credit_income($user_id, $amount, $type, $description) {
        $incomeArr = array(
            'user_id' => $user_id,
            'amount' => $amount,
            'type' => $type,
            'description' => $description,
        );
        $this->User_model->add('tbl_income_wallet', $incomeArr);
    }

    public function Validate_promo_code($code) {
        $res = array();
        $res['success'] = 0;
        $promo_code = $this->User_model->get_single_record('tbl_promo_codes', array('promo_code' => $code), '*');
        if (!empty($promo_code)) {
            $res['message'] = 'Promo Code Validated Now ' . $promo_code['discount'] . ' % Discount is Applied';
            $res['success'] = 1;
        } else {
            $res['message'] = 'Invalid Promo Code';
        }
        echo json_encode($res);
    }
    public function check_sponser($user_id) {
        $res = array();
        $res['success'] = 0;
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,name');
        if (!empty($user)) {
            $res['message'] = 'User Found';
            $res['user'] = $user;
            $res['success'] = 1;
        } else {
            $res['message'] = 'Invalid User ID';
        }
        echo json_encode($res);
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
    public function addBalance() {
        if (is_logged_in()) {
            $response = array();
            $user_id = $this->session->userdata['user_id'];
            $response['data_retrieve'] = $this->User_model->get_single_record('btc_txn', array('user_id' => $user_id, 'status' => 0), 'count(id) as ids');
            if ($response['data_retrieve']['ids'] > 0) {
                header('Location: ' . base_url() . 'Dashboard/User/payBalance');
            }
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] >= 2) {
//                    pr($data,true);
                    if ($data['coin'] != 'BTC' || $data['coin'] != 'ETH' || $data['coin'] != 'LTC' || $data['coin'] != 'BCH') {
                        $get = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'name,email');
                        $address = $this->Test($orignal = 'USD', $data['coin'], $user_id, $get['name'], $data['amount'], $get['email']);
                        if ($address['error'] == 'ok') {
                            $save['user_id'] = $user_id;
                            $save['txn_id'] = $address['result']['txn_id'];
                            $save['orignal_amount'] = $data['amount'];
                            $save['amount'] = $address['result']['amount'];
                            $save['address'] = $address['result']['address'];
                            $save['timeout'] = $address['result']['timeout'];
                            $save['checkout_url'] = $address['result']['checkout_url'];
                            $save['status_url'] = $address['result']['status_url'];
                            $save['qrcode_url'] = $address['result']['qrcode_url'];
                            $save['coin'] = $data['coin'];
                            $this->User_model->add('btc_txn', $save);
                            header('Location: ' . base_url() . '/Dashboard/User/payBalance');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Coin Error');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimum Amount $25');
                }
            }
            $this->load->view('addBalance', $response);
        }
    }
    public function payment_repsponse($tax_id){
            $payment = $this->User_model->get_single_record('btc_txn', array('txn_id' => $tax_id), 'user_id,coin,amount');
            $public_key = '6558f7dd0083c5493d87ced47b96a60d53b29fbe1e450a4c41b85a6d3f174c74';
            $private_key = '6dbACd8be6ade0ACDf622f1067275B2F8e0e76f8E1d9D93e0a4d3b00F437A2d0';
            $req['version'] = 1;
            $req['cmd'] = 'get_tx_info';
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
    }
    public function payBalance() {
        if (is_logged_in()) {
            $user_id = $this->session->userdata['user_id'];
            $response1['data_retrieve'] = $this->User_model->get_single_record('btc_txn', array('user_id' => $user_id, 'status' => 0), 'count(id) as ids');
            // pr($response1);
            if ($response1['data_retrieve']['ids'] == 0) {
                header('Location: ' . base_url() . 'Dashboard/User/addBalance');
            }
            $response['data_retrieve'] = $this->User_model->get_limit_records('btc_txn', array('user_id' => $user_id, 'status' => 0), '*', '1', '0');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['status'] == 3) {
                    $value['status'] = '3';
                    $updres = $this->User_model->update('btc_txn', array('user_id' => $user_id, 'status' => 0), $value);
                    header('Location: ' . base_url() . 'Dashboard/User/addBalance');
                }
            }
            $this->load->view('payBalance', $response);
        }
    }

    public function addBalanceHistory() {
        if (is_logged_in()) {
            $response = array();
            $response['requests'] = $this->User_model->get_records('btc_txn', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('addBalanceHistory', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    private function finalExport($export, $application_type, $header,$records){
        if (is_logged_in()) {
            if($export){
                $filename = $export.'Summary_'.time().'.'.$export;
                   header("Content-Description: File Transfer");
                   header("Content-Disposition: attachment; filename=$filename");
                   header("Content-Type: ".$application_type."");
                   $file = fopen('php://output', 'w');
                   $header = $header;
                   fputcsv($file, $header);

                       foreach ($records as $key => $line){
                            fputcsv($file,$line);
                       }

                   fclose($file);
                exit();
            }
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function Test($currency1, $currency2, $user_id, $name, $amount, $email) {
        $public_key = '6558f7dd0083c5493d87ced47b96a60d53b29fbe1e450a4c41b85a6d3f174c74';
        $private_key = '6dbACd8be6ade0ACDf622f1067275B2F8e0e76f8E1d9D93e0a4d3b00F437A2d0';

        // Set the API command and required fields
        $req['version'] = 1;
        $req['amount'] = $amount;
        $req['currency1'] = $currency1;
        $req['currency2'] = $currency2;
        $req['buyer_email'] = $email;
        $req['buyer_name'] = 'User ID ' . $user_id . ', Name ' . $name;
        $req['item_name'] = '' . $amount . ' USD Added Request';
        $req['cmd'] = 'create_transaction';
        $req['key'] = $public_key;
        $req['currency'] = $currency2;
        // $req['user_id'] = $user_id;
        $req['format'] = 'json'; //supported values are json and xml
        // Generate the query string
        $post_data = http_build_query($req, '', '&');

        // Calculate the HMAC signature on the POST data
        $hmac = hash_hmac('sha512', $post_data, $private_key);

        // Create cURL handle and initialize (if needed)
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        // Execute the call and close cURL handle
        $data = curl_exec($ch);
        $data2 = json_decode($data, true);
        // pr($data2,true);
        return $data2;
    }
    public function get_coins_prices(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://unl.finance/api/coin_stats",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDU3YTIxMGNkZGVkYjYwNGMwNDg2NWIxNjJhMjg5NmRhNDNlZGNlYmVlOWUwNmM1ZjZmNjExZDk0MDQzOTdlMTQxMTUwMzljMmI3MWNiNGEiLCJpYXQiOjE2MDA4Nzg4NjcsIm5iZiI6MTYwMDg3ODg2NywiZXhwIjoxNjMyNDE0ODY3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.ArmBCO2KkEg_A-vWkgfuNQlROCxzLYj7x4n2xI-e360BcMt3yDGJ2-4kvFj8P6d7mHBuC4X273UxnI_P1u_Q1-x_LzVDGBco9eKUig4ZR5vxYBNSl2eQ367MTvAQ-4fglzuDNSx_QoanYBYe0caCHZ6DuTD95gKVOB4Yn7zetyDdvDzXgizEUykN_P8NEVguebEYyWKaG51sQtOdxpLiDtKuWU8o1tNIO6Lu-dXv0kOIuwxjR-t4EJJ0t5hONZcTP61wsy6gkoAlbbMPI5ONh_YeZI1qwahnlIq57_lQdfl24SCT3mPE0tS1VdhZ7OQNXxUMSzDWvPOk6DYDGEcvT6oLnKoW4qqwCi8kifY87ClgOmnhR9e-6X7blKzZmjfiPxb0Xuv07RbvfI_cp8dlQ_q_yKWObOb32dJGLjyNiiqeLqfhZGGtXLv0fRxVS7VrHGJ9bOietxL6qVueF2ZGPv0kfu_FfpOKmPlf6zirbV42P1JGz1PtOnCG8xzIN_JIS-nNfZgb9syd18GqYIdEEIvYacgN90CYd4Y_ss108OjIB77dO7hlMGXEFgbkMXOCkWNIdhfb1OLJirg-0VI3X-0IUsQtjBciOKzHsWiSufXaqXNRkgF0Nu2h80aTIAYAfCdnTiWNI27zvQDAg_0qImESmrzUc437ZWN7CcfARbc",
            "cache-control: no-cache",
            "postman-token: 61ff1e31-6671-f1a7-dfc0-dabfd794949a"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        $coins = (json_decode($response,true));
        $html = '';
        foreach($coins['success'] as $key => $coin){
            $html .= '<li><i class="cc '.$coin['currency'].'"></i> '.$coin['currency'].' <span class="text-yellow"> $'.$coin['price'].'</span></li>';
        }
        echo $html;
        // echo $response;

        }
    }
    public function get_coin_prices(){
        $curl = curl_init();
        $html ='';
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.nomics.com/v1/currencies/ticker?key=demo-26240835858194712a4f8cc0dc635c7a&ids=BTC%2CETH%2CGAME%2CLBC%2CNEO%2CSTE%2CLIT%2CNOTE%2CMINT%2CIOT%2CDAS&interval=1d%2C30d&convert=USD",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "postman-token: 4982dc17-cbab-bbcc-6a85-8d1a16f9abb0"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
            // echo $response;
            $products = (json_decode($response,true));
            // pr($products);
            foreach($products  as $key => $data){
                $coins[$key]['currency'] = $data['currency'];
                $coins[$key]['name'] = $data['name'];
                $coins[$key]['logo_url'] = $data['logo_url'];
                $coins[$key]['price'] = $data['price'];
                $coins[$key]['price_date'] = $data['price_date'];
                // $coins[$key]['rank'] = $data['rank'];
                $coins[$key]['status'] = $data['status'];
                $html .= '<li><i class="cc '.$data['currency'].'"></i> '.$data['currency'].' <span class="text-yellow"> $'.$data['price'].'</span></li>';
            }
            // echo $html;
            return $coins;
        }
    }

    public function countryCode($id=''){
        $data = $this->User_model->get_single_record('countries',['name' => $id],'phonecode');
        echo json_encode($data);
    }
    // public function checkmail2(){
    //     $this->load->view('email');
    // }


    // public function checkmail(){
    //     $userData['name'] = 'manish';
    //     $userData['user_id'] = 'Admin';
    //     $userData['password'] = '13245';
    //     $userData['master_key'] = '7878';

    //      $sms_text = 'Dear ' .$userData['name']. ', Your Account Successfully created. User ID :  ' . $userData['user_id'] . ' Password :' . $userData['password'] . ' Transaction Password:' .$userData['master_key'];
    //     notify_mail_Reg('manishgni20@gmail.com' , $sms_text,'Registeration Mail');
    // }

    private function walletAddress(){
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
            return $response;
            // echo $response;
            

    }

    // public function testaddress(){
    //     $walletAdd = $this->walletAddress();
    //     echo $walletAdd.'<br>';
    //     $jsonD = json_decode($walletAdd,true);
    //     // pr($jsonD);
    //     echo 'address :'.$jsonD['account']['address'].'<br>';
    //     echo 'private_key : '.$jsonD['account']['private_key']; 

    // }
}
