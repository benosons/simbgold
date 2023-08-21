<!-- Begin Data teknis Struktur -->
<table id="sample_2" class="table table-bordered table-striped table-hover">
    <thead>
		<tr class="warning">
			<th>No</th>
			<th width="45%">Ketentuan Teknis Struktur</th>
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
		foreach ($results_Str as $row) {								
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
					$query = $this->MDinasTeknis->getSyarat($row->id_detail,$ids)->result_array();
					for($n=0;$n<count($query);$n++) {
						$cek = $query[$n]['id_persyaratan_detail'];
						$dir = $query[$n]['dir_file'];
						$status = $query[$n]['status'];
						$ipk=$this->uri->segment('3');
					}
					$filename = FCPATH . "/object-storage/dekill/Requirement/$dir";
					$dirstr = '';
					if (file_exists($filename)) {
						$dirstr = './object-storage/dekill/Requirement/' . $dir;
					} else {
						$dirstr = './object-storage/file/Konsultasi/' . $ipk . '/Dokumen/' . $dir;
					}
					$dirStruktur	= $this->Outh_model->Encryptor('encrypt', $dirstr);
					?>
				<td><?php echo $row->nm_dokumen;?></td>
				<td><?php echo $row->keterangan;?></td>
				<td align="center">
					<? if($row->id_detail == $cek){?>
						<? if($dir != ''){ ?>
							<a href="#PDFViewer" role="button" class="open-PDFViewer btn default btn-xs blue-stripe" data-toggle="modal" data-id="<?php echo site_url('Docreader/ReaderDok/'.$dirStruktur); ?>">Lihat</a>
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
				<td align="center"><input type="checkbox" name="syarat_<?=$row->id_detail?>" value="<?=$row->id_detail?>" id="syarat_<?=$row->id_detail?>" onchange="check_status('syarat_<?=$row->id_detail?>','<?=$row->id_detail?>','str')" <?=$checked?>></td>			  
			</tr>
			<?php
			$i++;
			$jns_syarat_sblm = $detail;
		} ?>          
    </tbody>
</table>
<!-- End Data Teknis Struktur -->
<!-- Begin Data MEP -->
<table id="sample_2" class="table table-bordered table-striped table-hover">
    <thead>
	    <tr class="warning">
	        <th>No</th>
	        <?php if($data->id_izin =='2'){ ?>
				<th width="45%">Data Teknis Gedung Eksisting</th>
			<?php } else { ?>
				<th width="45%">Data Teknis Mekanikal, Elektrikal, dan Plambing</th>
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
		foreach ($results_MEP as $row) {								
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
					$query = $this->MDinasTeknis->getSyarat($row->id_detail,$ids)->result_array();
					for($n=0;$n<count($query);$n++) {
						$cek = $query[$n]['id_persyaratan_detail'];
						$dir = $query[$n]['dir_file'];
						$status = $query[$n]['status'];
						$ipk=$this->uri->segment('3');
					} 
					$filename = FCPATH . "/object-storage/dekill/Requirement/$dir";
					$dirmep = '';
					if (file_exists($filename)) {
						$dirmep = './object-storage/dekill/Requirement/' . $dir;
					} else {
						$dirmep = './object-storage/file/Konsultasi/' . $ipk . '/Dokumen/' . $dir;
					}
					$dirMEP	= $this->Outh_model->Encryptor('encrypt', $dirmep);
					?>
				<td><?php echo $row->nm_dokumen;?></td>
				<td><?php echo $row->keterangan;?></td>
				<td align="center">
					<? if($row->id_detail == $cek){?>
						<? if($dir != ''){?>
							<a href="#PDFViewer" role="button" class="open-PDFViewer btn default btn-xs blue-stripe" data-toggle="modal" data-id="<?php echo site_url('Docreader/ReaderDok/'.$dirMEP); ?>">Lihat</a>
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
				<td align="center"><input type="checkbox" name="syarat_<?=$row->id_detail?>" value="<?=$row->id_detail?>" id="syarat_<?=$row->id_detail?>" onchange="check_status('syarat_<?=$row->id_detail?>','<?=$row->id_detail?>','mep')" <?=$checked?>></td>			  
			</tr>
			<?php
			$i++;
			$jns_syarat_sblm = $detail;
		} ?>          
    </tbody>
</table>
<!-- End Data MEP -->