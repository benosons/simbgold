<?php isset($tpa) ? $DataTpa = $tpa->row() : ''; ?>
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
					<form action="<?php echo site_url('InputTPA/saveDokumen'); ?>" class="form-horizontal" role="form" method="post" id="FormDok" enctype="multipart/form-data">
						<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<div class="form-group">
							<label class="col-md-3 control-label">Nama Perguruan Tinggi</label>
							<div class="col-md-5">
								<input type="text" class="form-control" value="<?= (isset($ids) ? $ids : ''); ?>" name="id" style="display: none;" autocomplete="off">
								<input type="text" class="form-control" value="<?= (isset($DataTpa->id_dok) ? $DataTpa->id_dok : ''); ?>" name="id_dok" style="display: none;" autocomplete="off">
								<?php
								$js = 'id="id_asak" class="form-control"';
								echo form_dropdown('id_asak', $list_asosiasi, isset($DataTpa->id_asak) ? $DataTpa->id_asak : '', $js);
								?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Surat Penugasan</label>
							<div class="col-md-8">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<?php if (!empty($DataTpa->dir_file)) {
										$filename = FCPATH . "/dekill/Tpa/$DataTpa->dir_file";
										$file = '';
										if (file_exists($filename)) {
											$file = base_url('dekill/Tpa/' . $DataTpa->dir_file);
										} else {
											$file = base_url() . 'file/Tpa/' . $DataTpa->id . '/' . $DataTpa->dir_file;
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
										<td>Rp. <?php echo number_format(str_replace('.', '.', $r->nilai)) ?></td>
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
							<button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>InputTPA/Form/<?= (isset($ids) ? $ids : ''); ?>';return false;">Kembali</button>
						</span>
						<span class="input-group-btn">
							<button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>InputTPA/Dataprofesi/<?= (isset($ids) ? $ids : ''); ?>';return false;">Lanjut</button>
						</span>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(function() {
		$("#FormDok").validate({
			// Specify the validation rules
			rules: {
				id_asak: "required",
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
				id_asak: "Pilih Asosiasi Profesi",
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	});

	function deleteRiwPeng(v) {
		if (confirm('Apakah kamu yakin akan menghapus data ini ?')) {
			$.ajax({
				url: '<?php echo base_url() . index_page() ?>InputTPA/deleteRiwPeng/' + v,
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
			<h4 class="modal-title">Tambah Data Pengalaman</h4>
		</div>
		<div class="modal-body form">
			<form action="<?php echo site_url('InputTPA/simpanpengalaman'); ?>" class="form-horizontal" role="form" method="post" id="FormTambahPengalaman" enctype="multipart/form-data">
				<input type="hidden" id='csrf_id_peng' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<div class="portlet-body form">
					<div class="form-body">
						<div class="row">
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
									<input class="allownumericwithoutdecimal form-control" maxlength="4" type="tahun" name="tahun" placeholder="Tahun" autocomplete="off">
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