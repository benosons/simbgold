
<form action="<?php echo site_url('setting/saveDataRoleUser'); ?>" class="form-horizontal" role="form" method="post" id="frm_edit">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Form Edit User</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						
						<div class="form-group">
							<label class="col-md-3 control-label">Nama Role User</label>
							<div class="col-md-9">													
								<input type="hidden" class="form-control" value="<?php echo $row->id;?>" name="id" placeholder="id" autocomplete="off">
								<input type="text" class="form-control" value="<?php echo $row->name_role;?>" name="nama_role" placeholder="Nama Role" autocomplete="off">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Group</label>
							<div class="col-md-9">
								<select class="form-control" name="group" id="group">
									<option value="1" <?php if($row->group == '1') echo "selected";?>>Admin</option>
									<option value="2" <?php if($row->group == '2') echo "selected";?>>PUPR</option>
									<option value="3" <?php if($row->group == '3') echo "selected";?>>PTSP</option>
									<option value="4" <?php if($row->group == '4') echo "selected";?>>USER</option>
								</select>
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
	$("#frm_edit").validate({
	    // Specify the validation rules
	    rules: {
	        nama_lengkap: "required",	
	        username: "required",            
	        password:{required: true,minlength:6},	        
	        member: "required",
	        role: "required",
	        status: "required",
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
	        nama_lengkap: "Masukan Nama Lengkap",
	        username: "Masukan Username",	        
	        password: {
	                required :'Password harus di isi',
	                minlength:'Password minimal 6 karakter'},
	        member: "Pilih Kelompok Pengguna",
	        role: "Pilih Akses Menu Pengguna",
	        status: "Pilih Status",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	        
	    }
	});
}); 
</script>