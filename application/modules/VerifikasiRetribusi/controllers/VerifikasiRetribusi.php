<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class VerifikasiRetribusi extends CI_Controller
{
	protected $pathRetribusi = 'object-storage/file/Konsultasi/pembayaran_retribusi/';
	protected $pathBerkas = 'object-storage/dekill/Requirement/';
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Mglobal');
		$this->load->model('Mglobals');
		$this->load->model('Mverifikasiretribusi');
		$this->load->library('Simbg_lib');
		$this->load->helper('utility');
		$this->load->library('Oss_lib');
		$this->simbg_lib->check_session_login();
	}
	public function index()
	{
		$this->VerifikasiPembayaran();
	}
	//Begin Data List Verifikasi Retribusi
	public function VerifikasiPembayaran()
	{
        $id_kabkot    		= $this->session->userdata('loc_id_kabkot');
        $SQLcari     		= "";
        $data['ssrd'] 		= $this->Mverifikasiretribusi->getListVerifikasiRetribusi();
        $data['title']      =    '';
        $data['heading']    =    '';
        $this->template->load('template/template_backend', 'ListPembayaran', $data);
	
	}
    public function FormVerifikasiRetribusi()
	{
		$id                         = $this->uri->segment(3);
		$data['id']                 = $id;
		$query 			            = $this->Mverifikasiretribusi->getDataPemilik($id);
		$data['data'] 	            = $query->row();
		$querybangunan 	            = $this->Mverifikasiretribusi->getDataBangunan($id);
		$data['databgn'] 	        = $querybangunan->row();
		$getTotalRetribusi 	        = $this->Mverifikasiretribusi->getTotalRetribusi($id);
		$total                      = $getTotalRetribusi->num_rows() > 0 ? $getTotalRetribusi->row()->nilai_retribusi_keseluruhan : 0;
		$data['total_retribusi']    = $total;
		$data['retribusi']          = $this->Mverifikasiretribusi->getRetribusi($id)->row();
		if($this->input->post('save_ssrd')) {
			if ($this->input->post('status_validasi_cetak') == 1) {
				$no_validasi = $id;
				//$sk_pbg = $this->Sk_PBG($id);
				//$tgl_sk_pbg = date('Y-m-d');
				$status_validasi_cetak = $this->input->post('status_validasi_cetak');
				$dataInKonsultasi = array(
					'id' => $id,
					'no_validasi' => $id,
					//'no_izin_pbg' => $sk_pbg,
					//'tgl_pbg' => $tgl_sk_pbg,
					'validasi_retri'=>$this->input->post('status_validasi_cetak')
				);
				$dataStatus = array(
					'status' => 13,
					//'id_sk' => 1,
				);
				$this->Mverifikasiretribusi->updateProgress($dataStatus,$id);
				$this->Mverifikasiretribusi->insertDataPenerbitanPbg($dataInKonsultasi);
				
				$this->load->library('ciqrcode'); //pemanggilan library QR CODE
				$config['imagedir']     = 'object-storage/dekill/QR_Code/'; //direktori penyimpanan qr code
				$config['quality']      = true; //boolean, the default is true
				$config['size']         = '1024'; //interger, the default is 1024
				$config['black']        = array(224,255,255); // array, default is array(255,255,255)
				$config['white']        = array(70,130,180); // array, default is array(0,0,0)
				$this->ciqrcode->initialize($config);
				$image_name=$no_validasi.'.png'; //buat name dari qr code sesuai dengan nim
				$params['data'] = 'https://simbg.pu.go.id/Main/DataTeknis/'.$no_validasi; //data yang akan di jadikan QR CODE
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
				$dataPemilik 	= $this->Mverifikasiretribusi->getDataVerifikator($id)->row();
				if($dataPemilik->oss_id != '' || $dataPemilik->oss_id != null ){
					$tgl_skrg 		= date('Y-m-d');
					$kd_status 		= '31';
					$tgl_status 	= $tgl_skrg;
					$nama_status 	= 'Konfirmasi Pembayaran';
					$keterangan 	= 'Retribusi Telah dibayar dan dinyatakan Benar';
					$this->oss_lib->receiveLicenseStatusNew($id,$kd_status,$tgl_status,$nama_status,$keterangan);
				}
				$this->Mverifikasiretribusi->update_Penagihan($dataUn,$id_bayar);
				$this->session->set_flashdata('message','SSRD Berhasil Disimpan.');
				$this->session->set_flashdata('status','success');
			}
			redirect('VerifikasiRetribusi/VerifikasiPembayaran/'.$id);
		}
		$this->load->view('FormValidasi_Pembayaran', $data);
	}
    function Sk_PBG($id=null)
	{
        $que            = $this->Mverifikasiretribusi->get_id_kabkot($id);
		$lokasi         = $que['id_kec_bgn'];
		$tgl_disetujui  = date('d').date('m').date('Y');
		$mydata2        = $this->Mverifikasiretribusi->getNoDrafPbg($lokasi,$tgl_disetujui);
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
			$this->Mverifikasiretribusi->removeDataBayar($id);
			$this->Mglobals->setDatakol('th_data_konsultasi', $datalog);
			$this->session->set_flashdata('message', 'Permohonan di Kembalikan Ke Tahap Penagihan Retribusi');
			$this->session->set_flashdata('status', 'success');
		}
		redirect('VerifikasiRetribusi/VerifikasiPembayaran' );
    }

}
