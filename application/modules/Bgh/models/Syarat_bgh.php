<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Syarat_bgh extends CI_Model
{
    public function get()
    {
        $q = $this->db->get('t_syarat_bgh');
        return $q;
    }
}
