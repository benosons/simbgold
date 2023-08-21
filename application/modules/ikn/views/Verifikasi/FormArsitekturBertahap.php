<!-- Begin Data Arsitrktur -->
<table id="sample_2" class="table table-bordered table-striped table-hover">
    <thead>
	    <tr class="warning">
	        <th>No</th>
	        <th width="45%">Dokumen Arsitektur</th>
	        <th width="42%">Keterangan</th>
			<th width="10%">Berkas</th>
			<th width="3%">Verifikasi</th>
	    </tr>
    </thead>
    <tbody>
		<?php
		$jns_syarat_sblm = '';
		$cek = '';
		$i= 1 ;
		foreach ($results_Ars as $row) {								
			if ($i % 2== 0 )
				$clss = "event";
			else
				$clss = "event2";	
			?>	
			<tr >
				<td align="center"><?php echo $i?></td>
					<?
					$detail = $row->id_jenis_persyaratan;
					$status = "";
					$query = $this->MDinasTeknis->getSyarat($row->id_detail,$this->uri->segment('3'))->result_array();
					for($n=0;$n<count($query);$n++) {
						$cek = $query[$n]['id_persyaratan_detail'];
						$dir = $query[$n]['dir_file'];
						$status = $query[$n]['status'];
						$ipk=$this->uri->segment('3');
					} ?>
				<td><?php echo $row->nm_dokumen;?></td>
				<td><?php echo $row->keterangan;?></td>
				<td align="center">
					<? if($row->id_detail == $cek){?>
						<? if($dir != ''){?>
							<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Konsultasi/'.$ipk.'/Dokumen/'.$dir);?>')" class="btn default btn-xs blue-stripe" >Lihat</a>
						<?php } else {?>
							[Tidak Ada Dokumen]
						<?php }?>
					<?php }?>	
				</td>
				<? $checked = "";
				if($status == '1')
				{
					$checked = "checked";
				} ?>
				<td align="center"><input type="checkbox" name="syarat_<?=$row->id_detail?>" value="<?=$row->id_detail?>" id="syarat_<?=$row->id_detail?>" onchange="check_status('syarat_<?=$row->id_detail?>','<?=$row->id_detail?>','ars')" <?=$checked?>></td>			  
			</tr>
			<?php
			$i++;
			$jns_syarat_sblm = $detail;
		} ?>          
    </tbody>
</table>
<!-- End Data Arsitektur -->