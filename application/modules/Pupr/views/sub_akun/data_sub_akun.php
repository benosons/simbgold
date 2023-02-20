
								<div class="portlet light margin-top-20">
									<div class="portlet-title tabbable-line">
										<div class="caption caption-md">
											<i class="icon-globe theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">List Data Akun <?= $htable; ?></span>
										</div>
										
									</div>
									<div class="portlet-body">
										<div>
										<?php
											echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.
												  $this->session->flashdata('message').'<button class="close" data-close="alert">'.'</button>'.'</div>' : '';
										?>
										</div>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#responsivedinas">Tambah <i class="fa fa-plus"></i></button>
										<div class="table-scrollable">
											<table class="table table-bordered table-hover">
												<thead>
													<tr class="warning">
														<th style="width:5%"><center>#</center></th>
														<th >Id Pengguna</th>
														<th >NIP</th>
														<th >Nama Lengkap</th>
														<th style="width:10%">Status</th>
														<th style="width:5%"><center>Aksi</center></th>
													</tr>
												</thead>
												<tbody>
													<?php
													if ($result->num_rows() > 0) {
														$no = 1;
														foreach ($result->result() as $result) {
															if($result->status == null){
																$status ="Belum Aktif";
															}else if($result->status == 1){
																$status ="Aktif";
															}else {
																$status ="Tidak Aktif";
															}
															?>
															<tr>
																<td align="center"><?php echo $no++; ?></td>
																<td><?php echo $result->username; ?></td>
																<td><?php echo $result->nip; ?></td>
																<td><?php echo $result->nama_lengkap; ?></td>
																<td><?php echo $status; ?></td>
																<td align="center"><a href="<?php echo site_url('pupr/remove_sub_akun/' . $result->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>
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

<!-- /.modal -->
<div id="responsivedinas" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	
		<form action="<?php echo site_url('pupr/create_sub_akun'); ?>" class="form-horizontal" role="form" method="post" id="sub_pupr">
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
										<input class="form-control" type="email" name="email" placeholder="Alamat Email Petugas" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Nama</label>
									<div class="col-md-9">
										<input class="form-control" type="text" name="nama" placeholder="Nama Petugas" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Fungsi</label>
									<div class="col-md-9">
										<input class="form-control" type="text" name="jabatan" placeholder="Jabatan" value="<?= $htable; ?>" autocomplete="off" readonly>
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

<script>
	   
	 // Setup form validation on the #register-form element
	$("#sub_pupr").validate({
		
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