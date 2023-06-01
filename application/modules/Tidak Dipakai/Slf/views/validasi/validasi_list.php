<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>List Data Permohonan SLF
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
					if($dataslf->num_rows() > 0){
                	$no = 1;
                	foreach ($dataslf->result() as $imb) {
	            ?>
				
				<?php 
					if($imb->status_progress == 19){
						$clss = "danger";
					}elseif($imb->status_progress == 1){
						$clss = "danger";
					}elseif($imb->status_progress == 2){
						$clss = "warning";
					}elseif($imb->status_progress == 3){
						$clss = "warning";
					}elseif($imb->status_progress == 4){
						$clss = "danger";
					}elseif($imb->status_progress >= 5){
						$clss = "success";
					}else{
						$clss = "danger";
				}?>
	                <tr class="<?=$clss?>">
	                  <td align="center"><?php echo $no++;?></td>
					  <td><?php echo $imb->nama_permohonan;?></td>
					  <td align="center"><?php echo $imb->no_registrasi_slf;?></td>
	                  <td align="center"><?php echo $imb->nama_pemilik;?></td>
					  <td><?php echo $imb->alamat_bg;?></td>
					  <td align="center"><?php 
								if($imb->status_progress <= 3){
									$class = "label label-sm label-warning";
									$syarat = "Menunggu Perbaikan";
								}elseif ($imb->status_progress == 4){
									$class = "label label-sm label-danger";
									$syarat = "Menunggu Validasi";
								}elseif ($imb->status_progress == 19){
									$class = "label label-sm label-danger";
									$syarat = "Permohonan SLF Ditolak";
								}elseif ($imb->status_progress >= 5){
									$class = "label label-sm label-success";
									$syarat = "Tervalidasi";
								};?>
							<span class="<?php echo $class;?>"><?php echo $syarat;?></span> 
					  </td>
					 
					  <!--td align="center"><a href="#" class="btn btn-success btn-sm" title="Verivikasi Data" id="tombolver" data-toggle="modal" data-target="#stack1"><span class="glyphicon glyphicon-edit"></span></a></td-->
					  <td align="center">
					  <?php  if ($imb->status_progress == 4) { ?>
					  <a href="#" onClick="href='<?php echo site_url('slf/FormVerifikasi/'.$imb->id_permohonan_slf.'/'.$imb->id_jenis_permohonan);?>'" class="btn btn-info btn-sm" title="Validasi Data" id="tombolver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-edit"></span></a>
					  
					  <?}else{?>
					  <a href="#" class="btn btn-info btn-sm" title="Lihat Data" id="tombolinver" ><span class="glyphicon glyphicon-user"></span></a>
					  </td>
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

<!-- /.modaledit -->
<div class="modal fade" id="dialog-popup2" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
  
    <div class="modal-content" id="MyModalBody">
     
      
    </div>
	
  </div>
</div>

							

<script>
  
	function GetVal(id)
	{
	//alert(id);
	$("#MyModalBody").html('<iframe src="<?php echo base_url();?>imb/form_verifikasi/'+id+'" frameborder="no" width="100%" height="680"></iframe>');
	$('[name="id_permohonannya"]').val(id);
	}
 
</script>
