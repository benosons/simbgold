<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MDinasTeknis extends CI_Model
{
	//Begin Dinas Teknis
	public function  getListVerifikator($SQLcari = '')
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,a.nm_pemilik,b.status,b.no_konsultasi,b.almt_bgn,c.nm_konsultasi,g.fungsi_bg,b.tgl_pernyataan');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status between '1' AND '2' ");
		$this->db->where("b.id_fungsi_bg != 5");
		$this->db->where("b.id_jenis_permohonan != 9");
		$this->db->where("b.id_jenis_permohonan != 8");
		
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

	public function  getListVerifikatorBertahap($SQLcari = '')
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,a.nm_pemilik,b.status,b.no_konsultasi,b.almt_bgn,b.tahap_pbg,c.nm_konsultasi,g.fungsi_bg,b.tgl_pernyataan');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 1 ");
		$this->db->where("b.pernyataan = 1 ");
		$this->db->where("b.id_fungsi_bg != 5");
		$this->db->where("b.id_jenis_permohonan = 8");
		if($Dinas =='31'){
			$this->db->where('b.id_prov_bgn = 31');
			$this->db->where('b.jml_lantai > 8');
		}else if ($Dinas =='3101' || $Dinas =='3171' || $Dinas =='3172' || $Dinas =='3173' || $Dinas =='3174' || $Dinas =='3175'){
			$this->db->where('b.id_kabkot_bgn', $Dinas);
			$this->db->where('b.jml_lantai < 9');
		}else if($Dinas =='1000'){
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

	public function  getDataVerifikator($id)
	{
		$this->db->select('a.*,
		b.*,
		c.nm_konsultasi,
		d.nama_kecamatan,
		e.nama_kabkota,
		f.nama_provinsi,
		k.nama_kelurahan,
		g.nama_kecamatan as nm_kec_bgn,
		h.nama_kabkota as nm_kabkot_bgn,
		i.nama_provinsi as nm_prov_bgn, 
		j.nama_kelurahan as nm_kel_bgn,
		l.dir_file');
		$this->db->from('tmdatapemilik a');
		$this->db->where('a.id', $id);
		$this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_kecamatan d', 'a.id_kecamatan = d.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot e', 'a.id_kabkota = e.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi f', 'a.id_provinsi = f.id_provinsi', 'LEFT');
		$this->db->join('tr_kelurahan k', 'a.id_kelurahan = k.id_kelurahan', 'LEFT');
		$this->db->join('tr_kecamatan g', 'b.id_kec_bgn = g.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot h', 'b.id_kabkot_bgn = h.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi i', 'b.id_prov_bgn = i.id_provinsi', 'LEFT');
		$this->db->join('tr_kelurahan j', 'b.id_kel_bgn = j.id_kelurahan', 'LEFT');
		$this->db->join('tr_prototype l', 'b.id_prototype = l.idp', 'LEFT');
		
		$query = $this->db->get();
		return $query;
	}
	
	public function  getDataVerifikatorOSS($id)
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

	public function getDataBangunan($id)
	{
		$this->db->select('a.id,b.*,c.nm_konsultasi,d.nama_kecamatan,e.nama_kabkota,f.nama_provinsi,g.nama_kelurahan');
		$this->db->from('tmdatapemilik a');
		$this->db->where('a.id', $id);
		$this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_kelurahan g', 'b.id_kel_bgn = g.id_kelurahan', 'LEFT');
		$this->db->join('tr_kecamatan d', 'b.id_kec_bgn = d.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot e', 'b.id_kabkot_bgn = e.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi f', 'b.id_prov_bgn = f.id_provinsi', 'LEFT');
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
		$query 	= $this->db->get('tmdatatanah a');
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
		$query 	= $this->db->get('tmpersyaratankonsultasi a');
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


	public function getMasterAdministrasi($select = "a.*", $id_jenis_permohonan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
		$this->db->where('a.id_jenis_persyaratan', '1');
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		$this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}

	public function getMasterTeknis($select = "a.*", $id_jenis_permohonan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $this->db->where('a.id', $id_jenis_permohonan);
		$this->db->where('a.id_jenis_persyaratan', '2');
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		$this->db->join('tr_dokumen_syarat c', 'b.id_syarat = c.id', 'LEFT');
		$query 	= $this->db->get('tr_konsultasi_syarat a');
		return $query;
	}

	public function getDataJnsKonsultasi($select = "a.*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		$query 	= $this->db->get('tmdatabangunan a');
		return $query;
	}

	public function getHis($select = "a.*", $id = '')
	{
		$this->db->select($select, FALSE);
		$this->db->join('simbg_status b', 'a.status = b.kode_status', 'LEFT');
		$this->db->join('tm_user c', 'a.user_id = c.id', 'LEFT');
		if ($id != null || trim($id) != '')  $this->db->where('a.id_pemilik', $id);
		$query 	= $this->db->get('th_data_konsultasi a');
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
		$sql = "SELECT a.id,a.id_jenis_permohonan
		FROM tmdatabangunan a
		WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function getSyaratList($per = null, $kls = null)
	{
		$sql = "SELECT a.id_persyaratan,a.id,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,
				b.id_detail,b.id_syarat, c.nm_dokumen,c.keterangan 
				FROM tr_konsultasi_syarat a 
				LEFT JOIN tr_pbg_syarat_detail b ON(a.id_persyaratan=b.id_persyaratan) 
				LEFT JOIN tr_dokumen_syarat c ON(b.id_syarat=c.id) 
				WHERE (1=1)
		";
		if ($per != null || trim($per) != '')  $sql .= " AND a.id = '$per' ";
		if ($kls != null || trim($kls) != '')  $sql .= " AND a.id_detail_jenis_persyaratan = '$kls' ";
		$sql .= " Group by b.id_detail ORDER BY a.id, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat ASC ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function getSyarat($id = null, $per = null)
	{
		$sql = "SELECT a.*
				FROM tmpersyaratankonsultasi a
				WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_persyaratan_detail = '$id' ";
		if ($per != null || trim($per) != '')  $sql .= " AND a.id = '$per' ";
		$sql .= " ORDER BY a.id_persyaratan ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function getTanahVerifikasi($id)
	{
		return $this->db->get_where('tmdatatanah ', array('id' => $id));
	}
	function getHistoryVerifikasi($id)
	{
		return $this->db->get_where('th_data_konsultasi ', array('id' => $id));
	}
	//End Dinas Teknis Tarik Persyaratan
}
