<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>Rekap Sertifikat Laik Fungsi
		</div>
		<div class="tools">
			<a href="javascript:;" class="reload"></a>
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
					  <th>No. SK SLF</th>
	                  <th>Nama Pemilik</th>
					  <th>Lokasi BG</th>
	                  <th>Retribusi</th>
	                  <th>Verifikasi</th>
	                </tr>
                </thead>
                <tbody>

                </tbody>
             </table>
		</div>
</div>
<!-- /.modal -->
<!-- /.modaledit -->
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-focus-on="input:first">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
        </div>
        <!-- /.modal-content -->
	</div>
</div>
<script>
  
  
 
</script>
