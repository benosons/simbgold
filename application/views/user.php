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
  <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
  <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" />
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


  <!-- BEGIN THEME STYLES -->
  <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
  <link href="<?php echo base_url(); ?>assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color" />
  <link href="<?php echo base_url(); ?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css" />
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

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/gmaps/gmaps.min.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL PLUGINS -->
  <!-- BEGIN PAGE LEVEL SCRIPTS -->
  <script src="<?php echo base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/admin/pages/scripts/index.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/admin/pages/scripts/components-pickers.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/pages/scripts/form-wizard.js"></script>
  <!-- END PAGE LEVEL SCRIPTS -->

  <!-- BEGIN PAGE LEVEL PLUGINS -->
  <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/select2/select2.min.js"></script>
  <!-- DataTables -->
  <!-- DataTables -->
  <script src="<?php echo base_url(); ?>assets/global/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/global/datatables/dataTables.bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
  <!-- END PAGE LEVEL PLUGINS -->
  <!-- BEGIN PAGE LEVEL SCRIPTS -->
  <script src="<?php echo base_url(); ?>assets/admin/pages/scripts/table-managed.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/pages/scripts/maps-google.js" type="text/javascript"></script>


  <link rel="shortcut icon" href="favicon.ico" />
  <script>
    var base_url = '<?php echo site_url(); ?>';
  </script>
</head>

<body class="page-header-fixed page-quick-sidebar-over-content page-style-square">
  <?php $this->load->view('header'); ?>
  <div class="clearfix">
  </div>
  <!-- BEGIN CONTAINER -->
  <div class="page-container">
    <?php $this->load->view('sidebarmenu'); ?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
      <div class="page-content">

        <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <?php

        $data = array(
          'title' => $title,
          'heading' => $heading
        );

        $this->load->view('page_header', $data);

        ?>

        <?php echo $content; ?>

        <div class="clearfix">
        </div>


      </div>
    </div>
    <!-- END CONTENT -->

  </div>

  <style type="text/css">
    .modal-header {
      background-color: #3498db;
    }

    .modal-title {
      color: white;
    }

    .modal-footer {
      background-color: #3498db;
    }

    /*.modal-content{
    background-color: black;
}
.modal-title{
    border-bottom: none;
}
.modal-body{
    color: white;
}*/

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

    .footeres {
      padding: 15px;
      text-align: right;
      border-top: 1px solid #e5e5e5;
      background-color: white;
    }

    #pesan {
      font-size: 15px;
      color: #333333;
      font-weight: bold;
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
      Metronic.init();
      Layout.init();
      QuickSidebar.init();
      Demo.init();
      TableManaged.init();
      ComponentsPickers.init();
      FormWizard.init();
      MapsGoogle.init();
    });

    function reloadata() {
      location.reload();
    }

    function batal() {
      location.reload();
    }
  </script>
  <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>