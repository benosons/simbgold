<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imb_model extends CI_Model{
	
	
	//Begin Profile User
	
	public function HapusDataIMB($id_permohonan)
	{
		$this->db->query("DELETE FROM tm_imb_permohonan WHERE id_permohonan = $id_permohonan");
		$this->db->where('id_permohonan',$id_permohonan);
		$query = $this->db->delete('tm_imb_permohonan');	
		return $query;
	}
	
	//Begin Model Tiap List
	function getListVerifikator($id_kabkot=null,$cari=null)
	{
		$sql = "SELECT a.id_permohonan,a.status_progress,a.nama_pemohon,a.alamat_bg,a.nomor_registrasi,b.nama_permohonan,h.fungsi_bg
					FROM tm_imb_permohonan a
					LEFT JOIN tr_imb_permohonan b ON(a.id_jenis_permohonan = b.id_jenis_permohonan)
					LEFT JOIN tr_kecamatan c ON(a.id_kec_bg=c.id_kecamatan)
					LEFT JOIN tr_kabkot d ON(a.id_kabkot_bg=d.id_kabkot)
					LEFT JOIN tr_provinsi e ON(a.id_provinsi_bg=e.id_provinsi)
					LEFT JOIN tr_fungsi_bg h ON (h.id_fungsi_bg = a.id_fungsi_bg)
					WHERE (1=1)  And a.pernyataan >='1' And a.status_progress >='1' And a.status_progress !='2'";
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND a.id_kabkot_bg = '$id_kabkot' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$sql .= " ORDER BY a.status_progress  ASC";
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
	
	function getListValidasi($id_kabkot=null,$cari=null)
	{
		$sql = "SELECT a.id_permohonan,a.status_progress,a.nama_pemohon,a.alamat_bg,a.nomor_registrasi,b.nama_permohonan,h.fungsi_bg
					FROM tm_imb_permohonan a
					LEFT JOIN tr_imb_permohonan b ON(a.id_jenis_permohonan = b.id_jenis_permohonan)
					LEFT JOIN tr_kecamatan c ON(a.id_kec_bg=c.id_kecamatan)
					LEFT JOIN tr_kabkot d ON(a.id_kabkot_bg=d.id_kabkot)
					LEFT JOIN tr_provinsi e ON(a.id_provinsi_bg=e.id_provinsi)
					LEFT JOIN tr_fungsi_bg h ON (h.id_fungsi_bg = a.id_fungsi_bg)
					WHERE (1=1)  And a.pernyataan ='1' And a.status_progress >='4'";
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " AND a.id_kabkot_bg = '$id_kabkot' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$sql .= " ORDER BY a.status_progress  ASC";
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
	//End Model Tiap List
	
	function getIMB()
	{
		$tot = $this->session->userdata('loc_id_kabkot');
		$dev = $this->session->userdata('loc_role_id');
		$sero=null;
		$this->db->select('*'); //memeilih semua field
		$this->db->from('tm_imb_permohonan'); //memeilih tabel
		$this->db->where('pernyataan >= 1');
		$this->db->where('status_progress >= 1');
		//$this->db->where('status_penugasan < 1');
		if ($dev != 1)  $this->db->where('id_kabkot_bg',$tot);
		$this->db->join('tr_imb_permohonan', 'tm_imb_permohonan.id_jenis_permohonan = tr_imb_permohonan.id_jenis_permohonan'); 
		$this->db->join('tr_fungsi_bg', 'tm_imb_permohonan.id_fungsi_bg = tr_fungsi_bg.id_fungsi_bg');
		//$this->db->order_by('tm_imb_permohonan.id_permohonan','desc');
		$this->db->order_by('tm_imb_permohonan.status_progress','asc');
		//$this->db->order_by('tm_imb_permohonan.id_permohonan','desc');
		$query = $this->db->get(); //simpan database yang udah di get alias ambil ke query
		return $query; //hasil dari semua proses ada dimari
	}
	
	function getIMBkasie()
	{
		$tot = $this->session->userdata('loc_id_kabkot');
		$dev = $this->session->userdata('loc_role_id');
		$sero=null;
		$this->db->select('*'); 
		$this->db->from('tm_imb_permohonan');
		$this->db->where('status_progress >= 4');
		if ($dev != 1)  $this->db->where('id_kabkot_bg',$tot);
		$this->db->join('tr_imb_permohonan', 'tm_imb_permohonan.id_jenis_permohonan = tr_imb_permohonan.id_jenis_permohonan'); 
		$this->db->join('tr_fungsi_bg', 'tm_imb_permohonan.id_fungsi_bg = tr_fungsi_bg.id_fungsi_bg');
		$this->db->order_by('tm_imb_permohonan.status_progress','asc');
		$query = $this->db->get(); 
		return $query;
	}
	
	function getById($id_permohonan)
	{
		$this->db->join('tr_imb_permohonan', 'tm_imb_permohonan.id_jenis_permohonan = tr_imb_permohonan.id_jenis_permohonan');
		$this->db->join('tr_fungsi_bg', 'tm_imb_permohonan.id_fungsi_bg = tr_fungsi_bg.id_fungsi_bg');
		$this->db->join('tr_kabkot', 'tm_imb_permohonan.id_kabkot_bg = tr_kabkot.id_kabkot','LEFT');
		//$this->db->join('tr_kabkot', 'tr_kabkot.id_kabkot = tm_imb_permohonan.id_kabkot_bg');
		return $this->db->get_where('tm_imb_permohonan',array('id_permohonan'=>$id_permohonan))->row(); ///ya gitu lah
	}
	
	function getByIdPtugas($id_permohonan)
	{
		$this->db->join('tm_personal', 'tm_imb_penugasan.id_personal = tm_personal.id_personal');
		return $this->db->get_where('tm_imb_penugasan',array('id_permohonan'=>$id_permohonan)); ///ya gitu lah
	}
	
	function getByIdTanah($id_permohonan)
	{
		return $this->db->get_where('tm_imb_tanah',array('id_permohonan'=>$id_permohonan)); ///ya gitu lah
	}
	
	function getByIdStatus($id_permohonan)
	{
		return $this->db->get_where('tm_status_permohonan',array('id_permohonan'=>$id_permohonan)); ///ya gitu lah
	}
	
	function get_syarat_list($per=null,$kls=null,$id_jenis_usaha=null,$luas_bg=null,$status=null)
	{
		$sql = "SELECT a.id_persyaratan,a.id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,
				b.id_persyaratan_detail,b.id_syarat,c.nama_syarat,d.status_syarat,d.luas_bg,e.dir_file
				FROM tr_imb_persyaratan a 
					LEFT JOIN tr_imb_persyaratan_detail b ON(a.id_persyaratan=b.id_persyaratan)
					LEFT JOIN tr_imb_syarat c ON(b.id_syarat=c.id_syarat)
					LEFT JOIN tm_imb_permohonan d ON(a.id_jenis_permohonan=d.id_jenis_permohonan)
					LEFT JOIN tr_protipe e ON(d.idp=e.idp)
				WHERE (1=1)
				";
		
		if ($per != null || trim($per) != '')  $sql .= " AND a.id_jenis_permohonan = '$per' ";
		if ($kls != null || trim($kls) != '')  $sql .= " AND a.id_jenis_persyaratan = '$kls' ";
		if ($id_jenis_usaha == 1 || trim($id_jenis_usaha) == '1')  $sql .= " AND (b.id_syarat != '3' AND b.id_syarat != '4')";
		$sql .= " Group by b.id_persyaratan_detail ORDER BY a.id_jenis_permohonan, a.id_jenis_persyaratan, a.id_detail_jenis_persyaratan, b.id_syarat ASC ";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function getProtype($id_permohonan=null)
	{
		$sql = "SELECT a.*
				FROM tr_protipe a
				LEFT JOIN tm_imb_permohonan b ON(a.idp=b.idp)
				WHERE (1=1) ";
		
		if ($id_permohonan != null || trim($id_permohonan) != '')  $sql .= " AND b.id_permohonan = '$id_permohonan' ";
		//$sql .= " ORDER BY a.idp ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_permohonan($id=null,$cari=null)
	{
		$sql = "SELECT a.*, b.*
		FROM tm_imb_permohonan a
		left join tr_imb_permohonan b on (a.id_jenis_permohonan = b.id_jenis_permohonan)
		WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function get_syarat($id=null,$per=null,$status=null)
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
	
	function get_data_status($id_permohonan=null,$id_status=null)
	{
		$sql = "SELECT 	a.*, b.email,b.nomor_registrasi ";
		$sql .= " FROM tm_status_permohonan a 
					LEFT JOIN tm_imb_permohonan b On(a.id_permohonan=b.id_permohonan)
				WHERE (1=1)  ";
				
		if ($id_permohonan != null || trim($id_permohonan) != '')  $sql .= " AND a.id_permohonan = '$id_permohonan' ";
		if ($id_status != null || trim($id_status) != '')  $sql .= " AND a.id_status = '$id_status' ";
		$sql .= " ORDER BY a.id_status DESC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil ;	
	}
	
	function updateValidasi($dataIn,$id,$detail)
	{
		$this->db->where(array('id_permohonan'=>$id,'id_persyaratan_detail'=>$detail));
		$this->db->update('tm_permohonan_bg_syarat',$dataIn);
		$updated_status = $this->db->affected_rows();
		if($updated_status):
			return $detail;
		else:
			return false;
		endif;
	}
	
	function insert_syarat($dataIn)
	{
		$this->db->insert('tm_permohonan_bg_syarat',$dataIn);
		return $this->db->insert_id();
	}
	
	function update_permohonan($dataIn,$id)
	{
		$this->db->where('id_permohonan', $id);
		$this->db->update('tm_imb_permohonan',$dataIn);
		$updated_status = $this->db->affected_rows();
	}
	
	function updatepermohonan($dataEn,$id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_permohonan',$dataEn);
		$updated_status = $this->db->affected_rows();
	}
	
	function hapus_data_status($id_status)
	{
		//$this->db->delete('tm_status_permohonan',array('id_status'=>$id_status));
		
		$this->db->query("DELETE FROM tm_status_permohonan WHERE id_status = $id_status");
		$this->db->where('id_status',$id_status);
		$query = $this->db->delete('tm_status_permohonan');	
		return $query;
	}
	
	public function saveStatus(){
		$data = array(
			"id_status" => $this->input->post('id_status'),
			"id_permohonan" => $this->input->post('id_permohonan'),
			"status_syarat" => $this->input->post('status_syarat'),
			"no_surat_pemberitahuan" => $this->input->post('no_surat_pemberitahuan'),
			"dir_file_pemberitahuan" => $this->input->post('filename_pemberitahuan'),
			"catatan" => $this->input->post('catatan'),
			"tgl_pemberitahuan" => date('Y-m-d'),
			"post_date" => date('Y-m-d'),
			"last_update" => date('Y-m-d H:i:s'),
			"post_by" => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
		);
		
		$this->db->insert('tm_status_permohonan', $data); // Untuk mengeksekusi perintah insert data
	}
	
	public function editStatus($id_permohonan){
		$data = array(
			"status_syarat" => $this->input->post('status_syarat'),
		);
		
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_permohonan', $data); // Untuk mengeksekusi perintah update data
	}
	public function editStatustileng($id_permohonan){
		$data = array(
			"status_syarat" => 2,
		);
		
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_permohonan', $data); // Untuk mengeksekusi perintah update data
	}
	public function editStatusleng($id_permohonan){
		$data = array(
			"status_syarat" => 1,
		);
		
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_permohonan', $data); // Untuk mengeksekusi perintah update data
	}
	public function editProgress($id_permohonan){
		$data = array(
			"status_progress" => 1,
		);
		
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_permohonan', $data); // Untuk mengeksekusi perintah update data
	}
	public function editProgresstileng($id_permohonan){
		$data = array(
			"status_progress" => null,
		);
		
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_permohonan', $data); // Untuk mengeksekusi perintah update data
	}
	public function editProgressleng($id_permohonan){
		$data = array(
			"status_progress" => 2,
		);
		
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_permohonan', $data); // Untuk mengeksekusi perintah update data
	}
	
	function update_per_dtanah($dataIn,$id)
	{
		$this->db->where('id_permohonan_detail_tanah', $id);
		$this->db->update('tm_imb_tanah',$dataIn);
	}
	
	function getIMBpenugasan()
	{
		$tot = $this->session->userdata('loc_id_kabkot');
		$dev = $this->session->userdata('loc_role_id');
		$this->db->select('*'); //memeilih semua field
		$this->db->from('tm_imb_permohonan'); //memeilih tabel
		$this->db->where("status_progress >= 5 ");
		$this->db->where('status_syarat = 1'); //memilih kondisi
		if ($dev != 1)  $this->db->where('id_kabkot_bg',$tot);
		$this->db->join('tr_imb_permohonan', 'tm_imb_permohonan.id_jenis_permohonan = tr_imb_permohonan.id_jenis_permohonan'); 
		$this->db->join('tr_fungsi_bg', 'tm_imb_permohonan.id_fungsi_bg = tr_fungsi_bg.id_fungsi_bg');
		//$this->db->order_by('tm_imb_permohonan.id_permohonan','desc');
		$this->db->order_by('tm_imb_permohonan.status_penugasan','asc');
		$this->db->order_by('tm_imb_permohonan.id_permohonan','desc');
		
		//$this->db->join('tm_imb_penugasan', 'tm_imb_permohonan.id_permohonan = tm_imb_penugasan.id_permohonan'); 
		//$this->db->join('tm_personal', 'tm_imb_penugasan.id_personal = tm_personal.id_personal'); 
		$query = $this->db->get(); //simpan database yang udah di get alias ambil ke query
		return $query; //hasil dari semua proses ada dimari
	}
	
	function getIMBpenjadwalan()
	{
		$tot = $this->session->userdata('loc_id_kabkot');
		$dev = $this->session->userdata('loc_role_id');
		$this->db->select('*'); //memeilih semua field
		$this->db->from('tm_imb_permohonan'); //memeilih tabel
		$this->db->join('tr_imb_permohonan', 'tm_imb_permohonan.id_jenis_permohonan = tr_imb_permohonan.id_jenis_permohonan'); 
		$this->db->join('tr_fungsi_bg', 'tm_imb_permohonan.id_fungsi_bg = tr_fungsi_bg.id_fungsi_bg');
		//$this->db->join('tm_imb_penjadwalan', 'tm_imb_permohonan.id_permohonan = tm_imb_penjadwalan.id_permohonan');
		$this->db->where('status_penugasan = 1'); //memilih kondisi
		if ($dev != 1)  $this->db->where('id_kabkot_bg',$tot);
		$this->db->order_by('tm_imb_permohonan.id_permohonan','desc');
		//$this->db->join('tm_imb_penugasan', 'tm_imb_permohonan.id_permohonan = tm_imb_penugasan.id_permohonan'); 
		//$this->db->join('tm_personal', 'tm_imb_penugasan.id_personal = tm_personal.id_personal'); 
		$query = $this->db->get(); //simpan database yang udah di get alias ambil ke query
		return $query; //hasil dari semua proses ada dimari
	}
	
	function get_data_penjadwalan($id=null,$key_sidang=null,$get_max=null)
	{
		$sql = "SELECT a.*
				FROM tm_imb_penjadwalan a
				left join tm_imb_permohonan b on (a.id_permohonan = b.id_permohonan)
				WHERE (1=1) ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		if ($key_sidang != null || trim($key_sidang) != '')  $sql .= " AND a.id_penjadwalan = '$key_sidang' ";
		
		
		if ($get_max != null || trim($get_max) != ''){
		$sql .= "  ORDER BY a.id_penjadwalan DESC limit 1";
		}
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function getIMBretribusi()
	{
		$tot = $this->session->userdata('loc_id_kabkot');
		$dev = $this->session->userdata('loc_role_id');
		$this->db->select('*'); //memeilih semua field
		$this->db->from('tm_imb_permohonan'); //memeilih tabel
		
		$this->db->join('tr_imb_permohonan', 'tm_imb_permohonan.id_jenis_permohonan = tr_imb_permohonan.id_jenis_permohonan'); 
		$this->db->join('tr_fungsi_bg', 'tm_imb_permohonan.id_fungsi_bg = tr_fungsi_bg.id_fungsi_bg');
		$this->db->join('tm_imb_penjadwalan', 'tm_imb_permohonan.id_permohonan = tm_imb_penjadwalan.id_permohonan');
		//$this->db->join('tm_penetapan_retribusi', 'tm_imb_permohonan.id_permohonan = tm_penetapan_retribusi.id_permohonan');
		//$this->db->join('tm_imb_penerbitan', 'tm_imb_permohonan.id_permohonan = tm_imb_penerbitan.id_permohonan');
		$this->db->where('status_perbaikan = 2'); //memilih kondisi
		if ($dev != 1)  $this->db->where('id_kabkot_bg',$tot);
		//$this->db->order_by('tm_imb_permohonan.id_permohonan','desc');
		$this->db->order_by('tm_imb_permohonan.status_progress','asc');		
		$query = $this->db->get(); //simpan database yang udah di get alias ambil ke query
		return $query; //hasil dari semua proses ada dimari
	}
	
	function get_data_ret($id=null,$key_sidang=null,$get_max=null)
	{
		$sql = "SELECT a.*
				FROM tm_penetapan_retribusi a
				left join tm_imb_permohonan b on (a.id_permohonan = b.id_permohonan)
				WHERE (1=1) ";

		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		if ($key_sidang != null || trim($key_sidang) != '')  $sql .= " AND a.id_penetapan_retribusi = '$key_sidang' ";


		if ($get_max != null || trim($get_max) != ''){
		$sql .= "  ORDER BY a.id_penetapan_retribusi DESC limit 1";
		}
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	function getIMBverifikasikadis()
	{
		$tot = $this->session->userdata('loc_id_kabkot');
		$dev = $this->session->userdata('loc_role_id');
		$this->db->select('*'); //memeilih semua field
		$this->db->from('tm_imb_permohonan'); //memeilih tabel
		
		$this->db->join('tr_imb_permohonan', 'tm_imb_permohonan.id_jenis_permohonan = tr_imb_permohonan.id_jenis_permohonan'); 
		$this->db->join('tr_fungsi_bg', 'tm_imb_permohonan.id_fungsi_bg = tr_fungsi_bg.id_fungsi_bg');
		$this->db->join('tm_imb_penerbitan', 'tm_imb_permohonan.id_permohonan = tm_imb_penerbitan.id_permohonan');
		$this->db->where('validasi_retribusi >= 1'); //memilih kondisi
		if ($dev != 1)  $this->db->where('id_kabkot_bg',$tot);
		$this->db->order_by('tm_imb_permohonan.id_permohonan','desc');
		//$this->db->join('tm_personal', 'tm_imb_penugasan.id_personal = tm_personal.id_personal'); 
		$query = $this->db->get(); //simpan database yang udah di get alias ambil ke query
		return $query; //hasil dari semua proses ada dimari
	}
	
	function getIMBverifikasikadis2()
	{
		$tot = $this->session->userdata('loc_id_kabkot');
		$dev = $this->session->userdata('loc_role_id');
		$this->db->select('*'); //memeilih semua field
		$this->db->from('tm_imb_penerbitan'); //memeilih tabel
		$this->db->join('tm_imb_permohonan', 'tm_imb_penerbitan.id_permohonan = tm_imb_permohonan.id_permohonan');
		$this->db->join('tr_imb_permohonan', 'tm_imb_permohonan.id_jenis_permohonan = tr_imb_permohonan.id_jenis_permohonan'); 
		$this->db->join('tr_fungsi_bg', 'tm_imb_permohonan.id_fungsi_bg = tr_fungsi_bg.id_fungsi_bg');
		$this->db->where('validasi_retribusi >= 1'); //memilih kondisi
		if ($dev != 1)  $this->db->where('id_kabkot_bg',$tot);
		$this->db->order_by('tm_imb_penerbitan.validasi_retribusi','asc');
		$this->db->order_by('tm_imb_penerbitan.id_penerbitan_imb','desc');
		$query = $this->db->get(); //simpan database yang udah di get alias ambil ke query
		return $query; //hasil dari semua proses ada dimari
	}
	
	function getIMBverifikasikadis3()
	{
		$tot = $this->session->userdata('loc_id_kabkot');
		$dev = $this->session->userdata('loc_role_id');
		$this->db->select('*'); //memeilih semua field
		$this->db->from('tm_imb_penerbitan a'); //memeilih tabel
		$this->db->join('tm_imb_permohonan b', 'a.id_permohonan = b.id_permohonan','left');
		$this->db->join('tr_imb_permohonan c', 'b.id_jenis_permohonan = c.id_jenis_permohonan','left'); 
		$this->db->join('tr_fungsi_bg d', 'b.id_fungsi_bg = d.id_fungsi_bg','left');
		$this->db->where('validasi_retribusi >= 1'); //memilih kondisi
		if ($dev != 1)  $this->db->where('id_kabkot_bg',$tot);
		$this->db->order_by('a.validasi_retribusi','asc');
		$this->db->order_by('a.id_penerbitan_imb','desc');
		$query = $this->db->get(); //simpan database yang udah di get alias ambil ke query
		return $query; //hasil dari semua proses ada dimari
	}
	
	function get_data_penugasan($id_permohonan=null)
	{
		$sql = "SELECT a.*,x.id_penugasan,x.id_permohonan,x.sidang_ke, b.nama_provinsi, c.nama_kabkota, g.dir_file, f.nama_jenjang,
			l.nama_jurusan, k.nama_unsur, m.nama_keahlian, i.nama_unsur_ahli, n.nama_bidang,h.nomor_registrasi
				FROM tm_imb_penugasan x 
				LEFT JOIN tm_personal a on (a.id_personal=x.id_personal)
				LEFT JOIN tr_provinsi b on (a.id_provinsi=b.id_provinsi)
				LEFT JOIN tr_kabkot c on (a.id_kabkot=c.id_kabkot)
				LEFT JOIN tm_riwpendidikan e on (a.id_personal=e.id_personal AND e.status_pdd='1')
				LEFT JOIN tr_jenjang f on (e.id_jenjang=f.id_jenjang)
				LEFT JOIN tr_jurusan l on (e.id_jurusan=l.id_jurusan)
				LEFT JOIN tm_sertifikasi g on (a.id_personal=g.id_personal AND g.status_stk='1')
				LEFT JOIN tr_unsur k on (g.id_unsur=k.id_unsur)
				LEFT JOIN tr_unsur_keahlian m on (g.id_unsur_keahlian=m.id_unsur_keahlian)
				LEFT JOIN tr_unsur_ahli i ON (g.id_unsur_ahli=i.id_unsur_ahli)
				LEFT JOIN tr_bidang n ON (g.id_bidang=n.id_bidang)	
				LEFT JOIN tm_imb_permohonan h on (x.id_permohonan=h.id_permohonan)
				WHERE (1=1) ";
		
		if ($id_permohonan != null || trim($id_permohonan) != '')  $sql .= " AND x.id_permohonan='$id_permohonan' ";
		
		$sql .= " Group BY a.id_personal ORDER BY a.id_personal ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;	
	
	}
	
	function get_tabg_list2($id=null,$cari=null,$idkota=null)
	{

		$sql = "SELECT a.*, b.nama_provinsi, c.nama_kabkota, g.dir_file, f.nama_jenjang, l.nama_jurusan, k.nama_unsur, m.nama_keahlian,
		i.nama_unsur_ahli, n.nama_bidang, year(CURDATE()) as tahun
				FROM tm_personal a 
				LEFT JOIN tm_sk_tabg_detail x on (a.id_personal=x.id_personal)
				LEFT JOIN tm_sk_tabg y on (x.id_sk_tabg=y.id_sk_tabg)
				LEFT JOIN tr_provinsi b on (a.id_provinsi=b.id_provinsi)
				LEFT JOIN tr_kabkot c on (a.id_kabkot=c.id_kabkot)
				LEFT JOIN tm_riwpendidikan e on (a.id_personal=e.id_personal AND e.status_pdd='1')
				LEFT JOIN tr_jenjang f on (e.id_jenjang=f.id_jenjang)
				LEFT JOIN tr_jurusan l on (e.id_jurusan=l.id_jurusan)
				LEFT JOIN tm_sertifikasi g on (a.id_personal=g.id_personal AND g.status_stk='1')
				LEFT JOIN tr_unsur k on (g.id_unsur=k.id_unsur)
				LEFT JOIN tr_unsur_keahlian m on (g.id_unsur_keahlian=m.id_unsur_keahlian)
				LEFT JOIN tr_unsur_ahli i ON (g.id_unsur_ahli=i.id_unsur_ahli)
				LEFT JOIN tr_bidang n ON (g.id_bidang=n.id_bidang)	
				WHERE (1=1) AND a.id_personal in (SELECT id_personal FROM tm_sk_tabg_detail)
				AND y.untuk_tahun= year(CURDATE()) and y.id_kabkot = '$idkota'";
		
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_personal='$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " AND a.nama_personal LIKE '%$cari%' ";
		$sql .= " Group BY a.id_personal ORDER BY a.id_personal ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;		
	}
	
	function get_tim_teknis_list($id=null,$cari=null,$idkota=null)
	{
		$sql = "SELECT a.*, b.nama_provinsi, c.nama_kabkota,  g.dir_file, f.nama_jenjang, l.nama_jurusan, k.nama_unsur,
		m.nama_keahlian, i.nama_unsur_ahli, n.nama_bidang
				FROM tm_personal a
				LEFT JOIN tm_sk_tim_teknis_detail x on (a.id_personal=x.id_personal)
				LEFT JOIN tm_sk_tim_teknis y on (x.id_sk_tabg=y.id_sk_tabg)
				LEFT JOIN tr_provinsi b on (a.id_provinsi=b.id_provinsi)
				LEFT JOIN tr_kabkot c on (a.id_kabkot=c.id_kabkot)
				LEFT JOIN tm_riwpendidikan e on (a.id_personal=e.id_personal AND e.status_pdd='1')
				LEFT JOIN tr_jenjang f on (e.id_jenjang=f.id_jenjang)
				LEFT JOIN tr_jurusan l on (e.id_jurusan=l.id_jurusan)
				LEFT JOIN tm_sertifikasi g on (a.id_personal=g.id_personal AND g.status_stk='1')
				LEFT JOIN tr_unsur k on (g.id_unsur=k.id_unsur)
				LEFT JOIN tr_unsur_keahlian m on (g.id_unsur_keahlian=m.id_unsur_keahlian)
				LEFT JOIN tr_unsur_ahli i ON (g.id_unsur_ahli=i.id_unsur_ahli)
				LEFT JOIN tr_bidang n ON (g.id_bidang=n.id_bidang)
				
				WHERE (1=1)  AND a.id_personal in (SELECT id_personal FROM tm_sk_tim_teknis_detail)
				AND y.untuk_tahun= year(CURDATE()) and y.id_kabkot = '$idkota'";
		
		
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_personal='$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " AND a.nama_personal LIKE '%$cari%' ";
		$sql .= " Group BY a.id_personal ORDER BY a.id_personal ASC";
		// echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;		
	}
	
	function insert_data_penugasan($dataPeg)
	{
		$this->db->insert('tm_imb_penugasan',$dataPeg);
	}
	
	function HapusDataTugas($id_personal,$id_permohonan)
	{
		//$this->db->delete('tm_status_permohonan',array('id_status'=>$id_status));
		
		$this->db->query("DELETE FROM tm_imb_penugasan WHERE id_personal = $id_personal AND id_permohonan = $id_permohonan");
		$this->db->where('id_personal',$id_personal and 'id_permohonan',$id_permohonan);
		$query = $this->db->delete('tm_imb_penugasan');	
		return $query;
	}
	
	function get_email_list($id_permohonan=null)
	{
		$sql = "SELECT a.id_personal,b.email,b.nama_personal ";
		$sql .= " FROM tm_imb_penugasan a 
					left join tm_personal b on (a.id_personal = b.id_personal) 
					WHERE (1=1) AND b.email != '' ";
		
		if ($id_permohonan != null || trim($id_permohonan) != '')  $sql .= " AND a.id_permohonan = '$id_permohonan' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	
	}
	
	function get_permohonan_list($counting=0,$dipaging=0,$limit=10,$offset=1,$id=null,$cari=null)
	{
		if (isset($counting) && $counting == 1) 
		{
			$sql = "SELECT COUNT(a.id_permohonan) as total";
		}
		else 
		{
			$sql = "SELECT a.*,
					c.nama_permohonan,c.lama_proses,
					e.nama_kabkota, 
					f.nama_provinsi,
					i.nama_kecamatan, 
					j.nama_kabkota as nama_kabkota_bg, 
					k.nama_provinsi as nama_provinsi_bg,
					u.nama_kecamatan as kec_badan,
					s.nama_kabkota as nama_kabkota_badan,
					t.nama_provinsi as nama_provinsi_badan,
					o.fungsi_bg,o.id_pemanfaatan_bg as id_pemanfaatan_bg2,
					p.klasifikasi_bg,
					x.tgl_pemberitahuan,
					z.username
				";
		}
		$sql .= "	FROM tm_imb_permohonan a 
						LEFT JOIN tm_status_permohonan x ON(x.id_permohonan=a.id_permohonan)
						LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
						LEFT JOIN tr_klasifikasi_bg p ON(p.id_klasifikasi_bg=a.id_klasifikasi_bg)
						LEFT JOIN tr_kabkot s ON (s.id_kabkot =a.id_kabkot_badan)
						LEFT JOIN tr_provinsi t ON (t.id_provinsi = a.id_provinsi_badan)
						LEFT JOIN tr_kecamatan u ON (u.id_kecamatan = a.id_kec_badan)
						LEFT JOIN tr_imb_permohonan c ON(a.id_jenis_permohonan = c.id_jenis_permohonan)
						
						LEFT JOIN tr_kabkot e ON(e.id_kabkot=a.id_kabkot)
						LEFT JOIN tr_provinsi f ON(a.id_provinsi=f.id_provinsi)
						LEFT JOIN tr_kecamatan i ON(a.id_kecamatan=i.id_kecamatan)
						LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
						LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
						LEFT JOIN tm_user z ON (z.id=a.id_user)
					WHERE (1=1)  AND z.status = '1' ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		if (isset($dipaging) && $dipaging ==1)
			$sql .= " Group by a.id_permohonan ORDER BY a.id_jenis_permohonan DESC limit $offset, $limit ";
		else 
			$sql .= " Group by a.id_permohonan ORDER BY a.id_jenis_permohonan DESC";
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
	
	function insert_log_permohonan($dataIn)
	{
		$this->db->insert('tm_log_permohonan',$dataIn);
		return $this->db->insert_id();
	}
	
	function saveStatusnya($dataStatusnya)
	{
		$this->db->insert('tm_status_permohonan', $dataStatusnya);
		return $this->db->insert_id();
	}
	
	public function editStatusIMB($id_permohonan){
		$data = array(
			"validasi_retribusi" => 2,
		);
		
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_penerbitan', $data); // Untuk mengeksekusi perintah update data
	}
	
	//UpdatedataProgress
	function updateProgress($dataProgress,$id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_permohonan',$dataProgress);
		$updated_status = $this->db->affected_rows();
	}
	//
	
	public function getTerbitIMB($select="*",$id_permohonan){
		$this->db->select($select,FALSE);
		$this->db->where('a.id_permohonan',$id_permohonan);
		$query 	= $this->db->get('tm_imb_permohonan a')->row();
		return $query;
	}
	
	function insert_penyerahan($data_terbit)
	{
		$this->db->insert('tm_imb_penyerahan',$data_terbit);
		return $this->db->insert_id();
	}
	
	function getDataKolektif($id='null')
	{
		$sql ="SELECT a.id_permohonan,b.*
						FROM tm_imb_permohonan a
						LEFT JOIN tm_imb_kolektif b ON(a.id_permohonan=b.id_permohonan)
						WHERE (a.id_permohonan=$id)";
		$hasil = $this->db->query($sql);
		//echo $sql;
		return $hasil;
	}
}