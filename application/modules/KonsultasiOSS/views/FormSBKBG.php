<div class="portlet light bordered margin-top-20">
	<div class="portlet-title margin-top-10">
		<div class="page-title" align="center">
			<span class="caption font-blue-hoki bold" style="font-size: 22px;"> Data Permohonan SBKBG</span>
		</div>
	</div>
	<div class="portlet-body form">
		<center>
			<?php
			echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : '';
			?>
		</center>
		<form action="<?php echo site_url('Konsultasi/saveData'); ?>" class="form-horizontal" role="form" method="post" id="from_biodata">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Nomor IMB</label>
					<div class="col-md-4">
						<input type="text" class="form-control" value="<?php echo set_value('nomor_registrasi', (isset($data['nomor_registrasi']) ? $data['nomor_registrasi'] : '')) ?>" name="nomor_registrasi" placeholder="Nomor IMB" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Nomor SLF</label>
					<div class="col-md-4">
						<input type="text" class="form-control" value="<?php echo set_value('no_registrasi_slf', (isset($data['no_registrasi_slf']) ? $data['no_registrasi_slf'] : '')) ?>" name="no_registrasi_slf" placeholder="Nomor SLF" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Nama Pemilik</label>
					<div class="col-md-7">
						<input type="text" class="form-control" value="<?php echo set_value('nama_pemilik', (isset($data['nama_pemilik']) ? $data['nama_pemilik'] : $data['nama_pemohon'])) ?>" name="nama_pemilik" placeholder="Nama Pemilik" autocomplete="off">
					</div>
				</div>
				<div class="portlet-title">
					<div class="page-title" align="center">
						<span class="caption font-blue-hoki bold" style="font-size: 16px;">Alamat Pemilik</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Provinsi</label>
					<div class="col-md-7">
						<?php
						$opt_provinsi = ['' => '-- Pilih --'];
						foreach ($daftar_provinsi->result() as $key) {
							$opt_provinsi[$key->id_provinsi] = $key->nama_provinsi;
						}
						?>
						<?php echo form_dropdown('id_provinsi', $opt_provinsi, '', 'class ="form-control select2"  id="id_provinsi"'); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Kab/Kota</label>
					<div class="col-md-7">
						<select name="id_kabkota" id="id_kabkota" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kabupaten / Kota --</option>

						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Kecamatan</label>
					<div class="col-md-7">
						<select name="id_kecamatan" id="id_kecamatan" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kecamatan --</option>

						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Kelurahan</label>
					<div class="col-md-7">
						<select name="id_kelurahan" id="id_kelurahan" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kelurahan --</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Alamat</label>
					<div class="col-md-7">
						<textarea type="text" class="form-control" name="alamat_pemilik" placeholder="Alamat Bangunan" autocomplete="off"><?php echo set_value('alamat_pemilik', (isset($data['alamat_pemilik']) ? $data['alamat_pemilik'] : $data['alamat_pemohon'])) ?></textarea>
					</div>
				</div>
				<div class="portlet-title">
					<div class="page-title" align="center">
						<span class="caption font-blue-hoki bold" style="font-size: 16px;">Alamat Banagunan Gedung</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Provinsi</label>
					<div class="col-md-7">
						<?php
						$opt_provinsi = ['' => '-- Pilih --'];
						foreach ($daftar_provinsi->result() as $key) {
							$opt_provinsi[$key->id_provinsi] = $key->nama_provinsi;
						}
						?>
						<?php echo form_dropdown('id_provinsi_bg', $opt_provinsi, '', 'class ="form-control select2"  id="id_provinsi_bg"'); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Kab/Kota</label>
					<div class="col-md-7">
						<select name="id_kabkota_bg" id="id_kabkota_bg" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kabupaten / Kota --</option>

						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Kecamatan</label>
					<div class="col-md-7">
						<select name="id_kecamatan_bg" id="id_kecamatan_bg" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kecamatan --</option>

						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Kelurahan</label>
					<div class="col-md-7">
						<select name="id_kelurahan_bg" id="id_kelurahan_bg" class="form-control select2" data-placeholder="Select...">
							<option value="">-- Pilih Kelurahan --</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Alamat</label>
					<div class="col-md-7">
						<textarea type="text" class="form-control" name="alamat_bg" placeholder="Alamat Bangunan" autocomplete="off"><?php echo set_value('alamat_bg', (isset($data['alamat_bg']) ? $data['alamat_bg'] : '')) ?></textarea>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	$(function() {
		get_data_edit()
		$('.select2').select2();
	});

	function get_data_edit() {
		$('#id_provinsi').val('<?= isset($data['id_provinsi']) ? $data['id_provinsi'] : ""; ?>').trigger('change');
		$('#id_kabkota').val('<?= isset($data['id_kabkot']) ? $data['id_kabkot'] : ""; ?>').trigger('change');
		$('#id_kecamatan').val('<?= isset($data['id_kecamatan']) ? $data['id_kecamatan'] : ""; ?>').trigger('change');
		$('#id_provinsi_bg').val('<?= isset($data['id_provinsi_bg']) ? $data['id_provinsi_bg'] : ""; ?>').trigger('change');
		$('#id_kabkota_bg').val('<?= isset($data['id_kabkot_bg']) ? $data['id_kabkot_bg'] : ""; ?>').trigger('change');
		$('#id_kecamatan_bg').val('<?= isset($data['id_kecamatan_bg']) ? $data['id_kecamatan_bg'] : $data['id_kec_bg']; ?>').trigger('change');
		$('#id_kelurahan').val('<?= isset($data['id_kel_bgn']) ? $data['id_kel_bgn'] : ""; ?>').trigger('change');
	}
	$('#id_provinsi').change(function() {
		var v = $(this).val();
		var select = "<?= isset($data['id_kabkot']) ? $data['id_kabkot'] : ""; ?>";
		jQuery.post(base_url + 'Konsultasi/getDataKabKota/' + v, function(data) {
			$('select[name="id_kabkota"]').empty();
			$.each(data, function(key, value) {
				if (select == value.id_kabkot) {
					$('select[name="id_kabkota"]').append('<option value="' + value.id_kabkot + '" selected>' + value.nama_kabkota + '</option>').trigger('change');
				} else {
					$('select[name="id_kabkota"]').append('<option value="' + value.id_kabkot + '">' + value.nama_kabkota + '</option>');
				}
			});
		}, 'json');
	});

	$('#id_kabkota').change(function() {
		var v = $(this).val();
		var select = "<?= isset($data['id_kecamatan']) ? $data['id_kecamatan'] : ""; ?>";
		jQuery.post(base_url + 'Konsultasi/getDataKecamatan/' + v, function(data) {
			$('select[name="id_kecamatan"]').empty();
			$.each(data, function(key, value) {
				if (select == value.id_kecamatan) {
					$('select[name="id_kecamatan"]').append('<option value="' + value.id_kecamatan + '" selected>' + value.nama_kecamatan + '</option>').trigger('change');
				} else {
					$('select[name="id_kecamatan"]').append('<option value="' + value.id_kecamatan + '">' + value.nama_kecamatan + '</option>');
				}
			});
		}, 'json');
	});

	$('#id_kecamatan').change(function() {
		var v = $(this).val();
		var select = "<?= isset($data['id_kel_bgn']) ? $data['id_kel_bgn'] : ""; ?>";
		jQuery.post(base_url + 'Konsultasi/getDataKelurahan/' + v, function(data) {
			$('select[name="id_kelurahan"]').empty();
			$.each(data, function(key, value) {
				if (select == value.id_kelurahan) {
					$('select[name="id_kelurahan"]').append('<option value="' + value.id_kelurahan + '" selected>' + value.nama_kelurahan + '</option>').trigger('change');
				} else {
					$('select[name="id_kelurahan"]').append('<option value="' + value.id_kelurahan + '">' + value.nama_kelurahan + '</option>');
				}
			});
		}, 'json');
	});


	$('#id_provinsi_bg').change(function() {
		var v = $(this).val();
		var select = "<?= isset($data['id_kabkot_bg']) ? $data['id_kabkot_bg'] : ""; ?>";
		jQuery.post(base_url + 'Konsultasi/getDataKabKota/' + v, function(data) {
			$('select[name="id_kabkota_bg"]').empty();
			$.each(data, function(key, value) {
				if (select == value.id_kabkot) {
					$('select[name="id_kabkota_bg"]').append('<option value="' + value.id_kabkot + '" selected>' + value.nama_kabkota + '</option>').trigger('change');
				} else {
					$('select[name="id_kabkota_bg"]').append('<option value="' + value.id_kabkot + '">' + value.nama_kabkota + '</option>');
				}
			});
		}, 'json');
	});

	$('#id_kabkota').change(function() {
		var v = $(this).val();
		var select = "<?= isset($data['id_kecamatan_bg']) ? $data['id_kecamatan_bg'] : $data['id_kec_bg']; ?>";
		jQuery.post(base_url + 'Konsultasi/getDataKecamatan/' + v, function(data) {
			$('select[name="id_kecamatan_bg"]').empty();
			$.each(data, function(key, value) {
				if (select == value.id_kecamatan) {
					$('select[name="id_kecamatan_bg"]').append('<option value="' + value.id_kecamatan + '" selected>' + value.nama_kecamatan + '</option>').trigger('change');
				} else {
					$('select[name="id_kecamatan_bg"]').append('<option value="' + value.id_kecamatan + '">' + value.nama_kecamatan + '</option>');
				}
			});
		}, 'json');
	});

	$('#id_kecamatan_bg').change(function() {
		var v = $(this).val();
		var select = "<?= isset($data['id_kel_bgn']) ? $data['id_kel_bgn'] : ""; ?>";
		jQuery.post(base_url + 'Konsultasi/getDataKelurahan/' + v, function(data) {
			$('select[name="id_kelurahan_bg"]').empty();
			$.each(data, function(key, value) {
				if (select == value.id_kelurahan) {
					$('select[name="id_kelurahan_bg"]').append('<option value="' + value.id_kelurahan + '" selected>' + value.nama_kelurahan + '</option>').trigger('change');
				} else {
					$('select[name="id_kelurahan_bg"]').append('<option value="' + value.id_kelurahan + '">' + value.nama_kelurahan + '</option>');
				}
			});
		}, 'json');
	});
</script>