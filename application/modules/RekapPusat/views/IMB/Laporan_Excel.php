
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Penerbitan_IMB.xls");
?>

<table border="1" width="70%">

<thead>

<tr>
 <th width="5%">No.</th>
 <th width="20%">Nama Pemilik</th>
 <th width="15%">NO SK IMB</th>
 <th width="15%">Fungsi Bangunan</th>
 <th width="45%">Alamat Bangunan</th>
 <th width="15%">Nilai Retribusi</th>
</tr>
	<?php
	if($jum_data==0){?>
	<tr>
		<td class="clcenter" colspan="5">Data is Empty</td>
	</tr>						
  <?}else{
	  $i= 1;
	  foreach ($result as $row){
			if ($i % 2== 0 )
				$clss = "event";
			else
				$clss = "event2";
			?>
			<tr class="<?=$clss?>" id="record">
				<td ><center><?php echo $i?></center></td>
				<td align="left"><?php echo $row->nama_pemohon; ?></td>
				<td align="center"><?php echo $row->no_imb; ?></td>
				<td align="middle-left"><?php echo $row->alamat_bg; ?></td>
				<td align="right">Rp. <?php echo number_format($row->retribusi_manual,0,'','.'); ?></td>
			</tr>
		<?php $i++;
	  }
  }?>
</thead>

<tbody>


</tbody>

</table>