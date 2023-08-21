<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class ValidasiTeknis extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->helper('utility');
        $this->load->model(array('Mvalidasiteknis', 'mglobal'));
        $this->load->library(array('Simbg_lib'));
        $this->load->model('Mglobal');
        $this->load->model('Mglobals');
		$this->load->library('Oss_lib');
        $this->simbg_lib->check_session_login();
	}
	public function index()
	{
		
	}
    //Begin Validasi Kadis Teknis Bangunan Gedung Baru
    public function VerifikasiDok()
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $SQLcari            = "";
        $data['Kadis']      = $this->Mvalidasiteknis->getListValidasiBangunanBaru();
        $data['title']      =  '';
        $data['heading']    =  '';
        $this->template->load('template/template_backend', 'ValidasiTeknis/ListValidasi', $data);
    }
    public function FormVerifikasiBaru()
    {
        $user_id            = $this->session->userdata('loc_user_id');
        $user_id            = $this->Outh_model->Encryptor('decrypt', $user_id);
        $id                 = $this->input->post('id');
        $tgl_skrg           = date('Y-m-d');
        $data['id']         = $id;
        $DataVal            = $this->Mvalidasiteknis->getdatapermohonan($id)->row_array();
        $imb                = $DataVal['imb'];
        $email              = $DataVal['email'];
        $no_konsultasi      = $DataVal['no_konsultasi'];
        $id_dki             = $DataVal['id_dki'];
        if($id_dki !=1){
            $ttd                = $this->Mvalidasiteknis->get_pejabat($id);
        }else{
            $ttd                = $this->Mvalidasiteknis->get_pejabat_dki($id);
        }
        $ttd_pejabat_sk     = $ttd['kepala_dinas'];
        $nip_kadis_teknis   = $ttd['nip_kepala_dinas'];
        $nm_dinas           = $ttd['p_nama_dinas'];
        $stat_pejabat       = $ttd['status_pejabat'];
        $no_sppst 			= $this->No_Sppst($id);
        $ket                = "Proses masuk Ke Dinas Perizinan Untuk Penagihan Retribusi";
        if (trim($id) != '') {
            $dataStatus = array(
                'status' => 11,
                'id_sk' => 1,
            );
            $datavalidasi   = array(
                'id' => $id,
                'tgl_validasi'  => $tgl_skrg,
                'stat_pejabat'  => $stat_pejabat,
                'nip_kadis'     => $nip_kadis_teknis,
                'nama_kadis'    => $ttd_pejabat_sk,
                'nama_dinas'    => $nm_dinas,
                'no_sppst'      => $no_sppst,
                'stat_sppst'    => '1',
                'post_date'     => $tgl_skrg,
                'post_by'       => $user_id,
            );
            $data       = array(
                'tgl_status' => $tgl_skrg,
                'status' => '11',
                'id' => $id,
                'catatan' => "Telah Selesai di Validasi Kepala Dinas Teknis dan Masuk Ke Proses Penagihan Retribusi",
                'user_id' => $user_id,
                'modul' => 'Validasi Kepala Dinas Teknis'
            );
			$dataPemilik 	= $this->Mvalidasiteknis->getDataVerifikator($id)->row();
            if($dataPemilik->oss_id != '' || $dataPemilik->oss_id != null ){
                $tgl_skrg 		= date('Y-m-d');
                        $kd_status 		= '20';
                        $tgl_status 	= $tgl_skrg;
                        $nama_status 	= 'Pemenuhan Komitmen';
                        $keterangan 	= 'Validasi Kadis Teknis';
                $this->oss_lib->receiveLicenseStatusNew($id,$kd_status,$tgl_status,$nama_status,$keterangan);
            }
            $this->load->library('ciqrcode'); //pemanggilan library QR CODE
			$config['imagedir']     = 'object-storage/dekill/QR_Code/'; //direktori penyimpanan qr code
			$config['quality']      = true; //boolean, the default is true
			$config['size']         = '1024'; //interger, the default is 1024
			$config['black']        = array(224,255,255); // array, default is array(255,255,255)
			$config['white']        = array(70,130,180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			$image_name				= $no_sppst.'.png'; //buat name dari qr code sesuai dengan nim
			$params['data'] 		= 'https://simbg.pu.go.id/Main/Retribusi/'.$no_sppst; //data yang akan di jadikan QR CODE
			$params['level'] 		= 'H'; //H=High
			$params['size'] 		= 10;
			$params['savename'] 	= FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
			$data['QR'] 			= $this->ciqrcode->generate($params);
            $this->Mvalidasiteknis->insertDataValidasi($datavalidasi);
            $this->Mvalidasiteknis->updateProgress($dataStatus, $id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $data);
        }
        $email          = "$email";
        $no_konsultasi  = "$no_konsultasi";
        $ket            = "$ket";
        //$catatan = "$catatan";
        $subject        = "Status Progress Permohonan $no_konsultasi";
        $text           = "";
        $text .= "Yth Bapak/Ibu,<br>";
        $text .= "<br>";
        $text .= "Dengan ini kami memberitahukan bahwa Permohonan dengan No.Registrasi $no_konsultasi <br>";
        $text .= "Dengan keterangan Telah Selesai di Validasi Kepala Dinas Teknis<br>";
        $text .= "Catatan : $ket";
        $text .= "<br>";
        $text .= "<br>";
        $text .= "Hormat Kami <br>";
        $text .= "Admin SIMBG ";
        $this->simbg_lib->sendEmail($email, $subject, $text);
        $this->session->set_flashdata('message', 'Rekomandasi Teknis Terverifikasi');
        $this->session->set_flashdata('status', 'success');
        redirect('ValidasiTeknis/VerifikasiDok');
    }

    function No_Sppst($id=null)
	{
        $que 			= $this->Mvalidasiteknis->get_id_kabkot($id);
		$lokasi 		= $que['id_kec_bgn'];
		$tgl_validasi 	= date('d').date('m').date('Y');
		$mydata2 		= $this->Mvalidasiteknis->getNoDrafSPPST($lokasi,$tgl_validasi);
        if(count($mydata2)>0){ 
            $no_baru = SUBSTR($mydata2['no_registrasi_baru'],-3)+1;
            if ($no_baru < 10){
                $sk_pbg = "SPPST-".$lokasi."-".$tgl_validasi."-00".$no_baru;
            } else if ($no_baru < 99){
				$sk_pbg = "SPPST-".$lokasi."-".$tgl_validasi."-0".$no_baru;
			}else if($no_baru > 100){
				$sk_pbg = "SPPST-".$lokasi."-".$tgl_validasi."-".$no_baru;
			}else{
                $sk_pbg = "SPPST-".$lokasi."-".$tgl_validasi."-".$no_baru;
            }
        } else {
            $sk_pbg = "SPPST-".$lokasi."-".$tgl_validasi."-001";
        }
		return $sk_pbg;
	}

    public function RollbackKadis()
    {
        $id    = $this->uri->segment(3);
        $pernyataan = '1';
        $tgl_skrg     = date('Y-m-d');
        if ($pernyataan == '1') {
            $data    = array(
                'status' => '9',
            );
            $datalog    = [
                'id' => $id,
                'tgl_status' => $tgl_skrg,
                'status' => '5',
                'catatan' => 'Kabid/Kasie melakukan Mengembalikan Permohonan  Ke Tahap Perhitungan Retribusi',
                'modul' => 'Permohonan Dikembalikan ke Tahap Perhitungan Retribusi'
            ];
            $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $this->Mvalidasiteknis->removeDataRetribusi($id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
            $this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Perhitungan Retribusi');
            $this->session->set_flashdata('status', 'success');
        }
        redirect('ValidasiTeknis/VerifikasiDok');
    }
    //End Validasi Kadis Teknis Bangunan Gedung Baru
    //Begin Validasi Kadis Teknis Bangunan Prasarana Baru
    public function VerifikasiPrasarana()
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $SQLcari            = "";
        $data['Kadis']      = $this->Mvalidasiteknis->getListValidasiPrasaranaBaru();
        $data['title']      =  '';
        $data['heading']    =  '';
        $this->template->load('template/template_backend', 'ValidasiTeknis/ListValidasiPrasarana', $data);
    }
    public function FormVerifikasiPrasaranaBaru()
    {
        $user_id            = $this->session->userdata('loc_user_id');
        $user_id            = $this->Outh_model->Encryptor('decrypt', $user_id);
        $id                 = $this->input->post('id');
        $tgl_skrg           = date('Y-m-d');
        $data['id']         = $id;
        $imb                = $DataVal['imb'];
        $email              = $DataVal['email'];
        $no_konsultasi      = $DataVal['no_konsultasi'];
        $id_dki             = $DataVal['id_dki'];
        if($id_dki !=1){
            $ttd            = $this->Mvalidasiteknis->get_pejabat($id);
        }else{
            $ttd            = $this->Mvalidasiteknis->get_pejabat_dki($id);
        }
        $ttd_pejabat_sk     = $ttd['kepala_dinas'];
        $nip_kadis_teknis   = $ttd['nip_kepala_dinas'];
        $nm_dinas           = $ttd['p_nama_dinas'];
        $stat_pejabat       = $ttd['status_pejabat'];
        $no_sppst 			= $this->No_Sppst($id);
        $ket = "Proses masuk Ke Dinas Perizinan Untuk Penagihan Retribusi";
        
        if (trim($id) != '') {
            $dataStatus = array(
                'status' => 11,
                'id_sk' => 1,
            );
            $data    = array(
                'tgl_status'    => $tgl_skrg,
                'status'        => '11',
                'id'            => $id,
                'catatan'       => "Telah Selesai di Validasi Kepala Dinas Teknis dan Masuk Ke Proses Penagihan Retribusi",
                'user_id'       => $user_id,
                'modul'         => 'Validasi Kepala Dinas Teknis'
            );
            $datavalidasi   = array(
                'id' => $id,
                'tgl_validasi'  => $tgl_skrg,
                'stat_pejabat'  => $stat_pejabat,
                'nip_kadis'     => $nip_kadis_teknis,
                'nama_kadis'    => $ttd_pejabat_sk,
                'nama_dinas'    => $nm_dinas,
                'no_sppst'      => $no_sppst,
                'stat_sppst'    => '1',
                'post_date'     => $tgl_skrg,
                'post_by'       => $user_id,
            );
            $this->load->library('ciqrcode'); //pemanggilan library QR CODE
			$config['imagedir']     = 'object-storage/dekill/QR_Code/'; //direktori penyimpanan qr code
			$config['quality']      = true; //boolean, the default is true
			$config['size']         = '1024'; //interger, the default is 1024
			$config['black']        = array(224,255,255); // array, default is array(255,255,255)
			$config['white']        = array(70,130,180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			$image_name				= $no_sppst.'.png'; //buat name dari qr code sesuai dengan nim
			$params['data'] 		= 'https://simbg.pu.go.id/Main/Retribusi/'.$no_sppst; //data yang akan di jadikan QR CODE
			$params['level'] 		= 'H'; //H=High
			$params['size'] 		= 10;
			$params['savename'] 	= FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
			$data['QR'] 			= $this->ciqrcode->generate($params);
            $this->Mvalidasiteknis->insertDataValidasi($datavalidasi);
            $this->Mvalidasiteknis->updateProgress($dataStatus, $id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $data);
        }
        $email          = "$email";
        $no_konsultasi  = "$no_konsultasi";
        $ket            = "$ket";
        //$catatan = "$catatan";
        $subject        = "Status Progress Permohonan $no_konsultasi";
        $text           = "";
        $text .= "Yth Bapak/Ibu,<br>";
        $text .= "<br>";
        $text .= "Dengan ini kami memberitahukan bahwa Permohonan dengan No.Registrasi $no_konsultasi <br>";
        $text .= "Dengan keterangan Telah Selesai di Validasi Kepala Dinas Teknis<br>";
        $text .= "Catatan : $ket";
        $text .= "<br>";
        $text .= "<br>";
        $text .= "Hormat Kami <br>";
        $text .= "Admin SIMBG ";
        $this->simbg_lib->sendEmail($email, $subject, $text);
        $this->session->set_flashdata('message', 'Rekomandasi Teknis Terverifikasi');
        $this->session->set_flashdata('status', 'success');
        redirect('ValidasiTeknis/VerifikasiPrasarana');
    }
    public function RollbackKadisPrasarana()
    {
        $id    = $this->uri->segment(3);
        $pernyataan = '1';
        $tgl_skrg     = date('Y-m-d');
        if ($pernyataan == '1') {
            $data    = array(
                'status' => '9',
            );
            $datalog    = [
                'id' => $id,
                'tgl_status' => $tgl_skrg,
                'status' => '5',
                'catatan' => 'Kabid/Kasie melakukan Mengembalikan Permohonan  Ke Tahap Perhitungan Retribusi',
                'modul' => 'Permohonan Dikembalikan ke Tahap Perhitungan Retribusi'
            ];
            $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $this->Mvalidasiteknis->removeDataRetribusi($id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
            $this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Perhitungan Retribusi');
            $this->session->set_flashdata('status', 'success');
        }
        redirect('ValidasiTeknis/VerifikasiPrasarana');
    }
    //End Validasi Kadis Teknis Bangunan Prasarana Baru
    //Begin Validasi Kadis Teknis Bangunan Gedung Eksisting
    public function VerifikasiEksising()
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $SQLcari            = "";
        $data['Kadis']      = $this->Mvalidasiteknis->getListValidasiBangunanEksisting();
        $data['title']      =  '';
        $data['heading']    =  '';
        $this->template->load('template/template_backend', 'ValidasiTeknis/ListValidasiEksisting', $data);
    }
    public function FormVerifikasiEksisting()
    {
        $user_id            = $this->session->userdata('loc_user_id');
        $user_id            = $this->Outh_model->Encryptor('decrypt', $user_id);
        $id                 = $this->input->post('id');
        $tgl_skrg           = date('Y-m-d');
        $data['id']         = $id;
        $DataVal            = $this->Mvalidasiteknis->getdatapermohonan($id)->row_array();
        $imb                = $DataVal['imb'];
        $email              = $DataVal['email'];
        $no_konsultasi      = $DataVal['no_konsultasi'];
        $id_dki             = $DataVal['id_dki'];
        if($id_dki !=1){
            $ttd            = $this->Mvalidasiteknis->get_pejabat($id);
        }else{
            $ttd            = $this->Mvalidasiteknis->get_pejabat_dki($id);
        }
        $ttd_pejabat_sk     = $ttd['kepala_dinas'];
        $nip_kadis_teknis   = $ttd['nip_kepala_dinas'];
        $nm_dinas           = $ttd['p_nama_dinas'];
        $stat_pejabat       = $ttd['status_pejabat'];
        $no_sppst 			= $this->No_Sppst($id);
        if ($imb != '1') {
            $ket = "Proses masuk Ke Dinas Perizinan Untuk Penagihan Retribusi";
        } else {
            $ket = "Proses masuk Ke Dinas Perizinan Untuk Divalidasi Oleh Kepala Dinas Perizinan";
        }
        if (trim($id) != '') {
            if ($imb != '1') {
                $dataStatus = array(
                    'status'    => 11,
                    'id_sk'     => 1,
                );
                $data    = array(
                    'tgl_status' => $tgl_skrg,
                    'status' => '11',
                    'id' => $id,
                    'catatan' => "Telah Selesai di Validasi Kepala Dinas Teknis dan Masuk Ke Proses Penagihan Retribusi",
                    'user_id' => $user_id,
                    'modul' => 'Validasi Kepala Dinas Teknis'
                );
            } else {
                $dataStatus = array(
                    'status'    => 13,
                    'id_sk'     => 1,
                );
                $data    = array(
                    'tgl_status'    => $tgl_skrg,
                    'status'        => '13',
                    'id'            => $id,
                    'catatan'       => "Telah Selesai di Validasi Kepala Dinas Teknis dan akan di Validasi Kepala Dinas Perizinan",
                    'user_id'       => $user_id,
                    'modul'         => 'Validasi Kepala Dinas Teknis'
                );
            }
            $datavalidasi   = array(
                'id' => $id,
                'tgl_validasi'  => $tgl_skrg,
                'stat_pejabat'  => $stat_pejabat,
                'nip_kadis'     => $nip_kadis_teknis,
                'nama_kadis'    => $ttd_pejabat_sk,
                'nama_dinas'    => $nm_dinas,
                'no_sppst'      => $no_sppst,
                'stat_sppst'    => '1',
                'post_date'     => $tgl_skrg,
                'post_by'       => $user_id,
            );
            $this->load->library('ciqrcode'); //pemanggilan library QR CODE
			$config['imagedir']     = 'object-storage/dekill/QR_Code/'; //direktori penyimpanan qr code
			$config['quality']      = true; //boolean, the default is true
			$config['size']         = '1024'; //interger, the default is 1024
			$config['black']        = array(224,255,255); // array, default is array(255,255,255)
			$config['white']        = array(70,130,180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			$image_name				= $no_sppst.'.png'; //buat name dari qr code sesuai dengan nim
			$params['data'] 		= 'https://simbg.pu.go.id/Main/Retribusi/'.$no_sppst; //data yang akan di jadikan QR CODE
			$params['level'] 		= 'H'; //H=High
			$params['size'] 		= 10;
			$params['savename'] 	= FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
			$data['QR'] 			= $this->ciqrcode->generate($params);
            $this->Mvalidasiteknis->insertDataValidasi($datavalidasi);
            $this->Mvalidasiteknis->updateProgress($dataStatus, $id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $data);
        }
        $email          = "$email";
        $no_konsultasi  = "$no_konsultasi";
        $ket            = "$ket";
        $subject        = "Status Progress Permohonan $no_konsultasi";
        $text           = "";
        $text .= "Yth Bapak/Ibu,<br>";
        $text .= "<br>";
        $text .= "Dengan ini kami memberitahukan bahwa Permohonan dengan No.Registrasi $no_konsultasi <br>";
        $text .= "Dengan keterangan Telah Selesai di Validasi Kepala Dinas Teknis<br>";
        $text .= "Catatan : $ket";
        $text .= "<br>";
        $text .= "<br>";
        $text .= "Hormat Kami <br>";
        $text .= "Admin SIMBG ";
        $this->simbg_lib->sendEmail($email, $subject, $text);
        $this->session->set_flashdata('message', 'Rekomandasi Teknis Terverifikasi');
        $this->session->set_flashdata('status', 'success');
        redirect('ValidasiTeknis/VerifikasiEksising');
    }
    public function RollbackKadisEksis()
    {
        $id             = $this->uri->segment(3);
		$data['id']     = $id;
        $pernyataan     = '1';
        $tgl_skrg       = date('Y-m-d');
		$DataVal        = $this->Mvalidasiteknis->getdatapermohonan($id)->row_array();
        $imb            = $DataVal['imb'];
		
        if ($pernyataan == '1') {
			if($imb == '1'){
				$data    = array(
					'status' => '6',
				);
				 $datalog    = [
					'id' => $id,
					'tgl_status' => $tgl_skrg,
					'status' => '5',
					'catatan' => 'Kabid/Kasie melakukan Mengembalikan Permohonan  Ke Tahap Input Hasil Konsultasi',
					'modul' => 'Permohonan Dikembalikan ke Tahap Perhitungan Retribusi'
				];
			}else{
				$data    = array(
					'status' => '9',
				);
				 $datalog    = [
					'id' => $id,
					'tgl_status' => $tgl_skrg,
					'status' => '5',
					'catatan' => 'Kabid/Kasie melakukan Mengembalikan Permohonan  Ke Tahap Perhitungan Retribusi',
					'modul' => 'Permohonan Dikembalikan ke Tahap Perhitungan Retribusi'
				];
			}
           
            $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $this->Mvalidasiteknis->removeDataRetribusi($id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
            $this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Perhitungan Retribusi');
            $this->session->set_flashdata('status', 'success');
        }
        redirect('ValidasiTeknis/VerifikasiEksising');
    }
    //End Validasi Kadis Teknis Bangunan Gedung Eksisting
    //Begin Validasi Kadis Teknis Bangunan Prasarana Eksisting
    public function VerifikasiPrasaranaEksis()
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $SQLcari            = "";
        $data['Kadis']      = $this->Mvalidasiteknis->getListValidasiBangunanPrasaranaEksisting();
        $data['title']      =  '';
        $data['heading']    =  '';
        $this->template->load('template/template_backend', 'ValidasiTeknis/ListValidasiPrasaranaEksisting', $data);
    }
    public function FormVerifikasiPrasaranaEksisting()
    {
        $user_id            = $this->session->userdata('loc_user_id');
        $user_id            = $this->Outh_model->Encryptor('decrypt', $user_id);
        $id                 = $this->input->post('id');
        $tgl_skrg           = date('Y-m-d');
        $data['id']         = $id;
        $DataVal            = $this->Mvalidasiteknis->getdatapermohonan($id)->row_array();
        $imb                = $DataVal['imb'];
        $email              = $DataVal['email'];
        $no_konsultasi      = $DataVal['no_konsultasi'];
        $id_dki             = $DataVal['id_dki'];
        if($id_dki !=1){
            $ttd                = $this->Mvalidasiteknis->get_pejabat($id);
        }else{
            $ttd                = $this->Mvalidasiteknis->get_pejabat_dki($id);
        }
        $ttd_pejabat_sk     = $ttd['kepala_dinas'];
        $nip_kadis_teknis   = $ttd['nip_kepala_dinas'];
        $nm_dinas           = $ttd['p_nama_dinas'];
        $stat_pejabat       = $ttd['status_pejabat'];
        $no_sppst 			= $this->No_Sppst($id);
        if ($imb != '1') {
            $ket = "Proses masuk Ke Dinas Perizinan Untuk Penagihan Retribusi";
        } else {
            $ket = "Proses masuk Ke Dinas Perizinan Untuk Divalidasi Oleh Kepala Dinas Perizinan";
        }
        if (trim($id) != '') {
            if ($imb != '1') {
                $dataStatus = array(
                    'status'    => 11,
                    'id_sk'     => 1,
                );
                $data    = array(
                    'tgl_status'    => $tgl_skrg,
                    'status'        => '11',
                    'id'            => $id,
                    'catatan'       => "Telah Selesai di Validasi Kepala Dinas Teknis dan Masuk Ke Proses Penagihan Retribusi",
                    'user_id'       => $user_id,
                    'modul'         => 'Validasi Kepala Dinas Teknis'
                );
                $datavalidasi   = array(
                    'id' => $id,
                    'tgl_validasi'  => $tgl_skrg,
                    'stat_pejabat'  => $stat_pejabat,
                    'nip_kadis'     => $nip_kadis_teknis,
                    'nama_kadis'    => $ttd_pejabat_sk,
                    'nama_dinas'    => $nm_dinas,
                    'no_sppst'      => $no_sppst,
                    'stat_sppst'    => '1',
                    'post_date'     => $tgl_skrg,
                    'post_by'       => $user_id,
                );
            } else {
                $dataStatus = array(
                    'status'    => 13,
                    'id_sk'     => 1,
                );
                $data    = array(
                    'tgl_status'    => $tgl_skrg,
                    'status'        => '13',
                    'id'            => $id,
                    'catatan'       => "Telah Selesai di Validasi Kepala Dinas Teknis dan akan di Validasi Kepala Dinas Perizinan",
                    'user_id'       => $user_id,
                    'modul'         => 'Validasi Kepala Dinas Teknis'
                );
                $datavalidasi   = array(
                    'id' => $id,
                    'tgl_validasi'  => $tgl_skrg,
                    'stat_pejabat'  => $stat_pejabat,
                    'nip_kadis'     => $nip_kadis_teknis,
                    'nama_kadis'    => $ttd_pejabat_sk,
                    'nama_dinas'    => $nm_dinas,
                    'no_sppst'      => $no_sppst,
                    'stat_sppst'    => '1',
                    'post_date'     => $tgl_skrg,
                    'post_by'       => $user_id,
                );
            }
            $this->load->library('ciqrcode'); //pemanggilan library QR CODE
			$config['imagedir']     = 'object-storage/dekill/QR_Code/'; //direktori penyimpanan qr code
			$config['quality']      = true; //boolean, the default is true
			$config['size']         = '1024'; //interger, the default is 1024
			$config['black']        = array(224,255,255); // array, default is array(255,255,255)
			$config['white']        = array(70,130,180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			$image_name				= $no_sppst.'.png'; //buat name dari qr code sesuai dengan nim
			$params['data'] 		= 'https://simbg.pu.go.id/Main/Retribusi/'.$no_sppst; //data yang akan di jadikan QR CODE
			$params['level'] 		= 'H'; //H=High
			$params['size'] 		= 10;
			$params['savename'] 	= FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
			$data['QR'] 			= $this->ciqrcode->generate($params);
            $this->Mvalidasiteknis->insertDataValidasi($datavalidasi);
            $this->Mvalidasiteknis->updateProgress($dataStatus, $id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $data);
        }
        $email          = "$email";
        $no_konsultasi  = "$no_konsultasi";
        $ket            = "$ket";
        //$catatan = "$catatan";
        $subject        = "Status Progress Permohonan $no_konsultasi";
        $text           = "";
        $text .= "Yth Bapak/Ibu,<br>";
        $text .= "<br>";
        $text .= "Dengan ini kami memberitahukan bahwa Permohonan dengan No.Registrasi $no_konsultasi <br>";
        $text .= "Dengan keterangan Telah Selesai di Validasi Kepala Dinas Teknis<br>";
        $text .= "Catatan : $ket";
        $text .= "<br>";
        $text .= "<br>";
        $text .= "Hormat Kami <br>";
        $text .= "Admin SIMBG ";
        $this->simbg_lib->sendEmail($email, $subject, $text);
        $this->session->set_flashdata('message', 'Rekomandasi Teknis Terverifikasi');
        $this->session->set_flashdata('status', 'success');
        redirect('ValidasiTeknis/VerifikasiPrasaranaEksis');
    }
    public function RollbackKadisPrasaranaEksis()
    {
        $id    = $this->uri->segment(3);
        $pernyataan = '1';
        $tgl_skrg     = date('Y-m-d');
        if ($pernyataan == '1') {
            $data    = array(
                'status' => '9',
            );
            $datalog    = [
                'id'            => $id,
                'tgl_status'    => $tgl_skrg,
                'status'        => '5',
                'catatan'       => 'Kabid/Kasie melakukan Mengembalikan Permohonan  Ke Tahap Perhitungan Retribusi',
                'modul'         => 'Permohonan Dikembalikan ke Tahap Perhitungan Retribusi'
            ];
            $this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
            $this->Mvalidasiteknis->removeDataRetribusi($id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
            $this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Perhitungan Retribusi');
            $this->session->set_flashdata('status', 'success');
        }
        redirect('ValidasiTeknis/VerifikasiPrasaranaEksis');
    }
    //End Validasi Kadis Teknis Bangunan Prasarana Eksisting
    //Begin Validasi Kadis Teknis Bangunan Pertashop Baru
    public function VerifikasiPertashopBaru() 
    {
        $id_kabkot          = $this->session->userdata('loc_id_kabkot');
        $SQLcari            = "";
        $data['Kadis']      = $this->Mvalidasiteknis->getListValidasiBangunanPertashoBaru();
        $data['title']      =  '';
        $data['heading']    =  '';
        $this->template->load('template/template_backend', 'ValidasiTeknis/ListValidasiPertashopBaru', $data);
    
    }
    public function FormVerifikasiPertaShopBaru()
    {
        $user_id            = $this->session->userdata('loc_user_id');
        $user_id            = $this->Outh_model->Encryptor('decrypt', $user_id);
        $id                 = $this->input->post('id');
        $tgl_skrg           = date('Y-m-d');
        $data['id']         = $id;
        $DataVal            = $this->Mvalidasiteknis->getdatapermohonan($id)->row_array();
        $imb                = $DataVal['imb'];
        $email              = $DataVal['email'];
        $no_konsultasi      = $DataVal['no_konsultasi'];
        $ket                = "Proses masuk Ke Dinas Perizinan Untuk Penagihan Retribusi";
        if (trim($id) != '') {
                $dataStatus = array(
                    'status'    => 11,
                    'id_sk'     => 1,
                );
                $data    = array(
                    'tgl_status' => $tgl_skrg,
                    'status' => '11',
                    'id' => $id,
                    'catatan' => "Telah Selesai di Validasi Kepala Dinas Teknis dan Masuk Ke Proses Penagihan Retribusi",
                    'user_id' => $user_id,
                    'modul' => 'Validasi Kepala Dinas Teknis'
                );
            $this->Mvalidasiteknis->updateProgress($dataStatus, $id);
            $this->Mglobals->setDatakol('th_data_konsultasi', $data);
        }
        $email = "$email";
        $no_konsultasi = "$no_konsultasi";
        $ket    = "$ket";
        //$catatan = "$catatan";
        $subject     = "Status Progress Permohonan $no_konsultasi";
        $text         = "";
        $text .= "Yth Bapak/Ibu,<br>";
        $text .= "<br>";
        $text .= "Dengan ini kami memberitahukan bahwa Permohonan dengan No.Registrasi $no_konsultasi <br>";
        $text .= "Dengan keterangan Telah Selesai di Validasi Kepala Dinas Teknis<br>";
        $text .= "Catatan : $ket";
        $text .= "<br>";
        $text .= "<br>";
        $text .= "Hormat Kami <br>";
        $text .= "Admin SIMBG ";
        $this->simbg_lib->sendEmail($email, $subject, $text);
        $this->session->set_flashdata('message', 'Rekomandasi Teknis Terverifikasi');
        $this->session->set_flashdata('status', 'success');
        redirect('ValidasiTeknis/VerifikasiPertashopBaru');
    }
    //End Validasi Kadis Teknis Bangunan Pertashop Baru
    public function Catatan($id = null)
    {
        $id                     = $this->uri->segment(3);
        $data['id']             = $id;
        $data['DataBangunan']   = $this->Mvalidasiteknis->getcatatan('a.catatan', $id);
        $this->load->view('kosong', $data);
    }
}
 