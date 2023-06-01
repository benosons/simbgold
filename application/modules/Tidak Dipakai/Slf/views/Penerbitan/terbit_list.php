<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>Penyerahan SLF
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
					  <th><center>Berkas SLF</center></th>
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
						
							if($slf->status == 6){
								$clss = "warning";
							}elseif($slf->status == 7){
								$clss = "warning";
							}else{
								$clss = "success";
							
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
						<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/slf/'.$slf->id_permohonan_slf.'/rekomtek/'.$slf->file_rekomtek);?>')" title="Cetak SLF" class="btn btn-info btn" ><span class="glyphicon glyphicon-print"></span></a>
					  <?}else{?>
						<?php if($slf->status >= 7){?>
							
						<a  href="#" onclick="GetCetakSLF(<? echo $slf->id_permohonan_slf ?>)" class="btn btn-info btn-sm" title="Cetak SLF" id="tombolinver" ><span class="glyphicon glyphicon-print"></span></a>
						<?}else{?>
			
						<?}?>
					  <?}?>
					  </td>
					  <td align="center">
					  <?php if($slf->status == 6){?>
									<button class="btn btn-danger btn-sm" disabled="true">Menunggu Verifikasi</button>
					  <?}else if($slf->status == 7){?>
									<a href="#" onClick="Xbit2(<?php echo $slf->id_permohonan_slf?>)" class="btn btn-warning btn-sm" ><span class="glyphicon glyphicon-edit"> Penyerahan SLF</span></a>
					  <?}else{?>
								<button class="btn btn-success btn-sm" disabled="true">Telah Terbit</button>
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

<div id="terbitin" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog ">
		<form action="<?php echo site_url('slf/terbitlah/'.$slf->id_permohonan_slf); ?>" class="form-horizontal" role="form" method="post" id="hsnya" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title" align="center"><b>Penyerahan SLF</b></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">										
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Penerima</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="x_id_p" id="x_id_p" style="display: none;">
										<input type="text" class="form-control" name="x_penerima" id="x_penerima" autocomplete="off">
									</div>
								</div>
							</div>	
						</div>
						<div class="col-md-12 ">										
							<div class="form-body">
								<div class="form-group" style="display: none;">
									<label class="col-md-3 control-label">Diserahkan Tanggal</label>
									<div class="col-md-9">
										<input type="text" class="form-control" style="" name="x_tanggal" id="x_tanggal">
									</div>
								</div>
							</div>	
						</div>
						<div class="col-md-12 " >										
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Catatan</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" placeholder="Keterangan" name="x_cat_p" id="x_cat_p"></textarea>
										<input style="display: none;" name="dir_file_x" id="dir_file_x" onchange='coxek()'>
										<input style="display: none;" type="file" class="form-control" name="d_file_x" id="d_file_x" onchange='coxek()'>
									</div>
								</div>
							</div>	
						</div>
						
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" onclick="return confirm('Yakin Ingin Membatalkan?')" data-dismiss="modal" class="btn default">Batal</button>
					<?php echo form_submit('saveterbit','Terbitkan','class="btn green"');	?>
				</div>
			</div>	
		</form>			
	</div>
</div>							

<script type="text/javascript">
  
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

function Xbit2(id){
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('slf/terbitin/')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(){
                    	$('#terbitin').modal('show');
						$('[name="x_id_p"]').val(data.id_permohonan_slf);
						$('[name="x_penerima"]').val(data.nama_pemilik);
            		});
                }
            });
            return false;
        };
		
function popWin(x){
	url = x;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
	}		
 
</script>