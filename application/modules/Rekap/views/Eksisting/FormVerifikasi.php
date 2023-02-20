<form action="<?php echo site_url('Rekap/SimpanStatus'); ?>" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
    <div class="col-md-12 ">
        <input class="form-control" value="<?php echo $id;?>" id="id" name="id" style="display: none;">							
        <div class="page-title" align="center">
            <span class="caption font-blue-hoki bold" style="font-size: 15px;">Akun Dinas Sudah Diberikan Kepada?</span>
        </div>
        <div class="row static-info">
			<div class="col-md-3 name">Dinas Teknis</div>
			<div class="col-md-3 value">
                <?php if ($data->status_teknis == '1'){
                    $checked = "checked";
                } else {
                    $checked = "";
                } ?>
                <input type="checkbox" class="form-control md-check" name="status_teknis" value="1" id="<?=$data->status_teknis?>" <?=$checked?> >
            </div>
		</div>
        <div class="row static-info">
			<div class="col-md-3 name">Dinas Perizinan</div>
			<div class="col-md-3 value">
                <?php if ($data->status_perizinan == '1'){
                    $checked = "checked";
                } else {
                    $checked = "";
                } ?>
                <input type="checkbox" class="form-control md-check" name="status_perizinan" value="1" id="<?=$data->status_perizinan?>" <?=$checked?> >
            </div>
		</div>
        <br>		
    </div>
    <div class="form-actions">
		<center>
			<button type="submit" class="btn green">Simpan</button>
            <button type="button" data-dismiss="modal" class="btn blue" onClick="ResRes2()"><i class="fa fa-sign-out"></i> Tutup</button>
		</center>
	</div>
</form>