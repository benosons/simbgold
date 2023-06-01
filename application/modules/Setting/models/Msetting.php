<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Msetting extends CI_Model
{


	//Begin Profile User
	public function getDataUserProfile($select = "a.*", $user_id = '')
	{
		$this->db->select($select, FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.user_id', $user_id);
		$query 	= $this->db->get('tm_user_data a')->row();
		return $query;
	}

	public function listDataKecamatan($select = "a.*", $id_kecamatan = '', $id_kabkot = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kecamatan != null || trim($id_kecamatan) != '')  $this->db->where('a.id_kecamatan', $id_kecamatan);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot', $id_kabkot);
		$this->db->join('tr_kabkot b', 'a.id_kabkot = b.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi c', 'b.id_provinsi = c.id_provinsi', 'LEFT');
		$this->db->order_by('a.id_kabkot', 'asc');
		$query 	= $this->db->get('tr_kecamatan a');
		return $query;
	}

	public function listDataProvinsi($select = "a.*")
	{
		$this->db->select($select, FALSE);
		$query 	= $this->db->get('tr_provinsi a');
		return $query;
	}
	//End Profile User

	//Begin Profile Dinas
	public function getDataDinasProfile($select = "a.*", $user_id = '')
	{
		$this->db->select($select, FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.user_id', $user_id);
		$query 	= $this->db->get('tm_profile a')->row();
		return $query;
	}

	public function getDataKRK($select = "a.*", $id_kabkot = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot', $id_kabkot);
		$query 	= $this->db->get('tm_dok_krk a');
		return $query;
	}

	public function getDataEditKRK($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id', $id);
		$query 	= $this->db->get('tm_dok_krk a')->row();
		return $query;
	}

	public function getDataPerda($select = "a.*", $id_kabkot = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot', $id_kabkot);
		$query 	= $this->db->get('tm_data_perda a');
		return $query;
	}

	public function getDataEditPerda($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id', $id);
		$query 	= $this->db->get('tm_data_perda a')->row();
		return $query;
	}

	public function getDataPPK($select = "a.*", $id_kabkot = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot', $id_kabkot);
		$query 	= $this->db->get('tm_data_ppk a')->row();
		return $query;
	}
	//End Profile Dinas

	//Begin Hari Libur
	public function getDataPeriodeHariLibur($select = "a.*", $id_kabkot = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot', $id_kabkot);
		$query 	= $this->db->get('tm_data_hari_libur a');
		return $query;
	}

	public function getDataHariLibur($select = "b.*", $id_kabkot = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('b.id_kabkot', $id_kabkot);
		$this->db->join('tm_data_hari_libur b', 'a.data_hari_libur_id = b.id', 'LEFT');
		$query 	= $this->db->get('tm_data_hari_libur_detail a');
		return $query;
	}

	public function getDataEditPeriodeHariLibur($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id', $id);
		$query 	= $this->db->get('tm_data_hari_libur a')->row();
		return $query;
	}


	public function getDataEditHariLibur($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id', $id);
		$query 	= $this->db->get('tm_data_hari_libur_detail a')->row();
		return $query;
	}
	//End Hari Libur

	//Begin Role User
	public function listDataRoleUser($select = "a.*")
	{
		$this->db->select($select, FALSE);
		$this->db->order_by('a.id', 'asc');
		$query 	= $this->db->get('tm_role a');
		return $query;
	}


	public function cekroleUser($select = "a.*", $name_role)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.name_role', $name_role);
		$query 	= $this->db->get('tm_role a');
		return $query;
	}

	public function getDataEditRoleUser($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id', $id);
		$query 	= $this->db->get('tm_role a')->row();
		return $query;
	}

	public function removeDataRoleUser($id)
	{
		$this->db->query("DELETE FROM tm_role WHERE id = $id");
		$this->db->where('id', $id);
		$query = $this->db->delete('tm_role');
		return $query;
	}
	//End Role User

	//Begin Daftar Menu
	public function listDataMenu($select = "a.*")
	{
		$this->db->select($select, FALSE);
		$this->db->order_by('a.urut', 'asc');
		$this->db->order_by('a.id', 'asc');
		$query 	= $this->db->get('tm_menu a');
		return $query;
	}

	public function getMenuUtama($select = '*')
	{
		$this->db->select($select, FALSE);
		$this->db->where('parentid', 0);
		$this->db->order_by('urut', 'asc');
		return $this->db->get('tm_menu a');
	}

	public function cekNamaMenu($select = "a.*", $nama_menu)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.name_menu', $nama_menu);
		$query 	= $this->db->get('tm_menu a');
		return $query;
	}

	public function getDataMenu($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id', $id);
		$query 	= $this->db->get('tm_menu a')->row();
		return $query;
	}

	public function removeDataMenu($id)
	{
		$this->db->query("DELETE FROM tm_menu WHERE id = $id");
		$this->db->where('id', $id);
		$query = $this->db->delete('tm_menu');
		return $query;
	}

	//End Daftar Menu

	//Begin Pengaturan Menu
	public function removeDataHakAkses($idrole)
	{
		$this->db->query("DELETE FROM tm_role_menu WHERE role_id = $idrole");
		$this->db->where('role_id', $idrole);
		$query = $this->db->delete('tm_role_menu');
		return $query;
	}

	public function get_menu_selected($role_id_form)
	{
		$this->db->select('menu_id');
		$this->db->where('role_id', $role_id_form);
		$query 	= $this->db->get('tm_role_menu');
		return $query;
	}

	public function get_menu_parent()
	{
		$this->db->select('a.id,a.name_menu,a.url,a.icon,a.parentid');
		$this->db->where('a.parentid', 0);
		$this->db->where('a.menu_aktif', '1');
		$this->db->order_by('a.urut', 'asc');
		$query	= $this->db->get('tm_menu a');
		return $query;
	}

	public function get_menu_child($parent)
	{
		$this->db->select('a.id,a.name_menu,a.url,a.icon,a.parentid');
		$this->db->where('a.parentid', $parent);
		$this->db->where('a.menu_aktif', '1');
		$this->db->order_by('a.urut', 'asc');
		$query	= $this->db->get('tm_menu a');
		return $query;
	}
	//End Pengaturan Menu

	//Begin Pengaturan User
	public function listDataUser($select = "*", $id_kabkot = '', $group = '')
	{
		$this->db->select($select, FALSE);
		//untuk menampilkan data user yg berisi kabkot
		//if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		if ($group != null || trim($group) != '')  $this->db->where('b.group', $group);
		$this->db->join('tm_role b', 'a.role_id = b.id', 'LEFT');
		$this->db->join('tr_kabkot c', 'a.id_kabkot = c.id_kabkot', 'LEFT');
		$this->db->order_by('a.id','desc');
		$this->db->limit(10);
		$query 	= $this->db->get('tm_user a');
		//echo $this->db->last_query();
		return $query;
	}

	public function listDataKabKota($select = "a.*", $id_kabkot = '', $id_provinsi = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot', $id_kabkot);
		if ($id_provinsi != null || trim($id_provinsi) != '')  $this->db->where('a.id_provinsi', $id_provinsi);
		$query 	= $this->db->get('tr_kabkot a');
		return $query;
	}

	public function cekusername($select = "*", $username = '', $id_kabkot = '', $role_id = '', $user_id = '', $password = '')
	{
		$this->db->select($select, FALSE);
		if (($id_kabkot != null || trim($id_kabkot) != '') || (int) $role_id >= 4)  $this->db->where('a.id_kabkot', $id_kabkot);
		if (($role_id != null || trim($role_id) != '') || (int) $role_id >= 4)  $this->db->where('a.role_id', $role_id);
		if ($username != null || trim($username) != '')  $this->db->where('a.username', $username);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.id', $user_id);
		if ($password != null || trim($password) != '')  $this->db->where('a.password', $password);
		$query 	= $this->db->get('tm_user a');
		//echo $this->db->last_query();
		return $query;
	}

	public function removeDataUser($id)
	{
		$this->db->query("DELETE FROM tm_user WHERE id = $id");
		$this->db->where('id', $id);
		$query = $this->db->delete('tm_user');
		return $query;
	}

	public function getDataUser($select = "*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		$query 	= $this->db->get('tm_user a')->row();
		return $query;
	}
	//End Pengaturan User

	public function getRowApi($id)
	{
		return $this->db->where('id_userapi', $id)->get('tmuserapi');
	}
}
