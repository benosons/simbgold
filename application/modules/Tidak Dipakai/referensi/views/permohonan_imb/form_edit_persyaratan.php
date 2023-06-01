
<form action="<?php echo site_url('referensi/saveDataPersyaratan'); ?>" class="form-horizontal" role="form" method="post" id="frm_edit_persyaratan">
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
								<div class="col-md-4">
									<select class="form-control" name="id_jenis_persyaratan" id="id_jenis_persyaratan">
										<option value="1" <?php if($row->id_jenis_persyaratan == '1') echo "selected";?>>Persyaratan Administrasi</option>
										<option value="2" <?php if($row->id_jenis_persyaratan == '2') echo "selected";?>>Persyaratan Teknis</option>
									</select>
								</div>
							</div>
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Unsur </label>
									<div class="col-md-9">
										<input type="hidden" class="form-control" value="<?php echo $row->id_persyaratan;?>" name="id_persyaratan" placeholder="id" autocomplete="off">
										<input type="text" class="form-control" value="<?php echo $row->nama_persyaratan;?>" name="nama_persyaratan" placeholder="Nama Persyaratan" autocomplete="off">
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
	        nama_persyaratan: "required",
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
	        nama_persyaratan: "Masukan Nama Provinsi",
	        username: "Masukan Username",	        
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
}); 
</script>