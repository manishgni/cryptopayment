<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Epin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation','pagination','security', 'email'));
        $this->load->model(array('Shopping_model','User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }


    public function epinHistory($type){
        if (is_logged_in()) { 
            
            if($type == 0){
                $where = array(
                    'user_id' => $this->session->userdata['user_id'],
                );
                $header = 'Epin History';
            }elseif ($type == 1) {
               $where = array(
                    'user_id' => $this->session->userdata['user_id'],
                    'status' => 0,
                );
              $header = 'Unused Epins';  
            }elseif ($type == 2) {
               $where = array(
                    'user_id' => $this->session->userdata['user_id'],
                    'status' => 1,
                );
                $header= 'Used Epins';
            }elseif ($type == 3) {
               $where = array(
                    'user_id' => $this->session->userdata['user_id'],
                    'status' => 2,
                );
                $header = 'Transferred Epins';
            }
            $total_id = $this->User_model->get_single_record('tbl_epins',$where,'ifnull(count(id),0) as ids');
            $data = $this->User_model->get_records('tbl_epins',$where,'*');
            $tbody = [];
            $response['thead'] = ['#','Epin','Sender ID','Status','Used For','Date','Action'];
            foreach($data as $key => $d){
                if( $d['status'] == 0){
                    $status = '<span class="text-success" >Unused</span>';
                    $date =  $d['created_at'];
                    $link = '<a href="'.base_url('Dashboard/Activation/index/'.$d['epin']).'">Activate Account</a>';
                }elseif ($d['status'] == 1) {
                    $status = '<span class="text-danger" >Used</span>';
                    $date =  $d['updated_at'];
                    $link = '';
                }elseif ($d['status'] == 2) {
                    $status = 'Transferred';
                    $date =  $d['updated_at'];
                    $link = '';
                }
               $tbody[] = '<tr>
                    <td>'.($key+1).'</td>
                    <td>'.$d['epin'].'</td>
                    <td>'.$d['sender_id'].'</td>
                    <td>'.$status.'</td>
                    <td>'.$d['used_for'].'</td>
                    <td>'.$date.'</td>
                    <td>'.$link.'</td>
                </tr>';
            }
            $response['tbody'] = $tbody; 
            $response['header'] = $header .'('.$total_id['ids'].')';
            $this->load->view('table',$response);
         }else{
             redirect('Dashboard/login');
         }
    }

     public function generate_pin() {
        if (is_logged_in()) {
            $epin = md5(rand(100000, 9999999));
            $pin = $this->User_model->get_single_record('tbl_epins', array('epin' => $epin), '*');
            if (!empty($pin)) {
                return $this->generate_pin();
            } else {
                return $epin;
            }
        }
    }

    public function transfer_epins() {
        if (is_logged_in()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('epins', 'Epins', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('user_id', 'User ID', 'required|trim|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), 'user_id,phone');
                    $master_key = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'user_id,phone,master_key');
                    if ($master_key['master_key'] == $data['master_key']) {
                        if (!empty($user)) {
                            $available_pins = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0,'amount' => $data['amount']), 'ifnull(count(id),0) as total_epins');
                            if ($data['epins'] > 0) {
                                if ($data['epins'] <= $available_pins['total_epins']) {
                                    for ($i = 1; $i <= $data['epins']; $i++) {
                                        $pin = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0,'amount' => $data['amount']), '*');
                                        $this->User_model->update('tbl_epins', array('id' => $pin['id']), array('status' => 2, 'used_for' => $data['user_id']));
                                        $packArr = array(
                                            'user_id' => $data['user_id'],
                                            'epin' => $this->generate_pin(),
                                            'amount' => $pin['amount'],
                                            'sender_id' => $this->session->userdata['user_id'],
                                            //'type' => $pin['type'],
                                        );
                                        $res = $this->User_model->add('tbl_epins', $packArr);
                                    }
                                }else{
                                    $this->session->set_flashdata('message', 'You have not '.ucwords(str_replace('_',' ',$data['type'])).' to transfer'); 
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Please Set Atleast 1 Pin');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid User ID');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid Master Key');
                    }
                }
            }
            $response['header'] = 'Transfer Epin';
            $response['package'] = $this->User_model->get_records('tbl_package',array(),'*');
            $response['available_epins'] = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0), 'ifnull(count(id),0) as total_epins');
            $this->load->view('transfer_epin', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

}
?>