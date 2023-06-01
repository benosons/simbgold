<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mtpa extends CI_Model
{

	public function getTPA($user_id = null)
	{
		$sql = "SELECT a.*
			FROM tmdatatpa a
		WHERE (1=1)";
		if ($user_id != null || trim($user_id) != '')  $sql .= " AND a.id_user = '$user_id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function listDataPesonilTpa($select = "*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		$this->db->order_by('a.id', 'desc');
		$query 	= $this->db->get('tmdatatpa a');
		return $query;
	}

	public function listDataPendidikanTpa($select = "*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		$query 	= $this->db->get('tmdatariwpend a');
		return $query;
	}

	function listDataPend($id)
	{
		return $this->db->get_where('tmdatariwpend ',array('id'=>$id));
	}

	public function listDataPeng($id)
	{
		return $this->db->get_where('tmdatatpengalaman ',array('id'=>$id));
	}

	public function listDataKeahlian($id)
	{
		return $this->db->get_where('tmdatatahli ',array('id'=>$id));
	}
	

	function getPendiVerifikasi($id)
	{
		return $this->db->get_where('tmdatariwpend ',array('id'=>$id));
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

	public function listDataTpa($select = "*",$id=null,$id_asosiasi=null)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_lembaga', $id );
		$this->db->where('c.id_asak', $id_asosiasi );
		$this->db->where('a.status >= 1 ' );
		$this->db->join('tr_status_tpa b', 'b.id = a.status', 'left');
		$this->db->join('tm_tpadokumen c', 'c.id = a.id', 'left');
		$query 	= $this->db->get('tm_tpa a');
		return $query;
	}

	public function  getListValidasitor($SQLcari = '')
	{
		//$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*, ');
		$this->db->from('tm_tpa a');
		$this->db->where("a.status >= 1 ");
		//$this->db->where('b.id_kabkot_bgn', $Dinas);
		//$this->db->join('tm_tpa b', 'a.id = b.id', 'LEFT');

		$this->db->join('tr_status_tpa b', 'b.id = a.status', 'LEFT');
		/*$this->db->join('tr_kecamatan d', 'a.id_kecamatan = d.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot e', 'a.id_kabkota = e.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi f', 'a.id_provinsi = f.id_provinsi', 'LEFT');
		$this->db->join('tr_fungsi_bg g', 'g.id_fungsi_bg = b.id_fungsi_bg', 'LEFT');*/
		if ($SQLcari != '') {
			!empty($SQLcari['id_lembaga']) ? $this->db->where('a.id_lembaga', $SQLcari['id_lembaga']) : '';
			if (!empty($SQLcari['status'])) {
				$SQLcari['status'] == 5 ? $this->db->where('a.status', $SQLcari['status']) : $this->db->where('a.status ', $SQLcari['status']);
			}

			!empty($SQLcari['tanggalawal']) ? $this->db->where('b.tgl_pernyataan >=', date('Y-m-d', strtotime($SQLcari['tanggalawal']))) : '';
			!empty($SQLcari['tanggalakhir']) ? $this->db->where('b.tgl_pernyataan <=', date('Y-m-d', strtotime($SQLcari['tanggalakhir']))) : '';
		}
		$this->db->order_by('a.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function listValidasiDataTpa($select = "*")
	{
		$this->db->select($select, FALSE);
		$this->db->join('tr_status_tpa b', 'b.id = a.status', 'left');
		$this->db->join('tm_tpadokumen d', 'd.id = a.id', 'left');
		$this->db->join('tr_asosiasi c', 'c.id = d.id_asak', 'left');
		$this->db->where("a.status >= 1 ");
		$query 	= $this->db->get('tm_tpa a');
		return $query;
	}

	public function getDataTpaVer($id)
	{
		$this->db->select('a.*');
		$this->db->from('tm_tpa a');
		$this->db->where('a.id',$id);
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

	function updateVerifikasiPendidikan($dataIn,$id)
	{
		$this->db->where('id_riwpend', $id);
		$this->db->update('tmdatariwpend',$dataIn);
	}

	function updateVerifikasiPengalaman($dataIn,$id)
	{
		$this->db->where('id_pengalaman', $id);
		$this->db->update('tmdatatpengalaman',$dataIn);
	}

	function updateVerifikasiKeahlian($dataIn,$id)
	{
		$this->db->where('id_ahli', $id);
		$this->db->update('tmdatatahli',$dataIn);
	}

	function updateProgress($dataIn,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tm_tpa',$dataIn);
	}

	public function getDataDinasAsosiasi($select = "a.*", $asosiasi = '')
	{
		$this->db->select($select, FALSE);
		if ($asosiasi != null || trim($asosiasi) != '')  $this->db->where('a.id', $asosiasi);
		$query 	= $this->db->get('tr_asosiasi a')->row();
		return $query;
	}

	public function listDataTpaProv($select = "*",$id=null,$id_asak=null,$id_prov=null)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_lembaga', $id );
		$this->db->where('c.id_asak', $id_asak );
		$this->db->where('a.id_provinsi', $id_prov );
		$this->db->where('a.status >= 1 ' );
		$this->db->join('tr_status_tpa b', 'b.id = a.status', 'left');
		$this->db->join('tm_tpadokumen c', 'c.id = a.id', 'left');
		$query 	= $this->db->get('tm_tpa a');
		return $query;
	}

	function getDataAkun($asosiasi=null)
	{
		$sql = "SELECT a.*, b.user_id,b.nama_lengkap,b.jabatan_dinas,b.nip,c.nama_provinsi
		FROM tm_user a
			LEFT JOIN tm_user_data b ON (a.id = b.user_id)
			LEFT JOIN tr_provinsi c ON (a.id_kabkot = c.id_provinsi)
		WHERE (1=1) ";

		if ($asosiasi != null || trim($asosiasi) != '')  $sql .= " AND a.id_asosiasi = '$asosiasi' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function createSubAkun($table, $data)
	{
		$query = $this->db->insert($table, $data);
		return $this->db->insert_id(); // return last insert id
	}

	public function get($table = '', $where = '1=1', $key = '', $sort = '', $limit = '')
	{
		return $query = $this->db->from($table)->where($where)->order_by($key, $sort)->limit($limit)->get();
	}
}
