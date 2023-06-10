<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checklist_model extends CI_Model
{
    public function gethead()
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
}
