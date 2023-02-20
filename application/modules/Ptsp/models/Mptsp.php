<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mptsp extends CI_Model{

	function getDataAkun($user_id=null)
	{
		$sql = "SELECT a.*, b.user_id,b.nama_lengkap,b.jabatan_dinas,b.nip
		FROM tm_user a
			LEFT JOIN tm_user_data b ON (a.id = b.user_id)
		WHERE (1=1) AND (a.role_id = 7 OR a.role_id = 9)";

		if ($user_id != null || trim($user_id) != '')  $sql .= " AND a.id_kabkot = '$user_id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function getDataPengawas($user_id=null)
	{
		$sql = "SELECT a.*, b.user_id,b.nama_lengkap,b.nip
		FROM tm_user a
			LEFT JOIN tm_user_data b ON (a.id = b.user_id)
		WHERE (1=1) AND a.role_id = 9 ";
		if ($user_id != null || trim($user_id) != '')  $sql .= " AND a.id_kabkot = '$user_id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	//Begin Profile User
	public function getDataUserProfile($select="a.*",$user_id='')
	{
		$this->db->select($select,FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.user_id',$user_id);
		$query 	= $this->db->get('tm_user_data a')->row();
		return $query;

	}

	public function listDataKecamatan($select="a.*",$id_kecamatan='',$id_kabkot='')
	{
		$this->db->select($select,FALSE);
		if ($id_kecamatan != null || trim($id_kecamatan) != '')  $this->db->where('a.id_kecamatan',$id_kecamatan);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		$this->db->join('tr_kabkot b','a.id_kabkot = b.id_kabkot','LEFT');
		$this->db->join('tr_provinsi c','b.id_provinsi = c.id_provinsi','LEFT');
		$this->db->order_by('a.id_kabkot','asc');
		$query 	= $this->db->get('tr_kecamatan a');
		return $query;

	}

	public function listDataProvinsi($select="a.*")
	{
		$this->db->select($select,FALSE);
		$query 	= $this->db->get('tr_provinsi a');
		return $query;
	}
	//End Profile User

	//Begin Pengaturan User
	public function listDataUser($select="*",$id_kabkot='',$group='')
	{
		$this->db->select($select,FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		if ($group != null || trim($group) != '')  $this->db->where('b.group',$group);
		$this->db->join('tm_role b','a.role_id = b.id','LEFT');
		$this->db->join('tr_kabkot c','a.id_kabkot = c.id_kabkot','LEFT');
		$query 	= $this->db->get('tm_user a');
		return $query;
	}

	public function listDataKabKota($select="a.*",$id_kabkot='',$id_provinsi='')
	{
		$this->db->select($select,FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		if ($id_provinsi != null || trim($id_provinsi) != '')  $this->db->where('a.id_provinsi',$id_provinsi);
		$query 	= $this->db->get('tr_kabkot a');
		return $query;
	}

	public function cekusername($select="*",$username='',$id_kabkot='',$role_id='',$user_id='',$password='')
	{
		$this->db->select($select,FALSE);
		if (($id_kabkot != null || trim($id_kabkot) != '') || (int)$role_id >= 4)  $this->db->where('a.id_kabkot',$id_kabkot);
		if (($role_id != null || trim($role_id) != '') || (int)$role_id >= 4)  $this->db->where('a.role_id',$role_id);
		if ($username != null || trim($username) != '')  $this->db->where('a.username',$username);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.id',$user_id);
		if ($password != null || trim($password) != '')  $this->db->where('a.password',$password);
		$query 	= $this->db->get('tm_user a');
		return $query;

	}

	public function removeDataUser($id)
	{
		$this->db->query("DELETE FROM tm_user WHERE id = $id");
		$this->db->where('id',$id);
		$query = $this->db->delete('tm_user');
		return $query;
	}
	
	public function removeDataProtype($idp)
	{
		$this->db->delete('tr_protipe',array('idp'=>$idp));
	}
	
	public function removeDataPerda($id_per)
	{
		$this->db->delete('tm_data_perda',array('id_per'=>$id_per));
	}

	public function getDataUser($select="*",$id='')
	{
		$this->db->select($select,FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id',$id);
		$query 	= $this->db->get('tm_user a')->row();
		return $query;
	}
	//End Pengaturan User

	//Begin Profile Dinas
	public function getDataDinasProfile($select="a.*",$user_id='')
	{
		$this->db->select($select,FALSE);
		$this->db->where('a.id_dinas', 1);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.id_kabkot',$user_id);
		$query 	= $this->db->get('tm_profile_dinas a')->row();
		return $query;
	}

	public function getDataKRK($select="a.*",$id_kabkot='')
	{
		$this->db->select($select,FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		$query 	= $this->db->get('tm_dok_krk a');
		return $query;
	}

	public function getDataEditKRK($select="*",$id)
	{
		$this->db->select($select,FALSE);
		$this->db->where('a.id',$id);
		$query 	= $this->db->get('tm_dok_krk a')->row();
		return $query;
	}

	public function getDataPerda($select="a.*",$id_kabkot='')
	{
		$this->db->select($select,FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		$query 	= $this->db->get('tm_data_perda a');
		return $query;
	}

	public function getDataEditPerda($select="*",$id)
	{
		$this->db->select($select,FALSE);
		$this->db->where('a.id_per',$id);
		$query 	= $this->db->get('tm_data_perda a')->row();
		return $query;

	}

	public function getDataPPK($select="a.*",$id_kabkot='')
	{
		$this->db->select($select,FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		$query 	= $this->db->get('tm_data_ppk a')->row();
		return $query;
	}
	//End Profile Dinas

	function createSubAkun($table,$data){
    $query = $this->db->insert($table, $data);
    return $this->db->insert_id();// return last insert id
	}

	public function get($table='',$where='1=1',$key='',$sort='',$limit='')
	{
		return $query = $this->db->from($table)->where($where)->order_by($key, $sort)->limit($limit)->get();
	}

	public function removeData($id)
	{
		$sql = "DELETE
						  a,
						  b
						FROM
						  tm_user a
						  LEFT JOIN tm_user_data b
						    ON (a.id = b.user_id)
						WHERE a.id = ?
						";
		return $this->db->query($sql, $id);
	}
	
	public function getDataProtype($select="a.*",$id_kabkot='')
	{
		$sql = "SELECT a.*
		FROM tr_protipe a
		WHERE (1=1) AND a.id_kabkot ='pupr'";
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " OR a.id_kabkot = '$id_kabkot' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function getDataPerdaRUU($select="a.*",$id_kabkot='')
	{
		$this->db->select($select,FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		$query 	= $this->db->get('tmdataperda a');
		return $query;
	}

	public function getDataEditPerdaRUU($select="*",$id)
	{
		$this->db->select($select,FALSE);
		$this->db->where('a.id_per',$id);
		$query 	= $this->db->get('tmdataperda a')->row();
		return $query;

	}

	public function get_email($email)
	{
		return $this->db->like('email',$email)
		->get('temp_user');
	}

	public function getEmailUser($email){
		return $this->db->like('email',$email)
		->get('tm_user');
	}
	
	public function getEmailUserData($email){
		return $this->db->like('email',$email)
		->get('tm_user_data');
	}


}
