<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mauth extends CI_Model
{

	public function getLoginData($select = '*', $email, $password)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.username', $email);
		//$this->db->or_where('a.email', $email);
		$this->db->where('a.password', $password);
		$this->db->where('a.status', "1");
		$this->db->join('tm_role b', 'a.role_id = b.id');
		$this->db->join('tm_user_data c', 'a.id = c.user_id', 'LEFT');
		return $this->db->get('tm_user a');
		//echo $this->db->last_query(); die;
	}


	public function getLoginId($select = '*', $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id', $id);
		$this->db->where('a.status', "1");
		$this->db->join('tm_role b', 'a.role_id = b.id');
		$this->db->join('tm_user_data c', 'a.id = c.user_id', 'LEFT');
		$this->db->join('tm_profile_dinas d', 'a.id_kabkot = d.id_kabkot', 'LEFT');
		return $this->db->get('tm_user a');
		//echo $this->db->last_query(); die;
	}
	public function getLoginDataAkses($select = '*', $email, $password)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.username', $email);
		$this->db->where('a.password', $password);
		$this->db->where('a.status', "1");
		$this->db->join('tm_role b', 'a.role_id = b.id');
		return $this->db->get('tm_user a');
	} 
	public function getDataRetribusi($id_kabkot=null,$no_sppst=null) 
	{
		$sql = "SELECT a.id,a.no_sppst,
				b.almt_bgn,b.status,b.nm_bgn,b.id_fungsi_bg,b.luas_bgn,b.tipeA,b.tinggiA,b.luasA,b.jumlahA,b.lantaiA,
				k.nm_pemilik
       		FROM tmdatavalkadintek a
			LEFT JOIN tmdatabangunan b ON(b.id=a.id)
			LEFT JOIN tmdatapemilik k On(k.id=a.id)
			WHERE (1=1) ";
		if ($no_sppst != null || trim($no_sppst) != '')  $sql .= " AND a.no_sppst = '$no_sppst' ";
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND b.id_kabkot_bgn = '$id_kabkot' ";
		$hasil  = $this->db->query($sql);
		return $hasil ;
	}
	public function getDataRetribusiPemohon($user_id=null, $no_sppst=null) 
	{
		$sql = "SELECT a.id,a.no_sppst,
				b.almt_bgn,b.status,b.nm_bgn,b.id_fungsi_bg,b.luas_bgn,b.tipeA,b.tinggiA,b.luasA,b.jumlahA,b.lantaiA,
				d.nama_kelurahan,
				e.nama_kecamatan,
				f.nama_kabkota,
				g.nama_provinsi,
				k.nm_pemilik
       		FROM tmdatavalkadintek a
			LEFT JOIN tmdatabangunan b ON(b.id=a.id)
			LEFT JOIN tr_kelurahan d ON(d.id_kelurahan=b.id_kel_bgn)
			LEFT JOIN tr_kecamatan e ON(e.id_kecamatan=b.id_kec_bgn)
			LEFT JOIN tr_kabkot f ON(f.id_kabkot=b.id_kabkot_bgn)
			LEFT JOIN tr_provinsi g ON(g.id_provinsi=b.id_prov_bgn)
			LEFT JOIN tmdatapemilik k On(k.id=a.id)
			WHERE (1=1)AND a.no_sppst = '$no_sppst' ";
		if ($no_sppst != null || trim($no_sppst) != '')  $sql .= " AND a.no_sppst = '$no_sppst' ";
		if ($user_id != null || trim($user_id) != '')  $sql .= " AND k.user_id = '$user_id' ";
		$hasil  = $this->db->query($sql);
		return $hasil ;
	}
	public function getDataDataTeknis($id=null,$id_kabkot=null) 
	{
		$sql = "SELECT a.id,
				a.status
       		FROM tmdatabangunan a
			WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND a.id_kabkot_bgn = '$id_kabkot' ";
		$hasil  = $this->db->query($sql);
		return $hasil ;
	}

	

	//Begin Verifikasi User
	public function getDataTempUser($select = "*", $aktivasi = '')
	{
		$this->db->select($select, FALSE);
		if ($aktivasi != null || trim($aktivasi) != '')  $this->db->where('a.activation', $aktivasi);
		$query 	= $this->db->get('temp_user a')->row();
		return $query;
	}

	public function getDataTempUsers($select = "*", $aktivasi = '')
	{
		$this->db->select($select, FALSE);
		if ($aktivasi != null || trim($aktivasi) != '')  $this->db->where('a.activation', $aktivasi);
		$query 	= $this->db->get('temp_user a');
		return $query;
	}
	//End Verifikasi User

	public function getDataMenu($select = 'url', $id_role, $url)
	{
		$this->db->select($select, FALSE);
		$this->db->join('tm_role_menu b', 'a.id = b.menu_id', 'LEFT');
		$this->db->where('b.role_id', $id_role);
		// $this->db->where('a.url',$url);
		$this->db->where('a.url', 'setting/profile_user');
		return $this->db->get('tm_menu a');
	}

	function getRegistrasi($cari = null)
	{
		$sql = "SELECT 	a.*,b.id_permohonan ";
		$sql .= " FROM tm_log_permohonan a 
					LEFT JOIN tm_imb_permohonan b ON (a.id_permohonan=b.id_permohonan)
				WHERE (1=1)  ";

		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$sql .= " ORDER BY a.id_log";
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	function getRegSlf($cari = null)
	{
		$sql = "SELECT 	a.*,b.id_permohonan_slf ";
		$sql .= " FROM tm_slf_log a 
					LEFT JOIN tm_slf_permohonan b ON (a.id_permohonan_slf=b.id_permohonan_slf)
				WHERE (1=1)  ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$sql .= " ORDER BY a.id_log";
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	function getDataSKPemilik($cari = null)
	{
		$sql = "SELECT a.id_permohonan,a.nama_pemohon,a.alamat_pemohon,a.no_ktp,a.no_tlp,a.email,
					a.nama_perusahaan,a.alamat_perusahaan,a.luas_bg,
					a.alamat_bg,a.kelurahan,a.id_jenis_bg,
					e.nama_kabkota,
					f.nama_provinsi,
					i.nama_kecamatan,
					m.tgl_imb,m.ttd_pejabat_sk,m.nip_pejabat_sk
				";
		$sql .= "	FROM tm_imb_permohonan a
						LEFT JOIN tm_imb_penerbitan m ON(a.id_permohonan = m.id_permohonan)
						LEFT JOIN tr_kabkot e ON(e.id_kabkot=a.id_kabkot)
						LEFT JOIN tr_provinsi f ON(a.id_provinsi=f.id_provinsi)
						LEFT JOIN tr_kecamatan i ON(a.id_kecamatan=i.id_kecamatan)
						LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
						LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
					WHERE (1=1)";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		//echo $sql;
		$hasil = $this->db->query($sql);
		return $hasil;
	}
	public function getDataSKBangunan($cari = null)
	{
		$sql = "SELECT a.id_permohonan,a.id_fungsi_bg,a.luas_bg,
					a.alamat_bg,a.kelurahan,a.id_jenis_bg,
					a.jns_bangunan,a.id_prasarana_bg,a.lantai_bg,a.tinggi_bg,
					b.fungsi_bg,
					c.nama_permohonan,
					e.nama_kabkota,
					f.nama_provinsi,
					i.nama_kecamatan,
					
					
					s.retribusi,s.retribusi_manual
				";
		$sql .= "	FROM tm_imb_permohonan a
						LEFT JOIN tr_fungsi_bg b ON (a.id_fungsi_bg =b.id_fungsi_bg)
						LEFT JOIN tm_penetapan_retribusi s ON(s.id_permohonan = a.id_permohonan)
						LEFT JOIN tr_imb_permohonan c ON(a.id_jenis_permohonan = c.id_jenis_permohonan)
						LEFT JOIN tr_kabkot e ON(a.id_kabkot_bg=e.id_kabkot)
						LEFT JOIN tr_provinsi f ON(a.id_provinsi_bg=f.id_provinsi)
						LEFT JOIN tr_kecamatan i ON(a.id_kecamatan=i.id_kecamatan)
					WHERE (1=1)";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		//echo $sql;
		$hasil = $this->db->query($sql);
		return $hasil;
	}

	public function cekProfileDinas($select = '*', $user_id)
	{
		//SELECT id, nama, email FROM pegawai WHERE email IS NULL;
		$this->db->select($select, FALSE);
		$this->db->where('user_id', $user_id);
		return $this->db->get('tm_profile');
	}

	public function cekProfileUser($select = '*', $user_id)
	{
		//SELECT id, nama, email FROM pegawai WHERE email IS NULL;
		$this->db->select($select, FALSE);
		$this->db->where('user_id', $user_id);
		return $this->db->get('tm_user_data');
	}

	//Reset Password
	public function cekUserPassReset($select = 'a.*', $username)
	{
		//SELECT id, nama, email FROM pegawai WHERE email IS NULL;
		$this->db->select($select);
		//$this->db->join('tm_user_data b', 'a.id = b.user_id', 'LEFT');
		$this->db->where('username', $username);
		return $this->db->get('tm_user a');
	}

	public function cekUserPassResetEmail($select = 'a.*', $email)
	{
		//SELECT id, nama, email FROM pegawai WHERE email IS NULL;
		$this->db->select($select);
		//$this->db->join('tm_user_data b', 'a.id = b.user_id', 'LEFT');
		$this->db->where('email', $email);
		return $this->db->get('tm_user a');
	}


	function get_username($username)
	{
		$sql = "SELECT * from tm_user a Where (1=1) ";

		if ($username != null || trim($username) != '')  $sql .= " AND a.username LIKE '%$username%' ";

		$hasil  = $this->db->query($sql);
		//echo $sql;
		return $hasil;
	}

	public function get_email($email)
	{
		return $this->db->like('email',$email)
		->get('temp_user');
	}

	public function getEmailUser($email){
		return $this->db->like('email',$email)
		->get('tm_user');
	}
	//End Reset Password
	public function getEmailUserData($email){
		return $this->db->like('email',$email)
		->get('tm_user_data');
	}
}
