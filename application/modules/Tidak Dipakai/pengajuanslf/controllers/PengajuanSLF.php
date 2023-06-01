<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class PengajuanSLF extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('mglobal');
		$this->load->model('mpengajuan');
		$this->load->library('simbg_lib');
		$this->simbg_lib->check_session_login();
	}

	public function index(){
		$this->DataPermohonanSLF();
	}
	//Begin Permohonan SLF
	public function DataPermohonanSLF ($user_id=null)
	{
		$user_id					= $this->session->userdata('loc_user_id');
		$data['profile_user'] 		= $this->mpengajuan->getDataUserPemohon('a.*,b.*',$user_id);
		$data['daftar_kecamatan']	= $this->mpengajuan->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan');
		$data['daftar_kabkota']		= $this->mpengajuan->listDataKabKota('id_kabkot,nama_kabkota');
		$data['daftar_provinsi']	= $this->mpengajuan->listDataProvinsi('id_provinsi,nama_provinsi');
		
		$filterQuerySLF			= 'a.*,b.*';
		$data['SLF'] 			= $this->mpengajuan->getAllDataPermohonanSLF($filterQuerySLF,$user_id);
		
		$data['content'] = $this->load->view('pengajuan_slf/DataPengajuanSLF',$data,TRUE);
		$data['title']		=	'Daftar Permohonan SLF';
		$data['heading']	=	'';
		$this->load->view('template_pengajuan',$data);
	}
	
	public function FormPendaftaranSLF()
	{
		$user_id			= $this->session->userdata('loc_user_id');
		//$user_id			= $this->uri->segment(3);
		$data['user_id']	= $user_id;
		
		$queFungsi = $this->mpengajuan->get_jenis_fungsi_list()->result();
		$list_fungsi[''] = '--Pilih--';
		foreach ($queFungsi as $row) 
		{
			$list_fungsi[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		$data['list_fungsi'] = $list_fungsi;
		
		$data['daftar_provinsi']	= $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data['daftar_kecamatan']	= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan');
		$data['daftar_kabkota']		= $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota');
		
		$data['mpengajuan']			=	$this->mpengajuan;
		$data['content']			= 	$this->load->view('pengajuan_slf/FormPermohonanSLF',$data,TRUE);
		$data['title']				=	'Form Permohonan SLF';
		$data['heading']			=	'';
		$this->load->view('template_pengajuan',$data);
	}
	
	public function FormSummary()
	{
		$user_id			= $this->session->userdata('loc_user_id');
		$data['title']		= 'Pengajuan Permohonan SLF';
		$id_permohonan_slf					= $this->uri->segment(3);
		$data['id']			= $id_permohonan_slf;
		$this->detil();
		$data['daftar_provinsi']	= $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data['daftar_kecamatan']	= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan');
		$data['daftar_kabkota']		= $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota');
		$permohonan 		= $this->mpengajuan->getDataSLF('a.*',$id_permohonan_slf)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		if($id_permohonan_slf != ''){
			if($id_jenis_permohonan != ''){
				$filterSummary			= '	a.*,g.nama_permohonan
											';
				$data['DataSummary']	= $this->mpengajuan->getSummarySlf($filterSummary,$id_permohonan_slf);
				
				$data['DataAdministrasi']	= $this->mpengajuan->getSlfAdministrasi('a.*',$id_permohonan_slf);
				$filterQuery				= 'b.id_persyaratan_detail,b.id_syarat,c.nama_syarat';
				$data['MasterAdministrasi']	= $this->mpengajuan->getMasterSlfAdministrasi($filterQuery,$id_jenis_permohonan);
			}
			if($id_jenis_permohonan != ''){
			$filterSummary	= '	a.*,g.nama_permohonan
							  ';
			$data['DataSummary']	= $this->mpengajuan->getSummarySlf($filterSummary,$id_permohonan_slf);
			$data['DataTeknis']		= $this->mpengajuan->getSlfTeknis('a.*',$id_permohonan_slf);
			$filterQuery			= 'b.id_persyaratan_detail,b.id_syarat,c.nama_syarat';
			$data['MasterTeknis']	= $this->mpengajuan->getMasterSlfTeknis($filterQuery,$id_jenis_permohonan);
		}
			
			$filterSummary			= '	a.*,
										';
			$data['DataSummary']	= $this->mpengajuan->getSummarySlf($filterSummary,$id_permohonan_slf);
			$data['DataTanah']		= $this->mpengajuan->getDataTanah('a.*',$id_permohonan_slf);
		}
		
		$data['content']			= 	$this->load->view('pengajuan_slf/DataSummary',$data,TRUE);
		$data['title']				=	'Form Permohonan SLF';
		$data['heading']			=	'';
		$this->load->view('template_pengajuan',$data);
	}
	
	
	public function saveDataSLF()
	{
		$user_id	= $this->session->userdata('loc_user_id');
		$id_permohonan_slf	= $this->input->post('id_permohonan_slf');
		$id_fungsi_bg		= $this->input->post('id_fungsi_bg');
		if ($id_fungsi_bg =='1')
		{
			$id_pemanfaatan_bg = '2';
		}else{
			$id_pemanfaatan_bg = '1';
		}
		
		$nib_detail = trim($this->input->post('nib_detail'));
		$nib = trim($this->input->post('nib'));
		$data['nib'] = $nib;
		
		if($nib != ""){
			$getDataNIB = $this->mpengajuan->get_nib_detail($nib,$nib_detail);
			$mydataNIB = $getDataNIB->row_array();
			$barisNIB = $getDataNIB->num_rows();
			if ($barisNIB >= 1 ) {
				$id_jenis_usaha = "2";
			}
		}
		
		$data	= array(
						//Data SLF
						'id_permohonan_slf' => $id_permohonan_slf,
						'id_user'=>$user_id,
						
						'id_fungsi_slf'=>$this->input->post('id_fungsi'), //id_fungsi_slf
						'id_kepemilikan_imb'=>$this->input->post('pty_imb'), //Status IMB
						'lama_kontruksi' =>$this->input->post('pty_lama'), // lama Kontruksi
						'id_fungsi_bg_slf' => $this->input->post('pty_fungsibg'), // Fungsi Bangunan Pada Permohonan SLF
						'lantai_slf' =>$this->input->post('pty_lantai'), // Jumlah lantai bangunan Pada Permohonsn SLF
						'pengawas_kontruksi'=>$this->input->post('id_peng'), //Pengawas Pada Saat Kontruksi
						'id_pemeriksaan_kontruksi'=>$this->input->post('id_dok_tet'), // Pengkaji Teknis
						'tahapan_kontruksi'=>$this->input->post('tahapan'),
						'no_imb'=>$this->input->post('no_imb'),
						//
						
						
						//data IMB
						//Pemilik
						'id_jenis_usaha'=>$this->input->post('statusaha'),
						'nama_pemilik' => $this->input->post('nama_pemilik'),
						'alamat_pemilik' => $this->input->post('alamat_pemilik'),
						'id_kecamatan' => $this->input->post('id_kecamatan'),
						'id_kabkot' => $this->input->post('id_kabkot'),
						'id_provinsi' => $this->input->post('id_provinsi'),
						'email' => $this->input->post('email'),
						'no_ktp' => $this->input->post('no_ktp'),
						'no_tlp' => $this->input->post('no_tlp'),
						//Bangunan
						'alamat_bg' => $this->input->post('alamat_bg'),
						'id_kecamatan_bg' => $this->input->post('id_kecamatan_bg'),
						'id_kabkot_bg' => $this->input->post('id_kabkot_bg'),
						'id_provinsi_bg' => $this->input->post('id_provinsi_bg'),
						'id_jenis_bg' => $this->input->post('id_jenis_bg'),
						'id_fungsi_bg' => $this->input->post('id_fungsi_bg'),
						'id_pemanfaatan_bg' => $id_pemanfaatan_bg,
						//'nib' => $nib,
						//'kd_izin' => $nib_detail,
						'jns_bangunan' => $this->input->post('jns_bangunan'),
						'luas_bg' => $this->input->post('luas_bg'),
						'tinggi_bg' => $this->input->post('tinggi_bg'),
						'lantai_bg' => $this->input->post('lantai_bg'),
						'nama_bangunan' => $this->input->post('nama_bangunan'),
						//'luas_prasarana' => $luas_prasarana,belum ada fieldnya
						//'tinggi_prasarana' =>  $this->input->post('tinggi_prasarana'),
						'id_dok_tek' => $this->input->post('dok_imb'),
						'luas_basement' => $this->input->post('luas_basement'),
						'lapis_basement' => $this->input->post('lapis_basement'),
						'nib' => $nib,
						'kd_izin' => $nib_detail,
						//
						
					);
		if($id_permohonan_slf != null){
			$this->mpengajuan->updatePermohonan($data,$id_permohonan_slf);
		}else{
			$id_permohonan_slf= $this->mglobals->setData('tm_slf_permohonan',$data,'id_permohonan_slf',$id_permohonan_slf);
		}
		$this->session->set_flashdata('message','Data Berhasil di Simpan.');
		$this->session->set_flashdata('status','success');
		redirect('PengajuanSLF/PermohonanSLFform/'.$id_permohonan_slf);
	}
	
	public function PermohonanSLFform()
	{
		$user_id	= $this->session->userdata('loc_user_id');
		$id_permohonan_slf	= $this->uri->segment(3);
		$data['DataPermohonan'] = $this->mpengajuan->getDataUserSLF('a.*', $id_permohonan_slf);
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
		$queFungsi = $this->mpengajuan->get_jenis_fungsi_list()->result();
		$list_fungsi[''] = '--Pilih--';
		foreach ($queFungsi as $row) 
		{
			$list_fungsi[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		$data['list_fungsi'] = $list_fungsi;
		
		
		$data['content']	= $this->load->view('pengajuan_slf/PermohonanEditSLF2', $data, TRUE);
		$data['title']		=	'Form Permohonan SLF';
		$data['heading']	=	'';
		$this->load->view('template_pengajuan', $data);
	}
	
	public function saveSLF()
	{
		$user_id		= $this->session->userdata('loc_user_id');
		$id_permohonan_slf	= $this->input->post('id_permohonan_slf');
		//Begin Data Pemilik
		
		$nama_pemilik	= $this->input->post('nama_pemilik');
		$alamat_pemohon	= $this->input->post('alamat_pemohon');
		$nama_provinsi	= $this->input->post('nama_provinsi');
		$nama_kabkota	= $this->input->post('nama_kabkota');
		$nama_kecamatan	= $this->input->post('nama_kecamatan');
		$email			= $this->input->post('email');
		$no_ktp			= $this->input->post('no_ktp');
		$id_jenis_usaha	= $this->input->post('id_jenis_usaha');
		
		//End Data Pemilik
		
		//Begin Data Lokasi Bangunan Gedung 
		$alamat_bg			= $this->input->post('alamat_bg');
		$nama_provinsi_bg	= $this->input->post('nama_provinsi_bg');
		$nama_kabkota_bg	= $this->input->post('nama_kabkota_bg');
		$nama_kecamatan_bg	= $this->input->post('nama_kecamatan_bg');
		//End Data Lokasi Bangunan Gedung
		//Begin Data Bangunan Gedung
		$id_jenis_bg 		= $this->input->post('id_jenis_bg');
		$klasifikasi_bg 	= trim($this->input->post('klasifikasi_bg'));
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
		$id_dok_tek			= $this->input->post('id_dok_tek');
		$luas_basement		= $this->input->post('luas_basement');
		$lapis_basement		= $this->input->post('lapis_basement');
		
		/*$nib_detail = trim($this->input->post('nib_detail'));
		$nib = trim($this->input->post('nib'));
		$data['nib'] = $nib;
		
		if($nib != ""){
			$getDataNIB = $this->mpengajuan->get_nib_detail($nib,$nib_detail);
			$mydataNIB = $getDataNIB->row_array();
			$barisNIB = $getDataNIB->num_rows();
			if ($barisNIB >= 1 ) {
				$id_jenis_usaha = "2";
			}
		}*/
		//End Data Bangunan Gedung
		$data	= array(
						'id_permohonan_slf' => $id_permohonan_slf,
						'id_user'=>$user_id,
						'id_jenis_usaha'=>$id_jenis_usaha,
						'nama_pemilik' => $nama_pemilik,
						'alamat_pemilik' => $alamat_pemohon,
						'id_kecamatan' => $nama_kecamatan,
						'id_kabkot' => $nama_kabkota,
						'id_provinsi' => $nama_provinsi,
						'email' => $email,
						'no_ktp' => $no_ktp,
						//'npwp_perseroan' => $no_ktp_p,
						'alamat_bg' => $alamat_bg,
						'id_kecamatan_bg' => $nama_kecamatan_bg,
						'id_kabkot_bg' => $nama_kabkota_bg,
						'id_provinsi_bg' => $nama_provinsi_bg,
						'id_jenis_bg' => $id_jenis_bg,
						'id_fungsi_bg' => $id_fungsi_bg,
						'id_pemanfaatan_bg' => $id_pemanfaatan_bg,
						'jns_bangunan' => $jns_bangunan,
						'luas_bg' => $luas_bg,
						'tinggi_bg' => $tinggi_bg,
						'lantai_bg' => $lantai_bg,
						'nama_bangunan' => $nama_bangunan,
						//'luas_prasarana' => $luas_prasarana,belum ada fieldnya
						//'tinggi_prasarana' => $tinggi_prasarana,
						//'id_kolektif' => $id_kolektif,
						'id_dok_tek' => $id_dok_tek,
						'luas_basement' => $luas_basement,
						'lapis_basement' => $lapis_basement,
					);
		if($id_permohonan_slf != null){
			$this->mpengajuan->updatePermohonan($data,$id_permohonan_slf);
		}else{
			$id_permohonan_slf= $this->mglobals->setData('tm_slf_permohonan',$data,'id_permohonan_slf',$id_permohonan_slf);
		}
		$this->session->set_flashdata('message','Data Berhasil di Simpan.');
		$this->session->set_flashdata('status','success');
		redirect('PengajuanSLF/FormDataTanah/'.$id_permohonan_slf);
	}
	
	public function FormDataTanah()
	{
		$user_id			= $this->session->userdata('loc_user_id');
		$data['title']		= 'Pengajuan Permohonan SLF';
		$id_permohonan_slf	= $this->uri->segment(3);
		
		$data['id_permohonan_slf']	= $id_permohonan_slf;
		$data['jenis_dokumen']		= $this->mglobal->getDokumen('id,jenis_dokumen');
		if($id_permohonan_slf != ''){
			$filterSummary			= '	a.*,
										';
			$data['DataSummary']	= $this->mpengajuan->getSummarySlf($filterSummary,$id_permohonan_slf);
			$data['DataTanah']		= $this->mpengajuan->getDataTanah('a.*',$id_permohonan_slf);
		}
		$this->detil();
		$data['content']			= 	$this->load->view('pengajuan_slf/FormDataTanah',$data,TRUE);
		$data['title']				=	'Form Permohonan SLF';
		$data['heading']			=	'';
		$this->load->view('template_pengajuan',$data);	
	}
	
	public function saveDataTanah()
	{
		$user_id						= $this->session->userdata('loc_user_id');
		$id								= $this->input->post('id');
		$id_permohonan_slf				= $this->input->post('id_permohonan_slf');
		$id_dokumen						= $this->input->post('id_dokumen');
		$nama_jns_dok_lain				= $this->input->post('nama_jns_dok_lain');
		$nomor_dokumen					= $this->input->post('nomor_dokumen');
		$tgl_terbit_dokumen				= $this->input->post('tgl_terbit_dokumen');
		$lokasi_tanah					= $this->input->post('lokasi_tanah');
		$nama_provinsi					= $this->input->post('nama_provinsi');
		$nama_kabkota					= $this->input->post('nama_kabkota');
		$nama_kecamatan					= $this->input->post('nama_kecamatan');
		$luas_tanah						= $this->input->post('luas_tanah');
		$nama_pemegang_hak_atas_tanah	= $this->input->post('atas_nama');
		$hat							= $this->input->post('hat');
		$hat2							= $this->input->post('hat2');
		$id_status_izin_pemanfaatan		= $this->input->post('id_status_izin_pemanfaatan');
		$no_dok_izin_pemanfaatan		= $this->input->post('no_dok_izin_pemanfaatan');
		$tgl_terbit_pemanfaatan			= $this->input->post('tgl_terbit_phat');
		$nama_pemegang_izin				= $this->input->post('nama_penerima_kuasa');
		//$d_file							= $this->input->post('d_file');
		//$dir_file_phat					= $this->input->post('dir_file_phat');
		//$dir_file_tan					= $this->input->post('dir_file_tan');
		
		//Upload file 
				$file_tanah = 'd_file_tan';
				$lam_tanah = $this->input->post('dir_file_tan');
				$filename_tanah = $_FILES['d_file_tan']['name'];
				
				$file_phat = 'd_file_phat';
				$lam_phat = $this->input->post('dir_file_phat');
				$filename_phat = $_FILES['d_file_phat']['name'];
				
				$thisdir = getcwd();
				$dirPath = $thisdir."/file/slf/$id_permohonan_slf/data_tanah/";
				if (!file_exists($dirPath)){
				//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				
				
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 		= 'pdf';
				$config['max_size']			= '50240';
				$config['remove_spaces']	= False;
				//$config_file3['encrypt_name']		= TRUE;
				
				$this->load->library('upload', $config);
				
				
				$this->upload->initialize($config);
				//$this->upload->do_upload($file_phat);
				
				//End Upload
	
	
		//End Upload Files
		
		if ((!$this->upload->do_upload($file_tanah)) && ($lam_tanah != '')) {
				$data['err_msg'] = $this->upload->display_errors('','');
				$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status','warning');
				redirect('pengajuanSLF/FormDataTanah/'.$id_permohonan_slf);
		}elseif ((!$this->upload->do_upload($file_phat)) && ($lam_phat != '')) {
				$data['err_msg'] = $this->upload->display_errors('','');
				$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status','warning');
				redirect('pengajuanSLF/FormDataTanah/'.$id_permohonan_slf);
		}else {	
		$data	= array(
						'id_permohonan_slf'=>$id_permohonan_slf,
						'id_dokumen'=>$id_dokumen,
						'dir_file'=>$_FILES['d_file_tan']['name'],
						'jenis_dokumen_phat'=>$nama_jns_dok_lain,
						'no_dok'=>$nomor_dokumen,
						//'dir_file' => $d_file,dir_file_dokumen
						'tanggal_dok'=>date('Y-m-d',strtotime($tgl_terbit_dokumen)),
						'lokasi_tanah'=>$lokasi_tanah,
						'id_provinsi'=>$nama_provinsi,
						'id_kabkot'=>$nama_kabkota,
						'id_kecamatan'=>$nama_kecamatan,
						'luas_tanah'=>$luas_tanah,
						'atas_nama_dok'=>$nama_pemegang_hak_atas_tanah,
						'status_phat'=>$hat2,
						'dir_file_phat'=>$_FILES['d_file_phat']['name'],
						'no_dokumen_phat'=>$no_dok_izin_pemanfaatan,
						'nama_penerima_phat'=>$nama_pemegang_izin,
						'hat'=>$hat,
						'tgl_terbit_phat'=>date('Y-m-d',strtotime($tgl_terbit_pemanfaatan)),
				);
			

			
			if($id != ""){
				$query		= $this->mglobals->setData('tm_slf_tanah',$data,'id',$id);
				$this->session->set_flashdata('message','Data Berhasil di Ubah.');
				$this->session->set_flashdata('status','success');
				redirect('pengajuanSLF/FormDataTanah/'.$id_permohonan_slf);
			}else{
				$query		= $this->mglobals->setData('tm_slf_tanah',$data,'id',$id);
				if($query){
					$this->session->set_flashdata('message','Data Berhasil di Simpan.');
					$this->session->set_flashdata('status','success');
					redirect('pengajuanSLF/FormDataTanah/'.$id_permohonan_slf);
				}else{
					$this->session->set_flashdata('message','Data Gagal di Simpan.');
					$this->session->set_flashdata('status','danger');
					redirect('pengajuanSLF/FormDataTanah/'.$id_permohonan_slf);
				}
			}
		}
			
	}
	
	public function saveDataTanahSumary()
	{
		$user_id						= $this->session->userdata('loc_user_id');
		$id								= $this->input->post('id');
		$id_permohonan_slf				= $this->input->post('id_permohonan_slf');
		$id_dokumen						= $this->input->post('id_dokumen');
		$nama_jns_dok_lain				= $this->input->post('nama_jns_dok_lain');
		$nomor_dokumen					= $this->input->post('nomor_dokumen');
		$tgl_terbit_dokumen				= $this->input->post('tgl_terbit_dokumen');
		$lokasi_tanah					= $this->input->post('lokasi_tanah');
		$nama_provinsi					= $this->input->post('nama_provinsi');
		$nama_kabkota					= $this->input->post('nama_kabkota');
		$nama_kecamatan					= $this->input->post('nama_kecamatan');
		$luas_tanah						= $this->input->post('luas_tanah');
		$nama_pemegang_hak_atas_tanah	= $this->input->post('atas_nama');
		$hat							= $this->input->post('hat');
		$hat2							= $this->input->post('hat2');
		$id_status_izin_pemanfaatan		= $this->input->post('id_status_izin_pemanfaatan');
		$no_dok_izin_pemanfaatan		= $this->input->post('no_dok_izin_pemanfaatan');
		$tgl_terbit_pemanfaatan			= $this->input->post('tgl_terbit_phat');
		$nama_pemegang_izin				= $this->input->post('nama_penerima_kuasa');
		//$d_file							= $this->input->post('d_file');
		//$dir_file_phat					= $this->input->post('dir_file_phat');
		//$dir_file_tan					= $this->input->post('dir_file_tan');
		
		//Upload file 
				$file_tanah = 'd_file_tan';
				$lam_tanah = $this->input->post('dir_file_tan');
				$filename_tanah = $_FILES['d_file_tan']['name'];
				
				$file_phat = 'd_file_phat';
				$lam_phat = $this->input->post('dir_file_phat');
				$filename_phat = $_FILES['d_file_phat']['name'];
				
				$thisdir = getcwd();
				$dirPath = $thisdir."/file/slf/$id_permohonan_slf/data_tanah/";
				if (!file_exists($dirPath)){
				//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				
				
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 		= 'pdf';
				$config['max_size']			= '50240';
				$config['remove_spaces']	= False;
				//$config_file3['encrypt_name']		= TRUE;
				
				$this->load->library('upload', $config);
				
				
				$this->upload->initialize($config);
				//$this->upload->do_upload($file_phat);
				
				//End Upload
	
	
		//End Upload Files
		
		if ((!$this->upload->do_upload($file_tanah)) && ($lam_tanah != '')) {
				$data['err_msg'] = $this->upload->display_errors('','');
				$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status','danger');
				redirect('pengajuanSLF/FormSummary/'.$id_permohonan_slf.'#tab2');
		}elseif ((!$this->upload->do_upload($file_phat)) && ($lam_phat != '')) {
				$data['err_msg'] = $this->upload->display_errors('','');
				$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status','danger');
				redirect('pengajuanSLF/FormSummary/'.$id_permohonan_slf.'#tab2');
		}else {	
		$data	= array(
						'id_permohonan_slf'=>$id_permohonan_slf,
						'id_dokumen'=>$id_dokumen,
						'dir_file'=>$_FILES['d_file_tan']['name'],
						'jenis_dokumen_phat'=>$nama_jns_dok_lain,
						'no_dok'=>$nomor_dokumen,
						//'dir_file' => $d_file,dir_file_dokumen
						'tanggal_dok'=>date('Y-m-d',strtotime($tgl_terbit_dokumen)),
						'lokasi_tanah'=>$lokasi_tanah,
						'id_provinsi'=>$nama_provinsi,
						'id_kabkot'=>$nama_kabkota,
						'id_kecamatan'=>$nama_kecamatan,
						'luas_tanah'=>$luas_tanah,
						'atas_nama_dok'=>$nama_pemegang_hak_atas_tanah,
						'status_phat'=>$hat2,
						'dir_file_phat'=>$_FILES['d_file_phat']['name'],
						'no_dokumen_phat'=>$no_dok_izin_pemanfaatan,
						'nama_penerima_phat'=>$nama_pemegang_izin,
						'hat'=>$hat,
						'tgl_terbit_phat'=>date('Y-m-d',strtotime($tgl_terbit_pemanfaatan)),
				);
			

			
			if($id != ""){
				$query		= $this->mglobals->setData('tm_slf_tanah',$data,'id',$id);
				$this->session->set_flashdata('message','Data Berhasil di Ubah.');
				$this->session->set_flashdata('status','success');
				redirect('pengajuanSLF/FormSummary/'.$id_permohonan_slf.'#tab2');
			}else{
				$query		= $this->mglobals->setData('tm_slf_tanah',$data,'id',$id);
				if($query){
					$this->session->set_flashdata('message','Data Berhasil di Simpan.');
					$this->session->set_flashdata('status','success');
					redirect('pengajuanSLF/FormSummary/'.$id_permohonan_slf.'#tab2');
				}else{
					$this->session->set_flashdata('message','Data Gagal di Simpan.');
					$this->session->set_flashdata('status','danger');
					redirect('pengajuanSLF/FormSummary/'.$id_permohonan_slf.'#tab2');
				}
			}
		}
			
	}
	
	public function removeDataTanah($id)
	{
		$pengajuan_id	= $this->uri->segment(4);
		$process = $this->mpengajuan->removeData($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Tanah Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Tanah Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('PengajuanSLF/FormDataTanah/'.$pengajuan_id);
	}
	
	public function removeDataTanahSumary($id)
	{
		$pengajuan_id	= $this->uri->segment(4);
		$process = $this->mpengajuan->removeData($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Tanah Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Tanah Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('PengajuanSLF/FormSummary/'.$pengajuan_id.'#tab2');
	}
	
	public function FormAdministrasiSLF()
	{
		$user_id			= $this->session->userdata('loc_user_id');
		$data['title']		= 'Pengajuan Permohonan SLF';
		$id					= $this->uri->segment(3);
		$data['id']			= $id;
		$permohonan 		= $this->mpengajuan->getDataSLF('a.*',$id)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		if($id != ''){
			$filterSummary			= '	a.*,g.nama_permohonan
										';
			$data['DataSummary']	= $this->mpengajuan->getSummarySlf($filterSummary,$id);
			//$data['DataAdministrasi']	= $this->mpengajuan->getSlfAdministrasi('a.*',$id);
			//$filterQuery				= 'b.id_persyaratan_detail,b.id_syarat,c.nama_syarat';
			//$data['MasterAdministrasi']	= $this->mpengajuan->getMasterSlfAdministrasi($filterQuery,$id_jenis_permohonan);
		}
		if($id != '' && $id_jenis_permohonan != ''){
			
			$data['DataSummary']	= $this->mpengajuan->getSummarySlf($filterSummary,$id);
			$data['DataAdministrasi']	= $this->mpengajuan->getSlfAdministrasi('a.*',$id);
			$filterQuery				= 'b.id_persyaratan_detail,b.id_syarat,c.nama_syarat';
			$data['MasterAdministrasi']	= $this->mpengajuan->getMasterSlfAdministrasi($filterQuery,$id_jenis_permohonan);
		}
		$this->detil();
		$data['content']			= 	$this->load->view('pengajuan_slf/FormDataAdministrasi',$data,TRUE);
		$data['title']				=	'Form Permohonan SLF';
		$data['heading']			=	'';
		$this->load->view('template_pengajuan',$data);
	}
	
	public function persyaratan_submitadm()
	{	
		$pengajuan_id				= $this->uri->segment(3);
		$id_syarat					= $this->uri->segment(4);
		$kode_jenis_syarat			= $this->uri->segment(5);
		$id_administrasi			= $this->uri->segment(6);
		$data['pengajuan_id']		= $pengajuan_id;
		$data['id_syarat']			= $id_syarat;
		
				$file_element_name 	= 'd_file';

				$thisdir = getcwd();
				$dirPath = $thisdir."/file/slf/".$pengajuan_id."/persyaratan/Administrasi";
				if (!file_exists($dirPath)){
					//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 	= 'pdf';
				$config['max_size']			= '50240';
				$config['encrypt_name']		= TRUE;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
		if(!empty($_FILES)){	
			if ( ! $this->upload->do_upload('d_file')){
					$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
					$this->session->set_flashdata('status','danger');
					redirect('pengajuanSLF/FormAdministrasiSLF/'.$pengajuan_id);
			}else{
			
				if($file_element_name != ''){
					$file_undangan=$this->upload->data();
					$filename=$file_undangan['file_name'];
				}else{
					$filename = $_FILES['d_file']['name'];
				}
			
				$dataPersyaratan = array('pengajuan_id'=>$pengajuan_id,
									'id_dokumen_permohonan'=>$id_syarat,
									'dir_file'=>$filename,
								);
			
				$this->mglobals->setData('tm_slf_administrasi',$dataPersyaratan,'id',$id_administrasi);
				$this->session->set_flashdata('message','Berkas Berhasil Disimpan !.');
				$this->session->set_flashdata('status','success');
				redirect('pengajuanSLF/FormAdministrasiSLF/'.$pengajuan_id);
			}
		}
	}
	
	public function persyaratan_submitadmrev()
	{	
		$pengajuan_id				= $this->uri->segment(3);
		$id_syarat					= $this->uri->segment(4);
		$kode_jenis_syarat			= $this->uri->segment(5);
		$id_administrasi			= $this->uri->segment(6);
		$data['pengajuan_id']		= $pengajuan_id;
		$data['id_syarat']			= $id_syarat;
		
				$file_element_name 	= 'd_file';

				$thisdir = getcwd();
				$dirPath = $thisdir."/file/slf/".$pengajuan_id."/persyaratan/Administrasi";
				if (!file_exists($dirPath)){
					//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 	= 'pdf';
				$config['max_size']			= '50240';
				$config['encrypt_name']		= TRUE;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
		if(!empty($_FILES)){	
			if ( ! $this->upload->do_upload('d_file')){
					$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
					$this->session->set_flashdata('status','danger');
					redirect('pengajuanSLF/FormSummary/'.$pengajuan_id.'#tab3');
			}else{
			
				if($file_element_name != ''){
					$file_undangan=$this->upload->data();
					$filename=$file_undangan['file_name'];
				}else{
					$filename = $_FILES['d_file']['name'];
				}
			
				$dataPersyaratan = array('pengajuan_id'=>$pengajuan_id,
									'id_dokumen_permohonan'=>$id_syarat,
									'dir_file'=>$filename,
								);
			
				$this->mglobals->setData('tm_slf_administrasi',$dataPersyaratan,'id',$id_administrasi);
				$this->session->set_flashdata('message','Berkas Berhasil Disimpan !.');
				$this->session->set_flashdata('status','success');
				redirect('pengajuanSLF/FormSummary/'.$pengajuan_id.'#tab3');
			}
		}
	}
	
	public function FormTeknisSLF()
	{
		$user_id			= $this->session->userdata('loc_user_id');
		$data['title']		=	'Pengajuan Permohonan SLF';
		$id					= $this->uri->segment(3);
		$data['id']			= $id;
		$permohonan 		= $this->mpengajuan->getDataSLF('a.*',$id)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		if($id != ''){
			$filterSummary	= '	a.*,g.nama_permohonan
							  ';
			$data['DataSummary']	= $this->mpengajuan->getSummarySlf($filterSummary,$id);
			//$data['DataTeknis']		= $this->mpengajuan->getSlfTeknis('a.*',$id);
			//$filterQuery			= 'b.id_persyaratan_detail,b.id_syarat,c.nama_syarat';
			//$data['MasterTeknis']	= $this->mpengajuan->getMasterSlfTeknis($filterQuery,$id_jenis_permohonan);
		}
		
		if($id != '' && $id_jenis_permohonan != ''){
		
			$data['DataTeknis']		= $this->mpengajuan->getSlfTeknis('a.*',$id);
			$filterQuery			= 'b.id_persyaratan_detail,b.id_syarat,c.nama_syarat';
			$data['MasterTeknis']	= $this->mpengajuan->getMasterSlfTeknis($filterQuery,$id_jenis_permohonan);
		}
		$this->detil();
		$data['content']			= 	$this->load->view('pengajuan_slf/FormDataTeknis',$data,TRUE);
		$data['title']				=	'Form Permohonan SLF';
		$data['heading']			=	'';
		$this->load->view('template_pengajuan',$data);
	}
	
	public function persyaratan_submitteknis()
	{	
		$pengajuan_id				= $this->uri->segment(3);
		$id_syarat					= $this->uri->segment(4);
		$kode_jenis_syarat			= $this->uri->segment(5);
		$id_administrasi			= $this->uri->segment(6);
		$data['pengajuan_id']		= $pengajuan_id;
		$data['id_syarat']			= $id_syarat;
		
				$file_element_name 	= 'd_file';
				$thisdir = getcwd();
				$dirPath = $thisdir."/file/slf/".$pengajuan_id."/persyaratan/Teknis";
				if (!file_exists($dirPath)){
					//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 	= 'pdf';
				$config['max_size']			= '50240';
				$config['encrypt_name']		= TRUE;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
		//id_persyaratan_detail
		if(!empty($_FILES)){	
			if ( ! $this->upload->do_upload('d_file')){
					$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
					$this->session->set_flashdata('status','danger');
					redirect('pengajuanSLF/FormTeknisSLF/'.$pengajuan_id);
			}else{
			
				if($file_element_name != ''){
					$file_undangan=$this->upload->data();
					$filename=$file_undangan['file_name'];
				}else{
					$filename = $_FILES['d_file']['name'];
				}
			
				$dataPersyaratan = array('pengajuan_id'=>$pengajuan_id,
									'id_dokumen_permohonan'=>$id_syarat,
									'dir_file'=>$filename,
								);
			
				$this->mglobals->setData('tm_slf_teknis',$dataPersyaratan,'id',$id_administrasi);
				$this->session->set_flashdata('message','Berkas Berhasil Disimpan !.');
				$this->session->set_flashdata('status','success');
				redirect('pengajuanSLF/FormTeknisSLF/'.$pengajuan_id);
			}
		}
	}
	
	public function persyaratan_submitteknisrev()
	{	
		$pengajuan_id				= $this->uri->segment(3);
		$id_syarat					= $this->uri->segment(4);
		$kode_jenis_syarat			= $this->uri->segment(5);
		$id_administrasi			= $this->uri->segment(6);
		$data['pengajuan_id']		= $pengajuan_id;
		$data['id_syarat']			= $id_syarat;
		
				$file_element_name 	= 'd_file';
				$thisdir = getcwd();
				$dirPath = $thisdir."/file/slf/".$pengajuan_id."/persyaratan/Teknis";
				if (!file_exists($dirPath)){
					//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 	= 'pdf';
				$config['max_size']			= '50240';
				$config['encrypt_name']		= TRUE;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
		//id_persyaratan_detail
		if(!empty($_FILES)){	
			if ( ! $this->upload->do_upload('d_file')){
					$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
					$this->session->set_flashdata('status','danger');
					redirect('pengajuanSLF/FormSummary/'.$pengajuan_id.'#tab3');
			}else{
			
				if($file_element_name != ''){
					$file_undangan=$this->upload->data();
					$filename=$file_undangan['file_name'];
				}else{
					$filename = $_FILES['d_file']['name'];
				}
			
				$dataPersyaratan = array('pengajuan_id'=>$pengajuan_id,
									'id_dokumen_permohonan'=>$id_syarat,
									'dir_file'=>$filename,
								);
			
				$this->mglobals->setData('tm_slf_teknis',$dataPersyaratan,'id',$id_administrasi);
				$this->session->set_flashdata('message','Berkas Berhasil Disimpan !.');
				$this->session->set_flashdata('status','success');
				redirect('pengajuanSLF/FormSummary/'.$pengajuan_id.'#tab3');
			}
		}
	}
	
	function removeDataAdministrasi()
	{
		$id = $this->uri->segment(3);
		$pengajuan_id = $this->uri->segment(5);
		$key_syarat = $this->uri->segment(4);
		$data['pesan'] = '';
		$data['err_msg'] = '';

		if(trim($id) != '' ) {
			try{
				$this->mpengajuan->RemoveAdministrasi($id);
				$this->session->set_flashdata('message','Data Berhasil Dihapus.');
				$this->session->set_flashdata('status','success');
				redirect('PengajuanSLF/FormAdministrasiSLF/'.$pengajuan_id);
			}
			catch(Exception $e){
				$this->session->set_flashdata('message','Data Gagal Dihapus.');
				$this->session->set_flashdata('status','danger');
				redirect('PengajuanSLF/FormAdministrasiSLF/'.$pengajuan_id);
			}
		}	
	}
	
	function removeDataAdministrasirev()
	{
		$id = $this->uri->segment(3);
		$pengajuan_id = $this->uri->segment(5);
		$key_syarat = $this->uri->segment(4);
		$data['pesan'] = '';
		$data['err_msg'] = '';

		if(trim($id) != '' ) {
			try{
				$this->mpengajuan->RemoveAdministrasi($id);
				$this->session->set_flashdata('message','Data Berhasil Dihapus.');
				$this->session->set_flashdata('status','success');
				redirect('PengajuanSLF/FormSummary/'.$pengajuan_id.'#tab3');
			}
			catch(Exception $e){
				$this->session->set_flashdata('message','Data Gagal Dihapus.');
				$this->session->set_flashdata('status','danger');
				redirect('PengajuanSLF/FormSummary/'.$pengajuan_id.'#tab3');
			}
		}	
	}
	
	function removeDataTeknis()
	{
		$id = $this->uri->segment(3);
		$pengajuan_id = $this->uri->segment(5);
		$key_syarat = $this->uri->segment(4);
		$data['pesan'] = '';
		$data['err_msg'] = '';

		if(trim($id) != '' ) {
			try{
				$this->mpengajuan->RemoveTeknis($id);
				$this->session->set_flashdata('message','Data Berhasil Dihapus.');
				$this->session->set_flashdata('status','success');
				redirect('PengajuanSLF/FormTeknisSLF/'.$pengajuan_id);
			}
			catch(Exception $e){
				$this->session->set_flashdata('message','Data Gagal Dihapus.');
				$this->session->set_flashdata('status','danger');
				redirect('PengajuanSLF/FormTeknisSLF/'.$pengajuan_id);
			}
		}	
	}
	
	function removeDataTeknisrev()
	{
		$id = $this->uri->segment(3);
		$pengajuan_id = $this->uri->segment(5);
		$key_syarat = $this->uri->segment(4);
		$data['pesan'] = '';
		$data['err_msg'] = '';

		if(trim($id) != '' ) {
			try{
				$this->mpengajuan->RemoveTeknis($id);
				$this->session->set_flashdata('message','Data Berhasil Dihapus.');
				$this->session->set_flashdata('status','success');
				redirect('PengajuanSLF/FormSummary/'.$pengajuan_id.'#tab3');
			}
			catch(Exception $e){
				$this->session->set_flashdata('message','Data Gagal Dihapus.');
				$this->session->set_flashdata('status','danger');
				redirect('PengajuanSLF/FormSummary/'.$pengajuan_id.'#tab3');
			}
		}	
	}
	
	public function FormKonfirmasi()
	{
		$user_id			= $this->session->userdata('loc_user_id');
		$data['title']		= 'Pengajuan Permohonan SLF';
		$id					= $this->uri->segment(3);
		$data['id']			= $id;
		$permohonan 		= $this->mpengajuan->getDataSLF('a.*',$id)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		if($id != ''){
			$filterSummary	= '	a.*,g.nama_permohonan
								';
			$data['DataSummary']	= $this->mpengajuan->getSummarySlf($filterSummary,$id);
		}
		$this->detil();
		$data['content']			= 	$this->load->view('pengajuan_slf/FormPernyataan',$data,TRUE);
		$data['title']				=	'Form Permohonan SLF';
		$data['heading']			=	'';
		$this->load->view('template_pengajuan',$data);
	}
	
	public function saveKonfirmasiSlf()
	{
		$user_id		= $this->session->userdata('loc_user_id');
		$user_id		= $this->session->userdata('loc_user_id');
		$data['title']	= 'Pengajuan Permohonan SLF';
		$id				= $this->uri->segment(3);
		$data['id']		= $id;
	
		$id				= $this->input->post('id');
		$pernyataan		=  $this->input->post('pernyataan');
		$tgl_skrg 		= date('Y-m-d');
		$nomor_registrasi = $this->no_registrasi($id);
		if($pernyataan == '1')
		{
			$dataIn	= array(
							'status_pernyataan'=>$pernyataan,
							'no_registrasi_slf' =>$nomor_registrasi,
							//'tgl_permohonan' => $tgl_skrg,
							'status' => '2',
							'status_progress' => '1',
							'post_date'=>date('Y-m-d')
						);
			$this->mpengajuan->updateKonfirmasi($dataIn,$id);
			$this->session->set_flashdata('message','Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status','success');
		}
		redirect('pengajuanSLF/DataPermohonanSLF/'.$id);
	}
	
	public function no_registrasi($id=null)
	{
		$que = $this->mpengajuan->getIdKabkot($id);
		$id_skrg = $que['id_kabkot_bg'];
		$no_reg_awal = $que['id_kecamatan_bg'];
		$tgl_disetujui = date('d').date('m').date('Y');;
		$mydata2 = $this->mpengajuan->getNoRegistrasi($id_skrg,$tgl_disetujui);
		if(count($mydata2)>0){
			$no_baru = SUBSTR($mydata2['no_urut'],-2)+1;
			if ($no_baru < 10){
					$no_registrasi = "SLF-".$no_reg_awal."-".$tgl_disetujui."-0".$no_baru;
			}else {
				$no_registrasi = "SLF-".$no_reg_awal."-".$tgl_disetujui."-".$no_baru;
			}
	    } else {
	      $no_registrasi = "SLF-".$no_reg_awal."-".$tgl_disetujui."-01";
	    }
		return $no_registrasi;
	}
	
	function delete_upload_slf()
	{
		$id = $this->uri->segment(3);
		$detail = $this->uri->segment(4);
		//$key_syarat = $this->uri->segment('5');
		$data['pesan'] = '';
		$data['err_msg'] = '';
		if(trim($id) != '' && trim($detail) != '') {
			try
			{
				$this->mpengajuan->upload_delete($id,$detail,$key_syarat);
			}
			catch(Exception $e)
			{
				echo "Data Gagal Dihapus";
			}
		}
	}
	// End Pernyataan SLF
	
	// Begin Data Yang di pake IMB dan SLF
	public function getDokumen()
	{
		$queFungsi = $this->mglobal->getDokumen()->result();
		$list_dokumen[''] = '--Pilih--';
		foreach ($queFungsi as $row)
		{
			$list_dokumen[$row->id_dokumen] = $row->jenis_dokumen;
		}
		$data['list_dokumen'] = $list_dokumen;
	}
	
	public function getDataKabKota()
	{
		$id_provinsi	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota','',$id_provinsi);
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$value[]	= array('id_kabkot'=>$row->id_kabkot, 'nama_kabkota'=>$row->nama_kabkota);
			}
		}
		echo json_encode($value);
	}
	
	public function getDataKecamatan()
	{
		$id_kabkot	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan','',$id_kabkot);
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$value[]	= array('id_kecamatan'=>$row->id_kecamatan, 'nama_kecamatan'=>$row->nama_kecamatan);
			}
		}
		echo json_encode($value);
	}
	
	public function upload_file($file_element_name,$upload_path,$allowed_types)
	{
		$filename = $_FILES[$file_element_name]['name'];
		$config_file = array(
				'allowed_types' => $allowed_types,
				'upload_path' => realpath($upload_path),
				'max_size' => 5120000 * 8,
				
				'file_name' => $filename,
				'remove_spaces' => FALSE
			);
		$this->load->library('upload', $config_file);
		$this->upload->initialize($config_file);
		if ((!$this->upload->do_upload($file_element_name))){
			return $this->upload->display_errors('','');
		}else{
			return $filename;
		}
	}
	//End Data Yang di pake IMB dan SLF
	function getNoImb(){
		$no_imb=$this->input->post('no_imb');
		$data=$this->mpengajuan->get_x_bykode($no_imb);
		echo json_encode($data);
	}
	
	function list_nib_popup($nib=null)
	{
		$data = "";
		$nib	= $this->input->post('nib');
		$query = $this->mpengajuan->get_nib($nib);
		$mydata = $query->row_array();
		$baris = $query->num_rows();
		//$nib = strip_tags($_POST['nib']);
		if($nib != ""){
			if ($baris >= 1 ) {
				$i= 1;
				foreach ($query->result() as $row){
					$data .= '<tr><td>'.$row->kd_izin.'</td><td>'.$row->uraian_usaha.'</td><td>'.$row->alamat_investasi.'</td>
					<td><input type="radio" name="nib_detail" value="'.$row->kd_izin.'"></td></tr>';
					$i++;
				}
				echo $data;
			}else{
				$fix = "NIB Tidak Terdaftar di OSS";
				$data2 = '<tr><td colspan="4" align="center">'.$fix.'</td></tr>';
				echo $data2;
			}	
		}
		
	}
	
	function detil()
	{
		$id= $this->uri->segment('3');
		$data['id_permohonan_slf'] = $id;

		if(trim($id) != '' && trim($id) != '') {
			$query = $this->mpengajuan->get_detail_slf($id);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['nomor_registrasi'] = $mydata['no_registrasi_slf'];
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
				$data['nama'] = $mydata['nama_pemilik'];
				$data['status_progress'] = $mydata['status_progress'];
				$data['jalan'] = $mydata['alamat_pemilik'];
				$data['id_kec'] = $mydata['id_kecamatan'];
				$data['nama_kec'] = $mydata['nama_kecamatan'];
				$data['id_kabkot'] = $mydata['id_kabkot'];
				$data['nama_kabkota'] = $mydata['nama_kabkota'];
				$data['id_provinsi'] = $mydata['id_provinsi'];
				$data['nama_provinsi'] = $mydata['nama_provinsi'];
				$data['no_tlpn'] = $mydata['no_tlp'];
				$data['email'] = $mydata['email'];
				$data['ktp'] = $mydata['no_ktp'];
				
				$data['jalan_lokasi'] = $mydata['alamat_bg'];
				
				$data['kec'] = $mydata['nama_kecamatan_bg'];
				$data['stat'] = $mydata['status'];
				$data['id_fungsi_bg'] = $mydata['id_fungsi_bg'];
						
						if($mydata['id_fungsi_bg'] == 5){
							$data['sarana'] = 5;
						}else{
							$data['sarana'] = null;
							//$data['usaha2'] = "";
						}
						
				$data['jns_bangunan'] = $mydata['jns_bangunan'];
				$data['username'] = $mydata['username'];
				$data['nama_permohonan'] = $mydata['nama_permohonan'];
				$data['lantai_bg'] = $mydata['lantai_bg'];
				$data['tinggi_bg'] = $mydata['tinggi_bg'];
				$data['luas_bg'] = $mydata['luas_bg'];
				$data['luas_tanah'] = $mydata['luas_tanah'];
				$data['alamat_bg'] = $mydata['alamat_bg'];
				$data['nama_kecamatan'] = $mydata['nama_kecamatan_bg'];
				$data['nama_kabkota_bg'] = $mydata['nama_kabkota_bg'];
				$data['nama_provinsi_bg'] = $mydata['nama_provinsi_bg'];
				$data['id_pemanfaatan_bg'] = $mydata['id_pemanfaatan_bg2'];
				$data['fungsi_bg'] = $mydata['fungsi_bg'];
				
				$data['id_jenis_bg'] = $mydata['id_jenis_bg'];
						if($mydata['id_jenis_bg'] == 5){
							$data['tsarana'] = 5;
						}else{
							$data['tsarana'] = null;
							//$data['usaha2'] = "";
						}
				
				$data['lapis_basement'] = $mydata['lapis_basement'];
				$data['luas_basement'] = $mydata['luas_basement'];
				

				
				//$data['tgl_imb'] = tgl_eng_to_ind($mydata['tgl_imb']);
				//$data['tanggal_penyerahan_imb'] = tgl_eng_to_ind($mydata['tanggal_penyerahan_imb']);
			}
		}
		
		$this->load->view('kosong',$data);
	}
	
	function simpanperbaikan()
	{
		$id	= $this->uri->segment(3);
		$dataStatus = array(
					'status_progress' => 3,
					);
		$this->mpengajuan->update_progress($dataStatus,$id);
		$this->session->set_flashdata('message','Perbaikan Berhasil Disimpan.');
		$this->session->set_flashdata('status','success');
		redirect('pengajuanSLF/');
	}
	
	function simpanRevisiTeknis2()
	{
		$id_permohonan_slf = $this->uri->segment(3);
		$id = trim($this->input->post('id_penilaian'));
		$file_element_name 	= 'd_file';
		$thisdir = getcwd();
		$dirPath = $thisdir."/file/slf/".$id_permohonan_slf."/persyaratan/perbaikan_sidang/";
		if (!file_exists($dirPath)){
			//mkdir($dirPath, 0755, true);
  //create directory if not exist
		}
				
				
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 		= 'pdf';
				$config['max_size']			= '50240';
				$config['encrypt_name']		= TRUE;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
		//id_persyaratan_detail
		if(!empty($_FILES)){	
			if ( ! $this->upload->do_upload('d_file')){
					//$error['upload'] = $this->upload->display_errors();
					$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
					$this->session->set_flashdata('status','danger');
					redirect('pengajuanSLF/FormSummary/'.$id_permohonan.'#tab5');
			}else{
			
				if($file_element_name != ''){
					$file_undangan=$this->upload->data();
					$filename=$file_undangan['file_name'];
				}else{
					$filename = $_FILES['d_file']['name'];
				}
			
				$dataRT=array (
					'dir_file_perbaikan' => $filename,
				);
			
				$this->mpengajuan->updateDataPenilaian($dataRT,$id);
				$this->session->set_flashdata('message', 'Berkas Perbaikan Berhasil Diunggah');
				$this->session->set_flashdata('status','success');
				$data['valid'] = 'true';
				
				//return TRUE;
				redirect('pengajuanSLF/FormSummary/'.$id_permohonan_slf.'#tab5');
				
			}
		}
	}
	
	function removeDataRevisi()
	{
		$id_permohonan_slf = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		
		{
			$dataRT=array (
				'dir_file_perbaikan' =>null,
			);
			try {
				$this->mpengajuan->updateDataPenilaian($dataRT,$id);
				$this->session->set_flashdata('message', 'Berkas Perbaikan Berhasil Dihapus');
				$this->session->set_flashdata('status','success');
				$data['valid'] = 'true';
				
			}
			catch (Exception $e) {
				$this->session->set_flashdata('message', 'Berkas Perbaikan Gagal Dihapus');
				$this->session->set_flashdata('status','danger');
			}
			redirect('pengajuanSLF/FormSummary/'.$id_permohonan_slf.'#tab5');
		}
	}
	
	function simpanperbaikansidang()
	{
		
		$id	= $this->uri->segment(3);
		$dataStatus = array(
					'status_progress' => 9,
					);
		$this->mpengajuan->update_progress($dataStatus,$id);
		$this->session->set_flashdata('message','Perbaikan Berhasil Disimpan.');
		$this->session->set_flashdata('status','success');
		redirect('pengajuanSLF/');
	}
}
