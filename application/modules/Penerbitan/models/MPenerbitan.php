<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MPenerbitan extends CI_Model{
	//Begin Data Summary
	public function  getDataPemilik($id)
	{
		$this->db->select('*');
		$this->db->from('tmdatapemilik a');
		$this->db->where('a.id',$id);
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->join('tr_kecamatan d', 'a.id_kecamatan = d.id_kecamatan','LEFT');
		$this->db->join('tr_kabkot e', 'a.id_kabkota = e.id_kabkot','LEFT');
		$this->db->join('tr_provinsi f', 'a.id_provinsi = f.id_provinsi','LEFT');
		$query = $this->db->get();
		return $query;
	}

	public function  getDataBangunan($id)
    {
        $this->db->select('b.*,c.nm_konsultasi,
		k.nama_kelurahan,
        d.nama_kecamatan,
        e.nama_kabkota,
        f.nama_provinsi,
        g.*,
        h.fungsi_bg,
        i.*,
        j.*,
        ');
        $this->db->from('tmdatapemilik a');
        $this->db->where('a.id', $id);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_kelurahan k', 'b.id_kel_bgn = k.id_kelurahan', 'LEFT');
        $this->db->join('tr_kecamatan d', 'b.id_kec_bgn = d.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot e', 'b.id_kabkot_bgn = e.id_kabkot', 'LEFT');
        $this->db->join('tr_provinsi f', 'b.id_prov_bgn = f.id_provinsi', 'LEFT');
        $this->db->join('tm_retribusi g', 'g.id = b.id', 'LEFT');
        $this->db->join('tr_fungsi_bg h', 'h.id_fungsi_bg = b.id_fungsi_bg', 'left');
        $this->db->join('tr_klasifikasi_bg i', 'i.id_klasifikasi_bg = c.klasifikasi_bg', 'LEFT');
        $this->db->join('tr_kegiatan j', 'j.id_kegiatan = g.id_kegiatan', 'left');
        $query = $this->db->get();
        return $query;
    }

    public function getPrasarana($id)
	{
		return $this->db->where('id', $id)->get('tm_prasaranaretribusi');
	}

	public function getTerbitPBG($select="*",$id){
		$this->db->select($select,FALSE);
		$this->db->where('a.id',$id);
		$this->db->join('tmdatapemilik b', 'a.id = b.id','LEFT');
		$query 	= $this->db->get('tmdatabangunan a')->row();
		return $query;
	}
	//End Data Summary
	//Begin Validasi KadisTeknis
	public function  getListSKRD()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 11 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
		if($Dinas =='31'){
			$this->db->where('b.id_prov_bgn = 31');
			$this->db->where('b.jml_lantai > 8');
		}else if ($Dinas =='3101' || $Dinas =='3171' || $Dinas =='3172' || $Dinas =='3173' || $Dinas =='3174' || $Dinas =='3175'){
			$this->db->where('b.id_kabkot_bgn', $Dinas);
			$this->db->where('b.jml_lantai < 9');
		}else {
			$this->db->where('b.id_kabkot_bgn', $Dinas);
		}
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		$this->db->limit(30);
		return $query;
	}
	
	
	
	function getDataJadwal($id=null,$key_sidang=null,$get_max=null)
	{
		$sql = "SELECT a.*
				FROM tmdatajadwal a
				left join tmdatabangunan b on (a.id = b.id)
				WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		if ($key_sidang != null || trim($key_sidang) != '')  $sql .= " AND a.id_jadwal = '$key_sidang' ";
		if ($get_max != null || trim($get_max) != ''){
		$sql .= "  ORDER BY a.id_jadwal DESC limit 1";
		}
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	//Begin SKRD
	function insert_skrd($dataIn)
	{
		$this->db->insert('tmdataskrd',$dataIn);
		return $this->db->insert_id();
	}
	function insert_Penagihan($dataIn)
	{
		$this->db->insert('tmbayar',$dataIn);
		return $this->db->insert_id();
	}
	function update_Penagihan($dataIn,$id_bayar)
	{
		$this->db->where('id_bayar', $id_bayar);
		$this->db->update('tmbayar',$dataIn);
	}
	public function updateProgress($dataProgress,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tmdatabangunan',$dataProgress);
		$updated_status = $this->db->affected_rows();
	}
	public function updateValidasi($datavalidasi,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tmdatapbg',$datavalidasi);
		$updated_status = $this->db->affected_rows();
	}
	//End SKRD
	//Begin SSRD
	public function  getListSSRD()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 12 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
		if($Dinas =='31'){
			$this->db->where('b.id_prov_bgn = 31');
			$this->db->where('b.jml_lantai > 8');
		}else if ($Dinas =='3101' || $Dinas =='3171' || $Dinas =='3172' || $Dinas =='3173' || $Dinas =='3174' || $Dinas =='3175'){
			$this->db->where('b.id_kabkot_bgn', $Dinas);
			$this->db->where('b.jml_lantai < 9');
		}else {
			$this->db->where('b.id_kabkot_bgn', $Dinas);
		}
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}
	
	public function getPejabatTtd($id)
	{
		$sql = "SELECT a.id,a.id_kabkot_bgn,a.imb,
			b.kepala_dinas, b.nip_kepala_dinas, b.id_dinas, b.status_pejabat
			FROM tmdatabangunan a 
			left join tm_profile_dinas b On (a.id_kabkot_bgn = b.id_kabkot)
			where a.id = ".$id;
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
	function getNoDrafPbg($id_kec_bgn,$tgl_skrg)
	{
			$sql = "SELECT max(no_izin_pbg) as no_registrasi_baru 
			FROM tmdatapbg 
			WHERE SUBSTR(no_izin_pbg,8,6) = '$id_kec_bgn' and SUBSTR(no_izin_pbg,15,8) = '$tgl_skrg'";
			$hasil = $this->db->query($sql)->row_array();
			return $hasil;
	}
	function insertDataPenerbitanPbg($dataInKonsultasi)
	{
		$this->db->insert('tmdatapbg',$dataInKonsultasi);
		return $this->db->insert_id();
	}
	
	function InsertSsrd($dataIn)
	{
		$this->db->insert('tmdatassrd',$dataIn);
		return $this->db->insert_id();
	}
	
	function update_ssrd($dataIn,$id)
	{
		$this->db->where('id_ssrd', $id);
		$this->db->update('tmdatassrd',$dataIn);
	}
	//End SSRD
	//Begin Validasi Kadis PBG Bangunan Baru
	public function  getListValidasi()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_izin_pbg');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 13 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
		$this->db->where("b.id_jenis_permohonan != 14 ");
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
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->join('tmdatapbg d', 'a.id = d.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}
	//End Validasi Kadis PBG Bangunan Baru
	//Begin Validasi Kadis Bangunan Eksisting
	public function  getListValidasiSLF()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_slf');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 13 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
		$this->db->where("b.id_izin = 2 ");

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
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->join('tmdataslf d', 'd.id = a.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}
	//End Validasi Kadis Bangunan Eksisting
	//Begin Validasi Kadis SLF Bangunan Baru
	public function getDataValidasi()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_slf,e.no_izin_pbg');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 20 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
		//$this->db->where("b.imb != 1 ");
		$this->db->where("b.id_jenis_permohonan != 14 ");
		$this->db->where("b.id_jenis_permohonan != 9 ");
		if($Dinas =='31'){
			$this->db->where('b.id_prov_bgn = 31');
			$this->db->where('b.jml_lantai > 8');
		}else if ($Dinas =='3101' || $Dinas =='3171' || $Dinas =='3172' || $Dinas =='3173' || $Dinas =='3174' || $Dinas =='3175'){
			$this->db->where('b.id_kabkot_bgn', $Dinas);
			$this->db->where('b.jml_lantai < 9');
		}else {
			$this->db->where('b.id_kabkot_bgn', $Dinas);
		}

		/*if($Dinas =='31'){
			$this->db->where('b.id_prov_bgn = 31');
		}else{
			$this->db->where('b.id_kabkot_bgn', $Dinas);
		}*/
	  	//$this->db->where('id_kabkot_bgn',$Dinas);
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->join('tmdataslf d', 'a.id = d.id','LEFT');
		$this->db->join('tmdatapbg e', 'a.id = e.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}
	//End Validasi Kadis SLF Bangunan Baru
	function getdatafungsibg($id=null,$cari=null)
	{
		$sql = "SELECT a.*
		FROM tmdatabangunan a
		WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	
	//End Validasi Kadis
	//Begin Penyerahan Draf
	public function  getListPenyerahan()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_izin_pbg');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 15 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
		$this->db->where("b.id_jenis_permohonan != 14 ");
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
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->join('tmdatapbg d', 'b.id = d.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		$this->db->limit(30);
		return $query;
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

	function SimpanPenyerahan($data_terbit)
	{
		$this->db->insert('tmdatapenyerahan',$data_terbit);
		return $this->db->insert_id();
	}

	function SimpanPenyerahanDok($data_terbit)
	{
		$this->db->insert('tmdatapenyerahanslf',$data_terbit);
		return $this->db->insert_id();
	}

	public function  getListPenyerahanSlf()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_slf');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 20 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.id_jenis_permohonan != 14 ");
	  	$this->db->where('id_kabkot_bgn',$Dinas);
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->join('tmdataslf d', 'b.id = d.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}

	public function  getListPenyerahanSlfEks()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_slf');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 15 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.id_jenis_permohonan = 14 ");
	  	$this->db->where('id_kabkot_bgn',$Dinas);
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		//$this->db->join('tmdatapbg d', 'b.id = d.id','LEFT');
		$this->db->join('tmdataslf d', 'b.id = d.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}

	public function  getListPenyerahanSBKBG()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_izin_pbg');
		$this->db->from('tmdatapemilik a');
		$this->db->where("status >= 15 ");
	  	$this->db->where('id_kabkot_bgn',$Dinas);
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->join('tmdatapbg d', 'b.id = d.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
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
	//End Penyerahan Draf
	//Begin Draf
	function getDataPermohonan($id)
	{
		$this->db->select('a.id,b.nm_konsultasi,id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
		$this->db->where("a.id", $id);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
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

	function tanah($id)
	{
		$sql = "SELECT a.id, y.*, r.nama_kabkota,z.nama_provinsi,x.nama_kecamatan
						FROM tmdatapemilik a
						LEFT JOIN tmdatatanah y ON(y.id=a.id)
						LEFT JOIN tr_kabkot r ON(r.id_kabkot=y.id_kabkot)
						LEFT JOIN tr_provinsi z ON(z.id_provinsi=y.id_provinsi)
						LEFT JOIN tr_kecamatan x ON(x.id_kecamatan=y.id_kecamatan)
						WHERE (a.id=$id)";
		$hasil = $this->db->query($sql);
		return $hasil;
	}
	
	public function getDataPbg($id)
	{
		$this->db->select('a.*');
		$this->db->from('tmdatapbg a');
		$this->db->where('a.id', $id);
		$this->db->order_by('a.id', 'desc');
		return $this->db->get();
	}
	
	function get_penerbitan_pbg_pemecahan($id)
	{
		$this->db->select('a.*,b.no_konsultasi,b.id_fungsi_bg,a.nm_pemilik,a.alamat,b.almt_bgn,b.nm_bgn,b.jns_bangunan,b.tinggi_bgn,b.luas_bgn,e.id_pbg,e.no_pbg,e.tgl_pbg,e.ttd_pejabat_sk,e.nip_pejabat_sk,
		d.nm_konsultasi, j.nama_provinsi as nama_provinsi_bg, g.nama_kabkota, h.nama_provinsi,
		c.fungsi_bg,f.nama_kecamatan,k.nama_kabkota as nama_kabkota_bg,
		i.dir_file_logo,i.p_alamat,i.p_nama_dinas,i.p_tlp,i.sub_domain,
		l.atas_nama_dok,l.luas_tanah,l.lokasi_tanah,l.hat,d.nm_konsultasi,m.no_sk_tk,m.date_sk_tk,m.tgl_konsultasi');
		$this->db->from('tmdatapemilik a');
		$this->db->join('tmdatabangunan b', 'b.id = a.id', 'left');
		$this->db->join('tr_fungsi_bg c', 'c.id_fungsi_bg = b.id_fungsi_bg', 'left');
		$this->db->join('tr_konsultasi d', 'd.id = b.id_jenis_permohonan', 'left');
		$this->db->join('tmdatapbg e', 'e.id = a.id', 'left');
		$this->db->join('tr_kecamatan f', 'f.id_kecamatan = a.id_kecamatan', 'left');
		$this->db->join('tr_kabkot g', 'g.id_kabkot = a.id_kabkota', 'left');
		$this->db->join('tr_provinsi h', 'h.id_provinsi = a.id_provinsi', 'left');
		$this->db->join('tm_profile_dinas i', 'i.id_kabkot = b.id_kabkot_bgn', 'left');
		$this->db->join('tr_provinsi j', 'j.id_provinsi = b.id_prov_bgn', 'left');
		$this->db->join('tr_kabkot k', 'k.id_kabkot = b.id_kabkot_bgn', 'left');
		$this->db->join('tmdatatanah l', 'l.id = a.id', 'left');
		$this->db->join('tmdatajadwal m', 'm.id = a.id', 'left');
		$this->db->where('a.id', $id);
		$this->db->order_by('no_konsultasi', 'desc');
		return $this->db->get();
	}
	
	function undangUndang()
	{
		return $this->db->get('tr_uu');
	}

	function peraturan($id)
	{
		$this->db->select('x.nama_perda');
		$this->db->from('tmdatapemilik a');
		$this->db->join('tmdatabangunan b', 'b.id = a.id', 'left');
		$this->db->join('tm_data_perda x', 'x.id_kabkot = b.id_kabkot_bgn', 'left');
		$this->db->where('a.id', $id);
		return $this->db->get();		
	}

	public function getRetribusi($id)
	{
		$this->db->select('a.id,b.nilai_retribusi_keseluruhan,c.tgl_penagihan,c.no_penagihan,c.dir_file_penagihan,
		d.bukti_pembayaran,d.tgl_pembayaran,e.validasi_retri');
		$this->db->from('tmdatapemilik a');
		$this->db->where('a.id', $id);
		$this->db->join('tm_retribusi b', 'a.id = b.id', 'LEFT');
		$this->db->join('tmbayar c', 'a.id = c.id_pbgnya', 'LEFT');
		$this->db->join('tmdatapembayaran d', 'a.id=d.id', 'LEFT');
		$this->db->join('tmdatapbg e', 'a.id=e.id', 'LEFT');
		$this->db->order_by('a.id', 'asc');
		return $this->db->get();
	}
	
	function bayar($id)
	{
		$this->db->select('a.*,b.*');
		$this->db->from('tmdatapemilik a');
		$this->db->join('tmbayar b', 'b.id_pbgnya = a.id', 'left');
		$this->db->where('a.id', $id);
		return $this->db->get();
	}

	function getDataRetribusi($id=null)
	{
		$sql = "SELECT a.*,
				q.*,
				d.dir_file_skrd,d.no_skrd,
				e.file_ssrd,e.no_ssrd,
				f.validasi_retri,
				r.nama_fungsi,r.index_fungsi,s.index_klasifikasi as index_klasifikasi_bg,
				o.fungsi_bg,o.id_pemanfaatan_bg as id_pemanfaatan_bg2,p.klasifikasi_bg,
				b.dir_file_konsultasi,b.id_jadwal
				";
		$sql .= "	FROM tmdatabangunan a 
						LEFT JOIN tmdatajadwal b ON(b.id=a.id)
						LEFT JOIN tr_imb_permohonan c ON(a.id_jenis_permohonan = c.id_jenis_permohonan)
						LEFT JOIN tmdataskrd d ON (a.id=d.id)
						LEFT JOIN tmdatassrd e ON (a.id=e.id)
						LEFT JOIN tmdatapbg f ON (a.id=f.id)
						LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
						LEFT JOIN tr_klasifikasi_bg p ON(p.id_klasifikasi_bg=c.id_klasifikasi_bg)
						LEFT JOIN ref_fungsi r ON(o.id_fungsi_bg=r.id_fungsi)
						LEFT JOIN ref_klasifikasi_detail s ON(p.id_klasifikasi_bg=s.id_klasifikasi_detail)
						LEFT JOIN tmbayar q ON(a.id=q.id_pbgnya)
					WHERE (1=1)";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function getDataPenerbitan($id)
    {
        $this->db->select('a.id as id_pemilik,a.nm_pemilik,a.alamat,,c.nama_provinsi,d.nama_kabkota,e.nama_kecamatan,
        b.id_kec_bgn,b.id_jenis_permohonan,b.id_izin,b.no_konsultasi,b.almt_bgn,b.tgl_pernyataan,b.luas_bgn,b.jml_lantai,b.tinggi_bgn,b.luas_bgn,b.nm_bgn,
        f.nama_provinsi as nm_prov_bgn,
        g.nama_kabkota as nm_kabkot_bgn,
        h.nama_kecamatan as nm_kec_bgn,
        i.no_izin_pbg,i.nm_kadis,i.nip_kadis,
		j.nilai_retribusi_keseluruhan,
		k.fungsi_bg,
		l.nama_kelurahan as nm_kel_bgn,
		m.atas_nama_dok, m.luas_tanah,
        ');
        $this->db->from('tmdatapemilik a');
        $this->db->where('b.id', $id);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_provinsi c', 'a.id_provinsi=c.id_provinsi', 'LEFT');
        $this->db->join('tr_kabkot d', 'a.id_kabkota=d.id_kabkot', 'LEFT');
        $this->db->join('tr_kecamatan e', 'a.id_kecamatan= e.id_kecamatan', 'LEFT');

        $this->db->join('tr_provinsi f', 'b.id_prov_bgn = f.id_provinsi', 'LEFT');
        $this->db->join('tr_kabkot g', 'b.id_kabkot_bgn = g.id_kabkot', 'LEFT');
        $this->db->join('tr_kecamatan h', 'b.id_kec_bgn = h.id_kecamatan', 'LEFT');
		$this->db->join('tr_kelurahan l', 'b,id_kel_bgn = l.id_kelurahan', 'LEFT');
        $this->db->join('tmdatapbg i', 'a.id = i.id', 'LEFT');
		$this->db->join('tm_retribusi j', 'a.id = j.id', 'LEFT');
		$this->db->join('tr_fungsi_bg k', 'b.id_fungsi_bg = k.id_fungsi_bg', 'LEFT');
		$this->db->join('tmdatatanah m', 'a.id = m.id', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

	public function getTotalRetribusi($id)
	{
		return $this->db->where('id',$id)->get('tm_retribusi');
	}

	function getdatapemilikDok($id='null')
	{
		$sql = "SELECT a.id,a.nm_pemilik,a.alamat,a.jns_pemilik,
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
				b.id_prov_bgn,b.id_kabkot_bgn,b.id_izin,b.id_jenis_permohonan,b.nm_bgn,b.almt_bgn,b.luas_bgn,b.id_fungsi_bg,b.jml_lantai,
				b.tipeA,b.luasA,b.tinggiA,b.lantaiA,b.jumlahA,b.luas_bgp,b.status,b.id_dki,b.id_kec_bgn,
				c.nama_kelurahan,
				d.nama_kecamatan,
				e.nama_kabkota,
				f.nama_provinsi,
				g.nilai_retribusi_bangunan,g.nilai_retribusi_prasarana,g.nilai_retribusi_keseluruhan,
				h.no_izin_pbg,h.nm_kadis,h.nip_kadis,h.tgl_pbg,h.status_pejabat,
				i.fungsi_bg,i.id_pemanfaatan_bg,
				j.no_sk_tk,j.date_sk_tk,
				l.p_nama_dinas,l.kepala_dinas,l.nip_kepala_dinas,l.status_pejabat as stat_pejabat,
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

	function getdatabangunanDokSLF($id='null')
	{
		$sql = "SELECT a.id,
				b.id_kabkot_bgn,b.id_izin,b.id_jenis_permohonan,b.nm_bgn,b.almt_bgn,b.luas_bgn,b.id_fungsi_bg,b.luas_bgp,b.id_kec_bgn,b.id_jns_bg,
				b.jml_lantai,b.tipeA,b.luasA,b.tinggiA,b.lantaiA,b.jumlahA,b.no_imb,b.status,b.id_dki,b.permohonan_slf,b.id_klasifikasi,
				c.nama_kelurahan,
				d.nama_kecamatan,
				e.nama_kabkota,
				f.nama_provinsi,
				g.nilai_retribusi_bangunan,g.nilai_retribusi_prasarana,g.nilai_retribusi_keseluruhan,g.file_retribusi,
				h.no_izin_pbg,h.nm_kadis,h.nip_kadis,h.tgl_pbg,h.status_pejabat,
				i.fungsi_bg,i.id_pemanfaatan_bg,
				j.no_sk_tk,j.date_sk_tk,
                k.no_slf,k.nm_kadis_teknis,k.nip_kadis_teknis,k.nm_dinas,k.tgl_penerbitan_slf,k.okupansi,k.luas_dasar,k.status_pejabat as stat_pjbt,
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
	//End Draf
	public function removeDataSK($id)
	{
		$this->db->query("DELETE FROM tmdatapbg WHERE id = $id");
		$this->db->where('id',$id);
		return $query;
	}

	public function cekNamaNoIzin($select = "a.*", $sk_pbg)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.no_izin_pbg', $sk_pbg);
		$query 	= $this->db->get('tmdatapbg a');
		return $query;
	}
	//Begin Model Untuk PBG dan Lampiran
	function getdatapemilikBangunan($id = 'null')
    {
        $sql = "SELECT a.id,a.nm_pemilik,a.alamat,b.nama_kelurahan,c.nama_kecamatan,d.nama_kabkota,e.nama_provinsi
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
	function getdatabangunanGedung($id = 'null')
    {
        $sql = "SELECT a.id,
				b.id_kabkot_bgn,b.id_izin,b.nm_bgn,b.almt_bgn,b.luas_bgn,b.id_fungsi_bg,b.jml_lantai,b.tinggi_bgn,b.luas_basement,b.lapis_basement,b.status,b.id_kec_bgn,b.id_klasifikasi,
                b.id_jenis_permohonan,b.imb,b.no_konsultasi,b.id_resiko,b.id_lokasi,b.id_kelas,
                b.tipeA,b.luasA,b.lantaiA,b.tinggiA,b.jumlahA,b.no_imb,b.luas_bgp,b.tinggi_bgp,
				c.nama_kelurahan,
				d.nama_kecamatan,
				e.nama_kabkota,
				f.nama_provinsi,
				g.nilai_retribusi_bangunan,g.nilai_retribusi_prasarana,g.nilai_retribusi_keseluruhan,g.id_permanensi,
				h.no_izin_pbg,h.nm_kadis,h.nip_kadis,h.tgl_validasi,h.status_pejabat,h.tgl_pbg,h.no_validasi,
				i.fungsi_bg,i.id_pemanfaatan_bg,i.fungsi_bg,
				j.no_sk_tk,j.date_sk_tk,
				k.stat_pejabat,k.nama_dinas,k.no_sppst,k.tgl_validasi,
                l.p_nama_dinas,l.kepala_dinas,l.nip_kepala_dinas,l.status_pejabat as status_pej,
				m.jns_prasarana
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
				LEFT JOIN tmdatavalkadintek k On (b.id=k.id)
                LEFT JOIN tm_profile_dinas l on(b.id_kabkot_bgn =l.id_kabkot)
				LEFT JOIN tr_prasarana m On (b.id_prasarana_bg=m.idp)
				WHERE (a.id=$id)
			limit 1
			";
        $hasil = $this->db->query($sql);
        return $hasil->row_array();
    }
	function getDataTanah($id = 'null')
    {
        $sql = "SELECT a.id, b.*,c.Jns_dok
				FROM tmdatapemilik a
				LEFT JOIN tmdatatanah b ON(b.id=a.id)
                LEFT JOIN tr_doktanah c ON(c.id=b.id_dokumen)
                WHERE (a.id=$id)";
        $hasil = $this->db->query($sql);
        return $hasil;
    }
	//End Model Untuk PBG dan Lampiran
}