<div class="portlet light margin-top-20">
	<div class="portlet-body">
		<div>
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' .
				$this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : '';
			?>
		</div>
		<div id="id_asosiasi" style="display: block;">
			<br>
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Data Asosiasi
					</div>
				</div>
				<div class="portlet-body">
					<form action="<?php echo site_url('InputTPA/savedataasosiasi'); ?>" class="form-horizontal" role="form" method="post" id="Formasosiasi">
						<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($id) ? $id : '')) ?>" name="id" placeholder="Nama Lengkap" autocomplete="off">
						<input type="hidden" class="form-control" value="<?php echo set_value('id_aso', (isset($Dataaso->id_aso) ? $Dataaso->id_aso : '')) ?>" name="id_aso" placeholder="Nama Lengkap" autocomplete="off">
						<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

						<div class="form-group">
							<label class="col-md-3 control-label">Nama Instansi</label>
							<div class="col-md-4">
								<input type="text" class="form-control" value="<?php echo set_value('nm_asosiasi', (isset($nm_asosiasi) ? $nm_asosiasi : '')) ?>" name="nm_tpa" placeholder="Nama Lengkap" autocomplete="off" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Provinsi</label>
							<div class="col-md-5">
								<select name="nama_provinsi" id="nama_provinsi" class="form-control select2" data-placeholder="Select..." onchange="getkabkota(this.value)">
									<option value="">-- Pilih Provinsi --</option>
									<?php if ($daftar_provinsi->num_rows() > 0) {
										foreach ($daftar_provinsi->result() as $key) {
											if ($key->id_provinsi == $Dataaso->id_provinsi) {
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
						<?php isset($Dataaso->id_kabkota) ? $toggle = "" : $toggle = "display:block"; ?>
						<div class="form-group" id="nama_kabkota_toggle" style="<?= $toggle; ?>">
							<label class="col-md-3 control-label">Kab/Kota</label>
							<div class="col-md-7">
								<select name="nama_kabkota" id="nama_kabkota" class="form-control select2" data-placeholder="Select..." onchange="getkecamatan(this.value)">
									<option value="">-- Pilih Kabupaten / Kota --</option>
									<?php if (isset($daftar_kabkota)) {
										if ($daftar_kabkota->num_rows() > 0) {
											foreach ($daftar_kabkota->result() as $key) {
												if ($key->id_kabkot == $Dataaso->id_kabkot) {
													$plhrole = "selected";
												} else {
													$plhrole = "";
												}
												echo '<option value="' . $key->id_kabkot . '" ' . $plhrole . '>' . ucwords(strtolower($key->nama_kabkota)) . '</option>';
											}
										}
									} ?>
								</select>
							</div>
						</div>
						<?php isset($profile_user->id_kabkota) ? $toggle = "" : $toggle = "display:block"; ?>
						<div class="form-group" id="nama_kecamatan_toggle" style="<?= $toggle; ?>">
							<label class="col-md-3 control-label">Kecamatan</label>
							<div class="col-md-7">
								<select name="nama_kecamatan" id="nama_kecamatan" class="form-control select2" data-placeholder="Select...">
									<option value="">-- Pilih Kecamatan --</option>
									<?php if (isset($daftar_kabkota)) {
										if ($daftar_kecamatan->num_rows() > 0) {
											foreach ($daftar_kecamatan->result() as $key) {
												if ($key->id_kecamatan == $Dataaso->id_kecamatan) {
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
							<label class="col-md-3 control-label">Alamat</label>
							<div class="col-md-7">
								<textarea type="text" class="form-control" name="alamat" placeholder="Alamat" autocomplete="off"><?php echo set_value('alamat', (isset($Dataaso->alamat) ? $Dataaso->alamat : '')) ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Telp/Fax</label>
							<div class="col-md-9">
								<input type="text" class="form-control" value="<?php echo set_value('no_tlpn_fax', (isset($Dataaso->no_tlpn_fax) ? $Dataaso->no_tlpn_fax : '')) ?>" name="no_tlpn_fax" placeholder="No. Kontak" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Email</label>
							<div class="col-md-7">
								<input type="text" class="form-control" value="<?php echo set_value('email', (isset($Dataaso->email) ? $Dataaso->email : '')) ?>" name="email" placeholder="E-Mail" autocomplete="off">
							</div>
						</div>
						<div class="modal-footer">
							<center>
								<button type="submit" class="btn green">Simpan</button>
							</center>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function getkabkota(v, id_kabkot) {
		$("#nama_kabkota_toggle").fadeIn()
		jQuery.post(base_url + 'InputTPA/getDataKabKota/' + v, function(data) {

			var nama_kabkota = '<option value="">-- Pilih Kabupaten / Kota --</option>';
			jQuery.each(data, function(key, value) {
				nama_kabkota += '<option value="' + value.id_kabkot + '"> ' + value.nama_kabkota + ' </option>';
			});
			jQuery('#nama_kabkota').html(nama_kabkota);
			$('#nama_kabkota').prop("disabled", false);
		}, 'json');
	}

	function getkecamatan(v, id_kecamatan) {
		$("#nama_kecamatan_toggle").fadeIn()
		jQuery.post(base_url + 'InputTPA/getDataKecamatan/' + v, function(data) {
			var nama_kecamatan = '<option value="">-- Pilih Kecamatan --</option>';
			jQuery.each(data, function(key, value) {

				nama_kecamatan += '<option value="' + value.id_kecamatan + '" > ' + value.nama_kecamatan + ' </option>';
			});
			jQuery('#nama_kecamatan').html(nama_kecamatan);
			$('#nama_kecamatan').prop("disabled", false);
		}, 'json');
	}


	$(function() {
		$('.select2').select2();
		$("#Formasosiasi").validate({
			// Specify the validation rules
			rules: {
				alamat: "required",
				nama_provinsi: "required",
				nama_kabkota: "required",
				nama_kecamatan: "required",
				no_tlpn_fax: {
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
					minlength: 16,
					maxlength: 16,
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
				alamat: "Masukan Alamat Lengkap",
				no_ktp: {
					required: "Masukan Nomor Identitas",
					minlength: "No. Identitas Minimal 16 karakter",
					maxlength: "No. Identitas Maksimal 16 karakter",
					number: "ID harus berupa angka",
				},
				no_tlpn_fax: {
					required: "Masukan Nomor Telp/Fax Aktif",
					minlength: "Nomor Telp/Fax minimal 6 karakter",
					number: "Nomor Telp/HP harus berupa angka",
				},
				nama_provinsi: "Pilih Provinsi",
				nama_kabkota: "Pilih Kabupaten/Kota",
				nama_kecamatan: "Pilih Kecamatan",
				email: "Masukan Alamat E-Mail Anda",
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	});
</script>