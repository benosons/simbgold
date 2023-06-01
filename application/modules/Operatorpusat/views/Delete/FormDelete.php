<div id="SK" class="tab-pane ">
	<div id="accordion_SK" class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion_SK"><b>Hapus Permohonan PBG/SLF</b></a></h2>
			</div>
			<div id="" class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-md-12"><b>Masukkan Nomor Registrasi PBG/SLF</b><span class="required">* </span></label>
						<div class="col-md-8">
							<input type="text" pattern="[a-zA-Z0-9'-'\s]*" required class="form-control" id="imb" name="imb" placeholder="PBG-012345 / SLF-567890" />
						</div>	
						<div class="col-md-4">
							<input type='button' onClick="Registrasi()" title="Cari Data" value="Cari Data" class="btn green" name="btnIMB" id="btnIMB"/>
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
		<form class="form-horizontal">
			<div class="modal-body">
				<input type="hidden" name="kode" id="textkode" value="">
				<b>Apakah Anda yakin menghapus Permohonan ini ?</b>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
				<button class="btn_hapus btn btn-danger btn-sm" id="btn_hapus"><i class="fa fa-trash-o"></i> Hapus</button>
			</div>
		</form>
	</div>
</div>
<script language="javascript" type="text/javascript">
	function Registrasi() {
		var no_registrasi = document.getElementById("imb").value;
		if(no_registrasi == ""){
			alert("Silahkan Mengisi Nomor Registrasi PBG/SLF Dengan Benar");
			location.reload();
		}else{
			$.ajax({
				type: "get",
				url:  "<?php echo base_url();?>Operatorpusat/Delete/"+no_registrasi,
				data: $('form.form-horizontal').serialize(),
				success: function(response) {
					if(response == ""){
						alert("Nomor Registrasi Tidak Ditemukan");
						document.getElementById('No_Registrasi').style.display="none";
					}else{
						$('#table_permohonan tbody').html(response);
						document.getElementById('No_Registrasi').style.display="block";	
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
	$('echo data').on('click', '.item_hapus', function() {
		var id = $(this).attr('data');
		$('#ModalHapus').modal('show');
		$('[name="kode"]').val(id);
	});
	$('#btn_hapus').on('click', function() {
		var kode = $('#textkode').val();
		$.ajax({
			type: "get",
			url: "<?php echo base_url('Operatorpusat/Pilih_Hapus') ?>",
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