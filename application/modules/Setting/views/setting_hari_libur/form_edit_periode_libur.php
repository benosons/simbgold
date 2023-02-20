<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>

<form action="<?php echo site_url('setting/saveDataPeriodeHariLibur'); ?>" class="form-horizontal" role="form" method="post" id="from_edit_data_periode_hari_libur">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Tambah Data Periode Hari Libur</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Periode</label>
									<div class="col-md-9">
										<input type="hidden" class="form-control" value="<?php echo $edit_periode_libur->id;?>" name="id" placeholder="id" autocomplete="off">
										<input type="text" class="form-control" name="periode" value="<?php echo $edit_periode_libur->periode;?>" placeholder="Periode Tahun" autocomplete="off" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Awal Periode</label>
									<div class="col-md-9">
										<input class="form-control input-medium date-picker" size="16" type="text" name="awal_periode" value="<?php echo date('m/d/Y',strtotime($edit_periode_libur->tgl_awal_periode));?>"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Akhir Periode</label>
									<div class="col-md-9">
										<input class="form-control input-medium date-picker" size="16" type="text" name="akhir_periode" value="<?php echo date('m/d/Y',strtotime($edit_periode_libur->tgl_akhir_periode));?>"/>
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
<script src="<?php echo base_url();?>assets/admin/pages/scripts/components-pickers.js"></script>
<script>
jQuery(document).ready(function() {    
   ComponentsPickers.init();
});


</script>