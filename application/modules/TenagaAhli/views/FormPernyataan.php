<?php
isset($tpa) ? $DataTpa = $tpa->row() : '';
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet box blue">
                <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption">
                            Konfirmasi Data
                        </div>
                    </div>
                    <input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($id) ? $id : '')) ?>" name="id" placeholder="id" autocomplete="off">
                    <form action="<?php echo site_url('TenagaAhli/savePernyataan'); ?>" class="form-horizontal" role="form" method="post" id="FormPernyataan">
                        <div class="note note-warning">
                            <h4 class="font-blue">
                                <b>Sebelum anda mengkonfirmasi, Mohon memperhatikan informasi berikut:</b><br></h4>
                            <h5 class="font-blue"><b>
                                    - Data yang anda berikan adalah benar dan dapat dipertanggungjawabkan.<br>
                            </h5></b>
                            <b>
                                <h4 class="font-blue">Berdasarkan konfirmasi setuju yang saya nyatakan:
                            </b><br></h4>
                            <h5 class="font-blue"><b>
                                    - Seluruh data dalam berkas/dokumen yang telah saya unggah dan isi, serta saya sampaikan adalah benar.<br>
                                    - Data yang saya berikan tunduk pada peraturan perundang-undangan.<br>
                                    - Apabila di kemudian hari terjadi kesalahan terhadap data yang saya sampaikan, maka saya bersedia menerima sanksi sesuai peraturan perundang-undangan.<br>
                            </h5></b>
                        </div>
                        <?php
                        $pernyataan = set_value('pernyataan', (isset($DataPemilik->pernyataan) ? $DataPemilik->pernyataan : ''));
                        if ($pernyataan == '1') {
                            echo '<h4 class="note note-success"><b>* Anda Telah Menyetujui Persyaratan Tersebut</b></h4>';
                        } else { ?>
                            <input style="display: none;" class="form-control" value="<?php echo set_value('id', (isset($id) ? $id : '')) ?>" name="id" placeholder="id" autocomplete="off">
                            <div class="form-group">
                                <div class="col-md-12 note note-success">
                                    <center>
                                        <h4><b><input type="checkbox" name="pernyataan" id="pernyataan" value="1"> Ceklis Jika Setuju</h4></b>
                                        <input type="submit" class="btn green" id="nyata" name="nyata" onClick="nyata()" value="Simpan">
                                    </center>
                                </div>
                            </div>
                        <?php } ?>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>