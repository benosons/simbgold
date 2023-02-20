<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>Monitoring Permohonan IMB
		</div>
		<div class="tools">
			<a href="javascript:;" class="reload"></a>
		</div>
	</div>
		<div class="portlet-body">
			<div class="form-group">
				<label class="control-label col-md-3">Bentuk Kepemilikan</label>
				<div class="col-md-3">
					<select class="form-control select2me" name="id_jenis_usaha">
						<option value="">--Pilih--</option>
						<option value="1">Perseorangan</option>
						<option value="2">Badan Usaha/Hukum</option>
						<option value="3">Pemerintah</option>
					</select>
				</div>
			</div>
			<!--<div class="form-group">
				<label class="control-label col-md-3">Tanggal Pengajuan</label>
				<div class="col-md-3">
					<select class="form-control select2me" name="id_jenis_usaha">
						<option value="">--Pilih--</option>
						<option value="1">Perseorangan</option>
						<option value="2">Badan Usaha/Hukum</option>
						<option value="3">Pemerintah</option>
					</select>
				</div>
			</div>-->
			<table class="table table-striped table-bordered table-hover" id="sample_2">
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
	                  <th>Status</th>
	                </tr>
                </thead>
                <tbody>

				<?php
					if($dataimb->num_rows() > 0){
                	$no = 1;
                	foreach ($dataimb->result() as $imb) {
	            ?>
				
				<?php
					if($imb->status_progress == ''){
						$clss = "danger";
					}elseif($imb->status_progress == 1){
						$clss = "danger";
					}elseif($imb->status_progress == 2){
						$clss = "warning";
					}elseif($imb->status_progress == 3){
						$clss = "warning";
					}elseif($imb->status_progress == 4){
						$clss = "info";
					}else{
						$clss = "success";
					}
				?>
	                <tr class="<?=$clss?>">
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
					  <td align="center"><?php echo $imb->status_admin;?> 
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
