<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpengawas extends CI_Model
{


	//Begin Data Validasi
	public function  getListValidasi()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('*');
		$this->db->from('tmDataPemilik a');
		$this->db->where("status >= 2 ");
		$this->db->where('id_kabkot_bgn', $Dinas);
		$this->db->join('tmDataBangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->order_by('b.status', 'asc');
		$query = $this->db->get();
		return $query;
	}
	
	public function  getDataValidasi($id)
	{
		$this->db->select('a.*,b.*,c.nm_konsultasi,d.*,e.*,f.*');
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
	
	function getTanahVerifikasi($id)
	{
		return $this->db->get_where('tmdatatanah ',array('id'=>$id));
	}
	
	public function getHis($select = "a.*", $id = '')
	{
		$this->db->select($select, FALSE);
		$this->db->join('simbg_status b', 'a.status = b.kode_status', 'LEFT');
		$this->db->join('tm_user c', 'a.user_id = c.id', 'LEFT');
		if ($id != null || trim($id) != '')  $this->db->where('a.id_pemilik', $id);
		$query 	= $this->db->get('th_data_konsultasi a');
		return $query;
	}
	
	function getJenisKonsultasi($id=null,$cari=null)
	{
		$sql = "SELECT a.*, b.*
		FROM tmdatabangunan a
		left join tr_konsultasi b on (a.id_jenis_permohonan = b.id)
		WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function getSyaratList($per=null,$kls=null)
	{
		$sql = "SELECT a.id_persyaratan,a.id,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,
				b.id_detail,b.id_syarat, c.nm_dokumen,c.keterangan,e.dir_file 
				FROM tr_konsultasi_syarat a 
				LEFT JOIN tr_pbg_syarat_detail b ON(a.id_persyaratan=b.id_persyaratan) 
				LEFT JOIN tr_dokumen_syarat c ON(b.id_syarat=c.id) 
				LEFT JOIN tmdatabangunan d ON(a.id=d.id_jenis_permohonan) 
				LEFT JOIN tr_protipe e ON(d.idp=e.idp) 
				WHERE (1=1)
		";	
		if ($per != null || trim($per) != '')  $sql .= " AND a.id = '$per' ";
		if ($kls != null || trim($kls) != '')  $sql .= " AND a.id_detail_jenis_persyaratan = '$kls' ";
		$sql .= " Group by b.id_detail ORDER BY a.id, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat ASC ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	public function getDataJnsKonsultasi($select="a.*",$id='')
	{
		$this->db->select($select,FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id',$id);
		$query 	= $this->db->get('tmDataBangunan a');
		return $query;
	}
	
	public function getDataDokumen($select="a.*",$id='',$status='')
	{
		$this->db->select($select,FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id',$id);
		if ($status != null || trim($status) != '')  $this->db->where('a.status',$status);
		$query 	= $this->db->get('tmPersyaratanKonsultasi a');
		return $query;
	}
	
	public function getDataTanah($select="a.*",$id_jenis_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id',$id_jenis_permohonan);
		$this->db->where('a.id_detail_jenis_persyaratan','1');
		$this->db->join('tr_pbg_syarat_detail b','a.id_persyaratan = b.id_persyaratan','LEFT');
		$this->db->join('tr_dokumen_syarat c','b.id_syarat = c.id','LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}
	
	function get_jenis_fungsi_list($id = null, $fungsi_bg = null, $id_pemanfaatan_bg = null)
	{
		if ($id != null || trim($id) != '')
			$this->db->where('id_fungsi_bg', $id);
		if ($fungsi_bg != null || trim($fungsi_bg) != '')
			$this->db->like('fungsi_bg', $fungsi_bg, 'both');
		if ($id_pemanfaatan_bg != null || trim($id_pemanfaatan_bg) != '')
			$this->db->where('id_pemanfaatan_bg', $id_pemanfaatan_bg);

		$this->db->order_by('id_fungsi_bg', 'asc');
		$hasil =  $this->db->get('tr_fungsi_bg');
		return $hasil;
	}
	
	function getSyarat($id=null,$per=null,$status=null)
	{
		$sql = "SELECT a.*
				FROM tmPersyaratanKonsultasi a
				WHERE (1=1) ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_persyaratan_detail = '$id' ";
		if ($per != null || trim($per) != '')  $sql .= " AND a.id = '$per' ";
		if ($status != null || trim($status) != '')  $sql .= " AND a.status = '$status' ";
		$sql .= " ORDER BY a.id_persyaratan ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function updateVerifikasiTanah($dataIn,$id)
	{
		$this->db->where('id_detail', $id);
		$this->db->update('tmDataTanah',$dataIn);
	}
	
	function updateValidasi($dataIn,$id,$detail)
	{
		$this->db->where(array('id'=>$id,'id_persyaratan_detail'=>$detail));
		$this->db->update('tmPersyaratanKonsultasi',$dataIn);
		$updated_status = $this->db->affected_rows();
		if($updated_status):
			return $detail;
		else:
			return false;
		endif;
	}
	
	function insert_syarat($dataIn)
	{
		$this->db->insert('tmpersyaratankonsultasi',$dataIn);
		return $this->db->insert_id();
	}
	//End Data Validasi

	public function getPenugasanAll($dateOne, $dateTwo)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.tgl_pernyataan >=", $dateOne);
		$this->db->where("c.tgl_pernyataan <=", $dateTwo);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findFungsi($fungsi_bg, $dateOne, $dateTwo)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmDataPemilik as a,tr_konsultasi as b,tmDataBangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.tgl_pernyataan >=", $dateOne);
		$this->db->where("c.tgl_pernyataan  <=", $dateTwo);
		$this->db->where("c.id_fungsi_bg", $fungsi_bg);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findFungsiWithoutDate($fungsi_bg)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmDataPemilik as a,tr_konsultasi as b,tmDataBangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.id_fungsi_bg", $fungsi_bg);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findProses($proses, $dateOne, $dateTwo)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmDataPemilik as a,tr_konsultasi as b,tmDataBangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.tgl_pernyataan >=", $dateOne);
		$this->db->where("c.tgl_pernyataan  <=", $dateTwo);
		$this->db->where("c.status", $proses);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}
	
	public function findProsesWithoutDate($proses)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmDataPemilik as a,tr_konsultasi as b,tmDataBangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.status", $proses);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}


	public function findAll($fungsi_bg, $proses, $dateOne, $dateTwo)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmDataPemilik as a,tr_konsultasi as b,tmDataBangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.tgl_pernyataan >=", $dateOne);
		$this->db->where("c.tgl_pernyataan  <=", $dateTwo);
		$this->db->where("c.status", $proses);
		$this->db->where("c.id_fungsi_bg", $fungsi_bg);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findAllWithoutDate($fungsi_bg, $proses)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmDataPemilik as a,tr_konsultasi as b,tmDataBangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.status", $proses);
		$this->db->where("c.id_fungsi_bg", $fungsi_bg);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}



	public function  getListPenugasan()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('*');
		$this->db->from('tmDataPemilik a');
		$this->db->where("status >= 3 ");
		$this->db->where('id_kabkot_bgn', $Dinas);
		$this->db->join('tmDataBangunan b', 'a.id = b.id', 'INNER');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->order_by('b.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function getDataPenugasan()
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

	function getdetailPenugasan($id)
	{
		$this->db->select('a.id as id_pemilik,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,almt_bgn,fungsi_bg,jns_bangunan,luas_bgn,tinggi_bgn,id_kabkot_bgn,b.status,b.id_fungsi_bg,b.jml_lantai,nama_kecamatan,h.nama_kabkota,nama_provinsi,no_hp,email,no_ktp,luas_basement,lapis_basement,nm_bgn');
		$this->db->from('tmDataPemilik a');
		$this->db->where("b.status >= 3 ");
		$this->db->where('a.id', $id);
		$this->db->join('tmDataBangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_imb_permohonan d', 'd.id_jenis_permohonan = b.id_jenis_permohonan', 'left');
		$this->db->join('tr_kecamatan e', 'e.id_kecamatan = a.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot h', 'h.id_kabkot = a.id_kabkota', 'LEFT');
		$this->db->join('tr_provinsi i', 'i.id_provinsi = a.id_provinsi', 'LEFT');
		$this->db->join('tr_fungsi_bg f', 'f.id_fungsi_bg = b.id_fungsi_bg', 'left');
		$this->db->order_by('b.status', 'asc');
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

	function getIMBpenugasan()
	{
		$tot = $this->session->userdata('loc_id_kabkot');
		$dev = $this->session->userdata('loc_role_id');
		$this->db->select('*'); //memeilih semua field
		$this->db->from('tm_imb_permohonan'); //memeilih tabel
		$this->db->where("status_progress >= 5 ");
		$this->db->where('status_syarat = 1'); //memilih kondisi
		if ($dev != 1)  $this->db->where('id_kabkot_bg', $tot);
		$this->db->join('tr_imb_permohonan', 'tm_imb_permohonan.id_jenis_permohonan = tr_imb_permohonan.id_jenis_permohonan');
		$this->db->join('tr_fungsi_bg', 'tm_imb_permohonan.id_fungsi_bg = tr_fungsi_bg.id_fungsi_bg');
		//$this->db->order_by('tm_imb_permohonan.id_permohonan','desc');
		$this->db->order_by('tm_imb_permohonan.status_penugasan', 'asc');
		$this->db->order_by('tm_imb_permohonan.id_permohonan', 'desc');

		//$this->db->join('tm_imb_penugasan', 'tm_imb_permohonan.id_permohonan = tm_imb_penugasan.id_permohonan'); 
		//$this->db->join('tm_personal', 'tm_imb_penugasan.id_personal = tm_personal.id_personal'); 
		$query = $this->db->get(); //simpan database yang udah di get alias ambil ke query
		return $query; //hasil dari semua proses ada dimari
	}
	function get_permohonan($id = null, $cari = null)
	{
		$sql = "SELECT a.*, b.*
		FROM tm_imb_permohonan a
		left join tr_imb_permohonan b on (a.id_jenis_permohonan = b.id_jenis_permohonan)
		WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$hasil  = $this->db->query($sql);
		return $hasil;
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

	function cekPersonalPenugasan($id, $arr)
	{
		return $this->db
			->where('id_pemilik', $id)
			->where_in('id_personal', $arr)
			->get('tm_penugasan_pbg');
	}

	function insertBatchPersonil($data)
	{
		return $this->db->insert_batch('tm_penugasan_pbg', $data);
	}

	function getByIdPtugas($id)
	{
		return $this->db->join('tm_personal', 'tm_penugasan_pbg.id_personal = tm_personal.id_personal')
			->join('tm_sertifikasi', 'tm_sertifikasi.id_personal = tm_personal.id_personal', 'left')
			->join('tm_riwpendidikan', 'tm_riwpendidikan.id_personal = tm_personal.id_personal', 'left')
			->join('tr_unsur', 'tr_unsur.id_unsur = tm_sertifikasi.id_unsur', 'left')
			->join('tr_unsur_ahli', 'tr_unsur_ahli.id_unsur_ahli = tm_sertifikasi.id_unsur_ahli', 'left')
			->join('tr_unsur_keahlian', 'tr_unsur_keahlian.id_unsur_keahlian = tm_sertifikasi.id_unsur_keahlian', 'left')
			->get_where('tm_penugasan_pbg', array('id_pemilik' => $id)); ///ya gitu lah
	}

	function updateStats($data, $id)
	{
		return $this->db->where('id', $id)->update('tmdatabangunan', $data);
	}

	function cekTotalPetugas($id_pemilik)
	{
		return $this->db->where('id_pemilik', $id_pemilik)->get('tm_penugasan_pbg');
	}
}
