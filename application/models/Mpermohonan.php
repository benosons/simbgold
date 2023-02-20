<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpermohonan extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_jenis_pelayanan_list($id=null,$nama_permohonan=null)
	{
		if ($id != null || trim($id) != '')
			$this->db->where('id_jenis_permohonan',$id);
		if ($nama_permohonan != null || trim($nama_permohonan) != '')
			$this->db->like('nama_permohonan',$nama_permohonan,'both');

		$this->db->order_by('id_jenis_permohonan','asc');
		$hasil =  $this->db->get('tr_imb_permohonan');
		return $hasil;
	}

	function get_email($id=null)
	{
		$sql = "SELECT a.id_permohonan,a.email,a.nomor_registrasi
		FROM tm_imb_permohonan a
		WHERE (1=1) ";

		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function getDataPemohon($id=null)
	{
		$sql = "SELECT a.id_permohonan,a.id_user,a.id_jenis_permohonan,a.id_kecamatan,a.luas_bg,
				a.id_kabkot,a.id_provinsi,a.nama_pemohon,a.alamat_pemohon,a.no_tlp,a.no_hp_pemohon,a.email,a.no_ktp,
				a.jabatan_perusahaan,a.npwp_perseroan,a.nama_perusahaan,a.alamat_perusahaan,a.no_tlp_perusahaan,a.alamat_bg,a.kelurahan,
				a.kecamatan,a.id_jenis_usaha,a.status,a.id_kec_bg,a.id_kabkot_bg,a.id_provinsi_bg,a.status_syarat,a.id_fungsi_bg,a.luas_bg,a.tinggi_bg,
				a.lantai_bg,a.id_dok_tek,a.id_pemanfaatan_bg,a.id_kolektif,a.id_jenis_bg,a.id_prasarana_bg,a.id_klasifikasi_bg,
				a.jns_bangunan,a.pernyataan,a.tinggi_prasarana,nomor_registrasi,a.nama_bangunan,a.luas_basement,a.lapis_basement,a.id_kec_badan,
				a.id_kabkot_badan,a.id_provinsi_badan,a.nib,id_kec_peng,update_oss_data_id_detail,a.update_oss_data_id_checklist,a.kd_izin,status_penugasan,
					c.nama_permohonan,c.lama_proses,
					e.nama_kabkota,
					f.nama_provinsi,
					i.nama_kecamatan,
					j.nama_kabkota as nama_kabkota_bg,
					k.nama_provinsi as nama_provinsi_bg,
					u.nama_kecamatan as kec_badan,
					s.nama_kabkota as nama_kabkota_badan,
					t.nama_provinsi as nama_provinsi_badan,
					v.nama_kecamatan as nama_kec_bg,
					o.fungsi_bg,o.id_pemanfaatan_bg as id_pemanfaatan_bg2,
					p.klasifikasi_bg,
					x.tgl_pemberitahuan
			FROM tm_imb_permohonan a
						LEFT JOIN tm_status_permohonan x ON(x.id_permohonan=a.id_permohonan)
						LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
						LEFT JOIN tr_klasifikasi_bg p ON(p.id_klasifikasi_bg=a.id_klasifikasi_bg)
						LEFT JOIN tr_kabkot s ON (s.id_kabkot =a.id_kabkot_badan)
						LEFT JOIN tr_provinsi t ON (t.id_provinsi = a.id_provinsi_badan)
						LEFT JOIN tr_kecamatan u ON (u.id_kecamatan = a.id_kec_badan)
						LEFT JOIN tr_imb_permohonan c ON(a.id_jenis_permohonan = c.id_jenis_permohonan)
						LEFT JOIN tr_kabkot e ON(e.id_kabkot=a.id_kabkot)
						LEFT JOIN tr_provinsi f ON(a.id_provinsi=f.id_provinsi)
						LEFT JOIN tr_kecamatan i ON(a.id_kecamatan=i.id_kecamatan)
						LEFT JOIN tr_kecamatan v ON(a.id_kec_bg = v.id_kecamatan)
						LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
						LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
		
					WHERE (1=1)";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		
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
	
	function getDataEmail($id=null)
	{
		$sql = "SELECT a.id_permohonan,a.email,a.nomor_registrasi
				FROM tm_imb_permohonan a
				WHERE (1=1)";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
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

	function get_permohonan_list($counting=0,$dipaging=0,$limit=10,$offset=1,$id=null,$cari=null)
	{
		if (isset($counting) && $counting == 1)
		{
			$sql = "SELECT COUNT(a.id_permohonan) as total";
		}
		else
		{
			$sql = "SELECT a.*,
					c.nama_permohonan,c.lama_proses,
					e.nama_kabkota,
					f.nama_provinsi,
					i.nama_kecamatan,
					j.nama_kabkota as nama_kabkota_bg,
					k.nama_provinsi as nama_provinsi_bg,
					l.*,
					u.nama_kecamatan as kec_badan,
					s.nama_kabkota as nama_kabkota_badan,
					t.nama_provinsi as nama_provinsi_badan,
					v.nama_kecamatan as nama_kec_bg,
					o.fungsi_bg,o.id_pemanfaatan_bg as id_pemanfaatan_bg2,
					p.klasifikasi_bg,
					x.tgl_pemberitahuan
				";
		}
		$sql .= "	FROM tm_imb_permohonan a
						LEFT JOIN tm_status_permohonan x ON(x.id_permohonan=a.id_permohonan)
						LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
						LEFT JOIN tr_klasifikasi_bg p ON(p.id_klasifikasi_bg=a.id_klasifikasi_bg)
						LEFT JOIN tr_kabkot s ON (s.id_kabkot =a.id_kabkot_badan)
						LEFT JOIN tr_provinsi t ON (t.id_provinsi = a.id_provinsi_badan)
						LEFT JOIN tr_kecamatan u ON (u.id_kecamatan = a.id_kec_badan)
						LEFT JOIN tr_imb_permohonan c ON(a.id_jenis_permohonan = c.id_jenis_permohonan)
						LEFT JOIN tr_kabkot e ON(e.id_kabkot=a.id_kabkot)
						LEFT JOIN tr_provinsi f ON(a.id_provinsi=f.id_provinsi)
						LEFT JOIN tr_kecamatan i ON(a.id_kecamatan=i.id_kecamatan)
						LEFT JOIN tr_kecamatan v ON(a.id_kec_bg = v.id_kecamatan)
						LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
						LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
						LEFT JOIN tm_imb_kolektif l ON(l.id_permohonan = a.id_permohonan)
		
					WHERE (1=1)   ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		if (isset($dipaging) && $dipaging ==1)
			$sql .= " Group by a.id_permohonan ORDER BY a.id_jenis_permohonan DESC limit $offset, $limit ";
		else
			$sql .= " Group by a.id_permohonan ORDER BY a.id_jenis_permohonan DESC";
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

	function get_detail_imb($id=null)
	{
		$sql = "SELECT a.*,
				c.nama_permohonan,c.id_klasifikasi_bg,
				e.nama_kabkota,
				f.nama_provinsi,
				g.nama_kecamatan as nama_kecamatan_bg,
				i.nama_kecamatan, 
				j.nama_kabkota as nama_kabkota_bg, 
				k.nama_provinsi as nama_provinsi_bg,
				l.*,
				m.no_imb,m.id_penerbitan_imb,m.tgl_imb,m.dir_file_imb,
				o.fungsi_bg,o.id_pemanfaatan_bg as id_pemanfaatan_bg2,q.luas_tanah,q.atas_nama_dok,x.retribusi,x.retribusi_manual,z.username
				";
		$sql .= "	FROM tm_imb_permohonan a
						LEFT JOIN tm_imb_penerbitan m ON(m.id_permohonan = a.id_permohonan)
						LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
						LEFT JOIN tm_imb_tanah q ON(q.id_permohonan=a.id_permohonan)
						LEFT JOIN tr_imb_permohonan c ON(a.id_jenis_permohonan = c.id_jenis_permohonan)
						LEFT JOIN tr_kabkot e ON(e.id_kabkot=a.id_kabkot)
						LEFT JOIN tr_provinsi f ON(a.id_provinsi=f.id_provinsi)
						LEFT JOIN tr_kecamatan g ON(a.id_kec_bg = g.id_kecamatan)
						LEFT JOIN tr_kecamatan i ON(a.id_kecamatan=i.id_kecamatan)
						LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
						LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
						LEFT JOIN tm_imb_kolektif l ON(l.id_permohonan = a.id_permohonan)
						LEFT JOIN tm_penetapan_retribusi x ON(x.id_permohonan=a.id_permohonan)
						LEFT JOIN tm_user z ON (z.id=a.id_user)
					WHERE (1=1)";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		
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

	function get_permohonan($id=null,$cari=null)
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

	function get_permohonan2($id=null,$cari=null)
	{
		$sql = "SELECT b.*
		FROM tr_imb_permohonan b
		WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";

		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_dtail_tanah($id=null,$id_permohonan_detail_tanah=null)
	{
		$sql = "SELECT a.*, b.jenis_dokumen, c.*, d.*, e.*   
				FROM tm_imb_tanah a
				left join tr_dokumen b on (a.id_dokumen = b.id_dokumen)
				left join tr_kecamatan c on (a.id_kecamatan = c.id_kecamatan)
				left join tr_kabkot d on (a.id_kabkot = d.id_kabkot)
				left join tr_provinsi e on (a.id_provinsi = e.id_provinsi)
					WHERE (1=1) ";

		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		if ($id_permohonan_detail_tanah != null || trim($id_permohonan_detail_tanah) != '')  $sql .= " AND a.id_permohonan_detail_tanah = '$id_permohonan_detail_tanah' ";

		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	function get_syarat_list_master($per=null,$kls=null)
	{
		$sql = "SELECT a.*  
					FROM tr_persyaratan a
					left join tm_imb_permohonan b on (a.id_jenis_permohonan = b.id_jenis_permohonan)
					left join tm_permohonan_bg_detail c on (a.klasifikasi_bg = c.id_klasifikasi_bg)
					WHERE (1=1) ";

		if ($per != null || trim($per) != '')  $sql .= " AND b.id_jenis_permohonan = '$per' ";
		if ($kls != null || trim($kls) != '')  $sql .= " AND c.klasifikasi_bg = '$kls' ";

		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function cek_syarat_list_sudah_dipilih($persyaratan=null,$id_permohonan=null)
	{
		$sql = "SELECT * FROM tm_permohonan_bg_syarat WHERE (1=1) AND id_permohonan = '$id_permohonan'";

		if ($persyaratan != null || trim($persyaratan) != '')  $sql .= " AND id_persyaratan = '$persyaratan' ";


		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function get_provinsi_list($id=null,$provinsi=null)
	{
		if ($id != null || trim($id) != '')
			$this->db->where('id_provinsi',$id);
		if ($provinsi != null || trim($provinsi) != '')
			$this->db->like('nama_provinsi',$provinsi,'both');

		$this->db->order_by('id_provinsi','asc');
		$hasil =  $this->db->get('tr_provinsi');
		return $hasil;
	}

	function get_kabupaten_list($id=null,$kabupaten=null,$idprovinsi=null)
	{
		$sql = "SELECT a.*, b.nama_provinsi
				FROM tr_kabkot a
					LEFT JOIN tr_provinsi b on (a.id_provinsi=b.id_provinsi)
				WHERE 1=1 ";

		if ($id != null || trim($id) != '')  $sql .= " AND a.id_kabkot = '$id' ";
		if ($kabupaten != null || trim($kabupaten) != '')  $sql .= " AND a.nama_kabkota LIKE '%$kabupaten%' ";
		if ($idprovinsi != null || trim($idprovinsi) != '')  $sql .= " AND a.id_provinsi = '$id_provinsi' ";

		$sql .= ' ORDER BY a.id_provinsi';

		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function get_klasifikasi_bg($id=null,$kalsifikasi_bg=null)
	{
		if ($id != null || trim($id) != '')
			$this->db->where('id_klasifikasi_bg',$id);
		if ($kalsifikasi_bg != null || trim($kalsifikasi_bg) != '')
			$this->db->like('kalsifikasi_bg',$kalsifikasi_bg,'both');

		$this->db->order_by('id_klasifikasi_bg','asc');
		$hasil =  $this->db->get('tr_klasifikasi_bg');
		return $hasil;
	}

	function get_kecamatan_list($id=null,$kecamatan=null,$kabkot=null,$nama_kabkota=null)
	{
		$sql = "SELECT a.*, b.*, c.*
				FROM tr_kecamatan a
					LEFT JOIN tr_kabkot b on (a.id_kabkot=b.id_kabkot)
					LEFT JOIN tr_provinsi c on (c.id_provinsi=b.id_provinsi)
				WHERE 1=1 ";

		if ($id != null || trim($id) != '')  $sql .= " AND a.id_kecamatan = '$id' ";
		if ($kecamatan != null || trim($kecamatan) != '')  $sql .= " AND a.nama_kecamatan LIKE '%$kecamatan%' ";
		if ($kabkot != null || trim($kabkot) != '')  $sql .= " AND a.id_kabkot = '$kabkot' ";
		if ($nama_kabkota != null || trim($nama_kabkota) != '')  $sql .= " AND b.nama_kabkota LIKE '%$nama_kabkota%' ";
		$sql .= ' ORDER BY a.id_kabkot';

		$hasil  = $this->db->query($sql);
		return $hasil;
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
	
	public function getDataUserIMB($select="a.*",$id='')
	{
		$this->db->select($select,FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id_permohonan',$id);
		//$this->db->join('tm_imb_kolektif b','a.id_permohonan = b.id_permohonan','LEFT');
		$query 	= $this->db->get('tm_imb_permohonan a')->row();
		return $query;

	}

	function get_dokumen_list($id=null,$jenis_dokumen=null)
	{
		if ($id != null || trim($id) != '')
			$this->db->where('id_dokumen',$id);
		if ($jenis_dokumen != null || trim($jenis_dokumen) != '')
			$this->db->like('jenis_dokumen',$jenis_dokumen,'both');

		$this->db->order_by('id_dokumen','asc');
		$hasil =  $this->db->get('tr_dokumen');
		return $hasil;
	}

	function get_syarat_list_detail($per=null,$kls=null,$id_jenis_usaha=null)
	{
		$sql = "SELECT a.id_persyaratan,a.id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,
				b.id_persyaratan_detail,b.id_syarat,c.nama_syarat,d.status_syarat
				FROM tr_persyaratan2 a
					LEFT JOIN tr_persyaratan2_detail b ON(a.id_persyaratan=b.id_persyaratan)
					LEFT JOIN tr_imb_syarat c ON(b.id_syarat=c.id_syarat)
					LEFT JOIN tm_imb_permohonan d ON(a.id_jenis_permohonan=d.id_jenis_permohonan)
				WHERE (1=1)";

		if ($per != null || trim($per) != '')  $sql .= " AND a.id_jenis_permohonan = '$per' ";
		if ($kls != null || trim($kls) != '')  $sql .= " AND a.id_jenis_persyaratan = '$kls' ";
		if ($id_jenis_usaha == 1 || trim($id_jenis_usaha) == '1')  $sql .= " AND (b.id_syarat != '3' AND b.id_syarat != '4')";

		$sql .= " Group by b.id_persyaratan_detail ORDER BY a.id_jenis_permohonan, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat ASC ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function get_syarat_list($per=null,$kls=null,$id_jenis_usaha=null,$luas_bg=null,$status=null)
	{
		$sql = "SELECT a.id_persyaratan,a.id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,
				b.id_persyaratan_detail,b.id_syarat,c.nama_syarat,c.status,d.status_syarat,d.luas_bg
				FROM tr_persyaratan2 a
					LEFT JOIN tr_persyaratan2_detail b ON(a.id_persyaratan=b.id_persyaratan)
					LEFT JOIN tr_imb_syarat c ON(b.id_syarat=c.id_syarat)
					LEFT JOIN tm_imb_permohonan d ON(a.id_jenis_permohonan=d.id_jenis_permohonan)
				WHERE (1=1) AND c. status !='2'
				";

		if ($per != null || trim($per) != '')  $sql .= " AND a.id_jenis_permohonan = '$per' ";
		if ($kls != null || trim($kls) != '')  $sql .= " AND a.id_jenis_persyaratan = '$kls' ";
		if ($id_jenis_usaha == 1 || trim($id_jenis_usaha) == '1')  $sql .= " AND (b.id_syarat != '3' AND b.id_syarat != '4')";
		if ($luas_bg != null || trim($luas_bg) != ''){
			if($luas_bg <= 5000){
				$sql .= " AND (b.id_syarat != '44' AND b.id_syarat != '43') ";
			}else if($luas_bg > 5000 && $luas_bg <= 10000){
				$sql .= " AND (b.id_syarat != '43' AND b.id_syarat != '46') ";
			}else if($luas_bg > 10000){
				$sql .= " AND (b.id_syarat != '44' AND b.id_syarat != '46') ";
			}
		}

		$sql .= " Group by b.id_persyaratan_detail ORDER BY a.id_jenis_permohonan, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat ASC ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}


	function get_syarat_list_tidak_sesuai($id_permohonan=null)
	{
		$sql = "SELECT a.*,c.id_syarat,d.nama_syarat,e.id_detail_jenis_persyaratan
				FROM tm_penilaian_teknis  a
				LEFT JOIN tm_imb_permohonan b ON(a.id_permohonan=b.id_permohonan)
				LEFT JOIN tr_persyaratan2_detail c ON(a.id_persyaratan_detail=c.id_persyaratan_detail)
				LEFT JOIN tr_imb_syarat d ON(c.id_syarat=d.id_syarat)
				LEFT JOIN tr_persyaratan2 e ON(e.id_persyaratan=c.id_persyaratan)
				WHERE (1=1) AND a.kesesuaian = '2'";
		if ($id_permohonan != null || trim($id_permohonan) != '')  $sql .= " AND a.id_permohonan = '$id_permohonan' ";
		$sql .= " ORDER BY e.id_detail_jenis_persyaratan ASC ";
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


	function get_syarat_teknis_detail($id=null,$per=null)
	{
		$sql = "SELECT a.*,b.nama_rencana_arsitektur,c.nama_rencana_stuktur
				FROM tr_persyaratan a
				left join tr_rencana_arsitektur b on (a.id_persyaratan = b.id_persyaratan)
				left join tr_rencana_struktur c on (a.id_persyaratan = c.id_persyaratan)
				WHERE (1=1) ";

		if ($id != null || trim($id) != '')  $sql .= " AND a.id_persyaratan = '$id' ";
		if ($per != null || trim($per) != '')  $sql .= " AND a.id_permohonan = '$per' ";
		$sql .= " ORDER BY a.id_persyaratan ASC";
		// echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}


	function insert_permohonan($dataIn)
	{
		$this->db->insert('tm_imb_permohonan',$dataIn);
		return $this->db->insert_id();
	}
	function insert_per_dbg($dataIn)
	{
		$this->db->insert('tm_permohonan_bg_detail',$dataIn);
		return $this->db->insert_id();
	}
	function insert_per_dtanah($dataIn)
	{
		$this->db->insert('tm_imb_tanah',$dataIn);
		return $this->db->insert_id();
	}
	function insert_syarat($dataIn)
	{
		$this->db->insert('tm_permohonan_bg_syarat',$dataIn);
		return $this->db->insert_id();
	}

	function insert_per_status($dataIn)
	{
		$this->db->insert('tm_status_permohonan',$dataIn);
		return $this->db->insert_id();
	}

	function update_per_status($dataIn,$id)
	{
		$this->db->where('id_status', $id);
		$this->db->update('tm_status_permohonan',$dataIn);
	}

	function update_permohonan($dataIn,$id)
	{
		$this->db->where('id_permohonan', $id);
		$this->db->update('tm_imb_permohonan',$dataIn);
		$updated_status = $this->db->affected_rows();
	}

	function update_pernyataan($dataKonfirmasi,$id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_permohonan',$dataKonfirmasi);
		$updated_status = $this->db->affected_rows();
	}

	function update_per_dbg($dataIn,$id)
	{
		$this->db->where('id_permohonan', $id);
		$this->db->update('tm_permohonan_bg_detail',$dataIn);
	}
	
	function update_per_dtanah($dataIn,$id)
	{
		$this->db->where('id_permohonan_detail_tanah', $id);
		$this->db->update('tm_imb_tanah',$dataIn);
	}

	function data_tanah_delete($id_permohonan_detail_tanah)
	{
		$this->db->delete('tm_imb_tanah',array('id_permohonan_detail_tanah'=>$id_permohonan_detail_tanah));
	}
	
	function data_syarat_delete($id)
	{
		$this->db->delete('tm_permohonan_bg_syarat',array('id_permohonan'=>$id));
	}

	function upload_delete($id,$detail,$key_syarat)
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

	function updateValidasi($dataIn,$id,$detail)
	{
		$this->db->where(array('id_permohonan'=>$id,'id_persyaratan_detail'=>$detail));
		$this->db->update('tm_permohonan_bg_syarat',$dataIn);
		$updated_status = $this->db->affected_rows();
		if($updated_status):
			return $detail;
		else:
			return false;
		endif;
	}

	function data_status_delete($id_status)
	{
		$this->db->delete('tm_status_permohonan',array('id_status'=>$id_status));
	}

	function delete_file($file_id)
	{
		$file = $this->get_file($file_id);
		$dataIn = array (
							'dir_file' => ""
						);
		$this->db->where('id_permohonan_detail_tanah', $file_id);
		$this->db->update('tm_imb_tanah',$dataIn);

		unlink('./file/permohonan/' . $file->dir_file);
		return TRUE;
	}

	function delete_file_status_kelengkapan($id_status)
	{
		$file = $this->get_file_pemberitahuan($id_status);
		//echo $file;
		$dataIn = array (
							'dir_file_pemberitahuan' => ""
						);

		$this->db->where('id_status', $id_status);
		$this->db->update('tm_status_permohonan',$dataIn);

		unlink('./file/pemberitahuan/'. $file->dir_file_pemberitahuan);
		return TRUE;
	}


	function get_file_pemberitahuan($id_status)
	{
		return $this->db->select()->from('tm_status_permohonan')->where('id_status', $id_status)->get()->row();
	}

	function get_file($file_id)
	{
		return $this->db->select()->from('tm_imb_tanah')->where('id_permohonan_detail_tanah', $file_id)->get()->row();
	}
	function get_fileu($id,$detail)
	{
		return $this->db->select()->from('tm_permohonan_bg_syarat')->where(array('id_permohonan'=>$id,'id_persyaratan_detail'=>$detail))->get()->row();
	}


	function get_permoh($id=null,$id_jenis_bg=null)
	{
		$sql = "SELECT a.*,b.klasifikasi_bg
				FROM tr_imb_permohonan a
				LEFT JOIN tr_klasifikasi_bg b ON(a.id_klasifikasi_bg=b.id_klasifikasi_bg)
				WHERE (1=1) ";

		if ($id != null || trim($id) != '')  $sql .= " AND a.id_pemanfaatan_bg = '$id' ";
		if ($id_jenis_bg != null || trim($id_jenis_bg) != '')  $sql .= " AND a.id_jenis_bg = '$id_jenis_bg' ";

		$sql .= " ORDER BY a.id_jenis_bg ASC";
		// echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function get_master_permohonan_list($id=null,$id_jenis_bg=null,$nama_permohonan=null,$cari=null)
	{
		$sql = "SELECT a.*,b.klasifikasi_bg
				FROM tr_imb_permohonan a
				LEFT JOIN tr_klasifikasi_bg b ON(a.id_klasifikasi_bg=b.id_klasifikasi_bg)
				WHERE (1=1) ";

		if ($id != null || trim($id) != '')  $sql .= " AND a.id_jenis_permohonan = '$id' ";
		if ($id_jenis_bg != null || trim($id_jenis_bg) != '')  $sql .= " AND a.id_jenis_bg = '$id_jenis_bg' ";
		if ($nama_permohonan != null || trim($nama_permohonan) != '')  $sql .= " AND a.nama_permohonan = '$nama_permohonan' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";

		$sql .= " ORDER BY a.id_jenis_bg,a.id_klasifikasi_bg ASC";
		// echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function insert_syarat_teknis($dataIn)
	{
		$this->db->insert('tr_syarat_teknis',$dataIn);
		return $this->db->insert_id();
	}

	function update_syarat_teknis($dataIn,$id)
	{
		$this->db->where('d_syarat', $id);
		$this->db->update('tr_syarat_teknis',$dataIn);
	}

	function get_data_status($id_permohonan=null,$id_status=null)
	{
		$sql = "SELECT 	a.*, b.email,b.nomor_registrasi ";
		$sql .= " FROM tm_status_permohonan a
					LEFT JOIN tm_imb_permohonan b On(a.id_permohonan=b.id_permohonan)
				WHERE (1=1)  ";

		if ($id_permohonan != null || trim($id_permohonan) != '')  $sql .= " AND a.id_permohonan = '$id_permohonan' ";
		if ($id_status != null || trim($id_status) != '')  $sql .= " AND a.id_status = '$id_status' ";
		$sql .= " ORDER BY a.id_permohonan ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil ;
	}

	function permohonan_delete($id)
	{
		$this->db->delete('tm_imb_permohonan',array('id_permohonan'=>$id));
	}
	
	function insert_log_permohonan($dataIn)
	{
		$this->db->insert('tm_log_permohonan',$dataIn);
		return $this->db->insert_id();
	}

	function getDataPermohonan($counting=0,$dipaging=0,$limit=10,$offset=1,$id=null,$cari=null)
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
					i.nama_kecamatan,
					j.nama_kabkota,
					k.nama_provinsi,
					j.nama_kabkota as nama_kabkota_bg,
					c.nama_permohonan,
					k.nama_provinsi as nama_provinsi_bg
				";
		}
		$sql .= "	FROM tm_imb_permohonan a
					LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
					LEFT JOIN tr_imb_permohonan c ON(a.id_jenis_permohonan = c.id_jenis_permohonan)
					LEFT JOIN tr_kecamatan i ON(a.id_kecamatan=i.id_kecamatan)
					LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
					LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
					WHERE (1=1)  AND a.pernyataan ='1' ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
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
	
	function getDataPermohonanKec($counting=0,$dipaging=0,$limit=10,$offset=1,$id=null,$cari=null)
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
					i.nama_kecamatan,
					j.nama_kabkota,
					k.nama_provinsi,
					j.nama_kabkota as nama_kabkota_bg,
					c.nama_permohonan,
					k.nama_provinsi as nama_provinsi_bg
				";
		}
		$sql .= "	FROM tm_imb_permohonan a
					LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
					LEFT JOIN tr_imb_permohonan c ON(a.id_jenis_permohonan = c.id_jenis_permohonan)
					LEFT JOIN tr_kecamatan i ON(a.id_kecamatan=i.id_kecamatan)
					LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
					LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
					WHERE (1=1)  AND a.pernyataan != '' AND a.pernyataan !='0' AND a.pernyataan !='2' ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
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
	
	function get_permohonan_list3($counting=0,$dipaging=0,$limit=10,$offset=1,$id=null,$cari=null)
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
					i.nama_kecamatan,
					j.nama_kabkota,
					k.nama_provinsi,
					j.nama_kabkota as nama_kabkota_bg,
					c.nama_permohonan,
					k.nama_provinsi as nama_provinsi_bg
				";
		}
		$sql .= "	FROM tm_imb_permohonan a
					LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
					LEFT JOIN tr_imb_permohonan c ON(a.id_jenis_permohonan = c.id_jenis_permohonan)
					LEFT JOIN tr_kecamatan i ON(a.id_kecamatan=i.id_kecamatan)
					LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
					LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
					WHERE (1=1)  AND a.pernyataan != '' AND a.pernyataan !='0' AND a.pernyataan !='2' ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
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

	public function DataGenerateFile($select="a.*")
	{
		$this->db->select($select,FALSE);
		$this->db->where('b.status','1');
		$this->db->join('tm_user b','a.id_user = b.id','LEFT');
		$query 	= $this->db->get('tm_imb_permohonan a');
		return $query;
	}

	public function getDirFile($select="a.*",$id_permohonan="")
	{
		$this->db->select($select,FALSE);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan',$id_permohonan);
		$this->db->where('a.dir_file !=','');
		$this->db->join('tm_imb_permohonan b','a.id_permohonan = b.id_permohonan','LEFT');
		$this->db->join('tr_persyaratan2_detail c','c.id_persyaratan_detail = a.id_persyaratan_detail','LEFT');
		$this->db->join('tr_imb_syarat d','d.id_syarat = c.id_syarat','LEFT');
		$this->db->order_by('id_permohonan','asc');
		$query 	= $this->db->get('tm_permohonan_bg_syarat a');
		return $query;
		//echo $this->db->last_query(); die;
	}

	function get_id_kabkot($id)
	{
			$sql = "SELECT id_permohonan, nomor_registrasi, id_kabkot_bg, id_kec_bg 
					FROM tm_imb_permohonan where id_permohonan = ".$id;
			$hasil = $this->db->query($sql)->row_array();
			return $hasil;
	}
	
	
	function get_pejabat_ttd($id)
	{
			$sql = "SELECT a.id_permohonan,a.id_kabkot_bg, b.kepala_dinas, b.nip_kepala_dinas, b.id_dinas
			FROM tm_imb_permohonan a 
			left join tm_profile_dinas b On (a.id_kabkot_bg = b.id_kabkot)
			where a.id_permohonan = ".$id;
			//$this->db->where('b.id_dinas','1');
			$hasil = $this->db->query($sql)->row_array();
			return $hasil;
	}

	function get_imb_akhir($id_kabkot,$tgl_skrg)
	{
			$sql = "SELECT max(no_imb) as no_registrasi_baru 
			FROM tm_imb_penerbitan 
			WHERE SUBSTR(no_imb,8,4) = '$id_kabkot' and SUBSTR(no_imb,15,8) = '$tgl_skrg'";
			$hasil = $this->db->query($sql)->row_array();
			return $hasil;
	}
	function get_sk_tk_akhir($id_kabkot,$tgl_skrg)
	{
			$sql = "SELECT max(no_sk_tk) as no_registrasi_baru 
			FROM tm_imb_penjadwalan 
			WHERE SUBSTR(no_sk_tk,7,4) = '$id_kabkot' and SUBSTR(no_sk_tk,14,8) = '$tgl_skrg'";
			$hasil = $this->db->query($sql)->row_array();
			return $hasil;
	}

	function info_kabkot($id)
	{
		$this->db->select('a.id_permohonan, a.nama_pemohon, b.id_kabkot, b.nama_kabkota, c.dir_file_logo',FALSE);
		$this->db->where('a.id_permohonan',$id);
		$this->db->join('tr_kabkot b','a.id_kabkot_bg = b.id_kabkot','LEFT');
		$this->db->join('tm_profile_dinas c','a.id_kabkot_bg = c.id_kabkot','LEFT');
		$query	= $this->db->get('tm_imb_permohonan a');
		return $query;
	}

	function get_sk_tk($id_permohonan)
	{
		$sql = "SELECT no_sk_tk, date_sk_tk  
		FROM tm_imb_penjadwalan 
		WHERE id_permohonan = '$id_permohonan' ORDER BY date_sk_tk DESC";
		$hasil = $this->db->query($sql)->row_array();
		return $hasil;
	}
	
	function hapus_permohonan($id) {
		$tables = array(
					'tm_imb_penerbitan',
					'tm_penetapan_retribusi',
					'tm_imb_penugasan',
					'tm_imb_penjadwalan',
					'tm_imb_permohonan',
					'tm_permohonan_bg_detail',
					'tm_imb_tanah',
					'tm_permohonan_bg_syarat',
					'tm_log_permohonan',
				);
		$this->db->where('id_permohonan', $id);
		$this->db->delete($tables);
		unlink('./file/IMB/pengajuan_imb/'.$id);
	}
	
	// Cek Dibutuhkan atau tidak?
	function get_nomor_registrasi($id_kabkot,$tgl_skrg)
	{
		$sql = "SELECT max(nomor_registrasi) as no_registrasi_baru 
		FROM tm_imb_permohonan WHERE SUBSTR(nomor_registrasi,5,4) = '$id_kabkot_bg'
		and SUBSTR(nomor_registrasi,12,8) = '$tgl_skrg'";
		$hasil = $this->db->query($sql)->row_array();
		return $hasil;
	}
	
	function ubah_kolektif($dataKolektif,$id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_kolektif',$dataKolektif);
	}
	
	function updatePermohonan($dataIn,$id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_permohonan',$dataIn);
	}
	
}
