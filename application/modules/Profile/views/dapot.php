<div class="row" id="dapot">

	<div class="col-md-8 col-sm-12">
		<div class="portlet light bordered margin-top-10">
			<div class="portlet-title " align="center">
				<span class="caption font-blue-hoki bold">Data Profil</span>
			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				<center>
					<?php
						echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'<button class="close" data-close="alert">'.'</button>'.'</div>' : '';
					?>
				</center>
				<form action="<?php echo site_url('Profile/saveBiodatanya'); ?>" class="form-horizontal" role="form" method="post"
					id="from_biodata">
					<div class="form-body">
						<div class="form-group">
							<label class="control-label"><b>Nama Lengkap</b></label>
							<div class="row">
								<div class="col-md-3">
									<input type="text" class="col-md-3 form-control"
										value="<?php echo set_value('glr_depan', (isset($profile_user->glr_depan) ? $profile_user->glr_depan : '')) ?>"
										name="glr_depan" placeholder="Gelar Depan" autocomplete="off">
								</div>
								<div class="col-md-6">
									<input type="hidden" class="form-control"
										value="<?php echo set_value('id', (isset($profile_user->id) ? $profile_user->id : '')) ?>" name="id"
										placeholder="id" autocomplete="off">
									<input type="text" class="form-control"
										value="<?php echo set_value('nama_personal', (isset($profile_user->nama_lengkap) ? $profile_user->nama_lengkap : '')) ?>"
										name="nama_lengkap" placeholder="Nama Lengkap" autocomplete="off">
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control"
										value="<?php echo set_value('glr_belakang', (isset($profile_user->glr_belakang) ? $profile_user->glr_belakang : '')) ?>"
										name="glr_belakang" placeholder="Gelar Belakang" autocomplete="off">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label"><b>No. Indentitas</b></label>
							<input type="text" class="form-control"
								value="<?php echo set_value('no_ktp', (isset($profile_user->no_ktp) ? $profile_user->no_ktp : '')) ?>"
								name="no_ktp" placeholder="Nomor KTP/SIM/Passport/NPWP" autocomplete="off">

						</div>
						<?php if ($this->session->userdata('loc_role_id') != 10 and $this->session->userdata('loc_role_id') != 17) { ?>
						<div class="form-group">
							<label class="control-label"><b>Jabatan</b></label>

							<input type="text" class="form-control"
								value="<?php echo set_value('jabatan_dinas', (isset($profile_user->jabatan_dinas) ? $profile_user->jabatan_dinas : '')) ?>"
								name="jabatan" placeholder="Jabatan" autocomplete="off">

						</div>
						<div class="form-group">
							<label class="control-label"><b>NIP</b></label>

							<input type="text" class="form-control"
								value="<?php echo set_value('nip', (isset($profile_user->nip) ? $profile_user->nip : '')) ?>" name="nip"
								placeholder="NIP" autocomplete="off">

						</div>
						<?php } ?>

						<div class="form-group">
							<label class="control-label"><b>Alamat</b></label>

							<textarea type="text" class="form-control" name="alamat" placeholder="Alamat"
								autocomplete="off"><?php echo set_value('alamat', (isset($profile_user->alamat) ? $profile_user->alamat : '')) ?></textarea>

						</div>
						<div class="form-group">
							<label class="control-label"><b>Provinsi</b></label>

							<select name="nama_provinsi" id="nama_provinsi" class="form-control select" data-placeholder="Select...">
								<option value="">-- Pilih Provinsi --</option>
									<?php
										if ($daftar_provinsi->num_rows() > 0) {
											foreach ($daftar_provinsi->result() as $key) {
										
												echo '<option value="' . $key->id_provinsi . '">' . $key->nama_provinsi . '</option>';
											}
										}
									?>
							</select>

						</div>


						<?php
							isset($profile_user->id_kabkota) ? $toggle = "" : $toggle = "display:none";
						?>

						<div class="form-group" id="nama_kabkota_toggle" style="<?= $toggle; ?>">
							<label class="control-label"><b>Kab/Kota</b></label>

							<select name="nama_kabkota" id="nama_kabkota" class="form-control select" data-placeholder="Select..."">
								<option value="">-- Pilih Kabupaten / Kota --</option>
										
							</select>

						</div>
						<?php
							isset($profile_user->id_kabkota) ? $toggle = "" : $toggle = "display:none";
						?>
						<div class="form-group" id="nama_kecamatan_toggle" style="<?= $toggle; ?>">
							<label class="control-label"><b>Kecamatan</b></label>

							<select name="nama_kecamatan" id="nama_kecamatan" class="form-control select"
								data-placeholder="Select...">
								<option value="">-- Pilih Kecamatan --</option>
														
							</select>

						</div>

						<!--<div class="form-group">
							<label class="control-label"><b>Kelurahan</b></label>

							<select name="nama_kelurahan" id="nama_kelurahan" class="form-control select"
								data-placeholder="Select...">
								<option value="">-- Pilih Kelurahan --</option>
														
							</select>

						</div>-->


						<div class="form-group">
							<label class="control-label"><b>No Telp / HP</b></label>

							<input type="text" class="form-control"
								value="<?php echo set_value('no_hp', (isset($profile_user->no_hp) ? $profile_user->no_hp : '')) ?>"
								name="no_hp" placeholder="No HP" autocomplete="off">

						</div>
						<div class="form-group last">
							<label class="control-label"><b>Alamat Email</b></label>
							<input type="text" class="form-control"
								value="<?php echo set_value('no_hp', (isset($profile_user->email) ? $profile_user->email : '')) ?>"
								name="email" placeholder="E-Mail" autocomplete="off">

						</div>
					</div>
					<div class="form-actions">
						<center>
							<button type="submit" class="btn green">Simpan</button>

						</center>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-12">

		<div class="portlet light bordered margin-top-10" id="ubahkatasandi">
			<div class="portlet-title">

				<span class="caption font-blue-hoki bold">Ubah Kata Sandi </span>

			</div>
			<div class="portlet-body ">
				<!-- BEGIN FORM-->
				<form action="<?php echo site_url('Profile/saveDataPassword'); ?>" class="form-horizontal" role="form"
					method="post" id="udahkatasandi">
					<div class="form-body">

						<div class="form-group">
							<label class="control-label"><b>Kata Sandi Sekarang</b></label>

							<input type="password" class="form-control" name="password" placeholder="Kata Sandi Sekarang"
								autocomplete="off">

						</div>
						<div class="form-group">
							<label class="control-label"><b>Kata Sandi Baru</b></label>
							<div class="input-icon right">
								<input type="password" class="form-control" name="new_password" for="new_password" id="new_password"
									placeholder="Kata Sandi Baru" autocomplete="off">
							</div>
						</div>
						<div class="form-group last">
							<label class="control-label"><b>Ulangi Sandi Baru</b></label>

							<div class="input-icon right">
								<input type="password" class="form-control" name="confirm_new_password"
									placeholder="Ulangi Kata Sandi Baru" autocomplete="off">
							</div>

						</div>

					</div>
					<div class="form-actions">
						<center>
							<?php if($user_id == '79974' || $user_id == '79999' || $user_id == '29' || $user_id == '50' || $user_id == '14' ||$user_id == '15' ||$user_id == '4'){ ?>

							<?php } else { ?>
								<button type="submit" class="btn green">Simpanaa</button>
							<?php } ?>
							
						</center>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>

	</div>
</div>

<div id="notifdapot" class="modal fade" tabindex="-1" aria-hidden="true" data-width="40%" data-backdrop="static"
	data-keyboard="false">
	
		<div class="col-md-12 margin-top-20" id="hasilubah">

		</div>
		<br>
		<center><button type="button" data-dismiss="modal" class="btn btn-primary btn-sm"><i class="fa fa-times"></i></button></center>
		<br>
</div>

<script>

	$(function () {
		get_data_edit();
		// Setup form validation on the #register-form element
		$("#from_biodata").validate({

			// Specify the validation rules
			rules: {
				nama_lengkap: "required",
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
				no_ktp: {
					minlength: 6,
					required: true,
					number: true
				},

			},
			highlight: function (element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			unhighlight: function (element) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			},
			errorClass: 'help-block',

			// Specify the validation error messages
			messages: {
				nama_lengkap: "Masukkan Nama Anda",
				alamat: "Masukkan Alamat Anda",
				no_ktp: {
					required: "Wajib diisi",
					minlength: "Nomor Identitas minimal 6 karakter",
					//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
					number: "ID harus berupa angka",
				},
				no_hp: {
					required: "Masukkan Nomor Telp/HP Aktif",
					minlength: "Nomor Identitas minimal 6 karakter",
					//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
					number: "ID harus berupa angka",
				},
				nama_provinsi: "Pilih Provinsi",
				nama_kabkota: "Pilih Kabupaten/Kota",
				nama_kecamatan: "Pilih Kecamatan",

				email: "Masukkan Alamat E-Mail Anda",

			},
			submitHandler: function () {
				Metronic.blockUI({
					target: '#dapot',
					animate: true
				});
				
				$.ajax({
					type: "POST",
					url: base_url + "Profile/saveBiodatanya",
					data: $('form.form-horizontal').serialize(),
					success: function (response) {

						window.setTimeout(function () {
							//document.getElementById("from_biodata").reset();
							Metronic.unblockUI('#dapot');
							$('#notifdapot').modal('show');
							$('#hasilubah').html(response);
							document.getElementById('hasilubah').style.display = "block";
						}, 2000);


					},
				});
			}
		});
	});

	$(function () {
		// Setup form validation on the #register-form element
		$("#udahkatasandi").validate({
			rules: {
				new_password: {
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

			highlight: function (element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			unhighlight: function (element) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			},
			errorClass: 'help-block',

			// Specify the validation error messages
			messages: {
				new_password: {
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
			submitHandler: function () {
				Metronic.blockUI({
					target: '#dapot',
					animate: true
				});

				$.ajax({
					type: "POST",
					url: base_url + "Profile/saveDataPassword",
					data: $('form.form-horizontal').serialize(),
					success: function (response) {

						window.setTimeout(function () {
							document.getElementById("udahkatasandi").reset();
							Metronic.unblockUI('#dapot');
							$('#notifdapot').modal('show');
							$('#hasilubah').html(response);
							document.getElementById('hasilubah').style.display = "block";
						}, 2000);


					},
				});
			},
		});
	});

	function get_data_edit() {
		jQuery.post(base_url + 'Profile/Profil_info/', function(data) {
			jQuery.each(data, function(key, value) {
				console.log(value);
				$('#nama_provinsi').val(value.id_provinsi).trigger('change');
				$('#nama_kabkota').val(value.id_kabkota).trigger('change');
				$('#nama_kecamatan').val(value.id_kecamatan).trigger('change');
				$('#nama_kelurahan').val(value.id_kelurahan).trigger('change');
			});
		}, 'json');
	}

	$('#nama_provinsi').change(function() {
		var v = $(this).val();
		var select = "<?php echo $profile_user->id_kabkota; ?>";

		jQuery.post(base_url + 'Profile/getDataKabKota/' + v, function(data) {
			$('select[name="nama_kabkota"]').empty();
			$.each(data, function(key, value) {
				if (select == value.id_kabkot) {
					$('select[name="nama_kabkota"]').append('<option value="' + value.id_kabkot + '" selected>' + value.nama_kabkota + '</option>').trigger('change');
				} else {
					$('select[name="nama_kabkota"]').append('<option value="' + value.id_kabkot + '">' + value.nama_kabkota + '</option>');
				}
			});
		}, 'json');
	});

	$('#nama_kabkota').change(function() {
		var v = $(this).val();
		var select = "<?php echo $profile_user->id_kecamatan; ?>";
		jQuery.post(base_url + 'Profile/getDataKecamatan/' + v, function(data) {
			$('select[name="nama_kecamatan"]').empty();
			$.each(data, function(key, value) {
				if (select == value.id_kecamatan) {
					$('select[name="nama_kecamatan"]').append('<option value="' + value.id_kecamatan + '" selected>' + value.nama_kecamatan + '</option>').trigger('change');
				} else {
					$('select[name="nama_kecamatan"]').append('<option value="' + value.id_kecamatan + '">' + value.nama_kecamatan + '</option>');
				}
			});
		}, 'json');
	});

	$('#nama_kecamatan').change(function() {
		var v = $(this).val();
		var select = "<?php echo $profile_user->id_kelurahan; ?>";
		jQuery.post(base_url + 'Profile/getDataKelurahan/' + v, function(data) {
			$('select[name="nama_kelurahan"]').empty();
			$.each(data, function(key, value) {
				if (select == value.id_kelurahan) {
					$('select[name="nama_kelurahan"]').append('<option value="' + value.id_kelurahan + '" selected>' + value.nama_kelurahan + '</option>').trigger('change');
				} else {
					$('select[name="nama_kelurahan"]').append('<option value="' + value.id_kelurahan + '">' + value.nama_kelurahan + '</option>');
				}
			});
		}, 'json');
	});
	/**
	 * Custom validator for contains at least one lower-case letter
	 */
	$.validator.addMethod("atLeastOneLowercaseLetter", function (value, element) {
		return this.optional(element) || /[a-z]+/.test(value);
	}, "Must have at least one lowercase letter");

	/**
	 * Custom validator for contains at least one upper-case letter.
	 */
	$.validator.addMethod("atLeastOneUppercaseLetter", function (value, element) {
		return this.optional(element) || /[A-Z]+/.test(value);
	}, "Must have at least one uppercase letter");

	$.validator.addMethod("atLeastOneLetter", function (value, element) {
		return this.optional(element) || /[a-zA-Z]+/.test(value);
	}, "Must have at least one letter");

	/**
	 * Custom validator for contains at least one number.
	 */
	$.validator.addMethod("atLeastOneNumber", function (value, element) {
		return this.optional(element) || /[0-9]+/.test(value);
	}, "Must have at least one number");

	/**
	 * Custom validator for contains at least one symbol.
	 */
	$.validator.addMethod("atLeastOneSymbol", function (value, element) {
		return this.optional(element) || /[!@#$%^&*()]+/.test(value);
	}, "Must have at least one symbol");

</script>
