<div class="portlet light bordered margin-top-20">
	<div class="portlet-title margin-top-10">
		<div class="page-title" align="center">
			<span class="caption font-blue-hoki bold" style="font-size: 22px;"> Data Penyedia Jasa</span>
		</div>
	</div>
	<div class="portlet-body form">
		<center>
			<?php
			echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : '';
			?>
		</center>
		<form action="<?php echo site_url('Konsultasi/saveDataPenyedia'); ?>" class="form-horizontal" role="form" method="post" id="FormPenyedia">
			<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Nama Penyedia Jasa</label>
					<div class="col-md-7">
						<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($id) ? $id : '')) ?>" name="id" placeholder="id" autocomplete="off">			
						<input type="hidden" class="form-control" value="<?php echo set_value('id_jasa', (isset($DataJasa->id_jasa) ? $DataJasa->id_jasa : '')) ?>" name="id_jasa" placeholder="id Penyedia Jasa" autocomplete="off">
						<input type="text" class="form-control" value="<?php echo set_value('nm_penyedia_jasa', (isset($DataJasa->nm_penyedia_jasa) ? $DataJasa->nm_penyedia_jasa : '')) ?>" name="nm_penyedia_jasa" placeholder="Nama Penyedia Jasa" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">No. Indentitas</label>
					<div class="col-md-7">
						<input type="text" class="form-control" value="<?php echo set_value('no_identitas', (isset($DataJasa->no_identitas) ? $DataJasa->no_identitas : '')) ?>" name="no_identitas" placeholder="Nomor KTP/SIM/Passport/NPWP" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Alamat</label>
					<div class="col-md-7">
						<textarea type="text" class="form-control" name="almt_penyedia" placeholder="ALamat Penyedia Jasa" autocomplete="off"><?php echo set_value('alamat', (isset($DataJasa->almt_penyedia) ? $DataJasa->almt_penyedia : '')) ?></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-3 control-label">No Telp / HP</label>
					<div class="col-md-7">
						<input type="text" class="form-control" value="<?php echo set_value('no_kontak', (isset($DataJasa->no_kontak) ? $DataJasa->no_kontak : '')) ?>" name="no_kontak" placeholder="No Kontak" autocomplete="off">
					</div>
				</div>
				<div class="form-group last">
					<label class="col-md-3 control-label">Alamat Email</label>
					<div class="col-md-7">
						<input type="email" class="form-control" placeholder="Alamat Email Aktif" value="<?php echo set_value('email', (isset($DataJasa->email) ? $DataJasa->email : '')) ?>" name="email">
					</div>
				</div>
			</div>
			<div class="form-actions">
				<center>
					<button type="submit" class="btn green">Simpan</button>
				</center>
			</div>
			<?php
			if (!empty($DataJasa->id_jasa)) { ?>
				<div class="form-actions">
					<div class="row">

						<div class="form-group">
							<center>
								<div class="col-md-6">
									<span class="input-group-btn">
										<button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>Konsultasi/FormBangunan/<?php echo $this->uri->segment(3); ?>';return false;">Kembali</button>
									</span>

								</div>
								<div class="col-md-6">
									<span class="input-group-btn">
										<button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>Konsultasi/FormDataTanah/<?php echo $this->uri->segment(3); ?>';return false;">Selanjutnya</button>
									</span>
								</div>
							</center>
						</div>
					</div>
				</div>
			<?php } ?>
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

	$(function() {
		$('.select2').select2();
		$("#FormPenyedia").validate({
			rules: {
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