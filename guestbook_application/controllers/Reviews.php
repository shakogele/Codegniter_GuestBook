<?php
    class Reviews extends CI_Controller {

        public function __construct(){
            parent::__construct();
            $this->load->model('reviews_model');
            $this->load->helper('url_helper');
        }

        public function index(){
            $data['reviews'] = $this->reviews_model->get_reviews();
            $data['title'] = 'All Reviews';

            $this->load->view('templates/header', $data);
            $this->load->view('reviews/index', $data);
            $this->load->view('templates/footer');
        }

        public function view($slug = NULL){
            $data['review_item'] = $this->reviews_model->get_reviews($slug);
            if (empty($data['review_item'])){
                show_404();
            }
            $data['title'] = $data['review_item']['title'];

            $this->load->view('templates/header', $data);
            $this->load->view('reviews/view', $data);
            $this->load->view('templates/footer');
        }

        public function create(){
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Create a Review';

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('text', 'Text', 'required');

            if ($this->form_validation->run() === FALSE){
                $this->load->view('templates/header', $data);
                $this->load->view('reviews/create');
                $this->load->view('templates/footer');
            }
            else{
                $this->reviews_model->set_reviews();
                $this->load->view('reviews/success');
            }
        }
        
    }
