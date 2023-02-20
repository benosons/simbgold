<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mteknis extends CI_Model
{


    //Begin Dinas Teknis
    public function  getListVerifikator()
    {
        $this->db->select('a.id,a.nm_pemilik,b.status,b.no_konsultasi,b.almt_bgn,c.nm_konsultasi');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >= 1 ");
        $this->db->where('b.id_fungsi_bg', 5);
        $this->db->where('b.id_jenis_permohonan', 9);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_kecamatan d', 'a.id_kecamatan = d.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot e', 'a.id_kabkota = e.id_kabkot', 'LEFT');
        $this->db->join('tr_provinsi f', 'a.id_provinsi = f.id_provinsi', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function  getDataVerifikator($id)
    {
        $this->db->select('a.*,b.*,c.nm_konsultasi,d.*,e.*,f.*');
        $this->db->from('tmdatapemilik a');
        $this->db->where('a.id', $id);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_kecamatan d', 'a.id_kecamatan = d.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot e', 'a.id_kabkota = e.id_kabkot', 'LEFT');
        $this->db->join('tr_provinsi f', 'a.id_provinsi = f.id_provinsi', 'LEFT');
        $query = $this->db->get();
        return $query;
    }

    public function  getDataBangunan($id)
    {
        $this->db->select('a.*,c.nm_konsultasi,d.nama_kecamatan,e.nama_kabkota,f.nama_provinsi,g.nama_kelurahan');
        $this->db->from('tmdatabangunan a');
        $this->db->where('a.id', $id);
        $this->db->join('tr_konsultasi c', 'a.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_kelurahan g', 'a.id_kel_bgn = g.id_kelurahan', 'LEFT');
        
        $this->db->join('tr_kecamatan d', 'a.id_kec_bgn = d.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot e', 'a.id_kabkot_bgn = e.id_kabkot', 'LEFT');
        $this->db->join('tr_provinsi f', 'a.id_proV_bgn = f.id_provinsi', 'LEFT');
        $query = $this->db->get();
        return $query;
    }

    public function  getListValidasi()
    {
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('*');
        $this->db->from('tmdatapemilik a');
        $this->db->where("status >= 2 ");
        $this->db->where('id_kabkot_bgn', $Dinas);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function  getDataValidasi($id = null, $cari = null)
    {
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.*,b.status as statusPem, b.*,d.nama_kecamatan,e.nama_kabkota,f.nama_provinsi');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status = 2 ");
        $this->db->where('id_kabkot_bgn', $Dinas);
        if ($id) {
            $this->db->where('a.id', $id);
        }
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_kecamatan d', 'a.id_kecamatan = d.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot e', 'a.id_kabkota = e.id_kabkot', 'LEFT');
        $this->db->join('tr_provinsi f', 'a.id_provinsi = f.id_provinsi', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function getTanah($select = "a.*", $id = '')
    {
        $this->db->select($select, FALSE);
        if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
        $query     = $this->db->get('tmdatatanah a');
        return $query;
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

    function updateVerifikasiTanah($dataIn, $id)
    {
        $this->db->where('id_detail', $id);
        $this->db->update('tmdatatanah', $dataIn);
    }

    public function getDataDokumen($select = "a.*", $id = '', $status = '')
    {
        $this->db->select($select, FALSE);
        if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
        if ($status != null || trim($status) != '')  $this->db->where('a.status', $status);
        $query     = $this->db->get('tmpersyaratankonsultasi a');
        return $query;
    }

    public function getDataTanah($select = "a.*", $id_jenis_permohonan = '')
    {
        $this->db->select($select, FALSE);
        if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
        $this->db->where('a.id_detail_jenis_persyaratan', '1');
        $this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
        $this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
        $query     = $this->db->get('tr_konsultasi_syarat a');
        return $query;
    }

    public function getMasterAdministrasi($select = "a.*", $id_jenis_permohonan = '')
    {
        $this->db->select($select, FALSE);
        if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
        $this->db->where('a.id_jenis_persyaratan', '1');
        $this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
        $this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
        $query     = $this->db->get('tr_konsultasi_syarat a');
        return $query;
    }

    public function getMasterTeknis($select = "a.*", $id_jenis_permohonan = '')
    {
        $this->db->select($select, FALSE);
        if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
        $this->db->where('a.id_jenis_persyaratan', '2');
        $this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
        $this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
        $query     = $this->db->get('tr_konsultasi_syarat a');
        return $query;
    }

    public function getDataJnsKonsultasi($select = "a.*", $id = '')
    {
        $this->db->select($select, FALSE);
        if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
        $query     = $this->db->get('tmdatabangunan a');
        return $query;
    }

    public function getHis($select = "a.*", $id = '')
    {
        $this->db->select($select, FALSE);
        $this->db->join('simbg_status b', 'a.status = b.kode_status', 'LEFT');
        $this->db->join('tm_user c', 'a.user_id = c.id', 'LEFT');
        if ($id != null || trim($id) != '')  $this->db->where('a.id_pemilik', $id);
        $query     = $this->db->get('th_data_konsultasi a');
        return $query;
    }

    function updateValidasi($dataIn, $id, $detail)
    {
        $this->db->where(array('id' => $id, 'id_persyaratan_detail' => $detail));
        $this->db->update('tmpersyaratankonsultasi', $dataIn);
        $updated_status = $this->db->affected_rows();
        if ($updated_status) :
            return $detail;
        else :
            return false;
        endif;
    }

    public function getPermohonan($id = null, $cari = null)
    {
        $sql = "SELECT a.*, b.*
		FROM tmdatabangunan a
		left join tr_konsultasi b on (a.id_jenis_permohonan = b.id)
		WHERE (1=1) ";
        if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
        if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
        $hasil  = $this->db->query($sql);
        return $hasil;
    }

    function insert_syarat($dataIn)
    {
        $this->db->insert('tmpersyaratankonsultasi', $dataIn);
        return $this->db->insert_id();
    }
    // Begin Dinas Teknis  Tarik Persyaratan
    function getJenisKonsultasi($id = null, $cari = null)
    {
        $sql = "SELECT a.*, b.*
		FROM tmdatabangunan a
		left join tr_konsultasi b on (a.id_jenis_permohonan = b.id)
		WHERE (1=1) ";
        if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
        if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
        $hasil  = $this->db->query($sql);
        return $hasil;
    }

    function getSyaratList4($per = null, $kls = null)
    {
        $sql = "SELECT a.id_persyaratan,a.id,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,
				b.id_detail,b.id_syarat, c.nm_dokumen,c.keterangan 
				FROM tr_konsultasi_syarat a 
				LEFT JOIN tr_pbg_syarat_detail b ON(a.id_persyaratan=b.id_persyaratan) 
				LEFT JOIN tr_dokumen_syarat c ON(b.id_syarat=c.id) 
				LEFT JOIN tmdatabangunan d ON(a.id=d.id_jenis_permohonan) 
				
				WHERE (1=1)
		";
        if ($per != null || trim($per) != '')  $sql .= " AND a.id = '$per' ";
        if ($kls != null || trim($kls) != '')  $sql .= " AND a.id_detail_jenis_persyaratan = '$kls' ";
        $sql .= " Group by b.id_detail ORDER BY a.id, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat ASC ";
        //echo $sql;
        $hasil  = $this->db->query($sql);
        return $hasil;
    }

    function getSyarat($id = null, $per = null, $status = null)
    {
        $sql = "SELECT a.*
				FROM tmpersyaratankonsultasi a
				WHERE (1=1) ";

        if ($id != null || trim($id) != '')  $sql .= " AND a.id_persyaratan_detail = '$id' ";
        if ($per != null || trim($per) != '')  $sql .= " AND a.id = '$per' ";
        if ($status != null || trim($status) != '')  $sql .= " AND a.status = '$status' ";
        $sql .= " ORDER BY a.id_persyaratan ASC";
        //echo $sql;
        $hasil  = $this->db->query($sql);
        return $hasil;
    }

    function getTanahVerifikasi($id)
    {
        return $this->db->get_where('tmdatatanah ', array('id' => $id));
    }
    //End Dinas Teknis Tarik Persyaratan
    //Begin Penugasan TPA
    public function getdatapenugasan()
    {
        $this->db->select('a.id,b.nm_konsultasi,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn,d.id_stsjadwal,e.nama_stsjadwal');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->join('tm_status_konsultasi d', 'd.id = a.id', 'left');
        $this->db->join('tr_jadwal e', 'e.id_stsjadwal = d.id_stsjadwal', 'left');
        $this->db->where("c.status >= 1");
        $this->db->where('c.id_fungsi_bg', 5);
        $this->db->order_by('c.status', 'asc');
        return $this->db->get();
    }


    public function cekPersonalPenugasanTpa($id, $arr)
    {
        return $this->db
            ->where('id_pemilik', $id)
            ->where_in('id', $arr)
            ->get('tm_penugasan_tpa');
    }

    function insertBatchPersonilTpa($data)
    {
        return $this->db->insert_batch('tm_penugasan_tpa', $data);
    }

    function updateStats($data, $id)
    {
        return $this->db->where('id', $id)->update('tmdatabangunan', $data);
    }

    function getEmailPemohon($id = null)
    {
        $sql = "SELECT a.id,a.email,b.no_konsultasi ";
        $sql .= " FROM tmdatapemilik a 
					left join tmdatabangunan b on (a.id = b.id) 
					WHERE (1=1) AND a.email != '' ";
        if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
        $hasil  = $this->db->query($sql);
        return $hasil;
    }

    function getEmailTpa($id = null)
    {
        $sql = "SELECT a.id,b.email,b.nm_tpa ";
        $sql .= " FROM tm_penugasan_tpa a 
					left join tm_tpa b on (a.id = b.id) 
					WHERE (1=1) AND b.email != '' ";
        if ($id != null || trim($id) != '')  $sql .= " AND a.id_pemilik = '$id' ";
        $hasil  = $this->db->query($sql);
        return $hasil;
    }

    function getDetailPengawas($id)
    {
        $this->db->select('a.id as id_pemilik,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,almt_bgn,fungsi_bg,luas_bgn,tinggi_bgn,id_kabkot_bgn,b.status,b.id_fungsi_bg,b.jml_lantai,c.id_jenis_bg');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >= 3 ");
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->where('a.id', $id);
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_fungsi_bg f', 'f.id_fungsi_bg = b.id_fungsi_bg', 'left');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    //End Penugasan TPA
    //Begin Penjadwalan TPA

    //End Penjdawalan TPA 
    //Begin Input Hasil Konsultasi
    function get_permohonan_list($id)
    {
        $this->db->select('a.id as id_pemilik,a.no_ktp,a.nm_pemilik,a.email,a.no_hp,a.id_kabkota,a.alamat,
        b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_kec_bgn,b.id_fungsi_bg,b.imb,b.tipeA,b.luasA,b.tinggiA,b.jumlahA,b.lantaiA,
        b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.luas_bgn,b.tinggi_bgn,id_kabkot_bgn,
        b.status,b.jml_lantai,h.nama_kabkota,i.nama_provinsi,b.nm_bgn,b.tgl_pernyataan,
        e.nama_kecamatan,a.id_kecamatan,a.id_provinsi,b.id_izin,b.imb,
        c.nm_konsultasi,
        f.fungsi_bg,
        g.nama_kecamatan as nama_kec_bg,j.nama_kabkota as nama_kabkota_bg,k.nama_provinsi as nama_provinsi_bg,a.id_kelurahan,a.jns_pemilik');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >= 5 ");
        $this->db->where('b.no_konsultasi', $id);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_kecamatan e', 'e.id_kecamatan = a.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot h', 'h.id_kabkot = a.id_kabkota', 'LEFT');
        $this->db->join('tr_provinsi i', 'i.id_provinsi = a.id_provinsi', 'LEFT');
        $this->db->join('tr_fungsi_bg f', 'f.id_fungsi_bg = b.id_fungsi_bg', 'left');
        $this->db->join('tr_kecamatan g', 'g.id_kecamatan = b.id_kec_bgn', 'LEFT');
        $this->db->join('tr_kabkot j', 'j.id_kabkot = b.id_kabkot_bgn', 'LEFT');
        $this->db->join('tr_provinsi k', 'k.id_provinsi = b.id_prov_bgn', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }


    public function getSyaratList2($per = NULL, $kls = NULL)
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

    public function getPenjadwalanById($id)
    {
        return $this->db->get_where('tmdatajadwal', array('id' => $id));
    }

    public function getDataPenilaian($id_pemilik, $id_syarat_detail, $id_syarat)
    {
        return   $this->db->get_where('tmpersyaratankonsultasi', [
            'id' => $id_pemilik,
            'id_persyaratan' => $id_syarat,
            'id_persyaratan_detail' => $id_syarat_detail
        ]);
    }
    //End Input Hasil Konsultasi
    // Begin Validasi PBG BGFK
    public function  getListValidasiPBG()
    {
        $this->db->select('a.id,a.nm_pemilik,b.status,b.no_konsultasi,b.almt_bgn,c.nm_konsultasi');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >= 4 ");
        $this->db->where('b.id_fungsi_bg', 5);
        $this->db->where('b.id_jenis_permohonan', 9);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_kecamatan d', 'a.id_kecamatan = d.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot e', 'a.id_kabkota = e.id_kabkot', 'LEFT');
        $this->db->join('tr_provinsi f', 'a.id_provinsi = f.id_provinsi', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function getDataVerifikasiBGFK($id)
    {
        $this->db->select('a.id as id_pemilik,a.nm_pemilik,a.alamat,
        b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,b.tinggi_bgn,b.nm_bgn,
        c.p_nama_dinas,c.kepala_dinas,c.nip_kepala_dinas,
        f.nama_provinsi as nm_prov_bgn,
        g.nama_kabkota as nm_kabkot_bgn,
        h.nama_kecamatan as nm_kec_bgn
        ');
        $this->db->from('tmdatapemilik a');
        $this->db->where('b.id', $id);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tm_profile_teknis c', 'b.id_kabkot_bgn = c.id_kabkot', 'LEFT');
        $this->db->join('tr_provinsi f', 'b.id_prov_bgn=f.id_provinsi', 'LEFT');
        $this->db->join('tr_kabkot g', 'b.id_kabkot_bgn=g.id_kabkot', 'LEFT');
        $this->db->join('tr_kecamatan h', 'b.id_kec_bgn=h.id_kecamatan', 'LEFT');

        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }
    // End Validasi PBG BGFK

    //Begin Penarikan Data
    function getByIdPtugas($id)
    {
        return $this->db->join('tm_tpa', 'tm_penugasan_tpa.id = tm_tpa.id')
            //->join('tr_unsur', 'tr_unsur.id_unsur = tm_sertifikasi.id_unsur', 'left')
            //->join('tr_unsur_ahli', 'tr_unsur_ahli.id_unsur_ahli = tm_sertifikasi.id_unsur_ahli', 'left')
            //->join('tr_unsur_keahlian', 'tr_unsur_keahlian.id_unsur_keahlian = tm_sertifikasi.id_unsur_keahlian', 'left')
            ->get_where('tm_penugasan_tpa', array('id_pemilik' => $id)); ///ya gitu lah
    }
    //End Penarikan Data

    public function getDataPenjadwalan()
    {
        $this->db->select('a.id,b.nm_konsultasi,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn,d.id_stsjadwal,e.nama_stsjadwal');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->join('tm_status_konsultasi d', 'd.id = a.id', 'left');
        $this->db->join('tr_jadwal e', 'e.id_stsjadwal = d.id_stsjadwal', 'left');
        $this->db->where("c.status >= 1");
        $this->db->where('c.id_fungsi_bg', 5);
        $this->db->where('c.id_jenis_permohonan', 9);
        $this->db->order_by('c.status', 'asc');
        return $this->db->get();
    }

    public function getPenugasanAll($dateOne, $dateTwo)
    {
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.id,b.nm_konsultasi,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->where("c.status >= 3");
        $this->db->where('c.id_kabkot_bgn', $Dinas);
        $this->db->where("c.tgl_pernyataan >=", $dateOne);
        $this->db->where("c.tgl_pernyataan <=", $dateTwo);
        $this->db->order_by('c.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

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

    function getCountJadwal($id)
    {
        return $this->db->where('id', $id)->get('tmdatajadwal');
    }

    function get_permohonan_list2($id)
    {
        $this->db->select('a.id as id_pemilik,c.lama_proses,b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_kabkot_bgn,b.id_kec_bgn,b.id_jenis_permohonan,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,almt_bgn,fungsi_bg,luas_bgn,tinggi_bgn,id_kabkot_bgn,b.status,b.id_fungsi_bg,b.jml_lantai,e.nama_kecamatan,h.nama_kabkota,i.nama_provinsi as nama_prov_pemilik,no_hp,email,no_ktp,luas_basement,lapis_basement,nm_bgn,b.id_fungsi_bg,e.nama_kecamatan,a.id_kecamatan,a.id_provinsi,a.id_kabkota,h.nama_kabkota,a.no_hp,b.id_prov_bgn,g.nama_kecamatan as nama_kec_bg,j.nama_kabkota as nama_kabkota_bg,k.nama_provinsi as nama_provinsi_bg,b.tgl_pernyataan,b.luas_bgn,b.tinggi_bgn,b.jml_lantai');
        $this->db->from('tmdatapemilik a');
        $this->db->where('b.no_konsultasi', $id);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_kecamatan e', 'e.id_kecamatan = a.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot h', 'h.id_kabkot = a.id_kabkota', 'LEFT');
        $this->db->join('tr_provinsi i', 'i.id_provinsi = a.id_provinsi', 'LEFT');
        $this->db->join('tr_fungsi_bg f', 'f.id_fungsi_bg = b.id_fungsi_bg', 'left');
        $this->db->join('tr_kecamatan g', 'g.id_kecamatan = b.id_kec_bgn', 'LEFT');
        $this->db->join('tr_kabkot j', 'j.id_kabkot = b.id_kabkot_bgn', 'LEFT');
        $this->db->join('tr_provinsi k', 'k.id_provinsi = b.id_prov_bgn', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function insertDataKonsultasi($data)
    {
        return $this->db->insert('tmdatajadwal', $data);
    }

    public function insertStatusKonsultasi($data)
    {
        return $this->db->insert('tm_status_konsultasi', $data);
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
        $this->db->where('no_konsultasi', $id);
        return $this->db->get('tmdatabangunan');
    }

    public function saveStep($id, $data)
    {
        $this->db->where('no_konsultasi', $id);
        return $this->db->update('tmdatabangunan', $data);
    }



    public function getIdKonsultasi($id)
    {
        return $this->db
            ->select('id')
            ->from('tmdatabangunan')
            ->where('no_konsultasi', $id)
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


    public function getDataVerifikasi($id)
    {
        $this->db->select('a.id as id_pemilik,a.nm_pemilik,a.alamat,
        b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,b.tinggi_bgn,b.nm_bgn,
        c.p_nama_dinas,c.kepala_dinas,c.nip_kepala_dinas,
        f.nama_provinsi as nm_prov_bgn,
        g.nama_kabkota as nm_kabkot_bgn,
        h.nama_kecamatan as nm_kec_bgn
        ');
        $this->db->from('tmdatapemilik a');
        $this->db->where('b.id', $id);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tm_profile_teknis c', 'b.id_kabkot_bgn = c.id_kabkot', 'LEFT');
        $this->db->join('tr_provinsi f', 'b.id_prov_bgn=f.id_provinsi', 'LEFT');
        $this->db->join('tr_kabkot g', 'b.id_kabkot_bgn=g.id_kabkot', 'LEFT');
        $this->db->join('tr_kecamatan h', 'b.id_kec_bgn=h.id_kecamatan', 'LEFT');

        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }


    public function insertMultiInspeksi($data)
    {
        return $this->db->insert_batch('tm_inspeksi', $data);
    }

    public function insertInspeksi($data)
    {
        return $this->db->insert('tm_inspeksi', $data);
    }

    public function updateInspeksi($id, $data)
    {
        return $this->db->where('id_inspeksi', $id)->update('tm_inspeksi', $data);
    }

    public function cekIdBangunan($id)
    {
        return $this->db->get_where('tmdatabangunan', ['no_konsultasi' => $id]);
    }

    public function getJenisInspeksi($id, $jenis)
    {
        return $this->db->get_where('tm_inspeksi', [
            'id' => $id,
            'id_struktur' => $jenis
        ]);
    }

    public function hapusInspeksi($id)
    {
        return $this->db->where('id_inspeksi', $id)->delete('tm_inspeksi');
    }

    public function cekStepInspeksi($id)
    {
        $this->db->select('step_inspeksi');
        $this->db->where('no_konsultasi', $id);
        return $this->db->get('tmdatabangunan');
    }

    public function saveStepInspeksi($id, $data)
    {
        $this->db->where('no_konsultasi', $id);
        return $this->db->update('tmdatabangunan', $data);
    }

    public function cekInspeksiBangunan($id)
    {
        return $this->db->get_where('tm_data_inspeksi', ['id' => $id]);
    }

    public function insertDataInspeksi($data)
    {
        return $this->db->insert('tm_data_inspeksi', $data);
    }

    public function updateDataInspeksi($id, $data)
    {
        return $this->db->where('id_data_inspeksi', $id)->update('tm_data_inspeksi', $data);
    }

    public function cekDataInspeksiBangunan($id)
    {
        return $this->db->get_where('tm_inspeksi', ['id' => $id]);
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
        $this->db->where_in('tmpersyaratankonsultasi.id_persyaratan_detail', $id);
        $this->db->where('tmpersyaratankonsultasi.kesesuaian', 0);
        return  $this->db->get();
    }


    public function getDataSlf($id)
    {
        $this->db->select('a.id as id_pemilik,a.nm_pemilik,a.alamat,
        b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,b.tinggi_bgn,b.luas_bgn,
		b.nm_bgn,
        c.nama_provinsi,
        d.nama_kabkota,
        e.nama_kecamatan,
        i.no_izin_pbg,i.nm_kadis,i.nip_kadis,
		l.p_nama_dinas
        ');
        $this->db->from('tmdatapemilik a');
        $this->db->where('b.id', $id);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_provinsi c', 'b.id_prov_bgn=c.id_provinsi', 'LEFT');
        $this->db->join('tr_kabkot d', 'b.id_kabkot_bgn=d.id_kabkot', 'LEFT');
        $this->db->join('tr_kecamatan e', 'b.id_kec_bgn=e.id_kecamatan', 'LEFT');
        $this->db->join('tmdatapbg i', 'a.id = i.id', 'LEFT');
        $this->db->join('tm_profile_dinas l', 'b.id_kabkot_bgn = l.id_kabkot', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function getDataRetribusi()
    {
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.id,a.nm_pemilik,b.nm_konsultasi,c.id_fungsi_bg,c.no_konsultasi,
        c.almt_bgn,c.status,c.id_kabkot_bgn');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->where("c.status >= 8");
        $this->db->where('c.id_fungsi_bg', 5);
        $this->db->order_by('c.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    // query model penugasan
    public function  getListPenugasanDokDInas()
    {
        $this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->where("c.status >= 4 ");
        $this->db->where('c.id_fungsi_bg', 5);
        $this->db->where('c.id_jenis_permohonan', 9);
        $this->db->order_by('c.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function getTimTPT($id, $year = NULL)
    {
        return $this->db
            ->join('tm_personal', 'tm_personal.id_personal = tm_sktdetail.id_personal', 'left')
            ->join('tm_sk_timteknis', 'tm_sk_timteknis.id_skt = tm_sktdetail.id_skt', 'left')
            ->join('tr_provinsi', 'tr_provinsi.id_provinsi = tm_personal.id_provinsi', 'left')
            ->join('tr_kabkot', 'tr_kabkot.id_kabkot = tm_personal.id_kabkot', 'left')
            ->join('tm_sertifikasi', 'tm_sertifikasi.id_personal = tm_personal.id_personal', 'left')
            ->join('tm_riwpendidikan', 'tm_riwpendidikan.id_personal = tm_personal.id_personal', 'left')
            ->join('tr_unsur', 'tr_unsur.id_unsur = tm_sertifikasi.id_unsur', 'left')
            ->join('tr_unsur_ahli', 'tr_unsur_ahli.id_unsur_ahli = tm_sertifikasi.id_unsur_ahli', 'left')
            ->join('tr_unsur_keahlian', 'tr_unsur_keahlian.id_unsur_keahlian = tm_sertifikasi.id_unsur_keahlian', 'left')
            ->get_where('tm_sktdetail', array(
                'tm_personal.id_kabkot' => $id,
                'tm_sk_timteknis.expired_skt' => $year,
                'tm_personal.stat' => 1,
            ));
    }

    public function getTimTPA($id, $year = NULL)
    {
        return $this->db
            ->join('tm_tpa j', 'j.id = a.id_tpanya', 'left')
            ->join('tm_sk_pengaturan b', 'b.id_sk = a.id_sk', 'left')
            ->where_not_in('nm_tpa','')
            ->get_where('tm_sk_tdetail a', array(
                'b.id_kabkot' => $id,
            ));
    }




    public function cekDataBangunan($id)
    {
        $this->db->select('a.id as id_pemilik,c.id_jenis_bg,c.lama_proses,b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_izin,
		b.id_kabkot_bgn,b.id_kec_bgn,b.id_jenis_permohonan,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,
		b.almt_bgn,fungsi_bg,b.tipeA,b.luasA,b.lantaiA,b.tinggiA,b.jumlahA,b.luas_bgp,b.tinggi_bgp,
		b.status,b.id_fungsi_bg,i.nama_provinsi as nama_prov_pemilik,
		email,no_ktp,nm_bgn,e.nama_kecamatan,a.id_kecamatan,a.id_provinsi,
		a.id_kabkota,h.nama_kabkota,a.no_hp,g.nama_kecamatan as nama_kec_bg,j.nama_kabkota as nama_kabkota_bg,
		k.nama_provinsi as nama_provinsi_bg,b.tgl_pernyataan,b.luas_bgn,b.tinggi_bgn,b.jml_lantai,l.id_klasifikasi_bg,l.klasifikasi_bg,m.jns_prasarana');
        $this->db->from('tmdatapemilik a');
        $this->db->where('b.id', $id);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_kecamatan e', 'e.id_kecamatan = a.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot h', 'h.id_kabkot = a.id_kabkota', 'LEFT');
        $this->db->join('tr_provinsi i', 'i.id_provinsi = a.id_provinsi', 'LEFT');
        $this->db->join('tr_fungsi_bg f', 'f.id_fungsi_bg = b.id_fungsi_bg', 'left');
        $this->db->join('tr_kecamatan g', 'g.id_kecamatan = b.id_kec_bgn', 'LEFT');
        $this->db->join('tr_kabkot j', 'j.id_kabkot = b.id_kabkot_bgn', 'LEFT');
        $this->db->join('tr_provinsi k', 'k.id_provinsi = b.id_prov_bgn', 'LEFT');
        $this->db->join('tr_klasifikasi_bg l', 'l.id_klasifikasi_bg = c.klasifikasi_bg', 'LEFT');
        $this->db->join('tr_prasarana m', 'm.idp = b.id_prasarana_bg', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    function insertBatchPersonil($data)
    {
        return $this->db->insert_batch('tm_penugasan_pbg', $data);
    }
    // end query model penugasan


    // begin query model Penjadwalan
    public function getDataKonsultasi()
    {
        $this->db->select('a.id,b.nm_konsultasi,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->where("c.status >= 5");
        $this->db->distinct();
        $this->db->order_by('c.status', 'asc');
        $this->db->where('c.id_fungsi_bg', 5);
        return $this->db->get();
    }

    public function getByIdPtugasTPA($id)
    {
        return $this->db->join('tm_tpa', 'tm_tpa.id = tm_penugasan_pbg.id_personal')
            ->get_where('tm_penugasan_pbg', array('id_pemilik' => $id));
    }

    // end query modle penjadwalan

    // begin query model hasil konsultasi 
    public function  getListKonsultasi()
    {
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
        $this->db->where('c.id_fungsi_bg', 5);
        $this->db->where('c.id_jenis_permohonan', 9);
        $this->db->order_by('c.status', 'asc');
        return $this->db->get();
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



    // end query model hasil konsultasi

    // begin query penugasan inspeksi unt
    public function getDataPenugasanInspeksi()
    {
        $this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->where("c.status >= 13 ");
        $this->db->where('c.id_fungsi_bg', 5);
        $this->db->order_by('c.status', 'asc');
        $query = $this->db->get();
        return $query;
    }


    function getDetailPengawasInspeksi($id)
    {
        $this->db->select('a.id as id_pemilik,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,almt_bgn,fungsi_bg,luas_bgn,tinggi_bgn,id_kabkot_bgn,b.status,b.id_fungsi_bg,b.jml_lantai,c.id_jenis_bg');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >= 3 ");
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->where('a.id', $id);
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_imb_permohonan d', 'd.id_jenis_permohonan = b.id_jenis_permohonan', 'left');
        $this->db->join('tr_fungsi_bg f', 'f.id_fungsi_bg = b.id_fungsi_bg', 'left');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    function getByIdPtugasInspeksi($id)
    {
        return $this->db->join('tm_personal', 'tm_penugasan_inspeksi.id_personal = tm_personal.id_personal')
            ->join('tm_sertifikasi', 'tm_sertifikasi.id_personal = tm_personal.id_personal', 'left')
            ->join('tm_riwpendidikan', 'tm_riwpendidikan.id_personal = tm_personal.id_personal', 'left')
            ->join('tr_unsur', 'tr_unsur.id_unsur = tm_sertifikasi.id_unsur', 'left')
            ->join('tr_unsur_ahli', 'tr_unsur_ahli.id_unsur_ahli = tm_sertifikasi.id_unsur_ahli', 'left')
            ->join('tr_unsur_keahlian', 'tr_unsur_keahlian.id_unsur_keahlian = tm_sertifikasi.id_unsur_keahlian', 'left')
            ->get_where('tm_penugasan_inspeksi', array('tm_penugasan_inspeksi.id' => $id));
    }

    public function getTimPenilik($id, $year = NULL)
    {
        return $this->db
            ->join('tm_personal j', 'j.id_personal = a.id_personal', 'left')
            ->join('tm_sk_pengaturan b', 'b.id_sk = a.id_sk', 'left')
            ->join('tr_provinsi c', 'c.id_provinsi = j.id_provinsi', 'left')
            ->join('tr_kabkot d', 'd.id_kabkot = j.id_kabkot', 'left')
            ->join('tm_sertifikasi e', 'e.id_personal = j.id_personal', 'left')
            ->join('tm_riwpendidikan f', 'f.id_personal = j.id_personal', 'left')
            ->join('tr_unsur g', 'g.id_unsur = e.id_unsur', 'left')
            ->join('tr_unsur_ahli h', 'h.id_unsur_ahli = e.id_unsur_ahli', 'left')
            ->join('tr_unsur_keahlian i', 'i.id_unsur_keahlian = e.id_unsur_keahlian', 'left')
            ->get_where('tm_sk_pdetail a', array(
                'b.id_kabkot' => $id,
                'b.expired_sk' => $year,
            ));
    }


    function cekPersonalPenugasanInspeksi($id, $arr)
    {
        return $this->db
            ->where('id', $id)
            ->where_in('id_personal', $arr)
            ->get('tm_penugasan_inspeksi');
    }

    public function insertDataPenugasanInspeksi($data)
    {
        return $this->db->insert_batch('tm_penugasan_inspeksi', $data);
    }
    // end penugasan inspeksi

    function insertdataslf($dataInSLF)
    {
        $this->db->insert('tmdataslf', $dataInSLF);
        return $this->db->insert_id();
    }

    function get_pejabat($id)
    {
        $sql = "SELECT a.id,a.id_kabkot_bgn, b.kepala_dinas, b.nip_kepala_dinas, b.p_nama_dinas
        FROM tmdatabangunan a 
        left join tm_profile_teknis b On (a.id_kabkot_bgn = b.id_kabkot)
        where a.id = " . $id;
        $hasil = $this->db->query($sql)->row_array();
        return $hasil;
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
}
