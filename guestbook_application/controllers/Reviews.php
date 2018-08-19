<?php
class Reviews extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('reviews_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    public function index(){

        $this->load->library('pagination');
        $offset = $page = (sizeof($this->uri->segments)  === 3 ) ? $this->uri->segments[3] : 0;
        $per_page = 5;
        $reviews_result = $this->reviews_model->get_approved_reviews($offset, $per_page);

        $data['reviews'] = $reviews_result['result'];

        $config['base_url'] = '/reviews/page';
        $config['total_rows'] = $reviews_result['count'];
        $config['per_page'] = $per_page;
        $config['prev_tag_open'] = '<li class="page-item previous" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active" aria-controls="dataTables-example" tabindex="0"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item" aria-controls="dataTables-example" tabindex="0">';
        $config['num_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['last_tag_open'] = '<li class="page-item next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="page-item next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next">';
        $config['next_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);

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

        $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissible">', '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('reviews/create');
            $this->load->view('templates/footer');
        }
        else{
            $this->reviews_model->set_reviews();
            $this->session->set_flashdata('msg', 'successfully created');
            $this->session->set_flashdata('msg_cat', 'success');
            redirect ('reviews');
        }
    }

}
