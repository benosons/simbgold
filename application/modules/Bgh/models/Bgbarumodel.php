<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bgbarumodel extends CI_Model
{
    public function get($where = NULL)
    {
        $this->db->select('t_permohonan_bgh.*, tmdatapemilik.id as id_pemilik, tmdatapemilik.glr_depan,tmdatapemilik.glr_belakang, tmdatapemilik.nm_pemilik, t_klas_bangunan.klas, tmdatapemilik.no_hp,tmdatapemilik.no_ktp,tmdatapemilik.no_kitas, tmdatapemilik.alamat, tmdatapemilik.id_provinsi, tmdatapemilik.id_kabkota, tmdatapemilik.id_kecamatan, tmdatapemilik.id_kelurahan, tmdatapemilik.email, tmdatapemilik.unit_organisasi');
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

    public function getdata($length, $start, $search = null)
    {
        // $where = '';

        // if ($role != 10) {

        //     $where = " where $param.create_by = '$userid'";

        //     if ($role == '20') {
        //         $where .= " or bagian = '$username'";
        //     }
        // } else {

        //     if ($param == 'data_profile') {
        //         $where = " where $param.create_by = '$userid'";
        //     }else if($param == 'data_text'){
        //         $where = " where $param.create_by = '$userid'";
        //     }else if($param == 'data_laporan'){
        //         $where = " where $param.create_by = '$userid'";
        //     }else if($param == 'data_nspk'){

        //     }
        // }

        // if ($datable == null) {
        //     if($param == 'data_buletin'){
        //         $ord = "order by STR_TO_DATE( CONCAT_WS('/', bulan, '1',tahun), '%m/%d/%Y') desc ";
        //         $join = 1;
        //     }
        //     if($param == 'data_gempa'){
        //         $ord = "order by STR_TO_DATE( CONCAT_WS('/', '1', '1',tahun), '%m/%d/%Y') desc";
        //         $join = 1;
        //     }
        //     if($param == 'data_nspk'){
        //         $ord = "order by STR_TO_DATE( CONCAT_WS('/', '1', '1',tahun), '%m/%d/%Y') desc";
        //         $join = 1;
        //     }
        //     if($param == 'data_jurnal'){
        //         $ord = "order by STR_TO_DATE( CONCAT_WS('/', bulan_terbit, '1',tahun_terbit), '%m/%d/%Y') desc";
        //         $join = 1;
        //     }

        //     if($join){
        //         $jo = "join muser on muser.id = $param.create_by";
        //     }

        //     $query = $this->db->query("select $param.* from $param $jo $where $ord ")->result();
        // } else {
        //     if ($param == 'data_berita') {
        //         $satker = $this->input->post('satker');
        //         $bulan = $this->input->post('bulan') < 10 ? str_replace(0, '', $this->input->post('bulan')) : $this->input->post('bulan') ;
        //         $tahun = $this->input->post('tahun');
        //         if ($this->input->post('satker')) {
        //             $where = " where bagian = '$satker'";
        //         }

        //         if ($this->input->post('bulan')) {
        //             if (!empty($satker)) {
        //                 $where .= " AND MONTH(STR_TO_DATE(date, '%m/%d/%Y')) = '$bulan'";
        //             }else{
        //                 $where = " where MONTH(STR_TO_DATE(date, '%m/%d/%Y')) = '$bulan'";
        //             }
        //         }
        //         if ($this->input->post('tahun')) {
        //             if (!empty($satker) || !empty($bulan)) {
        //                 $where .= " AND YEAR(STR_TO_DATE(date, '%m/%d/%Y')) = '$tahun'";
        //             }else{
        //                 $where = " where YEAR(STR_TO_DATE(date, '%m/%d/%Y')) = '$tahun'";
        //             }
        //         }
        //         if($sat){
        //             if($where){
        //                 $where .= " and create_by != '$userid' and bagian = '0'";
        //             }else{
        //                 $where = " where create_by != '$userid' and bagian = '0'";
        //             }
        //         }else{
        //             if($where){
        //                 if($role != 10){
        //                     $where .= "";
        //                 }else{
        //                     $where .= " and bagian != '0' or create_by = '$userid'";
        //                 }
        //             }else{
        //                 $where = " where bagian != '0' or create_by = '$userid'";
        //             }
        //         }

        //         $query = $this->db->query("select *, STR_TO_DATE(date, '%m/%d/%Y') newdate from $param $where order by STR_TO_DATE(date, '%m/%d/%Y') desc LIMIT " . $length . " OFFSET " . $start)->result();
        //     }else if ($param == 'data_laporan') {

        //         $satker = $this->input->post('satker');
        //         $bulan = $this->input->post('bulan') < 10 ? str_replace(0, '', $this->input->post('bulan')) : $this->input->post('bulan') ;
        //         $tahun = $this->input->post('tahun');
        //         if ($this->input->post('satker')) {
        //             $where = " where bagian = '$satker'";
        //         }

        //         if ($this->input->post('bulan')) {
        //             if (!empty($satker)) {
        //                 $where .= " AND MONTH(STR_TO_DATE(tanggal, '%m/%d/%Y')) = '$bulan'";
        //             }else{
        //                 $where = " where MONTH(STR_TO_DATE(tanggal, '%m/%d/%Y')) = '$bulan'";
        //             }
        //         }
        //         if ($this->input->post('tahun')) {
        //             if (!empty($satker) || !empty($bulan)) {
        //                 $where .= " AND YEAR(STR_TO_DATE(tanggal, '%m/%d/%Y')) = '$tahun'";
        //             }else{
        //                 $where = " where YEAR(STR_TO_DATE(tanggal, '%m/%d/%Y')) = '$tahun'";
        //             }
        //         }
        //         if($sat){
        //             if($where){
        //                 $where .= " and create_by != '$userid' and bagian = '0'";
        //             }else{
        //                 $where = " where create_by != '$userid' and bagian = '0'";
        //             }
        //         }else{
        //             if($where){
        //                 if($role != 10){
        //                     $where .= "";
        //                 }else{
        //                     $where .= " and bagian != '0' or create_by = '$userid'";
        //                 }
        //             }else{
        //                 $where = " where bagian != '0' or create_by = '$userid'";
        //             }
        //         }

        //         $query = $this->db->query("select * from $param $where order by tahun desc LIMIT " . $length . " OFFSET " . $start)->result();
        //     }else{
        //         $query = $this->db->query("select * from $param $where order by id desc LIMIT " . $length . " OFFSET " . $start)->result();
        //     }
        // }
        $query = $this->db->query("select * from t_permohonan_bgh order by id desc LIMIT " . $length . " OFFSET " . $start)->result();
        return $query;
    }

    public function countall()
    {
        $this->db->select("*");
        $this->db->from('t_permohonan_bgh');
        // if($sat){
        //     $where = "create_by != '$userid' and bagian = '0'";
        // }else{
        //     $where = "bagian != '0' or create_by = '$userid'";
        // }
        // $this->db->where($where);
        $query = $this->db->get();
        return $query->num_rows();
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

    public function savingupload($data)
    {
        return $this->db->insert('t_checklist_file',$data);
    }
}
