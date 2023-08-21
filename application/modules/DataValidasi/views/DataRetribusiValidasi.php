<form action="Main" class="form-horizontal" role="form" method="post" id="savestatussyarat" name="savestatussyarat" enctype="multipart/form-data">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 align="center" class="caption-subject font-red bold uppercase"><b>Data Pokok Permohonan <?php echo $databgn->no_izin_pbg; ?></b></h4>
	</div>
	<div class="portlet-title">
        <div class="row static-info">
                    <div class="col-md-4 name">Nama Pemilik</div>
                    <div class="col-md-8 value">
                        <?= (isset($data->glr_depan) ? $data->glr_depan : ''); ?>
                        <?= (isset($data->nm_pemilik) ? $data->nm_pemilik : ''); ?>
                        <?= (isset($data->glr_belakang) ? $data->glr_belakang : ''); ?>
                    </div>
                </div>
                <div class="row static-info">
                    <div class="col-md-4 name">Alamat Pemilik</div>
                    <div class="col-md-8 value">
                        <?= (isset($data->alamat) ? $data->alamat : ''); ?>, Kel. <?= (isset($data->nama_kelurahan) ? $data->nama_kelurahan : ''); ?>, Kec. <?= (isset($data->nama_kecamatan) ? $data->nama_kecamatan : ''); ?>,
                        <?= (isset($data->nama_kabkota) ? ucwords(strtolower($data->nama_kabkota)) : ''); ?>, Prov. <?= (isset($data->nama_provinsi) ? $data->nama_provinsi : ''); ?>
                    </div>
                </div>
                <!--<div class="row static-info">
                    <div class="col-md-4 name">Jenis Konsultasi</div>
                    <div class="col-md-8 value"><?= (isset($databgn->nm_konsultasi) ? $data->nm_konsultasi : ''); ?></div>
                </div>-->
                <div class="row static-info">
                    <div class="col-md-4 name">Lokasi Bangunan Gedung</div>
                    <div class="col-md-8 value">
                        <?= (isset($databgn->almt_bgn) ? $databgn->almt_bgn : ''); ?>, Kel. <?= (isset($databgn->nama_kelurahan) ? $databgn->nama_kelurahan : ''); ?>, Kec. <?= (isset($data->nama_kecamatan) ? $data->nama_kecamatan : ''); ?>,
                        <?= (isset($databgn->nama_kabkota) ? ucwords(strtolower($databgn->nama_kabkota)) : ''); ?>, Prov. <?= (isset($databgn->nama_provinsi) ? $databgn->nama_provinsi : ''); ?>
                    </div>
                </div>

                <!--<div class="row static-info">
				<div class="col-md-4 name">Fungsi dan Jenis Bangunan Gedung</div>
				<div class="col-md-8 value">
					<?php echo set_value('fungsi_bg', (isset($fungsi_bg) ? $fungsi_bg : '')) ?> - <?php echo set_value('jns_bangunan', (isset($jns_bangunan) ? $jns_bangunan : '')) ?>
				</div>
			</div>-->
                <?php if ($databgn->id_jenis_permohonan == '11' || $databgn->id_jenis_permohonan == '29' || $databgn->id_jenis_permohonan == '30' || $databgn->id_jenis_permohonan == '31' || $databgn->id_jenis_permohonan == '32') { ?>
                    <div class="row static-info">
                        <div class="col-md-4 name">Data Bangunan Kolektif</div>
                        <div class="col-md-8 value">
                            <table class="table table-striped table-bordered dt-responsive wrap" id="tipe_bgn2">
                                <tr>
                                    <th>Tipe</th>
                                    <th>Jumlah Unit</th>
                                    <th>Luas</th>
                                    <th>Tinggi</th>
                                    <th>Lantai</th>
                                </tr>
                                <?php
                                $tipe = json_decode($databgn->tipeA);
                                $jumlah = json_decode($databgn->jumlahA);
                                $luas = json_decode($databgn->luasA);
                                $tinggi = json_decode($databgn->tinggiA);
                                $lantai = json_decode($databgn->lantaiA);
                                $bangunan = array();
                                foreach ($tipe as $noo => $val) {
                                    if ($val != "")
                                        $bangunan['tipe'][$noo] = $val;
                                }
                                foreach ($jumlah as $noo => $val) {
                                    if ($val != "")
                                        $bangunan['jumlah'][$noo] = $val;
                                }
                                foreach ($luas as $noo => $val) {
                                    if ($val != "")
                                        $bangunan['luas'][$noo] = $val;
                                }
                                foreach ($tinggi as $noo => $val) {
                                    if ($val != "")
                                        $bangunan['tinggi'][$noo] = $val;
                                }
                                if (!empty($lantai))
                                    foreach ($lantai as $noo => $val) {
                                        if ($val != "")
                                            $bangunan['lantai'][$noo] = $val;
                                    }
                                $no = 0;
                                if (!empty($bangunan)) {
                                    foreach ($bangunan['tipe'] as $dt) {
                                        $no++; ?>
                                        <tr id="tr-tipe<?php echo $no ?>">
                                            <td><?php echo form_input('tipeA[' . $no . ']', $bangunan['tipe'][$no], 'style="width:90px;" id="posisi' . $no . '" class="posisi' . $no . ' form-control"'); ?></td>
                                            <td><?php echo form_input('jumlahA[' . $no . ']', $bangunan['jumlah'][$no], 'style="width:90px;" id="posisi' . $no . '" class="posisi' . $no . ' form-control"'); ?></td>
                                            <td><?php echo form_input('luasA[' . $no . ']', $bangunan['luas'][$no], 'style="width:90px;" id="luas' . $no . '" class="luas' . $no . ' form-control"'); ?></td>
                                            <td><?php echo form_input('tinggiA[' . $no . ']', $bangunan['tinggi'][$no], 'style="width:90px;" id="tinggi' . $no . '" class="tinggi' . $no . ' form-control"'); ?></td>
                                            <td><?php echo form_input('lantaiA[' . $no . ']', !empty($bangunan['lantai'][$no]) ? $bangunan['lantai'][$no] : '', 'style="width:90px;" id="lantai' . $no . '" class="lantai' . $no . ' form-control"'); ?></td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr id="tr-tipe">
                                        <td><?php echo form_input('tipeA[1]', '', 'style="width:85px;" id="posisi1" class="posisi1 form-control"'); ?></td>
                                        <td><?php echo form_input('jumlahA[1]', '', 'style="width:85px;" id="posisi1" class="posisi1 form-control"'); ?></td>
                                        <td><?php echo form_input('luasA[1]', '', 'style="width:85px;" id="luas1" class="unit1 form-control"'); ?></td>
                                        <td><?php echo form_input('tinggiA[1]', '', 'style="width:85px;" id="tinggi1" class="tinggi1 form-control"'); ?></td>
                                        <td><?php echo form_input('lantaiA[1]', '', 'style="width:85px;" id="lantai1" class="tinggi1 form-control"'); ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                <?php } else  if ($databgn->id_jenis_permohonan == '21'){?>
					 <div class="row static-info">
                        <div class="col-md-4 name">Luas, Tinggi & Jumlah Lantai</div>
                        <div class="col-md-8 value">
                            <?= (isset($databgn->luas_bgp) ? $databgn->luas_bgp : '') ?> m<sup>2</sup>, dengan tinggi <?= (isset($databgn->tinggi_bgp) ? $databgn->tinggi_bgp : '') ?> meter dan berjumlah <?= (isset($databgn->jml_lantai) ? $databgn->jml_lantai : '') ?> lantai.
                        </div>
                    </div>
				<?php }else{ ?>
                    <div class="row static-info">
                        <div class="col-md-4 name">Luas, Tinggi & Jumlah Lantai</div>
                        <div class="col-md-8 value">
                            <?= (isset($databgn->luas_bgn) ? $databgn->luas_bgn : '') ?> m<sup>2</sup>, dengan tinggi <?= (isset($databgn->tinggi_bgn) ? $databgn->tinggi_bgn : '') ?> meter dan berjumlah <?= (isset($databgn->jml_lantai) ? $databgn->jml_lantai : '') ?> lantai.
                        </div>
                    </div>
                <?php } ?>
		
                <?php if ($databgn->status_perhitungan == null) { ?>

                <?php } else { ?>
                    <!-- update penerbitan retribusi otomatis -->
                    <div class="row static-info">
                        <div class="col-md-4 name">Status Perhitungan:</div>
                        <div class="col-md-8 value">
                            <?php echo $databgn->status_perhitungan == 2 ? 'Hitung Berdasarkan PERDA' : 'Hitung Berdasarkan Sistem'; ?>
                        </div>
                    </div>
                    <?php if ($databgn->status_perhitungan == 1) : ?>
                        <div class="sistem-retribusi">
                            <h5 class="caption-subject font-red bold uppercase">Detail Indeks Terintegrasi</h5>
                            <div class="row static-info">
                                <div class="col-md-4 name">
                                    Indeks Parameter Fungsi Bangunan :
                                </div>
                                <div class="col-md-8 value parameter-fungsi">
                                    <?php echo "{$databgn->fungsi_bg} ({$databgn->parameter_fungsi})"; ?>
                                </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-4 name">
                                    Indeks Parameter Kompleksitas :
                                </div>
                                <div class="col-md-8 value parameter-kompleksitas">
                                    <?php $klasifikasi  = $databgn->klasifikasi_bg == NULL ? '' : $databgn->klasifikasi_bg ?>
                                    <?php echo "{$klasifikasi} ($databgn->parameter_kompleksitas)"; ?>
                                </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-4 name">
                                    Indeks Parameter Fungsi Bangunan:
                                </div>
                                <div class="col-md-8 value parameter-permanensi">
                                    <?php $permanensi = $databgn->id_permanensi == 1 ? 'Permanen' : 'Non Permanen'; ?>
                                    <?php echo "{$permanensi} ($databgn->parameter_permanensi)"; ?>
                                </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-4 name">
                                    Indeks Parameter Ketinggian:
                                </div>
                                <div class="col-md-8 value parameter-ketinggian">
                                    <?php echo "{$databgn->tinggi_bgn} Meter ($databgn->parameter_ketinggian)"; ?>
                                </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-4 name">
                                    Faktor Kepemilikan:
                                </div>
                                <div class="col-md-8 value faktor-kepemilikan">
                                    <?php $kepemilikan = $databgn->id_fungsi_bg == 1 ? 1 : 0; ?>
                                    <?php echo $kepemilikan; ?>
                                </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-4 name">
                                    Indeks Terintegrasi:
                                </div>
                                <div class="col-md-8 value indeks-integrasi">
                                    <?php echo $databgn->indeks_integrasi; ?>
                                </div>
                            </div>
                            <h5 class="caption-subject font-red bold uppercase">Hasil Perhitungan Retribusi Bangunan</h5>
							<?php if($databgn->id_izin == '7'){
								$luas_bangunan	=$databgn->luas_bgp;
							}else if($databgn->id_izin == '4'){
								//$luas_bangunan	= $bangunan['luas'] * $bangunan['jumlah'];
							}else{
								$luas_bangunan	=$databgn->luas_bgn;
							}?>
                            <div class="row static-info">
                                <div class="col-md-4 name">Luas Bangunan Gedung</div>
                                <div class="col-md-8 value luas-bangunan">
                                    <?php echo "{$luas_bangunan} m<sup>2</sup>"; ?>
                                </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-4 name">SHST (Standar Harga Satuan Tertinggi):</div>
                                <div class="col-md-8 value shst">
                                    Rp. <?php echo str_replace(',', '.', number_format($databgn->shst)) ?>
                                </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-4 name">Indeks Lokalitas</div>
                                <div class="col-md-8 value indeks-lokalitas">
                                    <?php echo $databgn->indeks_lokalitas; ?>
                                </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-4 name">
                                    Kegiatan:
                                </div>
                                <div class="col-md-8 value kegiatan">
                                    <?php $parameter_kegiatan = "{$databgn->prefix1} x {$databgn->prefix2} = {$databgn->index_kegiatan}"; ?>
                                    <?php echo "{$databgn->nama_kegiatan} ({$parameter_kegiatan})"; ?>
                                </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-4 name">
                                    Nilai Retribusi Bangunan:
                                </div>
                                <div class="col-md-8 value hasil-retribusi-bgn">
                                    <?php
                                    $nilai_retribusi_bangunan = str_replace(',', '.', number_format($databgn->nilai_retribusi_bangunan));
                                    $hasil_retribusi = "{$databgn->luas_bgn} x ({$databgn->indeks_lokalitas} x {$databgn->indeks_integrasi} x {$databgn->index_kegiatan}) = Rp.{$nilai_retribusi_bangunan}"; ?>
                                    <?php echo $hasil_retribusi; ?>
                                </div>
                            </div>
                            <h5 class="caption-subject font-red bold uppercase">Hasil Perhitungan Retribusi Prasarana</h5>
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr style="padding-left: 5px; padding-bottom:3px;  font-weight:bold">
                                        <th>No</th>
                                        <th>Nama Sarana</th>
                                        <th>Harga Prasarana</th>
                                        <th>Panjang/Luas/Volume</th>
                                        <th>Total Prasarana </th>
                                    </tr>
                                <tbody id="dataPrasarana">
                                    <?php
                                    $no = 1;
                                    foreach ($prasarana as $p) : ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $p->nama_prasarana ?></td>
                                            <td><?php echo $p->harga_prasarana ?></td>
                                            <td><?php echo $p->plv ?></td>
                                            <td><?php echo $p->total_prasarana ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                </tbody>
                            </table>
                            <div class="row static-info">
                                <div class="col-md-4 name">
                                    Nilai Retribusi Prasarana:
                                </div>
                                <div class="col-md-8 value nilai-retribusi-prasarana">
                                    Rp. <?php echo str_replace(',', '.', number_format($databgn->nilai_retribusi_prasarana)) ?>
                                </div>
                            </div>
                            <h5 class="caption-subject font-red bold uppercase">Hasil Perhitungan Retribusi Keseluruhan</h5>
                            <div class="row static-info">
                                <div class="col-md-4 name">
                                    Nilai Retribusi Keseluruhan:
                                </div>
                                <div class="col-md-8 value nilai-retribusi-keseluruhan">
                                    Rp. <?php echo str_replace(',', '.', number_format($databgn->nilai_retribusi_keseluruhan)) ?>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="row static-info">
                            <div class="col-md-4 name">Perhitungan Retribusi</div>
                            <div class="col-md-8 value">
                                <a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/konsultasi/' . $databgn->id . '/retribusi/berkas_retribusi/' . $databgn->file_retribusi); ?>')" class="btn default btn-xs blue-stripe">Lihat Perhitungan Retribusi</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- end update penerbitan retribusi otomaatis -->
                <?php } ?>
				<h5 class="caption-subject font-red bold uppercase">SKRD dan SSRD</h5>
				<div class="row static-info">
                    <div class="col-md-4 name">Surat Keterangan Retribusi Daerah</div>
					<div class="col-md-8 value nilai-retribusi-keseluruhan">
                        <a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('dekill/Payment/'.$databgn->dir_file_penagihan);?>')" class="btn default btn-md blue-stripe" >Berkas SKRD</a>
                    </div>
                </div>
				<div class="row static-info">
                    <div class="col-md-4 name">Surat Setoran Retribusi Daerah</div>
					<div class="col-md-8 value nilai-retribusi-keseluruhan">
                        <a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('dekill/Payment/'.$databgn->bukti_pembayaran);?>')" class="btn default btn-md blue-stripe" >Berkas SKRD</a>
                    </div>
                </div>
                <?php echo ($this->session->flashdata('message') != '') ? '<div id="infoMessage" align="center" class="alert alert-' . $this->session->flashdata('status') . '">' . $this->session->flashdata('message') . '</div>' : ''; ?>
            </div>
	
</form>

<div id="PDFViewer" class="modal fade" aria-hidden="true" data-width="75%">
	<div class="modal-body">
		<div>
			<embed id="pdfdataid" src="" frameborder="1" width="100%" height="750px">

		</div>
		<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-primary"><i class="fa fa-sign-out"></i> Tutup</button>
			</div>
	</div>
</div>
<script type="text/javascript">
	$(document).on("click",".open-PDFViewer", function(){
		var datapdf = $(this).data("id");
		$(".modal-body #pdfdataid").attr("src", datapdf);
		
	});
	$('#dir_file_pemberitahuan').change(function() {
		var filename_pemberitahuan = $(this).val();
		var lastIndex = filename_pemberitahuan.lastIndexOf("\\");
		if (lastIndex >= 0) {
			filename_pemberitahuan = filename_pemberitahuan.substring(lastIndex + 1);
		}
		$('#filename_pemberitahuan').val(filename_pemberitahuan);
	});

	function popWin(x) {
		url = x;
		swin = window.open(url, 'win', 'scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
	function batal() {
		location.reload();
	}
</script>