<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		ini_set('memory_limit', "4096M");
		$this->load->model('mglobal');
		$this->load->model('mdashboard');
		$this->load->library('simbg_lib');
		$this->simbg_lib->check_session_login();
	}
	public function index()
	{
		if ($this->session->userdata('loc_role_id') != 0) {
			$tahun = date('Y');
			if ($this->session->userdata('loc_role_id') == 1) { //Dashboard Untuk Super Admin
				$content =  $this->DashboardSuperAdmin(); 
			} else if ($this->session->userdata('loc_role_id') == 2){ // Dashboard untuk  Pemerintah Pusat
				$content =  $this->dashboardEksekutif(); 
			} else if ($this->session->userdata('loc_role_id') == 3){ // Dashboard untuk Sekretariat PUPR Pusat
				$content = $this->dashboardEksekutif();
			} else if ($this->session->userdata('loc_role_id') == 4){ // Dashboard Dinas Balai Provinsi Jika sudah ada
				$content =  $this->dashboardBalai();
			} else if ($this->session->userdata('loc_role_id') == 5){ //Dashboard Kepala Dinas Perizinan
				$content = $this->DashboardDinasPerizinan();
			} else if ($this->session->userdata('loc_role_id') == 6){ //Dashboard Kepala Dinas Teknis 
				$content = $this->DashboardKadisTek();
			} else if ($this->session->userdata('loc_role_id') == 7){ // Dashboard Pengawas Dinas Perizinan
				$content = $this->DashboardDinasPerizinan();
			} else if ($this->session->userdata('loc_role_id') == 8){ // Dashboard untuk Pengawas Dinas Teknis Kab/Kota
				$content = $this->DashboardDinasTeknis();
			} else if ($this->session->userdata('loc_role_id') == 9){ //Dashboard Operator Dinas Perizinan
				$content = $this->DashboardDinasPerizinan();
			} else if ($this->session->userdata('loc_role_id') == 10){ // Dashboard untuk Pemohon
				redirect('Konsultasi');
			} else if ($this->session->userdata('loc_role_id') == 11){ // Dashboard Untuk Operator Dinas Teknis
				$content = $this->DashboardOpDinasTeknis();
			} else if($this->session->userdata('loc_role_id') == 12){ // Dashboard Operator Pusat PUPR
				$content = $this->DashboardSuperAdmin();
			} else if ($this->session->userdata('loc_role_id') == 13){ // Dashboard TPT/Penilik
				$content = $this->DashboardTPT();
			} else if ($this->session->userdata('loc_role_id') == 14){ //Dashboard Aso/Akademisi Profesi
				$content = $this->dashboardAS();
			} else if ($this->session->userdata('loc_role_id') == 17){ // Dashboard Calon TPA/TPA
				$content = $this->dashboardTPA();
			} else if ($this->session->userdata('loc_role_id') == 18){ //Dashboard Pimpinan
				$content = $this->dashboardPimpinan();
			} else if ($this->session->userdata('loc_role_id') == 19){
				$content = $this->DashboardSuperAdmin();
			} else if($this->session->userdata('loc_role_id') == 26){
				redirect('KonsultasiOSS');
			}else {
				$content =  $this->dashboardDinas(); //Role lain belum ditentukan sementara kosong
			}
			$title		=	'Dashboard';
			$heading	=	'Report & Statistic';
			$data = array(
				'contenheader' =>  '<h1>Dashboard</h1>',
				'tahun' => $tahun,
				'content' => $content,
				'title' => $title,
				'heading' => $heading,
			);
			$this->load->view('Dbai', $data);
		} else {
			redirect('front/logout');
		}
	}
	//Begin Dashboard Akun SuperAdmin/Pengembangan
	protected function DashboardSuperAdmin()
	{
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$pbg_rekap = $this->mdashboard->GetJmlPbgDinas($id_kabkot);
		$data['pbg_rekap'] = $pbg_rekap;
		$slf_rekap = $this->mdashboard->GetJmlSLFDinas($id_kabkot);
		$data['slf_rekap'] = $slf_rekap;
		$SQLcari = "";
		$query = $this->mdashboard->get_rekapIMB($SQLcari);
		$querySLF = $this->mdashboard->get_rekapSLF($SQLcari);
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['jum_dataSLF'] = $querySLF->num_rows();	
		$data['resultSLF'] = $querySLF->result();
		$data['daftar_kecamatan']	= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $id_kabkot);
		
		$content 			= $this->load->view('DashboardSuperAdmin', $data, TRUE);
		return $content;
	}

	protected function dashboardDinas()
	{
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$pbg_rekap = $this->mdashboard->GetJmlPbgDinas($id_kabkot);
		$data['pbg_rekap'] = $pbg_rekap;
		$slf_rekap = $this->mdashboard->GetJmlSLFDinas($id_kabkot);
		$data['slf_rekap'] = $slf_rekap;
		$SQLcari = "";
		$query = $this->mdashboard->get_rekapIMB($SQLcari);
		$querySLF = $this->mdashboard->get_rekapSLF($SQLcari);
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['jum_dataSLF'] = $querySLF->num_rows();	
		$data['resultSLF'] = $querySLF->result();
		$data['daftar_kecamatan']	= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $id_kabkot);
		$content 		= $this->load->view('dashboardOpt', $data, TRUE);
		return $content;
	}
	protected function DashboardDinasTeknis()
	{
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$pbg_rekap = $this->mdashboard->GetJmlPbgDinas($id_kabkot);
		$data['pbg_rekap'] = $pbg_rekap;
		$slf_rekap = $this->mdashboard->GetJmlSLFDinas($id_kabkot);
		$data['slf_rekap'] = $slf_rekap;
		$content 		= $this->load->view('DashboardDinasTeknis', $data, TRUE);
		return $content;
	}
	protected function DashboardOpDinasTeknis()
	{
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$pbg_rekap = $this->mdashboard->GetJmlPbgDinas($id_kabkot);
		$data['pbg_rekap'] = $pbg_rekap;
		$slf_rekap = $this->mdashboard->GetJmlSLFDinas($id_kabkot);
		$data['slf_rekap'] = $slf_rekap;
		$content 		= $this->load->view('DashboardOptDinasTeknis', $data, TRUE);
		return $content;
	}

	protected function dashboardPemohon()
	{
		$user_id	= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$profile_user = $this->mdashboard->getDataUserPemohon('a.*,b.*', $user_id);
		$filterQuery = 'a.*,b.*';
		$DataPemohon = $this->mdashboard->getDataUserPemohon($filterQuery, $user_id);
		$jum_imb 	= $this->mdashboard->getJumIMB($user_id);
		$jum_slf	= $this->mdashboard->getJumSLF($user_id);
		$data = array(
			'profile_user' => $profile_user,
			'DataPemohon' => $DataPemohon,
			'jum_imb' => $jum_imb,
			'jum_slf' => $jum_slf,
		);
		$content = $this->load->view('dashboard_pemohon', $data, TRUE);
		return $content;
	}
	protected function dashboardTPA()
	{
		$user_id	  = $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$datatpa = $this->mdashboard->getDataTpa('a.*,b.*,d.nm_asosiasi', $user_id);
		$id_tpa = $datatpa->id;
		$dataproyek = $this->mdashboard->getDataProyek('a.*,b.nm_pemilik,c.no_konsultasi,c.status,d.nm_konsultasi', $id_tpa);
		$dataLokasi = $this->mdashboard->getDataLokasi('*', $id_tpa);
		$Verifkasi = $this->mdashboard->getDataVerifikasi('*', $id_tpa);
		$t_tpa = '-'; //belum
		$berjalan     = '-'; //belum
		$selesai      = '-'; //belum
		$data = array(
			'datatpa' => $datatpa,
			'dataproyek' => $dataproyek,
			'dataLokasi' => $dataLokasi,
			'Verifkasi' => $Verifkasi,
			'berjalan'     => $berjalan,
			'selesai'      => $selesai,
		);
		$content = $this->load->view('dashboard_tpa', $data, TRUE);
		return $content;
	}
	//Begin Dashboard Operator PUPR Pusat
	protected function DashboardOptPusat()
	{
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$pbg_rekap = $this->mdashboard->GetJmlPbgDinas($id_kabkot);
		$data['pbg_rekap'] = $pbg_rekap;
		$slf_rekap = $this->mdashboard->GetJmlSLFDinas($id_kabkot);
		$data['slf_rekap'] = $slf_rekap;
		$SQLcari = "";
		$query = $this->mdashboard->get_rekapIMB($SQLcari);
		$querySLF = $this->mdashboard->get_rekapSLF($SQLcari);
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['jum_dataSLF'] = $querySLF->num_rows();	
		$data['resultSLF'] = $querySLF->result();
		$data['daftar_kecamatan']	= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $id_kabkot);
		
		$content 			= $this->load->view('DashboardSuperAdmin', $data, TRUE);
		return $content;
	}
	//End Dashboard Operator PUPR Pusat

	protected function dashboardEksekutif()
	{
		$data['j_Pengguna']  = '';//Belom
		$data['j_PBGterbit'] = '';//Belom
		$data['j_PBGtolak']  = '';//Belom			
		$data['j_Retribusi'] = '';//Belom
		$data['notifikasi']  = '';//Belom
		$content 		= $this->load->view('DashboardEksekutif', $data, TRUE);
		return $content;
	}
	protected function dashboardPimpinan()
	{
		$pbg_rekap = $this->mdashboard->GetJmlPbg();
		$data['pbg_rekap'] = $pbg_rekap;
		$slf_rekap = $this->mdashboard->GetJmlSLF();
		$data['slf_rekap'] = $slf_rekap;
		$tpa_rekap = $this->mdashboard->GetJumlahTpaTot();
		$data['tpa_rekap'] = $tpa_rekap;
		$content 		= $this->load->view('DashboardPimpinan', $data, TRUE);
		return $content;
	}
	protected function DashboardDinasPerizinan()
	{
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$pbg_rekap = $this->mdashboard->GetJmlPbgDinas($id_kabkot);
		$data['pbg_rekap'] = $pbg_rekap;
		$slf_rekap = $this->mdashboard->GetJmlSLFDinas($id_kabkot);
		$data['slf_rekap'] = $slf_rekap;
		$content 		= $this->load->view('DashboardDinasPerizinan', $data, TRUE);
		return $content;
	}

	
	protected function dashboardDinasPusat()
	{
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$pbg_rekap = $this->mdashboard->GetJmlPbgDinas($id_kabkot);
		$data['pbg_rekap'] = $pbg_rekap;
		$slf_rekap = $this->mdashboard->GetJmlSLFDinas($id_kabkot);
		$data['slf_rekap'] = $slf_rekap;
		$query = $this->mdashboard->getDataRekapKec($id_kabkot);
		$data['jum_data'] = $query->num_rows();	
		$data['results'] = $query->result();
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$content 		= $this->load->view('DashboardPusat', $data, TRUE);
		return $content;
	}

	protected function dashboardOpt()
	{
		//$user_id	= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$kabkot = $this->session->userdata('loc_id_kabkot');
		$data['j_Pengguna']  = '';//Belom
		$data['j_PBGterbit'] = '';//Belom
		$data['j_PBGtolak']  = '';//Belom			
		$data['j_Retribusi'] = '';//Belom
		$data['notifikasi']  = '';//Belom
		
		$SQLcari = "";
		$query = $this->mdashboard->get_rekapIMB($SQLcari);
		$querySLF = $this->mdashboard->get_rekapSLF($SQLcari);
			
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['jum_dataSLF'] = $querySLF->num_rows();	
		$data['resultSLF'] = $querySLF->result();
		$data['daftar_kecamatan']	= $this->mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $kabkot);
		$content 		= $this->load->view('dashboardOpt', $data, TRUE);
		return $content;
	}

	protected function dashboardDinas2()
	{
		$user_id	= $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$id_kabkot_bg  	 		= $this->session->userdata('loc_id_kabkot');
		//echo
		$JumPerIMBKab		= $this->mdashboard->getJumIMBKabKota($id_kabkot_bg);
		$JumPerSLFKab 		= $this->mdashboard->getJumSLFKabKota($id_kabkot_bg);
		$filterQuery			= 'a.*,b.*';
		$DataPermohonan	= $this->mdashboard->getDataUserPemohon($filterQuery, $id_kabkot_bg);
		$belum = 3;
		$sudah = 4;

		$getTotalPbg  = $this->mdashboard->getTotalPbg()->num_rows();
		$belumTugas  = $this->mdashboard->getTotalPbgWorks($belum)->num_rows();
		$sudahTugas  = $this->mdashboard->getTotalPbgWorks($sudah)->num_rows();
		$getListPBG =  $this->mdashboard->getListPenugasan()->result();
		$data = array(
			'JumPerIMBKab' => $JumPerIMBKab,
			'JumPerSLFKab' => $JumPerSLFKab,
			'DataPermohonan' => $DataPermohonan,
			'totalPbg' => $getTotalPbg,
			'sudah' => $sudahTugas,
			'belum' => $belumTugas,
			'listpbg' => $getListPBG
		);
		$content 		= $this->load->view('dashboardDinas2', $data, TRUE);
		return $content;

	}

	protected function viewKosong()
	{
		$content = $this->load->view('kosong');
		return $content;
	}

	public function DataPengajuan($user_id = null)
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$data['profile_user'] 	= $this->mpengajuan->getDataUserPemohon('a.*,b.*', $user_id);
		$filterQuery			= 'a.*,b.*';
		$data['DataPemohon'] = $this->mpengajuan->getDataUserPemohon($filterQuery, $user_id);
		//echo $filterQuery->id_pemohon;
		$data['jum_imb'] 	= $this->mpengajuan->getJumIMB('
								SUM(CASE  when (a.status is not null) then 1 else 0 END ) AS Permohonan,
								SUM(CASE  when (a.status =13) then 1 else 0 END ) AS IMB_terbit,
								SUM(CASE  when (a.status =9) then 1 else 0 END ) AS IMB_ditolak', $user_id);
		$data['jum_slf']	= $this->mpengajuan->getJumSLF('SUM(CASE  when (a.status is not null) then 1 else 0 END ) AS Permohonan,
								SUM(CASE  when (a.status =2) then 1 else 0 END ) AS slf_terbit,
								SUM(CASE  when (a.status =3) then 1 else 0 END ) AS slf_ditolak', $user_id);
		$data['content'] = $this->load->view('DataPermohonan', $data, TRUE);
		$data['title']		=	'Dashboard';
		$data['heading']	=	'Report & Statistic';
		$this->load->view('backend', $data);
	}
	//End Dashboard
	//Begin Data Dashboard Pimpinan PUPR
	public function DatProv ()
	{
		$id_provinsi= $this->input->get('id');
		$value		= array();
		$query		= $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $id_provinsi);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kabkot' => $row->id_kabkot, 'nama_kabkota' => $row->nama_kabkota);
			}
		}
		echo json_encode($value);
	}
	
	public function DatProv2()
    {
        $id_provinsi= $this->uri->segment(3);
		$value		= array();
		$query		= $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $id_provinsi);
        $no = 1;
        foreach ($query->result() as $person) {
            $jum_imb = $this->Mglobals->getData('*', 'tm_imb_permohonan', array('id_kabkot' => $person->id_kabkot, 'status_progress >= 13' => null))->num_rows();
			$verivikasi = $this->Mglobals->getData('*', 'tmdatabangunan', array('id_kabkot_bgn' => $person->id_kabkot,'id_jenis_permohonan' => '14', 'status' => '1 and 2)'))->num_rows();
			$penugasan = $this->Mglobals->getData('*', 'tmdatabangunan', array('id_kabkot_bgn' => $person->id_kabkot, 'status' => 4))->num_rows();
			$jadwal = $this->Mglobals->getData('*', 'tmdatabangunan', array('id_kabkot_bgn' => $person->id_kabkot, 'status' => '(5 and 7)'))->num_rows();
			$konsultasi = $this->Mglobals->getData('*', 'tmdatabangunan', array('id_kabkot_bgn' => $person->id_kabkot, 'status' => '6'))->num_rows();
			$perhirungan = $this->Mglobals->getData('*', 'tmdatabangunan', array('id_kabkot_bgn' => $person->id_kabkot, 'status' => '9'))->num_rows();
			$validasi = $this->Mglobals->getData('*', 'tmdatabangunan', array('id_kabkot_bgn' => $person->id_kabkot, 'status' => '10'))->num_rows();
			$row = array();
			$row[] = $no++;;
			$row[] = $person->nama_kabkota;
			$row[] = $verivikasi;
			$row[] = $penugasan;
			$row[] = $jadwal;
			$row[] = $konsultasi;
			$row[] = $perhirungan;
			$row[] = $validasi;
			$tt[] = $row;
        }
        echo json_encode($tt);
    }
	//End Data Dashboard Pimpinan PUPR
	//Begin Dashboard TPA
	protected function dashboardAS()
	{
		$user_id	  = $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$asosiasi		= $this->session->userdata('loc_asosiasi');
		$id_asosiasi	= $this->session->userdata('loc_id_asosiasi');
		//echo $asosiasi;
		$profile_user = $this->mdashboard->getDataUserPemohon('a.*,b.*', $user_id);
		$tpa_result = $this->mdashboard->listDataTpa('a.*,b.keterangan,c.dir_file', $asosiasi,$id_asosiasi);
		$tpa_rekap = $this->mdashboard->GetJumlahTpa($id_asosiasi);
		$total_proyek = '-'; //belum
		$berjalan     = '-'; //belum
		$selesai      = '-'; //belum
		$data = array(
			'profile_user' => $profile_user,
			'tpa_rekap' => $tpa_rekap,
			'total_proyek' => $total_proyek,
			'berjalan'     => $berjalan,
			'selesai'      => $selesai,
			'tpa_result' => $tpa_result,
		);
		$content = $this->load->view('dashboard_as', $data, TRUE);
		return $content;
	}

	public function VerifikasiForm()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$query 				= $this->mdashboard->getDataTpaVer($id);
		$data['data'] 		= $query->row();
		$this->load->view('Verifikasi/Verifikasi', $data);
	}

	public function Tolak()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$query 				= $this->mdashboard->getDataTpaVer($id);
		$data['data'] 		= $query->row();
		$this->load->view('Verifikasi/Tolak', $data);
	}

	public function SimpanStatus()
	{
		$id	= $this->input->post('id');
		$email = $this->input->post('email');
		//Begin Ya
		if($this->input->post('xstileng')) {
			$dataProgress = array (
					'status' => 3,
			);
			$email = "$email";
			$subject 	= "Status Verifikasi Calon TPA";
			$text 		= "";
			$text .= "Yth Bapak/Ibu,<br>";
			$text .= "<br>";
			$text .= "Dengan ini kami memberitahukan bahwa Anda telah di Verifikasi Sebagai TPA<br>";
			$text .= "Dengan keterangan <b>Memenuhi Persyaratan</b><br>";
			$text .= "<br>";
			$text .= "<br>";
			$text .= "Hormat Kami <br>";
			$text .= "Admin SIMBG ";
			$this->mdashboard->updateProgress($dataProgress,$id);
			$this->simbg_lib->sendEmail($email, $subject, $text);
		
			$this->session->set_flashdata('message','Selesai Verifikasi');
			$this->session->set_flashdata('status','success');
			redirect('Dashboard');
		}
		//Begin Tidak
		if($this->input->post('xsleng')) {			
			$dataProgress = array (
					'status' => 2,
				);
			$email = "$email";
			$subject 	= "Status Verifikasi Calon TPA";
			$text 		= "";
			$text .= "Yth Bapak/Ibu,<br>";
			$text .= "<br>";
			$text .= "Dengan ini kami memberitahukan bahwa Anda telah di Verifikasi Sebagai TPA<br>";
			$text .= "Dengan keterangan <b>Hasil Tidak Memenuhi Persyaratan</b><br>";
			$text .= "Silahkan memperbaiki Dokumen jika anda masih berminat untuk menjadi TPA<br>";
			$text .= "<br>";
			$text .= "<br>";
			$text .= "Hormat Kami <br>";
			$text .= "Admin SIMBG ";
			$this->mdashboard->updateProgress($dataProgress,$id);
			$this->simbg_lib->sendEmail($email, $subject, $text);
			$this->session->set_flashdata('message','Selesai Verifikasi');
			$this->session->set_flashdata('status','success');
			redirect('Dashboard');
		}
	}

	public function SimpanTolak()
	{
		$user_id		= $this->session->userdata('loc_user_id');
		$user_id		= $this->Outh_model->Encryptor('decrypt', $user_id);
		$id				= $this->input->post('id');
		$email 			= $this->input->post('email');
		$catatan 		= $this->input->post('catatan');
		$tgl_skrg 		= date('Y-m-d');
		$data	= array(
			'id'			=> $id,
			'status'		=> 2,
		);
		$datalog	= array(
			'tgl_status' => $tgl_skrg,
			'status' => 'Dikembalikan ke Calon TPA',
			'id' => $id,
			'catatan' => $catatan,
			'user_id' => $user_id,
			//'modul' => 'verifikasi'
		);
		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_tpa', $data, 'id', $id);
			$this->Mglobals->setDatakol('th_ver_tpa', $datalog);
			$this->session->set_flashdata('message', 'Status Calon TPA  Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');

			$email = "$email";
			$subject 	= "Status Verifikasi Calon TPA";
			$text 		= "";
			$text .= "Yth Bapak/Ibu,<br>";
			$text .= "<br>";
			$text .= "Dengan ini kami memberitahukan bahwa Anda telah di Verifikasi Sebagai TPA<br>";
			$text .= "Dengan keterangan <b>Hasil Tidak Memenuhi Persyaratan</b><br>";
			$text .= "Silahkan memperbaiki Dokumen jika anda masih berminat untuk menjadi TPA<br>";
			$text .= $catatan;
			$text .= "<br>";
			$text .= "<br>";
			$text .= "Hormat Kami <br>";
			$text .= "Admin SIMBG ";
			$this->simbg_lib->sendEmail($email, $subject, $text);

			redirect('Dashboard');
		} else {
			$query		= $this->Mglobals->setData('tm_tpa', $data, 'id', $id);
			if ($query) {
				redirect('Dashboard');
			} else {
				$this->session->set_flashdata('message', 'Status Calon TPA Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Dashboard');
			}
		}
	}
	//End Dashboard TPA
	//Begin Dashboard Baru
	protected function dashboardBalai()
	{
		$kabkot = $this->session->userdata('loc_id_kabkot');
		$cekProv = $this->mglobal->getId('id_kabkot', $kabkot, 'tr_kabkot')->row()->id_provinsi;
		$data['j_Pengguna']  = '';//Belom
		$data['j_PBGterbit'] = '';//Belom
		$data['j_PBGtolak']  = '';//Belom			
		$data['j_Retribusi'] = '';//Belom
		$data['notifikasi']  = '';//Belom
		
		$SQLcari = "";
		$query = $this->mdashboard->get_rekapIMB($SQLcari);
		$querySLF = $this->mdashboard->get_rekapSLF($SQLcari);
			
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['jum_dataSLF'] = $querySLF->num_rows();	
		$data['resultSLF'] = $querySLF->result();
		$data['daftar_kabkota']	= $this->mglobal->listDataKabKota('id_kabkot,nama_kabkota', '', $cekProv);
		$content 		= $this->load->view('dashboardBalai', $data, TRUE);
		return $content;

	}

	public function check_status() 
	{
		$id_nya= $this->uri->segment(3);
		$data['id_nya'] = $id_nya;
		$dataIn = array ('status' => '2');
		try
		{
			$this->mdashboard->updateKesediaan($dataIn,$id_nya);
			$this->session->set_flashdata('message','Data Sukses Di Verifikasi');
			$this->session->set_flashdata('status','success');
		}catch(Exception $e) 
		{
			$this->session->set_flashdata('message','Data Gagal Di Verifikasi');
			$this->session->set_flashdata('status','error');
		}
		$crsf = $this->security->get_csrf_hash();
		$token['csrf']  = $crsf;
		echo json_encode($token);
	}

	public function DataDokumen()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$query 				= $this->mdashboard->getDataVerifikator($id);
		$data['data'] 		= $query->row();
		$bangunan			= $this->mdashboard->getDataBangunan($id);
		$data['bangunan']	= $bangunan->row();
		$this->getDataArsitektur();
		$this->getDataStruktur();
		$this->getDataMEP();
		$permohonan = $this->mdashboard->getDataJnsKonsultasi('a.*', $id)->row_array();
		$id_jenis_permohonan = $permohonan['id_jenis_permohonan'];
		$data['id_jenis_permohonan']	= $id_jenis_permohonan;
		$this->load->view('Verifikasi/FormVerifikasi', $data);
	}

	public function getDataArsitektur()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->mdashboard->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->mdashboard->getSyaratList($id_j_per, '2', null);
		$data['jum_data'] = $query->num_rows();
		$data['results_Ars'] = $query->result();
		$this->load->view('kosong', $data);
	}

	public function getDataStruktur()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->mdashboard->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->mdashboard->getSyaratList($id_j_per, '3', null);
		$data['jum_data'] = $query->num_rows();
		$data['results_Str'] = $query->result();
		$this->load->view('kosong', $data);
	}

	public function getDataMEP()
	{
		$id = $this->uri->segment('3');
		$data['id'] = $id;
		$permohonan = $this->mdashboard->getJenisKonsultasi($id)->row_array();
		$id_j_per = $permohonan['id_jenis_permohonan'];
		$query = $this->mdashboard->getSyaratList($id_j_per, '4', null);
		$data['jum_data'] = $query->num_rows();
		$data['results_MEP'] = $query->result();
		$this->load->view('kosong', $data);
	}

	public function DashboardTPT()
	{
		$user_id	  = $this->Outh_model->Encryptor('decrypt', $this->session->userdata('loc_user_id'));
		$datatpa = $this->mdashboard->getDataTpa('a.*,b.*,d.nm_asosiasi', $user_id);
		$id_tpa = $datatpa->id;
		$dataproyek = $this->mdashboard->getDataProyek('a.*,b.nm_pemilik,c.no_konsultasi,c.status,d.nm_konsultasi', $id_tpa);
		//$dataProyek = $this->mdashboard->getDataProyek('f.nm_konsultasi, e.no_konsultasi, e.status, e.id_fungsi_bg', $user_id);
		$dataLokasi = $this->mdashboard->getDataLokasi('*', $id_tpa);
		$Verifkasi = $this->mdashboard->getDataVerifikasi('*', $id_tpa);
		
		$t_tpa = '-'; //belum
		$berjalan     = '-'; //belum
		$selesai      = '-'; //belum
		$data = array(
			'datatpa' => $datatpa,
			'dataproyek' => $dataproyek,
			'dataLokasi' => $dataLokasi,
			'Verifkasi' => $Verifkasi,
			//'total_proyek' => $total_proyek,
			'berjalan'     => $berjalan,
			'selesai'      => $selesai,
		);
		$content = $this->load->view('dashboard_tpa', $data, TRUE);
		return $content;
	}

	//Begin Dashboard Dinas Teknis 
	protected function DashboardKadisTek()
	{
		$id_kabkot = $this->session->userdata('loc_id_kabkot');
		$pbg_rekap = $this->mdashboard->GetJmlPbgDinas($id_kabkot);
		$data['pbg_rekap'] = $pbg_rekap;

		$slf_rekap = $this->mdashboard->GetJmlSLFDinas($id_kabkot);
		$data['slf_rekap'] = $slf_rekap;

		$content 		= $this->load->view('DashboardKadisTek2', $data, TRUE);
		return $content;
	}

	protected function DashboardPengTek()
	{
		$id_kabkot 			= $this->session->userdata('loc_id_kabkot');
		$pbg_rekap 			= $this->mdashboard->GetJmlPbgDinas($id_kabkot);
		$data['pbg_rekap'] 	= $pbg_rekap;
		$slf_rekap 			= $this->mdashboard->GetJmlSLFDinas($id_kabkot);
		$data['slf_rekap'] 	= $slf_rekap;
		$query 				= $this->mdashboard->getDataRekapKecamatan($id_kabkot);
		$data['jum_data'] 	= $query->num_rows();	
		$data['result'] 	= $query->result();
		$content 			= $this->load->view('DashboardPengTek', $data, TRUE);
		return $content;
	}

	protected function DashboardOptTek()
	{
		$id_kabkot 			= $this->session->userdata('loc_id_kabkot');
		$pbg_rekap 			= $this->mdashboard->GetJmlPbgDinas($id_kabkot);
		$data['pbg_rekap'] 	= $pbg_rekap;
		$slf_rekap 			= $this->mdashboard->GetJmlSLFDinas($id_kabkot);
		$data['slf_rekap'] 	= $slf_rekap;
		$query 				= $this->mdashboard->getDataRekapKecamatan($id_kabkot);
		$data['jum_data'] 	= $query->num_rows();	
		$data['result'] 	= $query->result();
		$content 			= $this->load->view('DashboardOptTek', $data, TRUE);
		return $content;
	}
	//End Dashboard Dinas Teknis
}
