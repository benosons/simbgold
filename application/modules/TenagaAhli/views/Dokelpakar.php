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
						Dokumen Kelengkapan
					</div>
				</div>
				<div class="portlet-body">
					<form action="<?php echo site_url('TenagaAhli/saveDokumen'); ?>" class="form-horizontal" role="form" method="post" id="FormDok" enctype="multipart/form-data">
						<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

						<div class="page-title" align="center">
							<span class="caption font-blue-hoki bold" style="font-size: 22px;"></span>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Sub Unsur Pakar</label>
							<div class="col-md-5">
								<input type="text" class="form-control" value="<?= (isset($ids) ? $ids : ''); ?>" name="id" style="display: none;" autocomplete="off">
								<input type="text" class="form-control" value="<?= (isset($DataTpa->id_dok) ? $DataTpa->id_dok : ''); ?>" name="id_dok" style="display: none;" autocomplete="off">
								<?php
								$js = 'id="id_asak" onchange="set_spesialist(this.value)" class="form-control"';
								echo form_dropdown('id_asak', $list_asosiasi, isset($DataTpa->id_asak) ? $DataTpa->id_asak : '', $js);
								?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Keahlian</label>
							<div class="col-md-6">
								<textarea class="form-control" rows="3" name="keahlian"><?php echo set_value('keahlian', $tpa->num_rows() > 0 ? $DataTpa->keahlian : '') ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Surat Rekomendasi</label>
							<div class="col-md-8">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<?php if (!empty($DataTpa->dir_file)) {
										$filename = FCPATH . "/object-storage/dekill/Tpa/$DataTpa->dir_file";
										$file = '';
										if (file_exists($filename)) {
											$file = base_url('object-storage/dekill/Tpa/' . $DataTpa->dir_file);
										} else {
											$file = base_url() . 'object-storage/file/Tpa/' . $DataTpa->id . '/' . $DataTpa->dir_file;
										}
										$name = 'Ubah Fle';
										echo '<div class="fileinput-new thumbnail">';
										echo '<a href="' . $file . '" target="_blank" alt="" class="btn default blue-stripe">Lihat</a>';
										echo '</div>'; ?>

										<input type="hidden" name="dir_dokumen" value="<?= $DataTpa->dir_file; ?>" id="dir_dokumen">
									<?php } ?>
									<input type="file" name="dir_file" id="dir_file">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"></label>
							<div class="col-md-4">
								<button type="submit" class="btn green">Simpan</button>
							</div>
						</div>
						<div class="page-title" align="center">
							<span class="caption font-blue-hoki bold" style="font-size: 18px;">Pengalaman Pekerjaan di Bidang Penyelenggaraan Bangunan Gedung (5 tahun terakhir)</span>
						</div>
						<br>
						<div class="modal-footer">
							<center>
								<a href="#pengalaman" role="button" class="btn green" data-toggle="modal">Tambah Pengalaman</a>
							</center>
						</div>
					</form>
					<div class="table-scrollable">
						<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
							<thead>
								<tr class="warning">
									<th>
										<center>No.</center>
									</th>
									<th>
										<center>Nama Paket Pekerjaan</center>
									</th>
									<th>
										<center>Tahun</center>
									</th>
									<th>
										<center>Luas Bangunan Gedung (m<sup>2</sup>)</center>
									</th>
									<th>
										<center>Jumlah Lantai</center>
									</th>
									<th>
										<center>Nilai Pekerjaan</center>
									</th>
									<th>
										<center>Aksi</center>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($pengalaman as $r) : ?>
									<tr class="list_<?= $r->id_pengalaman; ?>">
										<td><?php echo $no++ ?></td>
										<td><?php echo $r->nm_paket ?></td>
										<td><?php echo $r->tahun ?></td>
										<td><?php echo $r->luas_bgn ?></td>
										<?php if ($r->jml_lantai == '1') {
											$lantai = "Kurang dari 4 Lantai";
										} else if ($r->jml_lantai == '2') {
											$lantai = "4 Sampai dengan 8 Lantai";
										} else if ($r->jml_lantai == '3') {
											$lantai = "Diatas 8 Lantai";
										} else {
											$lantai = "Belum ditentukan Lantai";
										} ?>
										<td><?php echo $lantai; ?></td>
										<td><?php echo $r->nilai ?></td>
										<td>
											<a onclick="deleteRiwPeng(<?= $r->id_pengalaman; ?>)" class="btn btn-danger btn-sm" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<center>
						<span class="input-group-btn">
							<button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>TenagaAhli';return false;">Kembali</button>
						</span>
						<span class="input-group-btn">
							<button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>TenagaAhli/Datadiri';return false;">Lanjut</button>
						</span>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var csrf_id = $("#csrf_id").val();
	var csrf_name = $("#csrf_id").attr('name');

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

	$(function() {
		$("#FormDok").validate({
			// Specify the validation rules
			rules: {
				id_asak: "required",
				keahlian: "required",
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
				id_asak: "Pilih Sub Unsur Pakar",
				keahlian: "Input Data Keahlian",
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	});

	function deleteRiwPeng(v) {
		if (confirm('Apakah kamu yakin akan menghapus data ini ?')) {
			$.ajax({
				url: '<?php echo base_url() . index_page() ?>TenagaAhli/deleteRiwPeng/' + v,
				dataType: 'json',
				success: function(data) {
					if (data.status == "success") {
						alert("File Berhasil Di Delete");
						$(".list_" + v).remove();
					} else {
						alert(data.msg);
					}
				}
			});
		}
	}
	// Setup form validation on the #register-form element
	$(function() {
		$("#FormTambahPengalaman").validate({
			// Specify the validation rules
			rules: {
				nm_paket: "required",
				//tahun: "required",
				tahun: {
					minlength: 4,
					maxlength: 4,
					required: true,
					number: true
				},
				luas_bgn: "required",
				jml_lantai: "required",
				nilai: "required",
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
				nm_paket: "Masukan Nama Paket Pekerjaan",
				//tahun: "Masukan Tahun Pekerjaan",
				tahun: {
					required: "Masukan Tahun Pekerjaan",
					minlength: "Terdiri 4 karakter",
					number: "Tahun harus berupa angka",
				},
				luas_bgn: "Masukkan Luas Bangunan",
				jml_lantai: "Pilih Salah Satu Jumlah Lantai",
				nilai: "Masukan Nilai Pekerjaan",
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	});
</script>
<div id="pengalaman" class="modal fade" role="dialog" aria-hidden="true" data-width="50%" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Tambah Data Penglaman</h4>
		</div>
		<div class="modal-body form">
			<form action="<?php echo site_url('TenagaAhli/simpanpengalaman'); ?>" class="form-horizontal" role="form" method="post" id="FormTambahPengalaman" enctype="multipart/form-data">
				<div class="portlet-body form">
					<div class="form-body">
						<div class="row">
							<input type="hidden" id='csrf_id_peng' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

							<div class="form-group">
								<label class="col-md-3 control-label">Nama Paket Pekerjaan</label>
								<div class="col-md-7">
									<input type="hidden" class="form-control" value="<?php echo set_value('id', ($tpa->num_rows() > 0 ? $DataTpa->id : '')) ?>" name="id" placeholder="id" autocomplete="off">
									<textarea rows="3" cols="30" class="form-control" name="nm_paket" placeholder="Nama Paket Pekerjaan" autocomplete="off"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Tahun</label>
								<div class="col-md-2">
									<input maxlength="4" class="allownumericwithoutdecimal form-control" type="tahun" name="tahun" placeholder="Tahun" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Luas Bangunan Gedung</label>
								<div class="col-md-3">
									<input class="allownumericwithoutdecimal form-control" type="luas_bgn" name="luas_bgn" placeholder="Luas Bangunan" autocomplete="off">
								</div>
								<div class="col-md-2">
									<label class="col-md-2 control-label">m<sup>2</sup></label>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Jumlah Lantai</label>
								<div class="col-md-4">
									<select class="form-control" name="jml_lantai" id="jml_lantai">
										<option value="">--Pilih Jenis Dokumen--</option>
										<option value="1">Kurang dari 4 Lantai</option>
										<option value="2">4 Lantai Sampai dengan 8 Lantai</option>
										<option value="3">Diatas 8 Lantai</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Nilai Pekerjaan</label>
								<div class="col-md-5">
									<input class="allownumericwithoutdecimal form-control" type="nilai" name="nilai" placeholder="Nilai Pekerjaan" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
</script>