<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"  />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" ></script>
<style type="text/css">
	th {
		text-align: center;
	}

	td {
		text-align: center;
	}

</style>
		<div>
            <?php
            echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' .
                $this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : '';
            ?>
        </div>
<div class="portlet light margin-top-20">
	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject text-primary bold uppercase">
				<i class=""></i>Data Surat Keputusan
            </span>
		</div>
		<div class="actions">
			<a href="#" data-toggle="modal" data-target="#modal_psk" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah SK </a>
		</div>

	</div>
	<div class="portlet-body" >
		<div class="">
			<table class="table table-bordered btable" style="min-height:320px;">
				<thead>
					<tr class="warning">
						<th style="width:4%">#</th>
						<th>Nomor SK</th>
						<th>Jenis SK</th>
						<th>Tanggal Penerbitan</th>
						<th>Masa Berlaku</th>
						<th style="width:4%">Personil</th>
						<!--th>Berkas</th-->
						<th style="width:20%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($data_sk->num_rows() > 0) {
                        $no = 1;
                        foreach ($data_sk->result() as $r) { ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><b><?php echo $r->no_sk; ?></b></td>
						<td><?php echo $r->tipe_sk; ?></td>
						<td><?php echo $r->tgl_sk; ?></td>
						<td><?php echo $r->expired_sk; ?></td>
						<td>
							<?php if($r->tipe_sk !='TPA'){ ?>
								<a href="<?php echo site_url('Sekretariat/personil_sk/' . $r->id_sk); ?>"
								class="btn btn-success btn-sm" title="Ubah Data Personil" data-toggle="modal"
								data-target="#personil-skPenilik"><span class="glyphicon glyphicon-user"></span>
                            	</a>
							<?php }else{ ?>
								<a href="<?php echo site_url('Sekretariat/personil_tpa/' . $r->id_sk); ?>"
									class="btn btn-success btn-sm" title="Ubah Data Personil" data-toggle="modal" data-target="#personil-skPenilik"><span class="glyphicon glyphicon-user"></span>
								</a>
							<?php }?>
							
						</td>
						<!--td>
							<a href="javascript:void(0);" class="btn purple btn-sm" title="Lihat Berkas"
								onClick="javascript:get_PSK('<?php echo $r->file_sk ?>')"> <i class="fa fa-file"></i>
								Lihat Berkas
							</a>
						</td-->
						<td>
							<a href="javascript:void(0);" class="btn purple btn-sm" title="Lihat Berkas"
								onClick="javascript:get_PSK('<?php echo $r->file_sk ?>')"> <i class="fa fa-file"></i>
							</a>
							<a class="btn btn-warning btn-sm" onClick="UbahPSK('<?php echo $r->id_sk; ?>')" title="Ubah SK">
							 <span class="glyphicon glyphicon-pencil"></span>
							</a>
							<a class="btn btn-danger btn-sm" data-href="<?php echo site_url('Sekretariat/hapus_psk/' . $r->id_sk); ?>"
							data-confirm="Anda yakin ingin menghapus data ini ?" title="Hapus Data SK"><span class="glyphicon glyphicon-trash"></span>
								
							</a>
							
						</td>
					</tr>
					<?php }
                    } ?>
				</tbody>
			</table>
		</div>

	</div>
</div>

<!-- /.modal -->
<div id="modal_psk" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-width="40%" data-keyboard="false">
	<?php echo form_open_multipart('Sekretariat/simpan_psk', [
        'class' => 'form-horizontal',
        'role' => 'form',
        'id' => 'tambah_psk'
    ]) ?>
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="ResRes2()"></button>
			<span class="caption-subject text-primary bold uppercase " style="font-size:15px;">Form Data SK</span>
		</div>
		<div class="modal-body">
			<div class="form-body">
				<div class="row">
				<br>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-circle"></i>
													</span>
													<input class="form-control" id="nomor_dokumen" name="no_skp" type="text" placeholder="0-9 / A-Z" autocomplete="off">
													<input style="display:none;" class="form-control" name="id_skp" placeholder="id" autocomplete="off">
													<label for="form_control_1">Nomor SK <span class="required" aria-required="true"> * </span></label>
													
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-circle"></i>
												</span>
												<select name="tipe_sk" class="form-control">
													<option value="">Pilih</option>
													<option value="Penilik">Penilik</option>
													<!--option value="TPT">TPT</option-->
													<option value="TPA">TPA</option>
												</select>	
													<label for="form_control_1">Jenis SK <span class="required" aria-required="true"> * </span></label>
												</div>
											</div>
											
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span>
													<input class="form-control datepicker" type="text" name="tgl_skp" data-date-format="yyyy-mm-dd" autocomplete="off" placeholder="2000/12/31" onkeydown="return false" >
													<label for="form_control_1">Tanggal Penerbitan <span class="required" aria-required="true"> * </span></label>
													
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span>
													<input class="form-control yearpicker" type="text" name="expired_skp" data-date-format="yyyy-mm-dd" autocomplete="off" placeholder="2002" onkeydown="return false" >
													<label for="form_control_1">Masa / Tahun Berlaku <span class="required" aria-required="true"> * </span></label>
													
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-circle"></i>
												</span>
												<input type="file" class="form-control" name="berkas" accept="application/pdf">
												<label for="form_control_1">Lampiran SK <span class="required" aria-required="true"> * </span></label>
											</div>
											</div>
										</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn red" onClick="ResRes2()"><i
					class="fa fa-sign-out"></i> Batal</button>
			<button type="submit" class="btn green"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>

<div id="modal_psk_edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-width="40%" data-keyboard="false">
	<?php echo form_open_multipart('Sekretariat/simpan_psk', [
        'class' => 'form-horizontal',
        'role' => 'form',
        'id' => 'edit_psk'
    ]) ?>
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="ResRes2()"></button>
			<span class="caption-subject text-primary bold uppercase " style="font-size:15px;">Form Ubah Data SK</span>
		</div>
		<div class="modal-body">
			<div class="form-body">
				<div class="row">
				<br>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-circle"></i>
													</span>
													<input class="form-control" name="no_skp" type="text" placeholder="0-9 / A-Z" autocomplete="off">
													<input style="display:none;" class="form-control" name="id_skp" placeholder="id" autocomplete="off">
													<label for="form_control_1">Nomor SK <span class="required" aria-required="true"> * </span></label>
													
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-circle"></i>
												</span>
												<select name="tipe_sk" class="form-control">
													<option value="">Pilih</option>
													<option value="Penilik">Penilik</option>
													<!--option value="TPT">TPT</option-->
													<option value="TPA">TPA</option>
												</select>	
													<label for="form_control_1">Jenis SK <span class="required" aria-required="true"> * </span></label>
												</div>
											</div>
											
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span>
													<input class="form-control datepicker" type="text" name="tgl_skp" data-date-format="yyyy-mm-dd" autocomplete="off" placeholder="2000/12/31" onkeydown="return false" >
													<label for="form_control_1">Tanggal Penerbitan <span class="required" aria-required="true"> * </span></label>
													
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span>
													<input class="form-control yearpicker" type="text" name="expired_skp" data-date-format="yyyy-mm-dd" autocomplete="off" placeholder="2002" onkeydown="return false" >
													<label for="form_control_1">Masa / Tahun Berlaku <span class="required" aria-required="true"> * </span></label>
													
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-circle"></i>
												</span>
												<input type="file" class="form-control" name="berkas" accept="application/pdf">
												<label for="form_control_1">Lampiran SK <span class="required" aria-required="true"> * </span></label>
											</div>
											</div>
										</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn red" onClick="ResRes2()"><i
					class="fa fa-sign-out"></i> Batal</button>
			<button type="submit" class="btn green"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>

<div id="personil-skPenilik" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static"
	data-keyboard="false" data-width="760px">
	<div class="modal-content">
		
		<div class="modal-body">
        <?php
            $this->load->view('personil_psk');
        ?>
		</div>
		
	</div>
</div>

<script>
	
	$(document).ready(function () {

		$( ".datepicker" ).datepicker({
			autoclose: true, 
			todayHighlight: true
		});
		
		$(".yearpicker").datepicker({
			format: "yyyy",
			maxViewMode: "years",
			minViewMode: "years",
			todayHighlight: true,
			autoclose: true
		});

		$(".btable").DataTable({
			'columnDefs': [{
				'targets': [0, 2, 3, 4, 5, 6],
				/* column index */
				'orderable': false,
				/* true or false */
			}],
			"pageLength": 100,
			"language": {
				"aria": {
					"sortAscending": ": activate to sort column ascending",
					"sortDescending": ": activate to sort column descending"
				},

				"emptyTable": "Data Belum Tersedia",
				"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ jumlah data",
				"infoEmpty": "Data Tidak Ditemukan",
				"infoFiltered": "",
				"lengthMenu": "Tampilkan _MENU_ Data",
				"search": "Cari:",
				"zeroRecords": "Data Tidak Ditemukan",
				"oPaginate": {
					"sNext": 'Selanjutnya',
					"sLast": 'Terakhir',
					"sFirst": 'Pertama',
					"sPrevious": 'Sebelumnya'
				}
			},
		});

		$("#tambah_psk").validate({
			// Specify the validation rules
			rules: {
				no_skp: "required",
				tgl_skp: "required",
				expired_skp: "required",
				tipe_sk: "required",
				berkas: "required",
			},
			highlight: function (element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			unhighlight: function (element) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			},
			errorClass: 'help-block',

			// Specify the validation error messages
			messages: {
				no_skp: '',//"Masukan Nomor SK",
				tgl_skp: '',//"Masukan Tanggal Penerbitan",
				expired_skp: '',//"Masukan Masa Berlaku",
				tipe_sk: '',//"Tentukan Jenis SK",
				berkas: '',
			},
			submitHandler: function (form) {
				form.submit();
			}
		});
		
		$("#edit_psk").validate({
			// Specify the validation rules
			rules: {
				no_skp: "required",
				tgl_skp: "required",
				expired_skp: "required",
				tipe_sk: "required",
				//berkas: "required",
			},
			highlight: function (element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			unhighlight: function (element) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			},
			errorClass: 'help-block',

			// Specify the validation error messages
			messages: {
				no_skp: '',//"Masukan Nomor SK",
				tgl_skp: '',//"Masukan Tanggal Penerbitan",
				expired_skp: '',//"Masukan Masa Berlaku",
				tipe_sk: '',//"Tentukan Jenis SK",
				//berkas: '',
			},
			submitHandler: function (form) {
				form.submit();
			}
		});


	});


	function UbahPSK(id) {
		$.ajax({
			type: "GET",
			url: "<?php echo base_url('Sekretariat/ubah_psk/') ?>",
			dataType: "JSON",
			data: {
				id: id
			},
			success: function (data) {
				$.each(data, function () {
					$('#modal_psk_edit').modal('show');
					$('[name="id_skp"]').val(data.id_sk);
					$('[name="no_skp"]').val(data.no_sk);
					$('[name="tipe_sk"]').val(data.tipe_sk);
					$('[name="tgl_skp"]').val(data.tgl_sk);
					$('[name="expired_skp"]').val(data.expired_sk);
				});
			}
		});
		return false;
	};


	function get_PSK(id) {
		url = "<?php echo base_url() . index_page() ?>public/uploads/pupr/sk/psk/" + id;
		swin = window.open(url, 'win',
			'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}

	function ResRes2() {
		document.getElementById("tambah_psk").reset();
		document.getElementById("edit_psk").reset();
	};

</script>
