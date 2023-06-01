
var segment = segments;
$.ajax({
    method: 'POST',
    url: `${base_url}Inspeksi/cek_step`,
    data: {
        id: segment
    },
    success: function (response) {
        var wizard = $('#form_wizard_1').bootstrapWizard();
        wizard.bootstrapWizard('show', response.result);
        getStepFunction(response.result);
    }
});

var getStep;
var returnFail;

function getFailFunc(response) {
    returnFail = response;
}

function getStepFunction(response) {
    getStep = response;
}

$(document).ready(function () {
    $("#form_wizard_1").bootstrapWizard({
        nextSelector: ".btn-next",
        previousSelector: ".button-previous",
        onTabClick: function (e, r, t, i) {
            return !1
        },
        onNext: function (e, a, n) {
            let l = Ladda.create(document.querySelector('.btn-next')),
                wizard = $('#form_wizard_1').bootstrapWizard(),
                res,
                current = wizard.bootstrapWizard('currentIndex'),
                curr = getStep,
                nextStep = current + 1;
            l.start();
            setTimeout(function () {
                l.stop();
                $('#ajax').modal('hide');
            }, 1500);
            res = true
            $.ajax({
                type: "POST",
                data: {
                    step: nextStep,
                    dataVal: segment
                },
                url: `${base_url}inspeksi/save_step`,
                success: function (response) { }
            });
            return res;
        },
        onPrevious: function (e, r, a) { },
        onTabShow: function (e, r, t) {
            var i = r.find("li").length,
                a = t + 1,
                o = a / i * 100;
            $("#form_wizard_1").find(".progress-bar").css({
                width: o + "%"
            })
        }
    });



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

function clickModal(a, b) {
    $('#responsive').modal('show');
    $('#dataId').val(a);
    $('#dataVal').val(b);
}

$('#responsive').on('hidden.bs.modal', function () {
    $(this)
        .find("input,textarea,select")
        .val('')
        .end()
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();
});


$('.catatan-file').click(function (e) {
    $(".info-catatan").css("display", "none");
    $(".input-catatan").css("display", "block");
    $(".catatan-file").css("display", "none");
    $(".delete-catatan").css("display", "block");
});

$('.delete-catatan').click(function (e) {
    $(".info-catatan").css("display", "block");
    $(".input-catatan").css("display", "none");
    $(".catatan-file").css("display", "block");
    $(".delete-catatan").css("display", "none");
});

$('.berkas-file').click(function (e) {
    $(".info-berkas").css("display", "none");
    $(".input-berkas").css("display", "block");
    $(".berkas-file").css("display", "none");
    $(".delete-file").css("display", "block");
});

$('.delete-file').click(function (e) {
    $(".info-berkas").css("display", "block");
    $(".input-berkas").css("display", "none");
    $(".berkas-file").css("display", "block");
    $(".delete-file").css("display", "none");
});

$('.justifikasi-file').click(function (e) {
    $(".info-justifikasi").css("display", "none");
    $(".input-justifikasi").css("display", "block");
    $(".justifikasi-file").css("display", "none");
    $(".delete-justifikasi").css("display", "block");
});

$('.delete-justifikasi').click(function (e) {
    $(".info-justifikasi").css("display", "block");
    $(".input-justifikasi").css("display", "none");
    $(".justifikasi-file").css("display", "block");
    $(".delete-justifikasi").css("display", "none");
});



$('.back-button').click(function (e) {
    var isGood = confirm('Kembali Ke Tahap Sebelumnya?');
    if (isGood) {
        var wizard = $('#form_wizard_1').bootstrapWizard();
        wizard.bootstrapWizard('previous')
        let current = wizard.bootstrapWizard('currentIndex');
        $.ajax({
            type: "POST",
            data: {
                step: current,
                dataVal: segment
            },
            url: `${base_url}Inspeksi/save_step`,
            success: function (response) { }
        });
    }
});

$(document).on('submit', 'form.step-wizard', function (e) {
    e.preventDefault();
    var $form = $(this);

    $.ajax({
        type: 'POST',
        url: `${base_url}Inspeksi/simpan_inspeksi`,
        data: new FormData(this),
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        beforeSend: function () {
            $(".loading").css("display", "block");
            $(".text-loader").css("display", "block");
            $(".btn-close").css("display", "none");
            $(".list-group").css("display", "none");
            $(".caption-message").css("display", "none");
            $(".btn-next").css("display", "none");
            $(".btn-repeat").css("display", "none");
            $(".btn-maintain").css("display", "none");
        },
        success: function (response) {
            console.log(response);
            if (response.status == false) {
                showToast(response.message, 15000, response.type);
            } else {
                let fail = response.not;
                setTimeout(function () {
                    if (response.not > 0) {
                        $(".btn-repeat").css("display", "inline-block");
                        $(".btn-maintain").css("display", "inline-block");
                    } else {
                        $(".btn-repeat").css("display", "none");
                    }
                    $('.btn-maintain').click(function (e) {
                        e.preventDefault();
                        $('#pemohon').modal('show');
                        $('#noKonsultasi').val(segment);
                    });
                    $(".list-group").css("display", "block");
                    $(".btn-close").css("display", "block");
                    $(".loading").css("display", "none");
                    $(".text-loader").css("display", "none");
                    $(".caption-message").css("display", "block");
                    if (response.status == true) {
                        $(".btn-next").css("display", "inline-block");
                        let result = response.result;
                        const message = $('.caption-message');
                        message.html(`<h4 align="center" class="caption-subject font-green bold uppercase">Inspeksi Berhasil Diperiksa!</h4>`);
                        const res = $('#result');
                        res.empty();
                        result.forEach(obj => {
                            let status = obj.kesesuaian == 1 ? 'Sesuai <i class="fa fa-check"></i>' : 'Tidak <i class="fa fa-times"></i>';
                            let label = obj.kesesuaian == 1 ? 'success' : 'danger';
                            res.append(`<a href="javascript:;" class="list-group-item list-group-item-default"> ${obj.nm_dokumen}
                    <span class="badge badge-${label}"> ${status}</span>`);
                        });
                    } else {
                        $(".btn-maintain").css("display", "inline-block");
                        $(".btn-repeat").css("display", "inline-block");
                        let result = response.result;
                        const message = $('.caption-message');
                        message.html(`<h4 align="center" class="caption-subject font-red bold uppercase">Inspeksi Gagal</h4>`);
                        const res = $('#result');
                        res.empty();
                        result.forEach(obj => {
                            let status = obj.kesesuaian == 1 ? 'Sesuai <i class="fa fa-check"></i>' : 'Tidak <i class="fa fa-times"></i>';
                            let label = obj.kesesuaian == 1 ? 'success' : 'danger';
                            res.append(`<a href="javascript:;" class="list-group-item list-group-item-default"> ${obj.nm_dokumen}
                    <span class="badge badge-${label}"> ${status}</span>`);
                        });
                    }
                }, 1500);
                $('#ajax').modal('show');
                getFailFunc(fail);
            }

        }
    });
});


$(document).on('submit', 'form.final-wizard', function (e) {
    e.preventDefault();
    var $form = $(this);
    $.ajax({
        type: 'POST',
        url: `${base_url}Inspeksi/simpan_data_inspeksi`,
        data: new FormData(this),
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        beforeSend: function () {
            $(".loading").css("display", "block");
            $(".text-loader").css("display", "block");
            $(".btn-close").css("display", "none");
            $(".list-group").css("display", "none");
            $(".caption-message").css("display", "none");
            $(".btn-next").css("display", "none");
            $(".btn-repeat").css("display", "none");
            $(".btn-maintain").css("display", "none");
            $(".btn-done").css("display", "none");
        },
        success: function (response) {
            setTimeout(function () {
                if (response.res == false) {
                    setTimeout(function () {
                        showToast(response.message, 15000, response.type);
                        l.stop();
                        $(".btn-cancel").removeAttr("disabled");
                        $(".btn-close").css("display", "block")
                    }, 1500);
                } else {
                    $(".list-group").css("display", "block");
                    $(".btn-close").css("display", "block");
                    $(".loading").css("display", "none");
                    $(".text-loader").css("display", "none");
                    $(".btn-done").css("display", "inline-block");
                    $(".caption-message").css("display", "block");
                    $('#ajax2').modal('show');
                }
            }, 1500);
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