<?php

class Pages extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('session');
    }

    public function view($page = 'home')
    {

        if (!file_exists(APPPATH.'views/pages/'.$page.'.php')){
            show_404();
        }
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = ucfirst($page);

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

}
