<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
// include "include/top-sidebar.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
// PLB
// TOTAL BC PLB
$dataBCPLB = $dbcon->query("SELECT COUNT(*) AS total_bc_plb FROM plb_header");
$resultBCPLB = mysqli_fetch_array($dataBCPLB);
if ($resultBCPLB['total_bc_plb'] == NULL) {
    $resultBCPLB_show = 0;
} else {
    $resultBCPLB_show = $resultBCPLB['total_bc_plb'];
}
// BC 23
$dataBCPLB23 = $dbcon->query("SELECT COUNT(*) AS total_bc_23 FROM plb_header WHERE KODE_DOKUMEN_PABEAN='23'");
$resultBCPLB23 = mysqli_fetch_array($dataBCPLB23);
if ($resultBCPLB23 == NULL) {
    $resultBCPLB23_show = 0;
} else {
    $resultBCPLB23_show = $resultBCPLB23['total_bc_23'];
}
// BC 25
$dataBCPLB25 = $dbcon->query("SELECT COUNT(*) AS total_bc_25 FROM plb_header WHERE KODE_DOKUMEN_PABEAN='25'");
$resultBCPLB25 = mysqli_fetch_array($dataBCPLB25);
if ($resultBCPLB25 == NULL) {
    $resultBCPLB25_show = 0;
} else {
    $resultBCPLB25_show = $resultBCPLB25['total_bc_25'];
}
// BC 261
$dataBCPLB261 = $dbcon->query("SELECT COUNT(*) AS total_bc_261 FROM plb_header WHERE KODE_DOKUMEN_PABEAN='261'");
$resultBCPLB261 = mysqli_fetch_array($dataBCPLB261);
if ($resultBCPLB261 == NULL) {
    $resultBCPLB261_show = 0;
} else {
    $resultBCPLB261_show = $resultBCPLB261['total_bc_261'];
}
// BC 27
$dataBCPLB27 = $dbcon->query("SELECT COUNT(*) AS total_bc_27 FROM plb_header WHERE KODE_DOKUMEN_PABEAN='27'");
$resultBCPLB27 = mysqli_fetch_array($dataBCPLB27);
if ($resultBCPLB27 == NULL) {
    $resultBCPLB27_show = 0;
} else {
    $resultBCPLB27_show = $resultBCPLB27['total_bc_27'];
}
// BC 40
$dataBCPLB40 = $dbcon->query("SELECT COUNT(*) AS total_bc_40 FROM plb_header WHERE KODE_DOKUMEN_PABEAN='40'");
$resultBCPLB40 = mysqli_fetch_array($dataBCPLB40);
if ($resultBCPLB40 == NULL) {
    $resultBCPLB40_show = 0;
} else {
    $resultBCPLB40_show = $resultBCPLB40['total_bc_40'];
}
// BC 41
$dataBCPLB41 = $dbcon->query("SELECT COUNT(*) AS total_bc_41 FROM plb_header WHERE KODE_DOKUMEN_PABEAN='41'");
$resultBCPLB41 = mysqli_fetch_array($dataBCPLB41);
if ($resultBCPLB41 == NULL) {
    $resultBCPLB41_show = 0;
} else {
    $resultBCPLB41_show = $resultBCPLB41['total_bc_41'];
}

// GB
// TOTAL BC GB
$dataBCGB = $dbcon->query("SELECT COUNT(*) AS total_bc_gb FROM tpb_header");
$resultBCGB = mysqli_fetch_array($dataBCGB);
if ($resultBCGB == NULL) {
    $resultBCGB_show = 0;
} else {
    $resultBCGB_show = $resultBCGB['total_bc_gb'];
}
// BC 23
$dataBCGB23 = $dbcon->query("SELECT COUNT(*) AS total_bc_23 FROM tpb_header WHERE KODE_DOKUMEN_PABEAN='23'");
$resultBCGB23 = mysqli_fetch_array($dataBCGB23);
if ($resultBCGB23 == NULL) {
    $resultBCGB23_show = 0;
} else {
    $resultBCGB23_show = $resultBCGB23['total_bc_23'];
}
// BC 25
$dataBCGB25 = $dbcon->query("SELECT COUNT(*) AS total_bc_25 FROM tpb_header WHERE KODE_DOKUMEN_PABEAN='25'");
$resultBCGB25 = mysqli_fetch_array($dataBCGB25);
if ($resultBCGB25 == NULL) {
    $resultBCGB25_show = 0;
} else {
    $resultBCGB25_show = $resultBCGB25['total_bc_25'];
}
// BC 261
$dataBCGB261 = $dbcon->query("SELECT COUNT(*) AS total_bc_261 FROM tpb_header WHERE KODE_DOKUMEN_PABEAN='261'");
$resultBCGB261 = mysqli_fetch_array($dataBCGB261);
if ($resultBCGB261 == NULL) {
    $resultBCGB261_show = 0;
} else {
    $resultBCGB261_show = $resultBCGB261['total_bc_261'];
}
// BC 27
$dataBCGB27 = $dbcon->query("SELECT COUNT(*) AS total_bc_27 FROM tpb_header WHERE KODE_DOKUMEN_PABEAN='27'");
$resultBCGB27 = mysqli_fetch_array($dataBCGB27);
if ($resultBCGB27 == NULL) {
    $resultBCGB27_show = 0;
} else {
    $resultBCGB27_show = $resultBCGB27['total_bc_27'];
}
// BC 40
$dataBCGB40 = $dbcon->query("SELECT COUNT(*) AS total_bc_40 FROM tpb_header WHERE KODE_DOKUMEN_PABEAN='40'");
$resultBCGB40 = mysqli_fetch_array($dataBCGB40);
if ($resultBCGB40 == NULL) {
    $resultBCGB40_show = 0;
} else {
    $resultBCGB40_show = $resultBCGB40['total_bc_40'];
}
// BC 41
$dataBCGB41 = $dbcon->query("SELECT COUNT(*) AS total_bc_41 FROM tpb_header WHERE KODE_DOKUMEN_PABEAN='41'");
$resultBCGB41 = mysqli_fetch_array($dataBCGB41);
if ($resultBCGB41 == NULL) {
    $resultBCGB41_show = 0;
} else {
    $resultBCGB41_show = $resultBCGB41['total_bc_41'];
}
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Data Online App Name | Company </title>
<?php } else { ?>
    <title>Data Online - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-globe icon-page"></i>
                <font class="text-page">Data Online</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Perusahaan: <?= $resultSetting['company']  ?></li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;">
                        <?= date('h:m:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <div class="row" style="display: flex;justify-content: center;align-content: center;align-items: center;">
        <div class="col-xl-6">
            <div class="card border-0 bg-dark text-white mb-3 overflow-hidden">
                <div class="card-body" style="padding: 28px;">
                    <div class="row">
                        <div class="col-xl-7 col-lg-8">
                            <div class="mb-3 text-grey">
                                <b>Barang IT Inventory</b>
                                <span class="ml-2">
                                    <i class="fa fa-info-circle" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Barang IT Inventory"></i>
                                </span>
                            </div>
                            <div class="d-flex mb-1">
                                <h2 class="mb-0" id="R_totalHP_awal"></h2>
                                <div class="ml-auto mt-n1 mb-n1">
                                    <div id="total-sales-sparkline"></div>
                                </div>
                            </div>
                            <div class="mb-3 text-grey">
                                <i class="fa fa-caret-up"></i> <span data-animation="number" data-value="33.21">0.00</span>% compare to last week
                            </div>
                            <hr class="bg-white-transparent-2" />
                            <div class="row text-truncate">
                                <div class="col-6">
                                    <div class="f-s-12 text-grey">Total sales order</div>
                                    <div class="f-s-18 m-b-5 f-w-600 p-b-1" data-animation="number" data-value="1568">0</div>
                                    <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                        <div class="progress-bar progress-bar-striped rounded-right bg-teal" data-animation="width" data-value="55%" style="width: 0%"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="f-s-12 text-grey">Avg. sales per order</div>
                                    <div class="f-s-18 m-b-5 f-w-600 p-b-1">$<span data-animation="number" data-value="41.20">0.00</span></div>
                                    <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                        <div class="progress-bar progress-bar-striped rounded-right" data-animation="width" data-value="55%" style="width: 0%"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="f-s-12 text-grey">Total sales order</div>
                                    <div class="f-s-18 m-b-5 f-w-600 p-b-1" data-animation="number" data-value="1568">0</div>
                                    <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                        <div class="progress-bar progress-bar-striped rounded-right bg-teal" data-animation="width" data-value="55%" style="width: 0%"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="f-s-12 text-grey">Avg. sales per order</div>
                                    <div class="f-s-18 m-b-5 f-w-600 p-b-1">$<span data-animation="number" data-value="41.20">0.00</span></div>
                                    <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                        <div class="progress-bar progress-bar-striped rounded-right" data-animation="width" data-value="55%" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-4 align-items-center d-flex justify-content-center">
                            <img src="../assets/img/svg/img-1.svg" height="150px" class="d-none d-lg-block" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card border-0 bg-dark text-white text-truncate mb-3">
                        <div class="card-body">
                            <div class="mb-3 text-grey">
                                <b class="mb-3">DOKUMEN PABEAN PLB</b>
                                <span class="ml-2"><i class="fa fa-info-circle" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Dokumen Pabean PLB"></i></span>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="text-white mb-0"><span data-animation="number" data-value="<?= $resultBCPLB_show; ?>"></span> AJU</h2>
                                <div class="ml-auto">
                                    <div id="conversion-rate-sparkline"></div>
                                </div>
                            </div>
                            <div class="mb-4 text-grey">
                                <i class="fa fa-calendar"></i> <?= date_indo(date('Y-m-d'), TRUE) ?>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                    BC 2.3
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCPLB23_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                    BC 2.5
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCPLB25_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                    BC 2.6.1
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCPLB261_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                    BC 2.7
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCPLB27_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                    BC 4.0
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCPLB40_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                    BC 4.1
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCPLB41_show; ?>"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card border-0 bg-dark text-white text-truncate mb-3">
                        <div class="card-body">
                            <div class="mb-3 text-grey">
                                <b class="mb-3">DOKUMEN PABEAN GB</b>
                                <span class="ml-2"><i class="fa fa-info-circle" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Dokumen Pabean GB"></i></span>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="text-white mb-0"><span data-animation="number" data-value="<?= $resultBCGB_show; ?>"></span> AJU</h2>
                                <div class="ml-auto">
                                    <div id="store-session-sparkline"></div>
                                </div>
                            </div>
                            <div class="mb-4 text-grey">
                                <i class="fa fa-calendar"></i> <?= date_indo(date('Y-m-d'), TRUE) ?>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-teal f-s-8 mr-2"></i>
                                    BC 2.3
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCGB23_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-blue f-s-8 mr-2"></i>
                                    BC 2.5
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCGB25_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-teal f-s-8 mr-2"></i>
                                    BC 2.6.1
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCGB261_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-blue f-s-8 mr-2"></i>
                                    BC 2.7
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCGB27_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-teal f-s-8 mr-2"></i>
                                    BC 4.0
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCGB40_show; ?>"></span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-blue f-s-8 mr-2"></i>
                                    BC 4.1
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"> <span data-animation="number" data-value=""></span>Data Pengajuan <i class="fa fa-caret-right"></i></div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultBCGB41_show; ?>"></span></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php
include "include/pusat_bantuan.php";
include "include/riwayat_aktifitas.php";
include "include/panel.php";
include "include/footer.php";
include "include/jsDatatables.php";
?>

<script>
    // HP Awal
    function Page_totalHP_awal() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("R_totalHP_awal").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "realtime/viewdataonline.php?function=totalHP_awal", true);
        xhttp.send();
    }
    setInterval(function() {
        Page_totalHP_awal();
    }, 1000);
    window.onload = Page_totalHP_awal;

    // HP Akhir
    function Page_totalHP_akhir() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("R_totalHP_akhir").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "realtime/viewdataonline.php?function=totalHP_akhir", true);
        xhttp.send();
    }
    setInterval(function() {
        Page_totalHP_akhir();
    }, 1000);
    window.onload = Page_totalHP_akhir;
</script>