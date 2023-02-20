
			
			
			<form action="<?php echo site_url('Pupr/saveDataGambar'); ?>" class="form-horizontal" role="form" method="post" id="from_data_foto_personil" enctype="multipart/form-data">
			<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">		
				
			<center><div class="form-group">
					
						<blockquote class="note note-warning note-bordered" >
							<p>
								Diharapkan mengunggah foto yang mencerminkan diri Anda, Dilarang mengunggah foto yang berbau SARA, PRONOGRAFI dan NEGATIF.
							</p>
						</blockquote>
						<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($DataPersonil->id_personal) ? $DataPersonil->id_personal : '')) ?>" name="id" placeholder="id" autocomplete="off">
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-new thumbnail">

								<?php
								if (isset($DataPersonil->foto) != '') {
									$foto = base_url() . 'file/personil/' . $DataPersonil->id_personal . '/foto/' . $DataPersonil->foto;
								} else {
									$foto = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
								}
								?>
								<a href="<?= $foto; ?>" target="_blank"><img src="<?= $foto; ?>" alt="" style="width: 200px;" /></a>

							</div>
							<div class="fileinput-preview fileinput-exists thumbnail" style="width: 210px;"></div>
							<div>
								<span class="btn default btn-file" style="width: 210px;">
									<span class="fileinput-new">Unggah Foto</span>
									<span class="fileinput-exists">Ubah Foto</span>
									<input type="file" name="foto_upload" id="foto_upload">
								</span>
								<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Batal</a>
							</div>
						</div>
						<div class="margin-top-10">
							<button type="submit" class="btn green" style="width: 210px;">Simpan</button>
						</div>
					
				</div></center>


			</form>
		