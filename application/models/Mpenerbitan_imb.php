<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpenerbitan_imb extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_permohonan_imb($counting=0,$dipaging=0,$limit=10,$offset=1,$id=null,$cari=null)
	{
		if (isset($counting) && $counting == 1)
		{
			$sql = "SELECT COUNT(a.id_permohonan) as total";
		}
		else
		{
			$sql = "SELECT a.id_permohonan,a.id_jenis_usaha,a.status_syarat,a.pernyataan,a.id_fungsi_bg,a.nomor_registrasi,a.tgl_permohonan,
					a.nama_pemohon,a.alamat_pemohon,a.no_ktp,a.no_tlp,a.nama_perusahaan,a.alamat_perusahaan,a.id_kabkot,a.luas_bg,a.id_provinsi,
					a.no_tlp_perusahaan,a.alamat_bg,a.kelurahan,a.kecamatan,a.id_jenis_bg,a.jns_bangunan,a.id_prasarana_bg,a.status,a.lantai_bg,a.tinggi_bg,

					c.nama_permohonan,
					d.nama_kementerian,
					e.nama_kabkota,
					f.nama_provinsi,
					i.nama_kecamatan,
					j.nama_kabkota as nama_kabkota_bg,
					k.nama_provinsi as nama_provinsi_bg,
					m.no_imb,m.id_penerbitan_imb,m.tgl_imb,m.tgl_berlaku_izin,m.dir_file_imb,
					o.fungsi_bg,o.id_pemanfaatan_bg as id_pemanfaatan_bg2,
					p.klasifikasi_bg,
					q.luas_tanah,q.atas_nama_dok,
					r.nomor_imb,
					s.harga_satuan,s.retribusi,s.retribusi_manual
				";
		}
		$sql .= "	FROM tm_imb_permohonan a
						LEFT JOIN tm_permohonan_bg_detail l ON(l.id_permohonan = a.id_permohonan)
						LEFT JOIN tm_imb_penerbitan m ON(m.id_permohonan = a.id_permohonan)
						LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
						LEFT JOIN tr_klasifikasi_bg p ON(p.id_klasifikasi_bg=l.id_klasifikasi_bg)
						LEFT JOIN tm_imb_tanah q ON(q.id_permohonan=a.id_permohonan)
						LEFT JOIN tm_data_imb_bg r ON(r.id_bangunan_gedung=a.id_bangunan_gedung)
						LEFT JOIN tm_penetapan_retribusi s ON(s.id_permohonan = a.id_permohonan)
						LEFT JOIN tr_imb_permohonan c ON(a.id_jenis_permohonan = c.id_jenis_permohonan)
						LEFT JOIN tr_kementerian d ON(a.id_kementerian=d.id_kementerian)
						LEFT JOIN tr_kabkot e ON(e.id_kabkot=a.id_kabkot)
						LEFT JOIN tr_provinsi f ON(a.id_provinsi=f.id_provinsi)
						LEFT JOIN tr_kecamatan i ON(a.id_kecamatan=i.id_kecamatan)
						LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
						LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
					WHERE (1=1)";
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

	function get_data_imb($id_permohonan=null,$id=null)
	{
		$sql = "SELECT a.id_permohonan,
					m.no_imb,m.id_penerbitan_imb,m.tgl_imb,m.tgl_berlaku_izin,m.dir_file_imb
				";
		$sql .= "FROM tm_imb_permohonan a
				 LEFT JOIN tm_imb_penerbitan m ON(m.id_permohonan = a.id_permohonan)
				WHERE (1=1) ";
		if ($id_permohonan != null || trim($id_permohonan) != '')  $sql .= " AND a.id_permohonan = '$id_permohonan' ";

		// echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}


	function get_penerbitan_imb_list($counting=0,$dipaging=0,$limit=10,$offset=1,$id=null,$cari=null)
	{
		if (isset($counting) && $counting == 1)
		{
			$sql = "SELECT COUNT(a.id_permohonan) as total";
		}
		else
		{
			$sql = "SELECT a.id_permohonan,a.id_jenis_usaha,a.status_syarat,a.pernyataan,a.id_fungsi_bg,a.nomor_registrasi,a.tgl_permohonan,
					a.nama_pemohon,a.alamat_pemohon,a.no_ktp,a.no_tlp,a.nama_perusahaan,a.alamat_perusahaan,a.id_kabkot,
					a.no_tlp_perusahaan,a.alamat_bg,a.kelurahan,a.kecamatan,a.id_jenis_bg,a.jns_bangunan,a.id_prasarana_bg,a.status,a.lantai_bg,
					b.id_penerbitan_imb,b.no_imb,b.dir_file_imb,
					d.nama_permohonan,
					q.nama_provinsi,
					f.nama_kabkota as nama_kabkota_bg,
					g.nama_provinsi as nama_provinsi_bg,
					i.fungsi_bg,
					k.klasifikasi_bg,
					s.nama_kecamatan,
					r.nama_kabkota,
					t.no_ssrd
				";
		}
		$sql .= "	FROM tm_imb_permohonan a
						LEFT JOIN tm_imb_penerbitan b ON(a.id_permohonan = b.id_permohonan)
						LEFT JOIN tr_imb_permohonan d ON(a.id_jenis_permohonan = d.id_jenis_permohonan)
						LEFT JOIN tr_fungsi_bg i ON(i.id_fungsi_bg = a.id_fungsi_bg)
						LEFT JOIN tr_kecamatan s ON(a.id_kecamatan=s.id_kecamatan)
						LEFT JOIN tr_kabkot f ON(a.id_kabkot=f.id_kabkot)
						LEFT JOIN tr_provinsi g ON(a.id_provinsi=g.id_provinsi)
						LEFT JOIN tr_klasifikasi_bg k ON (d.id_klasifikasi_bg=k.id_klasifikasi_bg)
						LEFT JOIN tr_ssrd t ON(t.id_permohonan=a.id_permohonan)
						LEFT JOIN tr_provinsi q ON(q.id_provinsi=a.id_provinsi_bg)
						LEFT JOIN tr_kabkot r ON(r.id_kabkot=a.id_kabkot_bg)
					WHERE (1=1) AND a.status_syarat = '1' AND t.no_ssrd is not null AND b.validasi_retribusi = 1";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_penetapan_retribusi = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		if (isset($dipaging) && $dipaging ==1)
			$sql .= " ORDER BY a.id_permohonan DESC limit $offset, $limit ";
		else
			$sql .= " ORDER BY a.id_permohonan DESC";
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

	function get_ref_mem($idkota=null,$cari=null)
	{
		$sql = " Select DISTINCT a.id_kabkot,a.keterangan
				From tr_ref_memperhatikan a
				LEFT JOIN tr_kabkot b ON (a.id_kabkot = b.id_kabkot)
				WHERE (1=1)
		";
		if ($idkota != null || trim($idkota) != '') $sql .= " AND a.id_kabkot = '$idkota' ";
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	function get_ref_pen($idkab=null,$cari=null)
	{
		$sql = " Select DISTINCT a.id_kabkot,a.keterangan
				From tr_ref_per a
				LEFT JOIN tr_kabkot b ON (a.id_kabkot = b.id_kabkot)
				WHERE (1=1)
		";
		if ($idkab != null || trim($idkab) != '') $sql .= " AND a.id_kabkot = '$idkab' ";
		$hasil = $this->db->query($sql);
		return $hasil;
	}


	function insert_data_penerbitan_imb($dataInImb)
	{
		$this->db->insert('tm_imb_penerbitan',$dataInImb);
		return $this->db->insert_id();
	}

	function update_data_penerbitan_imb($dataIn_Imb, $id)
	{
		$this->db->where('id_penerbitan_imb', $id);
		$this->db->update('tm_imb_penerbitan',$dataIn_Imb);
	}

	function insert_data_penerbitan_slf($dataInSlf)
	{
		$this->db->insert('tm_penerbitan_slf',$dataInSlf);
		return $this->db->insert_id();
	}

	function update_data_penerbitan_slf($dataIn_slf, $id)
	{
		$this->db->where('id_penerbitan_slf', $id);
		$this->db->update('tm_penerbitan_slf',$dataIn_slf);
	}

	function delete_file_imb($file_id)
	{
		$file = $this->get_file($file_id);

		$dataIn = array (
							'dir_file_imb' => ""
						);

		$this->db->where('id_penerbitan_imb', $file_id);
		$this->db->update('tm_imb_penerbitan',$dataIn);

		unlink('./file/penerbitan_imb/' . $file->dir_file_imb);
		return TRUE;
	}

	function get_file($file_id)
	{
		return $this->db->select()->from('tm_imb_penerbitan')->where('id_penerbitan_imb', $file_id)->get()->row();
	}
	
	function get_penerbitan_imb_cetak($id='null')
	{
		$sql = "SELECT a.*,
			b.id_penerbitan_imb,b.no_imb,b.tgl_imb,b.ttd_pejabat_sk,b.nip_pejabat_sk,b.dir_file_imb,
			d.nama_permohonan, q.nama_provinsi as nama_provinsi_bg, f.nama_kabkota, g.nama_provinsi,
			i.fungsi_bg,k.klasifikasi_bg,s.nama_kecamatan,r.nama_kabkota as nama_kabkota_bg,
			j.dir_file_logo,j.p_alamat,j.p_nama_dinas,
			j.p_tlp,j.sub_domain,
			y.atas_nama_dok,y.luas_tanah,y.lokasi_tanah,y.hat,x.jns_permohonan,v.no_sk_tk,v.date_sk_tk,v.tgl_sidang
				FROM tm_imb_permohonan a
				LEFT JOIN tr_fungsi_bg i ON(i.id_fungsi_bg = a.id_fungsi_bg)
				LEFT JOIN tm_imb_penerbitan b ON(a.id_permohonan = b.id_permohonan)
				LEFT JOIN tr_imb_permohonan d ON(a.id_jenis_permohonan = d.id_jenis_permohonan)
				LEFT JOIN tr_kecamatan s ON(a.id_kecamatan=s.id_kecamatan)
				LEFT JOIN tr_kabkot f ON(a.id_kabkot=f.id_kabkot)
				LEFT JOIN tr_provinsi g ON(a.id_provinsi=g.id_provinsi)
				LEFT JOIN tr_klasifikasi_bg k ON (d.id_klasifikasi_bg=k.id_klasifikasi_bg)
				LEFT JOIN tm_profile_dinas j ON (a.id_kabkot_bg=j.id_kabkot)
				LEFT JOIN tr_provinsi q ON(q.id_provinsi=a.id_provinsi_bg)
				LEFT JOIN tr_kabkot r ON(r.id_kabkot=a.id_kabkot_bg)
				LEFT JOIN tm_imb_tanah y ON(y.id_permohonan=a.id_permohonan)
				LEFT JOIN tr_jenis_bg x ON(x.id_jenis_bg=a.id_jenis_bg)
				LEFT JOIN tm_imb_penjadwalan v ON(v.id_permohonan=a.id_permohonan)
				WHERE (a.id_permohonan=$id) AND v.status_perbaikan = 2
				ORDER BY no_imb DESC
			limit 1
			";
		$hasil = $this->db->query($sql);
		return $hasil->row_array();
	}
	
	function get_penerbitan_imb_pemecahan($id='null')
	{
		$sql = "SELECT a.*,
			b.id_penerbitan_imb,b.no_imb,b.tgl_imb,b.ttd_pejabat_sk,b.nip_pejabat_sk,b.dir_file_imb,
			d.nama_permohonan, q.nama_provinsi as nama_provinsi_bg, f.nama_kabkota, g.nama_provinsi,
			i.fungsi_bg,k.klasifikasi_bg,s.nama_kecamatan,r.nama_kabkota as nama_kabkota_bg,
			j.dir_file_logo,j.p_alamat,j.p_nama_dinas,
			j.p_tlp,j.sub_domain,
			y.atas_nama_dok,y.luas_tanah,y.lokasi_tanah,y.hat,x.jns_permohonan,v.no_sk_tk,v.date_sk_tk,v.tgl_sidang
				FROM tm_imb_permohonan a
				LEFT JOIN tr_fungsi_bg i ON(i.id_fungsi_bg = a.id_fungsi_bg)
				LEFT JOIN tm_imb_penerbitan b ON(a.id_permohonan = b.id_permohonan)
				LEFT JOIN tr_imb_permohonan d ON(a.id_jenis_permohonan = d.id_jenis_permohonan)
				LEFT JOIN tr_kecamatan s ON(a.id_kecamatan=s.id_kecamatan)
				LEFT JOIN tr_kabkot f ON(a.id_kabkot=f.id_kabkot)
				LEFT JOIN tr_provinsi g ON(a.id_provinsi=g.id_provinsi)
				LEFT JOIN tr_klasifikasi_bg k ON (d.id_klasifikasi_bg=k.id_klasifikasi_bg)
				LEFT JOIN tm_profile_dinas j ON (a.id_kabkot_bg=j.id_kabkot)
				LEFT JOIN tr_provinsi q ON(q.id_provinsi=a.id_provinsi_bg)
				LEFT JOIN tr_kabkot r ON(r.id_kabkot=a.id_kabkot_bg)
				LEFT JOIN tm_imb_tanah y ON(y.id_permohonan=a.id_permohonan)
				LEFT JOIN tr_jenis_bg x ON(x.id_jenis_bg=a.id_jenis_bg)
				LEFT JOIN tm_imb_penjadwalan v ON(v.id_permohonan=a.id_permohonan)
				WHERE (a.id_permohonan=$id)
				ORDER BY no_imb DESC
			limit 1
			";
		$hasil = $this->db->query($sql);
		return $hasil->row_array();
	}

	function peraturan($id='null')
	{
		$sql ="SELECT x.nama_perda
						FROM tm_imb_permohonan a
						LEFT JOIN tm_data_perda x ON (x.id_kabkot=a.id_kabkot_bg)
						WHERE (a.id_permohonan=$id)
						ORDER BY urutan ASC";
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	function tanah($id='null')
	{
		$sql ="SELECT a.id_permohonan, y.*, r.nama_kabkota,z.nama_provinsi,x.nama_kecamatan
						FROM tm_imb_permohonan a
						LEFT JOIN tm_imb_tanah y ON(y.id_permohonan=a.id_permohonan)
						LEFT JOIN tr_kabkot r ON(r.id_kabkot=y.id_kabkot)
						LEFT JOIN tr_provinsi z ON(z.id_provinsi=y.id_provinsi)
						LEFT JOIN tr_kecamatan x ON(x.id_kecamatan=y.id_kecamatan)
						WHERE (a.id_permohonan=$id)";
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	function retribusi($id='null')
	{
		$sql ="SELECT a.*, r.*
						FROM tm_imb_permohonan a
						LEFT JOIN tm_penetapan_retribusi r ON(r.id_permohonan=a.id_permohonan)
						WHERE (a.id_permohonan=$id)";
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	function rek_teknis($id='null')
	{
		$sql ="SELECT a.*, t.*
						FROM tm_imb_permohonan a
						LEFT JOIN tm_penilaian_teknis t ON(t.id_permohonan=a.id_permohonan)
						WHERE (a.id_permohonan=$id)";
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	function undang2()
	{
		$sql ="SELECT *
						FROM tr_uu";
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	function validasi_retribusi_form($id)
	{
		$this->db->select('id_permohonan, validasi_retribusi',FALSE);
		$this->db->where('id_permohonan',$id);
		$this->db->order_by('id_penerbitan_imb', 'DESC');
		$this->db->limit('1');
		$query	= $this->db->get('tm_imb_penerbitan');
		return $query;
	}
	
	function GetPemecahan($id)
	{
		
	}
}
