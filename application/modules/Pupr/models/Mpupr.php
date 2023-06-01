<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpupr extends CI_Model
{
	function getDataAkun($user_id = null)
	{
		$sql = "SELECT a.*, b.user_id,b.nama_lengkap,b.jabatan_dinas,b.nip
		FROM tm_user a
			LEFT JOIN tm_user_data b ON (a.id = b.user_id)
		WHERE (1=1) AND (a.role_id = 8 OR a.role_id = 11)";
		if ($user_id != null || trim($user_id) != '')  $sql .= " AND a.id_kabkot = '$user_id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function getDataPengawas($user_id = null)
	{
		$sql = "SELECT a.*, b.user_id,b.nama_lengkap,b.nip
		FROM tm_user a
			LEFT JOIN tm_user_data b ON (a.id = b.user_id)
		WHERE (1=1) AND a.role_id = 11";
		if ($user_id != null || trim($user_id) != '')  $sql .= " AND a.id_kabkot = '$user_id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
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

	//Begin Pengaturan User
	public function listDataUser($select = "*", $id_kabkot = '', $group = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot', $id_kabkot);
		if ($group != null || trim($group) != '')  $this->db->where('b.group', $group);
		$this->db->join('tm_role b', 'a.role_id = b.id', 'LEFT');
		$this->db->join('tr_kabkot c', 'a.id_kabkot = c.id_kabkot', 'LEFT');
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

	//Begin Profile Dinas
	public function getDataDinasProfile($select = "a.*", $user_id = '')
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_dinas', 2);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.id_kabkot', $user_id);
		$query 	= $this->db->get('tm_profile_teknis a')->row();
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

	function createSubAkun($table, $data)
	{
		$query = $this->db->insert($table, $data);
		return $this->db->insert_id(); // return last insert id
	}

	public function get($table = '', $where = '1=1', $key = '', $sort = '', $limit = '')
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

	public function listDataPesonilAsn($select = "*", $id_personal = '', $stat = '')
	{
		$this->db->select($select, FALSE);
		if ($id_personal != null || trim($id_personal) != '')  $this->db->where('a.id_personal', $id_personal);
		if ($id_personal != null || trim($id_personal) != '')  $this->db->join('tm_riwpendidikan b', "a.id_personal = b.id_personal", 'LEFT');
		if ($id_personal != null || trim($id_personal) != '')  $this->db->join('tm_sertifikasi c', "a.id_personal = c.id_personal", 'LEFT');
		$this->db->where('id_kota_tabg', $this->session->userdata('loc_id_kabkot'));
		if ($stat != null || trim($stat) != '')  $this->db->where('a.stat', $stat);

		$this->db->order_by('a.id_personal', 'desc');
		$query 	= $this->db->get('tm_personal a');
		return $query;
	}

	public function listDataPesonilNonAsn($select = "a.*", $id_personal = '', $stat = '0')
	{
		$this->db->select($select, FALSE);
		if ($id_personal != null || trim($id_personal) != '')  $this->db->where('a.id_personal', $id_personal);
		if ($stat != null || trim($stat) != '')  $this->db->where('a.stat', $stat);
		$this->db->order_by('a.id_personal', 'asc');
		$query 	= $this->db->get('tm_personal a');
		return $query;
	}

	public function listDataBidang($select = "a.*", $id_bidang = '')
	{
		$this->db->select($select, FALSE);
		if ($id_bidang != null || trim($id_bidang) != '')  $this->db->where('a.id_bidang', $id_bidang);
		$query 	= $this->db->get('tr_bidang a');
		return $query;
	}

	public function listDataPendidikan($select = "a.*", $id_pendidikan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_pendidikan != null || trim($id_pendidikan) != '')  $this->db->where('a.id_pendidikan', $id_pendidikan);
		$query 	= $this->db->get('tr_pendidikan a');
		return $query;
	}

	public function listDataJurusan($select = "a.*", $id_jurusan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_jurusan != null || trim($id_jurusan) != '')  $this->db->where('a.id_jurusan', $id_jurusan);
		$query 	= $this->db->get('tr_jurusan a');
		return $query;
	}

	public function getDataEditBidang($select = "*", $id_bidang)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_bidang', $id_bidang);
		$query 	= $this->db->get('tr_bidang a')->row();
		return $query;
	}

	public function cekNamaBidang($select = "a.*", $nama_bidang)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.nama_bidang', $nama_bidang);
		$query 	= $this->db->get('tr_bidang a');
		return $query;
	}

	public function removeDataBidang($id_bidang)
	{
		$this->db->query("DELETE FROM tr_bidang WHERE id_bidang = $id_bidang");
		$this->db->where('id_bidang', $id_bidang);
		$query = $this->db->delete('tr_bidang');
		return $query;
	}

	public function removeDataDokumen($table, $id)
	{
		$this->db->where('id', $id);
		$query = $this->db->delete('$table');
		return $query;
	}

	public function listDataUnsurTABG($select = "a.*", $id_unsur_ahli = '')
	{
		$this->db->select($select, FALSE);
		if ($id_unsur_ahli != null || trim($id_unsur_ahli) != '')  $this->db->where('a.id_unsur_ahli', $id_unsur_ahli);
		$this->db->join('tr_unsur b', 'a.id_unsur = b.id_unsur', 'LEFT');
		$this->db->order_by('a.id_unsur', 'asc');
		$query 	= $this->db->get('tr_unsur_ahli a');
		return $query;
	}

	public function getDataEditUnsurTabg($select = "*", $id_unsur_ahli)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_unsur_ahli', $id_unsur_ahli);
		$query 	= $this->db->get('tr_unsur_ahli a')->row();
		return $query;
	}
	public function get_syarat_parent($id_kabkot = '')
	{
		$this->db->select('id_personal,nama_personal');
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('id_kota_tabg', $id_kabkot);
		$this->db->order_by('id_personal', 'asc');
		return $this->db->get('tm_personal');
	}

	public function get_tim_teknis_parent($id_kabkot = '')
	{
		$this->db->select('id_personal,nama_personal');
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('id_kota_tabg', $id_kabkot);
		$this->db->where('stat', '1');
		$this->db->order_by('id_personal', 'asc');
		return $this->db->get('tm_personal');
	}

	public function get_tabg_parent($id_kabkot = '')
	{
		$this->db->select('id_personal,nama_personal');
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('id_kota_tabg', $id_kabkot);
		//$this->db->where('stat', '1');
		$this->db->order_by('id_personal', 'asc');
		return $this->db->get('tm_personal');
	}

	public function get_syarat_selected($id_sk_tabg)
	{
		$this->db->select('id_personal');
		$this->db->where('id_sk_tabg', $id_sk_tabg);
		return $this->db->get('tm_sk_tabg_detail');
	}

	public function get_syarat_selected_view($id_sk_tabg)
	{
		$this->db->select('b.id_personal,b.nama_personal');
		$this->db->join('tm_personal b', 'a.id_personal = b.id_personal', 'LEFT');
		$this->db->where('a.id_sk_tabg', $id_sk_tabg);
		return $this->db->get('tm_sk_tabg_detail a');
	}

	public function ListPersyaratan($id_jenis_permohonan, $element = '', $class = 'menu-list', $disable = '', $id_jenis_dok_permohonan = '')
	{
		$this->db->select('id_syarat');
		$this->db->where('id_jenis_permohonan', $id_jenis_permohonan);
		$query_menu_selected	= $this->db->get('tr_imb_permohonan_syarat');

		$this->db->select('a.id_syarat,a.nama_syarat');
		$this->db->where('a.id_jenis_persyaratan', $id_jenis_dok_permohonan);
		$this->db->where('a.status', '1');
		$this->db->order_by('a.id_syarat', 'asc');
		$query_menu	= $this->db->get('tr_imb_syarat a');
	}

	public function getDataEditPersyaratanPermohonanIMB($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_sk_tabg', $id);
		$query 	= $this->db->get('tm_sk_tabg a')->row();
		return $query;
	}

	public function removeDataPersyaratanPermohonan($id_sk_tabg)
	{

		$this->db->where('id_sk_tabg', $id_sk_tabg);
		$query = $this->db->delete('tm_sk_tabg_detail');
		return $query;
	}

	public function getDataEditTimTeknis($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_sk_tabg', $id);
		$query 	= $this->db->get('tm_sk_tim_teknis a')->row();
		return $query;
	}

	public function getDataEditTimTABG($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_sk_tabg', $id);
		$query 	= $this->db->get('tm_sk_tabg a')->row();
		return $query;
	}

	public function removeDataTimTeknis($id_sk_tabg)
	{

		$this->db->where('id_sk_tabg', $id_sk_tabg);
		$query = $this->db->delete('tm_sk_tim_teknis_detail');
		return $query;
	}


	public function get_tim_teknis_selected($id_sk_tabg)
	{
		$this->db->select('id_personal');
		$this->db->where('id_sk_tabg', $id_sk_tabg);
		return $this->db->get('tm_sk_tim_teknis_detail');
	}

	public function get_tabg_selected($id_sk_tabg)
	{
		$this->db->select('id_personal');
		$this->db->where('id_sk_tabg', $id_sk_tabg);
		return $this->db->get('tm_sk_tabg_detail');
	}
	//Begin Personal TPA
	public function get_sk_tpaX($id_kabkot = '')
	{
		$this->db->select('id,nm_tpa');
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('id_kota_tabg', $id_kabkot);
		$this->db->where('status', '3');
		$this->db->order_by('id', 'asc');
		return $this->db->get('tm_tpa');
	}

	public function get_sk_tpa($select = "*", $id_kabkot = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('id_kabkotnya', $id_kabkot);
		$this->db->join('tm_tpa b', 'a.id_tpanya = b.id', 'LEFT');
		return $this->db->get('zample_tm_tpa_perkabkot a');
	}

	public function get_sk_tselected($id)
	{
		$this->db->select('id_tpanya');
		$this->db->where('id_sk', $id);
		return $this->db->get('tm_sk_tdetail');
	}

	public function removeDataTPA($id)
	{
		$this->db->where('id_sk', $id);
		$query = $this->db->delete('tm_sk_tdetail');
		return $query;
	}
	//End Personal TPA

	// awal psk
	public function get_sk_parent_p($id_kabkot = '')
	{
		$this->db->select('id_personal,nama_personal');
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('id_kota_tabg', $id_kabkot);
		//$this->db->where('stat', '1');
		$this->db->order_by('id_personal', 'asc');
		return $this->db->get('tm_personal');
	}

	public function get_sk_parent($id_kabkot = '')
	{
		$this->db->select('id_personal,nama_personal');
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('id_kota_tabg', $id_kabkot);
		$this->db->where('stat', '1');
		$this->db->order_by('id_personal', 'asc');
		return $this->db->get('tm_personal');
	}

	public function get_sk_selected($id)
	{
		$this->db->select('id_personal');
		$this->db->where('id_sk', $id);
		return $this->db->get('tm_sk_pdetail');
	}

	public function getDataEditPSK($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_sk', $id);
		$query     = $this->db->get('tm_sk_pengaturan a')->row();
		return $query;
	}

	public function removeDataPSK($id)
	{
		$this->db->where('id_sk', $id);
		$query = $this->db->delete('tm_sk_pdetail');
		return $query;
	}
	//akhir psk

	function tpapusat_list()
	{
		$hasil = $this->db->query("SELECT * FROM zample_tm_tpa WHERE status = 4 ");
		return $hasil->result();
	}

	function tampilin_tpa($select = "a.*", $id_kabkot = '')
	{

		$this->db->select($select, FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkotnya', $id_kabkot);
		$this->db->join('tm_tpa b', 'a.id_tpanya = b.id', 'LEFT');
		$query 	= $this->db->get('zample_tm_tpa_perkabkot a');
		return $query->result();
	}

	/*function tampilin_tpa($select="a.*",$id_kabkot=''){
		
		$this->db->select($select,FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  
		$this->db->where('a.id_kabkotnya', $id_kabkot);
		//$this->db->where('a.status', 2);
		$this->db->join('tm_tpa b', 'a.id_tpanya = b.id', 'LEFT');
		$query 	= $this->db->get('tm_tpa_perkabkot a');
		return $query->result();
	}*/

	public function getProv($select = "a.*", $id_kabkot = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot', $id_kabkot);
		$query 	= $this->db->get('tr_kabkot a')->row();
		return $query;
	}

	public function getnamaProv($select = "a.*", $provinsi = '')
	{
		$this->db->select($select, FALSE);
		if ($provinsi != null || trim($provinsi) != '')  $this->db->where('a.id_provinsi', $provinsi);
		$query 	= $this->db->get('tr_provinsi a')->row();
		return $query;
	}

	public function get_ATP($select = "a.*,b.nama_kabkota", $provinsi = '', $id_kabkot = '')
	{
		$sql = "SELECT a.*,b.nama_kabkota
		FROM tm_tpa a
		Left join tr_kabkot b On (b.id_kabkot=a.id_kabkot)
		WHERE (1=1) AND a.status >= 3 AND a.id_provinsi != 99";
		$sql .= " AND a.id NOT IN( SELECT id_tpanya FROM zample_tm_tpa_perkabkot WHERE id_kabkotnya = '$id_kabkot' ) ";
		$hasil  = $this->db->query($sql);
		//return $hasil;
		return $hasil->result();
	}

	public function _getAPIDataTPA($id_kabkot, $provinsi)
	{
		$this->datatables->select('a.id,a.nm_tpa,a.glr_depan,a.glr_blkg,a.id_lembaga,c.nama_lembaga,b.nama_kabkota,d.nama_provinsi');

		if ($this->input->post('lembaga') != '') {
			$this->datatables->where('c.id_lembaga', $this->input->post('lembaga'));
		}

		if ($this->input->post('provinsi') != '') {
			$this->datatables->where('a.id_provinsi', $this->input->post('provinsi'));
		}

		// if ($this->input->post('kabkota') != '') {
		// 	$this->datatables->where('a.id_kabkot', $this->input->post('kabkota'));
		// }
		


		return $this->datatables
			->from('tm_tpa a')
			->join('tr_kabkot b', 'b.id_kabkot = a.id_kabkot', 'left')
			->join('trlembaga c', 'c.id_lembaga = a.id_lembaga', 'left')
			->join('tr_provinsi d', 'd.id_provinsi = a.id_provinsi', 'left')
			->where('a.status >= 3')
			->generate();
	}


	public function getDataUnsur()
	{
		return $this->db->get('trlembaga');
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

	public function getDetailTPA($id)
	{
		return
			$this->db
			->where('b.id', $id)
			->join('tm_tpadokumen c', 'c.id = b.id', 'left')
			->get('tm_tpa b');
	}
}
