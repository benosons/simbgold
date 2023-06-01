<style>
  table,
  th {
    text-align: center;
  }

  .modal.fade.in {
    top: 40%;
  }
</style>
<div class="row">
	<?php $this->load->view('HeaderRetribusi') ?>
	<div class="col-md-12">
		<div class="portlet light " id="form_wizard_1">
			<div class="portlet-title">
				<div class="caption">
				  <i class="fa fa-edit font-red"></i>
				  <span class="caption-subject font-red bold uppercase">Perhitungan Retribusi
				  </span>
				</div>
			</div>
			<div class="col-md-12">
				<form action="<?php echo site_url('retribusi/retribusi_form/'.$id);?>" class="form-horizontal" role="form" method="post" id="ret_nya" enctype="multipart/form-data">
					<div class="portlet light">
						<div class="portlet-title">
							<h4 align="center" class="caption-subject font-red bold uppercase">.:: Indeks Terintegrasi ::.</h4><hr/>
							<div class="row">
								<div class="col-md-12">	
									<input style="display: none;" name="id_retribusi" class="form-control" value='<?php echo set_value('id_retribusi', (isset($id_penetapan_retribusi) ? $id_penetapan_retribusi : ''))?>' id="id_penetapan_retribusi" type="text">	
								</div>
								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-mail-forward"></i></span>
											<select class="form-control" name="id_cara_penetapan" id="id_cara_penetapan" onchange="getcarapenetapan(this.value)">
												<option value="" <?php if($id_cara_penetapan == '') echo "selected";?>>Pilih</option>
												<option value="1" <?php if($id_cara_penetapan == '1') echo "selected";?>>Otomatis</option>
												<option value="2" <?php if($id_cara_penetapan == '2') echo "selected";?>>Manual</option>
											</select>
											<label for="form_control_1">Cara Penetapan Retribusi</label>				
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<div class="input-group">
											<?if($harga_satuan != '' || $harga_satuan != null){?>
												<?php
													$harga_satuan_convert = number_format($harga_satuan,0,'','.');
												?>
											<?}else{?>
												<?php
													$harga_satuan_convert = '';
												?>
											<?}?>
											<span class="input-group-addon">( Rp. )</span>
											<input name="harga_satuan" class="form-control" value='<?php echo set_value('harga_satuan_convert', (isset($harga_satuan_convert) ? $harga_satuan_convert : ''))?>' onblur="angka(this);getBagi(this.value);" onKeyup="angka(this);getBagi(this.value);" id="harga_satuan" type="text" placeholder="0-9">	
											<label for="form_control_1">Harga Satuan/HSbg </label>
										</div>
										<br>
									</div>
								</div>
								<div id="manual" style="display: none;">
									<div class="col-md-6">
										<div class="form-group form-md-line-input">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
												<?php if($id_retribusi != '' || $id_retribusi != null){?>
													<?php if ($dir_file_retribusi != ""){ ?>
														<a href="javascript:void(0);" onClick="javascript:popWin('<?php echo base_url('file/imb/pengajuan_imb/'.$id_permohonan.'/retribusi/'.$dir_file_edit_perhitungan);?>')" class="btn default btn-md blue-stripe" >Berkas Penghitungan Retribusi</a>
													<?}else{?>
														<a class="btn default btn-md blue-stripe" disabled>Berkas Penghitungan Retribusi Kosong</a>
													<?}?>
												<?}else{?>
													<input style="display: none;" name="dir_file_retribusi" id="dir_file_retribusi" onchange='cekok()'>
													<input type="file" class="form-control" name="d_file_p" id="d_file_p" onchange='cekok()'>
													<label for="form_control_1">Berkas Penghitungan Retribusi</label>
												<?}?>	
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group form-md-line-input">
											<div class="input-group">	
												<? if($harga_retribusi != '' || $harga_retribusi != null){?>
													<?php
														$besar_retribusi_convert = number_format($harga_retribusi,0,'','.');
													?>
												<?}else{?>
													<?php
														$besar_retribusi_convert = '';
													?>
												<?}?>
												<span class="input-group-addon">( Rp. )</span>
												<input size="20" name="besar_retribusi_convert" class="form-control" value='<?php echo set_value('besar_retribusi_convert', (isset($besar_retribusi_convert) ? $besar_retribusi_convert : ''))?>' onblur="angka(this);getBagi(this.value);" onKeyup="angka(this);getBagi(this.value);" id="besar_retribusi_convert" placeholder="0-9" type="text">
												<label for="form_control_1">Besar Retribusi</label>	
											</div>
										</div>
									</div>	
								</div>
								<div id="otomatis" style="display: blok;">	
									<div class="col-md-12">
										<table class="table table-bordered table-striped table-hover">
											<tr class="info">
												<th width="30%">Fungsi <?php echo $nama_fungsi; ?></th>
												<th>Indeks = <?php echo $index_fungsi; ?></th>
											</tr>
										<tr class="info">
											<th width="30%">Klasifikasi</th>
											<th>
												<table>
													<tr>
														<td>Kompleksitas</td>
														<td>:</td>
														<td>0.25 x <input size="3" class="input2" value='<?php echo $index_klasifikasi_bg;?>' type="text" readonly></td>
														<td> = 
															<input size="6" class="input2" value='<?php $hasil = 0.25* $index_klasifikasi_bg; echo $hasil;?>' type="text" readonly>
															<?=(isset($klasifikasi_bg)? $klasifikasi_bg : '') ;?>
														</td>
													</tr>
										<tr>
											<td>Permanensi</td>
											<td>:</td>
											<td>0.20 x <input size="3" name="permanensi" class="input2" value='<?php echo set_value('permanensi', (isset($permanensi) ? $permanensi :0))?>' id="permanensi" type="text" readonly></td>
											<td> =
												<input size="6" name="hasil_permanensi" class="input2" value='<?php echo set_value('hasil_permanensi', (isset($hasil_permanensi) ? $hasil_permanensi :''))?>' id="hasil_permanensi" type="text" readonly> <?php
												$selected = '';
													if(isset($id_permanensi) && trim($id_permanensi) != '')
														$selected = $id_permanensi;
														$js = 'id="list_klas_detail2" onchange="fhitung(this.value)"';							
													echo form_dropdown('list_klas_detail2',$listKlasDetail2,$selected,$js); ?>
											</td>
										</tr>
										<tr>
											<td>Resiko Kebakaran</td>
											<td>:</td>
											<td>0.15 x <input size="3" name="resiko_kebakaran" class="input2" value='<?php echo set_value('resiko_kebakaran', (isset($resiko_kebakaran) ? $resiko_kebakaran :0))?>' id="resiko_kebakaran" type="text" readonly></td><td> =
											<input size="6" name="hasil_resiko_kebakaran" class="input2" value='<?php echo set_value('hasil_resiko_kebakaran', (isset($hasil_resiko_kebakaran) ? $hasil_resiko_kebakaran :0))?>' id="hasil_resiko_kebakaran" type="text" readonly> <?php
							$selected = '';
							if(isset($id_resiko_kebakaran) && trim($id_resiko_kebakaran) != '')
								$selected = $id_resiko_kebakaran;
								
							$js = 'id="list_klas_detail3" onchange="fhitung(this.value)"';							
							echo form_dropdown('list_klas_detail3',$listKlasDetail3,$selected,$js);
						?></td>
										</tr>
										
										<tr>
											<td>Zonasi Gempa</td>
											<td>:</td>
											<td>0.15 x <input size="3" name="val_zonasi_gempa" class="input2" value='<?php echo set_value('val_zonasi_gempa', (isset($val_zonasi_gempa) ? $val_zonasi_gempa :0))?>' id="val_zonasi_gempa" type="text" readonly></td><td> =
											<input size="6" name="hasil_zonasi_gempa" class="input2" value='<?php echo set_value('hasil_zonasi_gempa', (isset($hasil_zonasi_gempa) ? $hasil_zonasi_gempa :0))?>' id="hasil_zonasi_gempa" type="text" readonly> <?php
							$selected = '';
							if(isset($id_zona_gempa) && trim($id_zona_gempa) != '')
								$selected = $id_zona_gempa;
								
							$js = 'id="list_klas_detail4" onchange="fhitung(this.value)"';							
							echo form_dropdown('list_klas_detail4',$listKlasDetail4,$selected,$js);
						?></td>
										</tr>
										<tr>
											<td>Lokasi</td>
											<td>:</td>
											<td>0.10 x <input size="3" name="lokasi" class="input2" value='<?php echo set_value('lokasi', (isset($lokasi) ? $lokasi :0))?>' id="lokasi" type="text" readonly></td><td> =
											<input size="6" name="hasil_lokasi" class="input2" value='<?php echo set_value('hasil_lokasi', (isset($hasil_lokasi) ? $hasil_lokasi :0))?>' id="hasil_lokasi" type="text" readonly> <?php
							$selected = '';
							if(isset($id_lokasi) && trim($id_lokasi) != '')
								$selected = $id_lokasi;
								
							$js = 'id="list_klas_detail5" onchange="fhitung(this.value)"';							
							echo form_dropdown('list_klas_detail5',$listKlasDetail5,$selected,$js);
						?></td>
										</tr>
										<tr>
											<td>Ketinggian Bangunan Gedung</td>
											<td>:</td>
											<td>0.10 x 
											<input size="3" class="input2" value='<?php echo $ketinggian;?>' type="text" readonly>
											</td>
											<td> = 
											<input size="6" class="input2" value='<?php $hasil_tinggi = 0.10* $ketinggian; echo $hasil_tinggi;?>' type="text" readonly>
											<?=(isset($hketinggian)? $hketinggian : '') ;?>
											</td>
											<!--td>0.10 x <input size="3" name="ketinggian_bg" class="input2" value='<?php echo set_value('ketinggian_bg', (isset($ketinggian_bg) ? $ketinggian_bg :0))?>' id="ketinggian_bg" type="text" readonly></td><td> =
											<input size="4" name="hasil_ketinggian_bg" class="input2" value='<?php echo set_value('hasil_ketinggian_bg', (isset($hasil_ketinggian_bg) ? $hasil_ketinggian_bg :0))?>' id="hasil_ketinggian_bg" type="text" readonly> <?php
							$selected = '';
							if(isset($id_ketinggian_bg) && trim($id_ketinggian_bg) != '')
								$selected = $id_ketinggian_bg;
								
							$js = 'id="list_klas_detail6" onchange="fhitung(this.value)"';							
							echo form_dropdown('list_klas_detail6',$listKlasDetail6,$selected,$js);
						?></td-->
										</tr>
										<tr>
											<td>Kepemilikan</td>
											<td>:</td>
											<td>0.05 x <input size="3" name="kepemilikan" class="input2" value='<?php echo set_value('kepemilikan', (isset($kepemilikan) ? $kepemilikan :0))?>' id="kepemilikan" type="text" readonly></td><td> =
											<input size="6" name="hasil_kepemilikan" class="hasil_kepemilikan" value='<?php echo set_value('hasil_kepemilikan', (isset($hasil_kepemilikan) ? $hasil_kepemilikan :0))?>' id="hasil_kepemilikan" type="text" readonly> <?php
							$selected = '';
							if(isset($id_kepemilikan) && trim($id_kepemilikan) != '')
								$selected = $id_kepemilikan;
								
							$js = 'id="list_klas_detail7" onchange="fhitung(this.value)"';							
							echo form_dropdown('list_klas_detail7',$listKlasDetail7,$selected,$js);
						?>
											</td>
										</tr>
										<tr>
											<td colspan="2"></td>
											<td colspan="3">_________________________</td>
										</tr>
										<tr>
											<td> </td>
											<td> </td>
											<td> </td>
											<td>&nbsp;&nbsp;&nbsp;<input size="6" name="jumlah" class="input2" value='<?php echo set_value('jumlah', (isset($jumlah) ? $jumlah :0))?>' id="jumlah" type="text" readonly></td>
										</tr>
									</table>
											
											</th>
										</tr>
										<tr class="info">
											<th width="30%">Waktu Penggunaan</th>
											<th><?php
							$selected = '';
							if(isset($id_waktu_penggunaan) && trim($id_waktu_penggunaan) != '')
								$selected = $id_waktu_penggunaan;
								
							$js = 'id="list_w_peng" onchange="fhitung(this.value)"';							
							echo form_dropdown('list_w_peng',$listWaktupeng,$selected,$js);
						?> = <input size="3" name="waktu" class="input2" value='<?php echo set_value('waktu', (isset($waktu) ? $waktu :0))?>' id="waktu" type="text" readonly></th>
										</tr>
										<tr class="info">
											<th width="30%">Indeks Terintegrasi</th>
											<th>
											
											<?php echo $index_fungsi; ?> x
											<input size="3" name="jumlah2" class="input2" value='<?php echo set_value('jumlah2', (isset($jumlah2) ? $jumlah2 :0))?>' id="jumlah2" type="text" readonly> x
											<input size="3" name="waktu" class="input2" value='<?php echo set_value('waktu2', (isset($waktu2) ? $waktu2 :0))?>' id="waktu2" type="text" readonly> =
											<input size="9" name="integrasi" class="input2" value='<?php echo set_value('integrasi', (isset($integrasi) ? $integrasi :0))?>' id="integrasi" type="text" readonly>
											
											
											</th>
										</tr>
										<tr class="success">
											<th width="30%">Besarnya Retribusi</th>
											<th>
											<?
												if($id_retribusi != '' || $id_retribusi != null){
											?>
												<?
												$test = $mretribusi->hitung_retribusi($id_retribusi,$harga_satuan,$luas_bg,$index_fungsi,$index_klasifikasi_bg,$index_resiko_kebakaran,$index_permanensi,$index_zona_gempa,$index_lokasi,$ketinggian,$index_kepemilikan,$index_waktu_penggunaan);
												?>
												<span class="hightlight"><?=(isset($test)? $test : '...') ;?></span>		
											<?}else{?>
												<span class="hightlight">Luas Bangunan * Indeks Terintegrasi * 1,00 * HS<sub>bg</sub></span>
											<?}?>
											</th>
										</tr>
									
	</table>

										</div>
					</div>
				</div>
								<?if($id_retribusi != '' || $id_retribusi != null){?>
								
								<?}else{?>
								<?php echo form_submit('save','Simpan Retribusi','class="btn blue-hoki btn-block" id="tot1" ');	?>
								<?}?>
							
				
					
			</div>
		</div>
		</form>
	
	</div>
    </div>
  </div>
</div>
<script>
	function getcarapenetapan(v){
		if(v == '1'){
			document.getElementById('otomatis').style.display="block";
			document.getElementById('manual').style.display="none";
		}else if(v == '2'){
			document.getElementById('otomatis').style.display="none";
			document.getElementById('manual').style.display="block";
		}else{
			document.getElementById('otomatis').style.display="none";
		}
	}
	
	function fhitung(vl){
		var nilai2 = document.getElementById('list_klas_detail2').value;
		var nilai3 = document.getElementById('list_klas_detail3').value;
		var nilai4 = document.getElementById('list_klas_detail4').value;
		var nilai5 = document.getElementById('list_klas_detail5').value;
		// var nilai6 = document.getElementById('list_klas_detail6').value;
		var nilai7 = document.getElementById('list_klas_detail7').value;
		var waktu = document.getElementById('list_w_peng').value;
		var hasil = 0.25 * <?php echo $index_klasifikasi_bg;?>;
		var isi2 =  nilai2.split(",");
		var hasil2 = 0.2*(isi2[1]);
		var isi3 =  nilai3.split(",");
		var hasil3 = 0.15*(isi3[1]);
		var isi4 =  nilai4.split(",");
		var hasil4 = 0.15*(isi4[1]);
		var isi5 =  nilai5.split(",");
		var hasil5 = 0.1*(isi5[1]);
		var hasil6 = 0.1 * <?php echo $ketinggian;?>;
		// var isi6 =  nilai6.split(",");
		// var hasil6 = 0.1*(isi6[1]);
		var isi7 =  nilai7.split(",");
		var hasil7 = 0.05*(isi7[1]);
		var isi7 =  nilai7.split(",");
		var nwaktu =  waktu.split(",");
		var jumlah = hasil+hasil2+hasil3+hasil4+hasil5+hasil6+hasil7;
		var waktup =(nwaktu[1]);

		document.getElementById('permanensi').value = (isi2[1]);
		document.getElementById('hasil_permanensi').value = (hasil2.toFixed(3));
		document.getElementById('resiko_kebakaran').value = (isi3[1]);
		document.getElementById('hasil_resiko_kebakaran').value = (hasil3.toFixed(3));
		document.getElementById('val_zonasi_gempa').value = (isi4[1]);
		document.getElementById('hasil_zonasi_gempa').value = (hasil4.toFixed(3));
		document.getElementById('lokasi').value = (isi5[1]);
		document.getElementById('hasil_lokasi').value = (hasil5.toFixed(3));
		// document.getElementById('ketinggian_bg').value = (isi6[1]);
		// document.getElementById('hasil_ketinggian_bg').value = (hasil6.toFixed(3));
		document.getElementById('kepemilikan').value = (isi7[1]);
		document.getElementById('hasil_kepemilikan').value = (hasil7.toFixed(3));
		document.getElementById('jumlah').value = (jumlah.toFixed(3));
		document.getElementById('jumlah2').value = (jumlah.toFixed(3));
		document.getElementById('waktu').value = (waktup);
		document.getElementById('waktu2').value = (waktup);
		var integrasi = <?php echo $index_fungsi; ?> * jumlah * waktup;
		document.getElementById('integrasi').value = (integrasi.toFixed(3));
	}


  $(document).ready(function() {
    $("#form_wizard_1").bootstrapWizard({
      nextSelector: ".btn-next",
      previousSelector: ".button-previous",
      onTabClick: function(e, r, t, i) {
        return !1
      },
      onNext: function(e, a, n) {
        var l = Ladda.create(document.querySelector('.btn-next'));
        var wizard = $('#form_wizard_1').bootstrapWizard();
        let res;
        let current = wizard.bootstrapWizard('currentIndex');
        let curr = getStep;
        let nextStep = current + 1;
        console.log(nextStep);
        if (returnFail > 0) {
          var isGood = confirm('Penilaian Masih Ada Yang Belum Sesuai, Tetap Lanjutkan?');
          if (isGood) {
            var wizard = $('#form_wizard_1').bootstrapWizard();
            l.start();
            setTimeout(function() {
              l.stop();
              $('#ajax').modal('hide');
            }, 1500);
            res = true;
          } else {
            res = false;
          }
        } else {
          l.start();
          setTimeout(function() {
            l.stop();
            $('#ajax').modal('hide');
          }, 1500);
          res = true
        }
        $.ajax({
          type: "POST",
          data: {
            step: nextStep,
            dataVal: segment
          },
          url: `${base_url}pemeriksaan/save_step`,
          success: function(response) {}
        });
        return res;
      },
      onPrevious: function(e, r, a) {},
      onTabShow: function(e, r, t) {
        var i = r.find("li").length,
          a = t + 1,
          o = a / i * 100;
        $("#form_wizard_1").find(".progress-bar").css({
          width: o + "%"
        })
      }
    });

    $("input.make-switch").on('change.bootstrapSwitch', function(e) {
      var mode = $(this).prop('checked');
      var dataId = $(this).data("id");
      var dataVal = $(this).attr('data-val');
      $.ajax({
        type: "POST",
        url: `${base_url}pemeriksaan/cek_arsitektur`,
        data: {
          mode: mode,
          dataId: dataId,
          dataVal: dataVal
        },
        success: function(response) {
          if (response.status === false) {
            $(`a[data-id=${dataId}]`).css("display", "block");
          } else {
            $(`a[data-id=${dataId}]`).css("display", "none");
          }
          toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
          toastr.success(response.message);
        }
      });
    });
    //setup before functions
    var typingTimer; //timer identifier
    var doneTypingInterval = 1500; //time in ms (1.5 seconds)
    //on keyup, start the countdown
    $('textarea#note').keyup(function() {
      var dataId = $(this).data("id");
      var dataVal = $(this).attr('data-val');
      var text = $(this).val();
      clearTimeout(typingTimer);
      if ($('textarea#note').val()) {
        typingTimer = setTimeout(function() {
          doneTyping(dataId, dataVal, text)
        }, doneTypingInterval);
      }
    });

    //user is "finished typing," do something
    function doneTyping(dataId, dataVal, text) {
      $.ajax({
        type: "POST",
        url: `${base_url}pemeriksaan/simpan_catatan`,
        data: {
          syarat: text,
          dataId: dataId,
          dataVal: dataVal
        },
        success: function(response) {
          if (response.status === true) {
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "positionClass": "toast-top-right",
              "onclick": null,
              "showDuration": "1000",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            toastr.success(response.message);
          }
        }
      });
    }
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

  function clickModal(a, b) {
    $('#responsive').modal('show');
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
    $.ajax({
      type: "POST",
      url: `${base_url}pemeriksaan/simpan_berkas`,
      data: new FormData(this),
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
        } else {
          setTimeout(function() {
            showToast(response.message, 15000, response.type);
            l.stop();
            $(".btn-cancel").removeAttr("disabled");
            $(".btn-close").css("display", "block")
            $('#responsive').modal('hide');
            $(`a.lihat-berkas[data-val=${dataVal}]`).attr(`onClick`, `javascript:popWin('${base_url}${response.result}')`);
          }, 1500);
        }
      }
    });
  });

  $('.back-button').click(function(e) {
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
        url: `${base_url}pemeriksaan/save_step`,
        success: function(response) {}
      });
    }
  });
  // $('.save-step').click(function(e) {
  $(document).on('submit', 'form.step-wizard', function(e) {
    e.preventDefault();
    var $form = $(this);
    var syarat = $form.find('#idSyarat').val(); // example
    var jenis = $form.find('#idJenis').val();
    // jenis = $('#idJenis').val();
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
      url: `${base_url}pemeriksaan/simpan_penilaian`,
      data: {
        data: post_cb,
        syarat: syarat,
        jenis: jenis
      },
      beforeSend: function() {
        $(".loading").css("display", "block");
        $(".text-loader").css("display", "block");
        $(".btn-close").css("display", "none");
        $(".list-group").css("display", "none");
        $(".caption-message").css("display", "none");
        $(".btn-next").css("display", "none");
        $(".btn-repeat").css("display", "none");
      },
      success: function(response) {
        let fail = response.not;
        console.log(fail);
        setTimeout(function() {
          if (response.not > 0) {
            $(".btn-repeat").css("display", "inline-block");
          } else {
            $(".btn-repeat").css("display", "none");
          }
          $(".list-group").css("display", "block");
          $(".btn-close").css("display", "block");
          $(".loading").css("display", "none");
          $(".text-loader").css("display", "none");
          $(".caption-message").css("display", "block");
          if (response.status == true) {
            $(".btn-next").css("display", "inline-block");
            let result = response.result;
            const message = $('.caption-message');
            message.html(`<h4 align="center" class="caption-subject font-green bold uppercase">Penilaian Berhasil</h4>`);
            const res = $('#result');
            res.empty();
            result.forEach(obj => {
              let status = obj.kesesuaian == 1 ? 'Sesuai <i class="fa fa-check"></i>' : 'Tidak <i class="fa fa-times"></i>';
              let label = obj.kesesuaian == 1 ? 'success' : 'danger';
              res.append(`<a href="javascript:;" class="list-group-item list-group-item-default"> ${obj.nm_dokumen}
                <span class="badge badge-${label}"> ${status}</span>`);
            });
          } else {
            $(".btn-repeat").css("display", "inline-block");
            let result = response.result;
            const message = $('.caption-message');
            message.html(`<h4 align="center" class="caption-subject font-red bold uppercase">Penilaian Gagal</h4>`);
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