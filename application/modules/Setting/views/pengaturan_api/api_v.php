<style type="text/css">
    th {
        text-align: center;
    }

    td {
        text-align: center;
    }
</style>
<div>
    <?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' .
        $this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : ''; ?>
</div>
<div class="portlet light margin-top-20">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject text-primary bold uppercase"><i class=""></i>Pengaturan API</span>
        </div>
        <div class="actions"><a href="#" data-toggle="modal" data-target="#modalApi" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data </a></div>
    </div>
    <div class="portlet-body">
        <div class="">
            <table class="table table-bordered btable">
                <thead>
                    <tr class="info">
                        <th>#</th>
                        <th>Username</th>
                        <th>API Key</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($api as $row) : ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row->username; ?></td>
                            <td><?php echo $row->security_key; ?></td>
                            <td>
                                <a href="javascript:;" class="btn btn-primary btn-edit btn-sm" data-id="<?php echo $row->id_userapi; ?>" title="Ubah Data" data-toggle="modal" data-target="#modal-edit">
                                    <span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="<?php echo site_url('Setting/delete_api/' . $row->id_userapi); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data">
                                    <span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- /.modal -->
<div id="modalApi" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-width="40%" data-keyboard="false">
    <?php echo form_open_multipart('Setting/simpan_api', [
        'class' => 'form-horizontal',
        'role' => 'form',
    ]) ?>
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="ResRes2()"></button>
            <span class="caption-subject text-primary bold uppercase " style="font-size:15px;">Tambah Pengguna Akses API</span>
        </div>

        <div class="modal-body">
            <div class="form-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                <input class="form-control" id="username" name="username" type="text" placeholder="Username" autocomplete="off" required>
                                <label for="form_control_1">Username <span class="required" aria-required="true"> * </span></label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                <input class="form-control api-key" id="apikey" name="api_key" type="text" placeholder="API Key" autocomplete="off" required readonly>
                                <label for="form_control_1">API Key<span class="required" aria-required="true"> * </span></label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <a href="javascript:;" class="btn btn-primary btn-generate">Generate API Key</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" value="">
            <button type="submit" class="btn green"><i class="fa fa-save"></i> Simpan</button>
            <button type="button" data-dismiss="modal" class="btn default" onClick="ResRes2()"><i class="fa fa-sign-out"></i> Batal</button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>


<div id="modalApiEdit" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-width="40%" data-keyboard="false">
    <?php echo form_open_multipart('Setting/simpan_api', [
        'class' => 'form-horizontal',
        'role' => 'form',
    ]) ?>
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="ResRes2()"></button>
            <span class="caption-subject text-primary bold uppercase " style="font-size:15px;">Edit Pengguna Akses API</span>
        </div>

        <div class="modal-body">
            <div class="form-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                <input class="form-control" id="usernameE" name="username" type="text" placeholder="Username" autocomplete="off" required>
                                <label for="form_control_1">Username <span class="required" aria-required="true"> * </span></label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group form-md-line-input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                <input class="form-control api-key" id="apikeyE" name="api_key" type="text" placeholder="API Key" autocomplete="off" required readonly>
                                <label for="form_control_1">API Key<span class="required" aria-required="true"> * </span></label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-md-line-input">
                            <a href="javascript:;" class="btn btn-primary btn-generate">Generate API Key</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" id="idUserApi" value="">
            <button type="submit" class="btn green"><i class="fa fa-save"></i> Simpan</button>
            <button type="button" data-dismiss="modal" class="btn default" onClick="ResRes2()"><i class="fa fa-sign-out"></i> Batal</button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>




<script>
    var SITE_URL = '<?php echo site_url(); ?>';
    $(document).ready(function() {
        $(".btable").DataTable({
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },

                "emptyTable": "Data Belum Tersedia",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ jumlah data",
                "infoEmpty": "Data Tidak Ditemukan",
                "infoFiltered": "",
                "lengthMenu": "Tampilkan _MENU_ Data",
                "search": "Cari:",
                "zeroRecords": "Data Tidak Ditemukan",
                "oPaginate": {
                    "sNext": 'Selanjutnya',
                    "sLast": 'Terakhir',
                    "sFirst": 'Pertama',
                    "sPrevious": 'Sebelumnya'
                }
            },
        });




        function generateUUID() {
            var d = new Date().getTime();

            if (window.performance && typeof window.performance.now === "function") {
                d += performance.now();
            }

            var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = (d + Math.random() * 16) % 16 | 0;
                d = Math.floor(d / 16);
                return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
            });

            return uuid;
        }


        $('.btn-generate').on('click', function() {
            $('.api-key').val(generateUUID());
        });

        $('.btn-edit').click(function(e) {
            e.preventDefault();
            let dataId = $(this).data('id');
            $.ajax({
                type: "POST",
                url: `${SITE_URL}/Setting/edit_api`,
                data: {
                    id: dataId,
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        $('#modalApiEdit').modal('show');
                        $('#usernameE').val(response.username);
                        $('#apikeyE').val(response.security_key);
                        $('#idUserApi').val(response.id_userapi);
                    } else {
                        showToast(response.msg, 15000, 'warning');
                    }
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
    });
</script>