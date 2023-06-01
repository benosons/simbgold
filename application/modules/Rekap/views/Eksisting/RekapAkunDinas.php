<script type="text/javascript">
function resetCari() {	
	var url = "<?php echo base_url() . index_page() ?>Rekap/Dinas/";
	$('#loading').fadeIn();
	$.getJSON( baseHref + 'Rekap/killSession/' ,
		function() {
			window.location.replace(url);
		}
	);
	$('#loading').fadeOut();
}
</script>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-globe"></i>Rekap Status Akun Dinas  Teknis dan Perizinan</div>
		<div class="tools"><a href="javascript:;" class="reload"></a></div>
	</div>
	<div class="portlet-body">
		<div class="form-actions">
			<?php echo form_open('Rekap/Dinas',array('name'=>'frmListRekapInformasi', 'id'=>'frmListRekapInformasi')); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Status Akun</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<select class="form-control select2me" name="status">
									<option value="">Semua</option>
									<option value="1" <?php if(isset($status) && $status == 1) echo "selected";?>>Sudah Lengkap</option>
									<option value="2" <?php if(isset($status) && $status == 2) echo "selected";?>>Hanya Perizinan</option>
									<option value="3" <?php if(isset($status) && $status == 3) echo "selected";?>>Hanya Teknis</option>
									<option value="4" <?php if(isset($status) && $status == 4) echo "selected";?>>Belum Semua</option>
								</select>
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
			<table class="table table-striped table-bordered table-hover" id="sample_1">
                <tbody>
					<tr class="warning">
						<th>No</th>
						<th>Kabupaten/Kota</th>
						<th>Dinas Teknis</th>
                        <th>Dinas Perizinan</th>
                        <th>Aksi</th>
					</tr>
					<?php if ($jum_data==0){ ?>
						<tr><td class="clcenter" colspan="5">Data is Empty</td></tr>
					<?php } else {
						$i= 1;
						$loksblm = '';
						$Teknis= 0; 
						$Perizinan = 0;
						$t_total =0; 
						if (isset($status) == ''){
							$status2 = 0;
						} else {
							$status2 = $status;
						}
						foreach ($result as $row) {;
							if ($i % 2== 0 )
								$clss = "event";
							else
								$clss = "event2";		
								$Teknis = $row->status_teknis;
								$Perizinan = $row->status_perizinan;
							?>		  
							<tr class="<?=$clss?>" id="record">
								<td class="center"><?php echo $i?></td>								
								<td class="clleft"><?php echo $row->nama_kabkota; ?></td>										
								<td class="center">
                                    <?php if ($Teknis == 0){ ?>Belum Diberikan<?php } else { ?>
										Sudah Diberikan
									<?php } ?>
								</td>
								<td class="clcenter">
									<?php if ($Perizinan == 0){?>Belum Diberikan<?php } else { ?>
										Sudah Diberikan
									<?php }?>
								</td>
								<td class="clcenter">
                                    <a href="<?php echo site_url('Rekap/FormVerifikasi/' . $row->id_kabkot); ?>" class="btn btn-success btn-sm" title="Ubah Data Personil" data-toggle="modal" data-target="#static"><span class="glyphicon glyphicon-edit"></span></a>
                                </td>
							</tr>
							<?php $i++;
						}?>
						<tr class="<?=$clss?>" id="record">
							<td class="clcenter" colspan='5'><b>Selesai</b></td>															
						</tr>
					<?php } ?>	
				</tbody>
            </table>
        </div>
    </div>
</div>
<div id="static" class="modal fade bs-modal-lg" data-width="40%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-body"></div>
    </div>
</div>

