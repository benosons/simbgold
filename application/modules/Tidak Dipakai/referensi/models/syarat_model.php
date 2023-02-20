<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Syarat_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function get_syarat_list($id=null,$syarat=null,$id_pemanfaatan_bg=null,$id_gol_objek_imb=null,$id_jenis_permohonan=null)
	{
		$sql = "SELECT a.*, b.*
				FROM tr_persyaratan a 
					LEFT JOIN tr_permohonan b ON(a.id_jenis_permohonan=b.id_jenis_permohonan)
				WHERE (1=1) ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_persyaratan = '$id' ";
		if ($id_pemanfaatan_bg != null || trim($id_pemanfaatan_bg) != '')  $sql .= " AND a.id_pemanfaatan_bg = '$id_pemanfaatan_bg' " ;
		if ($syarat != null || trim($syarat) != '')  $sql .= " AND a.nama_persyaratan LIKE '%$syarat%' ";
		if ($id_gol_objek_imb != null || trim($id_gol_objek_imb) != '')  $sql .= " AND a.id_gol_objek_imb = '$id_gol_objek_imb' ";
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $sql .= " AND a.id_jenis_permohonan = '$id_jenis_permohonan' " ;
		
		$sql .= " ORDER BY  a.id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_jenis_permohonan_list($id=null,$nama_permohonan=null)
	{
		if ($id != null || trim($id) != '') 
			$this->db->where('id_jenis_permohonan',$id);
		if ($nama_permohonan != null || trim($nama_permohonan) != '') 
			$this->db->like('nama_permohonan',$nama_permohonan,'both');
			
		$this->db->order_by('id_jenis_permohonan','asc');
		$hasil =  $this->db->get('tr_permohonan');
		return $hasil;
	}
		
	function insert_syarat($dataIn)
	{
		$this->db->insert('tr_persyaratan',$dataIn);
	}
	
	function update_syarat($dataIn,$id)
	{
		$this->db->where('id_persyaratan', $id);
		$this->db->update('tr_persyaratan',$dataIn);
	}
		
	function syarat_delete($id)
	{
		$this->db->delete('tr_persyaratan',array('id_persyaratan'=>$id));
	}
	
	
	function get_klasifikasi_bg($id=null,$kalsifikasi_bg=null)
	{
		if ($id != null || trim($id) != '') 
			$this->db->where('id_klasifikasi_bg',$id);
		if ($kalsifikasi_bg != null || trim($kalsifikasi_bg) != '') 
			$this->db->like('kalsifikasi_bg',$kalsifikasi_bg,'both');
			
		$this->db->order_by('id_klasifikasi_bg','asc');
		$hasil =  $this->db->get('tr_klasifikasi_bg');
		return $hasil;
	}
	
	function get_fungsi_bg($id=null,$id_fungsi_bg=null)
	{
		if ($id_fungsi_bg != null || trim($id_fungsi_bg) != '') 
			$this->db->where('id_fungsi_bg',$id);
		if ($id != null || trim($id) != '') 
			$this->db->where('id_pemanfaatan_bg',$id);
			
		$this->db->order_by('id_fungsi_bg','asc');
		$hasil =  $this->db->get('tr_fungsi_bg');
		return $hasil;
	}
	
}