<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('User_model');
    }
    /** USER-TYPE 0-ADMIN 1-EMPLOYEE 2-CUSTOMER **/
    public function index()
    {
        if (file_exists(APPPATH."views/dashboard")) {show_404();}
        if ($id = $this->session->userdata(UserSession . 'userid')) {
            $data['user_data'] = $this->User_model->get_user_data($id);
            $data['links']    = 'application/views/templates/links.php';
            $data['nav']    = 'application/views/templates/nav.php';
            $data['left_nav']    = 'application/views/templates/left_nav.php';
            $data['script']    = 'application/views/templates/script.php';
            $this->load->view('dashboard', $data);
        }else{
            $this->load->view('login');
        }
    }
    /********USER_LOGIN**********/
    public function login()
    {
        if ($this->session->userdata(UserSession . 'userid')) die;
        if (!$this->input->is_ajax_request()) { echo 'No direct script is allowed'; die; }
        $this->form_validation->set_rules('user_id', 'User id', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $result['status']  = 'error';
            $result['message'] = validation_errors();
        } else {
            $id = $this->input->post("user_id");
            $pass = $this->input->post("password");
            $row = $this->User_model->login($id,$pass);
            if ($row) {
                    $this->session->set_userdata(UserSession . 'userid', $row->id);
                    $this->session->set_userdata(UserSession . 'usertype', $row->user_type);
                    $result['status']       = 'success';
                    $result['message']      = 'Login Successfully';
                    $result['redirect_url'] = 'dashboard.html';
            } else{
                $result['message'] = '<div class="card-alert card purple"><div class="card-content white-text"><p>Invalid User ID or Password</p></div></div>';
            }
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($result));
        $string = $this->output->get_output();
        echo $string;
        exit();
    }
    /**************USER_REGISTER****************/
    public function registeruser()
    {
        $this->form_validation->set_rules('user_id', 'User id', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('full_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
        $this->form_validation->set_rules('user_type', 'trim|required');
        if ($this->form_validation->run() == false) {
            $result['status']  = 'error';
            $result['message'] = validation_errors();
        } else {
            $user_id=$this->input->post("user_id");
            $password=md5($this->input->post("password"));
            $userpd=$this->input->post("password");
            $full_name=$this->input->post("full_name");
            $email=$this->input->post("email");
            $user_type=$this->input->post("user_type");
            $id = $this->User_model->registeruser($user_id,$password,$full_name,$email,$user_type,$userpd);
            if ($id > 0) {
                $result['status']       = 'success';
                $result['message']      = "Added Successfully";
            } else
               $result['message'] = "User id Already Exists";
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($result));
        $string = $this->output->get_output();
        echo $string;
        exit();
    }
    /**************USER_DELETE****************/
    public function deleteuser()
    {
        if($query = $this->User_model->deleteuser($this->input->post("id"))){
            if ($query) {
                $result['status'] = 'success';
                $result['message'] = "Deleted Successfully";
            } else{
                $result['message'] = "Something Went Wrong";
            }
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($result));
        $string = $this->output->get_output();
        echo $string;
        exit();
    }
    /**************USER****************/
    public function userlist()
    {
        if (file_exists(APPPATH."views/userlist")) {show_404();}
        if ($id = $this->session->userdata(UserSession . 'userid')) {
            $data['user_data'] = $this->User_model->get_users();
            $data['links']    = 'application/views/templates/links.php';
            $data['nav']    = 'application/views/templates/nav.php';
            $data['left_nav']    = 'application/views/templates/left_nav.php';
            $data['script']    = 'application/views/templates/script.php';
            $this->load->view('userlist', $data);
        }else{
            $this->load->view('login');
        }
    }
    public function useradd()
    {
        if (file_exists(APPPATH."views/useradd")) {show_404();}
        if ($id = $this->session->userdata(UserSession . 'userid')) {
            $data['links']    = 'application/views/templates/links.php';
            $data['nav']    = 'application/views/templates/nav.php';
            $data['left_nav']    = 'application/views/templates/left_nav.php';
            $data['script']    = 'application/views/templates/script.php';
            $this->load->view('useradd', $data);
        }else{
            $this->load->view('login');
        }
    }
}