
		<input type="hidden" class="form-control" value="<?php echo set_value('id_permohonan', (isset($id_permohonan) ? $id_permohonan : ''))?>" name="id_permohonan" placeholder="id_permohonan" autocomplete="off">
		<input type="hidden" class="form-control" value="<?php echo set_value('id_jenis_permohonan', (isset($id_jenis_permohonan) ? $id_jenis_permohonan : ''))?>" name="Jenis Permohonan" placeholder="id_nama_permohonan" autocomplete="off">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Data Tanah
				</div>
			</div>
			<div class="portlet-body">
			<a href="#tanahsumary" role="button" class="btn red" data-toggle="modal">Tambah Data </a>
			
					<div class="table-scrollable"><table class="table table-striped table-hover table-bordered" id="sample_editable_1">
										<thead>
											<tr class="warning">
												<th><center>No.</center></th>
												<th><center>Jenis Dokumen</center></th>
												<th><center>Nomor Dokumen</center></th>
												<th><center>Tgl. Dokumen</center></th>
												<th><center>LT (m2)</center></th>
												<th><center>Atas Nama</center></th>
												<th><center>Berkas</center></th>
												<th><center>Izin Pemanfaatan</center></th>
												<th><center>Status</center></th>
												
											</tr>
											
										</thead>
										<tbody>
										<?php
											if($DataTanah->num_rows() > 0)
											{
												$no = 1;
												foreach ($DataTanah->result() as $key) 
												{
													if($key->id_dokumen == '1'){
														$jenis_dokumen = "Sertifikat";
													}else if ($key->id_dokumen == '2'){
														$jenis_dokumen = "Akte Jual Beli";
													}else if ($key->id_dokumen == '3'){
														$jenis_dokumen = "Girik";
													}else if ($key->id_dokumen == '4'){
														$jenis_dokumen = "Petuk";
													}else{
														$jenis_dokumen = "Bukti Lain - Lain";
													}
											?>
													<tr>
														<td align="center"> <?php echo $no++;?></td>
														<td align="center"> <?php echo $jenis_dokumen;?></td>
														<td align="center"> <?php echo $key->no_dok;?></td>
														<td align="center"> <?php echo $key->tanggal_dok;?></td>
														<td align="center"> <?php echo $key->luas_tanah;?></td>
														<td align="center"> <?php echo $key->atas_nama_dok;?></td>
														<td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/slf/'.$key->id_permohonan_slf.'/data_tanah/'.$key->dir_file);?>')" class="btn default btn-xs blue-stripe" >Lihat</a></td>
														<?php if($key->dir_file_phat != ""){?>
														<td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/slf/'.$key->id_permohonan_slf.'/data_tanah/'.$key->dir_file_phat);?>')" class="btn default btn-xs blue-stripe" >Lihat</a></td>
														<?}else{?>
														<td></td>
														<?}?>
														
														<?php if($key->verifikasi != "1"){?>
														<td align="center">
														<a href="<?php echo site_url('PengajuanSLF/removeDataTanahSumary/'.$key->id_tanah.'/'.$key->id_permohonan_slf);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
														</td>
														<?}else{?>
														<td align="center"><i class="fa fa-check"></i></td>
														<?}?>
														
													</tr>
											<?php			
												}
											}
											?>
										</tbody>
									</table></div>
				</div>
			</div>
		


<div id="tanahsumary" class="modal fade" role="dialog" aria-hidden="true" data-width="60%" data-backdrop="static" data-keyboard="false">
	
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Tambah Data Tanah</h4>
			</div>
			<div class="modal-body form">
				<form action="<?php echo site_url('pengajuanSLF/saveDataTanahSumary'); ?>" class="form-horizontal" role="form" method="post" id="FormTambahTanah" enctype="multipart/form-data">
						<div class="portlet-body form">
						<div class="form-body">
						<br>
						<input type="text" class="form-control" value="<?=(isset($id_permohonan_slf) ? $id_permohonan_slf : '');?>" name="id_permohonan_slf" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?=(isset($DataSummary->id_provinsi_bg) ? $DataSummary->id_provinsi_bg : '');?>" name="nama_provinsi" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?=(isset($DataSummary->id_kecamatan_bg) ? $DataSummary->id_kecamatan_bg : '');?>" name="nama_kecamatan" style="display: none;" autocomplete="off">
						<input type="text" class="form-control" value="<?=(isset($DataSummary->id_kabkot_bg) ? $DataSummary->id_kabkot_bg : '');?>" name="nama_kabkota" style="display: none;" autocomplete="off">
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
													<input  type="text" class="form-control" value="<?=(isset($DataSummary->alamat_bg) ? $DataSummary->alamat_bg : '');?>" rows="1" placeholder="Lokasi Tanah" id="lokasi_tanah" name="lokasi_tanah" >
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
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
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