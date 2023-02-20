<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpusat extends CI_Model{

	public function listDataPJ($select = "*", $id_kabkot = '', $role_id = '')
	{
		$this->db->select($select, FALSE);
		if ($role_id != null || trim($role_id) != '')  $this->db->where('a.role_id', $role_id);
		$this->db->join('tm_user_data b', 'a.id = b.user_id', 'LEFT');
		$this->db->join('tr_asosiasi c', 'a.id_asosiasi = c.id', 'LEFT');//ID belum fix
		$this->db->order_by('a.id', 'desc');
		$query 	= $this->db->get('tm_user a');
		//echo $this->db->last_query();
		return $query;
	}
	
	public function listAsKam($select="a.*",$group='')
	{
		$this->db->select($select,FALSE);
		if ($group != null || trim($group) != '')  $this->db->where('a.group',$group);
		$query 	= $this->db->get('tr_asosiasi a');
		return $query;

	}

	public function listDataPUPR($select = "*", $id_kabkot = '', $role_id = '')
	{
		$this->db->select($select, FALSE);
		if ($role_id != null || trim($role_id) != '')  $this->db->where('a.role_id', $role_id);
		//$this->db->where('a.id_kabkot', $role_id);
		$this->db->join('tm_user_data b', 'a.id = b.user_id', 'LEFT');
		$this->db->join('tr_kabkot c', 'a.id_kabkot = c.id_kabkot', 'LEFT');
		$this->db->join('tm_profile_teknis d', 'a.id_kabkot = d.id_kabkot', 'LEFT');
		$this->db->order_by('a.id_kabkot', 'asc');
		$query 	= $this->db->get('tm_user a');
		return $query;
	}

	public function listDataPerizinan($select = "*", $id_kabkot = '', $role_id = '')
	{
		$this->db->select($select, FALSE);
		if ($role_id != null || trim($role_id) != '')  $this->db->where('a.role_id', $role_id);
		$this->db->where('d.id_dinas', '1');
		$this->db->join('tm_user_data b', 'a.id = b.user_id', 'LEFT');
		$this->db->join('tr_kabkot c', 'a.id_kabkot = c.id_kabkot', 'LEFT');
		$this->db->join('tm_profile_dinas d', 'a.id_kabkot = d.id_kabkot', 'LEFT');
		$this->db->order_by('a.id_kabkot', 'asc');
		$query 	= $this->db->get('tm_user a');
		return $query;
	}
	
	public function removeData($id)
	{
		$sql = "DELETE a, b
				FROM tm_user a
				LEFT JOIN tm_user_data b
				ON (a.id = b.user_id)
				WHERE a.id = ?
			";
		return $this->db->query($sql, $id);
	}
	
	public function listDataKabKota($select = "a.*", $id_kabkot = '', $id_provinsi = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot', $id_kabkot);
		if ($id_provinsi != null || trim($id_provinsi) != '')  $this->db->where('a.id_provinsi', $id_provinsi);
		$query 	= $this->db->get('tr_kabkot a');
		return $query;
	}

	public function getDataUser($id)
	{
		$this->db->select('a.*');
		$this->db->from('tm_user a');
		$this->db->where('a.id',$id);
		$query = $this->db->get();
		return $query;
	}

	function RessetPass($dataIn,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tm_user',$dataIn);
	}

	public function getDataRekapAkun($cari=null)
	{
		$sql = "SELECT a.id_kabkot, a.nama_kabkota,b.id_fungsi_bg,
				SUM(CASE  when (b.imb ='1') then 1 else 0 END ) AS SLF,
				SUM(CASE  when (b.imb ='0') then 1 else 0 END ) AS PBGSLF
				FROM tr_kabkot a 
				LEFT JOIN tmdatabangunan b ON ( a.id_kabkot = b.id_kabkot_bgn )
				Where (a.id_kabkot)  AND b.pernyataan = '1' and b.id_jenis_permohonan ='14' and a.id_kabkot !='9971'
				$cari
				GROUP BY a.id_kabkot";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function listDataEmail($select = "*", $id_kabkot = '', $role_id = '')
	{
		$this->db->select($select, FALSE);
		if ($role_id != null || trim($role_id) != '')  $this->db->where('a.role_id', $role_id);
		$this->db->order_by('a.post_date', 'desc');
		$query 	= $this->db->get('temp_user a');
		return $query;
	}

}
