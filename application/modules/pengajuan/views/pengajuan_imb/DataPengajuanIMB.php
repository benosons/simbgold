
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-body">
				
					<div class="row">
					
						<div class="col-md-4">
							<div class="btn-group">
								<button type="button" class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>pengajuan/FormPendaftaranIMB';return false;" >Permohonan IMB <i class="fa fa-plus"></i></button>
							</div>
						</div>
						<div class="col-md-8">
						<?php
									echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'<button class="close" data-close="alert">'.'</button>'.'</div>' : '';    
						?>
						</div>
					</div>
				
				<div class="table-scrollable">
				<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
					<thead>
						<tr>
							<th >No</th>
							<th width="25%">Jenis Permohonan</th>
							<th width="17%">No Registrasi</th>
							<th width="25%">Lokasi BG</th>
							<th width="25%">Status Permohonan</th>
							<th >Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($list_pengajuan->num_rows() > 0){
								$no = 1;
								foreach ($list_pengajuan->result() as $key) {
									if($key->nama_permohonan == "" || $key->nama_permohonan == null){
										$jenis_permohonan = "[Belum Memilih Jenis Permohonan]";
									}else{
										$jenis_permohonan = $key->nama_permohonan;
									}	
									if($key->nomor_registrasi == "" || $key->nomor_registrasi == null){
										$no_registrasi = "[Belum Memiliki No Registrasi]";
									}else{
										$no_registrasi = $key->nomor_registrasi;
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
										$status = "Permohonan Telah Masuk Ke Dinas PUPR (Menunggu Untuk Penjadwalan Sidang)";
									}else if ($key->status_progress == '7'){
										$status = "Menunggu Pemeriksaan & Hasil Sidang oleh Dinas PUPR";
									}else if ($key->status_progress == '8'){
										$status = "Dinas PUPR Menyatakan Perlu Perbaikan Persidangan";
									}else if ($key->status_progress == '9'){
										$status = "Permohonan Telah Masuk Ke Dinas PUPR (Menunggu Untuk Penjadwalan Sidang Ulang)";
									}else if ($key->status_progress == '10'){
										$status = "Menunggu Pemeriksaan & Hasil Sidang Ulang oleh Dinas PUPR";
									}else if ($key->status_progress == '11'){
										$status = "Dinas PUPR Menyatakan Permohonan Layak diberikan IMB dan Menunggu Penetapan Retribusi";
									}else if ($key->status_progress == '12'){
										$status = "Pemohon Belum Membayar Retribusi";
									}else if ($key->status_progress == '13'){
										$status = "Pemohon Sudah Membayar Retribusi dan Menunggu Verifikasi Pembayaran";
									}else if ($key->status_progress == '14'){
										$status = "Pembayarn Terverifikasi dan Menunggu Penerbitan IMB";
									}else if($key->status_progress == '15'){
										$status = "Penyerahan IMB oleh Dinas DMPPTSP";
									}else if($key->status_progress == '16'){
										$status = "IMB Terbit";
									}else if($key->status_progress == '19'){
										$status = "Dinas PUPR Menyatakan Permohonan Ditolak dan Dikembalikan";
									}else{
										$status = "Pemohon Mengisi Data";
									}
								?>
									<tr>
										<td align="center"><?php echo $no++;?></td>
										<td><?php echo $jenis_permohonan;?></td>
										<td><?php echo $no_registrasi;?></td>
										<td><?php echo $lokasi_bg;?></td>
										<td align=""><? echo $status; ?></td>
										<td align="center">
											<?
												if($key->pernyataan == '1'){?>
													<a href="<?php echo site_url('pengajuan/FormSummary/'.$key->id_permohonan);?>" class="btn btn-primary btn-sm" title="Verifikasi Data" ><span class="glyphicon glyphicon-edit"></span></a>
												<?}else{?>
													<a href="<?php echo site_url('pengajuan/PermohonanImbForm/'.$key->id_permohonan);?>" class="btn btn-primary btn-sm" title="Ubah Data"><span class="glyphicon glyphicon-pencil"></span></a> 
													<a style="display: block;" href="<?php echo site_url('pengajuan/removeDataPengajuan/'.$key->id_permohonan);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
												<?}
											?>
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