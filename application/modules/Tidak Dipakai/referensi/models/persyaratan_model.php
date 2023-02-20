<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Persyaratan_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function get_persyaratan_list($id=null,$id_jenis_persyaratan=null,$nama_syarat=null)
	{
		$sql = "SELECT a.id_syarat, a.nama_syarat ,a.id_jenis_persyaratan
				FROM tr_syarat a 
				WHERE (1=1) ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_syarat = '$id' ";
		if ($id_jenis_persyaratan != null || trim($id_jenis_persyaratan) != '')  $sql .= " AND a.id_jenis_persyaratan = '$id_jenis_persyaratan' ";
		if ($nama_syarat != null || trim($nama_syarat) != '')  $sql .= " AND a.nama_syarat LIKE '%$nama_syarat%' ";
		
		$sql .= " ORDER BY a.id_jenis_persyaratan,a.id_syarat ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
		
	function insert_persyaratan($dataIn)
	{
		$this->db->insert('tr_syarat',$dataIn);
	}
	
	function update_persyaratan($dataIn,$id)
	{
		$this->db->where('id_syarat', $id);
		$this->db->update('tr_syarat',$dataIn);
	}
	
	function update_persyaratan_slf($dataIn,$id)
	{
		$this->db->where('id_syarat_slf', $id);
		$this->db->update('tr_syarat_slf',$dataIn);
	}
	
	function insert_persyaratan_slf($dataIn)
	{
		$this->db->insert('tr_syarat_slf',$dataIn);
	}
	
	function cek_prov($id_syarat=null)
	{
		$sql = "SELECT id_syarat FROM db_gedungnegara_web.tr_kabkot WHERE (1=1) AND id_syarat = '$id_syarat' ";
		//echo $sql;
		return $this->db->query($sql);
		
	}
	
	function delete_persyaratan($id)
	{
		$this->db->delete('tr_syarat',array('id_syarat'=>$id));
	}
	
	function delete_persyaratan_slf($id)
	{
		$this->db->delete('tr_syarat_slf',array('id_syarat_slf'=>$id));
	}
	
	function get_persyaratan_slf_list($id=null,$id_jenis_persyaratan=null,$nama_syarat=null)
	{
		$sql = "SELECT a.id_syarat_slf, a.nama_syarat_slf ,a.id_jenis_persyaratan
				FROM tr_syarat_slf a 
				WHERE (1=1) ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_syarat_slf = '$id' ";
		if ($id_jenis_persyaratan != null || trim($id_jenis_persyaratan) != '')  $sql .= " AND a.id_jenis_persyaratan = '$id_jenis_persyaratan' ";
		if ($nama_syarat != null || trim($nama_syarat) != '')  $sql .= " AND a.nama_syarat_slf LIKE '%$nama_syarat%' ";
		
		$sql .= " ORDER BY a.id_jenis_persyaratan,a.id_syarat_slf ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
}
 
