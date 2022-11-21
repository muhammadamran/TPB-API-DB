<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";

// FUNCTION SEARCHING
$FindNoAJU          = '';
$Field_RTU          = '';
$Field_RTM          = '';
$ShowFindNoAJU      = '';
$ShowField_RTU      = '';
$ShowField_RTM      = '';

// RTU
if (isset($_POST["Find_NP"])) {
    $FindNoAJU      = $_POST['FindNoAJU'];
    $ShowFindNoAJU  = "Nomor Pengajuan: " . $_POST['FindNoAJU'];
}
// RTU
if (isset($_POST["Find_RTU"])) {
    $Field_RTU      = $_POST['default-daterange-upload'];
    $Field_RTUE     = explode(" - ", $Field_RTU);
    $RTUStart       = $Field_RTUE[0];
    $RTUStart_T     = strtotime($RTUStart);
    $S_RTU          = date("Y-m-d", $RTUStart_T);
    $RTUEnd         = $Field_RTUE[1];
    $RTUEnd_T       = strtotime($RTUEnd);
    $E_RTU          = date("Y-m-d", $RTUEnd_T);
    $ShowField_RTU  = "Tanggal Upload: " . $_POST['default-daterange-upload'];
}
// RTM
if (isset($_POST["Find_RTM"])) {
    $Field_RTM      = $_POST['default-daterange-masuk'];
    $Field_RTME     = explode(" - ", $Field_RTM);
    $RTMStart       = $Field_RTME[0];
    $RTMStart_T     = strtotime($RTMStart);
    $S_RTM          = date("Y-m-d", $RTMStart_T);
    $RTMEnd         = $Field_RTME[1];
    $RTMEnd_T       = strtotime($RTMEnd);
    $E_RTM          = date("Y-m-d", $RTMEnd_T);
    $ShowField_RTM  = "Tanggal Masuk: " . $_POST['default-daterange-masuk'];
}
if (isset($_POST['Find_NP']) != '') {
    $displayOne = 'show';
    $displayTwo = 'none';
    $displayThree = 'none';

    $selectOne = 'selected';
    $selectTwo = '';
    $selectThree = '';
} else if (isset($_POST['Find_RTU']) != '') {
    $displayOne = 'none';
    $displayTwo = 'show';
    $displayThree = 'none';

    $selectOne = '';
    $selectTwo = 'selected';
    $selectThree = '';
} else if (isset($_POST['Find_RTM']) != '') {
    $displayOne = 'none';
    $displayTwo = 'none';
    $displayThree = 'show';

    $selectOne = '';
    $selectTwo = '';
    $selectThree = 'selected';
} else {
    $displayOne = 'show';
    $displayTwo = 'none';
    $displayThree = 'none';

    $selectOne = 'selected';
    $selectTwo = '';
    $selectThree = '';
}
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Laporan Mutasi Barang App Name | Company </title>
<?php } else { ?>
    <title>Laporan Mutasi Barang - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fa-solid fa-building-circle-exclamation icon-page"></i>
                <font class="text-page">Laporan Mutasi Barang</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Laporan</a></li>
                <li class="breadcrumb-item active">Laporan Mutasi Barang</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;"><?= date('h:m:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin Select Tabel -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Filter Data Mutasi Barang Berdasarkan
                        <select name="Filter" id="input-filter" style="background: #202124;color: #fff;font-weight: 800;border-color: transparent;">
                            <option value="NP" <?= $selectOne ?>>Nomor Pengajuan</option>
                            <option value="RTU" <?= $selectTwo ?>>Range Tanggal Upload</option>
                            <option value="RTM" <?= $selectThree ?>>Range Tanggal Masuk</option>
                        </select>
                    </h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <!-- Nomor Pengajuan -->
                    <div id="form_NP" style="display: <?= $displayOne ?>;">
                        <form action="" method="POST">
                            <div style="display: flex;justify-content: center;align-items: center;">
                                <div style="display: flex;justify-content: center;">
                                    <img src="assets/img/svg/search-animate.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" style="width: 70%;">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>BC 2.7 PLB (Nomor Pengajuan)</label>
                                            <input type="number" id="IDAJU_PLB" name="FindNoAJU" class="form-control" placeholder="BC 2.7 PLB (Nomor Pengajuan) ..." value="<?= $FindNoAJU; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" name="Find_NP" class="btn btn-info m-r-5"><i class="fas fa-search"></i>
                                            <font class="f-action">Cari</font>
                                        </button>
                                        <a href="report_masuk_barang.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i>
                                            <font class="f-action">Reset</font>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Tanggal Upload -->
                    <div id="form_RTU" style="display: <?= $displayTwo ?>;">
                        <form action="" method="POST">
                            <div style="display: flex;justify-content: center;align-items: center;">
                                <div style="display: flex;justify-content: center;">
                                    <img src="assets/img/svg/realisasi_b.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" style="width: 70%;">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Range Tanggal Upload</label>
                                            <div class="input-group" id="default-daterange-upload">
                                                <input type="text" name="default-daterange-upload" class="form-control" value="<?= $Field_RTU ?>" placeholder="Pilih Range Tanggal Upload" />
                                                <span class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" name="Find_RTU" class="btn btn-info m-r-5"><i class="fas fa-search"></i>
                                            <font class="f-action">Cari</font>
                                        </button>
                                        <a href="report_masuk_barang.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i>
                                            <font class="f-action">Reset</font>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Range Tanggal Masuk -->
                    <div id="form_RTM" style="display: <?= $displayThree ?>;">
                        <form action="" method="POST">
                            <div style="display: flex;justify-content: center;align-items: center;">
                                <div style="display: flex;justify-content: center;">
                                    <img src="assets/img/svg/realisasi_b.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" style="width: 70%;">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Range Tanggal Masuk</label>
                                            <div class="input-group" id="default-daterange-masuk">
                                                <input type="text" name="default-daterange-masuk" class="form-control" value="<?= $Field_RTM ?>" placeholder="Pilih Range Tanggal Masuk" />
                                                <span class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" name="Find_RTM" class="btn btn-info m-r-5"><i class="fas fa-search"></i>
                                            <font class="f-action">Cari</font>
                                        </button>
                                        <a href="report_masuk_barang.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i>
                                            <font class="f-action">Reset</font>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Select Tabel -->

    <!-- Begin Row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-perusahaan">
                <div class="row" style="display: flex;align-items: center;margin-top: 15px;margin-bottom: -0px;padding: 25px;margin: 10px;">
                    <?php if (isset($_POST["Find_NP"])) { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <div>
                                    <form action="report_masuk_barang_pdf.php" target="_blank" method="POST">
                                        <input type="hidden" name="FindNoAJU" value="<?= $FindNoAJU ?>">
                                        <input type="hidden" name="ShowFindNoAJU" value="<?= $ShowFindNoAJU ?>">
                                        <button type="submit" name="Find_NP" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</button>
                                    </form>
                                </div>
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 0 0 0 0 ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="report_masuk_barang_excel.php" target="_blank" method="POST">
                                            <input type="hidden" name="FindNoAJU" value="<?= $FindNoAJU ?>">
                                            <input type="hidden" name="ShowFindNoAJU" value="<?= $ShowFindNoAJU ?>">
                                            <button type="submit" name="Find_NP" class="dropdown-item">Download as XLS</button>
                                        </form>
                                        <!-- <a href="javascript:;" class="dropdown-item">Download as DOCX</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else if (isset($_POST["Find_RTU"])) { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <div>
                                    <form action="report_masuk_barang_pdf.php" target="_blank" method="POST">
                                        <input type="hidden" name="S_RTU" value="<?= $S_RTU ?>">
                                        <input type="hidden" name="E_RTU" value="<?= $E_RTU ?>">
                                        <input type="hidden" name="ShowField_RTU" value="<?= $ShowField_RTU ?>">
                                        <button type="submit" name="Find_RTU" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</button>
                                    </form>
                                </div>
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 0 0 0 0 ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="report_masuk_barang_excel.php" target="_blank" method="POST">
                                            <input type="hidden" name="S_RTU" value="<?= $S_RTU ?>">
                                            <input type="hidden" name="E_RTU" value="<?= $E_RTU ?>">
                                            <input type="hidden" name="ShowField_RTU" value="<?= $ShowField_RTU ?>">
                                            <button type="submit" name="Find_RTU" class="dropdown-item">Download as XLS</button>
                                        </form>
                                        <!-- <a href="javascript:;" class="dropdown-item">Download as DOCX</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else if (isset($_POST["Find_RTM"])) { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <div>
                                    <form action="report_masuk_barang_pdf.php" target="_blank" method="POST">
                                        <input type="hidden" name="S_RTM" value="<?= $S_RTM ?>">
                                        <input type="hidden" name="E_RTM" value="<?= $E_RTM ?>">
                                        <input type="hidden" name="ShowField_RTM" value="<?= $ShowField_RTM ?>">
                                        <button type="submit" name="Find_RTM" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</button>
                                    </form>
                                </div>
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 0 0 0 0 ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="report_masuk_barang_excel.php" target="_blank" method="POST">
                                            <input type="hidden" name="S_RTM" value="<?= $S_RTM ?>">
                                            <input type="hidden" name="E_RTM" value="<?= $E_RTM ?>">
                                            <input type="hidden" name="ShowField_RTM" value="<?= $ShowField_RTM ?>">
                                            <button type="submit" name="Find_RTM" class="dropdown-item">Download as XLS</button>
                                        </form>
                                        <!-- <a href="javascript:;" class="dropdown-item">Download as DOCX</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <div>
                                    <a href="report_masuk_barang_pdf.php" target="_blank" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</a>
                                </div>
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 0 0 0 0 ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="report_masuk_barang_excel.php" target="_blank" class="dropdown-item">Download as XLS</a>
                                        <!-- <a href="javascript:;" class="dropdown-item">Download as DOCX</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-3 m-b-20">
                        <div style="display: flex;justify-content: center;">
                            <?php if ($resultHeadSetting['logo'] == NULL) { ?>
                                <img src="assets/images/logo/logo-default.png" width="30%">
                            <?php } else { ?>
                                <img src="assets/images/logo/<?= $resultHeadSetting['logo'] ?>" width="50%">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-9" style="display: grid;justify-content: left;">
                        <font style="font-size: 24px;font-weight: 800;text-transform:uppercase">LAPORAN PERTANGGUNGJAWABAN MUTASI BARANG <?= date('F') ?> <?= date('Y') ?></font>
                        <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                        <font style="font-size: 14px;font-weight: 800;">
                            <?= $ShowFindNoAJU; ?>
                            <?= $ShowField_RTU; ?>
                            <?= $ShowField_RTM; ?>
                        </font>
                        <div class="line-page-table"></div>
                        <font style="font-size: 18px;font-weight: 800;"><?= $resultHeadSetting['company_t'] ?></font>
                        <font style="font-size: 14px;font-weight: 400;"><i class="fa-solid fa-location-dot"></i> <?= $resultHeadSetting['address'] ?>
                        </font>
                    </div>
                    <div class="col-md-12" style="margin-bottom: -40px;">
                        <hr>
                    </div>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="C_TableDefault_L" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">No.</th>
                                    <th rowspan="2" style="text-align: center;">Kode<font style="color: #dadddf;">.</font>Barang</th>
                                    <th rowspan="2" style="text-align: center;">Uraian</th>
                                    <th rowspan="2" style="text-align: center;">Spesifikasi<font style="color: #dadddf;">.</font>Lain</th>
                                    <th rowspan="2" style="text-align: center;">Satuan</th>
                                    <th colspan="2" style="text-align: center;">Saldo Awal</th>
                                    <th colspan="2" style="text-align: center;">Mutasi<font style="color: #dadddf;">.</font>Masuk</th>
                                    <th colspan="2" style="text-align: center;">Mutasi<font style="color: #dadddf;">.</font>Keluar</th>
                                    <th colspan="2" style="text-align: center;">Saldo<font style="color: #dadddf;">.</font>Akhir</th>
                                    <th colspan="2" style="text-align: center;">Stock<font style="color: #dadddf;">.</font>Opname</th>
                                    <th colspan="2" style="text-align: center;">Penyesuaian</th>
                                    <th colspan="2" style="text-align: center;">Selisih</th>
                                    <th colspan="2" style="text-align: center;">Keterangan</th>
                                    <th colspan="2" style="text-align: center;">Petugas<font style="color: #dadddf;">.</font><?= $resultSetting['company']; ?></th>
                                    <th colspan="2" style="text-align: center;">Petugas BeaCukai</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">Carton</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">Carton</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">Carton</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">Carton</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">Carton</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>In</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>Out</th>
                                    <th style="text-align: center;">Carton</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>In</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>Out</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>In</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>Out</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>In</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>Out</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dateMB        = date('m');
                                $dateYB        = date('Y');
                                $dataTable = $dbcon->query("SELECT 
                                                            brg.ID,
                                                            brg.KODE_BARANG,
                                                            brg.URAIAN,
                                                            brg.SPESIFIKASI_LAIN,
                                                            brg.KODE_SATUAN,
                                                            brg.BOTOL,
                                                            brg.SERI_BARANG,
                                                            rcd.bm_nama_operator,
                                                            rcd.bk_nama_operator,
                                                            rcd.bc_in,
                                                            rcd.bc_out,
                                                            stock.carton AS carton_stock,
                                                            stock.botol AS botol_stock,
                                                            -- SALDO AWAL
                                                            (SELECT SUM(JUMLAH_SATUAN) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG) AS SALDO_CT,
                                                            (SELECT SUM(BOTOL) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG) AS SALDO_BTL,
                                                            -- END SALOD AWAL
                                                            -- MUTASI MASUK KONDISI BARANG MASUK (GATE IN)
                                                            (SELECT SUM(TOTAL_CT_AKHIR) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS='Sesuai') AS MUTASI_MASUK_CT,
                                                            (SELECT SUM(TOTAL_BOTOL_AKHIR) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS='Sesuai') AS MUTASI_MASUK_BTL,
                                                            -- END MUTASI MASUK KONDISI BARANG MASUK (GATE IN)
                                                            -- MUTASI KELUAR KONDISI BARANG KELUAR (GATE OUT)
                                                            (SELECT SUM(TOTAL_CT_AKHIR_GB) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS_GB='Sesuai') AS MUTASI_KELUAR_CT,
                                                            (SELECT SUM(TOTAL_BOTOL_AKHIR_GB) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS_GB='Sesuai') AS MUTASI_KELUAR_BTL,
                                                            -- END MUTASI KELUAR KONDISI BARANG KELUAR (GATE OUT)
                                                            -- SALDO AKHIR
                                                            -- END SALDO AKHIR
                                                            -- STOCK OPNAME
                                                            (SELECT COUNT(TOTAL_BOTOL) FROM plb_barang_ct WHERE KODE_BARANG=brg.KODE_BARANG AND TOTAL_BOTOL='0') AS CT_SO,
                                                            -- END STOCK OPNAME
                                                            -- PENYESUAIAN
                                                            -- IN
                                                            (SELECT SUM(KURANG) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='IN' AND PENY IS NULL) AS K_IN,
                                                            (SELECT SUM(LEBIH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='IN' AND PENY IS NULL) AS L_IN,
                                                            (SELECT SUM(PECAH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='IN' AND PENY IS NULL) AS P_IN,
                                                            (SELECT SUM(RUSAK) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='IN' AND PENY IS NULL) AS R_IN,
                                                            -- OUT
                                                            (SELECT SUM(KURANG) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='OUT' AND PENY IS NULL) AS K_OUT,
                                                            (SELECT SUM(LEBIH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='OUT' AND PENY IS NULL) AS L_OUT,
                                                            (SELECT SUM(PECAH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='OUT' AND PENY IS NULL) AS P_OUT,
                                                            (SELECT SUM(RUSAK) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='OUT' AND PENY IS NULL) AS R_OUT
                                                            -- PENYESUAIAN
                                                            FROM plb_barang_ct AS ct
                                                            LEFT OUTER JOIN plb_barang AS brg ON brg.KODE_BARANG=ct.KODE_BARANG
                                                            LEFT OUTER JOIN plb_header AS plb ON plb.NOMOR_AJU=brg.NOMOR_AJU
                                                            LEFT OUTER JOIN rcd_status AS rcd ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
                                                            LEFT OUTER JOIN tbl_cust_stock AS stock ON stock.kd_barang=brg.KODE_BARANG
                                                            WHERE EXTRACT(MONTH FROM brg.DATE_CT)='$dateMB' AND EXTRACT(YEAR FROM brg.DATE_CT)='$dateYB'
                                                            GROUP BY brg.KODE_BARANG
                                                            ORDER BY brg.SERI_BARANG ASC,brg.ID DESC", 0);
                                if ($dataTable) : $no = 1;
                                    foreach ($dataTable as $row) :
                                        // $SA_CT  = str_replace(".0000", "", $row['SALDO_CT']);
                                        // $SA_BTL = $row['BOTOL'] * $SA_CT;
                                        // // PEYESUAIAN IN
                                        // $PIN    = $SA_BTL - $row['MUTASI_MASUK_BTL'];
                                        // // PENYESUAIAN OUT
                                        // if ($row['MUTASI_KELUAR_BTL'] == NULL) {
                                        //     $POUT   = 0;
                                        // } else {
                                        //     $POUT   = $row['MUTASI_MASUK_BTL'] - $row['MUTASI_KELUAR_BTL'];
                                        // }
                                        // PENYESUAIAN IN
                                        $P_IN = $row['K_IN'] + $row['L_IN'] + $row['P_IN'] + $row['R_IN'];
                                        // PENYESUAIAN OUT
                                        $P_OUT = $row['K_OUT'] + $row['L_OUT'] + $row['P_OUT'] + $row['R_OUT'];
                                ?>
                                        <tr>
                                            <td><?= $no ?>.</td>
                                            <!-- Kode Barang -->
                                            <td style="text-align: left;">
                                                <?php if ($row['KODE_BARANG'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['KODE_BARANG']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- Barang -->
                                            <td style="text-align: left;">
                                                <?php if ($row['URAIAN'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['URAIAN']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['SPESIFIKASI_LAIN'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['SPESIFIKASI_LAIN']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['KODE_SATUAN'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['KODE_SATUAN']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- Saldo Awal -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?php if ($row['carton_stock'] == NULL) { ?>
                                                    0<font style="font-size: 3px;">(SCtn)</font>
                                                <?php } else { ?>
                                                    <?= $row['carton_stock']; ?><font style="font-size: 3px;">(SCtn)</font>
                                                <?php } ?>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?php if ($row['botol_stock'] == NULL) { ?>
                                                    0<font style="font-size: 3px;">(SCtn)</font>
                                                <?php } else { ?>
                                                    <?= $row['botol_stock']; ?><font style="font-size: 3px;">(SBtl)</font>
                                                <?php } ?>
                                            </td>
                                            <!-- End Saldo Awal -->
                                            <!-- Mutasi Masuk -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?php if ($row['MUTASI_MASUK_CT'] == NULL) { ?>
                                                    0<font style="font-size: 3px;">(MInBtl)</font>
                                                <?php } else { ?>
                                                    <?= $row['MUTASI_MASUK_CT']; ?><font style="font-size: 3px;">(MInBtl)</font>
                                                <?php } ?>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?php if ($row['MUTASI_MASUK_BTL'] == NULL) { ?>
                                                    0<font style="font-size: 3px;">(MInBtl)</font>
                                                <?php } else { ?>
                                                    <?= $row['MUTASI_MASUK_BTL']; ?><font style="font-size: 3px;">(MInBtl)</font>
                                                <?php } ?>
                                            </td>
                                            <!-- End Mutasi Masuk -->
                                            <!-- Mutasi keluar -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?php if ($row['MUTASI_KELUAR_CT'] == NULL) { ?>
                                                    0<font style="font-size: 3px;">(MOutCtn)</font>
                                                <?php } else { ?>
                                                    <?= $row['MUTASI_KELUAR_CT']; ?><font style="font-size: 3px;">(MOutCtn)</font>
                                                <?php } ?>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?php if ($row['MUTASI_KELUAR_BTL'] == NULL) { ?>
                                                    0<font style="font-size: 3px;">(MOutBtl)</font>
                                                <?php } else { ?>
                                                    <?= $row['MUTASI_KELUAR_BTL']; ?><font style="font-size: 3px;">(MOutBtl)</font>
                                                <?php } ?>
                                            </td>
                                            <!-- End Mutasi keluar -->
                                            <!-- End Penyesuaian -->
                                            <!-- Saldo Akhir -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?= $row['carton_stock'] + $row['MUTASI_KELUAR_CT']; ?><font style="font-size: 3px;">(MSACtn)</font>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?= $row['botol_stock'] + $row['MUTASI_KELUAR_BTL']; ?><font style="font-size: 3px;">(MSABtl)</font>
                                            </td>
                                            <!-- End Saldo Akhir -->
                                            <!-- Stok Opname -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?= $row['CT_SO']; ?>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?= $P_IN + $P_OUT ?>
                                            </td>
                                            <!-- End Stok Opname -->
                                            <!-- Penyesuaian -->
                                            <!-- IN -->
                                            <td style="text-align: center;">
                                                <?= $P_IN; ?><font style="font-size: 3px;">(PenyesuaianIN)</font>
                                            </td>
                                            <!-- OUT -->
                                            <td style="text-align: center;">
                                                <?= $P_OUT; ?><font style="font-size: 3px;">(PenyesuaianOUT)</font>
                                            </td>
                                            <!-- Selisih -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?php if ($row['MUTASI_KELUAR_CT'] == NULL) { ?>
                                                    0<font style="font-size: 3px;">(Selisih)</font>
                                                <?php } else { ?>
                                                    <?= $row['MUTASI_MASUK_CT'] - $row['MUTASI_KELUAR_CT']; ?><font style="font-size: 3px;">(Selisih)</font>
                                                <?php } ?>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?php if ($row['MUTASI_KELUAR_BTL'] == NULL) { ?>
                                                    0<font style="font-size: 3px;">(Selisih)</font>
                                                <?php } else { ?>
                                                    <?= $row['MUTASI_MASUK_BTL'] - $row['MUTASI_KELUAR_BTL']; ?><font style="font-size: 3px;">(Selisih)</font>
                                                <?php } ?>
                                            </td>
                                            <!-- End Selisih -->
                                            <!-- Keterangan -->
                                            <!-- IN -->
                                            <td style="text-align: left;">
                                                <?php if ($row['K_IN'] == NULL && $row['L_IN'] == NULL && $row['P_IN'] == NULL && $row['R_IN'] == NULL) { ?>
                                                    <center>
                                                        0
                                                    </center>
                                                <?php } else { ?>
                                                    <div style="display: flex;">
                                                        <?php if ($row['K_IN'] != NULL) { ?>
                                                            <div>
                                                                <span class="label label-sm label-yellow" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Kurang = <?= $row['K_IN']; ?> Botol">
                                                                    <i class="fa-solid fa-minus"></i> <?= $row['K_IN']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($row['L_IN'] != NULL) { ?>
                                                            <div class="m-l-5">
                                                                <span class="label label-sm label-lime" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Lebih = <?= $row['R_IN']; ?> Botol">
                                                                    <i class="fa-solid fa-plus"></i> <?= $row['L_IN']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($row['P_IN'] != NULL) { ?>
                                                            <div class="m-l-5">
                                                                <span class="label label-sm label-dark" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Pecah = <?= $row['P_IN']; ?> Botol">
                                                                    <i class="fa-solid fa-tags"></i> <?= $row['P_IN']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($row['R_IN'] != NULL) { ?>
                                                            <div class="m-l-5">
                                                                <span class="label label-sm label-warning" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Rusak = <?= $row['R_IN']; ?> Botol">
                                                                    <i class="fa-solid fa-magnifying-glass-arrow-right"></i> <?= $row['R_IN']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <!-- OUT -->
                                            <td style="text-align: left;">
                                                <?php if ($row['K_OUT'] == NULL && $row['L_OUT'] == NULL && $row['P_OUT'] == NULL && $row['R_OUT'] == NULL) { ?>
                                                    <center>
                                                        0
                                                    </center>
                                                <?php } else { ?>
                                                    <div style="display: flex;">
                                                        <?php if ($row['K_OUT'] != NULL) { ?>
                                                            <div>
                                                                <span class="label label-sm label-yellow" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Kurang = <?= $row['K_OUT']; ?> Botol">
                                                                    <i class="fa-solid fa-minus"></i> <?= $row['K_OUT']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($row['L_OUT'] != NULL) { ?>
                                                            <div class="m-l-5">
                                                                <span class="label label-sm label-lime" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Lebih = <?= $row['R_OUT']; ?> Botol">
                                                                    <i class="fa-solid fa-plus"></i> <?= $row['L_OUT']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($row['P_OUT'] != NULL) { ?>
                                                            <div class="m-l-5">
                                                                <span class="label label-sm label-dark" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Pecah = <?= $row['P_OUT']; ?> Botol">
                                                                    <i class="fa-solid fa-tags"></i> <?= $row['P_OUT']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($row['R_OUT'] != NULL) { ?>
                                                            <div class="m-l-5">
                                                                <span class="label label-sm label-warning" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Rusak = <?= $row['R_OUT']; ?> Botol">
                                                                    <i class="fa-solid fa-magnifying-glass-arrow-right"></i> <?= $row['R_OUT']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <!-- End Keterangan -->
                                            <!-- Petugas Sarinah-->
                                            <!-- IN -->
                                            <td style="text-align: center;">
                                                <?php if ($row['bm_nama_operator'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['bm_nama_operator']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- OUT -->
                                            <td style="text-align: center;">
                                                <?php if ($row['bk_nama_operator'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['bk_nama_operator']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- Petugas BC -->
                                            <!-- IN -->
                                            <td style="text-align: center;">
                                                <?php if ($row['bc_in'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['bc_in']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- OUT -->
                                            <td style="text-align: center;">
                                                <?php if ($row['bc_out'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['bc_out']; ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endforeach
                                    ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="35">
                                            <center>
                                                <div style="display: grid;">
                                                    <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="invoice-footer">
                        <p class="text-center m-b-5 f-w-600">
                            Laporan Mutasi Barang | IT Inventory <?= $resultHeadSetting['company'] ?>
                        </p>
                        <p class="text-center">
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i>
                                <?= $resultHeadSetting['website'] ?>
                            </span>
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i>
                                T:<?= $resultHeadSetting['telp'] ?>
                            </span>
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i>
                                <?= $resultHeadSetting['email'] ?>
                            </span>
                        </p>
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
include "include/pusat_bantuan.php";
include "include/riwayat_aktifitas.php";
include "include/panel.php";
include "include/footer.php";
include "include/jsDatatables.php";
include "include/jsForm.php";
?>
<script type="text/javascript">
    $(function() {
        $("#IDAJU_PLB").autocomplete({
            source: 'function/autocomplete/nomor_aju_plb.php'
        });
    });
    $(function() {
        $("#input-filter").change(function() {
            if ($(this).val() == "NP") {
                $("#form_NP").show();
                $("#form_RTU").hide();
                $("#form_RTM").hide();
            } else if ($(this).val() == "RTU") {
                $("#form_NP").hide();
                $("#form_RTU").show();
                $("#form_RTM").hide();
            } else if ($(this).val() == "RTM") {
                $("#form_NP").hide();
                $("#form_RTU").hide();
                $("#form_RTM").show();
            } else {
                $("#form_NP").show();
                $("#form_RTU").hide();
                $("#form_RTM").hide();
            }
        });
    });
    var handleDateRangePicker = function() {
        // RANGE TANGGAL UPLOAD
        $('#default-daterange-upload').daterangepicker({
            opens: 'right',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            minDate: '<?= $RUFirst ?>',
            maxDate: '<?= $RULast ?>',
        }, function(start, end) {
            $('#default-daterange-upload input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });
        // RANGE TANGGAL MASUK
        $('#default-daterange-masuk').daterangepicker({
            opens: 'right',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            minDate: '<?= $RMFirst ?>',
            maxDate: '<?= $RMLast ?>',
        }, function(start, end) {
            $('#default-daterange-masuk input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });
    };
</script>