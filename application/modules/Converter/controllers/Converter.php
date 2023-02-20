<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Converter extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mglobal');
		$this->load->model('Mconverter');
		$this->load->library('Simbg_lib');
		$this->load->helper('utility');
		//$this->load->library('Fpdf');
		//$this->simbg_lib->check_session_login();
	}
	
	public function index()
	{
		if ($this->session->userdata('loc_login') != False) {
			if ($this->session->userdata('loc_role_id') == 9) {
				$this->Operator();
			} else if ($this->session->userdata('loc_role_id') == 5) {
				$this->Verkadis();
			} else if ($this->session->userdata('loc_role_id') == 7) {
				$this->Operator();
			} else {
				$this->session->sess_destroy();
				$this->session->set_flashdata('message', 'Hanya untuk akun Dinas Perizinan.');
				$this->load->view('V_login');
			}
		} else {
			//redirect('Converter/Masuk');
			$this->load->view('V_login');
		}
	}
	
	private function cekLog()
	{ 
		if ($this->session->userdata('loc_convert') != TRUE) {
			$this-> Logout();
		}
	}

	public function Login()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules('emaillogin','Emaillogin','required|max_length[50]|xss_clean');
		$this->form_validation->set_rules('passwordnya','Passwordnya','required|min_length[6]|max_length[20]|xss_clean');
		
		if($this->form_validation->run() == false)
		{
			$this->session->set_flashdata('message', 'Periksa Kembali Data Anda.');
			$this->session->set_flashdata('status', 'danger');
			redirect('Converter');
			
		}else{
			
			$mail	= str_replace("'", "", htmlspecialchars($this->input->post('emaillogin'), ENT_QUOTES));
			$pwd	= str_replace("'", "", htmlspecialchars($this->input->post('passwordnya'), ENT_QUOTES));
			//$this->session->set_flashdata('message', $email);
			//$this->session->set_flashdata('status', 'warning');
			//redirect('Converter');
			$this->LanjutanLogin($mail,$pwd);
				
		}
		
	}
	
	private function LanjutanLogin($mail,$pwd)
	{
		$email	= $mail;
		$password 	= sha1($pwd . $this->config->item('encryption_key'));
		$query	= $this->Mconverter->getLoginData('a.id,a.username,a.email,a.id_kabkot,a.level,a.role_id,a.asosiasi,a.id_asosiasi,b.group,d.dir_file_logo,d.p_nama_dinas', $email, $password);
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
				'loc_convert' => TRUE,
				'loc_login' => TRUE
			);
			$this->session->set_userdata($data);
			redirect('Converter');
		} else {
			$this->session->set_flashdata('message', 'Email atau Kata Sandi tidak sesuai.');
			redirect('Converter');
		}
	}
	
	public function Logout()
	{
		$this->session->sess_destroy();
		redirect('Converter');
	}
	
	private function Operator()
	{
		//redirect('dashboard');
		
		$user_id			= $this->session->userdata('loc_user_id');
		$id_kabkot			= $this->session->userdata('loc_id_kabkot');
		
		$select = 'id_convert,id_prov_bgn,id_kabkot,no_imb,nama_pemilik,alamat_bgn,nama_bgn,fungsi_bgn,keterangan,status,lampiran_imb';
		$table = 'uuck_convert';
		$pk = 'id_convert';
		if($id_kabkot =='31'){
			$dataconvert = $this->mglobals->getData(
				$select,
				$table,
				array('id_prov_bgn' => $id_kabkot ),
				$pk,
				'desc'
			);
		}else{
			$dataconvert = $this->mglobals->getData(
				$select,
				$table,
				array('id_kabkot' => $id_kabkot ),
				$pk,
				'desc'
			);
		}
		$data['dataconvert']	 	= $dataconvert;
		$data['judul']		= '';
		$data['content']	= $this->load->view('V_operator', $data, TRUE);
		$data['title']		= '';
		$data['heading']	= '';
		$this->load->view('V_Converter', $data);
	}
	
	private function Verkadis()
	{
		$user_id			= $this->session->userdata('loc_user_id');
		$id_kabkot			= $this->session->userdata('loc_id_kabkot');
		$select = 'id_convert,id_prov_bgn,id_kabkot,no_imb,nama_pemilik,alamat_bgn,nama_bgn,fungsi_bgn,keterangan,status,lampiran_imb';
		$table = 'uuck_convert';
		$pk = 'id_convert';

		if($id_kabkot =='31'){
			$dataconvert = $this->mglobals->getData(
				$select,
				$table,
				array('id_prov_bgn' => $id_kabkot ),
				$pk,
				'desc'
			);
		}else{
			$dataconvert = $this->mglobals->getData(
				$select,
				$table,
				array('id_kabkot' => $id_kabkot ),
				$pk,
				'desc'
			);
		}
		$data['dataconvert']	 	= $dataconvert;
		$data['judul']		= '';
		$data['content']	= $this->load->view('V_kadis', $data, TRUE);
		$data['title']		= '';
		$data['heading']	= '';
		$this->load->view('V_Converter', $data);

	}
	
	
	function Add(){
		$this-> cekLog();
		$user_id	= $this->session->userdata('loc_user_id');
		$id_kabkot 	= $this->session->userdata('loc_id_kabkot');
		$data['profile_dinas'] 	= $this->Mconverter->getDataDinasProfile('a.*', $id_kabkot);
		$data['provinsi_user'] = $this->Mconverter->getProv('a.*', $id_kabkot);
		if (isset($data['provinsi_user']->nama_kabkota)) {
			$nama_kabkota = $data['provinsi_user']->nama_kabkota;
		};
		if (isset($data['provinsi_user']->id_provinsi)) {
			$provinsi = $data['provinsi_user']->id_provinsi;
		};
		if($id_kabkot =='31'){
			$data['provinsi_nama'] = $this->Mconverter->getnamaProv('a.*', 31);
		}else{
			$data['provinsi_nama'] = $this->Mconverter->getnamaProv('a.*', $provinsi);
		}
		if (isset($data['provinsi_nama']->nama_provinsi)) {
			$nama_provinsi = $data['provinsi_nama']->nama_provinsi;
		};
		$data['id_provinsi']	 	= $provinsi;
		$data['nama_provinsi']	 	= $nama_provinsi;
		$data['id_kabkota'] 		= $this->session->userdata('loc_id_kabkot');
		$data['nama_kabkota']	 	= $nama_kabkota;
		$data['daftar_kecamatan']	= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $id_kabkot);
		$data['content']			= 	$this->load->view('V_add',$data,TRUE);
		$data['title']				=	'';
		$data['heading']			=	'';
		$this->load->view('V_Converter',$data);
	}

	function Add_DKI(){
		$this-> cekLog();
		$user_id	= $this->session->userdata('loc_user_id');
		$id_kabkot 	= $this->session->userdata('loc_id_kabkot');
		$data['profile_dinas'] 	= $this->Mconverter->getDataDinasProfile('a.*', $id_kabkot);
		
		$data['provinsi_user'] = $this->Mconverter->getProv('a.*', $id_kabkot);

		if (isset($data['provinsi_user']->nama_kabkota)) {
			$nama_kabkota = $data['provinsi_user']->nama_kabkota;
		};

		if (isset($data['provinsi_user']->id_provinsi)) {
			$provinsi = $data['provinsi_user']->id_provinsi;
		};

		if($id_kabkot =='31'){
			$data['provinsi_nama'] = $this->Mconverter->getnamaProv('a.*', 31);
		}else{
			$data['provinsi_nama'] = $this->Mconverter->getnamaProv('a.*', $provinsi);
		}
		if (isset($data['provinsi_nama']->nama_provinsi)) {
			$nama_provinsi = $data['provinsi_nama']->nama_provinsi;
		};
		
		$data['id_provinsi']	 	= $id_kabkot;
		$data['nama_provinsi']	 	= $nama_provinsi;
		//$data['id_kabkota'] 		= $this->session->userdata('loc_id_kabkot');
		//$data['nama_kabkota']	 	= $nama_kabkota;
		$data['daftar_kabkota']		= $this->Mglobal->listDataKabkota('a.id_kabkot,a.nama_kabkota', '', $id_kabkot);
		$data['daftar_kecamatan']	= $this->Mglobal->listDataKecamatan('a.id_kecamatan,a.nama_kecamatan', '', $id_kabkot);

		$data['content']			= 	$this->load->view('V_add_Dki',$data,TRUE);
		$data['title']				=	'';
		$data['heading']			=	'';
		$this->load->view('V_Converter',$data);
	}
	

    function saveDataIMB()
    {
        $this->cekLog();
        $id_convert = $this->input->post('id_convert');
        $nama_pemilik = $this->input->post('nama_pemilik');
        $ktp_pemilik = $this->input->post('ktp_pemilik');
        $no_imb = $this->input->post('no_imb');
        $terbit_imb = $this->input->post('terbit_imb');
        $fungsi_bgn = $this->input->post('fungsi_bgn');
        $nama_bgn = $this->input->post('nama_bgn');
        $luas_bgn = $this->input->post('luas_bgn');
        $luas_tanah = $this->input->post('luas_tanah');
        $alamat_bgn = $this->input->post('alamat_bgn');
        $id_prov_bgn = $this->input->post('id_prov_bgn');
        $id_kabkot_bgn = $this->input->post('id_kabkot_bgn');
        $id_kec_bgn = $this->input->post('id_kec_bgn');
        $id_desa_bgn = $this->input->post('id_desa_bgn');
        $retribusi_imb = $this->input->post('retribusi_imb');
        $alamat_pemilik = $this->input->post('alamat_pemilik');
        $nip_kadis = $this->input->post('nip_kadis');
        $nama_kadis = $this->input->post('nama_kadis');

        $lampiran_imb = [
            'upload_path' => './public/uploads/lampiran_convert/',
            'allowed_types' => 'pdf|TPA',
            'max_size' => '54000',
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $this->load->library('upload', $lampiran_imb, 'berkas_imb');
        $lampiran_retribusi = [
            'upload_path' => './public/uploads/lampiran_convert/',
            'allowed_types' => 'pdf|TPA',
            'max_size' => '54000',
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $this->load->library('upload', $lampiran_retribusi, 'berkas_retribusi');
        $lampiran_tanah = [
            'upload_path' => './public/uploads/lampiran_convert/',
            'allowed_types' => 'pdf|TPA',
            'max_size' => '54000',
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $this->load->library('upload', $lampiran_tanah, 'berkas_tanah');
        $lampiran_arsitektur = [
            'upload_path' => './public/uploads/lampiran_convert/',
            'allowed_types' => 'pdf|TPA',
            'max_size' => '54000',
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $this->load->library('upload', $lampiran_arsitektur, 'berkas_arsitektur');

        $lampiran_struktur = [
            'upload_path' => './public/uploads/lampiran_convert/',
            'allowed_types' => 'pdf|TPA',
            'max_size' => '54000',
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $this->load->library('upload', $lampiran_struktur, 'berkas_struktur');


        $lampiran_mep = [
            'upload_path' => './public/uploads/lampiran_convert/',
            'allowed_types' => 'pdf|TPA',
            'max_size' => '54000',
            'encrypt_name' =>  TRUE,
            'remove_space' => TRUE,
        ];
        $this->load->library('upload', $lampiran_mep, 'berkas_mep');

        if (!$this->berkas_imb->do_upload('berkas_imb')) {
            $this->session->set_flashdata('message', $this->berkas_imb->display_errors());
            $this->session->set_flashdata('status', 'danger');
            redirect('Converter');
        } else {
            if ($this->berkas_imb->data('file_ext') != ".pdf" && $this->berkas_imb->data('file_ext') != ".PDF") {
                $this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
                $this->session->set_flashdata('status', 'danger');
                $path = FCPATH . '/public/uploads/lampiran_convert/';
                $berkas = $path . $this->berkas_imb->data('file_name');
                if (!unlink($berkas)) {
                    $this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
                    $this->session->set_flashdata('status', 'warning');
                }
                redirect('Converter');
            } else {
                if (!$this->berkas_retribusi->do_upload('berkas_retribusi')) {
                    $this->session->set_flashdata('message', $this->berkas_retribusi->display_errors());
                    $this->session->set_flashdata('status', 'danger');
                    redirect('Converter');
                } else {
                    if ($this->berkas_retribusi->data('file_ext') != ".pdf" && $this->berkas_retribusi->data('file_ext') != ".PDF") {
                        $this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
                        $this->session->set_flashdata('status', 'danger');
						$path = FCPATH . '/public/uploads/lampiran_convert/';
                        $berkas = $path . $this->berkas_retribusi->data('file_name');
                        if (!unlink($berkas)) {
                            $this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
                            $this->session->set_flashdata('status', 'warning');
                        }
                        redirect('Converter');
                    } else {
                        if (!$this->berkas_tanah->do_upload('berkas_tanah')) {
                            $this->session->set_flashdata('message', $this->berkas_tanah->display_errors());
                            $this->session->set_flashdata('status', 'danger');
                            redirect('Converter');
                        } else {
                            if ($this->berkas_tanah->data('file_ext') != ".pdf" && $this->berkas_tanah->data('file_ext') != ".PDF") {
                                $this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
                                $this->session->set_flashdata('status', 'danger');
								$path = FCPATH . '/public/uploads/lampiran_convert/';
                                $berkas = $path . $this->berkas_tanah->data('file_name');
                                if (!unlink($berkas)) {
                                    $this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
                                    $this->session->set_flashdata('status', 'warning');
                                }
                                redirect('Converter');
                            } else {
                                if (!$this->berkas_arsitektur->do_upload('berkas_arsitektur')) {
                                    $this->session->set_flashdata('message', $this->berkas_arsitektur->display_errors());
                                    $this->session->set_flashdata('status', 'danger');
                                    redirect('Converter');
                                } else {
                                    if ($this->berkas_arsitektur->data('file_ext') != ".pdf" && $this->berkas_arsitektur->data('file_ext') != ".PDF") {
                                        $this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
                                        $this->session->set_flashdata('status', 'danger');
										$path = FCPATH . '/public/uploads/lampiran_convert/';
                                        $berkas = $path . $this->berkas_arsitektur->data('file_name');
                                        if (!unlink($berkas)) {
                                            $this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
                                            $this->session->set_flashdata('status', 'warning');
                                        }
                                        redirect('Converter');
                                    } else {
                                        if (!$this->berkas_struktur->do_upload('berkas_struktur')) {
                                            $this->session->set_flashdata('message', $this->berkas_struktur->display_errors());
                                            $this->session->set_flashdata('status', 'danger');
                                            redirect('Converter');
                                        } else {
                                            if (!$this->berkas_mep->do_upload('berkas_mep')) {
                                                $this->session->set_flashdata('message', $this->berkas_mep->display_errors());
                                                $this->session->set_flashdata('status', 'danger');
                                                redirect('Converter');
                                            } else {
                                                if ($this->berkas_mep->data('file_ext') != ".pdf" && $this->berkas_mep->data('file_ext') != ".PDF") {
                                                    $this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
                                                    $this->session->set_flashdata('status', 'danger');
													$path = FCPATH . '/public/uploads/lampiran_convert/';
                                                    $berkas = $path . $this->berkas_mep->data('file_name');
                                                    if (!unlink($berkas)) {
                                                        $this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
                                                        $this->session->set_flashdata('status', 'warning');
                                                    }
                                                    redirect('Converter');
                                                } else {
                                                    //Generate SK Baru
                                                    $sk_pbg = $this->Sk_baru($id_kec_bgn);
                                                    $data    = array(
                                                        'id_convert' => $id_convert,
                                                        'nama_pemilik' => $nama_pemilik,
                                                        'ktp_pemilik' => $ktp_pemilik,
                                                        'terbit_imb' => date('Y-m-d', strtotime($terbit_imb)),
                                                        'no_imb' => $no_imb,
                                                        'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
                                                        'fungsi_bgn' => $fungsi_bgn,
                                                        'nama_bgn' => $nama_bgn,
                                                        'luas_bgn' => $luas_bgn,
                                                        'luas_tanah' => $luas_tanah,
                                                        'alamat_bgn' => $alamat_bgn,
                                                        'id_prov_bgn' => $id_prov_bgn,
                                                        'id_kabkot_bgn' => $id_kabkot_bgn,
                                                        'id_kec_bgn' => $id_kec_bgn,
                                                        'id_desa_bgn' => $id_desa_bgn,
                                                        'retribusi_imb' => $retribusi_imb,
                                                        'lampiran_imb' => $this->berkas_imb->data('file_name'),
                                                        'lampiran_retribusi' => $this->berkas_retribusi->data('file_name'),
                                                        'lampiran_tanah' => $this->berkas_tanah->data('file_name'),
                                                        'lampiran_arsitektur' => $this->berkas_arsitektur->data('file_name'),
                                                        'lampiran_struktur' => $this->berkas_struktur->data('file_name'),
                                                        'lampiran_mep' => $this->berkas_mep->data('file_name'),
                                                        'keterangan' => 'Verifikasi Kadis',
                                                        'no_sk_baru' => $sk_pbg,
                                                        'alamat_pemilik' => $alamat_pemilik,
                                                        'nama_kadis' => $nama_kadis,
                                                        'nip_kadis' => $nip_kadis,
                                                    );
                                                    $query = $this->mglobals->setData('uuck_convert', $data);
                                                    //Generate QR Code
                                                    $this->load->library('ciqrcode'); //pemanggilan library QR CODE
                                                    $config['imagedir']     = 'public/uploads/lampiran_convert_qrc/'; //direktori penyimpanan qr code
                                                    $config['quality']      = true; //boolean, the default is true
                                                    $config['size']         = '1024'; //interger, the default is 1024
                                                    $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
                                                    $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
                                                    $this->ciqrcode->initialize($config);
                                                    $image_name = $sk_pbg . '.png'; //buat name dari qr code sesuai dengan nim
                                                    $params['data'] = 'https://simbg.pu.go.id/Main/VerifikasiPBG_C/' . $sk_pbg; //data yang akan di jadikan QR CODE
                                                    $params['level'] = 'H'; //H=High
                                                    $params['size'] = 10;
                                                    $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
                                                    $data['QR'] = $this->ciqrcode->generate($params);
                                                    if ($query) {
                                                        $this->session->set_flashdata('message', 'Data Berhasil Disimpan');
                                                        $this->session->set_flashdata('status', 'success');
                                                        redirect('Converter');
                                                    } else {
                                                        $this->session->set_flashdata('message', 'Data Gagal Disimpan');
                                                        $this->session->set_flashdata('status', 'danger');
                                                        redirect('Converter');
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
	
	function saveDataIMBold()
	{
		$this-> cekLog();
		$id_convert = $this->input->post('id_convert');
		$nama_pemilik= $this->input->post('nama_pemilik');
		$ktp_pemilik= $this->input->post('ktp_pemilik');
		$no_imb= $this->input->post('no_imb');
		$terbit_imb= $this->input->post('terbit_imb');
		$fungsi_bgn= $this->input->post('fungsi_bgn');
		$nama_bgn= $this->input->post('nama_bgn');
		$luas_bgn= $this->input->post('luas_bgn');
		$luas_tanah= $this->input->post('luas_tanah');
		$alamat_bgn= $this->input->post('alamat_bgn');
				
		$id_prov_bgn= $this->input->post('id_prov_bgn');
		$id_kabkot_bgn= $this->input->post('id_kabkot_bgn');
		$id_kec_bgn= $this->input->post('id_kec_bgn');
		$id_desa_bgn= $this->input->post('id_desa_bgn');
		$retribusi_imb= $this->input->post('retribusi_imb');
		
		$alamat_pemilik= $this->input->post('alamat_pemilik');
		$nip_kadis= $this->input->post('nip_kadis');
		$nama_kadis= $this->input->post('nama_kadis');
		
		$config = [
			'upload_path' => './public/uploads/lampiran_convert/',
			'allowed_types' => '*',
			'max_size' => '10000',
			'encrypt_name' =>  TRUE,
			'remove_space' => TRUE,
		];
		$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('berkas')) {
				$this->session->set_flashdata('message', $this->upload->display_errors());
				$this->session->set_flashdata('status', 'danger');
				redirect('Converter');
			} else {
				if ($this->upload->data('file_ext') != ".pdf") {
					$this->session->set_flashdata('message', 'Harap Memasukkan Berkas Menggunakan Format PDF!');
					$this->session->set_flashdata('status', 'danger');
					$path = FCPATH . '/public/uploads/lampiran_convert/';
					$berkas = $path . $this->upload->data('file_name');
					if (!unlink($berkas)) {
						$this->session->set_flashdata('message', 'File Lama Hilang atau Rusak!');
						$this->session->set_flashdata('status', 'warning');
					}
					redirect('Converter');
				} else {
					
					//Generate SK Baru
					$sk_pbg = $this->Sk_baru($id_kec_bgn);
					
					$data	= array(
						'id_convert' => $id_convert,
						'nama_pemilik' => $nama_pemilik,
						'ktp_pemilik' => $ktp_pemilik,
						'terbit_imb' => date('Y-m-d', strtotime($terbit_imb)),
						'no_imb' => $no_imb,
						'id_kabkot' => $this->session->userdata('loc_id_kabkot'),
						
						'fungsi_bgn' => $fungsi_bgn,
						'nama_bgn' => $nama_bgn,
						'luas_bgn' => $luas_bgn,
						'luas_tanah' => $luas_tanah,
						'alamat_bgn' => $alamat_bgn,
						
						'id_prov_bgn' => $id_prov_bgn,
						'id_kabkot_bgn' => $id_kabkot_bgn,
						'id_kec_bgn' => $id_kec_bgn,
						'id_desa_bgn' => $id_desa_bgn,
						'retribusi_imb' => $retribusi_imb,
						'lampiran_imb' => $this->upload->data('file_name'),
						'keterangan' => 'Verifikasi Kadis',
						
						'no_sk_baru' => $sk_pbg,
						'alamat_pemilik' => $alamat_pemilik,
						'nama_kadis' => $nama_kadis,
						'nip_kadis' => $nip_kadis,
						
					);
					$query = $this->mglobals->setData('uuck_convert', $data);
					
					//Generate QR Code
					$this->load->library('ciqrcode'); //pemanggilan library QR CODE
					$config['imagedir']     = 'public/uploads/lampiran_convert_qrc/'; //direktori penyimpanan qr code
					$config['quality']      = true; //boolean, the default is true
					$config['size']         = '1024'; //interger, the default is 1024
					$config['black']        = array(224,255,255); // array, default is array(255,255,255)
					$config['white']        = array(70,130,180); // array, default is array(0,0,0)
					$this->ciqrcode->initialize($config);
					$image_name=$sk_pbg.'.png'; //buat name dari qr code sesuai dengan nim
					$params['data'] = 'https://simbg.pu.go.id/Main/VerifikasiPBG_C/'.$sk_pbg; //data yang akan di jadikan QR CODE
					$params['level'] = 'H'; //H=High
					$params['size'] = 10;
					$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
					$data['QR'] = $this->ciqrcode->generate($params);
					
					if ($query) {
						$this->session->set_flashdata('message', 'Data Berhasil Disimpan');
						$this->session->set_flashdata('status', 'success');
						redirect('Converter');
					} else {
						$this->session->set_flashdata('message', 'Data Gagal Disimpan');
						$this->session->set_flashdata('status', 'danger');
						redirect('Converter');
					}
				}
			}
	}
	
	function Detail()
	{
		$this-> cekLog();
		$id = $this->input->get('id');
		$data=$this->Mconverter->cobadetail('a.*', $id);
		echo json_encode($data);
	}
	
	function ValidasiKadis()
	{
		$this-> cekLog();
		$id_convert = $this->input->post('id_convertnya');
		
		if ($id_convert != NULL) {
			
				$data	= array(
					//'id_convert' => $id,
					'keterangan' => 'Telah Terbit',
					'status' => '86',
					//'no_sk_baru' => $sk_baru,
				);
				$query = $this->mglobals->setData('uuck_convert', $data, 'id_convert', $id_convert);
				
				if ($query) {
					$this->session->set_flashdata('message', 'Data Berhasil Diubah');
					$this->session->set_flashdata('status', 'success');
					redirect('Converter');
				} else {
					$this->session->set_flashdata('message', 'Data Gagal Diubah');
					$this->session->set_flashdata('status', 'danger');
					redirect('Converter');
				}
		}else{
				$this->session->set_flashdata('message', 'Data Gagal Diverifikasi');
				$this->session->set_flashdata('status', 'danger');
				redirect('Converter');
		}
		
	}
	
	private function Sk_baru($id_kec_bgn=null)
	{
		//Generate SK Baru
		$lokasi = $id_kec_bgn;
		$tgl_disetujui = date('d').date('m').date('Y');;
		$mydata2 = $this->Mconverter->getNoDrafPbg($lokasi,$tgl_disetujui);
		
	    if(count($mydata2)>0){
	      $no_baru = SUBSTR($mydata2['no_registrasi_baru'],-3)+1;
	    	if ($no_baru < 10){
				$sk_pbg = "SK-PBG-".$lokasi."-".$tgl_disetujui."C00".$no_baru;
	  		}else if ($no_baru < 100){
				$sk_pbg = "SK-PBG-".$lokasi."-".$tgl_disetujui."C0".$no_baru;
	  		}else {
	       		$sk_pbg = "SK-PBG-".$lokasi."-".$tgl_disetujui."C".$no_baru;
	   		}
	    } else {
	    	$sk_pbg = "SK-PBG-".$lokasi."-".$tgl_disetujui."C001";
	    }
		return $sk_pbg;
		
	}
	
	function CetakPBG()
	{
		
		$id = $this->uri->segment(3);
		
		$data['bg'] = $this->Mconverter->getdatacetak('a.*', $id);
		//Begin Dasar Hukum
		$data['uuck'] = $this->Mconverter->undang2ck()->result_array();
		$data['result_per'] = $this->Mconverter->perda($id)->result_array();
		//End Dasar Hukum
        $this->load->view('V_cetak', $data);
		
	}
	
	function CetakFormPbg()
	{
		
		$id = $this->uri->segment(3);
		
		$data['bg'] = $this->Mconverter->getdatacetak('a.*', $id);
		//Begin Dasar Hukum
		$data['uuck'] = $this->Mconverter->undang2ck()->result_array();
		$data['result_per'] = $this->Mconverter->perda($id)->result_array();
		//End Dasar Hukum
        $this->load->view('V_cetak', $data);
		
	}


}
