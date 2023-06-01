<form action="<?php echo site_url('Inspeksi/simpan_penugasaninspeksi'); ?>" class="form-horizontal" role="form" method="post">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 align="center" class="modal-title"><b>Data Pokok Permohonan <?php echo $que['no_izin_pbg'] ?></b></h4></div>
			<div class="modal-body">
			<div class="row static-info">
				<div class="col-md-3 name">Nama Lengkap Pemilik</div>
				<div class="col-md-8 value">
					<?php echo $que['glr_depan']; ?>
					<?php echo $que['nm_pemilik']; ?>
					<?php echo $que['glr_belakang']; ?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-3 name">Lokasi Bangunan Gedung</div>
				<div class="col-md-8 value">
					<?php echo $que['almt_bgn']; ; ?>, Kel. <?php echo $que['nama_kelurahan']; ; ?>, Kec. <?php echo $que['nama_kecamatan']; ; ?>, 
					<?php echo ucwords(strtolower($que['nama_kabkota'])); ; ?>, Prov. <?php echo $que['nama_provinsi']; ; ?>
				</div>
			</div>
			<div class="row static-info">
				<div class="col-md-3 name">Jenis Permohonan Konsultasi</div>
				<div class="col-md-8 value"><?php echo $que['nm_konsultasi']; ?></div>
			</div>
			<div class="row static-info">
				<div class="col-md-3 name">Fungsi Bangunan Gedung</div>
				<div class="col-md-8 value"><?php echo $que['fungsi_bg']; ?></div>
			</div>
			<div class="row static-info">
				<div class="col-md-3 name">Luas, Tinggi & Jumlah Lantai</div>
				<div class="col-md-8 value"><?php echo $que['luas_bgn']; ?> m<sup>2</sup>, dengan tinggi <?php echo $que['tinggi_bgn']; ?> meter dan berjumlah <?php echo $que['jml_lantai']; ?> lantai</div>
			</div>
			<div class="row static-info">
				<div class="col-md-3 name">Dokumen Rekomtek</div>
				<div class="col-md-8 value">
					<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('public/uploads/penilaian/berita_acara/'. $que['dir_file_konsultasi']); ?>')" class="btn default btn-xs blue-stripe" title="Berita Acara Rekomtek">Lihat</a>
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
													<a href="<?php echo site_url("Penugasan/hapusPenugasanInspeksi/{$row->id_personal}/{$row->id}"); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
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
										$id_skrg = $row->id_personal;
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
										if (isset($row->nama_personal) && trim($row->nama_personal) != '')
											$nm = $row->nama_personal;
										else
											$nm = '';
										$unsur = $row->nama_unsur . " - " . $row->nama_unsur_ahli;
										$nama_peg = $glr_dpn . $nm . $glr_blk;
										$check = '';
										$dataChk = array(
											'name'		  => 'pegawai-' . $row->id_personal,
											'id'          => 'pegawai-' . $row->id_personal,
											'class'       => 'selectable',
											'value'       => $row->id_personal . "^" . $nama_peg . "^" . $unsur . "^" . $row->nama_bidang . "^" . $row->nama_keahlian,
											'checked'	  => $check
										);
									?>
										<tr class="info caption-subject font-blue-hoki bold">
											<td class="clcenter">
												<input type="checkbox" name="tugas[]" id="tugas_<?php echo $row->id_personal; ?>" value="<?php echo $row->id_personal; ?>">
											</td>
											<td class="clleft"><?php echo $nama_peg; ?></td>
											<td class="clleft"><?php echo $row->nama_unsur; ?> - <?php echo $row->nama_unsur_ahli; ?></td>
											<td class="clleft"><?php echo $row->nama_bidang; ?></td>
											<td class="clleft"><?php echo $row->nama_keahlian; ?></td>
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
			<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"><br>
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
<script>
	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
</script>