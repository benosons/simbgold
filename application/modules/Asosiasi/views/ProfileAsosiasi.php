<div class="portlet light margin-top-20">
	<div class="portlet-title tabbable-line">
		<div class="caption caption-md">
			<i class="icon-globe theme-font hide"></i>
			<span class="caption-subject font-blue-madison bold uppercase">Profil Asosiasi</span>
		</div>	
	</div>
	<div class="portlet-body">
		<div>
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.
			$this->session->flashdata('message').'<button class="close" data-close="alert">'.'</button>'.'</div>' : ''; ?>
		</div>
		<div class="tab-content">
			<div class="tab-pane active" id="dadi">
				<form action="<?php echo site_url('Asosiasi/saveDataAkpro'); ?>" class="form-horizontal" role="form" method="post" id="FromDataAso">
					<div class="form-group">
						<label class="control-label">Nama Dinas</label>
						<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($profile_dinas->id) ? $profile_dinas->id : ''))?>" name="id" placeholder="id" autocomplete="off">
						<input type="text" class="form-control" value="<?php echo set_value('p_nama_dinas', (isset($profile_dinas->p_nama_dinas) ? $profile_dinas->p_nama_dinas : ''))?>" name="p_nama_dinas" placeholder="Nama Dinas" autocomplete="off">
					</div>
					<div class="form-group">
						<label class="control-label">Alamat Dinas</label>
						<textarea class="form-control" rows="3" name="p_alamat" placeholder="Alamat Dinas"><?php echo set_value('p_alamat', (isset($profile_dinas->p_alamat) ? $profile_dinas->p_alamat : ''))?></textarea>
					</div>
					<div class="form-group">
						<label class="control-label">No Telephone Dinas</label>
						<input type="text" class="form-control" value="<?php echo set_value('p_tlp', (isset($profile_dinas->p_tlp) ? $profile_dinas->p_tlp : ''))?>" name="p_tlp" placeholder="No Telephone Dinas" autocomplete="off">
					</div>
					<div class="form-group">
						<label class="control-label">Email Dinas</label>
						<input type="text" class="form-control" value="<?php echo set_value('p_email', (isset($profile_dinas->p_email) ? $profile_dinas->p_email : ''))?>" name="p_email" placeholder="Email Dinas" autocomplete="off">
					</div>
					<div class="form-group">
						<label class="control-label">Nama Kepala Dinas</label>
						<input type="text" class="form-control" value="<?php echo set_value('kepala_dinas', (isset($profile_dinas->kepala_dinas) ? $profile_dinas->kepala_dinas : ''))?>" name="kepala_dinas" placeholder="Nama Kepala Dinas" autocomplete="off">
					</div>
					<div class="form-group">
						<label class="control-label">NIP Kepala Dinas</label>
						<input type="text" class="form-control" value="<?php echo set_value('nip_kepala_dinas', (isset($profile_dinas->nip_kepala_dinas) ? $profile_dinas->nip_kepala_dinas : ''))?>" name="nip_kepala_dinas" placeholder="NIP Kepala Dinas" autocomplete="off">
					</div>
					<div class="form-group">
						<button type="submit" class="btn green">Simpan</button>
					</div>
				</form>
			</div>		
		</div>
	</div>
</div>						
<script>
	$("#FromDataAso").validate({
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
	    messages: {
			p_nama_dinas: "Masukan Nama Dinas",
			p_alamat: "Masukan Alamat Lengkap",
			kepala_dinas: "Masukan Nama Kepala Dinas",
			nip_kepala_dinas : {
				required: "Wajib diisi",
			},
			p_tlp : {
				required: "Masukan Nomor Telephone",
				minlength: "Nomor Telephone minimal 6 karakter",
				number: "Telephone harus berupa angka",
			},
			p_email : "Masukan Alamat E-Mail Anda",
	    },
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
</script>