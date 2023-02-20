<div class="portlet blue-hoki box">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-cogs"></i>Summary Data Pengajuan SLF
		</div>
	</div>
	<div class="portlet-body">
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<tbody>
				<tr>
					<thead>
					<tr>
						<th>No.</th>
						<th>Status Progres</th>
						<th>Jumlah Permohonan</th>
					</tr>
					</thead>
					<tr>
						<td rowspan='1'>1</td>
						<td rowspan='1'>Verifikasi Dokumen di DPMPTSP</td>
						<td rowspan='1'><?php 
							if (isset($JumPerSLF->DPMPTSP) != '0'){?>
								<div class="col-md-7 value">
									<b><center><?php echo $JumPerSLF->DPMPTSP;?>
								</div>
						<?}else{?>
								<div class="col-md-7 value">
									Belum Ada IMB Yang Dimohonkan
								</div>
							<?}
						?></td>
					</tr>
					<tr>
						<td rowspan='1'>2</td>
						<td rowspan='1'>Pemeriksaan Dokumen Teknis Oleh Dinas Teknis</td>
						<td rowspan='1'><?php 
								if (isset($JumPerSLF->DinasTeknis) != '0'){?>
									<div class="col-md-7 value">
										<b><center><?php echo $JumPerSLF->DinasTeknis;?>
									</div>
							<?}else{?>
									<div class="col-md-7 value">
										Belum Ada IMB Yang Dimohonkan
									</div>
								<?}
							?>
						</td>
					</tr>
					<tr>
						<td rowspan='1'>3</td>
						<td rowspan='1'>Verifikasi Lapangan</td>
						<td rowspan='1'><?php 
							if (isset($JumPerSLF->Retribusi) != '0'){?>	
								<div class="col-md-7 value">
									<b><center><?php echo $JumPerSLF->Retribusi;?>
								</div>
							<?}else{?>
									<div class="col-md-7 value">
										Belum Ada IMB Yang Dimohonkan
									</div>
								<?}
							?>
						</td>
					</tr>
					<tr>
						<td rowspan='1'>4</td>
						<td rowspan='1'>Validasi Penerbitan SLF oleh Kepala Dinas Teknis</td>
						<td rowspan='1'><?php 
							if (isset($JumPerSLF->ValidasiKadis) != '0'){?>	
								<div class="col-md-7 value">
									<b><center><?php echo $JumPerSLF->ValidasiKadis;?>
								</div>
						<?}else{?>
								<div class="col-md-7 value">
									Belum Ada IMB Yang Dimohonkan
								</div>
							<?}
						?>
					</td>
					</tr>
					<tr>
						<td rowspan='1'>5</td>
						<td rowspan='1'>Penyerahan Permohonan SLF Kepada Pemohon</td>
						<td rowspan='1'><?php 
						if (isset($JumPerSLF->IMB_terbit) != '0'){?>	
							<div class="col-md-7 value">
								<b><center><?php echo $JumPerSLF->IMB_terbit;?>
							</div>
						<?}else{?>
								<div class="col-md-7 value">
									Belum Ada IMB Yang Dimohonkan
								</div>
							<?}
						?>
					</td>
					</tr>
					<tr>
						<td rowspan='1'>6</td>
						<td rowspan='1'>Permohonan SLF yang Ditolak</td>
						<td rowspan='1'><?php 
							if (isset($JumPerSLF->IMB_ditolak) != '0'){?>	
								<div class="col-md-7 value">
									<b><center><?php echo $JumPerSLF->IMB_ditolak;?>
								</div>
							<?}else{?>
								<div class="col-md-7 value">
									Belum Ada IMB Yang Dimohonkan
								</div>
							<?}
							?>
						</td>
					</tr>
					<tr>
						<td rowspan='1'>7</td>
						<td rowspan='1'><b>Total</td>
						<td rowspan='1'>
						<?php 
							if (isset($JumPerSLF->Pengajuan_IMB) != '0'){?>
								<div class="col-md-7 value">
									<b><center><?php echo $JumPerSLF->Pengajuan_IMB;?>
								</div>
						<?}else{?>
								<div class="col-md-7 value">
									Belum Ada IMB Yang Dimohonkan
								</div>
							<?}
						?>
						</td>
					</tr>
			</tbody>
		</table>
			
		<div class="row">
		<div class="col-md-6">
			<div class="btn-group">
				<button type="button" class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>Dashboard/DataPermohonanIMB';return false;" >Detail Permohonan SLF <i class="fa fa-plus"></i></button>
			</div>
		</div>
		</div>
	</div>
</div>