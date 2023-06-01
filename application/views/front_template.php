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
	<!-- BEGIN PAGE STYLES -->
	<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/admin/pages/css/pricing-table.css" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL STYLES -->

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/layout3/vendors/bootstrap-toastr/toastr.min.css">
	<!-- BEGIN THEME STYLES -->
	<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
	<link href="<?php echo base_url(); ?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/admin/layout3/css/themes/blue-steel.css" rel="stylesheet" type="text/css" id="style_color" />
	<link href="<?php echo base_url(); ?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css" />
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
	<script>
		var base_url = '<?php echo site_url(); ?>';
	</script>
	<script>
		<?= $this->session->flashdata('message') ?>;
	</script>
</head>

<body>
	<div class="page-header">
		<!-- BEGIN HEADER TOP -->
		<div class="page-header-top">
			<div class="container">
				<!-- BEGIN LOGO -->
				<div class="page-logo">
					<a href=""><img src="<?= base_url() ?>assets\admin\layout3\images\logo.png" alt="logo" class="logo-default lazyload" style="height:58px;width:60px"></a>
				</div>
				<div class="page-header-title">
					<p>KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT<br>
						DIREKTORAT JENDERAL CIPTA KARYA<br>
						DIREKTORAT BINA PENATAAN BANGUNAN
					</p>
				</div>

				<a href="javascript:;" class="menu-toggler responsive-toggler" id="menuadmin" data-toggle="collapse" data-target="#headeradmin"></a>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<!-- BEGIN NOTIFICATION DROPDOWN -->
						<li class="dropdown dropdown-user">
							<a data-toggle="modal" data-target="#Daftarin" class="dropdown-toggle" data-close-others="true" aria-expanded="false">

								<span class="username">
									<i class="icon-user"></i>
									Pendaftaran </span></i>
							</a>
						</li>
						<!-- BEGIN USER LOGIN DROPDOWN -->
						<li class="dropdown dropdown-user">

							<!--a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false"-->
							<a data-toggle="modal" data-target="#Loginnya" class="dropdown-toggle" data-close-others="true" aria-expanded="false">
								<span class="username">
									<i class="fa fa-lock"></i> Masuk</span>
							</a>
							<!--ul class="dropdown-menu dropdown-menu-default" role="menu" style="width: 275px;">

								<div class="col-lg-12">
									<form method="post" role="form" autocomplete="off" id="frmLogin" style="margin-top:5px" action="<?php echo site_url('front/login'); ?>">
										<div class="form-group">
											<label>Username</label>
											<input type="text" class="form-control" placeholder="Username" id="usernamenya" name="usernamenya" value="<?php set_value('username') ?>">
										</div>
										<div class="form-group">
											<label>Kata Sandi</label>
											<input type="password" class="form-control" placeholder="Kata Sandi" id="passwordnya" name="passwordnya">
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-7">
													<div class="text-center">
														<a data-toggle="modal" data-target="#ResetPwd">
																Lupa Kata Sandi
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
							</ul-->
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
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>front/lacak">Lacak Berkas</a>
						</li>
						<li class="menu-dropdown">
							<a data-hover="megamenu-dropdown" data-toggle="modal" data-target="#ResetPwd">Lupa Kata Sandi</a>
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

	<!-- awal panduan -->
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
	<!-- akhir panduan -->

	<!-- awal ubah kata sandi -->
	<div id="ResetPwd" class="modal fade" tabindex="-1" aria-hidden="true" data-width="30%" data-backdrop="static" data-keyboard="false">
		<?php
		// Include the random string file
		require 'rand2.php';
		$str = $this->session->set_userdata('captcha_id', $str);
		?>
		<form action="<?php echo site_url('front/getdata_reset_password'); ?>" class="form-horizontal" role="form" method="post" id="from_data_password">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 ">
						<div class="form-body">
							<h3 class="form-title">Lupa Kata Sandi ?</h3>
							<div class="form-group">
								<!--label class="control-label">Masukkan Username <span class="required">* </span></label-->
								<div class="input-icon">
									<i class="fa fa-user"></i>
									<input type="text" class="form-control" name="reset_pass" placeholder="Masukkan Email Anda" id="reset_pass" />
								</div>
							</div>
							<div class="form-group">
								<!--label class="control-label">Kode Keamanan <span class="required">* </span></label-->
								<div id="gantiimage">
									<img id="gantiimg" src="<?= base_url() ?>front/image_captcha?<?php echo time(); ?>" href="<?php echo htmlEntities(base_url() . ""); ?>" width="183" height="56" alt="Captcha image">

								</div>
								<div class="input-icon">
									<i class="fa fa-check"></i>
									<input type="text" class="form-control" name="caca" for="caca" placeholder="Masukkan nama buah di atas" />
								</div>
							</div>

							<div id="uname_res">

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer" style="background-color:#fff">
				<button class="btn blue" type="button" data-dismiss="modal" data-toggle="modal" data-target="#Daftarin"><i class="fa fa-user"></i> Daftar</button>
				<button type="submit" class="btn green" style="float:left"><i class="fa fa-send-o"></i> Kirim</button>
				<button type="button" data-dismiss="modal" class="btn red">X Batal</button>
			</div>
		</form>
	</div>
	<!-- akhir ubah kata sandi -->

	<!-- awal pendaftaran -->
	<div id="Daftarin" class="modal fade" tabindex="-1" aria-hidden="true" data-width="50%" data-backdrop="static" data-keyboard="false">
		<?php
		// Include the random string file
		require 'rand2.php';
		$str = $this->session->set_userdata('captcha_id', $str);
		?>
		<form action="<?php echo site_url('front/saveDaftarUser'); ?>" class="form-horizontal" role="form" method="post" id="from_biodata">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 align="center" class="modal-title"><b>FORM PENDAFTARAN</b></h4>
			</div>
			<div class="modal-body" style="background-color:#fff;">
				<div class="row">
					<div class="col-md-12 ">
						<div class="form-body">
							<br>
							<div class="form-group">
								<label class="control-label col-md-4">Email <span class="required">* </span></label>
								<div class="col-sm-8">
									<div class="input-icon right">
										<input type="text" class="form-control" name="email" for="email" placeholder="Masukkan Alamat Email Anda dengan benar" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4">Kata Sandi <span class="required">* </span></label>
								<div class="col-sm-8">
									<div class="input-icon right">
										<input type="password" class="form-control" name="password_user" for="password_user" id="password_user" placeholder="Masukkan kata sandi Anda (gabungan huruf dan angka)" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4">Konfirmasi Kata Sandi <span class="required">* </span></label>
								<div class="col-sm-8">
									<div class="input-icon right">
										<input type="password" class="form-control" name="confirm_new_password" placeholder="Ulangi Kata Sandi Anda" autocomplete="off">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">Kode Keamanan <span class="required">* </span></label>
								<div class="col-sm-8">
									<div id="captchaimage" style="padding: 10px 0px;"><a href="<?php echo htmlEntities(base_url() . ""); ?>" id="refreshimg" title="Ubah Captcha">
											<img src="<?= base_url() ?>front/image_captcha?<?php echo time(); ?>" width="183" height="56" alt="Captcha image"></a>
									</div>
								</div>
								<div class="col-sm-4 control-label">
								</div>
								<div class="col-sm-8">
									<div class="input-icon right">
										<input type="text" class="form-control" name="captcha" for="captcha" placeholder="Masukkan nama buah di atas" />
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<center>

					<button type="submit" name="submit" class="btn green"><i class="fa fa-send-o"></i> Kirim</button>
					<button type="button" data-dismiss="modal" class="btn red">X Batal</button>
				</center>
			</div>
		</form>
	</div>
	<!-- akhir pendaftaran -->

	<!-- awal masuk -->
	<div id="Loginnya" class="modal fade" tabindex="-1" aria-hidden="true" data-width="30%" data-backdrop="static" data-keyboard="false">
		<?php
		// Include the random string file
		require 'rand2.php';
		$str = $this->session->set_userdata('captcha_id', $str);
		?>
		<form action="<?php echo site_url('front/login'); ?>" class="form-horizontal" role="form" method="post" id="frmLogin">

			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 ">
						<div class="form-body">
							<h3 class="form-title">Masuk</h3>
							<div class="form-group">
								<!--label class="control-label">Username <span class="required">* </span></label-->
								<div class="input-icon">
									<i class="fa fa-user"></i>
									<input type="text" class="form-control" name="email" placeholder="Masukkan Email" id="email" />
								</div>
							</div>
							<div class="form-group">
								<!--label class="control-label">Kata Sandi <span class="required">* </span></label-->
								<div class="input-icon">
									<i class="fa fa-lock"></i>
									<input type="password" class="form-control" name="passwordnya" placeholder="Masukkan Kata Sandi" id="passwordnya" />
									<a data-dismiss="modal" data-toggle="modal" data-target="#ResetPwd" style="float:right">Lupa Kata Sandi?</a>
								</div>
							</div>
							<div class="form-group">
								<!--label class="control-label">Kode Keamanan <span class="required">* </span></label-->
								<div id="gantiimagenya">
									<img id="gantiimgnya" src="<?= base_url() ?>front/image_captcha?<?php echo time(); ?>" href="<?php echo htmlEntities(base_url() . ""); ?>" width="183" height="56" alt="Captcha image">

								</div>
								<div class="input-icon">
									<i class="fa fa-check"></i>
									<input type="text" class="form-control" name="cacanya" for="cacanya" placeholder="Masukkan nama buah di atas" />
								</div>
							</div>

							<div id="uname_resnya">

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer" style="background-color:#fff">
				<button type="submit" class="btn green" style="float:left"><i class="fa fa-sign-in"></i> Masuk</button>
				<button class="btn blue" type="button" data-dismiss="modal" data-toggle="modal" data-target="#Daftarin"><i class="fa fa-user"></i> Daftar</button>
				<button type="button" data-dismiss="modal" class="btn red">X Batal</button>
			</div>
		</form>
	</div>
	<!-- akhir masuk -->

	<!-- awal konfirmasi -->
	<div id="konfirmasi" class="modal fade" tabindex="-1" aria-hidden="true" data-width="30%" data-backdrop="static" data-keyboard="false" style="background-color:#dff0d8">
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">
						<h4 class="form-title" align="center"><b>Pendaftaran Berhasil</b></h4>
						<div class='alert alert-success'>
							<span>
								<div class="pesanOutput"></div>
							</span>
						</div>
					</div>
				</div>
				<center>
					<button type="button" data-dismiss="modal" class="btn green">Ok</button>
				</center>
			</div>
		</div>
	</div>

	<div id="confirmationData" class="modal fade" tabindex="-1" aria-hidden="true" data-width="30%" data-backdrop="static" data-keyboard="false" style="background-color:#dff0d8">
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">
						<h4 class="form-title" align="center"><b>Pendaftaran Gagal</b></h4>
						<div class='alert alert-danger'>
							<span>
								<div class="pesanOutput"></div>
							</span>
						</div>
					</div>
				</div>
				<center><button type="button" data-dismiss="modal" class="btn red">Ok</button></center>
			</div>
		</div>
	</div>
	<!-- akhir konfirmasi -->

	<?php $this->load->view('footer'); ?>
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
	<script src="<?php echo base_url(); ?>assets/admin/layout3/vendors/bootstrap-toastr/toastr.min.js"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->

	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/index.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/ui-extended-modals.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/ui-blockui.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL SCRIPTS -->

	<!-- BEGIN PAGE LEVEL PLUGINS -->

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/global/jquery-validate/captcha/x4.js"></script>
	<script type="text/javascript">
	$('#PanduanAplikasi').modal('show');
</script>

</body>
<!-- END BODY -->

</html>