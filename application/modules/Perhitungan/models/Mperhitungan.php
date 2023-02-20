<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Mperhitungan extends CI_Model
{
    public function getKegiatan()
    {
        return $this->db->get('tr_kegiatan');
    }
    public function getDataRetribusi()
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,
						c.status,c.id_kabkot_bgn,d.dir_file_konsultasi,e.Status_Perda');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->join('tmdatajadwal d', 'a.id = d.id', 'LEFT');
		
		$this->db->join('tm_akun_dinas e', 'c.id_kabkot_bgn = e.id_kabkot', 'LEFT');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 9 ");
		$this->db->where("c.status != 25 ");
		$this->db->where("c.status != 26 ");
		if($Dinas =='31'){
			$this->db->where('c.id_prov_bgn = 31');
			$this->db->where('c.jml_lantai > 8');
		}else if ($Dinas =='3101' || $Dinas =='3171' || $Dinas =='3172' || $Dinas =='3173' || $Dinas =='3174' || $Dinas =='3175'){
			$this->db->where('c.id_kabkot_bgn', $Dinas);
			$this->db->where('c.jml_lantai < 9');
		}else if($Dinas =='100'){
			$this->db->where('c.id_otorita', 1);
		}else{
			$this->db->where('c.id_kabkot_bgn', $Dinas);
		}
		$this->db->order_by('c.status', 'asc');
		$this->db->group_by('a.id', 'asc');
		$query = $this->db->get();
		return $query;
	}

    public function cekId($id)
    {
        $this->db->select('a.id as id_pemilik,c.lama_proses,b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_kabkot_bgn,
		b.id_kec_bgn,b.id_jenis_permohonan,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,almt_bgn,fungsi_bg,b.luas_bgn,b.tinggi_bgn,b.tipeA,b.luasA,b.lantaiA,b.tinggiA,b.jumlahA,
		b.status,b.id_fungsi_bg,b.jml_lantai,b.luas_bgp,b.tinggi_bgp,
		e.nama_kecamatan,h.nama_kabkota,i.nama_provinsi as nama_prov_pemilik,a.no_hp,a.email,no_ktp,nm_bgn,
		a.id_kecamatan,a.id_provinsi,a.id_kabkota,
		g.nama_kecamatan as nama_kec_bg,j.nama_kabkota as nama_kabkota_bg,k.nama_provinsi as nama_provinsi_bg,
		b.tgl_pernyataan,a.jns_pemilik,l.*,b.id_klasifikasi,m.klasifikasi_bg');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >= 5");
        $this->db->where('b.no_konsultasi', $id);
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_kecamatan e', 'e.id_kecamatan = a.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot h', 'h.id_kabkot = a.id_kabkota', 'LEFT');
        $this->db->join('tr_provinsi i', 'i.id_provinsi = a.id_provinsi', 'LEFT');
        $this->db->join('tr_fungsi_bg f', 'f.id_fungsi_bg = b.id_fungsi_bg', 'left');
        $this->db->join('tr_kecamatan g', 'g.id_kecamatan = b.id_kec_bgn', 'LEFT');
        $this->db->join('tr_kabkot j', 'j.id_kabkot = b.id_kabkot_bgn', 'LEFT');
        $this->db->join('tr_provinsi k', 'k.id_provinsi = b.id_prov_bgn', 'LEFT');
		$this->db->join('trparameterfungsi l', 'l.id_fungsi_bg = b.id_fungsi_bg', 'LEFT');
		$this->db->join('tr_klasifikasi_bg m', 'm.id_klasifikasi_bg = b.id_klasifikasi', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function getShst($id_kabkot, $thn)
    {
        return $this->db->where('id_kabkot', $id_kabkot)
            ->where('thn_berlaku', $thn)
            ->get('tr_shst');
    }

    public function insertPerhituganRetriusi($data)
    {
        return $this->db->insert('tm_retribusi', $data);
    }

    public function updateStatusBangunan($id, $data)
    {
        return $this->db->where('id', $id)->update('tmdatabangunan', $data);
    }

    public function getPenugasanAll($dateOne, $dateTwo)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.tgl_pernyataan >=", $dateOne);
		$this->db->where("c.tgl_pernyataan <=", $dateTwo);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}
	public function findFungsi($fungsi_bg, $dateOne, $dateTwo)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.tgl_pernyataan >=", $dateOne);
		$this->db->where("c.tgl_pernyataan  <=", $dateTwo);
		$this->db->where("c.id_fungsi_bg", $fungsi_bg);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findFungsiWithoutDate($fungsi_bg)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.id_fungsi_bg", $fungsi_bg);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findProses($proses, $dateOne, $dateTwo)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.tgl_pernyataan >=", $dateOne);
		$this->db->where("c.tgl_pernyataan  <=", $dateTwo);
		$this->db->where("c.status", $proses);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function findProsesWithoutDate($proses)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.status", $proses);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}
	public function findAll($fungsi_bg, $proses, $dateOne, $dateTwo)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.tgl_pernyataan >=", $dateOne);
		$this->db->where("c.tgl_pernyataan  <=", $dateTwo);
		$this->db->where("c.status", $proses);
		$this->db->where("c.id_fungsi_bg", $fungsi_bg);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}
	public function findAllWithoutDate($fungsi_bg, $proses)
	{
		$Dinas = $this->session->userdata('loc_id_kabkot');
		$this->db->select('a.id,b.nm_konsultasi,c.id_fungsi_bg,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
		$this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
		$this->db->where('a.id = c.id');
		$this->db->where('b.id = c.id_jenis_permohonan');
		$this->db->where("c.status >= 3 ");
		$this->db->where('c.id_kabkot_bgn', $Dinas);
		$this->db->where("c.status", $proses);
		$this->db->where("c.id_fungsi_bg", $fungsi_bg);
		$this->db->order_by('c.status', 'asc');
		$query = $this->db->get();
		return $query;
	}
	public function insertPrasaranaBatch($data)
    {
        return $this->db->insert_batch('tm_prasaranaretribusi', $data);
    }
	public function getKoefisienLantai($lantai)
	{
		return $this->db->where('jumlah_lantai', $lantai)->get('tr_koefisien_lantai');
	}
	public function getKoefisienBasement($basement)
	{
		return $this->db->where('lapis_basement', $basement)->get('tr_koefisien_basement');
	}
	public function getRowRetribusi($id)
	{
		return $this->db->where('id', $id)->get('tm_retribusi');
	}
	public function updatePerhituganRetriusi($id, $data)
	{
		return $this->db
			->where('id', $id)
			->update('tm_retribusi', $data);
	}
	public function updatePrasaranaBatch($id, $data)
	{
		return $this->db->update_batch($data, 'tm_prasaranaretribusi', $id);
	}
	public function getDataPrasarana($id)
	{
		return $this->db->where('id', $id)->get('tm_prasaranaretribusi');
	}
}

/* End of file Mperhitungan.php */
