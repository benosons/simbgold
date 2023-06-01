<!-- BEGIN HEADER TOP -->
<div class="page-header-top">
  <div class="container">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
      <a href="<?= base_url(); ?>"><img src="<?= base_url() ?>assets\admin\layout3\images\LogoPUPR.png" alt="logo"
        class="logo-default lazyload" style="height:46px;">
      </a>
    </div>
    
    <a href="javascript:;" class="menu-toggler responsive-toggler" id="menuadmin" data-toggle="collapse" data-target="#headeradmin">
    </a>
    <div class="top-menu">
      <ul class="nav navbar-nav pull-right">

        <li class="dropdown dropdown-user dropdown-dark">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <span class="username username-hide-mobile"><b><?php echo $this->session->userdata('loc_email'); ?></b></span>
            <img src="<?php echo base_url(); ?>assets/gambar/personal.png" class="img-circle">
          </a>
          <ul class="dropdown-menu dropdown-menu-default">
            <li>
		              <a href="<?php echo site_url('Profile/Data_Profil'); ?>" style="color: white;">
		                <i class="icon-wrench" style="color: white;"></i> Pengaturan Profil </a>
		            </li>
            <!--li>
              <a href="<?php echo site_url('Profile'); ?>" style="color: white;">
                <i class="icon-wrench" style="color: white;"></i> Akun Saya </a>
            </li>
            <li>
              <a href="<?php echo site_url('Profile/ubah_password'); ?>" style="color: white;">
                <i class="icon-key" style="color: white;"></i> Ubah Kata Sandi </a>
            </li-->
            <li>
              <a href="<?php echo site_url('Front/logout'); ?>" style="color: white;">
                <i class="icon-logout" style="color: white;"></i> Keluar </a>
            </li>
          </ul>
        </li>

      </ul>
    </div>

  </div>
</div>
<!-- END HEADER TOP -->
<div class="clearfix"> </div>

<div class="page-header-menu" id="headeradmin" id="headeradmin">
  <div class="container">
    <div class="hor-menu hor-menu-light" style="width: 100%;">
      <ul class="nav navbar-nav">
        <?php
        $this->mmenu->getMenu($this->session->userdata('loc_role_id'));
        ?>
      </ul>
      <!--ul class="nav navbar-nav" style="float:right">
        <li>
      <a href="#" data-toggle="modal" data-target="#PanduanAplikasi">
        <span class="username" >
        <i class="fa fa-book"></i>
          Informasi
        </span>
      </a>
        </li>
      </ul-->
    </div>
  </div>
</div>


<div id="PanduanAplikasi" class="modal fade" tabindex="-1" aria-hidden="true" data-width="70%" data-backdrop="static" data-keyboard="false">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 align="center" class="modal-title"><b>PANDUAN APLIKASI SIMBG v1.1</b></h4>
  </div>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12 ">
        <div class="form-body">

          <div class="col-md-4">
            <div class="top-news">
              <a href="https://www.google.com/" target="_blank" class="btn blue">
                <span>Pemohon</span>
                <em>Buku Panduan</em>
                <em>
                  <i class="fa fa-tags"></i>
                  SIMBG untuk pemohon. </em>
                <i class="fa fa-book top-news-icon"></i>
              </a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="top-news">
              <a href="javascript:;" class="btn blue">
                <span>
                  Video Tutorial </span>
                <em>Simulasi Penggunaan</em>
                <em>
                  <i class="fa fa-tags"></i>
                  SIMBG Versi 1.1 </em>
                <i class="fa fa-youtube-play top-news-icon"></i>
              </a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="top-news">
              <a href="javascript:;" class="btn blue">
                <span>
                  Dinas Teknis & DPMPTSP </span>
                <em>Buku Panduan</em>
                <em>
                  <i class="fa fa-tags"></i>
                  SIMBG untuk antar dinas. </em>
                <i class="fa fa-book top-news-icon"></i>
              </a>
            </div>
          </div>
          <br>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <center><button type="button" data-dismiss="modal" class="btn yellow-crusta">Tutup</button></center>
  </div>


</div>

<div id="PPsit" class="modal fade" tabindex="-1" aria-hidden="true" data-width="25%" data-backdrop="static" data-keyboard="false">


  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 align="center" class="modal-title"><b>Pilih Pengajuan</b></h4>
  </div>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12 ">
        <div class="form-body">
          <div class="col-sm-12">
            <div class="top-news">
              <a href="javascript:;" class="btn blue">
                <span>PBG</span>
              </a>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="top-news">
              <a href="javascript:;" class="btn blue">
                <span>SLF </span>
              </a>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="top-news">
              <a href="javascript:;" class="btn blue">
                <span>SBKBG </span>
              </a>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="top-news">
              <a href="javascript:;" class="btn blue">
                <span>RTB </span>
              </a>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="top-news">
              <a href="javascript:;" class="btn blue">
                <span>PENDATAAN BG</span>
              </a>
            </div>
          </div>
          <br>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <center><button type="button" data-dismiss="modal" class="btn yellow-crusta">Batal</button></center>
  </div>
</div>