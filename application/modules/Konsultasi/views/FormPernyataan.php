<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">Data Konsultasi</div>
            </div>
            <div class="portlet box blue">
                <div class="portlet-body form">
                    <form class="form-horizontal">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Nama Permohonan :</label>
                                        <div class="col-md-8">
                                             <p class="form-control-static"><?php echo $DataBangunan->nm_konsultasi; ?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Nama Pemilik :</label>
                                        <div class="col-md-8">
                                            <p class="form-control-static"><?php echo $DataPemilik->nm_pemilik; ?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Alamat Pemilik Bangunan :</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                <?php echo $DataPemilik->alamat; ?>, Kec. <?php echo $DataPemilik->nama_kecamatan; ?>, <?php echo ucwords(strtolower($DataPemilik->nama_kabkota)); ?>, Prov. <?php echo $DataPemilik->nama_provinsi; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Lokasi Bangunan Gedung :</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                <?php echo $DataBangunan->almt_bgn; ?>, Kec. <?php echo $DataBangunan->nama_kecamatan; ?>, <?php echo ucwords(strtolower($DataBangunan->nama_kabkota)); ?>, Prov. <?php echo $DataBangunan->nama_provinsi; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption">Konfirmasi Pernyataan Permohonan</div>
                    </div>
                    <input type="hidden" class="form-control" value="<?php echo set_value('id', (isset($id) ? $id : '')) ?>" name="id" placeholder="id" autocomplete="off">
                    <form action="<?php echo site_url('Konsultasi/saveDataPernyataan'); ?>" class="form-horizontal" role="form" method="post" id="FormPernyataan">
                        <input type="text" style="display: none;" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">            	
                        <div class="note note-warning">
                            <h4 class="font-blue">
                                <b>Sebelum anda mengkonfirmasi, Mohon memperhatikan informasi berikut:</b><br></h4>
                            <h5 class="font-blue"><b>
                                    - Data yang anda berikan adalah benar dan dapat dipertanggungjawabkan.<br>
                                    - Anda dapat melengkapi data persyaratan dengan cara diunggah melalui situs SIMBG<br>
                                    - Dokumen harus dilengkapi dalam waktu 20 hari terhitung mulai tanggal pendaftaran.<br>
                                    - Apabila terjadi kesalahan data setelah dilakukan konfirmasi, Anda dapat memperbaikinya setelah dikembalikan oleh Dinas Teknis<br>
                            </h5></b>
                            <hr>
                            <b>
                                <h4 class="font-blue">Berdasarkan konfirmasi setuju yang saya nyatakan:
                            </b><br></h4>
                            <h5 class="font-blue"><b>
                                    - Seluruh data dalam berkas/dokumen yang telah saya unggah dan isi, serta saya sampaikan adalah benar.<br>
                                    - Data yang saya berikan tunduk pada peraturan perundang-undangan.<br>
                                    - Apabila di kemudian hari terjadi kesalahan terhadap data yang saya sampaikan, maka saya bersedia menerima sanksi sesuai peraturan perundang-undangan.<br>
                            </h5></b>
                        </div>
                        <div class="col-md-12 note note-success">
                             <left>
                                <h4><b><input type="checkbox" name="dir_1" id="dir_1" value="1"> Pernyataan mematuhi KRK/KKPR</h4></b>
                            </left>
                            <left>
                                <h4><b><input type="checkbox" name="dir_2" id="dir_2" value="1"> Pernyataan menggunakan Pelaksana Konstruksi</h4></b>
                            </left>
                            <left>
                                <h4><b><input type="checkbox" name="dir_3" id="dir_3" value="1"> Pernyataan menggunakan Pengawas/ Manajemen Konstruksi bersertifikat</h4></b>
                            </left>
                            <?php if($DataBangunan->id_jenis_permohonan !='4'){ ?>
                            <left>
                                <h4><b><input type="checkbox" name="dir_4" id="dir_4" value="1"> Pernyataan bahwa tanah tidak dalam status sengketa</h4></b>
                            </left>
                            <left>
                                <h4><b><input type="checkbox" name="dir_5" id="dir_5" value="1"> Pernyataan memenuhi ketentuan pokok tahan gempa</h4></b>
                            </left>
                            <?php } ?>
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
            <div class="row">
                <div class="form-group">
                    <center>
                        <div class="col-md-6">
                            <span class="input-group-btn">
								<?php if($DataBangunan->id_jenis_permohonan !='3' && $DataBangunan->id_jenis_permohonan !='4' && $DataBangunan->id_jenis_permohonan !='5' && $DataBangunan->id_jenis_permohonan !='12' && $DataBangunan->id_jenis_permohonan !='21' && $DataBangunan->id_jenis_permohonan !='34' && $DataBangunan->id_jenis_permohonan !='35' && $DataBangunan->id_jenis_permohonan !='36'){ ?>
                                <button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>Konsultasi/FormDataMEP/<?php echo $this->uri->segment(3); ?>';return false;">Kembali</button>
								<?php } else { ?>
								<button class="btn green" onClick="window.location.href = '<?php echo base_url(); ?>Konsultasi/FormDataTeknis/<?php echo $this->uri->segment(3); ?>';return false;">Kembali</button>	
								<?php } ?>
							</span>
                        </div>
                        <div class="col-md-6">
                            <span class="input-group-btn"></span>
                        </div>
                    </center>
                </div>
            </div><br>
        </div>
    </div>
</div>