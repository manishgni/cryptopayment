<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function changePermission($user) {
        if (is_admin()) {
            // if(!is_access('Permission')){
            //     redirect('Admin/Management');
            //     exit;
            // }
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $checkUser = $this->Main_model->get_single_record('tbl_users',['user_id' => $data['user_id']],'user_id');
                if(!empty($checkUser['user_id'])){
                    $userdata = ['access' => json_encode($data)];
                    if(!empty($data['d_pin_generation'])){
                        $this->downlinePermission($data['user_id'],$data['d_pin_generation']);
                    }else{
                        $this->downlinePermission($data['user_id'],array());
                    }
                    $res = $this->Main_model->update('tbl_users',['user_id' => $checkUser['user_id']],$userdata);
                    if($res){
                        $this->session->set_flashdata('message','Permission updated successfully');
                    }else{
                        $this->session->set_flashdata('message','Network error,Please try later');
                    }
                }else{
                    $this->session->set_flashdata('message','Please choose valid User ID');
                }
            }
            $userDetails = $this->Main_model->get_single_record('tbl_users',['user_id' => $user],'access');
            $access = json_decode($userDetails['access'],true);
            $withdraw = !empty($access['withdraw'])?'checked':'';
            $pin_generation = !empty($access['pin_generation'])?'checked':'';
            $d_pin_generation = !empty($access['d_pin_generation'])?'checked':'';
            $response['form'] = '<div class="form-group">
                                    <label>User ID</label>
                                    <input type="text" class="form-control" name="user_id" value="'.$user.'" id="user_id" readonly>
                                    <span class="text-danger">'.form_error('user_id').'</span>
                                    <span id="errorMessage"></span>
                                </div>
                                <div class="form-group">
                                    <label>Permissions</label>
                                    <input type="checkbox" name="withdraw" value="withdraw" '.$withdraw.'>Withdraw
                                    <input type="checkbox" name="pin_generation" value="pin_generation" '.$pin_generation.'>Pin Generation
                                    <input type="checkbox" name="d_pin_generation" value="d_pin_generation" '.$d_pin_generation.'>Downline Pin Generation
                                </div>
                                <div class="form-group">
                                    <button type="subimt" class="btn btn-success" />Update</button>
                                </div>';
            $response['header'] = 'Permission Management';
            $this->load->view('form', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    private function downlinePermission($user,$status){
        $users = $this->Main_model->get_records('tbl_downline_count',['user_id' => $user],'downline_id');
        foreach($users as $key => $u){
            $checkAccess = $this->Main_model->get_single_record('tbl_users',['user_id' => $u['downline_id']],'user_id,access');
            $access = json_decode($checkAccess['access'],true);
            if(!empty($status)){
                array_merge($access,$status);
            }else{
                //array_search('d_pin_generation',$access);
                unset($access['d_pin_generation']);
            }
            $access2 = json_encode($access);
            $userData = ['access' => $access2];
            //pr($access2);
            $this->Main_model->update('tbl_users',['user_id' => $u['downline_id']],$userData);
        }
    }

    // public function test($user){
    //     $status['d_pin_generation'] = 'd_pin_generation';
    //     //$status = [];
    //     $this->downlinePermission($user,$status);
    // }

    public function deactivateUser(){
        if (is_admin()) {
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id','User ID','trim|required');
                if($this->form_validation->run() != false){
                    $checkUser = $this->Main_model->get_single_record('tbl_users',['user_id' => $data['user_id']],'user_id,package_id,package_amount,topup_date');
                    if(!empty($checkUser['user_id'])){
                        $userData = [
                            'paid_status' =>  0,
                            'package_amount' => 0,
                            'package_id' => 0, 
                            'topup_date' => '0000-00-00 00:00:00',
                        ];
                        $res = $this->Main_model->update('tbl_users',['user_id' => $checkUser['user_id']],$userData);
                        if($res){
                            $topupDetails = [
                                'user_id' => $checkUser['user_id'],
                                'by_user' => 'admin',
                                'package_id' => $checkUser['package_id'],
                                'package_amount' => $checkUser['package_amount'],
                                'topup_date' => $checkUser['topup_date'],
                            ];
                            $this->Main_model->add('tbl_deactivated_details',$topupDetails);
                            $this->session->set_flashdata('message','User Account deactivated successfully');
                        }else{
                            $this->session->set_flashdata('message','Network error,Please try later');
                        }
                    }else{
                        $this->session->set_flashdata('message','Invalid User ID');
                    }
                }
            }
            $response['form'] = '<div class="form-group">
                                    <label>User ID</label>
                                    <input type="text" class="form-control" name="user_id" value="'.set_value('user_id').'" id="user_id">
                                    <span class="text-danger">'.form_error('user_id').'</span>
                                    <span id="errorMessage"></span>
                                </div>
                                <div class="form-group">
                                    <button type="subimt" class="btn btn-success" />Deactivate</button>
                                </div>';
            $response['header'] = 'Deactivate User ID';
            $this->load->view('form', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    
}