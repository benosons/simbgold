<div class="col-md-12">
    <div class="portlet light">
        <div class="portlet-title">
            <h4 align="center" class="caption-subject font-red bold uppercase">Data Pokok <?= $no_konsultasi ?></h4>
            <hr />
            <div class="row static-info">
                <div class="col-md-4 name">
                    Nama Pemilik
                </div>
                <div class="col-md-8 value">
                    <?= $nm_pemilik ?>
                </div>
            </div>
            <div class="row static-info">
                <div class="col-md-4 name">
                    Alamat Pemilik
                </div>
                <div class="col-md-8 value">
                    <?= (isset($alamat) ? $alamat : ''); ?>, Kec. <?= (isset($nama_kecamatan) ? $nama_kecamatan : ''); ?>, <?= (isset($nama_kabkota) ? ucwords(strtolower($nama_kabkota)) : ''); ?>, <?= (isset($nama_provinsi) ? $nama_provinsi : ''); ?>
                </div>
            </div>
            <div class="row static-info">
                <div class="col-md-4 name">
                    Jenis Konsultasi
                </div>
                <div class="col-md-8 value">
                    <?= $nm_konsultasi ?>
                </div>
            </div>
            <div class="row static-info">
                <div class="col-md-4 name">
                    Tanggal Verifikasi & <br> Batas Waktu Pelayanan
                </div>
                <div class="col-md-8 value">
                    <p class="font-red">25-02-2020 <i class="text-tot">sampai dengan</i> 04-03-2020<i class="text-tot">, ( hari kerja ) <br>terhitung dari tanggal verifikasi kelengkapan berkas</i></p>
                </div>
            </div>
            <div class="row static-info">
                <div class="col-md-4 name">
                    Lokasi Bangunan Gedung
                </div>
                <div class="col-md-8 value">
                    <?= (isset($almt_bgn) ? $almt_bgn : ''); ?>, Kec. <?= (isset($nama_kec_bg) ? $nama_kec_bg : ''); ?>, <?= (isset($nama_kabkota_bg) ? ucwords(strtolower($nama_kabkota_bg)) : ''); ?>, <?= (isset($nama_provinsi) ? $nama_provinsi : ''); ?>
                </div>
            </div>
            <div class="row static-info">
                <div class="col-md-4 name">
                    Fungsi Bangunan Gedung
                </div>
                <div class="col-md-8 value">
                    <?php echo set_value('fungsi_bg', (isset($fungsi_bg) ? $fungsi_bg : '')) ?> - <?php echo set_value('jns_bangunan', (isset($jns_bangunan) ? $jns_bangunan : '')) ?>
                </div>
            </div>
            <div class="row static-info">
                <div class="col-md-4 name">
                    Luas, Tinggi & Jumlah Lantai
                </div>
                <div class="col-md-8 value">
                    <?= (isset($luas_bgn) ? $luas_bgn : '') ?> m<sup>2</sup>, dengan tinggi <?= (isset($tinggi_bgn) ? $tinggi_bgn : '') ?> meter dan berjumlah <?= (isset($jml_lantai) ? $jml_lantai : '') ?> lantai.
                </div>
            </div>           
        </div>
    </div>
</div>