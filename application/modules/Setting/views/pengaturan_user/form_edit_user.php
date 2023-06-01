
<form action="<?php echo site_url('Setting/savePengaturanUser'); ?>" class="form-horizontal" role="form" method="post" id="frm_edit">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Tambah User</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">										
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Username</label>
									<div class="col-md-9">
										<input type="hidden" class="form-control" value="<?php echo $row->id;?>" name="id" placeholder="id" autocomplete="off">
										<input type="text" class="form-control" name="username" value="<?php echo $row->username;?>" placeholder="Username" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Password</label>
									<div class="col-md-9">													
										<input type="password" class="form-control" id="password" value="" name="password" placeholder="password" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Ulangi Password</label>
									<div class="col-md-9">													
										<input type="password" class="form-control" name="ulangi_password" placeholder="Ulangi password" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Kab/Kota</label>
									<div class="col-md-9">													
										<select name="nama_kabkota" id="nama_kabkota" class="form-control select2me" data-placeholder="Select...">
										<?php 
											if($daftar_kabkota->num_rows() > 0){
												foreach ($daftar_kabkota->result() as $key) {
													if($key->id_kabkot == $row->id_kabkot){
														$plhrole = "selected";
													}else{
														$plhrole = "";
													}
													echo '<option value="'.$key->id_kabkot.'" '.$plhrole.'>'.$key->nama_kabkota.'</option>';
												}
											}
										?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Role</label>
									<div class="col-md-9">													
										<!--<select name="nama_role" id="nama_role" class="form-control">!-->
										<select name="nama_role" id="nama_role" class="form-control select2me" data-placeholder="Select...">
										<?php 
											if($daftar_role->num_rows() > 0){
												foreach ($daftar_role->result() as $key2) {
													if($key2->id == $row->role_id){
														$plhrole = "selected";
													}else{
														$plhrole = "";
													}
													echo '<option value="'.$key2->id.'" '.$plhrole.'>'.$key2->name_role.'</option>';
												}
											}
										?>
										
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Status</label>
									<div class="col-md-9">
										<select class="form-control" name="status" id="status">
											<option value="1" <?php if($row->status == '1') echo "selected";?>>Aktif</option>
											<option value="2" <?php if($row->status == '0') echo "selected";?>>Tidak Aktif</option>
										</select>
									</div>
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