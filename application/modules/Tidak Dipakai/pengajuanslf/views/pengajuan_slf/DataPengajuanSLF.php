<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-body">
				
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group">
								<button type="button" class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>PengajuanSLF/FormPendaftaranSLF';return false;" >Permohonan SLF <i class="fa fa-plus"></i></button>
							</div>
						</div>
						<div class="col-md-6">
						</div>
					</div>
				<div class="table-scrollable">
				<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Jenis Permohonan</th>
							<th>No Registrasi</th>
							<th>Lokasi BG</th>
							<th>Status Permohonan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($SLF->num_rows() > 0){
								$no = 1;
								foreach ($SLF->result() as $key) {	
									if($key->no_registrasi_slf == "" || $key->no_registrasi_slf == null){
										$no_registrasi_slf = "[Belum Memiliki No Registrasi]";
									}else{
										$no_registrasi_slf = $key->no_registrasi_slf;
									}
									
									if($key->alamat_bg == "" || $key->alamat_bg == null){
										$lokasi_bg = "[Belum Menetapkan Lokasi Bangunan]";
									}else{
										$lokasi_bg = $key->alamat_bg;
									}
									
									
									if($key->status_progress == ''){
										$status = "Pemohon Mengisi Data";
									}else if ($key->status_progress == '1'){
										$status = "Dinas DPMPTSP Sedang Melakukan Verifikasi";
									}else if ($key->status_progress == '2'){
										$status = "Dinas DPMPTSP Mengembalikan Permohonan Agar Memperbaiki Persyaratan";
									}else if ($key->status_progress == '3'){
										$status = "Dinas DPMPTSP Sedang Melakukan Verifikasi Ulang Data Perbaikan";
									}else if ($key->status_progress == '4'){
										$status = "Menunggu Hasil Verifikasi Dinas DPMPTSP";
									}else if ($key->status_progress == '5'){
										$status = "Permohonan Telah Masuk Ke Dinas PUPR (Menunggu Untuk Penugasan)";
									}else if ($key->status_progress == '6'){
										$status = "Permohonan Telah Masuk Ke Dinas PUPR (Menunggu Untuk Penjadwalan Pemeriksaan)";
									}else if ($key->status_progress == '7'){
										$status = "Menunggu Hasil Pemeriksaan oleh Dinas PUPR";
									}else if ($key->status_progress == '8'){
										$status = "Dinas PUPR Menyatakan Perlu Perbaikan Persyaratan";
									}else if ($key->status_progress == '9'){
										$status = "Permohonan Telah Masuk Ke Dinas PUPR (Menunggu Untuk Penjadwalan Pemeriksaan Ulang)";
									}else if ($key->status_progress == '10'){
										$status = "Menunggu Hasil Pemeriksaan Ulang oleh Dinas PUPR";
									}else if ($key->status_progress == '11'){
										$status = "Dinas PUPR Menyatakan Permohonan Layak diberikan SLF";
									}else if ($key->status_progress == '12'){
										$status = "Pemohon Belum Membayar Retribusi";
									}else if ($key->status_progress == '13'){
										$status = "Menunggu Verifikasi Lapangan";
									}else if ($key->status_progress == '14'){
										$status = "Menunggu Penerbitan SLF";
									}else if($key->status_progress == '15'){
										$status = "Penyerahan SLF oleh Dinas DMPPTSP";
									}else if($key->status_progress == '16'){
										$status = "SLF Terbit";
									}else if($key->status_progress == '19'){
										$status = "Permohonan SLF Ditolak";
									}else{
										$status = "Pemohon Mengisi Data";
									}
								?>
								<tr>
									<td align="center"><?php echo $no++;?></td>
									<td><?php echo $key->nama_permohonan;?></td>
									<td><?php echo $no_registrasi_slf;?></td>
									<td><? echo $lokasi_bg;?></td>
									<td align="center"><? echo $status;?></td>
									<td align="center">
									<?php if($key->status_pernyataan == '1'){?>
											<?php if($key->status_progress == '19'){?>
												<a href="<?php echo site_url('pengajuanSLF/FormSummary/'.$key->id_permohonan_slf);?>" class="btn btn-danger btn-sm" title="Permohonan SLF Ditolak" disabled="true" ><span class="glyphicon glyphicon-remove"></span></a>
											<?}else{?>
												<a href="<?php echo site_url('pengajuanSLF/FormSummary/'.$key->id_permohonan_slf);?>" class="btn btn-primary btn-sm" title="Verifikasi Data" ><span class="glyphicon glyphicon-edit"></span></a>
											<?}?>
									<?}else{?>
											<a href="<?php echo site_url('pengajuanSLF/PermohonanSLFForm/'.$key->id_permohonan_slf);?>" class="btn btn-warning btn-sm" title="Ubah Data"><span class="glyphicon glyphicon-pencil"></span></a> 
											<!--<a href="<?php echo site_url('pengajuanSLF/removeDataPengajuan/'.$key->id_permohonan_slf);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a></td>-->
									<?}?>
									</td>
								</tr>
							<?php			
								}
							}
						?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>