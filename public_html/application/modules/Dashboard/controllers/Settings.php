<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Shopping_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        if (is_logged_in()) {
            $response['products'] = $this->Shopping_model->get_product();
            $this->load->view('Shopping/products', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function SendSmsUser() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('send_sms_user', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function SendYoutubeUser() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('send_youtube_user', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function BusinessPlan() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('businesss-plan', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
}
