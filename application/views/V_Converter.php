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
  <link href="<?php echo base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
  <!-- END GLOBAL MANDATORY STYLES -->

  <!-- END PAGE STYLES -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/select2/select2.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
  <link href="<?php echo base_url(); ?>assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
  <!-- END PAGE DATATABLE -->

  <!-- BEGIN THEME STYLES -->
  <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
  <link href="<?php echo base_url(); ?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/admin/layout3/css/themes/blue-steel.css" rel="stylesheet" type="text/css" id="style_color" />
  <link href="<?php echo base_url(); ?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/
  <!-- END THEME STYLES -->

  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

  <!-- END CORE PLUGINS -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/select2/select2.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL PLUGINS -->
  
  <!-- BEGIN PAGE LEVEL SCRIPTS -->
  <script src="<?php echo base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/admin/pages/scripts/index.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/admin/pages/scripts/ui-blockui.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/admin/pages/scripts/table-managed.js"></script>
	

  <!--link rel="shortcut icon" href="favicon.ico" /-->
  <script>
     var base_url = '<?php echo site_url(); ?>';
  </script>

</head>

<body class="page-header-menu-fixed">
<div class="page-header">
<!-- BEGIN HEADER TOP -->
<div class="page-header-top">
  <div class="container">
    <!-- BEGIN LOGO -->
     <div class="page-logo">
		<a>
			<img src="<?= base_url() ?>assets\admin\layout3\images\LogoPUPR.png" alt="logo" class="logo-default lazyload" style="height:52px;">
		</a>
	</div>
	<a href="javascript:;" class="menu-toggler responsive-toggler" id="menuadmin" data-toggle="collapse" data-target="#headeradmin"></a>
    <div class="top-menu">
      <ul class="nav navbar-nav pull-right">
        
        <li class="dropdown dropdown-user dropdown-dark">
			<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<span class="username username-hide-mobile"><b><?php echo $this->session->userdata('loc_username'); ?></b></span>
				<img src="<?php echo base_url(); ?>assets/gambar/personal.png" class="img-circle">
			</a>
        </li>
       
      </ul>
    </div>
   
  </div>
</div>
<!-- END HEADER TOP -->
    <div class="clearfix"></div>
	
		<div class="page-header-menu navbar-collapse collapse" id="headeradmin">
			<div class="container">
				<div class="hor-menu hor-menu-light" style="width: 100%;">
					
					<ul class="nav navbar-nav" style="float:right">
						<li>
							<a href="<?php echo site_url('Converter/Logout'); ?>">
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
  
	<div class="page-container">
		<div class="page-content">
		  <div class="container">
			<?php echo $content; ?>
		  </div> <!-- END CONTENT -->
		</div>
	</div>

    <?php $this->load->view('footer'); ?>
	
	<script>
		jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        Index.init(); // init index page
		UIBlockUI.init();
		//TableManaged.init();
      });
	</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>