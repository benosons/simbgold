<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpenagihanretribusi extends CI_Model
{
	//Begin Fungsi Tarik Data
	public function  getListPenagihanRetribusi()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 11 ");
		$this->db->where("b.status != 25 ");
		$this->db->where("b.status != 26 ");
		if($Dinas =='31'){
			$this->db->where('b.id_prov_bgn = 31');
			$this->db->where('b.jml_lantai > 8');
		}else if ($Dinas =='3101' || $Dinas =='3171' || $Dinas =='3172' || $Dinas =='3173' || $Dinas =='3174' || $Dinas =='3175'){
			$this->db->where('b.id_kabkot_bgn', $Dinas);
			$this->db->where('b.jml_lantai < 9');
		}else {
			$this->db->where('b.id_kabkot_bgn', $Dinas);
		}
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->order_by('b.status','asc');
		$query = $this->db->get();
		$this->db->limit(30);
		return $query;
	}
	public function  getDataVerifikator($id)
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
	
	public function  getDataPemilik($id)
	{
		$this->db->select('*');
		$this->db->from('tmdatapemilik a');
		$this->db->where('a.id',$id);
		$this->db->join('tmdatabangunan b', 'a.id = b.id','LEFT');
		$this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id','LEFT');
		$this->db->join('tr_kecamatan d', 'a.id_kecamatan = d.id_kecamatan','LEFT');
		$this->db->join('tr_kabkot e', 'a.id_kabkota = e.id_kabkot','LEFT');
		$this->db->join('tr_provinsi f', 'a.id_provinsi = f.id_provinsi','LEFT');
		$query = $this->db->get();
		return $query;
	}

	public function  getDataBangunan($id)
    {
        $this->db->select('b.*,c.nm_konsultasi,
		k.nama_kelurahan,
        d.nama_kecamatan,
        e.nama_kabkota,
        f.nama_provinsi,
        g.*,
        h.fungsi_bg,
        i.*,
        j.*,
        ');
        $this->db->from('tmdatapemilik a');
        $this->db->where('a.id', $id);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->join('tr_kelurahan k', 'b.id_kel_bgn = k.id_kelurahan', 'LEFT');
        $this->db->join('tr_kecamatan d', 'b.id_kec_bgn = d.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot e', 'b.id_kabkot_bgn = e.id_kabkot', 'LEFT');
        $this->db->join('tr_provinsi f', 'b.id_prov_bgn = f.id_provinsi', 'LEFT');
        $this->db->join('tm_retribusi g', 'g.id = b.id', 'LEFT');
        $this->db->join('tr_fungsi_bg h', 'h.id_fungsi_bg = b.id_fungsi_bg', 'left');
        $this->db->join('tr_klasifikasi_bg i', 'i.id_klasifikasi_bg = c.klasifikasi_bg', 'LEFT');
        $this->db->join('tr_kegiatan j', 'j.id_kegiatan = g.id_kegiatan', 'left');
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

	function getDataRetribusi($id=null)
	{
		$sql = "SELECT a.*,
				q.*,
				d.dir_file_skrd,d.no_skrd,
				e.file_ssrd,e.no_ssrd,
				f.validasi_retri,
				r.nama_fungsi,r.index_fungsi,s.index_klasifikasi as index_klasifikasi_bg,
				o.fungsi_bg,o.id_pemanfaatan_bg as id_pemanfaatan_bg2,p.klasifikasi_bg,
				b.dir_file_konsultasi,b.id_jadwal
				";
		$sql .= "	FROM tmdatabangunan a 
						LEFT JOIN tmdatajadwal b ON(b.id=a.id)
						LEFT JOIN tr_imb_permohonan c ON(a.id_jenis_permohonan = c.id_jenis_permohonan)
						LEFT JOIN tmdataskrd d ON (a.id=d.id)
						LEFT JOIN tmdatassrd e ON (a.id=e.id)
						LEFT JOIN tmdatapbg f ON (a.id=f.id)
						LEFT JOIN tr_fungsi_bg o ON(o.id_fungsi_bg=a.id_fungsi_bg)
						LEFT JOIN tr_klasifikasi_bg p ON(p.id_klasifikasi_bg=c.id_klasifikasi_bg)
						LEFT JOIN ref_fungsi r ON(o.id_fungsi_bg=r.id_fungsi)
						LEFT JOIN ref_klasifikasi_detail s ON(p.id_klasifikasi_bg=s.id_klasifikasi_detail)
						LEFT JOIN tmbayar q ON(a.id=q.id_pbgnya)
					WHERE (1=1)";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function bayar($id)
	{
		$this->db->select('a.*,b.*');
		$this->db->from('tmdatapemilik a');
		$this->db->join('tmbayar b', 'b.id_pbgnya = a.id', 'left');
		$this->db->where('a.id', $id);
		return $this->db->get();
	}

	function insert_Penagihan($dataIn)
	{
		$this->db->insert('tmbayar',$dataIn);
		return $this->db->insert_id();
	}

	public function updateProgress($dataProgress,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tmdatabangunan',$dataProgress);
		$updated_status = $this->db->affected_rows();
	}
}
