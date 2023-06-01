<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MDokumen extends CI_Model
{
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

	function getdatapemilikDok($id='null')
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

	function getdatabangunanDok($id='null')
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
			LEFT JOIN tmdataperda b ON (a.id_kabkot_bgn=b.id_kabkot)
			WHERE (a.id=$id)
			ORDER BY urutan ASC";
		$hasil = $this->db->query($sql);
		return $hasil;
	}
}
