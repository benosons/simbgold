<form action="<?php echo site_url('Dashboard/SimpanStatus'); ?>" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
    <div class="col-md-12 ">
        <input class="form-control" value="<?php echo $id;?>" id="id" name="id" style="display: none;">
        <input class="form-control" value="<?php echo $data->email;?>" id="id" name="email" style="display: none;">							
        <input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <div class="page-title" align="center">
            <span class="caption font-blue-hoki bold" style="font-size: 15px;">Apakah Dokumen dan Informasi yang disediakan sesuai?</span>
        </div>
        <center>
            <span class="input-group-btn">
                <input id="xstileng" name="xstileng" type="submit" value="Ya"  class="btn blue btn-block">
            </span>
            ||		
            <span class="input-group-btn">
                <div class="actions"><a href="<?php echo site_url('Dashboard/Tolak/' . $id); ?>" title="Dikembalikan Untuk Diperbaiki" data-toggle="modal" data-target="#Tolak" class="btn red">Dikembalikan</a>				
            </span>		
        </center>
        <br>		
    </div>
</form>
