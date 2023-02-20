<script type="application/javascript">
    function GetPdfInfo2(id_bg, f) {
        url = "<?php echo base_url() ?>admin/file/foto/proses/1.2 Bagan Tata Cara Penyelenggaraan IMB Bangunan Gedung Sederhana 2 Lantai Bukan untuk Kepentingan Umum yang Dokumen Rencana Teknisnya Dibuat oleh Perencana Konstruksi.pdf";
        swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
        swin.focus();
    }
</script>
<div class="page-header-menu" id="headeradmin" id="headeradmin">
    <div class="container">
        <div class="hor-menu hor-menu-light" style="width: max-content;">
            <ul class="nav navbar-nav">
                <?php
                $this->mmenu->getMenu($this->session->userdata('loc_role_id'));
                ?>
            </ul>
        
        </div>
    </div>
</div>