<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Slf extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->helper('utility');
		$this->load->model('mslf');
		$this->load->model('mglobal');
		$this->load->model('mglobalslf');
		$this->load->library('simbg_lib');
		//$this->load->helper(array('form', 'url'));
		//$this->load->library('oss_lib');
		$this->simbg_lib->check_session_login();
	}
	
	function killSession()
	{
		$this->session->unset_userdata('pencarian');	
	}
	
	public function index()
	{	 
		redirect('#');
	}
	
	//Begin List Verifikasi Berkas
	public function verifikasi()
	{
		$id_kabkota 				= $this->session->userdata('loc_id_kabkot');
		$id_kabkota = '';
		$id_rule					= $this->session->userdata('loc_role_id');
		$filterQuery				= ' a.*,
										e.nama_kabkota,
										d.nama_provinsi,
										f.nama_kecamatan,
										g.nama_permohonan
										';
		$data['list_permohonan'] 	= $this->mslf->getDataPermohonan($filterQuery,$id_kabkota);
		$list_permohonan 			= $this->mslf->getDataPermohonan($filterQuery,$id_kabkota);
		$data['jum_data'] 			= $list_permohonan->num_rows();
		$data['content']			= $this->load->view('verifikasi/VerifikasiList',$data,TRUE);
		$data['title']				=	'Verifikasi SLF';
		$data['heading']			=	'';
		$this->load->view('backend_adm',$data);
	}
	
	public function FormVerifikasi($id)
	{
		$id					= $this->uri->segment(3);
		$pengajuan_id		= $this->uri->segment(3);
		$id_nama_permohonan	= $this->uri->segment(4);
		
		$data['row']   		= $this->mslf->getById($id);
		$data['tanah']		= $this->mslf->getByIdTanah($id);
		$data['datastatus'] = $this->mslf->getByIdStatus($id);
		
		if($id != '' && $id_nama_permohonan != ''){
			$data['DataAdministrasi']	= $this->mslf->getSlfAdministrasi('a.*',$id);
			$filterQuery				= 'b.id_persyaratan_detail,b.id_syarat,c.nama_syarat';
			$data['MasterAdministrasi']	= $this->mslf->getMasterSlfAdministrasi($filterQuery,$id_nama_permohonan);
		}
		
		if($pengajuan_id != '' && $id_nama_permohonan != ''){
			$filterSummary	= 'a.*,e.*	
								';
			$data['DataSummary']		= $this->mslf->getDataSummaryTeknis($filterSummary,$pengajuan_id)->row_array();
			
			$data['DataTeknis']		= $this->mslf->getDataTeknis('a.*',$pengajuan_id);
			$filterQuery			= 'b.id_persyaratan_detail,b.id_syarat,c.nama_syarat';
			$data['MasterTeknis']	= $this->mslf->getMasterTeknis($filterQuery,$id_nama_permohonan);
		}
		
		$this->load->view('verifikasi/FormVerifikasi',$data);
	}
	
	public function check_status_tanah()
	{
		$id= $this->uri->segment(3);
		$id_tanah= $this->uri->segment(4);
		$data['id_permohonan'] = $id;
		$dataIn = array ('verifikasi' => '1');
		try
		{
			$this->mslf->update_per_dtanah($dataIn,$id_tanah);
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
		
		}catch(Exception $e) 
		{
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
	}
	
	public function uncheck_status_tanah()
	{
		$id= $this->uri->segment(3);
		$id_tanah= $this->uri->segment(4);
		$data['id_permohonan'] = $id;
		$dataIn = array ('verifikasi' => '');
		try
		{
			$this->mslf->update_per_dtanah($dataIn,$id_tanah);
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
		}catch(Exception $e) 
		{
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
	}
	
	public function check_status()
	{
		$pengajuan_id	= $this->uri->segment(3);
		$id_syarat 		= $this->uri->segment(4);
		$key_syarat 	= $this->uri->segment(5);
		$dataIn = array ('pengajuan_id'=>$pengajuan_id,'id_dokumen_permohonan'=>$id_syarat,'verifikasi' => '1');
		try
		{
			if($key_syarat == 'adm')
			{
				$query	= $this->mglobalslf->setData2Filter('tm_slf_administrasi',$dataIn,'pengajuan_id',$pengajuan_id,'id_dokumen_permohonan',$id_syarat);
				if(empty($query)){$this->mglobalslf->setData('tm_slf_administrasi',$dataIn,'pengajuan_id','');}
			}else if($key_syarat == 'tek'){
				$query	= $this->mglobalslf->setData2Filter('tm_slf_teknis',$dataIn,'pengajuan_id',$pengajuan_id,'id_dokumen_permohonan',$id_syarat);
				if(empty($query)){$this->mglobalslf->setData('tm_slf_teknis',$dataIn,'pengajuan_id','');}
			}
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
		}catch(Exception $e) 
		{
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
		$this->cek_kelengkapan_syarat($pengajuan_id,$key_syarat);
	}
	
	public function uncheck_status()
	{
		$pengajuan_id	= $this->uri->segment(3);
		$id_syarat 		= $this->uri->segment(4);
		$key_syarat 	= $this->uri->segment(5);
		
		$dataIn = array ('pengajuan_id'=>$pengajuan_id,'id_dokumen_permohonan'=>$id_syarat,'verifikasi' => null);
		try
		{
			if($key_syarat == 'adm')
			{
				$query	= $this->mglobalslf->setData2Filter('tm_slf_administrasi',$dataIn,'pengajuan_id',$pengajuan_id,'id_dokumen_permohonan',$id_syarat);
			}else{
				$query	= $this->mglobalslf->setData2Filter('tm_slf_teknis',$dataIn,'pengajuan_id',$pengajuan_id,'id_dokumen_permohonan',$id_syarat);
			}
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
		}catch(Exception $e) 
		{	
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
		$this->cek_kelengkapan_syarat($pengajuan_id,$key_syarat);
	}
	
	public function cek_kelengkapan_syarat($pengajuan_id,$key_syarat)
	{
		$permohonan = $this->mslf->get_permohonan($pengajuan_id)->row_array();
		$id_nama_permohonan = $permohonan['id_nama_permohonan'];
		
		if($key_syarat == "adm")
		{
			$queryCekJum_syarat = $this->mslf->getMasterSlfAdministrasi($select="a.*",$id_nama_permohonan)->result();
			$queryCekStatusOK 	= $this->mslf->getSlfAdministrasi($select="a.*",$pengajuan_id,'1')->result();
			if(count($queryCekStatusOK) == count($queryCekJum_syarat)){
				$dataUpdateStatusSyarat = array ('status_data_administrasi' => '1');
				$insert = $this->mglobalslf->setData('tm_slf_pengajuan',$dataUpdateStatusSyarat,'id',$pengajuan_id);
			}else{
				$dataUpdateStatusSyarat = array ('status_data_administrasi' => null);
				$insert = $this->mglobalslf->setData('tm_slf_pengajuan',$dataUpdateStatusSyarat,'id',$pengajuan_id);
			}
		}else{
			$queryCekJum_syarat = $this->mslf->getMasterTeknis($select="a.*",$id_nama_permohonan)->result();
			$queryCekStatusOK 	= $this->mslf->getDataTeknis($select="a.*",$pengajuan_id,'1')->result();
			if(count($queryCekStatusOK) == count($queryCekJum_syarat)){
				$dataUpdateStatusSyarat = array ('status_data_teknis' => '1');
				$insert = $this->mglobalslf->setData('tm_slf_pengajuan',$dataUpdateStatusSyarat,'id',$pengajuan_id);
			}else{
				$dataUpdateStatusSyarat = array ('status_data_teknis' => null);
				$insert = $this->mglobalslf->setData('tm_slf_pengajuan',$dataUpdateStatusSyarat,'id',$pengajuan_id);
			}
		}
		if($key_syarat == "adm"){
			//redirect('permohonan_slf/get_data_administrasi/'.$pengajuan_id.'/'.$id_nama_permohonan);
		}else{
			//redirect('permohonan_slf/get_data_teknis/'.$pengajuan_id.'/'.$id_nama_permohonan);
		}
	}
	
	public function SimpanStatusSLF()
	{
		$id_permohonan_slf	= $this->input->post('id');
		//$dir_file_pemberitahuan = $this->input->post('dir_file_pemberitahuan');
		$statusnya	= $this->input->post('status_syarat');
		$lampiran=$this->input->post('filename_pemberitahuan');
		$em_il=$this->input->post('em_il');
		$noreg=$this->input->post('noreg');
		
		//upload Files
		if($this->input->post('xstin')) {
			
				//Upload file
				$filenya = 'dir_file_pemberitahuan';
				$lampir=$this->input->post('filename_pemberitahuan');
				$thisdir = getcwd();
				$dirPath = $thisdir."/file/SLF/$id_permohonan_slf/pemberitahuan/";
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
					
					
					$dataStatusnya = array(
						"id" => $this->input->post('id_status'),
						"id_permohonan_slf" => $id_permohonan_slf,
						"id_kelengkapan_syarat" => $statusnya,
						"no_surat_pemberitahuan" => $this->input->post('no_surat_pemberitahuan'),
						"dir_file_surat_pemberitahuan" => $lampiran,
						"catatan" => $this->input->post('catatan'),
						"tgl_surat_pemberitahuan" => date('Y-m-d'),
						"post_date" => date('Y-m-d'),
						"last_update" => date('Y-m-d H:i:s'),
						"post_by" => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
					);
					
					//$this->mslf->saveStatusSLF();
					$this->mslf->saveStatusSLF($dataStatusnya);
					
					if($statusnya == '1'){
								$em_ilnya = $em_il;
								$tgl_log = date('Y-m-d');
								$keterangan = 'Persyaratan Tidak Lengkap, dikembalikan Kepada Pemohon untuk melengkapi persyaratan';
								$nama_fb = 'Validasi Dinas PTSP';
								$kode_feedback = '20';
									$dataIn = array (
										'id_permohonan_slf' => $id_permohonan_slf,
										'tgl_log_permohonan' => $tgl_log,
										'keterangan' => $keterangan,
										'kode_proses' => 11,
										'dir_file_proses' => $lampiran,
										'post_date' => $tgl_log,
										'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
									);
									
									$this->mslf->insert_log_slf($dataIn);
									//$feedback = $this->oss_lib->receiveLicenseStatus($id,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
									$dataProgress = array (
										
										'status_progress' => 2,
										//'status' => 1,
									);
									$this->mslf->updateProgress($dataProgress,$id_permohonan_slf);
									
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
									
								
					}else if($statusnya == '3'){
									
									$em_ilnya = $em_il;
									$tgl_log = date('Y-m-d');
									$keterangan = 'Berkas Persyaratan Telah di Verifikasi Operator dan Menunggu Verifikasi Pengawas';
									$nama_fb = 'Validasi Dinas PTSP';
									$kode_feedback = '20';
									$dataIn = array (
									'id_permohonan_slf' =>$id_permohonan_slf,
									'tgl_log_permohonan' => $tgl_log,
									'keterangan' => $keterangan,
									'kode_proses' => 2,
									'dir_file_proses' => $lampiran,
									'post_date' => $tgl_log,
									'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
									);
									$this->mslf->insert_log_slf($dataIn);
									//$this->imb_model->editProgress($id_permohonan);
									$dataProgress = array (
										
										'status_progress' => 4,
										//'status' => 3,
									);
									$this->mslf->updateProgress($dataProgress,$id_permohonan_slf);
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
			redirect('slf/verifikasi/');
		}
		
		
		if($this->input->post('xstileng')) {
			
								$em_ilnya = $em_il;
								$tgl_log = date('Y-m-d');
								$keterangan = 'Persyaratan Tidak Lengkap, dikembalikan Kepada Pemohon untuk melengkapi persyaratan';
								$nama_fb = 'Validasi Dinas PTSP';
								$kode_feedback = '20';
									$dataIn = array (
										'id_permohonan_slf' => $id_permohonan_slf,
										'tgl_log_permohonan' => $tgl_log,
										'keterangan' => $keterangan,
										'kode_proses' => 11,
										//'dir_file_proses' => $lampiran,
										'post_date' => $tgl_log,
										'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
										);
									
									$this->mslf->insert_log_slf($dataIn);
									//$feedback = $this->oss_lib->receiveLicenseStatus($id,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
									
									$dataProgress = array (
										
										'status_progress' => 2,
										//'status' => 3,
									);
									$this->mslf->updateProgress($dataProgress,$id_permohonan_slf);
									
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
									$this->simbg_lib->sendEmail($email, $subject, $text);
			
			$this->session->set_flashdata('message','Data Berhasil di Perbaharui');
			$this->session->set_flashdata('status','success');
			redirect('slf/validasi/');
			
		}
		
		if($this->input->post('xsleng')) {
									$em_ilnya = $em_il;
									$tgl_log = date('Y-m-d');
									$keterangan = 'Berkas Persyaratan Sudah di Verifikasi';
									$nama_fb = 'Validasi Dinas PTSP';
									$kode_feedback = '20';
									$dataIn = array (
									'id_permohonan_slf' =>$id_permohonan_slf,
									'tgl_log_permohonan' => $tgl_log,
									'keterangan' => $keterangan,
									'kode_proses' => 3,
									//'dir_file_proses' => $lampiran,
									'post_date' => $tgl_log,
									'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
									);
									
									$this->mslf->insert_log_slf($dataIn);
									//$feedback = $this->oss_lib->receiveLicenseStatus($id,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
									
									$dataProgress = array (
										
										'status_progress' => 6,
										//'status' => 3,
									);
									$this->mslf->updateProgress($dataProgress,$id_permohonan_slf);
									
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
									$this->simbg_lib->sendEmail($email, $subject, $text);
			
			$this->session->set_flashdata('message','Data Berhasil di Perbaharui');
			$this->session->set_flashdata('status','success');
			redirect('slf/validasi/');
		}
			
	}
	//End List Verifikasi Berkas
	
	//Begin List Pemeriksaan
	public function pemeriksaan_teknis()
	{
		
		
		$id_kabkota 				= $this->session->userdata('loc_id_kabkot');
		$id_kabkota = '';
		$id_rule					= $this->session->userdata('loc_role_id');
		
		//echo $id_kabkota	;
		$filterQuery				= '	a.*,d.nama_provinsi,e.nama_kabkota,f.nama_kecamatan,g.nama_permohonan';
		$data['list_pemeriksaan'] 	= $this->mslf->getDataPemeriksaanDokumen($filterQuery,$id_kabkota);
		
		$data['content']			= $this->load->view('pemeriksaan/pemeriksaan_list',$data,TRUE);
		$data['title']				=	'Pemeriksaan Teknis SLF';
		$data['heading']			=	'';
		$this->load->view('backend_adm',$data);
	}
	
	public function FormPemeriksaan()
	{
		//$data['title']				=	'Pemeriksaan Teknis SLF';
		$pengajuan_id				= $this->uri->segment(3);
		$id_jenis_permohonan		= $this->uri->segment(4);
		$data['pengajuan_id']		= $pengajuan_id;
		$data['id_permohonan_slf']	= $this->uri->segment(3);
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		//$id							= $this->uri->segment(3);
		$data['DataPermohonan'] = $this->mslf->getDataUserSLF('a.*', $pengajuan_id);
		$data['daftar_provinsi']	= $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		if (isset($data['DataPermohonan']->id_provinsi)) {
			$provinsi = $data['DataPermohonan']->id_provinsi;
			$data['daftar_kabkota']		= $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $provinsi);
		}
		if (isset($data['DataPermohonan']->id_kabkot)) {
			$kabkot = $data['DataPermohonan']->id_kabkot;
			$data['daftar_kecamatan']	= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $kabkot);
		}
		if (isset($data['DataPermohonan']->id_provinsi_bg)) {
			$provinsi = $data['DataPermohonan']->id_provinsi_bg;
			$data['daftar_kabkota_bg']		= $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $provinsi);
		}
		if (isset($data['DataPermohonan']->id_kabkot_bg)) {
			$kabkot = $data['DataPermohonan']->id_kabkot_bg;
			$data['daftar_kecamatan_bg']	= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $kabkot);
		}
		$queFungsi = $this->mslf->get_jenis_fungsi_list()->result();
		$list_fungsi[''] = '--Pilih--';
		foreach ($queFungsi as $row) 
		{
			$list_fungsi[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		$data['list_fungsi'] = $list_fungsi;
		
		if($pengajuan_id != ''){
			//Get Data Pokok
			$data['row']   		= $this->mslf->getById($pengajuan_id);
			//End Data Pokok
			$detailData	= $this->mslf->getDataKesesuaian('a.*',$pengajuan_id)->row_array();
			if($pengajuan_id != '' && $id_jenis_permohonan != ''){
				$data['DataTeknis']		= $this->mslf->getDataTeknis('a.*',$pengajuan_id);
				$filterQuery			= 'b.id_persyaratan_detail,b.id_syarat,c.nama_syarat';
				$data['MasterTeknis']	= $this->mslf->getMasterTeknis($filterQuery,$id_jenis_permohonan);
			}
			if(count($detailData) > 0){
				$data['id']								= $detailData['id'];
				$data['id_hasil_pemeriksaan_kesesuaian']= $detailData['id_hasil_pemeriksaan_kesesuaian'];
				$data['id_konfirmasi_verlap']			= $detailData['id_konfirmasi_verlap'];
				$data['catatan']						= $detailData['catatan'];
			}else{
				$data['id_hasil_pemeriksaan_kesesuaian']= 0;
				$data['id_konfirmasi_verlap']			= 0;
				$data['catatan']						="";
			}
		}
		//$data['contents']			= $this->load->view('permohonan_slf/pemeriksaan/pemeriksaan_form',$data,TRUE);
		$data['title']				=	'Pemeriksaan Teknis SLF';
		$data['heading']			=	'';
		$data['content']			= $this->load->view('pemeriksaan/pemeriksaan_form',$data,TRUE);
		$this->load->view('backend_adm',$data);
		//$this->load->view('pemeriksaan/pemeriksaan_form',$data);
	}
	
	function penilaian_teknis()
	{
		//$this->killSession();
		$id_permohonan_slf = $this->input->post('toid');
		$peng_id = $this->input->post('toid2');
		$permohonan = $this->mslf->get_permohonan_slf($id_permohonan_slf)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query1 = $this->mslf->get_syarat_list($id_j_per,'2');
		$query_insert = $query1->result_array();
		for($i=0;$i<count($query_insert);$i++) {
			$toid = $this->input->post('toid');
			$id_persyaratan_detail = $query_insert[$i]['id_persyaratan_detail'];
			$id_penilaian = $this->input->post('id_nilai_'.$id_persyaratan_detail);
			
			$dataRT2=array (
					'id_permohonan_slf' => $toid,
					'id_persyaratan_detail' => $id_persyaratan_detail,
					'kesesuaian' => $this->input->post('kesesuaian_'.$id_persyaratan_detail),
					);
			if($id_penilaian == ''){
				$this->mslf->insert_data_penilaian($dataRT2);
			}else{
				$this->mslf->update_data_penilaian($dataRT2,$id_penilaian);
			}
		}
		$this->session->set_flashdata('message','Data Berhasil di Perbaharui');
		$this->session->set_flashdata('status','success');
		redirect('slf/FormPemeriksaan/'.$id_permohonan_slf.'/'.$peng_id);
		
	}
	
	public function submit_pemeriksaan()
	{
		$id									= $this->input->post('totoid2');
		$id_permohonan_slf					= $this->input->post('totoid');
		$id_jenis_permohonan				= $this->input->post('totoid3');
		$id_hasil_pemeriksaan_kesesuaian	= $this->input->post('id_hasil_pemeriksaan_kesesuaian');
		$id_konfirmasi_verlap				= $this->input->post('id_konfirmasi_verlap');
		$catatan							= $this->input->post('catatan');
		$em_il=$this->input->post('em_il');
		$noreg=$this->input->post('noreg');
		$ikv=$id_konfirmasi_verlap;
		$data	= $this->mslf->get_id_kabkot_bg($id_permohonan_slf);
		$tgl_disetujui = date('Y-m-d');
		$sk_slf = $this->mslf->get_sk_slf_akhir($data['id_kabkot_bg'],$tgl_disetujui,$data['id_kecamatan_bg']);
		if ($sk_slf['no_registrasi_baru'] != '' || $sk_slf['no_registrasi_baru'] != null) 
		{
			$sk_slf_baru = $this->sk_slf_baru($data['id_kecamatan_bg'], date('dmY'), $sk_slf);
		} else {
			$sk_slf_baru = "SK-SLF-".$data['id_kecamatan_bg']."-".date('dmY')."-01";
		}
		$ttd_pejabat_sk = $data['kepala_dinas'];
		$nip_pejabat_sk = $data['nip_kepala_dinas'];
		
		if($this->input->post('simpan')) {
			$data2	= array(
							'id_permohonan_slf'=>$id_permohonan_slf,
							'id_hasil_pemeriksaan_kesesuaian'=>$id_hasil_pemeriksaan_kesesuaian,
							'id_konfirmasi_verlap'=>$id_konfirmasi_verlap,
							'catatan'=>$catatan,
					);
			if($id_hasil_pemeriksaan_kesesuaian == '1'){
				if ($this->input->post('id_konfirmasi_verlap') == 2){
					$dataPengesahan =array(
						'id_permohonan_slf'=>$id_permohonan_slf,
						'no_slf' => $sk_slf_baru,
						'tgl_terbit_slf' => $tgl_disetujui,
						'ttd_pejabat_sk' => $ttd_pejabat_sk,
						'nip_pejabat_sk' => $nip_pejabat_sk,
					);
					$dataUpdateStatus = array(
						'status' => '6',
						'status_progress' => '14',
					);
					$this->qr_slf($sk_slf_baru);
					
					$query2		= $this->mglobals->setData('tm_slf_pengesahan',$dataPengesahan,'id',$id);
					
					//kirim_email
									$email = "$em_il";
									$subject 	= "Status Verifikasi $noreg";
									$text 		= "";
									$text .= "Yth Bapak/Ibu,<br>";
									$text .= "<br>";
									$text .= "Dengan ini kami memberitahukan bahwa :<br>";
									$text .= "Permohonan Telah Disetujui Tanpa Verifikasi Lapangan.<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "Hormat Kami <br>";
									$text .= "Admin SIMBG ";
									$this->simbg_lib->sendEmail($email, $subject, $text);
					
				}else{
					$dataUpdateStatus = array(
						'status' => '5',
						'status_progress' => '13',
					);
					//kirim_email
									$email = "$em_il";
									$subject 	= "Status Verifikasi $noreg";
									$text 		= "";
									$text .= "Yth Bapak/Ibu,<br>";
									$text .= "<br>";
									$text .= "Dengan ini kami memberitahukan bahwa :<br>";
									$text .= "Permohonan Menunggu Verifikasi Lapangan.<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "Hormat Kami <br>";
									$text .= "Admin SIMBG ";
									$this->simbg_lib->sendEmail($email, $subject, $text);
				}
				
			}else{
					$dataUpdateStatus = array ('status_progress' => '19');
					//kirim_email
									$email = "$em_il";
									$subject 	= "Status Verifikasi $noreg";
									$text 		= "";
									$text .= "Yth Bapak/Ibu,<br>";
									$text .= "<br>";
									$text .= "Dengan ini kami memberitahukan bahwa :<br>";
									$text .= "Permohonan Ditolak.<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "Hormat Kami <br>";
									$text .= "Admin SIMBG ";
									$this->simbg_lib->sendEmail($email, $subject, $text);
			}
			
			$insert = $this->mglobals->setData('tm_slf_permohonan',$dataUpdateStatus,'id_permohonan_slf',$id_permohonan_slf);
			$query	= $this->mglobals->setData('tm_pemeriksaan_kesesuaian',$data2,'id',$id);
			$this->session->set_flashdata('message','Data Berhasil di Perbaharui');
			$this->session->set_flashdata('status','success');
			redirect('slf/pemeriksaan_teknis');
		}
		
	}
	
	public function hasil_verlap()
	{
		$id					= "";
		$id_permohonan_slf	= $this->input->post('ids');
		$email				= $this->input->post('email');
		$noreg				= $this->input->post('noreg');
		
		$data				= $this->mslf->get_id_kabkot_bg($id_permohonan_slf);
		$tgl_disetujui 		= date('Y-m-d');
		$sk_slf 			= $this->mslf->get_sk_slf_akhir($data['id_kabkot_bg'],$tgl_disetujui,$data['id_kecamatan_bg']);
		if ($sk_slf['no_registrasi_baru'] != '' || $sk_slf['no_registrasi_baru'] != null) 
		{
			$sk_slf_baru = $this->sk_slf_baru($data['id_kecamatan_bg'], date('dmY'), $sk_slf);
		} else {
			$sk_slf_baru = "SK-SLF-".$data['id_kecamatan_bg']."-".date('dmY')."-01";
		}
		$ttd_pejabat_sk = $data['kepala_dinas'];
		$nip_pejabat_sk = $data['nip_kepala_dinas'];

		if($this->input->post('xsleng')) {

			$dataPengesahan =array(
						'id_permohonan_slf'=>$id_permohonan_slf,
						'no_slf' => $sk_slf_baru,
						'tgl_terbit_slf' => $tgl_disetujui,
						'ttd_pejabat_sk' => $ttd_pejabat_sk,
						'nip_pejabat_sk' => $nip_pejabat_sk,
					);
			$dataUpdateStatus = array(
						'status' => '6',
						'status_progress' => '14',
					);
			
			$this->qr_slf($sk_slf_baru);
					
			$query2		= $this->mglobals->setData('tm_slf_pengesahan',$dataPengesahan,'id',$id);
			$insert = $this->mglobals->setData('tm_slf_permohonan',$dataUpdateStatus,'id_permohonan_slf',$id_permohonan_slf);
				//kirim_email
									$email = "$em_il";
									$subject 	= "Status Verifikasi $noreg";
									$text 		= "";
									$text .= "Yth Bapak/Ibu,<br>";
									$text .= "<br>";
									$text .= "Dengan ini kami memberitahukan bahwa :<br>";
									$text .= "Hasil Verifikasi Lapangan Sesuai dan Menunggu Penerbitan SLF.<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "Hormat Kami <br>";
									$text .= "Admin SIMBG ";
									$this->simbg_lib->sendEmail($email, $subject, $text);
			$this->session->set_flashdata('message','Data Berhasil di Perbaharui');
			$this->session->set_flashdata('status','success');
			redirect('slf/pemeriksaan_teknis');
		}
		
		//Upload file
				
				$tanggal_verlap = $this->input->post('tanggalverlap');
				$filenya = 'xekomtek';
				$lampir	 = $this->input->post('filename_xekomtek');
				$thisdir = getcwd();
				$dirPath = $thisdir."/file/SLF/$id_permohonan_slf/rekomtek/";
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
			
		if($this->input->post('xsrekom')) {

				if ((!$this->upload->do_upload($filenya)) && ($lampir != '') ){
					//$error['upload'] = $this->upload->display_errors();
					$this->session->set_flashdata('message','Data Gagal di Perbaharui, Periksa Kembali File yang di Unggah');
					$this->session->set_flashdata('status','danger');
					redirect('slf/pemeriksaan_teknis');
				}else{
					if($lampir != ''){
						$file=$this->upload->data();
						$lampiran=$file['file_name'];
					}else{
						$lampiran=$this->input->post('filename_xekomtek');
					}
			
					$dataPengesahan =array(
						'id_permohonan_slf'=>$id_permohonan_slf,
						'no_slf' => 'REKOMENDASI TEKNIS',
						'tgl_terbit_slf' => $tgl_disetujui,
						'ttd_pejabat_sk' => $ttd_pejabat_sk,
						'nip_pejabat_sk' => $nip_pejabat_sk,
						'tanggal_verlap' => $tanggal_verlap,
						'file_rekomtek'  => $lampiran,
						);
					$dataUpdateStatus = array(
						'status' => '7',
						'status_progress' => '15',
						);
	
					$query2		= $this->mglobals->setData('tm_slf_pengesahan',$dataPengesahan,'id',$id);
					$insert = $this->mglobals->setData('tm_slf_permohonan',$dataUpdateStatus,'id_permohonan_slf',$id_permohonan_slf);
					//kirim_email
									$email = "$em_il";
									$subject 	= "Status Verifikasi $noreg";
									$text 		= "";
									$text .= "Yth Bapak/Ibu,<br>";
									$text .= "<br>";
									$text .= "Dengan ini kami memberitahukan bahwa :<br>";
									$text .= "Hasil Verifikasi Lapangan Tidak Sesuai dan Akan di Terbitkan Rekomendasi Teknis.<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "Hormat Kami <br>";
									$text .= "Admin SIMBG ";
									$this->simbg_lib->sendEmail($email, $subject, $text);
					$this->session->set_flashdata('message','Data Berhasil di Perbaharui');
					$this->session->set_flashdata('status','success');
					redirect('slf/pemeriksaan_teknis');
				}	
		}
		
	}
	
	public function sk_slf_baru($id_kecamatan_bg, $tgl_disetujui, $sk_slf)
	{
		if(count($sk_slf)>0){
			$no_baru = SUBSTR($sk_slf['no_registrasi_baru'],-2)+1;
			if ($no_baru < 10){
				$no_skslf = "SK-SLF-".$id_kecamatan_bg."-".$tgl_disetujui."-0".$no_baru;
			}else {
				$no_skslf = "SK-SLF-".$id_kecamatan_bg."-".$tgl_disetujui."-".$no_baru;
			}
		} else {
			$no_skslf = "SK-SLF-".$id_kecamatan_bg."-".$tgl_disetujui."-01";
		}
		return $no_skslf;
	}
	
	function qr_slf($nim='')
	{
		$this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['imagedir']     = 'file/SLF/qr_slf/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $image_name=$nim.'.png'; //buat name dari qr code sesuai dengan nim
				//$params['data'] = 'http://simbg.pu.go.id/admin/lacak/lacak_berkas/'.$nim; //data yang akan di jadikan QR CODE
			 	$params['data'] = 'http://simbg.pu.go.id/main/DataSKSimbg/'.$nim;
				$params['level'] = 'H'; //H=High
			 	$params['size'] = 10;
			 	$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
				return $data['QR'] = $this->ciqrcode->generate($params);
	}
	
	//End List Pemeriksaan
	
	
	//Awal Penerbitan
	public function penerbitan_list()
	{				
		$id_kabkota = '';
		$id_rule					= $this->session->userdata('loc_role_id');
		
		$filterQuery				= 'a.*,
										d.nama_provinsi,e.nama_kabkota,f.nama_kecamatan,g.nama_permohonan,i.no_slf,file_rekomtek';
		$data['list_penerbitan'] 	= $this->mslf->getDataPenerbitanSLF($filterQuery,$id_kabkota);
		$list_penerbitan 			= $this->mslf->getDataPenerbitanSLF($filterQuery,$id_kabkota);
		//$data['jum_data'] 			= $list_penerbitan->num_rows();
		$data['content']			= $this->load->view('Penerbitan/kadis_slf',$data,TRUE);
		$data['title']				=	'Verifikasi Penerbitan SLF';
		$data['heading']			=	'';
		$this->load->view('backend_adm',$data);
	}
	
	public function Cetak_SLF()
	{
		$id = $this->uri->segment(3);
		$montharray = Array("Januari","Februari","Maret","April","Mei","Juni","July","Agustus","September","Oktober","November","Desember");
		$date_now = date('Y-m-d H:i:s');
		$no_slf = $this->mslf->sk_slf($id);
		
		$data['result_list'] = $this->mslf->info_kabkot($id)->row_array();
		$wilayah = $data['result_list']['nama_kabkota'];
		$nilai = substr($wilayah,0,3);
		if ($nilai == "KAB") {
		  $kabkota = "KABUPATEN ".substr($wilayah,5);
			$tempat = ucwords(strtolower(substr($wilayah,5)));
		} elseif ($nilai == "KOT") {
		  if (substr($wilayah,10,7) == "JAKARTA") {
		    $kabkota = $wilayah;
				$tempat = ucwords(strtolower($kabkota));
		  }
		  else {
		    $kabkota = "KOTA ".substr($wilayah,5);
				$tempat = ucwords(strtolower(substr($wilayah,5)));
		  }
		}
		
		if($nilai == "KAB"){
			$pejabat_kabkota = "BUPATI KABUPATEN ".substr($wilayah,5);
		}elseif ($nilai == "KOT") {
		  if (substr($wilayah,10,7) == "JAKARTA") {
		    $pejabat_kabkota = "GUBERNUR ".substr($wilayah);
		  }
		  else {
		    $pejabat_kabkota = "WALIKOTA KOTA ".substr($wilayah,5);
		  }
		}
		
		if(trim($data['result_list']['dir_file_logo']) != ''){
			$logo = $data['result_list']['dir_file_logo'];
			//$logo = 'logo_pemda.png';
		}else{
			$logo = 'logo_pemda.png';
		}
		
		//$logo = $data['result_list']['dir_file_logo'];
		
		//Bagin Data Pokok Bangunan
		$data['results'] = $this->mslf->getDataPenerbitan($id)->row_array();
		$pemilik = ucwords(strtolower($data['results']['nama_pemilik']));
		$nama_bangunan = ucwords(strtolower($data['results']['nama_bangunan']));
		$alamat_bg = $data['results']['alamat_bg'];
		$kecamatan = $data['results']['nama_kecamatan'];
		$kabkot = $data['results']['nama_kabkota'];
		$provinsi = $data['results']['nama_provinsi'];
		$jenis_bg = $data['results']['id_jenis_bg'];
		$jenis_bangunan = $data['results']['jns_bangunan'];
		
		$no_imb = $data['results']['no_imb'];
		$no_slf = $data['results']['no_slf'];
		$ttd_pejabat_sk = ucwords(strtoupper($data['results']['ttd_pejabat_sk']));
		$nip_pejabat_sk = $data['results']['nip_pejabat_sk'];
		$alamat_dinas = ucwords(strtolower($data['results']['p_alamat']));
		$tgl_slf = tgl_eng_to_ind($data['results']['tgl_terbit_slf']);
		$tgl_setuju2 = explode('-',$tgl_slf);
		$tgl_persetujuan = $tgl_setuju2[0].' '.$montharray [$tgl_setuju2[1]-1].' '.$tgl_setuju2[2];
		
		$lokasi = ucwords(strtolower($alamat_bg));
		$lokasi2 = ucwords(strtolower("Kec. ".$kecamatan.", ".$kabkot));
		$lokasi3 = ucwords(strtolower("Prov ".$provinsi));
		
		$alamat_bangunan = ucwords(strtolower($alamat_bg.", "."Kec. ".$kecamatan));
		$alamat_bangunan2 =ucwords(strtolower(", ".$kabkot.", ". "Prov. ".$provinsi));
		
		
		if($jenis_bg == '1'){
			$jns_bangunan =  "Hunian";
			$durasi		  = "20";
		}else if($jenis_bg == '4'){
			$jns_bangunan =  "Sosial Budaya";
			$durasi		  = "5";
		}else{
			$jns_bangunan =  "Usaha";
			$durasi		  = "5";
		}
		/*if($jenis_bg == '1'){
			$jns_bangunan =  "Hunian";
			$durasi		  = "20";
		}else if($jenis_bg == '2'){
			$jns_bangunan =  "Keagamaan";
			$durasi		  = "5";
		}else if($jenis_bg == '3'){
			$jns_bangunan =  "Usaha";
			$durasi		  = "5";
		}else if($jenis_bg == '4'){
			$jns_bangunan =  "Sosial Budaya";
			$durasi		  = "5";
		}else if($jenis_bg == '5'){
			$jns_bangunan =  "Campuran";
			$durasi		  = "5";
		}else{
			$jns_bangunan =  "Usaha";
			$durasi		  = "5";
		}*/
		
		if($jenis_bangunan == '1'){
			$jenis_bangunan =  "Hunian";
		}else if($jenis_bangunan == '2'){
			$jenis_bangunan =  "Keagamaan";
		}else if($jenis_bangunan == '3'){
			$jenis_bangunan =  "Usaha";
		}else if($jenis_bangunan == '4'){
			$jenis_bangunan =  "Sosial Budaya";
		}else if($jenis_bangunan == '5'){
			$jenis_bangunan =  "Campuran";
		}
		//End Data Pokok Bangunan
		
		
		require_once(BASE_FILE_FPDF.'/cells_bold.php');
		$pdf = new FPDF('P','mm','A4');
		// membuat halaman baru
		$pdf->SetMargins(20,20,20);
		$pdf->AddPage();
		$pdf->Image(BASE_FILE_PATH."LogoKabKota/logo_slf.png",39.5,50,131,100);
		//$pdf->Image(BASE_FILE_PATH."LogoKabKota/sample2.png",39.5,50,131,100);
		$pdf->Cell(200,135,'',0,1);

		// Memberikan space kebawah agar tidak terlalu rapat
		$pdf->Cell(200,5,'',0,1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(19.5,5,'',0,0);
		$pdf->Cell(58,5,'Nomor SLF',0,0);
		$pdf->Cell(2,5,':',0,0);
		//$pdf->SetTextColor(50 , 150, 50);
		$pdf->Cell(109,5,$no_slf,0,1);
		$pdf->SetTextColor(0, 0, 0);

		$pdf->Cell(19.5,5,'',0,0);
		$pdf->Cell(58,5,'Tanggal',0,0);
		$pdf->Cell(2,5,':',0,0);
		//$pdf->SetTextColor(50 , 150, 50);
		$pdf->Cell(109,5,$tgl_slf,0,1);
		$pdf->SetTextColor(0, 0, 0);

		$pdf->Cell(19.5,5,'',0,0);
		$pdf->Cell(58,5,'Atas nama/Pemilik',0,0);
		$pdf->Cell(2,5,':',0,0);
		//$pdf->SetTextColor(50 , 150, 50);
		$pdf->Cell(109,5,$pemilik,0,1);
		$pdf->SetTextColor(0, 0, 0);

		$pdf->Cell(19.5,5,'',0,0);
		$pdf->Cell(58,5,'Fungsi bangunan gedung',0,0);
		$pdf->Cell(2,5,':',0,0);
		//$pdf->SetTextColor(50 , 150, 50);
		$pdf->Cell(109,5,$jns_bangunan,0,1);
		$pdf->SetTextColor(0, 0, 0);

		$pdf->Cell(19.5,5,'',0,0);
		$pdf->Cell(58,5,'Jenis bangunan gedung',0,0);
		$pdf->Cell(2,5,':',0,0);
		//$pdf->SetTextColor(50 , 150, 50);
		$pdf->Cell(109,5,$jenis_bangunan,0,1);
		$pdf->SetTextColor(0, 0, 0);

		$pdf->Cell(19.5,5,'',0,0);
		$pdf->Cell(58,5,'Nama bangunan gedung',0,0);
		$pdf->Cell(2,5,':',0,0);
		//$pdf->SetTextColor(50 , 150, 50);
		$pdf->Cell(109,5,(isset($nama_bangunan) ? $nama_bangunan : '[ NAMA BANGUNAN KOSONG ]'),0,1);
		$pdf->SetTextColor(0, 0, 0);
		
		$pdf->Cell(19.5,5,'',0,0);
		$pdf->Cell(58,5,'Lokasi',0,0);
		$pdf->Cell(2,5,':',0,0);
		//$pdf->SetTextColor(50 , 150, 50);
		$pdf->MultiCell(109,5,$lokasi.', '.$lokasi2.', '.$lokasi3,0,1);
		$pdf->SetTextColor(0, 0, 0);
		
		/*$pdf->Cell(19.5,5,'',0,0);
		$pdf->Cell(58,5,'',0,0);
		$pdf->Cell(2,5,'',0,0);
		//$pdf->SetTextColor(50 , 150, 50);
		$pdf->MultiCell(109,5,$lokasi2,0,1);
		$pdf->SetTextColor(0, 0, 0);
		
		$pdf->Cell(19.5,5,'',0,0);
		$pdf->Cell(58,5,'',0,0);
		$pdf->Cell(2,5,'',0,0);
		//$pdf->SetTextColor(50 , 150, 50);
		$pdf->MultiCell(109,5,$lokasi3,0,1);
		$pdf->SetTextColor(0, 0, 0);*/

		$pdf->Cell(200,60,'',0,1);
		$pdf->Image(BASE_FILE_PATH.'LogoKabKota/'.$logo,20,260,20,22);//Logo Kab Kota
		
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(26,5,'',0,0);
		$pdf->Cell(28,1,'PEMERINTAH DAERAH '.(isset($kabkota) ? $kabkota : '[ NAMA DINAS KOSONG ]'),0,1);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(26,5,'',0,0);
		$pdf->Cell(68,5,'ALAMAT : '.(isset($alamat_dinas) ? $alamat_dinas : '[ ALAMAT DINAS KOSONG ]'),0,1);

		$pdf->AddPage();
		$pdf->Image(BASE_FILE_PATH.'LogoKabKota/'.$logo,95,15,22);
		$pdf->Image(BASE_FILE_PATH."LogoKabKota/background_slf.png",75,100,59,100);
		$pdf->Cell(200,22,'',0,1);
		$pdf->Cell(0,2,'',0,1,'C');
		$pdf->SetFont('ARIAL','B',16);
		$pdf->Cell(0,5,'PEMERINTAH DAERAH '.(isset($kabkota) ? $kabkota : '[ NAMA PROVINSI KOSONG ]'),0,1,'C');
		$pdf->SetTextColor(0, 0, 0);

		$pdf->SetFont('ARIAL','B',14);
		$pdf->Cell(0,10,'SURAT KETERANGAN BANGUNAN GEDUNG LAIK FUNGSI',0,1,'C');
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('ARIAL','',12);
		
		$pdf->Cell(0,10,$pejabat_kabkota,0,1,'C');
		$pdf->Cell(0,5,'Berdasarkan Surat Pernyataan Kelaikan Fungsi Bangunan Gedung/Rekomendasi',0,1,'C');
		$pdf->SetFont('ARIAL','B',12);
		$pdf->Cell(0,5,'Nomor : '.$no_slf,0,1,'C');
		$pdf->SetFont('ARIAL','',12);
		$pdf->Cell(0,12,'menyatakan bahwa :',0,1,'C');
		$pdf->Cell(0,5,'Nama bangunan gedung',0,1,'C');
		$pdf->SetFont('ARIAL','B',12);
		$pdf->Cell(0,10,$nama_bangunan,0,1,'C');
		$pdf->SetFont('ARIAL','',12);
		$pdf->Cell(0,5,'Jenis bangunan gedung',0,1,'C');
		$pdf->SetFont('ARIAL','B',12);
		$pdf->Cell(0,10,$jenis_bangunan,0,1,'C');
		$pdf->SetFont('ARIAL','',12);
		$pdf->Cell(0,5,'Fungsi bangunan gedung',0,1,'C');
		$pdf->SetFont('ARIAL','B',12);
		$pdf->Cell(0,10,$jns_bangunan,0,1,'C');
		//$pdf->Cell(0,5,'Nomor Bukti Kepemilikan',0,1,'C');$pdf->Cell(0,10,'.........................................',0,1,'C');
		$pdf->SetFont('ARIAL','',12);
		$pdf->Cell(0,5,'Nomor IMB',0,1,'C');
		$pdf->SetFont('ARIAL','B',12);
		$pdf->Cell(0,10,$no_imb,0,1,'C');
		$pdf->SetFont('ARIAL','',12);
		$pdf->Cell(0,5,'Atas nama/Pemilik bangunan gedung',0,1,'C');
		$pdf->SetFont('ARIAL','B',12);
		$pdf->Cell(0,10,$pemilik,0,1,'C');
		
		$pdf->SetFont('ARIAL','',12);
		$pdf->Cell(0,5,'Lokasi',0,1,'C');
		$pdf->SetFont('ARIAL','B',11);
		$pdf->MultiCell(0,5,$alamat_bangunan.$alamat_bangunan2,0,'C',0);
		//$pdf->Cell(0,5,$alamat_bangunan2,0,1,'C');
		
		$pdf->SetFont('ARIAL','',12);
		$pdf->Cell(0,5,'sebagai',0,1,'C');
		$pdf->SetFont('ARIAL','B',14);
		$pdf->Cell(0,10,'LAIK FUNGSI',0,1,'C');
		$pdf->SetFont('ARIAL','',12);
		$pdf->Cell(0,5,'seluruhnya/sebagian',0,1,'C');
		$pdf->Cell(0,5,'sesuai dengan lampiran-lampiran Surat Keterangan ini',0,1,'C');
		$pdf->Cell(0,5,'yang merupakan bagian yang tidak terpisahkan dari Surat Keterangan ini.',0,1,'C');
		$pdf->Cell(0,5,'Surat Keterangan ini berlaku sampai '.$durasi.' tahun sejak ditertibkan.',0,1,'C');
		$date = date('Y');
		
		$pdf->SetFont('ARIAL','B',12);
		$pdf->Cell(0,5,$tgl_persetujuan,0,1,'C');
		
		$pdf->SetFont('ARIAL','',11);
		$pdf->Cell(0,3,"ATAS NAMA",0,1,'C');
		
		$pdf->SetFont('ARIAL','',12);
		$pdf->Cell(0,10,$pejabat_kabkota,0,1,'C');
		//$pdf->Image(BASE_FILE_PATH."LogoKabKota/logo_slf.png",39.5,50,131,100);
		$pdf->Cell(0,0,$pdf->Image(BASE_FILE_PATH."slf/qr_slf/".$no_slf.'.png', 90, $pdf->GetY(), 30,30),0,1,'C');
		//$pdf->Cell(0,0,$pdf->Image(BASE_FILE_PATH.'SLF/qr_slf/'.$no_slf.'.png', 90, $pdf->GetY(), 30,30),0,1,'C');
	
		$pdf->Cell(0,30,'',0,1);
		$pdf->SetFont('ARIAL','B',11);
		$pdf->Cell(0,3,$ttd_pejabat_sk,0,1,'C');// Nama Pejabat
		$pdf->Cell(0,3,$nip_pejabat_sk,0,1,'C');//NIP Pejabat
		$pdf->Output('I',$no_slf.'.pdf');
	}
	
	public function ver_kadis()
	{
		$pengajuan_id = $this->input->post('id_permohonannya');
		$dataUpdateStatus = array(
			'status' => '7',
			'status_progress' => '15',
		);
		$insert = $this->mglobals->setData('tm_slf_permohonan',$dataUpdateStatus,'id_permohonan_slf',$pengajuan_id);
		$data['DataPermohonan'] = $this->mslf->getDataUserSLF('a.*', $pengajuan_id);
		$email_pemohon = $data['DataPermohonan']->email;
		$nomor_registrasi = $data['DataPermohonan']->no_registrasi_slf;	
				
			
			//kirim_email
									$email = "$email_pemohon";
									$subject 	= "Status Verifikasi $nomor_registrasi";
									$text 		= "";
									$text .= "Yth Bapak/Ibu,<br>";
									$text .= "<br>";
									$text .= "Dengan ini kami memberitahukan bahwa :<br>";
									$text .= "Permohonan Telah Terverifikasi oleh Kepala Dinas dan SLF siap untuk diterbitkan.<br>";
									$text .= "Diharap pemohon mengunjungi DPMPTSP setempat untuk penyerahan SLF tersebut.";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "Hormat Kami <br>";
									$text .= "Admin SIMBG ";
									$this->simbg_lib->sendEmail($email, $subject, $text);
		$this->session->set_flashdata('message','SLF Terverifikasi');
		$this->session->set_flashdata('status','success');
		redirect('slf/penerbitan_list');
	}
	
	public function validasi()
	{
		$data['dataslf']   = $this->mslf->getSLFkasie();
		$data['content']	= $this->load->view('validasi/validasi_list',$data,TRUE);
		$data['title']		=	'Validasi Berkas Persyaratan';
		$data['heading']		=	'';
		$this->load->view('backend_adm',$data);
		//echo json_encode($data);
	}
	
	
	public function penyerahan()
	{				
		$id_kabkota = '';
		$id_rule					= $this->session->userdata('loc_role_id');
		
		$filterQuery				= 'a.*,
										d.nama_provinsi,e.nama_kabkota,f.nama_kecamatan,g.nama_permohonan,i.no_slf,file_rekomtek';
		$data['list_penerbitan'] 	= $this->mslf->getDataPenerbitanSLF($filterQuery,$id_kabkota);
		$list_penerbitan 			= $this->mslf->getDataPenerbitanSLF($filterQuery,$id_kabkota);
		//$data['jum_data'] 			= $list_penerbitan->num_rows();
		$data['content']			= $this->load->view('Penerbitan/terbit_list',$data,TRUE);
		$data['title']				=	'Penyerahan SLF';
		$data['heading']			=	'';
		$this->load->view('backend_adm',$data);
	}
	
	public function terbitin ()
	{
		$id_permohonan_slf = $this->input->get('id');
		$data= $this->mslf->getTerbitSLF('a.*',$id_permohonan_slf);
		echo json_encode($data);
		//$this->load->view('penjadwalan/hsnya',$data);
	}
	
	public function terbitlah ()
	{
		$id_permohonan_slf = $this->input->post('x_id_p');
		$pengajuan_id = $this->input->post('x_id_p');
		$cat = $this->input->post('x_cat_p');
		$nama_p = $this->input->post('x_penerima');
		if (trim($id_permohonan_slf) != '') {
							$tgl_log = date('Y-m-d');
							//$tgl_log = date('d-m-Y');
							$keterangan = 'SLF Terbit';
							$nama_fb = 'Hasil Sidang';
							$kode_feedback = '50';
							$dataIn = array (
								'id_permohonan_slf' => $id_permohonan_slf,
								'tgl_log_permohonan' => $tgl_log,
								'keterangan' => $keterangan,
								'kode_proses' => 16,
								'post_date' => $tgl_log,
								'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
							);
							$this->mslf->insert_log_slf($dataIn);
							//feedback to oss
							//$feedback = $this->oss_lib->receiveLicenseStatus($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
							$data_terbit = array (
								'id_permohonan_slf' => $id_permohonan_slf,
								'tanggal_penyerahan' => $tgl_log,
								'catatan' => $cat,
								'nama_penerima' => $nama_p,
								'post_date' => $tgl_log,
								'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
							);
							$this->mslf->insert_penyerahan($data_terbit);
							
							
							$dataUpdateStatus = array(
								'status' => '14',
								'status_progress' => '16',
							);
							$insert = $this->mglobals->setData('tm_slf_permohonan',$dataUpdateStatus,'id_permohonan_slf',$id_permohonan_slf);
							$data['DataPermohonan'] = $this->mslf->getDataUserSLF('a.*', $pengajuan_id);
							$email_pemohon = $data['DataPermohonan']->email;
							$nomor_registrasi = $data['DataPermohonan']->no_registrasi_slf;	
				
			
			//kirim_email
									$email = "$email_pemohon";
									$subject 	= "Status Verifikasi $nomor_registrasi";
									$text 		= "";
									$text .= "Yth Bapak/Ibu,<br>";
									$text .= "<br>";
									$text .= "Dengan ini kami memberitahukan bahwa :<br>";
									$text .= "Permohonan SLF Telah Terbit.<br>";
									$text .= "Diserahkan pada tanggal $tgl_log dan diterima oleh $nama_p.";
									$text .= "<br>";
									$text .= "<br>";
									$text .= "Hormat Kami <br>";
									$text .= "Admin SIMBG ";
									$this->simbg_lib->sendEmail($email, $subject, $text);
		}
		$this->session->set_flashdata('message','SLF Telah Terbit');
		$this->session->set_flashdata('status','success');
		redirect('slf/penyerahan');	
	}
	
	public function getDataKabKota()
	{
		$id_provinsi	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $id_provinsi);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kabkot' => $row->id_kabkot, 'nama_kabkota' => $row->nama_kabkota);
			}
		}
		echo json_encode($value);
	}

	public function getDataKecamatan()
	{
		$id_kabkot	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $id_kabkot);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kecamatan' => $row->id_kecamatan, 'nama_kecamatan' => $row->nama_kecamatan);
			}
		}
		echo json_encode($value);
	}
	
	public function editSLF()
	{
		
		$id_permohonan_slf	= $this->input->post('id_permohonan_slf');
		$peng_id			= $this->input->post('toid2');
		//Begin Data Pemilik
		
		$nama_pemilik	= $this->input->post('nama_pemilik');
		$alamat_pemohon	= $this->input->post('alamat_pemohon');
		$nama_provinsi	= $this->input->post('nama_provinsi');
		$nama_kabkota	= $this->input->post('nama_kabkota');
		$nama_kecamatan	= $this->input->post('nama_kecamatan');
		
		//End Data Pemilik
		
		//Begin Data Lokasi Bangunan Gedung 
		$alamat_bg			= $this->input->post('alamat_bg');
		$nama_provinsi_bg	= $this->input->post('nama_provinsi_bg');
		$nama_kabkota_bg	= $this->input->post('nama_kabkota_bg');
		$nama_kecamatan_bg	= $this->input->post('nama_kecamatan_bg');
		//End Data Lokasi Bangunan Gedung
		//Begin Data Bangunan Gedung
		$id_jenis_bg 		= $this->input->post('id_jenis_bg');
		$id_fungsi_bg		= $this->input->post('id_fungsi_bg');
		if ($id_fungsi_bg =='1')
		{
			$id_pemanfaatan_bg = '2';
		}else{
			$id_pemanfaatan_bg = '1';
		}
		$jns_bangunan		= $this->input->post('jns_bangunan');
		$luas_bg			= $this->input->post('luas_bgn');
		$lantai_bg			= $this->input->post('lantai_bg');
		$nama_bangunan		= $this->input->post('nama_bangunan');
		$tinggi_bg			= $this->input->post('tinggi_bgn');
		$luas_prasarana		= $this->input->post('luas_prasarana');
		$tinggi_prasarana	= $this->input->post('tinggi_prasarana');
		//$id_kolektif		= $this->input->post('id_kolektif');
		//$id_dok_tek			= $this->input->post('id_dok_tek');
		$luas_basement		= $this->input->post('luas_basement');
		$lapis_basement		= $this->input->post('lapis_basement');
		
		//End Data Bangunan Gedung
		$dataUpdate	= array(
						'id_permohonan_slf' => $id_permohonan_slf,
						//'id_user'=>$user_id,
						//'id_jenis_usaha'=>$id_jenis_usaha,
						'nama_pemilik' => $nama_pemilik,
						'alamat_pemilik' => $alamat_pemohon,
						'id_kecamatan' => $nama_kecamatan,
						'id_kabkot' => $nama_kabkota,
						'id_provinsi' => $nama_provinsi,
						//'email' => $email,
						//'no_ktp' => $no_ktp,
						//'npwp_perseroan' => $no_ktp_p,
						'alamat_bg' => $alamat_bg,
						'id_kecamatan_bg' => $nama_kecamatan_bg,
						//'id_kabkot_bg' => $nama_kabkota_bg,
						//'id_provinsi_bg' => $nama_provinsi_bg,
						'id_jenis_bg' => $id_jenis_bg,
						'id_fungsi_bg' => $id_fungsi_bg,
						'id_pemanfaatan_bg' => $id_pemanfaatan_bg,
						'jns_bangunan' => $jns_bangunan,
						'luas_bg' => $luas_bg,
						'tinggi_bg' => $tinggi_bg,
						'lantai_bg' => $lantai_bg,
						'nama_bangunan' => $nama_bangunan,
						//'luas_prasarana' => $luas_prasarana,
						//'tinggi_prasarana' => $tinggi_prasarana,
						//'id_kolektif' => $id_kolektif,
						//'id_dok_tek' => $id_dok_tek,
						'luas_basement' => $luas_basement,
						'lapis_basement' => $lapis_basement,
					);
					
		$insert = $this->mglobals->setData('tm_slf_permohonan',$dataUpdate,'id_permohonan_slf',$id_permohonan_slf);
		$this->session->set_flashdata('message','Data Berhasil di Simpan.');
		$this->session->set_flashdata('status','success');
		redirect('slf/FormPemeriksaan/'.$id_permohonan_slf.'/'.$peng_id);
	}
}

