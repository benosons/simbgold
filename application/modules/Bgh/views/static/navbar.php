<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
        <div class="container-xl">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Kembali Ke SIMBG
                        </span>
                    </a>
                </li>
                <li class="nav-item" id="menu-dashboard">
                    <a class="nav-link" href="<?= base_url() ?>Bgh/Dashboard" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Dashboard BGH
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown" id="menu-bangunan">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-estate" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 21h18"></path>
                            <path d="M19 21v-4"></path>
                            <path d="M19 17a2 2 0 0 0 2 -2v-2a2 2 0 1 0 -4 0v2a2 2 0 0 0 2 2z"></path>
                            <path d="M14 21v-14a3 3 0 0 0 -3 -3h-4a3 3 0 0 0 -3 3v14"></path>
                            <path d="M9 17v4"></path>
                            <path d="M8 13h2"></path>
                            <path d="M8 9h2"></path>
                        </svg>
                    </span>
                    <span class="nav-link-title">
                        Bangunan Gedung
                    </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru">
                            Bangunan Baru
                        </a>
                        <a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanSudahAda">
                            Bangunan Sudah Ada
                        </a>
                        <a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanKlas1a">
                            Khusus Bangunan Gedung Klas 1a
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown" id="menu-lingkungan">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-leaf" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 21c.5 -4.5 2.5 -8 7 -10"></path>
                            <path d="M9 18c6.218 0 10.5 -3.288 11 -12v-2h-4.014c-9 0 -11.986 4 -12 9c0 1 0 3 2 5h3z"></path>
                        </svg>
                    </span>
                    <span class="nav-link-title">
                        Lingkungan
                    </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropend">
                          <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            Otoritas Jamak
                          </a>
                          <div class="dropdown-menu">
                            <a href="<?= base_url() ?>Bgh/Lingkungan/Hunianhijau" class="dropdown-item">
                              Hunian Hijau Masyarakat
                            </a>
                          </div>
                        </div>
                        <div class="dropend">
                          <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            Otoritas Tunggal (Kawasan)
                          </a>
                          <div class="dropdown-menu">
                            <a href="<?= base_url() ?>Bgh/Lingkungan/Kawasanhijau" class="dropdown-item">
                              Kawasan Hijau
                            </a>
                            <!-- <a href="./card-actions.html" class="dropdown-item">
                              Kawasan Hijau Sudah Ada
                              <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                            </a> -->
                          </div>
                        </div>
                    </div>
                </li>
                <?php 
                    if ($this->session->userdata('loc_role_id') != 10) {
                ?>
                <li class="nav-item dropdown" id="menu-tpa">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                        </svg>
                    </span>
                    <span class="nav-link-title">
                        Data TPA
                    </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= base_url() ?>Bgh/Tpa">
                            List TPA
                        </a>
                        <a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanSudahAda">
                            Penugasan TPA
                        </a>
                    </div>
                </li>
                <?php
                    }
                ?>
            </ul>
            <!-- <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
            <form action="./" method="get" autocomplete="off" novalidate>
                <div class="input-icon">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                </span>
                <input type="text" value="" class="form-control" placeholder="Search…" aria-label="Search in website">
                </div>
            </form>
            </div> -->
        </div>
        </div>
    </div>
</header>