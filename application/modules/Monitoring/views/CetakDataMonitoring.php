<table class="table table-striped table-bordered table-hover" border="1">
	<?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
	<thead>
		<tr>
			<th>No</th>
			<th>Jenis Konsultasi</th>
			<th>No. Registrasi</th>
			<th>Nama Pemilik</th>
			<th>Lokasi BG</th>
			<th>Fungsi BG</th>
			<th>Tgl Permohonan</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($jum_data > 0) {
			$no = 1;
			foreach ($result as $Konsultasi) { ?>
				<?php if ($Konsultasi->status == '') {
					$clss = "danger";
				} else {
					$clss = "success";
				} ?>
				<tr class="<?= $clss ?>">
					<td align="center"><?php echo $no++; ?></td>
					<td><?php echo $Konsultasi->nm_konsultasi; ?></td>
					<td align="center"><?php echo $Konsultasi->no_konsultasi; ?></td>
					<td align="center"><?php echo $Konsultasi->nm_pemilik; ?></td>
					<td><?php echo $Konsultasi->almt_bgn; ?></td>
					<td><?php echo $Konsultasi->fungsi_bg; ?></td>
					<?php $new_date = date("d-M-Y", strtotime($Konsultasi->tgl_pernyataan)); ?>
					<td align="center"><?php echo  $new_date; ?></td>
					<td align="center">
						<?php echo $Konsultasi->status_dinas; ?>
					</td>
				</tr>
			<?php }
		} else { ?>
<tr>
	<td> Data Tidak Ditemukan</td>
</tr>
		<?php } ?>
	</tbody>
</table>