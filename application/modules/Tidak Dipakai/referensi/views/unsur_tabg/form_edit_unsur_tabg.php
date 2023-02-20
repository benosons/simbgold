
<form action="<?php echo site_url('referensi/saveDataUnsurTabg'); ?>" class="form-horizontal" role="form" method="post" id="frm_edit_unsur_tabg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Form Edit Unsur TABG</h4>
		</div>
		<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-group">
								<label class="col-md-3 control-label">Unsur TABG</label>
								<div class="col-md-3">
									<select class="form-control" name="id_unsur" id="id_unsur">
										<option value="1" <?php if($row->id_unsur == '1') echo "selected";?>>Dinas PUPR</option>
										<option value="2" <?php if($row->id_unsur == '2') echo "selected";?>>Instansi Teknis Terkait</option>
										<option value="3" <?php if($row->id_unsur == '3') echo "selected";?>>Ahli</option>
									</select>
								</div>
							</div>
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Unsur </label>
									<div class="col-md-9">
										<input type="hidden" class="form-control" value="<?php echo $row->id_unsur_ahli;?>" name="id_unsur_ahli" placeholder="id" autocomplete="off">
										<input type="text" class="form-control" value="<?php echo $row->nama_unsur_ahli;?>" name="nama_unsur_ahli" placeholder="Nama Unsur Ahli" autocomplete="off">
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
	$("#frm_edit_unsur_tabg").validate({
	    // Specify the validation rules
	    rules: {
	        nama_provinsi: "required",	          	        
	 
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
	        nama_provinsi: "Masukan Nama Provinsi",
	        username: "Masukan Username",	        
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
}); 
</script>