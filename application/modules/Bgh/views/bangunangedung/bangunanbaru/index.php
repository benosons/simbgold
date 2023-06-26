<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Bangunan Baru
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
  <div class="container-xl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan" class="btn btn-teal btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 2l.324 .001l.318 .004l.616 .017l.299 .013l.579 .034l.553 .046c4.785 .464 6.732 2.411 7.196 7.196l.046 .553l.034 .579c.005 .098 .01 .198 .013 .299l.017 .616l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.464 4.785 -2.411 6.732 -7.196 7.196l-.553 .046l-.579 .034c-.098 .005 -.198 .01 -.299 .013l-.616 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.785 -.464 -6.732 -2.411 -7.196 -7.196l-.046 -.553l-.034 -.579a28.058 28.058 0 0 1 -.013 -.299l-.017 -.616c-.003 -.21 -.005 -.424 -.005 -.642l.001 -.324l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.464 -4.785 2.411 -6.732 7.196 -7.196l.553 -.046l.579 -.034c.098 -.005 .198 -.01 .299 -.013l.616 -.017c.21 -.003 .424 -.005 .642 -.005zm0 6a1 1 0 0 0 -1 1v2h-2l-.117 .007a1 1 0 0 0 .117 1.993h2v2l.007 .117a1 1 0 0 0 1.993 -.117v-2h2l.117 -.007a1 1 0 0 0 -.117 -1.993h-2v-2l-.007 -.117a1 1 0 0 0 -.993 -.883z" fill="currentColor" stroke-width="0"></path>
                        </svg>
                        Ajukan Permohonan
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable" id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Permohonan</th>
                                    <th>Nama Gedung</th>
                                    <th>Info</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<script src="<?= base_url() ?>assets/bgh/dist/libs/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
<script src="<?= base_url() ?>assets/bgh/dist/libs/DataTables-1.13.4/js/datatables.min.js"></script>

<script>
    $(() => {
        $('#menu-bangunan').addClass('active');
        $('#table').DataTable();

        loaddata();
    })

    function loaddata() {
        var tabel = $("#table").DataTable({
            destroy: true,
            searching: false,
            processing: true,
            responsive: true,
            serverSide: true,
            bInfo: true,
            ordering: true, // Set true agar bisa di sorting
            order: [[0, "asc"]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            paging: true,
            pageLength: 10,
            ajax: {
                url: "<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/loadbangunanbaru", // URL file untuk proses select datanya
                type: "POST",
                data: {
                    param: "data_berita",
                },
            },
            deferRender: true,
            lengthMenu: [
                [5, 10],
                [5, 10],
            ],
            columns: [
                { data: "id"},
                { data: "kode_bgh"},
                { data: "nama_gedung"},
                { 
                    data: "status",
                    render : function(data, type, row, meta){
                        var $rowData = "";
                        var $stat = ''; 
                        if (row.status == "0") {
                            $stat += '<span class="badge bg-azure">Pengisian Checklist</span>';
                        }
                        $rowData +=
                            `<div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            
                                            <p class="d-flex flex-column">
                                                ${$stat}
                                            </p>
                                        </div>
                                    </div>
                            </div>`;
                        return $rowData;
                    }
                },
                { 
                    data: "id",
                    render: function(data, type, row, meta){
                        var $rowData = "";
                        $continuechecklist = "";
                        if (row.status < 3) {
                            $continuechecklist +=`<a class="dropdown-item" href="<?= base_url()?>Bgh/BangunanGedung/BangunanBaru/penilaian/${row.kode_bgh}">
                                Lanjutkan Pengisian Checklist
                            </a>`;
                        }
                        $rowData +=
                            `
                            <div class="dropdown">
                                <button class="btn btn-facebook w-100 btn-icon dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-label="Facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-demo" aria-labelledby="dropdownMenuButton1">
                                    <a class="dropdown-item" href="<?= base_url() ?>Bgh/BangunanGedung/BangunanBaru/permohonan/${row.kode_bgh}">
                                        Edit Data Bangunan & Pemilik
                                    </a>
                                    ${$continuechecklist}
                                </div>
                            </div>`;
                
                    return $rowData
                    }
                },
                // {
                //     data: "id",
                //     render: function (data, type, row, meta) {
                //         var $rowData = '<div class="row">';
                //         var col = 12;
                //         if (typeof row.files != "undefined") {
                //             if (row.files.length == 2) {
                //                 col = 6;
                //             } else if (row.files.length > 2) {
                //                 col = 4;
                //             }
                //             for (var key in row.files) {
                //                 $rowData +=
                //                     `
                //                     <div class="col-sm-` +
                //                     col +
                //                     `">
                //                     <div class="card">
                //                         <img id="" name="" class="img-fluid" src="` +
                //                     row.files[key].path +
                //                     "/" +
                //                     row.files[key].filename +
                //                     `" alt="">
                //                     </div>
                //                     </div>
                //                     `;
                //             }
                //         } else {
                //             if (row.image != null) {
                //                 let text = row.image;
                //                 var myArray = text.split(",");
                //                 row.files = myArray;

                //                 for (var key in row.files) {
                //                     var img = $('<img src="' + row.files[key] + '" />');

                //                     img.on("load", function (e) {}).on("error", function (e) {});

                //                     $rowData +=
                //                         `
                //                     <div class="col-sm-` +
                //                         col +
                //                         `">
                //                         <div class="card">
                //                         <img id="" name="" class="img-fluid" src="` +
                //                         row.files[key] +
                //                         `" alt="">
                //                         </div>
                //                     </div>
                //                         `;
                //                 }
                //             }
                //         }

                //         $rowData += "</div>";

                //         return $rowData;
                //     }, width: "10" 
                // },
                // { data: "judul", width: "200" },
                // {
                //     data: "date",
                //     render: function (data, type, row, meta) {
                //         var mydate = new Date(row.date);
                //         var date = ("0" + mydate.getDate()).slice(-2);
                //         var month = ("0" + (mydate.getMonth() + 1)).slice(-2);
                //         var year = mydate.getFullYear();
                //         var str = date + "/" + month + "/" + year;

                //         var stat = row.status;
                //         if (stat == 1) {
                //             var st = "Publish";
                //             var tex = "text-success";
                //         } else {
                //             var st = "No Publish";
                //             var tex = "text-danger";
                //         }
                //         var $rowData = "";
                //         $rowData +=
                //             `<div class="card">
                //                     <div class="card-body">
                //                     <div class="d-flex justify-content-between">
                //                         <p class="text-success text-sm">
                //                         <i class="far fa-user"></i>
                //                         </p>
                //                         <p class="d-flex flex-column">
                //                             <span class="text-muted" style="font-size:12px;">${
                //                                 row.nama_satker ? row.nama_satker : row.username
                //                             }</span>
                //                         </p>
                //                     </div>
                //                     <div class="d-flex justify-content-between">
                //                         <p class="text-primary text-sm">
                //                         <i class="far fa-calendar-alt"></i>
                //                         </p>
                //                         <p class="d-flex flex-column">
                //                         <span class="text-muted"> ` +
                //             str +
                //             `</span>
                //                         </p>
                //                     </div>
                //                     <div class="d-flex justify-content-between">
                //                         <p class="` +
                //             tex +
                //             ` text-sm">
                //                         <i class="fas fa-sign-in-alt"></i>
                //                         </p>
                //                         <p class="d-flex flex-column ">
                //                         <span class="text-muted">` +
                //             st +
                //             `</span>
                //                         </p>
                //                     </div>
                //                     </div>
                //                 </div>`;

                //         return $rowData;
                //     },width: "300" 
                // },
                // {
                //     data: "bagian", 
                //     render: function (data, type, row, meta) {
                //         // var bag = ['0','SETDITJEN','TIDUR','BPB','PKP','PPLP','PSPAM','PSP-POP'];
                //         var $rowData = "";

                //         switch (row.bagian) {
                //             case "420138":
                //                 $rowData += "DIREKTORAT BINA TEKNIK PERMUKIMAN DAN PERUMAHAN";
                //                 break;
                //             case "420139":
                //                 $rowData += "DIREKTORAT KEPATUHAN INTERN";
                //                 break;
                //             case "452771":
                //                 $rowData += "DIREKTORAT PENGEMBANGAN KAWASAN PERMUKIMAN";
                //                 break;
                //             case "452780":
                //                 $rowData += "DIREKTORAT BINA PENATAAN BANGUNAN";
                //                 break;
                //             case "466162":
                //                 $rowData += "DIREKTORAT KETERPADUAN INFRASTRUKTUR PERMUKIMAN";
                //                 break;
                //             case "466178":
                //                 $rowData += "DIREKTORAT AIR MINUM";
                //                 break;
                //             case "466190":
                //                 $rowData += "DIREKTORAT SANITASI";
                //                 break;
                //             case "622213":
                //                 $rowData += "SEKRETARIAT DIREKTORAT JENDERAL CIPTA KARYA";
                //                 break;
                //             case "631097":
                //                 $rowData +=
                //                     "PUSAT PENGEMBANGAN SARANA PRASARANA PENDIDIKAN, OLAHRAGA DAN PASAR";
                //                 break;
                //             default:
                //                 $rowData = "---";
                //                 break;
                //         }

                //         return $rowData;
                //     }, width: "10" 
                // },
                // {
                //     data: "id",
                //     render: function (data, type, row, meta) {
                //         if(type == 'display'){
                //                 if (typeof row.files != "undefined") {
                //                     var imgFile = [];
                //                     var idImg = [];
                //                     var captImg = [];
                //                     var id_file = row.files[0].id;
                //                     var path = row.files[0].path + "/" + row.files[0].filename;
                //                     var idfile = ''

                //                     var stat = row.status;
                //                     var file = "";
                //                     for (var key in row.files) {
                //                         file = row.files[key].path + "/" + row.files[key].filename;
                //                         idfile = row.files[key].id;
                //                         caption = row.files[key].caption;
                //                         imgFile.push(row.files[key].path + "/" + row.files[key].filename);
                //                         idImg.push(row.files[key].id);
                //                         captImg.push(row.files[key].caption);
                //                     }
                //                 } else {
                //                     if (row.image != null) {
                //                         let text = row.image;
                //                         var myArray = text.split(",");
                //                         row.files = myArray;

                //                         file = myArray[0];
                //                         idfile = 0;
                //                         caption = "";
                //                     } else {
                //                         file = "";
                //                         idfile = 0;
                //                         caption = "";
                //                     }
                //                 }

                //                 var st = "";

                //                 if ($("#role-user").val() == 10) {
                //                     if (row.create_by == $("#id-user").val()) {
                //                         if (stat == 1) {
                //                             st =
                //                                 `<a class="dropdown-item" href="#" onclick="updatepublish('${row.id}',0)"><i class="fas fa-sign-out-alt"></i> No Publish</a>`;
                //                         } else {
                //                             st =
                //                                 `<a class="dropdown-item" href="#" onclick="updatepublish('${row.id}',1)"><i class="fas fa-sign-out-alt"></i> Publish</a>`;
                //                         }
                //                     } else {
                //                         if (row.bagian != 0) {
                //                             if (stat == 1) {
                //                                 st =
                //                                     `<a class="dropdown-item" href="#" onclick="updatepublish('${row.id}',0)"><i class="fas fa-sign-out-alt"></i> No Publish</a>`;
                //                             } else {
                //                                 st =
                //                                     `<a class="dropdown-item" href="#" onclick="updatepublish('${row.id}',1)"><i class="fas fa-sign-out-alt"></i> Publish</a>`;
                //                             }
                //                         }
                //                     }
                //                 } else {
                //                     if (row.bagian == 0) {
                //                         if (stat == 1) {
                //                             st =
                //                                 `<a class="dropdown-item" href="#" onclick="updatepublish('${row.id}',0)"><i class="fas fa-sign-out-alt"></i> No Publish</a>`;
                //                         } else {
                //                             st =
                //                                 `<a class="dropdown-item" href="#" onclick="updatepublish('${row.id}',1)"><i class="fas fa-sign-out-alt"></i> Publish</a>`;
                //                         }
                //                     }
                //                 }

                //                 if (row.isi) {
                //                     var isinya = row.isi.replace(/</g, "~");
                //                     var isinya_1 = isinya.replace(/"/g, "`");
                //                 } else {
                //                     var isinya_1 = "";
                //                 }

                //                 var $rowData = "";
                //                 $rowData +=
                //                     `
                //                 <div class="btn-group" ${
                //                                             row.create_by != $("#id-user").val()
                //                                                 ? row.bagian == 0
                //                                                     ? "hidden"
                //                                                     : ""
                //                                                 : ""
                //                                         }>
                //                 <button type="button" class="btn btn-info">Action</button>
                //                 <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                //                 <span class="sr-only">Toggle Dropdown</span>
                //                 </button>
                //                 <div class="dropdown-menu" role="menu">
                //                 <a class="dropdown-item" href="javascript:void(0)" onclick="editdong('` +
                //                     row.id +
                //                     `','` +
                //                     row.judul +
                //                     `','` +
                //                     row.tag +
                //                     // `','` +
                //                     // isinya_1 +
                //                     `','` +
                //                     file +
                //                     `','` +
                //                     idfile +
                //                     `','` +
                //                     row.bagian +
                //                     `','` +
                //                     row.status +
                //                     `','` +
                //                     imgFile +
                //                     `','` +
                //                     idImg +
                //                     `','` +
                //                     captImg +
                //                     `','` +
                //                     row.date +
                //                     `','` +
                //                     caption +
                //                     `')"><i class="far fa-edit"></i> Edit</a>
                //                 <a class="dropdown-item" href="#" onclick="deleteData('${row.id}', '${idImg}', '${imgFile}')"><i class="far fa-trash-alt"></i> Hapus</a>
                //                     <div class="dropdown-divider"></div>
                //                 ${st}
                //                 </div>
                //             </div>`;
                        
                //         return $rowData
                //         }
                //         return data;
                //     }, width: "10"
                // },
            ],
            fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                var index = iDisplayIndexFull + 1;
                $("td:eq(0)", nRow).html(" " + index);

                return;
            },
            initComplete: function () {
                // this.api().columns().every( function () {
                //     var column = this;
                //     var select = $('<select><option value=""></option></select>')
                //         .appendTo( $(column.header()).empty() )
                //         .on( 'change', function () {
                // 			var val = $.fn.dataTable.util.escapeRegex(
                // 				$(this).val()
                // 				);
                // 				alert(val)
                //             column
                //                 .search( val ? '^'+val+'$' : '', true, false )
                //                 .draw();
                //         } );
                //     column.data().unique().sort().each( function ( d, j ) {
                //         select.append( '<option value="'+d+'">'+d+'</option>' )
                //     } );
                // } );
            },
        });
    }
</script>