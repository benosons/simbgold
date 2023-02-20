<center>
	<div class="blank"></div>
	<div class="spacer"></div>
</center>
<fieldset class="ui-tabs ui-widget ui-widget-content ui-corner-all">
	<div class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
		<span><h2 style="color:white">&nbsp;&nbsp;Perhitungan Retribusi</h2></span>
	</div>
	<br>
	<fieldset class="panel-form">
		<table width=100%>
				<tr>
						<td width=60%>
							<table width=100%>
									<tr>
											<td>Jenis Retribusi</td>
											<td>:</td>
											<td><select name=jenisretribusi>
													<option value='Bangunan Gedung'>Bangunan Gedung&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
											</select></td>
									</tr>
											<tr>
													<td>Kegiatan</td>
													<td>:</td>
													<td><select name=kegiatan id="kegiatan">
															<option value="">- Pilih -</option>
															<?php
																$array=array(0=>"Pembangunan Bangunan Gedung",
																	1=>"Rehabilitasi/Renovasi - Rusak Sedang",
																	2=>"Rehabilitasi/Renovasi - Rusak Berat",
																	3=>"Pelestarian/Pemugaran - Pratama",
																	4=>"Pelestarian/Pemugaran - Madya",
																	5=>"Pelestarian/Pemugaran - Utama");
																foreach($array as $key=>$indeks){
																	echo"<option value='$key'>$indeks</option>";
																}
															?>
													</select>
													<input type=text name='indekskegiatan' id='indekskegiatan' size=7 readonly value='0'>
												</td>
											</tr>
									<tr>
											<td>Fungsi</td>
											<td>:</td>
											<td>
												<select name="fungsi" id="fungsi">
													<option value=''>- Pilih -</option>
													<?php
														foreach($fungsi as $index){
															echo"<option value='$index->kode'>$index->nama_indeks</option>";
														}
													?>
												</select>
												<select name="sampledata" id="sampledata" style='display:none'>
													<option value=''>- Pilih -</option>
												</select>
												<input type=text name='indeksfungsi' id='indeksfungsi' size=7 readonly value='0'>
										</td>
									</tr>
									<tr>
											<td colspan=3><br/><h4>Silahkan tentukan Indeks pada kolom isian di bawah ini :</h4></td>
									</tr>
									<?php
										foreach ($parameter as $key=>$value) {
											$getParam = $this->mkal->getIndeks($value->kode)->row_array();

											echo"<tr>
														<td>$value->nama_indeks</td>
														<td>:</td>
														<td><input type=text name='parameter$key' id='parameter$key' size=7 value='0' readonly>

																x <input type=text name='indeksparameter$key' id='indeksparameter$key' readonly size=5 value='".$getParam['indeks']."'>

																<select name='tipeparameter$key' id='tipeparameter$key'>
																<option value=''>- Pilih -</option>";
																$showparameter = $this->mkal->getitemparent($value->kode)->result();
																foreach($showparameter as $show)
																{
																	echo "<option value='".$show->kode."'>".$show->nama_indeks."</option>";
																}

																echo"</select></td></tr>";
										}
									?>
									<tr>
											<td><br/><h4>Waktu Penggunaan</h4></td>
											<td><br/>:</td>
											<td><br/>
												<select name="waktu" id="waktu">
													<option value=''>- Pilih -</option>
													<?php
														foreach($waktu as $index){
															echo"<option value='$index->kode'>$index->nama_indeks</option>";
														}
													?>
												</select>
												<input type=text name='indekswaktu' readonly id='indekswaktu' size=7 value='0'>
										</td>
									</tr>
									<tr>
											<td>Harga Satuan</td>
											<td>:</td>
											<td><input type=number name='indekshargasatuan' id='indekshargasatuan' value='0'></td>
									</tr>
									<tr>
											<td colspan=3><br/><input type=checkbox id="basement"> Bangunan berada di bawah permukaan tanah (<i>basement</i>), di atas/bawah permukaan air, prasarana, dan sarana umum.</td>
									</tr>
									<tr>
											<td><br/>Luas Lantai Bangunan</td>
											<td><br/>:</td>
											<td><br/><input type=number name=luaslantai id="luaslantai" value="0"></td>
									</tr>
							</table>
						</td>
						<td width=40%>
								<h3>Hasil Perhitungan Retribusi</h3>
								<div class="hasil">
										Indeks Terintegrasi<br/><br/>
										<h3>
											<span id='tampilfungsi'>0.00</span>
											x
											<span id='tampildata'>0.00</span>
											x
											<span id='tampilwaktu'>0.00</span>
											<span id='tampilbasement1' style="display:none">x</span>
											<span id='tampilbasement' style="display:none">1</span>
											=
											<span id='tampilnilai'>0.00</span>
										</h3>
								</div>
								<br/>
								<h3>Harga Retribusi</h3>
								<h3>
									<span id='tampillantai'>0.00</span>
									x
									<span id='tampilnilaitotal'>0.00</span>
									x
									<span id='tampilkegiatan'>0.00</span>
									x
									<span id='tampilhargasatuan'>0.00</span>
									=
									<span id='tampilhargatotal'>0.00</span>
								</h3>
						</td>
				</tr>

		</table>
	</fieldset>
</fieldset>
<script type="text/javascript">
	$(document).ready(function() {
		$("#parameter0").bind("change keyup input",function(){ calculating(); });
		$("#parameter1").bind("change keyup input",function(){ calculating(); });
		$("#parameter2").bind("change keyup input",function(){ calculating(); });
		$("#parameter3").bind("change keyup input",function(){ calculating(); });
		$("#parameter4").bind("change keyup input",function(){ calculating(); });
		$("#parameter5").bind("change keyup input",function(){ calculating(); });
		$("#parameter6").bind("change keyup input",function(){ calculating(); });

		function hapus(){
			$("#tampildata").text(0);
			$("#tampilfungsi").text(0);
			$("#tampilnilai").text(0);
		}

		$("#basement").bind("click",function(){
			if ($('#basement').is(":checked"))
			{
			  $("#tampilbasement1").show();
			  $("#tampilbasement").show();
				$("#tampilbasement").text('1.30');
				calculating();
			}else{
			  $("#tampilbasement1").hide();
				$("#tampilbasement").hide();
				$("#tampilbasement").text('1');
				calculating();
			}
		});

		$("#indeksfungsi").bind("change keyup input",function(){
			$("#tampilfungsi").text($("#indeksfungsi").val());
			calculating();
		});

		$("#indekshargasatuan").bind("change keyup input",function(){
			$("#tampilhargasatuan").text(parseFloat($("#indekshargasatuan").val()).toLocaleString());
			calculating();
		});

		$("#indekswaktu").bind("change keyup input",function(){
			$("#tampilwaktu").text($("#indekswaktu").val());
			calculating();
		});

		$("#luaslantai").bind("change keyup input",function(){
			$("#tampillantai").text($("#luaslantai").val());
			calculating();
		});

		function calculating(){
			var nildata = (parseFloat($("#parameter0").val()) * parseFloat($("#indeksparameter0").val())) +
									  (parseFloat($("#parameter1").val()) * parseFloat($("#indeksparameter1").val())) +
								  	(parseFloat($("#parameter2").val()) * parseFloat($("#indeksparameter2").val())) +
										(parseFloat($("#parameter3").val()) * parseFloat($("#indeksparameter3").val())) +
										(parseFloat($("#parameter4").val()) * parseFloat($("#indeksparameter4").val())) +
										(parseFloat($("#parameter5").val()) * parseFloat($("#indeksparameter5").val())) +
										(parseFloat($("#parameter6").val()) * parseFloat($("#indeksparameter6").val()));

			var totalAll = parseFloat($("#tampilfungsi").text())*parseFloat($("#tampilwaktu").text())*nildata.toFixed(3)*parseFloat($("#tampilbasement").text());
			$("#tampildata").text(nildata.toFixed(3));
			$("#tampilnilai").text(totalAll.toFixed(3));
			$("#tampilnilaitotal").text(totalAll.toFixed(3));

			var hasiltotalharga = totalAll*$("#indekshargasatuan").val()*$("#luaslantai").val()*$("#indekskegiatan").val();
			$("#tampilhargatotal").text(hasiltotalharga.toLocaleString());
		}

		$("#fungsi").bind("change keyup input",function(){
        $.ajax({
          type: "POST",
          url: "<?=base_url()?>kalkulator/sampledata",
          data: { 'id_fungsi': $("#fungsi").val() },
          success:function(data){
						$("#sampledata").empty();
						$("#sampledata").append(data);
						hapus();

							$.ajax({
								type: "POST",
								url: "<?=base_url()?>kalkulator/getval",
								data: { 'kode': $("#fungsi").val() },
								success:function(data){
									$("#indeksfungsi").val(data);
									$("#tampilfungsi").text(data);
								}
							});
						calculating();

						if(($("#fungsi").val() == "1210") || ($("#fungsi").val() == "1240")){
							$("#sampledata").show();
						}else{
							$("#sampledata").hide();
						}
          }
        });
		});

		$("#waktu").bind("change keyup input",function(){
        $.ajax({
          type: "POST",
          url: "<?=base_url()?>kalkulator/getval",
          data: { 'kode': $("#waktu").val() },
          success:function(data){
						$("#indekswaktu").val(data);
						$("#tampilwaktu").text(data);
						calculating();
          }
        });
		});

		$("#sampledata").bind("change keyup input",function(){
        $.ajax({
          type: "POST",
          url: "<?=base_url()?>kalkulator/showindeks",
          data: { 'id_sample': $("#sampledata").val() },
          success:function(data){
						var exp = data.split('~');
						if(exp[0] == ""){
							$("#parameter"+0).val(0);$("#tipeparameter"+0).val("");
							$("#parameter"+1).val(0);$("#tipeparameter"+1).val("");
							$("#parameter"+2).val(0);$("#tipeparameter"+2).val("");
							$("#parameter"+3).val(0);$("#tipeparameter"+3).val("");
							$("#parameter"+4).val(0);$("#tipeparameter"+4).val("");
							$("#parameter"+5).val(0);$("#tipeparameter"+5).val("");
							$("#parameter"+6).val(0);$("#tipeparameter"+6).val("");
						}else{
							var pisah1=exp[0].split('*');var pisah2=exp[1].split('*');
							var pisah3=exp[2].split('*');var pisah4=exp[3].split('*');
							var pisah5=exp[4].split('*');var pisah6=exp[5].split('*');var pisah7=exp[6].split('*');

							$("#parameter"+0).val(pisah1[0]);$("#tipeparameter"+0).val(pisah1[1]);
							$("#parameter"+1).val(pisah2[0]);$("#tipeparameter"+1).val(pisah2[1]);
							$("#parameter"+2).val(pisah3[0]);$("#tipeparameter"+2).val(pisah3[1]);
							$("#parameter"+3).val(pisah4[0]);$("#tipeparameter"+3).val(pisah4[1]);
							$("#parameter"+4).val(pisah5[0]);$("#tipeparameter"+4).val(pisah5[1]);
							$("#parameter"+5).val(pisah6[0]);$("#tipeparameter"+5).val(pisah6[1]);
							$("#parameter"+6).val(pisah7[0]);$("#tipeparameter"+6).val(pisah7[1]);
						}

						if(($("#sampledata").val() == "Lain") || ($("#sampledata").val() == "")) {
							$.ajax({
								type: "POST",
								url: "<?=base_url()?>kalkulator/getval",
								data: { 'kode': $("#fungsi").val() },
								success:function(data){
									$("#indeksfungsi").val(data);
									$("#tampilfungsi").text(data);
									calculating();
								}
							});
						}else{
							$.ajax({
								type: "POST",
								url: "<?=base_url()?>kalkulator/getval",
								data: { 'kode': $("#sampledata").val() },
								success:function(data){
									$("#indeksfungsi").val(data);
									$("#tampilfungsi").text(data);
									calculating();
								}
							});
						}
          }
        });
		});

		$("#tipeparameter0").bind("change keyup input",function(){
			$.ajax({
				type: "POST",
				url: "<?=base_url()?>kalkulator/getval",
				data: { 'kode': $("#tipeparameter0").val() },
				success:function(data){
					$("#parameter0").val(data);
					calculating();
				}
			});
		});

		$("#tipeparameter1").bind("change keyup input",function(){
			$.ajax({
				type: "POST",
				url: "<?=base_url()?>kalkulator/getval",
				data: { 'kode': $("#tipeparameter1").val() },
				success:function(data){
					$("#parameter1").val(data);
					calculating();
				}
			});
		});

		$("#tipeparameter2").bind("change keyup input",function(){
			$.ajax({
				type: "POST",
				url: "<?=base_url()?>kalkulator/getval",
				data: { 'kode': $("#tipeparameter2").val() },
				success:function(data){
					$("#parameter2").val(data);
					calculating();
				}
			});
		});

		$("#tipeparameter3").bind("change keyup input",function(){
			$.ajax({
				type: "POST",
				url: "<?=base_url()?>kalkulator/getval",
				data: { 'kode': $("#tipeparameter3").val() },
				success:function(data){
					$("#parameter3").val(data);
					calculating();
				}
			});
		});

		$("#tipeparameter4").bind("change keyup input",function(){
			$.ajax({
				type: "POST",
				url: "<?=base_url()?>kalkulator/getval",
				data: { 'kode': $("#tipeparameter4").val() },
				success:function(data){
					$("#parameter4").val(data);
					calculating();
				}
			});
		});

		$("#tipeparameter5").bind("change keyup input",function(){
			$.ajax({
				type: "POST",
				url: "<?=base_url()?>kalkulator/getval",
				data: { 'kode': $("#tipeparameter5").val() },
				success:function(data){
					$("#parameter5").val(data);
					calculating();
				}
			});
		});

		$("#tipeparameter6").bind("change keyup input",function(){
			$.ajax({
				type: "POST",
				url: "<?=base_url()?>kalkulator/getval",
				data: { 'kode': $("#tipeparameter6").val() },
				success:function(data){
					$("#parameter6").val(data);
					calculating();
				}
			});
		});

		$("#kegiatan").bind("change keyup input",function(){
				if($("#kegiatan").val() == "0"){ $("#indekskegiatan").val(1); }
				else if($("#kegiatan").val() == "1"){ $("#indekskegiatan").val(0.45); }
				else if($("#kegiatan").val() == "2"){ $("#indekskegiatan").val(0.65); }
				else if($("#kegiatan").val() == "3"){ $("#indekskegiatan").val(0.65); }
				else if($("#kegiatan").val() == "4"){ $("#indekskegiatan").val(0.45); }
				else if($("#kegiatan").val() == "5"){ $("#indekskegiatan").val(0.30); }
				else { $("#indekskegiatan").val(0); }

				$("#tampilkegiatan").text($("#indekskegiatan").val());
		});

	});
</script>
