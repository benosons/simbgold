<script type="text/javascript">
function cetak_hsl_pleno(id,hsl)
 {
	
	var url = "<?php echo base_url() . index_page() ?>penjadwalan/cetak_hsl_pleno/"+id+"/"+hsl; 
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
			<h4 align="center" class="caption-subject font-red bold uppercase">Data Pokok Permohonan <?=(isset($nomor_registrasi) ? $nomor_registrasi : '')?></h4><hr/>
			<div class="row static-info">
				<div class="col-md-4 name">
					Nama Pemohon	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($nama_pemohon) ? $nama_pemohon : '')?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Alamat Pemohon	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($alamat_pemohon) ? $alamat_pemohon : '');?>, Kec. <?=(isset($nama_kecamatan) ? $nama_kecamatan : '');?>, <?=(isset($nama_kabkota) ? $nama_kabkota : '');?>, <?=(isset($nama_provinsi) ? $nama_provinsi : '') ;?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Jenis Permohonan	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($nama_permohonan) ? $nama_permohonan : '')?>
				</div>
			</div>
		
			<div class="row static-info">
				<div class="col-md-4 name">
					Lokasi Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($alamat_bg) ? $alamat_bg : '');?>, Des/Kel. <?=(isset($kelurahan)? $kelurahan : '') ;?> Kec. <?=(isset($kecamatan) ? $kecamatan : '');?>, <?=(isset($nama_kabkota_bg) ? $nama_kabkota_bg : '');?>, <?=(isset($nama_provinsi_bg) ? $nama_provinsi_bg : '') ;?>
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
					<?=(isset($luas_bg) ? $luas_bg : '')?> m<sup>2</sup>, dengan tinggi <?=(isset($tinggi_bg) ? $tinggi_bg : '')?> meter dan berjumlah <?=(isset($lantai_bg) ? $lantai_bg : '')?> lantai.
				</div>
			</div>
				<?}?>
			<?}?>
			
			
			
			<?php
									echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : '';    
			?>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<form action="<?php echo site_url('retribusi/retribusi_form/'.$id_permohonan);?>" class="form-horizontal" role="form" method="post" id="ret_nya" enctype="multipart/form-data">
		<div class="portlet light">
			<div class="portlet-title">
				<h4 align="center" class="caption-subject font-red bold uppercase">.:: Indeks Terintegrasi ::.</h4><hr/>
				<div class="row">
										<div class="col-md-12">
										
								<table class="table table-bordered table-striped table-hover">
								<tbody>
								<tr class="info">
									<th><center>Sidang Ke</center></th>
									<th><center>Rekomendasi / Hasil Sidang</center></th>
									<th><center>Catatan</center></th>
									<th><center>Berkas Rekomendasi / Hasil Sidang</center></th>
								</tr>
								<?php
								if($jumdata_penjadwalan==0){?>
									<td colspan=4>
									<br>
									<div class="alert alert-danger" align="center">
										<strong>Pemberitahuan !</strong> ANDA BELUM MEMPUNYAI JADWAL SIDANG AKTIF, MOHON INPUT DAFTAR SIDANG.
									</div>
									</td>
								<?}else{
									$no= 1;
									for($i=0;$i<count($results_penjadwalan);$i++) {
										if($results_penjadwalan[$i]['status_perbaikan'] == 1){
											$status ="Dengan Perbaikan";
										}else if($results_penjadwalan[$i]['status_perbaikan'] == ''){
											$status ="Belum di Input";
										}else{
											$status ="Tanpa Perbaikan";
										}
								?>

								<tr>
									<td ><center><?php echo $results_penjadwalan[$i]['sidang_ke'];?></center></td>
									<td ><?php echo $status;?></td>
									<td ><?php echo $results_penjadwalan[$i]['catatan'];?></td>
									<td align="center">
										<?php
										if($results_penjadwalan[$i]['dir_file_jadwal'] != '') {?>
											<a href="javascript:void(0);" class="label label-success btn-sm" title="Lihat Berkas" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$id_permohonan.'/sidang_n_penilaian/rekomendasi_sidang/'.$results_penjadwalan[$i]['dir_file_jadwal']);?>')"><span class="glyphicon glyphicon-file"></span></a>
										<?}else{?>
											<a href="javascript:void(0);" class="label label-success btn-sm" title="Lihat Berkas" onClick="javascript:cetak_hsl_pleno('<?php echo $id_permohonan?>','<?php echo $results_penjadwalan[$i]['status_perbaikan']?>')"><span class="glyphicon glyphicon-file"></span></a>
										<?}?>
									</td>
								</tr>
								<?php  
										$no++;
								}}?>
								</tbody>
								</table>
								<input style="display: none;" name="id_penetapan_retribusi" class="form-control" value='<?php echo set_value('id_penetapan_retribusi', (isset($id_penetapan_retribusi) ? $id_penetapan_retribusi : ''))?>' id="id_penetapan_retribusi" type="text">
									<br>	
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-mail-forward"></i>
													</span>
													<select class="form-control" name="id_cara_penetapan" id="id_cara_penetapan" onchange="getcarapenetapan(this.value)">
												<option value="" <?php if($id_cara_penetapan == '') echo "selected";?>>Pilih</option>
												<option value="1" <?php if($id_cara_penetapan == '1') echo "selected";?>>Otomatis</option>
												<option value="2" <?php if($id_cara_penetapan == '2') echo "selected";?>>Manual</option>
													</select>
													<label for="form_control_1">Cara Penetapan Retribusi</label>
													
												</div>
											</div>
										</div>
										
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
												<?if($harga_satuan != '' || $harga_satuan != null){?>
													<?php
														$harga_satuan_convert = number_format($harga_satuan,0,'','.');
													?>
												<?}else{?>
													<?php
														$harga_satuan_convert = '';
													?>
												<?}?>
													<span class="input-group-addon">
													( Rp. )
													</span>
													<input name="harga_satuan" class="form-control" value='<?php echo set_value('harga_satuan_convert', (isset($harga_satuan_convert) ? $harga_satuan_convert : ''))?>' onblur="angka(this);getBagi(this.value);" onKeyup="angka(this);getBagi(this.value);" id="harga_satuan" type="text" placeholder="0-9">
																										
													<label for="form_control_1">Harga Satuan/HSbg </label>
													
												</div>
												<br>
											</div>
										</div>
										
										<div id="manual" style="">
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
											
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-file-pdf-o"></i>
													</span>
													<!--input type="file" class="form-control" name="d_file_undangan" id="d_file_undangan" >
													<input type="text" name="filename_undangan" id="filename_undangan" style="display: none;" <?php echo set_value('dir_file_perhitungan', (isset($dir_file_perhitungan) ? $dir_file_perhitungan : ''))?>-->
													
													<?if($id_penetapan_retribusi != '' || $id_penetapan_retribusi != null){?>
														<? if ($dir_file_edit_perhitungan != ""){ ?>
														<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$id_permohonan.'/retribusi/'.$dir_file_edit_perhitungan);?>')" class="btn default btn-md blue-stripe" >Berkas Penghitungan Retribusi</a>
														<?}else{?>
														<a class="btn default btn-md blue-stripe" disabled>Berkas Penghitungan Retribusi Kosong</a>
														<?}?>
													<?}else{?>
													<input style="display: none;" name="dir_file_perhitungan" id="dir_file_perhitungan" onchange='cekok()'>
													<input type="file" class="form-control" name="d_file_p" id="d_file_p" onchange='cekok()'>
													<label for="form_control_1">Berkas Penghitungan Retribusi</label>
													<?}?>
													
													
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
											
												<div class="input-group">
													
												<?if($besar_retribusi != '' || $besar_retribusi != null){?>
													<?php
														$besar_retribusi_convert = number_format($besar_retribusi,0,'','.');
													?>
												<?}else{?>
													<?php
														$besar_retribusi_convert = '';
													?>
												<?}?>
													<span class="input-group-addon">
													( Rp. )
													</span>
													<input size="20" name="besar_retribusi_convert" class="form-control" value='<?php echo set_value('besar_retribusi_convert', (isset($besar_retribusi_convert) ? $besar_retribusi_convert : ''))?>' onblur="angka(this);getBagi(this.value);" onKeyup="angka(this);getBagi(this.value);" id="besar_retribusi_convert" placeholder="0-9" type="text">
													<label for="form_control_1">Besar Retribusi</label>
													
												</div>
											</div>
										</div>
										
										</div>
										
										<div id="otomatis" style="display: none;">
										
										<div class="col-md-12">
										<table class="table table-bordered table-striped table-hover">
									
										
										<tr class="info">
											<th width="30%">Fungsi <?php echo $nama_fungsi; ?></th>
											<th>Indeks = <?php echo $index_fungsi; ?></th>
										</tr>
										<tr class="info">
											<th width="30%">Klasifikasi</th>
											<th>
											
											<table>
										<tr>
											<td>Kompleksitas</td>
											<td>:</td>
											<td>0.25 x <input size="3" class="input2" value='<?php echo $index_klasifikasi_bg;?>' type="text" readonly></td>
											
											</td>
											<td> = 
											
											<input size="6" class="input2" value='<?php $hasil = 0.25* $index_klasifikasi_bg; echo $hasil;?>' type="text" readonly>
											
											<?=(isset($klasifikasi_bg)? $klasifikasi_bg : '') ;?>
																						
										</tr>
										<tr>
											<td>Permanensi</td>
											<td>:</td>
											<td>0.20 x <input size="3" name="permanensi" class="input2" value='<?php echo set_value('permanensi', (isset($permanensi) ? $permanensi :0))?>' id="permanensi" type="text" readonly></td><td> =
											<input size="6" name="hasil_permanensi" class="input2" value='<?php echo set_value('hasil_permanensi', (isset($hasil_permanensi) ? $hasil_permanensi :''))?>' id="hasil_permanensi" type="text" readonly> <?php
							$selected = '';
							if(isset($id_permanensi) && trim($id_permanensi) != '')
								$selected = $id_permanensi;
							
							$js = 'id="list_klas_detail2" onchange="fhitung(this.value)"';							
							echo form_dropdown('list_klas_detail2',$listKlasDetail2,$selected,$js);
						?></td>
										</tr>
										<tr>
											<td>Resiko Kebakaran</td>
											<td>:</td>
											<td>0.15 x <input size="3" name="resiko_kebakaran" class="input2" value='<?php echo set_value('resiko_kebakaran', (isset($resiko_kebakaran) ? $resiko_kebakaran :0))?>' id="resiko_kebakaran" type="text" readonly></td><td> =
											<input size="6" name="hasil_resiko_kebakaran" class="input2" value='<?php echo set_value('hasil_resiko_kebakaran', (isset($hasil_resiko_kebakaran) ? $hasil_resiko_kebakaran :0))?>' id="hasil_resiko_kebakaran" type="text" readonly> <?php
							$selected = '';
							if(isset($id_resiko_kebakaran) && trim($id_resiko_kebakaran) != '')
								$selected = $id_resiko_kebakaran;
								
							$js = 'id="list_klas_detail3" onchange="fhitung(this.value)"';							
							echo form_dropdown('list_klas_detail3',$listKlasDetail3,$selected,$js);
						?></td>
										</tr>
										
										<tr>
											<td>Zonasi Gempa</td>
											<td>:</td>
											<td>0.15 x <input size="3" name="val_zonasi_gempa" class="input2" value='<?php echo set_value('val_zonasi_gempa', (isset($val_zonasi_gempa) ? $val_zonasi_gempa :0))?>' id="val_zonasi_gempa" type="text" readonly></td><td> =
											<input size="6" name="hasil_zonasi_gempa" class="input2" value='<?php echo set_value('hasil_zonasi_gempa', (isset($hasil_zonasi_gempa) ? $hasil_zonasi_gempa :0))?>' id="hasil_zonasi_gempa" type="text" readonly> <?php
							$selected = '';
							if(isset($id_zona_gempa) && trim($id_zona_gempa) != '')
								$selected = $id_zona_gempa;
								
							$js = 'id="list_klas_detail4" onchange="fhitung(this.value)"';							
							echo form_dropdown('list_klas_detail4',$listKlasDetail4,$selected,$js);
						?></td>
										</tr>
										<tr>
											<td>Lokasi</td>
											<td>:</td>
											<td>0.10 x <input size="3" name="lokasi" class="input2" value='<?php echo set_value('lokasi', (isset($lokasi) ? $lokasi :0))?>' id="lokasi" type="text" readonly></td><td> =
											<input size="6" name="hasil_lokasi" class="input2" value='<?php echo set_value('hasil_lokasi', (isset($hasil_lokasi) ? $hasil_lokasi :0))?>' id="hasil_lokasi" type="text" readonly> <?php
							$selected = '';
							if(isset($id_lokasi) && trim($id_lokasi) != '')
								$selected = $id_lokasi;
								
							$js = 'id="list_klas_detail5" onchange="fhitung(this.value)"';							
							echo form_dropdown('list_klas_detail5',$listKlasDetail5,$selected,$js);
						?></td>
										</tr>
										<tr>
											<td>Ketinggian Bangunan Gedung</td>
											<td>:</td>
											<td>0.10 x 
											<input size="3" class="input2" value='<?php echo $ketinggian;?>' type="text" readonly>
											</td>
											<td> = 
											<input size="6" class="input2" value='<?php $hasil_tinggi = 0.10* $ketinggian; echo $hasil_tinggi;?>' type="text" readonly>
											<?=(isset($hketinggian)? $hketinggian : '') ;?>
											</td>
											<!--td>0.10 x <input size="3" name="ketinggian_bg" class="input2" value='<?php echo set_value('ketinggian_bg', (isset($ketinggian_bg) ? $ketinggian_bg :0))?>' id="ketinggian_bg" type="text" readonly></td><td> =
											<input size="4" name="hasil_ketinggian_bg" class="input2" value='<?php echo set_value('hasil_ketinggian_bg', (isset($hasil_ketinggian_bg) ? $hasil_ketinggian_bg :0))?>' id="hasil_ketinggian_bg" type="text" readonly> <?php
							$selected = '';
							if(isset($id_ketinggian_bg) && trim($id_ketinggian_bg) != '')
								$selected = $id_ketinggian_bg;
								
							$js = 'id="list_klas_detail6" onchange="fhitung(this.value)"';							
							echo form_dropdown('list_klas_detail6',$listKlasDetail6,$selected,$js);
						?></td-->
										</tr>
										<tr>
											<td>Kepemilikan</td>
											<td>:</td>
											<td>0.05 x <input size="3" name="kepemilikan" class="input2" value='<?php echo set_value('kepemilikan', (isset($kepemilikan) ? $kepemilikan :0))?>' id="kepemilikan" type="text" readonly></td><td> =
											<input size="6" name="hasil_kepemilikan" class="hasil_kepemilikan" value='<?php echo set_value('hasil_kepemilikan', (isset($hasil_kepemilikan) ? $hasil_kepemilikan :0))?>' id="hasil_kepemilikan" type="text" readonly> <?php
							$selected = '';
							if(isset($id_kepemilikan) && trim($id_kepemilikan) != '')
								$selected = $id_kepemilikan;
								
							$js = 'id="list_klas_detail7" onchange="fhitung(this.value)"';							
							echo form_dropdown('list_klas_detail7',$listKlasDetail7,$selected,$js);
						?>
											</td>
										</tr>
										<tr>
											<td colspan="2"></td>
											<td colspan="3">_________________________</td>
										</tr>
										<tr>
											<td> </td>
											<td> </td>
											<td> </td>
											<td>&nbsp;&nbsp;&nbsp;<input size="6" name="jumlah" class="input2" value='<?php echo set_value('jumlah', (isset($jumlah) ? $jumlah :0))?>' id="jumlah" type="text" readonly></td>
										</tr>
									</table>
											
											</th>
										</tr>
										<tr class="info">
											<th width="30%">Waktu Penggunaan</th>
											<th><?php
							$selected = '';
							if(isset($id_waktu_penggunaan) && trim($id_waktu_penggunaan) != '')
								$selected = $id_waktu_penggunaan;
								
							$js = 'id="list_w_peng" onchange="fhitung(this.value)"';							
							echo form_dropdown('list_w_peng',$listWaktupeng,$selected,$js);
						?> = <input size="3" name="waktu" class="input2" value='<?php echo set_value('waktu', (isset($waktu) ? $waktu :0))?>' id="waktu" type="text" readonly></th>
										</tr>
										<tr class="info">
											<th width="30%">Indeks Terintegrasi</th>
											<th>
											
											<?php echo $index_fungsi; ?> x
											<input size="3" name="jumlah2" class="input2" value='<?php echo set_value('jumlah2', (isset($jumlah2) ? $jumlah2 :0))?>' id="jumlah2" type="text" readonly> x
											<input size="3" name="waktu" class="input2" value='<?php echo set_value('waktu2', (isset($waktu2) ? $waktu2 :0))?>' id="waktu2" type="text" readonly> =
											<input size="9" name="integrasi" class="input2" value='<?php echo set_value('integrasi', (isset($integrasi) ? $integrasi :0))?>' id="integrasi" type="text" readonly>
											
											
											</th>
										</tr>
										<tr class="success">
											<th width="30%">Besarnya Retribusi</th>
											<th>
											<?
												if($id_penetapan_retribusi != '' || $id_penetapan_retribusi != null){
											?>
												<?
												$test = $mretribusi->hitung_retribusi($id_penetapan_retribusi,$harga_satuan,$luas_bg,$index_fungsi,$index_klasifikasi_bg,$index_resiko_kebakaran,$index_permanensi,$index_zona_gempa,$index_lokasi,$ketinggian,$index_kepemilikan,$index_waktu_penggunaan);
												?>
												<span class="hightlight"><?=(isset($test)? $test : '...') ;?></span>		
											<?}else{?>
												<span class="hightlight">Luas Bangunan * Indeks Terintegrasi * 1,00 * HS<sub>bg</sub></span>
											<?}?>
											</th>
										</tr>
									
	</table>
						
						
					
						
										</div>
										</div>
				</div>
								<?if($id_penetapan_retribusi != '' || $id_penetapan_retribusi != null){?>
								
								<?}else{?>
								<?php echo form_submit('save','Simpan Retribusi','class="btn blue-hoki btn-block" id="tot1" ');	?>
								<?}?>
							
				
					
			</div>
		</div>
		</form>
	
	</div>
	
	<div class="col-md-6">
	<form action="<?php echo site_url('retribusi/retribusi_form/'.$id_permohonan);?>" class="form-horizontal" role="form" method="post" id="sk_rd" enctype="multipart/form-data">
		<div class="portlet light">
			<div class="portlet-title">
				<h4 align="center" class="caption-subject font-red bold uppercase">Surat Ketetapan Retribusi Daerah (SKRD)</h4><hr/>
				
				
				<div class="row">
										<input name="email" style="display: none;" class="form-control" value='<?php echo set_value('email', (isset($email) ? $email : ''))?>' id="email" type="text">
										<input name="noreg" style="display: none;" class="form-control" value='<?php echo set_value('noreg', (isset($nomor_registrasi) ? $nomor_registrasi : ''))?>' id="noreg" type="text" placeholder="00.00">
										<input name="retribusiXx" style="display: none;" class="form-control" value='<?php echo set_value('retribusiXx', (isset($besar_retribusi_convert) ? $besar_retribusi_convert : ''))?>' id="retribusiXx" type="text">
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
													<input name="no_skrd" class="form-control" value='<?php echo set_value('no_skrd', (isset($no_skrd) ? $no_skrd : ''))?>' id="no_skrd" type="text" placeholder="0-9/ABC">
													<label for="form_control_1">Nomor SKRD</label>
													
												</div>
											</div>
										</div>
										
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<?php 	if (isset($tanggal_skrd) && $tanggal_skrd != '0000-00-00')
																$tgl =  tgl_eng_to_ind($tanggal_skrd);
															else
																$tgl = '';
													?>
													<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
													</span>
													<input name="tanggal_skrd" placeholder="31-12-2000" class="form-control date-picker" data-date-format="dd-mm-yyyy" value='<?=$tgl?>' id="tanggal_skrd" type="text" onblur="hitungUmur(this.value)" onKeyup="hitungUmur(this.value)">
													<label for="form_control_1">Tanggal SKRD</label>
													
												</div>
												<br>
											</div>
										</div>
										
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
											
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-file-pdf-o"></i>
													</span>
													<? if (isset($dir_file_edit) != '' or $dir_file_edit != null){ ?>
													<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$id_permohonan.'/skrd/'.$dir_file_edit);?>')" class="btn default btn-md blue-stripe" >Berkas SKRD</a>
													
													<?}else{?>
													<input style="display: none;" name="dir_file" id="dir_file" onchange='cekik()'>
													<input type="file" class="form-control" name="d_file" id="d_file" onchange='cekik()'>
													<label for="form_control_1">File SKRD</label>
													<?}?>
												</div>
											</div>
										</div>
										
										
										
										
				</div>
								
								<!--?php echo form_submit('upload','Simpan Jadwal Sidang', 'class="btn blue-hoki btn-block"');	?-->
								<? if (isset($no_skrd) != '' or $no_skrd != null){ ?>
								
								<?}else{?>
								<?php echo form_submit('save_skrd','Simpan SKRD','class="btn blue-hoki btn-block"');	?>
								<?}?>
							
				
					
			</div>
		</div>
	</form>
	
	</div>
	
	<div class="col-md-6">
		<form action="<?php echo site_url('retribusi/retribusi_form/'.$id_permohonan);?>" class="form-horizontal" role="form" method="post" id="ss_rd" enctype="multipart/form-data">
		<div class="portlet light">
			<div class="portlet-title">
				<h4 align="center" class="caption-subject font-red bold uppercase">Surat Setoran Retribusi Daerah (SSRD)</h4><hr/>
				<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-circle"></i>
													</span>
													<input name="no_ssrd" placeholder="0-9/ABC" class="form-control" value="<?php echo set_value('no_ssrd', (isset($no_ssrd) ? $no_ssrd : ''))?>" id="no_ssrd" type="text">
													<label for="form_control_1">Nomor SSRD</label>
													
												</div>
											</div>
										</div>
										<input  style="display: none;" class="form-control" value="<?php echo set_value('id_ssrd', (isset($id_ssrd) ? $id_ssrd : ''))?>" name="id_ssrd" placeholder="Id SSRD">
										<input name="email" style="display: none;" class="form-control" value='<?php echo set_value('email', (isset($email) ? $email : ''))?>' id="email" type="text">
										<input name="noreg" style="display: none;" class="form-control" value='<?php echo set_value('noreg', (isset($nomor_registrasi) ? $nomor_registrasi : ''))?>' id="noreg" type="text" placeholder="00.00">
										<input name="retribusiXx" style="display: none;" class="form-control" value='<?php echo set_value('retribusiXx', (isset($besar_retribusi_convert) ? $besar_retribusi_convert : ''))?>' id="retribusiXx" type="text">
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<div class="input-group">
													<?php 	if (isset($tanggal_ssrd) && $tanggal_ssrd != '0000-00-00')
																$tgl1 =  tgl_eng_to_ind($tanggal_ssrd);
															else
																$tgl1 = '';
															?>
													<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
													</span>
													<input name="tanggal_ssrd" placeholder="31-12-2000" class="form-control date-picker" data-date-format="dd-mm-yyyy" value='<?=$tgl1?>' id="tanggal_ssrd" type="text" onblur="hitungUmur(this.value)" onKeyup="hitungUmur(this.value)">
													<label for="form_control_1">Tanggal SSRD</label>
													
												</div>
												<br>
											</div>
										</div>
										
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
											
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-file-pdf-o"></i>
													</span>
													<? if (isset($dir_file_edit_s) != '' or $dir_file_edit_s != null){ ?>
													<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$id_permohonan.'/ssrd/'.$dir_file_edit_s);?>')" class="btn default btn-md blue-stripe" >Berkas Bukti Pembayaran Retribusi</a>
													<input  style="display: none;" class="form-control" value="<?php echo set_value('dir_file_edit_s', (isset($dir_file_edit_s) ? $dir_file_edit_s : ''))?>" name="dir_file_edit_s" id="dir_file_edit_s" >
													<?}else{?>
													<input style="display: none;" name="dir_file_s" id="dir_file_s" onchange='cekuk()'>
													<input type="file" class="form-control" name="d_file_s" id="d_file_s" onchange='cekuk()'>
													<label for="form_control_1">File SSRD</label>
													<?}?>
												</div>
											</div>
										</div>
										
										
										
										
				</div>
								
								<!--?php echo form_submit('upload','Simpan Jadwal Sidang', 'class="btn blue-hoki btn-block"');	?-->
								<?php if ($validasi_retri == 1) {
								$cek = 'checked'; ?>
								<h3>
								<span class="label label-success"><input class="col-left" type="checkbox"  name="status_validasi_cetak2" value=1 <?=$cek;?> disabled> Pembayaran Terverifikasi dan IMB Siap Untuk Dicetak</span>
								</h3>
								<? } else { $cek = ''; ?>
								<h3>
								<span class="label label-danger"><input class="col-left" type="checkbox" name="status_validasi_cetak" value=1 <?=$cek;?>> Pembayaran Terverifikasi dan IMB Siap Untuk Dicetak</span>
								</h3>
								<?php echo form_submit('save_ssrd','Simpan SSRD','class="btn blue-hoki btn-block"');	?>
								<?php } ?>
								
								
							
				
					
			</div>
		</div>
	</form>
	
	</div>
	
</div>

<script type="text/javascript">
	
	function popWin(x){
	url = x;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
	}
	
	
	$(function () {    
	 // Setup form validation on the #register-form element
	$("#sk_rd").validate({
	    // Specify the validation rules
	    rules: {
	        no_skrd: "required",
			tanggal_skrd: "required",
			d_file: "required",
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
	        no_skrd: "Masukan Nomor Surat",
			tanggal_skrd: "Masukan Tanggal Surat",
			d_file: "Unggah File SKRD",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	});
	
	$(function () {    
	 // Setup form validation on the #register-form element
	$("#ret_nya").validate({
	    // Specify the validation rules
	    rules: {
	        harga_satuan: "required",
			id_cara_penetapan: "required",
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
	        harga_satuan: "Tentukan Harga Satuan",
			id_cara_penetapan: "Tentukan Cara Penetapan",
			
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	});
	
	$(function () {    
	 // Setup form validation on the #register-form element
	$("#ss_rd").validate({
	    // Specify the validation rules
	    rules: {
	        no_ssrd: "required",
			tanggal_ssrd: "required",
			status_validasi_cetak: "required",
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
			status_validasi_cetak: "Wajib Ceklis Pernyataan",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
	});


$(document).ready(function() {

var cara_penetapan = "<?=(isset($id_cara_penetapan) ? $id_cara_penetapan : '')?>";
getcarapenetapan(cara_penetapan);


});

function fhitung(vl){
	var nilai2 = document.getElementById('list_klas_detail2').value;
	var nilai3 = document.getElementById('list_klas_detail3').value;
	var nilai4 = document.getElementById('list_klas_detail4').value;
	var nilai5 = document.getElementById('list_klas_detail5').value;
	// var nilai6 = document.getElementById('list_klas_detail6').value;
	var nilai7 = document.getElementById('list_klas_detail7').value;
	var waktu = document.getElementById('list_w_peng').value;
	var hasil = 0.25 * <?php echo $index_klasifikasi_bg;?>;
	var isi2 =  nilai2.split(",");
	var hasil2 = 0.2*(isi2[1]);
	var isi3 =  nilai3.split(",");
	var hasil3 = 0.15*(isi3[1]);
	var isi4 =  nilai4.split(",");
	var hasil4 = 0.15*(isi4[1]);
	var isi5 =  nilai5.split(",");
	var hasil5 = 0.1*(isi5[1]);
	var hasil6 = 0.1 * <?php echo $ketinggian;?>;
	// var isi6 =  nilai6.split(",");
	// var hasil6 = 0.1*(isi6[1]);
	var isi7 =  nilai7.split(",");
	var hasil7 = 0.05*(isi7[1]);
	var isi7 =  nilai7.split(",");
	var nwaktu =  waktu.split(",");
	var jumlah = hasil+hasil2+hasil3+hasil4+hasil5+hasil6+hasil7;
	var waktup =(nwaktu[1]);

	document.getElementById('permanensi').value = (isi2[1]);
	document.getElementById('hasil_permanensi').value = (hasil2.toFixed(3));
	document.getElementById('resiko_kebakaran').value = (isi3[1]);
	document.getElementById('hasil_resiko_kebakaran').value = (hasil3.toFixed(3));
	document.getElementById('val_zonasi_gempa').value = (isi4[1]);
	document.getElementById('hasil_zonasi_gempa').value = (hasil4.toFixed(3));
	document.getElementById('lokasi').value = (isi5[1]);
	document.getElementById('hasil_lokasi').value = (hasil5.toFixed(3));
	// document.getElementById('ketinggian_bg').value = (isi6[1]);
	// document.getElementById('hasil_ketinggian_bg').value = (hasil6.toFixed(3));
	document.getElementById('kepemilikan').value = (isi7[1]);
	document.getElementById('hasil_kepemilikan').value = (hasil7.toFixed(3));
	document.getElementById('jumlah').value = (jumlah.toFixed(3));
	document.getElementById('jumlah2').value = (jumlah.toFixed(3));
	document.getElementById('waktu').value = (waktup);
	document.getElementById('waktu2').value = (waktup);
	var integrasi = <?php echo $index_fungsi; ?> * jumlah * waktup;
	document.getElementById('integrasi').value = (integrasi.toFixed(3));
}


function getcarapenetapan(v){
	if(v == '1'){
		document.getElementById('otomatis').style.display="block";
		document.getElementById('manual').style.display="none";
	}else if(v == '2'){
		document.getElementById('otomatis').style.display="none";
		document.getElementById('manual').style.display="block";
	}else{
		document.getElementById('otomatis').style.display="none";
	}
}

function cekok(){
		$('#dir_file_perhitungan').val(d_file_p.value);
		
	}
function cekik(){
		
		$('#dir_file').val(d_file.value);
	}
function cekuk(){
		
		$('#dir_file_s').val(d_file_s.value);
	}

</script>