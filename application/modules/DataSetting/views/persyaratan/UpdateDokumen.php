
<form action="<?php echo site_url('referensi/saveDataDokumen'); ?>" class="form-horizontal" role="form" method="post" id="frm_edit_persyaratan">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Form Edit Dokumen Persyaratan</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Nama Persyaratan</label>
							<div class="col-md-9">
								<input type="hidden" class="form-control" value="<?php echo $row->id;?>" name="id" placeholder="id" autocomplete="off">
								<textarea type="textarea" class="form-control" name="nm_dokumen" placeholder="Nama Dokumen Persyaratan" autocomplete="off"><?php echo $row->nm_dokumen;?></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Jenis Persyaratan</label>
						<div class="col-md-4">
							<select class="form-control" name="jns_dokumen" id="jns_dokumen">
								<option value="1" <?php if($row->jns_dokumen == '1') echo "selected";?>>Dokumen Data Umum</option>
								<option value="2" <?php if($row->jns_dokumen == '2') echo "selected";?>>Dokumen Teknis Arsiktektur</option>
								<option value="1" <?php if($row->jns_dokumen == '3') echo "selected";?>>Dokumen Teknis Struktur</option>
								<option value="2" <?php if($row->jns_dokumen == '4') echo "selected";?>>Dokumen Teknis Utilitas</option>
								<option value="1" <?php if($row->jns_dokumen == '5') echo "selected";?>>Dokumen Perizinan/Optional</option>
							</select>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Keterangan</label>
							<div class="col-md-9">
								<textarea type="textarea" class="form-control" name="keterangan" placeholder="Nama Dokumen Persyaratan" autocomplete="off"><?php echo $row->keterangan;?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" onclick="batal()" class="btn default">Batal</button>
			<button type="submit" class="btn green">Simpan</button>
		</div>
	</div>
</form>

