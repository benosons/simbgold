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
        <div class="card">
            <div class="card-header">
                <h4>Tahap Perencanaan | Poin Diajukan Keseluruhan : <?= $poinhead ?></h4>
                <?php if (isset($permohonan)) { ?>
                    <input type="text" id="id_permohonan_global" value="<?= $permohonan->id ?>" hidden>
                <?php } ?>
            </div>
            <div class="card-body">
                <div class="accordion" id="accordion-example">
                    <?php
                    // print_r($checklist);
                    for ($i = 0; $i < count($checklist); $i++) {
                        $alp = range('A', 'Z');
                        $poindiajukan = $checklist[$i]['poindiajukan'];
                    ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header " id="heading-<?= $checklist[$i]['id'] ?>">
                                <button class="accordion-button <?= ($i > 0) ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $checklist[$i]['id'] ?>" aria-expanded="true">
                                    <strong><?= $alp[$i] . '. ' . $checklist[$i]['nama'] ?> | Poin Tersedia : <?= $checklist[$i]['poin'] ?> | Poin Diajukan : <?= $poindiajukan ?> </strong>
                                </button>
                            </h2>
                            <div id="collapse-<?= $checklist[$i]['id'] ?>" class="accordion-collapse collapse <?php if(isset($_GET['accord'])){ if($_GET['accord'] == $alp[$i]){ echo 'show'; } } ?>" data-bs-parent="#accordion-example">
                                <div class="accordion-body pt-0">
                                    <?php 
                                        for ($j = 0; $j < count($checklist[$i]['main']); $j++) { 
                                            $namamain = $checklist[$i]['main'][$j]['nama'];
                                            $poinmain = $checklist[$i]['main'][$j]['poin'];
                                    ?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tr class="table-active">
                                                    <td width="3%"><?= ($j + 1) . '.' ?></td>
                                                    <td width="17%"><?= $namamain ?></td>
                                                    <td width="4%" class="text-center"><?= $poinmain ?></td>
                                                    <td width="12%">Claim Poin</td>
                                                    <td width="30%">Dokumen Pembuktian</td>
                                                    <td width="3%">Poin Diajukan</td>
                                                    <!-- <td width="6%">Kesesuaian Dokumen</td>
                                                    <td width="15%">Catatan</td>
                                                    <td>Assesment Poin</td> -->
                                                </tr>
                                                <?php
                                                for ($k = 0; $k < count($checklist[$i]['main'][$j]['sub']); $k++) {
                                                    $alphabet = range('a', 'z');
                                                    $pilihansub = $checklist[$i]['main'][$j]['sub'][$k]['pilihan'];
                                                    $dokumensub = $checklist[$i]['main'][$j]['sub'][$k]['dokumen'];
                                                    $idsub = $checklist[$i]['main'][$j]['sub'][$k]['id'];
                                                    $namasub = $checklist[$i]['main'][$j]['sub'][$k]['nama'];
                                                    $elparent = $alp[$i] . '_' . $alphabet[$k] . '' . $checklist[$i]['main'][$j]['sub'][$k]['id'];
                                                    $poinsub = $checklist[$i]['main'][$j]['sub'][$k]['poin'];
                                                    $poinambilsub = $checklist[$i]['main'][$j]['sub'][$k]['poinambil'];
                                                    $ambilsub = $checklist[$i]['main'][$j]['sub'][$k]['ambil'];
                                                    if ($pilihansub == 1) {
                                                        $terpilihsub = $checklist[$i]['main'][$j]['sub'][$k]['terpilih'];
                                                    }
                                                    if ($dokumensub == 1) {
                                                ?>
                                                        <tr>
                                                            <td></td>
                                                            <td><?= $namasub ?></td>
                                                            <td class="text-center"><?= $poinsub ?></td>
                                                            <td>
                                                                
                                                                <select name="" class="form-select <?= $elparent ?>" id="<?= $elparent ?>" onchange="claimpoin('<?= $elparent?>', '0',<?= $pilihansub ?>, event, <?= $poinsub?>,<?= $permohonan->id ?>, <?= $idsub ?>, 0)" <?= ($ambilsub == 1) ? 'disabled="disabled"':'' ?> >
                                                                    <option value="0">Tidak</option>
                                                                    <option value="1" <?= ($ambilsub == 1) ? 'selected':'' ?>>Ambil</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <table class="table table-borderless p-0">
                                                                    <thead>
                                                                        <th>No.</th>
                                                                        <th>Dokumen</th>
                                                                        <th>Upload</th>
                                                                    </thead>
                                                                    <?php 
                                                                        for ($o = 0; $o < count($checklist[$i]['main'][$j]['sub'][$k]['dok']); $o++) {
                                                                            $namadok = $checklist[$i]['main'][$j]['sub'][$k]['dok'][$o]['nama'];
                                                                            $iddok = $checklist[$i]['main'][$j]['sub'][$k]['dok'][$o]['id'];
                                                                            $isuploaddok = $checklist[$i]['main'][$j]['sub'][$k]['dok'][$o]['isupload'];
                                                                    ?>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="ps-3"><?= ($o + 1) . ". " ?></td>
                                                                                <td><?= $namadok ?></td>
                                                                                <td class="text-center align-middle <?= 'upload_' . $elparent ?> <?= $ambilsub == 1 ? '':'d-none' ?>">
                                                                                    <?php if($isuploaddok == 1){ ?>
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                                                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                                                                        </svg>
                                                                                    <?php }else{ ?>
                                                                                    <button class="btn btn-success btn-sm" onclick="openmodal(<?= $iddok ?>, <?= $poinsub ?>,<?= $idsub?>, 0, '<?= $alp[$i] ?>')" title="Upload">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                                            <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                                                                        </svg>
                                                                                    </button>
                                                                                    <?php } ?>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    <?php } ?>
                                                                </table>
                                                            </td>
                                                            <td class="text-center" id="<?= 'poin_' . $elparent ?>"><?= $poinambilsub ?></td>
                                                            <!-- <td></td>
                                                            <td></td>
                                                            <td>0</td> -->
                                                        </tr>
                                                    <?php } else { ?>
                                                        <tr>
                                                            <td></td>
                                                            <td><?= $namasub ?></td>
                                                            <td><?= $poinsub ?></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <!-- <td></td>
                                                            <td></td>
                                                            <td></td> -->
                                                        </tr>
                                                        <?php $jmlsubsub = count($checklist[$i]['main'][$j]['sub'][$k]['subsub']);
                                                        for ($l = 0; $l < $jmlsubsub; $l++) {
                                                            $elparent = $alp[$i] . '_' . $alphabet[$k] . '' . $checklist[$i]['main'][$j]['sub'][$k]['id'];
                                                            $elchild = $alp[$i] . '_' . $alphabet[$k] . '' . $checklist[$i]['main'][$j]['sub'][$k]['id'] . '_' . $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['id'];
                                                            $idsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['id'];
                                                            $namasubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['nama'];
                                                            $poinsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['poin'];
                                                            $ambilsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['ambil'];
                                                            $poinambilsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['poinambil'];
                                                        ?>

                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <table class="table table-borderless p-0">
                                                                        <tr>
                                                                            <!-- <td class="ps-3"><?= ($l + 1) . ". " ?></td> -->
                                                                            <td><?= $namasubsub ?></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td class="text-center"><?= $poinsubsub ?></td>
                                                                <td>
                                                                    <select name="" class="form-select <?= $elparent ?>" id="<?= $elchild ?>" onchange="claimpoin('<?= $elparent?>', '<?= $elchild ?>',<?= $pilihansub ?>, event, <?= $poinsubsub?>,<?= $permohonan->id ?>, 0, <?= $idsubsub ?>)" <?= ($ambilsubsub == 1 || ($ambilsubsub == 0 && $terpilihsub == 1)) ? 'disabled="disabled"':'' ?> >
                                                                        <option value="0">Tidak</option>
                                                                        <option value="1" <?= ($ambilsubsub == 1) ? 'selected':'' ?>>Ambil</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <table class="table table-borderless">
                                                                        <thead>
                                                                            <th>No.</th>
                                                                            <th>Dokumen</th>
                                                                            <th>Upload</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php 
                                                                                for ($o = 0; $o < count($checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok']); $o++) {
                                                                                    $namadok =  $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok'][$o]['nama'];
                                                                                    $isuploaddok = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok'][$o]['isupload'];
                                                                                    $iddok = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok'][$o]['id'];
                                                                            ?>
                                                                                <tr>
                                                                                    <td><?= ($o + 1) . '.' ?></td>
                                                                                    <td>
                                                                                        <?= $namadok ?>
                                                                                    </td>
                                                                                    <td class="text-center align-middle <?= $elchild ?> <?= ($ambilsubsub == 0) ? 'd-none' : '' ?>">
                                                                                    <?php if($isuploaddok == 1){ ?>
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                                                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                                                                        </svg>
                                                                                    <?php }else{ ?>
                                                                                        <button class="btn btn-success btn-sm" onclick="openmodal(<?= $iddok ?>, <?= $poinsubsub ?>, 0, <?= $idsubsub?>,'<?= $alp[$i] ?>')" title="Upload" data-id="<?= $iddok ?>">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                                                <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                                                                            </svg>
                                                                                        </button>
                                                                                    <?php } ?>
                                                                                    </td>
                                                                                    <!-- <td> -->
                                                                                    <!-- <input type="file"> -->
                                                                                    <!-- </td> -->
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td class="text-center" id="<?= 'poin_' . $elchild ?>"><?= $poinambilsubsub ?></td>
                                                                <!-- <td></td>
                                                                <td></td>
                                                                <td class="text-center">0</td> -->

                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-small" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <label for="" class="form-label">Upload File</label>
                <input type="file" class="form-control" id="fileinput">
                <div class="invalid-feedback" id="invalid-feedback">Belum ada File</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancel</button>
                <input type="text" id="id_permohonan" value="<?= (isset($permohonan) ? $permohonan->id : '') ?>" hidden>
                <input type="text" id="id_dokumen" hidden>
                <input type="text" id="poin_diajukan" hidden>
                <input type="text" id="id_sub" hidden>
                <input type="text" id="id_sub_sub" hidden>
                <input type="text" id="head" hidden>
                <button type="button" id="subm" class="btn btn-success">Upload
                    <div class="spinner-border spinner-border-sm text-white d-none ms-3" id="loaderupload" role="status"></div>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<!-- <div class="page-body">
  <div class="container-xl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tahap Perencanaan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped" style="width:auto">
                            <thead>
                                <th>Nama</th>
                                <th>Poin Tersedia</th>
                                <th>Claim Poin</th>
                                <th>Dokumen Pembuktian</th>
                                <th>Poin Diajukan</th>
                                <th>Kesesuaian Dokumen</th>
                                <th>Catatan</th>
                                <th>Assesment Poin</th>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($checklist); $i++) {
                                    $alp = range('A', 'Z');
                                ?>
                                <tr class="table-dark">
                                    <td width="30%"><strong><?= $alp[$i] . '. ' . $checklist[$i]['nama'] ?></strong></td>
                                    <td class="text-center"><strong><?= $checklist[$i]['poin'] ?></strong></td>
                                    <td width="7%"></td>
                                    <td width="30%"></td>
                                    <td></td>
                                    <td class="text-center"><strong></strong></td>
                                    <td width="10%"></td>
                                    <td width="20%"></td>
                                </tr>
                                <?php for ($j = 0; $j < count($checklist[$i]['main']); $j++) { ?>
                                    <tr class="fw-bold table-active">
                                        <td>
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td width="2%"><strong><?= ($j + 1) . ". " ?></strong></td>
                                                    <td width="50%"><strong><?= $checklist[$i]['main'][$j]['nama'] ?></strong></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="text-center align-middle"><?= $checklist[$i]['main'][$j]['poin'] ?></td>
                                        <td class="text-center align-middle">Claim Poin</td>
                                        <td class="text-center align-middle">Dokumen Pembuktian</td>
                                        <td class="text-center align-middle"><strong>0</strong></td>
                                        <td class="text-center align-middle">Kesesuaian Dokumen</td>
                                        <td class="text-center align-middle">Catatan</td>
                                        <td class="text-center align-middle"><strong>0</strong></td>
                                    </tr>
                                    <?php
                                        for ($k = 0; $k < count($checklist[$i]['main'][$j]['sub']); $k++) {
                                            $alphabet = range('a', 'z');
                                            if ($checklist[$i]['main'][$j]['sub'][$k]['dokumen'] == 1) {
                                    ?>
                                        <tr>
                                            <td class="ps-4">
                                                <table class="table table-borderless p-0">
                                                    <tr>
                                                        <td><?= ($alphabet[$k]) . ". " ?></td>
                                                        <td><strong><?= $checklist[$i]['main'][$j]['sub'][$k]['nama']  ?></strong></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="text-center"><?= $checklist[$i]['main'][$j]['sub'][$k]['poin'] ?></td>
                                            <td>
                                                <select name="" id="" class="form-control">
                                                    <option value="0">TIDAK</option>
                                                    <option value="1">AMBIL</option>
                                                </select>
                                            </td>
                                            <td>
                                                <table class="table table-stripped">
                                                <?php for ($o = 0; $o < count($checklist[$i]['main'][$j]['sub'][$k]['dok']); $o++) { ?>
                                                        <tr>
                                                            <td>
                                                                <table class="table table-borderless p-0">
                                                                    <thead>
                                                                        <th>No.</th>
                                                                        <th>Dokumen</th>
                                                                        <th>Upload</th>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td class="ps-3"><?= ($o + 1) . ". " ?></td>
                                                                        <td><?= $checklist[$i]['main'][$j]['sub'][$k]['dok'][$o]['nama'] ?></td>
                                                                        <td class="text-center align-middle">
                                                                            <button class="btn btn-primary btn-sm" title="Upload">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                                    <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z"/>
                                                                                </svg>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                <?php } ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td class="text-center">0</td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center">0</td>
                                        </tr>
                                    <?php } else { ?> 
                                        
                                        <tr>
                                            <td class="ps-4">
                                                <table class="table table-borderless p-0">
                                                    <tr>
                                                        <td><?= ($alphabet[$k]) . ". " ?></td>
                                                        <td><strong><?= $checklist[$i]['main'][$j]['sub'][$k]['nama']  ?></strong></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="text-center"><?= $checklist[$i]['main'][$j]['sub'][$k]['poin'] ?></td>  
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php for ($l = 0; $l < count($checklist[$i]['main'][$j]['sub'][$k]['subsub']); $l++) { ?>
                                            
                                            <tr>
                                                <td class="ps-5">
                                                    <table class="table table-borderless p-0">
                                                        <tr>
                                                            <td class="ps-3"><?= ($l + 1) . ". " ?></td>
                                                            <td><?= $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['nama'] ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td class="text-center"><?= $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['poin'] ?></td>
                                                <td >
                                                    <select name="" id="" class="form-control">
                                                        <option value="0">TIDAK</option>
                                                        <option value="1">AMBIL</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <table class="table table-stripped">
                                                        <thead>
                                                            <th>No.</th>
                                                            <th>Dokumen</th>
                                                            <th>Upload</th>
                                                        </thead>
                                                        <tbody>
                                                    <?php for ($o = 0; $o < count($checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok']); $o++) { ?>
                                                        <tr>
                                                            <td><?= ($o + 1) . '.' ?></td>
                                                            <td>
                                                                <?= $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok'][$o]['nama'] ?>
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <button class="btn btn-primary btn-sm" title="Upload">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                        <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z"/>
                                                                    </svg>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td class="text-center">0</td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center">0</td>

                                            </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                
                                <?php } ?>
                            </tbody>

                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div> -->

<script src="<?= base_url() ?>assets/bgh/dist/libs/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
<script src="<?= base_url() ?>assets/bgh/dist/libs/DataTables-1.13.4/js/datatables.min.js"></script>

<script>
    $(() => {
        $('#menu-bangunan').addClass('active');

        $('#fileinput').change(function() {
            $('#fileinput').removeClass('is-invalid');
        })
        $('#subm').click(function() {

            let fileinput = $('#fileinput');

            if (!fileinput.val()) {
                fileinput.addClass('is-invalid');
            } else {
                console.log(fileinput);
                console.log(fileinput.val());
                let file = fileinput[0].files[0]

                if (!validateFileExtension(file.name)) {
                    fileinput.addClass('is-invalid');
                    $('#invalid-feedback').html('Error, Pastikan Ekstensi File Anda .pdf, .xlx, .xlsx, .jpg, .png');
                    return;
                }

                var formData = new FormData();
                formData.append('file', file);
                formData.append('id_permohonan', $('#id_permohonan').val());
                formData.append('id_dokumen', $('#id_dokumen').val());
                formData.append('id_sub', $('#id_sub').val());
                formData.append('id_sub_sub', $('#id_sub_sub').val());
                formData.append('head', $('#head').val());
                uploading(formData);
            }
        });

        // $('#subm').click(function(){
        //     $('#loaderupload').removeClass('d-none');
        // })
    })

    function claimpoin(elparent, elchild, pilihan, event, elpoin, id_permohonan, id_sub, id_sub_sub) {
        let selectelement = event.target;
        let selected = selectelement.value;
        if (pilihan === 1 && selected === "1") {
            if (confirm('Ambil Poin Pertanyaan ini ?')) {
                let el = document.querySelectorAll('.' + elchild);
                let idel = elchild.substr(0, 4);
                [].forEach.call(el, function(elem) {
                    elem.classList.remove('d-none');
                });
                // let poinelement = document.getElementById('poin_'+elchild);
                // poinelement.innerHTML = elpoin;
                let parent = document.querySelectorAll('.' + elparent);
                [].forEach.call(parent, function(e) {
                    let elementid = e.getAttribute("id");
                    if (elementid !== elchild) {
                        e.setAttribute('disabled', 'disabled');
                    }
                })
                ambilpoin(id_permohonan, id_sub, id_sub_sub, elpoin);
            } else {
                $('#' + elchild).val(0);
            }

        } else if (pilihan === 1 && selected === "0") {
            if (confirm('Hapus Poin Pertanyaan ini ?')) {
                let el = document.querySelectorAll('.' + elchild);
                [].forEach.call(el, function(elem) {
                    elem.classList.add('d-none');
                })

                // let poinelement = document.getElementById('poin_'+elchild);
                // poinelement.innerHTML = 0;

                let parent = document.querySelectorAll('.' + elparent);
                [].forEach.call(parent, function(e) {
                    let elementid = e.getAttribute("id");
                    if (elementid !== elchild) {
                        e.removeAttribute('disabled', 'disabled');
                    }
                })
            } else {
                $('#' + elchild).val(1);
            }
        } else if (pilihan === 0 && selected === "1") {
            if (confirm('Ambil Poin Pertanyaan ini ?')) {
                let el = document.querySelectorAll('.upload_' + elparent);
                [].forEach.call(el, function(elem) {
                    elem.classList.remove('d-none');
                });
                ambilpoin(id_permohonan, id_sub, id_sub_sub, elpoin);
                // let poinelement = document.getElementById('poin_'+elparent);
                // poinelement.innerHTML = elpoin;
            } else {
                $('#' + elparent).val(0);
            }
        } else if ((pilihan === 0 && selected === "0") || selected === "0") {
            if (confirm('Hapus Poin Pertanyaan ini ?')) {
                let el = document.querySelectorAll('.upload_' + elparent);
                [].forEach.call(el, function(elem) {
                    elem.classList.add('d-none');
                });
                // let poinelement = document.getElementById('poin_'+elparent);
                // poinelement.innerHTML = 0;
            } else {
                $('#' + elparent).val(1);
            }
        }
    }

    function ambilpoin(id_permohonan, id_sub, id_sub_sub, poin_diajukan)
    {
        let fd = new FormData();
        fd.append('id_permohonan_ambil', id_permohonan);
        fd.append('id_sub_ambil', id_sub);
        fd.append('id_sub_sub_ambil', id_sub_sub);
        fd.append('poin_diajukan', poin_diajukan);
        
        $.ajax({
            type:'post',
            dataTyoe:'json',
            data:fd,
            processData: false,
            contentType: false,
            url: '<?= base_url()?>Bgh/BangunanGedung/BangunanBaru/ambilpoin',
            success:function(response)
            {
                alert('berhasil');
            }
        })
    }

    function saveuploadmain() {

    }

    function openmodal(id_dokumen, poin_diajukan, id_sub, id_sub_sub, head) {
        $('#id_dokumen').val(id_dokumen);
        $('#poin_diajukan').val(poin_diajukan);
        $('#id_sub').val(id_sub);
        $('#id_sub_sub').val(id_sub_sub);
        $('#head').val(head);
        var myModal = new bootstrap.Modal(document.getElementById('modal-small'), {
            keyboard: false,
            backdrop: false
        })
        myModal.show();
    }

    function uploading(formdata) {

        $.ajax({
            type: 'post',
            dataType: 'json',
            data: formdata,
            processData: false,
            contentType: false,
            url: "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/uploading",
            beforeSend: function() {
                $('#loaderupload').removeClass('d-none');
            },
            success: function(response) {
                $('#loaderupload').addClass('d-none');
                if (response.code === 1) {
                    window.location.href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/penilaian/<?= $permohonan->kode_bgh ?>?accord="+response.accord;
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        })
    }

    function validateFileExtension(fileName) {
        var allowedExtensions = ['pdf', 'xlx', 'xlsx', 'jpg', 'png'];
        var fileExtension = fileName.split('.').pop().toLowerCase();
        return allowedExtensions.indexOf(fileExtension) > -1;
    }
</script>

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
        <div class="card">
            <div class="card-header">
                <h4>Tahap Perencanaan | Poin Diajukan Keseluruhan : <?= $poinhead ?></h4>
                <?php if (isset($permohonan)) { ?>
                    <input type="text" id="id_permohonan_global" value="<?= $permohonan->id ?>" hidden>
                <?php } ?>
            </div>
            <div class="card-body">
                <div class="accordion" id="accordion-example">
                    <?php
                    // print_r($checklist);
                    for ($i = 0; $i < count($checklist); $i++) {
                        $alp = range('A', 'Z');
                        $poindiajukan = $checklist[$i]['poindiajukan'];
                    ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header " id="heading-<?= $checklist[$i]['id'] ?>">
                                <button class="accordion-button <?= ($i > 0) ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $checklist[$i]['id'] ?>" aria-expanded="true">
                                    <strong><?= $alp[$i] . '. ' . $checklist[$i]['nama'] ?> | Poin Tersedia : <?= $checklist[$i]['poin'] ?> | Poin Diajukan : <?= $poindiajukan ?> </strong>
                                </button>
                            </h2>
                            <div id="collapse-<?= $checklist[$i]['id'] ?>" class="accordion-collapse collapse <?php if(isset($_GET['accord'])){ if($_GET['accord'] == $alp[$i]){ echo 'show'; } } ?>" data-bs-parent="#accordion-example">
                                <div class="accordion-body pt-0">
                                    <?php 
                                        for ($j = 0; $j < count($checklist[$i]['main']); $j++) { 
                                            $namamain = $checklist[$i]['main'][$j]['nama'];
                                            $poinmain = $checklist[$i]['main'][$j]['poin'];
                                    ?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tr class="table-active">
                                                    <td width="3%"><?= ($j + 1) . '.' ?></td>
                                                    <td width="17%"><?= $namamain ?></td>
                                                    <td width="4%" class="text-center"><?= $poinmain ?></td>
                                                    <td width="5%">Claim Poin</td>
                                                    <td width="30%">Dokumen Pembuktian</td>
                                                    <td width="3%">Poin Diajukan</td>
                                                    <td width="13%">Kesesuaian Dokumen</td>
                                                    <td width="15%">Catatan</td>
                                                    <td width="2%">Assesment Poin</td>
                                                </tr>
                                                <?php
                                                for ($k = 0; $k < count($checklist[$i]['main'][$j]['sub']); $k++) {
                                                    $alphabet = range('a', 'z');
                                                    $pilihansub = $checklist[$i]['main'][$j]['sub'][$k]['pilihan'];
                                                    $dokumensub = $checklist[$i]['main'][$j]['sub'][$k]['dokumen'];
                                                    $idsub = $checklist[$i]['main'][$j]['sub'][$k]['id'];
                                                    $namasub = $checklist[$i]['main'][$j]['sub'][$k]['nama'];
                                                    $elparent = $alp[$i] . '_' . $alphabet[$k] . '' . $checklist[$i]['main'][$j]['sub'][$k]['id'];
                                                    $poinsub = $checklist[$i]['main'][$j]['sub'][$k]['poin'];
                                                    $poinambilsub = $checklist[$i]['main'][$j]['sub'][$k]['poinambil'];
                                                    $ambilsub = $checklist[$i]['main'][$j]['sub'][$k]['ambil'];
                                                    if ($pilihansub == 1) {
                                                        $terpilihsub = $checklist[$i]['main'][$j]['sub'][$k]['terpilih'];
                                                    }
                                                    if ($dokumensub == 1) {
                                                ?>
                                                        <tr>
                                                            <td></td>
                                                            <td><?= $namasub ?></td>
                                                            <td class="text-center"><?= $poinsub ?></td>
                                                            <td>
                                                                <strong>
                                                                <?php 
                                                                    if($ambilsub == 1){
                                                                        echo "Ambil";
                                                                    }else{
                                                                        echo "Tidak";
                                                                    }
                                                                ?>
                                                                </strong>
                                                            </td>
                                                            <td>
                                                                <table class="table table-borderless p-0">
                                                                    <thead>
                                                                        <th>No.</th>
                                                                        <th>Dokumen</th>
                                                                        <th>File</th>
                                                                    </thead>
                                                                    <?php 
                                                                        for ($o = 0; $o < count($checklist[$i]['main'][$j]['sub'][$k]['dok']); $o++) {
                                                                            $namadok = $checklist[$i]['main'][$j]['sub'][$k]['dok'][$o]['nama'];
                                                                            $iddok = $checklist[$i]['main'][$j]['sub'][$k]['dok'][$o]['id'];
                                                                            $isuploaddok = $checklist[$i]['main'][$j]['sub'][$k]['dok'][$o]['isupload'];
                                                                    ?>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="ps-3"><?= ($o + 1) . ". " ?></td>
                                                                                <td><?= $namadok ?></td>
                                                                                <td class="text-center align-middle <?= 'upload_' . $elparent ?> <?= $ambilsub == 1 ? '':'d-none' ?>">
                                                                                    <?php 
                                                                                        if($isuploaddok == 1){ 
                                                                                            $path = $checklist[$i]['main'][$j]['sub'][$k]['dok'][$o]['path'];
                                                                                            $extension = $checklist[$i]['main'][$j]['sub'][$k]['dok'][$o]['extension'];
                                                                                        ?>
                                                                                        <button class="btn btn-success btn-sm" onclick="openmodalfile('<?= $path ?>', '<?= $extension ?>')" title="Lihat Dokumen">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                                                        </svg>
                                                                                    </button>
                                                                                    <?php } ?>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    <?php } ?>
                                                                </table>
                                                            </td>
                                                            <td class="text-center" id="<?= 'poin_' . $elparent ?>"><?= $poinambilsub ?></td>
                                                            <td>
                                                                <table class="table table-bordered">
                                                                <?php 
                                                                    for ($o = 0; $o < count($checklist[$i]['main'][$j]['sub'][$k]['dok']); $o++) {
                                                                        $isuploaddok = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$o]['isupload'];

                                                                        if ($isuploaddok == 1) {
                                                                ?>
                                                                            <tr>
                                                                                <td><select name="" id="" class="form-select">
                                                                                <option value="1">Sesuai</option>
                                                                                <option value="0">Tidak Sesuai</option>
                                                                            </select></td>
                                                                            </tr>
                                                                <?php    
                                                                        }
                                                                    } ?>
                                                                </table>
                                                            </td>
                                                            <td></td>
                                                            <td>0</td>
                                                        </tr>
                                                    <?php } else { ?>
                                                        <tr>
                                                            <td></td>
                                                            <td><?= $namasub ?></td>
                                                            <td><?= $poinsub ?></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <?php $jmlsubsub = count($checklist[$i]['main'][$j]['sub'][$k]['subsub']);
                                                        for ($l = 0; $l < $jmlsubsub; $l++) {
                                                            $elparent = $alp[$i] . '_' . $alphabet[$k] . '' . $checklist[$i]['main'][$j]['sub'][$k]['id'];
                                                            $elchild = $alp[$i] . '_' . $alphabet[$k] . '' . $checklist[$i]['main'][$j]['sub'][$k]['id'] . '_' . $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['id'];
                                                            $idsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['id'];
                                                            $namasubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['nama'];
                                                            $poinsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['poin'];
                                                            $ambilsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['ambil'];
                                                            $poinambilsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['poinambil'];
                                                        ?>

                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <table class="table table-borderless p-0">
                                                                        <tr>
                                                                            <!-- <td class="ps-3"><?= ($l + 1) . ". " ?></td> -->
                                                                            <td><?= $namasubsub ?></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td class="text-center"><?= $poinsubsub ?></td>
                                                                <td>
                                                                    <strong>
                                                                        <?php 
                                                                            if($ambilsubsub == 1){
                                                                                echo "Ambil";
                                                                            }else{
                                                                                echo "Tidak";
                                                                            }
                                                                        ?>
                                                                    </strong>
                                                                </td>
                                                                <td>
                                                                    <table class="table table-borderless">
                                                                        <thead>
                                                                            <th>No.</th>
                                                                            <th>Dokumen</th>
                                                                            <th>File</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php 
                                                                                for ($o = 0; $o < count($checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok']); $o++) {
                                                                                    $namadok =  $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok'][$o]['nama'];
                                                                                    $isuploaddok = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok'][$o]['isupload'];
                                                                                    $iddok = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok'][$o]['id'];
                                                                            ?>
                                                                                <tr>
                                                                                    <td><?= ($o + 1) . '.' ?></td>
                                                                                    <td>
                                                                                        <?= $namadok ?>
                                                                                    </td>
                                                                                    <td class="text-center align-middle <?= $elchild ?> <?= ($ambilsubsub == 0) ? 'd-none' : '' ?>">
                                                                                    <?php 
                                                                                        if($isuploaddok == 1){ 
                                                                                            $path = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok'][$o]['path'];
                                                                                            $extension = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok'][$o]['extension'];
                                                                                    ?>
                                                                                        
                                                                                        <button class="btn btn-success btn-sm" onclick="openmodalfile('<?= $path ?>', '<?= $extension ?>')" title="Lihat Dokumen">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                                                            </svg>
                                                                                        </button>
                                                                                    <!-- <?php }else{ ?>
                                                                                        <button class="btn btn-success btn-sm" onclick="openmodal(<?= $iddok ?>, <?= $poinsubsub ?>, 0, <?= $idsubsub?>,'<?= $alp[$i] ?>')" title="Upload" data-id="<?= $iddok ?>">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                                                <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                                                                            </svg>
                                                                                        </button> -->
                                                                                    <?php } ?> 
                                                                                    </td>
                                                                                    <!-- <td> -->
                                                                                    <!-- <input type="file"> -->
                                                                                    <!-- </td> -->
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td class="text-center" id="<?= 'poin_' . $elchild ?>"><?= $poinambilsubsub ?></td>
                                                                <td>
                                                                <?php 
                                                                    for ($o = 0; $o < count($checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok']); $o++) {
                                                                        $isuploaddok = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok'][$o]['isupload'];

                                                                        if ($ambilsubsub == 1) {
                                                                ?>
                                                                            <select name="" id="" class="form-select">
                                                                                <option value="1">Sesuai</option>
                                                                                <option value="0">Tidak Sesuai</option>
                                                                            </select>
                                                                <?php    
                                                                        }
                                                                    } ?>
                                                                </td>
                                                                <td></td>
                                                                <td class="text-center">0</td>

                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-small" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <label for="" class="form-label">Upload File</label>
                <input type="file" class="form-control" id="fileinput">
                <div class="invalid-feedback" id="invalid-feedback">Belum ada File</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancel</button>
                <input type="text" id="id_permohonan" value="<?= (isset($permohonan) ? $permohonan->id : '') ?>" hidden>
                <input type="text" id="id_dokumen" hidden>
                <input type="text" id="poin_diajukan" hidden>
                <input type="text" id="id_sub" hidden>
                <input type="text" id="id_sub_sub" hidden>
                <input type="text" id="head" hidden>
                <button type="button" id="subm" class="btn btn-success">Upload
                    <div class="spinner-border spinner-border-sm text-white d-none ms-3" id="loaderupload" role="status"></div>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyview">
      </div>
    </div>
  </div>
</div>
<!-- Endmodal -->

<script src="<?= base_url() ?>assets/bgh/dist/libs/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
<script src="<?= base_url() ?>assets/bgh/dist/libs/DataTables-1.13.4/js/datatables.min.js"></script>

<script>
    $(() => {
        $('#menu-bangunan').addClass('active');

        $('#fileinput').change(function() {
            $('#fileinput').removeClass('is-invalid');
        })
        $('#subm').click(function() {

            let fileinput = $('#fileinput');

            if (!fileinput.val()) {
                fileinput.addClass('is-invalid');
            } else {
                console.log(fileinput);
                console.log(fileinput.val());
                let file = fileinput[0].files[0]

                if (!validateFileExtension(file.name)) {
                    fileinput.addClass('is-invalid');
                    $('#invalid-feedback').html('Error, Pastikan Ekstensi File Anda .pdf, .xlx, .xlsx, .jpg, .png');
                    return;
                }

                var formData = new FormData();
                formData.append('file', file);
                formData.append('id_permohonan', $('#id_permohonan').val());
                formData.append('id_dokumen', $('#id_dokumen').val());
                formData.append('id_sub', $('#id_sub').val());
                formData.append('id_sub_sub', $('#id_sub_sub').val());
                formData.append('head', $('#head').val());
                uploading(formData);
            }
        });

        // $('#subm').click(function(){
        //     $('#loaderupload').removeClass('d-none');
        // })
    })

    function claimpoin(elparent, elchild, pilihan, event, elpoin) {
        let selectelement = event.target;
        let selected = selectelement.value;
        if (pilihan === 1 && selected === "1") {
            if (confirm('Ambil Poin Pertanyaan ini ?')) {
                let el = document.querySelectorAll('.' + elchild);
                let idel = elchild.substr(0, 4);
                [].forEach.call(el, function(elem) {
                    elem.classList.remove('d-none');
                });
                // let poinelement = document.getElementById('poin_'+elchild);
                // poinelement.innerHTML = elpoin;
                let parent = document.querySelectorAll('.' + elparent);
                [].forEach.call(parent, function(e) {
                    let elementid = e.getAttribute("id");
                    if (elementid !== elchild) {
                        e.setAttribute('disabled', 'disabled');
                    }
                })
            } else {
                $('#' + elchild).val(0);
            }

        } else if (pilihan === 1 && selected === "0") {
            if (confirm('Hapus Poin Pertanyaan ini ?')) {
                let el = document.querySelectorAll('.' + elchild);
                [].forEach.call(el, function(elem) {
                    elem.classList.add('d-none');
                })

                // let poinelement = document.getElementById('poin_'+elchild);
                // poinelement.innerHTML = 0;

                let parent = document.querySelectorAll('.' + elparent);
                [].forEach.call(parent, function(e) {
                    let elementid = e.getAttribute("id");
                    if (elementid !== elchild) {
                        e.removeAttribute('disabled', 'disabled');
                    }
                })
            } else {
                $('#' + elchild).val(1);
            }
        } else if (pilihan === 0 && selected === "1") {
            if (confirm('Ambil Poin Pertanyaan ini ?')) {
                let el = document.querySelectorAll('.upload_' + elparent);
                [].forEach.call(el, function(elem) {
                    elem.classList.remove('d-none');
                });
                // let poinelement = document.getElementById('poin_'+elparent);
                // poinelement.innerHTML = elpoin;
            } else {
                $('#' + elparent).val(0);
            }
        } else if ((pilihan === 0 && selected === "0") || selected === "0") {
            if (confirm('Hapus Poin Pertanyaan ini ?')) {
                let el = document.querySelectorAll('.upload_' + elparent);
                [].forEach.call(el, function(elem) {
                    elem.classList.add('d-none');
                });
                // let poinelement = document.getElementById('poin_'+elparent);
                // poinelement.innerHTML = 0;
            } else {
                $('#' + elparent).val(1);
            }
        }
    }

    function saveuploadmain() {

    }

    function openmodal(id_dokumen, poin_diajukan, id_sub, id_sub_sub, head) {
        $('#id_dokumen').val(id_dokumen);
        $('#poin_diajukan').val(poin_diajukan);
        $('#id_sub').val(id_sub);
        $('#id_sub_sub').val(id_sub_sub);
        $('#head').val(head);
        var myModal = new bootstrap.Modal(document.getElementById('modal-small'), {
            keyboard: false,
            backdrop: false
        })
        myModal.show();
    }

    function openmodalfile(path, extension)
    {
        var modals = new bootstrap.Modal(document.getElementById('pdfModal'), {
            keyboard: false,
            backdrop: false
        })

        let html ="";
        path = path.substr(2);
        if(extension == "pdf"){
            html += `<embed id="pathview" src="<?= base_url() ?>${path}" width="100%" height="500" type="application/pdf">`;
        }else if(extension == "jpg" || extension == "png"){
            html += `<img class="img-fluid" src="<?= base_url()?>${path}">`;
        }else{
            html += `<h3> File Telah Terunduh </h3><iframe src="<?= base_url() ?>${path}" width="100%" height="500"></iframe>`;
        }
        $('#bodyview').html(html);
        modals.show();
    }


    function uploading(formdata) {

        $.ajax({
            type: 'post',
            dataType: 'json',
            data: formdata,
            processData: false,
            contentType: false,
            url: "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/uploading",
            beforeSend: function() {
                $('#loaderupload').removeClass('d-none');
            },
            success: function(response) {
                $('#loaderupload').addClass('d-none');
                if (response.code === 1) {
                    window.location.href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/penilaian/<?= $permohonan->kode_bgh ?>?accord="+response.accord;
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        })
    }

    function validateFileExtension(fileName) {
        var allowedExtensions = ['pdf', 'xlx', 'xlsx', 'jpg', 'png'];
        var fileExtension = fileName.split('.').pop().toLowerCase();
        return allowedExtensions.indexOf(fileExtension) > -1;
    }
</script>