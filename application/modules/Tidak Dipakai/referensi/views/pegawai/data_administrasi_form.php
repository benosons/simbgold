<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<div class="caption">
					Data Kelengkapan Persyaratan Administrasi
				</div>
			</div>
			<div class="portlet-body">
				<input type="hidden" class="form-control" value="<?php echo set_value('pengajuan_id', (isset($pengajuan_id) ? $pengajuan_id : ''))?>" name="pengajuan_id" placeholder="id" autocomplete="off">
				<input type="hidden" class="form-control" value="<?php echo set_value('id_nama_permohonan', (isset($DataPengajuan->id_nama_permohonan) ? $DataPengajuan->id_nama_permohonan : ''))?>" name="id_nama_permohonan" placeholder="id_nama_permohonan" autocomplete="off">
				<table id="data_administrasi" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Dokumen</th>
							<th>File Upload</th>
							<th>Validasi</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
var pengajuan_id 		= document.getElementsByName("pengajuan_id")[0].value;
var id_nama_permohonan	= document.getElementsByName("id_nama_permohonan")[0].value;

$(function () {
	
	jQuery.post(base_url+'pengajuan/listDataAdministrasi',{value:pengajuan_id,value2:id_nama_permohonan},function(data){	
			jQuery('#data_administrasi').append(data);
			
	});
	
}); 

</script>