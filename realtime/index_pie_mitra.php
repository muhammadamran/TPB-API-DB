<?php
include "../include/connection.php";
// include "../include/restrict.php";
?>
<!-- Query For Mitra -->
<?php
// Total Mitra
$DashboardDataMitraCount = $dbcon->query("SELECT COUNT(*) AS dashboard_total_mitra FROM referensi_pengusaha");
$ResultDashboarddataMitraCount = mysqli_fetch_array($DashboardDataMitraCount);

// echo $ResultDashboarddataMitraCount['dashboard_total_mitra'];

// Total Mitra Memiliki No.SKEP
$DashboardDataMitraCountAnySKEP = $dbcon->query("SELECT COUNT(*) AS dashboard_total_mitra_any_SKEP FROM referensi_pengusaha WHERE NOMOR_SKEP IS NOT NULL");
$ResultDashboarddataMitraCountAnySKEP = mysqli_fetch_array($DashboardDataMitraCountAnySKEP);
// Total Mitra Tidak Memiliki No.SKEP
$DashboardDataMitraCountNoSKEP = $dbcon->query("SELECT COUNT(*) AS dashboard_total_mitra_No_SKEP FROM referensi_pengusaha WHERE NOMOR_SKEP IS NULL");
$ResultDashboarddataMitraCountNoSKEP = mysqli_fetch_array($DashboardDataMitraCountNoSKEP);
?>
<style type="text/css">
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 320px;
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
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


    input[type="number"] {
        min-width: 50px;
    }
</style>
<script src="../assets/highcharts/highcharts.js"></script>
<script src="../assets/highcharts/modules/exporting.js"></script>
<script src="../assets/highcharts/modules/export-data.js"></script>
<script src="../assets/highcharts/modules/accessibility.js"></script>
<figure class="highcharts-figure">
    <div id="chart_mitra_pie"></div>
</figure>
<script type="text/javascript">
    Highcharts.chart('chart_mitra_pie', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: '<b><?= $ResultDashboarddataMitraCount['dashboard_total_mitra']; ?> Total</b> Data Mitra'
        },
        subtitle: {
            text: 'Update: <?= date('Y-m-d'); ?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:,.0f} Mitra</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Total',
            colorByPoint: true,
            data: [{
                name: 'Mitra Memiliki No.SKEP',
                y: <?= $ResultDashboarddataMitraCountAnySKEP['dashboard_total_mitra_any_SKEP']; ?>,
                sliced: true,
                selected: true
            }, {
                name: 'Mitra Tidak Memiliki No.SKEP',
                y: <?= $ResultDashboarddataMitraCountNoSKEP['dashboard_total_mitra_No_SKEP']; ?>
            }]
        }]
    });
</script>