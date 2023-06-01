<div class="tab-pane fade" id="pdata">
    <form action="<?= site_url("penjadwalanpbg/editpbg/{$id}") ?>" role="form" method="post" id="editingIMB" enctype="multipart/form-data">
        <div class="form-body">

            <h4 class="caption-subject font-red bold uppercase" align="center">Data Pemilik</h4>
            <div class="col-md-12" style="display: none;">
                <input type="hidden" name="id_permohonan" class="form-control" value="<?= $id_pemilik ?>">
                <input type="text" class="form-control" name="id_fungsi_bgnya" id="id_fungsi_bgnya" value="<?= $id_fungsi_bg ?>" />
            </div>
            <div class="col-md-12 ">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama Pemilik / Perusahaan<span class="required">* </span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nama_pemilik" value="<?= $nm_pemilik ?>" placeholder="Nama Pemilik / Perusahaan" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Provinsi</label>
                        <div class="col-md-9">
                            <select name="nama_provinsi" id="nama_provinsi" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota(this.value)">
                                <option value="">-- Pilih Provinsi --</option>
                                <?php foreach ($daftar_provinsi->result() as $r) :
                                    $selected = $r->id_provinsi == $id_provinsi ? 'selected' : '';
                                ?>
                                    <option value="<?= $r->id_provinsi ?>" <?= $selected ?>><?= $r->nama_provinsi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 ">
                <div class="form-body">
                    <div class="form-group" id="nama_kabkota_toggle">
                        <label class="col-md-3 control-label">Kab/Kota</label>
                        <div class="col-md-9">
                            <select name="nama_kabkota" id="nama_kabkota" class="form-control select2me" data-placeholder="Select..." onchange="getkecamatan(this.value)">
                                <option value="">-- Pilih Kabupaten / Kota --</option>
                                <?php foreach ($daftar_kabkota->result() as $r) :
                                    $selected = $r->id_kabkot == $id_kabkota ? 'selected' : '';
                                ?>
                                    <option value="<?= $r->id_kabkot ?>" <?= $selected ?>><?= $r->nama_kabkota ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 ">
                <div class="form-body">
                    <div class="form-group" id="nama_kecamatan_toggle">
                        <label class="col-md-3 control-label">Kecamatan</label>
                        <div class="col-md-9">
                            <select name="nama_kecamatan" id="nama_kecamatan" class="form-control select2me" data-placeholder="Select...">
                                <option value="">-- Pilih Kecamatan --</option>
                                <?php foreach ($daftar_kecamatan->result() as $r) :
                                    $selected = $r->id_kecamatan == $id_kecamatan ? 'selected' : '';
                                ?>
                                    <option value="<?= $r->id_kecamatan ?>" <?= $selected ?>><?= $r->nama_kecamatan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 ">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Alamat Pemilik / Perusahaan<span class="required">* </span></label>
                        <div class="col-md-9">
                            <textarea type="text" name="alamat_pemohon" class="form-control" placeholder="Alamat Pemilik / Perusahaan"><?= $alamat ?></textarea>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12 ">
                <hr>
                <h4 class="caption-subject font-red bold uppercase" align="center">Data Bangunan Gedung</h4>
            </div>

            <div class="col-md-12 ">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama Bangunan<span class="required">* </span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?= $nm_bgn ?>" name="nama_bangunan" placeholder="Nama Bangunan" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 ">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Provinsi<span class="required">* </span></label>
                        <div class="col-md-9">
                            <select name="nama_provinsi_bg" id="nama_provinsi_bg" class="form-control select2me" data-placeholder="Select..." onchange="getkabkota_bg(this.value)" disabled="true">
                                <<option value="">-- Pilih Provinsi --</option>
                                    <?php foreach ($daftar_provinsi_bg->result() as $r) :
                                        $selected = $r->id_provinsi == $id_prov_bgn ? 'selected' : '';
                                    ?>
                                        <option value="<?= $r->id_provinsi ?>" <?= $selected ?>><?= $r->nama_provinsi ?></option>
                                    <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="form-body">
                    <div class="form-group" id="nama_kabkota_toggle">
                        <label class="col-md-3 control-label">Kab/Kota<span class="required">* </span></label>
                        <div class="col-md-9">
                            <select name="nama_kabkota_bg" id="nama_kabkota_bg" class="form-control select2me" data-placeholder="Select..." onchange="getkecamatan_bg(this.value)" disabled="true">
                                <option value="">-- Pilih Kabupaten / Kota --</option>
                                <?php foreach ($daftar_kabkota_bg->result() as $r) :
                                    $selected = $r->id_kabkot == $id_kabkot_bgn ? 'selected' : '';
                                ?>
                                    <option value="<?= $r->id_kabkot ?>" <?= $selected ?>><?= $r->nama_kabkota ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="form-body">
                    <div class="form-group" id="nama_kecamatan_toggle">
                        <label class="col-md-3 control-label">Kecamatan<span class="required">* </span></label>
                        <div class="col-md-9">
                            <select name="nama_kecamatan_bg" id="nama_kecamatan_bg" class="form-control select2me" data-placeholder="Select...">
                                <option value="">-- Pilih Kecamatan --</option>
                                <?php foreach ($daftar_kecamatan_bg->result() as $r) :
                                    $selected = $r->id_kecamatan == $id_kec_bgn ? 'selected' : '';
                                ?>
                                    <option value="<?= $r->id_kecamatan ?>" <?= $selected ?>><?= $r->nama_kecamatan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Alamat Bangunan Gedung<span class="required">* </span></label>
                        <div class="col-md-9">
                            <textarea type="text" class="form-control" name="alamat_bg" placeholder="Alamat Bangunan" autocomplete="off"><?php echo set_value('alamat_bg', $almt_bgn) ?></textarea>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12 ">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Jenis Konsultasi <span class="required">* </span></label>
                        <div class="col-md-9">
                            <select class="form-control select2me" name="id_jenis_bg" id="id_jenis_bg" onchange="getjenisPermohonan(this.value)" disabled="true">
                                <option value="">--Pilih--</option>
                                <?php foreach ($get_konsultasi->result() as $r) :
                                    $selected = $r->id == $id_jenis_permohonan ? 'selected' : '';
                                ?>
                                    <option value="<?= $r->id ?>" <?= $selected ?>><?= $r->nm_konsultasi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div id="Kolektif" style="display: none;">
                <div class="col-md-12 ">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tipe Permohonan Kolektif<span class="required">* </span></label>
                            <div class="col-md-9">
                                <select class="form-control select2me" name="id_kolektif" id="id_kolektif" onchange="tpk(this.value)" disabled="true">
                                    <option value="">--Pilih--</option>
                                    <option value="1">Induk</option>
                                    <option value="2">Tunggal/Pemisahan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="KolektifInduk" style="display: none;">
                <div class="col-md-12 ">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tipe Bangunan<span class="required">* </span></label>
                            <div class="col-md-9">
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="tipeA" placeholder="36/45/102/..." autocomplete="off" value="">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="tipeB" placeholder="36/45/102/..." autocomplete="off" value="">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="tipeC" placeholder="36/45/102/..." autocomplete="off" value="">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="tipeD" placeholder="36/45/102/..." autocomplete="off" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Jumlah Unit<span class="required">* </span></label>
                            <div class="col-md-9">
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="unitA" placeholder="123" autocomplete="off" value="">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="unitB" placeholder="123" autocomplete="off" value="">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="unitC" placeholder="123" autocomplete="off" value="">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="unitD" placeholder="123" autocomplete="off" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="display: none;">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Luas Bangunan <i>(m<sup>2</sup>)</i><span class="required">* </span></label>
                            <div class="col-md-9">
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="luasA" placeholder="123.45" autocomplete="off" value="">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="luasB" placeholder="123.45" autocomplete="off" value="">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="luasC" placeholder="123.45" autocomplete="off" value="">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="luasD" placeholder="123.45" autocomplete="off" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tinggi Bangunan <i>(m)</i><span class="required">* </span></label>
                            <div class="col-md-9">
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="tinggiA" placeholder="6.9" autocomplete="off" value="">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="tinggiB" placeholder="6.9" autocomplete="off" value="">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="tinggiC" placeholder="6.9" autocomplete="off" value="">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="tinggiD" placeholder="6.9" autocomplete="off" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="col-md-12 ">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Fungsi Bangunan<span class="required">* </span></label>
                            <div class="col-md-9">
                                <select name="id_fungsi_bg" id="id_fungsi_bg" onchange="set_pemanfaatan(this.value)" class="form-control parent_selection" disabled="true">
                                    <option value="">--Pilih--</option>
                                    <?php foreach ($get_fungsi->result() as $r) :
                                        $selected = $r->id_fungsi_bg == $id_fungsi_bg ? 'selected' : '';
                                    ?>
                                        <option value="<?= $r->id_fungsi_bg ?>" <?= $selected ?>><?= $r->fungsi_bg ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Jenis Bangunan<span class="required">* </span></label>
                            <div class="col-md-9">
                                <select name="jns_bangunan" id="child_selection" class="form-control">
                                    <option><?= (isset($jns_bangunan) ? $jns_bangunan : '--Pilih--'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Luas Bangunan <i>(m<sup>2</sup>)</i><span class="required">* </span></label>
                            <div class="col-md-9">
                                <input step="any" type="number" class="form-control" value="<?= $luas_bgn ?>" name="luas_bgn" id="luas_bgn" onblur="cek()" placeholder="123.45" autocomplete="off">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tinggi Bangunan <i>(m)</i><span class="required">* </span></label>
                            <div class="col-md-9">
                                <input step="any" type="number" class="form-control" value="<?= $tinggi_bgn ?>" name="tinggi_bgn" onblur="cek()" placeholder="6.9" autocomplete="off">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Jumlah Lantai Bangunan<span class="required">* </span></label>
                            <div class="col-md-9">
                                <input step="any" type="number" class="form-control" value="<?= $jml_lantai ?>" name="lantai_bg" onblur="cek()" placeholder="0 - 9" autocomplete="off">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Luas Basement Bangunan <i>(m<sup>2</sup>)</i></label>
                            <div class="col-md-9">
                                <input step="any" type="number" class="form-control" value="<?= $luas_basement ?>" name="luas_basement" placeholder="123.45" autocomplete="off">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Jumlah Lantai Basement Bangunan</label>
                            <div class="col-md-9">
                                <input step="any" type="number" class="form-control" value="<?= $lapis_basement ?>" name="lapis_basement" placeholder="0 - 9" autocomplete="off">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Begin Untuk Prasarana -->

            <!-- End Untuk Prasarana-->

            <div class="col-md-12 ">
                <div class="form-body">
                    <div class="form-group">
                        <br>
                        <input type="submit" value="Simpan Perubahan" class="form-control btn blue">
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('.select2me').select2({
            placeholder: "Select",
            allowClear: true
        });
    });
</script>