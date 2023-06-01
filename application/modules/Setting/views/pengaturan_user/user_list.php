<style type="text/css">
	th {
		text-align: center;
	}
</style>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">

		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>List Data Users
				</div>

			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-4">
							<div class="btn-group">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#responsive">Tambah <i class="fa fa-plus"></i></button>
							</div>
						</div>

						<div class="col-md-4">
							<?php
							echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';

							?>
						</div>



					</div>
				</div>

				<table id="example1" class="display nowrap" style="width:100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Username</th>
							<th>Nama Role</th>
							<th>Nama Kab/Kota</th>
							<th>Group</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php

						if ($user_result->num_rows() > 0) {
							$no = 1;
							foreach ($user_result->result() as $key) {
								if ($key->group == '1') {
									$class = "label label-sm label-primary";
									$group = "Admin";
								} else if ($key->group == '2') {
									$class = "label label-sm label-info";
									$group = "PUPR";
								} else if ($key->group == '3') {
									$class = "label label-sm label-info";
									$group = "PTSP";
								} else {
									$class = "label label-sm label-info";
									$group = "USER";
								}

								if ($key->status == '1') {
									$class = "label label-sm label-info";
									$status = "Aktif";
								} else {
									$class = "label label-sm label-info";
									$status = "Non Aktif";
								}
								?>
								<tr>
									<td align="center"><?php echo $no++; ?></td>
									<td><?php echo $key->username; ?></td>
									<td><?php echo $key->name_role; ?></td>
									<td><?php echo $key->nama_kabkota; ?></td>
									<td><?php echo $group; ?></td>
									<td align="center"><span class="<?php echo $class; ?>"><?php echo $status; ?></span></td>
									<td align="center"><a href="<?php echo site_url('Setting/edit_pengaturan_user/' . $key->id); ?>" class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-pencil"></span></a> <a href="<?php echo site_url('setting/removePengaturanUser/' . $key->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>

								</tr>
							<?php
							}
						}
						?>
					</tbody>

				</table>




			</div>
		</div>
	</div>
</div>



<!-- /.modal -->
<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<form action="<?php echo site_url('Setting/savePengaturanUser'); ?>" class="form-horizontal" role="form" method="post" id="from_user">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Tambah User</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Username</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Password</label>
									<div class="col-md-9">
										<input type="password" class="form-control" id="password" value="" name="password" placeholder="password" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Ulangi Password</label>
									<div class="col-md-9">
										<input type="password" class="form-control" name="ulangi_password" placeholder="Ulangi password" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Kab/Kota</label>
									<div class="col-md-9">
										<select name="nama_kabkota" id="nama_kabkota" class="form-control select2me" data-placeholder="Select...">
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Role</label>
									<div class="col-md-9">
										<!--<select name="nama_role" id="nama_role" class="form-control">!-->
										<select name="nama_role" id="nama_role" class="form-control select2me" data-placeholder="Select...">
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Status</label>
									<div class="col-md-9">
										<select class="form-control" name="status" id="status">
											<option value="">--Pilih--</option>
											<option value="1">Aktif</option>
											<option value="0">Non Aktif</option>
										</select>
									</div>
								</div>


							</div>
						</div>


					</div>
				</div>

				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn default">Batal</button>
					<button type="submit" class="btn green">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</div>





<!-- /.modaledit -->
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">


		</div>
		<!-- /.modal-content -->
	</div>
</div>
<script>
	$(document).ready(function() {
		var table = $('#example1').DataTable({
			scrollX: true,
			responsive: true
		});
	});




	function getStatus() {
		var randomnumber = Math.floor(Math.random() * 100);
		$('#show').text(
			'I am getting refreshed every 3 seconds..! Random Number ==> ' +
			randomnumber);

	}

	// Example call to load a new file
	//table.fnReloadAjax( 'media/examples_support/json_source2.txt' );

	// Example call to reload from original file



	$(function() {
		// Setup form validation on the #register-form element
		jQuery.post(base_url + 'Setting/getNamaRole', function(data) {
			var nama_role = '';
			jQuery.each(data, function(key, value) {
				nama_role += '<option value="' + value.id + '"> ' + value.name_role + ' </option>';
			});
			jQuery('#nama_role').html(nama_role);
		}, 'json');

		jQuery.post(base_url + 'Setting/getNamaKabKota', function(data) {
			var nama_kabkota = '';
			jQuery.each(data, function(key, value) {
				nama_kabkota += '<option value="' + value.id_kabkot + '"> ' + value.nama_kabkota + ' </option>';
			});
			jQuery('#nama_kabkota').html(nama_kabkota);
		}, 'json');


		$("#from_user").validate({
			// Specify the validation rules
			rules: {
				nama_role: "required",
				group: "required",
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
				nama_role: "Masukan Nama Role User",
				group: "Pilih Fungsional Group",
			},

			submitHandler: function(form) {
				form.submit();
			}
		});
	});
</script>