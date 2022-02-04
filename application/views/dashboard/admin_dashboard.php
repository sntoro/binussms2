<script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/highcharts.js'); ?>"></script>

<style type="text/css">
	.highcharts-figure,
	.highcharts-data-table table {
		min-width: 360px;
		max-width: 100%;
		margin: 1em auto;
	}

	.highcharts-data-table table {
		font-family: Verdana, sans-serif;
		border-collapse: collapse;
		border: 1px solid #ebebeb;
		margin: 10px auto;
		text-align: center;
		width: 100%;
		max-width: 100%;
	}

	.highcharts-data-table caption {
		padding: 1em 0;
		font-size: 1.2em;
		color: #555;
	}

	.highcharts-data-table th {
		font-weight: 600;
		padding: 0.5em;
	}

	.highcharts-data-table td,
	.highcharts-data-table th,
	.highcharts-data-table caption {
		padding: 0.5em;
	}

	.highcharts-data-table thead tr,
	.highcharts-data-table tr:nth-child(even) {
		background: #f8f8f8;
	}

	.highcharts-data-table tr:hover {
		background: #f1f7ff;
	}
</style>

<script type="text/javascript">
	var container;
	$(document).ready(function() {
		container = new Highcharts.Chart({

			chart: {
				renderTo: 'container',
				defaultSeriesType: 'line',
			},
			title: {
				text: 'Production Total - Jan 2022'
			},

			yAxis: {
				title: {
					text: 'Production Result'
				}
			},

			xAxis: {
				categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31]
			},

			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'middle'
			},

			plotOptions: {
				series: {
					label: {
						connectorAllowed: false
					},
					pointStart: 0
				}
			},

			series: [{
				name: 'Part 0001',
				data: [1642, 1700, 1712, 1752, 1780, 1850, 1890, 1900, 1700, 1550, 1700, 1642, 1700, 1800, 1800, 1242, 1131, 1700, 1700, 1333, 1545, 1700, 1700, 1800, 1642, 1342, 1800, 1800, 1550, 1700, 1700]
			}, {
				name: 'Part 0002',
				data: [1256, 1600, 1600, 1231, 1642, 1642, 1700, 1642, 1700, 1201, 1242, 1256, 1550, 1700, 1142, 1333, 1550, 1700, 1142, 1700, 1700, 1342, 1342, 1800, 1700, 1700, 1600, 1700, 1111, 1200, 1800]
			}, {
				name: 'Part 0003',
				data: [1342, 1342, 1800, 1642, 1700, 1800, 1800, 1342, 1266, 1700, 1700, 1700, 1550, 1700, 1700, 1700, 1700, 1700, 1111, 1200, 1800, 1642, 1700, 1800, 1800, 1342, 1266, 1700, 1700, 1700, 1550]
			}, {
				name: 'Part 0004',
				data: [1700, 1700, 1800, 1642, 1342, 1800, 1342, 1342, 1800, 1700, 1700, 1642, 1700, 1800, 1800, 1342, 1266, 1700, 1700, 1700, 1550, 1700, 1700, 1700, 1111, 1200, 1800, 1800, 1550, 1700, 1700]
			}, {
				name: 'Part 0005',
				data: [1700, 1700, 1700, 1642, 1700, 1600, 1768, 1342, 1700, 1550, 1700, 1642, 1700, 1800, 1800, 1342, 1266, 1700, 1700, 1700, 1550, 1700, 1700, 1800, 1642, 1342, 1800, 1800, 1550, 1700, 1700]
			}],

			responsive: {
				rules: [{
					condition: {
						maxWidth: 1242
					},
					chartOptions: {
						legend: {
							layout: 'horizontal',
							align: 'center',
							verticalAlign: 'bottom'
						}
					}
				}]
			}

		});
	});

	var container2;
	$(document).ready(function() {
		container2 = new Highcharts.Chart({

			chart: {
				renderTo: 'container2',
				defaultSeriesType: 'column',
			},
			title: {
				text: 'Machine Production Result 2017 - 2021'
			},

			yAxis: {
				title: {
					text: 'Qty Per Pcs'
				}
			},

			xAxis: {
				accessibility: {
					rangeDescription: 'Range: 2017 to 2021'
				}
			},

			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'middle'
			},

			plotOptions: {
				series: {
					label: {
						connectorAllowed: false
					},
					pointStart: 2017
				}
			},

			series: [{
				name: 'Machine Category A',
				data: [1142, 1700, 1812, 2500, 2935]
			}, {
				name: 'Machine Category B',
				data: [1056, 1600, 1800, 2231, 2621]
			}, {
				name: 'Machine Category C',
				data: [1142, 1342, 1800, 2400, 2911]
			}],

			responsive: {
				rules: [{
					condition: {
						maxWidth: 1242
					},
					chartOptions: {
						legend: {
							layout: 'horizontal',
							align: 'center',
							verticalAlign: 'bottom'
						}
					}
				}]
			}

		});
	});

	var container3;
	$(document).ready(function() {
		container3 = new Highcharts.Chart({

			chart: {
				renderTo: 'container3',
				defaultSeriesType: 'spline',
			},
			title: {
				text: 'Production Result 2017 - 2021'
			},

			yAxis: {
				title: {
					text: 'Qty Per Pcs'
				}
			},

			xAxis: {
				accessibility: {
					rangeDescription: 'Range: 2017 to 2021'
				}
			},

			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'middle'
			},

			plotOptions: {
				series: {
					label: {
						connectorAllowed: false
					},
					pointStart: 2017
				}
			},

			series: [{
					name: 'Part Category A',
					data: [112, 170, 182, 250, 295]
				}, {
					name: 'Part Category B',
					data: [156, 160, 180, 211, 221]
				}, {
					name: 'Part Category C',
					data: [112, 132, 160, 240, 311]
				}, {
					name: 'Part Category D',
					data: [92, 102, 110, 140, 171]
				}, {
					name: 'Part Category E',
					data: [102, 110, 122, 150, 185]
				}
			],

			responsive: {
				rules: [{
					condition: {
						maxWidth: 1242
					},
					chartOptions: {
						legend: {
							layout: 'horizontal',
							align: 'center',
							verticalAlign: 'bottom'
						}
					}
				}]
			}

		});
	});
</script>

<!-- top tiles -->
<div class="row tile_count">
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Total Parts Registered</span>
		<div class="count"><?php echo $data_parts ?></div>
		<span class="count_bottom"><i class="green">4% </i> From last Week</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-clock-o"></i> Total Machines Registered</span>
		<div class="count"><?php echo $data_machines ?></div>
		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Total Part This wek</span>
		<div class="count green"><?php echo $qty_parts_perweek ?></div>
		<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> User Active</span>
		<div class="count"><?php echo $qty_machines_perweek ?></div>
		<span class="count_bottom">Has been active</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Total Parts</span>
		<div class="count"><?php echo $qty_parts_permonth ?></div>
		<span class="count_bottom">Had been used this month</span>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		<span class="count_top"><i class="fa fa-user"></i> Total Machine</span>
		<div class="count"><?php echo $qty_machines_permonth ?></div>
		<span class="count_bottom"> has been used this month</span>
	</div>
</div>
<!-- /top tiles -->

<div class="clearfix"></div>
<!-- start of weather widget -->
<!-- <div class="col-md-12 col-sm-6 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>Daily active users <small>Sessions</small></h2>
			<ul class="nav navbar-right panel_toolbox">
				<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Settings 1</a>
						</li>
						<li><a href="#">Settings 2</a>
						</li>
					</ul>
				</li>
				<li><a class="close-link"><i class="fa fa-close"></i></a>
				</li>
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="row">
				<div class="col-sm-12">
					<div class="temperature"><b>Monday</b>, 07:30 AM
						<span>F</span>
						<span><b>C</b></span>
					</div>
				</div>
			</div>

			<div class="col-sm-12">
				<div class="weather-text pull-right">
					<h3 class="degrees">23</h3>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="row weather-days">
				<div class="col-sm-2">
					<div class="daily-weather">
						<h2 class="day">Mon</h2>
						<h3 class="degrees">25</h3>
						<canvas id="clear-day" width="32" height="32"></canvas>
						<h5>15 <i>km/h</i></h5>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="daily-weather">
						<h2 class="day">Tue</h2>
						<h3 class="degrees">25</h3>
						<canvas height="32" width="32" id="rain"></canvas>
						<h5>12 <i>km/h</i></h5>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="daily-weather">
						<h2 class="day">Wed</h2>
						<h3 class="degrees">27</h3>
						<canvas height="32" width="32" id="snow"></canvas>
						<h5>14 <i>km/h</i></h5>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="daily-weather">
						<h2 class="day">Thu</h2>
						<h3 class="degrees">28</h3>
						<canvas height="32" width="32" id="sleet"></canvas>
						<h5>15 <i>km/h</i></h5>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="daily-weather">
						<h2 class="day">Fri</h2>
						<h3 class="degrees">28</h3>
						<canvas height="32" width="32" id="wind"></canvas>
						<h5>11 <i>km/h</i></h5>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="daily-weather">
						<h2 class="day">Sat</h2>
						<h3 class="degrees">26</h3>
						<canvas height="32" width="32" id="cloudy"></canvas>
						<h5>10 <i>km/h</i></h5>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div> -->
<!-- end of weather widget -->