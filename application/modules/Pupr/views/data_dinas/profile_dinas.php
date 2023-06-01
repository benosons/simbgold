<style>
 .inf-content{
    border:1px solid #DDDDDD;
    -webkit-border-radius:10px;
    -moz-border-radius:10px;
    border-radius:10px;
    
}
</style>
<div class="panel-body margin-top-10 inf-content">
    <div class="row">
        <div class="col-md-3">
			<?php if ($this->session->userdata('loc_logo')) {
				$logo = $this->session->userdata('loc_logo');
				if (isset($logo) && $logo != '') {
					$fileGbr = $logo;
				} else {
					$fileGbr = 'pupr.png';
				} ?>
				<img src="<?= base_url() ?>file\LogoKabKota\<?= $fileGbr ?>" alt="logo" class="img-responsive" style="margin: 0 auto; width:80%;">
			<?php } else { ?>
				<img src="<?= base_url() ?>assets\admin\layout3\images\logo.png" alt="logo" class="limg-responsive" style="margin: 0 auto;width: 80%;">
			<?php } ?>
			<br>
			<center>
				<a data-toggle="modal" data-target="#profildinas" style="margin: 0 auto;" class="btn btn-danger btn-sm"><i class="fa fa-edit"></i> Ubah </a>
			</center>
        </div>
        <div class="col-md-9">
            <br>
            <div class="table-responsive">
            	<table class="table table-user-information">
               		<tbody>
                    	<tr>        
							<td><strong>Nama Dinas</strong></td>
							<td class="text-primary">
								<strong>
									<?=(isset($profile_dinas->p_nama_dinas) ? $profile_dinas->p_nama_dinas : '-');?>   
								</strong>							
							</td>
                   	 	</tr>
						<tr>    
							<td><strong>Alamat Dinas</strong></td>
							<td class="text-primary">
								<?=(isset($profile_dinas->p_alamat) ? $profile_dinas->p_alamat : '-');?>    
							</td>
						</tr>
						<tr>        
							<td><strong>No. Telepon</strong></td>
							<td class="text-primary">
								<?=(isset($profile_dinas->p_tlp) ? $profile_dinas->p_tlp : '-');?>
							</td>
						</tr>
						<tr>        
							<td><strong>E-mail Dinas</strong></td>
							<td class="text-primary">
								<?=(isset($profile_dinas->p_email) ? $profile_dinas->p_email : '-');?>
							</td>
						</tr>
						<?php if($profile_dinas->status_pejabat =='1'){
							$jabatan = "Pelaksana Tugas (Plt)";
						} else if($profile_dinas->status_pejabat =='2') {
							$jabatan = "Pejabat Sementara (Pjs)";
						} else if ($profile_dinas->status_pejabat =='3') {
							$jabatan = "Pejabat Difinitif";
						} else {
							$jabatan = "Belum Ditentukan";
						}?>
						<tr> 
							<td style="width:25%"><strong>Status Jabatan</strong></td>
							<td class="text-primary">
							<?= $jabatan;?>
							</td>
						</tr>
						<tr>        
							<td style="width:25%"><strong>Nama Kepala Dinas</strong></td>
							<td class="text-primary">
							<?=(isset($profile_dinas->kepala_dinas) ? $profile_dinas->kepala_dinas : '-');?>
							</td>
						</tr>
						<tr>        
							<td><strong>NIP Kepala Dinas</strong></td>
							<td class="text-primary">
								<?=(isset($profile_dinas->nip_kepala_dinas) ? $profile_dinas->nip_kepala_dinas : '-');?>
							</td>
						</tr>                             
               	 	</tbody>
            	</table>
        	</div>
    	</div>
    </div>
</div>
<br>
<div class="row margin-top-20">
				<div class="col-md-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject text-primary bold uppercase">List Data Akun Pegawai</span>
							</div>
							<div class="actions">
								<? if(trim($role) == 11){?>
								<?}else{?>
								<a href="#" data-toggle="modal" data-target="#responsivedinas" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah </a>
								<?}?>
							</div>
						</div>
						<div class="portlet-body">
							
							<div class="table-scrollable">
											<table class="table table-bordered table-hover">
												<thead>
													<tr>
														<th style="width:4%"><center>#</center></th>
														<th >Email Pegawai</th>
														<th style="width:16%">Fungsi</th>
														<th >Nama Lengkap</th>
														<th style="width:10%">Status</th>
														<th style="width:10%"><center>Aksi</center></th>
													</tr>
												</thead>
												<tbody>
													<?php
													if ($result->num_rows() > 0) {
														$no = 1;
														//$role=$this->session->userdata('loc_role_id');
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
																<td><?php echo $result->jabatan_dinas; ?></td>
																<td><?php echo $result->nama_lengkap; ?></td>
																<td><?php echo $status; ?></td>
																
																<? if(trim($role) == 11){?>
																<td align="center">
																	-
																</td>
																<?}else{?>
																<td align="center">
																	<?php if($result->id =='29' || $result->id =='50'){?>
																	
																	<?php } else { ?>
																		<?php if($result->status == 1){?>

																		<?}else{?>
																			<a data-href="<?php echo site_url('Pupr/kirim_ulang/' . $result->id); ?>" class="btn btn-warning btn-xs" data-confirm="Kirim Ulang Email Aktivasi ?" title="Kirim Ulang"><span class="glyphicon glyphicon-envelope"></span></a>
																		<?}?>
																		<a data-href="<?php echo site_url('Pupr/remove_sub_akun/' . $result->id); ?>" class="btn btn-danger btn-xs" data-confirm="Anda yakin ingin menghapus data ini ?" title="Hapus Akun"><span class="glyphicon glyphicon-trash"></span></a>
																	<?php } ?>
																</td>


																</td>
					
																<?}?>
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
					<!-- END PORTLET-->
				</div>
				
			</div> 


<!-- /.modal -->
<div id="responsivedinas" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	
		<form action="<?php echo site_url('Pupr/create_sub_akun'); ?>" class="form-horizontal" role="form" method="post" id="sub_pupr">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<span class="caption-subject text-primary bold uppercase">Tambah Akun <?= $htable; ?></span>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">

							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label" style="text-align:left;font-weight:bold;">Email</label>
									<div class="col-md-9">
										<input class="form-control" type="email" name="email" placeholder="Alamat Email" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" style="text-align:left;font-weight:bold;">Nama</label>
									<div class="col-md-9">
										<input class="form-control" type="text" name="nama" placeholder="Masukan Nama Lengkap" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" style="text-align:left;font-weight:bold;">Fungsi</label>
									<div class="col-md-9">
										<input class="form-control" type="text" name="jabatan" placeholder="Jabatan" value="<?= $htable; ?>" readonly>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-danger">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</div>
		</form>
	
</div>

<div id="profildinas" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-width="50%" data-backdrop="static" data-keyboard="false">
	
		<form action="<?php echo site_url('Pupr/saveDataDinas'); ?>" class="form-horizontal" role="form" method="post" id="from_data_dinas">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					
					<span class="caption-subject text-primary bold uppercase">Profil Dinas</span>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-group">
								<label class="control-label" style="font-weight:bold;">Nama Dinas</label>
								<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($profile_dinas->id) ? $profile_dinas->id : ''))?>" name="id" placeholder="id" autocomplete="off">
								<input type="text" class="form-control" value="<?php echo set_value('p_nama_dinas', (isset($profile_dinas->p_nama_dinas) ? $profile_dinas->p_nama_dinas : ''))?>" name="p_nama_dinas" placeholder="Nama Dinas" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="control-label" style="font-weight:bold;">Alamat Dinas</label>
								<textarea class="form-control" rows="2" name="p_alamat" placeholder="Alamat Dinas"><?php echo set_value('p_alamat', (isset($profile_dinas->p_alamat) ? $profile_dinas->p_alamat : ''))?></textarea>
							</div>
							<div class="form-group">
								<label class="control-label" style="font-weight:bold;">No. Telepon Dinas</label>
								<input type="text" class="form-control" value="<?php echo set_value('p_tlp', (isset($profile_dinas->p_tlp) ? $profile_dinas->p_tlp : ''))?>" name="p_tlp" placeholder="Nomor Telepon Dinas" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="control-label" style="font-weight:bold;">E-Mail Dinas</label>
								<input type="text" class="form-control" value="<?php echo set_value('p_email', (isset($profile_dinas->p_email) ? $profile_dinas->p_email : ''))?>" name="p_email" placeholder="Email Dinas" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="control-label" style="font-weight:bold;">Status Pejabat</label>
								<div>
									<select class="form-control" name="status_pejabat" id="status_pejabat" required>
										<option value="">Pilih</option>
										<option value="1" <?php if ($profile_dinas->status_pejabat == '1') echo "selected"; ?>>Pelaksana Tugas (Plt)</option>
										<option value="2" <?php if ($profile_dinas->status_pejabat == '2') echo "selected"; ?>>Pejabat Sementara (Pjs)</option>
										<option value="3" <?php if ($profile_dinas->status_pejabat == '3') echo "selected"; ?>>Pejabat Difinitif</option>
										
									</select>	
								</div>
							</div>
							<div class="form-group">
								<label class="control-label" style="font-weight:bold;">Nama Kepala Dinas</label>
								<input type="text" class="form-control" value="<?php echo set_value('kepala_dinas', (isset($profile_dinas->kepala_dinas) ? $profile_dinas->kepala_dinas : ''))?>" name="kepala_dinas" placeholder="Nama Kepala Dinas" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="control-label" style="font-weight:bold;">NIP Kepala Dinas</label>
								<input type="text" class="form-control" value="<?php echo set_value('nip_kepala_dinas', (isset($profile_dinas->nip_kepala_dinas) ? $profile_dinas->nip_kepala_dinas : ''))?>" name="nip_kepala_dinas" placeholder="NIP Kepala Dinas" autocomplete="off">
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" data-dismiss="modal" class="btn btn-danger">Batal</button>
				</div>
			</div>
		</form>
	
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
		<center>
			<?php if(!$this->session->userdata('sku')) {?>
				
				<button type="button" data-dismiss="modal" class="btn green">Ok</button>
			<?php } else { ?>

				<button type="button" onclick="delsku()" data-dismiss="modal" class="btn green">Selesai</button>
				<a href="<?php echo site_url('Pupr/kirim_ulang'); ?>" type="button" class="btn blue">Kirim Ulang</a>

			<?php } ?>
		</center>
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
<script>
	   
	 // Setup form validation on the #register-form element
	 $("#sub_pupr").validate({
		
	    // Specify the validation rules
	   rules: {
			nama : "required",
			email: {
				required: true,
				email: true,
				/* remote: {
					url: base_url + "Front/cek_email_aktif",
					type: "post"
				} */
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
			nama: "Masukan Nama Petugas",
			email: {
				required: "Wajib diisi",
				email: "Harap masukkan Format email dengan benar",
				//remote: "Email sudah digunakan"
			},
	    },
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	
	// Setup form validation on the #register-form element
	$("#from_data_dinas").validate({
		
	    // Specify the validation rules
	   rules: {
			p_nama_dinas : "required",
			kepala_dinas: "required",
			p_alamat : "required",
			status_pejabat : "required",
			p_tlp: {
                    minlength: 6,
                    required: true,
					number: true
                }, 
			p_email: {
                    required: true,
                    email: true
                    }, 
			//no_ktp : "required",
			nip_kepala_dinas : {
                    //minlength: 6,
                    required: true,
					//number: true
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
			p_nama_dinas: "Masukan Nama Dinas",
			p_alamat: "Masukan Alamat Lengkap",
			kepala_dinas: "Masukan Nama Kepala Dinas",
			status_pejabat : "Pilih Status Pejabat",
			nip_kepala_dinas : {
				required: "Wajib diisi",
				//minlength: "Nomor Identitas minimal 6 karakter",
				//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				//number: "NIP harus berupa angka",
			},
			p_tlp : {
				required: "Masukan Nomor Telepon",
				minlength: "Nomor Telepon minimal 6 karakter",
				//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				number: "Telepon harus berupa angka",
			},
			p_email : "Masukan Alamat E-Mail Anda",
	    },
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
 
	function delsku(){
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('Pupr/delsku/')?>",
            success: function(){
				$('#notifBerhasil').modal('hide');
            }
         });
        return false;
    };
</script>