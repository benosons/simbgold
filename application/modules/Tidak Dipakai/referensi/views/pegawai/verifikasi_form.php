<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue" id="form_wizard_1">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i> Pengajuan Permohonan IMB
				</div>
				<div class="tools hidden-xs">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-wizard">
					<ul class="nav nav-pills nav-justified steps">
						<?php
							$statusTab1='';$statusTab2='';$statusTab3='';$statusTab4='';$statusTab5='';
							$Tab1='';$Tab2='';$Tab3='';$Tab4='';$Tab5='';
							$linkTab1='#tab1';$linkTab2='#tab2';$linkTab3='#tab3';$linkTab4='#tab4';$linkTab5='#tab5';
							$id_nama_permohonan = (isset($DataPengajuan->id_nama_permohonan) ? $DataPengajuan->id_nama_permohonan : '');
							if($id_nama_permohonan != ''){$statusTab1='done';}else{$statusTab1='active';$Tab1='active';}
							if($statusTab1 == 'done'){$statusTab2='active'; $Tab2='active';}
							
							if($id_nama_permohonan != '' && count($DataTanah) > 0){$statusTab2 = 'done';}
							if($statusTab2 == 'done'){$statusTab3='active'; $Tab3='active'; $Tab2='';}
							if($statusTab3 == 'done'){$statusTab4='active'; $Tab4='active'; $Tab2='';}
							if($statusTab4 == 'done'){$statusTab5='active'; $Tab5='active'; $Tab2='';}
							if($statusTab5 == 'done'){$statusTab5='active'; $Tab5='active'; $Tab2='';}
						?>
						
					</ul>
					
					<div class="tab-content">
						<div class="">
							<?php 
								$this->load->view('data_permohonan_form');
							?>
						</div>
						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset col-md-9">
					<button type="button" class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>pengajuan';return false;" ><i class="fa fa-arrow-left"></i> Kembali </button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>


function activaTab(tab){
    $('.nav-pills a[href="#' + tab + '"]').tab('show');
}
</script>