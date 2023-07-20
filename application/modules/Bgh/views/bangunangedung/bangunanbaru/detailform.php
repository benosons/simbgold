<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col-6">
                <h2 class="page-title">
                    Pengisian Daftar Simak
                </h2>
            </div>
            <?php
            if ($permohonan->status == 33 && $this->session->userdata('loc_role_id') == 10) {
            ?>
                <div class="col-6">
                    <button class="btn btn-success ms-2 float-end" id="btn-selesai" onclick="konsultasi(<?= $permohonan->id ?>)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                        </svg>
                        Ajukan Proses Konsultasi
                    </button>
                    <button class="btn btn-primary float-end" id="btn-sidang" onclick="sidang(<?= $permohonan->id ?>, <?= $poinhead ?>)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                        </svg>
                        Ajukkan Sidang
                    </button>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards mb-3">
            <div class="card mb-3">
                <div class="card-body">
                    <ul class="steps steps-green steps-counter my-4">
                        <li class="step-item">Pengisian Formulir Data Bangunan & Data Pemilik</li>
                        <li class="step-item">Pengisian Daftar Simak</li>
                        <li class="step-item <?= ($permohonan->status == 3 || $permohonan->status == 31 || $permohonan->status == 32 || $permohonan->status == 33) ? 'active' : '' ?>">Proses Verifikasi Kelengkapan Dokumen</li>
                        <li class="step-item <?= ($permohonan->status == 4 || $permohonan->status == 41 || $permohonan->status == 42 || $permohonan->status == 43) ? 'active' : '' ?>">Proses Assesment Oleh TPA/TPT</li>
                        <li class="step-item">Proses Penerbitan Sertifikat/Banding (Apabila diajukan)</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-xl-9">
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
                                    <?= $poinhead ?> Poin
                                </div>
                                <div class="text-white">
                                    Jumlah Poin Yang Diajukan
                                </div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-percent" viewBox="0 0 16 16">
                                    <path d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0zM4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                                </svg>
                            </div>
                            <div class="col">
                                <div class="fw-bold">
                                    <?= $hasil_assesment ?> %
                                </div>
                                <div class="text-white">
                                    Jumlah Persentase Poin Yang Diajukan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xl-3">
                <div class="card card-sm bg-success text-white">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="fw-bold">
                                    Ketentuan Peringkat
                                </div>
                                <div class="text-white">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td>I</td>
                                            <td>80% - 100%</td>
                                            <td>
                                                <strong>
                                                    UTAMA
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>II</td>
                                            <td>65% - 79.99%</td>
                                            <td>
                                                <strong>
                                                    MADYA
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>III</td>
                                            <td>45% - 64.99%</td>
                                            <td>
                                                <strong>
                                                    PRATAMA
                                                </strong>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($tidak_sesuai > 0) {
        ?>

            <div class="card bg-info mb-2">
                <div class="card-body text-white">
                    <h4>Dokumen Yang Perlu Direvisi : <?= $tidak_sesuai ?> Dokumen Pembuktian</h4>
                </div>
            </div>
        <?php
        } ?>
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
                                                    <td width="12%">Claim Poin</td>
                                                    <td width="25%">Dokumen Pembuktian</td>
                                                    <td width="5%">Upload</td>
                                                    <td width="3%">Poin Diajukan</td>
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
                                                    $isallfilesub = $checklist[$i]['main'][$j]['sub'][$k]['isallfile'];
                                                    if ($pilihansub == 1) {
                                                        $terpilihsub = $checklist[$i]['main'][$j]['sub'][$k]['terpilih'];
                                                    } else {
                                                        $terpilihsub = 0;
                                                    }
                                                    if ($dokumensub == 1) {
                                                        $dok = $checklist[$i]['main'][$j]['sub'][$k]['dok'];

                                                ?>
                                                        <tr>
                                                            <td rowspan="<?= count($checklist[$i]['main'][$j]['sub'][$k]['dok']) ?>"></td>
                                                            <td rowspan="<?= count($checklist[$i]['main'][$j]['sub'][$k]['dok']) ?>"><?= $namasub ?></td>
                                                            <td class="text-center" rowspan="<?= count($checklist[$i]['main'][$j]['sub'][$k]['dok']) ?>"><?= $poinsub ?></td>
                                                            <td rowspan="<?= count($checklist[$i]['main'][$j]['sub'][$k]['dok']) ?>">
                                                                <?= ($ambilsub == 1) ? 'Ambil' : 'Tidak' ?>
                                                            </td>
                                                            <?php
                                                            $o = 0;
                                                            $iddok = $dok[$o]['id'];
                                                            ?>
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
                                                                        if ($sesuai == 1 || $sesuai == 0) {
                                                                    ?>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                                                            </svg>
                                                                        <?php
                                                                        } else if ($sesuai == 2) {
                                                                        ?>
                                                                            <button class="btn btn-success btn-sm" onclick="openmodal(<?= $iddok ?>, <?= $poinsubsub ?>,0, <?= $idsubsub ?>, '<?= $alp[$i] ?>','<?= $elchild ?>',<?= $idfile ?>)" title="Upload">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                                    <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                                                                </svg>
                                                                            </button>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    <?php } else { ?>
                                                                        <!-- <button class="btn btn-success btn-sm" onclick="openmodal(<?= $iddok ?>, <?= $poinsub ?>,<?= $idsub ?>, 0, '<?= $alp[$i] ?>','<?= $elparent ?>',<?= $idfile ?>)" title="Upload">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                                <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                                                            </svg>
                                                                        </button> -->
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                                                        </svg>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php }
                                                            $o++; ?>
                                                            <td rowspan="<?= count($dok) ?>" class="text-center" id="<?= 'poin_' . $elparent ?>"><?= $isallfilesub == 1 ? $poinambilsub : 0 ?></td>
                                                        </tr>
                                                        <?php
                                                        for ($o; $o < count($dok); $o++) {
                                                            $iddok = $dok[$o]['id'];

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
                                                                            if ($sesuai == 1 || $sesuai == 0) {
                                                                        ?>
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                                                                </svg>
                                                                            <?php
                                                                            } else if ($sesuai == 2) {
                                                                            ?>
                                                                                <button class="btn btn-success btn-sm" onclick="openmodal(<?= $iddok ?>, <?= $poinsubsub ?>,0, <?= $idsubsub ?>, '<?= $alp[$i] ?>','<?= $elchild ?>',<?= $idfile ?>)" title="Upload">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                                        <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                                                                    </svg>
                                                                                </button>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        <?php } else { ?>
                                                                            <!-- <button class="btn btn-success btn-sm" onclick="openmodal(<?= $iddok ?>, <?= $poinsub ?>,<?= $idsub ?>, 0, '<?= $alp[$i] ?>', '<?= $elparent ?>',<?= $idfile ?>)" title="Upload">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                                    <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                                                                </svg>
                                                                            </button> -->
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
                                                            $isallfilesubsub = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['isallfile'];
                                                            $dok = $checklist[$i]['main'][$j]['sub'][$k]['subsub'][$l]['dok'];
                                                        ?>

                                                            <tr>
                                                                <td rowspan="<?= count($dok) ?>"></td>
                                                                <td rowspan="<?= count($dok) ?>"><?= $namasubsub ?></td>
                                                                <td rowspan="<?= count($dok) ?>" class="text-center"><?= $poinsubsub ?></td>
                                                                <td rowspan="<?= count($dok) ?>">
                                                                    <?= ($ambilsubsub == 1) ? 'Ambil' : 'Tidak' ?>
                                                                </td>
                                                                <?php
                                                                $o = 0;
                                                                $iddok = $dok[$o]['id'];
                                                                ?>
                                                                <td>
                                                                    <?= $dok[$o]['nama'] ?>
                                                                </td>
                                                                <?php
                                                                if ($ambilsubsub == 0) {
                                                                    echo "<td></td>";
                                                                } else {
                                                                ?>
                                                                    <td class="text-center align-middle <?= $elchild ?> ">
                                                                        <?php
                                                                        if ($dok[$o]['isupload'] == 1) {
                                                                            if ($sesuai == 1 || $sesuai == 0) {
                                                                        ?>
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                                                                </svg>
                                                                            <?php
                                                                            } else if ($sesuai == 2) {
                                                                            ?>
                                                                                <button class="btn btn-success btn-sm" onclick="openmodal(<?= $iddok ?>, <?= $poinsubsub ?>,0, <?= $idsubsub ?>, '<?= $alp[$i] ?>','<?= $elchild ?>',<?= $idfile ?>)" title="Upload">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                                        <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                                                                    </svg>
                                                                                </button>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        <?php } else { ?>
                                                                            <button class="btn btn-success btn-sm" onclick="openmodal(<?= $iddok ?>, <?= $poinsubsub ?>,0, <?= $idsubsub ?>, '<?= $alp[$i] ?>','<?= $elchild ?>',<?= $idfile ?>)" title="Upload">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                                    <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                                                                </svg>
                                                                            </button>
                                                                        <?php } ?>
                                                                    </td>
                                                                <?php }
                                                                $o++; ?>
                                                                <td rowspan="<?= count($dok) ?>" class="text-center" id="<?= 'poin_' . $elchild ?>"><?= $isallfilesubsub == 1 ? $poinambilsubsub : 0 ?></td>
                                                            </tr>
                                                            <?php
                                                            for ($o; $o < count($dok); $o++) {
                                                                $iddok = $dok[$o]['id'];
                                                            ?>
                                                                <tr>
                                                                    <td><?= $dok[$o]['nama'] ?></td>
                                                                    <?php
                                                                    if ($ambilsubsub == 0) {
                                                                        echo "<td></td>";
                                                                    } else {
                                                                    ?>
                                                                        <td class="text-center align-middle <?= $elchild ?> <?= $ambilsubsub == 1 ? '' : 'd-none' ?>">
                                                                            <?php
                                                                            if ($dok[$o]['isupload'] == 1) {
                                                                                if ($sesuai == 1 || $sesuai == 0) {
                                                                            ?>
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                                                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                                                                    </svg>
                                                                                <?php
                                                                                } else if ($sesuai == 2) {
                                                                                ?>
                                                                                    <button class="btn btn-success btn-sm" onclick="openmodal(<?= $iddok ?>, <?= $poinsubsub ?>,0, <?= $idsubsub ?>, '<?= $alp[$i] ?>','<?= $elchild ?>',<?= $idfile ?>)" title="Upload">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                                            <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                                                                        </svg>
                                                                                    </button>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            <?php } else { ?>
                                                                                <button class="btn btn-success btn-sm" onclick="openmodal(<?= $iddok ?>, <?= $poinsubsub ?>,0, <?= $idsubsub ?>, '<?= $alp[$i] ?>','<?= $elchild ?>',<?= $idfile ?>)" title="Upload">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                                        <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                                                                    </svg>
                                                                                </button>
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
                formData.append('elnow', $('#elnow').val());
                formData.append('idfile', $('#idfile').val());
                uploading(formData);
            }
        });

        // $('#subm').click(function(){
        //     $('#loaderupload').removeClass('d-none');
        // })
    })

    function konsultasi(id_permohonan) {
        if (confirm('Ajukan Proses Konsultasi ?')) {
            let formdataselesai = new FormData();
            formdataselesai.append('id_permohonan', id_permohonan);
            formdataselesai.append('status', 4);
            formdataselesai.append('poinhead', <?= $permohonan->poin_diajukan ?>);
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: formdataselesai,
                processData: false,
                contentType: false,
                url: '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/updatestatuspermohonan',
                success: function(response) {
                    window.location.href = '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/';
                }
            })
        }
    }

    function sidang(id_permohonan, poin_diajukan) {
        if (confirm('Ajukan Sidang Untuk Permohonan Ini ?')) {
            let fd = new FormData();
            fd.append('id_permohonan', id_permohonan);
            fd.append('status', 43);
            fd.append('poinhead', poin_diajukan);

            $.ajax({
                type: 'post',
                dataType: 'json',
                data: fd,
                processData: false,
                contentType: false,
                url: '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/updatestatuspermohonan',
                success: function(response) {
                    if (response.code === 1) {
                        alert('Berhasil!');
                        window.location.href = '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/';
                    }
                }
            })
        }
    }
</script>