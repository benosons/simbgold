<div class="col-md-12">

    <div class="portlet light" id="portletHeader">
        <div class="portlet-title">
            <div class="caption col-md-4 col-md-offset-5">
                <span class="caption-subject font-blue bold uppercase no-konsultasi">
                </span>
            </div>
        </div>

        <div class="portlet-body">
            <div class="note note-info">

                <div class="row static-info">
                    <div class="col-md-4 name">Nama Pemilik</div>
                    <div class="col-md-8 value nm-pemilik"></div>
                </div>

                <div class="row static-info">
                    <div class="col-md-4 name">Alamat Pemilik</div>
                    <div class="col-md-8 value alamat-pemilik"></div>
                </div>

                <div class="row static-info">
                    <div class="col-md-4 name">Jenis Konsultasi</div>
                    <div class="col-md-8 value jenis-konsultasi"></div>
                </div>

                <div class="row static-info">
                    <div class="col-md-4 name">Lokasi Bangunan Gedung</div>
                    <div class="col-md-8 value alamat-bangunan"></div>
                </div>

                <div class="input-value">
                    <input type="hidden" name="id_provinsi_pemilik" id="idProvinsiPemilik" placeholder="">
                    <input type="hidden" name="id_kabkota_pemilik" id="idKabkotaPemilik" placeholder="">
                    <input type="hidden" name="id_kecamatan_pemilik" id="idKecamatanPemilik" placeholder="">
                    <input type="hidden" name="id_kelurahan_pemilik" id="idKelurahanPemilik" placeholder="">
                    <input type="hidden" name="id_provinsi_bangunan" id="idProvinsiBangunan" placeholder="">
                    <input type="hidden" name="id_provinsi_bangunan" id="idKabkotaBangunan" placeholder="">
                    <input type="hidden" name="id_kecamatan_bangunan" id="idKecamatanBangunan" placeholder="">
                    <input type="hidden" name="id_kelurahan_bangunan" id="idKelurahanBangunan" placeholder="">
                    <input type="hidden" name="imb_bangunan" id="imbBangunan" placeholder="">
                    <input type="hidden" name="id_jenis_bg" id="idJenisBG" placeholder="">
                </div>

                <div class="fungsi-bangunan" style="display:none;">
                    <div class="row static-info">
                        <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
                        <div class="col-md-8 value fungsi-bangunan-gedung"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">Luas, Tinggi &amp; Jumlah Lantai</div>
                        <div class="col-md-8 value luas-tinggi-lantai"></div>
                    </div>
                </div>

                <div class="prasarana" style="display:none;">
                    <div class="row static-info">
                        <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
                        <div class="col-md-8 value jns-prasarana"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">Luas dan Tinggi </div>
                        <div class="col-md-8 value luas-tinggi-prasarana"></div>
                    </div>
                </div>

                <div class="bangunan-kolektif" style="display:none;">
                    <div class="row static-info">
                        <div class="col-md-4 name">Jenis Konsultasi Bangunan</div>
                        <div class="col-md-8 value">Bangunan Gedung Kolektif</div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">Data Bangunan Gedung Kolektif</div>
                        <div class="col-md-8 value">
                            <table class="table table-hover table-bordered dt-responsive wrap">
                                <thead>
                                    <tr>
                                        <th>Tipe</th>
                                        <th>Luas (m<sup>2</sup>)</th>
                                        <th>Tinggi</th>
                                        <th>Lantai</th>
                                        <th>Jumlah Unit</th>
                                    </tr>
                                </thead>
                                <tbody id="tableKolektif"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">Total Luas Bangunan Kolektif</div>
                        <div class="col-md-8 value total-luas-kolektif"></div>
                    </div>
                </div>

                <div class="bangunan-spbu" style="display:none;">
                    <div class="row static-info">
                        <div class="col-md-4 name">Fungsi Bangunan Gedung</div>
                        <div class="col-md-8 value jns-prasarana"></div>
                    </div>
                    <div class="row static-info">
                        <div class="col-md-4 name">Luas dan Tinggi </div>
                        <div class="col-md-8 value luas-tinggi-spbu"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>