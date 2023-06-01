<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kalkulator_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function getIndeks($kode){
		$this->db->where('kode',$kode);
		$query = $this->db->get('tr_kode_n_indeks_retribusi');
		return $query;
	}

	function getsampleparameter($kode){
		return $this->db->query("select b.kode,b.nama_indeks,a.parameter,c.indeks as nilai_indeks
					from tr_sampledataretribusi a inner join  ( select kode,nama_indeks from tr_kode_n_indeks_retribusi where parent_kode=1300 ) b on a.option=b.kode
					left join tr_kode_n_indeks_retribusi c on c.kode=a.parameter
					where a.kode='$kode'");
	}

	function getitemparent($kodeparent){
		$this->db->where('parent_kode',$kodeparent);
		$this->db->order_by('kode','ASC');
		$query = $this->db->get('tr_kode_n_indeks_retribusi');
		return $query;
	}

	function get_fungsi($id=null,$subsektor=null)
	{
		$sql = "SELECT * FROM ref_fungsi WHERE (1=1) ";
		if ($id != null || $id != '')  $sql .= " AND id_fungsi = $id ";

		$hasil = $this->db->query($sql);
		return $hasil;
	}
	function get_klasifikasi($id=null,$subsektor=null)
	{
		$sql = "SELECT * FROM ref_klasifikasi WHERE (1=1) ";
		if ($id != null || $id != '')  $sql .= " AND id_klasifikasi = $id ";

		$hasil = $this->db->query($sql);
		return $hasil;
	}
	function get_klas_detail($id=null,$klas=null)
	{
		$sql = "SELECT * FROM ref_klasifikasi_detail WHERE (1=1) ";
		if ($id != null || $id != '')  $sql .= " AND id_klasifikasi_detail = $id ";
		if ($klas != null || $klas != '')  $sql .= " AND id_klasifikasi = $klas ";

		$hasil = $this->db->query($sql);
		return $hasil;
	}
	function get_waktu_penggunaan($id=null,$subsektor=null)
	{
		$sql = "SELECT * FROM ref_waktu_penggunaan WHERE (1=1) ";
		if ($id != null || $id != '')  $sql .= " AND id_waktu = $id ";

		$hasil = $this->db->query($sql);
		return $hasil;
	}
}
