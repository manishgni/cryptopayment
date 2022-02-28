<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Token extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('app_model'));
        $this->load->helper(array('security','app'));
    }

    public function index(){
        if(is_user()){
            $response['walletreceive'] = $this->app_model->get_single_record('tbl_token_wallet',['user_id' => $this->session->userdata['user_id'],'amount >' => 0],'ifnull(sum(amount),0) as balance');
            $response['tokenIncome'] = $this->app_model->get_single_record('tbl_income_wallet',['user_id' => $this->session->userdata['user_id'] ,'type' => 'level_token_income'],'ifnull(sum(amount),0) as tokenIncome');
            $response['transaction'] = $this->app_model->get_records('tbl_token_wallet',['user_id' => $this->session->userdata['user_id']],'amount,remark,created_at');
            $response['token_price'] = $this->app_model->get_single_record('tbl_token_value',['id' => 1],'amount');
            $this->load->view('index',$response);
        }else{
            redirect('App/Token/login');
        }
    }

    public function sendtoken(){
        if(is_user()){
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('wallet_id','Wallet ID','trim|required');
                $this->form_validation->set_rules('amount','Amount','trim|required');
                if($this->form_validation->run() != false){
                    $user = $this->app_model->get_single_record('tbl_users',['wallet_id' => $data['wallet_id']],'wallet_id,user_id');
                    $self = $this->app_model->get_single_record('tbl_users',['user_id' => $this->session->userdata['user_id']],'wallet_id,user_id');
                    if(!empty($user['wallet_id'])){
                        if($user['wallet_id'] == $data['wallet_id']){
                            $balance = $this->app_model->get_single_record('tbl_token_wallet',['user_id' => $this->session->userdata['user_id']],'ifnull(sum(amount),0) as balance');
                            if($balance['balance'] >= $data['amount']){
                                $debit = [
                                    'user_id' => $this->session->userdata['user_id'],
                                    'wallet_id' => $self['wallet_id'],
                                    'amount' => -abs($data['amount']),
                                    'type' => 'amount_transfer',
                                    'sender_id' => $user['user_id'],
                                    'remark' => 'Token Transfer to '.$user['wallet_id'],
                                ];
                                $this->app_model->add('tbl_token_wallet',$debit);
                                $credit = [
                                    'user_id' => $user['user_id'],
                                    'wallet_id' => $data['wallet_id'],
                                    'amount' => abs($data['amount']),
                                    'type' => 'amount_receive',
                                    'sender_id' => $this->session->userdata['user_id'],
                                    'remark' => 'Token Receive from '.$self['wallet_id'],
                                ];
                                $res = $this->app_model->add('tbl_token_wallet',$credit);
                                if($res){
                                    $this->session->set_flashdata('message','Fund Transferred successfully');
                                }else{
                                    $this->session->set_flashdata('message','Network error,Please try later');
                                }
                            }else{
                                $this->session->set_flashdata('message','Insufficient balance');
                            }
                        }else{
                            $this->session->set_flashdata('message','Please enter valid Wallet ID');
                        }
                    }else{
                        $this->session->set_flashdata('message','Please enter valid Wallet ID');
                    }
                }else{
                    $this->session->set_flashdata('message',validation_errors());
                }
            }
            $response['balance'] = $this->app_model->get_single_record('tbl_token_wallet',['user_id' => $this->session->userdata['user_id']],'ifnull(sum(amount),0) as balance');
            $this->load->view('income_transfer',$response);
        }else{
            redirect('App/Token/login');
        }
    }

    public function receiveTokenHistory(){
        if (is_user()) { 
           $response['header'] = 'Receive Fund History';
           $response['data'] = $this->app_model->get_records('tbl_token_wallet',['amount >' => 0 , 'user_id' => $this->session->userdata['user_id']],'*');
           $response['amount'] = $this->app_model->get_single_record('tbl_token_wallet',['user_id' => $this->session->userdata['user_id'],'amount >' => 0],'ifnull(sum(amount),0) as balance');
           $this->load->view('walletHistory',$response);
        }else{
            redirect('App/Token/login');
        }
    }
	
	public function income(){
        if (is_user()) { 
           $response['header'] = 'Token Level Income';
           $response['data'] = $this->app_model->get_records('tbl_income_wallet',['user_id' => $this->session->userdata['user_id'] ,'type' => 'level_token_income'],'*');
           $response['amount'] = $this->app_model->get_single_record('tbl_income_wallet',['user_id' => $this->session->userdata['user_id'] ,'type' => 'level_token_income'],'ifnull(sum(amount),0) as balance');

		   $this->load->view('incomeHistory',$response);
        }else{
            redirect('App/Token/login');
        }
    }

    public function SendTokenHistory(){
        if (is_user()) { 
           $response['header'] = 'Send Fund History';
           $response['data'] = $this->app_model->get_records('tbl_token_wallet',['amount <' => 0,'user_id' => $this->session->userdata['user_id']],'*');
           $response['amount'] = $this->app_model->get_single_record('tbl_token_wallet',['user_id' => $this->session->userdata['user_id'],'amount <' => 0],'ifnull(sum(amount),0) as balance');
           $this->load->view('walletHistory',$response);
        }else{
            redirect('App/Token/login');
        }
    }

    public function purchaseToken(){
        if (is_user()) { 
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount','Amount','trim|required');
                if($this->form_validation->run() != false){
                    redirect('App/Token/coinbaseGateway/'.$data['amount']);
                }
            }
            $this->load->view('purchasetoken');
        }else{
            redirect('App/Token/login');
        }
    }

    public function coinbaseGateway($amt){
		if (is_user()) {
            $token = $this->app_model->get_single_record('tbl_token_value', array(), '*');
            $data = $this->security->xss_clean($this->input->post());
            $user_id = $this->session->userdata['user_id'];
            $user = $this->app_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,name,email');
            $amount = $token['amount']*$amt;
            $email = $user['email'];
            $curl = curl_init();
            $params = new stdClass();
            $params->name = $user['user_id'];
            $params->description = 'Token Purchase';

            $local_price = new stdClass();
            $local_price->amount = $amount;

            $local_price->currency = 'USD';
            $params->local_price = $local_price;
            $params->pricing_type = 'fixed_price';
            $params->requested_info = ['email'];
            // echo json_encode($params);


            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.commerce.coinbase.com/checkouts",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($params),
                CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "X-CC-Api-Key: 390d9895-93d0-4b73-af18-78f0d578f524",
                "X-CC-Version: 2018-03-22",
                "Cookie: __cfduid=da062b513a9ad4c1d0c77a2a7d01979841606206538"
                ),
            ));

            $response = json_decode(curl_exec($curl),true);
            $response['package'] = $amt;
            $this->app_model->add('tbl_coinbase_transactions', ['user_id' => $user_id , 'checkout' => $response['data']['id'],'data' => $amt,'trans_type' => '2']);
            curl_close($curl);
            $response['amount'] = $amount;
            $response['token'] = $token['amount'];
            $this->load->view('addBalanceCoinBase', $response);
		} else {
            redirect('App/Token/login');
        }
	}

    public function login(){
        if(is_user()){
            redirect('App/Token');
            exit(); 
        }
        if($this->input->server("REQUEST_METHOD") == "POST"){
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('user_id','User ID','trim|required');
            $this->form_validation->set_rules('password','Password','trim|required');
            if($this->form_validation->run() != false){
                $user = $this->app_model->get_single_record('tbl_users',['user_id' => $data['user_id'],'password' => $data['password'],'paid_status' => '1'],'user_id');
                if(!empty($user['user_id']) && strtolower($user['user_id']) == strtolower($data['user_id'])){
                    $this->session->set_userdata('user_id',$user['user_id']);
                    $this->session->set_userdata('is_user',true);
                    redirect('App/Token');
                }else{
                    $this->session->set_flashdata('message','Invalid credentials');
                }
            }else{
                $this->session->set_flashdata('message',validation_errors());
            }
        }
        $this->load->view('login');
    }

    public function logout(){
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('is_user');
        redirect('App/Token/login');
    }

    public function sellToken(){
        if (is_user()) {
            $response['header'] = 'Sell Token';
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount','Amount','trim|required');
                if($this->form_validation->run() != false){
                    $tokenValue = $this->app_model->get_single_record('tbl_token_value',[],'amount');
                    $balance = $this->app_model->get_single_record('tbl_income_wallet',"user_id = '".$this->session->userdata['user_id']."' and (type = 'level_token_income' || type = 'withdraw_token')",'ifnull(sum(amount),0) as balance');
                    if($balance['balance'] >= $data['amount']){
                        $debit = [
                            'user_id' => $this->session->userdata['user_id'],
                            'amount'  => -abs($data['amount']),
                            'type' => 'withdraw_token',
                            'description' => 'Withdraw Token',
                        ];
                        $this->app_model->add('tbl_income_wallet',$debit);
                        $credit = [
                            'user_id' => $this->session->userdata['user_id'],
                            'amount'  => abs($data['amount']*$tokenValue['amount']),
                            'type' => 'withdraw_token',
                            'remark' => 'Withdraw Token',
                        ];
                        $res = $this->app_model->add('tbl_withdraw',$credit);
                        if($res){
                            $this->session->set_flashdata('message','Sell Token successfully');
                        }else{
                            $this->session->set_flashdata('message','Network error,please try later');
                        }
                    }else{
                        $this->session->set_flashdata('message','Insufficient balance');
                    } 
                }else{
                    $this->session->set_flashdata('message',validation_errors());
                }    
            }
            $response['balance'] = $this->app_model->get_single_record('tbl_income_wallet',"user_id = '".$this->session->userdata['user_id']."' and (type = 'level_token_income' || type = 'withdraw_token')",'ifnull(sum(amount),0) as balance');
            $this->load->view('sellToken',$response);    
        }else {
            redirect('App/Token/login');
        }
    } 
    
    public function selltokenHidtory(){
        if (is_user()) { 
            $response['header'] = 'Sell Token History';
            $data = $this->app_model->get_records('tbl_withdraw',['user_id' => $this->session->userdata['user_id']],'*');
            $response['amount'] = $this->app_model->get_single_record('tbl_withdraw',['user_id' => $this->session->userdata['user_id']],'ifnull(sum(amount),0) as balance');
            //print_r($response);
            $tbody = [];
            $response['thead'] = ['#','Amount','Status','Date'];
            foreach($data as $key => $d){
               $tbody[] = '<tr>
                    <td>'.($key+1).'</td>
                    <td>'.$d['amount'].'</td>
                    <td>'.$d['status'].'</td>
                    <td>'.$d['created_at'].'</td>
                </tr>';
            }
            $response['tbody'] = $tbody; 
            $this->load->view('table',$response);
         }else{
             redirect('App/Token/login');
         }
    }


}
?>
