<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rekap extends CI_Controller {

	var $limit = 1000;
	public function __construct()
    {
        parent::__construct();
		$this->load->helper('utility');
		$this->load->library('mypagination' );
		$this->load->model('Mrekap');
		$this->load->library('simbg_lib');
		$this->load->helper(array('form', 'url'));
		$this->simbg_lib->check_session_login();
	}

	function killSession()
	{
		$this->session->unset_userdata('pencarian');
	}

	public function index()
	{
		$this->penetapan_retribusi_list();
	}
	// Begin Rekap Permohonan IMB
	public function MonitoringIMB()
	{
		$data['dataimb']   	= $this->Mrekap->getDataMonitoringIMB();
		$data['content']	= $this->load->view('IMB/RekapImb',$data,TRUE);
		$data['title']		= 'Monitoring IMB';
		$data['heading']	= '';
		$this->load->view('backend_adm',$data);
	}
	
	public function RekapRetribusi()
	{
		$id_kabkot			= $this->session->userdata('loc_id_kabkot');
		$SQLcari = "";
		$offset = 0;
		if ($this->input->post('search',TRUE)){
			$this->session->set_userdata('pencarian' ,1);
			
			$id_fungsi_bg = trim($this->input->post('id_fungsi_bg'));
			$data['id_fungsi_bg'] = $id_fungsi_bg;
			if (trim($id_fungsi_bg) != '')
			{
				$this->session->set_userdata('skeyid_fungsi_bg' ,$id_fungsi_bg); 
				$SQLcari .= " AND a.id_fungsi_bg = '$id_fungsi_bg'";
			}
			$tgl_permohonan_awal2 = $this->input->post('tanggalawal');
			$tgl_permohonan_akhir2 = $this->input->post('tanggalakhir');
			$data['tanggalawal']  = $tgl_permohonan_awal2;
			$data['tanggalakhir'] = $tgl_permohonan_akhir2;
			if (trim($tgl_permohonan_awal2) !='' && trim($tgl_permohonan_akhir2) !='')
			{
				$SQLcari .= " AND g.tgl_imb between '$tgl_permohonan_awal2' AND '$tgl_permohonan_akhir2'";
			}
			if($this->session->userdata('loc_id_kabkot')){
				$id_kabkot = $this->session->userdata('loc_id_kabkot');
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$data['dataimb'] = $this->Mrekap->getDataPermohonan(0,1,$this->limit,$offset,null,$SQLcari);	
		}else if ($this->session->userdata('pencarian') == TRUE){
			$SQLcari = '';
			if($this->session->userdata('loc_id_kabkot')){
				$id_kabkot = $this->session->userdata('loc_id_kabkot');
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$data['dataimb'] = $this->Mrekap->getDataPermohonan(0,1,$this->limit,$offset,null,$SQLcari);
		}else{
			$this->killSession();
			if($this->session->userdata('loc_id_kabkot')){
				$id_kabkot = $this->session->userdata('loc_id_kabkot');
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$data['dataimb'] = $this->Mrekap->getDataPermohonan(0,1,$this->limit,$offset,null,$SQLcari);
		}
		$data['content']	= $this->load->view('IMB/RekapRetribusi',$data,TRUE);
		$data['title']		= 'Rekap Retribusi';
		$data['heading']	= '';
		$this->load->view('backend_adm',$data);
	}
	
	public function  Informasi()
	{
		$id_kabkot			= $this->session->userdata('loc_id_kabkot');
		$SQLcari = "";
		if ($this->input->post('search',TRUE)){
			$status = trim($this->input->post('status'));
			$data['status'] = $status;	
			if($status == '1'){
				$SQLcari .= "AND b.status_progress <= 14 ";
				}
			if ($status == '2'){
				$SQLcari .= "AND  b.status_progress = 16 ";
			}
			$tahun = $this->input->post('tahun');
			$tahun2 = $this->input->post('tahun2');
			$data['tahun'] = $tahun;
			$data['tahun2'] = $tahun2;
			if (trim($tahun2) !='' && trim($tahun2) !=''){	
				$SQLcari .= " AND year(b.tgl_permohonan) between '$tahun' AND '$tahun2'";
			}
			$query = $this->Mrekap->get_rekap_fungsi_bg($SQLcari);	
		} else {
			$query = $this->Mrekap->get_rekap_fungsi_bg($SQLcari);
		}
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['head_title'] = '.:: SIMBG ::.';
		
		$data['content']	= $this->load->view('IMB/RekapPerIMB',$data,TRUE);
		$data['title']		= 'Rekap Permohonan';
		$data['heading']	= '';
		$this->load->view('backend_adm',$data);
	}
	// End Rekap Permohonan IMB
	// Begin Rekap Permohonan 
	public function RekapSlf()
	{
		//id_kabkot			= $this->session->userdata('loc_id_kabkot');
		$SQLcari = "";
		if ($this->input->post('search',TRUE)){
			$status = trim($this->input->post('status'));
			$data['status'] = $status;	
			if($status == '1'){
				$SQLcari .= "AND b.status_progress <= 14 ";
				}
			if ($status == '2')
			{
				$SQLcari .= "AND  b.status_progress =16 ";
			}
			$query = $this->Mrekap->getDataRekapSlf($SQLcari);	
		}
		else 
		{
			$query = $this->Mrekap->getDataRekapSlf($SQLcari);
		}
		
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['head_title'] = '.:: SIMBG ::.';
		
		$data['content']	= $this->load->view('SLF/RekapPerSLF',$data,TRUE);
		$data['title']		= 'Rekap Permohonan';
		$data['heading']	= '';
		$this->load->view('backend_adm',$data);
	}
	// End Rekap Permohonan SLF
	function MonitoringSlf()
	{
		$data['dataimb']   ='';
		$data['content']	= $this->load->view('SLF/RekapSlf',$data,TRUE);
		$data['title']		=	'Rekap Sertifikat Laik Fungsi';
		$data['heading']		=	'';
		$this->load->view('backend_rekap',$data);
	}

	//Begin Rekap PBG
	public function MonitoringPBG()
	{
		$id_fungsi_bg = $this->input->get('id_fungsi_bg', TRUE);
		$id_proses = $this->input->get('id_proses', TRUE);
		$tanggalawal = $this->input->get('tanggalawal', TRUE);
		$tanggalakhir = $this->input->get('tanggalakhir', TRUE);
		$SQLcari 	= "";
		$search = $this->search([$id_fungsi_bg, $id_proses, $tanggalawal, $tanggalakhir]);
		$data['Penugasan'] = !isset($_GET['cari']) ? $this->Mrekap->getDataRekapPBG(null, $SQLcari)->result() : $search->result();
		$data['content']	= $this->load->view('PBG/RekapPbg', $data, TRUE);
		$data['title']		=	'Monitoring PBG';
		$data['heading']	=	'';
		$this->load->view('backend_adm', $data);
	}

	private function search($post = [])
	{
		// var_dump($post); die;
		$fungsi_bg = $post[0];
		$proses = $post[1];
		$d1 = $post[2];
		$d2 = $post[3];
		$tglAwal =  date("Y-m-d", strtotime($d1));
		$tglAkhir = date("Y-m-d", strtotime($d2));
		if ($tglAwal && $tglAkhir != NULL) {
			if (intval($fungsi_bg) === 0 && intval($proses) === 0) {
				$query = $this->Mrekap->getPenugasanAll($tglAwal, $tglAkhir);
			} else if (intval($fungsi_bg) !== 0 && intval($proses) === 0) {
				$query = $this->Mrekap->findFungsi($fungsi_bg, $tglAwal, $tglAkhir);
			} else if (intval($fungsi_bg) === 0 && intval($proses) !== 0) {
				$query = $this->Mrekap->findProses($proses, $tglAwal, $tglAkhir);
			} else {
				$query = $this->Mrekap->findAll($fungsi_bg, $proses, $tglAwal, $tglAkhir);
			}
		} else {
			$SQLcari 	= "";
			$query = $this->Mrekap->getDataRekapPBG(null, $SQLcari);
		}
		return $query;
	}

	public function export_excel()
	{
		$SQLcari = "";
		$id_fungsi_bg = $this->input->get('id_fungsi_bg', TRUE);
		$id_proses = $this->input->get('id_proses', TRUE);
		$tanggalawal = $this->input->get('tanggalawal', TRUE);
		$tanggalakhir = $this->input->get('tanggalakhir', TRUE);
		$SQLcari 	= "";
		$search = $this->search([$id_fungsi_bg, $id_proses, $tanggalawal, $tanggalakhir]);
		$laporan = !isset($_GET['cari']) ? $this->Mrekap->getDataRekapPBG(null, $SQLcari) : $search;

		include APPPATH . 'modules/rekap/views/tools/cssexport.php';
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Kementrian Pekerjaan Umum dan Perumahan Rakyat");
		//atur header
		$objset = $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells('A1:F1');
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(5);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(50);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setWidth(30);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setWidth(50);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(30);
		$bord = $laporan->num_rows() + 2;
		//$objPHPExcel->getActiveSheet(0)->getStyle('A1:F2')->applyFromArray($headerwar)->getFont()->setSize(11);
		$objPHPExcel->getSheet(0)->getStyle('A1:F' . $bord)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//isi
		$objget = $objPHPExcel->getActiveSheet(0);
		$objget->setTitle('Laporan Monitoring PBG');
		$objset->setCellValue('A1', 'Laporan Monitoring PBG');
		$objset->setCellValue('A2', 'No');
		$objset->setCellValue('B2', 'Jenis Konsultasi');
		$objset->setCellValue('C2', 'Nomor Registrasi');
		$objset->setCellValue('D2', 'Nama Pemilik');
		$objset->setCellValue('E2', 'Lokasi Bangunan');
		$objset->setCellValue('F2', 'Status');
		$no = 1;
		$nop = 3;
		foreach ($laporan->result() as $r) {
			$stats = $r->status == 3 ? 'Menunggu Penugasan TPA/TPT' : 'Sudah Dilakukan Penugasan';
			$objset->setCellValue('A' . $nop, $no);
			$objset->setCellValue('B' . $nop, $r->nm_konsultasi);
			$objset->setCellValue('C' . $nop, $r->no_konsultasi);
			$objset->setCellValue('D' . $nop, $r->nm_pemilik);
			$objset->setCellValue('E' . $nop, $r->almt_bgn);
			$objset->setCellValue('F' . $nop, $stats);
			$no++;
			$nop++;
		}
		//proses export
		$objset = $objPHPExcel->setActiveSheetIndex(0);
		$filename = 'MonitoringPBG' . date('d-m-Y') . '_' . time() . '.xlsx';
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); //sesuaikan headernya 
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //ubah nama file saat diunduh
		header('Content-Disposition: attachment;filename=' . $filename); //unduh file
		$objWriter->save("php://output");
	}
	//End Rekap PBG
	//Begin Rekap Bangunan Eksisting
	public function SLFEks()
	{
		//id_kabkot			= $this->session->userdata('loc_id_kabkot');
		$SQLcari = "";
		if ($this->input->post('search',TRUE)){
			$status = trim($this->input->post('status'));
			$data['status'] = $status;	
			if($status == '1'){
				$SQLcari .= "AND b.status <= 14 ";
				}
			if ($status == '2')
			{
				$SQLcari .= "AND  b.status >=16 ";
			}
			$query = $this->Mrekap->getDataRekapEks($SQLcari);	
		}
		else 
		{
			$query = $this->Mrekap->getDataRekapEks($SQLcari);
		}
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		//$data['head_title'] = '.:: SIMBG ::.';
		$data['title']		= '';
		$data['heading']	= '';
		$this->template->load('template/template_backend', 'Rekap/Eksisting/RekapEks', $data);
	}
	//End Rekap Bangunan Eksisting 
	//Begin Rekap PBG Bangunan Baru
	public function PBG()
	{
		$SQLcari = "";
		if ($this->input->post('search',TRUE)){
			$status = trim($this->input->post('status'));
			$data['status'] = $status;	
			if($status == '1'){
				$SQLcari .= "AND b.status Between '1' and '5'";
			}else if ($status == '2'){
				$SQLcari .= "AND  b.status Between '6' and '10' ";
			}else if($status == '3'){
				$SQLcari .= "AND  b.status Between '11' and '12'";
			}else if($status == '4'){
				$SQLcari .= "AND  b.status Between '13' and '14'";
			}else if($status == '5'){
				$SQLcari .= "AND  b.status Between '15' and '24'";
			}
			$query = $this->Mrekap->getDataRekapPBGBaru($SQLcari);	
		}
		else 
		{
			$query = $this->Mrekap->getDataRekapPBGBaru($SQLcari);
		}
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['title']		= '';
		$data['heading']	= '';
		$this->template->load('template/template_backend', 'Rekap/Eksisting/RekapPBGBaru', $data);
	}

	public function SLF()
	{
		//id_kabkot			= $this->session->userdata('loc_id_kabkot');
		$SQLcari = "";
		if ($this->input->post('search',TRUE)){
			$status = trim($this->input->post('status'));
			$data['status'] = $status;	
			if($status == '1'){
				$SQLcari .= "AND b.status Between '1' and '10'";
			}else if ($status == '2'){
				$SQLcari .= "AND  b.status Between '11' and '15' ";
			}else if($status == '3')
			{
				$SQLcari .= "AND  b.status >= '16' ";
			}
			$query = $this->Mrekap->getDataRekapPBGBaru($SQLcari);	
		}
		else 
		{
			$query = $this->Mrekap->getDataRekapPBGBaru($SQLcari);
		}
		
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		
		$data['title']		= '';
		$data['heading']	= '';
		$this->template->load('template/template_backend', 'Rekap/Eksisting/RekapPBGBaru', $data);
	}
	//End Rekap PBG Bangunan Baru
	//Begin Data TPA
	public function cetak_tpa($type = '', $status = '', $prop_p = '')
	{
		$data['status'] = $status;
		$SQLcari = "";
		if ($status == '1') {
			$SQLcari .= "AND b.status = '1'";
		} else if ($status == '2') {
			$SQLcari .= "AND  b.status ='3' ";
		} else if ($status == '3') {
			$SQLcari .= "AND  b.status = '5' ";
		}
		if ($prop_p != '0') {
			$SQLcari .= "AND a.id_provinsi = $prop_p";
			$data['select_prov'] = $prop_p;
		}
		$query = $this->Mrekap->getDataRekapTPA($SQLcari);
		$data['jum_data'] = $query->num_rows();
		$data['result'] = $query->result();
		$html = $this->load->view('Rekap/Eksisting/cetak_RekapTPA', $data, true);
		print_cetak($html, $type, 'Cetak', 'L');
	}

	public function TPAProv()
	{
		$SQLcari = "";
		if ($this->input->post('search',TRUE)){
			$status = trim($this->input->post('status'));
			$data['status'] = $status;	
			if($status == '1'){
				$SQLcari .= "AND b.status = '1'";
			}else if ($status == '2'){
				$SQLcari .= "AND  b.status ='3' ";
			}else if($status == '3')
			{
				$SQLcari .= "AND  b.status = '5' ";
			}
			$query = $this->Mrekap->getDataRekapTPAPerProv($SQLcari);	
		}
		else 
		{
			$query = $this->Mrekap->getDataRekapTPAPerProv($SQLcari);
		}
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['title']		= '';
		$data['heading']	= '';
		$this->template->load('template/template_backend', 'Rekap/Eksisting/RekapTPAProv', $data);
	}

	public function Validasi()
	{
		$search = $this->input->post('search');
		//$id_kabkot	= $this->session->userdata('loc_id_kabkot');
		$SQLcari 	= "";
		if ($search != '') {
			$SQLcari = array(
				'id_lembaga' => trim($this->input->post('id_lembaga')),
				'status' => trim($this->input->post('status')),
				//'tanggalawal' => trim($this->input->post('tanggalawal')),
				//'tanggalakhir' => trim($this->input->post('tanggalakhir'))
			);
			$this->session->set_userdata($SQLcari);
			$data = array(
				'id_lembaga' => trim($this->input->post('id_lembaga')),
				'status' => trim($this->input->post('status')),
				//'tanggalawal' => trim(tgl_ind_to_eng($this->input->post('tanggalawal'))),
				//'tanggalakhir' => trim(tgl_ind_to_eng($this->input->post('tanggalakhir')))
			);
		}
		$data['tpa_result'] = $this->Mrekap->getListValidasitor($SQLcari);
		//$data['tpa_result'] = $this->Mtpa->listValidasiDataTpa('a.*,b.*,c.nm_asosiasi,c.group');
		$data['content']	= $this->load->view('Validasi/Validasi_list', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm', $data);
	}
	//End Data TPA
	//Begin Rekap AKun Dinas
	public function Dinas()
	{
		$query = $this->Mrekap->getDataDinas();
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['title']		= '';
		$data['heading']	= '';
		$this->template->load('template/template_backend', 'Rekap/Eksisting/RekapAkunDinas', $data);
	}

	public function FormVerifikasi()
	{
		$id 				= $this->uri->segment(3);
		$data['id']			= $id;
		$akun			= $this->Mrekap->getDataAkunDinas($id);
		$data['data'] 		= $akun->row();
		$this->load->view('Eksisting/FormVerifikasi', $data);
	}

	public function SimpanStatus()
	{
		$id							= $this->input->post('id');
		$status_teknis				= $this->input->post('status_teknis');
		$status_perizinan			= $this->input->post('status_perizinan');
		if($status_teknis =='1'){
			if($status_perizinan =='1'){
				$T_Status = '4';
			}else{
				$T_Status = '3';
			}
		}else{
			$T_Status = '2';
		}
		$data	= array(
			'status_teknis' => $status_teknis,
			'status_perizinan' => $status_perizinan,
			'T_Status' => $T_Status,
		);
		if ($id != "") {
			$query		= $this->Mglobals->setData('tm_akun_dinas', $data, 'id_kabkot', $id);
			$this->session->set_flashdata('message', 'Data User Berhasil di Ubah.');
			$this->session->set_flashdata('status', 'success');
			redirect('Rekap/Dinas');
		} else {
			$query		= $this->Mglobals->setData('tm_akun_dinas', $data, 'id');
			if ($query) {
				$this->session->set_flashdata('message', 'Biodata User Berhasil di Simpan.');
				$this->session->set_flashdata('status', 'success');
				redirect('Rekap/Dinas');
			} else {
				$this->session->set_flashdata('message', 'Biodata User Gagal di Simpan.');
				$this->session->set_flashdata('status', 'danger');
				redirect('Rekap/Dinas');
			}
		}
	}
	//End Rekap Akun Dinas
	public function TpaAso()
	{
		$SQLcari = "";
		if ($this->input->post('search',TRUE)){
			$status = trim($this->input->post('status'));
			$data['status'] = $status;	
			if($status == '1'){
				$SQLcari .= "AND b.status = '1'";
			}else if ($status == '2'){
				$SQLcari .= "AND  b.status ='3' ";
			}else if($status == '3')
			{
				$SQLcari .= "AND  b.status = '5' ";
			}
			$query = $this->Mrekap->getDataRekapTPAPerAso($SQLcari);	
		}
		else 
		{
			$query = $this->Mrekap->getDataRekapTPAPerAso($SQLcari);
		}
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['title']		= '';
		$data['heading']	= '';
		$this->template->load('template/template_backend', 'Rekap/Eksisting/RekapTpaAso', $data);
	}

	public function RekapProv()
	{
		$SQLcari = "";
		$query = $this->Mrekap->getDataRekapProv($SQLcari);
		
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		
		$data['title']		= '';
		$data['heading']	= '';
		$this->template->load('template/template_backend', 'Rekap/Eksisting/RekapProv', $data);
	}

	public function RekapKab()
	{
		$SQLcari = "";
		$provinsi	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$opt_prov = ['0' => '-- Pilih Provinsi --'];
		foreach ($provinsi->result() as $value) {
			$opt_prov[$value->id_provinsi] = $value->nama_provinsi;
		}
		$data['status'] = '0';
		$data['select_prov'] = '0';
		if ($this->input->post('search', TRUE)) {
			$status = trim($this->input->post('status'));
			$prop_p = trim($this->input->post('provinsi'));
			$data['status'] = $status;
			if ($status == '1') {
				$SQLcari .= "AND b.status = '1'";
			} else if ($status == '2') {
				$SQLcari .= "AND  b.status ='3' ";
			} else if ($status == '3') {
				$SQLcari .= "AND  b.status = '5' ";
			}
			if ($prop_p != '0') {
				$SQLcari .= "AND a.id_provinsi = $prop_p";
				$data['select_prov'] = $prop_p;
			}
			$query = $this->Mrekap->getDataRekapKab($SQLcari);
		} else {
			$query = $this->Mrekap->getDataRekapKab($SQLcari);
		}
		$data['opt_prov'] = $opt_prov;
		//$query = $this->Mrekap->getDataRekapKab($SQLcari);
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['title']		= '';
		$data['heading']	= '';
		$this->template->load('template/template_backend', 'Rekap/Eksisting/RekapKabKota', $data);
	}

	public function RekapKabBulan()
	{
		$SQLcari = "";
		$provinsi	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$opt_prov = ['0' => '-- Pilih Provinsi --'];
		foreach ($provinsi->result() as $value) {
			$opt_prov[$value->id_provinsi] = $value->nama_provinsi;
		}
		$data['status'] = '0';
		$data['select_prov'] = '0';
		if ($this->input->post('search', TRUE)) {
			$status = trim($this->input->post('status'));
			$prop_p = trim($this->input->post('provinsi'));
			$data['status'] = $status;
			if ($status == '1') {
				$SQLcari .= "AND b.status = '1'";
			} else if ($status == '2') {
				$SQLcari .= "AND  b.status ='3' ";
			} else if ($status == '3') {
				$SQLcari .= "AND  b.status = '5' ";
			}
			if ($prop_p != '0') {
				$SQLcari .= "AND a.id_provinsi = $prop_p";
				$data['select_prov'] = $prop_p;
			}
			$query = $this->Mrekap->getDataRekapKabBulan($SQLcari);
		} else {
			$query = $this->Mrekap->getDataRekapKabBulan($SQLcari);
		}
		$data['opt_prov'] = $opt_prov;
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['title']		= '';
		$data['heading']	= '';
		$this->template->load('template/template_backend', 'Rekap/Eksisting/RekapKabKotaBulan', $data);
	}

	public function RekapKabKot_cetak($prov = 0, $type = 'xls')
	{
		$SQLcari = "";

			$status = 0;
			if ($status == '1') {
				$SQLcari .= "AND b.status = '1'";
			} else if ($status == '2') {
				$SQLcari .= "AND  b.status ='3' ";
			} else if ($status == '3') {
				$SQLcari .= "AND  b.status = '5' ";
			}
			if ($prov != '0') {
				$SQLcari .= "AND a.id_provinsi = $prov";
				$data['select_prov'] = $prov;
			}
			$query = $this->Mrekap->getDataRekapKab($SQLcari);

		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['title']		= '';
		$data['heading']	= '';
		$html = $this->load->view('Rekap/Eksisting/RekapKabKota_cetak', $data, TRUE);
		print_cetak($html, $type, 'Cetak', 'P');
	}

	public function RekapKabKotBulanCetak($prov = 0, $type = 'xls')
	{
		$SQLcari = "";

			$status = 0;
			if ($status == '1') {
				$SQLcari .= "AND b.status = '1'";
			} else if ($status == '2') {
				$SQLcari .= "AND  b.status ='3' ";
			} else if ($status == '3') {
				$SQLcari .= "AND  b.status = '5' ";
			}
			if ($prov != '0') {
				$SQLcari .= "AND a.id_provinsi = $prov";
				$data['select_prov'] = $prov;
			}
			$query = $this->Mrekap->getDataRekapKabBulan($SQLcari);

		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['title']		= '';
		$data['heading']	= '';
		$html = $this->load->view('Rekap/Eksisting/RekapKabKotaBulanCetak', $data, TRUE);
		print_cetak($html, $type, 'Cetak', 'P');
	}

	public function TPA()
	{
		//id_kabkot			= $this->session->userdata('loc_id_kabkot');
		$SQLcari = "";
		$provinsi	= $this->Mglobal->listDataProvinsi('id_provinsi,nama_provinsi');
		$opt_prov = ['0' => '-- Pilih Provinsi --'];
		foreach ($provinsi->result() as $value) {
			$opt_prov[$value->id_provinsi] = $value->nama_provinsi;
		}
		$data['status'] = '0';
		$data['select_prov'] = '0';
		if ($this->input->post('search', TRUE)) {
			$status = trim($this->input->post('status'));
			$prop_p = trim($this->input->post('provinsi'));
			$data['status'] = $status;
			if ($status == '1') {
				$SQLcari .= "AND b.status = '1'";
			} else if ($status == '2') {
				$SQLcari .= "AND  b.status ='3' ";
			} else if ($status == '3') {
				$SQLcari .= "AND  b.status = '5' ";
			}
			if ($prop_p != '0') {
				$SQLcari .= "AND a.id_provinsi = $prop_p";
				$data['select_prov'] = $prop_p;
			}
			$query = $this->Mrekap->getDataRekapTPA($SQLcari);
		} else {
			$query = $this->Mrekap->getDataRekapTPA($SQLcari);
		}
		$data['opt_prov'] = $opt_prov;
		$data['jum_data'] = $query->num_rows();
		$data['result'] = $query->result();
		$data['title']		= '';
		$data['heading']	= '';
		$this->template->load('template/template_backend', 'Rekap/Eksisting/RekapTPA', $data);
	}

	public function RekapUniversitas()
	{
		$SQLcari = "";
		if ($this->input->post('search',TRUE)){
			$status = trim($this->input->post('status'));
			$data['status'] = $status;	
			if($status == '1'){
				$SQLcari .= "AND b.status = '1'";
			}else if ($status == '2'){
				$SQLcari .= "AND  b.status ='3' ";
			}else if($status == '3')
			{
				$SQLcari .= "AND  b.status = '5' ";
			}
			$query = $this->Mrekap->getDataRekapTPAPerUni($SQLcari);	
		}
		else 
		{
			$query = $this->Mrekap->getDataRekapTPAPerUni($SQLcari);
		}
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['title']		= '';
		$data['heading']	= '';
		$this->template->load('template/template_backend', 'Rekap/Eksisting/RekapTpaUni', $data);
	}

	

	public function DataTpa()
	{
		$SQLcari 			= "";
		$data['Verifikasi'] = $this->Mrekap->getListTpa($SQLcari);
		$data['content']	= $this->load->view('Eksisting/RekapDataTpa', $data, TRUE);
		$data['title']		=	'';
		$data['heading']	=	'';
		$this->load->view('backend_adm', $data);
		
	}
}
