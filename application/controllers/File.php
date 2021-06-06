<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class File extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('File_model');
    }
    /** USER-TYPE 0-ADMIN 1-EMPLOYEE 2-CUSTOMER **/
    public function filelist()
    {
        if (file_exists(APPPATH."views/ui")) {show_404();}
        if ($id = $this->session->userdata(UserSession . 'userid')) {
            $type = $this->session->userdata(UserSession . 'usertype');
            $data['links']    = 'application/views/templates/links.php';
            $data['nav']    = 'application/views/templates/nav.php';
            $data['left_nav']    = 'application/views/templates/left_nav.php';
            $data['script']    = 'application/views/templates/script.php';
            if ($type == 0) {
                $data['file_data'] = $this->File_model->get_allfiles();
                $this->load->view('filelistadmin', $data);
            }else{
                $data['sharefileto'] = $this->File_model->get_sahrefileto($id,$type);
                $data['readfile'] = $this->File_model->get_readfile($id);
                $data['writefile'] = $this->File_model->get_writefile($id);
                $this->load->view('filelist', $data);
            }
        }else{
            $this->load->view('login');
        }
    }
    public function registerfile()
    {
		$this->form_validation->set_rules('file', 'File', 'trim');
        $this->form_validation->set_rules('shareto[]', 'Share to', 'trim|required');
        if ($this->form_validation->run() == false) {
            $result['status']  = 'error';
            $result['message'] = validation_errors();
        } else {
            $filepath = '';
            $owner=$this->session->userdata(UserSession . 'userid');
            $shareto=$this->input->post("shareto");
			if($shareto) $shareto= implode(",",$this->input->post("shareto")); else $shareto='';
			$config['upload_path']   = './assets/uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|txt|pdf|csv|doc|docx|mp4';
			$config['max_size'] = '4096';
			$config['max_width'] = '4096';
			$config['max_height'] = '4096';
			$config['encrypt_name'] = TRUE;
			$config['overwrite']    = TRUE;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('file')) { $error = $this->upload->display_errors(); }
			else { $data = $this->upload->data(); $filepath = $data['file_name']; }
            $file_id = $this->File_model->registerfile($owner,$filepath,$shareto);
            if ($file_id > 0) {
                $result['status']       = 'success';
                $result['message']      = "Added Successfully";
            } else
               $result['message'] = "Something went wrong";
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($result));
        $string = $this->output->get_output();
        echo $string;
        exit();
    }
    public function deletefile()
    {
        if($query = $this->File_model->deletefile($this->input->post("id"))){
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
}