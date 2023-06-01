<script type="text/javascript">

function resetCari() {	
	var url = "<?php echo base_url() . index_page() ?>rekap/Informasi/";
	$('#loading').fadeIn();
	$.getJSON( baseHref + 'rekap/killSession/' ,
		function() {
			window.location.replace(url);
		}
	);
	$('#loading').fadeOut();
}
function cetakRekap()
 {
	var url = "<?php echo base_url() . index_page() ?>rekap/cetakRekapRetribusi/"; 
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

function cetakRekap2()
 {
	var url = "<?php echo base_url() . index_page() ?>rekap/cetak/"; 
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}
function cetakRekap3()
 {
	var url = "<?php echo base_url() . index_page() ?>rekap/cetak_excel/"; 
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}
</script>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>Rekap Permohonan IMB dengan SIMBG
		</div>
		<div class="tools">
			<a href="javascript:;" class="reload"></a>
		</div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<?php echo form_open('rekap/Informasi',array('name'=>'frmListRekapInformasi', 'id'=>'frmListRekapInformasi')); ?>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b>Status Permohonan IMB</b></label>
							<div class="col-md-9">
								<div class="col-md-5">
									<select class="form-control select2me" name="status">
										<option value=""></option>
										<option value="">Semua</option>
										<option value="1" <?php if(isset($status) && $status == 1) echo "selected";?>>Belum Terbit</option>
										<option value="2" <?php if(isset($status) && $status == 2) echo "selected";?>>Sudah Terbit</option>
									
									</select>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b>Periode Tanggal Permohonan IMB</b></label>
							<div class="col-md-9">
								<div class="col-md-2">
									<input type="text" class="form-control date-picker" data-date-format="dd/mm/yyyy" name="tanggalawal" value="" placeholder="01/01/1990"/>
								</div>
								<label class="control-label col-md-1"><center><b>s/d</b></center></label>
								<div class="col-md-2">
									<input type="text" class="form-control date-picker" data-date-format="dd/mm/yyyy" name="tanggalakhir2" placeholder="31/12/1990"/>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b>Periode Tanggal Penerbitan IMB</b></label>
							<div class="col-md-9">
								<div class="col-md-2">
									<input type="text" class="form-control date-picker" data-date-format="dd/mm/yyyy" name="tanggalawal" value="" placeholder="01/01/1990"/>
								</div>
								<label class="control-label col-md-1"><center><b>s/d</b></center></label>
								<div class="col-md-2">
									<input type="text" class="form-control date-picker" data-date-format="dd/mm/yyyy" name="tanggalakhir2" placeholder="31/12/1990"/>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b></b></label>
							<div class="col-md-9">
								<div class="col-md-12">
								<input  type="submit" class="btn green" id="search" name="search" value="Pencarian">
								<button type="submit" class="btn green" onclick="resetCari()">Reset</button>
								<!--<input 	type="button"  class="btn green" id =="cari" name="cari" onclick="CetakRekapExcel()" value="Cetak Excel">-->
								</div>
							</div>
						</div>
				</div>
			</div>
			<table class="table table-striped table-bordered table-hover" id="sample_1">
                <tbody>
					<tr>
						<th>No</th>
						<th>Kabupaten/Kota</th>
						<th>Non NIB</th>
						<th>Tidak Memiliki NIB</th>
						<th>Total</th>
					</tr>
					<?php
						if($jum_data==0){?>
						<tr>
							<td class="clcenter" colspan="5">Data is Empty</td>
						</tr>
						<?}else{
							$i= 1;
							$loksblm = '';
							$Non_NIB = 0; $Memiliki_NIB = 0; 
							$t_Non_NIB= 0; $t_Memiliki_NIB = 0; 
							$t_Memiliki_NIB2 =0; $t_Non_NIB2=0;
							if(isset($status) == ''){
								$status2 = 0;
							}else{
								$status2 = $status;
							}
							foreach ($result as $row) 
							{
								if ($i % 2== 0 )
									$clss = "event";
								else
									$clss = "event2";		
									$Non_NIB = $row->Non_NIB1+$row->Non_NIB2;
									$NIB = $row->Memiliki_NIB +$row->Memiliki_NIB2;
									$t_Non_NIB += $Non_NIB ;
									$t_Memiliki_NIB += $NIB;
									$t_total = $t_Non_NIB + $t_Memiliki_NIB;
							?>		  
							<tr class="<?=$clss?>" id="record">
								<td class="clcenter"><?php echo $i?></td>								
								<td class="clleft"><?php echo $row->nama_kabkota; ?></td>										
								<td class="center"><?if ($Non_NIB == 0){?>0<?}else{?><u><a href="<?=base_url().index_page()?>rekap/rekap_detail/<?php echo $row->id_kabkot; ?>/1/<? echo $status2;?>">
								<?php echo $Non_NIB;?><?}?></td>
									<td class="center"><?if ($NIB == 0){?>0<?}else{?><u><a href="<?=base_url().index_page()?>rekap/rekap_detail/<?php echo $row->id_kabkot; ?>/2/<? echo $status2;?>">
								<?php echo $NIB;?><?}?></td>
									<td class="center"><b><u><a href="<?=base_url().index_page()?>rekap/rekap_detail_all/<?php echo $row->id_kabkot; ?>/<? echo $status2;?>">
								<?php echo  $NIB + $Non_NIB; ?></b></td>
							</tr>
										<?php $i++;
								}?>
								<tr class="<?=$clss?>" id="record">
									<td class="clcenter" colspan='2'><b>Total</b></td>				
									<td class="clcenter"><b><?php echo $t_Non_NIB; ?></b></td>
									<td class="clcenter"><b><?php echo $t_Memiliki_NIB; ?></b></td>											
									<td class="clcenter"><b><?php echo $t_total; ?></b></td>
								</tr>
									<?
									}?>	
				</tbody>
            </table>
		</div>
	</div>
<script>
  
  
 
</script>
