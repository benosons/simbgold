<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class ServiceModel extends CI_Model {

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
		$sql1 = "TRUNCATE TABLE tmossdata";
		$this->db->query($sql1);
	}
	
	function InsertDataOss($dataIn)
	{
		$this->db->insert('tmossdata',$dataIn);
		return $this->db->insert_id();
	}
	
	function insert_update_data_oss_detail($dataIn)
	{
		$this->db->insert('tmossdatadetail',$dataIn);
		return $this->db->insert_id();
	}
	
	
	function InsertDataOssChecklist($dataIn)
	{
		$this->db->insert('tmossdatachecklist',$dataIn);
		return $this->db->insert_id();
	}
	
	function get_oss_id($oss_id=null){
		$sql = "SELECT a.*
				FROM tmossdata a
				WHERE (1=1) ";
		if (trim($oss_id) != '' && $oss_id != null ) $sql .= " AND a.oss_id = '$oss_id' ";	
		$sql .= " LIMIT 1";
		return $this->db->query($sql);
	}
	
	function delete_data_oss($nib)
	{
		$this->db->delete('tmossdata',array('nib'=>$nib));
		$this->db->delete('tmossdatadetail',array('nib'=>$nib));
		$this->db->delete('tmossdatachecklist',array('nib'=>$nib));
	}
	
	
}