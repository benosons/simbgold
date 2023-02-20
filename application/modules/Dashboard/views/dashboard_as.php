<div class="row margin-top-20">
	<div class="col-md-12">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption caption-md">
					<i class="icon-bar-chart theme-font hide"></i><span class="caption-subject theme-font bold uppercase">DATA TENAGA PROFESONAL AHLI</span>
				</div>
			</div>
			<div class="portlet-body">
				<div class="row list-separated">
					<div class="col-md-3">
						<div class="font-grey-mint font-sm"><b>Jumlah Calon TPA/TPA Terdaftar</b></div>
						<div class="font-hg font-red-flamingo"><?php echo $tpa_rekap->Total ;?></div>
					</div>
					<div class="col-md-2">
						<div class="font-grey-mint font-sm">Belum Diverifikasi</div>
						<div class="font-hg theme-font"><?php echo $tpa_rekap->BelumVer ;?></div>
					</div>
					<div class="col-md-2">
						<div class="font-grey-mint font-sm">Sudah Diverifikasi</div>
						<div class="font-hg font-green"><?php echo $tpa_rekap->Verifikasi ;?></div>
					</div>
					<div class="col-md-2">
						<div class="font-grey-mint font-sm">Didaftarkan Pemda</div>
						<div class="font-hg font-green"><?php echo $tpa_rekap->Pemda ;?></div>
					</div>
					<div class="col-md-2">
						<div class="font-grey-mint font-sm">Ditolak</div>
						<div class="font-hg font-green"><?php echo $tpa_rekap->Dikembalikan ;?></div>
					</div>
				</div>
				<div class="table table-striped table-bordered table-hover" id="sample_1">
					<table class="table table-striped table-bordered table-hover" >
						<thead>
							<tr class="">
								<th>No</th>
								<th><center>Nama Tenaga Ahli</center></th>
								<?php if($asosiasi =='1'){ ?>
									<th><center>File Penugasan</center></th>
								<?php }else if($asosiasi =='3'){ ?>
									<th><center>Sertfikat Keahlian</center></th>
								<?php } else{ ?>
									<th><center>Sertfikat Keahlian</center></th>
								<?php } ?>
								<th><center>Keterangan</center></th>
								<th><center>Status Verifikasi</center></th>
								<th><center>Aksi</center></th>
							</tr>
						</thead>
						<tbody>
							<?php if ($tpa_result->num_rows() > 0) {
								$no = 1;
								foreach ($tpa_result->result() as $key) { ?>
									<?php if($key->status =='3'){
									$status = "Sudah DiVerifikasi";
									$keterangan = "Data Sesuai";
									$clss = "success";
									} else if($key->status =='2'){
									$status ="Verifikasi dikembalikan ke Pemohon Tenaga Ahli";
									$keterangan = "Data Tidak Sesuai";
									} else if ($key->status =='1'){
									$status ="Belum Diverifikasi";
									$keterangan ="-";
									$clss = "danger";
									}else if($key->status =='5'){
									$status ="Didaftarkan Oleh Pemda";
									$keterangan ="-";
									$clss = "success";
									}else{
									$status ="Belum Ditentukan";
									}
									$filename = FCPATH . "/dekill/Tpa/$key->dir_file";
									$file = '';
									if (file_exists($filename)) {
										$file = base_url('dekill/Tpa/' . $key->dir_file);
									} else {
										$file = base_url() . 'file/Tpa/' . $key->id . '/' . $key->dir_file;
									}
									?>
									<tr class="<?= $clss ?>">
										<td align="center"><?php echo $no++; ?></td>
										<td><?php echo $key->glr_depan; ?> <?php echo $key->nm_tpa; ?> <?php echo $key->glr_blkg; ?></td>
										<td>
											<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo $file; ?>')" class="btn default btn-xs blue-stripe">Lihat Dokumen</a>
										</td>
										<td><?php echo $keterangan; ?></td>
										<td><?php echo $status; ?></td>
										<td align="center">
											<?php if($key->status =='1'){ ?>
											<a href="<?php echo site_url('Dashboard/VerifikasiForm/' . $key->id); ?>" class="btn btn-success btn-sm" title="Ubah Data Personil" data-toggle="modal" data-target="#static"><span class="glyphicon glyphicon-edit"></span></a>
											<?php } else if($key->status =='5'){ ?>
											-
											<?php } else {
												
											} ?>
									</td>
									</tr>
								<?php }
							} ?>	
						</tbody>
					</table>
				</div>				
			</div>
		</div>
	</div>	
</div>
<div id="static" class="modal fade bs-modal-lg" data-width="40%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-body"></div>
	</div>
    <div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn blue" onClick="ResRes2()"><i class="fa fa-sign-out"></i> Tutup</button>
    </div>
</div>
<div id="Tolak" class="modal fade bs-modal-lg" data-width="40%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-content">
		<div class="modal-body"></div>
	</div>
</div>		
<script>
function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	}
</script>
