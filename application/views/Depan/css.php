<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<?php echo base_url(); ?>assets/css.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="<?php echo base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE STYLES -->

<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<!--link href="<?php echo base_url(); ?>assets/admin/pages/css/pricing-table.css" rel="stylesheet" type="text/css" /-->

<link href="<?php echo base_url(); ?>assets/admin/pages/css/news.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/admin/pages/css/portfolio.css" rel="stylesheet" type="text/css"/>

<!-- END PAGE LEVEL STYLES -->


<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="<?php echo base_url(); ?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/admin/layout3/css/themes/blue-steel.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="<?php echo base_url(); ?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css" />



<style>
	a:hover,a:focus{
		outline: none;
		text-decoration: none;
	}
	.tab .nav-tabs{
		position: relative;
		border-bottom: none;
		margin-bottom: 20px
	}
	.tab .nav-tabs li{
		text-align: center;
		margin-right: 3px;
	}
	.tab .nav-tabs li a{
		display: block;
		font-size: 16px;
		font-weight: 600;
		color: #fff;
		padding: 10px 15px;
		background: #ffc107;
		margin-right: 0;
		border-radius: 16px 55px;
		border: none;
		border-bottom: 4px solid #030f6b;
		position: relative;
		transition: all 0.5s ease 0s;
	}
	.nav-tabs li.active a,
	.nav-tabs li.active a:focus,
	.nav-tabs li.active a:hover,
	.nav-tabs li a:hover{
		border: none;
		border-bottom: 4px solid #ffc107;
		background: #030f6b;
		color: #fff;
	}
	.tab .tab-content{
		font-size: 14px;
		color: #333;
		line-height: 26px;
		border: 2px solid #030f6b;
		border-radius: 16px 55px;
		padding: 15px;
		margin-top: 2px;
		
	}
	.tab .tab-content h3{
		font-size: 24px;
		margin-top: 0;
	}
	@media only screen and (max-width: 479px){
		.tab .nav-tabs li{
			width: 100%;
			margin-bottom: 5px;
		}
	}
	
.form-group.form-md-line-input {
  position: relative;
  margin: 0 0 20px 0;
  padding-top: 10px;
}
</style>
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

.section-title {
  text-align: center;
  padding-bottom: 30px;
}

.section-title h2 {
  font-size: 32px;
  font-weight: bold;
  text-transform: uppercase;
  margin-bottom: 20px;
  padding-bottom: 20px;
  position: relative;
  color: #030f6b;
}

.section-title h2::after {
  content: '';
  position: absolute;
  display: block;
  width: 50px;
  height: 3px;
  background: #ffc107;
  bottom: 0;
  left: calc(50% - 25px);
}

.hijau.btn {
  color: #FFFFFF;
  background-color: #00c827;
}
.hijau.btn:hover, .hijau.btn:focus, .hijau.btn:active, .hijau.btn.active {
  color: #FFFFFF;
  background-color: #00a520;
}

.kuning.btn {
  color: #FFFFFF;
  background-color: #ffc107;
}
.kuning.btn:hover, .kuning.btn:focus, .kuning.btn:active, .kuning.btn.active {
  color: #FFFFFF;
  background-color: #ce9b00;
}

.merah.btn {
  color: #FFFFFF;
  background-color: #fd0009;
}
.merah.btn:hover, .merah.btn:focus, .merah.btn:active, .merah.btn.active {
  color: #FFFFFF;
  background-color: #d6040c;
}
.biru.btn {
  color: #FFFFFF;
  background-color: #0087fc;
}
.biru.btn:hover, .biru.btn:focus, .biru.btn:active, .biru.btn.active {
  color: #FFFFFF;
  background-color: #3178cc;
}

/*--------------------------------------------------------------
# Hero Section
--------------------------------------------------------------*/
#hero {
  width: 100%;
  height: auto;
  background: white;
  border-bottom: 2px solid white;
}

#hero .container {
  padding-top: 100px;
   padding-bottom: 100px;
}

#hero h1 {
  margin: 0;
  font-size: 48px;
  font-weight: 400;
  line-height: 56px;
  color: #030f6b;
  font-family: "Poppins", sans-serif;
}

#hero h2 {
  margin: 10px 0 0 0;
  font-size: 20px;
}

#hero ul {
  margin-top: 15px;
  list-style: none;
  padding: 0;
}

#hero ul li {
  padding: 10px 0 0 28px;
  position: relative;
}

#hero ul i {
  left: 5px;
  
  position: absolute;
  font-size: 20px;
  color: #030f6b;
}

#hero .btn-get-started, #hero .btn-get-quote {
  font-family: "Poppins", sans-serif;
  font-weight: 400;
  font-size: 15px;
  letter-spacing: 0.5px;
  display: inline-block;
  padding: 8px 30px 9px 30px;
  margin-bottom: 15px;
  border-radius: 3px;
  transition: 0.5s;
  border-radius: 50px;
}

#hero .btn-get-started {
  background: #030f6b;
  color: #fff;
  border: 2px solid #030f6b;
  margin-right: 10px;
}

#hero .btn-get-started:hover {
  background: #030f6b;
  border-color: #030f6b;
}

#hero .btn-get-quote {
  color: #030f6b;
  border: 2px solid #030f6b;
}

#hero .btn-get-quote:hover {
  background: #030f6b;
  color: #fff;
}

@media (min-width: 1024px) {
  #hero {
    background-attachment: fixed;
  }
  #hero .hero-img img {
    width: 100%;
  }
}

@media (max-width: 991px) {
  #hero .hero-img {
    text-align: center;
  }
  #hero .hero-img img {
    width: 50%;
  }
}

@media (max-width: 768px) {
  #hero h1 {
    font-size: 28px;
    line-height: 36px;
  }
  #hero h2 {
    font-size: 18px;
    line-height: 24px;
    margin-bottom: 30px;
  }
  #hero .hero-img img {
    width: 70%;
  }
}

@media (max-width: 575px) {
  #hero {
    text-align: center;
  }
  #hero ul {
    text-align: left;
    font-size: 14px;
  }
  #hero .hero-img img {
    width: 80%;
  }
  #hero .btn-get-started, #hero .btn-get-quote {
    padding-left: 18px;
    padding-right: 18px;
    font-size: 14px;
  }
  #hero .container {
	padding-top: 30px;
  }
}


/*--------------------------------------------------------------
# Why Us
--------------------------------------------------------------*/
.why-us {
  padding-top: 0;
  padding-bottom: 60px;
}

.why-us .box {
  padding: 50px 25px 25px 25px;
  box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
  transition: all ease-in-out 0.3s;
  min-height: 280px;
}

.why-us .box span {
  display: block;
  font-size: 48px;
  font-weight: 700;
  color: #ffc107;
}

.why-us .box h4 {
  font-size: 20px;
  font-weight: 600;
  padding: 0;
  margin: 0 0 5px 0;
  color: #030f6b;
}

.why-us .box p {
  color: #aaaaaa;
  font-size: 15px;
  margin: 0;
  padding: 0;
}

.why-us .box:hover {
  background: #030f6b;
  padding: 30px 25px 50px 25px;
  box-shadow: 10px 15px 30px rgba(0, 0, 0, 0.18);
}

.why-us .box:hover span, .why-us .box:hover h4, .why-us .box:hover p {
  color: #fff;
}

/***
Custom vertical inline menu
***/
.ver-inline-menu {
  padding: 0;
  margin: 0;
  list-style: none;
}
.ver-inline-menu li {
  position: relative;
  margin-bottom: 1px;
}
.ver-inline-menu li i {
  width: 37px;
  height: 37px;
  display: inline-block;
  color: #030f6b;
  font-size: 15px;
  padding: 12px 10px 10px 8px;
  margin: 0 8px 0 0;
  text-align: center;
  background: #ffc107 !important;
}
.ver-inline-menu li a {
    font-size: 16px;
    font-weight: bold;
    color: #696d70;
    display: block;
    background: #ffc107;
    border-left: solid 2px #c4d5df;
}
.ver-inline-menu li:hover a {
  background: #e0eaf0;
  text-decoration: none;
}
.ver-inline-menu li:hover i {
  color: #fff;
  background: #c4d5df !important;
}
.ver-inline-menu li.active a {
  border-left: solid 2px #030f6b;
}
.ver-inline-menu li.active i {
  background: #030f6b !important;
}
.ver-inline-menu li.active a, .ver-inline-menu li.active i {
  color: #fff;
  background: #030f6b;
  text-decoration: none;
}
.ver-inline-menu li.active a, .ver-inline-menu li:hover a {
  font-size: 16px;
}
.ver-inline-menu li.active:after {
  content: '';
  display: inline-block;
  border-bottom: 6px solid transparent;
  border-top: 6px solid transparent;
  border-left: 6px solid #169ef4;
  position: absolute;
  top: 12px;
  right: -5px;
}

@media (max-width: 767px) {
  .ver-inline-menu > li.active:after {
    display: none;
  }
}

.panel-title {
    font-size: 16px;
	font-weight: bold;
    color: #fff;
	
}

.panel-title:hover a {
  color: #fff;
  text-decoration: none;
}

.panel-default>.panel-heading {
    color: #333;
    background-color: #030f6b;
    border-color: #ddd;
}

.col-xs-15,
.col-sm-15,
.col-md-15,
.col-lg-15 {
    position: relative;
    min-height: 1px;
    padding-right: 10px;
    padding-left: 10px;
}

.col-xs-15 {
    width: 20%;
    float: left;
}
@media (min-width: 768px) {
.col-sm-15 {
        width: 20%;
        float: left;
    }
}
@media (min-width: 992px) {
    .col-md-15 {
        width: 20%;
        float: left;
    }
}
@media (min-width: 1200px) {
    .col-lg-15 {
        width: 20%;
        float: left;
    }
}


/*News Feeds*/
.news-blocks {
  padding: 10px;
  margin-bottom: 10px;
  background: #faf6ea;
  border: solid 2px #faf6ea;
}

.news-blocks:hover {
  background: #fff;
  border-color: #030f6b;
}


</style>