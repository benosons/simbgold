<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Persyaratan extends CI_Controller {

	var $limit = 50;	
	function __construct()
	{
		parent::__construct();	
		$this->load->model('persyaratan_model','msyarat');
	}
	
	function index()
	{	
		$this->persyaratan_list();
	}
	
	function killSession()
	{
		$this->session->unset_userdata('skeynama');	
	}
	

	function persyaratan_list()
	{
		/* Begin Paging & Searching */
		if ($this->input->post('search',TRUE)){
			$id_jenis_persyaratan = $this->input->post('id_jenis_persyaratan'); 
			$data['id_jenis_persyaratan'] = $id_jenis_persyaratan; 
			
			$nama_syarat = $this->input->post('nama_syarat'); 
			$data['nama_syarat'] = $nama_syarat;

			// Load data dari tabel berdasar kriteria			
			$query = $this->msyarat->get_persyaratan_list(null,$id_jenis_persyaratan,$nama_syarat);	
		}
		else 
		{
			// Load data dari tabel
			$query = $this->msyarat->get_persyaratan_list();
		}				
		
		$data['jum_data'] = $query->num_rows();		
		$data['result'] = $query->result();
		$data['model_prov'] = $this->msyarat;
		$data['head_title'] = '.:: Persyaratan ::.';
		
		$this->template->load('admin_template', 'persyaratan/persyaratan_list',$data);	
	}

	function persyaratan_form()
	{
		$id = $this->uri->segment(3);
		$data['id_syarat'] = $id;
		
		if( is_null($id) || trim($id) == '' ) {
			$data['head_title'] = 'Entry persyaratan';
		} else {
			$data['head_title'] = 'Edit persyaratan';
		}
		
		$config = array (		
						array(
							'field'=>'nama_syarat',
							'label'=>'Nama persyaratan',
							'rules'=>'trim|required'
							)
						);
		 	
		if( ! is_null($id) && (trim($id) != '') && ! $this->input->post('save')) {
			// retrieve data;
			$query = $this->msyarat->get_persyaratan_list(trim($id));
			$mydata = $query->row_array();
			$baris = $query->num_rows();
			if ($baris >= 1 ) {
				$data['nama_syarat'] = $mydata['nama_syarat'];
				$data['id_jenis_persyaratan'] = $mydata['id_jenis_persyaratan'];
				
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
				$nama_syarat = $this->input->post('nama_syarat');
				$id_jenis_persyaratan = $this->input->post('id_jenis_persyaratan');
				
				$dataIn = array ('nama_syarat' => $nama_syarat,
								'id_jenis_persyaratan' => $id_jenis_persyaratan	,
					);
				
				if (is_null($id) || trim($id) == '') {
					//insert data baru
					try {
						$this->msyarat->insert_persyaratan($dataIn);
						$this->session->set_flashdata('pesan', 'Data has been saved successfully');
					}
					catch (Exception $e) {
						$this->session->set_flashdata('pesan', 'Data failed to saved');	
					}
				} else {
				// update data
					try {
						$this->msyarat->update_persyaratan($dataIn,$id);
						$this->session->set_flashdata('pesan', 'Data has been updated successfully');
					}
					catch (Exception $e) {
						$this->session->set_flashdata('pesan', 'Data failed to updated');	
					}
				}
				redirect('persyaratan/persyaratan_list');
			}	
		}
		$this->template->load('admin_template','persyaratan/persyaratan_form',$data);
	}
	
		
	function persyaratan_delete()
	{
		$id = $this->uri->segment(3);
		if (isset($id) && $id != '' ) {
			$this->msyarat->delete_persyaratan($id);
			$this->session->set_flashdata('pesan', 'Data has been delete successfully !');
		}
		else {
			$this->session->set_flashdata('errmsg', '<p>Choice data to delete</p>');
		}
		redirect('persyaratan/persyaratan_list');
	}
}
