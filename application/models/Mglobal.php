<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mglobal extends CI_Model{	
	
	public function listDataProvinsi($select="a.*")
	{
		$this->db->select($select,FALSE);
		$query 	= $this->db->get('tr_provinsi a');
		return $query;
	}
	
	public function listDataKabKota($select="a.*",$id_kabkot='',$id_provinsi='')
	{
		$this->db->select($select,FALSE);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		if ($id_provinsi != null || trim($id_provinsi) != '')  $this->db->where('a.id_provinsi',$id_provinsi);
		$this->db->order_by('a.id_kabkot','asc');
		$query 	= $this->db->get('tr_kabkot a');
		return $query;
	
	}
	
	public function listDataKecamatan($select="a.*",$id_kecamatan='',$id_kabkot='')
	{
		$this->db->select($select,FALSE);
		if ($id_kecamatan != null || trim($id_kecamatan) != '')  $this->db->where('a.id_kecamatan',$id_kecamatan);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		$this->db->join('tr_kabkot b','a.id_kabkot = b.id_kabkot','LEFT');
		$this->db->join('tr_provinsi c','b.id_provinsi = c.id_provinsi','LEFT');
		$this->db->order_by('a.id_kecamatan','asc');
		$query 	= $this->db->get('tr_kecamatan a');
		return $query;
	
	}

	public function listDataKelDesa($select="a.*",$id_kelurahan='',$id_kecamatan='')
	{
		$this->db->select($select,FALSE);
		if ($id_kelurahan != null || trim($id_kelurahan) != '')  $this->db->where('a.id_kelurahan',$id_kelurahan);
		if ($id_kecamatan != null || trim($id_kecamatan) != '')  $this->db->where('a.id_kecamatan',$id_kecamatan);
		$this->db->join('tr_kecamatan b','a.id_kecamatan = b.id_kecamatan','LEFT');
		$this->db->join('tr_kabkot c','b.id_kabkot = c.id_kabkot','LEFT');
		$this->db->join('tr_provinsi d','c.id_provinsi = d.id_provinsi','LEFT');
		$this->db->order_by('a.id_kelurahan','asc');
		$query 	= $this->db->get('tr_kelurahan a');
		return $query;
	}

	public function listDataKelurahan($select="a.*",$id_kelurahan='',$id_kecamatan='')
	{
		$this->db->select($select,FALSE);
		if ($id_kelurahan != null || trim($id_kelurahan) != '')  $this->db->where('a.id_kelurahan',$id_kelurahan);
		if ($id_kecamatan != null || trim($id_kecamatan) != '')  $this->db->where('a.id_kecamatan',$id_kecamatan);
		$this->db->join('tr_kecamatan b','a.id_kecamatan = b.id_kecamatan','LEFT');
		$this->db->order_by('a.id_kelurahan','asc');
		$query 	= $this->db->get('tr_kelurahan a');
		return $query;
	}
	
	public function listDataKonsultasi($select="a.*")
	{
		$this->db->select($select,FALSE);
		$query 	= $this->db->get('tr_konsultasi a');
		return $query;
	}
	
	public function listDataFungsiBg($select="a.*")
	{
		$this->db->select($select,FALSE);
		$query 	= $this->db->get('tr_fungsi_bg a');
		return $query;
	}


	
	public function listidpX($select="a.*",$idp='',$id_kabkot='')
	{
		$this->db->select($select,FALSE);
		if ($idp != null || trim($idp) != '')  $this->db->where('a.idp',$idp);
		if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('a.id_kabkot',$id_kabkot);
		$this->db->join('tr_kabkot b','a.id_kabkot = b.id_kabkot','LEFT');
		//$this->db->join('tr_provinsi c','b.id_provinsi = c.id_provinsi','LEFT');
		$this->db->order_by('a.id_kabkot','asc');
		$query 	= $this->db->get('tr_protipeX a');
		return $query;
	
	}
	
	public function listidp($select="a.*",$idp='',$id_kabkot='')
	{
		$sql = "SELECT a.*
		FROM tr_protipe a
		WHERE (1=1) AND a.id_kabkot ='pupr'";
		if ($id_kabkot != null || trim($id_kabkot) != '')  $sql .= " OR a.id_kabkot = '$id_kabkot' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}
	
	public function getDokumen($id=null,$jenis_dokumen=null)
	{
		if ($id != null || trim($id) != '')
			$this->db->where('id_dokumen',$id);
		if ($jenis_dokumen != null || trim($jenis_dokumen) != '')
			$this->db->like('jenis_dokumen',$jenis_dokumen,'both');

		$this->db->order_by('id_dokumen','asc');
		$hasil =  $this->db->get('tr_dokumen');
		return $hasil;
	}

	public function getId($id, $val, $table)
    {
        return $this->db->where($id, $val)->get($table);
    }
	
	
	
}