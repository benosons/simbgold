<style>
	table.blueTable {
		border-collapse: collapse;
	}

	table.blueTable td,
	table.blueTable th {
		border: 1px solid #AAAAAA;
	}

	table.blueTable thead {
		background: #89C4F4;
	}

	table.blueTable thead th {
		font-weight: bold;
	}
</style>
<center><strong> List Data Penugasan Pemeriksan Dokumen</strong></center></br>
<table class="blueTable">
	<thead>
		<tr>
			<th>No</th>
			<th>Jenis Konsultasi</th>
			<th>Nomor Registrasi</th>
			<th>Nama Pemilik</th>
			<th>Lokasi BG</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($Penugasan->num_rows() > 0) {
			$no = 1;
			foreach ($Penugasan->result() as $r) { ?>

				<tr>
					<td align="center"><?php echo $no++; ?></td>
					<td><?php echo $r->nm_konsultasi; ?></td>
					<td align="center"><?php echo $r->no_konsultasi; ?></td>
					<td align="center"><?php echo $r->nm_pemilik; ?></td>
					<td><?php echo $r->almt_bgn; ?></td>
					<td align="center">
						<?php
						if ($r->id_izin == '2') {
							if ($r->id_fungsi_bg == '1') {
								$bg = "TPT";
							} else {
								$bg = "TPT";
							}
						} else {
							if ($r->id_fungsi_bg == '1') {
								$bg = "TPT";
							} else {
								$bg = "TPA";
							}
						}
						$class = "label label-sm label-danger";
						$syarat = "Menunggu Penugasan {$bg}";
						if ($r->status <= 4) {
							$class = "label label-sm label-danger";
							$syarat = "Menunggu Penugasan {$bg}";
						} else if ($r->status >= 5) {
							$class = "label label-sm label-success";
							$syarat = "Sudah Dilakukan Penugasan {$bg}";
						}; ?>
						<span class="<?php echo $class; ?>"><?php echo $syarat; ?></span>
					</td>
				</tr>
		<?php }
		} ?>
	</tbody>
</table>
<script>
	window.print();
</script>