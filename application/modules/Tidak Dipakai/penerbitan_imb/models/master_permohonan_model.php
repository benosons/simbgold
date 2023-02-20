<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Master_permohonan_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
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
	
	
	function get_master_permohonan_list($id=null,$id_jenis_bg=null,$cari=null)
	{
		$sql = "SELECT a.*,b.klasifikasi_bg
				FROM tr_permohonan a 
				LEFT JOIN tr_klasifikasi_bg b ON(a.id_klasifikasi_bg=b.id_klasifikasi_bg)
				WHERE (1=1) AND a.status ='1' ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_jenis_permohonan = '$id' ";
		if ($id_jenis_bg != null || trim($id_jenis_bg) != '')  $sql .= " AND a.id_jenis_bg = '$id_jenis_bg' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		
		
		$sql .= " ORDER BY a.id_jenis_bg,a.id_klasifikasi_bg ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function delete_file($id_jenis_permohonan)
	{
		$file = $this->get_file($id_jenis_permohonan);
		$dataIn = array (
							'd_file' => ""
						);		
		$this->db->where('id_jenis_permohonan', $id_jenis_permohonan);
		$this->db->update('tr_permohonan',$dataIn);
		
		unlink('./file/foto/proses/'. $file->d_file);
		return TRUE;
	}
	
	function delete_file_info($id_jenis_permohonan)
	{
		$file = $this->get_file($id_jenis_permohonan);
		$dataIn = array (
							'dir_file_phat' => ""
						);		
		$this->db->where('id_jenis_permohonan', $id_jenis_permohonan);
		$this->db->update('tr_permohonan',$dataIn);
		
		unlink('./file/foto/proses/'. $file->dir_file_phat);
		return TRUE;
	}
	
	function get_file($id_jenis_permohonan)
	{
		return $this->db->select()->from('tr_permohonan')->where('id_jenis_permohonan', $id_jenis_permohonan)->get()->row();
	}
	
	function insert_master_permohonan($dataIn)
	{
		$this->db->insert('tr_permohonan',$dataIn);
		return $this->db->insert_id();
	}
	
	function update_master_permohonan($dataIn,$id)
	{
		$this->db->where('id_jenis_permohonan', $id);
		$this->db->update('tr_permohonan',$dataIn);
	}
	
	
	function master_permohonan_delete($id)
	{
		$this->db->delete('tr_permohonan',array('id_jenis_permohonan'=>$id));
	}
	
	
	
	
}