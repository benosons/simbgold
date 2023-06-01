
	<form class="form-horizontal" id="from_wilayah">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Wilayah</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">ID Provinsi</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="<?php echo $id_provinsi;?>" name="" placeholder="" autocomplete="off" id="id_provinsi">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Provinsi</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="<?php echo $nama_provinsi;?>" name="" placeholder="" autocomplete="off" id="nama_provinsi">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"><b>Pilih Kabupaten/ Kota</b></label>
									<div class="col-md-9">
										<select class="form-control" name="jenis_menu" id="pilih_kabkot" onchange="getkabkot(this)">
											<option value="0">Pilih...</option>
											<?php  foreach ($list_data as $key => $value) { ?>
												<option value="<?php echo $value->id_kabkot; ?>"><?php echo $value->nama_kabkota; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">ID Kabupaten/ Kota</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="" name="" placeholder="" autocomplete="off" id="id_kabkot">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Kabupaten/ Kota</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="" name="" placeholder="" autocomplete="off" id="nama_kabkot">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label"><b>Pilih Kecamatan</b></label>
									<div class="col-md-9">
										<select class="form-control" name="jenis_menu" id="pilih_kecamatan" onchange="getkec(this)">
											<option value="0">Pilih...</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">ID Kecamatan</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="" name="id" placeholder="" autocomplete="off" id="id_kecamatan">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Kecamatan</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="" name="id" placeholder="" autocomplete="off" id="nama_kecamatan">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label"><b>Pilih Kelurahan</b></label>
									<div class="col-md-9">
										<select class="form-control" name="jenis_menu" id="pilih_kelurahan" onchange="getkelurahan(this)">
											<option value="0">Pilih...</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">ID Kelurahan</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="" name="id" placeholder="" autocomplete="off" id="id_kelurahan">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Kelurahan</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="" name="id" placeholder="" autocomplete="off" id="nama_kelurahan">
									</div>
								</div>

							</div>
						</div>


					</div>
				</div>

				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn default">Batal</button>
					<button type="button" class="btn green" onclick="updatewilayah()">Update</button>
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
