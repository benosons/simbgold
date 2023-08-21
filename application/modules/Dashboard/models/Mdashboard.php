<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdashboard extends CI_Model
{

	public function getDataUserPemohon($select="a.*",$user_id='')
	{
		$this->db->select($select,FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.id',$user_id);
		$this->db->join('tm_user_data b','a.id = b.user_id','LEFT');
		$query 	= $this->db->get('tm_user a')->row();
		return $query;
	}

	public function getDataTpa($select="a.*",$id_user='')
	{
		$this->db->select($select,FALSE);
		if ($id_user != null || trim($id_user) != '')  $this->db->where('a.id',$id_user);
		$this->db->join('tm_tpa b','a.id = b.id_user','LEFT');
		$this->db->join('tm_tpadokumen c','b.id = c.id','LEFT');
		$this->db->join('tr_asosiasi d','c.id_asak = d.id','LEFT');
		$query 	= $this->db->get('tm_user a')->row();
		return $query;
	}
	public function getDataProyek($select = "a.*", $id_tpa = '')
	{
		$this->db->select($select, FALSE);
		if ($id_tpa != null || trim($id_tpa) != '')  $this->db->where('a.id', $id_tpa);
		$this->db->join('tmdatapemilik b', 'b.id = a.id_pemilik', 'LEFT');
		$this->db->join('tmdatabangunan c', 'c.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi d', 'd.id = c.id_jenis_permohonan', 'LEFT');
		$query 	= $this->db->get('tm_penugasan_tpa a');
		return $query;

	}
	public function getDataLokasi($select = "a.*,d.nama_kabkota", $id_tpa = '')
	{
		$this->db->select($select, FALSE);
		if ($id_tpa != null || trim($id_tpa) != '')  $this->db->where('a.id_tpanya', $id_tpa);
		$this->db->join('tr_kabkot d', 'a.id_kabkotnya=d.id_kabkot', 'LEFT');
		$query 	= $this->db->get('zample_tm_tpa_perkabkot a');
		return $query;
	}
	public function getJumIMB($user_id=null)
	{
		$sql = "SELECT
				SUM(CASE  when (a.pernyataan is not null) then 1 else 0 END ) AS Pengajuan_IMB,
				SUM(CASE  when (a.status_progress >='1') then 1 else 0 END ) AS IMB_proses,
				SUM(CASE  when (a.status_progress ='16') then 1 else 0 END ) AS IMBTerbit,
				SUM(CASE  when (a.status_progress ='19') then 1 else 0 END ) AS IMBDitolak
				FROM tm_imb_permohonan a
				Where(a.id_user)
				";
		if ($user_id != null || trim($user_id) != '')  $sql .= " AND a.id_user = '$user_id' ";
		$sql .= " Group BY a.id_user";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}
	
	public function getJumSLF($user_id=null)
	{
		$sql = "SELECT
				SUM(CASE  when (a.status_pernyataan is not null) then 1 else 0 END ) AS PengajuanSLF,
				SUM(CASE  when (a.status_progress >='1') then 1 else 0 END ) AS SLFProses,
				SUM(CASE  when (a.status_progress ='16') then 1 else 0 END ) AS SLFTerbit,
				SUM(CASE  when (a.status_progress ='19') then 1 else 0 END ) AS SLFDitolak
				FROM tm_slf_permohonan a
				Where(a.id_user)
				";
		if ($user_id != null || trim($user_id) != '')  $sql .= " AND a.id_user = '$user_id' ";
		$sql .= " Group BY a.id_user";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}
	
	public function getJumIMBKabKota($id_kabkot_bg=null)
	{
		$sql = "SELECT
				SUM(CASE  when (a.pernyataan is not null) then 1 else 0 END ) AS Pengajuan_IMB,
				SUM(CASE  when (a.status_progress >='1') then 1 else 0 END ) AS IMB_proses,
				SUM(CASE  when (a.status_progress ='16') then 1 else 0 END ) AS IMBTerbit,
				SUM(CASE  when (a.status_progress ='19') then 1 else 0 END ) AS IMBDitolak
				FROM tm_imb_permohonan a
				Where(a.id_kabkot_bg)
				";
		if ($id_kabkot_bg != null || trim($id_kabkot_bg) != '')  $sql .= " AND a.id_kabkot_bg = '$id_kabkot_bg' ";
		$sql .= " Group BY a.id_kabkot_bg";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}
	
	public function getJumSLFKabKota($id_kabkot_bg=null)
	{
		$sql = "SELECT
				SUM(CASE  when (a.status_pernyataan is not null) then 1 else 0 END ) AS PengajuanSLF,
				SUM(CASE  when (a.status_progress >='1') then 1 else 0 END ) AS SLFProses,
				SUM(CASE  when (a.status_progress ='16') then 1 else 0 END ) AS SLFTerbit,
				SUM(CASE  when (a.status_progress ='19') then 1 else 0 END ) AS SLFDitolak
				FROM tm_slf_permohonan a
				Where(a.id_kabkot_bg)
				";
		if ($id_kabkot_bg != null || trim($id_kabkot_bg) != '')  $sql .= " AND a.id_kabkot_bg = '$id_kabkot_bg' ";
		$sql .= " Group BY a.id_kabkot_bg";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}
	
	public function getRekapIMB($id_kabkota_bg=null)
	{
		$sql = "SELECT
				SUM(CASE  when (a.status is not null) then 1 else 0 END ) AS Pengajuan_IMB,
				SUM(CASE  when (a.status ='13') then 1 else 0 END ) AS IMB_terbit,
				SUM(CASE  when (a.status ='9') then 1 else 0 END ) AS IMB_ditolak
				FROM tm_imb_permohonan a
				Where(a.id_kabkota_bg)
				";
		if ($id_kabkota_bg != null || trim($id_kabkota_bg) != '')  $sql .= " AND a.id_kabkota_bg = '$id_kabkota_bg' ";
		$sql .= " Group BY a.id_kabkota_bg";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}
	
	public function getDataIMB($cari=null)
	{
		$sql = "SELECT
				SUM(CASE  when (a.pernyataan ='1') then 1 else 0 END ) AS Pengajuan_IMB,
				SUM(CASE  when (a.status_progress between '1' AND '3') then 1 else 0 END ) AS DPMPTSP,
				SUM(CASE  when (a.status_progress between '4' AND '10') then 1 else 0 END ) AS DinasTeknis,
				SUM(CASE  when (a.status_progress between '11' AND '13') then 1 else 0 END ) AS Retribusi,
				SUM(CASE  when (a.status_progress ='14') then 1 else 0 END ) AS ValidasiKadis,
				SUM(CASE  when (a.status_progress between '15' AND '16') then 1 else 0 END ) AS IMB_terbit,
				SUM(CASE  when (a.status_progress ='19') then 1 else 0 END ) AS IMB_ditolak
				FROM tm_imb_permohonan a
				Where(1=1)
				";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		//$sql .= " Group BY a.id_kabkota_bg";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}
	
	//Begin Dashboard baru
	public function getTotalPbg()
	{
		$kabkot = $this->session->userdata('loc_id_kabkot');
		$role = $this->session->userdata('loc_role_id');
		if ($role != 1)  $this->db->where('tmdatabangunan.id_kabkot_bgn', $kabkot);
		$this->db->where("tmdatabangunan.status >=", 3);
		return $this->db->get('tmdatabangunan');
	}

	public function getTotalPbgWorks($param)
	{
		$kabkot = $this->session->userdata('loc_id_kabkot');
		$role = $this->session->userdata('loc_role_id');
		if ($role != 1)  $this->db->where('tmdatabangunan.id_kabkot_bgn', $kabkot);
		$this->db->where("tmdatabangunan.status", $param);
		return $this->db->get('tmdatabangunan');
	}

	public function getListPenugasan()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('*');
		$this->db->from('tmDataPemilik a');
		$this->db->where("status >= 3 ");
		$this->db->where('id_kabkot_bgn', $Dinas);
		$this->db->join('tmDataBangunan b', 'a.id = b.id', 'LEFT');
		$this->db->limit(7);
		$this->db->order_by('b.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	//End Dashboard baru
	
	public function get_rekapIMB($cari=null)
	{
		$sql = "SELECT a.id_provinsi, a.nama_provinsi,b.id_fungsi_bg,
				SUM(CASE  when (b.nib !='') then 1 else 0 END ) AS Memiliki_NIB,
				SUM(CASE  when (b.nib ='0') then 1 else 0 END ) AS Memiliki_NIB2,
				SUM(CASE  when (b.nib is null) then 1 else 0 END ) AS Non_NIB1,
				SUM(CASE  when (b.nib ='') then 1 else 0 END ) AS Non_NIB2
				FROM tr_provinsi a 
				LEFT JOIN tm_imb_permohonan b ON ( a.id_provinsi = b.id_provinsi_bg )
				Where (a.id_provinsi)  AND b.pernyataan = '1'
				$cari
				GROUP BY a.id_provinsi";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	public function get_rekapSLF($cari=null)
	{
		$sql = "SELECT a.id_provinsi, a.nama_provinsi,b.id_fungsi_bg,
				SUM(CASE  when (b.nib !='') then 1 else 0 END ) AS Memiliki_NIBSLF,
				SUM(CASE  when (b.nib ='0') then 1 else 0 END ) AS Memiliki_NIB2SLF,
				SUM(CASE  when (b.nib is null) then 1 else 0 END ) AS Non_NIB1SLF,
				SUM(CASE  when (b.nib ='') then 1 else 0 END ) AS Non_NIB2SLF
				FROM tr_provinsi a 
				LEFT JOIN tm_slf_permohonan b ON ( a.id_provinsi = b.id_provinsi_bg )
				Where (a.id_provinsi)  AND b.status_pernyataan = '1'
				$cari
				GROUP BY a.id_provinsi";
		//echo $sql;
		$hasilSLF  = $this->db->query($sql);
		return $hasilSLF;
	}
	
	function updateKesediaan($dataIn,$id_nya)
	{
		$this->db->where('id_nya', $id_nya);
		$this->db->update('zample_tm_tpa_perkabkot',$dataIn);
	}

	function getJenisKonsultasi($id = null, $cari = null)
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
	
	function getSyaratList($per = null, $kls = null)
	{
		$sql = "SELECT a.id_persyaratan,a.id,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,
				b.id_detail,b.id_syarat, c.nm_dokumen,c.keterangan 
				FROM tr_konsultasi_syarat a 
				LEFT JOIN tr_pbg_syarat_detail b ON(a.id_persyaratan=b.id_persyaratan) 
				LEFT JOIN tr_dokumen_syarat c ON(b.id_syarat=c.id) 
				LEFT JOIN tmdatabangunan d ON(a.id=d.id_jenis_permohonan) 
				
				WHERE (1=1)
		";
		if ($per != null || trim($per) != '')  $sql .= " AND a.id = '$per' ";
		if ($kls != null || trim($kls) != '')  $sql .= " AND a.id_detail_jenis_persyaratan = '$kls' ";
		$sql .= " Group by b.id_detail ORDER BY a.id, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat ASC ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function getSyarat($id = null, $per = null, $status = null)
	{
		$sql = "SELECT a.*
				FROM tmpersyaratankonsultasi a
				WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_persyaratan_detail = '$id' ";
		if ($per != null || trim($per) != '')  $sql .= " AND a.id = '$per' ";
		if ($status != null || trim($status) != '')  $sql .= " AND a.status = '$status' ";
		$sql .= " ORDER BY a.id_persyaratan ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	public function getDataJnsKonsultasi($select = "a.*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		$query 	= $this->db->get('tmdatabangunan a');
		return $query;
	}
	
	public function getDataDokumen($select = "a.*", $id = '', $status = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		if ($status != null || trim($status) != '')  $this->db->where('a.status', $status);
		$query 	= $this->db->get('tmpersyaratankonsultasi a');
		return $query;
	}
	
	public function  getDataVerifikator($id)
	{
		$this->db->select('a.*,b.*,c.nm_konsultasi,d.*,e.*,f.*,k.nama_kelurahan,g.nama_kecamatan as nm_kec_bgn,h.nama_kabkota as nm_kabkot_bgn,i.nama_provinsi as nm_prov_bgn, 
		j.nama_kelurahan as nm_kel_bgn');
		$this->db->from('tmdatapemilik a');
		$this->db->where('a.id', $id);
		$this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_kecamatan d', 'a.id_kecamatan = d.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot e', 'a.id_kabkota = e.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi f', 'a.id_provinsi = f.id_provinsi', 'LEFT');
		$this->db->join('tr_kelurahan k', 'a.id_kelurahan = k.id_kelurahan', 'LEFT');

		$this->db->join('tr_kecamatan g', 'b.id_kec_bgn = g.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot h', 'b.id_kabkot_bgn = h.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi i', 'b.id_prov_bgn = i.id_provinsi', 'LEFT');
		$this->db->join('tr_kelurahan j', 'b.id_kel_bgn = j.id_kelurahan', 'LEFT');
		$query = $this->db->get();
		return $query;
	}

	public function getDataBangunan($id)
	{
		$this->db->select('a.id,b.*,c.nm_konsultasi,d.nama_kecamatan,e.nama_kabkota,f.nama_provinsi,g.nama_kelurahan');
		$this->db->from('tmdatapemilik a');
		$this->db->where('a.id', $id);
		$this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_kelurahan g', 'b.id_kel_bgn = g.id_kelurahan', 'LEFT');
		$this->db->join('tr_kecamatan d', 'b.id_kec_bgn = d.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot e', 'b.id_kabkot_bgn = e.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi f', 'b.id_prov_bgn = f.id_provinsi', 'LEFT');
		$query = $this->db->get();
		return $query;
	}

	//Begin Model Dashboard TPA
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

	public function getDataTpaVer($id)
	{
		$this->db->select('a.*');
		$this->db->from('tm_tpa a');
		$this->db->where('a.id',$id);
		$query = $this->db->get();
		return $query;
	}

	function updateProgress($dataIn,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tm_tpa',$dataIn);
	}

	public function GetJumlahTpa($id_asosiasi=null)
	{
		$sql = "SELECT
				SUM(CASE  when (a.status >='1') then 1 else 0 END ) AS Total,
				SUM(CASE  when (a.status ='1') then 1 else 0 END ) AS BelumVer,
				SUM(CASE  when (a.status ='3') then 1 else 0 END ) AS Verifikasi,
				SUM(CASE  when (a.status ='5') then 1 else 0 END ) AS Pemda,
				SUM(CASE  when (a.status ='2') then 1 else 0 END ) AS Dikembalikan
				FROM tm_tpa a
				left join tm_tpadokumen b On(a.id=b.id)
				Where(b.id_asak)
				";
		if ($id_asosiasi != null || trim($id_asosiasi) != '')  $sql .= " AND b.id_asak = '$id_asosiasi' ";
		$sql .= " Group BY b.id_asak";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}

	public function GetJumlahTpaTot()
	{
		$sql = "SELECT
				SUM(CASE  when (a.status ='1') then 1 else 0 END ) AS CalonTpa,
				SUM(CASE  when (a.status >='3') then 1 else 0 END ) AS TPA,
				SUM(CASE  when (a.status ='1' and a.id_lembaga='1') then 1 else 0 END ) AS CalonAka,
				SUM(CASE  when (a.status >='3' and a.id_lembaga='1') then 1 else 0 END ) AS TpaAka,
				SUM(CASE  when (a.status ='1' and a.id_lembaga='3') then 1 else 0 END ) AS CalonAso,
				SUM(CASE  when (a.status >='3' and a.id_lembaga='3') then 1 else 0 END ) AS TpaAso,
				SUM(CASE  when (a.status ='1' and a.id_lembaga='2') then 1 else 0 END ) AS CalonPakar,
				SUM(CASE  when (a.status >='3' and a.id_lembaga='2') then 1 else 0 END ) AS TpaPakar
				FROM tm_tpa a
				where(1=1) and a.status !='2'
				";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}

	public function GetJmlPbg()
	{
		$sql = "SELECT
				SUM(CASE  when (b.pernyataan ='1') then 1 else 0 END ) AS Total,
				SUM(CASE  when (b.status between '1' AND '10' and b.pernyataan ='1') then 1 else 0 END ) AS DinasTeknis,
				SUM(CASE  when (b.status between '11' AND '14' and b.pernyataan ='1') then 1 else 0 END ) AS DinasPerizinan,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan ='1') then 1 else 0 END ) AS TelahTerbit,
				SUM(CASE  when (b.status ='25' and b.pernyataan ='1') then 1 else 0 END ) AS Ditolak
				FROM tm_akun_dinas a 
				LEFT JOIN tmdatabangunan b ON ( a.id_kabkot = b.id_kabkot_bgn )
				Where(1=1) and b.pernyataan='1' and b.id_jenis_permohonan !='14' and b.id_kabkot_bgn !='9971' and b.id_kabkot_bgn !='9972'
				";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}

	public function GetJmlSLF()
	{
		$sql = "SELECT
				SUM(CASE  when (b.pernyataan ='1') then 1 else 0 END ) AS Total,
				SUM(CASE  when (b.status between '1' AND '10' and b.pernyataan ='1') then 1 else 0 END ) AS DinasTeknis,
				SUM(CASE  when (b.status between '11' AND '14' and b.pernyataan ='1') then 1 else 0 END ) AS DinasPerizinan,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan ='1') then 1 else 0 END ) AS TelahTerbit,
				SUM(CASE  when (b.status ='25' and b.pernyataan ='1') then 1 else 0 END ) AS Ditolak
				FROM tm_akun_dinas a 
				LEFT JOIN tmdatabangunan b ON ( a.id_kabkot = b.id_kabkot_bgn )
				Where(1=1) and b.id_jenis_permohonan ='14' and b.id_kabkot_bgn !='9971'
				";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}

	public function getDataVerifikasi($select = "a.*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		$query 	= $this->db->get('th_ver_tpa a');
		return $query;
	}
	//End Model Dashboard TPA
	//Begin Model Dashboard Dinas
	public function GetJumlahTpaTotBalai($id_kabkot=null)
	{
		$sql = "SELECT
				SUM(CASE  when (a.status ='1') then 1 else 0 END ) AS CalonTpa,
				SUM(CASE  when (a.status >='3') then 1 else 0 END ) AS TPA,
				SUM(CASE  when (a.status ='1' and a.id_lembaga='1') then 1 else 0 END ) AS CalonAka,
				SUM(CASE  when (a.status >='3' and a.id_lembaga='1') then 1 else 0 END ) AS TpaAka,
				SUM(CASE  when (a.status ='1' and a.id_lembaga='3') then 1 else 0 END ) AS CalonAso,
				SUM(CASE  when (a.status >='3' and a.id_lembaga='3') then 1 else 0 END ) AS TpaAso,
				SUM(CASE  when (a.status ='1' and a.id_lembaga='2') then 1 else 0 END ) AS CalonPakar,
				SUM(CASE  when (a.status >='3' and a.id_lembaga='2') then 1 else 0 END ) AS TpaPakar
				FROM tm_tpa a
				where(1=1) and a.status !='2'
				";
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND a.id_provinsi = '$id_kabkot' ";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}

	public function GetJmlPbgBalai($id_kabkot=null)
	{
		$sql = "SELECT
				SUM(CASE  when (b.pernyataan ='1') then 1 else 0 END ) AS Total,
				SUM(CASE  when (b.status between '1' AND '10' and b.pernyataan ='1') then 1 else 0 END ) AS DinasTeknis,
				SUM(CASE  when (b.status between '11' AND '14' and b.pernyataan ='1') then 1 else 0 END ) AS DinasPerizinan,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan ='1') then 1 else 0 END ) AS TelahTerbit,
				SUM(CASE  when (b.status ='25' and b.pernyataan ='1') then 1 else 0 END ) AS Ditolak
				FROM tmdatabangunan b 
				Where(1=1) and b.pernyataan='1' and b.id_jenis_permohonan !='14'
				";
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND b.id_prov_bgn = '$id_kabkot' ";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}

	public function GetJmlPbgDinas($id_kabkot=null)
	{
		$sql = "SELECT
				SUM(CASE  when (b.pernyataan ='1') then 1 else 0 END ) AS Total,
				SUM(CASE  when (b.status between '1' AND '10' and b.pernyataan ='1') then 1 else 0 END ) AS DinasTeknis,
				SUM(CASE  when (b.status between '11' AND '14' and b.pernyataan ='1') then 1 else 0 END ) AS DinasPerizinan,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan ='1') then 1 else 0 END ) AS TelahTerbit,
				SUM(CASE  when (b.status ='25' and b.pernyataan ='1') then 1 else 0 END ) AS Ditolak
				FROM tmdatabangunan b 
				Where(1=1) and b.pernyataan='1' and b.id_jenis_permohonan !='14'
				";
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND b.id_kabkot_bgn = '$id_kabkot' ";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}

	public function GetJmlPbgDinasOtorita($id_kabkot=null)
	{
		$sql = "SELECT
				SUM(CASE  when (b.pernyataan ='1') then 1 else 0 END ) AS Total,
				SUM(CASE  when (b.status between '1' AND '10' and b.pernyataan ='1') then 1 else 0 END ) AS DinasTeknis,
				SUM(CASE  when (b.status between '11' AND '14' and b.pernyataan ='1') then 1 else 0 END ) AS DinasPerizinan,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan ='1') then 1 else 0 END ) AS TelahTerbit,
				SUM(CASE  when (b.status ='25' and b.pernyataan ='1') then 1 else 0 END ) AS Ditolak
				FROM tmdatabangunan b 
				Where(1=1) and b.pernyataan='1' and b.id_jenis_permohonan !='14'
				";
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND b.id_kabkot_bgn = '$id_kabkot' ";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}

	public function GetJmlSLFBalai($id_kabkot=null)
	{
		$sql = "SELECT
				SUM(CASE  when (b.pernyataan ='1') then 1 else 0 END ) AS Total,
				SUM(CASE  when (b.status between '1' AND '10' and b.pernyataan ='1') then 1 else 0 END ) AS DinasTeknis,
				SUM(CASE  when (b.status between '11' AND '14' and b.pernyataan ='1') then 1 else 0 END ) AS DinasPerizinan,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan ='1') then 1 else 0 END ) AS TelahTerbit,
				SUM(CASE  when (b.status ='25' and b.pernyataan ='1') then 1 else 0 END ) AS Ditolak
				FROM tmdatabangunan b 
				Where(1=1) and b.id_jenis_permohonan ='14'
				";
				if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND b.id_prov_bgn = '$id_kabkot' ";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}


	public function GetJmlSLFDinas($id_kabkot=null)
	{
		$sql = "SELECT
				SUM(CASE  when (b.pernyataan ='1') then 1 else 0 END ) AS Total,
				SUM(CASE  when (b.status between '1' AND '10' and b.pernyataan ='1') then 1 else 0 END ) AS DinasTeknis,
				SUM(CASE  when (b.status between '11' AND '14' and b.pernyataan ='1') then 1 else 0 END ) AS DinasPerizinan,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan ='1') then 1 else 0 END ) AS TelahTerbit,
				SUM(CASE  when (b.status ='25' and b.pernyataan ='1') then 1 else 0 END ) AS Ditolak
				FROM tmdatabangunan b 
				Where(1=1) and b.id_jenis_permohonan ='14'
				";
				if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND b.id_kabkot_bgn = '$id_kabkot' ";
		$hasil  = $this->db->query($sql);
		return $hasil->row();
	}

	public function getDataRekapKec($id_kabkot=null)
	{
		$sql = "SELECT a.id_kecamatan, a.nama_kecamatan,b.id_fungsi_bg,
				SUM(CASE  when (b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS Total,
				SUM(CASE  when (b.status between '1' AND '10' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS DinasTeknis,
				SUM(CASE  when (b.status between '11' AND '14' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS DinasPerizinan,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS TelahTerbit,
				SUM(CASE  when (b.status ='25' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS Ditolak,
				SUM(CASE  when (b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS STotal,
				SUM(CASE  when (b.status between '1' AND '10' and b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS SDinasTeknis,
				SUM(CASE  when (b.status between '11' AND '14' and b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS SDinasPerizinan,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS STelahTerbit,
				SUM(CASE  when (b.status ='25' and b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS SDitolak
				FROM tr_kecamatan a 
				LEFT JOIN tmdatabangunan b ON (a.id_kecamatan = b.id_kec_bgn)
				AND b.pernyataan = '1' where(1=1)
				$cari
				GROUP BY a.id_kecamatan
				ORDER BY a.id_kecamatan";
		//echo $sql;
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND b.id_kabkot_bgn = '$id_kabkot' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function getDataKec($id_kabkot=null)
	{
		$sql = "SELECT a.id_kecamatan, a.nama_kecamatan,b.id_fungsi_bg,
				SUM(CASE  when (b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS Total,
				SUM(CASE  when (b.status between '1' AND '10' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS DinasTeknis,
				SUM(CASE  when (b.status between '11' AND '14' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS DinasPerizinan,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS TelahTerbit,
				SUM(CASE  when (b.status ='25' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS Ditolak,
				SUM(CASE  when (b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS STotal,
				SUM(CASE  when (b.status between '1' AND '10' and b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS SDinasTeknis,
				SUM(CASE  when (b.status between '11' AND '14' and b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS SDinasPerizinan,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS STelahTerbit,
				SUM(CASE  when (b.status ='25' and b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS SDitolak
				FROM tr_kecamatan a 
				LEFT JOIN tmdatabangunan b ON (a.id_kecamatan = b.id_kec_bgn)
				AND b.pernyataan = '1' where(1=1) 
			";
		//echo $sql;
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND b.id_kabkot_bgn = '$id_kabkot' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function getDataRekapPBGBaru($cari=null)
	{
		$sql = "SELECT a.id_kabkot, a.nama_kabkota,a.Status_Perda,b.id_fungsi_bg,
				SUM(CASE  when (b.pernyataan = '1') then 1 else 0 END ) AS Permohonan,
				SUM(CASE  when (b.status Between '1' and '3' and b.pernyataan = '1') then 1 else 0 END ) AS Verifikasi,
				SUM(CASE  when (b.status Between '4' and '8' and b.pernyataan = '1') then 1 else 0 END ) AS Konsultasi,
				SUM(CASE  when (b.status Between '9' and '10' and b.pernyataan = '1') then 1 else 0 END ) AS Retribusi,
				SUM(CASE  when (b.status Between '11' and '13' and b.pernyataan = '1') then 1 else 0 END ) AS Pembayaran,
				SUM(CASE  when (b.status ='14' and b.pernyataan = '1') then 1 else 0 END ) AS Kadis,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan = '1') then 1 else 0 END ) AS Diserahkan,
				SUM(CASE  when (b.status = '25' and b.pernyataan = '1') then 1 else 0 END ) AS Ditolak
				FROM tm_akun_dinas a 
				LEFT JOIN tmdatabangunan b ON ( a.id_kabkot = b.id_kabkot_bgn )
				AND b.pernyataan = '1' and b.id_jenis_permohonan !='14' and b.id_kabkot_bgn !='9971' and b.id_kabkot_bgn !='9972' where(1=1)
				$cari
				GROUP BY a.id_kabkot
				ORDER BY a.id_kabkot";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function getDataRekapKecamatan($id_kabkot=null)
	{
		$sql = "SELECT a.id_kecamatan, a.nama_kecamatan,b.id_fungsi_bg,
				SUM(CASE  when (b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS Total,
				SUM(CASE  when (b.status between '1' AND '10' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS DinasTeknis,
				SUM(CASE  when (b.status between '11' AND '14' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS DinasPerizinan,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS TelahTerbit,
				SUM(CASE  when (b.status ='25' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS Ditolak,
				SUM(CASE  when (b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS STotal,
				SUM(CASE  when (b.status between '1' AND '10' and b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS SDinasTeknis,
				SUM(CASE  when (b.status between '11' AND '14' and b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS SDinasPerizinan,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS STelahTerbit,
				SUM(CASE  when (b.status ='25' and b.pernyataan ='1' and b.id_jenis_permohonan ='14') then 1 else 0 END ) AS SDitolak
				FROM tr_kecamatan a 
				LEFT JOIN tmdatabangunan b ON (a.id_kecamatan = b.id_kec_bgn)
				AND b.pernyataan = '1' where(1=1) 
			";
		//echo $sql;
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND b.id_kabkot_bgn = '$id_kabkot' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	//End Model Dashboard Dinas
	
}
