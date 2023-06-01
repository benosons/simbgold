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
					<i class="fa fa-globe"></i>Daftar Wilayah
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
							<th>ID Provinsi</th>
							<th>Nama Provinsi</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php

						if ($wilayah->num_rows() > 0) {
							$no = 1;
							foreach ($wilayah->result() as $key) {
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
									<td><?php echo $key->id_provinsi; ?></td>
									<td><?php echo $key->nama_provinsi; ?></td>
									<td align="center">
										<a href="<?php echo site_url('Setting/edit_wilayah/' . $key->id_provinsi . '/'.rawurlencode($key->nama_provinsi).'/kabkot' ); ?>" class="btn btn-info btn-sm" title="Ubah Data" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-eye-open"></span></a>
										<a href="<?php echo site_url('setting/removeDataMenu/' . $key->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>

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


	function getkabkot(isthis) {
		var id_kabkot = $('#pilih_kabkot').val()
		var nama_kabkot = $('#pilih_kabkot option:selected').text()
		$('#id_kabkot').val(id_kabkot)
		$('#nama_kabkot').val(nama_kabkot)
		$('#id_kecamatan').val('')
		$('#nama_kecamatan').val('')
		$('#id_kelurahan').val('')
		$('#nama_kelurahan').val('')

		$.ajax({
            type:'POST',
            url:"<?php echo site_url('Setting/getwilayah/');?>",
			data: {
				param: 'kecamatan',
				id: id_kabkot
			},
            success:function(data){
				var el = '<option value="0">Pilih...</option>'
				var data = JSON.parse(data)
				data.forEach(element => {
					el += `<option value="${element.id}">${element.name}</option>`
				});
				// for (let index = 0; index < data.length; index++) {
				// 	console.log(data[index].id_kecamatan);
				// }

				$('#pilih_kecamatan').html(el)
            }
        });
	}

	function getkec(isThis){
		var id_kecamatan = $('#pilih_kecamatan').val()
		var nama_kecamatan = $('#pilih_kecamatan option:selected').text()
		$('#id_kecamatan').val(id_kecamatan)
		$('#nama_kecamatan').val(nama_kecamatan)
		$('#id_kelurahan').val('')
		$('#nama_kelurahan').val('')
    	
		$.ajax({
            type:'POST',
            url:"<?php echo site_url('Setting/getwilayah/');?>",
			data: {
				param: 'kelurahan',
				id: id_kecamatan
			},
            success:function(data){
				var el = '<option value="0">Pilih...</option>'
				var data = JSON.parse(data)
				data.forEach(element => {
					el += `<option value="${element.id}">${element.name}</option>`
				});
				// for (let index = 0; index < data.length; index++) {
				// 	console.log(data[index].id_kecamatan);
				// }

				$('#pilih_kelurahan').html(el)
            }
        });
	}

	function getkelurahan(isThis){
		var id_kelurahan = $('#pilih_kelurahan').val()
		var nama_kelurahan = $('#pilih_kelurahan option:selected').text()
		$('#id_kelurahan').val(id_kelurahan)
		$('#nama_kelurahan').val(nama_kelurahan)
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

	function updatewilayah(){
		var  id_provinsi = $('#id_provinsi').val()
		var  nama_provinsi = $('#nama_provinsi').val()
		var  id_kabkot = $('#id_kabkot').val()
		var  nama_kabkot = $('#nama_kabkot').val()
		var  id_kecamatan = $('#id_kecamatan').val()
		var  nama_kecamatan = $('#nama_kecamatan').val()
		var  id_kelurahan = $('#id_kelurahan').val()
		var  nama_kelurahan = $('#nama_kelurahan').val()

		$.ajax({
            type:'POST',
            url:"<?php echo site_url('Setting/updateDataWilayah');?>",
			data: {
				id_provinsi : id_provinsi,
				nama_provinsi : nama_provinsi,
				id_kabkot : id_kabkot,
				nama_kabkot : nama_kabkot,
				id_kecamatan : id_kecamatan,
				nama_kecamatan : nama_kecamatan,
				id_kelurahan : id_kelurahan,
				nama_kelurahan : nama_kelurahan,
			},
            success:function(data){
				location.reload()
			}
		})
	}

	jQuery.post(base_url + 'Setting/getMenuUtama', function(data) {
		var menu_utama = '';
		jQuery.each(data, function(key, value) {
			menu_utama += '<option value="' + value.id + '"> ' + value.name + ' </option>';
		});
		jQuery('#menu_utama').html(menu_utama);
	}, 'json');
</script>