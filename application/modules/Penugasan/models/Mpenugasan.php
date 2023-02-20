<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MPenugasan extends CI_Model
{
	public function  getListPenugasanDok($SQLcari = '')
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn,c.id_izin,c.id_klasifikasi');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 4 ");
		$this->db->where("c.status != 25 ");
		$this->db->where("c.status != 26 ");
		if($Dinas =='31'){
			$this->db->where('c.id_prov_bgn = 31');
			$this->db->where('c.jml_lantai > 8');
		}else if ($Dinas =='3101' || $Dinas =='3171' || $Dinas =='3172' || $Dinas =='3173' || $Dinas =='3174' || $Dinas =='3175'){
			$this->db->where('c.id_kabkot_bgn', $Dinas);
			$this->db->where('c.jml_lantai < 9');
		}else if($Dinas == '100') {
			$this->db->where('b.id_otorita', 1);
		}else{
			$this->db->where('c.id_kabkot_bgn', $Dinas);
		}
		if ($SQLcari != '') {
			!empty($SQLcari['id_fungsi_bg']) ? $this->db->where('c.id_fungsi_bg', $SQLcari['id_fungsi_bg']) : '';
			if (!empty($SQLcari['id_proses'])) {
				$SQLcari['id_proses'] == 1 ? $this->db->where('c.status <', 5) : $this->db->where('c.status >=', 5);
			}
			!empty($SQLcari['tanggalawal']) ? $this->db->where('c.tgl_pernyataan >=', date('Y-m-d', strtotime($SQLcari['tanggalawal']))) : '';
			!empty($SQLcari['tanggalakhir']) ? $this->db->where('c.tgl_pernyataan <=', date('Y-m-d', strtotime($SQLcari['tanggalakhir']))) : '';
		}
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function getPenugasanAll($dateOne, $dateTwo)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 4");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.tgl_pernyataan >=", $dateOne);
		$this->db->where("c.tgl_pernyataan <=", $dateTwo);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findFungsi($fungsi_bg, $dateOne, $dateTwo)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 4 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.tgl_pernyataan >=", $dateOne);
		$this->db->where("c.tgl_pernyataan  <=", $dateTwo);
		$this->db->where("c.id_fungsi_bg", $fungsi_bg);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findFungsiWithoutDate($fungsi_bg)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 4 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.id_fungsi_bg", $fungsi_bg);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findProses($proses, $dateOne, $dateTwo)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 4 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.tgl_pernyataan >=", $dateOne);
		$this->db->where("c.tgl_pernyataan  <=", $dateTwo);
		$this->db->where("c.status", $proses);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findProsesWithoutDate($proses)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 4 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.status", $proses);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}


	public function findAll($fungsi_bg, $proses, $dateOne, $dateTwo)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 4 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.tgl_pernyataan >=", $dateOne);
		$this->db->where("c.tgl_pernyataan  <=", $dateTwo);
		$this->db->where("c.status", $proses);
		$this->db->where("c.id_fungsi_bg", $fungsi_bg);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findAllWithoutDate($fungsi_bg, $proses)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 4 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.status", $proses);
		$this->db->where("c.id_fungsi_bg", $fungsi_bg);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function getDataInspeksi()
	{
		$dev = $this->session->userdata('loc_role_id');
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.id,a.nm_pemilik,b.nm_konsultasi,c.status,c.tgl_pernyataan,f.status_dinas,c.no_konsultasi,
        c.almt_bgn,c.id_kabkot_bgn,d.id_stsjadwal,e.nama_stsjadwal,c.data_step,g.no_izin_pbg');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->join('tm_status_konsultasi d', 'd.id = a.id', 'left');
        $this->db->join('tr_jadwal e', 'e.id_stsjadwal = d.id_stsjadwal', 'left');
        $this->db->join('status_sistem f', 'f.id = c.status', 'left');
		$this->db->join('tmdatapbg g', 'g.id = a.id', 'left');
        $this->db->distinct();
        $this->db->where("c.status >=", 17);
		$this->db->where("c.status !=", 25);
		$this->db->where("c.status !=", 26);
		$this->db->where("c.id_jenis_permohonan !=", 14);
        if ($dev != 1)  $this->db->where('id_kabkot_bgn', $Dinas);
        $this->db->order_by('c.status', 'asc');
        return $this->db->get();
	}

	function getdetailPenugasan($id)
	{
		$this->db->select('a.id as id_pemilik,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,almt_bgn,fungsi_bg,luas_bgn,tinggi_bgn,id_kabkot_bgn,b.status,b.id_fungsi_bg,b.jml_lantai,nama_kecamatan,h.nama_kabkota,nama_provinsi,no_hp,email,no_ktp,luas_basement,lapis_basement,nm_bgn');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 3 ");
		$this->db->where('a.id', $id);
		$this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_imb_permohonan d', 'd.id_jenis_permohonan = b.id_jenis_permohonan', 'left');
		$this->db->join('tr_kecamatan e', 'e.id_kecamatan = a.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot h', 'h.id_kabkot = a.id_kabkota', 'LEFT');
		$this->db->join('tr_provinsi i', 'i.id_provinsi = a.id_provinsi', 'LEFT');
		$this->db->join('tr_fungsi_bg f', 'f.id_fungsi_bg = b.id_fungsi_bg', 'left');
		$this->db->order_by('b.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function getDetailPengawas($id)
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

	public function getTimTeknis($id, $year = NULL)
	{
		return $this->db
			->join('tm_personal a', 'a.id_personal = c.id_personal', 'left')
			->join('tm_sk_pengaturan b', 'b.id_sk = c.id_sk', 'left')
			->join('tr_provinsi', 'tr_provinsi.id_provinsi = a.id_provinsi', 'left')
			->join('tr_kabkot', 'tr_kabkot.id_kabkot = a.id_kabkot', 'left')
			->join('tm_sertifikasi', 'tm_sertifikasi.id_personal = a.id_personal', 'left')
			->join('tm_riwpendidikan', 'tm_riwpendidikan.id_personal = a.id_personal', 'left')
			->join('tr_unsur', 'tr_unsur.id_unsur = tm_sertifikasi.id_unsur', 'left')
			->join('tr_unsur_ahli', 'tr_unsur_ahli.id_unsur_ahli = tm_sertifikasi.id_unsur_ahli', 'left')
			->join('tr_unsur_keahlian', 'tr_unsur_keahlian.id_unsur_keahlian = tm_sertifikasi.id_unsur_keahlian', 'left')
			->get_where('tm_sk_pdetail c', array(
				'a.id_kabkot' => $id,
				'b.expired_sk' => $year,
				'a.stat' => 1,
			));
	}

	public function getTimTeknis34($id, $year = NULL)
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

	public function getTimTabg($id, $year = NULL)
	{
		return $this->db
			->join('tm_personal j', 'j.id_personal = a.id_personal', 'left')
			->join('tm_sktabg b', 'b.id_skta = a.id_skta', 'left')
			->join('tr_provinsi c', 'c.id_provinsi = j.id_provinsi', 'left')
			->join('tr_kabkot d', 'd.id_kabkot = j.id_kabkot', 'left')
			->join('tm_sertifikasi e', 'e.id_personal = j.id_personal', 'left')
			->join('tm_riwpendidikan f', 'f.id_personal = j.id_personal', 'left')
			->join('tr_unsur g', 'g.id_unsur = e.id_unsur', 'left')
			->join('tr_unsur_ahli h', 'h.id_unsur_ahli = e.id_unsur_ahli', 'left')
			->join('tr_unsur_keahlian i', 'i.id_unsur_keahlian = e.id_unsur_keahlian', 'left')
			->get_where('tm_sktabgdetail a', array(
				'b.id_kabkot' => $id,
				'b.expired_skta' => $year,
				'j.stat' => 0,
			));
	}

	function cekPersonalPenugasan($id, $arr)
	{
		return $this->db
			->where('id_pemilik', $id)
			->where_in('id_personal', $arr)
			->get('tm_penugasan_pbg');
	}

	function insertBatchPersonil($data)
	{
		return $this->db->insert_batch('tm_penugasan_pbg', $data);
	}

	function getByIdPtugas($id)
	{
		return $this->db->join('tm_personal', 'tm_penugasan_pbg.id_personal = tm_personal.id_personal')
			->join('tm_sertifikasi', 'tm_sertifikasi.id_personal = tm_personal.id_personal', 'left')
			->join('tm_riwpendidikan', 'tm_riwpendidikan.id_personal = tm_personal.id_personal', 'left')
			->join('tr_unsur', 'tr_unsur.id_unsur = tm_sertifikasi.id_unsur', 'left')
			->join('tr_unsur_ahli', 'tr_unsur_ahli.id_unsur_ahli = tm_sertifikasi.id_unsur_ahli', 'left')
			->join('tr_unsur_keahlian', 'tr_unsur_keahlian.id_unsur_keahlian = tm_sertifikasi.id_unsur_keahlian', 'left')
			->get_where('tm_penugasan_pbg', array('id_pemilik' => $id));
	}

	function updateStats($data, $id)
	{
		return $this->db->where('id', $id)->update('tmdatabangunan', $data);
	}

	function cekTotalPetugas($id_pemilik)
	{
		return $this->db->where('id_pemilik', $id_pemilik)->get('tm_penugasan_pbg');
	}

	//Begin Tarik Data
	public function getByTanah($id)
	{
		return $this->db->where('id', $id)->get('tmdatatanah');
		$this->db->order_by('a.id_detail', 'asc');
	}
	//End Tarik Data

	// model penugasan inspeksi

	public function insertDataPenugasanInspeksi($data)
	{
		return $this->db->insert_batch('tm_penugasan_inspeksi', $data);
	}

	public function getTimTPA($id, $year = NULL)
	{
		return $this->db
			->join('tm_tpa j', 'j.id = a.id_tpanya', 'left')
			->join('tm_sk_pengaturan b', 'b.id_sk = a.id_sk', 'left')
			->get_where('tm_sk_tdetail a', array(
				'b.id_kabkot' => $id,
				'b.expired_sk' => $year,
			));
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

	function cekPersonalPenugasanInspeksi($id, $arr)
	{
		return $this->db
			->where('id', $id)
			->where_in('id_personal', $arr)
			->get('tm_penugasan_inspeksi');
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
			->join('tm_sk_timpenilik b', 'b.id_skp = a.id_skp', 'left')
			->join('tr_provinsi c', 'c.id_provinsi = j.id_provinsi', 'left')
			->join('tr_kabkot d', 'd.id_kabkot = j.id_kabkot', 'left')
			->join('tm_sertifikasi e', 'e.id_personal = j.id_personal', 'left')
			->join('tm_riwpendidikan f', 'f.id_personal = j.id_personal', 'left')
			->join('tr_unsur g', 'g.id_unsur = e.id_unsur', 'left')
			->join('tr_unsur_ahli h', 'h.id_unsur_ahli = e.id_unsur_ahli', 'left')
			->join('tr_unsur_keahlian i', 'i.id_unsur_keahlian = e.id_unsur_keahlian', 'left')
			->get_where('tm_skpdetail a', array(
				'b.id_kabkot' => $id,
				'b.expired_skp' => $year,
			));
	}
	// end penugasan inspeksi
	function getEmailPemohon($id=null)
	{
		$sql = "SELECT a.id,a.email,b.no_konsultasi ";
		$sql .= " FROM tmdatapemilik a 
					left join tmdatabangunan b on (a.id = b.id) 
					WHERE (1=1) AND a.email != '' ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function getEmailTpt($id=null)
	{
		$sql = "SELECT a.id_personal,b.email,b.nama_personal ";
		$sql .= " FROM tm_penugasan_pbg a 
					left join tm_personal b on (a.id_personal = b.id_personal) 
					WHERE (1=1) AND b.email != '' ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_pemilik = '$id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function getEmailTpa($id=null)
	{
		$sql = "SELECT a.id,b.email,b.nm_tpa ";
		$sql .= " FROM tm_penugasan_tpa a 
					left join tm_tpa b on (a.id = b.id) 
					WHERE (1=1) AND b.email != '' ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_pemilik = '$id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}


	public function cekDataBangunan($id)
	{
		$this->db->select('a.id as id_pemilik,c.lama_proses,b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_izin,b.id_klasifikasi,
		b.id_kabkot_bgn,b.id_kec_bgn,b.id_jenis_permohonan,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,
		b.almt_bgn,fungsi_bg,b.tipeA,b.luasA,b.lantaiA,b.tinggiA,b.jumlahA,b.luas_bgp,b.tinggi_bgp,
		b.status,b.id_fungsi_bg,i.nama_provinsi as nama_prov_pemilik,
		email,no_ktp,nm_bgn,e.nama_kecamatan,a.id_kecamatan,a.id_provinsi,
		a.id_kabkota,h.nama_kabkota,a.no_hp,g.nama_kecamatan as nama_kec_bg,j.nama_kabkota as nama_kabkota_bg,
		k.nama_provinsi as nama_provinsi_bg,b.tgl_pernyataan,b.luas_bgn,b.tinggi_bgn,b.jml_lantai,m.jns_prasarana,
		n.nama_kelurahan as nama_kel_bg');
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
		$this->db->join('tr_kelurahan n', 'n.id_kelurahan = b.id_kel_bgn', 'LEFT');
		$this->db->order_by('b.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function getTimTPT($id, $year = NULL)
	{
		return $this->db
			->join('tm_personal', 'tm_personal.id_personal = tm_sk_pdetail.id_personal', 'left')
			->join('tm_sk_pengaturan', 'tm_sk_pengaturan.id_sk = tm_sk_pdetail.id_sk', 'left')
			->join('tr_provinsi', 'tr_provinsi.id_provinsi = tm_personal.id_provinsi', 'left')
			->join('tr_kabkot', 'tr_kabkot.id_kabkot = tm_personal.id_kabkot', 'left')
			->join('tm_sertifikasi', 'tm_sertifikasi.id_personal = tm_personal.id_personal', 'left')
			->join('tm_riwpendidikan', 'tm_riwpendidikan.id_personal = tm_personal.id_personal', 'left')
			->join('tr_unsur', 'tr_unsur.id_unsur = tm_sertifikasi.id_unsur', 'left')
			->join('tr_unsur_ahli', 'tr_unsur_ahli.id_unsur_ahli = tm_sertifikasi.id_unsur_ahli', 'left')
			->join('tr_unsur_keahlian', 'tr_unsur_keahlian.id_unsur_keahlian = tm_sertifikasi.id_unsur_keahlian', 'left')
			->get_where('tm_sk_pdetail', array(
				'tm_sk_pengaturan.id_kabkot' => $id,
				'tm_sk_pengaturan.expired_sk' => $year,
				'tm_personal.stat' => 1,
			));
	}
}
