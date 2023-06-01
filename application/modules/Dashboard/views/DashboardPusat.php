<div class="portlet-title margin-top-10">
	<div class="page-title" align="center"><span class="caption font-blue-hoki bold" style="font-size: 22px;">Rekapitulasi Proses Persetujuan Bangunan Gedung (PBG)</span></div>
</div>
<div class="row margin-top-20">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat blue-madison">
			<div class="visual"><i class="fa fa-comments"></i></div>
			<div class="details"><div class="number"><u><b><?php echo number_format($pbg_rekap->Total,0,',','.')?></b></u></div><div class="desc">Jumlah Permohonan</div></div>	
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat green-haze">
			<div class="visual"><i class="fa fa-bar-chart-o"></i></div>
			<div class="details"><div class="number"><u><b><?php echo number_format($pbg_rekap->DinasTeknis,0,',','.')?></b></u></div>
			<div class="desc">Dinas Teknis</div></div>			
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat red-intense">
			<div class="visual"><i class="fa fa-shopping-cart"></i></div>
			<div class="details"><div class="number"><u><b><?php echo number_format($pbg_rekap->DinasPerizinan,0,',','.')?></b></u></div>
			<div class="desc">Dinas Perizinan</div></div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat purple-plum">
			<div class="visual"><i class="fa fa-globe"></i></div>
			<div class="details"><div class="number"><u><b><?php echo number_format($pbg_rekap->TelahTerbit,0,',','.')?></b></u> / <u><b><?php echo number_format($pbg_rekap->Ditolak,0,',','.')?></b></u></div><div class="desc">Telah Terbit / Ditolak</div></div>
		</div>
	</div>
</div>
<div class="portlet-title margin-top-10">
	<div class="page-title" align="center"><span class="caption font-blue-hoki bold" style="font-size: 22px;">Rekapitulasi Proses Sertifikat Laik Fungsi (SLF)</span></div>
</div>
<div class="row margin-top-20">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat blue-madison">
			<div class="visual"><i class="fa fa-comments"></i></div>
			<div class="details">
				<div class="number"><u><b><?php echo number_format($slf_rekap->Total,0,',','.')?></b></u></div>
				<div class="desc">Total Pengajuan SLF</div>
			</div>	
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat green-haze">
			<div class="visual"><i class="fa fa-bar-chart-o"></i></div>
			<div class="details">
				<div class="number"><u><b><?php echo number_format($slf_rekap->DinasTeknis,0,',','.')?></b></u></div>
				<div class="desc">Di Dinas Teknis</div>
			</div>	
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat red-intense">
			<div class="visual"><i class="fa fa-shopping-cart"></i></div>
			<div class="details">
				<div class="number"><u><b><?php echo number_format($slf_rekap->DinasPerizinan,0,',','.')?></b></u></div>
				<div class="desc">Di Dinas Perizinan</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat purple-plum">
			<div class="visual"><i class="fa fa-globe"></i></div>
			<div class="details">
				<div class="number"><u><b><?php echo number_format($slf_rekap->TelahTerbit,0,',','.')?></b></u> / <u><b><?php echo number_format($slf_rekap->Ditolak,0,',','.')?></b></u></div>
				<div class="desc">Telah Terbit / Ditolak</div>
			</div>	
		</div>
	</div>
</div>
<div class="row" >
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption"><span class="caption-subject font-blue-sharp bold uppercase">Data Permohonan Persetujuan Bangunan Gedung Perkecamatan</span></div>
			</div>
		<div class="portlet-body">
			<table id="example1" class="table table-bordered table-striped table-hover">
				<thead>
					<tr class="warning">
						<th rowspan="2" class="info">No</th>
						<th rowspan="2" class="info"><center>Nama Kabupaten/Kota</center></th>
						<th colspan="13" class="info"><center>Bangunan Baru (PBG)</center></th>
					</tr>
					<tr>
						<th class="danger"><center>Diajukan</center></th>
						<th class="info"><center>Revisi Dokumen</center></th>
						<th class="danger"><center>Penugasan TPT/TPA</center></th>
						<th class="info"><center>Penjadwalan Konsultasi</center></th>
						<th class="danger"><center>Konsultasi</center></th>
						<th class="info"><center>Revisi Teknis</center></th>
						<th class="danger"><center>Perhitungan Retribusi</center></th>
						<th class="info"><center>Validasi SPP</center></th>
						<th class="danger"><center>Penagihan Retribusi</center></th>
						<th class="info"><center>Pembayaran Retribusi</center></th>
						<th class="danger"><center>Validasi Pembayaran</center></th>
						<th class="info"><center>Validasi Dokumen </center></th>
						<th class="danger"><center>PBG Terbit</center></th>
					</tr>
				</thead>
				<tbody>
				<?php if ($jum_data==0){ ?>
						<tr><td class="clcenter" colspan="10">Data is Empty</td></tr>
					<?php } else {
						$i= 1;
						$loksblm = '';
						$DinasTeknis = 0;
						$DinasPerizinan = 0;
						$Diserahkan = 0; 
						$Ditolak = 0;
						$t_DinasTeknis= 0;
						$t_DinasPerizinan = 0;
						$TelahTerbit = 0;
						$t_TelahTerbit = 0;
						$t_Ditolak = 0;
						$T_SDinasTeknis = 0;
						$T_SDinasPerizinan = 0;
						$T_STelahTerbit = 0;
						$T_SDitolak = 0;
						if (isset($status) == ''){
							$status2 = 0;
						} else {
							$status2 = $status;
						}
						foreach ($result as $row) {;
							if ($i % 2== 0 )
								$clss = "event";
							else
								$clss = "event2"; 
								$DinasTeknis = $row->DinasTeknis;
								$t_DinasTeknis += $DinasTeknis;
								$DinasPerizinan = $row->DinasPerizinan;
								$t_DinasPerizinan += $DinasPerizinan;
								$TelahTerbit = $row->TelahTerbit;
								$t_TelahTerbit += $TelahTerbit;
								$Ditolak = $row->Ditolak;
								$t_Ditolak += $Ditolak;
								$SDinasTeknis = $row->SDinasTeknis;
								$T_SDinasTeknis += $row->SDinasTeknis;
								$SDinasPerizinan = $row->SDinasPerizinan;
								$T_SDinasPerizinan += $row->SDinasPerizinan;
								$STelahTerbit = $row->STelahTerbit;
								$T_STelahTerbit += $row->STelahTerbit;
								$SDitolak = $row->SDitolak;
								$T_SDitolak += $row->SDitolak;
							?>		  
							<tr class="<?=$clss?>" id="record">
								<td class="clcenter"><?php echo $i?></td>	
								<td class="clleft"><?php echo $row->nama_kecamatan; ?></td>
								<td><center>
                  <?php if ($DinasTeknis == 0){ ?>0<?php } else { ?>
										<?php echo $DinasTeknis;?>
									<?php } ?>
									</center>
								</td>										
								<td><center>
                                    <?php if ($DinasPerizinan == 0){ ?>0<?php } else { ?>
										<?php echo $DinasPerizinan;?>
									<?php } ?>
									</center>
								</td>
								<td><center>
									<?php if ($TelahTerbit == 0){?>0<?php } else { ?>
										<?php echo $TelahTerbit;?>
									<?php }?>
									</center>
								</td>
								<td><center>
									<?php if ($Ditolak == 0){?>0<?php } else { ?>
										<?php echo $Ditolak;?>
									<?php }?>
									</center>
								</td>
								<td><center>
									<?php if ($SDinasTeknis == 0){?>0<?php } else { ?>
										<?php echo $SDinasTeknis;?>
									<?php }?>
									</center>
								</td>
								<td>
									<center>
									<?php if ($SDinasPerizinan == 0){?>0<?php } else { ?>
										<?php echo $SDinasPerizinan;?>
									<?php }?>
									</center>
								</td>
								<td>
									<center>
									<?php if ($STelahTerbit == 0){?>0<?php } else { ?>
										<?php echo $STelahTerbit;?>
									<?php }?>
									</center>
								</td>
								<td>
									<center>
									<?php if ($SDitolak == 0){?>0<?php } else { ?>
										<?php echo $SDitolak;?>
									<?php }?>
									</center>
								</td>
							</tr>
							<?php $i++;
						}?>
						<tr class="<?=$clss?>" id="record">
							<td class="clcenter" colspan='2'><b>Total Permohonan</b></td>
							<td class="clcenter"><center><b><?php echo $t_DinasTeknis; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_DinasPerizinan; ?></b></center></td>				
							<td class="clcenter"><center><b><?php echo $t_TelahTerbit; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $t_Ditolak; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $T_SDinasTeknis; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $T_SDinasPerizinan; ?></b></center></td>													
							<td class="clcenter"><center><b><?php echo $T_STelahTerbit; ?></b></center></td>
							<td class="clcenter"><center><b><?php echo $T_SDitolak; ?></b></center></td>
						</tr>
					<?php } ?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="Pemberitahuan" class="modal fade" tabindex="-1" aria-hidden="true" data-width="800px"
	data-backdrop="static" data-keyboard="false">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<span class="caption-subject text-primary bold uppercase " style="font-size:15px;">
				<center><b>INFORMASI</b></center>
			</span>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-body">
						
          <div class="col-md-12"><br>
						Sehubungan dengan telah diundangkan Peraturan Pemerintah Nomor 16 Tahun 2021 Tentang Peraturan Pelaksanaan
						Undang – Undang Nomor 28 Tahun 2002 Tentang Bangunan Gedung. Untuk Mempermudah Penggunaan SIMBG bagi Pemilik Akun Operator Dinas Teknis:
						<ol><br>
							<li>Untuk Setting di Menu Pengaturan.</li>
							<li>Dikarenakan adanya Kepala Dinas yang merupakan Plt, Pjs, dan Plh<br>
                  a.Agar Melakukan Update di Data Profile Dinas Teknis Karena akan berpengaruh pada Dokumen yang terbit
              <br>
            </ol>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="modal-footer">
		<center><button type="button" data-dismiss="modal" class="btn yellow-crusta">Tutup</button></center>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<script type="text/javascript">
		$('#Pemberitahuan').modal('show');
	</script>
<script>
	$(function() {
		$("#example1").DataTable();
		var table = $('#example1').dataTable();
		//setInterval(getStatus, 1000);
	});
function getthc(v){
	if(v == '2021'){

		config.data.datasets.forEach(function(dataset) {
        dataset.data = dataset.data.map(function() {
          return randomScalingFactor();
			});
		});
		myLine.update();
		
	}else if(v =='2020'){
		
		config.data.datasets.forEach(function(dataset) {
        dataset.data = dataset.data.map(function() {
          return randomScalingFactor();
			});
		});
		myLine.update();
	}else if(v =='2019'){
		
		config.data.datasets.forEach(function(dataset) {
        dataset.data = dataset.data.map(function() {
          return randomScalingFactor();
			});
		});
		myLine.update();
	}else if(v =='2018'){
		
		config.data.datasets.forEach(function(dataset) {
        dataset.data = dataset.data.map(function() {
          return randomScalingFactor();
			});
		});
		myLine.update();
	}else{
		config.data.datasets.forEach(function(dataset) {
        dataset.data = dataset.data.map(function() {
          return randomScalingFactor();
			});
		});
		myLine.update();
			
	}
}

function testClick(){
  console.log('test');
}

window.chartColors = {
  red: 'rgb(255, 99, 132)',
  orange: 'rgb(255, 159, 64)',
  yellow: 'rgb(255, 205, 86)',
  green: 'rgb(75, 192, 192)',
  blue: 'rgb(54, 162, 235)',
  purple: 'rgb(153, 102, 255)',
  grey: 'rgb(231,233,237)'
};

var randomScalingFactor = function() {
  return (Math.random() > 0.5 ? 1.0 : 1.0) * Math.round(Math.random() * 1000);
};

var line1 = [<?php echo $id_camat; ?>];

var line2 = [<?php echo $id_camat; ?>];

var MONTHS = ["Bangunan A", "Bangunan B", "Bangunan C", "Bangunan D", "Bangunan E", "Bangunan F"];
var config = {
  type: 'horizontalBar',
  data: {
    //labels: MONTHS,
	labels: [<?php echo $nama_camat; ?>],
    datasets: [{
      label: "PBG",
      backgroundColor: window.chartColors.red,
      borderColor: window.chartColors.red,
      //data: line1,
      fill: false,
	  data: line1,
    }, {
      label: "SLF",
      fill: false,
      backgroundColor: window.chartColors.blue,
      borderColor: window.chartColors.blue,
      data: line2,
    }]
  },
  options: {
    responsive: true,
	onClick: testClick,
    title:{
      display:false,
      text:'Chart.js Line Chart'
    },
    tooltips: {
      mode: 'index',
      //intersect: false,
    },
    hover: {
      mode: 'nearest',
      intersect: true
    },
    scales: {
      xAxes: [{
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Berdasarkan Jenis Bangunan'
        }
      }],
      yAxes: [{
        display: true,
        scaleLabel: {
          display: true,
        },
      }]
    }
  }
};

var ctx = document.getElementById("canvas").getContext("2d");
var myLine = new Chart(ctx, config);
		
</script>
