var perda;
$(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) { 
   $( ".contains-chart" ).each(function() { // target each element with the .contains-chart class
        var chart = $(this).highcharts(); // target the chart itself
        chart.reflow() // reflow that chart
		perda;
    });
})

$(document).ready(function() {
	
	perda = $('#prop_perdaThn').highcharts({
		credits: {
		  enabled: false
		},
		chart: {
			zoomType: 'xy'
		},
		title: {
			text: title_perdaThn
		},
		subtitle: {
			text: sub_title_perdaThn
		},
		xAxis: [{
			categories: category_perdaThn
		}],
		yAxis: [{ // Primary yAxis
			max: 475,
			floor: 0,
			labels: {
				format: '{value}',
				style: {
					color: '#b04545'
				}
			},
			title: {
				text: 'Akumulasi',
				style: {
					color: '#b04545'
				}
			}
		}, { // Secondary yAxis
			max: 475,
			floor: 0,
			gridLineDashStyle: 'longdash',
			title: {
				text: 'Jumlah per Tahun',
				style: {
					color: '#134aa4'
				}
			},
			labels: {
				format: '{value}',
				style: {
					color: '#134aa4'
				}
			},
			linkedTo: 0,
			opposite: true
		}],
		tooltip: {
			useHTML: true,
			shared: true,
			crosshairs: [{
				width: 1,
				color: '#d1d1d1',
				dashStyle: 'dash'
			}],
			pointFormat: '<span style="color:{series.color}; font-size:10pt;">{series.name}</span> : <b>{point.y}</b><br/>',
			backgroundColor: 'rgba(255,255,255,0.9)',
			borderColor: 'black',
			borderRadius: 10,
			borderWidth: 0
		},
		legend: {
			layout: 'vertical',
			align: 'left',
			x: 120,
			y: 100,
			verticalAlign: 'top',
			floating: true,
			itemStyle: {
                color: '#000000',
                fontWeight: 'bold'
            }
		},
		plotOptions: {
			series: {
				cursor: 'pointer',
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: true,
				point: {
					events: {
						click: function() {
							//alert (this.category);
							$("."+this.category).trigger("click");
						}
					}
				},
				line: {
					events: {
						click: function() {
							//alert (this.category);
							$("."+this.category).trigger("click");
						}
					}
				}
			}
		},

		series: [{
			name: 'Akumulasi',
			type: 'spline',
			color: '#ef5b5b',
			yAxis: 1,
			data: data_perdaAllThn
		}, {
			name: 'Jumlah Per Tahun',
			type: 'column',
			color: '#134aa4',
			data: data_perdaThn
		}]
	});
	
	$('#prop_perbup').highcharts({
		credits: {
		  enabled: false
		},
        chart: {
            type: 'column'
        },
        title: {
            text: title_perbup
        },
        subtitle: {
            text: sub_title_perbup
        },
        xAxis: {
            categories: category_perbup,
            crosshair: true,
			labels: {
                rotation: rota,
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
				stacking: 'normal',
				cursor: 'pointer',
                    dataLabels: {
                    enabled: false,
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif',
                        textShadow: '0 0 3px black'
                    }
                    },
                     point: {
	                    events: {
		                    click: function() {
								console.log(this.options);
		                        if(this.options.url){
		                            window.open(this.options.url,'_self');
								}
							}
		                }
		            }
            }
        },
        series: data_perbup
    });
	
	$('#prop_rekap').highcharts({
		credits: {
		  enabled: false
		},
        chart: {
            type: 'column'
        },
        title: {
            text: title_impl
        },
        subtitle: {
            text: sub_title_impl
        },
        xAxis: {
            categories: category_impl,
            crosshair: true,
			labels: {
                rotation: rota,
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
				stacking: 'normal',
				cursor: 'pointer',
                    dataLabels: {
                    enabled: false,
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif',
                        textShadow: '0 0 3px black'
                    }
                    },
                     point: {
	                    events: {
		                    click: function() {
								console.log(this.options);
		                        if(this.options.url){
		                            window.open(this.options.url,'_self');
								}
							}
		                }
		            }
            }
        },
        series: data_impl
    });
	
	$('#prop_slf').highcharts({
		credits: {
		  enabled: false
		},
		chart: {
			zoomType: 'xy'
		},
		title: {
			text: title_slf
		},
		subtitle: {
			text: sub_title_slf
		},
		xAxis: [{
			categories: dataThnSLF
		}],
		yAxis: [{ // Primary yAxis
			max: 475,
			floor: 0,
			labels: {
				format: '{value}',
				style: {
					color: '#b04545'
				}
			},
			title: {
				text: 'Akumulasi',
				style: {
					color: '#b04545'
				}
			}
		}, { // Secondary yAxis
			max: 475,
			floor: 0,
			gridLineDashStyle: 'longdash',
			title: {
				text: 'Jumlah per Tahun',
				style: {
					color: '#134aa4'
				}
			},
			labels: {
				format: '{value}',
				style: {
					color: '#134aa4'
				}
			},
			linkedTo: 0,
			opposite: true
		}],
		tooltip: {
			useHTML: true,
			shared: true,
			crosshairs: [{
				width: 1,
				color: '#d1d1d1',
				dashStyle: 'dash'
			}],
			pointFormat: '<span style="color:{series.color}; font-size:10pt;">{series.name}</span> : <b>{point.y}</b><br/>',
			backgroundColor: 'rgba(255,255,255,0.9)',
			borderColor: 'black',
			borderRadius: 10,
			borderWidth: 0
		},
		legend: {
			layout: 'vertical',
			align: 'left',
			x: 120,
			y: 100,
			verticalAlign: 'top',
			floating: true,
			itemStyle: {
                color: '#000000',
                fontWeight: 'bold'
            }
		},
		plotOptions: {
			series: {
				cursor: 'pointer',
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: true,
				point: {
					events: {
						click: function() {
							//alert (this.category);
							$("."+this.category).trigger("click");
						}
					}
				},
				line: {
					events: {
						click: function() {
							//alert (this.category);
							$("."+this.category).trigger("click");
						}
					}
				}
			}
		},

		series: [{
			name: 'Akumulasi',
			type: 'spline',
			color: '#ef5b5b',
			yAxis: 1,
			data: dataTSLF
		}, {
			name: 'Jumlah Per Tahun',
			type: 'column',
			color: '#134aa4',
			data: dataSLF
		}]
	});
	
	$('#prop_tabg').highcharts({
		credits: {
		  enabled: false
		},
		chart: {
			zoomType: 'xy'
		},
		title: {
			text: title_tabg
		},
		subtitle: {
			text: sub_title_tabg
		},
		xAxis: [{
			categories: dataThnTABG
		}],
		yAxis: [{ // Primary yAxis
			max: 475,
			floor: 0,
			labels: {
				format: '{value}',
				style: {
					color: '#b04545'
				}
			},
			title: {
				text: 'Akumulasi',
				style: {
					color: '#b04545'
				}
			}
		}, { // Secondary yAxis
			max: 475,
			floor: 0,
			gridLineDashStyle: 'longdash',
			title: {
				text: 'Jumlah per Tahun',
				style: {
					color: '#134aa4'
				}
			},
			labels: {
				format: '{value}',
				style: {
					color: '#134aa4'
				}
			},
			linkedTo: 0,
			opposite: true
		}],
		tooltip: {
			useHTML: true,
			shared: true,
			crosshairs: [{
				width: 1,
				color: '#d1d1d1',
				dashStyle: 'dash'
			}],
			pointFormat: '<span style="color:{series.color}; font-size:10pt;">{series.name}</span> : <b>{point.y}</b><br/>',
			backgroundColor: 'rgba(255,255,255,0.9)',
			borderColor: 'black',
			borderRadius: 10,
			borderWidth: 0
		},
		legend: {
			layout: 'vertical',
			align: 'left',
			x: 120,
			y: 100,
			verticalAlign: 'top',
			floating: true,
			itemStyle: {
                color: '#000000',
                fontWeight: 'bold'
            }
		},
		plotOptions: {
			series: {
				cursor: 'pointer',
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: true,
				point: {
					events: {
						click: function() {
							//alert (this.category);
							$("."+this.category).trigger("click");
						}
					}
				},
				line: {
					events: {
						click: function() {
							//alert (this.category);
							$("."+this.category).trigger("click");
						}
					}
				}
			}
		},

		series: [{
			name: 'Akumulasi',
			type: 'spline',
			color: '#ef5b5b',
			yAxis: 1,
			data: dataTTABG
		}, {
			name: 'Jumlah Per Tahun',
			type: 'column',
			color: '#134aa4',
			data: dataTABG
		}]
	});
	
	$('#prop_data').highcharts({
		credits: {
		  enabled: false
		},
		chart: {
			zoomType: 'xy'
		},
		title: {
			text: title_pendataan
		},
		subtitle: {
			text: sub_title_pendataan
		},
		xAxis: [{
			categories: dataThnData
		}],
		yAxis: [{ // Primary yAxis
			max: 475,
			floor: 0,
			labels: {
				format: '{value}',
				style: {
					color: '#b04545'
				}
			},
			title: {
				text: 'Akumulasi',
				style: {
					color: '#b04545'
				}
			}
		}, { // Secondary yAxis
			max: 475,
			floor: 0,
			gridLineDashStyle: 'longdash',
			title: {
				text: 'Jumlah per Tahun',
				style: {
					color: '#134aa4'
				}
			},
			labels: {
				format: '{value}',
				style: {
					color: '#134aa4'
				}
			},
			linkedTo: 0,
			opposite: true
		}],
		tooltip: {
			useHTML: true,
			shared: true,
			crosshairs: [{
				width: 1,
				color: '#d1d1d1',
				dashStyle: 'dash'
			}],
			pointFormat: '<span style="color:{series.color}; font-size:10pt;">{series.name}</span> : <b>{point.y}</b><br/>',
			backgroundColor: 'rgba(255,255,255,0.9)',
			borderColor: 'black',
			borderRadius: 10,
			borderWidth: 0
		},
		legend: {
			layout: 'vertical',
			align: 'left',
			x: 120,
			y: 100,
			verticalAlign: 'top',
			floating: true,
			itemStyle: {
                color: '#000000',
                fontWeight: 'bold'
            }
		},
		plotOptions: {
			series: {
				cursor: 'pointer',
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: true,
				point: {
					events: {
						click: function() {
							//alert (this.category);
							$("."+this.category).trigger("click");
						}
					}
				},
				line: {
					events: {
						click: function() {
							//alert (this.category);
							$("."+this.category).trigger("click");
						}
					}
				}
			}
		},

		series: [{
			name: 'Akumulasi',
			type: 'spline',
			color: '#ef5b5b',
			yAxis: 1,
			data: dataTData
		}, {
			name: 'Jumlah Per Tahun',
			type: 'column',
			color: '#134aa4',
			data: dataData
		}]
	});
});