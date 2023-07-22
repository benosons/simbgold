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
                <?php if ($permohonan->status == 3 && $this->session->userdata('loc_role_id') == 11) { ?>
                    <button class="btn btn-success float-end" id="btn-selesai" onclick="verifikasi(<?= $permohonan->id ?>, 4)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                        </svg>
                        Verifikasi Hasil Assesment
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
                            <li class="step-item <?= ($permohonan->status == 3 || $permohonan->status == 31 || $permohonan->status == 32 || $permohonan->status == 33) ? 'active' : '' ?>">Proses Verifikasi Kelengkapan Dokumen</li>
                            <li class="step-item <?= ($permohonan->status == 4 || $permohonan->status == 41 || $permohonan->status == 42 || $permohonan->status == 43 || $permohonan->status == 5) ? 'active' : '' ?>">Proses Assesment Oleh TPA/TPT</li>
                            <li class="step-item">Proses Penerbitan Sertifikat/Banding (Apabila diajukan)</li>
                        </ul>
                    </div>
                </div>
                <div class="card card-sm bg-success text-white">
                    <div class="card-body text-center">
                        <h4>
                            Nilai Hasil Asesmen : <strong><?= $hasil_assesment ?> %</strong>
                        </h4>
                        <h4>
                            Peringkat Hasil Asesmen : <h2><strong><?= $ketentuan ?></strong></h2>
                        </h4>
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
            <div class="col-md-6 col-xl-6">
                <div class="card card-sm bg-warning text-white">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-patch-exclamation-fill" viewBox="0 0 16 16">
                                    <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                            </div>
                            <div class="col">
                                <div class="fw-bold">
                                    <?= $poinallassesment ?>
                                </div>
                                <div class="text-white">
                                    Jumlah Poin Hasil Assesment
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
                                    <strong><?= $alp[$i] . '. ' . $checklist[$i]['nama'] ?> | Poin Tersedia : <?= $checklist[$i]['poin'] ?> </strong>
                                </button>
                            </h2>
                            <div id="collapse-<?= $checklist[$i]['id'] ?>" class="accordion-collapse collapse <?php if (isset($_GET['accord'])) {
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
                                                    <td width="8%">Kesesuaian Dokumen</td>
                                                    <td width="12%">Catatan</td>
                                                    <td width="5%">Poin Assesmen</td>
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
                                                    $idambilsub = $checklist[$i]['main'][$j]['sub'][$k]['id_ambil'];
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
                                                            <td rowspan="<?= count($dok) ?>" class="text-center" id="<?= 'poin_' . $elparent ?>"><?= $poindiajukansub ?></td>
                                                            <?php
                                                            if ($dok[$o]['isupload'] == 1) {
                                                                $idfilesub = $dok[$o]['id_file'];
                                                                $sesuaisub = $dok[$o]['sesuai'];
                                                                $catatansub = $dok[$o]['catatan'];
                                                            ?>
                                                                <td>
                                                                    <strong>
                                                                        <?php if ($sesuaisub == 1) {
                                                                            echo "Sesuai";
                                                                        } else if ($sesuaisub == 2) {
                                                                            echo "Tidak";
                                                                        } else if ($sesuaisub == 0) {
                                                                            echo "Tidak Ada Hasil Konsultasi";
                                                                        }
                                                                        ?>
                                                                    </strong>
                                                                </td>
                                                                <td>
                                                                    <?php if ($catatansub == "" || $catatansubsub == 0) {
                                                                        echo ""; ?>
                                                                    <?php } else { ?>
                                                                        <div class="fw-bold">
                                                                            <?= $catatansub ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                                <td rowspan="<?= count($dok) ?>">
                                                                    <?= $poinassesmentsub ?>
                                                                </td>
                                                            <?php
                                                            } else {
                                                                echo "<td></td><td></td><td></td>";
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
                                                                <?php

                                                                }
                                                                if ($dok[$o]['isupload'] == 1) {
                                                                    $idfilesub = $dok[$o]['id_file'];
                                                                    $sesuaisub = $dok[$o]['sesuai'];
                                                                    $catatansub = $dok[$o]['sesuai'];
                                                                ?>
                                                                    <td>
                                                                        <strong>
                                                                            <?php if ($sesuaisub == 1) {
                                                                                echo "Sesuai";
                                                                            } else if ($sesuaisub == 2) {
                                                                                echo "Tidak";
                                                                            } else if ($sesuaisub == 0) {
                                                                                echo "Tidak Ada Hasil Konsultasi";
                                                                            }
                                                                            ?>
                                                                        </strong>
                                                                    </td>
                                                                    <td>
                                                                        <?php if ($catatansub == "" || $catatansubsub == 0) {
                                                                            echo ""; ?>
                                                                        <?php } else { ?>
                                                                            <div class="fw-bold">
                                                                                <?= $catatansub ?>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </td>
                                                                <?php } else {
                                                                    echo "<td></td><td></td><td></td>";
                                                                } ?>
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
                                                                <td rowspan="<?= count($dok) ?>" class="text-center" id="<?= 'poin_' . $elchild ?>"><?= $poindiajukansubsub ?></td>
                                                                <?php
                                                                if ($dok[$o]['isupload'] == 1) {
                                                                    $idfilesubsub = $dok[$o]['id_file'];
                                                                    $sesuaisubsub = $dok[$o]['sesuai'];
                                                                    $catatansubsub = $dok[$o]['catatan'];
                                                                ?>
                                                                    <td class="align-middle">
                                                                        <strong>
                                                                            <?php if ($sesuaisubsub == 1) {
                                                                                echo "Sesuai";
                                                                            } else if ($sesuaisubsub == 2) {
                                                                                echo "Tidak";
                                                                            } else if ($sesuaisubsub == 0) {
                                                                                echo "Tidak Ada Hasil Konsultasi";
                                                                            }
                                                                            ?>
                                                                        </strong>
                                                                    </td>
                                                                    <td>
                                                                        <?php if ($catatansubsub == "" || $catatansubsub == 0) {
                                                                            echo ""; ?>
                                                                        <?php } else { ?>
                                                                            <div class="fw-bold">
                                                                                <?= $catatansubsub ?>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td rowspan="<?= count($dok) ?>">
                                                                        <?= $poinassesmentsubsub ?>
                                                                    </td>
                                                                <?php
                                                                } else {
                                                                    echo "<td></td><td></td><td></td>";
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
                                                                    <?php
                                                                    if ($dok[$o]['isupload'] == 1) {
                                                                        $idfilesubsub = $dok[$o]['id_file'];
                                                                        $sesuaisubsub = $dok[$o]['sesuai'];
                                                                        $catatansubsub = $dok[$o]['catatan'];
                                                                    ?>
                                                                        <td class="align-middle">
                                                                            <strong>
                                                                                <?php if ($sesuaisubsub == 1) {
                                                                                    echo "Sesuai";
                                                                                } else if ($sesuaisubsub2 == 1) {
                                                                                    echo "Tidak";
                                                                                } else if ($sesuaisubsub == 0) {
                                                                                    echo "Tidak Ada Hasil Konsultasi";
                                                                                }
                                                                                ?>
                                                                            </strong>
                                                                        </td>
                                                                        <td>
                                                                            <?php if ($catatansubsub == "" || $catatansubsub == 0) {
                                                                                echo ""; ?>
                                                                            <?php } else { ?>
                                                                                <div class="fw-bold">
                                                                                    <?= $catatansubsub ?>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </td>
                                                                    <?php
                                                                    } else {
                                                                        echo "<td></td><td></td>";
                                                                    }
                                                                    ?>
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

<script src="<?= base_url() ?>assets/bgh/dist/libs/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
<script src="<?= base_url() ?>assets/bgh/dist/libs/DataTables-1.13.4/js/datatables.min.js"></script>
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

    function sesuai(el, event, idfile, accord) {
        let elambil = event.target;
        let select = elambil.value;

        if (select == "1") {
            if (confirm('Dokumen ini telah Sesuai ?')) {
                updatefile(el, select, idfile, accord);
            }
        }
    }

    function updatefile(el, status, idfile, accord) {
        let fd = new FormData();
        fd.append('id_file', idfile);
        fd.append('sesuai', status);

        $.ajax({
            type: 'post',
            dataType: 'json',
            data: fd,
            processData: false,
            contentType: false,
            url: "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/updatefile",
            success: function(response) {
                window.location.href = "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/assesment/<?= $permohonan->kode_bgh ?>?elnow=" + el + "&accord=" + accord;
            }
        })
    }

    function poinassesment(el, idambil, event, accord) {
        let elempoin = event.target;
        let selectpoin = elempoin.value;

        if (confirm('Berikan Assesment Poin Pada Daftar ini ?')) {
            let fdassesment = new FormData();
            fdassesment.append('id_ambil', idambil);
            fdassesment.append('poin', selectpoin);

            $.ajax({
                type: 'post',
                dataType: 'json',
                data: fdassesment,
                processData: false,
                contentType: false,
                url: '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/updateambil',
                success: function(response) {
                    window.location.href = "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/assesment/<?= $permohonan->kode_bgh ?>?elnow=" + el + "&accord=" + accord;
                }
            })
        }
    }

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

    function ambilpoin(id_permohonan, id_sub, id_sub_sub, poin_diajukan) {
        let fd = new FormData();
        fd.append('id_permohonan_ambil', id_permohonan);
        fd.append('id_sub_ambil', id_sub);
        fd.append('id_sub_sub_ambil', id_sub_sub);
        fd.append('poin_diajukan', poin_diajukan);

        $.ajax({
            type: 'post',
            dataTyoe: 'json',
            data: fd,
            processData: false,
            contentType: false,
            url: '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/ambilpoin',
            success: function(response) {
                alert('berhasil');
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

    function verifikasi(id_permohonan, status) {
        if (confirm('Verifikasi dan Terbitkan Sertifikat BGH ?')) {
            let formdata = new FormData();
            formdata.append('id_permohonan', id_permohonan);
            formdata.append('status', status);
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: formdata,
                processData: false,
                contentType: false,
                url: '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/verifikasiassesment',
                success: function(response) {
                    alert('berhasil');
                    window.location.href = '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/';
                }
            })
        }
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
                    window.location.href = "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/penilaian/<?= $permohonan->kode_bgh ?>?accord=" + response.accord;
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