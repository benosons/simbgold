									
									<div class="portlet light bordered margin-top-20" id="ubahkatasandi">
										<div class="portlet-title margin-top-10">
											<div class="page-title" align="center">
												<span class="caption font-blue-hoki bold" style="font-size: 22px;"> <?php echo $judul; ?> </span>
											</div>
										</div>
										<div class="portlet-body">
											<!-- BEGIN FORM-->
											<center><?php
												echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'<button class="close" data-close="alert">'.'</button>'.'</div>' : '';
											?></center>
											<form action="<?php echo site_url('Profile/saveDataPassword'); ?>" class="form-horizontal" role="form" method="post" id="udahkatasandi">
												<div class="form-body">

													<div id="hasilubah" >
								
													</div>
													
													<div class="form-group">
														<label class="col-md-3 control-label">Kata Sandi Sekarang</label>
														<div class="col-md-8">
															<input type="password" class="form-control" name="password" placeholder="Kata Sandi Sekarang" autocomplete="off">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Kata Sandi Baru</label>
														<div class="col-md-8"><div class="input-icon right">
															<input type="password" class="form-control" name="new_password" for="new_password" id="new_password" placeholder="Kata Sandi Baru" autocomplete="off">
														</div></div>
													</div>
													<div class="form-group last">
														<label class="col-md-3 control-label">Ulangi Sandi Baru</label>
														<div class="col-md-8">
															<div class="input-icon right">
															<input type="password" class="form-control" name="confirm_new_password" placeholder="Ulangi Kata Sandi Baru" autocomplete="off">
															</div>
														</div>	
													</div>
													
												</div>
												<div class="form-actions">
													<center>
															<button type="submit" class="btn green">Simpan</button>
															<button type="button" class="btn default">Batal</button>
													</center>	
												</div>
											</form>
											<!-- END FORM-->
										</div>
									</div>
									
									
<script>
	
$(function () {    
	 // Setup form validation on the #register-form element
	$("#udahkatasandi").validate({
		rules: {
			new_password : {
                required: true,
				minlength: 6,
				atLeastOneLetter: true,
				atLeastOneNumber: true
            },
			confirm_new_password: {
				required: true,
				minlength: 6,
				equalTo: "#new_password"
			}
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
			new_password : {
				required: "Wajib diisi",
				minlength: "Password yang digunakan minimal 6 karakter",
				atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				atLeastOneNumber: "Password harus berupa gabungan huruf dan angka",
			},
			confirm_new_password: {
				required: "Wajib diisi",
				minlength: "password yang digunakan minimal 6 karakter",
				equalTo: "Harap memasukan password yang sama dengan diatas"
			}

		},
	    submitHandler: function() {
		 	Metronic.blockUI({
						target: '#ubahkatasandi',
						animate: true
					});

			$.ajax({
				type: "POST",
				url:  base_url + "Profile/saveDataPassword",
				data: $('form.form-horizontal').serialize(),
				success: function(response) {
					
					window.setTimeout(function() {
						document.getElementById("udahkatasandi").reset();
						Metronic.unblockUI('#ubahkatasandi');
						$('#hasilubah').html(response);
						document.getElementById('hasilubah').style.display="block";
					}, 2000);
					
					
				},
			});
		 },
	});
}); 


		/**
         * Custom validator for contains at least one lower-case letter
         */
        $.validator.addMethod("atLeastOneLowercaseLetter", function(value, element) {
            return this.optional(element) || /[a-z]+/.test(value);
        }, "Must have at least one lowercase letter");

        /**
         * Custom validator for contains at least one upper-case letter.
         */
        $.validator.addMethod("atLeastOneUppercaseLetter", function(value, element) {
            return this.optional(element) || /[A-Z]+/.test(value);
        }, "Must have at least one uppercase letter");

        $.validator.addMethod("atLeastOneLetter", function(value, element) {
            return this.optional(element) || /[a-zA-Z]+/.test(value);
        }, "Must have at least one letter");

        /**
         * Custom validator for contains at least one number.
         */
        $.validator.addMethod("atLeastOneNumber", function(value, element) {
            return this.optional(element) || /[0-9]+/.test(value);
        }, "Must have at least one number");

        /**
         * Custom validator for contains at least one symbol.
         */
        $.validator.addMethod("atLeastOneSymbol", function(value, element) {
            return this.optional(element) || /[!@#$%^&*()]+/.test(value);
        }, "Must have at least one symbol"); 
</script>