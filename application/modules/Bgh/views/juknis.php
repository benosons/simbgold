<div class="page-content">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Juknis BGH</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('bgh/') ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Juknis BGH
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Basic Tables start -->
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <?php if($this->session->userdata('loc_role_id') != 10){ ?>
                            <button class="btn btn-primary btn-sm" id="tambah-juknis"><i class="fa fa-plus"></i> Tambah Data</button>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Dokumen</th>
                                    <th>Jenis Dokumen</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Lihat / Unduh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach($juknis as $j){ ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $j->nama_dokumen ?></td>
                                    <td><?= $j->jenis_dokumen ?></td>
                                    <td><?= $j->penerbit ?></td>
                                    <td><?= $j->tahun ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-list dropdown-icon "></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                            <a class="dropdown-item" href="<?= base_url('assets/bgh/juknis/'.$j->file) ?>" target="_blank"><i class="fa fa-download"></i> Unduh / Lihat</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
</div>

<div class="modal fade text-left modal-borderless" id="modaljuknis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Juknis</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x">X</i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formjuknis">
                    <div class="form-group">
                        <input type="text" name="id" id="id" value="0" hidden>
                        <label for="" class="form-control-label">Nama Dokumen</label>
                        <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-control-label">Jenis Dokumen</label>
                        <input type="text" class="form-control" name="jenis_dokumen" id="jenis_dokumen" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-control-label">Penerbit</label>
                        <input type="text" class="form-control" name="penerbit" id="penerbit" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-control-label">Tahun Terbit</label>
                        <select name="tahun" id="tahun" class="form-control" id="tahun" required>
                            <option value="">PILIH</option>
                            <?php 
                                for($i=2023; $i>=2010; $i--)
                                {
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-control-label">File</label>
                        <input type="file" class="form-control" name="file">
                    </div>
                    <button class="btn btn-primary btn-sm mt-3 float-end" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#juknis-menu').addClass('active');
        $('#table1').DataTable();

        $('#tambah-juknis').click(function(){
            $('#modaljuknis').modal('show');
            $('#id').val('0');
            $('#nama_dokumen').val('');
            $('#jenis_dokumen').val('');
            $('#penerbit').val('');
            $('#tahun').val('');
        })

        $('#formjuknis').submit(function(e){
            e.preventDefault();
            $.ajax({
                type:'post',
                dataType:'json',
                data:new FormData(this),
                processData:false,
                contentType:false,
                url:"<?= base_url('bgh/verifikator/informasi/formjuknis') ?>",
                success:function(response){
                    if (response.code === 1) {
                        Swal.fire({
                            icon:'success',
                            title:'Berhasil',
                            text: response.msg
                        }).then((result)=>{
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                            icon:'error',
                            title:'Gagal',
                            text:response.msg
                        });
                    }
                }
            })
        })

        $(document).on('click','.editjuknis',function(){
            let id = $(this).data('id');
            let nama = $(this).data('nama');
            let jenis = $(this).data('jenis');
            let penerbit = $(this).data('penerbit');
            let tahun = $(this).data('tahun');
            let berkas = $(this).data('berkas');

            $('#modaljuknis').modal('show');
            $('#id').val(id);
            $('#nama_dokumen').val(nama);
            $('#jenis_dokumen').val(jenis);
            $('#penerbit').val(penerbit);
            $('#tahun').val(tahun);
        })

        $(document).on('click','.deletejuknis', function(){
            var id = $(this).data('id');
            Swal.fire({
                icon:'question',
                title:'Hapus Data ?',
                text:'Data akan hilang permanen',
                showCancelButton: true
            }).then((response)=>{
                if (response.isConfirmed) {
                    $.ajax({
                        type:'post',
                        dataType:'json',
                        data:{id:id},
                        url:'<?= base_url('bgh/verifikator/informasi/deletejuknis') ?>',
                        success:function(result)
                        {
                            if (result.code === 1) {
                                Swal.fire({
                                    icon:'success',
                                    title:'Berhasi',
                                    text:result.msg
                                }).then((res) => {
                                    if (res.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            }else{
                                Swal.fire({
                                    icon:'error',
                                    title:'Gagal',
                                    text:result.msg
                                });
                            }
                        }
                    })
                }
            })
        })

    })
</script>

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