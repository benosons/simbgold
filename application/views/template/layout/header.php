<div class="page-header">
    <div class="page-header-top">
        <div class="container">
            <div class="page-logo">
                <?php
                if ($this->session->userdata('loc_logo')) {
                    $logo = $this->session->userdata('loc_logo');
                    if (isset($logo) && $logo != '') {
                        $fileGbr = $logo;
                    } else {
                        $fileGbr = 'pupr.png';
                    }
                ?>
                    <img src="<?= base_url() ?>file\LogoKabKota\<?= $fileGbr ?>" alt="logo" class="logo-default lazyload" style="height:58px;width:60px">
                <?php } else { ?>
                    <img src="<?= base_url() ?>assets\admin\layout3\images\logo.png" alt="logo" class="logo-default lazyload" style="height:58px;width:60px">
                <?php } ?>
            </div>
            <div class="page-header-title">
                <span class="username">
                    <?php
                    $ndinas = $this->session->userdata('loc_dinas');
                    if (isset($ndinas) && $ndinas != '') {
                        $NamaDinas = $ndinas;
                    } else {
                        $NamaDinas = 'KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT';
                    }
                    ?>
                    <p>
                        <? echo $NamaDinas;?><br>
                        SISTEM INFORMASI MANAJEMEN BANGUNAN GEDUNG<br>
                        DIREKTORAT BINA PENATAAN BANGUNAN
                    </p>
                </span>
            </div>

            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">

                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                            <span class="username" style="color: white;border: 1px solid #416db4;padding: 2px 10px;border-radius: 10px !important;background: #416db4;">
                                <?php 
                                echo $this->session->userdata('loc_username') != null ? $this->session->userdata('loc_username') : $this->session->userdata('loc_email') ; ?>
                                <i class="icon-user"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="<?php echo site_url('front/logout'); ?>" style="color: white;">
                                    <i class="icon-logout" style="color: white;"></i> Keluar </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

        </div>
    </div>
    <!-- END HEADER TOP -->
    <div class="clearfix">
    </div>
    <div class="page-header-menu navbar-collapse collapse">
        <div class="container">
            <div class="hor-menu hor-menu-light" style="width: 100%;">
                <ul class="nav navbar-nav">
                    <li class="menu-dropdown classic-menu-dropdown ">
                        <a href="#"><i class="icon-home"></i> Beranda</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav" style="float:right">
                    <li>
                        <a data-toggle="modal" data-target="#PanduanAplikasi">
                            <span class="username">
                                <i class="fa fa-book"></i>
                                Panduan Aplikasi
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>