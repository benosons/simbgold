<form action="<?php echo site_url('slf/SimpanStatusSLF'); ?>" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
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
							<input class="form-control" value="<?php echo $row->email;?>" id="em_il" name="em_il" style="display: none;">
							<?php
								//$ss = $row->status_syarat;
								$sp = $row->status_progress;
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
							<label class="col-md-3 control-label">Data Bangunan Gedung</label>
							<div class="col-md-9">
								<input class="form-control" value="<?php echo $row->luas_bg;?> meter persegi, dengan tinggi <?php echo $row->tinggi_bg;?> meter dan berjumlah <?php echo $row->lantai_bg;?> lantai." readonly>
							</div>
						</div>
					</div>	
				</div>	
			</div>
			<br>
			<div class="portlet-body">
				<div class="tabbable-custom nav-justified">
					<ul class="nav nav-tabs nav-justified">
						<li class="active">
							<a href="#tab_2_1" data-toggle="tab">Data Tanah</a>
						</li>
						<li>
							<a href="#tab_2_2" data-toggle="tab">Persyaratan Administrasi</a>
						</li>
						<li>
							<a href="#tab_2_3" data-toggle="tab">Persyaratan Teknis</a>
						</li>
						<li>
							<a href="#tab_2_4" data-toggle="tab">Status</a>
						</li>	
					</ul>
				</div>
				<div class="tab-content">
				<div class="tab-pane fade active in" id="tab_2_1">
					<table id="sample_1" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Jenis Dokumen</th>
								<th>No. Dokumen</th>
								<th>Tgl. Dokumen</th>
								<th>LT (m<sup>2</sup>)</th>
								<th>Atas Nama</th>
								<th>Berkas</th>
								<th>Izin Pemanfaatan</th>
								<th>Verifikasi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if($tanah->num_rows() > 0){
								$no = 1;
								$ipk=$this->uri->segment('3');
								foreach ($tanah->result() as $slf){?>
									<tr>
										<td align="center"><?php echo $no++;?></td>
										<td align="center"><?php 
											if($slf->id_dokumen == 1){
												$jenisdokumen = "Sertifikat";
											}elseif($slf->id_dokumen == 2){
												$jenisdokumen = "Akta Jual Beli";
											}elseif($slf->id_dokumen == 3){
												$jenisdokumen = "Girik";
											}elseif($slf->id_dokumen == 4){
												$jenisdokumen = "Petuk";
											}elseif($slf->id_dokumen == 5){
												$jenisdokumen = "Bukti lain-lain";
											}
											echo $jenisdokumen;?>
										</td>
										<td align="center"><?php echo $slf->no_dok;?></td>
										<td align="center"><?php echo $slf->tanggal_dok;?></td>
										<td align="center"><?php echo $slf->luas_tanah;?></td>
										<td align="center"><?php echo $slf->atas_nama_dok;?></td>
										<td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/slf/'.$slf->id_permohonan_slf.'/data_tanah/'.$slf->dir_file);?>')" class="btn default btn-xs blue-stripe" >Lihat</a></td>
											<?php if($slf->dir_file_phat != ""){?>
										<td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/slf/'.$slf->id_permohonan_slf.'/data_tanah/'.$slf->dir_file_phat);?>')" class="btn default btn-xs blue-stripe" >Lihat</a></td>
											<?}else{?>
										<td></td>
										<?}?>
										<?
										$cekik = "";
										if($slf->verifikasi == '1')
										{
											$cekik = "checked";
										}
										?>
										
										<td align="center"><input type="checkbox" name="verifikasi_tanah_<?php echo $slf->id_tanah;?>" value="<?php echo $slf->id_tanah;?>" id="verifikasi_tanah_<?php echo $slf->id_tanah;?>" onchange="check_tanah_slf('verifikasi_tanah_<?php echo $slf->id_tanah;?>','<?php echo $slf->id_tanah;?>')" <?=$cekik?>></td>
										
									</tr>
								<?}?>
							<?}?>
						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="tab_2_2">
					<?php 
						include "FormSyaratAdministrasi.php"; 
					?>
				</div>
				<div class="tab-pane fade" id="tab_2_3">
					<?php 
						include "FormSyaratTeknis.php"; 
					?>
				</div>
				<div class="tab-pane fade" id="tab_2_4">
					
						<?php if($sp >= '4'){?>
							<div class="col-md-12 ">
								<br>
								<div class="col-md-6 ">
									<input id="xstileng" name="xstileng" type="submit" value="Tidak Lengkap"  class="btn red btn-block">
								</div>
								<div class="col-md-6 ">
									<input id="xsleng" name="xsleng" type="submit" value="Lengkap"  class="btn blue btn-block"><br>
								</div>
							</div>
						<?}else{?>
							<div class="col-md-12 ">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Kelengkapan Persyaratan</label>
										<div class="col-md-9">
											<label class="radio-inline">
												<input type="radio" name="status_syarat" id="status_syarat" value="3">Lengkap
												<br>
												<input type="radio" name="status_syarat" id="status_syarat" value="1">Tidak Lengkap
											</label>
										</div>
									</div>
									<div class="form-group" type="hidden">
										<label class="col-md-3 control-label">No. Surat Pemberitahuan</label>
										<div class="col-md-9">
											<input class="form-control" name="no_surat_pemberitahuan" id="no_surat_pemberitahuan" placeholder="Nomor Surat">
										</div>
									</div>
									<div class="form-group" type="hidden">
										<label class="col-md-3 control-label">File Surat Pemberitahuan</label>
										<div class="col-md-9">
											<span class="btn grey-cascade fileinput-button">
													<input type="file" name="dir_file_pemberitahuan" id="dir_file_pemberitahuan" >
													<input type="text" name="filename_pemberitahuan" id="filename_pemberitahuan" style="display: none;" >
											</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Catatan</label>
										<div class="col-md-9">
											<textarea class="form-control" name="catatan" id="catatan" placeholder="Keterangan" ></textarea>
										</div>
									</div>
									<div class="form-group">
										<!--?php echo form_submit('savestatussyarat','Simpan','class="btn blue-hoki btn-block"');	?-->
										<input id="xstin" name="xstin" onClick="XtinSLF()" type="submit" value="Simpan" class="btn blue-hoki btn-block">
									</div>
								</div>
							</div>
						<?}?>
							<br>
							<table id="sample_1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
									  <th>No</th>
									  <th>Status</th>
									  <th>Nomor Surat</th>
									  <th>Tanggal Surat</th>
									  <th>Catatan</th>
									  <th>Berkas</th>
									</tr>
								</thead>
								<tbody>
				<?php
					if($datastatus->num_rows() > 0){
                	$no = 1;
					$ipk=$this->uri->segment('3');
                	foreach ($datastatus->result() as $slfstatus) {
	            ?>
	                <tr>
	                  <td align="center"><?php echo $no++;?></td>
					  <td align="center"><?php 
								if($slfstatus->id_kelengkapan_syarat == 3){
									$statusslf = "Lengkap";
								}else{
									$statusslf = "Tidak Lengkap";
								}
							echo $statusslf;?>
					  </td>
					  <td align="center"><?php echo $slfstatus->no_surat_pemberitahuan;?></td>
					  <td align="center"><?php echo $slfstatus->tgl_surat_pemberitahuan;?></td>
					  <td align="center"><?php echo $slfstatus->catatan;?></td>
					  
					  <td align="center">
					  <?php if($slfstatus->dir_file_surat_pemberitahuan != ""){?>
					  <a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/SLF/'.$ipk.'/pemberitahuan/'.$slfstatus->dir_file_surat_pemberitahuan);?>')" class="btn default btn-xs blue-stripe" >Lihat</a>
					  <?}else{?>
					  -
					  <?}?>
					  </td>
					  
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
	</div>
</form>		
<div class="modal-footer">
	<button type="button" onclick="return confirm('Yakin Ingin Keluar?')" data-dismiss="modal" class="btn red"> X Tutup</button>
</div>
<script type="text/javascript">
	$('#dir_file_pemberitahuan').change(function() {
    var filename_pemberitahuan = $(this).val();
    var lastIndex = filename_pemberitahuan.lastIndexOf("\\");
    if (lastIndex >= 0) {
        filename_pemberitahuan = filename_pemberitahuan.substring(lastIndex + 1);
    }
    $('#filename_pemberitahuan').val(filename_pemberitahuan);
	});

	function check_tanah_slf(key,id){ 	
	  if (document.getElementById(key).checked) {
		$.ajax({
			url  : '<?php echo base_url('slf/check_status_tanah/'.$this->uri->segment(3))?>/'+id+'/',
			type: 'POST',
			dataType: 'html',
			cache:false,
			success: function( response ) {
				$('div#detail_personal').html('');
				$('div#detail_personal').html(response);
			}
		});
	}else{
		$.ajax({
			url: '<?php echo base_url('slf/uncheck_status_tanah/'.$this->uri->segment(3))?>/'+id+'/',
			type: 'POST',
			dataType: 'html',
			cache:false,
			success: function( response ) {
				$('div#detail_personal').html('');
				$('div#detail_personal').html(response);
			}
		});
		}
	}
	
function popWin(x){
	url = x;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}
	
function check_status_slf(key,id,ss){
	if (document.getElementById(key).checked) {
		$.ajax({
			url  : '<?php echo base_url('slf/check_status/'.$this->uri->segment(3))?>/'+id+'/'+ss+'/',
			type: 'POST',
			dataType: 'html',
			cache:false,
			success: function( response ) {
				$('div#detail_personal').html('');
				$('div#detail_personal').html(response);
			}
		});
	}else{
		$.ajax({
			url: '<?php echo base_url('slf/uncheck_status/'.$this->uri->segment(3))?>/'+id+'/'+ss+'/',
			type: 'POST',
			dataType: 'html',
			cache:false,
			success: function( response ) {
				$('div#detail_personal').html('');
				$('div#detail_personal').html(response);
			}
		});
		}
}
	
	function batal(){
		location.reload();
	}
	
	function XtinSLF(){
	$("#savestatussyarat").validate({
	    // Specify the validation rules
	    rules: {
			status_syarat: "required",
	        no_surat_pemberitahuan: "required",
			//dir_file_pemberitahuan: "required",
			catatan: "required",
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
			status_syarat: "Tentukan Status Syarat",
	        no_surat_pemberitahuan: "Masukan Nomor Surat",
			//dir_file_pemberitahuan: "Masukan Surat",
			catatan: "Masukan Keterangan",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});	
		
	}
	
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
</script>