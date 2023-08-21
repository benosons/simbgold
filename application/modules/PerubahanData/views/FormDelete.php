<div id="SK" class="tab-pane ">
	<div id="accordion_SK" class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion_SK"><b>Hapus Data Permohonan PBG/SLF</b></a></h2>
			</div>
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" style="margin-bottom:0px;" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
			<div id="" class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-md-12"><b>Masukkan Nomor Registrasi PBG/SLF</b><span class="required">* </span></label>
						<div class="col-md-8">
							<input type="text" pattern="[a-zA-Z0-9'-'\s]*" required class="form-control" id="imb" name="imb" placeholder="PBG-012345 / SLF-567890" />
						</div>
						<div class="col-md-4">
							<input type='button' onClick="Registrasi()" title="Cari Data" value="Cari Data" class="btn green" name="btnIMB" id="btnIMB" />
						</div>
					</div>
					<div id="No_Registrasi" style="display: none;">
						<div class="form-group">
							<label class="control-label col-md-12"></label>
							<div class="col-md-12"><br>
								<table id="table_permohonan" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th width="4%">#</th>
											<th width="18%">No. Registrasi</th>
											<th width="20%">Nama Pemohon/Pemilik</th>
											<th width="20%">Jenis Permohonan</th>
											<th width="35%">Alamat Bangunan Gedung</th>
											<th width="8%">Aksi</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="ModalHapus" class="modal fade" tabindex="-1" aria-hidden="true" data-width="30%" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<form action="<?php echo site_url('PerubahanData/Delete'); ?>" class="form-horizontal" role="form" method="post" id="frm_perubahan" enctype="multipart/form-data">
			<input type="hidden" id='csrf' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<input type="hidden" name="id" id="id_bgn" value="">
			<div class="portlet-body form">
				<div class="form-body">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
								<b>Form Penghapusan Data</b>
								<p>&nbsp;</p>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-3">Keterangan<span class="required">*</span></label>
									<div class="col-md-9">
										<textarea name="keterangan" class="form-control" rows="3"></textarea>
									</div>
								</div>
								<!--<div class="form-group">
									<label class="control-label col-md-3">Upload<span class="required">*</span></label>
									<div class="col-md-9">
										<input type="file" name="upload">
									</div>
								</div>-->
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
				<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(`Yakin Hapus Data ini?`)"><i class="fa fa-trash-o"></i> Hapus</button>
			</div>
		</form>
	</div>
</div>

<script language="javascript" type="text/javascript">
	$(function() {
		// Setup form validation on the #register-form element
		$("#frm_perubahan").validate({
			// Specify the validation rules
			rules: {
				keterangan: "required",
				//upload: "required",
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
				upload: "Upload",
				keterangan: "Alasan Penghapusan Permohonan",
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	});

	function Registrasi() {
		var no_registrasi = document.getElementById("imb").value;
		if (no_registrasi == "") {
			alert("Silahkan Mengisi Nomor Registrasi PBG/SLF Dengan Benar");
			location.reload();
		} else {
			$.ajax({
				type: "get",
				url: "<?php echo base_url(); ?>PerubahanData/Cari/" + no_registrasi + "/1",
				data: $('form.form-horizontal').serialize(),
				success: function(response) {
					if (response == "") {
						alert("Nomor Registrasi Tidak Ditemukan");
						document.getElementById('No_Registrasi').style.display = "none";
					} else {
						$('#table_permohonan tbody').html(response);
						document.getElementById('No_Registrasi').style.display = "block";
					}
				},
				error: function(error) {
					alert('Nomor Registrasi Tidak Ditemukan');
					location.reload();
				}
			});
		}
	}
	//Konfirmasi Hapus

	function ModalHapus(id) {
		$('#id_bgn').val(id);
		$('#ModalHapus').modal('show');
	}
	$('.item_hapus').on('click', function() {
		alert($(this).attr('data-id'));
		// get data from button edit
		const id = $(this).data('id');
		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('PerubahanData/popupFormDelete/') ?>/" + id,
			type: "GET",
			data: {
				id: id
			},
			success: function(data) {
				$('#ModalHapus').html(data);
				$('#ModalHapus').modal('show'); // show bootstrap modal when complete loaded
			},

		});
	});

	$('#btn_hapus').on('click', function() {
		var kode = $('#textkode').val();
		$.ajax({
			type: "get",
			url: "<?php echo base_url('PerubahanData/Delete') ?>",
			dataType: "JSON",
			data: {
				kode: kode
			},
			success: function(data) {
				$('#ModalHapus').modal('hide');
				toastr.success('Permohonan Berhasil Terhapus !', '', {
					positionClass: "toast-bottom-right",
					timeOut: 3000
				});
			}
		});
		return false;
	});
</script>