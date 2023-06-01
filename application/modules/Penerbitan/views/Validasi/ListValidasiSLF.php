<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-globe"></i>List Validasi Bangunan Eksisting</div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : ''; ?>
            <thead>
				<tr class="warning">
					<th>No</th>
					<th>Jenis Permohonan</th>
					<th>No. Registrasi</th>
					<th>No. SL SLF</th>
					<th>Nama Pemilik</th>
					<th>Lokasi BG</th>
					<th>Status</th>
				</tr>
            </thead>
            <tbody>
				<?php if($Kadis->num_rows() > 0){
					$no = 1;
					foreach ($Kadis->result() as $Kadis) { ?>
						<?php if($Kadis->status == '13'){
							$clss = "danger";
						}else{
							$clss = "success";
						} ?>
						<tr class="<?=$clss?>">
							<td align="center"><?php echo $no++;?></td>
							<td><?php echo $Kadis->nm_konsultasi;?></td>
							<td><?php echo $Kadis->no_konsultasi;?></td>
							<td><?php echo $Kadis->no_slf;?></td>
							<td><?php echo $Kadis->nm_pemilik;?></td>
							<td><?php echo $Kadis->almt_bgn;?></td>
							<?php if ($Kadis->status == 13) { ?>
								<td align="center">
									<a href="#dialog-popup" onClick="GetCetak(<?php echo $Kadis->id ?>)" class="btn btn-danger btn" title="Lihat" id="tombolinver" data-toggle="modal">Menunggu Verifikasi <br> ( klik disini ) </a>	
								</td>
							<?php } else { ?>
								<td align="center">
								<a  href="#" onclick="GetCetakSLF(<?php echo $Kadis->id ?>)" class="btn btn-info btn" title="Cetak IMB" id="tombolinver" ><span class="glyphicon glyphicon-print"> (Lihat SLF)</span></a>
								
								</td>
							<?php } ?>
						</tr>
					<?php }
				} ?>      
            </tbody>
        </table>
	</div>
</div>
<div class="modal fade" id="dialog-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<form action="<?php echo site_url('Penerbitan/ValidasiFormEks'); ?>" class="form-horizontal" role="form" method="post">
			<input type="text" style="display: none;" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >          
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" onclick="return confirm('Yakin Ingin Keluar?')" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body" id="MyModalBody">
		
				</div>
				<div class="modal-footer">
					<input class="form-control" id="id" name="id" style="display: none;">
					<center><button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-check"></span>Validasi Kepala Dinas</button></center>
				</div>
			</div>
		</form>
	</div>
</div>
<script>	
function GetCetakSLF(id)
	{
		var url = "<?php echo base_url() . index_page() ?>Penerbitan/CetakSertifikatLaikFungsi/"+id;
		swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
function GetCetak(id)
{
	$("#MyModalBody").html('<iframe src="<?php echo base_url();?>Penerbitan/CetakSertifikatLaikFungsi/'+id+'" frameborder="no" width="860" height="540"></iframe>');
	$('[name="id"]').val(id) ; 
}
</script>