<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Oss_lib_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_oss_data($id_permohonan=null)
	{
		$sql = "SELECT a.id_permohonan,a.nomor_registrasi,a.nib,a.update_oss_data_id_detail,c.oss_id,b.kd_izin
				FROM tm_imb_permohonan a
				LEFT JOIN tm_oss_data_detail b ON (b.nib=a.nib AND b.kd_izin=a.kd_izin)
				LEFT JOIN tm_oss_data c ON (c.update_oss_data_id=b.update_oss_data_id)
				WHERE (1=1) ";

		if (trim($id_permohonan) != '' && $id_permohonan != null ) $sql .= " AND a.id_permohonan = '$id_permohonan' ";

		return $this->db->query($sql);

	}

	function get_selesai($id_permohonan=null)
	{
		$sql = " SELECT a.nib,a.nomor_registrasi,b.no_imb as nomor_izin ,b.tgl_imb as tgl_terbit_izin,b.jabatan_ttd,c.kd_izin,
				d.oss_id ,b.dir_file_imb as file_izin, b.tgl_berlaku_izin
					FROM tm_imb_permohonan a
					LEFT JOIN tm_imb_penerbitan b ON (a.id_permohonan=b.id_permohonan)
					LEFT JOIN tm_oss_data_detail c ON (c.nib=a.nib AND c.kd_izin= a.kd_izin)
					LEFT JOIN tm_oss_data d ON (d.update_oss_data_id=c.update_oss_data_id)
				WHERE (1=1)  ";

		if (trim($id_permohonan) != '' && $id_permohonan != null ) $sql .= " AND a.id_permohonan = '$id_permohonan' ";
		return $this->db->query($sql);
	}
}
