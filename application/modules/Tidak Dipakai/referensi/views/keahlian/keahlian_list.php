<style type="text/css">
	th{text-align: center;}
</style>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
	
	<div class="portlet box blue-hoki">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-globe"></i>List Data Keahlian
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
	                  <th>Jenis Keahlian</th>
	                  <th>Aksi</th>
	                </tr>
                </thead>
                <tbody>
				<?php
					if($keahlian->num_rows() > 0){
                	$no = 1;
                	foreach ($keahlian->result() as $keahlian) {
	            ?>
	                <tr>
	                  <td align="center"><?php echo $no++;?></td>
	                  <td><?php echo $keahlian->nama_bidang;?></td>
	                  <td align="center"><a href="<?php echo site_url('referensi/form_edit_bidang/'.$keahlian->id_bidang);?>" class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-pencil"></span></a> <a href="<?php echo site_url('referensi/removeDataBidang/'.$keahlian->id_bidang);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>
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
		<form action="<?php echo site_url('referensi/saveDataBidang'); ?>" class="form-horizontal" role="form" method="post" id="form_bidang">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Tambah Bidang Keahlian</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">										
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Bidang Keahlian</label>
									<div class="col-md-9">													
										<input type="text" class="form-control" name="nama_bidang" placeholder="Nama Bidang Keahlian" autocomplete="off">
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
	$("#form_bidang").validate({
	    // Specify the validation rules
	    rules: {
	        nama_bidang: "required",	
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
	        nama_bidang: "Masukan Nama Bidang Keahlian",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
}); 




</script>
