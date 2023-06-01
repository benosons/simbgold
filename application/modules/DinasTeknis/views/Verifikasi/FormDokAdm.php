<table id="sample_2" class="table table-bordered table-striped table-hover">
    <thead>
	    <tr class="warning">
	        <th>No</th>
	        <th width="45%">Dokumen Umum</th>
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
		foreach ($results_umum as $row) {								
			if ($i % 2== 0 )
				$clss = "event";
			else
				$clss = "event2";	
			?>	
			<tr >
				<td align="center"><?php echo $i?></td>
				<?php
					$detail = $row->id_jenis_persyaratan;
					$status = "";
					$dir	= "";
					$ipk	= "";
					$query = $this->MDinasTeknis->getSyarat($row->id_detail,$this->uri->segment('3'))->result_array();
					for($n=0;$n<count($query);$n++) {
						$cek = $query[$n]['id_persyaratan_detail'];
						$dir = $query[$n]['dir_file'];
						$status = $query[$n]['status'];
						$ipk=$this->uri->segment('3');
					} 
					$filename = FCPATH . "/object-storage/dekill/Requirement/$dir";
					$dirum = '';
					if (file_exists($filename)) {
						$dirum = base_url('object-storage/dekill/Requirement/' . $dir);
					} else {
						$dirum = base_url('object-storage/file/Konsultasi/' . $ipk . '/Dokumen/' . $dir);
					}
					$dir1	= $this->Outh_model->Encryptor('encrypt', $dir);
				?>
				<td><?php echo $row->nm_dokumen;?></td>
				<td><?php echo $row->keterangan;?></td>
				<td align="center">
					<? if($row->id_detail == $cek){?>
						<? if($dir != '' || $dir != null){?>
							<!--<a href="<?php echo site_url('Docreader/PDFRead/' . $dir1); ?>" class="btn default btn-xs blue-stripe" data-toggle="modal" data-target="#modal-edit">Lihat</a>-->
							<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo $dirum; ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
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
				<td align="center"><input type="checkbox" name="syarat_<?=$row->id_detail?>" value="<?=$row->id_detail?>" id="syarat_<?=$row->id_detail?>" onchange="check_status('syarat_<?=$row->id_detail?>','<?=$row->id_detail?>','adm')" <?=$checked?>></td>			  
			</tr>
			<?php
			$i++;
			$jns_syarat_sblm = $detail;
		} ?>          
    </tbody>
</table>
<!-- End Data Umum -->
<!-- Begin Data Arsitrktur -->
<table id="sample_2" class="table table-bordered table-striped table-hover">
    <thead>
	    <tr class="warning">
	        <th>No</th>
			<?php if($data->id_jenis_permohonan =='35' || $data->id_jenis_permohonan =='36'){ ?>
				<th width="45%">Data Teknis Gedung Eksisting</th>
			<?php } else { ?>
				<th width="45%">Dokumen Arsitektur</th>
			<?php } ?>
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
				<?php
					$detail = $row->id_jenis_persyaratan;
					$status = "";
					$dir	= "";
					$ipk	= "";
					$query = $this->MDinasTeknis->getSyarat($row->id_detail,$this->uri->segment('3'))->result_array();
					for($n=0;$n<count($query);$n++) {
						$cek = $query[$n]['id_persyaratan_detail'];
						$dir = $query[$n]['dir_file'];
						$status = $query[$n]['status'];
						$ipk=$this->uri->segment('3');
					} 
					
					$filename = FCPATH . "/object-storage/dekill/Requirement/$dir";
					$dirars = '';
					if (file_exists($filename)) {
						$dirars = base_url('object-storage/dekill/Requirement/' . $dir);
					} else {
						$dirars = base_url('object-storage/file/Konsultasi/' . $ipk . '/Dokumen/' . $dir);
					}
					$dir1	= $this->Outh_model->Encryptor('encrypt', $dir);
				?>
				<td><?php echo $row->nm_dokumen;?></td>
				<td><?php echo $row->keterangan;?></td>
				<td align="center">
				<?php if($data->id_jenis_permohonan =='3') { ?>
						<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/TypeProtype/'. $data->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>		
					<?php }else if($data->id_jenis_permohonan =='21'){ ?>
						<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/TypeProtype/LampKepmen05-2022.pdf'); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
					<?php }else if($data->id_jenis_permohonan =='34'){ ?>
						<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/TypeProtype/LampKepmen05-2022.pdf'); ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
					<?php }else{ ?>
						<? if($row->id_detail == $cek){?>
						<? if($dir != ''){?>
							<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo $dirars; ?>')" class="btn default btn-xs blue-stripe">Lihat</a>
						<?php } else {?>
							[Tidak Ada Dokumen]
						<?php }?>
					<?php }?>
				<?php } ?>	
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
<div id="modal-edit" class="modal fade bs-modal-sm" data-width="60%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-content" >
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Tutup</button>
		</div>
		<div class="modal-body"></div>
	</div>
</div>
<!-- End Data Arsitektur -->