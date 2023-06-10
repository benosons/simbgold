<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Permohonan BGH
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
  <div class="container-xl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tahap Perencanaan</h4>
                </div>
                <div class="card-body">
                    <table class="table table-stripped">
                        <?php  
                            print_r($checklist);
                            foreach($checklist as $check){
                        ?>
                        <thead>
                            <tr>
                                <th><strong><?= $check->nama ?></strong></th>
                            </tr>
                            <?= $check->main."sada" ?>
                        </thead>

                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<script src="<?= base_url() ?>assets/bgh/dist/libs/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
<script src="<?= base_url() ?>assets/bgh/dist/libs/DataTables-1.13.4/js/datatables.min.js"></script>

<script>
    $(() => {
        $('#menu-bangunan').addClass('active');
    })
</script>