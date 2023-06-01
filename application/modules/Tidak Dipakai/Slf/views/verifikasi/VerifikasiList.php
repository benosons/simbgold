<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>List Data Verifikasi SLF
		</div>
		<div class="tools">
			<a href="javascript:;" class="reload"></a>
		</div>
	</div>
	<div class="portlet-body">
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<?php
				echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : '';    
			?>
            <thead>
	                <tr>
	                  <th>No</th>
	                  <th>Jenis Permohonan</th>
					  <th>Nomor Registrasi</th>
	                  <th>Nama Pemilik</th>
					  <th>Lokasi BG</th>
	                  <th>Status</th>
	                  <th>Verifikasi</th>
	                </tr>
            </thead>
            <tbody>
				<?php
				if($list_permohonan->num_rows() > 0){
                	$no = 1;
                	foreach ($list_permohonan->result() as $slf) {
						?>
						
						<?php
							if($slf->status_progress == ''){
								$clss = "danger";
							}elseif($slf->status_progress == 1){
								$clss = "danger";
							}elseif($slf->status_progress == 2){
								$clss = "warning";
							}elseif($slf->status_progress == 3){
								$clss = "warning";
							}elseif($slf->status_progress == 4){
								$clss = "info";
							}elseif($slf->status_progress == 19){
								$clss = "danger";
							}else{
								$clss = "success";
							}
						?>
						<tr class="<?=$clss?>">
							<td align="center"><?php echo $no++;?></td>
							<td><?php echo $slf->nama_permohonan;?></td>
							<td align="center"><?php echo $slf->no_registrasi_slf;?></td>
							<td align="center"><?php echo $slf->nama_pemilik;?></td>
							<td><?php echo $slf->alamat_bg;?></td>
							<td align="center">
							<?php if($slf->status_progress == 4){
									$class = "label label-sm label-info";
									$syarat = "Menunggu Validasi";
							}elseif($slf->status_progress == 19){
									$class = "label label-sm label-danger";
									$syarat = "Permohonan SLF Ditolak";
							}else{
								if($slf->status_progress >= 5){
									$class = "label label-sm label-success";
									$syarat = "Terverifikasi";
								}elseif ($slf->status_progress == 1){
									$class = "label label-sm label-danger";
									$syarat = "Belum Diverifikasi";
								}elseif ($slf->status_progress == 2){
									$class = "label label-sm label-warning";
									$syarat = "Menunggu Perbaikan";
								}elseif ($slf->status_progress == 3){
									$class = "label label-sm label-warning";
									$syarat = "Verifikasi Ulang";
								}
							};?>
								<span class="<?php echo $class;?>"><?php echo $syarat;?></span> 
							</td>
							
					  <?php  if ($slf->status_progress >= 4) { ?>
					  
					  <td align="center"><a href="#" class="btn btn-info btn-sm" title="Lihat Data" id="tombolinver" ><span class="glyphicon glyphicon-user"></span></a></td>
					  <?}else{?>
								<?php  if ($slf->status_progress == 2) { ?>
								<td align="center"><a href="#" class="btn btn-info btn-sm" title="Menunggu Perbaikan" id="tombolinver" ><span class="glyphicon glyphicon-user"></span></a></td>
								<?}else{?>
								<td align="center"><a href="#" onClick="href='<?php echo site_url('slf/FormVerifikasi/'.$slf->id_permohonan_slf.'/'.$slf->id_jenis_permohonan);?>'" class="btn btn-info btn-sm" title="Verifikasi Data" id="tombolver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-edit"></span></a></td>
								<?}?>
					  <?}?>
							
							
						</tr>
	                <?php			
	                }
	            }?>    
            </tbody>
        </table>
	</div>
</div>
<!-- /.modaledit -->
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-focus-on="input:first">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
        </div>
        <!-- /.modal-content -->
	</div>
</div>	
<script>
</script>
