<?php



defined('BASEPATH') or exit('No direct script access allowed');

class SS_Model extends CI_Model
{

    protected $selected = 'a.status_progress,a.nomor_registrasi,a.alamat_pemohon,a.nama_bangunan,a.alamat_bg,a.id_provinsi,a.id_provinsi_bg,a.id_kecamatan,a.id_kabkot_bg,a.jns_bangunan,a.tgl_permohonan';

    
    public function getSecurityKey($where)
    {
        return $this->db->get_where('tmuserapi', $where);
    }



    public function getDataBangunan($id)
    {
        $this->db->select('a.id as id_pemilik,b.id_izin,c.lama_proses,b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_kabkot_bgn,b.id_kec_bgn,b.id_jenis_permohonan,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,almt_bgn,fungsi_bg,luas_bgn,tinggi_bgn,id_kabkot_bgn,b.status,b.id_fungsi_bg,b.jml_lantai,e.nama_kecamatan,h.nama_kabkota,i.nama_provinsi as nama_prov_pemilik,no_hp,email,no_ktp,luas_basement,lapis_basement,nm_bgn,b.id_fungsi_bg,e.nama_kecamatan,a.id_kecamatan,a.id_provinsi,a.id_kabkota,h.nama_kabkota,a.no_hp,b.id_prov_bgn,g.nama_kecamatan as nama_kec_bg,j.nama_kabkota as nama_kabkota_bg,k.nama_provinsi as nama_provinsi_bg,b.tgl_pernyataan,b.luas_bgn,b.tinggi_bgn,b.jml_lantai,l.id_klasifikasi_bg,l.klasifikasi_bg,b.tipeA,b.luasA,b.lantaiA,b.tinggiA,b.jumlahA');
        $this->db->from('tmdatapemilik a');
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
        $this->db->join('tr_klasifikasi_bg l', 'l.id_klasifikasi_bg = c.klasifikasi_bg', 'LEFT');
        $query = $this->db->get();
        return $query;
    }
	
	public function getDataBangunanAll()
    {
        $this->db->select('a.nm_pemilik,a.alamat as alamat_pemilik,c.nm_konsultasi,b.*');
        $this->db->from('tmdatapemilik a');
        $this->db->join('tmdatabangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
		$this->db->where('b.pernyataan >= 1');
		$this->db->limit(5000);
        $query = $this->db->get();
        return $query;
    }

    
    public function getDataMonitoringIMB()
    {
        $tot = $this->session->userdata('loc_id_kabkot');
        $dev = $this->session->userdata('loc_role_id');
        $this->db->select($this->selected);
        $this->db->from('tm_imb_permohonan a');
        $this->db->where('pernyataan >= 1');
        $this->db->where('status_progress >= 1');
        if ($dev != 1)  $this->db->where('id_kabkot_bg', $tot);
        $this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
        $this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
        $this->db->order_by('a.status_progress', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function findProvincesWithoutKabkotaKecamatan($provinsi)
    {
        $this->db->select($this->selected);
        $this->db->from('tm_imb_permohonan a');
        $this->db->where('pernyataan >= 1');
        $this->db->where('status_progress >= 1');
        $this->db->where('id_provinsi_bg', $provinsi);
        $this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
        $this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
        $this->db->order_by('a.status_progress', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function findKabkotaWithoutProvincesKecamatan($kabkota)
    {
        $this->db->select($this->selected);
        $this->db->from('tm_imb_permohonan a');
        $this->db->where('pernyataan >= 1');
        $this->db->where('status_progress >= 1');
        $this->db->where('id_kabkot_bg', $kabkota);
        $this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
        $this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
        $this->db->order_by('a.status_progress', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function findKecamatanWithoutProvincesKabkota($kecamatan)
    {
        $this->db->select($this->selected);
        $this->db->from('tm_imb_permohonan a');
        $this->db->where('pernyataan >= 1');
        $this->db->where('status_progress >= 1');
        $this->db->where('id_kecamatan', $kecamatan);
        $this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
        $this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
        $this->db->order_by('a.status_progress', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function findProvincesAndKabkota($provinsi, $kabkota)
    {
        $this->db->select($this->selected);
        $this->db->from('tm_imb_permohonan a');
        $this->db->where('pernyataan >= 1');
        $this->db->where('status_progress >= 1');
        $this->db->where('id_provinsi_bg', $provinsi);
        $this->db->where('id_kabkot_bg', $kabkota);
        $this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
        $this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
        $this->db->order_by('a.status_progress', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function findProvincesAndKecamatan($provinsi, $kecamatan)
    {
        $this->db->select($this->selected);
        $this->db->from('tm_imb_permohonan a');
        $this->db->where('pernyataan >= 1');
        $this->db->where('status_progress >= 1');
        $this->db->where('id_provinsi_bg', $provinsi);
        $this->db->where('id_kecamatan', $kecamatan);
        $this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
        $this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
        $this->db->order_by('a.status_progress', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function findKabkotaAndKecamatan($kabkota, $kecamatan)
    {
        $this->db->select($this->selected);
        $this->db->from('tm_imb_permohonan a');
        $this->db->where('pernyataan >= 1');
        $this->db->where('status_progress >= 1');
        $this->db->where('id_kabkot_bg', $kabkota);
        $this->db->where('id_kecamatan', $kecamatan);
        $this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
        $this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
        $this->db->order_by('a.status_progress', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function findAllState($provinsi, $kabkota, $kecamatan)
    {
        $this->db->select($this->selected);
        $this->db->from('tm_imb_permohonan a');
        $this->db->where('pernyataan >= 1');
        $this->db->where('status_progress >= 1');
        $this->db->where('id_provinsi_bg', $provinsi);
        $this->db->where('id_kabkot_bg', $kabkota);
        $this->db->where('id_kecamatan', $kecamatan);
        $this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
        $this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
        $this->db->order_by('a.status_progress', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function findJenisBangunan($jns_bgn)
    {
        $this->db->select($this->selected);
        $this->db->from('tm_imb_permohonan a');
        $this->db->where('pernyataan >= 1');
        $this->db->where('status_progress >= 1');
        $this->db->or_like('jns_bangunan', $jns_bgn);
        $this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
        $this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
        $this->db->order_by('a.status_progress', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function findDateRange($start, $end)
    {
        $this->db->select($this->selected);
        $this->db->from('tm_imb_permohonan a');
        $this->db->where('pernyataan >= 1');
        $this->db->where('status_progress >= 1');
        $this->db->where('tgl_permohonan >=', $start);
        $this->db->where('tgl_permohonan <=', $end);
        $this->db->join('tr_imb_permohonan b', 'a.id_jenis_permohonan = b.id_jenis_permohonan');
        $this->db->join('tr_fungsi_bg c', 'a.id_fungsi_bg = c.id_fungsi_bg');
        $this->db->order_by('a.status_progress', 'asc');
        $query = $this->db->get();
        return $query;
    }
}

/* End of file SS_Model.php */
