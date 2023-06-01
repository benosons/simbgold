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
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box grey-cascade">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>Pengaturan Persyaratan Permohonan
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
							<th>Nama Permohonan</th>
							<th>Informasi</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$no = 1;
						foreach ($permohonan->result() as $key) {

							?>
							<tr class="odd gradeX">
								<td align="center"><?php echo $no++; ?></td>
								<td><?php echo $key->nama_permohonan; ?></td>
								<td align="center"><a href="<?php echo site_url('referensi/persyaratan_permohonan_view/' . $key->id_jenis_permohonan); ?>" type="button" class="btn green btn-sm" title="Ubah Data" data-toggle="modal" data-target="#modal-edit">Lihat <i class="fa fa-eye"></i></a></td>
								<td align="center"><a href="<?php echo site_url('referensi/edit_persyaratan_permohonan/' . $key->id_jenis_permohonan); ?>" class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-pencil"></span></a></td>
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
			$("#frm_persyaratan_permohonan").validate({
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

		function listmenu() {
			jQuery.post(base_url + 'referensi/listMenu', {
				disable: 'N'
			}, function(data) {
				jQuery('#show_listmenu').html(data);
			});
		}

		function menuakses(id, name) {
			jQuery('#title').text(name);
			jQuery.post(base_url + 'referensi/listMenushow', {
				value: id
			}, function(data) {
				jQuery('#ajax-element').html(data);
			});
		}

		$(document).ready(function() {
			var table = $('#example1').DataTable({
				scrollX: true,
				responsive: true
			});
		});
	</script>