<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Qi Auth class Library
 * @author : kiQ
 * adaptation from DX_Auth 1.0.6
 */ 
class Oss_lib
{

	function __construct()
	{
		//Get the CodeIgniter super object
		$this->ci =& get_Instance();
		$this->ci->load->database();
	}
	
	function sendSecurityKey()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL 						=> "https://services.oss.go.id/sendSecurityKey",
			//CURLOPT_URL => "http://103.234.195.161:8000/sendSecurityKey",
			CURLOPT_RETURNTRANSFER 	=> true,
			CURLOPT_ENCODING				=> "",
			CURLOPT_SSL_VERIFYPEER 	=> false,
			CURLOPT_SSL_VERIFYHOST 	=> false,
			CURLOPT_MAXREDIRS 			=> 10,
			CURLOPT_TIMEOUT 				=> 30,
			CURLOPT_HTTP_VERSION 		=> CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST 	=> "POST",
			CURLOPT_POSTFIELDS 			=> "{   \"securityKey\": {     \"user_akses\": \"OSS033\",     \"pwd_akses\": \"8df68d0f8613e05029a7cfcc2252593c\"   } }",
			CURLOPT_HTTPHEADER 			=> array(
				"content-type: application/json"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$result = json_decode($response, true);
		print_r($result['responsendSecurityKey']['key']);
		if ($err) {
			return "cURL Error #:" . $err;
		} else {
			return $result['responsendSecurityKey']['key'];
		}
	}
	
	function receiveLicenseStatus($id_permohonan,$kd_status,$tgl_status,$nip_status,$nama_status,$keterangan)
	{
		$Feedback = array();
		$test = "tester";
		$this->ci->load->model('oss_lib_model','ossmod');
		
		$key = $this->sendSecurityKey();
		
		if($id_permohonan != '' || $id_permohonan != null)
		{
			$query = $this->ci->ossmod->get_oss_data($id_permohonan);
			if ($query->num_rows() == 1)
			{
				$data = $query->row_array();
				$dataFeedback = array (
					'nomor_registrasi' => $data['nomor_registrasi'],
					'nib' => $data['nib'],
					'id_proyek' => $test,
					'oss_id' => $data['oss_id'],
					'id_izin' =>$test,
					'kd_izin' => $data['kd_izin'],
					'kd_instansi' => '033',
					'kd_status' => $kd_status,
					'tgl_status' => $tgl_status,
					'nip_status' => $nip_status,
					'nama_status' => $nama_status,
					'keterangan' => $keterangan
				);
				
				$Feedback['IZINSTATUS'] = $dataFeedback;
				//Action FeedBack
				$curl = curl_init();
				
				curl_setopt_array($curl, array(
					//CURLOPT_URL => "http://103.234.195.161:8000/receiveLicenseStatus",
					CURLOPT_URL => "https://services.oss.go.id/receiveLicenseStatus",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_SSL_VERIFYPEER => false,
					CURLOPT_SSL_VERIFYHOST => false,
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 3000,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => json_encode($Feedback),
					CURLOPT_HTTPHEADER => array(
						"content-type: application/json",
						"oss-api-key: ".$key
					),
				));
				
				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);
				
				/*if ($err) {
					return "cURL Error #:" . $err;
					
				}  else {
					return $response;
					
				}*/
				
				echo "<br>";
				$tes = json_encode($Feedback);
				echo $tes;
				echo "<br>";
				print_r($response);
				echo "<br>";
				print_r($err);
				echo "<br>";
				echo $key;
				//if ($err) {
					//return "cURL Error #:" . $err;
					
				//}  else {
					//return $response;
					
				//}
				//End Action FeedBack
			}
		}else{
			return "nomor registrasi null";
		}
	}
	
	function receiveLicense ($id_permohonan,$kode_status,$keterangan)
	{
		$Feedback = array();
		$this->ci->load->model('oss_lib_model','ossmod');
		$key = $this->sendSecurityKey();
		
		if($id_permohonan != '' || $id_permohonan != null)
		{
			$query = $this->ci->ossmod->get_selesai($id_permohonan);
			if ($query->num_rows() == 1)
			{
				$data = $query->row_array();
				/*$datapnbp = array (
					'kd_akun' => $kd_akun,
					'kd_penerimaan' => $kd_penerimaan,
					'nominal' => $nominal
				);*/
				$dataFeedback = array (
					'nomor_registrasi' => $data['nomor_registrasi'],
					'nib' => $data['nib'],
					'oss_id' => $data['oss_id'],
					'kd_izin' => $data['kd_izin'],
					'nomor_izin' => $data['nomor_izin'],
					'tgl_terbit_izin' => $data['tgl_terbit_izin'],
					'tgl_berlaku_izin' => $data['tgl_berlaku_izin'],
					'jabatan_ttd' => $data['jabatan_ttd'],
					'status_izin' => $kode_status,
					'file_izin' => base_url() . index_page()."penerbitan/cetak_form_imb/".$id_permohonan,
					'keterangan' => $keterangan
				);
				$Feedback['IZINFINAL'] = $dataFeedback;
				//Action FeedBack
				
				$curl = curl_init();
				
				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://services.oss.go.id/receiveLicense",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_SSL_VERIFYPEER => false,
					CURLOPT_SSL_VERIFYHOST => false,
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => json_encode($Feedback),
					CURLOPT_HTTPHEADER => array(
						"content-type: application/json",
						"oss-api-key: ".$key						
					),
				));
				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				
				echo "<br>";
				$tes = json_encode($Feedback);
				echo $tes;
				echo "<br>";
				print_r($response);
				echo "<br>";
				print_r($err);
				echo "<br>";
				echo $key;
				//if ($err) {
					//return "cURL Error #:" . $err;
				//} else {
					//return $response;
				//}
				//End Action FeedBack
			}
		}else{
			return "nomor registrasi null";
		}
	}
	
	function receiveLicenseFinal ($id_permohonan,$kode_status,$keterangan)
	{
		$Feedback = array();
		$this->ci->load->model('oss_lib_model','ossmod');
		$key = $this->sendSecurityKey();
		
		if($id_permohonan != '' || $id_permohonan != null)
		{
			$query = $this->ci->ossmod->get_selesai($id_permohonan);
			if ($query->num_rows() == 1)
			{
				$data = $query->row_array();
				/*$datapnbp = array (
					'kd_akun' => $kd_akun,
					'kd_penerimaan' => $kd_penerimaan,
					'nominal' => $nominal
				);*/
				$dataFeedback = array (
					'nomor_registrasi' => $data['nomor_registrasi'],
					'nib' => $data['nib'],
					'oss_id' => $data['oss_id'],
					'kd_izin' => $data['kd_izin'],
					'nomor_izin' => 'SK-IMB-820306-18032020-03',
					'tgl_terbit_izin' => $data['tgl_terbit_izin'],
					'tgl_berlaku_izin' => $data['tgl_berlaku_izin'],
					'jabatan_ttd' => $data['jabatan_ttd'],
					'status_izin' => $kode_status,
					'file_izin' => base_url() . index_page()."penerbitan/cetak_form_imb/".$id_permohonan,
					'keterangan' => $keterangan
				);
				$Feedback['IZINFINAL'] = $dataFeedback;
				//Action FeedBack
				
				$curl = curl_init();
				
				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://services.oss.go.id/receiveLicense",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_SSL_VERIFYPEER => false,
					CURLOPT_SSL_VERIFYHOST => false,
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => json_encode($Feedback),
					CURLOPT_HTTPHEADER => array(
						"content-type: application/json",
						"oss-api-key: ".$key						
					),
				));
				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				
				echo "<br>";
				$tes = json_encode($Feedback);
				echo $tes;
				echo "<br>";
				print_r($response);
				echo "<br>";
				print_r($err);
				echo "<br>";
				echo $key;
				//if ($err) {
					//return "cURL Error #:" . $err;
				//} else {
					//return $response;
				//}
				//End Action FeedBack
			}
		}else{
			return "nomor registrasi null";
		}
	}
	
	function receiveLicenseStatusNew($id_pemilik,$kd_status,$tgl_status,$nama_status,$keterangan)
	{
		$Feedback = array();
		$action = "receiveLicenseStatusSIMBG";
		$nib = "";
		$id_izin = "";
		$kd_izin = "";
		$this->ci->load->model('oss_lib_model','ossmod');
		
		if($id_pemilik != '' || $id_pemilik != null)
		{
			$query = $this->ci->ossmod->get_data_pemilik($id_pemilik);
			if ($query->num_rows() == 1)
			{
				$data = $query->row_array();
				$nib = $data['no_ktp'];
				$id_izin = $data['oss_id_izin'];
				$kd_izin = $data['oss_kd_izin'];
				$dataFeedback = array (
					'nib' => $data['no_ktp'],
					'id_produk' => "",
					'id_proyek' => $data['oss_id_proyek'],
					'oss_id' => $data['oss_id'],
					'kd_izin' => $data['oss_kd_izin'],
					'id_izin' => $data['oss_id_izin'],
					'kd_instansi'=> "",
					'kd_status' => $kd_status,
					'tgl_status' => $tgl_status,
					'nip_status'=> "",
					'nama_status' => $nama_status,
					'keterangan' => $keterangan
				);
				$Feedback['IZINSTATUS'] = $dataFeedback;
			}
		}
		
		$curl = curl_init();
		
		
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.pu.go.id/oss/prod/services/receiveLicenseStatusSIMBG",
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
			//$this->log_sso($action,$nib,$id_izin,$kd_izin,$kode,$keterangan);
			return "cURL Error #:" . $err;
		} else {
			//$kode = "200";
			//$keterangan = "SUKSES";
			//$this->log_sso($action,$nib,$id_izin,$kd_izin,$kode,$keterangan);
			return $result;
		}
		
		
		
		
		
		
	}
	
	function receiveLicenseNew($id_pemilik,$dataIZIN)
	{
		$Feedback = array();
		$action = "receiveLicenseSIMBG";
		$nib = "";
		$id_izin = "";
		$kd_izin = "";
		$this->ci->load->model('oss_lib_model','ossmod');
		
		if($id_pemilik != '' || $id_pemilik != null)
		{
			$query = $this->ci->ossmod->get_data_pemilik($id_pemilik);
			if ($query->num_rows() == 1)
			{
				$data = $query->row_array();
				$nib = $data['no_ktp'];
				$id_izin = $data['oss_id_izin'];
				$kd_izin = $data['oss_kd_izin'];
				$dataFeedback = array (
					'nib' => $data['no_ktp'],
					'id_proyek' => $data['oss_id_proyek'],
					'oss_id' => $data['oss_id'],
					'kd_izin' => $data['oss_kd_izin'],
					'id_izin' => $data['oss_id_izin'],
					'nomor_izin' =>  $dataIZIN['nomor_izin'],
					'tgl_terbit_izin' => $dataIZIN['tgl_terbit_izin'],
					'tgl_berlaku_izin' => $dataIZIN['tgl_berlaku_izin'],
					'nama_ttd' => $dataIZIN['nama_ttd'],
					'nip_ttd' => $dataIZIN['nip_ttd'],
					'status_izin' => $dataIZIN['status_izin'],
					'file_izin' => $dataIZIN['file_izin'],
					'file_lampiran' => $dataIZIN['file_lampiran'],
					'keterangan' => $dataIZIN['keterangan'],
					'data_teknis' => $dataIZIN['data_teknis']
				);
				
				$Feedback['IZINFINAL'] = $dataFeedback;
	
			}
		}
		
		$curl = curl_init();
		
		
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.pu.go.id/oss/prod/services/receiveLicenseSIMBG",
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
			//$this->log_sso($action,$nib,$id_izin,$kd_izin,$kode,$keterangan);
			return "cURL Error #:" . $err;
		} else {
			//$kode = "200";
			//$keterangan = "SUKSES";
			//$this->log_sso($action,$nib,$id_izin,$kd_izin,$kode,$keterangan);
			return $result;
		}
		
		
	}
	
	function log_sso($action,$nib,$id_izin,$kd_izin,$kode,$keterangan)
	{
		$this->ci->load->model('oss_lib_model','ossmod');
		$tgl_skrg 		= date('Y-m-d');
		$datalog = array(
			'tgl_log' => $tgl_skrg,
			'action' => $action,
			'nib' 		=> $nib,
			'id_izin' 	=> $id_izin,
			'kd_izin' 	=> $kd_izin,
			'kode' 	=> $kode,
			'keterangan' 	=> $keterangan
		);
		$insert_datalog = $this->ci->ossmod->insert_data_log($datalog);
	}
	
}

?>
