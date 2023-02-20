<!-- BEGIN PAGE CONTENT-->

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-globe"></i>List Data IMB
		</div>
		<div class="tools">
			<a href="javascript:;" class="reload"></a>
		</div>
	</div>
		<div class="portlet-body">
			<div class="form-actions">
				<?php echo form_open('imb/validasi_kasie',array('name'=>'frmListValidasi', 'id'=>'frmListValidasi')); ?>
				<div class="row">
						<div class="col-md-12">
							<div class="form-group col-md-12">
								<label class="control-label col-md-3"><b>Fungsi Bangunan</b></label>
								<div class="col-md-9">
									<div class="col-md-5">
										<select class="form-control select2me" name="id_fungsi_bg">
											<option value="">Semua Fungsi</option>
											<option value="1" <?php if(isset($id_fungsi_bg) && $id_fungsi_bg == 1) echo "selected";?>>Fungsi Hunian</option>
											<option value="2" <?php if(isset($id_fungsi_bg) && $id_fungsi_bg == 2) echo "selected";?>>Fungsi Keagamaan</option>
											<option value="3" <?php if(isset($id_fungsi_bg) && $id_fungsi_bg == 3) echo "selected";?>>Fungsi Usaha</option>
											<option value="4" <?php if(isset($id_fungsi_bg) && $id_fungsi_bg == 4) echo "selected";?>>Fungsi Sosial dan Budaya</option>
											<option value="5" <?php if(isset($id_fungsi_bg) && $id_fungsi_bg == 5) echo "selected";?>>Fungsi Khusus</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label class="control-label col-md-3"><b>Tahap Proses Validasi</b></label>
								<div class="col-md-9">
									<div class="col-md-5">
										<select class="form-control select2me" name="id_proses">
											<option value="">Semua Proses permohonan</option>
											<option value="1" <?php if(isset($id_proses) && $id_proses == 1) echo "selected";?>>Belum Divalidasi</option>
											<option value="2" <?php if(isset($id_proses) && $id_proses == 2) echo "selected";?>>Sudah Divalidasi</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label class="control-label col-md-3"><b>Tanggal Permohonan IMB</b></label>
								<div class="col-md-9">
									<div class="col-md-2">
										<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggalawal" value="<?=(isset($tanggalawal) ? tgl_eng_to_ind($tanggalawal) : '');?>" placeholder="01-01-2018"/>
									</div>
									<label class="control-label col-md-1"><center><b>s/d</b></center></label>
									<div class="col-md-2">
										<input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggalakhir" value="<?=(isset($tanggalakhir) ? tgl_eng_to_ind($tanggalakhir) : '');?>" placeholder="31-12-2020"/>
									</div>
								</div>
							</div>
						<div class="form-group col-md-12">
							<label class="control-label col-md-3"><b></b></label>
							<div class="col-md-9">
								<div class="col-md-12">
									<input  type="submit" class="btn green" id="search" name="search" value="Pencarian">
									<button type="submit" class="btn green" onclick="resetCari()">Reset</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
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
	                  <th>Status</th>
	                  <th>Verifikasi</th>
	                </tr>
                </thead>
                <tbody>

				<?php
					if($dataimb->num_rows() > 0){
                	$no = 1;
                	foreach ($dataimb->result() as $imb) {
	            ?>
				
				<?php 
					if($imb->status_progress >= 5){
						$clss = "success";
					}elseif($imb->status_progress == 1){
						$clss = "danger";
					}elseif($imb->status_progress == 2){
						$clss = "warning";
					}elseif($imb->status_progress == 3){
						$clss = "warning";
					}elseif($imb->status_progress == 4){
						$clss = "danger";
					}else{
						$clss = "danger";
				}?>
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
					  <td align="center"><?php 
								if($imb->status_progress <= 3){
									$class = "label label-sm label-warning";
									$syarat = "Menunggu Perbaikan";
								}elseif ($imb->status_progress == 4){
									$class = "label label-sm label-danger";
									$syarat = "Menunggu Validasi";
								}elseif ($imb->status_progress >= 5){
									$class = "label label-sm label-success";
									$syarat = "Tervalidasi";
								};?>
							<span class="<?php echo $class;?>"><?php echo $syarat;?></span> 
					  </td>
					 
					  <!--td align="center"><a href="#" class="btn btn-success btn-sm" title="Verivikasi Data" id="tombolver" data-toggle="modal" data-target="#stack1"><span class="glyphicon glyphicon-edit"></span></a></td-->
					  <td align="center">
					  <?php  if ($imb->status_progress == 4) { ?>
					  <a href="#" onClick="href='<?php echo site_url('imb/form_verifikasi/'.$imb->id_permohonan);?>'" class="btn btn-info btn-sm" title="Validasi Data" id="tombolver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-edit"></span></a>
					  <!--a href="#dialog-popup2" onClick="GetVal(<? echo $imb->id_permohonan ?>)" class="btn btn-warning btn" title="Lihat" id="tombolinver" data-toggle="modal" data-target="#dialog-popup2">Menunggu Verifikasi <br> ( klik disini ) </a-->
					  <?}else{?>
					  <a href="#" onClick="href='<?php echo site_url('detail/detail_imb/'.$imb->id_permohonan);?>'" class="btn btn-info btn-sm" title="Lihat Data" id="tombolinver" data-toggle="modal" data-target="#modal-edit"><span class="glyphicon glyphicon-user"></span></a>
					  </td>
					  <?}?>
					
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

<!-- /.modaledit -->
<div class="modal fade" id="dialog-popup2" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
  
    <div class="modal-content" id="MyModalBody">
     
      
    </div>
	
  </div>
</div>

							

<script>
  
	function GetVal(id)
	{
	//alert(id);
	$("#MyModalBody").html('<iframe src="<?php echo base_url();?>imb/form_verifikasi/'+id+'" frameborder="no" width="100%" height="680"></iframe>');
	$('[name="id_permohonannya"]').val(id);
	}
 
</script>
