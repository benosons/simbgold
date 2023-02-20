<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>List Data Validasi SLF
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
					  <th>Nomor SK SLF</th>
	                  <th>Nama Pemilik</th>
					 
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
						
							if($slf->status == 6){
								$clss = "danger";
							}elseif($slf->status == 7){
								$clss = "success";
							}else{
								$clss = "warning";
							
						}?>
						<tr class="<?=$clss?>">
							<td align="center"><?php echo $no++;?></td>
							<td><?php echo $slf->nama_permohonan;?></td>
							<td align="center"><?php echo $slf->no_slf;?></td>
							<td align="center"><?php echo $slf->nama_pemilik;?></td>
							
							<td align="center"><?php
								
									if($slf->status == 6){
										$class = "label label-sm label-danger";
										$syarat = "Menunggu Verifikasi";
									}elseif ($slf->status == 7){
										$class = "label label-sm label-success";
										$syarat = "Terverifikasi";
									}else{
										$class = "label label-sm label-warning";
										$syarat = "???";
									
								};?>
								<span class="<?php echo $class;?>"><?php echo $syarat;?></span> 
							</td>
							<?php  if ($slf->status != 1) { ?>
							<!--td align="center"><a href="#" class="btn btn-success btn-sm" title="Verivikasi Data" id="tombolver" data-toggle="modal" data-target="#stack1"><span class="glyphicon glyphicon-edit"></span></a></td-->
							<td align="center"><a href="#" onClick="href='<?php echo site_url('slf/FormPemeriksaan/'.$slf->id.'/'.$slf->id_nama_permohonan);?>'" class="btn btn-info btn-sm" title="Verifikasi Data" id="tombolver" ><span class="glyphicon glyphicon-edit"></span></a></td>
							<?}else{?>
							<td align="center"><a href="#" onClick="href='<?php echo site_url('slf/FormPemeriksaan/'.$slf->id.'/'.$slf->id_nama_permohonan);?>'" class="btn btn-info btn-sm" title="Verifikasi Data" id="tombolver" ><span class="glyphicon glyphicon-edit"></span></a></td>
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
