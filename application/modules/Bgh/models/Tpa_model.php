<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tpa_model extends CI_Model
{
    public function get($where = NULL)
    {
        $this->db->select('t_tpa.*, tr_provinsi.nama_provinsi, tr_kabkot.nama_kabkota, tr_kecamatan.nama_kecamatan');
        $this->db->from('t_tpa');
        $this->db->join('tr_provinsi','tr_provinsi.id_provinsi = t_tpa.id_provinsi','LEFT');
        $this->db->join('tr_kabkot','tr_kabkot.id_kabkot = t_tpa.id_kabkot','LEFT');
        $this->db->join('tr_kecamatan','tr_kecamatan.id_kecamatan = t_tpa.id_kecamatan','LEFT');
        if ($where != NULL) {
            $this->db->where($where);
        }
        $q = $this->db->get();
        return $q;
    }
}
