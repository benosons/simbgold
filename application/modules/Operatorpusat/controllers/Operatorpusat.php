<?php defined('BASEPATH') or exit('No direct script access allowed');

class Operatorpusat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('utility');
        $this->load->model(array('Moperatorpusat', 'mglobal'));
        $this->load->library(array('Simbg_lib', 'Oss_lib'));
        $this->load->model('Mglobal');
        $this->load->model('Mglobals');
        $this->simbg_lib->check_session_login();
    }
    //Begin Kirim Ulang Email Bagi Pemohon yang tidak mendapatkan Notifikasi
    public function Kirimulang()
    {
        $SQLcari     = "";
        $data = [
            'title' => '',
            'heading' => '',
            'User' => !isset($_GET['cari']) ? $this->Moperatorpusat->getDataTempUser(null, $SQLcari)->result() : $search,
        ];
        $this->template->load('template/template_backend', 'Email/KirimUlang', $data);
    }
    public function KirimEmail()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$query 				= $this->Moperatorpusat->getDataEmail($id);
		$data['data'] 		= $query->row();
		$this->load->view('Email/FormEmail', $data);
	}

    public function Kirim_Ulang_Email()
    {
        $id	= $this->input->post('id');
		$email = $this->input->post('email');
        //$email = 'ming.clan07@gmail.com';
        if($this->input->post('xstileng')) {
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
            $this->simbg_lib->sendEmailPendaftaran($email, $subject, $text);
			
			//$this->simbg_lib->sendEmail($email, $subject, $text);
			$this->session->set_flashdata('message','Selesai Kirim Ulang');
			$this->session->set_flashdata('status','success');
			redirect('Operatorpusat/Kirimulang');
        }
    }
    public function Kirim_Ulang_Email_Reset()
    {
        $id	= $this->input->post('id');
		$email = 'ming.clan07@gmail.com';
        //$email = $this->input->post('email');
        if($this->input->post('xstileng')) {
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
			$this->simbg_lib->sendEmailPendaftaran($email, $subject, $text);
			$this->session->set_flashdata('message','Selesai Kirim Ulang');
			$this->session->set_flashdata('status','success');
			redirect('Operatorpusat/Kirimulang');
        }
    }
    //End Kirim Ulang Email Bagi Pemohon yang tidak mendapatkan Notifikasi
    //Begin Kirim Ulang Email Bagi Akun Dinas Perizinan maupun Teknis
    public function EmailDinas()
    {
        $SQLcari     = "";
        $data = [
            'title' => '',
            'heading' => '',
            'User' => !isset($_GET['cari']) ? $this->Moperatorpusat->getDataUserDinas(null, $SQLcari)->result() : $search,
        ];
        $this->template->load('template/template_backend', 'Email/KirimUlangDinas', $data);
    }
    public function KirimEmailDinas()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$query 				= $this->Moperatorpusat->getDataEmailDinas($id);
		$data['data'] 		= $query->row();
		$this->load->view('Email/FormEmailDinas', $data);
	}
    public function Kirim_Ulang_Email_Dinas()
    {
        $id	= $this->input->post('id');
		$email = 'ming.clan07@gmail.com';
        $password = $this->input->post('password');
        //$password2 	= $this->secure->decrypt_url($password);
        if($this->input->post('xstileng')) {
            //$linknya	=	base_url() . "Front/verfikasi_user/" . sha1($email . $this->config->item('encryption_key'));
            $textnya	=	"Yth Bapak/Ibu,<br><br>
							Kami menerima permintaan pembuatan akun untuk mengakses layanan SIMBG <br>
							Jika anda merasa melakukan pengajuan pembuatan akun SIMBG Silahkan Klik Tautan
							
							Username Anda Adalah    : $email <br><br>
                            Password                : $password <br><br>
							Hormat Kami <br> Admin SIMBG";
			$subject 	=	"Verifikasi User Pengajuan Permohonan IMB | CS SIMBG";
			//$text		=	"User Name"; $email;
			//$text 		= 	"Password"; $password2;
			$this->simbg_lib->sendEmail($email, $subject, $text);
			$this->session->set_flashdata('message','Selesai Kirim Ulang');
			$this->session->set_flashdata('status','success');
			redirect('Operatorpusat/EmailDinas');
        }
    }
    //End Kirim Ulang Email Bagi Akun Dinas Perizinan maupun Teknis
    //Begin Hapus Bangunan Eksisting
    public function Deleteeksis()
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $data['id_kabkot']  =
        $SQLcari            = "";
        $data['Delete']      = $this->Moperatorpusat->getListDelEksisIMB(null, $SQLcari);
        $data['title']      =    '';
        $data['heading']    =    '';
        $this->template->load('template/template_backend', 'Delete/ListDeleteEksis', $data);
        //$this->template->load('template/template_backend', 'Email/KirimUlang', $data);
    }
    public function FormDeleteEksis()
    {
        $id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$query 				= $this->Moperatorpusat->getDataPermohonan($id);
		$data['data'] 		= $query->row();
		$this->load->view('Delete/FormDeleteEksis', $data);
    }
    public function UpdateHapusEksis() 
    {
        $id = $this->input->post('id');
        $user_id		= $this->session->userdata('loc_user_id');
        $tgl_skrg 		= date('Y-m-d');
		$update = [
			'status' => 26
		];
        $data =[
            'id' => $id,
            'no_konsultasi' => $no_konsultasi,
            'post_by' => $user_id,
            'post_date' => $tgl_skrg,
        ];

        if($this->input->post('xstileng')) {
            $this->Moperatorpusat->updateHapus($id, $update);
            $this->Mglobals->setDatakol('th_hapus_permohonan', $data);
            $this->session->set_flashdata('message', 'Data Berhasil DiHapus');
            $this->session->set_flashdata('status', 'success');
            redirect('Operatorpusat/Deleteeksis');  
        }
    }
    //End Hapus Bangunan Eksisting
    //Begin Hapus Bangunan Baru
    public function Deletebangunan()
    {
        $nobobo = $this->uri->segment(3);
		$no_registrasi = str_replace("'", "", htmlspecialchars($nobobo, ENT_QUOTES));
        $SQLcari            = "";
        if (trim($no_registrasi) != '') {
			$SQLcari .= " AND a.no_konsultasi = '$no_registrasi' ";
		}else{
            $SQLcari .= " AND a.no_konsultasi = '000-000-0000-000' ";
        }
		$query = $this->Moperatorpusat->getRegistrasi($SQLcari);
        $data['title']          =  '';
        $data['heading']        =  '';
        $this->template->load('template/template_backend', 'Delete/FormDelete', $data);
    }

    public function Delete()
	{
		$data = "";
		$nobobo = $this->uri->segment(3);
		$no_registrasi = str_replace("'", "", htmlspecialchars($nobobo, ENT_QUOTES));
		$SQLcari = "";
		if (trim($no_registrasi) != '') {
			$SQLcari .= " AND a.no_konsultasi = '$no_registrasi' ";
		}
		$query = $this->Moperatorpusat->getRegistrasi($SQLcari);
		$mydata = $query->row_array();
		$baris = $query->num_rows();

		if ($no_registrasi != "") {
			if ($baris >= 1) {
				$i = 1;
				foreach ($query->result() as $row) {
					$data .= '<tr>
					<td>' . $i . '</td>
					<td>' . $row->no_konsultasi . '</td>
					<td>' . $row->nm_pemilik . '</td>
                    <td>' . $row->nm_konsultasi . '</td>
					<td>' . $row->almt_bgn . '</td>
                    <td>' . '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data=' . $row->id . '>Hapus</a> '. ' </td>							
					</tr>';
				}
				echo $data;
            } else {
				$fix = "Nomor Registrasi Tidak Ditemukan";
				$data2 = '<tr><td colspan="4" align="center">' . $fix . '</td></tr>';
				echo $data2;
			}
		}
	}

    function Pilih_Hapus(){
		$id	= $this->input->get('kode');
        $data	= array(
            'status' => '27',  
        );
        $this->Mglobals->setData('tmdatabangunan', ['status' => $data['status']], 'id', $id);
		
		if (!$process) {
			$this->session->set_flashdata('message', 'Data Gagal Dihapus.');
			$this->session->set_flashdata('status', 'error');
		} else {
			
			$this->session->set_flashdata('message', 'Data Berhasil di Hapus.');
			$this->session->set_flashdata('status', 'success');
		}
	}
    //End Hapus Bangunan Baru
    //Begun Validasi Kadis Teknis Bangunan Eksisting Belum memiliki IMB
    public function Valeksis()
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $data['id_kabkot']  =
        $SQLcari            = "";
        $data['Kadis']      = $this->Mkadintek->getListValBangunan(null, $SQLcari);
        $data['content']    = $this->load->view('ListValidasiBaru', $data, TRUE);
        $data['title']      =    '';
        $data['heading']    =    '';
        $this->template->load('template/template_backend', 'Kadintek/ListValidasiBaru', $data);
    }
    //End  Validasi Kadis Teknis Bangunan Eksisting Belum memiliki IMB
    /* End of file OperatorPusat.php */
}
