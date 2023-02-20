<!DOCTYPE html>
<script type="application/javascript">
	function GetPdfPanduan(id_bg,f){
	url = "<?php echo base_url() ?>file/doc/Panduan.pdf";
	swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	swin.focus();
	}
</script>
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
	<script>
		var base_url = '<?php echo site_url(); ?>';
	</script>
</head>
<body>

	<div class="page-container">
		<!-- BEGIN CONTENT -->
		<div class="page-content">
			<div class="container">
				<div class="portlet light">
					<?php echo $content ?>
				</div>
			</div>
		</div>
	</div>

	<style type=" text/css">
		.modal-header {
			background-color: #3498db;
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