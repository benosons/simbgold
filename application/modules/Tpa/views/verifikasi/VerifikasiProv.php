<form action="<?php echo site_url('Tpa/SimpanStatusProv'); ?>" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
    <div class="col-md-12 ">
        <input class="form-control" value="<?php echo $id;?>" id="id" name="id" style="display: none;">						
        <div class="page-title" align="center">
            <span class="caption font-blue-hoki bold" style="font-size: 15px;">Apakah Dokumen dan Informasi yang disediakan sesuai?</span>
        </div>
        <center>
            <span class="input-group-btn">
                <input id="xstileng" name="xstileng" type="submit" value="Ya"  class="btn blue btn-block">
            </span>
            ||		
            <span class="input-group-btn">
                <input id="xsleng" name="xsleng" type="submit" value="Tidak"  class="btn red btn-block"><br>
            </span>		
        </center>
        <br>		
    </div>
</form>