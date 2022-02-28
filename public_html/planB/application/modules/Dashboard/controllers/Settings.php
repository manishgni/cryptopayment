<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation','pagination','security', 'email'));
        $this->load->model(array('Shopping_model','User_model'));
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

    public function PurchaseCourse() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('purchase_course', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function PurchaseSite() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('purchase_site', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    } 
    public function OnlineShopping() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('online_shopping', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function payout_summary() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->payout_summary();
            foreach($response['records'] as $key => $record){
                //
                $incomes = $this->User_model->get_incomes('tbl_income_wallet', 'date(created_at) = "'.$record['date'].'" and user_id = "'.$this->session->userdata['user_id'].'" and amount > 0', 'ifnull(sum(amount),0) as sum,type');
                $response['records'][$key]['incomes'] = calculate_income($incomes);
            }
            $response['type'] = $this->User_model->get_records('tbl_income_wallet'," amount > '0' Group by type",'type');
            //pr($response,true);
            $this->load->view('payout_summary', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function week_payout_summary() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->week_summary();
            foreach($response['records'] as $key => $record){
                //
                $incomes = $this->User_model->get_incomes('tbl_income_wallet', 'WEEK(created_at)%MONTH(created_at)+1 = "'.$record['date'].'" and user_id = "'.$this->session->userdata['user_id'].'" and amount > 0', 'ifnull(sum(amount),0) as sum,type');
                $response['records'][$key]['incomes'] = calculate_income($incomes);
            }
            $response['type'] = $this->User_model->get_records('tbl_income_wallet'," amount > '0' Group by type",'type');
            $this->load->view('week_payout_summary', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function weekWisePayout($date = '') {
        if (is_logged_in()) {
            $response['header'] = 'Week Payout Summary';
            $start = $this->input->get('start');
            $end = $this->input->get('end');
            $where = ['user_id' => $this->session->userdata['user_id']];
            $where['week(created_at)+1'] = $date;
            if(!empty($start)){
                $where['week(created_at) >='] = $start;
                $where['week(created_at) <='] = $end;
            }
            $config['total_rows'] = $this->User_model->get_sum('tbl_income_wallet', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Dashboard/Settings/weekWisePayout/'.$date;
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
            $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet',$where, 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_limit_records('tbl_income_wallet', $where, '*', $config['per_page'], $segment);
            $response['start'] = $start;
            $response['end'] = $end;
            $response['path'] = 'Dashboard/Settings/weekWisePayout/'.$date;
            // $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'week(created_at)+1 = "'.$date.'" and user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as total_income');
            // $response['user_incomes'] = $this->User_model->get_records('tbl_income_wallet', 'week(created_at)+1 = "'.$date.'" and user_id = "'.$this->session->userdata['user_id'].'"', '*');
            //$response['segament'] = 0;
            // pr($response,true);
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function dateWisePayout($date = '') {
        if (is_logged_in()) {
            $response['header'] = 'Datewise Payout Summary';
            $start = $this->input->get('start');
            $end = $this->input->get('end');
            $where = ['user_id' => $this->session->userdata['user_id']];
            $where['date(created_at)'] = $date;
            if(!empty($start)){
                $where['date(created_at) >='] = $start;
                $where['date(created_at) <='] = $end;
            }
            $config['total_rows'] = $this->User_model->get_sum('tbl_income_wallet', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Dashboard/Settings/dateWisePayout/'.$date;
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
            $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet',$where, 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_limit_records('tbl_income_wallet', $where, '*', $config['per_page'], $segment);
            $response['start'] = $start;
            $response['end'] = $end;
            $response['path'] = 'Dashboard/Settings/dateWisePayout/'.$date;
            // $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'date(created_at) = "'.$date.'" and user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as total_income');
            // $response['user_incomes'] = $this->User_model->get_records('tbl_income_wallet', 'date(created_at) = "'.$date.'" and user_id = "'.$this->session->userdata['user_id'].'"', '*');
            //$response['segament'] = 0;
            // pr($response,true);
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
}
