<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tpa_model extends CI_Model
{
    public function getdata($params)
    {
        $coloumns = ['id', 'id_user', 'nm_tpa', 'glr_depan', 'nip', 'nidn', 'jns_kelamin', 'tmpt_lahir', 'npwp', 'pangkat', 'golongan', 'jabatan', 'id_jabatan'];
        $this->db->select('*');
        $this->db->from('t_tpa');

        if (!empty($params['search']['value'])) {
            $searchValue = $params['search']['value'];
            $this->db->group_start();
            foreach ($columns as $column) {
                $this->db->or_like($column, $searchValue);
            }
            $this->db->group_end();
        }
        $this->db->where('status', 5);
        $totalRecords = $this->db->count_all_results('', false);

        $this->db->limit($params['length'], $params['start']);
        $this->db->order_by($columns[$params['order'][0]['column']]['id'], $params['order'][0]['dir']);

        
        // Execute the query
        $query = $this->db->get();

        // Format the data for DataTables
        $data = $query->result_array();

        return array(
            "draw" => intval($params['draw']),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalRecords),
            "data" => $data
        );
    }

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
