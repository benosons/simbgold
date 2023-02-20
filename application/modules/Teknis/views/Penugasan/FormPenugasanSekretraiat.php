<form action="<?php echo site_url('Teknis/SimpanPenugasanTpa'); ?>" class="form-horizontal" role="form" method="post">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 align="center" class="modal-title"><b>Data Pokok Permohonan <?php echo $que['no_konsultasi'] ?></b></h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Nama Pemilik</label>
							<div class="col-md-9">
								<input class="form-control" value="<?php echo $que['nm_pemilik']; ?>" placeholder="Nama Pemilik" autocomplete="off" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Alamat Pemilik</label>
							<div class="col-md-9">
								<textarea class="form-control" readonly placeholder="Alamat Pemilik"><?php echo $que['alamat']; ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Jenis Permohonan Konsultasi</label>
							<div class="col-md-9">
								<input class="form-control" value="<?php echo $que['nm_konsultasi']; ?>" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Lokasi Bangunan Gedung</label>
							<div class="col-md-9">
								<textarea class="form-control" readonly placeholder="Alamat Bangunan Gedung"><?php echo $que['almt_bgn'] ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Fungsi Bangunan Gedung</label>
							<div class="col-md-9">
								<input class="form-control" value="<?php echo $que['fungsi_bg']; ?>" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Luas, Tinggi & Jumlah Lantai</label>
							<div class="col-md-9">
								<input class="form-control" value="<?php echo $que['luas_bgn']; ?> meter persegi, dengan tinggi <?php echo $que['tinggi_bgn']; ?> meter dan berjumlah <?php echo $que['jml_lantai']; ?> lantai." readonly>
							</div>
						</div>
					</div>
				</div>
			</div>


			<?php if ($que['status'] == 4) : ?>
				<div class="row">
					<div class="col-md-12 ">
						<div class="form-body">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr class="warning">
										<th align="center" class="caption-subject bold" width="5%">No</th>
										<th class="caption-subject bold">Nama Tim Terpilih</th>
										<th class="caption-subject bold">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($rew->num_rows() > 0) {
										$no = 1;
										foreach ($rew->result() as $row) {
									?>
											<tr class="info caption-subject bold">
												<td align="center"><?php echo $no++; ?></td>
												<td>

													<?php

													if (isset($row->glr_depan) && trim($row->glr_depan) != '')
														$glr_dpn = $row->glr_depan . ' ';
													else
														$glr_dpn = '';
													if (isset($row->glr_belakang) && trim($row->glr_belakang) != '')
														$glr_blk = ', ' . $row->glr_belakang;
													else
														$glr_blk = '';

													if (isset($row->nama_personal) && trim($row->nama_personal) != '')
														$nm = $row->nama_personal;
													else
														$nm = '';
													$nama_peg = $glr_dpn . $nm . $glr_blk;
													echo $nama_peg; ?></td>
												<td>
													<a href="<?php echo site_url("penugasan/hapusPenugasan/{$row->id_personal}/{$row->id_pemilik}"); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
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
			<?php else : ?>
			<?php endif; ?>
			<hr>
			<div class="row">
				<div class="col-md-12 ">
					<div class="row">
						<div class="col-md-12 ">
							<div class="form-body">
								<br>
								<h4 class="caption-subject font-red bold uppercase"><?php echo $judul; ?></h4>
								<br>
								<table class="table table-striped table-bordered table-hover">
									<tr class="warning caption-subject bold">
										<th width="3%">#</th>
										<th width="25%">Daftar Nama</th>
										<th width="20%">Unsur/Sub Unsur</th>
										<th width="20%">Bidang Keahlian</th>
										<th width="20%">Kualifikasi</th>
									</tr>
									<?php
									$i = 1;
									$id_sblm  = 0;
									foreach ($result as $row) {
										$id_skrg = $row->id;
										if ($i % 2 == 0)
											$clss = "event";
										else
											$clss = "event2";
										if (isset($row->glr_depan) && trim($row->glr_depan) != '')
											$glr_dpn = $row->glr_depan . ' ';
										else
											$glr_dpn = '';
										if (isset($row->glr_belakang) && trim($row->glr_belakang) != '')
											$glr_blk = ', ' . $row->glr_belakang;
										else
											$glr_blk = '';
										if (isset($row->nm_tpa) && trim($row->nm_tpa) != '')
											$nm = $row->nm_tpa;
										else
											$nm = '';
										//$unsur = $row->nama_unsur . " - " . $row->nama_unsur_ahli;
										$nama_peg = $glr_dpn . $nm . $glr_blk;
										$check = '';
										$dataChk = array(
											'name'		  => 'pegawai-' . $row->id,
											'id'          => 'pegawai-' . $row->id,
											'class'       => 'selectable',
											'value'       => $row->id . "^" . $nama_peg ,
											'checked'	  => $check
										);
									?>
										<tr class="info caption-subject font-blue-hoki bold">
											<td class="clcenter">
												<input type="checkbox" name="tugas[]" id="tugas_<?php echo $row->id; ?>" value="<?php echo $row->id; ?>">
											</td>
											<td class="clleft"><?php echo $nama_peg; ?></td>
											<td class="clleft"></td>
											<td class="clleft"></td>
											<td class="clleft"></td>
										</tr>
									<?php
										$id_sblm = $id_skrg;
										$i++;
									}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<button id="save" name="save" type="submit" class="btn blue-hoki btn-block">Simpan</button>
		</div>
		<div class="modal-footer">
			<input type="hidden" name="id_pemilik" value="<?= $que['id_pemilik'] ?>" />
			<button type="button" onclick="return confirm('Yakin Ingin Keluar?')" data-dismiss="modal" class="btn red"> X Tutup</button>
		</div>
	</div>
</form>
<!--MODAL HAPUS-->
<div id="ModalHapus" class="modal fade" tabindex="-1" data-width="50%" data-focus-on="input:first">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12" align="center">
						<h4>Yakin Hapus Pemberitahuan ini?</h4>
						<a class="btn green" href="#stack2"> Ya </a>
						<a data-dismiss="modal" class="btn red"> Tidak </a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
</script>