<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col-8">
                <h2 class="page-title">
                    Assesment Kinerja BGH
                </h2>
            </div>
            <div class="col-4">
                <?php
                if ($verifikasi == $countambil && $permohonan->status == 31) {
                ?>
                    <button class="btn btn-success float-end" id="btn-selesai" onclick="selesai(<?= $permohonan->id ?>,<?= $tidak_lengkap ?> )">
                        <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                        </svg>
                        Selesaikan Assesment
                    </button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">

        <div class="row row-cards mb-3">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <ul class="steps steps-green steps-counter my-4">
                            <li class="step-item">Pengisian Formulir Data Bangunan & Data Pemilik</li>
                            <li class="step-item">Pengisian Daftar Simak</li>
                            <li class="step-item active">Proses Verifikasi Kelengkapan Dokumen</li>
                            <li class="step-item">Proses Assesment Oleh TPA/TPT</li>
                            <li class="step-item">Proses Penerbitan Sertifikat/Banding (Apabila diajukan)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards mb-3">

            <div class="col-md-6 col-xl-6">
                <div class="card card-sm bg-success text-white">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-patch-exclamation-fill" viewBox="0 0 16 16">
                                    <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                            </div>
                            <div class="col">
                                <div class="fw-bold">
                                    <?= $permohonan->poin_diajukan ?> Poin
                                </div>
                                <div class="text-white">
                                    Jumlah Poin Yang Diajukan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Tahap Perencanaan</h4>
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
                            <div id="collapse-<?= $checklist[$i]['id'] ?>" class="accordion-collapse collapse 
                            <?php if (isset($_GET['accord'])) {
                                if ($_GET['accord'] == $alp[$i]) {
                                    echo 'show';
                                }
                            } ?>" data-bs-parent="#accordion-example">
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
                                                    <td width="20%">Dokumen Pembuktian</td>
                                                    <td width="5%">File</td>
                                                    <td width="2%">Poin Diajukan</td>
                                                    <td width="10%">Kelengkapan Dokumen</td>
                                                    <td width="5%">Catatan</td>
                                                </tr>
                                                <?php
                                                for ($k = 0; $k < count($checklist[$i]['main'][$j]['sub']); $k++) {
                                                    $alphabet = range('a', 'z');
                                                    $ambilsub = $checklist[$i]['main'][$j]['sub'][$k]['ambil'];
                                                    $pilihansub = $checklist[$i]['main'][$j]['sub'][$k]['pilihan'];
                                                    $dokumensub = $checklist[$i]['main'][$j]['sub'][$k]['dokumen'];
                                                    $idsub = $checklist[$i]['main'][$j]['sub'][$k]['id'];
                                                    $namasub = $checklist[$i]['main'][$j]['sub'][$k]['nama'];
                                                    $elparent = $alp[$i] . '_' . $alphabet[$k] . '' . $checklist[$i]['main'][$j]['sub'][$k]['id'];
                                                    $poinsub = $checklist[$i]['main'][$j]['sub'][$k]['poin'];
                                                    $poindiajukansub = $checklist[$i]['main'][$j]['sub'][$k]['poin_diajukan'];
                                                    $poinassesmentsub = $checklist[$i]['main'][$j]['sub'][$k]['poin_assesment'];
                                                    $allassesmentsub = $checklist[$i]['main'][$j]['sub'][$k]['allassesment'];
                                                    $poinambilsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['poinambil'];
                                                    $idambilsub = $checklist[$i]['main'][$j]['sub'][$k]['id_ambil'];
                                                    $tidaksesuaisub = $checklist[$i]['main'][$j]['sub'][$k]['tidaksesuai'];
                                                    $belumassessub = $checklist[$i]['main'][$j]['sub'][$k]['belumasses'];
                                                    $catatansub = $checklist[$i]['main'][$j]['sub'][$k]['catatan'];
                                                    $lengkapsub = $checklist[$i]['main'][$j]['sub'][$k]['lengkap'];
                                                    $isallfilesub = $checklist[$i]['main'][$j]['sub'][$k]['isallfile'];
                                                    if ($dokumensub == 1) {
                                                        $dok = $checklist[$i]['main'][$j]['sub'][$k]['dok'];
                                                ?>
                                                        <tr>
                                                            <td rowspan="<?= count($checklist[$i]['main'][$j]['sub'][$k]['dok']) ?>"></td>
                                                            <td rowspan="<?= count($checklist[$i]['main'][$j]['sub'][$k]['dok']) ?>"><?= $namasub ?></td>
                                                            <td class="text-center" rowspan="<?= count($checklist[$i]['main'][$j]['sub'][$k]['dok']) ?>"><?= $poinsub ?></td>
                                                            <td rowspan="<?= count($checklist[$i]['main'][$j]['sub'][$k]['dok']) ?>">
                                                                <?php
                                                                if ($ambilsub == 1) {
                                                                    echo "<strong> Ambil </strong>";
                                                                } else {
                                                                    echo "<strong> Tidak </strong>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <?php $o = 0; ?>
                                                            <td>
                                                                <?= $dok[$o]['nama'] ?>
                                                            </td>
                                                            <?php
                                                            if ($ambilsub == 0) {
                                                                echo "<td></td>";
                                                            } else {
                                                            ?>
                                                                <td class="text-center align-middle <?= 'upload_' . $elparent ?> <?= $ambilsub == 1 ? '' : 'd-none' ?>">
                                                                    <?php
                                                                    if ($dok[$o]['isupload'] == 1) {
                                                                        $path = $dok[$o]['path'];
                                                                        $extension = $dok[$o]['extension'];

                                                                    ?>
                                                                        <button class="btn btn-success btn-sm" onclick="openmodalfile('<?= $path ?>', '<?= $extension ?>')" title="Upload">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                                            </svg>
                                                                        </button>
                                                                    <?php } else { ?>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                                                        </svg>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php } ?>
                                                            <td rowspan="<?= count($dok) ?>" class="text-center" id="<?= 'poin_' . $elparent ?>"><?= $isallfilesub == 1 ? $poindiajukansub : 0 ?></td>
                                                            <?php
                                                            if ($dok[$o]['isupload'] == 1) {
                                                                $idfilesub = $dok[$o]['id_file'];
                                                                $sesuaisub = $dok[$o]['lengkap'];

                                                                if ($permohonan->status == 31) {
                                                            ?>
                                                                    <td rowspan="<?= count($checklist[$i]['main'][$j]['sub'][$k]['dok']) ?>">
                                                                        <select class="form-select" id="lengkap_<?= $elparent ?>" onchange="lengkap(<?= $lengkapsub ?>,'<?= $elparent ?>', event, <?= $idambilsub ?>,'<?= $alp[$i] ?>')">
                                                                            <option value="0">Verifikasi</option>
                                                                            <option value="2" <?= $lengkapsub == 2 ? 'selected' : '' ?>>Tidak</option>
                                                                            <option value="1" <?= $lengkapsub == 1 ? 'selected' : '' ?>>Lengkap</option>
                                                                        </select>
                                                                    </td>
                                                                    <td rowspan="<?= count($checklist[$i]['main'][$j]['sub'][$k]['dok']) ?>">
                                                                        <?php if ($lengkapsub == 2 && $catatansub == "") { ?>
                                                                            <button class="btn btn-success btn-sm" onclick="catatan('<?= $elprent ?>', <?= $idambilsub ?>,'<?= $alp[$i] ?>')">Catatan</button>
                                                                        <?php } else if ($lengkapsub == 2 && $catatansub != "") { ?>
                                                                            <a href="javacript:;" class="btn btn-success btn-sm" onclick="catatan('<?= $elparent ?>', <?= $idambilsub ?>,'<?= $alp[$i] ?>','<?= htmlspecialchars($catatansub) ?>')" title="Edit Catatan">Lihat/edit Catatan</a>
                                                                        <?php } ?>
                                                                    </td>
                                                                <?php
                                                                } else if ($permohonan->status == 32 || $permohonan->status == 33 || $permohonan->status == 4) {
                                                                ?>
                                                                    <td rowspan="<?= count($dok) ?>">
                                                                        <?php
                                                                        if ($lengkapsub == 1) {
                                                                            echo "<strong>Lengkap</strong>";
                                                                        } else if ($lengkapsub == 2) {
                                                                            echo "<strong>Tidak Lengkap</strong>";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td rowspan="<?= count($dok) ?>">
                                                                        <?php
                                                                        if ($catatansub != "") {
                                                                        ?>
                                                                            <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="lihatcatatan('<?= htmlspecialchars($catatansub) ?>')">Lihat Catatan</a>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                <?php
                                                                }
                                                                ?>

                                                            <?php
                                                            } else {
                                                                echo "<td rowspan='" . count($checklist[$i]['main'][$j]['sub'][$k]['dok']) . "'></td>";
                                                                echo "<td rowspan='" . count($checklist[$i]['main'][$j]['sub'][$k]['dok']) . "'></td>";
                                                            }
                                                            $o++;
                                                            ?>
                                                        </tr>
                                                        <?php
                                                        for ($o; $o < count($dok); $o++) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $dok[$o]['nama'] ?></td>
                                                                <?php
                                                                if ($ambilsub == 0) {
                                                                    echo "<td></td>";
                                                                } else {

                                                                ?>
                                                                    <td class="text-center align-middle <?= 'upload_' . $elparent ?> <?= $ambilsub == 1 ? '' : 'd-none' ?>">
                                                                        <?php
                                                                        if ($dok[$o]['isupload'] == 1) {
                                                                            $path = $dok[$o]['path'];
                                                                            $extension = $dok[$o]['extension'];
                                                                        ?>
                                                                            <button class="btn btn-success btn-sm" onclick="openmodalfile('<?= $path ?>', '<?= $extension ?>')" title="Upload">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                                                </svg>
                                                                            </button>
                                                                        <?php } else { ?>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                                                            </svg>
                                                                        <?php } ?>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
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
                                                            $idambilsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['id_ambil'];
                                                            $namasubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['nama'];
                                                            $poinsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['poin'];
                                                            $ambilsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['ambil'];
                                                            $poindiajukansubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['poin_diajukan'];
                                                            $poinambilsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['poinambil'];
                                                            $poinassesmentsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['poin_assesment'];
                                                            $allassesmentsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['allassesment'];
                                                            $dok = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok'];
                                                            $tidaksesuaisubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['tidaksesuai'];
                                                            $belumassessubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['belumasses'];
                                                            $catatansubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['catatan'];
                                                            $lengkapsubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['lengkap'];
                                                            $isallfilesubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['isallfile'];
                                                        ?>

                                                            <tr>
                                                                <td rowspan="<?= count($dok) ?>"></td>
                                                                <td rowspan="<?= count($dok) ?>"><?= $namasubsub ?></td>
                                                                <td rowspan="<?= count($dok) ?>" class="text-center"><?= $poinsubsub ?></td>
                                                                <td rowspan="<?= count($dok) ?>">
                                                                    <?php
                                                                    if ($ambilsubsub == 1) {
                                                                        echo "<strong> Ambil </strong>";
                                                                    } else {
                                                                        echo "<strong> Tidak </strong>";
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <?php $o = 0; ?>
                                                                <td>
                                                                    <?= $dok[$o]['nama'] ?>
                                                                </td>
                                                                <?php
                                                                if ($ambilsubsub == 0) {
                                                                    echo "<td></td>";
                                                                } else {
                                                                ?>
                                                                    <td class="text-center align-middle <?= 'upload_' . $elparent ?> ">
                                                                        <?php if ($dok[$o]['isupload'] == 1) {
                                                                            $path = $dok[$o]['path'];
                                                                            $extension = $dok[$o]['extension'];
                                                                        ?>
                                                                            <button class="btn btn-success btn-sm" onclick="openmodalfile('<?= $path ?>', '<?= $extension ?>')" title="Upload">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                                                </svg>
                                                                            </button>
                                                                        <?php } else { ?>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                                                            </svg>
                                                                        <?php } ?>
                                                                    </td>
                                                                <?php } ?>
                                                                <td rowspan="<?= count($dok) ?>" class="text-center" id="<?= 'poin_' . $elchild ?>"><?= $isallfilesubsub == 1 ? $poindiajukansubsub : 0 ?></td>
                                                                <?php
                                                                if ($dok[$o]['isupload'] == 1) {
                                                                    $idfilesubsub = $dok[$o]['id_file'];
                                                                    $sesuaisubsub = $dok[$o]['sesuai'];
                                                                    if ($permohonan->status == 31) {
                                                                ?>
                                                                        <td rowspan="<?= count($dok) ?>">
                                                                            <select class="form-select" id="lengkap_<?= $elchild ?>" onchange="lengkap(<?= $lengkapsubsub ?>,'<?= $elchild ?>', event, <?= $idambilsubsub ?>,'<?= $alp[$i] ?>')">
                                                                                <option value="0">Verifikasi</option>
                                                                                <option value="2" <?= $lengkapsubsub == 2 ? 'selected' : '' ?>>Tidak</option>
                                                                                <option value="1" <?= $lengkapsubsub == 1 ? 'selected' : '' ?>>Lengkap</option>
                                                                            </select>
                                                                        </td>
                                                                        <td rowspan="<?= count($dok) ?>">
                                                                            <?php if ($lengkapsubsub == 2 && $catatansubsub == "") { ?>
                                                                                <button class="btn btn-success btn-sm" onclick="catatan('<?= $elchild ?>', <?= $idambilsubsub ?>,'<?= $alp[$i] ?>')">Catatan</button>
                                                                            <?php } else if ($lengkapsubsub == 2 && $catatansubsub != "") { ?>
                                                                                <a href="javacript:;" class="btn btn-success btn-sm" onclick="catatan('<?= $elchild ?>', <?= $idambilsubsub ?>,'<?= $alp[$i] ?>','<?= htmlspecialchars($catatansubsub) ?>')" title="Edit Catatan">Lihat/edit Catatan</a>
                                                                            <?php } ?>
                                                                        </td>
                                                                    <?php
                                                                    } else if ($permohonan->status == 32 || $permohonan->status == 33 || $permohonan->status == 4) {
                                                                    ?>
                                                                        <td rowspan="<?= count($dok) ?>">
                                                                            <?php
                                                                            if ($lengkapsubsub == 1) {
                                                                                echo "<strong>Lengkap</strong>";
                                                                            } else if ($lengkapsubsub == 2) {
                                                                                echo "<strong>Tidak Lengkap</strong>";
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td rowspan="<?= count($dok) ?>">
                                                                            <?php
                                                                            if ($catatansubsub != "") {
                                                                            ?>
                                                                                <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="lihatcatatan('<?= htmlspecialchars($catatansubsub) ?>')">Lihat Catatan</a>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                <?php
                                                                } else {
                                                                    echo "<td rowspan='" . count($dok) . "'></td>";
                                                                    echo "<td rowspan='" . count($dok) . "'></td>";
                                                                }
                                                                $o++;
                                                                ?>
                                                            </tr>
                                                            <?php
                                                            for ($o; $o < count($dok); $o++) {
                                                            ?>
                                                                <tr>
                                                                    <td><?= $dok[$o]['nama'] ?></td>
                                                                    <?php
                                                                    if ($ambilsubsub == 0) {
                                                                        echo "<td></td>";
                                                                    } else {
                                                                    ?>
                                                                        <td class="text-center align-middle <?= 'upload_' . $elparent ?> <?= $ambilsubsub == 1 ? '' : 'd-none' ?>">
                                                                            <?php if ($dok[$o]['isupload'] == 1) {
                                                                                $path = $dok[$o]['path'];
                                                                                $extension = $dok[$o]['extension'];

                                                                            ?>
                                                                                <button class="btn btn-success btn-sm" onclick="openmodalfile('<?= $path ?>', '<?= $extension ?>')" title="Upload">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                                                    </svg>
                                                                                </button>
                                                                            <?php } else { ?>
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                                                                </svg>
                                                                            <?php } ?>
                                                                        </td>
                                                                    <?php } ?>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
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

<!-- Modal -->
<div class="modal modal-blur fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">File Viewer</h5>
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
<!-- Modal -->
<div class="modal modal-blur fade" id="modal-catatan" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Berikan Catatan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="bodyview">
                <textarea id="catatan" class="form-control summernote"></textarea>
            </div>
            <div class="modal-footer">
                <input type="text" id="id_ambil_catatan" hidden>
                <button type="button" id="simpancatatan" class="btn btn-success">Simpan
                    <div class="spinner-border spinner-border-sm text-white d-none ms-3" id="loaderupload" role="status"></div>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Endmodal -->
<div class="modal modal-blur fade" id="modal-viewcatatan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Lihat Catatan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="catatan-body">

            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/bgh/dist/libs/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
<script src="<?= base_url() ?>assets/bgh/dist/libs/DataTables-1.13.4/js/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/bgh/dist/libs/summernote/summernote-bs4.min.js" defer></script>
<?php
if (isset($_GET['elnow'])) {
?>
    <script>
        let elementnow = document.getElementById("<?= $_GET['elnow'] ?>");
        elementnow.scrollIntoView();
    </script>
<?php
}
?>


<script>
    $(() => {
        $('#menu-bangunan').addClass('active');

        // let options = {
        //     selector: '#tinymce-mytextarea',
        //     height: 300,
        //     menubar: false,
        //     statusbar: false,
        //     plugins: 'lists image',
        //     toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist | image | removeformat',
        //     content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
        // }
        // if (localStorage.getItem("tablerTheme") === 'dark') {
        //     options.skin = 'oxide-dark';
        //     options.content_css = 'dark';
        // }
        // tinyMCE.init(options);

        $('.summernote').summernote({
            tabsize: 2,
            height: 400,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol']],
                ['insert', ['picture', 'link']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
            ],
            callbacks: {
                onImageUpload: function(files) {
                    // Upload gambar saat dipilih dari file dialog
                    sendFile(files[0]);
                }
            }
        });

        function sendFile(file) {
            var formData = new FormData();
            formData.append("image", file);
            formData.append('idpermohonan', <?= $permohonan->id ?>);

            $.ajax({
                url: "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/uploadimagecatatankelengkapan",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    // Set URL gambar yang diunggah sebagai sumber untuk gambar dalam editor
                    $('.summernote').summernote('insertImage', data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        }


        $('#fileinput').change(function() {
            $('#fileinput').removeClass('is-invalid');
        })

        $('#simpancatatan').click(function() {
            var formData = new FormData();
            formData.append('id_ambil', $('#id_ambil_catatan    ').val());
            formData.append('catatan', $('#catatan').val());
            savecatatan(formData);
        });

        // $('#subm').click(function(){
        //     $('#loaderupload').removeClass('d-none');
        // })
    })

    function lengkap(oldlengkap, el, event, idambil, accord) {
        let elambil = event.target;
        let select = elambil.value;

        if (select == "1") {
            if (confirm('Dokumen Pada Parameter Pertanyaan ini telah Lengkap ?')) {
                updatelengkap(el, 1, idambil, accord);
            } else {
                $('#lengkap_' + el).val(oldlengkap);
            }
        } else {
            if (confirm('Dokumen Pada Parameter Pertanyaan ini Tidak Lengkap ?')) {
                updatelengkap(el, 2, idambil, accord);
            } else {
                $('#lengkap_' + el).val(oldlengkap);
            }
        }
    }

    function updatelengkap(el, lengkap, idambil, accord) {
        let fd = new FormData();
        fd.append('idambil', idambil);
        fd.append('lengkap', lengkap);

        $.ajax({
            type: 'post',
            dataType: 'json',
            data: fd,
            processData: false,
            contentType: false,
            url: "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/updatelengkap",
            success: function(response) {
                window.location.href = "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/kelengkapan/<?= $permohonan->kode_bgh ?>?elnow=lengkap_" + el + "&accord=" + accord;
            }
        })
    }

    function openmodalfile(path, extension) {
        var modals = new bootstrap.Modal(document.getElementById('pdfModal'), {
            keyboard: false,
            backdrop: false
        })

        let html = "";
        path = path.substr(2);
        if (extension == "pdf") {
            html += `<embed id="pathview" src="<?= base_url() ?>${path}" width="100%" height="1000" type="application/pdf">`;
        } else if (extension == "jpg" || extension == "png") {
            html += `<img class="img-fluid" src="<?= base_url() ?>${path}">`;
        } else {
            html += `<h3> File Telah Terunduh </h3><iframe src="<?= base_url() ?>${path}" width="100%" height="1000"></iframe>`;
        }
        $('#bodyview').html(html);
        modals.show();
    }

    function selesai(id_permohonan, tidaklengkap) {
        if (tidaklengkap == 0) {
            if (confirm('Selesaikan Proses Verifikasi Kelengkapan Data ?')) {
                let formdata = new FormData();
                formdata.append('id_permohonan', id_permohonan);
                // formdata.append('presentase', presentase);
                formdata.append('status', 33);
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    url: '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/verifikasikelengkapan',
                    success: function(response) {
                        alert('berhasil');
                        window.location.href = "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/";
                    }
                })
            }
        } else {
            if (confirm('Terdapat Dokumen yang tidak lengkap, Teruskan Ke Pemohon ? ')) {
                let formdata = new FormData();
                formdata.append('id_permohonan', id_permohonan);
                formdata.append('status', 32);
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    url: '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/verifikasikelengkapan',
                    success: function(response) {
                        alert('berhasil');
                        window.location.href = "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/";
                    }
                })
            }
        }
    }

    function catatan(el, idambil, accord, content) {
        $('#id_ambil_catatan').val(idambil);
        var myModal = new bootstrap.Modal(document.getElementById('modal-catatan'), {
            keyboard: false,
            backdrop: false
        })
        myModal.show();
        $('#catatan').summernote('code', content)
    }

    function savecatatan(formdata) {
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: formdata,
            processData: false,
            contentType: false,
            url: "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/savecatatankelengkapan",
            success: function(response) {
                alert('berhasil');
                location.reload();
            }
        })
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

    function lihatcatatan(content) {
        var myModal = new bootstrap.Modal(document.getElementById('modal-viewcatatan'), {
            keyboard: false,
            backdrop: false
        })
        myModal.show();

        $('#catatan-body').html(content);
    }
</script>