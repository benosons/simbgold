<h2>Daftar Tim Teknis</h2>
<?php echo form_open($this->uri->uri_string(),array('name'=>'frmTABG', 'id'=>'frmTABG')); ?>
<input name="id_dipilih" value="<?=set_value('id_dipilih',isset($id_dipilih) ? $id_dipilih : '')?>" id="id_dipilih" type="hidden">
<input name="peg_dipilih" value="<?=set_value('peg_dipilih',isset($peg_dipilih) ? $peg_dipilih : '')?>" id="peg_dipilih" type="hidden">
<input name="sdhdipilih" value="<?=set_value('sdhdipilih',isset($sdhdipilih) ? $sdhdipilih : '')?>" id="sdhdipilih" type="hidden">
<input name="banyak_peg" value="<?=set_value('banyak_peg',isset($banyak_peg) ? $banyak_peg : '')?>" id="banyak_peg" type="hidden">
<fieldset class="fields1">
	<table border="0" cellpadding="2" cellspacing="1" width="100%">
	<tbody>
	<tr>
		<td align="left" width="15%">Nama Tim Teknis</td>
		<td align="left" width="2%">:</td>
		<td><input size="40" name="txtcari1" class="input2" value="<? echo $txtcari1?>" id="txtcari1" type="text"></td>		
	</tr>
	<tr>	
		<td align="left" width="15%">&nbsp;</td>
		<td align="left" width="2%">&nbsp;</td>
		<td><input class="cancel" name="search" value="Cari" type="submit"></td>
	</tr>
	</tbody>
	</table>	
</fieldset>	

<fieldset class="fields1">
	<input onclick="javascript:lookUpNilai()" value="- Pilih -" type="button">
	<input onclick="window.close()" value="Close" type="button">
</fieldset>

	<table class="tbl2" id="tabelbiasa" border="0" cellpadding="2" cellspacing="1">
	<tbody>
	<tr>
		<th width="3%">#</th>
		<th width="25%">Nama-nama Tim Teknis</th>
		<th width="20%"><center>Unsur/Sub Unsur</center></th>
		<th width="20%"><center>Bidang Keahlian</center></th>
		<th width="20%"><center>Kualifikasi</center></th>
	</tr>
	<tr>
	</tr>
	<?php
		$i= 1 ;
		$id_sblm  = 0;
		foreach ($result as $row) {
			$id_skrg = $row->id_personal;
			if ($i % 2== 0 )
				$clss = "event";
			else
				$clss = "event2";
			
			if (isset($row->glr_depan) && trim($row->glr_depan) != '')
				$glr_dpn = $row->glr_depan.' ';
			else
				$glr_dpn = '';
				
			if (isset($row->glr_belakang) && trim($row->glr_belakang) != '')
				$glr_blk = ', '.$row->glr_belakang;
			else
				$glr_blk = '';
				
			if (isset($row->nama_personal) && trim($row->nama_personal) != '')
				$nm = $row->nama_personal;
			else
				$nm = '';
			$unsur = $row->nama_unsur." - ".$row->nama_unsur_ahli;	
			$nama_peg = $glr_dpn . $nm . $glr_blk;
			
			$check = '';
			$dataChk = array(
				'name'		  => 'pegawai-'.$row->id_personal,
				'id'          => 'pegawai-'.$row->id_personal,
				'class'       => 'selectable',
				'value'       => $row->id_personal."^".$nama_peg."^".$unsur."^".$row->nama_bidang."^".$row->nama_keahlian,
				'checked'	  => $check
			);	
	?>		  
	<tr class="<?=$clss?>">
		<td class="clcenter"><?php echo form_checkbox($dataChk); ?></td>
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
	</tbody>
	</table>
<?php echo form_close(); ?>
<fieldset class="fields1">
	<input onclick="javascript:lookUpNilai()" value="- Pilih -" type="button">
	<input onclick="window.close()" value="Close" type="button">
</fieldset>