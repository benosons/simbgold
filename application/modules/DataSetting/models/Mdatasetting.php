<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdatasetting extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		//$this->gallery_table_name   = 'album';
		$this->pictures_table_name   = 'album_pictures';
		$this->primary_key  = 'id';
		//$this->data = $this->db->get($this->gallery_table_name)->result();
		$config['upload_path'] = realpath(APPPATH . '../uploads/gallery/');
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']    = 102400;
		$config['max_width']  = 30720;
		$config['max_height']  = 10240;
		$this->load->library('upload', $config);
	}

	public function listDataDokumen($select = "a.*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		$this->db->order_by('a.jns_dokumen', 'asc');
		$query 	= $this->db->get('tr_dokumen_syarat a');
		return $query;
	}

	public function cekNamaDokumen($select = "a.*", $nm_dokumen)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.nm_dokumen', $nm_dokumen);
		$query 	= $this->db->get('tr_dokumen_syarat a');
		return $query;
	}

	public function cekNamaKonsultasi($select = "a.*", $nm_konsultasi)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.nm_konsultasi', $nm_konsultasi);
		$query 	= $this->db->get('tr_konsultasi a');
		return $query;
	}

	public function getDataEditDokumen($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.jns_dokumen', $id);
		$query 	= $this->db->get('tr_dokumen_syarat a')->row();
		return $query;
	}

	public function listDataKonsultasi($select = "a.*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  
		$this->db->where('a.id', $id);
		$this->db->order_by('a.id', 'asc');
		$query 	= $this->db->get('tr_konsultasi a');
		return $query;
	}

	function getJnsKonsultasi($id=null,$nm_konsultasi=null,$status=null)
	{
		if ($id != null || trim($id) != '') 
			$this->db->where('id',$id);
			
		if ($nm_konsultasi != null || trim($nm_konsultasi) != '' ) 
			$this->db->like('nm_konsultasi',$nm_konsultasi,'both');
			
		$this->db->order_by('id','asc');
		$hasil =  $this->db->get('tr_konsultasi');
		return $hasil;
	}

	public function getKonsultasi($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id', $id);
		$query 	= $this->db->get('tr_konsultasi a')->row();
		return $query;
	}

	function getSyaratList($id)
	{
		$sql = "SELECT a.id_persyaratan,a.id,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,
				b.id_detail,b.id_syarat,c.nm_dokumen,d.nm_konsultasi
				FROM tr_konsultasi_syarat a 
					LEFT JOIN tr_pbg_syarat_detail b ON(a.id_persyaratan=b.id_persyaratan)
					LEFT JOIN tr_dokumen_syarat c ON(b.id_syarat=c.id)
					LEFT JOIN tr_konsultasi d ON(a.id=d.id)
				WHERE (1=1) AND a.id = $id";
		
		$sql .= " ORDER BY  a.id ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	public function getSyaratSelected($id,$id_detail_jenis_persyaratan)
	{
		$this->db->select('b.id_syarat');
		$this->db->where('id', $id);
		$this->db->where('id_detail_jenis_persyaratan', $id_detail_jenis_persyaratan);
		$this->db->join('tr_pbg_syarat_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		return $this->db->get('tr_konsultasi_syarat a');
	}

	public function get_syarat_parent($id_jenis_dok_permohonan)
	{
		$this->db->select('a.id,a.nm_dokumen');
		$this->db->where('a.jns_dokumen', $id_jenis_dok_permohonan);
		//$this->db->where('a.status', '1');
		$this->db->order_by('a.id', 'asc');
		return $this->db->get('tr_dokumen_syarat a');
	}

	public function getIdPersyaratanImb($select = "*", $id, $id_detail_jenis_persyaratan)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_jenis_permohonan', $id);
		$this->db->where('a.id_detail_jenis_persyaratan', $id_detail_jenis_persyaratan);
		$query 	= $this->db->get('tr_imb_persyaratan a')->row();
		return $query;
	}

	public function ListPersyaratan($id_jenis_permohonan, $element = '', $class = 'menu-list', $disable = '', $id_jenis_dok_permohonan = '')
	{
		$this->db->select('id_syarat');
		$this->db->where('id_jenis_permohonan', $id_jenis_permohonan);
		$query_menu_selected	= $this->db->get('tr_imb_permohonan_syarat');

		$this->db->select('a.id_syarat,a.nama_syarat');
		$this->db->where('a.id_jenis_persyaratan', $id_jenis_dok_permohonan);
		$this->db->where('a.status', '1');
		$this->db->order_by('a.id_syarat', 'asc');
		$query_menu	= $this->db->get('tr_imb_syarat a');

	}

	function get_jenis_permohonan_list($id=null,$nm_konsultasi=null,$status=null)
	{
		if ($id != null || trim($id) != '') 
			$this->db->where('id',$id);
			
		if ($nm_konsultasi != null || trim($nm_konsultasi) != '' ) 
			$this->db->like('nm_konsultasi',$nm_konsultasi,'both');
			
		$this->db->order_by('id','asc');
		$hasil =  $this->db->get('tr_konsultasi');
		return $hasil;
	}

	public function removeKonsultasiAdm($id,$id_detail_jenis_persyaratan)
	{

		$this->db->where('id', $id);
		$this->db->where('id_detail_jenis_persyaratan', $id_detail_jenis_persyaratan);
		$query = $this->db->delete('tr_konsultasi_syarat');
		return $query;
	}

	public function removeKonsultasiAdmDetail($old_id_persyaratan)
	{
		$this->db->where('id_persyaratan', $old_id_persyaratan);
		$query = $this->db->delete('tr_pbg_syarat_detail');
		return $query;
	}
}
