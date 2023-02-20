<?php

class Mpenjadwalan extends CI_Model
{
    public function getDataKonsultasi2()
    {
        $dev = $this->session->userdata('loc_role_id');
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.id,b.nm_konsultasi,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,
                        c.almt_bgn,c.status,c.id_kabkot_bgn,d.id_stsjadwal,e.nama_stsjadwal');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->join('tm_status_konsultasi d', 'd.id = a.id', 'left');
        $this->db->join('tr_jadwal e', 'e.id_stsjadwal = d.id_stsjadwal', 'left');
        $this->db->where("c.status >= 5");
        $this->db->where_not_in('c.status',7);
        if ($dev != 1)  $this->db->where('id_kabkot_bgn', $Dinas);
        $this->db->order_by('c.status', 'asc');
        return $this->db->get();
    }

    public function getDataKonsultasi($SQLcari = '')
    {
        $dev = $this->session->userdata('loc_role_id');
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.id,b.nm_konsultasi,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->where("c.status >= 5");
        $this->db->where("c.status != 26");
        $this->db->order_by('c.status', 'asc');
        if ($dev != 1);
        if($Dinas =='31'){
			$this->db->where('c.id_prov_bgn = 31');
			$this->db->where('c.jml_lantai > 8');
		}else if ($Dinas =='3101' || $Dinas =='3171' || $Dinas =='3172' || $Dinas =='3173' || $Dinas =='3174' || $Dinas =='3175'){
			$this->db->where('c.id_kabkot_bgn', $Dinas);
			$this->db->where('c.jml_lantai < 9');
		}else {
			$this->db->where('c.id_kabkot_bgn', $Dinas);
		}
        if ($SQLcari != '') {
            !empty($SQLcari['id_fungsi_bg']) ? $this->db->where('c.id_fungsi_bg', $SQLcari['id_fungsi_bg']) : '';
            if (!empty($SQLcari['id_proses'])) {
                $SQLcari['id_proses'] == 1 ? $this->db->where('c.status <', 6) : $this->db->where('c.status >=', 6);
            }
            !empty($SQLcari['tanggalawal']) ? $this->db->where('c.tgl_pernyataan >=', date('Y-m-d', strtotime($SQLcari['tanggalawal']))) : '';
            !empty($SQLcari['tanggalakhir']) ? $this->db->where('c.tgl_pernyataan <=', date('Y-m-d', strtotime($SQLcari['tanggalakhir']))) : '';
        }
        return $this->db->get();
    }

    function getPBGPenjadwalan()
    {
        $dev = $this->session->userdata('loc_role_id');
        $Dinas = $this->session->userdata('loc_id_kabkot');
        $this->db->select('a.id,b.nm_konsultasi,c.tgl_pernyataan,c.no_konsultasi,a.nm_pemilik,c.almt_bgn,c.status,c.id_kabkot_bgn,d.id_stsjadwal,e.nama_stsjadwal');
        $this->db->from('tmdatapemilik as a,tr_konsultasi as b,tmdatabangunan as c');
        $this->db->where('a.id = c.id');
        $this->db->where('b.id = c.id_jenis_permohonan');
        $this->db->join('tm_status_konsultasi d', 'd.id = a.id', 'left');
        $this->db->join('tr_jadwal e', 'e.id_stsjadwal = d.id_stsjadwal', 'left');
        $this->db->where("c.status", 4);
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
				FROM tm_pbg_penjadwalan a
				left join tmdatapemilik b on (a.id = b.id)
				WHERE (1=1) ";

        if ($id != null || trim($id) != '')  $sql .= " AND a.id  = '$id' ";
        if ($key_sidang != null || trim($key_sidang) != '')  $sql .= " AND a.id_penjadwalan = '$key_sidang' ";


        if ($get_max != null || trim($get_max) != '') {
            $sql .= "  ORDER BY a.id_penjadwalan DESC limit 1";
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
        $this->db->select('a.id as id_pemilik,c.lama_proses,b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_kabkot_bgn,
                b.id_kec_bgn,b.id_jenis_permohonan,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,almt_bgn,fungsi_bg,luas_bgn,
                tinggi_bgn,id_kabkot_bgn,b.status,b.id_fungsi_bg,b.jml_lantai,e.nama_kecamatan,h.nama_kabkota,
                i.nama_provinsi as nama_prov_pemilik,no_hp,email,no_ktp,luas_basement,lapis_basement,nm_bgn,
                b.id_fungsi_bg,e.nama_kecamatan,a.id_kecamatan,a.id_provinsi,a.id_kabkota,h.nama_kabkota,
                a.no_hp,b.id_prov_bgn,g.nama_kecamatan as nama_kec_bg,j.nama_kabkota as nama_kabkota_bg,
                k.nama_provinsi as nama_provinsi_bg,b.tgl_pernyataan,b.luas_bgn,b.tinggi_bgn,b.jml_lantai');  
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
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    function getByIdPtugas($id)
	{
		return $this->db->join('tm_personal', 'tm_penugasan_pbg.id_personal = tm_personal.id_personal')
			->join('tm_sertifikasi', 'tm_sertifikasi.id_personal = tm_personal.id_personal', 'left')
			->join('tm_riwpendidikan', 'tm_riwpendidikan.id_personal = tm_personal.id_personal', 'left')
			->join('tr_unsur', 'tr_unsur.id_unsur = tm_sertifikasi.id_unsur', 'left')
			->join('tr_unsur_ahli', 'tr_unsur_ahli.id_unsur_ahli = tm_sertifikasi.id_unsur_ahli', 'left')
			->join('tr_unsur_keahlian', 'tr_unsur_keahlian.id_unsur_keahlian = tm_sertifikasi.id_unsur_keahlian', 'left')
			->get_where('tm_penugasan_pbg', array('id_pemilik' => $id)); ///ya gitu lah
	}

    public function getByIdTpa($id)
    {
        return $this->db->join('tm_tpa b', 'a.id = b.id')
			/*->join('tm_sertifikasi', 'tm_sertifikasi.id_personal = tm_personal.id_personal', 'left')
			->join('tm_riwpendidikan', 'tm_riwpendidikan.id_personal = tm_personal.id_personal', 'left')
			->join('tr_unsur', 'tr_unsur.id_unsur = tm_sertifikasi.id_unsur', 'left')
			->join('tr_unsur_ahli', 'tr_unsur_ahli.id_unsur_ahli = tm_sertifikasi.id_unsur_ahli', 'left')
			->join('tr_unsur_keahlian', 'tr_unsur_keahlian.id_unsur_keahlian = tm_sertifikasi.id_unsur_keahlian', 'left')*/
			->get_where('tm_penugasan_tpa a', array('id_pemilik' => $id)); ///ya gitu lah
    }

    public function insertDataKonsultasi($data)
    {
        return $this->db->insert('tmdatajadwal', $data);
    }

    public function getPenjadwalanById($id)
    {
        return $this->db->get_where('tmdatajadwal', array('id' => $id));
    }

    function updateStats($data, $id)
	{
		return $this->db->where('id', $id)->update('tmdatabangunan', $data);
	}

    public function insertStatusKonsultasi($data)
    {
        return $this->db->insert('tm_status_konsultasi', $data);
    }

    public function updateStatusBangunan($id, $data)
    {
        return $this->db->where('id', $id)->update('tmdatabangunan', $data);
    }


    public function getByIdPtugasTPA($id){
		return $this->db->join('tm_tpa', 'tm_tpa.id = tm_penugasan_tpa.id')
		->get_where('tm_penugasan_tpa', array('id_pemilik' => $id));
	}

    
    public function cekDataBangunan($id)
    {
        $this->db->select('a.id as id_pemilik,c.id_jenis_bg,c.lama_proses,b.id_prov_bgn,b.luas_basement,b.lapis_basement,b.id_kabkot_bgn,b.id_izin,
        b.id_kec_bgn,b.id_jenis_permohonan,no_konsultasi,nm_pemilik,alamat,nm_konsultasi,almt_bgn,fungsi_bg,b.tipeA,b.luasA,b.lantaiA,b.tinggiA,b.jumlahA,b.luas_bgp,b.tinggi_bgp,
        b.status,b.id_klasifikasi,b.id_fungsi_bg,b.jml_lantai,h.nama_kabkota,
        i.nama_provinsi as nama_prov_pemilik,email,no_ktp,nm_bgn,
        e.nama_kecamatan,a.id_kecamatan,a.id_provinsi,a.id_kabkota,
        a.no_hp,b.id_prov_bgn,g.nama_kecamatan as nama_kec_bg,j.nama_kabkota as nama_kabkota_bg,k.nama_provinsi as nama_provinsi_bg,
        b.tgl_pernyataan,b.luas_bgn,b.tinggi_bgn,l.id_klasifikasi_bg,l.klasifikasi_bg,m.jns_prasarana');
        $this->db->from('tmdatapemilik a');
        $this->db->where('b.id', $id);
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
        $this->db->join('tr_prasarana m', 'm.idp = b.id_prasarana_bg', 'LEFT');
        $this->db->order_by('b.status', 'asc');
        $query = $this->db->get();
        return $query;
    }

    function getEmailPemohon($id=null)
	{
		$sql = "SELECT a.id,a.email,b.no_konsultasi ";
		$sql .= " FROM tmdatapemilik a 
					left join tmdatabangunan b on (a.id = b.id) 
					WHERE (1=1) AND a.email != '' ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id = '$id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function getEmailTpt($id=null)
	{
		$sql = "SELECT a.id_personal,b.email,b.nama_personal ";
		$sql .= " FROM tm_penugasan_pbg a 
					left join tm_personal b on (a.id_personal = b.id_personal) 
					WHERE (1=1) AND b.email != '' ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_pemilik = '$id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

	function getEmailTpa($id=null)
	{
		$sql = "SELECT a.id,b.email,b.nm_tpa ";
		$sql .= " FROM tm_penugasan_tpa a 
				left join tm_tpa b on (a.id = b.id) 
				WHERE (1=1) AND b.email != '' ";
		if ($id != null || trim($id) != '')  $sql .= " AND a.id_pemilik = '$id' ";
		$hasil  = $this->db->query($sql);
		return $hasil;
	}

    public function removeDataTpa($id)
	{
		$this->db->query("DELETE FROM tm_penugasan_tpa WHERE id_pemilik = $id");
		$this->db->query("DELETE FROM tm_penugasan_pbg WHERE id_pemilik = $id");
		$this->db->where('id',$id);
		return $query;
	}
    
}
