<form action="<?php echo site_url('imb/SimpanStatus'); ?>" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 align="center" class="modal-title"><b>Data Pokok Permohonan <?php echo $row->nomor_registrasi;?></b></h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">										
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Nama Pemilik</label>
							<div class="col-md-9">													
								<input class="form-control" value="<?php echo $row->id_permohonan;?>" id="id_permohonan" name="id_permohonan" style="display: none;">
								<input class="form-control" value="<?php echo $row->email;?>" id="em_il" name="em_il" style="display: none;">
								<input class="form-control" value="<?php echo $row->nomor_registrasi;?>" id="noreg" name="noreg" style="display: none;">
								<?php
									$ss = $row->status_syarat;
								?>
								<input class="form-control" value="<?php echo $row->nama_pemohon;?>" placeholder="Nama Pemilik" autocomplete="off" readonly>
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
								<textarea class="form-control" placeholder="Alamat Pemilik" readonly><?php echo $row->alamat_pemohon;?></textarea>
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
								<input class="form-control" value="<?php echo $row->nama_permohonan;?>" readonly>
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
								<textarea class="form-control" readonly><?php echo $row->alamat_bg;?> Desa/Kel. <?php echo $row->kelurahan;?>, Kec. <?php echo $row->kecamatan;?>.</textarea>
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
								<input class="form-control" value="<?php echo $row->fungsi_bg;?> - <?php echo $row->jns_bangunan;?>"  readonly>
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
								<!--p class="form-control-static">
									<b><?php echo $row->luas_bg;?> m<sup>2</sup></b>, dengan <b>tinggi</b> bangunan <b><?php echo $row->tinggi_bg;?> meter</b> dan berjumlah <b><?php echo $row->lantai_bg;?> lantai</b>.
								</p-->
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
									<a href="#tabtot" data-toggle="tab">
									Data Pemilik</a>
								</li>
								<li>
									<a href="#tab_2_1" data-toggle="tab">
									Data Tanah </a>
								</li>
								<li>
									<a href="#tab_2_2" data-toggle="tab">
									Persyaratan Administrasi </a>
								</li>
								<li>
									<a href="#tab_2_3" data-toggle="tab">
									Persyaratan Teknis </a>
								</li>
								<li>
									<a href="#tab_2_4" data-toggle="tab">
									Status</a>
								</li>
							</ul>
							<div class="tab-content">
							<div class="tab-pane fade active in" id="tabtot">
								
									<?php 
										include "detailin.php"; 
									?>
								
							</div>
								<div class="tab-pane fade" id="tab_2_1">
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
					  <?php if($ss != 1){?>
					  <th>Verifikasi</th>
					  <?}?>
	                  
	                </tr>
                </thead>
                <tbody>

				<?php
					if($datatanah->num_rows() > 0){
                	$no = 1;
					$ipk=$this->uri->segment('3');
                	foreach ($datatanah->result() as $imb) {
	            ?>
	                <tr>
	                  <td align="center"><?php echo $no++;?></td>
					  <td align="center"><?php 
								if($imb->id_dokumen == 1){
									$jenisdokumen = "Sertifikat";
								}elseif($imb->id_dokumen == 2){
									$jenisdokumen = "Akta Jual Beli";
								}elseif($imb->id_dokumen == 3){
									$jenisdokumen = "Girik";
								}elseif($imb->id_dokumen == 4){
									$jenisdokumen = "Petuk";
								}elseif($imb->id_dokumen == 5){
									$jenisdokumen = "Bukti lain-lain";
								}
							echo $jenisdokumen;?>
					  </td>
					  <td align="center"><?php echo $imb->no_dok;?></td>
					  <td align="center"><?php echo $imb->tanggal_dok;?></td>
					  <td align="center"><?php echo $imb->luas_tanah;?></td>
					  <td align="center"><?php echo $imb->atas_nama_dok;?></td>
					  <td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/'.$ipk.'/data_tanah/'.$imb->dir_file);?>')" class="btn default btn-xs blue-stripe" >Lihat</a></td>
					  <?php if($imb->dir_file_phat != ""){?>
					  <td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/'.$ipk.'/data_tanah/'.$imb->dir_file_phat);?>')" class="btn default btn-xs blue-stripe" >Lihat</a></td>
					  <?}else{?>
					  <td></td>
					  <?}?>
					  <?
									$cekik = "";
									if($imb->status_verifikasi_tanah == '1')
									{
										$cekik = "checked";
									}
					  ?>
					  <?php if($row->status_syarat != 1){?>
					  <td align="center"><input type="checkbox" name="verifikasi_tanah_<?php echo $imb->id_permohonan_detail_tanah;?>" value="<?php echo $imb->id_permohonan_detail_tanah;?>" id="verifikasi_tanah_<?php echo $imb->id_permohonan_detail_tanah;?>" onchange="check_tanah('verifikasi_tanah_<?php echo $imb->id_permohonan_detail_tanah;?>','<?php echo $imb->id_permohonan_detail_tanah;?>')" <?=$cekik?>></td>
					  <?}?>
					</tr>
	                <?php			
	                		}
	                	}
	                ?>
				                
                </tbody>
            </table>
								</div>
								<div class="tab-pane fade" id="tab_2_2">
								
									<?php 
										include "form_detail_syarat.php"; 
									?>
								
								</div>
								<div class="tab-pane fade" id="tab_2_3">
								
									<?php 
										include "form_detail_syarat_teknis.php"; 
									?>
								
								</div>
								<div class="tab-pane fade" id="tab_2_4">
									
				<div class="col-md-12 ">
					
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Kelengkapan Persyaratan</label>
							<div class="col-md-9">
								<label class="radio-inline">
									<input type="radio" name="status_syarat" id="status_syarat" value="1">Lengkap
									<br>
									<input type="radio" name="status_syarat" id="status_syarat" value="2">Tidak Lengkap
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
							<button onClick="Xtin()" type="submit" class="btn blue-hoki btn-block"> <span class="glyphicon glyphicon-edit">Simpan</span></<button>
						</div>
					</div>
					
				</div>
				
				<br>
			<table id="sample_1" class="table table-bordered table-striped table-hover">
                <thead>
	                <tr>
	                  <th>No</th>
	                  <th>Status</th>
					  <th>Nomor Surat</th>
	                  <th>Tanggal Surat</th>
					  <th>Berkas Surat</th>
	                  <th>Aksi</th>
	                </tr>
                </thead>
                <tbody>

				<?php
					if($datastatus->num_rows() > 0){
                	$no = 1;
					$ipk=$this->uri->segment('3');
                	foreach ($datastatus->result() as $imbstatus) {
	            ?>
	                <tr>
	                  <td align="center"><?php echo $no++;?></td>
					  <td align="center"><?php 
								if($imbstatus->status_syarat == 1){
									$statusimb = "Lengkap";
								}else{
									$statusimb = "Tidak Lengkap";
								}
							echo $statusimb;?>
					  </td>
					  <td align="center"><?php echo $imbstatus->no_surat_pemberitahuan;?></td>
					  <td align="center"><?php echo $imbstatus->tgl_pemberitahuan;?></td>
					  <td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$ipk.'/pemberitahuan_persyaratan/'.$imbstatus->dir_file_pemberitahuan);?>')" class="btn default btn-xs blue-stripe" >Lihat</a></td>
					  <td align="center"><a href="#" class="btn btn-success btn-xs" title="Kirim Ulang Email Pemberitahuan" id="tombolver">
					  <span class="glyphicon glyphicon-envelope"></span></a>
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

	function check_tanah(key,id){ 	
	  if (document.getElementById(key).checked) {
		$.ajax({
			url  : '<?php echo base_url('imb/check_status_tanah/'.$this->uri->segment(3))?>/'+id+'/',
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
			url: '<?php echo base_url('imb/uncheck_status_tanah/'.$this->uri->segment(3))?>/'+id+'/',
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
	
	function check_status(key,id,ss){
	 if (document.getElementById(key).checked) {
		$.ajax({
			url  : '<?php echo base_url('imb/check_status/'.$this->uri->segment(3))?>/'+id+'/'+ss+'/',
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
			url: '<?php echo base_url('imb/uncheck_status/'.$this->uri->segment(3))?>/'+id+'/'+ss+'/',
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
	
	function Xtin(){
	$("#savestatussyarat").validate({
	    // Specify the validation rules
	    rules: {
			status_syarat: "required",
	        no_surat_pemberitahuan: "required",
			dir_file_pemberitahuan: "required",
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
			dir_file_pemberitahuan: "Masukan Surat",
			catatan: "Masukan Keterangan",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});	
		
		
	}

	
</script>