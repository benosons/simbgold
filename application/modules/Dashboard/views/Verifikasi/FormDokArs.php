<table id="sample_2" class="table table-bordered table-striped table-hover">
    <thead>
	    <tr>
	        <th>No</th>
	        <th>Dokumen Arsitektur</th>
	        <th>Keterangan</th>
			<th>Berkas</th>
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
					$query = $this->mdashboard->getSyarat($row->id_detail,$this->uri->segment('3'))->result_array();
					for($n=0;$n<count($query);$n++) {
						$cek = $query[$n]['id_persyaratan_detail'];
						$dir = $query[$n]['dir_file'];
						$status = $query[$n]['status'];
						$ipk=$this->uri->segment('3');
					} ?>
				<td><?php echo $row->nm_dokumen;?></td>
				<td><?php echo $row->keterangan;?></td>
				<td align="center">
					<?php if($row->id_detail == $cek){ 
						$filename = FCPATH . "/object-storage/dekill/Requirement/$dir";
						$dirum = '';
						if (file_exists($filename)) {
							$dirars = './object-storage/dekill/Requirement/' . $dir;
						} else {
							$dirars = './object-storage/file/Konsultasi/' . $ipk . '/Dokumen/' . $dir;
						}
						$dirArsT	= $this->Outh_model->Encryptor('encrypt', $dirars);
						?>
						<?php if($dir != ''){ ?>
							<a href="#PDFViewer" role="button" class="open-PDFViewer btn default btn-xs blue-stripe" data-toggle="modal" data-id="<?php echo site_url('Docreader/ReaderDok/'.$dirArsT); ?>">Lihat</a>
						<?php } else { ?>
							[Tidak Ada Dokumen]
						<?php } ?>
					<?php } ?>	
				</td>
			</tr>
			<?php
			$i++;
			$jns_syarat_sblm = $detail;
		} ?>          
    </tbody>
</table>