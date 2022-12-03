<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";
// include "include/sidebar.php";

$NoPengajuanPLB = '';
$NoPengajuanGB = '';
$TanggalBC27One = '';
$TanggalBC27Two = '';
$Supplier = '';
$KodeNegara = '';
$NamaNegara = '';
$MataUang = '';
$TanggalMasukBarangOne = '';
$TanggalMasukBarangTwo = '';
$TanggalKeluarBarangOne = '';
$TanggalKeluarBarangTwo = '';
if (isset($_POST["findOne"])) {
    if ($_POST["NoPengajuanPLB"] != '') {
        $NoPengajuanPLB = $_POST['NoPengajuanPLB'];
    }

    if ($_POST["NoPengajuanGB"] != '') {
        $NoPengajuanGB = $_POST['NoPengajuanGB'];
    }

    if ($_POST["TanggalBC27One"] != '') {
        $TanggalBC27One = $_POST['TanggalBC27One'];
    }

    if ($_POST["TanggalBC27Two"] != '') {
        $TanggalBC27Two = $_POST['TanggalBC27Two'];
    }

    if ($_POST["Supplier"] != '') {
        $Supplier = $_POST['Supplier'];
    }

    if ($_POST["KodeNegara"] != '') {
        $KodeNegara = $_POST['KodeNegara'];
    }

    if ($_POST["NamaNegara"] != '') {
        $NamaNegara = $_POST['NamaNegara'];
    }

    if ($_POST["MataUang"] != '') {
        $MataUang = $_POST['MataUang'];
    }

    if ($_POST["TanggalMasukBarangOne"] != '') {
        $TanggalMasukBarangOne = $_POST['TanggalMasukBarangOne'];
    }

    if ($_POST["TanggalMasukBarangTwo"] != '') {
        $TanggalMasukBarangTwo = $_POST['TanggalMasukBarangTwo'];
    }

    if ($_POST["TanggalKeluarBarangOne"] != '') {
        $TanggalKeluarBarangOne = $_POST['TanggalKeluarBarangOne'];
    }

    if ($_POST["TanggalKeluarBarangTwo"] != '') {
        $TanggalKeluarBarangTwo = $_POST['TanggalKeluarBarangTwo'];
    }
}

?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Laporan Data TPB App Name | Company </title>
<?php } else { ?>
    <title>Laporan Data TPB - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-solid fa-building-flag icon-page"></i>
                <font class="text-page">Laporan Data TPB</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Laporan</a></li>
                <li class="breadcrumb-item active">Laporan Data TPB</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;"><?= date('H:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-filter"></i> Filter Data TPB </h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" id="fformone" method="POST">
                        <fieldset>
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">No. Pengajuan PLB</label>
                                <div class="col-md-2">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" id="IDAJU_PLB" class="form-control" name="NoPengajuanPLB" placeholder="No. Pengajuan PLB ..." value="<?= $NoPengajuanPLB ?>">
                                </div>
                            </div>
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">No. Pengajuan GB</label>
                                <div class="col-md-2">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" id="IDAJU_GB" class="form-control" name="NoPengajuanGB" placeholder="No. Pengajuan GB ..." value="<?= $NoPengajuanGB ?>">
                                </div>
                            </div>
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">Tanggal BC.27 GB</label>
                                <div class="col-md-2">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="TanggalBC27One" placeholder="Tanggal BC.27 GB ..." value="<?= $TanggalBC27One ?>">
                                </div>
                                <div class="col-md-1" style="display: flex;justify-content: center;">
                                    <font>s.d</font>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="TanggalBC27Two" placeholder="Tanggal BC.27 GB ..." value="<?= $TanggalBC27Two ?>">
                                </div>
                            </div>
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">Supplier</label>
                                <div class="col-md-2">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" id="ID_SUPPLIER" class="form-control" name="Supplier" placeholder="Supplier ..." value="<?= $Supplier ?>">
                                </div>
                            </div>
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">Kode Negara / Nama Negara Supplier</label>
                                <div class="col-md-2">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" id="ID_KD_NEGARA" class="form-control" name="KodeNegara" placeholder="Kode Negara ..." value="<?= $KodeNegara ?>">
                                </div>
                                <div class="col-md-1" style="display: flex;justify-content: center;">
                                    <font>/</font>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" id="ID_NAMA_NEGARA" class="form-control" name="NamaNegara" placeholder="Nama Negara ..." value="<?= $NamaNegara ?>">
                                </div>
                            </div>
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">Mata Uang</label>
                                <div class="col-md-2">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" id="ID_MATA_UANG" class="form-control" name="MataUang" placeholder="Mata Uang ..." value="<?= $MataUang ?>">
                                </div>
                            </div>
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">Tanggal Masuk Barang</label>
                                <div class="col-md-2">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="TanggalMasukBarangOne" placeholder="Tanggal Masuk Barang ..." value="<?= $TanggalMasukBarangOne ?>">
                                </div>
                                <div class="col-md-1" style="display: flex;justify-content: center;">
                                    <font>s.d</font>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="TanggalMasukBarangTwo" placeholder="Tanggal Masuk Barang ..." value="<?= $TanggalMasukBarangTwo ?>">
                                </div>
                            </div>
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">Tanggal Keluar Barang</label>
                                <div class="col-md-2">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="TanggalKeluarBarangOne" placeholder="Tanggal Keluar Barang ..." value="<?= $TanggalKeluarBarangOne ?>">
                                </div>
                                <div class="col-md-1" style="display: flex;justify-content: center;">
                                    <font>s.d</font>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="TanggalKeluarBarangTwo" placeholder="Tanggal Keluar Barang ..." value="<?= $TanggalKeluarBarangTwo ?>">
                                </div>
                            </div>
                            <div class="form-group row" style="justify-content: flex-end;">
                                <div class="col-md-7 offset-md-3">
                                    <button type="submit" class="btn btn-info m-r-5" name="findOne">
                                        <i class="fa fa-search"></i>
                                        <font class="f-action">Cari</font>
                                    </button>
                                    <a href="report_data_tpb.php" type="button" class="btn btn-warning m-r-5">
                                        <i class="fa fa-refresh"></i>
                                        <font class="f-action">Reset</font>
                                    </a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Data TPB</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="TableDataTPB" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%" style="text-align:center">No.</th>
                                    <th colspan="4" style="text-align:center">BC.27 PLB</th>
                                    <th colspan="4" style="text-align:center">BC.27 GB</th>
                                    <th rowspan="2" style="text-align:center">KD / Negara</th>
                                    <th rowspan="2" style="text-align:center">Supplier</th>
                                    <th colspan="3" style="text-align:center">Jumlah</th>
                                    <th rowspan="2" style="text-align:center">Party</th>
                                    <th rowspan="2" style="text-align:center">Valas</th>
                                    <th rowspan="2" style="text-align:center">Nilai Total</th>
                                    <th colspan="2" style="text-align:center">Tujuan</th>
                                    <th rowspan="2" style="text-align:center">Origin</th>
                                    <th rowspan="2" style="text-align:center">Tgl.<font style="color: #dadddf;">.</font>Masuk<font style="color: #dadddf;">.</font>Barang</th>
                                    <th rowspan="2" style="text-align:center">Tgl.<font style="color: #dadddf;">.</font>Keluar<font style="color: #dadddf;">.</font>Barang</th>
                                </tr>
                                <tr>
                                    <!-- PLB -->
                                    <th style="text-align:center">No.<font style="color: #dadddf;">.</font>Pengajuan</th>
                                    <th style="text-align:center">Tgl.<font style="color: #dadddf;">.</font>Input</th>
                                    <th style="text-align:center">No.<font style="color: #dadddf;">.</font>Daftar</th>
                                    <th style="text-align:center">Tgl.<font style="color: #dadddf;">.</font>Daftar</th>
                                    <!-- GB -->
                                    <th style="text-align:center">No.<font style="color: #dadddf;">.</font>Pengajuan</th>
                                    <th style="text-align:center">Tgl.<font style="color: #dadddf;">.</font>Input</th>
                                    <th style="text-align:center">No.<font style="color: #dadddf;">.</font>Daftar</th>
                                    <th style="text-align:center">Tgl.<font style="color: #dadddf;">.</font>Daftar</th>
                                    <!-- Jumlah -->
                                    <th style="text-align:center">Carton</th>
                                    <th style="text-align:center">Botol</th>
                                    <th style="text-align:center">Liter</th>
                                    <!-- Tujuan -->
                                    <th style="text-align:center">NPWP</th>
                                    <th style="text-align:center">Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST["findOne"])) {
                                    function where_add($_wh, $_add)
                                    {
                                        $wh = '';
                                        if ($wh == '') {
                                            return 'WHERE ' . $_add;
                                        } else {
                                            return $_wh . ' AND ' . $_add;
                                        }
                                    }
                                    $i = 1;
                                    $_where = '';
                                    $i = 1;
                                    $_where = '';
                                    if ($NoPengajuanPLB == true) {
                                        $_where = where_add($_where, ' plb.NOMOR_AJU LIKE ' . "'%$NoPengajuanPLB%'" . '');
                                    }
                                    if ($NoPengajuanGB == true) {
                                        $_where = where_add($_where, ' tpb.NOMOR_AJU LIKE ' . "'%$NoPengajuanGB%'" . '');
                                    }
                                    if ($TanggalBC27One == true) {
                                        $_where = where_add($_where, ' tpb.TANGGAL_DAFTAR BETWEEN "' . $TanggalBC27One . '" AND "' . $TanggalBC27Two . '"');
                                    }
                                    if ($Supplier == true) {
                                        $_where = where_add($_where, ' tpb.NAMA_PENERIMA_BARANG LIKE ' . "'%$Supplier%'" . '');
                                    }
                                    if ($KodeNegara == true) {
                                        $_where = where_add($_where, ' tpb.KODE_NEGARA_PEMASOK LIKE ' . "'%$KodeNegara%'" . '');
                                    }
                                    if ($NamaNegara == true) {
                                        $_where = where_add($_where, ' ngr_gb.URAIAN_NEGARA LIKE ' . "'%$NamaNegara%'" . '');
                                    }
                                    if ($MataUang == true) {
                                        $_where = where_add($_where, ' tpb.KODE_VALUTA LIKE ' . "'%$MataUang%'" . '');
                                    }
                                    if ($TanggalMasukBarangOne == true) {
                                        $_where = where_add($_where, ' (SELECT DATE_CT FROM plb_barang WHERE NOMOR_AJU=plb.NOMOR_AJU GROUP BY NOMOR_AJU ORDER BY ID ASC) BETWEEN "' . $TanggalMasukBarangOne . '" AND "' . $TanggalMasukBarangTwo . '"');
                                    }
                                    if ($TanggalKeluarBarangOne == true) {
                                        $_where = where_add($_where, ' (SELECT DATE_CT_GB FROM plb_barang WHERE NOMOR_AJU=plb.NOMOR_AJU GROUP BY NOMOR_AJU ORDER BY ID DESC) BETWEEN "' . $TanggalKeluarBarangOne . '" AND "' . $TanggalKeluarBarangTwo . '"');
                                    }

                                    // echo $_where;
                                    $dataTable = $dbcon->query("SELECT 
                                                                -- BC27 PLB
                                                                plb.NOMOR_AJU AS NOMOR_AJU_PLB,
                                                                SUBSTR(plb.NOMOR_AJU,13,8) AS TGL_AJU_PLB,
                                                                plb.NOMOR_DAFTAR AS NOMOR_DAFTAR_PLB,
                                                                plb.TANGGAL_DAFTAR AS TANGGAL_DAFTAR_PLB,
                                                                -- END
                                                                -- BC27 GB
                                                                tpb.NOMOR_AJU AS NOMOR_AJU_GB,
                                                                SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU_GB,
                                                                tpb.NOMOR_DAFTAR AS NOMOR_DAFTAR_GB,
                                                                tpb.TANGGAL_DAFTAR AS TANGGAL_DAFTAR_GB,
                                                                -- END
                                                                tpb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_GB,                                                                
                                                                ngr_gb.URAIAN_NEGARA,
                                                                plb.PERUSAHAAN,
                                                                (SELECT SUM(TOTAL_CT_AKHIR_GB) FROM plb_barang WHERE NOMOR_AJU=plb.NOMOR_AJU) AS CARTON,
                                                                (SELECT SUM(TOTAL_BOTOL_AKHIR_GB) FROM plb_barang WHERE NOMOR_AJU=plb.NOMOR_AJU) AS BOTOL,
                                                                (SELECT SUM(TOTAL_LITER_AKHIR_GB) FROM plb_barang WHERE NOMOR_AJU=plb.NOMOR_AJU) AS LITER,
                                                                (SELECT UKURAN FROM plb_barang WHERE NOMOR_AJU=plb.NOMOR_AJU GROUP BY NOMOR_AJU) AS PARTY,
                                                                tpb.KODE_VALUTA,
                                                                tpb.CIF,
                                                                tpb.ID_PENERIMA_BARANG,
                                                                tpb.NAMA_PENERIMA_BARANG,
                                                                ngr_origin.URAIAN_NEGARA AS ORIGIN,
                                                                (SELECT DATE_CT FROM plb_barang WHERE NOMOR_AJU=plb.NOMOR_AJU GROUP BY NOMOR_AJU ORDER BY ID ASC) AS TGL_MASUK,
                                                                (SELECT DATE_CT_GB FROM plb_barang WHERE NOMOR_AJU=plb.NOMOR_AJU GROUP BY NOMOR_AJU ORDER BY ID DESC) AS TGL_KELUAR
                                                                FROM rcd_status AS rcd
                                                                LEFT OUTER JOIN plb_header AS plb ON plb.NOMOR_AJU=rcd.bm_no_aju_plb
                                                                LEFT OUTER JOIN tpb_header AS tpb ON tpb.NOMOR_AJU=rcd.bk_no_aju_sarinah
                                                                LEFT OUTER JOIN referensi_negara AS ngr_gb ON tpb.KODE_NEGARA_PEMASOK=ngr_gb.KODE_NEGARA
                                                                LEFT OUTER JOIN referensi_negara AS ngr_origin ON plb.KODE_NEGARA_PEMASOK=ngr_origin.KODE_NEGARA
                                                                $_where
                                                                ORDER BY rcd.rcd_id DESC");
                                } else {
                                    $dataTable = $dbcon->query("SELECT 
                                                                -- BC27 PLB
                                                                plb.NOMOR_AJU AS NOMOR_AJU_PLB,
                                                                SUBSTR(plb.NOMOR_AJU,13,8) AS TGL_AJU_PLB,
                                                                plb.NOMOR_DAFTAR AS NOMOR_DAFTAR_PLB,
                                                                plb.TANGGAL_DAFTAR AS TANGGAL_DAFTAR_PLB,
                                                                -- END
                                                                -- BC27 GB
                                                                tpb.NOMOR_AJU AS NOMOR_AJU_GB,
                                                                SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU_GB,
                                                                tpb.NOMOR_DAFTAR AS NOMOR_DAFTAR_GB,
                                                                tpb.TANGGAL_DAFTAR AS TANGGAL_DAFTAR_GB,
                                                                -- END
                                                                tpb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_GB,                                                                
                                                                ngr_gb.URAIAN_NEGARA,
                                                                plb.PERUSAHAAN,
                                                                (SELECT SUM(TOTAL_CT_AKHIR_GB) FROM plb_barang WHERE NOMOR_AJU=plb.NOMOR_AJU) AS CARTON,
                                                                (SELECT SUM(TOTAL_BOTOL_AKHIR_GB) FROM plb_barang WHERE NOMOR_AJU=plb.NOMOR_AJU) AS BOTOL,
                                                                (SELECT SUM(TOTAL_LITER_AKHIR_GB) FROM plb_barang WHERE NOMOR_AJU=plb.NOMOR_AJU) AS LITER,
                                                                (SELECT UKURAN FROM plb_barang WHERE NOMOR_AJU=plb.NOMOR_AJU GROUP BY NOMOR_AJU) AS PARTY,
                                                                tpb.KODE_VALUTA,
                                                                tpb.CIF,
                                                                tpb.ID_PENERIMA_BARANG,
                                                                tpb.NAMA_PENERIMA_BARANG,
                                                                ngr_origin.URAIAN_NEGARA AS ORIGIN,
                                                                (SELECT DATE_CT FROM plb_barang WHERE NOMOR_AJU=plb.NOMOR_AJU GROUP BY NOMOR_AJU ORDER BY ID ASC) AS TGL_MASUK,
                                                                (SELECT DATE_CT_GB FROM plb_barang WHERE NOMOR_AJU=plb.NOMOR_AJU GROUP BY NOMOR_AJU ORDER BY ID DESC) AS TGL_KELUAR
                                                                FROM rcd_status AS rcd
                                                                LEFT OUTER JOIN plb_header AS plb ON plb.NOMOR_AJU=rcd.bm_no_aju_plb
                                                                LEFT OUTER JOIN tpb_header AS tpb ON tpb.NOMOR_AJU=rcd.bk_no_aju_sarinah
                                                                LEFT OUTER JOIN referensi_negara AS ngr_gb ON tpb.KODE_NEGARA_PEMASOK=ngr_gb.KODE_NEGARA
                                                                LEFT OUTER JOIN referensi_negara AS ngr_origin ON plb.KODE_NEGARA_PEMASOK=ngr_origin.KODE_NEGARA ORDER BY rcd.rcd_id DESC LIMIT 100");
                                }
                                if ($dataTable) : $no = 1;
                                    foreach ($dataTable as $row) :
                                ?>
                                        <tr>
                                            <td><?= $no ?>.</td>
                                            <!-- BC27 PLB -->
                                            <td style="text-align: left">
                                                <?php if ($row['NOMOR_AJU_PLB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_AJU_PLB']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 80px;">
                                                    <?php
                                                    $dataTGLAJU_PLB = $row['TGL_AJU_PLB'];
                                                    $dataTGLAJU_PLBY = substr($dataTGLAJU_PLB, 0, 4);
                                                    $dataTGLAJU_PLBM = substr($dataTGLAJU_PLB, 4, 2);
                                                    $dataTGLAJU_PLBD = substr($dataTGLAJU_PLB, 6, 2);

                                                    $datTGLAJU_PLB = $dataTGLAJU_PLBY . '-' . $dataTGLAJU_PLBM . '-' . $dataTGLAJU_PLBD;
                                                    ?>
                                                    <?= $datTGLAJU_PLB ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <?php if ($row['NOMOR_DAFTAR_PLB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_DAFTAR_PLB']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 80px;">
                                                    <?php if ($row['TANGGAL_DAFTAR_PLB'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    <?php } else { ?>
                                                        <?php
                                                        $alldatePLB = $row['TANGGAL_DAFTAR_PLB'];
                                                        $tglPLB = substr($alldatePLB, 0, 10);
                                                        $timePLB = substr($alldatePLB, 10, 20);
                                                        ?>
                                                        <?= $tglPLB ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <!-- BC27 GB -->
                                            <td style="text-align: left">
                                                <?php if ($row['NOMOR_AJU_GB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_AJU_GB']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 80px;">
                                                    <?php
                                                    $dataTGLAJU_GB = $row['TGL_AJU_GB'];
                                                    $dataTGLAJU_GBY = substr($dataTGLAJU_GB, 0, 4);
                                                    $dataTGLAJU_GBM = substr($dataTGLAJU_GB, 4, 2);
                                                    $dataTGLAJU_GBD = substr($dataTGLAJU_GB, 6, 2);

                                                    $datTGLAJU_GB = $dataTGLAJU_GBY . '-' . $dataTGLAJU_GBM . '-' . $dataTGLAJU_GBD;
                                                    ?>
                                                    <?= $datTGLAJU_GB ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <?php if ($row['NOMOR_DAFTAR_GB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_DAFTAR_GB']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 80px;">
                                                    <?php if ($row['TANGGAL_DAFTAR_GB'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    <?php } else { ?>
                                                        <?php
                                                        $alldateGB = $row['TANGGAL_DAFTAR_GB'];
                                                        $tglGB = substr($alldateGB, 0, 10);
                                                        $timeGB = substr($alldateGB, 10, 20);
                                                        ?>
                                                        <?= $tglGB ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 150px;">
                                                    <?= $row['KODE_NEGARA_PEMASOK_GB'] ?> / <?= $row['URAIAN_NEGARA']; ?>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 200px;">
                                                    <?= $row['PERUSAHAAN'] ?>
                                                </div>
                                            </td>
                                            <td style="text-align: right">
                                                <?= $row['CARTON'] ?>
                                            </td>
                                            <td style="text-align: right">
                                                <?= $row['BOTOL'] ?>
                                            </td>
                                            <td style="text-align: right">
                                                <?= round($row['LITER'], 3) ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?= $row['PARTY'] ?>
                                            </td>
                                            <td style="text-align: right">
                                                <?= $row['KODE_VALUTA'] ?>
                                            </td>
                                            <td style="text-align: right">
                                                <?= $row['CIF'] ?>
                                            </td>
                                            <td style="text-align: right">
                                                <?= NPWP($row['ID_PENERIMA_BARANG']) ?>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="width: 200px;">
                                                    <?= $row['NAMA_PENERIMA_BARANG'] ?>
                                                </div>
                                            </td>
                                            <td style="text-align: right">
                                                <?= $row['ORIGIN'] ?>
                                            </td>
                                            <td style="text-align: left">
                                                <?= $row['TGL_MASUK'] ?>
                                            </td>
                                            <td style="text-align: left">
                                                <?= $row['TGL_KELUAR'] ?>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php
include "include/pusat_bantuan.php";
include "include/riwayat_aktifitas.php";
include "include/panel.php";
?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>
<?php include "include/jsForm.php"; ?>

<script type="text/javascript">
    // AJU PLB
    $(function() {
        $("#IDAJU_PLB").autocomplete({
            source: 'function/autocomplete/nomor_aju_plb.php'
        });
    });
    // AJU GB
    $(function() {
        $("#IDAJU_GB").autocomplete({
            source: 'function/autocomplete/nomor_aju_gb.php'
        });
    });
    // SUPPLIER
    $(function() {
        $("#ID_SUPPLIER").autocomplete({
            source: 'function/autocomplete/datatpb.php?function=supplier'
        });
    });
    // KD_NEGARA
    $(function() {
        $("#ID_KD_NEGARA").autocomplete({
            source: 'function/autocomplete/datatpb.php?function=kd_negara'
        });
    });
    // NAMA_NEGARA
    $(function() {
        $("#ID_NAMA_NEGARA").autocomplete({
            source: 'function/autocomplete/datatpb.php?function=nm_negara'
        });
    });
    // MATA_UANG
    $(function() {
        $("#ID_MATA_UANG").autocomplete({
            source: 'function/autocomplete/datatpb.php?function=mata_uang'
        });
    });
    // UPDATE SUCCESS
    if (window?.location?.href?.indexOf('UploadSuccess') > -1) {
        Swal.fire({
            title: 'Berhasil!',
            icon: 'success',
            text: 'Data berhasil diupload didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './report_ck5_plb.php');
    }
    // UPDATE FAILED
    if (window?.location?.href?.indexOf('UploadFailed') > -1) {
        Swal.fire({
            title: 'Gagal!',
            icon: 'error',
            text: 'Data gagal diupload didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './report_ck5_plb.php');
    }

    // TableDataTPB
    $(document).ready(function() {
        $('#TableDataTPB').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5', 'excelHtml5', 'csvHtml5'
            ],
            "order": [],
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }],
            iDisplayLength: -1
        });
    });
</script>