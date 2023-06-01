<script type="text/javascript">
function resetCari() {	
	var url = "<?php echo base_url() . index_page() ?>Rekap/RekapUniversitas/";
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
		<div class="caption"><i class="fa fa-globe"></i>Rekap Jumlah Universitas</div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<?php echo form_open('Rekap/TPAProv',array('name'=>'frmListRekapInformasi', 'id'=>'frmListRekapInformasi')); ?>
			<!--<div class="row">
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
		    </div>-->
			<table class="table table-striped table-bordered table-hover" id="sample_1">
                <tbody>
					<tr class="warning">
						<th>No</th>
						<th>Nama Asosiasi Profei</th>
						<th><center>Total Pengajuan TPA</center></th>
                        <th><center>Sudah Diverifikasi</center></th>
						<th><center>Belum Diverifikasi</center></th>
						<th><center>Dikembalikan</center></th>
					</tr>
					<?php if ($jum_data==0){ ?>
						<tr><td class="clcenter" colspan="5">Data is Empty</td></tr>
					<?php } else {
						$i= 1;
						$loksblm = '';

                        $Total = 0;
						$BlmVer= 0; 
						$Dikembalikan = 0;
						$SdhVer = 0;

						$t_BlmVer= 0; 
						$t_Dikembalikan = 0;
						$t_Total =0; 
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
								$Total = $row->Total;
                                $SdhVer = $row->SdhVer;
								$BlmVer = $row->BlmVer;
								$Dikembalikan = $row->Dikembalikan;
                                
								$t_Total += $Total ;
                                $t_SdhVer += $SdhVer;
								$t_BlmVer += $BlmVer;
								$t_Dikembalikan += $Dikembalikan;
                            ?>		  
							<tr class="<?=$clss?>" id="record">
								<td><center><?php echo $i?></center></td>								
								<td><?php echo $row->nm_asosiasi; ?></td>										
								<td>
                                    <center>
                                        <?php if ($Total == 0){ ?>0<?php } else { ?>
                                            <?php echo $Total;?>
                                        <?php } ?>
                                    </center>
								</td>
                                <td>
                                    <center>
                                        <?php if ($SdhVer == 0){?>0<?php } else { ?>
                                            <?php echo $SdhVer;?>
                                        <?php }?> 
                                    </center>
                                </td>
								<td>
                                    <center>
                                        <?php if ($BlmVer == 0){?>0<?php } else { ?>
                                            <?php echo $BlmVer;?>
                                        <?php }?>
                                    </center>
								</td>
								<td>
                                    <center>
                                        <?php if ($Dikembalikan == 0){?>0<?php } else { ?>
                                            <?php echo $Dikembalikan;?>
                                        <?php }?>
                                    </center>
								</td>
								
							</tr>
							<?php $i++;
						}?>
						<tr class="<?=$clss?>" id="record">
						    <td colspan='2'><center><b>Total</b></center></td>				
						    <td><center><b><?php echo $t_Total; ?></b></center></td>
							<td><center><b><?php echo $t_SdhVer; ?></b></center></td>
							<td><center><b><?php echo $t_BlmVer; ?></b></center></td>												
							<td><center><b><?php echo $t_Dikembalikan; ?></b></center></td>
						</tr>
					<?php } ?>	
				</tbody>
            </table>
        </div>
    </div>
</div>

