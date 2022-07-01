<?php

class LoginAuth extends CI_Controller
{
    public function index()
    {
        show_404();
    }

    public function login()
    {
        $this->load->model('LoginAuthModel');
        $this->load->library('form_validation');

        $rules = $this->LoginAuthModel->formRules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            return $this->load->view('formLogin');
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($this->LoginAuthModel->login($username, $password)) {
            redirect('admin');
        } else {
            $this->session->set_flashdata('message_login_error', 'Login Gagal, Username atau Password Salah!');
            $this->session->keep_flashdata('message_login_error');
            //var_dump($this->session->flashdata('message_login_error'));
        }

        
    //$p = password_hash('admin', PASSWORD_DEFAULT);
   // echo $p;

        $this->load->view('formLogin');
    }

    public function logout()
    {
        $this->load->model('LoginAuthModel');
        $this->LoginAuthModel->logout();
        redirect(site_url());
    }
}
