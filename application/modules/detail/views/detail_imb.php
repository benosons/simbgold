<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
			<h4 align="center" class="caption-subject font-red bold uppercase">Data Pokok Permohonan <?=(isset($nomor_registrasi) ? $nomor_registrasi : '')?></h4><hr/>
			
			
			<h5 class="caption-subject font-red bold uppercase">Data Pemilik</h5>

			<div class="row static-info">
				<div class="col-md-4 name">
					Nama Pemilik	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($nama) ? $nama : '');?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Alamat Pemilik	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($jalan) ? $jalan : '');?>, Kec. <?=(isset($nama_kec) ? $nama_kec : '');?>,<br> <?=(isset($nama_kabkota) ? $nama_kabkota : '');?>, <?=(isset($nama_provinsi) ? $nama_provinsi : '') ;?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Nomor Telp / Hp	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($no_tlpn) ? $no_tlpn : '');?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Alamat Email	:
				</div>
				<div class="col-md-8 value">
					<p class="font-red"><i><?=(isset($email) ? $email : '');?></i></p>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Nomor Identitas	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($ktp) ? $ktp : '');?>
				</div>
			</div>
			
			
					
			<div class="row static-info">
				<div class="col-md-4 name">
					Kepemilikan	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($usaha) ? $usaha : '');?>
				</div>
			</div>
					<? if (isset($usaha2) != null){?>
					
					
					<?}else{?>
					
					<?}?>
			<br>
			<h5 class="caption-subject font-red bold uppercase">Data Umum Bangunan Gedung</h5>
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
					Nama Bangunan	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($nama_bangunan) ? $nama_bangunan : '')?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Klasifikasi Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('klasifikasi_bg', (isset($klasifikasi_bg) ? $klasifikasi_bg : ''))?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Lokasi Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?=(isset($jalan_lokasi)? $jalan_lokasi : '') ;?>, Kec. <?=(isset($nama_kecamatan_bg) ? $nama_kecamatan_bg : '');?>,<br> <?=(isset($nama_kabkota_bg) ? $nama_kabkota_bg : '');?>, <?=(isset($nama_provinsi_bg) ? $nama_provinsi_bg : '') ;?>
				</div>
			</div>
			
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
			
			<? if(trim($tsarana) == 5){?>
			
			<div class="row static-info">
				<div class="col-md-4 name">
					Prasarana	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('prasarana', (isset($prasarana) ? $prasarana : ''))?>
				</div>
			</div>
			
			<div class="row static-info">
				<div class="col-md-4 name">
					Luas Bangunan Prasarana	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('luas_prasarana', (isset($luas_prasarana) ? $luas_prasarana : ''))?> M<sup>2</sup>
				</div>
			</div>
			
			<div class="row static-info">
				<div class="col-md-4 name">
					Tinggi Bangunan Prasarana	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('tinggi_prasarana', (isset($tinggi_prasarana) ? $tinggi_prasarana : ''))?> Meter
				</div>
			</div>
			
			<?}else{?>
				<? if(trim($id_kolektif) == 1){?>
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
					Luas Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('luas_bg', (isset($luas_bg) ? $luas_bg : ''))?> M<sup>2</sup>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Ketinggian Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('tinggi_bg', (isset($tinggi_bg) ? $tinggi_bg : ''))?> Meter
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Jumlah Lantai Bangunan Gedung	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('lantai_bg', (isset($lantai_bg) ? $lantai_bg : ''))?> Lantai
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Luas Basement	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('luas_basement', (isset($luas_basement) ? $luas_basement : ''))?> 
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">
					Jumlah Lantai Basement	:
				</div>
				<div class="col-md-8 value">
					<?php echo set_value('lantai_basement', (isset($lapis_basement) ? $lapis_basement : ''))?> 
				</div>
			</div>
				<?}?>
			<?}?>
			<br>
			<h5 class="caption-subject font-red bold uppercase">Data Tanah</h5>
			<table class="table table-bordered table-striped table-hover">
					<tbody>
						<tr style="padding-left: 5px; padding-bottom:3px;  font-weight:bold">
							<th><center>No.</center></th>
							<th><center>Jenis Dokumen</center></th>
							<th><center>Nomor Dokumen</center></th>
							<th><center>Tgl. Dokumen</center></th>
							<th><center>Luas Tanah (m<sup>2</sup>)</center></th>
							<th><center>Atas Nama</center></th>
							<th><center>Lokasi</center></th>
							<th><center>Berkas</center></th>
							<th><center>Berkas Izin<br>Pemanfaatan</center></th>
						</tr>

						<?php
							if(isset($jmltanah)==0){?>
								<tr>
								<td class="clcenter" colspan="9">Data is Empty</td>
								</tr>
							<?}else{
								$no= 1;
								for($i=0;$i<count($result_tanah);$i++) {
									if ($i % 2== 0 )
										$clss = "event";
									else
									$clss = "event2";
						?>
							<tr class="<?=$clss?>" id="record">
								<td style="vertical-align:middle;"><center><?php echo $no ?></center></td>
								<td style="vertical-align:middle;"><?php echo $result_tanah[$i]['jenis_dokumen'];?></td>
								<td style="vertical-align:middle;"><?php echo $result_tanah[$i]['no_dok'];?></td>
								<td style="vertical-align:middle;"><?php echo tgl_eng_to_ind($result_tanah[$i]['tanggal_dok']);?></td>
								<td style="vertical-align:middle;"><?php echo $result_tanah[$i]['luas_tanah'];?></td>
								<td style="vertical-align:middle;"><?php echo $result_tanah[$i]['atas_nama_dok'];?></td>
								<td style="vertical-align:middle;"><?php echo $result_tanah[$i]['lokasi_tanah']; ?>, Kec. <?php echo $result_tanah[$i]['nama_kecamatan']; ?>, <?php echo $result_tanah[$i]['nama_kabkota']; ?>, Prov. <?php echo $result_tanah[$i]['nama_provinsi']; ?></td></td>
				
								<td class="clcenter">
									<center>
										<?if($result_tanah[$i]['dir_file'] != ''){?>
										<a href="javascript:void(0);" class="label label-success btn-sm" title="Lihat Berkas" onClick="javascript:GetPdfTanah('<?php echo $id_permohonan ?>','<?php echo $result_tanah[$i]['id_permohonan_detail_tanah']?>','<?php echo $result_tanah[$i]['dir_file']?>')"><span class="glyphicon glyphicon-file"></span>Unduh</a>
										<?}?>
									</center>
								</td>
								<td class="clcenter">
									
									<center>
										<?if($result_tanah[$i]['dir_file_phat'] != ''){?>
										<a href="javascript:void(0);" class="label label-success btn-sm" title="Lihat Berkas" onClick="javascript:GetPdfTanah('<?php echo $id_permohonan ?>','<?php echo $result_tanah[$i]['id_permohonan_detail_tanah']?>','<?php echo $result_tanah[$i]['dir_file_phat']?>')"><span class="glyphicon glyphicon-file"></span>Unduh</a>
										<?}?>
									</center>
								</td>
							</tr>
							<?php
								$no++;
								} // endfor result
							} // endif jum_data
							?>
							</tbody>
			</table>
			<br>
			<h5 class="caption-subject font-red bold uppercase">Daftar Tim Teknis</h5>
				<table class="table table-bordered table-striped table-hover">	
								<tbody>
								<?php if(isset($id_pemanfaatan_bg) == 1){ $nama = 'Nama-nama TABG';}else{$nama = 'Nama-nama Tim Teknis';}?>
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
			<br>
			<h5 class="caption-subject font-red bold uppercase">Penilaian Tim Teknis/Sidang TABG</h5>
				<table class="table table-bordered table-striped table-hover">	
							<tbody>
								<tr style="padding-left: 5px; padding-bottom:3px; font-weight:bold">
										
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
										<th><center>Berkas BA</center></th>
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
									
									<td class="clcenter" style="vertical-align:middle;"><center><?php echo $results_penjadwalan[$i]['sidang_ke'];?></center></td>
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
									
									<td class="clcenter" >
										<center>
										<?if($results_penjadwalan[$i]['dir_file_jadwal'] != ''){?>
										<a href="javascript:void(0);" class="label label-success btn-sm" title="Lihat Berkas" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$id_permohonan.'/sidang_n_penilaian/rekomendasi_sidang/'.$results_penjadwalan[$i]['dir_file_jadwal']);?>')"><span class="glyphicon glyphicon-file"></span>Unduh</a>
										<?}?>
										</center>
									</td>	
								</tr>
								<?php  
										$no++;
									} // endfor result
								} // endif jum_data
								?>
							</tbody>
						</table>
			<br>
			<h4 class="caption-subject font-red bold uppercase" align="center">Besar Retribusi Rp. <?php if(isset($harganya) == 0){ echo '-';}else{echo number_format($harganya,0,'','.');}?> </h4>
			
			<br>
			<h4 class="caption-subject font-red bold uppercase" align="center">Nomor & Tanggal IMB <br><?php echo set_value('no_imb',(isset($no_imb)?$no_imb:''))?> & <?php echo set_value('tgl_imb',(isset($tgl_imb)?$tgl_imb:''))?></h4>
			
			
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
function GetPdf(id_bg,f){
	url = "<?php echo base_url() . index_page() ?>file/IMB/pengajuan_imb/"+id+"/"+"sidang_n_penilaian"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

function popWin(x){
	url = x;
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

</script>