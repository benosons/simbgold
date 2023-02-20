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
		<div class="caption"><i class="fa fa-globe"></i>Rekap Kepemilikan Akun Dinas</div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<?php echo form_open('Pusat/SLFEks',array('name'=>'frmListRekapInformasi', 'id'=>'frmListRekapInformasi')); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Status Kepemilikan Akun</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<select class="form-control select2me" name="status">
									<option value="">Semua</option>
									<option value="1" <?php if(isset($status) && $status == 1) echo "selected";?>>Sudah Memiliki Kedua Akun</option>
									<option value="2" <?php if(isset($status) && $status == 2) echo "selected";?>>Hanya Memiliki DPMPTSP</option>
                                    <option value="3" <?php if(isset($status) && $status == 3) echo "selected";?>>Hanya Memiliki Dinas Teknis</option>
                                    <option value="4" <?php if(isset($status) && $status == 4) echo "selected";?>>Belum Memiliki Kedua Akun</option>
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
						<th>Kabupaten/Kota</th>
						<th>DPMPTSP</th>
                        <th>Dinas Teknis</th>
					</tr>
					<?php if ($jum_data==0){ ?>
						<tr><td class="clcenter" colspan="5">Data is Empty</td></tr>
					<?php } else {
						$i= 1;
						$loksblm = '';
						$SLF= 0; $PBGSLF = 0; 
						$t_SLF= 0; $t_PBGSLF = 0; 
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
								$SLF = $row->SLF;
								$PBGSLF = $row->PBGSLF;
								$t_SLF += $SLF ;
								$t_PBGSLF += $PBGSLF;
								$t_total = $t_SLF + $t_PBGSLF;
							?>		  
							<tr class="<?=$clss?>" id="record">
								<td class="clcenter"><?php echo $i?></td>								
								<td class="clleft"><?php echo $row->nama_kabkota; ?></td>										
								<td class="clcenter">
                                    <?php if ($SLF == 0){ ?>0<?php } else { ?><u><a href="<?=base_url().index_page()?>rekap/rekap_detail/<?php echo $row->id_kabkot; ?>/1/<? echo $status2;?>">
								<?php echo $SLF;?><?}?></td>
								<td class="clcenter"><?if ($PBGSLF == 0){?>0<?}else{?><u><a href="<?=base_url().index_page()?>rekap/rekap_detail/<?php echo $row->id_kabkot; ?>/2/<? echo $status2;?>">
								<?php echo $PBGSLF;?><?}?></td>
									<td class="clcenter"><b><u><a href="<?=base_url().index_page()?>rekap/rekap_detail_all/<?php echo $row->id_kabkot; ?>/<? echo $status2;?>">
								<?php echo  $SLF + $PBGSLF; ?></b></td>
							</tr>
							<?php $i++;
						}?>
						<tr class="<?=$clss?>" id="record">
						    <td class="clcenter" colspan='2'><b>Total Permohonan</b></td>				
						    <td class="clcenter"><b><?php echo $t_SLF; ?></b></td>
							<td class="clcenter"><b><?php echo $t_PBGSLF; ?></b></td>											
							<td class="clcenter"><b><?php echo $t_total; ?></b></td>
						</tr>
					<?php } ?>	
				</tbody>
            </table>
        </div>
    </div>
</div>

