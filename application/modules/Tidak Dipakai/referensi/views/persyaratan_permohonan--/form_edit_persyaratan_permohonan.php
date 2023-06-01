
		<form action="<?php echo site_url('referensi/saveDataPersyaratanPermohonan');?>" class="form-horizontal" role="form" method="post" id="form_edit_persyaratan_permohonan">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Persyaratan Permohonan</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 ">		
							<div class="portlet box green ">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i>Pengaturan Akses
									</div>
									<div class="tools">
										<a href="javascript:;" class="collapse">
										</a>
										<a href="javascript:;" class="reload">
										</a>
									</div>
								</div>
								<div class="portlet-body">									
									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Nama Permohonan</label>
											<div class="col-md-9">
												<div>
													<input type="hidden" class="form-control" id="id" value="<?php echo $row->id?>" name="id" placeholder="id" autocomplete="off">
													<input type="text" class="form-control" id="nama_permohonan" value="<?php echo $row->nama_permohonan?>" name="nama_permohonan" placeholder="Nama Permohonan" autocomplete="off" disabled>
												</div>
											</div>
										</div>
									</div>	
								</div>
							</div>
						</div>

						<div class="col-md-6 ">
							<div class="portlet green-meadow box">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-cogs"></i>Daftar Dokumen Persyaratan
									</div>
									<div class="tools">
										<a href="javascript:;" class="collapse">
										</a>
										<a href="javascript:;" class="reload">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									<div id="show_listmenueditAdm"></div>
									<div id="show_listmenueditTeknis"></div>
								</div>
							</div>														
						</div>	
							
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn default">Batal</button>
					<button type="submit" class="btn green">Simpan</button>
				</div>
			</div>	
		</form>			
	

<script type="text/javascript">
	var id = $('#id').val();
	$(function () {    
	 // Setup form validation on the #register-form element
	jQuery.post(base_url+'referensi/listPersyaratanAdmShow',{value:id,disable:'N'},function(data){	
			jQuery('#show_listmenueditAdm').append(data);
			
	});
	
	jQuery.post(base_url+'referensi/listPersyaratanTeknisShow',{value:id,disable:'N'},function(data){	
			jQuery('#show_listmenueditTeknis').append(data);
			
	});
	
	$("#form_edit_persyaratan_permohonan").validate({
	    // Specify the validation rules
	    rules: {
	        name: "required",	        
	        member: "required",
	        published: "required",
	    },
	        highlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	    },
	        unhighlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	    },
	      errorClass: 'help-block',
	    
	    // Specify the validation error messages
	    messages: {
	        name: "Masukan Nama Role",
	        member: "Pilih Kelompok Pengguna",	        
	        published: "Pilih Status",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	        
	    }
	});

	
		
	
	

	

}); 




</script>