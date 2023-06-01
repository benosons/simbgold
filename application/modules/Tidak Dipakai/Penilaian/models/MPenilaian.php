<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MPenilaian extends CI_Model{
	
	
	//Begin Pengawas
	public function  getListKonsultasi()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('*');
		$this->db->from('tmDataPemilik a');
		$this->db->where("status >= 7 ");
	  	$this->db->where('id_kabkot_bgn',$Dinas);
		$this->db->join('tmDataBangunan b', 'a.id = b.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}

	public function  getListPenugasan()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.* ,b.*,c.nm_konsultasi');
		$this->db->from('tmDataPemilik a');
		$this->db->where("status >= 3 ");
	  	$this->db->where('id_kabkot_bgn',$Dinas);
		$this->db->join('tmDataBangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}

	public function  getDataPenugasan()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmDataPemilik as a,tr_konsultasi as b,tmDataBangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function getDetailPengawas($id)
	{
		$this->db->select('a.id as id_pemilik,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,almt_bgn,fungsi_bg,jns_bangunan,luas_bgn,tinggi_bgn,id_kabkot_bgn,b.status,b.id_fungsi_bg,b.jml_lantai');
		$this->db->from('tmDataPemilik a');
		$this->db->where("b.status >= 3 ");
		$this->db->join('tmDataBangunan b', 'a.id = b.id', 'LEFT');
		$this->db->where('a.id', $id);
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_imb_permohonan d', 'd.id_jenis_permohonan = b.id_jenis_permohonan', 'left');
		$this->db->join('tr_fungsi_bg f', 'f.id_fungsi_bg = b.id_fungsi_bg', 'left');
		$this->db->order_by('b.status', 'asc');
		$query = $this->db->get();
		return $query;
	}


	function cekTotalPetugas($id_pemilik)
	{
		return $this->db->where('id_pemilik', $id_pemilik)->get('tm_penugasan_pbg');
	}

	function insertBatchPersonil($data)
	{
		return $this->db->insert_batch('tm_penugasan_pbg', $data);
	}

	function cekPersonalPenugasan($id, $arr)
	{
		return $this->db
			->where('id_pemilik', $id)
			->where_in('id_personal', $arr)
			->get('tm_penugasan_pbg');
	}


	function getByIdPtugas($id)
	{
		$this->db->join('tm_personal', 'tm_penugasan_pbg.id_personal = tm_personal.id_personal');
		return $this->db->get_where('tm_penugasan_pbg', array('id_pemilik' => $id)); ///ya gitu lah
	}

	function updateStats($data, $id)
	{
		return $this->db->where('id', $id)->update('tmdatabangunan', $data);
	}

	public function getTimTabg($id)
	{
		return $this->db
			->join('tm_sktabgdetail', 'tm_sktabgdetail.id_personal = tm_personal.id_personal', 'left')
			->join('tm_sktabg', 'tm_sktabg.id_skta = tm_sktabgdetail.id_skta', 'left')
			->join('tr_provinsi', 'tr_provinsi.id_provinsi = tm_personal.id_provinsi', 'left')
			->join('tr_kabkot', 'tr_kabkot.id_kabkot = tm_personal.id_kabkot', 'left')
			->join('tm_sertifikasi', 'tm_sertifikasi.id_personal = tm_personal.id_personal', 'left')
			->join('tm_riwpendidikan', 'tm_riwpendidikan.id_personal = tm_personal.id_personal', 'left')
			->join('tr_unsur', 'tr_unsur.id_unsur = tm_sertifikasi.id_unsur', 'left')
			->join('tr_unsur_ahli', 'tr_unsur_ahli.id_unsur_ahli = tm_sertifikasi.id_unsur_ahli', 'left')
			->join('tr_unsur_keahlian', 'tr_unsur_keahlian.id_unsur_keahlian = tm_sertifikasi.id_unsur_keahlian', 'left')
			->get_where('tm_personal', array(
				'tm_personal.id_kabkot' => $id,
				'tm_personal.stat' => 0,
			));
	}

	public function getTimTeknis($id)
	{
		return $this->db
			->join('tm_sktdetail', 'tm_sktdetail.id_personal = tm_personal.id_personal', 'left')
			->join('tm_sk_timteknis', 'tm_sk_timteknis.id_skt = tm_sktdetail.id_skt', 'left')
			->join('tr_provinsi', 'tr_provinsi.id_provinsi = tm_personal.id_provinsi', 'left')
			->join('tr_kabkot', 'tr_kabkot.id_kabkot = tm_personal.id_kabkot', 'left')
			->join('tm_sertifikasi', 'tm_sertifikasi.id_personal = tm_personal.id_personal', 'left')
			->join('tm_riwpendidikan', 'tm_riwpendidikan.id_personal = tm_personal.id_personal', 'left')
			->join('tr_unsur', 'tr_unsur.id_unsur = tm_sertifikasi.id_unsur', 'left')
			->join('tr_unsur_ahli', 'tr_unsur_ahli.id_unsur_ahli = tm_sertifikasi.id_unsur_ahli', 'left')
			->join('tr_unsur_keahlian', 'tr_unsur_keahlian.id_unsur_keahlian = tm_sertifikasi.id_unsur_keahlian', 'left')
			->get_where('tm_personal', array(
				'tm_personal.id_kabkot' => $id,
				'tm_personal.stat' => 1,
			));
	}

	//Begin Penjadwalan Konsultasi
	public function  getListPenjadwalan()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.* ,b.*,c.nm_konsultasi');
		$this->db->from('tmDataPemilik a');
		$this->db->where("status >= 4 ");
	  	$this->db->where('id_kabkot_bgn',$Dinas);
		$this->db->join('tmDataBangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}

	public function  getDataPenjadwalan($id)
	{
		$this->db->select('*');
		$this->db->from('tmDataPemilik a');
		$this->db->where('a.id',$id);
		$this->db->join('tmDataBangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->join('tr_kecamatan d', 'a.id_kecamatan = d.id_kecamatan','LEFT');
		$this->db->join('tr_kabkot e', 'a.id_kabkota = e.id_kabkot','LEFT');
		$this->db->join('tr_provinsi f', 'a.id_provinsi = f.id_provinsi','LEFT');
		$query = $this->db->get();
		return $query;
	}

	function getDataPetugas($id=null)
	{
		$sql = "SELECT a.*,
				x.id_penugasan_pbg,x.id_pemilik, 
				b.nama_provinsi, 
				c.nama_kabkota,  
				g.dir_file, 
				f.nama_jenjang,
				l.nama_jurusan, 
				k.nama_unsur, 
				m.nama_keahlian, 
				i.nama_unsur_ahli, 
				n.nama_bidang
				FROM tm_penugasan_pbg x 
				LEFT JOIN tm_personal a on (a.id_personal=x.id_personal)
				LEFT JOIN tr_provinsi b on (a.id_provinsi=b.id_provinsi)
				LEFT JOIN tr_kabkot c on (a.id_kabkot=c.id_kabkot)
				LEFT JOIN tm_riwpendidikan e on (a.id_personal=e.id_personal AND e.status_pdd='1')
				LEFT JOIN tr_jenjang f on (e.id_jenjang=f.id_jenjang)
				LEFT JOIN tr_jurusan l on (e.id_jurusan=l.id_jurusan)
				LEFT JOIN tm_sertifikasi g on (a.id_personal=g.id_personal AND g.status_stk='1')
				LEFT JOIN tr_unsur k on (g.id_unsur=k.id_unsur)
				LEFT JOIN tr_unsur_keahlian m on (g.id_unsur_keahlian=m.id_unsur_keahlian)
				LEFT JOIN tr_unsur_ahli i ON (g.id_unsur_ahli=i.id_unsur_ahli)
				LEFT JOIN tr_bidang n ON (g.id_bidang=n.id_bidang)	
				LEFT JOIN tmdatabangunan h on (x.id_pemilik=h.id)
				WHERE (1=1) ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND x.id_pemilik='$id' ";
		
		$sql .= " Group BY a.id_personal ORDER BY a.id_personal ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;	
	}

	function getDataJadwal($id=null,$key_sidang=null,$get_max=null)
	{
		$sql = "SELECT a.*
				FROM tmdatajadwal a
				left join tmdatabangunan b on (a.id = b.id)
				WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		if ($key_sidang != null || trim($key_sidang) != '')  $sql .= " AND a.id_jadwal = '$key_sidang' ";
		if ($get_max != null || trim($get_max) != ''){
		$sql .= "  ORDER BY a.id_jadwal DESC limit 1";
		}
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function insertDataJadwal($dataIn)
	{
		$this->db->insert('tmdatajadwal',$dataIn);
		return $this->db->insert_id();
	}

	function updateProgress($dataProgress,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tmdatabangunan',$dataProgress);
		$updated_status = $this->db->affected_rows();
	}
}