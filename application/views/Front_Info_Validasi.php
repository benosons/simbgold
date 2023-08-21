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
		<link rel="shortcut icon" href="<?= base_url() ?>assets\admin\layout3\images\favicon.ico" />
	</head>
	<body class="page-header-menu-fixed">
		<div class="page-header">
			<div class="page-header-top">
				<div class="container">
					<div class="page-logo">
						<a href="<?= base_url(); ?>"><img src="<?= base_url() ?>assets\admin\layout3\images\LogoPUPR.png" alt="logo" class="logo-default" style="height:46px;"></a>
					</div>
					<a href="javascript:;" class="menu-toggler responsive-toggler" id="menuadmin" data-toggle="collapse" data-target="#headeradmin"></a>
					<div class="top-menu"></div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="page-header-menu navbar-collapse collapse" id="headeradmin">
				<div class="container">
					<div class="hor-menu hor-menu-light" style="width: 100%;">
						<ul class="nav navbar-nav">
							<li class="menu-dropdown classic-menu-dropdown "><a data-hover="megamenu-dropdown" href="<?= base_url(); ?>">Beranda</a></li>
						</ul>
						<ul class="nav navbar-nav" style="float:right">
							<li>
								<a data-hover="megamenu-dropdown" href="<?= base_url(); ?>Informasi"><span class=""><i class="fa fa-book"></i>Informasi</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="page-container">
			<div class="page-content">
				<div class="container">
					<div class="portlet light">
						<?php echo $content ?>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('Depan/modal') ?>
		<?php $this->load->view('footer2'); ?>
		<script>
			var base_url = '<?php echo site_url(); ?>';
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
				
		<?}?>
	</body>
</html>
