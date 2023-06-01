<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8" />
	<title>SIMBG</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="google-site-verification" content="jD3QMYhBx8V_dl44O9RpOOufFUJiXYKgrpNsSGqj3Ms" />
	<?php $this->load->view('Depan/css') ?>
	<link rel="shortcut icon" href="<?= base_url() ?>favicon.ico" />
</head>
<body class="page-header-menu-fixed">
	<div class="page-header">
		<!-- BEGIN HEADER TOP -->
		<div class="page-header-top">
			<div class="container">
				<div class="page-logo">
					<a href="<?= base_url(); ?>"><img src="<?= base_url() ?>assets\admin\layout3\images\LogoPUPR.png" alt="logo" class="logo-default" style="height:46px;"></a>
				</div>
				<a href="javascript:;" class="menu-toggler responsive-toggler" id="menuadmin" data-toggle="collapse" data-target="#headeradmin"></a>
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<li class="dropdown dropdown-user">
							<a data-toggle="modal" data-target="#Daftarin" class="dropdown-toggle" data-close-others="true" aria-expanded="false">
								<span class="username"><i class="icon-user"></i>Daftar </span></i>
							</a>
						</li>
						<li class="dropdown dropdown-user">
							<a data-toggle="modal" data-target="#Loginnya" class="dropdown-toggle" data-close-others="true" aria-expanded="false">
								<span class="username"><i class="fa fa-lock"></i> Masuk</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="page-header-menu navbar-collapse collapse" id="headeradmin">
			<div class="container">
				<div class="hor-menu hor-menu-light" style="width: 100%;">
					<ul class="nav navbar-nav">
						<li class="menu-dropdown classic-menu-dropdown ">
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>">Beranda</a>
						</li>
						<li class="menu-dropdown classic-menu-dropdown ">
							<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class=""> Pemohon <i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu">
								<li class=" submenu"><a href="<?= base_url(); ?>Informasi/Pemohon">Pemohon PBG</a></li>
								<li class=" submenu"><a href="<?= base_url(); ?>Informasi/Perencana_Kontruksi">Perencana Kontruksi</a></li>
								<li class=" submenu"><a href="<?= base_url(); ?>Informasi/Pelaksana_Kontruksi">Pelaksana Kontruksi</a></li>
								<li class=" submenu"><a href="<?= base_url(); ?>Informasi/Perencana_Pembongkaran">Perencana Pembongkaran</a></li>
								<li class=" submenu"><a href="<?= base_url(); ?>Informasi/Pelaksana_Pembongkaran">Pelaksana Pembongkaran</a></li>
								<li class=" submenu"><a href="<?= base_url(); ?>Informasi/Permohonan_bgh">Permohonan BGH</a></li>
							</ul>
						</li>
						<li class="menu-dropdown classic-menu-dropdown">
							<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="">TPA <i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu">
								<li class=" submenu"><a href="<?= base_url(); ?>Informasi/Calon_TPA">Calon TPA</a></li>
								<li class=" submenu"><a href="<?= base_url(); ?>Informasi/Tpa_bgh">TPA BGH</a></li>
								<li class=" submenu"><a href="<?= base_url(); ?>Informasi/Asosiasi_Profesi">Asosiasi Profesi</a></li>
								<li class=" submenu"><a href="<?= base_url(); ?>Informasi/Perguruan_Tinggi">Perguruan Tinggi</a></li>
							</ul>
						</li>
						<li class="menu-dropdown classic-menu-dropdown">
							<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">Pemerintah Daerah <i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu">
								<li class=" dropdown-submenu">
									<a href="#"><i class=""></i>Dinas Teknis </a>
									<ul class="dropdown-menu">
										<li class=" "><a href="<?= base_url(); ?>Informasi/Dinas_Teknis">Kepala Dinas </a></li>
										<li class=" "><a href="<?= base_url(); ?>Informasi/Dinas_Teknis">Pengawas </a></li>
										<li class=" "><a href="<?= base_url(); ?>Informasi/Dinas_Teknis">Operator</a></li>
										<li class=" "><a href="<?= base_url(); ?>Informasi/Dinas_Teknis">Penilik</a></li>
										<li class=" "><a href="<?= base_url(); ?>Informasi/Dinas_Teknis">TPT</a></li>
									</ul>
								</li>
								<li class=" dropdown-submenu"><a href="#">Dinas Perizinan </a>
									<ul class="dropdown-menu">
										<li class=" "><a href="<?= base_url(); ?>Informasi/DPMPTSP">Kepala Dinas </a></li>
										<li class=" "><a href="<?= base_url(); ?>Informasi/DPMPTSP">Pengawas </a></li>
										<li class=" "><a href="<?= base_url(); ?>Informasi/DPMPTSP">Operator</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="menu-dropdown classic-menu-dropdown">
							<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="">Pemerintah Pusat <i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu">
								<li class=" submenu"><a href="<?= base_url(); ?>Informasi/Eksekutif"><i class=""></i>Eksekutif</a></li>
								<li class=" submenu"><a href="<?= base_url(); ?>Informasi/Sekretariat"><i class=""></i>Sekretariat SIMBG </a></li>
								<li class=" submenu"><a href="<?= base_url(); ?>Informasi/Balai_Daerah"><i class=""></i>Balai Daerah</a></li>
								<li class=" submenu"><a href="<?= base_url(); ?>Informasi/BGFK"><i class=""></i>Unit Pelayanan Teknis BGFK</a></li>
							</ul>
						</li>
					</ul>
					<ul class="nav navbar-nav" style="float:right">
						<li>
							<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>Informasi">
								<span class=""><i class="fa fa-book"></i>Informasi</span>
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
				<div class="portlet light"><?php echo $content ?></div>
			</div>
		</div>
	</div>
	<?php $this->load->view('Depan/modal') ?>
	<?php $this->load->view('footer2'); ?>
	<script>
		var base_url = '<?php echo site_url(); ?>';
		function delsku(){
			$.ajax({
				type : "GET",
				url  : "<?php echo base_url('Front/delsku/')?>",
				success: function(){
					$('#notifBerhasil').modal('hide');
				}
			});
				return false;
		};
	</script>
	<?php $this->load->view('Depan/js') ?>
	<? if ($this->session->flashdata('message') != ''){?>
		<? if ($this->session->flashdata('status') != 'danger'){?>
			<script>
				$('#notifBerhasil').modal('show');
			</script>
		<?}else{?>
			<script>
				$('#notif').modal('show');
			</script>	
		<?}?>
	<?}else{?>
		<script type="text/javascript">
			$('#PanduanAplikasi2').modal('show');
		</script>	
	<?}?>
</body>
</html>
