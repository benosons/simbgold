<!-- <script language="javascript" type="text/javascript">
function popupIMB() {
	var no_registrasi = document.getElementById("imb").value;
	$.ajax({
        type: "POST",
        url:  "<?php echo base_url();?>front/LacakIMB/"+no_registrasi,
		data: $('form.form-horizontal').serialize(),
        success: function(response) {
			if(response == ""){
				alert("Nomor Registrasi Tidak Terdaftar");
				document.getElementById('imb_list').style.display="none";
			}else{

				$('#table_IMB tbody').html(response);
				document.getElementById('imb_list').style.display="block";
				
			}
        },
        error: function(error) {
            alert('Nomor Registrasi Tidak Terdaftar');
        }
    });
}

function popupSLF() {
	var no_registrasi = document.getElementById("slf").value;
	$.ajax({
        type: "POST",
        url:  "<?php echo base_url();?>front/LacakSLF/"+no_registrasi,
		data: $('form.form-horizontal').serialize(),
        success: function(response) {
			if(response == ""){
				alert("Nomor Registrasi Tidak Terdaftar");
				document.getElementById('slf_list').style.display="none";
			}else{

				$('#table_SLF tbody').html(response);
				document.getElementById('slf_list').style.display="block";
				
			}
        },
        error: function(error) {
            alert('Nomor Registrasi Tidak Terdaftar');
        }
    });
}

function cek() {
		var no_registrasi = document.getElementById("no_registrasi").value;
		if(no_registrasi == ""){
				alert("Harap masukan No Registrasi dengan benar !");
		}else{
			var url = "<?=index_page() ?>/front/LacakBerkas/"+no_registrasi;
			swin = window.open(url,'popup','location=1,toolbar=1,menubar=1,resizable=1,width=750,height=450,top=50, left=500');
			swin.focus();
		}
	}
	
function popupNomorRegistrasi() {
	$.ajax({
        type: "POST",
        url:  "<?php echo base_url();?>front/LacakBerkas"+no_registrasi,
		data: $('form.form-horizontal').serialize(),
        success: function(response) {
			if(response == ''){
				alert("No Registrasi Tidak Terdaftar Di Sistem SIMBG");
				document.getElementById('nib_list').style.display="block";
			}else{
				$('#table_IMB tbody').html(response);
				document.getElementById('nib_list').style.display="block";
			}
        },
        error: function(error) {
            alert('No Registrasi Tidak Terdaftar Di Sistem SIMBG');
        }
    });
}
</script>
<div class="portlet-title">
	<div class="caption">
		<i class="fa fa-cogs"></i>Lacak Status Permohonan
	</div>
</div>
<div class="portlet-body">
	<div class="row">
		<div class="col-md-12">
		<div class="tabbable-custom nav-justified">
			<ul class="nav nav-tabs nav-justified">
				<li class="active">
					<a href="#tabIMB" data-toggle="tab">LACAK IMB</a>
				</li>
				<li>
					<a href="#tabSLF" data-toggle="tab">LACAK SLF</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="tabIMB">
					<div class="col-md-12 ">
						<div class="form-body">		
							<div id="imbnya" style="">
								<div class="form-group">
									<label class="control-label col-md-12">Masukkan Nomor Registrasi IMB Anda<span class="required">* </span></label>
									<div class="col-md-4">
										<input type="text" class="form-control" id="imb" name="imb" placeholder="IMB-351811-60096009-69" />
									</div>	
									<div class="col-md-2">
										<input type='button' onClick="popupIMB()" title="Lacak IMB" value="Lacak IMB" class="btn green" name="btnIMB" id="btnIMB"/>
									</div>
								</div>
							</div>
							<div id="imb_list" style="display: none;">
								<div class="form-group">
									<label class="control-label col-md-12"></label>
									<div class="col-md-12"><br>
										<table id="table_IMB" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>No</th>
													<th>Keterangan</th>
													<th>Tanggal Proses</th>
													
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
				<div class="tab-pane fade" id="tabSLF">
					<div class="col-md-12 ">
						<div class="form-body">		
							<div id="slfnya" style="">
								<div class="form-group">
									<label class="control-label col-md-12">Masukkan Nomor Registrasi SLF Anda<span class="required">* </span></label>
									<div class="col-md-4">
										<input type="text" class="form-control" id="slf" name="slf" placeholder="SLF-351811-60096009-69" />
									</div>
									<div class="col-md-2">
										<input type='button' onClick="popupSLF()" title="Lacak SLF" value="Lacak SLF" class="btn green" name="btnSLF" id="btnSLF"/>
									</div>
								</div>
							</div>
							<div id="slf_list" style="display: none;">
								<div class="form-group">
									<label class="control-label col-md-12"></label>
									<div class="col-md-12"><br>
										<table id="table_SLF" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>No</th>
													<th>Keterangan</th>
													<th>Tanggal Proses</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</div> -->