<div class="tab-pane fade" id="doc" style="display: none;">
    <br>
    <div class="row">
        <input type='text' name='id_pertimbangan' id='id_pertimbangan' value='' style='display: none;' />

        <div class="col-md-6">
            <form action="<?= site_url("penjadwalanpbg/jadwal_sidang/{$id}") ?>" role="form" method="post" id="simaknya" enctype="multipart/form-data">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-circle"></i>
                                    </span>
                                    <select class="form-control" name="sidang_ke" id="sidang_ke">
                                        <option value="">Pilih</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>

                                    <label for="form_control_1">Sidang ke</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-circle"></i>
                                    </span>
                                    <select class="form-control" name="jns_tabg" id="jns_tabg">
                                        <option value="">Pilih</option>
                                        <option value="1">Arsitektur</option>
                                        <option value="2">Struktur</option>
                                        <option value="3">Utilitas</option>
                                    </select>

                                    <label for="form_control_1">Jenis Dokumen</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                                <input name="no_dok" class="form-control" id="no_dok" type="text" placeholder="123 - ABC">
                                <label for="form_control_1">Nomor Dokumen</label>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input class="form-control date-picker" type="text" id="tanggal_dok" name="tanggal_dok" data-date-format="yyyy-mm-dd" placeholder="2000/12/31" />
                                <label for="form_control_1">Tanggal</label>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-md-line-input">
                            <textarea class="form-control" rows="2" placeholder="Nama Dokumen" id="nama_dok" name="nama_dok"></textarea>
                            <label for="form_control_1">Nama Dokumen</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-md-line-input">
                            <input style="display: none;" name="dir_file_dok" id="dir_file_dok" onchange='cokek()'>
                            <input type="file" class="form-control" name="d_file_dok" id="d_file_dok" onchange='cokek()'>
                            <label for="form_control_1">Berkas Hasil Pemeriksaan / SIMAK</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn blue-hoki btn-block">Simpan</button>
                    </div>
                </div>
                <hr />
            </form>
        </div>
        <div class="col-md-6">
            <form role="form">
                <div class="form-body">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr class="info">
                                <th rowspan="2">
                                    <center>Sidang<br>Ke</center>
                                </th>
                                <th colspan="4">
                                    <center>Dokumen</center>
                                </th>
                                <th rowspan="2">
                                    <center>File/Dok.<br>SIMAK</center>
                                </th>
                            </tr>
                            <tr class="info">

                                <th>
                                    <center>Jenis</center>
                                </th>
                                <th>
                                    <center>Nama</center>
                                </th>
                                <th>
                                    <center>Nomor</center>
                                </th>
                                <th>
                                    <center>Tanggal</center>
                                </th>
                            </tr>

                        </tbody>
                    </table>

                </div>

            </form>
        </div>

    </div>
</div>