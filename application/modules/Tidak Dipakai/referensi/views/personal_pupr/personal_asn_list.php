<style type="text/css">
	th{text-align: center;}
</style>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
	
	<div class="portlet box blue-hoki">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-globe"></i>List Data Personil ASN(PUPR dan Instansi Teknis Terkait)
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				<div class="row">
					<div class="col-md-4">
						<div class="btn-group">											
							<button type="button" class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>referensi/tambah_personil_form';return false;" >Tambah Petugas PUPR <i class="fa fa-plus"></i></button>
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
	                  <th>Nama Personal</th>
					  <th> Pendidikan Terakhir</th>
	                  <th>Aksi</th>
	                </tr>
                </thead>
                <tbody>
				<?php
					if($asn->num_rows() > 0){
                	$no = 1;
                	foreach ($asn->result() as $asn) {
	            ?>
	                <tr>
						<td align="center"><?php echo $no++;?></td>
						<td><?php echo $asn->nama_personal;?>,  <?php echo $asn->glr_belakang;?></td>
						<td></td>
						<td align="center"><a href="<?php echo site_url('referensi/edit_personal_form/'.$asn->id);?>" class="btn btn-warning btn-sm" title="Ubah Data"><span class="glyphicon glyphicon-pencil"></span></a> <a href="<?php echo site_url('referensi/removeDataPersonal/'.$asn->id);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>
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
	$("#from_provinsi").validate({
	    // Specify the validation rules
	    rules: {
	        nama_provinsi: "required",	
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
	        nama_provinsi: "Masukan Nama Provinsi",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
}); 




</script>
