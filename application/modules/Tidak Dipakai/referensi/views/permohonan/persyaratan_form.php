<script type="text/javascript">
function popupWinHdno() {
	var ju = $('#jenis_urusan').val();
	if(ju != ''){
		var url = "<?php echo base_url() . index_page() ?>urusan_rn/list_rumahnegara_popup/"+ju; 
		openCenteredWindow(url);
	}else{
		alert('Pilih Nama Permohonan terlebih dahulu');
	}
}
function popupWinDep() {
	var url = "<?php echo base_url() . index_page() ?>urusan_rn/list_kementerian_popup/"; openCenteredWindow(url);
} 
function popupWinKabkot() {
	var url = "<?php echo base_url() . index_page() ?>rumah_negara/list_kabkot_popup/"; openCenteredWindow(url);
} 
function popupWinProv() {
	var url = "<?php echo base_url() . index_page() ?>rumah_negara/list_provinsi_popup/"; openCenteredWindow(url);
} 
function popupHdno() {
	var url = "<?php echo base_url() . index_page() ?>urusan_rn/list_hdno_popup/"; openCenteredWindow(url);
}
function popupSyarat() {
	var e = document.getElementById("id_jenis_persyaratan").value;
	
	<?
		if($id_persyaratan != ''){
	?>
	var id_persyaratan = <?=$id_persyaratan?>;
	<?}else{?>
	var id_persyaratan = "";
	<?}?>
	
	var url = "<?php echo base_url() . index_page() ?>syarat2/list_syarat_popup/"+e+"/"+id_persyaratan; openCenteredWindow(url);
} 

function lookUpNilai(){
	value = pilih();
	$.triggerParentEvent("getSyarat_event", value);
	val = $('#banyak_syarat').val();
	opener.document.forms[0].jmlSyarat.value = val;
	var sdhdipilih = $('#sdhdipilih').val();
	var dataid = opener.document.getElementById("idsdh_pilih").value;
	
	var z = dataid.split("~");
	var c = z.length;
	var idsyarat = "";
	var idsyarat2 = "";
	for (var i=0; i < c-1; i++)
	{
		idsyarat = z[i];
		idsyarat2 = idsyarat2+idsyarat+"~";
	}	 
	opener.document.getElementById("idsdh_pilih").value = idsyarat2+sdhdipilih;
	window.close();
}

function rubah(){
	$('#id_rumah_negara').val('');
	$('#hdno').val('');
	$('#nm_penghuni').val('');
}

var i=0;
$(document).ready(function() {
	$.initWindowMsg();
	$.windowMsg("getSyarat_event",function(message) {
			var asli = $("#daftar_syarat").html();
			var message2 = asli+message;
			$("#daftar_syarat").empty();
			$("#daftar_syarat").append(message2) ;
			banyak = $("#daftar_syarat > tr").size();
			$("#jmlSyarat").val(banyak);
			i++;
	});
});

function addRow() {
	var tbl = $('#tblDetail');
	var lastRow = (tbl.find("tr").length)+1;
	var txtpeg = '<input name="nama_syarat-'+lastRow+'" id="nama_syarat-'+lastRow+'"/>';
	var txtdel = '<div class="delete2" title="Delete Data" onClick="hapus_syarat('+lastRow+')" id="ddsyarat'+lastRow+'"></div>';
	tbl.append("<tr class='event' id='list_syarat-"+lastRow+"'><td class='clleft'>"+txtpeg+"</td><td class='clleft'>"+txtnip+"</td><td class='clleft'>"+txtgol+"</td><td class='clleft'>"+txtjab+"</td><td class='clcenter'>"+txtdel+"</td></tr>");
	$('#jmlSyarat').val(lastRow);
}

function hapus_syarat(a,v){  
	var jwb = confirm('Anda yakin menghapus data iniasd ? ');
	if (jwb) {
		var dataid = document.getElementById("idsdh_pilih").value;
		var z = dataid.split("~");
		var c = z.length;
		var idpeg = "";
		var idpeg2 = "";
		var b = $("#id_syarat-"+a).val();
		$("#list_syarat-"+a).remove();
		
		for (var i=0; i < c-1; i++)
		{
			idpeg = z[i];
			if(b != idpeg){
				idpeg2 = idpeg2+idpeg+"~";
			}
		}	
		document.getElementById("idsdh_pilih").value = idpeg2;
		
		$.ajax({
			url: baseHref + 'syarat2/delete_detail_syarat/'+v,
			type: 'POST',
			dataType: 'html',
			cache:false,
			success: function( response ) {
				//alert(response);
			}
		});
	}
}
</script>	
	<center>
		<?php echo form_open_multipart('syarat2/persyaratan_form/'.$id_persyaratan,array('name'=>'frmsurat_mohon', 'id'=>'frmsurat_mohon')); ?>
			<div class="blank"></div> 
            		<div class="spacer"></div>
			<div id="top"></div>
			<div id="confirm" class="confirm" style="display: none;"></div>	
			<h3 class="title">Daftar Persyaratan Administrasi dan Teknis Permohonan IMB</h3>
			
			<?php 
				if (isset($err_msg) && $err_msg != '' ) { ?>
					<div class="errwarning"><?=$err_msg?></div>
			<?php } ?>
			<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all">
				<fieldset class="panel-form">
					<dl>
						<dt>Nama Permohonan</dt>
						<dd class="dot2">:</dd>
						<dd class="col-right">
							<?php
							$selected = '';
										
							if(isset($id_jenis_permohonan) && $id_jenis_permohonan != '')
								$selected = $id_jenis_permohonan;
							else
								$selected = '';
							
							$js= "id='id_jenis_permohonan'";
							echo form_dropdown('id_jenis_permohonan', $list_jenis_urusan, $selected, $js);
						?>
						</dd>
					</dl>
					
					<dl>
						<dt>Jenis Persyaratan</dt>
						<dd class="dot2">:</dd>
						<dd class="col-right">			
							<?php $selected = '';
										$list['0'] = '--Pilih--';
										$list['1'] =  'Persyaratan Administratif';
										$list['2'] =  'Persyaratan Teknis';
										if (isset($id_jenis_persyaratan) && $id_jenis_persyaratan != '')
											$selected = $id_jenis_persyaratan;
										$js = "id='id_jenis_persyaratan' ";
										echo form_dropdown('id_jenis_persyaratan',$list,$selected,$js);
								?>	
						</dd>
					</dl>
					<dl>
						<dt>Sub Persyaratan</dt>
						<dd class="dot2">:</dd>
						<dd class="col-right">			
							<?php $selected = '';
										$list_detail_syarat['0'] = '--Pilih--';
										$list_detail_syarat['1'] =  'Rencana Arsitektur';
										$list_detail_syarat['2'] =  'Rencana Struktur';
										$list_detail_syarat['3'] =  'Rencana Utilitas';
										$list_detail_syarat['4'] =  'Perizinan dan/ atau Rekomendasi lainnya';
										$list_detail_syarat['5'] =  'Adm';
										$list_detail_syarat['6'] =  'Optional';
										if (isset($id_detail_jenis_persyaratan) && $id_detail_jenis_persyaratan != '')
											$selected = $id_detail_jenis_persyaratan;
										$js = "id='id_detail_jenis_persyaratan' ";
										echo form_dropdown('id_detail_jenis_persyaratan',$list_detail_syarat,$selected,$js);
								?>	
						</dd>
					</dl>
					
					
					<dl>
						<dt></dt>
						<dd class="dot2"></dd>
						<dd class="col-right">
							<div align='right' >
							<input type='button' name='getSyarat' id='getSyarat' value='Pilih Dokumen' onClick='popupSyarat()' title="Syarat - Syarat"/>
							<input type='hidden' name='jmlSyarat' id='jmlSyarat' value="<?=set_value('jmlSyarat',isset($jmlSyarat) ? $jmlSyarat : '0')?>">
							<input type='hidden' name='jumSyaUp' id='jumSyaUp' value="<?=set_value('jmlSyarat',isset($jmlSyarat) ? $jmlSyarat : '')?>">
							</div>
						</dd>
					</dl>
					<dl>
						<dt></dt>
						<dd class="dot2"></dd>
						<dd class="col-right">
							<div>
								<table class="tbl2" align="center" border="0" cellpadding="2" cellspacing="1">			
								<thead>
									<tr style="padding-left: 5px; padding-bottom:3px; color:#FFF; font-weight:bold">
										<th><center>#</center></th>
										<th><center>Dokumen Persyaratan</center></th>
										<th><center>Hapus</center></th>
									</tr>
								</thead>
								<tbody id="daftar_syarat">
									<?php 
									$idsyarat = '';
									if (isset($jmlSyarat) && $jmlSyarat > 0) { 
										for($j=0;$j<$jmlSyarat;$j++) { ?>
											<tr class='event' id="list_syarat-<?=$j?>">
												<? if($result_syarat[$j]['id_syarat'] != '') {
													$namasyarat = $result_syarat[$j]['nama_syarat'];
													}
												?>
												<td><input type='hidden' name='id_syarat-<?=$j?>' id='id_syarat-<?=$j?>' value='<?=$result_syarat[$j]['id_syarat']?>'></td>
												<td><input type='hidden' name='nama_syarat-<?=$j?>' id='nama_syarat-<?=$j?>' value='<?=$namasyarat?>'><?=$namasyarat?>
												<input type='hidden' name='id_persyaratan_detail-<?=$j?>' id='id_persyaratan_detail-<?=$j?>' value='<?=$result_syarat[$j]['id_persyaratan_detail']?>'>
												</td>
												
												<td class="clcenter">
												<div class='delete2' title='Delete Data' onClick='hapus_syarat(<?=$j?>,<?=$result_syarat[$j]['id_persyaratan_detail']?>)' id='ddsyarat<?=$j?>'></div>
												</td>
											</tr>
										<?php 
										$idsyarat .= $result_syarat[$j]['id_syarat']."~";
										}
									} ?>
								</tbody>
								</table>
							</div>
							<input type='hidden' name='idsdh_pilih' id='idsdh_pilih' value='<?=$idsyarat?>'>
						</dd>
					</dl>
					<dl>
						<dt>&nbsp;</dt>
						<dd class="dot2">&nbsp;</dd>
						<dd class="col-right">	
							<?php echo form_submit('save','Simpan');	?>			
							<script language="javascript" type="text/javascript">
								function kembalikelist(){location.href="<?php echo base_url(). index_page() ;?>syarat2/persyaratan_list/";} 
							</script>
							<input type="button" name="back" value="Kembali" onclick="kembalikelist()">	
						</dd>
					</dl>
				</fieldset>	
			</fieldset>	
			<div>	
				<div class="space-line"></div>
				<div class="blank"></div>
				<div class="spacer"></div> 
			</div>
		<?php echo form_close(); ?>
	</center>

