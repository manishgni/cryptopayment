<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SiteSetting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }
    public function index(){
        if(is_admin()){
            if(is_admin()){
                if($this->input->server('REQUEST_METHOD') == "POST"){
                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('phone','Phone','trim|required');
                    $this->form_validation->set_rules('email','Email','trim|required');
                    $this->form_validation->set_rules('address','Address','trim|required');
                    if($this->form_validation->run() != false){
                        //if($_FILES['image']['error'] == 0){
                            //$config['upload_path'] = './uploads/';
                            //$config['allowed_types'] = 'pdf';
                            //$config['max_size'] = 1024;
                            //$config['file_name'] = 'pdf'.time();
                            //$this->load->library('upload', $config);
                            //if (!$this->upload->do_upload('image')) {
                                //$this->session->set_flashdata('message',$this->upload->display_errors());
                            //}else{
                                //$fileData = array('upload_data' => $this->upload->data());
                                // $formData = [
                                //     'pdf' => $fileData['upload_data']['file_name'],
                                //     'phone' => $data['phone'],
                                //     'email' => $data['email'],
                                //     'content' => $data['content'],
                                //     'news' => $data['news'],
                                //     'company_profile' => $data['company_profile'],
                                //     'bank_details' => $data['bank_details'],
                                //     'legal' => $data['legal'],
                                // ];
                                // $res = $this->Main_model->update('tbl_site_content',['id' => '1'],$formData);
                                // if($res){
                                //     $this->session->set_flashdata('message','Data Updated Successfully');
                                //     redirect('Admin/SiteSetting');
                                // }else{
                                //     $this->session->set_flashdata('message','Error while updating data');
                                // }
                            //}
                        //}else{
                            $formData = [
                                'phone' => $data['phone'],
                                'email' => $data['email'],
                                'address' => $data['address'],
                                //'content' => $data['content'],
                                //'news' => $data['news'],
                                //'company_profile' => $data['company_profile'],
                                //'bank_details' => $data['bank_details'],
                                //'legal' => $data['legal'],
                            ];
                            $res = $this->Main_model->update('tbl_site_content',['id' => '1'],$formData);
                            if($res){
                                $this->session->set_flashdata('message','Data Updated Successfully');
                                redirect('Admin/SiteSetting');
                            }else{
                                $this->session->set_flashdata('message','Error while updating data');
                            }
                        //}
                    }
                }
                $Record = $this->Main_model->get_single_record('tbl_site_content',['id' => '1'],'*');

                $response['field'] = [
                    // '1' => ['label' => 'File','name' => 'image','type' => 'file','placeholder' => '' , 'id' => '','style' => '' , 'value' => ''],
                    '2' => ['label' => 'Phone','name' => 'phone','type' => 'text','placeholder' => 'Enter Phone Number' , 'id' => '','style' => '','value' => $Record['phone']],
                    '3' => ['label' => 'Email','name' => 'email','type' => 'email','placeholder' => 'Enter Email Address' , 'id' => '','style' => '', 'value' => $Record['email']],

                ];
                $response['textarea'] = '<label>Address</label><textarea id="" class="form-control" style="border: 1px solid black;" name="address">'.$Record['address'].'</textarea>';
                // $response['textarea'] = '<label>Content</label><textarea id="long_desc" class="form-control" style="border: 1px solid black;" name="content">'.$Record['content'].'</textarea>';
                // $response['textarea1'] = '<label>News</label><textarea id="long_desc1" class="form-control" style="border: 1px solid black;" name="news">'.$Record['news'].'</textarea>';
                // $response['textarea2'] = '<label>Company Profile</label><textarea id="long_desc2" class="form-control" style="border: 1px solid black;" name="company_profile">'.$Record['company_profile'].'</textarea>';
                // $response['textarea3'] = '<label>Bank Details</label><textarea id="long_desc3" class="form-control" style="border: 1px solid black;" name="bank_details">'.$Record['bank_details'].'</textarea>';
                // $response['textarea4'] = '<label>Legal</label><textarea id="long_desc4" class="form-control" style="border: 1px solid black;" name="legal">'.$Record['legal'].'</textarea>';
                $response['submit'] = 'Update';
                $response['header'] = 'Site Management';
                
                $tbody = array();
                //foreach($Record as $key => $r){
                    // if(!empty($Record['pdf'])){
                    //     $file = '<iframe src='.base_url("uploads/".$Record['pdf']).' height="200px" widht="200px"></iframe>';
                    // }else{
                    //      $file = 'No Pdf Uploaded';
                    // }
                    $tbody[] = '<tr>
                                        <td>1</td>
                                        <td>'.$Record['phone'].'</td>
                                        <td>'.$Record['email'].'</td>
                                        <td>'.$Record['address'].'</td>
                                    </tr>';
                //}
                $response['thead'] = ['#','Phone','Email','Address'];
                $response['tbody'] = $tbody;
                $this->load->view('siteSetting',$response);
            }else{
                redirect('Admin/Management/login');
            }
        }else{
            redirect('Admin/Management/login');
        }
    }

}