<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mvalidasiteknis extends CI_Model
{
	
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
	public function  getListValidasiBangunanBaru()
    {
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,b.imb,b.catatan,c.nm_konsultasi,d.file_retribusi');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >=", 10);
        $this->db->where("b.status != 25 ");
        $this->db->where("b.status != 26 ");
        $this->db->where("b.pernyataan = 1 ");
        $this->db->where("b.id_jenis_permohonan != 14 ");
        $this->db->where("b.id_jenis_permohonan != 35 ");
        $this->db->where("b.id_jenis_permohonan != 36 ");
        $this->db->where("b.id_izin != 5 ");
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
    public function  getListValidasiPrasaranaBaru()
    {
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,b.imb,b.catatan,c.nm_konsultasi,d.file_retribusi');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >=", 10);
        $this->db->where("b.status != 25 ");
        $this->db->where("b.status != 26 ");
        $this->db->where("b.pernyataan = 1 ");
        $this->db->where("b.id_jenis_permohonan != 14 ");
        $this->db->where("b.id_izin = 5 ");
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
        //$this->db->limit(30);
        $query = $this->db->get();
        return $query;
    }
    public function  getListValidasiBangunanEksisting()
    {
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,b.imb,b.catatan,c.nm_konsultasi,d.file_retribusi');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >= 10");
        $this->db->where("b.status != 25 ");
        $this->db->where("b.status != 26 ");
        $this->db->where("b.pernyataan = 1 ");
        $this->db->where("b.id_izin = 2 ");
        
        //$this->db->where("b.id_jenis_permohonan = 14 ");
        $this->db->where("b.permohonan_slf != 2 ");
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
        //$this->db->limit(30);
        $query = $this->db->get();
        return $query;
    }
    public function  getListValidasiBangunanPrasaranaEksisting()
    {
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,b.imb,b.catatan,c.nm_konsultasi,d.file_retribusi');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >=", 10);
        $this->db->where("b.status != 25 ");
        $this->db->where("b.status != 26 ");
        $this->db->where("b.pernyataan = 1 ");
        $this->db->where("b.id_jenis_permohonan = 14 ");
        $this->db->where("b.permohonan_slf = 2 ");
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
        //$this->db->limit(30);
        $query = $this->db->get();
        return $query;
    }
    public function  getListValidasiBangunanPertashoBaru()
    {
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,b.imb,b.catatan,c.nm_konsultasi,d.file_retribusi');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >=", 10);
        $this->db->where("b.status != 25 ");
        $this->db->where("b.status != 26 ");
        $this->db->where("b.pernyataan = 1 ");
        $this->db->where("b.id_izin = 7 ");
        //$this->db->where("b.permohonan_slf = 2 ");
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
        //$this->db->limit(30);
        $query = $this->db->get();
        return $query;
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
    function getDataVerifikasi($id = 'null')
    {
        $sql = "SELECT a.id as id_pemilik,a.nm_pemilik,a.alamat,
            b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,
            b.id_prasarana_bg,b.id_kabkot_bgn,
            b.tinggi_bgn,b.nm_bgn,b.id_izin,b.imb,b.id_fungsi_bg,b.id_jns_bg,b.tipeA,b.luasA,b.tinggiA,b.lantaiA,b.jumlahA,b.luas_bgp,b.tinggi_bgp,
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

    function getDataVerifikasiEksis($id = 'null')
    {
        $sql = "SELECT a.id as id_pemilik,a.nm_pemilik,a.alamat,
            b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,
            b.id_prasarana_bg,b.id_kabkot_bgn,
            b.tinggi_bgn,b.nm_bgn,b.id_izin,b.imb,b.id_fungsi_bg,b.id_jns_bg,b.tipeA,b.luasA,b.tinggiA,b.lantaiA,b.jumlahA,b.luas_bgp,b.tinggi_bgp,
            c.p_nama_dinas,c.kepala_dinas,c.nip_kepala_dinas,
            d.no_sk_tk,d.date_sk_tk,d.nm_kadis,d.nip_kadis,d.status_pejabat,
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
    function getDataFungsiCampuran($fg_bg = 'null')
    {
        $sql = "SELECT a.*
				FROM tm_jenis_bg a
				WHERE(1=1) And a.id_fungsi_bg=$fg_bg
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
    function getDataFungsiPrasarana($id_prasarana = 'null')
    {
        $sql = "SELECT a.*
				FROM tr_prasarana a
				WHERE(1=1) And a.idp=$id_prasarana
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
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
    
    public function updateProgress($dataProgress, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tmdatabangunan', $dataProgress);
        $updated_status = $this->db->affected_rows();
    }
    public function removeDataRetribusi($id)
	{
		$this->db->query("DELETE FROM tm_retribusi WHERE id = $id");
        $this->db->query("DELETE FROM tm_prasaranaretribusi WHERE id = $id");
		$this->db->where('id',$id);
		return $query;
	}
    function getcatatan($select = "*", $id)
    {
        $this->db->select($select, FALSE);
        if ($id != null || trim($id) != '')
            $this->db->where('a.id', $id);
        $query     = $this->db->get('tmdatabangunan a');
        return $query->row();
    }
    
    function get_pejabat($id)
    {
        $sql = "SELECT a.id,a.id_kabkot_bgn, b.kepala_dinas, b.nip_kepala_dinas, b.p_nama_dinas,b.status_pejabat
        FROM tmdatabangunan a
        left join tm_profile_teknis b On (a.id_kabkot_bgn = b.id_kabkot)
        where a.id = $id";
        $hasil = $this->db->query($sql)->row_array();
        return $hasil;
    }
    function get_pejabat_dki($id)
    {
        $sql = "SELECT a.id,a.id_kabkot_bgn, b.kepala_dinas, b.nip_kepala_dinas, b.p_nama_dinas,b.status_pejabat
        FROM tmdatabangunan a
        left join tm_profile_teknis b On (a.id_prov_bgn = b.id_kabkot)
        where a.id = $id";
        $hasil = $this->db->query($sql)->row_array();
        return $hasil;
    }
    function insertDataValidasi($dataInKonsultasi)
	{
		$this->db->insert('tmdatavalkadintek',$dataInKonsultasi);
		return $this->db->insert_id();
	}
    function getNoDrafSPPST($id_kec_bgn,$tgl_skrg)
	{
			$sql = "SELECT max(no_sppst) as no_registrasi_baru 
			FROM tmdatavalkadintek
			WHERE SUBSTR(no_sppst,7,6) = '$id_kec_bgn' and SUBSTR(no_sppst,14,8) = '$tgl_skrg'";
			$hasil = $this->db->query($sql)->row_array();
			return $hasil;
	}

    function get_id_kabkot($id)
	{
			$sql = "SELECT id, id_kabkot_bgn, id_kec_bgn 
					FROM tmdatabangunan where id = ".$id;
			$hasil = $this->db->query($sql)->row_array();
			return $hasil;
	}
}
