<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpenyerahandokumen extends CI_Model
{
	//Begin Penyerahan Dokumen Persetujuan Bangunan Gedung Bangunan Baru
    public function  getListPenyerahan()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_izin_pbg');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 15 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
		$this->db->where("b.id_izin != 2 ");
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
		return $query;
	}
    function SimpanPenyerahan($data_terbit)
	{
		$this->db->insert('tmdatapenyerahan',$data_terbit);
		return $this->db->insert_id();
	}
    //End Penyerahan Dokumen Persetujuan Bangunan Gedung Bangunan Baru
    //Begin Penyerahan Dokumen Sertifikat Laik Fungsi
    public function  getListPenyerahanSlf()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_slf');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 20 ");
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
		$this->db->join('tmdataslf d', 'b.id = d.id','LEFT');
		$this->db->order_by('b.status','asc');
        $query = $this->db->get();
        return $query;
	}
    function SimpanPenyerahanDok($data_terbit)
	{
		$this->db->insert('tmdatapenyerahanslf',$data_terbit);
		return $this->db->insert_id();
	}
    //End Penyerahan Dokumen Sertifikat Laik Fungsi
    //Begin Penyerahan Dokumen Bangunan Eksisting
    public function  getListPenyerahanSlfEks()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi,d.no_slf');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 15 ");
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
		//$this->db->join('tmdatapbg d', 'b.id = d.id','LEFT');
		$this->db->join('tmdataslf d', 'b.id = d.id','LEFT');
		$this->db->order_by('b.status','asc');
        $query = $this->db->get();
		return $query;
	}
    //End Penyerahan Dokumen Bangunan Eksisting
    //Begin Model Yang DIpakai Bersama
    public function updateProgress($dataProgress,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tmdatabangunan',$dataProgress);
		$updated_status = $this->db->affected_rows();
	}
    public function getTerbitPBG($select="*",$id){
		$this->db->select($select,FALSE);
		$this->db->where('a.id',$id);
		$this->db->join('tmdatapemilik b', 'a.id = b.id','LEFT');
		$query 	= $this->db->get('tmdatabangunan a')->row();
		return $query;
	}
    //End Model Yang DIpakai Bersama
}
