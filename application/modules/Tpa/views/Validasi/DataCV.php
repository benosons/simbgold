<table id="sample_1" class="table table-bordered table-striped table-hover">
	<thead>
		<tr class="warning">
			<th><center>No.</center></th>
			<th><center>Tingkat Pendidikan</center></th>
			<th><center>Jurusan</center></th>
			<th><center>No.Ijazah/Tahun Lulus</center></th>
			<th><center>Berkas</center></th>
			<th><center>Izin Pemanfaatan</center></th>
			<th><center>Aksi</center></th>
		</tr>
	</thead>
	<tbody>
		<?php if ($DataPend->num_rows() > 0) {
			$no = 1;
			foreach ($DataPend->result() as $key) { ?>
				<tr>
					<td align="center"> <?php echo $no++; ?></td>
					<td align="center"> <?php echo $key->id_jenjang; ?></td>
					<td align="center"> <?php echo $key->jurusan; ?></td>
					<td align="center"> <?php echo $key->no_ijazah; ?><br> <?php echo $key->thn_lulus; ?></td>
					<td align="center"><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/' . $key->id . '/data_tanah/' . $key->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a></td>
						<?php
							$cekik = "";
							if($key->status_pdd == '1')
							{
								$cekik = "checked";
							}
						?>
					<td align="center">
						<input type="checkbox" name="verifikasi_tanah_<?php echo $key->id_riwpend;?>" value="<?php echo $key->id_riwpend;?>" id="verifikasi_tanah_<?php echo $key->id_riwpend;?>" onchange="check_tanah('verifikasi_tanah_<?php echo $key->id_riwpend;?>','<?php echo $key->id_riwpend;?>')" <?=$cekik?>>
					</td>
				</tr>
			<?php }
		} ?>
	</tbody>
</table>