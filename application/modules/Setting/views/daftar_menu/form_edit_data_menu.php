
	<form action="<?php echo site_url('Setting/saveDataMenu'); ?>" class="form-horizontal" role="form" method="post" id="from_user">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Tambah Menu</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-body">

								<div class="form-group">
									<label class="col-md-3 control-label">Jenis Menu</label>
									<div class="col-md-9">
										<select class="form-control" name="jenis_menu" id="jenis_menu" onchange="getjenismenu(this.value)">
											<option value="1" <?php if($row->parentid == '0') echo "selected";?>>Menu Utama</option>
											<option value="2" <?php if($row->parentid  > 0 ) echo "selected";?>>Sub Menu</option>
										</select>
									</div>
								</div>

								<?php if($row->parentid  > 0 ){ ?>
									<div class="form-group">
										<label class="col-md-3 control-label">Menu Utama</label>
										<div class="col-md-9">
											<div>
												<select name="menu_utama" id="menu_utama" class="form-control">
													<?php
														if($menu_utama_list->num_rows() > 0){
															foreach ($menu_utama_list->result() as $key) {
																if($key->id == $row->parentid){
																	$plhrole = "selected";
																}else{
																	$plhrole = "";
																}
																echo '<option value="'.$key->id.'" '.$plhrole.'>'.$key->name_menu.'</option>';
															}
														}
													?>
												</select>
											</div>
										</div>
									</div>
								<?php } ?>

								<div class="form-group">
									<label class="col-md-3 control-label">Nama Menu</label>
									<div class="col-md-9">
										<input type="hidden" class="form-control" value="<?php echo $row->id;?>" name="id" placeholder="id" autocomplete="off">
										<input type="text" class="form-control" value="<?php echo $row->name_menu;?>" name="nama_menu" placeholder="Nama Menu" autocomplete="off">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">URL</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="<?php echo $row->url;?>" name="url_link" placeholder="Link URL" autocomplete="off">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Icon bootstrap</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="<?php echo $row->icon;?>" name="icon_bootstrap" placeholder="Icon Bootstrap" autocomplete="off">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">status</label>
									<div class="col-md-9">
										<select class="form-control" name="status" id="status">
											<option value="1" <?php if($row->menu_aktif == '1') echo "selected";?>>Aktif</option>
											<option value="2" <?php if($row->menu_aktif == '0') echo "selected";?>>Non Aktif</option>
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
