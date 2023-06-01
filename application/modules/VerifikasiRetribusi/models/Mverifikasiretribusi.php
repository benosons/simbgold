<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mverifikasiretribusi extends CI_Model
{
	public function  getListVerifikasiRetribusi()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.*,b.almt_bgn,b.no_konsultasi,b.status,c.nm_konsultasi');
		$this->db->from('tmdatapemilik a');
		$this->db->where("b.status >= 12 ");
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
    public function getRetribusi($id)
	{
		$this->db->select('a.id,b.nilai_retribusi_keseluruhan,c.tgl_penagihan,c.no_penagihan,c.dir_file_penagihan,
		d.bukti_pembayaran,d.tgl_pembayaran,e.validasi_retri');
		$this->db->from('tmdatapemilik a');
		$this->db->where('a.id', $id);
		$this->db->join('tm_retribusi b', 'a.id = b.id', 'LEFT');
		$this->db->join('tmbayar c', 'a.id = c.id_pbgnya', 'LEFT');
		$this->db->join('tmdatapembayaran d', 'a.id=d.id', 'LEFT');
		$this->db->join('tmdatapbg e', 'a.id=e.id', 'LEFT');
		$this->db->order_by('a.id', 'asc');
		return $this->db->get();
	}
    public function updateProgress($dataProgress,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('tmdatabangunan',$dataProgress);
		$updated_status = $this->db->affected_rows();
	}
    function insertDataPenerbitanPbg($dataInKonsultasi)
	{
		$this->db->insert('tmdatapbg',$dataInKonsultasi);
		return $this->db->insert_id();
	}
    function update_Penagihan($dataIn,$id_bayar)
	{
		$this->db->where('id_bayar', $id_bayar);
		$this->db->update('tmbayar',$dataIn);
	}
    function get_id_kabkot($id)
	{
			$sql = "SELECT id, id_kabkot_bgn, id_kec_bgn 
					FROM tmdatabangunan where id = ".$id;
			$hasil = $this->db->query($sql)->row_array();
			return $hasil;
	}
    function getNoDrafPbg($id_kec_bgn,$tgl_skrg)
	{
			$sql = "SELECT max(no_izin_pbg) as no_registrasi_baru 
			FROM tmdatapbg 
			WHERE SUBSTR(no_izin_pbg,8,6) = '$id_kec_bgn' and SUBSTR(no_izin_pbg,15,8) = '$tgl_skrg'";
			$hasil = $this->db->query($sql)->row_array();
			return $hasil;
	}
	public function removeDataBayar($id)
	{
		$this->db->query("DELETE FROM tmbayar WHERE id_pbgnya = $id");
		$this->db->where('id_pbgnya',$id);
		return $query;
	}
}
