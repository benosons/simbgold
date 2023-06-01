<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>List Data Penugasan Pemeriksan Dokumen TPA
		</div>
		<div class="tools">
			<a href="javascript:;" class="reload"></a>
		</div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<form action="<?= site_url('penugasan/tpa') ?>" name="frmListVerifikasi" id="frmListVerifikasi" method="get" accept-charset="utf-8">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b>Fungsi Bangunan</b></label>
							<div class="col-md-9">
								<div class="col-md-5">
									<select class="form-control select2me" name="id_fungsi_bg">
										<option value="0">Semua Fungsi</option>
										<option value="2" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 1) echo "selected"; ?>>Fungsi Hunian</option>
										<option value="2" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 2) echo "selected"; ?>>Fungsi Keagamaan</option>
										<option value="3" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 3) echo "selected"; ?>>Fungsi Usaha</option>
										<option value="4" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 4) echo "selected"; ?>>Fungsi Sosial dan Budaya</option>
										<option value="5" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 5) echo "selected"; ?>>Fungsi Khusus</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b>Fungsi Bangunan</b></label>
							<div class="col-md-9">
								<div class="col-md-5">
									<select class="form-control select2me" name="id_fungsi_bg">
										<option value="0">Semua Fungsi</option>
										<option value="2" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 1) echo "selected"; ?>>Fungsi Hunian</option>
										<option value="2" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 2) echo "selected"; ?>>Fungsi Keagamaan</option>
										<option value="3" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 3) echo "selected"; ?>>Fungsi Usaha</option>
										<option value="4" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 4) echo "selected"; ?>>Fungsi Sosial dan Budaya</option>
										<option value="5" <?php if (isset($id_fungsi_bg) && $id_fungsi_bg == 5) echo "selected"; ?>>Fungsi Khusus</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b>Status Penugasan Tim</b></label>
							<div class="col-md-9">
								<div class="col-md-5">
									<select class="form-control select2me" name="id_proses">
										<option value="0">Semua Proses</option>
										<option value="3" <?php if (isset($id_proses) && $id_proses == 1) echo "selected"; ?>>Belum Ditugaskan</option>
										<option value="4" <?php if (isset($id_proses) && $id_proses == 2) echo "selected"; ?>>Sudah Ditugaskan</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b>Tanggal Permohonan Konsultasi</b></label>
							<div class="col-md-9">
								<div class="col-md-2">
									<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggalawal" value="<?= (isset($tanggalawal) ? tgl_eng_to_ind($tanggalawal) : ''); ?>" placeholder="Periode Awal" />
								</div>
								<label class="control-label col-md-1">
									<center><b>s/d</b></center>
								</label>
								<div class="col-md-2">
									<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggalakhir" value="<?= (isset($tanggalakhir) ? tgl_eng_to_ind($tanggalakhir) : ''); ?>" placeholder="Periode Akhir" />
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b></b></label>
							<div class="col-md-9">
								<div class="col-md-12">
									<button type="submit" class="btn green" id="submit" name="cari"><i class="fa fa-search"></i> Pencarian</button>
									<a href="<?= site_url('penugasan/tpa/') ?>" type="button" class="btn green"><i class="fa fa-close"></i> Reset</a>
									<?php
									$link = isset($_GET['cari']) ? "penugasan/tpa/export_pdf?id_proses={$_GET['id_proses']}&tanggalawal={$_GET['tanggalawal']}&tanggalakhir={$_GET['tanggalakhir']}&cari" : "penugasan/tpa/export_pdf";
									?>
									<a type="button" target="_blank" href="<?= site_url($link) ?>" class="btn green"><i class="fa fa-print"></i> Export </a>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<?php
			echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';
			?>
			<thead>
				<tr>
					<th>No</th>
					<th>Jenis Konsultasi</th>
					<th>Nomor Registrasi</th>
					<th>Nama Pemilik</th>
					<th>Lokasi BG</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($Penugasan as $r) {
				?>
					<?php
					if ($r->status == 3) {
						$clss = "danger";
					} elseif ($r->status >= 5) {
						$clss = "success";
					} else {
						$clss = "success";
					}
					?>
					<tr class="<?= $clss ?>">
						<td align="center"><?php echo $no++; ?></td>
						<td><?php echo $r->nm_konsultasi; ?></td>
						<td align="center"><?php echo $r->no_konsultasi; ?></td>
						<td align="center"><?php echo $r->nm_pemilik; ?></td>
						<td><?php echo $r->almt_bgn; ?></td>
						<td align="center"><?php
											if ($r->status == 3) {
												$class = "abel label-sm label-danger";
												$syarat = "Menunggu Penugasan TPA";
											} else if ($r->status >= 4) {
												$class = "label label-sm label-success";
												$syarat = "Sudah Dilakukan Penugasan";
											}; ?>
							<span class="<?php echo $class; ?>"><?php echo $syarat; ?></span>
						</td>
						<?php if ($r->status >= 4) { ?>
							<td align="center">
								<a href="#" onClick="href='<?php echo site_url('penugasan/tpa/detailpenugasan/' . $r->no_konsultasi); ?>'" class="btn btn-info btn-sm" title="Lihat Data" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a>
								<a href="#" onClick="href='<?php echo site_url('penugasan/tpa/FormPenugasan/' . $r->no_konsultasi); ?>'" class="btn btn-success btn-sm" title="Verifikasi Data" id="tombolver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-edit"></span></a>

							</td>
						<?php } else { ?>
							<td align="center"><a href="#" onClick="href='<?php echo site_url('penugasan/tpa/FormPenugasan/' . $r->no_konsultasi); ?>'" class="btn btn-success btn-sm" title="Verifikasi Data" id="tombolver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-edit"></span></a></td>

						<?php } ?>

					</tr>
				<?php
				}

				?>

			</tbody>
		</table>
	</div>
</div>
<!-- /.modaledit -->
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-focus-on="input:first">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
		<!-- /.modal-content -->
	</div>
</div>
<script>
</script>