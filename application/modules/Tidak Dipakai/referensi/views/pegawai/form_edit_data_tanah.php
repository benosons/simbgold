		<form action="<?php echo site_url('pengajuan/saveDataTanah'); ?>" class="form-horizontal" role="form" method="post" id="from_data_tanah" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Form Tambah Data Kepemilikan Tanah</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Jenis Dokumen</label>
									<div class="col-md-9">
										<input type="hidden" class="form-control" value="<?php echo $data_tanah->id;?>" name="id" placeholder="id" autocomplete="off">
										<input type="hidden" class="form-control" value="<?php echo set_value('pengajuan_id', (isset($pengajuan_id) ? $pengajuan_id : ''))?>" name="pengajuan_id" placeholder="id" autocomplete="off">
										<input type="hidden" class="form-control" value="<?php echo set_value('code_pengajuan', (isset($code_pengajuan) ? $code_pengajuan : ''))?>" name="code_pengajuan" placeholder="code_pengajuan" autocomplete="off">
										<select class="form-control" name="id_jenis_dokumen" id="id_jenis_dokumen" onchange="get_jenis_dok(this.value)" >
											<option value="">--Pilih--</option>
											<option value="1" <?php if($data_tanah->id_jenis_dokumen == '1') echo "selected";?>>Sertifikat</option>
											<option value="2" <?php if($data_tanah->id_jenis_dokumen == '2') echo "selected";?>>Akta Jual Beli</option>
											<option value="3" <?php if($data_tanah->id_jenis_dokumen == '3') echo "selected";?>>Girik</option>
											<option value="4" <?php if($data_tanah->id_jenis_dokumen == '4') echo "selected";?>>Petuk</option>
											<option value="5" <?php if($data_tanah->id_jenis_dokumen == '5') echo "selected";?>>Bukti Lain - Lain</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">File Dokumen</label>
									<div class="col-md-9">													
										<input type="file" name="file_tanah_upload" id="file_izin_pemanfaatan">
									</div>
								</div>
								<div id="nama_dok_lain" style="display: none;">
									<div class="form-group">
										<label class="col-md-3 control-label">Nama Jenis Dokumen Lain</label>
										<div class="col-md-9">													
											<input type="text" class="form-control" name="nama_jns_dok_lain" value="<?php echo set_value('nama_jns_dok_lain', (isset($data_tanah->nama_jns_dok_lain) ? $data_tanah->nama_jns_dok_lain : ''))?>" placeholder="Nama Jenis Dokumen Lain" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Nomor Dokumen</label>
									<div class="col-md-9">													
										<input type="text" class="form-control" name="nomor_dokumen" value="<?php echo set_value('nomor_dokumen', (isset($data_tanah->nomor_dokumen) ? $data_tanah->nomor_dokumen : ''))?>" placeholder="Nomor Dokumen" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Tanggal Terbit</label>
									<div class="col-md-9">
										<input class="form-control input-medium date-picker" size="16" type="text" name="tgl_terbit_dokumen" value="<?php echo date('m/d/Y',strtotime($data_tanah->tgl_terbit_dokumen));?>"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Lokasi Tanah</label>
									<div class="col-md-9">													
										<input type="text" class="form-control" name="lokasi_tanah" value="<?php echo set_value('lokasi_tanah', (isset($data_tanah->lokasi_tanah) ? $data_tanah->lokasi_tanah : ''))?>" placeholder="Lokasi Tanah" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Provinsi</label>
									<div class="col-md-9">	
										<select name="nama_provinsi_tanah" id="nama_provinsi_tanah" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota(this.value)">
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Kab/Kota</label>
									<div class="col-md-9">	
										<select name="nama_kabkota_tanah" id="nama_kabkota_tanah" class="form-control select2me" data-placeholder="Select..." onchange="getkecamatan(this.value)">
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Kecamatan</label>
									<div class="col-md-9">	
										<select name="nama_kecamatan_tanah" id="nama_kecamatan_tanah" class="form-control select2me" data-placeholder="Select..." >
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Luas Tanah</label>
									<div class="col-md-9">													
										<input type="text" class="form-control" name="luas_tanah" value="<?php echo set_value('luas_tanah', (isset($data_tanah->luas_tanah) ? $data_tanah->luas_tanah : ''))?>" placeholder="Luas Tanah" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Pemegang Hak Atas Tanah</label>
									<div class="col-md-9">													
										<input type="text" class="form-control" name="nama_pemegang_hak_atas_tanah" value="<?php echo set_value('nama_pemegang_hak_atas_tanah', (isset($data_tanah->nama_pemegang_hak_atas_tanah) ? $data_tanah->nama_pemegang_hak_atas_tanah : ''))?>" placeholder="Nama Pemegang Hak Atas Tanah" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">No KTP Pemegang Hak Atas Tanah</label>
									<div class="col-md-9">													
										<input type="text" class="form-control" name="no_ktp_pemegang_hak_atas_tanah" value="<?php echo set_value('no_ktp_pemegang_hak_atas_tanah', (isset($data_tanah->no_ktp_pemegang_hak_atas_tanah) ? $data_tanah->no_ktp_pemegang_hak_atas_tanah : ''))?>" placeholder="No KTP Pemegang Hak Atas Tanah" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Izin pemanfaatan dari pemegang hak atas tanah</label>
									<div class="col-md-9">													
										<div class="radio-list">
											<label><input type="radio" name="id_status_izin_pemanfaatan" id="id_status_izin_pemanfaatan1" onclick="set_id_status_izin_pemanfaatan(this.value)" value="1" > YA</label>
											<label><input type="radio" name="id_status_izin_pemanfaatan" id="id_status_izin_pemanfaatan2" onclick="set_id_status_izin_pemanfaatan(this.value)" value="2" > TIDAK </label>
										</div>
									</div>
								</div>
								<div id="izin_pemegang_hak_atas_tanah" style="display: none;">
									<hr>
									<div class="form-group">
										<label class="col-md-3 control-label">File Izin Pemanfaatan</label>
										<div class="col-md-9">													
											<input type="file" name="file_izin_pemanfaatan" id="file_izin_pemanfaatan">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">No Dokumen izin pemanfaatan</label>
										<div class="col-md-9">													
											<input type="text" class="form-control" name="no_dok_izin_pemanfaatan" value="<?php echo set_value('no_dok_izin_pemanfaatan', (isset($data_tanah->no_dok_izin_pemanfaatan) ? $data_tanah->no_dok_izin_pemanfaatan : ''))?>" placeholder="No Dokumen izin pemanfaatan" autocomplete="off">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Tanggal Terbi Pemanfaatan</label>
										<div class="col-md-9">
											<input class="form-control input-medium date-picker" size="16" type="text" name="tgl_terbit_pemanfaatan" value="<?php echo date('m/d/Y',strtotime($data_tanah->tgl_terbit_pemanfaatan));?>"/>
										</div>
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