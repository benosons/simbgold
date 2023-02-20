<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Pusat extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mpusat');
		$this->load->model('Mglobal');
		$this->load->library('Simbg_lib');
		$this->simbg_lib->check_session_login();
	}

	public function index()
	{ 
		redirect('dashboard');
	}

	//Begin Asosiasi
	public function data_asosiasi()
	{
		$select = 'id,nm_asosiasi,alamat,no_tlp';
		$table = 'tr_asosiasi';
		$pk = 'id';
		$dat_aso = $this->mglobals->getData(
			$select,
			$table,
			array('group' => 1),
			$pk,
			'desc'
		);
		$data['dat_as'] 	= $dat_aso;
		$data['content']	= $this->load->view('data_AsKam/data_asosiasi', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('Dbai', $data);
	}
	public function simpan_As()
	{
		//$nama_as			= $this->session->userdata('loc_id_kabkot');
		$id				= $this->input->post('id_as');
		$nama_as		= $this->input->post('nama_as');
		$alamat_as		= $this->input->post('alamat_as');
		$notel			= $this->input->post('notel');
		
		if ($id != NULL) {
			
			$data	= array(
				'nm_asosiasi' => $nama_as,
				'group' => 1,
				'alamat' => $alamat_as,
				'no_tlp' => $notel,
				);
				
			$query = $this->mglobals->setData('tr_asosiasi', $data, 'id', $id);
				
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Pusat/data_asosiasi');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pusat/data_asosiasi');
			}
			
		}else{
			
			$data	= array(
				'id' => $id,
				'nm_asosiasi' => $nama_as,
				'group' => 1,
				'alamat' => $alamat_as,
				'no_tlp' => $notel,
			);
			$query		= $this->mglobals->setData('tr_asosiasi', $data);

			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Pusat/data_asosiasi');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pusat/data_asosiasi');
			}
		}
		
	}
	
	public function ubah_As()
	{
		$id = $this->input->get('id');
		$data = $this->mglobals->getData('id,nm_asosiasi,alamat,no_tlp', 'tr_asosiasi', array('id' => $id))->row();
		echo json_encode($data);
	}
	
	public function hapus_As($id)
	{
		$table = 'tr_asosiasi';
		$process = $this->mglobals->deleteDataKey($table, 'id', $id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Pusat/data_asosiasi');
	}

	//End Asosiasi
	
	//Begin Kampus
	public function data_kampus()
	{
		$select = 'id,nm_asosiasi,alamat,no_tlp';
		$table = 'tr_asosiasi';
		$pk = 'id';
		$dat_kam = $this->mglobals->getData(
			$select,
			$table,
			array('group' => 2),
			$pk,
			'desc'
		);
		$data['dat_kampus'] 	= $dat_kam;
		$data['content']		= $this->load->view('data_AsKam/data_kampus', $data, TRUE);
		$data['title']			=	'';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
	}
	
	public function simpan_kampus()
	{
		//$nama_as			= $this->session->userdata('loc_id_kabkot');
		$id				= $this->input->post('id_as');
		$nama_as		= $this->input->post('nama_as');
		$alamat_as		= $this->input->post('alamat_as');
		$notel			= $this->input->post('notel');
		
		if ($id != NULL) {
			
			$data	= array(
				'nm_asosiasi' => $nama_as,
				'group' => 2,
				'alamat' => $alamat_as,
				'no_tlp' => $notel,
				);
				
			$query = $this->mglobals->setData('tr_asosiasi', $data, 'id', $id);
				
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Pusat/data_kampus');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pusat/data_kampus');
			}
		}else{
			
			$data	= array(
				'id' => $id,
				'nm_asosiasi' => $nama_as,
				'group' => 2,
				'alamat' => $alamat_as,
				'no_tlp' => $notel,
			);
			$query		= $this->mglobals->setData('tr_asosiasi', $data);
			if ($query) {
				$this->session->set_flashdata('message', 'Data Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Pusat/data_kampus');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pusat/data_kampus');
			}
		}	
	}
	
	public function ubah_kampus()
	{
		$id = $this->input->get('id');
		$data = $this->mglobals->getData('id,nm_asosiasi,alamat,no_tlp', 'tr_asosiasi', array('id' => $id))->row();
		echo json_encode($data);
	}
	
	public function hapus_kampus($id)
	{
		$table = 'tr_asosiasi';
		$process = $this->mglobals->deleteDataKey($table, 'id', $id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Pusat/data_kampus');
	}
	//End Kampus


	//Begin kadis PUPR
	public function kadis_pupr()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$role_id	= 6;

		$data['user_result'] = $this->Mpusat->listDataPUPR('a.id,a.username,a.status,b.nama_lengkap,b.no_hp,b.email,b.nip,c.nama_kabkota,d.p_nama_dinas,d.p_tlp', $id_kabkot, $role_id);
		
		//$data['dat_kampus'] 	= $dat_kam;
		$data['content']		= $this->load->view('kadis/kadis_pupr', $data, TRUE);
		$data['title']			=	'';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
	}

	public function ResetPass()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$query 				= $this->Mpusat->getDataUser($id);
		$data['data'] 		= $query->row();
		$this->load->view('kadis/Reset', $data);
	}

	public function SimpanPass()
	{
		$id	= $this->input->post('id');
		if($this->input->post('xstileng')) {
				$dataProgress = array (
					'password' => 'd3ae21104171969fdc4f55daa2fb9cbfee9925ce',
				);
			$this->Mpusat->RessetPass($dataProgress,$id);
			$this->session->set_flashdata('message','Selesai Melaukan Reset Password');
			$this->session->set_flashdata('status','success');
			redirect('Pusat/kadis_pupr');
		}
	}
	
	public function simpan_pupr()
	{
		$email 	= $this->input->post('email');
		$nama 	= $this->input->post('nama_ktp');
		//$jabatan = 6;
		$kabkot = $this->input->post('nama_kabkota');
		$noktp  = $this->input->post('noktp');
		$nipnya	= $this->input->post('nipnya');
		$no_hp	= $this->input->post('no_hp');
		
		$len = 8;
		$chars = "@abcdefghijklmnopqrstuvwxyz0123456789";
		$pwdnya = substr( str_shuffle( $chars ), 0, $len );
		$aktivation = $nama . '-' . $email;
		
		$kd_aktivasi = sha1($aktivation . $this->config->item('encryption_key'));
		$u_password	= sha1($pwdnya . $this->config->item('encryption_key'));
		
		if ($email != NULL) {
			$data1 = array(
				'username' => $email,
				'password' => $u_password,
				'id_kabkot'=> $kabkot,
				'role_id'  => 6,
				'email' => $email,
				'activation' => $kd_aktivasi,
			);
			
			$id_pengguna = $this->mglobals->setData('tm_user', $data1);
			
			$data = array(
				'email' => $email,
				'nama_lengkap' => $nama,
				'jabatan_dinas' => 'Kepala Dinas',
				'user_id' => $id_pengguna,
				'nip' => $nipnya,
				'no_ktp' => $noktp,
				'no_hp' => $no_hp,
			);
			
			$query = $this->mglobals->setData('tm_user_data', $data);
			if ($query) {
				//Begin SendEmail
				$subject 	= "Verifikasi User Pengajuan Akses Admin SIMBG | CS SIMBG";
				$link		=  base_url() . "Front/daftar_akun_dinas/$kd_aktivasi";
				$text 		= "";
				$text .= "Yth Bapak/Ibu,<br>";
				$text .= "<br>";
				$text .= "Kami menerima permintaan pembuatan akun untuk mengakses layanan SIMBG Online dengan wewenang sebagai Kepala Dinas Teknis. <br><br>";
				$text .= "Akun Anda Sebagi berikut <br>";
				$text .= "&emsp; Email : $email <br>";
				$text .= "&emsp; Kata Sandi : $pwdnya <br><br>";
				$text .= "Silahkan Klik Tautan berikut ini untuk melanjutkan proses => <b><a href='$link' >Verifikasi</a></b> <br>";
				//$text .= "Username Anda Adalah : $email <br>";
				$text .= "<br>";
				$text .= "<br>";
				$text .= "Hormat Kami <br>";
				$text .= "Admin SIMBG ";
				$this->simbg_lib->sendEmail($email, $subject, $text);
				//End SendEmail
				// echo "akun dengan email $email berhasil didaftarkan<br>";
				// echo "klik link berikut untuk aktivasi login $link";

				$this->session->set_flashdata('message', "Akun dengan email $email berhasil didaftarkan. Silahkan hubungi Kadis tersebut untuk proses aktivasi.");
				$this->session->set_flashdata('status', 'success');
				redirect('Pusat/kadis_pupr');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pusat/kadis_pupr');
			}
			
		} else {
			$this->session->set_flashdata('message', 'akun dengan email $email sudah terdaftarkan di System kami.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Pusat/kadis_pupr');
		}
	}
	
	public function hapus_kadis($id)
	{
		$process = $this->Mpusat->removeData($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Pusat/kadis_pupr');
	}
	
	//End kadis PUPR
	
	//Begin kadis Perizinan
	public function kadis_perizinan()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$role_id	= 5;
		$data['user_result'] = $this->Mpusat->listDataPerizinan('a.id,a.username,a.status,b.nama_lengkap,b.no_hp,b.email,b.nip,c.nama_kabkota,d.p_nama_dinas,d.p_tlp', $id_kabkot, $role_id);
		
		//$data['user_result'] = $this->Mpusat->listDataPerizinan('a.id,a.username,a.status,b.nama_lengkap,b.no_hp,b.nip,c.nama_kabkota,d.n_', $id_kabkot, $role_id);
		//$data['dat_kampus'] 	= $dat_kam;
		$data['content']		= $this->load->view('kadis/kadis_perizinan', $data, TRUE);
		$data['title']			=	'';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
	}

	public function ResetPassPer()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$query 				= $this->Mpusat->getDataUser($id);
		$data['data'] 		= $query->row();
		$this->load->view('kadis/Reset2', $data);
	}

	public function SimpanPassPer()
	{
		$id	= $this->input->post('id');
		if($this->input->post('xstileng')) {
				$dataProgress = array (
					'password' => 'd3ae21104171969fdc4f55daa2fb9cbfee9925ce',
				);
			$this->Mpusat->RessetPass($dataProgress,$id);
			$this->session->set_flashdata('message','Selesai Melaukan Reset Password');
			$this->session->set_flashdata('status','success');
			redirect('Pusat/kadis_perizinan');
		}
	}
	
	public function simpan_perizinan()
	{
		$email 	= $this->input->post('email');
		$nama 	= $this->input->post('nama_ktp');
		//$jabatan = 6;
		$kabkot = $this->input->post('nama_kabkota');
		$noktp  = $this->input->post('noktp');
		$nipnya	= $this->input->post('nipnya');
		$no_hp	= $this->input->post('no_hp');
		
		$len = 8;
		$chars = "@abcdefghijklmnopqrstuvwxyz0123456789";
		$pwdnya = substr( str_shuffle( $chars ), 0, $len );
		$aktivation = $nama . '-' . $email;
		
		$kd_aktivasi = sha1($aktivation . $this->config->item('encryption_key'));
		$u_password	= sha1($pwdnya . $this->config->item('encryption_key'));
		
		if ($email != NULL) {
			$data1 = array(
				'username' => $email,
				'password' => $u_password,
				'id_kabkot'=> $kabkot,
				'role_id'  => 5,
				'email' => $email,
				'activation' => $kd_aktivasi,
			);
			
			$id_pengguna = $this->mglobals->setData('tm_user', $data1);
			
			$data = array(
				'email' => $email,
				'nama_lengkap' => $nama,
				'jabatan_dinas' => 'Kepala Dinas',
				'user_id' => $id_pengguna,
				'nip' => $nipnya,
				'no_ktp' => $noktp,
				'no_hp' => $no_hp,
			);
			
			$query = $this->mglobals->setData('tm_user_data', $data);
			if ($query) {
				//Begin SendEmail
				$subject 	= "Verifikasi User Pengajuan Akses Admin SIMBG | CS SIMBG";
				$link		=  base_url() . "Front/daftar_akun_dinas/$kd_aktivasi";
				$text 		= "";
				$text .= "Yth Bapak/Ibu,<br>";
				$text .= "<br>";
				$text .= "Kami menerima permintaan pembuatan akun untuk mengakses layanan SIMBG Online dengan wewenang sebagai Kepala Dinas Perizinan. <br><br>";
				$text .= "Akun Anda Sebagi berikut <br>";
				$text .= "&emsp; Email : $email <br>";
				$text .= "&emsp; Kata Sandi : $pwdnya <br><br>";
				$text .= "Silahkan Klik Tautan berikut ini untuk melanjutkan proses => <b><a href='$link' >Verifikasi</a></b> <br>";
				//$text .= "Username Anda Adalah : $email <br>";
				$text .= "<br>";
				$text .= "<br>";
				$text .= "Hormat Kami <br>";
				$text .= "Admin SIMBG ";
				$this->simbg_lib->sendEmail($email, $subject, $text);
				//End SendEmail
				// echo "akun dengan email $email berhasil didaftarkan<br>";
				// echo "klik link berikut untuk aktivasi login $link";

				$this->session->set_flashdata('message', "Akun dengan email $email berhasil didaftarkan. Silahkan hubungi Kadis tersebut untuk proses aktivasi.");
				$this->session->set_flashdata('status', 'success');
				redirect('Pusat/kadis_perizinan');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pusat/kadis_perizinan');
			}
			
		} else {
			$this->session->set_flashdata('message', 'akun dengan email $email sudah terdaftarkan di System kami.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Pusat/kadis_perizinan');
		}
	}
	
	public function hapus_kadis2($id)
	{
		$process = $this->Mpusat->removeData($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Pusat/kadis_perizinan');
	}
	//End kadis Perizinan
	
	
	public function getNamaKabKota()
	{
		//$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$value		= array();
		$query		= $this->Mpusat->listDataKabKota('id_kabkot,nama_kabkota');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$value[]	= array('id_kabkot' => $row->id_kabkot, 'nama_kabkota' => $row->nama_kabkota);
			}
		}
		echo json_encode($value);
	}

	//Begin kas
	public function data_kas()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$role_id	= 14;
		$data['user_result'] = $this->Mpusat->listDataPJ('a.id,a.username,a.status,b.nama_lengkap,b.no_hp,b.no_ktp,c.nm_asosiasi,c.group', $id_kabkot, $role_id);
		$data['content']		= $this->load->view('pj/data_kas', $data, TRUE);
		$data['title']			=	'';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
	}
	
	public function getAsKamp()
	{
		$group	= $this->uri->segment(3);
		$value		= array();
		$query		= $this->Mpusat->listAsKam('id,nm_asosiasi', $group);
		if ($group != NULL) {
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$value[]	= array('id' => $row->id, 'nm_asosiasi' => $row->nm_asosiasi);
				}
			}
		} else {
			
			$value		= '';
		}
		echo json_encode($value);
	}
	
	public function simpan_kas()
	{
		$email 	= $this->input->post('email');
		$nama 	= $this->input->post('nama_ktp');
		$asosiasi = $this->input->post('jenis_tpa');
		/*if($asosiasi =='1'){
			$aso ='1';
		}else if($asosiasi ==''){
			$aso ='3';
		}else{
			$aso ='0';
		}*/
		$askam 	= $this->input->post('askam');
		$noktp  = $this->input->post('noktp');
		$nipnya	= $this->input->post('nipnya');
		$no_hp	= $this->input->post('no_hp');
		$len = 8;
		$chars = "@abcdefghijklmnopqrstuvwxyz0123456789";
		$pwdnya = substr( str_shuffle( $chars ), 0, $len );
		$aktivation = $nama . '-' . $email;
		$kd_aktivasi = sha1($aktivation . $this->config->item('encryption_key'));
		$u_password	= sha1($pwdnya . $this->config->item('encryption_key'));
		if ($email != NULL) {
			$data1 = array(
				'username' => $email,
				'password' => $u_password,
				'id_asosiasi'=> $askam,
				'asosiasi'=> $asosiasi,
				'role_id'  => 14,
				'email' => $email,
				'activation' => $kd_aktivasi,
			);
			
			$id_pengguna = $this->mglobals->setData('tm_user', $data1);
			
			$data = array(
				'email' => $email,
				'nama_lengkap' => $nama,
				'jabatan_dinas' => 'Verifikator TPA',
				'user_id' => $id_pengguna,
				//'nip' => $nipnya,
				'no_ktp' => $noktp,
				'no_hp' => $no_hp,
			);
			
			$query = $this->mglobals->setData('tm_user_data', $data);
			if ($query) {
				//Begin SendEmail
				$subject 	= "Verifikasi User Pengajuan Akses Admin SIMBG | CS SIMBG";
				$link		=  base_url() . "Front/daftar_akun_dinas/$kd_aktivasi";
				$text 		= "";
				$text .= "Yth Bapak/Ibu,<br>";
				$text .= "<br>";
				$text .= "Kami menerima permintaan pembuatan akun untuk mengakses layanan SIMBG Online dengan Wewenang sebagai Verifikator TPA. <br><br>";
				$text .= "Akun Anda Sebagi berikut <br>";
				$text .= "&emsp; Email : $email <br>";
				$text .= "&emsp; Kata Sandi : $pwdnya <br><br>";
				$text .= "Silahkan Klik Tautan berikut ini untuk melanjutkan proses => <b><a href='$link' >Verifikasi</a></b> <br>";
				//$text .= "Username Anda Adalah : $email <br>";
				$text .= "<br>";
				$text .= "<br>";
				$text .= "Hormat Kami <br>";
				$text .= "Admin SIMBG ";
				$this->simbg_lib->sendEmail($email, $subject, $text);
				//End SendEmail

				$this->session->set_flashdata('message', "Akun dengan email $email berhasil didaftarkan. Silahkan hubungi Penanggung Jawab tersebut untuk proses aktivasi.");
				$this->session->set_flashdata('status', 'success');
				redirect('Pusat/data_kas');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Pusat/data_kas');
			}
			
		} else {
			$this->session->set_flashdata('message', 'akun dengan email $email sudah terdaftarkan di System kami.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Pusat/data_kas');
		}
	}
	
	public function hapus_kas($id)
	{
		$process = $this->Mpusat->removeData($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Pusat/data_kas');
	}
	//End kas
	//Begin Rekap Kepemilikan Akun Dinas
	public function Akun() 
	{
		$SQLcari = "";
		if ($this->input->post('search',TRUE)){
			$status = trim($this->input->post('status'));
			$data['status'] = $status;	
			if($status == '1'){
				$SQLcari .= "AND b.status <= 14 ";
				}
			if ($status == '2')
			{
				$SQLcari .= "AND  b.status >=16 ";
			}
			$query = $this->Mpusat->getDataRekapAkun($SQLcari);	
		}
		else 
		{
			$query = $this->Mpusat->getDataRekapAkun($SQLcari);
		}
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		//$data['head_title'] = '.:: SIMBG ::.';
		$data['title']		= '';
		$data['heading']	= '';
		$this->template->load('template/template_backend', 'Pusat/Rekap/RekapAkun', $data);
	}
	//End Rekap Kepemilikan Akun Dinas
	//Begin Pengiriman Ulang Email  Untuk Pemohon
	public function KonfirmasiEmail()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$role_id	= 10;
		$data['user_result'] = $this->Mpusat->listDataEmail('a.id,a.username,a.post_date', $id_kabkot, $role_id);
		//$data['dat_kampus'] 	= $dat_kam;
		$data['content']		= $this->load->view('Konfirmasi/konfirmasiemail', $data, TRUE);
		$data['title']			=	'';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
	}
	//End Pengiriman Ulang Email Untuk Pemohon
}