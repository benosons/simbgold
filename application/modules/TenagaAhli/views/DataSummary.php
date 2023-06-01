<?php
isset($tpa) ? $DataTpa = $tpa->row() : '';
?>
<div class="portlet light margin-top-20">
	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject font-blue-madison bold uppercase">Data Diri</span>
		</div>
	</div>
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
						Data Tenaga Profesional Ahli
					</div>
				</div>
				<div class="portlet-body">
					<form action="<?php echo site_url(''); ?>" class="form-horizontal" role="form" method="post" id="form_plusonil">
						<div class="form-group">
							<label class="col-md-2 control-label">Nama TPA</label>
							<div class="col-md-2">
								<input type="text" class="form-control" value="<?php echo set_value('glr_depan', ($tpa->num_rows() > 0 ? $DataTpa->glr_depan : '')) ?>" name="glr_depan" placeholder="Gelar" autocomplete="off">
							</div>
							<div class="col-md-5">
								<input type="hidden" class="form-control" value="<?php echo set_value('id', ($tpa->num_rows() > 0 ? $DataTpa->id : '')) ?>" name="id" placeholder="id" autocomplete="off">
								<input type="text" class="form-control" value="<?php echo set_value('nm_tpa', ($tpa->num_rows() > 0 ? $DataTpa->nm_tpa : '')) ?>" name="nm_tpa" placeholder="Nama Lengkap Petugas" autocomplete="off">
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control" value="<?php echo set_value('glr_blkg', ($tpa->num_rows() > 0 ? $DataTpa->glr_blkg : '')) ?>" name="glr_blkg" placeholder="Gelar" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">No Identitas</label>
							<div class="col-md-9">
								<input type="text" maxlength="16" class="allownumericwithoutdecimal form-control" value="<?php echo set_value('no_ktp', ($tpa->num_rows() > 0 ? $DataTpa->no_ktp : '')) ?>" name="no_ktp" placeholder="Nomor KTP/SIM/Passport/NPWP" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Asal Kelembagaan</label>
							<div class="col-md-7">
								<?php $list_kelembagaan = array(
									"0" => "--Pilih--",
									"1" => "Asosiasi Profesi ",
									"2" => "Perguruan Tinggi/Akademisi",
								);
								echo form_dropdown('id_lembaga', $list_kelembagaan, $tpa->num_rows() > 0  ? $DataTpa->id_lembaga : '', 'class ="form-control" id="id_lembaga" '); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Asosiasi/Akademisi</label>
							<div class="col-md-8">
								<?php $list_nama = array(
									"0" => "--Pilih--",
									"1" => "IAI",
									"2" => "HAKI",

								);
								echo form_dropdown('id_nama', $list_nama, $tpa->num_rows() > 0 ? $DataTpa->id_nama : '', 'class ="form-control" id="id_nama" '); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Alamat</label>
							<div class="col-md-9">
								<textarea class="form-control" rows="3" name="alamat"><?php echo set_value('alamat', $tpa->num_rows() > 0 ? $DataTpa->alamat : '') ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Provinsi</label>
							<div class="col-md-9">
								<select name="id_provinsi" id="id_provinsi" class="form-control select2" data-placeholder="Select..." onchange="getkabkota(this.value)">
									<option value="">-- Pilih Provinsi --</option>
									<?php
									if ($daftar_provinsi->num_rows() > 0) {
										foreach ($daftar_provinsi->result() as $key) {
											if ($key->id_provinsi == $DataTpa->id_provinsi) {
												$plhrole = "selected";
											} else {
												$plhrole = "";
											}
											echo '<option value="' . $key->id_provinsi . '" ' . $plhrole . '>' . $key->nama_provinsi . '</option>';
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group" id="nama_kabkota_toggle">
							<label class="col-md-2 control-label">Kab/Kota</label>
							<div class="col-md-9">
								<select name="id_kabkot" id="nama_kabkota" class="form-control select2" data-placeholder="Select..." onchange="getkecamatan(this.value)">
									<option id="Loading" value="">-- Pilih Kabupaten / Kota --</option>
									<option value="">-- Pilih Kabupaten / Kota --</option>
									<?php if (isset($daftar_kabkota)) {
										if ($daftar_kabkota->num_rows() > 0) {
											foreach ($daftar_kabkota->result() as $key) {
												if ($key->id_kabkot == $DataTpa->id_kabkot) {
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
						<div class="form-group" id="nama_kecamatan_toggle">
							<label class="col-md-2 control-label">Kecamatan</label>
							<div class="col-md-9">
								<select style="display :block" name="id_kecamatan" id="nama_kecamatan" class="form-control select2" data-placeholder="Select...">
									<option value="">-- Pilih Kecamatan --</option>
									<?php
									if (isset($daftar_kabkota)) {
										if ($daftar_kecamatan->num_rows() > 0) {
											foreach ($daftar_kecamatan->result() as $key) {
												if ($key->id_kecamatan == $DataTpa->id_kecamatan) {
													$plhrole = "selected";
												} else {
													$plhrole = "";
												}
												echo '<option value="' . $key->id_kecamatan . '" ' . $plhrole . '>' . $key->nama_kecamatan . '</option>';
											}
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">No. Telephone</label>
							<div class="col-md-9">
								<input type="text" class="allownumericwithoutdecimal form-control" value="<?php echo set_value('no_kontak', ($tpa->num_rows() > 0 ? $DataTpa->no_kontak : '')) ?>" name="no_kontak" placeholder="No Kontak" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Email</label>
							<div class="col-md-9">
								<input type="text" class="form-control" value="<?php echo set_value('email', ($tpa->num_rows() > 0 ? $DataTpa->email : '')) ?>" name="email" placeholder="Mohon untuk Menginput Email Aktif" autocomplete="off">
							</div>
						</div>

					</form>
					<br>
					<div class="table-scrollable">
						<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
							<thead>
								<tr class="warning">
									<th>
										<center>No.</center>
									</th>
									<th>
										<center>Jenjang Pendidikan<br> Jurusan</center>
									</th>
									<th>
										<center>Nama Perguruan Tinggi</center>
									</th>
									<th>
										<center>No. Ijazah & Tahun</center>
									</th>
									<th>
										<center>Berkas</center>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($pendidikan as $r) : ?>
									<tr>
										<td><?php echo $no++ ?></td>
										<td><?php echo $r->nama_jenjang ?></td>
										<td><?php echo $r->nm_sekolah ?></td>
										<td><?php echo $r->no_ijazah ?></td>
										<td>
											<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Pendidikan/' . $r->id . '/' . $r->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<br>
					<div class="table-scrollable">
						<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
							<thead>
								<tr class="warning">
									<th>
										<center>No.</center>
									</th>
									<th>
										<center>Bidang Keahlian</center>
									</th>
									<th>
										<center>Spesialisasi</center>
									</th>
									<th>
										<center>No. SKA / Masa Berlaku</center>
									</th>
									<th>
										<center>Berkas</center>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($keahlian as $p) : ?>
									<tr>
										<td><?php echo $no++ ?></td>
										<td><?php echo $p->keahlian ?></td>
										<td><?php echo $p->spesialisasi ?></td>
										<td><?php echo $p->no_ska ?></td>
										<td>
											<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Keahlian/' . $r->id . '/' . $r->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<br>
					<div class="table-scrollable">
						<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
							<thead>
								<tr class="warning">
									<th>
										<center>No.</center>
									</th>
									<th>
										<center>Kabupaten/Kota</center>
									</th>
									<th>
										<center>No. SK /Tahun</center>
									</th>
									<th>
										<center>Berkas</center>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($Keahlian as $r) : ?>
									<tr>
										<td><?php echo $no++ ?></td>
										<td><?php echo $r->nama_kabkota ?></td>
										<td><?php echo $r->no_sk ?></td>
										<td>
											<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Pengalaman/' . $r->id . '/' . $r->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var csrf_id = $("#csrf_id").val();
	var csrf_name = $("#csrf_id").attr('name');
	$(function() {
		$('.select2').select2();
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
	// Setup form validation on the #register-form element

	$(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
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