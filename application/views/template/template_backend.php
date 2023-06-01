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
    <?php $this->load->view('template/backend/layout/css'); ?>
    <!--link rel="shortcut icon" href="favicon.ico" /-->
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
	<style>
        hr,
        p {
            margin: 0px 0;
        }
    </style>

    <script>
        var base_url = '<?php echo site_url(); ?>';
        var segments = '<?= $this->uri->segment(3) ?>';
    </script>
</head>

<body>
    <div class="page-header">
        <?php $this->load->view('template/backend/layout/header'); ?>

        <div class="clearfix"> </div>

        <?php $this->load->view('template/backend/layout/sidebar'); ?>

    </div>

    <div class="page-container">

    </div>

    <div class="page-content">
        <div class="container">
            <?php echo $contents; ?>
        </div>
    </div>

    <?php $this->load->view('footer'); ?>

    <?php $this->load->view('template/backend/layout/js'); ?>

    <?php $this->load->view('template/backend/layout/datatables'); ?>
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>