<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $response = array();
            $response['tasks'] = $this->Main_model->get_records('tbl_task_links', array(), '*');
            $this->load->view('task_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function Create() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('link', 'Link', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $tasks = $this->Main_model->get_single_record('tbl_task_links', array(), 'ifnull(count(id),0)  as total_links');
                    if($tasks['total_links'] < 15){
                        $TaskData = array(
                            'link' => $data['link'],
                        );
                        $this->Main_model->add('tbl_task_links', $TaskData);
                        $this->session->set_flashdata('message', 'Task Created Successfully');
                    }else{
                        $this->session->set_flashdata('message', '15 Tasks Already Created');
                    }
                }
            }
            $this->load->view('create_task', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function Edit($task_id) {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('link', 'Link', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $updtask =  $updres = $this->Main_model->update('tbl_task_links', array('id' => $task_id), array('link' => $data['link']));
                    if ($updres == true) {
                        $this->session->set_flashdata('message', 'Task Updated Successfully');
                    }else{
                        $this->session->set_flashdata('message', 'Error while Updating Task');
                    }
                }
            }
            $response['task'] = $this->Main_model->get_single_record('tbl_task_links', array('id' => $task_id), '*');
            $this->load->view('edit_task', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
}