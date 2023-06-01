<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Mpenilaian extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	
	
	function get_penilaian_list($counting=0,$dipaging=0,$limit=10,$offset=1,$id=null,$cari=null)
	{
		if (isset($counting) && $counting == 1) 
		{
			$sql = "SELECT COUNT(a.id_permohonan) as total";
		}
		else 
		{
			$sql = "SELECT a.*,b.id_penilaian, c.nama_bg, d.nama_permohonan, e.nama_kementerian, f.nama_kabkota, g.nama_provinsi,z.username
				";
		}
		$sql .= "	FROM tm_imb_permohonan a 
						LEFT JOIN tm_permohonan_bg_detail h ON(a.id_permohonan = h.id_permohonan)
						LEFT JOIN tm_penilaian_teknis b ON(a.id_permohonan = b.id_permohonan)
						LEFT JOIN tm_bangunan_gedung c ON(a.id_bangunan_gedung = c.id_bangunan_gedung)
						LEFT JOIN tr_imb_permohonan d ON(a.id_jenis_permohonan = d.id_jenis_permohonan)
						LEFT JOIN tr_kementerian e ON(a.id_kementerian=e.id_kementerian)
						LEFT JOIN tr_kabkot f ON(a.id_kabkot=f.id_kabkot)
						LEFT JOIN tr_provinsi g ON(a.id_provinsi=g.id_provinsi)
						LEFT JOIN tm_user z ON (z.id=a.id_user)
					WHERE (1=1) AND a.status_syarat = '1' ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_penilaian = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		
		
		if (isset($dipaging) && $dipaging ==1)
			$sql .= " Group by a.id_permohonan ORDER BY a.id_permohonan DESC limit $offset, $limit ";
		else 
			$sql .= " Group by a.id_permohonan ORDER BY a.id_permohonan DESC";
		
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
	
	function get_uraian_pengkajian($id_jenis_pengkajian=null,$id_permohonan=null)
	{
		$sql = "SELECT a.id_uraian_pengkajian,a.id_jenis_pengkajian,a.uraian_pengkajian,b.id_penilaian,
				b.id_permohonan,b.kesesuaian,b.catatan
		
				FROM tr_uraian_pengkajian a
				LEFT JOIN tm_penilaian_teknis b ON(a.id_uraian_pengkajian = b.id_persyaratan_detail AND b.id_permohonan = '$id_permohonan')
				WHERE (1=1) 
				AND id_jenis_pengkajian = '$id_jenis_pengkajian'";
		
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	
	}
	
	function get_syarat_list($per=null,$kls=null)
	{
		$sql = "SELECT a.id_persyaratan,a.id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,
				b.id_persyaratan_detail,b.id_syarat,c.nama_syarat
				FROM tr_imb_persyaratan a 
					LEFT JOIN tr_imb_persyaratan_detail b ON(a.id_persyaratan=b.id_persyaratan)
					LEFT JOIN tr_imb_syarat c ON(b.id_syarat=c.id_syarat)
				WHERE (1=1)";
		if ($per != null || trim($per) != '')  $sql .= " AND a.id_jenis_permohonan = '$per' ";
		if ($kls != null || trim($kls) != '')  $sql .= " AND a.id_jenis_persyaratan = '$kls' ";
		$sql .= " Group by b.id_persyaratan_detail ORDER BY a.id_jenis_permohonan, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat ASC ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_syarat_krk($per=null,$kls=null)
	{
		$sql = "SELECT a.id_persyaratan,a.id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,
				b.id_persyaratan_detail,b.id_syarat,c.nama_syarat
				FROM tr_imb_persyaratan a 
					LEFT JOIN tr_imb_persyaratan_detail b ON(a.id_persyaratan=b.id_persyaratan)
					LEFT JOIN tr_imb_syarat c ON(b.id_syarat=c.id_syarat)
				WHERE (1=1) AND c.id_syarat ='11' ";
		if ($per != null || trim($per) != '')  $sql .= " AND a.id_jenis_permohonan = '$per' ";
		if ($kls != null || trim($kls) != '')  $sql .= " AND a.id_jenis_persyaratan = '$kls' ";
		$sql .= " Group by b.id_persyaratan_detail ORDER BY a.id_jenis_permohonan, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat ASC ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_penilaian_teknis($id_persyaratan_detail=null,$id_permohonan=null,$key_sidang=null){
		$sql = "SELECT a.*
				FROM tm_penilaian_teknis  a 
				WHERE (1=1)";
		if ($id_persyaratan_detail != null || trim($id_persyaratan_detail) != '')  $sql .= " AND a.id_persyaratan_detail = '$id_persyaratan_detail' ";
		if ($id_permohonan != null || trim($id_permohonan) != '')  $sql .= " AND a.id_permohonan = '$id_permohonan' ";
		if ($key_sidang != null || trim($key_sidang) != '')  $sql .= " AND a.sidang_ke = '$key_sidang' ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_permohonan($id=null,$cari=null)
	{
		$sql = "SELECT a.*, b.*
		FROM tm_imb_permohonan a
		left join tr_imb_permohonan b on (a.id_jenis_permohonan = b.id_jenis_permohonan)
		WHERE (1=1) ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_permohonan_krk($id)
	{
		$sql = "SELECT a.*, b.*
		FROM tm_imb_permohonan a
		left join tr_imb_permohonan b on (a.id_jenis_permohonan = b.id_jenis_permohonan)
		WHERE (1=1) ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function delete_data_penilaian($id)
	{
		$this->db->delete('tm_penilaian_teknis',array('id_permohonan'=>$id));
	}
	
	
	
	function insert_data_penilaian($data)
	{
		$this->db->insert('tm_penilaian_teknis',$data);
	}
	
	
	
	function update_data_penilaian($dataIn,$id)
	{
		$this->db->where('id_penilaian', $id);
		$this->db->update('tm_penilaian_teknis',$dataIn);
	}
	
	
	
	function m_delete_file_hasil_pemeriksaan($id_penilaian)
	{
		$file = $this->get_file_hasil_pemeriksaan($id_penilaian);
		
		$dataIn = array (
							'dir_file_hasil_perbaikan' => ""
						);
						
		$this->db->where('id_penilaian', $id_penilaian);
		$this->db->update('tm_penilaian_teknis',$dataIn);
		
		unlink('./file/hasil_pemeriksaan_tabg/' . $file->dir_file_hasil_perbaikan);
		return TRUE;
	}
	
	function get_file_hasil_pemeriksaan($file_id)
	{
		return $this->db->select()->from('tm_penilaian_teknis')->where('id_penilaian', $file_id)->get()->row();
	}
	
	
	
	
	
	
	function m_delete_file_pertimbangan($id_pertimbangan)
	{
		$file = $this->get_file_pertimbangan($id_pertimbangan);
		
		$dataIn = array (
							'dir_file_tabg' => ""
						);
						
		$this->db->where('id_pertimbangan', $id_pertimbangan);
		$this->db->update('tm_pertimbangan_rencana_teknis',$dataIn);
		
		unlink('./file/pertimbangan/' . $file->dir_file_tabg);
		return TRUE;
	}
	
	function get_file_pertimbangan($file_id)
	{
		return $this->db->select()->from('tm_pertimbangan_rencana_teknis')->where('id_pertimbangan', $file_id)->get()->row();
	}
	
	function get_syarat($id=null,$per=null,$status=null)
	{
		$sql = "SELECT a.*
				FROM tm_permohonan_bg_syarat a
				WHERE (1=1) ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_persyaratan_detail = '$id' ";
		if ($per != null || trim($per) != '')  $sql .= " AND a.id_permohonan = '$per' ";
		if ($status != null || trim($status) != '')  $sql .= " AND a.status = '$status' ";
		$sql .= " ORDER BY a.id_persyaratan ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function insert_data_pertimbangan_teknis($dataIn)
	{
		$this->db->insert('tm_pertimbangan_rencana_teknis',$dataIn);
		return $this->db->insert_id();
	}
	
	function insert_penilaian_krk($dataIn)
	{
		$this->db->insert('tm_penilaian_dokumen_krk',$dataIn);
		return $this->db->insert_id();
	}
	
	function update_penilaian_krk($dataIn,$id)
	{
		$this->db->where('id_penilaian_krk', $id);
		$this->db->update('tm_penilaian_dokumen_krk',$dataIn);
	}
	
	function update_data_pertimbangan_teknis($dataIn,$id)
	{
		$this->db->where('id_pertimbangan', $id);
		$this->db->update('tm_pertimbangan_rencana_teknis',$dataIn);
	}
	
	function delete_data_pertimbangan($id_pertimbangan)
	{
		$this->db->delete('tm_pertimbangan_rencana_teknis',array('id_pertimbangan'=>$id_pertimbangan));
	}
	
	function get_data_pertimbangan($id=null,$id_pertimbangan=null,$key_sidang=null)
	{
		$sql = "SELECT a.*
				FROM tm_pertimbangan_rencana_teknis a
				left join tm_imb_permohonan b on (a.id_permohonan = b.id_permohonan)
				WHERE (1=1) ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		if ($id_pertimbangan != null || trim($id_pertimbangan) != '')  $sql .= " AND a.id_pertimbangan = '$id_pertimbangan' ";
		if ($key_sidang != null || trim($key_sidang) != '')  $sql .= " AND a.sidang_ke = '$key_sidang' ";
		$sql .= " ORDER BY a.sidang_ke DESC";
		// echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_data_penilaian_krk($id)
	{
		$sql = "SELECT a.*
				FROM tm_penilaian_dokumen_krk a
				left join tm_imb_permohonan b on (a.id_permohonan = b.id_permohonan)
				WHERE (1=1) ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		//if ($id_penilaian_krk != null || trim($id_penilaian_krk) != '')  $sql .= " AND a.id_penilaian_krk = '$id_penilaian_krk' ";
		$sql .= " ORDER BY a.id_penilaian_krk DESC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

}
 
