<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdatavalidasi extends CI_Model{
	
	function getdatastatus($id=null,$cari=null)
	{
		$sql = "SELECT a.id,a.status
		FROM tmdatabangunan a
		WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	function getdatastatusRetribusi($SPPST=null,$cari=null)
	{
		$sql = "SELECT a.id,a.no_sppst,b.status
		FROM tmdatavalkadintek a
		LEFT JOIN tmdatabangunan b ON (a.id=b.id)
		WHERE (1=1) ";
		if ($SPPST != null || trim($SPPST) != '')  $sql .= " AND a.no_sppst = '$SPPST' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	function getdatapemilikDok($id='null')
	{
		$sql = "SELECT a.id,a.nm_pemilik,a.alamat,
				b.nama_kelurahan
				FROM tmdatapemilik a
				LEFT JOIN tr_kelurahan b ON(b.id_kelurahan = a.id_kelurahan)
				LEFT JOIN tr_kecamatan c ON(c.id_kecamatan = a.id_kecamatan)
				/*LEFT JOIN tm_imb_penerbitan b ON(a.id_permohonan = b.id_permohonan)
				LEFT JOIN tr_imb_permohonan d ON(a.id_jenis_permohonan = d.id_jenis_permohonan)
				LEFT JOIN tr_kecamatan s ON(a.id_kecamatan=s.id_kecamatan)
				LEFT JOIN tr_kabkot f ON(a.id_kabkot=f.id_kabkot)
				LEFT JOIN tr_provinsi g ON(a.id_provinsi=g.id_provinsi)
				LEFT JOIN tr_klasifikasi_bg k ON (d.id_klasifikasi_bg=k.id_klasifikasi_bg)
				LEFT JOIN tm_profile_dinas j ON (a.id_kabkot_bg=j.id_kabkot)
				LEFT JOIN tr_provinsi q ON(q.id_provinsi=a.id_provinsi_bg)
				LEFT JOIN tr_kabkot r ON(r.id_kabkot=a.id_kabkot_bg)
				LEFT JOIN tr_jenis_bg x ON(x.id_jenis_bg=a.id_jenis_bg)
				LEFT JOIN tm_imb_penjadwalan v ON(v.id_permohonan=a.id_permohonan)*/
				WHERE (a.id=$id)
			limit 1
			";
		$hasil = $this->db->query($sql);
		return $hasil->row_array();
	}

	function getdatabangunanDok($id='null')
	{
		$sql = "SELECT a.id,
				b.id_kabkot_bgn,b.id_izin,b.nm_bgn,b.almt_bgn,b.luas_bgn,b.id_fungsi_bg,b.jml_lantai,b.tipeA,b.luasA,b.tinggiA,b.lantaiA,
				c.nama_kelurahan,
				d.nama_kecamatan,
				e.nama_kabkota,
				f.nama_provinsi,
				g.nilai_retribusi_bangunan,g.nilai_retribusi_prasarana,g.nilai_retribusi_keseluruhan,
				h.no_izin_pbg,h.nm_kadis,h.nip_kadis,h.tgl_pbg,
				i.fungsi_bg,i.id_pemanfaatan_bg,
				j.no_sk_tk,j.date_sk_tk
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
			LEFT JOIN tmdataperda b ON (b.id_kabkot=a.id_kabkot_bgn)
			WHERE (a.id_pemilik=$id)
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

	public function datapemeriksaan($id='null')
	{
		$sql ="SELECT a.id, b.*,c.Jns_dok
				FROM tmdatabangunan a
				LEFT JOIN tmdatatanah b ON(b.id = a.id_pemilik)
				LEFT JOIN tr_doktanah c ON(c.id = b.id_dokumen)
				WHERE (a.id=$id)";
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	public function getDataKonsultasi($no_konsultasi=null) 
	{
		$sql = "SELECT a.id,a.nm_pemilik,
				b.almt_bgn,b.status,b.nm_bgn,b.id_fungsi_bg,b.luas_bgn,b.tipeA,b.tinggiA,b.luasA,b.jumlahA,b.lantaiA,
				c.nm_kadis,c.nip_kadis,c.no_sk_tk,c.date_sk_tk,c.dir_file_konsultasi,
				d.nama_kelurahan,
				e.nama_kecamatan,
				f.nama_kabkota,
				g.nama_provinsi,
				o.fungsi_bg,o.id_pemanfaatan_bg
       		FROM tmdatapemilik a
			LEFT JOIN tmdatabangunan b ON(b.id=a.id)
			LEFT JOIN tmdatajadwal c ON(c.id=a.id)
			LEFT JOIN tr_kelurahan d ON(d.id_kelurahan=b.id_kel_bgn)
			LEFT JOIN tr_kecamatan e ON(e.id_kecamatan=b.id_kec_bgn)
			LEFT JOIN tr_kabkot f ON(f.id_kabkot=b.id_kabkot_bgn)
			LEFT JOIN tr_provinsi g ON(g.id_provinsi=b.id_prov_bgn)
			LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=b.id_fungsi_bg)
			WHERE (1=1)";
		if ($no_konsultasi != null || trim($no_konsultasi) != '')  $sql .= " AND b.no_konsultasi = '$no_konsultasi' ";
		$hasil  = $this->db->query($sql);
		return $hasil ;
	}
	
	public function  getDataPemilikRetribusi($SPPST)
	{
		$this->db->select('a.no_sppst,b.*,d.*,e.*,f.*,k.nama_kelurahan');
		$this->db->from('tmdatavalkadintek a');
		$this->db->where('a.no_sppst', $SPPST);
		$this->db->join('tmdatapemilik b', 'a.id = b.id', 'LEFT');
		$this->db->join('tr_kecamatan d', 'b.id_kecamatan = d.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot e', 'b.id_kabkota = e.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi f', 'b.id_provinsi = f.id_provinsi', 'LEFT');
		$this->db->join('tr_kelurahan k', 'b.id_kelurahan = k.id_kelurahan', 'LEFT');
		$query = $this->db->get();
		return $query;
	}
	
	public function getDataBangunanRetribusi($id)
    {
        $this->db->select('b.*,
		c.nm_konsultasi,
		
        d.nama_kecamatan,
        e.nama_kabkota,
        f.nama_provinsi,
        g.*,
        h.fungsi_bg,
        i.*,
        j.*,
		k.*,
		l.nama_kelurahan,
		m.dir_file_penagihan,
		n.bukti_pembayaran
        ');
        $this->db->from('tmdatabangunan b');
        $this->db->where('b.id', $id);
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_kecamatan d', 'b.id_kec_bgn = d.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot e', 'b.id_kabkot_bgn = e.id_kabkot', 'LEFT');
        $this->db->join('tr_provinsi f', 'b.id_prov_bgn = f.id_provinsi', 'LEFT');
        $this->db->join('tm_retribusi g', 'g.id = b.id', 'LEFT');
        $this->db->join('tr_fungsi_bg h', 'h.id_fungsi_bg = b.id_fungsi_bg', 'left');
        $this->db->join('tr_klasifikasi_bg i', 'i.id_klasifikasi_bg = c.klasifikasi_bg', 'LEFT');
        $this->db->join('tr_kegiatan j', 'j.id_kegiatan = g.id_kegiatan', 'left');
		$this->db->join('tmdatapbg k', 'k.id = b.id', 'left');
		$this->db->join('tr_kelurahan l', 'b.id_kel_bgn = l.id_kelurahan', 'LEFT');
		$this->db->join('tmbayar m', 'm.id_pbgnya = b.id', 'LEFT');
		$this->db->join('tmdatapembayaran n', 'n.id = b.id', 'LEFT');
        $query = $this->db->get();
        return $query;
    }
	public function getTotalRetribusi($id)
	{
		return $this->db->where('id',$id)->get('tm_retribusi');
	}
	 public function getPrasarana($id)
	{
		return $this->db->where('id', $id)->get('tm_prasaranaretribusi');
	}
	
	
	public function  getDataPemilik($id)
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
		$this->db->select('b.*,c.nm_konsultasi,d.nama_kecamatan,e.nama_kabkota,f.nama_provinsi,g.nama_kelurahan,h.no_izin_pbg,i.dir_file');
		$this->db->from('tmdatabangunan b');
		$this->db->where('b.id', $id);
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_kecamatan d', 'b.id_kec_bgn = d.id_kecamatan', 'LEFT');
		$this->db->join('tr_kabkot e', 'b.id_kabkot_bgn = e.id_kabkot', 'LEFT');
		$this->db->join('tr_provinsi f', 'b.id_prov_bgn = f.id_provinsi', 'LEFT');
		$this->db->join('tr_kelurahan g', 'b.id_kel_bgn = g.id_kelurahan', 'LEFT');
		$this->db->join('tmdatapbg h', 'b.id_kel_bgn = g.id_kelurahan', 'LEFT');
		$this->db->join('tr_prototype i', 'b.id_prototype = i.idp', 'LEFT');
		$query = $this->db->get();
		return $query;
	}
	function getHistoryVerifikasi($id)
	{
		return $this->db->get_where('th_data_konsultasi ', array('id' => $id));
	}
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
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	public function getDataRetribusi($no_sppst=null) 
	{
		$sql = "SELECT a.id,a.nm_pemilik,
				b.almt_bgn,b.status,b.nm_bgn,b.id_fungsi_bg,b.luas_bgn,b.tipeA,b.tinggiA,b.luasA,b.jumlahA,b.lantaiA,
				c.nm_kadis,c.nip_kadis,c.no_sk_tk,c.date_sk_tk,c.dir_file_konsultasi,
				d.nama_kelurahan,
				e.nama_kecamatan,
				f.nama_kabkota,
				g.nama_provinsi,
				h.nilai_retribusi_bangunan, h.nilai_retribusi_prasarana,h.nilai_retribusi_keseluruhan,
				i.dir_file_penagihan,
				j.bukti_pembayaran,
				o.fungsi_bg,o.id_pemanfaatan_bg
       		FROM tmdatapemilik a
			LEFT JOIN tmdatabangunan b ON(b.id=a.id)
			LEFT JOIN tmdatajadwal c ON(c.id=a.id)
			LEFT JOIN tr_kelurahan d ON(d.id_kelurahan=b.id_kel_bgn)
			LEFT JOIN tr_kecamatan e ON(e.id_kecamatan=b.id_kec_bgn)
			LEFT JOIN tr_kabkot f ON(f.id_kabkot=b.id_kabkot_bgn)
			LEFT JOIN tr_provinsi g ON(g.id_provinsi=b.id_prov_bgn)
			LEFT JOIN tm_retribusi h On(h.id=a.id)
			LEFT JOIN tmbayar i On(i.id_pbgnya=a.id)
			LEFT JOIN tmdatapembayaran j On(j.id=a.id)
			LEFT JOIN tmdatavalkadintek k ON(k.id=b.id)
			LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=b.id_fungsi_bg)
			
			WHERE (1=1)";
		if ($no_sppst != null || trim($no_sppst) != '')  $sql .= " AND k.no_sppst = '$no_sppst' ";
		$hasil  = $this->db->query($sql);
		return $hasil ;
	}

}
