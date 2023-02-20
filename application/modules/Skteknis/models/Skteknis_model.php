<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Skteknis_model extends CI_Model
{

    // SK TIM TPA

    public function get_sktpa_parent($id_kabkot = '')
    {
        $this->db->select('id_personal,nama_personal');
        if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('id_kota_tabg', $id_kabkot);
        //$this->db->where('stat', '1');
        $this->db->order_by('id_personal', 'asc');
        return $this->db->get('tm_personal');
    }

    public function get_sktpa_selected($id_skta)
    {
        $this->db->select('id_personal');
        $this->db->where('id_skta', $id_skta);
        return $this->db->get('tm_sktabgdetail');
    }

    public function getDataEditTimTPA($select = "*", $id)
    {
        $this->db->select($select, FALSE);
        $this->db->where('a.id_skta', $id);
        $query     = $this->db->get('tm_sktabg a')->row();
        return $query;
    }

    public function removeDataTimTPA($id_sk_tabg)
    {
        $this->db->where('id_skt', $id_sk_tabg);
        $query = $this->db->delete('tm_sktdetail');
        return $query;
    }

    public function removeDataPersyaratanPermohonan($id_skta)
    {
        $this->db->where('id_skta', $id_skta);
        $query = $this->db->delete('tm_sktabgdetail');
        return $query;
    }

    // END OF SK TIM TPA

    // SK TPT
    public function get_sktpt_parent($id_kabkot = '')
    {
        $this->db->select('id_personal,nama_personal');
        if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('id_kota_tabg', $id_kabkot);
        $this->db->where('stat', '1');
        $this->db->order_by('id_personal', 'asc');
        return $this->db->get('tm_personal');
    }


    public function get_sktpt_selected($id_sk_tabg)
    {
        $this->db->select('id_personal');
        $this->db->where('id_skt', $id_sk_tabg);
        return $this->db->get('tm_sktdetail');
    }


    public function getDataEditTPT($select = "*", $id)
    {
        $this->db->select($select, FALSE);
        $this->db->where('a.id_skt', $id);
        $query     = $this->db->get('tm_sk_timteknis a')->row();
        return $query;
    }
	
    public function removeDataTPT($id_sk_tabg)
    {

        $this->db->where('id_skt', $id_sk_tabg);
        $query = $this->db->delete('tm_sktdetail');
        return $query;
    }
    // END OF SK TPT
	//Begin SK Penilik
    public function get_sktpenilik_parent($id_kabkot = '')
    {
        $this->db->select('id_personal,nama_personal');
        if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('id_kota_tabg', $id_kabkot);
        $this->db->where('stat', '1');
        $this->db->order_by('id_personal', 'asc');
        return $this->db->get('tm_personal');
    }

    public function get_sktpenilik_selected($id_sk_tabg)
    {
        $this->db->select('id_personal');
        $this->db->where('id_skp', $id_sk_tabg);
        return $this->db->get('tm_skpdetail');
    }

    public function getDataEditPenilik($select = "*", $id)
    {
        $this->db->select($select, FALSE);
        $this->db->where('a.id_skp', $id);
        $query     = $this->db->get('tm_sk_timpenilik a')->row();
        return $query;
    }

    public function removeDataTPenilik($id_sk_tabg)
    {

        $this->db->where('id_skt', $id_sk_tabg);
        $query = $this->db->delete('tm_sktdetail');
        return $query;
    }
}

/* End of file sktpa_model.php */
