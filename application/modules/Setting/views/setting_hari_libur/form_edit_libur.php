<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>

<form action="<?php echo site_url('setting/saveDataHariLibur'); ?>" class="form-horizontal" role="form" method="post" id="from_data_edit_hari_libur">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Tambah Data Hari Libur</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Periode</label>
									<div class="col-md-9">
										<div>
											<input type="hidden" class="form-control" value="<?php echo $edit_libur->id;?>" name="id" placeholder="id" autocomplete="off">
											<select name="periode" id="periode" class="form-control">
												<?php 
													if($data_periode_libur->num_rows() > 0){
														foreach ($data_periode_libur->result() as $key2) {
															if($key->id == $edit_libur->data_hari_libur_id){
																$plhrole = "selected";
															}else{
																$plhrole = "";
															}
															
															echo '<option value="'.$key2->id.'" '.$plhrole.'>'.$key2->periode.'</option>';
														}
													}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Tanggal Libur</label>
									<div class="col-md-9">
										<input class="form-control input-medium date-picker" size="16" type="text" name="tgl_libur" value="<?php echo date('m/d/Y',strtotime($edit_libur->tgl_libur));?>"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Keterangan Libur</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3" name="keterangan_tgl_libur" ><?php echo set_value('keterangan_tgl_libur', (isset($edit_libur->keterangan_tgl_libur) ? $edit_libur->keterangan_tgl_libur : ''))?></textarea>
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