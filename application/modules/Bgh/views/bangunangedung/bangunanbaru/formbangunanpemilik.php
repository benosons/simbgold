<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Permohonan BGH
                </h2>
            </div>
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3>Formulir Data Bangunan dan Data Pemilik</h3>
            </div>
            <div class="card-body">
                <form id="formbangunanpemilik">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Data Bangunan</h3>
                            <input type="text" id="id_permohonan" value="<?= (!empty($permohonan)) ? $permohonan->id:0 ?>" hidden>
                            <div class="row row-cards">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Gedung</label>
                                        <input type="text" class="form-control" name="nama_gedung" id="nama_gedung" value="<?= (!empty($permohonan)) ? $permohonan->nama_gedung:'' ?>" placeholder="Masukan Nama Gedung">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Lantai</label>
                                        <input type="number" class="form-control" name="lantai" id="lantai" value="<?= (!empty($permohonan)) ? $permohonan->lantai:0 ?>" min="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Luas Bangunan</label>
                                        <input type="number" class="form-control" name="luas_bangunan" id="luas_bangunan" value="<?= (!empty($permohonan)) ? $permohonan->luas_bangunan:'' ?>" placeholder="Masukan Luasan Gedung" min="0">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            Klas Bangunan <span style="cursor:pointer" id="modalklas" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
                                                </svg>
                                            </span>
                                        </label>
                                        <select name="klas_bangunan" id="klas_bangunan" class="form-control" required>
                                            <option value="">PILIH</option>
                                            <?php foreach($klas as $k){ ?>
                                            <option value="<?= $k->id ?>" <?php if(!empty($permohonan)){ if($permohonan->klas_bangunan == $k->id){ echo "selected"; } } ?>><?= $k->klas ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>Data Pemilik</h3>
                            <input type="text" id="id_pemilik" value="<?= (!empty($permohonan)) ? $permohonan->id_pemilik:0 ?>" hidden>
                            <div class="row row-cards">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Gelar Depan</label>
                                        <input type="text" class="form-control" name="glr_depan" id="glr_depan" placeholder="Masukan Gelar Depan" value="<?= (!empty($permohonan)) ? $permohonan->glr_depan:'' ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nm_pemilik" id="nm_pemilik" value="<?= (!empty($permohonan)) ? $permohonan->nm_pemilik:'' ?>" placeholder="Masukan Nama Pemilik" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Gelar Belakang</label>
                                        <input type="text" class="form-control" name="glr_belakang" id="glr_belakang" placeholder="Masukan Gelar Belakang" value="<?= (!empty($permohonan)) ? $permohonan->glr_belakang:'' ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">No KTP</label>
                                        <input type="text" maxlength="16" class="form-control" name="no_ktp" id="no_ktp" placeholder="Masukan No KTP" value="<?= (!empty($permohonan)) ? $permohonan->no_ktp:'' ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">No Kitas</label>
                                        <input type="text" class="form-control" name="no_kitas" id="no_kitas" value="<?= (!empty($permohonan)) ? $permohonan->no_kitas:'' ?>" placeholder="(Optional)" >
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" id="alamat" value="<?= (!empty($permohonan)) ? $permohonan->alamat:'' ?>" placeholder="Masukan Alamat" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Provinsi</label>
                                        <select name="id_provinsi" id="id_provinsi" class="form-select" required>
                                            <option value="">PILIH</option>
                                            <?php 
                                                foreach($provinsi as $p){
                                            ?>
                                            <option value="<?= $p->id_provinsi ?>"><?= $p->nama_provinsi ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Kota/Kabupaten</label>
                                        <select name="id_kabkot" id="id_kabkot" class="form-select" required>
                                            <option value="">PILIH</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Kecamatan</label>
                                        <select name="id_kecamatan" id="id_kecamatan" class="form-select" required>
                                            <option value="">PILIH</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Kelurahan</label>
                                        <select name="id_kelurahan" id="id_kelurahan" class="form-select" required>
                                            <option value="">PILIH</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">No HP</label>
                                        <input type="text" class="form-control" maxlength="12" name="no_hp" id="no_hp" value="<?= (!empty($permohonan)) ? $permohonan->no_hp:'' ?>" placeholder="Masukan Nomor HP Aktif" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" value="<?= (!empty($permohonan)) ? $permohonan->email:'' ?>" placeholder="Masukan Email" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Unit Organisasi</label>
                                        <input type="text" class="form-control" name="unit_organisasi" id="unit_organisasi" value="<?= (!empty($permohonan)) ? $permohonan->unit_organisasi:'' ?>" placeholder="Masukan Unit Organisasi" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success float-end">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Bangunan Gedung dengan kategori Wajib BGH</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-stripped">
                <thead class="bg-main">
                    <th>No</th>
                    <th>Klas Bangunan</th>
                    <th>Definisi</th>
                    <th>Contoh Bangunan</th>
                    <th>Ketentuan</th>
                </thead>
                <tbody>
                    <?php 
                        $index = 1;
                        foreach($klas as $kl){
                    ?>
                    <tr>
                        <td><?= $index ?></td>
                        <td><?= $kl->klas ?></td>
                        <td><?= $kl->definisi ?></td>
                        <td><?= $kl->contoh_bangunan ?></td>
                        <td><?= $kl->ketentuan ?></td>
                    </tr>
                    <?php $index++;} ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/bgh/dist/libs/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
<script src="<?= base_url() ?>assets/bgh/dist/libs/DataTables-1.13.4/js/datatables.min.js"></script>
<?php if(!empty($permohonan)){ ?>
    <script>
        var step = "<?= $permohonan->step ?>";
        var id_prov = "<?= $permohonan->id_provinsi ?>";
        var id_kabkot = "<?= $permohonan->id_kabkota ?>";
        var id_kec = "<?= $permohonan->id_kecamatan ?>";
        var id_kel = "<?= $permohonan->id_kelurahan ?>";
    </script>
<?php
}else {
?>
    <script>
        var step = "10";
        var id_prov = "0";
        var id_kabkot = "0";
        var id_kec = "0";
        var id_kel = "0";
    </script>
<?php } ?>
<script>
    $(() => {
        $('#menu-bangunan').addClass('active');

        if (id_prov !== "0") {
            $('#id_provinsi').val(id_prov);
            handleprov(id_prov);
        }

        $('#id_provinsi').change(function(){
            var id_provin = $(this).val();
            handleprov(id_provin);
        })

        $('#id_kabkot').change(function(){
            var id = $(this).val();
            handlekabkot(id);
        })

        function handleprov(id_prov){
            
            $.ajax({
                type:'post',
                dataType:'json',
                data:{id_provinsi:id_prov},
                url:"<?= base_url('bgh/pengajuan/getkabkot') ?>",
                success:function(response){
                    let html = '<option value="">PILIH</option>';
                    response.data.forEach(e => {
                        html += `<option value="${e.id_kabkot}"> ${e.nama_kabkota}</option>`;
                    });

                    $('#id_kabkot').html(html);

                    if (id_kabkot !== "0") {
                        $('#id_kabkot').val(id_kabkot);
                        getkec(id_kabkot);
                    }
                }
            })
        }

        function handlekabkot(id){
            getkec(id);
        }

        $('#id_kecamatan').change(function(){
            var id = $(this).val();
            getkel(id);
        })

        function getkec(id)
        {
            if (id===0) {
                $('#id_kecamatan').html('<option value=""> PILIH </option>');
            }else{
                $.ajax({
                    type:'post',
                    dataType:'json',
                    data:{id_kabkot:id},
                    url:"<?= base_url('bgh/pengajuan/getkecamatan') ?>",
                    success:function(response){
                        let html = '<option value="">PILIH</option>';
                        response.data.forEach(e => {
                            html += `<option value="${e.id_kecamatan}"> ${e.nama_kecamatan}</option>`;
                        });

                        $('#id_kecamatan').html(html);

                        if (id_kec !== "0") {
                            $('#id_kecamatan').val(id_kec);
                            getkel(id_kec);
                        }
                    }
                })
            }
        }

        function getkel(id)
        {
            if (id===0) {
                $('#id_kelurahan').html('<option value=""> PILIH </option>');
            }else{
                $.ajax({
                    type:'post',
                    dataType:'json',
                    data:{id_kecamatan:id},
                    url:"<?= base_url('bgh/pengajuan/getkelurahan') ?>",
                    success:function(response){
                        let html = '<option value="">PILIH</option>';
                        response.data.forEach(e => {
                            html += `<option value="${e.id_kelurahan}"> ${e.nama_kelurahan}</option>`;
                        });

                        $('#id_kelurahan').html(html);
                        if (id_kel !== "0") {
                            $('#id_kelurahan').val(id_kel);
                        }
                    }
                })
            }
        }

        $('#formbangunanpemilik').submit(function(e){
            e.preventDefault();
            var formdata = new FormData();
            formdata.append('nama_gedung', $('#nama_gedung').val());
            formdata.append('lantai', $('#lantai').val());
            formdata.append('luas_bangunan', $('#luas_bangunan').val());
            formdata.append('klas_bangunan', $('#klas_bangunan').val());
            formdata.append('glr_depan', $('#glr_depan').val());
            formdata.append('nm_pemilik', $('#nm_pemilik').val());
            formdata.append('glr_belakang', $('#glr_belakang').val());
            formdata.append('no_ktp', $('#no_ktp').val());
            formdata.append('no_kitas', $('#no_kitas').val());
            formdata.append('alamat', $('#alamat').val());
            formdata.append('id_provinsi', $('#id_provinsi').val());
            formdata.append('id_kabkot', $('#id_kabkot').val());
            formdata.append('id_kecamatan', $('#id_kecamatan').val());
            formdata.append('id_kelurahan', $('#id_kelurahan').val());
            formdata.append('no_hp', $('#no_hp').val());
            formdata.append('email', $('#email').val());
            formdata.append('unit_organisasi', $('#unit_organisasi').val());
            formdata.append('id_permohonan',$('#id_permohonan').val());
            formdata.append('id_pemilik',$('#id_pemilik').val());
            
            savepermohonan(formdata);
        })

        function savepermohonan(formdata)
        {
            $.ajax({
                type:'post',
                dataType:'json',
                data: formdata,
                contentType:false,
                processData:false,
                url:'<?= base_url('Bgh/BangunanGedung/BangunanBaru/savepermohonan') ?>',
                success:function(response)
                {
                    if (response.code === 1) {
                        // let url = "<?= base_url()?>bgh/pengajuan/mandatorybghbaru/"+response.nomor_bgh;
                        // window.location.replace(url);
                        alert('Berhasil !');
                    }else{
                        Swal.fire({
                            icon:"warning",
                            title: 'Perhatian !',
                            text: response.msg
                        });
                    }
                }
            })
        }
    })
</script>