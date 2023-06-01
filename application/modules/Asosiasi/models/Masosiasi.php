<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Masosiasi extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function getDataUser()
	{

	}

	public function getDataAsosiasi($select="a.*",$user_id='')
	{
		$this->db->select($select,FALSE);
		$this->db->where('a.id_dinas', 1);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.id_kabkot',$user_id);
		$query 	= $this->db->get('tm_profile_dinas a')->row();
		return $query;
	}

	function getDataAkun($user_id=null)
	{
		$sql = "SELECT a.*, b.user_id,b.nama_lengkap,b.nip
		FROM tm_user a
			LEFT JOIN tm_user_data b ON (a.id = b.user_id)
		WHERE (1=1) AND a.role_id = 7";

		if ($user_id != null || trim($user_id) != '')  $sql .= " AND a.id_kabkot = '$user_id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function createSubAkun($table,$data){
		$query = $this->db->insert($table, $data);
		return $this->db->insert_id();// return last insert id
	}

	public function get($table='',$where='1=1',$key='',$sort='',$limit='')
	{
		return $query = $this->db->from($table)->where($where)->order_by($key, $sort)->limit($limit)->get();
	}


}
	
