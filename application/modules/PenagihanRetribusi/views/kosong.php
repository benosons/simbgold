<form action="<?php echo site_url('PenagihanRetribusi/SimpanPengembalianRetri'); ?>" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
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
                            <textarea class="form-control" name="catatan" id="catatan" placeholder="Catatan"></textarea>
						</div>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
	</div>
</form>