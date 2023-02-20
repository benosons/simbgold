<?php defined('BASEPATH') or exit('No direct script access allowed');
class Dokumen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('utility');
        $this->load->model(array('Mdokumen', 'mglobal'));
        $this->load->model('Mglobal');
        $this->load->model('Mglobals');
    }
    //Begin Cetak Verifikasi Bangunan Gedung
    public function CetakVerifikasiBangunan($id = NULL)
    {
        $DataVal                = $this->Mdokumen->getdatapermohonan($id)->row_array();
        $id_izin 		        = $DataVal['id_izin'];
        $id_fungsi 		        = $DataVal['id_fungsi_bg'];
        $fg_bg      	        = $DataVal['id_fungsi_bg'];
        $jns_bg     	        = $DataVal['id_jns_bg'];
        $id_prasarana 	        = $DataVal['id_prasarana_bg'];
        $status_eksis	        = $DataVal['permohonan_slf'];
        $status_imb             = $DataVal['imb'];
        $data['pg']             = $this->Mdokumen->getdatapemilikDok($id);
        //$data['result_list']    = $this->Mdokumen->getDataVerifikasi($id);
        $data['result_list']   = $this->Mdokumen->getDataVerifikasiEksis($id);
        $tanah                  = $this->Mdokumen->tanah($id);
        $data['result_tanah']   = $tanah->result_array();
        $data['count_tanah']    = $tanah->num_rows();
        if($id_izin == '1'){ // Bangunan Baru
            if($id_fungsi == '6'){ // Fungsi campuran
                $data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
                $this->load->view('ValidasiTeknis/CetakVerifikasiBgnBaru', $data);
            }else{
                $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
                $this->load->view('ValidasiTeknis/CetakVerifikasiBgnBaru', $data);
            }
        }else if($id_izin == '2'){ // Bangunan Eksisting
            if($status_eksis =='1'){ //Bangunan Gedung
                if($status_imb == '1'){ //Sudah Memiliki IMB/izin
                    if($id_fungsi == '6'){ // Fungsi Campuran
                        $data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
                    
                    }else{
                        $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
                    
                    }
                }else{//Belum Memiliki IMB/Izin
                    if($id_fungsi == '6'){ // Fungsi Campuran
                        $data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
                    
                    }else{
                        $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
                    
                    }
                }
            }else if($status_eksis =='2'){//Bangunan Prasarana
                if($status_imb == '1'){ //Sudah Memiliki IMB/izin
                    $data['fungsi'] = $this->Mdokumen->getDataFungsiPrasarana($id_prasarana);
                    $this->load->view('ValidasiTeknis/CetakVerSLFPrasaranaRekom', $data);
                }else{//Belum Memiliki IMB/Izin
                    $data['fungsi'] = $this->Mdokumen->getDataFungsiPrasarana($id_prasarana);
                    $this->load->view('ValidasiTeknis/CetakVerSLFPrasaranaRekom', $data);
                }
            }else if($status_eksis =='3'){//Bangunan Pertahsop
                if($status_imb == '1'){ //Sudah Memiliki IMB/izin
                        
                }else{//Belum Memiliki IMB/Izin
                        
                }
            }else{
    
            }
        }else if($id_izin == '3'){ // Bangunan Gedung Perubahan
            if($id_fungsi == '6'){ // Fungsi campuran
                $data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
                $this->load->view('ValidasiTeknis/CetakVerifikasiBgnBaru', $data);
            }else{
                $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
                $this->load->view('ValidasiTeknis/CetakVerifikasiBgnBaru', $data);
            }
        }else if($id_izin == '4'){ // Bangunan Kolektif 
            //$data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
            $this->load->view('ValidasiTeknis/CetakVerifikasiBgnBaru', $data);
        }else if($id_izin == '5'){ // Bangunan Prasarana
            $data['fungsi'] = $this->Mdokumen->getDataFungsiPrasarana($id_prasarana);
            $this->load->view('ValidasiTeknis/CetakVerifikasiPrasaranaBaru', $data);	
        }else if($id_izin == '6'){ // Bangunan Cagar Budaya
            if($id_fungsi == '6'){ // Fungsi campuran
                $data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
                $this->load->view('ValidasiTeknis/CetakVerifikasiBgnBaru', $data);	
            }else{
                $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
                $this->load->view('ValidasiTeknis/DokumenPersetujuanBangunanPrasaranaBaru', $data);	
            }
        }else if($id_izin == '7'){ // Bangunan PertaShop
            $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
            $this->load->view('ValidasiTeknis/CetakVerifikasiPertashopBaru', $data);
        }else if($id_izin == '8'){ // Bangunan Bertahap
            if($id_fungsi == '6'){ // Fungsi campuran
                $data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
                $this->load->view('ValidasiTeknis/DokumenPersetujuanBangunanPrasaranaBaru', $data);
            }else{
                $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
                $this->load->view('ValidasiTeknis/DokumenPersetujuanBangunanPrasaranaBaru', $data);	
            }
        }else{
    
        }
    }
        //End Cetak Verifikasi Bangunan Gedung
    //Begin Cetak Dokumen Persetujuan Bangunan 
    public function CetakPersetujuanBangunanGedung()
    {
		$id 			= $this->uri->segment(3);
		$DataVal 		= $this->Mdokumen->getdatabg($id)->row_array();
        $id_izin 		= $DataVal['id_izin'];
        $id_fungsi 		= $DataVal['id_fungsi_bg'];
		$fg_bg      	= $DataVal['id_fungsi_bg'];
        $jns_bg     	= $DataVal['id_jns_bg'];
        $id_prasarana 	= $DataVal['id_prasarana_bg'];
		$status_eksis	= $DataVal['permohonan_slf'];
		$data['pg'] 	= $this->Mdokumen->getdatapemilikDok($id);
		$data['bg'] 	= $this->Mdokumen->getdatabangunanDok($id);
		//Begin Data Tanah
		$tanah 					= $this->Mdokumen->tanah($id);
		$data['result_tanah'] 	= $tanah->result_array();
		$data['count_tanah'] 	= $tanah->num_rows();
		//End Data Tanah
		//Begin Dasar Hukum
		$data['uuck'] 			= $this->Mdokumen->undang2ck()->result_array();
		$data['result_per'] 	= $this->Mdokumen->perda($id)->result_array();
		//End Dasar Hukum
		if($id_izin == '1'){ // Bangunan Baru
			if($id_fungsi == '6'){ // Fungsi campuran
				$data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
				$this->load->view('PersetujuanBangunanGedung/DokumenPersetujuanBangunanGedungBaru', $data);
			}else{
				$data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
				$this->load->view('PersetujuanBangunanGedung/DokumenPersetujuanBangunanGedungBaru', $data);
			}
		}else if($id_izin == '3'){ // Bangunan Gedung Perubahan
			if($id_fungsi == '6'){ // Fungsi campuran
				$data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
                $this->load->view('PersetujuanBangunanGedung/DokumenPersetujuanBangunanGedungBaru', $data);
			}else{
				$data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
                $this->load->view('PersetujuanBangunanGedung/DokumenPersetujuanBangunanGedungBaru', $data);
			}
		}else if($id_izin == '4'){ // Bangunan Kolektif 
            //$data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
            $this->load->view('PersetujuanBangunanGedung/DokumenPersetujuanBangunanGedungBaru', $data);
		}else if($id_izin == '5'){ // Bangunan Prasarana
			$data['fungsi'] = $this->Mdokumen->getDataFungsiPrasarana($id_prasarana);
            $this->load->view('PersetujuanBangunanGedung/DokumenPersetujuanBangunanPrasaranaBaru', $data);	
		}else if($id_izin == '6'){ // Bangunan Cagar Budaya
			if($id_fungsi == '6'){ // Fungsi campuran
				$data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
                $this->load->view('PersetujuanBangunanGedung/DokumenPersetujuanBangunanPrasaranaBaru', $data);	
			}else{
				$data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
                $this->load->view('PersetujuanBangunanGedung/DokumenPersetujuanBangunanPrasaranaBaru', $data);	
			}
		}else if($id_izin == '7'){ // Bangunan PertaShop
            $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
            $this->load->view('PersetujuanBangunanGedung/DokumenPersetujuanBangunanPertashopBaru', $data);
		}else if($id_izin == '8'){ // Bangunan Bertahap
			if($id_fungsi == '6'){ // Fungsi campuran
				$data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
                $this->load->view('PersetujuanBangunanGedung/DokumenPersetujuanBangunanPrasaranaBaru', $data);
			}else{
				$data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
                $this->load->view('PersetujuanBangunanGedung/DokumenPersetujuanBangunanPrasaranaBaru', $data);	
			}
		}else{

        }
    }
    //End Cetak Dokumen Persetujuan Bangunan
     //Begin Vetakan Validasi Dokumen Kadis Teknis  Bangunan Baru
    public function CetakVerifikasiBangunanBaru($id = NULL)
    {
        $DataVal                = $this->Mdokumen->getdatapermohonan($id)->row_array();
        $id_izin                = $DataVal['id_izin'];
        $id_fungsi              = $DataVal['id_fungsi_bg'];
        $jns_bg                 = $DataVal['id_jns_bg'];
        $fg_bg                  = $DataVal['id_fungsi_bg'];
        $data['pg']             = $this->Mdokumen->getdatapemilikDok($id);
        $data['result_list']    = $this->Mdokumen->getDataVerifikasi($id);
        if ($id_izin == '4') {
            //$data['fungsi'] = $this->Mpemeriksaan->getDataFungsi($fg_bg, $jns_bg);
        } else if ($id_izin == '2') {
            if ($fg_bg == '6') {
                $data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
            } else if ($fg_bg == '0') {
            } else {
                $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
            }
        } else if($id_izin == '3'){
            $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
        }else{
            if ($id_fungsi == '6') {
                $data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
            } else {
                $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
            }
        }
        $tanah                      = $this->Mdokumen->tanah($id);
        $data['result_tanah']       = $tanah->result_array();
        $data['count_tanah']        = $tanah->num_rows();
        $data['head_title']         = '.:: Verifikasi Rekomtek Bangunan Gedung Baru::.';
        $this->load->view('CetakVerifikasiGedungBaru', $data);
    }
    public function CetakVerifikasiBangunanPrasaranaBaru($id = NULL)
    {
        $DataVal                = $this->Mdokumen->getdatapermohonan($id)->row_array();
        $id_prasarana           = $DataVal['id_prasarana_bg'];
        $data['pg']             = $this->Mdokumen->getdatapemilikDok($id);
        $data['result_list']    = $this->Mdokumen->getDataVerifikasi($id);
        $data['fungsi']         = $this->Mdokumen->getDataFungsiPrasarana($id_prasarana);
        $tanah                  = $this->Mdokumen->tanah($id);
        $data['result_tanah']   = $tanah->result_array();
        $data['count_tanah']    = $tanah->num_rows();
        $data['head_title']     = '.:: Verifikasi Rekomtek Bangunan Gedung Baru::.';
        $this->load->view('CetakVerifikasiPrasaranaBaru', $data);
    }
    public function CetakVerifikasiPertashopBaru($id = NULL) 
    {

    }
     //End Cetakan Dokumen Kadis Teknis  Bangunan Gedung Baru
    //Begin Dokumen Validasi Kepala Dinas Teknis  Bangunan Gedung Eksisting
    public function CetakVerifikasiBangunanEksisting($id = NULL)
    {
        $DataVal                = $this->Mdokumen->getdatapermohonan($id)->row_array();
        $id_izin                = $DataVal['id_izin'];
        $id_fungsi              = $DataVal['id_fungsi_bg'];
        $id_prasarana           = $DataVal['id_prasarana_bg'];
        $jns_bg                 = $DataVal['id_jns_bg'];
        $fg_bg                  = $DataVal['id_fungsi_bg'];
        $data['pg']             = $this->Mdokumen->getdatapemilikDok($id);
        $data['result_list2']    = $this->Mdokumen->getDataVerifikasiEksis($id);
        if ($id_izin == '4' || $id_izin == '3') {
            //$data['fungsi'] = $this->Mpemeriksaan->getDataFungsi($fg_bg, $jns_bg);
        } else if ($id_izin == '2') {
            if ($fg_bg == '6') {
                $data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
            } else if ($fg_bg == '0') {
            } else {
                $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
            }
        } else if ($id_izin == '5') {
            $data['fungsi'] = $this->Mdokumen->getDataFungsiPrasarana($id_prasarana);
        } else {
            if ($id_fungsi == '6') {
                $data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
            } else {
                $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
            }
        }
        $tanah                      = $this->Mdokumen->tanah($id);
        $data['result_tanah']       = $tanah->result_array();
        $data['count_tanah']        = $tanah->num_rows();
        $data['head_title']         = '.:: Verifikasi Rekomtek ::.';
        $this->load->view('CetakVerSLFRekom', $data);
    }
    public function CetakVerifikasiBangunanPrasaranaEksisting($id = NULL)
    {
        $DataVal                    = $this->Mdokumen->getdatapermohonan($id)->row_array();
        $id_izin                    = $DataVal['id_izin'];
        $id_prasarana               = $DataVal['id_prasarana_bg'];
        $data['pg']                 = $this->Mdokumen->getdatapemilikDok($id);
        $data['result_list']        = $this->Mdokumen->getDataVerifikasiEksis($id);
        $data['fungsi']             = $this->Mdokumen->getDataFungsiPrasarana($id_prasarana);
        $tanah                      = $this->Mdokumen->tanah($id);
        $data['result_tanah']       = $tanah->result_array();
        $data['count_tanah']        = $tanah->num_rows();
        $data['head_title']         = '.:: Verifikasi Rekomtek ::.';
        $this->load->view('CetakVerSLFPrasaranaRekom', $data);
    }
    public function CetakVerifikasiPertashopEksisting($id = NULL) 
    {

    }
    //End Cetak Dokumen Validasi Kepala Dinas Teknis  Bangunan Gedung Eksisting
    //Begin Dokumen Sertifikat Laik Fungsi Bangunan Baru
    public function CetakSertifikatLaikFungsi()
    {
        $id 			= $this->uri->segment(3);
		$DataVal 		= $this->Mdokumen->getdatabg($id)->row_array();
        $id_izin 		= $DataVal['id_izin'];
        $id_fungsi 		= $DataVal['id_fungsi_bg'];
		$fg_bg      	= $DataVal['id_fungsi_bg'];
        $jns_bg     	= $DataVal['id_jns_bg'];
        $id_prasarana 	= $DataVal['id_prasarana_bg'];
		$status_eksis	= $DataVal['permohonan_slf'];
        $status_imb     = $DataVal['imb'];
        $data['pg'] = $this->Mdokumen->getdatapemilikDok($id);
		$data['bg'] = $this->Mdokumen->getdatabangunanDokSLF($id);
        $tanah                  = $this->Mdokumen->tanah($id);
		$data['result_tanah']   = $tanah->result_array();
		$data['count_tanah']    = $tanah->num_rows();
		//End Data Tanah
		//Begin Dasar Hukum
		$data['uuck']           = $this->Mdokumen->undang2ck()->result_array();
		$data['result_per']     = $this->Mdokumen->perda($id)->result_array();
		//End Dasar Hukum
        if($id_izin == '2'){ // Bangunan Eksisting
			if($status_eksis =='1'){// Bangunan Gedung
                if($id_fungsi =='6'){ // Fungsi Campuran
                    if($status_imb == '1') { //Sudah Memiliki IMB
                        $data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
                        $this->load->view('SertifikatLaikFungsi/DokumenSertifikatLaikFungsi', $data);
                    }else{ // Belum Memiliki IMB
                        $data['fungsi'] = $this->Mdokumen->getDataFungsiCampuran($fg_bg);
                        $this->load->view('SertifikatLaikFungsi/DokumenPBGSLF', $data);
                    }
                } else { // Non Campuran
                    if($status_imb == '1') { //Sudah Memiliki IMB
                        $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
                        $this->load->view('SertifikatLaikFungsi/DokumenSertifikatLaikFungsi', $data);
                    }else{ // Belum Memiliki IMB
                        $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
                        $this->load->view('SertifikatLaikFungsi/DokumenPBGSLFPrasarana', $data);
                    }
                }
			}else if($status_eksis =='2'){ // Bangunan Prasarana
                if($status_imb == '1') { //Sudah Memiliki IMB
                    $data['fungsi'] = $this->Mdokumen->getDataFungsiPrasarana($id_prasarana);
                    $this->load->view('SertifikatLaikFungsi/DokumenSertifikatLaikFungsi', $data);
                }else{ // Belum Memiliki IMB
                    $data['fungsi'] = $this->Mdokumen->getDataFungsiPrasarana($id_prasarana);
                    $this->load->view('SertifikatLaikFungsi/DokumenPBGSLFPrasarana', $data);
                }   
			}else if($status_eksis =='3'){ // Bangunan PertaShop
                if($status_imb == '1') { //Sudah Memiliki IMB
                    $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
                    $this->load->view('SertifikatLaikFungsi/DokumenSertifikatLaikFungsiPertaShop', $data);
                }else{ // Belum Memiliki IMB
                    $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);        
                    $this->load->view('SertifikatLaikFungsi/DokumenPBGSLF', $data);
                }
            }
		} 
    }

    public function CetakDokumenSertifikatLaikFungsiBangunanGedung()
    {
        $id         = $this->uri->segment(3);
        $DataVal    = $this->Mdokumen->getdataizin($id)->row_array();
        $id_izin    = $DataVal['id_izin'];
		$data['pg'] = $this->Mdokumen->getdatapemilikDok($id);
		$data['bg'] = $this->Mdokumen->getdatabangunanDok($id);
        $datajns    = $this->Mdokumen->getDataVerifikasi($id);
        $fg_bg      = $datajns['id_fungsi_bg'];
        $jns_bg     = $datajns['id_jns_bg'];
        if($id_izin == '4' || $id_izin == '3'){
            //$data['fungsi'] = $this->Mpemeriksaan->getDataFungsi($fg_bg, $jns_bg);
        }else{
            $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
        } 
        $this->load->view('SertifikatLaikFungsi/DokumenSertifikatLaikFungsi', $data);
    }
    public function CetakDokumenSertifikatLaikFungsiBangunanPrasarana()
    {
        $id                 = $this->uri->segment(3);
        $DataVal            = $this->Mdokumen->getdataizin($id)->row_array();
        $id_izin            = $DataVal['id_izin'];
        $id_prasarana       = $DataVal['id_prasarana_bg'];
		$data['pg']         = $this->Mdokumen->getdatapemilikDok($id);
		$data['bg']         = $this->Mdokumen->getdatabangunanDok($id);
        $datajns            = $this->Mdokumen->getDataVerifikasi($id);
        $fg_bg              = $datajns['id_fungsi_bg'];
        $jns_bg             = $datajns['id_jns_bg'];
        $data['fungsi']     = $this->Mdokumen->getDataFungsiPrasarana($id_prasarana);
		
        /*if($id_izin == '4' || $id_izin == '3'){
            //$data['fungsi'] = $this->Mpemeriksaan->getDataFungsi($fg_bg, $jns_bg);
        }else{
            $data['fungsi'] = $this->Mdokumen->getDataFungsi($fg_bg, $jns_bg);
        }*/ 
        $this->load->view('SertifikatLaikFungsi/DokumenSertifikatLaikFungsiPrasarana', $data);
    }
    //End Dokumen Sertifikat Laik Fungsi Bangunan Baru
    //Begin Surat Bukti Kepemilikan Bangunan Gedung

    //End Surat Bukti Kepemilikan Bangunan Gedung
}
/* End of file Pemeriksaan.php */
