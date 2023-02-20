<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pengajuan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('mglobal');
		$this->load->model('mpengajuan');
		$this->load->model('mpermohonan');
		$this->load->model('mretribusi');
		$this->load->library('simbg_lib');
		$this->load->library('encryption');
		$this->simbg_lib->check_session_login();
	}

	public function index(){
		$this->DataPermohonanIMB();
	}

	public function DataPermohonanIMB($user_id=null)
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$data['profile_user'] 	= $this->mpengajuan->getDataUserPemohon('a.*,b.*',$user_id);
		$data['daftar_kecamatan']	= $this->mpengajuan->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan');
		$data['daftar_kabkota']	= $this->mpengajuan->listDataKabKota('id_kabkot,nama_kabkota');
		$data['daftar_provinsi']	= $this->mpengajuan->listDataProvinsi('id_provinsi,nama_provinsi');
		
		$filterQueryIMB			= 'a.*,b.nama_permohonan';
		$data['list_pengajuan'] = $this->mpengajuan->getAllDataPermohonan($filterQueryIMB,$user_id);
		
		$data['content'] = $this->load->view('pengajuan_imb/DataPermohonan',$data,TRUE);
		$data['title']		=	'Dashboard';
		$data['heading']	=	'Report & Statistic';
		$this->load->view('backend',$data);
	}
	
	public function FormPendaftaranIMB()
	{
		$user_id			= $this->session->userdata('loc_user_id');
		//$user_id			= $this->uri->segment(3);
		$data['user_id']	= $user_id;
		$queFungsi = $this->mpengajuan->get_jenis_fungsi_list()->result();
		$list_fungsi[''] = '--Pilih--';
		foreach ($queFungsi as $row) {
			$list_fungsi[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		$data['list_fungsi']		= $list_fungsi;
		$data['profile_user'] = $this->mpengajuan->getDataUserProfile('a.*', $user_id);
		$data['daftar_provinsi']	= $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		if (isset($data['profile_user']->id_provinsi)) {
			$provinsi = $data['profile_user']->id_provinsi;
			$data['daftar_kabkota']		= $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $provinsi);
		}
		if (isset($data['profile_user']->id_kabkota)) {
			$kabkot = $data['profile_user']->id_kabkota;
			$data['daftar_kecamatan']	= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $kabkot);
		}
		$data['mpengajuan']			=	$this->mpengajuan;
		$data['content']			= 	$this->load->view('pengajuan_imb/FormPermohonan',$data,TRUE);
		$data['title']				=	'Form Permohonan IMB';
		$data['heading']			=	'Pendaftaran Permohonan IMB';
		$this->load->view('backend',$data);
	}
	
	public function PermohonanImbForm()
	{
		$user_id	= $this->session->userdata('loc_user_id');
		$id_permohonan	= $this->uri->segment(3);
		$data['DataPermohonan'] = $this->mpengajuan->getDataUserIMB('a.*,b.*', $id_permohonan);
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
		//Begin Jenis Permohonan//
		$permohonan = $this->mpengajuan->getDataImb('a.*',$id_permohonan)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		$data['content']	= $this->load->view('pengajuan_imb/FormPermohonanEditrevlagi', $data, TRUE);
		$data['title']		=	'Form Permohonan IMB';
		$data['heading']	=	'';
		$this->load->view('backend', $data);
	}
	
	public function FormDataTanah()
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$id_permohonan					= $this->uri->segment(3);
		//$id_permohonan			= $this->encryption->decrypt($id_en);
		$this->dtl();
		$data['id_permohonan']	= $id_permohonan;
		
		$data['jenis_dokumen']		= $this->mglobal->getDokumen('id,jenis_dokumen');
		if($id_permohonan != ''){
			$filterSummary	= '	a.id_permohonan,a.id_jenis_permohonan,a.pernyataan,a.nomor_registrasi,a.nama_pemohon,a.alamat_pemohon,a.nama_perusahaan,a.luas_bg,
								a.alamat_bg,a.lantai_bg,a.id_fungsi_bg,a.id_jenis_bg,a.id_pemanfaatan_bg,a.id_dok_tek,a.id_kolektif,a.tinggi_bg,a.luas_bg,a.jns_bangunan,a.nama_bangunan,
								a.tinggi_prasarana,a.luas_prasarana,b.nama_permohonan,c.nama_kecamatan,d.nama_kabkota,e.nama_provinsi,f.nama_kecamatan as kecamatan,g.nama_kabkota as kabkota,h.nama_provinsi as provinsi,
								i.fungsi_bg,k.*
								';
			$data['DataSummary']	= $this->mpengajuan->getSummaryImb($filterSummary,$id_permohonan);
			$data['DataTanah']		= $this->mpengajuan->getDataTanah('a.*',$id_permohonan);
		}
		$data['mpengajuan']			=	$this->mpengajuan;
		$data['content']			= 	$this->load->view('pengajuan_imb/FormDataTanah',$data,TRUE);
		$data['title']				=	'Form Permohonan IMB';
		$data['heading']			=	'Pendaftaran Permohonan IMB';
		$this->load->view('backend',$data);
	}
	
	public function saveDataTanah()
	{
		$user_id						= $this->session->userdata('loc_user_id');
		$id								= $this->input->post('id');
		$id_permohonan					= $this->input->post('id_permohonan');
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
				$dirPath = $thisdir."/file/IMB/pengajuan_imb/$id_permohonan/data_tanah/";
				if (!file_exists($dirPath)){
				//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				
				
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 		= 'pdf';
				$config['max_size']			= '10240';
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
				redirect('pengajuan/FormDataTanah/'.$id_permohonan);
		}elseif ((!$this->upload->do_upload($file_phat)) && ($lam_phat != '')) {
				$data['err_msg'] = $this->upload->display_errors('','');
				$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status','warning');
				redirect('pengajuan/FormDataTanah/'.$id_permohonan);
		}else {	
		$data	= array(
						'id_permohonan'=>$id_permohonan,
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
				$query		= $this->mglobals->setData('tm_imb_tanah',$data,'id',$id);
				$this->session->set_flashdata('message','Data Berhasil di Ubah.');
				$this->session->set_flashdata('status','success');
				redirect('pengajuan/FormDataTanah/'.$id_permohonan);
			}else{
				$query		= $this->mglobals->setData('tm_imb_tanah',$data,'id',$id);
				if($query){
					$this->session->set_flashdata('message','Data Berhasil di Simpan.');
					$this->session->set_flashdata('status','success');
					redirect('pengajuan/FormDataTanah/'.$id_permohonan);
				}else{
					$this->session->set_flashdata('message','Data Gagal di Simpan.');
					$this->session->set_flashdata('status','danger');
					redirect('pengajuan/FormDataTanah/'.$id_permohonan);
				}
			}
		}
			
	}
	
	public function removeDataTanah($id)
	{
		$id_permohonan	= $this->uri->segment(4);
		$process = $this->mpengajuan->removeData($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Tanah Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Tanah Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('pengajuan/FormDataTanah/'.$id_permohonan);
	}
	
	public function FormImbAdministrasi()
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$id_permohonan			= $this->uri->segment(3);
		$data['id_permohonan']	= $id_permohonan;
		
		$permohonan = $this->mpengajuan->getDataImb('a.*',$id_permohonan)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		
		if($id_permohonan != ''){
			$filterSummary	= '	a.id_permohonan,a.id_jenis_permohonan,a.pernyataan,a.nomor_registrasi,a.nama_pemohon,a.alamat_pemohon,a.nama_perusahaan,a.luas_bg,
								a.alamat_bg,a.lantai_bg,a.id_fungsi_bg,a.id_jenis_bg,a.id_pemanfaatan_bg,a.id_dok_tek,a.id_kolektif,a.tinggi_bg,a.luas_bg,a.jns_bangunan,
								a.nama_bangunan,a.tinggi_prasarana,a.luas_prasarana,b.nama_permohonan,c.nama_kecamatan,d.nama_kabkota,e.nama_provinsi,f.nama_kecamatan as kecamatan,g.nama_kabkota as kabkota,h.nama_provinsi as provinsi,
								i.fungsi_bg,k.*
								';
			$data['DataSummary']		= $this->mpengajuan->getSummaryImb($filterSummary,$id_permohonan);
			
			$data['DataAdministrasi']	= $this->mpengajuan->getDataAdministrasi('a.*',$id_permohonan);
			$filterQuery				= 'b.id_persyaratan_detail,b.id_syarat,c.nama_syarat';
			$data['MasterAdministrasi']	= $this->mpengajuan->getMasterAdministrasi($filterQuery,$id_jenis_permohonan);
		}
		$data['mpengajuan']			=	$this->mpengajuan;
		$data['content']			= 	$this->load->view('pengajuan_imb/FormDataAdministrasi',$data,TRUE);
		$data['title']				=	'Form Permohonan IMB';
		$data['heading']			=	'Pendaftaran Permohonan IMB';
		$this->load->view('backend',$data);
	}
	
	public function FormImbTeknis()
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$id_permohonan			= $this->uri->segment(3);
		$data['id_permohonan']	= $id_permohonan;
		$permohonan = $this->mpengajuan->getDataImb('a.*',$id_permohonan)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		if($id_permohonan != ''){
			$filterSummary	= '	a.id_permohonan,a.id_jenis_permohonan,a.pernyataan,a.nomor_registrasi,a.nama_pemohon,a.alamat_pemohon,a.nama_perusahaan,a.luas_bg,
								a.alamat_bg,a.lantai_bg,a.id_fungsi_bg,a.id_jenis_bg,a.id_pemanfaatan_bg,a.id_dok_tek,a.id_kolektif,a.tinggi_bg,a.luas_bg,a.jns_bangunan,
								a.nama_bangunan,a.tinggi_prasarana,a.luas_prasarana,b.nama_permohonan,c.nama_kecamatan,d.nama_kabkota,e.nama_provinsi,f.nama_kecamatan as kecamatan,g.nama_kabkota as kabkota,h.nama_provinsi as provinsi,
								i.fungsi_bg,k.*
								';
			$data['DataSummary']	= $this->mpengajuan->getSummaryImb($filterSummary,$id_permohonan);
			
			$data['DataTeknis']		= $this->mpengajuan->getDataTeknis('a.*',$id_permohonan);
			$filterQuery			= 'b.id_persyaratan_detail,b.id_syarat,c.nama_syarat';
			$data['MasterTeknis']	= $this->mpengajuan->getMasterTeknis($filterQuery,$id_jenis_permohonan);
		}
		$data['mpengajuan']			=	$this->mpengajuan;
		$data['content']			= 	$this->load->view('pengajuan_imb/FormDataTeknis',$data,TRUE);
		$data['title']				=	'Form Permohonan IMB';
		$data['heading']			=	'Pendaftaran Permohonan IMB';
		$this->load->view('backend',$data);
	}
	
	public function persyaratan_submit()
	{	
		$id_permohonan				= $this->uri->segment(3);
		$id_syarat					= $this->uri->segment(4);
		$kode_jenis_syarat			= $this->uri->segment(5);
		$id_administrasi			= $this->uri->segment(6);
		$data['id_permohonan']		= $id_permohonan;
		$data['id_syarat']			= $id_syarat;
		
		
				$file_element_name 	= 'd_file';

				
				$thisdir = getcwd();
				$dirPath = $thisdir."/file/imb/pengajuan_imb/".$id_permohonan."/persyaratan/Teknis";
				if (!file_exists($dirPath)){
				//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				
				
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 		= 'pdf';
				$config['max_size']			= '10240';
				$config['encrypt_name']		= TRUE;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
		//id_persyaratan_detail
		if(!empty($_FILES)){	
			if ( ! $this->upload->do_upload('d_file')){
					//$error['upload'] = $this->upload->display_errors();
					$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
					$this->session->set_flashdata('status','danger');
					redirect('pengajuan/FormImbTeknis/'.$id_permohonan);
			}else{
			
				if($file_element_name != ''){
					$file_undangan=$this->upload->data();
					$filename=$file_undangan['file_name'];
				}else{
					$filename = $_FILES['d_file']['name'];
				}
			
				$dataPersyaratan = array('id_permohonan'=>$id_permohonan,
									'id_persyaratan_detail'=>$id_syarat,
									'dir_file'=>$filename,
								);
			
				//$this->mglobals->setData('tm_imb_administrasi',$dataPersyaratan,'id',$id_administrasi);
				$this->mglobals->setData('tm_permohonan_bg_syarat',$dataPersyaratan,'id',$id_administrasi);
				$this->session->set_flashdata('message','Berkas Berhasil Disimpan !.');
				$this->session->set_flashdata('status','success');
				redirect('pengajuan/FormImbTeknis/'.$id_permohonan);
			}
		}
	}
	
	public function persyaratan_submitrev()
	{	
		$id_permohonan				= $this->uri->segment(3);
		$id_syarat					= $this->uri->segment(4);
		$kode_jenis_syarat			= $this->uri->segment(5);
		$id_administrasi			= $this->uri->segment(6);
		$data['id_permohonan']		= $id_permohonan;
		$data['id_syarat']			= $id_syarat;
		
		
				$file_element_name 	= 'd_file';

				
				$thisdir = getcwd();
				$dirPath = $thisdir."/file/imb/pengajuan_imb/".$id_permohonan."/persyaratan/Teknis";
				if (!file_exists($dirPath)){
				//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				
				
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 		= 'pdf';
				$config['max_size']			= '10240';
				$config['encrypt_name']		= TRUE;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
		//id_persyaratan_detail
		if(!empty($_FILES)){	
			if ( ! $this->upload->do_upload('d_file')){
					//$error['upload'] = $this->upload->display_errors();
					$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
					$this->session->set_flashdata('status','danger');
					redirect('pengajuan/FormSummary/'.$id_permohonan.'#tab3');
			}else{
			
				if($file_element_name != ''){
					$file_undangan=$this->upload->data();
					$filename=$file_undangan['file_name'];
				}else{
					$filename = $_FILES['d_file']['name'];
				}
			
				$dataPersyaratan = array('id_permohonan'=>$id_permohonan,
									'id_persyaratan_detail'=>$id_syarat,
									'dir_file'=>$filename,
								);
			
				//$this->mglobals->setData('tm_imb_administrasi',$dataPersyaratan,'id',$id_administrasi);
				$this->mglobals->setData('tm_permohonan_bg_syarat',$dataPersyaratan,'id',$id_administrasi);
				$this->session->set_flashdata('message','Berkas Berhasil Disimpan !.');
				$this->session->set_flashdata('status','success');
				redirect('pengajuan/FormSummary/'.$id_permohonan.'#tab3');
			}
		}
	}
	
	public function persyaratan_submitadm()
	{	
		$id_permohonan				= $this->uri->segment(3);
		$id_syarat					= $this->uri->segment(4);
		$kode_jenis_syarat			= $this->uri->segment(5);
		$id_administrasi			= $this->uri->segment(6);
		$data['id_permohonan']		= $id_permohonan;
		$data['id_syarat']			= $id_syarat;
		
				$file_element_name 	= 'd_file';

				$thisdir = getcwd();
				$dirPath = $thisdir."/file/imb/pengajuan_imb/".$id_permohonan."/persyaratan/Administrasi";
				if (!file_exists($dirPath)){
					//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 		= 'pdf';
				$config['max_size']			= '10240';
				$config['encrypt_name']		= TRUE;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
		//id_persyaratan_detail
		if(!empty($_FILES)){	
			if ( ! $this->upload->do_upload('d_file')){
					//$error['upload'] = $this->upload->display_errors();
					$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
					$this->session->set_flashdata('status','danger');
					redirect('pengajuan/FormImbAdministrasi/'.$id_permohonan);
			}else{
			
				if($file_element_name != ''){
					$file_undangan=$this->upload->data();
					$filename=$file_undangan['file_name'];
				}else{
					$filename = $_FILES['d_file']['name'];
				}
			
				$dataPersyaratan = array('id_permohonan'=>$id_permohonan,
									'id_persyaratan_detail'=>$id_syarat,
									'dir_file'=>$filename,
								);
			
				//$this->mglobals->setData('tm_imb_administrasi',$dataPersyaratan,'id',$id_administrasi);
				$this->mglobals->setData('tm_permohonan_bg_syarat',$dataPersyaratan,'id',$id_administrasi);
				$this->session->set_flashdata('message','Berkas Berhasil Disimpan !.');
				$this->session->set_flashdata('status','success');
				redirect('pengajuan/FormImbAdministrasi/'.$id_permohonan);
			}
		}
	}
	
	public function persyaratan_submitadmrev()
	{	
		$id_permohonan				= $this->uri->segment(3);
		$id_syarat					= $this->uri->segment(4);
		$kode_jenis_syarat			= $this->uri->segment(5);
		$id_administrasi			= $this->uri->segment(6);
		$data['id_permohonan']		= $id_permohonan;
		$data['id_syarat']			= $id_syarat;
		
				$file_element_name 	= 'd_file';

				$thisdir = getcwd();
				$dirPath = $thisdir."/file/imb/pengajuan_imb/".$id_permohonan."/persyaratan/Administrasi";
				if (!file_exists($dirPath)){
					//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 		= 'pdf';
				$config['max_size']			= '10240';
				$config['encrypt_name']		= TRUE;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
		//id_persyaratan_detail
		if(!empty($_FILES)){	
			if ( ! $this->upload->do_upload('d_file')){
					//$error['upload'] = $this->upload->display_errors();
					$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
					$this->session->set_flashdata('status','danger');
					redirect('pengajuan/FormSummary/'.$id_permohonan.'#tab3');
			}else{
			
				if($file_element_name != ''){
					$file_undangan=$this->upload->data();
					$filename=$file_undangan['file_name'];
				}else{
					$filename = $_FILES['d_file']['name'];
				}
			
				$dataPersyaratan = array('id_permohonan'=>$id_permohonan,
									'id_persyaratan_detail'=>$id_syarat,
									'dir_file'=>$filename,
								);
			
				//$this->mglobals->setData('tm_imb_administrasi',$dataPersyaratan,'id',$id_administrasi);
				$this->mglobals->setData('tm_permohonan_bg_syarat',$dataPersyaratan,'id',$id_administrasi);
				$this->session->set_flashdata('message','Berkas Berhasil Disimpan !.');
				$this->session->set_flashdata('status','success');
				redirect('pengajuan/FormSummary/'.$id_permohonan.'#tab3');
			}
		}
	}
	
	public function FormPernyataan()
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$id_permohonan			= $this->uri->segment(3);
		$data['id_permohonan']	= $id_permohonan;
		$permohonan = $this->mpengajuan->getDataImb('a.*',$id_permohonan)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		if($id_permohonan != ''){
			$filterSummary	= '	a.id_permohonan,a.id_jenis_permohonan,a.pernyataan,a.nomor_registrasi,a.nama_pemohon,a.alamat_pemohon,a.nama_perusahaan,a.luas_bg,
								a.alamat_bg,a.lantai_bg,a.id_fungsi_bg,a.id_jenis_bg,a.id_pemanfaatan_bg,a.id_dok_tek,a.id_kolektif,a.tinggi_bg,a.luas_bg,a.jns_bangunan,
								a.nama_bangunan,a.tinggi_prasarana,a.luas_prasarana,b.nama_permohonan,c.nama_kecamatan,d.nama_kabkota,e.nama_provinsi,f.nama_kecamatan as kecamatan,g.nama_kabkota as kabkota,h.nama_provinsi as provinsi,
								i.fungsi_bg,k.*
								';
			$data['DataSummary']	= $this->mpengajuan->getSummaryImb($filterSummary,$id_permohonan);
		}
		$data['mpengajuan']			=	$this->mpengajuan;
		$data['content']			= 	$this->load->view('pengajuan_imb/FormPernyataan',$data,TRUE);
		$data['title']				=	'Form Permohonan IMB';
		$data['heading']			=	'Pendaftaran Permohonan IMB';
		$this->load->view('backend',$data);
	}
	
	public function saveDataPernyataan()
	{
		$user_id		= $this->session->userdata('loc_user_id');
		$id_permohonan	= $this->input->post('id_permohonan');
		$pernyataan		=  $this->input->post('pernyataan');
		$tgl_skrg 		= date('Y-m-d');
		$nomor_registrasi = $this->nomor_registrasi($id_permohonan);
		if($pernyataan == '1')
		{
			$data	= array(
							'pernyataan'=>$pernyataan,
							'nomor_registrasi' =>$nomor_registrasi,
							'tgl_permohonan' => $tgl_skrg,
							'status_progress' => '1',
							'post_date'=>date('Y-m-d')
					);
			$this->mglobals->setData('tm_imb_permohonan',$data,'id_permohonan',$id_permohonan);			
			//$this->mpengajuan->update_permohonan($data,$id_permohonan);
			$this->session->set_flashdata('message','Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status','success');
		}
		redirect('pengajuan/DataPermohonanIMB/'.$user_id);
	}
	
	public function saveDataIMB()
	{
		$user_id		= $this->session->userdata('loc_user_id');
		$id_permohonan	= $this->input->post('id_permohonan');
		//Begin Data Pemilik
		
			$nama_pemilik	= $this->input->post('nama_pemilik');
			$alamat_pemohon	= $this->input->post('alamat_pemohon');
			$nama_provinsi	= $this->input->post('nama_provinsi');
			$nama_kabkota	= $this->input->post('nama_kabkota');
			$nama_kecamatan	= $this->input->post('nama_kecamatan');
			$email			= $this->input->post('email');
			$no_ktp			= $this->input->post('no_ktp');
			//$notelp_o = $this->input->post('no_tlp');
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
		$id_dok_tek			= $this->input->post('id_dok_tek');
		if ($id_fungsi_bg =='1')
		{
			$id_pemanfaatan_bg = '2';
		}else{
			$id_pemanfaatan_bg = '1';
			$id_dok_tek		= '1';
		}
		$jns_bangunan		= $this->input->post('jns_bangunan');
		$id_prasarana_bg	= $this->input->post('id_prasarana_bg');
		$luas_bg			= $this->input->post('luas_bgn');
		$lantai_bg			= $this->input->post('lantai_bg');
		$nama_bangunan		= $this->input->post('nama_bangunan');
		$tinggi_bg			= $this->input->post('tinggi_bgn');
		$luas_prasarana		= $this->input->post('luas_prasarana');
		$tinggi_prasarana	= $this->input->post('tinggi_prasarana');
		$id_kolektif		= $this->input->post('id_kolektif');
		
		$luas_basement		= $this->input->post('luas_basement');
		$lapis_basement		= $this->input->post('lapis_basement');
		
		$nib_detail = trim($this->input->post('nib_detail'));
		$nib = trim($this->input->post('nib'));
		$data['nib'] = $nib;
		
		/*if($nib != ""){
			$getDataNIB = $this->mpengajuan->get_nib_detail($nib,$nib_detail);
			$mydataNIB = $getDataNIB->row_array();
			$barisNIB = $getDataNIB->num_rows();
			if ($barisNIB >= 1 ) {
				$id_jenis_usaha = "2";
			}
		}*/
		//End Data Bangunan Gedung
		
		//Data Kolektif
		$sk_imbkol		= $this->input->post('sk_imbkol');
		$tipeA			= $this->input->post('tipeA');
		$tipeB			= $this->input->post('tipeB');
		$tipeC			= $this->input->post('tipeC');
		$tipeD			= $this->input->post('tipeD');
		$unitA			= $this->input->post('unitA');
		$unitB			= $this->input->post('unitB');
		$unitC			= $this->input->post('unitC');
		$unitD			= $this->input->post('unitD');
		$luasA			= $this->input->post('luasA');
		$luasB			= $this->input->post('luasB');
		$luasC			= $this->input->post('luasC');
		$luasD			= $this->input->post('luasD');
		$tinggiA		= $this->input->post('tinggiA');
		$tinggiB		= $this->input->post('tinggiB');
		$tinggiC		= $this->input->post('tinggiC');
		$tinggiD		= $this->input->post('tinggiD');
		
		if ($id_jenis_bg == '4'){
			
			$id_dok_tek			= "1";
			$jns_bangunan		= $this->input->post('nama_bangunan');
			
			if ($id_kolektif == '2'){
				$id_fungsi_bg		= "1";
			}else{
				$id_fungsi_bg		= "3";
			}
			
		}elseif ($id_jenis_bg == '5'){
			
			$id_dok_tek			= "1";
			$jns_bangunan		= $this->input->post('nama_bangunan');
			$id_fungsi_bg		= "3";
			$id_kolektif		= 0;
			
		}elseif ($id_jenis_bg == '6'){
			$id_dok_tek			= "1";
			$jns_bangunan		= "Bangunan gedung tempat penyimpanan";
			$id_fungsi_bg		= "3";
			$luas_bg			= "1300";
			$id_kolektif		= 0;
		}else{
			$id_dok_tek			= $this->input->post('id_dok_tek');
			$jns_bangunan		= $this->input->post('jns_bangunan');
			$id_fungsi_bg		= $this->input->post('id_fungsi_bg');
			$id_kolektif		= 0;
		}
		//
		$data	= array(
						'id_permohonan' => $id_permohonan,
						'id_user'=>$user_id,
						'id_jenis_usaha'=>$id_jenis_usaha,
						'nama_pemohon' => $nama_pemilik,
						'alamat_pemohon' => $alamat_pemohon,
						'id_kecamatan' => $nama_kecamatan,
						'id_kabkot' => $nama_kabkota,
						'id_provinsi' => $nama_provinsi,
						'email' => $email,
						'no_ktp' => $no_ktp,
						'alamat_bg' => $alamat_bg,
						'id_kec_bg' => $nama_kecamatan_bg,
						'id_kabkot_bg' => $nama_kabkota_bg,
						'id_provinsi_bg' => $nama_provinsi_bg,
						'id_jenis_bg' => $id_jenis_bg,
						'id_fungsi_bg' => $id_fungsi_bg,
						'id_pemanfaatan_bg' => $id_pemanfaatan_bg,
						'nib' => $nib,
						'kd_izin' => $nib_detail,
						'jns_bangunan' => $jns_bangunan,
						'luas_bg' => $luas_bg,
						'tinggi_bg' => $tinggi_bg,
						'lantai_bg' => $lantai_bg,
						'nama_bangunan' => $nama_bangunan,
						'id_prasarana_bg' => $id_prasarana_bg,
						'luas_prasarana' => $luas_prasarana,
						'tinggi_prasarana' => $tinggi_prasarana,
						'id_kolektif' => $id_kolektif,
						'id_dok_tek' => $id_dok_tek,
						'luas_basement' => $luas_basement,
						'lapis_basement' => $lapis_basement,
					);
		
		if($id_permohonan != null){
			$this->mpengajuan->updatePermohonan($data,$id_permohonan);
				$dataKolektif = array(
						'id_permohonan' 	=> $id_permohonan,
						'id_user'       	=> $user_id,
						'sk_imb_kolektif'	=> $sk_imbkol,
						'tipeA' => $tipeA,
						'tipeB' => $tipeB,
						'tipeC' => $tipeC,
						'tipeD' => $tipeD,
						'unitA' => $unitA,
						'unitB' => $unitB,
						'unitC' => $unitC,
						'unitD' => $unitD,
						'luasA' => $luasA,
						'luasB' => $luasB,
						'luasC' => $luasC,
						'luasD' => $luasD,
						'tinggiA' => $tinggiA,
						'tinggiB' => $tinggiB,
						'tinggiC' => $tinggiC,
						'tinggiD' => $tinggiD,
				);
			if ($id_jenis_bg == '4'){
				$this->mpengajuan->ubah_kolektif($dataKolektif,$id_permohonan);
			}
		}else{
			$id_permohonan		= $this->mglobals->setData('tm_imb_permohonan',$data,'id_permohonan',$id_permohonan);
				$dataKolektif = array(
						'id_permohonan' 	=> $id_permohonan,
						'id_user'       	=> $user_id,
						'sk_imb_kolektif'	=> $sk_imbkol,
						'tipeA' => $tipeA,
						'tipeB' => $tipeB,
						'tipeC' => $tipeC,
						'tipeD' => $tipeD,
						'unitA' => $unitA,
						'unitB' => $unitB,
						'unitC' => $unitC,
						'unitD' => $unitD,
						'luasA' => $luasA,
						'luasB' => $luasB,
						'luasC' => $luasC,
						'luasD' => $luasD,
						'tinggiA' => $tinggiA,
						'tinggiB' => $tinggiB,
						'tinggiC' => $tinggiC,
						'tinggiD' => $tinggiD,
				);
				
			if ($id_jenis_bg == '4'){
				$this->mpengajuan->simpan_kolektif($dataKolektif,$id_permohonan);
			}
		}
		//echo $id_permohonan;
		$this->session->set_flashdata('message','Data Berhasil di Simpan.');
		$this->session->set_flashdata('status','success');
		redirect('pengajuan/FormDataTanah/'.$id_permohonan);
	}
	
	function removeDataPersyaratan()
	{
		$id_permohonan_bg_syarat = $this->uri->segment(3);
		$id_permohonan = $this->uri->segment(5);
		$key_syarat = $this->uri->segment(4);
		$data['pesan'] = '';
		$data['err_msg'] = '';

		if(trim($id_permohonan_bg_syarat) != '' ) {
			try{
				$this->mpengajuan->RemoveAdministrasi($id_permohonan_bg_syarat);
				$this->session->set_flashdata('message','Berkas Berhasil Dihapus.');
				$this->session->set_flashdata('status','success');
				redirect('pengajuan/FormImbAdministrasi/'.$id_permohonan);
			}
			catch(Exception $e){
				$this->session->set_flashdata('message','Berkas Gagal Dihapus.');
				$this->session->set_flashdata('status','danger');
				redirect('pengajuan/FormImbAdministrasi/'.$id_permohonan);

			}
		}	
	}
	
	function removeDataPersyaratanrev()
	{
		$id_permohonan_bg_syarat = $this->uri->segment(3);
		$id_permohonan = $this->uri->segment(5);
		$key_syarat = $this->uri->segment(4);
		$data['pesan'] = '';
		$data['err_msg'] = '';

		if(trim($id_permohonan_bg_syarat) != '' ) {
			try{
				$this->mpengajuan->RemoveAdministrasi($id_permohonan_bg_syarat);
				$this->session->set_flashdata('message','Berkas Berhasil Dihapus.');
				$this->session->set_flashdata('status','success');
				redirect('pengajuan/FormSummary/'.$id_permohonan.'#tab3');
			}
			catch(Exception $e){
				$this->session->set_flashdata('message','Berkas Gagal Dihapus.');
				$this->session->set_flashdata('status','danger');
				redirect('pengajuan/FormSummary/'.$id_permohonan.'#tab3');

			}
		}	
	}
	
	function removeDataPersyaratan2()
	{
		$id_permohonan_bg_syarat = $this->uri->segment(3);
		$id_permohonan = $this->uri->segment(5);
		$key_syarat = $this->uri->segment(4);
		$data['pesan'] = '';
		$data['err_msg'] = '';

		if(trim($id_permohonan_bg_syarat) != '' ) {
			try{
				$this->mpengajuan->RemoveAdministrasi($id_permohonan_bg_syarat);
				$this->session->set_flashdata('message','Berkas Berhasil Dihapus.');
				$this->session->set_flashdata('status','success');
				redirect('pengajuan/FormImbTeknis/'.$id_permohonan);
				
			}
			catch(Exception $e){
				$this->session->set_flashdata('message','Berkas Gagal Dihapus.');
				$this->session->set_flashdata('status','danger');
				redirect('pengajuan/FormImbTeknis/'.$id_permohonan);

			}
		}
		
	}
	
	public function FormSummary()
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$id_permohonan			= $this->uri->segment(3);
		$data['id_permohonan']	= $id_permohonan;
		$queFungsi = $this->mpengajuan->get_jenis_fungsi_list()->result();
		$list_fungsi[''] = '--Pilih--';
		foreach ($queFungsi as $row) 
		{
			$list_fungsi[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		$data['list_fungsi'] = $list_fungsi;
		
		//Begin Jenis Permohonan//
		$permohonan = $this->mpengajuan->getDataImb('a.*',$id_permohonan)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$data['pernyataan'] = $permohonan['pernyataan'];
		//End Jenis Permohonan
		$data['daftar_provinsi']	= $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$data['daftar_kecamatan']	= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan');
		$data['daftar_kabkota']		= $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota');
		if($id_permohonan != ''){
			if($id_jenis_permohonan != ''){
				$data['DataAdministrasi']	= $this->mpengajuan->getDataAdministrasi('a.*',$id_permohonan);
				$filterQuery				= 'b.id_persyaratan_detail,b.id_syarat,c.nama_syarat';
				$data['MasterAdministrasi']	= $this->mpengajuan->getMasterAdministrasi($filterQuery,$id_jenis_permohonan);
				
			}
			if($id_jenis_permohonan != ''){
				$data['DataTeknis']		= $this->mpengajuan->getDataTeknis('a.*',$id_permohonan);
				$filterQuery			= 'b.id_persyaratan_detail,b.id_syarat,c.nama_syarat';
				$data['MasterTeknis']	= $this->mpengajuan->getMasterTeknis($filterQuery,$id_jenis_permohonan);
			}
			$data['DataPermohonan']		= $this->mpengajuan->getDataPermohonan('a.*,b.nama_provinsi,c.nama_kabkota,d.nama_kecamatan,e.*,f.*,g.id_penetapan_retribusi,g.harga_satuan,g.retribusi,g.retribusi_manual',$id_permohonan);
			$data['DataTanah']			= $this->mpengajuan->getDataTanah('a.*',$id_permohonan);
			//$data['DataRetribusi']		= $this->mpengajuan->getdata_retsibusi('a.*',$id_permohonan);
			//Begin Perbaikan Teknis
			$query1 = $this->mpengajuan->getSyaratListTidakSesuai($id_permohonan);				
			$data['jum_data'] = $query1->num_rows();		
			$data['results'] = $query1->result();
			$data['model_permohonan'] = $this->mpengajuan;
			$data['mpermohonan'] = $this->mpengajuan;
			//End Perbaikan Teknis
		}
		$this->dtl();
		$data['mpengajuan']			=	$this->mpengajuan;
		$data['content']			= 	$this->load->view('pengajuan_imb/DataSummary',$data,TRUE);
		$data['title']				=	'Form Permohonan IMB';
		$data['heading']			=	'Pendaftaran Permohonan IMB';
		$this->load->view('backend',$data);
	}
	
	function simpanRevisiTeknis()
	{
		$id_permohonan				= $this->uri->segment(3);
		$data['id_permohonan'] = $id_permohonan;
		$file_element_name = 'd_file1';
		$filename = trim($_FILES['d_file1']['name']);
		//id_persyaratan_detail
		if(!empty($_FILES)){
			$file_element_name 	= 'd_file';
			$allowed_types 		= 'pdf';
			$thisdir = getcwd();
				$upload_path = $thisdir."/file/imb/pengajuan_imb/".$id_permohonan."/sidang_n_penilaian/perbaikan_sidang/";
			if (!file_exists($upload_path)) {
				mkdir($upload_path, 0777, true);  //create directory if not exist
			}
			$filename = $this->upload_file($file_element_name,$upload_path,$allowed_types);
			$id_penilaian = trim($this->input->post('id_penilaian'));
			$dataPersyaratan = array(
									'dir_file_hasil_perbaikan_pemohon'=>$filename,
								);
		
			$this->mglobals->setData('tm_penilaian_teknis',$dataPersyaratan,'id',$id_permohonan);
			redirect('pengajuan/FormSummary/'.$id_permohonan);
		}
	}
	
	function simpanRevisiTeknis2()
	{
		$id_permohonan = $this->uri->segment(3);
		$data['id_permohonan'] = $id_permohonan;
		$id_penilaian = trim($this->input->post('id_penilaian'));
		//$file_element_name = 'd_file';
		//$filename = trim($_FILES['d_file']['name']);
		$file_element_name 	= 'd_file';
		$thisdir = getcwd();
		$dirPath = $thisdir."/file/imb/pengajuan_imb/".$id_permohonan."/sidang_n_penilaian/perbaikan_sidang/";
		if (!file_exists($dirPath)){
			//mkdir($dirPath, 0755, true);
  //create directory if not exist
		}
				
				
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 		= 'pdf';
				$config['max_size']			= '10240';
				$config['encrypt_name']		= TRUE;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
		//id_persyaratan_detail
		if(!empty($_FILES)){	
			if ( ! $this->upload->do_upload('d_file')){
					//$error['upload'] = $this->upload->display_errors();
					$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
					$this->session->set_flashdata('status','danger');
					redirect('pengajuan/FormSummary/'.$id_permohonan.'#tab5');
			}else{
			
				if($file_element_name != ''){
					$file_undangan=$this->upload->data();
					$filename=$file_undangan['file_name'];
				}else{
					$filename = $_FILES['d_file']['name'];
				}
			
				$dataRT=array (
					'dir_file_hasil_perbaikan_pemohon' => $filename,
				);
			
				$this->mpengajuan->updateDataPenilaian($dataRT,$id_penilaian);
				$this->session->set_flashdata('message', 'Berkas Perbaikan Berhasil Diunggah');
				$this->session->set_flashdata('status','success');
				$data['valid'] = 'true';
				
				//return TRUE;
				redirect('pengajuan/FormSummary/'.$id_permohonan.'#tab5');
				
			}
		}
	}
	
	function removeDataRevisi()
	{
		$id_permohonan = $this->uri->segment(3);
		$data['id_permohonan'] = $id_permohonan;
		$id_penilaian = $this->uri->segment(4);
		
		{
			$dataRT=array (
				'dir_file_hasil_perbaikan_pemohon' =>null,
			);
			try {
				$this->mpengajuan->deleteFileRevisi($dataRT,$id_penilaian);
				$this->session->set_flashdata('message', 'Berkas Perbaikan Berhasil Dihapus');
				$this->session->set_flashdata('status','success');
				$data['valid'] = 'true';
				
			}
			catch (Exception $e) {
				$this->session->set_flashdata('message', 'Berkas Perbaikan Gagal Dihapus');
				$this->session->set_flashdata('status','danger');
			}
			redirect('pengajuan/FormSummary/'.$id_permohonan.'#tab5');
		}
	}
	
	public function SimpanPembayaran()
	{
		$id_permohonan 	= $this->input->post('id_permohonan');
		$id_log  		= $this->input->post('id_log');
		$id_ssrd 		= $this->input->post('id_ssrd');
		$no_ssrd 		= $this->input->post('no_ssrd');
		$tgl_ssrd		= $this->input->post('tanggal_ssrd');
		$lampiran		= $this->input->post('d_file');
		//upload Files
		if($_FILES)
		{
			$thisdir = getcwd();
			$dirPath = $thisdir."/file/IMB/pengajuan_imb/$id_permohonan/ssrd/";
			if (!file_exists($dirPath)) {
				//mkdir($dirPath, 0755, true);
  //create directory if not exist
			}
				$config['upload_path'] 		= $dirPath;
				$config['allowed_types'] 	= 'pdf';
				$config['max_size']			= '10240';
				//$config['encrypt_name']		= TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('dir_file_pemberitahuan')){
					$this->session->set_flashdata('message','Data Gagal Di Perbaharui');
					$this->session->set_flashdata('status','danger');
					redirect('pengajuan/verifikasi/');
				}else{
					$upload	 			= $this->upload->data();
					$upload_file		= $upload['file_name'];
					$this->mpengajuan->saveRetribusi();
					$this->mpengajuan->editStatus($id_permohonan);
					redirect('pengajuan/verifikasi/');
				}
		}
		//End Upload Files	
	}
	
	public function saveBayarRetribusi()
	{
		$id_permohonan = $this->input->post('id_permohonan');
		//$id_log  		= $this->input->post('id_log');
		$id_ssrd = $this->input->post('id_ssrd');
		$no_ssrd = $this->input->post('no_ssrd');
		$tgl_ssrd = $this->input->post('tanggal_ssrd');

			
			//Upload file Hitung Manual
				$file_element_name2 = 'd_file_s';
				$lam2 = $this->input->post('dir_file_s');
				$filename2 = $_FILES['d_file_s']['name'];
				
				$thisdir = getcwd();
				$dirPath = $thisdir."/file/IMB/pengajuan_imb/$id_permohonan/ssrd/";
				if (!file_exists($dirPath)){
				//mkdir($dirPath, 0755, true);
  //create directory if not exist
				}
				
				$config_file2['upload_path'] 		= $dirPath;
				$config_file2['allowed_types'] 		= 'pdf';
				$config_file2['max_size']			= '10240';
				$config_file2['encrypt_name']		= TRUE;
				
			
				
				$this->load->library('upload', $config_file2);
				$this->upload->initialize($config_file2);
			//End Upload
			
		if ((!$this->upload->do_upload($file_element_name2)) && ($lam2 != '') ){
				$this->session->set_flashdata('message','Jenis Berkas atau Ukuran Berkas tidak Sesuai !');
				$this->session->set_flashdata('status','danger');
				
		}else{

				if($lam2 != ''){
					$file2=$this->upload->data();
					$lampiran2=$file2['file_name'];
				}else{
					$lampiran2=$this->input->post('dir_file_edit_s');
				}
				$dataIn = array (
				 'id_permohonan' =>$id_permohonan,
				 'no_ssrd' =>$no_ssrd,
				 'tgl_ssrd' =>$tgl_ssrd,
				 'file_ssrd' =>$lampiran2
				);
				
				$dataStatus = array(
					'status_progress' => 13,
					);
				$this->mpermohonan->update_permohonan($dataStatus,$id_permohonan);
				
			if (empty($id_ssrd) || trim($id_ssrd) == '' || $id_ssrd==null || $id_ssrd=='0') {

				try {
					$this->mretribusi->insert_ssrd($dataIn);
					
					$this->session->set_flashdata('message','SSRD Berhasil Disimpan.');
					$this->session->set_flashdata('status','success');
				}
				catch (Exception $e) {
					$this->session->set_flashdata('message','SSRD Gagal Disimpan.');
					$this->session->set_flashdata('status','danger');
				}
			}else{
				try {
					$this->mretribusi->update_ssrd($dataIn,$id_ssrd);
					$this->session->set_flashdata('message','Berhasil Menyimpan SSRD.');
					$this->session->set_flashdata('status','success');
				}
				catch (Exception $e) {
					$this->session->set_flashdata('message','Gagal Menyimpan SSRD.');
					$this->session->set_flashdata('status','danger');
					}
				}
			}
		redirect('pengajuan/FormSummary/'.$id_permohonan.'#tab6');
		
		
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
	//End Permohonan IMB
	
	// Begin Data Yang di pake IMB
	public function nomor_registrasi($id_permohonan=null)
	{
		$que = $this->mpengajuan->get_id_kabkot($id_permohonan);
		$id_skrg = $que['id_kabkot_bg'];
		$no_reg_awal = $que['id_kec_bg'];
		$tgl_disetujui = date('d').date('m').date('Y');;
		$mydata2 = $this->mpengajuan->get_nomor_registrasi($id_skrg,$tgl_disetujui);
		if(count($mydata2)>0){
			$no_baru = SUBSTR($mydata2['no_urut'],-2)+1;
			if ($no_baru < 10){
					$no_registrasi = "IMB-".$no_reg_awal."-".$tgl_disetujui."-0".$no_baru;
			}else {
				$no_registrasi = "IMB-".$no_reg_awal."-".$tgl_disetujui."-".$no_baru;
			}
	    } else {
	      $no_registrasi = "IMB-".$no_reg_awal."-".$tgl_disetujui."-01";
	    }
		return $no_registrasi;
	}
	
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
	
	public function getDataProvinsi()
	{

		$value		= array();
		$query		= $this->mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_provinsi' => $row->id_provinsi, 'nama_provinsi' => $row->nama_provinsi);
			}
		}
		echo json_encode($value);
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
	
	function dtl()
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
	
	function simpanperbaikan()
	{
		$id_permohonan	= $this->uri->segment(3);
		$dataStatus = array(
					'status_progress' => 3,
					);
		$this->mpermohonan->update_permohonan($dataStatus,$id_permohonan);
		$this->session->set_flashdata('message','Perbaikan Berhasil Disimpan.');
		$this->session->set_flashdata('status','success');
		redirect('pengajuan/');
	}
	
	function simpanperbaikansidang()
	{
		$id_permohonan	= $this->uri->segment(3);
		$dataStatus = array(
					'status_progress' => 9,
					);
		$this->mpermohonan->update_permohonan($dataStatus,$id_permohonan);
		$this->session->set_flashdata('message','Perbaikan Sidang Berhasil Disimpan.');
		$this->session->set_flashdata('status','success');
		redirect('pengajuan/');
	}
}
