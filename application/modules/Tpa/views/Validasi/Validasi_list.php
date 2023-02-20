<div class="portlet box blue">
  <div class="portlet-title">
    <div class="caption"><i class="fa fa-globe"></i>List Validasi Tenaga Ahli</div>
    <div class="tools"><a href="javascript:;" class="reload"></a></div>
  </div>
  <div class="portlet-body">
    <div class="form-actions">
      <?php echo form_open('Tpa/Validasi', array('name' => 'frmListValidasi', 'id' => 'frmListValidasi')); ?>
      <div class="row">
				<div class="col-md-12">
					<div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Unsur TPA</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<select class="form-control select2me" name="id_lembaga">
									<option value="0">Semua Unsur</option>
									<option value="1" <?php if (isset($id_lembaga) && $id_lembaga == 1) echo "selected"; ?>>Akademisi</option>
									<option value="2" <?php if (isset($id_lembaga) && $id_lembaga == 2) echo "selected"; ?>>Pakar</option>
									<option value="3" <?php if (isset($id_lembaga) && $id_lembaga == 3) echo "selected"; ?>>Profesi Ahli</option>
								</select>
							</div>
						</div>
					</div>
          <div class="form-group col-md-12">
						<label class="control-label col-md-3"><b>Status TPA</b></label>
						<div class="col-md-9">
							<div class="col-md-5">
								<select class="form-control select2me" name="status">
									<option value="0">Status</option>
                  <option value="1" <?php if (isset($status) && $status == 1) echo "selected"; ?>>Belum Diverifikasi</option>
									<option value="3" <?php if (isset($status) && $status == 3) echo "selected"; ?>>Diverifikasi Akademisi/Asosiasi</option>
									<option value="5" <?php if (isset($status) && $status == 5) echo "selected"; ?>>Didaftarkan Pemda</option>
                  <option value="2" <?php if (isset($status) && $status == 2) echo "selected"; ?>>Dikembalikan ke Calon TPA</option>
								</select>
							</div>
						</div>
					</div>
          <div class="form-group col-md-12">
						<label class="control-label col-md-3"><b></b></label>
						<div class="col-md-9">
							<div class="col-md-12">
								<input type="submit" class="btn green" id="search" name="search" value="Pencarian">
								<button type="submit" class="btn green" onclick="resetCari()">Reset</button>
							</div>
						</div>
					</div>


				</div>
			</div>
    </div>
    
    <table class="table table-striped table-bordered table-hover" id="sample_1">
      <?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
      <thead>
        <tr class="warning">
          <th>No</th>
          <th>Nama Tenaga Ahli</th>
          <th>Keahlian</th>
          <th>Unsur</th>
          <th>Sub-Unsur</th>
          <th>Tahun Penetapan</th>
          <th>Status TPA</th>
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
            }else{
              $status ="-";
            }
            ?>
            <tr>
              <td align="center"><?php echo $no++; ?></td>
              <td><?php echo $key->nm_tpa; ?></td>
              <td></td>
                <?php if($key->id_lembaga =='1'){
                  $unsur ="Akademisi";
                }else if($key->id_lembaga =='2'){
                  $unsur ="Pakar";
                }else if($key->id_lembaga =='3'){
                  $unsur ="Profesi Ahli";
                }else{
                  $unsur ="Belum Ditentukan";
                }?>
              <td><?php echo $unsur; ?></td>
                <?php if($key->id_lembaga =='2'){
                   $sub_unsur = $key->nm_asosiasi;
                } else {
                  $sub_unsur ='-';
                } ?>
              <td align="center"><?php echo $sub_unsur;?></td>
              <td></td>
              <td><?php echo $status; ?></td>
              <td>
                <a href="#" class="btn btn-success btn-sm" title="Ubah Data Personil" data-toggle="modal" d><span class="glyphicon glyphicon-user"></span></a>
              </td>
            </tr>
        <?php }
        } ?>
      </tbody>
    </table>
  </div>
</div>
<!-- /.modaledit -->
<div id="static" class="modal fade bs-modal-lg" data-width="60%" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-content">
    <div class="modal-header">
    </div>
    <div class="modal-body">
      
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn blue" onClick="ResRes2()"><i class="fa fa-sign-out"></i> Tutup</button>
    </div>
  </div>
</div>