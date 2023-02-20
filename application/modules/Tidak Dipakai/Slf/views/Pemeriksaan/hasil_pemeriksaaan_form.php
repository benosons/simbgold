<script type="text/javascript">
$( function() {
	$.initWindowMsg();
	var options = {
        beforeSubmit : function () { $('div#loading').fadeIn(); }, 
		success:       showResponse,
		cache:false,
		dataType: 'json'
	};
	$('#frmHasilPemeriksaan').ajaxForm(options);
});

function showResponse(responseText)  {
	if (responseText['valid'] == 'true') {
			$.ajax({
			url: baseHref + 'pemeriksaan_slf/get_data_kesesuaian/<?=$pengajuan_id?>',
			type: 'GET',
			dataType: 'html',
			cache:false,
			success: function( response ) {
				$('div#kesesuaian').html('');
				$('div#kesesuaian').html(response);
			}
		});
	}
	else {
		show_err(responseText['err_msg']); 
	}
	$('div#loading').fadeOut();

}

function GetPdfSLFKesesuaian(id,f){
	//alert (id);
	url = "<?php echo base_url() . index_page() ?>file/SLF/"+id+"/"+"pemeriksaan"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}





</script>
<style>
.button {
    background-color: #010789; /* Green */
    border: none;
    color: white;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
}

.button1 {border-radius: 2px;}
.button2 {border-radius: 4px;}
.button3 {border-radius: 8px;}
.button4 {border-radius: 12px;}
.button5 {border-radius: 50%;}
</style>
<div id="kesesuaian">
<center>
	<?php echo form_open_multipart('pemeriksaan_slf/submit_pemeriksaan/',array('name'=>'frmHasilPemeriksaan', 'id'=>'frmHasilPemeriksaan')); ?>
	<fieldset class="panel-form">
		<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all">
			<fieldset class="panel-form">
				
				<span><h3><font color="#5C6FCD">Hasil Pemeriksaan Kesesuaian</font></h3></span>
				<? $id = (isset($id) ? $id : '');?>
				<input size="50" name="pengajuan_id" class="input2" value='<?php echo set_value('pengajuan_id', (isset($pengajuan_id) ? $pengajuan_id : ''))?>' id="pengajuan_id" type="hidden" >
				<input size="50" name="id_nama_permohonan" class="input2" value='<?php echo set_value('id_nama_permohonan', (isset($id_nama_permohonan) ? $id_nama_permohonan : ''))?>' id="id_nama_permohonan" type="hidden" >
				<input size="50" name="id" class="input2" value='<?php echo set_value('id', (isset($id) ? $id : ''))?>' id="id" type="hidden">
				<dl>
					<dt>Kesimpulan Hasil Pemeriksaan Kesesuaian</dt>
					<dd class="dot2">:</dd>
					<dd class="col-right">
						<?php 	
							if (isset($id_hasil_pemeriksaan_kesesuaian)!=''){
							$id_hasil_pemeriksaan_kesesuaian = $id_hasil_pemeriksaan_kesesuaian;}else{
							$id_hasil_pemeriksaan_kesesuaian = isset($id_hasil_pemeriksaan_kesesuaian);}
						?>	
						<input type="radio" name="id_hasil_pemeriksaan_kesesuaian" value="1" id="id_hasil_pemeriksaan_kesesuaian1" <?php if ($id_hasil_pemeriksaan_kesesuaian=='1'){echo 'checked';}?>> Ya
						<input type="radio" name="id_hasil_pemeriksaan_kesesuaian" value="2" id="id_hasil_pemeriksaan_kesesuaian2" <?php if ($id_hasil_pemeriksaan_kesesuaian=='2'){echo 'checked';}?>> Tidak
					</dd>
				</dl>
				<dl>
					<dt>Apakah akan dilakukan verifikasi Lapangan</dt>
					<dd class="dot2">:</dd>
					<dd class="col-right">
						<?php 	
							if (isset($id_konfirmasi_verlap)!=''){
							$id_konfirmasi_verlap = $id_konfirmasi_verlap;}else{
							$id_konfirmasi_verlap = isset($id_konfirmasi_verlap);}
						?>	
						<input type="radio" name="id_konfirmasi_verlap" value="1" id="id_konfirmasi_verlap1" <?php if ($id_konfirmasi_verlap=='1'){echo 'checked';}?>> Ya
						<input type="radio" name="id_konfirmasi_verlap" value="2" id="id_konfirmasi_verlap2" <?php if ($id_konfirmasi_verlap=='2'){echo 'checked';}?>> Tidak
					</dd>
				</dl>
				
				<!--<dl>
					<dt>Batas Waktu Melakukan Verifikasi Lapangan</dt>
					<dd class="dot2">:</dd>
					
				</dl>-->
				
				
				<div class="blank"></div>
				<div class="blank"></div>
				<dl>
					<dt>&nbsp;</dt>
					<dd class="dot2">&nbsp;</dd>
					<dd class="col-right">
						<?php echo form_submit('save','Simpan');?>
					</dd>
				</dl>
			
			</fieldset>	
		</fieldset>	
	</fieldset>	
	
	
		
	<?php echo form_close(); ?>
		
	<div>	
		<div class="space-line"></div>
		<div class="blank"></div>
		<div class="spacer"></div> 
	</div>	
</center>
</div>