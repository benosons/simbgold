<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-globe"></i>List Data Validasi Penerbitan PBG BGFK</div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<?php echo form_open('DinasTeknis/Verifikasi',array('name'=>'frmListVerifikasi', 'id'=>'frmListVerifikasi')); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Tahap Proses</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<select class="form-control select2me" name="id_proses">
									<option value="">Semua Proses permohonan</option>
									<option value="1" <?php if(isset($id_proses) && $id_proses == 1) echo "selected";?>>Belum DiVerifikasi</option>
									<option value="2" <?php if(isset($id_proses) && $id_proses == 2) echo "selected";?>>Sudah Diverifikasi</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Tgl. Pengajuan Konsultasi</b></label>
						<div class="col-md-9">
							<div class="col-md-2">
								<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggalawal" value="<?=(isset($tanggalawal) ? tgl_eng_to_ind($tanggalawal) : '');?>" placeholder="01-01-2018"/>
							</div>
							<label class="control-label col-md-1"><center><b>s/d</b></center></label>
							<div class="col-md-2">
								<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggalakhir" value="<?=(isset($tanggalakhir) ? tgl_eng_to_ind($tanggalakhir) : '');?>" placeholder="31-12-2020"/>
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b></b></label>
						<div class="col-md-9">
							<div class="col-md-12">
								<input  type="submit" class="btn green" id="search" name="search" value="Pencarian">
								<button type="submit" class="btn green" onclick="resetCari()">Reset</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : ''; ?>
            <thead>
	            <tr>
	                <th>No</th>
	                <th>Jenis Konsultasi</th>
					<th>No. Registrasi</th>
	                <th>Nama Pemilik</th>
					<th>Lokasi BG</th>
	                <th>Status</th>
	                <th>Verifikasi</th>
	            </tr>
            </thead>
            <tbody>
				<?php if($Verifikasi->num_rows() > 0){
                	$no = 1;
                	foreach ($Verifikasi->result() as $Validasi) { ?>
						<?php if($Validasi->status == ''){
							$clss = "danger";
						}elseif($Validasi->status == 1){
							$clss = "danger";
						}elseif($Validasi->status == 2){
							$clss = "warning";
						}elseif($Validasi->status == 3){
							$clss = "warning";
						}elseif($Validasi->status >= 4){
							$clss = "success";
						}else{
							$clss = "success";
						}?>
						<tr class="<?=$clss?>">
						  <td align="center"><?php echo $no++;?></td>
						  <td><?php echo $Validasi->nm_konsultasi;?></td>
						  <td align="center"><?php echo $Validasi->no_konsultasi;?></td>
						  <td align="center"><?php echo $Validasi->nm_pemilik;?></td>
						  <td><?php echo $Validasi->almt_bgn;?></td>
						  <td align="center">
						  	<?php if($Validasi->status >= 4){
								$class = "label label-sm label-info";
								$syarat = "Selesai Verifikasi";
							} else {
								if ($Konsultasi->status == 1){
									$class = "label label-sm label-danger";
									$syarat = "Belum Diverifikasi";
								} else if ($Konsultasi->status == 2){
										$class = "label label-sm label-warning";
										$syarat = "Verifikasi Ulang";
								} else if ($Konsultasi->status == 3){
									$class = "label label-sm label-warning";
									$syarat = "Perbaikan Ulang";
								}
							};?>
							<span class="<?php echo $class;?>"><?php echo $syarat;?></span> 
						  	</td>
                              <?php if ($Validasi->status == 15) { ?>
							<td align="center">
								<a  href="#" onclick="GetCetakIMB(<?php echo $Validasi->id ?>)" class="btn btn-info btn" title="Cetak IMB" id="tombolinver" ><span class="glyphicon glyphicon-print"> Tervalidasi (Lihat PBG)</span></a>
							</td>
					   	<?php } else { ?>
							<td align="center">
								<a href="#dialog-popup" onClick="GetCetakDraf(<?php echo $Validasi->id ?>)" class="btn btn-danger btn" title="Lihat" id="tombolinver" data-toggle="modal">Menunggu Validasi <br> ( klik disini ) </a>	
							</td>
					   	<?php } ?>
					</tr>
						</tr>
	                <?php }
	            } ?>  
            </tbody>
        </table>
	</div>
</div>
<!-- /.modaledit -->
<div class="modal fade" id="dialog-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg">
 		<form action="<?php echo site_url('Teknis/ValidasiForm'); ?>" class="form-horizontal" role="form" method="post">
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
function GetCetakIMB(id)
	{
		var url = "<?php echo base_url() . index_page() ?>Penerbitan/CetakVerifikasi/";
		swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
function GetCetakDraf(id)
{
	$("#MyModalBody").html('<iframe src="<?php echo base_url();?>Teknis/CetakVerifikasi/'+id+'" frameborder="no" width="860" height="540"></iframe>');
	$('[name="id"]').val(id) ; 
}
</script>