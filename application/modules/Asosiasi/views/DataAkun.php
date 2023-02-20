<div class="portlet light margin-top-20">
	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject font-blue-madison bold uppercase">List Data Akun <?= $htable; ?></span>
		</div>
	</div>
	<div class="portlet-body">
		<div>
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.
				$this->session->flashdata('message').'<button class="close" data-close="alert">'.'</button>'.'</div>' : ''; ?>
		</div>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#responsivAsosiasi">Tambah <i class="fa fa-plus"></i></button>
			<div class="table-scrollable">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th style="width:5%"><center>#</center></th>
							<th >Akun Pengguna</th>
							<th >Cabang Wilayah</th>
							<th >E-mail</th>
							<th style="width:10%">Status</th>
							<th style="width:5%"><center>Aksi</center></th>
						</tr>
					</thead>
					<tbody>
						<?php if ($result->num_rows() > 0) {
							$no = 1;
							foreach ($result->result() as $result) {
								if($result->status == null){
									$status ="Belum Aktif";
								}else if($result->status == 1){
									$status ="Aktif";
								}else {
									$status ="Tidak Aktif";
								}?>
								<tr>
									<td align="center"><?php echo $no++; ?></td>
									<td><?php echo $result->username; ?></td>
									<td><?php echo $result->nip; ?></td>
									<td><?php echo $result->nama_lengkap; ?></td>
									<td><?php echo $status; ?></td>
									<td align="center"><a href="<?php echo site_url('Asosiasi/remove_sub_akun/' . $result->id); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Akun"><span class="glyphicon glyphicon-trash"></span></a></td>
								</tr>
							<?php }
						} ?>
					</tbody>
				</table>
			</div>	
		</div>
	</div>
</div>
<!-- /.modal -->
<div id="responsivAsosiasi" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<form action="<?php echo site_url('Asosiasi/create_sub_akun'); ?>" class="form-horizontal" role="form" method="post" id="sub_ptsp">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Form Tambah Sub Akun</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 ">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Email</label>
								<div class="col-md-9">
									<input class="form-control" type="email" name="email" placeholder="Alamat Email" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Nama</label>
								<div class="col-md-9">
									<input class="form-control" type="text" name="nama" placeholder="Nama" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Pengguna</label>
								<div class="col-md-9">
									<input class="form-control" type="text" name="jabatan" placeholder="Jabatan" value="<?= $Chtable; ?>" autocomplete="off" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Provinsi</label>
								<div class="col-md-7">
									<select name="nama_provinsi" id="nama_provinsi" class="form-control select2" data-placeholder="Select..." onchange="getkabkota(this.value)">
										<option value="">-- Pilih Provinsi --</option>
										<?php if ($Provinsi->num_rows() > 0) {
											foreach ($Provinsi->result() as $key) {
												if ($key->id_provinsi == $DataBangunan->id_prov_bgn) {
													$plhrole = "selected";
												} else {
													$plhrole = "";
												}
												echo '<option value="' . $key->id_provinsi . '" ' . $plhrole . '>' . $key->nama_provinsi . '</option>';
											}
							  			} ?>
									</select>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn red">Batal</button>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</form>
</div>
<script>
	 // Setup form validation on the #register-form element
	$("#sub_ptsp").validate({
		
	    // Specify the validation rules
	   rules: {
			nama : "required",
			email: "required",
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
			nama: "Masukan Nama Petugas",
			email : "Masukan Alamat Email Petugas",
	    },
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
 

</script>