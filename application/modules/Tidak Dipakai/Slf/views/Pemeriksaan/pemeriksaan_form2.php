<script type="text/javascript">
function dokumen_teknis() {
	$('div#loading').fadeIn();
	$('#doktek').addClass('selected');
	$('#psu').removeClass('selected').addClass('');;
	$('#vl').removeClass('selected').addClass('');
	$('#pbe').removeClass('selected').addClass('');
	$('#psah').removeClass('selected').addClass('');
	$('#vpt').removeClass('selected').addClass('');
	$.ajax({
			url: baseHref + 'pemeriksaan_slf/get_data_persyaratan/<?=$this->uri->segment(3)?>',
			type: 'POST',
			success: function( response ) {
				$('div#detail_personal').html('');
				$('div#detail_personal').html(response);
			}
		});
	//return false;
	$('div#loading').fadeOut();
}

function pemeriksaan_kesesuaian() {
	$('div#loading').fadeIn();
	$('#psu').addClass('selected');
	$('#doktek').removeClass('selected').addClass('');
	$('#vl').removeClass('selected').addClass('');
	$('#pbe').removeClass('selected').addClass('');
	$('#psah').removeClass('selected').addClass('');
	$('#vpt').removeClass('selected').addClass('');
	$.ajax({
			url: baseHref + 'pemeriksaan_slf/get_data_kesesuaian/<?=$this->uri->segment(3)?>',
			type: 'POST',
			success: function( response ) {
				$('div#detail_personal').html('');
				$('div#detail_personal').html(response);
			}
		});
	//return false;
	$('div#loading').fadeOut();
}

function GetPdfTeknis(id,id_bg,f){
	//alert (id);
	url = "<?php echo base_url() . index_page() ?>file/SLF/"+id+"/"+"persyaratan/Teknis"+"/"+f;
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
<center>
	<fieldset class="panel-form" style="display:block">
		<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all">
			<fieldset class="panel-form">
				<input onClick="window.location.href = '<?php echo base_url();?>pemeriksaan_slf/pemeriksaan_teknis_list';return false;" type="button"  class="button button3" value="Kembali" style="float: right;"> 
				<span><h3><font color="#5C6FCD">Informasi Permohonan</font></h3></span>
				<dl>
					<dt class="col-left" align="left"><b>Nomor Registrasi SLF</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?echo (isset($DataSummary['no_registrasi']) ? $DataSummary['no_registrasi'] : '[ BELUM MEMILIKI NO REGISTRASI ]') ?>	
					</dd>
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Nama Permohonan</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?echo (isset($DataSummary['nama_permohonan']) ? $DataSummary['nama_permohonan'] : '[ BELUM INPUT DATA ]') ?>	
					</dd>
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Nama Pemilik</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?echo (isset($DataSummary['nama_pemilik']) ? $DataSummary['nama_pemilik'] : '[ BELUM INPUT DATA ]') ?>	
					</dd>
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Lokasi BG</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?echo (isset($DataSummary['alamat_bg']) ? $DataSummary['alamat_bg'] : '[ BELUM INPUT DATA ]') ?>	
					</dd>
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Fungsi Bangunan Gedung</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
					<?
						if($DataSummary['jenis_bg'] = '1'){
							$jns_bangunan =  "Hunian";
						}else if($DataSummary['jenis_bg'] = '2'){
							$jns_bangunan =  "Keagamaan";
						}else if($DataSummary['jenis_bg'] = '3'){
							$jns_bangunan =  "Usaha";
						}else if($DataSummary['jenis_bg'] = '4'){
							$jns_bangunan =  "Sosial Budaya";
						}else if($DataSummary['jenis_bg'] = '5'){
							$jns_bangunan =  "Campuran";
						}
					?>
						<?echo (isset($jns_bangunan) ? $jns_bangunan : '[ BELUM INPUT DATA ]') ?>	
					</dd>
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Tinggi Bangunan Gedung/ Jumlah Lantai</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?echo (isset($DataSummary['tinggi_bg']) ? $DataSummary['tinggi_bg'] : '[ BELUM INPUT DATA ]') ?> m
					</dd>
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Luas Bangunan Gedung</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?echo (isset($DataSummary['luas_bg']) ? $DataSummary['luas_bg'] : '[ BELUM INPUT DATA ]') ?> m<sup>2</sup>
					</dd>
				</dl>
				
			</fieldset>
		</fieldset>
	</fieldset>
	
	<ul id="tabdp3" class="tabs-panel" style="margin-top:1em;" >
		<li class="selected" id="doktek"><a href="javascript:void(0);" rel="tcontent1" onclick="dokumen_teknis();" title="Dokumen Teknis"><span>Dokumen Teknis</span></a></li>
		<li class="selected" id="psu"><a href="javascript:void(0);" rel="tcontent1" onclick="pemeriksaan_kesesuaian();" title="Pemeriksaan Kesesuaian"><span>Pemeriksaan Kesesuaian</span></a></li>
		<!--<?	
			if($id_hasil_pemeriksaan_kesesuaian == 1){
		?>
		<li class="" id="pbe"><a href="javascript:void(0);" rel="tcontent3" onclick="persetujuan_kebenaran();" title="Persetujuan Kebenaran"><span>Persetujuan Kebenaran</span></a></li>
		<?
			}
		?>-->
	</ul>
	
	<fieldset class="panel-form">	
		<div id="detail_personal">
			<?php 
				include "data_teknis_form.php"; 
			?>
		</div>
	</fieldset>	
		
	<div>	
		<div class="space-line"></div>
		<div class="blank"></div>
		<div class="spacer"></div> 
	</div>	
</center>
