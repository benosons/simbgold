<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>List Data IMB
		</div>
		<div class="tools">
		<a href="javascript:;" class="reload">
								</a>
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
					if($dataimb->num_rows() > 0){
                	$no = 1;
                	foreach ($dataimb->result() as $imb) {
	            ?>
				
				<?php
					if($imb->status_progress == 1){
									$clss = "info";
									
							}else{
					if($imb->status_syarat == 1){
						$clss = "success";
					}elseif($imb->status_syarat == 2){
						$clss = "warning";
					}else{
						$clss = "danger";
					}
							}?>
	                <tr class="<?=$clss?>">
	                  <td align="center"><?php echo $no++;?></td>
					  <td><?php echo $imb->nama_permohonan;?></td>
					  <td align="center"><?php echo $imb->nomor_registrasi;?></td>
	                  <td align="center"><?php echo $imb->nama_pemohon;?></td>
					  <!--td align="center"><?php 
								if($imb->id_jenis_usaha == 1){
									$usaha = "Perseorangan";
								}elseif($imb->id_jenis_usaha == 2){
									$usaha = "Badan Usaha";
								}elseif($imb->id_jenis_usaha == 3){
									$usaha = "Badan Hukum";
								}
							echo $usaha;?>
					  </td-->
					  <td><?php echo $imb->alamat_bg;?></td>
					  <td align="center"><?php
							if($imb->status_progress == 1){
									$class = "label label-sm label-info";
									$syarat = "Menunggu Validasi";
							}else{
								if($imb->status_syarat == 1){
									$class = "label label-sm label-success";
									$syarat = "Terverifikasi";
								}elseif ($imb->status_syarat == 2){
									$class = "label label-sm label-warning";
									$syarat = "Perlu Perbaikan";
								}else{
									$class = "label label-sm label-danger";
									$syarat = "Belum Terverifikasi";
								}
							};?>
							<span class="<?php echo $class;?>"><?php echo $syarat;?></span> 
					  </td>
					  <?php  if ($imb->status_progress == 1) { ?>
					  <!--td align="center"><a href="#" class="btn btn-success btn-sm" title="Verivikasi Data" id="tombolver" data-toggle="modal" data-target="#stack1"><span class="glyphicon glyphicon-edit"></span></a></td-->
					  <td align="center"><a href="#" onClick="href='<?php echo site_url('detail/detail_imb/'.$imb->id_permohonan);?>'" class="btn btn-info btn-sm" title="Lihat Data" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a></td>
					  <?}else{?>
								<?php  if ($imb->status_syarat == 1) { ?>
								<td align="center"><a href="#" onClick="href='<?php echo site_url('detail/detail_imb/'.$imb->id_permohonan);?>'" class="btn btn-info btn-sm" title="Lihat Data" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a></td>
								<?}else{?>
								<td align="center"><a href="#" onClick="href='<?php echo site_url('imb/form_verifikasi/'.$imb->id_permohonan);?>'" class="btn btn-info btn-sm" title="Verifikasi Data" id="tombolver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-edit"></span></a></td>
								<?}?>
					  <?}?>
					
					</tr>
	                <?php			
	                		}
	                	}
	                ?>
				                
                </tbody>
             </table>
		</div>
</div>

	



<!-- /.modal -->

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
