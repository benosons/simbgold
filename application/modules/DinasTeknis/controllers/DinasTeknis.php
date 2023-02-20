<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class DinasTeknis extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('utility');
		$this->load->model('MDinasTeknis');
		$this->load->model('Mglobal');
		$this->load->model('Mglobals');
		$this->load->library('Simbg_lib');
		$this->load->library('Oss_lib');
		$this->simbg_lib->check_session_login();
	}
	function index()
	{
	}
	//Begin Verifikasi Operator
	public function Verifikasi()
	{
		$search = $this->input->post('search');
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		if ($search != '') {
			$SQLcari = array(
				'id_fungsi_bg' => trim($this->input->post('id_fungsi_bg')),
				'id_proses' => trim($this->input->post('id_proses')),
				'tanggalawal' => trim($this->input->post('tanggalawal')),
				'tanggalakhir' => trim($this->input->post('tanggalakhir'))
			);
			$this->session->set_userdata($SQLcari);
			$data = array(
				'id_fungsi_bg' => trim($this->input->post('id_fungsi_bg')),
				'id_proses' => trim($this->input->post('id_proses')),
				'tanggalawal' => trim(tgl_ind_to_eng($this->input->post('tanggalawal'))),
				'tanggalakhir' => trim(tgl_ind_to_eng($this->input->post('tanggalakhir')))
			);
		}
		$data['Verifikasi'] = $this->MDinasTeknis->getListVerifikator($SQLcari);
		$data['content']	= $this->load->view('Verifikasi/VerifikasiList', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm', $data);
	}
	public function VerifikasiBertahap()
	{
		$search = $this->input->post('search');
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		if ($search != '') {
			$SQLcari = array(
				'id_fungsi_bg' => trim($this->input->post('id_fungsi_bg')),
				'id_proses' => trim($this->input->post('id_proses')),
				'tanggalawal' => trim($this->input->post('tanggalawal')),
				'tanggalakhir' => trim($this->input->post('tanggalakhir'))
			);
			$this->session->set_userdata($SQLcari);
			$data = array(
				'id_fungsi_bg' => trim($this->input->post('id_fungsi_bg')),
				'id_proses' => trim($this->input->post('id_proses')),
				'tanggalawal' => trim(tgl_ind_to_eng($this->input->post('tanggalawal'))),
				'tanggalakhir' => trim(tgl_ind_to_eng($this->input->post('tanggalakhir')))
			);
		}
		$data['Verifikasi'] = $this->MDinasTeknis->getListVerifikatorBertahap($SQLcari);
		$data['content']	= $this->load->view('Verifikasi/VerifikasiListBertahap', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm', $data);
	}
	//End List Data Verifikasi Operator
	//Begin Form Verifikasi Kelengkapan Dokumen
	public function FormVerifikasi()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$query 				= $this->MDinasTeknis->getDataVerifikator($id);
		$data['data'] 		= $query->row();
		$data['DataTanah']	= $this->MDinasTeknis->getTanahVerifikasi($id);
		$data['History']	= $this->MDinasTeknis->getHistoryVerifikasi($id);
		$this->getDataUmum();
		$this->getDataTanah();
		$this->getDataArsitektur();
		$this->getDataStruktur();
		$this->getDataMEP();
		$this->load->view('Verifikasi/FormVerifikasi', $data);
	}
	public function FormVerifikasiBertahap()
	{
		$id 					= $this->uri->segment(3);
		$data['id']				= $id;
		$query 					= $this->MDinasTeknis->getDataVerifikator($id);
		$data['data'] 			= $query->row();
		$bangunan				= $this->MDinasTeknis->getDataBangunan($id);
		$data['bangunan']		= $bangunan->row();
		$data['DataTanah']		= $this->MDinasTeknis->getTanahVerifikasi($id);
		$data['History']		= $this->MDinasTeknis->getHistoryVerifikasi($id);
		$this->getDataTanahBertahap();
		$this->getDataUmumBertahap();
		$this->getDataArsitekturBertahap();
		$this->getDataStrukturBertahap();
		$this->getDataMEPBertahap();
		$this->getDataHijauBertahap();
		$this->load->view('Verifikasi/FormVerifikasibertahap', $data);
	}
	//End Form Verifikasi Kelengkapan Dokumen
	function getDataTanahBertahap()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->MDinasTeknis->getJenisKonsultasiBertahap($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$tahap = $permohonan['tahap_pbg'];
		if($tahap == null){$tahap =1;}
		$query = $this->MDinasTeknis->getSyaratListBertahap($id_j_per, '1', $tahap);
		$data['jum_data'] = $query->num_rows();
		$data['results_tnh'] = $query->result();
		$this->load->view('kosong', $data);
	}
	function getDataTanah()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->MDinasTeknis->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->MDinasTeknis->getSyaratList($id_j_per, '1', null);
		$data['jum_data'] = $query->num_rows();
		$data['results_tnh'] = $query->result();
		$this->load->view('kosong', $data);
	}
	function getDataUmumBertahap()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->MDinasTeknis->getJenisKonsultasiBertahap($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$tahap = $permohonan['tahap_pbg'];
		if($tahap == null){$tahap =1;}
		$query = $this->MDinasTeknis->getSyaratListBertahap($id_j_per, '5', $tahap);
		$data['jum_data'] = $query->num_rows();
		$data['results_umum'] = $query->result();
		$this->load->view('kosong', $data);
	}
	function getDataUmum()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->MDinasTeknis->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->MDinasTeknis->getSyaratList($id_j_per, '5', null);
		$data['jum_data'] = $query->num_rows();
		$data['results_umum'] = $query->result();
		$this->load->view('kosong', $data);
	}
	public function getDataArsitekturBertahap()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->MDinasTeknis->getJenisKonsultasiBertahap($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$tahap = $permohonan['tahap_pbg'];
		if($tahap == null){$tahap =1;}
		$query = $this->MDinasTeknis->getSyaratListBertahap($id_j_per, '2', $tahap);
		$data['jum_data'] = $query->num_rows();
		$data['results_Ars'] = $query->result();
		$this->load->view('kosong', $data);
	}
	public function getDataArsitektur()
	{
		$id 		= $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->MDinasTeknis->getJenisKonsultasi($id)->row_array();
		$id_j_per 	= $permohonan['id_jenis_permohonan'];
		$query 		= $this->MDinasTeknis->getSyaratList($id_j_per, '2', null);
		$data['jum_data'] = $query->num_rows();
		$data['results_Ars'] = $query->result();
		$this->load->view('kosong', $data);
	}
	public function getDataStrukturBertahap()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->MDinasTeknis->getJenisKonsultasiBertahap($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$tahap = $permohonan['tahap_pbg'];
		if($tahap == null){$tahap =1;}
		$query = $this->MDinasTeknis->getSyaratListBertahap($id_j_per, '3', $tahap);
		$data['jum_data'] = $query->num_rows();
		$data['results_Str'] = $query->result();
		$this->load->view('kosong', $data);
	}
	public function getDataStruktur()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->MDinasTeknis->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->MDinasTeknis->getSyaratList($id_j_per, '3', null);
		$data['jum_data'] = $query->num_rows();
		$data['results_Str'] = $query->result();
		$this->load->view('kosong', $data);
	}
	public function getDataMEPBertahap()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->MDinasTeknis->getJenisKonsultasiBertahap($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$tahap = $permohonan['tahap_pbg'];
		if($tahap == null){$tahap =1;}
		$query = $this->MDinasTeknis->getSyaratListBertahap($id_j_per, '4', $tahap);
		$data['jum_data'] = $query->num_rows();
		$data['results_MEP'] = $query->result();
		$this->load->view('kosong', $data);
	}
	public function getDataHijauBertahap()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->MDinasTeknis->getJenisKonsultasiBertahap($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$tahap = $permohonan['tahap_pbg'];
		if($tahap == null){$tahap =1;}
		$query = $this->MDinasTeknis->getSyaratListBertahap($id_j_per, '6', $tahap);
		$data['jum_data'] = $query->num_rows();
		$data['results_hijau'] = $query->result();
		$this->load->view('kosong', $data);
	}
	public function getDataMEP()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->MDinasTeknis->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->MDinasTeknis->getSyaratList($id_j_per, '4', null);
		$data['jum_data'] = $query->num_rows();
		$data['results_MEP'] = $query->result();
		$this->load->view('kosong', $data);
	}


	public function check_status_tanah()
	{
		$id = $this->uri->segment(3);
		$id_detail = $this->uri->segment(4);
		$data['id'] = $id;
		$dataIn = array('status_verifikasi_tanah' => '1');
		try {
			$this->MDinasTeknis->updateVerifikasiTanah($dataIn, $id_detail);
			$this->session->set_flashdata('message', 'Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status', 'success');
		} catch (Exception $e) {
			$this->session->set_flashdata('message', 'Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status', 'error');
		}
		$crsf = $this->security->get_csrf_hash();
		$token['csrf']  = $crsf;
		echo json_encode($token);
	}

	public function uncheck_status_tanah()
	{
		$id = $this->uri->segment(3);
		$id_detail = $this->uri->segment(4);
		$data['id'] = $id;
		$dataIn = array('status_verifikasi_tanah' => null);
		try {
			$this->MDinasTeknis->updateVerifikasiTanah($dataIn, $id_detail);
			$this->session->set_flashdata('message', 'Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status', 'success');
		} catch (Exception $e) {
			$this->session->set_flashdata('message', 'Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status', 'error');
		}
		$crsf = $this->security->get_csrf_hash();
		$token['csrf']  = $crsf;
		echo json_encode($token);
	}

	function check_status()
	{
		$id = $this->uri->segment(3);
		$data['id'] = $id;
		$id_persyaratan_detail = $this->uri->segment(4);
		$key_syarat = $this->uri->segment(5);
		if ($key_syarat == 'adm') {
			$id_persyaratan = '5';
		} else if ($key_syarat == 'ars') {
			$id_persyaratan = '2';
		} else if ($key_syarat == 'str') {
			$id_persyaratan = '3';
		} else if ($key_syarat == 'mep') {
			$id_persyaratan = '4';
		} else if ($key_syarat == 'tnh') {
			$id_persyaratan = '1';
		} else {
			$id_persyaratan = '0';
		}
		$dataIn = array('status' => '1');
		try {
			$id_detail =  $this->MDinasTeknis->updateValidasi($dataIn, $id, $id_persyaratan_detail);
			if ($id_detail != $id_persyaratan_detail) {
				$dataIsi = array(
					'id' => $id,
					'id_persyaratan' => $id_persyaratan,
					'id_persyaratan_detail' => $id_persyaratan_detail,
					'status' => '1'
				);
				$this->MDinasTeknis->insert_syarat($dataIsi); // Sudah tersedia
			}
			$this->session->set_flashdata('message', 'Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status', 'success');
		} catch (Exception $e) {
			$this->session->set_flashdata('message', 'Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status', 'error');
		}
		$permohonan = $this->MDinasTeknis->getPermohonan($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$data['pernyataan'] = $permohonan['pernyataan'];
		$queryCekJum_syarat = $this->MDinasTeknis->getSyaratList($id_j_per, null)->result();
		if ($key_syarat == 'adm') {
			$query = $this->MDinasTeknis->getSyaratList($id_j_per, '5');
		} else if ($key_syarat == 'ars') {
			$query = $this->MDinasTeknis->getSyaratList($id_j_per, '2');
		} else if ($key_syarat == 'str') {
			$query = $this->MDinasTeknis->getSyaratList($id_j_per, '3');
		} else if ($key_syarat == 'mep') {
			$query = $this->MDinasTeknis->getSyaratList($id_j_per, '4');
		} else if ($key_syarat == 'tnh') {
			$query = $this->MDinasTeknis->getSyaratList($id_j_per, '1');
		}
		$data['jum_data'] = $query->num_rows();
		$data['results'] = $query->result();
		$data['model_permohonan'] = $this->MDinasTeknis;
		$crsf = $this->security->get_csrf_hash();
		$token['csrf']  = $crsf;
		echo json_encode($token);
	}

	function uncheck_status()
	{
		$id = $this->uri->segment(3);
		$id_persyaratan_detail = $this->uri->segment(4);
		$key_syarat = $this->uri->segment(5);
		$data['id'] = $id;
		$dataIn = array('status' => null);
		try {
			$this->MDinasTeknis->updateValidasi($dataIn, $id, $id_persyaratan_detail);
			$this->session->set_flashdata('message', 'Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status', 'success');
		} catch (Exception $e) {
			$this->session->set_flashdata('message', 'Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status', 'error');
		}
		$permohonan = $this->MDinasTeknis->getPermohonan($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$data['pernyataan'] = $permohonan['pernyataan'];
		$queryCekJum_syarat = $this->MDinasTeknis->getSyaratList($id_j_per, null)->result();
		if ($key_syarat == 'adm') {
			$query = $this->MDinasTeknis->getSyaratList($id_j_per, '1');
		} else if ($key_syarat == 'tek') {
			$query = $this->MDinasTeknis->getSyaratList($id_j_per, '2');
		}
		$crsf = $this->security->get_csrf_hash();
		$token['csrf']  = $crsf;
		echo json_encode($token);
	}

	public function status_dt_teknis()
	{
		$user_id		= $this->session->userdata('loc_user_id');
		$id_kabkot		= $this->session->userdata('loc_id_kabkot');
		$user_id		= $this->Outh_model->Encryptor('decrypt', $user_id);
		$status			= $this->input->post('status_syarat');
		$no_surat		= $this->input->post('no_surat');
		$catatan		= $this->input->post('catatan');
		$id_pemilik		= $this->input->post('id_pemilik');
		$email			= $this->input->post('email');
		$no_konsultasi	= $this->input->post('no_konsultasi');
		$tgl_skrg 		= date('Y-m-d');
		if ($status == '2') {
			$ket = "Dikembalikan ke Pemohon agar di perbaiki/dilengkapi";
		} else if ($status == '1') {
			$ket = "Sudah Lengkap dan akan masuk ketahap Penugasan TPT/TPA";
		} else {
			$ket = "Belum ditentukan";
		}
		$filean = $this->input->post('dir_dokumen');
		$thisdir = getcwd();
		$dirPath = $thisdir . "/object-storage/dekill/Consultation/";
		$config['upload_path'] 		= $dirPath;
		$config['allowed_types'] 	= 'pdf|png|jpg';
		$config['max_size']			= '50240';
		$config['remove_spaces']	= False;
		$config['encrypt_name']		= TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$file = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES["dir_file"]['name']);
		if ($_FILES["dir_file"]["name"]) {
			$config["file_name"] = $file;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$dir_file = $this->upload->do_upload('dir_file');
			$filean = $this->upload->data();
			$filean = $filean['file_name'];
			if (!$dir_file) {
				$data['err_msg'] = $this->upload->display_errors('', '');
				$this->session->set_flashdata('message', 'Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status', 'warning');
				redirect('DinasTeknis/Verifikasi');
			}
		}

		if ($status == '1') {
			if($id_kabkot == '31'){
				$data	= array(
					'tgl_status' => $tgl_skrg,
					'status' => '4',
					'id_dki' => '1',
					'no_surat' => $no_surat,
					'id' => $id_pemilik,
					'catatan' => $catatan,
					'dir_file' => $filean,
					'user_id' => $user_id,
					'modul' => 'verifikasi'
				);
			}else{
				$data	= array(
					'tgl_status' => $tgl_skrg,
					'status' => '4',
					'no_surat' => $no_surat,
					'id' => $id_pemilik,
					'catatan' => $catatan,
					'dir_file' => $filean,
					'user_id' => $user_id,
					'modul' => 'verifikasi'
				);
			}
		} else {
			$data	= array(
				'tgl_status' => $tgl_skrg,
				'status' => '3',
				'no_surat' => $no_surat,
				'id' => $id_pemilik,
				'catatan' => $catatan,
				'dir_file' => $filean,
				'user_id' => $user_id,
				'modul' => 'verifikasi'
			);
		}
		if ($status == '1') {
			$dataPemilik 	= $this->MDinasTeknis->getDataVerifikatorOSS($id_pemilik)->row();
			if($dataPemilik->oss_id != '' || $dataPemilik->oss_id != null ){
				$tgl_skrg 		= date('Y-m-d');
				$kd_status 		= '10';
				$tgl_status 	= $tgl_skrg;
				$nama_status 	= 'Verifikasi Kelengkapan';
				$keterangan 	= 'Dokumen Telah Lengkap';
				$this->oss_lib->receiveLicenseStatusNew($id_pemilik,$kd_status,$tgl_status,$nama_status,$keterangan);
			}
		}else{
			$dataPemilik 	= $this->MDinasTeknis->getDataVerifikatorOSS($id_pemilik)->row();
			if($dataPemilik->oss_id != '' || $dataPemilik->oss_id != null ){
				$tgl_skrg 		= date('Y-m-d');
				$kd_status 		= '11';
				$tgl_status 	= $tgl_skrg;
				$nama_status 	= 'Verifikasi Kelengkapan';
				$keterangan 	= 'Dokumen Tidak Lengkap';
				$this->oss_lib->receiveLicenseStatusNew($id_pemilik,$kd_status,$tgl_status,$nama_status,$keterangan);
			}
		}

		$this->Mglobals->setData('tmdatabangunan', ['status' => $data['status']], 'id', $id_pemilik);
		$this->Mglobals->setDatakol('th_data_konsultasi', $data);
		$this->session->set_flashdata('message', 'Data User Berhasil di Diperbaharui.');
		$this->session->set_flashdata('status', 'success');
		$email 			= "$email";
		$no_konsultasi 	= "$no_konsultasi";
		$catatan 		= "$catatan";
		$subject 		= "Status Verifikasi $no_konsultasi";
		$text 			= "";
		$text .= "Yth Bapak/Ibu,<br>";
		$text .= "<br>";
		$text .= "Dengan ini kami memberitahukan bahwa Permohonan dengan No.Registrasi $no_konsultasi <br>";
		$text .= "Dengan keterangan $ket<br>";
		$text .= "Catatan : $catatan";
		$text .= "<br>";
		$text .= "<br>";
		$text .= "Hormat Kami <br>";
		$text .= "Admin SIMBG ";
		if ($status == '1') {
			$this->simbg_lib->sendEmail($email, $subject, $text);
		} else {
			$this->simbg_lib->sendEmail($email, $subject, $text);
		}
		redirect('DinasTeknis/Verifikasi');
	}
	// End Verifikasi Operator
	// Begin Konsultasi Dokumen
	public function cetak()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$id_fungsi_bg = $this->session->userdata('id_fungsi_bg');
		$id_proses = $this->session->userdata('id_proses');
		$tanggalawal = $this->session->userdata('tanggalawal');
		$tanggalakhir = $this->session->userdata('tanggalakhir');
		$SQLcari 	= array();
		if ($id_fungsi_bg != '') {
			$SQLcari['id_fungsi_bg'] = !empty($id_fungsi_bg) ? $id_fungsi_bg : '';
		}
		if ($id_proses != '') {

			$SQLcari['id_proses'] = !empty($id_proses) ? $id_proses : '';
		}
		if ($tanggalawal != '') {
			$SQLcari['tanggalawal'] = !empty($tanggalawal) ? $tanggalawal : '';
		}
		if ($id_fungsi_bg != '') {
			$SQLcari['tanggalakhir'] = !empty($tanggalakhir) ? $tanggalakhir : '';
		}
		$data['Verifikasi'] = $this->MDinasTeknis->getListVerifikator($SQLcari);

		$this->load->view('Verifikasi/PrintVerifikasiList', $data);
	}
	// End Konsultasi Dokumen
}
