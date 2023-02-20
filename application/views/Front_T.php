<!DOCTYPE html>

<html lang="en" class="no-js">

<head>
	<meta charset="utf-8" />
	<title>SIMBG</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />


	<?php $this->load->view('Depan/css') ?>
	


	<!-- END THEME STYLES -->

	<link rel="shortcut icon" href="favicon.ico" />

</head>

<body class="page-header-menu-fixed">
	<div class="page-header">
		<!-- BEGIN HEADER TOP -->
		<div class="page-header-top">
			<div class="container">
				<!-- BEGIN LOGO -->
				<div class="page-logo">
					<a href="<?= base_url(); ?>"><img src="<?= base_url() ?>assets\admin\layout3\images\logo.png" alt="logo" class="logo-default lazyload" style="height:58px;width:60px"></a>
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
							<a href="<?= base_url(); ?>front/pendaftaran" class="dropdown-toggle" data-close-others="true" aria-expanded="false">

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
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>"><!--i class="icon-home"></i--> Beranda</a>
						</li>
						<li class="menu-dropdown">
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>front/Pemohon">Pemohon</a>
						</li>
						<li class="menu-dropdown">
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>front/Tpa">TPA</a>
						</li>
						
						<li class="menu-dropdown">
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>front/Arsitek">Arsitek</a>
						</li>
						
						<li class="menu-dropdown">
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>front/Dinas_Teknis">Dinas Teknis</a>
						</li>
						<li class="menu-dropdown">
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>front/DPMPTSP">DPMPTSP</a>
						</li>
						<li class="menu-dropdown">
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>front/Informasi">Layanan Informasi</a>
						</li>
						
					</ul>
					<ul class="nav navbar-nav" style="float:right">
						<li>
							<a data-toggle="modal" data-target="#PanduanAplikasi">
								<span class="">
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
					<?php
						echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" style="margin-bottom:0px;" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : '';
					?>
					<?php echo $content ?>
				</div>
				<!-- END PAGE CONTENT INNER -->
			</div>
		</div>
		<!-- END PAGE CONTENT -->
	</div>

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
									<input type="text" class="form-control" name="reset_pass" placeholder="Masukkan Username" id="reset_pass" />
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
								<label class="control-label col-md-4">ID Pengguna <span class="required">* </span></label>
								<div class="col-sm-8">
									<div class="input-icon right">
										<input type="text" class="form-control" value="<?php echo set_value('username', (isset($username) ? $username : '')) ?>" name="username" for="username" placeholder="Masukkan Username Anda" autocomplete="off">
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
								<label class="control-label col-md-4">Email <span class="required">* </span></label>
								<div class="col-sm-8">
									<div class="input-icon right">
										<input type="text" class="form-control" name="email" for="email" placeholder="Masukkan Alamat Email Anda dengan benar" />
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
				<a class="btn blue" href="<?= site_url('front/pendaftaran') ?>"><i class="fa fa-user"></i> Daftar</a>
				<button type="button" data-dismiss="modal" class="btn red">X Batal</button>
			</div>
		</form>
	</div>
	<!-- akhir masuk -->

	<div id="PanduanAplikasi" class="modal fade" tabindex="-1" aria-hidden="true" data-width="70%" data-backdrop="static" data-keyboard="false">
		<div class="modal-header" >
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 align="center" class="modal-title"><b>PANDUAN APLIKASI SIMBG v2.1</b></h4>
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
									<em><i class="fa fa-tags"></i>SIMBG untuk pemohon. </em>
									<i class="fa fa-book top-news-icon"></i>
								</a>
							</div>
						</div>
						<div class="col-md-4">
							<div class="top-news">
								<a href="javascript:;" class="btn blue">
									<span>Video Tutorial </span>
									<em>Simulasi Penggunaan</em>
									<em><i class="fa fa-tags"></i>SIMBG Versi 1.1 </em>
									<i class="fa fa-youtube-play top-news-icon"></i>
								</a>
							</div>
						</div>
						<div class="col-md-4">
							<div class="top-news">
								<a href="javascript:;" class="btn blue">
									<span>Dinas Teknis & DPMPTSP </span>
									<em>Buku Panduan</em>
									<em><i class="fa fa-tags"></i>SIMBG untuk antar dinas. </em>
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
	
	<!-- awal pendaftaran -->
	<div id="Daftarin2" class="modal fade" tabindex="-1" aria-hidden="true" data-width="50%" data-backdrop="static" data-keyboard="false">
		<?php
		// Include the random string file
		require 'rand2.php';
		$str = $this->session->set_userdata('captcha_id', $str);
		?>
		<form action="<?php echo site_url('front/saveDaftarUser'); ?>" class="form-horizontal" role="form" method="post" id="from_biodata">
			<div class="modal-body" style="background-color:#fff;">
				<div class="row">
					<div class="portlet light">
						
						<div class="portlet-body">
							<div class=" portlet-tabs">
								<ul class="nav nav-tabs">
									<li class="">
										<a href="#portlet_tab2_2" data-toggle="tab" aria-expanded="false">
										<b>Pemohon</b> </a>
									</li>
									<li class="active">
										<a href="#portlet_tab2_1" data-toggle="tab" aria-expanded="true">
										<b>TPA / Calon Tenaga Profesional Ahli / Atau Apalah</b></a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="portlet_tab2_1">
										<div class="alert alert-warning">
											<b>Penjelasan :</b><br>
											 Check out the below dropdown menu. It will be opened as usual since there is enough space at the bottom.<bR>
											 Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait.
										
										</div>
									</div>
									<div class="tab-pane" id="portlet_tab2_2">
										<div class="alert alert-success">
											<b>Penjelasan :</b><br>
											 Check out the below dropdown menu. It will be opened as usual since there is enough space at the bottom.<bR>
											 Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait.
										
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 ">
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-4">ID Pengguna <span class="required">* </span></label>
								<div class="col-sm-8">
									<div class="input-icon right">
										<input type="text" class="form-control" value="<?php echo set_value('username', (isset($username) ? $username : '')) ?>" name="username" for="username" placeholder="Masukkan Username Anda" autocomplete="off">
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
								<label class="control-label col-md-4">Email <span class="required">* </span></label>
								<div class="col-sm-8">
									<div class="input-icon right">
										<input type="text" class="form-control" name="email" for="email" placeholder="Masukkan Alamat Email Anda dengan benar" />
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
				<center><a href="<?= site_url('Profile/lengkapi_akun') ?>" type="button" class="btn green">OK</a></center>
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
	<?php $this->load->view('footer2'); ?>
	<script>
		var base_url = '<?php echo site_url(); ?>';
	</script>
	<?php $this->load->view('Depan/js') ?>

</body>
<!-- END BODY -->

</html>