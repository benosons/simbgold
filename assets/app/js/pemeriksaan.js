var getStep, returnFail, csrfToken, csrfHash, jenisPersyaratan, typingTimer, idDetailJenisPersyaratan, id_izin, luasBG, tinggiBG, lantaiBG, idDokumenTeknis, idPrototype;
const delay = t => new Promise(resolve => setTimeout(resolve, t));
let arrPrototype = [{
    id: 1,
    name: "Type 36"
}, {
    id: 2,
    name: "Type 54"
}, {
    id: 3,
    name: "Type 72"
}];
var doneTypingInterval = 1500,
    csrfName = $(".txt_csrfname").attr("name"),
    cct = $(".txt_csrfname").val();
const getCSRFtoken = () => {
        $.ajax({
            type: "GET",
            url: `${base_url}CSRF/generateCSRF`,
            dataType: "json",
            success: function (response) {
                $(".txt_csrfname").val(response.token)
            }
        })
    },
    clickModal = (z, a, b) => {
        getCSRFtoken(), $("#responsive").modal("show"), $("#dataKonsultasi").val(z), $("#dataId").val(a), $("#dataVal").val(b)
    },
    popWin = x => {
        url = x, swin = window.open(url, "win", "scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no"), swin.focus()
    },
    calcHeight = value => {
        let numberOfLineBreaks, newHeight;
        return 20 + 20 * (value.match(/\n/g) || []).length + 12 + 2
    },
    textArea = document.querySelectorAll(".resize-ta");
for (let i = 0; i < textArea.length; i++) textArea[i].addEventListener("keyup", () => {
    textArea[i].style.height = calcHeight(textArea[i].value) + "px"
});
const getFailFunc = response => {
        returnFail = response
    },
    getJenisPermhonan = response => {
        jenisPersyaratan = response
    },
    detailJenisSyarat = response => {
        idDetailJenisPersyaratan = response
    },
    loadDocTeknis = () => {
        if (1 == id_izin) {
            document.getElementById("dokumenTeknis").style.display = "none", document.getElementById("prototype").style.display = "none";
            let arrDokumenTeknis, dokumenTeknis, optionTeknis = "";
            arrDokumenTeknis = [{
                id: 1,
                name: "Disediakan oleh Penyedia Jasa Konstruksi"
            }, {
                id: 2,
                name: "Menggunakan Desain Prototipe dari Pemda"
            }, {
                id: 3,
                name: "Mengembangan Desain Prototipe dari Pemda"
            }, {
                id: 4,
                name: "Desain Berdasarkan Ketetuan Pokok Tahan Gempa"
            }], luasBG = $("#luasBG").val(), lantaiBG = $("#lantaiBG").val(), dokumenTeknis = parseInt(luasBG) <= 100 && parseInt(lantaiBG) <= 2 ? arrDokumenTeknis : arrDokumenTeknis.slice(0, 1), dokumenTeknis.forEach(e => {
                let selectTeknis = idDokumenTeknis == e.id ? "selected" : "";
                optionTeknis += `<option value="${e.id}" ${selectTeknis}>${e.name}</option>`, $("#selectDokumenTeknis").html(optionTeknis)
            }), loadPrototype(idDokumenTeknis, idPrototype)
        }
    },
    loadPrototype = (id_doc_tek, id_prototype) => {
        if (2 == id_doc_tek || 3 == id_doc_tek) {
            let optionPrototype;
            document.getElementById("prototype").style.display = "none", arrPrototype.forEach(e => {
                let selectPrototype = id_prototype == e.id ? "selected" : "";
                optionPrototype += `<option value="${e.id}" ${selectPrototype}>${e.name}</option>`, $("#selectPrototype").html(optionPrototype)
            })
        } else document.getElementById("prototype").style.display = "none"
    },
    disableDataFinalisasi = () => {
        $("#selectJenisKonsultasi  option:not(:selected)").prop("disabled", !0), $("#selectFungsiBG  option:not(:selected)").prop("disabled", !0), $("#selectDokumenTeknis  option:not(:selected)").prop("disabled", !0), $("#selectPrototype  option:not(:selected)").prop("disabled", !0), $("#nama_provinsi").select2("enable", !1), document.getElementById("dokumenTeknis").style.display = "none", $("#nama_kabkota").select2("enable", !1)
    },
    getDataStep = () => {
        $.ajax({
            method: "POST",
            url: `${base_url}Pemeriksaan/cekStep`,
            data: {
                id: segment
            },
            success: function (response) {
                var wizard;
                $("#form_wizard_1").bootstrapWizard().bootstrapWizard("show", response.result), getStepFunction(response.result)
            }
        })
    },
    getStepFunction = response => {
        getStep = response
    },
    getRowPemeriksaan = () => {
        $.ajax({
            type: "GET",
            url: `${base_url}Pemeriksaan/getRowPemeriksaan`,
            data: {
                id: segment
            },
            dataType: "json",
            beforeSend: () => Metronic.blockUI({
                target: "#portletHeader",
                animate: !0
            }),
            success: response => {
                var tableKolektif;
                (getJenisPermhonan(response.id_jenis_permohonan), $(".no-konsultasi").html(response.no_konsultasi), $(".nm-pemilik").html(response.nm_pemilik), $(".alamat-pemilik").html(`${response.alamat}, Kec. ${response.nama_kecamatan}, ${response.nama_kabkota}, ${response.nama_prov_pemilik}`), $(".jenis-konsultasi").html(response.nm_konsultasi), $(".alamat-bangunan").html(`${response.almt_bgn},Kel/Desa. ${response.nama_kec_bg}, Kec. ${response.nama_kec_bg}, ${response.nama_kabkota_bg}, ${response.nama_provinsi_bg}`), $(".fungsi-bangunan-gedung").html(`${response.fungsi_bg}`), $(".luas-tinggi-lantai").html(`${response.luas_bgn} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgn} meter, dan berjumlah ${response.jml_lantai} lantai.`), $(".luas-tinggi-prasarana").html(`${response.luas_bgp} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgp} meter.`), $(".luas-tinggi-spbu").html(`${response.luas_bgp} m<sup>2</sup>, dengan tinggi ${response.tinggi_bgp} meter.`), $(".jns-prasarana").html(`${response.fungsi_bg}`), $("#idProvinsiPemilik").val(response.id_provinsi), $("#idKabkotaPemilik").val(response.id_kabkota), $("#idKecamatanPemilik").val(response.id_kecamatan), $("#idKelurahanPemilik").val(response.id_kelurahan), $("#idProvinsiBangunan").val(response.id_prov_bgn), $("#idKabkotaBangunan").val(response.id_kabkot_bgn), $("#idKecamatanBangunan").val(response.id_kec_bgn), $("#idKelurahanBangunan").val(response.id_kel_bgn), $("#imbBangunan").val(response.imb), 11 == response.id_jenis_permohonan) ? ($(".fungsi-bangunan").css("display", "none"), $(".bangunan-kolektif").css("display", "block"), $(".prasarana").css("display", "none"), $(".bangunan-spbu").css("display", "none"), $(".total-luas-kolektif").html(`${response.luas_total_kolektif} m<sup>2</sup>`), 0 != response.hasil_kolektif && response.hasil_kolektif.forEach(obj => {
                    tableKolektif += '<tr style="text-align:center;">', tableKolektif += `<td>${obj.tipe}</td>`, tableKolektif += `<td>${obj.luas}</td>`, tableKolektif += `<td>${obj.tinggi}</td>`, tableKolektif += `<td>${obj.lantai}</td>`, tableKolektif += `<td>${obj.jumlah}</td></tr>`, $("#tableKolektif").html(tableKolektif)
                })) : 12 == response.id_jenis_permohonan ? ($(".bangunan-kolektif").css("display", "none"), $(".fungsi-bangunan").css("display", "none"), $(".prasarana").css("display", "block"), $(".bangunan-spbu").css("display", "none")) : 21 == response.id_jenis_permohonan ? ($(".bangunan-kolektif").css("display", "none"), $(".fungsi-bangunan").css("display", "none"), $(".prasarana").css("display", "none"), $(".bangunan-spbu").css("display", "block")) : ($(".bangunan-kolektif").css("display", "none"), $(".fungsi-bangunan").css("display", "block"), $(".prasarana").css("display", "none"), $(".bangunan-spbu").css("display", "none"));
                Metronic.unblockUI("#portletHeader"), setTimeout(() => getDataPersyaratan(), 1e3)
            }
        })
    },
    getDataPersyaratan = () => {
        $.ajax({
            type: "GET",
            url: `${base_url}Pemeriksaan/getDataPersyaratan`,
            data: {
                id: segment,
                step: getStep
            },
            dataType: "json",
            beforeSend: () => Metronic.blockUI({
                target: "#form_wizard_1",
                animate: !0
            }),
            success: response => {
                if (detailJenisSyarat(response.id_detail_persyaratan), 1 == response.type) {
                    var tablePersyaratan;
                    let numPersyaratan = 1;
                    response.persyaratan.forEach(obj => {
                        let checked = 1 == obj.kesesuaian ? "checked" : "",
                            berkas = 0 == obj.dir_file ? '<span class="badge badge-danger badge-roundless""><i class="fa fa-times"></i> Tidak Ada Dokumen</span>' : `<a href="javascript:void(0);" data-val="${obj.id_detail}" class="btn btn-primary btn-block lihat-berkas" title="Lihat Berkas" onclick="javascript:popWin('${site_url}${obj.dir_file}')"><i class="fa fa-eye"></i>&nbsp;Lihat Berkas</a>`,
                            cssBerkas;
                        cssBerkas = 3 === jenisPersyaratan && 21 === jenisPersyaratan ? "none" : 1 == obj.kesesuaian ? "none" : "block", tablePersyaratan += "<tr>", tablePersyaratan += `<td style="text-align:center;">${numPersyaratan++}</td>`, tablePersyaratan += `<td colspan="3">${obj.nm_dokumen}</td>`, tablePersyaratan += `<td><input type="checkbox" class="make-switch" ${checked} data-konsultasi="${segment}" data-val="${obj.id_detail_jenis_persyaratan}" data-id="${obj.id_detail}" data-on-text="<i class='fa fa-check'></i> Sesuai" data-off-text="<i class='fa fa-times'></i> Tidak" data-on-color="success" data-off-color="danger" data-size="medium"></td>`, tablePersyaratan += `<td><textarea cols="40" name="catatan[]" rows="10" data-konsultasi="${segment}" data-val="${obj.id_detail_jenis_persyaratan}" data-id="${obj.id_detail}" id="note" class="resize-ta form-control note-persyaratan" placeholder="Isi Catatan" style="width:200px; height:50px;">${obj.catatan}</textarea></td>`, tablePersyaratan += `<td>${berkas} &nbsp;<a href="javascript:void(0);" class="btn btn-warning btn-block ubah-berkas" data-id="${obj.id_detail}" id="ubahBerkas" onclick="clickModal('${segment}',${obj.id_detail_jenis_persyaratan},${obj.id_detail})" style="display:${cssBerkas};"><i class="fa fa-edit"></i> Ubah Berkas</a></td>`, tablePersyaratan += "<tr>"
                    }), $(".table-persyaratan").html(tablePersyaratan)
                } else if (2 == response.type) {
                    var select;
                    let data_bangunan = response.persyaratan.data_bangunan,
                        daftar_provinsi = response.persyaratan.daftar_provinsi,
                        jenis_permohonan = response.persyaratan.jenis_permohonan,
                        fungsi_bangunan = response.persyaratan.fungsi_bangunan,
                        hasil_kolektif = response.persyaratan.hasil_kolektif,
                        id_provinsi = data_bangunan.id_provinsi,
                        id_prov_bgn = data_bangunan.id_prov_bgn;
                    id_izin = data_bangunan.id_izin;
                    let imb = data_bangunan.imb,
                        slf = data_bangunan.slf,
                        jual = null == data_bangunan.jual ? 0 : data_bangunan.jual,
                        jenis_id = null == data_bangunan.jenis_id ? 1 : data_bangunan.jenis_id,
                        choose = '<option value="">-- Pilih --</option>',
                        chooseJenisPermohonan = '<option value="">-- Pilih --</option>',
                        id_jns_bg = data_bangunan.id_jns_bg;
                    if (luasBG = data_bangunan.luas_bgn, lantaiBG = data_bangunan.jml_lantai, idDokumenTeknis = data_bangunan.id_doc_tek, idPrototype = data_bangunan.id_prototype, "" != id_jns_bg && null != id_jns_bg) {
                        let fungsiBG = JSON.parse(id_jns_bg);
                        fungsiBG.constructor == Array && fungsiBG.forEach(obj => {
                            let $checkBangunan, $checklist;
                            $(`[name="dcampur[]"][value="${obj}"]`).prop("checked", !0), $(`#uniform-checkBoxBangunan${obj}`).find("span").addClass("checked")
                        })
                    }
                    $("#idPemilik").val(data_bangunan.id_pemilik), $("#idBangunan").val(data_bangunan.id_bgn), $("#jenisKepemilikan").val(data_bangunan.jns_pemilik).trigger("change"), $("#jenisID").val(jenis_id).change(), $("#namaPemilik").val(data_bangunan.nm_pemilik), $("#noKTP").val(data_bangunan.no_ktp), $("#noKITAS").val(data_bangunan.no_kitas), $("#idJenisBG").val(data_bangunan.id_jns_bg), $(".nama-bangunan").val(data_bangunan.nm_bgn), $("#luasBG").val(luasBG), $("#lantaiBG").val(lantaiBG), $("#tinggiBG").val(data_bangunan.tinggi_bgn), $("#luasBasement").val(data_bangunan.luas_basement), $("#lapisBasement").val(data_bangunan.lapis_basement), $("#jenisKonsultasi").val(id_izin), $("#nomorIMB").val(data_bangunan.no_imb), $("#nomorSLF").val(data_bangunan.no_slf);
                    let selectLantai = "";
                    for (let i = 1; i < 11; i++) {
                        let selectededLantai;
                        selectLantai += `<option value="${i}" ${data_bangunan.jml_lantai==i?"selected":""}>${i} Lantai</option>`
                    }
                    $("#selectLantaiBG").html(selectLantai);
                    let selectBasement = "";
                    for (let i = 0; i < 11; i++) {
                        let selectedBasement;
                        selectBasement += `<option value="${i}" ${data_bangunan.lapis_basement==i?"selected":""}>${i} Lapis</option>`
                    }
                    $("#selectBasement").html(selectBasement), daftar_provinsi.forEach(value => {
                        select = value.id_provinsi == id_provinsi ? "selected" : "", choose += '<option value="' + value.id_provinsi + '" ' + select + " > " + value.nama_provinsi + " </option>"
                    }), $("#provinsiPemilik").html(choose).val(id_provinsi).trigger("change"), daftar_provinsi.forEach(value => {
                        select = value.id_provinsi == id_prov_bgn ? "selected" : "", choose += '<option value="' + value.id_provinsi + '" ' + select + " > " + value.nama_provinsi + " </option>"
                    }), $("#nama_provinsi").html(choose).val(id_prov_bgn).trigger("change"), $("#alamatPemilik").val(data_bangunan.alamat), $("#alamatBangunan").val(data_bangunan.almt_bgn), jenis_permohonan.forEach(value => {
                        select = value.id_jns_permohonan == id_izin ? "selected" : "", chooseJenisPermohonan += '<option value="' + value.id_jns_permohonan + '" ' + select + " > " + value.nm_jns_permohonan + " </option>"
                    }), $("#selectJenisKonsultasi").html(chooseJenisPermohonan).val(id_izin).trigger("change");
                    let choseFungsiBangunan = '<option value="">-- Pilih --</option>',
                        $radiosIMB, $radiosSLF, radioJual;
                    var tipeKolektif;
                    fungsi_bangunan.forEach(value => {
                        select = value.id_fungsi_bg == data_bangunan.id_fungsi_bg ? "selected" : "", choseFungsiBangunan += '<option value="' + value.id_fungsi_bg + '" ' + select + " > " + value.fungsi_bg + " </option>"
                    }), $("#selectFungsiBG").html(choseFungsiBangunan), $(".radio-imb").filter("[value=" + imb + "]").prop("checked", !0).trigger("click"), $(".radio-slf").filter("[value=" + slf + "]").prop("checked", !0).trigger("click"), $(".radio-jual").filter("[value=" + jual + "]").prop("checked", !0).trigger("click"), "" == data_bangunan.jenis_id || 1 == data_bangunan.jenis_id ? $("#ktp").show() : 2 == data_bangunan.jenis_id && $("#kitas").show();
                    let numKolektif = 0;
                    if ("11" == data_bangunan.id_jenis_permohonan && (hasil_kolektif.forEach(obj => {
                            numKolektif++, tipeKolektif += "<tr>", tipeKolektif += `<td><input type="text" name="tipeA[${numKolektif}]" value="${obj.tipe}" style="width:100px;" id="tipe${numKolektif}]" value="}" class="tipe${numKolektif}]" value="} form-control" /></td>`, tipeKolektif += `<td><input type="text" name="luasA[${numKolektif}]" value="${obj.luas}" style="width:100px;" id="luas${numKolektif}]" value="}" class="luas${numKolektif}]" value="} form-control" /></td>`, tipeKolektif += `<td><input type="text" name="tinggiA[${numKolektif}]" value="${obj.tinggi}" style="width:100px;" id="tinggi${numKolektif}]" value="}" class="tinggi${numKolektif}]" value="} form-control" /></td>`, tipeKolektif += `<td><input type="text" name="lantaiA[${numKolektif}]" value="${obj.lantai}" style="width:100px;" id="lantai${numKolektif}]" value="}" class="lantai${numKolektif}]" value="} form-control" /></td>`, tipeKolektif += `<td><input type="text" name="jumlahA[${numKolektif}]" value="${obj.jumlah}" style="width:100px;" id="jumlah${numKolektif}]" value="}" class="jumlah${numKolektif}]" value="} form-control" /></td>`, tipeKolektif += '<td><a class="btn btn-info" href="javascript:void(0);" onclick="if(checkDeleteTipeRow() == true){$(this).parent().parent().remove()}" title="Apakah ini akan dihapus ?"><i class="fa fa-trash left-icon"></i></a></td></tr>'
                        }), $("#tipeKolektif").html(tipeKolektif)), 2 != id_izin && 4 != id_izin && 5 != id_izin && 7 != id_izin && ($("#selectFungsiBG").val(data_bangunan.id_fungsi_bg).trigger("change"), $("#selectJenisBangunan").val(data_bangunan.id_jns_bg).trigger("change"), loadDocTeknis()), 2 == id_izin) {
                        const permohonanSLF = data_bangunan.permohonan_slf;
                        let PermohonanSLFvalue = 0 == permohonanSLF ? 1 : permohonanSLF;
                        $("#permohonanSLF").val(PermohonanSLFvalue).trigger("change"), "1" == PermohonanSLFvalue && ($("#selectFungsiBG").val(data_bangunan.id_fungsi_bg).trigger("change"), $("#selectJenisBangunan").val(data_bangunan.id_jns_bg).trigger("change"), loadDocTeknis())
                    }
                    5 == id_izin && $("#idPrasaranaBG").val(data_bangunan.id_prasarana_bg).trigger("change"), $(".luas-bgp").val(data_bangunan.luas_bgp), $(".tinggi-bgp").val(data_bangunan.tinggi_bgp), $(".lantai-bgp").val(data_bangunan.jml_lantai);
                    let lantaiBangunan = $(".input-lantai").val(),
                        basementBangunan = $(".input-basement").val();
                    parseInt(lantaiBangunan) > 10 ? ($("#uniform-pilihanLantai").find("span").addClass("checked"), $("#pilihanLantai").attr("checked", !0), $(".dropdown-lantai").css("display", "none"), $(".dropdown-lantai ").attr("disabled", !0), $(".input-lantai").attr("disabled", !1), $(".input-lantai").css("display", "block")) : ($("#pilihanLantai").attr("checked", !1), $(".dropdown-lantai").css("display", "block"), $(".dropdown-lantai ").attr("disabled", !1), $(".input-lantai").attr("disabled", !0), $(".input-lantai").css("display", "none")), parseInt(basementBangunan) > 10 ? ($("#uniform-pilihanBasement").find("span").addClass("checked"), $("#pilihanBasement").attr("checked", !0), $(".dropdown-basement").attr("disabled", !0), $(".input-basement").attr("disabled", !1), $(".dropdown-basement").css("display", "none"), $(".input-basement").css("display", "block")) : ($("#pilihanBasement").prop("checked", !0), $(".dropdown-basement").attr("disabled", !1), $(".input-basement").attr("disabled", !0), $(".dropdown-basement").css("display", "block"), $(".input-basement").css("display", "none"))
                }
                disableDataFinalisasi(), Metronic.unblockUI("#form_wizard_1"), $(".make-switch").bootstrapSwitch()
            }
        })
    };
$(document).ready((function () {
    $(() => {
        getCSRFtoken(), getDataStep(), getRowPemeriksaan()
    }), $("#pilihanLantai").change((function (e) {
        e.preventDefault(), this.checked ? ($(".dropdown-lantai").css("display", "none"), $(".dropdown-lantai ").attr("disabled", !0), $(".input-lantai").attr("disabled", !1), $(".input-lantai").css("display", "block")) : ($(".dropdown-lantai").css("display", "block"), $(".dropdown-lantai ").attr("disabled", !1), $(".input-lantai").attr("disabled", !0), $(".input-lantai").css("display", "none"))
    }));
    const bangunanGedungBaruAtauPerubahan = () => {
            document.getElementById("prasarana").style.display = "none", document.getElementById("fungsibg").style.display = "block", document.getElementById("permohonan_slf_show").style.display = "none", document.getElementById("dokumenTeknis").style.display = "none", document.getElementById("prototype").style.display = "none", document.getElementById("jual_bg").style.display = "none", document.getElementById("perIMB").style.display = "none", document.getElementById("KolektifInduk").style.display = "none", document.getElementById("perSLF").style.display = "none", document.getElementById("perCetak").style.display = "none", document.getElementById("spbu_micro").style.display = "none", document.getElementById("showIMB").style.display = "none"
        },
        bangunanGedungExisting = () => {
            document.getElementById("prasarana").style.display = "none", document.getElementById("perIMB").style.display = "block", document.getElementById("fungsibg").style.display = "none", document.getElementById("permohonan_slf_show").style.display = "block", document.getElementById("jns_bg_toggle").style.display = "none", document.getElementById("detail_bg").style.display = "none", document.getElementById("dokumenTeknis").style.display = "none", document.getElementById("prototype").style.display = "none", document.getElementById("jual_bg").style.display = "none", document.getElementById("KolektifInduk").style.display = "none", document.getElementById("perSLF").style.display = "none", document.getElementById("perCetak").style.display = "none", document.getElementById("spbu_micro").style.display = "none"
        },
        bangunanGedungKolektif = () => {
            document.getElementById("prasarana").style.display = "none", document.getElementById("KolektifInduk").style.display = "block", document.getElementById("perIMB").style.display = "none", document.getElementById("fungsibg").style.display = "none", document.getElementById("permohonan_slf_show").style.display = "none", document.getElementById("jns_bg_toggle").style.display = "none", document.getElementById("detail_bg").style.display = "none", document.getElementById("dokumenTeknis").style.display = "none", document.getElementById("prototype").style.display = "none", document.getElementById("jual_bg").style.display = "none", document.getElementById("perSLF").style.display = "none", document.getElementById("perCetak").style.display = "none", document.getElementById("spbu_micro").style.display = "none", document.getElementById("showIMB").style.display = "none"
        },
        bangunanGedungPrasarana = () => {
            document.getElementById("prasarana").style.display = "block", document.getElementById("KolektifInduk").style.display = "none", document.getElementById("perIMB").style.display = "none", document.getElementById("fungsibg").style.display = "none", document.getElementById("permohonan_slf_show").style.display = "none", document.getElementById("jns_bg_toggle").style.display = "none", document.getElementById("detail_bg").style.display = "none", document.getElementById("dokumenTeknis").style.display = "none", document.getElementById("prototype").style.display = "none", document.getElementById("jual_bg").style.display = "none", document.getElementById("perSLF").style.display = "none", document.getElementById("perCetak").style.display = "none", document.getElementById("spbu_micro").style.display = "none", document.getElementById("showIMB").style.display = "none"
        },
        bangunanGedungCagarBudaya = () => {
            document.getElementById("prasarana").style.display = "none", document.getElementById("perIMB").style.display = "none", document.getElementById("fungsibg").style.display = "block", document.getElementById("permohonan_slf_show").style.display = "none", document.getElementById("jns_bg_toggle").style.display = "none", document.getElementById("detail_bg").style.display = "none", document.getElementById("dokumenTeknis").style.display = "none", document.getElementById("prototype").style.display = "none", document.getElementById("jual_bg").style.display = "none", document.getElementById("KolektifInduk").style.display = "none", document.getElementById("perSLF").style.display = "none", document.getElementById("perCetak").style.display = "none", document.getElementById("spbu_micro").style.display = "none", document.getElementById("showIMB").style.display = "none"
        },
        bangunanGedungSPBU = () => {
            document.getElementById("prasarana").style.display = "none", document.getElementById("perIMB").style.display = "none", document.getElementById("fungsibg").style.display = "none", document.getElementById("permohonan_slf_show").style.display = "none", document.getElementById("jns_bg_toggle").style.display = "none", document.getElementById("detail_bg").style.display = "none", document.getElementById("dokumenTeknis").style.display = "none", document.getElementById("prototype").style.display = "none", document.getElementById("jual_bg").style.display = "none", document.getElementById("KolektifInduk").style.display = "none", document.getElementById("perSLF").style.display = "none", document.getElementById("perCetak").style.display = "none", document.getElementById("spbu_micro").style.display = "block", document.getElementById("showIMB").style.display = "none"
        },
        resetJenisBangunanGedung = () => {
            document.getElementById("prasarana").style.display = "none", document.getElementById("perIMB").style.display = "none", document.getElementById("fungsibg").style.display = "none", document.getElementById("permohonan_slf_show").style.display = "none", document.getElementById("jns_bg_toggle").style.display = "none", document.getElementById("detail_bg").style.display = "none", document.getElementById("dokumenTeknis").style.display = "none", document.getElementById("prototype").style.display = "none", document.getElementById("jual_bg").style.display = "none", document.getElementById("KolektifInduk").style.display = "none", document.getElementById("perSLF").style.display = "none", document.getElementById("perCetak").style.display = "none", document.getElementById("spbu_micro").style.display = "none", document.getElementById("showIMB").style.display = "none"
        };
    $("#selectJenisKonsultasi").change((function (e) {
        e.preventDefault();
        let value = $(this).val();
        switch (console.log(value), value) {
            case "1":
                bangunanGedungBaruAtauPerubahan();
                break;
            case "2":
                bangunanGedungExisting();
                break;
            case "3":
                bangunanGedungBaruAtauPerubahan();
                break;
            case "4":
                bangunanGedungKolektif();
                break;
            case "5":
                bangunanGedungPrasarana();
                break;
            case "6":
                bangunanGedungCagarBudaya();
                break;
            case "7":
                bangunanGedungSPBU();
                break;
            default:
                resetJenisBangunanGedung()
        }
    }));
    const bangunanFungsiHKSBDK = () => {
            document.getElementById("detail_bg").style.display = "none", document.getElementById("campurincek").style.display = "none", document.getElementById("jns_bg_toggle").style.display = "block", document.getElementById("jual_bg").style.display = "none", document.getElementById("campurincek").style.display = "none"
        },
        bangunanFungsiUsaha = () => {
            document.getElementById("campurincek").style.display = "none", document.getElementById("jual_bg").style.display = "block", document.getElementById("dokumenTeknis").style.display = "none", document.getElementById("prototype").style.display = "none"
        },
        bangunanFungsiCampuran = () => {
            document.getElementById("detail_bg").style.display = "block", document.getElementById("campurincek").style.display = "block", document.getElementById("jns_bg_toggle").style.display = "none", document.getElementById("jual_bg").style.display = "none"
        },
        resetBangunanFungsi = () => {
            document.getElementById("detail_bg").style.display = "none", document.getElementById("campurincek").style.display = "none", document.getElementById("jns_bg_toggle").style.display = "none", document.getElementById("jual_bg").style.display = "none", document.getElementById("dokumenTeknis").style.display = "none", document.getElementById("prototype").style.display = "none"
        };
    $("#selectFungsiBG").change((function (e) {
        e.preventDefault();
        let value = $(this).val();
        switch (value) {
            case "1":
            case "2":
                bangunanFungsiHKSBDK();
                break;
            case "3":
                bangunanFungsiUsaha();
                break;
            case "4":
            case "5":
                bangunanFungsiHKSBDK();
                break;
            case "6":
                bangunanFungsiCampuran();
                break;
            default:
                resetBangunanFungsi()
        }
        $.ajax({
            type: "GET",
            url: `${base_url}Pemeriksaan/getDataJnsBg`,
            data: {
                id: value
            },
            dataType: "json",
            success: function (response) {
                let selectJenisBG = '<option value="">-- Pilih --</option>',
                    selectJenisBGVal = $("#idJenisBG").val();
                jQuery.each(response, (function (_key, value) {
                    value.id_jns_bg == selectJenisBGVal ? select = "selected" : select = "", selectJenisBG += '<option value="' + value.id_jns_bg + '" ' + select + " > " + value.nm_jenis_bg + " </option>"
                })), jQuery("#selectJenisBangunan").html(selectJenisBG)
            }
        })
    })), $("#selectJenisBangunan").change((function (e) {
        e.preventDefault(), showDataDetailBG($(this).val())
    }));
    const showDataDetailBG = id => {
            document.getElementById("detail_bg").style.display = "" == id ? "none" : "block"
        },
        permohonanSLFBangunanGedung = () => {
            document.getElementById("fungsibg").style.display = "block", document.getElementById("prasarana").style.display = "none"
        },
        permohonanSLFPrasarana = () => {
            document.getElementById("prasarana").style.display = "block", document.getElementById("fungsibg").style.display = "none", document.getElementById("jns_bg_toggle").style.display = "none", document.getElementById("detail_bg").style.display = "none", document.getElementById("dokumenTeknis").style.display = "none", document.getElementById("prototype").style.display = "none", document.getElementById("jual_bg").style.display = "none", document.getElementById("KolektifInduk").style.display = "none"
        },
        permohonanSLFPertashop = () => {
            document.getElementById("prasarana").style.display = "none", document.getElementById("perIMB").style.display = "none", document.getElementById("fungsibg").style.display = "none", document.getElementById("permohonan_slf_show").style.display = "none", document.getElementById("jns_bg_toggle").style.display = "none", document.getElementById("detail_bg").style.display = "none", document.getElementById("dokumenTeknis").style.display = "none", document.getElementById("prototype").style.display = "none", document.getElementById("jual_bg").style.display = "none", document.getElementById("KolektifInduk").style.display = "none", document.getElementById("perSLF").style.display = "none", document.getElementById("perCetak").style.display = "none", document.getElementById("spbu_micro").style.display = "block", document.getElementById("showIMB").style.display = "none"
        },
        resetBangunanPermohonanSLF = () => {
            document.getElementById("prasarana").style.display = "none", document.getElementById("fungsibg").style.display = "none", document.getElementById("jns_bg_toggle").style.display = "none", document.getElementById("detail_bg").style.display = "none", document.getElementById("dokumenTeknis").style.display = "none", document.getElementById("prototype").style.display = "none", document.getElementById("jual_bg").style.display = "none", document.getElementById("KolektifInduk").style.display = "none"
        };
    $("#permohonanSLF").change((function (e) {
        e.preventDefault();
        let v = $(this).val();
        "1" == v ? permohonanSLFBangunanGedung() : "2" == v ? permohonanSLFPrasarana() : "3" == v ? permohonanSLFPertashop() : resetBangunanPermohonanSLF()
    })), $("#pilihanBasement").change((function (e) {
        e.preventDefault(), this.checked ? ($(".dropdown-basement").attr("disabled", !0), $(".input-basement").attr("disabled", !1), $(".dropdown-basement").css("display", "none"), $(".input-basement").css("display", "block")) : ($(".dropdown-basement").attr("disabled", !1), $(".input-basement").attr("disabled", !0), $(".dropdown-basement").css("display", "block"), $(".input-basement").css("display", "none"))
    }));
    const showCetak = () => {
        var imb = document.getElementsByName("imb"),
            slf = document.getElementsByName("slf");
        for (i = 0; i < slf.length; i++) slf[i].checked && (slf = slf[i].value);
        document.getElementById("perCetak").style.display = "1" == imb && "1" == slf ? "block" : "none", document.getElementById("showSLF").style.display = "1" == slf ? "block" : "none"
    };
    $(".radio-imb").click((function (e) {
        let value;
        e.preventDefault(), "1" == $(this).val() ? (document.getElementById("showIMB").style.display = "block", document.getElementById("perSLF").style.display = "block", document.getElementById("perCetak").style.display = "none") : (document.getElementById("showIMB").style.display = "none", document.getElementById("perSLF").style.display = "none"), showCetak()
    })), $(".radio-slf").click((function (e) {
        e.preventDefault();
        let imb = document.getElementsByName("imb");
        for (i = 0; i < imb.length; i++) imb[i].checked && (imb = imb[i].value);
        let slf = document.getElementsByName("slf");
        for (i = 0; i < slf.length; i++) slf[i].checked && (slf = slf[i].value);
        document.getElementById("perCetak").style.display = "1" == imb && "1" == slf ? "block" : "none", document.getElementById("showSLF").style.display = "1" == slf ? "block" : "none"
    })), $("#jenisID").change((function () {
        var v = $(this).val();
        1 == v && ($("#ktp").show(), $("#kitas").hide()), 2 == v && ($("#ktp").hide(), $("#kitas").show())
    })), $("#selectDokumenTeknis").change((function (e) {
        e.preventDefault();
        let v = $(this).val();
        if (2 == v || 3 == v) {
            let optionPrototype = "";
            document.getElementById("prototype").style.display = "block", arrPrototype.forEach(e => {
                optionPrototype += `<option value="${e.id}">${e.name}</option>`, $("#selectPrototype").html(optionPrototype)
            })
        } else document.getElementById("prototype").style.display = "none"
    })), $("#selectLantaiBG").change((function (e) {
        e.preventDefault();
        let value = $(this).val();
        $("#lantaiBG").val(value)
    })), $("#provinsiPemilik").change((function () {
        let v = $(this).val(),
            select = $("#idKabkotaPemilik").val();
        jQuery.post(base_url + "Pemeriksaan/getDataKabKota/" + v, (function (data) {
            $('select[name="kabkotaPemilik"]').empty(), $.each(data, (function (_key, value) {
                select == value.id_kabkot ? $('select[name="kabkotaPemilik"]').append('<option value="' + value.id_kabkot + '" selected>' + value.nama_kabkota + "</option>").trigger("change") : $('select[name="kabkotaPemilik"]').append('<option value="' + value.id_kabkot + '">' + value.nama_kabkota + "</option>")
            }))
        }), "json")
    })), $("#nama_provinsi").change((function () {
        let v = $(this).val(),
            select = $("#idKabkotaBangunan").val();
        jQuery.post(base_url + "Pemeriksaan/getDataKabKota/" + v, (function (data) {
            $('select[name="nama_kabkota"]').empty(), $.each(data, (function (_key, value) {
                select == value.id_kabkot ? $('select[name="nama_kabkota"]').append('<option value="' + value.id_kabkot + '" selected>' + value.nama_kabkota + "</option>").trigger("change") : $('select[name="nama_kabkota"]').append('<option value="' + value.id_kabkot + '">' + value.nama_kabkota + "</option>")
            }))
        }), "json")
    })), $("#kabKotaPemilik").change((function () {
        var v = $(this).val(),
            selectKecamatan = $("#idKecamatanPemilik").val();
        jQuery.post(base_url + "Pemeriksaan/getDataKecamatan/" + v, (function (data) {
            $('select[name="kecamatanPemilik"]').empty(), $.each(data, (function (_key, value) {
                selectKecamatan == value.id_kecamatan ? $('select[name="kecamatanPemilik"]').append('<option value="' + value.id_kecamatan + '" selected>' + value.nama_kecamatan + "</option>").trigger("change") : $('select[name="kecamatanPemilik"]').append('<option value="' + value.id_kecamatan + '">' + value.nama_kecamatan + "</option>")
            }))
        }), "json")
    })), $("#kecamatanPemilik").change((function () {
        var v = $(this).val(),
            selectKelurahan = $("#idKelurahanPemilik").val();
        jQuery.post(base_url + "Pemeriksaan/getDataKelurahan/" + v, (function (data) {
            $('select[name="kelurahanPemilik"]').empty(), $.each(data, (function (_key, value) {
                selectKelurahan == value.id_kelurahan ? $('select[name="kelurahanPemilik"]').append('<option value="' + value.id_kelurahan + '" selected>' + value.nama_kelurahan + "</option>").trigger("change") : $('select[name="kelurahanPemilik"]').append('<option value="' + value.id_kelurahan + '">' + value.nama_kelurahan + "</option>")
            }))
        }), "json")
    })), $("#nama_kabkota").change((function () {
        var v = $(this).val(),
            selectKecamatan = $("#idKecamatanBangunan").val();
        jQuery.post(base_url + "Pemeriksaan/getDataKecamatan/" + v, (function (data) {
            $('select[name="nama_kecamatan"]').empty(), $.each(data, (function (_key, value) {
                selectKecamatan == value.id_kecamatan ? $('select[name="nama_kecamatan"]').append('<option value="' + value.id_kecamatan + '" selected>' + value.nama_kecamatan + "</option>").trigger("change") : $('select[name="nama_kecamatan"]').append('<option value="' + value.id_kecamatan + '">' + value.nama_kecamatan + "</option>")
            }))
        }), "json")
    })), $("#nama_kecamatan").change((function () {
        var v = $(this).val(),
            selectKelurahan = $("#idKelurahanBangunan").val();
        jQuery.post(base_url + "Pemeriksaan/getDataKelurahan/" + v, (function (data) {
            $('select[name="nama_kelurahan"]').empty(), $.each(data, (function (_key, value) {
                selectKelurahan == value.id_kelurahan ? $('select[name="nama_kelurahan"]').append('<option value="' + value.id_kelurahan + '" selected>' + value.nama_kelurahan + "</option>").trigger("change") : $('select[name="nama_kelurahan"]').append('<option value="' + value.id_kelurahan + '">' + value.nama_kelurahan + "</option>")
            }))
        }), "json")
    })), $(".input-number").keypress((function (e) {
        var charCode = e.which ? e.which : e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) return !1
    }));
    const regex = /[^\d.]|\.(?=.*\.)/g,
        subst = "";
    $(".input-comma").keyup((function () {
        const str = this.value,
            result = str.replace(regex, "");
        this.value = result
    })), $(document).on("keyup", "textarea.note-persyaratan", (function (_e) {
        let dataKonsultasi = $(this).data("konsultasi"),
            dataId = $(this).data("id"),
            dataVal = $(this).attr("data-val"),
            text = $(this).val();
        clearTimeout(typingTimer), $(this).val() && (typingTimer = setTimeout((function () {
            doneTyping(dataKonsultasi, dataId, dataVal, text)
        }), doneTypingInterval))
    }));
    const doneTyping = (dataKonsultasi, dataId, dataVal, text) => {
        getCSRFtoken();
        var csrfName = $(".txt_csrfname").attr("name"),
            cct = $(".txt_csrfname").val();
        $.ajax({
            type: "POST",
            url: `${base_url}Pemeriksaan/simpanCatatan`,
            data: {
                syarat: text,
                dataId: dataId,
                dataVal: dataVal,
                dataKonsultasi: dataKonsultasi,
                [csrfName]: cct
            },
            beforeSend: () => Metronic.blockUI({
                target: "#form_wizard_1",
                animate: !0
            }),
            success: response => {
                getCSRFtoken(), !0 === response.status && (toastr.options = {
                    closeButton: !0,
                    debug: !1,
                    positionClass: "toast-top-right",
                    onclick: null,
                    showDuration: "1000",
                    hideDuration: "1000",
                    timeOut: "5000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut"
                }, toastr.success(response.message), Metronic.unblockUI("#form_wizard_1"))
            }
        })
    };
    $(document).on("switchChange.bootstrapSwitch", ".make-switch", (function () {
        let mode = $(this).prop("checked"),
            dataId = $(this).data("id"),
            dataKonsultasi = $(this).data("konsultasi"),
            dataVal = $(this).attr("data-val"),
            csrfName = $(".txt_csrfname").attr("name"),
            cct = $(".txt_csrfname").val();
        $.ajax({
            type: "POST",
            url: `${base_url}Pemeriksaan/cekKesesuaian`,
            data: {
                mode: mode,
                dataId: dataId,
                dataVal: dataVal,
                [csrfName]: cct,
                dataKonsultasi: dataKonsultasi
            },
            dataType: "json",
            beforeSend: () => Metronic.blockUI({
                target: "#form_wizard_1",
                animate: !0
            }),
            success: response => {
                getCSRFtoken(), 3 == jenisPersyaratan && 21 == jenisPersyaratan ? $(`a[data-id=${dataId}]`).css("display", "none") : !1 === response.status ? $(`a[data-id=${dataId}]`).css("display", "block") : $(`a[data-id=${dataId}]`).css("display", "none"), toastr.options = {
                    closeButton: !0,
                    debug: !1,
                    positionClass: "toast-top-right",
                    onclick: null,
                    showDuration: "1000",
                    hideDuration: "1000",
                    timeOut: "5000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut"
                }, toastr.success(response.message), Metronic.unblockUI("#form_wizard_1")
            }
        })
    })), $("#form_wizard_1").bootstrapWizard({
        nextSelector: ".btn-next-step",
        previousSelector: ".button-previous",
        onTabClick: () => !1,
        onNext: () => {
            var l = Ladda.create(document.querySelector(".btn-next-step")),
                wizard;
            let res, current, nextStep = $("#form_wizard_1").bootstrapWizard().bootstrapWizard("currentIndex") + 1;
            var isGood;
            if (returnFail > 0)
                if (confirm("Pemeriksaan Masih Ada Yang Belum Sesuai, Tetap Lanjutkan?")) {
                    var wizard = $("#form_wizard_1").bootstrapWizard();
                    l.start(), setTimeout(() => {
                        l.stop(), $("#ajax").modal("hide")
                    }, 1500), res = !0
                } else res = !1;
            else l.start(), setTimeout((function () {
                l.stop(), $("#ajax").modal("hide")
            }), 1500), res = !0;
            return $.ajax({
                type: "POST",
                data: {
                    step: nextStep,
                    dataVal: segment,
                    [csrfName]: cct
                },
                url: `${base_url}Pemeriksaan/saveStep`,
                success: () => {
                    getDataStep(), getCSRFtoken(), delay(2e3).then(() => {
                        getRowPemeriksaan(), getDataPersyaratan()
                    })
                }
            }), res
        },
        onPrevious: (_e, _r, _a) => {},
        onTabShow: function (_e, r, t) {
            var i, a, o = (t + 1) / r.find("li").length * 100;
            $("#form_wizard_1").find(".progress-bar").css({
                width: o + "%"
            })
        }
    }), $("#changeBerkas").submit((function (e) {
        var l = Ladda.create(document.querySelector("#form-submit"));
        l.start(), e.preventDefault();
        var dataVal = $("#dataVal").val();
        $(".btn-cancel").attr("disabled", !0), $(".btn-close").css("display", "none"), $.ajax({
            type: "POST",
            url: `${base_url}Pemeriksaan/simpanBerkas`,
            data: new FormData(this),
            processData: !1,
            contentType: !1,
            enctype: "multipart/form-data",
            success: function (response) {
                getCSRFtoken(), 0 == response.status ? setTimeout((function () {
                    showToast(response.message, 15e3, response.type), l.stop(), $(".btn-cancel").removeAttr("disabled"), $(".btn-close").css("display", "block")
                }), 1500) : setTimeout((function () {
                    let viewFiles;
                    if (showToast(response.message, 15e3, response.type), l.stop(), $(".btn-cancel").removeAttr("disabled"), $(".btn-close").css("display", "block"), $("#responsive").modal("hide"), $("td").find(`a.lihat-berkas[data-val=${dataVal}]`).length > 0) $(`a.lihat-berkas[data-val=${dataVal}]`).attr("onClick", `javascript:popWin('${base_url}${response.result}')`);
                    else {
                        let buttonEl;
                        $("td").find(`a.ubah-berkas[data-id=${dataVal}]`).parent().find("span.badge-danger").replaceWith(`<a href="javascript:void(0);" data-val="${dataVal}" class="btn btn-primary btn-block lihat-berkas" title="Lihat Berkas" onclick="javascript:popWin('${base_url}${response.result}')"><i class="fa fa-eye"></i>&nbsp;Lihat Berkas</a>`)
                    }
                }), 1500)
            }
        })
    })), $("#perbaikanBerkas").submit((function (e) {
        e.preventDefault();
        var l = Ladda.create(document.querySelector("#perbaikanSurat"));
        l.start(), e.preventDefault(), $(".btn-cancel").attr("disabled", !0), $(".btn-close").css("display", "none"), $.ajax({
            type: "POST",
            url: `${base_url}Pemeriksaan/kirimPerbaikan`,
            data: new FormData(this),
            processData: !1,
            contentType: !1,
            enctype: "multipart/form-data",
            success: function (response) {
                getCSRFtoken(), 0 == response.status ? setTimeout((function () {
                    showToast(response.message, 15e3, response.type), l.stop(), $(".btn-cancel").removeAttr("disabled"), $(".btn-close").css("display", "block")
                }), 1500) : setTimeout((function () {
                    showToast(response.message, 15e3, response.type), l.stop(), $(".btn-cancel").removeAttr("disabled"), $(".btn-close").css("display", "block"), $("#pemohon").modal("hide"), setTimeout(() => window.location.replace(`${base_url}Pemeriksaan/Penilaian`), 3e3)
                }), 1500)
            }
        })
    })), $(".back-button").click((function (_e) {
        var isGood;
        if (confirm("Kembali Ke Tahap Sebelumnya?")) {
            var wizard = $("#form_wizard_1").bootstrapWizard();
            wizard.bootstrapWizard("previous");
            let current = wizard.bootstrapWizard("currentIndex");
            $.ajax({
                type: "POST",
                data: {
                    step: current,
                    dataVal: segment
                },
                url: `${base_url}Pemeriksaan/saveStep`,
                success: () => {
                    getDataStep(), getCSRFtoken(), delay(2e3).then(() => {
                        getDataPersyaratan()
                    })
                }
            })
        }
    })), $(document).on("submit", "form.step-wizard", (function (e) {
        e.preventDefault();
        var csrfName = $(".txt_csrfname").attr("name"),
            cct = $(".txt_csrfname").val();
        $.ajax({
            type: "POST",
            url: `${base_url}Pemeriksaan/simpanPenilaian`,
            data: {
                syarat: idDetailJenisPersyaratan,
                [csrfName]: cct,
                jenis: jenisPersyaratan,
                dataKonsultasi: segment
            },
            beforeSend: function () {
                $(".loading").css("display", "block"), $(".text-loader").css("display", "block"), $(".btn-close").css("display", "none"), $(".list-group").css("display", "none"), $(".caption-message").css("display", "none"), $(".btn-next-step").css("display", "none"), $(".btn-repeat").css("display", "none"), $(".btn-maintain").css("display", "none"), $(".btn-reject").css("display", "none")
            },
            success: function (response) {
                getCSRFtoken();
                let fail = response.not;
                setTimeout((function () {
                    response.not > 0 ? ($(".btn-repeat").css("display", "inline-block"), $(".btn-maintain").css("display", "inline-block"), $(".btn-reject").css("display", "inline-block")) : $(".btn-repeat").css("display", "none"), $(".btn-maintain").click((function (e) {
                        getCSRFtoken(), e.preventDefault(), $("#pemohon").modal("show"), $("#noKonsultasi").val(segment)
                    })), $(".btn-reject").click((function (e) {
                        e.preventDefault(), $("#tolak").modal("show"), getCSRFtoken(), $("#konsultasiID").val(segment)
                    })), $(".list-group").css("display", "block"), $(".btn-close").css("display", "block"), $(".loading").css("display", "none"), $(".text-loader").css("display", "none"), $(".caption-message").css("display", "block");
                    let result = response.result;
                    const message = $(".caption-message");
                    let sts = 1 == response.status ? "green" : "red",
                        msgRes = 1 == response.status ? "Pemeriksaan Berhasil" : "Pemeriksaan Gagal";
                    message.html(`<h4 align="center" class="caption-subject font-${sts} bold uppercase">${msgRes}</h4>`);
                    const res = $(".data-kesesuaian");
                    let table;
                    res.empty();
                    let num = 1;
                    result.forEach(obj => {
                        let status = 1 == obj.kesesuaian ? 'Sesuai <i class="fa fa-check"></i>' : 'Tidak <i class="fa fa-times"></i>',
                            label = 1 == obj.kesesuaian ? "success" : "danger";
                        table += "<tr>", table += `<td style="text-align:center;">${num++}</td>`, table += `<td style="text-align:left;">${obj.nm_dokumen}</td>`, table += `<td style="text-align:center;"><span class="badge badge-${label}"> ${status}</span></td></tr>`, $(".data-kesesuaian").html(table)
                    }), 1 == response.status ? $(".btn-next-step").css("display", "inline-block") : ($(".btn-maintain").css("display", "inline-block"), $(".btn-repeat").css("display", "inline-block"))
                }), 1500), $("#ajax").modal("show"), getFailFunc(fail)
            }
        })
    })), $(document).on("submit", "form.final-identity", (function (e) {
        var csrfName = $(".txt_csrfname").attr("name"),
            cct = $(".txt_csrfname").val();
        e.preventDefault();
        var $form, serialize = $(this).serializeArray(),
            isGood;
        confirm("Apakah data bangunan yang diperiksa sudah benar?") && $.ajax({
            type: "POST",
            data: serialize,
            url: `${base_url}Pemeriksaan/saveDataFinalisasi`,
            success: function (res) {
                var wizard = $("#form_wizard_1").bootstrapWizard();
                let current, nextStep = wizard.bootstrapWizard("currentIndex") + 1;
                1 == res.res ? (wizard.bootstrapWizard("next"), $.ajax({
                    type: "POST",
                    data: {
                        step: nextStep,
                        dataVal: segment,
                        [csrfName]: cct
                    },
                    url: `${base_url}Pemeriksaan/saveStep`,
                    success: function (_response) {
                        showToast(res.message, 15e3, res.type)
                    }
                })) : showToast(res.message, 15e3, res.type)
            }
        })
    }));
    const showToast = (message, timeout, type) => {
        type = void 0 === type ? "info" : type, toastr.options = {
            closeButton: !0,
            debug: !1,
            positionClass: "toast-top-right",
            onclick: null,
            showDuration: "1000",
            hideDuration: "1000",
            timeOut: timeout,
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        }, toastr[type](message)
    };
    $(".select2").select2(), $("#formFourth").validate({
        rules: {
            jns_pemilik: "required",
            nm_pemilik: "required",
            alamat: "required",
            nama_provinsi: "required",
            nama_kabkota: "required",
            nama_kecamatan: "required",
            nama_kelurahan: "required",
            provinsiPemilik: "required",
            kabKotaPemilik: "required",
            kecamatanPemilik: "required",
            kelurahanPemilik: "required",
            id_fungsi: "required",
            nib: {
                minlength: 13,
                maxlength: 13,
                required: !0
            },
            "dcampur[]": {
                minlength: 2,
                required: !0
            },
            no_hp: {
                minlength: 6,
                required: !0,
                number: !0
            },
            email: {
                required: !0,
                email: !0
            },
            no_ktp: {
                minlength: 6,
                required: !0,
                number: !0
            }
        },
        highlight: function (element) {
            $(element).closest(".form-group").removeClass("has-success").addClass("has-error")
        },
        unhighlight: function (element) {
            $(element).closest(".form-group").removeClass("has-error").addClass("has-success")
        },
        errorClass: "help-block",
        messages: {
            jns_pemilik: "Status Kepemilikan Tidak Boleh Kosong",
            nm_pemilik: "Masukkan Nama Anda",
            alamat: "Masukkan Alamat Anda",
            "dcampur[]": "",
            no_ktp: {
                required: "Wajib diisi",
                minlength: "Nomor Identitas minimal 6 karakter",
                number: "ID harus berupa angka"
            },
            no_hp: {
                required: "Masukkan Nomor Telp/HP Aktif",
                minlength: "Nomor Identitas minimal 6 karakter",
                number: "ID harus berupa angka"
            },
            nama_provinsi: "Pilih Provinsi",
            nama_kabkota: "Pilih Kabupaten/Kota",
            nama_kecamatan: "Pilih Kecamatan",
            email: "Masukkan Alamat E-Mail Anda"
        },
        submitHandler: function (form) {
            form.submit()
        }
    })
}));