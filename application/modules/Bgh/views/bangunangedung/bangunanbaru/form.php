<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col-6">
                <h2 class="page-title">
                    Pengisian Daftar Simak
                </h2>
            </div>
            <div class="col-6">
                <button class="btn btn-success ms-2 float-end" id="btn-selesai" onclick="selesai(<?= $permohonan->id ?>, 1, <?= $poinhead ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                        <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                    </svg>
                    Ajukan Permohonan
                </button>
                <!-- <button class="btn btn-primary float-end" id="btn-sidang" onclick="sidang(<?= $permohonan->id ?>, 1, <?= $poinhead ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                    </svg>
                    Ajukkan Sidang
                </button> -->
            </div>
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards mb-3">
            <div class="col-md-12 col-xl-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <?php if ($permohonan->status == 2) { ?>
                            <ul class="steps steps-green steps-counter my-4">
                                <li class="step-item">Pengisian Formulir Data Bangunan & Data Pemilik</li>
                                <li class="step-item active">Pengisian Daftar Simak</li>
                                <li class="step-item">Proses Verifikasi Kelengkapan Dokumen</li>
                                <li class="step-item">Proses Assesment Oleh TPA/TPT</li>
                                <li class="step-item">Proses Penerbitan Sertifikat/Banding (Apabila diajukan)</li>
                            </ul>
                        <?php } else if ($permohonan->status == 4) { ?>
                            <ul class="steps steps-green steps-counter my-4">
                                <li class="step-item">Pengisian Formulir Data Bangunan & Data Pemilik</li>
                                <li class="step-item">Pengisian Daftar Simak</li>
                                <li class="step-item">Proses Verifikasi Kelengkapan Dokumen</li>
                                <li class="step-item active">Proses Assesment Oleh TPA/TPT</li>
                                <li class="step-item">Proses Penerbitan Sertifikat/Banding (Apabila diajukan)</li>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xl-8">
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
            <div class="col-md-4 col-xl-4">
                <div class="card card-sm bg-success text-white">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="fw-bold">
                                    Ketentuan Peringkat
                                </div>
                                <div class="text-white">
                                    <table class="table table-borderless">
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
                                                    <td width="12%">Claim Poin</td>
                                                    <td width="25%">Dokumen Pembuktian</td>
                                                    <td width="5%">Upload</td>
                                                    <td width="3%">Poin Diajukan</td>
                                                    <?php if ($tidak_sesuai > 0) { ?>
                                                        <td width="5%">Kesesuaian Dokumen</td>
                                                        <td width="15%">Catatan</td>
                                                    <?php } ?>
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
                                                                <select name="" class="form-select <?= $elparent ?>" id="<?= $elparent ?>" onchange="claimpoin('<?= $elparent ?>', '0',<?= $pilihansub ?>, event, <?= $poinsub ?>,<?= $permohonan->id ?>, <?= $idsub ?>, 0, '<?= $alp[$i] ?>')" <?= ($ambilsub == 1) ? 'disabled="disabled"' : '' ?>>
                                                                    <option value="0">Tidak</option>
                                                                    <option value="1" <?= ($ambilsub == 1) ? 'selected' : '' ?>>Ambil</option>
                                                                </select>
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
                                                                $sesuai = "";
                                                                $catatan = "";
                                                                $idfile = 0;
                                                                echo "<td></td>";
                                                            } else {
                                                                $sesuai = $dok[$o]['sesuai'];
                                                                $catatan = $dok[$o]['catatan'];
                                                                $idfile = $dok[$o]['idfile'];
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
                                                                        <button class="btn btn-success btn-sm" onclick="openmodal(<?= $iddok ?>, <?= $poinsub ?>,<?= $idsub ?>, 0, '<?= $alp[$i] ?>','<?= $elparent ?>',<?= $idfile ?>)" title="Upload">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                                <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                                                            </svg>
                                                                        </button>
                                                                    <?php } ?>
                                                                </td>
                                                            <?php }
                                                            $o++; ?>
                                                            <td rowspan="<?= count($dok) ?>" class="text-center" id="<?= 'poin_' . $elparent ?>"><?= $isallfilesub == 1 ? $poinambilsub : 0 ?></td>
                                                            <?php if ($tidak_sesuai > 0) { ?>
                                                                <td>
                                                                    <?php
                                                                    if ($sesuai == 0) {
                                                                        echo "";
                                                                    } else if ($sesuai == 1) {
                                                                        echo "Sesuai";
                                                                    } else if ($sesuai == 2) {
                                                                        echo "Tidak Sesuai";
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?= $catatan ?>
                                                                </td>
                                                            <?php } ?>
                                                            <!-- <td></td>
                                                            <td></td>
                                                            <td>0</td> -->
                                                        </tr>
                                                        <?php
                                                        for ($o; $o < count($dok); $o++) {
                                                            $iddok = $dok[$o]['id'];

                                                        ?>
                                                            <tr>
                                                                <td><?= $dok[$o]['nama'] ?></td>
                                                                <?php
                                                                if ($ambilsub == 0) {
                                                                    $sesuai = "";
                                                                    $catatan = "";
                                                                    $idfile = 0;
                                                                    echo "<td></td>";
                                                                } else {
                                                                    $sesuai = $dok[$o]['sesuai'];
                                                                    $catatan = $dok[$o]['catatan'];
                                                                    $idfile = $dok[$o]['idfile'];
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
                                                                            <button class="btn btn-success btn-sm" onclick="openmodal(<?= $iddok ?>, <?= $poinsub ?>,<?= $idsub ?>, 0, '<?= $alp[$i] ?>', '<?= $elparent ?>',<?= $idfile ?>)" title="Upload">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                                                    <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                                                                                </svg>
                                                                            </button>
                                                                        <?php } ?>
                                                                    </td>
                                                                <?php } ?>
                                                                <?php if ($tidak_sesuai > 0) { ?>
                                                                    <td>
                                                                        <?php
                                                                        if ($sesuai == 0) {
                                                                            echo "";
                                                                        } else if ($sesuai == 1) {
                                                                            echo "Sesuai";
                                                                        } else if ($sesuai == 2) {
                                                                            echo "Tidak Sesuai";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $catatan ?>
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
                                                            <?php if ($tidak_sesuai > 0) { ?>
                                                                <td></td>
                                                                <td></td>
                                                            <?php } ?>
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
                                                                    <select name="" class="form-select <?= $elparent ?>" id="<?= $elchild ?>" onchange="claimpoin('<?= $elparent ?>', '<?= $elchild ?>',<?= $pilihansub ?>, event, <?= $poinsubsub ?>,<?= $permohonan->id ?>, 0, <?= $idsubsub ?>, '<?= $alp[$i] ?>')" <?= ($ambilsubsub == 1 || ($ambilsubsub == 0 && $terpilihsub == 1)) ? 'disabled="disabled"' : '' ?>>
                                                                        <option value="0">Tidak</option>
                                                                        <option value="1" <?= ($ambilsubsub == 1) ? 'selected' : '' ?>>Ambil</option>
                                                                    </select>
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
                                                                    $sesuai = "";
                                                                    $catatan = "";
                                                                    $idfile = 0;
                                                                    echo "<td></td>";
                                                                } else {
                                                                    $sesuai = $dok[$o]['sesuai'];
                                                                    $catatan = $dok[$o]['catatan'];
                                                                    $idfile = $dok[$o]['idfile'];
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
                                                                <?php if ($tidak_sesuai > 0) { ?>
                                                                    <td>
                                                                        <?php
                                                                        if ($sesuai == 0) {
                                                                            echo "";
                                                                        } else if ($sesuai == 1) {
                                                                            echo "Sesuai";
                                                                        } else if ($sesuai == 2) {
                                                                            echo "Tidak Sesuai";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $catatan ?>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                            <?php
                                                            for ($o; $o < count($dok); $o++) {
                                                                $iddok = $dok[$o]['id'];
                                                            ?>
                                                                <tr>
                                                                    <td><?= $dok[$o]['nama'] ?></td>
                                                                    <?php
                                                                    if ($ambilsubsub == 0) {
                                                                        $sesuai = "";
                                                                        $catatan = "";
                                                                        $idfile = 0;
                                                                        echo "<td></td>";
                                                                    } else {
                                                                        $sesuai = $dok[$o]['sesuai'];
                                                                        $catatan = $dok[$o]['catatan'];
                                                                        $idfile = $dok[$o]['idfile'];
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
                                                                    <?php if ($tidak_sesuai > 0) { ?>
                                                                        <td>
                                                                            <?php
                                                                            if ($sesuai == 0) {
                                                                                echo "";
                                                                            } else if ($sesuai == 1) {
                                                                                echo "Sesuai";
                                                                            } else if ($sesuai == 2) {
                                                                                echo "Tidak Sesuai";
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= $catatan ?>
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
                <input type="text" id="elnow" hidden>
                <input type="text" id="idfile" hidden>
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

    function claimpoin(elparent, elchild, pilihan, event, elpoin, id_permohonan, id_sub, id_sub_sub, accord) {
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
                ambilpoin(id_permohonan, id_sub, id_sub_sub, elpoin, accord, elchild);
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
        } else if (pilihan === 0 && selected === "1" && id_sub_sub != 0) {
            if (confirm('Hapus Poin Pertanyaan ini ?')) {
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
                ambilpoin(id_permohonan, id_sub, id_sub_sub, elpoin, accord, elchild);
            } else {
                $('#' + elchild).val(1);
            }
        } else if (pilihan === 0 && selected === "1" && id_sub != 0) {
            if (confirm('Ambil Poin Pertanyaan ini ?')) {
                let el = document.querySelectorAll('.upload_' + elparent);
                [].forEach.call(el, function(elem) {
                    elem.classList.remove('d-none');
                });
                ambilpoin(id_permohonan, id_sub, id_sub_sub, elpoin, accord, elparent);
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

    function ambilpoin(id_permohonan, id_sub, id_sub_sub, poin_diajukan, accord, elnow) {
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
                window.location.href = '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/penilaian/<?= $permohonan->kode_bgh ?>?elnow=' + elnow + '&accord=' + accord;
            }
        })
    }

    function openmodal(id_dokumen, poin_diajukan, id_sub, id_sub_sub, head, el, idfile) {
        $('#id_dokumen').val(id_dokumen);
        $('#poin_diajukan').val(poin_diajukan);
        $('#id_sub').val(id_sub);
        $('#id_sub_sub').val(id_sub_sub);
        $('#head').val(head);
        $('#elnow').val(el);
        $('#idfile').val(idfile);
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
                    window.location.href = "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/penilaian/<?= $permohonan->kode_bgh ?>?elnow=" + response.elnow + "&accord=" + response.accord;
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        })
    }

    function selesai(id_permohonan, status, poinhead) {
        if (confirm('Selesaikan Permohonan ini ? ')) {
            let formdataselesai = new FormData();
            formdataselesai.append('id_permohonan', id_permohonan);
            formdataselesai.append('status', status);
            formdataselesai.append('poinhead', poinhead);
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


    function sidang(id_permohonan, status, poinhead) {
        if (confirm('Yakin Untuk Langsung Masuk Ke Tahap Sidang ? ')) {
            let formdatasidang = new FormData();
            formdatasidang.append('id_permohonan', id_permohonan);
            formdatasidang.append('status', status);
            formdatasidang.append('poinhead', poinhead);
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: formdatasidang,
                processData: false,
                contentType: false,
                url: '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/updatestatuspermohonan',
                success: function(response) {
                    window.location.href = '<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/';
                }
            })
        }
    }

    function validateFileExtension(fileName) {
        var allowedExtensions = ['pdf', 'xlx', 'xlsx', 'jpg', 'png'];
        var fileExtension = fileName.split('.').pop().toLowerCase();
        return allowedExtensions.indexOf(fileExtension) > -1;
    }
</script>