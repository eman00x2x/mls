<?php

namespace Library;

use Library\Factory;

class Charts
{

    function getLineChart(Array $data, String $container, String $series_label) {

		if(!isset($data['series']) && !isset($data['labels'])) {
			Factory::setMsg("data should have series and labels in $container", "error");
		    return false;
		}

		Factory::getDocument()->addScript(CDN."tabler/dist/libs/apexcharts/dist/apexcharts.min.js");
		Factory::getDocument()->addScriptDeclaration("

			document.addEventListener('DOMContentLoaded', function () {

				window.ApexCharts && (new ApexCharts(document.getElementById('$container'), {
					chart: {
						type: 'area',
						fontFamily: 'inherit',
						height: 240,
						parentHeightOffset: 0,
						toolbar: { show: false, },
						animations: { enabled: false },
					},
                    dataLabels: { enabled: false, },
					fill: { opacity: .16, type: 'solid' },
					stroke: {
						width: 2,
						lineCap: 'round',
						curve: 'straight',
					},
					series: [{
						name: '$series_label',
						data: $data[series]
					}],
					tooltip: { theme: 'dark' },
					grid: {
						padding: {
							top: -20,
							right: 0,
							left: -4,
							bottom: -4
						},
						strokeDashArray: 4
					},
					xaxis: {
						labels: { padding: 0 },
						tooltip: { enabled: false },
						type: 'datetime',
      			        axisBorder: { show: false, }
					},
					yaxis: {
						labels: { padding: 4 }
					},
					labels: $data[labels],
					colors: [tabler.getColor('primary')],
					legend: { show: false },
				})).render();
			});

		");

	}

    function getBarChart(Array $data, String $container, String $series_label) {

		if(!isset($data['series']) && !isset($data['labels'])) {
			Factory::setMsg("data should have series and labels in $container", "error");
		    return false;
		}

		Factory::getDocument()->addScript(CDN."tabler/dist/libs/apexcharts/dist/apexcharts.min.js");
		Factory::getDocument()->addScriptDeclaration("

			document.addEventListener('DOMContentLoaded', function () {

				window.ApexCharts && (new ApexCharts(document.getElementById('$container'), {
					chart: {
						type: 'bar',
						fontFamily: 'inherit',
						height: 240,
						parentHeightOffset: 0,
						toolbar: { show: false, },
						animations: { enabled: false },
					},
                    plotOptions: {
                        bar: { columnWidth: '50%' }
                    },
                    dataLabels: { enabled: false, },
					fill: { opacity: .16, type: 'solid' },
					stroke: {
						width: 2,
						lineCap: 'round',
						curve: 'straight',
					},
					series: [{
						name: '$series_label',
						data: $data[series]
					}],
					tooltip: { theme: 'dark' },
					grid: {
						padding: {
							top: -20,
							right: 0,
							left: -4,
							bottom: -4
						},
						strokeDashArray: 4
					},
					xaxis: {
						labels: { padding: 0 },
						tooltip: { enabled: false },
						type: 'datetime',
      			        axisBorder: { show: false, }
					},
					yaxis: {
						labels: { padding: 4 }
					},
					labels: $data[labels],
					colors: [tabler.getColor('primary')],
					legend: { show: false },
				})).render();
			});

		");

	}

}