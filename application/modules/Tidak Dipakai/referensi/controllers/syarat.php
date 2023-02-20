<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Syarat extends CI_Controller {

	var $limit = 50;	
	function __construct()
	{
		parent::__construct();	
		$this->load->helper('utility');
		$this->load->library('mypagination' );
		$this->load->model('syarat_model','msyarat');
	}
	
	function index()
	{	
		$this->killSession();
		$this->persyaratan_list();
	}
	
	function killSession()
	{
		//$this->session->unset_userdata('skeynama');	
	}
	
	function persyaratan_list()
	{
		/* Begin Paging & Searching */
		$queJenisUrusan = $this->msyarat->get_jenis_permohonan_list()->result();
		$list_jenis_urusan[''] = '--Pilih--';
		foreach ($queJenisUrusan as $row) 
		{
			$list_jenis_urusan[$row->id_jenis_permohonan] = $row->nama_permohonan;
		}
		$data['list_jenis_urusan'] = $list_jenis_urusan;
		
		
		$queKlasifikasi_bg = $this->msyarat->get_klasifikasi_bg()->result();
		$list1[''] = '--Pilih--';
		foreach ($queKlasifikasi_bg as $row) 
		{
			$list1[$row->id_klasifikasi_bg] = $row->klasifikasi_bg;
		}
		$data['list1'] = $list1;
		
		
		if ($this->input->post('search',TRUE)){
			$keynama = $this->input->post('txtcari_nama'); 
			$data['txtcari_nama'] = $keynama; 
			
			$keyid_pemanfaatan_bg = $this->input->post('id_pemanfaatan_bg');
			$data['id_pemanfaatan_bg'] = $keyid_pemanfaatan_bg;
			
			$keyklasifikasi_bg = $this->input->post('klasifikasi_bg');
			$data['klasifikasi_bg'] = $keyklasifikasi_bg; 
			
			$keyid_gol_objek_imb = $this->input->post('id_gol_objek_imb');
			$data['id_gol_objek_imb'] = $keyid_gol_objek_imb; 
			
			$keyid_jenis_permohonan = $this->input->post('id_jenis_permohonan');
			$data['id_jenis_permohonan'] = $keyid_jenis_permohonan;
			// Load data dari tabel berdasar kriteria			
			$query = $this->msyarat->get_syarat_list(null,$keynama,$keyid_pemanfaatan_bg,$keyid_gol_objek_imb,$keyid_jenis_permohonan);	
		}
		else 
		{
			// Load data dari tabel
			$query = $this->msyarat->get_syarat_list();
		}			
		
		$data['jum_data'] = $query->num_rows();		
		$data['result'] = $query->result();
		$data['model_syarat'] = $this->msyarat;
		$data['head_title'] = '.:: Syarat ::.';	
		/* Begin List Akses Menu */
		$data['head_title'] = '.:: SIMBG ::.';
		$this->template->load('admin_template', 'syarat/persyaratan_list',$data);	
	}

	function persyaratan_form()
	{
		$id = $this->uri->segment(3);
		$data['id_persyaratan'] = $id;
		
	
		
		$queFungsi_bg = $this->msyarat->get_fungsi_bg()->result();
		$list_fungsi_bg[''] = '--Pilih--';
		foreach ($queFungsi_bg as $row) 
		{
			$list_fungsi_bg[$row->id_fungsi_bg] = $row->fungsi_bg;
		}
		$data['list_fungsi_bg'] = $list_fungsi_bg;
		
		
		if( is_null($id) || trim($id) == '' ) {
			$data['head_title'] = 'Entry Syarat';
		} else {
			$data['head_title'] = 'Edit Syarat';
		}
		
		$queJenisUrusan = $this->msyarat->get_jenis_permohonan_list()->result();
		$list_jenis_urusan[''] = '--Pilih--';
		foreach ($queJenisUrusan as $row) 
		{
			$list_jenis_urusan[$row->id_jenis_permohonan] = $row->nama_permohonan;
		}
		$data['list_jenis_urusan'] = $list_jenis_urusan;
		
		$config = array (		
						array(
							'field'=>'id_jenis_permohonan',
							'label'=>'Nama Permohonan',
							'rules'=>''
							),
						array(
							'field'=>'nama_persyaratan',
							'label'=>'Persyaratan Wajib Di isi',
							'rules'=>'trim|required'
							)
						);
		 	
		if( ! is_null($id) && (trim($id) != '') && ! $this->input->post('save')) {
			// retrieve data;
			$query = $this->msyarat->get_syarat_list(trim($id));
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['id_jenis_permohonan'] = $mydata['id_jenis_permohonan'];
				$data['id_jenis_persyaratan'] = $mydata['id_jenis_persyaratan'];
				$data['nama_persyaratan'] = $mydata['nama_persyaratan'];
				$data['id_detail_jenis_persyaratan'] = $mydata['id_detail_jenis_persyaratan']; 
				//$data['fungsi_bg'] = $mydata['id_fungsi_bg'];
			}
		}
		
		if($this->input->post('save')) {
		 	// Form submited, check rules
			$this->form_validation->set_rules($config); 
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			
			if($this->form_validation->run() === FALSE) {
				$data['err_msg'] = validation_errors();
			}
			else {
				// POSTING VARIABLE
				$id_jenis_permohonan = $this->input->post('id_jenis_permohonan');	
				$id_detail_jenis_persyaratan = $this->input->post('id_detail_jenis_persyaratan');
				$nama_persyaratan = $this->input->post('nama_persyaratan');
				$id_jenis_persyaratan = $this->input->post('id_jenis_persyaratan');
				$dataIn = array (
								'id_jenis_permohonan' => $id_jenis_permohonan,
								'id_jenis_persyaratan' => $id_jenis_persyaratan,
								'id_detail_jenis_persyaratan' => $id_detail_jenis_persyaratan,
								'nama_persyaratan' => $nama_persyaratan,
							);
				
				if (is_null($id) || trim($id) == '') {
					//insert data baru
					try {
						$this->msyarat->insert_syarat($dataIn);
						$this->session->set_flashdata('pesan', 'Data has been saved successfully');
					}
					catch (Exception $e) {
						$this->session->set_flashdata('pesan', 'Data failed to saved');	
					}
				} else {
				// update data
					try {
						$this->msyarat->update_syarat($dataIn,$id);
						$this->session->set_flashdata('pesan', 'Data has been updated successfully');
					}
					catch (Exception $e) {
						$this->session->set_flashdata('pesan', 'Data failed to updated');	
					}
				}
				redirect('syarat/persyaratan_list');
				//print_r($dataIn);
			}	
		}
		$this->template->load('admin_template','syarat/persyaratan_form',$data);
	}	
		
	function syarat_delete()
	{
		$id = $this->uri->segment(3);
		if (isset($id) && $id != '' ) {
			$this->msyarat->syarat_delete($id);
			$this->session->set_flashdata('pesan', 'Data has been delete successfully !');
		}
		else {
			$this->session->set_flashdata('errmsg', '<p>Choice data to delete</p>');
		}
		redirect('syarat/persyaratan_list');
	}
		
}

