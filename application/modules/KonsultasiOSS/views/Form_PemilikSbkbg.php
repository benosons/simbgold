<div class="portlet light bordered margin-top-20">
	<div class="portlet-title margin-top-10">
		<div class="page-title" align="center">
			<span class="caption font-blue-hoki bold" style="font-size: 22px;"> Data Pemilik</span>
		</div>
	</div>
	<div class="portlet-body form">
		<center>
			<?php
			echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : '';
			?>
		</center>
		<form action="<?php echo site_url('Konsultasi/Save_pemilikSbkbg'); ?>" class="form-horizontal" role="form" method="post" id="from_biodata">
			<input type="hidden" id='id' name="id" value="<?php echo $id; ?>">
			<input type="hidden" id='id_bgn' name="id_bgn" value="<?php echo $id_bgn; ?>">
			<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="form-body">
				<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataPemilik->id) ? $DataPemilik->id : '')) ?>" name="id" placeholder="id" autocomplete="off">
				<div class="form-group">
					<label class="col-md-3 control-label">Status Kepemilikan</label>
					<div class="col-md-7">
						<?php $opt_status = array(
							'' => '--Pilih--',
							'1' => 'Pemerintah',
							'2' => 'Badan Usaha',
							'3' => 'Perorangan'
						);
						echo form_dropdown('jns_pemilik', $opt_status, set_value('jns_pemilik', (isset($DataPemilik->jns_pemilik) ? $DataPemilik->jns_pemilik : '')), 'class="form-control" id="jns_pemilik"'); ?>
					</div>
				</div>
				<div id="pemerintah" style="display: none;">
					<div class="form-group">
						<label class="col-md-3 control-label">Unit Organisasi</label>
						<div class="col-md-7">
							<input type="text" class="form-control" value="<?php echo set_value('unit_organisasi', (isset($DataPemilik->nm_pemilik) ? $DataPemilik->nm_pemilik : '')) ?>" name="unit_organisasi" placeholder="Organisasi" autocomplete="off">
						</div>
					</div>
				</div>
				<div id="identitas" style="display: none;">
					<div class="form-group" id="perorangan" style="display: none;">
						<label class="col-md-3 control-label">Nama Lengkap</label>
						<div class="col-md-2">
							<input type="text" class="form-control" value="<?php echo set_value('glr_depan', (isset($DataPemilik->glr_depan) ? $DataPemilik->glr_depan : $prof->row()->glr_depan)) ?>" name="glr_depan" placeholder="Gelar" autocomplete="off">
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" value="<?php echo set_value('nama_pemilik', (isset($DataPemilik->nm_pemilik) ? $DataPemilik->nm_pemilik : $prof->row()->nama_lengkap)) ?>" name="nama_pemilik" placeholder="Nama Lengkap Pemilik" autocomplete="off">
						</div>
						<div class="col-md-2">
							<input type="text" class="form-control" value="<?php echo set_value('glr_belakang', (isset($DataPemilik->glr_belakang) ? $DataPemilik->glr_belakang : $prof->row()->glr_belakang)) ?>" name="glr_belakang" placeholder="Gelar" autocomplete="off">
						</div>
					</div>
					<div class="form-group" id="jenis_pengenal">
						<label class="col-md-3 control-label">Jenis Tanda Pengenal</label>
						<div class="col-md-7">
							<?php
							$opt_status = array(
								'1' => 'KTP',
								'2' => 'KITAS',
								'3' => 'NIB',
							);
							echo form_dropdown('jenis_id', $opt_status, set_value('jenis_id', (isset($DataPemilik->jenis_id) ? $DataPemilik->jenis_id : '')), 'class="form-control" id="jenis_id"'); ?>
						</div>
					</div>
					<div class="form-group" id="ktp" style="display: none;">
						<label class="col-md-3 control-label">No. KTP</label>
						<div class="col-md-7">
							<input type="text" maxlength="16" class="allownumericwithoutdecimal form-control" value="<?php echo set_value('no_ktp', (isset($DataPemilik->no_ktp) ? $DataPemilik->no_ktp : $prof->row()->no_ktp)) ?>" name="no_ktp" placeholder="Nomor KTP" autocomplete="off">
						</div>
					</div>
				</div>

				<div class="form-group" id="kitas" style="display: none;">
					<label class="col-md-3 control-label">No. KITAS</label>
					<div class="col-md-7">
						<input type="text" class="form-control" value="<?php echo set_value('no_kitas', (isset($DataPemilik->no_kitas) ? $DataPemilik->no_kitas : '')) ?>" name="no_kitas" placeholder="Nomor KITAS" autocomplete="off">
					</div>
				</div>
				<div class="form-group" id="nib" style="display: none;">
					<label class="col-md-3 control-label">No. NIB</label>
					<div class="col-md-7">
						<input type="text" class="form-control" value="<?php echo set_value('no_kitas', (isset($DataPemilik->no_kitas) ? $DataPemilik->no_kitas : '')) ?>" name="no_kitas" placeholder="Nomor KITAS" autocomplete="off">
					</div>
				</div>
				<div class="form-group" id="badanusaha" style="display: none;">
					<label class="col-md-3 control-label">Nama Badan Usaha/Perusahaan</label>
					<div class="col-md-7">
						<input type="text" class="form-control" value="<?php echo set_value('nm_pemilik', (isset($DataPemilik->nm_pemilik) ? $DataPemilik->nm_pemilik : '')) ?>" name="nm_pemilik" placeholder="Nama Lengkap Pemilik" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Alamat</label>
					<div class="col-md-7">
						<textarea type="text" class="form-control" name="alamat" placeholder="Alamat" autocomplete="off"><?php echo set_value('alamat', (isset($DataPemilik->alamat) ? $DataPemilik->alamat : $prof->row()->alamat)) ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Provinsi</label>
					<div class="col-md-7">
						<select name="nama_provinsi" id="nama_provinsi" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Provinsi --</option>
							<?php if ($daftar_provinsi->num_rows() > 0) {
								foreach ($daftar_provinsi->result() as $key) {
									if ($key->id_provinsi == (isset($DataPemilik->id_provinsi) ? $DataPemilik->id_provinsi : $prof->row()->id_provinsi)) {
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
				<div class="form-group">
					<label class="col-md-3 control-label">Kab/Kota</label>
					<div class="col-md-7">
						<select name="nama_kabkota" id="nama_kabkota" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kabupaten / Kota --</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Kecamatan</label>
					<div class="col-md-7">
						<select name="nama_kecamatan" id="nama_kecamatan" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kecamatan --</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Kelurahan</label>
					<div class="col-md-7">
						<select name="nama_kelurahan" id="nama_kelurahan" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kelurahan --</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">No Telp / HP</label>
					<div class="col-md-7">
						<input type="text" class="form-control" value="<?php echo set_value('no_hp', (isset($DataPemilik->no_hp) ? $DataPemilik->no_hp : $prof->row()->no_hp)) ?>" name="no_hp" placeholder="No HP" autocomplete="off">
					</div>
				</div>
				<div class="form-group last">
					<label class="col-md-3 control-label">Alamat Email</label>
					<div class="col-md-7">
						<input type="email" class="form-control" placeholder="Alamat Email Aktif" value="<?php echo set_value('email', (isset($DataPemilik->email) ? $DataPemilik->email :  $prof->row()->email)) ?>" name="email">
					</div>
				</div>
			</div>
			<div class="form-actions">
				<center>
					<button class="btn red" onClick="window.location.href = '<?php echo base_url(); ?>Konsultasi/Form_sbkbg/<?php echo $id_bgn; ?>';return false;">Kembali</button>
					<button type="submit" class="btn green">Lanjut</button>
				</center>
			</div>
		</form>
	</div>
</div>
<script>
	$(function() {
		get_data_edit();
		$('.select2').select2();
		// Setup form validation on the #register-form element
		$("#from_biodata").validate({

			// Specify the validation rules
			rules: {
				jns_pemilik: "required",
				nm_pemilik: "required",
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
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			unhighlight: function(element) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			},
			errorClass: 'help-block',

			// Specify the validation error messages
			messages: {
				jns_pemilik: "Status Kepemilikan Tidak Boleh Kosong",
				nm_pemilik: "Masukkan Nama Anda",
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
			submitHandler: function(form) {
				form.submit();
			}
		});
		var jns_pemilik = $('#jns_pemilik').val();
		if (jns_pemilik) {
			jenisPemilik(jns_pemilik);
		}

		$('#jns_pemilik').change(function() {
			var v = $(this).val();
			jenisPemilik(v);
		});

		function jenisPemilik(v) {
			if (v == 1) {
				$('#badanusaha').hide();
				$('#pemerintah').show();
				$('#identitas').hide();
				$('#perorangan').hide();
				$('#nib').hide();
			}
			if (v == 2) {
				$('#perorangan').hide();
				$('#pemerintah').hide();
				$('#identitas').show();
				$('#badanusaha').show();
				$('#nib').hide();
				jenisPengenal(v);
			}
			if (v == 3) {
				//$('#perorangan').hide();
				$('#badanusaha').hide();
				$('#pemerintah').hide();
				$('#identitas').show();
				$('#perorangan').show();
				jenisPengenal(v);
			}
		}

		function jenisPengenal(v) {
			if (v == 2) {
				$("#jenis_id option[value=1]").show();
				$("div#jenis_pengenal select").val("3").change();

				$("#jenis_id option[value=1]").hide();
				$("#jenis_id option[value=2]").hide();
			} else {
				$("div#jenis_pengenal select").val("1").change();
				$('#ktp').show();
				$("#jenis_id option[value=1]").show();
				$("#jenis_id option[value=2]").show();
				$("#jenis_id option[value=3]").hide();
			}
		}

		var jenis_id = $('#jenis_id').val();
		if (jenis_id == '' || jenis_id == 1) {
			$('#ktp').show();
		} else if (jenis_id == 2) {
			$('#kitas').show();
		} else if (jenis_id == 3) {
			$('#nib').show();
		}

		$('#jenis_id').change(function() {
			var v = $(this).val();
			if (v == 1) {
				$('#ktp').show();
				$('#kitas').hide();
				$('#nib').hide();
			}
			if (v == 2) {
				$('#ktp').hide();
				$('#kitas').show();
				$('#nib').hide();
			}
			if (v == 3) {
				$('#ktp').hide();
				$('#kitas').hide();
				$('#nib').show();
			}
		});
	});

	function get_data_edit() {
		$('#nama_provinsi').val('<?= isset($DataPemilik->id_provinsi) ? $DataPemilik->id_provinsi : $prof->row()->id_provinsi; ?>').trigger('change');
		$('#nama_kabkota').val('<?= isset($DataPemilik->id_kabkota) ? $DataPemilik->id_kabkota : $prof->row()->id_kabkota; ?>').trigger('change');
		$('#nama_kecamatan').val('<?= isset($DataPemilik->id_kecamatan) ? $DataPemilik->id_kecamatan : $prof->row()->id_kecamatan; ?>').trigger('change');
		$('#nama_kelurahan').val('<?= isset($DataPemilik->id_kelurahan) ? $DataPemilik->id_kelurahan : $prof->row()->id_kelurahan; ?>').trigger('change');
	}

	$('#nama_provinsi').change(function() {
		var v = $(this).val();
		var select = "<?= isset($DataPemilik->id_kabkota) ? $DataPemilik->id_kabkota : $prof->row()->id_kabkota; ?>";
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Konsultasi/getDataKabKota/' + v,
			data: $('form.form-horizontal').serialize(),
			success: function(response) {
				let data = JSON.parse(response);
				let csrf_token = data.csrf;
				$('#csrf_id').val(csrf_token);
				$('select[name="nama_kabkota"]').empty();
				$('select[name="nama_kabkota"]').append('<option value=""> -- Pilih -- </option>');
				$.each(data, function(key, value) {
					if (select == value.id_kabkot) {
						$('select[name="nama_kabkota"]').append('<option value="' + value.id_kabkot + '" selected>' + value.nama_kabkota + '</option>').trigger('change');
					} else {
						$('select[name="nama_kabkota"]').append('<option value="' + value.id_kabkot + '">' + value.nama_kabkota + '</option>');
					}
				});

			},
			error: function(error) {
				console.log(' Tidak Ditemukan');
			}
		});
	});


	$('#nama_kabkota').change(function() {
		var v = $(this).val();
		var select = "<?= isset($DataPemilik->id_kecamatan) ? $DataPemilik->id_kecamatan : $prof->row()->id_kecamatan; ?>";
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Konsultasi/getDataKecamatan/' + v,
			data: $('form.form-horizontal').serialize(),
			success: function(response) {
				let data = JSON.parse(response);
				let csrf_token = data.csrf;
				$('#csrf_id').val(csrf_token);
				$('select[name="nama_kecamatan"]').empty();
				$('select[name="nama_kecamatan"]').append('<option value=""> -- Pilih -- </option>');;
				$.each(data, function(key, value) {
					if (select == value.id_kecamatan) {
						$('select[name="nama_kecamatan"]').append('<option value="' + value.id_kecamatan + '" selected>' + value.nama_kecamatan + '</option>').trigger('change');
					} else {
						$('select[name="nama_kecamatan"]').append('<option value="' + value.id_kecamatan + '">' + value.nama_kecamatan + '</option>');
					}
				});
			},
			error: function(error) {
				console.log(' Tidak Ditemukan');
			}
		});
	});

	$('#nama_kecamatan').change(function() {
		var v = $(this).val();
		var select = "<?= isset($DataPemilik->id_kelurahan) ? $DataPemilik->id_kelurahan : $prof->row()->id_kelurahan; ?>";
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Konsultasi/getDataKelurahan/' + v,
			data: $('form.form-horizontal').serialize(),
			success: function(response) {
				let data = JSON.parse(response);
				let csrf_token = data.csrf;
				$('#csrf_id').val(csrf_token);
				$('select[name="nama_kelurahan"]').empty();
				$('select[name="nama_kelurahan"]').append('<option value=""> -- Pilih -- </option>');;
				$.each(data, function(key, value) {
					if (select == value.id_kelurahan) {
						$('select[name="nama_kelurahan"]').append('<option value="' + value.id_kelurahan + '" selected>' + value.nama_kelurahan + '</option>').trigger('change');
					} else {
						$('select[name="nama_kelurahan"]').append('<option value="' + value.id_kelurahan + '">' + value.nama_kelurahan + '</option>');
					}
				});
			},
			error: function(error) {
				console.log(' Tidak Ditemukan');
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

	$(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
</script>