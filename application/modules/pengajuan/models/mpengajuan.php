<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpengajuan extends CI_Model{
	
	public function getDataUserProfile($select="a.*",$user_id='')
	{
		$this->db->select($select,FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.user_id',$user_id);
		$query 	= $this->db->get('tm_user_data a')->row();
		return $query;

	}
	
	public function getDataUserIMB($select="a.*",$id_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan',$id_permohonan);
		$this->db->join('tm_imb_kolektif b','a.id_permohonan = b.id_permohonan','LEFT');
		//$this->db->join('tr_protipe c','a.idp = c.idp','LEFT');
		$query 	= $this->db->get('tm_imb_permohonan a')->row();
		return $query;

	}

	//Begin Dashboard List Pengajuan Permohonan
	public function getDataUserPemohon($select="a.*",$user_id='')
	{
		$this->db->select($select,FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.id',$user_id);
		$this->db->join('tm_user_data b','a.id = b.user_id','LEFT');
		//$this->db->join('tr_provinsi d','a.id_provinsi = d.id_provinsi','LEFT');
		$query 	= $this->db->get('tm_user a')->row();
		return $query;
	}
	
	public function removeDataPermohonan($id_permohonan)
	{
		$this->db->query("DELETE FROM tm_imb_permohonan WHERE id_permohonan = $id_permohonan");
		$this->db->query("DELETE FROM tm_imb_tanah WHERE id_permohonan = $id_permohonan");
		$this->db->query("DELETE FROM tm_permohonan_bg_syarat WHERE id_permohonan = $id_permohonan");
		$this->db->query("DELETE FROM tm_imb_penjadwalan WHERE id_permohonan = $id_permohonan");
		$this->db->query("DELETE FROM tm_imb_penugasan WHERE id_permohonan = $id_permohonan");
		$this->db->query("DELETE FROM tm_imb_penyerahan WHERE id_permohonan = $id_permohonan");
		$this->db->query("DELETE FROM tm_permohonan_bg_syarat WHERE id_permohonan = $id_permohonan");
		$this->db->where('id_permohonan',$id_permohonan);
		//$query = $this->db->delete('tm_imb_permohonan');
		//return $query;
	}
	
	public function getJumIMB($user_id=null)
	{
		$sql = "SELECT a.id_jenis_permohonan,
				SUM(CASE  when (a.status is not null) then 1 else 0 END ) AS Pengajuan_IMB,
				SUM(CASE  when (a.status ='13') then 1 else 0 END ) AS IMB_terbit,
				SUM(CASE  when (a.status ='9') then 1 else 0 END ) AS IMB_ditolak
				FROM tm_imb_permohonan a
				Where(a.id_user)
			GROUP BY a.id_user";
		if ($user_id != null || trim($user_id) != '')  $sql .= " AND a.id_user = '$user_id' ";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}
	
	public function getJumSLF($select="a.*",$user_id=null)
	{
		$this->db->select($select,FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.user_id',$user_id);
		$query 	= $this->db->get('tm_slf_pengajuan a')->row();
		return $query;
	}
	
	//End Dashboard List Pengajuan Permohonan
	
	public function getDataPengajuan($select="a.*",$user_id='',$id_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan',$id_permohonan);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.id_user',$user_id);
		$this->db->join('tr_provinsi d','a.id_provinsi = d.id_provinsi','LEFT');
		$this->db->join('tr_kabkot e','a.id_kabkot = e.id_kabkot','LEFT');
		$this->db->join('tr_kecamatan f','a.id_kecamatan = f.id_kecamatan','LEFT');
		$this->db->join('tr_imb_permohonan j','a.id_jenis_permohonan = j.id_jenis_permohonan','LEFT');
		$query 	= $this->db->get('tm_imb_permohonan a');
		return $query;
	}
	
	public function getAllDataPermohonan($select="a.*",$user_id='',$id_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.id_user',$user_id);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan',$id_permohonan);
		$this->db->join('tr_imb_permohonan b','a.id_jenis_permohonan = b.id_jenis_permohonan','LEFT');
		$this->db->order_by('a.id_permohonan','desc');
		$query 	= $this->db->get('tm_imb_permohonan a');
		return $query;
	}
	
	public function getAllDataPermohonanSLF($select="a.*",$user_id='',$id='')
	{
		$this->db->select($select,FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.user_id',$user_id);
		if ($id != null || trim($id) != '')  $this->db->where('a.id',$id);
		$this->db->join('tr_slf_permohonan b','b.id_jenis_permohonan = a.id_nama_permohonan','LEFT');
		$this->db->join('tm_slf_bangunan c','c.pengajuan_id = a.id','LEFT');
		$query 	= $this->db->get('tm_slf_pengajuan a');
		return $query;
	}
	
	public function getDataCatatan($select="a.*",$id_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan',$id_permohonan);
		$query 	= $this->db->get('tm_status_permohonan a');
		return $query;
	}
	
	public function removeData($id)
	{
		$this->db->query("DELETE FROM tm_imb_tanah WHERE id_permohonan_detail_tanah = $id");
		$this->db->where('id_permohonan_detail_tanah',$id);
		$query = $this->db->delete('tm_imb_tanah');
		return $query;
	}
	
	
	public function getDataPemohon($select="a.*",$pengajuan_id='')
	{
		$this->db->select($select,FALSE);
		if ($pengajuan_id != null || trim($pengajuan_id) != '')  $this->db->where('a.pengajuan_id',$pengajuan_id);
		$query 	= $this->db->get('tm_data_pemohon a')->row();
		return $query;
	}
	
	public function getDataPemilik($select="a.*",$pengajuan_id='')
	{
		$this->db->select($select,FALSE);
		if ($pengajuan_id != null || trim($pengajuan_id) != '')  $this->db->where('a.pengajuan_id',$pengajuan_id);
		$query 	= $this->db->get('tm_data_pemilik a')->row();
		return $query;
	}
	
	public function getDataJenisPermohonan($select="a.*",$pengajuan_id='')
	{
		$this->db->select($select,FALSE);
		if ($pengajuan_id != null || trim($pengajuan_id) != '')  $this->db->where('a.pengajuan_id',$pengajuan_id);
		$query 	= $this->db->get('tm_data_jenis_permohonan a')->row();
		return $query;
	}
	
	public function getDataBg($select="a.*",$pengajuan_id='')
	{
		$this->db->select($select,FALSE);
		if ($pengajuan_id != null || trim($pengajuan_id) != '')  $this->db->where('a.pengajuan_id',$pengajuan_id);
		$query 	= $this->db->get('tm_data_bg_permohonan a')->row();
		return $query;
	}
	
	public function getNamaPermohonan_list($select="a.*",$kompleksitas='',$id_klasifikasi_bg='',$id_jenis_permohonan='',$id_dok_tek='')
	{
		$this->db->select($select,FALSE);
		if ($kompleksitas != null || trim($kompleksitas) != '')  $this->db->where('a.id_klasifikasi_bg',$kompleksitas);
		if ($id_klasifikasi_bg != null || trim($id_klasifikasi_bg) != '')  $this->db->where('a.id_pemanfaatan_bg',$id_klasifikasi_bg);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id_jenis_bg',$id_jenis_permohonan);
		if ($id_dok_tek != null || trim($id_dok_tek) != '')  $this->db->where('a.id_dok_tek',$id_dok_tek);
		$this->db->limit(1);
		$query 	= $this->db->get('tr_nama_permohonan a');
		return $query;
	}
	
	public function getDataPermohonan($select="*",$id_permohonan)
	{
		$this->db->select($select,FALSE);
		$this->db->where('a.id_permohonan',$id_permohonan);
		$this->db->join('tr_provinsi b','b.id_provinsi = a.id_provinsi_bg','LEFT');
		$this->db->join('tr_kabkot c','c.id_kabkot = a.id_kabkot_bg','LEFT');
		$this->db->join('tr_kecamatan d','d.id_kecamatan = a.id_kec_bg','LEFT');
		$this->db->join('tr_ssrd e','e.id_permohonan = a.id_permohonan','LEFT');
		$this->db->join('tr_skrd f','f.id_permohonan = a.id_permohonan','LEFT');
		$this->db->join('tm_penetapan_retribusi g','g.id_permohonan = a.id_permohonan','LEFT');
		$query 	= $this->db->get('tm_imb_permohonan a')->row();
		return $query;
	}
	
	public function getDataNonPemohon($select="*",$id_permohonan)
	{
		$this->db->select($select,FALSE);
		$this->db->where('a.id_permohonan',$id_permohonan);
		$this->db->join('tr_provinsi b','b.id_provinsi = a.id_provinsi_bg','LEFT');
		$this->db->join('tr_kabkot c','c.id_kabkot = a.id_kabkot_bg','LEFT');
		$this->db->join('tr_kecamatan d','d.id_kecamatan = a.id_kec_bg','LEFT');
		$this->db->join('tm_data_pemohon_simbg e','e.pengajuan_id = a.id_user','LEFT');
		$query 	= $this->db->get('tm_imb_permohonan a')->row();
		return $query;
	}
	
	public function getDataEditProvinsi($select="*",$id_provinsi){
		$this->db->select($select,FALSE);
		$this->db->where('a.id_provinsi',$id_provinsi);
		$query 	= $this->db->get('tr_provinsi a')->row();
		return $query;
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
	
	public function getDataTanah($select="a.*",$id_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan',$id_permohonan);
		$query 	= $this->db->get('tm_imb_tanah a');
		return $query;
	}
	
	public function getDataEditTanah($select="*",$id_permohonan_detail_tanah)
	{
		$this->db->select($select,FALSE);
		$this->db->where('a.id_permohonan_detail_tanah',$id_permohonan_detail_tanah);
		$query 	= $this->db->get('tm_imb_tanah a')->row();
		return $query;
	}
	
	public function getTabelPersyaratanAdmSkip($id_nama_permohonan='')
	{
		$this->db->select('a.id,a.id_dokumen_permohonan,b.nama_dokumen_permohonan');
		$this->db->where('a.id_nama_permohonan',$id_nama_permohonan);
		$this->db->where('b.status','1');
		$this->db->where('b.id_jenis_dok_permohonan','1');
		$this->db->join('tr_dokumen_permohonan b','a.id_dokumen_permohonan = b.id','LEFT');
		$this->db->order_by('a.id_dokumen_permohonan','asc');
		$query_data	= $this->db->get('tr_persyaratan_permohonan a');
		return $query_data;
	
	}
	
	public function GetDataAdmSelectedSkip($pengajuan_id='')
	{
		$this->db->select('id,id_dokumen_permohonan,dir_file,verifikasi');
		$this->db->where('pengajuan_id',$pengajuan_id);
		$query_data_selected	= $this->db->get('tm_data_administrasi');
		return $query_data_selected;
	}
	
	//Begin Model Data IMB
	function getPermohonan($id=null,$cari=null)
	{
		$sql = "SELECT b.*
		FROM tr_imb_permohonan b
		WHERE (1=1)  And b.status ='1'";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	public function getDataImb($select="a.*",$id_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan',$id_permohonan);
		$query 	= $this->db->get('tm_imb_permohonan a');
		return $query;
	}	
	
	public function getDataAdministrasi($select="a.*",$id_permohonan='',$status='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan',$id_permohonan);
		if ($status != null || trim($status) != '')  $this->db->where('a.status',$status);
		$query 	= $this->db->get('tm_permohonan_bg_syarat a');
		return $query;
	}
	
	public function getMasterAdministrasi($select="a.*",$id_jenis_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id_jenis_permohonan',$id_jenis_permohonan);
		$this->db->where('a.id_jenis_persyaratan','1');
		$this->db->where('c.status','1');
		$this->db->join('tr_imb_persyaratan_detail b','a.id_persyaratan = b.id_persyaratan','LEFT');
		$this->db->join('tr_imb_syarat c','b.id_syarat = c.id_syarat','LEFT');
		$query 	= $this->db->get('tr_imb_persyaratan a');
		return $query;
	}
	
	public function getDataTeknis($select="a.*",$id_permohonan='',$status='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan',$id_permohonan);
		if ($status != null || trim($status) != '')  $this->db->where('a.status',$status);
		$query 	= $this->db->get('tm_permohonan_bg_syarat a');
		return $query;
	}
	
	public function getMasterTeknis($select="a.*",$id_jenis_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id_jenis_permohonan',$id_jenis_permohonan);
		$this->db->where('a.id_jenis_persyaratan','2');
		$this->db->where('c.status','1');
		$this->db->join('tr_imb_persyaratan_detail b','a.id_persyaratan = b.id_persyaratan','LEFT');
		$this->db->join('tr_imb_syarat c','b.id_syarat = c.id_syarat','LEFT');
		$query 	= $this->db->get('tr_imb_persyaratan a');
		return $query;
	}
	
	public function getSummaryImb($select="*",$id_permohonan)
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan != null || trim($id_permohonan) != '')  
		$this->db->where('a.id_permohonan',$id_permohonan);
		$this->db->join('tr_imb_permohonan b','a.id_jenis_permohonan = b.id_jenis_permohonan','LEFT');
		$this->db->join('tr_kecamatan c','a.id_kecamatan = c.id_kecamatan','LEFT');
		$this->db->join('tr_kabkot d','a.id_kabkot = d.id_kabkot','LEFT');
		$this->db->join('tr_provinsi e','a.id_provinsi = e.id_provinsi','LEFT');
		$this->db->join('tr_kecamatan f','a.id_kec_bg = f.id_kecamatan','LEFT');
		$this->db->join('tr_kabkot g','a.id_kabkot_bg = g.id_kabkot','LEFT');
		$this->db->join('tr_provinsi h','a.id_provinsi_bg = h.id_provinsi','LEFT');
		$this->db->join('tr_fungsi_bg i','a.id_fungsi_bg = i.id_fungsi_bg','LEFT');
		$this->db->join('tm_imb_kolektif k','a.id_permohonan = k.id_permohonan','LEFT');
		$query 	= $this->db->get('tm_imb_permohonan a');
		return $query->row();
	}
	
	function get_syarat2($id=null,$per=null,$status=null)
	{
		$sql = "SELECT a.*
				FROM tm_permohonan_bg_syarat a
				WHERE (1=1) ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_persyaratan_detail = '$id' ";
		if ($per != null || trim($per) != '')  $sql .= " AND a.id_permohonan = '$per' ";
		if ($status != null || trim($status) != '')  $sql .= " AND a.status = '$status' ";
		$sql .= " ORDER BY a.id_persyaratan ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_syarat($id=null,$per=null,$status=null)
	{
		$sql = "SELECT a.*
				FROM tm_permohonan_bg_syarat a
				WHERE (1=1) ";

		if ($id != null || trim($id) != '')  $sql .= " AND a.id_persyaratan_detail = '$id' ";
		if ($per != null || trim($per) != '')  $sql .= " AND a.id_permohonan = '$per' ";
		if ($status != null || trim($status) != '')  $sql .= " AND a.status = '$status' ";
		$sql .= " ORDER BY a.id_persyaratan ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function RemoveAdministrasi($id_permohonan_bg_syarat)
	{
		$this->db->delete('tm_permohonan_bg_syarat',array('id_perhomonan_bg_syarat'=>$id_permohonan_bg_syarat));
	}
	
	function getSyaratListTidakSesuai($id_permohonan=null)
	{
		$sql = "SELECT a.*,c.id_syarat,d.nama_syarat,e.id_detail_jenis_persyaratan
				FROM tm_penilaian_teknis  a
				LEFT JOIN tm_imb_permohonan b ON(a.id_permohonan=b.id_permohonan)
				LEFT JOIN tr_imb_persyaratan_detail c ON(a.id_persyaratan_detail=c.id_persyaratan_detail)
				LEFT JOIN tr_imb_syarat d ON(c.id_syarat=d.id_syarat)
				LEFT JOIN tr_imb_persyaratan e ON(e.id_persyaratan=c.id_persyaratan)
				WHERE (1=1) AND a.kesesuaian = '2' ";
		if ($id_permohonan != null || trim($id_permohonan) != '')  $sql .= " AND a.id_permohonan = '$id_permohonan' ";
		$sql .= " ORDER BY e.id_detail_jenis_persyaratan ASC ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function getDataRetribusi($select="a.*",$id_permohonan=null)
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan',$id_permohonan);
		$query 	= $this->db->get('tr_ssrd a');
		return $query;
	}
	
	function updateDataPenilaian($dataIn,$id)
	{
		$this->db->where('id_penilaian', $id);
		$this->db->update('tm_penilaian_teknis',$dataIn);
	}
	
	function deleteFileRevisi($dataRT,$id_penilaian)
	{	
		$this->db->where('id_penilaian', $id_penilaian);
		$this->db->update('tm_penilaian_teknis',$dataRT);
		
	}
	
	function get_file_ssrd($id)
	{
		return $this->db->select()->from('tm_penilaian_teknis')->where(array('id_penilaian'=>$id))->get()->row();
	
		//return $this->db->select()->from('tm_imb_penilaian_teknis')->where('id_penilaian', $file_id)->get()->row();
	}
	
	public function saveRetribusi(){
		$data = array(
			"id_ssrd" => $this->input->post('id_ssrd'),
			"id_permohonan" => $this->input->post('id_permohonan'),
			"no_ssrd" => $this->input->post('no_ssrd'),
			//"no_surat_pemberitahuan" => $this->input->post('no_surat_pemberitahuan'),
			"file_ssrd" => $this->input->post('file_ssrd'),
			"tgl_ssrd" => date('Y-m-d'),
			"post_date" => date('Y-m-d'),
			"last_update" => date('Y-m-d H:i:s'),
			"post_by" => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
		);
		$this->db->insert('tr_ssrd', $data); // Untuk mengeksekusi perintah insert data
	}
	// End Model Data IMB
	
	// BeginModel Data SLF 
	public function getSLFDataPermohonan($select="*",$id)
	{
		$this->db->select($select,FALSE);
		$this->db->where('a.id',$id);
		$this->db->join('tm_slf_pemilik b','b.pengajuan_id = a.id');
		$this->db->join('tm_slf_bangunan c','c.pengajuan_id = a.id');
		$this->db->join('tm_slf_permohonan d','d.pengajuan_id = a.id');
		$this->db->join('tr_fungsi_bg e','e.id_fungsi_bg = d.id_fungsi_bg');
		//$this->db->join('')
		$query 	= $this->db->get('tm_slf_pengajuan a')->row();
		return $query;
	}
	
	public function getSummarySlf($select="*",$id)
	{
		$this->db->select($select,FALSE);
		$this->db->where('a.id',$id);
		$this->db->join('tm_slf_pemilik b','b.pengajuan_id = a.id');
		$this->db->join('tm_slf_bangunan c','c.pengajuan_id = a.id');
		$this->db->join('tr_kecamatan d','d.id_kecamatan = c.id_kecamatan_bg');
		$this->db->join('tr_kabkot e','e.id_kabkot = c.id_kabkot_bg');
		$this->db->join('tr_provinsi f','f.id_provinsi = c.id_provinsi_bg');
		$this->db->join('tr_slf_permohonan g','g.id_jenis_permohonan = a.id_nama_permohonan');
		//$this->db->join('');
		$query 	= $this->db->get('tm_slf_pengajuan a')->row();
		return $query;
	}
	
	public function getDataSLF($select="a.*",$id='')
	{
		$this->db->select($select,FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id',$id);
		$query 	= $this->db->get('tm_slf_pengajuan a');
		return $query;
	}
	
	public function getSLFPemilik($select="*",$id)
	{
		$this->db->select($select,FALSE);
		$this->db->where('a.id',$id);
		$this->db->join('tm_slf_pemilik b','b.pengajuan_id = a.id');
		$this->db->join('tm_slf_bangunan c','c.pengajuan_id = a.id');
		//$this->db->join('')
		$query 	= $this->db->get('tm_slf_pengajuan a')->row();
		return $query;
	}
	
	public function getSlfDataTanah($select="*",$id)
	{
		$this->db->select($select,FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.pengajuan_id',$id);
		$query 	= $this->db->get('tm_slf_tanah a');
		return $query;
	}
	
	public function getSlfAdministrasi($select="a.*",$pengajuan_id='',$verifikasi='')
	{
		$this->db->select($select,FALSE);
		if ($pengajuan_id != null || trim($pengajuan_id) != '')  $this->db->where('a.pengajuan_id',$pengajuan_id);
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
		$this->db->join('tr_slf_nama_persyaratan c','b.id_syarat_slf = c.id_syarat_slf','LEFT');
		$query 	= $this->db->get('tr_slf_persyaratan a');
		return $query;
	}
	
	public function getSlfTeknis($select="a.*",$pengajuan_id='',$verifikasi='')
	{
		$this->db->select($select,FALSE);
		if ($pengajuan_id != null || trim($pengajuan_id) != '')  $this->db->where('a.pengajuan_id',$pengajuan_id);
		if ($verifikasi != null || trim($verifikasi) != '')  $this->db->where('a.verifikasi',$verifikasi);
		$query 	= $this->db->get('tm_slf_teknis a');
		return $query;
	}
	
	public function getMasterSlfTeknis($select="a.*",$id_jenis_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id_jenis_permohonan',$id_jenis_permohonan);
		$this->db->where('a.id_jenis_persyaratan','2');
		$this->db->join('tr_slf_persyaratan_detail b','a.id_persyaratan = b.id_persyaratan','LEFT');
		$this->db->join('tr_slf_nama_persyaratan c','b.id_syarat_slf = c.id_syarat_slf','LEFT');
		$query 	= $this->db->get('tr_slf_persyaratan a');
		return $query;
	}
	
	public function getNoRegistrasi($id_kabkot_bg,$tgl_skrg)
	{
		$sql = "SELECT max(no_registrasi) as no_urut 
			FROM tm_slf_pengajuan WHERE SUBSTR(no_registrasi,5,4) = '$id_kabkot_bg'
			and SUBSTR(no_registrasi,12,8) = '$tgl_skrg'";
			$hasil = $this->db->query($sql)->row_array();
		return $hasil;
	}
	
	public function getIdKabkot($id)
	{
		$sql = "SELECT a.id,a.no_registrasi, b.id_kabkot_bg,b.id_kecamatan_bg 
			FROM tm_slf_pengajuan  a
			left join tm_slf_bangunan b on (a.id=b.pengajuan_id)
			where id= ".$id;
		$hasil = $this->db->query($sql)->row_array();
		return $hasil;
	}
	
	function updatePermohonan($dataIn,$id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_permohonan',$dataIn);
	}
	
	function updateKonfirmasi($dataIn,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tm_slf_pengajuan',$dataIn);
	}
	
	function upload_delete($id,$detail,$key_syarat)
	{
		$this->db->delete('tm_data_administrasi',array('pengajuan_id'=>$id,'id_dokumen_permohonan'=>$detail));
	}
	// End Model Data SLF 
	
	// Begin Get Data Nomor Registrasi
	public function update_permohonan($dataIn,$id)
	{
		$this->db->where('id_permohonan', $id);
		$this->db->update('tm_imb_permohonan',$dataIn);
		$updated_status = $this->db->affected_rows();
	}
	public function get_nomor_registrasi($id_kabkot_bg,$tgl_skrg)
	{
		$sql = "SELECT max(nomor_registrasi) as no_urut 
			FROM tm_imb_permohonan WHERE SUBSTR(nomor_registrasi,5,4) = '$id_kabkot_bg'
			and SUBSTR(nomor_registrasi,12,8) = '$tgl_skrg'";
			$hasil = $this->db->query($sql)->row_array();
		return $hasil;
	}
	
	public function get_id_kabkot($id_permohonan)
	{
			$sql = "SELECT id_permohonan, nomor_registrasi, id_kabkot_bg, id_kec_bg 
			FROM tm_imb_permohonan where id_permohonan = ".$id_permohonan;
			$hasil = $this->db->query($sql)->row_array();
			return $hasil;
	}
	// End Get Data Nomor Registrasi
	public function listDataKecamatan($select="a.*",$id_kecamatan='',$id_kabkot='')
	{
		$this->db->select($select,FALSE);
		if ($id_kecamatan != null || trim($id_kecamatan) != '')  $this->db->where('a.id_kecamatan',$id_kecamatan);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		$this->db->join('tr_kabkot b','a.id_kabkot = b.id_kabkot','LEFT');
		$this->db->join('tr_provinsi c','b.id_provinsi = c.id_provinsi','LEFT');
		$this->db->order_by('a.id_kabkot','asc');
		$query 	= $this->db->get('tr_kecamatan a');
		return $query;
	}
	
	public function listDataKabKota($select="a.*",$id_kabkot='',$id_provinsi='')
	{
		$this->db->select($select,FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		if ($id_provinsi != null || trim($id_provinsi) != '')  $this->db->where('a.id_provinsi',$id_provinsi);
		$query 	= $this->db->get('tr_kabkot a');
		return $query;
	}
	
	public function listDataProvinsi($select="a.*")
	{
		$this->db->select($select,FALSE);
		$query 	= $this->db->get('tr_provinsi a');
		return $query;
	}
	
	public function getPemohon($select="a.*",$id='')
	{
		$sql = "SELECT a.* 
			FROM tm_data_pemohon_simbg  a
			where a.pengajuan_id= ".$id;
		$hasil = $this->db->query($sql)->row_array();
		return $hasil;
	}
	function get_nib($nib)
	{
		$sql = "SELECT a.nib,a.kd_izin,
				b.uraian_usaha,
				b.alamat_investasi
		from tm_oss_data_checklist a
		left Join tm_oss_data_detail b On (a.update_oss_data_id =b.update_oss_data_id)
		Where (1=1) and a.kd_dokumen = '0016'
		";
				
		if ($nib != null || trim($nib) != '')  $sql .= " AND a.nib = '$nib' ";
		
		$hasil  = $this->db->query($sql);
		//echo $sql; group by a.kd_izin
		return $hasil ;
	
	}
	
	function get_nibnya($nib)
	{
		$sql = "SELECT a.nib,a.kd_izin,
				b.uraian_usaha,b.alamat_investasi
		from tm_oss_data_checklist a
		left Join tm_oss_data_detail b On (a.update_oss_data_id =b.update_oss_data_id)
		Where (1=1) and a.kd_dokumen = '0016'";
		
		if ($nib != null || trim($nib) != '')  $sql .= " AND a.nib = '$nib' ";
		
		$hasil  = $this->db->query($sql);
		//echo $sql;
		return $hasil ;
	
	}
	
	function get_nib2($nib)
	{
		$sql = "SELECT a.nib,a.uraian_usaha,
				a.alamat_investasi,a.update_oss_data_id_detail,a.kd_izin
		from tm_oss_data_checklist a
		left Join tm_oss_data_detail b On (a.update_oss_data_id =b.update_oss_data_id)
		Where (1=1) and b.kd_dokumen = '0016'  ";
		
		if ($nib != null || trim($nib) != '')  $sql .= " AND a.nib = '$nib' ";
		
		$hasil  = $this->db->query($sql);
		//echo $sql;
		return $hasil ;
	
	}
	
	function get_nib_detail($nib,$nib_detail)
	{
		$sql = "SELECT a.*,b.update_oss_data_id_detail,b.kd_izin as kd_izin_detail,b.alamat_investasi,b.luas_tanah,
		substring(b.kd_izin,4,2) as id_provinsi,
		substring(b.kd_izin,4,4) as id_kabkot,
		substring(b.kd_izin,4,6) as id_kecamatan
		from tm_oss_data a
		LEFT JOIN tm_oss_data_checklist b ON(a.update_oss_data_id = b.update_oss_data_id) 
		Where (1=1) ";
		
		if ($nib != null || trim($nib) != '')  $sql .= " AND a.nib = '$nib' ";
		if ($nib_detail != null || trim($nib_detail) != '')  $sql .= " AND b.kd_izin = '$nib_detail' ";
		
		$hasil  = $this->db->query($sql);
		//echo $sql;
		return $hasil ;
	}
	
	function getdata_retsibusi($id_permohonan)
	{
		$sql = "SELECT a.*,
				m.id_penetapan_retribusi,m.harga_satuan,m.retribusi,m.id_cara_penetapan,m.retribusi_manual,m.dir_file_perhitungan,
				g.id_skrd, g.no_skrd, g.tgl_skrd, g.file_skrd, h.id_ssrd, h.no_ssrd, h.tgl_ssrd , h.file_ssrd
				";
		
		$sql .= "	FROM tm_imb_permohonan a
						
						LEFT JOIN tm_penetapan_retribusi m ON(m.id_permohonan = a.id_permohonan)
						LEFT JOIN tr_skrd g ON(g.id_permohonan=a.id_permohonan)
						LEFT JOIN tr_ssrd h ON(h.id_permohonan=a.id_permohonan)
						
					WHERE (1=1) AND a.status_syarat = '1' ";
		
		if ($id_permohonan != null || trim($id_permohonan) != '')  $sql .= " AND a.id_permohonan = '$id_permohonan' ";
		//if ($id != null || trim($id) != '')  $sql .= " AND a.id_penetapan_retribusi = '$id' ";
		// echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function simpan_kolektif($dataKolektif)
	{
		$this->db->insert('tm_imb_kolektif',$dataKolektif);
		return $this->db->insert_id();
	}
	
	function ubah_kolektif($dataKolektif,$id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_kolektif',$dataKolektif);
	}
	
	public function getDataProtype($select="a.*",$id_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('b.id_permohonan',$id_permohonan);
		$this->db->join('tm_imb_permohonan b','a.idp = b.idp','LEFT');
		$query 	= $this->db->get('tr_protipe a');
		return $query;
	}
	
}