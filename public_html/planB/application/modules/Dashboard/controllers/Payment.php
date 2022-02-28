<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        date_default_timezone_set('Asia/Kolkata');
        $this->public_key = public_key;
        $this->private_key = private_key;
        if (is_logged_in() === false) {
            redirect('Dashboard/User/logout');
        }
    }

    public function index2(){
        $response['header'] = 'Request Fund';
        if($this->input->server('REQUEST_METHOD') == "POST"){
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('amount','Amount','trim|required');
            if($this->form_validation->run() != false){
                $userInfo = $this->User_model->get_single_record('tbl_users',['user_id' => $this->session->userdata['user_id']],'email');

                $response['data'] = [
                    'amount' => $data['amount'],
                    'currency' => $data['currency'],
                    'buyer_email' => (!empty($userInfo['email']) ? $userInfo['email']:'test@gmail.com'),
                ];
                $this->load->view('create_transaction',$response);
            }else{
                $this->load->view('coinbase',$response); 
            }
        }else{
            $this->load->view('coinbase',$response);
        }
    }

    public function index(){
        $response['header'] = 'Request Fund';
        if($this->input->server('REQUEST_METHOD') == "POST"){
            $data1 = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('amount','Amount','trim|required');
            $this->form_validation->set_rules('currency','Currency','trim|required');
            if($this->form_validation->run() != false){
                $userInfo = $this->User_model->get_single_record('tbl_users',['user_id' => $this->session->userdata['user_id']],'user_id,email');
                if(!empty($userInfo)){
                    $cmd = 'create_transaction';
                    $public_key = $this->public_key;
                    $private_key = $this->private_key;
                    $req['version'] = 1;
                    $req['cmd'] = $cmd;
                    $req['key'] = $public_key;
                    $req['amount'] = $data1['amount'];
                    $req['currency1'] = 'USD';
                    $req['currency2'] = $data1['currency'];
                    $req['buyer_email'] = (!empty($userInfo['email']) ? $userInfo['email']:'test@gmail.com');
                    $req['buyer_name'] = $userInfo['user_id'];
                    $req['item_name'] = $userInfo['user_id'];
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
                    //pr($data,true);
                    if ($data !== FALSE) {
                        $data = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
                        if(!empty($data['result']['txn_id'])){
                            $send = [
                                'transaction_id' => $data['result']['txn_id'],
                                'checkout_url' => $data['result']['checkout_url'],
                                'status_url' => $data['result']['status_url'],
                                'qrcode_url' => $data['result']['qrcode_url'],
                            ];
                            $this->User_model->add('BTC_TRANSACTION',$send);
                            
                            $response['currency'] = $data1['currency'];
                            $response['data'] = $data;
                            $this->load->view('create_transaction2',$response);
                        }else{
                            $response['currency'] = $data1['currency'];
                            $response['data'] = $data;
                            if(empty($data['result'])){
                                $this->session->set_flashdata('message', $data['error']);
                            } else {
                                $this->session->set_flashdata('message', 'Try later');
                            }
                            $this->load->view('coinbase',$response); 
                        }
                    }
                }
                
            }else{
                $this->load->view('coinbase',$response); 
            }
        }else{
            $this->load->view('coinbase',$response);
        }
    }

    public function coinPaymentChecknew(){
        die;
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
            $b_transaction = $this->User_model->get_single_record('BTC_TRANSACTION', array('transaction_id' => $d), '*');
            if(empty($b_transaction)){
                $this->getinfo22('get_tx_info', $d);
            }else{
                $this->getinfo33('get_tx_info', $d);
            }
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
        $this->User_model->add('BTC_TRANSACTION',$send);
        if($send['status'] == 100){
            $amountArr = array('user_id' => $send['first_name'] ,'amount' => $send['amountf'],'transaction_id' => $send['transaction_id']);
            $this->User_model->add('tbl_wallet', $amountArr);
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
        $check = $this->User_model->get_single_record('BTC_TRANSACTION',['transaction_id' => $tax_id],'*');
        if($check['status'] != 100){
            $this->User_model->update('BTC_TRANSACTION',['transaction_id' => $tax_id],$send);
        }
    }

    public function paymentTransaction(){
        $response['request'] = $this->User_model->get_records('BTC_TRANSACTION',['first_name' => $this->session->userdata['user_id']],'*');
        $this->load->view('paymentTransaction',$response);
    }
}
?>