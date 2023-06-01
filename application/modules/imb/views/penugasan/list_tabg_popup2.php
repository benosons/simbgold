

	<table class="tbl2" id="tabelbiasa" border="0" cellpadding="2" cellspacing="1">
	<tbody>
	<tr>
		<th width="3%">#</th>
		<th width="25%"><center>Nama-nama TABG</center></th>										
		<th width="20%"><center>Unsur/Sub Unsur</center></th>
		<th width="20%"><center>Bidang Keahlian</center></th>
		<th width="20%"><center>Kualifikasi</center></th>
	</tr>
	<tr>
	</tr>
	<?php
		$i= 1 ;
		$id_sblm  = 0;
		foreach ($result as $raw) {
			$id_skrg = $raw->id_personal;
			if ($i % 2== 0 )
				$clss = "event";
			else
				$clss = "event2";
			
			if (isset($raw->glr_depan) && trim($raw->glr_depan) != '')
				$glr_dpn = $raw->glr_depan.' ';
			else
				$glr_dpn = '';
				
			if (isset($raw->glr_belakang) && trim($raw->glr_belakang) != '')
				$glr_blk = ', '.$raw->glr_belakang;
			else
				$glr_blk = '';
				
			if (isset($raw->nama_personal) && trim($raw->nama_personal) != '')
				$nm = $raw->nama_personal;
			else
				$nm = '';
			$unsur = $raw->nama_unsur." - ".$raw->nama_unsur_ahli;	
			$nama_peg = $glr_dpn . $nm . $glr_blk;
			
			$check = '';
			$dataChk = array(
				'name'		  => 'pegawai-'.$raw->id_personal,
				'id'          => 'pegawai-'.$raw->id_personal,
				'class'       => 'selectable',
				'value'       => $raw->id_personal."^".$nama_peg."^".$unsur."^".$raw->nama_bidang."^".$raw->nama_keahlian,
				'checked'	  => $check
			);	
	?>		  
	<tr class="<?=$clss?>">
		<td class="clcenter"><?php echo form_checkbox($dataChk); ?></td>
		<td class="clleft"><?php echo $nama_peg; ?></td>
		<td class="clcenter"><?php echo $raw->nama_unsur; ?> - <?php echo $raw->nama_unsur_ahli; ?></td>
		<td class="clcenter"><?php echo $raw->nama_bidang; ?></td>
		<td class="clcenter"><?php echo $raw->nama_keahlian; ?></td>
	</tr>	
	<?php 
			$id_sblm = $id_skrg;
			$i++;
		}
	?>	
	</tbody>
	</table>
<?php echo form_close(); ?>
<fieldset class="fields1">
	<input onclick="javascript:lookUpNilai()" value="- Pilih -" type="button">
	<input onclick="window.close()" value="Close" type="button">
</fieldset>