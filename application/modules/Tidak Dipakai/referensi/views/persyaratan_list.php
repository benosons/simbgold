<script>
/*$(function() {
	$('#frmListSyarat').submit(function(e) {
		e.preventDefault();
		$.ajaxFileUpload({
			url            :'<?php echo site_url()?>/syarat2/persyaratan_list',
			secureuri      :false,
			fileElementId  :'dir_file',
			dataType       :'json',
			data           :{ 
								'list_jenis_bg' : $('#list_jenis_bg').val(),
								'list_jenis_urusan' : $('#list_jenis_urusan').val(),
							},
			success 	   : showResponse1
			});
		return false;
	});
	id_jenis_bg= "<?=(isset($id_jenis_bg) ? $id_jenis_bg : '')?>";
});

	function getSubBid(id_jenis_bg){
	//alert (id_jenis_bg);
	$('body').css('cursor', 'wait');
	var hasil = '';  
	$('#list_jenis_urusan').empty(); 
	if (id_jenis_bg != '') {
		$.getJSON("<?php echo base_url() . index_page();?>syarat2/get_pelayanan/"+id_jenis_bg,
		function(data){
			hasil += "<option value=''>--Pilih--</option>";
			for (var i = 0; i < data.length; i++) {
				tmpId = data[i]['id_jenis_bg'];
				if (id_jenis_bg == tmpId)
					pilih =  "SELECTED";
				else
					pilih = "";
				hasil += "<option value="+data[i]['id_jenis_bg']+" " + pilih + ">"+data[i]['nama_permohonan']+"</option>";
			} 
			$('#list_jenis_urusan').append(hasil);
		}
		);
	}else {
		hasil += "<option value=''>- Pilih Dulu -</option>";
		$('#list_jenis_urusan').append(hasil);
	}	
	$('body').css('cursor', 'default');		
}*/
</script>

<center>
		<?php echo form_open('syarat2/persyaratan_list',array('name'=>'frmListSyarat', 'id'=>'frmListSyarat')); ?>
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
					<span><h2 style="color:white">&nbsp;&nbsp;Daftar Persyaratan Permohonan IMB</h2></span>
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
							<dl>
								<dt>Pelayanan</dt>
								<dd class="dot2">:</dd>
								<dd class="col-right">			
									<?php $selected = '';
										$list_jenis_bg[''] = '--Pilih--';
										$list_jenis_bg['1'] =  'Bangunan Gedung Baru';
										$list_jenis_bg['2'] =  'Bangunan Gedung Existing';
										$list_jenis_bg['3'] =  'Bangunan Gedung Perubahan';
										$list_jenis_bg['4'] =  'Bangunan Gedung Kolektif';
										$list_jenis_bg['5'] =  'Bangunan Gedung Prasarana';
										$list_jenis_bg['6'] =  'Bangunan Gedung IMB Bertahap';
										if (isset($id_jenis_bg) && $id_jenis_bg != '')
											$selected = $id_jenis_bg;
											
										$js = "id='id_jenis_bg' ";
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
								<dt>Jenis Permohonan</dt>
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
								<dt>&nbsp;</dt>
								<dd class="dot2">&nbsp;</dd>
								<dd class="col-right">	
									<?php echo form_submit('search','Cari');	?>			
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
						<a href="<?php echo base_url().index_page() ?>syarat2/persyaratan_form"><div class="add" title="Tambah data Tahapan"></div></a> 
						
						<div class="field_paging">
							<!--<div class="left2">Total Data : <?php echo $jum_data;?> records</div>-->
							<div class="pagination"><?php echo isset($paging) ? $paging : '';?></div>
						</div>
						
						<div id="viewlist">
							<table class="tbl" align="center" border="0" cellpadding="2" cellspacing="1">			
								<tbody>
									<tr style="padding-left: 5px; padding-bottom:3px; color:#FFF; font-weight:bold">
										<th><center>No.</center></th>
										<th><center>Objek Permohonan IMB</center></th>
										<th><center>Persyaratan</center></th>
										<th><center>Sub Persyaratan</center></th>
										<th><center>Syarat - Syarat</center></th>
										<th><center>Hapus</center></th>
										<th><center>Edit</center></th>
									</tr>
									<?php
									if($jum_data==0){?>
									<tr>
										<td class="clcenter" colspan="5">Data is Empty</td>
									</tr>
									<?}else{
										$i= 1;
										$loksblm = '';
										$klasifikasisblm = '';
										$jns_syarat_sblm = '';
										$detail_jns_syarat_sblm = '';
										$detail_syarat_sblm = '';
										$id_jenis_permohonan_sblm = '';
										foreach ($result as $row) {
											if ($i % 2== 0 )
											  $clss = "event";
											 else
											  $clss = "event2";
											  
											$lokskrng = $row->nama_permohonan; 
											$id_jenis_permohonan = $row->id_jenis_permohonan;
									?>		  
									<tr class="<?=$clss?>" id="record">
										<td class="clcenter"><?php echo $i?></td>
										<td class="clleft"><b>
											<?php 
												if($lokskrng != $loksblm)
													echo $row->nama_permohonan; 
												else
													echo '';
											?>
										</b></td>
										
										<td class="clcenter">
										<?
											$detail = $row->id_jenis_persyaratan;
											
											if($detail != $jns_syarat_sblm || $id_jenis_permohonan != $id_jenis_permohonan_sblm){
												if ($detail == '1'){
													echo "Persyaratan Administratif";
												}else if ($detail=='2'){
													echo "Persyaratan Teknis";
												}
											}else{
												echo '';
											}
										?>
										</td>
										<td class="clleft">
										<?
											$detail_jenis_persyaratan = $row->id_detail_jenis_persyaratan;
											if($detail_jenis_persyaratan != $detail_jns_syarat_sblm || $id_jenis_permohonan != $id_jenis_permohonan_sblm){
												if ($detail_jenis_persyaratan == '1'){
													echo "Rencana Arsitektur";
												}else if ($detail_jenis_persyaratan=='2'){
													echo "Rencana Struktur";
												}else if ($detail_jenis_persyaratan=='3'){
													echo "Rencana Utilitas";
												}else if ($detail_jenis_persyaratan=='4'){
													echo "Perizinan dan/ atau Rekomendasi lainnya";
												}else if ($detail_jenis_persyaratan=='5'){
													echo "Adm";
												}
											}else{
												echo '';
											}
										?>
										</td>	
										<td class="clleft"><?php echo $row->nama_syarat; ?></td>
										<?
											$id_jenis_permohonan = $row->id_jenis_permohonan;
											if($id_jenis_permohonan != $id_jenis_permohonan_sblm || $detail_jenis_persyaratan != $detail_jns_syarat_sblm){
										?>											
										<td class="clcenter">
											<a href="<?php echo base_url() . index_page();?>syarat2/syarat_delete/<?php echo $row->id_persyaratan?>" onClick="return confirm('Anda Yakin Akan Menghapus Data Ini ?')">
											<div class="delete2" title="Delete Data"  id='<?php echo $row->id_persyaratan?>'></div>
											</a><?php //} else { ?><!--div class="disable_" title="Data Can't Be Deleted" ></div--><?php //'';}?>
										</td>
										<td class="clcenter">
											<a href="<?php echo base_url() . index_page();?>syarat2/persyaratan_form/<?php echo $row->id_persyaratan?>">
											<div class="edit" title="Edit Data" id='<?php echo $row->id_persyaratan ?>'></div>
											</a>
										</td>
										<?	
											}else{
										?>
										<td class="clcenter"></td>
										<td class="clcenter"></td>
										<?
											}
										?>
										
										
									</tr>
									<?php $i++;
											$loksblm = $lokskrng;
											$id_jenis_permohonan_sblm = $id_jenis_permohonan;
											//$klasifikasisblm = $klasifikasi_bg;
											$jns_syarat_sblm = $detail;
											$detail_jns_syarat_sblm = $detail_jenis_persyaratan;
											//$detail_syarat_sblm = $jenis;
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