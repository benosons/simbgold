<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="bgh/">
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
                    <a href="<?= base_url('bgh/dashboard') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <?php if($this->session->userdata('loc_role_id') == 10){ ?>
                <li class="sidebar-item" id="bangunanbaru-menu">
                    <a href="<?= base_url('bgh/pengajuan/bangunanbaru') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Pengajuan BGH Bangunan Baru</span>
                    </a>
                </li>
                <?php }else if($this->session->userdata('loc_role_id') != 10){ ?>
                    <li class="sidebar-item <?= $page == 'bangunanbaru' ? 'active' : '' ?>" id="bangunanbaru-menu-">
                    <a href="<?= base_url('bgh/pengajuan/bangunanbaru') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>List Permohonan BGH</span>
                    </a>
                    <li class="sidebar-item <?= $page == 'h2m' ? 'active' : '' ?>" id="h2m-menu">
                    <a href="<?= base_url('bgh/pengajuan/h2m') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>List Permohonan BGH H2M</span>
                    </a>
                    <li class="sidebar-item  <?= $page == 'kawasanhijau' ? 'active' : '' ?>" id="hijau-menu">
                    <a href="<?= base_url('bgh/pengajuan/kawasanhijau') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>List Permohonan BGH kawasanan hijau </span>
                    </a>
                </li>
                <?php 
                }
                ?>

                
                <li class="sidebar-item" id="informasi-menu">
                    <a href="<?= base_url('bgh/informasi') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Informasi Permohonan BGH</span>
                    </a>
                </li>
                <li class="sidebar-item" id="juknis-menu">
                    <a href="<?= base_url('bgh/informasi/juknis') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Juknis Permohonan BGH</span>
                    </a>
                </li>
                <?php if($this->session->userdata('loc_role_id') != 10){ ?>
                    <li class="sidebar-item" id="tpa-menu">
                    <a href="<?= base_url('bgh/tpa') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Data TPA</span>
                    </a>
                </li>   
                <?php } ?>
                <!-- <li class="sidebar-item" id="bangunanexisting-menu">
                    <a href="<?= base_url('bgh/pengajuan/bangunanbaru') ?>" class="sidebar-link">
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