<style>
	ul.menu-list {
		list-style: none outside none;
		margin-top: 10px;
	}

	ul.menu-list li.menu-list input {
		margin-top: -2px;
	}

	ul.menu-list li span.text-menulist {
		margin-left: 10px;
		font-size: 12px;
	}

	th {
		text-align: center;
	}
</style>

<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-8">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box grey-cascade">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>Pengaturan Menu Hak Akses
				</div>

			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-4">
							<!--
										<div class="btn-group">
											<button type="button" class="btn btn-primary" data-toggle="modal" href="#responsive" onclick="listmenu()">Tambah <i class="fa fa-plus"></i></button>
										</div>
										!-->
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
						<tr align="center">
							<th>No</th>
							<th>Nama Role</th>
							<th>Kelompok Group</th>
							<th>Menu Akses</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$no = 1;
						foreach ($role_user->result() as $key) {
							if ($key->group == 1) {
								$class = "label label-sm label-success";
								$status = "Admin";
							} else if ($key->group == 4) {
								$class = "label label-sm label-danger";
								$status = "User";
							} else {
								$class = "label label-sm label-warning";
								$status = "Dinas";
							}
							?>
							<tr class="odd gradeX">
								<td align="center"><?php echo $no++; ?></td>
								<td><?php echo $key->name_role; ?></td>
								<td align="center">
									<span class="<?php echo $class; ?>">
										<?php echo $status; ?> </span>
								</td>
								<td align="center">
									<button type="button" class="btn green btn-sm" onclick="menuakses('<?php echo $key->id; ?>','<?php echo $key->name_role; ?>')">Lihat <i class="fa fa-eye"></i></button>
								</td>
								<td align="center"><a href="<?php echo site_url('Setting/edit_menu_akses/' . $key->id); ?>" class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-pencil"></span></a></td>
							</tr>

						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>

	<div class="col-md-4">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box grey-cascade" style="overflow: scroll;max-height: 700px;">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>Menu Aksses
				</div>

			</div>
			<div class="portlet-body">
				<h4 id="title"></h4>
				<div id="ajax-element">
					<div style="text-align:center">Klik Tombol Lihat pada Menu Akses</div>
				</div>
			</div>
		</div>
	</div>




</div>



<!-- /.modal -->
<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<form action="<?php echo site_url('setting/saveDataPengaturanMenu'); ?>" class="form-horizontal" role="form" method="post" id="frm_role">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Pengaturan Akses Menu</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 ">
							<div class="portlet box green ">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i>Pengaturan Akses
									</div>
									<div class="tools">
										<a href="javascript:;" class="collapse">
										</a>
										<a href="javascript:;" class="reload">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 control-label">Nama Role</label>
											<div class="col-md-9">
												<div>
													<select name="nama_role" id="nama_role" class="form-control">
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6 ">
							<div class="portlet green-meadow box">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-cogs"></i>Pengaturan Menu Akses
									</div>
									<div class="tools">
										<a href="javascript:;" class="collapse">
										</a>
										<a href="javascript:;" class="reload">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									<div id="show_listmenu"></div>

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

<script type="text/javascript">
	$(function() {
		// Setup form validation on the #register-form element
		$("#frm_role").validate({
			// Specify the validation rules
			rules: {
				name: "required",
				member: "required",
				published: "required",
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
				name: "Masukan Nama Role",
				member: "Pilih Kelompok Pengguna",
				published: "Pilih Status",
			},

			submitHandler: function(form) {
				form.submit();

			}
		});
	});

	$(document).ready(function() {
		jQuery.post(base_url + 'setting/getRoleUser', function(data) {
			var nama_role = '';
			jQuery.each(data, function(key, value) {
				nama_role += '<option value="' + value.id + '"> ' + value.name + ' </option>';
			});
			jQuery('#nama_role').html(nama_role);
		}, 'json');

	});

	function listmenu() {
		jQuery.post(base_url + 'setting/listMenu', {
			disable: 'N'
		}, function(data) {
			jQuery('#show_listmenu').html(data);
		});
	}

	function menuakses(id, name) {
		jQuery('#title').text(name);
		jQuery.post(base_url + 'setting/listMenushow', {
			value: id
		}, function(data) {
			jQuery('#ajax-element').html(data);
		});
	}

	$(document).ready(function() {
		var table = $('#example1').DataTable({
			// rowReorder: {
			// 	selector: 'td:nth-child(2)'
			// },
			scrollX: true,
			responsive: true
		});
	});




	/*jQuery(document).ready(function() {
		alert('xx');
		jQuery.post(base_url+'role/checkingGroup',function(data){
			jQuery('.memberinput').append(data);
		});

	    var table = $('#example').DataTable();

	    $('#example tbody').on('click', 'tr', function () {
	        var data = table.row( this ).data();
	        alert( 'You clicked on '+data[0]+'\'s row' );
	    } );

	} );*/
</script>