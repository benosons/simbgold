	<div class="page-content">
		<div class="container">
			<div class="row profile">
				<div class="col-md-12">
					<div class="tabbable tabbable-custom tabbable-noborder">
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1_1">
								<div class="row profile-account">
									<?php 
										$this->load->view('DataPengajuanSLF');
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
function getkabkota(v){
	jQuery.post(base_url+'pengajuan/getDataKabKota/'+v,function(data){
		var nama_kabkota	= '';
		jQuery.each(data, function(key, value){
			nama_kabkota += '<option value="'+value.id_kabkot+'"> '+value.nama_kabkota+' </option>';
		});
		jQuery('#nama_kabkota').html(nama_kabkota);
	},'json');
}

function getkecamatan(v){
	jQuery.post(base_url+'pengajuan/getDataKecamatan/'+v,function(data){
		var nama_kecamatan	= '';
		jQuery.each(data, function(key, value){
			nama_kecamatan += '<option value="'+value.id_kecamatan+'"> '+value.nama_kecamatan+' </option>';
		});
		jQuery('#nama_kecamatan').html(nama_kecamatan);
	},'json');
}
</script>
