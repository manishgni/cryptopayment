<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $response['packages'] = $this->Main_model->get_records('tbl_package', array(), '*');
            $this->load->view('package_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function news() {
        if (is_admin()) {
            $response['news'] = $this->Main_model->get_records('tbl_news', array(), '*');
            $this->load->view('news', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function deleteNews($id) {
        if (is_admin()) {
            $get = $this->Main_model->get_single_record('tbl_news', array('id' => $id), '*');
            if(!empty($get['id'])){
                $delete = $this->Main_model->delete('tbl_news', $id);
                if($delete){
                    $this->session->set_flashdata('message', 'News Deleted Successfully!');
                }else{
                    $this->session->set_flashdata('message', 'Request not found!');
                }
            }else{
                $this->session->set_flashdata('message', 'Invaild Request ID!');
            }
            redirect('/Admin/Settings/news');
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function ResetPassword(){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $cpassword = $data['cpassword'];
                $npassword = $data['npassword'];
                $cnpassword = $data['cnpassword'];
                $user = $this->Main_model->get_single_record('tbl_admin', array('user_id' => 'admin'), 'id,user_id,password');
                if ($npassword !== $cnpassword) {
                    // $response['message'] = 'Verify Password Doed Not Match';
                    $this->session->set_flashdata('message', 'Verify Password Does Not Match');
                } elseif ($cpassword !== $user['password']) {
                    // $response['message'] = 'Wrong Current Password';
                    $this->session->set_flashdata('message', 'Wrong Current Password');
                } else {
                    $updres = $this->Main_model->update('tbl_admin', array('user_id' =>  'admin'), array('password' => $cnpassword));
                    if ($updres == true) {
                        // $response['message'] = 'Password Updated Successfully';
                        $this->session->set_flashdata('message', 'Password Updated Successfully');
                        $response['success'] = 1;
                    } else {
                        // $response['message'] = 'There is an error while Changing Password Please Try Again';
                        $this->session->set_flashdata('message', 'There is an error while Changing Password Please Try Again');
                    }
                }
                // $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('phone', 'Phone', 'trim|numeric|required|xss_clean');
                // if ($this->form_validation->run() != FALSE) {
                //     $UserData = array(
                //         'name' => $data['name'],
                //         'email' => $data['email'],
                //         'phone' => $data['phone'],
                //     );
                //     $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                //     if ($res == TRUE) {
                //         $this->session->set_flashdata('message', 'User Details Updated Successfully');
                //     } else {
                //         $this->session->set_flashdata('message', 'Error While Updating Details Please Try Again ...');
                //     }
                // }
            }
            $this->load->view('reset_password', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function EditUser($user_id) {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if($data['form_type'] == 'personal'){
                    $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('phone', 'Phone', 'trim|numeric|required|xss_clean');
                    $this->form_validation->set_rules('leftPower', 'Left Power', 'trim|numeric|required|xss_clean');
                    $this->form_validation->set_rules('rightPower', 'Right Power', 'trim|numeric|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $check = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user_id], '*');
                        if($check['email'] != $data['email']){
                            $check2 = $this->Main_model->get_single_record('tbl_users', ['email' => $data['email']], '*');
                            if(!empty($check2)){
                                $this->session->set_flashdata('message', '<span class="text-danger">This email id is already exists!</span>');
                                redirect('Admin/Settings/EditUser/'.$user_id);
                                die();
                            }

                        }
                        $UserData = array(
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'phone' => $data['phone'],
                            //'leftPower' => $data['leftPower'],
                            //'rightPower' => $data['rightPower'],
                            'leftBusiness' => $data['leftPower'],
                            'rightBusiness' => $data['rightPower'],
                        );
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'User Details Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Updating Details Please Try Again ...');
                        }
                    }
                }elseif($data['form_type'] == 'password'){
                    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'password' => $data['password']
                        );
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Password Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Password Please Try Again ...');
                        }
                    }
                }elseif($data['form_type'] == 'master_key'){
                    $this->form_validation->set_rules('master_key', 'Transaction Password', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'master_key' => $data['master_key']
                        );
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Transaction Password Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Transaction Password Please Try Again ...');
                        }
                    }
                }else{
                    // pr($data,true);
                    $this->form_validation->set_rules('account_holder_name', 'Account Holder Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('bank_account_number', 'Bank Account Number', 'trim|numeric|required|xss_clean');
                    $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('btc', 'BTC', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'account_holder_name' => $data['account_holder_name'],
                            'bank_name' => $data['bank_name'],
                            'bank_account_number' => $data['bank_account_number'],
                            'ifsc_code' => $data['ifsc_code'],
                            'btc' => $data['btc'],
                            'tron' => $data['tron'],
                            'ethereum' => $data['ethereum'],
                            'litecoin' => $data['litecoin'],
                        );
                        $res = $this->Main_model->update('tbl_bank_details', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'BANK Details Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Updating Bank Details Please Try Again ...');
                        }
                    }
                }
            }
            $response['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
            $response['user']['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $user_id), '*');
            $this->load->view('edit_user', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function UpdateRank(){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('directs', 'Directs', 'trim|numeric|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                    if(!empty($user)){
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $data['user_id']),array('directs' => $data['directs']));
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Rank Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Updating Rank  Please Try Again ...');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'Invalid user');
                    }
                }
            }
            $this->load->view('update_rank', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function CreateNews() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('news', 'News', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $packArr = array(
                        'title' => $data['title'],
                        'news' => $data['news'],
                    );
                    $res = $this->Main_model->add('tbl_news', $packArr);
                    if ($res == TRUE) {
                        $this->session->set_flashdata('message', 'News Added Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating News  Please Try Again ...');
                    }
                }
            }
            $this->load->view('create_news', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function editNews($id) {
        if (is_admin()) {
            $response = array();
            $response['news'] = $this->Main_model->get_single_record('tbl_news',array('id' => trim(addslashes($id))), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('news', 'News', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $packArr = array(
                        'title' => $data['title'],
                        'news' => $data['news'],
                    );
                    $res = $this->Main_model->update('tbl_news',array('id' => $id), $packArr);
                    if ($res == TRUE) {
                        $this->session->set_flashdata('message', 'News Edit Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating News  Please Try Again ...');
                    }
                    redirect('Admin/Settings/editNews/'.$id);
                }
            }
            $this->load->view('edit_news', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function token_value() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $promoArr = array(
                    'amount' => $this->input->post('token_value'),
                ); 
                $res = $this->Main_model->update('tbl_token_value', array('id' => 1),$promoArr);
                if ($res) {
                    $this->session->set_flashdata('message', 'Token Update dSuccessfully');
                } else {
                    $this->session->set_flashdata('message', 'Error While Updating Token Please Try Again ...');
                }                
            }
            $response['token_value'] = $this->Main_model->get_single_record('tbl_token_value', array(), '*');
            // pr($response,true);
            $this->load->view('token_value', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function popup() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'doc|pdf|jpg|png';
                $config['file_name'] = 'am' . time();
                if($this->input->post('type') == 'image'){
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('media')) {
                        $this->session->set_flashdata('message', $this->upload->display_errors());
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $promoArr = array(
                            'caption' => $this->input->post('caption'),
                            'media' => $data['upload_data']['file_name'],
                            'type' => 'image'
                        ); 
                        $res = $this->Main_model->update('tbl_popup', array('id' => 1),$promoArr);
                        if ($res) {
                            $this->session->set_flashdata('message', 'Image Update Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Adding Popup Please Try Again ...');
                        }
                    }
                }else{
                    $promoArr = array(
                        'caption' => $this->input->post('caption'),
                        'media' => $this->input->post('media'),
                        'type' => 'video'
                    ); 
                    $res = $this->Main_model->update('tbl_popup', array('id' => 1),$promoArr);
                    if ($res) {
                        $this->session->set_flashdata('message', 'Image Updated Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Adding Popup Please Try Again ...');
                    }
                }
                
            }
            $response['materials'] = $this->Main_model->get_records('tbl_popup', array(), '*');
            $this->load->view('popup', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function roiList() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();
            $config['total_rows'] = $this->Main_model->get_sum('tbl_roi', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/users';
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
            $response['records'] = $this->Main_model->get_limit_records('tbl_roi', $where, '*', $config['per_page'], $segment);

            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];

            $this->load->view('roi_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function BoosterroiList() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();
                
            $where['booster_status'] = 1;
            $config['total_rows'] = $this->Main_model->get_sum('tbl_roi', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/users';
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
            $response['records'] = $this->Main_model->get_limit_records('tbl_roi', $where, '*', $config['per_page'], $segment);

            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];

            $this->load->view('roi_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function popup_upload() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $data = html_escape($data);
                if ($data['type'] == 'image') {
                    if (!empty($_FILES['media']['name'])) {
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
                        $config['file_name'] = 'payment_slip';
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('media')) {
                            $this->session->set_flashdata('error', $this->upload->display_errors());
                        } else {
                            $fileData = array('upload_data' => $this->upload->data());
                            $fileData = array('upload_data' => $this->upload->data());
                            $userData['media'] = $fileData['upload_data']['file_name'];
                            $userData['type'] = 'image';
                            $userData['caption'] = $this->input->post('caption');
                            $updres = $this->Main_model->update('tbl_user_popup',['id' => 1],$userData);
                            if ($updres == true) {
                                $this->session->set_flashdata('error', 'Popup Uploaded Successfully');
                            } else {
                                $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                            }
                        }
                    } else {
                        $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
                    }
                } 
            }
            $response['popup'] = $this->Main_model->get_single_record('tbl_user_popup',[],'*'); 
            $response['user'] = 1;
            $this->load->view('popup.php', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function popupSetting(){
        if(is_admin()){
            $popup = $this->Main_model->get_single_record('tbl_user_popup',[],'*'); 
            if($popup['status'] == 0){
                $status = 1;
            }else{
                $status = 0;
            }
            $this->Main_model->update('tbl_user_popup',['id' => 1],['status' => $status]);
            redirect('Admin/Settings/popup_upload');
        }else{
            redirect('Admin/Management/login');
        }
    }
	
	public function income_management(){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|numeric|required|xss_clean');
                $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), 'user_id');
                    if (!empty($user)) {
						if($data['type'] == 'credit'){
							$amount = abs($data['amount']);
						}else{
							$amount = -abs($data['amount']);
						}
						$IncomeArr = array(
								'user_id' => $data['user_id'],
								'amount' => $amount,
								'type' => 'admin_amount',
								'description' => $data['description'],
							);
                        $res = $this->Main_model->add('tbl_income_wallet', $IncomeArr);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Amount Transferred Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Transferring Amount  Please Try Again ...');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid User ID');
                    }
                }
            }
            $this->load->view('income_management', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function coin_management(){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('amount', 'Coin', 'trim|numeric|required|xss_clean');
                $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $amount = abs($data['amount']);
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), 'user_id');
                    if (!empty($user)) {
                        $totalCoin = $this->Main_model->get_single_record('tbl_coin_wallet', array('user_id' => $data['user_id']), 'ifnull(sum(coin),0) as totalCoin');
                        if($totalCoin['totalCoin'] >= $amount){
                            $debitCoin = array(
                                    'user_id' => $data['user_id'],
                                    'coin' => -$amount,
                                    'type' => 'coin_income',
                                    'description' => $data['description'],
                                );
                            $res = $this->Main_model->add('tbl_coin_wallet', $debitCoin);

                            $creditCoin = array(
                                    'user_id' => $data['user_id'],
                                    'coin' => $amount,
                                    'type' => 'coin_income',
                                    'description' => $data['description'],
                                );
                            $res = $this->Main_model->add('tbl_coin_withdrawable', $creditCoin);

                            if ($res == TRUE) {
                                $this->session->set_flashdata('message', 'Coin Transferred Successfully');
                            } else {
                                $this->session->set_flashdata('message', 'Error While Transferring Coin  Please Try Again ...');
                            }
                        }else {
                            $this->session->set_flashdata('message', 'Insufficient Coin!');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid User ID');
                    }
                }
            }
            $this->load->view('coin_management', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function deactivated_list(){
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            // $export = $this->input->get('export');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();
            $config['total_rows'] = $this->Main_model->get_sum('tbl_deactivated_details', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Settings/deactivated_list';
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
            $response['users'] = $this->Main_model->get_limit_records('tbl_deactivated_details', $where, '*', $config['per_page'], $segment);
            foreach ($response['users'] as $key => $value) {
                $response['users'][$key]['info'] = $this->Main_model->get_single_record('tbl_users', ['user_id' => $value['user_id']], 'name,phone');
            }

            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            // if($export){
            //     $application_type = 'application/'.$export;
            //     $header = ['#','User ID', 'Name', 'Phone', 'Postion', 'Password', 'Transaction Pin', 'Sponsor ID', 'Package', 'E-wallet', 'Income','Joining Date'];
            //     $response['users'] = $this->Main_model->get_records('tbl_users', array(''), 'id,user_id,name,last_name,phone,password,master_key,email,sponser_id,directs,package_id,paid_status,created_at,disabled,position,package_amount');
            //     foreach ($response['users'] as $key => $record) {
            //         $e_wallet = $this->Main_model->get_single_record('tbl_wallet', array('user_id' => $record['user_id']), 'ifnull(sum(amount),0) as e_wallet');
            //         $income_wallet = $this->Main_model->get_single_record('tbl_income_wallet', array('user_id' => $record['user_id']), 'ifnull(sum(amount),0) as income_wallet');
            //        $records[$key]['i'] = ($key+1);
            //        $records[$key]['user_id'] = $record['user_id'];
            //        $records[$key]['name'] = $record['name'];
            //        $records[$key]['phone'] = $record['phone'];
            //        $records[$key]['position'] = $record['position'];
            //        $records[$key]['password'] = $record['password'];
            //        $records[$key]['master_key'] = $record['master_key'];
            //        $records[$key]['sponser_id'] = $record['sponser_id'];
            //        $records[$key]['package_amount'] = $record['package_amount'];
            //        $records[$key]['e_wallet'] = $e_wallet['e_wallet'];
            //        $records[$key]['income_wallet'] = $income_wallet['income_wallet'];
            //        $records[$key]['created_at'] = $record['created_at'];
            //     }
            //     $this->finalExport($export, $application_type, $header,$records);
            // }
          
        
            $this->load->view('deactivated_users',$response);
        } else {
            redirect('Admin/Management/login');
        }
    }



     public function trxHistory(){
        // die;
        if (is_admin()) {
            // $field = $this->input->get('type');
            // $value = $this->input->get('value');
            // $export = $this->input->get('export');
            // $where = array($field => $value);
            // pr($where,true);
            // if (empty($where[$field]))
                $where = array();
            $config['total_rows'] = $this->Main_model->get_sum('tbl_block_address', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Settings/trxHistory';
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
            $response['users'] = $this->Main_model->get_limit_records('tbl_block_address', $where, '*', $config['per_page'], $segment);
            // foreach ($response['users'] as $key => $value) {
            //     $response['users'][$key]['info'] = $this->Main_model->get_single_record('tbl_users', ['user_id' => $value['user_id']], 'name,phone');
            // }

            $response['segament'] = $segment;
            // $response['type'] = $field;
            // $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
        
            $this->load->view('Trxusers',$response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    // public function checkTrx(){
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //       CURLOPT_URL => 'http://176.58.124.217:3000/check_trx_balance',
    //       CURLOPT_RETURNTRANSFER => true,
    //       CURLOPT_ENCODING => '',
    //       CURLOPT_MAXREDIRS => 10,
    //       CURLOPT_TIMEOUT => 0,
    //       CURLOPT_FOLLOWLOCATION => true,
    //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //       CURLOPT_CUSTOMREQUEST => 'POST',
    //       CURLOPT_POSTFIELDS => 'wallet_address=TDoUadHqU7MrJ5XkH9kciyffFcoonugpfx&private_key=0E7D7F049B1DBBFCA9DF65A5E6915C0CDA2EB8165A100D5006',
    //       CURLOPT_HTTPHEADER => array(
    //         'Content-Type: application/x-www-form-urlencoded'
    //       ),
    //     ));

    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     echo $response;
    // }
    
    // public function deposit_trx(){
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //       CURLOPT_URL => 'http://176.58.124.217:3000/deposit_trx',
    //       CURLOPT_RETURNTRANSFER => true,
    //       CURLOPT_ENCODING => '',
    //       CURLOPT_MAXREDIRS => 10,
    //       CURLOPT_TIMEOUT => 0,
    //       CURLOPT_FOLLOWLOCATION => true,
    //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //       CURLOPT_CUSTOMREQUEST => 'POST',
    //       CURLOPT_POSTFIELDS => 'wallet_address=TDoUadHqU7MrJ5XkH9kciyffFcoonugpfx&private_key=0E7D7F049B1DBBFCA9DF65A5E6915C0CDA2EB8165A100D5006',
    //       CURLOPT_HTTPHEADER => array(
    //         'Content-Type: application/x-www-form-urlencoded'
    //       ),
    //     ));

    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     echo $response;
    // }

    // public function check_usdt_balance(){
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //       CURLOPT_URL => 'http://176.58.124.217:3000/check_usdt_balance',
    //       CURLOPT_RETURNTRANSFER => true,
    //       CURLOPT_ENCODING => '',
    //       CURLOPT_MAXREDIRS => 10,
    //       CURLOPT_TIMEOUT => 0,
    //       CURLOPT_FOLLOWLOCATION => true,
    //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //       CURLOPT_CUSTOMREQUEST => 'POST',
    //       CURLOPT_POSTFIELDS => 'wallet_address=TDoUadHqU7MrJ5XkH9kciyffFcoonugpfx&private_key=0E7D7F049B1DBBFCA9DF65A5E6915C0CDA2EB8165A100D5006',
    //       CURLOPT_HTTPHEADER => array(
    //         'Content-Type: application/x-www-form-urlencoded'
    //       ),
    //     ));

    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     echo $response;
    // }

    // public function debit_admin_usdt(){
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //       CURLOPT_URL => 'http://176.58.124.217:3000/check_usdt_balance',
    //       CURLOPT_RETURNTRANSFER => true,
    //       CURLOPT_ENCODING => '',
    //       CURLOPT_MAXREDIRS => 10,
    //       CURLOPT_TIMEOUT => 0,
    //       CURLOPT_FOLLOWLOCATION => true,
    //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //       CURLOPT_CUSTOMREQUEST => 'POST',
    //       CURLOPT_POSTFIELDS => 'wallet_address=TDoUadHqU7MrJ5XkH9kciyffFcoonugpfx&private_key=0E7D7F049B1DBBFCA9DF65A5E6915C0CDA2EB8165A100D5006',
    //       CURLOPT_HTTPHEADER => array(
    //         'Content-Type: application/x-www-form-urlencoded'
    //       ),
    //     ));

    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     echo $response;
    // }

    //   public function AirdropCheck(){

    //     $record = $this->Main_model->get_records('tbl_users',['id >=' => '8276','id <=' => '9519'],'*');
    //     foreach($record as $key => $value){
    //            $coinData = [
    //                 'user_id' => $value['user_id'],
    //                 'coin' => 15000,
    //                 'type' => 'coin_income',
    //                 'description' => 'Coin Credit From Registration',
    //             ];
    //             $this->Main_model->add('tbl_coin_wallet', $coinData);

    //             $coinsData = [
    //                 'user_id' => $value['sponser_id'],
    //                 'coin' => 3000,
    //                 'type' => 'coin_income',
    //                 'description' => 'Coin Credit From Registration',
    //             ];
    //             $this->Main_model->add('tbl_coin_wallet', $coinsData);
            
            
    //             pr($value);
    //     }
    // }

}
