<?php
class Reviews_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function get_reviews($slug = FALSE, $offset=null, $per_page=null){
        if ($slug === FALSE){
            $results = $this->db->get('reviews', $per_page, $offset)->result_array();
            $count = $this->db->get('reviews')->num_rows();
            return ['result' => $results, 'count' => $count];
        }
        $query = $this->db->get_where('reviews', array('slug' => $slug));
        return $query->row_array();
    }

    public function get_approved_reviews($offset=null,$per_page=null){
        $results = $this->db->get_where('reviews', array('approved' => 1), $per_page, $offset)->result_array();
        $count = $this->db->get_where('reviews', array('approved' => 1))->num_rows();
        return ['result' => $results, 'count' => $count];
    }

    public function get_dissapproved_reviews($offset=null,$per_page=null){
        $results = $this->db->get_where('reviews', array('approved' => 0), $per_page, $offset)->result_array();
        $count = $this->db->get_where('reviews', array('approved' => 0))->num_rows();
        return ['result' => $results, 'count' => $count];
    }

    public function set_reviews(){
        $this->load->helper('url');
        $slug = url_title($this->input->post('title'), 'dash', TRUE);
        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'text' => $this->input->post('text')
        );
        return $this->db->insert('reviews', $data);
    }

    public function update_review($url_slug){
        $this->load->helper('url');
        $approved = ($this->input->post('approved')) ? $this->input->post('approved') : 0;
        $slug = url_title($this->input->post('title'), 'dash', TRUE);
        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text'),
            'approved' => $approved
        );
        $this->db->where('slug', $url_slug);
        $query = $this->db->update('reviews', $data);
        return true;
    }

    public function approve_review($review_id){
        $this->db->set('approved', 1);
        $this->db->where('id', $review_id);
        $this->db->update('reviews');
    }

    public function remove_review($review_id){
        $this->db->where('id', $review_id);
        $this->db->delete('reviews');
    }

    public function dissapprove_review($review_id){
        $this->db->set('approved', 0);
        $this->db->where('id', $review_id);
        $this->db->update('reviews');
    }

    public function get_approved_and_dissaproved_reviews(){

        $this->db->where('approved', 1);
        $this->db->from('reviews');
        $approved_reviews =  $this->db->count_all_results();
        $this->db->where('approved', 0);
        $this->db->from('reviews');
        $unapproved_reviews =  $this->db->count_all_results();
        return ['approved' => $approved_reviews, 'unapproved' => $unapproved_reviews];
    }

}
