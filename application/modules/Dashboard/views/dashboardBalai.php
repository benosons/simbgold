<div class="row margin-top-20">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="fa fa-comments"></i>
						</div>
						<div class="details">
							<div class="number">
								 3.167.425
							</div>
							<div class="desc">
								 Dalam Prosses
							</div>
						</div>
						
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green-haze">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>
						<div class="details">
							<div class="number">
								 912.500
							</div>
							<div class="desc">
								 Telah Terbit / Selesai
							</div>
						</div>
						
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat red-intense">
						<div class="visual">
							<i class="fa fa-shopping-cart"></i>
						</div>
						<div class="details">
							<div class="number">
								 549
							</div>
							<div class="desc">
								 Ditolak
							</div>
						</div>
						
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple-plum">
						<div class="visual">
							<i class="fa fa-globe"></i>
						</div>
						<div class="details">
							<div class="number">
								 Rp. 12,5M 
							</div>
							<div class="desc">
								 Total Retribusi
							</div>
						</div>
						
					</div>
				</div>
			</div>
<div class="row" >

	<div class="col-md-12">
		<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								
								<span class="caption-subject font-blue-sharp bold uppercase">DATA PERKABUPATEN/KOTA</span>
							</div>
							<!--div class="actions">
														<select class="form-control" name="thc" id="thc" onchange="getthc(this.value)">
															<option value="">Pilih Tahun</option>
															<option value="2021">Tahun 2021</option>
															<option value="2020">Tahun 2020</option>
															<option value="2019">Tahun 2019</option>
															<option value="2018">Tahun 2018</option>
														</select>
							</div-->
							
						</div>
						
						<div class="portlet-body">
						<table id="example1" class="table table-bordered table-striped table-hover">
				<thead>
					<tr class=" odd gradeX">
						<th>#</th>
						<th>ID</th>
						<th>Kabupaten</th>
						<th>IMB</th>
						<th>PBG</th>
						<th>SLF</th>
						<th>SBKBG</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($daftar_kabkota->result() as $row) {
						$jum_imb = $this->Mglobals->getData('*', 'tm_imb_permohonan', array('id_kabkot' => $row->id_kabkot, 'status_progress >= 13' => null))->num_rows();
						$jum_pbg = $this->Mglobals->getData('*', 'tmdatabangunan', array('id_kabkot_bgn' => $row->id_kabkot, 'status' => 16))->num_rows();

					?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $row->id_kabkot; ?></td>
							<td><?= $row->nama_kabkota; ?></td>
							<td><?= $jum_imb; ?></td>
							<td><?= $jum_pbg; ?></td>
							<td></td>
							<td></td>
						</tr>
					<?php

					}
					?>
				</tbody>
			</table>
							
						</div>
						<!-- <div class="portlet-body">
						<canvas id="canvas" ></canvas>
						</div> -->
		</div>
	</div>
	
	
	
</div>
	<?php
		//Inisialisasi nilai variabel awal
		$nama_camat= "";
		
		$id_camat="";
		
			foreach ($daftar_kabkota->result() as $row) {
				
				// sample
				$aa=$row->nama_kabkota;
				$nama_camat .= "'$aa'". ", ";
				
				$bb=$row->id_kabkot;
				$id_camat .= "'$bb'". ", ";
				
			}
		
    ?>
	


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


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
