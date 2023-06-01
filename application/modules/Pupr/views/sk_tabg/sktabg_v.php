<style type="text/css">
    th {
        text-align: center;
    }

    td {
        text-align: center;
    }
</style>
<div class="portlet light margin-top-20">
    <div class="portlet-title tabbable-line">
        <div class="caption caption-md">
            <i class="icon-globe theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase">
                <i class="fa fa-list-alt"></i>
                SK Tenaga Propesional Ahli(TPA)</span>
        </div>
        <div class="pull-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#responsive">Tambah Data SK <i class="fa fa-plus"></i></button>
        </div>

    </div>
    <div class="portlet-body">
        <div>
            <?php
            echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' .
                $this->session->flashdata('message') . '<button class="close" data-close="alert">' . '</button>' . '</div>' : '';
            ?>
        </div>
        <div>
            <table class="table table-bordered table-hover" id="regularTable">
                <thead>
                    <tr class="warning">
                        <th>#</th>
                        <th>Nomor SK</th>
                        <th>Tanggal Penerbitan</th>
                        <th>Masa Berlaku</th>
                        <th>Personil</th>
                        <th>Berkas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($sk_tabg->num_rows() > 0) {
                        $no = 1;

                        foreach ($sk_tabg->result() as $r) {
                    ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $r->no_skta; ?></td>
                                <td><?php echo $r->tgl_skta; ?></td>
                                <td><?php echo $r->expired_skta; ?></td>
                                <td><a href="<?php echo site_url('pupr/pengaturan_sk_tabg_edit/' . $r->id_skta); ?>" class="btn btn-success btn-sm" title="Ubah Data Personil" data-toggle="modal" data-target="#modal-edit-personal"><span class="glyphicon glyphicon-user"></span></a></td>
                                <td>
                                    <a href="javascript:void(0);" class="btn purple btn-sm" title="Lihat Berkas" onClick="javascript:getPdf('<?php echo $r->file_skta ?>')"> <i class="fa fa-file"></i> Lihat Berkas</a>
                                </td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="#" onClick="ubahSkta('<?php echo $r->id_skta; ?>')"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="<?php echo site_url('pupr/sk_tabg_delete/' . $r->id_skta); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ini?')" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- /.modaledit -->
<div id="modal-edit-personal" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Data Personil</h4>
        </div>
        <?php
        //$row = "";
        $this->load->view('personil');
        //include "personil.php"; 
        ?>
    </div>

</div>

<!-- /.modal -->
<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
    <?php echo form_open_multipart('pupr/sktabg_save', [
        'class' => 'form-horizontal',
        'role' => 'form',
        'id' => 'plus_sktabg'
    ]) ?>
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Form Data SK</h4>
        </div>
        <div class="modal-body">
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Nomor SK</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="no_skta" placeholder="Nomor SK" autocomplete="off">
                        <input type="hidden" class="form-control" name="id_skta" placeholder="id" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tanggal Penerbitan</label>
                    <div class="col-md-9">
                        <input class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="tgl_skta" placeholder="Tanggal Penerbitan" autocomplete="off" onkeydown="return false">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Masa Berlaku</label>
                    <div class="col-md-9">
                        <input class="form-control" id="thndatepicker" type="text" name="expired_skta" placeholder="Masa Berlaku" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Lampiran</label>
                    <div class="col-md-9">
                        <input type="file" name="berkas">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn red" onClick="ResRes2()"><i class="fa fa-sign-out"></i> Batal</button>
            <button type="submit" class="btn green"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<script>
    $(document).ready(function() {


        $("#thndatepicker").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });

        $("#regularTable").DataTable({
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "Data Belum Tersedia",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ jumlah data",
                "infoEmpty": "Data Tidak Ditemukan",
                "infoFiltered": "",
                "lengthMenu": "Show _MENU_ entries",
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

        $("#plus_sktabg").validate({
            // Specify the validation rules
            rules: {
                no_sk_tabg: "required",
                tgl_sk_tabg: "required",
                untuk_tahun: "required",
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
                no_skta: "Masukan Nomor SK",
                tgl_skta: "Masukan Tanggal Penerbitan",
                expired_skta: "Masukan Masa Berlaku",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });


    });

    function ubahSkta(id) {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('pupr/sk_tabgedit/') ?>",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(data) {
                $.each(data, function() {
                    $('#responsive').modal('show');
                    $('[name="id_skta"]').val(data.id_skta);
                    $('[name="no_skta"]').val(data.no_skta);
                    $('[name="tgl_skta"]').val(data.tgl_skta);
                    $('[name="expired_skta"]').val(data.expired_skta);
                });
            }
        });
        return false;
    };

    function getPdf(id) {
        url = "<?php echo base_url() . index_page() ?>public/uploads/pupr/sk/sk_tabg/" + id;
        swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
        swin.focus();
    }

    function ResRes2() {
        document.getElementById("plus_skteknis").reset();
    };
</script>