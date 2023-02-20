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
        $username =  $this->input->get_request_header('userName', TRUE);
        $userkey =  $this->input->get_request_header('userKey', TRUE);
        $getAuh = $this->getAuth($username, $userkey);
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

    public function receiveDataOSS_post()
    {
        $username =  $this->input->get_request_header('userName', TRUE);
        $userkey =  $this->input->get_request_header('userKey', TRUE);
        $id_insert = '';
        $getAuh = $this->getAuth($username, $userkey);
        if ($getAuh->num_rows() > 0) {
            $responses = [];
            $getInputData = json_decode(file_get_contents('php://input'), true);
            if ($getInputData !== NULL) {
                if ($getInputData['dataNIB']['oss_id'] != '' || $getInputData['dataNIB']['oss_id'] != null) {
                    $query = $this->SS_Model->getOSSID($getInputData['dataNIB']['oss_id']);
                    if ($query->num_rows() > 0) {
                        $row = $query->row();
                        $id_insert = $row->update_oss_data_id;
                    }
                }
                $dataOSS = [
                    'oss_id' => $getInputData['dataNIB']['oss_id'],
                    'nib' => $getInputData['dataNIB']['nib'],
                    'kd_izin' => $getInputData['dataNIB']['kd_izin'],
                    'status_badan_hukum' => $getInputData['dataNIB']['status_badan_hukum'],
                    'status_penanaman_modal' => $getInputData['dataNIB']['status_penanaman_modal'],
                    'npwp_perseroan' => $getInputData['dataNIB']['npwp_perseroan'],
                    'nama_perseroan' => $getInputData['dataNIB']['nama_perseroan'],
                    'alamat_perseroan' => $getInputData['dataNIB']['alamat_perseroan'],
                    'rt_rw_perseroan' => $getInputData['dataNIB']['rt_rw_perseroan'],
                    'kelurahan_perseroan' => $getInputData['dataNIB']['kelurahan_perseroan'],
                    'perseroan_daerah_id' => $getInputData['dataNIB']['perseroan_daerah_id'],
                    'kode_pos_perseroan' => $getInputData['dataNIB']['kode_pos_perseroan'],
                    'jenis_api' => $getInputData['dataNIB']['jenis_api'],
                    'jenis_id_user_proses' => $getInputData['dataNIB']['jenis_id_user_proses'],
                    'no_id_user_proses' => $getInputData['dataNIB']['no_id_user_proses'],
                    'nama_user_proses' => $getInputData['dataNIB']['nama_user_proses'],
                    'email_user_proses' => $getInputData['dataNIB']['email_user_proses'],
                    'hp_user_proses' => $getInputData['dataNIB']['hp_user_proses'],
                    'post_date' => date('Y-m-d')
                ];
                $this->SS_Model->insertDataOSS($dataOSS);
                if (count($getInputData['dataNIB']['data_proyek']) > 0 && ($id_insert != '' || $id_insert != null)) {
                    for ($i = 0; $i < count($getInputData['dataNIB']['data_proyek']); $i++) {
                        $detailOSS = [
                            'update_oss_data_id' => $id_insert,
                            'nib' => $getInputData['dataNIB']['nib'],
                            'kd_izin' => $getInputData['dataNIB']['data_checklist'][$i]['kd_izin'],
                            'id_izin' => $getInputData['dataNIB']['data_checklist'][$i]['id_izin'],
                            'post_date' => date('Y-m-d H:i:s')
                        ];
                        $this->SS_Model->insertUpdateDataOSSDetail($detailOSS);
                    }
                }
                if (isset($getInputData['dataNIB']['legalitas'])) {
                    if (count($getInputData['dataNIB']['legalitas']) > 0 && ($id_insert != '' || $id_insert != null)) {
                        for ($i = 0; $i < count($getInputData['dataNIB']['legalitas']); $i++) {
                            $data_legalitas = [
                                'update_oss_data_id' => $id_insert,
                                'jenis_legal' => $getInputData['dataNIB']['legalitas'][$i]['jenis_legal'],
                                'no_legal' => $getInputData['dataNIB']['legalitas'][$i]['no_legal'],
                                'tgl_legal' => $getInputData['dataNIB']['legalitas'][$i]['tgl_legal'],
                                'post_date' => date('Y-m-d H:i:s')
                            ];
                            $this->SS_Model->insertDataOSSLegalitas($data_legalitas);
                        }
                    }
                }
                if (isset($getInputData['dataNIB']['data_lokasi_proyek'])) {
                    if (count($getInputData['dataNIB']['data_lokasi_proyek']) > 0 && ($id_insert != '' || $id_insert != null)) {
                        for ($i = 0; $i < count($getInputData['dataNIB']['legalitas']); $i++) {
                            $data_lokasi_proyek = [
                                'update_oss_data_id' => $id_insert,
                                'id_proyek_lokasi' => $getInputData['dataNIB']['data_lokasi_proyek'][$i]['id_proyek_lokasi'],
                                'proyek_daerah_id' => $getInputData['dataNIB']['data_lokasi_proyek'][$i]['proyek_daerah_id'],
                                'kd_kawasan' => $getInputData['dataNIB']['data_lokasi_proyek'][$i]['kd_kawasan'],
                                'jenis_kegiatan' => $getInputData['dataNIB']['data_lokasi_proyek'][$i]['jenis_kegiatan'],
                                'jenis_lokasi' => $getInputData['dataNIB']['data_lokasi_proyek'][$i]['jenis_lokasi'],
                                'status_lokasi' => $getInputData['dataNIB']['data_lokasi_proyek'][$i]['status_lokasi'],
                                'post_date' => date('Y-m-d H:i:s')
                            ];
                            $this->SS_Model->insertDataOSSLokasiProyek($data_lokasi_proyek);
                        }
                    }
                }
                if (count($getInputData['dataNIB']['data_checklist']) > 0 && ($id_insert != '' || $id_insert != null)) {
                    for ($i = 0; $i < count($getInputData['dataNIB']['data_checklist']); $i++) {
                        $kd_izin = $getInputData['dataNIB']['data_checklist'][$i]['kd_izin'];
                        $data_log_detail_checklist = [
                            'update_oss_data_id' => $id_insert,
                            'nib' => $getInputData['dataNIB']['nib'],
                            'id_izin' => $getInputData['dataNIB']['data_checklist'][$i]['id_izin'],
                            'kd_izin' => $getInputData['dataNIB']['data_checklist'][$i]['kd_izin'],
                            'post_date' => date('Y-m-d H:i:s')
                        ];
                        if ($kd_izin == "033000000001" || $kd_izin == "033000000007") {
                            $this->SS_Model->InsertDataOssChecklist($data_log_detail_checklist);
                        }
                        $this->SS_Model->InsertDataOssChecklist($data_log_detail_checklist);
                    }
                }
                $responses = [
                    'responreceiveNIB' => [
                        'status' => '1',
                        'keterangan' => 'Data Berhasil di Input'
                    ]
                ];
            } else {
                $responses = [
                    'responreceiveNIB' => [
                        'status' => '2',
                        'keterangan' => 'Data Gagal di Input'
                    ]
                ];
            }
            header("Content-type: application/json");
            echo json_encode($responses);
        } else {
            $response = [
                'status' => 401,
                'error' => true,
                'message' => 'Authentication failed'
            ];
            $this->response($response);
        }
    }

    
}

/* End of file SimbgApi.php */
