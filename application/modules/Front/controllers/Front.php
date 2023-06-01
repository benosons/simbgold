<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Front extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('simbg_lib');
		$this->load->model(array('mglobal', 'Mauth'));
		$this->load->helper(array('captcha', 'form'));
		$this->tahun = date('Y');
	}

	public function index()
	{
		$checkLogin = $this->session->userdata('loc_login');
		if ($checkLogin != TRUE) {
			$data['head_title'] = '.:: SIMBG ::.';
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['content'] = $this->load->view('Depan', $data, TRUE);
			$this->load->view('Front_Info', $data);
		} else {
			redirect('Dashboard');
		}
	}
	
	//Begin Login Logout
	public function Skill()
	{
		
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules('saya','Saya','required|max_length[50]|xss_clean');
		$this->form_validation->set_rules('bukan','Bukan','required|min_length[6]|max_length[20]|xss_clean');
		
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('message', 'Periksa Kembali Data Anda.');
			$this->session->set_flashdata('status', 'danger');
			redirect(site_url());
		}else{
			$password 	= str_replace("'", "", htmlspecialchars($this->input->post('bukan'), ENT_QUOTES));
			$email		= str_replace("'", "", htmlspecialchars($this->input->post('saya'), ENT_QUOTES));
			//Cek Login
			$this->SkillAgain($email,$password);	
		}
	}
	
	private function SkillAgain($email,$password)
	{
		$email		= $email;
		$password 	= sha1($password . $this->config->item('encryption_key'));
		$query	= $this->Mauth->getLoginData('a.id,a.username,a.email,a.id_kabkot,a.level,a.role_id,a.asosiasi,a.id_asosiasi,b.group', $email, $password);
		
		if ($query->num_rows() > 0) {
			$row	= $query->row();
			$data	= array(
				'loc_user_id' => $this->Outh_model->Encryptor('encrypt', $row->id),
				'loc_role_id' => $row->role_id,
				'loc_id_kabkot' => $row->id_kabkot,
				'loc_group' => $row->group,
				'loc_level' => $row->level,
				'loc_email' => $row->email,
				'loc_username' => $row->username,
				'loc_logo' => $row->dir_file_logo,
				'loc_dinas' => $row->p_nama_dinas,
				'loc_asosiasi' => $row->asosiasi,
				'loc_id_asosiasi' => $row->id_asosiasi,
				'loc_login' => TRUE
			);
			$this->session->set_userdata($data);
			$query2 = $this->mglobals->getData('*', 'tm_user_data', array('user_id' => $row->id));
			if ($row->role_id <= 4) {
				redirect('Dashboard');
			} else {
				if ($query2->num_rows() > 0) {
					$select = array('nama_lengkap', 'alamat', 'id_provinsi', 'id_kabkota', 'id_kecamatan', 'no_ktp', 'no_hp');
					$where = array("user_id = " => $row->id);
					$this->db->select($select);
					$result = $this->db->get_where('tm_user_data', $where)->row();
					$i = 0;
					//if (count($result) > 0) {
					if (count(array($result)) > 0) {
						foreach ($result as $key => $value) {
							if ($value == '') {
								$i++;
							}
						}
					}
					if ($i > 0) {
						$this->session->set_flashdata('message', 'Data Harus diengkapi sebelum melanjutkan.');
						$this->session->set_flashdata('status', 'warning');
						redirect('Profile/lengkapi_akun');
						//redirect('xbt');
					} else {
						redirect('Dashboard');
					}
				} else {
					$this->session->set_flashdata('message', 'Data Harus diengkapi sebelum melanjutkan.');
					$this->session->set_flashdata('status', 'warning');
					redirect('Profile/lengkapi_akun');
					//redirect('xbt');
				}
			}
		} else {
			$this->session->set_flashdata('message', 'Email atau Kata Sandi tidak sesuai.');
			$this->session->set_flashdata('status', 'danger');
			redirect(site_url());
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect();
	}
	//End Login Logout
	//Begin Pendaftaran User	
	public function One()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('siapa','Siapa','required|valid_email|max_length[50]');
		$this->form_validation->set_rules('anda','Anda','required|min_length[6]|max_length[20]');
		$this->form_validation->set_rules('roleplayer','Roleplayer','required|max_length[2]');
		if($this->form_validation->run() == false)
		{
			$pesanan = "Pendaftaran Gagal !";
			$this->session->set_flashdata('message', $pesanan);
			$this->session->set_flashdata('status', 'danger');
			redirect(site_url());
			
		}else{
			$id				= $this->input->post('id');
			$role_id		= str_replace("'", "", htmlspecialchars($this->input->post('roleplayer'), ENT_QUOTES));
			$password_user 	= str_replace("'", "", htmlspecialchars($this->input->post('anda'), ENT_QUOTES));
			$email			= str_replace("'", "", htmlspecialchars($this->input->post('siapa'), ENT_QUOTES));
			//Cek Email
			$cekmail = $this->cekmail($email);
			if ($cekmail == 'false') {
				//$this->session->set_flashdata('message', 'Pendaftaran Gagal. ');
				$pesanan = "Pendaftaran Gagal !<br>Email Telah Digunakan.<br>
							Silahkan Ulangi Pendaftaran <br> Dengan Alamat Email Baru. 
							";
				$this->session->set_flashdata('message', $pesanan);
				$this->session->set_flashdata('status', 'danger');
				redirect(site_url());
			} else {
				
				//Cek Daftar
				$ceksave = $this->ceksave($id,$role_id,$email,$password_user);
				if ($ceksave == 'false') {
					$pesanan = "Pendaftaran Gagal !<br> Silahkan Ulangi Pendaftaran Beberapa Saat Lagi!.";
					$this->session->set_flashdata('message', $pesanan);
					$this->session->set_flashdata('status', 'danger');
				} else {
					$pesanan = "Pendaftaran Berhasil!<br>Silahkan Lakukan Konfrimasi Tahap Akhir Pendaftaran Dengan Cara
					mengKlik Link Aktivasi Yang Telah Terkirim ke Alamat Email Anda <br> (<b>$email</b>).
					<br/>
					<br>Terima Kasih. 
					<br>".$ceksave;
					$this->session->set_flashdata('message', $pesanan);
					$this->session->set_flashdata('status', 'success');
				}
				header("Location:$ceksave");
			}
		}
		
	}
	
	private function cekmail($email)
	{
		$email = $email;
		$cekmail = "";
		//$data['gagal'] = "";
		if ($email != "") {
			//$temp = $this->Mauth->get_email($email);
			$user = $this->Mauth->getEmailUser($email);
			$userdata = $this->Mauth->getEmailUserData($email);
			if ($user->num_rows() > 0 || $userdata->num_rows() > 0) {
				$cekmail = "false";
			} else if ($user->num_rows() < 1 || $userdata->num_rows() < 1) {
				$cekmail = "true";
			}
		}
		return $cekmail;
		
	}
	
	private function ceksave($id,$role_id,$email,$password_user)
	{
		$ceksave = "";
		
		$id	= $id;
		$role_id = $role_id;
		$password_user 	= $password_user;
		$email = $email;
			
		$data	= array(
				'username' => $email,
				'password' => sha1($password_user . $this->config->item('encryption_key')),
				'email' => $email,
				'role_id' => $role_id,
				'activation' => sha1($email . $this->config->item('encryption_key'))
				// 'post_date'=>date('Y-m-d H:i:s')
		);
		$query 	= $this->mglobals->setData('temp_user', $data, 'id', $id);
		$cekId 	= $this->mglobals->getId();
		$row 	= $this->Global_model->getId('id', $cekId, 'temp_user')->row();
		if ($query) {
			
			$linknya	=	base_url() . "Front/verfikasi_user/" . sha1($email . $this->config->item('encryption_key'));
			$textnya	=	"Yth Bapak/Ibu,<br><br>
							Kami menerima permintaan pembuatan akun untuk mengakses layanan SIMBG <br>
							Jika anda merasa melakukan pengajuan pembuatan akun SIMBG Silahkan Klik Tautan
							berikut ini : <br> <a href='$linknya' >Verifikasi</a> <br>
							Username Anda Adalah : $email <br><br>
							Hormat Kami <br> Admin SIMBG";
			$subject 	=	"Verifikasi User Pengajuan Permohonan IMB | CS SIMBG";
			$link		=	$linknya;
			$text 		= 	$textnya;
			// $this->simbg_lib->sendEmail($email, $subject, $text);

			$pesan = "Link aktivasi berhasil dikirim ulang. Silahkan buka email $email untuk proses aktivasi.";

			$data_kirimulang = array(
				's_email' => $email,
				's_subject' => $subject,
				's_text' => $text,
				's_pesan' => $pesan
			);
			$this->session->set_userdata('sku', $data_kirimulang); //sku = session kirim ulang
			//
			$ceksave = $linknya;
		} else {
			//
			$ceksave = "false";
		}
		return $ceksave;
	}
	//End Pendaftaran User

	//Verfikasi Pendaftaran Akun Pemohon / TPA
	public function verfikasi_user()
	{
		$temp_user_id	= str_replace("'", "", htmlspecialchars($this->uri->segment(3), ENT_QUOTES));
		$cek_tmp  = $this->Mauth->getDataTempUsers('a.*', $temp_user_id);
		if ($cek_tmp->num_rows() > 0) {
			if (trim($temp_user_id) != '') {
				$cek_temp_user = $cek_tmp->row();
				if ($cek_temp_user) {
					$username	= $cek_temp_user->username;
					$password	= $cek_temp_user->password;
					$email		= $cek_temp_user->email;
					$role_id	= $cek_temp_user->role_id;
					$data	= array(
						'username' => $username,
						'password' => $password,
						'email'    => $email,
						'role_id'  => $role_id,
						'status'   => 1
					);
					$user_id		= $this->mglobals->setData('tm_user', $data);
					if ($user_id) {
						$cekId = $this->mglobals->getId();
						$data2 = array(
							'user_id' => $user_id,
							'email' => $email
						);
						$query		= $this->mglobals->setData('tm_user_data', $data2);
						$this->mglobals->deleteDatakey('temp_user', 'username', $username);
						if ($query) {
							$row = $this->Global_model->getId('id', $cekId, 'tm_user')->row();
							$sess	= array(
								'loc_user_id' => $this->Outh_model->Encryptor('encrypt', $row->id),
								'loc_username' => $row->username,
								'loc_role_id'  => $row->role_id,
								//'loc_group' => 0,
								'loc_email' => $row->email,
								'loc_login' => TRUE
							);
							$this->session->set_userdata($sess);
							$this->session->set_flashdata('message', 'Verifikasi Berhasil, Silahkan Lengkapi Data Pribadi Anda!.');
							$this->session->set_flashdata('status', 'success');
							redirect('Profile/lengkapi_akun');
						} else {
							$this->session->set_flashdata('message', 'Silahkan Mengulangi Proses Pendaftaran !');
							$this->session->set_flashdata('status', 'danger');
							redirect('');
						}
					} else {
						$this->session->set_flashdata('message', 'Kami Tidak Menemukan Data Pendaftaran Anda !');
						$this->session->set_flashdata('status', 'danger');
						redirect('');
					}
				} else {
					$this->session->set_flashdata('message', 'Gagal Melakukan Proses Pendaftaran !');
					$this->session->set_flashdata('status', 'danger');
					redirect('');
				}
			} else {
				$this->session->set_flashdata('message', 'Proses Pendaftaran Tidak Berhasil!');
				$this->session->set_flashdata('status', 'danger');
				redirect('');
			}
		} else {
			$this->session->set_flashdata('message', 'Kami Tidak Menemukan Data Pendaftaran Anda. Silahkan Mengulangi Proses Pendaftaran !');
			$this->session->set_flashdata('status', 'danger');
			redirect('');
		}
	}
	//End Verfikasi Pendaftaran Akun Pemohon / TPA
	
	//Begin Reset Password
	public function Tokill()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('reset_pass','Reset_pass','trim|required|valid_email|max_length[50]');
		if($this->form_validation->run() != false){
			//Cek Email
			$email  = str_replace("'", "", htmlspecialchars($this->input->post('reset_pass'), ENT_QUOTES));
			$cekmailreset = $this->cekmailreset($email);
			if ($cekmailreset != 'true') {
				$reset_password = $this->reset_password($email);
				redirect(site_url());
			}else{
				$pesanan = "Email tidak Ditemukan.";
				$this->session->set_flashdata('message', $pesanan);
				$this->session->set_flashdata('status', 'danger');
				redirect(site_url());
			}
		}else{
			$pesanan = "Email Salah.";
			$this->session->set_flashdata('message', $pesanan);
			$this->session->set_flashdata('status', 'danger');
			redirect(site_url());
		}
	}
	private function cekmailreset($email)
	{
		$email = $email;
		$cekmailreset = "";
		//$data['gagal'] = "";
		if ($email != "") {
			//$temp = $this->Mauth->get_email($email);
			$user = $this->Mauth->getEmailUser($email);
			$userdata = $this->Mauth->getEmailUserData($email);
			if ($user->num_rows() > 0 || $userdata->num_rows() > 0) {
				$cekmailreset = "false";
			} else if ($user->num_rows() < 1 || $userdata->num_rows() < 1) {
				$cekmailreset = "true";
			}
		}
		return $cekmailreset;
	}
	private function reset_password($email)
	{
		$email = $email;
		//$query = $this->Mauth->cekUserPassResetEmail('password, email', $email);
		$len = 8;
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$pwdbaru = substr( str_shuffle( $chars ), 0, $len );
		if ($email != '') {
			$query = $this->Mauth->cekUserPassResetEmail('id, password, email', $email);
			$mydata2 = $query->row_array();
			$baris2 = $query->num_rows();
			if ($baris2 >= 1) {
				$subject 	= "Lupa Kata Sandi | CS SIMBG";
				//$link		=  base_url() . "front/change_password/" . md5($query->row()->email) . '/' . $query->row()->password;
				$text 		= "";
				$text .= "Yth Bapak/Ibu,<br>";
				$text .= "<br>";
				$text .= "Kami menerima permintaan Lupa Kata Sandi akun anda. <br>";
				$text .= "Kata Sandi Baru Anda Adalah : <b>$pwdbaru</b> <br>";
				$text .= "Untuk mengubah sandi Anda agar mudah diingat, silahkan pilih menu Akun => Ubah Kata Sandi setelah Anda login.";
				//$text .= "<a href='$link' >Verifikasi</a> <br>";
				$text .= "<br>";
				$text .= "Hormat Kami <br>";
				$text .= "Admin SIMBG ";
				$this->simbg_lib->sendEmail($query->row()->email, $subject, $text);

				$pesan = "Kata sandi baru berhasil dikirim ulang. Silahkan buka email $email dan masuk dengan kata sandi baru Anda.";

				$data_kirimulang = array(
					's_email' => $email,
					's_subject' => $subject,
					's_text' => $text,
					's_pesan' => $pesan
				);
				
				$this->session->set_userdata('sku', $data_kirimulang); //sku = session kirim ulang
				//End SendEmail
				$emailnya = $query->row()->email;
				$idnya = $query->row()->id;
					$new_password	= sha1($pwdbaru . $this->config->item('encryption_key'));
					$data	= array(
						'password' => $new_password,
					);
					$query		= $this->mglobals->setData('tm_user', $data, 'id', $idnya);
					$this->session->set_flashdata('message', 'Kata Sandi Berhasil di Ubah !<br/>Silahkan Cek Email dan Masuk Dengan Kata Sandi Baru Anda.');
					$this->session->set_flashdata('status', 'success');
					//redirect('front/change_password');
			} else {
				$pesanan = "Email Tidak Ditemukan.";
				$this->session->set_flashdata('message', $pesanan);
				$this->session->set_flashdata('status', 'danger');
			}
		} else {
			$pesanan = "Email Tidak Ditemukan.";
			$this->session->set_flashdata('message', $pesanan);
			$this->session->set_flashdata('status', 'danger');
		}
	}
	//End Reset Password
	public function daftar_akun_dinas()
	{
		$activation = str_replace("'", "", htmlspecialchars($this->uri->segment(3), ENT_QUOTES));
		$query = $this->mglobals->getData('*', 'tm_user', array('activation' => $activation));
		if ($query->num_rows() > 0) {
			$data	= array(
				//'username' => $username,
				'level' => null,
				'status' => 1
			);
			$query2	= $this->mglobals->setData('tm_user', $data, 'activation', $activation);
			$this->session->set_flashdata('message', 'Verifikasi Berhasil.<br/> Silahkan Masuk Dengan Akun Anda.');
			$this->session->set_flashdata('status', 'success');
			
		} else {
			$this->session->set_flashdata('message', 'Verifikasi Tidak Berhasil.');
			$this->session->set_flashdata('status', 'danger');
		}
		redirect('');
	}
	//End Lacak Berkas IMB dan SLF
	public function kirim_ulang()
	{
		$this->load->library('Simbg_lib');
		if(!$this->session->userdata('sku')) {
			$this->session->set_flashdata('message', 'Pengiriman Email Gagal.');
			$this->session->set_flashdata('status', 'danger');
		}else{
			$sku = $this->session->userdata('sku');
			$email	= $sku["s_email"];
			$subject= $sku["s_subject"];
			$text	= $sku["s_text"];
			$pesan  = $sku["s_pesan"];
			$this->simbg_lib->sendEmail($email, $subject, $text);
			$this->session->set_flashdata('message', "$pesan");
			$this->session->set_flashdata('status', 'success');
		}
		
		redirect('');		
	}
	public function delsku(){
		$this->session->unset_userdata('sku');
	}
}
