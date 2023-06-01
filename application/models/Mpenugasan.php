<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Mpenugasan extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function get_penugasan_list($counting=0,$dipaging=0,$limit=10,$offset=1,$id=null,$cari=null)
	{
		if (isset($counting) && $counting == 1) 
		{
			$sql = "SELECT COUNT(a.id_permohonan) as total";
		}
		else 
		{
			$sql = "SELECT a.id_permohonan,a.id_jenis_usaha,o.fungsi_bg,a.status_syarat,a.pernyataan,a.id_fungsi_bg,
					a.nomor_registrasi,a.tgl_permohonan,a.no_ktp,a.no_tlp,a.nama_perusahaan,a.alamat_perusahaan,
					a.nama_pemohon,a.alamat_pemohon,a.no_tlp_perusahaan,a.alamat_bg,a.kelurahan,a.kecamatan,
					a.id_jenis_bg,a.jns_bangunan,a.id_prasarana_bg,a.status,a.nib,a.status_penugasan,
					d.nama_permohonan,f.nama_kabkota,
					g.nama_provinsi,j.nama_kabkota as nama_kabkota_bg, 
					k.nama_provinsi as nama_provinsi_bg,z.nama_kecamatan,o.fungsi_bg
				";
		}
		$sql .= "	FROM tm_imb_permohonan a 
						LEFT JOIN tr_imb_permohonan d ON(a.id_jenis_permohonan = d.id_jenis_permohonan)
						LEFT JOIN tr_kabkot f ON(a.id_kabkot=f.id_kabkot)
						LEFT JOIN tr_provinsi g ON(a.id_provinsi=g.id_provinsi)
						LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
						LEFT JOIN tr_kecamatan z ON(a.id_kecamatan=z.id_kecamatan)
						LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
						LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
					WHERE (1=1) AND a.status_syarat = '1' And a.pernyataan = '1' ";
		
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		if (isset($dipaging) && $dipaging ==1)
			$sql .= " Group by a.id_permohonan ORDER BY a.status_penugasan ASC limit $offset, $limit ";
		else 
			$sql .= " Group by a.id_permohonan ORDER BY a.status_penugasan ASC";
		// echo $sql;
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
	
	function get_penugasan_list2($counting=0,$dipaging=0,$limit=10,$offset=1,$id=null,$cari=null)
	{
		if (isset($counting) && $counting == 1) 
		{
			$sql = "SELECT COUNT(a.id_permohonan) as total";
		}
		else 
		{
			$sql = "SELECT a.id_permohonan,a.id_jenis_usaha,a.status_syarat,a.pernyataan,a.id_fungsi_bg,a.nomor_registrasi,a.tgl_permohonan,
					a.nama_pemohon,a.alamat_pemohon,a.no_ktp,a.no_tlp,a.nama_perusahaan,a.alamat_perusahaan,
					a.no_tlp_perusahaan,a.alamat_bg,a.kelurahan,a.kecamatan,a.id_jenis_bg,a.jns_bangunan,a.id_prasarana_bg,a.status,

				d.nama_permohonan, e.nama_kementerian, f.nama_kabkota, g.nama_provinsi,j.nama_kabkota as nama_kabkota_bg, 
				k.nama_provinsi as nama_provinsi_bg,
				z.nama_kecamatan,o.fungsi_bg
				";
		}
		$sql .= "	FROM tm_imb_permohonan a 
						LEFT JOIN tr_imb_permohonan d ON(a.id_jenis_permohonan = d.id_jenis_permohonan)
						LEFT JOIN tr_kementerian e ON(a.id_kementerian=e.id_kementerian)
						LEFT JOIN tr_kabkot f ON(a.id_kabkot=f.id_kabkot)
						LEFT JOIN tr_provinsi g ON(a.id_provinsi=g.id_provinsi)
						
						LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
						LEFT JOIN tr_kecamatan z ON(a.id_kecamatan=z.id_kecamatan)
						LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
						LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
					WHERE (1=1) AND a.status_syarat = '1' ";
		
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		if (isset($dipaging) && $dipaging ==1)
			$sql .= " Group by a.id_permohonan ORDER BY a.id_permohonan DESC limit $offset, $limit ";
		else 
			$sql .= " Group by a.id_permohonan ORDER BY a.id_permohonan DESC";
		// echo $sql;
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
	
	function get_permohonan($id=null,$cari=null)
	{
		$sql = "SELECT a.*, b.*
		FROM tm_imb_permohonan a
		left join tr_imb_permohonan b on (a.id_jenis_permohonan = b.id_jenis_permohonan)
		WHERE (1=1) ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_tabg_list($id=null,$cari=null,$idkota=null)
	{
		$sql = "SELECT a.*, b.nama_provinsi, c.nama_kabkota,  g.dir_file, f.nama_jenjang, l.nama_jurusan, k.nama_unsur,
				m.nama_keahlian, i.nama_unsur_ahli, n.nama_bidang
				FROM tm_personal a
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
				WHERE (1=1) and a.stat = '1' and a.id_kota_tabg = '$idkota'
			";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_personal='$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " AND a.nama_personal LIKE '%$cari%' ";
		$sql .= " Group BY a.id_personal ORDER BY a.id_personal ASC";
		// echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;		
	}
	
	function get_tabg_list2($id=null,$cari=null,$idkota=null)
	{
		$sql = "SELECT a.*, b.nama_provinsi, c.nama_kabkota, g.dir_file, f.nama_jenjang, l.nama_jurusan, k.nama_unsur, m.nama_keahlian,
		i.nama_unsur_ahli, n.nama_bidang, year(CURDATE()) as tahun
				FROM tm_personal a 
				LEFT JOIN tm_sk_tabg_detail x on (a.id_personal=x.id_personal)
				LEFT JOIN tm_sk_tabg y on (x.id_sk_tabg=y.id_sk_tabg)
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
				WHERE (1=1) AND a.id_personal in (SELECT id_personal FROM tm_sk_tabg_detail)
				AND y.untuk_tahun= year(CURDATE()) and y.id_kabkot = '$idkota'";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_personal='$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " AND a.nama_personal LIKE '%$cari%'  ";
		$sql .= " Group BY a.id_personal ORDER BY a.id_personal ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;		
	}
	
	
	function get_data_penugasan($id_permohonan=null)
	{
		$sql = "SELECT a.*,
				x.id_penugasan,x.id_permohonan,x.sidang_ke, 
				b.nama_provinsi, 
				c.nama_kabkota,  
				g.dir_file, 
				f.nama_jenjang,
				l.nama_jurusan, 
				k.nama_unsur, 
				m.nama_keahlian, 
				i.nama_unsur_ahli, 
				n.nama_bidang,
				h.nomor_registrasi
				FROM tm_imb_penugasan x 
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
				LEFT JOIN tm_imb_permohonan h on (x.id_permohonan=h.id_permohonan)
				WHERE (1=1) ";
		
		if ($id_permohonan != null || trim($id_permohonan) != '')  $sql .= " AND x.id_permohonan='$id_permohonan' ";
		
		$sql .= " Group BY a.id_personal ORDER BY a.id_personal ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;	
	
	}
	
	function delete_data_penugasan($id_permohonan=null)
	{
		$this->db->delete('tm_imb_penugasan',array('id_permohonan'=>$id_permohonan));
	}
	
	function insert_data_penugasan($dataPeg)
	{
		$this->db->insert('tm_imb_penugasan',$dataPeg);
	}
	
	function get_email_list($id_permohonan=null)
	{
		$sql = "SELECT a.id_personal,b.email,b.nama_personal ";
		$sql .= " FROM tm_imb_penugasan a 
					left join tm_personal b on (a.id_personal = b.id_personal) 
					WHERE (1=1) AND b.email != '' 
				";
		
		if ($id_permohonan != null || trim($id_permohonan) != '')  $sql .= " AND a.id_permohonan = '$id_permohonan' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_tim_teknis_list($id=null,$cari=null,$idkota=null)
	{
		$sql = "SELECT a.*, b.nama_provinsi, c.nama_kabkota, g.dir_file, f.nama_jenjang, l.nama_jurusan, k.nama_unsur,
		m.nama_keahlian, i.nama_unsur_ahli, n.nama_bidang
				FROM tm_personal a
				LEFT JOIN tm_sk_tim_teknis_detail x on (a.id_personal=x.id_personal)
				LEFT JOIN tm_sk_tim_teknis y on (x.id_sk_tabg=y.id_sk_tabg)
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
				
				WHERE (1=1)  AND a.id_personal in (SELECT id_personal FROM tm_sk_tim_teknis_detail)
				AND y.untuk_tahun= year(CURDATE()) and y.id_kabkot = '$idkota'";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_personal='$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " AND a.nama_personal LIKE '%$cari%' ";
		$sql .= " Group BY a.id_personal ORDER BY a.id_personal ASC";
		// echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;		
	}
	
}
 
