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
<center><strong>Penjadwalan Konsultasi PBG</strong></center></br>
<table class="blueTable">
	<thead>
		<tr>
			<th>No</th>
			<th>Jenis Permohonan</th>
			<th>Nomor Registrasi</th>
			<th>Nama Pemilik</th>
			<th>Lokasi BG</th>
			<th>Status Konsultasi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		foreach ($datapbg as $pbg) :

			if ($pbg->status < 6 || $pbg->status == NULL) {
				$ustat = "Belum Dijadwalkan!";
				$bgcolor = "danger";
			} else {
				$ustat =  'Sudah Dijadwalkan!';
				$bgcolor = "success";
			}
		?>
			<tr class="<?= $bgcolor ?>">
				<td><?php echo $no++; ?></td>
				<td><?php echo $pbg->nm_konsultasi; ?></td>
				<td><?php echo $pbg->no_konsultasi; ?></td>
				<td><?php echo $pbg->nm_pemilik; ?></td>
				<td><?php echo $pbg->almt_bgn; ?></td>
				<td>
					<?php echo $ustat; ?>
				</td>

			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<script>
	window.print();
</script>