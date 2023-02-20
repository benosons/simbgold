<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Msekretariat extends CI_Model
{
	public function getDataSekretariat($select="a.*")
	{
		$this->db->select($select,FALSE);
		$this->db->where('a.id_dinas', 8);
		$this->db->where('a.id', 1);
		$query 	= $this->db->get('tm_profile_dinas a')->row();
		return $query;
	}
	
	public function getDataAkun()
	{
		$sql = "SELECT a.*, b.user_id,b.nama_lengkap,b.jabatan_dinas,b.nip
		FROM tm_user a
			LEFT JOIN tm_user_data b ON (a.id = b.user_id)
		WHERE (1=1) AND (a.role_id = 3)";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function listDataPesonilAsn($select = "*", $id_personal = '', $stat = '')
	{
		$this->db->select($select, FALSE);
		if ($id_personal != null || trim($id_personal) != '')  $this->db->where('a.id_personal', $id_personal);
		if ($id_personal != null || trim($id_personal) != '')  $this->db->join('tm_riwpendidikan b', "a.id_personal = b.id_personal", 'LEFT');
		if ($id_personal != null || trim($id_personal) != '')  $this->db->join('tm_sertifikasi c', "a.id_personal = c.id_personal", 'LEFT');
		//$this->db->where('id_kota_tabg', $this->session->userdata('loc_id_kabkot'));
		$this->db->where('a.stat', 3);

		$this->db->order_by('a.id_personal', 'desc');
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
	
	public function listDataJurusan($select = "a.*", $id_jurusan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_jurusan != null || trim($id_jurusan) != '')  $this->db->where('a.id_jurusan', $id_jurusan);
		$query 	= $this->db->get('tr_jurusan a');
		return $query;
	}
	
	
	public function removeDataPSK($id)
	{
			$this->db->where('id_sk', $id);
			$query = $this->db->delete('tm_sk_pdetail');
			return $query;
	}
	
	public function removeDataTPA($id)
	{
			$this->db->where('id_sk', $id);
			$query = $this->db->delete('tm_sk_tdetail');
			return $query;
	}
	
	public function get_sk_parent($id_kabkot = '')
	{
			$this->db->select('id_personal,nama_personal');
			if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('id_kota_tabg', $id_kabkot);
			$this->db->where('stat', '3');
			$this->db->order_by('id_personal', 'asc');
			return $this->db->get('tm_personal');
	}

 	public function get_sk_selected($id)
	{
			$this->db->select('id_personal');
			$this->db->where('id_sk', $id);
			return $this->db->get('tm_sk_pdetail');
	}
	
	public function get_sk_tpa($select="*",$id_kabkot = '')
	{
			$this->db->select($select, FALSE);
			if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('id_kabkotnya', $id_kabkot);
			//$this->db->join('zample_tm_tpa b', 'a.id_tpanya = b.id', 'LEFT');
			$this->db->join('tm_tpa b', 'a.id_tpanya = b.id', 'LEFT');
			return $this->db->get('zample_tm_tpa_perkabkot a');
			//return $this->db->get('tm_tpa_perkabkot a');
	}

	public function get_sk_tselected($id)
	{
		$this->db->select('id_tpanya');
		$this->db->where('id_sk', $id);
		return $this->db->get('tm_sk_tdetail');
	}
	
	public function getDataEditPSK($select = "*", $id)
	{
			$this->db->select($select, FALSE);
			$this->db->where('a.id_sk', $id);
			$query     = $this->db->get('tm_sk_pengaturan a')->row();
			return $query;
	}


	public function getProv($select="a.*",$id_kabkot='')
	{
		$this->db->select($select,FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		$query 	= $this->db->get('tr_kabkot a')->row();
		return $query;
	}
	
	function tampilin_tpa($select="a.*",$id_kabkot=''){
		
		$this->db->select($select,FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkotnya', $id_kabkot);
		$this->db->join('tm_tpa b', 'a.id_tpanya = b.id', 'LEFT');
		$query 	= $this->db->get('zample_tm_tpa_perkabkot a');
		return $query->result();
	}


	public function getnamaProv($select="a.*",$provinsi='')
	{
		$this->db->select($select,FALSE);
		if ($provinsi != null || trim($provinsi) != '')  $this->db->where('a.id_provinsi',$provinsi);
		$query 	= $this->db->get('tr_provinsi a')->row();
		return $query;
	}

	public function get_ATP($select="a.*,b.nama_kabkota",$provinsi='',$id_kabkot='')
	{
		$sql = "SELECT a.*,b.nama_kabkota
		FROM tm_tpa a
		Left join tr_kabkot b On (b.id_kabkot=a.id_kabkot)
		WHERE (1=1) AND a.status >= 3 ";
		//WHERE (1=1) AND a.status = 4";
		$sql .= " AND a.id NOT IN( SELECT id_tpanya FROM zample_tm_tpa_perkabkot WHERE id_kabkotnya = '$id_kabkot' ) ";
		$hasil  = $this->db->query($sql);
		//return $hasil;
		return $hasil->result();
		
	}

	public function getDataTPA($select="a.*",$id_kabkot=''){
		$this->db->select($select,FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkotnya', $id_kabkot);
		$this->db->join('tm_tpa b', 'a.id_tpanya = b.id', 'LEFT');
		$query 	= $this->db->get('zample_tm_tpa_perkabkot a');
		return $query->result();
	}
	
	public function getDataUnsur()
	{
		return $this->db->get('trlembaga');
	}

	public function _getAPIDataTPA()
	{
		$this->datatables->select('a.id,a.nm_tpa,a.glr_depan,a.glr_blkg,a.id_lembaga,c.nama_lembaga,b.nama_kabkota,d.nama_provinsi');

		if ($this->input->post('lembaga') != '') {
			$this->datatables->where('c.id_lembaga', $this->input->post('lembaga'));
		}
		if ($this->input->post('provinsi') != '') {
			$this->datatables->like('a.id_provinsi', $this->input->post('provinsi'));
		}
		if ($this->input->post('kabkota') != '') {
			$this->datatables->like('a.id_kabkot', $this->input->post('kabkota'));
		}
		return $this->datatables
			->from('tm_tpa a')
			->join('tr_kabkot b', 'b.id_kabkot = a.id_kabkot', 'left')
			->join('trlembaga c', 'c.id_lembaga = a.id_lembaga', 'left')
			->join('tr_provinsi d', 'd.id_provinsi = a.id_provinsi', 'left')
			->where('a.status >= 3')
			->generate();
	}
}
