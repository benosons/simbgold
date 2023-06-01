<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Syarat2_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function get_syarat_list($id=null,$syarat=null,$id_pemanfaatan_bg=null,$id_gol_objek_imb=null,$id_jenis_permohonan=null,$klasifikasi_bg=null,$id_jenis_bg=null)
	{
		$sql = "SELECT a.id_persyaratan,a.id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,
				b.id_persyaratan_detail,b.id_syarat,c.nama_syarat,d.nama_permohonan
				FROM tr_persyaratan2 a 
					LEFT JOIN tr_persyaratan2_detail b ON(a.id_persyaratan=b.id_persyaratan)
					LEFT JOIN tr_syarat c ON(b.id_syarat=c.id_syarat)
					LEFT JOIN tr_permohonan d ON(a.id_jenis_permohonan=d.id_jenis_permohonan)
				WHERE (1=1)";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_persyaratan = '$id' ";
		if ($id_pemanfaatan_bg != null || trim($id_pemanfaatan_bg) != '')  $sql .= " AND d.id_pemanfaatan_bg = '$id_pemanfaatan_bg' ";
		if ($klasifikasi_bg != null || trim($klasifikasi_bg) != '')  $sql .= " AND d.id_klasifikasi_bg = '$klasifikasi_bg' ";
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $sql .= " AND d.id_jenis_permohonan = '$id_jenis_permohonan' ";
		if ($id_jenis_bg != null || trim($id_jenis_bg) != '')  $sql .= " AND d.id_jenis_bg = '$id_jenis_bg' ";
		
		$sql .= " ORDER BY  a.id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,b.id_syarat ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_jenis_permohonan_list($id=null,$nama_permohonan=null,$status=null)
	{
		if ($id != null || trim($id) != '') 
			$this->db->where('id_jenis_permohonan',$id);
			
		if ($nama_permohonan != null || trim($nama_permohonan) != '' ) 
			$this->db->like('nama_permohonan',$nama_permohonan,'both');
			
		$this->db->order_by('id_jenis_permohonan','asc');
		$hasil =  $this->db->get('tr_permohonan');
		return $hasil;
	}
		
	function insert_syarat($dataIn)
	{
		$this->db->insert('tr_persyaratan2',$dataIn);
		return $this->db->insert_id();
	}
	
	
	function insert_syarat_detail($dataPersyaratan)
	{
		$this->db->insert('tr_persyaratan2_detail',$dataPersyaratan);
	}
	
	function update_syarat_detail($dataIn,$id_persyaratan_detail)
	{
		$this->db->where('id_persyaratan_detail', $id_persyaratan_detail);
		$this->db->update('tr_persyaratan2_detail',$dataIn);
	}
	
	function update_syarat($dataIn,$id)
	{
		$this->db->where('id_persyaratan', $id);
		$this->db->update('tr_persyaratan2',$dataIn);
	}
	
	function delete_syarat_detail($id)
	{
		$this->db->delete('tr_persyaratan2_detail',array('id_persyaratan_detail'=>$id));
	}
		
	function syarat_delete($id)
	{
		$this->db->delete('tr_persyaratan2',array('id_persyaratan'=>$id));
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
	
	function get_syarat_list_master($id_jenis_persyaratan=null)
	{
		$sql = "SELECT a.*  FROM tr_syarat a
					WHERE (1=1)  ";
		
		if ($id_jenis_persyaratan != null || trim($id_jenis_persyaratan) != '')  $sql .= " AND a.id_jenis_persyaratan = '$id_jenis_persyaratan' ";
		
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	

	function cek_syarat_list_sudah_dipilih($syarat=null,$persyaratan=null)
	{
		$sql = "SELECT * FROM tr_persyaratan2_detail WHERE (1=1) ";
		if ($persyaratan != null || trim($persyaratan) != '')  $sql .= " AND id_persyaratan = '$persyaratan' ";
		if ($syarat != null || trim($syarat) != '')  $sql .= " AND id_syarat = '$syarat' ";
		
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_syarat_list2($id=null,$persyaratan=null)
	{
		$sql = "SELECT b.id_persyaratan_detail, a.id_syarat, a.nama_syarat  FROM tr_syarat a
					LEFT JOIN tr_persyaratan2_detail b ON(a.id_syarat=b.id_syarat)
					WHERE (1=1)  ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND b.id_persyaratan = '$id' ";
		if ($persyaratan != null || trim($persyaratan) != '')  $sql .= " AND b.id_syarat = '$persyaratan' ";
		
		$sql .= " ORDER BY a.id_syarat ASC";
		
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_pelayanan($id_jenis_permohonan=null,$id_jenis_bg=null)
	{
		$sql = "SELECT * FROM tr_permohonan WHERE (1=1) ";
		if ($id_jenis_permohonan != null || $id_jenis_permohonan != '')  $sql .= " AND id_jenis_bg = $id_jenis_bg ";
		if ($id_jenis_bg != null || $id_jenis_bg != '')  $sql .= " AND id_jenis_bg = $id_jenis_bg ";
		
		$hasil = $this->db->query($sql);
		return $hasil;
	}
	
}