<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
    }

    public function index() {
        if (is_logged_in()) {
            $response = array();
//            $response['requests'] = $this->User_model->get_records('tbl_payment_request', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('chat', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function SubmitQuery() {
        if (is_logged_in()) {
            $message = $this->input->post('message');
            $messageArr = array(
                'user_id' => $this->session->userdata['user_id'],
                'message' => $message,
                'sender' => $this->session->userdata['user_id']
            );
            $res = $this->User_model->add('tbl_support_message', $messageArr);
            if ($res) {
                $data['message'] = 'Message Sent Successfully';
                $data['success'] = 1;
            } else {
                $data['message'] = 'Error while sending message';
                $data['success'] = 0;
            }
            echo json_encode($data);
            exit();
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function UserChat() {
        if (is_logged_in()) {
            $response['messages'] = $this->User_model->user_chat($this->session->userdata['user_id']);
            echo json_encode($response, true);
            exit();
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function ComposeMail() {
        if (is_logged_in()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                    $sendWallet = array(
                    'user_id' => $this->session->userdata['user_id'],
                    'title' => $data['title'],
                    'message' => $data['message'],
                );
                $this->User_model->add('tbl_support_message', $sendWallet);
                $this->session->set_flashdata('message', 'Mail Composed Successfully');
            }
            $this->load->view('compose_mail', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function Inbox() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Inbox';
            $response['messages'] = $this->User_model->get_records('tbl_support_message', array('user_id' => 'admin'), '*');
            $this->load->view('composed_message', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function Outbox() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Outbox';
            $response['messages'] = $this->User_model->get_records('tbl_support_message', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('composed_message', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    // public function getOtp()
    // {   
    //     if ($this->input->is_ajax_request()) {
    //         if ($this->input->server('REQUEST_METHOD') == 'GET') {
    //             $_SESSION['verification_otp'] = rand(100000, 999999);
    //             $this->session->mark_as_temp('verification_otp', 180);
    //             $message = 'Dear User, Your OTP is '.$this->session->userdata['verification_otp'].' Never share this OTP with anyone, this OTP expire in three minutes. More Info: '.base_url().' From mlmsig';
    //             notify_sms($this->session->userdata['user_id'], $message, '1201161518339990262', '1207162142573795782');
    //             if($message){
    //                 $response['success'] = 1;
                    
    //             }else{
    //                 $response['success'] = 0;
    //             }
    //         }
    //     }else{
    //         $response['success'] = 0;
    //     }

    //     echo json_encode($response);
    // }

}
