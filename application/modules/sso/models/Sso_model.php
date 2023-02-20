<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Sso_model extends CI_Model {

	
	public function insert_data_token($dataIn)
	{
		$this->db->insert('t_data_token_oss',$dataIn);
		return $this->db->insert_id();
	}
	
	function get_username($username=null,$nib=null){
		$sql = "SELECT a.*
				FROM tm_user a
				WHERE (1=1) ";
		if (trim($username) != '' && $username != null ) $sql .= " AND a.username = '$username' ";	
		if (trim($nib) != '' && $nib != null ) $sql .= " AND a.nib = '$nib' ";
		$sql .= " LIMIT 1";
		return $this->db->query($sql);
	}
	
	function insert_data_username($dataIn)
	{
		$this->db->insert('tm_user',$dataIn);
		return $this->db->insert_id();
	}
	
	function get_permohonan($id_izin=null,$user_id=null){
		$sql = "SELECT a.*
				FROM tmdatapemilik a
				WHERE (1=1) ";
		if (trim($user_id) != '' && $user_id != null ) $sql .= " AND a.user_id = '$user_id' ";	
		if (trim($id_izin) != '' && $id_izin != null ) $sql .= " AND a.oss_id_izin = '$id_izin' ";
		$sql .= " LIMIT 1";
		return $this->db->query($sql);
	}
	
	function insert_data_pemilik($dataIn)
	{
		$this->db->insert('tmdatapemilik',$dataIn);
		return $this->db->insert_id();
	}
	
	
	function insert_data_bangunan($dataIn)
	{
		$this->db->insert('tmdatabangunan',$dataIn);
		return $this->db->insert_id();
	}
	
}