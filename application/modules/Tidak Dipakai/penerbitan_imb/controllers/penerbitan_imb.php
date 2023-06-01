<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penerbitan_imb extends CI_Controller {

	var $limit = 1000;
	public function __construct()
    {
        parent::__construct();
		$this->load->helper('utility');
		$this->load->library('mypagination' );
		$this->load->model('mpenerbitan_imb');
		$this->load->model('mpermohonan');
		$this->load->model('master_permohonan_model','m_mpermohonan');
		$this->load->model('mpenjadwalan');
		$this->load->model('mpenugasan');
		//$this->load->library('oss_lib');
		//$this->qi_auth->check_permissions_v2();
	}

	function killSession()
	{
		$this->session->unset_userdata('pencarian');
	}

	public function index()
	{
		//$this->killSession();
		$this->penerbitan_imb_list();
	}

	function penerbitan_imb_list()
	{
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

			$nama_pemohon = $this->input->post('nama_pemohon');
			$data['nama_pemohon'] = $nama_pemohon;
			if (trim($nama_pemohon) != '')
			{
				$nama_pemohon = trim($nama_pemohon);
				$this->session->set_userdata('skeynama_pemohon' ,$nama_pemohon);
				$SQLcari .= " AND a.nama_pemohon LIKE '%$nama_pemohon%'";
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
				$SQLcari .= " AND k.id_klasifikasi_bg = '$klasifikasi_bg'";
			}

			$id_pemanfaatan_bg = $this->input->post('id_pemanfaatan_bg');
			$data['id_pemanfaatan_bg'] = $id_pemanfaatan_bg;
			if (trim($id_pemanfaatan_bg) != '')
			{
				$id_pemanfaatan_bg = trim($id_pemanfaatan_bg);
				$this->session->set_userdata('skeyid_pemanfaatan_bg' ,$id_pemanfaatan_bg);
				$SQLcari .= " AND d.id_pemanfaatan_bg = '$id_pemanfaatan_bg'";
			}

			if($this->qi_auth->get_id_kabkot()){
				$id_kabkot = $this->qi_auth->get_id_kabkot();
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$query = $this->mpenerbitan_imb->get_penerbitan_imb_list(0,1,$this->limit,$offset,null,$SQLcari);
			$jum_data = $this->mpenerbitan_imb->get_penerbitan_imb_list(1,0,null,null,null,$SQLcari);
		}else if ($this->session->userdata('pencarian') == TRUE){
			$SQLcari = '';

			if($this->qi_auth->get_id_kabkot()){
				$id_kabkot = $this->qi_auth->get_id_kabkot();
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$query = $this->mpenerbitan_imb->get_penerbitan_imb_list(0,1,$this->limit,$offset,null,$SQLcari);
			$jum_data = $this->mpenerbitan_imb->get_penerbitan_imb_list(1,0,null,null,null,$SQLcari);
		}else{
			$this->killSession();
			if($this->qi_auth->get_id_kabkot()){
				$id_kabkot = $this->qi_auth->get_id_kabkot();
				$SQLcari .= " AND a.id_kabkot_bg = '$id_kabkot' ";
			}
			$query = $this->mpenerbitan_imb->get_penerbitan_imb_list(0,1,$this->limit,$offset,null,$SQLcari);
			$jum_data = $this->mpenerbitan_imb->get_penerbitan_imb_list(1,0,null,null,null,$SQLcari);
		}
		//echo $SQLcari;
		$this_url = 'penerbitan_imb_slf/penerbitan_imb_slf_list/';
		$data2 = $this->mypagination->getPagination($jum_data,$this->limit,$this_url,$uri_segment);
		$data['paging'] = $data2['link'];
		$data['offset'] = $offset;
		$data['jum_data'] = $jum_data;
		$data['results'] = $query->result_array();
		$data['head_title'] = '.:: Penetapan Retribusi ::.';
		$this->template->load('admin_template', 'penerbitan_imb/penerbitan_imb_list',$data);
	}

	function penerbitan_imb_form()
	{
		$this->killSession();
		$id_permohonan = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$data['id_penerbitan_imb'] = $id;
		$data['id_permohonan'] = $id_permohonan;
		//get data permohonan
		if( ! is_null($id_permohonan) && (trim($id_permohonan) != '') && (trim($id_permohonan) != '0')) {
			$query = $this->mpenerbitan_imb->get_permohonan_imb(null,null,null,null,$id_permohonan);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['id_jenis_usaha'] = $mydata['id_jenis_usaha'];
				$data['nama_pemohon'] = $mydata['nama_pemohon'];
				$data['alamat_bg'] = $mydata['alamat_bg'];
				$data['kelurahan'] = $mydata['kelurahan'];
				$data['kecamatan'] = $mydata['kecamatan'];
				$data['id_kabkot'] = $mydata['id_kabkot'];
				$data['nama_kabkota'] = $mydata['nama_kabkota'];
				$data['id_provinsi'] = $mydata['id_provinsi'];
				$data['nama_provinsi'] = $mydata['nama_provinsi'];
				$data['tinggi_bg'] = $mydata['tinggi_bg'];
				$data['lantai_bg'] = $mydata['lantai_bg'];
				$data['fungsi_bg'] = $mydata['fungsi_bg'];
				$data['klasifikasi_bg'] = $mydata['klasifikasi_bg'];
				$data['luas_bg'] = $mydata['luas_bg'];
				$data['luas_tanah'] = $mydata['luas_tanah'];
				$data['atas_nama_dok'] = $mydata['atas_nama_dok'];
				$data['nomor_imb'] = $mydata['nomor_imb'];

				$data['no_imb'] = $mydata['no_imb'];
				$data['id_penerbitan_imb'] = $mydata['id_penerbitan_imb'];
				$data['tanggal_imb'] = $mydata['tgl_imb'];
				$data['tgl_berlaku_izin'] = $mydata['tgl_berlaku_izin'];
				//$data['jabatan_ttd'] = $mydata['jabatan_ttd'];
				$data['dir_file_edit'] = $mydata['dir_file_imb'];
				$data['harga_satuan'] = $mydata['harga_satuan'];
				$data['retribusi'] = $mydata['retribusi'];
				$data['retribusi_manual'] = $mydata['retribusi_manual'];
			}
		}
		//end data permohonan
		if($this->input->post('save')) {
			$file_element_name = 'd_file';
			$lam = $this->input->post('dir_file');
			$filename = $_FILES['d_file']['name'];
			$config_file = array(
				'allowed_types' => 'pdf',
				'upload_path' => realpath('./file/IMB/pengajuan_imb/'.$id_permohonan.'/imb_n_lampiran/'),
				'max_size' => 5120000 * 8,
				'file_name' => $filename,
				'remove_spaces' => FALSE
			);
			$this->load->library('upload', $config_file);

			if ((!$this->upload->do_upload($file_element_name)) && ($lam != '') ){
				$data['err_msg'] = $this->upload->display_errors('','');
			}else {
				$no_imb= trim($this->input->post('no_imb'));
				$id_penerbitan_imb= trim($this->input->post('id_penerbitan_imb'));
				$tanggal_imb = tgl_ind_to_eng(trim($this->input->post('tanggal_imb')));
				//Terbaru//
				//$nama_ttd= trim($this->input->post('nama_ttd'));
				//$nip_ttd = trim($this->input->post('nip_ttd'));
				$jabatan_ttd = trim($this->input->post('jabatan_ttd'));
				$tgl_berlaku_izin  = tgl_ind_to_eng(trim($this->input->post('tgl_berlaku_izin')));
				//Terbaru
				$dir_file = trim($this->input->post('dir_file'));
				$dir_file_edit = trim($this->input->post('dir_file_edit'));
				$file_element_name = 'dir_file';
				if($lam != ''){
					$file=$this->upload->data();
					$lampiran=$file['file_name'];
				}else{
					$lampiran=$this->input->post('dir_file_edit');
				}
				$dataIn_imb = array(
					'id_permohonan' => $id_permohonan,
					'no_imb' => $no_imb,
					'tgl_imb' => $tanggal_imb,
					'tgl_berlaku_izin' => $tgl_berlaku_izin,
					'dir_file_imb' => $lampiran,
					//'nama_ttd' => $nama_ttd,
					//'nip_ttd' => $nip_ttd,
					'jabatan_ttd' => $jabatan_ttd,
				);

				if (empty($id_penerbitan_imb) || trim($id_penerbitan_imb) == '' || $id_penerbitan_imb==null || $id_penerbitan_imb=='0') {
					try {
						//print_r;
						$this->mpenerbitan_imb->insert_data_penerbitan_imb($dataIn_imb);
						if (trim($id_permohonan) != '') {
							$tgl_log = date('Y-m-d');
							$keterangan = 'Penerbitan IMB';
							$nama_fb = 'Penerbitan IMB';
							$kode_feedback = '50';
							$kd_akun = '';
							$kd_penerimaan = '';
							$nominal = '';
							$data_log = array (
								'id_permohonan' => $id_permohonan,
								'tgl_log_permohonan' => tgl_ind_to_eng($tgl_log),
								'keterangan' => 'Penerbitan IMB',
								'kode_proses' => 10,
								'dir_file_proses' => $lampiran
							);
							$this->mpermohonan->insert_log_permohonan($data_log);
							//feedback to oss
							$feedback = $this->oss_lib->receiveLicenseStatus($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
							//feedback to oss final
							$feedback_final = $this->oss_lib->receiveLicense($id_permohonan,$kode_feedback,$keterangan,$kd_akun,$kd_penerimaan,$nominal);
						}
						$this->session->set_flashdata('pesan', 'Data Berhasil Disimpan');
						$data['valid'] = 'true';
					}
					catch (Exception $e) {
						$this->session->set_flashdata('pesan', 'Data Gagal Disimpan');
					}
				}else{
					try {
						$this->mpenerbitan_imb->update_data_penerbitan_imb($dataIn_imb,$id_penerbitan_imb);
							$tgl_log = date('Y-m-d');
							$keterangan = 'Penerbitan IMB';
							$nama_fb = 'Penerbitan IMB';
							$kode_feedback = '50';
							$kd_akun = '';
							$kd_penerimaan = '';
							$nominal = '';
						$feedback = $this->oss_lib->receiveLicenseStatus($id_permohonan,$kode_feedback,$tgl_log,null,$nama_fb,$keterangan);
						//sleep(5);
						$feedback_final = $this->oss_lib->receiveLicense($id_permohonan,$kode_feedback,$keterangan,$kd_akun,$kd_penerimaan,$nominal);
						$this->session->set_flashdata('pesan', 'Data Berhasil Diupdate');
						$data['valid'] = 'true';
					}
					catch (Exception $e) {
						$this->session->set_flashdata('pesan', 'Data Gagal Diupdate');
					}
				}
				$this->kirim_email_imb($id_permohonan);
				redirect('penerbitan_imb/penerbitan_imb_form/'.$id_permohonan);
			}
		}
		$this->template->load('admin_template','penerbitan_imb/penerbitan_imb_form',$data);
	}


	function detail_penerbitan_detail()
	{
		$this->killSession();
		$id_permohonan = $this->uri->segment(3);
		$data['id_permohonan'] = $id_permohonan;

		if(trim($id_permohonan) != '' && trim($id_permohonan) != '') {
			$query = $this->mpermohonan->get_detail_imb(null,null,null,null,trim($id_permohonan));
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['statusaha'] = $mydata['id_jenis_usaha'];
				$data['jenis_urusan'] = $mydata['id_jenis_permohonan'];
				$data['nama'] = $mydata['nama_pemohon'];
				$data['jalan'] = $mydata['alamat_pemohon'];
				$data['kelurahan'] = $mydata['kelurahan'];
				$data['kecamatan'] = $mydata['kecamatan'];
				$data['id_kec'] = $mydata['id_kecamatan'];
				$data['nama_kec'] = $mydata['nama_kecamatan'];
				$data['id_kabkot'] = $mydata['id_kabkot'];
				$data['nama_kabkota'] = $mydata['nama_kabkota'];
				$data['id_provinsi'] = $mydata['id_provinsi'];
				$data['nama_provinsi'] = $mydata['nama_provinsi'];
				$data['no_tlpn'] = $mydata['no_tlp'];
				$data['email'] = $mydata['email'];
				$data['ktp'] = $mydata['no_ktp'];
				$data['jabdpershn'] = $mydata['jabatan_perusahaan'];
				$data['nm_pershn'] = $mydata['nama_perusahaan'];
				$data['alamat_pershn'] = $mydata['alamat_perusahaan'];
				$data['no_tlpn_pershn'] = $mydata['no_tlp_perusahaan'];
				$data['jalan_lokasi'] = $mydata['alamat_bg'];
				$data['kel'] = $mydata['kelurahan'];
				$data['kec'] = $mydata['kecamatan'];
				$data['stat'] = $mydata['status'];
				$data['id_fungsi_bg'] = $mydata['id_fungsi_bg'];
				$data['jns_bangunan'] = $mydata['jns_bangunan'];
				$data['username'] = $mydata['username'];
				$data['nama_permohonan'] = $mydata['nama_permohonan'];
				$data['lantai_bg'] = $mydata['lantai_bg'];
				$data['tinggi_bg'] = $mydata['tinggi_bg'];
				$data['luas_bg'] = $mydata['luas_bg'];
				$data['luas_tanah'] = $mydata['luas_tanah'];
				$data['alamat_bg'] = $mydata['alamat_bg'];
				$data['nama_kecamatan'] = $mydata['nama_kecamatan'];
				$data['nama_kabkota_bg'] = $mydata['nama_kabkota_bg'];
				$data['nama_provinsi_bg'] = $mydata['nama_provinsi_bg'];
				$data['id_pemanfaatan_bg'] = $mydata['id_pemanfaatan_bg2'];
				$data['fungsi_bg'] = $mydata['fungsi_bg'];
				$data['id_klasifikasi_bg'] = $mydata['id_klasifikasi_bg'];
				$data['tgl_pelaksanaan'] =  tgl_eng_to_ind($mydata['tgl_pelaksanaan']);
				$data['tgl_permohonan'] =  tgl_eng_to_ind($mydata['tgl_permohonan']);
				$data['id_jenis_bg'] = $mydata['id_jenis_bg'];
				$data['id_prasarana_bg'] = $mydata['id_prasarana_bg'];
				$data['tinggi_prasarana'] = $mydata['tinggi_prasarana'];
				$data['retribusi'] = $mydata['retribusi'];

				$data['no_imb'] = $mydata['no_imb'];
				$data['tgl_imb'] = tgl_eng_to_ind($mydata['tgl_imb']);
				$data['tanggal_penyerahan_imb'] = tgl_eng_to_ind($mydata['tanggal_penyerahan_imb']);
			}
		}
		//get data penjadwalan
		$que2 = $this->mpermohonan->get_dtail_tanah($id_permohonan);
		$data['jmltanah'] = $que2->num_rows();
		$data['result_tanah'] = $que2->result_array();

		if(trim($id_permohonan) != ''){
			$query = $this->mpenjadwalan->get_data_penjadwalan($id_permohonan,null);
			$data['jumdata_penjadwalan'] = $query->num_rows();
			$data['results_penjadwalan'] = $query->result_array();
		}
		$que = $this->mpenugasan->get_data_penugasan($id_permohonan);
		$data['jmlPegawai'] = $que->num_rows();
		$data['result_peg'] = $que->result_array();
		$data['head_title'] = '.:: Detail Retribusi::.';
		$this->template->load('popup_template','penerbitan_imb_slf/detail_penerbitan_imb',$data);
	}

	function delete_file_imb()
	{
		$id = $this->uri->segment(3);
		if(trim($id) != '' && trim($id) != '') {
			try
			{
				$this->mpenerbitan_imb_slf->delete_file_imb($id);
				$status = 'success';
				$msg = 'File successfully deleted';
			}
			catch(Exception $e)
			{
				$status = 'error';
				$msg = 'Something went wrong when deleteing the file, please try again';
			}
		}
		echo json_encode(array('status' => $status, 'msg' => $msg));
	}

	function cetak_form_imb()
	{
		$sqlcari = '';
		$id = $this->uri->segment(3);
		$tanah = $this->mpenerbitan_imb->tanah($id);
		$data['result_list'] = $this->mpenerbitan_imb->get_penerbitan_imb_cetak($id);
		$data['result_retri'] = $this->mpenerbitan_imb->retribusi($id)->row_array();
		$data['result_teknis'] = $this->mpenerbitan_imb->rek_teknis($id)->row_array();
		$data['result_per'] = $this->mpenerbitan_imb->peraturan($id)->result_array();
		$data['result_uu'] = $this->mpenerbitan_imb->undang2()->result_array();
		$data['result_tanah'] = $tanah->result_array();
		$data['count_tanah'] = $tanah->num_rows();
		$data['head_title'] = '.:: Cetak IMB ::.';
		$this->load->view('penerbitan_imb/cetak_imb',$data);
	}

	function kirim_email_imb()
	{
		$email_pemohon = "";
		$nomor_registrasi = "";
		$text_email = "";
		$no_imb = "";
		$dir_file_imb = "";

		$this->load->library('PHPMailerAutoload');
        $mail = new PHPMailer();
		$mail->SMTPDebug = false;
        $mail->Debugoutput = 'html';
		// set smtp
        $mail->isSMTP();
        $mail->Host = gethostbyname('ssl://smtp.gmail.com');
        $mail->Port = '465';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
        $mail->Username = 'simbgcs@gmail.com';
        $mail->Password = 'cssimbg88';
        $mail->WordWrap = 50;

		$id_permohonan = $this->uri->segment(3);
		$id_penerbitan_imb = $this->uri->segment(4);
		$data['id_permohonan'] = $id_permohonan;
		$data['id_penerbitan_imb'] = $id_penerbitan_imb;

		if(trim($id_permohonan) != ''){
			$query = $this->mpermohonan->get_permohonan_list(null,null,null,null,$id_permohonan);
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$email_pemohon = $mydata['email'];
				$nomor_registrasi = $mydata['nomor_registrasi'];
			}

			$query2 = $this->mpenerbitan_imb->get_data_imb($id_permohonan,null);
			$mydata2 = $query2->row_array();
			$baris2 = $query2->num_rows();
			if ($baris2 >= 1 ) {
				//data IMB
				$data['id_penerbitan_imb'] = $mydata2['id_penerbitan_imb'];
				$data['no_imb'] = $mydata2['no_imb'];
				$data['tgl_imb'] = $mydata2['tgl_imb'];
				$data['dir_file_imb'] = $mydata2['dir_file_imb'];
			}

			$text_email .= "Lampiran Surat Izin Mendirikan Bangunan  :<br>";
			$text_email .= "No Registrasi :".$nomor_registrasi."<br>";
			$text_email .= "IMB yang Pemohon mohonkan telah terbit dan bisa diambil di Dinas DPMPTSP sesuai dengan Lokasi Bangunan Gedung. <br>";

			if($dir_file_imb != ''){
				$file = realpath('./file/IMB/pengajuan_imb/'.$id_permohonan.'/imb_n_lampiran/'.$dir_file_imb);
				$mail->AddAttachment( $file, 'SuratIzinMendirikanBangunan.pdf' );
			}

			$mail->setFrom('cssimbg.stanbakpupr@gmail.com', 'CS SIMBG');
			$mail->addAddress($email_pemohon);
			$mail->Subject = 'Penerbitan IMB | CS SIMBG';
			$mail->Body = $text_email;
			$mail->isHTML(true);
			$mail->send();
		}
		$data['mretribusi'] = $this;
		$data['head_title'] = '.:: SIMBG | Penetapan Retribusi ::.';
		$this->template->load('admin_template', 'penerbitan_imb/penerbitan_imb_form',$data);
	}
}
