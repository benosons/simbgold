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
            <br>
			<center>
				<a data-toggle="modal" data-target="#profilAk" style="margin: 0 auto;" class="btn btn-danger btn-sm"><i class="fa fa-edit"></i> Ubah </a>
			</center>
        </div>
        <div class="col-md-9">
            <br>
            <div class="table-responsive">
            	<table class="table table-user-information">
               		<tbody>
                    	<tr>        
							<td><strong>Nama Asosiasi Profesi</strong></td>
							<td class="text-primary"><strong><?=(isset($profile_ak->nm_asosiasi) ? $profile_ak->nm_asosiasi : '-');?></strong></td>
                   	 	</tr>
						<tr>    
							<td><strong>Alamat Asosiasi Profesi</strong></td>
							<td class="text-primary"><?=(isset($profile_ak->alamat) ? $profile_ak->alamat : '-');?> </td>
						</tr>
						<tr>        
							<td><strong>No. Telepon</strong></td>
							<td class="text-primary"><?=(isset($profile_ak->no_tlp) ? $profile_ak->no_tlp : '-');?></td>
						</tr>
						<tr>        
							<td><strong>E-mail Asosiasi Profesi</strong></td>
							<td class="text-primary"><?=(isset($profile_ak->email) ? $profile_ak->email : '-');?></td>
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
                        <span class="caption-subject text-primary bold uppercase">List Data Akun Asosiasi Provinsi</span>
                    </div>
                    <div class="actions">
                        <?php if(trim($role) == 11){ ?>

                        <?php } else { ?>
                            <a href="#" data-toggle="modal" data-target="#responsivedinas" class="btn btn-danger"><i class="fa fa-plus"></i>Tambah Akun Asosiasi</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width:4%"><center>#</center></th>
                                    <th >Email Penanggung Jawab</th>
                                    <th style="width:16%">Provinsi</th>
                                    <th >Nama Lengkap</th>
                                    <th style="width:10%">Status</th>
                                    <!--<th style="width:4%"><center>Aksi</center></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows() > 0) {
                                    $no = 1;
                                    //$role=$this->session->userdata('loc_role_id');
                                    foreach ($result->result() as $result) {
                                        if($result->status == null){
                                            $status ="Belum Aktif";
                                        }else if($result->status == 1){
                                            $status ="Aktif";
                                        }else {
                                            $status ="Tidak Aktif";
                                        } ?>
                                        <tr>
                                            <td align="center"><?php echo $no++; ?></td>
                                            <td><?php echo $result->username; ?></td>
                                            <td><?php echo $result->nama_provinsi; ?></td>
                                            <td><?php echo $result->nama_lengkap; ?></td>
                                            <td><?php echo $status; ?></td>						
                                            
                                        </tr>
                                    <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>			
                </div>
            </div>
        </div>
    </div>

<!-- /.modal -->
<div id="responsivedinas" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<form action="<?php echo site_url('Tpa/create_sub_akun'); ?>" class="form-horizontal" role="form" method="post" id="sub_pupr">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<span class="caption-subject text-primary bold uppercase">Tambah Akun Asosiasi Profesi</span>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 ">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label" style="text-align:left;font-weight:bold;">Email</label>
								<div class="col-md-9"><input class="form-control" type="email" name="email" placeholder="Alamat Email" autocomplete="off"></div>
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
									<input class="form-control" type="text" name="jabatan" placeholder="Jabatan" value="Asosiasi Provinsi" readonly>
								</div>
							</div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" style="text-align:left;font-weight:bold;">Provinsi</label>
                                <div class="col-md-9">
                                    <select name="id_provinsi" id="id_provinsi" class="form-control select" data-placeholder="Select..." onchange="getkabkota(this.value)">
                                        <option value="">-- Pilih Provinsi --</option>
                                        <?php
                                        if ($daftar_provinsi->num_rows() > 0) {
                                            foreach ($daftar_provinsi->result() as $key) {
                                                if ($key->id_provinsi == $DataPersonil->id_provinsi) {
                                                    $plhrole = "selected";
                                                } else {
                                                    $plhrole = "";
                                                }
                                                echo '<option value="' . $key->id_provinsi . '" ' . $plhrole . '>' . $key->nama_provinsi . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
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

<div id="profilAk" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-width="50%" data-backdrop="static" data-keyboard="false">
		<form action="<?php echo site_url('Tpa/saveDataAsosiasi'); ?>" class="form-horizontal" role="form" method="post" id="from_data_dinas">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<span class="caption-subject text-primary bold uppercase">Profil Asosiasi Profesi</span>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-group">
								<label class="control-label" style="font-weight:bold;">Nama Asosiasi Profesi</label>
								<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($profile_ak->id) ? $profile_ak->id : ''))?>" name="id" placeholder="id" autocomplete="off">
								<input type="text" class="form-control" value="<?php echo set_value('nm_asosiasi', (isset($profile_ak->nm_asosiasi) ? $profile_ak->nm_asosiasi : ''))?>" name="nm_asosiasi" placeholder="Nama Asosiasi Profesi" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="control-label" style="font-weight:bold;">Alamat Asosiasi Profesi</label>
								<textarea class="form-control" rows="2" name="alamat" placeholder="Alamat Dinas"><?php echo set_value('alamat', (isset($profile_ak->alamat) ? $profile_ak->alamat : ''))?></textarea>
							</div>
							<div class="form-group">
								<label class="control-label" style="font-weight:bold;">No. Telepon Asosiasi Profesi</label>
								<input type="text" class="form-control" value="<?php echo set_value('no_tlp', (isset($profile_ak->no_tlp) ? $profile_ak->no_tlp : ''))?>" name="no_tlp" placeholder="Nomor Telepon " autocomplete="off">
							</div>
							<div class="form-group">
								<label class="control-label" style="font-weight:bold;">E-Mail Asosiasi Profesi</label>
								<input type="text" class="form-control" value="<?php echo set_value('email', (isset($profile_ak->email) ? $profile_ak->email : ''))?>" name="email" placeholder="Email" autocomplete="off">
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
					<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" style="margin-bottom:0px;" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';?>
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
<?php if ($this->session->flashdata('message') != '') { ?>
		<?php if ($this->session->flashdata('status') != 'danger'){ ?>
			<script>
				$('#notifBerhasil').modal('show');
			</script>
		<?php } else { ?>
			<script>
				$('#notif').modal('show');
			</script>	
		<?php } ?>
		
	<?php } else { ?>
			
	<?php } ?>
<script>
	 // Setup form validation on the #register-form element
	$("#sub_pupr").validate({
		
	    // Specify the validation rules
	   rules: {
			nama : "required",
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
			nama: "Masukan Nama Petugas",
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
	// Setup form validation on the #register-form element
	$("#from_data_dinas").validate({
	    // Specify the validation rules
	   rules: {
			p_nama_dinas : "required",
			kepala_dinas: "required",
			p_alamat : "required",
			
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
</script>