<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpenjadwalan extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function get_penjadwalan_list($counting=0,$dipaging=0,$limit=10,$offset=1,$id=null,$cari=null)
	{
		if (isset($counting) && $counting == 1)
		{
			$sql = "SELECT COUNT(a.id_permohonan) as total";
		}
		else
		{
			$sql = "SELECT a.id_permohonan,a.id_jenis_usaha,a.status_syarat,a.id_fungsi_bg,a.nomor_registrasi,a.tgl_permohonan,
					a.nama_pemohon,a.alamat_pemohon,a.no_tlp,a.nama_perusahaan,a.alamat_perusahaan,a.id_kabkot,
					a.no_tlp_perusahaan,a.alamat_bg,a.kelurahan,a.kecamatan,a.id_jenis_bg,a.jns_bangunan,a.id_prasarana_bg,a.status,a.lantai_bg,
					d.nama_permohonan,d.lama_proses,
					f.nama_kabkota ,
					g.nama_provinsi,
					h.tgl_pemberitahuan,
					i.nama_kecamatan,
					j.nama_kabkota as nama_kabkota_bg,
					k.nama_provinsi as nama_provinsi_bg,
					o.fungsi_bg
			";
		}

		$sql .= "	FROM tm_imb_permohonan a
						LEFT JOIN tr_imb_permohonan d ON(d.id_jenis_permohonan = a.id_jenis_permohonan)
						LEFT JOIN tr_kabkot f ON(f.id_kabkot=a.id_kabkot)
						LEFT JOIN tr_provinsi g ON(g.id_provinsi=a.id_provinsi)
						LEFT JOIN tr_kecamatan i ON(a.id_kecamatan=i.id_kecamatan)
						LEFT JOIN tr_kabkot j ON(j.id_kabkot=a.id_kabkot_bg)
						LEFT JOIN tr_provinsi k ON(k.id_provinsi=a.id_provinsi_bg)
						LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
						LEFT JOIN tm_status_permohonan h ON(h.id_permohonan=a.id_permohonan)
					WHERE (1=1) AND a.status_syarat = '1' AND a.status_penugasan ='1'  ";

		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		if ($cari != null || trim($cari) != '')  $sql .= " $cari ";

		if (isset($dipaging) && $dipaging ==1)
			$sql .= " Group by a.id_permohonan ORDER BY a.id_permohonan DESC limit $offset, $limit ";
		else
			$sql .= " Group by a.id_permohonan ORDER BY a.id_permohonan DESC";
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

	function get_data_penjadwalan2($id=null,$key_sidang=null,$get_max=null)
	{
		$sql = "SELECT a.*
				FROM tm_imb_penjadwalan a
				left join tm_imb_permohonan b on (a.id_permohonan = b.id_permohonan)
				WHERE (1=1) ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_permohonan = '$id' ";
		if ($key_sidang != null || trim($key_sidang) != '')  $sql .= " AND a.sidang_ke = '$key_sidang' ";
		if ($get_max != null || trim($get_max) != ''){
			$sql .= "  ORDER BY a.id_penjadwalan DESC limit 1";
		}
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function insert_data_penjadwalan($dataIn)
	{
		$this->db->insert('tm_imb_penjadwalan',$dataIn);
		return $this->db->insert_id();
	}

	function update_data_penjadwalan($dataIn,$id)
	{
		$this->db->where('id_penjadwalan', $id);
		$this->db->update('tm_imb_penjadwalan',$dataIn);
	}

	function insert_data_penjadwalan_detail($dataPeg)
	{
		$this->db->insert('tm_penjadwalan_detail',$dataPeg);
	}

	function delete_data_jadwal_sidang($id_penjadwalan,$id_permohonan)
	{
		$file = $this->get_file_jadwal($id_permohonan,$id_penjadwalan);

		if($file->dir_file_jadwal != '')
		{
			unlink('./file/ba_sidang/' . $file->dir_file_jadwal);
		}

		if($file->dir_file_undangan_sidang != '')
		{
			unlink('./file/undangan_sidang/' . $file->dir_file_undangan_sidang);
		}
		$this->db->delete('tm_imb_penjadwalan',array('id_permohonan'=>$id_permohonan,'id_penjadwalan'=>$id_penjadwalan));
	}

	function get_file_jadwal($id_permohonan,$id_penjadwalan)
	{
		return $this->db->select()->from('tm_imb_penjadwalan')->where(array('id_permohonan'=>$id_permohonan,'id_penjadwalan'=>$id_penjadwalan))->get()->row();
	}




	function m_delete_file_penjadwalan($id_penjadwalan,$id_permohonan)
	{
		$file = $this->get_file_jadwal($id_permohonan,$id_penjadwalan);

		$dataIn = array (
							'dir_file_jadwal' => ""
						);

		$this->db->where('id_penjadwalan', $id_penjadwalan);
		$this->db->update('tm_imb_penjadwalan',$dataIn);

		unlink('./file/ba_sidang/' . $file->dir_file_jadwal);
		return TRUE;
	}

	function m_delete_file_undangan($id_penjadwalan)
	{
		$file = $this->get_file_jadwal($id_penjadwalan);

		$dataIn = array (
							'dir_file_undangan_sidang' => ""
						);

		$this->db->where('id_penjadwalan', $id_penjadwalan);
		$this->db->update('tm_imb_penjadwalan',$dataIn);

		unlink('./file/undangan_sidang/' . $file->dir_file_undangan_sidang);
		return TRUE;
	}

	function get_jenis_pelayanan_list($id=null,$nama_permohonan=null)
	{
		if ($id != null || trim($id) != '')
			$this->db->where('id_jenis_permohonan',$id);
		if ($nama_permohonan != null || trim($nama_permohonan) != '')
			$this->db->like('nama_permohonan',$nama_permohonan,'both');

		$this->db->where('id_pemanfaatan_bg','1');

		$this->db->order_by('id_jenis_permohonan','asc');
		$hasil =  $this->db->get('tr_imb_permohonan');
		return $hasil;
	}

	function get_email_list($id_permohonan=null)
	{
		$sql = "SELECT a.id_personal,b.email,b.nama_personal ";
		$sql .= " FROM tm_imb_penugasan a
					left join tm_personal b on (a.id_personal = b.id_personal)
					WHERE (1=1) AND b.email != '' ";

		if ($id_permohonan != null || trim($id_permohonan) != '')  $sql .= " AND a.id_permohonan = '$id_permohonan' ";

		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;

	}

	function get_data_penugasan($id_penjadwalan=null)
	{
		$sql = "SELECT x.*
				FROM tm_penjadwalan_detail x
				WHERE (1=1) ";

		if ($id_penjadwalan != null || trim($id_penjadwalan) != '')  $sql .= " AND x.id_penjadwalan='$id_penjadwalan' ";

		$sql .= " Group BY x.id_personal ORDER BY x.id_personal ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;

	}
	
	public function getHasilSidang($select="*",$id_penjadwalan){
		$this->db->select($select,FALSE);
		$this->db->where('a.id_penjadwalan',$id_penjadwalan);
		$query 	= $this->db->get('tm_imb_penjadwalan a')->row();
		return $query;
	}
	
	//UpdatedataProgress
	function updateProgress($dataProgress,$id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->update('tm_imb_permohonan',$dataProgress);
		$updated_status = $this->db->affected_rows();
	}
	//

}
