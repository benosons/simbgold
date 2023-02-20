<?php

class Mpenjadwalan extends CI_Model
{
    function getPBGPenjadwalan()
    {
        $dev = $this->session->userdata('loc_role_id');
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.id,b.nm_konsultasi,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn,d.id_stsjadwal,e.nama_stsjadwal');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->join('tm_status_sidang d', 'd.id = a.id', 'left');
        $this->db->join('tr_jadwal e', 'e.id_stsjadwal = d.id_stsjadwal', 'left');
        $this->db->where("c.status >=", 5);
        if ($dev != 1)  $this->db->where('id_kabkot_bgn', $Dinas);
        $this->db->order_by('c.status', 'asc');
        return $this->db->get();
    }

    

    function getCountJadwal($id)
    {
        return $this->db->where('id', $id)->get('tmdatajadwal');
    }

    function get_data_penjadwalan($id = null, $key_sidang = null, $get_max = null)
    {
        $sql = "SELECT a.*
				FROM tmdatajadwal a
				left join tmdatapemilik b on (a.id = b.id)
				WHERE (1=1) ";
        if ($id != null || trim($id) != '')  $sql .= " AND a.id  = '$id' ";
        if ($key_sidang != null || trim($key_sidang) != '')  $sql .= " AND a.id_jadwal = '$key_sidang' ";
        if ($get_max != null || trim($get_max) != '') {
            $sql .= "  ORDER BY a.id_jadwal DESC limit 1";
        }
        //echo $sql;
        $hasil  = $this->db->query($sql);
        return $hasil;
    }

    function get_data_penilaian_krk($id)
    {
        $sql = "SELECT a.*
        FROM tm_penilaian_dokumen_krkpbg a
        left join tmdatapemilik b on (a.id = b.id)
        WHERE (1=1) ";

        if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
        //if ($id_penilaian_krk != null || trim($id_penilaian_krk) != '')  $sql .= " AND a.id_penilaian_krk = '$id_penilaian_krk' ";
        $sql .= " ORDER BY a.id_penilaian_krk DESC";
        //echo $sql;
        $hasil  = $this->db->query($sql);
        return $hasil;
    }

    function get_jenis_fungsi_list($id = null, $fungsi_bg = null, $id_pemanfaatan_bg = null)
    {
        if ($id != null || trim($id) != '')
            $this->db->where('id_fungsi_bg', $id);
        if ($fungsi_bg != null || trim($fungsi_bg) != '')
            $this->db->like('fungsi_bg', $fungsi_bg, 'both');
        if ($id_pemanfaatan_bg != null || trim($id_pemanfaatan_bg) != '')
            $this->db->where('id_pemanfaatan_bg', $id_pemanfaatan_bg);

        $this->db->order_by('id_fungsi_bg', 'asc');
        $hasil =  $this->db->get('tr_fungsi_bg');
        return $hasil;
    }

    public function getDataUserPBG($select = "a.*", $id = '')
    {
        $this->db->select($select, FALSE);
        if ($id != null || trim($id) != '')  $this->db->where('a.id', $id);
        //$this->db->join('tm_imb_kolektif b','a.id_permohonan = b.id_permohonan','LEFT');
        $query     = $this->db->get('tmdatapemilik a')->row();
        return $query;
    }

    function get_data_pertimbangan($id = null, $id_pertimbangan = null, $key_sidang = null)
    {
        $sql = "SELECT a.*
				FROM tm_pertimbangan_rencana_pbg a
				left join tmdatapemilik b on (a.id = b.id)
				WHERE (1=1) ";

        if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
        if ($id_pertimbangan != null || trim($id_pertimbangan) != '')  $sql .= " AND a.id_pertimbangan = '$id_pertimbangan' ";
        if ($key_sidang != null || trim($key_sidang) != '')  $sql .= " AND a.sidang_ke = '$key_sidang' ";
        $sql .= " ORDER BY a.sidang_ke DESC";
        // echo $sql;
        $hasil  = $this->db->query($sql);
        return $hasil;
    }

    function get_permohonan_list($id)
    {
        $this->db->select('a.id as id_pemilik,c.lama_proses,b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_kabkot_bgn,b.id_kec_bgn,
		b.id_jenis_permohonan,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,almt_bgn,fungsi_bg,jns_bangunan,luas_bgn,tinggi_bgn,
		id_kabkot_bgn,b.status,b.id_fungsi_bg,b.jml_lantai,e.nama_kecamatan,h.nama_kabkota,i.nama_provinsi,no_hp,email,no_ktp,
		luas_basement,lapis_basement,nm_bgn,b.id_fungsi_bg,e.nama_kecamatan,a.id_kecamatan,a.id_provinsi,a.id_kabkota,
		h.nama_kabkota,a.no_hp,b.id_prov_bgn,g.nama_kecamatan as nama_kec_bg,j.nama_kabkota as nama_kabkota_bg,k.nama_provinsi nama_provinsi_bg,
		b.tgl_pernyataan,b.luas_bgn,b.tinggi_bgn,b.jml_lantai');
        $this->db->from('tmdatapemilik a');
        $this->db->where("b.status >= 3 ");
        $this->db->where('b.no_konsultasi', $id);
        $this->db->join('tmDataBangunan b', 'a.id = b.id', 'LEFT');
        $this->db->join('tr_konsultasi c', 'b.id_jenis_permohonan = c.id', 'LEFT');
        $this->db->join('tr_imb_permohonan d', 'd.id_jenis_permohonan = b.id_jenis_permohonan', 'left');
        $this->db->join('tr_kecamatan e', 'e.id_kecamatan = a.id_kecamatan', 'LEFT');
        $this->db->join('tr_kabkot h', 'h.id_kabkot = a.id_kabkota', 'LEFT');
        $this->db->join('tr_provinsi i', 'i.id_provinsi = a.id_provinsi', 'LEFT');
        $this->db->join('tr_fungsi_bg f', 'f.id_fungsi_bg = b.id_fungsi_bg', 'left');
        $this->db->join('tr_kecamatan g', 'g.id_kecamatan = b.id_kec_bgn', 'LEFT');
        $this->db->join('tr_kabkot j', 'j.id_kabkot = b.id_kabkot_bgn', 'LEFT');
        $this->db->join('tr_provinsi k', 'k.id_provinsi = b.id_prov_bgn', 'LEFT');
        //$this->db->join('tm_pbg_kolektif l', 'l.id = a.id', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function insertDataSidang($data)
    {
        return $this->db->insert('tmdatajadwal', $data);
    }

    public function getPenjadwalanById($id)
    {
        return $this->db->get_where('tmdatajadwal', array('id' => $id));
    }

    public function insertStatusSidang($data)
    {
        return $this->db->insert('tm_status_sidang', $data);
    }
}
