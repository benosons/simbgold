<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Minspeksi extends CI_Model
{
    public function  getListInpeksi()
    {

        $dev = $this->session->userdata('loc_role_id');
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.id,b.nm_konsultasi,c.status,c.tgl_pernyataan,f.status_dinas,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn,d.id_stsjadwal,e.nama_stsjadwal');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->join('tm_status_konsultasi d', 'd.id = a.id', 'left');
        $this->db->join('tr_jadwal e', 'e.id_stsjadwal = d.id_stsjadwal', 'left');
        $this->db->join('status_pbg f', 'f.id = c.status', 'left');
        $this->db->distinct();
        $this->db->where("c.status >=", 13);
        if ($dev != 1)  $this->db->where('id_kabkot_bgn', $Dinas);
        $this->db->order_by('c.status', 'asc');
        return $this->db->get();
    }


	public function  getListKonsultasi()
    {
        $dev = $this->session->userdata('loc_role_id');
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.id,b.nm_konsultasi,c.status,f.status_dinas,c.no_konsultasi,a.nm_pemilik,
        c.almt_bgn,c.status,c.id_kabkot_bgn,d.id_stsjadwal,e.no_izin_pbg');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->join('tm_status_konsultasi d', 'd.id = a.id', 'left');
		$this->db->join('tmdatapbg e', 'e.id = a.id', 'left');
        $this->db->join('status_pbg f', 'f.id = c.status', 'left');
        $this->db->distinct();
        $this->db->where("c.status >=", 17);
		$this->db->where("c.status !=", 25);
		$this->db->where("c.id_jenis_permohonan !=", 14);
        if ($dev != 1)  $this->db->where('id_kabkot_bgn', $Dinas);
        $this->db->order_by('c.status', 'asc');
        return $this->db->get();
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
        $this->db->where('id', $id);
        return $this->db->get('tmdatabangunan');
    }

    public function saveStep($id, $data)
    {
        $this->db->where('id', $id);
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

    public function getDataPenugasan()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 13 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

    function getDetailPengawas($id)
	{
		$this->db->select('a.id as id_pemilik,a.nm_pemilik,a.alamat,a.email,a.glr_depan,a.glr_belakang,
		b.no_konsultasi,b.almt_bgn,fungsi_bg,b.luas_bgn,b.tinggi_bgn,b.id_kabkot_bgn,b.status,b.jml_lantai,b.id_fungsi_bg,
		c.nm_konsultasi,c.id_jenis_bg,
		d.no_izin_pbg,
		f.nama_kelurahan,
		g.nama_kecamatan,
		h.nama_kabkota,
		i.nama_provinsi,
		j.dir_file_konsultasi');
		$this->db->from('tmdatapemilik a');
		//$this->db->where("b.status >= 3 ");
		$this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
		$this->db->where('a.id', $id);
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tmdatapbg d', 'd.id = a.id', 'LEFT');
		$this->db->join('tr_fungsi_bg e', 'e.id_fungsi_bg = b.id_fungsi_bg', 'left');
		$this->db->join('tr_kelurahan f', 'f.id_kelurahan = b.id_kel_bgn', 'LEFT');
		$this->db->join('tr_kecamatan g', 'g.id_kecamatan = b.id_kec_bgn', 'LEFT');
		$this->db->join('tr_kabkot h', 'h.id_kabkot = b.id_kabkot_bgn', 'LEFT');
		$this->db->join('tr_provinsi i', 'i.id_provinsi = b.id_prov_bgn', 'LEFT');
		$this->db->join('tmdatajadwal j', 'j.id = b.id', 'LEFT');
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
                'b.tipe_sk' => "Penilik",
				'b.expired_sk' => $year,
			));
	}

    function updateStats($data, $id)
	{
		return $this->db->where('id', $id)->update('tmdatabangunan', $data);
	}

	function cekTotalPetugas($id_pemilik)
	{
		return $this->db->where('id_pemilik', $id_pemilik)->get('tm_penugasan_pbg');
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

	function get_permohonan_list($id)
    {
        $this->db->select('a.id as id_pemilik,b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_kabkot_bgn,b.id_kec_bgn,b.id_jenis_permohonan,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,almt_bgn,fungsi_bg,luas_bgn,tinggi_bgn,id_kabkot_bgn,
							b.status,b.id_fungsi_bg,b.jml_lantai,e.nama_kecamatan,h.nama_kabkota,i.nama_provinsi,no_hp,email,no_ktp,luas_basement,lapis_basement,nm_bgn,
							b.id_fungsi_bg,e.nama_kecamatan,a.id_kecamatan,a.id_provinsi,a.id_kabkota,h.nama_kabkota,a.no_hp,b.id_prov_bgn,
							g.nama_kecamatan as nama_kec_bg,j.nama_kabkota as nama_kabkota_bg,k.nama_provinsi nama_provinsi_bg,b.tgl_pernyataan,
							b.luas_bgn,b.tinggi_bgn,b.jml_lantai');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >= 17 ");
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
    
    //Begin Qr Code SLF dan SBKBG
    function get_id_kabkot($id)
	{
		$sql = "SELECT id, id_kabkot_bgn, id_kec_bgn 
				FROM tmdatabangunan where id = ".$id;
		$hasil = $this->db->query($sql)->row_array();
		return $hasil;
	}

    public function insertSK($dataIn)
    {
        $this->db->insert('tmdataslf',$dataIn);
		return $this->db->insert_id();
    }

    function getNoDrafSLF($id_kec_bgn,$tgl_skrg)
	{
			$sql = "SELECT max(no_slf) as no_slf_baru 
			FROM tmdataslf 
			WHERE SUBSTR(no_slf,8,6) = '$id_kec_bgn' and SUBSTR(no_slf,15,8) = '$tgl_skrg'";
			$hasil = $this->db->query($sql)->row_array();
			return $hasil;
	}

    public function getPejabatTtd($id)
	{
		$sql = "SELECT a.id,a.id_kabkot_bgn, b.kepala_dinas, b.nip_kepala_dinas, b.id_dinas,b.p_nama_dinas
			FROM tmdatabangunan a 
			left join tm_profile_teknis b On (a.id_kabkot_bgn = b.id_kabkot)
			where a.id = '$id'";
		$hasil = $this->db->query($sql)->row_array();
		return $hasil;
	}

    public function updateStatus($id, $dataup)
    {
        return $this->db->where('id', $id)->update('tmdatabangunan', $dataup);
    }
    //End qr Code SLF dan SBKBG
    public function  getListValidasi()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,a.nm_pemilik,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_slf');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 19 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
		$this->db->where('id_kabkot_bgn',$Dinas);
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tmdataslf d', 'a.id = d.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}

    public function getDataSlf($id)
    {
        $this->db->select('a.id as id_pemilik,a.nm_pemilik,a.alamat,
        b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,
        b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,b.tinggi_bgn,b.luas_bgn,
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

    public function updateProgress($dataProgress,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tmdatabangunan',$dataProgress);
		$updated_status = $this->db->affected_rows();
	}

    function getPermohonanList($id)
    {
        $this->db->select('a.id as id_pemilik,b.id_izin,c.lama_proses,b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_kabkot_bgn,b.id_kec_bgn,b.id_jenis_permohonan,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,almt_bgn,fungsi_bg,luas_bgn,tinggi_bgn,id_kabkot_bgn,b.status,b.id_fungsi_bg,b.jml_lantai,e.nama_kecamatan,h.nama_kabkota,i.nama_provinsi as nama_prov_pemilik,no_hp,email,no_ktp,luas_basement,lapis_basement,nm_bgn,b.id_fungsi_bg,e.nama_kecamatan,a.id_kecamatan,a.id_provinsi,a.id_kabkota,h.nama_kabkota,a.no_hp,b.id_prov_bgn,g.nama_kecamatan as nama_kec_bg,j.nama_kabkota as nama_kabkota_bg,k.nama_provinsi as nama_provinsi_bg,b.tgl_pernyataan,b.luas_bgn,b.tinggi_bgn,b.jml_lantai,l.id_klasifikasi_bg,l.klasifikasi_bg');
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
		$this->db->order_by('b.status', 'asc');
		$query = $this->db->get();
		return $query;
    }

    function getdatapemilikDok($id='null')
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

    function getdatabangunanDok($id='null')
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
				j.no_sk_tk,j.date_sk_tk,
                k.no_slf,k.tgl_penerbitan_slf,k.nm_dinas,k.nm_kadis_teknis,k.nip_kadis_teknis,k.okupansi
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
                LEFT JOIN tmdataslf k On(k.id = b.id)
				WHERE (a.id=$id)
			limit 1
			";
		$hasil = $this->db->query($sql);
		return $hasil->row_array();
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

	function getDataFungsi($fg_bg='null', $jns_bg='null')
	{
		$sql = "SELECT a.*
				FROM tm_jenis_bg a
				WHERE(1=1) And a.id_fungsi_bg=$fg_bg AND a.id_jns_bg = $jns_bg
			";
		$hasil = $this->db->query($sql);
		return $hasil->row_array();
	}

}

/* End of file Minspeksi.php */
