<style type="text/css">
	th{text-align: center;}
</style>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">

	<div class="portlet box blue-hoki">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-globe"></i>List Data Undang - Undang
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
	                  <th style="width:10%">No</th>
	                  <th style="width:80%">Undang - Undang</th>
	                  <th style="width:10%">Aksi</th>
	                </tr>
                </thead>
                <tbody>
				<?php
					if($result->num_rows() > 0){
                	$no = 1;
                	foreach ($result->result() as $result) {
	            ?>
	                <tr>
						<td align="center"><?php echo $no++;?></td>
						<td><?php echo $result->uu;?></td>
						<td align="center">
							<a href="<?php echo site_url('referensi/form_edit_uu/'.$result->id);?>" class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-pencil"></span></a> 
							<a href="<?php echo site_url('referensi/removeDataUU/'.$result->id);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
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
</div>
</div>

<!-- /.modal -->
<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<form action="<?php echo site_url('referensi/saveDataUU'); ?>" class="form-horizontal" role="form" method="post" id="form_daftar_uu">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Tambah Daftar Undang - Undang</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">

							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Undang - Undang</label>
									<div class="col-md-9">

										<textarea rows="6" cols="30" class="form-control" name="nama_uu" placeholder="Nama Dokumen UU" autocomplete="off"></textarea>
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
	$("#form_daftar_uu").validate({
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
	        nama_persyaratan: "Masukan Nama Undang - Undang",
			id_jenis_persyaratan: "Pilih Jenis Undang - Undang",
	    },

	    submitHandler: function(form) {
	    	form.submit();
	    }
	});
});




</script>
