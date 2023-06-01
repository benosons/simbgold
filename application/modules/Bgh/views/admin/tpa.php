<div class="container">
    
<header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>List TPA</h3>
    </div>
    <div class="page-content">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Unsur</th>
                            <th>Keahlian</th>
                            <th>Provinsi</th>
                            <th>Kab/Kota</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($tpa as $item){ ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $item->glr_depan.' '.$item->nm_tpa.' '.$item->glr_blkg ?></td>
                                <td>
                                    <?php 
                                        if ($item->id_lembaga == 1) {
                                            echo "Akdemisi";
                                        }else if($item->id_lembaga == 2){
                                            echo "Pakar";
                                        }else{
                                            echo "Profesi Ahli";
                                        }
                                    ?>
                                </td>
                                <td>-</td>
                                <td><?= $item->nama_provinsi ?></td>
                                <td><?= $item->nama_kabkota ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-list dropdown-icon "></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                        <a class="dropdown-item detailtpa" href="javascript:;" data-id="<?= $item->id ?>">Detail</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- <footer>
          <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
              <p>2021 &copy; Mazer</p>
            </div>
            <div class="float-end">
              <p>
                Crafted with
                <span class="text-danger"><i class="bi bi-heart"></i></span> by
                <a href="http://ahmadsaugi.com">A. Saugi</a>
              </p>
            </div>
          </div>
        </footer> -->

</div>