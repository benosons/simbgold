<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mpermohonan extends CI_Model{


	public function getDataPermohonanIMB()
	{
		$tot = $this->session->userdata('loc_id_kabkot');
		$dev = $this->session->userdata('loc_role_id');

		$this->db->select('*');
		$this->db->from('tm_imb_permohonan');
		$this->db->where('pernyataan >= 1');
		$this->db->where('status_progress >= 1');
		if ($dev != 1)  $this->db->where('id_kabkot_bg', $tot);
		$this->db->join('tr_imb_permohonan', 'tm_imb_permohonan.id_jenis_permohonan = tr_imb_permohonan.id_jenis_permohonan');
		$this->db->join('tr_fungsi_bg', 'tm_imb_permohonan.id_fungsi_bg = tr_fungsi_bg.id_fungsi_bg');
		$this->db->join('tm_imb_penerbitan', 'tm_imb_permohonan.id_permohonan = tm_imb_penerbitan.id_permohonan');
		$this->db->join('tr_kabkot', 'tm_imb_permohonan.id_kabkot = tr_kabkot.id_kabkot');
		$this->db->join('tr_provinsi', 'tr_kabkot.id_provinsi = tr_provinsi.id_provinsi');
		$this->db->order_by('tm_imb_permohonan.status_progress', 'asc');
		$query = $this->db->get(); 
		return $query; 
	}

	public function  getListVerifikator($SQLcari = '')
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,a.nm_pemilik,b.status,b.no_konsultasi,b.almt_bgn,c.nm_konsultasi,g.fungsi_bg,b.tgl_pernyataan,h.status_dinas,e.nama_kabkota,f.nama_provinsi');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 1 ");
		$this->db->where("b.status != 26 ");
		//$this->db->where("b.status between '6' and '8' ");
		//$this->db->where('b.id_kabkot_bgn', $Dinas);
		if($Dinas =='31'){
			$this->db->where('b.id_prov_bgn = 31');
			$this->db->where('b.jml_lantai > 8');
		} else if ($Dinas =='3101' || $Dinas =='3171' || $Dinas =='3172' || $Dinas =='3173' || $Dinas =='3174' || $Dinas =='3175'){
			$this->db->where('b.id_kabkot_bgn', $Dinas);
			$this->db->where('b.jml_lantai < 9');
		} else if($Dinas =='100'){
			$this->db->where('b.id_otorita', 1);
		} else {
			$this->db->where('b.id_kabkot_bgn', $Dinas);
		}
		$this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_kecamatan d', 'a.id_kecamatan = d.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot e', 'a.id_kabkota = e.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi f', 'a.id_provinsi = f.id_provinsi', 'LEFT');
		$this->db->join('tr_fungsi_bg g', 'g.id_fungsi_bg = b.id_fungsi_bg', 'LEFT');
		$this->db->join('status_sistem h', 'b.status = h.status_progress', 'LEFT');
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
	public function  getListHapusData($SQLcari = '')
	{
		//$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,a.nm_pemilik,b.status,b.no_konsultasi,b.almt_bgn,c.nm_konsultasi,g.fungsi_bg,b.tgl_pernyataan,h.status_dinas');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.pernyataan = 1 ");
		$this->db->where("b.id_kabkot_bgn  = 9971");
		//$querythis->db->where("b.id_jenis_permohonan != 14 ");
		$this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_fungsi_bg g', 'g.id_fungsi_bg = b.id_fungsi_bg', 'LEFT');
		$this->db->join('status_sistem h', 'h.status_progress = b.status', 'LEFT');
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
	public function removeDataPermohonan($id)
	{
		$this->db->query("DELETE FROM tmdatapemilik WHERE id = $id");
		$this->db->query("DELETE FROM tmdatabangunan WHERE id = $id");
		$this->db->query("DELETE FROM tmdatatanah WHERE id = $id");
		$this->db->query("DELETE FROM tmpersyaratankonsultasi WHERE id = $id");
		$this->db->query("DELETE FROM tmdatajadwal WHERE id = $id");
		$this->db->query("DELETE FROM tm_retribusi WHERE id = $id");
		$this->db->query("DELETE FROM tm_prasaranaretribusi WHERE id = $id");
		$this->db->query("DELETE FROM tm_penugasan_tpa WHERE id_pemilik = $id");
		$this->db->query("DELETE FROM tm_penugasan_pbg WHERE id_pemilik = $id");
		$this->db->query("DELETE FROM tmdatapenyerahan WHERE id = $id");
		$this->db->query("DELETE FROM tmdatapbg WHERE id = $id");
		$this->db->query("DELETE FROM tmdataslf WHERE id = $id");
		$this->db->where('id',$id);
		return $query;
	}

}
