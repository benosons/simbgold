<form action="Tpa/status_verifikasi" class="form-horizontal" role="form" method="post" id="savestatusver" name="savestatusver" enctype="multipart/form-data">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 align="center" class="modal-title"><b>Data Tenaga Ahli </b></h4>
	</div>
	<div class="row">
		<div class="col-md-12 ">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Nama Tenaga Ahli</label>
					<div class="col-md-9">
						<input type="hidden" name="id" value="<?php echo $data->id; ?>">
						<input class="form-control" value="<?php echo $data->nm_tpa; ?>" placeholder="Nama Pemilik" autocomplete="off" readonly>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 ">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Alamat Tenaga Ahli</label>
					<div class="col-md-9">
						<textarea class="form-control" readonly placeholder="Alamat Pemilik"><?php echo $data->alamat; ?></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 ">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">No.Kontak</label>
					<div class="col-md-9">
						<input class="form-control" value="<?php echo $data->no_kontak; ?>" placeholder="No Kontak" autocomplete="off" readonly>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 ">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">E-Mail</label>
					<div class="col-md-9">
						<input class="form-control" value="<?php echo $data->email; ?>" placeholder="Email" autocomplete="off" readonly>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="portlet-body">
		<div class="tabbable-custom nav-justified">
			<ul class="nav nav-tabs nav-justified">
				<li class="active"><a href="#tabtot" data-toggle="tab">Data Pendidikan</a></li>
				<li><a href="#tab_2_1" data-toggle="tab">Data Pengalaman </a></li>
				<li><a href="#tab_2_2" data-toggle="tab">Data Keahlian</a></li>
				<li><a href="#tab_2_3" data-toggle="tab">Status</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="tabtot">
					<div class="table-scrollable">
						<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
							<thead>
								<tr class="warning">
									<th><center>No.</center></th>
									<th><center>Jenjang Pendidikan<br> Jurusan</center></th>
									<th><center>Nama Perguruan Tinggi</center></th>
									<th><center>No. Ijazah & Tahun</center></th>
									<th><center>Berkas</center></th>
									<th><center>Aksi</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								if ($DataPendidikan->num_rows() > 0) {
									foreach ($DataPendidikan->result() as $dtp) { ?>
										<tr class="list_<?= $dtp->id_riwpend; ?>">
											<td><?= $no++; ?></td>
											<td><?= $dtp->jurusan; ?></td>
											<td><?= $dtp->nm_sekolah; ?></td>
											<td><?= $dtp->no_ijazah; ?></td>
											<td><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Pendidikan/' . $dtp->id . '/' . $dtp->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a></td>
											<?php $checked = "";
											if ($dtp->status_pdd	 == '1') {
												$checked = "checked";
											} ?>
											<td align="center">
												<input type="checkbox" name="syarat_<?= $dtp->id_riwpend ?>" value="<?= $dtp->id_riwpend ?>" id="syarat_<?= $dtp->id_riwpend ?>" onchange="check_pendidikan('syarat_<?= $dtp->id_riwpend ?>','<?= $dtp->id_riwpend ?>','adm')" <?= $checked ?>>
											</td>
										</tr>
								<?php }
								} ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane fade" id="tab_2_1">
					<div class="table-scrollable">
						<table class="table table-bordered table-striped table-hover" id="sample_editable_1">
							<thead>
								<tr class="warning">
									<th><center>No.</center></th>
									<th><center>Kabupaten/Kota</center></th>
									<th><center>Nomor SK</center></th>
									<th><center>Berkas</center></th>
									<th><center>Aksi</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								if ($DataPengalaman->num_rows() > 0) {
									foreach ($DataPengalaman->result() as $dtp) {
								?>
										<tr class="list_<?= $dtp->id_pengalaman; ?>">
											<td><?= $no++; ?></td>
											<td></td>
											<td></td>
											<td><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Pengalaman/' . $dtp->id . '/' . $dtp->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a></td>
											<?php $checked = "";
											if ($dtp->status == '1') {
												$checked = "checked";
											} ?>
											<td align="center">
												<input type="checkbox" name="syarat_<?= $dtp->id_pengalaman ?>" value="<?= $dtp->id_pengalaman ?>" id="syarat_<?= $dtp->id_pengalaman ?>" onchange="check_pengalaman('syarat_<?= $dtp->id_pengalaman ?>','<?= $dtp->id_pengalaman ?>','adm')" <?= $checked ?>>
											</td>
										</tr>
								<?php }
								} ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane fade" id="tab_2_2">
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
										<center>Spesialist</center>
									</th>
									<th>
										<center>Kualifikasi SKA</center>
									</th>
									<th>
										<center>No. SKA</center>
									</th>
									<th>
										<center>Berkas</center>
									</th>
									<th>
										<center>Aksi</center>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								if ($DataAhli->num_rows() > 0) {
									foreach ($DataAhli->result() as $dtk) {
								?>
										<tr class="list_<?= $dtk->id_ahli; ?>">
											<td><?= $no++; ?></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/pengalaman/' . $dtk->id_ahli . '/' . $dtk->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a></td>
											<?php $checked = "";
											if ($dtk->status == '1') {
												$checked = "checked";
											} ?>
											<td align="center">
												<input type="checkbox" name="syarat_<?= $dtk->id_ahli ?>" value="<?= $dtk->id_ahli ?>" id="syarat_<?= $dtk->id_ahli ?>" onchange="check_keahlian('syarat_<?= $dtk->id_ahli ?>','<?= $dtk->id_ahli ?>','adm')" <?= $checked ?>>
											</td>
										</tr>
								<?php }
								} ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane fade" id="tab_2_3">
					<div class="col-md-12 ">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Hasil Verifikasi</label>
								<div class="col-md-9">
									<label class="radio-inline">
										<input type="radio" name="status_ver" id="status_ver_1" value="1">Memenuhi Syarat
										<br>
										<input type="radio" name="status_ver" id="status_ver_2" value="2">Tidak Memenuhi Syarat
									</label>
								</div>
							</div>
						</div>
						<div class="form-group" type="hidden">
							<label class="col-md-3 control-label">Dokumen Informasi</label>
							<div class="col-md-9">
								<span class="btn grey-cascade fileinput-button">
									<input type="file" name="dir_file_pemberitahuan" id="dir_file_pemberitahuan">
									<input type="text" name="filename_pemberitahuan" id="filename_pemberitahuan" style="display: none;">
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Catatan</label>
							<div class="col-md-9">
								<textarea class="form-control" name="catatan" id="catatan" placeholder="Keterangan"></textarea>
							</div>
						</div>
						<div class="form-group">
							<input id="xstin" name="xstin" onClick="Xtin()" type="submit" value="Simpan" class="btn blue-hoki btn-block">
						</div>
					</div>
				</div>
			</div>
		</div>
</form>
<!--MODAL HAPUS-->

<script type="text/javascript">
	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}

	function check_pendidikan(key, id) {
		if (document.getElementById(key).checked) {
			$.ajax({
				url: '<?php echo base_url('Tpa/check_pendidikan/' . $this->uri->segment(3)) ?>/' + id + '/',
				type: 'POST',
				dataType: 'html',
				cache: false,
				success: function(response) {
					$('div#detail_personal').html('');
					$('div#detail_personal').html(response);
				}
			});
		} else {
			$.ajax({
				url: '<?php echo base_url('Tpa/uncheck_pendidikan/' . $this->uri->segment(3)) ?>/' + id + '/',
				type: 'POST',
				dataType: 'html',
				cache: false,
				success: function(response) {
					$('div#detail_personal').html('');
					$('div#detail_personal').html(response);
				}
			});
		}
	}

	function check_pengalaman(key, id) {
		if (document.getElementById(key).checked) {
			$.ajax({
				url: '<?php echo base_url('Tpa/check_pengalaman/' . $this->uri->segment(3)) ?>/' + id + '/',
				type: 'POST',
				dataType: 'html',
				cache: false,
				success: function(response) {
					$('div#detail_personal').html('');
					$('div#detail_personal').html(response);
				}
			});
		} else {
			$.ajax({
				url: '<?php echo base_url('Tpa/uncheck_pengalaman/' . $this->uri->segment(3)) ?>/' + id + '/',
				type: 'POST',
				dataType: 'html',
				cache: false,
				success: function(response) {
					$('div#detail_personal').html('');
					$('div#detail_personal').html(response);
				}
			});
		}
	}

	function check_keahlian(key, id) {
		if (document.getElementById(key).checked) {
			$.ajax({
				url: '<?php echo base_url('Tpa/check_keahlian/' . $this->uri->segment(3)) ?>/' + id + '/',
				type: 'POST',
				dataType: 'html',
				cache: false,
				success: function(response) {
					$('div#detail_personal').html('');
					$('div#detail_personal').html(response);
				}
			});
		} else {
			$.ajax({
				url: '<?php echo base_url('Tpa/uncheck_keahlian/' . $this->uri->segment(3)) ?>/' + id + '/',
				type: 'POST',
				dataType: 'html',
				cache: false,
				success: function(response) {
					$('div#detail_personal').html('');
					$('div#detail_personal').html(response);
				}
			});
		}
	}

	function Xtin() {
		if ($('#status_ver_1:checked').val() == 1) {
			$("#savestatusver").validate({
				// Specify the validation rules
				rules: {
					status_syarat: "required",
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
					status_syarat: "Tentukan Status Syarat",
				},
				submitHandler: function(form) {
					form.submit();
				}
			});
		} else {
			$("#savestatusver").validate({
				// Specify the validation rules
				rules: {
					status_syarat: "required",
					catatan: "required",
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
					status_syarat: "Tentukan Status Syarat",
					catatan: "Masukan Keterangan",
				},
				submitHandler: function(form) {
					form.submit();
				}
			});
		}
	}
</script>