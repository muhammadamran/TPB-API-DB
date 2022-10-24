<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
// include "include/sidebar.php";
include "include/cssDatatables.php";
// Function Search
$startdate = '';
$enddate = '';
if (isset($_GET['findRange'])) {
    $startdate = $_GET['startdate'];
    $enddate = $_GET['enddate'];

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Report/Log System';
    $InputDescription     = $me . " Cari Data: " .  $startdate ." s.d " .  $enddate .", Simpan Data Sebagai Report Log System";
    $InputAction          = 'Cari Data';
    $InputDate            = date('Y-m-d h:m:i');

    $query = $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");
    // var_dump($query);exit;
    // if ($query) {
    //     echo "<script>window.location.href='report_log_system.php';</script>";
    // } else {
    //     echo "<script>window.location.href='report_log_system.php';</script>";
    // }
}
// End Function Search
?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-desktop icon-page"></i>
                <font class="text-page">Laporan Log System</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Report</a></li>
                <li class="breadcrumb-item active">Laporan Log System</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;"><?= date('h:m:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- Begin Row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-perusahaan">
                <div class="panel-body text-inverse">
                    <div class="report-header-realisasi" style="display: flex;justify-content: space-around;align-items: center;">
                        <?php if ($resultHeadSetting['logo'] == NULL) { ?>
                            <img src="assets/images/logo/logo-default.png" width="10%">
                        <?php } else { ?>
                            <img src="assets/images/logo/<?= $resultHeadSetting['logo'] ?>" width="20%">
                        <?php } ?>
                        <div class="title-laporan" style="justify-content: center;text-align: center;align-items: center;display: grid;">
                            <font style="font-size: 20px;text-transform: uppercase;font-weight: 900;">LAPORAN LOG SYSTEM</font>
                            <font><?= $resultHeadSetting['address'] ?></font>
                            <font><?= $resultHeadSetting['company'] ?></font>
                            <?php if (isset($_GET['findRange'])) { ?>
                                <font>Data dari tanggal <?= $startdate ?> s.d <?= $enddate ?></font>
                            <?php } else { ?>
                            <?php } ?>
                        </div>
                        <div class="detail-get" style="justify-content: center;text-align: center;align-items: center;">
                            <!-- For Cari Tanggal -->
                            <center><a href="#modal-cari-tanggal" class="btn btn-primary-css" data-toggle="modal" title="Cari Tanggal"><i class="fas fa-calendar-alt"></i> Cari Tanggal</a></center>
                            <div class="modal fade" id="modal-cari-tanggal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="" method="GET">
                                            <div class="modal-header">
                                                <h4 class="modal-title">[Laporan Log System] Cari Tanggal</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row" style="display: grid;justify-content: center;align-items: center;">
                                                    <div class="col-12">
                                                        <img src="assets/img/svg/realisasi_b.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" width="50%">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row" style="align-items: center;">
                                                    <div class="col-xl-5">
                                                        <div class="form-group">
                                                            <?php if ($startdate == '') { ?>
                                                                <input type="date" name="startdate" class="form-control" required>
                                                            <?php } else { ?>
                                                                <input type="date" name="startdate" class="form-control" value="<?= $startdate ?>">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2">
                                                        <div class="form-group">
                                                            s.d
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-5">
                                                        <div class="form-group">
                                                            <?php if ($enddate == '') { ?>
                                                                <input type="date" name="enddate" class="form-control" required>
                                                            <?php } else { ?>
                                                                <input type="date" name="enddate" class="form-control" value="<?= $enddate ?>">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                <button type="submit" name="findRange" class="btn btn-primary"><i class="fas fa-calendar-alt"></i> Cari Tanggal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End For Cari Tanggal -->
                        </div>
                    </div>
                    <div style="background: #4c4747;height: 4px;width: 100%;margin: 15px -1px;box-sizing: border-box;"></div>
                    <style type="text/css">
                        .button-top-table {
                            margin-bottom: 15px;
                        }
                        
                        .icon-primary-excel {
                            width:  20px;
                        }

                        .btn-primary-excel {
                            color: #1f7244;
                            border: 2px solid #1f7244;
                            background-color: #fff;
                            box-shadow: 0 4px 6px rgb(50 50 93 / 11%), 0 1px 3px rgb(0 0 0 / 8%);
                        }

                        .btn-primary-excel:hover {
                            color: #fff;
                            border: 2px solid #1f7244;
                            background-color: #1f7244;
                            box-shadow: 0 4px 6px rgb(50 50 93 / 11%), 0 1px 3px rgb(0 0 0 / 8%);
                        }
                    </style>
                    <?php if (isset($_GET['findRange'])) { ?>
                    <div class="button-top-table">
                        <form action="export/excel_log_system.php" method="GET">
                            <input type="hidden" name="startdate" value="<?= $startdate ?>">
                            <input type="hidden" name="enddate" value="<?= $enddate ?>">
                            <input type="hidden" name="me" value="<?= $_SESSION['username'] ?>">
                            <button class="btn btn-primary-excel" name="find_">
                                <img src="assets/img/favicon/excel.png" class="icon-primary-excel" alt="Excel"> Export Excel
                            </button>
                        </form>
                    </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">#</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Waktu</th>
                                    <th style="text-align: center;">Username</th>
                                    <th style="text-align: center;">Kejadian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['findRange'])) {
                                    $startdate = $_GET['startdate'];
                                    $enddate   = $_GET['enddate'];
                                    $dataTable = $dbcon->query("SELECT * FROM tbl_aktifitas WHERE date_created BETWEEN '$startdate' AND '$enddate' ORDER BY id DESC");
                                } else {
                                    $dataTable = $dbcon->query("SELECT * FROM tbl_aktifitas ORDER BY id DESC LIMIT 0");
                                }
                                if (mysqli_num_rows($dataTable) > 0) {
                                    $no = 0;
                                    while ($row = mysqli_fetch_array($dataTable)) {
                                        $no++;
                                ?>
                                <tr>
                                    <!-- 21 -->
                                    <td><?= $no ?>. </td>
                                    <td style="text-align: left;"><i class="fas fa-calendar-alt"></i> <?= date_indo(SUBSTR($row['date_created'],0,10),TRUE) ?></td>
                                    <td style="text-align: left;"><i class="fas fa-clock"></i> <?= SUBSTR($row['date_created'],11) ?></td>
                                    <td style="text-align: center;"><?= $row['username'] ?></td>
                                    <td><?= $row['description'] ?></td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="5">
                                            <center>
                                                <div style="display: grid;">
                                                    <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                <?php }
                                mysqli_close($dbcon); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Begin Row -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php
// include "include/panel.php";
include "include/footer.php";
include "include/jsDatatables.php";
?>

<script type="text/javascript">
    if (window?.location?.href?.indexOf('ExportExcelFiled') > -1) {
        Swal.fire({
            title: 'Gagal Export Data Excel!',
            icon: 'error',
            text: 'Terjadi kesalahan pada sistem <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './report_log_system.php');
    }
</script>