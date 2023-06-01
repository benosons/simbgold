<?php 
    $getnotif = $this->db->get_where('t_notif', array('status' => 0, 'sentto' => 'client'));
    $this->db->order_by('id', 'DESC');
    $getnotifs = $this->db->get_where('t_notif', array('sentto' => 'client'), 5);

    $notif = $getnotifs->result();
?>
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
                        <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bi bi-bell bi-sub fs-4 '></i>
                            <?php 
                                if($getnotif->num_rows() > 0){
                                    echo '<span class="badge badge-notification bg-danger">'.$getnotif->num_rows().'</span>';
                                }
                            ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Notifications</h6>
                            </li>
                            <?php 
                                foreach($notif as $item){
                                    if($item->status==1){
                            ?>
                            <li class="dropdown-item notification-item">
                                <a class="d-flex align-items-center click-notif" href="<?= base_url('bgh/').$item->url ?>" data-id="<?= $item->id ?>">
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
                                <a class="d-flex align-items-center click-notif" href="<?= base_url('bgh/').$item->url ?>" data-id="<?= $item->id ?>">
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
                                <h6 class="mb-0 text-gray-600"><?= $this->session->userdata('loc_username') ?></h6>
                                <p class="mb-0 text-sm text-gray-600"><?php
                                    if ($this->session->userdata('loc_role_id') == 10) {
                                        echo "Pemohon";
                                    }else if ($this->session->userdata('loc_role_id') == 11) {
                                        echo "Dinas Teknis";
                                    }
                                ?></p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="<?= base_url() ?>assets/bgh/images/faces/1.jpg">
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