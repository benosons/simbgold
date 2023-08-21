<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class SimbgServices extends RestController
{
    public function __construct()
    {
        parent::__construct();
        ini_set('memory_limit', "-1");
        $this->load->library(['SimbgLibrary']);
        $this->load->model('SS_Model');
        // $this->key = $this->SimbgLibrary->authentication();
    }


    // authentication for API
    private function getAuth($userName, $userKey)
    {
        $where = [
            'username' => $userName,
            'security_key' => $userKey
        ];
        $result = $this->SS_Model->getSecurityKey($where);
        return $result;
    }



    public function getDataIMB_get()
    {
        $username =  $this->input->get_request_header('userName', TRUE);
        $userkey =  $this->input->get_request_header('userKey', TRUE);
        $getAuh = $this->getAuth($username, $userkey);
        if ($getAuh->num_rows() > 0) {
            $imb = $this->SS_Model->getDataMonitoringIMB();
            $state = intval($this->input->get('state', TRUE));
            $search = $this->input->get('search');
            $provinsi = $this->input->get('provinsi', TRUE);
            $kabkota = $this->input->get('kabkota', TRUE);
            $kecamatan = $this->input->get('kecamatan', TRUE);
            $jns_bgn = $this->input->get('jns_bgn', TRUE);
            $tgl_awal = $this->input->get('tgl_awal', TRUE);
            $tgl_akhir = $this->input->get('tgl_akhir', TRUE);
            $filter = [
                'provinsi' => $provinsi,
                'kabkota' => $kabkota,
                'kecamatan' => $kecamatan,
                'jns_bgn' => $jns_bgn,
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                'state' => $state
            ];
            $filter = $this->search($filter);
            $response = [
                'status' => 200,
                'error' => false,
                'totalData' => isset($search) ? $filter['totalData'] : $imb->num_rows(),
                'data' => isset($search) ? $filter['query'] : $imb->result()
            ];
            $this->response($response);
        } else {
            $response = [
                'status' => 401,
                'error' => true,
                'message' => 'Authentication failed'
            ];
            $this->response($response);
        }
    }

    public function getDataPBGRow_get()
    {
        $username   =  $this->input->get_request_header('userName', TRUE);
        $userkey    =  $this->input->get_request_header('userKey', TRUE);
        $getAuh     = $this->getAuth($username, $userkey);
        if ($getAuh->num_rows() > 0) {
            $pbg = $this->uri->segment(4);
            $cekDataBangunan = $this->SS_Model->getDataBangunan($pbg);
            if ($cekDataBangunan->num_rows() > 0) {
                $row = $cekDataBangunan->row();
                $response = [
                    'status' => 200,
                    'error' => false,
                    'no_konsultasi' => $row->no_konsultasi,
                    'nm_pemilik' => $row->nm_pemilik,
                    'fungsi_bg' => $row->fungsi_bg,
                    'almt_bgn' => $row->almt_bgn,
                    'nama_kec_bg' => $row->nama_kec_bg,
                    'nama_kabkota_bg' => $row->nama_kabkota_bg,
                    'nama_provinsi_bg' => $row->nama_provinsi_bg,
                    'nm_konsultasi' => $row->nm_konsultasi,
                    'alamat' => $row->alamat,
                    'nama_kecamatan' => $row->nama_kecamatan,
                    'nama_kabkota' => $row->nama_kabkota,
                    'nama_prov_pemilik' => $row->nama_prov_pemilik,
                    'almt_bgn' => $row->almt_bgn,
                    'nama_kec_bg' => $row->nama_kec_bg,
                    'nama_kabkota_bg' => $row->nama_kabkota_bg,
                    'nama_provinsi_bg' => $row->nama_provinsi_bg,
                    'fungsi_bg' => $row->fungsi_bg,
                    'luas_bgn' => $row->luas_bgn,
                    'tinggi_bgn' => $row->tinggi_bgn,
                    'jml_lantai' => $row->jml_lantai,
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'status' => 404,
                    'error' => true,
                    'message' => 'Record Not Found!',
                ];
                $this->response($response);
            }
        } else {
            $response = [
                'status' => 401,
                'error' => true,
                'message' => 'Authentication failed'
            ];
            $this->response($response);
        }
    }

    private function search($filter)
    {
        if ($filter['provinsi'] !== NULL && $filter['kabkota'] === NULL && $filter['kecamatan'] === NULL && $filter['jns_bgn'] === NULL) {
            $query = $this->SS_Model->findProvincesWithoutKabkotaKecamatan($filter['provinsi']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($filter['provinsi'] === NULL && $filter['kabkota'] !== NULL && $filter['kecamatan'] === NULL && $filter['jns_bgn'] === NULL) {
            $query = $this->SS_Model->findKabkotaWithoutProvincesKecamatan($filter['kabkota']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($filter['provinsi'] === NULL && $filter['kabkota'] === NULL && $filter['kecamatan'] !== NULL && $filter['jns_bgn'] === NULL) {
            $query = $this->SS_Model->findKecamatanWithoutProvincesKabkota($filter['kecamatan']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($filter['provinsi'] !== NULL && $filter['kabkota'] !== NULL && $filter['kecamatan'] === NULL && $filter['jns_bgn'] === NULL) {
            $query = $this->SS_Model->findProvincesAndKabkota($filter['provinsi'], $filter['kabkota']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($filter['provinsi'] !== NULL && $filter['kabkota'] === NULL && $filter['kecamatan'] !== NULL && $filter['jns_bgn'] === NULL) {
            $query = $this->SS_Model->findProvincesAndKecamatan($filter['provinsi'], $filter['kecamatan']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($filter['provinsi'] === NULL && $filter['kabkota'] !== NULL && $filter['kecamatan'] !== NULL && $filter['jns_bgn'] === NULL) {
            $query = $this->SS_Model->findKabkotaAndKecamatan($filter['kabkota'], $filter['kecamatan']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($filter['provinsi'] !== NULL && $filter['kabkota'] !== NULL && $filter['kecamatan'] !== NULL && $filter['jns_bgn'] === NULL) {
            $query = $this->SS_Model->findAllState($filter['provinsi'], $filter['kabkota'], $filter['kecamatan']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($filter['provinsi'] === NULL && $filter['kabkota'] === NULL && $filter['kecamatan'] === NULL && $filter['jns_bgn'] !== NULL) {
            $query = $this->SS_Model->findJenisBangunan($filter['jns_bgn']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($filter['provinsi'] === NULL && $filter['kabkota'] === NULL && $filter['kecamatan'] === NULL && $filter['jns_bgn'] === NULL) {
            $result = 'data tidak ditemukan';
            $totalData = 0;
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

    private function searchold($filter)
    {
        if ($filter['state'] !== NULL && $filter['state'] === 1) {
            $args = [
                'provinsi' => $filter['provinsi'],
                'kabkota' => $filter['kabkota'],
                'kecamatan' => $filter['kecamatan'],
            ];
            $result = $this->filterState($args);
        } else if ($filter['jns'] !== NULL  && $filter['jns'] === 1) {
            $args = [
                'jns_bgn' => $filter['jns_bgn'],
            ];
            $result = $this->filterJnsBgn($args);
        } else if ($filter['date'] !== NULL && $filter['date'] === 1) {
            $args = [
                'start_date' => $filter['tgl_awal'],
                'end_date' => $filter['tgl_akhir']
            ];
            $result = $this->filterDateRange($args);
        } else {
            $result = [
                'query' => 'Data tidak ditemukan!',
                'totalData' => 0
            ];
        }
        return $result;
    }

    private function filterState($args)
    {
        if ($args['provinsi'] !== NULL && $args['kabkota'] === NULL && $args['kecamatan'] === NULL) {
            $query = $this->SS_Model->findProvincesWithoutKabkotaKecamatan($args['provinsi']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($args['provinsi'] === NULL && $args['kabkota'] !== NULL && $args['kecamatan'] === NULL) {
            $query = $this->SS_Model->findKabkotaWithoutProvincesKecamatan($args['kabkota']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($args['provinsi'] === NULL && $args['kabkota'] === NULL && $args['kecamatan'] !== NULL) {
            $query = $this->SS_Model->findKecamatanWithoutProvincesKabkota($args['kecamatan']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($args['provinsi'] !== NULL && $args['kabkota'] !== NULL && $args['kecamatan'] === NULL) {
            $query = $this->SS_Model->findProvincesAndKabkota($args['provinsi'], $args['kabkota']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($args['provinsi'] !== NULL && $args['kabkota'] === NULL && $args['kecamatan'] !== NULL) {
            $query = $this->SS_Model->findProvincesAndKecamatan($args['provinsi'], $args['kecamatan']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($args['provinsi'] === NULL && $args['kabkota'] !== NULL && $args['kecamatan'] !== NULL) {
            $query = $this->SS_Model->findKabkotaAndKecamatan($args['kabkota'], $args['kecamatan']);
            $result = $query->result();
            $totalData = $query->num_rows();
        } else if ($args['provinsi'] !== NULL && $args['kabkota'] !== NULL && $args['kecamatan'] !== NULL) {
            $query = $this->SS_Model->findAllState($args['provinsi'], $args['kabkota'], $args['kecamatan']);
            $result = $query->result();
            $totalData = $query->num_rows();
        }
        $data = [
            'query' => $result,
            'totalData' => $totalData,
        ];
        return $data;
    }

    private function filterJnsBgn($args)
    {
        $query = $this->SS_Model->findJenisBangunan($args['jns_bgn']);
        $result = $query->result();
        $totalData = $query->num_rows();
        $data = [
            'query' => $result,
            'totalData' => $totalData,
        ];
        return $data;
    }

    private function filterDateRange($args)
    {
        $query = $this->SS_Model->findDateRange($args['start_date'], $args['end_date']);
        $result = $query->result();
        $totalData = $query->num_rows();
        $data = [
            'query' => $result,
            'totalData' => $totalData,
        ];
        return $data;
    }

    public function getKey_get()
    {
        $res =  $this->input->get_request_header('userKey', TRUE);
        $output = [
            'key' => $res
        ];
        echo json_encode($output);
    }
}

/* End of file SimbgApi.php */
