<?php

namespace Admin\Application\Controller;

class DashboardController extends \Main\Controller {

    public $doc;

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

    function index() {
        
        $this->sampleChart();

        $data['total_accounts'] = $this->getTotalAccounts();
        $data['total_earnings'] = $this->getEarningsThisWeek();

        $this->setTemplate("dashboard/index.php");
		return $this->getTemplate($data);
    }

    function getTotalAccounts() {

        $accounts = $this->getModel("Account");
        $accounts->select(" COUNT(account_id) as total ");
        $accounts->page['limit'] = 100000;
        $data = $accounts->getList();

        return $data[0]['total'];

    }

     function getEarningsThisWeek() {

        $transactions = $this->getModel("Transaction");
        $transactions->select(" SUM(premium_price) as total ");
        $transactions->where(" YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1) ");
        $transactions->page['limit'] = 100000;
        $data = $transactions->getList();

        if($data[0]['total'] > 0) {
            return $data[0]['total'];
        }else {
            return 0;
        }

    }

    function sampleChart() {

        $from_date = strtotime(date("Y-01-01", DATE_NOW));
        $to_date = strtotime(date("Y-12-t", DATE_NOW));

        $transactions = $this->getModel("Transaction");
        $transactions->select(" SUM(premium_price) as total, FROM_UNIXTIME(created_at, '%Y-%m-%d') as date ");
        $transactions->where(" created_at >= $from_date AND created_at <= $to_date ");
        $transactions->groupBy(" date ");
        $transactions->page['limit'] = 100000;
        $data = $transactions->getList();

        
        if($data) {
            for($i=0; $i<count($data); $i++) {
                $dates[] = $data[$i]['date'];
                $totals[] = $data[$i]['total'];
            }
        }


        $this->doc->addScript(CDN."tabler/dist/libs/apexcharts/dist/apexcharts.min.js?1695847769");
        $this->doc->addScriptDeclaration("
        
            document.addEventListener('DOMContentLoaded', function () {
                window.ApexCharts && (new ApexCharts(document.getElementById('chart-mentions'), {
                    chart: {
                        type: 'bar',
                        fontFamily: 'inherit',
                        height: 240,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        animations: {
                            enabled: false
                        },
                        stacked: true,
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '50%',
                        }
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        opacity: 1,
                    },
                    series: [{
                        name: 'Premium Purchase',
                        data: ['".implode("','",$totals)."']
                    }],
                    tooltip: {
                        theme: 'dark'
                    },
                    grid: {
                        padding: {
                            top: -20,
                            right: 0,
                            left: -4,
                            bottom: -4
                        },
                        strokeDashArray: 4,
                        xaxis: {
                            lines: {
                                show: true
                            }
                        },
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false
                        },
                        axisBorder: {
                            show: false,
                        },
                        type: 'datetime',
                    },
                    yaxis: {
                        labels: {
                            padding: 4
                        },
                    },
                    labels: [
                        '".implode("','",$dates)."'
                    ],
                    colors: [tabler.getColor('primary'), tabler.getColor('primary', 0.8), tabler.getColor('green', 0.8)],
                    legend: {
                        show: false,
                    },
                })).render();
            });

        ");

    }

}