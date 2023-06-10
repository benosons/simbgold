
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Dashboard - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->
    <link href="<?= base_url() ?>assets/bgh/dist/css/tabler.css" rel="stylesheet"/>
    <link href="<?= base_url() ?>assets/bgh/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="<?= base_url() ?>assets/bgh/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="<?= base_url() ?>assets/bgh/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="<?= base_url() ?>assets/bgh/dist/libs/DataTables-1.13.4/css/datatables.min.css" rel="stylesheet"/>
    <!-- Tabler Core -->
    <script src="<?= base_url() ?>assets/bgh/dist/js/tabler.min.js" defer></script>
    <script src="<?= base_url() ?>assets/bgh/dist/js/demo.min.js" defer></script>

  </head>
  <body >
    <script src="<?= base_url() ?>assets/bgh/dist/js/demo-theme.min.js"></script>
    <div class="page">
      <?= $this->load->view('static/header') ?> 
      
      <?= $this->load->view('static/navbar') ?> 
      
      <div class="page-wrapper">
        <?= $content ?>
        <?= $this->load->view('static/footer') ?>
      </div>
    </div>
  </body>
</html>