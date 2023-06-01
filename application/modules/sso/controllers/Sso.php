<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sso extends CI_Controller {
	public function __construct()
  {
    parent::__construct();
		ini_set('memory_limit', "-1");
		$this->ci =& get_Instance();
		$this->load->model('sso_model','somod');
		$this->load->library('Oss_lib');
	}

	public function receive_token()
	{
		$this->load->helper('url');
		$responses = array();
		$access_token = $this->input->get('access-token', TRUE);
		$refresh_token = $this->input->get('refresh-token', TRUE);
		$kd_izin = $this->input->get('kd_izin', TRUE);
		$id_izin = $this->input->get('id_izin', TRUE);
		
		

		if ($access_token != null) {
			$getValidasi = $this->validate_token($access_token);
			
			
			if($getValidasi['status'] == 200){
				
				$data = array (
					'access_token' => $access_token,
					'refresh_token' => $refresh_token,
					'kd_izin' => $kd_izin,
					'id_izin' => $id_izin,
					'expired_aToken' => $getValidasi['expired_aToken'],
					'post_date'=>date('Y-m-d H:i:s')
				);
			
				$id_insert_token = $this->somod->insert_data_token($data);
				
				
				$getUserInfo = $this->userinfo_token($access_token);
				$chekUsername = $this->check_username($getUserInfo);
				if($chekUsername['status']== 2){
					$insertUsername = $this->insert_username($getUserInfo);
					if($insertUsername['status']== 1){
						//login dulu
						$dataLogin	= array(
						'loc_user_id' => $this->Outh_model->Encryptor('encrypt', $insertUsername['user_id']),
						'loc_role_id' => $insertUsername['role_id'],
						'loc_email' => $insertUsername['email'],
						'loc_username' => $insertUsername['username'],
						'loc_login' => TRUE
						);
						$this->session->set_userdata($dataLogin);
						//end login
						
						$inqueryNIB = $this->inqueryNIB($getUserInfo['data']['data_nib']['0']);
						$insertDataPemilik = $this->insert_data_pemilik($id_izin,$kd_izin,$insertUsername['user_id'],$inqueryNIB);
						if($insertDataPemilik['status']== 1){
							
							redirect('KonsultasiOSS/FormPendaftaran/' . $this->secure->encrypt_url($insertDataPemilik['id_datapemilik']));
						}	
					}
				}else{
					$chekPermohonan = $this->check_permohonan($id_izin,$chekUsername['user_id']);
					if($chekPermohonan['status']== 2){
						$inqueryNIB = $this->inqueryNIB($getUserInfo['data']['data_nib']['0']);
						$insertDataPemilik = $this->insert_data_pemilik($id_izin,$kd_izin,$chekUsername['user_id'],$inqueryNIB);	
						if($insertDataPemilik['status']== 1){
							
							//login dulu
							$dataLogin	= array(
								'loc_user_id' => $this->Outh_model->Encryptor('encrypt', $chekUsername['user_id']),
								'loc_role_id' => $chekUsername['role_id'],
								'loc_email' => $chekUsername['email'],
								'loc_username' => $chekUsername['username'],
								'loc_login' => TRUE
							);
							$this->session->set_userdata($dataLogin);
							//end login
							redirect('KonsultasiOSS/FormPendaftaran/' . $this->secure->encrypt_url($insertDataPemilik['id_datapemilik']));	
						}
					}else{
						//login dulu
						$dataLogin	= array(
							'loc_user_id' => $this->Outh_model->Encryptor('encrypt', $chekUsername['user_id']),
							'loc_role_id' => $chekUsername['role_id'],
							'loc_email' => $chekUsername['email'],
							'loc_username' => $chekUsername['username'],
							'loc_login' => TRUE
						);
						$this->session->set_userdata($dataLogin);
						//end login
						redirect('KonsultasiOSS');
					}
				}
				
			}else{
				
				header("Content-type: application/json");
				echo json_encode($getValidasi);
			}
			

			
		}else{
			$responses['status'] = '400';
			$responses['message'] = 'Data Parameter Salah';

			header("Content-type: application/json");
			echo json_encode($responses);
		}

		
		
	}
	
	public function receive_token_2()
	{
		$offset = 0;
		$responses = array();
		$data_token = json_decode(file_get_contents('php://input'), true);
		if (json_last_error()) {
    	$responses['status'] = '403';
			$responses['message'] = 'Ilegal Inquery /Akses';
		}else{
			$result_data_token = $data_token;
			$jum_data_token = count($result_data_token);
			//$access_token = $this->input->get('access-token', TRUE);
			//$refresh_token = $this->input->get('refresh-token', TRUE);
			//$kd_izin = $this->input->get('kd_izin', TRUE);
			//$id_izin = $this->input->get('id_izin', TRUE);
			if($jum_data_token > $offset){
			
				//buat nanti
				//$getValidasi = $this->validate_token($result_data_token['access-token']);
			
				/* INI UNTUK SEMENTARA, DI SIMPAN DULU DI DATABASE */
				$data = array (
					'access_token' => $result_data_token['access-token'],
					'refresh_token' => $result_data_token['refresh-token'],
					'kd_izin' => $result_data_token['kd_izin'],
					'id_izin' => $result_data_token['id_izin'],
					'post_date'=>date('Y-m-d H:i:s')
				);
			
				$id_insert = $this->somod->insert_data_token($data);
				/* SAMPAI DI SINI */
			
			
				$responses['status'] = '200';
				$responses['message'] = 'success';

			}else{
				$responses['status'] = '400';
				$responses['message'] = 'Data Parameter Salah';
			}
			
		}
		header("Content-type: application/json");
		echo json_encode($responses);
		
	}
	
	public function validate_token($access_token)
	{
		
		$curl = curl_init();
		
		//$user_key = "38d7c8b071fcd41ff0e9a17398fdcee5";


		$Feedback['access-token'] = $access_token;
		
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.pu.go.id/oss/prod/services/sso/validateToken",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($Feedback),
			CURLOPT_HTTPHEADER => array(
				'user_key: b0f56f5e679f9406bafd1100ab8cf5fb',
				"Authorization: Bearer ".$access_token
			),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		

		curl_close($curl);
		
		$result = json_decode($response, true);
		
		
		if ($err) {
			//$kode = "400";
			//$keterangan = print_r($response);
			//$this->oss_lib->log_sso($action,$nib,$id_izin,$kd_izin,$kode,$keterangan);
			return "cURL Error #:" . $err;
		} else {
			
			//$kode = "200";
			//$keterangan = "SUKSES";
			//$this->oss_lib->log_sso($action,$nib,$id_izin,$kd_izin,$kode,$keterangan);
			//echo $getValidasi['status'];
			
			return $result;
		}
		
		
	}

	
	
	public function userinfo_token($access_token)
	{
		$action = "userinfoToken";
		$nib = "";
		$id_izin = "";
		$kd_izin = "";
		
		$curl = curl_init();
		
		//$user_key = "";
		$Feedback['access-token'] = $access_token;

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.pu.go.id/oss/prod/services/sso/userinfoToken",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($Feedback),
			CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer ".$access_token,
				'user_key: b0f56f5e679f9406bafd1100ab8cf5fb'
			),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		
		$result = json_decode($response, true);
		
		
		if ($err) {
			//$kode = "400";
			//$keterangan = print_r($response);
			//$this->oss_lib->log_sso($action,$nib,$id_izin,$kd_izin,$kode,$keterangan);
			return "cURL Error #:" . $err;
		} else {
			//$kode = "200";
			//$keterangan = "SUKSES";
			//$this->oss_lib->log_sso($action,$nib,$id_izin,$kd_izin,$kode,$keterangan);
			return $result;
		}
		
		
	}
	
	public function login_oss($username,$password)
	{
		
		
	}
	
	public function update_token($refresh_token)
	{
		$curl = curl_init();
		
		$user_key = "";
		
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.pu.go.id/oss/prod/services/sso/users/update-token",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "",
			CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer ".$refresh_token,
				"user_key : ".$user_key
			),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		
		$result = json_decode($response, true);
		if ($err) {
			return "cURL Error #:" . $err;
		} else {
			return $result;
		}
		
	}
	
	public function revoke_token($access_token)
	{
		$curl = curl_init();
		
		$user_key = "";
		
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.pu.go.id/oss/prod/services/sso/users/revoke-token",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "",
			CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer ".$access_token,
				"user_key : ".$user_key
			),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		
		$result = json_decode($response, true);
		if ($err) {
			return "cURL Error #:" . $err;
		} else {
			return $result;
		}
		
	}
	
	public function inqueryNIB($nib)
	{
		$action = "inqueryNIB";
		$id_izin = "";
		$kd_izin = "";
		
		$curl = curl_init();
		
		$no_nib['nib'] = $nib;
		$Feedback['INQUERYNIB'] = $no_nib;

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.pu.go.id/oss/prod/services/inqueryNIB",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($Feedback),
			CURLOPT_HTTPHEADER => array(
				'user_key: b0f56f5e679f9406bafd1100ab8cf5fb'
			),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		
		$result = json_decode($response, true);
		if ($err) {
			//$kode = "400";
			//$keterangan = print_r($response);
			//$this->oss_lib->log_sso($action,$nib,$id_izin,$kd_izin,$kode,$keterangan);
			return "cURL Error #:" . $err;
		} else {
			//$kode = "200";
			//$keterangan = "SUKSES";
			//$this->oss_lib->log_sso($action,$nib,$id_izin,$kd_izin,$kode,$keterangan);
			return $result;
		}
		
	}
	
	public function checkLicenseStatus($id_izin1)
	{
		$action = "checkLicenseStatus";
		$nib = "";
		$kd_izin = "";
		
		$curl = curl_init();
		
		$id_izin['id_izin'] = $id_izin1;
		$Feedback['CHECKLICENSESTATUS'] = $id_izin;

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.pu.go.id/oss/prod/services/checkLicenseStatus",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($Feedback),
			CURLOPT_HTTPHEADER => array(
				'user_key: b0f56f5e679f9406bafd1100ab8cf5fb'
			),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		
		$result = json_decode($response, true);
		if ($err) {
			//$kode = "400";
			//$keterangan = print_r($response);
			//$this->oss_lib->log_sso($action,$nib,$id_izin,$kd_izin,$kode,$keterangan);
			return "cURL Error #:" . $err;
		} else {
			//$kode = "200";
			//$keterangan = "SUKSES";
			//$this->oss_lib->log_sso($action,$nib,$id_izin,$kd_izin,$kode,$keterangan);
			return $result;
		}
		
	}
	
	public function check_username($getUserInfo)
	{
		$responses = array();
		
		$query = $this->somod->get_username($getUserInfo['data']['username'],$getUserInfo['data']['data_nib']['0']);
		if ($query->num_rows() == 1)
		{
			$data = $query->row_array();
			$user_id = $data['id'];
			$role_id = $data['role_id'];
			$email = $data['email'];
			$username = $data['username'];
			$responses['status'] = '1';
			$responses['user_id'] = $user_id;
			$responses['role_id'] = $role_id;
			$responses['username'] = $username;
			$responses['email'] = $email;
		}else{
			$responses['status'] = '2';
			$responses['user_id'] = null;
		}

		return $responses;		
	}
	
	public function insert_username($getUserInfo)
	{
		$responses = array();
		$data_username = array (
			'username' => $getUserInfo['data']['username'],
			'status' => 1,
			'role_id' => 26,
			'email' => $getUserInfo['data']['email'],
			'nib' => $getUserInfo['data']['data_nib']['0'],
			'post_date' => date('Y-m-d H:i:s'),
			'post_by' => 'System Apps'
		);
		$id_insert = $this->somod->insert_data_username($data_username);
		if($id_insert != '' || $id_insert != null ){
			$responses['status'] = '1';
			$responses['user_id'] = $id_insert;
			$responses['role_id'] = 26;
			$responses['email'] = $getUserInfo['data']['email'];
			$responses['username'] = $getUserInfo['data']['username'];
			$responses['message'] = 'Generate Username Success';
		}else{
			$responses['status'] = '2';
			$responses['user_id'] = $id_insert;
			$responses['message'] = 'Generate Username Gagal';
		}

		return $responses;		
	}
	
	public function check_permohonan($id_izin,$user_id)
	{
		$responses = array();
		
		$query = $this->somod->get_permohonan($id_izin,$user_id);
		if ($query->num_rows() == 1)
		{
			$data = $query->row_array();
			$id_datapemilik = $data['id'];
			$responses['status'] = '1';
			$responses['id_datapemilik'] = $id_datapemilik;
		}else{
			$responses['status'] = '2';
			$responses['id_datapemilik'] = null;
		}
		return $responses;		
	}
	
	public function insert_data_pemilik($id_izin,$kd_izin,$user_id,$inqueryNIB)
	{
		$responses = array();
		$getDataProyek = $this->checkLicenseStatus($id_izin);
		$data_pemilik = array (
			'user_id' 		=> $user_id,
			'jns_pemilik' 	=> 2,
			'no_ktp' 		=> $inqueryNIB['responinqueryNIB']['dataNIB']['nib'],
			'nm_pemilik' 	=> $inqueryNIB['responinqueryNIB']['dataNIB']['nama_perseroan'],
			'alamat' 		=> $inqueryNIB['responinqueryNIB']['dataNIB']['alamat_perseroan'],
			'id_kelurahan' 	=> $inqueryNIB['responinqueryNIB']['dataNIB']['perseroan_daerah_id'],
			'id_kecamatan' 	=> substr($inqueryNIB['responinqueryNIB']['dataNIB']['perseroan_daerah_id'],0,6),
			'id_kabkota' 	=> substr($inqueryNIB['responinqueryNIB']['dataNIB']['perseroan_daerah_id'],0,4),
			'id_provinsi' 	=> substr($inqueryNIB['responinqueryNIB']['dataNIB']['perseroan_daerah_id'],0,2),
			'email' 		=> $inqueryNIB['responinqueryNIB']['dataNIB']['email_perusahaan'],
			'no_hp' 		=> $inqueryNIB['responinqueryNIB']['dataNIB']['nomor_telpon_perseroan'],
			'oss_id' 		=> $inqueryNIB['responinqueryNIB']['dataNIB']['oss_id'], 
			'oss_id_izin' 	=> $id_izin,
			'oss_id_proyek' => $getDataProyek['responcheckStatusLicense']['dataIZIN']['id_proyek'], 
			'oss_kd_izin' 	=> $kd_izin, 
			'post_date' 	=> date('Y-m-d H:i:s'),
			'post_by' 	=> 'System Apps'
		);
		$id_insert = $this->somod->insert_data_pemilik($data_pemilik);
		
		
		for ($i=0;$i<count($inqueryNIB['responinqueryNIB']['dataNIB']['data_checklist']);$i++) {
			
			if($inqueryNIB['responinqueryNIB']['dataNIB']['data_checklist'][$i]['id_izin'] == $id_izin &&  $inqueryNIB['responinqueryNIB']['dataNIB']['data_checklist'][$i]['kd_izin'] == $kd_izin){
				
				$data_bangunan = array(
					'id' 			=> $id_insert,
					'id_izin' 		=> 1,
					'id_fungsi_bg' 	=> 3,
					'id_jns_bg' 	=> 2,
					'id_komitmen' 	=> $inqueryNIB['responinqueryNIB']['dataNIB']['data_checklist'][$i]['data_teknis']['id_komitmen'],
					'nm_bgn' 		=> $inqueryNIB['responinqueryNIB']['dataNIB']['data_checklist'][$i]['data_teknis']['nama_bangunan'],
					'luas_bgn' 		=> $inqueryNIB['responinqueryNIB']['dataNIB']['data_checklist'][$i]['data_teknis']['luas_bangunan'],
					'jml_lantai' 	=> $inqueryNIB['responinqueryNIB']['dataNIB']['data_checklist'][$i]['data_teknis']['jumlah_lantai'],
					'tinggi_bgn' 	=> $inqueryNIB['responinqueryNIB']['dataNIB']['data_checklist'][$i]['data_teknis']['tinggi_bangunan'],
					'luas_basement' => $inqueryNIB['responinqueryNIB']['dataNIB']['data_checklist'][$i]['data_teknis']['luas_basement'],
					'lapis_basement' => $inqueryNIB['responinqueryNIB']['dataNIB']['data_checklist'][$i]['data_teknis']['jumlah_lantai_basement'],
				);
				
			}
		}
		
		
		$insert_dataBangunan = $this->somod->insert_data_bangunan($data_bangunan);
		
		if($id_insert != '' || $id_insert != null ){
			$responses['status'] = '1';
			$responses['id_datapemilik'] = $id_insert;
			$responses['message'] = 'Generate Permohonan Success';
		}else{
			$responses['status'] = '2';
			$responses['id_datapemilik'] = $id_insert;
			$responses['message'] = 'Generate Permohonan Gagal';
		}
		return $responses;	
	
		
	}
	
	
	
}

