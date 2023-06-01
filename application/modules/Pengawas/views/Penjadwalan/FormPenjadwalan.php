<script language="javascript" type="text/javascript">

</script>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
			<h4 align="center" class="caption-subject font-red bold uppercase">Data Pokok Permohonan <?=(isset($nomor_registrasi) ? $nomor_registrasi : '')?></h4><hr/>
			<div class="row static-info">
				<div class="col-md-4 name">
					Nama Pemilik
				</div>
				<div class="col-md-8 value">	
					<input class="form-control" value="<?php echo $data->nm_pemilik; ?>" placeholder="Nama Pemilik" autocomplete="off" readonly>
						
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Alamat Pemilik
				</div>
				<div class="col-md-8 value">
					<textarea class="form-control" placeholder="Alamat Pemilik" readonly><?php echo $data->alamat; ?>, Kec. <?php echo $data->nama_kecamatan; ?>, <?php echo ucwords(strtolower($data->nama_kabkota)); ?>, Prov. <?php echo $data->nama_provinsi; ?>
					</textarea>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Jenis Permohonan	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($nama_permohonan) ? $nama_permohonan : '')?>
							<?php
							if(isset($nama_permohonan) != '' || isset($nama_permohonan) != null ){
								$status_syarat = (isset($status_syarat) ? $status_syarat : '');
								if($status_syarat == '1')
								{
									$periode = date('Y', strtotime($tgl_pemberitahuan));
									$lantai_bg = (isset($lantai_bg) ? $lantai_bg : '');
									$lama_proses = (isset($lama_proses) ? $lama_proses : '');
									
									if($lama_proses == '12/30' ){
										$lama_proses = preg_split("#/#", $lama_proses); 
										
										if($lantai_bg > 8){
											$lama_proses = $lama_proses[1];
										}else{
											$lama_proses = $lama_proses[0];
										}
										$total_hari_kerja = $con_set->jangka_waktu_pelayanan($tgl_pemberitahuan,null,$id_kabkot,$periode,$lama_proses);
									}else if($lama_proses == '0' || $lama_proses == '' || $lama_proses == null){
										$total_hari_kerja = $con_set->jangka_waktu_pelayanan($tgl_pemberitahuan,null,$id_kabkot,$periode,null);
									}else{
										$total_hari_kerja = $con_set->jangka_waktu_pelayanan($tgl_pemberitahuan,null,$id_kabkot,$periode,$lama_proses);
									}
									$total_hari_kerja = tgl_eng_to_ind($total_hari_kerja);
								}
							}
					?>
				</div>
			</div>
			<?php
					$status_syarat = (isset($status_syarat) ? $status_syarat : '');
					if($status_syarat == '1')
					{
						$tgl_pemberitahuan = tgl_eng_to_ind($tgl_pemberitahuan);
			?>
			<div class="row static-info">
				<div class="col-md-4 name">
					Tanggal Verifikasi & <br> Batas Waktu Pelayanan	:
				</div>
				<div class="col-md-8 value">
					<p class="font-red"><?=(isset($tgl_pemberitahuan)? $tgl_pemberitahuan : '');?> <i class="text-tot">sampai dengan</i>  <?=(isset($total_hari_kerja)? $total_hari_kerja : '');?><i class="text-tot">, ( <?=(isset($lama_proses)? $lama_proses : '');?> hari kerja ) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>
				</div>
			</div>
			<?}?>
			<div class="row static-info">
				<div class="col-md-4 name">
					Lokasi Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<textarea class="form-control" placeholder="Alamat Pemilik" readonly><?php echo $databgn->almt_bgn; ?>, Kec. <?php echo $databgn->nama_kecamatan; ?>, <?php echo ucwords(strtolower($databgn->nama_kabkota)); ?>, Prov. <?php echo $databgn->nama_provinsi; ?>
					</textarea>
				</div>
			</div>
			
			<? if(isset($tsarana) && $tsarana == 5){?>
			<div class="row static-info">
				<div class="col-md-4 name">
					Prasarana	:
				</div>
				<div class="col-md-8 value">
					<?
						if($id_prasarana_bg == 1){
							$prasarana = "Kontruksi Pembatas/Penahan/Pengaman";
						}elseif ($id_prasarana_bg == 2){
							$prasarana = "Konstruksi Penanda Masuk Lokasi";
						}elseif($id_prasarana_bg == 3){
							$prasarana = "Kontruksi Perkerasan";
						}elseif($id_prasarana_bg == 4){
							$prasarana = "Kontruksi Penghubung";
						}elseif($id_prasarana_bg == 5){
							$prasarana = "Kontruksi Kolam/Reservoir bawah tanah";
						}elseif ($id_prasarana_bg == 6){
							$prasarana = "Kontruksi Menara";
						}elseif ($id_prasarana_bg== 7){
							$prasarana = "Kontruksi Monumen";
						}elseif ($id_prasarana_bg == 8){
							$prasarana = "Kontruksi Instalasi/gardu";
						}elseif ($id_prasarana_bg == 9){
							$prasarana = "Kontruksi Reklame / Papan Nama";
						}else{
							$prasarana = "Belum ditentukan";
						}	
					?>
					<?php echo set_value('prasarana', (isset($prasarana) ? $prasarana : ''))?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Luas & Tinggi Prasarana :
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('luas_prasarana', (isset($luas_prasarana) ? $luas_prasarana : ''))?> meter persegi dan tinggi <?php echo set_value('tinggi_prasarana', (isset($tinggi_prasarana) ? $tinggi_prasarana : ''))?> meter.
				</div>
			</div>
			<?}else{?>
				<? if(isset($id_jenis_permohonan) && $id_jenis_permohonan == 47){?>
				
				<div class="row static-info">
				<div class="col-md-4 name">
					Tipe Bangunan :
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('tipeA', (isset($tipeA) ? $tipeA : ''))?> || <?php echo set_value('tipeB', (isset($tipeB) ? $tipeB : ''))?> || <?php echo set_value('tipeC', (isset($tipeC) ? $tipeC : ''))?> || <?php echo set_value('tipeD', (isset($tipeD) ? $tipeD : ''))?>
				</div>
				</div>
				
				<div class="row static-info">
				<div class="col-md-4 name">
					Jumlah Unit :
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('unitA', (isset($unitA) ? $unitA : ''))?> || <?php echo set_value('unitB', (isset($unitB) ? $unitB : ''))?> || <?php echo set_value('unitC', (isset($unitC) ? $unitC : ''))?> || <?php echo set_value('unitD', (isset($unitD) ? $unitD : ''))?>
				</div>
				</div>
				
				<div class="row static-info" style="display: none;">
				<div class="col-md-4 name">
					Luas Bangunan :
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('luasA', (isset($luasA) ? $luasA : ''))?> M<sup>2</sup> || <?php echo set_value('luasB', (isset($luasB) ? $luasB : ''))?> M<sup>2</sup> || <?php echo set_value('luasC', (isset($luasC) ? $luasC : ''))?> M<sup>2</sup> || <?php echo set_value('luasD', (isset($luasD) ? $luasD : ''))?> M<sup>2</sup>
				</div>
				</div>
				
				<div class="row static-info">
				<div class="col-md-4 name">
					Tinggi Bangunan :
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('tinggiA', (isset($tinggiA) ? $tinggiA : ''))?> Meter || <?php echo set_value('tinggiB', (isset($tinggiB) ? $tinggiB : ''))?> Meter || <?php echo set_value('tinggiC', (isset($tinggiC) ? $tinggiC : ''))?> Meter || <?php echo set_value('tinggiD', (isset($tinggiD) ? $tinggiD : ''))?> Meter
				</div>
				</div>
				<?}else{?>
			<div class="row static-info">
				<div class="col-md-4 name">
					Fungsi Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('fungsi_bg', (isset($fungsi_bg) ? $fungsi_bg : ''))?> - <?php echo set_value('jns_bangunan', (isset($jns_bangunan) ? $jns_bangunan : ''))?>
				</div>
			</div>
			
			<div class="row static-info">
				<div class="col-md-4 name">
					Luas, Tinggi & Jumlah Lantai	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($databgn->luas_bgn) ? $databgn->luas_bgn : '')?> m<sup>2</sup>, dengan tinggi <?=(isset($databgn->tinggi_bgn) ? $databgn->tinggi_bgn : '')?> meter dan berjumlah <?=(isset($databgn->jml_lantai) ? $databgn->jml_lantai : '')?> lantai.
				</div>
			</div>
				<?}?>
			<?}?>
			<hr/>
			<?php
				echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : '';    
			?>
			<div class="tabbable-custom nav-justified">
				<ul id="tabdp3" class="nav nav-tabs nav-justified">
					<li class="active">
						<a href="#ps" data-toggle="tab">
						Penjadwalan Sidang</a>
					</li>
					<li style="display: none;">
						<a href="#doc" data-toggle="tab" >
						Dokumen</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="ps">
						<br>	
						<div  class="row">
							<input type="text" style="display: none;" name='id_penjadwalan' id='id_penjadwalan' value='<?php echo set_value('id_penjadwalan', (isset($id_penjadwalan) ? $id_penjadwalan : ''))?>' />
							<div class="col-md-6">										
								<form action="<?php echo site_url('Pengawas/SimpanJadwalKonsultasi/'.$id); ?>" role="form" method="post" id="jsnya" enctype="multipart/form-data">
									<div class="form-body">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group form-md-line-input">
													<div class="input-group">
														<span class="input-group-addon">
														<i class="fa fa-circle"></i>
														</span>
														<select class="form-control" name="konsultasi" id="konsultasi">
															<option value="" >Pilih</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
														</select>	
														<label for="form_control_1">Sidang ke</label>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group form-md-line-input">
													<?php 
														if (isset($tgl_konsultasi) && $tgl_konsultasi != '0000-00-00')
															$tgl =  tgl_eng_to_ind($tgl_konsultasi);
														else
															$tgl = '';
													?>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input class="form-control date-picker" id="tgl_konsultasi" name="tgl_konsultasi" type="text" value='<?=$tgl?>' data-date-format="yyyy-mm-dd" placeholder="2000/12/31"/>
														<label for="form_control_1">Tanggal Sidang</label>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group form-md-line-input">
													<div class="input-group">
														<span class="input-group-addon">
														<i class="fa fa-clock-o"></i>
														</span>
														<input name="jam_konsultasi" class="form-control" value='<?php echo set_value('jam_konsultasi', (isset($jam_konsultasi) ? $jam_konsultasi : ''))?>' id="jam_konsultasi" type="text" placeholder="00.00">
														<label for="form_control_1">Jam Sidang</label>	
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group form-md-line-input">
														<textarea class="form-control" rows="2" placeholder="Tempat / Keterangan" id="ket_konsultasi" name="ket_konsultasi" value='<?php echo set_value('ket_konsultasi', (isset($ket_konsultasi) ? $ket_konsultasi : ''))?>'></textarea>
														<label for="form_control_1">Tempat / Keterangan</label>
												</div>
											</div>
											<div class="col-md-12" style="display: none;">
												<div class="form-group form-md-line-input">
														<input name="email" class="form-control" value='<?php echo set_value('email', (isset($email) ? $email : ''))?>' id="email" type="text" placeholder="00.00">
														<input name="noreg" class="form-control" value='<?php echo set_value('noreg', (isset($nomor_registrasi) ? $nomor_registrasi : ''))?>' id="noreg" type="text" placeholder="00.00">
														<label for="form_control_1">email</label>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group form-md-line-input">	
													
													<input style="display: none;" name="dir_file_u" id="dir_file_u" onchange='cokok()'>
													<input type="file" class="form-control" name="d_file_u" id="d_file_u" onchange='cokok()'>
													<label for="form_control_1">Unggah Undangan Sidang</label>
												</div>
											</div>	
										</div>
									</div>
									<?php echo form_submit('upload','Simpan Jadwal Sidang','class="btn blue-hoki btn-block"');	?>
								</form>	
							</div>
							<div class="col-md-6">										
								<form role="form">
									<div class="form-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group form-md-line-input">
													<input  style="display: none;" name='jmlPegawai' id='jmlPegawai' value="<?=set_value('jmlPegawai',isset($jmlPegawai) ? $jmlPegawai : '0')?>">
													<input  style="display: none;" name='jumPegUp' id='jumPegUp' value="<?=set_value('jmlPegawai',isset($jmlPegawai) ? $jmlPegawai : '')?>">
													<table class="table table-bordered table-striped table-hover">
														<thead>
															<tr class="info">
																<th><center>#</center></th>
																<th>Nama Tim TABG / Teknis</th>
																<th>Unsur</th>
																<th>Bidang Keahlian</th>
																<th>Kualifikasi</th>
															</tr>
														</thead>
														<tbody id="daftar_pegawai">
															<?php 
															$idpeg = '';
															if (isset($jmlPegawai) && $jmlPegawai > 0) { 
																for($j=0;$j<$jmlPegawai;$j++) { 
																?>
																<tr id="list_peg-<?=$j?>">
																	<td><input style="display: none;" name='id_peg-<?=$j?>' id='id_peg-<?=$j?>' value='<?=$result_peg[$j]['id_personal']?>'></td>
																	<?	
																		if (isset($result_peg[$j]['glr_depan']) && trim($result_peg[$j]['glr_depan']) != '')
																			$glrdpn = $result_peg[$j]['glr_depan'].' ';
																		else
																			$glrdpn = '';
																					
																		if (isset($result_peg[$j]['glr_belakang']) && trim($result_peg[$j]['glr_belakang']) != '')
																			$glrblk = ', '.$result_peg[$j]['glr_belakang'];
																		else
																			$glrblk = '';
																					
																		if (isset($result_peg[$j]['nama_personal']) && trim($result_peg[$j]['nama_personal']) != '')
																			$nma = $result_peg[$j]['nama_personal'];
																		else
																			$nma = '';
																					
																		$namapeg = $glrdpn . $nma . $glrblk;	
																	?>
																	<td><input style="display: none;" name='nama_peg-<?=$j?>' id='nama_peg-<?=$j?>' value='<?=$namapeg?>'><? echo $namapeg;?></td>
																	<td><input style="display: none;" name='unsur-<?=$j?>' id='unsur-<?=$j?>' value='<?=$result_peg[$j]['nama_unsur']?>'><? echo $result_peg[$j]['nama_unsur'];?></td>
																	<td><input style="display: none;" name='bidang-<?=$j?>' id='bidang-<?=$j?>' value='<?=$result_peg[$j]['nama_bidang']?>'><? echo $result_peg[$j]['nama_bidang'];?></td>
																	<td><input style="display: none;" name='keahlian-<?=$j?>' id='keahlian-<?=$j?>' value='<?=$result_peg[$j]['nama_keahlian']?>'><? echo $result_peg[$j]['nama_keahlian'];?></td>
																</tr>
																<?php 
																	$idpeg .= $result_peg[$j]['id_personal']."~";
																}
															} ?>
														</tbody>
													</table>	
												</div>
											</div>
										</div>
									</div>
								</form>		
							</div>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<hr/>
										<table class="table table-bordered table-striped table-hover">
											<tbody>
												<tr class="info">
													<th><center>Sidang Ke</center></th>
													<th><center>Tanggal</center></th>
													<th><center>Jam</center></th>
													<th><center>Tempat / Keterangan</center></th>
													<th><center>Berkas Undangan</center></th>
													<th><center>Aksi</center></th>
												</tr>
												<?php
												if($jumdata_penjadwalan==0){?>
													<td colspan=5>
													<br>
													<div class="alert alert-danger" align="center">
														<strong>Pemberitahuan !</strong> ANDA BELUM MEMPUNYAI JADWAL SIDANG AKTIF, MOHON INPUT DAFTAR SIDANG.
													</div>
													</td>
												<?}else{
													$no= 1;
													for($i=0;$i<count($results_penjadwalan);$i++) {
												?>
													<tr id="record">
														<td ><center><?php echo $results_penjadwalan[$i]['konsultasi'];?></center></td>
														<td ><?php echo tgl_eng_to_ind($results_penjadwalan[$i]['tgl_konsultasi']);?></td>
														<td ><?php echo $results_penjadwalan[$i]['jam_konsultasi'];?></td>	
														<td ><?php echo $results_penjadwalan[$i]['ket_konsultasi'];?></td>
														<? if($results_penjadwalan[$i]['dir_file_undangan'] != null){?>
															<td align="center">
																<a href="javascript:void(0);" class="btn btn-success btn-sm" title="Lihat Berkas" onClick="javascript:popWin('<?php echo base_url('file/konsultasi/'.$id.'/Jadwal/Undangan/'.$results_penjadwalan[$i]['dir_file_undangan']);?>')"><span class="glyphicon glyphicon-file"></span></a>
															</td>	
														<?}else{?>
															<td align="center">
																<? echo " Tidak Ada Berkas";?>
															</td>
														<?}?>
														<? if($results_penjadwalan[$i]['hsl_konsultasi'] != null){?>
															<td align="center">
																<a style="display: block;"  class="btn btn-success btn-sm" title=""><span class="glyphicon glyphicon-trash" readonly></span></a>
															</td>	 
														<?}else{?>
															<td align="center">
																<a style="display: block;" href="<?php echo site_url('penjadwalan/HapusJadwal/'.$results_penjadwalan[$i]['id_jadwal']);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Jadwal Sidang?')" title="Hapus Jadwal"><span class="glyphicon glyphicon-trash"></span></a>
																<? if($results_penjadwalan[$i]['konsultasi'] !='1'){?>||
																<a style="display: block;" href="<?php echo site_url('penjadwalan/RollBack/'.$results_penjadwalan[$i]['id_jadwal']);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan mengembalikan Permohonan kembali ke Pemohon Agar melengkapi kekurangan?')" title="Roll Back"><span class="glyphicon glyphicon-trash"></span></a>
																<?}?>
															</td>
														<?}?>
													</tr>
													<?php  $no++;
													} 
												} ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>


<!-- /.modal -->
<div id="hasilsidangnya" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
        </div>
        <!-- /.modal-content -->
	</div>
</div>	
<script type="text/javascript">
	
	$('#d_file_jad').change(function() {
    var filename_jad = $(this).val();
    var lastIndex = filename_jad.lastIndexOf("\\");
    if (lastIndex >= 0) {
        filename_jad = filename_jad.substring(lastIndex + 1);
    }
    $('#filename_jad').val(filename_jad);
	});
	
	function popWin(x){
	url = x;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
	}
	
	function cokok(){
		
		$('#dir_file_u').val(d_file_u.value);
	}
	
	function cokek(){
		
		$('#dir_file_dok').val(d_file_dok.value);
	}
	
	function cocok(){
		
		$('#dir_file1').val(d_file1.value);
	}
	
	function coxek(){
		
		$('#dir_file_x').val(d_file_x.value);
	}
	
	function Xwin(id){
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('penjadwalan/hasil_sidangnya/')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(){
                    	$('#responsive').modal('show');
						$('[name="x_id_p"]').val(data.id_penjadwalan);
						$('[name="x_sidangke_p"]').val(data.sidang_ke);
            		});
                }
            });
            return false;
        };
	
	$(function () {    
	$("#jsnya").validate({
	    // Specify the validation rules
	    rules: {
			sidang_ke: "required",
			tanggal_sidang: "required",
			jam_sidang: "required",
			
	    },
	        highlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	    },
	        unhighlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	    },
	      errorClass: 'help-block',
	    messages: {
			sidang_ke: "Pilih Sidang",
			tanggal_sidang: "Tentukan Tanggal Sidang",
			jam_sidang: "Tentukan Jam Sidang",
			
	    },    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	});
	
	$(function () {    
	 // Setup form validation on the #register-form element
	$("#simaknya").validate({
	    // Specify the validation rules
	    rules: {
			sidang_ke: "required",
			jns_tabg: "required",
			no_dok: "required",
			tanggal_dok: "required",
			
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
			sidang_ke: "Pilih Sidang",
			jns_tabg: "Tentukan Jenis",
			no_dok: "Masukan Nomor Dokumen",
			tanggal_dok: "Tentukan Tanggal Dokumen",
			
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	});
</script>