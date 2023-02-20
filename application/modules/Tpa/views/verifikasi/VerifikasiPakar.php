<div class="portlet box blue">
  <div class="portlet-title">
    <div class="caption"><i class="fa fa-globe"></i>List Verifikasi Tenaga Ahli</div>
    <div class="tools"><a href="javascript:;" class="reload"></a></div>
  </div>
  <div class="portlet-body">
    <div class="form-actions">
      <?php echo form_open('Tpa/Verifikasi', array('name' => 'frmListVerifikasi', 'id' => 'frmListVerifikasi')); ?>
    </div>
    <table class="table table-striped table-bordered table-hover" id="sample_1">
      <?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
      <thead>
        <tr>
            <th>No</th>
            <th>Nama Tenaga Ahli</th>
            <th>Sub Unsur Pakar</th>
            <th>Surat Rekomendasi</th>
            <th>Keterangan</th>
            <th>Status Verifikasi</th>
            <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($tpa_result->num_rows() > 0) {
          $no = 1;
          foreach ($tpa_result->result() as $key) { ?>
            <?php if($key->status =='3'){
              $status = "Sudah DiVerifikasi";
              $keterangan = "Data Sesuai";
            } else if($key->status =='2'){
              $status ="Verifikasi dikembalikan ke Pemohon Tenaga Ahli";
              $keterangan = "Data Tidak Sesuai";
            } else if ($key->status =='1'){
              $status ="Belum Diverifikasi";
              $keterangan ="-";
            }else if($key->status =='5'){
              $status ="Didaftarkan Oleh Pemda";
              $keterangan ="-";
            }else{
              $status ="Belum Ditentukan";
            }
            ?>
            <tr>
              <td align="center"><?php echo $no++; ?></td>
              <td><?php echo $key->glr_depan; ?> <?php echo $key->nm_tpa; ?> <?php echo $key->glr_blkg; ?></td>
              <td></td>
              <td><a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/Tpa/' . $key->id . '/' . $key->dir_file); ?>')" class="btn default btn-xs blue-stripe">Lihat</a></td>
              <td><?php echo $keterangan; ?></td>
              <td><?php echo $status; ?></td>
              <?php if($key->status =='1'){ ?>
                  <a href="<?php echo site_url('Tpa/VerifikasiForm/' . $key->id); ?>" class="btn btn-success btn-sm" title="Ubah Data Personil" data-toggle="modal" data-target="#static"><span class="glyphicon glyphicon-edit"></span></a>
                <?php } else {

                } ?>

            </tr>
			    <?php }
        } ?>
      </tbody>
    </table>
  </div>
</div>
<!-- /.modaledit -->
<div id="static" class="modal fade bs-modal-lg" data-width="40%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-content">
    <div class="modal-body">
      
    </div>
    </div>
    <div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn blue" onClick="ResRes2()"><i class="fa fa-sign-out"></i> Tutup</button>
    </div>
  </div>
</div>
<script>
function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
	}
</script>