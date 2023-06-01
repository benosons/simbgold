<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Minfo extends CI_Model
{

	function getRegistrasiX($cari = null)
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
	
	function getRegistrasi($cari = null)
	{
		$sql = "SELECT 	a.*,b.id ";
		$sql .= " FROM th_data_konsultasi a 
					LEFT JOIN tmdatabangunan b ON (a.id=b.id)
				WHERE (1=1)  ";

		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";
		$sql .= " ORDER BY a.id_story";
		$hasil = $this->db->query($sql);
		return $hasil;
	}
}
