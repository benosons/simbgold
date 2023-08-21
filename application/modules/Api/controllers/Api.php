<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct()
  	{
    	parent::__construct();
		ini_set('memory_limit', "-1");
		$this->load->model('Mmonitoring');
		$this->load->model('SS_Model');
		
  	}

	public function reports() 
    {
		$data['DataOSS'] 	= $this->Mmonitoring->reports_datoss();
		
		
		$data['contenheader']		=	'<h1>Dashboard</h1>';
		$data['title']		=	'Dashboard';
		$data['heading']	=	'Report & Statistic';
		$data['content'] = $this->load->view('reports_oss', $data, TRUE);
		
		$this->load->view('Dbai', $data);
	}
	
	private function getAuth($userName, $userKey)
    {
        $where = [
            'username' => $userName,
            'security_key' => $userKey
        ];
        $result = $this->SS_Model->getSecurityKey($where);
        return $result;
    }
	
	public function getDataPBGRow()
    {
        $username =  null;
		
		if(!empty($_GET['userName'])) {
			$username=$_GET['userName'];
		}
        $userkey =  null;
		if(!empty($_GET['userKey'])) {
			$userkey=$_GET['userKey'];
		}
		$pbg =  null;
		if(!empty($_GET['pbg'])) {
			$pbg=$_GET['pbg'];
		}
        $getAuh = $this->getAuth($username, $userkey);
        if ($getAuh->num_rows() > 0) {
            //$pbg = $this->uri->segment(4);
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
                header('Content-Type: application/json');
				echo json_encode($response);
            } else {
                $response = [
                    'status' => 404,
                    'error' => true,
                    'message' => 'Record Not Found!',
                ];
                //$this->response($response);
				header('Content-Type: application/json');
				echo json_encode($response);
            }
        } else {
            $response = [
                'status' => 401,
                'error' => true,
                'message' => 'Authentication failed',
				'username' => $username
            ];
            //$this->response($response);
			header('Content-Type: application/json');
			echo json_encode($response);
        }
    }
	
	public function getDataPBGAll()
    {
		$username =  null;
		if(!empty($_GET['userName'])) {
			$username=$_GET['userName'];
		}
        $userkey =  null;
		if(!empty($_GET['userKey'])) {
			$userkey=$_GET['userKey'];
		}
		
		$getAuh = $this->getAuth($username, $userkey);
		if ($getAuh->num_rows() > 0) {
			$cekDataBangunan = $this->SS_Model->getDataBangunanAll();
			$data = [];
			foreach ($cekDataBangunan->result() as $pbg) {
				$data[] = [
					'no_konsultasi' => $pbg->no_konsultasi,
                    'nm_pemilik' => $pbg->nm_pemilik,
                    'alamat_pemilik' => $pbg->alamat_pemilik,
                    'nm_konsultasi' => $pbg->nm_konsultasi,
                    'id_bgn' => $pbg->id_bgn,
                    'id_pemilik' => $pbg->id_pemilik,
                    'status' => $pbg->status,
                    'pernyataan' => $pbg->pernyataan,
                    'tahap_pbg' => $pbg->tahap_pbg,
                    'tgl_pernyataan' => $pbg->tgl_pernyataan,
                    'no_konsultasi' => $pbg->no_konsultasi,
                    'almt_bgn' => $pbg->almt_bgn,
                    'id_kel_bgn' => $pbg->id_kel_bgn,
                    'id_kec_bgn' => $pbg->id_kec_bgn,
                    'id_kabkot_bgn' => $pbg->id_kabkot_bgn,
                    'id_prov_bgn' => $pbg->id_prov_bgn,
                    'id_izin' => $pbg->id_izin,
                    'id_fungsi_bg' => $pbg->id_fungsi_bg,
                    'id_jns_bg' => $pbg->id_jns_bg,
                    'id_klasifikasi' => $pbg->id_klasifikasi,
					'nm_bgn' => $pbg->nm_bgn,
					'luas_bgn' => $pbg->luas_bgn,
					'tinggi_bgn' => $pbg->tinggi_bgn,
					'jml_lantai' => $pbg->jml_lantai,
					'id_jenis_permohonan' => $pbg->id_jenis_permohonan,
					'luas_basement' => $pbg->luas_basement,
					'lapis_basement' => $pbg->lapis_basement,
					'id_kolektif' => $pbg->id_kolektif,
					'tipeA' => $pbg->tipeA,
					'luasA' => $pbg->luasA,
					'lantaiA' => $pbg->lantaiA,
					'tinggiA' => $pbg->tinggiA,
					'jumlahA' => $pbg->jumlahA,
					'id_prasarana_bg' => $pbg->id_prasarana_bg,
					'luas_bgp' => $pbg->luas_bgp,
					'tinggi_bgp' => $pbg->tinggi_bgp,
					'id_doc_tek' => $pbg->id_doc_tek,
					'cetak_dok' => $pbg->cetak_dok
				];
			}
			$response = [
                    'status' => 200,
					'error' => false,
					'data' => $data
					
                ];
            header('Content-Type: application/json');
			echo json_encode($response);
			
		} else {
            $response = [
                'status' => 401,
                'error' => true,
                'message' => 'Authentication failed',
				'username' => $username
            ];
            //$this->response($response);
			header('Content-Type: application/json');
			echo json_encode($response);
        }
		
		
	}
	
	
}

