
<form action="<?php echo site_url('referensi/saveDataPersyaratan/').$jenis; ?>" class="form-horizontal" role="form" method="post" id="frm_edit_persyaratan">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Form Edit Persyaratan <?=$jenis; ?></h4>
		</div>
		<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Persyaratan</label>
									<div class="col-md-9">
										<input type="hidden" class="form-control" value="<?php echo $row->id_syarat;?>" name="id" placeholder="id" autocomplete="off">
										<!-- <input type="textarea" class="form-control" value="<?php echo $row->nama_syarat;?>" name="nama_dokumen_permohonan" placeholder="Nama Dokumen Persyaratan" autocomplete="off"> -->
										<textarea type="textarea" class="form-control" name="nama_dokumen_permohonan" placeholder="Nama Dokumen Persyaratan" autocomplete="off"><?php echo $row->nama_syarat;?></textarea>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Jenis Persyaratan</label>
								<div class="col-md-4">
									<select class="form-control" name="id_jenis_dok_permohonan" id="id_jenis_dok_permohonan">
										<option value="1" <?php if($row->id_jenis_persyaratan == '1') echo "selected";?>>Persyaratan Administrasi</option>
										<option value="2" <?php if($row->id_jenis_persyaratan == '2') echo "selected";?>>Persyaratan Teknis</option>
									</select>
								</div>
							</div>
							<!-- <div class="form-group">
								<label class="col-md-3 control-label">Sub Jenis Persyaratan</label>
								<div class="col-md-4">
									<select class="form-control" name="id_sub_jenis_dok_permohonan" id="id_sub_jenis_dok_permohonan">
										<option value="">--Pilih--</option>
										<option value="1" <?php if($row->id_sub_syarat == '1') echo "selected";?>>Rencana Arsitektur</option>
										<option value="2" <?php if($row->id_sub_syarat == '2') echo "selected";?>>Rencana Struktur</option>
										<option value="3" <?php if($row->id_sub_syarat == '3') echo "selected";?>>Rencana Utilitas</option>
										<option value="4" <?php if($row->id_sub_syarat == '4') echo "selected";?>>Rencana Perizinan/Rekomendasi Lain</option>
										<option value="5" <?php if($row->id_sub_syarat == '5') echo "selected";?>>Adm</option>
										<option value="6" <?php if($row->id_sub_syarat == '6') echo "selected";?>>Optional</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Status</label>
								<div class="col-md-4">
									<select class="form-control" name="status" id="status">
										<option value="">--Pilih--</option>
										<option value="1" <?php if($row->status == '1') echo "selected";?>>Aktif</option>
										<option value="2" <?php if($row->status == '2') echo "selected";?>>Tidak Aktif</option>
									</select>
								</div>
							</div> -->
							
						</div>
					</div>
				</div>

		<div class="modal-footer">
			<button type="button" onclick="batal()" class="btn default">Batal</button>
			<button type="submit" class="btn green">Simpan</button>
		</div>
	</div>
</form>

