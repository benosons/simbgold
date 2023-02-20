<?php


defined('BASEPATH') or exit('No direct script access allowed');

class OSSAPI_Model extends CI_Model
{
    public function getOSSData($id)
    {
        $this->db->select('a.id,a.no_konsultasi,a.nib,a.update_oss_data_id_detail,c.oss_id,b.kd_izin');
        $this->db->from('tmdatabangunan a');
        $this->db->join('tm_data_oss_detail b', 'b.nib = a.nib AND b.kd_izin=a.kd_izin', 'left');
        if (trim($id) != '' && $id != null) $this->db->where('a.id', $id);
        $this->db->join('tm_data_oss c', 'c.update_oss_data_id = b.update_oss_data_id', 'left');
        return $this->db->get();
    }

}

/* End of file OSSAPI_Model.php */
