<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
	<div class="modal-header">
		
		<h4 align="center" class="modal-title"><b>Data Pokok Permohonan <?php echo $row->no_registrasi_slf;?></b></h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 ">										
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Nama Pemilik</label>
						<div class="col-md-9">													
							<input class="form-control" value="<?php echo $row->id_permohonan_slf;?>" id="id" name="id" style="display: none;">
							<input class="form-control" value="<?php echo $row->no_registrasi_slf;?>" id="noreg" name="noreg" style="display: none;">
							<?php
								//$ss = $row->status_syarat;
								$sp = $row->status;
							?>
							<input class="form-control" value="<?php echo $row->nama_pemilik;?>" placeholder="Nama Pemilik" autocomplete="off" readonly>
						</div>
					</div>
				</div>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 ">										
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Alamat Pemilik</label>
						<div class="col-md-9">													
							<textarea class="form-control" placeholder="Alamat Pemilik" readonly><?php echo $row->alamat_pemilik;?></textarea>
						</div>
					</div>
				</div>	
			</div>
		</div>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Jenis Permohonan</label>
							<div class="col-md-9">
								<?
									if($row->id_jenis_permohonan !='0' || $row->id_jenis_permohonan !=null){?>
										<input class="form-control" value="<?php echo $row->nama_permohonan;?>" readonly>
									<?}else{?>
										<input class="form-control" value="<?php echo " Jenis Permohonan Belum ditentukan";?>" readonly>	
									<?}
								?>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Lokasi Bangunan Gedung</label>
							<div class="col-md-9">													
								<textarea class="form-control" readonly><?php echo $row->alamat_bg;?>, Kec. <?php echo $row->nama_kecamatan;?>, <?php echo $row->nama_kabkota;?></textarea>
							</div>
						</div>
					</div>	
				</div>	
			</div>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Fungsi Bangunan Gedung</label>
							<div class="col-md-9">													
								
								<input class="form-control" value="<?php echo $row->fungsi_bg;?> - <?php echo $row->jns_bangunan;?>" readonly>
							</div>
						</div>
					</div>	
				</div>	
			</div>
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Luas Bangunan Gedung</label>
							<div class="col-md-9">
								<input class="form-control" value="<?php echo $row->luas_bg;?> meter persegi, dengan tinggi <?php echo $row->tinggi_bg;?> meter dan berjumlah <?php echo $row->lantai_bg;?> lantai." readonly>
							</div>
						</div>
					</div>	
				</div>	
			</div>
			<br>
			<?php
				echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : '';    
			?>
			<div class="portlet-body">
				<div class="tabbable-custom nav-justified">
					<ul class="nav nav-tabs nav-justified">
						<li class="active">
							<a href="#tab_2_1" data-toggle="tab">Dokumen Teknis</a>
						</li>
						<li>
							<a href="#tab_2_4" data-toggle="tab">Perubahan Data</a>
						</li>
						<?php if($row->status_progress == '13'){?>
						<li>
							<a href="#tab_2_3" data-toggle="tab">Hasil Verifikasi Lapangan</a>
						</li>
						<?}else{?>
						<li>
							<a href="#tab_2_2" data-toggle="tab">Pemeriksaan Kesesuaian</a>
						</li>
						<?}?>
					</ul>
				</div>
				<div class="tab-content">
				<div class="tab-pane fade active in" id="tab_2_1">
					<?php 
						include "data_teknis_form.php"; 
					?>
				</div>
				<div class="tab-pane fade" id="tab_2_4">
					<?php 
						include "PermohonanEditSLF2.php"; 
					?>
				</div>
				<div class="tab-pane fade" id="tab_2_2">
				<form action="<?php echo site_url('slf/submit_pemeriksaan/'); ?>" class="form-horizontal" role="form" method="post" id="saveTOT" name="saveTOT" enctype="multipart/form-data">
					
					<? $id_permohonan_slf = (isset($id_permohonan_slf) ? $id_permohonan_slf : '');?>
				<input size="50" name="totoid" value='<?php echo set_value('id_permohonan_slf', (isset($id_permohonan_slf) ? $id_permohonan_slf : ''))?>' id="totoid" style="display: none;" >
				<input size="50" name="totoid3"  value='<?php echo set_value('id_jenis_permohonan', (isset($id_jenis_permohonan) ? $id_jenis_permohonan : ''))?>' id="totoid3" style="display: none;" >
				<input size="50" name="totoid2" value='<?php echo set_value('id', (isset($id) ? $id : ''))?>' id="totoid2" style="display: none;">
				<input class="form-control" value="<?php echo $row->no_registrasi_slf;?>" id="noreg" name="noreg" style="display: none;">
				<input class="form-control" value="<?php echo $row->email;?>" id="em_il" name="em_il" style="display: none;">
					<div class="col-md-12 ">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Kesimpulan Hasil Pemeriksaan Kesesuaian<span class="required">*</span></label>
										<div class="col-md-9">
											<label class="radio-inline">
												<?php 	
												if (isset($id_hasil_pemeriksaan_kesesuaian)!=''){
												$id_hasil_pemeriksaan_kesesuaian = $id_hasil_pemeriksaan_kesesuaian;}else{
												$id_hasil_pemeriksaan_kesesuaian = isset($id_hasil_pemeriksaan_kesesuaian);}
												?>	
												<input type="radio" class="icheck" name="id_hasil_pemeriksaan_kesesuaian" value="1" id="id_hasil_pemeriksaan_kesesuaian" <?php if ($id_hasil_pemeriksaan_kesesuaian=='1'){echo 'checked';}?>> Ya
												<br>
												<input type="radio" class="icheck" name="id_hasil_pemeriksaan_kesesuaian" value="2" id="id_hasil_pemeriksaan_kesesuaian" <?php if ($id_hasil_pemeriksaan_kesesuaian=='2'){echo 'checked';}?>> Tidak
					
											</label>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-3 control-label">Apakah akan dilakukan verifikasi Lapangan<span class="required">*</span></label>
										<div class="col-md-9">
											<label class="radio-inline">
												<?php 	
												if (isset($id_konfirmasi_verlap)!=''){
												$id_konfirmasi_verlap = $id_konfirmasi_verlap;}else{
												$id_konfirmasi_verlap = isset($id_konfirmasi_verlap);}
												?>		
												<input type="radio" class="icheck" name="id_konfirmasi_verlap" value="1" id="id_konfirmasi_verlap" <?php if ($id_konfirmasi_verlap=='1'){echo 'checked';}?>> Ya
												<br>
												<input type="radio" class="icheck" name="id_konfirmasi_verlap" value="2" id="id_konfirmasi_verlap" <?php if ($id_konfirmasi_verlap=='2'){echo 'checked';}?>> Tidak
					
											</label>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-md-3 control-label">Catatan</label>
										<div class="col-md-9">
											<?php print form_textarea('catatan',set_value('catatan_krk',(isset($catatan)?$catatan:'')),'id="catatan" name="catatan" class="form-control" placeholder="Keterangan" style="height:70px;"')?>
										</div>
									</div>
									
									<div class="form-group">
										<input id="simpan" name="simpan" type="submit" value="Simpan" onClick="XRekom()" class="btn blue-hoki btn-block">
									</div>
								</div>
					</div>
				</form>	
				</div>
				<div class="tab-pane fade" id="tab_2_3">
					<form action="<?php echo site_url('slf/hasil_verlap/'); ?>" class="form-horizontal" role="form" method="post" id="saveverlap" name="saveverlap" enctype="multipart/form-data">
						<div class="col-md-12 ">
								<input class="form-control" value="<?php echo $row->id_permohonan_slf;?>" id="ids" name="ids" style="display: none;">
								<input class="form-control" value="<?php echo $row->no_registrasi_slf;?>" id="noreg" name="noreg" style="display: none;">
								<input class="form-control" value="<?php echo $row->email;?>" id="em_il" name="em_il" style="display: none;">
								<input class="form-control" value="" id="id_kolektif" name="id_kolektif" style="display: none;">
								<input name="totoid2" value='<?php echo set_value('id', (isset($id) ? $id : ''))?>' id="totoid2" style="display: none;">
							<br>
							<div class="col-md-6 ">
								<input id="xsleng" name="xsleng" type="submit" value="Sesuai"  class="btn green btn-block"><br>
							</div>
							<div class="col-md-6 ">
								<input id="xstileng" name="xstileng" type="button" value="Tidak Sesuai / Rekomtek"  class="btn red btn-block" onClick="GetGet()">
							</div>
						</div>
						<hr>
						<div id="rekom" name="rekom" style="display: none;">
						<div class="col-md-12"><br>
							<h4 align="center" class="modal-title"><b>Hasil Rekomdasi Teknis</b></h4><hr>
							<div class="form-group">
								<label class="col-md-3 control-label">Tanggal Verifikasi Lapangan<span class="required">*</span></label>
								<div class="col-md-9">
										<input name="tanggalverlap" placeholder="2000-12-31" class="form-control date-picker" data-date-format="yyyy-mm-dd" id="tanggalverlap" type="text" onblur="hitungUmur(this.value)" onKeyup="hitungUmur(this.value)">
							
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Unggah Berkas Rekomtek<span class="required">*</span></label>
								<div class="col-md-9">
										<input type="file" name="xekomtek" id="xekomtek" class="form-control btn grey-cascade fileinput-button" onchange="cotbacot()">
										<input type="text" name="filename_xekomtek" id="filename_xekomtek" class="form-control" style="display: none;" onchange="cotbacot()">
								</div>
							</div>
							<br>
							<input id="xsrekom" name="xsrekom" type="submit" value="simpan"  class="btn blue-hoki btn-block"><br>
						</div>
						</div>
					</form>
				</div>
			</div>
			</div>
	</div>
</div>
			</div>
	</div>	

<script type="text/javascript">

	$(function () {    
	 // Setup form validation on the #register-form element
	$("#savestatussyarat").validate({
	    // Specify the validation rules
	    rules: {
	        kesesuaian: "required",
	        //id_konfirmasi_verlap: "required",
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
	        kesesuaian: "Tentukan Hasilnya",
	        //id_konfirmasi_verlap1: "Tentukan Verifikasinya",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	});
	
	$(function () {    
	 // Setup form validation on the #register-form element
	$("#saveverlap").validate({
	    // Specify the validation rules
	    rules: {
	        tanggalverlap: "required",
	        xekomtek: "required",
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
	        tanggalverlap: "Masukan Tanggal Verifikasi Lapangan",
	        xekomtek: "Unggah Hasil Rekomdasi Teknis",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	});
	
	function GetPdfAdministrasiSLF(id,id_bg,f){
	//alert (f);
	url = "<?php echo base_url() . index_page() ?>file/SLF/"+id+"/"+"persyaratan/Administrasi"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
	}

	function GetPdfTeknisSLF(id,id_bg,f){
	//alert (id);
	url = "<?php echo base_url() . index_page() ?>file/SLF/"+id+"/"+"persyaratan/Teknis"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
	}
	
	function GetGet()
	{
		document.getElementById('rekom').style.display="block";
	}
	
	
	function cotbacot(){
		
		$('#filename_xekomtek').val(xekomtek.value);
		//$('#dir_file_x').val(d_file_x.value);
	}
	
	function XRekom(){
	$("#saveTOT").validate({
	    // Specify the validation rules
	    rules: {
			id_hasil_pemeriksaan_kesesuaian: "required",
	        id_konfirmasi_verlap: "required",
			//catatan: "required",
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
			id_hasil_pemeriksaan_kesesuaian: "Tentukan Hasilnya",
	        id_konfirmasi_verlap: "Tentukan Verifikasinya",
			//catatan: "Masukan Keterangan",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});	
	}
	
</script>