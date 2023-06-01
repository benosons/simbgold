<table width="100%" border="1" style="font-family: Tahoma; vertical-align: top; font-size: 9pt; color: #000; border-color: #000">
	<tbody>
		<tr class="warning">
			<th rowspan="2" class="info">
				<center>No</center>
			<th rowspan="2" class="info">
				<center>Id Kab/Kota</center>
			</th>
			<th rowspan="2" class="info">
				<center>Kabupaten/Kota</center>
			</th>
			<th colspan="2" class="info">
				<center>Akademisi</center>
			</th>
			<th colspan="2" class="info">
				<center>Asosiasi Profesi</center>
			</th>
			<th colspan="2" class="info">
				<center>Pakar</center>
			</th>
			<th rowspan="2" class="info">
				<center>Total</center>
			</th>
		</tr>
		<tr>
			<th class="danger">
				<center>Calon TPA</center>
			</th>
			<th class="info">
				<center>TPA</center>
			</th>
			<th class="danger">
				<center>Calon TPA</center>
			</th>
			<th class="info">
				<center>TPA</center>
			</th>
			<th class="danger">
				<center>Calon TPA</center>
			</th>
			<th class="info">
				<center>TPA</center>
			</th>
		</tr>
		<?php if ($jum_data == 0) { ?>
			<tr>
				<td class="clcenter" colspan="5">Data is Empty</td>
			</tr>
			<?php } else {
			$i = 1;
			$loksblm = '';

			$AkaCalon = 0;
			$AkaTpa = 0;
			$AsoCalon = 0;
			$AsoTpa = 0;
			$PakarCalon = 0;
			$PakarTpa = 0;

			$t_AkaCalon = 0;
			$t_AkaTpa = 0;
			$t_AsoCalon = 0;
			$t_AsoTpa = 0;
			$t_PakarCalon = 0;
			$t_PakarTpa = 0;

			$t_total = 0;
			if (isset($status) == '') {
				$status2 = 0;
			} else {
				$status2 = $status;
			}
			foreach ($result as $row) {;
				if ($i % 2 == 0)
					$clss = "event";
				else
					$clss = "event2";
				$AkaCalon = $row->AkaCalon;
				$AkaTpa = $row->AkaTpa;
				$AsoCalon = $row->AsoCalon;
				$AsoTpa = $row->AsoTpa;
				$PakarCalon = $row->PakarCalon;
				$PakarTpa = $row->PakarTpa;

				$t_AkaCalon += $AkaCalon;
				$t_AkaTpa += $AkaTpa;
				$t_AsoCalon += $AsoCalon;
				$t_AsoTpa += $AsoTpa;
				$t_PakarCalon += $PakarCalon;
				$t_PakarTpa += $PakarTpa;
				$t_total = $t_AkaCalon + $t_AkaTpa + $t_AsoCalon + $t_AsoTpa + $t_PakarCalon + $t_PakarTpa;
			?>
				<tr class="<?= $clss ?>" id="record">
					<td class="center"><?php echo $i ?></td>
					<td class="clleft">
						<center><?php echo $row->id_kabkot; ?></center>
					</td>
					<td class="clleft"><?php echo $row->nama_kabkota; ?></td>

					<td class="center">
						<center>
							<?php if ($AkaCalon == 0) { ?>0<?php } else { ?>
							<?php echo $AkaCalon; ?>
						<?php } ?></center>
					</td>
					<td class="clcenter">
						<center>
							<?php if ($AkaTpa == 0) { ?>0<?php } else { ?>
							<?php echo $AkaTpa; ?>
						<?php } ?></center>
					</td>

					<td class="center">
						<center>
							<?php if ($AsoCalon == 0) { ?>0<?php } else { ?>
							<?php echo $AsoCalon; ?>
						<?php } ?></center>
					</td>
					<td class="clcenter">
						<center>
							<?php if ($AsoTpa == 0) { ?>0<?php } else { ?>
							<?php echo $AsoTpa; ?>
						<?php } ?></center>
					</td>

					<td class="center">
						<center>
							<?php if ($PakarCalon == 0) { ?>0<?php } else { ?>
							<?php echo $PakarCalon; ?>
						<?php } ?></center>
					</td>
					<td class="clcenter">
						<center>
							<?php if ($PakarTpa == 0) { ?>0<?php } else { ?>
							<?php echo $PakarTpa; ?>
						<?php } ?></center>
					</td>

					<td class="clcenter">
						<center><b>
								<?php echo  $AkaCalon + $AkaTpa + $AsoCalon + $AsoTpa + $PakarCalon + $PakarTpa; ?></b></center>
					</td>
				</tr>
			<?php $i++;
			} ?>
			<tr class="<?= $clss ?>" id="record">
				<td class="clcenter" colspan='3'><b>Total Calon TPA/TPA</b></td>
				<td class="clcenter"><b><?php echo $t_AkaCalon; ?></b></td>
				<td class="clcenter"><b><?php echo $t_AkaTpa; ?></b></td>
				<td class="clcenter"><b><?php echo $t_AsoCalon; ?></b></td>
				<td class="clcenter"><b><?php echo $t_AsoTpa; ?></b></td>
				<td class="clcenter"><b><?php echo $t_PakarCalon; ?></b></td>
				<td class="clcenter"><b><?php echo $t_PakarTpa; ?></b></td>
				<td class="clcenter"><b><?php echo $t_total; ?></b></td>
			</tr>
		<?php } ?>
	</tbody>
</table>