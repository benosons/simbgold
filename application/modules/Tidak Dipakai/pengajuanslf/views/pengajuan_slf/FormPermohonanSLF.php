<script language="javascript" type="text/javascript">
function getNib(v){
	if(v == '1'){
		document.getElementById('Nibnya').style.display="block";
		
	}else{
		document.getElementById('Nibnya').style.display="none";
		
	}
}

function popupNIB() {
	$.ajax({
        type: "POST",
        url:  "<?php echo base_url();?>PengajuanSLF/list_nib_popup",
		data: $('form.form-horizontal').serialize(),
        success: function(response) {
			if(response == ""){
				alert("NIB tidak terdaftar pada sistem OSS, Silahkan isi manual jika telah memiliki NIB, jika belum memiliki NIB silahkan Lakukan Pendaftaran pada sistem OSS");
				document.getElementById('nib_list').style.display="none";
			}else{
				//$("#statusnib").attr('readonly','readonly');
				//$("#nib").attr('readonly','readonly');
				//$("#btnib").attr('readonly','readonly');
				$('#table_IMB tbody').html(response);
				document.getElementById('nib_list').style.display="block";
				
			}
        },
        error: function(error) {
            alert('NIB tidak terdaftar pada sistem OSS');
        }
    });
}
</script>
<script>


function t0t1(v){
	if(v == '1'){
		document.getElementById('lamanya').style.display="block";
		document.getElementById('fungsibg').style.display="block";
		document.getElementById('imb').style.display="block";
		document.getElementById('pengawasan').style.display="block";
		document.getElementById('lantai').style.display="block";
		document.getElementById('tahap').style.display="block";
		document.getElementById('dokumen_teknis').style.display="block";
		document.getElementById("id_dok_tet").value = "3";
		
	}if(v == '2'){
		document.getElementById('fungsibg').style.display="block";
		document.getElementById('lantai').style.display="block";
		document.getElementById('dokumen_teknis').style.display="block";
		document.getElementById('imb').style.display="none";
		document.getElementById('pengawasan').style.display="none";
		document.getElementById('tahap').style.display="none";
		document.getElementById('lamanya').style.display="none";
		document.getElementById("id_dok_tet").value = "3";
	}if(v == '3'){
		document.getElementById('lamanya').style.display="block";
		document.getElementById('imb').style.display="block";
		document.getElementById('pengawasan').style.display="none";
		document.getElementById('tahap').style.display="none";
		document.getElementById('lantai').style.display="none";
		document.getElementById('dokumen_teknis').style.display="none";
		document.getElementById('fungsibg').style.display="none";
		document.getElementById("id_dok_tet").value = "3";
	}if(v == '4'){
		document.getElementById('lamanya').style.display="none";
		document.getElementById('imb').style.display="none";
		document.getElementById('pengawasan').style.display="none";
		document.getElementById('tahap').style.display="none";
		document.getElementById('lantai').style.display="none";
		document.getElementById('dokumen_teknis').style.display="none";
		document.getElementById('fungsibg').style.display="none";
		document.getElementById("id_dok_tet").value = "3";
	}if(v == ''){
		document.getElementById('lamanya').style.display="none";
		document.getElementById('imb').style.display="none";
		document.getElementById('pengawasan').style.display="none";
		document.getElementById('tahap').style.display="none";
		document.getElementById('lantai').style.display="none";
		document.getElementById('dokumen_teknis').style.display="none";
		document.getElementById('fungsibg').style.display="block";
		document.getElementById("id_dok_tet").value = "";
	}
}


function t0t2(v){
	if(v == '1'){
		
		document.getElementById('tahap').style.display="none";
		document.getElementById('lantai').style.display="block";
		document.getElementById('dokumen_teknis').style.display="block";
		
		
	}else{
		document.getElementById('lantai').style.display="none";
		document.getElementById('pengawasan').style.display="none";
		document.getElementById('dokumen_teknis').style.display="none";
	
	}
}

function t0t3(v){
	if(v == '1'){
		
		document.getElementById('pengawasan').style.display="block";
		document.getElementById('tahap').style.display="block";
		document.getElementById("id_dok_tet").value = "2";
	}else{
		document.getElementById('pengawasan').style.display="none";
		//document.getElementById('tahap').style.display="none";
	}
}

function t0t4(v){
	if(v == '1'){
		document.getElementById('tahap').style.display="block";
		document.getElementById('lamanya').style.display="block";
		document.getElementById('pengawasan').style.display="block";
		document.getElementById('noimb').style.display="block";
		document.getElementById('id_peng1').disabled=false;
		document.getElementById('id_peng2').disabled=false;
	}else{
		document.getElementById('noimb').style.display="none";
		document.getElementById('lamanya').style.display="none";
		document.getElementById('tahap').style.display="none";
		document.getElementById('pengawasan').style.display="none";
		document.getElementById('id_peng1').disabled=true;
		document.getElementById('id_peng2').disabled=true;
		document.getElementById("id_dok_tet").value = "3";
		
	}
}

function t0t5(v){
	if(v == '2'){
		document.getElementById('dokumen_teknis').style.display="none";
		document.getElementById('pengawasan').style.display="none";
		
	}else{
		document.getElementById('dokumen_teknis').style.display="block";
		document.getElementById('pengawasan').style.display="block";
		
	}
}

function set_tahapan(v){
	if(v == '1'){
		document.getElementById("id_dok_tet").value = "4";
		document.getElementById('pengawasan').style.display="none";
	}else if(v == '2'){
		document.getElementById("id_dok_tet").value = "2";
		document.getElementById('pengawasan').style.display="none";
	}else{
		document.getElementById("id_dok_tet").value = "";
		document.getElementById('pengawasan').style.display="none";
	}
}

function set_peng(v){
	if(v == '1'){
		document.getElementById("id_dok_tet").value = "1";
		document.getElementById('dokumen_teknis').style.display="none";
	}else if(v == '2'){
		document.getElementById("id_dok_tet").value = "2";
		document.getElementById('dokumen_teknis').style.display="none";
	}else{
		document.getElementById("id_dok_tet").value = "";
	}
}

function set_tek(v){
	if(v == '1'){
		document.getElementById("id_dok_tet").value = "1";
		document.getElementById('pengawasan').style.display="none";
	}else if(v == '3'){
		document.getElementById("id_dok_tet").value = "3";
		document.getElementById('pengawasan').style.display="none";
	}
}

function resetin(){
		document.getElementById("form_slf").reset();
		
}

</script>

			<div class="row">
				<div class="col-md-12">
					<div class="portlet light">
						<div class="portlet-body form">
						<form class="form-horizontal">
											
						</form>
							<form action="<?php echo site_url('PengajuanSlf/saveDataSLF'); ?>" class="form-horizontal" role="form" method="POST" name="form_slf" id="form_slf">
												
												
												<div class="form-group">
													<label class="control-label col-md-3">Memiliki NIB ?<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control select2me" id="statusnib" name="statusnib" onchange="getNib(this.value)">
															<option value="">--Pilih--</option>
															<option value="1">Memiliki NIB</option>
															<option value="2">Tidak Memiliki NIB</option>
														</select>
													</div>
												</div>
												<div id="Nibnya" style="display: none;">
													<div class="form-group">
														<label class="control-label col-md-3">Nomor Induk Berusaha<span class="required">* </span></label>
														<div class="col-md-7">
																<input type="number" class="form-control" id="nib" name="nib" placeholder="8120001340969" />
																
														</div>
														<div class="col-md-2">
															<input type='button' onClick="popupNIB()" title="Cari Data NIB" value="Cari" class="btn green" name="btnib" id="btnib"/>
														</div>
													</div>
												</div>
												<div id="nib_list" style="display: none;">
													<div class="form-group">
													<label class="control-label col-md-3"></label>
													  <div class="col-md-8">
														<table id="table_IMB" class="table table-striped table-bordered">
															<thead>
																<tr>
																	<th>Kode Izin</th>
																	<th>Uraian Usaha</th>
																	<th>Alamat Investasi</th>
																	<th>Pilih</th>
																</tr>
															</thead>
															<tbody></tbody>
														</table>
													  </div>
													</div>
												</div>
												
												
											<!-- Begin Data Pemilik Bangunan Gedung -->
												<div class="form-group">
													<label class="control-label col-md-3">Tipe Layanan SLF<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control select2me" name="id_fungsi" id="id_fungsi" onchange="t0t1(this.value)">
															<option value="" >--Pilih--</option>
															<option value="1">SLF Pertama Bangunan Gedung</option>
															<option value="2">Perpanjangan SLF Bangunan Gedung</option>
															<option value="3">SLF Pertama Bangunan Prasarana</option>
															<option value="4">Perpanjangan SLF Bangunan Prasarana</option>
														</select>
													</div>
												</div>
												
												
												<div id="imb" style="display:none">
													<div class="form-group">
														<label class="control-label col-md-3">Apakah Sudah Memiliki IMB<span class="required">* </span></label>
														<div class="col-md-7">
														<select class="form-control select2me" name="pty_imb" id="pty_imb" onchange="t0t4(this.value)">
															<option value="">--Pilih--</option>
															<option value="1">Memiliki IMB</option>
															<option value="2">Tidak Memiliki IMB</option>
														</select>
														</div>
													</div>
												</div>
												
												<div id="noimb" style="display:none">
													<div class="form-group">
														<label class="control-label col-md-3">Masukan No IMB <span class="required">* </span></label>
														<div class="col-md-7">
														<input type="text" name="no_imb" id="no_imb" class="form-control" placeholder="SK-IMB-123456-07082019-10">
														<br><span id="an" name="an" style="display:none"class="btn green" disabled="true">IMB DITEMUKAN ATAS NAMA<input type='button' name='btn2' id='btn2' class="btn green" disabled="true"/></span>
														</div>
														<div class="col-md-2">
														<input type='button' name='btn' id='btn' value='Cari' class="btn green" onclick="ceki()" title="Cari Data IMB"/>
														</div>
													</div>
												</div>
												
												<div id="lamanya" style="display:none">
												<div class="form-group">
													<label class="control-label col-md-3">Apakah Sudah Lebih Dari 1 Tahun Sejak Selesai Konstruksi<span class="required">
													* </span></label>
													<div class="col-md-7">
														<select class="form-control select2me" name="pty_lama" id="pty_lama" onchange="t0t3(this.value)">
															<option value="">--Pilih--</option>
															<option value="2">Belum </option>
															<option value="1">Sudah</option>
														</select>
													</div>
												</div>
												</div>
												
												<div id="fungsibg" style="">
												<div class="form-group" style="">
													<label class="control-label col-md-3">Fungsi Bangunan Gedung<span class="required">
													* </span></label>
													<div class="col-md-7">
														<select class="form-control select2me" name="pty_fungsibg" onchange="t0t2(this.value)">
															<option value="">--Pilih--</option>
															<option value="1">Fungsi Hunian</option>
															<option value="2">Fungsi Non-Hunian atau Fungsi Campuran</option>
														</select>
													</div>
												</div>
												</div>
												
												
												<div id="lantai" style="display:none">
												<div class="form-group" style="">
													<label class="control-label col-md-3">Jumlah Lantai<span class="required">
													* </span></label>
													<div class="col-md-7">
														<select class="form-control select2me" name="pty_lantai" onchange="t0t5(this.value)">
															<option value="">--Pilih--</option>
															<option value="1">1-2 Lantai</option>
															<option value="2">Lebih Dari 2 Lantai</option>
														</select>
													</div>
												</div>
												</div>
												<!--Begin Untuk Prasarana -->
												
												<!-- End Untuk Prasarana-->
												<div id="pengawasan" style="display:none">
													<div class="form-group">
														<label class="control-label col-md-3">Pengawasan Saat Konstruksi Dilakukan Oleh<span class="required">* </span></label>
														<div class="col-md-7">
															<div class="radio-list" >
																<label><input type="radio" name="id_peng" id="id_peng1" value="1" onclick="set_peng(this.value)" />Pemilik Bangunan Gedung</label>
																<label><input type="radio" name="id_peng" id="id_peng2" value="2" onclick="set_peng(this.value)" />Penyedia Jasa</label>
																
															</div>
														</div>
													</div>
												</div>
												
												<div id="dokumen_teknis" style="display:none">
													<div class="form-group">
														<label class="control-label col-md-3">Pemeriksaan Kelaikan Fungsi Dilakukan Oleh<span class="required">* </span></label>
														<div class="col-md-7">
															<div class="radio-list" class="form-control">
																<label><input type="radio" name="id_dok_tek" id="id_dok_tek1" value="1" onclick="set_tek(this.value)"/>Pemerintah Daerah</label>
																<label><input type="radio" name="id_dok_tek" id="id_dok_tek2" value="3" onclick="set_tek(this.value)" />Pengkaji Teknis</label>
															</div>
														</div>
													</div>
												</div>
												
												<div id="tahap" style="display:none">
													<div class="form-group">
														<label class="control-label col-md-3">Apakah Diawasi Lebih Dari 1 Pengawas/MK Secara Bertahap<span class="required">* </span></label>
														<div class="col-md-7">
															<div class="radio-list" >
																<label><input type="radio" name="tahapan" onclick="set_tahapan(this.value)" value="1"/>Ya</label>
																<label><input type="radio" name="tahapan" onclick="set_tahapan(this.value)" value="2"/>Tidak</label>
																
															</div>
														</div>
													</div>
												</div>
												<div style="display:none">
												<input type="text" name="id_dok_tet" id="id_dok_tet" class="form-control">
												
												<input type="text" name="tgl_imb" id="tgl_imb" class="form-control">
												<input type="text" name="id_imb" id="id_imb" class="form-control">
												<input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control">
												<input type="text" name="no_tlp" id="no_tlp" class="form-control">
												<input type="text" name="no_ktp" id="no_ktp" class="form-control">
												<input type="text" name="email" id="email" class="form-control">
												<input type="text" name="alamat_pemilik" id="alamat_pemilik" class="form-control">
												<input type="text" name="id_kecamatan" id="id_kecamatan" class="form-control">
												<input type="text" name="id_kabkot" id="id_kabkot" class="form-control">
												<input type="text" name="id_provinsi" id="id_provinsi" class="form-control">
												<br>
												<input type="text" name="alamat_bg" id="alamat_bg" class="form-control">
												<input type="text" name="id_kecamatan_bg" id="id_kecamatan_bg" class="form-control">
												<input type="text" name="id_kabkot_bg" id="id_kabkot_bg" class="form-control">
												<input type="text" name="id_provinsi_bg" id="id_provinsi_bg" class="form-control">
												<br>
												<input type="text" name="statusaha" id="statusaha" class="form-control">
												<input type="text" name="id_jenis_bg" id="id_jenis_bg" class="form-control">
												<input type="text" name="id_fungsi_bg" id="id_fungsi_bg" class="form-control">
												<input type="text" name="jns_bangunan" id="jns_bangunan" class="form-control">
												<input type="text" name="luas_bg" id="luas_bg" class="form-control">
												<input type="text" name="tinggi_bg" id="tinggi_bg" class="form-control">
												<input type="text" name="lantai_bg" id="lantai_bg" class="form-control">
												<input type="text" name="nama_bangunan" id="nama_bangunan" class="form-control">
												<input type="text" name="luas_basement" id="luas_basement" class="form-control">
												<input type="text" name="lapis_basement" id="lapis_basement" class="form-control">
												<input type="text" name="dok_imb" id="dok_imb" class="form-control">
												</div>
												
									
									<div class="form-actions">
										<center><div class="row">
											<div class="col-md-12">
												<button type="submit" class="btn green">Simpan</button>
												<button type="button" class="btn red" onClick="window.location.href = '<?php echo base_url();?>pengajuanSLF';return false;">Batal</button>
											</div>
										</center></div>
									</div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT INNER -->
	<!-- END PAGE CONTENT -->
	
<script type="text/javascript">

function ceki() {
	var no_imb = document.getElementById("no_imb").value;
	var tgl_imb = document.getElementById("tgl_imb").value;
	
	if (no_imb == ""){
		alert("Harap masukan Nomor IMB Anda !");
		document.getElementById('tgl_imb').value = "";
	}else if (tgl_imb == ""){
		alert("Data Tidak Ditemukan, Harap masukan Nomor IMB dengan benar !");
		document.getElementById('no_imb').disabled = false;
		document.getElementById("form_slf").reset();
			//document.getElementById('btn').style.display="none";
	}else{
		alert("Data Ditemukan, Harap Periksa Kembali Apakah Sudah Benar !");
		document.getElementById('an').style.display="block";
		document.getElementById('btn').style.display="none";
		//document.getElementById('no_imb').innerHTML="Read-Only attribute enabled";
		$("#no_imb").attr('readonly','readonly');
		$("#pty_imb").attr('readonly','readonly');
		$("#id_fungsi").attr('readonly','readonly');
		document.getElementById('btn').disabled = true;
		//document.getElementById('pty_imb').disabled = true;
		//document.getElementById('id_fungsi').disabled = true;
	}
}

			$(document).ready(function(){
			 $('#no_imb').on('input',function(){
                var no_imb=$(this).val();
				document.getElementById('tgl_imb').value = "";
				
                $.ajax({
                    type : "POST",
					url  : "<?php echo base_url().'PengajuanSLF/getNoImb'; ?>",
                    dataType : "JSON",
                    data : {no_imb: no_imb},
                    cache:false,
                    success: function(data){
                        $.each(data,function(no_imb){
							//alert("Data Ditemukan, Harap Periksa Kembali Apakah Sudah Benar !");
							$('[name="id_imb"]').val(data.id_permohonan);
                            $('[name="tgl_imb"]').val(data.tgl_imb);
							//$('[name="dir_file_simbg"]').val(data.dir_file_simbg);
							$('[name="nama_pemilik"]').val(data.nama_pemohon);
							$('[name="btn2"]').val(data.nama_pemohon);
                            $('[name="no_tlp"]').val(data.no_tlp);
							$('[name="statusaha"]').val(data.id_jenis_usaha);
                            $('[name="email"]').val(data.email);
                            $('[name="no_ktp"]').val(data.no_ktp);
							$('[name="alamat_pemilik"]').val(data.alamat_pemohon);
							$('[name="id_kecamatan"]').val(data.id_kecamatan);
							$('[name="nama_kecamatan"]').val(data.kecamatan);
							$('[name="id_kabkot"]').val(data.id_kabkot);
                            $('[name="nama_kabkota"]').val(data.nama_kabkota);
							$('[name="id_provinsi"]').val(data.id_provinsi)
                            $('[name="nama_provinsi"]').val(data.nama_provinsi);
							// Data Bangunan//
							$('[name="alamat_bg"]').val(data.alamat_bg);
							$('[name="kelurahan"]').val(data.kelurahan);
							$('[name="id_kabkot_bg"]').val(data.id_kabkot_bg);
							$('[name="id_provinsi_bg"]').val(data.id_provinsi_bg);
							$('[name="nama_kabkota_bg"]').val(data.nama_kabkota_bg);
							$('[name="nama_provinsi_bg"]').val(data.nama_provinsi_bg);
							$('[name="id_kecamatan_bg"]').val(data.id_kec_bg);
							$('[name="nama_kecamatan_bg"]').val(data.kecamatan);
							$('[name="id_jenis_bg"]').val(data.id_jenis_bg);
							$('[name="id_fungsi_bg"]').val(data.id_fungsi_bg);
							$('[name="jns_bangunan"]').val(data.jns_bangunan);
							$('[name="luas_bg"]').val(data.luas_bg);
							$('[name="tinggi_bg"]').val(data.tinggi_bg);
                            $('[name="lantai_bg"]').val(data.lantai_bg);
							$('[name="nama_bangunan"]').val(data.nama_bangunan);
							$('[name="luas_basement"]').val(data.luas_basement);
							$('[name="lapis_basement"]').val(data.lapis_basement);
							$('[name="dok_imb"]').val(data.id_dok_tek);
							});
						}
					});
				//alert();
					return false;
				});
				});
</script>

<script>
$(function () {    
	 // Setup form validation on the #register-form element
	$("#form_slf").validate({
	    // Specify the validation rules
	    rules: {
			statusnib : "required",
			id_fungsi : "required",
			pty_fungsibg: "required",
			nib: "required",
			pty_imb: "required",
			no_imb: "required",
			pty_lantai:"required",
			pty_lama: "required",
			//nama_kabkota: "required",

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
			statusnib: "Pilih Memiliki NIB Atau Tidak",
			id_fungsi : "Pilih Tipe Layanan SLF",
	        pty_fungsibg: "Pilih Fungsi Bangunan",
			nib: "Masukkan NIB",
			pty_imb : "Pilih Memiliki IMB Atau Tidak",
			no_imb: "Masukkan Nomor IMB",
			pty_lantai: "Pilih Jumlah Lantai",
			pty_lama: "Wajib Dipilih",
			//jns_bangunan: "Pilih Jenis Bangunan",
			
	    },
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
});
</script> 