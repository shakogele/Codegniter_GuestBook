<?php
class Auth extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->model('auth_model');
    }

    public function login(){
        // if user is logged In
        if (isset($this->session->userdata['validated']) && $this->session->userdata['validated']){
            redirect ('admin/dashboard');
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissible">', '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');

        $this->form_validation->set_rules(
            'username', 'Username',
            'required|min_length[5]|max_length[12]',
            array(
                'required'      => 'You have not provided %s.'
            )
          );

        $this->form_validation->set_rules('password', 'Password',
            'trim|required|min_length[6]|max_length[25]',
            array(
              'required'        => 'You Have not provided %s'
            )
          );
        $data['title'] = 'Login';

        if ($this->form_validation->run() === FALSE) {

            $this->load->view('templates/header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/footer');

        } else {

            $result = $this->auth_model->validate();
            if (!$result) {
                $this->session->set_flashdata('msg', 'Either Username or Password was not correct. Please Try Again.');
                $this->session->set_flashdata('msg_cat', 'danger');
                redirect('auth/login');
            } else {
              redirect('admin/dashboard');
            }

        }

    }

    public function logout(){
        $this->auth_model->logout();
    }

}
