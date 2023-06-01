<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>Sidang TABG & Penilaian Teknis
		</div>
		<div class="tools">
		<a href="javascript:;" class="reload">
								</a>
		</div>
	</div>
		<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover" id="sample_1">
			<?php
									echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-'.$this->session->flashdata('status').'">'.$this->session->flashdata('message').'</div>' : '';    
			?>
                <thead>
	                <tr>
	                  <th>No</th>
	                  <th>Jenis Permohonan</th>
					  <th>Nomor Registrasi</th>
	                  <th>Nama Pemilik</th>
					  <th>Lokasi BG</th>
	                  <th>Tanggal Sidang</th>
	                  <th>Aksi</th>
	                </tr>
                </thead>
                <tbody>

				<?php
					if($dataimb->num_rows() > 0){
                	$no = 1;
                	foreach ($dataimb->result() as $imb) {
						
						$id_penjadwalan = "";
										$status_perbaikan = "";
										$tgl_sidang = "";
										
										$query2 = $this->imb_model->get_data_penjadwalan($imb->id_permohonan,null,'1');
										$mydata2 = $query2->row_array();
										$baris2 = $query2->num_rows();
										if ($baris2 >= 1 ) {
											$id_penjadwalan = $mydata2['id_penjadwalan'];
											$status_perbaikan = $mydata2['status_perbaikan'];
											$tgl_sidang = ($mydata2['tgl_sidang']);
										}
										$bgcolor="";
										$ustat="";
										/*if($id_penjadwalan == '' || $id_penjadwalan == '0'){
											$bgcolor="danger";
											$ustat="Belum Dijadwalkan";
										}else{
											if($status_perbaikan == '1'){
												$bgcolor="warning";
												$ustat="Perlu Perbaikan";
											}else if($status_perbaikan == '2'){
												$bgcolor="success";
												$ustat="Lolos Persidangan";
											}else{
												$bgcolor="info";
												$ustat="Sudah Dijadwalkan";
											}
										}*/
										if($imb->status_progress <= 6){
											$bgcolor="danger";
											$ustat="Belum Dijadwalkan";
										}else{
											if($imb->status_progress == 7){
												$bgcolor="info";
												$ustat="Sudah Dijadwalkan <br> $tgl_sidang";
											}else if($imb->status_progress == 8){
												$bgcolor="warning";
												$ustat="Perlu Perbaikan";
											}else if($imb->status_progress == 9){
												$bgcolor="warning";
												$ustat="Sudah Diperbaiki &<br> Belum Dijadwalkan Ulang" ;
											}else if($imb->status_progress == 10){
												$bgcolor="info";
												$ustat="Sudah Dijadwalkan Ulang <br> $tgl_sidang";
											}else if($imb->status_progress >= 11){
												$bgcolor="success";
												$ustat="Selesai Persidangan";
											}
										}
	            ?>
				
			
	                <tr class="<?=$bgcolor?>">
	                  <td align="center"><?php echo $no++;?></td>
					  <td><?php echo $imb->nama_permohonan;?></td>
					  <td align="center"><?php echo $imb->nomor_registrasi;?></td>
	                  <td align="center"><?php echo $imb->nama_pemohon;?></td>
					  <!--td align="center"><?php 
								if($imb->id_jenis_usaha == 1){
									$usaha = "Perseorangan";
								}elseif($imb->id_jenis_usaha == 2){
									$usaha = "Badan Usaha";
								}elseif($imb->id_jenis_usaha == 3){
									$usaha = "Badan Hukum";
								}
							echo $usaha;?>
					  </td-->
					  <td><?php echo $imb->alamat_bg;?></td>
					  <td align="center">
							<?php echo $ustat;?>
					  
					  </td>
					  
					  <!--td align="center"><a href="#" class="btn btn-success btn-sm" title="Verivikasi Data" id="tombolver" data-toggle="modal" data-target="#stack1"><span class="glyphicon glyphicon-edit"></span></a></td-->
					  <td align="center">
					  
					  <a href="#" onClick="href='<?php echo site_url('penjadwalan/pp/'.$imb->id_permohonan);?>'" class="btn btn-info btn-sm" title="Buat Penjadwalan" id="tombolver"><span class="glyphicon glyphicon-edit"></span></a>
					  <a href="#" onClick="href='<?php echo site_url('detail/detail_imb/'.$imb->id_permohonan);?>'" class="btn btn-info btn-sm" title="Lihat Data" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a>
					  
					  </td>
					  
					
					</tr>
	                <?php			
	                		}
	                	}
	                ?>
				                
                </tbody>
             </table>
		</div>
</div>

	



<!-- /.modal -->

<!-- /.modaledit -->
<div id="modal-edit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-focus-on="input:first">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
        </div>
        <!-- /.modal-content -->
	</div>
</div>

							

<script>
  
  
 
</script>
