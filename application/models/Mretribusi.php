<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Mretribusi extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function get_penetapan_retribusi_list($counting=0,$dipaging=0,$limit=10,$offset=1,$id=null,$cari=null)
	{
		if (isset($counting) && $counting == 1) 
		{
			$sql = "SELECT COUNT(a.id_permohonan) as total";
		}
		else 
		{
			$sql = "SELECT a.*,
					c.nama_permohonan, c.lama_proses, 
					e.nama_kabkota, 
					f.nama_provinsi,
					i.nama_kecamatan, 
					j.nama_kabkota as nama_kabkota_bg, 
					k.nama_provinsi as nama_provinsi_bg,
					o.fungsi_bg,o.id_pemanfaatan_bg as id_pemanfaatan_bg2,
					s.id_skrd, s.no_skrd, s.tgl_skrd, s.file_skrd, 
					t.id_ssrd, t.no_ssrd, t.tgl_ssrd, t.file_ssrd,
					h.retribusi_manual, h.retribusi,
					x.status_perbaikan
				";
		}
		$sql .= "	FROM tm_imb_permohonan a 
						LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
						LEFT JOIN tm_imb_penjadwalan x ON(x.id_permohonan=a.id_permohonan)	
						LEFT JOIN tr_imb_permohonan c ON(a.id_jenis_permohonan = c.id_jenis_permohonan)
						LEFT JOIN tr_kabkot e ON(e.id_kabkot=a.id_kabkot)
						LEFT JOIN tr_provinsi f ON(a.id_provinsi=f.id_provinsi)
						LEFT JOIN tr_kecamatan i ON(a.id_kecamatan=i.id_kecamatan)
						LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
						LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
						LEFT JOIN tr_skrd s ON(s.id_permohonan=a.id_permohonan)
						LEFT JOIN tr_ssrd t ON(t.id_permohonan=a.id_permohonan)
						LEFT JOIN tm_penetapan_retribusi h ON(h.id_permohonan = a.id_permohonan)
					WHERE (1=1) AND a.status_syarat = '1' AND x.status_perbaikan='2' ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		if (isset($dipaging) && $dipaging ==1)
			$sql .= " Group by a.id_permohonan ORDER BY t.id_ssrd ASC limit $offset, $limit ";
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
	
	function get_data_retsibusi($id_permohonan=null,$id=null)
	{
		$sql = "SELECT a.*,c.id_klasifikasi_bg,
				m.id_penetapan_retribusi,m.harga_satuan,m.retribusi,
				m.id_permanensi,m.id_resiko_kebakaran,m.id_zona_gempa,m.id_ketinggian_bg,m.id_kepemilikan,m.id_waktu_penggunaan,m.id_lokasi,m.id_cara_penetapan,
				m.retribusi_manual,m.dir_file_perhitungan,
				l.*,
				r.nama_fungsi,r.index_fungsi,s.index_klasifikasi as index_klasifikasi_bg,t.index_klasifikasi as index_resiko_kebakaran,u.index_klasifikasi as index_permanensi,
				v.index_klasifikasi as index_zona_gempa,w.index_klasifikasi as index_lokasi,x.index_klasifikasi as index_ketinggian_bg,
				y.index_klasifikasi as index_kepemilikan,z.index_waktu_penggunaan,
				
				c.nama_permohonan,e.nama_kabkota, f.nama_provinsi, j.nama_kabkota as nama_kabkota_bg, k.nama_provinsi as nama_provinsi_bg,i.nama_kecamatan,
				o.fungsi_bg,o.id_pemanfaatan_bg as id_pemanfaatan_bg2,p.klasifikasi_bg,
				g.id_skrd, g.no_skrd, g.tgl_skrd, g.file_skrd, h.id_ssrd, h.no_ssrd, h.tgl_ssrd , h.file_ssrd,b.dir_file_jadwal,b.id_penjadwalan
				";
		
		$sql .= "	FROM tm_imb_permohonan a 
						LEFT JOIN tr_imb_permohonan c ON(a.id_jenis_permohonan = c.id_jenis_permohonan)
						
						LEFT JOIN tr_kabkot e ON(e.id_kabkot=a.id_kabkot)
						LEFT JOIN tr_provinsi f ON(a.id_provinsi=f.id_provinsi)
						LEFT JOIN tr_kecamatan i ON(a.id_kecamatan=i.id_kecamatan)
						LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
						LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
						
						LEFT JOIN tm_penetapan_retribusi m ON(m.id_permohonan = a.id_permohonan)
						LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
						LEFT JOIN tr_klasifikasi_bg p ON(p.id_klasifikasi_bg=c.id_klasifikasi_bg)
						LEFT JOIN ref_fungsi r ON(o.id_fungsi_bg=r.id_fungsi)
						LEFT JOIN ref_klasifikasi_detail s ON(p.id_klasifikasi_bg=s.id_klasifikasi_detail)
						LEFT JOIN ref_klasifikasi_detail t ON(m.id_resiko_kebakaran=t.id_klasifikasi_detail)
						LEFT JOIN ref_klasifikasi_detail u ON(m.id_permanensi=u.id_klasifikasi_detail)
						LEFT JOIN ref_klasifikasi_detail v ON(m.id_zona_gempa=v.id_klasifikasi_detail)
						LEFT JOIN ref_klasifikasi_detail w ON(m.id_lokasi=w.id_klasifikasi_detail)
						LEFT JOIN ref_klasifikasi_detail x ON(m.id_ketinggian_bg=x.id_klasifikasi_detail)
						LEFT JOIN ref_klasifikasi_detail y ON(m.id_kepemilikan=y.id_klasifikasi_detail)
						LEFT JOIN ref_waktu_penggunaan z ON(m.id_waktu_penggunaan=z.id_waktu)
						LEFT JOIN tr_skrd g ON(g.id_permohonan=a.id_permohonan)
						LEFT JOIN tr_ssrd h ON(h.id_permohonan=a.id_permohonan)
						
						LEFT JOIN tm_imb_penjadwalan b ON(b.id_permohonan=a.id_permohonan)
						LEFT JOIN tm_imb_kolektif l ON(l.id_permohonan = a.id_permohonan)
					WHERE (1=1) AND a.status_syarat = '1' ";
		
		if ($id_permohonan != null || trim($id_permohonan) != '')  $sql .= " AND a.id_permohonan = '$id_permohonan' ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_penetapan_retribusi = '$id' ";
		// echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function insert_data_penetapan_retribusi($dataIn)
	{
		$this->db->insert('tm_penetapan_retribusi',$dataIn);
		return $this->db->insert_id();
	}
	
	function update_data_penetapan_retribusi($dataIn,$id_penetapan_retribusi)
	{
		$this->db->where('id_penetapan_retribusi', $id_penetapan_retribusi);
		$this->db->update('tm_penetapan_retribusi',$dataIn);
	}
	function insert_skrd($dataIn)
	{
		$this->db->insert('tr_skrd',$dataIn);
		return $this->db->insert_id();
	}
	
	function update_skrd($dataIn,$id)
	{
		$this->db->where('id_skrd', $id);
		$this->db->update('tr_skrd',$dataIn);
	}
	function insert_ssrd($dataIn)
	{
		$this->db->insert('tr_ssrd',$dataIn);
		return $this->db->insert_id();
	}
	
	function update_ssrd($dataIn,$id)
	{
		$this->db->where('id_ssrd', $id);
		$this->db->update('tr_ssrd',$dataIn);
	}
	
	function delete_file_skrd($file_id)
	{
		$file = $this->get_file_skrd($file_id);

		$dataIn = array (
							'file_skrd' => ""
						);	
		$this->db->where('id_skrd', $file_id);
		$this->db->update('tr_skrd',$dataIn);
		
		unlink('./file/skrd/' . $file->file_skrd);
		return TRUE;
	}
	
	function delete_file_retribusi($file_id)
	{
		$file = $this->get_file_retribusi($file_id);
		$dataIn = array (
							'dir_file_perhitungan' => ""
						);	
		$this->db->where('id_penetapan_retribusi', $file_id);
		$this->db->update('tm_penetapan_retribusi',$dataIn);
		
		unlink('./file/retribusi/' . $file->dir_file_perhitungan);
		return TRUE;
	}
	
	function get_file_retribusi($file_id)
	{
		return $this->db->select()->from('tm_penetapan_retribusi')->where('id_penetapan_retribusi', $file_id)->get()->row();
	}
	
	function get_file_skrd($file_id)
	{
		return $this->db->select()->from('tr_skrd')->where('id_skrd', $file_id)->get()->row();
	}
	
	function delete_file_ssrd($file_id)
	{
		$file = $this->get_file_ssrd($file_id);

		$dataIn = array (
							'file_ssrd' => ""
						);	
		$this->db->where('id_ssrd', $file_id);
		$this->db->update('tr_ssrd',$dataIn);
		
		unlink('./file/ssrd/' . $file->file_ssrd);
		return TRUE;
	}
	
	function get_file_ssrd($file_id)
	{
		return $this->db->select()->from('tr_ssrd')->where('id_ssrd', $file_id)->get()->row();
	}	

}
 
