<?php
class User_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('date');
	}
	/**********USER_LOGIN************/
	public function login($id,$pass)
	{
		// if($pass=="admin") $pass=$pass;
		$pass=md5($pass);
		$row=array();
		$query =$this->db->query("SELECT * FROM `user` WHERE `user_id`='$id' AND `password`='$pass'");
		if($query->num_rows()==1)
		{
			$row = $query->row();
		}
		return 	$row;
	}
	/**********USER_DATA************/
	public function get_user_data($id)
	{
		$query =$this->db->query("SELECT * FROM `user` WHERE `id`='$id' ");
		return $query->row_array();
	}
	public function get_users()
	{
		$query =$this->db->query("SELECT * FROM `user` WHERE `user_type` !='0' ORDER BY id DESC");
		return $query->result();
	}
	/**********USER_REGISTRATION************/
	public function registeruser($user_id,$password,$full_name,$email,$user_type,$userpd)
	{
		$id=0;
		$datetime= date('Y-m-d H:i:s');
		$query =$this->db->query("SELECT * FROM `user` WHERE `user_id`='$user_id'");
		if($query->num_rows()==0)
		{
				$query =$this->db->query("INSERT INTO `user`(`user_id`,`password`,`full_name`,`email`,`user_type`,`userpd`,`datetime`) values('$user_id','$password','$full_name','$email','$user_type','$userpd','$datetime')");
				$id=$this->db->insert_id();
		}
		return 	$id;
	}
	/**********USER_DELETE************/
	public function deleteuser($id)
	{
		$query =$this->db->query("select * from `user` where `id`='$id'");
		if($query->num_rows()){
			$query =$this->db->query(" Delete from `user` WHERE `id`='$id'");
			return true;
		}else{
			return false;
		}
	}
}