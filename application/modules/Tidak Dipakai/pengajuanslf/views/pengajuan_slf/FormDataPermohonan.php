<div class="form-body">
	<div class="tab-pane">
		<h4 class="form-section"><b>Data Permohonan SLF</b></h4>
			<div class="form-group">
			<input type="hidden" class="form-control" value="<?php echo $DataPermohonan->id_permohonan_slf;?>" name="id" placeholder="id" autocomplete="off">
			<input type="hidden" class="form-control" value="<?php echo $DataPermohonan->id_jenis_permohonan;?>" name="id" placeholder="id" autocomplete="off">
				<label class="control-label col-md-3">Jenis SLF:</label>
				<div class="col-md-4">
					<input type="text" class="form-control" readonly value="<?php echo $DataPermohonan->nama_pemilik;?>" name="nama_pemilik" placeholder="Nama Pemilik">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Jumlah Lantai:</label>
				<div class="col-md-4">
					<p class="form-control-static" data-display="email"></p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Jenis permohonan SLF:</label>
				<div class="col-md-4">
					<input type="text" class="form-control" readonly value="<?php echo $DataPermohonan->nama_pemilik;?>" name="nama_pemilik" placeholder="Nama Pemilik">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Dokumen Kelaikan Fungsi BG:</label>
				<div class="col-md-4">
					<p class="form-control-static" data-display="nama_provinsi"></p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Pengkaji Teknis:</label>
				<div class="col-md-4">
					<p class="form-control-static" data-display="nama_provinsi"></p>
				</div>
			</div>
		<h4 class="form-section"><b>Data Kepemilikan</b></h4>
		<div class="form-group">
			<label class="control-label col-md-3">Jenis Kepemilikan:</label>
			<?php 
				if($DataPermohonan->id_jenis_kepemilikan = '1'){
					$pemilik = "Perorangan";
				}else if($DataPermohonan->id_jenis_kepemilikan = '2'){
					$pemilik = "Perusahaan / Badan Usaha";
				}else if($DataPermohonan->id_jenis_kepemilikan = '3'){
					$pemilik = "Pemerintah";
				}else {
					$pemilik = "Belum Diinput";
				}
			?>
			<div class="col-md-4">
				<input type="text" class="form-control" readonly value="<?php echo $pemilik;?>" name="nama_pemilik" placeholder="Jenis Kepemilikan">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Nama Pemilik:</label>
			<div class="col-md-4">
				<input type="text" class="form-control" readonly value="<?php echo $DataPermohonan->nama_pemilik;?>" name="nama_pemilik" placeholder="Nama Pemilik">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Alamat Pemilik Bangunan:</label>
			<div class="col-md-4">
				<input type="text" class="form-control" readonly value="<?php echo $DataPermohonan->alamat_pemilik;?>" name="no_imb" placeholder="No. Izin Mendirikan Bangunan">
			</div>
		</div>
		
		<h4 class="form-section"><b>Data Pokok Bangunan Gedung</b></h4>
		<div class="form-group">
			<label class="control-label col-md-3">No. IMB:</label>
			<div class="col-md-4">
				<input type="text" class="form-control" readonly value="<?php echo $DataPermohonan->no_imb;?>" name="no_imb" placeholder="No. Izin Mendirikan Bangunan">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Alamat Bangunan Gedung:</label>
			<div class="col-md-4">
				<input type="text" class="form-control" readonly value="<?php echo $DataPermohonan->alamat_bg;?>" name="no_imb" placeholder="No. Izin Mendirikan Bangunan">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Tipe perencanaan:</label>
			<?php
				if($DataPermohonan->id_perencana ='1'){
					$perencana = " Desain Prototype";
				}else if($DataPermohonan->id_perencana ='2'){
					$perencana = " Desain Sendiri (Pengembangan dari Desain Prototype)";
				}else if($DataPermohonan->id_perencana ='3'){
					$perencana = "  Desain Oleh Penyedia Jasa";
				}else{
					$perencana = " Belum Diinput";
				}
			?>
			<div class="col-md-4">
				<input type="text" class="form-control" readonly value="<?php echo $perencana;?>" name="nama_pemohon" placeholder="Nama Pemilik">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">Fungsi Bangunan:</label>
			<div class="col-md-4">
				<input type="text" class="form-control" readonly value="<?php echo $DataPermohonan->fungsi_bg;?>" name="nama_pemohon" placeholder="Nama Pemilik">
			</div>
		</div>
		<center>
			<span class="input-group-btn">
				<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>PengajuanSLF/FormPermohonanSLF/<?php echo $id;?>';return false;">Kembali</button>
			</span>
			<span class="input-group-btn">
				<button class="btn green" onClick="window.location.href = '<?php echo base_url();?>pengajuanSLF/FormDataTanah/<?php echo $id;?>';return false;">Selanjutnya</button>
			</span>
		</center>
		<br>
	</div>
</div>
<div id="myModal_autocomplete" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Tambah Data Tanah</h4>
				</div>
				<div class="modal-body form">
					<form action="<?php echo site_url('pengajuanSLF/saveDataTanah'); ?>" class="form-horizontal" role="form" method="post" id="FormTambahTanah" enctype="multipart/form-data">
						<div class="portlet-body form">
						<div class="form-body">
						<br>
						<input type="text" class="form-control" value="<?=(isset($id_permohonan) ? $id_permohonan : '');?>" name="id_permohonan" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?=(isset($id_provinsi) ? $id_provinsi : '');?>" name="nama_provinsi" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?=(isset($id_kec) ? $id_kec : '');?>" name="nama_kabkota" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?=(isset($id_kabkot) ? $id_kabkot : '');?>" name="nama_kecamatan" style="display: none;" autocomplete="off">
						<div class="row">
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
											<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
											<select name="id_dokumen" id="id_dokumen" class="form-control" onchange="">
											<option value="">Pilih</option>
											<option value="1">Sertifikat</option>
											<option value="2">Akte Jual Beli</option>
											<option value="3">Girik</option>
											<option value="4">Petuk</option>
											<option value="5">Bukti Lain - Lain</option>
											</select>	
													<label for="form_control_1">Jenis Dokumen</label>
												</div>
											</div>
							</div>
							
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
													<input class="form-control" id="nomor_dokumen" name="nomor_dokumen" type="text" placeholder="0-9 / A-Z" autocomplete="off">
													<label for="form_control_1">Nomor Dokumen</label>
													
												</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
													</span>
													<input class="form-control date-picker" type="text" id="tgl_terbit_dokumen" name="tgl_terbit_dokumen" data-date-format="yyyy-mm-dd" autocomplete="off" placeholder="2000/12/31"/>
													<label for="form_control_1">Tanggal Terbit Dokumen</label>
													
												</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
													<input class="form-control" id="luas_tanah" name="luas_tanah" type="text" placeholder="Luas Tanah 00.00" autocomplete="off">
													<label for="form_control">Luas Tanah (<i> meter<sup> 2 </sup></i>)</label>
													
												</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
											<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
											<select name="hat" id="hat" class="form-control" onchange="">
											<option value="">Pilih</option>
											<option value="1">Hak Milik</option>
											<option value="2">Hak Pakai</option>
											<option value="3">Hak Pengelolaan</option>
											<option value="4">Hak Guna Bangunan</option>
											<option value="5">Hak Guna Usaha</option>
											<option value="6">Hak Wakaf</option>
											</select>	
													<label for="form_control_1">Hak Atas Tanah</label>
												</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
													<input class="form-control" id="atas_nama" name="atas_nama" type="text" placeholder="Nama Pemegang Hak Atas Tanah" autocomplete="off">
													<label for="form_control">Nama Pemegang Hak Atas Tanah</label>
													
												</div>
											</div>
							</div>
							
						
							<div class="col-md-12">
											<div class="form-group form-md-line-input">
											<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
													<input  type="text" class="form-control" value="<?=(isset($jalan) ? $jalan : '');?>, Kec. <?=(isset($nama_kec) ? $nama_kec : '');?>" rows="1" placeholder="Lokasi Tanah" id="lokasi_tanah" name="lokasi_tanah" >
													<label for="form_control_1">Lokasi Tanah</label>
											</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
											<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
												<input style="display: none;" name="dir_file_tan" id="dir_file_tan" onchange='coktan()'>
												<input type="file" class="form-control" name="d_file_tan" id="d_file_tan" accept="application/pdf" onchange='coktan()'>
												<label for="form_control_1">Berkas Kepemilikan Tanah</label>
											</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
											<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
											<select name="hat2" id="hat2" class="form-control" onclick="set_status_izin_pemanfaatan(this.value)">
											<option value="">Pilih</option>
											<option value="1">YA</option>
											<option value="2">Tidak</option>
											</select>	
													<label for="form_control_1">Izin pemanfaatan dari pemegang hak atas tanah</label>
												</div>
											</div>
											
							</div>
							
							<div id="izinjing" style="display: none;">
							<h3 class="title">&nbsp;</h3>
							
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
													<input class="form-control" id="no_dok_izin_pemanfaatan" name="no_dok_izin_pemanfaatan" type="text" placeholder="0-9 / A-Z" autocomplete="off">
													<label for="form_control_1">Nomor Dokumen Izin Pemanfaatan</label>
													
												</div>
											</div>
							</div>
							<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
													</span>
													<input class="form-control date-picker" type="text" id="tgl_terbit_phat" name="tgl_terbit_phat" data-date-format="yyyy-mm-dd" placeholder="2000/12/31" autocomplete="off"/>
													<label for="form_control_1">Tanggal Terbit Izin Pemanfaatan</label>
													
												</div>
											</div>
							</div>
									<div class="col-md-6">
										<div class="form-group form-md-line-input">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-circle"></i>
													</span>
													<input class="form-control" id="nama_penerima_kuasa" name="nama_penerima_kuasa" type="text" placeholder="Nama Penerima Izin Pemanfaatan" autocomplete="off">
													<label for="form_control">Nama Penerima Izin Pemanfaatan</label>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group form-md-line-input">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-circle"></i></span>
												<input style="display: none;" name="dir_file_phat" id="dir_file_phat" onchange='cokphat()'>
												<input type="file" class="form-control" name="d_file_phat" id="d_file_phat" accept="application/pdf" onchange='cokphat()'>
												<label for="form_control_1">Berkas Izin Pemanfaatan</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
function popWin(x){
	url = x;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
	}
function set_status_izin_pemanfaatan(v)
{
	if(v == '1'){
		document.getElementById('izinjing').style.display="block";
	}else{
		document.getElementById('izinjing').style.display="none";
	}
}

function coktan(){	
		$('#dir_file_tan').val(d_file_tan.value);
	}
	function cokphat(){
		$('#dir_file_phat').val(d_file_phat.value);
	}
	
$(function () {    
	 // Setup form validation on the #register-form element
	$("#FormTambahTanah").validate({
	    // Specify the validation rules
	    rules: {
			 
			id_dokumen: "required",
			nomor_dokumen: "required",
			tgl_terbit_dokumen: "required",
			luas_tanah: "required",
			hat2: "required",
			hat: "required",
			atas_nama: "required",
			lokasi_tanah: "required",
			d_file_tan: "required",
			
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
			id_dokumen: "",
			nomor_dokumen: "",
			tgl_terbit_dokumen: "",
			luas_tanah: "",
			hat2: "",
			hat: "",
			atas_nama: "",
			lokasi_tanah: "",
			d_file_tan: "",
			
	    },
	    submitHandler: function(form) {
				form.submit();
			}
		});
	});
</script>
