<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Main extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('utility');
		$this->load->model('Mmain');
		$this->load->library('simbg_lib');
	}
	public function index()
	{ 
		redirect('');
	}
	
	function VerifikasiBerkas()
	{	
		$sk_imb = $this->uri->segment(3);
		$data['no_imb'] = $sk_imb;
		if(trim($sk_imb) != '' && trim($sk_imb) != '') {
			$query = $this->Mmain->get_detail_imb($sk_imb);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['status'] = "IMB Terverifikasi";
				$data['nama'] = $mydata['nama_pemohon'];
				$data['fungsi_bg'] = $mydata['fungsi_bg'];
				$data['jns_bangunan'] = $mydata['jns_bangunan'];
				$data['nama_bangunan'] = $mydata['nama_bangunan'];
				$data['luas_bg'] = $mydata['luas_bg'];
				$data['tinggi_bg'] = $mydata['tinggi_bg'];
				$data['alamat_bg'] = $mydata['alamat_bg'];
				$data['nama_kecamatan_bg'] = $mydata['nama_kecamatan_bg'];
				$data['nama_kabkota_bg'] = $mydata['nama_kabkota_bg'];
				$data['nama_provinsi_bg'] = $mydata['nama_provinsi_bg'];
			}else{
				$data['status'] = "Tidak Ditemukan";
			}
		}
		$data['head_title'] = '';
		$data['content'] = $this->load->view('DataSK', $data, TRUE);
		$this->load->view('Front_Info', $data);
	}
	
	function DataSKSimbg()
	{	
		$sk_slf = $this->uri->segment(3);
		$data['sk_slf'] = $sk_slf;
		if(trim($sk_slf) != '' && trim($sk_slf) != '') {
			$query = $this->Mmain->getDataSLF($sk_slf);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['status'] = "SLF Terverifikasi";
				$data['nama_pemilik'] = $mydata['nama_pemilik'];
				$data['nama_bangunan'] = $mydata['nama_bangunan'];
				$data['alamat_bg'] = $mydata['alamat_bg'];
				$data['nama_kecamatan_bg'] = $mydata['nama_kecamatan_bg'];
				$data['nama_kabkota_bg'] = $mydata['nama_kabkota_bg'];
				$data['nama_provinsi_bg'] = $mydata['nama_provinsi_bg'];
				$data['kepala_dinas'] = $mydata['ttd_pejabat_sk'];
				$data['nip_kadis'] = $mydata['nip_pejabat_sk'];
			}else{
				$data['status'] = "Tidak Ditemukan";
			}
		}
		$data['head_title'] = '';
		$data['content'] = $this->load->view('DataSKSLF', $data, TRUE);
		$this->load->view('Front_Info', $data);
	}

	function VerifikasiPBG() // Data PBG
	{	
		$sk_imb = $this->uri->segment(3);
		$data['no_imb'] = $sk_imb;
		if(trim($sk_imb) != '' && trim($sk_imb) != '') {
			$query = $this->Mmain->getDataPBG($sk_imb);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['status'] = "PBG Terverifikasi";
				$data['id_jenis_permohonan'] = $mydata['id_jenis_permohonan'];
				$data['nama'] = $mydata['nm_pemilik'];
				$data['fungsi_bg'] = $mydata['fungsi_bg'];
				$data['nama_bangunan'] = $mydata['nm_bgn'];
				$data['nama_provinsi'] = $mydata['nama_provinsi'];
				$data['nama_kabkota'] = $mydata['nama_kabkota'];
				$data['nama_kecamatan'] = $mydata['nama_kecamatan'];
				$data['nama_kelurahan'] = $mydata['nama_kelurahan'];
				$data['alamat_bg'] = $mydata['almt_bgn'];
				$data['luas_bgn'] = $mydata['luas_bgn'];
				$data['luas_bgp'] = $mydata['luas_bgp'];
				$data['tinggi_bgn'] = $mydata['tinggi_bgn'];
				$data['tinggi_bgp'] = $mydata['tinggi_bgp'];
				$data['jml_lantai'] = $mydata['jml_lantai'];
				$data['tipeA'] = $mydata['tipeA'];
				$data['tinggiA'] = $mydata['tinggiA'];
				$data['luasA'] = $mydata['luasA'];
				$data['jumlahA'] = $mydata['jumlahA'];
				$data['lantaiA'] = $mydata['lantaiA'];
				$data['nm_kadis'] = $mydata['nm_kadis'];
				$data['nip_kadis'] = $mydata['nip_kadis'];
			}else{
				$data['status'] = "Tidak Ditemukan";
			}
		}
		$data['head_title'] = '';
		$data['content'] = $this->load->view('DataSKPBG', $data, TRUE);
		$this->load->view('Front_Info', $data);
	}

	function VerifikasiPBG_C()
	{	
		$sk_imb = $this->uri->segment(3);
		$data['no_imb'] = $sk_imb;
		if(trim($sk_imb) != '' && trim($sk_imb) != '') {
			$query = $this->Mmain->getConvert($sk_imb);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['status'] = "PBG Terverifikasi";
				
				$data['nama'] = $mydata['nama_pemilik'];
				$data['fungsi_bg'] = $mydata['fungsi_bgn'];
				//$data['jns_bangunan'] = $mydata['jns_bangunan'];
				$data['nama_bangunan'] = $mydata['nama_bgn'];
				$data['alamat_bg'] = $mydata['alamat_bgn'];
				// $data['nama_kecamatan_bg'] = $mydata['nama_kecamatan_bg'];
				// $data['nama_kabkota_bg'] = $mydata['nama_kabkota_bg'];
				// $data['nama_provinsi_bg'] = $mydata['nama_provinsi_bg'];
				
			}else{
				$data['status'] = "Tidak Ditemukan";
			}
		}
		$data['head_title'] = '';
		$data['content'] = $this->load->view('Data_C', $data, TRUE);
		$this->load->view('Front_Info', $data);
	}

	public function DraftSLF() //SLF Bangunan Baru Setelah PBG terbit
	{
		$sk_slf = $this->uri->segment(3);
		$data['no_imb'] = $sk_slf;
		if(trim($sk_slf) != '' && trim($sk_slf) != '') {
			$query = $this->Mmain->getDataSLFBaru($sk_slf);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['status'] = "SLF Terverifikasi";
				$data['nama'] = $mydata['nm_pemilik'];
				$data['fungsi_bg'] = $mydata['fungsi_bg'];
				$data['nama_bangunan'] = $mydata['nm_bgn'];
				$data['nama_provinsi'] = $mydata['nama_provinsi'];
				$data['nama_kabkota'] = $mydata['nama_kabkota'];
				$data['nama_kecamatan'] = $mydata['nama_kecamatan'];
				$data['nama_kelurahan'] = $mydata['nama_kelurahan'];
				$data['alamat_bg'] = $mydata['almt_bgn'];
				$data['luas_bgn'] = $mydata['luas_bgn'];
				$data['tinggi_bgn'] = $mydata['tinggi_bgn'];
				$data['jml_lantai'] = $mydata['jml_lantai'];
				$data['nm_kadis_teknis'] = $mydata['nm_kadis_teknis'];
				$data['nip_kadis_teknis'] = $mydata['nip_kadis_teknis'];
			}else{
				$data['status'] = "Tidak Ditemukan";
			}
		}
		$data['head_title'] = '';
		$data['content'] = $this->load->view('DataSLF', $data, TRUE);
		$this->load->view('Front_Info', $data);
	}

	public function Berkas(){
		$sk_slf = $this->uri->segment(3);
		$data['no_imb'] = $sk_slf;
		if(trim($sk_slf) != '' && trim($sk_slf) != '') {
			$query = $this->Mmain->getDataSLFEksis($sk_slf);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['status'] = "SLF Terverifikasi";
				$data['nama'] = $mydata['nm_pemilik'];
				$data['fungsi_bg'] = $mydata['fungsi_bg'];
				$data['nama_bangunan'] = $mydata['nm_bgn'];
				$data['alamat_bg'] = $mydata['almt_bgn'];

				$data['luas_bgn'] = $mydata['luas_bgn'];
				$data['luas_bgp'] = $mydata['luas_bgp'];
				$data['tinggi_bgn'] = $mydata['tinggi_bgn'];
				$data['tinggi_bgp'] = $mydata['tinggi_bgp'];
				$data['jml_lantai'] = $mydata['jml_lantai'];
				$data['tipeA'] = $mydata['tipeA'];
				$data['tinggiA'] = $mydata['tinggiA'];
				$data['luasA'] = $mydata['luasA'];
				$data['jumlahA'] = $mydata['jumlahA'];
				$data['lantaiA'] = $mydata['lantaiA'];

				$data['nm_kadis'] = $mydata['nm_kadis_teknis'];
				$data['nip_kadis'] = $mydata['nip_kadis_teknis'];
				$data['no_imb'] = $mydata['no_imb'];
				$data['no_izin_pbg'] = $mydata['no_izin_pbg'];
				$data['no_slf'] = $mydata['no_slf'];
			}else{
				$data['status'] = "Tidak Ditemukan";
			}
		}
		$data['head_title'] = '';
		$data['content'] = $this->load->view('DataBerkasSLF', $data, TRUE);
		$this->load->view('Front_Info', $data);
	}

	public function CetakPersetujuanBangunanGedung()
    {
		$id = $this->uri->segment(3);
		$data['pg'] = $this->Mmain->getdatapemilikDok($id);
		$data['bg'] = $this->Mmain->getdatabangunanDok($id);
		//Begin Data Tanah
		$tanah = $this->Mmain->datatanah($id);
		$data['result_tanah'] = $tanah->result_array();
		$data['count_tanah'] = $tanah->num_rows();
		//End Data Tanah
		//Begin Dasar Hukum
		$data['uuck'] = $this->Mmain->undang2ck()->result_array();
		$data['result_per'] = $this->Mmain->perda($id)->result_array();
		//End Dasar Hukum
       	$this->load->view('Dokumen/DokumenPBG', $data);
    }

	public function Konsultasi() {
		$no_konsultasi = $this->uri->segment(3);
		$data['no_konsultasi'] = $no_konsultasi;
		if(trim($no_konsultasi) != '' && trim($no_konsultasi) != '') {
			$query = $this->Mmain->getDataKonsultasi($no_konsultasi);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['status'] = "Status Pemeriksaan Dokumen Teknis";
				$data['nama'] = $mydata['nm_pemilik'];
				$data['fungsi_bg'] = $mydata['fungsi_bg'];
				$data['nama_bangunan'] = $mydata['nm_bgn'];
				$data['nama_provinsi'] = $mydata['nama_provinsi'];
				$data['nama_kabkota'] = $mydata['nama_kabkota'];
				$data['nama_kecamatan'] = $mydata['nama_kecamatan'];
				$data['nama_kelurahan'] = $mydata['nama_kelurahan'];
				$data['alamat_bg'] = $mydata['almt_bgn'];
				$data['no_sk_tk'] = $mydata['no_sk_tk'];
				$data['date_sk_tk'] = $mydata['date_sk_tk'];
				$data['lampiran'] = $mydata['dir_file_konsultasi'];
				$data['nm_kadis'] = $mydata['nm_kadis'];
				$data['nip_kadis'] = $mydata['nip_kadis'];
			}else{
				$data['status'] = "Tidak Ditemukan";
			}
		}
		$data['head_title'] = '';
		$data['content'] = $this->load->view('DataKonsultasi', $data, TRUE);
		$this->load->view('Front_Info', $data);
	}

	public function Cetak_Dokumen() 
	{
		$id = $this->uri->segment(3);
		$DataVal = $this->Mmain->getdatabg($id)->row_array();
        $id_izin = $DataVal['id_izin'];
        $id_fungsi = $DataVal['id_fungsi_bg'];
		$data['pg'] = $this->Mmain->getdatapemilikDokPBG($id);
		$data['bg'] = $this->Mmain->getdatabangunanDokPBG($id);
		//Begin Data Tanah
		$tanah = $this->Mmain->datatanahPBG($id);
		$data['result_tanah'] = $tanah->result_array();
		$data['count_tanah'] = $tanah->num_rows();
		//End Data Tanah
		$datajns    = $this->Mmain->getDataVerifikasi($id);
        $fg_bg      = $datajns['id_fungsi_bg'];
        $jns_bg     = $datajns['id_jns_bg'];
        $id_prasarana = $datajns['id_prasarana_bg'];

		if($id_izin == '4' || $id_izin == '3'){
            //$data['fungsi'] = $this->Mpemeriksaan->getDataFungsi($fg_bg, $jns_bg);
        }else if($id_izin == '5'){
            $data['fungsi'] = $this->Mmain->getDataFungsiPrasarana($id_prasarana);
        }else{
            if($id_fungsi =='6'){
                $data['fungsi'] = $this->Mmain->getDataFungsiCampuran($fg_bg);
            }else{
                $data['fungsi'] = $this->Mmain->getDataFungsi($fg_bg, $jns_bg);
            }
        } 
		//Begin Dasar Hukum
		$data['uuck'] = $this->Mmain->undang2ck()->result_array();
		$data['result_per'] = $this->Mmain->perda($id)->result_array();
		//End Dasar Hukum
        $this->load->view('Dokumen/DokumenPBGPemohon', $data);
	}

	
}
