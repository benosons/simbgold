<?php 
    $getnotif = $this->db->get_where('t_notif', array('status' => 0, 'sentto' => 'penilai'));
    $this->db->order_by('id', 'DESC');
    $getnotifs = $this->db->get_where('t_notif', array('sentto' => 'penilai'), 5);

    $notif = $getnotifs->result();
?>
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html">
                        <!-- <img src="<?= base_url() ?>assets/images/logo/logo.png" alt="Logo" srcset=""
                /> -->
                        Permohonan BGH
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item" id="dashboard-menu">
                    <a href="<?= base_url('verifikator/dashboard') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item" id="bangunanbaru-menu">
                    <a href="<?= base_url('verifikator/pengajuan/bangunanbaru') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>List BGH Bangunan Baru</span>
                    </a>
                </li>
                <li class="sidebar-item" id="informasi-menu">
                    <a href="<?= base_url('verifikator/informasi') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Informasi Permohonan BGH</span>
                    </a>
                </li>
                <li class="sidebar-item" id="tpa-menu">
                    <a href="<?= base_url('verifikator/tpa') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Data TPA</span>
                    </a>
                </li>
                <li class="sidebar-item" id="juknis-menu">
                    <a href="<?= base_url('verifikator/informasi/juknis') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Juknis BGH</span>
                    </a>
                </li>
                <!-- <li class="sidebar-item" id="bangunanexisting-menu">
                    <a href="<?= base_url('pengajuan/bangunanbaru') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Pengajuan BGH Bangunan Existing</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="index.html" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Pengajuan H2M</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="index.html" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Pengajuan Kawasan Hijau</span>
                    </a>
                </li> -->
            </ul>
        </div>
        <button class="sidebar-toggler btn x">
            <i data-feather="x"></i>
        </button>
    </div>
</div>
<div id="main" class='layout-navbar'>
    <header class='mb-3'>
        <nav class="navbar navbar-expand navbar-light ">
            <div class="container-fluid">
                <a href="#" class="burger-btn d-block">
                    <i class="bi bi-justify fs-3"></i>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown me-3">
                            <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
                                <?php 
                                    if($getnotif->num_rows() > 0){
                                        echo '<span class="badge badge-notification bg-danger">'.$getnotif->num_rows().'</span>';
                                    }
                                ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <h6 class="dropdown-header">Notifications</h6>
                                </li>
                                <?php 
                                    foreach($notif as $item){
                                        if($item->status==1){
                                ?>
                                <li class="dropdown-item notification-item">
                                    <a class="d-flex align-items-center click-notif" href="<?= base_url().$item->url ?>" data-id="<?= $item->id ?>">
                                        <div class="notification-text ms-4 text-muted">
                                            <p class="notification-title font-bold mb-0">
                                            <?= $item->nama_jenis_notif ?>
                                            </p>
                                            <p class="notification-subtitle font-thin text-sm mt-0">
                                            <?= $item->label_dokumen ?>
                                            </p>
                                            <small class="d-block text-muted">
                                                <em><?= date('d F Y', strtotime($item->create_date)) ?></em>
                                            </small>
                                        </div>
                                    </a>
                                </li>
                                <?php }else{
                                ?>
                                <li class="dropdown-item notification-item">
                                    <a class="d-flex align-items-center click-notif" href="<?= base_url().$item->url ?>" data-id="<?= $item->id ?>">
                                        <div class="notification-text ms-4">
                                            <p class="notification-title font-bold mb-0">
                                            <?= $item->nama_jenis_notif ?>
                                            </p>
                                            <p class="notification-subtitle font-thin text-sm mt-0">
                                            <?= $item->label_dokumen ?>
                                            </p>
                                            <small class="d-block text-muted">
                                                <em><?= date('d F Y', strtotime($item->create_date)) ?></em>
                                            </small>
                                        </div>
                                    </a>
                                </li>
                                <?php
                                } }?>
                                <li>
                                    <!-- <p class="text-center py-2 mb-0">
                                        <a href="#">See all notification</a>
                                    </p> -->
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-menu d-flex">
                                <div class="user-name text-end me-3">
                                    <!-- <h6 class="mb-0 text-gray-600">John Ducky</h6> -->
                                    <p class="mb-0 text-sm text-gray-600">Administrator</p>
                                </div>
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        <img src="assets/images/faces/1.jpg">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                            <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                                    Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>