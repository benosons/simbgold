<style>
 .inf-content{
    border:1px solid #DDDDDD;
    -webkit-border-radius:10px;
    -moz-border-radius:10px;
    border-radius:10px;
    
}
</style>
<div class="panel-body margin-top-20 inf-content">
    <div class="row">
        <div class="col-md-3">
			
			<img src="<?= base_url() ?>file\LogoKabKota\pu_logo.png" alt="logo" class="img-responsive" style="margin: 15px auto 0; width:80%;">
			
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
							<td><strong>Nama Kementrian</strong></td>
							<td class="text-primary">
								<strong>
									<?=(isset($profile_dinas->p_nama_dinas) ? $profile_dinas->p_nama_dinas : '-');?>   
								</strong>							
							</td>
                   	 	</tr>
						<tr>    
							<td><strong>Alamat Kementrian</strong></td>
							<td class="text-primary">
								<?=(isset($profile_dinas->p_alamat) ? $profile_dinas->p_alamat : '-');?>    
							</td>
						</tr>
						<tr>        
							<td><strong>Nomor Telepon</strong></td>
							<td class="text-primary">
								<?=(isset($profile_dinas->p_tlp) ? $profile_dinas->p_tlp : '-');?>
							</td>
						</tr>
						<tr>        
							<td><strong>Alamat E-mail </strong></td>
							<td class="text-primary">
								<?=(isset($profile_dinas->p_email) ? $profile_dinas->p_email : '-');?>
							</td>
						</tr>
						<tr>        
							<td style="width:25%"><strong>Nama Mentri</strong></td>
							<td class="text-primary">
							<?=(isset($profile_dinas->kepala_dinas) ? $profile_dinas->kepala_dinas : '-');?>
							</td>
						</tr>
						<tr>        
							<td><strong>NIP Mentri</strong></td>
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
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption caption-md">
					<i class="icon-bar-chart theme-font hide"></i>
					<span class="caption-subject text-primary bold uppercase">List Data Akun Sekreatariat</span>
				</div>
				<div class="actions">
					<? if(trim($role) == 3){?>
					
					<?}else{?>
						<!--a href="#" data-toggle="modal" data-target="#responsivedinas" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah </a-->
					<?}?>	
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-scrollable">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th style="width:4%"><center>#</center></th>
								<th >User Name/E-Mail</th>
								<th >NIP</th>
								<th >Nama Lengkap</th>
								<th style="width:10%">Status</th>
								<!--th style="width:4%"><center>Aksi</center></th-->
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
									} else {
										$status ="Tidak Aktif";
									} ?>
									<tr>
										<td align="center"><?php echo $no++; ?></td>
										<td><?php echo $result->username; ?></td>
										<td><?php echo $result->nip; ?></td>
										<td><?php echo $result->nama_lengkap; ?></td>
										
										<td><?php echo $status; ?></td>
										<!--td align="center">
											<a href="<?php echo site_url('Sekretariat/remove_sub_akun/' . $result->id); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Akun"><span class="glyphicon glyphicon-trash"></span></a>
										</td-->
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
<div class="row margin-top-20">
	
</div> 

<div id="profildinas" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-width="50%" data-backdrop="static" data-keyboard="false">
	<form action="<?php echo site_url('Sekretariat/saveDataSekte'); ?>" class="form-horizontal" role="form" method="post" id="from_data_sekte">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>	
				<span class="caption-subject text-primary bold uppercase">Profil Sekreatariat SIMBG (PUPR)</span>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 ">
						<div class="form-group">
							<label class="control-label" style="font-weight:bold;">Nama Kementrian</label>
							<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($profile_dinas->id) ? $profile_dinas->id : ''))?>" name="id" placeholder="id" autocomplete="off">
							<input type="text" class="form-control" value="<?php echo set_value('p_nama_dinas', (isset($profile_dinas->p_nama_dinas) ? $profile_dinas->p_nama_dinas : ''))?>" name="p_nama_dinas" placeholder="Nama Dinas" autocomplete="off">
						</div>
						<div class="form-group">
							<label class="control-label" style="font-weight:bold;">Alamat Kementrian</label>
							<textarea class="form-control" rows="2" name="p_alamat" placeholder="Alamat Dinas"><?php echo set_value('p_alamat', (isset($profile_dinas->p_alamat) ? $profile_dinas->p_alamat : ''))?></textarea>
						</div>
						<div class="form-group">
							<label class="control-label" style="font-weight:bold;">Nomor Telepon</label>
							<input type="text" class="form-control" value="<?php echo set_value('p_tlp', (isset($profile_dinas->p_tlp) ? $profile_dinas->p_tlp : ''))?>" name="p_tlp" placeholder="Nomor Telepon Dinas" autocomplete="off">
						</div>
						<div class="form-group">
							<label class="control-label" style="font-weight:bold;">Alamat Email</label>
							<input type="text" class="form-control" value="<?php echo set_value('p_email', (isset($profile_dinas->p_email) ? $profile_dinas->p_email : ''))?>" name="p_email" placeholder="Email Dinas" autocomplete="off">
						</div>
						<div class="form-group">
							<label class="control-label" style="font-weight:bold;">Nama Mentri</label>
							<input type="text" class="form-control" value="<?php echo set_value('kepala_dinas', (isset($profile_dinas->kepala_dinas) ? $profile_dinas->kepala_dinas : ''))?>" name="kepala_dinas" placeholder="Nama Kepala Dinas" autocomplete="off">
						</div>
						<div class="form-group">
							<label class="control-label" style="font-weight:bold;">NIP Mentri</label>
							<input type="text" class="form-control nip" value="<?php echo set_value('nip_kepala_dinas', (isset($profile_dinas->nip_kepala_dinas) ? $profile_dinas->nip_kepala_dinas : ''))?>" name="nip_kepala_dinas" placeholder="NIP Kepala Dinas" autocomplete="off">
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
					<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" style="margin-bottom:0px;" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
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
					<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" style="margin-bottom:0px;" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
				</div>
			</div>
		</div>
		<br>
		<center><button type="button" data-dismiss="modal" class="btn green">Ok</button></center>
	</div>
</div>
	<?php if ($this->session->flashdata('message') != ''){?>
		<?php if ($this->session->flashdata('status') != 'danger'){?>
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
	
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
<script> 

	$(document).ready(function () {
		
		$('.nip').mask('00000000 000000 0 000');
		//$('.ktp').mask('0000000000000000');
		//$('.nohp').mask('0000000000000');
		
	});	
	// Setup form validation on the #register-form element
	$("#from_data_sekte").validate({
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
			p_nama_dinas: "Masukan Nama Kementrian",
			p_alamat: "Masukan Alamat Kementrian",
			kepala_dinas: "Masukan Nama Mentri",
			nip_kepala_dinas : {
				required: "Wajib diisi",
			},
			p_tlp : {
				required: "Masukan Nomor Telepon",
				minlength: "Nomor Telepon minimal 6 karakter",
				number: "Telepon harus berupa angka",
			},
			p_email : "Masukan Alamat E-Mail",
	    },
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
</script>