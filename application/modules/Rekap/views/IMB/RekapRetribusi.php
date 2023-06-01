<script type="text/javascript">

function resetCari() {	
	var url = "<?php echo base_url() . index_page() ?>rekap/retribusi/";
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
function CetakRekapExcel(id)
 {
	/*if (  $('#id_kabkot').val() != '') 
		par3 = $('#id_kabkot').val();
	else
		par3 = 'id_kabkot'; 
	 
	if (  $('#id_fungsi_bg').val() != '') 
		par4 = $('#id_fungsi_bg').val();
	else
		par4 = 'id_fungsi_bg';
	
	var uriParam =par3 + '/'+par4+'/';*/
	var url = "<?php echo base_url() . index_page() ?>rekap/cetak_excel/"; 
	swin = window.open(url,'win','scrollbars,width=45%,height=45%,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}
</script>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>Rekap Retribusi Permohonan IMB
		</div>
		<div class="tools">
			<a href="javascript:;" class="reload"></a>
		</div>
	</div>
		<div class="portlet-body">
			<div class="form-actions">
			<?php echo form_open('rekap/RekapRetribusi',array('name'=>'frmListRekapRetribusi', 'id'=>'frmListRekapRetribusi')); ?>
				<div class="row">
					<div class="col-md-12">
						<!--<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b>Nomor SK</b></label>
							<div class="col-md-9">
								<div class="col-md-5">
										<input type="text" class="form-control" name="cari" placeholder="Aa-Za / 0-9"/>
								</div>
							</div>
						</div>-->
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b>Fungsi Bangunan</b></label>
							<div class="col-md-9">
								<div class="col-md-5">
									<select class="form-control select2me" name="id_fungsi_bg">
										<option value="">Semua Fungsi</option>
										<option value="1" <?php if(isset($id_fungsi_bg) && $id_fungsi_bg == 1) echo "selected";?>>Fungsi Hunian</option>
										<option value="2" <?php if(isset($id_fungsi_bg) && $id_fungsi_bg == 2) echo "selected";?>>Fungsi Keagamaan</option>
										<option value="3" <?php if(isset($id_fungsi_bg) && $id_fungsi_bg == 3) echo "selected";?>>Fungsi Usaha</option>
										<option value="4" <?php if(isset($id_fungsi_bg) && $id_fungsi_bg == 4) echo "selected";?>>Fungsi Sosial dan Budaya</option>
										<option value="5" <?php if(isset($id_fungsi_bg) && $id_fungsi_bg == 5) echo "selected";?>>Fungsi Khusus</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b>Tanggal Permohonan</b></label>
							<div class="col-md-9">
								<div class="col-md-2">
									<input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="tanggalawal" value="<?=(isset($tanggalawal) ? $tanggalawal : '');?>" placeholder="1990-01-01"/>
								</div>
								<label class="control-label col-md-1"><center><b>s/d</b></center></label>
								<div class="col-md-2">
									<input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="tanggalakhir" value="<?=(isset($tanggalakhir) ? $tanggalakhir : '');?>" placeholder="1990-01-30"/>
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
	                  <th>Jenis Permohonan</th>
					  <th>Nomor Registrasi</th>
	                  <th>Nama Pemilik</th>
					  <th>Fungsi Bangunan</th>
					  <th>Lokasi BG</th>
	                  <th>Retribusi</th>
	                </tr>
					<?php
					if($dataimb->num_rows() > 0){
                	$no = 1;
					$t_Retribusi = 0;
                	foreach ($dataimb->result() as $imb) {
					?>
					<?php
						if($imb->status_progress == ''){
							$clss = "danger";
						}elseif($imb->status_progress == 1){
							$clss = "danger";
						}elseif($imb->status_progress == 2){
							$clss = "warning";
						}elseif($imb->status_progress == 3){
							$clss = "warning";
						}elseif($imb->status_progress == 4){
							$clss = "info";
						}else{
							$clss = "success";
						}
						
					?>
						<tr class="<?=$clss?>">
						  <td align="center"><?php echo $no++;?></td>
						  <td><?php echo $imb->nama_permohonan;?></td>
						  <td align="left"><?php echo $imb->nomor_registrasi;?></td>
						  <td align="left"><?php echo $imb->nama_pemohon;?></td>
						  <td><?php echo $imb->fungsi_bg;?></td>
						  <td><?php echo $imb->alamat_bg;?></td>
						  <td align="right">Rp.<?php  echo number_format($imb->retribusi_manual,0,'','.');?></td>
						</tr>
						<?php			
	                }
	            }?>
				
					<!--<tr class="" id="record">
						<td align="center" colspan='6'><b>Total</b></td>														
						<td align="right"><b>Rp.<?php  echo number_format($t_Retribusi,0,'','.');?></b></td>
					</tr>-->					
                </tbody>
             </table>
		</div>
</div>
<script>
  
  
 
</script>
