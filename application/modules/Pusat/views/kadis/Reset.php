<form action="<?php echo site_url('Pusat/SimpanPass'); ?>" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
    <input type="text" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">					
    <div class="col-md-12 ">
        <input class="form-control" value="<?php echo $id;?>" id="id" name="id" style="display: none;">						
        <div class="page-title" align="center">
            <span class="caption font-blue-hoki bold" style="font-size: 15px;">Apakah Password Kepala Dinas di Reset?</span>
        </div>
        <center>
            <span class="input-group-btn">
                <input id="xstileng" name="xstileng" type="submit" value="Ya"  class="btn blue btn-block">
            </span>	
        </center>
        <br>		
    </div>
</form>