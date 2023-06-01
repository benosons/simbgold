<div class="row margin-top-20">
	<div class="col-md-12">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption caption-md">
					<i class="icon-bar-chart theme-font hide"></i><span class="caption-subject text-primary bold uppercase">Data Kadis Teknis</span>
				</div>
				<div class="actions">
					<a href="#" data-toggle="modal" data-target="#responKAM" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah </a>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-bordered btable" style="min-height:350px;">
					<thead>
						<tr>
							<th style="width:4%"><center>#</center></th>
							<th >Nama & No. Induk Pegawai</th>
							<th >Email & No. Handphone</th>
							<th >Kabupaten / Kota</th>
							<th >Nama Dinas</th>
							<th style="width:6%">Status</th>
							<th style="width:4%"><center>Aksi</center></th>
						</tr>
					</thead>
					<tbody>
						<?php if ($user_result->num_rows() > 0) {
							$no = 1;
							foreach ($user_result->result() as $key) {
								if ($key->status == '1') {
									$class = "label label-sm label-success";
									$status = "Aktif";
								} else {
									$class = "label label-sm label-warning";
									$status = "Non Aktif";
								} ?>
								<tr>
									<td align="center"><?php echo $no++; ?></td>
									<td><?php echo $key->nama_lengkap; ?> <br></b></td>
									<td><?php echo $key->email; ?> <br><i class="fa fa-phone-square"></i>  <b><?php echo $key->no_hp; ?></b></td>
									<td><p style="text-transform:capitalize;"><?php echo $key->nama_kabkota; ?></p></td>
									<td><p style="text-transform:capitalize;"><?php echo $key->p_nama_dinas; ?><br><i class="fa fa-phone-square"></i>  <b><?php echo $key->p_tlp; ?></p></td>
									
									<td align="center" ><span class="<?php echo $class; ?>"><?php echo $status; ?></span></td>

									<td align="center">
										<a href="<?php echo site_url('Pusat/ResetPass/' . $key->id); ?>" class="btn btn-success btn-sm" title="Ubah Data Personil" data-toggle="modal" data-target="#static"><span class="glyphicon glyphicon-edit"></span></a>
									</td>
								</tr>
							<?php }
						} ?>
					</tbody>
				</table>				
			</div>
		</div>
	</div>
</div>
<div id="static" class="modal fade bs-modal-lg" data-width="40%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-content">
    <div class="modal-body">
      
    </div>
    </div>
    <div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn blue" onClick="ResRes2()"><i class="fa fa-sign-out"></i> Tutup</button>
    </div>
  </div>
</div> 

<div id="responKAM" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-width="700px" data-keyboard="false">
	<?php echo form_open_multipart('Pusat/simpan_pupr', [
        'class' => 'form-horizontal',
        'role' => 'form',
        'id' => 'tambah_pupr'
    ]) ?>
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="Rese2()"></button>
			<span class="caption-subject text-primary bold uppercase " style="font-size:15px;">Form Data Kadis Teknis</span>
		</div>
		<div class="modal-body">
			<div class="form-body">
				<div class="row">
				
										<br>
										<div class="col-md-12">
											<div class="form-group form-md-line-input has-success">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-circle"></i>
													</span>
													<select name="nama_kabkota" id="nama_kabkota" class="form-control select2me" for="nama_kabkota">
														<option value="" selected>Silahkan Pilih ...</option>
													</select>
													<label for="form_control_1">Kadis Teknis Kabupaten / Kota<span class="required" aria-required="true"> * </span></label>
												</div>
											</div>
										</div>
										<div class="col-md-12"><br>
											<div class="form-group form-md-line-input has-success">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-circle"></i>
													</span>
													<input class="form-control" name="nama_ktp" type="text" placeholder="Nama Sesuai KTP" autocomplete="off">
													<input style="display:none;" class="form-control" name="id_kadis" placeholder="id_kadis" autocomplete="off">
													<label for="form_control_1">Nama Lengkap <span class="required" aria-required="true"> * </span></label>
												</div>
											</div>
										</div>
										
										<div class="col-md-5"><br>
											<div class="form-group form-md-line-input has-success">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-circle"></i>
													</span>
													<input class="form-control ktp" name="noktp" type="text" placeholder="Nomor KTP" autocomplete="off">
													<label for="form_control_1">Nomor KTP <span class="required" aria-required="true"> * </span></label>
												</div>
											</div>
										</div>
										<div class="col-md-7"><br>
											<div class="form-group form-md-line-input has-success">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-circle"></i>
													</span>
													<input class="form-control nip" name="nipnya" type="text" placeholder="Nomor Induk Pegawai" autocomplete="off">
													<label for="form_control_1">NIP <span class="required" aria-required="true"> * </span></label>
												</div>
											</div>
										</div>
										<div class="col-md-5"><br>
											<div class="form-group form-md-line-input has-success">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-phone-square"></i>
													</span>
													<input class="form-control nohp" name="no_hp" placeholder="Nomor Handphone Aktif" autocomplete="off">
													<label for="form_control_1">Nomor Handphone <span class="required" aria-required="true"> * </span></label>
												</div>
											</div>
										</div>
										
										<div class="col-md-7"><br>
											<div class="form-group form-md-line-input has-success">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-envelope"></i>
													</span>
													<input class="form-control" name="email" type="email" placeholder="Alamat Email Aktif" autocomplete="off">
													<label for="form_control_1">Alamat Email <span class="required" aria-required="true"> * </span></label>
												</div>
											</div>
										</div>
										
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn red" onClick="Rese2()"><i
					class="fa fa-sign-out"></i> Batal</button>
			<button type="submit" class="btn green"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>
<div id="notif" class="modal fade" tabindex="-1" aria-hidden="true" data-width="25%" data-backdrop="static"
	data-keyboard="false" style="background-color:#f2dede">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 ">
				<div class="form-body">
					<!--h4 class="form-title" align="center"><b>informasi</b></h4-->
					<?php
						echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" style="margin-bottom:0px;" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';
					?>
				</div>
			</div>
		</div><br>
		<center><button type="button" data-dismiss="modal" data-toggle="modal" class="btn red">Coba Lagi</button></center>
	</div>
</div>

<div id="notifBerhasil" class="modal fade" tabindex="-1" aria-hidden="true" data-width="25%" data-backdrop="static"
	data-keyboard="false" style="background-color:#dff0d8">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 ">
				<div class="form-body">
					<!--h4 class="form-title" align="center"><b>informasi</b></h4-->
					<?php
						echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" style="margin-bottom:0px;" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';
					?>
				</div>
			</div>
		</div><br>
		<center><button type="button" data-dismiss="modal" class="btn green">Ok</button></center>
	</div>
</div>
<? if ($this->session->flashdata('message') != ''){?>
		<? if ($this->session->flashdata('status') != 'danger'){?>
			<script>
				$('#notifBerhasil').modal('show');
			</script>
		<?}else{?>
			<script>
				$('#notif').modal('show');
			</script>	
		<?}?>
		
	<?}else{?>
			
	<?}?>
	
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>

<script>
	   
	 // Setup form validation on the #register-form element
	$("#tambah_pupr").validate({
		
	    // Specify the validation rules
	   rules: {
			nama_kabkota: {
                        required: true,
                    },
			nama_ktp : "required",
			noktp: {
				required: true,
				minlength: 16,
			},
			nipnya: {
				required: true,
				minlength: 18,
			},
			no_hp: {
				required: true,
				minlength: 10,
			},
			email: {
				required: true,
				email: true,
				remote: {
					url: base_url + "Front/cek_email_aktif",
					type: "post"
				}
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
			nama_ktp: "Masukan Nama Kepala Dinas",
			nama_kabkota: "Pilih Salah Satu",
			noktp: {
				required: "Masukan Nomor KTP",
				minlength: "Nomor KTP tidak sesuai",
			},
			nipnya: {
				required: "Masukan Nomor Induk Pegawai",
				minlength: "NIP tidak sesuai",
			},
			no_hp: {
				required: "Wajib diisi",
				minlength: "Nomor Handphone tidak sesuai",
			},
			email: {
				required: "Wajib diisi",
				email: "Harap masukkan Format email dengan benar",
				remote: "Email sudah digunakan"
			},
			
	    },
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	
	function Rese2() {
		document.getElementById("tambah_pupr").reset();
	};
	
	function UbahKampus(id) {
		$.ajax({
			type: "GET",
			url: "<?php echo base_url('Pusat/ubah_kampus/') ?>",
			dataType: "JSON",
			data: {
				id: id
			},
			success: function (data) {
				$.each(data, function () {
					$('#responKAM').modal('show');
					$('[name="id_as"]').val(data.id);
					$('[name="nama_as"]').val(data.nm_asosiasi);
					$('[name="alamat_as"]').val(data.alamat);
					$('[name="notel"]').val(data.no_tlp);
				});
			}
		});
		return false;
	};
	
	
	
	$(document).ready(function () {

		$(".btable").DataTable({
			'columnDefs': [{
				'targets': [1, 2, 5],
				/* column index */
				'orderable': false,
				/* true or false */
			}],
			"pageLength": 1000,
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

		$('.nip').mask('00000000 000000 0 000');
		$('.ktp').mask('0000000000000000');
		$('.nohp').mask('0000000000000');
		
	});
	
	jQuery.post(base_url + 'Pusat/getNamaKabKota', function(data) {
			var nama_kabkota = '<option value="" selected></option>';
			jQuery.each(data, function(key, value) {
				nama_kabkota += '<option value="' + value.id_kabkot + '"> ' + value.nama_kabkota + ' </option>';
			});
			jQuery('#nama_kabkota').html(nama_kabkota);
		}, 'json');


</script>