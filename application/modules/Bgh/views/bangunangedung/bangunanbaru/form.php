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
                            <thead>
                                <th>Nama</th>
                                <th>Kode</th>
                                <th>Poin</th>
                                <th>Dokumen Pembuktian`</th>
                            </thead>
                            <?php
                            // print_r($checklist);
                            for ($i = 0; $i < count($checklist); $i++) {
                            ?>
                                <tbody>
                                    <tr>
                                        <td><strong><?= $checklist[$i]['nama'] ?></strong></td>
                                        <td><?= $checklist[$i]['kode'] ?></td>
                                        <td><?= $checklist[$i]['poin'] ?></td>
                                        <td></td>
                                    </tr>
                                    <?php for ($j = 0; $j < count($checklist[$i]['main']); $j++) { ?>
                                        <tr>
                                            <td class="ps-5"><strong><?= ($j + 1) . ". " . $checklist[$i]['main'][$j]['nama'] ?></strong></td>
                                            <td><?= $checklist[$i]['main'][$j]['kode'] ?></td>
                                            <td><?= $checklist[$i]['main'][$j]['poin'] ?></td>
                                            <td></td>
                                        </tr>
                                        <?php for ($k = 0; $k < count($checklist[$i]['main'][$j]['sub']); $k++) { ?>
                                            <tr>
                                                <td class="ps-6"><strong><?= $checklist[$i]['main'][$j]['sub'][$k]['nama'] ?></strong></td>
                                                <td><?= $checklist[$i]['main'][$j]['sub'][$k]['kode'] ?></td>
                                                <td><?= $checklist[$i]['main'][$j]['sub'][$k]['poin'] ?></td>
                                                <td></td>
                                                <?php
                                                if ($checklist[$i]['main'][$j]['sub'][$k]['poin'] == 1) {
                                                ?>

                                                <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php for ($l = 0; $l < count($checklist[$i]['main'][$j]['sub'][$k]['subsub']); $l++) { ?>

                                                <tr>
                                                    <td class="ps-7" rowspan="<?= count($checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok']) + 1    ?>"><?= ($l + 1) . ". " . $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['nama'] ?></td>
                                                    <td rowspan="<?= count($checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok']) + 1 ?>"><?= $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['kode'] ?></td>
                                                    <td rowspan="<?= count($checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok']) + 1 ?>"><?= $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['poin'] ?></td>

                                                    <?php for ($o = 0; $o < count($checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok']); $o++) { ?>
                                                <tr>
                                                    <td><?= ($o + 1) . ". " . $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok'][$o]['nama'] ?></td>
                                                    <td>
                                                        <input type="file">
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>


                                </tbody>

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