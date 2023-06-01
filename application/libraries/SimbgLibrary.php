<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SimbgLibrary
{
    function __construct()
    {
        $this->ci = &get_Instance();
        $this->ci->load->database();
        $this->ci->load->model(['OSSAPI_Model' => 'apimodel']);
        $this->key = '09408a499b035c802668ffc95eac0091';
    }
    public function receiveSIMBG($id, $code, $tgl, $nip, $status, $keterangan)
    {
        $SendResponse = array();
        $key = $this->key;
        $test = "tester";
        if ($id !== NULL && $id !== '') {
            $getData = $this->ci->apimodel->getOSSData($id);
            if ($getData->num_rows() > 0) {
                $row = $getData->row();
                $dataSendResponse = array(
                    'no_konsultasi' => $row->no_konsultasi,
                    'id_proyek' => $test,
                    'oss_id' => $row->oss_id,
                    'id_izin' => $test,
                    'kd_izin' => $row->kd_izin,
                    'kd_instansi' => '033',
                    'kd_status' => $code,
                    'tgl_status' => $tgl,
                    'nip_status' => $nip,
                    'nama_status' => $status,
                    'keterangan' => $keterangan
                );
                $SendResponse['IZINSTATUS'] = $dataSendResponse;
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.pu.go.id/oss/staging/services/receiveSIMBG",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($dataSendResponse),
                    CURLOPT_HTTPHEADER => array(
                        "content-type: application/json",
                        "user_key: {$key}"
                    ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                    $output = [
                        'status' => false,
                        'msg' => "cURL Error #: {$err}"
                    ];
                } else {
                    $output = [
                        'status' => true,
                        'response' => $response
                    ];
                }
                return json_encode($output);
            } else {
                $output = [
                    'status' => false,
                    'msg' => 'Nomor Registrasi Tidak Terdaftar!'
                ];
                return json_encode($output);
            }
        } else {
            $output = [
                'status' => false,
                'msg' => 'Nomor Registrasi Tidak Terdaftar!'
            ];
            return json_encode($output);
        }
    }
}
