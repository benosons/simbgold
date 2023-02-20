<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>Penetapan Retribusi IMB
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
	                  <th>Retribusi</th>
	                  <th>Aksi</th>
	                </tr>
                </thead>
                <tbody>

				<?php
					if($dataimb->num_rows() > 0){
                	$no = 1;
                	foreach ($dataimb->result() as $imb) {
						
										$id_ret = "";
										$status_ret = "";
										$duitM = "";
										$duitO="";
										
										$query2 = $this->imb_model->get_data_ret($imb->id_permohonan,null,'1');
										$mydata2 = $query2->row_array();
										$baris2 = $query2->num_rows();
										if ($baris2 >= 1 ) {
											$id_ret = $mydata2['id_penetapan_retribusi'];
											$status_ret = $mydata2['id_cara_penetapan'];
											$duitM = $mydata2['retribusi_manual'];
											$duitO = $mydata2['retribusi'];
										}
										
										$bgcolor="";
										$ustat="";
										/*if($id_ret == '' || $id_ret == '0'){
											$bgcolor="danger";
											$ustat="0";
										}else{
											$bgcolor="success";
											if($status_ret == '1'){
												$ustat=$duitO;
											}else{
												$ustat=$duitM;
											}
										}*/
										if($id_ret == '' || $id_ret == '0'){
											$bgcolor="danger";
											$ustat="0";
											$statusnya ="Belum Ditetapkan";
										}else{
											if($imb->status_progress == 11){
												$bgcolor="warning";
												$statusnya ="SKRD Belum Ditetapkan";
											}else if($imb->status_progress == 12){
												$bgcolor="warning";
												$statusnya ="Menunggu Pembayaran";
											}else if($imb->status_progress == 13){
												$bgcolor="warning";
												$statusnya ="Verifikasi Pembayaran";
											}else{
												$bgcolor="success";
												$statusnya ="Pembayaran Terverifikasi ";
											}
											
											if($status_ret == '1'){
												$ustat=$duitO;
											}else{
												$ustat=$duitM;
											}
										}
						
						
						
	            ?>

	               <tr class="<?=$bgcolor?>">
	                  <td align="center"><?php echo $no++;?></td>
					  <td><?php echo $imb->nama_permohonan;?></td>
					  <td align="center"><?php echo $imb->nomor_registrasi;?></td>
	                  <td align="center"><?php echo $imb->nama_pemohon;?></td>
					  <!--td align="center">
					  <?php 
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
					  <td>
					  Rp.<?php if($ustat == 0){ echo '';}else{echo number_format($ustat,0,'','.');}?>,-<br><?php echo $statusnya;?>
						<!--?php 
								if($imb->retribusi_manual != 0){
									$duit = $imb->retribusi_manual;
								}else{
									$duit = $imb->retribusi;
								}
							 echo $duit;?-->
					  
					  </td>
					  
					  <!--td align="center"><a href="#" class="btn btn-success btn-sm" title="Verivikasi Data" id="tombolver" data-toggle="modal" data-target="#stack1"><span class="glyphicon glyphicon-edit"></span></a></td-->
					  <td align="center">
					  <a href="#" onClick="href='<?php echo site_url('retribusi/retribusi_form/'.$imb->id_permohonan);?>'" class="btn btn-info btn-sm" title="Buat Penjadwalan" id="tombolver"><span class="glyphicon glyphicon-edit"></span></a>
					  <a href="#" onClick="href='<?php echo site_url('detail/detail_imb/'.$imb->id_permohonan);?>'" class="btn btn-info btn-sm" title="Lihat Data" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a></td>
					  
					
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
