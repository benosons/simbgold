<!DOCTYPE html>

<html lang="en" class="no-js">

<head>
	<meta charset="utf-8" />
	<title>SIMBG</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<script type="text/javascript" src="<?= base_url() ?>assets/global/jquery-validate/lib/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/global/jquery-validate/dist/jquery.validate.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/global/jquery-validate/captcha/validasi.js"></script>

	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="<?php echo base_url(); ?>assets/css.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
	<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE STYLES -->
	<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css" />
	<!-- END PAGE STYLES -->

	<!-- DATATABLE -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/select2/select2.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/datatables/dataTables.bootstrap.css">
	<link href="<?php echo base_url(); ?>assets/admin/pages/css/profile-old.css" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL STYLES -->
	<!-- END PAGE DATATABLE -->

	<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />

	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="<?php echo base_url(); ?>assets/admin/pages/css/pricing-table.css" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL STYLES -->


	<!-- BEGIN THEME STYLES -->
	<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
	<link href="<?php echo base_url(); ?>assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/admin/layout3/css/themes/blue-steel.css" rel="stylesheet" type="text/css" id="style_color" />
	<link href="<?php echo base_url(); ?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css" />

	<!-- END THEME STYLES -->

	<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->

	<script src="<?php echo base_url(); ?>assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
	<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
	<script src="<?php echo base_url(); ?>assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/index.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/quick-sidebar.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL SCRIPTS -->

	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<!-- DataTables -->
	<!-- DataTables -->
	<script src="<?php echo base_url(); ?>assets/global/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/global/datatables/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/table-managed.js"></script>
	<script src="<?php echo base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/quick-sidebar.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/components-pickers.js"></script>

	<link rel="shortcut icon" href="favicon.ico" />

	<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

	<?php
	$assets = $this->uri->segment('1');
	if ($this->uri->segment(2) != '') {
		$assets2 = $this->uri->segment(2);
		if (file_exists(APPPATH . "modules/$assets/views/$assets2/assets" . EXT) === TRUE) {
			$this->load->view("$assets2/assets");
			//echo APPPATH."modules/$assets/views/$assets2/assets".EXT;
		} else if (file_exists(APPPATH . "modules/$assets/views/assets" . EXT) === TRUE) {
			$this->load->view('/assets');
			//echo APPPATH."modules/$assets/views/assets".EXT;
		} else {
			echo "";
		}
	}
	?>



	<script>
		var base_url = '<?php echo site_url(); ?>';
	</script>
</head>

<body>
	<div class="page-header">
		<!-- BEGIN HEADER TOP -->
		<div class="page-header-top">
			<div class="container">
				<!-- BEGIN LOGO -->
				<div class="page-logo">
					<!-- <a href="index.html"><img src="http://simpbg.pu.go.id/_themes/default/assets/images/logo.png" alt="logo" class="logo-default lazyload"></a> -->
					<a href=""><img src="<?= base_url() ?>assets\admin\layout3\images\logo.png" alt="logo" class="logo-default lazyload" style="height:58px;width:60px"></a>
				</div>
				<div class="page-header-title">
					<p>KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT<br>
						DIREKTORAT JENDERAL CIPTA KARYA<br>
						DIREKTORAT BINA PENATAAN BANGUNAN
					</p>
				</div>
				<!-- <div class="page-header-mobile">
      <img src="<?= base_url(); ?>assets\admin\layout3\images\title-mobile.png" alt="">
    </div> -->
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<!-- <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a> -->
				<!-- <a href="javascript:;" class="menu-toggler responsive-toggler" id="menufront" data-toggle="collapse" data-target="#headerfront"></a> -->
				<a href="javascript:;" class="menu-toggler responsive-toggler" id="menuadmin" data-toggle="collapse" data-target="#headeradmin"></a>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<!-- BEGIN NOTIFICATION DROPDOWN -->
						<li class="dropdown dropdown-user">
							<a href="<?php echo base_url(); ?>front/pendaftaran" class="dropdown-toggle" data-close-others="true" aria-expanded="false">
								<!-- <img alt="" class="img-circle" src="../../assets/admin/layout3/img/avatar9.jpg"> -->
								<span class="username">
									<i class="icon-user"></i>
									Pendaftaran </span></i>
							</a>
						</li>
						<!-- BEGIN USER LOGIN DROPDOWN -->
						<li class="dropdown dropdown-user">

							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
								<!-- <img alt="" class="img-circle" src="../../assets/admin/layout3/img/avatar9.jpg"> -->
								<span class="username">
									<i class="fa fa-lock"></i> Masuk</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-default" role="menu" style="width: 275px;">

								<div class="col-lg-12">
									<form method="post" role="form" autocomplete="off" id="frmLogin" style="margin-top:5px" action="<?php echo site_url('front/login'); ?>">
										<div class="form-group">
											<label>Username</label>
											<input type="text" class="form-control" placeholder="Username" id="username" name="username" value="<?php set_value('username') ?>">
										</div>
										<div class="form-group">
											<label>Kata Sandi</label>
											<input type="password" class="form-control" placeholder="Kata Sandi" id="password" name="password">
										</div>
								<div class="form-group">
                                    <label >Kode Keamanan <span class="required">* </span></label>
                                    
                                        <div id="captchaimage" style="padding: 10px 0px;"><a href="<?php echo htmlEntities(base_url() . "front/pendaftaran"); ?>" id="refreshimg" title="Click to refresh image">
                                                <img src="<?= base_url() ?>front/image_captcha?<?php echo time(); ?>" width="183" height="56" alt="Captcha image"></a>
                                        </div>
                                    
                                        <div class="input-icon right">
                                            <input type="text" class="form-control" name="captcha" for="captcha" placeholder="Masukkan nama buah di atas" />
                                        </div>
                                        
                                   
                                </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-7">
													<div class="text-center">
														<a href="<?php echo base_url(); ?>front/reset_password" class="forgot-password">
															<font>
																Lupa Kata Sandi?
															</font>
														</a>
													</div>
												</div>
												<div class="col-xs-5 pull-right">
													<input type="submit" class="form-control btn btn-success" name="login" value="Masuk">
												</div>
											</div>
										</div>
									</form>


								</div>
							</ul>
						</li>
						<!-- END USER LOGIN DROPDOWN -->
					</ul>

				</div>

				<!-- END TOP NAVIGATION MENU -->
			</div>
		</div>
		<!-- END HEADER TOP -->
		<div class="clearfix">
		</div>
		<div class="page-header-menu navbar-collapse collapse" id="headeradmin">
			<div class="container">
				<div class="hor-menu hor-menu-light" style="width: 100%;">
					<ul class="nav navbar-nav">
						<li class="menu-dropdown classic-menu-dropdown ">
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>front/index">Beranda Perizinan</a>
						</li>
						<li class="menu-dropdown">
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>front/informasi">Informasi Perizinan</a>
						</li>
						<li class="menu-dropdown">
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>front/profil">Profil Dinas </a>
						</li>
						<li class="menu-dropdown">
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>front/kontak">Hubungi Kami</a>
						</li>
						<li class="menu-dropdown">
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>front/lacak">Lacak Berkas</a>
						</li>
						<!--<li>
							<a href="https://drive.google.com/drive/folders/1NK_sFADkox3o-9MGcE3Pf61J4vulheCe?usp=sharing" target="_blank">Download Modul SIMBG</a>
						</li>-->
					</ul>
					<ul class="nav navbar-nav" style="float:right">
						<li>
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<!-- <img alt="" class="img-circle" src="../../assets/admin/layout3/img/avatar9.jpg"> -->
								<span class="username">
									<i class="fa fa-question"></i>
									Panduan Aplikasi
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
		<!-- BEGIN CONTENT -->
		<div class="page-content">
			<div class="container">
				
				<div class="portlet light">
					<?php echo $content ?>
				</div>
				<!-- END PAGE CONTENT INNER -->
			</div>
		</div>
		<!-- END PAGE CONTENT -->
	</div>

	<style type=" text/css">
		.modal-header {
			background-color: #416db4;
		}

		.modal-title {
			color: white;
		}

		.modal-footer {
			background-color: #3498db;
		}

		.modaltitle {
			margin: 0;
			line-height: 1.42857143;
			color: black;
		}

		.modalheader {
			min-height: 16.43px;
			padding: 8px;
			border-bottom: 1px solid #e5e5e5;
			background-color: white;
		}
	</style>
	<div class="modal fade" id="modalalert">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modalheader">
					<h4 class="modaltitle">Alert</h4>
				</div>
				<div class="modal-body">
					<div id="pesan"></div>
				</div>
				<div class="footeres">
					<button type="button" class="btn btn-default" onclick="reloadata()">Keluar</button>
				</div>
			</div>
		</div>
	</div>

	<?php $this->load->view('footer'); ?>


	<script>
		jQuery(document).ready(function() {
			// Metronic.init();
			// Layout.init();
			// QuickSidebar.init();
			// Demo.init();
			TableManaged.init();
			// ComponentsPickers.init();
			// FormWizard.init();
			// MapsGoogle.init();
		});

		function reloadata() {
			location.reload();
		}

		function batal() {
			location.reload();
		}
		jQuery(document).ready(function() {
			// initiate layout and plugins
			Metronic.init(); // init metronic core components
			Layout.init(); // init current layout
			QuickSidebar.init(); // init quick sidebar
			Demo.init(); // init demo features
			Index.init(); // init index page
			ComponentsPickers.init();
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>