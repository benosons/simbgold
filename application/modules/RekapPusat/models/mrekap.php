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
		if ($dev != 1)  $this->db->where('id_kabkot_bg',$tot);
		$this->db->join('tr_imb_permohonan', 'tm_imb_permohonan.id_jenis_permohonan = tr_imb_permohonan.id_jenis_permohonan'); 
		$this->db->join('tr_fungsi_bg', 'tm_imb_permohonan.id_fungsi_bg = tr_fungsi_bg.id_fungsi_bg');
		$this->db->join('simbg_status', 'simbg_status.kode_status = tm_imb_permohonan.status_progress'); 
		$this->db->order_by('tm_imb_permohonan.status_progress','asc');
		
		$query = $this->db->get(); //simpan database yang udah di get alias ambil ke query
		return $query; //hasil dari semua proses ada dimari
	}
	
	public function getDataRetribusiIMB()
	{
		$tot = $this->session->userdata('loc_id_kabkot');
		$dev = $this->session->userdata('loc_role_id');
		$sero=null;
		$this->db->select('*');
		$this->db->from('tm_imb_permohonan a'); //memeilih tabel
		$this->db->where('pernyataan >= 1');
		$this->db->where("status_progress >= 14 ");
		if ($dev != 1)  $this->db->where('id_kabkot_bg',$tot);
		$this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan'); 
		$this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
		$this->db->join('simbg_status d', 'd.kode_status = a.status_progress'); 
		$this->db->join('tm_penetapan_retribusi e', 'e.id_permohonan = a.id_permohonan');
		$this->db->order_by('a.status_progress','asc');
		$query = $this->db->get(); //simpan database yang udah di get alias ambil ke query
		return $query; //hasil dari semua proses ada dimari
	}
	
	public function getDataRekapRetribusi($id_kabkot='')
	{
		//$this->db->select($select,FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot_bg',$id_kabkot);
		$this->db->where('pernyataan >= 1');
		$this->db->where("status_progress >= 14 ");
		$this->db->join('tm_imb_penerbitan c','a.id_permohonan = c.id_permohonan','LEFT');
		$this->db->join('tr_provinsi d','a.id_provinsi_bg = d.id_provinsi','LEFT');
		$this->db->join('tr_kabkot e','a.id_kabkot_bg = e.id_kabkot','LEFT');
		$this->db->join('tr_kecamatan f','a.id_kec_bg = f.id_kecamatan','LEFT');
		$this->db->join('tr_imb_permohonan j','a.id_jenis_permohonan = j.id_jenis_permohonan','LEFT');
		$this->db->join('tm_penetapan_retribusi k','a.id_permohonan = k.id_permohonan','LEFT');
		$query 	= $this->db->get('tm_imb_permohonan a');
		return $query;
	}
	
	function getDataPermohonan($counting=0,$dipaging=0,$limit=10,$offset=1,$id_kabkot=null,$cari=null)
	{
		if (isset($counting) && $counting == 1)
		{
			$sql = "SELECT COUNT(a.id_permohonan) as total";
		}
		else
		{
			$sql = "SELECT a.id_permohonan,a.status_progress,a.nama_pemohon,a.alamat_bg,a.nomor_registrasi,f.retribusi_manual,b.nama_permohonan,g.no_imb
				";
		}
		$sql .= "	FROM tm_imb_permohonan a
					LEFT JOIN tr_imb_permohonan b ON(a.id_jenis_permohonan = b.id_jenis_permohonan)
					LEFT JOIN tr_kecamatan c ON(a.id_kec_bg=c.id_kecamatan)
					LEFT JOIN tr_kabkot d ON(a.id_kabkot_bg=d.id_kabkot)
					LEFT JOIN tr_provinsi e ON(a.id_provinsi_bg=e.id_provinsi)
					LEFT JOIN tm_penetapan_retribusi f ON(f.id_permohonan=a.id_permohonan)
					LEFT JOIN tm_imb_penerbitan g ON(g.id_permohonan=a.id_permohonan)
					WHERE (1=1)  AND a.pernyataan ='1' AND a.status_progress >= 14";
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND a.id_kabkot_bg = '$id_kabkot' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";

		if (isset($dipaging) && $dipaging ==1)
			$sql .= " Group by a.id_permohonan ORDER BY a.status_syarat ASC limit $offset, $limit ";
		else
			$sql .= " Group by a.id_permohonan ORDER BY a.status_syarat ASC";
		echo $sql;
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
	
	public function view_all(){
		return $this->db->get('transaksi')->result(); // Tampilkan semua data transaksi
	}


}
	
