<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class RekapPusat extends CI_Controller {

	var $limit = 1000;
	public function __construct()
    {
        parent::__construct();
		$this->load->helper('utility');
		$this->load->library('mypagination' );
		$this->load->model('mrekap');
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
		//$this->killSession();
		$this->penetapan_retribusi_list();
	}

	public function MonitoringIMB()
	{
		$data['dataimb']   	= $this->mrekap->getDataMonitoringIMB();
		$data['content']	= $this->load->view('IMB/RekapImb',$data,TRUE);
		$data['title']		= 'Monitoring IMB';
		$data['heading']	= '';
		$this->load->view('backend_adm',$data);
	}
	
	function MonitoringSLF()
	{
		$data['dataimb']   ='';
		$data['content']	= $this->load->view('SLF/RekapSlf',$data,TRUE);
		$data['title']		=	'Rekap Sertifikat Laik Fungsi';
		$data['heading']		=	'';
		$this->load->view('backend_rekap',$data);
	}
	
	public function RekapPermohonan()
	{
		$data['dataimb']   	= $this->mrekap->getDataRetribusiIMB();
		$data['content']	= $this->load->view('IMB/RekapPermohonan',$data,TRUE);
		$data['title']		= 'Rekap Retribusi';
		$data['heading']	= '';
		$this->load->view('backend_adm',$data);
	}
	
	public function Retribusi()
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
			
			$tanggalawal = $this->input->post('tanggalawal');
			$tgl_permohonan_awal2 = date('Y-m-d',strtotime($tanggalawal));
			$tanggalakhir = $this->input->post('tanggalakhir2');
			$tgl_permohonan_akhir2 = date('Y-m-d',strtotime($tanggalakhir));
			$data['tanggalawal'] = $tanggalawal;
			$data['tanggalakhir'] = $tanggalakhir;
			if (trim($tanggalakhir) !='' && trim($tanggalakhir) !='')
			{
				$SQLcari .= " AND g.tgl_imb between '$tgl_permohonan_awal2' AND '$tgl_permohonan_akhir2'";
			}
			
			if($this->session->userdata('loc_id_kabkot')){
				$id_kabkot = $this->session->userdata('loc_id_kabkot');
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$data['dataimb'] = $this->mrekap->getDataPermohonan(0,1,$this->limit,$offset,null,$SQLcari);	
		}else if ($this->session->userdata('pencarian') == TRUE){
			$SQLcari = '';
			if($this->session->userdata('loc_id_kabkot')){
				$id_kabkot = $this->session->userdata('loc_id_kabkot');
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$data['dataimb'] = $this->mrekap->getDataPermohonan(0,1,$this->limit,$offset,null,$SQLcari);
		}else{
			$this->killSession();
			if($this->session->userdata('loc_id_kabkot')){
				$id_kabkot = $this->session->userdata('loc_id_kabkot');
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$data['dataimb'] = $this->mrekap->getDataPermohonan(0,1,$this->limit,$offset,null,$SQLcari);
		}
		
		$data['content']	= $this->load->view('IMB/retribusi',$data,TRUE);
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
				$SQLcari .= "AND b.status_progress >= 14 ";
				}
			if ($status == '2')
			{
				$SQLcari .= "AND  b.status_progress =16 ";
			}
			
			$tahun = $this->input->post('tahun');
			$tahun2 = $this->input->post('tahun2');
			$data['tahun'] = $tahun;
			$data['tahun2'] = $tahun2;
			if (trim($tahun2) !='' && trim($tahun2) !='')
			{	
				$SQLcari .= " AND year(b.tgl_permohonan) between '$tahun' AND '$tahun2'";
			}
			// Load data dari tabel berdasar kriteria
			/*if($this->session->userdata('loc_id_kabkot')){
				$id_kabkot = $this->session->userdata('loc_id_kabkot');
				$SQLcari .= " AND b.id_kabkot_bg = '$id_kabkot' ";
			}*/
			$query = $this->mrekap->get_rekap_fungsi_bg($SQLcari);	
		}
		else 
		{
			/*if($this->session->userdata('loc_id_kabkot')){
				$id_kabkot = $this->session->userdata('loc_id_kabkot');
				$SQLcari .= " AND b.id_kabkot_bg = '$id_kabkot' ";
			}*/
			// Load data dari tabel
			$query = $this->mrekap->get_rekap_fungsi_bg($SQLcari);
		}
		
		$data['jum_data'] = $query->num_rows();	
		$data['result'] = $query->result();
		$data['head_title'] = '.:: SIMBG ::.';
		
		$data['content']	= $this->load->view('IMB/RekapPerIMB',$data,TRUE);
		$data['title']		= 'Rekap Permohonan';
		$data['heading']	= '';
		$this->load->view('backend_adm',$data);
	}
	
	function permohonan_list()
	{
		// Cuma Dinas Yang Bisa Akses
		if ($this->qi_auth->get_id_rule() == '3') {
			$this->qi_auth->logout();
			redirect(index_page());
		}
		// Mengambil Jenis Permohonan
		$queJenisUrusan = $this->mpermohonan->get_jenis_pelayanan_list()->result();
		$list_jenis_urusan[''] = '--Pilih--';
		foreach ($queJenisUrusan as $row) 
		{
			$list_jenis_urusan[$row->id_jenis_permohonan] = $row->nama_permohonan;
		}
		$data['list_jenis_urusan'] = $list_jenis_urusan;
		
		$queKlasifikasi_bg = $this->m_mpermohonan->get_klasifikasi_bg()->result();
		$list1[''] = '--Pilih--';
		foreach ($queKlasifikasi_bg as $row) 
		{
			$list1[$row->id_klasifikasi_bg] = $row->klasifikasi_bg;
		}
		$data['list1'] = $list1;
		
		$uri_segment = 3;
		$offset = 0;
		$SQLcari = "";
		
		if ($this->input->post('search',TRUE)){
			$this->session->set_userdata('pencarian' ,1); 
			
			$tgl_permohonan_awal = $this->input->post('tgl_permohonan_awal');
			$tgl_permohonan_awal2 = date('Y-m-d',strtotime($tgl_permohonan_awal));
			$tgl_permohonan_akhir = $this->input->post('tgl_permohonan_akhir');
			$tgl_permohonan_akhir2 = date('Y-m-d',strtotime($tgl_permohonan_akhir));
			$data['tgl_permohonan_awal'] = $tgl_permohonan_awal;
			$data['tgl_permohonan_akhir'] = $tgl_permohonan_akhir;
			if (trim($tgl_permohonan_akhir) !='' && trim($tgl_permohonan_akhir) !='')
			{
				$SQLcari .= " AND a.tgl_permohonan between '$tgl_permohonan_awal2' AND '$tgl_permohonan_akhir2'";
			}
			
			
			$nama_kabkota = $this->input->post('nama_kabkota');
			$id_kabkot = trim($this->input->post('id_kabkot'));
			$data['nama_kabkota'] = $nama_kabkota;
			$data['id_kabkot'] = $id_kabkot;
			if (trim($id_kabkot) != '')
			{
				$this->session->set_userdata('skeynama_kabkota' ,$nama_kabkota);
				$this->session->set_userdata('skeyid_kabkot' ,$id_kabkot); 
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot'";
			}
			
			//username
			$nomor_registrasi = trim($this->input->post('nomor_registrasi'));
			$data['nomor_registrasi'] = $nomor_registrasi;
			if (trim($nomor_registrasi) != '')
			{
				$this->session->set_userdata('skeynomor_registrasi' ,$nomor_registrasi); 
				$SQLcari .= " AND a.nomor_registrasi LIKE '%$nomor_registrasi%'";
			}
			
			$nama_pemohon = trim($this->input->post('nama_pemohon'));
			$data['nama_pemohon'] = $nama_pemohon;
			if (trim($nama_pemohon) != '')
			{
				$this->session->set_userdata('skeynama_pemohon' ,$nama_pemohon); 
				$SQLcari .= " AND a.nama_pemohon LIKE '%$nama_pemohon%'";
			}
			
			$jenis_urusan = trim($this->input->post('jenis_urusan'));
			$data['jenis_urusan'] = $jenis_urusan;
			if (trim($jenis_urusan) != '')
			{
				$this->session->set_userdata('skeyjenis_urusan' ,$jenis_urusan); 
				$SQLcari .= " AND a.id_jenis_permohonan = '$jenis_urusan'";
			}
			$id_jenis_bg = $this->input->post('id_jenis_bg');
			$data['id_jenis_bg'] = $id_jenis_bg;
			if (trim($id_jenis_bg) != '')
			{
				$id_jenis_bg = trim($id_jenis_bg);
				$this->session->set_userdata('skeyjenis_urusan' ,$id_jenis_bg); 
				$SQLcari .= " AND a.id_jenis_bg = '$id_jenis_bg'";
			}
			
			$klasifikasi_bg = $this->input->post('klasifikasi_bg');
			$data['klasifikasi_bg'] = $klasifikasi_bg;
			if (trim($klasifikasi_bg) != '')
			{
				$klasifikasi_bg = trim($klasifikasi_bg);
				$this->session->set_userdata('skeyklasifikasi_bg' ,$klasifikasi_bg); 
				$SQLcari .= " AND c.id_klasifikasi_bg = '$klasifikasi_bg'";
			}
			
			$id_pemanfaatan_bg = $this->input->post('id_pemanfaatan_bg');
			$data['id_pemanfaatan_bg'] = $id_pemanfaatan_bg;
			if (trim($id_pemanfaatan_bg) != '')
			{
				$id_pemanfaatan_bg = trim($id_pemanfaatan_bg);
				$this->session->set_userdata('skeyid_pemanfaatan_bg' ,$id_pemanfaatan_bg); 
				$SQLcari .= " AND o.id_pemanfaatan_bg = '$id_pemanfaatan_bg'";
			}
			
			$id_jenis_permohonan = $this->input->post('id_jenis_permohonan');
			$nama_permohonan = $this->input->post('nama_permohonan');
			$data['id_jenis_permohonan'] = $id_jenis_permohonan;
			$data['nama_permohonan'] = $nama_permohonan;

			if (trim($id_jenis_permohonan) != '')
			{
				$id_jenis_permohonan = trim($id_jenis_permohonan);
				$this->session->set_userdata('skeyjenis_urusan' ,$id_jenis_permohonan); 
				$SQLcari .= " AND a.id_jenis_permohonan = '$id_jenis_permohonan'";
			}
			
			//Pencarian Periode Surat Masuk
			$tgl_permohonan_awal = $this->input->post('tgl_permohonan_awal');
			$tgl_permohonan_awal2 = date('Y-m-d',strtotime($tgl_permohonan_awal));
			$tgl_permohonan_akhir = $this->input->post('tgl_permohonan_akhir');
			$tgl_permohonan_akhir2 = date('Y-m-d',strtotime($tgl_permohonan_akhir));
			$data['tgl_permohonan_awal'] = $tgl_permohonan_awal;
			$data['tgl_permohonan_akhir'] = $tgl_permohonan_akhir;
			if (trim($tgl_permohonan_akhir) !='' && trim($tgl_permohonan_akhir) !='')
			{
				$SQLcari .= " AND a.tgl_permohonan between '$tgl_permohonan_awal2' AND '$tgl_permohonan_akhir2'";
			}
			
			//echo $SQLcari;
			if($this->qi_auth->get_id_kabkot()){
				$id_kabkot = $this->qi_auth->get_id_kabkot();
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$query = $this->mpermohonan->getDataPermohonan(0,1,$this->limit,$offset,null,$SQLcari);	
			$jum_data = $this->mpermohonan->getDataPermohonan(1,0,null,null,null,$SQLcari);
		}else if ($this->session->userdata('pencarian') == TRUE){
			$SQLcari = '';
			
			if($this->qi_auth->get_id_kabkot()){
				$id_kabkot = $this->qi_auth->get_id_kabkot();
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$query = $this->mpermohonan->getDataPermohonan(0,1,$this->limit,$offset,null,$SQLcari);	
			$jum_data = $this->mpermohonan->getDataPermohonan(1,0,null,null,null,$SQLcari);
		}else{
			$this->killSession();
			if($this->qi_auth->get_id_kabkot()){
				$id_kabkot = $this->qi_auth->get_id_kabkot();
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$query = $this->mpermohonan->getDataPermohonan(0,1,$this->limit,$offset,null,$SQLcari);	
			$jum_data = $this->mpermohonan->getDataPermohonan(1,0,null,null,null,$SQLcari);	
		}
		$this_url = 'permohonan/permohonan_list/';
		$data2 = $this->mypagination->getPagination($jum_data,$this->limit,$this_url,$uri_segment);
		$data['paging'] = $data2['link'];
		$data['offset'] = $offset;
		$data['jum_data'] = $query->num_rows();
		$data['results'] = $query->result_array();
		$data['head_title'] = '.:: SIMBG ::.';
		$this->template->load('admin_template', 'permohonan/permohonan_list',$data);		
	}
	
	public function cetakRekapRetribusi()
	{
		$id_kabkot_bg			= $this->session->userdata('loc_id_kabkot');
		$filterQuery			= 'a.id_permohonan,a.nama_pemohon,a.alamat_bg,k.retribusi_manual, j.nama_permohonan';
		$data['retribusi']   	= $this->mrekap->getDataRekapRetribusi($id_kabkot_bg);
		$retribusi   			= $this->mrekap->getDataRekapRetribusi($id_kabkot_bg);
		//$data['result_list'] 	= $this->mrekap->get_penerbitan_imb_cetak($id);
		$this->load->view('IMB/CetakRekapRetribusi',$data);
	}
	
	public function cetak_excel()
	{
		$id_kabkot_bg			= $this->session->userdata('loc_id_kabkot');
		$filterQuery			= 'a.id_permohonan,a.nama_pemohon,a.alamat_bg,k.retribusi_manual, j.nama_permohonan';
		$data['retribusi']   	= $this->mrekap->getDataRekapRetribusi($id_kabkot_bg);
		$retribusi   			= $this->mrekap->getDataRekapRetribusi($id_kabkot_bg);
		
		$data['jum_data'] 		= $retribusi->num_rows();	
		$data['result'] 		= $retribusi->result();
		
		//$data['result_list'] 	= $this->mrekap->get_penerbitan_imb_cetak($id);
		$this->load->view('IMB/Laporan_Excel',$data);
	}
	
	public function cetak(){
		$id_kabkot_bg			= $this->session->userdata('loc_id_kabkot');
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                $ket = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($tgl));
                //$transaksi = $this->TransaksiModel->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
				//$retribusi = $this->mrekap->getDataRekapRetribusi(); // Panggil fungsi view_all yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                //$transaksi = $this->TransaksiModel->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
				//$retribusi = $this->mrekap->getDataRekapRetribusi(); // Panggil fungsi view_all yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Transaksi Tahun '.$tahun;
                //$transaksi = $this->TransaksiModel->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi';
			$retribusi = $this->mrekap->view_all(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $retribusi = $this->mrekap->view_all();
        
    ob_start();
    $this->load->view('IMB/cetak', $data);
    $html = ob_get_contents();
        ob_end_clean();
        
    require_once('./assets/toPdf/html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','en');
    $pdf->WriteHTML($html);
    $pdf->Output('Rekap Retribusi.pdf', 'D');
  }

	
	

	
}
