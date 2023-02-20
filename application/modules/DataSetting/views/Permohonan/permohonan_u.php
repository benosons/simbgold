
<form action="<?php echo site_url('referensi/saveDataPermohonan'); ?>" class="form-horizontal" role="form" method="post" id="frm_edit_permohonan">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Form Edit Nama Permohonan</h4>
		</div>
		<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Permohonan</label>
									<div class="col-md-9">
										<input type="hidden" class="form-control" value="<?php echo $row->id_jenis_permohonan;?>" name="id" placeholder="id" autocomplete="off">
										<input type="text" class="form-control" value="<?php echo $row->nama_permohonan;?>" name="nama_permohonan" placeholder="Nama Permohonan" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Bangunan Gedung/IMB</label>
								<div class="col-md-6">
									<select class="form-control" name="id_jenis_bg" id="id_jenis_bg">
										<option value="">--Pilih--</option>
										<option value="1" <?php if($row->id_jenis_bg == '1') echo "selected";?>>Mendirikan Bangunan Gedung Baru</option>
										<option value="2" <?php if($row->id_jenis_bg == '2') echo "selected";?>>Bangunan Gedung Existing Belum Ber-IMB</option>
										<option value="3" <?php if($row->id_jenis_bg == '3') echo "selected";?>>Bangunan Gedung Perubahan</option>
										<option value="4" <?php if($row->id_jenis_bg == '4') echo "selected";?>>Bangunan Gedung Kolektif</option>
										<option value="5" <?php if($row->id_jenis_bg == '5') echo "selected";?>>Bangunan Gedung Prasarana</option>
										<option value="6" <?php if($row->id_jenis_bg == '6') echo "selected";?>>Bangunan Gedung IMB Bertahap</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Kompleksitas Bangunan Gedung</label>
								<div class="col-md-6">
									<select class="form-control" name="id_klasifikasi_bg" id="id_klasifikasi_bg">
										<option value="">--Pilih--</option>
										<option value="1" <?php if($row->id_klasifikasi_bg == '1') echo "selected";?>>Sederhana</option>
										<option value="2" <?php if($row->id_klasifikasi_bg == '2') echo "selected";?>>Tidak Sederhana</option>
										<option value="3" <?php if($row->id_klasifikasi_bg == '3') echo "selected";?>>Khusus</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Pemanfaatan Bangunan Gedung</label>
								<div class="col-md-6">
									<select class="form-control" name="id_pemanfaatan_bg" id="id_pemanfaatan_bg">
										<option value="">--Pilih--</option>
										<option value="1" <?php if($row->id_pemanfaatan_bg == '1') echo "selected";?>>Untuk Kepentingan Umum</option>
										<option value="2" <?php if($row->id_pemanfaatan_bg == '2') echo "selected";?>>Bukan Untuk Kepentingan Umum</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Dokumen Rencana Teknis</label>
								<div class="col-md-6">
									<select class="form-control" name="id_dok_tek" id="id_dok_tek">
										<option value="">--Pilih--</option>
										<option value="1" <?php if($row->id_dok_tek == '1') echo "selected";?>>Dibuat oleh Penyedia Jasa Perencana Konstruksi</option>
										<option value="2" <?php if($row->id_dok_tek == '2') echo "selected";?>>Menggunakan Desain Prototipe</option>
										<option value="3" <?php if($row->id_dok_tek == '3') echo "selected";?>>Desain Sendiri oleh Pemohon</option>
									</select>
								</div>
							</div>
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Total Lama Proses</label>
									<div class="col-md-2">
										<input type="text" class="form-control" name="lama_proses" placeholder="Total Hari" autocomplete="off" value="<?php echo $row->lama_proses;?>">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

		<div class="modal-footer">
			<button type="button" onclick="batal()" class="btn default">Batal</button>
			<button type="submit" class="btn green">Simpan</button>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(function () {
	 // Setup form validation on the #register-form element
	$("#frm_edit_permohonan").validate({
	    // Specify the validation rules
	    rules: {
	        nama_permohonan: "required",
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
	        nama_permohonan: "Masukan Nama Permohonan",
	        username: "Masukan Username",
	    },

	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
});
</script>
