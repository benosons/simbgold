<div class="portlet light bordered margin-top-20">
	<div class="portlet-title margin-top-10">
		<div class="page-title" align="center">
			<span class="caption font-blue-hoki bold" style="font-size: 22px;"> Data Pemilik</span>
		</div>
	</div>
	<div class="portlet-body form">
		<center>
			<?php
				echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'<button class="close" data-close="alert">'.'</button>'.'</div>' : '';
			?>
		</center>
		<form action="<?php echo site_url('Konsultasi/saveData'); ?>" class="form-horizontal" role="form" method="post" id="from_biodata">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Nama Lengkap</label>
					<div class="col-md-2">
						<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataPemilik->id) ? $DataPemilik->id : '')) ?>" name="id" placeholder="id" autocomplete="off">
						<input type="text" class="form-control" value="<?php echo set_value('glr_depan', (isset($DataPemilik->glr_depan) ? $DataPemilik->glr_depan : '')) ?>" name="glr_depan" placeholder="Gelar" autocomplete="off">
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" value="<?php echo set_value('nm_pemilik', (isset($DataPemilik->nm_pemilik) ? $DataPemilik->nm_pemilik : '')) ?>" name="nm_pemilik" placeholder="Nama Lengkap Pemilik" autocomplete="off">
					</div>
					<div class="col-md-2">
						<input type="text" class="form-control" value="<?php echo set_value('glr_belakang', (isset($DataPemilik->glr_belakang) ? $DataPemilik->glr_belakang : '')) ?>" name="glr_belakang" placeholder="Gelar" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Nomor Indentitas</label>
					<div class="col-md-7">
						<input type="text" class="form-control" value="<?php echo set_value('no_ktp', (isset($DataPemilik->no_ktp) ? $DataPemilik->no_ktp : '')) ?>" name="no_ktp" placeholder="Nomor KTP/SIM/Passport/NPWP" autocomplete="off">
					</div>
				</div>
				<?php if ($this->session->userdata('loc_role_id') != 10) { ?>
					<div class="form-group">
						<label class="col-md-3 control-label">Jabatan</label>
						<div class="col-md-7">
							<input type="text" class="form-control" value="<?php echo set_value('jabatan_dinas', (isset($DataPemilik->jabatan_dinas) ? $DataPemilik->jabatan_dinas : '')) ?>" name="jabatan" placeholder="Jabatan" autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">NIP</label>
						<div class="col-md-7">
							<input type="text" class="form-control" value="<?php echo set_value('nip', (isset($DataPemilik->nip) ? $DataPemilik->nip : '')) ?>" name="nip" placeholder="NIP" autocomplete="off">
						</div>
					</div>
				<?php } ?>	
				<div class="form-group">
					<label class="col-md-3 control-label">Alamat</label>
					<div class="col-md-7">
						<textarea type="text" class="form-control" name="alamat" placeholder="Alamat" autocomplete="off"><?php echo set_value('alamat', (isset($DataPemilik->alamat) ? $DataPemilik->alamat : '')) ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Provinsi</label>
					<div class="col-md-7">
						<select name="nama_provinsi" id="nama_provinsi" class="form-control select" data-placeholder="Select..." onchange="getkabkota(this.value)">
							<option value="">-- Pilih Provinsi --</option>
							<?php if ($daftar_provinsi->num_rows() > 0) {
								foreach ($daftar_provinsi->result() as $key) {
									if ($key->id_provinsi == $DataPemilik->id_provinsi) {
										$plhrole = "selected";
									} else {
										$plhrole = "";
									}
										echo '<option value="' . $key->id_provinsi . '" ' . $plhrole . '>' . $key->nama_provinsi . '</option>';
								}
							} ?>
						</select>
					</div>
				</div>
				<?php isset($DataPemilik->id_kabkota) ? $toggle = "" : $toggle = "display:none"; ?>
				<div class="form-group" id="nama_kabkota_toggle" style="<?= $toggle; ?>">
					<label class="col-md-3 control-label">Kab/Kota</label>
					<div class="col-md-7">
						<select name="nama_kabkota" id="nama_kabkota" class="form-control select" data-placeholder="Select..." onchange="getkecamatan(this.value)">
							<option value="">-- Pilih Kabupaten / Kota --</option>
							<?php if (isset($daftar_kabkota)) {
								if ($daftar_kabkota->num_rows() > 0) {
									foreach ($daftar_kabkota->result() as $key) {
										if ($key->id_kabkot == $DataPemilik->id_kabkota) {
											$plhrole = "selected";
										} else {
											$plhrole = "";
										}
										echo '<option value="' . $key->id_kabkot . '" ' . $plhrole . '>' . $key->nama_kabkota . '</option>';
									}
								}
							} ?>
						</select>
					</div>
				</div>
				<?php isset($DataPemilik->id_kabkota) ? $toggle = "" : $toggle = "display:none"; ?>
				<div class="form-group" id="nama_kecamatan_toggle" style="<?= $toggle; ?>">
					<label class="col-md-3 control-label">Kecamatan</label>
					<div class="col-md-7">
						<select name="nama_kecamatan" id="nama_kecamatan" class="form-control select" data-placeholder="Select...">
							<option value="">-- Pilih Kecamatan --</option>
							<?php if (isset($daftar_kabkota)) {
								if ($daftar_kecamatan->num_rows() > 0) {
									foreach ($daftar_kecamatan->result() as $key) {
										if ($key->id_kecamatan == $DataPemilik->id_kecamatan) {
											$plhrole = "selected";
										} else {
											$plhrole = "";
										}
										echo '<option value="' . $key->id_kecamatan . '" ' . $plhrole . '>' . $key->nama_kecamatan . '</option>';
									}
								}
							} ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">No Telp / HP</label>
					<div class="col-md-7">
						<input type="text" class="form-control" value="<?php echo set_value('no_hp', (isset($DataPemilik->no_hp) ? $DataPemilik->no_hp : '')) ?>" name="no_hp" placeholder="No HP" autocomplete="off">
					</div>
				</div>
				<div class="form-group last">
					<label class="col-md-3 control-label">Alamat Email</label>
					<div class="col-md-7">
						<input type="email" class="form-control" placeholder="Alamat Email Aktif" value="<?php echo set_value('email', (isset($DataPemilik->email) ? $DataPemilik->email : '')) ?>" name="email">								
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
	</div>
</div>						
<script>
	function getkabkota(v) {
		$("#nama_kabkota_toggle").fadeIn()
		jQuery.post(base_url + 'profile/getDataKabKota/' + v, function(data) {
			var nama_kabkota = '<option value="">-- Pilih Kabupaten / Kota --</option>';
			jQuery.each(data, function(key, value) {
				nama_kabkota += '<option value="' + value.id_kabkot + '"> ' + value.nama_kabkota + ' </option>';
			});

			jQuery('#nama_kabkota').html(nama_kabkota);
			$('#nama_kabkota').prop("disabled", false);
		}, 'json');
	}

	function getkecamatan(v) {
		$("#nama_kecamatan_toggle").fadeIn()
		jQuery.post(base_url + 'profile/getDataKecamatan/' + v, function(data) {
			var nama_kecamatan = '<option value="">-- Pilih Kecamatan --</option>';
			jQuery.each(data, function(key, value) {
				nama_kecamatan += '<option value="' + value.id_kecamatan + '"> ' + value.nama_kecamatan + ' </option>';
			});
			jQuery('#nama_kecamatan').html(nama_kecamatan);
			$('#nama_kecamatan').prop("disabled", false);
		}, 'json');
	}
	
$(function () {    
	 // Setup form validation on the #register-form element
	$("#from_biodata").validate({
		
	    // Specify the validation rules
	    rules: {
			nama_lengkap : "required",
			alamat: "required",
			
			nama_provinsi: "required",
			nama_kabkota: "required",
			
			nama_kecamatan: "required",
			
			no_hp: {
                    minlength: 6,
                    required: true,
					number: true
                }, 
			email: {
                    required: true,
                    email: true
                    }, 
			//no_ktp : "required",
			no_ktp : {
                    minlength: 6,
                    required: true,
					number: true
                }, 
			
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
			nama_lengkap: "Masukkan Nama Anda",
			alamat: "Masukkan Alamat Anda",
			no_ktp : {
				required: "Wajib diisi",
				minlength: "Nomor Identitas minimal 6 karakter",
				//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				number: "ID harus berupa angka",
			},
			no_hp : {
				required: "Masukkan Nomor Telp/HP Aktif",
				minlength: "Nomor Identitas minimal 6 karakter",
				//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				number: "ID harus berupa angka",
			},
			nama_provinsi: "Pilih Provinsi",
			nama_kabkota: "Pilih Kabupaten/Kota",
			nama_kecamatan : "Pilih Kecamatan",
			
			email : "Masukkan Alamat E-Mail Anda",
			
	    },
	    submitHandler: function(form) {
	    	form.submit();
	    }
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