<script type="text/javascript">
function GetCetakIMB(id)
{
	//alert(id);
	var url = "<?php echo base_url() . index_page() ?>penerbitan_imb/cetak_form_imb/"+id; 
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}

</script>	
	<center>
		<?php echo form_open_multipart('penerbitan_imb/penerbitan_imb_form/'.$id_permohonan,array('name'=>'frmpenerbitan_imb', 'id'=>'frmpenerbitan_imb')); ?>
			<div class="blank"></div> 
            <div class="spacer"></div>
			<div id="top"></div>
			<div id="confirm" class="confirm" style="display: none;"></div>	
			<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all">
			<fieldset class="panel-form">
				<span><h3><font color="#5C6FCD">DATA PENERBITAN IMB</font></h3></span>
				
				<dl>
					<dt class="col-left" align="left"><b>Nama Pemohon</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?=(isset($nama_pemohon) ? $nama_pemohon : '')?>
					</dd>
				</dl>
				<br>
				<br>
				<dl>
					<dt class="col-left" align="left"><b>Alamat Pemohon</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right6">
						<?=(isset($alamat_bg) ? $alamat_bg : '');?>, Kab./Kota.<?=(isset($nama_kabkota) ? $nama_kabkota : '');?>, <?=(isset($nama_provinsi) ? $nama_provinsi : '') ;?>
					</dd>
				</dl>
				
				<dl>
					<dt class="col-left" align="left"><b>Bentuk Kepemilikan Bangunan</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?php 	
						 if (isset($id_jenis_usaha) && $id_jenis_usaha == '1'){
							$bentuk_usaha =  "Perseorangan";
						 }else if (isset($id_jenis_usaha) && $id_jenis_usaha == '2'){
							$bentuk_usaha =  "Badan Usaha";
						 }else if (isset($id_jenis_usaha) && $id_jenis_usaha == '3'){
							$bentuk_usaha =  "Badan Hukum";
						 }else{
							$bentuk_usaha = '';
						 }
						?>
						<?=(isset($bentuk_usaha)? $bentuk_usaha : '') ;?>
					</dd>
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Fungsi Bangunan Gedung</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?=(isset($fungsi_bg)? $fungsi_bg : '') ;?>
					</dd>
				</dl>
				<!--<dl>
					<dt class="col-left" align="left"><b>Jenis Bangunan Gedung</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
					<?=(isset($klasifikasi_bg)? $klasifikasi_bg : '') ;?>	
					</dd>
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Nama Bangunan Gedung</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?=(isset($nama_bg)? $nama_bg : '') ;?>
					</dd>
				</dl>-->
				<dl>
					<dt class="col-left" align="left"><b>Luas Bangunan Gedung</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?=(isset($luas_bg)? $luas_bg : '') ;?> m<sup>2</sup>
					</dd>
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Luas Tanah</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?=(isset($luas_tanah)? $luas_tanah : '') ;?> m<sup>2</sup>
					</dd>
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Tinggi Bangunan/Lantai</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?=(isset($tinggi_bg)? $tinggi_bg : '...') ;?> m/<?=(isset($lantai_bg)? $lantai_bg : '...') ;?> lantai
					</dd>
				</dl>
				<!--<dl>
					<dt class="col-left" align="left"><b>Atas nama/Pemilik Tanah</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?=(isset($luas_tanah)? $luas_tanah : '') ;?>
					</dd>
				</dl>-->
				<dl>
					<dt class="col-left" align="left"><b>Harga Satuan/HS<sub>bg</sub> (Rp.)</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
					<?=number_format((isset($harga_satuan)? $harga_satuan : '')) ;?>
					</dd>
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Retribusi IMB (Rp.)</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
					<?
						$convert_retribusi = number_format($retribusi_manual);
					?>
					<?=(isset($convert_retribusi)? $convert_retribusi : 'DATA TIDAK LENGKAP MOHON CEK FORM PENETAPAN RETRIBUSI') ;?>
					</dd>
				</dl>
				
			</fieldset>
			</fieldset>
			<div class="blank"></div> 
			<div class="blank"></div> 
			<div class="blank"></div> 
			<div class="blank"></div> 
			<h3 class="title">Penerbitan dan Penyerahan IMB</h3>
			
			<?php 
				if (isset($err_msg) && $err_msg != '' ) { ?>
					<div class="errwarning"><?=$err_msg?></div>
			<?php } ?>
			<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all">
				<fieldset class="panel-form">
				
					<script language="javascript" type="text/javascript">
					function GetCetakIMB(id)
						{
					//alert(id);
							var url = "<?php echo base_url() . index_page() ?>penerbitan_imb/cetak_form_imb/"+id; 
							swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
							swin.focus();
						}
					</script>
					
					<dl>
						<dt> Nomor IMB <span class="hightlight">*</span></dt>
						<dd class="dot2">:</dd>
						<dd class="col-right">	
							<input size="50" name="no_imb" class="input2" value='<?php echo set_value('no_imb', (isset($no_imb) ? $no_imb : ''))?>' id="no_imb" type="text" >
							<input size="50" name="id_penerbitan_imb" class="input2" value='<?php echo set_value('id_penerbitan_imb', (isset($id_penerbitan_imb) ? $id_penerbitan_imb : ''))?>' id="id_penerbitan_imb" type="hidden" >
						</dd>
					</dl>
					<dl>
						<dt>Tanggal IMB</dt>
						<dd class="dot2">:</dd>
						<dd class="col-left">			
							<?php 	if (isset($tanggal_imb) && $tanggal_imb != '0000-00-00')
								$tgl_awal =  tgl_eng_to_ind($tanggal_imb);
							else
								$tgl_awal = '';
							?>	
							<input size="12" name="tanggal_imb" class="input2" value='<?=$tgl_awal?>' id="tanggal_imb" type="text" onblur="hitungUmur(this.value)" onKeyup="hitungUmur(this.value)">		
							<a href="javascript:NewCssCal('tanggal_imb','ddmmyyyy')"><img src="<?php echo base_url();?>assets/image/cal.gif" width="16" height="16" alt="Pick a date"></a>	
						</dd>
					</dl>
					<!--<dl>
						<dt>Tanggal Berlaku IMB</dt>
						<dd class="dot2">:</dd>
						<dd class="col-left">			
							<?php 	if (isset($tgl_berlaku) && $tgl_berlaku != '0000-00-00')
								$tgl_awal =  tgl_eng_to_ind($tgl_berlaku);
							else
								$tgl_awal = '';
							?>	
							<input size="12" name="tgl_berlaku" class="input2" value='<?=$tgl_awal?>' id="tgl_berlaku" type="text" onblur="hitungUmur(this.value)" onKeyup="hitungUmur(this.value)">		
							<a href="javascript:NewCssCal('tgl_berlaku','ddmmyyyy')"><img src="<?php echo base_url();?>assets/image/cal.gif" width="16" height="16" alt="Pick a date"></a>	
						</dd>
					</dl>-->
					<!--<dl>
						<dt> Nama Pejabat</dt>
						<dd class="dot2">:</dd>
						<dd class="col-right">	
							<input size="50" name="nama_ttd" class="input2" value='<?php echo set_value('nama_ttd', (isset($nama_ttd) ? $nama_ttd : ''))?>' id="nama_ttd" type="text" >
						</dd>
					</dl>
					<dl>
						<dt> NIP Pejabat</dt>
						<dd class="dot2">:</dd>
						<dd class="col-right">	
							<input size="50" name="nip_ttd" class="input2" value='<?php echo set_value('nip_ttd', (isset($nip_ttd) ? $nip_ttd : ''))?>' id="nip_ttd" type="text" >
						</dd>
					</dl>
					<dl>
						<dt> Jabatan</dt>
						<dd class="dot2">:</dd>
						<dd class="col-right">	
							<input size="50" name="jabatan_ttd" class="input2" value='<?php echo set_value('jabatan_ttd', (isset($jabatan_ttd) ? $jabatan_ttd : ''))?>' id="jabatan_ttd" type="text" >
						</dd>
					</dl>-->
					<dl>
						<dt>File Dokumen IMB dan Lampiran</dt>
						<dd class="dot2">:</dd>
						<dd class="col-right">
							<script language="javascript" type="text/javascript">
								function cek(){
									$('#dir_file').val(d_file.value);
								} 
								function edit_delete(id){
									if (confirm('Apakah kamu yakin akan menghapus file ini ?')) {
										$.ajax({
										url         : '<?php echo base_url() . index_page() ?>penerbitan_imb_slf/delete_file_imb/'+ id,
										dataType    : 'json',
										success     : function (data){
														if (data.status == "success"){
														alert("File Berhasil Di Delete");
														document.getElementById("myImage").style.display = "none";
														document.getElementById('d_file').style.display="block";
														}
														else
														{
														alert(data.msg);
														}
													}
										});
									}
									
								}						
							</script>
							<? if (isset($dir_file_edit) == '' or $dir_file_edit == null){ ?>
							<input size='35' readonly="true" name="dir_file" id="dir_file" value='<?php echo set_value('dir_file', (isset($dir_file) ? $dir_file : ''))?>' onchange='cek()'>
							<input  type="hidden" name="dir_file_edit" value='<?php echo set_value('dir_file_edit', (isset($dir_file_edit) ? $dir_file_edit : ''))?>' id="dir_file_edit">
							
							<input type="file" name="d_file" id="d_file" onchange='cek()'>
							<? }else {?>
							<input type="hidden" name="dir_file" id="dir_file" value='<?php echo set_value('dir_file', (isset($dir_file) ? $dir_file : ''))?>' onchange='cek()'>
							<input size='35' readonly="true" name="dir_file_edit" value='<?php echo set_value('dir_file_edit', (isset($dir_file_edit) ? $dir_file_edit : ''))?>' id="dir_file_edit">
							<input type="file" name="d_file" id="d_file"  style='display: none;' onchange='cek()'>
							<img id="myImage" src="<?=base_url()?>assets/images/del.gif" title="Hapus/Ubah File" onclick=" $('#dir_file').val(''); $('#dir_file_edit').val(''); edit_delete(<?php echo $id_penerbitan_imb;?>);"class="link" style="cursor:pointer">
							
							<? } ?>
						</dd>
					</dl>
					
					<div class="blank"></div> 
					
					<div class="blank"></div> 
					
					
					
					
					<dl>
						<dt>&nbsp;</dt>
						<dd class="dot2">&nbsp;</dd>
						<dd class="col-right">	
							<?php echo form_submit('save','Simpan');	?>
							<!--<script language="javascript" type="text/javascript">
								function kirim_email_imb(){location.href="<?php echo base_url(). index_page() ;?>penerbitan_imb/kirim_email_imb/<?=$id_permohonan?>";} 
								
							</script>
							<? if (isset($dir_file_edit) != '' or $dir_file_edit != null){ ?>
							<input type="button" name="back" value="Kirim/Kirim Ulang Email" onclick="kirim_email_imb()">	
							<? } ?>-->
							<!--<input type="submit" value="Simpan" onClick='GetCetakIMB(<?php echo $id_permohonan;?>)'>-->
							<script language="javascript" type="text/javascript">
								function kembalikelist(){location.href="<?php echo base_url(). index_page() ;?>penerbitan_imb/penerbitan_imb_list/";} 
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

