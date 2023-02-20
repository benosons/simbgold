<form action="<?php echo site_url('Penerbitan/SimpanPengembalianRetri'); ?>" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
	<input class="form-control" value="<?php echo $id;?>" id="id" name="id" style="display: none;">
	<input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 align="left" class="modal-title"><b>Alasan Pengembalian</b></h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 ">
				<div class="form-body">
					<div class="form-group">
						<!--<label class="col-md-9 control-label">Catatan</label>-->
						<div class="col-md-9">
                            <textarea type="text" class="form-control" name="catatan" placeholder="Alamat Bangunan" autocomplete="off"><?php echo set_value('almt_bgn', (isset($DataBangunan->catatan) ? $DataBangunan->catatan : '')) ?></textarea>
					
                        </div>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>
</form>