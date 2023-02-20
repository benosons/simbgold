<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>List Data Verifikasi Teknis SLF
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
				if($list_pemeriksaan->num_rows() > 0){
                	$no = 1;
                	foreach ($list_pemeriksaan->result() as $slf) {
						?>
						<?php
						
										if($slf->status_progress <= 6){
											$bgcolor="danger";
											$ustat="Belum Diperiksa";
										}elseif($slf->status_progress == 13){
											$bgcolor="warning";
											$ustat="Menunggu Verifikasi Lapangan";
										}elseif($slf->status_progress == 19){
											$bgcolor="danger";
											$ustat="Permohonan SLF Ditolak";
										}else{
											if($slf->status_progress == 7){
												$bgcolor="info";
												$ustat="Sudah Diperiksa";
											}else if($slf->status_progress == 8){
												$bgcolor="warning";
												$ustat="Perlu Perbaikan";
											}else if($slf->status_progress == 9){
												$bgcolor="warning";
												$ustat="Sudah Diperbaiki &<br> Belum Diperiksa Ulang" ;
											}else if($slf->status_progress == 10){
												$bgcolor="info";
												$ustat="Sudah Diperiksa Ulang";
											}else if($slf->status_progress >= 11){
												$bgcolor="success";
												$ustat="Selesai Pemeriksaan";
											}
										}
							
						?>
						<tr class="<?=$bgcolor?>">
							<td align="center"><?php echo $no++;?></td>
							<td><?php echo $slf->nama_permohonan;?></td>
							<td align="center"><?php echo $slf->no_registrasi_slf;?></td>
							<td align="center"><?php echo $slf->nama_pemilik;?></td>
							<td><?php echo $slf->alamat_bg;?></td>
							<td align="center">
								<?php echo $ustat;?>
							</td>
							<?php  if ($slf->status_progress == 19) { ?>
								<td align="center"><a href="#" class="btn btn-danger btn-sm" title="Permohonan SLF Ditolak" disabled="true" ><span class="glyphicon glyphicon-remove"></span></a></td>
							<?}else{?>
								<?php  if ($slf->status_progress <= 13 ) { ?>
									<td align="center"><a href="#" onClick="href='<?php echo site_url('slf/FormPemeriksaan/'.$slf->id_permohonan_slf.'/'.$slf->id_jenis_permohonan);?>'" class="btn btn-info btn-sm" title="Verifikasi Data" id="tombolver" ><span class="glyphicon glyphicon-edit"></span></a></td>
								<?}else{?>
									<td align="center"><a href="#" disabled="true" class="btn btn-info btn-sm" title="Verifikasi Data" id="tombolver" ><span class="glyphicon glyphicon-edit"></span></a></td>
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
