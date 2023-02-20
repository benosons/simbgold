<style type="text/css">
	th{text-align: center;}
</style>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
	
	<div class="portlet box blue-hoki">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-globe"></i>List Data Jenis Permohonan IMB
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				<div class="row">
					<div class="col-md-4">
						<div class="btn-group">											
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#responsive">Tambah <i class="fa fa-plus"></i></button>
						</div>
					</div>
					<div class="col-md-4">
						 <?php
			                  echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : '';    
			                ?>
					</div>
				</div>
			</div>

			<table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
	                <tr>
	                  <th>No</th>
	                  <th>Jenis Permohonan</th>
					  <th>Kompleksitas BG</th>
					  <th>Pemanfaatan BG</th>
					  <th>Lama Proses</th>
	                  <th>Aksi</th>
	                </tr>
                </thead>
                <tbody>
				<?php
					if($imb->num_rows() > 0){
                	$no = 1;
                	foreach ($imb->result() as $imb) {
					
	
	            ?>
	                <tr>
						<td align="center"><?php echo $no++;?></td>
						<td><?php echo $imb->nama_permohonan;?></td>
						<td></td>
						<td></td>
						<td><?php echo $imb->lama_proses;?> Hari</td>
						<td align="center"><a href="<?php echo site_url('referensi/form_edit_permohonan_imb/'.$imb->id_jenis_permohonan);?>" class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-pencil"></span></a> <a href="<?php echo site_url('referensi/removeDataPermohonanIMB/'.$imb->id_jenis_permohonan);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>
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

<!-- /.modal -->
<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<form action="<?php echo site_url('referensi/saveDataPermohonanIMB'); ?>" class="form-horizontal" role="form" method="post" id="form_daftar_permohonan">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Tambah Jenis Permohonan</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-group">
								<label class="col-md-3 control-label">Bangunan Gedung/IMB</label>
								<div class="col-md-4">
									<select class="form-control" name="id_jenis_bg" id="id_jenis_bg">
										<option value="">--Pilih--</option>
										<option value="1">Mendirikan Bangunan Gedung Baru</option>
										<option value="2">Bangunan Gedung Existing Belum Ber-IMB</option>
										<option value="3">Bangunan Gedung Perubahan</option>
										<option value="4">Bangunan Gedung Kolektif</option>
										<option value="5">Bangunan Gedung Prasarana</option>
										<option value="6">Bangunan Gedung IMB Bertahap</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Kompleksitas Bangunan Gedung</label>
								<div class="col-md-4">
									<select class="form-control" name="klasifikasi_bg" id="klasifikasi_bg">
										<option value="">--Pilih--</option>
										<option value="1">Sederhana</option>
										<option value="2">Tidak Sederhana</option>
										<option value="3">Khusus</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Pemanfaatan Bangunan Gedung</label>
								<div class="col-md-4">
									<select class="form-control" name="id_pemanfaatan_bg" id="id_pemanfaatan_bg">
										<option value="">--Pilih--</option>
										<option value="1">Untuk Kepentingan Umum</option>
										<option value="2">Bukan Untuk Kepentingan Umum</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Dokumen Rencana Teknis</label>
								<div class="col-md-4">
									<select class="form-control" name="id_dok_teknis" id="id_dok_teknis">
										<option value="">--Pilih--</option>
										<option value="1">Dibuat oleh Penyedia Jasa Perencana Konstruksi</option>
										<option value="2">Menggunakan Desain Prototipe</option>
										<option value="3">Desain Sendiri oleh Pemohon</option>
									</select>
								</div>
							</div>
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Persyaratan</label>
									<div class="col-md-9">													
										<input type="text" class="form-control" name="nama_persyaratan" placeholder="Nama Persyaratan" autocomplete="off">
									</div>
								</div>
							</div>	
						</div>	
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn default">Batal</button>
					<button type="submit" class="btn green">Simpan</button>
				</div>
			</div>	
		</form>			
	</div>
</div>





<!-- /.modaledit -->
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
        </div>
        <!-- /.modal-content -->
	</div>
</div>	
<script>
  $(function () {
    $("#example1").DataTable();

    var table = $('#example1').dataTable();


    //setInterval(getStatus, 1000);
   
  });

 function getStatus() {
    var randomnumber = Math.floor(Math.random() * 100);
                    $('#show').text(
                            'I am getting refreshed every 3 seconds..! Random Number ==> '
                                    + randomnumber);

}
 
  // Example call to load a new file
  //table.fnReloadAjax( 'media/examples_support/json_source2.txt' );
  // Example call to reload from original file
 
$(function () {    
	 // Setup form validation on the #register-form element
	$("#form_daftar_permohonan").validate({
	    // Specify the validation rules
	    rules: {
	        nama_persyaratan: "required",
			id_jenis_persyaratan: "required",			
	    },
	        highlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	    },
	        unhighlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	    },
	      errorClass: 'help-block',
	    
	    // Specify the validation error messages
	    messages: {
	        nama_persyaratan: "Masukan Nama Persyaratan",
			id_jenis_persyaratan: "Pilih Jenis Persyaratan",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
}); 




</script>
