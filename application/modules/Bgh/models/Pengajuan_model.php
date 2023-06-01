<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan_model extends CI_Model
{
    public function get($where = NULL)
    {
        $this->db->select('t_permohonan_bgh.*, tmdatapemilik.glr_depan,tmdatapemilik.glr_belakang, tmdatapemilik.nm_pemilik, t_klas_bangunan.klas, tmdatapemilik.no_hp,tmdatapemilik.no_ktp,tmdatapemilik.no_kitas, tmdatapemilik.alamat, tmdatapemilik.id_provinsi, tmdatapemilik.id_kabkota, tmdatapemilik.id_kecamatan, tmdatapemilik.id_kelurahan, tmdatapemilik.email, tmdatapemilik.unit_organisasi');
        $this->db->from('t_permohonan_bgh');
        $this->db->join('tmdatapemilik', 'tmdatapemilik.id = t_permohonan_bgh.id_pemilik', 'LEFT');
        $this->db->join('t_klas_bangunan', 't_permohonan_bgh.klas_bangunan = t_klas_bangunan.id', 'LEFT');
        $this->db->order_by('t_permohonan_bgh.id', 'DESC');
        if ($where != NULL) {
            $this->db->where($where);
        }
        $q = $this->db->get();
        return $q;
    }
}
