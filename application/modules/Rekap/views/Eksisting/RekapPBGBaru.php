<script type="text/javascript">
function resetCari() {	
	var url = "<?php echo base_url() . index_page() ?>Rekap/PBG/";
	$('#loading').fadeIn();
	$.getJSON( baseHref + 'Rekap/killSession/' ,
		function() {
			window.location.replace(url);
		}
	);
	$('#loading').fadeOut();
}
</script>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-globe"></i>Rekap Permohonan PBG Bangunan Gedung </div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<?php echo form_open('Rekap/PBG',array('name'=>'frmListRekapInformasi', 'id'=>'frmListRekapInformasi')); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Status Permohonan</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<select class="form-control select2me" name="status">
									<option value="">Semua</option>
									<option value="1" <?php if(isset($status) && $status == 1) echo "selected";?>>Pemeriksaan Kelengkapan Dokumen</option>
									<option value="2" <?php if(isset($status) && $status == 2) echo "selected";?>>Konsultasi</option>
									<option value="3" <?php if(isset($status) && $status == 3) echo "selected";?>>Retribusi</option>
									<option value="4" <?php if(isset($status) && $status == 4) echo "selected";?>>Dinas Perizinan (DPMPTSP)</option>
									<option value="5" <?php if(isset($status) && $status == 5) echo "selected";?>>PBG Telah Diserahkan Ke Pemilik</option>
								</select>
							</div>
						</div>
					</div>
					<!--<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Status Perda Retribusi</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<select class="form-control select2me" name="status_perda">
									<option value="">Semua</option>
									<option value="1" <?php if(isset($status) && $status == 1) echo "selected";?>>Sudah Memiliki Perda Retribusi</option>
									<option value="2" <?php if(isset($status) && $status == 2) echo "selected";?>>Sudah Memiliki Perda Retribusi</option>
								</select>
							</div>
						</div>
					</div>-->
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b></b></label>
						<div class="col-md-9">
							<div class="col-md-12">
								<input  type="submit" class="btn green" id="search" name="search" value="Pencarian">
								<button type="submit" class="btn green" onclick="resetCari()">Reset</button>
							</div>
						</div>
					</div>
			    </div>
		    </div>
			<table class="table table-striped table-bordered table-hover" id="sample_1">
                <tbody>
					<tr class="warning">
						<th rowspan="2" class="info">No</th>
						
						<th rowspan="2" class="info"><center>Kabupaten/Kota</center></th>
						<th rowspan="2" class="info"><center>Perda Retribusi PBG</center></th>
						<th rowspan="2" class="info"><center>Permohonan PBG</center></th>
						<th colspan="3" class="info"><center>Proses Dinas Teknis</center></th>
						<th colspan="3" class="info"><center>Proses Dinas Perizinan</center></th>
						<th rowspan="2" class="info"><center>Ditolak</center></th>
					</tr>
					<tr>
						<th class="danger"><center>Kelengkapan Dokumen</center></th>
						<th class="info"><center>Konsultasi</center></th>
						<th class="danger"><center>Retribusi</center></th>
						<th class="info"><center>Pembayaran</center></th>
						<th class="danger"><center>Validasi Pembayaran</center></th>
						<th class="info"><center>Terbit</center></th>
					</tr>
					<?php if ($jum_data==0){ ?>
						<tr><td class="clcenter" colspan="5">Data is Empty</td></tr>
					<?php } else {
						$i= 1;
						$loksblm = '';
						$Retribusi= 0;
						$Konsultasi = 0;
						$DinasPerizinan = 0;
						$Pembayaran = 0;
						$Kadis = 0;
						$Diserahkan = 0; 
						$Ditolak = 0;
						$Permohonan = 0; 
						$t_DinasTeknis= 0; 
						$t_Diserahkan = 0;
						$t_total =0; 
						if (isset($status) == ''){
							$status2 = 0;
						} else {
							$status2 = $status;
						}
						foreach ($result as $row) {;
							if ($i % 2== 0 )
								$clss = "event";
							else
								$clss = "event2"; 
								$Verifikasi	= $row->Verifikasi;
								$Konsultasi = $row->Konsultasi;
								$Retribusi = $row->Retribusi;
								$Pembayaran = $row->Pembayaran;
								$DinasPerizinan = $row->DinasPerizinan;
								$Kadis = $row->Kadis;
								$Diserahkan = $row->Diserahkan;
								$Ditolak = $row->Ditolak;
								$Permohonan = $row->Permohonan;
								$t_Verifikasi += $Verifikasi ;
								$t_Konsultasi += $Konsultasi;
								$t_Retribusi += $Retribusi;
								$t_Pembayaran += $Pembayaran;
								$t_Kadis += $Kadis;
								$t_Diserahkan += $Diserahkan;
								$t_Ditolak += $Ditolak;
								$t_Permohonan += $Permohonan;
								$t_total = $t_Verifikasi + $unset + $t_DinasPerizinan + $t_Diserahkan;

								if($row->Status_Perda == '1'){
									$Perda ="Sudah Memiliki";
									$class = "label label-sm label-info";
								}else{
									$Perda ="Belum Memiliki";
									$class = "label label-sm label-danger";
								}
							?>		  
							<tr class="<?=$clss?>" id="record">
								<td class="clcenter"><?php echo $i?></td>	
														
								<td class="clleft"><?php echo $row->nama_kabkota; ?></td>
								<td>
									<span class="<?php echo $class; ?>"<center><?php echo $Perda; ?></center></span>
								</td>
								<td class="clleft">
									<center><?php echo  $Permohonan; ?></b></center>
								</td>
								<td><center>
                                    <?php if ($Verifikasi == 0){ ?>0<?php } else { ?>
										<?php echo $Verifikasi;?>
									<?php } ?></center>
								</td>										
								<td><center>
                                    <?php if ($Konsultasi == 0){ ?>0<?php } else { ?>
										<?php echo $Konsultasi;?>
									<?php } ?></center>
								</td>
								<td><center>
									<?php if ($Retribusi == 0){?>0<?php } else { ?>
										<?php echo $Retribusi;?>
									<?php }?></center>
								</td>
								<td><center>
									<?php if ($Pembayaran == 0){?>0<?php } else { ?>
										<?php echo $Pembayaran;?>
									<?php }?></center>
								</td>
								<td><center>
									<?php if ($Kadis == 0){?>0<?php } else { ?>
										<?php echo $Kadis;?>
									<?php }?></center>
								</td>
								<td>
									<center>
									<?php if ($Diserahkan == 0){?>0<?php } else { ?>
										<?php echo $Diserahkan;?>
									<?php }?></center>
								</td>
								<td>
									<center>
									<?php if ($Ditolak == 0){?>0<?php } else { ?>
										<?php echo $Ditolak;?>
									<?php }?></center>
								</td>
							</tr>
							<?php $i++;
						}?>
						<tr class="<?=$clss?>" id="record">
						    <td class="clcenter" colspan='3'><b>Total Permohonana</b></td>
							<td class="clcenter"><center><b><?php echo $t_Permohonan; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Verifikasi; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Konsultasi; ?></b></center></td>				
						    <td class="clcenter"><center><b><?php echo $t_Retribusi; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Pembayaran; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Pembayaran; ?></b></center></td>											
							<td class="clcenter"><center><b><?php echo $t_Diserahkan; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Ditolak; ?></b></center></td>
						</tr>
					<?php } ?>	
				</tbody>
            </table>
        </div>
    </div>
</div>

