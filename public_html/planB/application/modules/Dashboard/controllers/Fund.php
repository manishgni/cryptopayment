<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fund extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
    }

    public function Request_fund() {
        if (is_logged_in()) {
            $response = array();
            $response['none'] =1;

            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
           
  
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = 'payment_slip';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                } else {
                    $txn = $this->User_model->get_single_record('tbl_payment_request', array('transaction_id' => $data['txn_id']), '*');
                    if(empty($txn)){
                        $fileData = array('upload_data' => $this->upload->data());
                        $reqArr = array(
                            'user_id' => $this->session->userdata['user_id'],
                            'amount' => $data['amount'],
                            'payment_method' => $data['payment_method'],
                            'image' => $fileData['upload_data']['file_name'],
                            'status' => 0,
                            'transaction_id' => $data['txn_id'],
                        );
                        $res = $this->User_model->add('tbl_payment_request', $reqArr);
                        if ($res) {
                            $this->session->set_flashdata('message', 'Payment Request Submitted Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Submitting Payment Request Please Try Again ...');
                        }
                    }else{
                        $this->session->set_flashdata('message', ' Transaction ID Already Exists');
                    }
                }
            }
            $response['amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->set_userdata['user_id']), 'ifnull(sum(amount),0) as amount');
           
            $this->load->view('header', $response);
            $this->load->view('Fund/request_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function requests() {
        if (is_logged_in()) {
            $response = array();
            $response['requests'] = $this->User_model->get_records('tbl_payment_request', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('requests', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function transfer_history() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'fund_transfer'), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_history', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function wallet_ledger() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header');
            $this->load->view('wallet_ledger', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function activation_history() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id'],'type' => 'account_activation'), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id'],'type' => 'account_activation'), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header');
            $this->load->view('wallet_ledger', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function transfer_fund() {
      
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($data['user_id'] != $this->session->set_userdata['user_id']) {
                        $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                        if (!empty($receiver)) {
                            if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                $senderData = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$data['amount'],
                                    'sender_id' => $data['user_id'],
                                    'type' => 'fund_transfer',
                                    'remark' => $data['remark'],
                                );
                                $res = $this->User_model->add('tbl_wallet', $senderData);
                                if ($res) {
                                    $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                    $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                    $receiverData = array(
                                        'user_id' => $data['user_id'],
                                        'amount' => $data['amount'],
                                        'sender_id' => $this->session->userdata['user_id'],
                                        'type' => 'fund_transfer',
                                        'remark' => $data['remark'],
                                    );
                                    $this->User_model->add('tbl_wallet', $receiverData);
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Receiver Id');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is rs 0');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function shopping_wallet_transfer() {
      
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($data['user_id'] != $this->session->set_userdata['user_id']) {
                        $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                        if (!empty($receiver)) {
                            if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                $senderData = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$data['amount'],
                                    'sender_id' => $data['user_id'],
                                    'type' => 'fund_transfer',
                                    'remark' => $data['remark'],
                                );
                                $res = $this->User_model->add('tbl_wallet', $senderData);
                                if ($res) {
                                    $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                    $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                    $receiverData = array(
                                        'user_id' => $data['user_id'],
                                        'amount' => $data['amount'],
                                        'sender_id' => $this->session->userdata['user_id'],
                                        'type' => 'fund_transfer',
                                        'remark' => $data['remark'],
                                    );
                                    $this->User_model->add('tbl_shopping_wallet', $receiverData);
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Receiver Id');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is rs 0');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function token_wallet_transfer() {
      
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->set_userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($data['user_id'] != $this->session->set_userdata['user_id']) {
                        $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                        if (!empty($receiver)) {
                            if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                $senderData = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$data['amount'],
                                    'sender_id' => $data['user_id'],
                                    'type' => 'fund_transfer',
                                    'remark' => $data['remark'],
                                );
                                $res = $this->User_model->add('tbl_wallet', $senderData);
                                if ($res) {
                                    $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                    $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                    $receiverData = array(
                                        'user_id' => $data['user_id'],
                                        'amount' => $data['amount'],
                                        'sender_id' => $this->session->userdata['user_id'],
                                        'type' => 'fund_transfer',
                                        'remark' => $data['remark'],
                                    );
                                    $this->User_model->add('tbl_token_wallet', $receiverData);
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Receiver Id');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is rs 0');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function all_transactions() {
        if (is_logged_in()) {
            $response = array();
            $response['transactions'] = $this->User_model->get_records('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,amount,type,description,created_at');
            $this->load->view('all_transactions', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function withdraw_request() {
        if (is_logged_in()) {
            $response = array();
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
//            pr($response,true);
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($response['balance']['total_income'] >= $data['amount']) {
                        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'otp');
                        if ($user['otp'] == $data['otp']) {

                            $incomeArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$data['amount'],
                                'type' => 'withdraw_amount',
                                'description' => 'WIthdraw Amount',
                            );
                            $withdrawArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => $data['amount'],
                            );
                            $res = $this->User_model->add('tbl_income_wallet', $incomeArr);
                            $this->User_model->add('tbl_withdraw', $withdrawArr);
                            if ($res) {
                                $this->session->set_flashdata('message', 'Withdraw Request Submitted Successfully');
                                $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
                            } else {
                                $this->session->set_flashdata('message', 'Error While Requesting Withdraw Please Try Again ...');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Otp');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Maximum Transfer Amount is $' . $response['balance']['total_income']);
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Withdraw Amount is $0');
                }
            }
            $this->load->view('withdraw_request', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function withdraw_summary(){
        if (is_logged_in()) {
            $response = array();
            $response['withdraw_transctions'] = $this->User_model->get_records('tbl_withdraw', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as sum');
//            $this->load->view('header', $response);
            $this->load->view('withdraw_summary', $response);
//            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function depositHistory(){
        $user = $this->User_model->get_single_record('tbl_users',['user_id' =>$this->session->userdata['user_id']],'wallet_address');
        // pr($user);
        // echo $url = 'https://api.bscscan.com/api?module=account&action=tokentx&contractaddress=0x55d398326f99059ff775485246999027b3197955&address='.$user['wallet_address'];//&page=1&offset=15&startblock=0&endblock=999999999&sort=asc&apikey=3DCMAA1NNCXGB3CBX6ZMRWAINHESN56FJJ';
        // $url = 'https://api.bscscan.com/api?module=account&action=tokentx&contractaddress=0x55d398326f99059ff775485246999027b3197955&address='.$user['wallet_address'].'&page=1&offset=15&startblock=0&endblock=999999999&sort=asc&apikey=3DCMAA1NNCXGB3CBX6ZMRWAINHESN56FJJ';
        $url = 'https://api.trongrid.io/v1/accounts/'.$user['wallet_address'].'/transactions/trc20';
        // pr($url);
        // $url = 'https://api.bscscan.com/api?module=account&action=tokentx&contractaddress=0x55d398326f99059ff775485246999027b3197955&address=0xC22bE4C912Ca165Eea745122834B15C1879Fb05E&page=1&offset=15&startblock=0&endblock=999999999&sort=asc&apikey=3DCMAA1NNCXGB3CBX6ZMRWAINHESN56FJJ';
                $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
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
        //  echo $response;die;
        $jsonD = json_decode($response,true);
        
        // pr($jsonD['data'],true);
        if(!empty($jsonD['data'])){
            foreach($jsonD['data'] as $transaction){

                $check = $this->User_model->get_single_record('tbl_block_address',['timeStamp' => $transaction['block_timestamp']],'timeStamp');
                if(empty($check)){
                    // $addredArr  = [
                    //     'user_id' => $this->session->userdata['user_id'],
                    //     'timeStamp' => $transaction['block_timestamp'],
                    //     'hash' => $transaction['transaction_id'],
                    //     'blockHash' => $transaction['transaction_id'],
                    //     'from' => $transaction['from'],
                    //     'to' => $transaction['to'],
                    //     'value' => $transaction['value'] / 1000000,
                    //     'tokenName' => $transaction['token_info']['name'],
                    //     'tokenDecimal' => $transaction['token_info']['decimals'],
                    // ];
                    // $this->User_model->add('tbl_block_address',$addredArr);
                    // $senderData = array(
                    //     'user_id' => $this->session->userdata['user_id'],
                    //     'amount' =>$transaction['value']/ 1000000,
                    //     'sender_id' => $transaction['from'],
                    //     'type' => 'automatic_fund_deposit',
                    //     'remark' => 'Automatic fund deposit',
                    // );
                    // $res = $this->User_model->add('tbl_wallet', $senderData);
                }
            }
        // $check = $this->User_model->get_single_record('tbl_block_address',['timeStamp' => $jsonD['data'][0]['timeStamp']],'timeStamp');
        // if(empty($check)){
        //     $addredArr  = [
        //         'user_id' => $this->session->userdata['user_id'],
        //         'timeStamp' => $jsonD['result'][0]['block_timestamp'],
        //         'hash' => $jsonD['result'][0]['transaction_id'],
        //         'blockHash' => $jsonD['result'][0]['transaction_id'],
        //         'from' => $jsonD['result'][0]['from'],
        //         'to' => $jsonD['result'][0]['to'],
        //         'value' => $jsonD['result'][0]['value'],
        //         'tokenName' => $jsonD['result'][0]['token_info']['name'],
        //         'tokenDecimal' => $jsonD['result'][0]['token_info']['decimals'],
        //         // 'contractAddress' => $jsonD['result'][0]['contractAddress'],
        //         // 'tokenSymbol' => $jsonD['result'][0]['tokenSymbol'],
        //         // 'blockNumber' => $jsonD['result'][0]['blockNumber'],
        //         // 'transactionIndex' => $jsonD['result'][0]['transactionIndex'],
        //         // 'gas' => $jsonD['result'][0]['gas'],
        //         // 'gasPrice' => $jsonD['result'][0]['gasPrice'],
        //         // 'gasUsed' => $jsonD['result'][0]['gasUsed'],
        //         // 'cumulativeGasUsed' => $jsonD['result'][0]['cumulativeGasUsed'],
        //         // 'input' => $jsonD['result'][0]['input'],
        //         // 'confirmations' => $jsonD['result'][0]['confirmations'],
        //         // 'transfer_status' => $jsonD['result'][0]['transfer_status'],
        //     ];
        //     // pr($addredArr);
        //     $this->User_model->add('tbl_block_address',$addredArr);
        //     $senderData = array(
        //         'user_id' => $this->session->userdata['user_id'],
        //         'amount' => $jsonD['result'][0]['value']/ 1000000000000000000,
        //         'sender_id' => $jsonD['result'][0]['from'],
        //         'type' => 'automatic_fund_deposit',
        //         'remark' => 'Automatic fund deposit',
        //     );
        //     $res = $this->User_model->add('tbl_wallet', $senderData);
        // }
    }

        $response1['records'] = $this->User_model->get_records('tbl_block_address',['user_id' => $this->session->userdata['user_id']],'*');
        $this->load->view('depositHistory',$response1);
    }   


    public function airDropWithdraw(){
        if (is_logged_in()){
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('coin','Air Drop','trim|required|numeric');
                if($this->form_validation->run() != false){
                    $checkDate = $this->User_model->get_single_record('tbl_withdrawAirDrop','date(created_at) = date(now())','*');
                    $checkBalance = $this->User_model->get_single_record('tbl_coin_wallet',['user_id' => $this->session->userdata['user_id']],'ifnull(sum(coin),0) as balance');
                    if(empty($checkDate)){
                    if($checkBalance['balance'] >= $data['coin']){
                        if($data['coin'] == 100000){
                            $debit = [
                                'user_id' => $this->session->userdata['user_id'],
                                'coin' => -$data['coin'],
                                'type' => 'airdrop',
                                'description' => 'Withdraw Air Drop ',
                            ];
                            $this->User_model->add('tbl_coin_wallet', $debit);
    
                            $credit = [
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => $data['coin'],
                                'type' => 'airdrop',
                                'remark' => ' WIthdraw Air Drop',
                            ];
                            $res = $this->User_model->add('tbl_withdrawAirDrop', $credit);
                            if ($res) {
                                $this->session->set_flashdata('message', '<span class ="text-success">Withdraw Request Submitted Successfully</span>');
                            } else {
                                $this->session->set_flashdata('message', '<span class ="text-danger">Error While Requesting AirDrop Withdraw Please Try Again ...</span>');
                            }
                          
                        } else {
                            $this->session->set_flashdata('message', '<span class ="text-danger">Minimum & Maximum Withdraw Air Drop  is 100000</span>');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<span class ="text-danger">Insuffcient Air Drop</span>');
                    }
                }else{
                    $this->session->set_flashdata('message','<span class ="text-danger">You Can Withdraw Only Once in a Day</span>');
                }
                }else{
                    $this->session->set_flashdata('message','<span class ="text-danger">'.validation_errors().'</span>');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_coin_wallet',['user_id' => $this->session->userdata['user_id']],'ifnull(sum(coin),0) as balance');
            $this->load->view('airWithdraw',$response);
        }else {
            redirect('Dashboard/User/login');
        }
    }


}
