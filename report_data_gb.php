<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
// include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";
$TanggalAJU     = '';
$ShowField_AJU  = '';

if (isset($_POST["Find_TGLAJU"])) {
    $TanggalAJU      = $_POST['default-daterange-aju'];
    $Field_AJUE     = explode(" - ", $TanggalAJU);
    $AJUStart       = $Field_AJUE[0];
    $AJUStart_T     = strtotime($AJUStart);
    $S_AJU          = date("Ymd", $AJUStart_T);
    $AJUEnd         = $Field_AJUE[1];
    $AJUEnd_T       = strtotime($AJUEnd);
    $E_AJU          = date("Ymd", $AJUEnd_T);
    $ShowField_AJU  = "Tanggal Pengajuan: " . $_POST['default-daterange-aju'];
}

// START TANGGAL BARANG MASUK
// TANGGAL AJU FIRST
$dataRangeFirstAJU    = $dbcon->query("SELECT SUBSTR(NOMOR_AJU,13,8) AS TGL_AJU FROM tpb_header ORDER BY NOMOR_AJU ASC LIMIT 1");
$resultRangeFirstAJU  = mysqli_fetch_array($dataRangeFirstAJU);
if ($resultRangeFirstAJU != NULL) {
    $FirstTGLAJU       = $resultRangeFirstAJU['TGL_AJU'];
    $FirstTGLAJUY      = substr($FirstTGLAJU, 0, 4);
    $FirstTGLAJUM      = substr($FirstTGLAJU, 4, 2);
    $FirstTGLAJUD      =  substr($FirstTGLAJU, 6, 2);
    $AJUFirst         = $FirstTGLAJUM . '/' . $FirstTGLAJUD . '/' . $FirstTGLAJUY;
}
// TANGGAL AJU LAST
$dataRangeLastAJU     = $dbcon->query("SELECT SUBSTR(NOMOR_AJU,13,8) AS TGL_AJU FROM tpb_header ORDER BY NOMOR_AJU DESC LIMIT 1");
$resultRangeLastAJU   = mysqli_fetch_array($dataRangeLastAJU);
if ($resultRangeLastAJU != NULL) {
    $LastTGLAJU       = $resultRangeLastAJU['TGL_AJU'];
    $LastTGLAJUY      = substr($LastTGLAJU, 0, 4);
    $LastTGLAJUM      = substr($LastTGLAJU, 4, 2);
    $LastTGLAJUD      =  substr($LastTGLAJU, 6, 2);
    $AJULast         = $LastTGLAJUM . '/' . $LastTGLAJUD . '/' . $LastTGLAJUY;
}
// END TANGGAL BARANG AJU
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Laporan Data Gudang Berikat App Name | Company </title>
<?php } else { ?>
    <title>Laporan Data Gudang Berikat <?= $resultSetting['company']; ?> - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fa-solid fa-school-lock icon-page"></i>
                <font class="text-page">Laporan Data Gudang Berikat <?= $resultSetting['company']; ?></font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Laporan</a></li>
                <li class="breadcrumb-item active">Laporan Data Gudang Berikat <?= $resultSetting['company']; ?></li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <!-- begin Select Tabel -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Filter Data GB Berdasarkan Tanggal Pengajuan
                    </h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <!-- Tanggal Upload -->
                    <form action="" method="POST">
                        <div style="display: flex;justify-content: center;align-items: center;">
                            <div style="display: flex;justify-content: center;">
                                <img src="assets/img/svg/realisasi_b.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" style="width: 57%;">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Range Tanggal Pengajuan</label>
                                        <div class="input-group" id="default-daterange-aju">
                                            <input type="text" name="default-daterange-aju" class="form-control" value="<?= $TanggalAJU ?>" placeholder="Pilih Range Tanggal Masuk" />
                                            <span class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" name="Find_TGLAJU" class="btn btn-info m-r-5"><i class="fas fa-search"></i>
                                        <font class="f-action">Cari</font>
                                    </button>
                                    <a href="report_data_gb.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i>
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
    <!-- End Select Tabel -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Laporan GB] Gudang Berikat <?= $resultSetting['company']; ?></h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%" style="text-align:center">No.</th>
                                    <!-- <th rowspan="2" style="text-align:center">Format CK5</th> -->
                                    <th rowspan="2" style="text-align:center">Packing List</th>
                                    <th rowspan="2" style="text-align:center">Invoice</th>
                                    <th colspan="4" style="text-align:center">PLB</th>
                                    <th colspan="4" style="text-align:center">GB</th>
                                </tr>
                                <tr>
                                    <th style="text-align:center">Nomor Pengajuan</th>
                                    <th style="text-align:center">Asal</th>
                                    <th style="text-align:center">Penerima</th>
                                    <th class="text-nowrap" style="text-align: center;">Negara</th>
                                    <th style="text-align:center">Nomor Pengajuan</th>
                                    <th style="text-align:center">Asal</th>
                                    <th style="text-align:center">Penerima</th>
                                    <th class="text-nowrap" style="text-align: center;">Negara</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST["Find_TGLAJU"])) {
                                    $dataTable = $dbcon->query("SELECT hdr.ID AS IDH,hdr.NOMOR_AJU,SUBSTR(hdr.NOMOR_AJU,13,8) AS TGL_AJU_PLB,hdr.PEMASOK,hdr.KODE_NEGARA_PEMASOK,hdr.NOMOR_DAFTAR,hdr.PERUSAHAAN,hdr.JUMLAH_BARANG,
                                                                hdr.NAMA_PENERIMA_BARANG,
                                                                rcd.status,rcd.keterangan,plb.ck5_plb_submit,
                                                                rcd.rcd_id,
                                                                rcd.bm_no_aju_plb,
                                                                rcd.bm_tgl_masuk,
                                                                rcd.bm_nama_operator,
                                                                rcd.bm_remarks,
                                                                rcd.bk_no_aju_sarinah,
                                                                rcd.bk_tgl_keluar,
                                                                rcd.bk_nama_operator,
                                                                rcd.bk_remarks,
                                                                rcd.keterangan,
                                                                rcd.bc_out,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.upload_beritaAcara_GB,
                                                                -- TAMBAHAN
                                                                SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU_GB,
                                                                tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                                                                tpb.NAMA_PENGUSAHA,
                                                                tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS_GB IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All,
                                                                -- NEGARA PLB DAN GB
                                                                hdr.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_PLB,
                                                                tpb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_GB,
                                                                ngr_plb.URAIAN_NEGARA AS UN_PLB,
                                                                ngr_gb.URAIAN_NEGARA AS UN_GB,
                                                                -- END NEGARA PLB & GB
                                                                -- END
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All_PLB,
                                                                (SELECT COUNT(STATUS_GB) FROM plb_barang WHERE STATUS='Sesuai' AND NOMOR_AJU=hdr.NOMOR_AJU GROUP BY hdr.NOMOR_AJU) AS STATUS
                                                                FROM plb_header AS hdr
                                                                LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb 
                                                                LEFT OUTER JOIN plb_status AS plb ON hdr.NOMOR_AJU=plb.NOMOR_AJU_PLB 
                                                                -- TAMBAHAN
                                                                LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU 
                                                                LEFT OUTER JOIN referensi_negara AS ngr_plb ON hdr.KODE_NEGARA_PEMASOK=ngr_plb.KODE_NEGARA
                                                                LEFT OUTER JOIN referensi_negara AS ngr_gb ON tpb.KODE_NEGARA_PEMASOK=ngr_gb.KODE_NEGARA
                                                                -- END
                                                                -- TAMBAHAN
                                                                WHERE rcd.upload_beritaAcara_PLB IS NOT NULL
                                                                AND SUBSTR(tpb.NOMOR_AJU,13,8) BETWEEN $S_AJU AND $E_AJU
                                                                -- END
                                                                GROUP BY hdr.NOMOR_AJU ORDER BY hdr.ID DESC");
                                } else {
                                    $dataTable = $dbcon->query("SELECT hdr.ID AS IDH,hdr.NOMOR_AJU,SUBSTR(hdr.NOMOR_AJU,13,8) AS TGL_AJU_PLB,hdr.PEMASOK,hdr.KODE_NEGARA_PEMASOK,hdr.NOMOR_DAFTAR,hdr.PERUSAHAAN,hdr.JUMLAH_BARANG,
                                                                hdr.NAMA_PENERIMA_BARANG,
                                                                rcd.status,rcd.keterangan,plb.ck5_plb_submit,
                                                                rcd.rcd_id,
                                                                rcd.bm_no_aju_plb,
                                                                rcd.bm_tgl_masuk,
                                                                rcd.bm_nama_operator,
                                                                rcd.bm_remarks,
                                                                rcd.bk_no_aju_sarinah,
                                                                rcd.bk_tgl_keluar,
                                                                rcd.bk_nama_operator,
                                                                rcd.bk_remarks,
                                                                rcd.keterangan,
                                                                rcd.bc_out,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.upload_beritaAcara_GB,
                                                                -- TAMBAHAN
                                                                SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU_GB,
                                                                tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                                                                tpb.NAMA_PENGUSAHA,
                                                                tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS_GB IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All,
                                                                -- NEGARA PLB DAN GB
                                                                hdr.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_PLB,
                                                                tpb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_GB,
                                                                ngr_plb.URAIAN_NEGARA AS UN_PLB,
                                                                ngr_gb.URAIAN_NEGARA AS UN_GB,
                                                                -- END NEGARA PLB & GB
                                                                -- END
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All_PLB,
                                                                (SELECT COUNT(STATUS_GB) FROM plb_barang WHERE STATUS='Sesuai' AND NOMOR_AJU=hdr.NOMOR_AJU GROUP BY hdr.NOMOR_AJU) AS STATUS
                                                                FROM plb_header AS hdr
                                                                LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb 
                                                                LEFT OUTER JOIN plb_status AS plb ON hdr.NOMOR_AJU=plb.NOMOR_AJU_PLB 
                                                                -- TAMBAHAN
                                                                LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU 
                                                                LEFT OUTER JOIN referensi_negara AS ngr_plb ON hdr.KODE_NEGARA_PEMASOK=ngr_plb.KODE_NEGARA
                                                                LEFT OUTER JOIN referensi_negara AS ngr_gb ON tpb.KODE_NEGARA_PEMASOK=ngr_gb.KODE_NEGARA
                                                                -- END
                                                                -- TAMBAHAN
                                                                WHERE rcd.upload_beritaAcara_PLB IS NOT NULL
                                                                -- END
                                                                GROUP BY hdr.NOMOR_AJU ORDER BY hdr.ID DESC LIMIT 100");
                                }
                                if ($dataTable) : $no = 1;
                                    foreach ($dataTable as $row) :
                                ?>
                                        <tr>
                                            <td><?= $no ?>.</td>
                                            <!-- <td style="text-align: center;">
                                                <a href="report_data_gb_ck5.php?AJU=<?= $row['bm_no_aju_plb']; ?>" target="_blank" class="btn btn-primary">
                                                    <i class="fab fa-wpforms" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Lihat Detil <?= $row['bm_no_aju_plb']; ?>"></i><br>
                                                    <font style="font-size: 8px;display: flex;width: 55px;justify-content: center;">
                                                        CK5
                                                    </font>
                                                </a>
                                            </td> -->
                                            <td style="text-align: center;">
                                                <a href="report_data_gb_packinglist.php?AJU=<?= $row['bm_no_aju_plb']; ?>" target="_blank" class="btn btn-success">
                                                    <i class="fa-solid fa-boxes-stacked" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Packing List <?= $row['bm_no_aju_plb']; ?>"></i><br>
                                                    <font style="font-size: 8px;display: flex;width: 55px;justify-content: center;">
                                                        Packing List
                                                    </font>
                                                </a>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="report_data_gb_invoice.php?AJU=<?= $row['bm_no_aju_plb']; ?>" target="_blank" class="btn btn-default">
                                                    <i class="fa-solid fa-file-invoice" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Invoice <?= $row['bm_no_aju_plb']; ?>"></i><br>
                                                    <font style="font-size: 8px;display: flex;width: 55px;justify-content: center;">
                                                        Invoice
                                                    </font>
                                                </a>
                                            </td>
                                            <!-- PLB -->
                                            <!-- NOMOR AJU PLB & TANGGAL AJU -->
                                            <td style="text-align: left">
                                                <?php
                                                $dataTGLAJU_PLB = $row['TGL_AJU_PLB'];
                                                $dataTGLAJU_PLBY = substr($dataTGLAJU_PLB, 0, 4);
                                                $dataTGLAJU_PLBM = substr($dataTGLAJU_PLB, 4, 2);
                                                $dataTGLAJU_PLBD = substr($dataTGLAJU_PLB, 6, 2);

                                                $datTGLAJU_PLB = $dataTGLAJU_PLBY . '-' . $dataTGLAJU_PLBM . '-' . $dataTGLAJU_PLBD;
                                                ?>
                                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Nomor Pengajuan & Tanggal Pengajuan">
                                                        <i class="fas fa-file-invoice"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['bm_no_aju_plb']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= date_indo_s($datTGLAJU_PLB, TRUE) ?></font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- ASAL BARANG & JUMLAH BARANG -->
                                            <td style="text-align: left;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;width: 280px;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Asal & Jumlah Barang">
                                                        <i class="fas fa-warehouse"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['PERUSAHAAN']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $row['JUMLAH_BARANG']; ?> Barang</font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- NAMA PENERIMA BARANG PLB -->
                                            <td style="text-align: left">
                                                <div style="width:200px">
                                                    <?php if ($row['NAMA_PENERIMA_BARANG'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                        </font>
                                                    <?php } else { ?>
                                                        <?= $row['NAMA_PENERIMA_BARANG']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <!-- NEGARA PEMASOK PLB -->
                                            <td style="text-align: left;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Negara Pemasok PLB">
                                                        <i class="fas fa-globe"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['UN_PLB']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $row['KODE_NEGARA_PEMASOK_PLB']; ?></font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- GB -->
                                            <!-- NOMOR AJU GB & TANGGAL AJU -->
                                            <td style="text-align: left">
                                                <?php
                                                $dataTGLAJU_TPB = $row['TGL_AJU_GB'];
                                                $dataTGLAJU_TPBY = substr($dataTGLAJU_TPB, 0, 4);
                                                $dataTGLAJU_TPBM = substr($dataTGLAJU_TPB, 4, 2);
                                                $dataTGLAJU_TPBD =  substr($dataTGLAJU_TPB, 6, 2);

                                                $datTGLAJU_TPB = $dataTGLAJU_TPBY . '-' . $dataTGLAJU_TPBM . '-' . $dataTGLAJU_TPBD;
                                                ?>
                                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Nomor Pengajuan & Tanggal Pengajuan">
                                                        <i class="fas fa-file-invoice"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['bk_no_aju_sarinah']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= date_indo_s($datTGLAJU_TPB, TRUE) ?></font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- ASAL BARANG & JUMLAH BARANG -->
                                            <td style="text-align: left;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;width: 110px;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Asal & Jumlah Barang">
                                                        <i class="fas fa-warehouse"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['NAMA_PENGUSAHA']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $row['JUMLAH_BARANG']; ?> Barang</font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- NAMA PENERIMA BARANG GB -->
                                            <td style="text-align: left">
                                                <div style="width:150px">
                                                    <?= $row['NAMA_PENERIMA_BARANG_GB']; ?>
                                                </div>
                                            </td>
                                            <!-- NEGARA PEMASOK GB -->
                                            <td style="text-align: left;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Negara Pemasok GB">
                                                        <i class="fas fa-globe"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['UN_GB']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $row['KODE_NEGARA_PEMASOK_GB']; ?></font>
                                                        </div>
                                                    </div>
                                                </div>
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
include "include/footer.php";
include "include/jsDatatables.php";
include "include/jsForm.php";
?>
<script type="text/javascript">
    var handleDateRangePicker = function() {
        // RANGE TANGGAL PENGAJUAN
        $('#default-daterange-aju').daterangepicker({
            opens: 'right',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            minDate: '<?= $AJUFirst ?>',
            maxDate: '<?= $AJULast ?>',
        }, function(start, end) {
            $('#default-daterange-aju input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });
    };
</script>