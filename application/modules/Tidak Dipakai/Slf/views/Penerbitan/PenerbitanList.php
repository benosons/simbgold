<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>List Data Penerbitan SLF
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
				if($list_penerbitan->num_rows() > 0){
                	$no = 1;
                	foreach ($list_penerbitan->result() as $slf) {
						?>
						<?php
						if($slf->status == 1){
							$clss = "info";		
						}else{
							if($slf->status_data_administrasi == 1){
								$clss = "success";
							}elseif($slf->status_data_administrasi == 0){
								$clss = "warning";
							}else{
								$clss = "danger";
							}
						}?>
						<tr class="<?=$clss?>">
							<td align="center"><?php echo $no++;?></td>
							<td><?php echo $slf->nama_permohonan;?></td>
							<td align="center"><?php echo $slf->no_registrasi;?></td>
							<td align="center"><?php echo $slf->nama_pemilik;?></td>
							<td><?php echo $slf->alamat_bg;?></td>
							<td align="center"><?php
								if($slf->status == 1){
										$class = "label label-sm label-info";
										$syarat = "Menunggu Validasi";
								}else{
									if($slf->status_data_administrasi == 1){
										$class = "label label-sm label-success";
										$syarat = "Terverifikasi";
									}elseif ($slf->status_data_administrasi == 2){
										$class = "label label-sm label-warning";
										$syarat = "Perlu Perbaikan";
									}else{
										$class = "label label-sm label-danger";
										$syarat = "Belum Terverifikasi";
									}
								};?>
								<span class="<?php echo $class;?>"><?php echo $syarat;?></span> 
							</td>
							<?php  if ($slf->status_data_administrasi != 1) { ?>
							<!--td align="center"><a href="#" class="btn btn-success btn-sm" title="Verivikasi Data" id="tombolver" data-toggle="modal" data-target="#stack1"><span class="glyphicon glyphicon-edit"></span></a></td-->
							<td align="center"><a href="#" onClick="href='<?php echo site_url('slf/FormVerifikasi/'.$slf->id_permohonan_slf);?>'" class="btn btn-info btn-sm" title="Verifikasi Data" id="tombolver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-edit"></span></a></td>
							<?}else{?>
							<td align="center"><a href="#" onClick="href='<?php echo site_url('detail/detail_imb/'.$slf->id_permohonan_slf);?>'" class="btn btn-info btn-sm" title="Lihat Data" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a></td>
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
