<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
// include "include/sidebar.php";
include "include/cssDatatables.php";
?>
<!-- Query For Mitra -->
<?php
// Total Mitra
$DashboardDataMitraCount = $dbcon->query("SELECT COUNT(*) AS dashboard_total_mitra FROM referensi_pengusaha");
$ResultDashboarddataMitraCount = mysqli_fetch_array($DashboardDataMitraCount);

// Total Mitra Memiliki No.SKEP
$DashboardDataMitraCountAnySKEP = $dbcon->query("SELECT COUNT(*) AS dashboard_total_mitra_any_SKEP FROM referensi_pengusaha WHERE NOMOR_SKEP IS NOT NULL");
$ResultDashboarddataMitraCountAnySKEP = mysqli_fetch_array($DashboardDataMitraCountAnySKEP);
// Total Mitra Tidak Memiliki No.SKEP
$DashboardDataMitraCountNoSKEP = $dbcon->query("SELECT COUNT(*) AS dashboard_total_mitra_No_SKEP FROM referensi_pengusaha WHERE NOMOR_SKEP IS NULL");
$ResultDashboarddataMitraCountNoSKEP = mysqli_fetch_array($DashboardDataMitraCountNoSKEP);

if ($resultRoleModules['da_one'] == 'none') {
    $TitleDashboardOne = 'none';
} else {
    $TitleDashboardOne = 'show';
}

if ($resultRoleModules['da_two'] == 'none') {
    $TitleDashboardTwo = 'none';
} else {
    $TitleDashboardTwo = 'show';
}
?>
<!-- begin #content -->
<!-- <div id="content" class="content"> -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-chart-pie icon-page"></i>
                <font class="text-page">Dashboard - Summary</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Perusahaan: <?= $resultSetting['company']  ?></li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span
                    id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;">
                        <?= date('h:m:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- Tab -->
    <div class="row">
    </div>
    <div class="row">
        <div class="col-xl-12">
            <ul class="nav nav-pills mb-2">
                <li class="nav-item">
                    <a href="index_dashboard.php" class="nav-link active">
                        <span class="d-sm-none">Main</span>
                        <span class="d-sm-block d-none">Main</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
					<a href="index_dashboard_one.php" class="nav-link">
						<span class="d-sm-none">Dokumen Pabean</span>
						<span class="d-sm-block d-none">Dokumen Pabean</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="index_dashboard_two.php" class="nav-link">
						<span class="d-sm-none">Gate Mandiri</span>
						<span class="d-sm-block d-none">Gate Mandiri</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="index_dashboard_three.php" class="nav-link">
						<span class="d-sm-none">Komunikasi</span>
						<span class="d-sm-block d-none">Komunikasi</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="index_dashboard_four.php" class="nav-link">
						<span class="d-sm-none">Referensi</span>
						<span class="d-sm-block d-none">Referensi</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="index_dashboard_five.php" class="nav-link">
						<span class="d-sm-none">Utility</span>
						<span class="d-sm-block d-none">Utility</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="index_dashboard_six.php" class="nav-link">
						<span class="d-sm-none">Report</span>
						<span class="d-sm-block d-none">Report</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="index_dashboard_seven.php" class="nav-link">
						<span class="d-sm-none">Administrator</span>
						<span class="d-sm-block d-none">Administrator</span>
					</a>
				</li> -->
            </ul>
            <div class="tab-content mb-4">
                <div class="tab-pane fade active show" id="tab-main">
                    <!-- Line 1 -->
                    <!-- <div class="row"> -->
                    <div class="row" style="display: <?= $TitleDashboardOne ?>;">
                        <div class="col-xl-4">
                            <div id="table_aktifitas_sistem"></div>
                        </div>
                        <div class="col-xl-4">
                            <div id="table_pengguna_sedang_aktif"></div>
                        </div>
                        <?php
                        $userDevice = $_SESSION['username'];
                        $dataSetDevice = $dbcon->query("SELECT * FROM tbl_log WHERE log_username='$userDevice' ORDER BY id DESC LIMIT 1");
                        $resultSetDevice = mysqli_fetch_array($dataSetDevice);
                        ?>
                        <!-- Device Sign In -->
                        <div class="col-xl-4">
                            <div class="card border-0 bg-dark text-white mb-3 overflow-hidden">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-7 col-lg-8">
                                            <div class="mb-3 text-grey">
                                                <b>Informasi Perangkat anda:</b>
                                                <span class="ml-2">
                                                    <i class="fa fa-info-circle" data-toggle="popover"
                                                        data-trigger="hover" data-title="Informasi Perangkat anda:"
                                                        data-placement="top"
                                                        data-content="Perangkat yang digunakan, IP Address, Browser akses, Sign In Time dan Status"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex mb-1">
                                                <?php if ($resultSetDevice['log_agent'] == 'Desktop') { ?>
                                                <h2 class="mb-0">Akses Desktop</span></h2>
                                                <div style="margin-top: 15px;font-size: 7px;margin-left: 3px;color: greenyellow;"
                                                    class="blink_me">
                                                    <i class="fas fa-circle"></i> Online
                                                </div>
                                                <?php } else if ($resultSetDevice['log_agent'] == 'Mobile') { ?>
                                                <h2 class="mb-0">Akses Mobile</span></h2>
                                                <div style="margin-top: 15px;font-size: 7px;margin-left: 3px;color: greenyellow;"
                                                    class="blink_me">
                                                    <i class="fas fa-circle"></i> Online
                                                </div>
                                                <?php } else { ?>
                                                <h2 class="mb-0">Tidak dikenali!</span></h2>
                                                <div style="margin-top: 15px;font-size: 7px;margin-left: 3px;color: red;"
                                                    class="blink_me">
                                                    <i class="fas fa-circle"></i> Online
                                                </div>
                                                <?php } ?>
                                                <div class="ml-auto mt-n1 mb-n1">
                                                    <div id="total-sales-sparkline"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3 text-grey">
                                                <i class="fa fa-clock"></i> Sign In:
                                                <?= date_indo(SUBSTR($resultSetDevice['log_date'], 0, 10), TRUE); ?>
                                            </div>
                                            <hr class="bg-white-transparent-2" />
                                            <div class="row text-truncate">
                                                <!-- begin col-6 -->
                                                <div class="col-6">
                                                    <div class="f-s-12 text-grey">IP Address:</div>
                                                    <div class="f-s-18 m-b-5 f-w-600 p-b-1" data-animation="number"
                                                        data-value="<?= $resultSetDevice['log_ip']; ?>">
                                                        <?= $resultSetDevice['log_ip']; ?></div>
                                                    <!-- <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                                            <div class="progress-bar progress-bar-striped rounded-right bg-teal" data-animation="width" data-value="55%" style="width: 0%"></div>
                                                        </div> -->
                                                </div>
                                                <div class="col-6">
                                                    <div class="f-s-12 text-grey">Browser:</div>
                                                    <div class="f-s-18 m-b-5 f-w-600 p-b-1"><span
                                                            data-animation="number"
                                                            data-value="<?= $resultSetDevice['log_browser']; ?>"><?= $resultSetDevice['log_browser']; ?></span>
                                                    </div>
                                                    <!-- <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                                            <div class="progress-bar progress-bar-striped rounded-right" data-animation="width" data-value="55%" style="width: 0%"></div>
                                                        </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-5 col-lg-4 align-items-center d-flex justify-content-center">
                                            <?php if ($resultSetDevice['log_agent'] == 'Desktop') { ?>
                                            <img src="assets/img/svg/typing-animate.svg" height="150px"
                                                class="d-none d-lg-block" />
                                            <?php } else if ($resultSetDevice['log_agent'] == 'Mobile') { ?>
                                            <img src="assets/img/svg/usability-testing-animate.svg" height="150px"
                                                class="d-none d-lg-block" />
                                            <?php } else { ?>
                                            <img src="assets/img/svg/questions-animate.svg" height="150px"
                                                class="d-none d-lg-block" />
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Device Sign In -->
                        <!-- Data Pengguna All -->
                        <div class="col-xl-12">
                            <div id="data-pengguna-all"></div>
                        </div>
                        <!-- End Data Pengguna All -->
                    </div>
                    <div class="row" style="display: <?= $TitleDashboardTwo ?>;">
                        <!-- Dashboard Mitra -->
                        <div class="col-xl-4">
                            <div class="panel panel-inverse" id="data-mitra-chart">
                                <!-- begin panel-heading -->
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fas fa-chart-line"></i> Data Mitra TPBERP
                                        <?= $resultSetting['company']  ?></h4>
                                    <?php include "include/panel-row.php"; ?>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- <div class="col-xl-8"> -->
                                        <!-- <div id="chart_mitra_line"></div> -->
                                        <!-- </div> -->
                                        <div class="col-xl-12">
                                            <div id="chart_mitra_pie"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Dashboard Mitra -->
                        <!-- Nama Pengangkut -->
                        <div class="col-xl-8">
                            <div class="panel panel-inverse">
                                <!-- begin panel-heading -->
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="far fa-chart-bar"></i> Pengangkut
                                        <?= $resultSetting['company']  ?></h4>
                                    <?php include "include/panel-row.php"; ?>
                                </div>
                                <div class="panel-body">
                                    <div id="chart_pengangkut_bar"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End Nama Pengangkut -->
                        <!-- Valuta -->
                        <div class="col-xl-4">
                            <div class="panel panel-inverse">
                                <!-- begin panel-heading -->
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fas fa-chart-pie"></i> Valuta
                                        <?= $resultSetting['company']  ?></h4>
                                    <?php include "include/panel-row.php"; ?>
                                </div>
                                <div class="panel-body">
                                    <div id="chart_valuta_pie"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End Valuta -->
                        <!-- Kantor Tujuan -->
                        <div class="col-xl-4">
                            <div class="panel panel-inverse">
                                <!-- begin panel-heading -->
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="far fa-chart-bar"></i> Kantor Tujuan
                                        <?= $resultSetting['company']  ?></h4>
                                    <?php include "include/panel-row.php"; ?>
                                </div>
                                <div class="panel-body">
                                    <div id="chart_kantor_tujuan_pie"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End Kantor Tujuan -->
                        <!-- Jumlah Netto Per Tahun Aju -->
                        <div class="col-xl-4">
                            <div class="panel panel-inverse">
                                <!-- begin panel-heading -->
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="far fa-chart-bar"></i> Jumlah Netto Per Tahun Aju
                                        <?= $resultSetting['company']  ?></h4>
                                    <?php include "include/panel-row.php"; ?>
                                </div>
                                <div class="panel-body">
                                    <div id="chart_netto_line"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Jumlah Netto Per Tahun Aju -->
                    <!-- </div> -->
                    <!-- End Line 1 -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Tab -->
    <?php include "include/creator.php"; ?>
</div>
<?php
include "include/footer.php";
include "include/jsDatatables.php";
?>
<script src="assets/highcharts/highcharts.js"></script>
<script src="assets/highcharts/modules/exporting.js"></script>
<script src="assets/highcharts/modules/export-data.js"></script>
<script src="assets/highcharts/modules/accessibility.js"></script>
<script type="text/javascript">
// UPDATE PASSWORD SUCCESS
if (window?.location?.href?.indexOf('SUpdatePasswordSuccessCC') > -1) {
    Swal.fire({
        title: 'Password berhasil diupdate!',
        icon: 'success',
        text: 'Password berhasil diupdate didalam <?= $alertAppName ?>!'
    })
    history.replaceState({}, '', './index.php');
}

// REALTIME DATA LOAD
// Pengguna Aktifitas Sistem
function RealTimePenggunaAktifitasSistem() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("table_aktifitas_sistem").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "realtime/index_aktifitas_sistem.php", true);
    xhttp.send();
}
setInterval(function() {
    RealTimePenggunaAktifitasSistem();
    // Time
}, 1000);
window.onload = RealTimePenggunaAktifitasSistem;

// Pengguna Sedang Aktif
function RealTimePenggunaSedangAktif() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("table_pengguna_sedang_aktif").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "realtime/index_pengguna_sedang_aktif.php", true);
    xhttp.send();
}
setInterval(function() {
    RealTimePenggunaSedangAktif();
    // Time
}, 1000);
window.onload = RealTimePenggunaSedangAktif;

// Pengguna All
function RealTimePenggunaAll() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("data-pengguna-all").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "realtime/index_pengguna_all.php", true);
    xhttp.send();
}
setInterval(function() {
    RealTimePenggunaAll();
    // Time
}, 1000);
window.onload = RealTimePenggunaAll;
// END REALTIME DATA LOAD
</script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script type="text/javascript">
// Chart Pie Total Data Mitra
Highcharts.chart('chart_mitra_pie', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<b><?= $ResultDashboarddataMitraCount['dashboard_total_mitra']; ?> Total</b> Data Mitra TPBERP <?= $resultSetting['company']  ?>'
    },
    subtitle: {
        text: 'Update: <?= date_indo(date('Y-m-d')); ?>'
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
// Nama Pengangkut
Highcharts.chart('chart_pengangkut_bar', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Nama Pengangkut berdasarkan Jumlah Angkutan'
    },
    subtitle: {
        text: 'Update: <?= date_indo(date('Y-m-d')); ?>'
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Angkutan'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Jumlah: <b>{point.y:,.0f} Angkutan</b>'
    },
    series: [{
        name: 'Nama Angkutan',
        data: [
            <?php
                $DataChartPengangkutPie = $dbcon->query("SELECT NAMA_PENGANGKUT,COUNT(NAMA_PENGANGKUT) AS total_pengangkut FROM tpb_header GROUP BY NAMA_PENGANGKUT");
                while ($rowDataChartPengangkutPie = mysqli_fetch_array($DataChartPengangkutPie)) {
                    $NamaKodePengangkut = $rowDataChartPengangkutPie['NAMA_PENGANGKUT'];
                ?>
            // IF Nama Pengangkut NULL
            <?php if ($NamaKodePengangkut == NULL) {
                        $DNamaKodePengangkut = 'Data NULL';
                    } else if ($NamaKodePengangkut == '') {
                        $DNamaKodePengangkut = 'Tidak Diketahui';
                    } else {
                        $DNamaKodePengangkut = $NamaKodePengangkut;
                    }
                    ?>
            // End IF Nama Pengangkut NULL
            ['<?= $DNamaKodePengangkut ?>', <?= $rowDataChartPengangkutPie['total_pengangkut']; ?>],
            <?php } ?>
        ],
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:,.0f} Angkutan',
            y: 10,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
// Valuta from tpb_header
Highcharts.chart('chart_valuta_pie', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'bar'
    },
    title: {
        text: 'Jumlah Valuta'
    },
    subtitle: {
        text: 'Update: <?= date_indo(date('Y-m-d')); ?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y:,.0f}</b>'
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
        name: 'Total Valuta',
        colorByPoint: true,
        data: [
            <?php
                $DataChartValutaPie = $dbcon->query("SELECT KODE_VALUTA, COUNT(KODE_VALUTA) AS total_per_valuta FROM tpb_header GROUP BY KODE_VALUTA");
                while ($rowDataChartValutaPie = mysqli_fetch_array($DataChartValutaPie)) {
                    $NamaKodeValuta = $rowDataChartValutaPie['KODE_VALUTA'];
                ?> {
                // IF Valuta NULL 
                <?php if ($NamaKodeValuta == NULL) {
                            $DNamaKodeValuta = 'Data NULL';
                        } else if ($NamaKodeValuta == '') {
                            $DNamaKodeValuta = 'Tidak Diketahui';
                        } else {
                            $DNamaKodeValuta = $NamaKodeValuta;
                        }
                        ?>
                // End IF Valuta NULL 
                name: '<?= $DNamaKodeValuta; ?>',
                    y: <?= $rowDataChartValutaPie['total_per_valuta']; ?>
            },
            <?php } ?>
        ]
    }]
});
// KODE KANTOR TUJUAN
Highcharts.chart('chart_kantor_tujuan_pie', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'line'
    },
    title: {
        text: 'Jumlah Kantor Tujuan'
    },
    subtitle: {
        text: 'Update: <?= date_indo(date('Y-m-d')); ?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y:,.0f}</b>'
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
        name: 'Total Kantor Tujuan',
        colorByPoint: true,
        data: [
            <?php
                $DataChartkantorPie = $dbcon->query("SELECT a.KODE_KANTOR_TUJUAN,b.URAIAN_KANTOR,COUNT(a.KODE_KANTOR_TUJUAN) AS total_per_kantor,a.KODE_JENIS_TPB,c.URAIAN_JENIS_TPB
                                                FROM tpb_header AS a 
                                                LEFT OUTER JOIN referensi_kantor_pabean AS b ON a.KODE_KANTOR_TUJUAN=b.KODE_KANTOR
                                                LEFT OUTER JOIN referensi_jenis_tpb AS c ON a.KODE_JENIS_TPB=c.KODE_JENIS_TPB
                                                GROUP BY a.KODE_KANTOR_TUJUAN");
                while ($rowDataChartkantorPie = mysqli_fetch_array($DataChartkantorPie)) {
                    $NamaKodekantor = $rowDataChartkantorPie['URAIAN_KANTOR'];
                ?> {
                // IF kantor NULL 
                <?php if ($NamaKodekantor == NULL) {
                            $DNamaKodekantor = 'Data NULL';
                        } else if ($NamaKodekantor == '') {
                            $DNamaKodekantor = 'Tidak Diketahui';
                        } else {
                            $DNamaKodekantor = $NamaKodekantor;
                        }
                        ?>
                // End IF kantor NULL 
                name: '<?= $DNamaKodekantor; ?>',
                    y: <?= $rowDataChartkantorPie['total_per_kantor']; ?>
            },
            <?php } ?>
        ]
    }]
});
// Netto Per Tahun AJU
Highcharts.chart('chart_netto_line', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'bar'
    },
    title: {
        text: 'Jumlah Netto Per Tahun AJU'
    },
    subtitle: {
        text: 'Update: <?= date_indo(date('Y-m-d')); ?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y:,.0f}</b>'
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
                enabled: true
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Total Netto',
        colorByPoint: true,
        data: [
            <?php
                $DataChartNettoPie = $dbcon->query("SELECT a.ID_PENERIMA_BARANG,b.NAMA,SUM(a.NETTO) AS total_netto,LEFT(a.TANGGAL_AJU,4) AS tahun_aju FROM tpb_header AS a 
												LEFT OUTER JOIN referensi_pengusaha AS b ON a.ID_PENERIMA_BARANG=b.NPWP
												GROUP BY tahun_aju");
                while ($rowDataChartNettoPie = mysqli_fetch_array($DataChartNettoPie)) {
                    $NamaKodeNetto = $rowDataChartNettoPie['NAMA'];
                ?> {
                // IF Netto NULL 
                <?php if ($NamaKodeNetto == NULL) {
                            $DNamaKodeNetto = 'Data NULL';
                        } else if ($NamaKodeNetto == '') {
                            $DNamaKodeNetto = 'Tidak Diketahui';
                        } else {
                            $DNamaKodeNetto = $NamaKodeNetto;
                        }
                        ?>
                // End IF Netto NULL 
                name: '<?= $DNamaKodeNetto; ?>',
                    y: <?= $rowDataChartNettoPie['total_netto']; ?>
            },
            <?php } ?>
        ]
    }]
});
</script>
<!-- ================== END PAGE LEVEL JS ================== -->