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

<script>
    $(function(){
        $('#tpa-menu').addClass('active');
        $('#table1').DataTable();

        $(document).on('click', '.detailtpa',function(){
            var id = $(this).data('id');
            $.ajax({
                type:'post',
                dataType:'json',
                data:{id:id},
                url:'<?= base_url('bgh/verifikator/tpa/detail') ?>',
                success:function(result){
                    var unsur = '';
                    if (result.data.id_lembaga == "1") {
                        unsur = 'Akademisi';
                    }else if(result.data.id_lembaga == "2"){
                        unsur = 'Pakar';
                    }else {
                        unsur = 'Profesi Ahli';
                    }
                    var html = `
                        <table class="table table-borderless text-start">
                            <tr>
                                <td> Nama </td>
                                <td> : </td>
                                <td> ${result.data.glr_depan} ${result.data.nm_tpa} ${result.data.glr_blkg} </td>
                            </tr>
                            <tr>
                                <td> Alamat </td>
                                <td> : </td>
                                <td> ${result.data.alamat}</td>
                            </tr>
                            <tr>
                                <td> Tempat Lahir </td>
                                <td> : </td>
                                <td> ${result.data.tmpt_lahir}</td>
                            </tr>
                            <tr>
                                <td> Tanggal Lahir </td>
                                <td> : </td>
                                <td> ${result.data.tgl_lahir}</td>
                            </tr>
                            <tr>
                                <td> Email </td>
                                <td> : </td>
                                <td> ${result.data.email}</td>
                            </tr>
                            <tr>
                                <td> No Telepon </td>
                                <td> : </td>
                                <td> ${result.data.no_kontak}</td>
                            </tr>
                            <tr>
                                <td> Provinsi </td>
                                <td> : </td>
                                <td> ${result.data.nama_provinsi}</td>
                            </tr>
                            <tr>
                                <td> Kab/Kota </td>
                                <td> : </td>
                                <td> ${result.data.nama_kabkota}</td>
                            </tr>
                            <tr>
                                <td> Unsur </td>
                                <td> : </td>
                                <td> ${unsur}</td>
                            </tr>
                            <tr>
                                <td> Sertifikat Keahlian </td>
                                <td> : </td>
                                <td> -</td>
                            </tr>
                    `;
                    Swal.fire({
                        title:'informasi',
                        html: html
                    });
                }
            })
        })

    })
</script>