<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpengajuan extends CI_Model{

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
	
	public function getDataUserSLF($select="a.*",$id_permohonan_slf='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $this->db->where('a.id_permohonan_slf',$id_permohonan_slf);
		$query 	= $this->db->get('tm_slf_permohonan a')->row();
		return $query;

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
		$this->db->join('tr_permohonan j','a.id_jenis_permohonan = j.id_jenis_permohonan','LEFT');
		$query 	= $this->db->get('tm_imb_permohonan a');
		return $query;
	}
	
	public function getAllDataPermohonan($select="a.*",$user_id='',$id_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.id_user',$user_id);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan',$id_permohonan);
		$this->db->join('tr_imb_permohonan b','a.id_jenis_permohonan = b.id_jenis_permohonan','LEFT');
		$query 	= $this->db->get('tm_imb_permohonan a');
		return $query;
	}
	
	public function getAllDataPermohonanSLF($select="a.*",$user_id='',$id='')
	{
		$this->db->select($select,FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.id_user',$user_id);
		if ($id != null || trim($id) != '')  $this->db->where('a.id',$id);
		$this->db->join('tr_slf_permohonan b','b.id_jenis_permohonan = a.id_jenis_permohonan','LEFT');
		$query 	= $this->db->get('tm_slf_permohonan a');
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
	
	public function removeData($id)
	{
		$this->db->query("DELETE FROM tm_slf_tanah WHERE id_tanah = $id");
		$this->db->where('id_tanah',$id);
		$query = $this->db->delete('tm_slf_tanah');
		return $query;
	}
	
	public function upload_delete($id,$detail,$key_syarat)
	{
		$file = $this->get_fileu($id,$detail);
		$this->db->delete('tm_permohonan_bg_syarat',array('id_permohonan'=>$id,'id_persyaratan_detail'=>$detail));
		if($file->dir_file != '')
		{
			if($key_syarat == 'adm'){
				unlink('./file/IMB/pengajuan_imb/'.$id.'/data_administrasi/' . $file->dir_file);
			}else if($key_syarat == 'adm'){
				unlink('./file/Gambar/' . $file->dir_file);
			}
		}
	}
	
	function RemoveAdministrasi($id)
	{
		$this->db->delete('tm_slf_administrasi',array('id'=>$id));
		/*$file = $this->get_file($id,$detail);
		$this->db->delete('tm_slf_administrasi',array('id'=>$id,'id_dokumen_permohonan'=>$detail));
		if($file->dir_file != '')
		{
			unlink('./file/slf/'.$id.'/persyaratan/Administrasi/' . $file->dir_file);
		}*/
	}
	
	function RemoveTeknis($id)
	{
		$this->db->delete('tm_slf_teknis',array('id'=>$id));
		/*$file = $this->get_file($id,$detail);
		$this->db->delete('tm_slf_administrasi',array('id'=>$id,'id_dokumen_permohonan'=>$detail));
		if($file->dir_file != '')
		{
			unlink('./file/slf/'.$id.'/persyaratan/Administrasi/' . $file->dir_file);
		}*/
	}
	
	
	
	
	function get_file($id,$detail)
	{
		return $this->db->select()->from('tm_slf_administrasi')->where(array('pengajuan_id'=>$id,'id_dokumen_permohonan'=>$detail))->get()->row();
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
	
	public function getDataTanah($select="a.*",$id='')
	{
		$this->db->select($select,FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id_permohonan_slf',$id);
		$query 	= $this->db->get('tm_slf_tanah a');
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
	
	public function getDataImb($select="a.*",$id_permohonan='')
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan',$id_permohonan);
		$query 	= $this->db->get('tm_imb_permohonan a');
		return $query;
	}
	
	function getDataRetribusi($select="a.*",$id_permohonan=null)
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan',$id_permohonan);
		$query 	= $this->db->get('tr_ssrd a');
		return $query;
	}
	// BeginModel Data SLF 
	public function getSLFDataPermohonan($select="*",$id)
	{
		$this->db->select($select,FALSE);
		$this->db->where('a.id_permohonan_slf',$id);
		
		$this->db->join('tr_fungsi_bg e','e.id_fungsi_bg = a.id_fungsi_bg');
		//$this->db->join('')
		$query 	= $this->db->get('tm_slf_permohonan a')->row();
		return $query;
	}
	
	public function getSummarySlf($select="*",$id_permohonan_slf)
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  
		$this->db->where('a.id_permohonan_slf',$id_permohonan_slf);
		$this->db->join('tr_kecamatan d','d.id_kecamatan = a.id_kecamatan_bg','LEFT');
		$this->db->join('tr_kabkot e','e.id_kabkot = a.id_kabkot_bg','LEFT');
		$this->db->join('tr_provinsi f','f.id_provinsi = a.id_provinsi_bg','LEFT');
		$this->db->join('tr_slf_permohonan g','g.id_jenis_permohonan = a.id_jenis_permohonan','LEFT');
		$query 	= $this->db->get('tm_slf_permohonan a');
		//return $query;
		return $query->row();
	}
	
	public function getDataSLF($select="a.*",$id='')
	{
		$this->db->select($select,FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id_permohonan_slf',$id);
		$query 	= $this->db->get('tm_slf_permohonan a');
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
		if ($id != null || trim($id) != '')  $this->db->where('a.id_permohonan_slf',$id);
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
		$this->db->join('tr_slf_nama_persyaratan c','b.id_syarat = c.id_syarat','LEFT');
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
		$this->db->join('tr_slf_nama_persyaratan c','b.id_syarat = c.id_syarat','LEFT');
		$query 	= $this->db->get('tr_slf_persyaratan a');
		return $query;
	}
	
	public function getNoRegistrasi($id_kabkot_bg,$tgl_skrg)
	{
		$sql = "SELECT max(no_registrasi_slf) as no_urut 
			FROM tm_slf_permohonan WHERE SUBSTR(no_registrasi_slf,5,4) = '$id_kabkot_bg'
			and SUBSTR(no_registrasi_slf,12,8) = '$tgl_skrg'";
			$hasil = $this->db->query($sql)->row_array();
		return $hasil;
	}
	
	public function getIdKabkot($id)
	{
		$sql = "SELECT a.no_registrasi_slf,a.no_registrasi_slf, a.id_kabkot_bg,a.id_kecamatan_bg 
			FROM tm_slf_permohonan  a
			where id_permohonan_slf= ".$id;
		$hasil = $this->db->query($sql)->row_array();
		return $hasil;
	}
	
	function updatePermohonan($dataIn,$id_permohonan_slf)
	{
		$this->db->where('id_permohonan_slf', $id_permohonan_slf);
		$this->db->update('tm_slf_permohonan',$dataIn);
	}
	
	function updateKonfirmasi($dataIn,$id)
	{
		$this->db->where('id_permohonan_slf', $id);
		$this->db->update('tm_slf_permohonan',$dataIn);
	}
	
	/*function upload_delete($id,$detail,$key_syarat)
	{
		$this->db->delete('tm_data_administrasi',array('pengajuan_id'=>$id,'id_dokumen_permohonan'=>$detail));
	}*/
	// End Model Data SLF 
	
	// Begin Get Data Nomor Registrasi
	public function update_permohonan($dataIn,$id)
	{
		$this->db->where('id_permohonan_slf', $id);
		$this->db->update('tm_slf_permohonan',$dataIn);
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
		$sql = "SELECT a.nib,a.uraian_usaha,
				a.alamat_investasi,a.update_oss_data_id_detail,a.kd_izin
		from tm_oss_data_detail a
		left Join tm_oss_data_checklist b On (a.update_oss_data_id =b.update_oss_data_id)
		Where (1=1) and b.kd_dokumen = '0226' ";
		
		if ($nib != null || trim($nib) != '')  $sql .= " AND a.nib = '$nib' ";
		
		$hasil  = $this->db->query($sql);
		//echo $sql;
		return $hasil ;
	
	}
	
	
	/*function get_nib($nib)
	{
		$sql = "SELECT a.nib,a.uraian_usaha,a.alamat_investasi,a.update_oss_data_id_detail,a.kd_izin
		from tm_data_oss_detail a
		Where (1=1) ";
		
		if ($nib != null || trim($nib) != '')  $sql .= " AND a.nib = '$nib' ";
		
		$hasil  = $this->db->query($sql);
		//echo $sql;
		return $hasil ;
	
	}*/
	
	function getPermohonan($id=null,$cari=null)
	{
		$sql = "SELECT a.*
		FROM tr_slf_permohonan a
		WHERE (1=1) AND a.status ='1'";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_nib_detail($nib,$nib_detail)
	{
		$sql = "SELECT a.*,b.update_oss_data_id_detail,b.kd_izin as kd_izin_detail,b.alamat_investasi,b.luas_tanah,
		substring(b.kd_izin,4,2) as id_provinsi,
		substring(b.kd_izin,4,4) as id_kabkot,
		substring(b.kd_izin,4,6) as id_kecamatan
		from tm_oss_data a
		LEFT JOIN tm_oss_data_detail b ON(a.update_oss_data_id = b.update_oss_data_id) 
		Where (1=1) ";
		
		if ($nib != null || trim($nib) != '')  $sql .= " AND a.nib = '$nib' ";
		if ($nib_detail != null || trim($nib_detail) != '')  $sql .= " AND b.kd_izin = '$nib_detail' ";
		
		$hasil  = $this->db->query($sql);
		//echo $sql;
		return $hasil ;
	}
	/*function get_nib_detail($nib,$nib_detail)
	{
		$sql = "SELECT a.*,b.update_oss_data_id_detail,b.kd_izin as kd_izin_detail,b.alamat_investasi,b.luas_tanah,
		substring(b.kd_izin,4,2) as id_provinsi,
		substring(b.kd_izin,4,4) as id_kabkot,
		substring(b.kd_izin,4,6) as id_kecamatan
		from tm_data_oss a
		LEFT JOIN tm_data_oss_detail b ON(a.update_oss_data_id = b.update_oss_data_id) 
		Where (1=1) ";
		
		if ($nib != null || trim($nib) != '')  $sql .= " AND a.nib = '$nib' ";
		if ($nib_detail != null || trim($nib_detail) != '')  $sql .= " AND b.kd_izin = '$nib_detail' ";
		
		$hasil  = $this->db->query($sql);
		//echo $sql;
		return $hasil ;
	}*/
	
	function get_x_bykode($no_imb)
	{
		$hsl=$this->db->query("SELECT a.*,b.no_imb,b.tgl_imb,b.dir_file_imb as dir_file_simbg,
			c.nama_kabkota,d.nama_provinsi,e.nama_kabkota as nama_kabkota_bg,f.nama_provinsi as nama_provinsi_bg,g.id_kecamatan as id_kecamatan_bg
			FROM tm_imb_permohonan a
			Left Join tm_imb_penerbitan b ON (a.id_permohonan=b.id_permohonan)
			left Join tr_kabkot c ON (a.id_kabkot = c.id_kabkot)
			left Join tr_provinsi d ON (a.id_provinsi = d.id_provinsi)
			Left Join tr_kabkot e ON (a.id_kabkot_bg = e.id_kabkot)
			Left Join tr_provinsi f ON (a.id_provinsi_bg =f.id_provinsi)
			Left Join tr_kecamatan g ON (a.kecamatan =g.nama_kecamatan)
			WHERE no_imb='$no_imb'");
			
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'id_permohonan' => $data->id_permohonan,
					'no_imb' => $data->no_imb,
					'dir_file_simbg' => $data->dir_file_simbg,
					'tgl_imb' => $data->tgl_imb,
					'nama_pemohon' => $data->nama_pemohon,
					'alamat_pemohon' => $data->alamat_pemohon,
					'id_kecamatan' => $data->id_kecamatan,
					'id_kabkot' => $data->id_kabkot,
					'nama_kabkota' => $data->nama_kabkota,
					'id_provinsi' => $data->id_provinsi,
					'nama_provinsi' => $data->nama_provinsi,
					'no_tlp' => $data->no_tlp,
					'email' => $data->email,
					'no_ktp' => $data->no_ktp,
					'id_jenis_usaha'=> $data->id_jenis_usaha,
					// Data Pokok Bangunan //
					'alamat_bg' => $data->alamat_bg,
					'kelurahan' => $data->kelurahan,
					'id_kec_bg' => $data->id_kec_bg,
					'kecamatan'	=> $data->kecamatan,
					'id_kabkot_bg' => $data->id_kabkot_bg,
					'nama_kabkota_bg' => $data->nama_kabkota_bg,
					'id_provinsi_bg' => $data->id_provinsi_bg,
					'nama_provinsi_bg' => $data->nama_provinsi_bg,
					'id_fungsi_bg' => $data->id_jenis_bg,
					'id_jenis_bg' => $data->id_jenis_bg,
					'jns_bangunan' => $data->jns_bangunan,
					'nama_bangunan' => $data->nama_bangunan,
					'luas_bg' => $data->luas_bg,
					'tinggi_bg' => $data->tinggi_bg,
					'lantai_bg' => $data->lantai_bg,
					'lapis_basement' => $data->lapis_basement,
					'luas_basement' => $data->luas_basement,
					'id_dok_tek' => $data->id_dok_tek,
					// Data 
				);
			}
		}
		//echo $sql;
		return $hasil;
	}
	
	function get_detail_slf($id=null)
	{
		$sql = "SELECT a.*,
				c.nama_permohonan,
				e.nama_kabkota,
				f.nama_provinsi,
				i.nama_kecamatan, 
				j.nama_kabkota as nama_kabkota_bg, 
				k.nama_provinsi as nama_provinsi_bg,
				l.nama_kecamatan as nama_kecamatan_bg,
				o.fungsi_bg,o.id_pemanfaatan_bg as id_pemanfaatan_bg2,q.luas_tanah,q.atas_nama_dok,z.username
				";
		$sql .= "	FROM tm_slf_permohonan a
						
						LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
						LEFT JOIN tm_slf_tanah q ON(q.id_permohonan_slf=a.id_permohonan_slf)
						LEFT JOIN tr_slf_permohonan c ON(a.id_jenis_permohonan = c.id_jenis_permohonan)
						LEFT JOIN tr_kabkot e ON(e.id_kabkot=a.id_kabkot)
						LEFT JOIN tr_provinsi f ON(a.id_provinsi=f.id_provinsi)
						LEFT JOIN tr_kecamatan i ON(a.id_kecamatan=i.id_kecamatan)
						LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
						LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
						LEFT JOIN tr_kecamatan l ON(l.id_kecamatan=a.id_kecamatan_bg)
						LEFT JOIN tm_user z ON (z.id=a.id_user)
					WHERE (1=1)";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan_slf = '$id' ";
		
		//echo $sql;
		$hasil  = $this->db->query($sql);
		if (isset($counting) && $counting == 1)	{
			$myres= $hasil->result_array();
			if (count($myres) > 0)
				return $myres[0]['total'];
			else
				return 0;
		} else {
			return $hasil ;
		}
	}
	
	function update_progress($dataStatus,$id)
	{
		$this->db->where('id_permohonan_slf', $id);
		$this->db->update('tm_slf_permohonan',$dataStatus);
		$updated_status = $this->db->affected_rows();
	}
	
	function getSyaratListTidakSesuai($id_permohonan_slf=null)
	{
		$sql = "SELECT a.*,c.id_syarat,d.nama_syarat,e.id_detail_jenis_persyaratan
				FROM tm_slf_penilaian_teknis  a
				LEFT JOIN tm_slf_permohonan b ON(a.id_permohonan_slf=b.id_permohonan_slf)
				LEFT JOIN tr_persyaratan2_detail c ON(a.id_persyaratan_detail=c.id_persyaratan_detail)
				LEFT JOIN tr_slf_syarat d ON(c.id_syarat=d.id_syarat)
				LEFT JOIN tr_persyaratan2 e ON(e.id_persyaratan=c.id_persyaratan)
				WHERE (1=1) AND a.kesesuaian = '2' ";
		if ($id_permohonan_slf != null || trim($id_permohonan_slf) != '')  $sql .= " AND a.id_permohonan_slf = '$id_permohonan_slf' ";
		$sql .= " ORDER BY e.id_detail_jenis_persyaratan ASC ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
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
	
	function updateDataPenilaian($dataRT,$id)
	{
		$this->db->where('id_penilaian', $id);
		$this->db->update('tm_slf_penilaian_teknis',$dataRT);
	}
	
}