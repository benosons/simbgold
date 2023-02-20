<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Tambah Data Tanah</h4>
</div>
<div class="modal-body form">
    <form action="<?php echo site_url('PerubahanData/saveTanah'); ?>" class="form-horizontal" role="form" method="post" id="FormTambahTanah" enctype="multipart/form-data">
        <div class="portlet-body form">
            <div class="form-body">
                <br>
                <input type="hidden" class="form-control" value="<?= (isset($DataTanah->id_detail) ? $DataTanah->id_detail : ''); ?>" name="id_detail" >
                
                <input type="hidden" class="form-control" value="<?= (isset($DataTanah->id) ? $DataTanah->id : ''); ?>" name="id" >
                <input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                <select name="id_dokumen" id="id_dokumen" class="form-control" onchange="">
                                    <option value="">Pilih</option>
                                    <option value="1" <?= ($DataTanah->id_dokumen == 1 ? 'selected' : ''); ?>>Sertifikat</option>
                                    <option value="2" <?= ($DataTanah->id_dokumen == 2 ? 'selected' : ''); ?>>Akte Jual Beli</option>
                                    <option value="3" <?= ($DataTanah->id_dokumen == 3 ? 'selected' : ''); ?>>Girik</option>
                                    <option value="4" <?= ($DataTanah->id_dokumen == 4 ? 'selected' : ''); ?>>Petuk</option>
                                    <option value="5" <?= ($DataTanah->id_dokumen == 5 ? 'selected' : ''); ?>>Bukti Lain - Lain</option>
                                </select>
                                <label for="form_control_1">Jenis Dokumen Kepemilikan Data Tanah</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                <input class="form-control" id="nomor_dokumen"  value="<?= (isset($DataTanah->no_dok) ? $DataTanah->no_dok : ''); ?>"  name="nomor_dokumen" type="text" placeholder="0-9 / A-Z" autocomplete="off">
                                <label for="form_control_1">No. Dokumen Data Tanah</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input class="form-control date-picker" type="date" id="tgl_terbit_dokumen" name="tgl_terbit_dokumen" value="<?= (isset($DataTanah->tanggal_dok) ? $DataTanah->tanggal_dok : ''); ?>" data-date-format="yyyy-mm-dd" autocomplete="off">
                                <label for="form_control_1">Tgl. Terbit Dokumen</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                <input class="form-control" id="luas_tanah" name="luas_tanah" type="text" value="<?= (isset($DataTanah->luas_tanah) ? $DataTanah->luas_tanah : ''); ?>" placeholder="Luas Tanah 00.00" autocomplete="off">
                                <label for="form_control">Luas Tanah (<i> meter<sup> 2 </sup></i>)</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                <select name="hat" id="hat" class="form-control" onchange="">
                                    <option value="">Pilih</option>
                                    <option value="1" <?= ($DataTanah->hat = 1 ? 'selected' : ''); ?>>Hak Milik</option>
                                    <option value="2" <?= ($DataTanah->hat = 2 ? 'selected' : ''); ?>>Hak Pakai</option>
                                    <option value="3" <?= ($DataTanah->hat = 3 ? 'selected' : ''); ?>>Hak Pengelolaan</option>
                                    <option value="4" <?= ($DataTanah->hat = 4 ? 'selected' : ''); ?>>Hak Guna Bangunan</option>
                                    <option value="5" <?= ($DataTanah->hat = 5 ? 'selected' : ''); ?>>Hak Guna Usaha</option>
                                    <option value="6" <?= ($DataTanah->hat = 6 ? 'selected' : ''); ?>>Hak Wakaf</option>
                                </select>
                                <label for="form_control_1">Hak Kepemilikan Atas Tanah</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                <input class="form-control" id="atas_nama" name="atas_nama" value="<?= (isset($DataTanah->atas_nama_dok) ? $DataTanah->atas_nama_dok : ''); ?>" type="text" placeholder="Nama Pemegang Hak Atas Tanah" autocomplete="off">
                                <label for="form_control">Nama Pemilik Hak Atas Tanah</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                <input type="text" class="form-control" value='<?= (isset($dataTanah->lokasi_tanah) ? $dataTanah->lokasi_tanah :  $DataBangunan->almt_bgn . " Kec. " . $DataBangunan->nama_kecamatan . ", " . ucwords(strtolower($DataBangunan->nama_kabkota)) . ", Prov. " . $DataBangunan->nama_provinsi); ?>' rows="1" placeholder="Lokasi Tanah" id="lokasi_tanah" name="lokasi_tanah" readonly>
                                <label for="form_control_1">Alamat Lokasi Tanah</label>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                <input style="display: none;" name="dir_file_tan" id="dir_file_tan" onchange='coktan()'>
                                <input type="file" class="form-control" name="d_file_tan" id="d_file_tan" accept="application/pdf" onchange='coktan()'>
                                <label for="form_control_1">File Data Kepemilikan Tanah</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                <select name="hat2" id="hat2" class="form-control" onclick="set_status_izin_pemanfaatan(this.value)">
                                    <option value="">Pilih</option>
                                    <option value="1"<?= ($DataTanah->status_phat = 1 ? 'selected' : ''); ?>>YA</option>
                                    <option value="2"<?= ($DataTanah->status_phat = 2 ? 'selected' : ''); ?>>Tidak</option>
                                </select>
                                <label for="form_control_1">Izin pemanfaatan dari pemegang hak atas tanah</label>
                            </div>
                        </div>
                    </div>
                    <div id="izinjing" style="display: none;">
                        <h3 class="title">&nbsp;</h3>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                    <input class="form-control" id="no_dok_izin_pemanfaatan" name="no_dok_izin_pemanfaatan" value="<?= (isset($DataTanah->no_dokumen_phat) ? $DataTanah->no_dokumen_phat : ''); ?>" type="text" placeholder="0-9 / A-Z" autocomplete="off">
                                    <label for="form_control_1">Nomor Dokumen Izin Pemanfaatan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input class="form-control date-picker" type="date" id="tgl_terbit_phat" name="tgl_terbit_phat"  value="<?= (isset($DataTanah->tgl_terbit_phat) ? $DataTanah->tgl_terbit_phat : ''); ?>" />
                                    <label for="form_control_1">Tanggal Terbit Izin Pemanfaatan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                    <input class="form-control" id="nama_penerima_kuasa" name="nama_penerima_kuasa" value="<?= (isset($DataTanah->nama_penerima_phat) ? $DataTanah->nama_penerima_phat : ''); ?>"  type="text" placeholder="Nama Penerima Izin Pemanfaatan" autocomplete="off">
                                    <label for="form_control">Nama Penerima Izin Pemanfaatan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                    <input style="display: none;" name="dir_file_phat" id="dir_file_phat" onchange='cokphat()'>
                                    <input type="file" class="form-control" name="d_file_phat" id="d_file_phat" accept="application/pdf" onchange='cokphat()'>
                                    <label for="form_control_1">Berkas Izin Pemanfaatan</label>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(function() {
		// Setup form validation on the #register-form element
		$("#FormTambahTanah").validate({
			// Specify the validation rules
			rules: {
				id_dokumen: "required",
				nomor_dokumen: "required",
				tgl_terbit_dokumen: "required",
				luas_tanah: "required",
				hat2: "required",
				hat: "required",
				atas_nama: "required",
				lokasi_tanah: "required",
				d_file_tan: "required",
			},
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			unhighlight: function(element) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			},
			errorClass: 'help-block',

			// Specify the validation error messages
			messages: {
				id_dokumen: "",
				nomor_dokumen: "",
				tgl_terbit_dokumen: "",
				luas_tanah: "",
				hat2: "",
				hat: "",
				atas_nama: "",
				lokasi_tanah: "",
				d_file_tan: "",
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	});
</script>