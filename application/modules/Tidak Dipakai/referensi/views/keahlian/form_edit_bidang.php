
<form action="<?php echo site_url('referensi/saveDataBidang'); ?>" class="form-horizontal" role="form" method="post" id="frm_edit_bidang">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Form Edit Bidang Keahlian</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Nama Bidang Keahlian</label>
							<div class="col-md-9">													
								<input type="hidden" class="form-control" value="<?php echo $row->id_bidang;?>" name="id_bidang" placeholder="id" autocomplete="off">
								<input type="text" class="form-control" value="<?php echo $row->nama_bidang;?>" name="nama_bidang" placeholder="Nama Bidang Keahlian" autocomplete="off">
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" onclick="batal()" class="btn default">Batal</button>
			<button type="submit" class="btn green">Simpan</button>
		</div>
	</div>	
</form>	

<script type="text/javascript">
	$(function () {    
	 // Setup form validation on the #register-form element
	$("#frm_edit_bidang").validate({
	    // Specify the validation rules
	    rules: {
	        nama_bidang: "required",	          
	        //password:{required: true,minlength:6},	        
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
	        nama_bidang: "Masukan Nama Bidang Keahlian",      
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	        
	    }
	});
}); 
</script>