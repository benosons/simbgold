<!DOCTYPE html>

<html lang="en" class="no-js">

<head>
  <meta charset="utf-8" />
  <title>SIMBG</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="<?php echo base_url(); ?>assets/css.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
  
  <link href="<?php echo base_url(); ?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/admin/layout3/css/themes/blue-steel.css" rel="stylesheet" type="text/css" id="style_color" />
  <link href="<?php echo base_url(); ?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css" />
  <!-- END THEME STYLES -->
  <style>

.page-content {
  background: #fff;
  padding: 15px 0 15px;
}

.page-header .page-header-menu .hor-menu .navbar-nav > li > a {
  font-size: 15px;
  font-weight: normal;
  padding: 16px 18px 15px 18px;
}

.page-header .page-header-menu {
  background: #030f6b;
  /* Default Mega Menu */
  /* Light Mega Menu */
  /* Header seaech box */
}

.page-prefooter {
    background: #030f6b;
    color: #fafcfb;
}

.page-prefooter h2 {
  color: #ffffff;
}

.page-prefooter a {
  color: #ffffff;
}

.page-prefooter .subscribe-form .form-control {
  background: #fff;
  border-color: #ffc107;
  color: #a2abb7;
}

.page-prefooter .subscribe-form .btn {
  color: #fff;
  background-color: #ffc107;
  
}

.page-footer {
  background:#070c38;
  color: #ffffff;
  font-size: 13px;
  font-weight: 300;
  padding: 17px 0;
}  
  </style>
  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>

  <script src="<?php echo base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/admin/pages/scripts/index.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
  

  <script>
    var base_url = '<?php echo site_url(); ?>';
  
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        Index.init(); // init index page
      });
  </script>
</head>

<body class="page-header-menu-fixed">
<!--body class="page-header-top-fixed"-->
  <div class="page-header">
<!-- BEGIN HEADER TOP -->
<div class="page-header-top">
  <div class="container">
    <!-- BEGIN LOGO -->
     <div class="page-logo">
          <a href="<?= base_url(); ?>"><img src="<?= base_url() ?>assets\admin\layout3\images\LogoPUPR.png" alt="logo"
              class="logo-default lazyload" style="height:52px;">
          </a>
        </div>
  <a href="javascript:;" class="menu-toggler responsive-toggler" id="menuadmin" data-toggle="collapse"
          data-target="#headeradmin">
        </a>

    <div class="top-menu">
      <ul class="nav navbar-nav pull-right">
        
        <li class="dropdown dropdown-user dropdown-dark">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

            
            <span class="username username-hide-mobile"><b><?php echo $this->session->userdata('loc_email'); ?></b></span>
            <img src="<?php echo base_url(); ?>assets/gambar/personal.png" class="img-circle">
          </a>
          <!--ul class="dropdown-menu dropdown-menu-default">
            <li>
              <a href="<?php echo site_url('profile'); ?>" style="color: white;">
                <i class="icon-wrench" style="color: white;"></i> Akun Saya </a>
            </li>
            <li>
              <a href="<?php echo site_url('profile/ubah_password'); ?>" style="color: white;">
                <i class="icon-key" style="color: white;"></i> Ubah Kata Sandi </a>
            </li>
            <li>
              <a href="<?php echo site_url('front/logout'); ?>" style="color: white;">
                <i class="icon-logout" style="color: white;"></i> Keluar </a>
            </li>
          </ul-->
        </li>
       
      </ul>
    </div>
   
  </div>
</div>
<!-- END HEADER TOP -->
    <div class="clearfix">
    </div>
    <div class="page-header-menu navbar-collapse collapse" id="headeradmin">
      <div class="container">
        <div class="hor-menu hor-menu-light" style="width: 100%;">
          
          <ul class="nav navbar-nav" style="float:right">
            <li class="menu-dropdown classic-menu-dropdown ">
              <a data-toggle="modal" data-target="#Xnotif"><i class="icon-home"></i> Beranda</a>
            </li>
            <li>
              <a href="<?php echo site_url('Front/logout'); ?>">
                <span class="username">
                  <i class="icon-logout"></i> Keluar
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- BEGIN CONTAINER -->
  <div class="page-container">

    <div class="page-content">
      <div class="container">
        <?php echo $content; ?>
      </div> <!-- END CONTENT -->
    </div>
  
  </div>
<div id="Xnotif" class="modal fade" tabindex="-1" aria-hidden="true" data-width="25%" data-backdrop="static"
  data-keyboard="false" style="background-color:#fcf8e3">
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12 ">
        <div class="form-body">
          <center>
          <b>Lengkapi Akun Anda,<br>Agar Dapat Mengakses Menu Lainnya.</b>
          <hr>
          <button type="button" data-dismiss="modal" class="btn blue-hoki">OK</button>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>

    <?php $this->load->view('footer'); ?>

    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>