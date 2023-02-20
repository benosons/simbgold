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
			<i class="fa fa-globe"></i>Rekap Retribusi Permohonan IMB
		</div>
		<div class="tools">
			<a href="javascript:;" class="reload"></a>
		</div>
	</div>
		<div class="portlet-body">
			<div class="form-actions">
			<?php echo form_open('rekap/Retribusi',array('name'=>'frmListRekapRetribusi', 'id'=>'frmListRekapRetribusi')); ?>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b>Nomor SK</b></label>
							<div class="col-md-9">
								<div class="col-md-5">
										<input type="text" class="form-control" name="cari" placeholder="Aa-Za / 0-9"/>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b>Fungsi Bangunan</b></label>
							<div class="col-md-9">
								<div class="col-md-5">
									<select class="form-control select2me" name="id_fungsi_bg">
										<option value=""></option>
										<option value="1">Semua Fungsi</option>
										<option value="2">Fungsi Hunian</option>
										<option value="3">Fungsi Keagamaan</option>
										<option value="4">Fungsi Usaha</option>
										<option value="5">Fungsi Sosial dan Budaya</option>
										<option value="6">Fungsi Khusus</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b>Tanggal Permohonan</b></label>
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
							<div class="col-md-9">
								<?php echo form_submit('search','Cari');?>
								<button type="submit" class="btn green" onclick="cari">Cari</button>
								<button type="submit" class="btn green" onclick="resetCari()">Reset</button>
								<button type="submit" class="btn green" onclick="cetakRekap3()">Cetak Excel </button>
							</div>
						</div>
				</div>
			</div>
			<table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
	                <tr>
	                  <th>No</th>
	                  <th>Jenis Permohonan</th>
					  <th>Nomor Registrasi</th>
	                  <th>Nama Pemilik</th>
					  <th>Lokasi BG</th>
	                  <th>Retribusi</th>
	                </tr>
                </thead>
                <tbody>
				<?php
					if($dataimb->num_rows() > 0){
                	$no = 1;
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
						  <td><?php echo $imb->alamat_bg;?></td>
						  <td align="right">Rp.<?php  echo number_format($imb->retribusi_manual,0,'','.');?></td>
						</tr>
						<?php			
	                }
	            }
	                ?>     
                </tbody>
             </table>
		</div>
</div>
<script>
  
  
 
</script>
