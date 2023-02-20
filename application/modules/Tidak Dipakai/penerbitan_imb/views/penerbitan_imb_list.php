<script type="text/javascript">
function GetCetakIMB(id)
{
	//alert(id);
	var url = "<?php echo base_url() . index_page() ?>penerbitan_imb/cetak_form_imb/"+id;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}
function GetPdfLap(id,f){
	url = "<?php echo base_url() . index_page() ?>file/IMB/pengajuan_imb/"+id+"/"+"imb_n_lampiran"+"/"+f;
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
}
//PopUp Kementerian/Departemen
function popupWinKabkot() {
	var url = "<?php echo base_url() . index_page() ?>kecamatan/popup_kabkot_list/"; openCenteredWindow(url);
} 
function resetCari() {
	var url = "<?php echo base_url() . index_page() ?>penerbitan_imb/penerbitan_imb_list/";
	$('#loading').fadeIn();
	$.getJSON( baseHref + 'penerbitan_imb_slf/killSession/' ,
		function() {
			window.location.replace(url);
		}
	);
	$('#loading').fadeOut();
}
function DetailPenerbitan(id) {
	var url = "<?php echo base_url() . index_page() ?>penerbitan_imb/detail_penerbitan_detail/"+id; 		
	swin = window.open(url,'win','scrollbars,width=1000,minimizable=no,maximizable=no,height=1000,top=80,left=140,status=no,toolbar=no,menubar=yes,location=no');
	swin.focus();
	//swin.print();
}
</script>
<div id="top"></div>
	<center>
		<?php echo form_open_multipart('penerbitan_imb/penerbitan_imb_list',array('name'=>'frmList_pengkajian_list', 'id'=>'frmList_pengkajian_list')); ?>
			<div class="blank"></div>
			<div class="spacer"></div>
			<div id="top"></div>
			<?php
				if  ($this->session->flashdata('pesan'))
					echo "<script>javascript:show_pesan('".$this->session->flashdata('pesan')."');</script>";
				else if ($this->session->flashdata('errmsg') )
					echo "<script>javascript:show_err('".$this->session->flashdata('errmsg')."');</script>";
			?>
			<div id='confirm'>
			</div>

			<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all">
				<div class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
					<span><h2 style="color:white">&nbsp;&nbsp;Daftar Penerbitan dan Penyerahan IMB</h2></span>
				</div>
				<br>
				<fieldset class="panel-form">
					<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all">
						<fieldset class="panel-form">

						<div class="title2">
							<table border='0'>
								<tr>
									<td style="font-size:16px; border-bottom: 1px solid #5C6FCD; border-right: 1px solid #5C6FCD; ">Pencarian</td>
									<td style="border-bottom: 1px solid #000; border-left: 1px solid #000;"></td>
								</tr>
								<tr>
									<td style="font-size:16px; border-top: 1px solid #000; border-right: 1px solid #000; "></td>
									<td style="border-top: 1px solid #5C6FCD; border-left: 1px solid #5C6FCD;"></td>
								</tr>
							</table>
						</div>
							<?
							if (($this->qi_auth->get_id_rule() == '1') || ($this->qi_auth->get_id_rule() == '6')) {?>
							<dl>
								<dt>Kab/Kota</dt>
									<dd class="dot2">:</dd>
									<dd class="col-right">
									<input name="id_kabkot" value='<?php echo set_value('id_kabkot', (isset($id_kabkot) ? $id_kabkot : ''))?>' id="id_kabkot" type="hidden">
									<input size="30" name="nama_kabkota" class="input2" value='<?php echo set_value('nama_kabkota', (isset($nama_kabkota) ? $nama_kabkota : ''))?>' id="nama_kabkota" type="text" readonly=true>
									<input type='button' name='getKabkota' id='getKabkota' value='....' onClick='popupWinKabkot()' />
								</dd>
							</dl>
							<?}?>
							<dl>
								<dt>Nama Pemohon</dt>
								<dd class="dot2">:</dd>
								<dd class="col-right">
									<input type="text" size="50" name="nama_pemohon" class="input2" value="<?php echo set_value('nama_pemohon', (isset($nama_pemohon) ? $nama_pemohon : ''))?>" id="nama_pemohon">
								</dd>
							</dl>
							<dl>
								<dt>Pelayanan IMB</dt>
								<dd class="dot2">:</dd>
								<dd class="col-right">
								<?php $selected = '';
									$list_jenis_bg[''] = '--Pilih--';
									$list_jenis_bg['1'] =  'Mendirikan Bangunan Gedung Baru';
									$list_jenis_bg['2'] =  'Bangunan Gedung Existing Belum Ber-IMB';
									$list_jenis_bg['3'] =  'PPIMB Bangunan Gedung ';
									$list_jenis_bg['4'] =  'Bangunan Gedung Kolektif';
									$list_jenis_bg['5'] =  'Bangunan Gedung Prasarana';
									$list_jenis_bg['6'] =  'Bangunan Gedung IMB Bertahap';
									if (isset($id_jenis_bg) && $id_jenis_bg != '')
										$selected = $id_jenis_bg;
										$js = "id='id_jenis_bg'";
									echo form_dropdown('id_jenis_bg',$list_jenis_bg,$selected,$js);
								?>
								</dd>
							</dl>
							<dl>
								<dt>Kompleksitas Bangunan Gedung</dt>
								<dd class="dot2">:</dd>
								<dd class="col-right">
									<?php $selected = '';
										if (isset($klasifikasi_bg) && $klasifikasi_bg != '')
											$selected = $klasifikasi_bg;
										$js = "id='klasifikasi_bg' ";
										echo form_dropdown('klasifikasi_bg',$list1,$selected,$js);
									?>
								</dd>
							</dl>
							<dl>
								<dt>Pemanfaatan Bangunan Gedung</dt>
								<dd class="dot2">:</dd>
								<dd class="col-right">
								<?php $selected = '';
									$list_manfaat[''] = '--Pilih--';
									$list_manfaat['1'] =  'Untuk Kepentingan Umum';
									$list_manfaat['2'] =  'Bukan Untuk Kepentingan Umum';
									if (isset($id_pemanfaatan_bg) && $id_pemanfaatan_bg != '')
										$selected = $id_pemanfaatan_bg;
									$js = "id='id_pemanfaatan_bg' ";
									echo form_dropdown('id_pemanfaatan_bg',$list_manfaat,$selected,$js);
								?>
								</dd>
							</dl>
							<dl>
								<dt>Periode Permohonan</dt>
								<dd class="dot2">:</dd>
								<dd class="col-right">
									<?php
									if (isset($tgl_permohonan_awal) &&  $tgl_permohonan_awal != '0000-00-00')
									$tgl_permohonan_awal = $tgl_permohonan_awal;
									else
									$tgl_permohonan_awal = '';
									?>
									<input size="15" name="tgl_permohonan_awal" class="input2" value='<?=$tgl_permohonan_awal?>' id="tgl_permohonan_awal" type="text">
									<a href="javascript:NewCssCal('tgl_permohonan_awal','ddmmyyyy')"><img src="<?php echo base_url();?>assets/images/cal.gif" width="16" height="16" alt="Pick a date"></a>

									S/D
									<?php
										if (isset($tgl_permohonan_akhir) && $tgl_permohonan_akhir != '0000-00-00')
										$tgl_permohonan_akhir = $tgl_permohonan_akhir;
										else
										$tgl_permohonan_akhir = '';
									?>
										<input size="15" name="tgl_permohonan_akhir" class="input2" value='<?=$tgl_permohonan_akhir?>' id="tgl_permohonan_akhir" type="text">
										<a href="javascript:NewCssCal('tgl_permohonan_akhir','ddmmyyyy')"><img src="<?php echo base_url();?>assets/images/cal.gif" width="16" height="16" alt="Pick a date"></a>
								</dd>
							</dl>
							<dl>
								<dt>&nbsp;</dt>
								<dd class="dot2">&nbsp;</dd>
								<dd class="col-right">
									<?php echo form_submit('search','Cari');?>
									<input id="reset" type="button" onclick="resetCari()" value="Reset" name="reset">
								</dd>
							</dl>
						</fieldset>
					</fieldset>
				</fieldset>
				<div>
					<div class="space-line"></div>
					<div class="blank"></div>
					<div class="spacer"></div>
				</div>
				<fieldset class="panel-form">
					<fieldset class="fields">
						<!--<div class="print2" title="Cetak Daftar Pengkajian" onclick="cetak_daftar_penerbitan()"></div>-->
						<div class="field_paging">
							<div class="left2">Total Data : <?php echo $jum_data;?> records</div>
							<div class="pagination"><?php echo isset($paging) ? $paging : '';?></div>
						</div>
						<div id="viewlist">
							<table class="tbl" align="center" border="0" cellpadding="2" cellspacing="1">
								<tbody>
									<tr style="padding-left: 5px; padding-bottom:3px; color:#FFF; font-weight:bold">
										<th><center>No.</center></th>
										<th><center>Jenis Permohonan</center></th>
										<th><center>No.SK IMB</center></th>
										<th><center>Nama Pemilik</center></th>
										<th><center>No. Telepon/<br> No. Hp</center></th>
										<th><center>Kepemilikan BG</center></th>
										<th><center>Lokasi BG</center></th>
										<th><center>Fungsi BG</center></th>
										<!--<th><center>Input IMB</center></th>-->
										<th><center>File IMB</center></th>
										<th><center>Detail</center></th>
									</tr>
									<?php
									if($jum_data==0){?>
									<tr>
										<td class="clcenter" colspan="11">Data is Empty</td>
									</tr>
									<?}else{
										$no= 1 + $offset;
										$lam1 = "";
										for ($i=0;$i<count($results);$i++) {
											if ($i % 2 == 0 )
											  $clss = "event";
											 else
											  $clss = "event2";
										$color = "";
										if ($results[$i]['id_jenis_usaha'] == '1'){
												$bentuk_usaha =  "Perseorangan";
											}else if ($results[$i]['id_jenis_usaha'] == '2'){
												$bentuk_usaha =  "Badan Usaha";
											}else if ($results[$i]['id_jenis_usaha'] == '3'){
												$bentuk_usaha =  "Badan Hukum";
											}else{
												$bentuk_usaha = '';
											}
										$lam1= $results[$i]['dir_file_imb'];
										
										if($results[$i]['nama_perusahaan'] != ''){
												$nama = ucwords(strtoupper($results[$i]['nama_perusahaan']));
											}else{
												$nama = ucwords(strtolower($results[$i]['nama_pemohon']));
											}
									?>
									<tr class="<?=$clss?>" id="record" >
										<td class="clcenter" bgcolor="<?=$color?>"><?php echo $no?></td>
										<td><?php echo $results[$i]['nama_permohonan'];?></td>
										<td class="clleft" bgcolor="<?=$color?>"><?php echo $results[$i]['no_imb'];?></td>
										<td class="clleft" bgcolor="<?=$color?>"><?php echo $nama; ?></td>
										<td class="clleft">
										<?php
										$tee = '';
										$te = $results[$i]['no_tlp'];

										$tlp = explode('/',$te);
										if(count($tlp)>1){
										echo $tlp[0].'<br>'.$tlp[1];}else{
										echo $tlp[0];}
										?></td>
										<td><? echo $bentuk_usaha;?></td>
										<td class="clleft" bgcolor="<?=$color?>"><?php echo $results[$i]['alamat_bg'];?>, Kel. <?php echo $results[$i]['kelurahan'];?>, Kec. <?php echo $results[$i]['kecamatan'];?>, <?php echo $results[$i]['nama_kabkota'];?>, Prov. <?php echo $results[$i]['nama_provinsi'];?></td>
										<? if ($results[$i]['id_fungsi_bg'] == 3){?>
										<td class="clleft"><?php echo $results[$i]['fungsi_bg'];?>-<?echo $results[$i]['jns_bangunan']?> </td><?}else{?>
										<td class="clleft"><?php echo $results[$i]['fungsi_bg'];?></td>
										<?}?>
										<!--<td class="clcenter" bgcolor="<?=$color?>">
											<a href="<?php echo base_url() . index_page();?>penerbitan_imb/penerbitan_imb_form/<?php echo $results[$i]['id_permohonan']?>">
												<div class="setujui" title="Input Penerbitan imb slf" id='<?php echo $results[$i]['id_permohonan'] ?>'></div>
											</a>
										</td>-->
										<td>
											
										<?php
											if($lam1 != ''){
												?>
											 <img onClick="javascript:GetPdfLap('<?php echo $results[$i]['id_permohonan'] ?>','<?php echo $lam1 ?>')" class="print" title='File Pdf' class='link' >
											<?
										}else{?>
											<div class="print2" title="Cetak Form IMB" onclick="GetCetakIMB(<? echo $results[$i]['id_permohonan'] ?>)">
										<?}
										?>
										</td>
											<td class="clcenter"><div  class="search" title="Detail Info BG " onClick="DetailPenerbitan(<? echo $results[$i]['id_permohonan'] ?>)"></div>
										</td>
									</tr>
									<?php
										$no++;
										}
									}
									?>
								</tbody>
							</table>
						</div>
					</fieldset>
				</fieldset>
			</fieldset>
		<?php echo form_close(); ?>
	</center>
	<div><a href="#top" class="top" title="Back To Top" style="text-decoration:none">&nbsp;&nbsp;Back To Top</a></div>
