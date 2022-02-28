<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Epin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('pin_count', 'Pin Count', 'trim|numeric|required|xss_clean');
                $this->form_validation->set_rules('pin_amount', 'Pin Amount', 'trim|numeric|required|xss_clean');
                $this->form_validation->set_rules('master_key', 'Txn Pin', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    //if($this->session->login_otp == $data['otp'] && !empty($this->session->login_otp)){
                        $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), 'user_id');
                        if (!empty($user)) {
                            $master_key = $this->Main_model->get_single_record('tbl_admin',[],'*');
                            if($master_key['master_key'] == $data['master_key']){

                                $pin_count = $this->input->post('pin_count');
                                for ($i = 1; $i <= $pin_count; $i++) {
                                    $packArr = array(
                                        'user_id' => $data['user_id'],
                                        'epin' => $this->generate_pin(),
                                        'amount' => $data['pin_amount']
                                    );
                                    $res = $this->Main_model->add('tbl_epins', $packArr);
                                }
                                if ($res == TRUE) {
                                    $this->session->set_flashdata('message', 'Epins Generated Successfully');
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Generating Epins  Please Try Again ...');
                                }
                            }else{
                                $this->session->set_flashdata('message', 'Invalid Master Key');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid User ID');
                        }
                    // }else{
                    //     $this->session->set_flashdata('message', 'ERROR:: Invalid OTP!');
                        
                    // }
                }
            }
            $packages = $this->Main_model->get_records('tbl_package',['id' => 1],'id,title,price');
            $option = '';
            foreach($packages as $p){
                $option .= '<option value="'.$p['price'].'">'.$p['price'].'</option>';
            }
            $response['form'] = '<div class="form-group">
                                    <label>User Id</label>
                                    <input type="text" id="userId" name="user_id" class="form-control" value="'.set_value('user_id').'" placeholder="User ID"/>
                                    <label class="text-danger" id="UserName">'.form_error('user_id').'</label>
                                </div>
                                <div class="form-group">
                                    <label>Pin Amount</label>
                                    <select class="form-control" name="pin_amount">'.$option.'</select>
                                </div>
                                <div class="form-group">
                                    <label>No. of Epins</label>
                                    <input type="number" name="pin_count" class="form-control" value="'.set_value('epins').'"/>
                                    <label class="text-danger">'.form_error('pin_count').'</label>
                                </div>
                                <div class="form-group">
                                    <label>Txn Pin</label>
                                    <input type="number" name="master_key" class="form-control" value="'.set_value('master_key').'"/>
                                    <label class="text-danger">'.form_error('master_key').'</label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success pull-right">Create</button>
                                </div>';
            
            $response['header'] = 'Generate Epins';
            $this->load->view('form', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function generate_pin() {
        if (is_admin()) {
            $epin = md5(rand(100000, 9999999));
            $pin = $this->Main_model->get_single_record('tbl_epins', array('epin' => $epin), '*');
            if (!empty($pin)) {
                return $this->generate_pin();
            } else {
                return $epin;
            }
        }
    }

    public function AdminEPins() {
        if (is_admin()) {
            // if(!is_access('epins')){
            //     redirect('Admin/Management');
            //     exit;
            // }
            $response['result'] = '';
            $startdate = '2021-02-13';
            $enddate = date('Y-m-d');
            $diff = strtotime($enddate) - strtotime($startdate);
            $days = $diff/(60 * 60 * 24);
            for($i = 0;$i <= $days;$i++){
                $date = date('Y-m-d',strtotime($startdate.'+'.$i.' days'));
                $response['result'][$i]['date'] = $date;
                $response['result'][$i]['epin'] = $this->Main_model->get_single_record('tbl_epins',['date(created_at)'=>  $date,'self' => '0','sender_id' => ''],'count(id) as premium');
               
            }
            $response['thead'] = '<tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>E-pins</th>
                                    
                                </tr>';
            $tbody = [];
            foreach($response['result'] as $tk => $tb){
                $tbody[] = '<tr>
                            <td>'.($tk+1).'</td>
                            <td>'.$tb['date'].'</td>
                            <td>'.$tb['epin']['premium'].' <a href="'.base_url('Admin/Epin/detailPins/'.$tb['date']).'">View</a></td>
                            
                        </tr>';
            }
            $response['tbody'] = $tbody;
            $response['header'] = 'Epins Generated By Admin';
            $this->load->view('table', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function userEpins() {
        if (is_admin()) {
            // if(!is_access('epins')){
            //     redirect('Admin/Management');
            //     exit;
            // }
            $response['result'] = '';
            $startdate = '2021-2-13';
            $enddate = date('Y-m-d');
            $diff = strtotime($enddate) - strtotime($startdate);
            $days = $diff/(60 * 60 * 24);
            for($i = 0;$i <= $days;$i++){
                $date = date('Y-m-d',strtotime($startdate.'+'.$i.' days'));
                $response['result'][$i]['date'] = $date;
                $response['result'][$i]['premium_1800'] = $this->Main_model->get_single_record('tbl_epins',['date(created_at)'=>  $date ,'self' => '1'],'count(id) as premium');
                
            }
            $response['thead'] = '<tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>E-pin</th>
                                    
                                </tr>';
            $tbody = [];
            foreach($response['result'] as $tk => $tb){
                $tbody[] = '<tr>
                            <td>'.($tk+1).'</td>
                            <td>'.$tb['date'].'</td>
                            <td>'.$tb['premium_1800']['premium'].'<a href="'.base_url('Admin/Epin/detailPinsUsers/'.$tb['date']).'">view</a></td>
                            
                        </tr>';
            }
            $response['tbody'] = $tbody;
            $response['header'] = 'Epins Generated By User';
            $this->load->view('table', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function detailPins($date){
        if (is_admin()) {
            // if(!is_access('epins')){
            //     redirect('Admin/Management');
            //     exit;
            // }
            $data = $this->Main_model->get_records('tbl_epins',"date(created_at) = '".$date."' and self = '0' and sender_id = ''   group by user_id",'count(epin) as total,user_id');
            $response['thead'] = '<tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>User ID</th>
                                    <th>Total Pins</th>
                                </tr>';
            $tbody = [];
            foreach($data as $tk => $tb){
                $tbody[] = '<tr>
                            <td>'.($tk+1).'</td>
                            <td>'.$date.'</td>
                            <td>'.$tb['user_id'].'</td>
                            <td>'.$tb['total'].'</td>
                        </tr>';
            }
            $response['tbody'] = $tbody;
            $response['header'] = 'Epin Generated By Users';
            $this->load->view('table', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function detailPinsUsers($date){
        if (is_admin()) {
            // if(!is_access('epins')){
            //     redirect('Admin/Management');
            //     exit;
            // }
            $data = $this->Main_model->get_records('tbl_epins',"date(created_at) = '".$date."' and self = '1'  group by user_id",'count(epin) as total,user_id');
            $response['thead'] = '<tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>User ID</th>
                                    <th>Total Pins</th>
                                </tr>';
            $tbody = [];
            foreach($data as $tk => $tb){
                $tbody[] = '<tr>
                            <td>'.($tk+1).'</td>
                            <td>'.$date.'</td>
                            <td>'.$tb['user_id'].'</td>
                            <td>'.$tb['total'].'</td>
                        </tr>';
            }
            $response['tbody'] = $tbody;
            $response['header'] = 'Epin Generated By Users';
            $this->load->view('table', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function EPinsHistory() {
        if (is_admin()) {
            // if(!is_access('epins')){
            //     redirect('Admin/Management');
            //     exit;
            // }

            $response = array();
            $response['header'] = 'E-pin History';
            $data = $this->Main_model->get_records('tbl_epins   ',[''],'*');
            
            $tbody = [];
            $response['thead'] = '<tr>
                                    <th>#</th>
                                    <th>User ID</th>
                                    <th>Epin</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>';
            foreach($data as $key => $d){
                    if($d['status'] == 0){
                        $status = '<span class="text-success" >Unused</span>';
                    }elseif ($d['status'] == 1) {
                       $status = '<span class="text-danger" >Used</span>';
                    }else{
                        $status = '<span class="" >Transferred</span>';
                    }
               $tbody[] = '<tr>
                    <td>'.($key+1).'</td>
                    <td>'.$d['user_id'].'</td>
                    <td>'.$d['epin'].'</td>
                    <td>'.$status.'</td>
                    <td>'.$d['created_at'].'</td>
                </tr>';
            }
            $response['tbody'] = $tbody; 
            $this->load->view('table',$response);
          }else{ 
            redirect('Admin/Management/login');
        }
    }

}
?>