<script type="application/javascript">
	function GetPdfSyarat2(id_bg,f){
		url = "<?php echo base_url() ?>file/Informasi/SLF/1.B.pdf";
		swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
	function GetPdfSyarat3(id_bg,f){
		url = "<?php echo base_url() ?>file/Informasi/SLF/1.C.pdf";
		swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
	function GetPdfSyarat4(id_bg,f){
		url = "<?php echo base_url() ?>file/Informasi/SLF/1.D.pdf";
		swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
	function GetPdfSyarat5(id_bg,f){
		url = "<?php echo base_url() ?>file/Informasi/SLF/2.A.1.pdf";
		swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
	function GetPdfSyarat6(id_bg,f){
		url = "<?php echo base_url() ?>file/Informasi/SLF/2.A.2.pdf";
		swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
	function GetPdfSyarat7(id_bg,f){
		url = "<?php echo base_url() ?>file/Informasi/SLF/2.B.1.pdf";
		swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
	function GetPdfSyarat8(id_bg,f){
		url = "<?php echo base_url() ?>file/Informasi/SLF/2.B.2.pdf";
		swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
	function GetPdfSyarat11(id_bg,f){
		url = "<?php echo base_url() ?>file/Informasi/SLF/4.A.pdf";
		swin = window.open(url,'win','scrollbars,width=1000,height=600,top=80,left=140,status=yes,toolbar=no,menubar=yes,location=no');
		swin.focus();
	}
</script>
<table id="table-IMB" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tbody>
			<table id="table-IMB" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>No.</th>
						<th>Jenis Permohonan</th>
						<th>Syarat</th>
						<th>Info</th>
						<th>Waktu <br> (Hari)</th>
					</tr>
				</thead>
					<tr>
						<td rowspan='5'>1</td>
						<td colspan='4'>SLF Bangunan Gedung baru</td>
					</tr>
						<tr>
							<td>A. Bangunan Gedung rumah tinggal tunggal dan rumah tinggal deret 1 atau 2 lantai yang pengawasannya dilakukan oleh pemilik BG</td>
							<td class="align">
								<a href="javascript:void(0);" onClick="GetPdfSyarat1('','')"
									data-toggle="tooltip" data-placement="right" title="Lihat Persyaratan">
									<i class="fa fa-list-alt " aria-hidden="true"></i>
								</a>
							</td>
							<td>
								<!--<a href="javascript:void(0);" onClick="GetPdfInfo1('','')"
									data-toggle="tooltip" data-placement="right" title="Lihat Info">
									<i class="fa fa-list-alt " aria-hidden="true"></i>
								</a>-->
							</td>
							<td>3 </td>
						</tr>
						<tr>
							<td>B. Bangunan Gedung rumah tinggal tunggal dan rumah tinggal deret 1 atau 2 lantai yang pengawasannya menggunakan penyedia jasa</td>
							<td class="align">
								<a href="javascript:void(0);" onClick="GetPdfSyarat2('','')"
									data-toggle="tooltip" data-placement="right" title="Lihat Persyaratan">
									<i class="fa fa-list-alt " aria-hidden="true"></i>
								</a>
							</td>
							<td>
								<!--<a href="javascript:void(0);" onClick="GetPdfInfo2('','')"
									data-toggle="tooltip" data-placement="right" title="Lihat Info">
									<i class="fa fa-list-alt " aria-hidden="true"></i>
								</a>-->
							</td>
							<td>4 </td>
						</tr>
						<tr>
							<td>C. Bangunan Gedung tidak sederhana dan Bangunan Gedung khusus yang pengawasannya dilakukan oleh satu penyedia jasa</td>
							<td class="align">
								<a href="javascript:void(0);" onClick="GetPdfSyarat3('','')"
									data-toggle="tooltip" data-placement="right" title="Lihat Persyaratan">
									<i class="fa fa-list-alt " aria-hidden="true"></i>
								</a>
							</td>
							<td>
								<!--<a href="javascript:void(0);" onClick="GetPdfInfo3('','')"
									data-toggle="tooltip" data-placement="right" title="Lihat Info">
								<i class="fa fa-list-alt " aria-hidden="true"></i>
								</a>-->
							</td>
							<td>3 </td>
						</tr>
						<tr>
							<td>D. Bangunan Gedung tidak sederhana dan Bangunan Gedung khusus yang pengawasannya dilakukan oleh lebih dari satu penyedia jasa secara bertahap</td>
							<td class="align">
								<a href="javascript:void(0);" onClick="GetPdfSyarat4('','')"
									data-toggle="tooltip" data-placement="right" title="Lihat Persyaratan">
									<i class="fa fa-list-alt " aria-hidden="true"></i>
								</a>
							</td>
							<td>
								<!--<a href="javascript:void(0);" onClick="GetPdfInfo4('','')"
									data-toggle="tooltip" data-placement="right" title="Lihat Info">
									<i class="fa fa-list-alt " aria-hidden="true"></i>
								</a>-->
							</td>
							<td>3 </td>
						</tr>
						<tr>
							<td rowspan='7'>2</td>
							<td colspan='4'>SLF Bangunan Gedung Yang Sudah Ada (Existing)</td>
						</tr>
						<tr>
							<td colspan='4'>A. Sudah memiliki IMB</td>
						</tr>
								<tr>
									<td>2.A.1 Bangunan Gedung rumah tinggal tunggal dan rumah tinggal deret yang pengkajian teknisnya tidak menggunakan penyedia jasa</td>
									<td class="align">
										<a href="javascript:void(0);" onClick="GetPdfSyarat5('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Persyaratan">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>
									</td>
									<td>
										<!--<a href="javascript:void(0);" onClick="GetPdfInfo1('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Info">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>3 </td>
								</tr>
								<tr>
									<td>.A.2. Bangunan Gedung tidak sederhana, Bangunan Gedung khusus, Bangunan Gedung rumah tinggal tunggal, dan rumah tinggal deret yang pengkajian teknisnya menggunakan penyedia jasa</td>
									<td class="align">
										<a href="javascript:void(0);" onClick="GetPdfSyarat6('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Persyaratan">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>
									</td>
									<td>
										<!--<a href="javascript:void(0);" onClick="GetPdfInfo1('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Info">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>3 </td>
								</tr>
								<tr>
									<td colspan='4'>B. Belum memiliki IMB</td>
								</tr>
								<tr>
									<td>B.1 Bangunan Gedung rumah tinggal tunggal dan rumah tinggal deret yang pengkajian teknisnya tidak menggunakan penyedia jasa</td>
									<td class="align">
										<a href="javascript:void(0);" onClick="GetPdfSyarat7('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Persyaratan">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>
									</td>
									<td>
										<!--<a href="javascript:void(0);" onClick="GetPdfInfo1('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Info">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>3 </td>
								</tr>
								<tr>
									<td>B.2. Bangunan Gedung tidak sederhana, Bangunan Gedung khusus, Bangunan Gedung rumah tinggal tunggal dan rumah tinggal deret yang pengkajian teknisnya menggunakan penyedia jasa</td>
									<td class="align">
										<a href="javascript:void(0);" onClick="GetPdfSyarat8('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Persyaratan">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>
									</td>
									<td>
										<!--<a href="javascript:void(0);" onClick="GetPdfInfo1('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Info">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>3 </td>
								</tr>								
								<tr>
									<td rowspan='3'>3</td>
									<td colspan='4'>SLF Bangunan Gedung Perpanjangan</td>
								</tr>
						
								<tr>
									<td>A. Bangunan Gedung rumah tinggal tunggal dan rumah tinggal deret yang pengkajian teknisnya tidak menggunakan penyedia jasa</td>
									<td class="align">
										<!--<a href="javascript:void(0);" onClick="GetPdfSyarat6('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Persyaratan">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>
										<!--<a href="javascript:void(0);" onClick="GetPdfInfo6('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Info">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>3</td>
								</tr>
								<tr>
									<td>B. Bangunan Gedung tidak sederhana, Bangunan Gedung khusus, Bangunan Gedung rumah tinggal tunggal dan rumah tinggal deret yang pengkajian teknisnya menggunakan penyedia jasa</td>
									<td class="align">
										<!--<a href="javascript:void(0);" onClick="GetPdfSyarat7('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Persyaratan">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>
										<!--<a href="javascript:void(0);" onClick="GetPdfInfo6('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Info">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>3</td>
								</tr>
								
								<tr>
									<td rowspan='4'>4</td>
									<td colspan='4'>Penerbitan SLF Bangunan Prasarana</td>
									
								</tr>
								
								<tr>
									<td>A. Bangunan Prasarana  baru</td>
									<td class="align">
										<a href="javascript:void(0);" onClick="GetPdfSyarat11('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Persyaratan">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>
									</td>
									<td>
										<!--<a href="javascript:void(0);" onClick="GetPdfInfo10('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Info">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>3</td>
								</tr>
								<tr>
									
									<td>B. Bangunan Prasarana  Yang Sudah Ada (Existing) sudah memiliki IMB</td>
									<td class="align">
										<!--<a href="javascript:void(0);" onClick="GetPdfSyarat14('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Persyaratan">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>
										<!--<a href="javascript:void(0);" onClick="GetPdfInfo11('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Info">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>3</td>
								</tr>
								<tr>
									
									<td>C. Bangunan Prasarana  Yang Sudah Ada (Existing) belum memiliki IMB</td>
									<td class="align">
										<!--<a href="javascript:void(0);" onClick="GetPdfSyarat15('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Persyaratan">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>
										<!--<a href="javascript:void(0);" onClick="GetPdfInfo111('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Info">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>3</td>
								</tr>				
								<tr>
									<td rowspan='1'>5</td>
									<td>Perpanjangan SLF Bangunan Prasarana</td>
								
									<td class="align">
										<!--<a href="javascript:void(0);" onClick="GetPdfSyarat20('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Persyaratan">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>
										<!--<a href="javascript:void(0);" onClick="GetPdfInfo16('','')"
											data-toggle="tooltip" data-placement="right" title="Lihat Info">
											<i class="fa fa-list-alt " aria-hidden="true"></i>
										</a>-->
									</td>
									<td>3</td>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
		</tbody>
	</thead>
	<tbody>
	</tbody>
</table>