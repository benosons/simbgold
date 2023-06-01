<div class="portlet blue-hoki box">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-cogs"></i>Summary Data Pengajuan IMB
		</div>
	</div>
	<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($profile_user->id) ? $profile_user->id : ''))?>" name="id" placeholder="id" autocomplete="off">
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
						<td rowspan='1'><center>1</td>
						<td rowspan='1'>Verifikasi Dokumen di DPMPTSP</td>
						<td rowspan='1'><?php 
							if (isset($JumPerIMB->DPMPTSP) != '0'){?>
								<div class="col-md-7 value">
									<b><center><?php echo $JumPerIMB->DPMPTSP;?>
								</div>
						<?}else{?>
								<div class="col-md-7 value">
									Belum Ada IMB Yang Dimohonkan
								</div>
							<?}
						?></td>
					</tr>
					<tr>
						<td rowspan='1'><center>2</td>
						<td rowspan='1'>Penjadwalan dan Pemeriksaan Dokumen Di Dinas Teknis</td>
						<td rowspan='1'><?php 
								if (isset($JumPerIMB->DinasTeknis) != '0'){?>
									<div class="col-md-7 value">
										<b><center><?php echo $JumPerIMB->DinasTeknis;?>
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
						<td rowspan='1'><center>3</td>
						<td rowspan='1'>Perhitungan Nilai Retribusi</td>
						<td rowspan='1'><?php 
							if (isset($JumPerIMB->Retribusi) != '0'){?>	
								<div class="col-md-7 value">
									<b><center><?php echo $JumPerIMB->Retribusi;?>
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
						<td rowspan='1'><center>4</td>
						<td rowspan='1'>Validasi Penerbitan IMB oleh Kepala Dinas DPMPTSP</td>
						<td rowspan='1'><?php 
							if (isset($JumPerIMB->ValidasiKadis) != '0'){?>	
								<div class="col-md-7 value">
									<b><center><?php echo $JumPerIMB->ValidasiKadis;?>
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
						<td rowspan='1'><center>5</td>
						<td rowspan='1'>Penyerahan Permohonan IMB Kepada Pemohon</td>
						<td rowspan='1'><?php 
						if (isset($JumPerIMB->IMB_terbit) != '0'){?>	
							<div class="col-md-7 value">
								<b><center><?php echo $JumPerIMB->IMB_terbit;?>
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
						<td rowspan='1'><center>6</td>
						<td rowspan='1'>Permohonan IMB yang Ditolak</td>
						<td rowspan='1'><?php 
							if (isset($JumPerIMB->IMB_ditolak) != '0'){?>	
								<div class="col-md-7 value">
									<b><center><?php echo $JumPerIMB->IMB_ditolak;?>
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
						<td rowspan='1'><center>7</td>
						<td rowspan='1'><b>Total</td>
						<td rowspan='1'>
						<?php 
							if (isset($JumPerIMB->Pengajuan_IMB) != '0'){?>
								<div class="col-md-7 value">
									<b><center><?php echo $JumPerIMB->Pengajuan_IMB;?>
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
				<button type="button" class="btn btn-primary" onClick="window.location.href = '<?php echo base_url();?>Dashboard/DataPermohonanIMB';return false;" >Detail Permohonan IMB <i class="fa fa-plus"></i></button>
			</div>
		</div>
		</div>
	</div>
</div>