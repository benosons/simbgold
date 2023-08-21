<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Mmonitoring extends CI_Model
{
	protected $selected = 'a.status_progress,a.nomor_registrasi,a.alamat_pemohon,a.nama_bangunan,a.alamat_bg,a.id_provinsi,a.id_provinsi_bg,a.id_kecamatan,a.id_kabkot_bg,a.jns_bangunan';

	public function getDataMonitoringIMB()
	{
		$this->db->select($this->selected);
		$this->db->from('tm_imb_permohonan a');
		$this->db->where('pernyataan >= 1');
		$this->db->where('status_progress >= 1');
		$this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
		$this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
		$this->db->order_by('a.status_progress', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findProvincesWithoutKabkotaKecamatan($provinsi)
	{
		$this->db->select($this->selected);
		$this->db->from('tm_imb_permohonan a');
		$this->db->where('pernyataan >= 1');
		$this->db->where('status_progress >= 1');
		$this->db->where('id_provinsi_bg', $provinsi);
		$this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
		$this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
		$this->db->order_by('a.status_progress', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findKabkotaWithoutProvincesKecamatan($kabkota)
	{
		$this->db->select($this->selected);
		$this->db->from('tm_imb_permohonan a');
		$this->db->where('pernyataan >= 1');
		$this->db->where('status_progress >= 1');
		$this->db->where('id_kabkot_bg', $kabkota);
		$this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
		$this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
		$this->db->order_by('a.status_progress', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findKecamatanWithoutProvincesKabkota($kecamatan)
	{
		$this->db->select($this->selected);
		$this->db->from('tm_imb_permohonan a');
		$this->db->where('pernyataan >= 1');
		$this->db->where('status_progress >= 1');
		$this->db->where('id_kecamatan', $kecamatan);
		$this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
		$this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
		$this->db->order_by('a.status_progress', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findProvincesAndKabkota($provinsi, $kabkota)
	{
		$this->db->select($this->selected);
		$this->db->from('tm_imb_permohonan a');
		$this->db->where('pernyataan >= 1');
		$this->db->where('status_progress >= 1');
		$this->db->where('id_provinsi_bg', $provinsi);
		$this->db->where('id_kabkot_bg', $kabkota);
		$this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
		$this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
		$this->db->order_by('a.status_progress', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findProvincesAndKecamatan($provinsi, $kecamatan)
	{
		$this->db->select($this->selected);
		$this->db->from('tm_imb_permohonan a');
		$this->db->where('pernyataan >= 1');
		$this->db->where('status_progress >= 1');
		$this->db->where('id_provinsi_bg', $provinsi);
		$this->db->where('id_kecamatan', $kecamatan);
		$this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
		$this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
		$this->db->order_by('a.status_progress', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findKabkotaAndKecamatan($kabkota, $kecamatan)
	{
		$this->db->select($this->selected);
		$this->db->from('tm_imb_permohonan a');
		$this->db->where('pernyataan >= 1');
		$this->db->where('status_progress >= 1');
		$this->db->where('id_kabkot_bg', $kabkota);
		$this->db->where('id_kecamatan', $kecamatan);
		$this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
		$this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
		$this->db->order_by('a.status_progress', 'asc');
		$query = $this->db->get();
		return $query;
	}


	public function findAllState($provinsi, $kabkota, $kecamatan)
	{
		$this->db->select($this->selected);
		$this->db->from('tm_imb_permohonan a');
		$this->db->where('pernyataan >= 1');
		$this->db->where('status_progress >= 1');
		$this->db->where('id_provinsi_bg', $provinsi);
		$this->db->where('id_kabkot_bg', $kabkota);
		$this->db->where('id_kecamatan', $kecamatan);
		$this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
		$this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
		$this->db->order_by('a.status_progress', 'asc');
		$query = $this->db->get();
		return $query;
	}
	
	public function reports_datoss()
	{
		$sql = "SELECT * FROM v_reportsoss";
		$hasil = $this->db->query($sql)->row_array();
		return $hasil;
		
	}
}

/* End of file Mmonitoring2.php */
