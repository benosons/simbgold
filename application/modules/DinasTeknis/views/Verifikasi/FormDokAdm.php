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
					$id		= $this->uri->segment('3');
					$ids 	= $this->secure->decrypt_url($id);
					$detail = $row->id_jenis_persyaratan;
					$status = "";
					$dir	= "";
					$ipk	= "";
					$query = $this->MDinasTeknis->getSyarat($row->id_detail,$ids)->result_array();
					for($n=0;$n<count($query);$n++) {
						$cek = $query[$n]['id_persyaratan_detail'];
						$dir = $query[$n]['dir_file'];
						$status = $query[$n]['status'];
						$ipk=$this->uri->segment('3');
					} 
					$filename = FCPATH . "/object-storage/dekill/Requirement/$dir";
					$dirum = '';
					if (file_exists($filename)) {
						$dirum = './object-storage/dekill/Requirement/' . $dir;
					} else {
						$dirum = './object-storage/file/Konsultasi/' . $ipk . '/Dokumen/' . $dir;
					}
					$dirUmum	= $this->Outh_model->Encryptor('encrypt', $dirum);
				?>
				<td><?php echo $row->nm_dokumen;?></td>
				<td><?php echo $row->keterangan;?></td>
				<td align="center">
					<? if($row->id_detail == $cek){?>
						<? if($dir != '' || $dir != null){?>
							<a href="#PDFViewer" role="button" class="open-PDFViewer btn default btn-xs blue-stripe" data-toggle="modal" data-id="<?php echo site_url('Docreader/ReaderDok/'.$dirUmum); ?>">Lihat</a>
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
					$id		= $this->uri->segment('3');
					$ids 	= $this->secure->decrypt_url($id);
					$detail = $row->id_jenis_persyaratan;
					$status = "";
					$dir	= "";
					$ipk	= "";
					$query = $this->MDinasTeknis->getSyarat($row->id_detail,$ids)->result_array();
					for($n=0;$n<count($query);$n++) {
						$cek = $query[$n]['id_persyaratan_detail'];
						$dir = $query[$n]['dir_file'];
						$status = $query[$n]['status'];
						$ipk=$this->uri->segment('3');
					} 
					
					$filename = FCPATH . "/object-storage/dekill/Requirement/$dir";
					$dirars = '';
					if (file_exists($filename)) {
						$dirars = './object-storage/dekill/Requirement/' . $dir;
					} else {
						$dirars = './object-storage/file/Konsultasi/' . $ipk . '/Dokumen/' . $dir;
					}
					$dirArsitek	= $this->Outh_model->Encryptor('encrypt', $dirars);
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
							<a href="#PDFViewer" role="button" class="open-PDFViewer btn default btn-xs blue-stripe" data-toggle="modal" data-id="<?php echo site_url('Docreader/ReaderDok/'.$dirArsitek); ?>">Lihat</a>
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
<!-- End Data Arsitektur -->