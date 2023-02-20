<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Ptsp extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mptsp');
		$this->load->model('Mglobals');
		$this->load->library('Simbg_lib');
		$this->simbg_lib->check_session_login();
	}
	public function index()
	{ 
		$this->data_dinas();
	}
	//Begin Profile Dinas
	public function data_dinas()
	{
		$user_id				= $this->session->userdata('loc_user_id');
		$id_kabkot				= $this->session->userdata('loc_id_kabkot');
		$role_id 				= $this->session->userdata('loc_role_id');
		$kabkot 				= $this->session->userdata('loc_id_kabkot');
		$data['role']	 		= $this->session->userdata('loc_role_id');
		$data['data_perda'] 	= $this->Mptsp->getDataPerdaRUU('a.*', $id_kabkot);
		$data['profile_dinas'] 	= $this->Mptsp->getDataDinasProfile('a.*', $id_kabkot);
		$data['dataProtype']	= $this->Mptsp->getDataProtype('a.*', $id_kabkot);	
		if($role_id =='5'){
			$data['result'] 	= $this->Mptsp->getDataAkun($kabkot);
			$data['htable'] = 'Pengawas';
		}else if($role_id =='7'){
			$data['result'] 	= $this->Mptsp->getDataAkun($kabkot);
			$data['htable'] = 'Operator';
		}else{
			$data['result'] 	= $this->Mptsp->getDataAkun($kabkot);
			$data['htable'] = 'Operator';
		}
		$data['content']		= $this->load->view('data_dinas/profile_dinas', $data, TRUE);
		$data['title']			=	'Profile Dinas';
		$data['heading']		=	'';
		$this->load->view('Dbai', $data);
	}

	public function saveDataDinas()
	{
		$id_kabkot			= $this->session->userdata('loc_id_kabkot');
		$id					= $this->input->post('id');
		$p_nama_dinas		= $this->input->post('p_nama_dinas');
		$p_about			= $this->input->post('p_about');
		$p_alamat			= $this->input->post('p_alamat');
		$p_tlp				= $this->input->post('p_tlp');
		$p_email			= $this->input->post('p_email');
		$status_pejabat		= $this->input->post('status_pejabat');
		$kepala_dinas		= $this->input->post('kepala_dinas');
		$nip_kepala_dinas	= $this->input->post('nip_kepala_dinas');	
		$data	= array(
			'id_kabkot' => $id_kabkot,
			'id_dinas' => 1,
			'p_alamat' => $p_alamat,
			'p_tlp' => $p_tlp,
			'p_email' => $p_email,
			'p_nama_dinas' => $p_nama_dinas,
			'status_pejabat' => $status_pejabat,
			'kepala_dinas' => $kepala_dinas,
			'nip_kepala_dinas' => $nip_kepala_dinas,
		);
		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_profile_dinas', $data, 'id', $id);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('Ptsp/data_dinas/#dadi');
		} else {
			$query		= $this->Mglobals->setData('tm_profile_dinas', $data, 'id', $id);
			if ($query) {
				$this->session->set_flashdata('message', 'Biodata User Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Ptsp/data_dinas/#dadi');
			} else {
				$this->session->set_flashdata('message', 'Biodata User Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Ptsp/data_dinas/#dadi');
			}
		}
	}

	//Begin Sub Akun
	public function sub_akun()
	{
		$kabkot = $this->session->userdata('loc_id_kabkot');
		$role_id = $this->session->userdata('loc_role_id');
		// $role_id = 3;
		if($role_id =='5'){
			$data['result'] 	= $this->Mptsp->getDataAkun($kabkot);
			$data['htable'] = 'Pengawas';
		}else if($role_id =='7'){
			$data['result'] 	= $this->Mptsp->getDataPengawas($kabkot);
			$data['htable'] = 'Operator';
		}
		//$data['result'] 		= $this->mglobals->getData($select = '*', 'tm_user', $where, $sort = '', $order = '');
		$data['content']		= $this->load->view('sub_akun/data_sub_akun', $data, TRUE);
		$data['title']			=	'Sub Akun';
		$data['heading']		=	'';
		$this->load->view('template_profil', $data);
	}
	
	private function cekmail($email)
	{
		$email = $email;
		$cekmail = "";
		//$data['gagal'] = "";
		if ($email != "") {
			$temp = $this->Mptsp->get_email($email);
			$user = $this->Mptsp->getEmailUser($email);
			$userdata = $this->Mptsp->getEmailUserData($email);
			if ($temp->num_rows() > 0 || $user->num_rows() > 0 || $userdata->num_rows() > 0) {
				$cekmail = "false";
			} else if ($temp->num_rows() < 1 || $user->num_rows() < 1 || $userdata->num_rows() < 1) {
				$cekmail = "true";
			}
		}
		return $cekmail;
		
	}
	
	private function createdlah($email,$nama,$jabatan)
	{
		$email = $email;
		$nama = $nama;
		$jabatan = $jabatan;
		$kabkot = $this->session->userdata('loc_id_kabkot');
		$role_id = $this->session->userdata('loc_role_id');
		$penginput	= $this->session->userdata('loc_email');
		$len = 8;
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		//$pwdnya = substr( str_shuffle( $chars ), 0, $len );
		$pwdnya	='simbg123ptsp';
		//$role_id = 3;
		switch ($role_id) {
			case 1:
				$child = 4;
				$data['htable'] = 'Eksklusif';
				$max = 999;
				break;
			case 5:
				$child = 7;
				$data['htable'] = 'Pengawas';
				$max = 5;
				break;
			case 6:
				$child = 8;
				$data['htable'] = 'Pengawas';
				$max = 5;
				break;
			case 7:
				$child = 9;
				$data['htable'] = 'Operator';
				$max = 50;
				break;
			case 8:
				$child = 11;
				$data['htable'] = 'Operator';
				$max = 50;
				break;

			default:
				$child = 0;
				$data['htable'] = 'N/A';
				$max = 10;
				break;
		}
		$cekmax = $this->Mptsp->get('tm_user', array('role_id' => $child, 'id_kabkot' => $kabkot))->result_array();
		$aktivation = $nama . '-' . $email;
		$u_password	= sha1($pwdnya . $this->config->item('encryption_key'));
		$cek = $this->Mptsp->get('tm_user', array('username' => $email))->result_array();
		if (count($cek) == 0 && count($cekmax) < $max) {
			$data1 = array(
				'username' => $email,
				'password'=>$u_password,
				'id_kabkot' => $kabkot,
				'role_id' => $child,
				'email' => $email,
				'activation' => sha1($aktivation . $this->config->item('encryption_key')),
				// 'activation' => sha1($nama += $kabkot . $this->config->item('encryption_key'))
				 'post_date'=>date('Y-m-d H:i:s'),
				 'post_by'=>$penginput
			);
			$id_pengguna = $this->Mptsp->createSubAkun('tm_user', $data1);
			// $kd_aktivasi = urlencode($email);
			$kd_aktivasi = sha1($aktivation . $this->config->item('encryption_key'));
			$data = array(
				'email' => $email,
				'nama_lengkap' => $nama,
				'jabatan_dinas' => $jabatan,
				'user_id' => $id_pengguna, // add last insert id to mahasiswa table
				'post_date'=>date('Y-m-d'),
				'post_by'=>$penginput
			);
			$query = $this->Mptsp->createSubAkun('tm_user_data', $data);
			if ($query) {
				//Begin SendEmail
				$subject 	= "Verifikasi User Pengajuan Akses Admin SIMBG | CS SIMBG";
				$link		=  base_url() . "Front/daftar_akun_dinas/$kd_aktivasi";
				$text 		= "";
				$text .= "Yth Bapak/Ibu,<br>";
				$text .= "<br>";
				$text .= "Kami menerima permintaan pembuatan akun untuk mengakses layanan SIMBG Online dengan wewenang sebagai $jabatan. <br><br>";
				$text .= "Akun Anda Sebagi berikut <br>";
				$text .= "&emsp; Email : $email <br>";
				$text .= "&emsp; Kata Sandi : $pwdnya <br><br>";
				$text .= "Silahkan Klik Tautan berikut ini untuk melanjutkan proses -> <a href='$link' >Verifikasi</a> <br>";
				//$text .= "Username Anda Adalah : $email <br>";
				$text .= "<br>";
				$text .= "<br>";
				$text .= "Hormat Kami <br>";
				$text .= "Admin SIMBG ";
				$this->load->library('Simbg_lib');
				$this->simbg_lib->sendEmail($email, $subject, $text);
				//End SendEmail
				// echo "akun dengan email $email berhasil didaftarkan<br>";
				// echo "klik link berikut untuk aktivasi login $link";

				$data_kirimulang = array(
					's_email' => $email,
					's_subject' => $subject,
					's_text' => $text
				);
				
				$this->session->set_userdata('sku', $data_kirimulang); //sku = session kirim ulang

				$this->session->set_flashdata('message', "Akun dengan email $email berhasil didaftarkan. Silahkan buka email yang telah didaftarkan untuk proses aktivasi.");
				$this->session->set_flashdata('status', 'success');
				//redirect('ptsp/sub_akun');
				redirect('Ptsp/data_dinas');
			} else {
				$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				//redirect('front/pendaftaran');
				redirect('Ptsp/data_dinas');
			}
		} elseif (count($cekmax) >= 5) {
			$this->session->set_flashdata('message', 'Tidak bisa menambah akun (max 5 akun),<br>Silahkan hubungi admin kami untuk info lebih lanjut.');
			$this->session->set_flashdata('status', 'danger');
			//redirect('ptsp/sub_akun');
			redirect('Ptsp/data_dinas');
		} else {
			$this->session->set_flashdata('message', 'akun dengan email $email sudah terdaftarkan di System kami.');
			$this->session->set_flashdata('status', 'danger');
			//redirect('ptsp/sub_akun');
			redirect('Ptsp/data_dinas');
		}
	}

	public function create_sub_akun()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email','Email','required|valid_email|max_length[50]');
		$this->form_validation->set_rules('nama','Nama','required|max_length[50]');
		$this->form_validation->set_rules('jabatan','Jabatan','required|max_length[13]');
		
		if($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message', 'Data Gagal di Simpan.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Ptsp/data_dinas');
			
		}else{
			
			$email = $this->input->post('email');
			$nama 	= $this->input->post('nama');
			$jabatan = $this->input->post('jabatan');
			
			$cekmail = $this->cekmail($email);
			
			if ($cekmail == 'false') {
				
				//$this->session->set_flashdata('message', 'Pendaftaran Gagal. ');
				$pesanan = "Pendaftaran Gagal !<br>Email Telah Digunakan";
				$this->session->set_flashdata('message', $pesanan);
				$this->session->set_flashdata('status', 'danger');
				
				redirect('Ptsp/data_dinas');
				
			} else {
				
				$this->createdlah($email,$nama,$jabatan);
				
			}
			
		}
	}

	public function remove_sub_akun($id)
	{
		$process = $this->Mptsp->removeData($id);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Sub Akun Gagal Dihapus.');
			$this->session->set_flashdata('status', 'danger');
		} else {
			$this->session->set_flashdata('message', 'Data Sub Akun Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Ptsp/data_dinas');
	}
	//End Sub Akun
	
	//Begin Simpan Perda RUU-CK
	public function simpanperda()
	{
		$id_kabkot			= $this->session->userdata('loc_id_kabkot');
		$id					= $this->input->post('id_per');
		$urutan				= $this->input->post('urutan');
		$nama_perda			= $this->input->post('nama_perda');
		
		$config = [
			'upload_path' => './dekill/Perda/',
			'allowed_types' => 'pdf|PDF',
			'max_size' => '50000',
			'encrypt_name' =>  TRUE,
			'remove_space' => TRUE,
		];
		$this->load->library('upload', $config);
		if ($id != "") {
			$this->session->set_flashdata('message', 'Data Gagal Disimpan');
			$this->session->set_flashdata('status', 'danger');
			redirect('Ptsp/data_dinas');
		} else {
			if (!$this->upload->do_upload('berkas')) {
				$this->session->set_flashdata('message', $this->upload->display_errors());
				$this->session->set_flashdata('status', 'danger');
				redirect('Ptsp/data_dinas');
			}else{
				$data	= array(
					'id_kabkot' => $id_kabkot,
					'urutan' => $urutan,
					'nama_perda' => $nama_perda,
					'file_perda' => $this->upload->data('file_name'),
				);
				$dataperda	= array(
					'Status_Perda' => '1',
				);
				$query		= $this->mglobals->setData('tmdataperda', $data);
				if($urutan =='2'){
					$query		= $this->mglobals->setData('tm_akun_dinas', $dataperda, 'id_kabkot', $id_kabkot);
				}else{
					
				}
				if ($query) {
					$this->session->set_flashdata('message', 'Data Perda Berhasil di Simpan.');
					$this->session->set_flashdata('status', 'success');
					redirect('Ptsp/data_dinas');
				} else {
					$this->session->set_flashdata('message', 'Data Perda Gagal di Simpan.');
					$this->session->set_flashdata('status', 'danger');
					redirect('Ptsp/data_dinas');
				}
			}
			
		}
	}

	public function editDataPerdaRUU()
	{
		$id_per=$this->input->get('id');
		$data= $this->Mptsp->getDataEditPerdaRUU('a.*', $id_per);
		echo json_encode($data);

	}

	public function removeDataPerda($id_per,$nama_file=null)
	{
		$table = 'tmdataperda';
		$process = $this->mglobals->deleteDataKey($table, 'id_per', $id_per);
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
					$path = FCPATH . '/dekill/Perda/'. $nama_file;
					//$berkas = $path . $this->upload->data('file_name');
					if (!unlink($path)) {
						$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
						$this->session->set_flashdata('status', 'success');
					}else{
						$this->session->set_flashdata('message', 'Data Perda Berhasil di Hapus.');
						$this->session->set_flashdata('status', 'success');
					}
		}
		redirect('Ptsp/data_dinas');

	}
	
	//End Simpan Perda RUU-CK

	public function kirim_ulang()
	{
		$this->load->library('Simbg_lib');
		$id_kirimulang = $this->uri->segment(3);

		if ($id_kirimulang > 1) {
			$query = $this->db->get_where('tm_user',array('id'=>$id_kirimulang));
			if($query->num_rows() > 0) {

				$data_user = $query->row();

				$email	= $data_user->email;
				$link	=  base_url() . "Front/daftar_akun_dinas/$data_user->activation";
				$pwdnya	='simbg123ptsp';
				//$jabatan='';

				$subject 	= "Verifikasi User Pengajuan Akses Admin SIMBG | CS SIMBG";
				$text 		= "";
				$text .= "Yth Bapak/Ibu,<br>";
				$text .= "<br>";
				$text .= "Kami menerima permintaan pembuatan akun untuk mengakses layanan SIMBG Online. <br><br>";
				$text .= "Akun Anda Sebagi berikut <br>";
				$text .= "&emsp; Email : $email <br>";
				$text .= "&emsp; Kata Sandi : $pwdnya <br><br>";
				$text .= "Silahkan Klik Tautan berikut ini untuk melanjutkan proses -> <a href='$link' >Verifikasi</a> <br>";
				$text .= "<br>";
				$text .= "<br>";
				$text .= "Hormat Kami <br>";
				$text .= "Admin SIMBG ";
				$this->simbg_lib->sendEmail($email, $subject, $text);

				$this->session->set_flashdata('message', "Link aktivasi berhasil dikirim ulang. Silahkan buka email $email untuk proses aktivasi.");
				$this->session->set_flashdata('status', 'success');

			}else{

				$this->session->set_flashdata('message', 'Pengiriman Gagal.');
				$this->session->set_flashdata('status', 'danger');
			}


		}else{

			if(!$this->session->userdata('sku')) {

				$this->session->set_flashdata('message', 'Pengiriman Email Gagal.');
				$this->session->set_flashdata('status', 'danger');

			}else{

				$sku = $this->session->userdata('sku');

				$email	= $sku["s_email"];
				$subject= $sku["s_subject"];
				$text	= $sku["s_text"];
				$this->simbg_lib->sendEmail($email, $subject, $text);

				$this->session->set_flashdata('message', "Link aktivasi berhasil terkirim ulang. Silahkan buka email $email untuk proses aktivasi.");
				$this->session->set_flashdata('status', 'success');

			}

		}
		
		redirect('Ptsp/data_dinas');			

	}

	public function delsku(){
		$this->session->unset_userdata('sku');
	}

}
