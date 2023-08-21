<?php


defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;
class Monitoring2 extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mmonitoring');
    }

    public function index_get()
    {
        $imb        = $this->Mmonitoring->getDataMonitoringIMB();
        $search     = $this->input->get('search');
        $provinsi   = $this->input->get('provinsi', TRUE);
        $kabkota    = $this->input->get('kabkota', TRUE);
        $kecamatan  = $this->input->get('kecamatan', TRUE);
        $filter = [
            'provinsi' => $provinsi,
            'kabkota' => $kabkota,
            'kecamatan' => $kecamatan,
        ];
        $filter = $this->search($filter);
        $response = [
            'status' => 200,
            'error' => false,
            'totalData' => isset($search) ? $filter['totalData'] : $imb->num_rows(),
            'data' => isset($search) ? $filter['query'] : $imb->result()
        ];
        $this->response($response);
    }

    private function search($filter)
    {
        if ($filter['provinsi'] != NULL && $filter['kabkota'] == NULL && $filter['kecamatan'] == NULL) {
            $query = $this->Mmonitoring->findProvincesWithoutKabkotaKecamatan($filter['provinsi']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($filter['provinsi'] == NULL && $filter['kabkota'] != NULL && $filter['kecamatan'] == NULL) {
            $query = $this->Mmonitoring->findKabkotaWithoutProvincesKecamatan($filter['kabkota']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($filter['provinsi'] == NULL && $filter['kabkota'] == NULL && $filter['kecamatan'] != NULL) {
            $query = $this->Mmonitoring->findKecamatanWithoutProvincesKabkota($filter['kecamatan']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($filter['provinsi'] != NULL && $filter['kabkota'] != NULL && $filter['kecamatan'] == NULL) {
            $query = $this->Mmonitoring->findProvincesAndKabkota($filter['provinsi'], $filter['kabkota']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($filter['provinsi'] != NULL && $filter['kabkota'] == NULL && $filter['kecamatan'] != NULL) {
            $query = $this->Mmonitoring->findProvincesAndKecamatan($filter['provinsi'], $filter['kecamatan']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($filter['provinsi'] == NULL && $filter['kabkota'] != NULL && $filter['kecamatan'] != NULL) {
            $query = $this->Mmonitoring->findKabkotaAndKecamatan($filter['kabkota'], $filter['kecamatan']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($filter['provinsi'] != NULL && $filter['kabkota'] != NULL && $filter['kecamatan'] != NULL) {
            $query = $this->Mmonitoring->findAllState($filter['provinsi'], $filter['kabkota'], $filter['kecamatan']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else {
            $result = 'data tidak ditemukan';
            $totalData = 0;
        }
        $data = [
            'query' => $result,
            'totalData' => $totalData,
        ];
        return $data;
    }

    public function PBG() 
    {
        $imb = $this->Mmonitoring->getDataMonitoringIMB();
        $response = [
            'status' => 200,
            'error' => false,
            'totalData' => isset($search) ? $filter['totalData'] : $imb->num_rows(),
            'data' => isset($search) ? $filter['query'] : $imb->result()
        ];
        $this->response($response);
    }
}

/* End of file Monitoring.php */
