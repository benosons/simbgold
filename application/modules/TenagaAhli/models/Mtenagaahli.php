<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MtenagaAhli extends CI_Model
{
	public function getdatadiri($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')
			$this->db->where('a.id', $id);
		/*$this->db->join('tr_kecamatan b', 'a.id_kecamatan = b.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot c', 'a.id_kabkota = c.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi d', 'a.id_provinsi = d.id_provinsi', 'LEFT');*/
		$query 	= $this->db->get('tm_tpa a');
		return $query->row();
	}

	public function gettpaPengalaman($id)
	{
		return $this->db
			->get_where('tm_tpapengalaman', array('tm_tpapengalaman.id' => $id));
	}

	public function getdataprofesi($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')
			$this->db->where('a.id', $id);
		/*$this->db->join('tr_kecamatan b', 'a.id_kecamatan = b.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot c', 'a.id_kabkota = c.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi d', 'a.id_provinsi = d.id_provinsi', 'LEFT');*/
		$query 	= $this->db->get('tm_tpaints a');
		return $query->row();
	}

	public function getTPA($user_id = null)
	{
		$sql = "SELECT a.*
			FROM tm_tpa a
		WHERE (1=1)";
		if ($user_id != null || trim($user_id) != '')  $sql .= " AND a.id_user = '$user_id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function listDataPesonilTpa($select = "*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  
		$this->db->where('a.id_user', $id);
		//$this->db->order_by('a.id', 'desc');
		$this->db->join('tm_tpadokumen b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_asosiasi c', 'b.id_asak = c.id', 'LEFT');
		$query 	= $this->db->get('tm_tpa a');
		return $query;
	}

	public function listDataPendidikanTpa($select = "*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		$query 	= $this->db->get('tmdatariwpend a');
		return $query;
	}

	public function getJenjangPendidikan($id)
	{
		return $this->db
			->join('tr_jenjang', 'tr_jenjang.id_jenjang = tmdatariwpend.id_jenjang', 'left')
			->get_where('tmdatariwpend', array('tmdatariwpend.id' => $id));
	}

	public function getDataKeahlian($id)
	{
		return $this->db
			->join('tr_keahlian', 'tr_keahlian.id_keahlian = tmdatatahli.id_keahlian', 'left')
			->get_where('tmdatatahli', array('tmdatatahli.id' => $id));
	}

	public function getDataPengalaman($id)
	{
		return $this->db
			->join('tr_kabkot', 'tr_kabkot.id_kabkot = tmdatatpengalaman.id_kabkot', 'left')
			->get_where('tmdatatpengalaman', array('tmdatatpengalaman.id' => $id));
	}

	function listDataPend($id)
	{
		return $this->db->get_where('tmdatariwpend ', array('id' => $id));
	}

	public function listDataPeng($id)
	{
		return $this->db->get_where('tmdatatpengalaman ', array('id' => $id));
	}

	public function listDataKeahlian($id)
	{
		return $this->db->get_where('tmdatariwahli ', array('id' => $id));
	}


	function getPendiVerifikasi($id)
	{
		return $this->db->get_where('tmdatariwpend ', array('id' => $id));
	}

	public function listDataJurusan($select = "a.*", $id_jurusan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_jurusan != null || trim($id_jurusan) != '')  $this->db->where('a.id_jurusan', $id_jurusan);
		$query 	= $this->db->get('tr_jurusan a');
		return $query;
	}

	function get_jenis_fungsi_list($id = null, $keahlian = null)
	{
		if ($id != null || trim($id) != '')
			$this->db->where('id_keahlian', $id);
		if ($keahlian != null || trim($keahlian) != '')
			$this->db->like('keahlian', $keahlian, 'both');
		$this->db->order_by('id_keahlian', 'asc');
		$hasil =  $this->db->get('tr_keahlian');
		return $hasil;
	}

	public function getperguruan($id = null, $nm_asosiasi = null, $group=null)
	{
		if ($id != null || trim($id) != '')
			$this->db->where('id', $id);
			$this->db->where('group', 2);
		if ($nm_asosiasi != null || trim($nm_asosiasi) != '')
			$this->db->like('nm_asosiasi', $nm_asosiasi, 'both');
		$this->db->order_by('id', 'asc');
		$hasil =  $this->db->get('tr_asosiasi');
		return $hasil;
	}
	public function getasosiasi($id = null, $nm_asosiasi = null)
	{
		if ($id != null || trim($id) != '')
			$this->db->where('id', $id);
			$this->db->where('group', 1);
		if ($nm_asosiasi != null || trim($nm_asosiasi) != '')
			$this->db->like('nm_asosiasi', $nm_asosiasi, 'both');
		$this->db->order_by('id', 'asc');
		$hasil =  $this->db->get('tr_asosiasi');
		return $hasil;
	}
	public function getpakar($id = null, $nm_asosiasi = null)
	{
		if ($id != null || trim($id) != '')
			$this->db->where('id', $id);
			$this->db->where('group', 3);
		if ($nm_asosiasi != null || trim($nm_asosiasi) != '')
			$this->db->like('nm_asosiasi', $nm_asosiasi, 'both');
		$this->db->order_by('id', 'asc');
		$hasil =  $this->db->get('tr_asosiasi');
		return $hasil;
	}

	public function listDataTpa($select = "*")
	{
		$this->db->select($select, FALSE);
		$query 	= $this->db->get('tm_tpa a');
		return $query;
	}

	public function listValidasiDataTpa($select = "*")
	{
		$this->db->select($select, FALSE);
		$this->db->where("a.status >= 3 ");
		$query 	= $this->db->get('tm_tpa a');
		return $query;
	}

	public function getDataTpaVer($id)
	{
		$this->db->select('a.*');
		$this->db->from('tm_tpa a');
		$this->db->where('a.id', $id);
		$query = $this->db->get();
		return $query;
	}

	function getByIdPtugas($id)
	{
		return $this->db->join('tm_personal', 'tm_penugasan_pbg.id_personal = tm_personal.id_personal')
			->join('tm_sertifikasi', 'tm_sertifikasi.id_personal = tm_personal.id_personal', 'left')
			->join('tm_riwpendidikan', 'tm_riwpendidikan.id_personal = tm_personal.id_personal', 'left')
			->join('tr_unsur', 'tr_unsur.id_unsur = tm_sertifikasi.id_unsur', 'left')
			->join('tr_unsur_ahli', 'tr_unsur_ahli.id_unsur_ahli = tm_sertifikasi.id_unsur_ahli', 'left')
			->join('tr_unsur_keahlian', 'tr_unsur_keahlian.id_unsur_keahlian = tm_sertifikasi.id_unsur_keahlian', 'left')
			->get_where('tm_penugasan_pbg', array('id_pemilik' => $id));
	}

	function updateVerifikasiPendidikan($dataIn, $id)
	{
		$this->db->where('id_riwpend', $id);
		$this->db->update('tmdatariwpend', $dataIn);
	}

	function updateStatus($dataTpa,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tm_tpa',$dataTpa);
	}

	//Perubahan Baru

}
