<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-globe"></i>List Data Penyerahan Dokumen Bangunan Eksisting</div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : ''; ?>
            <thead>
	            <tr>
	                <th>No</th>
	                <th>Jenis Permohonan</th>
					<th>No. Registrasi</th>
					<th>No. Dokumen SLF</th>
	                <th>Nama Pemilik</th>
					<th>Dokumen</th>
	                <th>Status</th>
	            </tr>
            </thead>
            <tbody>
				<?php
					if($Draft->num_rows() > 0) {
                	$no = 1;
                	foreach ($Draft->result() as $Draft) {
	            ?>
				<?php 
					if($Draft->status == 15){
						$clss = "danger";
					}else{
						$clss = "success";
					}
				?>
	                <tr class="<?=$clss?>">
						<td align="center"><?php echo $no++;?></td>
						<td><?php echo $Draft->nm_konsultasi;?></td>
						<td align="center"><?php echo $Draft->no_konsultasi;?></td>
						<td align="center"><?php echo $Draft->no_slf;?></td>
						<td align="left"><?php echo $Draft->nm_pemilik;?></td>
						<!--td><?php echo $Draft->almt_bgn;?></td-->
						<td align="center">
							<a  href="#" onclick="GetCetakDok(<?php echo $Draft->id ?>)" class="btn btn-info btn" title="Cetak Dokumen" id="tombolinver" ><span class="glyphicon glyphicon-print"> </span></a>
						</td>
						<td align="center">
							<?php if($Draft->status == 15){ ?>
								<a href="#" onClick="Xbit(<?php echo $Draft->id?>)" class="btn btn-danger btn-sm" ><span class="glyphicon glyphicon-edit">.</span>Penyerahan Dokumen SLF</a>
							<?php } else { ?>
								<button class="btn btn-warning btn-sm" disabled="true">Dokumen Telah Diserahkan</button>
							<?php } ?>
						</td>
					</tr>
	                <?php }
	            } ?>      
            </tbody>
        </table>
	</div>
</div>
<div id="Penyerahan" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog ">
		<form action="<?php echo site_url('PenyerahanDokumen/PenyerahanDokEksis/'.$Draft->id); ?>" class="form-horizontal" role="form" method="post" id="hsnya" enctype="multipart/form-data">
			<input type="text" style="display: none;" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >         
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title" align="center"><b>Penyerahan Dokumen PBG/SLF Bangunan Eksisting</b></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">										
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Pemilik Asli</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="x_pemilik" id="x_pemilik" readonly>
									</div>
								</div>
							</div>	
						</div>
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
									<label class="col-md-3 control-label">Ketarangan</label>
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
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-focus-on="input:first">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		
        </div>
	</div>
</div>	
<script>	
function GetCetakDok(id)
{
	var url = "<?php echo base_url() . index_page() ?>Penerbitan/CetakSertifikatLaikFungsi/"+id;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}
 function Xbit(id){
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('PenyerahanDokumen/PenyerahanDokumenEksisting/')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(){
                    	$('#Penyerahan').modal('show');
						$('[name="x_id_p"]').val(data.id);
						$('[name="x_penerima"]').val(data.nm_pemilik);
						$('[name="x_pemilik"]').val(data.nm_pemilik);
            		});
                }
            });
            return false;
        }; 
</script>

