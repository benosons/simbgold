<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mmain extends CI_Model{
	
	function get_detail_imb($sk_imb=null)
	{
		$sql = "SELECT a.id_permohonan,a.nama_pemohon,a.alamat_pemohon,a.id_jenis_permohonan,a.no_tlp,a.email,a.no_ktp,a.alamat_bg,
				a.luas_bg,a.tinggi_bg,a.lantai_bg,a.id_jenis_bg,a.jns_bangunan,a.nama_bangunan,a.id_fungsi_bg,a.id_prasarana_bg,a.tinggi_prasarana,
				a.lapis_basement,a.luas_basement,
				c.nama_permohonan,c.id_klasifikasi_bg,
				e.nama_kabkota,
				f.nama_provinsi,
				g.nama_kecamatan as nama_kecamatan_bg,
				i.nama_kecamatan, 
				j.nama_kabkota as nama_kabkota_bg, 
				k.nama_provinsi as nama_provinsi_bg,
				l.sk_imb_kolektif,l.tipeA,l.tipeB,l.tipeC,l.tipeD,l.unitA,l.unitB,l.unitC,l.unitD,l.tinggiA,l.tinggiB,l.tinggiC,l.tinggiD,l.no_kolektif,
				l.luasA,l.luasB,l.luasC,l.luasD,
				m.no_imb,m.id_penerbitan_imb,m.tgl_imb,m.dir_file_imb,
				o.fungsi_bg,o.id_pemanfaatan_bg as id_pemanfaatan_bg2,q.luas_tanah,q.atas_nama_dok,x.retribusi,x.retribusi_manual
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
					WHERE (1=1)";
		if ($sk_imb != null || trim($sk_imb) != '')  $sql .= " AND m.no_imb = '$sk_imb' ";
		
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil ;
		/* if (isset($counting) && $counting == 1)	{
			$myres= $hasil->result_array();
			if (count($myres) > 0)
				return $myres[0]['total'];
			else
				return 0;
		} else {
			return $hasil ;
		} */
	}
	
	public function getDataSLF($no_slf=null)
	{
		$sql = "SELECT a.id_permohonan_slf,a.nama_pemilik,a.alamat_pemilik,a.no_ktp,a.nama_bangunan,a.id_fungsi_slf,
				a.id_fungsi_bg_slf,a.id_fungsi_bg,
				a.alamat_bg,a.luas_bg,a.tinggi_bg,a.lantai_bg,
				b.nama_kecamatan,
				c.nama_kabkota,
				d.nama_provinsi,
				e.nama_kecamatan as nama_kecamatan_bg,
				f.nama_kabkota as nama_kabkota_bg,
				g.nama_provinsi as nama_provinsi_bg,
				h.no_slf,h.ttd_pejabat_sk,h.nip_pejabat_sk
				";
		$sql .= "	FROM tm_slf_permohonan a
					LEFT JOIN tr_kecamatan b ON(b.id_kecamatan=a.id_kecamatan)
					LEFT JOIN tr_kabkot c ON(c.id_kabkot=a.id_kabkot)
					LEFT JOIN tr_provinsi d ON(d.id_provinsi=a.id_provinsi)
					LEFT JOIN tr_kecamatan e ON(e.id_kecamatan=a.id_kecamatan_bg)
					LEFT JOIN tr_kabkot f ON(f.id_kabkot=a.id_kabkot_bg)
					LEFT JOIN tr_provinsi g ON(g.id_provinsi=a.id_provinsi_bg)
					LEFT JOIN tm_slf_pengesahan h ON(h.id_permohonan_slf=a.id_permohonan_slf)
					WHERE (1=1)";
		if ($no_slf != null || trim($no_slf) != '')  $sql .= " AND h.no_slf = '$no_slf' ";
		$hasil  = $this->db->query($sql);
		return $hasil ;
		
	}

	public function getDataPBG($sk_imb=null)
	{
		$sql = "SELECT a.id,a.nm_pemilik,
				b.almt_bgn,b.id_jenis_permohonan,b.status,b.nm_bgn,b.id_fungsi_bg,b.luas_bgn,b.tinggi_bgn,b.jml_lantai,b.luas_bgp,b.tinggi_bgp,
				b.tipeA,b.tinggiA,b.luasA,b.jumlahA,b.lantaiA,
				c.no_izin_pbg,c.nm_kadis,c.nip_kadis,
				d.nama_kelurahan,
				e.nama_kecamatan,
				f.nama_kabkota,
				g.nama_provinsi,
				o.fungsi_bg,o.id_pemanfaatan_bg
       		FROM tmdatapemilik a
			LEFT JOIN tmdatabangunan b ON(b.id=a.id)
			LEFT JOIN tmdatapbg c ON(c.id=a.id)
			LEFT JOIN tr_kelurahan d ON(d.id_kelurahan=b.id_kel_bgn)
			LEFT JOIN tr_kecamatan e ON(e.id_kecamatan=b.id_kec_bgn)
			LEFT JOIN tr_kabkot f ON(f.id_kabkot=b.id_kabkot_bgn)
			LEFT JOIN tr_provinsi g ON(g.id_provinsi=b.id_prov_bgn)
			LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=b.id_fungsi_bg)
			WHERE (1=1)";
		if ($sk_imb != null || trim($sk_imb) != '')  $sql .= " AND c.no_izin_pbg = '$sk_imb' ";
		$hasil  = $this->db->query($sql);
		return $hasil ;
    }

	public function getDataSLFBaru($sk_slf=null)
	{
		$sql = "SELECT a.id,a.nm_pemilik,
				b.almt_bgn,b.status,b.nm_bgn,b.id_fungsi_bg,b.luas_bgn,b.tinggi_bgn,b.jml_lantai,
				b.tipeA,b.tinggiA,b.luasA,b.jumlahA,b.lantaiA,
				c.no_slf,c.nm_kadis_teknis,c.nip_kadis_teknis,
				d.nama_kelurahan,
				e.nama_kecamatan,
				f.nama_kabkota,
				g.nama_provinsi,
				o.fungsi_bg,o.id_pemanfaatan_bg
       		FROM tmdatapemilik a
			LEFT JOIN tmdatabangunan b ON(b.id=a.id)
			LEFT JOIN tmdataslf c ON(c.id=a.id)
			LEFT JOIN tr_kelurahan d ON(d.id_kelurahan=b.id_kel_bgn)
			LEFT JOIN tr_kecamatan e ON(e.id_kecamatan=b.id_kec_bgn)
			LEFT JOIN tr_kabkot f ON(f.id_kabkot=b.id_kabkot_bgn)
			LEFT JOIN tr_provinsi g ON(g.id_provinsi=b.id_prov_bgn)
			LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=b.id_fungsi_bg)
			WHERE (1=1)";
		if ($sk_slf != null || trim($sk_slf) != '')  $sql .= " AND c.no_slf = '$sk_slf' ";
		
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil ;
		/* if (isset($counting) && $counting == 1)	{
			$myres= $hasil->result_array();
			if (count($myres) > 0)
				return $myres[0]['total'];
			else
				return 0;
		} else {
			return $hasil ;
		} */

    }

	public function getDataSLFEksis($sk_slf=null) 
	{
		$sql = "SELECT a.id,a.nm_pemilik,
				b.almt_bgn,b.id_jenis_permohonan,b.status,b.nm_bgn,b.id_fungsi_bg,b.luas_bgn,b.tinggi_bgn,b.jml_lantai,b.luas_bgp,b.tinggi_bgp,
				b.tipeA,b.tinggiA,b.luasA,b.jumlahA,b.lantaiA,b.no_imb,
				c.no_slf,c.nm_kadis_teknis,c.nip_kadis_teknis,
				d.no_izin_pbg,
				o.fungsi_bg,o.id_pemanfaatan_bg
			FROM tmdatapemilik a
			LEFT JOIN tmdatabangunan b ON(b.id=a.id)
			LEFT JOIN tmdataslf c ON(c.id=a.id)
			LEFT JOIN tmdatapbg d ON(d.id=a.id)
			LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=b.id_fungsi_bg)
			WHERE (1=1)";
		if ($sk_slf != null || trim($sk_slf) != '')  $sql .= " AND c.no_slf = '$sk_slf' ";
		$hasil  = $this->db->query($sql);
		return $hasil ;
	}

	public function getConvert($sk_imb=null)
	{
		$sql = "SELECT a.id_convert,a.id_kabkot,a.nama_pemilik,a.alamat_bgn,a.fungsi_bgn,a.nama_bgn,a.no_sk_baru,
				e.nama_kabkota ";
		$sql .="FROM uuck_convert a
					
						LEFT JOIN tr_kabkot e ON( e.id_kabkot = a.id_kabkot)

				WHERE (1=1)";
		if ($sk_imb != null || trim($sk_imb) != '')  $sql .= " AND a.no_sk_baru = '$sk_imb' ";
		$sql .= " AND a.status >= 86 ";
		
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil ;
	}


	function getdatapemilikDok($id='null')
	{
		$sql = "SELECT a.id,a.nm_pemilik,a.alamat,
				b.nama_kelurahan
				FROM tmdatapemilik a
				LEFT JOIN tr_kelurahan b ON(b.id_kelurahan = a.id_kelurahan)
				LEFT JOIN tr_kecamatan c ON(c.id_kecamatan = a.id_kecamatan)
				/*LEFT JOIN tm_imb_penerbitan b ON(a.id_permohonan = b.id_permohonan)
				LEFT JOIN tr_imb_permohonan d ON(a.id_jenis_permohonan = d.id_jenis_permohonan)
				LEFT JOIN tr_kecamatan s ON(a.id_kecamatan=s.id_kecamatan)
				LEFT JOIN tr_kabkot f ON(a.id_kabkot=f.id_kabkot)
				LEFT JOIN tr_provinsi g ON(a.id_provinsi=g.id_provinsi)
				LEFT JOIN tr_klasifikasi_bg k ON (d.id_klasifikasi_bg=k.id_klasifikasi_bg)
				LEFT JOIN tm_profile_dinas j ON (a.id_kabkot_bg=j.id_kabkot)
				LEFT JOIN tr_provinsi q ON(q.id_provinsi=a.id_provinsi_bg)
				LEFT JOIN tr_kabkot r ON(r.id_kabkot=a.id_kabkot_bg)
				LEFT JOIN tr_jenis_bg x ON(x.id_jenis_bg=a.id_jenis_bg)
				LEFT JOIN tm_imb_penjadwalan v ON(v.id_permohonan=a.id_permohonan)*/
				WHERE (a.id=$id)
			limit 1
			";
		$hasil = $this->db->query($sql);
		return $hasil->row_array();
	}

	function getdatabangunanDok($id='null')
	{
		$sql = "SELECT a.id,
				b.id_kabkot_bgn,b.id_izin,b.nm_bgn,b.almt_bgn,b.luas_bgn,b.id_fungsi_bg,b.jml_lantai,b.tipeA,b.luasA,b.tinggiA,b.lantaiA,
				c.nama_kelurahan,
				d.nama_kecamatan,
				e.nama_kabkota,
				f.nama_provinsi,
				g.nilai_retribusi_bangunan,g.nilai_retribusi_prasarana,g.nilai_retribusi_keseluruhan,
				h.no_izin_pbg,h.nm_kadis,h.nip_kadis,h.tgl_pbg,
				i.fungsi_bg,i.id_pemanfaatan_bg,
				j.no_sk_tk,j.date_sk_tk
				FROM tmdatapemilik a
				LEFT JOIN tmdatabangunan b ON(b.id = a.id)
				LEFT JOIN tr_kelurahan c On(c.id_kelurahan = b.id_kel_bgn)
				LEFT JOIN tr_kecamatan d On(d.id_kecamatan = b.id_kec_bgn)
				LEFT JOIN tr_kabkot e On(e.id_kabkot = b.id_kabkot_bgn)
				LEFT JOIN tr_provinsi f On(f.id_provinsi = b.id_prov_bgn)
				LEFT JOIN tm_retribusi g On(b.id = g.id)
				LEFT JOIN tmdatapbg h On(h.id = b.id)
				LEFT JOIN tr_fungsi_bg i On(b.id_fungsi_bg = i.id_fungsi_bg)
				LEFT JOIN tmdatajadwal j On(b.id = j.id)
				WHERE (a.id=$id)
			limit 1
			";
		$hasil = $this->db->query($sql);
		return $hasil->row_array();
	}

	function undang2ck()
	{
		$sql ="SELECT *
				FROM tr_uu_ck";
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	function perda($id='null')
	{
		$sql ="SELECT b.nama_perda
			FROM tmdatabangunan a
			LEFT JOIN tmdataperda b ON (b.id_kabkot=a.id_kabkot_bgn)
			WHERE (a.id_pemilik=$id)
			ORDER BY urutan ASC";
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	function datatanah($id='null')
	{
		$sql ="SELECT a.id, b.*,c.Jns_dok
				FROM tmdatabangunan a
				LEFT JOIN tmdatatanah b ON(b.id = a.id)
				LEFT JOIN tr_doktanah c ON(c.id = b.id_dokumen)
				WHERE (a.id=$id)";
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	public function datapemeriksaan($id='null')
	{
		$sql ="SELECT a.id, b.*,c.Jns_dok
				FROM tmdatabangunan a
				LEFT JOIN tmdatatanah b ON(b.id = a.id_pemilik)
				LEFT JOIN tr_doktanah c ON(c.id = b.id_dokumen)
				WHERE (a.id=$id)";
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	public function getDataKonsultasi($no_konsultasi=null) 
	{
		$sql = "SELECT a.id,a.nm_pemilik,
				b.almt_bgn,b.status,b.nm_bgn,b.id_fungsi_bg,b.luas_bgn,b.tipeA,b.tinggiA,b.luasA,b.jumlahA,b.lantaiA,
				c.nm_kadis,c.nip_kadis,c.no_sk_tk,c.date_sk_tk,c.dir_file_konsultasi,
				d.nama_kelurahan,
				e.nama_kecamatan,
				f.nama_kabkota,
				g.nama_provinsi,
				o.fungsi_bg,o.id_pemanfaatan_bg
       		FROM tmdatapemilik a
			LEFT JOIN tmdatabangunan b ON(b.id=a.id)
			LEFT JOIN tmdatajadwal c ON(c.id=a.id)
			LEFT JOIN tr_kelurahan d ON(d.id_kelurahan=b.id_kel_bgn)
			LEFT JOIN tr_kecamatan e ON(e.id_kecamatan=b.id_kec_bgn)
			LEFT JOIN tr_kabkot f ON(f.id_kabkot=b.id_kabkot_bgn)
			LEFT JOIN tr_provinsi g ON(g.id_provinsi=b.id_prov_bgn)
			LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=b.id_fungsi_bg)
			WHERE (1=1)";
		if ($no_konsultasi != null || trim($no_konsultasi) != '')  $sql .= " AND b.no_konsultasi = '$no_konsultasi' ";
		$hasil  = $this->db->query($sql);
		return $hasil ;
	}

	//Begin Cetak DokumenPBG
	function getdatabg($id=null,$cari=null)
	{
		$sql = "SELECT a.*
		FROM tmdatabangunan a
		WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function getdatapemilikDokPBG($id='null')
	{
		$sql = "SELECT a.id,a.nm_pemilik,a.alamat,
				b.nama_kelurahan,c.nama_kecamatan,d.nama_kabkota,e.nama_provinsi
				FROM tmdatapemilik a
				LEFT JOIN tr_kelurahan b ON(b.id_kelurahan = a.id_kelurahan)
				LEFT JOIN tr_kecamatan c ON(c.id_kecamatan = a.id_kecamatan)
				LEFT JOIN tr_kabkot d ON(d.id_kabkot = a.id_kabkota)
				LEFT JOIN tr_provinsi e ON(e.id_provinsi = a.id_provinsi)
				WHERE (a.id=$id)
			limit 1
			";
		$hasil = $this->db->query($sql);
		return $hasil->row_array();
	}

	function getdatabangunanDokPBG($id='null')
	{
		$sql = "SELECT a.id,
				b.id_kabkot_bgn,b.id_izin,b.id_jenis_permohonan,b.nm_bgn,b.almt_bgn,b.luas_bgn,b.id_fungsi_bg,b.jml_lantai,
				b.tipeA,b.luasA,b.tinggiA,b.lantaiA,b.jumlahA,b.luas_bgp,
				c.nama_kelurahan,
				d.nama_kecamatan,
				e.nama_kabkota,
				f.nama_provinsi,
				g.nilai_retribusi_bangunan,g.nilai_retribusi_prasarana,g.nilai_retribusi_keseluruhan,
				h.no_izin_pbg,h.nm_kadis,h.nip_kadis,h.tgl_pbg,
				i.fungsi_bg,i.id_pemanfaatan_bg,
				j.no_sk_tk,j.date_sk_tk,
				l.p_nama_dinas,
				k.jns_prasarana
				FROM tmdatapemilik a
				LEFT JOIN tmdatabangunan b ON(b.id = a.id)
				LEFT JOIN tr_kelurahan c On(c.id_kelurahan = b.id_kel_bgn)
				LEFT JOIN tr_kecamatan d On(d.id_kecamatan = b.id_kec_bgn)
				LEFT JOIN tr_kabkot e On(e.id_kabkot = b.id_kabkot_bgn)
				LEFT JOIN tr_provinsi f On(f.id_provinsi = b.id_prov_bgn)
				LEFT JOIN tm_retribusi g On(b.id = g.id)
				LEFT JOIN tmdatapbg h On(h.id = b.id)
				LEFT JOIN tr_fungsi_bg i On(b.id_fungsi_bg = i.id_fungsi_bg)
				LEFT JOIN tmdatajadwal j On(b.id = j.id)
				LEFT JOIN tm_profile_dinas l On(l.id_kabkot = b.id_kabkot_bgn)
				LEFT JOIN tr_prasarana k On(k.idp = b.id_prasarana_bg)
				WHERE (a.id=$id)
			limit 1
			";
		$hasil = $this->db->query($sql);
		return $hasil->row_array();
	}

	function datatanahPBG($id='null')
	{
		$sql ="SELECT a.id, b.*,c.Jns_dok
				FROM tmdatabangunan a
				LEFT JOIN tmdatatanah b ON(b.id = a.id)
				LEFT JOIN tr_doktanah c ON(c.id = b.id_dokumen)
				WHERE (a.id=$id)";
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	function getDataVerifikasi($id='null')
	{
		$sql = "SELECT a.id as id_pemilik,a.nm_pemilik,a.alamat,
            b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,b.id_prasarana_bg,
            b.tinggi_bgn,b.nm_bgn, b.id_izin,b.imb,b.id_fungsi_bg,b.id_jns_bg,b.tipeA,b.luasA,b.tinggiA,b.lantaiA,b.jumlahA,
            c.p_nama_dinas,c.kepala_dinas,c.nip_kepala_dinas,
		    d.no_sk_tk,d.date_sk_tk,
		    e.fungsi_bg,
            f.nama_provinsi as nm_prov_bgn,
            g.nama_kabkota as nm_kabkot_bgn,
             h.nama_kecamatan as nm_kec_bgn,
		    i.nama_kelurahan as nm_kel_bgn
				FROM tmdatapemilik a
				LEFT JOIN tmdatabangunan b ON(a.id = b.id)
				LEFT JOIN tm_profile_teknis c ON(b.id_kabkot_bgn = c.id_kabkot)
				LEFT JOIN tmdatajadwal d ON(a.id=d.id)
				LEFT JOIN tr_fungsi_bg e ON(b.id_fungsi_bg=e.id_fungsi_bg)
				LEFT JOIN tr_provinsi f ON(b.id_prov_bgn=f.id_provinsi)
				LEFT JOIN tr_kabkot g ON (b.id_kabkot_bgn=g.id_kabkot)
				LEFT JOIN tr_kecamatan h ON (b.id_kec_bgn=h.id_kecamatan)
				LEFT JOIN tr_kelurahan i ON(b.id_kel_bgn=i.id_kelurahan)
				WHERE (a.id=$id)
				
			limit 1
			";
		$hasil = $this->db->query($sql);
		return $hasil->row_array();
	}

	function getDataFungsiPrasarana($id_prasarana='null')
	{
		$sql = "SELECT a.*
				FROM tr_prasarana a
				WHERE(1=1) And a.idp=$id_prasarana
			";
		$hasil = $this->db->query($sql);
		return $hasil->row_array();
	}

	function getDataFungsiCampuran($fg_bg='null')
	{
		$sql = "SELECT a.*
				FROM tm_jenis_bg a
				WHERE(1=1) And a.id_fungsi_bg=$fg_bg 
			";
		$hasil = $this->db->query($sql);
		return $hasil->row_array();
	}

	function getDataFungsi($fg_bg='null', $jns_bg='null')
	{
		$sql = "SELECT a.*
				FROM tm_jenis_bg a
				WHERE(1=1) And a.id_fungsi_bg=$fg_bg AND a.id_jns_bg = $jns_bg
			";
		$hasil = $this->db->query($sql);
		return $hasil->row_array();
	}

	/*function undang2ck()
	{
		$sql ="SELECT *
				FROM tr_uu_ck";
		$hasil = $this->db->query($sql);
		return $hasil;
	}*/

	/*function perda($id='null')
	{
		$sql ="SELECT b.nama_perda
			FROM tmdatabangunan a
			LEFT JOIN tmdataperda b ON (a.id_kabkot_bgn=b.id_kabkot)
			WHERE (a.id=$id)
			ORDER BY urutan ASC";
		$hasil = $this->db->query($sql);
		return $hasil;
	}*/
	//End Cetak DokumenPBG
}
