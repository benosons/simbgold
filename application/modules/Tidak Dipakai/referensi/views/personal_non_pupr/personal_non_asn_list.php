<style type="text/css">
	th{text-align: center;}
</style>
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
	<div class="portlet box blue-hoki">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-globe"></i>List Data Personil Tim Ahli
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				<div class="row">
					<div class="col-md-4">
						<div class="btn-group">											
							<button type="button" class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>referensi/tambah_personil_ahli_form';return false;" >Tambah Tenaga Ahli <i class="fa fa-plus"></i></button>
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
					  <th>Unsur</th>
					  <th>Sub Unsur</th>
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
	                  <td><?php echo $asn->nama_personal;?></td>
					  <td align="center"></td>
					  <td align="center"></td>
	                  <td align="center"><a href="<?php echo site_url('referensi/edit_personal_form/'.$asn->id_personal);?>" class="btn btn-warning btn-sm" title="Ubah Data" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-pencil"></span></a> <a href="<?php echo site_url('referensi/removeDataProvinsi/'.$asn->id_personal);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>
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
</script>
