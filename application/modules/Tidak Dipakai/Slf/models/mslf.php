<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Mslf extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	//Data Summary
	
	function getById($id)
	{
		
		$this->db->join('tr_slf_permohonan d','a.id_jenis_permohonan = d.id_jenis_permohonan','LEFT');
		$this->db->join('tr_kecamatan e', 'a.id_kecamatan_bg = e.id_kecamatan','LEFT');
		$this->db->join('tr_kabkot f', 'a.id_kabkot_bg = f.id_kabkot','LEFT');
		$this->db->join('tr_fungsi_bg g','a.id_fungsi_bg = g.id_fungsi_bg','LEFT');
		return $this->db->get_where('tm_slf_permohonan a',array('a.id_permohonan_slf'=>$id))->row(); ///ya gitu lah
	}
	
	function getByIdTanah($id)
	{
		return $this->db->get_where('tm_slf_tanah',array('id_permohonan_slf'=>$id)); ///ya gitu lah
	}
	
	function update_per_dtanah($dataIn,$id_tanah)
	{
		$this->db->where('id_tanah', $id_tanah);
		$this->db->update('tm_slf_tanah',$dataIn);
	}

	
	function getByIdStatus($id)
	{
		return $this->db->get_where('tm_slf_status',array('id_permohonan_slf'=>$id)); ///ya gitu lah
	}
	
	public function getDataSummary($select="a.*",$id_permohonan_slf='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.id',$id_permohonan_slf);
		$this->db->join('tm_data_pemohon_simbg b','a.id = b.id_permohonan_slf','LEFT');
		$this->db->join('tm_slf_pengajuan c','a.id = c.id_permohonan_slf','LEFT');
		$this->db->join('tm_slf_pemilik d','a.id = d.id_permohonan_slf','LEFT');
		$this->db->join('tr_slf_permohonan e','a.id_nama_permohonan = e.id_jenis_permohonan','LEFT');
		$this->db->join('tm_slf_bangunan f','a.id = f.id_permohonan_slf','LEFT');
		$this->db->join('tr_kecamatan g','f.id_kecamatan_bg = g.id_kecamatan','LEFT');
		$this->db->join('tr_kabkot h','f.id_kabkot_bg = h.id_kabkot','LEFT');
		$this->db->join('tr_provinsi i','f.id_provinsi_bg = i.id_provinsi','LEFT');
		$this->db->join('tm_imb_penerbitan j','f.id_permohonan = j.id_permohonan','LEFT');
		$query 	= $this->db->get('tm_slf_pengajuan a');
		return $query;
	}
	
	public function getDataSummaryTeknis($select="a.*",$id_permohonan_slf='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.id_permohonan_slf',$id_permohonan_slf);
		//$this->db->join('tm_slf_pengajuan c','a.id = c.id_permohonan_slf','LEFT');
		
		$this->db->join('tm_imb_penerbitan e','a.id_permohonan = e.id_permohonan','LEFT');
		
		$query 	= $this->db->get('tm_slf_permohonan a');
		return $query;
		
	}
	
	
	
	public function getDataTanah($select="a.*",$id_permohonan_slf='',$id='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.id_permohonan_slf',$id_permohonan_slf);
		if ($id != null || trim($id) != '')  $this->db->where('a.id',$id);
		$this->db->join('tr_provinsi b','a.id_provinsi = b.id_provinsi','LEFT');
		$this->db->join('tr_kabkot c','a.id_kabkot = c.id_kabkot','LEFT');
		$this->db->join('tr_kecamatan d','a.id_kecamatan = d.id_kecamatan','LEFT');
		$query 	= $this->db->get('tm_slf_tanah a');
		return $query;
	}
	//End Data Summary
	//Begin Verifikasi Berkas SLF DPMPTSP
	public function getDataPermohonan($select="a.*",$id_kabkota='')
	{
		$id_kabkota = $this->session->userdata('loc_id_kabkot');
		//$dev = $this->session->userdata('loc_role_id');
		//$id_kabkota = '';
		$this->db->select($select,FALSE);
		if ($id_kabkota != null || trim($id_kabkota) != '') 
		$this->db->where('a.id_kabkot_bg',$id_kabkota);
		//$this->db->where('a.status =','2');
		$this->db->where('a.status_pernyataan =','1');
		$this->db->join('tr_provinsi d','a.id_provinsi_bg = d.id_provinsi','LEFT');
		$this->db->join('tr_kabkot e','a.id_kabkot_bg = e.id_kabkot','LEFT');
		$this->db->join('tr_kecamatan f','a.id_kecamatan_bg = f.id_kecamatan','LEFT');
		$this->db->join('tr_slf_permohonan g','a.id_jenis_permohonan = g.id_jenis_permohonan','LEFT');
		$query 	= $this->db->get('tm_slf_permohonan a');
		return $query;
	}
	//End Verifikasi Berkas SLF DPMPTSP
	
	//Begin Validasi Penerbitan SLF
	public function getDataValidasi($select="a.*",$id_kabkota='')
	{
		$id_kabkota = $this->session->userdata('loc_id_kabkot');
		//$dev = $this->session->userdata('loc_role_id');
		$this->db->select($select,FALSE);
		if ($id_kabkota != null || trim($id_kabkota) != '') 
		$this->db->where('c.id_kabkot_bg',$id_kabkota);
		$this->db->where('a.status =','5');
		$this->db->join('tm_slf_pemilik b','a.id = b.id_permohonan_slf','LEFT');
		$this->db->join('tm_slf_bangunan c','a.id = c.id_permohonan_slf','LEFT');
		$this->db->join('tr_provinsi d','c.id_provinsi_bg = d.id_provinsi','LEFT');
		$this->db->join('tr_kabkot e','c.id_kabkot_bg = e.id_kabkot','LEFT');
		$this->db->join('tr_kecamatan f','c.id_kecamatan_bg = f.id_kecamatan','LEFT');
		$this->db->join('tr_slf_permohonan g','a.id_nama_permohonan = g.id_jenis_permohonan','LEFT');
		$query 	= $this->db->get('tm_slf_pengajuan a');
		return $query;
	}
	// End Validasi Penerbitan SLF
	// Begin Penyerahan Dokumen SLF
	public function getDataPenyerahan($select="a.*",$id_kabkota='')
	{
		$id_kabkota = $this->session->userdata('loc_id_kabkot');
		//$dev = $this->session->userdata('loc_role_id');
		$this->db->select($select,FALSE);
		if ($id_kabkota != null || trim($id_kabkota) != '') 
		$this->db->where('c.id_kabkot_bg',$id_kabkota);
		$this->db->where('a.status =','5');
		$this->db->join('tm_slf_pemilik b','a.id = b.id_permohonan_slf','LEFT');
		$this->db->join('tm_slf_bangunan c','a.id = c.id_permohonan_slf','LEFT');
		$this->db->join('tr_provinsi d','c.id_provinsi_bg = d.id_provinsi','LEFT');
		$this->db->join('tr_kabkot e','c.id_kabkot_bg = e.id_kabkot','LEFT');
		$this->db->join('tr_kecamatan f','c.id_kecamatan_bg = f.id_kecamatan','LEFT');
		$this->db->join('tr_slf_permohonan g','a.id_nama_permohonan = g.id_jenis_permohonan','LEFT');
		$query 	= $this->db->get('tm_slf_pengajuan a');
		return $query;
	}
	// End Penyerahan Dokumen SLF
	
	function get_permohonan($id=null,$cari=null)
	{
		$sql = "SELECT a.*, b.*
		FROM tm_slf_pengajuan a
		left join tr_slf_permohonan b on (a.id_nama_permohonan = b.id_jenis_permohonan)
		WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	
	
	public function getDataPemohon($select="a.*",$id_permohonan_slf='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.id_permohonan_slf',$id_permohonan_slf);
		$this->db->join('tr_provinsi b','a.id_provinsi = b.id_provinsi','LEFT');
		$this->db->join('tr_kabkot c','a.id_kabkot = c.id_kabkot','LEFT');
		$this->db->join('tr_kecamatan d','a.id_kecamatan = d.id_kecamatan','LEFT');
		$query 	= $this->db->get('tm_data_pemohon a');
		return $query;
	}
	
	//Begin Model Persyaratan
	public function getSlfAdministrasi($select="a.*",$id_permohonan_slf='',$verifikasi='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.pengajuan_id',$id_permohonan_slf);
		if ($verifikasi != null || trim($verifikasi) != '')  $this->db->where('a.verifikasi',$verifikasi);
		$query 	= $this->db->get('tm_slf_administrasi a');
		return $query;
	}
	
	public function getMasterSlfAdministrasi($select="a.*",$id_jenis_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id_jenis_permohonan',$id_jenis_permohonan);
		$this->db->where('a.id_jenis_persyaratan','1');
		$this->db->join('tr_slf_persyaratan_detail b','a.id_persyaratan = b.id_persyaratan','LEFT');
		$this->db->join('tr_slf_nama_persyaratan c','b.id_syarat = c.id_syarat','LEFT');
		$query 	= $this->db->get('tr_slf_persyaratan a');
		return $query;
	}
	
	public function getMasterTeknis($select="a.*",$id_nama_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($id_nama_permohonan != null || trim($id_nama_permohonan) != '')  
		$this->db->where('a.id_jenis_permohonan',$id_nama_permohonan);
		$this->db->where('a.id_jenis_persyaratan','2');
		$this->db->join('tr_slf_persyaratan_detail b','a.id_persyaratan = b.id_persyaratan','LEFT');
		$this->db->join('tr_slf_nama_persyaratan c','b.id_syarat = c.id_syarat','LEFT');
		$query 	= $this->db->get('tr_slf_persyaratan a');
		return $query;
	}
	
	public function getDataTeknis($select="a.*",$id_permohonan_slf='',$verifikasi='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.pengajuan_id',$id_permohonan_slf);
		if ($verifikasi != null || trim($verifikasi) != '')  $this->db->where('a.verifikasi',$verifikasi);
		$query 	= $this->db->get('tm_slf_teknis a');
		return $query;
	}
	
	public function saveStatusSLF($dataStatusnya){
		$this->db->insert('tm_slf_status', $dataStatusnya);
		return $this->db->insert_id();
	}
	
	function insert_log_slf($dataIn)
	{
		$this->db->insert('tm_slf_log',$dataIn);
		return $this->db->insert_id();
	}
	
	public function editStatus($id_permohonan){
		$data = array(
			"status" => $this->input->post('status_syarat'),
		);
		
		$this->db->where('id_permohonan_slf', $id_permohonan);
		$this->db->update('tm_slf_permohonan', $data); // Untuk mengeksekusi perintah update data
	}
	
	
	//End Model Persyaratan
	
	function get_syarat_list($per=null,$kls=null)
	{
		$sql = "SELECT a.id_persyaratan,a.id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,
				b.id_persyaratan_detail,b.id_syarat,c.nama_syarat
				FROM tr_slf_persyaratan a 
					LEFT JOIN tr_slf_persyaratan_detail b ON(a.id_persyaratan=b.id_persyaratan)
					LEFT JOIN tr_slf_nama_persyaratan c ON(b.id_syarat=c.id_syarat)
				WHERE (1=1)";
		if ($per != null || trim($per) != '')  $sql .= " AND a.id_jenis_permohonan = '$per' ";
		if ($kls != null || trim($kls) != '')  $sql .= " AND a.id_jenis_persyaratan = '$kls' ";
		
		
		$sql .= " Group by b.id_persyaratan_detail ORDER BY a.id_jenis_permohonan, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat ASC ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	/*public function getMasterTeknis($select="a.*",$id_nama_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($id_nama_permohonan != null || trim($id_nama_permohonan) != '')  $this->db->where('a.id_jenis_permohonan',$id_nama_permohonan);
		$this->db->where('a.id_jenis_persyaratan','2');
		$this->db->join('tr_persyaratan_slf2_detail b','a.id_persyaratan = b.id_persyaratan','LEFT');
		$this->db->join('tr_syarat_slf c','b.id_syarat_slf = c.id_syarat_slf','LEFT');
		$query 	= $this->db->get('tr_persyaratan_slf a');
		return $query;
		//echo $this->db->last_query(); die;
	}*/
	
	public function getDataPemeberitahuanKelengkapan($select="a.*",$id_permohonan_slf='',$id='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.id_permohonan_slf',$id_permohonan_slf);
		if ($id != null || trim($id) != '')  $this->db->where('a.id',$id);
		$query 	= $this->db->get('tm_data_pemberitahuan_kelengkapan a');
		return $query;
	}
	
	//End Verifikasi Berkas SLF
	
	//Pemeriksaan Berkas
	public function getDataPemeriksaanDokumen($select="a.*",$id_kabkota='')
	{
		
		$id_kabkota = $this->session->userdata('loc_id_kabkot');
		$this->db->select($select,FALSE);
		if ($id_kabkota != null || trim($id_kabkota) != '') 
		$this->db->where('a.id_kabkot_bg',$id_kabkota);
	
		//$this->db->where('a.code_pengajuan','2');
		$this->db->where('a.status_progress >=','5');
		//$this->db->where('a.status !=','7');
		
		$this->db->join('tr_provinsi d','a.id_provinsi_bg = d.id_provinsi','LEFT');
		$this->db->join('tr_kabkot e','a.id_kabkot_bg = e.id_kabkot','LEFT');
		$this->db->join('tr_kecamatan f','a.id_kecamatan_bg = f.id_kecamatan','LEFT');
		$this->db->join('tr_slf_permohonan g','a.id_jenis_permohonan = g.id_jenis_permohonan','LEFT');
		$query 	= $this->db->get('tm_slf_permohonan a');
		return $query;
	}
	
	public function getDataKesesuaian($select="a.*",$id_permohonan_slf='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.id_permohonan_slf',$id_permohonan_slf);
		$query 	= $this->db->get('tm_pemeriksaan_kesesuaian a');
		return $query;
		
	}
	public function getDataPenyerahanSLF($select="a.*",$id_permohonan_slf='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.id_permohonan_slf',$id_permohonan_slf);
		$query 	= $this->db->get('tm_penyerahan_slf a');
		return $query;
	}
	
	public function getDataPengesahan($select="a.*",$id_permohonan_slf='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.id_permohonan_slf',$id_permohonan_slf);
		$this->db->join('tm_pengesahan_slf b','a.id_permohonan_slf = b.id_permohonan_slf','LEFT');
		$query 	= $this->db->get('tm_pemeriksaan_kebenaran a');
		return $query; 
	}
	
	public function getDataKebenaran($select="a.*",$id_permohonan_slf='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.id_permohonan_slf',$id_permohonan_slf);
		$query 	= $this->db->get('tm_pemeriksaan_kebenaran a');
		return $query;
		
	}
	
	public function get_penilaian_teknis($id_persyaratan_detail=null,$id_permohonan_slf=null)
	{
		$sql = "SELECT a.*
				FROM tm_slf_penilaian_teknis  a 
				WHERE (1=1)";
		if ($id_persyaratan_detail != null || trim($id_persyaratan_detail) != '')  $sql .= " AND a.id_persyaratan_detail = '$id_persyaratan_detail' ";
		if ($id_permohonan_slf != null || trim(id_permohonan_slf) != '')  $sql .= " AND a.id_permohonan_slf = '$id_permohonan_slf' ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	//End Pemeriksaan Berkas
	
	
	//Rekomedasi Tim Teknis
	public function getDataRekomendasi($select="a.*",$id_kabkota='')
	{
		$this->db->select($select,FALSE);
		if ($id_kabkota != null || trim($id_kabkota) != '')  $this->db->where('c.id_kabkot',$id_kabkota);
		$this->db->where('a.code_pengajuan','2');
		$this->db->where('a.status >=','4');
		$this->db->join('tm_data_pemohon b','a.id = b.id_permohonan_slf','LEFT');
		$this->db->join('tm_bangunan_slf c','a.id = c.id_permohonan_slf','LEFT');
		$this->db->join('tr_provinsi d','c.id_provinsi = d.id_provinsi','LEFT');
		$this->db->join('tr_kabkot e','c.id_kabkot = e.id_kabkot','LEFT');
		$this->db->join('tr_kecamatan f','c.id_kecamatan = f.id_kecamatan','LEFT');
		$this->db->join('tr_permohonan_slf g','a.id_nama_permohonan = g.id_jenis_permohonan','LEFT');
		$query 	= $this->db->get('tm_pengajuan_permohonan a');
		return $query;
	}
	
	public function getDataRekomendasiAll($select="a.*",$id_permohonan_slf='',$id='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.id_permohonan_slf',$id_permohonan_slf);
		if ($id != null || trim($id) != '')  $this->db->where('a.id',$id);
		$query 	= $this->db->get('tm_rekomendasi_teknis a');
		return $query;
		//echo $this->db->last_query();
	}
	
	//End Rekomendasi Tim Teknis
	
	//Penerbitan SLF
	/*public function getDataPenerbitan($select="a.*",$id_kabkota='')
	{
		$this->db->select($select,FALSE);
		if ($id_kabkota != null || trim($id_kabkota) != '')  $this->db->where('c.id_kabkot',$id_kabkota);
		$this->db->where('a.code_pengajuan','2');
		$this->db->where('a.status','5')->or_where('a.status','88');
		$this->db->join('tm_data_pemohon b','a.id = b.id_permohonan_slf','LEFT');
		$this->db->join('tm_bangunan_slf c','a.id = c.id_permohonan_slf','LEFT');
		$this->db->join('tr_provinsi d','c.id_provinsi = d.id_provinsi','LEFT');
		$this->db->join('tr_kabkot e','c.id_kabkot = e.id_kabkot','LEFT');
		$this->db->join('tr_kecamatan f','c.id_kecamatan = f.id_kecamatan','LEFT');
		$this->db->join('tr_permohonan_slf g','a.id_nama_permohonan = g.id_jenis_permohonan','LEFT');
		$this->db->join('tm_penerbitan_slf h','a.id = h.id_permohonan_slf','LEFT');
		$query 	= $this->db->get('tm_pengajuan_permohonan a');
		return $query;
	}*/
	//End Penerbitan SLF

	
	function get_permohonan_bangunan($id=null)
	{
		$sql = "SELECT a.*, b.id_klasifikasi_bg
		FROM tm_bangunan_slf a
		left join tr_permohonan_slf b on (a.id_jenis_slf = b.id_jenis_permohonan)
		WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_jenis_slf = '$id' ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	public function getDataBeritaAcara($select="a.*",$id_permohonan_slf='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.id_permohonan_slf',$id_permohonan_slf);
		$query 	= $this->db->get('tm_berita_acara a');
		return $query;
	}
	
	//Penerbitan(Rekomendasi) SLF
	//Penerbitan Berkas SLF
	public function getDataPenerbitanSLF($select="a.*",$id_kabkota='')
	{
		$id_kabkota = $this->session->userdata('loc_id_kabkot');
		$this->db->select($select,FALSE);
		if ($id_kabkota != null || trim($id_kabkota) != '')  $this->db->where('a.id_kabkot_bg',$id_kabkota);
		$this->db->where('a.status_progress !=','19');
		$this->db->where('a.status >=','6');
		
		$this->db->join('tr_provinsi d','a.id_provinsi_bg = d.id_provinsi','LEFT');
		$this->db->join('tr_kabkot e','a.id_kabkot_bg = e.id_kabkot','LEFT');
		$this->db->join('tr_kecamatan f','a.id_kecamatan_bg = f.id_kecamatan','LEFT');
		$this->db->join('tr_slf_permohonan g','a.id_jenis_permohonan = g.id_jenis_permohonan','LEFT');
		$this->db->join('tm_slf_pengesahan i','a.id_permohonan_slf = i.id_permohonan_slf','LEFT');
		$query 	= $this->db->get('tm_slf_permohonan a');
		return $query;
	}
	
	
	
	
	
	function get_sk_slf_akhir($id_kabkot,$tgl_skrg,$id_kecamatan_bg)
	{
			$sql = "SELECT max(a.no_slf) as no_registrasi_baru, a.id_permohonan_slf,b.id_kabkot_bg,b.id_kecamatan_bg
						FROM tm_slf_pengesahan a
						LEFT JOIN tm_slf_permohonan b On a.id_permohonan_slf=b.id_permohonan_slf
						WHERE 1=1";
			if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND b.id_kabkot_bg = '$id_kabkot' ";
			if ($tgl_skrg != null || trim($tgl_skrg) != '')  $sql .= " AND a.tgl_terbit_slf = '$tgl_skrg' ";
			if ($id_kecamatan_bg != null || trim($id_kecamatan_bg) != '')  $sql .= " AND b.id_kecamatan_bg = '$id_kecamatan_bg' ";
			$hasil = $this->db->query($sql)->row_array();
			
			return $hasil;
	}
	//awal penerbitan
	function sk_slf($id)
	{
		$sql = "SELECT a.id,a.no_slf
							FROM tm_slf_pengesahan a
							WHERE 1=1";
			if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
			$hasil = $this->db->query($sql)->row_array();
			
			return $hasil;
	}
	
	public function info_kabkot($id)
	{
		$this->db->select('a.id_permohonan_slf, a.id_kabkot_bg, c.nama_kabkota, d.dir_file_logo',FALSE);
		$this->db->where('a.id_permohonan_slf',$id);
		//$this->db->join('tm_slf_bangunan b','a.id = b.id_permohonan_slf','LEFT');
		$this->db->join('tr_kabkot c','a.id_kabkot_bg = c.id_kabkot','LEFT');
		$this->db->join('tm_profile_dinas d','c.id_kabkot = d.id_kabkot','LEFT');
		$query 	= $this->db->get('tm_slf_permohonan a');
		return $query;
	}
	
	public function getDataPenerbitan($id)
	{
		$this->db->select('a.*,
							d.nama_provinsi,
							e.nama_kabkota,
							f.nama_kecamatan,
							g.no_slf,g.tgl_terbit_slf,ttd_pejabat_sk,nip_pejabat_sk,
							i.p_alamat
							',FALSE);
		$this->db->where('a.id_permohonan_slf =',$id);
		//$this->db->join('tm_slf_pemilik b','a.id = b.id_permohonan_slf','LEFT');
		//$this->db->join('tm_slf_bangunan c','a.id = c.id_permohonan_slf','LEFT');
		$this->db->join('tr_provinsi d','a.id_provinsi_bg = d.id_provinsi','LEFT');
		$this->db->join('tr_kabkot e','a.id_kabkot_bg = e.id_kabkot','LEFT');
		$this->db->join('tr_kecamatan f','a.id_kecamatan_bg = f.id_kecamatan','LEFT');
		$this->db->join('tm_slf_pengesahan g','a.id_permohonan_slf = g.id_permohonan_slf','LEFT');
		//$this->db->join('tm_profile_dinas h','a.id_kabkot_bg = h.id_kabkot','LEFT');
		$this->db->join('tm_profile_dinas i','a.id_kabkot_bg = i.id_kabkot','LEFT');
		$query 	= $this->db->get('tm_slf_permohonan a');
		return $query;
	}
	//akhie penerbitan
	
	function get_id_kabkot_bg($id=null)
	{
		$sql = "SELECT a.id_permohonan_slf,a.id_kabkot_bg,a.id_kecamatan_bg,c.kepala_dinas,c.nip_kepala_dinas
					FROM tm_slf_permohonan a
					
					LEFT JOIN tm_profile_teknis c ON (a.id_kabkot_bg = c.id_kabkot)
				WHERE 1=1";
			if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan_slf = '$id' ";
			$hasil = $this->db->query($sql)->row_array();
			return $hasil;
	}
	
	//Begin Get Data Untuk Kirim Email
	public function getDataStatusVerifikasi($id_permohonan_slf=null)
	{
		$sql = "SELECT 	a.id,a.no_registrasi,a.status,a.status_data_administrasi,a.status_data_teknis,
				b.id_permohonan_slf,b.email ";
		$sql .= "FROM tm_pengajuan_permohonan a 
				LEFT JOIN tm_data_pemohon_slf b On(a.id=b.id_permohonan_slf)
				WHERE (1=1) AND a.status='2'  ";
				
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $sql .= " AND b.id_permohonan_slf = '$id_permohonan_slf' ";
		$sql .= " ORDER BY b.id_permohonan_slf ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil ;
	}
	//End Get Data Untuk Kirim Email
	
	//Get Jenis Permohonan
	function getJenisPermohonanSlf($id=null,$cari=null)
	{
		$sql = "SELECT b.*
		FROM tr_permohonan_slf b
		WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND b.id_permohonan = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_id_kabkot($id)
	{
		$sql = "SELECT id_permohonan_slf, id_kabkot_bg, id_kecamatan_bg 
			FROM tm_bangunan_slf where id_permohonan_slf =".$id;
		$hasil = $this->db->query($sql)->row_array();
		return $hasil;
	}
	
	function get_nomor_slf($id_kabkot_bg,$tgl_skrg)
	{
		$sql = "SELECT max(no_slf) as no_urut 
		FROM tm_pengesahan_slf WHERE SUBSTR(no_slf,8,4) = '$id_kabkot_bg'
		and SUBSTR(no_slf,15,8) = '$tgl_skrg'";
		$hasil = $this->db->query($sql)->row_array();
		return $hasil;
	}
	
	//Penilaian Tim teknis
	public function insert_data_penilaian($data)
	{
		$this->db->insert('tm_slf_penilaian_teknis',$data);
	}
	
	public function update_data_penilaian($dataIn,$id)
	{	$this->db->where('id_penilaian', $id);
	
		$this->db->update('tm_slf_penilaian_teknis',$dataIn);
	}
	
	public function updatePermohonan($dataIn,$id)
	{	$this->db->where('id_permohonan_slf', $id);
		$this->db->update('tm_slf_permohonan',$dataIn);
	}
	
	function get_permohonan_slf($id=null,$cari=null)
	{
		$sql = "SELECT a.*, b.*
		FROM tm_slf_permohonan a
		left join tr_slf_permohonan b on (a.id_jenis_permohonan = b.id_jenis_permohonan)
		WHERE (1=1) ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan_slf = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function update_data_permohonan($dataIn,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tm_pengajuan_permohonan',$dataIn);
	}
	
	function insert_penyerahan_slf($dataIn)
	{
		$this->db->insert('tm_penyerahan_slf',$dataIn);
	}
	
	public function getDataSummaryPenyerahan($select="a.*",$id_permohonan_slf='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.id',$id_permohonan_slf);
		$this->db->join('tm_pemilik_slf d','a.id = d.id_permohonan_slf','LEFT');
		$this->db->join('tr_permohonan_slf e','a.id_nama_permohonan = e.id_jenis_permohonan','LEFT');
		$this->db->join('tm_bangunan_slf f','a.id = f.id_permohonan_slf','LEFT');
		$this->db->join('tr_kecamatan g','f.id_kecamatan_bg = g.id_kecamatan','LEFT');
		$this->db->join('tr_kabkot h','f.id_kabkot_bg = h.id_kabkot','LEFT');
		$this->db->join('tr_provinsi i','f.id_provinsi_bg = i.id_provinsi','LEFT');
		$this->db->join('tm_pengesahan_slf j','a.id = j.id_permohonan_slf','LEFT');
		$query 	= $this->db->get('tm_pengajuan_permohonan a');
		return $query;
	}
	//End Data Summary
	
	function getStatus($id_permohonan_slf=null,$id_kelengkapan_syarat=null)
	{
		$sql = "SELECT a.*,c.email ";
		$sql .= " FROM tm_data_pemberitahuan_kelengkapan a
					LEFT JOIN tm_pengajuan_permohonan b On(a.id_permohonan_slf=b.id)
					LEFT JOIN tm_data_pemohon_simbg c On(b.user_id=c.id_permohonan_slf)
				WHERE (1=1)  ";

		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $sql .= " AND a.id_permohonan_slf = '$id_permohonan_slf' ";
		if ($id_kelengkapan_syarat != null || trim($id_kelengkapan_syarat) != '')  $sql .= " AND a.id_kelengkapan_syarat = '$id_kelengkapan_syarat' ";
		$sql .= " ORDER BY a.id_permohonan_slf ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil ;
	}
	
	//UpdatedataProgress
	function updateProgress($dataProgress,$id_permohonan_slf)
	{
		$this->db->where('id_permohonan_slf', $id_permohonan_slf);
		$this->db->update('tm_slf_permohonan',$dataProgress);
		$updated_status = $this->db->affected_rows();
	}
	//
	
	function getSLFkasie()
	{
		$tot = $this->session->userdata('loc_id_kabkot');
		$dev = $this->session->userdata('loc_role_id');
		$this->db->select('*'); //memeilih semua field
		$this->db->from('tm_slf_permohonan'); //memeilih tabel
		
		$this->db->where('status_progress >= 2');
		if ($dev != 1)  $this->db->where('id_kabkot_bg',$tot);
		$this->db->join('tr_slf_permohonan', 'tm_slf_permohonan.id_jenis_permohonan = tr_slf_permohonan.id_jenis_permohonan'); 
		$this->db->order_by('tm_slf_permohonan.id_permohonan_slf','desc');
		$query = $this->db->get(); //simpan database yang udah di get alias ambil ke query
		return $query; //hasil dari semua proses ada dimari
	}
	
	public function getTerbitSLF($select="*",$id_permohonan_slf){
		$this->db->select($select,FALSE);
		$this->db->where('a.id_permohonan_slf',$id_permohonan_slf);
		$query 	= $this->db->get('tm_slf_permohonan a')->row();
		return $query;
	}
	
	function insert_penyerahan($data_terbit)
	{
		$this->db->insert('tm_slf_penyerahan2',$data_terbit);
		return $this->db->insert_id();
	}
	
	function get_jenis_fungsi_list($id=null,$fungsi_bg=null,$id_pemanfaatan_bg=null)
	{
		if ($id != null || trim($id) != '')
			$this->db->where('id_fungsi_bg',$id);
		if ($fungsi_bg != null || trim($fungsi_bg) != '')
			$this->db->like('fungsi_bg',$fungsi_bg,'both');
		if ($id_pemanfaatan_bg != null || trim($id_pemanfaatan_bg) != '')
			$this->db->where('id_pemanfaatan_bg',$id_pemanfaatan_bg);

		$this->db->order_by('id_fungsi_bg','asc');
		$hasil =  $this->db->get('tr_fungsi_bg');
		return $hasil;
	}
	public function getDataUserSLF($select="a.*",$id_permohonan_slf='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.id_permohonan_slf',$id_permohonan_slf);
		$query 	= $this->db->get('tm_slf_permohonan a')->row();
		return $query;

	}
}
 
