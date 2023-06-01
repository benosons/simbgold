<form action="<?php echo site_url('DataSetting/saveDataKonsultasi'); ?>" class="form-horizontal" role="form" method="post" id="form_daftar_permohonan">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Form Ubah Jenis Konsultasi Bangunan Gedung</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Jenis Konsultasi Bangunan Gedung</label>
							<div class="col-md-8">
								<input type="hidden" class="form-control" value="<?php echo $row->id;?>" name="id" placeholder="id" autocomplete="off">
								<textarea type="textarea" class="form-control" name="nm_konsultasi" placeholder="Nama Jenis Konsultasi" autocomplete="off"><?php echo $row->nm_konsultasi;?></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
								<label class="col-md-3 control-label">Jenis Bangunan Gedung</label>
								<div class="col-md-6">
									<select class="form-control" name="id_izin" id="id_izin">
										<option value="">--Pilih--</option>
										<option value="1" <?php if($row->id_izin == '1') echo "selected";?>>Mendirikan Bangunan Gedung Baru</option>
										<option value="2" <?php if($row->id_izin == '2') echo "selected";?>>Bangunan Gedung Existing Belum Berizin</option>
										<option value="1" <?php if($row->id_izin == '3') echo "selected";?>>Dokumen Teknis Struktur</option>
										<option value="2" <?php if($row->id_izin == '4') echo "selected";?>>Dokumen Teknis Utilitas</option>
										<option value="1" <?php if($row->id_izin == '5') echo "selected";?>>Dokumen Perizinan/Optional</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Perancang Dokumen Teknis</label>
								<div class="col-md-4">
									<select class="form-control" name="id_perancang_dok" id="id_perancang_dok">
										<option value="">--Pilih--</option>
										<option value="1" <?php if($row->id_perancang_dok == '1') echo "selected";?>>Desain Protipe</option>
										<option value="2" <?php if($row->id_perancang_dok == '2') echo "selected";?>>Pemilik Bangunan</option>
										<option value="3" <?php if($row->id_perancang_dok == '3') echo "selected";?>>Perencana Kontruksi</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Kompleksitas Bangunan Gedung</label>
								<div class="col-md-4">
									<select class="form-control" name="klasifikasi_bg" id="klasifikasi_bg">
										<option value="">--Pilih--</option>
										<option value="1" <?php if($row->klasifikasi_bg == '1') echo "selected";?>>Sederhana</option>
										<option value="2" <?php if($row->klasifikasi_bg == '2') echo "selected";?>>Tidak Sederhana</option>
										<option value="3" <?php if($row->klasifikasi_bg == '3') echo "selected";?>>Khusus</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Pemanfaatan Bangunan Gedung</label>
								<div class="col-md-4">
									<select class="form-control" name="id_pemanfaatan_bg" id="id_pemanfaatan_bg">
										<option value="">--Pilih--</option>
										<option value="1">Untuk Kepentingan Umum</option>
										<option value="2">Bukan Untuk Kepentingan Umum</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Dokumen Rencana Teknis</label>
								<div class="col-md-4">
									<select class="form-control" name="id_dok_tek" id="id_dok_tek">
										<option value="">--Pilih--</option>
										<option value="1">Dibuat oleh Penyedia Jasa Perencana Konstruksi</option>
										<option value="2">Menggunakan Desain Prototipe</option>
										<option value="3">Desain Sendiri oleh Pemohon</option>
									</select>
								</div>
							</div>
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Total Lama Proses</label>
									<div class="col-md-2">
										<input type="text" class="form-control" name="lama_proses" placeholder="Total Hari" autocomplete="off">
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