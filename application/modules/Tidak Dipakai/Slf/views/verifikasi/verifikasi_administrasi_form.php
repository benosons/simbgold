<script type="text/javascript">
$( function() {
	$.initWindowMsg();
	var options = {
        beforeSubmit : function () { $('div#loading').fadeIn(); }, 
		success:       showResponse,
		cache:false,
		dataType: 'json'
	};
	$('#frmDokAdministrasi').ajaxForm(options);
});

function showResponse(responseText)  {
	if (responseText['valid'] == 'true') {
			$.ajax({
			url: baseHref + 'permohonan_slf/get_data_administrasi/<?=$pengajuan_id?>/<?=$id_nama_permohonan?>',
			type: 'GET',
			dataType: 'html',
			cache:false,
			success: function( response ) {
				$('div#detail_personal').html('');
				$('div#detail_personal').html(response);
			}
		});
	}
	else {
		show_err(responseText['err_msg']); 
	}
	$('div#loading').fadeOut();
}
</script>
<style>
	.color
	{
		font-family:    Arial, Helvetica, sans-serif;
		font-size:      35px;
		font-weight:   bold;
		color: red !important;
	}
</style>	

<center>
	<?php echo form_open_multipart('permohonan_slf/verifikasi_administrasi_submit/',array('name'=>'frmDokAdministrasi', 'id'=>'frmDokAdministrasi')); ?>
	
	<div class="blank"></div> 
    <div class="spacer"></div>
	<div id="top"></div>
	
	<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all">
		<fieldset class="panel-form">
			<dl>
				<table class="tbl" align="center" border="0" cellpadding="2" cellspacing="1" width="100%">			
					<thead>
						<tr style="padding-left: 5px; padding-bottom:3px; color:#FFF; font-weight:bold">
							<th width="3%">No.</th>
							<th width="30%">Nama Dokumen</th>
							<th width="15%">File</th>
							<th width="3%">Verifikasi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							
							if(!empty($MasterAdministrasi)){
								$no = 1;
								foreach ($MasterAdministrasi->result() as $key) {
									if ($no % 2 == 0 )
										$clss = "event";
									else
										$clss = "event2";
									
									$setValChild 	= '';
									$id_administrasi 	= '';
									$dir_file		 	= '';
									if(!empty($DataAdministrasi))
									{
										foreach ($DataAdministrasi->result() as $keyChild)
										{
											$file = $keyChild->dir_file;
											$id_dokumen_permohonan = $keyChild->id_dokumen_permohonan;
											$status_verifikasi = $keyChild->verifikasi;
											$id_data_administrasi = $keyChild->id;
											if($key->id_syarat_slf == $id_dokumen_permohonan)
											{
												if($status_verifikasi == '1'){
													$setValChild = 'checked';
												}
												
												$id_administrasi = $id_data_administrasi;
												if($file != '' or $file != null){
													$dir_file = $file;
												}
											}
										}
									}
									?>
						<tr class="<?=$clss?>" >
							<td align="center"><?php echo $no++;?></td>
							<td align="center"><?php echo $key->nama_syarat_slf;?></td>
							<td align="center">
							<? if($dir_file !='')
								{?>
									<center>	
										<a href="javascript:void(0);" onClick="javascript:GetPdfAdministrasi('<?php echo $pengajuan_id;?>','<?php echo $key->id_syarat_slf;?>','<?php echo $dir_file;?>')" >
											<?php echo 'Download' ?>
										</a>
									</center>
								<?}else
								{?>
									<center>
										<?php echo 'Tidak Ada File' ?>
									</center>
								<?}?>
							</td>
							<td>
								<center>
									<input type="checkbox" name="syarat_<?=$key->id_syarat_slf?>" value="<?=$key->id_syarat_slf?>" id="syarat_<?=$key->id_syarat_slf?>" onchange="check_status('syarat_<?=$key->id_syarat_slf?>','<?=$key->id_syarat_slf?>')" <?=$setValChild?>>
								</center>
							</td>
						</tr>
						<?php			
								}
							}
						?>
					</tbody>
				</table>
			</dl>
		
		</fieldset>	
	</fieldset>	
	
	<div class="space-line"></div>
	<div class="blank"></div>
	<div class="spacer"></div> 
			

	<?php echo form_close(); ?>
</center>
