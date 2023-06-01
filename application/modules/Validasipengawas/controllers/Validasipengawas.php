<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Validasipengawas extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('utility');
		$this->load->model('MValidasipengawas');
		$this->load->library('Simbg_lib');
		$this->load->library('Oss_lib');
		$this->simbg_lib->check_session_login();
	}

	function index(){

	}
	//Begin Validasi Pembayaran Retribusi Oleh Pengawas Dinas Perizinan 
	public function ValPembayaran()
	{
		$id_kabkot    = $this->session->userdata('loc_id_kabkot');
        $SQLcari     = "";
        $data['ssrd'] = $this->MValidasipengawas->getListSSRD(null, $SQLcari);
        $data['title']        =    '';
        $data['heading']    =    '';
        $this->template->load('template/template_backend', 'Validasipengawas/ListValPembayaran', $data);
	}
	
	public function FormValidasiRetribusi()
	{
		$id = $this->uri->segment(3);
		$data['id'] = $id;
		$query 			= $this->MValidasipengawas->getDataPemilik($id);
		$data['data'] 	= $query->row();
		$querybangunan 	= $this->MValidasipengawas->getDataBangunan($id);
		$data['databgn'] 	= $querybangunan->row();
		$getTotalRetribusi 	= $this->MValidasipengawas->getTotalRetribusi($id);
		$total = $getTotalRetribusi->num_rows() > 0 ? $getTotalRetribusi->row()->nilai_retribusi_keseluruhan : 0;
		$data['total_retribusi'] = $total;
		$data['retribusi'] = $this->MValidasipengawas->getRetribusi($id)->row();
		if($this->input->post('save_ssrd')) {
			if ($this->input->post('status_validasi_cetak') == 1) {
				$sk_pbg = $this->Sk_PBG($id);
				$tgl_sk_pbg = date('Y-m-d');
				$status_validasi_cetak = $this->input->post('status_validasi_cetak');
				$dataInKonsultasi = array(
					'id' => $id,
					'no_izin_pbg' => $sk_pbg,
					'tgl_pbg' => $tgl_sk_pbg,
					'validasi_retri'=>$this->input->post('status_validasi_cetak')
				);
				$dataStatus = array(
					'status' => 13,
				);
				$this->MValidasipengawas->updateProgress($dataStatus,$id);
				$this->MValidasipengawas->insertDataPenerbitanPbg($dataInKonsultasi);
				$this->load->library('ciqrcode'); //pemanggilan library QR CODE
				$config['imagedir']     = 'dekill/QR_Code/'; //direktori penyimpanan qr code
				$config['quality']      = true; //boolean, the default is true
				$config['size']         = '1024'; //interger, the default is 1024
				$config['black']        = array(224,255,255); // array, default is array(255,255,255)
				$config['white']        = array(70,130,180); // array, default is array(0,0,0)
				$this->ciqrcode->initialize($config);
				$image_name=$sk_pbg.'.png'; //buat name dari qr code sesuai dengan nim
				$params['data'] = 'https://simbg.pu.go.id/Main/VerifikasiPBG/'.$sk_pbg; //data yang akan di jadikan QR CODE
				$params['level'] = 'H'; //H=High
			 	$params['size'] = 10;
			 	$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
				$data['QR'] = $this->ciqrcode->generate($params);
				$id_bayar = $this->input->post('id_bayar');
				$keterangan='';
				$dataUn = array (
					 'validasi_retri' =>'1',
					 'tgl_validasi'  =>date('Y-m-d H:i:s'),
					 'id_pemvalidasi'=>$this->session->userdata('loc_user_id'),
					 'ket3'=> $keterangan
				);
				$this->MValidasipengawas->update_Penagihan($dataUn,$id_bayar);
				$this->session->set_flashdata('message','SSRD Berhasil Disimpan.');
				$this->session->set_flashdata('status','success');
			}
			redirect('Validasipengawas/ValPembayaran/'.$id);
		}
		$this->load->view('FormValidasiPembayaran', $data);
	} 
	
	function Sk_PBG($id=null)
	{
	    $que = $this->MValidasipengawas->get_id_kabkot($id);
			$lokasi = $que['id_kec_bgn'];
			$tgl_disetujui = date('d').date('m').date('Y');
			$mydata2 = $this->MValidasipengawas->getNoDrafPbg($lokasi,$tgl_disetujui);
	    if(count($mydata2)>0){
	      $no_baru = SUBSTR($mydata2['no_registrasi_baru'],-2)+1;
	    	if ($no_baru < 10){
				$sk_pbg = "SK-PBG-".$lokasi."-".$tgl_disetujui."-00".$no_baru;
	  		} else {
	       		$sk_pbg = "SK-PBG-".$lokasi."-".$tgl_disetujui."-".$no_baru;
	   		}
	    } else {
	    	$sk_pbg = "SK-PBG-".$lokasi."-".$tgl_disetujui."-001";
	    }
		return $sk_pbg;
	}
	//End Validasi SSRD
	//Begin Validasi Kadis Untuk PBG Bangunan Baru
	public function ValidasiKadis()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Kadis'] = $this->MValidasipengawas->getListValidasi(null,$SQLcari);
		$data['content']	= $this->load->view('Validasi/ListValidasi',$data,TRUE);
		$data['title']		=	'Data Validasi Kepala Dinas';
		$data['heading']	=	'';
		$this->template->load('template/template_backend', 'Penerbitan/Validasi/ListValidasi', $data);
	}
	//End Validasi Kadis Untuk PBG Bangunan Baru
	//Begin Validasi Kadis Untuk Bangunan Eksisting
	public function ValidasiSlf()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Kadis'] = $this->MValidasipengawas->getListValidasiSLF(null,$SQLcari);
		$data['content']	= $this->load->view('Validasi/ListValidasiSLF',$data,TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
	}
	//End Validasi Kadis Untuk Bangunan Eksisting

	public function ValidasiSLFBG()// Validasi SLF Bangunan Baru
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Kadis'] = $this->MValidasipengawas->getDataValidasi(null,$SQLcari);
		$data['content']	= $this->load->view('Validasi/ListValidasiSLFBG',$data,TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
	}
	
	Public function ValidasiForm()
	{
		$id = $this->input->post('id');
		$data['id'] = $id;
		$ttd = $this->MValidasipengawas->getPejabatTtd($id);
		$ttd_pejabat_sk = $ttd['kepala_dinas'];
		$nip_pejabat_sk = $ttd['nip_kepala_dinas'];
		$status_pejabat = $ttd['status_pejabat'];
		if (trim($id) != '') {
			$tgl_log = date('Y-m-d');
			$keterangan = 'IMB Terverivikasi Kadis';
			$nama_fb = 'Hasil Sidang';
			$kode_feedback = '50';
			$data_log = array (
				'id' => $id,
				'tgl_log_permohonan' => $tgl_log,
				'keterangan' => $keterangan,
				'kode_proses' => 17,
				'post_date' => $tgl_log,
				'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			//$this->kirim_email_validasi($id);		
			$dataStatus = array(
				'status' => 15,
			);
			$datavalidasi	= array(
				'nm_kadis' => $ttd_pejabat_sk,
				'nip_kadis' => $nip_pejabat_sk,
				'status_pejabat' => $status_pejabat
			);
			$this->MValidasipengawas->updateProgress($dataStatus,$id);
			$this->MValidasipengawas->updateValidasi($datavalidasi,$id);
		}
		$this->session->set_flashdata('message','PBG Terverifikasi');
		$this->session->set_flashdata('status','success');
		redirect('Penerbitan/ValidasiKadis');
	}

	Public function ValidasiFormEks()
	{
		$id = $this->input->post('id');
		$data['id'] = $id;
		$ttd = $this->MValidasipengawas->getPejabatTtd($id);
		$ttd_pejabat_sk = $ttd['kepala_dinas'];
		$nip_pejabat_sk = $ttd['nip_kepala_dinas'];
		$status_pejabat = $ttd['status_pejabat'];
		if (trim($id) != '') {
			/*$tgl_log = date('Y-m-d');
			$keterangan = 'IMB Terverivikasi Kadis';
			$nama_fb = 'Hasil Sidang';
			$kode_feedback = '50';
			$data_log = array (
				'id' => $id,
				'tgl_log_permohonan' => $tgl_log,
				'keterangan' => $keterangan,
				'kode_proses' => 17,
				'post_date' => $tgl_log,
				'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);*/
			//$this->kirim_email_validasi($id);		
			$dataStatus = array(
				'status' => 15,
			);
			$datavalidasi	= array(
				'nm_kadis' => $ttd_pejabat_sk,
				'nip_kadis' => $nip_pejabat_sk,
				'status_pejabat' => $status_pejabat
			);
			$this->MValidasipengawas->updateProgress($dataStatus,$id);
			$this->MValidasipengawas->updateValidasi($datavalidasi,$id);
		}
		$this->session->set_flashdata('message','Dokumen Telah Terverifikasi');
		$this->session->set_flashdata('status','success');
		redirect('Penerbitan/ValidasiSlf');
	}

	Public function ValidasiFormSLF()
	{
		$id = $this->input->post('id');
		$data['id'] = $id;
		if (trim($id) != '') {
			$tgl_log = date('Y-m-d');
			$keterangan = 'IMB Terverivikasi Kadis';
			$nama_fb = 'Hasil Sidang';
			$kode_feedback = '50';
			$data_log = array (
				'id' => $id,
				'tgl_log_permohonan' => $tgl_log,
				'keterangan' => $keterangan,
				'kode_proses' => 17,
				'post_date' => $tgl_log,
				'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			//$this->kirim_email_validasi($id);		
			$dataStatus = array(
				'status' => 21,
			);
			$this->MValidasipengawas->updateProgress($dataStatus,$id);
		}
		$this->session->set_flashdata('message','SLF Dapat Diserahkan');
		$this->session->set_flashdata('status','success');
		redirect('Penerbitan/ValidasiSLFBG');
	}
	//End Validasi Kadis
	//Begin Penyerahan Draf PBG
	public function PenyerahanList()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Draft'] = $this->MValidasipengawas->getListPenyerahan(null,$SQLcari);
		$data['content']	= $this->load->view('Penyerahan/ListPenyerahan',$data,TRUE);
		$data['title']		=	'Daftar List Penyerahan Dokumen PBG';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
	}
	
	public function Penyerahan ()
	{
		$id = $this->input->get('id');
		$data= $this->MValidasipengawas->getTerbitPBG('a.*,b.nm_pemilik',$id);
		echo json_encode($data);
	}
	
	public function PenyerahanForm()
	{
		$id = $this->input->post('x_id_p');
		$cat = $this->input->post('x_cat_p');
		$nama_p = $this->input->post('x_penerima');
		if (trim($id) != '') {
			$tgl_log = date('Y-m-d');
			$keterangan = 'IMB Terbit';
			$nama_fb = 'Hasil Sidang';
			$kode_feedback = '50';
			$data_log = array (
				'id' => $id,
				'tgl_log_permohonan' => $tgl_log,
				'keterangan' => $keterangan,
				'kode_proses' => 16,
				'post_date' => $tgl_log,
				'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			//$this->imb_model->insert_log_permohonan($data_log);
			//feedback to oss
			//$feedback = $this->oss_lib->receiveLicense($id,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
			$dataPbg = array (
				'id' => $id,
				'tanggal_penyerahan' => $tgl_log,
				'catatan' => $cat,
				'nama_penerima' => $nama_p,
				'post_date' => $tgl_log,
				'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			$this->MValidasipengawas->SimpanPenyerahan($dataPbg);				
			//$this->kiriminlagi_email($id_permohonan,$nama_p,$tgl_log);				
			$dataStatus = array(
				'status' => 17,
			);
			$this->MValidasipengawas->updateProgress($dataStatus,$id);
		}
		$this->session->set_flashdata('message','PBG Telah Telah Diserahkan');
		$this->session->set_flashdata('status','success');
		redirect('Penerbitan/PenyerahanList');	
	}
	//End Penyerahan Draf PBG
	//Begin Penyerahan Draft SLF
	public function PenyerahanDok()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Draft'] = $this->MValidasipengawas->getListPenyerahanSlf(null,$SQLcari);
		$data['content']	= $this->load->view('Penyerahan/ListPenyerahanSlf',$data,TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
	}

	public function PenyerahanSLF()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Draft'] = $this->MValidasipengawas->getListPenyerahanSlfEks(null,$SQLcari);
		$data['content']	= $this->load->view('Penyerahan/ListPenyerahanSlf',$data,TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
	}
	
	public function PenyerahanDokumen ()
	{
		$id = $this->input->get('id');
		$data= $this->MValidasipengawas->getTerbitPBG('a.*,b.nm_pemilik',$id);
		echo json_encode($data);
	}
	
	public function PenyerahanFormDok()
	{
		$id = $this->input->post('x_id_p');
		$cat = $this->input->post('x_cat_p');
		$nama_p = $this->input->post('x_penerima');
		$tgl_log = date('Y-m-d');
		if (trim($id) != '') {
			//$this->imb_model->insert_log_permohonan($data_log);
			$dataPbg = array (
				'id' => $id,
				'tanggal_penyerahan' => $tgl_log,
				'catatan' => $cat,
				'nama_penerima' => $nama_p,
				'post_date' => $tgl_log,
				'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			$this->MValidasipengawas->SimpanPenyerahanDok($dataPbg);				
			$dataStatus = array(
				'status' => 21,
			);
			$this->MValidasipengawas->updateProgress($dataStatus,$id);
		}
		$this->session->set_flashdata('message','Dokumen Telah Telah Diserahkan');
		$this->session->set_flashdata('status','success');
		redirect('Penerbitan/PenyerahanDok');	
	}

	public function PenyerahanDokEks()
	{
		$id = $this->input->post('x_id_p');
		$cat = $this->input->post('x_cat_p');
		$nama_p = $this->input->post('x_penerima');
		$tgl_log = date('Y-m-d');
		if (trim($id) != '') {
			//$this->imb_model->insert_log_permohonan($data_log);
			$dataPbg = array (
				'id' => $id,
				'tanggal_penyerahan' => $tgl_log,
				'catatan' => $cat,
				'nama_penerima' => $nama_p,
				'post_date' => $tgl_log,
				'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			$this->MValidasipengawas->SimpanPenyerahanDok($dataPbg);				
			$dataStatus = array(
				'status' => 21,
			);
			$this->MValidasipengawas->updateProgress($dataStatus,$id);
		}
		$this->session->set_flashdata('message','Dokumen Telah Telah Diserahkan');
		$this->session->set_flashdata('status','success');
		redirect('Penerbitan/PenyerahanSLF');	
	}
	//End Penyerahan Draft SLF
	//Begin Penyerahan Dokumen SLF+SBKBG
	public function PenyerahanSBKBG()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Draft'] = $this->MValidasipengawas->getListPenyerahanSBKBG(null,$SQLcari);
		$data['content']	= $this->load->view('Penyerahan/ListPenyerahanSBKBG',$data,TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
	}

	public function PenyerahanFormSLF()
	{
		$id = $this->input->post('x_id_p');
		$cat = $this->input->post('x_cat_p');
		$nama_p = $this->input->post('x_penerima');
		$tgl_log = date('Y-m-d');
		if (trim($id) != '') {
			$dataPbg = array (
				'id' => $id,
				'tanggal_penyerahan' => $tgl_log,
				'catatan' => $cat,
				'nama_penerima' => $nama_p,
				'post_date' => $tgl_log,
				'post_by' => $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			$this->MValidasipengawas->SimpanPenyerahanDok($dataPbg);				
			$dataStatus = array(
				'status' => 21,
			);
			$this->MValidasipengawas->updateProgress($dataStatus,$id);
		}
		$this->session->set_flashdata('message','Dokumen Telah Telah Diserahkan');
		$this->session->set_flashdata('status','success');
		redirect('Penerbitan/PenyerahanSBKBG');	
	}
	//End Penyerahan Dokumen SLF+SBKBG
	//Begin Dokumen SLF Bangunan Baru
	public function CetakPersetujuanBangunanGedung()
    {
		$id = $this->uri->segment(3);
		$DataVal = $this->MValidasipengawas->getdatabg($id)->row_array();
        $id_izin = $DataVal['id_izin'];
        $id_fungsi = $DataVal['id_fungsi_bg'];
		$data['pg'] = $this->MValidasipengawas->getdatapemilikDok($id);
		$data['bg'] = $this->MValidasipengawas->getdatabangunanDok($id);
		//Begin Data Tanah
		$tanah = $this->MValidasipengawas->datatanah($id);
		$data['result_tanah'] = $tanah->result_array();
		$data['count_tanah'] = $tanah->num_rows();
		//End Data Tanah
		$datajns    = $this->MValidasipengawas->getDataVerifikasi($id);
        $fg_bg      = $datajns['id_fungsi_bg'];
        $jns_bg     = $datajns['id_jns_bg'];
        $id_prasarana = $datajns['id_prasarana_bg'];

		if($id_izin == '4' || $id_izin == '3'){
            //$data['fungsi'] = $this->Mpemeriksaan->getDataFungsi($fg_bg, $jns_bg);
        }else if($id_izin == '5'){
            $data['fungsi'] = $this->MValidasipengawas->getDataFungsiPrasarana($id_prasarana);
        }else{
            if($id_fungsi =='6'){
                $data['fungsi'] = $this->MValidasipengawas->getDataFungsiCampuran($fg_bg);
            }else{
                $data['fungsi'] = $this->MValidasipengawas->getDataFungsi($fg_bg, $jns_bg);
            }
        } 
		//Begin Dasar Hukum
		$data['uuck'] = $this->MValidasipengawas->undang2ck()->result_array();
		$data['result_per'] = $this->MValidasipengawas->perda($id)->result_array();
		//End Dasar Hukum
        $this->load->view('Validasi/DokumenPBG', $data);
    }
	//End Dokumen SLF Bangunan Baru
	//Begin Dokumen SLF Bangunan Eksisting
	public function CetakSertifikatLaikFungsi()
	{
		$id = $this->uri->segment(3);
		$DataVal = $this->MValidasipengawas->getdatabg($id)->row_array();
        $id_izin = $DataVal['id_izin'];
		$imb 	 = $DataVal['imb'];
		$fg_bg      = $DataVal['id_fungsi_bg'];
        $jns_bg     = $DataVal['id_jns_bg'];		
		$data['pg'] = $this->MValidasipengawas->getdatapemilikDok($id);
		$data['bg'] = $this->MValidasipengawas->getdatabangunanDokSLF($id);
		if($id_izin == '4' || $id_izin == '3'){
            //$data['fungsi'] = $this->Mpemeriksaan->getDataFungsi($fg_bg, $jns_bg);
        }else if($id_izin == '2'){

		}else{
            $data['fungsi'] = $this->MValidasipengawas->getDataFungsi($fg_bg, $jns_bg);
        }
		//Begin Data Tanah
		$tanah = $this->MValidasipengawas->datatanah($id);
		$data['result_tanah'] = $tanah->result_array();
		$data['count_tanah'] = $tanah->num_rows();
		//End Data Tanah
		$data['uuck'] = $this->MValidasipengawas->undang2ck()->result_array();
		$data['result_per'] = $this->MValidasipengawas->perda($id)->result_array();
		if($imb =='1'){
			$this->load->view('Validasi/DokumenSLF', $data);
		}else{
			$this->load->view('Validasi/DokumenPBGSLF', $data);
		}
	}
	//End Dokumen SLF Bangunan Eksisting
	public function Rollback() 
    {
        $id	= $this->uri->segment(3);
		$pernyataan = '1';
		$tgl_skrg 	= date('Y-m-d');
		if ($pernyataan == '1') {
			$data	= array(
				'status' => '10',
			);
			$datalog	= [
				'id' => $id,
				'tgl_status' => $tgl_skrg,
				'status' => '11',
				'catatan' => 'Operator melakukan Mengembalikan Permohonan ke Tahap Validasi Kepala Dinas Teknis',
				'modul' => 'Permohonan Dikembalikan ke Tahap Validasi Kepala Dinas Teknis'
			];
			$this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
			$this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
			$this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Validasi Kepala Dinas Teknis');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Penerbitan/SKRD' );
    }

	public function RollbackSSRD() 
    {
        $id	= $this->uri->segment(3);
		$pernyataan = '1';
		$tgl_skrg 	= date('Y-m-d');
		if ($pernyataan == '1') {
			$data	= array(
				'status' => '11',
			);
			$datalog	= [
				'id' => $id,
				'tgl_status' => $tgl_skrg,
				'status' => '11',
				'catatan' => 'Pengawas melakukan Mengembalikan Permohonan ke Tahap Penagihan Retribusi',
				'modul' => 'Permohonan Dikembalikan ke Tahap Penagihan Retribusi'
			];
			$this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
			$this->MValidasipengawas->removeDataBayar($id);
			$this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
			$this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Penagihan Retribusi');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Penerbitan/SSRD' );
    }

	public function RollbackKadis() 
    {
        $id	= $this->uri->segment(3);
		$pernyataan = '1';
		$tgl_skrg 	= date('Y-m-d');
		if ($pernyataan == '1') {
			$data	= array(
				'status' => '12',
			);
			$datalog	= [
				'id' => $id,
				'tgl_status' => $tgl_skrg,
				'status' => '6',
				'catatan' => 'Kabid/Kasie melakukan Mengembalikan Permohonan  Ke Tahap Validasi Pembayaran',
				'modul' => 'Permohonan Dikembalikan ke Tahap Validasi Pembayaran'
			];
			$this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
			$this->MValidasipengawas->removeDataSK($id);
			$this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
			$this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Perhitungan Retribusi');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Penerbitan/ValidasiKadis' );
    }

	public function RollSKRD() 
    {
        $id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$this->load->view('SKRD/kosong', $data);
    }

	public function SimpanPengembalianRetri()
	{
		$id				= $this->uri->segment(3);
		$id				= $this->input->post('id');
		$catatan 		= $this->input->post('catatan');
		$tgl_skrg 		= date('Y-m-d');
		$data	= array(
			'id'			=> $id,
			'status'		=> 10,
			'catatan'		=> $catatan
		);
		$datalog	= [
			'id' => $id,
			'tgl_status' => $tgl_skrg,
			'status' => '11',
			'catatan' => $catatan,
			'modul' => 'Permohonan Dikembalikan ke Tahap Validasi Kepala Dinas Teknis'
		];
		$this->Mglobals->setData('tmdatabangunan', $data, 'id', $id);
		$this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
		$this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Validasi Kepala Dinas Teknis');
		$this->session->set_flashdata('status', 'success');
		redirect('Penerbitan/SKRD' );
	}

}