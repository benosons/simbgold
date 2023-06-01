<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mconverter extends CI_Model
{
	public function getLoginData($select = '*', $email, $password)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.username', $email);
		$this->db->where('a.password', $password);
		$this->db->where('a.status', "1");
		$this->db->join('tm_role b', 'a.role_id = b.id');
		$this->db->join('tm_user_data c', 'a.id = c.user_id', 'LEFT');
		$this->db->join('tm_profile_dinas d', 'a.id_kabkot = d.id_kabkot', 'LEFT');
		return $this->db->get('tm_user a');
		//echo $this->db->last_query(); die;
	}
	
	public function getProv($select="a.*",$id_kabkot='')
	{
		$this->db->select($select,FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		$query 	= $this->db->get('tr_kabkot a')->row();
		return $query;
	}
	
	public function getnamaProv($select="a.*",$provinsi='')
	{
		$this->db->select($select,FALSE);
		if ($provinsi != null || trim($provinsi) != '')  $this->db->where('a.id_provinsi',$provinsi);
		$query 	= $this->db->get('tr_provinsi a')->row();
		return $query;
	}
	
	
	function cobadetail($select="a.*",$id=null)
	{
		$sql = "SELECT a.*,f.*,c.*,d.*,e.*
					FROM uuck_convert a
					LEFT JOIN tr_kecamatan c ON(a.id_kec_bgn = c.id_kecamatan)
					LEFT JOIN tr_kabkot d ON(a.id_kabkot_bgn = d.id_kabkot)
					LEFT JOIN tr_provinsi e ON(a.id_prov_bgn = e.id_provinsi)
					LEFT JOIN tr_kelurahan f ON (a.id_desa_bgn = f.id_kelurahan)
					WHERE (1=1)";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_convert = '$id' ";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}
	
	function get_id_kabkot($id)
	{
			$sql = "SELECT id, id_kabkot_bgn, id_kec_bgn 
					FROM tmdatabangunan where id = ".$id;
			$hasil = $this->db->query($sql)->row_array();
			return $hasil;
	}
	
	function getNoDrafPbg($id_kec_bgn,$tgl_skrg)
	{
			$sql = "SELECT max(no_sk_baru) as no_registrasi_baru 
			FROM uuck_convert 
			WHERE SUBSTR(no_sk_baru,8,6) = '$id_kec_bgn' and SUBSTR(no_sk_baru,15,8) = '$tgl_skrg'";
			$hasil = $this->db->query($sql)->row_array();
			return $hasil;
	}
	
	public function getDataDinasProfile($select="a.*",$user_id='')
	{
		$this->db->select($select,FALSE);
		$this->db->where('a.id_dinas', 1);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.id_kabkot',$user_id);
		$query 	= $this->db->get('tm_profile_dinas a')->row();
		return $query;
	}
	
	function getdatacetak($select="a.*",$id=null)
	{
		$sql = "SELECT a.*,
					f.nama_kelurahan,
					c.nama_kecamatan,
					d.nama_kabkota,
					e.nama_provinsi
					FROM uuck_convert a
					LEFT JOIN tr_kecamatan c ON(a.id_kec_bgn = c.id_kecamatan)
					LEFT JOIN tr_kabkot d ON(a.id_kabkot_bgn = d.id_kabkot)
					LEFT JOIN tr_provinsi e ON(a.id_prov_bgn = e.id_provinsi)
					LEFT JOIN tr_kelurahan f ON (a.id_desa_bgn = f.id_kelurahan)
					WHERE (1=1)";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_convert = '$id' ";
		$hasil  = $this->db->query($sql);

		return $hasil->row_array();
		/* WHERE (a.no_sk_baru=$id) */
	}
	
	function undang2ck()
	{
		$sql ="SELECT *
				FROM tr_uu_ck";
		$hasil = $this->db->query($sql);
		return $hasil;
	}
	
	function perda($id='null')
	{
		$sql ="SELECT b.nama_perda
			FROM uuck_convert a
			LEFT JOIN tmdataperda b ON (a.id_kabkot_bgn=b.id_kabkot)
			WHERE (a.id_convert=$id)
			ORDER BY urutan ASC";
		$hasil = $this->db->query($sql);
		return $hasil;
	}
	
}
