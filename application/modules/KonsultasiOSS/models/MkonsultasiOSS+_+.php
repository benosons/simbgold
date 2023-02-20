<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MkonsultasiOSS extends CI_Model
{
	//Begin Fungsi Tarik Data
	public function getDataUserProfil($select = "a.*", $user_id = '')
	{
		$this->db->select($select, FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.user_id', $user_id);
		$query 	= $this->db->get('tm_user_data a');
		return $query;
	}

	public function getDataKonsultasi($select = "a.*,c.*", $user_id = '', $id_permohonan = '', $sbkbg = '')
	{
		$this->db->select($select, FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.user_id', $user_id);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan', $id_permohonan);
		/*if ($sbkbg == 1)
		{ 
			$this->db->where('b.sbkbg', $sbkbg); 
		}else{
			$this->db->where('b.sbkbg != 1', NULL);
		}*/
		//$this->db->where("b.status != 26 ");
		$this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('status_sistem d', 'b.status = d.status_progress', 'LEFT');
		$this->db->order_by('a.id', 'asc');
		$query 	= $this->db->get('tmdatapemilik a');
		return $query;
	}
	
	public function getDataKonsultasiCetak($select = "a.*,c.*", $id = '', $id_permohonan = '', $sbkbg = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		if ($id_permohonan != null || trim($id_permohonan) != '')  $this->db->where('a.id_permohonan', $id_permohonan);
		$this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('status_sistem d', 'b.status = d.status_progress', 'LEFT');
		$this->db->order_by('a.id', 'asc');
		$query 	= $this->db->get('tmdatapemilik a');
		return $query;
	}

	public function getDataPenyedia($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')
		$this->db->where('a.id', $id);
		$query 	= $this->db->get('tmdatapenyedia a');
		return $query->row();
	}

	public function getPemilik($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')
		$this->db->where('a.id', $id);
		$this->db->join('tr_kecamatan b', 'a.id_kecamatan = b.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot c', 'a.id_kabkota = c.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi d', 'a.id_provinsi = d.id_provinsi', 'LEFT');
		$query 	= $this->db->get('tmdatapemilik a');
		return $query->row();
	}

	public function getBangunan($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')
			$this->db->where('a.id', $id);
		$this->db->join('tr_kelurahan h', 'a.id_kel_bgn = h.id_kelurahan', 'LEFT');
		$this->db->join('tr_kecamatan b', 'a.id_kec_bgn = b.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot c', 'a.id_kabkot_bgn = c.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi d', 'a.id_prov_bgn = d.id_provinsi', 'LEFT');
		$this->db->join('tr_konsultasi e', 'a.id_jenis_permohonan = e.id', 'LEFT');
		$this->db->join('tr_prototype f', 'a.id_prototype = f.idp', 'LEFT');
		$this->db->join('tr_prasarana g', 'a.id_prasarana_bg = g.idp', 'LEFT');
		$query 	= $this->db->get('tmdatabangunan a');
		return $query->row();
	}
	
	public function getBangunanData($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')
			$this->db->where('a.id', $id);
		$query 	= $this->db->get('tmdatabangunan a');
		return $query->row();
	}

	public function getInformasi($select = "a.*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		$this->db->where('a.status', '4');
		$query 	= $this->db->get('th_data_konsultasi a');
		return $query;
	}

	public function getDataUmum($select = "a.*", $id_jenis_permohonan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
		$this->db->where('a.id_jenis_persyaratan', '1');
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		$this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}
	public function getDataUmumBertahap($select = "a.*", $id_jenis_permohonan = '',  $tahap_pbg='')
	{
		$this->db->select($select, FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
		if ($tahap_pbg != null || trim($tahap_pbg) != '')  $this->db->where('c.id_tahap', $tahap_pbg);
		$this->db->where('a.id_jenis_persyaratan', '1');
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		$this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}

	public function getDataTanah($select = "a.*", $id_jenis_permohonan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
		$this->db->where('a.id_detail_jenis_persyaratan', '1');
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		$this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}

	public function getDataArsitektur($select = "a.*", $id_jenis_permohonan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
		$this->db->where('a.id_detail_jenis_persyaratan', '2');
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		$this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}

	public function getDataArsitekturBertahap($select = "a.*", $id_jenis_permohonan = '', $tahap_pbg='')
	{
		$this->db->select($select, FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
		if ($tahap_pbg != null || trim($tahap_pbg) != '')  $this->db->where('c.id_tahap', $tahap_pbg);
		$this->db->where('a.id_detail_jenis_persyaratan', '2');
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		$this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}

	public function getDataStruktur($select = "a.*", $id_jenis_permohonan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
		$this->db->where('a.id_detail_jenis_persyaratan', '3');
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		$this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}

	public function getDataStrukturBertahap($select = "a.*", $id_jenis_permohonan = '' ,$tahap_pbg='')
	{
		$this->db->select($select, FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
		if ($tahap_pbg != null || trim($tahap_pbg) != '')  $this->db->where('c.id_tahap', $tahap_pbg);
		$this->db->where('a.id_detail_jenis_persyaratan', '3');
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		$this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}

	public function getDataMEPBertahap($select = "a.*", $id_jenis_permohonan = '', $tahap_pbg='')
	{
		$this->db->select($select, FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
		if ($tahap_pbg != null || trim($tahap_pbg) != '')  $this->db->where('c.id_tahap', $tahap_pbg);
		$this->db->where('a.id_detail_jenis_persyaratan', '4');
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		$this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}

	public function getDataMEP($select = "a.*", $id_jenis_permohonan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
		$this->db->where('a.id_detail_jenis_persyaratan', '4');
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		$this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}

	public function getDataHijau($select = "a.*", $id_jenis_permohonan = '', $tahap_pbg='')
	{
		$this->db->select($select, FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
		if ($tahap_pbg != null || trim($tahap_pbg) != '')  $this->db->where('c.id_tahap', $tahap_pbg);
		$this->db->where('a.id_detail_jenis_persyaratan', '6');
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		$this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}

	public function getMasterArsitektur($select = "a.*", $id_jenis_permohonan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
		$this->db->where('a.id_detail_jenis_persyaratan', '3');
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		$this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}
	public function getMasterStruktur($select = "a.*", $id_jenis_permohonan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
		$this->db->where('a.id_detail_jenis_persyaratan', '3');
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		$this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}

	public function getDataDokumen($select = "a.*", $id = '', $status = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		if ($status != null || trim($status) != '')  $this->db->where('a.status', $status);
		$query 	= $this->db->get('tmpersyaratankonsultasi a');
		return $query;
	}

	public function getTanah($select = "a.*,b.Jns_dok", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		$this->db->join('tr_doktanah b', 'a.id_dokumen = b.id', 'LEFT');
		$query 	= $this->db->get('tmdatatanah a');
		return $query;
	}

	public function getRetribusiPrasarana($select = "a.*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		$query 	= $this->db->get('tm_prasaranaretribusi a');
		return $query;
	}

	public function get_nomor_registrasi($id_kec_bg, $tgl_skrg)
	{
		$sql = "SELECT max(no_konsultasi) as no_urut 
			FROM tmdatabangunan WHERE SUBSTR(no_konsultasi,5,6) = '$id_kec_bg'
			and SUBSTR(no_konsultasi,12,8) = '$tgl_skrg'";
		$hasil = $this->db->query($sql)->row_array();
		return $hasil;
	}

	public function get_id_kabkot($id)
	{
		$sql = "SELECT id, no_konsultasi, id_kabkot_bgn, id_kec_bgn , id_izin
		FROM tmdatabangunan where id = " . $id;
		$hasil = $this->db->query($sql)->row_array();
		return $hasil;
	}
	//End Fungsi Tarik Data

	//Begin Dashboard List Pengajuan Permohonan
	public function getDataUserPemohon($select = "a.*", $user_id = '')
	{
		$this->db->select($select, FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.id', $user_id);
		$this->db->join('tm_user_data b', 'a.id = b.user_id', 'LEFT');
		$query 	= $this->db->get('tm_user a')->row();
		return $query;
	}
	//Begin Fungsi Hapus
	public function removeData($id)
	{
		$sql = "DELETE a.*
				FROM tmdatapemilik a 
				WHERE (1=1)";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	//End Fungsi Hapus

	//End Dashboard List Pengajuan Permohonan

	// End Get Data Nomor Registrasi
	public function getDataJnsKonsultasi($select = "a.*,b.*", $id = '')
	{
		$this->db->select($select, FALSE);
		$this->db->join('tmdatapemilik b', 'b.id = a.id', 'LEFT');
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		$query 	= $this->db->get('tmdatabangunan a');
		return $query;
	}

	public function listDataKecamatan($select = "a.*", $id_kecamatan = '', $id_kabkot = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kecamatan != null || trim($id_kecamatan) != '')  $this->db->where('a.id_kecamatan', $id_kecamatan);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot', $id_kabkot);
		$this->db->join('tr_kabkot b', 'a.id_kabkot = b.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi c', 'b.id_provinsi = c.id_provinsi', 'LEFT');
		$this->db->order_by('a.id_kabkot', 'asc');
		$query 	= $this->db->get('tr_kecamatan a');
		return $query;
	}

	public function listDataKabKota($select = "a.*", $id_kabkot = '', $id_provinsi = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot', $id_kabkot);
		if ($id_provinsi != null || trim($id_provinsi) != '')  $this->db->where('a.id_provinsi', $id_provinsi);
		$query 	= $this->db->get('tr_kabkot a');
		return $query;
	}

	public function listDataProvinsi($select = "a.*")
	{
		$this->db->select($select, FALSE);
		$query 	= $this->db->get('tr_provinsi a');
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

	/*public function removeDataTanah($id_detail, $id)
	{
		$this->db->query("DELETE FROM tmdatatanah WHERE id_detail = $id_detail");
		$this->db->where('id', $id);
		$query = $this->db->delete('tmdatatanah');
		return $query;
	}*/
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

	public function removeDataTanah($id_detail)
	{
		$this->db->query("DELETE FROM tmdatatanah WHERE id_detail = $id_detail");
		//$this->db->where('id', $id);
		$query = $this->db->delete('tmdatatanah');
		return $query;
	}

	public function removeDataBangunan($id_bgn, $id)
	{
		if ($id_bgn != null || trim($id_bgn) != '')
			$this->db->where('id_bgn', $id_bgn);
		if ($id != null || trim($id) != '')
			$this->db->where('id', $id);
		$query = $this->db->delete('tmdatabangunan');
		return $query;
	}

	public function getLihatRetribusi($id)
	{
		$this->db->select('a.id as id_pemilik,c.lama_proses,b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_kabkot_bgn,b.id_kec_bgn,b.id_jenis_permohonan,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,almt_bgn,fungsi_bg,luas_bgn,tinggi_bgn,id_kabkot_bgn,b.status,b.id_fungsi_bg,b.jml_lantai,e.nama_kecamatan,h.nama_kabkota,i.nama_provinsi as nama_prov_pemilik,no_hp,email,no_ktp,luas_basement,lapis_basement,nm_bgn,b.id_fungsi_bg,e.nama_kecamatan,a.id_kecamatan,a.id_provinsi,a.id_kabkota,h.nama_kabkota,a.no_hp,b.id_prov_bgn,g.nama_kecamatan as nama_kec_bg,j.nama_kabkota as nama_kabkota_bg,k.nama_provinsi as nama_provinsi_bg,b.tgl_pernyataan,b.luas_bgn,b.tinggi_bgn,b.jml_lantai');
		$this->db->from('tmdatapemilik a');
		$this->db->where('a.id', $id);
		$this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_imb_permohonan d', 'd.id_jenis_permohonan = b.id_jenis_permohonan', 'left');
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

	public function getKegiatan()
	{
		return $this->db->get('tr_kegiatan');
	}

	public function getShst($id_kabkot, $thn)
	{
		return $this->db->where('id_kabkot', $id_kabkot)
			->where('thn_berlaku', $thn)
			->get('tr_shst');
	}

	public function insertDataPembayaran($data)
	{
		return $this->db->insert('tmdatapembayaran', $data);
	}

	function RemoveTeknisTanah($id_detail)
	{
		$this->db->delete('tmpersyaratankonsultasi', array('id_detail' => $id_detail));
	}

	function RemoveTeknisDokumen($id_detail)
	{
		$this->db->delete('tmpersyaratankonsultasi', array('id_detail' => $id_detail));
	}

	//Begin Retribusi 
	public function getRetribusi($id)
	{
		$this->db->select('a.id,b.nilai_retribusi_keseluruhan,c.tgl_penagihan,c.no_penagihan,c.dir_file_penagihan,d.bukti_pembayaran');
		$this->db->from('tmdatapemilik a');
		$this->db->where('a.id', $id);
		$this->db->join('tm_retribusi b', 'a.id = b.id', 'LEFT');
		$this->db->join('tmbayar c', 'a.id = c.id_pbgnya', 'LEFT');
		$this->db->join('tmdatapembayaran d', 'a.id=d.id', 'LEFT');
		$this->db->order_by('a.id', 'asc');
		$query = $this->db->get();
		return $query;
	}
	//End Retribusi


	public function cekStep($id)
	{
		$this->db->select('data_step');
		$this->db->where('id', $id);
		return $this->db->get('tmdatabangunan');
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


	public function getSyaratList($per = NULL, $kls = NULL)
	{
		$this->db->distinct();
		$this->db->select('a.id_persyaratan,a.id,a.id as id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,b.id_detail,b.id_syarat,
		c.nm_dokumen,c.keterangan,e.dir_file');
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

	public function updateStatsPbg($id, $data)
	{
		return $this->db->where('id', $id)->update('tmdatabangunan', $data);
	}

	function get_permohonan_list($id)
	{
		$this->db->select('a.id as id_pemilik,a.no_ktp,a.email,a.id_kecamatan,a.id_provinsi,a.id_kabkota,a.alamat,a.no_hp,a.nm_pemilik,
							b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_kabkot_bgn,b.id_kec_bgn,b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,
							b.status,b.jml_lantai,b.nm_bgn,b.id_fungsi_bg,b.tipeA,b.luasA,b.lantaiA,b.tinggiA,b.jumlahA,
							c.nm_konsultasi,
							f.fungsi_bg,
							e.nama_kecamatan,h.nama_kabkota,
							g.nama_kecamatan as nama_kec_bg,j.nama_kabkota as nama_kabkota_bg,k.nama_provinsi nama_provinsi_bg,b.tgl_pernyataan,
							b.luas_bgn,b.tinggi_bgn,b.jml_lantai,i.nama_provinsi');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 5 ");
		$this->db->where('b.id', $id);
		$this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_imb_permohonan d', 'd.id_jenis_permohonan = b.id_jenis_permohonan', 'left');
		$this->db->join('tr_kecamatan e', 'e.id_kecamatan = a.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot h', 'h.id_kabkot = a.id_kabkota', 'LEFT');
		$this->db->join('tr_provinsi i', 'i.id_provinsi = a.id_provinsi', 'LEFT');
		$this->db->join('tr_fungsi_bg f', 'f.id_fungsi_bg = b.id_fungsi_bg', 'left');
		$this->db->join('tr_kecamatan g', 'g.id_kecamatan = b.id_kec_bgn', 'LEFT');
		$this->db->join('tr_kabkot j', 'j.id_kabkot = b.id_kabkot_bgn', 'LEFT');
		$this->db->join('tr_provinsi k', 'k.id_provinsi = b.id_prov_bgn', 'LEFT');
		//$this->db->join('tm_pbg_kolektif l', 'l.id = a.id', 'LEFT');
		$this->db->order_by('b.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function getDataPemeriksaanKesesuaian($id, $id_pemilik)
	{
		return $this->db
			->select('kesesuaian,catatan,dir_file')
			->where('id_persyaratan_detail', $id)
			->where('id', $id_pemilik)
			->from('tmpersyaratankonsultasi')
			->order_by('id_detail', 'DESC')
			->get();
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
		/*$this->db->query("DELETE FROM tm_permohonan_bg_syarat WHERE id_permohonan = $id_permohonan");
		$this->db->query("DELETE FROM tm_imb_penjadwalan WHERE id_permohonan = $id_permohonan");
		$this->db->query("DELETE FROM tm_imb_penugasan WHERE id_permohonan = $id_permohonan");
		$this->db->query("DELETE FROM tm_imb_penyerahan WHERE id_permohonan = $id_permohonan");
		$this->db->query("DELETE FROM tm_permohonan_bg_syarat WHERE id_permohonan = $id_permohonan");*/

		$this->db->where('id', $id);
		return $query;
	}


	function getRowKonsultasi($id)
	{
		$this->db->select('a.id as id_pemilik,a.no_ktp,a.nm_pemilik,a.email,a.no_hp,a.id_kabkota,a.alamat,
        b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_kec_bgn,b.id_fungsi_bg,b.imb,b.tipeA,b.luasA,b.tinggiA,b.jumlahA,b.lantaiA,
        b.id_jenis_permohonan,b.no_konsultasi,b.almt_bgn,b.luas_bgn,b.tinggi_bgn,id_kabkot_bgn,b.luas_bgp,b.tinggi_bgp,
        b.status,b.jml_lantai,h.nama_kabkota,i.nama_provinsi as nama_prov_pemilik,b.nm_bgn,b.tgl_pernyataan,
        e.nama_kecamatan,a.id_kecamatan,a.id_provinsi,b.id_izin,b.imb,
        c.nm_konsultasi,
        f.fungsi_bg,
        g.nama_kecamatan as nama_kec_bg,j.nama_kabkota as nama_kabkota_bg,k.nama_provinsi as nama_provinsi_bg,a.id_kelurahan,a.jns_pemilik,b.id_kel_bgn,b.id_jns_bg,b.id_klasifikasi,m.klasifikasi_bg,l.*');
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
		$this->db->join('trparameterfungsi l', 'l.id_fungsi_bg = b.id_fungsi_bg', 'LEFT');
		$this->db->join('tr_klasifikasi_bg m', 'm.id_klasifikasi_bg = b.id_klasifikasi', 'LEFT');
		$this->db->order_by('b.status', 'asc');
		return $this->db->get();
	}

	public function getDataPendataanBG($select = "a.*,b.nama_bg,b.alamat_bg", $user_id = '')
	{
		$this->db->select($select, FALSE);
		if ($user_id != null || trim($user_id) != '')  $this->db->where('a.user_id', $user_id);
		$this->db->join('tm_p_umum_profile b', 'a.id = b.id_bg', 'LEFT');
		$this->db->order_by('a.id', 'asc');
		$query 	= $this->db->get('tm_pendataan_bg a');
		return $query;
	}
}
