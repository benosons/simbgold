<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simbg_service extends CI_Controller {

	var $limit = 100;
	
	public function __construct()
    {
        parent::__construct();
		ini_set('memory_limit', "-1");
       	$this->load->helper('utility');	
       	$this->load->helper('language');	
       	$this->load->helper('bahasa');	
		$this->load->library('mypagination' ); 
		$this->load->library('QSecure' );
		$this->load->model('ServiceModel','Smodel');
		//Model//	
	}
	
	function temp_data_oss2()
	{
		$uri_segment = 3;
		$offset = 0;
		$SQLcari = "";
		$responses = array();
		$id_insert = "";
		$data_api_oss = json_decode(file_get_contents('php://input'), true);
		$result_data_oss = $data_api_oss;
		$jum_data_oss = count($result_data_oss);
		$data['jum_data_oss'] = count($result_data_oss);
		$data['results_data_oss'] = $result_data_oss;
		//End GET Data dari API OSS
		if($jum_data_oss > $offset){
			if($result_data_oss['dataNIB']['oss_id'] != '' || $result_data_oss['dataNIB']['oss_id'] != null){
				$query = $this->Smodel->get_oss_id($result_data_oss['dataNIB']['oss_id']);
				if ($query->num_rows() == 1)
				{
					$data = $query->row_array();
					$query2 = $this->Smodel->delete_data_oss($data['nib']);
					$id_insert = $data['update_oss_data_id'];
				}
			}
			$data_log = array (
				'oss_id' => $result_data_oss['dataNIB']['oss_id'],
				'nib' => $result_data_oss['dataNIB']['nib'],
				'kd_izin' => $result_data_oss['dataNIB']['kd_izin'],
				'status_badan_hukum' => $result_data_oss['dataNIB']['status_badan_hukum'],
				'status_penanaman_modal' => $result_data_oss['dataNIB']['status_penanaman_modal'],
				'npwp_perseroan' => $result_data_oss['dataNIB']['npwp_perseroan'],
				'nama_perseroan' => $result_data_oss['dataNIB']['nama_perseroan'],
				'alamat_perseroan' => $result_data_oss['dataNIB']['alamat_perseroan'],
				'rt_rw_perseroan' => $result_data_oss['dataNIB']['rt_rw_perseroan'],
				'kelurahan_perseroan' => $result_data_oss['dataNIB']['kelurahan_perseroan'],
				'perseroan_daerah_id' => $result_data_oss['dataNIB']['perseroan_daerah_id'],
				'kode_pos_perseroan' => $result_data_oss['dataNIB']['kode_pos_perseroan'],
				//'nomor_telepon_perseroan' => $result_data_oss['dataNIB']['nomor_telepon_perseroan'],
				'jenis_api' => $result_data_oss['dataNIB']['jenis_api'],
				'jenis_id_user_proses' => $result_data_oss['dataNIB']['jenis_id_user_proses'],
				'no_id_user_proses' => $result_data_oss['dataNIB']['no_id_user_proses'],
				'nama_user_proses' => $result_data_oss['dataNIB']['nama_user_proses'],
				'email_user_proses' => $result_data_oss['dataNIB']['email_user_proses'],
				'hp_user_proses' => $result_data_oss['dataNIB']['hp_user_proses'],
				'post_date'=>date('Y-m-d H:i:s')
			);
			$id_insert = $this->Smodel->InsertDataOss($data_log);
			
			if(count($result_data_oss['dataNIB']['data_proyek']) > 0 && ($id_insert != '' || $id_insert != null) ){
				for ($i=0;$i<count($result_data_oss['dataNIB']['data_proyek']);$i++) {
					$data_log_detail = array (
						'update_oss_data_id' => $id_insert,
						'nib' => $result_data_oss['dataNIB']['nib'],
						'kd_izin' => $result_data_oss['dataNIB']['data_checklist'][$i]['kd_izin'],
						'id_izin' => $result_data_oss['dataNIB']['data_checklist'][$i]['id_izin'],
						'post_date'=>date('Y-m-d H:i:s')
					);
					$id_insert_detail = $this->Smodel->insert_update_data_oss_detail($data_log_detail);
				}
			}
			
			if(count($result_data_oss['dataNIB']['data_checklist']) > 0 && ($id_insert != '' || $id_insert != null) ){
				for ($i=0;$i<count($result_data_oss['dataNIB']['data_checklist']);$i++) {
					$kd_izin = $result_data_oss['dataNIB']['data_checklist'][$i]['kd_izin'];
					$data_log_detail_checklist = array (
						'update_oss_data_id' => $id_insert,
						'nib' => $result_data_oss['dataNIB']['nib'],
						//'id_proyek' => $result_data_oss['dataNIB']['data_proyek'][$i]['id_proyek'],
						'id_proyek' => $result_data_oss['dataNIB']['data_checklist'][$i]['id_proyek'],
						'id_izin' => $result_data_oss['dataNIB']['data_checklist'][$i]['id_izin'],
						'kd_izin' => $result_data_oss['dataNIB']['data_checklist'][$i]['kd_izin'],
						
						//'kd_dokumen' => $result_data_oss['dataNIB']['data_checklist'][$i]['kd_dokumen'],
						//'nama_izin' => $result_data_oss['dataNIB']['data_checklist'][$i]['nama_izin'],
						//'instansi' => $result_data_oss['dataNIB']['data_checklist'][$i]['instansi'],
						//'flag_checklist' => $result_data_oss['dataNIB']['data_checklist'][$i]['flag_checklist'],
						'post_date'=>date('Y-m-d H:i:s')
					);
					if($kd_izin == "033000000001" || $kd_izin == "033000000007"){
						$this->Smodel->InsertDataOssChecklist($data_log_detail_checklist);
						//$this->mUpDat->InsertDataOssChecklist($data_log_detail_checklist);
					}
					
					$id_insert_detail = $this->Smodel->InsertDataOssChecklist($data_log_detail_checklist);
				}
			}
			$responses = array(
				'responreceiveNIB' => array(
						'status' => '1',
						'keterangan' => 'Data Berhasil di Input'
					)
			);
			}else{
				$responses = array(
					'responreceiveNIB' => array(
						'status' => '2',
						'keterangan' => 'Data Gagal di Input'
					)
				);
			}
			
		/*$responses['status'] = '1';
		}else{
			$responses['status'] = '2';
		}*/
		
		header("Content-type: application/json");
		echo json_encode($responses);
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */