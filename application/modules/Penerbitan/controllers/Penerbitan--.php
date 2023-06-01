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
	Public function ValidasiForm()
	{
		$id 			= $this->input->post('id');
		$data['id'] 	= $id;
		$ttd 			= $this->MPenerbitan->getPejabatTtd($id);
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
			$dataStatus = array(
				'status' => 15,
			);
			$datavalidasi	= array(
				'nm_kadis' => $ttd_pejabat_sk,
				'nip_kadis' => $nip_pejabat_sk,
				'status_pejabat' => $status_pejabat
			);
			$this->MPenerbitan->updateProgress($dataStatus,$id);
			$this->MPenerbitan->updateValidasi($datavalidasi,$id);
		}
		$this->session->set_flashdata('message','PBG Terverifikasi');
		$this->session->set_flashdata('status','success');
		redirect('Penerbitan/ValidasiKadis');
	}

	Public function ValidasiFormEks()
	{
		$id = $this->input->post('id');
		$data['id'] = $id;
		$ttd = $this->MPenerbitan->getPejabatTtd($id);
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
			$this->MPenerbitan->updateProgress($dataStatus,$id);
			$this->MPenerbitan->updateValidasi($datavalidasi,$id);
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
	public function CetakPersetujuanBangunanGedung()
    {
		$id = $this->uri->segment(3);
		$DataVal = $this->MPenerbitan->getdatabg($id)->row_array();
        $id_izin = $DataVal['id_izin'];
        $id_fungsi = $DataVal['id_fungsi_bg'];
		$data['pg'] = $this->MPenerbitan->getdatapemilikDok($id);
		$data['bg'] = $this->MPenerbitan->getdatabangunanDok($id);
		//Begin Data Tanah
		$tanah = $this->MPenerbitan->datatanah($id);
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
	//End Dokumen SLF Bangunan Baru
	//Begin Dokumen SLF Bangunan Eksisting
	public function CetakSertifikatLaikFungsi()
	{
		$id = $this->uri->segment(3);
		$DataVal = $this->MPenerbitan->getdatabg($id)->row_array();
        $id_izin = $DataVal['id_izin'];
		$imb 	 = $DataVal['imb'];
		$fg_bg      = $DataVal['id_fungsi_bg'];
        $jns_bg     = $DataVal['id_jns_bg'];
		$id_slf     = $DataVal['permohonan_slf'];		
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

}