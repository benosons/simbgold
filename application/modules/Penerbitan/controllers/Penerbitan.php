<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Penerbitan extends CI_Controller {
	public function __construct() {
		parent::__construct();
		ini_set('memory_limit', "4096M");
		$this->load->helper('utility');
		$this->load->model('MPenerbitan');
		$this->load->library('Simbg_lib');
		$this->load->library('Oss_lib');
		//$this->simbg_lib->check_session_login();
	}
	function index(){

	}
	//Begin Validasi Kadis Untuk PBG Bangunan Baru
	public function ValidasiKadis()
	{
		$id_kabkot			= $this->session->userdata('loc_id_kabkot');
		$SQLcari 			= "";
		$data['Kadis'] 		= $this->MPenerbitan->getListValidasi(null,$SQLcari);
		$data['content']	= $this->load->view('Validasi/ListValidasi',$data,TRUE);
		$data['title']		=	'Data Validasi Kepala Dinas';
		$data['heading']	=	'';
		$this->template->load('template/template_backend', 'Penerbitan/Validasi/ListValidasi', $data);
	}
	public function CetakPersetujuanBangunanGedung2()
    {
		$id 		= $this->uri->segment(3);
		$DataVal 	= $this->MPenerbitan->getdatabg($id)->row_array();
        $id_izin 	= $DataVal['id_izin'];
        $id_fungsi 	= $DataVal['id_fungsi_bg'];
		$data['pg'] = $this->MPenerbitan->getdatapemilikDok($id);
		$data['bg'] = $this->MPenerbitan->getdatabangunanDok($id);
		$tgl_skrg   = date('Y-m-d');
			
		$sk_pbg 	= $this->SK_PBG($id);
		$data['sk']	= $sk_pbg;
		//Begin Data Tanah
		$tanah 		= $this->MPenerbitan->datatanah($id);
		$data['result_tanah'] = $tanah->result_array();
		$data['count_tanah'] = $tanah->num_rows();
		//End Data Tanah
		$datajns    = $this->MPenerbitan->getDataVerifikasi($id);
        $fg_bg      = $datajns['id_fungsi_bg'];
        $jns_bg     = $datajns['id_jns_bg'];
        $id_prasarana = $datajns['id_prasarana_bg'];
		if($id_izin == '4' || $id_izin == '3'){
            //$data['fungsi'] = $this->Mpemeriksaan->getDataFungsi($fg_bg, $jns_bg);
        }else if($id_izin == '5'){
            $data['fungsi'] = $this->MPenerbitan->getDataFungsiPrasarana($id_prasarana);
        }else{
            if($id_fungsi =='6'){
                $data['fungsi'] = $this->MPenerbitan->getDataFungsiCampuran($fg_bg);
            }else{
                $data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
            }
        } 
		//Begin Dasar Hukum
		$data['uuck'] = $this->MPenerbitan->undang2ck()->result_array();
		$data['result_per'] = $this->MPenerbitan->perda($id)->result_array();
		//End Dasar Hukum
        $this->load->view('Validasi/DokumenPBG', $data);
    }
	Public function ValidasiForm()
	{
		$id 			= $this->input->post('id');
		$data['id'] 	= $id;
		$ttd 			= $this->MPenerbitan->getPejabatTtd($id);
		$ttd_pejabat_sk = $ttd['kepala_dinas'];
		$nip_pejabat_sk = $ttd['nip_kepala_dinas'];
		$status_pejabat = $ttd['status_pejabat'];
		$tgl_validasi 	= date('Y-m-d');
		$sk_pbg 		= $this->SK_PBG($id);
		if (trim($id) != '') {
			$tgl_log = date('Y-m-d');
			$keterangan = 'IMB Terverivikasi Kadis';
			$nama_fb = 'Hasil Sidang';
			$kode_feedback = '50';
			$data_log = array (
				'id' 					=> $id,
				'tgl_log_permohonan' 	=> $tgl_log,
				'keterangan' 			=> $keterangan,
				'kode_proses' 			=> 17,
				'post_date' 			=> $tgl_log,
				'post_by' 				=> $this->session->userdata('loc_username') ? $this->session->userdata('loc_username') : 'System Apps'
			);
			$dataStatus = array(
				'status' => 15,
			);
			$datavalidasi	= array(
				'nm_kadis' 			=> $ttd_pejabat_sk,
				'nip_kadis' 		=> $nip_pejabat_sk,
				'tgl_pbg'			=> $tgl_validasi,
				'no_izin_pbg' 		=> $sk_pbg,
				'status_pejabat' 	=> $status_pejabat,
			);
			$cek = $this->MPenerbitan->cekNamaNoIzin('a.id,a.no_izin_pbg', $sk_pbg);
			if ($cek->num_rows() > 0) {
				$this->session->set_flashdata('message', 'Silahkan Ulangi Validasi Persetujuan Bangunan Gedung!!!');
				$this->session->set_flashdata('status', 'danger');
				redirect('Penerbitan/ValidasiKadis/');
			} else {
				$query		= $this->Mglobals->setData('tmdatapbg', $datavalidasi, 'id', $id);
				//$this->MPenerbitan->updateProgress($dataStatus,$id);
				//$this->MPenerbitan->updateValidasi($datavalidasi,$id);
				if ($query) {
					$this->MPenerbitan->updateProgress($dataStatus,$id);
					$this->load->library('ciqrcode'); //pemanggilan library QR CODE
					$config['imagedir']     = 'object-storage/dekill/QR_Code/'; //direktori penyimpanan qr code
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
				
					$this->session->set_flashdata('message', 'Berhasil Di Validasi Oleh Kepala Dinas');
					$this->session->set_flashdata('status', 'success');

					redirect('Penerbitan/ValidasiKadis');
				} else {
					$this->session->set_flashdata('message', 'Data Menu Gagal di Simpan.');
					$this->session->set_flashdata('status', 'danger');
					redirect('Penerbitan/ValidasiKadis/');
				}
			}
			//$this->MPenerbitan->updateProgress($dataStatus,$id);
			//$this->MPenerbitan->updateValidasi($datavalidasi,$id);
		}
		$querybangunan 	= $this->MPenerbitan->getDataBangunan($id)->row();
			$dataBangunan = array(
				'id_komitmen' => $querybangunan->id_komitmen,
				'luas_bangunan_disetujui' => $querybangunan->luas_bgn,
				'jumlah_lantai_disetujui' => $querybangunan->jml_lantai,
				'tinggi_bangunan_disetujui' => $querybangunan->tinggi_bgn,
				'luas_basement_disetujui' => $querybangunan->luas_basement,
				'jumlah_lantai_basement_disetujui' => $querybangunan->lapis_basement
			);
			
		$getnomor_izin = $this->MPenerbitan->getDataPbg($id)->row();
		$nomor_izin = $getnomor_izin->no_izin_pbg;
		$dataIZIN = array(
				'nama_ttd' => $ttd_pejabat_sk,
				'nip_ttd' => $nip_pejabat_sk,
				'nomor_izin' => $nomor_izin,
				'tgl_terbit_izin' => $tgl_log,
				'tgl_berlaku_izin' => $tgl_log,
				'status_izin' => '50',
				'file_izin' => 'https://simbg.pu.go.id/Penerbitan/CetakPersetujuanBangunanGedung/'.$id,
				'file_lampiran' => 'https://simbg.pu.go.id/Penerbitan/CetakPersetujuanBangunanGedung/'.$id,
				'keterangan' => 'Izin Telah Terbit',
				'data_teknis' => $dataBangunan
			);
		$this->oss_lib->receiveLicenseNew($id,$dataIZIN);
			
		$this->session->set_flashdata('message','PBG Terverifikasi');
		$this->session->set_flashdata('status','success');
		redirect('Penerbitan/ValidasiKadis');
	}
	function SK_PBG($id=null)
	{
        $que            = $this->MPenerbitan->get_id_kabkot($id);
		$lokasi         = $que['id_kec_bgn'];
		$tgl_disetujui  = date('d').date('m').date('Y');
		$mydata2        = $this->MPenerbitan->getNoDrafPbg($lokasi,$tgl_disetujui);
        if(count($mydata2)>0){
            $no_baru = SUBSTR($mydata2['no_registrasi_baru'],-3)+1;
            if ($no_baru < 10){
                $sk_pbg = "SK-PBG-".$lokasi."-".$tgl_disetujui."-00".$no_baru;
            } else if ($no_baru < 99){
				$sk_pbg = "SK-PBG-".$lokasi."-".$tgl_disetujui."-0".$no_baru;
			}else if($no_baru > 100){
				$sk_pbg = "SK-PBG-".$lokasi."-".$tgl_disetujui."-".$no_baru;
			}else{
                $sk_pbg = "SK-PBG-".$lokasi."-".$tgl_disetujui."-".$no_baru;
            }
        } else {
            $sk_pbg = "SK-PBG-".$lokasi."-".$tgl_disetujui."-001";
        }
		return $sk_pbg;
	}
	//End Validasi Kadis Untuk PBG Bangunan Baru
	//Begin Validasi Kadis Untuk Bangunan Eksisting
	public function ValidasiSlf()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Kadis'] = $this->MPenerbitan->getListValidasiSLF(null,$SQLcari);
		$data['content']	= $this->load->view('Validasi/ListValidasiSLF',$data,TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
	}
	Public function ValidasiFormEks()
	{
		$id 			= $this->input->post('id');
		$data['id'] 	= $id;
		$ttd 			= $this->MPenerbitan->getPejabatTtd($id);
		$status_imb	 	= $ttd['imb'];
		$ttd_pejabat_sk = $ttd['kepala_dinas'];
		$nip_pejabat_sk = $ttd['nip_kepala_dinas'];
		$status_pejabat = $ttd['status_pejabat'];
		$tgl_validasi 	= date('Y-m-d');
		$sk_pbg 		= $this->SK_PBG($id);
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
				'nm_kadis' 			=> $ttd_pejabat_sk,
				'nip_kadis' 		=> $nip_pejabat_sk,
				'tgl_pbg'			=> $tgl_validasi,
				'no_izin_pbg' 		=> $sk_pbg,
				'status_pejabat' 	=> $status_pejabat,
			);
			if($status_imb !='1'){
				$cek = $this->MPenerbitan->cekNamaNoIzin('a.id,a.no_izin_pbg', $sk_pbg);
				if ($cek->num_rows() > 0) {
					$this->session->set_flashdata('message', 'Silahkan Ulangi Validasi Persetujuan Bangunan Gedung!!!');
					$this->session->set_flashdata('status', 'danger');
					redirect('Penerbitan/ValidasiSlf/');
				} else {
					$query		= $this->Mglobals->setData('tmdatapbg', $datavalidasi, 'id', $id);
					//$this->MPenerbitan->updateProgress($dataStatus,$id);
					//$this->MPenerbitan->updateValidasi($datavalidasi,$id);
					if ($query) {
						$this->MPenerbitan->updateProgress($dataStatus,$id);
						$this->load->library('ciqrcode'); //pemanggilan library QR CODE
						$config['imagedir']     = 'object-storage/dekill/QR_Code/'; //direktori penyimpanan qr code
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
					
						$this->session->set_flashdata('message', 'Berhasil Di Validasi Oleh Kepala Dinas');
						$this->session->set_flashdata('status', 'success');

						redirect('Penerbitan/ValidasiSlf');
					} else {
						$this->session->set_flashdata('message', 'Silahkan di Ulangi Kembali Validasi');
						$this->session->set_flashdata('status', 'danger');
						redirect('Penerbitan/ValidasiSlf/');
					}
				}
			}else{
				$this->MPenerbitan->updateProgress($dataStatus,$id);
				$this->MPenerbitan->updateValidasi($datavalidasi,$id);
				$this->session->set_flashdata('message','Dokumen Telah Terverifikasi');
				$this->session->set_flashdata('status','success');
				redirect('Penerbitan/ValidasiSlf');
			}
			
			/*$this->MPenerbitan->updateProgress($dataStatus,$id);
			$this->MPenerbitan->updateValidasi($datavalidasi,$id);*/
		}
		/*$this->session->set_flashdata('message','Dokumen Telah Terverifikasi');
		$this->session->set_flashdata('status','success');*/
		redirect('Penerbitan/ValidasiSlf');
	}
	//End Validasi Kadis Untuk Bangunan Eksisting
	public function ValidasiSLFBG()// Validasi SLF Bangunan Baru
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Kadis'] = $this->MPenerbitan->getDataValidasi(null,$SQLcari);
		$data['content']	= $this->load->view('Validasi/ListValidasiSLFBG',$data,TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm',$data);
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
			$this->MPenerbitan->updateProgress($dataStatus,$id);
		}
		$this->session->set_flashdata('message','SLF Dapat Diserahkan');
		$this->session->set_flashdata('status','success');
		redirect('Penerbitan/ValidasiSLFBG');
	}
	//End Validasi Kadis
	//Begin Penyerahan Dokumen SLF+SBKBG
	public function PenyerahanSBKBG()
	{
		$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		$data['Draft'] = $this->MPenerbitan->getListPenyerahanSBKBG(null,$SQLcari);
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
			$this->MPenerbitan->SimpanPenyerahanDok($dataPbg);				
			$dataStatus = array(
				'status' => 21,
			);
			$this->MPenerbitan->updateProgress($dataStatus,$id);
		}
		$this->session->set_flashdata('message','Dokumen Telah Telah Diserahkan');
		$this->session->set_flashdata('status','success');
		redirect('Penerbitan/PenyerahanSBKBG');	
	}
	//End Penyerahan Dokumen SLF+SBKBG
	//Begin Dokumen SLF Bangunan Baru
	public function CetakSertifikatLaikFungsiBaru()
	{
		$id 		= $this->uri->segment(3);
		$DataVal 	= $this->MPenerbitan->getdatabg($id)->row_array();
		$tgl_skrg   = date('Y-m-d');
        $id_izin 	= $DataVal['id_izin'];
		$imb 	 	= $DataVal['imb'];
		$fg_bg      = $DataVal['id_fungsi_bg'];
        $jns_bg     = $DataVal['id_jns_bg'];
		$id_slf     = $DataVal['permohonan_slf'];
		$id_prasarana = $DataVal['id_prasarana_bg'];		
		$data['pg'] = $this->MPenerbitan->getdatapemilikDok($id);
		$data['bg'] = $this->MPenerbitan->getdatabangunanDokSLF($id);
		if($id_izin == '4' || $id_izin == '3'){
            //$data['fungsi'] = $this->Mpemeriksaan->getDataFungsi($fg_bg, $jns_bg);
        }else if($id_izin == '2'){
			if($id_slf =='1'){
				if($fg_bg =='6'){
					$data['fungsi'] = $this->MPenerbitan->getDataFungsiCampuran($fg_bg);
				}else{
					$data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
				}
			}else if($id_slf =='1'){
				if($fg_bg =='6'){
					$data['fungsi'] = $this->MPenerbitan->getDataFungsiCampuran($fg_bg);
				}else{
					$data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
				}
			}else{
				
			}
        
		}else if($id_izin == '5'){
			$data['fungsi'] = $this->MPenerbitan->getDataFungsiPrasarana($id_prasarana);
		}else{ 
            $data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
        }
		//Begin Data Tanah
		$tanah = $this->MPenerbitan->datatanah($id);
		$data['result_tanah'] = $tanah->result_array();
		$data['count_tanah'] = $tanah->num_rows();
		//End Data Tanah
		$data['uuck'] = $this->MPenerbitan->undang2ck()->result_array();
		$data['result_per'] = $this->MPenerbitan->perda($id)->result_array();
		
			$this->load->view('Validasi/DokumenSLF', $data);
		
	}
	
	//End Dokumen SLF Bangunan Baru
	//Begin Dokumen SLF Bangunan Eksisting
	public function CetakSertifikatLaikFungsi()
	{
		$id 		= $this->uri->segment(3);
		$DataVal 	= $this->MPenerbitan->getdatabg($id)->row_array();
		$tgl_skrg   = date('Y-m-d');
        $id_izin 	= $DataVal['id_izin'];
		$imb 	 	= $DataVal['imb'];
		$fg_bg      = $DataVal['id_fungsi_bg'];
        $jns_bg     = $DataVal['id_jns_bg'];
		$id_slf     = $DataVal['permohonan_slf'];
		$id_prasarana = $DataVal['id_prasarana_bg'];		
		$data['pg'] = $this->MPenerbitan->getdatapemilikDok($id);
		$data['bg'] = $this->MPenerbitan->getdatabangunanDokSLF($id);
		if($id_izin == '4' || $id_izin == '3'){
            //$data['fungsi'] = $this->Mpemeriksaan->getDataFungsi($fg_bg, $jns_bg);
        }else if($id_izin == '2'){
			if($id_slf =='1'){
				if($fg_bg =='6'){
					$data['fungsi'] = $this->MPenerbitan->getDataFungsiCampuran($fg_bg);
				}else{
					$data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
				}
			}else if($id_slf =='1'){
				if($fg_bg =='6'){
					$data['fungsi'] = $this->MPenerbitan->getDataFungsiCampuran($fg_bg);
				}else{
					$data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
				}
			}else{
				
			}
        
		}else if($id_izin == '5'){
			$data['fungsi'] = $this->MPenerbitan->getDataFungsiPrasarana($id_prasarana);
		}else{ 
            $data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
        }
		//Begin Data Tanah
		$tanah = $this->MPenerbitan->datatanah($id);
		$data['result_tanah'] = $tanah->result_array();
		$data['count_tanah'] = $tanah->num_rows();
		//End Data Tanah
		$data['uuck'] = $this->MPenerbitan->undang2ck()->result_array();
		$data['result_per'] = $this->MPenerbitan->perda($id)->result_array();
		if($imb =='1'){
			$this->load->view('Validasi/DokumenSLF', $data);
		}else if($imb =='0'){
			$this->load->view('Validasi/DokumenPBGSLF', $data);
		}else{
			$this->load->view('Validasi/DokumenPBGSLF', $data);
		}
	}
	//End Dokumen SLF Bangunan Eksisting
	
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
			$this->MPenerbitan->removeDataSK($id);
			$this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
			$this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Perhitungan Retribusi');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('Penerbitan/ValidasiKadis' );
    }

	//Begin Dokumen Persetujuan Bangunan Gedung dan Lampiran
	public function CetakPersetujuanBangunanGedung()
    {
			$id             = $this->uri->segment(3);
			$DataVal 		= $this->MPenerbitan->getdatabg($id)->row_array();
			$id_izin 		= $DataVal['id_izin'];
			$id_fungsi 		= $DataVal['id_fungsi_bg'];
			$fg_bg      	= $DataVal['id_fungsi_bg'];
			$jns_bg     	= $DataVal['id_jns_bg'];
			$id_prasarana 	= $DataVal['id_prasarana_bg'];
			$status_eksis	= $DataVal['permohonan_slf'];
			$id_sk			= $DataVal['id_sk'];
			$tgl_skrg       = date('Y-m-d');
			$data['pg'] 	= $this->MPenerbitan->getdatapemilikBangunan($id);
			$data['bg'] 	= $this->MPenerbitan->getdatabangunanGedung($id);
			//Begin Data Tanah
			$tanah 					= $this->MPenerbitan->getDataTanah($id);
			$data['result_tanah'] 	= $tanah->result_array();
			$data['count_tanah'] 	= $tanah->num_rows();
			//End Data Tanah
			//Begin Dasar Hukum
			$data['uuck'] 			= $this->MPenerbitan->undang2ck()->result_array();
			$data['result_per'] 	= $this->MPenerbitan->perda($id)->result_array();
			//End Dasar Hukum
			if($id_sk == '1'){ //Pemanggilan SK PBG dan Sudah Lampiran
				if($id_izin == '1'){ // Bangunan Baru
					if($id_fungsi == '6'){ // Fungsi campuran
						$data['fungsi'] = $this->MPenerbitan->getDataFungsiCampuran($fg_bg);
						$this->load->view('Validasi/SKdanLampiran', $data);
					}else{
						$data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
						//$this->load->view('Validasi/DokumenPBG', $data);
						$this->load->view('Validasi/SKdanLampiran', $data);
					}
				}else if($id_izin == '2'){ // Bangunan Eksisting
					if($status_eksis =='1'){// Bangunan Gedung
						$data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
						$this->load->view('Validasi/SkdanLampiran', $data);
					}else if($status_eksis =='2'){ // Bangunan Prasarana
						$data['fungsi'] = $this->MPenerbitan->getDataFungsiPrasarana($id_prasarana);
						$this->load->view('Validasi/SKdanLampiran', $data);
					}else if($status_eksis =='3'){ // Bangunan PertaShop
						$data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
						$this->load->view('Validasi/SkdanLampiran', $data);
					}else{
						$data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
						$this->load->view('Validasi/SKdanLampiran', $data);
					}
				}else if($id_izin == '3'){ // Bangunan Gedung Perubahan
					if($id_fungsi == '6'){ // Fungsi campuran
						$data['fungsi'] = $this->MPenerbitan->getDataFungsiCampuran($fg_bg);
						$this->load->view('Validasi/SKdanLampiran', $data);
					}else{
						$data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
						$this->load->view('Validasi/SKdanLampiran', $data);
					}
				}else if($id_izin == '4'){ // Bangunan Kolektif 
					$data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
					$this->load->view('Validasi/SKdanLampiran', $data);
				}else if($id_izin == '5'){ // Bangunan Prasarana
					$data['fungsi'] = $this->MPenerbitan->getDataFungsiPrasarana($id_prasarana);
					$this->load->view('Validasi/SKdanLampiran', $data);
				}else if($id_izin == '6'){ // Bangunan Cagar Budaya
					if($id_fungsi == '6'){ // Fungsi campuran
						$data['fungsi'] = $this->MPenerbitan->getDataFungsiCampuran($fg_bg);
						$this->load->view('Validasi/SKdanLampiran', $data);
					}else{
						$data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
						$this->load->view('Validasi/SKdanLampiran', $data);
					}
				}else if($id_izin == '7'){ // Bangunan PertaShop
					$data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
					$this->load->view('Validasi/SKdanLampiran', $data);
				}else if($id_izin == '8'){ // Bangunan Bertahap
					if($id_fungsi == '6'){ // Fungsi campuran
						$data['fungsi'] = $this->MPenerbitan->getDataFungsiCampuran($fg_bg);
						$this->load->view('Validasi/SKdanLampiran', $data);
					}else{
						$data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
						$this->load->view('Validasi/SKdanLampiran', $data);
					}
				}
			}else{ //Pemanggilan SK PBG dan Belum Lampiran
				if($id_izin == '4' || $id_izin == '3'){
					//$data['fungsi'] = $this->Mpemeriksaan->getDataFungsi($fg_bg, $jns_bg);
					$this->load->view('Validasi/DokumenPBGNew', $data);
				}else if($id_izin == '5'){
					$data['fungsi'] = $this->MPenerbitan->getDataFungsiPrasarana($id_prasarana);
					$this->load->view('Validasi/DokumenPBGNew', $data);
				}else{
					if($id_fungsi =='6'){
						$data['fungsi'] = $this->MPenerbitan->getDataFungsiCampuran($fg_bg);
						$this->load->view('Validasi/DokumenPBGNew', $data);
					}else{
						$data['fungsi'] = $this->MPenerbitan->getDataFungsi($fg_bg, $jns_bg);
						$this->load->view('Validasi/DokumenPBGNew', $data);
					}
				}
			}
    }
	//End Dokumen Persetujuan Bangunan Gedung dan Lampiran

}