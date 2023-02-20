<style>
    table,
    th {
        text-align: center;
    }

    .modal.fade.in {
        top: 20%;
    }

    .modal-pemohon.fade.in {
        top: 50%;
    }

    .form-wizard .steps>li>a.step>.desc {
        display: block;
        font-size: 16px;
        font-weight: 300;
    }
</style>
<div class="row">
    <?php $this->load->view('header_penilaian') ?>
    <div class="col-md-12">
        <div class="portlet light " id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red"></i>
                    <span class="caption-subject font-red bold uppercase">Perbaikan Dokumen Teknis</span>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-wizard">
                    <div class="form-body">
                        <div class="tab-content">
                            <!-- alert -->
                            <!-- panel 1 -->
                            <div class="tab-pane active" id="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- BEGIN Portlet PORTLET-->
                                        <div class="portlet box blue">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <?= $keterangan ?>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <form action="#" role="form" method="post" class="step-wizard" id="formOne" enctype="multipart/form-data">
                                                    <input type="hidden" id='csrf_id' name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                    <div class="form-body">
                                                        <table class="table table-bordered table-striped table-hover">
                                                            <tbody>
                                                                <tr>
                                                                    <th rowspan="2" class="info"><center>No</center></th>
                                                                    <th colspan="3" class="info"><center>Persyaratan</center></th>
                                                                    <th colspan="2" class="danger">
                                                                        <center>Perbaikan dari TIM TPT/TPA</center>
                                                                    </th>
                                                                    <th rowspan="2" class="info">
                                                                        <center>Aksi</center>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="info" colspan="3">Detail</th>
                                                                    <th class="danger">Kesesuaian</th>
                                                                    <th class="danger">
                                                                        <center>Catatan &amp; Dokumen</center>
                                                                    </th>
                                                                </tr>
                                                                <?php $no = 1;
                                                                foreach ($persyaratan as $r) :
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $no++ ?></td>
                                                                        <td colspan="3" style="text-align:left;"><?php echo $r['nm_dokumen'] ?></td>
                                                                        <td>
                                                                            <?php
                                                                            $cek1 = $r['kesesuaian'];
                                                                            $catatan1 = $r['catatan'];
                                                                            $berkas_file1 = $r['berkas'];
                                                                            $css1 = $cek1 != 0 && $cek1 != NULL ? 'none' : 'block';
                                                                            ?>
                                                                            <input type="hidden" name="id_konsultasi" id="idKonsultasi" value="<?php echo $id_konsultasi ?>">

                                                                            <input type="hidden" name="id_jenis" id="idJenis" value="<?= $r['id_jenis_permohonan'] ?>">
                                                                            <input type="hidden" name="id_jenis_syarat" id="idSyarat" class="data-syarat" value="<?= $r['id_detail_jenis_persyaratan'] ?>">
                                                                            <span class="badge badge-danger"> Tidak Sesuai <i class="fa fa-times"></i></span>
                                                                        </td>
                                                                        <td>
                                                                            <textarea cols="40" name="catatan[]" style="resize: none;" rows="3" class="form-control note-persyaratan" style="width:200px; height:50px;" readonly><?php echo $catatan1 ?></textarea>
                                                                        </td>
                                                                        <td>
                                                                            <?php if ($berkas_file1 != '') :
                                                                                $filename = FCPATH . "/Dekill/Requirement/$berkas_file1";
                                                                                $dir = '';
                                                                                if (file_exists($filename)) {
                                                                                    $dir = base_url('Dekill/Requirement/' . $berkas_file1);
                                                                                } else {
                                                                                    $dir = base_url('file/Konsultasi/' . $id . '/Dokumen/' . $berkas_file1);
                                                                                }
                                                                            ?>
                                                                                <a href="javascript:void(0);" id="lihatBerkas" data-val="<?= $r['id_detail'] ?>" class="btn btn-primary lihat-berkas" onClick="javascript:popWin('<?php echo $dir; ?>')"><i class="fa fa-eye"></i> Lihat Berkas</a>
                                                                            <?php endif; ?>
                                                                            &nbsp;
                                                                            <a href="javascript:void(0);" class="btn btn-warning ubah-berkas" data-id="<?= $r['id_detail'] ?>" id="ubahBerkas" onclick="clickModal(<?= $id_konsultasi ?>,<?= $r['id_detail_jenis_persyaratan'] ?>,<?= $r['id_detail'] ?>)" style="display:<?= $css1 ?>;"><i class="fa fa-edit"></i> Ubah Berkas</a>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <button type="submit" name="submit" class="btn green btn-block save-step" id="saveStep"><i class="fa fa-save"></i> Selesai Perbaikan</button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <a href="<?= site_url('Konsultasi') ?>" class="btn btn-info btn-block btn-back"><i class="fa fa-arrow-left"></i> Kembali</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- END Portlet PORTLET-->
                                    </div>
                                </div>

                            </div>
                            <!-- endpane 1 -->

                        </div>
                    </div>

                </div>
            </div>
            <div id="ajax" class="modal container fade" data-width="30%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-content">
                    <form method="POST" action="<?php echo site_url('Konsultasi/SimpanStatus') ?>">
                        <div class="modal-body">
                            <div class="caption-message"></div>
                            <img src="<?php echo base_url() ?>assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
                            <span class="text-loader"> &nbsp;&nbsp;Loading... </span>
                            <div class="list-group">
                                <div class="row">
                                    <div class="col-md-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="idStatusKonsultasi" value="">
                            <button type="submit" id="btnNext" class="btn green btn-next ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-save"></i> Simpan</span></button>
                            <button type="button" data-dismiss="modal" class="btn blue btn-repeat"><i class="fa fa-sign-out"></i> Cek Ulang Berkas</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
    <form action="#" role="form" method="post" id="changeBerkas" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn-close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Ubah Berkas</h4>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <p style="text-align:center;color:red;"> Note: Harap Memasukan Lampiran Menggunakan Format PDF</p>
                    <div class="form-group">
                        <input type="hidden" name="dataKonsultasi" id="dataKonsultasi">
                        <input type="hidden" name="dataId" id="dataId">
                        <input type="hidden" name="dataVal" id="dataVal">
                        <label class="col-md-3 control-label">Lampiran</label>
                        <div class="col-md-9">
                            <input type="file" id="inputFile" name="berkas">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="form-submit" class="btn green ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label"><i class="fa fa-save"></i> Simpan</span></button>
                <button type="button" data-dismiss="modal" class="btn red btn-cancel"><i class="fa fa-sign-out"></i> Batal</button>
            </div>
        </div>
        <?php echo form_close(); ?>
</div>
<script>
    var segment = '<?= $this->uri->segment(3) ?>';
    var getStep;
    var returnFail;
    function getFailFunc(response) {
        returnFail = response;
    }
    function getStepFunction(response) {
        getStep = response;
    }

    $(document).ready(function() {


    });

    function popWin(x) {
        url = x;
        swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
        swin.focus();
    }

    // Dealing with Textarea Height
    function calcHeight(value) {
        let numberOfLineBreaks = (value.match(/\n/g) || []).length;
        // min-height + lines x line-height + padding + border
        let newHeight = 20 + numberOfLineBreaks * 20 + 12 + 2;
        return newHeight;
    }

    const textArea = document.querySelectorAll(".resize-ta");
    for (let i = 0; i < textArea.length; i++) {
        textArea[i].addEventListener("keyup", () => {
            textArea[i].style.height = calcHeight(textArea[i].value) + "px";
        });
    }

    function clickModal(z, a, b) {
        $('#responsive').modal('show');
        $('#dataKonsultasi').val(z);
        $('#dataId').val(a);
        $('#dataVal').val(b);
    }

    $('#responsive').on('hidden.bs.modal', function() {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
    });

    $("#changeBerkas").submit(function(e) {
        var l = Ladda.create(document.querySelector('#form-submit'));
        l.start();
        e.preventDefault();
        var dataVal = $('#dataVal').val();
        $(".btn-cancel").attr("disabled", true);

        $(".btn-close").css("display", "none");

        var formData = new FormData(this);
        formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
        $.ajax({
            type: "POST",
            url: `${base_url}Konsultasi/simpan_berkas`,
            data: formData,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            success: function(response) {
                if (response.status == false) {
                    setTimeout(function() {
                        showToast(response.message, 15000, response.type);
                        l.stop();
                        $(".btn-cancel").removeAttr("disabled");
                        $(".btn-close").css("display", "block")
                    }, 1500);
                    location.reload();
                } else {
                    setTimeout(function() {
                        showToast(response.message, 15000, response.type);
                        l.stop();
                        $(".btn-cancel").removeAttr("disabled");
                        $(".btn-close").css("display", "block")
                        $('#responsive').modal('hide');
                        $(`a.lihat-berkas[data-val=${dataVal}]`).attr(`onClick`, `javascript:popWin('${base_url}${response.result}')`);
                    }, 1500);
                    location.reload();
                }
            }
        });
    });



    // $('.save-step').click(function(e) {
    $(document).on('submit', 'form.step-wizard', function(e) {
        e.preventDefault();
        var $form = $(this);
        var syr = $form.find('.data-syarat');
        var syarat = $form.find('#idSyarat').val(); // example
        var jenis = $form.find('#idJenis').val();
        var dataKonsultasi = $form.find('#idKonsultasi').val();
        var valueArray = $form.find(".data-syarat").map(function() {
            return this.value;
        }).get();

        let uniqueArray = valueArray.filter((item, pos, self) => self.indexOf(item) == pos);

        var cb = [],
            post_cb = []

        $form.find('#idJenis')
        // syarat = $('#idSyarat').val();
        $.each($($form.find('input[type=checkbox]:checked')), function() {
            var id = $(this).data('id'),
                val = $(this).data('val')
            cb.push(id + ' -> ' + val);
            post_cb.push({
                'id': id,
                'val': val
            });
        });

        $.ajax({
            type: 'POST',
            url: `${base_url}Konsultasi/SimpanRevisi`,
            data: {
                data: post_cb,
                syarat: syarat,
                jenis: jenis,
                dataKonsultasi: dataKonsultasi
            },
            beforeSend: function() {
                $(".loading").css("display", "block");
                $(".text-loader").css("display", "block");
                $(".btn-close").css("display", "none");
                $(".list-group").css("display", "none");
                $(".caption-message").css("display", "none");
                $(".btn-next").css("display", "none");
                $(".btn-repeat").css("display", "none");
                $(".btn-maintain").css("display", "none");
            },
            success: function(response) {
                let fail = response.not;
                setTimeout(function() {
                    if (response.not > 0) {
                        $(".btn-repeat").css("display", "inline-block");
                        $(".btn-maintain").css("display", "inline-block");
                    } else {
                        $(".btn-repeat").css("display", "none");
                    }
                    $('.btn-maintain').click(function(e) {
                        e.preventDefault();
                        $('#pemohon').modal('show');
                        $('#noKonsultasi').val(segment);
                    });
                    $(".list-group").css("display", "block");
                    $(".btn-close").css("display", "block");
                    $(".loading").css("display", "none");
                    $(".text-loader").css("display", "none");
                    $(".caption-message").css("display", "block");
                    let result = response.result;
                    const message = $('.caption-message');
                    let sts = 'blue';
                    let msgRes = 'Konfirmasi Revisi Dokumen';
                    message.html(`<h4 align="center" class="caption-subject font-${sts} bold uppercase">${msgRes}</h4>`);
                    const res = $('.data-kesesuaian');
                    $(".btn-next").css("display", "inline-block");
                    $(".btn-maintain").css("display", "inline-block");
                    $(".btn-repeat").css("display", "inline-block");
                    $("#idStatusKonsultasi").val(dataKonsultasi);
                }, 1500);
                $('#ajax').modal('show');
                getFailFunc(fail);
            }
        });
    });


    function showToast(message, timeout, type) {
        type = (typeof type === 'undefined') ? 'info' : type;
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": timeout,
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr[type](message);
    }
</script>