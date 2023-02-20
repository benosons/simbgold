<div class="portlet-title margin-top-10">
	<div class="page-title" align="center"><span class="caption font-blue-hoki bold" style="font-size: 22px;">Rekapitulasi Proses Persetujuan Bangunan Gedung (PBG)</span></div>
</div>
<div class="row margin-top-10">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat blue-madison">
			<div class="visual"><i class="fa fa-comments"></i></div>
			<div class="details">
				<div class="number"><u><b><?php echo number_format($pbg_rekap->Total,0,',','.')?></b></u></div>
				<div class="desc">Total Pengajuan PBG</div>
			</div>	
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat green-haze">
			<div class="visual"><i class="fa fa-bar-chart-o"></i></div>
			<div class="details">
				<div class="number"><u><b><?php echo number_format($pbg_rekap->DinasTeknis,0,',','.')?></b></u></div>
				<div class="desc">Di Dinas Teknis</div>
			</div>	
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat red-intense">
			<div class="visual"><i class="fa fa-shopping-cart"></i></div>
			<div class="details">
				<div class="number"><u><b><?php echo number_format($pbg_rekap->DinasPerizinan,0,',','.')?></b></u></div>
				<div class="desc">Di Dinas Perizinan</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat purple-plum">
			<div class="visual"><i class="fa fa-globe"></i></div>
			<div class="details">
				<div class="number"><u><b><?php echo number_format($pbg_rekap->TelahTerbit,0,',','.')?></b></u> / <u><b><?php echo number_format($pbg_rekap->Ditolak,0,',','.')?></b></u></div>
				<div class="desc">Telah Terbit / Ditolak</div>
			</div>	
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
<div class="portlet-title margin-top-10">
	<div class="page-title" align="center"><span class="caption font-blue-hoki bold" style="font-size: 22px;"> Data Profesi Ahli</span></div>
</div>
<div class="row margin-top-20">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat blue-madison">
			<div class="visual"><i class="fa fa-comments"></i></div>
			<div class="details">
				<div class="number"><u><b><?php echo number_format($tpa_rekap->CalonTpa,0,',','.')?></b></u> / <u><b><?php echo number_format($tpa_rekap->TPA,0,',','.')?></b></u></div>
				<div class="desc">Calon TPA / TPA</div>
			</div>	
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat green-haze">
			<div class="visual"><i class="fa fa-bar-chart-o"></i></div>
			<div class="details">
				<div class="number"><u><b><?php echo number_format($tpa_rekap->CalonAka,0,',','.')?></b></u> / <u><b><?php echo number_format($tpa_rekap->TpaAka,0,',','.')?></b></u></div>
				<div class="desc">Calon TPA / TPA Akademisi</div>
			</div>	
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat red-intense">
			<div class="visual"><i class="fa fa-shopping-cart"></i></div>
			<div class="details">
				<div class="number"><u><b><?php echo number_format($tpa_rekap->CalonAso,0,',','.')?></b></u> / <u><b><?php echo number_format($tpa_rekap->TpaAso,0,',','.')?></b></u></div>
				<div class="desc">Calon Tpa / TPA Asosiasi Profesi</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat purple-plum">
			<div class="visual"><i class="fa fa-globe"></i></div>
			<div class="details">
				<div class="number"><u><b><?php echo number_format($tpa_rekap->CalonPakar,0,',','.')?></b></u> / <u><b><?php echo number_format($tpa_rekap->TpaPakar,0,',','.')?></b></u></div>
				<div class="desc">Calon TPA / TPA Pakar </div>
			</div>	
		</div>
	</div>
</div>
<!--<div class="row" >
	<div class="col-md-12">
		<div class="portlet"><div id="containermaps"></div></div>
	</div>
</div>-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet">
			<div id="containerbar" style="height: 500px;"></div>
		</div>
	</div>
</div>
<div id="Provinsi"  class="modal fade" tabindex="-1" aria-hidden="true" data-width="860px" data-backdrop="static" data-keyboard="false">
	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption"><span class="caption-subject font-green-sharp bold uppercase">Data Per-Provinsi</span></div>
			<div class="tools"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button></div>
		</div>
		<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover" id="bacot">
				<thead>
					<tr class="odd gradeX">
						<th>#</th>
						<!--<th>ID</th>-->
						<th>Kabupaten/Kota</th>
						<th>Verifikasi</th>
						<th>Penugasan</br>TPA/TPT</th>
						<th>Penjadwalan</th>
						<th>Konsultasi</th>
						<th>Perhitungan</br>Retribus</th>
						<th>Validasi Kepala</br>Dinas Teknis</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
	<div id="demo"></div>
</div>
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/id/id-all.js"></script>

<script>
// Prepare demo data
// Data is joined to map using value of 'hc-key' property by default.
// See API docs for 'joinBy' for more info on linking data and map.
var data = [
    ['id-3700', 0],
    ['id-ac', 11],
    ['id-jt', 33],
    ['id-be', 17],
    ['id-bt', 36],
    ['id-kb', 61],
    ['id-bb', 19],
    ['id-ba', 51],
    ['id-ji', 35],
    ['id-ks', 63],
    ['id-nt', 53],
    ['id-se', 73],
    ['id-kr', 21],
    ['id-ib', 92],
    ['id-su', 12],
    ['id-ri', 14],
    ['id-sw', 71],
    ['id-ku', 65],
    ['id-la', 82],
    ['id-sb', 13],
    ['id-ma', 81],
    ['id-nb', 52],
    ['id-sg', 74],
    ['id-st', 72],
    ['id-pa', 91],
    ['id-jr', 32],
    ['id-ki', 64],
    ['id-1024', 18],
    ['id-jk', 31],
    ['id-go', 75],
    ['id-yo', 34],
    ['id-sl', 16],
    ['id-sr', 76],
    ['id-ja', 15],
    ['id-kt', 62]
];


// Create the chart
Highcharts.mapChart('containermaps', {
    chart: {
        map: 'countries/id/id-all'
    },
	exporting: {
        buttons: {
            contextButton: {
                enabled: false
            }    
        }
    },
    title: {
		enabled: false,
        text: ''
    },
    subtitle: {
		display: false,
        //text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/id/id-all.js">Indonesia</a>'
    },
    mapNavigation: {
        enabled: true,
        buttonOptions: {
            verticalAlign: 'bottom'
        }
    },

    colorAxis: {
        min: 0
    },
	
	credits: {
		enabled: false
	},
	
	legend:{ enabled:false },
	
	plotOptions: {
            series: {
                point: {
                    events: {
                        click: function () {
							TProv(this.value);
                        }
                    }
                }
            }
        },
	tooltip: {
        enabled: false
    },
    series: [{
        data: data,
		joinBy: null,
        name: 'Random data',
        states: {
            hover: {
                color: '#BADA55'
            }
        },
        dataLabels: {
            enabled: true,
            format: '{point.name}'
        }
    }]
});
var prov = <?php echo $provinsi; ?>;

	// Create the chart
	Highcharts.chart('containerbar', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Jumlah Permohonan PBG Per Provinsi'
		},
		subtitle: {
			text: ''
		},
		accessibility: {
			announceNewData: {
				enabled: true
			}
		},
		xAxis: {
			type: 'category'
		},
		yAxis: {
			title: {
				text: 'Mean of Jumlah kepala RT'
			}
		},
		legend: {
			enabled: false
		},
		plotOptions: {
			series: {
				borderWidth: 0,
				dataLabels: {
					enabled: true,
					format: '{point.y:f}'
				},
				point: {
					events: {
						click: function(e) {
							TProv(e.point.id)
						}
					}
				}
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
		},
		series: [{
			name: "Provinsi",
			colorByPoint: true,
			data: prov
		}]
	});
function Prov2(id){
	$.ajax({
		type : "GET",
		url  : "<?php echo base_url('Dashboard/DatProv/')?>",
		dataType : "JSON",
		data : {id:id},
		success: function(data){
			$('#Provinsi').modal('show');
			table = $('#bacot').DataTable({ 
				"ajax": {
					"url": "<?php echo base_url('Dashboard/DatProv2/')?>",
					"type": "GET",
					"dataSrc": ""
				},
			});
        }
    });
    return false;
};
	function TProv(id){
		$('#Provinsi').modal('show');
		var umx = "<?php echo base_url('Dashboard/DatProv2/')?>",	
		table = $('#bacot').DataTable({
			destroy: true,
			"ajax": {
						"type": "get",
						"url": umx+id,
						"dataSrc": ""
			},
		});
		console.log(id);
        return false;
	};
	function reload_table()
	{
		table = $('#bacot').DataTable({
			destroy: true,
		});
		$('#Provinsi').modal('hide');
	}
</script>
