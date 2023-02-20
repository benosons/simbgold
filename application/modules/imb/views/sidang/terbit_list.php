<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>Penerbitan IMB
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
					  <th>Berkas IMB</th>
	                  <th>Status</th>
	                 
	                </tr>
                </thead>
                <tbody>

				<?php
					if($dataimb->num_rows() > 0){
                	$no = 1;
                	foreach ($dataimb->result() as $imb) {
	            ?>
				
				<?php 
					if($imb->status_progress == 16){
						$clss = "success";
					}elseif($imb->status_progress == 15){
						$clss = "warning";
					}else{
						$clss = "danger";
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
					  
					  <?}else{?>
					 <?php if($imb->dir_file_imb == ''){?>
					  <a href="#" onclick="GetCetakIMB(<? echo $imb->id_permohonan ?>)" class="btn btn-danger btn-sm" title="Cetak IMB" id="tombolinver"><span class="glyphicon glyphicon-print"></span></a><a href="#" onClick="href='<?php echo site_url('detail/detail_imb/'.$imb->id_permohonan);?>'" class="btn btn-info btn-sm" title="Lihat Detail Permohonan" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a>
					  </td>
					  <?}else{?>
					  <a href="#" onclick="javascript:GetPdfLap('<?php echo $imb->id_permohonan ?>','<?php echo $imb->dir_file_imb ?>')"" class="btn btn-danger btn-sm" title="Lihat IMB" id="tombolinver"><span class="glyphicon glyphicon-file"></span></a>
					  <a href="#" onClick="href='<?php echo site_url('detail/detail_imb/'.$imb->id_permohonan);?>'" class="btn btn-info btn-sm" title="Lihat Detail Permohonan" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a>
					  </td>
					  <?}?>
					  <?}?>
					  </td>
					  <td align="center">
					  <?php if($imb->validasi_retribusi == 1){?>
									<button class="btn btn-danger btn-sm" disabled="true">Menunggu Verifikasi</button>
					 	
					  <?}else{?>
							  <?php if($imb->status_progress == 15){?>
								<a href="#" onClick="Xbit(<?php echo $imb->id_permohonan?>)" class="btn btn-warning btn-sm" ><span class="glyphicon glyphicon-edit"> Penyerahan IMB</span></a>
							  <?}elseif($imb->status_progress == 16){?>
								<button class="btn btn-success btn-sm" disabled="true">Telah Terbit</button>
							  <?}else{?>
								<button class="btn btn-danger btn-sm" disabled="true">Menunggu Verifikasi</button>
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

<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-focus-on="input:first">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
        </div>
        <!-- /.modal-content -->
	</div>
</div>	
<!-- /.modaledit -->
<div id="terbitin" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog ">
		<form action="<?php echo site_url('imb/terbitlah/'.$imb->id_permohonan); ?>" class="form-horizontal" role="form" method="post" id="hsnya" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title" align="center"><b>Penyerahan IMB</b></h4>
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
function GetPdfLap(id,f){
	var url = "<?php echo base_url() . index_page() ?>file/IMB/pengajuan_imb/"+id+"/"+"imb_n_lampiran"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

function Xbit(id){
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('imb/terbitin/')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(){
                    	$('#terbitin').modal('show');
						$('[name="x_id_p"]').val(data.id_permohonan);
						$('[name="x_penerima"]').val(data.nama_pemohon);
            		});
                }
            });
            return false;
        }; 
</script>
