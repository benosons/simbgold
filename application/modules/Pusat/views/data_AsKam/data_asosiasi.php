<div class="row margin-top-20">
				<div class="col-md-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject text-primary bold uppercase">List Data Asosiasi</span>
							</div>
							<div class="actions">
								<a href="#" data-toggle="modal" data-target="#responAS" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah </a>
							</div>
						</div>
						<div class="portlet-body">
							
							
											<table class="table table-bordered btable" style="min-height:350px;">
												<thead>
													<tr>
														<th style="width:4%"><center>#</center></th>
														<th >Nama Asosiasi</th>
														<th >Alamat</th>
														<!--th >Fungsi</th-->
														<th style="width:16%">No. Telepon</th>
														<th style="width:4%"><center>Ubah</center></th>
														<th style="width:4%"><center>Hapus</center></th>
													</tr>
												</thead>
												<tbody>
													<?php if ($dat_as->num_rows() > 0) {
														$no = 1;
														foreach ($dat_as->result() as $r) { ?>
													<tr >
														<td align="center"><?php echo $no++; ?></td>
														<td><?php echo $r->nm_asosiasi; ?></td>
														<td><?php echo $r->alamat; ?></td>
														<td><?php echo $r->no_tlp; ?></td>
														<td align="center">
															<a onClick="UbahAs('<?php echo $r->id; ?>')"
																class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="modal"
																data-target="#responAS"><span class="glyphicon glyphicon-user"></span>
															</a>
														</td>
														<td align="center">
															<a data-href="<?php echo site_url('Pusat/hapus_As/' . $r->id); ?>"
																class="btn btn-danger btn-sm" data-confirm="Anda yakin ingin menghapus data ini ?"
																title="Hapus Data"><span class="glyphicon glyphicon-trash"></span>
															</a>
														</td>
														
													</tr>
													<?php }
													} ?>
												</tbody>
													
												
											</table>
							
							
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
				
			</div> 

<div id="responAS" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-width="600px" data-keyboard="false">
	<?php echo form_open_multipart('Pusat/simpan_As', [
        'class' => 'form-horizontal',
        'role' => 'form',
        'id' => 'tambah_As'
    ]) ?>
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="Rese()"></button>
			<span class="caption-subject text-primary bold uppercase " style="font-size:15px;">Form Data Asosiasi</span>
		</div>
		<div class="modal-body">
			<div class="form-body">
				<div class="row">
				<br>
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-circle"></i>
													</span>
													<input class="form-control" name="nama_as" type="text" placeholder="Nama Asosiasi" autocomplete="off">
													<input style="display:none;" class="form-control" name="id_as" placeholder="id_as" autocomplete="off">
													<label for="form_control_1">Nama Asosiasi <span class="required" aria-required="true"> * </span></label>
													
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-circle"></i>
													</span>
													<!--input class="form-control" name="alamat_as" type="text" rows="1" placeholder="Alamat Asosiasi" autocomplete="off"-->
													<textarea class="form-control" rows="3" name="alamat_as" placeholder="Alamat Asosiasi"></textarea>
													<label for="form_control_1">Alamat Asosiasi <span class="required" aria-required="true"> * </span></label>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-circle"></i>
													</span>
													<input class="form-control phone_us" name="notel" type="text" placeholder="Nomor Telepon" autocomplete="off">
													<label for="form_control_1">Nomor Telepon <span class="required" aria-required="true"> * </span></label>
												</div>
											</div>
										</div>
										
										
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn red" onClick="Rese()"><i
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
	$("#tambah_As").validate({
		
	    // Specify the validation rules
	   rules: {
			nama_as : "required",
			alamat_as : "required",
			notel : "required",
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
			nama_as: "",
			notel: "",
			alamat_as: "",
			
	    },
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	
	function Rese() {
		document.getElementById("tambah_As").reset();
	};
	
	function UbahAs(id) {
		$.ajax({
			type: "GET",
			url: "<?php echo base_url('Pusat/ubah_As/') ?>",
			dataType: "JSON",
			data: {
				id: id
			},
			success: function (data) {
				$.each(data, function () {
					$('#responAS').modal('show');
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
				'targets': [2, 3, 4, 5],
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

		$('.phone_us').mask('000000000000');

	});
 

</script>