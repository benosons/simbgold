<?php
isset($tpa) ? $DataTpa = $tpa->row() : '';
?>
<div class="portlet light margin-top-20">
	<div class="portlet-body">
		<div>
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' .
				$this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : '';
			?>
		</div>
		<div id="pluspersonil" style="display: block;">
			<br>
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Data Diri
					</div>
				</div>
				<div class="portlet-body">
					<form action="<?php echo site_url('TenagaAhli/Savedatadiri'); ?>" class="form-horizontal" role="form" method="post" id="form_plusonil" enctype="multipart/form-data">
						<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

						<div class="form-group">
							<label class="col-md-3 control-label">Nama Lengkap</label>
							<div class="col-md-9">
								<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($Dataaka->id) ? $Dataaka->id : '')) ?>" name="id" placeholder="ID" autocomplete="off">
								<input type="hidden" class="form-control" value="<?php echo set_value('id_lembaga', (isset($Dataaka->id_lembaga) ? $Dataaka->id_lembaga : '')) ?>" name="id_lembaga" placeholder="Gelar Depan" autocomplete="off">
								<div class="col-md-2">
									<input type="text" class="form-control" value="<?php echo set_value('glr_depan', (isset($Dataaka->glr_depan) ? $Dataaka->glr_depan : '')) ?>" name="glr_depan" placeholder="Gelar Depan" autocomplete="off">
								</div>
								<div class="col-md-4">
									<input type="text" class="form-control" value="<?php echo set_value('nama_personal', (isset($Dataaka->nm_tpa) ? $Dataaka->nm_tpa : '')) ?>" name="nm_tpa" placeholder="Nama Lengkap" autocomplete="off">
								</div>
								<div class="col-md-2">
									<input type="text" class="form-control" value="<?php echo set_value('glr_blkg', (isset($Dataaka->glr_blkg) ? $Dataaka->glr_blkg : '')) ?>" name="glr_blkg" placeholder="Gelar" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">NIK</label>
							<div class="col-md-3">
								<input type="text" maxlength="16" class="allownumericwithoutdecimal form-control" value="<?php echo set_value('no_ktp', (isset($Dataaka->no_ktp) ? $Dataaka->no_ktp : '')) ?>" name="no_ktp" placeholder="No. Identitas" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">NIP</label>
							<div class="col-md-3">
								<input type="text" class="form-control" value="<?php echo set_value('nip', (isset($Dataaka->nip) ? $Dataaka->nip : '')) ?>" name="nip" placeholder="No. Identitas Pegawai" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Pangkat</label>
							<div class="col-md-5">
								<input type="text" class="form-control" value="<?php echo set_value('pangkat', (isset($Dataaka->pangkat) ? $Dataaka->pangkat : '')) ?>" name="pangkat" placeholder="Pangkat" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Golongan</label>
							<div class="col-md-3">
								<input type="text" class="form-control" value="<?php echo set_value('golongan', (isset($Dataaka->golongan) ? $Dataaka->golongan : '')) ?>" name="golongan" placeholder="Golongan" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Jabatan Fungsional</label>
							<div class="col-md-5">
								<input type="text" class="form-control" value="<?php echo set_value('jabatan', (isset($Dataaka->jabatan) ? $Dataaka->jabatan : '')) ?>" name="jabatan" placeholder="Jabatan Fungsional" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Jenis Kelamin</label>
							<div class="col-md-3">
								<select class="form-control select" name="jns_kelamin">
									<option value="">--Pilih--</option>
									<option value="1" <?php if ($Dataaka->jns_kelamin == '1') echo "selected"; ?>>Pria</option>
									<option value="2" <?php if ($Dataaka->jns_kelamin == '2') echo "selected"; ?>>Wanita</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Tempat Lahir</label>
							<div class="col-md-5">
								<input type="text" class="form-control" value="<?php echo set_value('tmpt_lahir', (isset($Dataaka->tmpt_lahir) ? $Dataaka->tmpt_lahir : '')) ?>" name="tmpt_lahir" placeholder="Tempat Lahir" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Tanggal Lahir</label>
							<div class="col-md-2">
								<input class="form-control" name="tgl_lahir" value="<?php echo set_value('tgl_lahir', (isset($Dataaka->tgl_lahir) ? $Dataaka->tgl_lahir : '')) ?>" type="date" data-date-format="yyyy-mm-dd" placeholder="Tanggal Konsultasi">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">NPWP</label>
							<div class="col-md-5">
								<input type="text" maxlength="20" class="form-control" value="<?php echo set_value('npwp', (isset($Dataaka->npwp) ? $Dataaka->npwp : '')) ?>" name="npwp" id="npwp" placeholder="NPWP" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Provinsi</label>
							<div class="col-md-5">
								<select name="nama_provinsi" id="nama_provinsi" class="form-control select2" data-placeholder="Select..." onchange="getkabkota(this.value)">
									<option value="">-- Pilih Provinsi --</option>
									<?php if ($daftar_provinsi->num_rows() > 0) {
										foreach ($daftar_provinsi->result() as $key) {
											if ($key->id_provinsi == $Dataaka->id_provinsi) {
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
						<?php isset($Dataaka->id_kabkot) ? $toggle = "" : $toggle = "display:block"; ?>
						<div class="form-group" id="nama_kabkota_toggle" style="<?= $toggle; ?>">
							<label class="col-md-3 control-label">Kab/Kota</label>
							<div class="col-md-7">
								<select name="nama_kabkota" id="nama_kabkota" class="form-control select2" data-placeholder="Select..." onchange="getkecamatan(this.value)">
									<option value="">-- Pilih Kabupaten / Kota --</option>
									<?php if (isset($daftar_kabkota)) {
										if ($daftar_kabkota->num_rows() > 0) {
											foreach ($daftar_kabkota->result() as $key) {
												if ($key->id_kabkot == $Dataaka->id_kabkot) {
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
						<div class="form-group" id="nama_kecamatan_toggle" style="<?= $toggle; ?>">
							<label class="col-md-3 control-label">Kecamatan</label>
							<div class="col-md-7">
								<select name="nama_kecamatan" id="nama_kecamatan" class="form-control select2" data-placeholder="Select...">
									<option value="">-- Pilih Kecamatan --</option>
									<?php if (isset($daftar_kabkota)) {
										if ($daftar_kecamatan->num_rows() > 0) {
											foreach ($daftar_kecamatan->result() as $key) {
												if ($key->id_kecamatan == $Dataaka->id_kecamatan) {
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
								<textarea type="text" class="form-control" name="alamat" placeholder="Alamat" autocomplete="off"><?php echo set_value('alamat', (isset($Dataaka->alamat) ? $Dataaka->alamat : '')) ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Email</label>
							<div class="col-md-7">
								<input type="text" class="form-control" value="<?php echo set_value('email', (isset($Dataaka->email) ? $Dataaka->email : '')) ?>" name="email" placeholder="E-Mail" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">No. Telephone</label>
							<div class="col-md-5">
								<input type="text" class="allownumericwithoutdecimal form-control" value="<?php echo set_value('no_kontak', (isset($Dataaka->no_kontak) ? $Dataaka->no_kontak : '')) ?>" name="no_kontak" placeholder="No. Kontak" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Photo</label>
							<div class="col-md-8">
								<div class="fileinput fileinput-new" data-provides="fileinput">

									<?php if (!empty($Dataaka->dir_photo)) {
										$filename = FCPATH . "/object-storage/dekill/Tpa/$Dataaka->dir_photo";
										$file = '';
										if (file_exists($filename)) {
											$file = base_url('object-storage/dekill/Tpa/' . $Dataaka->dir_photo);
										} else {
											$file = base_url() . 'object-storage/file/Tpa/' . $Dataaka->id . '/' . $Dataaka->dir_photo;
										}
										$name = 'Ubah Fle';
										echo '<div class="fileinput-new thumbnail">';
										echo '<a href="' . $file . '" target="_blank" alt="" class="btn default blue-stripe">Lihat</a>';
										echo '</div>'; ?>

										<input type="hidden" name="dir_dokumen" value="<?= $Dataaka->dir_photo; ?>" id="dir_dokumen">
									<?php } ?>
									<input type="file" name="dir_file" id="dir_file">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Prefersi Wilayah Kerja</label>
							<div class="col-md-3">
								<select class="form-control select" name="id_kerja">
									<option value="">--Pilih--</option>
									<option value="1" <?php if ($Dataaka->id_kerja == '1') echo "selected"; ?>>1 Kabupaten/Kota</option>
									<option value="2" <?php if ($Dataaka->id_kerja == '2') echo "selected"; ?>>2 Kabupaten/Kota</option>
									<option value="3" <?php if ($Dataaka->id_kerja == '3') echo "selected"; ?>>3 Kabupaten/Kota</option>
									<option value="4" <?php if ($Dataaka->id_kerja == '4') echo "selected"; ?>>Bersedia dimana Saja</option>
								</select>
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
	var csrf_id = $("#csrf_id").val();
	var csrf_name = $("#csrf_id").attr('name');

	$(document).ready(function() {
		$('.select2').select2();

		if (typeof $('#npwp').val() === 'string') {
			return $('#npwp').val($('#npwp').val().replace(/(\d{2})(\d{3})(\d{3})(\d{1})(\d{3})(\d{3})/, '$1.$2.$3.$4-$5.$6'));
		}
	});

	$("#npwp").on("keypress keyup blur", function(event) {

		if (typeof $(this).val() === 'string') {
			return $(this).val($(this).val().replace(/(\d{2})(\d{3})(\d{3})(\d{1})(\d{3})(\d{3})/, '$1.$2.$3.$4-$5.$6'));
		}

	});
	$(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});

	function getkabkota(v, id_kabkot) {
		$("#nama_kabkota_toggle").fadeIn()
		jQuery.post(base_url + 'TenagaAhli/getDataKabKota/' + v, {
			data: {
				[csrf_name]: csrf_id
			}
		}, function(data) {

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
		jQuery.post(base_url + 'TenagaAhli/getDataKecamatan/' + v, {
			data: {
				[csrf_name]: csrf_id
			}
		}, function(data) {
			var nama_kecamatan = '<option value="">-- Pilih Kecamatan --</option>';
			jQuery.each(data, function(key, value) {

				nama_kecamatan += '<option value="' + value.id_kecamatan + '" > ' + value.nama_kecamatan + ' </option>';
			});
			jQuery('#nama_kecamatan').html(nama_kecamatan);
			$('#nama_kecamatan').prop("disabled", false);
		}, 'json');
	}

	function getPlus() {
		document.getElementById('pluspersonil').style.display = "block";
		document.getElementById('btnplus').style.display = "block";
		document.getElementById('btnplus2').style.display = "none";
	}

	function getPlus2() {
		document.getElementById('pluspersonil').style.display = "none";
		document.getElementById('btnplus').style.display = "none";
		document.getElementById('btnplus2').style.display = "block";
	}


	// Setup form validation on the #register-form element
	$("#form_plusonil").validate({

		// Specify the validation rules
		rules: {
			nama_personal: "required",
			stat: "required",
			alamat: "required",
			id_provinsi: "required",
			id_kabkot: "required",

			id_kecamatan: "required",

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
			nama_personal: "Masukan Nama Petugas",
			alamat: "Masukan Alamat Lengkap",
			stat: "Pilih Salah Satu",
			no_ktp: {
				required: "Masukan Nomor Identitas",
				minlength: "Nomor Identitas minimal 6 karakter",
				//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				number: "ID harus berupa angka",
			},
			no_hp: {
				required: "Masukan Nomor Telp/HP Aktif",
				minlength: "Nomor Telp/HP minimal 6 karakter",
				//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				number: "Nomor Telp/HP harus berupa angka",
			},
			id_provinsi: "Pilih Provinsi",
			id_kabkot: "Pilih Kabupaten/Kota",
			id_kecamatan: "Pilih Kecamatan",

			email: "Masukan Alamat E-Mail Anda",
		},
		submitHandler: function(form) {
			form.submit();
		}
	});
</script>