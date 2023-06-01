<form action="<?php echo site_url('slf/penilaian_teknis/'); ?>" class="form-horizontal" role="form" method="post" id="saveJink" name="saveJink" enctype="multipart/form-data">
				<input class="form-control" value="<?php echo $this->uri->segment(3);?>" id="toid" name="toid" style="display: none;">
				<input class="form-control" value="<?php echo $this->uri->segment(4);?>" id="toid2" name="toid2" style="display: none;">
				<table id="" class="table table-bordered table-striped table-hover">		
					<thead>
						<tr >
							<th >No.</th>
							<th >Nama Dokumen</th>
							<th width="7%">Berkas</th>
							<th width="18%">Hasil Pemeriksaan</th>
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
											if($key->id_syarat == $id_dokumen_permohonan)
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
						?>
						<tr class="<?=$clss?>" >
							<td align="center"><?php echo $no++;?></td>
							<td ><?php echo $key->nama_syarat;?></td>
							<td align="center">
							<? if($dir_file !='')
								{?>
									<center>	
										<a href="javascript:void(0);" onClick="javascript:GetPdfTeknisSLF('<?php echo $pengajuan_id;?>','<?php echo $key->id_syarat;?>','<?php echo $dir_file;?>')" >
											<?php echo 'Lihat' ?>
										</a>
									</center>
								<?}else
								{?>
									<center>
										<?php echo 'Kosong' ?>
									</center>
								<?}?>
							</td>
							<td>
								<?
									
									$radio1 = "";
									$radio2 = "";
									$kesesuaian = "";
									$dir_file_hasil_perbaikan = "";
									$id_penilaian = "";
									
									
									$id_persyaratan_detail = $key->id_persyaratan_detail;
									$query_pemeriksaan = $this->mslf->get_penilaian_teknis($id_persyaratan_detail,$this->uri->segment(3))->result_array();
									
									for($n=0;$n<count($query_pemeriksaan);$n++) {
										$kesesuaian = $query_pemeriksaan[$n]['kesesuaian'];
										$id_penilaian = $query_pemeriksaan[$n]['id_penilaian'];
									}
									
									$cek_kesesuaian ='';
									if($kesesuaian==1)
									{
										$cek_kesesuaian = $cek_kesesuaian+1;
										$radio1 = "checked";
									}else if($kesesuaian==2){
										$radio2 = "checked";
									}
								?>
								<input type="text" name="id_nilai_<?=$id_persyaratan_detail?>" id="id_nilai_<?=$id_persyaratan_detail?>" value="<?=$id_penilaian?>" style="display: none;">
								<div class="form-group">
								<input type="radio" class="icheck" name="kesesuaian_<?=$id_persyaratan_detail?>" value="1" id="kesesuaian" <?=$radio1?>> Sesuai
								<br>
								<input type="radio" class="icheck" name="kesesuaian_<?=$id_persyaratan_detail?>" value="2" id="kesesuaian" <?=$radio2?>> Tidak Sesuai
								</div>
							</td>
						</tr>
						<?php			
								}
							}
								
						?>
				</table>
	<input id="" name=""  type="submit" onClick="XJink()" value="Simpan" class="btn blue-hoki btn-block">
</form>	

<script type="text/javascript">
	function XJink(){
	$("#saveJink").validate({
	    // Specify the validation rules
	    rules: {
			//id_hasil_pemeriksaan_kesesuaian: "required",
	        kesesuaian_<?=$id_persyaratan_detail?>: "required",
			//catatan: "required",
	    },
	        highlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	    },
	        unhighlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	    },
	      errorClass: 'help-block',
	    
	    // Specify the validation error messages
	    messages: {
			kesesuaian_<?=$id_persyaratan_detail?>: "Tentukan Hasilnya",
	        //id_konfirmasi_verlap: "Tentukan Verifikasinya",
			//catatan: "Masukan Keterangan",
	    },
	    
	    submitHandler: function(form) {
	    	form.submit();
	    }
	});	
	}
</script>