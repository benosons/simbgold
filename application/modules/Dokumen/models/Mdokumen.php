<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mdokumen extends CI_Model
{
    function getdatapermohonan($id = null, $cari = null)
    {
        $sql = "SELECT a.id,a.id_izin,a.id_fungsi_bg,a.id_jns_bg,a.id_prasarana_bg,a.permohonan_slf,a.imb,a.status,a.id_dki,
                b.email
		FROM tmdatabangunan a
        LEFT Join tmdatapemilik b On(b.id=a.id)
		WHERE (1=1) ";
        if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
        if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
        $hasil  = $this->db->query($sql);
        return $hasil;
    }
    function getDataVerifikasiValKadintek($id = 'null'){
        $sql = "SELECT a.id as id_pemilik,a.nm_pemilik,a.alamat,
				b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,b.id_prasarana_bg,b.id_kabkot_bgn,b.status,b.id_resiko,b.id_lokasi,b.id_kelas,
				b.tinggi_bgn,b.nm_bgn, b.id_izin,b.imb,b.id_fungsi_bg,b.id_jns_bg,b.tipeA,b.luasA,b.tinggiA,b.lantaiA,b.jumlahA,b.luas_bgp,b.tinggi_bgp,b.status,b.no_imb,b.permohonan_slf,b.luas_basement,
				c.p_nama_dinas,c.kepala_dinas,c.nip_kepala_dinas,c.status_pejabat,
				e.fungsi_bg,
				f.nama_provinsi as nm_prov_bgn,
				g.nama_kabkota as nm_kabkot_bgn,
				h.nama_kecamatan as nm_kec_bgn,
				i.nama_kelurahan as nm_kel_bgn,
				j.jns_prasarana,
				k.tgl_validasi,k.nama_kadis,k.nama_dinas,k.stat_pejabat,k.no_sppst,k.nip_kadis,
                l.no_sk_tk
				FROM tmdatapemilik a
				LEFT JOIN tmdatabangunan b ON(a.id = b.id)
				LEFT JOIN tm_profile_teknis c ON(b.id_kabkot_bgn = c.id_kabkot)
				LEFT JOIN tr_fungsi_bg e ON(b.id_fungsi_bg=e.id_fungsi_bg)
				LEFT JOIN tr_provinsi f ON(b.id_prov_bgn=f.id_provinsi)
				LEFT JOIN tr_kabkot g ON (b.id_kabkot_bgn=g.id_kabkot)
				LEFT JOIN tr_kecamatan h ON (b.id_kec_bgn=h.id_kecamatan)
				LEFT JOIN tr_kelurahan i ON(b.id_kel_bgn=i.id_kelurahan)
                LEFT JOIN tr_prasarana j ON(b.id_prasarana_bg=j.idp)
                LEFT JOIN tmdatavalkadintek k On(b.id = k.id)
                LEFT JOIN tmdatajadwal l On(b.id = l.id)
				WHERE (a.id=$id)
			limit 1
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
    }

    function getDataVerifikasiValKadintekDki($id = 'null'){
        $sql = "SELECT a.id as id_pemilik,a.nm_pemilik,a.alamat,
				b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,b.id_prasarana_bg,b.id_kabkot_bgn,b.status,b.id_resiko,b.id_lokasi,b.id_kelas,
				b.tinggi_bgn,b.nm_bgn, b.id_izin,b.imb,b.id_fungsi_bg,b.id_jns_bg,b.tipeA,b.luasA,b.tinggiA,b.lantaiA,b.jumlahA,b.luas_bgp,b.tinggi_bgp,b.status,b.no_imb,b.permohonan_slf,b.luas_basement,
				c.p_nama_dinas,c.kepala_dinas,c.nip_kepala_dinas,c.status_pejabat,
				e.fungsi_bg,
				f.nama_provinsi as nm_prov_bgn,
				g.nama_kabkota as nm_kabkot_bgn,
				h.nama_kecamatan as nm_kec_bgn,
				i.nama_kelurahan as nm_kel_bgn,
				j.jns_prasarana,
				k.tgl_validasi,k.nama_kadis,k.nama_dinas,k.stat_pejabat,k.no_sppst,k.nip_kadis,
                l.no_sk_tk
				FROM tmdatapemilik a
				LEFT JOIN tmdatabangunan b ON(a.id = b.id)
				LEFT JOIN tm_profile_teknis c ON(b.id_prov_bgn = c.id_kabkot)
				LEFT JOIN tr_fungsi_bg e ON(b.id_fungsi_bg=e.id_fungsi_bg)
				LEFT JOIN tr_provinsi f ON(b.id_prov_bgn=f.id_provinsi)
				LEFT JOIN tr_kabkot g ON (b.id_kabkot_bgn=g.id_kabkot)
				LEFT JOIN tr_kecamatan h ON (b.id_kec_bgn=h.id_kecamatan)
				LEFT JOIN tr_kelurahan i ON(b.id_kel_bgn=i.id_kelurahan)
                LEFT JOIN tr_prasarana j ON(b.id_prasarana_bg=j.idp)
                LEFT JOIN tmdatavalkadintek k On(b.id = k.id)
                LEFT JOIN tmdatajadwal l On(b.id = l.id)
				WHERE (a.id=$id)
			limit 1
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
    }

    function getDataVerifikasi($id = 'null'){
        $sql = "SELECT a.id as id_pemilik,a.nm_pemilik,a.alamat,
            b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,b.id_prasarana_bg,b.id_kabkot_bgn,
            b.tinggi_bgn,b.nm_bgn, b.id_izin,b.imb,b.id_fungsi_bg,b.id_jns_bg,b.tipeA,b.luasA,b.tinggiA,b.lantaiA,b.jumlahA,b.luas_bgp,b.tinggi_bgp,b.status,b.id_dki,
            c.p_nama_dinas,c.kepala_dinas,c.nip_kepala_dinas,c.status_pejabat,
            d.no_sk_tk,d.date_sk_tk,d.nm_kadis,d.nip_kadis,
            e.fungsi_bg,
            f.nama_provinsi as nm_prov_bgn,
            g.nama_kabkota as nm_kabkot_bgn,
            h.nama_kecamatan as nm_kec_bgn,
            i.nama_kelurahan as nm_kel_bgn,
            j.jns_prasarana,
            k.tgl_validasi,k.nama_kadis,k.nama_dinas,k.stat_pejabat,k.nip_kadis as nip_kadin
				FROM tmdatapemilik a
				LEFT JOIN tmdatabangunan b ON(a.id = b.id)
				LEFT JOIN tm_profile_teknis c ON(b.id_kabkot_bgn = c.id_kabkot)
				LEFT JOIN tmdatajadwal d ON(a.id=d.id)
				LEFT JOIN tr_fungsi_bg e ON(b.id_fungsi_bg=e.id_fungsi_bg)
				LEFT JOIN tr_provinsi f ON(b.id_prov_bgn=f.id_provinsi)
				LEFT JOIN tr_kabkot g ON (b.id_kabkot_bgn=g.id_kabkot)
				LEFT JOIN tr_kecamatan h ON (b.id_kec_bgn=h.id_kecamatan)
				LEFT JOIN tr_kelurahan i ON(b.id_kel_bgn=i.id_kelurahan)
                LEFT JOIN tr_prasarana j ON(b.id_prasarana_bg=j.idp)
                LEFT JOIN tmdatavalkadintek k On(b.id = k.id)
				WHERE (a.id=$id)
			limit 1
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
    }

    function getDataVerifikasiDki($id = 'null'){
        $sql = "SELECT a.id as id_pemilik,a.nm_pemilik,a.alamat,
            b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,b.id_prasarana_bg,b.id_kabkot_bgn,
            b.tinggi_bgn,b.nm_bgn, b.id_izin,b.imb,b.id_fungsi_bg,b.id_jns_bg,b.tipeA,b.luasA,b.tinggiA,b.lantaiA,b.jumlahA,b.luas_bgp,b.tinggi_bgp,b.status,b.id_dki,
            c.p_nama_dinas,c.kepala_dinas,c.nip_kepala_dinas,c.status_pejabat,
            d.no_sk_tk,d.date_sk_tk,d.nm_kadis,d.nip_kadis,
            e.fungsi_bg,
            f.nama_provinsi as nm_prov_bgn,
            g.nama_kabkota as nm_kabkot_bgn,
            h.nama_kecamatan as nm_kec_bgn,
            i.nama_kelurahan as nm_kel_bgn,
            j.jns_prasarana,
            k.tgl_validasi,k.nama_kadis,k.nama_dinas,k.stat_pejabat,k.nip_kadis as nip_kadin
				FROM tmdatapemilik a
				LEFT JOIN tmdatabangunan b ON(a.id = b.id)
				LEFT JOIN tm_profile_teknis c ON(b.id_prov_bgn = c.id_kabkot)
				LEFT JOIN tmdatajadwal d ON(a.id=d.id)
				LEFT JOIN tr_fungsi_bg e ON(b.id_fungsi_bg=e.id_fungsi_bg)
				LEFT JOIN tr_provinsi f ON(b.id_prov_bgn=f.id_provinsi)
				LEFT JOIN tr_kabkot g ON (b.id_kabkot_bgn=g.id_kabkot)
				LEFT JOIN tr_kecamatan h ON (b.id_kec_bgn=h.id_kecamatan)
				LEFT JOIN tr_kelurahan i ON(b.id_kel_bgn=i.id_kelurahan)
                LEFT JOIN tr_prasarana j ON(b.id_prasarana_bg=j.idp)
                LEFT JOIN tmdatavalkadintek k On(b.id = k.id)
				WHERE (a.id=$id)
			limit 1
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
    }

    
    function getdatapemilikDok($id = 'null')
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
    function getdatabangunanDok($id = 'null')
    {
        $sql = "SELECT a.id,
				b.id_kabkot_bgn,b.id_izin,b.nm_bgn,b.almt_bgn,b.luas_bgn,b.id_fungsi_bg,b.jml_lantai,
                b.id_jenis_permohonan,b.imb,
                b.tipeA,b.luasA,b.lantaiA,b.tinggiA,b.jumlahA,b.no_imb,b.luas_bgp,
				c.nama_kelurahan,
				d.nama_kecamatan,
				e.nama_kabkota,
				f.nama_provinsi,
				g.nilai_retribusi_bangunan,g.nilai_retribusi_prasarana,g.nilai_retribusi_keseluruhan,
				h.no_izin_pbg,h.nm_kadis,h.nip_kadis,h.tgl_validasi,h.status_pejabat,h.tgl_pbg,
				i.fungsi_bg,i.id_pemanfaatan_bg,i.fungsi_bg,
				j.no_sk_tk,j.date_sk_tk,
                k.no_slf,k.nm_kadis_teknis,k.nip_kadis_teknis,k.nm_dinas,k.tgl_penerbitan_slf,k.okupansi,k.luas_dasar,
                l.p_nama_dinas,l.kepala_dinas,l.nip_kepala_dinas,l.status_pejabat as status_pej
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
                LEFT JOIN tmdataslf k On(b.id = k.id)
                LEFT JOIN tm_profile_dinas l on(b.id_kabkot_bgn =l.id_kabkot)
				WHERE (a.id=$id)
			limit 1
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
    }
    
    function getDataVerifikasiEksis($id = 'null')
    {
        $sql = "SELECT a.id as id_pemilik,a.nm_pemilik,a.alamat,
            b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,
            b.id_prasarana_bg,b.id_kabkot_bgn,b.no_imb,b.status,b.id_dki,
            b.tinggi_bgn,b.nm_bgn,b.id_izin,b.imb,b.id_fungsi_bg,b.id_jns_bg,b.tipeA,b.luasA,b.tinggiA,b.lantaiA,b.jumlahA,b.luas_bgp,b.tinggi_bgp,
            c.p_nama_dinas,c.kepala_dinas,c.nip_kepala_dinas,c.status_pejabat,
            d.no_sk_tk,d.date_sk_tk,d.nm_kadis,d.nip_kadis,d.status_pejabat as stat_pejabat,
            e.fungsi_bg,
            f.nama_provinsi as nm_prov_bgn,
            g.nama_kabkota as nm_kabkot_bgn,
            h.nama_kecamatan as nm_kec_bgn,
            i.nama_kelurahan as nm_kel_bgn,
            j.jns_prasarana,
            k.no_slf,k.tgl_penerbitan_slf,k.nm_kadis_teknis,k.okupansi
				FROM tmdatapemilik a
				LEFT JOIN tmdatabangunan b ON(a.id = b.id)
				LEFT JOIN tm_profile_teknis c ON(b.id_kabkot_bgn = c.id_kabkot)
				LEFT JOIN tmdatajadwal d ON(a.id=d.id)
				LEFT JOIN tr_fungsi_bg e ON(b.id_fungsi_bg=e.id_fungsi_bg)
				LEFT JOIN tr_provinsi f ON(b.id_prov_bgn=f.id_provinsi)
				LEFT JOIN tr_kabkot g ON (b.id_kabkot_bgn=g.id_kabkot)
				LEFT JOIN tr_kecamatan h ON (b.id_kec_bgn=h.id_kecamatan)
				LEFT JOIN tr_kelurahan i ON(b.id_kel_bgn=i.id_kelurahan)
                LEFT JOIN tr_prasarana j ON(b.id_prasarana_bg=j.idp)
                LEFT JOIN tmdataslf k ON(b.id=k.id)
				WHERE (a.id=$id)
			limit 1
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
    }
    function getDataValidasiEksis($id = 'null'){
        $sql = "SELECT a.id as id_pemilik,a.nm_pemilik,a.alamat,
            b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,b.id_prasarana_bg,b.id_kabkot_bgn,b.status,
            b.tinggi_bgn,b.nm_bgn, b.id_izin,b.imb,b.id_fungsi_bg,b.id_jns_bg,b.tipeA,b.luasA,b.tinggiA,b.lantaiA,b.jumlahA,b.luas_bgp,b.tinggi_bgp,b.no_imb,
            c.p_nama_dinas,c.kepala_dinas,c.nip_kepala_dinas,c.status_pejabat,
            d.no_sk_tk,d.date_sk_tk,d.nm_kadis,d.status_pejabat as stat_pejabat,
            e.fungsi_bg,
            f.nama_provinsi,
            g.nama_kabkota,
            h.nama_kecamatan,
            i.nama_kelurahan,
            j.jns_prasarana,
            k.no_slf,k.nm_kadis_teknis,k.nip_kadis_teknis,k.nm_dinas,k.tgl_penerbitan_slf,k.okupansi,k.luas_dasar,
            l.tgl_validasi,l.nip_kadis,l.nama_kadis,l.nama_dinas
				FROM tmdatapemilik a
				LEFT JOIN tmdatabangunan b ON(a.id = b.id)
				LEFT JOIN tm_profile_teknis c ON(b.id_kabkot_bgn = c.id_kabkot)
				LEFT JOIN tmdatajadwal d ON(a.id=d.id)
				LEFT JOIN tr_fungsi_bg e ON(b.id_fungsi_bg=e.id_fungsi_bg)
				LEFT JOIN tr_provinsi f ON(b.id_prov_bgn=f.id_provinsi)
				LEFT JOIN tr_kabkot g ON (b.id_kabkot_bgn=g.id_kabkot)
				LEFT JOIN tr_kecamatan h ON (b.id_kec_bgn=h.id_kecamatan)
				LEFT JOIN tr_kelurahan i ON(b.id_kel_bgn=i.id_kelurahan)
                LEFT JOIN tr_prasarana j ON(b.id_prasarana_bg=j.idp)
                LEFT JOIN tmdataslf k On(b.id = k.id)
                LEFT JOIN tmdatavalkadintek l On(b.id = l.id)
				WHERE (a.id=$id)
				
			limit 1
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
    }

    function get_jenis_fungsi_list($id = null, $fungsi_bg = null, $id_pemanfaatan_bg = null)
    {
        if ($id != null || trim($id) != '')
            $this->db->where('id_fungsi_bg', $id);
        if ($fungsi_bg != null || trim($fungsi_bg) != '')
            $this->db->like('fungsi_bg', $fungsi_bg, 'both');
        if ($id_pemanfaatan_bg != null || trim($id_pemanfaatan_bg) != '')
            $this->db->where('id_pemanfaatan_bg', $id_pemanfaatan_bg);
        $this->db->order_by('id_fungsi_bg', 'asc');
        $hasil =  $this->db->get('tr_fungsi_bg');
        return $hasil;
    }

    function get_permohonan_list($id)
    {
        $this->db->select('a.id as id_pemilik,a.no_ktp,a.nm_pemilik,a.email,a.no_hp,a.id_kabkota,a.alamat,
        b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_kec_bgn,b.id_fungsi_bg,b.imb,b.tipeA,b.luasA,b.tinggiA,b.jumlahA,b.lantaiA,
        b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.luas_bgn,b.tinggi_bgn,id_kabkot_bgn,b.luas_bgp,b.tinggi_bgp,
        b.status,b.jml_lantai,h.nama_kabkota,i.nama_provinsi,b.nm_bgn,b.tgl_pernyataan,
        d.nama_kelurahan,
        e.nama_kecamatan,a.id_kecamatan,a.id_provinsi,b.id_izin,b.imb,
        c.nm_konsultasi,
        f.fungsi_bg,
        g.nama_kecamatan as nama_kec_bg,
        m.nama_kelurahan as nama_kel_bg,
        j.nama_kabkota as nama_kabkota_bg,k.nama_provinsi as nama_provinsi_bg,a.id_kelurahan,a.jns_pemilik,l.jns_prasarana');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >= 5 ");
        $this->db->where('b.no_konsultasi', $id);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_kelurahan d', 'd.id_kelurahan = a.id_kelurahan', 'LEFT');
        $this->db->join('tr_kecamatan e', 'e.id_kecamatan = a.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot h', 'h.id_kabkot = a.id_kabkota', 'LEFT');
        $this->db->join('tr_provinsi i', 'i.id_provinsi = a.id_provinsi', 'LEFT');
        $this->db->join('tr_fungsi_bg f', 'f.id_fungsi_bg = b.id_fungsi_bg', 'left');
        $this->db->join('tr_kelurahan m', 'm.id_kelurahan = b.id_kel_bgn', 'LEFT');
        $this->db->join('tr_kecamatan g', 'g.id_kecamatan = b.id_kec_bgn', 'LEFT');
        $this->db->join('tr_kabkot j', 'j.id_kabkot = b.id_kabkot_bgn', 'LEFT');
        $this->db->join('tr_provinsi k', 'k.id_provinsi = b.id_prov_bgn', 'LEFT');
        $this->db->join('tr_prasarana l', 'l.idp = b.id_prasarana_bg', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function getSyaratList2($per = null, $kls = null)
    {
        $sql = "SELECT a.id_persyaratan,a.id,a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan,b.id_detail,b.id_syarat,c.nm_dokumen,c.keterangan,e.dir_file 
        FROM tr_konsultasi_syarat a 
        LEFT JOIN tr_pbg_syarat_detail b ON(a.id_persyaratan=b.id_persyaratan) 
        LEFT JOIN tr_dokumen_syarat c ON(b.id_syarat=c.id) 
        LEFT JOIN tmdatabangunan d ON(a.id=d.id_jenis_permohonan) 
        LEFT JOIN tr_protipe e ON(d.idp=e.idp) 
        WHERE (1=1)";
        if ($per != null || trim($per) != '')  $sql .= " AND a.id = '$per' ";
        if ($kls != null || trim($kls) != '')  $sql .= " AND a.id_detail_jenis_persyaratan = '$kls' ";
        $sql .= " Group by b.id_detail ORDER BY a.id, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat ASC ";
        $hasil  = $this->db->query($sql);
        return $hasil;
    }

    public function getSyaratList($per = NULL, $kls = NULL)
    {
        $this->db->distinct();
        $this->db->select('a.id_persyaratan,a.id,a.id as id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,b.id_detail,b.id_syarat,c.nm_dokumen,c.keterangan,e.dir_file');
        $this->db->from('tr_konsultasi_syarat a');
        $this->db->join('tr_pbg_syarat_detail b', 'b.id_persyaratan = a.id_persyaratan', 'left');
        $this->db->join('tr_dokumen_syarat c', 'c.id = b.id_syarat', 'left');
        $this->db->join('tmdatabangunan d', 'a.id = d.id_jenis_permohonan', 'left');
        $this->db->join('tr_protipe e', 'e.idp = e.idp', 'left');
        if ($per != null || trim($per) != '')  $this->db->where('a.id', $per);
        if ($kls != null || trim($kls) != '')  $this->db->where('a.id_detail_jenis_persyaratan', $kls);
        $this->db->group_by('b.id_detail');
        $this->db->order_by('a.id, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat', 'ASC');
        return $this->db->get();
    }

    
    public function updateDataCatatan($id_pemilik, $id_syarat, $id_persyaratan_detail, $data)
    {
        return $this->db->where('id', $id_pemilik)
            ->where('id_persyaratan', $id_syarat)
            ->where('id_persyaratan_detail', $id_persyaratan_detail)
            ->update('tmpersyaratankonsultasi', $data);
    }

    public function getDataBerkas($dataKonsultasi, $id_persyaratan_detail, $id_syarat)
    {
        return $this->db->get_where("tmpersyaratankonsultasi", [
            'id' => $dataKonsultasi,
            'id_persyaratan_detail' => $id_persyaratan_detail,
            'id_persyaratan' => $id_syarat
        ]);
    }

    public function insertBerkas($data)
    {
        return $this->db->insert('tmpersyaratankonsultasi', $data);
    }

    public function updateBerkas($id_pemilik, $id_persyaratan_detail, $id_syarat, $data)
    {
        return $this->db->where('id', $id_pemilik)
            ->where('id_persyaratan', $id_syarat)
            ->where('id_persyaratan_detail', $id_persyaratan_detail)
            ->update('tmpersyaratankonsultasi', $data);
    }

    public function cekBerkas($dataKonsultasi, $id_persyaratan_detail, $id_syarat)
    {
        return $this->db->get_where("tmpersyaratankonsultasi", [
            'id' => $dataKonsultasi,
            'id_persyaratan_detail' => $id_persyaratan_detail,
            'id_persyaratan' => $id_syarat
        ]);
    }

    public function cekKesesuaian($val, $id)
    {
        $this->db->distinct();
        $this->db->select('tmpersyaratankonsultasi.id_persyaratan_detail,tmpersyaratankonsultasi.id_persyaratan,kesesuaian,nm_dokumen');
        $this->db->from('tmpersyaratankonsultasi');
        $this->db->join('tr_pbg_syarat_detail', 'tr_pbg_syarat_detail.id_detail = tmpersyaratankonsultasi.id_persyaratan_detail', 'left');
        $this->db->join('tr_konsultasi_syarat', 'tr_konsultasi_syarat.id_detail_jenis_persyaratan = tr_pbg_syarat_detail.id_detail', 'left');
        $this->db->join('tr_dokumen_syarat', 'tr_dokumen_syarat.id = tr_pbg_syarat_detail.id_syarat', 'left');
        $this->db->join('tr_konsultasi_syarat r', 'r.id_persyaratan = tr_dokumen_syarat.id', 'left');
        $this->db->where_in('tmpersyaratankonsultasi.id_persyaratan', $val);
        $this->db->where_in('tmpersyaratankonsultasi.id_persyaratan_detail', $id);
        return  $this->db->get();
    }

    public function cekBelumSesuai($val, $id)
    {
        $this->db->distinct();
        $this->db->select('tmpersyaratankonsultasi.id_persyaratan_detail,tmpersyaratankonsultasi.id_persyaratan,kesesuaian,nm_dokumen');
        $this->db->from('tmpersyaratankonsultasi');
        $this->db->join('tr_dokumen_syarat', 'tr_dokumen_syarat.id = tmpersyaratankonsultasi.id_persyaratan', 'left');
        $this->db->join('tr_konsultasi_syarat', 'tr_konsultasi_syarat.id_persyaratan = tr_dokumen_syarat.id', 'left');
        $this->db->where_in('tmpersyaratankonsultasi.id_persyaratan', $val);
        $this->db->where('tmpersyaratankonsultasi.id_persyaratan_detail', $id);
        $this->db->where('tmpersyaratankonsultasi.kesesuaian', 0);
        return  $this->db->get();
    }


    public function getSyaratListId($per = NULL, $kls = NULL)
    {
        $this->db->distinct();

        $this->db->select('a.id,a.id_detail_jenis_persyaratan,b.id_syarat,b.id_detail,c.nm_dokumen');
        $this->db->from('tr_konsultasi_syarat a');
        $this->db->join('tr_pbg_syarat_detail b', 'b.id_persyaratan = a.id_persyaratan', 'left');
        $this->db->join('tr_dokumen_syarat c', 'c.id = b.id_syarat', 'left');
        $this->db->join('tmdatabangunan d', 'a.id = d.id_jenis_permohonan', 'left');
        $this->db->join('tr_protipe e', 'e.idp = e.idp', 'left');
        if ($per != null || trim($per) != '')  $this->db->where('a.id', $per);
        if ($kls != null || trim($kls) != '')  $this->db->where_in('a.id_detail_jenis_persyaratan', $kls);
        $this->db->group_by('b.id_detail');
        $this->db->order_by('a.id, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat', 'ASC');
        return $this->db->get();
    }

    public function cekStep($id)
    {
        $this->db->select('data_step');
        $this->db->where('id', $id);
        return $this->db->get('tmdatabangunan');
    }

    public function saveStep($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tmdatabangunan', $data);
    }

    public function getSyaratGroup($per = NULL, $kls = NULL)
    {
        $this->db->distinct();
        $this->db->select('a.id_persyaratan,a.id,a.id as id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,b.id_detail,b.id_syarat,c.nm_dokumen,c.keterangan,e.dir_file');
        $this->db->from('tr_konsultasi_syarat a');
        $this->db->join('tr_pbg_syarat_detail b', 'b.id_persyaratan = a.id_persyaratan', 'left');
        $this->db->join('tr_dokumen_syarat c', 'c.id = b.id_syarat', 'left');
        $this->db->join('tmdatabangunan d', 'a.id = d.id_jenis_permohonan', 'left');
        $this->db->join('tr_protipe e', 'e.idp = e.idp', 'left');
        if ($per != null || trim($per) != '')  $this->db->where('a.id', $per);
        if ($kls != null || trim($kls) != '')  $this->db->where_in('a.id_detail_jenis_persyaratan', $kls);
        $this->db->group_by('b.id_detail');
        $this->db->order_by('a.id, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat', 'ASC');
        return $this->db->get();
    }

    public function getIdKonsultasi($id)
    {
        return $this->db
            ->select('id')
            ->from('tmdatabangunan')
            ->where('id', $id)
            ->get();
    }

    public function insertPerbaikan($data)
    {
        return $this->db->insert('tm_perbaikan_sidang', $data);
    }

    public function updateStatsPbg($id, $data)
    {
        return $this->db->where('id', $id)->update('tmdatabangunan', $data);
    }

    public function updateHasilPenilaian($id, $data)
    {
        return $this->db->where('id', $id)->update('tmdatajadwal', $data);
    }

    function getDataFungsi($fg_bg = 'null', $jns_bg = 'null')
    {
        $sql = "SELECT a.*
				FROM tm_jenis_bg a
				WHERE(1=1) And a.id_fungsi_bg=$fg_bg AND a.id_jns_bg = $jns_bg
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
    }

    function getDataFungsiCampuran($fg_bg = 'null')
    {
        $sql = "SELECT a.*
				FROM tr_fungsi_bg a
				WHERE(1=1) And a.id_fungsi_bg=$fg_bg 
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
    }

    function getDataFungsiPrasarana($id_prasarana = 'null')
    {
        $sql = "SELECT a.*
				FROM tr_prasarana a
				WHERE(1=1) And a.idp=$id_prasarana
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
    }

    //Begin Model Untuk Data Tanah
    function tanah($id = 'null')
    {
        $sql = "SELECT a.id, b.*,c.Jns_dok
				FROM tmdatapemilik a
				LEFT JOIN tmdatatanah b ON(b.id=a.id)
                LEFT JOIN tr_doktanah c ON(c.id=b.id_dokumen)
                WHERE (a.id=$id)";
        $hasil = $this->db->query($sql);
        return $hasil;
    }
    function getdataizin($id=null,$cari=null)
	{
		$sql = "SELECT a.*
		FROM tmdatabangunan a
		WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$hasil  = $this->db->query($sql);
		return $hasil;
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

    public function updateProgress($dataProgress, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tmdatabangunan', $dataProgress);
        $updated_status = $this->db->affected_rows();
    }

    // get data bangunan 
    public function getBangunan($select = "*", $id)
    {
        $this->db->select($select, FALSE);
        if ($id != null || trim($id) != '')
            $this->db->where('a.id', $id);
        $this->db->join('tr_kecamatan b', 'a.id_kec_bgn = b.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot c', 'a.id_kabkot_bgn = c.id_kabkot', 'LEFT');
        $this->db->join('tr_provinsi d', 'a.id_prov_bgn = d.id_provinsi', 'LEFT');
        $this->db->join('tr_konsultasi e', 'a.id_jenis_permohonan = e.id', 'LEFT');
        $query     = $this->db->get('tmdatabangunan a');
        return $query->row();
    }

    public function periksaKesesuaian($id)
    {
        $this->db->distinct();
        $this->db->select('tmpersyaratankonsultasi.id_persyaratan_detail,tmpersyaratankonsultasi.id_persyaratan,kesesuaian,nm_dokumen');
        $this->db->from('tmpersyaratankonsultasi');
        $this->db->join('tr_pbg_syarat_detail', 'tr_pbg_syarat_detail.id_detail = tmpersyaratankonsultasi.id_persyaratan_detail', 'left');
        $this->db->join('tr_konsultasi_syarat', 'tr_konsultasi_syarat.id_detail_jenis_persyaratan = tr_pbg_syarat_detail.id_detail', 'left');
        $this->db->join('tr_dokumen_syarat', 'tr_dokumen_syarat.id = tr_pbg_syarat_detail.id_syarat', 'left');
        $this->db->join('tr_konsultasi_syarat r', 'r.id_persyaratan = tr_dokumen_syarat.id', 'left');
        $this->db->where('tmpersyaratankonsultasi.id_persyaratan', $id);
        return  $this->db->get();
    }

    public function cekTidakKesesuaian($id)
    {
        $this->db->distinct();
        $this->db->select('tmpersyaratankonsultasi.id_persyaratan_detail,tmpersyaratankonsultasi.id_persyaratan,kesesuaian,nm_dokumen');
        $this->db->from('tmpersyaratankonsultasi');
        $this->db->join('tr_dokumen_syarat', 'tr_dokumen_syarat.id = tmpersyaratankonsultasi.id_persyaratan', 'left');
        $this->db->join('tr_konsultasi_syarat', 'tr_konsultasi_syarat.id_persyaratan = tr_dokumen_syarat.id', 'left');
        $this->db->where('tmpersyaratankonsultasi.id_persyaratan', $id);
        $this->db->where('tmpersyaratankonsultasi.kesesuaian', 0);
        return  $this->db->get();
    }

    public function getDataPemeriksaanKesesuaian($id, $id_pemilik)
    {
        return $this->db
            ->select('*')
            ->where('id_persyaratan_detail', $id)
            ->where('id', $id_pemilik)
            ->distinct()
            ->from('tmpersyaratankonsultasi')
            ->order_by('id_detail', 'DESC')
            ->get();
    }

    //Begin Draf SLF Bangunan Eksisting
    function get_id_kabkot($id)
    {
        $sql = "SELECT id, id_kabkot_bgn, id_kec_bgn , id_kel_bgn
					FROM tmdatabangunan where id = " . $id;
        $hasil = $this->db->query($sql)->row_array();
        return $hasil;
    }

    function getNoDrafSlf($id_kec_bgn, $tgl_skrg)
    {
        $sql = "SELECT max(no_slf) as no_registrasi_baru 
			FROM tmdataslf 
			WHERE SUBSTR(no_slf,8,6) = '$id_kec_bgn' and SUBSTR(no_slf,15,8) = '$tgl_skrg'";
        $hasil = $this->db->query($sql)->row_array();
        return $hasil;
    }

    function get_pejabat($id)
    {
        $sql = "SELECT a.id,a.id_kabkot_bgn, b.kepala_dinas, b.nip_kepala_dinas, b.p_nama_dinas
        FROM tmdatabangunan a 
        left join tm_profile_teknis b On (a.id_kabkot_bgn = b.id_kabkot)
        where a.id = $id";
        $hasil = $this->db->query($sql)->row_array();
        return $hasil;
    }

    function insertdataslf($dataInSLF)
    {
        $this->db->insert('tmdataslf', $dataInSLF);
        return $this->db->insert_id();
    }

    function getdataslf($id = 'null')
    {
        $sql = "SELECT a.id,
				b.id_kabkot_bgn,b.id_izin,b.nm_bgn,b.almt_bgn,b.luas_bgn,b.id_fungsi_bg,b.jml_lantai,
				c.nama_kelurahan,
				d.nama_kecamatan,
				e.nama_kabkota,
				f.nama_provinsi,
				g.nilai_retribusi_bangunan,g.nilai_retribusi_prasarana,g.nilai_retribusi_keseluruhan,
				h.no_izin_pbg,h.nm_kadis,h.nip_kadis,
				i.fungsi_bg,i.id_pemanfaatan_bg,
				j.no_sk_tk,j.date_sk_tk
				FROM tmdatapemilik a
				LEFT JOIN tmdatabangunan b ON(b.id = a.id)
				LEFT JOIN tr_kelurahan c On(c.id_kelurahan = b.id_kel_bgn)
				LEFT JOIN tr_kecamatan d On(d.id_kecamatan = b.id_kec_bgn)
				LEFT JOIN tr_kabkot e On(e.id_kabkot = b.id_kabkot_bgn)
				LEFT JOIN tr_provinsi f On(f.id_provinsi = b.id_prov_bgn)
				LEFT JOIN tm_retribusi g On(b.id = g.id)
				LEFT JOIN tmdatapbg h On(g.id = b.id)
				LEFT JOIN tr_fungsi_bg i On(b.id_fungsi_bg = i.id_fungsi_bg)
				LEFT JOIN tmdatajadwal j On(b.id = j.id)
				WHERE (a.id=$id)
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
    }
    //End Draft SLF Bangunan Eksisting
    public function insertDataPenolakan($data)
    {
        return $this->db->insert('tmpenolakan', $data);
    }

    function getcatatan($select = "*", $id)
    {
        $this->db->select($select, FALSE);
        if ($id != null || trim($id) != '')
            $this->db->where('a.id', $id);
        $query     = $this->db->get('tmdatabangunan a');
        return $query->row();
    }
    //Begin Model Untuk Dokumen Sertifikat Laik Fungsi
    function getdatabangunanDokSLF($id='null')
	{
		$sql = "SELECT a.id,
				b.id_kabkot_bgn,b.id_izin,b.id_jenis_permohonan,b.nm_bgn,b.almt_bgn,b.luas_bgn,b.id_fungsi_bg,
				b.jml_lantai,b.tipeA,b.luasA,b.tinggiA,b.lantaiA,b.jumlahA,b.no_imb,b.status,b.permohonan_slf,b.luas_bgp,b.tinggi_bgp,
				c.nama_kelurahan,
				d.nama_kecamatan,
				e.nama_kabkota,
				f.nama_provinsi,
				g.nilai_retribusi_bangunan,g.nilai_retribusi_prasarana,g.nilai_retribusi_keseluruhan,g.file_retribusi,
				h.no_izin_pbg,h.nm_kadis,h.nip_kadis,h.tgl_pbg,h.status_pejabat,
				i.fungsi_bg,i.id_pemanfaatan_bg,
				j.no_sk_tk,j.date_sk_tk,
                k.no_slf,k.nm_kadis_teknis,k.nip_kadis_teknis,k.nm_dinas,k.tgl_penerbitan_slf,k.okupansi,k.luas_dasar,
				l.kepala_dinas,l.nip_kepala_dinas,l.p_nama_dinas,l.status_pejabat as stat_pejabat
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
                LEFT JOIN tmdataslf k On(b.id = k.id)
				LEFT JOIN tm_profile_dinas l On(l.id_kabkot = b.id_kabkot_bgn)
				WHERE (a.id=$id)
			limit 1
			";
		$hasil = $this->db->query($sql);
		return $hasil->row_array();
	}
    //End Model Untuk Dokumen Sertifikat Laik Fungsi
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

    //Begin Cetak IMB SIMBG ver Lama
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
    function getDataKolektif($id='null')
	{
		$sql ="SELECT a.id_permohonan,b.*
				FROM tm_imb_permohonan a
				LEFT JOIN tm_imb_kolektif b ON(a.id_permohonan=b.id_permohonan)
				WHERE (a.id_permohonan=$id)";
		$hasil = $this->db->query($sql);
		return $hasil;
	}
    function Datatanah($id='null')
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
    
    function getDataPenilaian($id='null')
	{
		$sql = "SELECT a.*
				FROM tm_imb_penjadwalan a
				WHERE (a.id_permohonan=$id)
				AND a.status_perbaikan = '2'
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
    function undang2()
	{
		$sql ="SELECT *
						FROM tr_uu";
		$hasil = $this->db->query($sql);
		return $hasil;
	}
    //End Cetak IMB SIMBG Ver Lama

}
/* End of file Mpemeriksaan.php */
