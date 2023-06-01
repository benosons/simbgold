<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
			<h4 align="center" class="caption-subject font-red bold uppercase">Data Pokok Permohonan <?=(isset($no_konsultasi) ? $no_konsultasi : '')?></h4><hr/>
			<h5 class="caption-subject font-red bold uppercase">Data Pemilik</h5>
			<div class="row static-info">
				<div class="col-md-4 name">Nama Pemilik</div>
				<div class="col-md-8 value"><?=(isset($nm_pemilik) ? $nm_pemilik : '');?></div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">Alamat Pemilik</div>
				<div class="col-md-8 value">
					<?=(isset($alamat) ? $alamat : '');?>, Kec. <?=(isset($nm_kecamatan) ? $nm_kecamatan : '');?>, <?=(isset($nm_kabkota) ? ucwords(strtolower($nm_kabkota)) : '');?>, <?=(isset($nm_provinsi) ? $nm_provinsi : '') ;?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">Nomor Telp/Hp</div>
				<div class="col-md-8 value"><?=(isset($no_kontak) ? $no_kontak : '');?></div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">Alamat Email</div>
				<div class="col-md-8 value"><?=(isset($email) ? $email : '');?></div>
			</div>
			<div class="row static-info">
				<div class="col-md-4 name">No. Identitas</div>
				<div class="col-md-8 value"><?=(isset($no_identitas) ? $no_identitas : '');?></div>
			</div>
			<br>
			<h5 class="caption-subject font-red bold uppercase">Data Umum Bangunan Gedung</h5>
			<div class="row static-info">
				<div class="col-md-4 name">Jenis Konsultasi Bangunan</div>
				<div class="col-md-8 value"><?=(isset($nm_konsultasi) ? $nm_konsultasi : '')?></div>
			</div>
			<?php if($id_jenis_permohonan =='11'){ ?>
					<div class="row static-info">
						<div class="col-md-4 name">Data Bangunan Gedung Kolektif</div>
						<div class="col-md-8 value">
							<table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn">
								<tr>
									<th>Tipe</th>
									<th>Luas (m<sup>2</sup>)</th>
									<th>Tinggi</th>
									<th>Lantai</th>
									<th>Jumlah Unit</th>
								</tr>
								<?php
								$tipe = json_decode($tipeA);
								$luas = json_decode($luasA);
								$tinggi = json_decode($tinggiA);
								$lantai = json_decode($lantaiA);
								$jumlah = json_decode($jumlahA);
								$bangunan = array();
								foreach ($tipe as $noo => $val) {
									if ($val != "")
									$bangunan['tipe'][$noo] = $val;
								}
								foreach ($luas as $noo => $val) {
									if ($val != "")
									$bangunan['luas'][$noo] = $val;
								}
								foreach ($tinggi as $noo => $val) {
									if ($val != "")
									$bangunan['tinggi'][$noo] = $val;
								}
								if (!empty($lantai))
								foreach ($lantai as $noo => $val) {
									if ($val != "")
									$bangunan['lantai'][$noo] = $val;
								}
								if (!empty($jumlah))
								foreach ($jumlah as $noo => $val) {
									if ($val != "")
									$bangunan['jumlah'][$noo] = $val;
								}
								$no = 0;
								$LuasBg = 0;
								$LuasTotal = 0;
								if (!empty($bangunan)) {
									foreach ($bangunan['tipe'] as $dt) {
										$no++; 
										$LuasBg += $bangunan['luas'][$no]*$bangunan['jumlah'][$no];
										$LuasType = $bangunan['luas'][$no]*$bangunan['jumlah'][$no];
										$LuasTotal  = $LuasBg;
										?>
										<tr id="tr-tipe<?php echo $no ?>">
											<td class="clcenter"><?php echo form_input('tipeA[' . $no . ']', $bangunan['tipe'][$no], 'style="width:90px;" id="posisi' . $no . '" class="posisi' . $no . ' form-control"'); ?></td>
											<td class="clcenter"><?php echo form_input('luasA[' . $no . ']', $bangunan['luas'][$no], 'style="width:90px;" id="luas' . $no . '" class="luas' . $no . ' form-control"'); ?></td>
											<td class="clcenter"><?php echo form_input('tinggiA[' . $no . ']', $bangunan['tinggi'][$no], 'style="width:90px;" id="tinggi' . $no . '" class="tinggi' . $no . ' form-control"'); ?></td>
											<td class="clcenter"><?php echo form_input('lantaiA[' . $no . ']', !empty($bangunan['lantai'][$no]) ? $bangunan['lantai'][$no] : '', 'style="width:90px;" id="lantai' . $no . '" class="lantai' . $no . ' form-control"'); ?></td>
											<td class="clcenter"><?php echo form_input('jumlahA[' . $no . ']', !empty($bangunan['jumlah'][$no]) ? $bangunan['jumlah'][$no] : '', 'style="width:90px;" id="jumlah' . $no . '" class="jumlah' . $no . ' form-control"'); ?></td>
										</tr>
									<?php }
								} else { ?>
									<tr id="tr-tipe">
										<td class="clcenter"><?php echo form_input('tipeA[1]', '', 'style="width:85px;" id="posisi1" class="posisi1 form-control"'); ?></td>
										<td class="clcenter"><?php echo form_input('luasA[1]', '', 'style="width:85px;" id="luas1" class="unit1 form-control"'); ?></td>
										<td class="clcenter"><?php echo form_input('tinggiA[1]', '', 'style="width:85px;" id="tinggi1" class="tinggi1 form-control"'); ?></td>
										<td class="clcenter"><?php echo form_input('lantaiA[1]', '', 'style="width:85px;" id="lantai1" class="tinggi1 form-control"'); ?></td>
										<td class="clcenter"><?php echo form_input('jumlahA[1]', '', 'style="width:85px;" id="lantai1" class="tinggi1 form-control"'); ?></td>
									</tr>
								<?php } ?>
							</table>
						</div>
								</div>
					<div class="row static-info">
						<div class="col-md-4 name">Total Luas Bangunan Kolektif</div>
						<div class="col-md-8 value">
							<?=(isset($LuasTotal)? $LuasTotal : '') ;?> m<sup>2</sup>
						</div>
					</div>
				<?php } else if($id_jenis_permohonan =='12'){ ?>
					<div class="row static-info">
						<div class="col-md-4 name">Data Bangunan Prasarana</div>
						<div class="col-md-8 value">
							Luas <?=(isset($luas_bgp) ? $luas_bgp : '')?> m<sup>2</sup>, 
							Tinggi <?=(isset($tinggi_bgp) ? $tinggi_bgp : '')?> Meter, 
							
						</div>
					</div>
				<?php } else { ?>
					<div class="row static-info">
						<div class="col-md-4 name">Jenis Bangunan Gedung</div>
						<div class="col-md-8 value"><?=(isset($jns_bangunan) ? $jns_bangunan : '')?></div>
					</div>
					<div class="row static-info">
						<div class="col-md-4 name">Klasifikasi Bangunan Gedung</div>
						<div class="col-md-8 value"><?php echo set_value('klasifikasi_bg', (isset($klasifikasi_bg) ? $klasifikasi_bg : ''))?></div>
					</div>
					<div class="row static-info">
					<div class="col-md-4 name">Data Bangunan Gedung</div>
						<div class="col-md-8 value">
							Luas <?=(isset($luas_bgn) ? $luas_bgn : '')?> m<sup>2</sup>, 
							Tinggi <?=(isset($tinggi_bgn) ? $tinggi_bgn : '')?> Meter, 
							Jumlah Lantai <?=(isset($jml_lantai) ? $jml_lantai : '')?> Lantai
						</div>
					</div>
				<?php } ?>
				<div class="row static-info">
					<div class="col-md-4 name">Lokasi Bangunan Gedung</div>
					<div class="col-md-8 value">
						<?=(isset($almt_bgn)? $almt_bgn : '') ;?>, Kec. <?=(isset($nm_kec_bgn) ? $nm_kec_bgn : '');?>, <?=(isset($nm_kabkota_bgn) ? ucwords(strtolower($nm_kabkota_bgn)) : '');?>, <?=(isset($nm_prov_bgn) ? $nm_prov_bgn : '') ;?>
					</div>
				</div>	
			<br>
			<h5 class="caption-subject font-red bold uppercase">Konsultasi Tim Teknis/TABG</h5>
			<table class="table table-bordered table-striped table-hover">	
				<tbody>
					<tr style="padding-left: 5px; padding-bottom:3px; font-weight:bold">	
						<th colspan="3"><center>Jadwal Konsultasi</center></th>
						<th colspan="3"><center>Hasil Konsultasi</center></th>
					</tr>
					<tr>
						<th rowspan="1"><center>Konsultasi Ke</center></th>
						<th rowspan="1"><center>Tgl dan Jam</center></th>
						<th rowspan="1"><center>Hasil</center></th>
						<th rowspan="1"><center>Cat.Konsultasi</center></th>
						<th rowspan="1"><center>Hasil Perbaikan</center></th>
						<th><center>Berkas BA</center></th>
					</tr>
					<?php if(isset($jumdata_penjadwalan)==0){?>
						<tr>
								<td class="Center" colspan="6">Data is Empty</td>
						</tr>
					<?}else{
						$no= 1;
						for($i=0;$i<count($ResultsJadwal);$i++) {
							if ($i % 2== 0 )
								$clss = "event";
							else
								$clss = "event2";
							?>
							<tr class="<?=$clss?>" id="record">
								<td class="clcenter" style="vertical-align:middle;"><center><?php echo $ResultsJadwal[$i]['konsultasi'];?></center></td>
								<td class="clcenter" style="vertical-align:middle;"><?php echo tgl_eng_to_ind($ResultsJadwal[$i]['tgl_konsultasi']);?><br><?php echo $ResultsJadwal[$i]['jam_konsultasi'];?></td>
								<td class="clcenter" style="vertical-align:middle;"><?php echo $ResultsJadwal[$i]['hsl_konsultasi'];?></td>	
								<td class="clcenter" style="vertical-align:middle;"><?php echo $ResultsJadwal[$i]['cat_konsultasi'];?></td>
								<td class="clcenter" style="vertical-align:middle;">
									<?php if($ResultsJadwal[$i]['hsl_konsultasi'] == '1') {
										echo "ADA";
									}else if($ResultsJadwal[$i]['hsl_konsultasi'] == '2'){
										echo "TIDAK ADA";
									}?>
								</td>
								<td class="clcenter" >
									<center>
										<?if($ResultsJadwal[$i]['dir_file_konsultasi'] != ''){?>
										<a href="javascript:void(0);" class="label label-success btn-sm" title="Lihat Berkas" onClick="javascript:popWin('<?php echo base_url('public/uploads/penilaian/berita_acara/'.$ResultsJadwal[$i]['dir_file_konsultasi']);?>')"><span class="glyphicon glyphicon-file"></span>Unduh</a>
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
			<?php if($status >='16'){?>
			<h4 class="caption-subject font-red bold uppercase" align="center">Besar Retribusi Rp. <?php if(isset($harganya) == 0){ echo '-';}else{echo number_format($harganya,0,'','.');}?> </h4>
			<?}?>
			<br>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" onclick="return confirm('Yakin Ingin Keluar?')" data-dismiss="modal" class="btn red"> X Tutup</button>
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
	url = "<?php echo base_url() . index_page() ?>file/IMB/pengajuan_imb/"+id+"/"+"data_tanah"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

</script>