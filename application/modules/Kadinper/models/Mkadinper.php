<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mkadinper extends CI_Model
{
	//Begin Validasi List Persetujuan Bangunan Gedung
    public function  getListValBangunanGedungBaru()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_izin_pbg');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 13 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
		$this->db->where("b.id_jenis_permohonan != 14 ");
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
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->join('tmdatapbg d', 'a.id = d.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}
	public function  getListValBangunanGedungEksis()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_izin_pbg');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 13 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
		$this->db->where("b.id_jenis_permohonan = 14 ");
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
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->join('tmdatapbg d', 'a.id = d.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}
	//End Validasi List Persetujuan Bangunan Gedung
	//Begin Validasi List Persetujuan Bangunan Prasarana
	public function  getListValBangunanPrasaranaBaru()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_izin_pbg');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 13 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
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
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->join('tmdatapbg d', 'a.id = d.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}
	public function  getListValBangunanPrasaranaEksisting()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_izin_pbg');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 13 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
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
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->join('tmdatapbg d', 'a.id = d.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}
	//End Validasi List Persetujuaan Bangunan Prasarana 
	//Begin Validasi Bangunan PertaShop
	public function  getListValBangunanPertashop()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_izin_pbg');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 13 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
		$this->db->where("b.id_izin = 7 ");
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
	public function  getListValBangunanPertashopEksis()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_izin_pbg');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 13 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
		$this->db->where("b.id_izin = 2 ");
		$this->db->where("b.permohonan_slf = 3 ");
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
	//End Validasi Bangunan PertaShop
	public function getPejabatTtd($id)
	{
		$sql = "SELECT a.id,a.id_kabkot_bgn, b.kepala_dinas, b.nip_kepala_dinas, b.id_dinas, b.status_pejabat
			FROM tmdatabangunan a 
			left join tm_profile_dinas b On (a.id_kabkot_bgn = b.id_kabkot)
			where a.id = ".$id;
		$hasil = $this->db->query($sql)->row_array();
		return $hasil;
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
	public function removeDataSK($id)
	{
		$this->db->query("DELETE FROM tmdatapbg WHERE id = $id");
		$this->db->where('id',$id);
		return $query;
	}
	//End Validasi Persetujuan Bangunan Gedung Baru
	//Begin Validasi Persetujuan Bangunan Gedung dan Sertifikat Laik Fungsi
	public function  getListValBangunanEksis()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_izin_pbg');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 13 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.id_jenis_permohonan = 14 ");
		$this->db->where("b.imb != 1 ");
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
		$this->db->join('tmdatapbg d', 'a.id = d.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}
	//End Validasi Persetujuan Bangunan Gedung dan Sertifikat Laik Fungsi
	//Begin Validasi Sertifikat Laik Fungsi Bangunan Eksisting
	public function  getListValBangunanEksisNon()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_slf');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 13 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.id_jenis_permohonan = 14 ");
		$this->db->where("b.imb = 1 ");
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
		$this->db->join('tmdataslf d', 'a.id = d.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		return $query;
	}
	//End alidasi Sertifikat Laik Fungsi Bangunan Eksisting

	function getNoDrafPbg($id_kec_bgn,$tgl_skrg)
	{
			$sql = "SELECT max(no_izin_pbg) as no_registrasi_baru 
			FROM tmdatapbg 
			WHERE SUBSTR(no_izin_pbg,8,6) = '$id_kec_bgn' and SUBSTR(no_izin_pbg,15,8) = '$tgl_skrg'";
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

/* End of file Mpemeriksaan.php */
