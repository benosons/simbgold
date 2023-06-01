<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>Verifikasi Penerbitan SLF
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
					  <th width="15%"><center>Nomor SK SLF</center></th>
	                  <th width="15%"><center>Nama Pemilik</center></th>
	                  <th><center>Status Verifikasi</center></th>			  
	                </tr>
                </thead>
                <tbody>

				<?php
					if($list_penerbitan->num_rows() > 0){
                	$no = 1;
                	foreach ($list_penerbitan->result() as $slf) {
	            ?>
				
				<?php
						
							if($slf->status_progress == 19){
								$clss = "danger";
							}elseif($slf->status_progress >= 15){
								$clss = "success";
							}else{
								$clss = "warning";
							
				}?>
	                
	                  <tr class="<?=$clss?>">
						<td align="center"><?php echo $no++;?></td>
						<td><?php echo $slf->nama_permohonan;?></td>
						<td align="center"><?php echo $slf->no_slf;?></td>
						<td align="center"><?php echo $slf->nama_pemilik;?></td>
					  <!--td align="center">
					  </td-->
					  <td align="center">
					 <?php if($slf->no_slf == "REKOMENDASI TEKNIS"){?>
					  
						<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/slf/'.$slf->id_permohonan_slf.'/rekomtek/'.$slf->file_rekomtek);?>')" class="btn btn-info btn" ><span class="glyphicon glyphicon-print"><br>(Lihat)</span></a>
					 <?}else{?>
						<?php if($slf->status == 6){?>
							
						<a href="#dialog-popup" onClick="GetCetakin(<? echo $slf->id_permohonan_slf ?>)" class="btn btn-warning btn" title="Lihat" id="tombolinver" data-toggle="modal">Menunggu Verifikasi <br> ( klik disini ) </a>

							
						<?}else{?>
									
						<a  href="#" onclick="GetCetakSLF(<? echo $slf->id_permohonan_slf ?>)" class="btn btn-info btn" title="Cetak SLF" id="tombolinver" ><span class="glyphicon glyphicon-print"><br>(Lihat SLF)</span></a>
									
										
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
  <form action="<?php echo site_url('slf/ver_kadis'); ?>" class="form-horizontal" role="form" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" onclick="return confirm('Yakin Ingin Keluar?')" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body" id="MyModalBody">
		
      </div>
      <div class="modal-footer">
		<input class="form-control" id="id_permohonannya" name="id_permohonannya" style="display: none;">
		<center><button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-check"></span> Verifikasi SLF</button></center>
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

function GetCetakin(id)
{
	//alert(id);
	$("#MyModalBody").html('<iframe src="<?php echo base_url();?>slf/Cetak_SLF/'+id+'" frameborder="no" width="860" height="540"></iframe>');
	$('[name="id_permohonannya"]').val(id);
}

function GetCetakSLF(id)
{
	var url = "<?php echo base_url() . index_page() ?>slf/Cetak_SLF/"+id;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

function popWin(x){
	url = x;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
	}
 
</script>