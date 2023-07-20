<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checklist_model extends CI_Model
{
    public function gethead($where)
    {
        $q = $this->db->get('t_checklist_head');
        return $q;
    }

    public function getmain($where)
    {
        $this->db->where($where);
        $q = $this->db->get('t_checklist_main');
        return $q;
    }

    public function getsub($where)
    {
        $this->db->where($where);
        $q = $this->db->get('t_checklist_sub');
        return $q;
    }

    public function getsubsub($where)
    {
        $this->db->where($where);
        $q = $this->db->get('t_checklist_sub_sub');
        return $q;
    }

    public function getdok($where)
    {
        $this->db->where($where);
        $q = $this->db->get('t_checklist_dokumen');
        return $q;
    }

    public function getfile($where)
    {
        $this->db->where($where);
        $q = $this->db->get('t_checklist_file');
        return $q;
    }

    public function deletefile($where)
    {
        $this->db->where($where);
        $q = $this->db->delete('t_checklist_file');
        return $q;
    }

    public function getdokwithfile($where)
    {
        $this->db->select('t_checklist_dokumen.*,t_checklist_file.id as id_file, t_checklist_file.id_permohonan, t_checklist_file.id_dokumen, t_checklist_file.nama_file, t_checklist_file.path, t_checklist_file.sesuai, t_checklist_file.catatan, t_checklist_file.poin_assesment, t_checklist_file.assesment_by');
        $this->db->from('t_checklist_dokumen');
        $this->db->join('t_checklist_file', 't_checklist_file.id_dokumen = t_checklist_dokumen.id', 'LEFT');
        $this->db->where($where);
        $q = $this->db->get();
        return $q;
    }
}
