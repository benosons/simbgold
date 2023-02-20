<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mreferensi extends CI_Model
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

	public function listDataProvinsi($select = "a.*", $id_provinsi = '')
	{
		$this->db->select($select, FALSE);
		if ($id_provinsi != null || trim($id_provinsi) != '')  $this->db->where('a.id_provinsi', $id_provinsi);
		$query 	= $this->db->get('tr_provinsi a');
		return $query;
	}

	public function cekNamaProvinsi($select = "a.*", $nama_provinsi)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.nama_provinsi', $nama_provinsi);
		$query 	= $this->db->get('tr_provinsi a');
		return $query;
	}

	public function getDataEditProvinsi($select = "*", $id_provinsi)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_provinsi', $id_provinsi);
		$query 	= $this->db->get('tr_provinsi a')->row();
		return $query;
	}

	public function listDataKabKota($select = "a.*", $id_kabkot = '', $id_provinsi = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot', $id_kabkot);
		if ($id_provinsi != null || trim($id_provinsi) != '')  $this->db->where('a.id_provinsi', $id_provinsi);
		$this->db->join('tr_provinsi b', 'a.id_provinsi = b.id_provinsi', 'LEFT');
		$query 	= $this->db->get('tr_kabkot a');
		return $query;
	}

	public function listDataKecamatan($select = "a.*", $id_kecamatan = '', $id_kabkot = '')
	{
		$this->db->select($select, FALSE);
		if ($id_kecamatan != null || trim($id_kecamatan) != '')  $this->db->where('a.id_kecamatan', $id_kecamatan);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot', $id_kabkot);
		$this->db->join('tr_kabkot b', 'a.id_kabkot = b.id_kabkot', 'LEFT');
		$query 	= $this->db->get('tr_kecamatan a');
		return $query;
	}

	public function listDataBidang($select = "a.*", $id_bidang = '')
	{
		$this->db->select($select, FALSE);
		if ($id_bidang != null || trim($id_bidang) != '')  $this->db->where('a.id_bidang', $id_bidang);
		$query 	= $this->db->get('tr_bidang a');
		return $query;
	}

	public function listDataPendidikan($select = "a.*", $id_pendidikan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_pendidikan != null || trim($id_pendidikan) != '')  $this->db->where('a.id_pendidikan', $id_pendidikan);
		$query 	= $this->db->get('tr_pendidikan a');
		return $query;
	}

	public function listDataJurusan($select = "a.*", $id_jurusan = '')
	{
		$this->db->select($select, FALSE);
		if ($id_jurusan != null || trim($id_jurusan) != '')  $this->db->where('a.id_jurusan', $id_jurusan);
		$query 	= $this->db->get('tr_jurusan a');
		return $query;
	}

	public function getDataEditBidang($select = "*", $id_bidang)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_bidang', $id_bidang);
		$query 	= $this->db->get('tr_bidang a')->row();
		return $query;
	}

	public function cekNamaBidang($select = "a.*", $nama_bidang)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.nama_bidang', $nama_bidang);
		$query 	= $this->db->get('tr_bidang a');
		return $query;
	}

	public function removeDataBidang($id_bidang)
	{
		$this->db->query("DELETE FROM tr_bidang WHERE id_bidang = $id_bidang");
		$this->db->where('id_bidang', $id_bidang);
		$query = $this->db->delete('tr_bidang');
		return $query;
	}

	public function removeDataDokumen($table, $id)
	{
		$this->db->where('id', $id);
		$query = $this->db->delete('$table');
		return $query;
	}

	public function listDataUnsurTABG($select = "a.*", $id_unsur_ahli = '')
	{
		$this->db->select($select, FALSE);
		if ($id_unsur_ahli != null || trim($id_unsur_ahli) != '')  $this->db->where('a.id_unsur_ahli', $id_unsur_ahli);
		$this->db->join('tr_unsur b', 'a.id_unsur = b.id_unsur', 'LEFT');
		$this->db->order_by('a.id_unsur', 'asc');
		$query 	= $this->db->get('tr_unsur_ahli a');
		return $query;
	}

	public function getDataEditUnsurTabg($select = "*", $id_unsur_ahli)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_unsur_ahli', $id_unsur_ahli);
		$query 	= $this->db->get('tr_unsur_ahli a')->row();
		return $query;
	}

	public function listDataPersyaratanImb($select = "a.*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id_syarat', $id);
		$this->db->order_by('a.id_syarat', 'desc');
		$query 	= $this->db->get('tr_imb_syarat a');
		return $query;
	}

	public function listDataPersyaratanSlf($select = "a.*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id_syarat', $id);
		$this->db->order_by('a.id_syarat', 'desc');
		$query 	= $this->db->get('tr_slf_syarat a');
		return $query;
	}

	public function getDataEditPersyaratanImb($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_syarat', $id);
		$query 	= $this->db->get('tr_imb_syarat a')->row();
		return $query;
	}

	public function getDataEditPersyaratanSlf($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_syarat', $id);
		$query 	= $this->db->get('tr_slf_syarat a')->row();
		return $query;
	}

	public function getDataEditPermohonan($table, $select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_jenis_permohonan', $id);
		$query 	= $this->db->get($table . ' a')->row();
		return $query;
	}

	public function cekNamaPersyaratan($table, $select = "a.*", $nama_dokumen_permohonan)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.nama_syarat', $nama_dokumen_permohonan);
		$query 	= $this->db->get("$table a");
		return $query;
	}

	public function cekNamaPermohonan($select = "a.*", $nama_permohonan)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.nama_permohonan', $nama_permohonan);
		$query 	= $this->db->get('tr_imb_permohonan a');
		return $query;
	}

	public function listDataPermohonanIMB($select = "a.*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  
		$this->db->where('a.id_jenis_permohonan', $id);
		$this->db->where('a.status', 1);
		$this->db->order_by('a.id_jenis_permohonan', 'desc');
		$query 	= $this->db->get('tr_imb_permohonan a');
		return $query;
	}
	public function listDataPermohonanSLF($select = "a.*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  
		$this->db->where('a.id_jenis_permohonan', $id);
		$this->db->where('a.status', 1);
		$this->db->order_by('a.id_jenis_permohonan', 'desc');
		$query 	= $this->db->get('tr_slf_permohonan a');
		return $query;
	}

	public function listDataPesonilAsn($select = "a.*", $id = '', $stat = '1')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		if ($stat != null || trim($stat) != '')  $this->db->where('a.stat', $stat);
		$this->db->order_by('a.id', 'asc');
		$query 	= $this->db->get('tm_daftar_pegawai a');
		return $query;
	}

	public function listDataPesonilNonAsn($select = "a.*", $id_personal = '', $stat = '0')
	{
		$this->db->select($select, FALSE);
		if ($id_personal != null || trim($id_personal) != '')  $this->db->where('a.id_personal', $id_personal);
		if ($stat != null || trim($stat) != '')  $this->db->where('a.stat', $stat);
		$this->db->order_by('a.id_personal', 'asc');
		$query 	= $this->db->get('tm_daftar_pegawai a');
		return $query;
	}

	public function listDataSubUnsur($select = "a.*", $id_unsur_ahli = '', $id_unsur = '3')
	{
		$this->db->select($select, FALSE);
		if ($id_unsur_ahli != null || trim($id_unsur_ahli) != '')  $this->db->where('a.id_unsur_ahli', $id_unsur_ahli);
		if ($id_unsur != null || trim($id_unsur) != '')  $this->db->where('a.id_unsur', $id_unsur);
		$this->db->order_by('a.id_unsur_ahli', 'asc');
		$query 	= $this->db->get('tr_unsur_ahli a');
		return $query;
	}

	public function listDataKeahlian($select = "a.*", $id_unsur_keahlian = '', $id_unsur = '')
	{
		$this->db->select($select, FALSE);
		if ($id_unsur_keahlian != null || trim($id_unsur_keahlian) != '')  $this->db->where('a.id_unsur_keahlian', $id_unsur_keahlian);
		if ($id_unsur != null || trim($id_unsur) != '')  $this->db->where('a.id_unsur', $id_unsur);
		$this->db->order_by('a.id_unsur_keahlian', 'asc');
		$query 	= $this->db->get('tr_unsur_keahlian a');
		return $query;
	}

	public function getDataEditPersyaratanPermohonanIMB($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_jenis_permohonan', $id);
		$query 	= $this->db->get('tr_imb_permohonan a')->row();
		return $query;
	}

	public function listDataTabg()
	{ }

	public function ListPersyaratan($id_jenis_permohonan, $element = '', $class = 'menu-list', $disable = '', $id_jenis_dok_permohonan = '')
	{
		//$input		= '';
		// if($id_jenis_dok_permohonan=='1'){
		// 	$var	= 'Adminsitrasi :<br>';
		// }else{
		// 	$var	= 'Teknis :<br>';
		// }
		$this->db->select('id_syarat');
		$this->db->where('id_jenis_permohonan', $id_jenis_permohonan);
		$query_menu_selected	= $this->db->get('tr_imb_permohonan_syarat');

		$this->db->select('a.id_syarat,a.nama_syarat');
		$this->db->where('a.id_jenis_persyaratan', $id_jenis_dok_permohonan);
		$this->db->where('a.status', '1');
		$this->db->order_by('a.id_syarat', 'asc');
		$query_menu	= $this->db->get('tr_imb_syarat a');


		// if($query_menu->num_rows() > 0):
		// 	$var .= '<ul class="'.$class.'">';
		// 	foreach($query_menu->result() as $row):
		// 		if($element == 'checkbox')
		// 		{
		// 			$setVal 	= '';
		// 			foreach($query_menu_selected->result() as $key):
		// 				$id_dokumen_permohonan = $key->id_syarat;
		// 				if($row->id_syarat == $id_dokumen_permohonan)
		// 				{
		// 					$setVal = 'checked="checked"';
		// 				}
		// 			endforeach;
		// 			$set	= $disable != '' ? 'disabled="disabled"' : '';
		// 			$input	= '<input type="checkbox" '.$setVal.' name="dok_persyaratan[]" value="'.$row->id_syarat.'" '.$set.'>';
		// 		}
		// 		$var .= '<li class="'.$class.'">'.$input.'<span class="text-menulist">'.$row->nama_syarat.'</span>';
		// 		$var .= '</li>';
		// 	endforeach;
		// 	$var .= '</ul>';
		// endif;
		// echo $var;

		// if($query_menu->num_rows() > 0):
		// 	$var = '<div class="md-checkbox-list">';
		// 	foreach($query_menu->result() as $row):
		// 		if($element == 'checkbox')
		// 		{
		// 			$setVal 	= '';
		// 			foreach($query_menu_selected->result() as $key):
		// 				$id_dokumen_permohonan = $key->id_syarat;
		// 				if($row->id_syarat == $id_dokumen_permohonan)
		// 				{
		// 					$setVal = 'checked="checked"';
		// 				}
		// 			endforeach;
		// 			$set	= $disable != '' ? 'disabled="disabled"' : '';
		// 			$input	= '<input type="checkbox" id="checkbox'.$row->id_syarat.'" class="md-check" '.$setVal.' name="dok_persyaratan[]" value="'.$row->id_syarat.'" '.$set.'>';
		// 		}
		// 		$var .= '<div class="md-checkbox">';
		//
		// 			// $var .= '';
		// 			// $var .= '<li class="'.$class.'">'.$input.'<span class="text-menulist">'.$row->nama_syarat.'</span>';
		// 			$var .= $input;
		// 			$var .= '<label for="checkbox'.$row->id_syarat.'">';
		// 			$var .= '<span class="inc"></span>';
		// 			$var .= '<span class="check"></span>';
		// 			$var .= '<span class="box"></span>';
		// 			$var .= $row->nama_syarat;
		// 			$var .= '</label>';
		// 		$var .= '</div>';
		// 	endforeach;
		// 	$var .= '</div>';
		// endif;
		// echo $var;

	}



	public function removeDataPersyaratanPermohonan($id_nama_permohonan)
	{

		$this->db->where('id_jenis_permohonan', $id_nama_permohonan);
		$query = $this->db->delete('tr_imb_permohonan_syarat');
		return $query;
	}

	

	//Begin Undang-Undang
	public function listDatauu($select = "a.*", $id = '')
	{
		$this->db->select($select, FALSE);
		if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
		$this->db->order_by('a.uu', 'asc');
		$query 	= $this->db->get('tr_uu a');
		return $query;
	}

	public function getDataEdituu($select = "*", $id)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id', $id);
		$query 	= $this->db->get('tr_uu a')->row();
		return $query;
	}

	public function removeDatauu($id)
	{
		$this->db->query("DELETE FROM tr_uu WHERE id = $id");
		$this->db->where('id', $id);
		$query = $this->db->delete('tr_uu');
		return $query;
	}
	//End Undang-undang

	//Begin Logo Dinas
	function GetPictureList()
	{
		$this->db->join('tr_kabkot', "tr_kabkot.id_kabkot = $this->pictures_table_name.id_kabkot", 'left');
		return $this->db->get($this->pictures_table_name)->result();
	}

	// function GetAlbumDetails(){
	// 		$sql="SELECT id, title, featured FROM ".$this->gallery_table_name;
	// 		$result = $this->db->query($sql)->row();
	// 		return $result;
	// }

	function Save($name, $rawname)
	{
		$kabkot = explode('-', $rawname);
		$id_kabkot = $kabkot[1];
		$data = array(
			'id_kabkot' => $id_kabkot,
			'image' => $name,
			'title' => $name
		);
		// $this->db->insert('album_pictures', $data);
		// insert data user
		if ($this->db->insert('album_pictures', $data)) {
			return true;
		} else {
			// jika data gagal di insert
			unlink(FCPATH . 'uploads/gallery/' . $name);
			unlink(FCPATH . 'uploads/gallery/thumbs/' . $name);
			return false;
		}
	}

	function Delete($id)
	{
		$this->db->where('image', $id);
		$this->db->delete('album_pictures');
	}
	//End Logo Dinas

	public function get_syarat_selected_view($id_jenis_permohonan)
	{
		$this->db->select('b.id_syarat,b.nama_syarat');
		$this->db->join('tr_imb_syarat b', 'a.id_syarat = b.id_syarat', 'LEFT');
		$this->db->where('a.id_jenis_permohonan', $id_jenis_permohonan);
		return $this->db->get('tr_imb_permohonan_syarat a');
	}

	// public function get_syarat_selected($id_jenis_permohonan)
	// {
	// 	$this->db->select('id_syarat');
	// 	$this->db->where('id_jenis_permohonan', $id_jenis_permohonan);
	// 	return $this->db->get('tr_imb_permohonan_syarat');
	// }

	// public function get_syarat_selected_view($id_jenis_permohonan)
	// {
	// 	$this->db->select('a.id_persyaratan,a.id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,b.id_persyaratan_detail,b.id_syarat,c.nama_syarat,d.nama_permohonan');
	// 	$this->db->join('tr_imb_persyaratan_detail b', 'a.id_persyaratan = b.id_persyaratan', 'lEFT');
	// 	$this->db->join('tr_imb_syarat c', 'b.id_syarat = c.id_syarat', 'lEFT');
	// 	$this->db->join('tr_imb_permohonan d', 'a.id_jenis_permohonan = d.id_jenis_permohonan', 'lEFT');
	// 	$this->db->where('d.id_jenis_permohonan', $id_jenis_permohonan);
	// 	return $this->db->get('tr_imb_persyaratan a');
	// }

	function get_jenis_permohonan_list($id=null,$nama_permohonan=null,$status=null)
	{
		if ($id != null || trim($id) != '') 
			$this->db->where('id_jenis_permohonan',$id);
			
		if ($nama_permohonan != null || trim($nama_permohonan) != '' ) 
			$this->db->like('nama_permohonan',$nama_permohonan,'both');
			
		$this->db->order_by('id_jenis_permohonan','asc');
		$hasil =  $this->db->get('tr_imb_permohonan');
		return $hasil;
	}

	function get_jenis_permohonan_list_slf($id=null,$nama_permohonan=null,$status=null)
	{
		if ($id != null || trim($id) != '') 
			$this->db->where('id_jenis_permohonan',$id);
			
		if ($nama_permohonan != null || trim($nama_permohonan) != '' ) 
			$this->db->like('nama_permohonan',$nama_permohonan,'both');
			
		$this->db->order_by('id_jenis_permohonan','asc');
		$hasil =  $this->db->get('tr_imb_permohonan');
		return $hasil;
	}

	function get_klasifikasi_bg($id=null,$kalsifikasi_bg=null)
	{
		if ($id != null || trim($id) != '') 
			$this->db->where('id_klasifikasi_bg',$id);
		if ($kalsifikasi_bg != null || trim($kalsifikasi_bg) != '') 
			$this->db->like('kalsifikasi_bg',$kalsifikasi_bg,'both');
			
		$this->db->order_by('id_klasifikasi_bg','asc');
		$hasil =  $this->db->get('tr_klasifikasi_bg');
		return $hasil;
	}

	function get_syarat_list($id_permohonan,$syarat=null,$id_pemanfaatan_bg=null,$id_gol_objek_imb=null,$id_jenis_permohonan=null,$klasifikasi_bg=null,$id_jenis_bg=null)
	{
		$sql = "SELECT a.id_persyaratan,a.id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,
				b.id_persyaratan_detail,b.id_syarat,c.nama_syarat,d.nama_permohonan
				FROM tr_imb_persyaratan a 
					LEFT JOIN tr_imb_persyaratan_detail b ON(a.id_persyaratan=b.id_persyaratan)
					LEFT JOIN tr_imb_syarat c ON(b.id_syarat=c.id_syarat)
					LEFT JOIN tr_imb_permohonan d ON(a.id_jenis_permohonan=d.id_jenis_permohonan)
				WHERE (1=1) AND a.id_jenis_permohonan = $id_permohonan";
		
		// if ($id != null || trim($id) != '')  $sql .= " AND a.id_persyaratan = '$id' ";
		if ($id_pemanfaatan_bg != null || trim($id_pemanfaatan_bg) != '')  $sql .= " AND d.id_pemanfaatan_bg = '$id_pemanfaatan_bg' ";
		if ($klasifikasi_bg != null || trim($klasifikasi_bg) != '')  $sql .= " AND d.id_klasifikasi_bg = '$klasifikasi_bg' ";
		if ($id_jenis_permohonan != null || trim($id_jenis_permohonan) != '')  $sql .= " AND d.id_jenis_permohonan = '$id_jenis_permohonan' ";
		if ($id_jenis_bg != null || trim($id_jenis_bg) != '')  $sql .= " AND d.id_jenis_bg = '$id_jenis_bg' ";
		
		$sql .= " ORDER BY  a.id_jenis_permohonan,a.id_jenis_persyaratan,a.id_detail_jenis_persyaratan,b.id_syarat ASC";
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function get_syarat_list2($id=null,$persyaratan=null)
	{
		$sql = "SELECT b.id_persyaratan_detail, a.id_syarat, a.nama_syarat  FROM tr_imb_syarat a
					LEFT JOIN tr_imb_persyaratan_detail b ON(a.id_syarat=b.id_syarat)
					WHERE (1=1)  ";
		
		if ($id != null || trim($id) != '')  $sql .= " AND b.id_persyaratan = '$id' ";
		if ($persyaratan != null || trim($persyaratan) != '')  $sql .= " AND b.id_syarat = '$persyaratan' ";
		
		$sql .= " ORDER BY a.id_syarat ASC";
		
		//echo $sql;
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	public function get_syarat_selected($id_jenis_permohonan,$id_detail_jenis_persyaratan)
	{
		$this->db->select('b.id_syarat');
		$this->db->where('id_jenis_permohonan', $id_jenis_permohonan);
		$this->db->where('id_detail_jenis_persyaratan', $id_detail_jenis_persyaratan);
		$this->db->join('tr_imb_persyaratan_detail b', 'a.id_persyaratan = b.id_persyaratan', 'LEFT');
		return $this->db->get('tr_imb_persyaratan a');
	}

	public function get_syarat_parent($id_jenis_dok_permohonan)
	{
		$this->db->select('a.id_syarat,a.nama_syarat');
		$this->db->where('a.id_jenis_persyaratan', $id_jenis_dok_permohonan);
		$this->db->where('a.status', '1');
		$this->db->order_by('a.id_syarat', 'asc');
		return $this->db->get('tr_imb_syarat a');
	}

	public function removeDataPersyaratanPermohonanImbAdm($id_nama_permohonan,$id_detail_jenis_persyaratan)
	{

		$this->db->where('id_jenis_permohonan', $id_nama_permohonan);
		$this->db->where('id_detail_jenis_persyaratan', $id_detail_jenis_persyaratan);
		$query = $this->db->delete('tr_imb_persyaratan');
		return $query;
	}

	public function removeDataPersyaratanPermohonanImbAdmDetail($old_id_persyaratan)
	{
		$this->db->where('id_persyaratan', $old_id_persyaratan);
		$query = $this->db->delete('tr_imb_persyaratan_detail');
		return $query;
	}
	public function getIdPersyaratanImb($select = "*", $id, $id_detail_jenis_persyaratan)
	{
		$this->db->select($select, FALSE);
		$this->db->where('a.id_jenis_permohonan', $id);
		$this->db->where('a.id_detail_jenis_persyaratan', $id_detail_jenis_persyaratan);
		$query 	= $this->db->get('tr_imb_persyaratan a')->row();
		return $query;
	}
}
