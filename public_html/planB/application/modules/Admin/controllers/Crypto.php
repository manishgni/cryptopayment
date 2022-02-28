<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Crypto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            if (empty($where[$field])){
                $where = array();
                // $config['base_url'] = base_url() . 'Admin/Withdraw/index/';
            }
            // else{
                // $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            // }
            
            $config['base_url'] = base_url() . 'Admin/Crypto/index';
            $config['suffix'] = '?'.http_build_query($_GET);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_block_address', $where, 'ifnull(count(id),0) as sum');
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
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $response['transactions'] = $this->Main_model->get_limit_records('tbl_block_address', $where, '*', $config['per_page'], $segment);
            $this->load->view('crypto_transactions', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function pending_usdt_users() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            if (empty($where[$field])){
                $where = array();
                // $config['base_url'] = base_url() . 'Admin/Withdraw/index/';
            }
            // else{
                // $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            // }
            $where['usdt > '] = 0;
            $config['base_url'] = base_url() . 'Admin/Crypto/pending_usdt_users';
            $config['suffix'] = '?'.http_build_query($_GET);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_users', $where, 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 50;
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
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $response['users'] = $this->Main_model->get_limit_records('tbl_users', $where, '*', $config['per_page'], $segment);
            $this->load->view('pending_usdt_users', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function wrong_usdt_transactions() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            if (empty($where[$field])){
                $where = array();
                // $config['base_url'] = base_url() . 'Admin/Withdraw/index/';
            }
            // else{
                // $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            // }
            // $where['usdt > '] = 0;
            $config['base_url'] = base_url() . 'Admin/Crypto/wrong_usdt_transactions';
            $config['suffix'] = '?'.http_build_query($_GET);
            // $config['total_rows'] = $this->Main_model->get_sum('tbl_users', $where, 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 50;
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
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['users'] = $this->Main_model->wrong_usdt_transactions();

            $response['total_records'] =count($response['users']);
            // foreach($response['users'] as $user){
            //       $senderData = array(
            //             'user_id' => $user['user_id'],
            //             'amount' => -$user['value'],
            //             'sender_id' => 'admin',
            //             'type' => 'automatic_fund_reverse',
            //             'remark' => 'Automatic fund Reverse',
            //         );
            //         $res = $this->Main_model->add('tbl_wallet', $senderData);
            // }
            $this->load->view('wrong_usdt_transactions', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function Transaction($transaction_id){
        if (is_admin()) {
            $response['transaction'] = $this->Main_model->get_single_record('tbl_block_address', array('hash' => $transaction_id), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($response['request']['status'] != 0) {
                    $this->session->set_flashdata('message', 'Status of this request already updated!');
                } else {
                    if ($data['status'] == 1) {
                        $wArr = array(
                            'status' => 1,
                            'remark' => $data['remark'],
                        );
                        $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                        if ($res) {
                            $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['request']['user_id']), 'user_id,area_code');
                            $investMentArr = array(
                                'user_id' => $response['request']['user_id'],
                                'amount' => $response['request']['amount'],
                                'mode' => 'get',
                                'area_code' => $user['area_code'],
                            );
                            $this->Main_model->add('tbl_investment', $investMentArr);
                            $this->session->set_flashdata('message', 'Withdraw request approved');
                        } else {
                            $this->session->set_flashdata('message', 'Error while Rejecting WithdraW');
                        }
                    } elseif ($data['status'] == 2) {
                        $wArr = array(
                            'status' => 2,
                            'remark' => $data['remark'],
                        );
                        $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                        if ($res) {
                            $productArr = array(
                                'user_id' => $response['request']['user_id'],
                                'amount' => $response['request']['amount'],
                                'type' => $response['request']['type'],
                                'description' => 'Working Withdraw Refund',
                            );
                            $this->Main_model->add('tbl_income_wallet', $productArr);
                            $this->session->set_flashdata('message', 'Withdraw request rejected');
                        } else {
                            $this->session->set_flashdata('message', 'Error while Rejecting WithdraW');
                        }
                    }
                }
            }
            $response['user_details'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['transaction']['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
            $this->load->view('crypto_transaction', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function update_tron_balance($offset){
        $where = ['tbl_users.tron <' => 10 , 'tbl_users.usdt >' => 1]; 
        $users = $this->Main_model->pending_crypto_transactions($where,$limit = 100 , $offset);
        // pr($users,true);
        foreach($users as $k => $user){
            echo $url = 'wallet_address='.$user['wallet_address'];
            echo '<br>';
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://176.58.124.217:3000/check_trx_balance',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $url,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response,true);
            if($response['success'] == 1){
                echo $user['user_id'] . ' balance ' . $response['balance'] . '<br>';
                $this->Main_model->update('tbl_users', array('user_id' => $user['user_id']), ['tron' => $response['balance']]);
            }
            curl_close($curl);
            // echo $response .'<br>';
        }
    }

    public function deposit_tron($limit){
        $where = ['tbl_users.tron <' => 10 , 'tbl_users.usdt >' => 1]; 
        
        $users = $this->Main_model->pending_crypto_transactions($where,$limit = 100 , $offset);
        foreach($users as $k => $user){
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://176.58.124.217:3000/deposit_trx',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'to='.$user['wallet_address'].'&amount=6',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response,true);
            if($response['success'] == 1){
                echo $user['user_id']. '<br>';
                
            }
            curl_close($curl);
            // echo $response .'<br>';
        }
    }
    public function check_usdt_balance($offset){
        $where = []; 
        $users = $this->Main_model->tronTransactionUsers($where,$limit = 100 , $offset);

        foreach($users as $k => $user){ 
            $curl = curl_init();
             $post_fields = 'wallet_address='.$user['wallet_address'].'&private_key='.$user['private_key'];
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://176.58.124.217:3000/check_usdt_balance',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $post_fields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;
            $response = json_decode($response,true);
            if($response['success'] == 1){
                echo $user['user_id'] . ' balance ' . $response['balance'] . '<br>';
                $this->Main_model->update('tbl_users', array('user_id' => $user['user_id']), ['usdt' => $response['balance']]);
            }
            // echo $response .'<br>';
        }
    }
    public function debit_usdt(){
        $where = ['tbl_block_address.transfer_status' => 0, 'tbl_users.tron >=' => 10]; 
        $users = $this->Main_model->pending_crypto_transactions($where,100,0);
        foreach($users as $k => $user){ 
            $curl = curl_init();
            echo $post_fields = 'from='.$user['wallet_address'].'&private_key='.$user['private_key'].'&amount='.$user['usdt'];
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://176.58.124.217:3000/debit_admin_usdt',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $post_fields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response,true);
            pr($response);
            if($response['success'] == 1){
                echo 'user id ' . $user['user_id'] . ' transaction id ' . $user['id'];
                $this->Main_model->update('tbl_block_address', array('id' => $user['id']), ['transfer_status' => 1 , 'admin_tx_id' => $response['receipt']['txid']]);
            }
            // echo $response .'<br>';
        }
    }
    public function clear_withdraw(){
        // die;
        $where = ['status' => 1, 'admin_status' => 0,'trust_wallet_address !=' => '']; 
        $withdraw_reqeusts = $this->Main_model->get_records('tbl_withdraw',$where,'*');
        pr($withdraw_reqeusts);
        foreach($withdraw_reqeusts as $k => $request){ 
            $curl = curl_init();
            echo $post_fields = 'wallet_address='.$request['trust_wallet_address'].'&amount='.$request['payable_amount']; 
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://176.58.124.217:3000/debit_withdraw_amount',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $post_fields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response,true);
            if($response['receipt']['result'] == 1){
                $this->Main_model->update('tbl_withdraw', array('id' => $request['id']), ['status' => 1, 'admin_status' => 1, 'usdt_response' => json_encode($response['receipt'])]);
            }
        }
    }

    public function usdtBalance($txn_id=''){
        if(is_admin()){
            $get = $this->Main_model->get_single_record('tbl_block_address',['id' => $txn_id],'user_id');
            $getUser = $this->Main_model->get_single_record('tbl_users',['user_id' => $get['user_id']],'wallet_address,private_key');

                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'http://176.58.124.217:3000/check_usdt_balance',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => 'wallet_address='.$getUser['wallet_address'].'&private_key='.$getUser['private_key'],
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                  ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                echo $response;
                // $this->load->view('crypto_transaction',$response);
            // }
        }else{
            redirect('Admin/Management/login');
        }

    }


    public function trxBalance($txn_id=''){
        if(is_admin()){
            $get = $this->Main_model->get_single_record('tbl_block_address',['id' => $txn_id],'user_id');
            $getUser = $this->Main_model->get_single_record('tbl_users',['user_id' => $get['user_id']],'wallet_address,private_key');
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://176.58.124.217:3000/check_trx_balance',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => 'wallet_address='.$getUser['wallet_address'],
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
              ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            echo $response;
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function creditTron($txn_id=''){
        if(is_admin()){
             $get = $this->Main_model->get_single_record('tbl_block_address',['id' => $txn_id],'user_id');
            $getUser = $this->Main_model->get_single_record('tbl_users',['user_id' => $get['user_id']],'wallet_address,private_key');
            // pr($getUser,true);
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://176.58.124.217:3000/deposit_trx',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => 'to='.$getUser['wallet_address'].'&amount=5',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;

        }else{
            redirect('Admin/Management/login');
        }
    }


    public function debitUsdt($txn_id=''){
        if(is_admin()){
             $get = $this->Main_model->get_single_record('tbl_block_address',['id' => $txn_id],'user_id,value');
            $getUser = $this->Main_model->get_single_record('tbl_users',['user_id' => $get['user_id']],'wallet_address,private_key');
            $amount = $get['value']/10000000;
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://176.58.124.217:3000/debit_admin_usdt',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => 'amount='.$get['value'].'&from='.$getUser['wallet_address'].'&private_key='.$getUser['private_key'],
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;

        }else{
            redirect('Admin/Management/login');
        }
    }


    public function tronTransactionUsers(){
        if(is_admin()){
            $users = $this->Main_model->tronTransactionUsers(); 
            foreach($users as $key => $user){
                $url = 'https://api.trongrid.io/v1/accounts/'.$user['wallet_address'].'/transactions/trc20';
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
                pr($jsonD['data']);
                if(!empty($jsonD['data'])){
                    foreach($jsonD['data'] as $transaction){
                        $check = $this->Main_model->get_single_record('tbl_block_address2',['timeStamp' => $transaction['block_timestamp']],'timeStamp');
                        if(empty($check)){
                            $addredArr  = [
                                'user_id' => $user['user_id'],
                                'timeStamp' => $transaction['block_timestamp'],
                                'hash' => $transaction['transaction_id'],
                                'blockHash' => $transaction['transaction_id'],
                                'from' => $transaction['from'],
                                'to' => $transaction['to'],
                                'value' => $transaction['value'] / 1000000,
                                'tokenName' => $transaction['token_info']['name'],
                                'tokenDecimal' => $transaction['token_info']['decimals'],
                            ];
                            $this->Main_model->add('tbl_block_address2',$addredArr);
                        }
                    }
                }
            }
       }else{
           redirect('Admin/Management/login');
       }
    }
}
