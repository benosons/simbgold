<script type="text/javascript">

function GetPdfLap(id,f){
	//alert(id);
	url = "<?php echo base_url() . index_page() ?>file/IMB/pengajuan_imb/"+id+"/"+"imb_n_lampiran"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

$( function() {
	$.initWindowMsg();
	var options = {
        beforeSubmit : function () { $('div#loading').fadeIn(); }, 
		success:       showResponse,
		cache:false,
		dataType: 'json'
	};
	$('#frmDokTeknis').ajaxForm(options);
});

function showResponse1(responseText)  {
	if (responseText['valid'] == 'true') {
			$.ajax({
			url: baseHref + 'permohonan_slf/get_data_teknis/<?=$pengajuan_id?>/<?=$id_nama_permohonan?>',
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
	<?php echo form_open_multipart('permohonan_slf/verifikasi_teknis_submit/',array('name'=>'frmDokTeknis', 'id'=>'frmDokTeknis')); ?>
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
							if(!empty($MasterTeknis)){
								$no = 1;
								foreach ($MasterTeknis->result() as $key) {
									if ($no % 2 == 0 )
										$clss = "event";
									else
										$clss = "event2";
									
									$setValChild 	= '';
									$dir_file = "";
									$id_dokumen_permohonan = "";
									if(!empty($DataTeknis)){
										foreach ($DataTeknis->result() as $keyChild) 
										{
											$file = $keyChild->dir_file;
											$id_dokumen_permohonan = $keyChild->id_dokumen_permohonan;
											$status_verifikasi = $keyChild->verifikasi;
											$id_data_teknis = $keyChild->id;
											if($key->id_syarat_slf == $id_dokumen_permohonan)
											{
												if($status_verifikasi == '1'){
													$setValChild = 'checked';
												}
												$id_data_teknis = $id_data_teknis;
												if($file != '' or $file != null){
													$dir_file = $file;
												}
											}
										}
									}
									$dir_file_pernyatan = '';
									if($DataSummary['id_kelaikan_fungsi'] == '1')
									{
										$dir_file_pernyatan = explode('\\',$DataSummary['dir_file_dokumen']);
										$dir_file_pernyatan = (isset($dir_file_dokumen[2]) ? $dir_file_dokumen[2] : '');
									}
						?>
						<tr class="<?=$clss?>" >
							<td align="center"><?php echo $no++;?></td>
							<td align="center"><?php echo $key->nama_syarat_slf;?> </td>
							<td align="center">
								<!-- Download jika memiliki Dokumen IMB dari upload di pendaftaran -->
								<?
									if($key->id_syarat_slf == '14'){
										if ($DataSummary['id_kelaikan_fungsi'] == '1'){?>
										<center>
											<?
											$surat_pernyataan = '';
											if($DataSummary['dir_file_dokumen'] != '')
												{
												$surat_pernyataan = explode('\\',$DataSummary['dir_file_dokumen']);
												$surat_pernyataan = (isset($surat_pernyataan[2]) ? $surat_pernyataan[2] : '');
												}
											?>
											<a href="javascript:void(0);" onClick="javascript:GetPdfPernyataanTeknis('<?php echo $pengajuan_id;?>','<?php echo $surat_pernyataan; ?>')" >
											<?php echo 'Download' ?>
										</a>
										</center>
									<?}?>
									<?}
									if($key->id_syarat_slf == '1000') {
										if($DataSummary['id_permohonan'] != '0'){?>
											<center>	
												<a href="javascript:void(0);" onClick="javascript:GetPdfLap('<?php echo $DataSummary['id_permohonan'] ?>','<?php echo $DataSummary['dir_file_imb'] ?>')" >
													<?php echo 'Download' ?>
												</a>
											</center>
										<?}else if ($dir_file != ''){?>
											<center>	
												<a href="javascript:void(0);" onClick="javascript:GetPdfTeknis('<?php echo $pengajuan_id;?>','<?php echo $key->id_syarat_slf;?>','<?php echo $dir_file;?>')" >
													<?php echo 'Download' ?>
												</a>
											</center>
										<?}else{?>
											<center>
												<?php echo 'Tidak Ada File' ?>
											</center>
										<?}?>
									<?}else if($dir_file !=''){?>
									<center>	
										<a href="javascript:void(0);" onClick="javascript:GetPdfTeknis('<?php echo $pengajuan_id;?>','<?php echo $key->id_syarat_slf;?>','<?php echo $dir_file;?>')" >
											<?php echo 'Download' ?>
										</a>
									</center>
									<?}else{?>
										<center>
											<?php echo 'Tidak Ada File' ?>
										</center>
									<?}?>
							</td>
							<td>
								<center>
									<input type="checkbox" name="syarat_<?=$key->id_syarat_slf?>" value="<?=$key->id_syarat_slf?>" id="syarat_<?=$key->id_syarat_slf?>" onchange="check_status_teknis('syarat_<?=$key->id_syarat_slf?>','<?=$key->id_syarat_slf?>')" <?=$setValChild?>>
								</center>
							</td>
						</tr>
						<?php			
								}
							}
						?>
				</table>
			</dl>
		</fieldset>	
	</fieldset>	
	<div class="space-line"></div>
	<div class="blank"></div>
	<div class="spacer"></div> 
	<?php echo form_close(); ?>
</center>
