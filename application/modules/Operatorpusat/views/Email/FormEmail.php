<form action="<?php echo site_url('Operatorpusat/Kirim_Ulang_Email'); ?>" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
  <input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="col-md-12 ">
        <input class="form-control" value="<?php echo $id;?>" id="id" name="id" style="display: none;">
        <input class="form-control" value="<?php echo $data->email;?>" id="id" name="email" style="display: none;">
        <div class="page-title" align="center">
            <span class="caption font-blue-hoki bold" style="font-size: 15px;">Apakah akan mengirim Ulang Pendaftaran Akun Pemohon?</span>
        </div>
        <center>
            <span class="input-group-btn">
                <input id="xstileng" name="xstileng" type="submit" value="Ya"  class="btn blue btn-block">
            </span>	
        </center>
        <br>		
    </div>
</form>