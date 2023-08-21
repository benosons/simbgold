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
						<ol><br>
						<li>Terkait pemutakhiran SIMBG tanggal 3 Juli 2023 mengingat Pasal 11 ayat (1) PP Nomor 16 Tahun 2021 bahwa fungsi dan klasifikasi bangunan gedung dicantumkan dalam PBG, SLF, dan SBKBG, Pemda agar <b>menginputkan klasifikasi bangunan gedung secara manual</b> untuk permohonan PBG yang sedang diproses pada <b>halaman finalisasi data bangunan gedung</b>, meliputi lokasi, tingkatrisiko bahaya kebakaran, dan Klas bangunan.</li><br>
						<li>Panduan pengisian klasifikasi lokasi, tingkat risiko bahaya kebakaran dan Klas bangunan dapat dilihat dalam SIMBG atau pada Lampiran PP Nomor 16 Tahun 2021 halaman 21 s.d. 30.</li><br>
						<li>Sehubungan dengan permasalahan tidak munculnya penugasan TPA/TPT pada beberapa daerah, mohon Operator/Pengawas agar memperbarui isian <b>Tahun berlaku SK TPA/TPT menjadi Tahun 2023</b> pada menu pengaturan</li><br>
						<li>Apabila terdapat pergantian pejabat Kepala Dinas Teknis baik pejabat definitive maupun PelaksanaTugas (Plt.), Penjabat Sementara (Pjs.), atau Pelaksana Harian (Plh,), Dinas Teknis harus segera melakukan pemutakhiran (update) di Data Profile Dinas Karena akan mempengaruhi pejabat penandatanganSK-PBG yang terbit ketika proses validasi.</li>
						<br>
						</ol>
					</div>
					<span class="caption-subject text-primary bold uppercase " style="font-size:12px;"><center><b>Terima Kasih</b></center></span>
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
