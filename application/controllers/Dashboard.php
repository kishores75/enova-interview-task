<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('User_model');
    }
    public function index()
    {
        if (file_exists(APPPATH."views/ui")) {show_404();}
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
}