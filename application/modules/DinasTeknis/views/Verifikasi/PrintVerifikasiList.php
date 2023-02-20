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
<center><strong> Data Verifikasi Konsultasi</strong></center></br>
<table class="blueTable">
	<thead>
		<tr>
			<th>No</th>
			<th width="200">Jenis Konsultasi</th>
			<th>No. Registrasi</th>
			<th>Nama Pemilik</th>
			<th>Lokasi BG</th>
			<th>Fungsi BG</th>
			<th>Tgl Permohonan</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($Verifikasi->num_rows() > 0) {
			$no = 1;
			foreach ($Verifikasi->result() as $Konsultasi) { ?>

				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $Konsultasi->nm_konsultasi; ?></td>
					<td><?php echo $Konsultasi->no_konsultasi; ?></td>
					<td><?php echo $Konsultasi->nm_pemilik; ?></td>
					<td><?php echo $Konsultasi->almt_bgn; ?></td>
					<td><?php echo $Konsultasi->fungsi_bg; ?></td>
					<td><?php echo  date('d-m-Y', strtotime($Konsultasi->tgl_pernyataan)); ?></td>
					<td>
						<?php
						if ($Konsultasi->status >= 4) {
							$class = "label label-sm label-info";
							$syarat = "Selesai Verifikasi";
						} else {
							if ($Konsultasi->status == 1) {
								$class = "label label-sm label-danger";
								$syarat = "Belum Diverifikasi";
							} elseif ($Konsultasi->status == 2) {
								$class = "label label-sm label-warning";
								$syarat = "Verifikasi Ulang";
							} elseif ($Konsultasi->status == 3) {
								$class = "label label-sm label-warning";
								$syarat = "Perbaikan Ulang";
							}
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