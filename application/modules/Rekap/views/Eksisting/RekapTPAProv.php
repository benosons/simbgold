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
		<div class="caption"><i class="fa fa-globe"></i>Rekap Jumlah TPA di Per Kab/Kota di Indonesia </div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<?php echo form_open('Rekap/TPAProv',array('name'=>'frmListRekapInformasi', 'id'=>'frmListRekapInformasi')); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Status TPA</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<select class="form-control select2me" name="status">
									<option value="">Semua</option>
									<option value="1" <?php if(isset($status) && $status == 1) echo "selected";?>>Belum Diverifikasi</option>
									<option value="2" <?php if(isset($status) && $status == 2) echo "selected";?>>Sudah Diverifikasi</option>
									<option value="3" <?php if(isset($status) && $status == 3) echo "selected";?>>Didaftarkan Pemda</option>
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
						<th>Nama Provinsi</th>
						<th>Belum di Verifikasi</th>
                        <th>Sudah DiVerifikasi</th>
						<th>Didaftarkan Pemda</th>
						<th>Total</th>
					</tr>
					<?php if ($jum_data==0){ ?>
						<tr><td class="clcenter" colspan="5">Data is Empty</td></tr>
					<?php } else {
						$i= 1;
						$loksblm = '';
						$BelumVer= 0; 
						$SudahVer = 0;
						$Diserahkan = 0;  
						$t_BelumVer= 0; 
						$t_SudahVer = 0; 
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
								$BelumVer = $row->BelumVer;
								$SudahVer = $row->SudahVer;
								$Pemda = $row->Pemda;
								$t_BelumVer += $BelumVer ;
								$t_SudahVer += $SudahVer;
								$t_Pemda += $Pemda;
								$t_total = $t_BelumVer + $t_SudahVer + $t_Pemda;
							?>		  
							<tr class="<?=$clss?>" id="record">
								<td class="center"><?php echo $i?></td>								
								<td class="clleft"><?php echo $row->nama_provinsi; ?></td>										
								<td class="center">
                                    <?php if ($BelumVer == 0){ ?>0<?php } else { ?>
										<?php echo $BelumVer;?>
									<?php } ?>
								</td>
								<td class="clcenter">
									<?php if ($SudahVer == 0){?>0<?php } else { ?>
										<?php echo $SudahVer;?>
									<?php }?>
								</td>
								<td class="clcenter">
									<?php if ($Pemda == 0){?>0<?php } else { ?>
										<?php echo $Pemda;?>
									<?php }?>
								</td>
								<td class="clcenter"><b><u><a href="<?=base_url().index_page()?>Rekap/DataDetail/<?php echo $row->id_kabkot; ?>/<? echo $status2;?>">
								<?php echo  $DinasTeknis + $SudahVer + $Pemda; ?></b></td>
							</tr>
							<?php $i++;
						}?>
						<tr class="<?=$clss?>" id="record">
						    <td class="clcenter" colspan='2'><b>Total Calon TPA/TPA</b></td>				
						    <td class="clcenter"><b><?php echo $t_BelumVer; ?></b></td>
							<td class="clcenter"><b><?php echo $t_SudahVer; ?></b></td>
							<td class="clcenter"><b><?php echo $t_Pemda; ?></b></td>												
							<td class="clcenter"><b><?php echo $t_total; ?></b></td>
						</tr>
					<?php } ?>	
				</tbody>
            </table>
        </div>
    </div>
</div>

