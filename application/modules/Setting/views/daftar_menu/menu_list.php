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
					<i class="fa fa-globe"></i>Daftar Menu
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
							<th>Nama Menu</th>
							<th>Sub Menu</th>
							<th>URL</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php

						if ($daftar_menu->num_rows() > 0) {
							$no = 1;
							foreach ($daftar_menu->result() as $key) {
								if ($key->parentid == '0') {
									$Nama_Menu = $key->name_menu;
									$Sub_Menu = "";
								} else {
									$Nama_Menu = "";
									$Sub_Menu = $key->name_menu;
								}

								if ($key->menu_aktif == '1') {
									$class = "label label-sm label-info";
									$status = "Aktif";
								} else {
									$class = "label label-sm label-info";
									$status = "Non Aktif";
								}
								?>
								<tr>
									<td align="center"><?php echo $no++; ?></td>
									<td><?php echo $Nama_Menu; ?></td>
									<td><?php echo $Sub_Menu; ?></td>
									<td><?php echo $key->url; ?></td>
									<td align="center"><span class="<?php echo $class; ?>"><?php echo $status; ?></span></td>
									<td align="center"><a href="<?php echo site_url('Setting/edit_menu/' . $key->id); ?>" class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-pencil"></span></a> <a href="<?php echo site_url('setting/removeDataMenu/' . $key->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>

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
		<form action="<?php echo site_url('Setting/saveDataMenu'); ?>" class="form-horizontal" role="form" method="post" id="from_user">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Tambah Menu</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-body">

								<div class="form-group">
									<label class="col-md-3 control-label">Jenis Menu</label>
									<div class="col-md-9">
										<select class="form-control" name="jenis_menu" id="jenis_menu" onchange="getjenismenu(this.value)">
											<option value="">--Pilih--</option>
											<option value="1">Menu Utama</option>
											<option value="2">Sub Menu</option>
										</select>
									</div>
								</div>

								<div id="jenis" style="display: none;">
									<div class="form-group">
										<label class="col-md-3 control-label">Menu Utama</label>
										<div class="col-md-9">
											<div>
												<select name="menu_utama" id="menu_utama" class="form-control">
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Nama Menu</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="nama_menu" placeholder="Nama Menu" autocomplete="off">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">URL</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="url_link" placeholder="Link URL" autocomplete="off">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">Icon bootstrap</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="icon_bootstrap" placeholder="Icon Bootstrap" autocomplete="off">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label">status</label>
									<div class="col-md-9">
										<select class="form-control" name="status" id="status">
											<option value="">--Pilih--</option>
											<option value="1">Aktif</option>
											<option value="2">Non Aktif</option>
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
			// rowReorder: {
			// 	selector: 'td:nth-child(2)'
			// },
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


	function getjenismenu(v) {
		if (v == '1') {
			document.getElementById('jenis').style.display = "none";
		} else {
			document.getElementById('jenis').style.display = "block";
		}
	}


	$(function() {
		// Setup form validation on the #register-form element
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



	jQuery.post(base_url + 'Setting/getMenuUtama', function(data) {
		var menu_utama = '';
		jQuery.each(data, function(key, value) {
			menu_utama += '<option value="' + value.id + '"> ' + value.name + ' </option>';
		});
		jQuery('#menu_utama').html(menu_utama);
	}, 'json');
</script>