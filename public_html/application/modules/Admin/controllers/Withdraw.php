
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email', 'pagination', 'Excel'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
//        require_once( APPPATH . 'modules/Admin/libraries/SimpleExcel/SimpleExcel.php');
//        if (file_exists(APPPATH . 'modules/Admin/libraries/SimpleExcel/SimpleExcel.php')) {
//            echo'file exist';
//        }
    }

    public function index() {
        if (is_admin()) {
            // $object = new PHPExcel();
            // pr($object);
            // echo APPPATH . 'modules/Admin/libraries/SimpleExcel/SimpleExcel.php';
            // die;
            $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array(), '*');
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,first_name,name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $this->load->view('withdraw_requests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Approved() {
        if (is_admin()) {
            $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 1), '*');
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $this->load->view('withdraw_requests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Pending() {
        if (is_admin()) {
            $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 0), '*');
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $this->load->view('withdraw_requests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Rejected() {
        if (is_admin()) {
            $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 2), '*');
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $this->load->view('withdraw_requests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function payout_summary() {
        if (is_admin()) {
            $response = array();
            $response['records'] = $this->Main_model->payout_summary();
            foreach($response['records'] as $key => $record){
                //
                $incomes = $this->Main_model->get_incomes('tbl_income_wallet', 'date(created_at) = "'.$record['date'].'"', 'ifnull(sum(amount),0) as sum,type');
                $response['records'][$key]['incomes'] = calculate_income($incomes);
            }
            // pr($response,true);
            $this->load->view('payout_summary', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function request($id) {
        if (is_admin()) {
            $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
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
                            $this->session->set_flashdata('message', 'Withdraw request approved');
                        } else {
                            $this->session->set_flashdata('message', 'Error while apporing request');
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
                                'description' => $data['remark'],
                            );
                            $this->Main_model->add('tbl_income_wallet', $productArr);
                            $this->session->set_flashdata('message', 'Withdraw request rejected');
                        } else {
                            $this->session->set_flashdata('message', 'Error while apporing rejection');
                        }
                    }
                }
            }
            $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            $response['user_details'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['request']['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
            $this->load->view('request', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function income($type = '') {
        if (is_admin()) {
            $response['header'] = ucwords(str_replace('_', ' ', $type));
            $config['base_url'] = base_url() . 'Admin/Withdraw/income/' . $type;
            $config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => $type), 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 5;
            $config['per_page'] = 50;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(5);
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => $type), 'ifnull(sum(amount),0) as sum');
            $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_income_wallet', array('type' => $type), '*', $config['per_page'], $segment);
            $response['segament'] = $segment;
            $this->load->view('incomes', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function dateWisePayout($date = '') {
        if (is_admin()) {
            $response['header'] = 'Datewise Payout Summary';
            $config['base_url'] = base_url() . 'Admin/Withdraw/incomeLedgar';
            $config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = "'.$date.'"', 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 100;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = "'.$date.'"', 'ifnull(sum(amount),0) as sum');
            $response['user_incomes'] = $this->Main_model->get_records('tbl_income_wallet', 'date(created_at) = "'.$date.'"', '*');
            $response['segament'] = 0;
            // pr($response,true);
            $this->load->view('incomes', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function incomeLedgar($type = '') {
        if (is_admin()) {
            $response['header'] = 'Income Ledgar';
            $config['base_url'] = base_url() . 'Admin/Withdraw/incomeLedgar';
            $config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', array(), 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 50;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet', array(), 'ifnull(sum(amount),0) as sum');
            $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_income_wallet', array(), '*', $config['per_page'], $segment);
            $response['segament'] = $segment;
            $this->load->view('incomes', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function AddressRequests() {
        if (is_admin()) {
            $where = array('kyc_status' => 1);
            $start_date = '';
            $end_date = '';
            // if ($this->input->server('REQUEST_METHOD') == 'POST') {
            //     $start_date = date_format(date_create($this->input->post('start_date')),"Y-m-d"); 
            //     $end_date = date_format(date_create($this->input->post('end_date')),"Y-m-d");; 
            //     $where = "  date(created_at) >= date('".$start_date."') and date(created_at) <= date('".$end_date."')";
            // }else{
            //     $where = array('kyc_status' => 1);
            // }
            $response['start_date'] = date_format(date_create($start_date), "m/d/Y");
            $response['end_date'] = date_format(date_create($end_date), "m/d/Y");
            $response['header'] = 'Bank Address Requests';
            $response['users'] = $this->Main_model->get_records('tbl_bank_details', $where, '*');

            $this->load->view('AddressRequests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function ApprovedAddressRequests() {
        if (is_admin()) {
            $where = array('kyc_status' => 2);
            $start_date = '';
            $end_date = '';
            // if ($this->input->server('REQUEST_METHOD') == 'GET') {
            //     $start_date = date_format(date_create($this->input->get('start_date')),"Y-m-d"); 
            //     $end_date = date_format(date_create($this->input->get('end_date')),"Y-m-d");; 
            //     $where = "kyc_status  = 2 and date(created_at) >= date('".$start_date."') and date(created_at) <= date('".$end_date."')";
            // }
            $response['start_date'] = date_format(date_create($start_date), "m/d/Y");
            $response['end_date'] = date_format(date_create($end_date), "m/d/Y");
            $response['header'] = 'Approved Bank Address Requests';
            $response['users'] = $this->Main_model->get_records('tbl_bank_details', $where, '*');

            $this->load->view('AddressRequests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function RejectedAddressRequests() {
        if (is_admin()) {
            $where = array('kyc_status' => 3);
            $start_date = '';
            $end_date = '';
            // if ($this->input->server('REQUEST_METHOD') == 'GET') {
            //     $start_date = date_format(date_create($this->input->get('start_date')),"Y-m-d"); 
            //     $end_date = date_format(date_create($this->input->get('end_date')),"Y-m-d");; 
            //     $where = "kyc_status  = 3 and date(created_at) >= date('".$start_date."') and date(created_at) <= date('".$end_date."')";
            // }
            $response['start_date'] = date_format(date_create($start_date), "m/d/Y");
            $response['end_date'] = date_format(date_create($end_date), "m/d/Y");
            $response['header'] = 'Rejected Bank Address Requests';
            $response['users'] = $this->Main_model->get_records('tbl_bank_details', $where, '*');
            // pr($where,true);
            $this->load->view('AddressRequests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function ApproveUserAddressRequest($id, $status) {
        if (is_admin()) {
            $data['success'] = 0;
            $res = $this->Main_model->update('tbl_bank_details', array('id' => $id), array('kyc_status' => $status));
            if ($res) {
                $data['message'] = 'Request Accepted Successfully';
                $data['success'] = 1;
            } else {
                $data['message'] = 'Error While Updating Status';
            }
            echo json_encode($data);
        } else {
            redirect('Admin/Management/login');
        }
    }


       /////////// IMPS SK


    public function withdrawHistory($status = '') {
        if (is_admin()) {
            $status = trim(addslashes($status));
            $field = trim(addslashes($this->input->get('type')));
            $value = trim(addslashes($this->input->get('value')));
            $config['base_url'] = base_url() . 'Admin/Withdraw/withdrawHistory/'.$status.'/';
            $config['uri_segment'] = 5;
            $config['per_page'] = 10;
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");
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
            if($status == 0 || $status == 1 || $status == 2 || $status == 3){
                if($status == 0){
                    $h = 'Pending ';
                }
                if($status == 1){
                    $h = 'Approved ';
                }
                if($status == 2){
                    $h = 'Reject ';
                }
                if($status == 3){
                    $h = 'All  ';
                }
                $response['header'] = $h.'Withdraw Requests';
                $response['status'] = $status;
                if(!empty($field)){
                    if($field == 'created_at'){
                             $like = ' AND date(tbl_withdraw.'.$field.') LIKE "%'.$value.'%"';
                    }elseif($field == 'amountgreter'){
                             $like = ' AND tbl_withdraw.amount >= '.$value.'';
                    }elseif($field == 'amountless'){
                             $like = ' AND tbl_withdraw.amount <= '.$value.'';
                    }else{
                        $like = ' AND tbl_users.'.$field.' LIKE "%'.$value.'%"';
                    }
                }else{
                    $like = '';
                }
                if($status == 0){
                    $status = 'tbl_withdraw.status = "0"';
                }elseif($status == 3){
                    $status = 'tbl_withdraw.id > "0"';
                }else{
                    $status = 'tbl_withdraw.status = "'.$status.'"';
                }
                $query_sum = $this->db->query('SELECT ifnull(count(tbl_withdraw.id),0) as sum FROM `tbl_users` INNER JOIN tbl_withdraw ON tbl_withdraw.user_id = tbl_users.user_id WHERE tbl_users.paid_status > "0" AND tbl_users.disabled = "0" AND '.$status.' '.$like.'');
                $sum = $query_sum->row_array();
                $config['total_rows'] = $sum['sum'];    
                $this->pagination->initialize($config);
                $segment = $this->uri->segment(5);
                if(empty($segment)){
                    $segment = 0;
                }
                $query = $this->db->query('SELECT tbl_withdraw.*,tbl_users.name,tbl_users.phone FROM `tbl_users` INNER JOIN tbl_withdraw ON tbl_withdraw.user_id = tbl_users.user_id WHERE tbl_users.paid_status > 0 AND tbl_users.disabled = 0 AND '.$status.' '.$like.' LIMIT '.$config['per_page'].' OFFSET '.$segment.'');
                $response['requests'] = $query->result_array();

                foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['kyc_status'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), 'kyc_status,pan,btc');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_add_beneficiary', array('user_id' => $request['user_id'], 'id' => $request['beneficary_id']), '*');
            }    

            }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('withdraw_requests3', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function approveWithdraw($status = '1') {
        if (is_admin()) {
            $status = trim(addslashes($status));
            $field = trim(addslashes($this->input->get('type')));
            $value = trim(addslashes($this->input->get('value')));
            $config['base_url'] = base_url() . 'Admin/Withdraw/withdrawHistory/'.$status.'/';
            $config['uri_segment'] = 5;
            $config['per_page'] = 10;
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");
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
            if($status == 0 || $status == 1 || $status == 2 || $status == 3){
                if($status == 0){
                    $h = 'Pending ';
                }
                if($status == 1){
                    $h = 'Approved ';
                }
                if($status == 2){
                    $h = 'Reject ';
                }
                if($status == 3){
                    $h = 'All  ';
                }
                $response['header'] = $h.'Withdraw Requests';
                $response['status'] = $status;
                if(!empty($field)){
                    if($field == 'created_at'){
                             $like = ' AND date(tbl_withdraw.'.$field.') LIKE "%'.$value.'%"';
                    }elseif($field == 'amountgreter'){
                             $like = ' AND tbl_withdraw.amount >= '.$value.'';
                    }elseif($field == 'amountless'){
                             $like = ' AND tbl_withdraw.amount <= '.$value.'';
                    }else{
                        $like = ' AND tbl_users.'.$field.' LIKE "%'.$value.'%"';
                    }
                }else{
                    $like = '';
                }
                if($status == 0){
                    $status = 'tbl_withdraw.status = "0"';
                }elseif($status == 3){
                    $status = 'tbl_withdraw.id > "0"';
                }else{
                    $status = 'tbl_withdraw.status = "'.$status.'"';
                }
                $query_sum = $this->db->query('SELECT ifnull(count(tbl_withdraw.id),0) as sum FROM `tbl_users` INNER JOIN tbl_withdraw ON tbl_withdraw.user_id = tbl_users.user_id WHERE tbl_users.paid_status > "0" AND tbl_users.disabled = "0" AND '.$status.' '.$like.'');
                $sum = $query_sum->row_array();
                $config['total_rows'] = $sum['sum'];    
                $this->pagination->initialize($config);
                $segment = $this->uri->segment(5);
                if(empty($segment)){
                    $segment = 0;
                }
                $query = $this->db->query('SELECT tbl_withdraw.*,tbl_users.name,tbl_users.phone FROM `tbl_users` INNER JOIN tbl_withdraw ON tbl_withdraw.user_id = tbl_users.user_id WHERE tbl_users.paid_status > 0 AND tbl_users.disabled = 0 AND '.$status.' '.$like.' LIMIT '.$config['per_page'].' OFFSET '.$segment.'');
                $response['requests'] = $query->result_array();

                foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['kyc_status'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), 'kyc_status,pan,btc');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_add_beneficiary', array('user_id' => $request['user_id'], 'id' => $request['beneficary_id']), '*');
                $response['requests'][$key]['jolo'] = $this->Main_model->get_single_record('tbl_money_transfer', array('user_id' => $request['user_id'], 'request_id' => $request['id']), '*');
            }    

            }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $this->load->view('approveWithdraw2', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function instantWithdraw($id='')
    {
        if (is_admin()) {
            $id = trim(addslashes($id));
            $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id, 'status' => 0), '*');
            if(!empty($response['request'])){
                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        if ($data['status'] == 1) {
                            $bankDetails = $this->Main_model->get_single_record('tbl_add_beneficiary', array('user_id' => $response['request']['user_id'], 'id' => $response['request']['beneficary_id']), '*');
                            $phone = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['request']['user_id']), 'phone,name');
                            $account_no = trim(addslashes($bankDetails['beneficiary_account_no']));
                            $ifsc_code = trim(addslashes($bankDetails['beneficiary_ifsc']));
                            $amount = trim(addslashes(abs($response['request']['payable_amount'])));
                            $payable_amount = trim(addslashes(abs($response['request']['amount'])));
                            $user_id = trim(addslashes($response['request']['user_id']));
                                if(!empty($account_no) && !empty($ifsc_code)){
                                    //if($data['amount'] >= 10 && $data['amount'] <= 5000){
                                        $myorderid = $this->generate_order_id();
                                        $callBackUrl = base_url('Dashboard/SecureWithdraw/callBackUrl');
                                        $transferAmount = round($data['amount']*dollar_price);
                                        $paramList = array('apikey' => key,'mobileno' => $phone['phone'], 'beneficiary_account_no' => $account_no, 'beneficiary_ifsc' => $ifsc_code, 'amount' => $transferAmount, 'orderid' => $myorderid, 'purpose' => 'BONUS', 'remarks' => title, 'callbackurl' => $callBackUrl);
                                        $jsondata = $this->curlSetup($paramList);
                                        if(!empty($jsondata)){
                                            if($jsondata['status'] != 'FAILED'){
                                                $this->session->set_flashdata('message', '<span class="badge badge-danger">Failed to transfer amount, Please check account no or ifsc code!</span>');
                                            }
                                            if($jsondata['status'] == 'ACCEPTED' || $jsondata['status'] == 'SUCCESS'){
                                                $wArr = array(
                                                    'status' => 1,
                                                    'remark' => $data['remark'],
                                                );
                                                $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                                               
                                                $transactionArr = array(
                                                    'user_id' => $user_id,
                                                    'request_id' => $id,
                                                    'beneficiaryid' => $jsondata['beneficiaryid'],
                                                    'amount' => $amount,
                                                    'status' => $jsondata['status'],
                                                    'joloorderid' => $jsondata['txid'],
                                                    'time' => $jsondata['time'],
                                                    'desc' => $jsondata['desc'],
                                                    'orderid' => $myorderid,
                                                    'payable_amount' => $payable_amount,
                                                    'tds' => 0,
                                                    'imps_deduction' => 0,
                                                );
                                                $this->Main_model->add('tbl_money_transfer', $transactionArr);

                                                $this->session->set_flashdata('message', '<span class="badge badge-success">'.$jsondata['desc'].'!</span>');
                                                $message = 'Dear '.$phone['name'].' your withdrawal Rs.'.$amount.' have been successful deposit into your account by '.title.'. Thanks';
                                                //notify_user($this->session->userdata['user_id'],$message);
                                            }else{
                                               $this->session->set_flashdata('message', '<span class="badge badge-danger">'.$jsondata['error'].'!</span>');
                                            }
                                        }else{
                                            $this->session->set_flashdata('message', '<span class="badge badge-danger">Api Not Responding Please Try Again!</span>');
                                        }
                                    // }else{
                                    //     $this->session->set_flashdata('message', '<span class="badge badge-danger">Minimum Withdraw 10 AND Maximum 5000!</span>');
                                    // }
                                }else{
                                    $this->session->set_flashdata('message', '<span class="badge badge-danger">Bank Account Details Not Updated!</span>');
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
                                    'description' => $data['remark'],
                                );
                                $this->Main_model->add('tbl_income_wallet', $productArr);
                                $this->session->set_flashdata('message', 'Withdraw request rejected');
                            } else {
                                $this->session->set_flashdata('message', 'Error while apporing rejection');
                            }
                        }
                    }else{
                        $this->session->set_flashdata('message', '<span class="badge badge-danger">'.validation_errors().'</span>');
                    }

                    redirect('Admin/Withdraw/withdrawHistory/0/');
                }
            }
            $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            $response['user_details'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['request']['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
            $this->load->view('request3', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    private function generate_order_id() {
        if (is_admin()) {
            $order_id = rand(100000000, 999999999);
            $order = $this->Main_model->get_single_record('tbl_money_transfer', array('orderid' => $order_id), 'orderid');
            if (!empty($order)) {
                return $this->generate_order_id();
            } else {
                return $order_id;
            }
        }
    }


    private function curlSetup($paramList){
        if (is_admin()) {
            if(!empty($paramList)){
                $apikey= key;
                // $userid= $this->api_user_id;
                // $headerstring = "$userid|$apikey";
                // $hashedheaderstring = hash("sha512", $headerstring);
                $paramLists = $paramList;
                $payload = json_encode($paramLists, true);
                $url = "http://13.127.227.22/freeunlimited/v3/transfer.php";
                $header= array('Content-Type:application/json');
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                $response = curl_exec ($ch);
                $err = curl_error($ch);
                curl_close($ch);
                return json_decode($response, true);
            }
        }
    }


    public function callBackUrl(){
        //status=SUCCESS&operatortxnid=9001110002&joloorderid=Z123456789012345&userorderid=TEST123456
        $data = array();
        $res = array();
        $data['status'] = $this->input->post('status');
        $data['operatortxnid'] = $this->input->post('operatortxnid');
        $data['joloorderid'] = $this->input->post('joloorderid');
        $data['userorderid'] = $this->input->post('userorderid');
        $res = $this->Main_model->update('tbl_money_transfer', array('orderid' => $data['userorderid']), $data);
        if($res){
            if($data['status'] == 'FAILED'){
                $transaction = $this->Main_model->get_single_record('tbl_money_transfer', array('orderid' => $data['userorderid']), '*');
                $creditBack = array(
                    'user_id' => $transaction['user_id'],
                    'amount' => $transaction['payable_amount'],
                    'type' => 'bank_transfer',
                    'description' => 'Failed Bank Transaction',
                );
                $this->Main_model->add('tbl_income_wallet', $creditBack);
            }
            $res['status'] = 'SUCCESS';
            $res['message'] = 'Request Updated Successfully';
        }else{
            $res['status'] = 'FAILED';
            $res['message'] = 'Error While Updating Request';
        }
        echo json_encode($res);
    }

}
