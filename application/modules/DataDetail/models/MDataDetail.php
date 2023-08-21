<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class MDataDetail extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	public function getDetailPemilik($id=null)
	{
		$sql = "Select a.id,a.nm_pemilik,a.glr_depan,a.glr_belakang,a.no_ktp,a.email,a.no_hp,a.alamat,b.nama_kecamatan,c.nama_kabkota,d.nama_provinsi
			From tmdatapemilik a
			left join tr_kecamatan b on (a.id_kecamatan=b.id_kecamatan)
			left join tr_kabkot c On (a.id_kabkota=c.id_kabkot)
			left join tr_provinsi d On (a.id_provinsi=d.id_provinsi)
			WHERE (1=1)";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		
		//echo $sql;
		$hasil  = $this->db->query($sql);
		if (isset($counting) && $counting == 1)	{
			$myres= $hasil->result_array();
			if (count($myres) > 0)
				return $myres[0]['total'];
			else
				return 0;
		} else {
			return $hasil ;
		}
	}

	public function getDataHistory($id)
	{
		return $this->db->where('id', $id)
			//->where('status', '3')
			->get('th_data_konsultasi');
	}
	
	public function getDetailBangunan($id=null)
	{
		$sql = "Select a.id,b.no_konsultasi,b.status,b.almt_bgn,b.luas_bgn,b.tinggi_bgn,b.jml_lantai,b.luas_bgp,b.tinggi_bgp,
			b.tipeA,b.luasA,b.lantaiA,b.tinggiA,b.jumlahA,b.id_jenis_permohonan,
			c.nama_kecamatan,d.nama_kabkota,e.nama_provinsi,f.nm_konsultasi,g.dir_file_konsultasi,h.file_retribusi
			From tmdatapemilik a
			Left join tmdatabangunan b On (b.id=a.id)
			left join tr_kecamatan c On (b.id_kec_bgn=c.id_kecamatan)
			left join tr_kabkot d On (b.id_kabkot_bgn=d.id_kabkot)
			left join tr_provinsi e On (b.id_prov_bgn=e.id_provinsi)
			left join tr_konsultasi f On (b.id_jenis_permohonan=f.id)
			left join tmdatajadwal g On (a.id=g.id)
			left join tm_retribusi h On (a.id=h.id)
			WHERE (1=1)";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		
		//echo $sql;
		$hasil  = $this->db->query($sql);
		if (isset($counting) && $counting == 1)	{
			$myres= $hasil->result_array();
			if (count($myres) > 0)
				return $myres[0]['total'];
			else
				return 0;
		} else {
			return $hasil ;
		}
	}
	
	public function getDetailTanah($id=null,$id_detail=null)
	{
		$sql = "SELECT a.*, b.jenis_dokumen, c.*, d.*, e.*   
				FROM tmdatatanah a
				left join tr_dokumen b on (a.id_dokumen = b.id_dokumen)
				left join tr_kecamatan c on (a.id_kecamatan = c.id_kecamatan)
				left join tr_kabkot d on (a.id_kabkot = d.id_kabkot)
				left join tr_provinsi e on (a.id_provinsi = e.id_provinsi)
					WHERE (1=1) ";

		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		if ($id_detail != null || trim($id_detail) != '')  $sql .= " AND a.id_detail = '$id_detail' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
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
		$sql .= "  ORDER BY a.id_jadwal asc limit 1";
		}
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function cekDataBangunan($id)
	{
		$this->db->select('a.id as id_pemilik,a.jns_pemilik,
		c.lama_proses,
		b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.luas_bgp,b.tinggi_bgp,b.id_klasifikasi,
		b.id_kabkot_bgn,b.id_kec_bgn,b.id_jenis_permohonan,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,
		b.almt_bgn,b.luas_bgn,b.tinggi_bgn,b.status,b.id_fungsi_bg,b.jml_lantai,
		e.nama_kecamatan,h.nama_kabkota,i.nama_provinsi as nama_prov_pemilik,a.email,a.no_ktp,
		b.nm_bgn,a.id_kecamatan,
		n.nama_kelurahan as nama_kel_bg,d.nama_kelurahan,
		a.id_provinsi,a.id_kabkota,a.no_hp,b.id_prov_bgn,g.nama_kecamatan as nama_kec_bg,n.nama_kelurahan as nm_kelurahan,
		j.nama_kabkota as nama_kabkota_bg,k.nama_provinsi as nama_provinsi_bg,b.tgl_pernyataan,m.jns_prasarana,
		l.id_klasifikasi_bg,l.klasifikasi_bg,b.tipeA,b.luasA,b.lantaiA,b.tinggiA,b.jumlahA,b.id_izin');
		$this->db->from('tmdatapemilik a');
		$this->db->where('b.id', $id);
		$this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_kelurahan d', 'd.id_kelurahan = a.id_kelurahan', 'LEFT');
		$this->db->join('tr_kecamatan e', 'e.id_kecamatan = a.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot h', 'h.id_kabkot = a.id_kabkota', 'LEFT');
		$this->db->join('tr_provinsi i', 'i.id_provinsi = a.id_provinsi', 'LEFT');
		$this->db->join('tr_fungsi_bg f', 'f.id_fungsi_bg = b.id_fungsi_bg', 'left');
		$this->db->join('tr_kelurahan n', 'n.id_kelurahan = b.id_kel_bgn', 'LEFT');
		$this->db->join('tr_kecamatan g', 'g.id_kecamatan = b.id_kec_bgn', 'LEFT');
		$this->db->join('tr_kabkot j', 'j.id_kabkot = b.id_kabkot_bgn', 'LEFT');
		$this->db->join('tr_provinsi k', 'k.id_provinsi = b.id_prov_bgn', 'LEFT');
		$this->db->join('tr_klasifikasi_bg l', 'l.id_klasifikasi_bg = c.klasifikasi_bg', 'LEFT');
		$this->db->join('tr_prasarana m', 'm.idp = b.id_prasarana_bg', 'LEFT');
		$this->db->order_by('b.status', 'asc');
		$query = $this->db->get();
		return $query;
	}


	public function getDataPrototipe($id)
    {
        return
            $this->db
            ->select('a.id,a.id_prototype,b.idp,b.dir_file')
            ->from('tmdatabangunan a')
            ->join('tr_prototype b', 'b.idp = a.id_prototype', 'left')
            ->where('a.id', $id)
            ->get();
    }

	
	// retribusi

	public function cekRetribusi($id)
	{
		return $this->db->where('id', $id)
			->order_by('id_retribusi', 'desc')
			->join('tr_kegiatan', 'tr_kegiatan.id_kegiatan = tm_retribusi.id_kegiatan', 'left')
			->get('tm_retribusi');
	}

	public function getShst($id_kabkot, $thn)
	{
		return $this->db->where('id_kabkot', $id_kabkot)
			->where('thn_berlaku', $thn)
			->get('tr_shst');
	}

	public function getPrasarana($id)
	{
		return $this->db->where('id', $id)->get('tm_prasaranaretribusi');
	}

	// data detail penugasan

	public function getTimTeknis($id, $year = NULL)
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

	function getByIdPtugasPenilik($id)
	{
		return $this->db->join('tm_personal', 'tm_penugasan_inspeksi.id_personal = tm_personal.id_personal')
			->join('tm_sertifikasi', 'tm_sertifikasi.id_personal = tm_personal.id_personal', 'left')
			->join('tm_riwpendidikan', 'tm_riwpendidikan.id_personal = tm_personal.id_personal', 'left')
			->join('tr_unsur', 'tr_unsur.id_unsur = tm_sertifikasi.id_unsur', 'left')
			->join('tr_unsur_ahli', 'tr_unsur_ahli.id_unsur_ahli = tm_sertifikasi.id_unsur_ahli', 'left')
			->join('tr_unsur_keahlian', 'tr_unsur_keahlian.id_unsur_keahlian = tm_sertifikasi.id_unsur_keahlian', 'left')
			->get_where('tm_penugasan_inspeksi', array('id' => $id));
	}
	
	public function getByIdPtugasTPA($id)
	{
		return $this->db->join('tm_tpa', 'tm_tpa.id = tm_penugasan_tpa.id')
		->get_where('tm_penugasan_tpa', array('id_pemilik' => $id));
	}
	// penjadwalan
	public function getPenjadwalanById($id)
    {
        return $this->db->get_where('tmdatajadwal', array('id' => $id));
    }


	public function getTimTPA($id, $year = NULL)
	{
		return $this->db
			->join('tm_tpa j', 'j.id = a.id_tpanya', 'left')
			->join('tm_sk_pengaturan b', 'b.id_sk = a.id_sk', 'left')
			->get_where('tm_sk_tdetail a', array(
				'b.id_kabkot' => $id,
			));
	}

	public function getDataIMB($id)
	{
		return $this->db->select('
		a.nama_pemohon,
		a.id_permohonan,
		a.id_fungsi_bg,
		a.id_jenis_permohonan,
		a.id_kabkot_bg,
		a.alamat_pemohon,
		a.alamat_bg,
		a.nomor_registrasi,
		a.id_kec_bg,
		a.id_provinsi_bg,
		d.nama_kabkota as kabkot_bg,
		e.nama_kabkota as kabkot_pemohon,
		f.nama_kecamatan as kecamatan_bg,
		g.nama_kecamatan as kecamatan_pemohon,
		h.nama_provinsi as provinsi_bg,
		i.nama_provinsi as provinsi_pemohon,
		b.nama_permohonan,
		c.fungsi_bg,
		a.luas_bg,
		a.tinggi_bg,
		a.lantai_bg,
		a.no_tlp,
		a.email,
		a.no_ktp,
		a.id_jenis_usaha,
		a.nama_bangunan,
		j.klasifikasi_bg,
		a.luas_basement,
		a.lapis_basement,
		')->from('tm_imb_permohonan a')
			->where('a.id_permohonan', $id)
			->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan')
			->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg')
			->join('tr_kabkot d', 'a.id_kabkot_bg = d.id_kabkot', 'LEFT')
			->join('tr_kabkot e', 'a.id_kabkot = e.id_kabkot', 'LEFT')
			->join('tr_kecamatan f', 'a.id_kec_bg = f.id_kecamatan', 'LEFT')
			->join('tr_kecamatan g', 'a.id_kecamatan = g.id_kecamatan', 'LEFT')
			->join('tr_provinsi h', 'a.id_provinsi = h.id_provinsi', 'LEFT')
			->join('tr_provinsi i', 'a.id_provinsi_bg = h.id_provinsi', 'LEFT')
			->join('tr_klasifikasi_bg j', 'a.id_klasifikasi_bg = j.id_klasifikasi_bg', 'LEFT')
			->order_by('a.status_progress', 'asc')
			->get();
	}

	public function getDataTanahIMB($id)
	{
		return $this->db->select('
		a.id_permohonan,
		a.id_dokumen,
		a.no_dok,
		a.tanggal_dok,
		a.atas_nama_dok,
		a.luas_tanah,
		a.dir_file,
		a.dir_file_phat,
		b.jenis_dokumen
		')
			->from('tm_imb_tanah a')
			->join('tr_dokumen b', 'b.id_dokumen=a.id_dokumen', 'left')
			->where('a.id_permohonan', $id)
			->get();
	}

	function get_syarat_list($per = null, $kls = null, $id_jenis_usaha = null, $luas_bg = null, $status = null)
	{
		$sql = "SELECT a.id_persyaratan,a.id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,
				b.id_persyaratan_detail,b.id_syarat,c.nama_syarat,d.status_syarat,d.luas_bg
				FROM tr_imb_persyaratan a 
					LEFT JOIN tr_imb_persyaratan_detail b ON(a.id_persyaratan=b.id_persyaratan)
					LEFT JOIN tr_imb_syarat c ON(b.id_syarat=c.id_syarat)
					LEFT JOIN tm_imb_permohonan d ON(a.id_jenis_permohonan=d.id_jenis_permohonan)	
				WHERE (1=1)
				";

		if ($per != null || trim($per) != '')  $sql .= " AND a.id_jenis_permohonan = '$per' ";
		if ($kls != null || trim($kls) != '')  $sql .= " AND a.id_jenis_persyaratan = '$kls' ";
		if ($id_jenis_usaha == 1 || trim($id_jenis_usaha) == '1')  $sql .= " AND (b.id_syarat != '3' AND b.id_syarat != '4')";
		if ($luas_bg != null || trim($luas_bg) != '') {
			if ($luas_bg <= 5000) {
				$sql .= " AND (b.id_syarat != '44' AND b.id_syarat != '43') ";
			} else if ($luas_bg > 5000 && $luas_bg <= 10000) {
				$sql .= " AND (b.id_syarat != '43' AND b.id_syarat != '46') ";
			} else if ($luas_bg > 10000) {
				$sql .= " AND (b.id_syarat != '44' AND b.id_syarat != '46') ";
			}
		}
		$sql .= " Group by b.id_persyaratan_detail ORDER BY a.id_jenis_permohonan, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat ASC ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function get_syarat($id = null, $per = null, $status = null)
	{
		$sql = "SELECT a.*
				FROM tm_permohonan_bg_syarat a
				WHERE (1=1) ";

		if ($id != null || trim($id) != '')  $sql .= " AND a.id_persyaratan_detail = '$id' ";
		if ($per != null || trim($per) != '')  $sql .= " AND a.id_permohonan = '$per' ";
		if ($status != null || trim($status) != '')  $sql .= " AND a.status = '$status' ";
		$sql .= " ORDER BY a.id_persyaratan ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}


	public function getSyaratList($per = NULL, $kls = NULL)
	{
		$this->db->distinct();
		$this->db->select('a.id_persyaratan,a.id,a.id as id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,b.id_detail,b.id_syarat,c.nm_dokumen,c.keterangan,e.dir_file');
		$this->db->from('tr_konsultasi_syarat a');
		$this->db->join('tr_pbg_syarat_detail b', 'b.id_persyaratan = a.id_persyaratan', 'left');
		$this->db->join('tr_dokumen_syarat c', 'c.id = b.id_syarat', 'left');
		$this->db->join('tr_protipe e', 'e.idp = e.idp', 'left');
		if ($per != null || trim($per) != '')  $this->db->where('a.id', $per);
		if ($kls != null || trim($kls) != '')  $this->db->where('a.id_detail_jenis_persyaratan', $kls);
		$this->db->group_by('b.id_detail');
		$this->db->order_by('a.id, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat', 'ASC');
		return $this->db->get();
	}

	function getSyarat($id = null, $per = null, $status = null)
	{
		$sql = "SELECT a.*
				FROM tmpersyaratankonsultasi a
				WHERE (1=1) ";

		if ($id != null || trim($id) != '')  $sql .= " AND a.id_persyaratan_detail = '$id' ";
		if ($per != null || trim($per) != '')  $sql .= " AND a.id = '$per' ";
		if ($status != null || trim($status) != '')  $sql .= " AND a.status = '$status' ";
		$sql .= " ORDER BY a.id_persyaratan ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function getDataTanahPbg($id)
	{
		return $this->db->where('id', $id)
			->join('tr_dokumen', 'tr_dokumen.id_dokumen = tmdatatanah.id_dokumen', 'left')
			->get('tmdatatanah');
	}

	public function getDataPemeriksaanKesesuaian($id,$id_pemilik)
    {
        return $this->db
            ->select('kesesuaian,catatan')
            ->where('id_persyaratan_detail', $id)
            ->where('id', $id_pemilik)
            ->from('tmpersyaratankonsultasi')
            ->order_by('id_detail', 'DESC')
            ->get();
    }

	public function getDetailTPA($id)
	{
		return
			$this->db
			->where('b.id', $id)
			->join('tm_tpadokumen c', 'c.id = b.id', 'left')
			->get('tm_tpa b');
	}

	public function getDataBerkasPemeriksaan($id)
	{
		return $this->db->where('id', $id)->get('tmdatajadwal');
	}
}