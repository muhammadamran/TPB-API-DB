<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
include "include/cssDatatables.php";

$StartTanggal = '';
$EndTanggal = '';

if (isset($_POST['filter_date'])) {
    if ($_POST["StartTanggal"] != '') {
        $StartTanggal   = $_POST['StartTanggal'];
    }

    if ($_POST["EndTanggal"] != '') {
        $EndTanggal     = $_POST['EndTanggal'];
    }
}

?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Laporan Posisi Barang App Name | Company </title>
<?php } else { ?>
    <title>Laporan Posisi Barang - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-desktop icon-page"></i>
                <font class="text-page">Laporan Posisi Barang</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Report</a></li>
                <li class="breadcrumb-item active">Laporan Posisi Barang</li>
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
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Filter Data Posisi Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <!-- <form action="" method="POST">
                        <div style="display: flex;justify-content: center;align-items: center;">
                            <div style="display: flex;justify-content: center;align-items: center;">
                                <img src="assets/img/svg/realisasi_b.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" width="50%">
                            </div>
                            <div class="row">
                                <div class="col-xl-5">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" name="StartTanggal" class="form-control" value="<?= $StartTanggal; ?>" required>
                                    </div>
                                </div>
                                <div class="col-xl-2" style="display: flex;justify-content: center;align-self: center;margin-top: 25px;">
                                    <div class="form-group">
                                        S.D
                                    </div>
                                </div>
                                <div class="col-xl-5">
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label>
                                        <input type="date" name="EndTanggal" class="form-control" value="<?= $EndTanggal; ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" name="filter_date" class="btn btn-info m-r-5"><i class="fas fa-filter"></i>
                                        Filter Tanggal</button>
                                </div>
                            </div>
                        </div>
                    </form> -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Select Tabel -->

    <!-- Begin Row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-perusahaan">
                <div class="row">
                    <div style="display: flex;align-items: center;margin-top: 15px;margin-bottom: -0px;">
                        <div class="col-md-3">
                            <div style="display: flex;justify-content: center;">
                                <?php if ($resultHeadSetting['logo'] == NULL) { ?>
                                    <img src="assets/images/logo/logo-default.png" width="30%">
                                <?php } else { ?>
                                    <img src="assets/images/logo/<?= $resultHeadSetting['logo'] ?>" width="50%">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div style="display: grid;justify-content: left;">
                                <font style="font-size: 24px;font-weight: 800;">LAPORAN POSISI BARANG PER DOKUMEN PABEAN</font>
                                <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                                <?php if (isset($_POST['filter_date'])) { ?>
                                    <font style="font-size: 14px;font-weight: 800;"><i class="fas fa-calendar-check"></i> Tanggal: <?= $StartTanggal ?> S.D
                                        <?= $EndTanggal ?></font>
                                <?php } ?>
                                <div class="line-page-table"></div>
                                <font style="font-size: 18px;font-weight: 800;"><?= $resultHeadSetting['company_t'] ?></font>
                                <font style="font-size: 14px;font-weight: 400;"><i class="fa-solid fa-location-dot"></i> <?= $resultHeadSetting['address'] ?>
                                </font>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .bar {
                        display: flex;
                        justify-content: end;
                        background: transparent;
                    }
                </style>
                <div class="panel-body text-inverse">
                    <div style="background: #4c4747;height: 4px;width: 100%;margin: 15px -1px;box-sizing: border-box;">
                    </div>
                    <?php if (isset($_POST['filter_date'])) { ?>
                        <div class="bar">
                            <div style="padding: 5px;">
                                <a href="./report_masuk_barang.php" class="btn btn-warning" title="Reset" style="padding: 8px;">
                                    <div style="display: flex;justify-content: space-between;align-items: end;">
                                        <i class="fas fa-refresh" style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Reset
                                    </div>
                                </a>
                            </div>
                            <div style="padding: 5px;">
                                <form action="./export/excel_report_masuk_barang.php" target="_blank" method="POST" style="display: inline-block;">
                                    <input type="hidden" name="StartTanggal" value="<?= $StartTanggal; ?>">
                                    <input type="hidden" name="EndTanggal" value="<?= $EndTanggal; ?>">
                                    <button type="submit" name="find_" class="btn btn-secondary">
                                        <img src="assets/img/favicon/excel.png" class="icon-primary-excel" alt="Excel" data-toggle="popover" data-trigger="hover" data-title="Export File Excel" data-placement="top" data-content="Klik untuk mengexport data dalam file Excel">
                                        Export
                                        Excel
                                    </button>
                                </form>
                            </div>
                            <div style="padding: 5px;">
                                <form action="./export/pdf_report_masuk_barang.php" target="_blank" method="POST" style="display: inline-block;">
                                    <input type="hidden" name="StartTanggal" value="<?= $StartTanggal; ?>">
                                    <input type="hidden" name="EndTanggal" value="<?= $EndTanggal; ?>">
                                    <button type="submit" name="find_" class="btn btn-secondary">
                                        <img src="assets/img/favicon/print.png" class="icon-primary-print" alt="Print" data-toggle="popover" data-trigger="hover" data-title="Print File" data-placement="top" data-content="Klik untuk Print File">
                                        Print
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div style="background: #4c4747;height: 4px;width: 100%;margin: 15px -1px;box-sizing: border-box;">
                        </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table id="C_TableDefault_L" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">No.</th>
                                    <th colspan="6" style="text-align: center;">Dokumen Pabean BC 2.7 PLB</th>
                                    <th colspan="5" style="text-align: center;">Dokumen Pabean BC 2.7 GB</th>
                                    <th rowspan="2" style="text-align: center;">Kode Barang</th>
                                    <th rowspan="2" style="text-align: center;">Uraian</th>
                                    <th rowspan="2" style="text-align: center;">Jumlah Satuan</th>
                                    <th rowspan="2" style="text-align: center;">Nilai Barang</th>
                                    <th rowspan="2" style="text-align: center;">Tanggal & Waktu Masuk/Keluar</th>
                                    <th colspan="2" style="text-align: center;">Petugas Penerima</th>
                                    <th rowspan="2" class="text-nowrap no-sort" style="text-align: center;">Berita Acara</th>
                                </tr>
                                <tr>
                                    <!-- PLB -->
                                    <th class="no-sort" style="text-align: center;">Jenis Dokumen</th>
                                    <th style="text-align: center;">Nomor Pengajuan</th>
                                    <th style="text-align: center;">No. Daftar</th>
                                    <th class="text-nowrap no-sort" style="text-align: center;">Tanggal Upload</th>
                                    <th style="text-align: center;">Asal</th>
                                    <th style="text-align: center;">Tujuan</th>
                                    <!-- END -->
                                    <!-- TPB -->
                                    <th class="no-sort" style="text-align: center;">Jenis Dokumen</th>
                                    <th style="text-align: center;">Nomor Pengajuan</th>
                                    <th style="text-align: center;">No. Daftar</th>
                                    <th style="text-align: center;">Asal</th>
                                    <th style="text-align: center;">Tujuan</th>
                                    <!-- END -->
                                    <th style="text-align: center;">Sarinah</th>
                                    <th style="text-align: center;">BC</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataTable = $dbcon->query("SELECT rcd.rcd_id,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,
                                                            hdr.KODE_DOKUMEN_PABEAN AS KODE_DOKUMEN_PABEAN_PLB,
                                                            hdr.NOMOR_DAFTAR AS NOMOR_DAFTAR_PLB,
                                                            sts.ck5_plb_submit AS ck5_plb_submit_PLB,
                                                            hdr.NOMOR_AJU AS NOMOR_AJU_PLB_PLB,
                                                            hdr.PERUSAHAAN AS PERUSAHAAN_PLB,
                                                            hdr.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_PLB,
                                                            -- GB
                                                            tpb.KODE_DOKUMEN_PABEAN AS KODE_DOKUMEN_PABEAN_GB,
                                                            tpb.NOMOR_AJU AS NOMOR_AJU_GB,
                                                            tpb.NOMOR_DAFTAR AS NOMOR_DAFTAR_GB,
                                                            tpb.NAMA_PENGUSAHA AS NAMA_PENGUSAHA_GB,
                                                            tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                                                            -- BARANG
                                                            plb.KODE_BARANG,
                                                            plb.POS_TARIF,
                                                            plb.URAIAN,
                                                            plb.KODE_SATUAN,
                                                            plb.JUMLAH_SATUAN,
                                                            hdr.KODE_VALUTA,
                                                            plb.CIF,
                                                            rcd.bm_tgl_masuk,
                                                            rcd.bk_tgl_keluar,
                                                            rcd.bm_nama_operator,
                                                            rcd.bk_nama_operator,
                                                            rcd.bc_in,
                                                            rcd.bc_out,
                                                            rcd.upload_beritaAcara_PLB,
                                                            rcd.upload_beritaAcara_GB
                                                            FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                                            LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                                            ORDER BY hdr.ID DESC", 0);
                                if ($dataTable) : $no = 1;
                                    foreach ($dataTable as $row) :
                                ?>
                                        <tr>
                                            <td><?= $no ?>.</td>
                                            <!-- PLB -->
                                            <td style="text-align: center">
                                                BC <?= $row['KODE_DOKUMEN_PABEAN_PLB']; ?> PLB
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['NOMOR_AJU_PLB_PLB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_AJU_PLB_PLB']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['NOMOR_DAFTAR_PLB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_DAFTAR_PLB']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['ck5_plb_submit_PLB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?php
                                                    $alldate = $row['ck5_plb_submit_PLB'];
                                                    $tgl = substr($alldate, 0, 10);
                                                    $time = substr($alldate, 10, 20);
                                                    ?>
                                                    <div style="display: flex;justify-content: center;">
                                                        <font>
                                                            <i class="fa-solid fa-calendar-days"></i> <?= $tgl ?> - <?= $time ?>
                                                        </font>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: left">
                                                <?php if ($row['PERUSAHAAN_PLB'] == NULL) { ?>
                                                    <center>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                        </font>
                                                    </center>
                                                <?php } else { ?>
                                                    <?= $row['PERUSAHAAN_PLB']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: left">
                                                <?php if ($row['NAMA_PENERIMA_BARANG_PLB'] == NULL) { ?>
                                                    <center>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                        </font>
                                                    </center>
                                                <?php } else { ?>
                                                    <?= $row['NAMA_PENERIMA_BARANG_PLB']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- END PLB -->
                                            <!-- GB -->
                                            <td style="text-align: center">
                                                BC <?= $row['KODE_DOKUMEN_PABEAN_GB']; ?> PLB
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['NOMOR_AJU_GB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_AJU_GB']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['NOMOR_DAFTAR_GB'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_DAFTAR_GB']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: left">
                                                <?php if ($row['NAMA_PENGUSAHA_GB'] == NULL) { ?>
                                                    <center>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                        </font>
                                                    </center>
                                                <?php } else { ?>
                                                    <?= $row['NAMA_PENGUSAHA_GB']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: left">
                                                <?php if ($row['NAMA_PENERIMA_BARANG_GB'] == NULL) { ?>
                                                    <center>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                        </font>
                                                    </center>
                                                <?php } else { ?>
                                                    <?= $row['NAMA_PENERIMA_BARANG_GB']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- END GB -->

                                            <td style="text-align: left">
                                                <?php
                                                if ($row['KODE_BARANG'] == NULL) {
                                                    $KDBRG = "<font style='font-size: 8px;font-weight: 600;color: red'><i>Data Kosong!</i></font>";
                                                } else {
                                                    $KDBRG = $row['KODE_BARANG'];
                                                }
                                                if ($row['POS_TARIF'] == NULL) {
                                                    $POSTARIF = "<font style='font-size: 8px;font-weight: 600;color: red'><i>Data Kosong!</i></font>";
                                                } else {
                                                    $POSTARIF = $row['POS_TARIF'];
                                                }
                                                ?>
                                                <?= $KDBRG ?>
                                            </td>
                                            <td><?= $row['URAIAN']; ?></td>
                                            <td>
                                                <div style="display: flex;justify-content: space-between;align-items: center">
                                                    <font><?= $row['KODE_SATUAN']; ?></font>
                                                    <font><?= $row['JUMLAH_SATUAN']; ?></font>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="display: flex;justify-content: space-between;align-items: center">
                                                    <font><?= $row['KODE_VALUTA']; ?></font>
                                                    <font><?= $row['CIF']; ?></font>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="display: flex;justify-content: flex-start;align-content: center;align-items: center;width: 155px;">
                                                    <div style="font-size: 20px;">
                                                        <i class="fa-solid fa-calendar-days"></i>
                                                    </div>
                                                    <div style="font-size: 10px;margin-left: 5px;">
                                                        <div>
                                                            Masuk: <?= $row['bm_tgl_masuk'] ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            Keluar: <?= $row['bk_tgl_keluar'] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="display: flex;justify-content: flex-start;align-content: center;align-items: center;width: 155px;">
                                                    <div style="font-size: 20px;">
                                                        <i class="fa-solid fa-user-circle"></i>
                                                    </div>
                                                    <div style="font-size: 10px;margin-left: 5px;">
                                                        <div>
                                                            Masuk: <?= $row['bm_nama_operator'] ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            Keluar: <?= $row['bk_nama_operator'] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: left">
                                                <div style="display: flex;justify-content: flex-start;align-content: center;align-items: center;width: 155px;">
                                                    <div style="font-size: 20px;">
                                                        <i class="fa-solid fa-user-circle"></i>
                                                    </div>
                                                    <div style="font-size: 10px;margin-left: 5px;">
                                                        <div>
                                                            Masuk: <?= $row['bc_in'] ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            Keluar: <?= $row['bc_out'] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <a href="#detail<?= $row['rcd_id'] ?>" class="btn btn-dark" data-toggle="modal" title="Add">
                                                    <font data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Lihat Berita Acara: <?= $row['NOMOR_AJU'] ?>">
                                                        <div>
                                                            <div style="font-size: 12px;">
                                                                <i class="fas fa-eye"></i>
                                                            </div>
                                                        </div>
                                                    </font>
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Detail -->
                                        <div class="modal fade" id="detail<?= $row['rcd_id'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Berita Acara] Laporan Barang Masuk</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Nomor Pengajuan PLB</label>
                                                                                <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['NOMOR_AJU']; ?>" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Nomor Pengajuan GB</label>
                                                                                <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bk_no_aju_sarinah']; ?>" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Tanggal Masuk Barang</label>
                                                                                <input type="text" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bm_tgl_masuk']; ?>" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Petugas <?= $resultSetting['company']; ?></label>
                                                                                <input type="text" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bm_nama_operator']; ?>" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Petugas BeaCukai</label>
                                                                                <input type="text" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bc_in']; ?>" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                                                <div style="font-size: 30px;">
                                                                                    <i class="fas fa-file-pdf"></i>
                                                                                </div>
                                                                                <div style="margin-left: 10px;">
                                                                                    <div style="font-size: 17px;font-weight: 900;">
                                                                                        Dokumen Berita Acara Masuk
                                                                                    </div>
                                                                                    <div style="margin-top: -5px;font-size: 10px;">
                                                                                        Lampiran Gate In
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php if ($row['upload_beritaAcara_PLB'] != NULL) { ?>
                                                                                    <embed src="files/ck5plb/BA/PLB/<?= $row['upload_beritaAcara_PLB']; ?>" style="width: 100%" height="500">
                                                                                    </object>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Tanggal Keluar Barang</label>
                                                                                <input type="text" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bk_tgl_keluar']; ?>" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Petugas <?= $resultSetting['company']; ?></label>
                                                                                <input type="text" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bk_nama_operator']; ?>" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Petugas BeaCukai</label>
                                                                                <input type="text" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan GB ..." value="<?= $row['bc_out']; ?>" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                                                <div style="font-size: 30px;">
                                                                                    <i class="fas fa-file-pdf"></i>
                                                                                </div>
                                                                                <div style="margin-left: 10px;">
                                                                                    <div style="font-size: 17px;font-weight: 900;">
                                                                                        Dokumen Berita Acara Keluar
                                                                                    </div>
                                                                                    <div style="margin-top: -5px;font-size: 10px;">
                                                                                        Lampiran Gate Out
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php if ($row['upload_beritaAcara_GB'] != NULL) { ?>
                                                                                    <embed src="files/ck5plb/BA/GB/<?= $row['upload_beritaAcara_GB']; ?>" style="width: 100%" height="500">
                                                                                    </object>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Detail -->
                                    <?php
                                        $no++;
                                    endforeach
                                    ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="14">
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
                            Laporan Posisi Barang | IT Inventory <?= $resultHeadSetting['company'] ?>
                        </p>
                        <p class="text-center">
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i>
                                <?= $resultHeadSetting['website'] ?></span>
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i>
                                T:<?= $resultHeadSetting['telp'] ?></span>
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i>
                                <?= $resultHeadSetting['email'] ?></span>
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
include "include/panel.php";
include "include/footer.php";
include "include/jsDatatables.php";
?>
<script type="text/javascript">
    $(function() {
        $("#input-filter").change(function() {
            if ($(this).val() == "TGL") {
                $("#form_tgl").show();
                $("#form_aju").hide();
            } else if ($(this).val() == "AJU") {
                $("#form_tgl").hide();
                $("#form_aju").show();
            } else {
                $("#form_tgl").hide();
                $("#form_aju").hide();
            }
        });
    });
</script>