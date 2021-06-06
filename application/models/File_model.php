<?php
class File_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('date');
	}
    /** USER-TYPE 0-ADMIN 1-EMPLOYEE 2-CUSTOMER **/
	public function get_allfiles()
	{
		$query =$this->db->query("SELECT * FROM `file` fl LEFT JOIN `user` ur ON fl.file_owner = ur.id ORDER BY fl.file_id DESC");
		return $query->result();
	}
	public function get_sahrefileto($id,$type)
	{
		if($type == 1){
			$query =$this->db->query("SELECT `id`,`full_name` FROM `user` WHERE `user_type` != '0' and `id` != $id ORDER BY id DESC");
			return $query->result();
		}else if($type == 2){
			$query =$this->db->query("SELECT `id`,`full_name` FROM `user` WHERE `user_type` = '1' and `id` != $id ORDER BY id DESC");
			return $query->result();
		}
	}
	public function get_readfile($id)
	{
		$query =$this->db->query("SELECT `read_access` from `user` where `id`='$id'");
		if($query->num_rows()){
			$row = $query->row();
			$readaccess=$row->read_access;
			$raccess = str_replace(",", "|", $readaccess);
			$remove_id = explode(',',$readaccess);
			$id_count = (array_filter($remove_id));
			for($i=1; $i<=count($id_count); $i++){
				$query =$this->db->query("SELECT * FROM `file` WHERE `file_id`='$id_count[$i]'");
				if($query->num_rows()){
				}else{
					$query =$this->db->query("UPDATE user SET read_access = replace(replace(read_access, ',$id_count[$i]', ''), '', '') where id = $id");
				}
			}
			$query =$this->db->query("SELECT * from `file` fl LEFT JOIN `user` ur ON fl.file_owner = ur.id WHERE ( CONCAT(',', fl.file_id, ',') REGEXP ',($raccess),' )ORDER BY fl.file_id DESC");
			return $query->result();
		}
	}
	public function get_writefile($id)
	{
		$query =$this->db->query("SELECT `write_access` from `user` where `id`='$id'");
		if($query->num_rows()){
			$row = $query->row();
			$writeaccess=$row->write_access;
			$waccess = str_replace(",", "|", $writeaccess);
			$remove_id = explode(',',$writeaccess);
			$id_count = (array_filter($remove_id));
			for($i=1; $i<=count($id_count); $i++){
				$query =$this->db->query("SELECT * FROM `file` WHERE `file_id`='$id_count[$i]'");
				if($query->num_rows()){
				}else{
					$query =$this->db->query("UPDATE user SET write_access = replace(replace(write_access, ',$id_count[$i]', ''), '', '') where id = $id");
				}
			}
			$query =$this->db->query("SELECT * from `file` fl LEFT JOIN `user` ur ON fl.file_owner = ur.id WHERE ( CONCAT(',', fl.file_id, ',') REGEXP ',($waccess),' ) ORDER BY fl.file_id DESC");
			return $query->result();
		}
	}
	/**********FILE_REGISTRATION************/
	public function registerfile($owner,$filepath,$shareto)
	{
		$id=0;
		$datetime= date('Y-m-d H:i:s');
		$query =$this->db->query("INSERT INTO `file`(`file_owner`,`file_path`,`file_accessby`,`datetime`) VALUES ('$owner','$filepath','$shareto','$datetime')");
		$id=$this->db->insert_id();
		$query =$this->db->query("UPDATE `user` SET `read_access` = CONCAT(read_access, ',$id'), `write_access` = CONCAT(write_access, ',$id') WHERE `id` = '$owner'");
		$query =$this->db->query("UPDATE `user` SET `read_access` = CONCAT(read_access, ',$id') WHERE `id` IN ($shareto)");
		return 	$id;
	}
	public function deletefile($id)
	{
		$query =$this->db->query("select * from `file` where `file_id`='$id'");
		if($query->num_rows()){
			$row = $query->row();
			$file_path=$row->file_path;
			if(!empty($file_path)){
			unlink("assets/uploads/".$file_path);}
			$query =$this->db->query(" Delete from `file` WHERE `file_id`='$id'");
			return true;
		}else{
			return false;
		}
	}

}