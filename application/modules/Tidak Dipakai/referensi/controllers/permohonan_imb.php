<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Permohonan_imb extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->helper('utility');
		$this->load->library('mypagination' );
		$this->load->model('pengajuan_imb_model','mpermohonan');
		$this->load->model('master_permohonan_model','m_mpermohonan');
		//Begin Data Pemohon
		$this->load->model('mglobals');
		$this->load->model('pengajuan_slf_model','mpengajuan');	
		//End Data Pemohon
		$this->load->library('oss_lib');
		$this->qi_auth->check_permissions_v2();	
	}
	function killSession()
	{
		$this->session->unset_userdata('pencarian');	
	}
	
	public function index()
	{	 
		//$this->killSession();
		$this->daftar_permohonan();
	}
	
	public function daftar_permohonan()
	{
		$data['title']				=	'Daftar Permohon IMB';
		$user_id					= $this->session->userdata('Qi_user_id');
		$user_id					= $this->uri->segment(3);
		$data['id']					= $user_id;
		//echo $user_id;
		if($user_id != '' || $user_id != null){
			$permohonan = $this->mpermohonan->get_permohonan('a.*',$user_id)->row_array();
			$data['DataUser']		= $this->mpengajuan->getDataUser('a.*',$user_id)->row_array();
			$data['DataPemohon']	= $this->mpengajuan->getDataPemohon('a.*,b.nama_provinsi,c.nama_kabkota,d.nama_kecamatan',$user_id)->row_array();
		}
		$filterQuery				= 'a.*,b.nama_permohonan';
		$data['list_permohonan'] 	= $this->mpermohonan->getAllDataPermohonan($filterQuery,$user_id);
		$data['jum_data'] 			= $data['list_permohonan']->num_rows();
		$data['contents']			= $this->load->view('pengajuan_imb/list_permohonan',$data,TRUE);
		$this->load->view('admin_template',$data);
	}
	
	public function input_pemohon_form()
	{
		$user_id					= $this->session->userdata('Qi_user_id');
		$pengajuan_id				= $this->uri->segment(3);
		$data['pengajuan_id']		= $pengajuan_id;
		$config = array (
					array(
						'field'=>'nama_pemohon',
						'label'=>'Nama Pemohon',
						'rules'=>'trim|required'
					),
					array(
						'field'=>'alamat',
						'label'=>'Alamat',
						'rules'=>'trim|required'
					),
					array(
						'field'=>'no_ktp',
						'label'=>'Nomor KTP',
						'rules'=>'trim|required'
					),
					array(
						'field'=>'id_kecamatan',
						'label'=>'Nama Kecamatan',
						'rules'=>'trim|required'
					),
					array(
						'field'=>'no_hp',
						'label'=>'Nomor Handphone',
						'rules'=>'trim|required'
					),
				);
		
		if($this->input->post('save')) 
		{
			$this->form_validation->set_rules($config);
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			if($this->form_validation->run() === FALSE) 
			{
				$data['err_msg'] = validation_errors();
			}else{
				$id_pemohon		= $this->input->post('id_pemohon');
				$pengajuan_id 	= $this->input->post('pengajuan_id');
				$nama_pemohon	= $this->input->post('nama_pemohon');
				$no_ktp			= $this->input->post('no_ktp');
				$alamat			= $this->input->post('alamat');
				$id_kecamatan	= $this->input->post('id_kecamatan');
				$id_kabkot		= $this->input->post('id_kabkot');
				$id_provinsi	= $this->input->post('id_provinsi');
				$no_hp			= $this->input->post('no_hp');
				$no_tlp			= $this->input->post('no_tlp');
				$status_pemohon = $this->input->post('status_pemohon');
				if($id_pemohon != '' or $id_pemohon != null)
				{
					$dataPemohon = array(
							'pengajuan_id'=>$pengajuan_id,
							'nama_pemohon'=>$nama_pemohon,
							'no_ktp'=>$no_ktp,
							'alamat'=>$alamat,
							'id_provinsi'=>$id_provinsi,
							'id_kabkot'=>$id_kabkot,
							'id_kecamatan'=>$id_kecamatan,
							'no_hp'=>$no_hp,
							'no_tlp'=>$no_tlp,
							'status_pemohon' => '1',
							'post_date'=>date('Y-m-d H:i:s'),
							'post_by'=>$this->session->userdata('Qi_user_name') ? $this->session->userdata('Qi_user_name') : 'System Apps'
					);
					$id_pemohon = $this->mglobals->setData('tm_data_pemohon_simbg',$dataPemohon,'id_pemohon','');
					redirect('permohonan_imb/daftar_permohonan/'.$user_id);
				}	
			}
		}
		$data['contents'] = $this->load->view('pengajuan_imb/input_pemohon_form',$data,TRUE);
		$this->load->view('admin_template',$data);
	}
	
	public function pemohon_edit_form()
	{
		$user_id					= $this->session->userdata('Qi_user_id');
		$pengajuan_id				= $this->uri->segment(3);
		$data['pengajuan_id']		= $pengajuan_id;
		if($pengajuan_id != '' || $pengajuan_id != null){
			$DataPemohon		= $this->mpengajuan->getDataPemohon('a.*,b.nama_provinsi,c.nama_kabkota,d.nama_kecamatan',$pengajuan_id)->row_array();
			if(count($DataPemohon) > 0){
				$data['id_pemohon'] = $DataPemohon['id_pemohon'];
				$data['nama_pemohon'] = $DataPemohon['nama_pemohon'];
				$data['no_ktp'] = $DataPemohon['no_ktp'];
				$data['alamat'] = $DataPemohon['alamat'];
				$data['id_kecamatan'] = $DataPemohon['id_kecamatan'];
				$data['nama_kecamatan'] = $DataPemohon['nama_kecamatan'];
				$data['id_kabkot'] = $DataPemohon['id_kabkot'];
				$data['nama_kabkota'] = $DataPemohon['nama_kabkota'];
				$data['id_provinsi'] = $DataPemohon['id_provinsi'];
				$data['nama_provinsi'] = $DataPemohon['nama_provinsi'];
				$data['no_hp'] = $DataPemohon['no_hp'];
				$data['no_tlp'] = $DataPemohon['no_tlp'];
			}
		}
		$config = array (
					array(
						'field'=>'nama_pemohon',
						'label'=>'Nama Pemohon',
						'rules'=>'trim|required'
					),
					array(
						'field'=>'alamat',
						'label'=>'Alamat',
						'rules'=>'trim|required'
					),
					array(
						'field'=>'no_ktp',
						'label'=>'Nomor KTP',
						'rules'=>'trim|required'
					),
					array(
						'field'=>'id_kecamatan',
						'label'=>'Nama Kecamatan',
						'rules'=>'trim|required'
					),
					array(
						'field'=>'no_hp',
						'label'=>'Nomor Handphone',
						'rules'=>'trim|required'
					),
				);
		if($this->input->post('save')) 
		{
			$this->form_validation->set_rules($config);
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			if($this->form_validation->run() === FALSE) 
			{
				$data['err_msg'] = validation_errors();
			}else{
				$id_pemohon		= $this->input->post('id_pemohon');
				$pengajuan_id 	= $this->input->post('pengajuan_id');
				$nama_pemohon	= $this->input->post('nama_pemohon');
				$no_ktp			= $this->input->post('no_ktp');
				$alamat			= $this->input->post('alamat');
				$id_kecamatan	= $this->input->post('id_kecamatan');
				$id_kabkot		= $this->input->post('id_kabkot');
				$id_provinsi	= $this->input->post('id_provinsi');
				$no_hp			= $this->input->post('no_hp');
				$no_tlp			= $this->input->post('no_tlp');
				$status_pemohon = $this->input->post('status_pemohon');
				if($id_pemohon != '' or $id_pemohon != null)
				{
					$dataPemohon = array(
							'pengajuan_id'=>$pengajuan_id,
							'nama_pemohon'=>$nama_pemohon,
							'no_ktp'=>$no_ktp,
							'alamat'=>$alamat,
							'id_provinsi'=>$id_provinsi,
							'id_kabkot'=>$id_kabkot,
							'id_kecamatan'=>$id_kecamatan,
							'no_hp'=>$no_hp,
							'no_tlp'=>$no_tlp,
							'status_pemohon' => '1',
							'post_date'=>date('Y-m-d H:i:s'),
							'post_by'=>$this->session->userdata('Qi_user_name') ? $this->session->userdata('Qi_user_name') : 'System Apps'
						);
					$this->mpengajuan->update_data_pemohon($dataPemohon,$id_pemohon);
					redirect('permohonan_imb/daftar_permohonan/'.$user_id);
				}	
			}
		}
		$data['contents'] = $this->load->view('pengajuan_imb/pemohon_edit_form',$data,TRUE);
		$this->load->view('admin_template',$data);
	}
	// End Data Pemohon
	//Begin Permohonan
	public function input_permohonan_form()
	{
		$user_id					= $this->session->userdata('Qi_user_id');
		$pengajuan_id				= $this->uri->segment(3);
		$data['pengajuan_id']		= $pengajuan_id;
		
		$tgl_permohonan = date('d-m-Y');
		$queJenisUrusan = $this->mpermohonan->get_jenis_pelayanan_list()->result();
		$list_jenis_urusan[''] = '--Pilih--';
		foreach ($queJenisUrusan as $row) 
		{
			$list_jenis_urusan[$row->id_jenis_permohonan] = $row->nama_permohonan;
		}
		$data['list_jenis_urusan'] = $list_jenis_urusan;
		
		$queFungsi = $this->mpermohonan->get_jenis_fungsi_list()->result();
		$list_fungsi[''] = '--Pilih--';
		foreach ($queFungsi as $row) 
		{
			$list_fungsi[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		$data['list_fungsi'] = $list_fungsi;
		
		if($this->input->post('save')) 
		{
			$id_permohonan	= $this->input->post('id_permohonan');
			$pengajuan_id	= $this->input->post('pengajuan_id');
			$statusaha = trim($this->input->post('statusaha'));
			$nama_pemilik = trim($this->input->post('nama_pemilik'));
			$id_jenis_permohonan = trim($this->input->post('id_jenis_permohonan'));
			$alamat = trim($this->input->post('jalan'));
			$kelurahan = trim($this->input->post('kelurahan'));
			$kecamatan = trim($this->input->post('kecamatan'));
			$id_kec = trim($this->input->post('id_kec'));
			$id_kabkot = trim($this->input->post('id_kabkot'));
			$id_provinsi = trim($this->input->post('id_provinsi'));
			$no_tlpn = trim($this->input->post('no_tlpn'));
			$email = trim($this->input->post('email'));
			$ktp = trim($this->input->post('ktp'));
			$nama_bangunan = trim($this->input->post('nama_bangunan'));
			$jabdpershn = trim($this->input->post('jabdpershn'));
			$nm_pershn = trim($this->input->post('nm_pershn'));
			$alamat_pershn = trim($this->input->post('alamat_pershn'));
			$no_tlpn_pershn = trim($this->input->post('no_tlpn_pershn'));
			$jalan_lokasi = trim($this->input->post('jalan_lokasi'));
			$kel = trim($this->input->post('kel'));
			$kec = trim($this->input->post('kec'));
			$stat = trim($this->input->post('stat'));
			$id_kec_bg = trim($this->input->post('id_kec_bg'));
			$id_kabkot_bg = trim($this->input->post('id_kabkot_bg'));
			$id_provinsi_bg = trim($this->input->post('id_provinsi_bg'));
			$id_kec_badan = trim($this->input->post('id_kec_badan'));
			$id_kabkot_badan = trim($this->input->post('id_kabkot_badan'));
			$id_provinsi_badan = trim($this->input->post('id_provinsi_badan'));
			$luas_basement = trim($this->input->post('luas_basement'));
			$lapis_basement = trim($this->input->post('lapis_basement'));
			$tgl_permohonan = trim($this->input->post('tgl_permohonan'));
			$jns_bangunan= trim($this->input->post('jns_bangunan'));
			$id_jenis_bg = trim($this->input->post('id_jenis_bg'));
			$id_dok_tek = trim($this->input->post('id_dok_tek'));
			if ($id_jenis_bg =='2' || $id_jenis_bg =='3' ||  $id_jenis_bg =='6')
			{
				$id_dok_tek = '1';
				$id_kolektif = '0';
			}else if($id_jenis_bg =='4'){
				$id_dok_tek = '1';
				$id_kolektif = trim($this->input->post('id_kolektif'));
			}else if($id_jenis_bg =='5'){
				$id_dok_tek = '1';
				$id_kolektif = '0';
				$id_pemanfaatan_bg ='0';
			}else if($id_jenis_bg =='1'){
				$id_kolektif = '0';
			}
			$klasifikasi_bg = trim($this->input->post('klasifikasi_bg'));
			$id_pemanfaatan_bg = trim($this->input->post('id_pemanfaatan_bg'));
			$id_prasarana_bg = trim($this->input->post('id_prasarana_bg'));
			$id_fungsi_bg = trim($this->input->post('id_fungsi_bg'));
			$luas_bgn = trim($this->input->post('luas_bgn'));
			$tinggi_bg = trim($this->input->post('tinggi_bg'));
			$lantai = trim($this->input->post('lantai'));
			$tinggi_prasarana = trim($this->input->post('tinggi_prasarana'));
			
			if($id_permohonan == '' or $id_permohonan == null)
			{
				$dataIn = array(
						'id_user'=>$pengajuan_id,
						'nama_pemohon'=>$nama_pemilik,
						'id_jenis_usaha' => $statusaha,
						'id_jenis_permohonan' => $id_jenis_permohonan,
						'id_jenis_bg' => $id_jenis_bg,
						'alamat_pemohon' => $alamat,
						'kelurahan' => $kelurahan,
						'kecamatan' => $kecamatan,
						'id_kecamatan' => $id_kec,
						'id_kabkot' => $id_kabkot,
						'id_provinsi' => $id_provinsi,
						'no_tlp' => $no_tlpn,
						'email' => $email,
						'no_ktp' => $ktp,
						'nama_bangunan' => $nama_bangunan,
						'jabatan_perusahaan' => $jabdpershn,
						'nama_perusahaan' => $nm_pershn,
						'alamat_perusahaan' => $alamat_pershn,
						'no_tlp_perusahaan' => $no_tlpn_pershn,
						'alamat_bg' => $jalan_lokasi,
						//'kelurahan' => $kel,
						'kecamatan' => $kec,
						'luas_basement' => $luas_basement,
						'lapis_basement' => $lapis_basement,
						'id_kec_bg' => $id_kec_bg,
						'id_kabkot_bg' => $id_kabkot_bg,
						'id_provinsi_bg' => $id_provinsi_bg,
						'id_kec_badan' => $id_kec_badan,
						'id_kabkot_badan' => $id_kabkot_badan,
						'id_provinsi_badan' => $id_provinsi_badan,
						'tgl_permohonan' => tgl_ind_to_eng($tgl_permohonan),
						'status' => $stat,
						'id_pemanfaatan_bg' => $id_pemanfaatan_bg,
						'id_fungsi_bg' => $id_fungsi_bg,
						'luas_bg' => $luas_bgn,
						'tinggi_bg' => $tinggi_bg,
						'lantai_bg' => $lantai,
						'id_dok_tek' => $id_dok_tek,
						'id_kolektif' => $id_kolektif,
						'id_klasifikasi_bg' => $klasifikasi_bg,
						'id_prasarana_bg' => $id_prasarana_bg,
						'jns_bangunan' => $jns_bangunan,
						'tinggi_prasarana' => $tinggi_prasarana,
					);
				$id = $this->mpermohonan->insert_permohonan($dataIn);
				redirect('permohonan_imb/edit_permohonan_form/'.$id);
			}
		}
		$data['contents'] = $this->load->view('pengajuan_imb/permohonan_form',$data,TRUE);
		$this->load->view('admin_template',$data);
	}
		
	function edit_permohonan_form()
	{
		$queJenisUrusan = $this->mpermohonan->get_jenis_pelayanan_list()->result();
		$list_jenis_urusan[''] = '--Pilih--';
		foreach ($queJenisUrusan as $row) 
		{
			$list_jenis_urusan[$row->id_jenis_permohonan] = $row->nama_permohonan;
		}
		$data['list_jenis_urusan'] = $list_jenis_urusan;
		
		$queFungsi = $this->mpermohonan->get_jenis_fungsi_list()->result();
		$list_fungsi[''] = '--Pilih--';
		foreach ($queFungsi as $row) 
		{
			$list_fungsi[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		$data['list_fungsi'] = $list_fungsi;
		
		$this->killSession();
		$id = $this->uri->segment(3);
		$key = $this->uri->segment(4);
		$data['key'] = '';
		$data['id_permohonan'] = $id;
		$data['id_jenis_usaha'] = 0;
		$data['id_jenis_permohonan'] = 0;
		$config = array (
						array(
							'field'=>'statusaha',
							'label'=>'Bentuk Kepemilikan',
							'rules'=>'trim'
							),
						);
		$data['no_registrasi'] = "";
		if( ! is_null($id) && (trim($id) != '') && ! $this->input->post('save') && (trim($id) != '0')) {
			$data['head_title'] = 'Edit Permohonan';
			$query = $this->mpermohonan->get_data_permohonan($id);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['statusaha'] = $mydata['id_jenis_usaha'];
				$data['id_jenis_permohonan'] = $mydata['id_jenis_permohonan'];
				$data['id_jenis_bg'] = $mydata['id_jenis_bg'];
				$data['id_user'] = $mydata['id_user'];
				$data['nama_permohonan'] = $mydata['nama_permohonan'];
				$data['no_registrasi'] = $mydata['nomor_registrasi'];
				$data['nib'] = $mydata['nib'];
				$data['kd_izin'] = $mydata['kd_izin'];		
				$data['id_fungsi_bg'] = $mydata['id_fungsi_bg'];
				$data['nama_pemilik'] = $mydata['nama_pemohon'];
				$data['jalan'] = $mydata['alamat_pemohon'];
				$data['kecamatan'] = $mydata['kecamatan'];
				$data['id_kec'] = $mydata['id_kecamatan'];
				$data['nama_kec'] = $mydata['nama_kecamatan'];
				$data['id_kabkot'] = $mydata['id_kabkot'];
				$data['nama_kabkota'] = $mydata['nama_kabkota'];
				$data['id_provinsi'] = $mydata['id_provinsi'];
				$data['nama_provinsi'] = $mydata['nama_provinsi'];
				$data['no_tlpn'] = $mydata['no_tlp'];
				$data['email'] = $mydata['email'];
				$data['ktp'] = $mydata['no_ktp'];
				
				$data['nama_bangunan'] = $mydata['nama_bangunan'];
				$data['npwp_perseroan'] = $mydata['npwp_perseroan'];
				$data['jabdpershn'] = $mydata['jabatan_perusahaan'];
				$data['nama_perusahaan'] = $mydata['nama_perusahaan'];
				$data['alamat_perusahaan'] = $mydata['alamat_perusahaan'];
				$data['no_tlpn_pershn'] = $mydata['no_tlp_perusahaan'];
				$data['alamat_bg'] = $mydata['alamat_bg'];
				$data['kel'] = $mydata['kelurahan'];
				
				$data['kec'] = $mydata['kecamatan'];
				$data['id_kec_bg'] = $mydata['id_kec_bg'];
				$data['nama_kec_bg'] = $mydata['nama_kec_bg'];
				$data['id_kabkot_bg'] = $mydata['id_kabkot_bg'];
				$data['nama_kabkota_bg'] = $mydata['nama_kabkota_bg'];
				$data['id_provinsi_bg'] = $mydata['id_provinsi_bg'];
				$data['nama_provinsi_bg'] = $mydata['nama_provinsi_bg'];
			
				//$data['tgl_permohonan'] = $mydata['tgl_permohonan'];
				$data['stat'] = $mydata['status'];
				$data['id_prasarana_bg'] = $mydata['id_prasarana_bg'];
				$data['klasifikasi_bg'] = $mydata['id_klasifikasi_bg'];
				$data['id_jenis_usaha'] = $mydata['id_jenis_usaha'];
				$data['id_pemanfaatan_bg'] = $mydata['id_pemanfaatan_bg2'];
				$data['id_pemanfaatan_bg2']= $mydata['id_pemanfaatan_bg'];
				$data['luas_basement'] = $mydata['luas_basement'];
				$data['lapis_basement'] = $mydata['lapis_basement'];
				$data['luas_bgn'] = $mydata['luas_bg'];
				$data['tinggi_bg'] = $mydata['tinggi_bg'];
				$data['lantai'] = $mydata['lantai_bg'];
				$data['id_dok_tek'] = $mydata['id_dok_tek'];
				$data['id_kolektif'] = $mydata['id_kolektif'];
				$data['fungsi_bg'] = $mydata['fungsi_bg'];
				$data['jns_bangunan'] = $mydata['jns_bangunan'];
				$data['tinggi_prasarana'] = $mydata['tinggi_prasarana'];
			}
			$data['mpermohonan'] = $this->mpermohonan;
		}else {
			$data['head_title'] = 'Input Permohonan';
		}
		if($this->input->post('save')) {
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() === FALSE) 
			{
				$data['jenis_urusan'] = $this->input->post('jenis_urusan',true);
				$data['statusaha'] = $this->input->post('statusaha',true);
				$data['err_msg'] = validation_errors();
				//echo validation_errors();
			}else 
			{
			$id_user = trim($this->input->post('id_user'));
			$id_jenis_permohonan = trim($this->input->post('id_jenis_permohonan'));
			$statusaha = trim($this->input->post('statusaha'));
			$nib = trim($this->input->post('nib'));
			$alamat = trim($this->input->post('jalan'));
			$nama_pemilik = trim($this->input->post('nama_pemilik'));
						
			$npwp_perseroan = trim($this->input->post('npwp_perseroan'));
			$id_kec = trim($this->input->post('id_kec'));
			$id_kabkot = trim($this->input->post('id_kabkot'));
			$id_provinsi = trim($this->input->post('id_provinsi'));
			$no_tlpn = trim($this->input->post('no_tlpn'));
			$email_user_proses = trim($this->input->post('email_user_proses'));
			$ktp = trim($this->input->post('ktp'));
			$nama_bangunan = trim($this->input->post('nama_bangunan'));
			$kd_izin = trim($this->input->post('kd_izin'));
			$nama_perusahaan = trim($this->input->post('nama_perusahaan'));
			$alamat_perusahaan = trim($this->input->post('alamat_perusahaan'));
			$no_tlpn_pershn = trim($this->input->post('no_tlpn_pershn'));
			$alamat_bg = trim($this->input->post('alamat_bg'));
			$kelurahan = trim($this->input->post('kel'));
			$kec = trim($this->input->post('kec'));
			$email = trim($this->input->post('email'));
			$stat = trim($this->input->post('stat'));
			$id_kec_bg = trim($this->input->post('id_kec_bg'));
			$id_kabkot_bg = trim($this->input->post('id_kabkot_bg'));
			$id_provinsi_bg = trim($this->input->post('id_provinsi_bg'));
			$id_kec_badan = trim($this->input->post('id_kec_badan'));
			$id_kabkot_badan = trim($this->input->post('id_kabkot_badan'));
			$id_provinsi_badan = trim($this->input->post('id_provinsi_badan'));
			$luas_basement = trim($this->input->post('luas_basement'));
			$lapis_basement = trim($this->input->post('lapis_basement'));
			//$tgl_permohonan = trim($this->input->post('tgl_permohonan'));
			$jns_bangunan= trim($this->input->post('jns_bangunan'));
			$id_jenis_bg = trim($this->input->post('id_jenis_bg'));
			$id_dok_tek = trim($this->input->post('id_dok_tek'));
			if ($id_jenis_bg =='2' || $id_jenis_bg =='3' ||  $id_jenis_bg =='6')
			{
				$id_dok_tek = '1';
				$id_kolektif = '0';
			}else if($id_jenis_bg =='4'){
				$id_dok_tek = '1';
				$id_kolektif = trim($this->input->post('id_kolektif'));
			}else if($id_jenis_bg =='5'){
				$id_dok_tek = '1';
				$id_kolektif = '0';
				$id_pemanfaatan_bg ='0';
				
			}else if($id_jenis_bg =='1'){
				$id_kolektif = '0';
			}
			$klasifikasi_bg = trim($this->input->post('klasifikasi_bg'));
			$id_pemanfaatan_bg = trim($this->input->post('id_pemanfaatan_bg'));
			$id_prasarana_bg = trim($this->input->post('id_prasarana_bg'));
			$id_fungsi_bg = trim($this->input->post('id_fungsi_bg'));
			$luas_bgn = trim($this->input->post('luas_bgn'));
			$tinggi_bg = trim($this->input->post('tinggi_bg'));
			$lantai = trim($this->input->post('lantai'));
			$tinggi_prasarana = trim($this->input->post('tinggi_prasarana'));
			$no_registrasi = trim($this->input->post('no_registrasi'));
			if($no_registrasi != '' || $no_registrasi != null)
			{
			$dataIn = array (
						'id_user'=>$id_user,
						'id_jenis_usaha' => $statusaha,
						'nib' => $nib,
						'kd_izin' => $kd_izin,
						'nama_pemohon'=> $nama_pemilik,
						'nama_perusahaan' => $nama_perusahaan,
						'npwp_perseroan' => $npwp_perseroan,
						'alamat_perusahaan' => $alamat_perusahaan,
						'id_kecamatan' => $id_kec,
						'id_kabkot' => $id_kabkot,
						'id_provinsi' => $id_provinsi,
						'email' => $email,
						'alamat_bg' => $alamat_bg,
						'kelurahan' => $kel,
						'id_kec_bg' => $id_kec_bg,
						'id_kabkot_bg' => $id_kabkot_bg,
						'id_provinsi_bg' => $id_provinsi_bg,
						
						'status' => $stat,
						'id_jenis_permohonan' => $id_jenis_permohonan,
						'id_jenis_bg' => $id_jenis_bg,
						'id_pemanfaatan_bg' => $id_pemanfaatan_bg,
						'id_fungsi_bg' => $id_fungsi_bg,
						'luas_bg' => $luas_bgn,
						'tinggi_bg' => $tinggi_bg,
						'lantai_bg' => $lantai,
						'id_dok_tek' => $id_dok_tek,
						'id_kolektif' => $id_kolektif,
						'id_klasifikasi_bg' => $klasifikasi_bg,
						'id_prasarana_bg' => $id_prasarana_bg,
						'jns_bangunan' => $jns_bangunan,
						'nama_bangunan' => $nama_bangunan,
						'tinggi_prasarana' => $tinggi_prasarana,
						'luas_basement' => $luas_basement,
						'lapis_basement' => $lapis_basement,
						'nomor_registrasi' => $no_registrasi,
						'no_tlp' => $no_tlpn
						//'nomor_registrasi' => $no_registrasi
					);
			}else{
					$dataIn = array (
						'id_user'=>$id_user,
						'id_jenis_usaha' => $statusaha,
						'nib' => $nib,
						'kd_izin' => $kd_izin,
						'nama_perusahaan' => $nama_perusahaan,
						'nama_pemohon'=> $nama_pemilik,
						'npwp_perseroan' => $npwp_perseroan,
						'alamat_perusahaan' => $alamat_perusahaan,
						'id_kecamatan' => $id_kec,
						'id_kabkot' => $id_kabkot,
						'id_provinsi' => $id_provinsi,
						'email' => $email,
						'alamat_bg' => $alamat_bg,
						'kelurahan' => $kel,
						'id_kec_bg' => $id_kec_bg,
						'id_kabkot_bg' => $id_kabkot_bg,
						'id_provinsi_bg' => $id_provinsi_bg,
						'status' => $stat,
						'id_jenis_permohonan' => $id_jenis_permohonan,
						'id_jenis_bg' => $id_jenis_bg,
						'id_pemanfaatan_bg' => $id_pemanfaatan_bg,
						'id_fungsi_bg' => $id_fungsi_bg,
						'luas_bg' => $luas_bgn,
						'tinggi_bg' => $tinggi_bg,
						'lantai_bg' => $lantai,
						'id_dok_tek' => $id_dok_tek,
						'id_kolektif' => $id_kolektif,
						'id_klasifikasi_bg' => $klasifikasi_bg,
						'id_prasarana_bg' => $id_prasarana_bg,
						'jns_bangunan' => $jns_bangunan,
						'nama_bangunan' => $nama_bangunan,
						'tinggi_prasarana' => $tinggi_prasarana,
						'luas_basement' => $luas_basement,
						'lapis_basement' => $lapis_basement,
						'no_tlp' => $no_tlpn
						//'nomor_registrasi' => $no_registrasi
					);
				}
				if (is_null($id) || trim($id) == '') {
					// insert new record
					try {
						$id_permohonan = $this->mpermohonan->insert_permohonan($dataIn);
						$this->session->set_flashdata('pesan', 'Data Berhasil Disimpan');
					}
					catch (Exception $e) {
						$this->session->set_flashdata('pesan', 'Data Gagal Disimpan');
					}
				} else {
					try {
						$this->mpermohonan->update_permohonan($dataIn,$id);
						$this->session->set_flashdata('pesan', 'Data Berhasil Diupdate');
					}
					catch (Exception $e) {
						$this->session->set_flashdata('pesan', 'Data Gagal Diupdate');	
					}
				}
				redirect('permohonan_imb/edit_permohonan_form/'.$id);
			}
		}
		$this->template->load('admin_template','pengajuan_imb/permohonan',$data);	
	}
	
	function get_permohonan()
	{
		$queJenisUrusan = $this->mpermohonan->get_jenis_pelayanan_list()->result();
		$list_jenis_urusan[''] = '--Pilih--';
		foreach ($queJenisUrusan as $row) 
		{
			$list_jenis_urusan[$row->id_jenis_permohonan] = $row->nama_permohonan;
		}
		$data['list_jenis_urusan'] = $list_jenis_urusan;
		
		$queFungsi = $this->mpermohonan->get_jenis_fungsi_list()->result();
		$list_fungsi[''] = '--Pilih--';
		foreach ($queFungsi as $row) 
		{
			$list_fungsi[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		$data['list_fungsi'] = $list_fungsi;
		
		$id= $this->uri->segment('3');
		$data['id_permohonan'] = $id;
		$data['no_registrasi'] = "";
		$query = $this->mpermohonan->get_data_permohonan($id);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				//Begin Data Pemohon
				$data['id_user'] = $mydata['id_user'];
				$data['statusaha'] = $mydata['id_jenis_usaha'];
				$data['id_jenis_permohonan'] = $mydata['id_jenis_permohonan'];
				$data['id_jenis_bg'] = $mydata['id_jenis_bg'];
				$data['id_fungsi_bg'] = $mydata['id_fungsi_bg'];
				$data['nama_permohonan'] = $mydata['nama_permohonan'];
				$data['no_registrasi'] = $mydata['nomor_registrasi'];
				$data['nama_pemilik'] = $mydata['nama_pemohon'];
				$data['jalan'] = $mydata['alamat_pemohon'];
				$data['kelurahan'] = $mydata['kelurahan'];
				$data['kecamatan'] = $mydata['kecamatan'];
				$data['id_kec'] = $mydata['id_kecamatan'];
				$data['nama_kec'] = $mydata['nama_kecamatan'];
				$data['id_kabkot'] = $mydata['id_kabkot'];
				$data['nama_kabkota'] = $mydata['nama_kabkota'];
				$data['id_provinsi'] = $mydata['id_provinsi'];
				$data['nama_provinsi'] = $mydata['nama_provinsi'];
				$data['no_tlpn'] = $mydata['no_tlp'];
				$data['email'] = $mydata['email'];
				$data['ktp'] = $mydata['no_ktp'];
				$data['kec'] = $mydata['kecamatan'];
				//End Data Pemohon
				//Begin Badan Usaha luas_bgn
				$data['jabdpershn'] = $mydata['jabatan_perusahaan'];
				$data['nm_pershn'] = $mydata['nama_perusahaan'];
				$data['alamat_pershn'] = $mydata['alamat_perusahaan'];
				$data['no_tlpn_pershn'] = $mydata['no_tlp_perusahaan'];
				//$data['id_kec_badan'] = $mydata['id_kec_badan'];
				//$data['kec_badan'] = $mydata['kec_badan'];
				//$data['id_kabkot_badan'] = $mydata['id_kabkot_badan'];
				//$data['nama_kabkota_badan'] = $mydata['nama_kabkota_badan'];
				//$data['id_provinsi_badan'] = $mydata['id_provinsi_badan'];
				//$data['nama_provinsi_badan'] = $mydata['nama_provinsi_badan'];
				//End Badan Usaha
				//Begin Alamat Bangunan Gedung 
				$data['nama_bangunan'] = $mydata['nama_bangunan'];
				$data['kelurahan'] = $mydata['kelurahan'];
				$data['alamat_bg'] = $mydata['alamat_bg'];
				$data['nama_kec_bg'] = $mydata['nama_kec_bg'];
				$data['id_kec_bg'] = $mydata['id_kec_bg'];
				$data['id_kabkot_bg'] = $mydata['id_kabkot_bg'];
				$data['nama_kabkota_bg'] = $mydata['nama_kabkota_bg'];
				$data['id_provinsi_bg'] = $mydata['id_provinsi_bg'];
				$data['nama_provinsi_bg'] = $mydata['nama_provinsi_bg'];
				//End Alamat Bangunan
				//Begin Data Bangunan
				//$data['tgl_permohonan'] = $mydata['tgl_permohonan'];
				$data['stat'] = $mydata['status'];
				$data['id_pemanfaatan_bg'] = $mydata['id_pemanfaatan_bg2'];
				$data['id_pemanfaatan_bg2']= $mydata['id_pemanfaatan_bg'];
				$data['luas_basement'] = $mydata['luas_basement'];
				$data['lapis_basement'] = $mydata['lapis_basement'];
				$data['luas_bgn'] = $mydata['luas_bg'];
				$data['tinggi_bg'] = $mydata['tinggi_bg'];
				$data['lantai'] = $mydata['lantai_bg'];
				$data['id_dok_tek'] = $mydata['id_dok_tek'];
				$data['id_kolektif'] = $mydata['id_kolektif'];
				$data['tgl_pelaksanaan'] = $mydata['tgl_pelaksanaan'];
				$data['fungsi_bg'] = $mydata['fungsi_bg'];
				$data['jns_bangunan'] = $mydata['jns_bangunan'];
				$data['id_jenis_usaha'] = $mydata['id_jenis_usaha'];
				$data['klasifikasi_bg'] = $mydata['id_klasifikasi_bg'];
				$data['tinggi_prasarana'] = $mydata['tinggi_prasarana'];
				$data['id_prasarana_bg'] = $mydata['id_prasarana_bg'];
			}
		// echo json_encode($data);
		$this->load->view('pengajuan_imb/edit_permohonan_form',$data);
	}
	
	// Begin Data Tanah
	function get_dtailt()
	{
		$queFungsi = $this->mpermohonan->get_dokumen_list()->result();
		$list_dokumen[''] = '--Pilih--';
		foreach ($queFungsi as $row)
		{
			$list_dokumen[$row->id_dokumen] = $row->jenis_dokumen;
		}
		$data['list_dokumen'] = $list_dokumen;
		
		$id= $this->uri->segment('3');
		$data['id_permohonan'] = $id;
		$id_tanah = $this->uri->segment(4);
		$data['id_dtanah'] = $id_tanah;
		if(trim($id_tanah) != '') {
		$query2 = $this->mpermohonan->get_dtail_tanah(null,$id_tanah);
		$mydata2 = $query2->row_array();
		$baris2 = $query2->num_rows();
		if ($baris2 >= 1 ) {
			$data['id_dtanah'] = $mydata2['id_permohonan_detail_tanah'];
			$data['nama_dok'] = $mydata2['nama_dok'];
			$data['id_dokumen'] = $mydata2['id_dokumen'];
			$data['hat'] = $mydata2['hat'];
			$data['no_dok'] = $mydata2['no_dok'];
			$data['tanggal_dok'] = $mydata2['tanggal_dok'];
			$data['tahun_dok'] = $mydata2['tahun_dok'];
			$data['luas_tanah'] = $mydata2['luas_tanah'];
			$data['atas_nama'] = $mydata2['atas_nama_dok'];
			$data['lokasi_tanah'] = $mydata2['lokasi_tanah'];
			$data['id_kec'] = $mydata2['id_kecamatan'];
			$data['nama_kec'] = $mydata2['nama_kecamatan'];
			$data['id_kabkot'] = $mydata2['id_kabkot'];
			$data['nama_kabkota'] = $mydata2['nama_kabkota'];
			$data['id_provinsi'] = $mydata2['id_provinsi'];
			$data['nama_provinsi'] = $mydata2['nama_provinsi'];
			$data['dir_file_edit'] = $mydata2['dir_file'];
			$data['dir_file_edit_hak_atas_tanah'] = $mydata2['dir_file_phat'];
			$data['status_phat'] = $mydata2['status_phat'];
			$data['nama_penerima_kuasa'] = $mydata2['nama_penerima_phat'];
			$data['tanggal_terbit_dok'] = $mydata2['tgl_terbit_phat'];
			$data['no_dok_izin_pemanfaatan'] = $mydata2['no_dokumen_phat'];
			$data['status_verifikasi_tanah'] = $mydata2['status_verifikasi_tanah'];
		}
			$query = $this->mpermohonan->get_dtail_tanah($id,null);
			$data['jumdata'] = $query->num_rows();
			$data['results'] = $query->result_array();
		}else if(trim($id) != ''){
			$query = $this->mpermohonan->get_data_permohonan($id);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ){
				$data['lokasi_tanah'] = $mydata['alamat_bg'];
				$data['kel'] = $mydata['kelurahan'];
				$data['id_kec'] = $mydata['id_kec_bg'];
				$data['nama_kec'] = $mydata['nama_kec_bg'];
				$data['id_kabkot'] = $mydata['id_kabkot_bg'];
				$data['nama_kabkota'] = $mydata['nama_kabkota_bg'];
				$data['id_provinsi'] = $mydata['id_provinsi_bg'];
				$data['nama_provinsi'] = $mydata['nama_provinsi_bg'];
			}
			$query = $this->mpermohonan->get_dtail_tanah($id,null);
			$data['jumdata'] = $query->num_rows();
			$data['results'] = $query->result_array();
		}
		// echo json_encode($data);
		$this->load->view('pengajuan_imb/form_detail_tanah',$data);
	}
	
	function detailt_submit()
	{
		$id= $this->uri->segment('3');
		$data['id_permohonan'] = $id;
		$config = array (
						array(
							'field'=>'statfungsi',
							'label'=>'Bentuk Usaha',
							'rules'=>'trim'
							)
						);
			$file_element_name = 'd_file';
			$file_element_name_phat = 'd_file_phat';
			$lam = $this->input->post('dir_file');
			$lam_phat = $this->input->post('dir_file_hak_atas_tanah');
			$lampiran_phat = $this->input->post('dir_file_edit_hak_atas_tanah');

			$filename = $_FILES['d_file']['name'];
			$filename_phat = $_FILES['d_file_phat']['name'];
			$config_file = array(
				'allowed_types' => 'pdf',
				'upload_path' => realpath('./file/IMB/pengajuan_imb/'.$id.'/data_tanah/'),
				'max_size' => 5120000 * 8,
				'file_name' => $filename,
				'remove_spaces' => FALSE
			);

			$config_file_phat = array(
				'allowed_types' => 'pdf',
				'upload_path' => realpath('./file/IMB/pengajuan_imb/'.$id.'/data_tanah/'),
				'max_size' => 5120000 * 8,
				'file_name' => $filename_phat,
				'remove_spaces' => FALSE
			);
			$this->load->library('upload', $config_file);
		 	// Form submited, check rules
			$this->form_validation->set_rules($config);
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			if($this->form_validation->run() === FALSE) {
				$data['err_msg'] = 'Inputan Tidak Boleh Kosong.<br>File Harus Format .PDF';
				$data['valid'] = 'false';
			}else if ((!$this->upload->do_upload($file_element_name)) && ($lam != '') ){
				$data['err_msg'] = $this->upload->display_errors('','');
			}else{
				$id_dtanah = trim($this->input->post('id_dtanah'));
				$tluas_tanah = trim($this->input->post('tluas_tanah'));
				$tanggal_dok = trim($this->input->post('tanggal_dok'));
				$tahun_dok = trim($this->input->post('tahun_dok'));
				$id_dokumen = trim($this->input->post('id_dokumen'));
				$hat = trim($this->input->post('hat'));
				$no_dok = trim($this->input->post('no_dok'));
				$nama_dok = trim($this->input->post('nama_dok'));
				$luas_tanah = str_replace(',','',$this->input->post('luas_tanah'));
				$atas_nama = trim($this->input->post('atas_nama'));
				$lokasi_tanah = trim($this->input->post('lokasi_tanah'));
				$id_kec = trim($this->input->post('id_kec'));
				$id_kabkot = trim($this->input->post('id_kabkot'));
				$id_provinsi = trim($this->input->post('id_provinsi'));
				$dir_file = trim($this->input->post('dir_file'));
				$dir_file_edit = trim($this->input->post('dir_file_edit'));
				$file_element_name = 'dir_file';
				$no_dok_izin_pemanfaatan = trim($this->input->post('no_dok_izin_pemanfaatan'));
				$tanggal_terbit_dok = trim($this->input->post('tanggal_terbit_dok'));
				$nama_penerima_kuasa = trim($this->input->post('nama_penerima_kuasa'));
				$status_phat = trim($this->input->post('id_status_izin_pemanfaatan'));
			if($lam != ''){
					$file=$this->upload->data();
					$lampiran=$file['file_name'];
			}else{
					$lampiran=$this->input->post('dir_file_edit');
			}

			$dataIn = array (
				 'id_permohonan' =>$id,
				 'tanggal_dok' =>tgl_ind_to_eng($tanggal_dok),
				 'id_dokumen' =>$id_dokumen,
				 'hat' =>$hat,
				 'no_dok' =>$no_dok,
				 'nama_dok' =>$nama_dok,
				 'tahun_dok' =>$tahun_dok,
				 'luas_tanah' =>$luas_tanah,
				 'atas_nama_dok' =>$atas_nama,
				 'lokasi_tanah' =>$lokasi_tanah,
				 'id_kecamatan' =>$id_kec,
				 'id_kabkot' =>$id_kabkot,
				 'id_provinsi' =>$id_provinsi,
				 'dir_file' =>$lampiran,
				 'no_dokumen_phat' =>$no_dok_izin_pemanfaatan,
				 'tgl_terbit_phat' =>tgl_ind_to_eng($tanggal_terbit_dok),
				 'nama_penerima_phat' =>$nama_penerima_kuasa,
				 'status_phat' =>$status_phat,
			);
			if (empty($id_dtanah) || trim($id_dtanah) == '' || $id_dtanah==null || $id_dtanah=='0') {
				try {
						$id_dtanah = $this->mpermohonan->insert_per_dtanah($dataIn);
						if (trim($id_dtanah) != '' || $id_dtanah!=null || $id_dtanah!='0') {
							$this->simpan_file_hak_atas_tanah($id_dtanah,$config_file_phat,$lam_phat,$lampiran_phat,$file_element_name_phat,$filename_phat);
						}
						$this->session->set_flashdata('pesan', 'Data Berhasil Disimpan');
						$data['valid'] = 'true';
				}
				catch (Exception $e) {
						$this->session->set_flashdata('pesan', 'Data Gagal Disimpan');
				}
			}
			else {
				// update data
				try {
					$this->mpermohonan->update_per_dtanah($dataIn,$id_dtanah);
					$this->simpan_file_hak_atas_tanah($id_dtanah,$config_file_phat,$lam_phat,$lampiran_phat,$file_element_name_phat,$filename_phat);
					$this->session->set_flashdata('pesan', 'Data Berhasil Diupdate');
					$data['valid'] = 'true';
				}
				catch (Exception $e) {
					$this->session->set_flashdata('pesan', 'Data Gagal Diupdate');
				}
			}
		}
		echo json_encode($data);
	}
	
	function data_tanah_delete()
	{
		$queFungsi = $this->mpermohonan->get_dokumen_list()->result();
		$list_dokumen[''] = '--Pilih--';
		foreach ($queFungsi as $row) 
		{
			$list_dokumen[$row->id_dokumen] = $row->jenis_dokumen;
		}
		$data['list_dokumen'] = $list_dokumen;
		$id = $this->uri->segment(3);
		$data['id_permohonan'] = $id;
		$id_tanah = $this->uri->segment(4);
		$data['pesan'] = '';
		$data['err_msg'] = '';
		 
		if(trim($id_tanah) != '' && trim($id_tanah) != '') 
		{
			try 
			{
				$this->mpermohonan->delete_data_tanah($id_tanah);
				$data['pesan'] = "Data Berhasil Dihapus";
			} 
			catch(Exception $e) 
			{
				$data['err_msg'] = "Data Gagal Dihapus";
			}
			$query = $this->mpermohonan->get_dtail_tanah($id);
			$data['jumdata'] = $query->num_rows();
			$data['results'] = $query->result_array();
			$this->load->view('pengajuan_imb/form_detail_tanah',$data);
		}
	}
	// End Data Tanah
	function get_syarat()
	{
		$id= $this->uri->segment('3');
		$data['id_permohonan'] = $id;
		$permohonan = $this->mpermohonan->get_permohonan_imb($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$id_jenis_usaha = $permohonan['id_jenis_usaha'];	
		$data['pernyataan'] = $permohonan['pernyataan'];
		
		$query = $this->mpermohonan->get_syarat_list($id_j_per,'1',$id_jenis_usaha);				
		$data['jum_data'] = $query->num_rows();		
		$data['results'] = $query->result();
		$data['pengajuan_imb_model'] = $this->mpermohonan;
		$this->load->view('pengajuan_imb/form_detail_syarat',$data);
	}
	
	function get_syarat_teknis()
	{
		$id= $this->uri->segment('3');
		$data['id_permohonan'] = $id;
		$permohonan = $this->mpermohonan->get_permohonan_imb($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$id_jenis_usaha = $permohonan['id_jenis_usaha'];
		$data['pernyataan'] = $permohonan['pernyataan'];
		$luas_bg = $permohonan['luas_bg'];
		
		$query = $this->mpermohonan->get_syarat_list($id_j_per,'2',$id_jenis_usaha,$luas_bg);				
		$data['jum_data'] = $query->num_rows();		
		$data['results'] = $query->result();
		$data['model_permohonan'] = $this->mpermohonan;
		
		$this->load->view('pengajuan_imb/form_detail_syarat_teknis',$data);
	}
	
	function simpan_upload()
	{
		$id= $this->uri->segment('3');
		$data['id_permohonan'] = $id;
			$file_element_name = 'd_file1';
			$id_syarat = $this->input->post('id_syarat');
			$filename = $id.'-'.trim(time().'.pdf');
			//$filename = trim(time().'-'.($_FILES['d_file1']['name']));
			
			$config_file = array(
				'allowed_types' => 'pdf',
				'upload_path' => realpath('./file/IMB/pengajuan_imb/'.$id.'/data_administrasi/'),
				'max_size' => 5120000 * 8,
				'file_name' => $filename,
				'remove_spaces' => FALSE
			);
			$this->load->library('upload', $config_file);
			if (!$this->upload->do_upload($file_element_name)) {
				$data['err_msg'] = $this->upload->display_errors('','');
			}else{
				$dataIsi = array (
				 'id_permohonan' => $id,
				 'id_persyaratan_detail' => $id_syarat,
				 'dir_file' => $filename
				);
				$this->mpermohonan->insert_syarat($dataIsi);
				$this->session->set_flashdata('pesan', 'Data Berhasil Disimpan');
				$data['valid'] = 'true';
			}
		echo json_encode($data);
	}
	
	function simpan_upload_teknis()
	{
		$id= $this->uri->segment('3');
		$data['id_permohonan'] = $id;
			$file_element_name = 'd_file1';
			$id_syarat = $this->input->post('id_syarat');
			$filename = $id.'-'.trim(time().'.pdf');
			//$filename = trim(time().'-'.($_FILES['d_file1']['name']));
			$config_file = array(
				'allowed_types' => 'pdf',
				'upload_path' => realpath('./file/IMB/pengajuan_imb/'.$id.'/data_teknis/'),
				'max_size' => 5120000 * 8,
				'file_name' => $filename,
				'remove_spaces' => FALSE
			);
			$this->load->library('upload', $config_file);
			if (!$this->upload->do_upload($file_element_name)) {
				$data['err_msg'] = $this->upload->display_errors('','');
			}else{
				$dataIsi = array (
				 'id_permohonan' => $id,
				 'id_persyaratan_detail' => $id_syarat,
				 'dir_file' => $filename
				);
				$this->mpermohonan->insert_syarat($dataIsi);
				$this->session->set_flashdata('pesan', 'Data Berhasil Disimpan');
				$data['valid'] = 'true';
			}
		echo json_encode($data);
	}
	
	function delete_upload()
	{
		$id = $this->uri->segment(3);
		$detail = $this->uri->segment(4);
		$key_syarat = $this->uri->segment('5');
		$data['pesan'] = '';
		$data['err_msg'] = '';
		 
		if(trim($id) != '' && trim($detail) != '') {
			try 
			{
				$this->mpermohonan->upload_delete($id,$detail,$key_syarat);
				$data['pesan'] = "Data Berhasil Dihapus";
			} 
			catch(Exception $e) 
			{
				$data['err_msg'] = "Data Gagal Dihapus";
			}
			$permohonan = $this->mpermohonan->get_permohonan_imb($id)->row_array();
			$id_j_per = $permohonan['id_jenis_permohonan'];
			$id_jenis_usaha = $permohonan['id_jenis_usaha'];
			$data['pernyataan'] = $permohonan['pernyataan'];
			if($key_syarat == 'adm'){
				$query = $this->mpermohonan->get_syarat_list($id_j_per,'1',$id_jenis_usaha);
			}else{
				$query = $this->mpermohonan->get_syarat_list($id_j_per,'2',$id_jenis_usaha);
			}				
			$data['jum_data'] = $query->num_rows();		
			$data['results'] = $query->result();
			$data['model_permohonan'] = $this->mpermohonan;
			if($key_syarat == 'adm'){
				$this->load->view('pengajuan_imb/form_detail_syarat',$data);
			}else if($key_syarat == 'tek'){
				$this->load->view('pengajuan_imb/form_detail_syarat_teknis',$data);
			}
		}
	}
	
	function get_selesai()
	{
		$id= $this->uri->segment('3');
		$data['id_permohonan'] = $id;
		$query = $this->mpermohonan->get_data_permohonan($id)->row_array();
		$data['pernyataan'] = $query['pernyataan'];
		$data['id_permohonan'] = $query['id_permohonan'];
		$this->load->view('pengajuan_imb/form_konfirmasi',$data);
	}
	
	public function input_permohonan_form_oss()
	{
		$user_id					= $this->session->userdata('Qi_user_id');
		$pengajuan_id				= $this->uri->segment(3);
		$data['pengajuan_id']		= $pengajuan_id;
		
		$tgl_permohonan = date('d-m-Y');
		$queJenisUrusan = $this->mpermohonan->get_jenis_pelayanan_list()->result();
		$list_jenis_urusan[''] = '--Pilih--';
		foreach ($queJenisUrusan as $row) 
		{
			$list_jenis_urusan[$row->id_jenis_permohonan] = $row->nama_permohonan;
		}
		$data['list_jenis_urusan'] = $list_jenis_urusan;
		
		$queFungsi = $this->mpermohonan->get_jenis_fungsi_list()->result();
		$list_fungsi[''] = '--Pilih--';
		foreach ($queFungsi as $row) 
		{
			$list_fungsi[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		$data['list_fungsi'] = $list_fungsi;
		
		if($this->input->post('save')) 
		{
			$id_permohonan	= $this->input->post('id_permohonan');
			$pengajuan_id	= $this->input->post('pengajuan_id');
			$statusaha = trim($this->input->post('statusaha'));
			$id_jenis_permohonan = trim($this->input->post('id_jenis_permohonan'));
			$nib = trim($this->input->post('nib'));
			$kd_izin = trim($this->input->post('kd_izin'));
			$kel = trim($this->input->post('kel'));
			$nama_perusahaan = trim($this->input->post('nama_perusahaan'));
			$npwp_perseroan = trim($this->input->post('npwp_perseroan'));
			$alamat_perusahaan = trim($this->input->post('alamat_perusahaan'));
			$id_kec = trim($this->input->post('id_kec'));
			$id_kabkot = trim($this->input->post('id_kabkot'));
			$id_provinsi = trim($this->input->post('id_provinsi'));
			$email_user_proses = trim($this->input->post('email_user_proses'));
			
			$alamat_bg = trim($this->input->post('alamat_bg'));
			$stat = trim($this->input->post('stat'));
			$id_kec_bg = trim($this->input->post('id_kec_bg'));
			$id_kabkot_bg = trim($this->input->post('id_kabkot_bg'));
			$id_provinsi_bg = trim($this->input->post('id_provinsi_bg'));
			
			$luas_basement = trim($this->input->post('luas_basement'));
			$lapis_basement = trim($this->input->post('lapis_basement'));
			$jns_bangunan= trim($this->input->post('jns_bangunan'));
			$nama_bangunan = trim($this->input->post('nama_bangunan'));
			$id_jenis_bg = trim($this->input->post('id_jenis_bg'));
			$id_dok_tek = trim($this->input->post('id_dok_tek'));
			if ($id_jenis_bg =='2' || $id_jenis_bg =='3' ||  $id_jenis_bg =='6')
			{
				$id_dok_tek = '1';
				$id_kolektif = '0';
			}else if($id_jenis_bg =='4'){
				$id_dok_tek = '1';
				$id_kolektif = trim($this->input->post('id_kolektif'));
			}else if($id_jenis_bg =='5'){
				$id_dok_tek = '1';
				$id_kolektif = '0';
				$id_pemanfaatan_bg ='0';
			}else if($id_jenis_bg =='1'){
				$id_kolektif = '0';
			}
			$klasifikasi_bg = trim($this->input->post('klasifikasi_bg'));
			$id_pemanfaatan_bg = trim($this->input->post('id_pemanfaatan_bg'));
			$id_prasarana_bg = trim($this->input->post('id_prasarana_bg'));
			$id_fungsi_bg = trim($this->input->post('id_fungsi_bg'));
			$luas_bgn = trim($this->input->post('luas_bgn'));
			$tinggi_bg = trim($this->input->post('tinggi_bg'));
			$lantai = trim($this->input->post('lantai'));
			$tinggi_prasarana = trim($this->input->post('tinggi_prasarana'));
			
			if($id_permohonan == '' or $id_permohonan == null)
			{
				$dataIn = array(
						'id_user'=>$pengajuan_id,
						'id_jenis_usaha' => $statusaha,
						'nib' => $nib,
						'kd_izin' => $kd_izin,
						'nama_perusahaan' => $nama_perusahaan,
						'npwp_perseroan' => $npwp_perseroan,
						'alamat_perusahaan' => $alamat_perusahaan,
						'id_kecamatan' => $id_kec,
						'id_kabkot' => $id_kabkot,
						'id_provinsi' => $id_provinsi,
						'email' => $email_user_proses,
						
						'alamat_bg' => $alamat_bg,
						'kelurahan' => $kel,
						'id_kec_bg' => $id_kec_bg,
						'id_kabkot_bg' => $id_kabkot_bg,
						'id_provinsi_bg' => $id_provinsi_bg,
						
						'status' => $stat,
						'id_jenis_permohonan' => $id_jenis_permohonan,
						'id_jenis_bg' => $id_jenis_bg,
						'id_pemanfaatan_bg' => $id_pemanfaatan_bg,
						'id_fungsi_bg' => $id_fungsi_bg,
						'luas_bg' => $luas_bgn,
						'tinggi_bg' => $tinggi_bg,
						'lantai_bg' => $lantai,
						'id_dok_tek' => $id_dok_tek,
						'id_kolektif' => $id_kolektif,
						'id_klasifikasi_bg' => $klasifikasi_bg,
						'id_prasarana_bg' => $id_prasarana_bg,
						'jns_bangunan' => $jns_bangunan,
						'nama_bangunan' => $nama_bangunan,
						'tinggi_prasarana' => $tinggi_prasarana,
						'luas_basement' => $luas_basement,
						'lapis_basement' => $lapis_basement,
						//'nomor_registrasi' => $no_registrasi
						//'post_date'=>date('Y-m-d H:i:s'),
						);
				$id = $this->mpermohonan->insert_permohonan($dataIn);
				redirect('Imb_oss/edit_permohonan_form/'.$id);
			}
		}
		$data['contents'] = $this->load->view('pengajuan_imb/permohonan_form',$data,TRUE);
		$this->load->view('admin_template',$data);
	}
	function konfirmasi_submit()
	{
		$id= $this->uri->segment('3');
		$tgl_skrg = date('Y-m-d');
		$setuju = trim($this->input->post('setuju'));
		$nomor_registrasi = $this->nomor_registrasi($id);
		$dataIn = array (
			 'pernyataan' =>$setuju,
			 'nomor_registrasi' =>$nomor_registrasi,
			 'tgl_permohonan' => $tgl_skrg
		);
		$this->mpermohonan->update_permohonan($dataIn,$id);
		if (trim($id) != '') {
			$tgl_log = date('d-m-Y');
			$data_log = array (
					'id_permohonan' => $id,
					'tgl_log_permohonan' => tgl_ind_to_eng($tgl_log),
					'keterangan' => 'Pemohon Menyatakan Data yang di isi BENAR dan siap untuk di Verifikasi',
					'kode_proses' => 2
				);
				$this->mpermohonan->insert_log_permohonan($data_log);
			}
			$this->session->set_flashdata('pesan', 'Data Berhasil Diupdate');
			$data['valid'] = 'true';
		echo json_encode($data);
	}
	
	function nomor_registrasi($id=null)
	{
		$que = $this->mpermohonan->get_id_kabkot($id);
		$id_skrg = $que['id_kabkot_bg'];
		$no_reg_awal = $que['id_kec_bg'];
		$tgl_disetujui = date('d').date('m').date('Y');;
		$mydata2 = $this->mpermohonan->get_nomor_registrasi($id_skrg,$tgl_disetujui);
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
	
	function edit_permohonan_form_oss()
	{
		$queJenisUrusan = $this->mpermohonan->get_jenis_pelayanan_list()->result();
		$list_jenis_urusan[''] = '--Pilih--';
		foreach ($queJenisUrusan as $row) 
		{
			$list_jenis_urusan[$row->id_jenis_permohonan] = $row->nama_permohonan;
		}
		$data['list_jenis_urusan'] = $list_jenis_urusan;
		
		$queFungsi = $this->mpermohonan->get_jenis_fungsi_list()->result();
		$list_fungsi[''] = '--Pilih--';
		foreach ($queFungsi as $row) 
		{
			$list_fungsi[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		$data['list_fungsi'] = $list_fungsi;
		
		$this->killSession();
		$id = $this->uri->segment(3);
		$key = $this->uri->segment(4);
		$data['key'] = '';
		$data['id_permohonan'] = $id;
		$data['id_jenis_usaha'] = 0;
		$data['id_jenis_permohonan'] = 0;
		$config = array (
						array(
							'field'=>'statusaha',
							'label'=>'Bentuk Kepemilikan',
							'rules'=>'trim'
							),
						);
		$data['no_registrasi'] = "";
		if( ! is_null($id) && (trim($id) != '') && ! $this->input->post('save') && (trim($id) != '0')) {
			$data['head_title'] = 'Edit Permohonan';
			$query = $this->mpermohonan->get_permohonan_nib(null,null,null,null,$id);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['statusaha'] = $mydata['id_jenis_usaha'];
				$data['id_jenis_permohonan'] = $mydata['id_jenis_permohonan'];
				$data['id_jenis_bg'] = $mydata['id_jenis_bg'];
				$data['id_user'] = $mydata['id_user'];
				$data['nama_permohonan'] = $mydata['nama_permohonan'];
				$data['no_registrasi'] = $mydata['nomor_registrasi'];
				$data['nib'] = $mydata['nib'];
				$data['kd_izin'] = $mydata['kd_izin'];
				
				$data['id_fungsi_bg'] = $mydata['id_fungsi_bg'];
				$data['nama_pemohon'] = $mydata['nama_pemohon'];
				$data['jalan'] = $mydata['alamat_pemohon'];
				//$data['kelurahan'] = $mydata['kelurahan'];
				$data['kecamatan'] = $mydata['kecamatan'];
				$data['id_kec'] = $mydata['id_kecamatan'];
				$data['nama_kec'] = $mydata['nama_kecamatan'];
				$data['id_kabkot'] = $mydata['id_kabkot'];
				$data['nama_kabkota'] = $mydata['nama_kabkota'];
				$data['id_provinsi'] = $mydata['id_provinsi'];
				$data['nama_provinsi'] = $mydata['nama_provinsi'];
				$data['no_tlpn'] = $mydata['no_tlp'];
				$data['email_user_proses'] = $mydata['email'];
				$data['ktp'] = $mydata['no_ktp'];
				$data['nama_bangunan'] = $mydata['nama_bangunan'];
				$data['npwp_perseroan'] = $mydata['npwp_perseroan'];
				$data['jabdpershn'] = $mydata['jabatan_perusahaan'];
				$data['nama_perusahaan'] = $mydata['nama_perusahaan'];
				$data['alamat_perusahaan'] = $mydata['alamat_perusahaan'];
				$data['no_tlpn_pershn'] = $mydata['no_tlp_perusahaan'];
				$data['jalan_lokasi'] = $mydata['alamat_bg'];
				$data['kel'] = $mydata['kelurahan'];
				
				$data['kec'] = $mydata['kecamatan'];
				$data['id_kec_bg'] = $mydata['id_kec_bg'];
				$data['nama_kec_bg'] = $mydata['nama_kec_bg'];
				$data['id_kabkot_bg'] = $mydata['id_kabkot_bg'];
				$data['nama_kabkota_bg'] = $mydata['nama_kabkota_bg'];
				$data['id_provinsi_bg'] = $mydata['id_provinsi_bg'];
				$data['nama_provinsi_bg'] = $mydata['nama_provinsi_bg'];
			
				$data['tgl_permohonan'] = $mydata['tgl_permohonan'];
				$data['stat'] = $mydata['status'];
				$data['id_prasarana_bg'] = $mydata['id_prasarana_bg'];
				$data['klasifikasi_bg'] = $mydata['id_klasifikasi_bg'];
				$data['id_jenis_usaha'] = $mydata['id_jenis_usaha'];
				$data['id_pemanfaatan_bg'] = $mydata['id_pemanfaatan_bg2'];
				$data['id_pemanfaatan_bg2']= $mydata['id_pemanfaatan_bg'];
				$data['luas_basement'] = $mydata['luas_basement'];
				$data['lapis_basement'] = $mydata['lapis_basement'];
				$data['luas_bgn'] = $mydata['luas_bg'];
				$data['tinggi_bg'] = $mydata['tinggi_bg'];
				$data['lantai'] = $mydata['lantai_bg'];
				$data['id_dok_tek'] = $mydata['id_dok_tek'];
				$data['id_kolektif'] = $mydata['id_kolektif'];
				$data['fungsi_bg'] = $mydata['fungsi_bg'];
				$data['jns_bangunan'] = $mydata['jns_bangunan'];
				$data['tinggi_prasarana'] = $mydata['tinggi_prasarana'];
				
			}
			$data['mpermohonan'] = $this->mpermohonan;
		}else {
			$data['head_title'] = 'Input Permohonan';
		}
		if($this->input->post('save')) {
			$this->form_validation->set_rules($config);
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			$this->form_validation->set_message('numeric', '%s harus berisi angka.');
			$this->form_validation->set_message('min_length', 'Jumlah digit %s kurang.');
			$this->form_validation->set_message('valid_email', '%s tidak valid. exp : foo@hostname.com');
			
			if($this->form_validation->run() === FALSE) 
			{
				$data['jenis_urusan'] = $this->input->post('jenis_urusan',true);
				$data['statusaha'] = $this->input->post('statusaha',true);
				$data['err_msg'] = validation_errors();
				//echo validation_errors();
			}else 
			{
			$id_user = trim($this->input->post('id_user'));
			$id_jenis_permohonan = trim($this->input->post('id_jenis_permohonan'));
			$statusaha = trim($this->input->post('statusaha'));
			$nib = trim($this->input->post('nib'));
			$alamat = trim($this->input->post('jalan'));
			$npwp_perseroan = trim($this->input->post('npwp_perseroan'));
			$id_kec = trim($this->input->post('id_kec'));
			$id_kabkot = trim($this->input->post('id_kabkot'));
			$id_provinsi = trim($this->input->post('id_provinsi'));
			$no_tlpn = trim($this->input->post('no_tlpn'));
			$email_user_proses = trim($this->input->post('email_user_proses'));
			$ktp = trim($this->input->post('ktp'));
			$nama_bangunan = trim($this->input->post('nama_bangunan'));
			$kd_izin = trim($this->input->post('kd_izin'));
			$nama_perusahaan = trim($this->input->post('nama_perusahaan'));
			$alamat_perusahaan = trim($this->input->post('alamat_perusahaan'));
			$no_tlpn_pershn = trim($this->input->post('no_tlpn_pershn'));
			$alamat_bg = trim($this->input->post('alamat_bg'));
			$kelurahan = trim($this->input->post('kelurahan'));
			$kec = trim($this->input->post('kec'));
			$stat = trim($this->input->post('stat'));
			$id_kec_bg = trim($this->input->post('id_kec_bg'));
			$id_kabkot_bg = trim($this->input->post('id_kabkot_bg'));
			$id_provinsi_bg = trim($this->input->post('id_provinsi_bg'));
			$id_kec_badan = trim($this->input->post('id_kec_badan'));
			$id_kabkot_badan = trim($this->input->post('id_kabkot_badan'));
			$id_provinsi_badan = trim($this->input->post('id_provinsi_badan'));
			$luas_basement = trim($this->input->post('luas_basement'));
			$lapis_basement = trim($this->input->post('lapis_basement'));
			$tgl_permohonan = trim($this->input->post('tgl_permohonan'));
			$jns_bangunan= trim($this->input->post('jns_bangunan'));
			$id_jenis_bg = trim($this->input->post('id_jenis_bg'));
			$id_dok_tek = trim($this->input->post('id_dok_tek'));
			if ($id_jenis_bg =='2' || $id_jenis_bg =='3' ||  $id_jenis_bg =='6')
			{
				$id_dok_tek = '1';
				$id_kolektif = '0';
			}else if($id_jenis_bg =='4'){
				$id_dok_tek = '1';
				$id_kolektif = trim($this->input->post('id_kolektif'));
			}else if($id_jenis_bg =='5'){
				$id_dok_tek = '1';
				$id_kolektif = '0';
				$id_pemanfaatan_bg ='0';
				
			}else if($id_jenis_bg =='1'){
				$id_kolektif = '0';
			}
			$klasifikasi_bg = trim($this->input->post('klasifikasi_bg'));
			$id_pemanfaatan_bg = trim($this->input->post('id_pemanfaatan_bg'));
			$id_prasarana_bg = trim($this->input->post('id_prasarana_bg'));
			$id_fungsi_bg = trim($this->input->post('id_fungsi_bg'));
			$luas_bgn = trim($this->input->post('luas_bgn'));
			$tinggi_bg = trim($this->input->post('tinggi_bg'));
			$lantai = trim($this->input->post('lantai'));
			$tinggi_prasarana = trim($this->input->post('tinggi_prasarana'));
			//$no_registrasi = trim($this->input->post('no_registrasi'));
			if($no_registrasi != '' || $no_registrasi != null)
			{
			$dataIn = array (
						'id_user'=>$id_user,
						'id_jenis_usaha' => $statusaha,
						'nib' => $nib,
						'kd_izin' => $kd_izin,
						'nama_perusahaan' => $nama_perusahaan,
						'npwp_perseroan' => $npwp_perseroan,
						'alamat_perusahaan' => $alamat_perusahaan,
						'id_kecamatan' => $id_kec,
						'id_kabkot' => $id_kabkot,
						'id_provinsi' => $id_provinsi,
						'email' => $email_user_proses,
						'alamat_bg' => $alamat_bg,
						'kelurahan' => $kelurahan,
						'id_kec_bg' => $id_kec_bg,
						'id_kabkot_bg' => $id_kabkot_bg,
						'id_provinsi_bg' => $id_provinsi_bg,
						
						'status' => $stat,
						'id_jenis_permohonan' => $id_jenis_permohonan,
						'id_jenis_bg' => $id_jenis_bg,
						'id_pemanfaatan_bg' => $id_pemanfaatan_bg,
						'id_fungsi_bg' => $id_fungsi_bg,
						'luas_bg' => $luas_bgn,
						'tinggi_bg' => $tinggi_bg,
						'lantai_bg' => $lantai,
						'id_dok_tek' => $id_dok_tek,
						'id_kolektif' => $id_kolektif,
						'id_klasifikasi_bg' => $klasifikasi_bg,
						'id_prasarana_bg' => $id_prasarana_bg,
						'jns_bangunan' => $jns_bangunan,
						'nama_bangunan' => $nama_bangunan,
						'tinggi_prasarana' => $tinggi_prasarana,
						'luas_basement' => $luas_basement,
						'lapis_basement' => $lapis_basement,
						//'nomor_registrasi' => $no_registrasi
						//'nomor_registrasi' => $no_registrasi
					);
			}else{
					$dataIn = array (
						'id_user'=>$id_user,
						'id_jenis_usaha' => $statusaha,
						'nib' => $nib,
						'kd_izin' => $kd_izin,
						'nama_perusahaan' => $nama_perusahaan,
						'npwp_perseroan' => $npwp_perseroan,
						'alamat_perusahaan' => $alamat_perusahaan,
						'id_kecamatan' => $id_kec,
						'id_kabkot' => $id_kabkot,
						'id_provinsi' => $id_provinsi,
						'email' => $email_user_proses,
						'alamat_bg' => $alamat_bg,
						'kelurahan' => $kelurahan,
						'id_kec_bg' => $id_kec_bg,
						'id_kabkot_bg' => $id_kabkot_bg,
						'id_provinsi_bg' => $id_provinsi_bg,
						
						'status' => $stat,
						'id_jenis_permohonan' => $id_jenis_permohonan,
						'id_jenis_bg' => $id_jenis_bg,
						'id_pemanfaatan_bg' => $id_pemanfaatan_bg,
						'id_fungsi_bg' => $id_fungsi_bg,
						'luas_bg' => $luas_bgn,
						'tinggi_bg' => $tinggi_bg,
						'lantai_bg' => $lantai,
						'id_dok_tek' => $id_dok_tek,
						'id_kolektif' => $id_kolektif,
						'id_klasifikasi_bg' => $klasifikasi_bg,
						'id_prasarana_bg' => $id_prasarana_bg,
						'jns_bangunan' => $jns_bangunan,
						'nama_bangunan' => $nama_bangunan,
						'tinggi_prasarana' => $tinggi_prasarana,
						'luas_basement' => $luas_basement,
						'lapis_basement' => $lapis_basement,
						//'nomor_registrasi' => $no_registrasi
					);
				}
				if (is_null($id) || trim($id) == '') {
					// insert new record
					try {
						$id_permohonan = $this->mpermohonan->insert_permohonan($dataIn);
						$this->session->set_flashdata('pesan', 'Data Berhasil Disimpan');
					}
					catch (Exception $e) {
						$this->session->set_flashdata('pesan', 'Data Gagal Disimpan');
					}
				} else {
					try {
						$this->mpermohonan->update_permohonan($dataIn,$id);
						$this->session->set_flashdata('pesan', 'Data Berhasil Diupdate');
					}
					catch (Exception $e) {
						$this->session->set_flashdata('pesan', 'Data Gagal Diupdate');	
					}
				}
				redirect('imb_oss/edit_permohonan_form/'.$id);
			}
		}
		$this->template->load('admin_template','pengajuan_imb/OSS/permohonan',$data);	
	}
	
	function simpan_file_hak_atas_tanah($id_dtanah,$config_file_phat,$lam_phat,$lampiran_phat,$file_element_name_phat,$filename_phat){
		
		$this->load->library('upload', $config_file_phat);
		
		if($lam_phat != ''){
			//$file=$this->upload->data();
			$lampiran=$filename_phat;
		}else{
			$lampiran=$lampiran_phat;
			
		}
		
		if ((!$this->upload->do_upload($file_element_name_phat)) && ($lam_phat != '') ){
				$data['err_msg'] = $this->upload->display_errors('','');
		}else {
			$dataIn = array (
				'dir_file_phat' =>$lampiran
			);
			
			
			try {
				$this->mpermohonan->update_per_dtanah($dataIn,$id_dtanah);
				$this->session->set_flashdata('pesan', 'Data Berhasil Diupdate');
				$data['valid'] = 'true';
			}
			catch (Exception $e) {
				$this->session->set_flashdata('pesan', 'Data Gagal Diupdate');
			}
		}
	}
	
	function penyerahan_submit()
	{
		
	}
}

