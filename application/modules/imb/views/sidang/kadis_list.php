<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>Verifikasi Penerbitan IMB
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
					  <th>No. SK IMB</th>
	                  <th>Nama Pemilik</th>
	                  <th>Status Verifikasi</th>  
	                </tr>
                </thead>
                <tbody>

				<?php
					if($dataimb->num_rows() > 0){
                	$no = 1;
                	foreach ($dataimb->result() as $imb) {
	            ?>
				
				<?php 
					if($imb->validasi_retribusi == 2){
						$clss = "success";
					}else{
						$clss = "warning";
					}
				?>
	                <tr class="<?php echo $clss;?>">
	                  <td align="center"><?php echo $no++;?></td>
					  <td><?php echo $imb->nama_permohonan;?></td>
					  <td align="center"><?php echo $imb->no_imb;?></td>
	                  <td align="center"><?php echo $imb->nama_pemohon;?></td>
					  <!--td align="center">
					  </td-->
					  <td align="center">
						<?php if($imb->validasi_retribusi == 1){?>
						<a href="#dialog-popup" onClick="GetCetak(<? echo $imb->id_permohonan ?>)" class="btn btn-warning btn" title="Lihat" id="tombolinver" data-toggle="modal">Menunggu Verifikasi <br> ( klik disini ) </a>
						<?}else{?>
							<?php if($imb->dir_file_imb != ''){?>
								<a href="#" onclick="" class="btn btn-info btn" title="Lihat IMB" id="tombolinver" ><span class="glyphicon glyphicon-file"> Terverifikasi (Lihat IMB)</span></a>
							<?}else{?>
								<a  href="#" onclick="GetCetakIMB(<? echo $imb->id_permohonan ?>)" class="btn btn-info btn" title="Cetak IMB" id="tombolinver" ><span class="glyphicon glyphicon-print"> Terverifikasi (Lihat IMB)</span></a>
							<?}?>
						<?}?>
					  </td>
					  
					
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
<div class="modal fade" id="dialog-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <form action="<?php echo site_url('imb/verkadis'); ?>" class="form-horizontal" role="form" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" onclick="return confirm('Yakin Ingin Keluar?')" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body" id="MyModalBody">
		
      </div>
      <div class="modal-footer">
		<input class="form-control" id="id_permohonannya" name="id_permohonannya" style="display: none;">
		<center><button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-check"></span> Verifikasi IMB</button></center>
      </div>
    </div>
	</form>
  </div>
</div>	

<script>
  
function GetCetakIMB(id)
{
	//alert(id);
	var url = "<?php echo base_url() . index_page() ?>imb/cetak_form_imb/"+id;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

function GetCetak(id)
{
	/*var url = "<?php echo base_url() . index_page() ?>imb/cetak_form_imb/"+id;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();*/
	//alert(id);
	$("#MyModalBody").html('<iframe src="<?php echo base_url();?>imb/cetak_form_imb/'+id+'" frameborder="no" width="860" height="540"></iframe>');
	$('[name="id_permohonannya"]').val(id);
}

 
</script>