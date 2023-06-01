<script type="text/javascript">
function resetCari() {	
	var url = "<?php echo base_url() . index_page() ?>Rekap/SLFEks/";
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
		<div class="caption"><i class="fa fa-globe"></i>Rekap Permohonan Bangunan Gedung Eksisting</div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<?php echo form_open('Rekap/SLFEks',array('name'=>'frmListRekapInformasi', 'id'=>'frmListRekapInformasi')); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Status Permohonan Bangunan Eksisting</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<select class="form-control select2me" name="status">
									<option value="">Semua</option>
									<option value="1" <?php if(isset($status) && $status == 1) echo "selected";?>>Belum Terbit</option>
									<option value="2" <?php if(isset($status) && $status == 2) echo "selected";?>>Sudah Terbit</option>
								</select>
							</div>
						</div>
					</div>
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
						<th>No</th>
						<th>ID Kab/Kota</th>
						<th>Kabupaten/Kota</th>
						<th>Verifikasi Kelengkapan</th>
						<th>Dinas Teknis</th>
                        <th>Dinas Perizinan</th>
						<th>Diserahkan</th>
						<th>Total</th>
					</tr>
					<?php if ($jum_data==0){ ?>
						<tr><td class="clcenter" colspan="5">Data is Empty</td></tr>
					<?php } else {
						$i= 1;
						$loksblm = '';
						$Verifikasi= 0;
						$DinTek= 0; $DinPen = 0; $Diserahkan =0;
						$t_DinTek= 0; $t_DinPen = 0; $t_Diserahkan=0;
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
								$Verifikasi = $row->Verifikasi;	
								$DinTek = $row->DinTek;
								$DinPen = $row->DinPen;
								$Diserahkan = $row->Diserahkan;
								$t_Verifikasi += $Verifikasi;
								$t_DinTek += $DinTek ;
								$t_DinPen += $DinPen;
								$t_Diserahkan += $Diserahkan;
								$t_total = $t_Verifikasi + $t_DinTek + $t_DinPen + $t_Diserahkan;
							?>		  
							<tr class="<?=$clss?>" id="record">
								<td class="clcenter"><?php echo $i?></td>
								<td class="clcenter"><?php echo $row->id_kabkot;?></td>								
								<td class="clleft"><?php echo $row->nama_kabkota; ?></td>
								<td class="clcenter">
                                    <?php if ($Verifikasi == 0){ ?>0<?php } else { ?>

									<?php echo $Verifikasi;?><?}?>
								</td>									
								<td class="clcenter">
                                    <?php if ($DinTek == 0){ ?>0<?php } else { ?>

									<?php echo $DinTek;?><?}?>
								</td>
								<td class="clcenter">
									<?if ($DinPen == 0){ ?>0<?}else{ ?>
									<?php echo $DinPen;?><?}?>
								</td>
								<td class="clcenter"><?if ($Diserahkan == 0){ ?>0<?}else{ ?>
								<?php echo $Diserahkan;?><?}?>
								</td>
								<td class="clcenter"><b>
								<?php echo  $Verifikasi + $DinTek + $DinPen + $Diserahkan; ?></b>
								</td>
							</tr>
							<?php $i++;
						}?>
						<tr class="<?=$clss?>" id="record">
						    <td class="clcenter" colspan='3'><b>Total Permohonan</b></td>
							<td class="clcenter"><b><?php echo $t_Verifikasi; ?></b></td>				
						    <td class="clcenter"><b><?php echo $t_DinTek; ?></b></td>
							<td class="clcenter"><b><?php echo $t_DinPen; ?></b></td>
							<td class="clcenter"><b><?php echo $t_Diserahkan; ?></b></td>												
							<td class="clcenter"><b><?php echo $t_total; ?></b></td>
						</tr>
					<?php } ?>	
				</tbody>
            </table>
        </div>
    </div>
</div>

