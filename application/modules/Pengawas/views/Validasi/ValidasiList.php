<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>List Data Validasi Konsultasi
		</div>
		<div class="tools">
			<a href="javascript:;" class="reload"></a>
		</div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<?php echo form_open('DinasTeknis/Validasi', array('name' => 'frmValidasiList', 'id' => 'frmValidasiList')); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Fungsi Bangunan</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<select class="form-control select2me" name="id_fungsi_bg">
									<option value="">Semua Fungsi</option>
									<option value="1" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 1) echo "selected"; ?>>Fungsi Hunian</option>
									<option value="2" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 2) echo "selected"; ?>>Fungsi Keagamaan</option>
									<option value="3" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 3) echo "selected"; ?>>Fungsi Usaha</option>
									<option value="4" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 4) echo "selected"; ?>>Fungsi Sosial dan Budaya</option>
									<option value="5" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 5) echo "selected"; ?>>Fungsi Khusus</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Tahap Proses Verifikasi</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<select class="form-control select2me" name="id_proses">
									<option value="">Semua Proses permohonan</option>
									<option value="1" <?php if (isset($id_proses) && $id_proses == 1) echo "selected"; ?>>Belum DiValidasi</option>
									<option value="2" <?php if (isset($id_proses) && $id_proses == 2) echo "selected"; ?>>Sudah DiValidasi</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Tanggal Permohonan Konsultasi</b></label>
						<div class="col-md-9">
							<div class="col-md-2">
								<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggalawal" value="<?= (isset($tanggalawal) ? tgl_eng_to_ind($tanggalawal) : ''); ?>" placeholder="01-01-2018" />
							</div>
							<label class="control-label col-md-1">
								<center><b>s/d</b></center>
							</label>
							<div class="col-md-2">
								<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggalakhir" value="<?= (isset($tanggalakhir) ? tgl_eng_to_ind($tanggalakhir) : ''); ?>" placeholder="31-12-2020" />
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b></b></label>
						<div class="col-md-9">
							<div class="col-md-12">
								<input type="submit" class="btn green" id="search" name="search" value="Pencarian">
								<button type="submit" class="btn green" onclick="resetCari()">Reset</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
			<thead>
				<tr>
					<th>No</th>
					<th>Jenis Konsultasi</th>
					<th>No. Registrasi</th>
					<th>Nama Pemilik</th>
					<th>Lokasi BG</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($Validasi->num_rows() > 0) {
					$no = 1;
					foreach ($Validasi->result() as $Konsultasi) { ?>
						<?php if ($Konsultasi->status == 2) {
							$clss = "danger";
						} elseif ($Konsultasi->status == 3) {
							$clss = "success";
						} elseif ($Konsultasi->status == 4) {
							$clss = "success";
						} else {
							$clss = "success";
						} ?>
						<tr class="<?= $clss ?>">
							<td align="center"><?php echo $no++; ?></td>
							<td><?php echo $Konsultasi->nm_konsultasi; ?></td>
							<td align="center"><?php echo $Konsultasi->no_konsultasi; ?></td>
							<td align="center"><?php echo $Konsultasi->nm_pemilik; ?></td>
							<td><?php echo $Konsultasi->almt_bgn; ?></td>
							<td align="center">
								<?php if ($Konsultasi->status == 4) {
									$class = "label label-sm label-success";
									$syarat = "Terverifikasi";
								} else {
									if ($Konsultasi->status >= 5) {
										$class = "label label-sm label-success";
										$syarat = "Terverifikasi";
									} elseif ($Konsultasi->status == 2) {
										$class = "label label-sm label-danger";
										$syarat = "Menunggu Validasi";
									} elseif ($Konsultasi->status == 3) {
										$class = "label label-sm label-warning";
										$syarat = "Validasi Ulang";
									}
								}; ?>
								<span class="<?php echo $class; ?>"><?php echo $syarat; ?></span>
							</td>
							<?php if ($Konsultasi->status >= 4) { ?>
								<td align="center">
									<a href="#" onClick="href='<?php echo site_url('DataDetail/DataKonsultasi/' . $Konsultasi->id); ?>'" class="btn btn-info btn-sm" title="Lihat Data" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a>
								</td>
							<?php } else { ?>
								<?php if ($Konsultasi->status == 4) { ?>
									<td align="center"><a href="#" onClick="href='<?php echo site_url('Pengawas/FormValidasi/'.$Konsultasi->id);?>'" class="btn btn-success btn-sm" title="Verifikasi Data" id="tombolver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-edit"></span></a></td>
								<?php } else { ?>
									<td align="center"><a href="#" onClick="href='<?php echo site_url('Pengawas/FormValidasi/'.$Konsultasi->id);?>'" class="btn btn-success btn-sm" title="Verifikasi Data" id="tombolver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-edit"></span></a></td>
								<?php } ?>
							<?php } ?>
						</tr>
					<?php }
				} ?>
			</tbody>
		</table>
	</div>
</div>
<!-- /.modaledit -->
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-focus-on="input:first">
	<div class="modal-dialog modal-lg">
		<div class="modal-content"></div>
	</div>
</div>
<script>
</script>