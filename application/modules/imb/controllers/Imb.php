<?php
ini_set('memory_limit', -1);
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Imb extends CI_Controller {
	
	var $limit = 1000;
	public function __construct() {
		parent::__construct();
		
		//$this->load->model('mglobal');
		$this->load->helper('utility');
		$this->load->model('Imb_model');
		$this->load->model('mpermohonan');
		$this->load->model('mpenerbitan_imb');
		$this->load->library('simbg_lib');
		//$this->load->helper(array('form', 'url'));
		$this->load->library('oss_lib');
		$this->simbg_lib->check_session_login();
	}
	
	function index(){
		//$this-> verifikasi();
	}
	
	function killSession()
	{
		$this->session->unset_userdata('pencarian');
	}

	//Awal Verifikasi
	public function verifikasi()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		if ($this->input->post('search',TRUE)){
			$this->session->set_userdata('pencarian' ,1);
			$id_fungsi_bg = trim($this->input->post('id_fungsi_bg'));
			$data['id_fungsi_bg'] = $id_fungsi_bg;
			if (trim($id_fungsi_bg) != '')
			{
				$this->session->set_userdata('skeyid_fungsi_bg' ,$id_fungsi_bg); 
				$SQLcari .= " And a.id_fungsi_bg = '$id_fungsi_bg'";
			}
			$id_proses = trim($this->input->post('id_proses'));
			$data['id_proses'] = $id_proses;
			if (trim($id_proses) != '')
			{
				if($id_proses == '1'){
					$SQLcari .= " AND a.status_progress between '1' AND '3' and a.status_progress !='2' ";
				}else if($id_proses == '2'){
					$SQLcari .= " AND a.status_progress >='4'";
				}
			}
			$tgl_permohonan_awal2 =  tgl_ind_to_eng($this->input->post('tanggalawal'));
			$tgl_permohonan_akhir2 =  tgl_ind_to_eng($this->input->post('tanggalakhir'));
			$data['tanggalawal']  = $tgl_permohonan_awal2;
			$data['tanggalakhir'] = $tgl_permohonan_akhir2;
			if (trim($tgl_permohonan_awal2) !='' && trim($tgl_permohonan_akhir2) !='')
			{
				$SQLcari .= " AND a.tgl_permohonan between '$tgl_permohonan_awal2' AND '$tgl_permohonan_akhir2'";
			}
			if($this->session->userdata('loc_id_kabkot')){
				$id_kabkot = $this->session->userdata('loc_id_kabkot');
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$data['dataimb'] = $this->imb_model->getListVerifikator(null,$SQLcari);	
		}else if ($this->session->userdata('pencarian') == TRUE){
			$SQLcari = '';
			if($this->session->userdata('loc_id_kabkot')){
				$id_kabkot = $this->session->userdata('loc_id_kabkot');
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$data['dataimb'] = $this->imb_model->getListVerifikator(null,$SQLcari);
		}else{
			$this->killSession();
			$SQLcari = '';
			if($this->session->userdata('loc_id_kabkot')){
				$id_kabkot = $this->session->userdata('loc_id_kabkot');
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$data['dataimb'] = $this->imb_model->getListVerifikator(null,$SQLcari);
		}
		$data['content']	= $this->load->view('ver_imb/imb_list',$data,TRUE);
		$data['title']		=	'Verifikasi Berkas Persyaratan';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
	}
	
	public function form_verifikasi($id_permohonan){
		$data['row']   = $this->imb_model->getById($id_permohonan);
		$data['datatanah']   = $this->imb_model->getByIdTanah($id_permohonan);
		$data['datastatus']   = $this->imb_model->getByIdStatus($id_permohonan);
		$this->get_syarat();
		$this->get_syarat_teknis();
		$this->detailin();
		//$this->getProtype();
		//$this->get_status();
		//$data['content']	= $this->load->view('ver_imb/imb_form',$data,TRUE);
		$this->load->view('ver_imb/imb_form',$data);
		//$this->load->view('bakA',$data);		
	}

	
	public function hapusIMB($id_permohonan)
	{
		$process = $this->imb_model->HapusDataIMB($id_permohonan);
		if(!$process){
			$this->session->set_flashdata('message','IMB Gagal Dihapus.');
			$this->session->set_flashdata('status','danger');	
		}else{
			$this->session->set_flashdata('message','IMB Berhasil di Hapus.');
			$this->session->set_flashdata('status','success');	
		}
		redirect('imb/verifikasi');
	}
	
	function get_syarat()
	{
		$id= $this->uri->segment('3');
		$data['id_permohonan'] = $id;
		$permohonan = $this->imb_model->get_permohonan($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$id_jenis_usaha = $permohonan['id_jenis_usaha'];	
		$data['status_syarat'] = $permohonan['status_syarat'];
		$query = $this->imb_model->get_syarat_list($id_j_per,'1',$id_jenis_usaha,null);
		//$query = $this->imb_model->get_syarat_list($id_j_per);				
		$data['jum_data'] = $query->num_rows();		
		$data['results'] = $query->result();
		
		$this->load->view('kosong',$data);
	}
	
	function get_syarat_teknis()
	{
		$id= $this->uri->segment('3');
		$data['id_permohonan'] = $id;
		$permohonan = $this->imb_model->get_permohonan($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$id_jenis_usaha = $permohonan['id_jenis_usaha'];
		$data['status_syarat'] = $permohonan['status_syarat'];
		$idp = $permohonan['idp'];
		$luas_bg = $permohonan['luas_bg'];
		
		$query = $this->imb_model->get_syarat_list($id_j_per,'2',$id_jenis_usaha,$luas_bg);				
		$data['jum_data'] = $query->num_rows();		
		$data['resultses'] = $query->result();
		
		$this->load->view('kosong',$data);
	}
	
	/*function getProtype()
	{
		$id= $this->uri->segment('3');
		$data['id_permohonan'] = $id;
		$permohonan = $this->imb_model->get_permohonan($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$idp = $permohonan['idp'];
		$query = $this->imb_model->getProtype($idp);				
		$data['jum_data'] = $query->num_rows();		
		$data['resultsprotype'] = $query->result();
		
		$this->load->view('kosong',$data);
	}*/
	
	function get_status()
	{
		$id= $this->uri->segment('3');
		$data['id_permohonan'] = $id;
		$id_status = $this->uri->segment('4');
		if($id_status != ''){
			$query1 = $this->imb_model->get_data_status(null,$id_status);
			$mydata2 = $query1->row_array();
			$baris2 = $query1->num_rows();
			if ($baris2 >= 1 ) {
				$data['id_status'] = $mydata2['id_status'];
				$data['no_surat_pemberitahuan'] = $mydata2['no_surat_pemberitahuan'];
				$data['tgl_pemberitahuan'] = $mydata2['tgl_pemberitahuan'];
				$data['dir_file_pemberitahuan_edit'] = $mydata2['dir_file_pemberitahuan'];
				$data['status_syarat'] = $mydata2['status_syarat'];
			}
			$query = $this->imb_model->get_data_status($id,null);
			$data['jumdata'] = $query->num_rows();
			$data['resultsted'] = $query->result_array();
		}	
		else if(trim($id) != '') {
			$query = $this->imb_model->get_data_status($id,null);
			$data['jumdata'] = $query->num_rows();
			$data['resultsted'] = $query->result_array();	
		}
		$this->load->view('kosong',$data);
	}
	
	function data_status_delete()
	{
		$id = $this->uri->segment(3);
		$data['id_permohonan'] = $id;
		$id_status = $this->uri->segment(4);
		$data['pesan'] = '';
		$data['err_msg'] = '';
		// Mengambil List Dokumen
		 
		if(trim($id_status) != '' && trim($id_status) != '') {
			try 
			{
				$this->imb_model->data_status_delete($id_status);
				$data['pesan'] = "Data Berhasil Dihapus";
			} 
			catch(Exception $e) 
			{
				$data['err_msg'] = "Data Gagal Dihapus";
			}
			$query = $this->imb_model->get_data_status($id);
			$data['jumdata'] = $query->num_rows();
			$data['results'] = $query->result_array();
			$this->load->view('permohonan/status_form',$data);
			
		}
	}
	
	function kirim_email_kelengkapan()
	{
		$id= $this->uri->segment('3');
		$data['id_permohonan'] = $id;
		$id_status = $this->uri->segment('4');
		
		$status_syarat = "";
		$no_surat_pemberitahuan = "";
		$tgl_pemberitahuan = "";
		$dir_file_pemberitahuan_edit = "";
		$email = "";
		$nomor_registrasi = "";
		$text_email = "";
		
		if($id_status != ''){
			$query1 = $this->imb_model->get_data_status(null,$id_status);
			$mydata2 = $query1->row_array();
			$baris2 = $query1->num_rows();
			if ($baris2 >= 1 ) {
				
				$data['id_status'] = $mydata2['id_status'];
				$data['no_surat_pemberitahuan'] = $mydata2['no_surat_pemberitahuan'];
				$no_surat_pemberitahuan = $mydata2['no_surat_pemberitahuan'];
				
				$data['tgl_pemberitahuan'] = $mydata2['tgl_pemberitahuan'];
				$tgl_pemberitahuan = $mydata2['tgl_pemberitahuan'];
				
				$data['dir_file_pemberitahuan_edit'] = $mydata2['dir_file_pemberitahuan'];
				$dir_file_pemberitahuan_edit = $mydata2['dir_file_pemberitahuan'];
				
				$data['status_syarat'] = $mydata2['status_syarat'];
				$status_syarat = $mydata2['status_syarat'];
				
				$data['email'] = $mydata2['email'];
				$email = $mydata2['email'];
				
				$data['nomor_registrasi'] = $mydata2['nomor_registrasi'];
				$nomor_registrasi = $mydata2['nomor_registrasi'];
			}
			$query = $this->imb_model->get_data_status($id,null);
			$data['jumdata'] = $query->num_rows();
			$data['results'] = $query->result_array();
		}	
		else if(trim($id) != '') {
			$query = $this->imb_model->get_data_status($id,null);
			$data['jumdata'] = $query->num_rows();
			$data['results'] = $query->result_array();	
		}
		//kirim email
		if($status_syarat != '' && $email != '' && $nomor_registrasi != ''){
			//data lengkap
			if($status_syarat == '1')
			{
				$text_email .= "No Registrasi :".$nomor_registrasi."<br>";
				$text_email .= "No Surat Verifikasi Kelengkapan :".$no_surat_pemberitahuan."<br>";
				$text_email .= "Tanggal Surat :".$tgl_pemberitahuan."<br>";
				$text_email .= "Data Sudah Lengkap.";
		
				$this->load->library('PHPMailerAutoload');
				$mail = new PHPMailer();
				$mail->SMTPDebug = false;
				$mail->Debugoutput = 'html';
        
				// set smtp
				$mail->isSMTP();
				$mail->Host = gethostbyname('ssl://smtp.gmail.com');
				$mail->Port = '465';
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'ssl';
				$mail->Username = 'simbgcs@gmail.com';
				$mail->Password = 'cssimbg88';
				$mail->WordWrap = 50;  
        
				// set email content
				if($dir_file_pemberitahuan_edit != ''){
					$file = realpath('./file/pemberitahuan/'.$dir_file_pemberitahuan_edit);
					//'upload_path' => realpath('./file/IMB/pengajuan_imb/'$id'/pemberitahuan_persyaratan/'),
					$mail->AddAttachment( $file, 'PemberitahuanVerifikasi.pdf' );
				}
				$mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
				$mail->addAddress($email);
				$mail->Subject = 'Verifikasi Kelengkapan Pengajuan Permohonan IMB | CS SIMBG';
				$mail->Body = $text_email;
				$mail->isHTML(true); 
				$mail->send();
				$this->session->set_flashdata('message','Data Sukses di Perbaharui dan Pesan Terkirim');
				$this->session->set_flashdata('status','success');
			}else if($status_syarat == '2'){
				$text_email .= "No Registrasi :".$nomor_registrasi."<br>";
				$text_email .= "No Surat Verifikasi Kelengkapan :".$no_surat_pemberitahuan."<br>";
				$text_email .= "Tanggal Surat :".$tgl_pemberitahuan."<br>";
				$text_email .= "Data Tidak Lengkap. Mohon Untuk Melengkapi Persyaratan";
		
				$this->load->library('PHPMailerAutoload');
				$mail = new PHPMailer();
				$mail->SMTPDebug = false;
				$mail->Debugoutput = 'html';
        
				// set smtp
				$mail->isSMTP();
				$mail->Host = gethostbyname('ssl://smtp.gmail.com');
				$mail->Port = '465';
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'ssl';
				$mail->Username = 'simbgcs@gmail.com';
				$mail->Password = 'cssimbg88';
				$mail->WordWrap = 50;  
        
				// set email content
				if($dir_file_pemberitahuan_edit != ''){
					$file = realpath('./file/pemberitahuan/'.$dir_file_pemberitahuan_edit);
					//'upload_path' => realpath('./file/IMB/pengajuan_imb/'$id'/pemberitahuan_persyaratan/'),
					$mail->AddAttachment( $file, 'PemberitahuanVerifikasi.pdf' );
				}
				$mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
				$mail->addAddress($email);
				$mail->Subject = 'Verifikasi Kelengkapan Pengajuan Permohonan IMB | CS SIMBG';
				$mail->Body = $text_email;
				$mail->isHTML(true); 
				$mail->send();
				$this->session->set_flashdata('message','Data Sukses di Perbaharui dan Pesan Terkirim');
				$this->session->set_flashdata('status','success');
			}
		}else{
			//$this->session->set_flashdata('pesan', 'Tidak dapat Mengirim Email, Mohon Cek Koneksi Jaringan Anda!');
			$this->session->set_flashdata('message','Data Sukses di Perbaharui Tetapi Pesan Tidak Terkirim, Harap Kirim Ulang');
			$this->session->set_flashdata('status','warning');
		}
		//$this->load->view('permohonan/status_form',$data);
	}
	
	public function hapusStatus($id_status)
	{
		$process = $this->imb_model->hapus_data_status($id_status);
		if(!$process){
			$this->session->set_flashdata('message','Status IMB Gagal Dihapus.');
			$this->session->set_flashdata('status','error');	
		}else{
			$this->session->set_flashdata('message','Status IMB Berhasil di Hapus.');
			$this->session->set_flashdata('status','success');	
		}
		redirect('imb/verifikasi/');	
	}
	
	public function SimpanStatus()
	{
		$id_permohonan	= $this->input->post('id_permohonan');
		$statusnya	= $this->input->post('status_syarat');
		$lampiran=$this->input->post('filename_pemberitahuan');
		$em_il=$this->input->post('em_il');
		$noreg=$this->input->post('noreg');
		
		$id_kolektif = $this->input->post('id_kolektif');
		$sk_imbkol = $this->input->post('sk_imbkol');
		
		//upload Files
		if($this->input->post('xstin')) {
			
				//Upload file
				$filenya = 'dir_file_pemberitahuan';
				$lampir=$this->input->post('filename_pemberitahuan');
				$thisdir = getcwd();
				$dirPath = $thisdir."/file/IMB/pengajuan_imb/$id_permohonan/pemberitahuan_persyaratan/";
				if (!file_exists($dirPath)){
				//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 	= 'pdf';
				$config['max_size']			= '10240';
				$config['encrypt_name']		= TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				//End Upload
				
				if ((!$this->upload->do_upload($filenya)) && ($lampir != '') ){
					//$error['upload'] = $this->upload->display_errors();
					$this->session->set_flashdata('message','Data Gagal di Perbaharui, Periksa Kembali File yang di Unggah');
					$this->session->set_flashdata('status','danger');
				}else{
					if($lampir != ''){
						$file=$this->upload->data();
						$lampiran=$file['file_name'];
					}else{
						$lampiran=$this->input->post('filename_pemberitahuan');
					}
					//$this->imb_model->saveStatus();
					
					$dataStatusnya = array(
						"id_status" => $this->input->post('id_status'),
						"id_permohonan" => $id_permohonan,
						"status_syarat" => $this->input->post('status_syarat'),
						"no_surat_pemberitahuan" => $this->input->post('no_surat_pemberitahuan'),
						"dir_file_pemberitahuan" => $lampiran,
						"catatan" => $this->input->post('catatan'),
						"tgl_pemberitahuan" => date('Y-m-d'),
						"post_date" => date('Y-m-d'),
						"last_update" => date('Y-m-d H:i:s'),
						"post_by" => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
					);
		
					$this->imb_model->saveStatusnya($dataStatusnya);
					
					
					if($statusnya == '2'){
								$em_ilnya = $em_il;
								$tgl_log = date('Y-m-d');
								$keterangan = 'Persyaratan Tidak Lengkap, dikembalikan Kepada Pemohon untuk melengkapi persyaratan';
								$nama_fb = 'Validasi Dinas PTSP';
								$kode_feedback = '20';
									$dataIn = array (
										'id_permohonan' => $id_permohonan,
										'tgl_log_permohonan' => $tgl_log,
										'keterangan' => $keterangan,
										'kode_proses' => 11,
										'dir_file_proses' => $lampiran,
										'post_date' => $tgl_log,
										'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
									);
									$this->imb_model->editStatus($id_permohonan);
									$this->imb_model->insert_log_permohonan($dataIn);
									//$feedback = $this->oss_lib->receiveLicenseStatus($id,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
									$dataProgress = array (
										
										'status_progress' => 2,
									);
									$this->imb_model->updateProgress($dataProgress,$id_permohonan);
									
									//kirim_email
									$email = "$em_ilnya";
									$subject 	= "Status Verifikasi $noreg";
									$text  = "";
									$text .= "Yth Bapak/Ibu,<br>";
									$text .= "<br>";
									$text .= "Dengan ini kami memberitahukan bahwa :<br>";
									$text .= "$keterangan<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "Hormat Kami <br>";
									$text .= "Admin SIMBG ";
									$this->simbg_lib->sendEmail($email, $subject, $text);
									
								
					}else if($statusnya == '1'){
									
									$em_ilnya = $em_il;
									$tgl_log = date('Y-m-d');
									$keterangan = 'Berkas Persyaratan Telah di Verifikasi Operator dan Menunggu Verifikasi Pengawas';
									$nama_fb = 'Validasi Dinas PTSP';
									$kode_feedback = '20';
									$dataIn = array (
									'id_permohonan' =>$id_permohonan,
									'tgl_log_permohonan' => $tgl_log,
									'keterangan' => $keterangan,
									'kode_proses' => 2,
									'dir_file_proses' => $lampiran,
									'post_date' => $tgl_log,
									'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
									);
									$this->imb_model->insert_log_permohonan($dataIn);
									//$this->imb_model->editProgress($id_permohonan);
									$dataProgress = array (
										
										'status_progress' => 4,
									);
									$this->imb_model->updateProgress($dataProgress,$id_permohonan);
									//feedback to oss
									//$feedback = $this->oss_lib->receiveLicenseStatus($id,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
								
									//kirim_email
									/*$email = $em_ilnya;
									$subject 	= "Status Verifikasi";
									$text  = "";
									$text .= "Yth Bapak/Ibu,<br>";
									$text .= "<br>";
									$text .= "Dengan ini kami memberitahukan bahwa :<br>";
									$text .= "$keterangan<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "Hormat Kami <br>";
									$text .= "Admin SIMBG ";
									$this->simbg_lib->sendEmail($email, $subject, $text);*/
					}
					$this->session->set_flashdata('message','Data Berhasil di Perbaharui.');
					$this->session->set_flashdata('status','success');
					//redirect('imb/verifikasi/');
				}
			redirect('imb/verifikasi/');
		}
		
		if($this->input->post('xstileng')) {
			
								$em_ilnya = $em_il;
								$tgl_log = date('Y-m-d');
								$keterangan = 'Persyaratan Tidak Lengkap, dikembalikan Kepada Pemohon untuk melengkapi persyaratan';
								$nama_fb = 'Validasi Dinas PTSP';
								$kode_feedback = '20';
									$dataIn = array (
										'id_permohonan' => $id_permohonan,
										'tgl_log_permohonan' => $tgl_log,
										'keterangan' => $keterangan,
										'kode_proses' => 11,
										//'dir_file_proses' => $lampiran,
										'post_date' => $tgl_log,
										'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
										);
									//$this->imb_model->editStatustileng($id_permohonan);
									//$this->imb_model->editProgresstileng($id_permohonan);
									$this->imb_model->insert_log_permohonan($dataIn);
									//$feedback = $this->oss_lib->receiveLicenseStatus($id,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
									
									$dataProgress = array (
										'status_syarat' => 2,
										'status_progress' => 2,
									);
									$this->imb_model->updateProgress($dataProgress,$id_permohonan);
									
									//kirim_email
									$email = "$em_ilnya";
									$subject 	= "Status Verifikasi $noreg";
									$text 		= "";
									$text .= "Yth Bapak/Ibu,<br>";
									$text .= "<br>";
									$text .= "Dengan ini kami memberitahukan bahwa :<br>";
									$text .= "$keterangan<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "Hormat Kami <br>";
									$text .= "Admin SIMBG ";
									$this->simbg_lib->sendEmail($email,$subject, $text);
			
					$this->session->set_flashdata('message','Data Berhasil di Perbaharui dan Dikembalikan Kepada Pemohon');
					$this->session->set_flashdata('status','success');
					redirect('imb/validasi_kasie/');
			
		}
		
		if($this->input->post('xsleng')) {
			if($id_kolektif == '2'){
				$this->load->model('mpenerbitan_imb');
				$ttd = $this->mpermohonan->get_pejabat_ttd($id_permohonan);
				$ttd_pejabat_sk = $ttd['kepala_dinas'];
				$nip_pejabat_sk = $ttd['nip_kepala_dinas'];
				$sk_imb = $this->sk_imb($id_permohonan);
				$tgl_sk_imb = date('Y-m-d');
				//$status_validasi_cetak = $this->input->post('status_validasi_cetak');
				
				$dataIn_imb = array(
					'id_permohonan' => $id_permohonan,
					'no_imb' => $sk_imb,
					'tgl_imb' => $tgl_sk_imb,
					'validasi_retribusi'=>1,
					'ttd_pejabat_sk' => $ttd_pejabat_sk,
					'nip_pejabat_sk' => $nip_pejabat_sk
					
				);
				$dataStatus = array(
					'status' => 13,
					'status_progress' => 14,
					);
				$this->mpermohonan->update_permohonan($dataStatus,$id_permohonan);
				$this->mpenerbitan_imb->insert_data_penerbitan_imb($dataIn_imb);
				
				$this->load->library('ciqrcode'); //pemanggilan library QR CODE
				$config['imagedir']     = 'file/IMB/qr_imb/'; //direktori penyimpanan qr code
				$config['quality']      = true; //boolean, the default is true
				$config['size']         = '1024'; //interger, the default is 1024
				$config['black']        = array(224,255,255); // array, default is array(255,255,255)
				$config['white']        = array(70,130,180); // array, default is array(0,0,0)
				$this->ciqrcode->initialize($config);
				$image_name=$sk_imb.'.png'; //buat name dari qr code sesuai dengan nim
				//$params['data'] = 'http://simbg.pu.go.id/admin/lacak/lacak_berkas/'.$sk_imb; //data yang akan di jadikan QR CODE
			 	$params['data'] = 'http://simbg.pu.go.id/main/VerifikasiBerkas/'.$sk_imb; //data yang akan di jadikan QR CODE
			 	
				$params['level'] = 'H'; //H=High
			 	$params['size'] = 10;
			 	$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/

				$data['QR'] = $this->ciqrcode->generate($params);
				
			
			}else{					
				$dataProgress = array (
						'status_syarat' => 1,
						'status_progress' => 5,
					);
				$this->imb_model->updateProgress($dataProgress,$id_permohonan);							
			}
			
			$em_ilnya = $em_il;
			$tgl_log = date('Y-m-d');
			$keterangan = 'Berkas Persyaratan Telah di Verifikasi oleh Pengawas';
			$nama_fb = 'Validasi Dinas PTSP';
			$kode_feedback = '20';
			$dataIn = array (
									'id_permohonan' =>$id_permohonan,
									'tgl_log_permohonan' => $tgl_log,
									'keterangan' => $keterangan,
									'kode_proses' => 3,
									
									'post_date' => $tgl_log,
									'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
							);
									
			$this->imb_model->insert_log_permohonan($dataIn);
			//$feedback = $this->oss_lib->receiveLicenseStatus($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
			$feedback = $this->oss_lib->receiveLicenseStatus($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
			
			//kirim_email
			$email = "$em_ilnya";
			$subject 	= "Status Verifikasi $noreg";
			$text 		= "";
			$text .= "Yth Bapak/Ibu,<br>";
			$text .= "<br>";
			$text .= "Dengan ini kami memberitahukan bahwa :<br>";
			$text .= "$keterangan<br>";
			$text .= "Dan menuju proses berikutnya.";
			$text .= "<br>";
			$text .= "<br>";
			$text .= "Hormat Kami <br>";
			$text .= "Admin SIMBG ";
			$this->simbg_lib->sendEmail($email, $subject, $text);
			
			$this->session->set_flashdata('message','Data Berhasil di Perbaharui');
			$this->session->set_flashdata('status','success');
			redirect('imb/validasi_kasie/');
		}	
	}
	
	function check_status()
	{
		$id= $this->uri->segment(3);
		$id_persyaratan_detail= $this->uri->segment(4);
		$key_syarat = $this->uri->segment(5);
		$data['id_permohonan'] = $id;
		$dataIn = array ('status' => '1');
		try
		{
			$id_perhomonan_bg_syarat =  $this->imb_model->updateValidasi($dataIn,$id,$id_persyaratan_detail);
			if($id_perhomonan_bg_syarat != $id_persyaratan_detail){
				$dataIsi = array (
						'id_permohonan' => $id,
						'id_persyaratan_detail' => $id_persyaratan_detail,
						'status' => '1'
						);
				$this->imb_model->insert_syarat($dataIsi);
			
			}
			//$data['pesan'] = "Data Sukses Di Verifikasi";
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
			
		}catch(Exception $e) 
		{
			
			//$data['err_msg'] = "Data Gagal Di Verifikasi";
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
		
		$permohonan = $this->imb_model->get_permohonan($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$id_jenis_usaha = $permohonan['id_jenis_usaha'];
		$data['pernyataan'] = $permohonan['pernyataan'];
		$luas_bg = $permohonan['luas_bg'];
		$queryCekJum_syarat = $this->imb_model->get_syarat_list($id_j_per,null,$id_jenis_usaha,$luas_bg)->result();
		//$queryCekStatusOK = $this->imb_model->get_syarat(null,$id,'1')->result();
		if($key_syarat == 'adm'){
		$query = $this->imb_model->get_syarat_list($id_j_per,'1',$id_jenis_usaha,$luas_bg);
		}else if ($key_syarat == 'tek'){
		$query = $this->imb_model->get_syarat_list($id_j_per,'2',$id_jenis_usaha,$luas_bg);
		}
		$data['jum_data'] = $query->num_rows();		
		$data['results'] = $query->result();
		$data['model_permohonan'] = $this->imb_model;
		
		//redirect('imb/form_verifikasi/'.$id);
	}
	
	function uncheck_status()
	{
		$id= $this->uri->segment(3);
		$id_persyaratan_detail= $this->uri->segment(4);
		$key_syarat = $this->uri->segment(5);
		$data['id_permohonan'] = $id;
		
		$dataIn = array ('status' => '0');
		try
		{
		$this->imb_model->updateValidasi($dataIn,$id,$id_persyaratan_detail);
		$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
		$this->session->set_flashdata('status','success');
		}catch(Exception $e) 
		{
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
		
		$permohonan = $this->imb_model->get_permohonan($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$id_jenis_usaha = $permohonan['id_jenis_usaha'];
		$data['pernyataan'] = $permohonan['pernyataan'];
		$luas_bg = $permohonan['luas_bg'];
		$queryCekJum_syarat = $this->imb_model->get_syarat_list($id_j_per,null,$id_jenis_usaha,$luas_bg)->result();
		$queryCekStatusOK = $this->imb_model->get_syarat(null,$id,'1')->result();
		
		
		
		if($key_syarat == 'adm'){
		$query = $this->imb_model->get_syarat_list($id_j_per,'1',$id_jenis_usaha,$luas_bg);
		}else{
		$query = $this->imb_model->get_syarat_list($id_j_per,'2',$id_jenis_usaha,$luas_bg);
		}
		
		
		$data['jum_data'] = $query->num_rows();		
		$data['results'] = $query->result();
		$data['model_permohonan'] = $this->imb_model;

		
		if($key_syarat == 'adm'){
			//$this->load->view('permohonan/form_detail_syarat',$data);
		}else{
			//$this->load->view('permohonan/form_detail_syarat_teknis',$data);
		}
	}
	
	function cek_tugas()
	{
		$id= $this->uri->segment(3);
		$id_personal= $this->uri->segment(4);
		$data['id_permohonan'] = $id;
		
		try
		{
			if($id_personal != ''){
				$dataPeg = array (
						'id_permohonan' => $id,
						'id_personal' => $id_personal,
						);
				$this->imb_model->insert_data_penugasan($dataPeg);
			
			}
			//$data['pesan'] = "Data Sukses Di Verifikasi";
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
			
		}catch(Exception $e) 
		{
			
			//$data['err_msg'] = "Data Gagal Di Verifikasi";
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
	
	}
	
	function uncek_tugas()
	{
		$id_permohonan= $this->uri->segment(3);
		$id_personal = $this->uri->segment(4);
		$data['id_permohonan'] = $id_permohonan;
		
		$process = $this->imb_model->HapusDataTugas($id_personal,$id_permohonan);
		if(!$process){
			$this->session->set_flashdata('message','IMB Gagal Dihapus.');
			$this->session->set_flashdata('status','danger');	
		}else{
			$this->session->set_flashdata('message','IMB Berhasil di Hapus.');
			$this->session->set_flashdata('status','success');	
		}
		redirect('imb/verifikasi');
	
	}
	
	function check_status_tanah()
	{
		$id= $this->uri->segment(3);
		$id_permohonan_detail_tanah= $this->uri->segment(4);
		$data['id_permohonan'] = $id;
		
		$dataIn = array ('status_verifikasi_tanah' => '1');
		
		try
		{
			$this->imb_model->update_per_dtanah($dataIn,$id_permohonan_detail_tanah);
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
		
		}catch(Exception $e) 
		{
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
		
		//redirect('permohonan/get_dtailt/'.$id);
	
	}
	
	function uncheck_status_tanah()
	{
		$id= $this->uri->segment(3);
		$id_permohonan_detail_tanah= $this->uri->segment(4);
		$data['id_permohonan'] = $id;
		
		$dataIn = array ('status_verifikasi_tanah' => '');
		
		try
		{
			$this->imb_model->update_per_dtanah($dataIn,$id_permohonan_detail_tanah);
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
		
		}catch(Exception $e) 
		{
			
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
		
		//redirect('permohonan/get_dtailt/'.$id);
	
	}
//Akhir Verifikasi

//
	function penjadwalan()
	{
		$data['dataimb']   = $this->imb_model->getIMBpenjadwalan();
		$data['content']	= $this->load->view('sidang/sidang_list',$data,TRUE);
		$data['title']		=	'Penjadwalan Sidang & Penilaian';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
		//echo json_encode($data);
	}
	
	function retribusi()
	{
		$data['dataimb']   = $this->imb_model->getIMBretribusi();
		$data['content']	= $this->load->view('sidang/retribusi_list',$data,TRUE);
		$data['title']		=	'Penetapan Retribusi IMB';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
		//echo json_encode($data);
	}
	
	function verifikasi_kadis()
	{
		$data['dataimb']   = $this->imb_model->getIMBverifikasikadis2();
		$data['content']	= $this->load->view('sidang/kadis_list',$data,TRUE);
		$data['title']		=	'Verifikasi Penerbitan IMB';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
		//echo json_encode($data);
	}
	
	function penerbitan()
	{
		$data['dataimb']   = $this->imb_model->getIMBverifikasikadis2();
		$data['content']	= $this->load->view('sidang/terbit_list',$data,TRUE);
		$data['title']		=	'Verifikasi Penerbitan IMB';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
		//echo json_encode($data);
	}
//

//Awal Penugasan
	function penugasan()
	{
		$data['dataimb']   = $this->imb_model->getIMBpenugasan();
		$data['content']	= $this->load->view('penugasan/penugasan_list',$data,TRUE);
		$data['title']		=	'Penugasan Tim Teknis';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
		//echo json_encode($data);
	}
	
	function form_penugasan($id_permohonan)
	{
		$data['raw']   = $this->imb_model->getById($id_permohonan);
		$data['rew']   = $this->imb_model->getByIdPtugas($id_permohonan);
		$id = $this->uri->segment(3);
		$que = $this->imb_model->get_permohonan($id)->row_array();
		$id_kabkot = $que['id_kabkot_bg'];
		$id_fbg = $que['id_fungsi_bg'];
		if ($id_fbg == 1)
		{
			$data['judul'] = 'Pilih Tim Teknis';
			$query = $this->imb_model->get_tim_teknis_list(null,null,$id_kabkot);
			$data['result'] = $query->result();
			//$this->list_tim_teknis();
		}else{
			$data['judul'] = 'Pilih Tim TABG';
			$query = $this->imb_model->get_tabg_list2(null,null,$id_kabkot);
			$data['result'] = $query->result();
			//$this->list_tabg_popup2();
		}
		$this->detailin();
		//$this->list_tim_teknis();
		$this->load->view('penugasan/penugasan_form',$data);
		//$this->list_tabg_popup2();
	}
	
	function simpanpenugasan()
	{
		$id_permohonan = $this->uri->segment(3);
			
			
				$tgl_log = date('Y-m-d');
				
				$keterangan = 'Penugasan Tim Teknis Oleh Dinas PUPR';
				$nama_fb = 'Penugasan Tim Teknis';
				$kode_feedback = '20';
				
					$dataIn = array (
						'id_permohonan' => $id_permohonan,
						'tgl_log_permohonan' => $tgl_log,
						'keterangan' => 'Penugasan Tim Teknis Oleh Dinas PUPR',
						'kode_proses' => 4,
						'post_date' => $tgl_log,
						'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
					);
					$dataEn = array(
					'status_penugasan' =>'1',
					'status_progress'  =>'6',
					);
				$this->imb_model->insert_log_permohonan($dataIn);
				$this->imb_model->update_permohonan($dataEn,$id_permohonan);
				//feedback to oss
				//$feedback = $this->oss_lib->receiveLicenseStatus($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
				$this->session->set_flashdata('message','Data Penugasan Berhasil di Simpan');
				$this->session->set_flashdata('status','success');
			
			$this->kirim_email_untuk_tabg($id_permohonan);
			redirect('imb/penugasan/');
		
	
	
	}
	
	function kirim_email_untuk_tabg($id_permohonan)
	{
		$email_pemohon = "";
		$nomor_registrasi = "";
		$text_email = "";
		$this->load->library('PHPMailerAutoload');
        $mail = new PHPMailer();
		$mail->SMTPDebug = false;
        $mail->Debugoutput = 'html';
		// set smtp
        $mail->isSMTP();
        $mail->Host = gethostbyname('ssl://smtp.gmail.com');
        $mail->Port = '465';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
        $mail->Username = 'simbgcs@gmail.com';
        $mail->Password = 'cssimbg88';
        $mail->WordWrap = 50;  
		
		if( ! is_null($id_permohonan) && (trim($id_permohonan) != '') && (trim($id_permohonan) != '0')) {
			$query = $this->imb_model->get_permohonan_list(null,null,null,null,$id_permohonan);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$email_pemohon = $mydata['email'];
				$nomor_registrasi = $mydata['nomor_registrasi'];
			}
			$text_email .= "No Registrasi :".$nomor_registrasi."<br>";
			$text_email .= "Menetapkan Penugasan TABG :<br>";
			$query = $this->imb_model->get_email_list($id_permohonan)->result();;
			foreach ($query as $row) 
			{
				$text_email .= "- ".$row->nama_personal."<br>";
				$mail->AddCC($row->email, $row->nama_personal);
			}
			$text_email .= "Sebagai TIM TABG untuk permohonan dengan No Registrasi :".$nomor_registrasi."<br>";
			$mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
			$mail->addAddress($email_pemohon);
			$mail->Subject = 'Penetapan TIM TABG | CS SIMBG';
			
			$mail->Body = $text_email;
			$mail->isHTML(true); 
			$mail->send();
		}
		
	}
//Akhir Penugasan

//Awal Penerbitan
	function cetak_form_imb()
	{
		$sqlcari = '';
		$id = $this->uri->segment(3);
		$permohonan = $this->Imb_model->get_permohonan($id)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['Kolektif'] = $this->Imb_model->getDataKolektif($id)->row_array();
		
		$tanah = $this->mpenerbitan_imb->tanah($id);
		$data['result_list'] = $this->mpenerbitan_imb->get_penerbitan_imb_pemecahan($id);
		$data['result_cetak'] = $this->mpenerbitan_imb->get_penerbitan_imb_cetak($id);
		
		$data['result_retri'] = $this->mpenerbitan_imb->retribusi($id)->row_array();
		$data['result_teknis'] = $this->mpenerbitan_imb->rek_teknis($id)->row_array();
		$data['result_per'] = $this->mpenerbitan_imb->peraturan($id)->result_array();
		$data['result_uu'] = $this->mpenerbitan_imb->undang2()->result_array();
		$data['result_tanah'] = $tanah->result_array();
		$data['count_tanah'] = $tanah->num_rows();
		$data['head_title'] = '.:: Cetak IMB ::.';
		
		//Begin IMB Kolektif Pemecahan
		//$data['Pemecahan'] = $this->imb_model->getDataPemecahan($id)->row_array();
		//End IMB Kolektif Pemcahan
		if($id_jenis_permohonan == "47"){
			$this->load->view('penerbitan/CetakImbKolektif',$data);
		}elseif($id_jenis_permohonan == "48"){
			$this->load->view('penerbitan/CetakImbPemecahan',$data);
		}else{
			$this->load->view('penerbitan/cetak_imb',$data);
		}
	}
	
	function verkadis()
	{
		$id_permohonan = $this->input->post('id_permohonannya');
		$data['id_permohonan'] = $id_permohonan;
		if (trim($id_permohonan) != '') {
							$this->imb_model->editStatusIMB($id_permohonan);
							$tgl_log = date('Y-m-d');
							//$tgl_log = date('d-m-Y');
							$keterangan = 'IMB Terverivikasi Kadis';
							$nama_fb = 'Hasil Sidang';
							$kode_feedback = '50';
							$data_log = array (
								'id_permohonan' => $id_permohonan,
								'tgl_log_permohonan' => $tgl_log,
								'keterangan' => $keterangan,
								'kode_proses' => 17,
								'post_date' => $tgl_log,
								'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
							);
							$this->imb_model->insert_log_permohonan($data_log);
							//feedback to oss
							$feedback = $this->oss_lib->receiveLicenseStatus($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
							
							$this->kirimin_email($id_permohonan);
							
							$dataStatus = array(
										'status' => 14,
										'status_progress' => 15,
										);
							$this->mpermohonan->update_permohonan($dataStatus,$id_permohonan);
		}
		$this->session->set_flashdata('message','IMB Terverifikasi');
		$this->session->set_flashdata('status','success');
		redirect('imb/verifikasi_kadis');	
	}
	
	function detailin()
	{
		//$this->killSession();
		$id= $this->uri->segment('3');
		$data['id_permohonan'] = $id;

		if(trim($id) != '' && trim($id) != '') {
			$query = $this->mpermohonan->get_detail_imb($id);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['nomor_registrasi'] = $mydata['nomor_registrasi'];
				$data['statusaha'] = $mydata['id_jenis_usaha'];
				
						if($mydata['id_jenis_usaha'] == 1){
							$data['usaha'] = "Perseorangan";
							
						}elseif ($mydata['id_jenis_usaha'] ==2){
							$data['usaha'] = "Badan Usaha/Badan Hukum";
							$data['usaha2'] = "2";
						}elseif($mydata['id_jenis_usaha'] ==3){
							$data['usaha'] = "Pemerintah";
							$data['usaha2'] = "3";
						}else{
							$data['usaha'] = "";
							//$data['usaha2'] = "";
						}	
				
				$data['jenis_urusan'] = $mydata['id_jenis_permohonan'];
				$data['nama'] = $mydata['nama_pemohon'];
				$data['status_progress'] = $mydata['status_progress'];
				$data['jalan'] = $mydata['alamat_pemohon'];
				$data['kelurahan'] = $mydata['kelurahan'];
				$data['kecamatan'] = $mydata['kecamatan'];
				$data['id_kec'] = $mydata['id_kecamatan'];
				$data['id_kec_bg'] = $mydata['id_kec_bg'];
				$data['nama_kec'] = $mydata['nama_kecamatan'];
				$data['id_kabkot'] = $mydata['id_kabkot'];
				$data['id_kabkot_bg'] = $mydata['id_kabkot_bg'];
				$data['nama_kabkota'] = $mydata['nama_kabkota'];
				$data['id_provinsi'] = $mydata['id_provinsi'];
				$data['id_provinsi_bg'] = $mydata['id_provinsi_bg'];
				$data['nama_provinsi'] = $mydata['nama_provinsi'];
				$data['no_tlpn'] = $mydata['no_tlp'];
				$data['email'] = $mydata['email'];
				$data['ktp'] = $mydata['no_ktp'];
				$data['jabdpershn'] = $mydata['jabatan_perusahaan'];
				$data['nm_pershn'] = $mydata['nama_perusahaan'];
				$data['alamat_pershn'] = $mydata['alamat_perusahaan'];
				$data['no_tlpn_pershn'] = $mydata['no_tlp_perusahaan'];
				$data['jalan_lokasi'] = $mydata['alamat_bg'];
				$data['kel'] = $mydata['kelurahan'];
				$data['kec'] = $mydata['kecamatan'];
				$data['stat'] = $mydata['status'];
				$data['id_fungsi_bg'] = $mydata['id_fungsi_bg'];
						
						if($mydata['id_fungsi_bg'] == 5){
							$data['sarana'] = 5;
						}else{
							$data['sarana'] = null;
							//$data['usaha2'] = "";
						}
						
				$data['jns_bangunan'] = $mydata['jns_bangunan'];
				$data['nama_bangunan'] = $mydata['nama_bangunan'];
				$data['username'] = $mydata['username'];
				$data['nama_permohonan'] = $mydata['nama_permohonan'];
				$data['lantai_bg'] = $mydata['lantai_bg'];
				$data['tinggi_bg'] = $mydata['tinggi_bg'];
				$data['luas_bg'] = $mydata['luas_bg'];
				$data['luas_tanah'] = $mydata['luas_tanah'];
				$data['alamat_bg'] = $mydata['alamat_bg'];
				$data['nama_kecamatan_bg'] = $mydata['nama_kecamatan_bg'];
				$data['nama_kabkota_bg'] = $mydata['nama_kabkota_bg'];
				$data['nama_provinsi_bg'] = $mydata['nama_provinsi_bg'];
				$data['id_pemanfaatan_bg'] = $mydata['id_pemanfaatan_bg2'];
				$data['fungsi_bg'] = $mydata['fungsi_bg'];
				$data['id_klasifikasi_bg'] = $mydata['id_klasifikasi_bg'];
						if($mydata['id_klasifikasi_bg'] == 1){
							$data['klasifikasi_bg'] = "Sederhana";
						}elseif ($mydata['id_klasifikasi_bg'] ==2){
							$data['klasifikasi_bg'] = "Tidak Sederhana";
						}elseif($mydata['id_klasifikasi_bg'] ==3){
							$data['klasifikasi_bg'] = "Khusus";
						}else{
							$data['klasifikasi_bg'] = "";
						}
				//$data['tgl_pelaksanaan'] =  tgl_eng_to_ind($mydata['tgl_pelaksanaan']);
				//$data['tgl_permohonan'] =  tgl_eng_to_ind($mydata['tgl_permohonan']);
				$data['id_jenis_bg'] = $mydata['id_jenis_bg'];
						if($mydata['id_jenis_bg'] == 5){
							$data['tsarana'] = 5;
						}else{
							$data['tsarana'] = null;
							//$data['usaha2'] = "";
						}
				$data['id_kolektif'] = $mydata['id_kolektif'];
				$data['id_prasarana_bg'] = $mydata['id_prasarana_bg'];
				$data['tinggi_prasarana'] = $mydata['tinggi_prasarana'];
				$data['luas_prasarana'] = $mydata['luas_prasarana'];
				$data['lapis_basement'] = $mydata['lapis_basement'];
				$data['luas_basement'] = $mydata['luas_basement'];
				$data['retribusi'] = $mydata['retribusi'];
				$data['retribusi_manual'] = $mydata['retribusi_manual'];
				if($mydata['retribusi'] != 0 && $mydata['retribusi'] != null){
					$data['harganya'] = $mydata['retribusi'];
				}else{
					$data['harganya'] = $mydata['retribusi_manual'];
				}

				$data['no_imb'] = $mydata['no_imb'];
				$data['sk_imbkol'] = $mydata['sk_imb_kolektif'];
				$data['luasA'] = $mydata['luasA'];
				$data['luasB'] = $mydata['luasB'];
				$data['luasC'] = $mydata['luasC'];
				$data['luasD'] = $mydata['luasD'];
				$data['unitA'] = $mydata['unitA'];
				$data['unitB'] = $mydata['unitB'];
				$data['unitC'] = $mydata['unitC'];
				$data['unitD'] = $mydata['unitD'];
				$data['tipeA'] = $mydata['tipeA'];
				$data['tipeB'] = $mydata['tipeB'];
				$data['tipeC'] = $mydata['tipeC'];
				$data['tipeD'] = $mydata['tipeD'];
				$data['tinggiA'] = $mydata['tinggiA'];
				$data['tinggiB'] = $mydata['tinggiB'];
				$data['tinggiC'] = $mydata['tinggiC'];
				$data['tinggiD'] = $mydata['tinggiD'];
				//$data['tgl_imb'] = tgl_eng_to_ind($mydata['tgl_imb']);
				//$data['tanggal_penyerahan_imb'] = tgl_eng_to_ind($mydata['tanggal_penyerahan_imb']);
			}
		}
		
		$this->load->view('kosong',$data);
	}
	
//Akhir Penjadwalan

//Awal Verifikasi
	public function validasi_kasie(){
		$data['dataimb']   = $this->imb_model->getIMBkasie();
		$data['content']	= $this->load->view('validasi/validasi_list',$data,TRUE);
		$data['title']		=	'Validasi Berkas Persyaratan';
		$data['heading']		=	'';
		$this->load->view('backend_adm',$data);
		//echo json_encode($data);
	}
	
	public function oss_tes($id_permohonan)
	{
		//$id= $this->uri->segment('3');
		$id_permohonan =$this->uri->segment('3');
		$data['id_permohonan'] = $id_permohonan;
		
		if (trim($id_permohonan) != '') {
							$tgl_log = date('Y-m-d');
							//$tgl_log = date('d-m-Y');
							$keterangan = 'IMB Terverivikasi Kadis';
							$nama_fb = 'TEST';
							$kode_feedback = '90';
							$data_log = array (
								'id_permohonan' => $id_permohonan,
								'tgl_log_permohonan' => $tgl_log,
								'keterangan' => $keterangan,
								'kode_proses' => 17,
								'post_date' => $tgl_log,
								'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
							);
							//$this->imb_model->insert_log_permohonan($data_log);
							//feedback to oss
							//$feedback = $this->oss_lib->receiveLicenseStatus($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
							$feedback = $this->oss_lib->receiveLicense($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
		}
		//redirect('imb/verifikasi_kadis');	
	
	}
	
	public function oss_status($id_permohonan)
	{
		//$id= $this->uri->segment('3');
		$id_permohonan =$this->uri->segment('3');
		$data['id_permohonan'] = $id_permohonan;
		
		if (trim($id_permohonan) != '') {
							$tgl_log = date('Y-m-d');
							//$tgl_log = date('d-m-Y');
							$keterangan = 'IMB Terverivikasi Kadis';
							$nama_fb = 'TEST';
							$kode_feedback = '90';
							$data_log = array (
								'id_permohonan' => $id_permohonan,
								'tgl_log_permohonan' => $tgl_log,
								'keterangan' => $keterangan,
								'kode_proses' => 17,
								'post_date' => $tgl_log,
								'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
							);
							//$this->imb_model->insert_log_permohonan($data_log);
							//feedback to oss
							//$feedback = $this->oss_lib->receiveLicenseStatus($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
							$feedback = $this->oss_lib->receiveLicenseStatus($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
		}
		//redirect('imb/verifikasi_kadis');	
	
	}
	
	public function terbitin ()
	{
		$id_permohonan = $this->input->get('id');
		$data= $this->imb_model->getTerbitIMB('a.*',$id_permohonan);
		echo json_encode($data);
		//$this->load->view('penjadwalan/hsnya',$data);
	}
	
	public function terbitlah ()
	{
		$id_permohonan = $this->input->post('x_id_p');
		$cat = $this->input->post('x_cat_p');
		$nama_p = $this->input->post('x_penerima');
		if (trim($id_permohonan) != '') {
							$tgl_log = date('Y-m-d');
							//$tgl_log = date('d-m-Y');
							$keterangan = 'IMB Terbit';
							$nama_fb = 'Hasil Sidang';
							$kode_feedback = '50';
							$data_log = array (
								'id_permohonan' => $id_permohonan,
								'tgl_log_permohonan' => $tgl_log,
								'keterangan' => $keterangan,
								'kode_proses' => 16,
								'post_date' => $tgl_log,
								'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
							);
							$this->imb_model->insert_log_permohonan($data_log);
							//feedback to oss
							$feedback = $this->oss_lib->receiveLicense($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
							$data_terbit = array (
								'id_permohonan' => $id_permohonan,
								'tanggal_penyerahan' => $tgl_log,
								'catatan' => $cat,
								'nama_penerima' => $nama_p,
								'post_date' => $tgl_log,
								'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
							);
							$this->imb_model->insert_penyerahan($data_terbit);
							
							$this->kiriminlagi_email($id_permohonan,$nama_p,$tgl_log);
							
							$dataStatus = array(
										'status' => 14,
										'status_progress' => 16,
										);
							$this->mpermohonan->update_permohonan($dataStatus,$id_permohonan);
		}
		$this->session->set_flashdata('message','IMB Telah Terbit');
		$this->session->set_flashdata('status','success');
		redirect('imb/penerbitan');	
	}
	
	function kirimin_email($id_permohonan)
	{
		$email_pemohon = "";
		$nomor_registrasi = "";
		$text_email = "";
		$this->load->library('PHPMailerAutoload');
        $mail = new PHPMailer();
		$mail->SMTPDebug = false;
        $mail->Debugoutput = 'html';
		// set smtp
        $mail->isSMTP();
        $mail->Host = gethostbyname('ssl://smtp.gmail.com');
        $mail->Port = '465';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
        $mail->Username = 'simbgcs@gmail.com';
        $mail->Password = 'cssimbg88';
        $mail->WordWrap = 50;  
		
		if( ! is_null($id_permohonan) && (trim($id_permohonan) != '') && (trim($id_permohonan) != '0')) {
			$query = $this->imb_model->get_permohonan_list(null,null,null,null,$id_permohonan);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$email_pemohon = $mydata['email'];
				$nomor_registrasi = $mydata['nomor_registrasi'];
			}
			$text_email .= "Bersama pesan ini menyampaikan permohonan IMB dengan nomor registrasi ".$nomor_registrasi."<br>";
			$text_email .= "Telah terverifikasi oleh Kepala Dinas dan IMB siap untuk diterbitkan. <br>";
			$text_email .= "Diharap pemohon mengunjungi DPMPTSP setempat untuk penyerahan IMB tersebut. <br>";
			$mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
			$mail->addAddress($email_pemohon);
			$mail->Subject = 'IMB Terverifikasi Kepala Dinas | CS SIMBG';
			$mail->Body = $text_email;
			$mail->isHTML(true); 
			$mail->send();
		}
	}
	
	function kiriminlagi_email($id_permohonan,$nama_p,$tgl_log)
	{
		$email_pemohon = "";
		$nomor_registrasi = "";
		$text_email = "";
		$this->load->library('PHPMailerAutoload');
        $mail = new PHPMailer();
		$mail->SMTPDebug = false;
        $mail->Debugoutput = 'html';
		// set smtp
        $mail->isSMTP();
        $mail->Host = gethostbyname('ssl://smtp.gmail.com');
        $mail->Port = '465';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
        $mail->Username = 'simbgcs@gmail.com';
        $mail->Password = 'cssimbg88';
        $mail->WordWrap = 50;  
		
		if( ! is_null($id_permohonan) && (trim($id_permohonan) != '') && (trim($id_permohonan) != '0')) {
			$query = $this->imb_model->get_permohonan_list(null,null,null,null,$id_permohonan);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$email_pemohon = $mydata['email'];
				$nomor_registrasi = $mydata['nomor_registrasi'];
			}
			//$text_email .= "No Registrasi :".$nomor_registrasi."<br>";
			$text_email .= "Bersama pesan ini menyampaikan permohonan IMB dengan nomor registrasi ".$nomor_registrasi." Telah Terbit. <br>";
			$text_email .= "Diserahkan pada tanggal ".$tgl_log." dan diterima oleh ".$nama_p.", Terima Kasih.<br>";
			
			$mail->setFrom('simbgcs@gmail.com', 'CS SIMBG');
			$mail->addAddress($email_pemohon);
			$mail->Subject = 'Penerbitan IMB | CS SIMBG';
			
			$mail->Body = $text_email;
			$mail->isHTML(true); 
        
			$mail->send();
		}
		
	}
	
	function sk_imb($id=null)
	{
	    $que = $this->mpermohonan->get_id_kabkot($id);
			$id_skrg = $que['id_kabkot_bg'];
			$no_reg_awal = $que['id_kec_bg'];
			$tgl_disetujui = date('d').date('m').date('Y');;
			$mydata2 = $this->mpermohonan->get_imb_akhir($id_skrg,$tgl_disetujui);
	    if(count($mydata2)>0){
	      $no_baru = SUBSTR($mydata2['no_registrasi_baru'],-2)+1;
	      if ($no_baru < 10){
					$sk_imb = "SK-IMB-".$no_reg_awal."-".$tgl_disetujui."-0".$no_baru;
	      }else {
	        $sk_imb = "SK-IMB-".$no_reg_awal."-".$tgl_disetujui."-".$no_baru;
	      }
	    } else {
	      $sk_imb = "SK-IMB-".$no_reg_awal."-".$tgl_disetujui."-01";
	    }
			return $sk_imb;
	}
	
}

