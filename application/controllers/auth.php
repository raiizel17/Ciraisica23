<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function register(){
        $this->load->view('template/header');
        $this->load->view('auth/register');
        $this->load->view('template/footer');
    }
    public function process_register(){
        $this->form_validation->set_rules('username','username','required|is_unique[users.username]');
        $this->form_validation->set_rules('password','password','required|min_length[6]');
        $this->form_validation->set_rules('confirm_password','password','required|matches[password]');
        $this->form_validation->set_rules('role','role','required');
    
        if($this->form_validation->run()==false){
            $this->load->view('template/header');
            $this->load->view('auth/register');
            $this->load->view('template/footer');
        }else{
            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role')
            ];
            if($this->User_model->insert_user($data)){
                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Register berhasil, silahkan login</div>');
                redirect('auth/login');
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Register gagal, coba lagi</div>');
                redirect('auth/register');
            }
        }
    }
}