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

    public function insertpermohonan($data)
    {
        $this->db->insert('t_permohonan_bgh', $data);
        return $this->db->insert_id();
    }

    public function updatepermohonan($data, $where)
    {
        $this->db->where($where);
        $query = $this->db->update('t_permohonan_bgh', $data);
        return $where['id'];
    }
    

    public function updatestep($data, $where)
    {
        $this->db->where($where);
        $update = $this->db->update('t_permohonan_bgh', $data);
        return $update;
    }


    public function insertdatapemilik($data)
    {
        $this->db->insert('tmdatapemilik', $data);
        return $this->db->insert_id();
    }

    public function updatedatapemilik($data, $where)
    {
        $this->db->where($where);
        $query = $this->db->update('tmdatapemilik', $data);
        return $where['id'];
    }

    public function insertdokbgh($data)
    {
        $query = $this->db->insert('t_data_file', $data);
        return $query;
    }

    public function getfilebgh($where)
    {
        $this->db->where($where);
        $query = $this->db->get('t_data_file');
        return $query;
    }

    public function deletefilebgh($where)
    {
        $this->db->where($where);
        $query = $this->db->delete('t_data_file');
        return $query;
    }

    public function getfilearsitektur($where)
    {
        $this->db->where($where);
        $query = $this->db->get('t_data_file_ars');
        return $query;
    }
    public function insertdokars($data)
    {
        $query = $this->db->insert('t_data_file_ars', $data);
        return $query;
    }

    public function deletefilears($where)
    {
        $this->db->where($where);
        $query = $this->db->delete('t_data_file_ars');
        return $query;
    }

    public function getfilestruktur($where)
    {
        $this->db->where($where);
        $query = $this->db->get('t_data_file_struktur');
        return $query;
    }
    public function insertdokstruktur($data)
    {
        $query = $this->db->insert('t_data_file_struktur', $data);
        return $query;
    }

    public function deletefilestruktur($where)
    {
        $this->db->where($where);
        $query = $this->db->delete('t_data_file_struktur');
    }

    public function getfilemep($where)
    {
        $this->db->where($where);
        $query = $this->db->get('t_data_file_mep');
        return $query;
    }
    public function insertdokmep($data)
    {
        $query = $this->db->insert('t_data_file_mep', $data);
        return $query;
    }

    public function deletefilemep($where)
    {
        $this->db->where($where);
        $query = $this->db->delete('t_data_file_mep');
    }
}
