<script type="text/javascript">

</script>	
	<center>
		<?php echo form_open_multipart('penerbitan_imb_slf/penerbitan_slf_form/'.$id_permohonan,array('name'=>'frmpenerbitan_slf', 'id'=>'frmpenerbitan_slf')); ?>
			<div class="blank"></div> 
            <div class="spacer"></div>
			<div id="top"></div>
			<div id="confirm" class="confirm" style="display: none;"></div>	
			<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all">
			<fieldset class="panel-form">
				<span><h3><font color="#5C6FCD">DATA POKOK</font></h3></span>
				
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
					<dt class="col-left" align="left"><b>Alamat Bangunan Gedung</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right6">
						<?=(isset($alamat_bg) ? $alamat_bg : '');?>
					</dd>
				</dl>
				<br>
				<br>
				<dl>
					<dt class="col-left" align="left"><b>Kabupaten / Kota</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right6">
						<?=(isset($nama_kabkota) ? $nama_kabkota : '');?>
					</dd>
				</dl>
				<br>
				<br>
				<dl>
					<dt class="col-left" align="left"><b>Provinsi</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right">
						<?=(isset($nama_provinsi) ? $nama_provinsi : '') ;?>
					</dd>
				</dl>
				<br>
				<br>
				<dl>
					<dt class="col-left" align="left"><b>Bentuk Usaha</b></dt>
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
				<dl>
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
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Luas Bangunan Gedung</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?=(isset($luas_bg)? $luas_bg : '') ;?>
					</dd>
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Luas Tanah</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?=(isset($luas_tanah)? $luas_tanah : '') ;?>
					</dd>
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Tinggi Bangunan/Lantai</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?=(isset($tinggi_bg)? $tinggi_bg : '...') ;?> m/<?=(isset($lantai_bg)? $lantai_bg : '...') ;?> lantai
					</dd>
				</dl>
				<dl>
					<dt class="col-left" align="left"><b>Atas nama/Pemilik Tanah</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?=(isset($atas_nama_dok)? $atas_nama_dok : '') ;?>
					</dd>
				</dl>
				<!--<dl>
					<dt class="col-left" align="left"><b>Nomor IMB</b></dt>
					<dd class="dot2"><b>:</b></dd>
					<dd class="col-right2">
						<?=(isset($nomor_imb)? $nomor_imb : '') ;?>
					</dd>
				</dl>-->
				
			</fieldset>
			</fieldset>
			<div class="blank"></div> 
			<div class="blank"></div> 
			<div class="blank"></div> 
			<div class="blank"></div> 
			<h3 class="title">Penerbitan IMB</h3>
			
			<?php 
				if (isset($err_msg) && $err_msg != '' ) { ?>
					<div class="errwarning"><?=$err_msg?></div>
			<?php } ?>
			<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all">
				<fieldset class="panel-form">
					<dl>
						<dt> Nomor IMB <span class="hightlight">*</span></dt>
						<dd class="dot2">:</dd>
						<dd class="col-right">	
							<input size="50" name="no_slf" class="input2" value='<?php echo set_value('no_slf', (isset($no_slf) ? $no_slf : ''))?>' id="no_slf" type="text" >
							<input size="50" name="id_penerbitan_slf" class="input2" value='<?php echo set_value('id_penerbitan_slf', (isset($id_penerbitan_slf) ? $id_penerbitan_slf : ''))?>' id="id_penerbitan_slf" type="hidden" >
						</dd>
					</dl>
					<dl>
						<dt>Tanggal IMB</dt>
						<dd class="dot2">:</dd>
						<dd class="col-left">
							<?php 	if (isset($tgl_slf_awal) && $tgl_slf_awal != '0000-00-00')
								$tgl_awal =  tgl_eng_to_ind($tgl_slf_awal);
							else
								$tgl_awal = '';
							?>	
							<input size="12" name="tgl_slf_awal" class="input2" value='<?=$tgl_awal?>' id="tgl_slf_awal" type="text" onblur="hitungUmur(this.value)" onKeyup="hitungUmur(this.value)">		
							<a href="javascript:NewCssCal('tgl_slf_awal','ddmmyyyy')"><img src="<?php echo base_url();?>assets/image/cal.gif" width="16" height="16" alt="Pick a date"></a>	
							S.d
							<?php 	if (isset($tgl_slf_akhir) && $tgl_slf_akhir != '0000-00-00')
								$tgl_akhir =  tgl_eng_to_ind($tgl_slf_akhir);
							else
								$tgl_akhir = '';
							?>
							<input size="12" name="tgl_slf_akhir" class="input2" value='<?=$tgl_akhir?>' id="tgl_slf_akhir" type="text" onblur="hitungUmur(this.value)" onKeyup="hitungUmur(this.value)">		
							<a href="javascript:NewCssCal('tgl_slf_akhir','ddmmyyyy')"><img src="<?php echo base_url();?>assets/image/cal.gif" width="16" height="16" alt="Pick a date">
							
						</dd>
					</dl>
					<dl>
						<dt>File Dokumen IMB</dt>
						<dd class="dot2">:</dd>
						<dd class="col-right">		
							<input size='35' readonly="true" name="dir_file_slf_edit" value='<?php echo set_value('dir_file_slf_edit', (isset($dir_file_slf_edit) ? $dir_file_slf_edit : ''))?>' id="dir_file_slf_edit">							
							<input type="file" name="dir_file_slf" id="dir_file_slf" value='<?php echo set_value('dir_file_slf', (isset($dir_file_slf) ? $dir_file_slf : ''))?>'/>
						</dd>
					</dl>
					
					
					
					<div class="blank"></div> 
					
					<div class="blank"></div> 
					
					
					
					
					<dl>
						<dt>&nbsp;</dt>
						<dd class="dot2">&nbsp;</dd>
						<dd class="col-right">	
							<?php echo form_submit('save','Simpan');	?>			
							
							<script language="javascript" type="text/javascript">
								function kembalikelist(){location.href="<?php echo base_url(). index_page() ;?>penerbitan_imb_slf/penerbitan_imb_slf_list/";} 
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

