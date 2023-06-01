<div class="portlet light">
<div class="portlet-body">
	<div class="tab-content">
		<p>
			Diharapkan mengunggah foto yang mencerminkan diri Anda, Dilarang mengunggah foto yang berbau SARA, PRONOGRAFI dan NEGATIF.
		</p>
		<form action="<?php echo site_url('referensi/saveDataFotoPersonil'); ?>" class="form-horizontal" role="form" method="post" id="from_data_foto_personil" enctype="multipart/form-data">
			<div class="form-group">
				<input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($profile_user->id) ? $profile_user->id : ''))?>" name="id" placeholder="id" autocomplete="off">
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
						<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
					<div>
						<span class="btn default btn-file">
							<span class="fileinput-new">Select image </span>
							<span class="fileinput-exists">Change </span>
							<input type="file" name="foto_upload" id="foto_upload">
						</span>
						<a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput">Remove </a>
					</div>
				</div>
			</div>
			<div class="margin-top-10">
				<button type="submit" class="btn green">Simpan</button>
			</div>
		</form>
	</div>
</div>
</div>