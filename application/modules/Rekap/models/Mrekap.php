<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mrekap extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	public function getDataMonitoringIMB()
	{
		$tot = $this->session->userdata('loc_id_kabkot');
		$dev = $this->session->userdata('loc_role_id');
		$sero=null;
		$this->db->select('*');
		$this->db->from('tm_imb_permohonan'); //memeilih tabel
		$this->db->where('pernyataan >= 1');
		$this->db->where("status_progress >= 1 ");
		//$this->db->where('status_penugasan < 1');
		if ($dev != 1)  $this->db->where('id_kabkot_bg',$tot);
		$this->db->join('tr_imb_permohonan', 'tm_imb_permohonan.id_jenis_permohonan = tr_imb_permohonan.id_jenis_permohonan'); 
		$this->db->join('tr_fungsi_bg', 'tm_imb_permohonan.id_fungsi_bg = tr_fungsi_bg.id_fungsi_bg');
		$this->db->join('simbg_status', 'simbg_status.kode_status = tm_imb_permohonan.status_progress'); 
		//$this->db->order_by('tm_imb_permohonan.id_permohonan','desc');
		$this->db->order_by('tm_imb_permohonan.status_progress','asc');
		
		$query = $this->db->get(); //simpan database yang udah di get alias ambil ke query
		return $query; //hasil dari semua proses ada dimari
	}
	
	function getDataPermohonan($counting=0,$dipaging=0,$limit=10,$offset=1,$id_kabkot=null,$cari=null)
	{
		if (isset($counting) && $counting == 1)
		{
			$sql = "SELECT COUNT(a.id_permohonan) as total";
		}
		else
		{
			$sql = "SELECT a.id_permohonan,a.status_progress,a.nama_pemohon,a.alamat_bg,a.nomor_registrasi,f.retribusi_manual,b.nama_permohonan,g.no_imb,h.fungsi_bg
				";
		}
		$sql .= "	FROM tm_imb_permohonan a
					LEFT JOIN tr_imb_permohonan b ON(a.id_jenis_permohonan = b.id_jenis_permohonan)
					LEFT JOIN tr_kecamatan c ON(a.id_kec_bg=c.id_kecamatan)
					LEFT JOIN tr_kabkot d ON(a.id_kabkot_bg=d.id_kabkot)
					LEFT JOIN tr_provinsi e ON(a.id_provinsi_bg=e.id_provinsi)
					LEFT JOIN tm_penetapan_retribusi f ON(f.id_permohonan=a.id_permohonan)
					LEFT JOIN tm_imb_penerbitan g ON(g.id_permohonan=a.id_permohonan)
					LEFT JOIN tr_fungsi_bg h ON (h.id_fungsi_bg = a.id_fungsi_bg)
					WHERE (1=1)  AND a.pernyataan ='1' AND a.status_progress >= 14";
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND a.id_kabkot_bg = '$id_kabkot' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		if (isset($dipaging) && $dipaging ==1)
			$sql .= " Group by a.id_permohonan ORDER BY a.status_syarat ASC limit $offset, $limit ";
		else
			$sql .= " Group by a.id_permohonan ORDER BY a.status_syarat ASC";
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
	
	public function get_rekap_fungsi_bg($cari=null)
	{
		$sql = "SELECT a.id_kabkot, a.nama_kabkota,b.id_fungsi_bg,
				SUM(CASE  when (b.nib !='') then 1 else 0 END ) AS Memiliki_NIB,
				SUM(CASE  when (b.nib ='0') then 1 else 0 END ) AS Memiliki_NIB2,
				SUM(CASE  when (b.nib is null) then 1 else 0 END ) AS Non_NIB1,
				SUM(CASE  when (b.nib ='') then 1 else 0 END ) AS Non_NIB2
				FROM tr_kabkot a 
				LEFT JOIN tm_imb_permohonan b ON ( a.id_kabkot = b.id_kabkot_bg )
				Where (a.id_kabkot)  AND b.pernyataan = '1'
				$cari
				GROUP BY a.id_kabkot";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	public function getDataRekapSlf($cari=null)
	{
		$sql = "SELECT a.id_kabkot, a.nama_kabkota,b.id_fungsi_bg,
				SUM(CASE  when (b.nib !='') then 1 else 0 END ) AS Memiliki_NIB,
				SUM(CASE  when (b.nib ='0') then 1 else 0 END ) AS Memiliki_NIB2,
				SUM(CASE  when (b.nib is null) then 1 else 0 END ) AS Non_NIB1,
				SUM(CASE  when (b.nib ='') then 1 else 0 END ) AS Non_NIB2
				FROM tr_kabkot a 
				LEFT JOIN tm_slf_permohonan b ON ( a.id_kabkot = b.id_kabkot_bg )
				Where (a.id_kabkot)  AND b.status_pernyataan = '1'
				$cari
				GROUP BY a.id_kabkot";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	//Begin Rekap PBG
	public function  getDataRekapPBG()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmDataPemilik as a,tr_konsultasi as b,tmDataBangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 1 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function getPenugasanAll($dateOne, $dateTwo)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
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
	//End Rekap PBG
	//Begin Rekap Bangunan Eksisting
	public function getDataRekapEks($cari=null)
	{
		$sql = "SELECT a.id_kabkot, a.nama_kabkota,b.id_fungsi_bg,
				SUM(CASE  when (b.status Between '1' and '2') then 1 else 0 END ) AS Verifikasi,
				SUM(CASE  when (b.status Between '3' and '10') then 1 else 0 END ) AS DinTek,
				SUM(CASE  when (b.status Between '13' and '16') then 1 else 0 END ) AS DinPen,
				SUM(CASE  when (b.status >='16') then 1 else 0 END ) AS Diserahkan
				FROM tm_akun_dinas a 
				LEFT JOIN tmdatabangunan b ON ( a.id_kabkot = b.id_kabkot_bgn )
				AND b.pernyataan = '1' and b.id_jenis_permohonan ='14'  where(1=1)
				$cari
				GROUP BY a.id_kabkot";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	//End Rekap Bangunan Eksisting
	//Begin Rekap PBG Bangunan Baru
	public function getDataRekapPBGBaru($cari=null)
	{
		$sql = "SELECT a.id_kabkot, a.nama_kabkota,a.Status_Perda,b.id_fungsi_bg,
				SUM(CASE  when (b.pernyataan = '1') then 1 else 0 END ) AS Permohonan, 
				SUM(CASE  when (b.status Between '1' and '3' and b.pernyataan = '1') then 1 else 0 END ) AS Verifikasi,
				SUM(CASE  when (b.status Between '4' and '8' and b.pernyataan = '1') then 1 else 0 END ) AS Konsultasi,
				SUM(CASE  when (b.status Between '9' and '10' and b.pernyataan = '1') then 1 else 0 END ) AS Retribusi,
				SUM(CASE  when (b.status Between '11' and '12' and b.pernyataan = '1') then 1 else 0 END ) AS Pembayaran,
				SUM(CASE  when (b.status ='13' and b.pernyataan = '1') then 1 else 0 END ) AS ValidasiPembayaran,
				SUM(CASE  when (b.status ='14' and b.pernyataan = '1') then 1 else 0 END ) AS Kadis,
				SUM(CASE  when (b.status between '15' AND '24' and b.pernyataan = '1') then 1 else 0 END ) AS Diserahkan,
				SUM(CASE  when (b.status = '25' and b.pernyataan = '1') then 1 else 0 END ) AS Ditolak
				FROM tm_akun_dinas a 
				LEFT JOIN tmdatabangunan b ON ( a.id_kabkot = b.id_kabkot_bgn )
				AND b.pernyataan = '1' and b.id_jenis_permohonan !='14' and b.id_kabkot_bgn !='9971' and b.id_kabkot_bgn !='9972' 
				where(1=1)
				$cari
				GROUP BY a.id_kabkot
				ORDER BY a.id_kabkot";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	//End Rekap PBG Bangunan Baru
	//Begin Rekap id_provinsi
	public function getDataRekapProv($cari=null)
	{
		$sql = "SELECT a.id_provinsi, a.nama_provinsi,b.id_fungsi_bg,
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
				FROM tm_prov a 
				LEFT JOIN tmdatabangunan b ON (a.id_provinsi = b.id_prov_bgn)
				AND b.pernyataan = '1' where(1=1)
				$cari
				GROUP BY a.id_provinsi
				ORDER BY a.id_provinsi";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function getDataRekapKab($cari=null)
	{
		$sql = "SELECT a.id_kabkot, a.nama_kabkota,b.id_fungsi_bg,a.Status_perda,a.status_teknis,a.status_perizinan,
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
				FROM tm_akun_dinas a 
				LEFT JOIN tmdatabangunan b ON (a.id_kabkot = b.id_kabkot_bgn)
				AND b.pernyataan = '1' and b.id_kabkot_bgn !='9971' and b.id_kabkot_bgn !='9972' where(1=1)
				$cari
				GROUP BY a.id_kabkot
				ORDER BY a.id_kabkot";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function getDataRekapKabBulan($cari=null)
	{
		$sql = "SELECT a.id_kabkot, a.nama_kabkota,b.id_fungsi_bg,a.Status_perda,a.status_teknis,a.status_perizinan,
				SUM(CASE  when (b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS Total,
				SUM(CASE  when (b.status between '1' AND '2' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS VerifikasiDokumen,
				SUM(CASE  when (b.status  ='3' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS Dikembalikan,
				
				SUM(CASE  when (b.status between '4' AND '10' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS Konsultasi,
				SUM(CASE  when (b.status between '11' AND '13' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS Retribusi,
				SUM(CASE  when (b.status between '14' AND '21' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS Terbit,
				SUM(CASE  when (b.status ='25' and b.pernyataan ='1' and b.id_jenis_permohonan !='14') then 1 else 0 END ) AS Ditolak
				
				FROM tm_akun_dinas a 
				LEFT JOIN tmdatabangunan b ON (a.id_kabkot = b.id_kabkot_bgn)
				AND b.pernyataan = '1' and b.id_kabkot_bgn !='9971' and b.id_kabkot_bgn !='9972'  and b.tgl_pernyataan between '2022-12-01' and '2022-12-31' where(1=1)
				$cari
				GROUP BY a.id_kabkot
				ORDER BY a.id_kabkot";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	

	
	//End Rekap provinsi
	//Begin Data TPA
	public function getDataRekapTPA($cari=null)
	{
		$sql = "SELECT a.id_kabkot, a.nama_kabkota,
				SUM(CASE  when (b.status = '1' and b.id_lembaga='1') then 1 else 0 END ) AS AkaCalon,
				SUM(CASE  when (b.status Between '3' and '5' and b.id_lembaga='1') then 1 else 0 END ) AS AkaTpa,
				SUM(CASE  when (b.status = '1' and b.id_lembaga='3') then 1 else 0 END ) AS AsoCalon,
				SUM(CASE  when (b.status Between '3' and '5' and b.id_lembaga='3') then 1 else 0 END ) AS AsoTpa,
				SUM(CASE  when (b.status = '1' and b.id_lembaga='2') then 1 else 0 END ) AS PakarCalon,
				SUM(CASE  when (b.status Between '3' and '5' and b.id_lembaga='2') then 1 else 0 END ) AS PakarTpa
			
				FROM tr_kabkot a 
				LEFT JOIN tm_tpa b ON ( a.id_kabkot = b.id_kabkot )
				Where (a.id_kabkot)  AND b.status >= '1'  and a.id_kabkot !='9971' and a.id_kabkot !='9972' and b.status !='2'
				$cari
				GROUP BY a.id_kabkot
				ORDER BY a.id_kabkot";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function getDataRekapTPAPerProv($cari=null)
	{
		$sql = "SELECT a.id_provinsi, a.nama_provinsi,
				SUM(CASE  when (b.status = '1') then 1 else 0 END ) AS BelumVer,
				SUM(CASE  when (b.status Between '3' and '4') then 1 else 0 END ) AS SudahVer,
				SUM(CASE  when (b.status = '5') then 1 else 0 END ) AS Pemda
				FROM tr_provinsi a 
				LEFT JOIN tm_tpa b ON ( a.id_provinsi = b.id_provinsi )
				Where (a.id_provinsi)  AND b.status >= '1'  and a.id_provinsi !='99' and b.status !='2'
				$cari
				GROUP BY a.id_provinsi
				ORDER BY a.id_provinsi";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function getDataRekapTPAPerAso($cari=null)
	{
		$sql = "SELECT a.id, a.nm_asosiasi,
				SUM(CASE when (c.status >= '1') then 1 else 0 END ) AS Total,
				SUM(CASE when (c.status = '1') then 1 else 0 END ) AS BlmVer,
				SUM(CASE when (c.status = '2') then 1 else 0 END ) AS Dikembalikan,
				SUM(CASE when (c.status >= '3') then 1 else 0 END ) AS SdhVer
				FROM tr_asosiasi a 
				LEFT JOIN tm_tpadokumen b ON (b.id_asak = a.id)
				LEFT JOIN tm_tpa c ON (c.id = b.id)
				Where (a.id) and a.group ='1'
				$cari
				GROUP BY a.id
				ORDER BY a.id";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function getDataRekapTPAPerUni($cari=null)
	{
		$sql = "SELECT a.id, a.nm_asosiasi,
				SUM(CASE when (c.status >= '1') then 1 else 0 END ) AS Total,
				SUM(CASE when (c.status = '1') then 1 else 0 END ) AS BlmVer,
				SUM(CASE when (c.status = '2') then 1 else 0 END ) AS Dikembalikan,
				SUM(CASE when (c.status >= '3') then 1 else 0 END ) AS SdhVer
				FROM tr_asosiasi a 
				LEFT JOIN tm_tpadokumen b ON (b.id_asak = a.id)
				LEFT JOIN tm_tpa c ON (c.id = b.id)
				Where (a.id) and a.group ='2'
				$cari
				GROUP BY a.id
				ORDER BY a.id";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function  getListValidasitor($SQLcari = '')
	{
		//$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,d.nm_asosiasi ');
		$this->db->from('tm_tpa a');
		$this->db->where("a.status >= 1 ");
		//$this->db->where('b.id_kabkot_bgn', $Dinas);
		$this->db->join('tm_tpadokumen c', 'a.id = c.id', 'LEFT');
		$this->db->join('tr_status_tpa b', 'b.id = a.status', 'LEFT');
		$this->db->join('tr_asosiasi d', 'd.id = c.id_asak', 'LEFT');
		/*$this->db->join('tr_kabkot e', 'a.id_kabkota = e.id_kabkot', 'LEFT');
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
		$this->db->order_by('a.id', 'asc');
		$query = $this->db->get();
		return $query;
	}
	//End Data TPA
	//Begin Data Akun Dinas
	public function getDataDinas()
	{
		$sql = "SELECT a.*
				FROM tm_akun_dinas a 
				Where (1=1)
				ORDER BY a.id_kabkot";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function getDataAkunDinas($id)
	{
		$this->db->select('a.*');
		$this->db->from('tm_akun_dinas a');
		$this->db->where('a.id_kabkot', $id);
		$query = $this->db->get();
		return $query;
	}
	//End Data Akun Dinas

	public function  getListTpa($SQLcari = '')
	{
		$this->db->select('a.id,a.glr_depan,a.nm_tpa,a.glr_blkg,a.alamat,a.no_kontak,a.email
		');
		$this->db->from('tm_tpa a');
		$this->db->where("a.status >= 3 ");
		
		$this->db->order_by('a.status', 'asc');
		$query = $this->db->get();
		return $query;
	}
}
	
