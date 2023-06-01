<div class="portlet box blue-hoki">
	<? if($DataRetribusi->id_cara_penetapan != ''){?>
		<div class="portlet-title">
			<div class="caption">
				Form Input Pembayaran Retribusi
			</div>
		</div>
		<div class="portlet-body">
			  
			<form action="<?php echo site_url('Konsultasi/saveBayarRetribusi'); ?>" class="form-horizontal" role="form" method="post" id="pss_rd" enctype="multipart/form-data">

				<div class="form-group">
					<label class="col-md-12 alert alert-info" align="center"><h3>Biaya Retribusi Sebesar
						<?php if (isset($DataRetribusi->harga_retribusi) && $DataRetribusi->harga_retribusi != '0')
							$besar_retribusi_convert = number_format($DataRetribusi->harga_retribusi,0,'','.');
						else
							$besar_retribusi_convert = number_format($DataRetribusi->harga_retribusi,0,'','.');
						?>
						Rp. <?php echo $besar_retribusi_convert?>,-</h3>
					</label>	
				</div>
				<?php
					echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : '';    
				?>
				<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($id) ? $id : '')) ?>" name="id" placeholder="id" autocomplete="off">
				<div class="form-group">
					<label class="control-label col-md-3">Nomor SSRD<span class="required">* </span></label>
					<div class="col-md-4">
						<div class="input-icon right"><i class="fa"></i>
							<input  style="display: none;" class="form-control" value="<?php echo set_value('id_permohonan', (isset($id_permohonan) ? $id_permohonan : ''))?>" name="id_permohonan" placeholder="Id Permohonan">
							<input  style="display: none;" class="form-control" value="<?php echo set_value('id_ssrd', (isset($DataRetribusi->id_ssrd) ? $DataRetribusi->id_ssrd : ''))?>" name="id_ssrd" placeholder="Id SSRD">
							<input type="text" class="form-control" value="SSRD<?php echo set_value('no_skrd', (isset($DataRetribusi->nomor_registrasi) ? $DataRetribusi->nomor_registrasi : ''))?>" name="no_ssrd" placeholder="Nomor SKRD" readonly>
						</div>
					</div>
				</div>
				<div class="form-group" style="display: none;">
					<label class="control-label col-md-3">Tanggal SKRD<span class="required">* </span></label>
					<div class="col-md-4">
								<?php 	if (isset($DataRetribusi->tgl_skrd) && $DataRetribusi->tgl_skrd != '')
																$tgl = $DataRetribusi->tgl_skrd;
															else
																$tgl = '';
								?>
									<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" disabled>
										<input type="text" class="form-control" readonly name="tgl_skrd" value='<?=$tgl?>'>
										<span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3">Tanggal Pembayaran<span class="required">* </span></label>
								<div class="col-md-4">
								<?php 	if (isset($DataRetribusi->tgl_ssrd) && $DataRetribusi->tgl_ssrd != '')
																$tgl2 = $DataRetribusi->tgl_skrd;
															else
																$tgl2 = '';
								?>
									<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" >
										<input type="text" class="form-control" name="tanggal_ssrd" id="tanggal_ssrd" value='<?=$tgl2?>'>
										<span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3">Bukti Pembayaran<span class="required">* </span></label>
								
								<? if (isset($DataRetribusi->file_ssrd) != '' or $DataRetribusi->file_ssrd != null){ ?>
								<div class="col-md-4">
								<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/'.$id.'/SSRD/'.$DataRetribusi->file_ssrd);?>')" class="btn default btn-md blue-stripe" >Berkas Bukti Pembayaran</a>
								</div>				
								<?}else{?>
								<div class="col-md-4">
									<input style="display: none;" name="dir_file_s" id="dir_file_s" onchange='pcekuk()'>
									<input type="file" class="form-control" name="d_file_s" id="d_file_s" onchange='pcekuk()'>
								
								</div>
								<?}?>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3"></label>
								<div class="col-md-4">
									<button type="submit" class="btn green">Simpan</button>
								</div>
							</div>
								
						</form>
					</div>
			<?}else{?>
					<div class="portlet-title">
						<div class="caption">
							Nilai retribusi Belum Dihitung
						</div>
					</div>
			<?}?>
		</div>
<script>

$(function () {    
	 // Setup form validation on the #register-form element
	$("#pss_rd").validate({
	    // Specify the validation rules
	    rules: {
	        no_ssrd: "required",
			tanggal_ssrd: "required",
			d_file_s: "required",
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
	        no_ssrd: "Masukan Nomor Surat",
			tanggal_ssrd: "Masukan Tanggal Surat",
			d_file_s: "Wajib Melampirkan Bukti Pembayaran",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	});
	
function pcekuk(){
		
		$('#dir_file_s').val(d_file_s.value);
	}
	
</script>