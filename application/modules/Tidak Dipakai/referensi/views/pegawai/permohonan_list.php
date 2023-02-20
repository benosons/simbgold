<style type="text/css">
	th{text-align: center;}
</style>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
	<div class="portlet box blue-hoki">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-globe"></i>Daftar Permohonan IMB
			</div>
		</div>
	<div class="portlet-body">
		<div class="table-toolbar">
			<div class="row">
				<div class="col-md-4">
					<!--<div class="btn-group">											
							<button type="button" class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>imb/verifikasi_permohonan_imb';return false;" >Verifikasi IMB <i class="fa fa-plus"></i></button>
					</div>-->
				</div>
					<div class="col-md-4">
						 <?php
			                  echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : '';
			                  
			                ?>
					</div>
			</div>
		</div>
		<table class="table table-striped table-bordered table-hover" id="sample_3">
			<thead>
				<tr>
					<th>No. </th>
					<th>Nama Pemohon</th>
					<th>No. Registrasi</th>
					<th>Jenis Permohonan</th>
					<th>Kab/Kota</th>
					<th>Verifikasi</th>
				</tr>
			</thead>
			 <?php

                	if($list_imb->num_rows() > 0){
                		$no = 1;
                		foreach ($list_imb->result() as $key_per) {
                			
	                ?>
			<tbody>
				<tr>
					 <td align="center"><?php echo $no++;?></td>
					<td><?php echo $key_per->nama_pemohon; ?></td>
					<td></td>
					<td></td>
					<td></td>
					    <td align="center"><a href="<?php echo site_url('imb/verifikasi_permohonan_imb/'.$key_per->id);?>" class="btn btn-warning btn-sm" title="Ubah Data"><span class="glyphicon glyphicon-pencil"></span></a> <a href="<?php echo site_url('pengajuan/removeDataPengajuan/'.$key_per->id);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>
				</tr>
				 <?php			
	                		}
	                	}
	                ?>	 
			</tbody>
		</table>
	</div>
	</div>
	</div>
</div>
<script>

  $(function () {
    $("#example1").DataTable();
    var table = $('#example1').dataTable();
    //setInterval(getStatus, 1000);
  });
  
 $(function () { 
 
	jQuery.post(base_url+'imb/getNamaKabKota',function(data){
		var nama_kabkota	= '';
		jQuery.each(data, function(key, value){
			nama_kabkota += '<option value="'+value.id_kabkot+'"> '+value.nama_kabkota+' </option>';
		});
		jQuery('#nama_kabkota').html(nama_kabkota);
	},'json');
	
	jQuery.post(base_url+'imb/getNamaProvinsi',function(data){
		var nama_provinsi	= '';
		jQuery.each(data, function(key, value){
			nama_provinsi += '<option value="'+value.id_provinsi+'"> '+value.nama_provinsi+' </option>';
		});
		jQuery('#nama_provinsi').html(nama_provinsi);
	},'json');
}); 
</script>
