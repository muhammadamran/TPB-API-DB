<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
// include "include/top-sidebar.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
// API - 
include "include/api.php";
// PLB
$contentPLB = get_content($resultAPI['url_api'] . 'viewDODashboard.php?function=get_PLB');
$dataPLB = json_decode($contentPLB, true);
// BC
$contentBC = get_content($resultAPI['url_api'] . 'viewDODashboard.php?function=get_bcTPB');
$dataBC = json_decode($contentBC, true);
// BC 2.3
$contentBC_23 = get_content($resultAPI['url_api'] . 'viewDODashboard.php?function=get_bc23');
$dataBC_23 = json_decode($contentBC_23, true);
// BC 2.5
$contentBC_25 = get_content($resultAPI['url_api'] . 'viewDODashboard.php?function=get_bc25');
$dataBC_25 = json_decode($contentBC_25, true);
// BC 2.6.1
$contentBC_261 = get_content($resultAPI['url_api'] . 'viewDODashboard.php?function=get_bc261');
$dataBC_261 = json_decode($contentBC_261, true);
// BC 2.7
$contentBC_27 = get_content($resultAPI['url_api'] . 'viewDODashboard.php?function=get_bc27');
$dataBC_27 = json_decode($contentBC_27, true);
// BC 4.0
$contentBC_40 = get_content($resultAPI['url_api'] . 'viewDODashboard.php?function=get_bc40');
$dataBC_40 = json_decode($contentBC_40, true);
// BC 4.1
$contentBC_41 = get_content($resultAPI['url_api'] . 'viewDODashboard.php?function=get_bc41');
$dataBC_41 = json_decode($contentBC_41, true);
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

    <!-- begin row -->
    <div class="row" style="display: flex;justify-content: center;align-content: center;align-items: center;">
        <!-- begin col-6 -->
        <div class="col-xl-6">
            <!-- begin card -->
            <div class="card border-0 bg-dark text-white mb-3 overflow-hidden">
                <!-- begin card-body -->
                <div class="card-body" style="padding: 58px;">
                    <!-- begin row -->
                    <div class="row">
                        <!-- begin col-7 -->
                        <div class="col-xl-7 col-lg-8">
                            <!-- begin title -->
                            <div class="mb-3 text-grey">
                                <b>TOTAL SALES</b>
                                <span class="ml-2">
                                    <i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Total sales" data-placement="top" data-content="Net sales (gross sales minus discounts and returns) plus taxes and shipping. Includes orders from all sales channels."></i>
                                </span>
                            </div>
                            <!-- end title -->
                            <!-- begin total-sales -->
                            <div class="d-flex mb-1">
                                <h2 class="mb-0">$<span data-animation="number" data-value="64559.25">0.00</span></h2>
                                <div class="ml-auto mt-n1 mb-n1">
                                    <div id="total-sales-sparkline"></div>
                                </div>
                            </div>
                            <!-- end total-sales -->
                            <!-- begin percentage -->
                            <div class="mb-3 text-grey">
                                <i class="fa fa-caret-up"></i> <span data-animation="number" data-value="33.21">0.00</span>% compare to last week
                            </div>
                            <!-- end percentage -->
                            <hr class="bg-white-transparent-2" />
                            <!-- begin row -->
                            <div class="row text-truncate">
                                <!-- begin col-6 -->
                                <div class="col-6">
                                    <div class="f-s-12 text-grey">Total sales order</div>
                                    <div class="f-s-18 m-b-5 f-w-600 p-b-1" data-animation="number" data-value="1568">0</div>
                                    <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                        <div class="progress-bar progress-bar-striped rounded-right bg-teal" data-animation="width" data-value="55%" style="width: 0%"></div>
                                    </div>
                                </div>
                                <!-- end col-6 -->
                                <!-- begin col-6 -->
                                <div class="col-6">
                                    <div class="f-s-12 text-grey">Avg. sales per order</div>
                                    <div class="f-s-18 m-b-5 f-w-600 p-b-1">$<span data-animation="number" data-value="41.20">0.00</span></div>
                                    <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                        <div class="progress-bar progress-bar-striped rounded-right" data-animation="width" data-value="55%" style="width: 0%"></div>
                                    </div>
                                </div>
                                <!-- end col-6 -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end col-7 -->
                        <!-- begin col-5 -->
                        <div class="col-xl-5 col-lg-4 align-items-center d-flex justify-content-center">
                            <img src="../assets/img/svg/img-1.svg" height="150px" class="d-none d-lg-block" />
                        </div>
                        <!-- end col-5 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-6 -->
        <!-- begin col-6 -->
        <div class="col-xl-6">
            <!-- begin row -->
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-sm-6">
                    <!-- begin card -->
                    <div class="card border-0 bg-dark text-white text-truncate mb-3">
                        <!-- begin card-body -->
                        <div class="card-body">
                            <!-- begin title -->
                            <div class="mb-3 text-grey">
                                <b class="mb-3">CONVERSION RATE</b>
                                <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Conversion Rate" data-placement="top" data-content="Percentage of sessions that resulted in orders from total number of sessions." data-original-title="" title=""></i></span>
                            </div>
                            <!-- end title -->
                            <!-- begin conversion-rate -->
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="text-white mb-0"><span data-animation="number" data-value="2.19">0.00</span>%</h2>
                                <div class="ml-auto">
                                    <div id="conversion-rate-sparkline"></div>
                                </div>
                            </div>
                            <!-- end conversion-rate -->
                            <!-- begin percentage -->
                            <div class="mb-4 text-grey">
                                <i class="fa fa-caret-down"></i> <span data-animation="number" data-value="0.50">0.00</span>% compare to last week
                            </div>
                            <!-- end percentage -->

                            <!-- begin info-row -->
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                    Added to cart
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="262">0</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="3.79">0.00</span>%</div>
                                </div>
                            </div>
                            <!-- end info-row -->
                            <!-- begin info-row -->
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                    Reached checkout
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="11">0</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="3.85">0.00</span>%</div>
                                </div>
                            </div>
                            <!-- end info-row -->

                            <!-- begin info-row -->
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                    Added to cart
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="262">0</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="3.79">0.00</span>%</div>
                                </div>
                            </div>
                            <!-- end info-row -->
                            <!-- begin info-row -->
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                    Reached checkout
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="11">0</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="3.85">0.00</span>%</div>
                                </div>
                            </div>
                            <!-- end info-row -->

                            <!-- begin info-row -->
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                    Added to cart
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="262">0</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="3.79">0.00</span>%</div>
                                </div>
                            </div>
                            <!-- end info-row -->
                            <!-- begin info-row -->
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                    Reached checkout
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="11">0</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="3.85">0.00</span>%</div>
                                </div>
                            </div>
                            <!-- end info-row -->



                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col-6 -->
                <!-- begin col-6 -->
                <div class="col-sm-6">
                    <!-- begin card -->
                    <div class="card border-0 bg-dark text-white text-truncate mb-3">
                        <!-- begin card-body -->
                        <div class="card-body">
                            <!-- begin title -->
                            <div class="mb-3 text-grey">
                                <b class="mb-3">STORE SESSIONS</b>
                                <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Store Sessions" data-placement="top" data-content="Number of sessions on your online store. A session is a period of continuous activity from a visitor." data-original-title="" title=""></i></span>
                            </div>
                            <!-- end title -->
                            <!-- begin store-session -->
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="text-white mb-0"><span data-animation="number" data-value="70719">0</span></h2>
                                <div class="ml-auto">
                                    <div id="store-session-sparkline"></div>
                                </div>
                            </div>
                            <!-- end store-session -->
                            <!-- begin percentage -->
                            <div class="mb-4 text-grey">
                                <i class="fa fa-caret-up"></i> <span data-animation="number" data-value="9.5">0.00</span>% compare to last week
                            </div>
                            <!-- end percentage -->

                            <!-- begin info-row -->
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-teal f-s-8 mr-2"></i>
                                    Mobile
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="25.7">0.00</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="53210">0</span></div>
                                </div>
                            </div>
                            <!-- end info-row -->
                            <!-- begin info-row -->
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-blue f-s-8 mr-2"></i>
                                    Desktop
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="16.0">0.00</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="11959">0</span></div>
                                </div>
                            </div>
                            <!-- end info-row -->

                            <!-- begin info-row -->
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-teal f-s-8 mr-2"></i>
                                    Mobile
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="25.7">0.00</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="53210">0</span></div>
                                </div>
                            </div>
                            <!-- end info-row -->
                            <!-- begin info-row -->
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-blue f-s-8 mr-2"></i>
                                    Desktop
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="16.0">0.00</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="11959">0</span></div>
                                </div>
                            </div>
                            <!-- end info-row -->

                            <!-- begin info-row -->
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-teal f-s-8 mr-2"></i>
                                    Mobile
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="25.7">0.00</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="53210">0</span></div>
                                </div>
                            </div>
                            <!-- end info-row -->
                            <!-- begin info-row -->
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-blue f-s-8 mr-2"></i>
                                    Desktop
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="16.0">0.00</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="11959">0</span></div>
                                </div>
                            </div>
                            <!-- end info-row -->

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col-6 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-md-12">
            <div class="row" style="display: flex;justify-content: center;align-items: center;background: #fff;border-radius: 5px;margin-left: 0px;margin-right: 0px;padding: 15px 0px 0px 0px;">
                <div class="col-md-3">
                    <!-- <div class="row-dinding"> -->
                    <div class="svg-img-center">
                        <img src="assets/img/svg/data-extraction-animate.svg" class="images-svg">
                    </div>
                    <!-- </div> -->
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <!-- BC 2.3 -->
                        <div class="col-xl-4 col-md-6">
                            <div class="widget widget-stats bg-bc">
                                <div class="stats-icon stats-icon-lg"><i class="fa fa-clipboard fa-fw"></i></div>
                                <div class="stats-content">
                                    <div class="stats-title">Total Data BC 2.3</div>
                                    <?php if ($dataBC_23['status'] == 404) { ?>
                                        <div class="stats-number">- AJU</div>
                                        <div class="stats-progress progress">
                                            <div class="progress-bar" style="width: 100%;"></div>
                                        </div>
                                        <div class="stats-desc">AJU Terakhir: -</div>
                                    <?php } else { ?>
                                        <?php foreach ($dataBC_23['result'] as $row) { ?>
                                            <div class="stats-number"><?= $row['total_bc23']; ?> AJU</div>
                                            <div class="stats-progress progress">
                                                <div class="progress-bar" style="width: 100%;"></div>
                                            </div>
                                            <div class="stats-desc">AJU Terakhir: <?= $row['NOMOR_AJU']; ?></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- End BC 2.3 -->
                        <!-- BC 2.5 -->
                        <div class="col-xl-4 col-md-6">
                            <div class="widget widget-stats bg-bc">
                                <div class="stats-icon stats-icon-lg"><i class="fa fa-clipboard fa-fw"></i></div>
                                <div class="stats-content">
                                    <div class="stats-title">Total Data BC 2.5</div>
                                    <?php if ($dataBC_25['status'] == 404) { ?>
                                        <div class="stats-number">- AJU</div>
                                        <div class="stats-progress progress">
                                            <div class="progress-bar" style="width: 100%;"></div>
                                        </div>
                                        <div class="stats-desc">AJU Terakhir: -</div>
                                    <?php } else { ?>
                                        <?php foreach ($dataBC_25['result'] as $row) { ?>
                                            <div class="stats-number"><?= $row['total_bc25']; ?> AJU</div>
                                            <div class="stats-progress progress">
                                                <div class="progress-bar" style="width: 100%;"></div>
                                            </div>
                                            <div class="stats-desc">AJU Terakhir: <?= $row['NOMOR_AJU']; ?></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- End BC 2.5 -->
                        <!-- BC 2.6.1 -->
                        <div class="col-xl-4 col-md-6">
                            <div class="widget widget-stats bg-bc">
                                <div class="stats-icon stats-icon-lg"><i class="fa fa-clipboard fa-fw"></i></div>
                                <div class="stats-content">
                                    <div class="stats-title">Total Data BC 2.6.1</div>
                                    <?php if ($dataBC_261['status'] == 404) { ?>
                                        <div class="stats-number">- AJU</div>
                                        <div class="stats-progress progress">
                                            <div class="progress-bar" style="width: 100%;"></div>
                                        </div>
                                        <div class="stats-desc">AJU Terakhir: -</div>
                                    <?php } else { ?>
                                        <?php foreach ($dataBC_261['result'] as $row) { ?>
                                            <div class="stats-number"><?= $row['total_bc261']; ?> AJU</div>
                                            <div class="stats-progress progress">
                                                <div class="progress-bar" style="width: 100%;"></div>
                                            </div>
                                            <div class="stats-desc">AJU Terakhir: <?= $row['NOMOR_AJU']; ?></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- End BC 2.6.1 -->
                        <!-- BC 2.7 -->
                        <div class="col-xl-4 col-md-6">
                            <div class="widget widget-stats bg-bc">
                                <div class="stats-icon stats-icon-lg"><i class="fa fa-clipboard fa-fw"></i></div>
                                <div class="stats-content">
                                    <div class="stats-title">Total Data BC 2.7</div>
                                    <?php if ($dataBC_27['status'] == 404) { ?>
                                        <div class="stats-number">- AJU</div>
                                        <div class="stats-progress progress">
                                            <div class="progress-bar" style="width: 100%;"></div>
                                        </div>
                                        <div class="stats-desc">AJU Terakhir: -</div>
                                    <?php } else { ?>
                                        <?php foreach ($dataBC_27['result'] as $row) { ?>
                                            <div class="stats-number"><?= $row['total_bc27']; ?> AJU</div>
                                            <div class="stats-progress progress">
                                                <div class="progress-bar" style="width: 100%;"></div>
                                            </div>
                                            <div class="stats-desc">AJU Terakhir: <?= $row['NOMOR_AJU']; ?></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- End BC 2.7 -->
                        <!-- BC 4.0 -->
                        <div class="col-xl-4 col-md-6">
                            <div class="widget widget-stats bg-bc">
                                <div class="stats-icon stats-icon-lg"><i class="fa fa-clipboard fa-fw"></i></div>
                                <div class="stats-content">
                                    <div class="stats-title">Total Data BC 4.0</div>
                                    <?php if ($dataBC_40['status'] == 404) { ?>
                                        <div class="stats-number">- AJU</div>
                                        <div class="stats-progress progress">
                                            <div class="progress-bar" style="width: 100%;"></div>
                                        </div>
                                        <div class="stats-desc">AJU Terakhir: -</div>
                                    <?php } else { ?>
                                        <?php foreach ($dataBC_40['result'] as $row) { ?>
                                            <div class="stats-number"><?= $row['total_bc40']; ?> AJU</div>
                                            <div class="stats-progress progress">
                                                <div class="progress-bar" style="width: 100%;"></div>
                                            </div>
                                            <div class="stats-desc">AJU Terakhir: <?= $row['NOMOR_AJU']; ?></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- End BC 4.0 -->
                        <!-- BC 4.1 -->
                        <div class="col-xl-4 col-md-6">
                            <div class="widget widget-stats bg-bc">
                                <div class="stats-icon stats-icon-lg"><i class="fa fa-clipboard fa-fw"></i></div>
                                <div class="stats-content">
                                    <div class="stats-title">Total Data BC 4.1</div>
                                    <?php if ($dataBC_41['status'] == 404) { ?>
                                        <div class="stats-number">- AJU</div>
                                        <div class="stats-progress progress">
                                            <div class="progress-bar" style="width: 100%;"></div>
                                        </div>
                                        <div class="stats-desc">AJU Terakhir: -</div>
                                    <?php } else { ?>
                                        <?php foreach ($dataBC_41['result'] as $row) { ?>
                                            <div class="stats-number"><?= $row['total_bc41']; ?> AJU</div>
                                            <div class="stats-progress progress">
                                                <div class="progress-bar" style="width: 100%;"></div>
                                            </div>
                                            <div class="stats-desc">AJU Terakhir: <?= $row['NOMOR_AJU']; ?></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- End BC 4.1 -->
                        <!-- PLB -->
                        <div class="col-xl-6 col-md-6">
                            <div class="widget widget-stats bg-plb">
                                <div class="stats-icon stats-icon-lg"><i class="fa fa-circle-down fa-fw"></i></div>
                                <div class="stats-content">
                                    <div class="stats-title">Total Data PLB</div>
                                    <?php
                                    $query = $dbcon->query("SELECT NOMOR_AJU,KODE_DOKUMEN_PABEAN,
                                             (SELECT COUNT(*) AS total_bc FROM plb_header WHERE KODE_DOKUMEN_PABEAN IS NOT NULL) AS total_bc
                                              FROM plb_header
                                              WHERE KODE_DOKUMEN_PABEAN IS NOT NULL
                                              ORDER BY ID DESC LIMIT 1");
                                    $resultPLB = mysqli_fetch_array($query);
                                    ?>
                                    <?php if ($resultPLB['NOMOR_AJU'] == NULL) { ?>
                                        <div class="stats-number">- AJU</div>
                                        <div class="stats-progress progress">
                                            <div class="progress-bar" style="width: 100%;"></div>
                                        </div>
                                        <div class="stats-desc">AJU Terakhir: - <br> BC: -</div>
                                    <?php } else { ?>
                                        <div class="stats-number"><?= $resultPLB['total_bc']; ?> AJU</div>
                                        <div class="stats-progress progress">
                                            <div class="progress-bar" style="width: 100%;"></div>
                                        </div>
                                        <div class="stats-desc">AJU Terakhir: <?= $resultPLB['NOMOR_AJU']; ?> <br> BC:
                                            <?= $resultPLB['KODE_DOKUMEN_PABEAN']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- End PLB -->
                        <!-- TPB -->
                        <div class="col-xl-6 col-md-6">
                            <div class="widget widget-stats bg-tpb">
                                <div class="stats-icon stats-icon-lg"><i class="fa fa-circle-up fa-fw"></i></div>
                                <div class="stats-content">
                                    <div class="stats-title">Total Data TPB Module</div>
                                    <?php if ($dataBC['status'] == 404) { ?>
                                        <div class="stats-number">- AJU</div>
                                        <div class="stats-progress progress">
                                            <div class="progress-bar" style="width: 100%;"></div>
                                        </div>
                                        <div class="stats-desc">AJU Terakhir: - <br> BC: -</div>
                                    <?php } else { ?>
                                        <?php foreach ($dataBC['result'] as $row) { ?>
                                            <div class="stats-number"><?= $row['total_bc']; ?> AJU</div>
                                            <div class="stats-progress progress">
                                                <div class="progress-bar" style="width: 100%;"></div>
                                            </div>
                                            <div class="stats-desc">AJU Terakhir: <?= $row['NOMOR_AJU']; ?> <br> BC:
                                                <?= $row['KODE_DOKUMEN_PABEAN']; ?></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- End TPB -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
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