<?php

class Admin extends CI_Controller {

    function __construct(){

        parent::__construct();
        $this->load->library('session');
        if (!isset($this->session->userdata) || !$this->session->userdata['validated']){
            redirect ('auth/login');
        }
        $this->load->model('reviews_model');
        $this->load->model('auth_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissible">', '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
    }

    public function view($page = 'home')
    {
        if (!file_exists(APPPATH.'views/admin/'.$page.'.php')){
            show_404();
        }
        $data = "";
        if($page === 'dashboard'){
            $data = $this->reviews_model->get_approved_and_dissaproved_reviews();
        }
        $this->load->view('templates/admin/header');
        $this->load->view('admin/'.$page, $data);
        $this->load->view('templates/admin/footer');
    }

    public function reviews($page = ''){

      $this->load->library('session');
      $this->load->helper('form');
      $this->load->library('pagination');

      $per_page = 10;

      if($page === 'approved'){
          $offset = (sizeof($this->uri->segments)  === 5 ) ? $this->uri->segments[5] : 0;
          $reviews_result = $this->reviews_model->get_approved_reviews($offset, $per_page);
          $data['reviews'] = $reviews_result['result'];
          $counter = $reviews_result['count'];

      }
      else if($page === 'unapproved'){
          $offset = (sizeof($this->uri->segments)  === 5 ) ? $this->uri->segments[5] : 0;
          $reviews_result = $this->reviews_model->get_dissapproved_reviews($offset, $per_page);
          $data['reviews'] = $reviews_result['result'];
          $counter = $reviews_result['count'];
      }
      else{
          $offset = (sizeof($this->uri->segments)  === 4 ) ? $this->uri->segments[4] : 0;
          $reviews_result = $this->reviews_model->get_reviews(false, $offset, $per_page);
          $data['reviews'] = $reviews_result['result'];
          $counter = $reviews_result['count'];
      }

      $config['reuse_query_string'] = FALSE;

      $config['base_url'] = '/admin/reviews/'.$page.'/page';
      $config['total_rows'] = $counter;
      $config['per_page'] = $per_page;
      $config['prev_tag_open'] = '<li class="paginate_button previous" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous">';
      $config['prev_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li class="paginate_button" aria-controls="dataTables-example" tabindex="0">';
      $config['num_tag_close'] = '</li>';
      $config['prev_link'] = 'Previous';
      $config['last_tag_open'] = '<li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next">';
      $config['last_tag_close'] = '</li>';
      $config['next_link'] = 'Next';
      $config['next_tag_open'] = '<li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next">';
      $config['next_tag_close'] = '</li>';
      $config['first_tag_open'] = '<li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next">';
      $config['first_tag_close'] = '</li>';

      $this->pagination->initialize($config);
      // Generate List

      $data['list'] = $this->load->view('admin/reviews_list', $data, TRUE);

      $this->load->view('templates/admin/header');
      $this->load->view('admin/reviews', $data);
      $this->load->view('templates/admin/footer');
      return true;

    }

    public function edit_review($slug){

        $this->load->library('session');
        $this->load->helper('form');

        $data['review_item'] = $this->reviews_model->get_reviews($slug);
        if (empty($data['review_item'])){
            show_404();
        }

        if($this->input->post()){

            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Title', 'required|callback_slug_check['.$slug.']');
            $this->form_validation->set_rules('text', 'Text', 'required');
            $this->form_validation->set_rules('approved', 'Approved', 'callback_approved_check');

            if ($this->form_validation->run() === FALSE){
                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/editReview');
                $this->load->view('templates/admin/footer');
                return true;
            }
            else{
                $this->reviews_model->update_review($slug);
                $this->session->set_flashdata('msg', 'successfully Updated');
                $this->session->set_flashdata('msg_cat', 'success');
                redirect ('admin/reviews');
            }

        }

        $this->load->view('templates/admin/header');
        $this->load->view('admin/editReview', $data);
        $this->load->view('templates/admin/footer');
    }

    public function change_review(){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('review_id', 'ReviewId', 'required');
        $this->form_validation->set_rules('submit', 'Submit', 'required');

        if ($this->form_validation->run() === FALSE){
          show_404();
        }
        $review_id = $this->input->post('review_id');

        if($this->input->post('submit') === 'approve'){
              $this->reviews_model->approve_review($review_id);
              $this->session->set_flashdata('msg', 'successfully approved');
              $this->session->set_flashdata('msg_cat', 'success');

        }
        else if($this->input->post('submit') === 'remove'){
              $this->reviews_model->remove_review($review_id);
              $this->session->set_flashdata('msg', 'successfully removed');
              $this->session->set_flashdata('msg_cat', 'success');
        }
        else if($this->input->post('submit') === 'dissapprove'){
              $this->reviews_model->dissapprove_review($review_id);
              $this->session->set_flashdata('msg', 'successfully dissapproved');
              $this->session->set_flashdata('msg_cat', 'success');
        }
        redirect ('admin/reviews');

    }

    public function password_check($password){
       if(strlen($password) === 0){
         return TRUE;
       }
       if (preg_match('#[0-9]#', $password) && preg_match('#[a-zA-Z]#', $password)) {
         return TRUE;
       }
       $this->form_validation->set_message('password_check', 'The {field} field should contain numbers and letters');
       return FALSE;
    }

    public function approved_check($str){

        if(empty($str)){
          return TRUE;
        }
        if(!(empty($str) && $str == 1)){
            return TRUE;
        }
        $this->form_validation->set_message('approved_check', 'The {field} field should be 1');
        return FALSE;
    }

    public function slug_check($title, $slug){

        $this->load->database();
        $slug_for_validation = url_title($this->input->post('title'), 'dash', TRUE);
        $query = $this->db->get_where('reviews', array('slug' => $slug_for_validation));
        if(empty($query->row()) || $slug === $slug_for_validation){
          return true;
        }
        $this->form_validation->set_message('slug_check', 'Please Change Title as in DB already exists record with same slug.');
        return false;
    }

    public function view_profile(){

        if($this->input->post()){
            // Validation Check
            if($this->input->post('username') != $this->session->userdata['username']) {
               $is_unique =  '|is_unique[users.username]';
            } else {
               $is_unique =  '';
            }
            if(strlen($this->input->post('password')) > 0 || strlen($this->input->post('password_confirmation')) >0 ) {
               $is_required =  'required';
            } else {
               $is_required =  '';
            }

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('first_name', 'FirstName', 'required');
            $this->form_validation->set_rules('last_name', 'LastName', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]'.$is_unique);
            $this->form_validation->set_rules('password', 'Password', $is_required.'|min_length[5]|callback_password_check');
            $this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'matches[password]');

            if ($this->form_validation->run() === FALSE) {

                $data['user'] = $this->auth_model->get_user();
                $this->load->view('templates/admin/header');
                $this->load->view('admin/profile', $data);
                $this->load->view('templates/admin/footer');
                return true;
            }

            $this->auth_model->update_user();
            $this->session->set_flashdata('msg', 'successfully updated');
            $this->session->set_flashdata('msg_cat', 'success');

        }

        $data['user'] = $this->auth_model->get_user();

        $this->load->view('templates/admin/header');
        $this->load->view('admin/profile', $data);
        $this->load->view('templates/admin/footer');

    }

}
