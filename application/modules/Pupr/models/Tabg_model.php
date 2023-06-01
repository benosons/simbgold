<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Tabg_model extends CI_Model
{

    public function get_tabg_parent($id_kabkot = '')
    {
        $this->db->select('id_personal,nama_personal');
        if ($id_kabkot != null || trim($id_kabkot) != '')  $this->db->where('id_kota_tabg', $id_kabkot);
        //$this->db->where('stat', '1');
        $this->db->order_by('id_personal', 'asc');
        return $this->db->get('tm_personal');
    }

    public function get_tabg_selected($id_skta)
    {
        $this->db->select('id_personal');
        $this->db->where('id_skta', $id_skta);
        return $this->db->get('tm_sktabgdetail');
    }

    public function getDataEditTimTABG($select = "*", $id)
    {
        $this->db->select($select, FALSE);
        $this->db->where('a.id_skta', $id);
        $query     = $this->db->get('tm_sktabg a')->row();
        return $query;
    }

    public function removeDataPersyaratanPermohonan($id_skta)
	{

		$this->db->where('id_skta', $id_skta);
		$query = $this->db->delete('tm_sktabgdetail');
		return $query;
	}
}

/* End of file Tabg_model.php */
