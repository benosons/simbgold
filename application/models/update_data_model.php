<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Update_data_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function get_data_oss_list($counting=0,$dipaging=0,$limit=10,$offset=1,$id=null,$cari=null)
	{
		if (isset($counting) && $counting == 1) 
		{
			$sql = "SELECT COUNT(a.oss_id) as total";
		}
		else 
		{
			$sql = "SELECT a.* ";
		}
		$sql .= "	FROM tm_data_oss a WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.oss_id = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		if (isset($dipaging) && $dipaging ==1)
			$sql .= " Group by a.oss_id ORDER BY a.oss_id DESC limit $offset, $limit ";
		else 
			$sql .= " Group by a.oss_id ORDER BY a.oss_id DESC";
		
		//echo $sql;
		$hasil  = $this->db->query($sql);
		if (isset($counting) && $counting == 1)	{
			$myres= $hasil->result_array();
			if (count($myres) > 0)
				return $myres[0]['total'];
			else
				return 0;
		} else {	
			return $hasil ;
		}
	}
	
	function truncate_tabel_oss()
	{
		$sql1 = "TRUNCATE TABLE tm_data_oss";
		$this->db->query($sql1);
	}
	
	function insert_update_data_oss($dataIn)
	{
		$this->db->insert('tm_data_oss',$dataIn);
		return $this->db->insert_id();
	}
	
	function insert_update_data_oss_detail($dataIn)
	{
		$this->db->insert('tm_data_oss_detail',$dataIn);
		return $this->db->insert_id();
	}
	
	
	function insert_update_data_oss_checklist($dataIn)
	{
		$this->db->insert('tm_data_oss_checklist',$dataIn);
		return $this->db->insert_id();
	}
	
	function get_oss_id($oss_id=null){
		$sql = "SELECT a.*
				FROM tm_data_oss a
				WHERE (1=1) ";
		if (trim($oss_id) != '' && $oss_id != null ) $sql .= " AND a.oss_id = '$oss_id' ";	
		$sql .= " LIMIT 1";
		return $this->db->query($sql);
	}
	
	function delete_data_oss($nib)
	{
		$this->db->delete('tm_data_oss',array('nib'=>$nib));
		$this->db->delete('tm_data_oss_detail',array('nib'=>$nib));
		$this->db->delete('tm_data_oss_checklist',array('nib'=>$nib));
	}
	// Testing API OSS
	function truncate_tabel_data_oss()
	{
		$sql1 = "TRUNCATE TABLE tm_data_oss";
		$this->db->query($sql1);
	}
	
	function insert_data_oss($dataIn)
	{
		$this->db->insert('tm_data_oss',$dataIn);
		return $this->db->insert_id();
	}
	
	function insert_data_oss_detail($dataIn)
	{
		$this->db->insert('tm_data_oss_detail',$dataIn);
		return $this->db->insert_id();
	}
	
	
	function insert_data_oss_checklist($dataIn)
	{
		$this->db->insert('tm_data_oss_checklist',$dataIn);
		return $this->db->insert_id();
	}
	
	function get_data_oss_id($oss_id=null){
		$sql = "SELECT a.*
				FROM tm_data_oss a
				WHERE (1=1) ";
		if (trim($oss_id) != '' && $oss_id != null ) $sql .= " AND a.oss_id = '$oss_id' ";	
		$sql .= " LIMIT 1";
		return $this->db->query($sql);
	}
	
	function delete_oss_data($nib)
	{
		$this->db->delete('tm_data_oss',array('nib'=>$nib));
		$this->db->delete('tm_data_oss_detail',array('nib'=>$nib));
		$this->db->delete('tm_data_oss_checklist',array('nib'=>$nib));
	}
	
}