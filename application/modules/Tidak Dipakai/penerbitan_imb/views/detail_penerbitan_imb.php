<script type="text/javascript">
function GetPdf(id_bg,f){
	url = "<?php echo base_url() . index_page() ?>file/Gambar/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

function GetPdfTanah(id,id_bg,f){
	//alert(id)
	url = "<?php echo base_url() . index_page() ?>file/IMB/pengajuan_imb/"+id+"/"+"data_tanah"+"/"+f;
	//url = "<?php echo base_url() . index_page() ?>file/permohonan/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

function edit_penjadwalan(id_penjadwalan){
	$('#textStat').fadeIn();
	$.ajax({
			url: baseHref + 'penjadwalan/edit_penjadwalan/<?=$this->uri->segment(3)?>/'+id_penjadwalan,
			type: 'POST',
			success: function( response ) {
				$('div#detail_penjadwalan').html('');
				$('div#detail_penjadwalan').html(response);
			}
		});
	$('#textStat').fadeOut();
}

function keluar(){
	setTimeout(window.close(),3000);
}
</script>	
	<center>
		<?php echo form_open_multipart('penjadwalan/penjadwalan_form/'.$id_permohonan,array('name'=>'frmpenjadwalan', 'id'=>'frmpenjadwalan')); ?>
			<div id="detail_penjadwalan">
			<div class="blank"></div> 
            <div class="spacer"></div>
			<div id="top"></div>
			<div id="confirm" class="confirm" style="display: none;"></div>	
			<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all" >
				<fieldset class="panel-form" >
					<dl>
						<dt>Jenis Permohonan</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('nama_permohonan', (isset($nama_permohonan) ? $nama_permohonan : ''))?>
						</dd>
					</dl><br><br>
					
					<dl>
						<dt>No. & Tgl. Permohonan/Registrasi</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">		
							<?php echo set_value('username',(isset($username)?$username:''))?> (<?php echo set_value('tgl_permohonan',(isset($tgl_permohonan)?$tgl_permohonan:''))?>)
						</dd>
					</dl><br><br>
					<dl>
						<dt>Nama Pemohon</dt>
						<dd class="dot2">:</dd>
						<dd class="col-right3">
							<?php echo set_value('nama',(isset($nama)?$nama:''))?>
						</dd>					
					</dl>
					<dl>
						<dt>No. Identitas</dt>
						<dd class="dot2">:</dd>
						<dd class="col-right3">
							<?php echo set_value('ktp',(isset($ktp)?$ktp:''))?>
						</dd>					
					</dl>
					<dl>
						<dt>No. Telepon/No. HP</dt>
						<dd class="dot2">:</dd>
						<dd class="col-right3">
							<?php echo set_value('no_tlpn',(isset($no_tlpn)?$no_tlpn:''))?>
						</dd>					
					</dl>
					<dl>
						<dt>Alamat Pemohon</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('jalan', (isset($jalan) ? $jalan : ''))?>, Kec. <?php echo set_value('nama_kec', (isset($nama_kec) ? $nama_kec : ''))?>, <?php echo set_value('nama_kabkota', (isset($nama_kabkota) ? $nama_kabkota : ''))?>, Prov <?php echo set_value('nama_provinsi', (isset($nama_provinsi) ? $nama_provinsi : ''))?>
						</dd>
					</dl>
					<?
						if($statusaha ==1){
							$usaha = "Perseorangan";
						}elseif ($statusaha ==2){
							$usaha = "Badan Usaha/Badan Hukum";
						}elseif($statusaha ==3){
							$usaha = "Pemerintah";
						}else{
							$usaha = "";
						}	
					?>
					<dl>
						<dt>Kepemilikan</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('usaha', (isset($usaha) ? $usaha : ''))?>
						</dd>
					</dl>
					<? if ($statusaha == 2){?>
					<dl>
						<dt>Nama Perusahaan/Pemerintah</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('nm_pershn', (isset($nm_pershn) ? $nm_pershn : ''))?>
						</dd>
					</dl>
					
					<dl>
						<dt>Jabatan dalam Perusahaan/ Pemerintah</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('jabdpershn', (isset($jabdpershn) ? $jabdpershn : ''))?>
						</dd>
					</dl>
					
					<dl>
						<dt>Alamat Perusahaan/Pemerintah</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('alamat_pershn', (isset($alamat_pershn) ? $alamat_pershn : ''))?>
						</dd>
					</dl>
					
					<?}else{?>
					
					<?}?>
				
				
				<h3 class="title">Data Umum Bangunan Gedung</h3>
					<dl>
						<dt>Alamat Lokasi Bangunan Gedung</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('alamat_bg', (isset($alamat_bg) ? $alamat_bg : ''))?>, Kec. <?php echo set_value('kecamatan', (isset($kecamatan) ? $kecamatan : ''))?>, Kab/Kota. <?php echo set_value('nama_kabkota_bg', (isset($nama_kabkota_bg) ? $nama_kabkota_bg : ''))?>, Prov. <?php echo set_value('nama_provinsi_bg', (isset($nama_provinsi_bg) ? $nama_provinsi_bg : ''))?> 
						</dd>
					</dl><br><br>
					<?
						if($id_prasarana_bg ==1){
							$prasarana = "Kolam/Reservoir bawah tanah";
						}elseif ($id_prasarana_bg ==2){
							$prasarana = "Menara";
						}elseif($id_prasarana_bg ==3){
							$prasarana = "Monument";
						}elseif($id_prasarana_bg ==4){
							$prasarana = "Instalasi/Gardu";
						}elseif($id_prasarana_bg ==5){
							$prasarana = "Reklame/Papan Nama";
						}		
					?>
					
					<?
						if($id_jenis_bg == 5){?>
						<dl>
							<dt>Fungsi Bangunan Prasarana</dt>
							<dd class="dot2">:</dd>
							<dd class="col-justify">			
								<?php echo set_value('prasarana', (isset($prasarana) ? $prasarana : ''))?>
							</dd>
						</dl><br><br>
						<?}else{?>
					<?
						if ($id_fungsi_bg == 3){?>
					<dl>
						<dt>Fungsi Bangunan Gedung</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('fungsi_bg', (isset($fungsi_bg) ? $fungsi_bg : ''))?> - <?php echo set_value('jns_bangunan', (isset($jns_bangunan) ? $jns_bangunan : ''))?>
						</dd>
					</dl>
					<br><br>						
						<?}else{?>
					<dl>
						<dt>Fungsi Bangunan Gedung</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('fungsi_bg', (isset($fungsi_bg) ? $fungsi_bg : ''))?>
						</dd>
					</dl><br><br>
						<?}?>
					<?}?>
					
					
					<?
						if($id_klasifikasi_bg == 1){
							$klasifikasi_bg = "Sederhana";
						}
						if($id_klasifikasi_bg == 2){
							$klasifikasi_bg = "Tidak Sederhana";
						}
						if($id_klasifikasi_bg == 3){
							$klasifikasi_bg = "Khusus";
						}
					?>
					<dl>
						<dt>Klasifikasi Bangunan Gedung</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('klasifikasi_bg', (isset($klasifikasi_bg) ? $klasifikasi_bg : ''))?>
						</dd>
					</dl><br><br>
					<?php
					if($id_jenis_bg == 5){?>
					<dl>
						<dt>Tinggi Bangunan Prasarana</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('tinggi_prasarana', (isset($tinggi_prasarana) ? $tinggi_prasarana : ''))?> Meter
						</dd>
					</dl><br><br>
					<?}else{?>
						<dl>
						<dt>Jumlah Lantai Bangunan Gedung</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('lantai_bg', (isset($lantai_bg) ? $lantai_bg : ''))?> Lantai
						</dd>
					</dl><br><br>
					<?}?>
					<?php
					if($id_jenis_bg != 5){?>
					<dl>
						<dt>Ketinggian Bangunan Gedung</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('tinggi_bg', (isset($tinggi_bg) ? $tinggi_bg : ''))?> Meter
						</dd>
					</dl><br><br>
					<?}else{?>
					<?}?>
					
					
					<dl>
						<dt>Luas Basement</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('luas_basement', (isset($luas_basement) ? $luas_basement : ''))?> -
						</dd>
					</dl><br><br>
					
					<dl>
						<dt>Jumlah Lantai Basement</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('lantai_basement', (isset($lantai_basement) ? $lantai_basement : ''))?> -
						</dd>
					</dl><br><br>
					<br><br>
							<!-- Begin Data Tanah -->
				<h3 class="title">Data Tanah</h3>
					<dl>
					<table class="tbl" align="center" border="0" cellpadding="2" cellspacing="1" width="100%">
					<tbody>
						<tr style="padding-left: 5px; padding-bottom:3px;  font-weight:bold">
							<th><center>No.</center></th>
							<th><center>Jenis Dokumen</center></th>
							<th><center>Nomor Dokumen</center></th>
							<th><center>Tgl. Dokumen</center></th>
							<th><center>Luas Tanah (m<sup>2</sup>)</center></th>
							<th><center>Atas Nama</center></th>
							<th><center>Lokasi</center></th>
							<th><center>File</center></th>
							<th><center>File Izin<br>Pemanfaatan</center></th>
						</tr>

						<?php
							if(isset($jumdata)==0){?>
								<tr>
								<td class="clcenter" colspan="7">Data is Empty</td>
								</tr>
							<?}else{
								$no= 1;
								for($i=0;$i<count($results);$i++) {
									if ($i % 2== 0 )
										$clss = "event";
									else
									$clss = "event2";
						?>
							<tr class="<?=$clss?>" id="record">
								<td class="clcenter" style="vertical-align:middle;"><?php echo $no ?></td>
								<td class="clleft" style="vertical-align:middle;"><?php echo $results[$i]['jenis_dokumen'];?></td>
								<td class="clleft" style="vertical-align:middle;"><?php echo $results[$i]['no_dok'];?></td>
								<td class="clcenter" style="vertical-align:middle;"><?php echo tgl_eng_to_ind($results[$i]['tanggal_dok']);?></td>
								<td class="clcenter" style="vertical-align:middle;"><?php echo $results[$i]['luas_tanah'];?></td>
								<td class="clcenter" style="vertical-align:middle;"><?php echo $results[$i]['atas_nama_dok'];?></td>
								<td class="clcenter" style="vertical-align:middle;"><?php echo $results[$i]['lokasi_tanah']; ?>, Kec. <?php echo $results[$i]['nama_kecamatan']; ?>, <?php echo $results[$i]['nama_kabkota']; ?>, Prov. <?php echo $results[$i]['nama_provinsi']; ?></td></td>
				
								<td class="clcenter">
									<a href="javascript:void(0);" onClick="javascript:GetPdfTanah('<?php echo $id_permohonan ?>','<?php echo $results[$i]['id_permohonan_detail_tanah']?>','<?php echo $results[$i]['dir_file']?>')" >
									<?php
										if($results[$i]['dir_file'] != ''){
										echo 'Download';
										}
									?>
									</a>
								</td>
								<td class="clcenter">
									<a href="javascript:void(0);" onClick="javascript:GetPdfTanah('<?php echo $id_permohonan ?>','<?php echo $results[$i]['id_permohonan_detail_tanah']?>','<?php echo $results[$i]['dir_file_phat']?>')" >
										<?php
											if($results[$i]['dir_file_phat'] != ''){
												echo 'Download';
											}
										?>
									</a>
								</td>
							</tr>
							<?php
								$no++;
								} // endfor result
							} // endif jum_data
							?>
							</tbody>
						</table>
					</dl>
				<!-- End Data Tanah -->
	
						<h3 class="title">Daftar Tim Teknis</h3>	
					<dl>
								<table class="tbl2" align="center" border="0" cellpadding="2" cellspacing="1" width="100%">			
								<tbody>
								<?php if($id_pemanfaatan_bg == 1){ $nama = 'Nama-nama TABG';}else{$nama = 'Nama-nama Tim Teknis';}?>
									<tr style="padding-left: 5px; padding-bottom:3px;  font-weight:bold">
										<th><center>#</center></th>
										<th><?=$nama?></th>
										<th>Unsur</th>
										<th>Bidang Keahlian</th>
										<th>Kualifikasi</th>
									</tr>
								</tbody>
								<tbody id="daftar_pegawai">
									<?php 
									$idpeg = '';
									if (isset($jmlPegawai) && $jmlPegawai > 0) { 
										for($j=0;$j<$jmlPegawai;$j++) { ?>
											<tr class='event' id="list_peg-<?=$j?>">
												<td><input type='hidden' name='id_peg-<?=$j?>' id='id_peg-<?=$j?>' value='<?=$result_peg[$j]['id_personal']?>'></td>
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
												<td><input type='hidden' name='nama_peg-<?=$j?>' id='nama_peg-<?=$j?>' value='<?=$namapeg?>'><? echo $namapeg;?></td>
												
												<td><input type='hidden' name='unsur-<?=$j?>' id='unsur-<?=$j?>' value='<?=$result_peg[$j]['nama_unsur']?>'><? echo $result_peg[$j]['nama_unsur'].' - '.$result_peg[$j]['nama_unsur_ahli'];?></td>
												<td><input type='hidden' name='bidang-<?=$j?>' id='bidang-<?=$j?>' value='<?=$result_peg[$j]['nama_bidang']?>'><? echo $result_peg[$j]['nama_bidang'];?></td>
												<td><input type='hidden' name='keahlian-<?=$j?>' id='keahlian-<?=$j?>' value='<?=$result_peg[$j]['nama_keahlian']?>'><? echo $result_peg[$j]['nama_keahlian'];?></td>
												
												
											</tr>
										<?php 
										$idpeg .= $result_peg[$j]['id_personal']."~";
										}
									} ?>
								</tbody>
								</table>						
					</dl>	
			
			
			<h3 class="title">Penilaian Tim Teknis/Sidang TABG</h3>
					<dl>
						<table class="tbl" align="center" border="0" cellpadding="2" cellspacing="1" width="100%">
							<tbody>
								<tr style="padding-left: 5px; padding-bottom:3px; font-weight:bold">
										<th rowspan="2"><center>No.</center></th>
										<th colspan="4"><center>Jadwal Sidang</center></th>
										<th colspan="3"><center>Hasil Sidang</center></th>
									</tr>
									<tr>
										<th rowspan="1"><center>Sidang Ke</center></th>
										<th rowspan="1"><center>Tgl</center></th>
										<th rowspan="1"><center>Jam</center></th>
										<th rowspan="1"><center>Keterangan</center></th>
										<th rowspan="1"><center>Perbaikan</center></th>
										<th rowspan="1"><center>Catatan Perbaikan</center></th>
										<th><center>File BA</center></th>
									</tr>
								<?php
								if(isset($jumdata_penjadwalan)==0){?>
									<tr>
										<td class="clcenter" colspan="8">Data is Empty</td>
									</tr>
								<?}else{
									$no= 1;
									for($i=0;$i<count($results_penjadwalan);$i++) {
										if ($i % 2== 0 )
											$clss = "event";
										else
											$clss = "event2";
								?>
								<tr class="<?=$clss?>" id="record">
									<td class="clcenter" style="vertical-align:middle;"><?php echo $no ?></td>
									<td class="clcenter" style="vertical-align:middle;"><?php echo $results_penjadwalan[$i]['sidang_ke'];?></td>
									<td class="clcenter" style="vertical-align:middle;"><?php echo tgl_eng_to_ind($results_penjadwalan[$i]['tgl_sidang']);?></td>
									<td class="clcenter" style="vertical-align:middle;"><?php echo $results_penjadwalan[$i]['jam_sidang'];?></td>	
									<td class="clcenter" style="vertical-align:middle;"><?php echo $results_penjadwalan[$i]['keterangan_sidang'];?></td>
									<td class="clcenter" style="vertical-align:middle;">
									<?php 
									if($results_penjadwalan[$i]['status_perbaikan'] == '1')
									{
									echo "ADA";
									}else if($results_penjadwalan[$i]['status_perbaikan'] == '2'){echo "TIDAK ADA";}?></td>
									<td class="clcenter" style="vertical-align:middle;"><?php echo $results_penjadwalan[$i]['catatan'];?></td>
									
									<td class="clcenter">
										<?if($results_penjadwalan[$i]['dir_file_jadwal'] != ''){?>
										<a href="javascript:void(0);" onClick="javascript:GetPdf('<?php echo $results_penjadwalan[$i]['id_penjadwalan']?>','<?php echo $results_penjadwalan[$i]['dir_file_jadwal']?>')" >
										<?php echo 'Download';?>
										</a>
										<?}?>
									</td>	
								</tr>
								<?php  
										$no++;
									} // endfor result
								} // endif jum_data
								?>
							</tbody>
						</table>
					</dl>
					<h3 class="title">Retribusi</h3>
					<dl>
						<dt>Retribusi (Rp)</dt>
						<dd class="dot2">:</dd>
						<dd class="col-right3">
							Rp. <?php if($besar_retribusi == 0){ echo '-';}else{echo number_format($besar_retribusi,0,'','.');}?> 
								
						</dd>					
					</dl>
					<h3 class="title">No. & Tgl. IMB</h3>
					<dl>
						<dt>No. & Tgl. IMB</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('no_imb',(isset($no_imb)?$no_imb:''))?>/<?php echo set_value('tgl_imb',(isset($tgl_imb)?$tgl_imb:''))?>
						</dd>
					</dl>
					
					<dl>
						<dt>Tgl Penyerahan</dt>
						<dd class="dot2">:</dd>
						<dd class="col-justify">			
							<?php echo set_value('tanggal_penyerahan_imb', (isset($tanggal_penyerahan_imb) ? $tanggal_penyerahan_imb : ''))?>
						</dd>
					</dl>
					
					
				<input type="button" name="back" value="Kembali" onclick="keluar()">
				</fieldset>	
			</fieldset>	
			</div>
			<div>	
				<div class="space-line"></div>
				<div class="blank"></div>
				<div class="spacer"></div> 
			</div>

		<?php echo form_close(); ?>
	</center>
