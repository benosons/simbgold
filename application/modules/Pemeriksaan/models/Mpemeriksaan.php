<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mpemeriksaan extends CI_Model
{
    public function  getListKonsultasi()
    {
        $dev = $this->session->userdata('loc_role_id');
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.id,a.nm_pemilik,b.nm_konsultasi,c.status,c.tgl_pernyataan,f.status_dinas,c.no_konsultasi,
        c.almt_bgn,c.status,c.id_kabkot_bgn,d.id_stsjadwal,e.nama_stsjadwal,c.data_step');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->join('tm_status_konsultasi d', 'd.id = a.id', 'left');
        $this->db->join('tr_jadwal e', 'e.id_stsjadwal = d.id_stsjadwal', 'left');
        $this->db->join('status_sistem f', 'f.id = c.status', 'left');
        $this->db->distinct();
        $this->db->where("c.status >=", 6);
        $this->db->where_not_in('c.status', 8);
        $this->db->where_not_in('c.status', 7);
        $this->db->where_not_in("c.status", 25);
        if ($dev != 1)
            if ($Dinas == '31') {
                $this->db->where('c.id_prov_bgn', $Dinas);
            } else {
                $this->db->where('c.id_kabkot_bgn', $Dinas);
            }
        //$this->db->where('id_kabkot_bgn', $Dinas);
        $this->db->order_by('c.status', 'asc');
        return $this->db->get();
    }
	
	 public function  getDataVerifikator($id)
	{
		$this->db->select('a.*,d.*,e.*,f.*,k.nama_kelurahan');
		$this->db->from('tmdatapemilik a');
		$this->db->where('a.id', $id);
		$this->db->join('tr_kecamatan d', 'a.id_kecamatan = d.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot e', 'a.id_kabkota = e.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi f', 'a.id_provinsi = f.id_provinsi', 'LEFT');
		$this->db->join('tr_kelurahan k', 'a.id_kelurahan = k.id_kelurahan', 'LEFT');
		$query = $this->db->get();
		return $query;
	}

    function getDataKonsultasi($id)
    {
        $this->db->select('
        a.id as id_pemilik,
        b.id as id_bgn,
        a.no_ktp,
        a.nm_pemilik,
        a.email,
        a.no_hp,
        a.id_kabkota,
        a.alamat,
        b.id_prov_bgn,
        b.luas_basement,
        b.lapis_basement,
        b.id_kec_bgn,
        b.id_fungsi_bg,
        b.imb,
        b.tipeA,
        b.luasA,
        b.tinggiA,
        b.lantaiA,
        b.jumlahA,
        b.id_jenis_permohonan,
        b.no_konsultasi,
        b.almt_bgn,
        b.luas_bgn,
        b.tinggi_bgn,
        id_kabkot_bgn,
        b.luas_bgp,
        b.tinggi_bgp,
        b.status,
        b.jml_lantai,
        h.nama_kabkota,
        i.nama_provinsi as nama_prov_pemilik,
        b.nm_bgn,b.tgl_pernyataan,
        e.nama_kecamatan,
        a.id_kecamatan,
        a.id_provinsi,
        b.id_izin,b.imb,
        c.nm_konsultasi,
        f.fungsi_bg,
        g.nama_kecamatan as nama_kec_bg,
        j.nama_kabkota as nama_kabkota_bg,
        k.nama_provinsi as nama_provinsi_bg,
        l.nama_kelurahan as nama_kel_bg,
        a.id_kelurahan,
        a.jns_pemilik,
        b.id_kel_bgn,
        b.id_jns_bg,
        a.jenis_id,
        a.no_ktp,
        a.no_kitas,
        b.id_prototype,
        b.id_prasarana_bg,
        b.no_imb,
        b.no_slf,
        b.slf,
        b.permohonan_slf,
        b.jual,
        b.id_doc_tek
        ');
        $this->db->from('tmdatapemilik a');
        $this->db->where('a.id', $id);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_kecamatan e', 'e.id_kecamatan = a.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot h', 'h.id_kabkot = a.id_kabkota', 'LEFT');
        $this->db->join('tr_provinsi i', 'i.id_provinsi = a.id_provinsi', 'LEFT');
        $this->db->join('tr_fungsi_bg f', 'f.id_fungsi_bg = b.id_fungsi_bg', 'left');
        $this->db->join('tr_kecamatan g', 'g.id_kecamatan = b.id_kec_bgn', 'LEFT');
        $this->db->join('tr_kabkot j', 'j.id_kabkot = b.id_kabkot_bgn', 'LEFT');
        $this->db->join('tr_provinsi k', 'k.id_provinsi = b.id_prov_bgn', 'LEFT');
        $this->db->join('tr_kelurahan l', 'l.id_kelurahan = b.id_kel_bgn', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function getDataPrototipe($id)
    {
        return
            $this->db
            ->select('a.id,a.id_prototype,b.idp,b.dir_file')
            ->from('tmdatabangunan a')
            ->join('tr_prototype b', 'b.idp = a.id_prototype', 'left')
            ->where('a.id', $id)
            ->get();
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

    public function getDataUserPBG($select = "a.*", $id = '')
    {
        $this->db->select($select, FALSE);
        if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
        $query     = $this->db->get('tmdatapemilik a')->row();
        return $query;
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

    function getByIdPtugas($id)
    {
        return $this->db->join('tm_personal', 'tm_penugasan_pbg.id_personal = tm_personal.id_personal')
            ->join('tm_sertifikasi', 'tm_sertifikasi.id_personal = tm_personal.id_personal', 'left')
            ->join('tm_riwpendidikan', 'tm_riwpendidikan.id_personal = tm_personal.id_personal', 'left')
            ->join('tr_unsur', 'tr_unsur.id_unsur = tm_sertifikasi.id_unsur', 'left')
            ->join('tr_unsur_ahli', 'tr_unsur_ahli.id_unsur_ahli = tm_sertifikasi.id_unsur_ahli', 'left')
            ->join('tr_unsur_keahlian', 'tr_unsur_keahlian.id_unsur_keahlian = tm_sertifikasi.id_unsur_keahlian', 'left')
            ->get_where('tm_penugasan_pbg', array('id_pemilik' => $id)); ///ya gitu lah
    }

    public function insertDataSidang($data)
    {
        return $this->db->insert('tmdatajadwal', $data);
    }

    public function getPenjadwalanById($id)
    {
        return $this->db->get_where('tmdatajadwal', array('id' => $id));
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

    public function getDataPenilaian($id_pemilik, $id_syarat_detail, $id_syarat)
    {
        return   $this->db->get_where('tmpersyaratankonsultasi', [
            'id' => $id_pemilik,
            'id_persyaratan' => $id_syarat,
            'id_persyaratan_detail' => $id_syarat_detail
        ]);
    }

    public function getDataKesuaian($id_pemilik, $id_persyaratan_detail, $id_syarat)
    {
        return $this->db->get_where('tmpersyaratankonsultasi', [
            'id' => $id_pemilik,
            'id_persyaratan' => $id_syarat,
            'id_persyaratan_detail' => $id_persyaratan_detail
        ]);
    }

    public function insertDataKesesuaian($data)
    {
        $this->db->insert('tmpersyaratankonsultasi', $data);
    }

    public function updateDataKesesuaian($id_pemilik, $id_syarat, $id_persyaratan_detail, $data)
    {
        return $this->db->where('id', $id_pemilik)
            ->where('id_persyaratan', $id_syarat)
            ->where('id_persyaratan_detail', $id_persyaratan_detail)
            ->update('tmpersyaratankonsultasi', $data);
    }

    public function getDataCatatan($id_pemilik, $id_persyaratan_detail, $id_syarat)
    {
        return $this->db->get_where('tmpersyaratankonsultasi', [
            'id' => $id_pemilik,
            'id_persyaratan' => $id_syarat,
            'id_persyaratan_detail' => $id_persyaratan_detail
        ]);
    }

    public function insertDataCatatan($data)
    {
        $this->db->insert('tmpersyaratankonsultasi', $data);
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

    // public function cekKesesuaian($val, $id)
    // {
    //     $this->db->distinct();
    //     $this->db->select('tmpersyaratankonsultasi.id_persyaratan_detail,tmpersyaratankonsultasi.id_persyaratan,kesesuaian,nm_dokumen');
    //     $this->db->from('tmpersyaratankonsultasi');
    //     $this->db->join('tr_dokumen_syarat', 'tr_dokumen_syarat.id = tmpersyaratankonsultasi.id_persyaratan', 'left');
    //     $this->db->join('tr_konsultasi_syarat', 'tr_konsultasi_syarat.id_persyaratan = tr_dokumen_syarat.id', 'left');
    //     $this->db->where_in('tmpersyaratankonsultasi.id_persyaratan', $val);
    //     $this->db->where_in('tmpersyaratankonsultasi.id_persyaratan_detail', $id);
    //     return  $this->db->get();
    // }

    // public function cekBelumSesuai($val, $id)
    // {
    //     $this->db->distinct();
    //     $this->db->select('tmpersyaratankonsultasi.id_persyaratan_detail,tmpersyaratankonsultasi.id_persyaratan,kesesuaian,nm_dokumen');
    //     $this->db->from('tmpersyaratankonsultasi');
    //     $this->db->join('tr_dokumen_syarat', 'tr_dokumen_syarat.id = tmpersyaratankonsultasi.id_persyaratan', 'left');
    //     $this->db->join('tr_konsultasi_syarat', 'tr_konsultasi_syarat.id_persyaratan = tr_dokumen_syarat.id', 'left');
    //     $this->db->where_in('tmpersyaratankonsultasi.id_persyaratan', $val);
    //     $this->db->where_in('tmpersyaratankonsultasi.id_persyaratan_detail', $id);
    //     $this->db->where('tmpersyaratankonsultasi.kesesuaian', 0);
    //     return  $this->db->get();
    // }


    // new function

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


    public function getSyaratListId($per, $kls)
    {
        return $this->db->distinct()->select('a.id,a.id_detail_jenis_persyaratan,b.id_syarat,b.id_detail,c.nm_dokumen')
            ->from('tr_konsultasi_syarat a')
            ->join('tr_pbg_syarat_detail b', 'b.id_persyaratan = a.id_persyaratan', 'left')
            ->join('tr_dokumen_syarat c', 'c.id = b.id_syarat', 'left')
            ->join('tmdatabangunan d', 'a.id = d.id_jenis_permohonan', 'left')
            ->join('tr_protipe e', 'e.idp = e.idp', 'left')
            ->where('a.id', $per)
            ->where_in('a.id_detail_jenis_persyaratan', $kls)
            ->group_by('b.id_detail')->order_by('a.id, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat', 'ASC')->get();
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

    public function  getListValidasi()
    {
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,b.imb,b.catatan,c.nm_konsultasi,d.file_retribusi');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >= 10 ");
        $this->db->where("b.status != 25 ");
        $this->db->where("b.pernyataan = 1 ");
        //$this->db->where('id_kabkot_bgn', $Dinas);
        if($Dinas =='31'){
			$this->db->where('b.id_prov_bgn = 31');
			$this->db->where('b.jml_lantai > 8');
		}else if ($Dinas =='3101' || $Dinas =='3171' || $Dinas =='3172' || $Dinas =='3173' || $Dinas =='3174' || $Dinas =='3175'){
			$this->db->where('b.id_kabkot_bgn', $Dinas);
			$this->db->where('b.jml_lantai < 9');
		}else if($Dinas =='100'){
			$this->db->where('b.id_otorita', 1);
		}else{
			$this->db->where('b.id_kabkot_bgn', $Dinas);
		}
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tm_retribusi d', 'a.id = d.id', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function  getListVerifikator($SQLcari = '')
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,a.nm_pemilik,b.status,b.no_konsultasi,b.almt_bgn,c.nm_konsultasi,g.fungsi_bg,b.tgl_pernyataan');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status between '1' AND '2' ");
		$this->db->where("b.id_fungsi_bg != 5");
		$this->db->where("b.id_jenis_permohonan != 9");
		if($Dinas =='31'){
			$this->db->where('b.id_prov_bgn = 31');
			$this->db->where('b.jml_lantai > 8');
		}else if ($Dinas =='3101' || $Dinas =='3171' || $Dinas =='3172' || $Dinas =='3173' || $Dinas =='3174' || $Dinas =='3175'){
			$this->db->where('b.id_kabkot_bgn', $Dinas);
			$this->db->where('b.jml_lantai < 9');
		}else if($Dinas =='100'){
			$this->db->where('b.id_otorita', 1);
		}else{
			$this->db->where('b.id_kabkot_bgn', $Dinas);
		}
		$this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_fungsi_bg g', 'g.id_fungsi_bg = b.id_fungsi_bg', 'LEFT');
		if ($SQLcari != '') {
			!empty($SQLcari['id_fungsi_bg']) ? $this->db->where('b.id_fungsi_bg', $SQLcari['id_fungsi_bg']) : '';
			if (!empty($SQLcari['id_proses'])) {
				$SQLcari['id_proses'] == 1 ? $this->db->where('b.status', 1) : $this->db->where('b.status >', 1);
			}
			!empty($SQLcari['tanggalawal']) ? $this->db->where('b.tgl_pernyataan >=', date('Y-m-d', strtotime($SQLcari['tanggalawal']))) : '';
			!empty($SQLcari['tanggalakhir']) ? $this->db->where('b.tgl_pernyataan <=', date('Y-m-d', strtotime($SQLcari['tanggalakhir']))) : '';
		}
		$this->db->order_by('b.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

    function getDataVerifikasi($id = 'null')
    {
        $sql = "SELECT a.id as id_pemilik,a.nm_pemilik,a.alamat,
            b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,b.id_prasarana_bg,b.id_kabkot_bgn,
            b.tinggi_bgn,b.nm_bgn, b.id_izin,b.imb,b.id_fungsi_bg,b.id_jns_bg,b.tipeA,b.luasA,b.tinggiA,b.lantaiA,b.jumlahA,b.luas_bgp,b.tinggi_bgp,
            c.p_nama_dinas,c.kepala_dinas,c.nip_kepala_dinas,
		    d.no_sk_tk,d.date_sk_tk,d.nm_kadis,d.nip_kadis,d.status_pejabat,
		    e.fungsi_bg,
            f.nama_provinsi as nm_prov_bgn,
            g.nama_kabkota as nm_kabkot_bgn,
            h.nama_kecamatan as nm_kec_bgn,
		    i.nama_kelurahan as nm_kel_bgn,
            j.jns_prasarana
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
				WHERE (a.id=$id)

			limit 1
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
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
				FROM tm_jenis_bg a
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

    function getdatapermohonan($id = null, $cari = null)
    {
        $sql = "SELECT a.*,b.email
		FROM tmdatabangunan a
        LEFT Join tmdatapemilik b On(b.id=a.id)
		WHERE (1=1) ";
        if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
        if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
        $hasil  = $this->db->query($sql);
        return $hasil;
    }


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
            ->select('id,id_persyaratan_detail,kesesuaian,catatan,dir_file')
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
    function get_pejabat_sk($id)
    {
        $sql = "SELECT a.id,a.id_kabkot_bgn, b.kepala_dinas, b.nip_kepala_dinas, b.p_nama_dinas
        FROM tmdatabangunan a
        left join tm_profile_teknis b On (a.id_kabkot_bgn = b.id_kabkot)
        where a.id_kabkot_bgn = $id";
        $hasil = $this->db->query($sql)->row_array();
        return $hasil;
    }

    function insertdataslf($dataInSLF)
    {
        $this->db->insert('tmdataslf', $dataInSLF);
        return $this->db->insert_id();
    }

    function getdatapemilikDok($id = 'null')
    {
        $sql = "SELECT a.id,a.nm_pemilik,a.alamat,
				b.nama_kelurahan
				FROM tmdatapemilik a
				LEFT JOIN tr_kelurahan b ON(b.id_kelurahan = a.id_kelurahan)
				LEFT JOIN tr_kecamatan c ON(c.id_kecamatan = a.id_kecamatan)
				WHERE (a.id=$id)
			limit 1
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
    }

    function getdatabangunanDok($id = 'null')
    {
        $sql = "SELECT a.id,
				b.id_kabkot_bgn,b.id_izin,b.nm_bgn,b.almt_bgn,b.luas_bgn,b.id_fungsi_bg,b.jml_lantai,b.id_jenis_permohonan,b.imb,
                b.tipeA,b.luasA,b.lantaiA,b.tinggiA,b.no_imb,b.luas_bgp,
				c.nama_kelurahan,
				d.nama_kecamatan,
				e.nama_kabkota,
				f.nama_provinsi,
				g.nilai_retribusi_bangunan,g.nilai_retribusi_prasarana,g.nilai_retribusi_keseluruhan,
				h.no_izin_pbg,h.nm_kadis,h.nip_kadis,
				i.fungsi_bg,i.id_pemanfaatan_bg,i.fungsi_bg,
				j.no_sk_tk,j.date_sk_tk,
                k.no_slf,k.nm_kadis_teknis,k.nip_kadis_teknis,k.nm_dinas,k.tgl_penerbitan_slf,k.okupansi,k.luas_dasar
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
                LEFT JOIN tmdataslf k On(b.id = k.id)
				WHERE (a.id=$id)
			limit 1
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
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

    public function removeDataRetribusi($id)
	{
		$this->db->query("DELETE FROM tm_retribusi WHERE id = $id");
        $this->db->query("DELETE FROM tm_prasaranaretribusi WHERE id = $id");
		$this->db->where('id',$id);
		return $query;
	}
}

/* End of file Mpemeriksaan.php */
