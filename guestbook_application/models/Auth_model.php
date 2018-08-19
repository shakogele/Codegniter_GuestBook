<?php
class Auth_model extends CI_Model {

    public function __construct(){
        $this->load->database();
        $this->load->library('session');
    }

    public function get_user(){
        $query = $this->db->get_where('users', array('id' => $this->session->userdata['id']));
        $row = $query->row();
        $this->set_session_data($row);
        return $this->session->userdata;
    }

    public function set_session_data($row){
        $data = array(
                'id' => $row->id,
                'first_name' => $row->first_name,
                'last_name' => $row->last_name,
                'username' => $row->username,
                'email' => $row->email,
                'validated' => true
                );
        $this->session->set_userdata($data);
    }

    public function validate(){
      // Get Username and Password, Check agains xss
      $username = $this->input->post('username');
      $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
      // Query to Get user from DB
      $query = $this->db->get_where('users', array('username' => $username));
      // if user exists
      if(password_verify($this->input->post('password'), $query->row()->password) && !empty($query->row_array()))
      {
          // create session
          $row = $query->row();
          $this->set_session_data($row);
          return true;
      }
      // If the previous process did not validate
      // then return false.

      return false;

    }

    public function update_user(){

      $data = array(
        'email' => $this->input->post('email'),
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'username' => $this->input->post('username')
      );

      if($this->input->post('password')){
        $data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
      }

      $this->db->where('id', $this->session->userdata['id']);
      $this->db->update('users', $data);
      $query = $this->db->get_where('users', array('id' => $this->session->userdata['id']));
      $row = $query->row();
      $this->set_session_data($row);
      return true;
    }

    public function logout(){
        $array_items = array('id', 'email', 'first_name', 'last_name', 'username', 'validated');
        $this->session->unset_userdata($array_items);
        redirect('auth/login');
    }
}
