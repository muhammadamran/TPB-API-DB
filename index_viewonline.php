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
<style type="text/css">
.row-dinding {
    background: #fff;
    border-radius: 5px;
}

.svg-img-center {
    display: flex;
    justify-content: center;
    align-items: center;
}

.images-svg {
    width: 635px;
}

.widget-stats,
.widget.widget-stats {
    position: relative;
    color: #fff;
    /* padding: 15px; */
    padding: 13px;
    -webkit-border-radius: 4px;
    border-radius: 10px;
}
</style>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-globe icon-page"></i>
                <font class="text-page">View Data Online</font>
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
    <div class="row">
        <div class="col-md-12">
            <div class="row"
                style="display: flex;justify-content: center;align-items: center;background: #fff;border-radius: 5px;margin-left: 0px;margin-right: 0px;padding: 15px 0px 0px 0px;">
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
                                    <?php if ($dataPLB['status'] == 404) { ?>
                                    <div class="stats-number">- AJU</div>
                                    <div class="stats-progress progress">
                                        <div class="progress-bar" style="width: 100%;"></div>
                                    </div>
                                    <div class="stats-desc">AJU Terakhir: - <br> BC: -</div>
                                    <?php } else { ?>
                                    <?php foreach ($dataPLB['result'] as $row) { ?>
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
// include "include/panel.php";
include "include/footer.php";
include "include/jsDatatables.php";
?>